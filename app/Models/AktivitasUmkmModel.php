<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AktivitasUmkmModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tb_aktivitas_umkm';
    protected $fillable = [
        'id',
        'umkm_id',
        'users_id',
        'periode_catur_wulan',
        'aktivitas',
        'permasalahan',
        'tanggal_aktivitas',
        'created_at'
    ];

    public function umkm()
    {
        return $this->belongsTo(UmkmModel::class, 'umkm_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }
}
