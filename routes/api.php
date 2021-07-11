<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiranapController;
use App\Http\Controllers\HospitalController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('siranap/ntt/kabupaten',[SiranapController::class, 'regency']);
Route::get('siranap/ntt/tempat-tidur/covid',[SiranapController::class, 'bedAvalaibilityForCovid']);
Route::get('siranap/ntt/tempat-tidur/covid/{id}',[SiranapController::class, 'bedAvalaibilityForCovidDetail']);
Route::get('siranap/ntt/tempat-tidur/non-covid',[SiranapController::class, 'bedAvalaibilityForNonCovid']);
Route::get('siranap/ntt/tempat-tidur/non-covid/{id}',[SiranapController::class, 'bedAvalaibilityForNonCovidDetail']);

Route::get('hospital',[HospitalController::class, 'listHospital']);
Route::get('hospital/sdm',[HospitalController::class, 'hospitalHumanResources']);