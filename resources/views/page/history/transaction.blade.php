@extends('layout.master')
    @push('custom-style')
    <link href="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    @endpush
    @section('content')
        <div class="data" id="Data-div">
            @php
            use App\Models\history;
                $data = history::where('information','Penjualan')->get();
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
                <h1 class="mb-0 pb-0 display-4" id="title">Transaction</h1>
                @if (session('success'))
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: '{{ session('success') }}',
                        confirmButtonText: 'OK'
                    });
                </script>
            @elseif (session('hapus'))
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Deleted',
                        text: '{{ session('hapus') }}',
                        confirmButtonText: 'OK'
                    });
                </script>
            @endif
            </div>
            </div>
            <!-- Title End -->

            <!-- Top Buttons Start -->
            <div class="w-100 d-md-none"></div>
            <div class="col-12 col-sm-6 col-md-auto d-flex align-items-end justify-content-end mb-2 mb-sm-0 order-sm-3">
            
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
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Keterangan</th>
                                <th>Tanggal</th>
                                <th>Print</th>
                            </tr>
                        </thead>
                    <tbody id="tb-category">    
                @foreach ($data as $item)
                    @php
                        $total = $item->price * $item->qty;
                        $price = $item->price;
                        $total = 'RP ' . number_format($total, 0, ',', '.');
                        $price = 'RP ' . number_format($price, 0, ',', '.');
                        $date = $item->created_at->format('Y-m-d H:i:s')
                    @endphp
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{$item->name}}</td>
                        <td>{{$price}}</td>
                        <td>{{$item->qty}}</td>
                        <td>{{$total}}</td>
                        <td>{{$item->information}}</td>
                        <td>{{$date}}</td>
                        <td>
                            <div class="col">
                                <a 
                                href="{{url("/invoicelama?id=$item->name")}}"
                                class="btn btn-primary d-flex justify-content-center align-items-center 
                                border shadow fw-bold">
                                    <i class="fa-solid fa-print"></i>
                                </a>
                                <a 
                                href="{{url("/hapusinvoice?id=$item->name")}}"
                                class="btn btn-danger d-flex justify-content-center align-items-center 
                                border shadow fw-bold">
                                    <i class="fa-solid fa-trash"></i>
                                </a>
                            </div>
                        </td>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/data-table.js') }}"></script>
@endpush
