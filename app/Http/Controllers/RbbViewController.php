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

class RbbViewController extends Controller
{
    public function view0102()
    {
        $rbbA = DB::connection('mysql')->table('rbb_0102')->where('no_kantor',Auth::user()->kantor)->OrderBy('id','asc')->get();
        return view('rbb/0102',compact('rbbA'));   
    }
    public function view0301()
    {
        $rbb = DB::connection('mysql')->table('rbb_0301')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->get();
        return view('rbb/0301',compact('rbb'));   
    }
    public function view0401()
    {
        $rbb = DB::connection('mysql')->table('rbb_0401')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->get();
        return view('rbb/0401',compact('rbb'));   
    }
    public function view0501()
    {
        $rbb = DB::connection('mysql')->table('rbb_0501')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->get();
        return view('rbb/0501',compact('rbb'));   
    }
    public function view0601()
    {
        $rbb = DB::connection('mysql')->table('rbb_0601')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->get();
        return view('rbb/0601',compact('rbb'));   
    }
    public function view0701()
    {
        $rbb = DB::connection('mysql')->table('rbb_0701')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->get();
        return view('rbb/0701',compact('rbb'));   
    }
    public function view0801()
    {
        $rbb = DB::connection('mysql')->table('rbb_0801')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->get();
        return view('rbb/0801',compact('rbb'));   
    }
    public function view0802()
    {
        $rbb = DB::connection('mysql')->table('rbb_0802')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->get();
        return view('rbb/0802',compact('rbb'));   
    }
    public function view0803()
    {
        $rbb = DB::connection('mysql')->table('rbb_0803')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->get();
        return view('rbb/0803',compact('rbb'));   
    }
    public function view0804()
    {
        $rbb = DB::connection('mysql')->table('rbb_0804')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->get();
        return view('rbb/0804',compact('rbb'));   
    }
    public function view0805()
    {
        $rbb = DB::connection('mysql')->table('rbb_0805')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->get();
        return view('rbb/0805',compact('rbb'));   
    }
    public function view0806()
    {
        $rbb = DB::connection('mysql')->table('rbb_0806')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->get();
        return view('rbb/0806',compact('rbb'));   
    }
    public function view0807()
    {
        $rbb = DB::connection('mysql')->table('rbb_0807')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->get();
        return view('rbb/0807',compact('rbb'));   
    }
    public function view0901()
    {
        $rbb = DB::connection('mysql')->table('rbb_0901')->where('no_kantor',Auth::user()->kantor)->OrderBy('id','ASC')->get();
        return view('rbb/0901',compact('rbb'));   
    }
    public function view0902()
    {
        $rbb = DB::connection('mysql')->table('rbb_0902')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->get();
        return view('rbb/0902',compact('rbb'));   
    }
    public function view0903()
    {
        $rbb = DB::connection('mysql')->table('rbb_0903')->where('no_kantor',Auth::user()->kantor)->orderby('id','asc')->get();
        return view('rbb/0903',compact('rbb'));   
    }

    public function downloadJSONFile(){
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

      $separator = '|';

      $header = DB::connection('mysql')->table('rbb_header')->get();
      $rbbA = "SELECT id,basic,row,flag,komponen,indikator,kinerja_okt_pembilang,kinerja_okt_penyebut,kinerja_persen,proyeksi_des_pembilang,proyeksi_des_penyebut,proyeksi_des_persen,proyeksi_jun_pembilang,proyeksi_jun_penyebut,proyeksi_jun_persen,proyeksi_des_pembilang_1,proyeksi_des_penyebut_1,proyeksi_des_persen_1,proyeksi_des_pembilang_2,proyeksi_des_penyebut_2,proyeksi_des_persen_2,proyeksi_des_pembilang_3,proyeksi_des_penyebut_3,proyeksi_des_persen_3,opr FROM rbb_0102 where basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' ";
      // $data = DB::connection('mysql')->select(DB::raw($rbbA));  
      // $rbbA = DB::connection('mysql')->table('rbb_0102')->where('basic','YA')->get();

      $data = json_encode($rbbA['komponen'].$seperator.$rbbA['kinerja_okt_pembilang'].$seperator.$rbbA['kinerja_okt_penyebut'].$seperator.$rbbA['kinerja_persen'].$seperator.$rbbA['proyeksi_des_pembilang'].$seperator.$rbbA['proyeksi_des_penyebut'].$seperator.$rbbA['proyeksi_des_persen'].$seperator.$rbbA['proyeksi_jun_pembilang'].$seperator.$rbbA['proyeksi_jun_penyebut'].$seperator.$rbbA['proyeksi_jun_persen'].$seperator.$rbbA['proyeksi_des_pembilang_1'].$seperator.$rbbA['proyeksi_des_penyebut_1'].$seperator.$rbbA['proyeksi_des_persen_1'].$seperator.$rbbA['proyeksi_des_pembilang_2'].$seperator.$rbbA['proyeksi_des_penyebut_2'].$seperator.$rbbA['proyeksi_des_persen_2'].$seperator.$rbbA['proyeksi_des_pembilang_3'].$seperator.$rbbA['proyeksi_des_penyebut_3'].$seperator.$rbbA['proyeksi_des_persen_3']."\r\n");

      // $query = "SELECT * FROM rbb_0102";
      // $hasil = mysql_query($query);
      // while ($data = mysql_fetch_array($hasil))
      // {
      //     // mengisi data mhs ke file text dengan separator
      //     echo $data['NIM'].$separator.$data['NAMAMHS'].$separator.$data['TGLLHR'].
      //          $separator.$data['ALAMAT'].$separator.$data['NOHP']."\r\n";
      // }

      $file = 'RBBPRK-0102-R-A-20181231-601025-01.txt';
      $expor = array($file);
      $destinationPath="C:/RencanaBisnis/";
      if (!is_dir($destinationPath)) {  mkdir($destinationPath,0777,true);  } 
      File::put($destinationPath.$file,$data);

      // contoh
      // $data1 = json_encode(['Text 1','Text 2','Text 3','Text 4','Text 5']);
      // $file1 = 'F01_file.txt';
      // $expor1 = array($file1);
      // $destinationPath1="C:/RencanaBisnis/";
      // if (!is_dir($destinationPath1)) {  mkdir($destinationPath1,0777,true);  } 
      // File::put($destinationPath1.$file1,$data1);


      // return response()->download($destinationPath.$file);
      return view('rbb/homerbb',compact('rbbA','data'));   

    }

    

}
