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
                use App\Models\Karyawan;
                use App\Models\Gaji;
                $data = Karyawan::all();

            @endphp
            <!-- Title Start -->
            <div class="col-auto mb-3 mb-md-0 me-auto">
            <div class="w-auto sw-md-30">
                <a href="#" class="muted-link pb-1 d-inline-block breadcrumb-back">
                <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
                <span class="text-small align-middle">Home</span>
                </a>
                <h1 class="mb-0 pb-0 display-4" id="title">Karyawan</h1>
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
                data-bs-target="#addKaryawanModal"
            >
                <i data-acorn-icon="plus"></i>
                <span>Tambah Karyawan</span>
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
                    @elseif (session('hapus'))
                        <script>
                            showAlert('error', '{{ session('hapus') }}');
                        </script>
                    @endif
                   
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="dataTableExample" class="table">
                                <thead>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No. Hp</th>
                                    <th>Alamat</th>
                                    <th>Gaji Harian</th>
                                    <th>Uang Bensin</th>
                                    <th>Uang Makan</th>
                                    <th>Jabatan</th>
                                    <th>Action</th>
                                </thead>
                                <tbody id="tb-category">
                                    @foreach ($data as $index => $item)
                                    @php
                                        $bensin = Gaji::where('id_karyawan',$item->id)->where('name','bensin')->value('total');
                                        $makan = Gaji::where('id_karyawan',$item->id)->where('name','makan')->value('total');
                                        $gaji = $item->salary;
                                        $gaji = 'Rp' . number_format($gaji, 0, ',', '.');
                                        $bensins = 'Rp' . number_format($bensin, 0, ',', '.');
                                        $makans = 'Rp' . number_format($makan, 0, ',', '.');
                                    @endphp
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->hp}}</td>
                                        <td>{{$item->address}}</td>
                                        <td>{{$gaji}}</td>
                                        <td>{{$bensin}}</td>
                                        <td>{{$makan}}</td>
                                        <td>{{$item->department}}</td>
                                        <td>
                                            <div class="container-fluid d-lg-flex flex-lg-row gap-1 gap-lg-2 justify-content-lg-end">
                                                <div class="col">
                                                    <button class="btn btn-primary d-flex justi fy-content-center align-items-center border shadow fw-bold p-lg-2 p-xl-3" data-bs-toggle="modal" data-bs-target="#editUserModal{{$item->id}}">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </button>
                                                </div>
                                                <div class="col">
                                                    <button class="btn btn-danger d-flex justify-content-center align-items-center border shadow fw-bold p-lg-2 p-xl-3" data-bs-toggle="modal" data-bs-target="#deleteUserModal{{$item->id}}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                    <div class="modal fade" id="editUserModal{{$item->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title fw-bold">Edit Karyawan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{Route('karyawan.update', $item->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label class="form-label">Nama</label>
                                    <input type="text" name="name" class="form-control" value="{{$item->name}}"/>
                                </div>
                                <div class="mb-3 w-100">
                                    <label class="form-label">No Hp.</label>
                                    <input type="text" name="hp" class="form-control" value="{{$item->hp}}">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Alamat</label>
                                    <input type="text" name="address" class="form-control" value="{{$item->address}}"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Gaji Harian</label>
                                    <input type="number" name="salary" class="form-control" value="{{$item->salary}}"/>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Uang Bensin</label>
                                    <input type="number" name="bensin" class="form-control" value=@if(!empty($bensin)){{$bensin}} @else{{0}} @endif />
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Uang Makan</label>
                                    <input type="number" name="makan" class="form-control"value=@if(!empty($makan)){{$makan}} @else{{0}} @endif />
                                </div>
                                <div class="mb-3 w-100">
                                    <label class="form-label">Jabatan</label>
                                    <select class="form-select" name="department" aria-placeholder="Pilih jabatan">
                                        <option @if ($item->department === 'Karyawan') selected @endif value="Karyawan">Karyawan</option>
                                        <option @if ($item->department === 'Manager') selected @endif value="Manager">Manager</option>
                                        <option @if ($item->department === 'Supervisor') selected @endif value="Supervisor">Supervisor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button class="btn btn-icon btn-icon-end btn-primary" type="submit">
                                    <span>Tambah</span>
                                    <i data-acorn-icon="plus"></i>
                                </button>
                            </div>
                        </form>
                            </div>
                            
                        </div>
                    </div>
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
                                <form action="{{route('karyawan.destroy', $item->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger border shadow" type="submit">Hapus</button>
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
                        </div>
        </div>
        </div>
        {{-- add karyawan --}}
        <!-- Discount Add Modal Start -->
        <div class="modal fade" id="addKaryawanModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Tambahkan Karyawan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{Route('karyawan.store')}}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control" />
                </div>
                <div class="mb-3 w-100">
                    <label class="form-label">No Hp.</label>
                    <input type="text" name="hp" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <input type="text" name="address" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Gaji Harian</label>
                    <input type="number" name="salary" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Uang Bensin</label>
                    <input type="number" name="bensin" class="form-control" />
                </div>
                <div class="mb-3">
                    <label class="form-label">Uang Makan</label>
                    <input type="number" name="makan" class="form-control" />
                </div>
                <div class="mb-3 w-100">
                    <label class="form-label">Jabatan</label>
                    <select class="form-select" name="department" aria-placeholder="Pilih jabatan">
                    <option value="Karyawan">Karyawan</option>
                    <option value="Manager">Manager</option>
                    <option value="Supervisor">Supervisor</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-icon btn-icon-end btn-primary" type="submit">
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
    <script src="{{ asset('js/plugin/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('js/data-table.js') }}"></script>
    @endpush