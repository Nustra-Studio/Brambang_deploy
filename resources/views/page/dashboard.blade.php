@extends('layout.master')
    @section('content')
        <div class="container">
            <!-- Title and Top Buttons Start -->
            <div class="page-title-container">
                <div class="row">
                <!-- Title Start -->
                <div class="col-12 col-md-7">
                    <a class="muted-link pb-2 d-inline-block hidden" href="#">
                    <span class="align-middle lh-1 text-small">&nbsp;</span>
                    </a>
                    <h1 class="mb-0 pb-0 display-4" id="title">Selamat Datang</h1>
                </div>
                <!-- Title End -->
                </div>
            </div>
            <!-- Title and Top Buttons End -->
        
            <!-- Stats Start -->
            <div class="row">
                <div class="col-12">
                <div class="d-flex">
                    <div class="dropdown-as-select me-3" data-setActive="false" data-childSelector="span">
                    <a class="pe-0 pt-0 align-top lh-1 dropdown-toggle" href="#" data-bs-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                        <span class="small-title"></span>
                    </a>
                    <div class="dropdown-menu font-standard">
                        <div class="nav flex-column" role="tablist">
                        <a class="active dropdown-item text-medium" href="#" aria-selected="true" role="tab">Hari Ini</a>
                        </div>
                    </div>
                    </div>
                    <h2 class="small-title">Stats</h2>
                </div>
                <div class="mb-5">
                    <div class="row g-2">
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-100 hover-scale-up cursor-pointer">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                            <i data-acorn-icon="dollar" class="text-primary"></i>
                            </div>
                            <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">OMSET HARIAN</div>
                            <div class="text-primary cta-4">Rp.3.000.000</div>
                        </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-100 hover-scale-up cursor-pointer">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                            <i data-acorn-icon="acorn" class="text-primary"></i>
                            </div>
                            <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">STOK TERSISA</div>
                            <div class="text-primary cta-4">16</div>
                        </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-100 hover-scale-up cursor-pointer">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                            <i data-acorn-icon="money-bag" class="text-primary"></i>
                            </div>
                            <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">BARANG TERJUAL</div>
                            <div class="text-primary cta-4">120</div>
                        </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-100 hover-scale-up cursor-pointer">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                            <i data-acorn-icon="sale-tag" class="text-primary"></i>
                            </div>
                            <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">COST HARIAN</div>
                            <div class="text-danger cta-4">-Rp.230.000</div>
                        </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-100 hover-scale-up cursor-pointer">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                            <i data-acorn-icon="user" class="text-primary"></i>
                            </div>
                            <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">TOTAL CUSTOMER</div>
                            <div class="text-primary cta-4">325</div>
                        </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-lg-2">
                        <div class="card h-100 hover-scale-up cursor-pointer">
                        <div class="card-body d-flex flex-column align-items-center">
                            <div class="sw-6 sh-6 rounded-xl d-flex justify-content-center align-items-center border border-primary mb-4">
                            <i data-acorn-icon="user" class="text-primary"></i>
                            </div>
                            <div class="mb-1 d-flex align-items-center text-alternate text-small lh-1-25">TOTAL KARYAWAN</div>
                            <div class="text-primary cta-4">20</div>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            <!-- Stats End -->
        
            <div class="row">
                <!-- Recent Orders Start -->
                <div class="col mb-5">
                <h2 class="small-title">Histori Penjualan</h2>
                <div class="mb-n2 scroll-out">
                    <div class="scroll-by-count" data-count="6">
        
                    <div class="card mb-2 sh-15 sh-md-6">
                        <div class="card-body pt-0 pb-0 h-100">
                        <div class="row g-0 h-100 align-content-center">
                            <div class="col-10 col-md-4 d-flex align-items-center mb-3 mb-md-0 h-md-100">
                            <a class="body-link stretched-link" style="cursor: pointer;">No 230123983</a>
                            </div>
                            <div class="col-2 col-md-3 d-flex align-items-center text-muted mb-1 mb-md-0 justify-content-end justify-content-md-start">
                            <span class="badge bg-outline-primary me-1">TERJUAL</span>
                            </div>
                            <div class="col-12 col-md-2 d-flex align-items-center mb-1 mb-md-0 text-alternate">
                            <span>
                                <span class="text-small">Rp.</span>
                                120.000
                            </span>
                            </div>
                            <div class="col-12 col-md-3 d-flex align-items-center justify-content-md-end mb-1 mb-md-0 text-alternate">12-10-2023</div>
                        </div>
                        </div>
                    </div>
        
                    <div class="card mb-2 sh-15 sh-md-6">
                        <div class="card-body pt-0 pb-0 h-100">
                        <div class="row g-0 h-100 align-content-center">
                            <div class="col-10 col-md-4 d-flex align-items-center mb-3 mb-md-0 h-md-100">
                            <a class="body-link stretched-link" style="cursor: pointer;">No 230123984</a>
                            </div>
                            <div class="col-2 col-md-3 d-flex align-items-center text-muted mb-1 mb-md-0 justify-content-end justify-content-md-start">
                            <span class="badge bg-outline-quaternary me-1">TERJUAL</span>
                            </div>
                            <div class="col-12 col-md-2 d-flex align-items-center mb-1 mb-md-0 text-alternate">
                            <span>
                                <span class="text-small">Rp.</span>
                                300.000
                            </span>
                            </div>
                            <div class="col-12 col-md-3 d-flex align-items-center justify-content-md-end mb-1 mb-md-0 text-alternate">12-10-2023</div>
                        </div>
                        </div>
                    </div>
        
                    </div>
                </div>
                </div>
                <!-- Recent Orders End -->
        
                <!-- Performance Start -->
            
                <!-- Performance End -->
            </div>
        
            <div class="row gx-4 gy-5">
                <!-- Top Selling Items Start -->
                <div class="col-xl-6 mb-5">
                <h2 class="small-title fw-bold">Barang Masuk</h2>
                <div class="scroll-out mb-n2">
                    <div class="scroll-by-count" data-count="4">
                    <div class="card mb-2">
                        <div class="row g-0 sh-14 sh-md-10">
                        <div class="col">
                            <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col d-flex align-items-center mb-2 mb-md-0 text-large">
                                <a href="Products.Detail.html">Minyak Bimoli</a>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                <div class="border px-2 py-1 rounded border-primary border-2 text-primary">
                                    12 PCS
                                </div>
                                </div>
                                <div class="col d-flex align-items-center justify-content-end text-muted text-medium">
                                2023-12-11
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="row g-0 sh-14 sh-md-10">
                        <div class="col">
                            <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col d-flex align-items-center mb-2 mb-md-0 text-large">
                                <a href="Products.Detail.html">Minyak Bimoli</a>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                <div class="border px-2 py-1 rounded border-primary border-2 text-primary">
                                    12 PCS
                                </div>
                                </div>
                                <div class="col d-flex align-items-center justify-content-end text-muted text-medium">
                                2023-12-11
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="row g-0 sh-14 sh-md-10">
                        <div class="col">
                            <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col d-flex align-items-center mb-2 mb-md-0 text-large">
                                <a href="Products.Detail.html">Minyak Bimoli</a>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                <div class="border px-2 py-1 rounded border-primary border-2 text-primary">
                                    12 PCS
                                </div>
                                </div>
                                <div class="col d-flex align-items-center justify-content-end text-muted text-medium">
                                2023-12-11
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="row g-0 sh-14 sh-md-10">
                        <div class="col">
                            <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col d-flex align-items-center mb-2 mb-md-0 text-large">
                                <a href="Products.Detail.html">Minyak Bimoli</a>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                <div class="border px-2 py-1 rounded border-primary border-2 text-primary">
                                    12 PCS
                                </div>
                                </div>
                                <div class="col d-flex align-items-center justify-content-end text-muted text-medium">
                                2023-12-11
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div><div class="card mb-2">
                        <div class="row g-0 sh-14 sh-md-10">
                        <div class="col">
                            <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col d-flex align-items-center mb-2 mb-md-0 text-large">
                                <a href="Products.Detail.html">GAS</a>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                <div class="border px-2 py-1 rounded border-primary border-2 text-primary">
                                    12 PCS
                                </div>
                                </div>
                                <div class="col d-flex align-items-center justify-content-end text-muted text-medium">
                                2023-12-11
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>
                    
                    
                    </div>
                </div>
                </div>
                <!-- Top Selling Items End -->
        
                <!-- Top Search Terms Start -->
                <div class="col-xl-6 mb-5">
                <h2 class="small-title fw-bold text-danger">Barang Keluar</h2>
                <div class="scroll-out mb-n2">
                    <div class="scroll-by-count" data-count="4">
                    <div class="card mb-2">
                        <div class="row g-0 sh-14 sh-md-10">
                        <div class="col">
                            <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col d-flex align-items-center mb-2 mb-md-0 text-large ">
                                <a href="Products.Detail.html" class="text-danger">Minyak Bimoli</a>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                <div class="border px-2 py-1 rounded border-danger border-2 text-danger">
                                    12 PCS
                                </div>
                                </div>
                                <div class="col d-flex align-items-center justify-content-md-end text-muted text-medium">
                                2023-12-11
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="row g-0 sh-14 sh-md-10">
                        <div class="col">
                            <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col d-flex align-items-center mb-2 mb-md-0 text-large">
                                <a href="Products.Detail.html" class="text-danger">Minyak Bimoli</a>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                <div class="border px-2 py-1 rounded border-danger border-2 text-danger">
                                    12 PCS
                                </div>
                                </div>
                                <div class="col d-flex align-items-center justify-content-md-end text-muted text-medium">
                                2023-12-11
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>
                    <div class="card mb-2">
                        <div class="row g-0 sh-14 sh-md-10">
                        <div class="col">
                            <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col d-flex align-items-center mb-2 mb-md-0 text-large">
                                <a href="Products.Detail.html" class="text-danger">Minyak Bimoli</a>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                <div class="border px-2 py-1 rounded border-danger border-2 text-danger">
                                    12 PCS
                                </div>
                                </div>
                                <div class="col d-flex align-items-center justify-content-md-end text-muted text-medium">
                                2023-12-11
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div><div class="card mb-2">
                        <div class="row g-0 sh-14 sh-md-10">
                        <div class="col">
                            <div class="card-body pt-0 pb-0 h-100">
                            <div class="row g-0 h-100 align-content-center">
                                <div class="col d-flex align-items-center mb-2 mb-md-0 text-large">
                                <a href="Products.Detail.html" class="text-danger">GAS</a>
                                </div>
                                <div class="col d-flex justify-content-center align-items-center">
                                <div class="border px-2 py-1 rounded border-danger border-2 text-danger">
                                    12 PCS
                                </div>
                                </div>
                                <div class="col d-flex align-items-center justify-content-md-end text-muted text-medium">
                                2023-12-11
                                </div>
                            </div>
                            </div>  
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                <!-- Top Search Terms End -->
            </div>
        
            <div class="row">
                <div class="col-12 col-xxl">
                <div class="row">
                    <!-- Activity Start -->
                    
                    <!-- Activity End -->
        
                    <!-- Recent Reviews Start -->
                    
                    <!-- Recent Reviews End -->
                </div>
                </div>
        
                <!-- Tips Start -->
                
                <!-- Tips End -->
            </div>
        </div>
    @endsection
    @push('custome-script')
        
    @endpush