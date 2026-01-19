<?php

namespace App\Interfaces;

use App\Http\Requests\AktivitasUmkmRequest;

interface AktivitasUmkmInterface
{
    public function getAllData();
    public function createData(AktivitasUmkmRequest $request);
    public function getDataById($id);
    public function updateData(AktivitasUmkmRequest $request, $id);
    public function deleteData($id);
}
