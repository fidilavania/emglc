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
use App\rbb_0102_f_copy;
use App\rbb_0301_f_copy;
use App\rbb_0401_f_copy;
use App\rbb_0501_f_copy;
use App\rbb_0601_f_copy;
use App\rbb_0701_f_copy;
use App\rbb_0801_f_copy;
use App\rbb_0802_f_copy;
use App\rbb_0803_f_copy;
use App\rbb_0804_f_copy;
use App\rbb_0805_f_copy;
use App\rbb_0806_f_copy;
use App\rbb_0807_f_copy;
use App\rbb_0901_f_copy;
use App\rbb_0902_f_copy;
use App\rbb_0903_f_copy;
use App\LKH;
use Hash;
use Validator;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Support\Facades\DB;
use Excel;
use File;

class RbbController extends Controller
{
    public function viewRencana()
    {
        return view('rbb/rencana');   
    }

    public function viewPilih()
    {
        return view('rbb/pilih');   
    }

    public function viewHomeRbb()
    {
        return view('rbb/homerbb');   
    }

    public function viewImport()
    {
        $periode = DB::connection('mysql')->table('rbb_header')->where('no_kantor',Auth::user()->kantor)->OrderBy('periode','asc')->get();
        $ljk = DB::connection('mysql')->table('rbb_kodeljk')->where('no_kantor',Auth::user()->kantor)->first();

        return view('rbb/import',compact('periode','ljk'));   
    }

    public function proses(Request $request){
        //validate the xls file
        
        $this->validate($request, array(
            'file'      => 'required'
        ));
 
        if($request->hasFile('file')){
            $extension = File::extension($request->file->getClientOriginalName());
            if ($extension == "xlsx" || $extension == "xls" || $extension == "csv" || $extension == "xlsb") {
 
                $path = $request->file->getRealPath();
                $head = Excel::selectSheets('header')->load($path, function($reader) {
                })->get();
                $rbb_a = Excel::selectSheets('RBBPRK-0102_im')->load($path, function($reader) {
                })->get();
                $rbb_b = Excel::selectSheets('RBBPRK-0301_im')->load($path, function($reader) {
                })->get();
                $rbb_c = Excel::selectSheets('RBBPRK-0401_im')->load($path, function($reader) {
                })->get();
                $rbb_d = Excel::selectSheets('RBBPRK-0501_im')->load($path, function($reader) {
                })->get();
                $rbb_e = Excel::selectSheets('RBBPRK-0601_im')->load($path, function($reader) {
                })->get();
                $rbb_f = Excel::selectSheets('RBBPRK-0701_im')->load($path, function($reader) {
                })->get();
                $rbb_g = Excel::selectSheets('RBBPRK-0801_im')->load($path, function($reader) {
                })->get();
                $rbb_h = Excel::selectSheets('RBBPRK-0802_im')->load($path, function($reader) {
                })->get();
                $rbb_i = Excel::selectSheets('RBBPRK-0803_im')->load($path, function($reader) {
                })->get();
                $rbb_j = Excel::selectSheets('RBBPRK-0804_im')->load($path, function($reader) {
                })->get();
                $rbb_k = Excel::selectSheets('RBBPRK-0805_im')->load($path, function($reader) {
                })->get();
                $rbb_l = Excel::selectSheets('RBBPRK-0806_im')->load($path, function($reader) {
                })->get();
                $rbb_m = Excel::selectSheets('RBBPRK-0807_im')->load($path, function($reader) {
                })->get();
                $rbb_n = Excel::selectSheets('RBBPRK-0901_im')->load($path, function($reader) {
                })->get();
                $rbb_o = Excel::selectSheets('RBBPRK-0902_im')->load($path, function($reader) {
                })->get();
                $rbb_p = Excel::selectSheets('RBBPRK-0903_im')->load($path, function($reader) {
                })->get();

                $rbbaf = Excel::selectSheets('RBBPRK-0102_F')->load($path, function($reader) {
                })->get();
                $rbbbf = Excel::selectSheets('RBBPRK-0301_F')->load($path, function($reader) {
                })->get();
                $rbbcf = Excel::selectSheets('RBBPRK-0401_F')->load($path, function($reader) {
                })->get();
                $rbbdf = Excel::selectSheets('RBBPRK-0501_F')->load($path, function($reader) {
                })->get();
                $rbbef = Excel::selectSheets('RBBPRK-0601_F')->load($path, function($reader) {
                })->get();
                $rbbff = Excel::selectSheets('RBBPRK-0701_F')->load($path, function($reader) {
                })->get();
                $rbbgf = Excel::selectSheets('RBBPRK-0801_F')->load($path, function($reader) {
                })->get();
                $rbbhf = Excel::selectSheets('RBBPRK-0802_F')->load($path, function($reader) {
                })->get();
                $rbbif = Excel::selectSheets('RBBPRK-0803_F')->load($path, function($reader) {
                })->get();
                $rbbjf = Excel::selectSheets('RBBPRK-0804_F')->load($path, function($reader) {
                })->get();
                $rbbkf = Excel::selectSheets('RBBPRK-0805_F')->load($path, function($reader) {
                })->get();
                $rbblf = Excel::selectSheets('RBBPRK-0806_F')->load($path, function($reader) {
                })->get();
                $rbbmf = Excel::selectSheets('RBBPRK-0807_F')->load($path, function($reader) {
                })->get();
                $rbbnf = Excel::selectSheets('RBBPRK-0901_F')->load($path, function($reader) {
                })->get();
                $rbbof = Excel::selectSheets('RBBPRK-0902_F')->load($path, function($reader) {
                })->get();
                $rbbpf = Excel::selectSheets('RBBPRK-0903_F')->load($path, function($reader) {
                })->get();

                $rbbaf02 = Excel::selectSheets('RBBPRK-0102_F02')->load($path, function($reader) {
                })->get();
                $rbbbf02 = Excel::selectSheets('RBBPRK-0301_F02')->load($path, function($reader) {
                })->get();
                $rbbcf02 = Excel::selectSheets('RBBPRK-0401_F02')->load($path, function($reader) {
                })->get();
                $rbbdf02 = Excel::selectSheets('RBBPRK-0501_F02')->load($path, function($reader) {
                })->get();
                $rbbef02 = Excel::selectSheets('RBBPRK-0601_F02')->load($path, function($reader) {
                })->get();
                $rbbff02 = Excel::selectSheets('RBBPRK-0701_F02')->load($path, function($reader) {
                })->get();
                $rbbgf02 = Excel::selectSheets('RBBPRK-0801_F02')->load($path, function($reader) {
                })->get();
                $rbbhf02 = Excel::selectSheets('RBBPRK-0802_F02')->load($path, function($reader) {
                })->get();
                $rbbif02 = Excel::selectSheets('RBBPRK-0803_F02')->load($path, function($reader) {
                })->get();
                $rbbjf02 = Excel::selectSheets('RBBPRK-0804_F02')->load($path, function($reader) {
                })->get();
                $rbbkf02 = Excel::selectSheets('RBBPRK-0805_F02')->load($path, function($reader) {
                })->get();
                $rbblf02 = Excel::selectSheets('RBBPRK-0806_F02')->load($path, function($reader) {
                })->get();
                $rbbmf02 = Excel::selectSheets('RBBPRK-0807_F02')->load($path, function($reader) {
                })->get();
                $rbbnf02 = Excel::selectSheets('RBBPRK-0901_F02')->load($path, function($reader) {
                })->get();
                $rbbof02 = Excel::selectSheets('RBBPRK-0902_F02')->load($path, function($reader) {
                })->get();
                $rbbpf02 = Excel::selectSheets('RBBPRK-0903_F02')->load($path, function($reader) {
                })->get();

                $cariaf = rbb_0102_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($cariaf)){
                    DB::table('rbb_0102_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $caribf = rbb_0301_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($caribf)){
                    DB::table('rbb_0301_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $caricf = rbb_0401_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($caricf)){
                    DB::table('rbb_0401_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $caridf = rbb_0501_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($caridf)){
                    DB::table('rbb_0501_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carief = rbb_0601_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carief)){
                    DB::table('rbb_0601_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $cariff = rbb_0701_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($cariff)){
                    DB::table('rbb_0701_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carigf = rbb_0801_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carigf)){
                    DB::table('rbb_0801_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carihf = rbb_0802_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carihf)){
                    DB::table('rbb_0802_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $cariif = rbb_0803_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($cariif)){
                    DB::table('rbb_0803_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carijf = rbb_0804_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carijf)){
                    DB::table('rbb_0804_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carikf = rbb_0805_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carikf)){
                    DB::table('rbb_0805_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carilf = rbb_0806_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carilf)){
                    DB::table('rbb_0806_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carimf = rbb_0807_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carimf)){
                    DB::table('rbb_0807_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carinf = rbb_0901_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carinf)){
                    DB::table('rbb_0901_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $cariof = rbb_0902_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($cariof)){
                    DB::table('rbb_0902_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $caripf = rbb_0903_f::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($caripf)){
                    DB::table('rbb_0903_f','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                // f02

                $cariaf02 = rbb_0102_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($cariaf02)){
                    DB::table('rbb_0102_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $caribf02 = rbb_0301_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($caribf02)){
                    DB::table('rbb_0301_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $caricf02 = rbb_0401_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($caricf02)){
                    DB::table('rbb_0401_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $caridf02 = rbb_0501_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($caridf02)){
                    DB::table('rbb_0501_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carief02 = rbb_0601_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carief02)){
                    DB::table('rbb_0601_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $cariff02 = rbb_0701_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($cariff02)){
                    DB::table('rbb_0701_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carigf02 = rbb_0801_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carigf02)){
                    DB::table('rbb_0801_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carihf02 = rbb_0802_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carihf02)){
                    DB::table('rbb_0802_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $cariif02 = rbb_0803_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($cariif02)){
                    DB::table('rbb_0803_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carijf02 = rbb_0804_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carijf02)){
                    DB::table('rbb_0804_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carikf02 = rbb_0805_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carikf02)){
                    DB::table('rbb_0805_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carilf02 = rbb_0806_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carilf02)){
                    DB::table('rbb_0806_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carimf02 = rbb_0807_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carimf02)){
                    DB::table('rbb_0807_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carinf02 = rbb_0901_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carinf02)){
                    DB::table('rbb_0901_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $cariof02 = rbb_0902_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($cariof02)){
                    DB::table('rbb_0902_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $caripf02 = rbb_0903_f_copy::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($caripf02)){
                    DB::table('rbb_0903_f_copy','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                // 

                $cariheader = rbb_header::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($cariheader)){
                    DB::table('rbb_header','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $caria = rbb_0102::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($caria)){
                    DB::table('rbb_0102','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carib = rbb_0301::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carib)){
                    DB::table('rbb_0301','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $caric = rbb_0401::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($caric)){
                    DB::table('rbb_0401','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carid = rbb_0501::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carid)){
                    DB::table('rbb_0501','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carie = rbb_0601::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carie)){
                    DB::table('rbb_0601','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carif = rbb_0701::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carif)){
                    DB::table('rbb_0701','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carig = rbb_0801::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carig)){
                    DB::table('rbb_0801','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carih = rbb_0802::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carih)){
                    DB::table('rbb_0802','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carii = rbb_0803::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carii)){
                    DB::table('rbb_0803','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carij = rbb_0804::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carij)){
                    DB::table('rbb_0804','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carik = rbb_0805::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carik)){
                    DB::table('rbb_0805','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $caril = rbb_0806::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($caril)){
                    DB::table('rbb_0806','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carim = rbb_0807::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carim)){
                    DB::table('rbb_0807','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carin = rbb_0901::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carin)){
                    DB::table('rbb_0901','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $cario = rbb_0902::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($cario)){
                    DB::table('rbb_0902','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }

                $carip = rbb_0903::where('no_kantor',$request->input('kantor'))->first();
                if(!empty($carip)){
                    DB::table('rbb_0903','no_kantor')->where('no_kantor',$request->input('kantor'))->where('periode',$request->input('periode'))->delete();
                }


                if(!empty($rbbaf) && $rbbaf->count()){
 
                    foreach ($rbbaf as $key => $value) {
                        $insertrbbaf[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbaf)){
 
                        $insertDatarbbaf = DB::table('rbb_0102_f')->insert($insertrbbaf);
                        if ($insertDatarbbaf) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbbf) && $rbbbf->count()){
 
                    foreach ($rbbbf as $key => $value) {
                        $insertrbbbf[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbbf)){
 
                        $insertDatarbbbf = DB::table('rbb_0301_f')->insert($insertrbbbf);
                        if ($insertDatarbbbf) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbcf) && $rbbcf->count()){
 
                    foreach ($rbbcf as $key => $value) {
                        $insertrbbcf[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbcf)){
 
                        $insertDatarbbcf = DB::table('rbb_0401_f')->insert($insertrbbcf);
                        if ($insertDatarbbcf) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbdf) && $rbbdf->count()){
 
                    foreach ($rbbdf as $key => $value) {
                        $insertrbbdf[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbdf)){
 
                        $insertDatarbbdf = DB::table('rbb_0501_f')->insert($insertrbbdf);
                        if ($insertDatarbbdf) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbef) && $rbbef->count()){
 
                    foreach ($rbbef as $key => $value) {
                        $insertrbbef[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbef)){
 
                        $insertDatarbbef = DB::table('rbb_0601_f')->insert($insertrbbef);
                        if ($insertDatarbbef) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbff) && $rbbff->count()){
 
                    foreach ($rbbff as $key => $value) {
                        $insertrbbff[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbff)){
 
                        $insertDatarbbff = DB::table('rbb_0701_f')->insert($insertrbbff);
                        if ($insertDatarbbff) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbgf) && $rbbgf->count()){
 
                    foreach ($rbbgf as $key => $value) {
                        $insertrbbgf[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbgf)){
 
                        $insertDatarbbgf = DB::table('rbb_0801_f')->insert($insertrbbgf);
                        if ($insertDatarbbgf) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbhf) && $rbbhf->count()){
 
                    foreach ($rbbhf as $key => $value) {
                        $insertrbbhf[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbhf)){
 
                        $insertDatarbbhf = DB::table('rbb_0802_f')->insert($insertrbbhf);
                        if ($insertDatarbbhf) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbif) && $rbbif->count()){
 
                    foreach ($rbbif as $key => $value) {
                        $insertrbbif[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbif)){
 
                        $insertDatarbbif = DB::table('rbb_0803_f')->insert($insertrbbif);
                        if ($insertDatarbbif) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbjf) && $rbbjf->count()){
 
                    foreach ($rbbjf as $key => $value) {
                        $insertrbbjf[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbjf)){
 
                        $insertDatarbbjf = DB::table('rbb_0804_f')->insert($insertrbbjf);
                        if ($insertDatarbbjf) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbkf) && $rbbkf->count()){
 
                    foreach ($rbbkf as $key => $value) {
                        $insertrbbkf[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbkf)){
 
                        $insertDatarbbkf = DB::table('rbb_0805_f')->insert($insertrbbkf);
                        if ($insertDatarbbkf) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbblf) && $rbblf->count()){
 
                    foreach ($rbblf as $key => $value) {
                        $insertrbblf[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbblf)){
 
                        $insertDatarbblf = DB::table('rbb_0806_f')->insert($insertrbblf);
                        if ($insertDatarbblf) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbmf) && $rbbmf->count()){
 
                    foreach ($rbbmf as $key => $value) {
                        $insertrbbmf[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbmf)){
 
                        $insertDatarbbmf = DB::table('rbb_0807_f')->insert($insertrbbmf);
                        if ($insertDatarbbmf) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbnf) && $rbbnf->count()){
 
                    foreach ($rbbnf as $key => $value) {
                        $insertrbbnf[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbnf)){
 
                        $insertDatarbbnf = DB::table('rbb_0901_f')->insert($insertrbbnf);
                        if ($insertDatarbbnf) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbof) && $rbbof->count()){
 
                    foreach ($rbbof as $key => $value) {
                        $insertrbbof[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbof)){
 
                        $insertDatarbbof = DB::table('rbb_0902_f')->insert($insertrbbof);
                        if ($insertDatarbbof) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbpf) && $rbbpf->count()){
 
                    foreach ($rbbpf as $key => $value) {
                        $insertrbbpf[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbpf)){
 
                        $insertDatarbbpf = DB::table('rbb_0903_f')->insert($insertrbbpf);
                        if ($insertDatarbbpf) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                // f02
                if(!empty($rbbaf02) && $rbbaf02->count()){
 
                    foreach ($rbbaf02 as $key => $value) {
                        $insertrbbaf02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbaf02)){
 
                        $insertDatarbbaf02 = DB::table('rbb_0102_f_copy')->insert($insertrbbaf02);
                        if ($insertDatarbbaf02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbbf02) && $rbbbf02->count()){
 
                    foreach ($rbbbf02 as $key => $value) {
                        $insertrbbbf02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbbf02)){
 
                        $insertDatarbbbf02 = DB::table('rbb_0301_f_copy')->insert($insertrbbbf02);
                        if ($insertDatarbbbf02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbcf02) && $rbbcf02->count()){
 
                    foreach ($rbbcf02 as $key => $value) {
                        $insertrbbcf02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbcf02)){
 
                        $insertDatarbbcf02 = DB::table('rbb_0401_f_copy')->insert($insertrbbcf02);
                        if ($insertDatarbbcf02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbdf02) && $rbbdf02->count()){
 
                    foreach ($rbbdf02 as $key => $value) {
                        $insertrbbdf02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbdf02)){
 
                        $insertDatarbbdf02 = DB::table('rbb_0501_f_copy')->insert($insertrbbdf02);
                        if ($insertDatarbbdf02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbef02) && $rbbef02->count()){
 
                    foreach ($rbbef02 as $key => $value) {
                        $insertrbbef02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbef02)){
 
                        $insertDatarbbef02 = DB::table('rbb_0601_f_copy')->insert($insertrbbef02);
                        if ($insertDatarbbef02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbff02) && $rbbff02->count()){
 
                    foreach ($rbbff02 as $key => $value) {
                        $insertrbbff02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbff02)){
 
                        $insertDatarbbff02 = DB::table('rbb_0701_f_copy')->insert($insertrbbff02);
                        if ($insertDatarbbff02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbgf02) && $rbbgf02->count()){
 
                    foreach ($rbbgf02 as $key => $value) {
                        $insertrbbgf02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbgf02)){
 
                        $insertDatarbbgf02 = DB::table('rbb_0801_f_copy')->insert($insertrbbgf02);
                        if ($insertDatarbbgf02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbhf02) && $rbbhf02->count()){
 
                    foreach ($rbbhf02 as $key => $value) {
                        $insertrbbhf02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbhf02)){
 
                        $insertDatarbbhf02 = DB::table('rbb_0802_f_copy')->insert($insertrbbhf02);
                        if ($insertDatarbbhf02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbif02) && $rbbif02->count()){
 
                    foreach ($rbbif02 as $key => $value) {
                        $insertrbbif02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbif02)){
 
                        $insertDatarbbif02 = DB::table('rbb_0803_f_copy')->insert($insertrbbif02);
                        if ($insertDatarbbif02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbjf02) && $rbbjf02->count()){
 
                    foreach ($rbbjf02 as $key => $value) {
                        $insertrbbjf02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbjf02)){
 
                        $insertDatarbbjf02 = DB::table('rbb_0804_f_copy')->insert($insertrbbjf02);
                        if ($insertDatarbbjf02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbkf02) && $rbbkf02->count()){
 
                    foreach ($rbbkf02 as $key => $value) {
                        $insertrbbkf02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbkf02)){
 
                        $insertDatarbbkf02 = DB::table('rbb_0805_f_copy')->insert($insertrbbkf02);
                        if ($insertDatarbbkf02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbblf02) && $rbblf02->count()){
 
                    foreach ($rbblf02 as $key => $value) {
                        $insertrbblf02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbblf02)){
 
                        $insertDatarbblf02 = DB::table('rbb_0806_f_copy')->insert($insertrbblf02);
                        if ($insertDatarbblf02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbmf02) && $rbbmf02->count()){
 
                    foreach ($rbbmf02 as $key => $value) {
                        $insertrbbmf02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbmf02)){
 
                        $insertDatarbbmf02 = DB::table('rbb_0807_f_copy')->insert($insertrbbmf02);
                        if ($insertDatarbbmf02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbnf02) && $rbbnf02->count()){
 
                    foreach ($rbbnf02 as $key => $value) {
                        $insertrbbnf02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbnf02)){
 
                        $insertDatarbbnf02 = DB::table('rbb_0901_f_copy')->insert($insertrbbnf02);
                        if ($insertDatarbbnf02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbof02) && $rbbof02->count()){
 
                    foreach ($rbbof02 as $key => $value) {
                        $insertrbbof02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbof02)){
 
                        $insertDatarbbof02 = DB::table('rbb_0902_f_copy')->insert($insertrbbof02);
                        if ($insertDatarbbof02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbbpf02) && $rbbpf02->count()){
 
                    foreach ($rbbpf02 as $key => $value) {
                        $insertrbbpf02[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode' => $value->periode,
                        'basic' => $value->basic,
                        'id' => $value->no,
                        'data' => $value->data,
                        'isi' => $value->isi,
                        ];
                    }
 
                    if(!empty($insertrbbpf02)){
 
                        $insertDatarbbpf02 = DB::table('rbb_0903_f_copy')->insert($insertrbbpf02);
                        if ($insertDatarbbpf02) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }
                // end f02



                if(!empty($head) && $head->count()){
 
                    foreach ($head as $key => $value) {
                        $inserthead[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
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
 
                        $insertDatahead = DB::table('rbb_header')->insert($inserthead);
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
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'                        => $value->no,
                        'basic'                     => $value->a1,
                        'row'                       => $value->a2,
                        'flag'                      => $value->a3,
                        'komponen'                  => '0'.$value->a4,
                        'indikator'                 => $value->a5,
						'kinerja_okt_pembilang'  	=> $value->a6,
						'kinerja_okt_penyebut'  	=> $value->a7,
						'kinerja_persen'  			=> $value->a8,
						'proyeksi_des_pembilang'  	=> $value->a9,
						'proyeksi_des_penyebut'  	=> $value->a10,
						'proyeksi_des_persen'  		=> $value->a11,
						'proyeksi_jun_pembilang'  	=> $value->a12,
						'proyeksi_jun_penyebut'  	=> $value->a13,
						'proyeksi_jun_persen'  		=> $value->a14,
						'proyeksi_des_pembilang_1'  => $value->a15,
						'proyeksi_des_penyebut_1'  	=> $value->a16,
						'proyeksi_des_persen_1'  	=> $value->a17,
						'proyeksi_des_pembilang_2'  => $value->a18,
						'proyeksi_des_penyebut_2'  	=> $value->a19,
						'proyeksi_des_persen_2'  	=> $value->a20,
						'proyeksi_des_pembilang_3'  => $value->a21,
						'proyeksi_des_penyebut_3'  	=> $value->a22,
						'proyeksi_des_persen_3'  	=> $value->a23,

                        ];
                    }
 
                    if(!empty($inserta)){
 
                        $insertDataa = DB::table('rbb_0102')->insert($inserta);
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
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic' => $value->b1,
                        'row'   => $value->b2,
                        'flag'  => $value->b3,
                        'komponen'  => '0'.$value->b4,
                        'pos'   => $value->b5,
                        'kinerja_okt'   => $value->b6,
                        'pro_des'   => $value->b7,
                        'pro_juni'  => $value->b8,
                        'pro_des1'  => $value->b9,
                        'pro_des2'  => $value->b10,
                        'pro_des3'  => $value->b11,
                        ];
                    }
 
                    if(!empty($insertb)){
 
                        $insertDatab = DB::table('rbb_0301')->insert($insertb);
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
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic' => $value->c1,
                        'row'   => $value->c2,
                        'flag'  => $value->c3,
                        'komponen'  => '0'.$value->c4,
                        'pos'   => $value->c5,
                        'kinerja_okt'   => $value->c6,
                        'pro_des'   => $value->c7,
                        'pro_juni'  => $value->c8,
                        'pro_des1'  => $value->c9,
                        'pro_des2'  => $value->c10,
                        'pro_des3'  => $value->c11,
                        ];
                    }
 
                    if(!empty($insertc)){
 
                        $insertDatac = DB::table('rbb_0401')->insert($insertc);
                        if ($insertDatac) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_d) && $rbb_d->count()){
 
                    foreach ($rbb_d as $key => $value) {
                        $insertd[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic'     => $value->d1,
                        'row'       => $value->d2,
                        'flag'      => $value->d3,
                        'komponen'      => '0'.$value->d4,
                        'rasio'     => $value->d5,
                        'kinerja_okt_pembilang'     => $value->d6,
                        'kinerja_okt_penyebut'      => $value->d7,
                        'kinerja_persen'        => $value->d8,
                        'proyeksi_des_pembilang'        => $value->d9,
                        'proyeksi_des_penyebut'     => $value->d10,
                        'proyeksi_des_persen'       => $value->d11,
                        'proyeksi_jun_pembilang'        => $value->d12,
                        'proyeksi_jun_penyebut'     => $value->d13,
                        'proyeksi_jun_persen'       => $value->d14,
                        'proyeksi_des_pembilang_1'      => $value->d15,
                        'proyeksi_des_penyebut_1'       => $value->d16,
                        'proyeksi_des_persen_1'     => $value->d17,
                        'proyeksi_des_pembilang_2'      => $value->d18,
                        'proyeksi_des_penyebut_2'       => $value->d19,
                        'proyeksi_des_persen_2'     => $value->d20,
                        'proyeksi_des_pembilang_3'      => $value->d21,
                        'proyeksi_des_penyebut_3'       => $value->d22,
                        'proyeksi_des_persen_3'     => $value->d23,                       
                        ];
                    }
 
                    if(!empty($insertd)){
 
                        $insertDatad = DB::table('rbb_0501')->insert($insertd);
                        if ($insertDatad) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_e) && $rbb_e->count()){
 
                    foreach ($rbb_e as $key => $value) {
                        $inserte[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic'     => $value->e1,
                        'row'       => $value->e2,
                        'flag'      => $value->e3,
                        'komponen'      => '0'.$value->e4,
                        'kel'       => $value->e5,
                        'kinerja_okt'       => $value->e6,
                        'pro_des'       => $value->e7,
                        'pro_juni'      => $value->e8,
                        'pro_des1'      => $value->e9,
                        ];
                    }
 
                    if(!empty($inserte)){
 
                        $insertDatae = DB::table('rbb_0601')->insert($inserte);
                        if ($insertDatae) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_f) && $rbb_f->count()){
 
                    foreach ($rbb_f as $key => $value) {
                        $insertf[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic'     => $value->f1,
                        'row'       => $value->f2,
                        'flag'      => $value->f3,
                        'komponen'  => '0'.$value->f4,
                        'kode_ref'      => $value->f5,
                        'jenis'     => $value->f6,
                        'nama'      => $value->f7,
                        'kinerja_okt'       => $value->f8,
                        'pro_des'       => $value->f9,
                        'pro_juni'      => $value->f10,
                        'pro_des1'      => $value->f11,
                        ];
                    }
 
                    if(!empty($insertf)){
 
                        $insertDataf = DB::table('rbb_0701')->insert($insertf);
                        if ($insertDataf) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_g) && $rbb_g->count()){
 
                    foreach ($rbb_g as $key => $value) {
                        $insertg[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic'     => $value->g1,
                        'row'       => $value->g2,
                        'flag'      => $value->g3,
                        'komponen'      => '0'.$value->g4,
                        'kode_ref'      => $value->g5,
                        'jenis'     => $value->g6,
                        'jumlah'        => $value->g7,
                        'kinerja_okt'       => $value->g8,
                        'pro_des'       => $value->g9,
                        'pro_juni'      => $value->g10,
                        'pro_des1'      => $value->g11,

                        ];
                    }
 
                    if(!empty($insertg)){
 
                        $insertDatag = DB::table('rbb_0801')->insert($insertg);
                        if ($insertDatag) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_h) && $rbb_h->count()){
 
                    foreach ($rbb_h as $key => $value) {
                        $inserth[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic'     => $value->h1,
                        'row'       => $value->h2,
                        'flag'      => $value->h3,
                        'komponen'      => '0'.$value->h4,
                        'jenis'     => $value->h5,
                        'kinerja_okt'       => $value->h6,
                        'pro_des'       => $value->h7,
                        'pro_juni'      => $value->h8,
                        'pro_des1'      => $value->h9,

                        ];
                    }
 
                    if(!empty($inserth)){
 
                        $insertDatah = DB::table('rbb_0802')->insert($inserth);
                        if ($insertDatah) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_i) && $rbb_i->count()){
 
                    foreach ($rbb_i as $key => $value) {
                        $inserti[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic'     => $value->i1,
                        'row'       => $value->i2,
                        'flag'      => $value->i3,
                        'komponen'      => '0'.$value->i4,
                        'sandi_bank'        => $value->i5,
                        'kinerja_okt'       => $value->i6,
                        'pro_des'       => $value->i7,
                        'pro_juni'      => $value->i8,
                        'pro_des1'      => $value->i9,

                        ];
                    }
 
                    if(!empty($inserti)){
 
                        $insertDatai = DB::table('rbb_0803')->insert($inserti);
                        if ($insertDatai) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_j) && $rbb_j->count()){
 
                    foreach ($rbb_j as $key => $value) {
                        $insertj[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic'     => $value->j1,
                        'row'       => $value->j2,
                        'flag'      => $value->j3,
                        'komponen'      => $value->j4,
                        'jenis'     => $value->j5,
                        'jumlah'        => $value->j6,
                        'kinerja_okt'       => $value->j7,
                        'pro_des'       => $value->j8,
                        'pro_juni'      => $value->j9,
                        'pro_des1'      => $value->j10,

                        ];
                    }
 
                    if(!empty($insertj)){
 
                        $insertDataj = DB::table('rbb_0804')->insert($insertj);
                        if ($insertDataj) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_k) && $rbb_k->count()){
 
                    foreach ($rbb_k as $key => $value) {
                        $insertk[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic'     => $value->k1,
                        'row'       => $value->k2,
                        'flag'      => $value->k3,
                        'komponen'      => $value->k4,
                        'kode_sektor'       => $value->k5,
                        'sektor'        => $value->k6,
                        'kinerja_okt'       => $value->k7,
                        'pro_des'       => $value->k8,
                        'pro_juni'      => $value->k9,
                        'pro_des1'      => $value->k10,
                        ];
                    }
 
                    if(!empty($insertk)){
 
                        $insertDatak = DB::table('rbb_0805')->insert($insertk);
                        if ($insertDatak) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_l) && $rbb_l->count()){
 
                    foreach ($rbb_l as $key => $value) {
                        $insertl[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic'     => $value->l1,
                        'row'       => $value->l2,
                        'flag'      => $value->l3,
                        'komponen'      => $value->l4,
                        'jenis'     => $value->l5,
                        'kinerja_okt'       => $value->l6,
                        'pro_des'       => $value->l7,
                        'pro_juni'      => $value->l8,
                        'pro_des1'      => $value->l9,
                        ];
                    }
 
                    if(!empty($insertl)){
 
                        $insertDatal = DB::table('rbb_0806')->insert($insertl);
                        if ($insertDatal) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_m) && $rbb_m->count()){
 
                    foreach ($rbb_m as $key => $value) {
                        $insertm[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic'     => $value->m1,
                        'row'       => $value->m2,
                        'flag'      => $value->m3,
                        'komponen'      => $value->m4,
                        'jenis'     => $value->m5,
                        'kinerja_okt'       => $value->m6,
                        'pro_des'       => $value->m7,
                        'pro_juni'      => $value->m8,
                        'pro_des1'      => $value->m9,

                        ];
                    }
 
                    if(!empty($insertm)){
 
                        $insertDatam = DB::table('rbb_0807')->insert($insertm);
                        if ($insertDatam) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_n) && $rbb_n->count()){
 
                    foreach ($rbb_n as $key => $value) {
                        $insertn[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic'     => $value->n1,
                        'row'       => $value->n2,
                        'flag'      => $value->n3,
                        'komponen'      => $value->n4,
                        'modal'     => $value->n5,
                        'kinerja_okt'       => $value->n6,
                        'pro_des'       => $value->n7,
                        'pro_juni'      => $value->n8,
                        'pro_des1'      => $value->n9,
                        'pro_des2'      => $value->n10,

                        ];
                    }
 
                    if(!empty($insertn)){
 
                        $insertDatan = DB::table('rbb_0901')->insert($insertn);
                        if ($insertDatan) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_o) && $rbb_o->count()){
 
                    foreach ($rbb_o as $key => $value) {
                        $inserto[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic'     => $value->o1,
                        'row'       => $value->o2,
                        'flag'      => $value->o3,
                        'komponen'      => $value->o4,
                        'ket'       => $value->o5,
                        'kinerja_okt'       => $value->o6,
                        'pro_des'       => $value->o7,
                        'pro_juni'      => $value->o8,
                        'pro_des1'      => $value->o9,
                        'pro_des2'      => $value->o10,
                        'pro_des3'      => $value->o11,
                        'pro_des4'      => $value->o12,
                        'pro_des5'      => $value->o13,

                        ];
                    }
 
                    if(!empty($inserto)){
 
                        $insertDatao = DB::table('rbb_0902')->insert($inserto);
                        if ($insertDatao) {
                            Session::flash('success', 'Your Data has successfully imported');
                        }else {                        
                            Session::flash('error', 'Error inserting the data..');
                            return back();
                        }
                    }
                }

                if(!empty($rbb_p) && $rbb_p->count()){
 
                    foreach ($rbb_p as $key => $value) {
                        $insertp[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'periode'   => $value->periode,
                        'id'        => $value->no,
                        'basic'     => $value->p1,
                        'row'       => $value->p2,
                        'flag'      => $value->p3,
                        'komponen'      => $value->p4,
                        'ket_bisnis'        => $value->p5,
                        'nama'      => $value->p6,
                        'kinerja_okt'       => $value->p7,
                        'pro_des'       => $value->p8,
                        'pro_juni'      => $value->p9,
                        'pro_des1'      => $value->p10,
                        'pro_des2'      => $value->p11,
                        'pro_des3'      => $value->p12,

                        ];
                    }
 
                    if(!empty($insertp)){
 
                        $insertDatap = DB::table('rbb_0903')->insert($insertp);
                        if ($insertDatap) {
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

    



}
