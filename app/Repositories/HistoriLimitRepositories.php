<?php

namespace App\Repositories;

use App\Http\Requests\HistoriLimitRequest;
use App\Interfaces\HistoriLimitInterface;
use App\Models\HistoriLimitModel;
use App\Traits\HttpResponTrait;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HistoriLimitRepositories implements HistoriLimitInterface
{
    protected $HistoriModel;
    use HttpResponTrait;

    public function __construct(HistoriLimitModel $historiModel)
    {
        $this->HistoriModel = $historiModel;
    }

    public function getAllData()
    {
        $data = $this->HistoriModel->with('umkm')->get();
        if ($data->isEmpty()) {
            return $this->dataNotFound();
        }
        return $this->success($data, 'success', 'success get all data histori limit');
    }

    public function createData(HistoriLimitRequest $request)
    {
        try {
            DB::beginTransaction();
            $LimitSebelumnya = $request->limit_sebelumnya;
            $data = new $this->HistoriModel;
            $data->umkm_id = $request->umkm_id;
            $data->limit_sebelumnya = $LimitSebelumnya;
            $data->limit_baru = $LimitSebelumnya;
            $data->perubahan = 'tetap';
            $data->alasan = '-';
            $data->tanggal_berlaku = Carbon::now();
            $data->save();
            DB::commit();
            return $this->success($data, 'success', 'success create data histori limit');
        } catch (\Throwable $th) {
            DB::rollBack();
            return $this->error($th->getMessage());
        }
    }

    public function getDataById($id)
    {
        
    }

    public function updateData(HistoriLimitRequest $request, $id)
    {

    }

    public function deleteData($id)
    {
        throw new \Exception('Not implemented');
    }
}
