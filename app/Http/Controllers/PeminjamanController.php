<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $peminjaman = Peminjaman::all();
        return view('peminjaman.index', compact('peminjaman'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $petugas = Petugas::all();
        $anggota = Anggota::all();
        $buku = Buku::where('stok', '>', 0)->get();
        $peminjaman = Peminjaman::all();
        return view('peminjaman.create', compact('petugas', 'anggota', 'buku' , 'peminjaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'id_buku'      => 'required|exists:buku,id',
            'id_anggota' => 'required|string|max:255',
            'id_petugas' => 'required|string|max:255',
            'tgl_pinjam' => 'required|string|max:255',
            'tgl_harus_kembali' => 'required|string|max:255',
            'total_pinjam' => 'required|string|max:255',
        ], [
            'id_anggota.required' => 'Nama tidak boleh kosong!',
            'id_petugas.required' => 'Nama petugas tidak boleh kosong!',
            'tgl_pinjam.required' => 'Tanggal Pinjam tidak boleh kosong!',
            'tgl_harus_kembali.required' => 'Tanggal tidak boleh kosong!',
            'total_pinjam.required' => 'Total Pinjam tidak boleh kosong!',
        ]);
        
        $buku = Buku::findOrFail($request->id_buku);
        if ($buku->stok < $request->total_pinjam) {
        return back()->with([
            'message' => 'Stok buku tidak mencukupi! Sisa stok: ' . $buku->stok,
            'type' => 'danger'
        ]);
        }
        $peminjaman = new Peminjaman;
        $peminjaman->id_buku           = $request->input('id_buku');
        $peminjaman->id_anggota       =$request->input('id_anggota');
        $peminjaman->id_petugas             =$request->input('id_petugas');
        $peminjaman->tgl_pinjam             =$request->input('tgl_pinjam');
        $peminjaman->tgl_harus_kembali             =$request->input('tgl_harus_kembali');
        $peminjaman->total_pinjam             =$request->input('total_pinjam');
        $buku->stok = $buku->stok - $request->total_pinjam;
        $buku->save();
        $peminjaman->save();

        session()->flash('success', 'Data Berhasil Ditambahkan');
        return redirect()->route('peminjaman.index')->with([
        'message' => 'Data Berhasil Ditambahkan',
        'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        return view('peminjaman.show', compact('peminjaman'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $petugas = Petugas::all();
        $anggota = Anggota::all();
        return view('peminjaman.edit', compact('petugas', 'anggota', 'peminjaman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_anggota' => 'required|string|max:255',
            'id_petugas' => 'required|string|max:255',
            'id_buku'      => 'required|exists:buku,id',
            'tgl_pinjam' => 'required|string|max:255',
            'tgl_harus_kembali' => 'required|string|max:255',
            'total_pinjam' => 'required|string|max:255',
        ], [
            'id_anggota.required' => 'Nama tidak boleh kosong!',
            'id_petugas.required' => 'Nama petugas tidak boleh kosong!',
            'tgl_pinjam.required' => 'Tanggal Pinjam tidak boleh kosong!',
            'tgl_harus_kembali.required' => 'Tanggal tidak boleh kosong!',
            'total_pinjam.required' => 'Total Pinjam tidak boleh kosong!',
        ]);

        $buku = Buku::findOrFail($request->id_buku);
        if ($buku->stok < $request->total_pinjam) {
        return redirect()->back()->with([
            'message' => 'Stok buku tidak mencukupi! Sisa stok: ' . $buku->stok,
            'type' => 'danger'
        ]);
        
        }
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->id_buku           = $request->input('id_buku'); 
        $peminjaman->id_anggota       =$request->input('id_anggota');
        $peminjaman->id_petugas             =$request->input('id_petugas');
        $peminjaman->id_buku     = $request->id_buku;
        $peminjaman->tgl_pinjam             =$request->input('tgl_pinjam');
        $peminjaman->total_pinjam             =$request->input('total_pinjam');
        $buku->stok = $buku->stok - $request->total_pinjam;
        $buku->save();
        $peminjaman->save();



        session()->flash('success', 'Data Berhasil Dirubah');
        return redirect()->route('peminjaman.index')->with([
        'message' => 'Data Berhasil Dirubah',
        'type' => 'warning'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with([
            'message' => 'Data Berhasil Dihapus',
            'type' => 'danger'
        ]);
    }
}

