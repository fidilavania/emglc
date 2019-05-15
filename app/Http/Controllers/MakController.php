<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\master_kantor;
use DB;
use Auth;
use Log;
use Input;
use Illuminate\Support\Facades\Storage;

class MakController extends Controller
{
    public function formmak()
    {
        
        return view('mak.homemak');   
    }

    public function formMenu()
    {
     	$kantor = DB::connection('mysql')->table('master_kantor')->where('kode_induk',Auth::user()->kantor)->get();
        $badanhukum = DB::connection('mysql2')->table('master_badan_hukum')->get();
        $jmemo = DB::connection('mysql2')->table('master_jenis_memo')->get();
        $jusaha = DB::connection('mysql2')->table('master_jenis_usaha')->get();
        $kerja = DB::connection('mysql2')->table('master_pekerjaan')->get();
        $nikah = DB::connection('mysql2')->table('master_pernikahan')->get();
        $dep = DB::connection('mysql2')->table('status_debitur')->get();
        $kolek = DB::connection('mysql2')->table('aktivitas_rekening_pinjaman')->get();
        $gjefas = DB::connection('mysql2')->table('grop_explosure_jenis_fasilitas')->get();
        $mjefas = DB::connection('mysql2')->table('master_jenis_fasilitas')->get();
        $ragun = DB::connection('mysql2')->table('master_rincian_agunan')->get();
        $yatidak = DB::connection('mysql2')->table('diasuransikan')->get();
        $slik = DB::connection('mysql2')->table('master_slik')->get();
        $s_slik = DB::connection('mysql2')->table('status_slik')->get();
        $p_usaha = DB::connection('mysql2')->table('pengalaman_usaha')->get();
        $r_lokal = DB::connection('mysql2')->table('reputasi_lokal')->get();
        $hub_bank = DB::connection('mysql2')->table('hubungan_bank')->get();

        $prospek = DB::connection('mysql2')->table('prospek_bisnis')->get();
        $usaha = DB::connection('mysql2')->table('kemampuan_usaha')->get();
        $modal = DB::connection('mysql2')->table('permodalan')->get();
        $trade = DB::connection('mysql2')->table('trade_checking')->get();
   
        return view('mak.menu',compact('kantor','badanhukum','jmemo','jusaha','place','kerja','nikah','dep','kolek','gjefas','mjefas','ragun','yatidak','slik','s_slik','p_usaha','r_lokal','hub_bank','prospek','usaha','modal','trade'));   
    }

    public function formAgunan()
    {
     	$kantor = DB::connection('mysql')->table('master_kantor')->where('kode_induk',Auth::user()->kantor)->get();
        $jenisrek = DB::connection('mysql2')->table('master_jenisrek')->get();
        $jenispro = DB::connection('mysql2')->table('master_jenis_properti')->get();
        $jenismilik = DB::connection('mysql2')->table('master_jenis_kepemilikan')->get();
        $yatidak = DB::connection('mysql2')->table('diasuransikan')->get();
        $jalan = DB::connection('mysql2')->table('kondisi_jalan')->get();
        $agunan = DB::connection('mysql2')->table('kualitas_agunan')->get();
        
   
        return view('mak.form_agunan',compact('kantor','jenisrek','jenispro','jenismilik','yatidak','jalan','agunan'));   
    }

    public function formAnalisa()
    {
     	$kantor = DB::connection('mysql')->table('master_kantor')->where('kode_induk',Auth::user()->kantor)->get();
   
        return view('mak.form_analisa',compact('kantor'));   
    }
}
