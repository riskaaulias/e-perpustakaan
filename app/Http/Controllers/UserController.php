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

        $peminjaman = Peminjaman::where('id_anggota', $userId)
                        ->with('buku')
                        ->latest()
                        ->get();

        $totalPinjam = $peminjaman->count();
        $sedangDipinjam = $peminjaman->where('status', 'disetujui')->count();
        
        $sudahKembali = $peminjaman->where('status', 'kembali')->count();
        
        $ditolak = $peminjaman->where('status', 'ditolak')->count();

        return view('user.dashboard', compact(
            'peminjaman', 
            'totalPinjam', 
            'sedangDipinjam', 
            'sudahKembali', 
            'ditolak'
        ));
    }

    public function katalog(Request $request)
    {
        $search = $request->get('search');
        $buku = Buku::when($search, function ($query) use ($search) {
            return $query->where('judul_buku', 'LIKE', "%{$search}%")
                         ->orWhere('pengarang', 'LIKE', "%{$search}%");
        })->get();

        return view('user.katalog', compact('buku'));
    }

   public function pinjamStore(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'total_pinjam' => 'required|integer|min:1', 
        ]);

        $user = Auth::user();

        $anggota = \App\Models\Anggota::updateOrCreate(
            ['id' => $user->id],
            [
                'nama_anggota' => $user->name,
                'alamat'       => 'Belum diisi',
                'telpon'       => '000',
                'NIM'          => '000000',
                'status'       => 'aktif',
            ]
        );

        try {
            $buku = Buku::findOrFail($request->buku_id);
            if ($request->total_pinjam > $buku->stok) {
                return redirect()->back()->with([
                    'message' => 'Waduh, stok buku gak cukup!',
                    'type'    => 'danger'
                ]);
            }

            \App\Models\Peminjaman::create([
                'id_anggota'        => $anggota->id,
                'id_buku'           => $request->buku_id,
                'tgl_pinjam'        => now(),
                'tgl_harus_kembali' => now()->addDays(7), 
                'status'            => 'menunggu',
                
                'total_pinjam'      => $request->total_pinjam, 
                
                'id_petugas'        => null,
            ]);

            return redirect()->route('user.katalog')->with([
                'message' => 'Berhasil mengajukan ' . $request->total_pinjam . ' buku! Cek perpus ya buat ambil.',
                'type'    => 'success'
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Duh, ada masalah: ' . $e->getMessage(),
                'type'    => 'danger'
            ]);
        }
    }

    public function riwayat()
    {
        $user = auth()->user();

        $riwayat = \App\Models\Peminjaman::where('id_anggota', $user->id) 
                    ->with(['buku', 'petugas']) 
                    ->latest()
                    ->get();

        return view('user.riwayat', compact('riwayat'));
    }
}