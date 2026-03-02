<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'tgl_harus_kembali', 'tgl_kembali', 'status', 'jumlah_kembali_buku', 'denda', 'id_pinjam', 'id_buku', 'id_anggota', 'id_petugas'];
    public $timestamp   = true;
}
