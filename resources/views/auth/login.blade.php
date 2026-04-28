<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login Sipikupustakaku</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href={{ asset('AdminLTE/bower_components/bootstrap/dist/css/bootstrap.min.css') }}>
  <!-- Font Awesome -->
  <link rel="stylesheet" href={{ asset('AdminLTE/bower_components/font-awesome/css/font-awesome.min.css') }}>
  <!-- Ionicons -->
  <link rel="stylesheet" href={{ asset('AdminLTE/bower_components/Ionicons/css/ionicons.min.css') }}>
  <!-- Theme style -->
  <link rel="stylesheet" href={{ asset('AdminLTE/dist/css/AdminLTE.min.css') }}>
  <!-- iCheck -->
  <link rel="stylesheet" href={{ asset('AdminLTE/plugins/iCheck/square/blue.css') }}>


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
  <!-- Google Font -->
  <link rel="stylesheet" href={{ asset('AdminLTE/https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic') }}>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a><b>SI Pinjam Buku Pustakaku</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Login dan Masuk ke Akun Anda</p>

    <form action="{{ route('login.submit') }}" method="post">
        @csrf
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Username" name="username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
     <p class="text-center"> - OR - </p>
    <a href="{{ route('register') }}" class="text-center">Daftar sebagai pengguna baru</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="{{ asset('AdminLTE/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('AdminLTE/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- iCheck -->
<script src="{{ asset('AdminLTE/plugins/iCheck/icheck.min.js') }}"></script>
</body>
</html>
