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

class ViewController extends Controller
{

    public function formMateri()
    {
        $sdm = DB::connection('pgsql')->table('sdm')->get();
        $sdm2 = DB::connection('pgsql')->table('sdm')->first();
        $materi = DB::connection('pgsql')->table('materi')->first();
        $detail = DB::connection('pgsql')->table('materi_detail')->first();
        $detailmateri = DB::connection('pgsql')->table('materi_detail')->get();


        return view('data.formmateri',compact('sdm','materi','detail','detailmateri','sdm2'));   
    }
    public function simpanMateri(Request $request,$nonsb)
    {
        return redirect('/');
    }

    public function viewFormDetailDaftar($nonsb)
    {
        $sdm = DB::connection('pgsql')->table('sdm')->get();
        $sdm2 = DB::connection('pgsql')->table('sdm')->first();
        $materi = DB::connection('pgsql')->table('materi')->first();
        $detail = DB::connection('pgsql')->table('materi_detail')->first();
        $detailmateri = DB::connection('pgsql')->table('materi_detail')->get();


        return view('daftar.formdetaildaftar',compact('sdm','materi','detail','detailmateri','sdm2'));   
    }
    public function saveFormDetailDaftar(Request $request,$nonsb)
    {

        $peserta = new peserta;
        $peserta->opr = strtoupper($request->input('opr'));
        $peserta->tgl_input = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')));
        // $peserta->tgl = date('Y-m-d H:i:s',strtotime($request->input('')));
        $peserta->no_sdm = strtoupper($request->input('peserta[]'));
        $peserta->kode_modul = strtoupper($request->input('kode_modul'));
        $peserta->save();

        return redirect('/');
    }

    public function viewDataSdm($key=null)
    {
        // $kol=null,
        $sql3 ="SELECT mst_jabatan.jabatankantor,sdm.jabatan,mst_jabatan.kode
            from mst_jabatan,sdm 
            where 
            sdm.jabatan=mst_jabatan.kode";
        $lihat1 = DB::connection('pgsql')->select(DB::raw($sql3));  

        // $user = Auth::user();
        // $jabatan = DB::connection('pgsql')->table('mst_jabatan')->find($user->jabatan);

        // $jabatan = mst_jabatan::find($user->jabatan);
        // $kolom = $kol;
        // $kunci = strtoupper($key);

        $datakredit = array();

        if($key == null){
            $nsblist = sdm::select('no_sdm','nama','tempat_lahir','tgl_lahir','jenis_kel','ktp','alamat_tinggal','nohp','jabatan','notlp','nohp','tgl_kerja','kantor')->paginate(20);
        } else {
            $nsblist = sdm::select('no_sdm','nama','tempat_lahir','tgl_lahir','jenis_kel','ktp','alamat_tinggal','nohp','jabatan','notlp','nohp','tgl_kerja','kantor')->whereRaw
            ("nama LIKE '%".strtoupper($key)."%'OR alamat_ktp LIKE '%".strtoupper($key)."%' OR alamat_tinggal LIKE '%".strtoupper($key)."%'OR no_sdm LIKE '%".strtoupper($key)."%'")->paginate(20);
        }


        // $sql = "SELECT 'no_sdm','nama','tempat_lahir','tgl_lahir','jenis_kel','ktp','alamat_tinggal','nohp','jabatan','notlp','nohp','tgl_kerja',mst_jabatan.jabatankantor FROM sdm,mst_jabatan WHERE ";
        // if(($kolom <> null) && ($key <> null)){
        //     $sql .= $kolom." LIKE '%".$kunci."%' AND  mst_jabatan.kode=jabatan ORDER BY id";
        // } else {
        //     $sql .= " mst_jabatan.kode=jabatan ";
        // }
        // $user = DB::connection('pgsql')->select(DB::raw($sql.";"));

        // $total = count(DB::connection('pgsql')->select(DB::raw($sql.";")));
        
        // $nsblist = DB::connection('pgsql')->select(DB::raw($sql));

        // $url = url('/datasdm');

        // return view('data.formdatasdm', compact('user','pagination','lihat1'));

        return view('data.formdatasdm',compact('nsblist','datakredit','lihat1'));   
    }

    public function viewDataMateri($key=null)
    {

        $datakredit = array();

        if($key == null){
            $nsblist = materi::select('kode_modul','fasilitator','nama_modul','silabus','peserta','durasi','biaya')->paginate(20);
        } else {
            $nsblist = materi::select('kode_modul','fasilitator','nama_modul','silabus','peserta','durasi','biaya')->whereRaw
            ("kode_modul LIKE '%".strtoupper($key)."%'OR nama_modul LIKE '%".strtoupper($key)."%' ")->paginate(20);
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



