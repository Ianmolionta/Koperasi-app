<?php

namespace App\Interfaces;

use App\Http\Requests\PengembalianRequest;

interface PengembalianInterface
{
    public function getAllData();
    public function createData(PengembalianRequest $request);
    public function getDataById($id);
    public function updateData(PengembalianRequest $request, $id);
    public function deleteData($id);
}
