@extends('layouts.app')

@section('title')
    Daftar Peminjam
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
        <h3 class="box-title text-center text-bold">Daftar Peminjam</h3>
    </div>

    <div class="box-body">
        <table id="tabelPeminjam" class="table table-striped table-bordered">
            <thead>
                 <tr class="bg-primary text-white">
                    <th class="text-center">Nama</th>
                    <th class="text-center">Username</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($peminjams as $peminjam)
                <tr>
                    <td class="text-left">{{ $peminjam->name }}</td>
                    <td class="text-left">{{ $peminjam->username }}</td>
                    <td class="text-left">{{ $peminjam->email }}</td>
                    <td class="text-center">
                        <a href="{{ route('peminjam.edit', $peminjam->id) }}" class="btn btn-warning btn-sm">
                            <i class="fa fa-edit"></i> Edit
                        </a>

                        <form action="{{ route('peminjam.destroy', $peminjam->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapusnya?')">
                                <i class="fa fa-trash"></i> Hapus
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection