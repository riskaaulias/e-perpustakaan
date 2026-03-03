<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = Buku::all();
        return view('buku.index', compact('buku'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'kode_buku' => 'required|string|max:255',
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
            'stok' => 'required|string|max:255',
            'dipinjam' => 'required|string|max:255',
            'tersedia' => 'required|string|max:255',

        ], [
            'kode_buku.required' => 'Kode buku tidak boleh kosong!',
            'judul_buku.required' => 'Judul buku tidak boleh kosong!',
            'pengarang.required' => 'Pengarang tidak boleh kosong!',
            'penerbit.required' => 'Penerbit tidak boleh kosong!',
            'tahun.required' => 'Tahun tidak boleh kosong!',
            'stok.required' => 'Stok tidak boleh kosong!',
            'dipinjam.required' => 'Jumlah pinjam tidak boleh kosong!',
            'tersedia.required' => 'Jumlah tersedia tidak boleh kosong!',

        ]);

        $buku = new Buku;
        $buku->kode_buku       =$request->input('kode_buku');
        $buku->judul_buku             =$request->input('judul_buku');
        $buku->pengarang             =$request->input('pengarang');
        $buku->penerbit             =$request->input('penerbit');
        $buku->tahun             =$request->input('tahun');
        $buku->stok             =$request->input('stok');
        $buku->dipinjam             =$request->input('dipinjam');
        $buku->tersedia             =$request->input('tersedia');
        $buku->save();

        session()->flash('success', 'Data Berhasil Ditambahkan');
        return redirect()->route('buku.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'kode_buku' => 'required|string|max:255',
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun' => 'required|string|max:255',
            'stok' => 'required|string|max:255',
            'dipinjam' => 'required|string|max:255',
            'tersedia' => 'required|string|max:255',

        ], [
            'kode_buku.required' => 'Kode buku tidak boleh kosong!',
            'judul_buku.required' => 'Judul buku tidak boleh kosong!',
            'pengarang.required' => 'Pengarang tidak boleh kosong!',
            'penerbit.required' => 'Penerbit tidak boleh kosong!',
            'tahun.required' => 'Tahun tidak boleh kosong!',
            'stok.required' => 'Stok tidak boleh kosong!',
            'dipinjam.required' => 'Jumlah pinjam tidak boleh kosong!',
            'tersedia.required' => 'Jumlah tersedia tidak boleh kosong!',

        ]);

        $buku = Buku::findOrFail($id);
        $buku->kode_buku       =$request->input('kode_buku');
        $buku->judul_buku             =$request->input('judul_buku');
        $buku->pengarang             =$request->input('pengarang');
        $buku->penerbit             =$request->input('penerbit');
        $buku->tahun             =$request->input('tahun');
        $buku->stok             =$request->input('stok');
        $buku->dipinjam             =$request->input('dipinjam');
        $buku->tersedia             =$request->input('tersedia');
        $buku->save();

        session()->flash('success', 'Data Berhasil Dirubah');
        return redirect()->route('buku.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
