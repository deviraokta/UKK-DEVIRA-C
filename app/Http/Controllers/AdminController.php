<?php

namespace App\Http\Controllers;
use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    public function admin()
    {
        $buku =Buku::count();
        $peminjam = User::where('role', 'peminjam')->count();
        $peminjaman = Peminjaman::where('status', 'dipinjam')->count();
        $kategori = Kategori::count();

        return view('admin.dashboard', compact('buku', 'peminjam', 'peminjaman', 'kategori'));
    }
}