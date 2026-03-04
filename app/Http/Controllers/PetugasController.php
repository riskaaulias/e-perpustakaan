<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $petugas = Petugas::all();
        return view('petugas.index', compact('petugas')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_petugas' => 'required|string|max:255',
            'alamat_petugas' => 'required|string|max:255',
            'telpon_petugas' => 'required|string|max:255',
        ], [
            'nama_petugas.required' => 'Nama petugas tidak boleh kosong!',
            'alamat_petugas.required' => 'Alamat petugas tidak boleh kosong!',
            'telpon_petugas.required' => 'Telpon petugas tidak boleh kosong!',
        ]);

        $petugas = new Petugas;
        $petugas->nama_petugas       =$request->input('nama_petugas');
        $petugas->alamat_petugas             =$request->input('alamat_petugas');
        $petugas->telpon_petugas             =$request->input('telpon_petugas');
        $petugas->save();

        session()->flash('success', 'Data Berhasil Ditambahkan');
        return redirect()->route('petugas.index')->with([
        'message' => 'Data Berhasil Ditambahkan',
        'type' => 'success'
        ]);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
