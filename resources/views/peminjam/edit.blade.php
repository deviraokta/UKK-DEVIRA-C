@extends('layouts.app')

@section('title')
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
        <h3 class="box-title">Edit Peminjam</h3>
    </div>
    <div class="box-body">
        <form action="{{ route('peminjam.update', $peminjam->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama Peminjam</label>
                <input type="text" name="nama" class="form-control" value="{{old('nama', $peminjam->name) }}">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="{{ old('username', $peminjam->username) }}">  
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $peminjam->email) }}">
            </div>
            <div class="form-group">
                <label>Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" name="password" class="form-control" placeholder=" masukan minimal 6">
            </div>

            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Update</button>
        </form>

    </div>
</div>
@endsection