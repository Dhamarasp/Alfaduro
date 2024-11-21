<nav class="navbar navbar-expand-lg bg-dark text-light shadow-sm navbar-light">
    <div class="container">
        <a class="navbar-brand text-danger" href="#">Alfaduro</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon" style="filter: invert(1);"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('dashboard.index') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('transaksi.index') }}">Transaksi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('barang.index') }}">Barang</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('kategori.index') }}">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('brand.index') }}">Brand</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="{{ route('riwayat.index') }}">Riwayat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-light" href="#">Pembayaran</a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link text-light">Login</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link text-light">Register</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
