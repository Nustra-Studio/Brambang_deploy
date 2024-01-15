<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.masterdata.barang');
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
        $data = [
            'name'=>$request->name,
            'price'=>$request->price,
            'basic_price'=>$request->basic_price,
            'qty'=>$request->qty,
            'unit'=>$request->unit
        ];
        Barang::create($data);
        return redirect('inputbarang')->with('status', 'success insert item');
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
        $validatedData = $request->validate([
            'name' => 'required',
            'price'=>'required',
            'basic_price'=>'required',
            'qty'=>'required',
            'unit'=>'required'
            // Add other validation rules for your fields
        ]);

        // Find the record by ID
        $barang = Barang::find($id);

        // Update the record with the new data
        $barang->update($validatedData);
        return redirect('inputbarang')->with('status', 'success Update item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $yourModel = Barang::find($id);

        // Delete the record
        $yourModel->delete();
        return redirect('inputbarang')->with('status', 'success Update item');
    }
}
