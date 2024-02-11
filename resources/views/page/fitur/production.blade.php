@extends('layout.master')

@push('custom-style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link href="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
    <div class="data" id="Data-div">
        @php
            use App\Models\Barang;
            use App\Models\produksi;
            use App\Models\costproduksi;
            $data = Barang::where('information','bahan_baku')->get();
            $produksi = produksi::all();
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
                        <h1 class="mb-0 pb-0 display-4" id="title">Production</h1>
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
                        <span>Tambah Produksi</span>
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
                @if (session('status'))
                    <div class="alert alert-primary">
                        {{ session('status')}}
                    </div>
                @elseif (session('hapus'))
                    <div class="alert alert-danger">
                        {{ session('hapus')}}
                    </div>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Mulai</th>
                                    <th>Biaya</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="tb-category">
                                @foreach ($produksi as $item)
                                    <tr>
                                        @php
                                            $produksis = costproduksi::where('id_produksi',$item->unit)->get();
                                            $cost = 0;
                                            foreach ($produksis as $produksi) {
                                                $biayaItemProduksi = $produksi->qty * $produksi->price;
                                                $cost += $biayaItemProduksi;
                                            }
                                            $cost = 'RP ' . number_format($cost, 0, ',', '.');
                                        @endphp
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->start}}</td>
                                        <td>{{$cost}}</td>
                                        <td>{{$item->information}}</td>
                                        <td>  
                                            <button class="btn btn-sm btn-primary d-flex justify-content-center align-items-center border shadow p-3 fw-bold p-lg-2 p-xl-3" data-bs-toggle="modal" data-bs-target="#editModal">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger d-flex justify-content-center align-items-center border shadow p-3 fw-bold p-lg-2 p-xl-3" data-bs-toggle="modal" data-bs-target="#deleteUserModal">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Product Modal -->
    <div class="modal fade bd-example-modal-lg" id="addProdukModal" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalScrollableTitle">Create Data Produksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('production.store') }}" method="POST" enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        <div class="row mb-3">
                            <div class="col">
                                @php
                                    $currentDate = date('Ymd');
                                    $randomNumber = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
                                    $randomDate = $currentDate . $randomNumber;
                                    $name_random = "PRB$randomDate";
                                @endphp 
                                <label class="form-label">Name:</label>
                                <input value="{{$name_random}}" required name="name" class="form-control mb-4 mb-md-0" id="production" type="text" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Mulai Produksi</label>
                                <input required name="start" class="form-control mb-4 mb-md-0" id="product-start-input" type="date"  />
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col">
                                <label class="form-label">Name Barang:</label>
                                <select name="barang" class="form-select mb-4 mb-md-0" id="product_select" >
                                    @foreach ($data as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Jumlah Barang</label>
                                <input name="jumlah" class="form-control mb-4 mb-md-0" id="jumlah-input" type="text"  />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Harga</label>
                                <input name="price" class="form-control mb-4 mb-md-0" id="harga-input" type="text"  />
                            </div>
                        </div>
                        <!-- Rest of the form content -->

                        <div class="card mt-3">
                            <div class="card-body">
                                <h6 class="card-title">Tabel Input</h6>
                                <div class="tabel-sementara" class="mt-5">
                                    <div class="table-responsive">
                                        <table id="product-table" class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Nama Barang</th>
                                                    <th>Jumlah Barang</th>
                                                    <th>Harga</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!-- Table rows will be dynamically added here -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" id="data-table-values" name="data_table_values">
                        <button type="button" class="btn btn-primary me-2" onclick="addRow()">Tambah Baris</button>
                        <button type="submit" class="btn btn-primary me-2">Submit</button>
                        <button data-bs-dismiss="modal" type="button" value="Cancel" class="btn btn-secondary">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('custom-scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('js/plugin/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('js/data-table.js') }}"></script>
    {{-- <script>
        $(document).ready(function () {
        // Initialize Select2 for product name input
        $('#product-name-input').select2({
            ajax: {
                url: "{{ route('barang.data') }}",
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: $.map(data, function (item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        })
                    };
                },
                cache: true
            },
            placeholder: 'Search for a product...',
            minimumInputLength: 1
        });
    });


    </script> --}}
    <script>
        const productTable = $('#product-table').DataTable();
        const existingValues = [];

        function addRow() {
            const name = document.getElementById('product_select').value;
            const jumlah = document.getElementById('jumlah-input').value;
            const harga = document.getElementById('harga-input').value;
            const url = `/dataresource/barang/?namaproduct=${name}`;
            const deleteButton = `<button class="btn btn-danger btn-sm" onclick="deleteRow(this)">Hapus</button>`;
            const rowValues = {
                'name': name,
                'qty': jumlah,
                'price': harga,
            };
            existingValues.push(rowValues);
            $('#data-table-values').val(JSON.stringify(existingValues));
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    console.log(data);
                    // Assuming the response data contains the price
                    const names = data.name; // Adjust this based on your actual response structure
                    const newRow = productTable.row.add([names, jumlah, harga, deleteButton]).draw();
                    $(newRow.node()).data('node', newRow);
                    document.getElementById('product_select').value = '';
                    document.getElementById('jumlah-input').value = '';
                    document.getElementById('harga-input').value = '';
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                }
            });
        }   
        function deleteRow(button) {
            const rowNode = $(button).closest('tr');
            const rowData = productTable.row(rowNode).data();
            const rowIndex = productTable.row(rowNode).index();

            existingValues.splice(rowIndex, 1); // Hapus data dari existingValues
            $('#data-table-values').val(JSON.stringify(existingValues)); // Perbarui nilai input

            productTable.row(rowNode).remove().draw(); // Hapus baris dari tabel
}
    </script>
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
@endpush
