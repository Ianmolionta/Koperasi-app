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
        try {
            DB::beginTransaction();

            // 1. Simpan pengembalian
            $data = new $this->PengembalianModel;
            $data->peminjaman_id = $request->peminjaman_id;
            $data->jumlah_pengembalian = $request->jumlah_pengembalian;
            $data->tanggal_pengembalian = $request->tanggal_pengembalian;
            $data->save();

            // 2. Ambil peminjaman
            $peminjaman = $this->PeminjamanModel
                ->lockForUpdate()
                ->find($data->peminjaman_id);

            if (! $peminjaman) {
                throw new \Exception('Data peminjaman tidak ditemukan');
            }

            // 3. Kurangi sisa pinjaman
            $peminjaman->sisa_pinjaman -= $data->jumlah_pengembalian;

            if ($peminjaman->sisa_pinjaman < 0) {
                throw new \Exception('Jumlah pengembalian melebihi sisa pinjaman');
            }

            // 4. Hitung keterlambatan
            $batas = Carbon::parse($peminjaman->batas_pengembalian);
            $tanggalPengembalian = Carbon::parse($data->tanggal_pengembalian);
            $hariTerlambat = $batas->diffInDays($tanggalPengembalian, false);

            // 5. Tentukan limit & risiko
            $limitSebelumnya = $peminjaman->jumlah_pinjaman;
            $limitBaru = $limitSebelumnya;
            $perubahan = 'tetap';
            $statusRisiko = null;

            if ($hariTerlambat < 0) {
                // Lebih cepat
                $limitBaru = $limitSebelumnya * 1.10;
                $perubahan = 'naik';
            } elseif ($hariTerlambat > 60) {
                $limitBaru = $limitSebelumnya * 0.90;
                $perubahan = 'turun';
                $statusRisiko = 'merah';
            } elseif ($hariTerlambat > 30) {
                $limitBaru = $limitSebelumnya * 0.90;
                $perubahan = 'turun';
                $statusRisiko = 'kuning';
            }

            // 6. Jika lunas
            if ((int) $peminjaman->sisa_pinjaman === 0) {
                $peminjaman->status = 'lunas';
            }

            $peminjaman->save();

            // 7. Simpan histori limit (SETIAP pengembalian)
            HistoriLimitModel::create([
                'umkm_id' => $peminjaman->umkm_id,
                'limit_sebelumnya' => $limitSebelumnya,
                'limit_baru' => (int) $limitBaru,
                'perubahan' => $perubahan,
                'alasan' => 'Evaluasi otomatis saat pengembalian',
                'tanggal_berlaku' => now(),
            ]);

            // 8. Update / simpan status risiko
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

            DB::commit();

            return $this->success($data, 'success', 'success create data pengembalian');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }
}
