@extends('layouts.app')

@section('title')
Tambah Kategori
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
<div class="box">
    <div class="box-header">
        <h3 class="box-title">Tambah Kategori</h3>
    </div>
    <div class="box-body">

        <form action="{{ route('kategori.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" placeholder="masukan nama kategori" required>
                
                    @if($errors->any())
                    <div class="alert alert-danger">
                    {{ $errors->first() }}</div>
                    @endif
            </div>

            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
        </form>

    </div>
</div>
@endsection
            