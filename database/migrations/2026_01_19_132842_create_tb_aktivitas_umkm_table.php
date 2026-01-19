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
        Schema::create('tb_aktivitas_umkm', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('umkm_id')->constrained('tb_umkm');
            $table->foreignUuid('users_id')->constrained('users');
            $table->enum('periode_catur_wulan', ['cw1', 'cw2', 'cwe']);
            $table->text('aktivitas');
            $table->text('permasalahan');
            $table->date('tanggal_aktivitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_aktivitas_umkm');
    }
};
