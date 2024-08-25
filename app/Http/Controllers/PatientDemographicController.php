<?php

namespace App\Http\Controllers;

use App\Models\PatientDemographic;
use Illuminate\Http\Request;

class PatientDemographicController extends Controller
{
    public function index()
    {
        return PatientDemographic::all();
    }

    public function show($region)
    {
        $towns = PatientDemographic::where('town', $region)->get(['town', 'quartier']);
        return response()->json($towns);
    }

    public function getStatistics(Request $request)
    {
        $town = $request->input('town');
        $quartier = $request->input('quartier');

        $patients = PatientDemographic::query()
            ->when($town, function ($query, $town) {
                return $query->where('town', $town);
            })
            ->when($quartier, function ($query, $quartier) {
                return $query->where('quartier', $quartier);
            })
            ->join('vital_parameters', 'patient_demographic.id', '=', 'vital_parameters.id')
            ->selectRaw('COUNT(*) as total_patients')
            ->selectRaw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= 18 AND gender = "Male" THEN 1 ELSE 0 END) as total_adult_men')
            ->selectRaw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= 18 AND gender = "Female" THEN 1 ELSE 0 END) as total_adult_women')  // Inclut maintenant les femmes enceintes
            ->selectRaw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) < 18 THEN 1 ELSE 0 END) as total_children')
            ->selectRaw('SUM(CASE WHEN TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) >= 18 AND gender = "Female" AND pregnant = "Yes" THEN 1 ELSE 0 END) as total_pregnant_women')
            ->selectRaw('SUM(CASE WHEN vital_parameters.vital_type = "bloodPressure" AND vital_parameters.bp_sys_right IS NOT NULL THEN 1 ELSE 0 END) as total_bp_measurements')
            ->selectRaw('SUM(CASE WHEN vital_parameters.vital_type = "bloodPressure" THEN vital_parameters.bp_sys_right ELSE 0 END) as total_bp_sys')
            ->selectRaw('SUM(CASE WHEN vital_parameters.vital_type = "bloodPressure" THEN vital_parameters.bp_dias_right ELSE 0 END) as total_bp_dias')
            ->selectRaw('SUM(CASE WHEN vital_parameters.vital_type = "glucose" AND vital_parameters.glucose_level IS NOT NULL THEN 1 ELSE 0 END) as total_glucose_measurements')
            ->selectRaw('SUM(CASE WHEN vital_parameters.vital_type = "glucose" THEN vital_parameters.glucose_level ELSE 0 END) as total_glucose_level')
            ->selectRaw('SUM(CASE WHEN vital_parameters.vital_type = "bloodPressure" THEN CASE WHEN vital_parameters.bp_sys_right < 120 AND vital_parameters.bp_dias_right < 80 THEN 1 ELSE 0 END ELSE 0 END) as bp_normal')
            ->selectRaw('SUM(CASE WHEN vital_parameters.vital_type = "bloodPressure" THEN CASE WHEN vital_parameters.bp_sys_right BETWEEN 120 AND 129 AND vital_parameters.bp_dias_right < 80 THEN 1 ELSE 0 END ELSE 0 END) as bp_high')
            ->selectRaw('SUM(CASE WHEN vital_parameters.vital_type = "bloodPressure" THEN CASE WHEN vital_parameters.bp_sys_right >= 130 OR vital_parameters.bp_dias_right >= 80 THEN 1 ELSE 0 END ELSE 0 END) as bp_very_high')
            ->selectRaw('SUM(CASE WHEN vital_parameters.vital_type = "glucose" THEN CASE WHEN vital_parameters.glucose_level < 100 THEN 1 ELSE 0 END ELSE 0 END) as glucose_normal')
            ->selectRaw('SUM(CASE WHEN vital_parameters.vital_type = "glucose" THEN CASE WHEN vital_parameters.glucose_level BETWEEN 100 AND 125 THEN 1 ELSE 0 END ELSE 0 END) as glucose_high')
            ->selectRaw('SUM(CASE WHEN vital_parameters.vital_type = "glucose" THEN CASE WHEN vital_parameters.glucose_level >= 126 THEN 1 ELSE 0 END ELSE 0 END) as glucose_very_high')
            ->first();

        return response()->json([
            'total_patients' => $patients->total_patients,
            'total_adult_men' => $patients->total_adult_men,
            'total_adult_women' => $patients->total_adult_women,
            'total_pregnant_women' => $patients->total_pregnant_women,
            'total_children' => $patients->total_children,
            'total_bp_measurements' => $patients->total_bp_measurements,
            'total_glucose_measurements' => $patients->total_glucose_measurements,
            'total_bp_sys' => $patients->total_bp_sys,
            'total_bp_dias' => $patients->total_bp_dias,
            'total_glucose_level' => $patients->total_glucose_level,
            'bp_normal' => $patients->bp_normal,
            'bp_high' => $patients->bp_high,
            'bp_very_high' => $patients->bp_very_high,
            'glucose_normal' => $patients->glucose_normal,
            'glucose_high' => $patients->glucose_high,
            'glucose_very_high' => $patients->glucose_very_high,
        ]);
    }


    public function getArea($prefecture)
    {
        $towns = PatientDemographic::where('town', $prefecture)->distinct()->get(['quartier']);
        return response()->json($towns);
    }
}
