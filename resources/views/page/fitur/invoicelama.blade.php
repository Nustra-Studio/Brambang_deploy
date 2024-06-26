@extends('layout.master')
@section('content')
@php
    use App\Models\Barang;
    use Carbon\Carbon;
    use App\Models\transaction;
    use App\Models\history;
    use App\Models\Customer;
@endphp
<style>
    .separator-darker {
        background-color: rgb(85, 13, 13);
    }
    .separator {
        border-bottom: 2px solid #330101;
    }
    .card-print {
        min-height: 100vh;
    }
    .{
        color: black;
    }
    @media print {
        body * {
            visibility: hidden;
        }
        .card-print, .card-print * {
            visibility: visible;
        }
        .card-print {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: white;
        }
        #btn-printer {
            display: none;
        }
    }
</style>
@php
    $transaksi = transaction::where('name',$kode_invoice)->where('information','nota')->first();
    $customer = Customer::where('id', $transaksi->id_customer)->value('name');
    $barang =  transaction::where('name',$kode_invoice)->where('information','penjualan')->get();
    $status = $transaksi->status;
    // $price = $data->input('price');
    // $produk = $data->input('produk');
    // $qty = $data->input('qty');
@endphp
<div class="container-fluid">
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
                <div class="col-12 col-md-6 ps-3">
                    <h1 class="ps-5">Bawang Goreng CYS</h1>
                    <h3 class="ps-5 ">Dsn Templek Ds Sukomoro, RT.1/RW.9, Sukomoro, Nganjuk 
                        <br>
                        SUKOMORO, KAB. NGANJUK, JAWA TIMUR, ID 6448
                    </h3>
                    <h2 class="ps-5 ">(+62) 812-3401-9125</h2>
                </div>
                <div class="col-12 col-md-6 pe-5 text-end">
                    <h2 class="pe-5 mb-2">Tanggal: {{$transaksi->created_at}}</h2>
                    <h2 class="pe-5 mb-2">Nota: {{$kode_invoice}}</h2>
                    <h2 class="pe-5">Customer: {{$customer}}</h2>
                </div>
            </div>
            <div class="separator separator-darker my-5 px-5"></div>
            <div class="mx-2">
                <div class="row mb-4 d-none d-sm-flex">
                    <div class="col-4 ps-4">
                        <p class="mb-0 ms-3 text-large">Product</p>
                    </div>
                    <div class="col-2">
                        <p class="mb-0 text-large">Jumlah</p>
                    </div>
                    <div class="col-3 text-center ps-2">
                        <p class="mb-0 text-large">Harga</p>
                    </div>
                    <div class="col-3 text-center pe-5">
                        <p class="mb-0 text-large">Total</p>
                    </div>
                </div>
                @foreach ($barang as $item)
                    @php
                        $barang = Barang::where('name', $item->id_barang)->first();
                        $harga = 'RP ' . number_format($item->price, 0, ',', '.');
                        $total_harga = 'RP ' . number_format($item->price * $item->qty, 0, ',', '.');
                    @endphp
                    <div class="row mb-4 mb-sm-2">
                        <div class="col-4 col-sm-4 ps-4">
                            <h3 class="mb-0 text-center">{{$barang->name}}</h3>
                        </div>
                        <div class="col-2 col-sm-2">
                            <p class="mb-0 text-large">{{$item->qty}} {{$barang->unit}}</p>
                        </div>
                        <div class="col-3 col-sm-3 ps-2  text-center">
                            <p class="mb-0 text-large">{{ $harga }}</p>
                        </div>
                        <div class="col-3 col-sm-3 text-center pe-5">
                            <p class="mb-0 text-large">{{ $total_harga }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="separator separator-darker mt-5 mb-3 px-5"></div>
            <div class="row me-5">
                <div class="col text-sm-end">
                    <div><p class="mb-0 text-large">Total :</p></div>
                    <div><p class="mb-0 text-large">@if ($status == 'Lunas') Status : @else Belum Lunas : @endif</p></div>
                    <div><p class="mb-0 text-large">Total Bayar :</p></div>
                </div>
                <div class="col-auto text-end">
                    @php
                        $bayar = 'RP ' . number_format($transaksi->qty, 0, ',', '.');
                        $total = 'RP ' . number_format($transaksi->price, 0, ',', '.');
                        $hutang = 'RP ' . number_format($transaksi->price - $transaksi->qty, 0, ',', '.');
                    @endphp
                    <div><p class="mb-0 text-large text-start">{{$total}}</p></div>
                    <div><p class="mb-0 text-large text-start">@if ($status == 'Lunas') Lunas @else {{$hutang}} @endif</p></div>
                    <div><p class="mb-0 text-large text-start">{{$bayar}}</p></div>
                </div>
            </div>
            <div class="separator separator-light mt-2 px-5"></div>
        </div>
    </div>
</div>
<script>
    function printDiv() {
        document.getElementById('btn-printer').classList.add('d-none');
        window.print();
        setTimeout(function() {
            document.getElementById('btn-printer').classList.remove('d-none');
        }, 300);
    }
</script>
@endsection
