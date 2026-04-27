<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $peminjamans = Peminjaman::with('buku', 'user')->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    public function pinjam($id)
    {
        $cek = Peminjaman::where('user_id', auth()->id())->where('buku_id', $id)->first();
        if ($cek) {
            return back()->with('error', 'Anda sudah meminjam buku ini.');
        }
        Peminjaman::create([
        'user_id' => auth()->id(),
        'buku_id' => $id,
        'tanggal_peminjaman' => now(),
        'tanggal_jatuh_tempo' => now()->addDays(7),
        'status' => 'dipinjam'
        ]);

        return back()->with('success', 'Buku berhasil dipinjam.');
    }

    public function kembalikan($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        
        $peminjaman->update([
            'tanggal_pengembalian' => now(),
            'status' => 'dikembalikan'
        ]);

        return back()->with('success', 'Buku berhasil dikembalikan.');
    }   


    public function riwayat()
    {
        $data =Peminjaman::with('buku')
        ->where('user_id', auth()->id())
        ->get();

        return view('peminjam.dashboard', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
