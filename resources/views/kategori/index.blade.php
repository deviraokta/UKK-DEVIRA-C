@extends('layouts.app')

@section('title')
    Daftar Kategori
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
<h3 class="box-title text-center text-bold">Daftar Kategori</h3>
    </div>
<div class="box-body">
    @if (auth()->user()->role == 'admin')
    <a href="{{ route('kategori.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Kategori</a>
@endif
    <br><br>
<table id="tabelKategori" class="table table-striped table-bordered">
    <thead>
        <tr class="bg-primary text-white">
            <th class="text-center">Nama Kategori</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($kategoris as $kategori)
        <tr>
            <td>{{ $kategori->nama_kategori }}</td>
            <td>
            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'petugas')
                <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
            @endif

            @if (auth()->user()->role == 'admin')
                <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapusnya?')"><i class="fa fa-trash"></i> Hapus</button>
                </form>
            @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
</div>
@endsection

