<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class checkRole
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // 2. Cek apakah role user ada dalam daftar role yang diizinkan di route
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // Jika tidak punya akses, arahkan ke halaman lain atau beri error 403
        return abort(403, 'Anda tidak memiliki hak akses ke halaman ini.');
    }
}
