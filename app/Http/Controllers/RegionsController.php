<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;

class RegionsController extends Controller
{
    public function getRegions(Request $request)
    {
        $regions = Region::all()->where('city_id',$request->city);
        return response()->json($regions);
    }
}
