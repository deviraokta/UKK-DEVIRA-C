@extends('layouts.app')

@section('title')
Edit Kategori
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
        <h3 class="box-title">Edit Kategori</h3>
    </div>
    <div class="box-body">
        
@if(session('success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        {{ session('success') }}
    </div>
@endif
        <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Kategori</label>
                <input type="text" name="nama_kategori" class="form-control" value="{{ $kategori->nama_kategori }}">
            </div>

            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
        </form>

    </div>
</div>
@endsection