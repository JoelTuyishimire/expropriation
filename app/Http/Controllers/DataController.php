<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use App\Models\Sector;

use Illuminate\Http\Request;

class DataController extends Controller
{
    public function getDistricts(Province $province): \Illuminate\Database\Eloquent\Collection
    {
        return $province->districts()->get();
    }

    public function getSectors(District $district): \Illuminate\Database\Eloquent\Collection
    {
        return $district->sectors()->get();
    }

    public function getCells(Sector $sector): \Illuminate\Database\Eloquent\Collection
    {
        return $sector->cells()->get();
    }
    public function getVillages(Cell $cell): \Illuminate\Database\Eloquent\Collection
    {
        return $cell->villages()->get();
    }


    public function getMultipleDistricts(Request $request): \Illuminate\Database\Eloquent\Collection
    {
        return District::query()->whereIn("province_id",$request->provinces)->get();
    }

    public function getMultipleSectors(Request $request): \Illuminate\Database\Eloquent\Collection
    {
        return Sector::query()->whereIn("district_id",$request->districts)->get();
    }

}
