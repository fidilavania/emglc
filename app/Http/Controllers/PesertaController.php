<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\klien;
use App\materi;
use App\sdm;
use App\peserta;
use App\materi_detail;
use App\mst_kantor;
use App\mst_gelar;
use App\mst_jabatan;
use App\Http\Controllers\Controller;
use App\Kelurahan;
use App\Kecamatan;
use App\kab;
use App\sdm_photo;
use App\jabatan_mst;
use App\kantor_mst; 
use DB;
use Auth;
use Log;
use Input;

class PesertaController extends Controller
{
    public function formPendaftaran($key=null)
    {
        $sdm = DB::connection('mysql')->table('sdm')->get();
        $sdm2 = DB::connection('mysql')->table('sdm')->first();
        $materi = DB::connection('mysql')->table('materi')->first();
        $detail = DB::connection('mysql')->table('materi_detail')->first();
        $detailmateri = DB::connection('mysql')->table('materi_detail')->get();

        $datakredit = array();

        if($key == null){
            $nsblist = materi::select('kode_modul','fasilitator','nama_modul','silabus','peserta','durasi','biaya')->paginate(20);
        } else {
            $nsblist = materi::select('kode_modul','fasilitator','nama_modul','silabus','peserta','durasi','biaya')->whereRaw
            ("kode_modul LIKE '%".strtoupper($key)."%'OR nama_modul LIKE '%".strtoupper($key)."%' ")->paginate(20);
        }


        return view('peserta.formpendaftaran',compact('sdm','materi','detail','detailmateri','sdm2','nsblist','datakredit'));   
    }
    
}
