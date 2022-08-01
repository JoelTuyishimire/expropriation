<?php

namespace App\Http\Controllers;

use App\Models\Expropriation;
use App\Models\ExpropriationDetail;
use App\Models\PropertyItem;
use Illuminate\Http\Request;

class ExpropriationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expropriations = Expropriation::all();
        return view('expropriation.index', compact('expropriations'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expropriation.create', [
            'products' => PropertyItem::all()
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
        $expo = Expropriation::create([
            'property_type_id' => $request->property_type_id,
            'citizen_id' => $request->citizen_id,
            'done_by' => auth()->user()->id,
            'amount' => $request->total,
            'description' => $request->note,
            'province_id' => $request->province_id,
            'district_id' => $request->district_id,
            'sector_id' => $request->sector_id,
        ]);

        foreach ($request->product_id as $key => $product) {
            ExpropriationDetail::create([
                'expropriation_id' => $expo->id,
                'property_item_id' => $product,
                'property_type_id' => $request->property_type_id,
                'quantity' => $request->Quantity[$key],
                'price' => $request->UnitPrice[$key],
            ]);
        }

        return redirect()->route('admin.expropriations.index')->with('success', 'Expropriation created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expropriation  $expropriation
     * @return \Illuminate\Http\Response
     */
    public function show(Expropriation $expropriation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expropriation  $expropriation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expropriation $expropriation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expropriation  $expropriation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expropriation $expropriation)
    {
        //
    }
}
