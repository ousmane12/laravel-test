<?php

namespace App\Http\Controllers;

use App\Models\VitalParameter;
use Illuminate\Http\Request;

class VitalParameterController extends Controller
{
    /**
     * Retrieves all vital parameters.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VitalParameter::all();
    }

    /**
     * Retrieves a vital parameter by its ID.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return VitalParameter::findOrFail($id);
    }
}
