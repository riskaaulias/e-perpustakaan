<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Petugas;
use App\Models\Anggota;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use Illuminate\Http\Request;

class PengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pengembalian = Pengembalian::all();
        return view('pengembalian.index', compact('pengembalian'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $petugas = Petugas::all();
        $anggota = Anggota::all();
        $peminjaman = Peminjaman::all();
        $buku = Buku::all();
        $pengembalian = Pengembalian::all();
        return view('pengembalian.create', compact('petugas', 'anggota', 'pengembalian', 'peminjaman', 'buku'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'id_pinjam' => 'required|string|max:255',
            'id_anggota' => 'required|string|max:255',
            'id_petugas' => 'required|string|max:255',
            'id_petugas' => 'required|string|max:255',
            'id_buku' => 'required|string|max:255',
            'tgl_harus_kembali' => 'required|string|max:255',
            'tgl_kembali' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'jumlah_kembali_buku' => 'required|string|max:255',
            'denda' => 'required|string|max:255',
        ], [
            'id_pinjam.required' => 'Nama tidak boleh kosong!',
            'id_anggota.required' => 'Nama tidak boleh kosong!',
            'id_petugas.required' => 'Nama petugas tidak boleh kosong!',
            'id_petugas.required' => 'Tanggal Pinjam tidak boleh kosong!',
            'id_buku.required' => 'Total Pinjam tidak boleh kosong!',
            'tgl_harus_kembali.required' => 'Total Pinjam tidak boleh kosong!',
            'tgl_kembali.required' => 'Total Pinjam tidak boleh kosong!',
            'status.required' => 'Total Pinjam tidak boleh kosong!',
            'jumlah_kembali_buku.required' => 'Total Pinjam tidak boleh kosong!',
            'denda.required' => 'Total Pinjam tidak boleh kosong!',
        ]);

        $pengembalian = new Pengembalian;
        $pengembalian->id_pinjam       =$request->input('id_pinjam');
        $pengembalian->id_anggota       =$request->input('id_anggota');
        $pengembalian->id_petugas             =$request->input('id_petugas');
        $pengembalian->id_petugas             =$request->input('id_petugas');
        $pengembalian->id_buku             =$request->input('id_buku');
        $pengembalian->tgl_harus_kembali             =$request->input('tgl_harus_kembali');
        $pengembalian->tgl_kembali             =$request->input('tgl_kembali');
        $pengembalian->status             =$request->input('status');
        $pengembalian->jumlah_kembali_buku             =$request->input('jumlah_kembali_buku');
        $pengembalian->denda               = $request->input('denda') ?? 0; 
        $pengembalian->save();

        session()->flash('success', 'Data Berhasil Ditambahkan');
        return redirect()->route('pengembalian.index')->with([
        'message' => 'Data Berhasil Ditambahkan',
        'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        return view('pengembalian.show', compact('pengembalian'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $petugas = Petugas::all();
        $anggota = Anggota::all();
        $peminjaman = Peminjaman::all();
        $buku = Buku::all();
        $pengembalian = Pengembalian::findOrFail($id);
        return view('pengembalian.create', compact('petugas', 'anggota', 'pengembalian', 'peminjaman', 'buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_anggota' => 'required|string|max:255',
            'id_petugas' => 'required|string|max:255',
            'id_petugas' => 'required|string|max:255',
            'id_buku' => 'required|string|max:255',
            'tgl_harus_kembali' => 'required|string|max:255',
            'tgl_kembali' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'jumlah_kembali_buku' => 'required|string|max:255',
            'denda' => 'required|string|max:255',
        ], [
            'id_anggota.required' => 'Nama tidak boleh kosong!',
            'id_petugas.required' => 'Nama petugas tidak boleh kosong!',
            'id_petugas.required' => 'Tanggal Pinjam tidak boleh kosong!',
            'id_buku.required' => 'Total Pinjam tidak boleh kosong!',
            'tgl_harus_kembali.required' => 'Total Pinjam tidak boleh kosong!',
            'tgl_kembali.required' => 'Total Pinjam tidak boleh kosong!',
            'status.required' => 'Total Pinjam tidak boleh kosong!',
            'jumlah_kembali_buku.required' => 'Total Pinjam tidak boleh kosong!',
            'denda.required' => 'Total Pinjam tidak boleh kosong!',
        ]);

        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->id_anggota       =$request->input('id_anggota');
        $pengembalian->id_petugas             =$request->input('id_petugas');
        $pengembalian->id_petugas             =$request->input('id_petugas');
        $pengembalian->id_buku             =$request->input('id_buku');
        $pengembalian->tgl_harus_kembali             =$request->input('tgl_harus_kembali');
        $pengembalian->tgl_kembali             =$request->input('tgl_kembali');
        $pengembalian->status             =$request->input('status');
        $pengembalian->jumlah_kembali_buku             =$request->input('jumlah_kembali_buku');
        $pengembalian->denda             =$request->input('denda');
        $pengembalian->save();

        session()->flash('success', 'Data Berhasil Dirubah');
        return redirect()->route('pengembalian.index')->with([
        'message' => 'Data Berhasil Dirubah',
        'type' => 'warning'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pengembalian = Pengembalian::findOrFail($id);
        $pengembalian->delete();
        return redirect()->route('pengembalian.index')->with([
        'message' => 'Data Berhasil Dihapus',
        'type' => 'danger'
        ]);
    }
}
