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
            $stock = $barang->qty - $table->qty;
            $barang->qty = $stock; // Update qty dengan nilai yang diterima dari form
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
        $datas =([
            'finish'=>$request->finish,
            'results'=>$request->results,
            'information'=>'finish'
        ]);
        history::create([
            'name'=>$data->name,
            'status'=>$data->start,
            'unit'=>$data->unit,
            'information'=>'Production',
            'more'=>$request->finish,
            'price'=>$request->cost
        ]);
        $barang = Barang::findOrFail($data->id_product);
        $stock = $barang->qty + $request->results;
        $update = ([
            'qty'=>$stock
        ]);
        $data->update($datas);
        $barang->update($update);
    return redirect('production')->with('success', 'Success production ');
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
