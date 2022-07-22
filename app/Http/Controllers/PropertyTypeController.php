<?php

namespace App\Http\Controllers;

use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.property-types', [
            'propertyTypes' => PropertyType::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:property_types',
            'name_en' => 'required|unique:property_types',
        ]);

        $transaction_type = new PropertyType();
        $transaction_type->name = $request->name;
        $transaction_type->name_en = $request->name_en;
        $transaction_type->save();

        return redirect()->route('admin.property-types.index')->with('success', 'Property Type Created Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function edit(PropertyType $propertyType)
    {
        dd($propertyType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|unique:property_types,name,'.decryptId($id),
            'name_en' => 'required|unique:property_types,name_en,'.decryptId($id),
        ]);

        $transaction_type = PropertyType::find(decryptId($id));
        $transaction_type->name = $request->name;
        $transaction_type->name_en = $request->name_en;
        $transaction_type->save();

        return redirect()->route('admin.property-types.index')->with('success', 'Property Type Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyType  $propertyType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction_type = PropertyType::find(decryptId($id));
        $transaction_type->delete();

        return redirect()->route('admin.property-types.index')->with('success', 'Property Type Deleted Successfully');
    }
}
