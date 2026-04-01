<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Services\BukuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BukuController extends Controller
<<<<<<< HEAD
{   
     public function __construct(
        protected BukuService $bukuService,
    ) {}
=======
{
    public function __construct(
        protected BukuService $bukuService,
    ) {}

>>>>>>> 93ddcaad7d199c78d83d6c6eb9a7a0b47450af81
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = $this->bukuService->findAll();
<<<<<<< HEAD
        return view('buku.index', compact('buku')); 
=======

        return view('buku.index', compact('buku'));
>>>>>>> 93ddcaad7d199c78d83d6c6eb9a7a0b47450af81
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
<<<<<<< HEAD
         return view('buku.create', [
=======
        return view('buku.create', [
>>>>>>> 93ddcaad7d199c78d83d6c6eb9a7a0b47450af81
            'buku' => new Buku(),
            'action' => route('buku.store'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
<<<<<<< HEAD
       ]);
=======
        ]);
>>>>>>> 93ddcaad7d199c78d83d6c6eb9a7a0b47450af81

        try {
            $buku = new Buku();
            $buku->fill($request->except('image'));
            $this->bukuService->createWithImage($buku, $request->file('image'));
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }

        return redirect()->route('buku.index')->with([
            'message' => 'Data Berhasil Ditambahkan',
            'type' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $buku = $this->bukuService->findById($id);

        if (!$buku) {
            abort(404);
<<<<<<< HEAD
        }       
        return view('buku.show', compact('buku'));
    }

      public function image(Buku $buku)
=======
        }

        return view('buku.show', compact('buku'));
    }

    public function image(Buku $buku)
>>>>>>> 93ddcaad7d199c78d83d6c6eb9a7a0b47450af81
    {
        if (!$buku->image || !Storage::disk('public')->exists($buku->image)) {
            abort(404);
        }

        return response()->file(Storage::disk('public')->path($buku->image));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = $this->bukuService->findById($id);

        if (!$buku) {
            abort(404);
        }

        return view('buku.update', [
            'buku' => $buku,
            'action' => route('buku.update', $buku->id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

<<<<<<< HEAD
         $buku = $this->bukuService->findById($id);
=======
        $buku = $this->bukuService->findById($id);
>>>>>>> 93ddcaad7d199c78d83d6c6eb9a7a0b47450af81

        if (!$buku) {
            abort(404);
        }

<<<<<<< HEAD
         try {
=======
        try {
>>>>>>> 93ddcaad7d199c78d83d6c6eb9a7a0b47450af81
            $buku->fill($request->except('image'));
            $this->bukuService->updateWithImage($buku, $request->file('image'));
        } catch (ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();
        }

        return redirect()->route('buku.index')->with([
            'message' => 'Data Berhasil Dirubah',
            'type' => 'warning'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = $this->bukuService->findById($id);

        if (!$buku) {
            abort(404);
        }

        $this->bukuService->delete($buku);
<<<<<<< HEAD
        
=======

>>>>>>> 93ddcaad7d199c78d83d6c6eb9a7a0b47450af81
        return redirect()->route('buku.index')->with([
            'message' => 'Data Berhasil Dihapus',
            'type' => 'danger'
        ]);
    }
}
