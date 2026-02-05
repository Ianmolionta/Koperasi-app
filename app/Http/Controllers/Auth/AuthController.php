<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Repositories\Auth\AuthRepositories;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $AuthRepo;

    public function __construct(AuthRepositories $authRepo)
    {
        $this->AuthRepo = $authRepo;
    }

    public function login(AuthRequest $request)
    {
        return $this->AuthRepo->login($request);
    }

    public function logout(Request $request)
    {
        return $this->AuthRepo->logout($request);
    }
}
