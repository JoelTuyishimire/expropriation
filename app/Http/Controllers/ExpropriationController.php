<?php

namespace App\Http\Controllers;

use App\Models\Expropriation;
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
//        save array using many to many
        dd($request->all());
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
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expropriation  $expropriation
     * @return \Illuminate\Http\Response
     */
    public function edit(Expropriation $expropriation)
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
