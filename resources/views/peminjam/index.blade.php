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

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Nama</th>
            <th>Username</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach($peminjams as $peminjam)
        <tr>
            <td>{{ $peminjam->name }}</td>
            <td>{{ $peminjam->username }}</td>
            <td>{{ $peminjam->email }}</td>
            <td>
                <a href="{{ route('peminjam.edit', $peminjam->id) }}" class="btn btn-sm btn-warning">Edit</a>

                <form action="{{ route('peminjam.destroy', $peminjam->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapusnya?')">Hapus</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection