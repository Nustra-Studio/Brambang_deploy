<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\hutang;

class CatatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('page.catatan.hutang');
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
        hutang::create([
            'name'=>$request->name,
            'saldo'=>$request->saldo,
            'information'=>$request->information,
            'option'=>$request->option
        ]);
        return redirect()->back()->with('success', 'Success Tambah Hutang');

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
            'saldo' => 'required',
            'information' => 'required',
        ]);
        $hutang = hutang::Find($id);
        $hutang->update($validateData);
        return redirect()->back()->with('success', 'Success Update Hutang');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hutang = hutang::Find($id);
        $hutang->delete();
        return redirect()->back()->with('success', 'Success Delete Hutang');
    }
}
