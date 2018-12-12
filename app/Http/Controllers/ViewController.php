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
use Illuminate\Support\Facades\Storage;

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

    public function ViewMateriview($nonsb)
    {
        $matdet = materi_detail::where('kode_modul',$nonsb)->first();
        $kodya = DB::connection('mysql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $materi = materi::where('kode_modul',$nonsb)->first();
      
        $peserta = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->orderby('kantor','asc')->get();

        $all = array();
        foreach ($peserta as $p) {
            $sdm = sdm::select('kantor','nama','jenis_kel','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm IN ('.trim($p->no_sdm,' ').')')->orderby('kantor','asc')->get();
            for($i=0;$i<count($sdm);$i++){
                $sdm[$i]->tgl_keg = $p->tgl_keg;
                $sdm[$i]->lokasi_keg = $p->lokasi_keg;
                array_push($all, $sdm[$i]);
            }
        }

        return view('data.formmateriview',compact('matdet','materi','kodya','datasdm','peserta','all','ini'));   
    }

    public function viewCetakDaftarHadir($nonsb)
    {
        $matdet = materi_detail::where('kode_modul',$nonsb)->first();
        $sdm = DB::connection('mysql')->table('sdm')->where('status','1')->orderby('jabatan','asc')->get();
        $materi = DB::connection('mysql')->table('materi')->where('kode_modul',$nonsb)->first();
        // $mkantor = DB::connection('mysql')->table('master_kantor')->get();
        // $peserta = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->where('kantor',trim(Auth::user()->kantor,' '))->first();

        // if(isset($peserta)){
        // $datasdm = sdm::select('nama','jenis_kel','kantor','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm IN ('.trim($peserta->no_sdm,' ').')')->where('status','1')->orderby('jabatan','asc')->get();
        // }

        // $peserta = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->get();
        // $all = array();
        // foreach ($peserta as $p) {
        //     $sdm = sdm::select('kantor','nama','jenis_kel','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm IN ('.trim($p->no_sdm,' ').')')->where('status','1')->orderby('kantor','asc')->get();
        //     for($i=0;$i<count($sdm);$i++){
        //         array_push($all, $sdm[$i]);
        //     }
        // }
         
        $peserta = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->orderby('kantor','asc')->get();

        $all = array();
        foreach ($peserta as $p) {
            $sdm = sdm::select('kantor','nama','jenis_kel','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm IN ('.trim($p->no_sdm,' ').')')->where('status','1')->orderby('kantor','asc')->get();
            for($i=0;$i<count($sdm);$i++){
                $sdm[$i]->tgl_keg = $p->tgl_keg;
                $sdm[$i]->lokasi_keg = $p->lokasi_keg;
                array_push($all, $sdm[$i]);
            }
        }

        return view('cetak.formdaftarhadir',compact('sdm','materi','matdet','peserta','datasdm','all','lihat1'));   
    }

    public function viewCetakDaftarHadirExcel($nonsb)
    {
        $matdet = materi_detail::where('kode_modul',$nonsb)->first();
        $sdm = DB::connection('mysql')->table('sdm')->where('status','1')->orderby('jabatan','asc')->get();
        $materi = DB::connection('mysql')->table('materi')->where('kode_modul',$nonsb)->first();
       

        // $peserta = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->get();
        // $all = array();
        // foreach ($peserta as $p) {
        //     $sdm = sdm::select('kantor','nama','jenis_kel','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm IN ('.trim($p->no_sdm,' ').')')->where('status','1')->orderby('kantor','asc')->get();
        //     for($i=0;$i<count($sdm);$i++){
        //         array_push($all, $sdm[$i]);
        //     }
        // }
           
        $peserta = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->orderby('kantor','asc')->get();

        $all = array();
        foreach ($peserta as $p) {
            $sdm = sdm::select('kantor','nama','jenis_kel','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm IN ('.trim($p->no_sdm,' ').')')->where('status','1')->orderby('kantor','asc')->get();
            for($i=0;$i<count($sdm);$i++){
                $sdm[$i]->tgl_keg = $p->tgl_keg;
                $sdm[$i]->lokasi_keg = $p->lokasi_keg;
                array_push($all, $sdm[$i]);
            }
        }
        

        return view('cetak.formdaftarhadir2',compact('sdm','materi','matdet','peserta','datasdm','all','lihat1'));   
    }
}





