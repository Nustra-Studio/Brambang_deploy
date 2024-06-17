<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produksi;
use App\Models\costproduksi;
use App\Models\Barang;
use App\Models\history;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.fitur.production');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currentDate = date('Ymd');
        $randomNumber = str_pad(mt_rand(0, 99), 2, '0', STR_PAD_LEFT);
        $randomDate = $currentDate . $randomNumber;
        $name_random = "PRB$randomDate";
        $data=([
            'name'=>$request->name,
            'start'=>$request->start,
            'unit'=>$name_random,
            'information'=>'pending',
            'id_product'=>$request->product
        ]);
        $table = $request->input('data_table_values');
        $table = json_decode($table, true);
        foreach($table as $item){
            $name = $item['name'];
            $price =$item['price'];
            $qty = $item['qty'];
            $datas=([
                'name'=>$name,
                'price'=>$price,
                'qty'=>$qty,
                'id_produksi'=>$name_random,
            ]);
            costproduksi::create($datas);
            $barang = Barang::findOrFail($name);
            // $stock = $barang->qty - $table->qty;
            $barang->qty -= $item['qty'] ; // Update qty dengan nilai yang diterima dari form
            $barang->save();
        }
        produksi::create($data);
        return redirect('production')->with('success', 'Success production Brambang Goreng');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
{// Temukan data produksi berdasarkan ID
    $data = produksi::findOrFail($id);
    if(empty($request->hasil1)&&empty($request->hasil2)&&empty($request->hasil3)){
         // Validasi request
        $request->validate([
            'results1' => 'required|numeric',
            'results2' => 'required|numeric',
            'results3' => 'required|numeric',
            'results4' => 'required|numeric',
            'results5' => 'required|numeric',
            'results6' => 'required|numeric',
        ]);

        // Hitung total hasil
        $results = $request->results1 + $request->results2 + $request->results3 + $request->results4 + $request->results5 + $request->results6 ;

        // Buat array data yang akan diupdate
            $datas = [
                'finish' => $request->finish,
                'results' => $results,
                'information' => 'finish'
            ];

        // Buat entri history
        history::create([
            'name' => $data->name,
            'status' => $data->start,
            'unit' => $data->unit,
            'information' => 'Production',
            'more' => $request->finish,
            'price' => $request->cost
        ]);

        // Ambil produk berdasarkan nama
        $products = [
            'results1' => 'Bawang Goreng A',
            'results2' => 'Bawang Goreng B',
            'results3' => 'Bawang Goreng C',
            'results4' => 'Bawang Goreng D',
            'results5' => 'Bawang Merah Goreng CyS',
            'results6' => 'Bawang Goreng B Kemasan 1 KG'
        ];

        // Cek dan update stok untuk setiap produk
        foreach ($products as $key => $name) {
            $product = Barang::where('name', $name)->first();
            if ($product ) {
                $barang = Barang::findOrFail($product->id);
                $stock = $barang->qty + $request->$key;
                $barang->update(['qty' => $stock]);
                history::create([
                    'name' => $name,
                    'status' => $data->start,
                    'unit' => $data->unit,
                    'information' => 'Hasil Production',
                    'more' => $request->finish,
                    'price' => $request->$key
                ]);
            }
        }

        // Update data produksi
        $data->update($datas);

        // Redirect ke halaman produksi dengan pesan sukses
        return redirect('production')->with('success', 'Success production');
    }
    else{
        $request->validate([
            'hasil1' => 'required|numeric',
            'hasil2' => 'required|numeric',
            'hasil3' => 'required|numeric',
        ]);
        $results =$request->hasil1 + $request->hasil2 + $request->hasil3;
        $datas = [
            'finish' => $request->finish,
            'results' => $results,
            'information' => 'finish'
        ];

        // Buat entri history
        history::create([
            'name' => $data->name,
            'status' => $data->start,
            'unit' => $data->unit,
            'information' => 'Production',
            'more' => $request->finish,
            'price' => $request->cost
        ]);
        $productss = [
            'hasil1' => 'Bawang Putih Goreng Bungkusan 1 KG',
            'hasil2' => 'Bawang Putih Goreng CyS',
            'hasil3' => 'Bawang Putih Goreng',
        ];
        foreach ($productss as $key => $name) {
            $product = Barang::where('name', $name)->first();
            if ($product ) {
                $barang = Barang::findOrFail($product->id);
                $stock = $barang->qty + $request->$key;
                $barang->update(['qty' => $stock]);
                history::create([
                    'name' => $name,
                    'status' => $data->start,
                    'unit' => $data->unit,
                    'information' => 'Hasil Production',
                    'more' => $request->finish,
                    'price' => $request->$key
                ]);
            }
        }
            $data->update($datas);

            // Redirect ke halaman produksi dengan pesan sukses
            return redirect('production')->with('success', 'Success production');
    }
}

    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data= produksi::findOrFail($id);
        $id_barang = $data->unit;
        $costs = costproduksi::where('id_produksi',$id_barang)->get();
        foreach ($costs as $cost) {
            $cost->delete();
        }        
        $data->delete();
        return redirect('production')->with('success', 'Success production Delete');
    }
}
