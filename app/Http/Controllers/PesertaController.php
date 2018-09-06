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
        $matdet = materi_detail::where('kode_modul',$nonsb)->first();
        $sdm = DB::connection('mysql')->table('sdm')->where('status','1')->orderby('kantor','asc')->get();
        $materi = DB::connection('mysql')->table('materi')->where('kode_modul',$nonsb)->first();
        $peserta = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->where('kantor',trim(Auth::user()->kantor,' '))->first();

        if(isset($peserta)){
        $datasdm = sdm::select('nama','jenis_kel','kantor','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm IN ('.trim($peserta->no_sdm,' ').')')->where('status','1')->orderby('jabatan','asc')->get();
        
        
            $arr = array();
            foreach($datasdm as $data)
            {
               $arr[$data->kantor][$data->no_sdm] = $data;
            }
        }


        return view('daftar.formdetaildaftar',compact('sdm','materi','matdet','peserta','datasdm','arr'));   
    }
    public function saveFormDetailDaftar(Request $request,$nonsb)
    {
        $peserta = peserta::where('kode_modul',$nonsb)->get();
        $check = $request->input('peserta');
       
        $noakhir = peserta::max('nomor');
        $no = (int) $noakhir + 1;
       
            $check = $request->input('peserta');
            $peserta = new peserta;
            $peserta->nomor = str_pad($no, 6, '0',STR_PAD_LEFT);
            $peserta->opr = strtoupper($request->input('opr'));
            $peserta->tgl_input = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')));
            $peserta->no_sdm = implode(',', $check);
            $peserta->kode_modul = strtoupper($request->input('kode_modul'));
            $peserta->lokasi_keg = strtoupper($request->input('lokasi_keg'));
            $peserta->tgl_keg = strtoupper($request->input('tanggal_keg'));
            $peserta->kantor = strtoupper($request->input('kantor'));
            $peserta->save();

        // DB::connection('mysql')->table('peserta')->where('no_sdm',$request->input('peserta'))->update([
        //     // $check = $request->input('peserta');
        //    'nomor'      => ($request->input('nomor') ),
        //    'opr'        => (strtoupper($request->input('opr'))),
        //    'tgl_input'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')))),
        //    'no_sdm'     => (implode(',', $request->input('peserta'))),
        //    'kode_modul' => (strtoupper($request->input('kode_modul'))),
        //    'lokasi_keg' => (strtoupper($request->input('lokasi_keg'))),
        //    'tgl_keg'    => (strtoupper($request->input('tanggal_keg'))),
        //    'kantor'     => (strtoupper($request->input('kantor')))
        // ]);

        


        return redirect('/detaildaftar/'.$peserta->kode_modul);
    }

    public function viewFormDetailTidakHadir($nonsb)
    {
        $sdm = DB::connection('mysql')->table('sdm')->where('status','1')->orderby('jabatan','asc')->get();
        $materi = DB::connection('mysql')->table('materi')->where('kode_modul',$nonsb)->first();
        $peserta = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->where('kantor',trim(Auth::user()->kantor,' '))->first();

        if(isset($peserta)){
        $datasdm = sdm::select('nama','jenis_kel','kantor','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm NOT IN ('.trim($peserta->no_sdm,' ').')')->where('status','1')->orderby('jabatan','asc')->get();
        }

        return view('daftar.formdetailtidakhadir',compact('sdm','materi','sdm2','peserta','datasdm'));   
    }

    public function saveFormDetailTidakHadir(Request $request,$nonsb)
    {
        
        return redirect('/pendaftaran');
    }
    
    public function viewCetakDaftar($nonsb,$kantor)
    {
        $matdet = materi_detail::where('kode_modul',$nonsb)->first();
        $sdm = DB::connection('mysql')->table('sdm')->where('status','1')->orderby('jabatan','asc')->get();
        $materi = DB::connection('mysql')->table('materi')->where('kode_modul',$nonsb)->first();
        $peserta = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->where('kantor',trim(Auth::user()->kantor,' '))->first();

        if(isset($peserta)){
        $datasdm = sdm::select('nama','jenis_kel','kantor','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm IN ('.trim($peserta->no_sdm,' ').')')->where('status','1')->where('kantor',$kantor)->orderby('jabatan','asc')->get();
        }

        $arr = array();
        foreach($datasdm as $data)
        {
           $arr[$data->kantor][$data->no_sdm] = $data;
        }

        $sql1 ="SELECT master_kantor.nama,master_kantor.kode_kantor from master_kantor
            where master_kantor.kode_kantor='".$kantor."'";
        $lihat1 = DB::connection('mysql')->select(DB::raw($sql1));  

        return view('daftar.formcetak',compact('sdm','materi','matdet','peserta','datasdm','lihat1','arr'));   
    }

    public function ViewMateridownload($nonsb)
    {
        $matdet = materi_detail::where('kode_modul',$nonsb)->first();
        $kodya = DB::connection('mysql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $materi = materi::where('kode_modul',$nonsb)->first();

        return view('peserta.formmateridownload',compact('matdet','materi','kodya'));   
    }

}
