<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VitalParameterController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PatientDemographicController;

Route::get('/vital-parameters', [VitalParameterController::class, 'index'])->name('vital-parameters.index');

Route::get('/vital-parameters/{id}', [VitalParameterController::class, 'show'])->name('vital-parameters.show');

Route::get('/', [LocationController::class, 'index'])->name('locations.index');

Route::get('/locations/{prefecture}', [LocationController::class, 'show'])->name('locations.show');

Route::get('/location/quartiers/{prefecture}', [PatientDemographicController::class, 'getArea'])->name('locations.area');

Route::get('/patient-demographics/{region}', [PatientDemographicController::class, 'show'])->name('patients.show');

Route::get('/patient-demographics', [PatientDemographicController::class, 'index'])->name('patients.index');

Route::get('/statistics', [PatientDemographicController::class, 'getStatistics'])->name('patients.stats');