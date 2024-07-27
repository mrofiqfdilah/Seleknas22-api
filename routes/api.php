<?php

use App\Http\Controllers\Api\ApplyJobController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\ValidationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// 1.Authentication

Route::post('v1/auth/login', [AuthController::class, 'login']);

Route::post('v1/auth/logout', [AuthController::class, 'logout']);

// 2.Validation Job
Route::middleware("socMiddle")->group(function () {
    Route::post('v1/validations', [ValidationController::class, 'request_validation']);
    Route::get('v1/validations', [ValidationController::class, 'data_validation']);

    Route::get('v1/job_vacancies', [JobController::class, 'see_job']);
    Route::get('v1/job_vacancies/{id}', [JobController::class, 'detail_job']);

    Route::post('v1/applications', [ApplyJobController::class, 'apply_job']);
    Route::get('v1/applications', [ApplyJobController::class, 'see_job']);
});
