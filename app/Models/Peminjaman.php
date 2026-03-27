<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';
    protected $fillable = ['id','id_buku', 'tgl_pinjam', 'total_pinjam', 'tgl_harus_kembali', 'id_anggota', 'id_petugas', 'status'];
    public $timestamp   = true;

    public function buku()
    {
        return $this->belongsTo(Buku::class, 'id_buku');
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas');
    }

    public function detail_pinjam()
    {
        return $this->hasMany(Detail_Pinjam::class);
    }

    public function pengembalian()
    {
        return $this->hasMany(Pengembalian::class, 'id_pinjam', 'id');
    }
}
