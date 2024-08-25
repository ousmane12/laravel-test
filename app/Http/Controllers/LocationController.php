<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\PatientDemographic;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $cities = Location::select('region')->distinct()->get();
        return view('index', compact('cities')); 
    }

    public function show($region)
    {
        $towns = Location::where('region', $region)->distinct('prefectures')->get(['prefectures']);
        return response()->json($towns);
    }
}
