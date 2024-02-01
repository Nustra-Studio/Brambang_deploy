@extends('layout.master')
    @section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
        <div class="row g-0">
            @php
                use App\Models\Customer;
                $data = Customer::all();
            @endphp
            <!-- Title Start -->
            <div class="col-auto mb-3 mb-md-0 me-auto">
            <div class="w-auto sw-md-30">
                <a href="#" class="muted-link pb-1 d-inline-block breadcrumb-back">
                <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
                <span class="text-small align-middle">Home</span>
                </a>
                <h1 class="mb-0 pb-0 display-4" id="title">Data Customer</h1>
            </div>
            </div>
            <!-- Title End -->

            <!-- Top Buttons Start -->
            <div class="w-100 d-md-none"></div>
            <div class="col-12 col-sm-12 col-md-auto d-flex align-items-end justify-content-end mb-2 mb-sm-0 order-sm-3">
            <button
                type="button"
                class="btn btn-outline-primary btn-icon btn-icon-start ms-0 ms-sm-1 w-100 w-md-auto"
                data-bs-toggle="modal"
                data-bs-target="#addKaryawanModal"
            >
                <i data-acorn-icon="plus"></i>
                <span>Tambah Customer</span>
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
                <div class="col-12 col-lg-2 d-flex align-items-center mb-2 mb-lg-0 text-muted text-small">Nama</div>
                <div class="col-6 col-lg-2 d-flex align-items-center text-alternate text-medium text-muted text-small">No. HP</div>
                <div class="col-6 col-lg-4 d-flex align-items-center text-alternate text-medium text-muted text-small">Alamat</div>
                <div class="col-6 col-lg-2 d-flex align-items-center text-alternate text-medium text-muted text-small">Jumlah Transaksi</div>
                </div>
            </div>
            </div>
            <div id="checkboxTable">
            <!-- start LOOP -->
            <div class="card mb-2">
                @if (session('status'))
                    <div class="alert alert-primary">
                        {{ session('status')}}
                    </div>
                @elseif (session('hapus'))
                    <div class="alert alert-danger">
                        {{ session('hapus')}}
                    </div>
                @endif
                @foreach ($data as $item)
                <div class="card-body py-4 py-lg-0 sh-lg-8">
                <div class="row g-0 h-100 align-content-center">
                    <div class="col-11 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-1 order-lg-1 h-lg-100 position-relative">
                    <div class="text-muted text-small d-lg-none">Nama</div>
                    <a href="#" class="text-truncate h-100 d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#discountDetailModal">
                        {{ $item->name }}
                    </a>
                    </div>
                    <div class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-3 order-lg-2">
                    <div class="text-muted text-small d-lg-none">No. HP</div>
                    <div class="text-alternate">{{$item->hp}}</div>
                    </div>
                    <div class="col-6 col-lg-4 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-4 order-lg-3">
                    <div class="text-muted text-small d-lg-none">Alamat</div>
                    <div class="text-alternate">{{$item->address}}</div>
                    </div>
                    <div class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-5 order-lg-4">
                    <div class="text-muted text-small d-lg-none">Jumlah Transaksi</div>
                    <div class="text-alternate">12</div>
                    </div>
                    <div class="col-6 col-lg-1 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-last order-lg-5">
                    
                    </div>
                    <div class="col-1 col-lg-1 d-flex flex-column justify-content-center align-items-lg-end mb-2 mb-lg-0 order-2 text-end order-lg-last">
                    <div class="container-fluid d-lg-flex flex-lg-row gap-1 gap-lg-2 justify-content-lg-end">
                        <div class="col">
                            <button class="btn btn-primary d-flex justi fy-content-center align-items-center border shadow fw-bold p-3 p-lg-2 p-xl-3" data-bs-toggle="modal" data-bs-target="#editUserModal">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                        </div>
                        <div class="col">
                            <button class="btn btn-danger d-flex justify-content-center align-items-center border shadow fw-bold p-3 p-lg-2 p-xl-3" data-bs-toggle="modal" data-bs-target="#deleteUserModal">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
                    
                @endforeach
            </div>
            </div>
        </div>
        </div>
        <!-- Discount List End -->

        <!-- Discount Detail Modal Start -->
        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            @if ($data !== null)
                @php
                    $subdata = Customer::where('id', $item->id)->first();
                @endphp
            @endif
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Data Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{Route('customer.update', $subdata->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" class="form-control" name="name" value="{{$subdata->name}}" />
                </div>
                <div class="mb-3">
                    <label class="form-label">No hp</label>
                    <input type="text" class="form-control" name="hp" value="{{$subdata->hp}}" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" class="form-control" name="address" value="{{$subdata->address}}" />
                </div>
                
            </div>
            <div class="modal-footer border-1">
                <button class="btn btn-icon btn-icon-end btn-primary" type="submit">
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
        <div class="modal fade" id="deleteUserModal" tabindex="-1" role="dialog" aria-hidden="true">
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
                <form action="{{Route('customer.destroy', $item->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger border shadow" type="submit">Hapus</button>
                    <button class="btn btn-primary border-1" data-bs-dismiss="modal">Batal</button>
                </form>
            </div>
            </div>
        </div>
        </div>
        <!-- Delete Modal End -->

        <!-- Discount Add Modal Start -->
        <div class="modal fade" id="addKaryawanModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambahkan Customer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{Route('customer.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" />
                </div>
                <div class="mb-3 w-100">
                    <label class="form-label">No Hp.</label>
                    <input type="text" name="nohp" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="alamat" class="form-control" />
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-icon btn-icon-end btn-primary" type="submit">
                    <span>Tambah</span>
                    <i data-acorn-icon="plus"></i>
                </button>
            </form>
            </div>
            </div>
        </div>
        </div>
        <!-- Discount Add Modal End -->
    </div>
    @endsection