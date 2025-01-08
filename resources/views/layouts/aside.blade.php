<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="">Alfaduro</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">Af</a>
    </div>
    <ul class="sidebar-menu">
      <li><a class="nav-link" href="/"><i class="fas fa-columns"></i> <span>Dashboard</span></a></li>
      <li><a class="nav-link" href="{{ route('transaksi.index') }}"><i class="fas fa-shopping-basket"></i> <span>Transaksi</span></a></li>
      <li><a class="nav-link" href="{{ route('riwayat.index') }}"><i class="fas fa-history"></i> <span>Riwayat</span></a></li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-tasks"></i> <span>Kelola</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('barang.index') }}">Barang</a></li>
          <li><a class="nav-link" href="{{ route('kategori.index') }}">Kategori</a></li>
          <li><a class="nav-link" href="{{ route('merek.index') }}">Merek</a></li>
          <li><a class="nav-link" href="{{ route('satuan.index') }}">Satuan</a></li>
          <li><a class="nav-link" href="{{ route('jenispembayaran.index') }}">Jenis Pembayaran</a></li>
          <li><a class="nav-link" href="{{ route('jenispembayaran.index') }}">Layanan Pemesanan</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-address-book"></i> <span>Manajemen</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('pegawai.index') }}">Pegawai</a></li>
          <li><a class="nav-link" href="">Jabatan</a></li>
          <li><a class="nav-link" href="{{ route('supplier.index') }}">Supplier</a></li>
        </ul>
      </li>
      <li class="dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book-open"></i> <span>Pengadaan</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ route('rencana.index') }}">Rencana</a></li>
          <li><a class="nav-link" href="{{ route('realisasi.index') }}">Realisasi</a></li>
          <li><a class="nav-link" href="{{ route('return.index') }}">Return Barang</a></li>
        </ul>
      </li>
      </aside>