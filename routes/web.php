<?php

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
Route::get('/welcome', 'AuthController@viewAwal');
// GRAHA EMG
Route::get('/graha', 'GrahaController@formgraha');

Route::get('auth/login', 'AuthController@login')->name('login');
Route::post('auth/postlogin','AuthController@authenticate');

Route::group(['middleware' => ['auth']], function () {
		//Home
	Route::get('/', 'HomeController@viewDashboard');

	// SDM
	Route::match(['get', 'post'],'/datasdm/{key?}/{kol?}', 'SdmController@viewDataSdm');
	Route::get('/addsdm', 'SdmController@viewFormSDM');
	Route::post('/savesdm/{nonsb?}','SdmController@saveDataSDM');
	Route::get('/editsdm/{nonsb?}', 'SdmController@viewFormSDMEdit');
	Route::post('/savesdmedit/{nonsb?}','SdmController@saveDataSDMEdit');
	Route::get('/viewsdm/{nonsb?}', 'SdmController@viewFormSDMview');

	// resign
	Route::match(['get', 'post'],'/dataresign/{key?}', 'SdmController@viewDataResign')->where('key', '(.*)');
	Route::get('/addresign/{nonsb?}', 'SdmController@viewFormResign');
	Route::post('/saveresign/{nonsb?}','SdmController@saveDataResign');

	// camat
	Route::get('/input', 'SdmController@input');
	Route::post('/pilih', 'SdmController@pilih');
	Route::post('/pilihcamat', 'SdmController@pilihcamat');
	Route::post('/pilihlurah', 'SdmController@pilihlurah');

	
	// Route::post('/kodepos', 'BlogController@kodepos');
	
	// Route::post('/pilih', 'SdmController@pilih');
	// Route::post('/pilihcamat', 'SdmController@pilihcamat');
	// Route::post('/pilihlurah', 'SdmController@pilihlurah');

	//input
	Route::get('/addmateri', 'InputController@viewFormMateri');
	Route::get('/addklien', 'InputController@viewFormKlien');
	Route::get('/addkantor', 'InputController@viewFormKantor');
	Route::get('/addjabatan', 'InputController@viewFormJabatan');

	Route::post('/savemateri/{nonsb?}','InputController@saveDataMateri');
	Route::post('/saveklien/{nonsb?}','InputController@saveDataKlien');
	Route::post('/savekantor/{nonsb?}','InputController@saveDataKantor');
	Route::post('/savejabatan/{nonsb?}','InputController@saveDataJabatan');

	//CARI
	Route::match(['get', 'post'],'/datamateri/{key?}', 'ViewController@viewDataMateri')->where('key', '(.*)');
	Route::match(['get', 'post'],'/dataklien/{key?}', 'ViewController@viewDataKlien')->where('key', '(.*)');
	
	//EDIT
	Route::get('/editmateri/{nonsb?}', 'InputController@viewFormMateriEdit');
	Route::get('/editklien/{nonsb?}', 'InputController@viewFormKlienEdit');
	
	Route::post('/savemateriedit/{nonsb?}','InputController@saveDataMateriEdit');
	Route::post('/saveklienedit/{nonsb?}','InputController@saveDataKlienEdit');

	//Admin
	Route::get('/adduser', 'AdminController@getFormUser');
	Route::post('admin/saveuser', 'AdminController@postSaveUser');
	Route::match(['get', 'post'],'lihatuser/{kol?}/{key?}', 'AdminController@getDaftarUser');

	// daftar materi
	Route::get('/daftar/{nonsb?}', 'InputController@viewFormDaftar');
	Route::post('/savedaftar/{nonsb?}','InputController@saveDaftar');

	// daftar detail
	Route::get('/detaildaftar/{nonsb?}', 'PesertaController@viewFormDetailDaftar');
	Route::post('/savedetaildaftar/{nonsb?}','PesertaController@saveFormDetailDaftar');

	// cetak pendaftaran
	Route::get('/cetak/{nonsb?}/{kantor?}', 'PesertaController@viewCetakDaftar');

	// tidak hadir
	Route::get('/detailtidakhadir/{nonsb?}', 'PesertaController@viewFormDetailTidakHadir');
	Route::post('/savedetailtidakhadir/{nonsb?}','PesertaController@saveFormDetailTidakHadir');
	
	// materi
	Route::get('/materi', 'ViewController@formMateri');
	Route::post('/savematerisimpan/{nonsb?}','ViewController@simpanMateri');
	Route::get('/viewmateri/{nonsb?}', 'ViewController@ViewMateriview');

	// daftar hadir
	Route::get('/presensi/{nonsb?}', 'ViewController@viewCetakDaftarHadir');
	Route::get('/presensiexcel/{nonsb?}', 'ViewController@viewCetakDaftarHadirExcel');

	// peserta
	Route::match(['get', 'post'],'/pendaftaran/{key?}', 'PesertaController@formPendaftaran')->where('key', '(.*)');
	Route::get('/materidownload/{nonsb?}', 'PesertaController@ViewMateridownload');

	// usulan
	Route::get('/usul', 'SdmController@viewusulan');
	Route::post('/saveusulsaran','SdmController@saveUsulan');
	Route::match(['get', 'post'],'/usullihat/{key?}', 'SdmController@viewLihatUsulan')->where('key', '(.*)');

	// piagam
	Route::get('/piagam', 'LaporanController@formpiagam');

	// laporan data sdm
	Route::get('/lapsdm', 'LaporanController@formlapsdm');

	// coba
	Route::get('/coba', 'LaporanController@formcoba');
	Route::post('/savecoba','LaporanController@saveCoba');
	

	Route::get('auth/logout', 'AuthController@logout');
});

