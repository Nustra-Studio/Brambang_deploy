<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProductionGroup;
class ProductionGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("page.masterdata.groupproduction");
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
            'name' => 'required|string|max:255',
            'items' => 'required|array',
            'items.*' => 'exists:barangs,id',
        ]);

        $productionGroup = ProductionGroup::create([
            'name' => $request->name,
        ]);
        $productionGroup->barangs()->attach($request->items);

        return redirect()->back()->with('status', 'Grup produksi berhasil ditambahkan!');
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
        $request->validate([
            'name' => 'required|string|max:255',
            'items' => 'required|array',
            'items.*' => 'exists:barangs,id',
        ]);

        $productionGroup = ProductionGroup::findOrFail($id);
        $productionGroup->update([
            'name' => $request->name,
        ]);
        $productionGroup->barangs()->sync($request->items);

        return redirect()->back()->with('status', 'Grup produksi berhasil diperbarui!');
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
        $productionGroup = ProductionGroup::findOrFail($id);
        $productionGroup->barangs()->detach(); // Detach all related products
        $productionGroup->delete();

        return redirect()->back()->with('status', 'Grup produksi berhasil dihapus!');
    }
}
