<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VitalParameter extends Model
{
    use HasFactory;

    protected $table = 'vital_parameters';

    protected $fillable = [
        'patient_id',
        'vital_type',
        'oxygen_saturation',
        'temperature',
        'glucose_level',
        'bp_sys_right',
        'bp_dias_right',
        'bp_sys_left',
        'bp_dias_left',
        'bp_sys_avarage',
        'bp_dias_avarage',
        'arm_circumference',
        'vital_flag',
        'eatornot',
        'grade',
        'is_active',
        'time_of_checking',
        'date_of_checking',
        'created_by',
    ];
    public $timestamps = true;
}
