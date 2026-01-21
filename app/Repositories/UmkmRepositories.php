<?php

namespace App\Repositories;

use App\Http\Requests\UmkmRequest;
use App\Interfaces\UmkmInterface;
use App\Models\KategoriUmkmModel;
use App\Models\UmkmModel;
use App\Models\User;
use App\Traits\HttpResponTrait;
use Illuminate\Support\Facades\DB;

class UmkmRepositories implements UmkmInterface
{
    use HttpResponTrait;
    protected $UmkmModel;

    public function __construct(UmkmModel $umkmModel, KategoriUmkmModel $kategoriModel, User $user)
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
        try {
            DB::beginTransaction();
            $data = new $this->UmkmModel;
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
            DB::commit();
            $data->save();
            return $this->success($data, 'success', 'suucess create data umkm');
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
        try {
            $data = $this->UmkmModel->find($id);

            if (!$data) {
                return $this->dataNotFound();
            }
            DB::beginTransaction();
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
            DB::commit();
            $data->save();
            return $this->success($data, 'success', 'suucess create data umkm');
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