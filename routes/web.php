<?php

use App\Http\Controllers\CMS\KategoriUmkmController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('Pages.dashboard');
});

Route::prefix('v1')->group(function(){
    Route::prefix('kategori-Umkm')->controller(KategoriUmkmController::class)->group(function (){
        Route::get('/', 'getAllData');
        Route::post('create', 'createData');
        Route::get('get/{id}', 'getDataById');
        Route::post('update/{id}', 'updateData');
        Route::delete('delete/{id}', 'deleteData');
    });
});
