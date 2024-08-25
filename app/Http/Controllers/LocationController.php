<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\PatientDemographic;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = Location::select('region')->distinct()->get();
        return view('index', compact('cities')); 
    }

    /**
     * Retrieves prefectures from a given region.
     *
     * @param  string  $region
     * @return \Illuminate\Http\Response
     */
    public function show($region)
    {
        $towns = Location::where('region', $region)->distinct('prefectures')->get(['prefectures']);
        return response()->json($towns);
    }
}
