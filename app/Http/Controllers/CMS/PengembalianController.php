<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Requests\PengembalianRequest;
use App\Repositories\PengembalianRepositories;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    protected $PengembalianRepo;

    public function __construct(PengembalianRepositories $pengembalianRepo)
    {
        $this->PengembalianRepo = $pengembalianRepo;
    }

    public function getAllData()
    {
        return $this->PengembalianRepo->getAllData();
    }

    public function createData(PengembalianRequest $request)
    {
        return $this->PengembalianRepo->createData($request);
    }
}
