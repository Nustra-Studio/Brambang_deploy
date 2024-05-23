@extends('layout.master')
@push('custom-style')
<link href="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush
@section('content')
<div class="container">
    <!-- Title and Top Buttons Start -->
    <div class="page-title-container">
        <div class="row g-0">
            @php
                use App\Models\Barang;
                use App\Models\Customer;
                use App\Models\transaction;
                use App\Models\history;
                $data = transaction::where('status','belum_lunas')->where('information','nota')->get();
                $barang = Barang::all();
                $customer = Customer::all();
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

    <!-- Discount List Start -->
    <div class="row">
        <div class="col-12 mb-5">
            <!-- start LOOP -->
            <div class="card mb-2">
                @if (session('success'))
                <script>
                    showAlert('success', '{{ session('success') }}');
                </script>
                @endif
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <th>No</th>
                                <th>No.Nota</th>
                                <th>Hutang</th>
                                <th>Total Bayar</th>
                                <th>Status</th>
                                <th>Customer</th>
                                <th>Action</th>
                            </thead>
                            <tbody id="tb-category">
                                @foreach ($data as $index => $item)
                                @if ($item->id_customer != 'owner')
                                @php
                                    $basic_price = $item->price * $item->qty;
                                    $price = 'RP ' . number_format($item->price, 0, ',', '.');
                                    $total = 'RP ' . number_format($item->qty, 0, ',', '.');
                                    $dibayar = 'RP ' . number_format($item->price - $item->qty, 0, ',', '.');
                                    $customer = Customer::find($item->id_customer);
                                @endphp
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{ $price }}</td>
                                    <td>{{ $total }}</td>
                                    <td>
                                        <span class="badge rounded-pill bg-outline-danger">{{ $item->status }}</span>
                                    </td>
                                    <td>
                                        {{ !empty($customer->name) ? $customer->name : 'Non' }}
                                    </td>
                                    <td>
                                        <div class="col pt-lg-2">
                                            <button class="btn btn-primary d-flex justify-content-center align-items-center border shadow fw-bold p-lg-2 p-xl-3" data-bs-toggle="modal" data-bs-target="#editProdukmodal{{ $item->id }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </button>
                                        </div>
                                    </td>
                                    <!-- Modal Edit -->
                                </tr>
                                                                    
                                @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($data as $item)
    @php
        $dibayar = 'RP ' . number_format($item->price - $item->qty, 0, ',', '.');
        $cicilan = history::where('name',$item->name)->where('information','Pembayaran Hutang')->get();
    @endphp
                <div class="modal fade" id="editProdukmodal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Edit Pembayaran</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body px-5">
                                <form action="{{ route('transaction.update', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3 w-100">
                                        <label class="form-label">Total Hutang</label>
                                        <input type="text" disabled class="form-control" value="{{$dibayar}}">
                                        <label class="form-label">Pembayaran</label>
                                        <input type="text" name="bayar" class="form-control">
                                    </div>
                                    <table>
                                        <table id="dataTableExample" class="table">
                                            <thead>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th>Nominal</th>
                                                <th>date</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($cicilan as $index => $sub)
                                                @php
                                                    $nominal = 'RP ' . number_format($sub->price, 0, ',', '.');
                                                @endphp
                                                    <tr>
                                                        <td>{{$index +1}}</td>
                                                        <td>{{$sub->name}}</td>
                                                        <td>{{$nominal}}</td>
                                                        <td>{{$sub->created_at}}</td>
                                                    </tr>
                                                @endforeach
                                                
                                            </tbody>
                                        </table>
                                    </table>
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
    <!-- Discount List End -->

    <!-- Discount Add Modal Start -->
    <div class="modal fade" id="addProdukModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Tambahkan Penjualan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @php
                    $barang = Barang::where('information','produk')->get();
                    $customer = Customer::all();
                @endphp
                <div class="modal-body">
                    <form action="{{ route('transaction.store') }}" method="POST" id="transactionForm">
                        @csrf
                        <div id="product-container">
                            <div class="product-item mb-3">
                                <label class="form-label">Product</label>
                                <select name="produk[]" class="form-select">
                                    <option value=""></option>Select Product
                                    @foreach ($barang as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <label class="form-label">Harga</label>
                                <input type="text" name="price[]" class="form-control price" />
                                <label class="form-label">Jumlah</label>
                                <div class="input-group">
                                    <span class="input-group-text Stock">Stock:</span>
                                    <input type="text" name="qty[]" class="form-control qty" />
                                    <span class="input-group-text">Total:</span>
                                    <span class="input-group-text total">0</span>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-secondary" id="addProductBtn">Tambah Produk</button>
                        <div class="mb-3 w-100">
                            <label class="form-label">Customer</label>
                            <select name="customer" class="form-select">
                                <option value="0">None</option>
                                @foreach ($customer as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Bayar</label>
                            <div class="input-group">
                                <input type="text" name="bayar" class="form-control" id="bayar" />
                                <span class="input-group-text">Sisa:</span>
                                <span class="input-group-text" id="sisa">0</span>
                                <input type="hidden" name="total_belanja" class="d-none" id="total_belanja" value="" />
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
    <!-- Discount Add Modal End -->
</div>
@endsection

@push('custom-scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updatePrice() {
        const productSelect = document.querySelectorAll('select[name="produk[]"]');
        productSelect.forEach(select => {
            select.addEventListener('change', function () {
                const productId = this.value;
                const url = `/dataresource/barang/?namaproduct=${productId}`; // Corrected URL assuming it's the correct endpoint
                $.ajax({
                    type: 'GET',
                    url: url,
                    success: function(data) {
                        console.log(data);
                        const price = data.price; // Adjust this based on your actual response structure
                        const priceInput = select.parentElement.querySelector('input[name="price[]"]');
                        const Stock = select.parentElement.querySelector('.Stock');
                        Stock.textContent=  "Stock:"+" "+ data.qty;
                        priceInput.value = price;
                        calculateTotal();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error:', textStatus, errorThrown);
                    }
                });
            });
        });
    }


    function calculateTotal() {
        const productItems = document.querySelectorAll('.product-item');
        productItems.forEach(item => {
            const priceInput = item.querySelector('input[name="price[]"]');
            const qtyInput = item.querySelector('input[name="qty[]"]');
            const totalSpan = item.querySelector('.total');
            const price = parseFloat(priceInput.value) || 0;
            const qty = parseInt(qtyInput.value) || 0;
            const total = price * qty;
            totalSpan.textContent = total.toLocaleString('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0,
                style: 'currency',
                currency: 'IDR'
            });
        });
    }

    function totalBayar() {
        const priceInputs = document.querySelectorAll('input[name="price[]"]');
        const qtyInputs = document.querySelectorAll('input[name="qty[]"]');
        const bayar = parseInt(document.getElementById('bayar').value) || 0;
        let total = 0;
        priceInputs.forEach((priceInput, index) => {
            const qtyInput = qtyInputs[index];
            total += (parseFloat(priceInput.value) || 0) * (parseInt(qtyInput.value) || 0);
        });
        const kurang = total - bayar;
        document.getElementById('sisa').textContent = kurang.toLocaleString('id-ID', {
            minimumFractionDigits: 0,
            maximumFractionDigits: 0,
            style: 'currency',
            currency: 'IDR'
        });
        document.getElementById('total_belanja').value=total;
    }

    document.addEventListener('DOMContentLoaded', function() {
        updatePrice();
        calculateTotal();
        totalBayar();

        document.getElementById('addProductBtn').addEventListener('click', function () {
            const productContainer = document.getElementById('product-container');
            const productItem = document.createElement('div');
            productItem.classList.add('product-item', 'mb-3');
            productItem.innerHTML = `
                <label class="form-label">Product</label>
                <select name="produk[]" class="form-select produk">
                    @foreach ($barang as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                <label class="form-label">Harga</label>
                <input type="text" name="price[]" class="form-control price" />
                <label class="form-label">Jumlah</label>
                <div class="input-group">
                    <input type="text" name="qty[]" class="form-control qty" />
                    <span class="input-group-text">Total:</span>
                    <span class="input-group-text total">0</span>
                </div>
            `;
            productContainer.appendChild(productItem);
            updatePrice();
            calculateTotal();
        });

        document.addEventListener('input', function(event) {
            if (event.target.matches('input[name="price[]"], input[name="qty[]"], #bayar')) {
                calculateTotal();
                totalBayar();
            }
        });
    });

</script>

<script src="{{ asset('js/plugin/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('js/data-table.js') }}"></script>
@endpush
