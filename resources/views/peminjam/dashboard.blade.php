@extends('layouts.app')

@section('title')
    Dashboard Peminjam
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

        <h3 class="text-center">Selamat Datang, {{ auth()->user()->name }}!</h3>

    <div class="box">
    <div class="box-header">
    <h3 class="box-title text-bold text-center">Riwayat Peminjaman</h3>
    <div class="box-body">
        <table class="table">
            <thead>
                <tr class="bg-primary text-white">
                    <th class="text-center">Buku</th>
                    <th class="text-center">Tanggal Pinjam</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                <tr class="text-center">
                    <td class="text-left">{{ $item->buku->judul }}</td>
                    <td class="text-left">{{ $item->tanggal_peminjaman->translatedFormat('l, d F Y') }}</td>
                    <td>
                        @if($item->status == 'dipinjam')
                            @if(now()->gt($item->tanggal_jatuh_tempo))
                                <span class="badge bg-red">Terlambat</span>
                            @else
                                <span class="badge bg-yellow">Dipinjam</span>
                            @endif
                        @elseif($item->status == 'dikembalikan')
                            <span class="badge bg-green">Dikembalikan</span>
                        @elseif($item->status == 'hilang')
                            <span class="badge bg-red">Hilang</span>
                        @endif
                    </td>
                    <td class="text-center">
                    <button class="btn btn-am btn-secondary" data-toggle="modal" data-target="#ulasan{{ $item->id }}"><i class="fa fa-comment"></i> Beri Ulasan</button>
                    <div class="modal fade" id="ulasan{{ $item->id}}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4>Ulasan Buku - {{ $item->buku->judul}}</h4>
                                </div>
                                <div class="modal-body">
                                    <form action="{{route('ulasan.store', $item->buku->id)}}" method="POST">
                                        @csrf
                                        <div class="form-group">
                                               <div class="form-group">
                                        <textarea name="isi_ulasan" class="form-control" placeholder="Tulis ulasan..." required></textarea>
                                    </div>
                                     <div class="form-group">
                                            <label>Rating</label>
                                        <select name="rating" class="form-control" required>
                                            <option value="">Pilih Rating</option>
                                            <option value="1">Sangat Buruk</option>
                                            <option value="2">Buruk</option>
                                            <option value="3">Cukup</option>
                                            <option value="4">Baik</option>
                                            <option value="5">Sangat Baik</option>
                                        </select>
                                    </div>
                                     <button class="btn btn-primary btn-sm"><i class="fa fa-paper-plane"></i> Kirim</button>
                                </form>
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