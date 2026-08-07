<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenSyarat extends Model
{
    use HasFactory;

    protected $table = 'dokumen_syarats';

    protected $fillable = [
        'kategori',
        'nama_dokumen',
        'deskripsi',
        'file_path',
        'tipe_file',
    ];
}
