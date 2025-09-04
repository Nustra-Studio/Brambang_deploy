<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\produksi;
use App\Models\costproduksi;
use App\Models\Barang;
use App\Models\history;

class NewProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.fitur.newproduction');
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
            'information'=>'pending_new',
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
        return redirect('newproduction')->with('success', 'Success production Brambang Goreng');
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
        $results = $this->calculateResults($request);
        $data = produksi::findOrFail($id);
        // dd($results);
        $data->update([
            'finish' => $request->finish,
            'results' => $results,
            'information' => 'finish'
        ]);
        $this->createHistoryEntries($data, $request);
        $this->updateStockAndCreateHistory($request, $data);
        return redirect('newproduction')->with('success', 'Success production');
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
        return redirect('newproduction')->with('success', 'Success production Delete');
    }
    private function calculateResults(Request $request){
        $results = 0;
        for($x = 1; $x <= $request->lenght_data ; $x++){
            $query ='results'.$x;
            $results += $request->input($query,0);
        }
        return $results;
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
        for($x = 1; $x <= $request->lenght_data ; $x++){
            $query_results ='results'.$x;
            $results = $request->input($query_results,0);
            $query_item ='productresult'.$x;
            $item = $request->input($query_item,0);
            $product = Barang::where('id', $item)->first();
            if ($product) {
                $barang = Barang::findOrFail($product->id);
                $stock = $barang->qty + $results;
                $barang->update(['qty' => $stock]);

                history::create([
                    'name' => $product->name,
                    'status' => $data->start,
                    'unit' => $data->unit,
                    'information' => 'Hasil Production',
                    'more' => $request->finish,
                    'price' => $results
                ]);
            }
        }
    }
}
