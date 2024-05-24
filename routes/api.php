<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StatistikController;
use App\Http\Controllers\Api\LayananController;

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

//API Layanan
Route::get('/api-layanan', [LayananController::class, 'dash_layanan']);
Route::get('/api-layanan-pie', [LayananController::class, 'dash_layanan_pie']);
Route::get('/api-layanan-piramid', [LayananController::class, 'dash_layanan_piramid']);
Route::get('/api-layanan-gender', [LayananController::class, 'dash_layanan_gender']);
Route::get('/api-layanan-rajal',[LayananController::class,'dash_layanan_rajal']);
Route::get('/api-layanan-rajal-bar',[LayananController::class,'dash_layanan_rajal_bar']);
Route::get('/api-layanan-ranap-line',[LayananController::class,'dash_layanan_ranap_line']);
Route::get('/api-layanan-ranap-bar',[LayananController::class,'dash_layanan_ranap_bar']);
Route::get('/api-layanan-khitan-line',[LayananController::class,'dash_layanan_khitan_line']);
Route::get('/api-layanan-khitan-bar',[LayananController::class,'dash_layanan_khitan_bar']);

