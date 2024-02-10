@extends('layout.master')
    @push('custom-style')
    <link href="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    @endpush
    @section('content')
        <div class="data" id="Data-div">
            @php
            use App\Models\Barang;
                $data = Barang::all();
            @endphp
        </div>
    <div class="container" id="Results">
        <!-- Title and Top Buttons Start -->
        <div class="page-title-container">
        <div class="row g-0">
            <!-- Title Start -->
            <div class="col-auto mb-3 mb-md-0 me-auto">
            <div class="w-auto sw-md-30">
                <a href="#" class="muted-link pb-1 d-inline-block breadcrumb-back">
                <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
                <span class="text-small align-middle">Home</span>
                </a>
                <h1 class="mb-0 pb-0 display-4" id="title">Produk</h1>
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

        <!-- Controls End -->

        <!-- Discount List Start -->
        <div class="row">
        <div class="col-12 mb-5">
            <!-- start LOOP -->
                @if(session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
                @endif
            <div class="card-body">
                {{-- <p class="text-muted mb-3">Read the <a href="https://datatables.net/" target="_blank"> Official DataTables Documentation </a>for a full list of instructions and other options.</p> --}}
                
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                {{-- tabel head nama	kepalaCabang	telepon	alamat	category	keterangan --}}
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Stock</th>
                                <th>Satuan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <tbody id="tb-category">    
                @foreach ($data as $item)
                    @php
                        $basic_price = $item->basic_price;
                        $price = $item->price;
                        $basic_price = 'RP ' . number_format($basic_price, 0, ',', '.');
                        $price = 'RP ' . number_format($price, 0, ',', '.');
                    @endphp
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$price}}</td>
                        <td>{{$item->qty}}</td>
                        <td> <span class="badge rounded-pill bg-outline-primary">{{$item->unit}}</span></td>
                        <td>  
                            <button class="btn btn-sm btn-primary d-flex justi fy-content-center align-items-center border shadow p-3 fw-bold p-lg-2 p-xl-3" data-bs-toggle="modal" data-bs-target="#editModal{{$item->id}}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="btn btn-sm btn-danger d-flex justify-content-center align-items-center border shadow p-3 fw-bold p-lg-2 p-xl-3" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{$item->id}}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                    </td>
                    </tr>
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
                                    <label class="form-label">Harga</label>
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
                @endforeach
                    </tbody>
                    </table>
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
                                <div class="mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="text" name="price" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Stok</label>
                                    <input type="text" name="qty" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select name="category"  class="form-select" id="">
                                        <option value="bahan_baku">Bahan Baku</option>
                                        <option value="produk">Produk</option>
                                    </select>
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
            </div>
        </div>
    </div>
    </div>
    @endsection
    @push('custom-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // $(document).ready(function() {
        //     var divdata = document.getElementById("Data-div");
        //     $('#searchInput').on('input', function() {
        //         var query = $(this).val();
        //         var limit = $('#itemCountButton').data('item-count');
        //         console.log(limit);
        //         // Change the AJAX URL to match your endpoint
        //         $.ajax({
        //             type: 'GET',
        //             url: '/dataresource/barang', // Change this URL to your actual search endpoint
        //             data: { query: query, limit: limit },
        //             success: function(response) {
        //                 console.log(response);
        //                 // Set the response data to the innerHTML of the div
        //                 divdata.innerHTML = response;
        //             }
        //         });
        //     });
    
        //     $('.dropdown-item').on('click', function(event) {
        //         event.preventDefault();
        //         var itemCount = $(this).data('item-count');
        //         $('#itemCountButton').text(itemCount + ' Items').data('item-count', itemCount);
        //         $('#searchInput').trigger('input');
        //     });
        // });
    </script>
    <script src="{{ asset('js/plugin/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('js/data-table.js') }}"></script>
@endpush
