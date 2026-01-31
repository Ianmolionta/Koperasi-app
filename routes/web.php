<?php

use App\Http\Controllers\CMS\HistoriLimitController;
use App\Http\Controllers\CMS\KategoriUmkmController;
use App\Http\Controllers\CMS\PeminjamanController;
use App\Http\Controllers\CMS\PengembalianController;
use App\Http\Controllers\CMS\StatusRiskoController;
use App\Http\Controllers\CMS\UmkmController;
use App\Http\Controllers\CMS\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Pages.dashboard');
});

Route::get('/kategori', function () {
    return view('Pages.KategoriUmkm');
});

Route::get('/umkm', function () {
    return view('Pages.Umkm');
});

Route::get('/peminjaman', function () {
    return view('Pages.peminjaman');
});

Route::get('/pengembalian', function () {
    return view('Pages.pengembalian');
});

Route::get('/histori-limit', function () {
    return view('Pages.historiLimit');
});

Route::get('/status-risiko', function () {
    return view('Pages.statusRisiko');
});

Route::prefix('v1')->group(function(){
    Route::prefix('users')->controller(UsersController::class)->group(function (){
        Route::get('/', 'getAllData');
        Route::post('create', 'createData');
        Route::get('get/{id}', 'getDataById');
        Route::post('update/{id}', 'updateData');
        Route::delete('delete/{id}', 'deleteData');
    });
    Route::prefix('kategori-Umkm')->controller(KategoriUmkmController::class)->group(function (){
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
});
