<?php

namespace App\Repositories;

use App\Interfaces\PengembalianInterface;
use App\Models\HistoriLimitModel;
use App\Models\PeminjamanModel;
use App\Models\PengembalianModel;
use App\Models\StatusRisikoUmkmModel;
use App\Traits\HttpResponTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PengembalianRepositories implements PengembalianInterface
{
    protected $PengembalianModel;
    protected $PeminjamanModel;
    use HttpResponTrait;

    public function __construct(PengembalianModel $pengembalianModel, PeminjamanModel $peminjamanModel)
    {
        $this->PengembalianModel = $pengembalianModel;
        $this->PeminjamanModel = $peminjamanModel;
    }

    public function getAllData()
    {
        $data = $this->PengembalianModel->with('peminjaman')->get();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }
        return $this->success($data, 'success', 'success get all data pengembalian');
    }

    public function createData($request)
    {
        DB::beginTransaction();

        try {

            /**
             * 1. Ambil peminjaman + lock
             */
            $peminjaman = $this->PeminjamanModel
                ->lockForUpdate()
                ->find($request->peminjaman_id);

            if (! $peminjaman) {
                throw new \Exception('Data peminjaman tidak ditemukan');
            }

            if ($peminjaman->status === 'lunas') {
                throw new \Exception('Pinjaman sudah lunas');
            }

            /**
             * 2. Validasi: hanya 1 pengembalian per bulan
             */
            $tanggalBayar = Carbon::parse($request->tanggal_pengembalian);

            $sudahBayarBulanIni = $this->PengembalianModel
                ->where('peminjaman_id', $peminjaman->id)
                ->whereMonth('tanggal_pengembalian', $tanggalBayar->month)
                ->whereYear('tanggal_pengembalian', $tanggalBayar->year)
                ->exists();

            if ($sudahBayarBulanIni) {
                throw new \Exception(
                    'Pengembalian hanya dapat dilakukan satu kali dalam satu bulan'
                );
            }

            /**
             * 3. Validasi bunga maksimal 2% (kecuali lunas)
             */
            $jumlahBayar = (int) $request->jumlah_pengembalian;
            $sisaPinjaman = (int) $peminjaman->sisa_pinjaman;
            $bungaMaksimal = (int) ($peminjaman->jumlah_pinjaman * 0.02);

            $akanLunas = ($jumlahBayar >= $sisaPinjaman);

            if (! $akanLunas) {
                $minimalSisa = $sisaPinjaman - $bungaMaksimal;

                if ($jumlahBayar > $minimalSisa) {
                    throw new \Exception(
                        'Jumlah pembayaran melebihi batas bunga 2% per bulan'
                    );
                }
            }

            /**
             * 4. Simpan pengembalian
             */
            $pengembalian = new $this->PengembalianModel;
            $pengembalian->peminjaman_id = $peminjaman->id;
            $pengembalian->jumlah_pengembalian = $jumlahBayar;
            $pengembalian->tanggal_pengembalian = $tanggalBayar;
            $pengembalian->save();

            /**
             * 5. Update sisa pinjaman
             */
            $peminjaman->sisa_pinjaman -= $jumlahBayar;

            if ($peminjaman->sisa_pinjaman < 0) {
                throw new \Exception('Jumlah pengembalian melebihi sisa pinjaman');
            }

            /**
             * 6. Hitung keterlambatan
             */
            $batas = Carbon::parse($peminjaman->batas_pengembalian);
            // diffInDays false: jika tanggalBayar < batas hasilnya negatif (cepat), jika > batas hasilnya positif (telat)
            $hariTerlambat = $batas->diffInDays($tanggalBayar, false);

            /**
             * 7. Hitung bunga bulan ini
             */
            $bungaBulanIni = 0;

            if ((int) $peminjaman->sisa_pinjaman > 0) {
                $bungaBulanIni = $bungaMaksimal;
            }

            /**
             * 8. Histori limit BULANAN (WAJIB SETIAP BAYAR)
             */
            HistoriLimitModel::create([
                'umkm_id' => $peminjaman->umkm_id,
                'limit_sebelumnya' => $peminjaman->jumlah_pinjaman,
                'limit_baru' => $peminjaman->jumlah_pinjaman,
                'perubahan' => 'tetap',
                'total_bunga' => $bungaBulanIni,
                'alasan' => 'Pengembalian bulanan',
                'tanggal_berlaku' => now(),
            ]);

            /**
             * 9. Jika pinjaman LUNAS → Evaluasi Limit & Risiko
             */
            /**
             * 9. Jika pinjaman LUNAS → Evaluasi Limit & Risiko
             */
            if ((int) $peminjaman->sisa_pinjaman === 0) {

                $limitSebelumnya = $peminjaman->jumlah_pinjaman;
                $limitBaru = $limitSebelumnya;
                $perubahan = 'tetap';

                // INISIALISASI DEFAULT agar tidak "Undefined"
                $statusRisiko = null;

                if ($hariTerlambat < 0) {
                    // KONDISI 2: Lebih Cepat
                    $limitBaru = $limitSebelumnya + ($limitSebelumnya * 0.10);
                    $perubahan = 'naik';

                } elseif ($hariTerlambat == 0) {
                    // KONDISI 1: Tepat Waktu
                    $limitBaru = $limitSebelumnya;
                    $perubahan = 'tetap';

                } else {
                    // KONDISI TERLAMBAT
                    $perubahan = 'turun';

                    if ($hariTerlambat > 60) {
                        // KONDISI 5: > 2 Bulan
                        $limitBaru = 0;
                        $statusRisiko = 'hitam';
                    } elseif ($hariTerlambat > 30) {
                        // KONDISI 4: 2 Bulan
                        $limitBaru = $limitSebelumnya - ($limitSebelumnya * 0.15);
                        $statusRisiko = 'merah';
                    } else {
                        // KONDISI 3: 1 Bulan
                        $limitBaru = $limitSebelumnya - ($limitSebelumnya * 0.10);
                        $statusRisiko = 'kuning';
                    }
                }

                // Update status pinjaman
                $peminjaman->status = 'lunas';

                // Simpan Histori Limit Pelunasan
                HistoriLimitModel::create([
                    'umkm_id' => $peminjaman->umkm_id,
                    'limit_sebelumnya' => $limitSebelumnya,
                    'limit_baru' => (int) $limitBaru,
                    'perubahan' => $perubahan,
                    'total_bunga' => 0,
                    'alasan' => 'Evaluasi pelunasan (Keterlambatan: ' . $hariTerlambat . ' hari)',
                    'tanggal_berlaku' => now(),
                ]);

                // Update Status Risiko UMKM (Hanya jika statusRisiko ada isinya)
                if ($statusRisiko) {
                    StatusRisikoUmkmModel::updateOrCreate(
                        ['umkm_id' => $peminjaman->umkm_id],
                        [
                            'status' => $statusRisiko,
                            'hari_keterlambatan' => max(0, $hariTerlambat),
                            'tanggal_penetapan' => now(),
                        ]
                    );
                }
            }

            $peminjaman->save();
            DB::commit();

            return $this->success(
                $pengembalian,
                'success',
                'Pengembalian berhasil diproses'
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }
}
