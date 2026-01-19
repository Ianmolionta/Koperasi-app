<?php

namespace App\Interfaces;

use App\Http\Requests\UmkmRequest;

interface UmkmInterface
{
    public function getAllData();
    public function createData(UmkmRequest $request);
    public function getDataById($id);
    public function updateData(UmkmRequest $request, $id);
    public function deleteData($id);
}
