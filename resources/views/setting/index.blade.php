@extends('layouts.app')

@section('title')
    Pengaturan Denda
@endsection
@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="box box-primary">
    <div class="box-header">
        <h3 class="box-title text-bold">Pengaturan Denda</h3>
    </div>

    <div class="box-body">
        <form action="{{ route('setting.update') }}" method="POST">
            @csrf

            <div class="form-group">
                <label>Denda Telat</label>
                <input type="number" name="denda_per_hari" class="form-control"
                       value="{{ $setting->denda_per_hari }}" required>
                <p><span>*dihitung per hari</span></p>
            </div>

            <div class="form-group">
                <label>Denda Hilang</label>
                <input type="number" name="denda_hilang" class="form-control"
                       value="{{ $setting->denda_hilang }}" required>
            </div>

            <button class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
        </form>
    </div>
</div>

@endsection