<?php

namespace App\Http\Controllers;

use App\Models\Expropriation;
use App\Models\PropertyType;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function index(){
        return view("admin.dashboard", [
            'totalTransactions'=>$this->totalTransactions(),
            'latestExpropriation' => Expropriation::with('propertyType')->latest()->take(5)->get(),
            'expropriatedPropertiesByCategory' => $this->expropriatedPropertiesByCategory()
        ]);
    }
    function totalTransactions()
    {
        return Expropriation::query()
            ->where('status', Expropriation::APPROVED)
            ->sum("amount");
    }

    function expropriatedPropertiesByCategory()
    {
        $data = collect();
        $data = PropertyType::with('expropriations')->get()->map(function ($item){
            return (object) [
                'name'=>$item->name,
                'count'=>$item->expropriations->count()
            ];
        });

        $arr = [];
        foreach ($data as $x)
        {
            $arr[$x->name] = $x->count;
        }
        return $arr;
    }


}
