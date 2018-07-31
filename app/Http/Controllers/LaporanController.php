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
        
        return view('laporan.lapdatasdm');   
    }
}
