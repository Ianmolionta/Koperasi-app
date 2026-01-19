<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tb_umkm', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('users_id')->constrained('users');
            $table->foreignUuid('kategori_umkm_id')->constrained('tb_kategori_umkm');
            $table->string('nama_umkm');
            $table->string('nama_pemilik');
            $table->string('no_ktp');
            $table->string('no_kk');
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat_pemilik');
            $table->string('alamat_usaha');
            $table->enum('jenis_umkm', ['kelas1', 'kelas2', 'kelas3']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_umkm');
    }
};
