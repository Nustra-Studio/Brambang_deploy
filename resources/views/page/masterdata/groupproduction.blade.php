@extends('layout.master')
@push('custom-style')
<link href="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="data" id="Data-div">
    @php
        use App\Models\ProductionGroup;
        use App\Models\Barang;
        $productionGroups = ProductionGroup::all();
        $products = Barang::where('information', 'produk')->get();
    @endphp
</div>

<div class="container" id="Results">
    <div class="page-title-container">
        <div class="row g-0">
            <div class="col-auto mb-3 mb-md-0 me-auto">
                <div class="w-auto sw-md-30">
                    <a href="#" class="muted-link pb-1 d-inline-block breadcrumb-back">
                        <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
                        <span class="text-small align-middle">Home</span>
                    </a>
                    <h1 class="mb-0 pb-0 display-4" id="title">Group Production</h1>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-auto d-flex align-items-end justify-content-end mb-2 mb-sm-0 order-sm-3">
                <button type="button" class="btn btn-outline-primary btn-icon btn-icon-start ms-0 ms-sm-1 w-100 w-md-auto" data-bs-toggle="modal" data-bs-target="#addProductionGroupModal">
                    <i data-acorn-icon="plus"></i>
                    <span>Tambah Grup Produksi</span>
                </button>
            </div>
            </div>
    </div>
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
                                <th>Nama Grup</th>
                                <th>List Produk</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($productionGroups as $group)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $group->name }}</td>
                                <td>
                                    @foreach($group->barangs as $barang)
                                        <span class="badge rounded-pill bg-outline-primary">{{ $barang->name }}</span>
                                    @endforeach
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-primary d-flex justify-content-center align-items-center border shadow fw-bold p-2" data-bs-toggle="modal" data-bs-target="#editModal{{ $group->id }}">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger d-flex justify-content-center align-items-center border shadow fw-bold p-2" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $group->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </td>
                            </tr>

                            <div class="modal fade" id="editModal{{ $group->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Grup Produksi</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="POST" action="{{ route('productiongroup.update', $group->id) }}">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label class="form-label">Nama Grup</label>
                                                    <input type="text" name="name" class="form-control" value="{{ $group->name }}" />
                                                </div>
                                                <div class="mb-3 w-100">
                                                    <label class="form-label">List Produk</label>
                                                    <select name="items[]" class="form-select select2-edit" multiple>
                                                        @foreach ($products as $product)
                                                            <option value="{{ $product->id }}" @if($group->barangs->contains('id', $product->id)) selected @endif>{{ $product->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="modal-footer border-1">
                                            <button type="submit" class="btn btn-icon btn-icon-end btn-primary">
                                                <span>Simpan</span>
                                                <i data-acorn-icon="save"></i>
                                            </button>
                                        </div>
                                            </form>
                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="deleteModal{{ $group->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title fw-bold">Hapus Data?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Konfirmasi Hapus Data Grup Produksi **{{ $group->name }}**
                                        </div>
                                        <div class="modal-footer">
                                            <form method="POST" action="{{ route('productiongroup.destroy', $group->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger border shadow">Hapus</button>
                                                <button type="button" class="btn btn-primary border-1" data-bs-dismiss="modal">Batal</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal fade" id="addProductionGroupModal" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title fw-bold">Tambahkan Grup Produksi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('productiongroup.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Nama Grup</label>
                                    <input type="text" name="name" class="form-control" required />
                                </div>
                                <div class="mb-3 w-100">
                                    <label class="form-label">Pilih Produk</label>
                                    <select name="items[]" class="form-select select2-add" multiple="multiple" required>
                                        @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                                        @endforeach
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

@endsection

@push('custom-scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('js/plugin/datatables-net/jquery.dataTables.js') }}"></script>
<script src="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
<script src="{{ asset('js/data-table.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.select2-add').select2({
            dropdownParent: $('#addProductionGroupModal')
        });
        $('.select2-edit').select2({

        });
    });
</script>
@endpush
