<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\HistoriLimitRequest;
use App\Repositories\HistoriLimitRepositories;
use Illuminate\Http\Request;

class HistoriLimitController extends Controller
{
    protected $HistoriLimitRepo;

    public function __construct(HistoriLimitRepositories $historiLimitRepo)
    {
        $this->HistoriLimitRepo = $historiLimitRepo;
    }

    public function getAllData()
    {
        return $this->HistoriLimitRepo->getAllData();
    }

    public function createData(HistoriLimitRequest $request)
    {
        return $this->HistoriLimitRepo->createData($request);
    }

    public function getDataById($id)
    {
        return $this->HistoriLimitRepo->getDataById($id);
    }

    public function updateData(HistoriLimitRequest $request, $id)
    {
        return $this->HistoriLimitRepo->updateData($request, $id);
    }

    public function deleteData($id)
    {
        return $this->HistoriLimitRepo->deleteData($id);
    }
}
