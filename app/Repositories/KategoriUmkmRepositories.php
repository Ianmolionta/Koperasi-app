<?php

namespace App\Repositories;

use App\Http\Requests\KategoriUmkmRequest;
use App\Interfaces\KategoriUmkmInterface;
use App\Models\KategoriUmkmModel;
use App\Traits\HttpResponTrait;

class KategoriUmkmRepositories implements KategoriUmkmInterface
{
    use HttpResponTrait;
    protected $kategoriUMKM;

    public function __construct(KategoriUmkmModel $KategoriUmkm)
    {
        $this->kategoriUMKM = $KategoriUmkm;
    }

    public function getAllData()
    {
        $data = $this->kategoriUMKM->all();

        if ($data->isEmpty()) {
            return $this->dataNotFound();
        } else {
            return $this->success($data, 'success', 'success get all data kategori UMKM');
        }

    }
    
    public function createData(KategoriUmkmRequest $request)
    {
        try {
            $data = new $this->kategoriUMKM;
            $data->nama_kategori = $request->nama_kategori;
            $data->save();
            return $this->success($data, 'success', 'success create data kategori umkm');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    public function getDataById($id)
    {
        $data = $this->kategoriUMKM->find($id);
        if (!$data) {
            return $this->dataNotFound();
        } else {
            return $this->success($data, 'success', 'success get data by id');
        }
    }

    public function updateData(KategoriUmkmRequest $request, $id)
    {
        try {
            $data = $this->kategoriUMKM->find($id);
            if (!$data) {
                return $this->dataNotFound();
            }
            $data->nama_kategori = $request->nama_kategori;
            $data->save();
            return $this->success($data, 'success', 'success update data');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    public function deleteData($id)
    {
        try {
            $data = $this->kategoriUMKM->find($id);
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