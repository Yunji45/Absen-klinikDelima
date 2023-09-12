<?php

use Illuminate\Support\Facades\Route;
//frontend
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
//backend
use App\Http\Controllers\UserController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\DokumenController;
use App\Http\Controllers\SertifikatController;
use App\Http\Controllers\JadwalshiftController;
//Error Bro
use App\Http\Controllers\ErrorMas\ErrorController;

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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [AuthController::class,'index'])->name('auth.index')->middleware('guest');
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

        Route::get('/kehadiran', [PresensiController::class,'index'])->name('kehadiran.index');
        Route::get('/kehadiran/cari', [PresensiController::class,'search'])->name('kehadiran.search');
        Route::get('/kehadiran/{user}/cari', [PresensiController::class,'cari'])->name('kehadiran.cari');
        Route::get('/kehadiran/excel-users', [PresensiController::class,'excelUser'])->name('kehadiran.excel-users');
        Route::get('/kehadiran/{user}/excel-user', [PresensiController::class,'excelUser'])->name('kehadiran.excel-user');
        Route::post('/kehadiran/ubah', [PresensiController::class,'ubah'])->name('ajax.get.kehadiran');
        Route::patch('/kehadiran/{kehadiran}', [PresensiController::class,'update'])->name('kehadiran.update');
        Route::post('/kehadiran-tambah', [PresensiController::class,'store'])->name('kehadiran.store');

        //download
        Route::get('/download',[PresensiController::class,'DownloadPreDay'])->name('download.perday');
        Route::get('/download-per-user/{id}',[PresensiController::class,'DownloadPerUser']);

        //cuti
        Route::get('/data-izin',[CutiController::class,'index'])->name('konfirmasi.izin');
        Route::get('/izin-form',[CutiController::class,'create'])->name('data.cuti');
        Route::get('/VerifikasiIzin/{id}/berhasil',[CutiController::class,'VerifikasiCuti']);
        Route::get('/RejectIzin/{id}/gagal',[CutiController::class,'RejectCuti']);

        //detailpegawai
        Route::get('/detail-pegawai',[DetailController::class,'indexAdm'])->name('detail.pegawai.admin');
        Route::get('/hapus-info-pegawai/{id}',[DetailController::class,'delete'])->name('delete.pegawai.admin');
        Route::get('/detail-informasi/{id}',[DetailController::class,'show'])->name('detail.info.admin');

        //dokumen
        Route::get('/dokumen-pegawai',[DokumenController::class,'admDokumen'])->name('adm.dokumen');
        Route::get('/delete-dokumen',[DokumenController::class,'destroy'])->name('delete.dokumen');

        //JadwalShift
        Route::get('/jadwal-shift',[JadwalshiftController::class,'index'])->name('jadwal.shift');
        Route::post('/jadwal-save',[JadwalshiftController::class,'store'])->name('jadwal.save');
        Route::get('/jadwal-hapus/{id}',[JadwalshiftController::class,'destroy'])->name('jadwal.hapus');
        Route::get('/download-jadwal',[JadwalshiftController::class,'jadwaldownload'])->name('download.jadwal');

    });

    Route::group(['roles' => 'pegawai'], function(){
        Route::get('/daftar-hadir', [PresensiController::class,'show'])->name('daftar-hadir');
        Route::get('/daftar-hadir/cari', [PresensiController::class,'cariDaftarHadir'])->name('daftar-hadir.cari');
        Route::get('/pengajuan-cuti',[CutiController::class,'index'])->name('cuti.pegawai');
        Route::post('/simpan-cuti',[CutiController::class,'store'])->name('submit.cuti');

        //izin
        Route::get('/Data-izin',[CutiController::class,'indexCutiUser'])->name('index.izin.user');
        Route::post('/pengajuan-izin',[CutiController::class,'store'])->name('pengajuan.cuti');
    });

    // ATUR IP ADDRESS DISINI
    Route::group(['middleware' => ['cekIp:'.config('absensi.ip_address')]], function() {
        Route::patch('/absen/{kehadiran}', [PresensiController::class,'checkOut'])->name('kehadiran.check-out');
        Route::post('/absen', [PresensiController::class,'checkIn'])->name('kehadiran.check-in');
    });
    // Route::post('/absen', [PresensiController::class,'checkIn'])->middleware('cekIp')->name('kehadiran.check-in');
    Route::post('/absen', [PresensiController::class,'checkIn'])->name('kehadiran.check-in');
    Route::patch('/absen/{kehadiran}', [PresensiController::class,'checkOut'])->name('kehadiran.check-out');

    //Hari-Hari Error Mulu Mas Bro Emang Ga Bosen
    Route::get('/ForBidden', [ErrorController::class,'forBidden'])->name('error.input');
    Route::get('/Server', [ErrorController::class,'server'])->name('error.server');

    //detail_user
    Route::get('/profil-pegawai/{id}',[DetailController::class,'index'])->name('detail.user.index');
    Route::post('/lengkapi-profil',[DetailController::class,'store'])->name('update-profil.store');
    Route::post('/update-profil/{user_id}',[DetailController::class,'update'])->name('profil-update');

    Route::get('/dokumen',[DokumenController::class,'index'])->name('upload.dokumen');
    Route::post('/save-dokumen',[DokumenController::class,'store'])->name('save.dokumen');

    Route::get('/sertifikat',[SertifikatController::class,'index'])->name('upload.sertifikat');
    Route::post('/save-sertifikat',[SertifikatController::class,'store'])->name('save.sertifikat');

});
