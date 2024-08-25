<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientDemographic extends Model
{
    use HasFactory;

    protected $table = 'patient_demographic';

    protected $fillable = [
        'patient_uid',
        'date_of_registration',
        'gender',
        'pregnant',
        'do_you_know_date_of_birth',
        'date_of_birth',
        'town',
        'quartier',
        'sector',
        'level_of_education',
        'profession',
        'daily_expenditure',
        'matrimonial_status',
        'type_of_consultation',
        'access_to_drinking_water',
        'access_to_toilet',
        'rubbish_collection_services',
        'time_to_nearest_health_facility',
        'last_visit_to_doctor',
        'hmd_visits_in_last_year',
        'would_you_be_willing_to_subscribe',
        'would_you_like_medical_card',
        'testing_services_and_medical_for_free',
        'card_printed',
        'created_by',
    ];

}
