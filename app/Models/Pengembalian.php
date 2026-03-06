<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $table = 'pengembalian';
    protected $fillable = ['id', 'tgl_harus_kembali', 'tgl_kembali', 'status', 'jumlah_kembali_buku', 'denda', 'id_pinjam', 'id_buku', 'id_anggota', 'id_petugas'];
    public $timestamp   = true;

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }
    
    public function peminjaman()
    {
        return $this->belongsTo(Peminjaman::class, 'id_pinjam');
    }
}
