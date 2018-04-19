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
Route::get('auth/login', 'AuthController@login')->name('login');;
Route::post('auth/postlogin','AuthController@authenticate');

Route::group(['middleware' => ['auth']], function () {
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
	Route::post('admin/saveuser', 'AdminController@postSaveUser');
	Route::match(['get', 'post'],'lihatuser/{kol?}/{key?}', 'AdminController@getDaftarUser');

	// daftar materi
	Route::get('/daftar/{nonsb?}', 'InputController@viewFormDaftar');
	Route::post('/savedaftar/{nonsb?}','InputController@saveDaftar');

	// daftar detail
	Route::get('/detaildaftar/{nonsb?}', 'ViewController@viewFormDetailDaftar');
	Route::post('/savedetaildaftar/{nonsb?}','ViewController@saveFormDetailDaftar');
	
	

	Route::get('auth/logout', 'AuthController@logout');
});

