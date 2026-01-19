<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriUmkmModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tb_kategori_umkm';
    protected $fillable = [
        'id',
        'nama_kategori',
        'created_at',
        'update_at'
    ];

    public function umkm()
    {
        return $this->hasOne(umkmModel::class, 'umkm_id');
    }
}
