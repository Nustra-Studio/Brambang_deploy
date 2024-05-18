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
                use App\Models\Absen;
                $data = Absen::where('id_karyawan',$id)->get();

            @endphp
                <div class="col-auto mb-3 mb-md-0 me-auto">
                    <div class="w-auto sw-md-30">
                        <a href="/" class="muted-link pb-1 d-inline-block breadcrumb-back">
                        <i data-acorn-icon="chevron-left" data-acorn-size="13"></i>
                        <span class="text-small align-middle">Home</span>
                        </a>
                        <h1 class="mb-0 pb-0 display-4" id="title">Detail Gaji</h1>
                    </div>
                    </div>
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
                                    <th>Date</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                </thead>
                                <tbody id="tb-category">
                                    @foreach ($data as $index => $item)
                                    <tr>
                                        <td>{{$index + 1}}</td>
                                        <td>{{$item->date}}</td>
                                        <td>{{$item->more}}</td>
                                        <td>{{$item->status}}</td>
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
    <script src="{{ asset('js/plugin/datatables-net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('js/plugin/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
    <script src="{{ asset('js/data-table.js') }}"></script>
    @endpush