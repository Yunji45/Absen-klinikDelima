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
use App\Http\Controllers\RubahjadwalController;
use App\Http\Controllers\FaceController;
use App\Http\Controllers\IPConfigController;
use App\Http\Controllers\HelpITController;
use App\Http\Controllers\PenggajianController;

use App\Http\Controllers\Backend\BiznetController;
use App\Http\Controllers\Backend\KpiController;
use App\Http\Controllers\Backend\TargetKPIController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UpdatePoinKPIController;
use App\Http\Controllers\Backend\OprJasaMedisController;
use App\Http\Controllers\Backend\JasaMedisController;
use App\Http\Controllers\Backend\HomeCareController;
use App\Http\Controllers\Backend\KategoriJasaController;
use App\Http\Controllers\Backend\DaftarPasienController;
use App\Http\Controllers\Backend\DaftarTugasController;
use App\Http\Controllers\Backend\NoteKaryawanController;
use App\Http\Controllers\Backend\JobVacancyController;
use App\Http\Controllers\Backend\JobApplicationController;
use App\Http\Controllers\Backend\LayoutController;
use App\Http\Controllers\Backend\KritikSaraanController;
use App\Http\Controllers\Backend\THRController;
use App\Http\Controllers\Backend\DatasetKhitanController;
use App\Http\Controllers\Backend\DatasetRawatInapController;
use App\Http\Controllers\Backend\DatasetLabController;
use App\Http\Controllers\Backend\DatasetPersalinanController;
use App\Http\Controllers\Backend\DatasetRajalController;
use App\Http\Controllers\Backend\DatasetUsgController;
use App\Http\Controllers\Backend\DatasetEstetikaController;
use App\Http\Controllers\Backend\WAController;
use App\Http\Controllers\Backend\ApiDocsController;

use App\Http\Controllers\Frontend\TasklistJasaMedisController;
use App\Http\Controllers\Frontend\ContentController;
use App\Http\Controllers\Frontend\CareerController;
//dokumentasi API (application programming interface)
use App\Http\Controllers\Api\StatistikController;
//Error Bro
use App\Http\Controllers\ErrorMas\ErrorController;
use App\Http\Middleware\VerifyFaceMiddleware;


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

Route::get('/maintenance', function () {
    return view('welcome');
});
Route::get('/face', function () {
    return view('api');
});
Route::get('/api', function () {
    return view('testyu');
});
Route::get('/send', [WAController::class, 'index']);

Route::get('/',[ContentController::class,'home'])->name('frontend');
Route::get('/Tentang',[ContentController::class,'tentang'])->name('frontend.tentang');
Route::get('/Layanan',[ContentController::class,'layanan'])->name('frontend.layanan');
Route::get('/Divisi',[ContentController::class,'divisi'])->name('frontend.divisi');
Route::get('/Dokter',[ContentController::class,'dokter'])->name('frontend.dokter');
Route::get('/Kontak',[ContentController::class,'kontak'])->name('frontend.kontak');
Route::get('/Kritik-saran',[ContentController::class,'kritik_saran'])->name('frontend.kritik-saran');
Route::get('/karir',[CareerController::class,'index'])->name('karir');

//kritik dan saran
Route::post('/kritik/saran-save',[KritikSaraanController::class,'store'])->name('kritik.save');

//pelamar
Route::get('/formulir-cv',[JobApplicationController::class,'index_user'])->name('job-app.pelamar');
Route::post('/formulir-cv/save',[JobApplicationController::class,'store'])->name('job-app.save');
Route::get('/kirim-email',[JobApplicationController::class,'KirimEmail']);


// Route::get('/biznet',[BiznetController::class,'index'])->name('biznet.index');
// Route::post('/biznet-identify',[BiznetController::class,'identifyFace'])->name('biznet.identify');
Route::get('/opencv',[FaceController::class,'index']);
Route::get('/login', [AuthController::class,'index'])->name('auth.index')->middleware('guest');
Route::post('/act-login', [AuthController::class,'login'])->name('auth.login');
Route::get('/logout',[AuthController::class,'logout'])->name('auth.logout');
Route::get('/home',[HomeController::class,'index'])->name('home');

// Route::middleware(['auth', 'verified_face'])->group(function () {
//     Route::get('/biznet', [BiznetController::class, 'index'])->name('biznet.index');
//     Route::post('/biznet-verify', [BiznetController::class, 'identifyFace'])->name('biznet.verify');
// });

// Rute untuk halaman home
// Route::middleware(['web','auth', 'verified_face'])->group(function () {
//     Route::get('/home', [HomeController::class, 'index'])->name('home');
// });


Route::group(['middleware' => ['web', 'auth', 'roles:admin,pegawai,keuangan,hrd,evaluator']], function(){
    Route::get('/biznet',[BiznetController::class,'index'])->name('biznet.index');
    Route::post('/biznet-identify',[BiznetController::class,'identifyFace'])->name('biznet.identify');

    Route::get('/ganti-password', [UserController::class,'gantipassword'])->name('ganti-password');
    Route::patch('/update-password/{user}', [UserController::class,'updatePassword'])->name('update-password');
    Route::get('/profil',[UserController::class,'profil'])->name('profil');
    Route::patch('/update-profil/{user}', [UserController::class,'updateProfil'])->name('update-profil');

    //task list jasa medis
    Route::get('/task-list',[TasklistJasaMedisController::class,'index'])->name('task.list.index');
    Route::get('/task-list/history',[TasklistJasaMedisController::class,'HistoryTask'])->name('task.list.history');
    
    //role admin
    Route::group(['roles' => 'admin,hrd,keuangan,evaluator'], function(){
        //Dashboard
        Route::get('/statis',[DashboardController::class,'index'])->name('dash.admin');
        Route::get('/layanan',[DashboardController::class,'dash_layanan'])->name('dash.layanan');
        Route::get('/layanan-rajal',[DashboardController::class,'dash_rajal'])->name('dash.rajal');
        Route::get('/layanan-ranap',[DashboardController::class,'dash_ranap'])->name('dash.ranap');
        Route::get('/layanan-khitan',[DashboardController::class,'dash_khitan'])->name('dash.khitan');
        Route::get('/layanan-lab',[DashboardController::class,'dash_lab'])->name('dash.lab');
        Route::get('/layanan-usg',[DashboardController::class,'dash_usg'])->name('dash.usg');
        Route::get('/layanan-estetika',[DashboardController::class,'dash_estetika'])->name('dash.estetika');
        
        //user-backend
        Route::get('/users/cari', [UserController::class,'search'])->name('users.search');
        Route::patch('/users/password/{user}', [UserController::class,'password'])->name('users.password');
        Route::resource('/users', UserController::class);
        //kehadiran-backend
        Route::get('/kehadiran', [PresensiController::class,'index'])->name('kehadiran.index');
        Route::get('/kehadiran/cari', [PresensiController::class,'search'])->name('kehadiran.search');
        Route::get('/kehadiran/{user}/cari', [PresensiController::class,'cari'])->name('kehadiran.cari');
        Route::get('/kehadiran/excel-users', [PresensiController::class,'excelUser'])->name('kehadiran.excel-users');
        Route::get('/kehadiran/{user}/excel-user', [PresensiController::class,'excelUser'])->name('kehadiran.excel-user');
        Route::post('/kehadiran/ubah', [PresensiController::class,'ubah'])->name('ajax.get.kehadiran');
        Route::patch('/kehadiran/{kehadiran}', [PresensiController::class,'update'])->name('kehadiran.update');
        Route::post('/kehadiran-tambah', [PresensiController::class,'store'])->name('kehadiran.store');
        Route::get('/presensi/cari/{user}',[PresensiController::class,'cari'])->name('cari.presensi.peruser');
        Route::get('/kehadiran/{id}', [PresensiController::class,'delete'])->name('kehadiran.delete');

        //download-kehadiran-backend
        Route::get('/download',[PresensiController::class,'DownloadPreDay'])->name('download.perday');
        Route::get('/download-per-user/{user}',[PresensiController::class,'DownloadPerUser'])->name('download.peruser');

        //cuti-backend
        Route::get('/data-izin',[CutiController::class,'index'])->name('konfirmasi.izin');
        Route::post('/data-izin/save',[CutiController::class,'storeAdm'])->name('data.izin.adm');
        Route::get('/izin-form',[CutiController::class,'create'])->name('data.cuti');
        Route::get('/VerifikasiIzin/{id}/berhasil',[CutiController::class,'VerifikasiCuti']);
        Route::get('/RejectIzin/{id}/gagal',[CutiController::class,'RejectCuti'])->name('delete.izin.cuti');
        Route::get('/data-izin/periode' ,[CutiController::class,'searchCuti'])->name('search.cuti');

        //detailpegawai-backend
        Route::get('/detail-pegawai',[DetailController::class,'indexAdm'])->name('detail.pegawai.admin');
        Route::get('/hapus-info-pegawai/{id}',[DetailController::class,'delete'])->name('delete.pegawai.admin');
        Route::get('/detail-informasi/{id}',[DetailController::class,'show'])->name('detail.info.admin');
        Route::get('/detail-edit/{id}',[DetailController::class,'edit'])->name('detail.edit.admin');
        Route::post('/detail-update/{id}',[DetailController::class,'updateDetailAdmin'])->name('detail.update.admin');
        Route::get('/download-detail/{id}',[DetailController::class,'downdetail'])->name('download.detail.admin');
        Route::get('/download-index',[DetailController::class,'downloadindex'])->name('download.admin.detail.index');

        //dokumen
        Route::get('/dokumen-pegawai',[DokumenController::class,'admDokumen'])->name('adm.dokumen');
        Route::get('/delete-dokumen/{id}',[DokumenController::class,'destroy'])->name('delete.dokumen');
        //sertiifkat
        Route::get('/sertifikat-pegawai',[SertifikatController::class,'admsertifikat'])->name('adm.sertifikat');
        Route::get('/delete-sertifikat/{id}',[DokumenController::class,'destroy'])->name('delete.sertifikat');

        //JadwalShift
        Route::get('/jadwal-shift',[JadwalshiftController::class,'index'])->name('jadwal.shift');
        Route::post('/jadwal-save',[JadwalshiftController::class,'store'])->name('jadwal.save');
        Route::get('/jadwal-hapus/{id}',[JadwalshiftController::class,'destroy'])->name('jadwal.hapus');
        Route::get('/cari-jadwal', [JadwalshiftController::class,'cari'])->name('cari.jadwal');
        Route::get('/jadwal-edit/{id}',[JadwalshiftController::class,'edit'])->name('jadwal.edit');
        Route::post('/jadwal-update/{id}',[JadwalshiftController::class,'update'])->name('jadwal.update');
        Route::post('/jadwal-multiple/save',[JadwalshiftController::class,'StoreMultipleJadwal'])->name('jadwal.multiple');
        Route::get('/jadwal-delete-all',[JadwalshiftController::class,'DestroyAllJadwal'])->name('jadwal.destroy-all');

        //rubah jadwal
        Route::get('/data-permohonan',[RubahjadwalController::class,'indexAdmin'])->name('permohonan.index');
        Route::post('/data-permohonan-create',[RubahjadwalController::class,'storeAdm'])->name('permohonan.save.adm');
        Route::get('/Verifikasi/{id}/berhasil',[RubahjadwalController::class,'VerifPermohonan']);
        Route::get('/Reject/{id}/gagal',[RubahjadwalController::class,'destroy'])->name('permohonan.delete');
        Route::get('/data-rubahjadwal/periode' ,[RubahjadwalController::class,'searchRubahJadwal'])->name('search.rubahjadwal');

        //penggajian
        Route::get('/index-persentase', [PenggajianController::class,'index'])->name('gaji.adm');
        Route::get('/index-gaji-create',[PenggajianController::class,'create'])->name('gaji.create');
        Route::post('/index-gaji-save', [PenggajianController::class,'store'])->name('gaji.save');
        Route::get('/index-gaji/{id}', [PenggajianController::class,'destroy'])->name('gaji.delete');
        Route::get('/index-gaji-edit/{id}', [PenggajianController::class,'edit'])->name('gaji.edit');
        Route::post('/index-gaji-update/{id}',[PenggajianController::class,'update'])->name('gaji.update');
        Route::get('/cari-gaji', [PenggajianController::class,'cari'])->name('cari.gaji');
        Route::post('/index-gaji-update/{id}',[PenggajianController::class,'update'])->name('gaji.update');
        Route::get('/Payroll-search',[PenggajianController::class,'SearchPayroll'])->name('gaji.search');
        Route::get('/Payroll-confirm/{id}',[PenggajianController::class,'ConfirmTransfer'])->name('gaji.confirm.transfer');
        // Route::get('/Payroll-confirm-penerima/{id}',[PenggajianController::class,'ConfirmPenerima'])->name('gaji.confirm.penerima');
        Route::get('/Payroll-multiple',[PenggajianController::class,'CreateMultipleGaji'])->name('multiple.gaji.create');
        Route::post('/Payroll-save/multiple',[PenggajianController::class,'StoreMultipleGaji'])->name('multiple.gaji.save');
        Route::get('/index-persentase/download', [PenggajianController::class,'download_gaji'])->name('gaji.download');
        Route::get('/index-persentase/download-excel', [PenggajianController::class,'excel_gaji'])->name('gaji.download.excel');
        Route::post('/payroll-multiple/save',[PenggajianController::class,'GetDataMultipleGaji'])->name('gaji.get');

        //THR
        Route::get('/THR-idul-fitri',[THRController::class,'index'])->name('thr.idul-fitri');
        Route::post('/THR-idul-fitri/multiple',[THRController::class,'GetDataMultiple'])->name('thr.multiple');
        Route::get('/THR-idul-fitri/add',[THRController::class,'create'])->name('thr.add');
        Route::post('/THR-idul-fitri/save',[THRController::class,'store'])->name('thr.save');
        Route::delete('/THR-idul-fitri/{id}',[THRController::class,'destroy'])->name('thr.delete');
        Route::get('/THR-idul-fitri/edit/{id}',[THRController::class,'edit'])->name('thr.edit');
        Route::post('/THR-idul-fitri/update/{id}',[THRController::class,'update'])->name('thr.update');
        Route::get('/THR-idul-fitri/download-excel', [THRController::class,'THR_Excel'])->name('thr.excel');
        Route::get('/THR-idul-fitri/download-pdf', [THRController::class,'THR_pdf'])->name('thr.pdf');

        //UMR 
        Route::get('/index-UMR',[PenggajianController::class,'indexUMR'])->name('gaji.indexUMR');
        Route::get('/index-UMR-create',[PenggajianController::class,'createUMR'])->name('gaji.umr.create');
        Route::post('/index-UMR-save', [PenggajianController::class,'saveUMR'])->name('gaji.UMR.save');
        Route::get('/index-UMR-delete/{id}',[PenggajianController::class,'hapusUMR'])->name('gaji.UMR.delete');
        //Setup Omset Insentif
        Route::get('/setup-insentif',[TargetKPIController::class,'indexOmset'])->name('setup.insentif');
        Route::post('/setup-insentif/save',[TargetKPIController::class,'storeOmset'])->name('setup.insentif.save');
        Route::get('/setup-insentif/delete/{id}',[TargetKPIController::class,'hapusOmset'])->name('setup.insentif.delete');
        Route::get('/Search-omset',[TargetKPIController::class,'SearchOmset'])->name('search.omset');
        Route::post('/update/omset/{id}',[TargetKPIController::class,'updateOmset'])->name('update.omset');
        Route::get('/omset/edit/{id}',[TargetKPIController::class,'editOmset'])->name('edit.omset');
        //Target KPI
        Route::get('/TargetKPI',[TargetKPIController::class,'index'])->name('target.kpi');
        Route::get('/TargetKPI/create',[TargetKPIController::class,'create'])->name('target.kpi.create');
        Route::get('/TargetKPI/edit/{id}',[TargetKPIController::class,'edit'])->name('target.kpi.edit');
        Route::post('/TargetKPI/update/{id}',[TargetKPIController::class,'update'])->name('target.kpi.update');
        Route::post('/TargetKPI/save',[TargetKPIController::class,'store'])->name('target.kpi.save');
        Route::get('/TargetKPI/delete/{id}',[TargetKPIController::class,'destroy'])->name('target.kpi.delete');
        //KPI
        Route::get('/KPI',[KpiController::class,'index'])->name('kpi.index');
        Route::get('/KPI-create',[KpiController::class,'create'])->name('kpi.tambah');
        Route::get('/KPI-edit/{id}',[KpiController::class,'edit'])->name('kpi.edit.evaluasi');
        Route::post('/KPI-update/{id}',[KpiController::class,'update'])->name('kpi.update');
        Route::post('/KPI-save',[KpiController::class,'store'])->name('kpi.save');
        Route::get('/KPI-delete/{id}',[KpiController::class,'destroy'])->name('kpi.delete');
        Route::get('/KPI-view/{id}',[KpiController::class,'indexViewKpi'])->name('kpi.view');
        Route::get('/Search-kpi',[KpiController::class,'SearchKpi'])->name('search.kpi');
        Route::post('/KPI-multiple',[KpiController::class,'storeKpiMultiple'])->name('kpi.multiple');
        Route::post('/KPI-multiple/update',[UpdatePoinKPIController::class,'updateEvaluasi'])->name('kpi.update.multiple');
        Route::get('/delete-all/kpi',[KpiController::class,'deleteAllKpi'])->name('kpi.kpi.delete-all');

        //Realisasi KPI
        Route::get('/KPI/Data-Kinerja', [KpiController::class,'indexTargetKpi'])->name('kpi.datakinerja');
        Route::get('/coba', [KpiController::class,'insertmultiple'])->name('coba');
        Route::post('coba-save', [KpiController::class,'coba'])->name('coba.save');    
        Route::get('/KPI/form-target',[KpiController::class,'createTarget'])->name('kpi.form.create');
        Route::post('/KPI/form-target/save',[KpiController::class,'storeTarget'])->name('kpi.form.save');
        Route::get('/KPI/form-delete/{id}',[KpiController::class,'hapusTargetKpi'])->name('kpi.form.delete');
        Route::get('/KPI/form-edit/{id}',[KpiController::class,'editTarget'])->name('kpi.form.edit');
        Route::post('/KPI/form-update/{id}',[KpiController::class,'updateTarget'])->name('kpi.form.update');
        Route::get('/Search-realisasi',[KpiController::class,'SearchRealisasi'])->name('search.realisasi');

        Route::post('/multiple-realisasi/save',[KpiController::class,'storeRealisasiMultiple'])->name('kpi.realisasi.multiple');
        Route::post('/multiple-update/save',[UpdatePoinKPIController::class,'updateRealisasi'])->name('kpi.multiple.update');
        Route::get('/delete-all/realisasi',[KpiController::class,'deleteAllRealisasi'])->name('kpi.realisasi.delete-all');

        //Insentif KPI
        Route::get('/Insentif-KPI',[KpiController::class,'indexInsentifKpi'])->name('insentif.kpi');
        Route::post('/Insentif-KPI/save',[KpiController::class,'storeInsentifKpi'])->name('insentif.kpi.save');
        Route::get('/Insentif-KPI/delete/{id}',[KpiController::class,'hapusInsentifKpi'])->name('insentif.kpi.delete');
        Route::get('/Search-insentif-kpi',[KpiController::class,'SearchInsentifKpi'])->name('search.insentif.kpi');
        Route::post('/Insentif-KPI/multiple',[KpiController::class,'storeMultipleInsentifKpi'])->name('insentif.save.multiple');
        Route::post('/Insentif-KPI/multiple-update',[UpdatePoinKPIController::class,'updatePoinInsentif'])->name('insentif.update.multiple');
        Route::get('/delete-all-insentif', [KpiController::class, 'deleteAllInsentif'])->name('delete.all.insentif');
        Route::get('/download/insentif-kpi',[KpiController::class,'DownloadInsentif'])->name('download.insentif.kpi');
        Route::get('/download-insentif/export',[KpiController::class,'DownloadExcelInsentif'])->name('download.insentif.excel');

        //Target Jasa Medis
        Route::get('/Jasa-Medis',[JasaMedisController::class,'index'])->name('target.jasa.medis');
        Route::post('/Jasa-Medis/save',[JasaMedisController::class,'store'])->name('target.jasa.medis.save');
        Route::get('/Jasa-Medis/edit/{id}',[JasaMedisController::class,'edit'])->name('target.jasa.medis.edit');
        Route::get('/Jasa-Medis/delete/{id}',[JasaMedisController::class,'destroy'])->name('target.jasa.medis.delete');
        Route::post('/Jasa-Medis/update/{id}',[JasaMedisController::class,'update'])->name('target.jasa.medis.update');

        //OPR Jasa Medis
        Route::get('/opr-medis',[OprJasaMedisController::class,'index'])->name('opr.medis');
        Route::post('/opr-medis/save',[OprJasaMedisController::class,'store'])->name('opr.medis.save');
        Route::get('/opr-medis/edit/{id}',[OprJasaMedisController::class,'edit'])->name('opr.medis.edit');
        Route::post('/opr-medis/update/{id}',[OprJasaMedisController::class,'update'])->name('opr.medis.update');
        Route::get('/opr-medis/delete/{id}',[OprJasaMedisController::class,'destroy'])->name('opr.medis.delete');
        Route::get('/opr-medis/tindakan/{id}',[OprJasaMedisController::class,'CeklisTindakanMedis'])->name('opr.medis.ceklis');

        //Home Care
        Route::get('/home-care',[HomeCareController::class,'index'])->name('home.care');
        Route::post('/home-care/save',[HomeCareController::class,'store'])->name('home.care.save');
        Route::get('/home-care/edit/{id}',[HomeCareController::class,'edit'])->name('home.care.edit');
        Route::post('/home-care/update/{id}',[HomeCareController::class,'update'])->name('home.care.update');
        Route::get('/home-care/delete/{id}',[HomeCareController::class,'destroy'])->name('home.care.delete');

        //Kategori Jasa Layanan
        Route::get('/kategori-jasa',[KategoriJasaController::class,'index'])->name('kategori.jasa');
        Route::post('/kategori-jasa/save',[KategoriJasaController::class,'store'])->name('kategori.jasa.save');
        Route::get('/kategori-jasa/edit/{id}',[KategoriJasaController::class,'edit'])->name('kategori.jasa.edit');
        Route::post('/kategori-jasa/update/{id}',[KategoriJasaController::class,'update'])->name('kategori.jasa.update');
        Route::get('/kategori-jasa/delete/{id}',[KategoriJasaController::class,'destroy'])->name('kategori.jasa.delete');
        Route::get('/kategori-jasa/export',[KategoriJasaController::class,'exportKategori'])->name('kategori.jasa.excel');
        Route::post('/kategori-jasa/import',[KategoriJasaController::class,'importKategori'])->name('kategori.jasa.import');

        //Daftar Pasien
        Route::get('/daftar-pasien',[DaftarPasienController::class,'index'])->name('daftar.pasien');
        Route::post('/daftar-pasien/save',[DaftarPasienController::class,'store'])->name('daftar.pasien.save');
        Route::get('/daftar-pasien/edit/{id}',[DaftarPasienController::class,'edit'])->name('daftar.pasien.edit');
        Route::post('/daftar-pasien/update/{id}',[DaftarPasienController::class,'update'])->name('daftar.pasien.update');
        Route::get('/daftar-pasien/delete/{id}',[DaftarPasienController::class,'destroy'])->name('daftar.pasien.delete');
        Route::get('/daftar-pasien/export',[DaftarPasienController::class,'ExportDaftarPasien'])->name('daftar.pasien.excel');
        Route::post('/daftar-pasien/import',[DaftarPasienController::class,'ImportDaftarPasien'])->name('daftar.pasien.import');

        //Daftar Tugas Layanan
        Route::get('/daftar-tugas',[DaftarTugasController::class,'index'])->name('daftar.tugas');
        Route::post('/daftar-tugas/save',[DaftarTugasController::class,'store'])->name('daftar.tugas.save');
        Route::get('/daftar-tugas/edit/{id}',[DaftarTugasController::class,'edit'])->name('daftar.tugas.edit');
        Route::post('/daftar-tugas/update/{id}',[DaftarTugasController::class,'update'])->name('daftar.tugas.update');
        Route::get('/daftar-tugas/delete/{id}',[DaftarTugasController::class,'destroy'])->name('daftar.tugas.delete');
        Route::get('/daftar-tugas/ceklis/{id}',[DaftarTugasController::class,'CeklisJasaMedis'])->name('daftar.tugas.ceklis');
        Route::get('/daftar-tugas/riwayat',[DaftarTugasController::class,'RiwayatTugas'])->name('daftar.tugas.riwayat');
        Route::get('/detail-tugas/detail/{user_id}', [DaftarTugasController::class, 'DetailRiwayatTugas'])->name('daftar.tugas.detail');
        Route::get('/detail-tugas/delete/{id}',[DaftarTugasController::class,'Delete'])->name('daftar.tugas.delete.user');
        Route::get('/detail-tugas/cari/{user_id}',[DaftarTugasController::class,'cari'])->name('daftar.tugas.cari.user');

        //task list jasa medis
        // Route::get('/task-list',[TasklistJasaMedisController::class,'index'])->name('task.list.index');
        // Route::get('/task-list/history',[TasklistJasaMedisController::class,'HistoryTask'])->name('task.list.history');
        Route::get('/task-list/search/{user_id}',[DaftarTugasController::class,'cari'])->name('task.list.search');
        //note karyawan
        Route::resource('/note-karyawan', NoteKaryawanController::class)->names('note-karyawan');
        Route::get('/note-karyawan/delete/{id}', [NoteKaryawanController::class,'delete'])->name('note-karyawan.delete');
        Route::get('/note-karyawan/update/{id}', [NoteKaryawanController::class,'updatelagi'])->name('note-karyawan.updatelagi');
        Route::get('/note-karyawan/search',[NoteKaryawanController::class,'SearchCatatan'])->name('note-karyawan.search');

        //job-vacancy
        Route::get('/job-vacancy',[JobVacancyController::class,'index'])->name('job-vacancy.index');
        Route::get('/job-vacancy-nakes',[JobVacancyController::class,'index_Nakes'])->name('job-vacancy.index.nakes');
        Route::get('/job-vacancy-non-nakes',[JobVacancyController::class,'index_Non_Nakes'])->name('job-vacancy.index.non-nakes');
        Route::get('/job-vacancy/create',[JobVacancyController::class,'create'])->name('job-vacancy.create');
        Route::post('/job-vacancy/save',[JobVacancyController::class,'store'])->name('job-vacancy.store');
        Route::get('/job-vacancy/edit/{id}',[JobVacancyController::class,'edit'])->name('job-vacancy.edit');
        Route::post('/job-vacancy/update/{id}',[JobVacancyController::class,'update'])->name('job-vacancy.update');
        Route::get('/job-vacancy/delete/{id}',[JobVacancyController::class,'destroy'])->name('job-vacancy.delete');

        //job-application
        Route::get('job-app',[JobApplicationController::class,'index'])->name('job-app');
        Route::get('job-app/show/{id}',[JobApplicationController::class,'show'])->name('job-app.show');
        Route::get('job-app/delete/{id}',[JobApplicationController::class,'destroy'])->name('job-app.delete');

        //setting layout content
        Route::get('/setting-content',[LayoutController::class,'index'])->name('setting-content.index');
        Route::get('/setting-content/beranda',[LayoutController::class,'index_beranda'])->name('setting-content.beranda');
        Route::post('/setting-content/beranda-save',[LayoutController::class,'store_beranda'])->name('setting-content.beranda.save');
        Route::post('/setting-content/beranda-update/{id}',[LayoutController::class,'update_beranda'])->name('setting-content.beranda.update');

        Route::get('/setting-content/profil',[LayoutController::class,'index_tentang'])->name('setting-content.tentang');
        Route::post('/setting-content/profil-save',[LayoutController::class,'store_tentang'])->name('setting-content.tentang.save');
        Route::post('/setting-content/profil-update/{id}',[LayoutController::class,'update_tentang'])->name('setting-content.profil.update');

        Route::get('/setting-content/layanan',[LayoutController::class,'index_layanan'])->name('setting-content.layanan');
        Route::post('/setting-content/layanan-save',[LayoutController::class,'store_layanan'])->name('setting-content.layanan.save');
        Route::get('/setting-content/layanan-delete/{id}',[LayoutController::class,'destroy_layanan'])->name('setting-content.layanan.delete');
        Route::get('/setting-content/layanan-edit/{id}',[LayoutController::class,'edit_layanan'])->name('setting-content.layanan.edit');
        Route::post('/setting-content/layanan-update/{id}',[LayoutController::class,'update_layanan'])->name('setting-content.layanan.upto');

        Route::get('/setting-content/divisi',[LayoutController::class,'index_divisi'])->name('setting-content.divisi');
        Route::post('/setting-content/divisi-save',[LayoutController::class,'store_divisi'])->name('setting-content.divisi.save');
        Route::get('/setting-content/divisi-delete/{id}',[LayoutController::class,'destroy_divisi'])->name('setting-content.divisi.delete');
        Route::get('/setting-content/divisi-edit/{id}',[LayoutController::class,'edit_divisi'])->name('setting-content.divisi.edit');
        Route::post('/setting-content/divisi-update/{id}',[LayoutController::class,'update_divisi'])->name('setting-content.divisi.update');

        Route::get('/setting-content/faq',[LayoutController::class,'index_faq'])->name('setting-content.faq');
        Route::post('/setting-content/faq-save',[LayoutController::class,'store_faq'])->name('setting-content.faq.save');
        Route::get('/setting-content/faq-edit/{id}',[LayoutController::class,'edit_faq'])->name('setting-content.faq.edit');
        Route::get('/setting-content/faq-delete/{id}',[LayoutController::class,'destroy_faq'])->name('setting-content.faq.delete');
        Route::post('/setting-content/faq-update/{id}',[LayoutController::class,'update_faq'])->name('setting-content.faq.update');

        Route::get('/setting-content/dokter',[LayoutController::class,'index_dokter'])->name('setting-content.dokter');
        Route::post('/setting-content/dokter-save',[LayoutController::class,'store_dokter'])->name('setting-content.dokter.save');
        Route::get('/setting-content/dokter-delete/{id}',[LayoutController::class,'destroy_dokter'])->name('setting-content.dokter.delete');
        Route::post('/setting-content/dokter-update/{id}',[LayoutController::class,'update_dokter'])->name('setting-content.dokter.update');
        Route::get('/setting-content/dokter-edit/{id}',[LayoutController::class,'edit_dokter'])->name('setting-content.dokter.edit');

        //kritik dan saran
        Route::get('/kritik-saran',[KritikSaraanController::class,'index'])->name('kritik-saran');
        Route::get('/kritik-saran/{id}',[KritikSaraanController::class,'destroy'])->name('kritik-saran.delete');
        Route::get('/kritik-saran/search',[KritikSaraanController::class,'SearchKritik'])->name('kritik-saran.search');

        //Docs API
        Route::get('/hit-api',[ApiDocsController::class,'index'])->name('api.docs');

        //dataset
        Route::get('/dataset-khitan',[DatasetKhitanController::class,'index'])->name('dataset.khitan');
        Route::post('/dataset-khitan/save',[DatasetKhitanController::class,'store'])->name('dataset.khitan.store');
        Route::post('/dataset-khitan/import',[DatasetKhitanController::class,'ImportDatasetKhitan'])->name('dataset.khitan.import');
        Route::get('/dataset-khitan/delete/{id}',[DatasetKhitanController::class,'destroy'])->name('dataset.khitan.delete');
        Route::get('/dataset-khitan-cari', [DatasetKhitanController::class,'Cari_Dataset_Khitan'])->name('khitan.cari');

        Route::get('/dataset-lab',[DatasetLabController::class,'index'])->name('dataset.lab');
        Route::post('/dataset-lab/save',[DatasetLabController::class,'store'])->name('dataset.lab.store');
        Route::get('/dataset-lab/delete/{id}',[DatasetLabController::class,'destroy'])->name('dataset.lab.delete');
        Route::get('/dataset-lab-cari', [DatasetLabController::class,'Cari_Dataset_Lab'])->name('lab.cari');
        Route::post('/dataset-lab/import',[DatasetLabController::class,'ImportDatasetLab'])->name('dataset.lab.import');

        Route::get('/dataset-persalinan',[DatasetPersalinanController::class,'index'])->name('dataset.persalinan');
        Route::post('/dataset-persalinan/save',[DatasetPersalinanController::class,'store'])->name('dataset.persalinan.store');
        Route::get('/dataset-persalinan/delete/{id}',[DatasetPersalinanController::class,'destroy'])->name('dataset.persalinan.delete');

        Route::get('/dataset-ranap',[DatasetRawatInapController::class,'index'])->name('dataset.ranap');
        Route::post('/dataset-ranap/save',[DatasetRawatInapController::class,'store'])->name('dataset.ranap.store');
        Route::post('/dataset-ranap/import',[DatasetRawatInapController::class,'ImportDatasetRanap'])->name('dataset.ranap.import');
        Route::get('/dataset-ranap-cari', [DatasetRawatInapController::class,'Cari_Dataset_Ranap'])->name('ranap.cari');
        Route::get('/dataset-ranap-delete/{id}', [DatasetRawatInapController::class,'destroy'])->name('ranap.delete');

        Route::get('/dataset-rajal',[DatasetRajalController::class,'index'])->name('dataset.rajal');
        Route::post('/dataset-rajal/save',[DatasetRajalController::class,'store'])->name('dataset.rajal.store');
        Route::get('/dataset-rajal-cari', [DatasetRajalController::class,'Cari_Dataset_Rajal'])->name('rajal.cari');
        Route::get('/dataset-delete/{id}', [DatasetRajalController::class,'destroy'])->name('rajal.delete');
        Route::post('/dataset-rajal/import',[DatasetRajalController::class,'ImportDatasetRajal'])->name('dataset.rajal.import');

        Route::get('/dataset-usg',[DatasetUsgController::class,'index'])->name('dataset.usg');
        Route::post('/dataset-usg/save',[DatasetUsgController::class,'store'])->name('dataset.usg.store');
        Route::get('/dataset-usg/delete/{id}',[DatasetUsgController::class,'destroy'])->name('dataset.usg.delete');
        Route::get('/dataset-usg-cari', [DatasetUsgController::class,'Cari_Dataset_Usg'])->name('usg.cari');

        Route::get('/dataset-Estetika',[DatasetEstetikaController::class,'index'])->name('dataset.estetika');
        Route::post('/dataset-Estetika/save',[DatasetEstetikaController::class,'store'])->name('dataset.estetika.store');
        Route::get('/dataset-Estetika/delete/{id}',[DatasetEstetikaController::class,'destroy'])->name('dataset.estetika.delete');
        Route::get('/dataset-Estetika-cari', [DatasetEstetikaController::class,'Cari_Dataset_Estetika'])->name('estetika.cari');

        Route::post('/presensi/import',[PresensiController::class,'insert_excel'])->name('presensi.import');
        Route::get('/presensi/import',[PresensiController::class,'export_presensi'])->name('presensi.export');

        //rubahip
        Route::post('/update-ip', [IPConfigController::class,'update'])->name('update-ip');
        Route::get('/index-ip', [IPConfigController::class,'index'])->name('ip.index');
    });
    //role pegawai
    Route::group(['roles' => 'pegawai'], function(){
        Route::get('/daftar-hadir', [PresensiController::class,'show'])->name('daftar-hadir');
        Route::get('/daftar-hadir/show',[PresensiController::class,'RiwayatShow'])->name('riwayat.daftar-hadir');
        Route::get('/daftar-hadir/cari', [PresensiController::class,'cariDaftarHadir'])->name('daftar-hadir.cari');
        Route::get('/pengajuan-cuti',[CutiController::class,'index'])->name('cuti.pegawai');
        Route::post('/simpan-cuti',[CutiController::class,'store'])->name('submit.cuti');

        //izin
        Route::get('/Data-izin',[CutiController::class,'indexCutiUser'])->name('index.izin.user');
        Route::post('/pengajuan-izin',[CutiController::class,'store'])->name('pengajuan.cuti');
        Route::get('/pengajuan-create',[CutiController::class,'create'])->name('pengajuan.create');
        //rubah-jadwal
        Route::get('/permohonan-jadwal',[RubahjadwalController::class,'index'])->name('permohonan.jadwal.user');
        Route::post('/permohonan-save',[RubahjadwalController::class,'store'])->name('permohonan.save');
        Route::get('/permohonan-create',[RubahjadwalController::class,'create'])->name('permohonan.create');

        Route::get('/Gaji-pegawai',[PenggajianController::class,'IndexGajiPegawai'])->name('gaji.pegawai');
        Route::get('/Insentif-pegawai',[PenggajianController::class,'insentifPegawai'])->name('insentif.pegawai');
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
    Route::post('/update-profil/{id}',[DetailController::class,'update'])->name('update.detail.user');
    Route::get('/form-eedit/{id}',[DetailController::class,'edit'])->name('edit.detail');

    //dokumen
    Route::get('/dokumen',[DokumenController::class,'index'])->name('upload.dokumen');
    Route::post('/save-dokumen',[DokumenController::class,'store'])->name('save.dokumen');
    //dokumen-sertifikat
    Route::get('/sertifikat',[SertifikatController::class,'index'])->name('upload.sertifikat');
    Route::post('/save-sertifikat',[SertifikatController::class,'store'])->name('save.sertifikat');
    //jadwal-shift
    Route::get('/download-jadwal',[JadwalshiftController::class,'jadwaldownload'])->name('download.jadwal');
    Route::get('/jadwal-shift-karyawan',[JadwalshiftController::class,'indexUser'])->name('jadwal.user');
    Route::get('/cari-jadwal-user', [JadwalshiftController::class,'cariJadwal'])->name('cari.jadwal.user');
    //gaji penerima 
    Route::get('/Payroll-confirm-penerima/{id}',[PenggajianController::class,'ConfirmPenerima'])->name('gaji.confirm.penerima');
    //HelpIT
    Route::get('/help-IT', [HelpITController::class,'index'])->name('help-IT');

});
