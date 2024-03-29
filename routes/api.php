<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StatistikController;

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

//API NAKES DASHBOARD
Route::get('/api-nakes',[StatistikController::class,'StatistikNakes']);
Route::get('/api-non-nakes',[StatistikController::class,'StatistikNonNakes']);
Route::get('/api-gender',[StatistikController::class,'StatistikGender']);
Route::get('/api-pekerjaan',[StatistikController::class,'StatistikStatusPekerjaan']);
Route::get('/api-education',[StatistikController::class,'StatistikEducation']);
