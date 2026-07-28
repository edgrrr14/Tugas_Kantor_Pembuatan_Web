<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penerbitan extends Model
{
    protected $fillable = [
        'nama_lengkap',
        'nik',
        'nip',
        'email',
        'no_telepon',
        'instansi',
        'jabatan',
        'alasan',
        'dokumen',
        'status',
    ];
}
