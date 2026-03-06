<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Anggota;
use App\Models\Peminjaman;
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
        $peminjaman = Peminjaman::all();
        return view('peminjaman.create', compact('petugas', 'anggota', 'peminjaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'id_anggota' => 'required|string|max:255',
            'id_petugas' => 'required|string|max:255',
            'tgl_pinjam' => 'required|string|max:255',
            'total_pinjam' => 'required|string|max:255',
        ], [
            'id_anggota.required' => 'Nama tidak boleh kosong!',
            'id_petugas.required' => 'Nama petugas tidak boleh kosong!',
            'tgl_pinjam.required' => 'Tanggal Pinjam tidak boleh kosong!',
            'total_pinjam.required' => 'Total Pinjam tidak boleh kosong!',
        ]);

        $peminjaman = new Peminjaman;
        $peminjaman->id_anggota       =$request->input('id_anggota');
        $peminjaman->id_petugas             =$request->input('id_petugas');
        $peminjaman->tgl_pinjam             =$request->input('tgl_pinjam');
        $peminjaman->total_pinjam             =$request->input('total_pinjam');
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
            'tgl_pinjam' => 'required|string|max:255',
            'total_pinjam' => 'required|string|max:255',
        ], [
            'id_anggota.required' => 'Nama tidak boleh kosong!',
            'id_petugas.required' => 'Nama petugas tidak boleh kosong!',
            'tgl_pinjam.required' => 'Tanggal Pinjam tidak boleh kosong!',
            'total_pinjam.required' => 'Total Pinjam tidak boleh kosong!',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->id_anggota       =$request->input('id_anggota');
        $peminjaman->id_petugas             =$request->input('id_petugas');
        $peminjaman->tgl_pinjam             =$request->input('tgl_pinjam');
        $peminjaman->total_pinjam             =$request->input('total_pinjam');
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
    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();
        return redirect()->route('peminjaman.index')->with([
        'message' => 'Data Berhasil Dihapus',
        'type' => 'danger'
        ]);
    }
}
