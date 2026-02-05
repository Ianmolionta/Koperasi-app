<?php

namespace App\Interfaces;

use App\Http\Requests\UsersRequest;

interface UsersInterface
{
    public function getAllData();
    public function createData(UsersRequest $request);
    public function getDataById($id);
    public function updateData(UsersRequest $request, $id);
    public function deleteData($id);
}
