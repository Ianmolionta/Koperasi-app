<?php

namespace App\Interfaces;

use App\Http\Requests\KategoriUmkmRequest;

interface KategoriUmkmInterface
{
    public function getAllData();
    public function createData(KategoriUmkmRequest $request);
    public function getDataById($id);
    public function updateData(KategoriUmkmRequest $request, $id);
    public function deleteData($id);
}
