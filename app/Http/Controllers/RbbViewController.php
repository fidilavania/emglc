<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Log;
use App\UserRbb;
use App\ABCJabatan;
use App\ABCKantor;
use App\master_kantor;
use App\LKH;
use Hash;
use Validator;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use Excel;
use File;
use App\rbb_header;
use App\rbb_0102;
use App\rbb_0301;
use App\rbb_0401;
use App\rbb_0501;
use App\rbb_0601;
use App\rbb_0701;
use App\rbb_0801;
use App\rbb_0802;
use App\rbb_0803;
use App\rbb_0804;
use App\rbb_0805;
use App\rbb_0806;
use App\rbb_0807;
use App\rbb_0901;
use App\rbb_0902;
use App\rbb_0903;
use App\rbb_0102_f;
use App\rbb_0301_f;
use App\rbb_0401_f;
use App\rbb_0501_f;
use App\rbb_0601_f;
use App\rbb_0701_f;
use App\rbb_0801_f;
use App\rbb_0802_f;
use App\rbb_0803_f;
use App\rbb_0804_f;
use App\rbb_0805_f;
use App\rbb_0806_f;
use App\rbb_0807_f;
use App\rbb_0901_f;
use App\rbb_0902_f;
use App\rbb_0903_f;
use Response;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Zipper;

class RbbViewController extends Controller
{  
    public function view0102()
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbbA = DB::connection('mysql')->table('rbb_0102')->where('no_kantor',Auth::user()->kantor)->OrderBy('id','asc')->where('periode','2018-12-31')->get();
        return view('rbb/0102',compact('rbbA','periode'));   
    }

    public function view0102tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();


        $rbbA = DB::connection('mysql')->table('rbb_0102')->where('no_kantor',Auth::user()->kantor)->OrderBy('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0102',compact('rbbA','periode'));   
    }

    public function view0301()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0301')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode','2018-12-31')->get();
       return view('rbb/0301',compact('rbb','periode'));   
    }

    public function view0301tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0301')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0301',compact('rbb','periode'));   
    }

    public function view0401()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0401')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode','2018-12-31')->get();
       return view('rbb/0401',compact('rbb','periode'));   
    }
    public function view0401tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0401')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0401',compact('rbb','periode'));   
    }

    public function view0501()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0501')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode','2018-12-31')->get();
       return view('rbb/0501',compact('rbb','periode'));   
    }
    public function view0501tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0501')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0501',compact('rbb','periode'));   
    }

    public function view0601()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0601')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode','2018-12-31')->get();
       return view('rbb/0601',compact('rbb','periode'));   
    }
    public function view0601tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0601')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0601',compact('rbb','periode'));   
    }

    public function view0701()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0701')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode','2018-12-31')->get();
       return view('rbb/0701',compact('rbb','periode'));   
    }
    public function view0701tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0701')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0701',compact('rbb','periode'));   
    }

    public function view0801()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0801')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode','2018-12-31')->get();
       return view('rbb/0801',compact('rbb','periode'));   
    }
    public function view0801tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0801')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0801',compact('rbb','periode'));   
    }

    public function view0802()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0802')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode','2018-12-31')->get();
       return view('rbb/0802',compact('rbb','periode'));   
    }
    public function view0802tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0802')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0802',compact('rbb','periode'));   
    }

    public function view0803()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0803')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode','2018-12-31')->get();
       return view('rbb/0803',compact('rbb','periode'));   
    }
    public function view0803tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0803')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0803',compact('rbb','periode'));   
    }

    public function view0804()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0804')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode','2018-12-31')->get();
       return view('rbb/0804',compact('rbb','periode'));   
    }
    public function view0804tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0804')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0804',compact('rbb','periode'));   
    }

    public function view0805()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0805')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode','2018-12-31')->get();
       return view('rbb/0805',compact('rbb','periode'));   
    }
    public function view0805tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0805')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0805',compact('rbb','periode'));   
    }

    public function view0806()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0806')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode','2018-12-31')->get();
       return view('rbb/0806',compact('rbb','periode'));   
    }
    public function view0806tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0806')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0806',compact('rbb','periode'));   
    }

    public function view0807()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0807')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode','2018-12-31')->get();
       return view('rbb/0807',compact('rbb','periode'));   
    }
    public function view0807tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0807')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0807',compact('rbb','periode'));   
    }

    public function view0901()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0901')->where('no_kantor',Auth::user()->kantor)->OrderBy('id','ASC')->where('periode','2018-12-31')->get();
       return view('rbb/0901',compact('rbb','periode'));   
    }
    public function view0901tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0901')->where('no_kantor',Auth::user()->kantor)->OrderBy('id','ASC')->where('periode',$tanggal)->get();
        return view('rbb/0901',compact('rbb','periode'));   
    }

    public function view0902()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0902')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode','2018-12-31')->get();
       return view('rbb/0902',compact('rbb','periode'));   
    }
    public function view0902tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0902')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0902',compact('rbb','periode'));   
    }

    public function view0903()
    {
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

       $rbb = DB::connection('mysql')->table('rbb_0903')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode','2018-12-31')->get();
       return view('rbb/0903',compact('rbb','periode'));   
    }
    public function view0903tanggal($tanggal)
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();

        $rbb = DB::connection('mysql')->table('rbb_0903')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->where('periode',$tanggal)->get();
        return view('rbb/0903',compact('rbb','periode'));   
    }

    public function viewEksport()
    {
       $kantor = DB::connection('mysql')->table('rbb_kodeljk')->where('no_kantor',Auth::user()->kantor)->first();
       $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();
       return view('rbb/export',compact('kantor','periode'));   
    }

    public function getDownload(Request $request) 
    {
        // prepare content
      $rbb0102 = DB::connection('mysql')->select(DB::raw("SELECT id,basic,row,flag,komponen,indikator,kinerja_okt_pembilang,kinerja_okt_penyebut,kinerja_persen,proyeksi_des_pembilang,proyeksi_des_penyebut,proyeksi_des_persen,proyeksi_jun_pembilang,proyeksi_jun_penyebut,proyeksi_jun_persen,proyeksi_des_pembilang_1,proyeksi_des_penyebut_1,proyeksi_des_persen_1,proyeksi_des_pembilang_2,proyeksi_des_penyebut_2,proyeksi_des_persen_2,proyeksi_des_pembilang_3,proyeksi_des_penyebut_3,proyeksi_des_persen_3,opr, tgl_input, created_at, updated_at FROM rbb_0102 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));
      $rbb0301 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, pos, kinerja_okt, pro_des, pro_juni, pro_des1, pro_des2, pro_des3, opr, tgl_input, created_at, updated_at FROM rbb_0301 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0401 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, pos, kinerja_okt, pro_des, pro_juni, pro_des1, pro_des2, pro_des3, opr, tgl_input, created_at, updated_at FROM rbb_0401 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));

      $rbb0501 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, rasio, kinerja_okt_pembilang, kinerja_okt_penyebut, kinerja_persen, proyeksi_des_pembilang, proyeksi_des_penyebut, proyeksi_des_persen, proyeksi_jun_pembilang, proyeksi_jun_penyebut, proyeksi_jun_persen, proyeksi_des_pembilang_1, proyeksi_des_penyebut_1, proyeksi_des_persen_1, proyeksi_des_pembilang_2, proyeksi_des_penyebut_2, proyeksi_des_persen_2, proyeksi_des_pembilang_3, proyeksi_des_penyebut_3, proyeksi_des_persen_3, opr, tgl_input, created_at, updated_at FROM rbb_0501 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));

      $rbb0601 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, kel, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0601 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));

      $rbb0701 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, kode_ref, jenis, nama, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0701 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0801 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, kode_ref, jenis, jumlah, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0801 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0802 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, jenis, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0802 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0803 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, sandi_bank, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0803 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0804 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, jenis, jumlah, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0804 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));

      $rbb0805 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, kode_sektor, sektor, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0805 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0806 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, jenis, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0806 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'   "));

      $rbb0807 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, jenis, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0807 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0901 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, modal, kinerja_okt, pro_des, pro_juni, pro_des1, pro_des2, opr, tgl_input, created_at, updated_at FROM rbb_0901 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0902 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, ket, kinerja_okt, pro_des, pro_juni, pro_des1, pro_des2, pro_des3, pro_des4, pro_des5, opr, tgl_input, created_at, updated_at FROM rbb_0902 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));

      $rbb0903 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, ket_bisnis, nama, kinerja_okt, pro_des, pro_juni, pro_des1, pro_des2, pro_des3, opr, tgl_input, created_at, updated_at FROM rbb_0903 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' AND nama != '0' "));
      
      $arr = array(0,0,0,0,0,0,0,0);
      $content = "";
      $data0102 = '';
      foreach($rbb0102 as $key=>$rbb){
          $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
          // $rbb_f = rbb_0102_f::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
          $arr[0] = $rbb->flag;
          $arr[1] = $rbb->komponen;
          $arr[2] = $rbb->kinerja_okt_pembilang;
          $arr[3] = $rbb->kinerja_okt_penyebut;
          $arr[4] = number_format($rbb->kinerja_persen, 2, '.', '');
          $arr[5] = $rbb->proyeksi_des_pembilang;
          $arr[6] = $rbb->proyeksi_des_penyebut;
          $arr[7] = number_format($rbb->proyeksi_des_persen, 2, '.', '');
          $arr[8] = $rbb->proyeksi_jun_pembilang;
          $arr[9] = $rbb->proyeksi_jun_penyebut;
          $arr[10] =number_format($rbb->proyeksi_jun_persen, 2, '.', ''); 
          $arr[11] = $rbb->proyeksi_des_pembilang_1; 
          $arr[12] = $rbb->proyeksi_des_penyebut_1;
          $arr[13] = number_format($rbb->proyeksi_des_persen_1, 2, '.', '');
          $arr[14] = $rbb->proyeksi_des_pembilang_2; 
          $arr[15] = $rbb->proyeksi_des_penyebut_2;
          $arr[16] = number_format($rbb->proyeksi_des_persen_2, 2, '.', '');
          $arr[17] = $rbb->proyeksi_des_pembilang_3; 
          $arr[18] = $rbb->proyeksi_des_penyebut_3;
          $arr[19] = number_format($rbb->proyeksi_des_persen_3, 2, '.', '');
          $f01 = 'F01|dijelaskan di narasi';
          $f02 = 'F02|';
          $h1 = $header->flag;
          $h2 = $header->kode_sektor;
          $h3 = $header->kode_ljk;
          $h4 = $header->kode_jenis;
          $h5 = $header->modal_inti;
          $h6 = $header->ref_surat;
          if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
            $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

          $head0102 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0102|'.$h5.'|'.$h6."\r\n";
          if($h5 < 50000000){
            $data0102 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8].'|'.$arr[9].'|'.$arr[10].'|'.$arr[11].'|'.$arr[12].'|'.$arr[13].'|'.'|'.'|'.'|'.'|'.'|'."\r\n";
          }else{
            $data0102 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8].'|'.$arr[9].'|'.$arr[10].'|'.$arr[11].'|'.$arr[12].'|'.$arr[13].'|'.$arr[14].'|'.$arr[15].'|'.$arr[16].'|'.$arr[17].'|'.$arr[18].'|'.$arr[19]."\r\n";
          }
           
            $data2_0102 = $f01."\r\n".$f02;
            $data_0102 = $head0102.$data0102.$data2_0102;
            
        }
          $content .= $data_0102;
          $content .= "\n";

          $file0102 = 'RBBPRK-0102-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';

            $expor0102 = array($file0102);
            $destinationPath0102=public_path('RencanaBisnis');
            if (!is_dir($destinationPath0102)) {  mkdir($destinationPath0102,0777,true);  } 
            //rubaj
            File::put($destinationPath0102.'/'.$file0102,$content);

     $arr = array(0,0,0,0,0,0,0,0);
     $content = "";
     $data0301 = '';
     foreach($rbb0301 as $key=>$rbb){
        $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
        $arr[0] = $rbb->flag;
        $arr[1] = $rbb->komponen;
        $arr[2] = $rbb->pos;
        $arr[3] = $rbb->kinerja_okt;
        $arr[4] = $rbb->pro_des;
        $arr[5] = $rbb->pro_juni;
        $arr[6] = $rbb->pro_des1;
        $arr[7] = $rbb->pro_des2;
        $arr[8] = $rbb->pro_des3;
        $f01 = 'F01|dijelaskan di narasi';
        $f02 = 'F02|';
        $h1 = $header->flag;
        $h2 = $header->kode_sektor;
        $h3 = $header->kode_ljk;
        $h4 = $header->kode_jenis;
        $h5 = $header->modal_inti;
        $h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
            $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

        $head0301 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0301|'.$h5.'|'.$h6."\r\n";
        if($h5 < 50000000){
          $data0301 .= $arr[0].'|'.$arr[1].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.'|'."\r\n";
        }else{
          $data0301 .= $arr[0].'|'.$arr[1].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8]."\r\n";
        }
          $data2_0301 = $f01."\r\n".$f02;
          $data_0301 = $head0301.$data0301.$data2_0301;
          //sampai sini aja

      } 
          //tambah ini
          $content .= $data_0301;
          $content .= "\n";


          $file0301 = 'RBBPRK-0301-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          $expor0301 = array($file0301);
          //rubah disni
          $destinationPath0301=public_path('RencanaBisnis');

          if (!is_dir($destinationPath0301)) {  mkdir($destinationPath0301,0777,true);  } 
          //rubah disni
          File::put($destinationPath0301.'/'.$file0301,$content);        
          // end

      $arr = array(0,0,0,0,0,0,0,0);
      $content = "";
      $data0401 = '';
    foreach($rbb0401 as $key=>$rbb){
        $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
        $arr[0] = $rbb->flag;
        $arr[1] = $rbb->komponen;
        $arr[2] = $rbb->kinerja_okt;
        $arr[3] = $rbb->pro_des;
        $arr[4] = $rbb->pro_juni;
        $arr[5] = $rbb->pro_des1;
        $arr[6] = $rbb->pro_des2;
        $arr[7] = $rbb->pro_des3;
        $f01 = 'F01|dijelaskan di narasi';
        $f02 = 'F02|';
        $h1 = $header->flag;
        $h2 = $header->kode_sektor;
        $h3 = $header->kode_ljk;
        $h4 = $header->kode_jenis;
        $h5 = $header->modal_inti;
        $h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

        $head0401 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0401|'.$h5.'|'.$h6."\r\n";
        if($h5 < 50000000){
          $data0401 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.'|'."\r\n";
        }else{
          $data0401 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7]."\r\n";
        }
          $data2_0401 = $f01."\r\n".$f02;
          $data_0401 = $head0401.$data0401.$data2_0401;
    }

          $content .= $data_0401;
          $content .= "\n";

          $file0401 = 'RBBPRK-0401-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          $expor0401 = array($file0401);
          $destinationPath0401=public_path('RencanaBisnis');
          if (!is_dir($destinationPath0401)) {  mkdir($destinationPath0401,0777,true);  } 
          File::put($destinationPath0401.'/'.$file0401,$content);

      $arr = array(0,0,0,0,0,0,0,0);
      $content = "";
      $data0501 = '';
    foreach($rbb0501 as $key=>$rbb){
        $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
        $arr[0] = $rbb->flag;
        $arr[1] = $rbb->komponen;
        $arr[2] = $rbb->kinerja_okt_pembilang;
        $arr[3] = $rbb->kinerja_okt_penyebut;
        $arr[4] = number_format($rbb->kinerja_persen, 2, '.', '');
        $arr[5] = $rbb->proyeksi_des_pembilang;
        $arr[6] = $rbb->proyeksi_des_penyebut;
        $arr[7] = number_format($rbb->proyeksi_des_persen, 2, '.', '');
        $arr[8] = $rbb->proyeksi_jun_pembilang;
        $arr[9] = $rbb->proyeksi_jun_penyebut;
        $arr[10] = number_format($rbb->proyeksi_jun_persen, 2, '.', '');
        $arr[11] = $rbb->proyeksi_des_pembilang_1;
        $arr[12] = $rbb->proyeksi_des_penyebut_1;
        $arr[13] = number_format($rbb->proyeksi_des_persen_1, 2, '.', '');
        $arr[14] = $rbb->proyeksi_des_pembilang_2;
        $arr[15] = $rbb->proyeksi_des_penyebut_2;
        $arr[16] = number_format($rbb->proyeksi_des_persen_2, 2, '.', '');
        $arr[17] = $rbb->proyeksi_des_pembilang_3;
        $arr[18] = $rbb->proyeksi_des_penyebut_3;
        $arr[19] = number_format($rbb->proyeksi_des_persen_3, 2, '.', '');
        $f01 = 'F01|dijelaskan di narasi';
        $f02 = 'F02|';
        $h1 = $header->flag;
        $h2 = $header->kode_sektor;
        $h3 = $header->kode_ljk;
        $h4 = $header->kode_jenis;
        $h5 = $header->modal_inti;
        $h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
            $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

        $head0501 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0501|'.$h5.'|'.$h6."\r\n";
        if($h5 < 50000000){
          $data0501 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8].'|'.$arr[9].'|'.$arr[10].'|'.$arr[11].'|'.$arr[12].'|'.$arr[13].'|'.'|'.'|'.'|'.'|'.'|'."\r\n";
        }else{
          $data0501 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8].'|'.$arr[9].'|'.$arr[10].'|'.$arr[11].'|'.$arr[12].'|'.$arr[13].'|'.$arr[14].'|'.$arr[15].'|'.$arr[16].'|'.$arr[17].'|'.$arr[18].'|'.$arr[19]."\r\n";
        }
          $data2_0501 = $f01."\r\n".$f02;
          $data_0501 = $head0501.$data0501.$data2_0501;
    } 
          $content .= $data_0501;
          $content .= "\n";

          $file0501 = 'RBBPRK-0501-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          $expor0501 = array($file0501);
          $destinationPath0501=public_path('RencanaBisnis');
          if (!is_dir($destinationPath0501)) {  mkdir($destinationPath0501,0777,true);  } 
          File::put($destinationPath0501.'/'.$file0501,$content);

    $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
    $data0601 = '';
    foreach($rbb0601 as $key=>$rbb){
          $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
          $arr[0] = $rbb->flag;
          $arr[1] = $rbb->komponen;
          if($arr[1] == '05050000000000'){
          $arr[2] = number_format($rbb->kinerja_okt, 2, '.', '');
          $arr[3] = number_format($rbb->pro_des, 2, '.', '');
          $arr[4] = number_format($rbb->pro_juni, 2, '.', '');
          $arr[5] = number_format($rbb->pro_des1, 2, '.', '');
          } elseif ($arr[1] == '05060000000000') {
            $arr[2] = number_format($rbb->kinerja_okt, 2, '.', '');
            $arr[3] = number_format($rbb->pro_des, 2, '.', '');
            $arr[4] = number_format($rbb->pro_juni, 2, '.', '');
            $arr[5] = number_format($rbb->pro_des1, 2, '.', '');
          } else{
          $arr[2] = $rbb->kinerja_okt;
          $arr[3] = $rbb->pro_des;
          $arr[4] = $rbb->pro_juni;
          $arr[5] = $rbb->pro_des1;
          }
          $f01 = 'F01|dijelaskan di narasi';
          $f02 = 'F02|dijelaskan di narasi';
          $h1 = $header->flag;
          $h2 = $header->kode_sektor;
          $h3 = $header->kode_ljk;
          $h4 = $header->kode_jenis;
          $h5 = $header->modal_inti;
          $h6 = $header->ref_surat;
          if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
                $h6 = '';
            }else{
              $h6 = $header->ref_surat;
            }

          $head0601 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0601|'.$h5.'|'.$h6."\r\n";
          $data0601 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5]."\r\n";
          $data2_0601 = $f01."\r\n".$f02;
          $data_0601 = $head0601.$data0601.$data2_0601;
    }   
          $content .= $data_0601;
          $content .= "\n";

          $file0601 = 'RBBPRK-0601-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          $expor0601 = array($file0601);
          $destinationPath0601=public_path('RencanaBisnis');
          if (!is_dir($destinationPath0601)) {  mkdir($destinationPath0601,0777,true);  } 
          File::put($destinationPath0601.'/'.$file0601,$content);


    $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
    $data0701 = '';
    foreach($rbb0701 as $key=>$rbb){
        $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
        $arr[0] = $rbb->flag;
        $arr[1] = $rbb->komponen;
        $arr[2] = $rbb->kode_ref;
        $arr[3] = $rbb->nama;
        $arr[4] = $rbb->kinerja_okt;
        $arr[5] = $rbb->pro_des;
        $arr[6] = $rbb->pro_juni;
        $arr[7] = $rbb->pro_des1;
        $f01 = 'F01|dijelaskan di narasi';
        $f02 = 'F02|dijelaskan di narasi';
        $h1 = $header->flag;
        $h2 = $header->kode_sektor;
        $h3 = $header->kode_ljk;
        $h4 = $header->kode_jenis;
        $h5 = $header->modal_inti;
        $h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

        $head0701 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0701|'.$h5.'|'.$h6."\r\n";
        $data0701 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7]."\r\n";

        $data2_0701 = $f01."\r\n".$f02;
        $data_0701 = $head0701.$data0701.$data2_0701;
    }

          $content .= $data_0701;
          $content .= "\n";

          $file0701 = 'RBBPRK-0701-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          $expor0701 = array($file0701);
          $destinationPath0701=public_path('RencanaBisnis');
          if (!is_dir($destinationPath0701)) {  mkdir($destinationPath0701,0777,true);  } 
          File::put($destinationPath0701.'/'.$file0701,$content);

    $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
    $data0801 = '';
    foreach($rbb0801 as $key=>$rbb){
        $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
        $arr[0] = $rbb->flag;
        $arr[1] = $rbb->komponen;
        $arr[2] = $rbb->kode_ref;
        $arr[3] = $rbb->jumlah;
        if($arr[1] == 7040000000000){
          $arr[4] = number_format($rbb->kinerja_okt, 2, '.', '');
          $arr[5] = number_format($rbb->pro_des, 2, '.', '');
          $arr[6] = number_format($rbb->pro_juni, 2, '.', '');
          $arr[7] = number_format($rbb->pro_des1, 2, '.', '');
        }else{
          $arr[4] = $rbb->kinerja_okt;
          $arr[5] = $rbb->pro_des;
          $arr[6] = $rbb->pro_juni;
          $arr[7] = $rbb->pro_des1;
        }
        
        $f01 = 'F01|dijelaskan di narasi';
        $f02 = 'F02|dijelaskan di narasi';
        $h1 = $header->flag;
        $h2 = $header->kode_sektor;
        $h3 = $header->kode_ljk;
        $h4 = $header->kode_jenis;
        $h5 = $header->modal_inti;
        $h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

        $head0801 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0801|'.$h5.'|'.$h6."\r\n";
        $data0801 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7]."\r\n";

        $data2_0801 = $f01."\r\n".$f02;
        $data_0801 = $head0801.$data0801.$data2_0801;
    }
          $content .= $data_0801;
          $content .= "\n";

          $file0801 = 'RBBPRK-0801-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          $expor0801 = array($file0801);
          $destinationPath0801=public_path('RencanaBisnis');
          if (!is_dir($destinationPath0801)) {  mkdir($destinationPath0801,0777,true);  } 
          File::put($destinationPath0801.'/'.$file0801,$content);


    $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
    $data0802 = '';
    foreach($rbb0802 as $key=>$rbb){
        $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
        $arr[0] = $rbb->flag;
        $arr[1] = $rbb->komponen;
        $arr[2] = $rbb->jenis;
        $arr[3] = $rbb->kinerja_okt;
        $arr[4] = $rbb->pro_des;
        $arr[5] = $rbb->pro_juni;
        $arr[6] = $rbb->pro_des1;
        $f01 = 'F01|dijelaskan di narasi';
        $f02 = 'F02|dijelaskan di narasi';
        $h1 = $header->flag;
        $h2 = $header->kode_sektor;
        $h3 = $header->kode_ljk;
        $h4 = $header->kode_jenis;
        $h5 = $header->modal_inti;
        $h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

        $head0802 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0802|'.$h5.'|'.$h6."\r\n";
        $data0802 .= $arr[0].'|'.$arr[1].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6]."\r\n";

        $data2_0802 = $f01."\r\n".$f02;
        $data_0802 = $head0802.$data0802.$data2_0802;
    }
          $content .= $data_0802;
          $content .= "\n";

          $file0802 = 'RBBPRK-0802-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          $expor0802 = array($file0802);
          $destinationPath0802=public_path('RencanaBisnis');
          if (!is_dir($destinationPath0802)) {  mkdir($destinationPath0802,0777,true);  } 
          File::put($destinationPath0802.'/'.$file0802,$content);


    $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
    $data0803 = '';
    foreach($rbb0803 as $key=>$rbb){
        $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
        $arr[0] = $rbb->flag;
        $arr[1] = $rbb->komponen;
        $arr[2] = $rbb->sandi_bank;
        $arr[3] = $rbb->kinerja_okt;
        $arr[4] = $rbb->pro_des;
        $arr[5] = $rbb->pro_juni;
        $arr[6] = $rbb->pro_des1;
        $f01 = 'F01|dijelaskan di narasi';
        $f02 = 'F02|dijelaskan di narasi';
        $h1 = $header->flag;
        $h2 = $header->kode_sektor;
        $h3 = $header->kode_ljk;
        $h4 = $header->kode_jenis;
        $h5 = $header->modal_inti;
        $h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

        $head0803 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0803|'.$h5.'|'.$h6."\r\n";
        $data0803 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6]."\r\n";

        $data2_0803 = $f01."\r\n".$f02;
        $data_0803 = $head0803.$data0803.$data2_0803;
    }
          $content .= $data_0803;
          $content .= "\n";

          $file0803 = 'RBBPRK-0803-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          $expor0803 = array($file0803);
          $destinationPath0803=public_path('RencanaBisnis');
          if (!is_dir($destinationPath0803)) {  mkdir($destinationPath0803,0777,true);  } 
          File::put($destinationPath0803.'/'.$file0803,$content);

    $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
    $data0804 = '';
    foreach($rbb0804 as $key=>$rbb){
        $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
        $arr[0] = $rbb->flag;
        $arr[1] = $rbb->komponen;
        $arr[2] = $rbb->jumlah;
        $arr[3] = $rbb->kinerja_okt;
        $arr[4] = $rbb->pro_des;
        $arr[5] = $rbb->pro_juni;
        $arr[6] = $rbb->pro_des1;
        $f01 = 'F01|dijelaskan di narasi';
        $f02 = 'F02|dijelaskan di narasi';
        $h1 = $header->flag;
        $h2 = $header->kode_sektor;
        $h3 = $header->kode_ljk;
        $h4 = $header->kode_jenis;
        $h5 = $header->modal_inti;
        $h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

        $head0804 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0804|'.$h5.'|'.$h6."\r\n";
        $data0804 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6]."\r\n";

        $data2_0804 = $f01."\r\n".$f02;
        $data_0804 = $head0804.$data0804.$data2_0804;
    }
          $content .= $data_0804;
          $content .= "\n";

          $file0804 = 'RBBPRK-0804-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          $expor0804 = array($file0804);
          $destinationPath0804=public_path('RencanaBisnis');
          if (!is_dir($destinationPath0804)) {  mkdir($destinationPath0804,0777,true);  } 
          File::put($destinationPath0804.'/'.$file0804,$content);


    $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
    $data0805 = '';
    foreach($rbb0805 as $key=>$rbb){
        $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
        $arr[0] = $rbb->flag;
        $arr[1] = $rbb->komponen;
        $arr[2] = $rbb->kode_sektor;
        $arr[3] = $rbb->kinerja_okt;
        $arr[4] = $rbb->pro_des;
        $arr[5] = $rbb->pro_juni;
        $arr[6] = $rbb->pro_des1;
        $f01 = 'F01|dijelaskan di narasi';
        $f02 = 'F02|dijelaskan di narasi';
        $h1 = $header->flag;
        $h2 = $header->kode_sektor;
        $h3 = $header->kode_ljk;
        $h4 = $header->kode_jenis;
        $h5 = $header->modal_inti;
        $h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

        $head0805 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0805|'.$h5.'|'.$h6."\r\n";
        $data0805 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6]."\r\n";

        $data2_0805 = $f01."\r\n".$f02;
        $data_0805 = $head0805.$data0805.$data2_0805;
    }
          $content .= $data_0805;
          $content .= "\n";

          $file0805 = 'RBBPRK-0805-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          $expor0805 = array($file0805);
          $destinationPath0805=public_path('RencanaBisnis');
          if (!is_dir($destinationPath0805)) {  mkdir($destinationPath0805,0777,true);  } 
          File::put($destinationPath0805.'/'.$file0805,$content);


    $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
    $data0806 = '';
    foreach($rbb0806 as $key=>$rbb){
        $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
        $arr[0] = $rbb->flag;
        $arr[1] = $rbb->komponen;
        $arr[2] = $rbb->kinerja_okt;
        $arr[3] = $rbb->pro_des;
        $arr[4] = $rbb->pro_juni;
        $arr[5] = $rbb->pro_des1;
        $f01 = 'F01|dijelaskan di narasi';
        $f02 = 'F02|dijelaskan di narasi';
        $h1 = $header->flag;
        $h2 = $header->kode_sektor;
        $h3 = $header->kode_ljk;
        $h4 = $header->kode_jenis;
        $h5 = $header->modal_inti;
        $h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

        $head0806 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0806|'.$h5.'|'.$h6."\r\n";
        $data0806 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5]."\r\n";

        $data2_0806 = $f01."\r\n".$f02;
        $data_0806 = $head0806.$data0806.$data2_0806;
    }
          $content .= $data_0806;
          $content .= "\n";

          $file0806 = 'RBBPRK-0806-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          $expor0806 = array($file0806);
          $destinationPath0806=public_path('RencanaBisnis');
          if (!is_dir($destinationPath0806)) {  mkdir($destinationPath0806,0777,true);  } 
          File::put($destinationPath0806.'/'.$file0806,$content);

    $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0807 = '';
    foreach($rbb0807 as $key=>$rbb){
        $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
        $arr[0] = $rbb->flag;
        $arr[1] = $rbb->komponen;
        $arr[2] = $rbb->kinerja_okt;
        $arr[3] = $rbb->pro_des;
        $arr[4] = $rbb->pro_juni;
        $arr[5] = $rbb->pro_des1;
        $f01 = 'F01|dijelaskan di narasi';
        $f02 = 'F02|dijelaskan di narasi';
        $h1 = $header->flag;
        $h2 = $header->kode_sektor;
        $h3 = $header->kode_ljk;
        $h4 = $header->kode_jenis;
        $h5 = $header->modal_inti;
        $h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

        $head0807 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0807|'.$h5.'|'.$h6."\r\n";
        $data0807 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5]."\r\n";

        $data2_0807 = $f01."\r\n".$f02;
        $data_0807 = $head0807.$data0807.$data2_0807;
    }
          $content .= $data_0807;
          $content .= "\n";

          $file0807 = 'RBBPRK-0807-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          $expor0807 = array($file0807);
          $destinationPath0807=public_path('RencanaBisnis');
          if (!is_dir($destinationPath0807)) {  mkdir($destinationPath0807,0777,true);  } 
          File::put($destinationPath0807.'/'.$file0807,$content);


    $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
    $data0901 = '';
    foreach($rbb0901 as $key=>$rbb){
        $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
        $arr[0] = $rbb->flag;
        $arr[1] = $rbb->komponen;
        if($arr[1] == '14010700000000'){
          $arr[2] = number_format($rbb->kinerja_okt, 2, '.', '');
        $arr[3] = number_format($rbb->pro_des, 2, '.', '');
        $arr[4] = number_format($rbb->pro_juni, 2, '.', '');
        $arr[5] = number_format($rbb->pro_des1, 2, '.', '');
        $arr[6] = number_format($rbb->pro_des2, 2, '.', '');
        }else{
          $arr[2] = $rbb->kinerja_okt;
        $arr[3] = $rbb->pro_des;
        $arr[4] = $rbb->pro_juni;
        $arr[5] = $rbb->pro_des1;
        $arr[6] = $rbb->pro_des2;
        }
        $f01 = 'F01|dijelaskan di narasi';
        $f02 = 'F02|dijelaskan di narasi';
        $h1 = $header->flag;
        $h2 = $header->kode_sektor;
        $h3 = $header->kode_ljk;
        $h4 = $header->kode_jenis;
        $h5 = $header->modal_inti;
        $h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

        $head0901 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0901|'.$h5.'|'.$h6."\r\n";
        $data0901 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6]."\r\n";

        $data2_0901 = $f01."\r\n".$f02;
        $data_0901 = $head0901.$data0901.$data2_0901;
    }
          $content .= $data_0901;
          $content .= "\n";

          $file0901 = 'RBBPRK-0901-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          $expor0901 = array($file0901);
          $destinationPath0901=public_path('RencanaBisnis');
          if (!is_dir($destinationPath0901)) {  mkdir($destinationPath0901,0777,true);  } 
          File::put($destinationPath0901.'/'.$file0901,$content);

    $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
    $data0902 = '';
    foreach($rbb0902 as $key=>$rbb){
        $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
        $arr[0] = $rbb->flag;
        $arr[1] = $rbb->komponen;
        $arr[2] = $rbb->kinerja_okt;
        $arr[3] = $rbb->pro_des;
        $arr[4] = $rbb->pro_juni;
        $arr[5] = $rbb->pro_des1;
        $arr[6] = $rbb->pro_des2;
        $arr[7] = $rbb->pro_des3;
        $arr[8] = $rbb->pro_des4;
        $arr[9] = $rbb->pro_des5;
        $f01 = 'F01|dijelaskan di narasi';
        $f02 = 'F02|dijelaskan di narasi';
        $h1 = $header->flag;
        $h2 = $header->kode_sektor;
        $h3 = $header->kode_ljk;
        $h4 = $header->kode_jenis;
        $h5 = $header->modal_inti;
        $h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

        $head0902 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0902|'.$h5.'|'.$h6;
        $data0902 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8].'|'.$arr[9]."\r\n";

        $data2_0902 = $f01."\r\n".$f02;
        // $data_0902 = $head0902.$data0902.$data2_0902;
        $data_0902 = $head0902;
    }
          $content .= $data_0902;
          // $content .= "\n";

          $file0902 = 'RBBPRK-0902-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          $expor0902 = array($file0902);
          $destinationPath0902=public_path('RencanaBisnis');
          if (!is_dir($destinationPath0902)) {  mkdir($destinationPath0902,0777,true);  } 
          File::put($destinationPath0902.'/'.$file0902,$content);

    $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
    $data0903 = '';
    foreach($rbb0903 as $key=>$rbb){
        $header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
        $arr[0] = $rbb->flag;
        $arr[1] = $rbb->komponen;
        $arr[3] = $rbb->nama;
        // if($arr[3] == '0'){
        //  $arr[3] = '';
        // }else{
        //  $arr[3] = $rbb->nama;
        // }
        $arr[4] = $rbb->kinerja_okt;
        $arr[5] = $rbb->pro_des;
        $arr[6] = $rbb->pro_juni;
        $arr[7] = $rbb->pro_des1;
        $arr[8] = $rbb->pro_des2;
        $arr[9] = $rbb->pro_des3;
        $f01 = 'F01|';
        $f02 = 'F02|';
        $h1 = $header->flag;
        $h2 = $header->kode_sektor;
        $h3 = $header->kode_ljk;
        $h4 = $header->kode_jenis;
        $h5 = $header->modal_inti;
        $h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
            $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

        $head0903 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0903|'.$h5.'|'.$h6."\r\n";
        $data0903 .= $arr[0].'|'.$arr[1].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8].'|'.$arr[9]."\r\n";

        $data2_0903 = $f01."\r\n".$f02;
        $data_0903 = $head0903.$data0903.$data2_0903;
    }
          $content .= $data_0903;
          $content .= "\n";

          $file0903 = 'RBBPRK-0903-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
          // $expor0903 = array($file0903);
          $destinationPath0903=public_path('RencanaBisnis');
          if (!is_dir($destinationPath0903)) {  mkdir($destinationPath0903,0777,true);  } 
          File::put($destinationPath0903.'/'.$file0903,$content);

      // zipnya
        
          $archive_file_name='RBB.zip';
          $zip_path = public_path('RBB/RBB.zip');
          $zip = new ZipArchive();

          if ($zip->open($zip_path, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE) !== TRUE) {
            die ("An error occurred creating your ZIP file.");
          }
          
          // tambahkan disni
          $zip->addFile($destinationPath0102.'/'.$file0102,$file0102);
          $zip->addFile($destinationPath0301.'/'.$file0301,$file0301);
          $zip->addFile($destinationPath0401.'/'.$file0401,$file0401);
          $zip->addFile($destinationPath0501.'/'.$file0501,$file0501);
          $zip->addFile($destinationPath0601.'/'.$file0601,$file0601);
          $zip->addFile($destinationPath0701.'/'.$file0701,$file0701);
          $zip->addFile($destinationPath0801.'/'.$file0801,$file0801);
          $zip->addFile($destinationPath0802.'/'.$file0802,$file0802);
          $zip->addFile($destinationPath0803.'/'.$file0803,$file0803);
          $zip->addFile($destinationPath0804.'/'.$file0804,$file0804);
          $zip->addFile($destinationPath0805.'/'.$file0805,$file0805);
          $zip->addFile($destinationPath0806.'/'.$file0806,$file0806);
          $zip->addFile($destinationPath0807.'/'.$file0807,$file0807);
          $zip->addFile($destinationPath0901.'/'.$file0901,$file0901);
          $zip->addFile($destinationPath0902.'/'.$file0902,$file0902);
          $zip->addFile($destinationPath0903.'/'.$file0903,$file0903);
          $zip->close();

          $headers = [
            'Content-type' => 'application/zip', 
            //'Content-Disposition' => sprintf('attachment; filename="%s"', $file0102),
            'Content-Disposition' => sprintf('attachment; filename="%s"', $archive_file_name),
            //'Content-Length' => strlen($content)
            'Pragma' => 'no-cache',
            'Expires' => 0
          ];

          Session::flash('success', 'Your Data has successfully export');
        // make a response, with the content, a 200 response code and the headers
          //return Response::make($zip, 200, $headers);
          return response()->download($zip_path);
          // File::put($content,200,$headers);
    }


    public function downloadJSONFile(Request $request){
      	// t    -beda- t-t- beda    -beda-   t.t
      	// RBBPRK-0102-R-A-20181231-601025-01.txt
      	// RBBPRK-0301-R-A-20181231-601025-01.txt
      // RBBPRK-0401-R-A-20181231-601025-01.txt
      // RBBPRK-0501-R-A-20181231-601025-01.txt
      // RBBPRK-0601-R-A-20181231-601025-01.txt
      // RBBPRK-0701-R-A-20181231-601025-01.txt
      // RBBPRK-0801-R-A-20181231-601025-01.txt
      // RBBPRK-0802-R-A-20181231-601025-01.txt
      // RBBPRK-0803-R-A-20181231-601025-01.txt
      // RBBPRK-0804-R-A-20181231-601025-01.txt
      // RBBPRK-0805-R-A-20181231-601025-01.txt
      // RBBPRK-0806-R-A-20181231-601025-01.txt
      // RBBPRK-0807-R-A-20181231-601025-01.txt
      // RBBPRK-0901-R-A-20181231-601025-01.txt
      // RBBPRK-0901-R-A-20181231-601025-01.txt
      // RBBPRK-0902-R-A-20181231-601025-01.txt
      // RBBPRK-0903-R-A-20181231-601025-01.txt
     
      $kantor = DB::connection('mysql')->table('rbb_kodeljk')->where('no_kantor',Auth::user()->kantor)->first();

      $header = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, flag, kode_sektor,kode_ljk, kode_jenis, modal_inti, opr, tgl_input FROM rbb_header where periode = '".$request->input('periode')."' AND no_kantor = '".Auth::user()->kantor."' "));
    
      $rbb0102 = DB::connection('mysql')->select(DB::raw("SELECT id,basic,row,flag,komponen,indikator,kinerja_okt_pembilang,kinerja_okt_penyebut,kinerja_persen,proyeksi_des_pembilang,proyeksi_des_penyebut,proyeksi_des_persen,proyeksi_jun_pembilang,proyeksi_jun_penyebut,proyeksi_jun_persen,proyeksi_des_pembilang_1,proyeksi_des_penyebut_1,proyeksi_des_persen_1,proyeksi_des_pembilang_2,proyeksi_des_penyebut_2,proyeksi_des_persen_2,proyeksi_des_pembilang_3,proyeksi_des_penyebut_3,proyeksi_des_persen_3,opr, tgl_input, created_at, updated_at FROM rbb_0102 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));

      $rbb0301 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, pos, kinerja_okt, pro_des, pro_juni, pro_des1, pro_des2, pro_des3, opr, tgl_input, created_at, updated_at FROM rbb_0301 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0401 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, pos, kinerja_okt, pro_des, pro_juni, pro_des1, pro_des2, pro_des3, opr, tgl_input, created_at, updated_at FROM rbb_0401 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));

      $rbb0501 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, rasio, kinerja_okt_pembilang, kinerja_okt_penyebut, kinerja_persen, proyeksi_des_pembilang, proyeksi_des_penyebut, proyeksi_des_persen, proyeksi_jun_pembilang, proyeksi_jun_penyebut, proyeksi_jun_persen, proyeksi_des_pembilang_1, proyeksi_des_penyebut_1, proyeksi_des_persen_1, proyeksi_des_pembilang_2, proyeksi_des_penyebut_2, proyeksi_des_persen_2, proyeksi_des_pembilang_3, proyeksi_des_penyebut_3, proyeksi_des_persen_3, opr, tgl_input, created_at, updated_at FROM rbb_0501 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));

      $rbb0601 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, kel, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0601 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));

      $rbb0701 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, kode_ref, jenis, nama, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0701 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0801 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, kode_ref, jenis, jumlah, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0801 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0802 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, jenis, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0802 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0803 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, sandi_bank, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0803 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0804 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, jenis, jumlah, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0804 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));

      $rbb0805 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, kode_sektor, sektor, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0805 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0806 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, jenis, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0806 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'   "));

      $rbb0807 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, jenis, kinerja_okt, pro_des, pro_juni, pro_des1, opr, tgl_input, created_at, updated_at FROM rbb_0807 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0901 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, modal, kinerja_okt, pro_des, pro_juni, pro_des1, pro_des2, opr, tgl_input, created_at, updated_at FROM rbb_0901 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."'  "));

      $rbb0902 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, ket, kinerja_okt, pro_des, pro_juni, pro_des1, pro_des2, pro_des3, pro_des4, pro_des5, opr, tgl_input, created_at, updated_at FROM rbb_0902 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));

      $rbb0903 = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, basic, row, flag, komponen, ket_bisnis, nama, kinerja_okt, pro_des, pro_juni, pro_des1, pro_des2, pro_des3, opr, tgl_input, created_at, updated_at FROM rbb_0903 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' AND nama != '0' "));

      // $rbb0102_f = DB::connection('mysql')->select(DB::raw("SELECT kode, periode, no_kantor, id, data, isi, opr, tgl_input, created_at, updated_at FROM rbb_0102_f where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));
      
      $arr = array(0,0,0,0,0,0,0,0);
      $content = "";
      $data0102 = '';
      foreach($rbb0102 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
          // $rbb_f = rbb_0102_f::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
  		    $arr[0] = $rbb->flag;
  		    $arr[1] = $rbb->komponen;
    			$arr[2] = $rbb->kinerja_okt_pembilang;
    			$arr[3] = $rbb->kinerja_okt_penyebut;
    			$arr[4] = number_format($rbb->kinerja_persen, 2, '.', '');
    			$arr[5] = $rbb->proyeksi_des_pembilang;
    			$arr[6] = $rbb->proyeksi_des_penyebut;
    			$arr[7] = number_format($rbb->proyeksi_des_persen, 2, '.', '');
    			$arr[8] = $rbb->proyeksi_jun_pembilang;
    			$arr[9] = $rbb->proyeksi_jun_penyebut;
    			$arr[10] =number_format($rbb->proyeksi_jun_persen, 2, '.', ''); 
    			$arr[11] = $rbb->proyeksi_des_pembilang_1; 
    			$arr[12] = $rbb->proyeksi_des_penyebut_1;
    			$arr[13] = number_format($rbb->proyeksi_des_persen_1, 2, '.', '');
    			$arr[14] = $rbb->proyeksi_des_pembilang_2; 
    			$arr[15] = $rbb->proyeksi_des_penyebut_2;
    			$arr[16] = number_format($rbb->proyeksi_des_persen_2, 2, '.', '');
    			$arr[17] = $rbb->proyeksi_des_pembilang_3; 
    			$arr[18] = $rbb->proyeksi_des_penyebut_3;
    			$arr[19] = number_format($rbb->proyeksi_des_persen_3, 2, '.', '');
    			$f01 = 'F01|dijelaskan di narasi';
    			$f02 = 'F02|';
          // $f1 = $rbb_f->kode;
          // $f2 = $rbb_f->periode;
          // $f3 = $rbb_f->no_kantor;
          // $f4 = $rbb_f->id;
          // $f5 = $rbb_f->data;
          // $f6 = $rbb_f->isi;
    			$h1 = $header->flag;
    			$h2 = $header->kode_sektor;
    			$h3 = $header->kode_ljk;
    			$h4 = $header->kode_jenis;
    			$h5 = $header->modal_inti;
    			$h6 = $header->ref_surat;
          if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
            $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

  		    $head0102 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0102|'.$h5.'|'.$h6."\r\n";
  		    if($h5 < 50000000){
  		    	$data0102 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8].'|'.$arr[9].'|'.$arr[10].'|'.$arr[11].'|'.$arr[12].'|'.$arr[13].'|'.'|'.'|'.'|'.'|'.'|'."\r\n";
    			}else{
    				$data0102 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8].'|'.$arr[9].'|'.$arr[10].'|'.$arr[11].'|'.$arr[12].'|'.$arr[13].'|'.$arr[14].'|'.$arr[15].'|'.$arr[16].'|'.$arr[17].'|'.$arr[18].'|'.$arr[19]."\r\n";
    			}
    		    $data2_0102 = $f01."\r\n".$f02;
    		    $data_0102 = $head0102.$data0102.$data2_0102;

            $file0102 = 'RBBPRK-0102-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
            // $expor0102 = array($file0102);
            $destinationPath0102="C:/RencanaBisnis/";
            // $destinationPath0102= public_path("C:/RencanaBisnis/");
            // $destinationPath0102 = Storage::disk('local')->url($destinationPath0102);
            if (!is_dir($destinationPath0102)) {  mkdir($destinationPath0102,0777,true);  } 
            // return Response::download($destinationPath0102.$file0102,$data_0102);
            File::put($destinationPath0102.$file0102,$data_0102);
            // return response()->download($destinationPath0102.$file0102);
            Session::flash('success', 'Your Data has successfully export');

	   }	
          
	   $arr = array(0,0,0,0,0,0,0,0);
     $content = "";
     $data0301 = '';
	  foreach($rbb0301 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
		    $arr[0] = $rbb->flag;
		    $arr[1] = $rbb->komponen;
  			$arr[2] = $rbb->pos;
  			$arr[3] = $rbb->kinerja_okt;
  			$arr[4] = $rbb->pro_des;
  			$arr[5] = $rbb->pro_juni;
  			$arr[6] = $rbb->pro_des1;
  			$arr[7] = $rbb->pro_des2;
  			$arr[8] = $rbb->pro_des3;
  			$f01 = 'F01|dijelaskan di narasi';
  			$f02 = 'F02|';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
            $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0301 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0301|'.$h5.'|'.$h6."\r\n";
		    if($h5 < 50000000){
		    	$data0301 .= $arr[0].'|'.$arr[1].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.'|'."\r\n";
  			}else{
  				$data0301 .= $arr[0].'|'.$arr[1].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8]."\r\n";
  			}
  		    $data2_0301 = $f01."\r\n".$f02;
  		    $data_0301 = $head0301.$data0301.$data2_0301;

	      	$file0301 = 'RBBPRK-0301-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	$expor0301 = array($file0301);
	      	$destinationPath0301="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0301)) {  mkdir($destinationPath0301,0777,true);  } 
	      	File::put($destinationPath0301.$file0301,$data_0301);

	      	Session::flash('success', 'Your Data has successfully export');
	  }	
          

	  $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0401 = '';
	  foreach($rbb0401 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
		    $arr[0] = $rbb->flag;
		    $arr[1] = $rbb->komponen;
  			$arr[2] = $rbb->kinerja_okt;
  			$arr[3] = $rbb->pro_des;
  			$arr[4] = $rbb->pro_juni;
  			$arr[5] = $rbb->pro_des1;
  			$arr[6] = $rbb->pro_des2;
  			$arr[7] = $rbb->pro_des3;
  			$f01 = 'F01|dijelaskan di narasi';
  			$f02 = 'F02|';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0401 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0401|'.$h5.'|'.$h6."\r\n";
		    if($h5 < 50000000){
		    	$data0401 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.'|'."\r\n";
  			}else{
  				$data0401 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7]."\r\n";
  			}
  		    $data2_0401 = $f01."\r\n".$f02;
  		    $data_0401 = $head0401.$data0401.$data2_0401;

	      	$file0401 = 'RBBPRK-0401-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	$expor0401 = array($file0401);
	      	$destinationPath0401="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0401)) {  mkdir($destinationPath0401,0777,true);  } 
	      	File::put($destinationPath0401.$file0401,$data_0401);

	      	Session::flash('success', 'Your Data has successfully export');
	  }

	  $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0501 = '';
	  foreach($rbb0501 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
		    $arr[0] = $rbb->flag;
		    $arr[1] = $rbb->komponen;
  			$arr[2] = $rbb->kinerja_okt_pembilang;
  			$arr[3] = $rbb->kinerja_okt_penyebut;
  			$arr[4] = number_format($rbb->kinerja_persen, 2, '.', '');
  			$arr[5] = $rbb->proyeksi_des_pembilang;
  			$arr[6] = $rbb->proyeksi_des_penyebut;
  			$arr[7] = number_format($rbb->proyeksi_des_persen, 2, '.', '');
  			$arr[8] = $rbb->proyeksi_jun_pembilang;
  			$arr[9] = $rbb->proyeksi_jun_penyebut;
  			$arr[10] = number_format($rbb->proyeksi_jun_persen, 2, '.', '');
  			$arr[11] = $rbb->proyeksi_des_pembilang_1;
  			$arr[12] = $rbb->proyeksi_des_penyebut_1;
  			$arr[13] = number_format($rbb->proyeksi_des_persen_1, 2, '.', '');
  			$arr[14] = $rbb->proyeksi_des_pembilang_2;
  			$arr[15] = $rbb->proyeksi_des_penyebut_2;
  			$arr[16] = number_format($rbb->proyeksi_des_persen_2, 2, '.', '');
  			$arr[17] = $rbb->proyeksi_des_pembilang_3;
  			$arr[18] = $rbb->proyeksi_des_penyebut_3;
  			$arr[19] = number_format($rbb->proyeksi_des_persen_3, 2, '.', '');
  			$f01 = 'F01|dijelaskan di narasi';
  			$f02 = 'F02|';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
            $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0501 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0501|'.$h5.'|'.$h6."\r\n";
		    if($h5 < 50000000){
		    	$data0501 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8].'|'.$arr[9].'|'.$arr[10].'|'.$arr[11].'|'.$arr[12].'|'.$arr[13].'|'.'|'.'|'.'|'.'|'.'|'."\r\n";
  			}else{
  				$data0501 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8].'|'.$arr[9].'|'.$arr[10].'|'.$arr[11].'|'.$arr[12].'|'.$arr[13].'|'.$arr[14].'|'.$arr[15].'|'.$arr[16].'|'.$arr[17].'|'.$arr[18].'|'.$arr[19]."\r\n";
  			}
  		    $data2_0501 = $f01."\r\n".$f02;
  		    $data_0501 = $head0501.$data0501.$data2_0501;

	      	$file0501 = 'RBBPRK-0501-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	$expor0501 = array($file0501);
	      	$destinationPath0501="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0501)) {  mkdir($destinationPath0501,0777,true);  } 
	      	File::put($destinationPath0501.$file0501,$data_0501);

	      	Session::flash('success', 'Your Data has successfully export');
	  }	

	  $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0601 = '';
	  foreach($rbb0601 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
	      	$arr[0] = $rbb->flag;
			$arr[1] = $rbb->komponen;
	      	if($arr[1] == '05050000000000'){
  				$arr[2] = number_format($rbb->kinerja_okt, 2, '.', '');
  				$arr[3] = number_format($rbb->pro_des, 2, '.', '');
  				$arr[4] = number_format($rbb->pro_juni, 2, '.', '');
  				$arr[5] = number_format($rbb->pro_des1, 2, '.', '');
	      	} elseif ($arr[1] == '05060000000000') {
            $arr[2] = number_format($rbb->kinerja_okt, 2, '.', '');
            $arr[3] = number_format($rbb->pro_des, 2, '.', '');
            $arr[4] = number_format($rbb->pro_juni, 2, '.', '');
            $arr[5] = number_format($rbb->pro_des1, 2, '.', '');
          } else{
  				$arr[2] = $rbb->kinerja_okt;
  				$arr[3] = $rbb->pro_des;
  				$arr[4] = $rbb->pro_juni;
  				$arr[5] = $rbb->pro_des1;
	      	}
  			$f01 = 'F01|dijelaskan di narasi';
  			$f02 = 'F02|dijelaskan di narasi';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0601 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0601|'.$h5.'|'.$h6."\r\n";
		    $data0601 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5]."\r\n";
		    $data2_0601 = $f01."\r\n".$f02;
		    $data_0601 = $head0601.$data0601.$data2_0601;

	      	$file0601 = 'RBBPRK-0601-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	$expor0601 = array($file0601);
	      	$destinationPath0601="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0601)) {  mkdir($destinationPath0601,0777,true);  } 
	      	File::put($destinationPath0601.$file0601,$data_0601);

	      	Session::flash('success', 'Your Data has successfully export');
	  }		

	  $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0701 = '';
	  foreach($rbb0701 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
		    $arr[0] = $rbb->flag;
		    $arr[1] = $rbb->komponen;
  			$arr[2] = $rbb->kode_ref;
  			$arr[3] = $rbb->nama;
  			$arr[4] = $rbb->kinerja_okt;
  			$arr[5] = $rbb->pro_des;
  			$arr[6] = $rbb->pro_juni;
  			$arr[7] = $rbb->pro_des1;
  			$f01 = 'F01|dijelaskan di narasi';
  			$f02 = 'F02|dijelaskan di narasi';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0701 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0701|'.$h5.'|'.$h6."\r\n";
		    $data0701 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7]."\r\n";

		    $data2_0701 = $f01."\r\n".$f02;
		    $data_0701 = $head0701.$data0701.$data2_0701;

	      	$file0701 = 'RBBPRK-0701-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	$expor0701 = array($file0701);
	      	$destinationPath0701="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0701)) {  mkdir($destinationPath0701,0777,true);  } 
	      	File::put($destinationPath0701.$file0701,$data_0701);

	      	Session::flash('success', 'Your Data has successfully export');
	  }

	  $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0801 = '';
	  foreach($rbb0801 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
		    $arr[0] = $rbb->flag;
		    $arr[1] = $rbb->komponen;
  			$arr[2] = $rbb->kode_ref;
  			$arr[3] = $rbb->jumlah;
  			if($arr[1] == 7040000000000){
  				$arr[4] = number_format($rbb->kinerja_okt, 2, '.', '');
  				$arr[5] = number_format($rbb->pro_des, 2, '.', '');
  				$arr[6] = number_format($rbb->pro_juni, 2, '.', '');
  				$arr[7] = number_format($rbb->pro_des1, 2, '.', '');
  			}else{
  				$arr[4] = $rbb->kinerja_okt;
  				$arr[5] = $rbb->pro_des;
  				$arr[6] = $rbb->pro_juni;
  				$arr[7] = $rbb->pro_des1;
  			}
  			
  			$f01 = 'F01|dijelaskan di narasi';
  			$f02 = 'F02|dijelaskan di narasi';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0801 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0801|'.$h5.'|'.$h6."\r\n";
		    $data0801 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7]."\r\n";

		    $data2_0801 = $f01."\r\n".$f02;
		    $data_0801 = $head0801.$data0801.$data2_0801;

	      	$file0801 = 'RBBPRK-0801-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	$expor0801 = array($file0801);
	      	$destinationPath0801="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0801)) {  mkdir($destinationPath0801,0777,true);  } 
	      	File::put($destinationPath0801.$file0801,$data_0801);

	      	Session::flash('success', 'Your Data has successfully export');
	  }

	  $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0802 = '';
	  foreach($rbb0802 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
		    $arr[0] = $rbb->flag;
		    $arr[1] = $rbb->komponen;
  			$arr[2] = $rbb->jenis;
  			$arr[3] = $rbb->kinerja_okt;
  			$arr[4] = $rbb->pro_des;
  			$arr[5] = $rbb->pro_juni;
  			$arr[6] = $rbb->pro_des1;
  			$f01 = 'F01|dijelaskan di narasi';
  			$f02 = 'F02|dijelaskan di narasi';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0802 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0802|'.$h5.'|'.$h6."\r\n";
		    $data0802 .= $arr[0].'|'.$arr[1].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6]."\r\n";

		    $data2_0802 = $f01."\r\n".$f02;
		    $data_0802 = $head0802.$data0802.$data2_0802;

	      	$file0802 = 'RBBPRK-0802-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	$expor0802 = array($file0802);
	      	$destinationPath0802="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0802)) {  mkdir($destinationPath0802,0777,true);  } 
	      	File::put($destinationPath0802.$file0802,$data_0802);

	      	Session::flash('success', 'Your Data has successfully export');
	  }

	  $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0803 = '';
	  foreach($rbb0803 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
		    $arr[0] = $rbb->flag;
		    $arr[1] = $rbb->komponen;
  			$arr[2] = $rbb->sandi_bank;
  			$arr[3] = $rbb->kinerja_okt;
  			$arr[4] = $rbb->pro_des;
  			$arr[5] = $rbb->pro_juni;
  			$arr[6] = $rbb->pro_des1;
  			$f01 = 'F01|dijelaskan di narasi';
  			$f02 = 'F02|dijelaskan di narasi';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0803 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0803|'.$h5.'|'.$h6."\r\n";
		    $data0803 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6]."\r\n";

		    $data2_0803 = $f01."\r\n".$f02;
		    $data_0803 = $head0803.$data0803.$data2_0803;

	      	$file0803 = 'RBBPRK-0803-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	$expor0803 = array($file0803);
	      	$destinationPath0803="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0803)) {  mkdir($destinationPath0803,0777,true);  } 
	      	File::put($destinationPath0803.$file0803,$data_0803);

	      	Session::flash('success', 'Your Data has successfully export');
	  }

	  $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0804 = '';
	  foreach($rbb0804 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
		    $arr[0] = $rbb->flag;
		    $arr[1] = $rbb->komponen;
  			$arr[2] = $rbb->jumlah;
  			$arr[3] = $rbb->kinerja_okt;
  			$arr[4] = $rbb->pro_des;
  			$arr[5] = $rbb->pro_juni;
  			$arr[6] = $rbb->pro_des1;
  			$f01 = 'F01|dijelaskan di narasi';
  			$f02 = 'F02|dijelaskan di narasi';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0804 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0804|'.$h5.'|'.$h6."\r\n";
		    $data0804 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6]."\r\n";

		    $data2_0804 = $f01."\r\n".$f02;
		    $data_0804 = $head0804.$data0804.$data2_0804;

	      	$file0804 = 'RBBPRK-0804-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	$expor0804 = array($file0804);
	      	$destinationPath0804="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0804)) {  mkdir($destinationPath0804,0777,true);  } 
	      	File::put($destinationPath0804.$file0804,$data_0804);

	      	Session::flash('success', 'Your Data has successfully export');
	  }

	  $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0805 = '';
	  foreach($rbb0805 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
		    $arr[0] = $rbb->flag;
		    $arr[1] = $rbb->komponen;
  			$arr[2] = $rbb->kode_sektor;
  			$arr[3] = $rbb->kinerja_okt;
  			$arr[4] = $rbb->pro_des;
  			$arr[5] = $rbb->pro_juni;
  			$arr[6] = $rbb->pro_des1;
  			$f01 = 'F01|dijelaskan di narasi';
  			$f02 = 'F02|dijelaskan di narasi';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0805 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0805|'.$h5.'|'.$h6."\r\n";
		    $data0805 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6]."\r\n";

		    $data2_0805 = $f01."\r\n".$f02;
		    $data_0805 = $head0805.$data0805.$data2_0805;

	      	$file0805 = 'RBBPRK-0805-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	$expor0805 = array($file0805);
	      	$destinationPath0805="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0805)) {  mkdir($destinationPath0805,0777,true);  } 
	      	File::put($destinationPath0805.$file0805,$data_0805);

	      	Session::flash('success', 'Your Data has successfully export');
	  }

	  $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0806 = '';
	  foreach($rbb0806 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
		    $arr[0] = $rbb->flag;
		    $arr[1] = $rbb->komponen;
  			$arr[2] = $rbb->kinerja_okt;
  			$arr[3] = $rbb->pro_des;
  			$arr[4] = $rbb->pro_juni;
  			$arr[5] = $rbb->pro_des1;
  			$f01 = 'F01|dijelaskan di narasi';
  			$f02 = 'F02|dijelaskan di narasi';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0806 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0806|'.$h5.'|'.$h6."\r\n";
		    $data0806 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5]."\r\n";

		    $data2_0806 = $f01."\r\n".$f02;
		    $data_0806 = $head0806.$data0806.$data2_0806;

	      	$file0806 = 'RBBPRK-0806-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	$expor0806 = array($file0806);
	      	$destinationPath0806="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0806)) {  mkdir($destinationPath0806,0777,true);  } 
	      	File::put($destinationPath0806.$file0806,$data_0806);

	      	Session::flash('success', 'Your Data has successfully export');
	  }

	  $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0807 = '';
	  foreach($rbb0807 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
		    $arr[0] = $rbb->flag;
		    $arr[1] = $rbb->komponen;
  			$arr[2] = $rbb->kinerja_okt;
  			$arr[3] = $rbb->pro_des;
  			$arr[4] = $rbb->pro_juni;
  			$arr[5] = $rbb->pro_des1;
  			$f01 = 'F01|dijelaskan di narasi';
  			$f02 = 'F02|dijelaskan di narasi';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0807 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0807|'.$h5.'|'.$h6."\r\n";
		    $data0807 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5]."\r\n";

		    $data2_0807 = $f01."\r\n".$f02;
		    $data_0807 = $head0807.$data0807.$data2_0807;

	      	$file0807 = 'RBBPRK-0807-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	$expor0807 = array($file0807);
	      	$destinationPath0807="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0807)) {  mkdir($destinationPath0807,0777,true);  } 
	      	File::put($destinationPath0807.$file0807,$data_0807);

	      	Session::flash('success', 'Your Data has successfully export');
	  }

	  $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0901 = '';
	  foreach($rbb0901 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
		    $arr[0] = $rbb->flag;
		    $arr[1] = $rbb->komponen;
		    if($arr[1] == '14010700000000'){
		    	$arr[2] = number_format($rbb->kinerja_okt, 2, '.', '');
				$arr[3] = number_format($rbb->pro_des, 2, '.', '');
				$arr[4] = number_format($rbb->pro_juni, 2, '.', '');
				$arr[5] = number_format($rbb->pro_des1, 2, '.', '');
				$arr[6] = number_format($rbb->pro_des2, 2, '.', '');
		    }else{
		    	$arr[2] = $rbb->kinerja_okt;
				$arr[3] = $rbb->pro_des;
				$arr[4] = $rbb->pro_juni;
				$arr[5] = $rbb->pro_des1;
				$arr[6] = $rbb->pro_des2;
		    }
  			$f01 = 'F01|dijelaskan di narasi';
  			$f02 = 'F02|dijelaskan di narasi';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0901 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0901|'.$h5.'|'.$h6."\r\n";
		    $data0901 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6]."\r\n";

		    $data2_0901 = $f01."\r\n".$f02;
		    $data_0901 = $head0901.$data0901.$data2_0901;

	      	$file0901 = 'RBBPRK-0901-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	$expor0901 = array($file0901);
	      	$destinationPath0901="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0901)) {  mkdir($destinationPath0901,0777,true);  } 
	      	File::put($destinationPath0901.$file0901,$data_0901);

	      	Session::flash('success', 'Your Data has successfully export');
	  }

	  $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0902 = '';
	  foreach($rbb0902 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
		    $arr[0] = $rbb->flag;
		    $arr[1] = $rbb->komponen;
		    $arr[2] = $rbb->kinerja_okt;
		    $arr[3] = $rbb->pro_des;
		    $arr[4] = $rbb->pro_juni;
		    $arr[5] = $rbb->pro_des1;
		    $arr[6] = $rbb->pro_des2;
		    $arr[7] = $rbb->pro_des3;
		    $arr[8] = $rbb->pro_des4;
		    $arr[9] = $rbb->pro_des5;
  			$f01 = 'F01|dijelaskan di narasi';
  			$f02 = 'F02|dijelaskan di narasi';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
              $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0902 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0902|'.$h5.'|'.$h6."\r\n";
		    $data0902 .= $arr[0].'|'.$arr[1].'|'.$arr[2].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8].'|'.$arr[9]."\r\n";

		    $data2_0902 = $f01."\r\n".$f02;
		    // $data_0902 = $head0902.$data0902.$data2_0902;
        $data_0902 = $head0902;

	      	$file0902 = 'RBBPRK-0902-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	$expor0902 = array($file0902);
	      	$destinationPath0902="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0902)) {  mkdir($destinationPath0902,0777,true);  } 
	      	File::put($destinationPath0902.$file0902,$data_0902);

	      	Session::flash('success', 'Your Data has successfully export');
	  }

	  $arr = array(0,0,0,0,0,0,0,0);
    $content = "";
      $data0903 = '';
	  foreach($rbb0903 as $key=>$rbb){
	      	$header = rbb_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
		    $arr[0] = $rbb->flag;
		    $arr[1] = $rbb->komponen;
		    $arr[3] = $rbb->nama;
		    // if($arr[3] == '0'){
		    // 	$arr[3] = '';
		    // }else{
		    // 	$arr[3] = $rbb->nama;
		    // }
		    $arr[4] = $rbb->kinerja_okt;
		    $arr[5] = $rbb->pro_des;
		    $arr[6] = $rbb->pro_juni;
		    $arr[7] = $rbb->pro_des1;
		    $arr[8] = $rbb->pro_des2;
		    $arr[9] = $rbb->pro_des3;
  			$f01 = 'F01|';
  			$f02 = 'F02|';
  			$h1 = $header->flag;
  			$h2 = $header->kode_sektor;
  			$h3 = $header->kode_ljk;
  			$h4 = $header->kode_jenis;
  			$h5 = $header->modal_inti;
  			$h6 = $header->ref_surat;
        if($h6 == '<kosongkan untuk selain laporan Penyesuaian RB>'){
            $h6 = '';
          }else{
            $h6 = $header->ref_surat;
          }

		    $head0903 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'RBBPRK|0903|'.$h5.'|'.$h6."\r\n";
		    $data0903 .= $arr[0].'|'.$arr[1].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8].'|'.$arr[9]."\r\n";

		    $data2_0903 = $f01."\r\n".$f02;
		    $data_0903 = $head0903.$data0903.$data2_0903;

	      	$file0903 = 'RBBPRK-0903-R-A-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';
	      	// $expor0903 = array($file0903);
	      	$destinationPath0903="C:/RencanaBisnis/";
	      	if (!is_dir($destinationPath0903)) {  mkdir($destinationPath0903,0777,true);  } 
	      	File::put($destinationPath0903.$file0903,$data_0903);

	      	Session::flash('success', 'Your Data has successfully export');
          // return Storage::download($data_0903, $file0903);
	  }

    // Zipper::make('mydir/mytest12.zip')->add(['thumbnail/1461610581.jpg','thumbnail/1461610616.jpg']);
    // return response()->download(('mydir/mytest12.zip'));      

    // return response()->download($file0903($data_0903));

    Zipper::make(('test.zip'))->add($data_0903)->close();
    return response()->download(('test.zip'));

    // return view('rbb/export',compact('rbb0102','data','kantor'));   

    }   

}
