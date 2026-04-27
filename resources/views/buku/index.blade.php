@extends('layouts.app')

@section('title')
@endsection

@section('content')
@if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('error') }}
    </div>
@endif

<h3 class="box-title text-center text-bold">Daftar Buku</h3>

<div class="box-body">
    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'petugas')
    <a href="{{ route('kategori.create') }}" class="btn btn-info"><i class="fa fa-plus"></i> Tambah Kategori</a>
@endif
    <br><br>
<table class="table table-striped table-bordered">
    <thead>
        <tr class="bg-primary text-white">
            <th class="text-center">Judul</th>
            <th class="text-center">Penulis</th>
            <th class="text-center">Penerbit</th>
            <th class="text-center">Tahun Terbit</th>
            <th class="text-center">Kategori</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bukus as $buku)
        <tr>
            <td>{{ $buku->judul }}</td>
            <td>{{ $buku->penulis }}</td>
            <td>{{ $buku->penerbit }}</td>
            <td>{{ $buku->tahun_terbit }}</td>
            <td>{{ $buku->kategori->nama_kategori ?? 'Kategori tidak ditemukan' }}</td> <!-- Ganti dengan nama kategori jika relasi sudah dibuat -->
            <td>
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'petugas')
                <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
            @endif

            @if (auth()->user()->role == 'admin')
                <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapusnya?')"><i class="fa fa-trash"></i> Hapus</button>
                </form>
            @endif

                @if (auth()->user()->role == 'peminjam')
                <form action="{{ route('pinjam.buku', $buku->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Yakin ingin meminjam buku ini?')"><i class="fa fa-book"></i> Pinjam</button>
                </form>
            @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection