@extends('layouts.app')

@section('title')
    Koleksi Saya
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

 @if (auth()->user()->role == 'peminjam') 
@endif
<table class="table">
    <thead>
        <tr>
            <th>Buku</th>
            <th>Penulis</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $item->buku->judul }}</td>
            <td>{{ $item->buku->penulis }}</td>
            <td>{{ $item->buku->kategori->nama_kategori ?? 'Kategori tidak ditemukan' }}</td>
            <td>
                <form action="{{ route('pinjam.buku', $item->buku->id) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Yakin ingin meminjam buku ini?')">Pinjam Sekarang</button>
                </form>
                <form action="{{route('koleksi.destroy', $item->id)}}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus buku dari koleksi?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach

    </tbody>
</table>
@endsection