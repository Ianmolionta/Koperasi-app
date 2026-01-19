<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tb_peminjaman';
    protected $fillable = [
        'id',
        'umkm_id',
        'jumlah_pinjaman',
        'sisa_pinjaman',
        'tanggal_pengajuan',
        'tanggal_disetuji',
        'batas_pengembalian',
        'status',
        'catatan',
        'created_at',
        'updated_at'
    ];

    public function umkm()
    {
        return $this->belongsTo(UmkmModel::class, 'umkm_id');
    }

    public function pengembalian()
    {
        return $this->hasOne(PengembalianModel::class, 'pengembalian_id');
    }
}
