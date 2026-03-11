<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
        {
            if (auth()->user()->role == 'admin') {

            $totalBuku = Buku::count();
            $totalAnggota = Anggota::count();

            $jatuhTempoHariIni = Peminjaman::whereDate('tgl_harus_kembali', Carbon::today())
                                            ->doesntHave('pengembalian')
                                            ->count();

            $peminjamanTerbaru = Peminjaman::with(['anggota', 'buku', 'pengembalian'])
                            ->latest()
                            ->take(5)
                            ->get();

            return view('home', compact('totalBuku', 'totalAnggota', 'peminjamanTerbaru', 'jatuhTempoHariIni'));
        }
        }
    
}