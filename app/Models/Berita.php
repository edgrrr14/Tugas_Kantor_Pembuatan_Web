<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'beritas';

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'ringkasan',
        'konten',
        'gambar',
        'penulis',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    /**
     * Accessor untuk format tanggal Indonesia (Tampilan User: Tanpa Jam)
     */
    public function getFormattedDateAttribute()
    {
        if (!$this->published_at) {
            return $this->created_at ? $this->created_at->translatedFormat('d F Y') : '-';
        }
        return Carbon::parse($this->published_at)->translatedFormat('d F Y');
    }

    /**
     * Accessor untuk format tanggal + jam Indonesia (Tampilan Admin Dashboard)
     */
    public function getFormattedDateTimeAttribute()
    {
        if (!$this->published_at) {
            return $this->created_at ? $this->created_at->translatedFormat('d F Y, H:i') : '-';
        }
        return Carbon::parse($this->published_at)->translatedFormat('d F Y, H:i');
    }

    /**
     * Check apakah berita statusnya masih terjadwal (di masa depan)
     */
    public function getIsScheduledAttribute()
    {
        return $this->published_at && Carbon::parse($this->published_at)->isFuture();
    }

    /**
     * Accessor untuk URL Gambar Thumbnail
     */
    public function getGambarUrlAttribute()
    {
        if ($this->gambar) {
            return asset('storage/' . $this->gambar);
        }
        return null;
    }
}
