<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoriLimitModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tb_histori_limit';
    protected $fillable = [
        'id',
        'umkm_id',
        'limit_sebelumnya',
        'limit_baru',
        'perubahan',
        'alasan',
        'tanggal_berlaku',
        'created_at'
    ];

    public function umkm()
    {
        return $this->belongsTo(UmkmModel::class, 'umkm_id');
    }
}
