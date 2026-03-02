<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'kode_buku', 'judul_buku', 'pengarang', 'penerbit', 'tahun', 'stok', 'dipinjam', 'tersedia'];
    public $timestamp   = true;

}
