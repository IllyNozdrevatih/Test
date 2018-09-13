<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\City;
use App\Area;

class CitiesController extends Controller
{
    public function getCities(Request $request)
    {
        $cities = City::all()->where('area_id',$request->area);
        return response()->json($cities);
    }
}
