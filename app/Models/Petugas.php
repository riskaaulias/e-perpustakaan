<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nama_petugas', 'alamat_petugas', 'telpon_petugas'];
    public $timestamp   = true;

    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class);
    }
}
