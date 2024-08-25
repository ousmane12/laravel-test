<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\PatientDemographic;
use App\Models\Location;
use App\Models\VitalParameter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $sql = File::get(database_path('sql/assessmentDB.sql'));
        DB::unprepared($sql);
    }
}
