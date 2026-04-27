<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{auth()->user()->name}}</p>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>

        @if (auth()->user()->role == "admin")
        <li>
          <a href="{{ route('admin.dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ route('kategori.index') }}">
            <i class="fa fa-files-o"></i>
            <span>Kategori Buku</span>
          </a>
        </li>
        <li>
          <a href="{{route('buku.index')}}">
            <i class="fa fa-th"></i> <span>Daftar Buku</span>
          </a>
        </li>
        <li>
          <a href="{{route('peminjam.index')}}">
            <i class="fa fa-pie-chart"></i>
            <span>Daftar Peminjam</span>
          </a>
        </li>
        <li>
          <a href="{{route('peminjaman.index')}}">
            <i class="fa fa-laptop"></i>
            <span>Peminjaman</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-edit"></i> <span>Laporan</span>
          </a>
        </li>

      @elseif (auth()->user()->role == "petugas")
        <li>
          <a href="{{ route('petugas.dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ route('kategori.index') }}">
            <i class="fa fa-files-o"></i>
            <span>Kategori Buku</span>
          </a>
        </li>
        <li>
          <a href="{{route('buku.index')}}">
            <i class="fa fa-th"></i> <span>Daftar Buku</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Peminjaman</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-edit"></i> <span>Laporan</span>
          </a>
        </li>

      @else
        <li>
          <a href="{{ route('peminjam.dashboard') }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
        </li>
        <li>
          <a href="{{route('buku.index')}}">
            <i class="fa fa-th"></i> <span>Daftar Buku</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class="fa fa-laptop"></i>
            <span>Koleksi Buku Saya</span>
          </a>
        </li>
        @endif
        </ul>
    </section>

    <!-- /.sidebar -->
  </aside>