<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Buku extends Model
{
    use HasFactory;

    protected $table = 'buku';
    protected $fillable = ['id', 'kode_buku', 'judul_buku', 'pengarang', 'penerbit', 'tahun', 'stok', 'kategori', 'lokasi_rak', 'image', 'deskripsi'];
    protected $appends = ['image_url'];
    public $timestamps   = true;

<<<<<<< HEAD
     public function getImageUrlAttribute(): ?string
=======
    public function getImageUrlAttribute(): ?string
>>>>>>> 93ddcaad7d199c78d83d6c6eb9a7a0b47450af81
    {
        if (!$this->image) {
            return null;
        }

        return Route::has('buku.image')
            ? route('buku.image', $this->id)
            : null;
    }

    public function detail_pinjam()
    {
        return $this->hasMany(Detail_Pinjam::class);
    }

    public function pengembalian()
    {
        return $this->hasMany(Pengembalian::class);
    }

}
