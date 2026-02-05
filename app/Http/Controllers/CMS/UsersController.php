<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersRequest;
use App\Repositories\UsersRepositories;

class UsersController extends Controller
{
    protected $UserRepo;

    public function __construct(UsersRepositories $userRepo)
    {
        $this->UserRepo = $userRepo;
    }

    public function getAllData()
    {
        return $this->UserRepo->getAllData();
    }

    public function createData(UsersRequest $request)
    {
        return $this->UserRepo->createData($request);
    }

    public function getDataById($id)
    {
        return $this->UserRepo->getDataById($id);
    }

    public function updateData(UsersRequest $request, $id)
    {
        return $this->UserRepo->updateData($request, $id);
    }
    
    public function deleteData($id)
    {
        return $this->UserRepo->deleteData($$id);
    }
}
