<?php

namespace App\Repositories\Auth;

use App\Http\Requests\AuthRequest;
use App\Interfaces\AuthInterface;
use App\Models\User;
use App\Traits\HttpResponTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRepositories implements AuthInterface
{
    use HttpResponTrait;
    protected $User;
    public function __construct(User $user)
    {
        $this->User = $user;
    }

    public function login(AuthRequest $request)
    {
        try {
            $credentials = $request->only('username', 'password');

            if (!Auth::attempt($credentials)) {
                return $this->error('Invalid credentials', 401);
            }

            $user = $this->User->where('username', $request->username)->first();

            $token = $user->createToken('auth_token')->plainTextToken;

            return $this->success([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ], 'Login successful', 200);
        } catch (\Exception $e) {
            return $this->error('Login failed: ' . $e->getMessage(), 500);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user('web')->tokens()->delete();
            Auth::guard('web')->logout();

            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return response()->json([
                'status' => 'success',
                'message' => 'Logout success',
            ]);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}