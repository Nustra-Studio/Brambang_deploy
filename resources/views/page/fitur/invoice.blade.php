@extends('layout.master')
@section('content')
@php
    // dd($data);
    use App\Models\Barang;
@endphp
<style>
    .separator-darker{
        background-color: rgb(126, 29, 29);
    }
    .separator {
        border-bottom: 2px solid #6b0000;
    }
</style>
    @php
            $price = $data->input('price');
            $produk = $data->input('produk');
            $qty = $data->input('qty');
    @endphp
    <div class="container->fluid">
            <div class="row" id="btn-printer">
                <div class="col-12 d-flex align-items-center justify-content-end">
                    <button onclick="printDiv()" class="btn btn-outline-primary btn-icon btn-icon-start w-100 w-md-auto">
                        <i data-acorn-icon="print"></i>
                        <span>Print</span>
                    </button>
                </div>
            </div>
        <div class="card mb-5 card-print print-me" id="cardprint">
            <div class="card-body">
                <div class="row d-flex flex-row align-items-center pt-2">
                    <div class="col-12  col-md-6 ps-3">
                        <h1 class="ps-4">Brambang Nganjuk</h1>
                        <div class="ps-4 text-semi-large text-muted">Jalan Kengan 12 <br> Nganjuk ,JawaTimur </div>
                        <div class="ps-4 text-semi-large text-muted">+6443884455</div>
                        
                    </div>
                    <div class="col-12 col-md-6 pe-3 text-end">
                        <h2 class="pe-4 mb-2">Tanggal: {{date('Y-m-d')}}</h2>
                        <h2 class="pe-4 mb-2">Nota: {{$kode_invoice}}</h2>
                        <h2 class="pe-4">Customer : {{$customer}}</h2>
                    </div>
                </div>
                <div class="separator separator-darker mt-5 mb-5"></div>
            

                <div class="mx-2">
                    <div class="row mb-4 d-none d-sm-flex">
                        <div class="col-4 ps-3">
                            <p class="mb-0 ms-3 text-large text-muted">Product</p>
                        </div>
                        <div class="col-2">
                            <p class="mb-0 text-large text-muted">Jumlah</p>
                        </div>
                        <div class="col-3 text-end">
                            <p class="mb-0 text-large text-muted">Harga</p>
                        </div>
                        <div class="col-3 text-end pe-3">
                            <p class="mb-0 text-large text-muted">Total</p>
                        </div>
                    </div>
                    @for ($i = 0; $i < count($produk); $i++)  
                            @php
                                $barang = Barang::where('id',$produk[$i])->first();
                                $harga = 'RP ' . number_format($price[$i], 0, ',', '.');
                                $total_harga = 'RP ' . number_format($price[$i] * $qty[$i], 0, ',', '.');
                            @endphp
                        <div class="row mb-4 mb-sm-2">
                            <div class="col-4 col-sm-4 ps-3">
                                <h3 class="mb-0">{{$barang->name}}</h3>
                            </div>
                            <div class="col-2 col-sm-2">
                                <p class="mb-0 text-large">{{$qty[$i]}} Item</p>
                            </div>
                            <div class="col-3 col-sm-3 text-end">
                                <p class="mb-0 text-large">{{ $harga }}</p>
                            </div>
                            <div class="col-3 col-sm-3 text-end pe-3">
                                <p class="mb-0 text-large">{{ $total_harga }}</p>
                            </div>
                        </div>
                    @endfor
                </div>

                <div class="separator separator-darker mt-5 mb-3"></div>

                <div class="row me-5">
                    <div class="col text-sm-end ">
                        <div class=""><p class="mb-0 text-large">Total :</p></div>
                        <div class=""><p class="mb-0 text-large">@if ($status == 'Lunas')
                            Status :
                        @else
                            Hutang :
                        @endif</p></div>
                        <div class=""><p class="mb-0 text-large">TotalBayar :</p></div>
                    </div>
                    <div class="col-auto text-end">
                        @php
                            $bayar = 'RP ' . number_format($data->bayar, 0, ',', '.');
                            $total = 'RP ' . number_format($data->total_belanja, 0, ',', '.');
                            $hutang = 'RP ' . number_format($data->total_belanja - $data->bayar, 0, ',', '.');

                        @endphp
                        <div class=""><p class="mb-0 text-large text-start"">{{$total}}</p></div>
                        <div class=""><p class="mb-0 text-large text-start">@if ($status == 'Lunas')
                            Lunas
                        @else
                            {{$hutang}}
                        @endif</p></div>
                        <div class=""><p class="mb-0 text-large text-start"">{{$bayar}}</p></div>
                    </div>
                </div>

                <div class="separator separator-light mt-2"></div>
            </div>
        </div>
    </div>
    <script>
        function printDiv(){
            document.getElementById('btn-printer').classList.add('d-none');
            window.print();
            setTimeout(function(){
                document.getElementById('btn-printer').classList.remove('d-none');
            },300);
        }
    </script>
@endsection
