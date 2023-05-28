<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login', [AuthController::class,'index'])->name('auth.index')->middleware('guest');
Route::post('/act-login', [AuthController::class,'login'])->name('auth.login');
Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout');
Route::get('/home',[HomeController::class,'index'])->name('home');

Route::group(['middleware' => ['web', 'auth', 'roles:admin,pegawai']], function(){
    Route::get('/ganti-password', [UserController::class,'gantipassword'])->name('ganti-password');
    Route::patch('/update-password/{user}', [UserController::class,'updatePassword'])->name('update-password');
    Route::get('/profil',[UserController::class,'profil'])->name('profil');
    Route::patch('/update-profil/{user}', [UserController::class,'updateProfil'])->name('update-profil');

    Route::group(['roles' => 'admin'], function(){
        Route::get('/users/cari', [UserController::class,'search'])->name('users.search');
        Route::patch('/users/password/{user}', [UserController::class,'password'])->name('users.password');
        Route::resource('/users', UserController::class);

        // Route::get('/kehadiran', 'PresentsController@index')->name('kehadiran.index');
        // Route::get('/kehadiran/cari', 'PresentsController@search')->name('kehadiran.search');
        // Route::get('/kehadiran/{user}/cari', 'PresentsController@cari')->name('kehadiran.cari');
        // Route::get('/kehadiran/excel-users', 'PresentsController@excelUsers')->name('kehadiran.excel-users');
        // Route::get('/kehadiran/{user}/excel-user', 'PresentsController@excelUser')->name('kehadiran.excel-user');
        // Route::post('/kehadiran/ubah', 'PresentsController@ubah')->name('ajax.get.kehadiran');
        // Route::patch('/kehadiran/{kehadiran}', 'PresentsController@update')->name('kehadiran.update');
        // Route::post('/kehadiran', 'PresentsController@store')->name('kehadiran.store');
    });

    Route::group(['roles' => 'pegawai'], function(){
        // Route::get('/daftar-hadir', 'PresentsController@show')->name('daftar-hadir');
        // Route::get('/daftar-hadir/cari', 'PresentsController@cariDaftarHadir')->name('daftar-hadir.cari');
    });

    // ATUR IP ADDRESS DISINI
    Route::group(['middleware' => ['ipcheck:'.config('absensi.ip_address')]], function() {
        // Route::patch('/absen/{kehadiran}', 'PresentsController@checkOut')->name('kehadiran.check-out');
        // Route::post('/absen', 'PresentsController@checkIn')->name('kehadiran.check-in');
    });
});
