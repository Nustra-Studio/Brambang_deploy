@extends('layout.master')
    @push('custom-style')
    <link href="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
    @endpush
    @section('content')
        <div class="data" id="Data-div">
            @php
            use App\Models\keuangan;
                $data = keuangan::all();
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
                <h1 class="mb-0 pb-0 display-4" id="title">Laporan Hutang-Piutang</h1>
            </div>
            </div>
            <!-- Title End -->

            <!-- Top Buttons Start -->
            <div class="w-100 d-md-none"></div>
            <div class="col-12 col-sm-6 col-md-auto d-flex align-items-end  mb-2 mb-sm-0 order-sm-3">
                <select id="filterStatus" class="form-select">
                    <option value="">Filter by Status</option>
                    <option value="buy_product">Hutang</option>
                    <option value="sell_product">Utang</option>
                </select>
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
                                <th>Customer</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>keterangan</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                    <tbody id="tb-category">    
                @foreach ($data as $item)
                    @php
                        $total = $item->price * $item->qty;
                        $price = $item->money;
                        $total = 'RP ' . number_format($total, 0, ',', '.');
                        $price = 'RP ' . number_format($price, 0, ',', '.');
                        $date = $item->created_at->format('Y-m-d H:i:s')
                    @endphp
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td>{{$item->name}}</td>
                        <td>@if ($item->status =="cost")
                            
                        @else
                            Yudha
                        @endif
                    </td>
                        <td>{{$price}}</td>
                        <td>{{$item->status}}</td>
                        <td>
                        @if($item->information =="buy_product")
                                Bayar Hutang
                        @else
                            Hutang
                        @endif
                        </td>
                        <td>{{$date}}</td>
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
    $(document).ready(function() {
        'use strict';
        $('#dataTableExample').DataTable({
            "aLengthMenu": [
                [10, 30, 50, -1],
                [10, 30, 50, "All"]
            ],
            "iDisplayLength": 10,
            "language": {
                "search": ""
            },
            "select": true
        });

        $('#dataTableExample').each(function() {
            var datatable = $(this);
            var search_input = datatable.closest('.dataTables_wrapper').find('div[id$=_filter] input');
            search_input.attr('placeholder', 'Search');
            search_input.removeClass('form-control-sm');

            var length_sel = datatable.closest('.dataTables_wrapper').find('div[id$=_length] select');
            length_sel.removeClass('form-control-sm');
        });

        $('#filterStatus').on('change', function() {
            var status = $(this).val();
            $('#dataTableExample').DataTable().columns(4).search(status).draw();
        });
    });
    </script>   
    <script src="{{ asset('js/plugin/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush
