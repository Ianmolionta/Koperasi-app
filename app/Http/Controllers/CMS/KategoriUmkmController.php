<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\KategoriUmkmRequest;
use App\Repositories\KategoriUmkmRepositories;
use Illuminate\Http\Request;

class KategoriUmkmController extends Controller
{
    protected $KategoriRepo;

    public function __construct(KategoriUmkmRepositories $kategoriUmkmRepo)
    {
        $this->KategoriRepo = $kategoriUmkmRepo;
    }

    public function getAllData()
    {
        return $this->KategoriRepo->getAllData();
    }

    public function createData(KategoriUmkmRequest $request)
    {
        return $this->KategoriRepo->createData($request);
    }

    public function getDataById($id)
    {
        return $this->KategoriRepo->getDataById($id);
    }

    public function updateData(KategoriUmkmRequest $request, $id)
    {
        return $this->KategoriRepo->updateData($request, $id);
    }

    public function deleteData($id)
    {
        return $this->KategoriRepo->deleteData($id);
    }
}
