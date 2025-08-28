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
            $barang_qty = $barang->qty ?? 0;
            $item_qty = $item['qty'] ?? 0 ;
            $stock_qty = $barang_qty - $item_qty ; // Update qty dengan nilai yang diterima dari form
            $barang->qty = $stock_qty;
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
    {
         $data = produksi::findOrFail($id);
         $this->validateRequest($request);
         $results = $this->calculateResults($request);
        $data->update([
            'finish' => $request->finish,
            'results' => $results,
            'information' => 'finish'
        ]);
    
        $this->createHistoryEntries($data, $request);
    
        $this->updateStockAndCreateHistory($request, $data);
        return redirect('production')->with('success', 'Success production');

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
        private function validateRequest(Request $request)
    {
        // Validasi input berdasarkan kondisi
        if (!empty($request->input('hasil4'))) {
            $request->validate(['hasil4' => 'required|numeric']);
        } elseif (empty($request->input('hasil1')) && empty($request->input('hasil2')) && empty($request->input('hasil3'))) {
            $request->validate([
                'results1' => 'required|numeric',
                'results2' => 'required|numeric',
                'results3' => 'required|numeric',
                'results4' => 'required|numeric',
                'results5' => 'required|numeric',
                'results6' => 'required|numeric',
            ]);
        } else {
            $request->validate([
                'hasil1' => 'required|numeric',
                'hasil2' => 'required|numeric',
                'hasil3' => 'required|numeric',
            ]);
        }
    }
    private function calculateResults(Request $request)
    {
        if (!empty($request->input('hasil4'))) {
            return $request->hasil4;
        } elseif (empty($request->input('hasil1')) && empty($request->input('hasil2')) && empty($request->input('hasil3'))) {
            return $request->results1 + $request->results2 + $request->results3 + $request->results4 + $request->results5 + $request->results6;
        } else {
            return $request->hasil1 + $request->hasil2 + $request->hasil3;
        }
    }
    private function createHistoryEntries($data, $request)
    {
        history::create([
            'name' => $data->name,
            'status' => $data->start,
            'unit' => $data->unit,
            'information' => 'Production',
            'more' => $request->finish,
            'price' => $request->cost
        ]);
    
        history::create([
            'name' => $data->name,
            'unit' => $data->unit,
            'information' => 'transportasi',
            'price' => $request->trasnportasi
        ]);
    
        history::create([
            'name' => $data->name,
            'information' => 'operasional',
            'unit' => $data->unit,
            'price' => $request->opsional
        ]);
    }
    private function updateStockAndCreateHistory(Request $request, $data)
    {
        $productsMapping = [
            'hasil1' => '⁠panir bawang putih',
            'hasil2' => 'Bawang Putih Goreng CyS Shopee',
            'hasil3' => 'Bawang Putih Goreng',
            'hasil4' => 'Bawang Putih Goreng Kemasan 1 KG',
            'results1' => 'Bawang Goreng A',
            'results2' => 'Bawang Goreng B',
            'results3' => 'Bawang Goreng C',
            'results4' => 'Bawang Goreng D',
            'results5' => 'Bawang MERAH Goreng CYS Shopee',
            'results6' => 'Bawang Goreng B Kemasan 1KG',
        ];
    
        foreach ($productsMapping as $key => $name) {
            if ($request->has($key)) {
                $product = Barang::where('name', $name)->first();
                if ($product) {
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
        }
    }
}

