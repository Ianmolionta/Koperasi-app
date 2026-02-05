<?php

namespace App\Repositories;

use App\Http\Requests\UsersRequest;
use App\Interfaces\UsersInterface;
use App\Models\User;
use App\Traits\HttpResponTrait;

class UsersRepositories implements UsersInterface
{
    protected $UsersModel;
    use HttpResponTrait;

    public function __construct(User $userModel)
    {
        $this->UsersModel = $userModel;
    }

    public function getAllData()
    {
        $data = $this->UsersModel->all();
        if($data->isEmpty()){
            return $this->dataNotFound();
        }
        return $this->success($data, 'success', 'success get all data user');
    }

    public function createData(UsersRequest $request)
    {
        try {
            $data = new $this->UsersModel;
            $data->nama = $request->nama;
            $data->username = $request->username;
            $data->password = $request->password;
            $data->jabatan = $request->jabatan;
            $data->nip = $request->nip;
            $data->no_hp = $request->no_hp;
            $data->role = $request->role;
            $data->save();
            return $this->success($data, 'success', 'suucess create data umkm');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    public function getDataById($id)
    {
        $data = $this->UsersModel->find($id);

        if (!$data) {
            return $this->dataNotFound();
        } else {
            return $this->success($data, 'success', 'success get data by id');
        }
    }

    public function updateData(UsersRequest $request, $id)
    {
        try {
            $data = $this->UsersModel->find($id);
            if (!$data) {
                return $this->dataNotFound();
            }
            $data->nama = $request->nama;
            $data->username = $request->username;
            $data->password = $request->password;
            $data->jabatan = $request->jabatan;
            $data->nip = $request->nip;
            $data->no_hp = $request->no_hp;
            $data->role = $request->role;
            $data->save();
            return $this->success($data, 'success', 'success update data');
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    public function deleteData($id)
    {
        try {
            $data = $this->UsersModel->find($id);
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