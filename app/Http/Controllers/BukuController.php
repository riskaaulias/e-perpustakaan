<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Services\BukuService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class BukuController extends Controller
{   
     public function __construct(
        protected BukuService $bukuService,
    ) {}
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buku = $this->bukuService->findAll();
        return view('buku.index', compact('buku')); 
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         return view('buku.create', [
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
       ]);

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
        }       
        return view('buku.show', compact('buku'));
    }

      public function image(Buku $buku)
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

         $buku = $this->bukuService->findById($id);

        if (!$buku) {
            abort(404);
        }

         try {
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
        
        return redirect()->route('buku.index')->with([
            'message' => 'Data Berhasil Dihapus',
            'type' => 'danger'
        ]);
    }
}