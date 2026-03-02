<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail_Pinjam extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'id_pinjam', 'id_buku', 'jumlah_buku', 'status'];
    public $timestamp   = true;
}
