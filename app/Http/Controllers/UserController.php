<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $totalPinjam = Peminjaman::where('id_anggota', $userId)->count();
        $sedangDipinjam = Peminjaman::where('id_anggota', $userId)->where('status', 'disetujui')->count();
        $sudahKembali = Peminjaman::where('id_anggota', $userId)->where('status', 'dikembalikan')->count();

        return view('user.dashboard', compact('totalPinjam', 'sedangDipinjam', 'sudahKembali'));
    }

    public function katalog()
    {
        $buku = Buku::all();
        return view('user.katalog', compact('buku'));
    }

    public function riwayat()
    {
        $riwayat = Peminjaman::where('user_id', Auth::id())->latest()->get();
        return view('user.riwayat', compact('riwayat'));
    }
}