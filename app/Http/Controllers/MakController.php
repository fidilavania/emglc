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
   
        return view('mak.menu',compact('kantor','badanhukum'));   
    }

    public function formAgunan()
    {
     	$kantor = DB::connection('mysql')->table('master_kantor')->where('kode_induk',Auth::user()->kantor)->get();
   
        return view('mak.form_agunan',compact('kantor'));   
    }

    public function formAnalisa()
    {
     	$kantor = DB::connection('mysql')->table('master_kantor')->where('kode_induk',Auth::user()->kantor)->get();
   
        return view('mak.form_analisa',compact('kantor'));   
    }
}
