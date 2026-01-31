<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Repositories\StatusRisikoUmkmRepositories;
use Illuminate\Http\Request;

class StatusRiskoController extends Controller
{
    protected $StatusRiskoRepo;

    public function __construct(StatusRisikoUmkmRepositories $statusRiskoRepo)
    {
        $this->StatusRiskoRepo = $statusRiskoRepo;
    }

    public function getAllData()
    {
        return $this->StatusRiskoRepo->getAllData();
    }
}
