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
use Response;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Zipper;

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

    public function prosesReal(Request $request){
        //validate the xls file
        
        $this->validate($request, array(
            'file'      => 'required'
        ));
 
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls") {
 
                $path = $request->file->getRealPath();
                $head = Excel::selectSheets('header_im')->load($path, function($reader) {
                })->get();
                $rbb_a = Excel::selectSheets('REBPRK-0201_im')->load($path, function($reader) {
                })->get();
                $rbb_b = Excel::selectSheets('REBPRK-0301_im')->load($path, function($reader) {
                })->get();
                $rbb_c = Excel::selectSheets('REBPRK-0401_im')->load($path, function($reader) {
                })->get();

                $cariheader = real_header::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($cariheader)){
                    DB::table('real_header','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $caria = real_0201::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($caria)){
                    DB::table('real_0201','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carib = real_0301::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carib)){
                    DB::table('real_0301','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $caric = real_0401::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($caric)){
                    DB::table('real_0401','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                if(!empty($head) && $head->count()){
 
                    foreach ($head as $key => $value) {
                        $inserthead[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'jenis'   => $value->jenis,
                        'flag'  => $value->flag,
                        'kode_sektor'   => '0'.$value->kode_sektor,
                        'kode_ljk'  => $value->sandi_ljk,
                        'periode'   => $value->periode,
                        'kode_jenis'    => $value->kode_jenis,
                        'modal_inti'    => $value->modal_inti,
                        'ref_surat' => $value->ojk,
                        ];
                    }
 
                    if(!empty($inserthead)){
 
                        $insertDatahead = DB::table('real_header')->insert($inserthead);
                        if ($insertDatahead) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_a) && $rbb_a->count()){
                    
                    foreach ($rbb_a as $key => $value) {
                        $inserta[] = [
                        'kode'        => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'jenis'   => $value->jenis,
                        'periode'   => $value->periode,
                        'id'    => $value->no,
                        'basic'  => $value->a1,
                        'row'   => $value->a2,
                        'flag'=> $value->a3,
                        'komponen' => $value->a4,
                        'pos'   => $value->a5,
                        'nom'   => $value->a6,
                        'nom_real'    => $value->a7,
                        'persen_real'        => $value->a8,
                        'nom_selisih'    => $value->a9,
                        'persen_selisih'   => $value->a10,
                        ];
                    }
 
                    if(!empty($inserta)){
 
                        $insertDataa = DB::table('real_0201')->insert($inserta);
                        if ($insertDataa) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_b) && $rbb_b->count()){
                    
                    foreach ($rbb_b as $key => $value) {
                        $insertb[] = [
                        'kode'        => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'jenis'   => $value->jenis,
                        'periode'   => $value->periode,
                        'id'    => $value->no,
                        'basic'  => $value->b1,
                        'row'   => $value->b2,
                        'flag'=> $value->b3,
                        'komponen' => $value->b4,
                        'pos'   => $value->b5,
                        'nom'   => $value->b6,
                        'nom_real'    => $value->b7,
                        'persen_real'        => $value->b8,
                        'nom_selisih'    => $value->b9,
                        'persen_selisih'   => $value->b10,
                        ];
                    }
 
                    if(!empty($insertb)){
 
                        $insertDatab = DB::table('real_0301')->insert($insertb);
                        if ($insertDatab) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }


                if(!empty($rbb_c) && $rbb_c->count()){
 
                    foreach ($rbb_c as $key => $value) {
                        $insertc[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'jenis'   => $value->jenis,
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic' => $value->c1,
                        'row'   => $value->c2,
                        'flag'  => $value->c3,
                        'komponen'  => $value->c4,
                        'pos'   => $value->c5,
                        't_pembilang'   => $value->c6,
                        't_penyebut'   => $value->c7,
                        't_persen'  => $value->c8,
                        'r_pembilang'  => $value->c9,
                        'r_penyebut'  => $value->c10,
                        'r_persen'  => $value->c11,
                        'deviasi'  => $value->c12,
                        ];
                    }
 
                    if(!empty($insertc)){
 
                        $insertDatac = DB::table('real_0401')->insert($insertc);
                        if ($insertDatac) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

 
                return back();
 
            }
        }
    }

    public function getDownloadreal(Request $request) 
    {
        // prepare content
        $real0201 = DB::connection('mysql')->select(DB::raw("SELECT kode,periode,jenis,no_kantor,id,basic,row,flag,komponen,pos,nom,nom_real,persen_real,nom_selisih,persen_selisih,opr,tgl_input,created_at,updated_at FROM real_0201 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));

        $real0301 = DB::connection('mysql')->select(DB::raw("SELECT kode,periode,jenis,no_kantor,id,basic,row,flag,komponen,pos,nom,nom_real,persen_real,nom_selisih,persen_selisih,opr,tgl_input,created_at,updated_at FROM real_0301 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));

        $real0401 = DB::connection('mysql')->select(DB::raw("SELECT kode,periode,jenis,no_kantor,id,basic,row,flag,komponen,pos,t_pembilang,t_penyebut,t_persen,r_pembilang,r_penyebut,r_persen,deviasi,opr,tgl_input,created_at,updated_at FROM real_0401 where periode = '".$request->input('periode')."' AND basic = 'YA' AND no_kantor = '".Auth::user()->kantor."' "));

      
        $arr = array(0,0,0,0,0,0,0,0);
        $content = "";
        $data0201 = '';
            foreach($real0201 as $key=>$real){
                $header = real_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
         
                $arr[0] = $real->flag;
                $arr[1] = $real->komponen;
                $arr[2] = $real->pos;
                $arr[3] = $real->nom;
                $arr[4] = $real->nom_real;
                $arr[5] = number_format($real->persen_real, 2, '.', '');
                $arr[6] = $real->nom_selisih;
                $arr[7] = number_format($real->persen_selisih, 2, '.', '');
                $f01 = 'F01|';
                $f02 = 'F02|';
                $h1 = $header->flag;
                $h2 = $header->kode_sektor;
                $h3 = $header->kode_ljk;
                $h4 = $header->kode_jenis;
                $h5 = $header->modal_inti;
                $h6 = $header->ref_surat;
                if($h6 == '<selalu dikosongkan>'){
                    $h6 = '';
                }else{
                    $h6 = $header->ref_surat;
                }

                $head0201 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'REBPRK|0201|'.$h5.'|'.$h6."\r\n";
                // $f010201 = $f01.'|'.$f02."\r\n";
                // $f020201 = $f3.'|'.$f4;
         
                $data0201 .= $arr[0].'|'.$arr[1].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7]."\r\n";
          
                $data2_0201 = $f01."\r\n".$f02;
                $data_0201 = $head0201.$data0201.$data2_0201;
            
            }
        $content .= $data_0201;
        $content .= "\n";

        $file0201 = 'REBPRK-0201-R-S-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';

        $expor0201 = array($file0201);
        $destinationPath0201=public_path('RencanaBisnis');
        if (!is_dir($destinationPath0201)) {  mkdir($destinationPath0201,0777,true);  } 
            //rubah
        File::put($destinationPath0201.'/'.$file0201,$content);

        $arr = array(0,0,0,0,0,0,0,0);
        $content = "";
        $data0301 = '';
            foreach($real0301 as $key=>$real){
                $header = real_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
         
                $arr[0] = $real->flag;
                $arr[1] = $real->komponen;
                $arr[2] = $real->pos;
                $arr[3] = $real->nom;
                $arr[4] = $real->nom_real;
                $arr[5] = number_format($real->persen_real, 2, '.', '');
                $arr[6] = $real->nom_selisih;
                $arr[7] = number_format($real->persen_selisih, 2, '.', '');
                $f01 = 'F01|';
                $f02 = 'F02|';
                $h1 = $header->flag;
                $h2 = $header->kode_sektor;
                $h3 = $header->kode_ljk;
                $h4 = $header->kode_jenis;
                $h5 = $header->modal_inti;
                $h6 = $header->ref_surat;
                if($h6 == '<selalu dikosongkan>'){
                    $h6 = '';
                }else{
                    $h6 = $header->ref_surat;
                }

                $head0301 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'REBPRK|0301|'.$h5.'|'.$h6."\r\n";
                // $f010301 = $f01.'|'.$f02."\r\n";
                // $f020301 = $f3.'|'.$f4;
         
                $data0301 .= $arr[0].'|'.$arr[1].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7]."\r\n";
          
                $data2_0301 = $f01."\r\n".$f02;
                $data_0301 = $head0301.$data0301.$data2_0301;
            
            }
        $content .= $data_0301;
        $content .= "\n";

        $file0301 = 'REBPRK-0301-R-S-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';

        $expor0301 = array($file0301);
        $destinationPath0301=public_path('RencanaBisnis');
        if (!is_dir($destinationPath0301)) {  mkdir($destinationPath0301,0777,true);  } 
            //rubah
        File::put($destinationPath0301.'/'.$file0301,$content);

        $arr = array(0,0,0,0,0,0,0,0);
        $content = "";
        $data0401 = '';
            foreach($real0401 as $key=>$real){
                $header = real_header::where('no_kantor',Auth::user()->kantor)->where('periode',$request->input('periode'))->first();
         
                $arr[0] = $real->flag;
                $arr[1] = $real->komponen;
                $arr[2] = $real->pos;
                $arr[3] = $real->t_pembilang;
                $arr[4] = $real->t_penyebut;
                $arr[5] = number_format($real->t_persen, 2, '.', '');
                $arr[6] = $real->r_pembilang;
                $arr[7] = $real->r_penyebut;
                $arr[8] = number_format($real->r_persen, 2, '.', '');
                $arr[9] = number_format($real->deviasi, 2, '.', '');
                $f01 = 'F01|';
                $f02 = 'F02|';
                $h1 = $header->flag;
                $h2 = $header->kode_sektor;
                $h3 = $header->kode_ljk;
                $h4 = $header->kode_jenis;
                $h5 = $header->modal_inti;
                $h6 = $header->ref_surat;
                if($h6 == '<selalu dikosongkan>'){
                    $h6 = '';
                }else{
                    $h6 = $header->ref_surat;
                }

                $head0401 = $h1.'|'.$h2.'|'.$h3.'|'.$request->input('periode').'|'.'REBPRK|0401|'.$h5.'|'.$h6."\r\n";
                // $f010401 = $f01.'|'.$f02."\r\n";
                // $f020401 = $f3.'|'.$f4;
         
                $data0401 .= $arr[0].'|'.$arr[1].'|'.$arr[3].'|'.$arr[4].'|'.$arr[5].'|'.$arr[6].'|'.$arr[7].'|'.$arr[8].'|'.$arr[9]."\r\n";
          
                $data2_0401 = $f01."\r\n".$f02;
                $data_0401 = $head0401.$data0401.$data2_0401;
            
            }
        $content .= $data_0401;
        $content .= "\n";

        $file0401 = 'REBPRK-0401-R-S-'.str_replace("-","",$request->input('periode')).'-'.$request->input('kantor_ljk').'-01.txt';

        $expor0401 = array($file0401);
        $destinationPath0401=public_path('RencanaBisnis');
        if (!is_dir($destinationPath0401)) {  mkdir($destinationPath0401,0777,true);  } 
            //rubah
        File::put($destinationPath0401.'/'.$file0401,$content);

      // zipnya
        
        $archive_file_name='Rencana.zip';
        $zip_path = public_path('RBB/Rencana.zip');
        $zip = new ZipArchive();

        if ($zip->open($zip_path, ZIPARCHIVE::CREATE | ZIPARCHIVE::OVERWRITE) !== TRUE) {
            die ("An error occurred creating your ZIP file.");
        }
          
        // tambahkan disni
        $zip->addFile($destinationPath0201.'/'.$file0201,$file0201);
        $zip->addFile($destinationPath0301.'/'.$file0301,$file0301);
        $zip->addFile($destinationPath0401.'/'.$file0401,$file0401);
        $zip->close();
        //

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

}
