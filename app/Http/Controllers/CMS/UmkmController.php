<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\UmkmRequest;
use App\Repositories\UmkmRepositories;
use Illuminate\Http\Request;

class UmkmController extends Controller
{
    protected $UmkmRepo;

    public function __construct(UmkmRepositories $umkmRepo)
    {
        $this->UmkmRepo = $umkmRepo;
    }

    public function getAllData()
    {
        return $this->UmkmRepo->getAllData();
    }

    public function createData(UmkmRequest $request)
    {
        return $this->UmkmRepo->createData($request);
    }

    public function getDataById($id)
    {
        return $this->UmkmRepo->getDataById($id);
    }

    public function updateData(UmkmRequest $request, $id)
    {
        return $this->UmkmRepo->updateData($request, $id);
    }

    public function deleteData($id)
    {
        return $this->UmkmRepo->deleteData($id);
    }
}
