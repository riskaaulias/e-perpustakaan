<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $totalBuku = Buku::count();
        $totalAnggota = Anggota::count();
        
        $jatuhTempoHariIni = Peminjaman::whereDate('tgl_harus_kembali', date('Y-m-d'))
                                        ->whereDoesntHave('pengembalian')
                                        ->count();

        $peminjamanTerbaru = Peminjaman::with(['anggota', 'buku', 'pengembalian'])
                                        ->latest()
                                        ->take(5)
                                        ->get();

        $dipinjam = Peminjaman::whereDoesntHave('pengembalian')->count();
        $kembali = Pengembalian::count();

        $labels = [];
        $dataPinjam = [];
        $dataKembali = [];

        for ($i = 5; $i >= 0; $i--) {
            $month = now()->subMonths($i);
            $labels[] = $month->translatedFormat('M');
            
            $dataPinjam[] = Peminjaman::whereMonth('tgl_pinjam', $month->month)
                                        ->whereYear('tgl_pinjam', $month->year)->count();
                                    
            $dataKembali[] = Pengembalian::whereMonth('tgl_kembali', $month->month)
                                           ->whereYear('tgl_kembali', $month->year)->count();
        }

        return view('home', compact(
            'totalBuku', 'totalAnggota', 'peminjamanTerbaru', 'jatuhTempoHariIni',
            'dipinjam', 'kembali', 'labels', 'dataPinjam', 'dataKembali'
        ));
    }
}