<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\klien;
use App\materi;
use App\materi_detail;
use App\sdm;
use App\peserta;
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

class LaporanController extends Controller
{
    public function formpiagam()
    {
        
        return view('laporan.piagam');   
    }

    public function formlapsdm()
    {
        // $datakredit = array();
        // $nsblist = master_kantor::select('nama','kode_kantor')->paginate(100);

        $jumlah =  "SELECT master_kantor.nama,master_kantor.kode_kantor,sdm.kantor,count(sdm.no_sdm) as total
					FROM sdm,master_kantor 
					WHERE
					sdm.kantor = master_kantor.kode_kantor and sdm.status = '1'
					GROUP BY master_kantor.nama,master_kantor.kode_kantor,sdm.kantor";
        $nsblist = DB::connection('mysql')->select(DB::raw($jumlah));  

        $totallist =  "SELECT count(no_sdm) as total FROM sdm where status = 1 ";
        $listall = DB::connection('mysql')->select(DB::raw($totallist));  

        // $mkantor = DB::connection('mysql')->table('master_kantor')->get();
       

        return view('laporan.lapdatasdm',compact('nsblist','listall'));   
    }
}
