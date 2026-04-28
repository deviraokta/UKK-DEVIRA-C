<?php

namespace App\Http\Controllers;

use App\Models\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    public function store(Request $request, $id)
    {
        $cek =Ulasan::where('user_id', auth()->id())
        ->where('buku_id', $id)
        ->exists();

        if ($cek) {
            return back()->with('error', 'Sebelumya kamu sudah memberi ulasan');
        }

        Ulasan::create([
            'user_id' => auth()->id(),
            'buku_id' => $id,
            'isi_ulasan' => $request->isi_ulasan,
            'rating' => $request->rating
        ]);

        return back()->with('success', 'Ulasan berhasil ditambahkan');
    }
}
