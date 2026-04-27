@extends('layouts.app')

@section('title')
    Data Peminjaman
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

 @if (auth()->user()->role == 'admin' || auth()->user()->role == 'petugas')
 @endif
<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Tempo Kembali</th>
            <th>Tanggal Kembali</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjamans as $p)
        <tr>
             <td>{{ $p->user->nama }}</td>
            <td>{{ $p->buku->judul }}</td>
            <td>{{ $p->tanggal_peminjaman }}</td>
            <td>{{ $p->tanggal_jatuh_tempo }}</td>
            <td>{{ $p->tanggal_pengembalian }}</td>
            <td>
                @if($p->status == 'dipinjam')
                    @if(now()->gt($p->tanggal_jatuh_tempo))
                        <span class="badge bg-red">Terlambat</span>
                    @else
                        <span class="badge bg-yellow">Dipinjam</span>
                    @endif
                @else
                    <span class="badge bg-green">Dikembalikan</span>
                @endif
            </td>
                <td>
                @if($p->status == 'dipinjam' && (auth()->user()->role == 'admin' || auth()->user()->role == 'petugas'))
                <form action="{{ route('kembalikan.buku', $p->id)}}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="badge bg-secondary" onclick="return confirm('Yakin tandai buku sudah dikembalikan?')">Kembalikan</button>
                </form>  
                @else
                <span class="badge bg-blue">Sudah dikembalikan</span>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection