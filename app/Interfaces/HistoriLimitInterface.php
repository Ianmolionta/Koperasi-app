<?php

namespace App\Interfaces;

use App\Http\Requests\HistoriLimitRequest;

interface HistoriLimitInterface
{
    public function getAllData();
    public function createData(HistoriLimitRequest $request);
    public function getDataById($id);
    public function updateData(HistoriLimitRequest $request, $id);
    public function deleteData($id);
}
