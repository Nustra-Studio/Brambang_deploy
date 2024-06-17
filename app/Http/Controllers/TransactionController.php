<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\transaction;
use App\Models\history;
use App\Models\Barang;
use App\Models\keuangan;
use App\Models\Customer;


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
    public function hutang(){
        return view("page.fitur.hutang");
    }
    public function invoice(Request $request){
        $id = $request->id;
        return view("page.fitur.invoicelama",['kode_invoice'=>$id]);
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
        $request->validate([
            'date' => 'required|date_format:Y-m-d',
        ]);

        // Mengonversi tanggal input ke format Carbon
        try {
            $date = Carbon::createFromFormat('Y-m-d', $request->input('date'));
        } catch (\Exception $e) {
            return back()->withErrors(['date' => 'Format tanggal tidak valid.']);
        }
        $currentDate = $date->format('Ymd');
        $randomNumber = str_pad(mt_rand(0, 999), 2, '0', STR_PAD_LEFT);
        $randomDate = $currentDate . $randomNumber;
        $name = "PJ$randomDate";
        $price = $request->input('price');
        $produk = $request->input('produk');
        $qty = $request->input('qty');
    
        for ($i = 0; $i < count($produk); $i++) {
            $barang = Barang::where('id', $produk[$i])->first();
            $data = [
                'name' => $name,
                'price' => $price[$i],
                'id_barang' => $barang->name,
                'id_customer' => $request->customer,
                'qty' => $qty[$i],
                'information' => 'penjualan',
                'created_at' => $date,
                'updated_at' => now(), // atau bisa disamakan dengan created_at
            ];
            Transaction::create($data);
    
            $data_history = [
                'name' => $name,
                'price' => $price[$i],
                'qty' => $qty[$i],
                'information' => 'Penjualan',
                'more' => $barang->name,
                'created_at' => $date,
                'updated_at' => now(), // atau bisa disamakan dengan created_at
            ];
            History::create($data_history);
    
            $barang = Barang::findOrFail($produk[$i]);
            $stock = $barang->qty - $qty[$i];
            $barang->qty = $stock; // Update qty dengan nilai yang diterima dari form
            $barang->save();
    
            $income = $qty[$i] * $price[$i];
            $data = [
                'name' => $name,
                'money' => $income,
                'status' => 'income',
                'information' => "sell_product",
                'created_at' => $date,
                'updated_at' => now(), // atau bisa disamakan dengan created_at
            ];
            Keuangan::create($data);
        }
    
        if ($request->total_belanja <= $request->bayar) {
            $status = 'Lunas';
        } else {
            $status = 'belum_lunas';
        }
    
        $data = [
            'name' => $name,
            'price' => $request->total_belanja,
            'id_customer' => $request->customer,
            'qty' => $request->bayar,
            'information' => 'nota',
            'status' => $status,
            'created_at' => $date,
            'updated_at' => now(), // atau bisa disamakan dengan created_at
        ];
        Transaction::create($data);
    
        $data_history = [
            'name' => $name,
            'price' => $request->bayar,
            'information' => 'Pembayaran Hutang',
            'more' => $request->customer,
            'created_at' => $date,
            'updated_at' => now(), // atau bisa disamakan dengan created_at
        ];
        History::create($data_history);
    
        $customer = Customer::where('id', $request->customer)->value('name');
    
        // Mengirim data ke view
        return view('page.fitur.invoice', [
            'data' => $request,
            'kode_invoice' => $name,
            'status' => $status,
            'customer' => $customer,
            'date'=>$date->format('Y-m-d')
        ]);
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
        $barang = transaction::Find($id);
        $total_bayar = $barang->qty + $request->bayar;
        if($barang->price <= $total_bayar){
            $data = [
                'qty'=>$total_bayar,
                'status'=>"Lunas"
            ];
        }
        else{
            $data = [
                'qty'=>$total_bayar,
            ];
        }
        $barang->update($data);
        $data_history = [
            'name'=>$barang->name,
            'price'=>$request->bayar,
            'information'=> 'Pembayaran Hutang',
            'more'=>$barang->id_customer,
        ];
        history::create($data_history);

        // $barang = Barang::findOrFail($request->produk);
        // $stock = $barang->qty - $request->qty;
        // $barang->qty = $stock; // Update qty dengan nilai yang diterima dari form
        // $barang->save();
        // $income = $request->qty * $request->price;
        //     $data = [
        //         'name'=>$name,
        //         'money'=>$income,
        //         'status'=>'income',
        //         'information'=>"sell_product",
        //     ];
        //     keuangan::create($data);

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
