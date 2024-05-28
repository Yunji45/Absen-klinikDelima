<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StatistikController;
use App\Http\Controllers\Api\LayananController;
use App\Http\Controllers\Api\UserController;


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

Route::get('/api-user',[UserController::class,'get_data_user']);

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
Route::get('/api-search-rajal',[LayananController::class,'search_layanan_rajal']);
Route::get('/api-tahun-rajal',[LayananController::class,'GetAvailableYears']);

Route::get('/api-layanan-ranap-line',[LayananController::class,'dash_layanan_ranap_line']);
Route::get('/api-layanan-ranap-bar',[LayananController::class,'dash_layanan_ranap_bar']);

Route::get('/api-layanan-khitan-line',[LayananController::class,'dash_layanan_khitan_line']);
Route::get('/api-layanan-khitan-bar',[LayananController::class,'dash_layanan_khitan_bar']);

Route::get('/api-layanan-lab-line',[LayananController::class,'dash_layanan_lab_line']);
Route::get('/api-layanan-lab-bar',[LayananController::class,'dash_layanan_lab_bar']);

Route::get('/api-layanan-usg-line',[LayananController::class,'dash_layanan_usg_line']);
Route::get('/api-layanan-usg-bar',[LayananController::class,'dash_layanan_usg_bar']);

Route::get('/api-layanan-estetika-line',[LayananController::class,'dash_layanan_estetika_line']);
Route::get('/api-layanan-estetika-bar',[LayananController::class,'dash_layanan_estetika_bar']);




