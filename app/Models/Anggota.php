<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    protected $table = 'anggota';
    protected $fillable = ['id', 'nama_anggota', 'alamat', 'telpon', 'NIM', 'status'];
    public $timestamp   = true;

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }

    public function pengembalian()
    {
        return $this->hasMany(Pengembalian::class);
    }
}
