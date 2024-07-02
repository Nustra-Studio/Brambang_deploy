<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\history;
use App\Models\keuangan;
use App\Models\transaction;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Barang::where('information','produk')->get();
        return view('page.masterdata.barang');
    }
    public function bahanbaku(){
        $data = Barang::where('information','bahan_baku')->get();
        return view('page.masterdata.bahanbaku');
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
            'unit'=>$request->unit,
            'information'=>$request->category
        ];
        Barang::create($data);
        $data_history = [
            'name'=>$request->name,
            'price'=>$request->price,
            'basic_price'=>$request->basic_price,
            'qty'=>$request->qty,
            'unit'=>$request->unit,
            'information'=> 'barang_masuk'
        ];
        history::create($data_history);
        $category = $request->category;
        if($category == "bahan_baku"){
            $currentDate = date('Ymd');
            $randomNumber = str_pad(mt_rand(0, 999), 2, '0', STR_PAD_LEFT);
            $randomDate = $currentDate . $randomNumber;
            $name = "PP$randomDate";
            $cost = $request->qty * $request->price;
            if($request->bayar >= $cost){
                $status = 'Lunas';
            }
            else{
                $status = 'belum_lunas';
            }
            $data = [
                'name'=>$request->name,
                'money'=>$cost,
                'status'=>'cost',
                'information'=>"buy_product",
            ];
            $datas = [
                'name'=>$name,
                'price'=>$cost,
                'id_customer'=>'owner',
                'id_barang'=>$request->name,
                'qty'=>$request->bayar,
                'information'=> 'nota',
                'status'=>$status
            ];
            $data_history = [
                'name'=>$name,
                'price'=>$request->bayar,
                'information'=> 'Pembayaran Hutang',
                'more'=>'owner',
            ];
            history::create($data_history);
            transaction::create($datas);
            keuangan::create($data);
        }
        return redirect()->back()->with('status', 'success insert item');
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
            'qty'=>'required',
            // Add other validation rules for your fields
        ]);

        // Find the record by ID
        $barang = Barang::find($id);
        $barang->update($validatedData);
        $category = $barang->information;
        if($category == "bahan_baku"){
                // if($barang->qty < $request->qty){
                //     $money = $request->qty * $request->price;
                //     $uang = keuangan::where('name',$barang->name)->first();
                //     $uang->money = $money + $uang->money; // Update qty dengan nilai yang diterima dari form
                //     $uang->save();
                // }
                // else{
                //     $money = $request->qty * $request->price;
                //     $uang = keuangan::where('name',$barang->name)->first();
                //     $uang->money = $money - $uang->money; // Update qty dengan nilai yang diterima dari form
                //     $uang->save();
                // }
                $data_history = [
                    'name'=>$request->name,
                    'price'=>$request->price,
                    'basic_price'=>$request->basic_price,
                    'qty'=>$request->qty,
                    'unit'=>$request->unit,
                    'information'=> 'barang_masuk'
                ];
                history::create($data_history);
            }
        // Update the record with the new data
        return redirect()->back()->with('status', 'success Update item');
    }
    public function add(Request $request){
        $currentDate = date('Ymd');
        $randomNumber = str_pad(mt_rand(0, 999), 2, '0', STR_PAD_LEFT);
        $randomDate = $currentDate . $randomNumber;
        $name = "PP$randomDate";
        $money = $request->qty * $request->price;
        $barang = Barang::find($request->produk);
        $uang = keuangan::where('name',$barang->name)->first();
                    $uang->money = $money + $uang->money; // Update qty dengan nilai yang diterima dari form
                    $uang->save();

        $barang->qty += $request->qty;
        $barang->price = $request->price;
        $barang->save();
        $data_history = [
            'name'=>$barang->name,
            'price'=>$request->price,
            'qty'=>$request->qty,
            'unit'=>$request->unit,
            'more'=>$name,
            'information'=> 'barang_masuk'
        ];
        history::create($data_history);
        if($request->bayar >= $money){
            $status = 'Lunas';
        }
        else{
            $status = 'belum_lunas';
        }
        $datas = [
            'name'=>$name,
            'price'=>$money,
            'id_customer'=>'owner',
            'id_barang'=>$barang->name,
            'qty'=>$request->bayar,
            'information'=> 'nota',
            'status'=>$status
        ];
        transaction::create($datas);
        
        return redirect()->back()->with('status', 'success Update item');
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $limit = $request->input('limit', 5); // Default limit is 10, you can change it as needed
        
        $data = Barang::where('name', 'LIKE', "%$query%")->take($limit)->get();
        
        return response()->json($data, 200);
    }
    public function data(Request $request){
        $data = [];
    
        if($request->filled('q')){
            $data = Barang::select("name", "id")
                        ->where('name', 'LIKE', '%'. $request->get('q'). '%')
                        ->get();
        }
        elseif($request->filled('namaproduct')){
            $data = barang::where('id', $request->get('namaproduct'))->first();
        }
        else{
            $data = Barang::select("name", "id")
                        ->get();
        }
        return response()->json($data);
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
        return redirect()->back()->with('status', 'success Update item');
    }
}
