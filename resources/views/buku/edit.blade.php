@extends('layouts.app')

@section('title')
    Edit Buku
@endsection
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Edit Buku</h3>
    </div>
    <div class="box-body">
        
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
        <form action="{{ route('buku.update', $buku->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ $buku->judul }}">
            </div>

            <div class="form-group">
                <label>Penulis</label>
                <input type="text" name="penulis" class="form-control" value="{{ $buku->penulis }}">
            </div>

            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" name="penerbit" class="form-control" value="{{ $buku->penerbit }}">
            </div>

            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="form-control" value="{{ $buku->tahun_terbit }}">
            </div>

            <div class="form-group">
    <label>Kategori</label>
    <select name="kategori_id" class="form-control">
        @foreach($kategoris as $kategori)
            <option value="{{ $kategori->id }}"
                {{ $buku->kategori_id == $kategori->id ? 'selected' : '' }}>
                {{ $kategori->nama_kategori }}
            </option>
        @endforeach
    </select>
</div>

            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
        </form>

    </div>
</div>
@endsection