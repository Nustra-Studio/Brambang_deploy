@extends('layout.master')
    @section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
        <div class="row g-0">
            @php
                use App\Models\Barang;
               $data = Barang::all();
            @endphp
            <!-- Title Start -->
            <div class="col-auto mb-3 mb-md-0 me-auto">
            <div class="w-auto sw-md-30">
                <a href="#" class="muted-link pb-1 d-inline-block breadcrumb-back">
                <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
                <span class="text-small align-middle">Home</span>
                </a>
                <h1 class="mb-0 pb-0 display-4" id="title">Input Produk</h1>
            </div>
            </div>
            <!-- Title End -->

            <!-- Top Buttons Start -->
            <div class="w-100 d-md-none"></div>
            <div class="col-12 col-sm-6 col-md-auto d-flex align-items-end justify-content-end mb-2 mb-sm-0 order-sm-3">
            <button
                type="button"
                class="btn btn-outline-primary btn-icon btn-icon-start ms-0 ms-sm-1 w-100 w-md-auto"
                data-bs-toggle="modal"
                data-bs-target="#addProdukModal"
            >
                <i data-acorn-icon="plus"></i>
                <span>Tambah Produk</span>
            </button>
            
            </div>
            <!-- Top Buttons End -->
        </div>
        </div>
        <!-- Title and Top Buttons End -->

        <!-- Controls Start -->
        <div class="row mb-2">
        <!-- Search Start -->
        <div class="col-sm-12 col-md-5 col-lg-3 col-xxl-2 mb-1">
            <div class="d-inline-block float-md-start me-1 mb-1 search-input-container w-100 shadow bg-foreground">
            <input class="form-control" placeholder="Search" />
            <span class="search-magnifier-icon">
                <i data-acorn-icon="search"></i>
            </span>
            <span class="search-delete-icon d-none">
                <i data-acorn-icon="close"></i>
            </span>
            </div>
        </div>
        <!-- Search End -->

        <div class="col-sm-12 col-md-7 col-lg-9 col-xxl-10 text-end mb-1">
            <div class="d-inline-block">
            <!-- Print Button Start -->
            
            <!-- Print Button End -->

            <!-- Export Dropdown Start -->
            
            <!-- Export Dropdown End -->

            <!-- Length Start -->
            <div class="dropdown-as-select d-inline-block" data-childSelector="span">
                <button class="btn p-0 shadow" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-bs-offset="0,3">
                <span
                    class="btn btn-foreground-alternate dropdown-toggle"
                    data-bs-toggle="tooltip"
                    data-bs-placement="top"
                    data-bs-delay="0"
                    title="Item Count"
                >
                    10 Items
                </span>
                </button>
                <div class="dropdown-menu shadow dropdown-menu-end">
                <a class="dropdown-item" href="#">5 Items</a>
                <a class="dropdown-item active" href="#">10 Items</a>
                <a class="dropdown-item" href="#">20 Items</a>
                </div>
            </div>
            <!-- Length End -->
            </div>
        </div>
        </div>
        <!-- Controls End -->

        <!-- Discount List Start -->
        <div class="row">
        <div class="col-12 mb-5">
            <div class="card mb-2 bg-transparent no-shadow d-none d-lg-block">
            <div class="card-body pt-0 pb-0 sh-3">
                <div class="row g-0 h-100 align-content-center">
                <div class="col-12 col-lg-4 d-flex align-items-center mb-2 mb-lg-0 text-muted text-small">Nama</div>
                <div class="col-6 col-lg-2 d-flex align-items-center text-alternate text-medium text-muted text-small">Harga Beli</div>
                <div class="col-6 col-lg-2 d-flex align-items-center text-alternate text-medium text-muted text-small">Harga Jual</div>
                <div class="col-6 col-lg-2 d-flex align-items-center text-alternate text-medium text-muted text-small">Stok</div>
                <div class="col-6 col-lg-1 d-flex align-items-center text-alternate text-medium text-muted text-small">Satuan</div>
                </div>
            </div>
            </div>
            <div id="checkboxTable">
            <!-- start LOOP -->
            <div class="card mb-2">
                @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
              @endif
                @foreach ($data as $item)
                    <div class="card-body py-4 py-lg-0 sh-lg-8">
                        <div class="row g-0 h-100 align-content-center">
                            <div class="col-11 col-lg-4 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-1 order-lg-1 h-lg-100 position-relative">
                            <div class="text-muted text-small d-lg-none">Nama</div>
                            <a href="#" class="text-truncate h-100 d-flex align-items-center " data-bs-toggle="modal" data-bs-target="#discountDetailModal">
                                {{$item->name}}
                            </a>
                            </div>
                            @php
                                $basic_price = $item->basic_price;
                                $price = $item->price;
                                $basic_price = 'RP ' . number_format($basic_price, 0, ',', '.');
                                $price = 'RP ' . number_format($price, 0, ',', '.');
                            @endphp
                            <div class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-3 order-lg-2">
                            <div class="text-muted text-small d-lg-none">Harga Beli</div>
                            <div class="text-alternate">{{$basic_price}}</div>
                            </div>
                            <div class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-4 order-lg-3">
                            <div class="text-muted text-small d-lg-none">Harga Jual</div>
                            <div class="text-alternate">{{$price}}</div>
                            </div>
                            <div class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-5 order-lg-4">
                            <div class="text-muted text-small d-lg-none">Stok</div>
                            <div class="text-alternate">{{$item->qty}}</div>
                            </div>
                            <div class="col-6 col-lg-1 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-last order-lg-5">
                            <div class="text-muted text-small d-lg-none">Satuan</div>
                            <div>
                                <span class="badge rounded-pill bg-outline-primary">{{$item->unit}}</span>
                            </div>
                            </div>
                            <div class="col-1 col-lg-1 d-flex flex-column justify-content-center align-items-lg-end mb-2 mb-lg-0 order-2 text-end order-lg-last">
                            <div class="container-fluid d-lg-flex flex-lg-row gap-1 gap-lg-2 justify-content-lg-end">
                                <div class="col">
                                    <button class="btn btn-primary d-flex justi fy-content-center align-items-center border shadow p-3 fw-bold p-lg-2 p-xl-3" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </div>
                                <div class="col">
                                    <button class="btn btn-danger d-flex justify-content-center align-items-center border shadow p-3 fw-bold p-lg-2 p-xl-3" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{$item->id}}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>

                            <!-- Discount Detail Modal Start -->
        <div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Produk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('barang.update', $item->id) }}">
                        @csrf
                        @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{$item->name}}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga Beli</label>
                        <input type="text" name="basic_price" class="form-control" value="{{$item->basic_price}}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga Jual</label>
                        <input type="text" name="price" class="form-control" value="{{$item->price}}" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Stok</label>
                        <input type="text" name="qty" class="form-control" value="{{$item->qty}}" />
                    </div>
                    <div class="mb-3 w-100">
                        <label class="form-label">Satuan</label>
                        <select name="unit" class="form-select" aria-placeholder="Pilih jabatan">
                            <option @if($item->unit === 'PCS') selected @endif value="PCS">PCS</option>
                            <option @if($item->unit === 'KG') selected @endif value="KG">KG</option>
                            <option @if($item->unit === 'Liter') selected @endif value="Liter">Liter</option>
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer border-1">
                    
                    <button type="submit"class="btn btn-icon btn-icon-end btn-primary">
                    <span>Save</span>
                    <i data-acorn-icon="save"></i>
                    </button>
                </div>
            </form>
                </div>
            </div>
            </div>
            <!-- Discount Detail Modal End -->
    
            <!-- Delete Modal -->
            <div class="modal fade" id="deleteUserModal{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Hapus Data?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Konfirmasi Hapus Data
                    </div>
                    <div class="modal-footer">
                        <form method="POST" action="{{ route('barang.destroy', $item->id) }}">
                            @csrf
                            @method('DELETE')
                        <button type="submit" class="btn btn-danger border shadow">Hapus</button>
                        <button class="btn btn-primary border-1" data-bs-dismiss="modal">Batal</button>
                    </form>
                    </div>
                    </div>

            </div>
            </div>
            <!-- Delete Modal End -->
    

                @endforeach
            </div>
            </div>
        </div>
        </div>
        <!-- Discount List End -->
                    <!-- Discount Add Modal Start -->
                    <div class="modal fade" id="addProdukModal" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Tambahkan Produk</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form
                                    action="{{route('barang.store')}}"
                                    method="POST"
                                >
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" />
                                </div>
                                <div class="mb-3 w-100">
                                    <label class="form-label">Harga Beli</label>
                                    <input type="text" name="basic_price" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Harga Jual</label>
                                    <input type="text" name="price" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Stok</label>
                                    <input type="text" name="qty" class="form-control" />
                                </div>
                                <div class="mb-3 w-100">
                                    <label class="form-label">Satuan</label>
                                    <select name="unit" class="form-select" aria-placeholder="Pilih jabatan">
                                        <option value="PCS">PCS</option>
                                        <option value="KG">KG</option>
                                        <option value="Liter">Liter</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-icon btn-icon-end btn-primary">
                                <span>Tambah</span>
                                <i data-acorn-icon="plus"></i>
                                </button>
                            </div>
                        </form>
                            </div>
                        </div>
                        </div>

        <!-- Discount Add Modal End -->
    </div>
    @endsection