<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\AktivitasUmkmRequest;
use App\Repositories\AktivitasUmkmRepositories;
use Illuminate\Http\Request;

class AktivitasUmkmController extends Controller
{
    protected $AktivitasUmkmRepo;

    public function __construct(AktivitasUmkmRepositories $aktivitasUmkmRepo)
    {
        $this->AktivitasUmkmRepo = $aktivitasUmkmRepo;
    }

    public function getAllData()
    {
        return $this->AktivitasUmkmRepo->getAllData();
    }

    public function createData(AktivitasUmkmRequest $request)
    {
        return $this->AktivitasUmkmRepo->createData($request);
    }

    public function getDataById($id)
    {
        return $this->AktivitasUmkmRepo->getDataById($id);
    }

    public function updateData(AktivitasUmkmRequest $request, $id)
    {
        return $this->AktivitasUmkmRepo->updateData($request, $id);
    }

    public function deleteData($id)
    {
        return $this->AktivitasUmkmRepo->deleteData($id);
    }
}
