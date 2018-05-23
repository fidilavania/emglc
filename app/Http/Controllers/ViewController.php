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
use App\master_kantor;
use DB;
use Auth;
use Log;
use Input;

class ViewController extends Controller
{

    public function formMateri()
    {
        $sdm = DB::connection('mysql')->table('sdm')->get();
        $sdm2 = DB::connection('mysql')->table('sdm')->first();
        $materi = DB::connection('mysql')->table('materi')->first();
        $detail = DB::connection('mysql')->table('materi_detail')->first();
        $detailmateri = DB::connection('mysql')->table('materi_detail')->get();


        return view('data.formmateri',compact('sdm','materi','detail','detailmateri','sdm2'));   
    }
    public function simpanMateri(Request $request,$nonsb)
    {
        return redirect('/');
    }

    public function viewDataMateri($key=null)
    {

        $datakredit = array();

        if($key == null){
            $nsblist = materi::select('kode_modul','fasilitator','nama_modul','silabus','peserta','durasi','biaya')->paginate(20);
        } else {
            $nsblist = materi::select('kode_modul','fasilitator','nama_modul','silabus','peserta','durasi','biaya')->whereRaw
            ("kode_modul LIKE '%".strtoupper($key)."%'OR nama_modul LIKE '%".strtoupper($key)."%' ")->paginate(20);

        // foreach ($nsblist as $list) {
        //     $datakredit[$list->kode_modul] = kredit::select('no_kredit','no_ref','sistem','lama','plafon','bbt','pinj_pokok','bakidebet','tgl_mulai','tgl_lunas')->whereRaw("no_mohon IN (SELECT no_mohon FROM prekredit WHERE kode_modul = '".$list->kode_modul."')")->get();
        }

        return view('data.formdatamateri',compact('nsblist','datakredit'));   
    }

    public function viewDataKlien($key=null)
    {

        $datakredit = array();

        if($key == null){
            $nsblist = klien::select('kantor','no_reg','alamat','camat','lurah','rtrw','kodepos','kodya','tgl_berdiri','no_tlp','web','fb','ig','kode_induk')->paginate(20);
        } else {
            $nsblist = klien::select('kantor','no_reg','alamat','camat','lurah','rtrw','kodepos','kodya','tgl_berdiri','no_tlp','web','fb','ig','kode_induk')->whereRaw
            ("kantor LIKE '%".strtoupper($key)."%'")->paginate(20);
        }

        return view('data.formdataklien',compact('nsblist','datakredit'));   
    }
}



