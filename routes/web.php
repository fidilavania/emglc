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

Route::get('auth/login', 'AuthController@login');
Route::post('auth/postlogin','AuthController@authenticate');

Route::group(['middleware' => ['web','auth']], function () {
		//Home
	Route::get('/', 'HomeController@viewDashboard');
	
	//input
	Route::get('/addsdm', 'InputController@viewFormSDM');
	Route::get('/addmateri', 'InputController@viewFormMateri');
	Route::get('/addklien', 'InputController@viewFormKlien');
	Route::get('/addkantor', 'InputController@viewFormKantor');
	Route::get('/addjabatan', 'InputController@viewFormJabatan');

	Route::post('/savesdm/{nonsb?}','InputController@saveDataSDM');
	Route::post('/savemateri/{nonsb?}','InputController@saveDataMateri');
	Route::post('/saveklien/{nonsb?}','InputController@saveDataKlien');
	Route::post('/savekantor/{nonsb?}','InputController@saveDataKantor');
	Route::post('/savejabatan/{nonsb?}','InputController@saveDataJabatan');

	//CARI
	Route::match(['get', 'post'],'/datasdm/{key?}', 'ViewController@viewDataSdm')->where('key', '(.*)');
	Route::match(['get', 'post'],'/datamateri/{key?}', 'ViewController@viewDataMateri')->where('key', '(.*)');
	Route::match(['get', 'post'],'/dataklien/{key?}', 'ViewController@viewDataKlien')->where('key', '(.*)');
	
	//EDIT
	Route::get('/editsdm/{nonsb?}', 'InputController@viewFormSDMEdit');
	Route::get('/editmateri/{nonsb?}', 'InputController@viewFormMateriEdit');
	Route::get('/editklien/{nonsb?}', 'InputController@viewFormKlienEdit');

	Route::post('/savesdmedit/{nonsb?}','InputController@saveDataSDMEdit');
	Route::post('/savemateriedit/{nonsb?}','InputController@saveDataMateriEdit');
	Route::post('/saveklienedit/{nonsb?}','InputController@saveDataKlienEdit');

	//Admin
		Route::get('/adduser', 'AdminController@getFormUser');
		Route::post('admin/saveuser/{nonsb?}', 'AdminController@postSaveUser');
		Route::match(['get', 'post'],'lihatuser/{kol?}/{key?}', 'AdminController@getDaftarUser');

	// BATAS

	// angsuran
	Route::get('/angsuran/{tahun?}/{kode_kantor?}/{nourut?}', 'KreditController@angsuran');

	// hide
	// Route::get('/addkreditbadan/{nonsb?}', 'KreditController@viewFormKreditBadan');
	// Route::post('/savekreditbadan/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','KreditController@saveDataKreditBadan');
	// 
	
	Route::get('/addlapbadan/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}', 'LaporanController@viewFormLapBadan');
	Route::post('/savelapbadan/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','LaporanController@saveDataBadan');
	Route::get('/addpengurus/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}', 'NasabahController@viewFormPengurus');
	Route::post('/savepengurus/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','NasabahController@saveDataPengurus');

	Route::get('/lihatdata', 'DataController@viewFormDataNasabah');
	Route::get('/nasabahbaru/{nonsb?}', 'DataController@dataFormNasabahBaru');
	
	// hide
	// Route::get('/addkredit/{nonsb?}', 'KreditController@viewFormKredit');
	Route::get('/viewkredit/{tahun?}/{kode_kantor?}/{nourut?}', 'DataController@dataFormViewKredit')->where('{tahun?}/{kode_kantor?}/{nourut?}', '(.*)');
	// Route::get('/addagunan/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','AgunanController@viewFormAgunan');
	// 

	Route::get('/addpenjamin/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','PenjaminController@viewFormPenjamin');
	
	Route::match(['get', 'post'],'/lihatdata/{key?}', 'DataController@viewFormDataNasabah')->where('key', '(.*)');
	// Route::match(['get', 'post'],'/lihatdatabadan/{key?}', 'DataController@viewFormDataNasabahBadan')->where('key', '(.*)');		
	
	// nuk
		Route::get('/addkredit/{nonsb?}', 'KreditControllerNUK@viewFormKredit');
		Route::get('/addagunan/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','AgunanControllerNUK@viewFormAgunan');
		Route::get('/addkreditbadan/{nonsb?}', 'KreditControllerNUK@viewFormKreditBadan');
		Route::post('/savekreditbadan/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','KreditControllerNUK@saveDataKreditBadan');

		Route::post('/saveKredit/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','KreditControllerNUK@saveDataKredit');
		Route::post('/saveAgunan/{nonsb?}/{nokredit?}','AgunanControllerNUK@saveDataAgunan');

		//adendum agunan nuk
		Route::get('/addagunanaden/{tahun?}/{kode_kantor?}/{nourut?}','AgunanControllerNUK@viewFormAgunanAden');
		Route::post('/saveAgunanAden/{tahun?}/{kode_kantor?}/{nourut?}','AgunanControllerNUK@saveDataAgunanAden');

		//adendum kredit
		Route::get('/addkreditaden/{tahun?}/{kode_kantor?}/{nourut?}', 'KreditControllerNUK@viewFormKreditAden');
		// Route::get('/addkreditaden/{nokredit?}', 'DataController@viewFormKreditAden');
		Route::post('/saveKreditAden/{tahun?}/{kode_kantor?}/{nourut?}','KreditControllerNUK@saveDataKreditAden');

		//paripasu
		Route::get('/addkreditparipasu/{nonsb?}', 'KreditControllerNUK@viewFormKreditParipasu');
		Route::post('/savekreditparipasu/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','KreditControllerNUK@saveDataKreditParipasu');
		Route::get('/addagunanparipasu/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','AgunanControllerNUK@viewFormAgunanParipasu');
		Route::post('/saveAgunanparipasu/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','AgunanControllerNUK@saveDataAgunanParipasu');


	//hapuskredit
	Route::get('/hapuskredit/{tahun?}/{kode_kantor?}/{nourut?}', 'DataController@viewFormKreditHapus');
	Route::post('/savehapus/{tahun?}/{kode_kantor?}/{nourut?}','DataController@saveDataKreditHapus');

	//hapusagunan
	Route::get('/hapusagunan/{tahun?}/{kode_kantor?}/{nourut?}', 'DataController@viewFormAgunHapus');
	Route::post('/savehapusagun/{tahun?}/{kode_kantor?}/{nourut?}','DataController@saveDataAgunHapus');

	//tukaragunan
	Route::get('/tukaragunan/{tahun?}/{kode_kantor?}/{nourut?}', 'AgunanController@viewFormAgunanTukar');
	Route::post('/savetukaragun/{tahun?}/{kode_kantor?}/{nourut?}','AgunanController@saveDataAgunanTukar');

	// hide
	//adendum agunan
	// Route::get('/addagunanaden/{tahun?}/{kode_kantor?}/{nourut?}','AgunanController@viewFormAgunanAden');
	// Route::post('/saveAgunanAden/{tahun?}/{kode_kantor?}/{nourut?}','AgunanController@saveDataAgunanAden');
	// 

	//adendum penjamin
	Route::get('/addpenjaminaden/{tahun?}/{kode_kantor?}/{nourut?}','PenjaminController@viewFormPenjaminAden');
	Route::post('/savePenjaminAden/{tahun?}/{kode_kantor?}/{nourut?}','PenjaminController@saveDataPenjaminAden');
	
	// hide
	//adendum kredit
	// Route::get('/addkreditaden/{tahun?}/{kode_kantor?}/{nourut?}', 'DataController@viewFormKreditAden');
	// // Route::get('/addkreditaden/{nokredit?}', 'DataController@viewFormKreditAden');
	// Route::post('/saveKreditAden/{tahun?}/{kode_kantor?}/{nourut?}','DataController@saveDataKreditAden');
	// 

	//adendum laporan
	Route::get('/addlaporan/{tahun?}/{kode_kantor?}/{nourut?}','LaporanController@viewFormLaporan');
	Route::post('/saveLaporan/{tahun?}/{kode_kantor?}/{nourut?}','LaporanController@saveDataLaporan');
	//adendum pengurus
	Route::get('/addpengurusaden/{tahun?}/{kode_kantor?}/{nourut?}','NasabahController@viewFormPengurusAden');
	Route::post('/savepengurusaden/{tahun?}/{kode_kantor?}/{nourut?}','NasabahController@saveDataPengurusAden');

	//paripasu
	Route::get('/addkreditparipasu/{nonsb?}', 'KreditController@viewFormKreditParipasu');
	Route::post('/savekreditparipasu/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','KreditController@saveDataKreditParipasu');
	Route::get('/addagunanparipasu/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','AgunanController@viewFormAgunanParipasu');
	Route::post('/saveAgunanparipasu/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','AgunanController@saveDataAgunanParipasu');

	// save
	Route::post('/lihatdata', 'DataController@saveFormDataNasabah');
	Route::post('/savenasabahbaru/{nonsb?}','DataController@saveFormNasabahBaru');

	// hide
	// Route::post('/saveKredit/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','KreditController@saveDataKredit');
	// Route::post('/saveAgunan/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','AgunanController@saveDataAgunan');
	// 

	Route::post('/savePenjamin/{nonsb?}/{tahun?}/{kode_kantor?}/{nourut?}','PenjaminController@saveDataPenjamin');
	Route::post('/saveLaporan','LaporanController@saveDataLaporan');
	
	Route::get('auth/logout', 'AuthController@logout');

	// koreksi nuk
		Route::get('/koreksidatanuk','DataController@viewKoreksinuk');
		Route::match(['get', 'post'],'/koreksidatanuk/{key?}', 'DataController@viewKoreksinuk')->where('key', '(.*)');
		//koreksi nasabah
		Route::get('/nasabahkoreksinuk/{nonsb?}', 'DataController@dataFormNasabahKoreksinuk')->where('{nonsb}', '(.*)');	
		Route::post('/savenasabahkoreksinuk/{nonsb?}','DataController@saveFormNasabahKoreksinuk');
		// koreksi agunan
		Route::get('/viewkoreksidatanuk/{tahun?}/{kode_kantor?}/{nourut?}', 'DataController@dataFormKoreksidatanuk')->where('{tahun?}/{kode_kantor?}/{nourut?}', '(.*)');	
		Route::post('/savekoreknuk/{tahun?}/{kode_kantor?}/{nourut?}','DataController@saveKoreksinuk');
		// koreksi kredit
		Route::get('/koreksikredit/{nokreditnuk?}', 'DataController@dataFormKoreksikredit')->where('{nokreditnuk?}', '(.*)');	
		Route::post('/savekreditkorek/{nokreditnuk?}','DataController@savekreditkorek');

	// koreksi
		Route::get('/koreksidata','DataController@viewKoreksi');
		Route::match(['get', 'post'],'/koreksidata/{key?}', 'DataController@viewKoreksi')->where('key', '(.*)');
		//koreksi nasabah
		Route::get('/nasabahkoreksi/{nonsb?}', 'DataController@dataFormNasabahKoreksi')->where('{nonsb}', '(.*)');	
		Route::post('/savenasabahkoreksi/{nonsb?}','DataController@saveFormNasabahKoreksi');
		// koreksi agunan
		Route::get('/viewkoreksidata/{tahun?}/{kode_kantor?}/{nourut?}', 'DataController@dataFormKoreksidata')->where('{tahun?}/{kode_kantor?}/{nourut?}', '(.*)');	
		Route::post('/savekorek/{tahun?}/{kode_kantor?}/{nourut?}','DataController@saveKoreksi');
		// tambah agunan
		Route::get('/tambahagunan/{tahun?}/{kode_kantor?}/{nourut?}','DataController@viewtambahagunan');
		Route::post('/savetambahagun/{tahun?}/{kode_kantor?}/{nourut?}','DataController@savetambahagunan');
		// koreksi kredit
		Route::get('/korekkredit/{tahun?}/{kode_kantor?}/{nourut?}','DataController@viewkorekkredit');
		Route::post('/savekorekkredit/{tahun?}/{kode_kantor?}/{nourut?}','DataController@savekoreksikredit');
		

	


	//print
		// Route::get('kredit/angsuran/bayar/{tahun}/{kantor}/{nourut}', 'KreditController@viewBayarAngsuran');
		Route::get('/cetak/{tahun}/{kantor}/{nourut}', 'KreditController@printBayarAngsuran');
		Route::get('/cetakjadwal/{tahun}/{kantor}/{nourut}', 'KreditController@printJadwal');
		Route::get('/cetakkartu/{tahun}/{kantor}/{nourut}', 'KreditController@printKartu');
		Route::get('/cetakbayar/{tahun}/{kantor}/{nourut}', 'KreditController@printBayar');
		Route::get('/banding/{tahun}/{kantor}/{nourut}', 'KreditController@printbanding');
		// Route::post('kredit/angsuran/bayar/save/{nokredit}', 'KreditController@saveBayarAngsuran')->where('nokredit', '(.*)');

	// laporan angsuran
	Route::get('laporan/angsuran','LaporanController@viewAngsuran');
	Route::get('laporan/angsurannpp/{key?}','LaporanController@viewAngsuranNPP')->where('key', '(.*)');
	Route::get('laporan/angsuranhari/{tanggal?}','LaporanController@viewAngsuranHari');
	Route::get('laporan/angsurantanggal/{tanggal1?}/{tanggal2?}', 'LaporanController@viewAngsuranTanggal');
	// Route::get('laporan/getlapangsuran/{tanggal1}/{tanggal2}/{id}/{off?}', 'LaporanController@getLapAngsuran');	

	// laporN REAL
	Route::get('/lapreal/{tanggal?}', 'LaporanController@viewDafNasabah')->where('tanggal', '(.*)');
	Route::get('/lapreal2', 'LaporanController@viewRealNasabah'); 
	Route::get('/lapreal3/{tanggal1?}/{tanggal2?}', 'LaporanController@viewDaf2Nasabah');
	Route::get('/laprealnpp/{key?}','LaporanController@viewDafNPP')->where('key', '(.*)');

	//laporan lunas
	Route::get('/laplunas', 'LaporanController@viewlaplunas'); 
	Route::get('/laplunasnpp/{key?}','LaporanController@viewlaplunasnpp')->where('key', '(.*)');
	Route::get('/laplunastgl/{tanggal?}', 'LaporanController@viewlaplunastgl')->where('tanggal', '(.*)');
	Route::get('/laplunastgl2/{tanggal1?}/{tanggal2?}', 'LaporanController@viewlaplunastgl2');


	//laporan jatuh tempo
	Route::get('/laptempo','LaporanController@viewTempo');
	Route::get('/laptemponpp/{key?}','LaporanController@viewTempoNPP')->where('key', '(.*)');
	Route::get('/laptempohari/{tanggal?}','LaporanController@viewTempoHari');
	Route::get('/laptempotanggal/{tanggal1?}/{tanggal2?}','LaporanController@viewTempoTanggal');

	//laporan nominatif
	Route::get('/lapnominatif','LaporanController@viewNominatif');
	Route::post('/getnomtotal','LaporanController@getNomTotal');
	Route::get('/lapnominatiftanggal/{tanggal?}','LaporanController@viewNominatifTanggal');

	// laporan tunggakan
	Route::get('/laptunggak','LaporanController@viewTunggak');
	Route::get('/laptunggaktanggal/{tanggal?}','LaporanController@viewTunggakTanggal');

	// daftar AO
		Route::get('admin/daftarao', 'AdminController@getAO');
		Route::match(['get', 'post'],'admin/daftarao/{kol?}/{key?}', 'AdminController@getAO');
		// Route::match(['get', 'post'],'admin/daftarao/{key?}', 'AdminController@getAO')->where('key', '(.*)');

	// validasi
		// bmpk
		Route::get('/validasi/{nokredit?}', 'ValidController@viewbmpk');
		Route::post('/validasi/{nokredit?}', 'ValidController@savevalidasi');

	// laporan usulan kredit
	Route::get('laporan/lapnuk', 'ValidController@viewlapnuk');
	Route::get('laporan/lapnuknpp/{key?}','ValidController@viewnukNPP')->where('key', '(.*)');
	Route::get('laporan/lapnuktgl/{tanggal?}','ValidController@viewnukTanggal');
	Route::get('laporan/lapnuktgl2/{tanggal1?}/{tanggal2?}','ValidController@viewnukTanggal2');

	// jurnal
	Route::get('/jurnal/{tanggaldari?}/{tanggalsampai?}/{namakantor?}','JurnalController@viewJurnal');
	Route::get('/detjurnal/{tanggaldari}/{tanggalsampai}/{noperk}/{namakantor?}','JurnalController@viewDetJurnal');
	Route::get('/tambahjurnal/{tanggaldari?}/{tanggalsampai?}/{namakantor?}','JurnalController@insertJurnal');
	Route::post('/tambahjurnalsave','JurnalController@saveInsertJurnal');
	Route::get('/editjurnal/{nobukti}/{tanggaldari?}/{tanggalsampai?}/{namakantor?}','JurnalController@editJurnal');
	Route::post('/editjurnalsave/{nobukti}','JurnalController@saveEditJurnal');
	Route::get('/hapusjurnal/{nobukti}/{tanggaldari?}/{tanggalsampai?}/{namakantor?}','JurnalController@hapusJurnal');
	Route::get('/neraca/{tanggaldari?}/{tanggalsampai?}/{namakantor?}','JurnalController@viewNeraca');
	// Route::get('/neraca/{inputbulan?}/{inputtahun?}/{namakantor?}','JurnalController@viewNeraca');

	//simulasi tunggakan dan pelunasan
	Route::get('/dafnasabah/{kol?}/{key?}','KreditController@viewDafNasabah')->where('key', '(.*)');
	Route::get('/simulasiangsuran/{nokredit}','KreditController@viewSimAngsuran')->where('nokredit', '(.*)');
	Route::match(['get', 'post'],'/simulasigetdata/{nokredit}','KreditController@getSimAngsuran')->where('nokredit', '(.*)');

});

//Auth::routes();