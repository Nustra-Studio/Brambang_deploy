<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Gaji;
use App\Models\Absen;
use App\Models\keuangan;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\AbsenImports;
use Maatwebsite\Excel\Excel as ExcelType;

class KaryawanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.masterdata.karyawan');
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
        $data = ([
            'name' => $request->name,
            'address' => $request->address,
            'salary' => $request->salary,
            'hp' => $request->hp,
            'department' => $request->department,
            'status' => 'karyawan'
        ]);
        $datas= Karyawan::create($data);
        Gaji::create([
            'name'=>'bensin',
            'total'=>$request->bensin,
            'id_karyawan'=>$datas->id
        ]);
        Gaji::create([
            'name'=>'makan',
            'total'=>$request->makan,
            'id_karyawan'=>$datas->id
        ]);
        return redirect('karyawan')->with('success', 'Success Daftar Karyawan');
    }
    public function gaji(Request $request){
        $gaji = karyawan::where('id',$request->id)->first();
        $makan = Gaji::where('id_karyawan',$request->id)->where('name','makan')->value('total');
        $bensins = Gaji::where('id_karyawan',$request->id)->where('name','bensin')->value('total');
        $bensin = 0;
        if(empty($makan)){$makan=0;}
        $dayOfWeek = date('l');
        if ($dayOfWeek === 'Saturday') {
            $bensin = $bensins;
        }
        if($request->status =="lembur")
        {
            Absen::create([
                'date'=>date('Y-m-d'),
                'id_karyawan'=>$request->id,
                'status'=>$request->status,
                'more'=>$gaji->salary * 2 + $makan + $bensin
            ]);
            $money = $gaji->salary * 2 + $makan + $bensin;
        }
        elseif($request->status === "masuk"){
            Absen::create([
                'date'=>date('Y-m-d'),
                'id_karyawan'=>$request->id,
                'status'=>$request->status,
                'more'=>$gaji->salary + $bensin
            ]);
            $money = $gaji->salary + $bensin;
        }
        elseif($request->status === "tidak_masuk"){
            Absen::create([
                'date'=>date('Y-m-d'),
                'id_karyawan'=>$request->id,
                'status'=>$request->status,
                'more'=>0  + $bensin
            ]);
            $money= 0 + $bensin;
        }
        else{

        }
        keuangan::create([
            'name'=>$gaji->name,
            'status'=>'cost',
            'information'=>"Gaji Karyawan",
            'money'=>$money
        ]);
        return redirect()->back()->with('success', 'Success Absen Karyawan');
    }
    public function excel(Request $request){
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);
            $file = $request->file('file');
            Excel::import(new AbsenImports,$file, ExcelType::XLSX);
            return redirect()->back()->with('success', 'Data Imported');
        // } catch (\Exception $e) {
        //     // Handle the exception
        //     // return redirect()->back()->with('error', 'Error importing data: ' . $e->getMessage());
        //     $message = [
        //         'error'=>true,
        //         "message"=>$e->getMessage()
        //     ];
        //     dd($message);
        // }
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
        $validateData = $request->validate([
            'name' => 'required',
            'address' => 'required',
            'salary' => 'required',
            'department' => 'required',
        ]);

        $barang = Karyawan::Find($id);
        $barang->update($validateData);
        Gaji::where('id_karyawan',$id)->where('name','bensin')->update(['total'=>$request->bensin]);
        Gaji::where('id_karyawan',$id)->where('name','makan')->update(['total'=>$request->makan]);
        return redirect('karyawan')->with('success', 'Telah Edit Data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $barang = Karyawan::find($id);
        $barang->delete();
        Gaji::where('id_karyawan',$id)->where('name','bensin')->delete();
        Gaji::where('id_karyawan',$id)->where('name','makan')->delete();
        return redirect('karyawan')->with('hapus', 'Hapus Data Karyawan');
    }
}
