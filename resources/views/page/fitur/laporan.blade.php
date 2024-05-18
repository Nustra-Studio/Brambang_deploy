@extends('layout.master')
@push('custom-style')
<link href="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" />
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
                    <h1 class="mb-0 pb-0 display-4" id="title">Laporan Keuangan</h1>
                </div>
            </div>
            <!-- Title End -->

            <!-- Top Buttons Start -->
            <div class="w-100 d-md-none"></div>
            <div class="col-12 col-sm-6 col-md-auto d-flex align-items-end mb-2 mb-sm-0 order-sm-3">
                <select id="filterStatus" class="form-select">
                    <option value="">Filter by Status</option>
                    <option value="Pembelian Barang">Pembelian Barang</option>
                    <option value="Penjualan">Penjualan</option>
                </select>
            </div>
            <!-- Date Range Pickers Start -->
            <div class="col-12 col-sm-6 col-md-auto d-flex align-items-end mb-2 mb-sm-0">
                <input type="text" id="startDate" class="form-control" placeholder="Start Date" autocomplete="off" />
                <input type="text" id="endDate" class="form-control ms-2" placeholder="End Date" autocomplete="off" />
            </div>
            <!-- Date Range Pickers End -->
            <!-- Top Buttons End -->
        </div>
    </div>
    <!-- Title and Top Buttons End -->

    <!-- Cards for Totals Start -->
    <div class="row mt-3">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Pengeluaran</h5>
                    <p class="card-text" id="totalCost">RP 0</p>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Total Pendapatan</h5>
                    <p class="card-text" id="totalIncome">RP 0</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Cards for Totals End -->

    <!-- Controls End -->

    <!-- Discount List Start -->
    <div class="row">
        <div class="col-12 mb-5">
            @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
            @endif
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                                <th>Keterangan</th>
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
                                    $date = $item->created_at->format('Y-m-d H:i:s');
                                    if($item->status == 'income'){
                                        $status = "Pendapatan";
                                    }
                                    elseif($item->status == "cost"){
                                        $status ="Pengeluaran";
                                    }
                                    if($item->information == "sell_product"){
                                        $keterangan = "Penjualan";
                                    }
                                    elseif($item->information == "buy_product"){
                                        $keterangan = "Pembelian Barang";
                                    }
                                @endphp
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $price }}</td>
                                    <td>{{ $status }}</td>
                                    <td>{{ $keterangan }}</td>
                                    <td>{{ $date }}</td>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script src="{{ asset('js/plugin/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
<script>
    $(document).ready(function() {
        'use strict';
        var dataTable = $('#dataTableExample').DataTable({
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

        // Initialize datepickers
        $('#startDate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
        $('#endDate').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        // Filter by Status
        $('#filterStatus').on('change', function() {
            var status = $(this).val();
            dataTable.columns(4).search(status).draw();
            calculateTotals();
        });

        // Filter by Date Range
        $('#startDate, #endDate').on('change', function() {
            var startDate = $('#startDate').val();
            var endDate = $('#endDate').val();
            if (startDate && endDate) {
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        var min = startDate;
                        var max = endDate;
                        var date = data[5]; // Date column index
                        if (
                            (min === '' && max === '') ||
                            (min === '' && date <= max) ||
                            (min <= date && max === '') ||
                            (min <= date && date <= max)
                        ) {
                            return true;
                        }
                        return false;
                    }
                );
                dataTable.draw();
                $.fn.dataTable.ext.search.pop();
                calculateTotals();
            }
        });

        // Calculate and Display Totals
        function calculateTotals() {
            var totalCost = 0;
            var totalIncome = 0;
            dataTable.rows({ filter: 'applied' }).data().each(function(value, index) {
                var amount = parseFloat(value[2].replace(/[^0-9,-]+/g,"").replace(',', '.'));
                if (value[4] === 'Pembelian Barang') {
                    totalCost += amount;
                } else if (value[4] === 'Penjualan') {
                    totalIncome += amount;
                }
            });

            $('#totalCost').text('RP ' + totalCost.toLocaleString('id-ID', { minimumFractionDigits: 0 }));
            $('#totalIncome').text('RP ' + totalIncome.toLocaleString('id-ID', { minimumFractionDigits: 0 }));
        }

        // Initial Calculation
        calculateTotals();
    });
</script>
@endpush
