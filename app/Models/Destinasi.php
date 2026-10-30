<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Destinasi extends Model
{
    use HasFactory;

    protected $table = 'destinasi';

    protected $fillable = [
        'nama',
        'deskripsi',
        'lokasi',
        'harga_tiket',
        'gambar',
    ];

    protected $casts = [
        'harga_tiket' => 'decimal:2',
    ];

    public function getGambarUrlAttribute(): string
    {
        if (empty($this->gambar)) {
            return asset('images/curug.jpg');
        }

        if (
            str_starts_with($this->gambar, 'http://') ||
            str_starts_with($this->gambar, 'https://')
        ) {
            return $this->gambar;
        }

        // Gambar yang diunggah melalui Laravel Storage
        if (Storage::disk('public')->exists($this->gambar)) {
            return Storage::disk('public')->url($this->gambar);
        }

        // Gambar lama di folder public/uploads
        if (file_exists(public_path('uploads/' . $this->gambar))) {
            return asset('uploads/' . $this->gambar);
        }

        // Gambar bawaan di folder public/images
        if (file_exists(public_path('images/' . $this->gambar))) {
            return asset('images/' . $this->gambar);
        }

        return asset($this->gambar);
    }
}
