<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'tgl_pinjam', 'total_pinjam', 'id_anggota', 'id_petugas'];
    public $timestamp   = true;
}
