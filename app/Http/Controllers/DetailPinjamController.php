<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Detail_Pinjam;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DetailPinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detail_pinjam = Detail_Pinjam::all();
        return view('detail_pinjam.index', compact('detail_pinjam'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $buku = Buku::all();
        $detail_pinjam = Detail_Pinjam::all();
        $peminjaman = Peminjaman::all();
        return view('detail_pinjam.create', compact('buku', 'detail_pinjam', 'peminjaman'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $peminjaman = Peminjaman::findOrFail($request->id_peminjaman);

         $request->validate([
            'id_peminjaman' => 'required|string|max:255',
            'id_buku' => 'required|string|max:255',
            'maks_pinjam' => 'required|string|max:255',
        ], [
            'id_peminjaman.required' => 'Tidak boleh kosong!',
            'id_buku.required' => 'Tidak boleh kosong!',
            'maks_pinjam.required' => 'Maksimal Pinjam tidak boleh kosong!',
        ]);

        $detail_pinjam = new Detail_Pinjam;
        $detail_pinjam->id_peminjaman       =$request->input('id_peminjaman');
        $detail_pinjam->id_buku             =$request->input('id_buku');
        $detail_pinjam->maks_pinjam             =$request->input('maks_pinjam');
        $detail_pinjam->jumlah_buku             =$request->input('jumlah_buku');
        $detail_pinjam->jumlah_buku   = $peminjaman->total_pinjam;
        $detail_pinjam->save();

        session()->flash('success', 'Data Berhasil Ditambahkan');
        return redirect()->route('detail_pinjam.index')->with([
        'message' => 'Data Berhasil Ditambahkan',
        'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $detail_pinjam = Detail_Pinjam::findOrFail($id);
        return view('detail_pinjam.show', compact('detail_pinjam'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $detail_pinjam = Detail_Pinjam::findOrFail($id);
        $peminjaman = Peminjaman::all();
        $buku = Buku::all();
        return view('detail_pinjam.edit', compact('detail_pinjam', 'buku', 'peminjaman'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_peminjaman' => 'required',
            'id_buku'       => 'required',
            'maks_pinjam'   => 'required',
        ]);

        $peminjaman = Peminjaman::findOrFail($request->id_peminjaman);

        $detail_pinjam = Detail_Pinjam::findOrFail($id);
        $detail_pinjam->id_peminjaman = $request->id_peminjaman;
        $detail_pinjam->id_buku       = $request->id_buku;
        $detail_pinjam->maks_pinjam   = $request->maks_pinjam;
        $detail_pinjam->jumlah_buku   = $peminjaman->total_pinjam;
        $detail_pinjam->save();

        return redirect()->route('detail_pinjam.index')->with([
            'message' => 'Data Berhasil Dirubah',
            'type' => 'warning'
    ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $detail_pinjam = Detail_Pinjam::findOrFail($id);
        $detail_pinjam->delete();
        return redirect()->route('detail_pinjam.index')->with([
        'message' => 'Data Berhasil Dihapus',
        'type' => 'danger'
        ]);
    }
}
