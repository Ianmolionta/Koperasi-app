<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusRisikoUmkmModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tb_status_risiko_umkm';
    protected $fillable = [
        'id',
        'umkm_id',
        'status',
        'hari_keterlambatan',
        'tanggal_penetapan',
        'created_at'
    ];

    public function umkm()
    {
        return $this->belongsTo(UmkmModel::class, 'umkm_id');
    }
}
