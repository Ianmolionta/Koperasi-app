<?php

use App\Http\Controllers\CMS\KategoriUmkmController;
use App\Http\Controllers\CMS\UmkmController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Pages.dashboard');
});

Route::get('/kategori', function () {
    return view('Pages.KategoriUmkm');
});

Route::prefix('v1')->group(function(){
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
});
