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
        return view('rbb/import');   
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

                if(!empty($head) && $head->count()){
 
                    foreach ($head as $key => $value) {
                        $inserthead[] = [
                        'kode'      => rand(1,9999999999),
                        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
                        'opr'       => strtoupper($request->input('opr')),
                        'no_kantor' => strtoupper($request->input('kantor')),
                        'flag'  => $value->flag,
                        'kode_sektor'   => $value->kode_sektor,
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
                        'komponen'                  => $value->a4,
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
                        'komponen'  => $value->b4,
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
                        'komponen'  => $value->c4,
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
                        'komponen'      => $value->d4,
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
                        'komponen'      => $value->e4,
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
                        'komponen'  => $value->f4,
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
                        'komponen'      => $value->g4,
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
                        'komponen'      => $value->h4,
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
                        'komponen'      => $value->i4,
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
