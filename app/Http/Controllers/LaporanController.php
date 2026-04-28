<?php

namespace App\Http\Controllers;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function laporanPeminjaman()
    {
         $peminjamans = Peminjaman::with(['user', 'buku'])->get();

    return view('laporan.peminjaman', compact('peminjamans'));
    }
}
