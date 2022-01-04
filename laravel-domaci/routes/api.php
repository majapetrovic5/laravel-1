<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PatientStatusController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserReportController;
use App\Http\Controllers\PatientReportController;
use App\Http\Controllers\StatusReportsController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 
Route::resource('patients',PatientController::class);
Route::resource('patientstatus',PatientStatusController::class)->only(['index','show']);
Route::resource('reports',ReportController::class);
Route::resource('doctors',UserController::class)->only(['index','show']);

Route::get('/doctors/{id}/reports', [UserReportController::class, 'index']);
Route::get('/patients/{id}/reports', [PatientReportController::class, 'index']);
Route::get('/status/{id}/reports', [StatusReportsController::class, 'index']);