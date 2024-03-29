<div id="nav" class="nav-container d-flex">
    <div class="nav-content d-flex">
    <!-- Logo Start -->
    <div class="logo position-relative">
        <a href="/">
        <!-- Logo can be added directly -->
        <!-- <img src="img/logo/logo-white.svg" alt="logo" /> -->

        <!-- Or added via css to provide different ones for different color themes -->
        <div class="text-light">
            <span class="text-secondary text-medium">Nustra</span> Studio
        </div>
        </a>
    </div>
    <!-- Logo End -->

    <!-- User Menu Start -->
    <div class="user-container d-flex">
        <a href="#" class="d-flex user position-relative" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="{{asset('icon/circle-user-solid.svg')}}" class="profile" alt="profile">
        <div class="name">Galang Wira</div>
        </a>
        <div class="dropdown-menu dropdown-menu-end user-menu wide">
        <div class="row mb-1 ms-0 me-0">
            <div class="col-12 p-1 mb-3 pt-3">
            <div class="separator-light"></div>
            </div>
            <div class="col-6 ps-1 pe-1">
            </div>
            <div class="col-6 pe-1 ps-1">
            <ul class="list-unstyled">
                <li>
                <a href="#">
                    <i data-acorn-icon="gear" class="me-2" data-acorn-size="17"></i>
                    <span class="align-middle">Settings</span>
                </a>
                </li>
                <li>
                <a href="#">
                    <i data-acorn-icon="logout" class="me-2" data-acorn-size="17"></i>
                    <span class="align-middle">Logout</span>
                </a>
                </li>
            </ul>
            </div>
        </div>
        </div>
    </div>
    <!-- User Menu End -->

    <!-- Icons Menu Start -->
    <!-- Icons Menu End -->

    <!-- Menu Start -->
    <div class="menu-container flex-grow-1">
        <ul id="menu" class="menu">
        <li>
            <a href="/">
            <i data-acorn-icon="shop" class="icon" data-acorn-size="18"></i>
            <span class="label">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{url('/transaction')}}" data-href="Products.html">
            <i data-acorn-icon="duplicate" class="icon" data-acorn-size="18"></i>
            <span class="label">Penjualan</span>
            </a>
        </li>
        <li>
            <a href="#products" data-href="Products.html">
            <i data-acorn-icon="folders" class="icon" data-acorn-size="18"></i>
            <span class="label">Master Data</span>
            </a>
            <ul id="products">
            <li>
                <a href="{{url('/karyawan')}}">
                <span class="label">Karyawan</span>
                </a>
            </li>
            <li>
                <a href="{{url('/barang')}}">
                <span class="label">Produk</span>
                </a>
            </li>
            <li>
                <a href="{{url('/customer')}}">
                <span class="label">Customer</span>
                </a>
            </li>
            </ul>
        </li>
        
        <li>
            <a href="#histori" data-href="Products.html">
            <i data-acorn-icon="file-text" class="icon" data-acorn-size="18"></i>
            <span class="label">Histori</span>
            </a>
            <ul id="histori">
            <li>
                <a href="{{url('/history/barangmasuk')}}">
                <span class="label">Barang Masuk</span>
                </a>
            </li>
            <li>
                <a href="{{url('/history/barangkeluar')}}">
                <span class="label">Barang Keluar</span>
                </a>
            </li>
            <li>
                <a href="{{url('/history/transaction')}}">
                <span class="label">Transaksi</span>
                </a>
            </li>
            </ul>
        </li>
        
        <li>
            <a href="{{url('/production')}}">
            <i data-acorn-icon="factory" class="icon" data-acorn-size="18"></i>
            <span class="label">Produksi</span>
            </a>
        </li>
        <li>
            <a href="{{url('/laporan-keuangan')}}">
            <i data-acorn-icon="chart-up" class="icon" data-acorn-size="18"></i>
            <span class="label">Laporan Keuangan</span>
            </a>
        </li>
    </div>
    <!-- Menu End -->

    <!-- Mobile Buttons Start -->
    <div class="mobile-buttons-container">
        <!-- Menu Button Start -->
        <a href="#" id="mobileMenuButton" class="menu-button">
        <i data-acorn-icon="menu"></i>
        </a>
        <!-- Menu Button End -->
    </div>
    <!-- Mobile Buttons End -->
    </div>
    <div class="nav-shadow"></div>
</div>