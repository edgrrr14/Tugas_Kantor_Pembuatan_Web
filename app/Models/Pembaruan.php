<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembaruan extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'nik',
        'email',
        'no_telepon',
        'instansi',
        'surat_rekomendasi',
        'status',
    ];
}
