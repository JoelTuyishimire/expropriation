<?php

namespace App\Http\Controllers;

use App\District;
use App\Province;
use App\Sector;
use Illuminate\Http\Request;

class LocalityController extends Controller
{
    public function districtsByProvince($id)
    {
        $districts = \App\Models\District::where('province_id',$id)->get();
        return $districts;

    }
    public function sectorsByDistrict($id)
    {
        $sectors = \App\Models\Sector::where('district_id',$id)->get();
        return $sectors;
    }
    public function cellsBySector(Sector $sector)
    {
        return $sector->cells()->get();
    }
}
