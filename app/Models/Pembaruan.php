<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembaruan extends Model
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
        'surat_permohonan',
        'surat_rekomendasi',
        'foto_ktp',
        'status',
    ];
}
