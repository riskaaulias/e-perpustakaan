<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nama_anggota', 'alamat', 'telpon', 'NIM', 'maks_pinjam', 'status'];
    public $timestamp   = true;
}
