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
use App\sertifikat; 
use DB;
use Auth;
use Log;
use Input;

class PesertaController extends Controller
{
    public function NoSertif ()
    {
        $nomor = DB::connection('mysql')->select(DB::raw("SELECT substr(tgl_keg,-4) from peserta"));
        $peserta = DB::connection('mysql')->table('peserta')->orderby('kode_modul','asc')->get();
        $materi = DB::connection('mysql')->table('materi')->get();
        // $nosertif = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->where(,$nomor)->get();
        $all = array();
        foreach ($peserta as $p) {
            $sdm = sdm::select('kantor','nama','jenis_kel','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm IN ('.trim($p->no_sdm,' ').')')->get();
            for($i=0;$i<count($sdm);$i++){
                $sdm[$i]->tgl_keg = $p->tgl_keg;
                $sdm[$i]->lokasi_keg = $p->lokasi_keg;
                $sdm[$i]->kode_modul = $p->kode_modul;
                // $sdm[$i]->kantor = $p->kantor;
                // $sdm[$i]->induk_kantor = $p->induk_kantor;
                array_push($all, $sdm[$i]);
            }
        }
        $urutan = 1;
        log::info(substr($p->tgl_keg,-4));

        return view('cetak.nosertif',compact('sdm','materi','peserta','tanggal','urutan','all'));   
    }

    public function Excelcetak ()
    {
        $nomor = DB::connection('mysql')->select(DB::raw("SELECT substr(tgl_keg,-4) from peserta"));
        $peserta = DB::connection('mysql')->table('peserta')->orderby('kode_modul','asc')->get();
        // $nosertif = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->where(,$nomor)->get();
        $all = array();
        foreach ($peserta as $p) {
            $sdm = sdm::select('kantor','nama','jenis_kel','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm IN ('.trim($p->no_sdm,' ').')')->orderby('kantor','asc')->get();
            for($i=0;$i<count($sdm);$i++){
                $sdm[$i]->tgl_keg = $p->tgl_keg;
                $sdm[$i]->lokasi_keg = $p->lokasi_keg;
                $sdm[$i]->kode_modul = $p->kode_modul;
                // $sdm[$i]->kantor = $p->kantor;
                array_push($all, $sdm[$i]);
            }
        }
        $urutan = 1;
        log::info(substr($p->tgl_keg,-4));

        return view('cetak.nosertif_excel',compact('sdm','materi','peserta','tanggal','urutan','all'));   
    }

    public function CetakSertif ($nonsb)
    {
        $sdm = DB::connection('mysql')->table('sdm')->where('status','1')->orderby('jabatan','asc')->get();

        $materi = DB::connection('mysql')->table('materi')->where('kode_modul',$nonsb)->first();
         
        $peserta = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->where('kantor',trim(Auth::user()->kantor,' '))->orderby('kantor','asc')->get();

        $tanggal = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->where('kantor',trim(Auth::user()->kantor,' '))->orderby('kantor','asc')->first();

        $sertifikat = DB::connection('mysql')->table('sertifikat')->where('kode_pelatihan',$nonsb)->where('kantor',trim(Auth::user()->kantor,' '))->get();


        $all = array();
        $akk = array();
        foreach ($peserta as $p) {
            $sdm = sdm::select('kantor','nama','jenis_kel','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm IN ('.trim($p->no_sdm,' ').')')->orderby('kantor','asc')->get();
            for($i=0;$i<count($sdm);$i++){
                $sdm[$i]->tgl_keg = $p->tgl_keg;
                $sdm[$i]->lokasi_keg = $p->lokasi_keg;
                array_push($all, $sdm[$i]);

                // log::info($sdm[$i]->no_sdm);

                // $no_ser = array();
                // $sertif ="SELECT s.no_sdm, s.nama, t.no_sertif from sdm s RIGHT JOIN sertifikat t on s.no_sdm=t.no_sdm where t.tahun= '".substr($tanggal->tgl_keg,-4)."' AND t.kode_pelatihan= '".$nonsb."' AND t.kantor= '".trim(Auth::user()->kantor,' ')."' AND t.no_sdm= '".$sdm[$i]->no_sdm."' ";
                // for($i=0;$i<count($sertif);$i++){
                // $no_ser = DB::connection('mysql')->select(DB::raw($sertif)); 
                // }

                $sertif = DB::connection('mysql')->table('sertifikat')->where('tahun',substr($tanggal->tgl_keg,-4))->where('kode_pelatihan',$nonsb)->where('no_sdm',$sdm[$i]->no_sdm)->where('kantor',trim(Auth::user()->kantor,' '))->orderby('kantor','asc')->get();
                // for($i=0;$i<count($sertif);$i++)
                // $sertif[$i]->no_sertif = $p->no_sertif;
                // array_push($akk, $sertif[$i]);

                log::info($sertif);

            }
        }



        // $no_ser = DB::connection('mysql')->select(DB::raw("SELECT s.no_sdm, s.nama, t.no_sertif from sdm s RIGHT JOIN sertifikat t on s.no_sdm=t.no_sdm where t.tahun='2018' AND t.kode_pelatihan= '".$nonsb."' "));
        // @foreach ($sertif as $n) {{$n->no_sertif}} @endforeach
       

        return view('cetak.cetaksertifikat',compact('sdm','materi','peserta','all','tanggal','urutan','ser','sertif','sertifikat'));   
    }

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
        $datasdm = sdm::select('nama','jenis_kel','kantor','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm IN ('.trim($peserta->no_sdm,' ').')')->orderby('jabatan','asc')->get();
        
        
            $arr = array();
            foreach($datasdm as $data)
            {
               $arr[$data->kantor][$data->no_sdm] = $data;
            }
        }
        
        // if(isset($peserta)){
        //     $peserta = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->where('kantor',trim(Auth::user()->kantor,' '))->get();

        //     $arr = array();
        //     foreach ($peserta as $p) {

        //         $datasdm = sdm::select('nama','jenis_kel','kantor','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm IN ('.trim($p->no_sdm,' ').')')->where('status','1')->orderby('jabatan','asc')->get();
                
        //         $temp = array();
        //         foreach($datasdm as $data){
        //             $data->tgl_keg = $p->tgl_keg;
        //             $data->lokasi_keg = $p->lokasi_keg;
        //             array_push($temp, $data);
        //             //$arr= $data;
        //             $arr[$data->kantor][$data->no_sdm]= $data;
        //         }
        //         $arr[$p->nomor] = $temp;
        //         $temp = array();
        //     }
        //     Log::info(json_encode($arr));
        // }
        

        return view('daftar.formdetaildaftar',compact('sdm','materi','matdet','peserta','arr'));   
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

        // if(isset($peserta)){
        //     $peserta = DB::connection('mysql')->table('peserta')->where('kode_modul',$nonsb)->where('kantor',trim(Auth::user()->kantor,' '))->get();

        //     $arr = array();
        //     foreach ($peserta as $p) {

        //         $datasdm = sdm::select('nama','jenis_kel','kantor','jabatan','no_sdm','alamat_tinggal','notlp','nohp','induk_kantor')->whereRaw('no_sdm IN ('.trim($p->no_sdm,' ').')')->where('status','1')->orderby('jabatan','asc')->get();
                
        //         $temp = array();
        //         foreach($datasdm as $data){
        //             $data->tgl_keg = $p->tgl_keg;
        //             $data->lokasi_keg = $p->lokasi_keg;
        //             array_push($temp, $data);
        //             //$arr= $data;
        //             $arr[$data->kantor][$data->no_sdm]= $data;
        //         }
        //         $arr[$p->nomor] = $temp;
        //         $temp = array();
        //     }
        //     Log::info(json_encode($arr));
        // }

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
