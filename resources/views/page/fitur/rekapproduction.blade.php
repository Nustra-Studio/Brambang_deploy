@extends('layout.master')
@section('content')
@php
    use App\Models\Barang;
    use App\Models\produksi;
    use App\Models\costproduksi;
    use App\Models\history;
    use App\Models\Absen;
    use App\Models\keuangan;
    use App\Models\bank;
    use App\Models\hutang;
    use App\Models\transaction;
    $item = produksi::where('id',$kode_invoice)->first();
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
            $produksis = costproduksi::where('id_produksi',$item->unit)->get();
            $produk = Barang::where("id",$item->id_product)->value('name');
            $trasnport = history::where('information','trasnportasi')->where('unit',$item->unit)->value('price');
            $oprasional = history::where('information','oprasional')->where('unit',$item->unit)->value('price');
            $trasnports = history::where('information','trasnportasi')->where('unit',$item->unit)->first();
            $oprasionals = history::where('information','oprasional')->where('unit',$item->unit)->first();
            $gaji = Absen::where('date',$item->start)->sum('more');
            $costs = 0  + $trasnport + $gaji +$oprasional ;
            foreach ($produksis as $produksi) {
                $biayaItemProduksi = $produksi->qty * $produksi->price;
                $costs += $biayaItemProduksi;
            }
            $cost = 'RP ' . number_format($costs, 0, ',', '.');
            // ke utungan
            $untung =0;
            $history = history::where('information','Hasil Production')->where('unit',$item->unit)->get();
            foreach ($history as $key => $sub) {
                $produk = Barang::where("name",$sub->name)->value('price');
                $untung += $produk * $sub->price;
            }
            $untung = $untung - $costs;
            $untung = 'RP ' . number_format($untung, 0, ',', '.');
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
            <div class="separator separator-light mt-2 px-5"></div>
            <div class="row mt-5">
                <div class="col-12 text-center mb-5">
                    <p class="mb-0 ms-3 text-large">Laporan Produksi</p>
                </div>
            </div>
            <div class="separator separator-darker  px-5"></div>
            <div class="mx-2">
                <div class="row mb-3 d-none d-sm-flex">
                    <div class="col-3 ps-4">
                        <p class="mb-0 ms-3 text-large">Nama</p>
                    </div>
                    <div class="col-3">
                        <p class="mb-0 text-large">Mulai</p>
                    </div>
                    <div class="col-3 text-center">
                        <p class="mb-0 text-large">Biaya</p>
                    </div>
                    <div class="col-3 text-center ">
                        <p class="mb-0 text-large">Keuntungan</p>
                    </div>
                </div>
                    <div class="row mb-4 mb-sm-2">
                        <div class="col-3  ps-4">
                            <h3 class="mb-0 ">{{$item->name}}</h3>
                        </div>
                        <div class="col-3 ">
                            <p class="mb-0 text-large">{{$item->start}}</p>
                        </div>
                        <div class="col-3   text-center">
                            <p class="mb-0 text-large">{{$cost}}</p>
                        </div>
                        <div class="col-3  text-center ">
                            <p class="mb-0 text-large">{{$untung}}</p>
                        </div>
                    </div>

            </div>

            <div class="separator separator-light mt-4 px-5"></div>
            <div class="row mt-3">
                <div class="col-12 text-center mb-2">
                    <p class="mb-0 ms-3 text-large">Detail Biaya Produksi</p>
                </div>
            </div>
            <div class="separator separator-light mt-2 px-5"></div>
            <div class="row mx-5 ">
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th class="ps-5">Total</th>
                            </tr>
                        </thead>
                        <tbody id="tb-category">
                            @php
                                $index =0;
                            @endphp
                            @foreach ($produksis as $item)
                            @php
                                $produk = Barang::where("id",$item->name)->value('name');
                            @endphp
                                <tr>
                                    <td>
                                        @php
                                            $index += 1;
                                        @endphp
                                        {{$loop->index+1}}
                                    </td>
                                    <td>
                                        {{$produk}}
                                    </td>
                                    <td>
                                        {{ 'RP ' . number_format($item->price, 0, ',', '.');}}
                                    </td>
                                    <td>
                                        {{$item->qty}}
                                    </td>
                                    <td>
                                        {{ 'RP ' . number_format($item->price * $item->qty , 0, ',', '.');}}
                                    </td>
                                </tr>
                                @endforeach
                                <tr>
                                    <td>
                                        @php
                                            $index += 1;
                                        @endphp
                                        {{$index }}
                                    </td>
                                    <td>
                                        Oprasional
                                    </td>
                                    <td>
                                        {{ 'RP ' . number_format($oprasionals->price ?? 0, 0, ',', '.');}}
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        {{ 'RP ' . number_format($oprasionals->price ?? 0, 0, ',', '.');}}
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        @php
                                            $index += 1;
                                        @endphp
                                        {{$index }}
                                    </td>
                                    <td>
                                        Trasnportasi
                                    </td>
                                    <td>
                                        {{ 'RP ' . number_format($trasnports->price ?? 0, 0, ',', '.');}}
                                    </td>
                                    <td>

                                    </td>
                                    <td>
                                        {{ 'RP ' . number_format($trasnports->price ?? 0, 0, ',', '.');}}
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="separator separator-light mt-2 px-5"></div>
            <div class="row mt-3">
                <div class="col-12 text-center mb-2">
                    <p class="mb-0 ms-3 text-large">Hasil Produksi</p>
                </div>
            </div>
            <div class="separator separator-light mt-2 px-5"></div>
            <div class="row mx-5">
                <div class="table-responsive">
                    <table id="dataTableExample" class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th class="ps-5">Total</th>
                            </tr>
                        </thead>
                        <tbody id="tb-category">
                            @foreach ($history as $item)
                            @php
                                $produk = Barang::where("id",$item->name)
                                ->orWhere('name',$item->name)
                                ->first();
                            @endphp
                                <tr>
                                    <td>
                                        @php
                                            $index += 1;
                                        @endphp
                                        {{$loop->index+1}}
                                    </td>
                                    <td>
                                        {{$produk->name ?? ""}}
                                    </td>
                                    <td>
                                        {{ 'RP ' . number_format($produk->price ?? 0 , 0, ',', '.');}}
                                    </td>
                                    <td>
                                        {{$item->price}}
                                    </td>
                                    <td>
                                        @php
                                            $total_harga =  $item->price   * $produk->price;
                                        @endphp
                                        {{ 'RP ' . number_format($total_harga ?? 0 , 0, ',', '.');}}
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="separator separator-light mt-2 px-5"></div>
            <div class="row mt-3">
                <div class="col-12 text-center mb-2">
                    <p class="mb-0 ms-3 text-large">Laporan Asset</p>
                </div>
            </div>
            <div class="separator separator-light mt-2 px-5"></div>
            {{-- laporan php --}}
            @php
                $data = keuangan::all();
                // bank
                $bank = bank::sum('saldo');
                $banks = 'RP ' . number_format($bank, 0, ',', '.');
                // bahan baku
                $bahan_bakus = 0;
                $data_bahan = Barang::where('information','bahan_baku')->get();
                foreach ($data_bahan as $key => $item) {
                    $bahanbaku = $item->qty * $item->price;
                    $bahan_bakus += $bahanbaku;
                }
                $bahan_baku = 'RP ' . number_format($bahan_bakus, 0, ',', '.');
                //  Produk
                $products = 0;
                $data_bahan = Barang::where('information','produk')->get();
                foreach ($data_bahan as $key => $item) {
                    $produc = $item->qty * $item->price;
                    $products += $produc;
                }
                $product = 'RP ' . number_format($products, 0, ',', '.');
                // hutang
                $hutangs = hutang::where('option','pribadi')->sum('saldo');
                $hutang = 'RP ' . number_format($hutangs, 0, ',', '.');
                //hutang Lama
                $hutang_lamas = hutang::where('option','lama')->sum('saldo');
                $hutang_lama = 'RP ' . number_format($hutang_lamas, 0, ',', '.');
                // piutang lama
                $piutang_lamas = hutang::where('option','piutang_lama')->sum('saldo');
                $piutang_lama = 'RP ' . number_format($piutang_lamas, 0, ',', '.');
                // hutang customer
                $customers = 0;
                $data = transaction::where('status','belum_lunas')->where("id_customer",'!=','owner')->where('information','nota')->get();
                foreach ($data as $key => $item) {
                    $data_customer = $item->price - $item->qty;
                    $customers += $data_customer;
                }
                $customer = 'RP ' . number_format($customers, 0, ',', '.');
                // hutang perusahaan
                $perusahaans = 0;
                $datap = transaction::where('status','belum_lunas')->where('information','nota')->where('id_customer','owner')->get();
                foreach ($datap as $key => $item) {
                    $datas = $item->price - $item->qty;
                    $perusahaans += $datas;
                }
                $perusahaan = 'RP ' . number_format($perusahaans, 0, ',', '.');
                // total
                $total = $products + $bahan_bakus + $customers - $hutangs + $hutang_lamas - $perusahaans + $piutang_lamas + $bank;
                $total = 'RP ' . number_format($total, 0, ',', '.');

            @endphp
            <div class="row mx-5">
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Uang Di Bank</h5>
                                <p class="card-text" id="">{{$banks}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Sisa Bahan Baku</h5>
                                <p class="card-text" id="">{{$bahan_baku}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Sisa Product</h5>
                                <p class="card-text" id="">{{$product}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Hutang Pribadi</h5>
                                <p class="card-text" id="">{{$hutang}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Hutang Customer Lama</h5>
                                <p class="card-text" id="">{{$hutang_lama}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Hutang Customer</h5>
                                <p class="card-text" id="">{{$customer}}</p>
                            </div>
                        </div>
                    </div>
                </div><div class="row mt-3">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Hutang Perusahaan</h5>
                                <p class="card-text" id="">{{$perusahaan}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Piutang Pribadi</h5>
                                <p class="card-text" id="">{{$piutang_lama}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Asset</h5>
                                <p class="card-text" id="">{{$total}}</p>
                            </div>
                        </div>
                    </div>
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
