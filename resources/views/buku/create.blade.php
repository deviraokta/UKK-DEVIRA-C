@extends('layouts.app')

@section('title')
    Tambah Buku
@endsection
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tambah Buku</h3>
    </div>
    <div class="box-body">

        <form action="{{ route('buku.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" placeholder="masukan judul buku" required>
            </div>

            <div class="form-group">
                <label>Penulis</label>
                <input type="text" name="penulis" class="form-control" placeholder="masukan nama penulis" required>
            </div>

            <div class="form-group">
                <label>Penerbit</label>
                <input type="text" name="penerbit" class="form-control" placeholder="masukan nama penerbit" required>
            </div>

            <div class="form-group">
                <label>Tahun Terbit</label>
                <input type="number" name="tahun_terbit" class="form-control" placeholder="masukan tahun terbit" required>
            </div>

            <div class="form-group">
                <label>Stok</label>
                <input type="number" name="stok" class="form-control" placeholder="masukan stok minimal 1" required>
            </div>
            <div class="form-group">
                <label>Kategori</label>
                    <select name="kategori_id" class="form-control" required>
                    <option value="">Pilih Kategori</option>
                @foreach($kategoris as $kategori)
                    <option value="{{ $kategori->id }}">
                {{ $kategori->nama_kategori }}
            </option>
        @endforeach
    </select>
</div>

            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        </form>

    </div>
</div>
@endsection