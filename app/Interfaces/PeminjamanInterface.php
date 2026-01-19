<?php

namespace App\Interfaces;

use App\Http\Requests\PeminjamanRequest;

interface PeminjamanInterface
{
    public function getAllData();
    public function createData(PeminjamanRequest $request);
    public function getDataById($id);
    public function updateData(PeminjamanRequest $request, $id);
    public function deleteData($id);
}
