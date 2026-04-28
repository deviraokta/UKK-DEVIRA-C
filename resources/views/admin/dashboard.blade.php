@extends('layouts.app')

@section('title')
Dashboard Admin
@endsection
@section('content')

<h3 class="text-center">Selamat Datang, {{ auth()->user()->name }}!</h3>
    <section class="content">
      <div class="row">
        <div class="col-lg-3 col-xs-6">
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
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>{{$peminjam}}</h3>

              <p>TOTAL PEMINJAM</p>
            </div>
            <div class="icon">
              <i class="fa fa-users"></i>
            </div>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
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
        <div class="col-lg-3 col-xs-6">
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