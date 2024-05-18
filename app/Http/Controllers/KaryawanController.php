<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Gaji;
use App\Models\Absen;

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
        if(!empty($makan)){$makan=0;}
        if($request->status =="lembur")
        {
            Absen::create([
                'date'=>date('Y-m-d'),
                'id_karyawan'=>$request->id,
                'status'=>$request->status,
                'more'=>$gaji->salary * 2 + $makan
            ]);
        }
        elseif($request->status === "masuk"){
            Absen::create([
                'date'=>date('Y-m-d'),
                'id_karyawan'=>$request->id,
                'status'=>$request->status,
                'more'=>$gaji->salary
            ]);
        }
        elseif($request->status === "tidak_masuk"){
            Absen::create([
                'date'=>date('Y-m-d'),
                'id_karyawan'=>$request->id,
                'status'=>$request->status,
                'more'=>'0'
            ]);
        }
        else{

        }
        return redirect()->back()->with('success', 'Success Absen Karyawan');
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
            'hp' => 'required',
            'salary' => 'required',
            'department' => 'required',
            'bensin' => 'required',
            'makan' => 'required',
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
