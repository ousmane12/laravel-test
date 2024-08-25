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
        if (!Schema::hasTable('vital_parameters')) {
            Schema::create('vital_parameters', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('patient_id');
                $table->string('vital_type', 20);
                $table->string('oxygen_saturation', 30)->nullable();
                $table->string('temperature', 30)->nullable();
                $table->float('glucose_level')->nullable();
                $table->integer('bp_sys_right')->nullable();
                $table->integer('bp_dias_right')->nullable();
                $table->integer('bp_sys_left')->nullable();
                $table->integer('bp_dias_left')->nullable();
                $table->float('bp_sys_avarage')->nullable();
                $table->float('bp_dias_avarage')->nullable();
                $table->integer('arm_circumference')->nullable();
                $table->boolean('vital_flag');
                $table->string('eatornot', 20)->nullable();
                $table->string('grade', 20)->nullable();
                $table->boolean('is_active');
                $table->time('time_of_checking');
                $table->date('date_of_checking');
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
        Schema::dropIfExists('vital_parameters');
    }
};
