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
// Route::get('/pilih', 'RbbController@viewPilih');
// GRAHA EMG
Route::get('/graha', 'GrahaController@formgraha');

// Foto
// Route::get('/fotoemg', 'GrahaController@formfoto');

// perpus
Route::get('/info', 'GrahaController@viewInfo');

// lowongan
Route::get('/karir', 'GrahaController@viewKarir');



Route::get('auth/login', 'AuthController@login')->name('login');
Route::post('auth/postlogin','AuthController@authenticate');

// Route::get('auth/loginrbb', 'RbbController@loginrbb')->name('loginrbb');
// Route::post('auth/postlogin','RbbController@authenticaterbb');

Route::group(['middleware' => ['auth']], function () {
		//Home
	Route::get('/', 'HomeController@viewDashboard');
	Route::get('/pilih', 'RbbController@viewPilih');
	Route::get('/homerbb', 'RbbController@viewHomeRbb');

	// foto
	Route::match(['get', 'post'],'/fotokeg/{key?}', 'GrahaController@formfotologin')->where('key', '(.*)');
	Route::get('/uploadfoto', 'GrahaController@formUploadFoto');
	Route::post('/saveupload/{nourut?}', 'GrahaController@saveUploadFoto');

	// Route::get('/upload', 'GrahaController@formupload');
	// Route::post('/savefoto', 'GrahaController@saveFotoGalery');

	// max
	Route::get('/mak', 'MakController@formmak');
	Route::get('/menuutama', 'MakController@formMenu');
		// agunan 
		Route::get('/agunan', 'MakController@formAgunan');
		// analisa
		Route::get('/analisa', 'MakController@formAnalisa');
	// Route::post('/savemak', 'MakController@savemax');

	// RBB
		// RBB import
		Route::get('/import', 'RbbController@viewImport');
		// Route::get('/', 'StudentController@index')->name('index');
		Route::post('/proses', 'RbbController@proses')->name('proses');

		// rencana
		Route::get('/0102', 'RbbViewController@view0102');
		Route::get('/0102/{tanggal}', 'RbbViewController@view0102tanggal');
		Route::get('/0301', 'RbbViewController@view0301');
		Route::get('/0301/{tanggal}', 'RbbViewController@view0301tanggal');
		Route::get('/0401', 'RbbViewController@view0401');
		Route::get('/0401/{tanggal}', 'RbbViewController@view0401tanggal');
		Route::get('/0501', 'RbbViewController@view0501');
		Route::get('/0501/{tanggal}', 'RbbViewController@view0501tanggal');
		Route::get('/0601', 'RbbViewController@view0601');
		Route::get('/0601/{tanggal}', 'RbbViewController@view0601tanggal');
		Route::get('/0701', 'RbbViewController@view0701');
		Route::get('/0701/{tanggal}', 'RbbViewController@view0701tanggal');
		Route::get('/0801', 'RbbViewController@view0801');
		Route::get('/0801/{tanggal}', 'RbbViewController@view0801tanggal');
		Route::get('/0802', 'RbbViewController@view0802');
		Route::get('/0802/{tanggal}', 'RbbViewController@view0802tanggal');
		Route::get('/0803', 'RbbViewController@view0803');
		Route::get('/0803/{tanggal}', 'RbbViewController@view0803tanggal');
		Route::get('/0804', 'RbbViewController@view0804');
		Route::get('/0804/{tanggal}', 'RbbViewController@view0804tanggal');
		Route::get('/0805', 'RbbViewController@view0805');
		Route::get('/0805/{tanggal}', 'RbbViewController@view0805tanggal');
		Route::get('/0806', 'RbbViewController@view0806');
		Route::get('/0806/{tanggal}', 'RbbViewController@view0806tanggal');
		Route::get('/0807', 'RbbViewController@view0807');
		Route::get('/0807/{tanggal}', 'RbbViewController@view0807tanggal');
		Route::get('/0901', 'RbbViewController@view0901');
		Route::get('/0901/{tanggal}', 'RbbViewController@view0901tanggal');
		Route::get('/0902', 'RbbViewController@view0902');
		Route::get('/0902/{tanggal}', 'RbbViewController@view0902tanggal');
		Route::get('/0903', 'RbbViewController@view0903');
		Route::get('/0903/{tanggal}', 'RbbViewController@view0903tanggal');

		// export
		Route::get('/export', 'RbbViewController@viewEksport');
		// Route::post('/download-jsonfile', array('as'=> 'file.download', 'uses' => 'RbbViewController@downloadJSONFile'));
		Route::post('/download-jsonfile', array('as'=> 'file.download', 'uses' => 'RbbViewController@getDownload'));

		// Realisasi

		// import
		Route::get('/importR', 'RealController@viewImportReal');
		// Route::get('/', 'StudentController@index')->name('index');
		Route::post('/prosesR', 'RealController@prosesReal')->name('prosesR');

		// export
		Route::get('/exportR', 'RealController@viewEksportReal');
		Route::post('/download-jsonfile-real', array('as'=> 'file.download', 'uses' => 'RealController@getDownloadreal'));

		Route::get('/0201R', 'RealController@view0201R');
		Route::get('/0201R/{tanggal}', 'RealController@view0201Rtanggal');

		Route::get('/0301R', 'RealController@view0301R');
		Route::get('/0301R/{tanggal}', 'RealController@view0301Rtanggal');

		Route::get('/0401R', 'RealController@view0401R');
		Route::get('/0401R/{tanggal}', 'RealController@view0401Rtanggal');

	// SDM
	Route::match(['get', 'post'],'/datasdm/{key?}/{kol?}', 'SdmController@viewDataSdm');
	Route::get('/addsdm', 'SdmController@viewFormSDM');
	Route::post('/savesdm/{nonsb?}','SdmController@saveDataSDM');
	Route::get('/editsdm/{nonsb?}', 'SdmController@viewFormSDMEdit');
	Route::post('/savesdmedit/{nonsb?}','SdmController@saveDataSDMEdit');
	Route::get('/viewsdm/{nonsb?}', 'SdmController@viewFormSDMview');

	// mutasi
	Route::get('/mutasi/{nonsb?}', 'SdmController@viewFormMutasi');
	Route::post('/savemut/{nonsb?}','SdmController@saveDataMutasi');
	Route::match(['get', 'post'],'/datamutasi/{key?}', 'SdmController@viewDataMutasi')->where('key', '(.*)');

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

	// cetak sertifikat
	Route::get('/cetaksertif/{nonsb?}', 'PesertaController@CetakSertif');
	Route::get('/nosertif', 'PesertaController@NoSertif');
	Route::get('/excelsertif', 'PesertaController@Excelcetak');
	// Route::get('pdfview',array('as'=>'pdfview','uses'=>'ItemController@pdfview'));
	// Route::get('/cetaksertif/{nonsb?}',array('as'=>'pdfview','uses'=>'PesertaController@CetakSertif'));

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

