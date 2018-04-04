<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\klien;
use App\materi;
use App\sdm;
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
    public function viewDataSdm($key=null)
    {
        $sql3 ="SELECT mst_jabatan.jabatankantor,sdm.jabatan,mst_jabatan.kode
            from mst_jabatan,sdm 
            where 
            sdm.jabatan=mst_jabatan.kode";
        $lihat1 = DB::connection('pgsql')->select(DB::raw($sql3));  

        $datakredit = array();

        if($key == null){
            $nsblist = sdm::select('no_sdm','nama','tempat_lahir','tgl_lahir','jenis_kel','ktp','alamat_tinggal','nohp','jabatan','notlp','nohp','tgl_kerja')->paginate(20);
        } else {
            $nsblist = sdm::select('no_sdm','nama','tempat_lahir','tgl_lahir','jenis_kel','ktp','alamat_tinggal','nohp','jabatan','notlp','nohp','tgl_kerja')->whereRaw
            ("nama LIKE '%".strtoupper($key)."%'OR alamat_ktp LIKE '%".strtoupper($key)."%' OR alamat_tinggal LIKE '%".strtoupper($key)."%'OR no_sdm LIKE '%".strtoupper($key)."%'")->paginate(20);
        }

        // foreach ($nsblist as $list) {
        //     $datakredit[$list->no_nsb] = kredit::select('no_kredit','no_ref','sistem','lama','plafon','bbt','pinj_pokok','bakidebet','tgl_mulai','tgl_lunas')->whereRaw("no_mohon IN (SELECT no_mohon FROM prekredit WHERE no_nsb = '".$list->no_nsb."')")->get();
        // }  

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



