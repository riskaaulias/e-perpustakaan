<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggota = Anggota::all();
        return view('anggota.index', compact('anggota')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('anggota.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_anggota' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telpon' => 'required|string|max:255',
            'NIM' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ], [
            'nama_anggota.required' => 'Nama tidak boleh kosong!',
            'alamat.required' => 'Alamat tidak boleh kosong!',
            'telpon.required' => 'Telpon tidak boleh kosong!',
            'NIM.required' => 'NIM tidak boleh kosong!',
            'status.required' => 'Status tidak boleh kosong!',
        ]);

        $anggota = new Anggota;
        $anggota->nama_anggota       =$request->input('nama_anggota');
        $anggota->alamat             =$request->input('alamat');
        $anggota->telpon             =$request->input('telpon');
        $anggota->NIM             =$request->input('NIM');
        $anggota->status             =$request->input('status');
        $anggota->save();

        session()->flash('success', 'Data Berhasil Ditambahkan');
        return redirect()->route('anggota.index')->with([
        'message' => 'Data Berhasil Ditambahkan',
        'type' => 'success'
    ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.show', compact('anggota'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
            'nama_anggota' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'telpon' => 'required|string|max:255',
            'NIM' => 'required|string|max:255',
            'status' => 'required|string|max:255',
        ], [
            'nama_anggota.required' => 'Nama tidak boleh kosong!',
            'alamat.required' => 'Alamat tidak boleh kosong!',
            'telpon.required' => 'Telpon tidak boleh kosong!',
            'NIM.required' => 'NIM tidak boleh kosong!',
            'status.required' => 'Status tidak boleh kosong!',
        ]);

        $anggota = Anggota::findOrFail($id);
        $anggota->nama_anggota       =$request->input('nama_anggota');
        $anggota->alamat             =$request->input('alamat');
        $anggota->telpon             =$request->input('telpon');
        $anggota->NIM             =$request->input('NIM');
        $anggota->status             =$request->input('status');
        $anggota->save();

        session()->flash('success', 'Data Berhasil Dirubah');
        return redirect()->route('anggota.index')->with([
        'message' => 'Data Berhasil Dirubah',
        'type' => 'warning'
    ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        $anggota->delete();
        return redirect()->route('anggota.index')->with([
        'message' => 'Data Berhasil Dihapus',
        'type' => 'danger'
        ]);
    }
}
