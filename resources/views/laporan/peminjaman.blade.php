@extends('layouts.app')

@section('title')
    Laporan Peminjaman
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
        <h3 class="box-title text-center text-bold">Laporan Peminjaman & Denda</h3>
    </div>

    <div class="box-body">

        <table id="tabelLaporan" class="table table-striped table-bordered">
            <thead>
                <tr class="bg-primary text-white text-center">
                    <th>Tanggal Pinjam</th>
                    <th>Nama</th>
                    <th>Buku</th>
                    <th>Status</th>
                    <th>Denda Telat</th>
                    <th>Denda Hilang</th>
                    <th>Total Denda</th>
                </tr>
            </thead>

            <tbody>
                @foreach($peminjamans as $item)
                <tr class="text-center">
                    
                    <td class="text-left">{{ $item->tanggal_peminjaman->translatedFormat('l, d F Y') }}</td>
                    <td class="text-left">{{ $item->user->name }}</td>
                    <td class="text-left">{{ $item->buku->judul }}</td>

                    {{-- STATUS --}}
                    <td>
                        @if($item->status == 'dipinjam')
                            <span class="badge bg-yellow">Dipinjam</span>
                        @elseif($item->status == 'dikembalikan')
                            <span class="badge bg-green">Dikembalikan</span>
                        @elseif($item->status == 'hilang')
                            <span class="badge bg-red">Hilang</span>
                        @endif
                    </td>

                    {{-- DENDA TELAT --}}
                    <td class="text-right">
                        Rp{{ number_format($item->denda_telat ?? 0, 0, ',', '.') }}
                    </td>

                    {{-- DENDA HILANG --}}
                    <td class="text-right">
                        Rp{{ number_format($item->denda_hilang ?? 0, 0, ',', '.') }}
                    </td>

                    {{-- TOTAL DENDA --}}
                    <td class="text-right">
                        @php
                            $total = ($item->denda_telat ?? 0) + ($item->denda_hilang ?? 0);
                        @endphp

                        <b>Rp{{ number_format($total, 0, ',', '.') }}</b>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

    </div>
</div>

@endsection