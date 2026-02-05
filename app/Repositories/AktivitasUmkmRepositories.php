<?php

namespace App\Repositories;

use App\Http\Requests\AktivitasUmkmRequest;
use App\Interfaces\AktivitasUmkmInterface;
use App\Models\AktivitasUmkmModel;
use App\Traits\HttpResponTrait;

class AktivitasUmkmRepositories implements AktivitasUmkmInterface
{
    use HttpResponTrait;
    protected $AktivitasUmkmModel;

    public function __construct(AktivitasUmkmModel $aktivitasUmkmModel)
    {
        $this->AktivitasUmkmModel = $aktivitasUmkmModel;
    }

    public function getAllData()
    {
        $data = $this->AktivitasUmkmModel->with('Umkm')->get();

        if ($data->isEmpty()) {
            return $this->dataNotFound();
        } else {
            return $this->success($data, 'success', 'success get all data');
        }
    }

    public function createData(AktivitasUmkmRequest $request)
    {
        try {
            $data = new $this->AktivitasUmkmModel;
            $data->users_id = auth()->user()->id;
            $data->umkm_id = $request->umkm_id;
            $data->periode_catur_wulan = $request->periode_catur_wulan;
            $data->aktivitas = $request->aktivitas;
            $data->permasalahan = $request->permasalahan;
            $data->tanggal_aktivitas = $request->tanggal_aktivitas;
            $data->save();
            return $this->success($data, 'success', 'success create aktivitas umkm');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    public function getDataById($id)
    {
        $data = $this->AktivitasUmkmModel->with('Umkm')->find($id);
        if (!$data) {
            return $this->dataNotFound();
        } else {
            return $this->success($data, 'success', 'success get data by id');
        }
    } 

    public function updateData(AktivitasUmkmRequest $request, $id)
    {
        try {
            $data = $this->AktivitasUmkmModel->find($id);
            if (!$data) {
                return $this->dataNotFound();
            }
            $data->umkm_id = $request->umkm_id;
            $data->periode_catur_wulan = $request->periode_catur_wulan;
            $data->aktivitas = $request->aktivitas;
            $data->permasalahan = $request->permasalahan;
            $data->tanggal_aktivitas = $request->tanggal_aktivitas;
            $data->save();
            return $this->success($data, 'success', 'success update aktivitas umkm');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    public function deleteData($id)
    {
        try {
            $data = $this->AktivitasUmkmModel->find($id);
            if (!$data) {
                return $this->dataNotFound();
            }
            $data->delete();
            return $this->delete('success', 'success delete aktivitas umkm');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}