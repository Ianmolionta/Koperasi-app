<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LimitModel extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'tb_limit';
    protected $fillable = [
        'umkm_id',
        'limit',
    ];

    public function umkm()
    {
        return $this->belongsTo(UmkmModel::class, 'umkm_id', 'id');
    }
}
