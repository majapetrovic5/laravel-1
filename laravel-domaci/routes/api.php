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
use App\Http\Controllers\API\AuthController;
use App\Http\Resources\UserResource;
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
    return new UserResource($request->user());
});

Route::post('login', [AuthController::class, 'login']);

Route::resource('patients',PatientController::class)->only(['index','show']);
Route::resource('patientstatus',PatientStatusController::class)->only(['index','show']);
Route::resource('reports',ReportController::class)->only(['index','show']);
Route::resource('doctors',UserController::class)->only(['index','show']);
Route::get('/doctors/{id}/reports', [UserReportController::class, 'index']);
Route::get('/patients/{id}/reports', [PatientReportController::class, 'index']);
Route::get('/status/{id}/reports', [StatusReportsController::class, 'index']);


Route::group(['middleware' => ['auth:sanctum']], function () {
  
    Route::resource('doctors',UserController::class)->only(['destroy','update']);
    Route::resource('patients',PatientController::class)->only(['store','update','destroy']);
    Route::resource('reports',ReportController::class)->only(['store','update','destroy']);
    Route::get('myreports',[ReportController::class,'showmyreports']);
   Route::get('myprofile',[UserController::class, 'showme']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
});

