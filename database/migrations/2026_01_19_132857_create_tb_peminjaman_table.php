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
        Schema::create('tb_peminjaman', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignUuid('umkm_id')->constrained('tb_umkm');
            $table->integer('jumlah_pinjaman');
            $table->integer('sisa_pinjaman');
            $table->date('tanggal_pengajuan');
            $table->date('tanggal_disetujui');
            $table->date('batas_pengembalian');
            $table->enum('status', ['pending', 'disetujui', 'ditolak', 'lunas']);
            $table->text('catatan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_peminjaman');
    }
};
