@extends('layouts.app')

@section('title')
    Dashboard Petugas
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

        <h3 class="text-center">Selamat Datang, {{ auth()->user()->name }}!</h3>

  <section class="content">
      <!-- Small boxes (Stat box) -->
       <!-- <p class="text-center">Selamat Datang !! </p>-->
      <div class="row">
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>{{$buku}}</h3>

              <p>TOTAL BUKU</p>
            </div>
            <div class="icon">
              <i class="fa fa-book"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>{{$kategori}}</h3>

              <p>TOTAL KATEGORI</p>
            </div>
            <div class="icon">
              <i class="fa fa-tags"></i>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-xs-12">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$peminjaman}}</h3>

              <p>TOTAL BUKU DIPINJAM</p>
            </div>
            <div class="icon">
              <i class="fa fa-folder"></i>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
    </section>
@endsection