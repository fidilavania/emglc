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

    public function viewFormDetailDaftar($nonsb)
    {
        // $prekredit = Prekredit::where('no_kredit',$nokredit)->first();
        $sdm = DB::connection('mysql')->table('sdm')->get();
        $materi = DB::connection('mysql')->table('materi')->where('kode_modul',$nonsb)->first();
        $detail = DB::connection('mysql')->table('materi_detail')->first();
        $detailmateri = DB::connection('mysql')->table('materi_detail')->get();
        $peserta = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->first();

        if(isset($peserta)){
        $datasdm = sdm::select('nama','jenis_kel','kantor','jabatan','no_sdm','alamat_tinggal','notlp','nohp')->whereRaw('no_sdm IN ('.trim($peserta->no_sdm,' ').')')->get();
        }

        //Log::info($datasdm);


        return view('daftar.formdetaildaftar',compact('sdm','materi','detail','detailmateri','peserta','datasdm'));   
    }
    public function saveFormDetailDaftar(Request $request,$nonsb)
    {
        $peserta = peserta::where('kode_modul',$nonsb)->get();
        $check = $request->input('peserta');
       

        
           //  DB::connection('mysql')->table('peserta')->where('kode_modul',$request->input('kode_modul'))->update([
           //      'opr'           => (strtoupper($request->input('opr'))),
           //      'tgl_input'     => (date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')))),
           //      'no_sdm'        => (implode(',', $check)),
           //      'kode_modul'    => (strtoupper($request->input('kode_modul')))
           // ]);

        // if(empty($peserta->no_sdm)){ 
            $check = $request->input('peserta');
            $peserta = new peserta;
            $peserta->opr = strtoupper($request->input('opr'));
            $peserta->tgl_input = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')));
            $peserta->no_sdm = implode(',', $check);
            $peserta->kode_modul = strtoupper($request->input('kode_modul'));
            $peserta->save();
        // }

        


        return redirect('/pendaftaran');
    }

    public function viewFormDetailTidakHadir($nonsb)
    {
        $sdm = DB::connection('mysql')->table('sdm')->get();
        $materi = DB::connection('mysql')->table('materi')->where('kode_modul',$nonsb)->first();
        $detail = DB::connection('mysql')->table('materi_detail')->first();
        $detailmateri = DB::connection('mysql')->table('materi_detail')->get();
        $peserta = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->first();

        if(isset($peserta)){
        $datasdm = sdm::select('nama','jenis_kel','kantor','jabatan','no_sdm','alamat_tinggal','notlp','nohp')->whereRaw('no_sdm NOT IN ('.trim($peserta->no_sdm,' ').')')->get();
        }

        return view('daftar.formdetailtidakhadir',compact('sdm','materi','detail','detailmateri','sdm2','peserta','datasdm'));   
    }

    public function saveFormDetailTidakHadir(Request $request,$nonsb)
    {
        
        return redirect('/pendaftaran');
    }
    
}
