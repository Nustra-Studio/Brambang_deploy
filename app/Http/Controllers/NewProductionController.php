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
        return view('Page.fitur.newproduction');
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
        //
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
