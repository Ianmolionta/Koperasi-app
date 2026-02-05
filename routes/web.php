<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CMS\AktivitasUmkmController;
use App\Http\Controllers\CMS\HistoriLimitController;
use App\Http\Controllers\CMS\KategoriUmkmController;
use App\Http\Controllers\CMS\PeminjamanController;
use App\Http\Controllers\CMS\PengembalianController;
use App\Http\Controllers\CMS\StatusRiskoController;
use App\Http\Controllers\CMS\UmkmController;
use App\Http\Controllers\CMS\UsersController;
use Illuminate\Support\Facades\Route;

Route::post('/login-proses', [AuthController::class, 'login']);

Route::get('/login', function () {
    return view('Pages.Auth.Login');
})->middleware('guest')->name('login');

Route::middleware(['auth', 'web'])->group(function () {
    Route::get('/', function () {
        return view('Pages.dashboard');
    })->middleware('role:admin,mentor');

    Route::get('/kategori', function () {
        return view('Pages.KategoriUmkm');
    })->middleware('role:admin,mentor');

    Route::get('/user', function () {
        return view('Pages.user');
    })->middleware('role:admin');

    Route::get('/umkm', function () {
        return view('Pages.Umkm');
    })->middleware('role:admin,mentor');

    Route::get('/peminjaman', function () {
        return view('Pages.peminjaman');
    })->middleware('role:admin,mentor');

    Route::get('/pengembalian', function () {
        return view('Pages.pengembalian');
    })->middleware('role:admin,mentor');

    Route::get('/histori-limit', function () {
        return view('Pages.historiLimit');
    })->middleware('role:admin,mentor');

    Route::get('/status-risiko', function () {
        return view('Pages.statusRisiko');
    })->middleware('role:admin,mentor');
    Route::get('/aktivitas', function () {
        return view('Pages.aktivitas');
    })->middleware('role:admin,mentor');
    
    Route::prefix('v1')->group(function () {
        Route::prefix('users')->controller(UsersController::class)->group(function () {
            Route::get('/', 'getAllData');
            Route::post('create', 'createData');
            Route::get('get/{id}', 'getDataById');
            Route::post('update/{id}', 'updateData');
            Route::delete('delete/{id}', 'deleteData');
        });
        Route::prefix('kategori-Umkm')->controller(KategoriUmkmController::class)->group(function () {
            Route::get('/', 'getAllData');
            Route::post('create', 'createData');
            Route::get('get/{id}', 'getDataById');
            Route::post('update/{id}', 'updateData');
            Route::delete('delete/{id}', 'deleteData');
        });

        Route::prefix('umkm')->controller(UmkmController::class)->group(function () {
            Route::get('/', 'getAllData');
            Route::post('create', 'createData');
            Route::get('get/{id}', 'getDataById');
            Route::post('update/{id}', 'updateData');
            Route::delete('delete/{id}', 'deleteData');
        });

        Route::prefix('peminjaman')->controller(PeminjamanController::class)->group(function () {
            Route::get('/', 'getAllData');
            Route::post('create', 'createData');
            Route::get('get/{id}', 'getDataById');
            Route::post('update/{id}', 'updateData');
            Route::delete('delete/{id}', 'deleteData');
            Route::post('approve/{id}', 'approvePeminjaman');
            Route::get('detail/{id}', 'getDetail');
            Route::get('detailUmkm/{id}', 'getUmkmDetail');
        });

        Route::prefix('histori-limit')->controller(HistoriLimitController::class)->group(function () {
            Route::get('/', 'getAllData');
            Route::post('create', 'createData');
            Route::get('get/{id}', 'getDataById');
            Route::post('update/{id}', 'updateData');
            Route::delete('delete/{id}', 'deleteData');
        });

        Route::prefix('pengembalian')->controller(PengembalianController::class)->group(function () {
            Route::get('/', 'getAllData');
            Route::post('create', 'createData');
            Route::get('get/{id}', 'getDataById');
            Route::post('update/{id}', 'updateData');
            Route::delete('delete/{id}', 'deleteData');
        });

        Route::prefix('status-risiko')->controller(StatusRiskoController::class)->group(function () {
            Route::get('/', 'getAllData');
            Route::post('create', 'createData');
            Route::get('get/{id}', 'getDataById');
            Route::post('update/{id}', 'updateData');
            Route::delete('delete/{id}', 'deleteData');
        });

        Route::prefix('aktivitas')->controller(AktivitasUmkmController::class)->group(function () {
            Route::get('/', 'getAllData');
            Route::post('create', 'createData');
            Route::get('get/{id}', 'getDataById');
            Route::post('update/{id}', 'updateData');
            Route::delete('delete/{id}', 'deleteData');
        });

        Route::prefix('limit')->controller(StatusRiskoController::class)->group(function () {
            Route::get('/', 'getAllData');
            Route::post('create', 'createData');
        });
    });
    Route::post('logout', [AuthController::class, 'logout']);
});
