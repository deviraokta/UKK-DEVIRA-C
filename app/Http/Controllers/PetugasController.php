<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
   public function Petugas()
   {
   $buku =Buku::count();
        $peminjaman = Peminjaman::where('status', 'dipinjam')->count();
        $kategori = Kategori::count();

        return view('petugas.dashboard', compact('buku', 'peminjaman', 'kategori'));
   }
}
