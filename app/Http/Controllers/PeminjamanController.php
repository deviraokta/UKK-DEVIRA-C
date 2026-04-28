<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use App\Models\Setting;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    // 🔹 TAMPIL DATA
    public function index()
    {
        $peminjamans = Peminjaman::with('buku', 'user')->get();
        return view('peminjaman.index', compact('peminjamans'));
    }

    // 🔹 PINJAM BUKU
    public function pinjam($id)
    {
        $buku = Buku::findOrFail($id);

        // cek sudah pinjam
        $cek = Peminjaman::where('user_id', auth()->id())
            ->where('buku_id', $id)
            ->where('status', 'dipinjam')
            ->first();

        if ($cek) {
            return back()->with('error', 'Anda sudah meminjam buku ini.');
        }

        if ($buku->stok <= 0) {
            return back()->with('error', 'Stok buku habis.');
        }

        // kurangi stok
        $buku->decrement('stok');

        // simpan peminjaman
        Peminjaman::create([
            'user_id' => auth()->id(),
            'buku_id' => $id,
            'tanggal_peminjaman' => now(),
            'tanggal_jatuh_tempo' => now()->addDays(3),
            'status' => 'dipinjam'
        ]);

        return back()->with('success', 'Buku berhasil dipinjam.');
    }

    // 🔹 KEMBALIKAN / HILANG (FINAL TANPA FORM)
    public function kembalikan(Request $request, $id)
    {
        $peminjaman = Peminjaman::with('buku')->findOrFail($id);
        $setting = Setting::first();

        // validasi
        $request->validate([
            'status' => 'required|in:dikembalikan,hilang',
        ]);

        $status = $request->status;

        $dendaTelat = 0;
        $dendaHilang = 0;

        //hitung telat
        if ($status == 'dikembalikan') {
            if (now()->gt($peminjaman->tanggal_jatuh_tempo)) {
                $hariTelat = now()->diffInDays($peminjaman->tanggal_jatuh_tempo);
                $dendaTelat = $hariTelat * $setting->denda_per_hari;
            }
        }

        //denda hilang
        if ($status == 'hilang') {
            $dendaHilang = $setting->denda_hilang;
        }

        // update data
        $peminjaman->update([
            'tanggal_pengembalian' => now(),
            'status' => $status,
            'denda_telat' => $dendaTelat,
            'denda_hilang' => $dendaHilang,
        ]);

        // stok balik hanya kalau dikembalikan
        if ($status == 'dikembalikan') {
            $peminjaman->buku->increment('stok');
        }

        return back()->with('success', 
            'Berhasil diproses. Total denda: Rp ' . number_format($dendaTelat + $dendaHilang, 0, ',', '.')
        );
    }

    public function riwayat()
    {
        $data = Peminjaman::with('buku')
            ->where('user_id', auth()->id())
            ->get();

        return view('peminjam.dashboard', compact('data'));
    }
}