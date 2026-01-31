<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\PeminjamanRequest;
use App\Repositories\PeminjamanRepositories;
use App\Traits\HttpResponTrait;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    protected $PeminjamanRepo;
    use HttpResponTrait;

    public function __construct(PeminjamanRepositories $peminjamanRepo)
    {
        $this->PeminjamanRepo = $peminjamanRepo;
    }

    public function getAllData()
    {
        return $this->PeminjamanRepo->getAllData();
    }

    public function createData(PeminjamanRequest $request)
    {
        return $this->PeminjamanRepo->createData($request);
    }

    public function approvePeminjaman(Request $request, $id)
    {
        return $this->PeminjamanRepo->approvePinjaman($request, $id);
    }

    public function getDetail($id)
    {
        return $this->PeminjamanRepo->getDetail($id);
    }
}
