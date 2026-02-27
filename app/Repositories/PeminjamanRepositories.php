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
             * 3. PENENTUAN LIMIT BERJALAN (RESET LOGIC)
             * Kita bandingkan Limit Awal di tb_limit dengan Histori Terakhir.
             */

            // A. Ambil Limit Awal dari tb_limit (Ini referensi 10jt Anda)
            $limitAwalData = DB::table('tb_limit')
                ->where('umkm_id', $umkm->id)
                ->first();

            if (!$limitAwalData) {
                throw new \Exception('Data limit awal UMKM tidak ditemukan di tb_limit.');
            }

            $limitAwal = (float) $limitAwalData->limit; // Nilai asli (misal: 10jt)

            // B. Ambil Histori Terbaru
            $historiTerbaru = DB::table('tb_histori_limit')
                ->where('umkm_id', $umkm->id)
                ->orderBy('id', 'desc')
                ->first();

            /**
             * C. LOGIKA RESET:
             * Jika tidak ada histori, pakai Limit Awal.
             * Jika ada histori, ambil yang TERBESAR antara Histori vs Limit Awal.
             * Ini akan me-reset otomatis jika histori berisi 5jt sedangkan limit awal 10jt.
             */
            if ($historiTerbaru) {
                $limitHistori = (float) $historiTerbaru->limit_baru;
                // Gunakan fungsi max() untuk mengambil angka tertinggi
                $limitBerjalan = max($limitAwal, $limitHistori);
            } else {
                $limitBerjalan = $limitAwal;
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
            // tanggal disetujui = sekarang
            $tanggalDisetujui = Carbon::now();

            // batas pengembalian = 4 bulan setelah disetujui
            $batasPengembalian = $tanggalDisetujui->copy()->addMonths(4);

            $data->tanggal_disetujui = $tanggalDisetujui;
            $data->batas_pengembalian = $batasPengembalian;
            $data->status = 'disetujui';
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

        // Ambil histori limit terakhir
        $latestHistori = $umkm->historiLimit()
            ->orderBy('id', 'desc')
            ->first();

        // Limit "master" = limit dasar dari tabel limit UMKM
        $limitMaster = $umkm->limit->limit ?? 0;

        // Limit "base" saat ini = dari histori (bisa naik/turun karena kebijakan koperasi)
        // Jika belum ada histori, pakai limit master
        $limitBase = $latestHistori ? $latestHistori->limit_baru : $limitMaster;

        // ─────────────────────────────────────────────────────────────────────────
        // PERBAIKAN UTAMA:
        // Hitung total pinjaman yang SEDANG AKTIF (belum lunas / belum ditolak).
        // Status yang mengurangi limit: pending, disetujui, berjalan
        // Status yang TIDAK mengurangi limit: lunas (uang kembali), ditolak (tidak jadi)
        // ─────────────────────────────────────────────────────────────────────────
        $statusAktif = ['pending', 'disetujui', 'berjalan'];

        $totalPinjamanAktif = PeminjamanModel::where('umkm_id', $id)
            ->whereIn('status', $statusAktif)
            ->sum('jumlah_pinjaman');

        // Limit efektif = limit base dikurangi pinjaman yang benar-benar sedang berjalan
        $limitEfektif = max($limitBase - $totalPinjamanAktif, 0);

        return response()->json([
            'data' => [
                'id'             => $umkm->id,
                'nama_umkm'      => $umkm->nama,
                'limit_master'   => (int) $limitMaster,
                'limit_base'     => (int) $limitBase,       // limit dari histori (sebelum dikurangi pinjaman aktif)
                'limit_saat_ini' => (int) $limitEfektif,    // limit yang benar-benar bisa dipakai sekarang
                'total_pinjaman_aktif' => (int) $totalPinjamanAktif, // untuk transparansi / debugging
                'histori_terakhir' => $latestHistori,
            ]
        ]);
    }
}
