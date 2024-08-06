@extends('layout.master')
@push('custom-style')
<link href="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush

@section('content')
<div class="data" id="Data-div">
    @php
    use App\Models\Barang;
    $data = Barang::where('information','produk')->get();
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
            <div class="col-12 col-sm-6 col-md-auto d-flex align-items-end justify-content-end mb-2 mb-sm-0 order-sm-3">
                <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start ms-0 ms-sm-1 w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#addProdukModal">
                    <i data-acorn-icon="plus"></i>
                    <span>Tambah Produk</span>
                </button>
                {{-- <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start ms-0 ms-sm-1 w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#BeliProduk">
                    <i data-acorn-icon="plus"></i>
                    <span>Pembelian Produk</span>
                </button> --}}
            </div>
            <!-- Top Buttons End -->
        </div>
    </div>
    <!-- Title and Top Buttons End -->

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
                                <th>Harga</th>
                                <th>Stock</th>
                                <th>Satuan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="tb-category">
                            @foreach ($data as $item)
                            @php
                                $basic_price = 'RP ' . number_format($item->basic_price, 0, ',', '.');
                                $price = 'RP ' . number_format($item->price, 0, ',', '.');
                            @endphp
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $price }}</td>
                                <td>{{ $item->qty }}</td>
                                <td><span class="badge rounded-pill bg-outline-primary">{{ $item->unit }}</span></td>
                                <td>
                                    <button class="btn btn-sm btn-primary d-flex justify-content-center align-items-center border shadow fw-bold p-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger d-flex justify-content-center align-items-center border shadow fw-bold p-2" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{ $item->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <!-- Edit Modal Start -->
                            <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                    <input type="text" name="name" class="form-control" value="{{ $item->name }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Harga</label>
                                                    <input type="text" name="price" class="form-control" value="{{ $item->price }}" />
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Stok</label>
                                                    <input type="text" name="qty" class="form-control" value="{{ $item->qty }}" />
                                                </div>
                                                <div class="mb-3 w-100">
                                                    <label class="form-label">Satuan</label>
                                                    <select name="unit" class="form-select">
                                                        <option @if($item->unit === 'PCS') selected @endif value="PCS">PCS</option>
                                                        <option @if($item->unit === 'KG') selected @endif value="KG">KG</option>
                                                        <option @if($item->unit === 'Liter') selected @endif value="Liter">Liter</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="modal-footer border-1">
                                            <button type="submit" class="btn btn-icon btn-icon-end btn-primary">
                                                <span>Save</span>
                                                <i data-acorn-icon="save"></i>
                                            </button>
                                        </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                            <!-- Edit Modal End -->

                            <!-- Delete Modal Start -->
                            <div class="modal fade" id="deleteUserModal{{ $item->id }}" tabindex="-1" role="dialog" aria-hidden="true">
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
                                                <button type="button" class="btn btn-primary border-1" data-bs-dismiss="modal">Batal</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Delete Modal End -->
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Add Produk Modal Start -->
            <div class="modal fade" id="addProdukModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Tambahkan Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('barang.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="text" name="price" id="harga_add" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Stok</label>
                                    <input type="text" name="qty" id="qty_add" class="form-control" />
                                </div>
                                {{-- <div class="mb-3">
                                    <label class="form-label">Bayar</label>
                                    <div class="input-group">
                                        <input type="text" name="bayar" id="bayars_add" class="form-control" />
                                        <span class="input-group-text">Sisa:</span>
                                        <span class="input-group-text" id="sisas_add"></span>
                                    </div>
                                </div> --}}
                                <div class="mb-3 w-100">
                                    <label class="form-label">Category</label>
                                    <select name="category" class="form-select">
                                        <option value="produk">Produk</option>
                                    </select>
                                </div>
                                <div class="mb-3 w-100">
                                    <label class="form-label">Satuan</label>
                                    <select name="unit" class="form-select">
                                        <option value="PCS">PCS</option>
                                        <option value="KG">KG</option>
                                        <option value="Liter">Liter</option>
                                        <option value="Kardung">Kardus</option>
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
            <!-- Add Produk Modal End -->

            <!-- Beli Produk Modal Start -->
            <div class="modal fade" id="BeliProduk" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Beli Produk</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('barang.add') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    @php
                                        $barang = Barang::all();
                                    @endphp
                                    <select name="produk" class="form-select">
                                        @foreach ($barang as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="text" name="price" id="harga_beli" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Stok</label>
                                    <input type="text" name="qty" id="qty_beli" class="form-control" />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Bayar</label>
                                    <div class="input-group">
                                        <input type="text" name="bayar" id="bayar_beli" class="form-control" />
                                        <span class="input-group-text">Total:</span>
                                        <span class="input-group-text" id="total_beli"></span>
                                    </div>
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
            <!-- Beli Produk Modal End -->
        </div>
    </div>
</div>

@endsection

@push('custom-scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updatePrice() {
        $('select[name="produk"]').on('change', function () {
            const productId = this.value;
            const url = `/dataresource/barang/?namaproduct=${productId}`;
            const modalBody = $(this).closest('.modal-body');
            $.ajax({
                type: 'GET',
                url: url,
                success: function(data) {
                    modalBody.find('input[name="price"]').val(data.price);
                    calculateSisa(modalBody);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error:', textStatus, errorThrown);
                }
            });
        });
    }

    function calculateSisa(modalBody) {
        const qtyInput = parseFloat(modalBody.find('input[name="qty"]').val());
        const priceInput = parseFloat(modalBody.find('input[name="price"]').val());
        const bayarInput = parseFloat(modalBody.find('input[name="bayar"]').val());

        if (!isNaN(qtyInput) && !isNaN(priceInput)) {
            const total = priceInput * qtyInput;
            modalBody.find('#total_beli').text(total.toLocaleString('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0,
                style: 'currency',
                currency: 'IDR'
            }));

            if (!isNaN(bayarInput)) {
                const sisa = total - bayarInput;
                modalBody.find('#total_beli').text(sisa.toLocaleString('id-ID', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0,
                    style: 'currency',
                    currency: 'IDR'
                }));
            } else {
                modalBody.find('#total_beli').text(total.toLocaleString('id-ID', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0,
                    style: 'currency',
                    currency: 'IDR'
                }));
            }
        } else {
            modalBody.find('#total_beli').text('0');
            modalBody.find('#sisa_beli').text('0');
        }
    }

    function calculateSisas() {
        const qtyInput = parseFloat($('#qty_add').val());
        const priceInput = parseFloat($('#harga_add').val());
        const bayarInput = parseFloat($('#bayars_add').val());

        if (!isNaN(qtyInput) && !isNaN(priceInput)) {
            const total = priceInput * qtyInput;

            if (!isNaN(bayarInput)) {
                const sisa = total - bayarInput;
                $('#sisas_add').text(sisa.toLocaleString('id-ID', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0,
                    style: 'currency',
                    currency: 'IDR'
                }));
            } else {
                $('#sisas_add').text(total.toLocaleString('id-ID', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 0,
                    style: 'currency',
                    currency: 'IDR'
                }));
            }
        } else {
            $('#total_add').text('0');
            $('#sisas_add').text('0');
        }
    }

    $(document).ready(function() {
        updatePrice();
        $('input[name="qty"], input[name="price"], input[name="bayar"]').on('input', function() {
            const modalBody = $(this).closest('.modal-body');
            calculateSisa(modalBody);
        });
        $('#qty_add, #harga_add, #bayars_add').on('input', function() {
            calculateSisas();
        });
    });
</script>
<script src="{{ asset('js/plugin/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('js/data-table.js') }}"></script>
@endpush
