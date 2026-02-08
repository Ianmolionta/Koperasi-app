<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkmModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tb_umkm';
    protected $fillable = [
        'id',
        'users_id',
        'kategori_umkm_id',
        'nama_umkm',
        'nama_pemilik',
        'no_ktp',
        'no_kk',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat_pemilik',
        'alamat_usaha',
        'jenis_umkm',
        'created_at',
        'updated_at'
    ];

    public function kategoriUmkm()
    {
        return $this->belongsTo(KategoriUmkmModel::class, 'kategori_umkm_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function statusRisikoUmkm()
    {
        return $this->hasOne(StatusRisikoUmkmModel::class, 'umkm_id');
    }

    public function aktivitasUmkm()
    {
        return $this->hasOne(AktivitasUmkmModel::class, 'aktivitas_id');
    }

    public function historiLimit()
    {
        return $this->hasOne(HistoriLimitModel::class, 'umkm_id');
    }

    public function peminjaman()
    {
        return $this->hasOne(PeminjamanModel::class, 'peminjaman_id');
    }

    public function limit()
    {
        return $this->hasOne(LimitModel::class, 'umkm_id', 'id');
    }
}
