<?php

namespace App\Interfaces;

use App\Http\Requests\PeminjamanRequest;
use Illuminate\Http\Request;

interface PeminjamanInterface
{
    public function getAllData();
    public function createData(PeminjamanRequest $request);
    public function getDataById($id);
    public function updateData(PeminjamanRequest $request, $id);
    public function deleteData($id);
    public function approvePinjaman(Request $request, $id);
    public function getDetail($id);
}
