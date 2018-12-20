<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Auth;
use Log;
use App\UserRbb;
use App\ABCJabatan;
use App\ABCKantor;
use App\master_kantor;
use App\real_header;
use App\real_0201;
use App\real_0301;
use App\real_0401;
use Hash;
use Validator;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use Excel;
use File;

class RealController extends Controller
{
    public function viewImportReal()
    {
        $periode = DB::connection('mysql')->table('real_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();
        $ljk = DB::connection('mysql')->table('rbb_kodeljk')->where('no_kantor',Auth::user()->kantor)->first();

        return view('rbb_realisasi/import_real',compact('periode','ljk'));   
    }

    public function viewEksportReal()
    {
       $kantor = DB::connection('mysql')->table('rbb_kodeljk')->where('no_kantor',Auth::user()->kantor)->first();
       $periode = DB::connection('mysql')->table('real_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();
       return view('rbb_realisasi/export_real',compact('kantor','periode'));   
    }

    public function view0201R()
    {
        $periode = DB::connection('mysql')->table('real_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbbA = DB::connection('mysql')->table('real_0201')->where('no_kantor',Auth::user()->kantor)->OrderBy('id','asc')->get();
        return view('rbb_realisasi/0201',compact('rbbA','periode')); 
    }

    public function view0201Rtanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('real_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbbA = DB::connection('mysql')->table('real_0201')->where('no_kantor',Auth::user()->kantor)->OrderBy('id','asc')->where('periode',$tanggal)->get();
        return view('rbb_realisasi/0201',compact('rbbA','periode'));   
    }

    public function view0301R()
    {
        $periode = DB::connection('mysql')->table('real_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbbB = DB::connection('mysql')->table('real_0301')->where('no_kantor',Auth::user()->kantor)->OrderBy('id','asc')->get();
        return view('rbb_realisasi/0301',compact('rbbB','periode')); 
    }

    public function view0301Rtanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('real_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbbB = DB::connection('mysql')->table('real_0301')->where('no_kantor',Auth::user()->kantor)->OrderBy('id','asc')->where('periode',$tanggal)->get();
        return view('rbb_realisasi/0301',compact('rbbB','periode'));   
    }

    public function view0401R()
    {
        $periode = DB::connection('mysql')->table('real_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbbC = DB::connection('mysql')->table('real_0401')->where('no_kantor',Auth::user()->kantor)->OrderBy('id','asc')->get();
        return view('rbb_realisasi/0401',compact('rbbC','periode')); 
    }

    public function view0401Rtanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('real_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbbC = DB::connection('mysql')->table('real_0401')->where('no_kantor',Auth::user()->kantor)->OrderBy('id','asc')->where('periode',$tanggal)->get();
        return view('rbb_realisasi/0401',compact('rbbC','periode'));   
    }
}
