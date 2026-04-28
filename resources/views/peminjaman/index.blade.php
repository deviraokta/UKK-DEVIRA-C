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

<div class="box box-primary">
    <div class="box-header with-border">
        <h3 class="box-title text-center text-bold">Data Peminjaman</h3>
    </div>

    <div class="box-body">
        <table id="tabelPeminjaman" class="table table-striped table-bordered">
            <thead>
                <tr class="bg-primary text-white text-center">
                    <th>Nama</th>
                    <th>Buku</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tempo Kembali</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($peminjamans as $p)
                <tr class="text-center">
                    <td class="text-left">{{ $p->user->name }}</td>
                    <td class="text-left">{{ $p->buku->judul }}</td>
                    <td class="text-left">{{ $p->tanggal_peminjaman ->translatedFormat('l, d F Y') }}</td>
                    <td class="text-left">{{ $p->tanggal_jatuh_tempo ->translatedFormat('l, d F Y') }}</td>
                    <td class="text-left">{{ $p->tanggal_pengembalian ? $p->tanggal_pengembalian->translatedFormat('l, d F Y') : '-' }}</td>

                    {{-- STATUS --}}
                    <td>
                        @if($p->status == 'dipinjam')
                            @if(now()->gt($p->tanggal_jatuh_tempo))
                                <span class="badge bg-red">Terlambat</span>
                            @else
                                <span class="badge bg-yellow">Dipinjam</span>
                            @endif
                        @elseif($p->status == 'dikembalikan')
                            <span class="badge bg-green">Dikembalikan</span>
                        @elseif($p->status == 'hilang')
                            <span class="badge bg-red">Hilang</span>
                        @endif
                    </td>

                    {{-- DENDA --}}
                    <td class="text-right">
                        @php
                            $totalDenda = ($p->denda_telat ?? 0) + ($p->denda_hilang ?? 0);
                        @endphp

                        @if($totalDenda > 0)
                            <span class="text-danger">
                                Rp{{ number_format($totalDenda, 0, ',', '.') }}
                            </span>
                        @else
                            -
                        @endif
                    </td>

                    {{-- AKSI --}}
                    <td class="text-center">
                        @if($p->status == 'dipinjam' && (auth()->user()->role == 'admin' || auth()->user()->role == 'petugas'))
                            
                            {{-- KEMBALIKAN --}}
                            <form action="{{ route('kembalikan.buku', $p->id)}}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="status" value="dikembalikan">
                                <button type="submit" class="btn btn-success btn-sm"
                                    onclick="return confirm('Yakin buku dikembalikan?')">
                                    Kembalikan
                                </button>
                            </form>

                            {{-- HILANG --}}
                            <form action="{{ route('kembalikan.buku', $p->id)}}" method="POST" style="display:inline;">
                                @csrf
                                <input type="hidden" name="status" value="hilang">
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Yakin buku hilang?')">
                                    Hilang
                                </button>
                            </form>

                        @else
                            <span class="badge bg-blue">Selesai</span>
                        @endif
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection