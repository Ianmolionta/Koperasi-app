<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengembalianModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tb_pengembalian';
    protected $fillable = [
        'id',
        'peminjaman_id',
        'jumlah_pengembalian',
        'tanggal_pengembalian',
        'created_at'
    ];

    public function peminjaman()
    {
        return $this->belongsTo(PeminjamanModel::class, 'peminjaman_id');
    }
}
