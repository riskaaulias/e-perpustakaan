<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Pinjam extends Model
{
    use HasFactory;

    protected $table = 'detail_pinjam';
    protected $fillable = ['id', 'id_peminjaman', 'id_buku', 'jumlah_buku', 'maks_pinjam'];
    public $timestamp   = true;

     public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_peminjaman');
    }
}
