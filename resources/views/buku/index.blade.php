@extends('layouts.app')

@section('title')
    Daftar Buku
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

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title text-center text-bold">Daftar Buku</h3>
    </div>

<div class="box-body">
    @if (auth()->user()->role == 'admin' || auth()->user()->role == 'petugas')
    <a href="{{ route('buku.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Buku</a>
@endif
    <br><br>
<table id="tabelBuku" class="table table-striped table-bordered">
    <thead>
        <tr class="bg-primary text-white">
            <th class="text-center">Judul</th>
            <th class="text-center">Penulis</th>
            <th class="text-center">Penerbit</th>
            <th class="text-center">Tahun Terbit</th>
             <th class="text-center">Stok</th>
            <th class="text-center">Kategori</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bukus as $buku)
        <tr>
            <td class="text-left">{{ $buku->judul }}</td>
            <td class="text-left">{{ $buku->penulis }}</td>
            <td class="text-left">{{ $buku->penerbit }}</td>
            <td class="text-right">{{ $buku->tahun_terbit }}</td>
            <td class="text-right">{{ $buku->stok }}</td>
            <td class="text-left">{{ $buku->kategori->nama_kategori ?? 'Kategori tidak ditemukan' }}</td> <!-- Ganti dengan nama kategori jika relasi sudah dibuat -->
            <td class="text-center">
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
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ulasan{{$buku->id}}"><i class="fa fa-eye"></i> Lihat Ulasan</button>
                <div class="modal fade" id="ulasan{{ $buku->id}}">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h4>Ulasan Buku - {{ $buku->judul }}</h4>
                            </div>

                            <div class="modal-body">
                @forelse ($buku->ulasans as $item)
                    <p><b>{{ $item->user->name }}</b> </p>
                        <p> ⭐{{ $item->rating ?? '_'}}</p>
                    <p>{{ $item->isi_ulasan}}</p>
                    <hr>
                @empty
                    <p>Belum ada Ulasan</p>
                        @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection