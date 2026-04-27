<?php

namespace App\Http\Controllers;
use App\Models\Kategori;
use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bukus = Buku::with('kategori')->get();
        return view('buku.index', compact('bukus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kategoris =Kategori::all();
        $bukus = Buku::all();
        return view('buku.create', compact('kategoris', 'bukus'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'penulis' => 'required|string|max:255',
        'penerbit' => 'required|string|max:255',
        'tahun_terbit' => 'required|integer',
        'kategori_id' => 'required|exists:kategoris,id',
    ]);

    Buku::create([
        'judul' => $request->judul,
        'penulis' => $request->penulis,
        'penerbit' => $request->penerbit,
        'tahun_terbit' => $request->tahun_terbit,
        'kategori_id' => $request->kategori_id,
    ]);

    return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
}

    /**
     * Display the specified resource.
     */
    public function show(Buku $buku)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Buku $buku)
    {
        $bukus = Buku::FindOrFail($buku->id);
        $kategoris = Kategori::all();
        return view('buku.edit', compact('buku', 'kategoris', 'bukus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Buku $buku)
    {
        $bukus = Buku::FindOrFail($buku->id);
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);
        return redirect()->route('buku.index')->with('success', 'Buku berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Buku $buku)
    {
        $buku->delete();
        return redirect()->route('buku.index')->with('success', 'Buku berhasil dihapus.');
    }
}
