<?php

namespace App\Repositories;

use App\Http\Requests\PeminjamanRequest;
use App\Interfaces\PeminjamanInterface;
use App\Models\HistoriLimitModel;
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
            /**
             * 1. Ambil UMKM + lock
             */
            $umkm = UmkmModel::lockForUpdate()->find($request->umkm_id);
            if (!$umkm) {
                throw new \Exception('UMKM tidak ditemukan');
            }

            /**
             * 2. Validasi pinjaman aktif
             */
            $pinjamanAktif = $this->PeminjamanModel
                ->where('umkm_id', $umkm->id)
                ->where('status', '!=', 'lunas')
                ->exists();

            if ($pinjamanAktif) {
                throw new \Exception('Masih terdapat pinjaman aktif yang belum dilunasi');
            }

            /**
             * 3. Ambil jumlah pinjaman
             */
            $jumlahPinjaman = (int) $request->jumlah_pinjaman;

            /** * 3. Ambil limit TERAKHIR dari histori_limit */
            $historiLimitTerakhir = HistoriLimitModel::where('umkm_id', $umkm->id)->latest('tanggal_berlaku')->first();

            /**
             * 4. Tentukan jenis UMKM berdasarkan jumlah pinjaman
             */
            if ($jumlahPinjaman >= 2_000_000 && $jumlahPinjaman <= 10_000_000) {
                $jenisUmkm = 'Mikro';
                $limitAktif = 10_000_000;
            } elseif ($jumlahPinjaman > 10_000_000 && $jumlahPinjaman <= 50_000_000) {
                $jenisUmkm = 'Kecil';
                $limitAktif = 50_000_000;
            } elseif ($jumlahPinjaman > 50_000_000 && $jumlahPinjaman <= 500_000_000) {
                $jenisUmkm = 'Menengah';
                $limitAktif = 500_000_000;
            } else {
                throw new \Exception('Jumlah pinjaman tidak sesuai dengan klasifikasi UMKM');
            }

            if ($jumlahPinjaman > $historiLimitTerakhir->limit_baru) {
                throw new \Exception('Jumlah pinjaman melebihi limit UMKM (Limit: ' . number_format($historiLimitTerakhir->limit_baru) . ')');
            }

            /**
             * 5. Update jenis UMKM otomatis
             */
            $umkm->jenis_umkm = $jenisUmkm;
            $umkm->save();

            /**
             * 6. Validasi batas maksimal (double safety)
             */
            if ($jumlahPinjaman > $limitAktif) {
                throw new \Exception(
                    'Jumlah pinjaman melebihi batas maksimal ' . strtoupper($jenisUmkm)
                );
            }

            /**
             * 7. Hitung bunga (2%)
             */
            $bunga = $jumlahPinjaman * 0.02;
            $totalPinjaman = $jumlahPinjaman + $bunga;

            /**
             * 8. Simpan peminjaman
             */
            $data = new $this->PeminjamanModel;
            $data->umkm_id = $umkm->id;
            $data->jumlah_pinjaman = $jumlahPinjaman;
            $data->sisa_pinjaman = $totalPinjaman;
            $data->tanggal_pengajuan = now();
            $data->status = 'pending';
            $data->catatan = $request->catatan;
            $data->save();

            DB::commit();

            return $this->success(
                $data,
                'success',
                'Pengajuan berhasil. Jenis UMKM otomatis diperbarui menjadi ' . strtoupper($jenisUmkm)
            );
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
}
