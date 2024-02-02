<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Karyawan;

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
    
        Karyawan::create($data);
        return redirect('karyawan')->with('success', 'Success Daftar Karyawan');
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
        $validateData = ([
            'name' => 'required',
            'address' => 'required',
            'hp' => 'required',
            'salary' => 'required',
            'department' => 'required'
        ]);

        $barang = Karyawan::Find($id);
        $barang->update($validateData);
        redirect('karyawan')->with('success', 'Telah Edit Data');
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
        
        return redirect('karyawan')->with('hapus', 'Hapus Data Karyawan');
    }
}
