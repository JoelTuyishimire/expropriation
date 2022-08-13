<?php

namespace App\Http\Controllers;

use App\Models\PropertyItem;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class PropertyItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.property-items', [
            'propertyItems' => PropertyItem::all(),
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
        $item = new PropertyItem();
        $item->name = $request->name;
        $item->name_en = $request->name_en;
        $item->property_type_id = $request->property_type_id;
        $item->measurement = $request->measurement;
        $item->price = $request->price;
        $item->location = $request->location;
        $item->description = $request->description;
        $item->save();

        return redirect()->route('admin.property-items.index')->with('success', 'Property Item Created Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PropertyItem  $propertyItem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $propertyItem)
    {
        $item = PropertyItem::find(decryptId($propertyItem));

        //create property item history
        $item->histories()->create([
            'name' => $item->name,
            'name_en' => $item->name_en,
            'property_type_id' => $item->property_type_id,
            'property_item_id' => $item->id,
            'measurement' => $item->measurement,
            'price' => $item->price,
            'location' => $item->location,
            'updated_by' => auth()->user()->id
        ]);

        //update property item

        $item->name = $request->name;
        $item->name_en = $request->name_en;
        $item->property_type_id = $request->property_type_id;
        $item->measurement = $request->measurement;
        $item->price = $request->price;
        $item->location = $request->location;
        $item->description = $request->description;
        $item->save();

        return redirect()->route('admin.property-items.index')->with('success', 'Property Item Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PropertyItem  $propertyItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(PropertyItem $propertyItem)
    {
        //
    }

    public function showPropertyItemHistory($propertyItem)
    {
        $item = PropertyItem::find(decryptId($propertyItem));
        return view('admin.property-item-history', [
            'item' => $item,
            'histories' => $item->histories()->orderBy('created_at', 'desc')->get()
        ]);
    }
    public function propertyItemsByPropertyType($propertyType)
    {
        $init = collect([
            'id'=>"",
            'name'=>"--select item --"
        ]);
        $propertyType = PropertyType::find($propertyType);
        return $propertyType->propertyItems->prepend($init);
    }
}
