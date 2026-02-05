<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\LimitRepositories;
use Illuminate\Http\Request;

class LimitController extends Controller
{
    protected $LimitRepo;

    public function __construct(LimitRepositories $limitrepo)
    {
        $this->LimitRepo = $limitrepo;
    }

    public function getAllData()
    {
        return $this->LimitRepo->getAllData();
    }

    public function createData(Request $request)
    {
        return $this->LimitRepo->createData($request);
    }
}
