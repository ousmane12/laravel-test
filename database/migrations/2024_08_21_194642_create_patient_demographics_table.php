<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('patient_demographic')) {
            Schema::create('patient_demographic', function (Blueprint $table) {
                $table->id();
                $table->string('patient_uid', 20)->nullable();
                $table->date('date_of_registration');
                $table->string('gender', 30);
                $table->string('pregnant', 10)->nullable();
                $table->string('do_you_know_date_of_birth', 11)->nullable();
                $table->date('date_of_birth');
                $table->string('town', 30);
                $table->string('quartier', 30);
                $table->string('sector', 30);
                $table->string('level_of_education', 30);
                $table->string('profession', 30)->default('N/A');
                $table->string('daily_expenditure', 30)->default('N/A');
                $table->string('matrimonial_status', 30)->default('N/A');
                $table->string('type_of_consultation', 30);
                $table->string('access_to_drinking_water', 30);
                $table->string('access_to_toilet', 30)->default('N/A');
                $table->string('rubbish_collection_services', 30)->default('N/A');
                $table->string('time_to_nearest_health_facility', 30);
                $table->string('last_visit_to_doctor', 30);
                $table->string('hmd_visits_in_last_year', 30);
                $table->string('would_you_be_willing_to_subscribe', 10)->default('N/A');
                $table->string('would_you_like_medical_card', 11)->nullable();
                $table->string('testing_services_and_medical_for_free', 100);
                $table->integer('card_printed')->default(0);
                $table->unsignedBigInteger('created_by')->nullable();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_demographic');
    }
};
