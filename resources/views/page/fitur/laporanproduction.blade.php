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
            use App\Models\history;
            use App\Models\Absen;
            $produksi = produksi::where('information','finish')->get();
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
                        <h1 class="mb-0 pb-0 display-3" id="title">Laporan Production</h1>
                    </div>
                </div>
                <!-- Title End -->

                <!-- Top Buttons Start -->
                <div class="w-100 d-md-none"></div>
                <!-- Top Buttons End -->
            </div>
        </div>
        <!-- Title and Top Buttons End -->

        <!-- Controls End -->

        <!-- Discount List Start -->
        <div class="row">
            <div class="col-12 mb-5">
                @if (session('success'))
                    <div class="alert alert-primary">
                        {{ session('success')}}
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
                                    <th>Keuntungan</th>
                                </tr>
                            </thead>
                            <tbody id="tb-category">
                                @foreach ($produksi as $item)
                                    <tr>
                                        @php
                                            $produksis = costproduksi::where('id_produksi',$item->unit)->get();
                                            $produk = Barang::where("id",$item->id_product)->value('name');
                                            $trasnport = history::where('information','trasnportasi')->where('unit',$item->unit)->value('price');
                                            $oprasional = history::where('information','oprasional')->where('unit',$item->unit)->value('price');
                                            $gaji = Absen::where('date',$item->start)->sum('more');
                                            $cost = 0;
                                            foreach ($produksis as $produksi) {
                                                $biayaItemProduksi = $produksi->qty * $produksi->price + $trasnport + $gaji +$oprasional;
                                                $cost += $biayaItemProduksi;
                                            }
                                            $cost = 'RP ' . number_format($cost, 0, ',', '.');
                                            // ke utungan 
                                            $untung =0;
                                            $history = history::where('information','Hasil Production')->where('unit',$item->unit)->get();
                                            foreach ($history as $key => $sub) {
                                                $produk = Barang::where("name",$sub->name)->value('price');
                                                $untung += $produk * $sub->price;
                                            }
                                            $untung = 'RP ' . number_format($untung, 0, ',', '.');
                                        @endphp
                                        <td>{{ $loop->index+1 }}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->start}}</td>
                                        <td>{{$cost}}</td>
                                        <td>{{$untung}}</td>
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
                            const names = data.name;
                            const no = productTable.rows().count() + 1; // Get the row count and increment by 1
                            const newRow = productTable.row.add([no, names, jumlah, harga, deleteButton]).draw();
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

                    existingValues.splice(rowIndex, 1); // Remove data from existingValues
                    $('#data-table-values').val(JSON.stringify(existingValues)); // Update the input value

                    productTable.row(rowNode).remove().draw(); // Remove the row from the table
                    renumberRows(); // Renumber the rows after a deletion
                }

                function renumberRows() {
                    productTable.rows().every(function(index) {
                        const data = this.data();
                        data[0] = index + 1; // Update the "No" column with the new index
                        this.data(data).draw();
                    });
                }

    </script>
     <script>
        function updateprice() {
            const product = document.getElementById('product_select').value;
            const totalSpan = document.querySelector('.total');
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
                    if (typeof data === 'undefined' || typeof data.qty === 'undefined') {
                        stock = 0;
                    } else {
                        var stock = (data.qty < 1) ? 0 : data.qty;
                    }
                    totalSpan.textContent = 'stock:'+' ' + stock;

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
