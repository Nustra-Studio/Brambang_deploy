@extends('layout.master')
    @section('content')
    <div class="container">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
        <div class="row g-0">
            @php
                use App\Models\Barang;
                use App\Models\Customer;
                use App\Models\transaction;
                $data = transaction::where('status','tidak_lunas')->get();
            @endphp
            <!-- Title Start -->
            <div class="col-auto mb-3 mb-md-0 me-auto">
            <div class="w-auto sw-md-30">
                <a href="#" class="muted-link pb-1 d-inline-block breadcrumb-back">
                <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
                <span class="text-small align-middle">Home</span>
                </a>
                <h1 class="mb-0 pb-0 display-4" id="title">Penjualan</h1>
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
                <span>Tambah Penjualan</span>
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
                <div class="col-12 col-lg-3 d-flex align-items-center mb-2 mb-lg-0 text-muted text-small">Nama</div>
                <div class="col-6 col-lg-2 d-flex align-items-center text-alternate text-medium text-muted text-small">Price</div>
                <div class="col-6 col-lg-2 d-flex align-items-center text-alternate text-medium text-muted text-small">Jumlah</div>
                <div class="col-6 col-lg-2 d-flex align-items-center text-alternate text-medium text-muted text-small">Total</div>
                <div class="col-6 col-lg-1 d-flex align-items-center text-alternate text-medium text-muted text-small">Status</div>
                <div class="col-6 col-lg-1 d-flex align-items-center text-alternate text-medium text-muted text-small">Customer</div>

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
                            <div class="col-12 col-lg-3 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-1 order-lg-1 h-lg-100 position-relative">
                                <div class="text-muted text-small d-lg-none">Nama</div>
                                <a href="#" class="text-truncate h-100 d-flex align-items-center " data-bs-toggle="modal" data-bs-target="#discountDetailModal">
                                    {{$item->name}}
                                </a>
                            </div>
                            @php
                                $basic_price = $item->price * $item->qty;
                                $price = $item->price;
                                $total = 'RP ' . number_format($basic_price, 0, ',', '.');
                                $price = 'RP ' . number_format($price, 0, ',', '.');
                                $customer = customer::where('id',$item->id_customer)->first();
                                // $customer = $customer->name;
                            @endphp
                            <div class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-3 order-lg-2">
                                <div class="text-muted text-small d-lg-none">Harga</div>
                                <div class="text-alternate">{{$price}}</div>
                            </div>
                            <div class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-4 order-lg-3">
                                <div class="text-muted text-small d-lg-none">Jumlah</div>
                                <div class="text-alternate">{{$item->qty}}</div>
                            </div>
                            <div class="col-6 col-lg-2 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-5 order-lg-4">
                                <div class="text-muted text-small d-lg-none">Total</div>
                                <div class="text-alternate">{{$total}}</div>
                            </div>
                            <div class="col-6 col-lg-1 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-6 order-lg-5">
                                <div class="text-muted text-small d-lg-none">
                                    Status
                                </div>
                                <div>
                                    <span class="badge rounded-pill bg-outline-danger">{{$item->status}}</span>
                                </div>
                            </div>
                            <div class="col-1 col-lg-1 d-flex flex-column justify-content-center mb-2 mb-lg-0 order-last order-lg-6">
                                <div class="text-muted text-small d-lg-none">Customer</div>
                                <div class="text-alternate">{{$customer->name}}</div>
                            </div>
                            <div class="col-1 col-lg-1 d-flex flex-column justify-content-end mb-2 mb-lg-0 order-last order-lg-6">
                                <div class="col pt-lg-2">
                                    <button class="btn btn-primary d-flex justify-content-center align-items-center border shadow fw-bold p-lg-2 p-xl-3" data-bs-toggle="modal" data-bs-target="#editProdukModal{{$item->id}}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                </div>
                            </div>
                            {{-- <div class="col-1 col-lg-1 d-flex flex-column justify-content-center align-items-lg-end mb-2 mb-lg-0 order-2 text-end order-lg-last">
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
                            </div> --}}
                        </div>
                    </div>

                    {{-- Modal Edit --}}
                    <div class="modal fade" id="editProdukmodal{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">Edit Penjualan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                            <div class="modal-body">
                                <form
                                    action="{{route('transaction.update', $item->id)}}"
                                    method="POST"
                                >
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    @php    
                                        $barang = Barang::where('information','produk')->get();
                                    @endphp
                                    <label class="form-label">Product</label>
                                    <select name="produk" class="form-select" id="product_select">
                                        @foreach ($barang as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="text" name="price" class="form-control" value="{{$price}}"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jumlah</label>
                                    <input type="text" name="qty" class="form-control" value="{{$item->qty}}"/>
                                </div>
                                <div class="mb-3 w-100">
                                    <label class="form-label">Customer</label>
                                    <select name="customer" class="form-select" aria-placeholder="Pilih jabatan">
                                        <option value="0">None</option>
                                        @php
                                            $customer = Customer::all();
                                        @endphp
                                        @foreach ($customer as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 w-100">
                                    <label class="form-label">Pembayaran</label>
                                    <select name="metode" class="form-select" aria-placeholder="Pilih jabatan">
                                        <option value="Lunas">Lunas</option>
                                        <option value="tidak_lunas">Belum Lunas</option>
                                    </select>
                                </div>
                                
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-icon btn-icon-end btn-primary">
                                <span>Edit</span>
                                <i data-acorn-icon="save"></i>
                                </button>
                            </div>
                        </form>
                            </div>
                        </div>
                    </div>
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
                                    action="{{route('transaction.store')}}"
                                    method="POST"
                                >
                                @csrf
                                <div class="mb-3">
                                    @php
                                        $barang = Barang::where('information','produk')->get();
                                    @endphp
                                    <label class="form-label">Product</label>
                                    <select name="produk" class="form-select" id="product_select">
                                        @foreach ($barang as $item)
                                            <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="text" name="price" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jumlah</label>
                                    <input type="text" name="qty" class="form-control" />
                                </div>
                                <div class="mb-3 w-100">
                                    <label class="form-label">Customer</label>
                                    <select name="customer" class="form-select" aria-placeholder="Pilih jabatan">
                                        <option value="0">None</option>
                                        @php
                                            $customer = Customer::all();
                                        @endphp
                                        @foreach ($customer as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3 w-100">
                                    <label class="form-label">Pembayaran</label>
                                    <select name="metode" class="form-select" aria-placeholder="Pilih jabatan">
                                        <option value="Lunas">Lunas</option>
                                        <option value="tidak_lunas">Belum Lunas</option>
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
    @push('custom-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function updateprice() {
            const product = document.getElementById('product_select').value;
            const url = `/dataresource/barang/?namaproduct=${product}`; // Corrected URL assuming it's the correct endpoint
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    console.log(data);
                    // Assuming the response data contains the price
                    const price = data.price; // Adjust this based on your actual response structure
                    // Update the price field in the form
                    $('input[name="price"]').val(price);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                }
            });
        }
    
        function initialize() {
            const selectElement = document.getElementById("product_select");
            selectElement.addEventListener('change', updateprice);
            updateprice();
        }
        document.addEventListener('DOMContentLoaded', initialize);
    </script>
    
    <script src="{{ asset('js/plugin/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('js/data-table.js') }}"></script>
