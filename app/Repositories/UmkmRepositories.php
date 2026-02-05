<?php

namespace App\Repositories;

use App\Http\Requests\UmkmRequest;
use App\Interfaces\UmkmInterface;
use App\Models\LimitModel;
use App\Models\UmkmModel;
use App\Traits\HttpResponTrait;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\DB;

class UmkmRepositories implements UmkmInterface
{
    use HttpResponTrait;
    protected $UmkmModel;

    public function __construct(UmkmModel $umkmModel)
    {
        $this->UmkmModel = $umkmModel;
    }
    public function getAllData()
    {
        $data = $this->UmkmModel->with('kategoriUmkm', 'User')->get();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        } else {
            return $this->success($data, 'success', 'success get all data');
        }
    }

    public function createData(UmkmRequest $request)
    {
        DB::beginTransaction();

        try {
            // 1. Simpan UMKM
            $data = new $this->UmkmModel;
            $data->users_id = auth()->user()->id;
            $data->kategori_umkm_id = $request->kategori_umkm_id;
            $data->nama_umkm = $request->nama_umkm;
            $data->nama_pemilik = $request->nama_pemilik;
            $data->no_ktp = $request->no_ktp;
            $data->no_kk = $request->no_kk;
            $data->tempat_lahir = $request->tempat_lahir;
            $data->tanggal_lahir = $request->tanggal_lahir;
            $data->alamat_pemilik = $request->alamat_pemilik;
            $data->alamat_usaha = $request->alamat_usaha;
            $data->jenis_umkm = $request->jenis_umkm;
            $data->save();

            // 2. Tentukan limit berdasarkan jenis UMKM
            switch ($data->jenis_umkm) {
                case 'Mikro':
                    $limitValue = 10_000_000;
                    break;
                case 'Kecil':
                    $limitValue = 50_000_000;
                    break;
                case 'Menengah':
                    $limitValue = 500_000_000;
                    break;
                default:
                    throw new \Exception('Jenis UMKM tidak valid');
            }

            // 3. Simpan limit UMKM
            $limit = new LimitModel();
            $limit->umkm_id = $data->id;
            $limit->limit = $limitValue;
            $limit->save();

            DB::commit();
            return $this->success($data, 'success', 'Berhasil membuat data UMKM');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }


    public function getDataById($id)
    {
        $data = $this->UmkmModel->with('kategoriUmkm', 'User')->find($id);

        if (!$data) {
            return $this->dataNotFound();
        } else {
            return $this->success($data, 'success', 'success get data by id');
        }
    }

    public function updateData(UmkmRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $data = $this->UmkmModel->find($id);
            if (!$data) {
                return $this->dataNotFound();
            }

            /**
             * 1. Simpan jenis UMKM lama
             */
            $jenisLama = $data->jenis_umkm;

            /**
             * 2. Update data UMKM
             */
            $data->users_id = $request->users_id;
            $data->kategori_umkm_id = $request->kategori_umkm_id;
            $data->nama_umkm = $request->nama_umkm;
            $data->nama_pemilik = $request->nama_pemilik;
            $data->no_ktp = $request->no_ktp;
            $data->no_kk = $request->no_kk;
            $data->tempat_lahir = $request->tempat_lahir;
            $data->tanggal_lahir = $request->tanggal_lahir;
            $data->alamat_pemilik = $request->alamat_pemilik;
            $data->alamat_usaha = $request->alamat_usaha;
            $data->jenis_umkm = $request->jenis_umkm;
            $data->save();

            /**
             * 3. Jika jenis UMKM berubah → update limit
             */
            if ($jenisLama !== $data->jenis_umkm) {

                switch ($data->jenis_umkm) {
                    case 'Mikro':
                        $limitValue = 10_000_000;
                        break;
                    case 'Kecil':
                        $limitValue = 50_000_000;
                        break;
                    case 'Menengah':
                        $limitValue = 500_000_000;
                        break;
                    default:
                        throw new \Exception('Jenis UMKM tidak valid');
                }

                /**
                 * 4. UPDATE limit (bukan INSERT)
                 */
                $limit = LimitModel::where('umkm_id', $data->id)->first();
                if (!$limit) {
                    throw new \Exception('Data limit UMKM tidak ditemukan');
                }

                $limit->limit = $limitValue;
                $limit->save();
            }

            DB::commit();

            return $this->success(
                $data,
                'success',
                'Berhasil memperbarui data UMKM'
            );
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }


    public function deleteData($id)
    {
        try {
            $data = $this->UmkmModel->find($id);
            if (!$data) {
                return $this->dataNotFound();
            }
            $data->delete();
            return $this->delete('success', 'success delete data');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
