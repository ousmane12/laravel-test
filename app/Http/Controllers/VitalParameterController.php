<?php

namespace App\Http\Controllers;

use App\Models\VitalParameter;
use Illuminate\Http\Request;

class VitalParameterController extends Controller
{
    public function index()
    {
        return VitalParameter::all();
    }

    public function show($id)
    {
        return VitalParameter::findOrFail($id);
    }
}
