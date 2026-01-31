<?php

namespace App\Repositories;

use App\Interfaces\StatusRisikoUmkmInterface;
use App\Models\StatusRisikoUmkmModel;
use App\Traits\HttpResponTrait;

class StatusRisikoUmkmRepositories implements StatusRisikoUmkmInterface
{
    protected $StatusRisikoUmkmModel;
    use HttpResponTrait;

    public function __construct(StatusRisikoUmkmModel $statusRisikoUmkmModel)
    {
        $this->StatusRisikoUmkmModel = $statusRisikoUmkmModel;
    }

    public function getAllData()
    {
        $data = $this->StatusRisikoUmkmModel->with('umkm')->get();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }
        return $this->success($data, 'success', 'success get all data status risiko umkm');
    }
}