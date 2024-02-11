<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transaction;
use App\Models\history;
use App\Models\Barang;
use App\Models\keuangan;


class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("page.fitur.penjualan");
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
        $name = "PJ$randomDate";
        $barang = Barang::where('id',$request->produk)->first();
        $data = [
            'name'=>$name,
            'price'=>$request->price,
            'id_barang'=>$barang->name,
            'id_customer'=>$request->customer,
            'qty'=>$request->qty,
            'status'=>$request->metode,
            'information'=> 'penjualan'
        ];
        transaction::create($data);
        $data_history = [
            'name'=>$name,
            'price'=>$request->price,
            'status'=>$request->metode,
            'qty'=>$request->qty,
            'information'=> 'Penjualan',
            'more'=>$barang->name,
        ];
        history::create($data_history);
        // update stock
        $barang = Barang::findOrFail($request->produk);
        $stock = $barang->qty - $request->qty;
        $barang->qty = $stock; // Update qty dengan nilai yang diterima dari form
        $barang->save();
        $income = $request->qty * $request->price;
            $data = [
                'name'=>$name,
                'money'=>$income,
                'status'=>'income',
                'information'=>"sell_product",
            ];
            keuangan::create($data);
        return redirect('transaction')->with('success', 'Transaction Succsess');
    
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
        $data = [
            'name'=>$request->name,
            'price'=>$request->price,
            'qty'=>$request->qty,
            'status'=>$request->metode,
            'information'=> 'penjualan'
        ];

        // $validate = $data->validate([
        //     'name' => 'required',
        //     'price' => 'required',
        //     'qty' => 'required',
        //     'id_customer' => 'required',
        //     'status' => 'required',
        //     'infotmartion' => 'required'
        // ]); 

        $barang = transaction::Find($id);
        $barang->update($data);
        return redirect('transaction')->with('success', 'Edit Succsess');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
