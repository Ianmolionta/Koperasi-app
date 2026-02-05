<?php

namespace App\Repositories;

use App\Interfaces\LimitInterface;
use App\Models\LimitModel;
use App\Traits\HttpResponTrait;

class LimitRepositories implements LimitInterface
{
    protected $LimitModel;
    use HttpResponTrait;

    public function __construct(LimitModel $limitModel)
    {
        $this->LimitModel = $limitModel;
    }

    public function getAllData()
    {
        $data = $this->LimitModel->with('umkm')->get();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }
        return $this->success($data, 'success get all data limit');
    }

    public function createData($request)
    {
        try {
            $data = $this->LimitModel->create([
                'umkm_id' => $request->umkm_id,
                'limit' => $request->limit,
            ]);
            return $this->success($data, 'success create limit data');
        } catch (\Exception $th) {
            return $this->error($th->getMessage());
        }
    }
}
