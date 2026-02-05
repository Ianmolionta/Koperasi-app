<?php

namespace App\Repositories;

use App\Http\Requests\PeminjamanRequest;
use App\Interfaces\PeminjamanInterface;
use App\Models\LimitModel;
use App\Models\PeminjamanModel;
use App\Models\UmkmModel;
use App\Traits\HttpResponTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeminjamanRepositories implements PeminjamanInterface
{
    protected $PeminjamanModel;
    use HttpResponTrait;

    public function __construct(PeminjamanModel $peminjamanModel)
    {
        $this->PeminjamanModel = $peminjamanModel;
    }

    public function getAllData()
    {
        $data = $this->PeminjamanModel->with('umkm')->get();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }
        return $this->success($data, 'success', 'success get all data peminjaman');
    }

    public function createData(PeminjamanRequest $request)
    {
        DB::beginTransaction();

        try {
            // 1. Ambil UMKM dengan Lock
            $umkm = UmkmModel::with('limit')->lockForUpdate()->find($request->umkm_id);

            if (!$umkm) {
                throw new \Exception('UMKM tidak ditemukan');
            }

            // 2. Validasi pinjaman aktif (Hanya yang belum lunas/ditolak)
            $pinjamanAktif = $this->PeminjamanModel
                ->where('umkm_id', $umkm->id)
                ->whereIn('status', ['pending', 'disetujui', 'berjalan'])
                ->exists();

            if ($pinjamanAktif) {
                throw new \Exception('Masih terdapat pinjaman aktif yang belum dilunasi');
            }

            /**
             * 3. PENENTUAN LIMIT BERJALAN (LOGIC FIX)
             * Kita pastikan mengambil data TERAKHIR dari histori_limits 
             * karena di situlah angka 55 juta (kenaikan 10%) disimpan.
             */
            $limitBerjalan = 0;

            // Ambil histori limit terbaru berdasarkan ID terbesar atau created_at terbaru
            $historiTerbaru = DB::table('tb_histori_limit')
                ->where('umkm_id', $umkm->id)
                ->orderBy('id', 'desc')
                ->first();

            if ($historiTerbaru) {
                // Jika ada histori (Misal: 55.000.000), gunakan ini
                $limitBerjalan = (float) $historiTerbaru->limit_baru;
            } elseif ($umkm->limit) {
                // Jika belum pernah ada histori, pakai limit master (Misal: 50.000.000)
                $limitBerjalan = (float) $umkm->limit->limit;
            } else {
                throw new \Exception('Data limit master UMKM tidak ditemukan.');
            }

            // 4. Validasi input
            $jumlahPinjaman = (float) $request->jumlah_pinjaman;

            if ($jumlahPinjaman <= 0) {
                throw new \Exception('Jumlah pinjaman tidak valid.');
            }

            // 5. Validasi terhadap limit berjalan (DEBUG: Pastikan angka dibandingkan dengan benar)
            if ($jumlahPinjaman > $limitBerjalan) {
                throw new \Exception(
                    'Jumlah melebihi limit. Limit Anda saat ini Rp ' .
                        number_format($limitBerjalan, 0, ',', '.') .
                        '. Anda mengajukan Rp ' . number_format($jumlahPinjaman, 0, ',', '.')
                );
            }

            // 6. Hitung Bunga & Simpan
            $bunga = $jumlahPinjaman * 0.02;
            $totalPinjaman = $jumlahPinjaman + $bunga;

            $data = new $this->PeminjamanModel;
            $data->umkm_id = $umkm->id;
            $data->jumlah_pinjaman = $jumlahPinjaman;
            $data->sisa_pinjaman = $totalPinjaman;
            $data->tanggal_pengajuan = now();
            $data->status = 'pending';
            $data->catatan = $request->catatan;
            $data->save();

            DB::commit();
            return $this->success($data, 'success', 'Pengajuan pinjaman berhasil diajukan.');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }

    public function getDataById($id)
    {
        throw new \Exception('Not implemented');
    }

    public function updateData(PeminjamanRequest $request, $id)
    {
        throw new \Exception('Not implemented');
    }

    public function deleteData($id)
    {
        throw new \Exception('Not implemented');
    }

    public function approvePinjaman(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            $data = $this->PeminjamanModel->find($id);
            if (!$data) {
                return $this->dataNotFound();
            }

            // tanggal disetujui = sekarang
            $tanggalDisetujui = Carbon::now();

            // batas pengembalian = 4 bulan setelah disetujui
            $batasPengembalian = $tanggalDisetujui->copy()->addMonths(4);

            $data->tanggal_disetujui = $tanggalDisetujui;
            $data->batas_pengembalian = $batasPengembalian;
            $data->status = 'disetujui';
            $data->save();

            DB::commit();

            return $this->success(
                $data,
                'success',
                'success approve peminjaman'
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }

    public function getDetail($id)
    {
        $data = $this->PeminjamanModel->with('pengembalian', 'umkm')->find($id);
        return $this->success($data, 'success', 'success get all data detail');
    }

    public function getUmkmDetail($id)
    {
        $umkm = UmkmModel::with(['limit'])->find($id);

        if (!$umkm) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        // Ambil histori limit terakhir dengan pengurutan ID yang jelas
        $latestHistori = $umkm->historiLimit()
            ->orderBy('id', 'desc') // Memastikan baris terakhir database yang diambil
            ->first();

        // Logic penentuan limit aktif
        $limitAktif = 0;
        if ($latestHistori) {
            $limitAktif = $latestHistori->limit_baru;
        } elseif ($umkm->limit) {
            $limitAktif = $umkm->limit->limit;
        }

        return response()->json([
            'data' => [
                'id' => $umkm->id,
                'nama_umkm' => $umkm->nama,
                'limit_master' => $umkm->limit->limit ?? 0,
                'limit_saat_ini' => (int) $limitAktif,
                'histori_terakhir' => $latestHistori // Sertakan ini untuk pengecekan di FE
            ]
        ]);
    }
}
