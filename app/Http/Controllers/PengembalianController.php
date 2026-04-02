<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Petugas;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengembalianController extends Controller
{
    /**
     */
    public function index()
    {
        $pengembalian = Pengembalian::with(['peminjaman', 'anggota', 'buku'])->latest()->get();
        return view('pengembalian.index', compact('pengembalian'));
    }

    /**
     */
    public function store(Request $request)
    {
        $request->validate([
            'peminjaman_id' => 'required|exists:peminjaman,id',
        ]);

        $peminjaman = Peminjaman::findOrFail($request->peminjaman_id);

        if ($peminjaman->status == 'kembali') {
            return redirect()->back()->with([
                'message' => 'Buku ini sudah berstatus dikembalikan.',
                'type' => 'warning'
            ]);
        }

        $tgl_harus_kembali = Carbon::parse($peminjaman->tgl_harus_kembali)->startOfDay();
        $tgl_kembali = Carbon::now()->startOfDay();
        $denda = 0;

        if ($tgl_kembali->gt($tgl_harus_kembali)) {
            $selisih_hari = $tgl_kembali->diffInDays($tgl_harus_kembali);
            $denda = $selisih_hari * 5000; 
        }

        try {
            DB::transaction(function () use ($peminjaman, $tgl_kembali, $denda) {
                
                $pengembalian = new Pengembalian();
                $pengembalian->id_pinjam           = $peminjaman->id;
                $pengembalian->id_anggota          = $peminjaman->id_anggota;
                $pengembalian->id_petugas          = $peminjaman->id_petugas ?? 1; // Default ke ID 1 jika tidak ada
                $pengembalian->id_buku             = $peminjaman->id_buku;
                $pengembalian->tgl_kembali         = $tgl_kembali->format('Y-m-d');
                $pengembalian->tgl_harus_kembali   = $peminjaman->tgl_harus_kembali;
                $pengembalian->status              = 'dikembalikan';
                $pengembalian->jumlah_kembali_buku = 1;
                $pengembalian->denda               = $denda;
                $pengembalian->save();

                $buku = Buku::find($peminjaman->id_buku);
                if ($buku) {
                    $buku->increment('stok');
                }

                $peminjaman->update(['status' => 'kembali']);
            });

            $pesan = "Buku berhasil dikembalikan!";
            if ($denda > 0) {
                $pesan .= " Anda terlambat dan dikenakan denda Rp " . number_format($denda);
            }

            return redirect()->route('user.riwayat')->with([
                'message' => $pesan,
                'type' => $denda > 0 ? 'warning' : 'success'
            ]);

        } catch (\Exception $e) {
            return redirect()->back()->with([
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
                'type' => 'danger'
            ]);
        }
    }

    /**
     */
    public function show(string $id)
    {
        $pengembalian = Pengembalian::with(['peminjaman', 'anggota', 'buku', 'petugas'])->findOrFail($id);
        return view('pengembalian.show', compact('pengembalian'));
    }

    /**
     */
    public function destroy(string $id)
    { 
        $pengembalian = Pengembalian::findOrFail($id);
        
        $buku = Buku::find($pengembalian->id_buku);
        if ($buku) {
            $buku->decrement('stok');
        }
        
        $pengembalian->delete();

        return redirect()->route('pengembalian.index')->with([
            'message' => 'Data riwayat pengembalian berhasil dihapus',
            'type' => 'danger'
        ]);
    }
}