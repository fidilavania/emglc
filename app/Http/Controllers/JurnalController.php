<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ABCKantor;
use App\JurHead;
use App\JurDet;
use App\posting;
use App\perkiraan;
use App\Http\Controllers\ABCController;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\User;
use Auth;
use Log;
use DB;
use Hash;
use Input;

class JurnalController extends Controller
{
    public function viewJurnal(Request $request,$tanggaldari=null,$tanggalsampai=null,$namakantor=null)
    {
    	//$kantor = ABCKantor::whereRaw('status IN ("PUSAT","CABANG")')->get();
        $kantor = ABCKantor::all();
        $user = Auth::user();
        if(($tanggaldari <> null) && ($tanggalsampai <> null)){
            $page = (Input::get('page')) ? Input::get('page') : 1; // Get the current page for the request
            $limit = 20;
            $offset = ($page-1) * $limit;

            if($namakantor <> null){
                $total = JurHead::where('tanggal','>=',date('Y-m-d',strtotime($tanggaldari)))->where('tanggal','<=',date('Y-m-d',strtotime($tanggalsampai)))->where('kantor','=',$namakantor)->whereNull('status')->count();
                $jurhead = JurHead::where('tanggal','>=',date('Y-m-d',strtotime($tanggaldari)))->where('tanggal','<=',date('Y-m-d',strtotime($tanggalsampai)))->where('kantor','=',$namakantor)->whereNull('status')->skip($offset)->take($limit)->get();
                foreach ($jurhead as $j) {
                    ///$j->det = JurDet::where('nobukti',$j->nobukti)->whereRaw('noperk = ')->get();
                    $j->detdebet = DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.noperk,periode,nobukti,ket,jmldebet,jmlkredit,nameshort FROM a_jurdet_test,a_perkiraan WHERE nobukti='".$j->nobukti."' AND a_jurdet_test.noperk=a_perkiraan.noperk AND jmldebet > 0;"));
                    $j->detkredit = DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.noperk,periode,nobukti,ket,jmldebet,jmlkredit,nameshort FROM a_jurdet_test,a_perkiraan WHERE nobukti='".$j->nobukti."' AND a_jurdet_test.noperk=a_perkiraan.noperk AND jmlkredit > 0;"));
                    //$j->detdebet = DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.noperk,periode,nobukti,ket,jmldebet,jmlkredit,nameshort FROM a_jurdet_test,a_perkiraan WHERE nobukti='".$j->nobukti."' AND a_jurdet_test.noperk=a_perkiraan.noperk;"));
                }
                $pagination = new Paginator($jurhead, $total, $limit,$page,array("path" => url('/jurnal/'.$tanggaldari.'/'.$tanggalsampai)));
            } else {
                $total = JurHead::where('tanggal','>=',date('Y-m-d',strtotime($tanggaldari)))->where('tanggal','<=',date('Y-m-d',strtotime($tanggalsampai)))->whereNull('status')->count();
                $jurhead = JurHead::where('tanggal','>=',date('Y-m-d',strtotime($tanggaldari)))->where('tanggal','<=',date('Y-m-d',strtotime($tanggalsampai)))->whereNull('status')->skip($offset)->take($limit)->get();
                foreach ($jurhead as $j) {
                    //$j->det = JurDet::where('nobukti',$j->nobukti)->whereRaw('noperk = ')->get();
                    $j->detdebet = DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.noperk,periode,nobukti,ket,jmldebet,jmlkredit,nameshort FROM a_jurdet_test,a_perkiraan WHERE nobukti='".$j->nobukti."' AND a_jurdet_test.noperk=a_perkiraan.noperk AND jmldebet > 0;"));
                    $j->detkredit = DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.noperk,periode,nobukti,ket,jmldebet,jmlkredit,nameshort FROM a_jurdet_test,a_perkiraan WHERE nobukti='".$j->nobukti."' AND a_jurdet_test.noperk=a_perkiraan.noperk AND jmlkredit > 0;"));
                    //$j->detdebet = DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.noperk,periode,nobukti,ket,jmldebet,jmlkredit,nameshort FROM a_jurdet_test,a_perkiraan WHERE nobukti='".$j->nobukti."' AND a_jurdet_test.noperk=a_perkiraan.noperk;"));
                }
                $pagination = new Paginator($jurhead, $total, $limit,$page,array("path" => url('/jurnal/'.$tanggaldari.'/'.$tanggalsampai)));
            }
            return view('laporan.jurnal',compact('kantor','jurhead','pagination','tanggaldari','tanggalsampai','namakantor'));
        } else {
            return view('laporan.jurnal',compact('kantor'));
        }
    }
    public function insertJurnal($tanggaldari=null,$tanggalsampai=null,$namakantor=null)
    {
        $perk = perkiraan::select('noperk','nameshort')->whereRaw('noperk NOT IN (SELECT parent from a_perkiraan group by parent)')->get();
        $kantor = ABCKantor::all();
        return view('koreksi.insertjurnal',compact('perk','kantor','tanggaldari','tanggalsampai','namakantor'));
    }
    public function saveInsertJurnal(Request $request)
    {
        $nextno = JurHead::where('periode',date('my',strtotime($request->input('input_tanggal_jurnal'))))->count();
        $nextno = str_pad(($nextno + 1),5,'0',STR_PAD_LEFT);

        DB::connection('pgsql')->table('a_jurhead_test')->insert(
            ['periode' => date('my'), 'nobukti' => date('my').'~'.$nextno, 'keterangan' => $request->input('input_keterangan'), 'tanggal' => date('Y-m-d',strtotime($request->input('input_tanggal_jurnal'))), 'kantor' => strtoupper($request->input('input_namakantor'))]
        );
        if(count($request->input('input_noperk_debet')) > 0){
            for($i=0;$i<count($request->input('input_noperk_debet'));$i++){
                if(($request->input('input_noperk_debet')[$i] <> null) || ($request->input('input_noperk_debet')[$i] <> '')){
                    DB::connection('pgsql')->table('a_jurdet_test')->insert(
                        ['periode' => date('my'), 'nobukti' => date('my').'~'.$nextno, 'noperk' => $request->input('input_noperk_debet')[$i], 'ket' => $request->input('input_keterangan'), 'jmldebet' => ABCController::formatangka($request->input('input_jml_debet')[$i]), 'jmlkredit' => 0]
                    );
                }
            }
        }
        if(count($request->input('input_noperk_kredit')) > 0){
            for($i=0;$i<count($request->input('input_noperk_kredit'));$i++){
                if(($request->input('input_noperk_kredit')[$i] <> null) || ($request->input('input_noperk_kredit')[$i] <> '')){
                    DB::connection('pgsql')->table('a_jurdet_test')->insert(
                        ['periode' => date('my'), 'nobukti' => date('my').'~'.$nextno, 'noperk' => $request->input('input_noperk_kredit')[$i], 'ket' => $request->input('input_keterangan'), 'jmldebet' => 0, 'jmlkredit' => ABCController::formatangka($request->input('input_jml_kredit')[$i])]
                    );
                }
            }
        }

        $tanggaldari = $request->input('input_tanggaldari');
        $tanggalsampai = $request->input('input_tanggalsampai');
        $namakantor = $request->input('input_kantor');
        $kantor = ABCKantor::all();

        if(($tanggaldari <> null) && ($tanggalsampai <> null)){
            if($namakantor <> null){
                return redirect('/jurnal/'.$tanggaldari.'/'.$tanggalsampai.'/'.$namakantor);
            } else {
                return redirect('/jurnal/'.$tanggaldari.'/'.$tanggalsampai);
            }
        } else {
            return redirect('/jurnal');
        }            
    }
    public function editJurnal($nobukti,$tanggaldari=null,$tanggalsampai=null,$namakantor=null)
    {
        $perk = perkiraan::select('noperk','nameshort')->whereRaw('noperk NOT IN (SELECT parent from a_perkiraan group by parent)')->get();
        $jurhead = JurHead::where('nobukti',$nobukti)->first();
        $jurdetdebet = DB::connection('pgsql')->select(DB::raw("Select periode,nobukti,a_jurdet_test.noperk,ket,jmldebet,jmlkredit,nameshort from a_jurdet_test,a_perkiraan where nobukti='".$nobukti."' AND a_jurdet_test.noperk = a_perkiraan.noperk AND jmldebet > 0"));
        $jurdetkredit = DB::connection('pgsql')->select(DB::raw("Select periode,nobukti,a_jurdet_test.noperk,ket,jmldebet,jmlkredit,nameshort from a_jurdet_test,a_perkiraan where nobukti='".$nobukti."' AND a_jurdet_test.noperk = a_perkiraan.noperk AND jmlkredit > 0"));
        return view('koreksi.editjurnal',compact('jurhead','jurdetdebet','jurdetkredit','perk','tanggaldari','tanggalsampai','namakantor'));
    }
    public function saveEditJurnal(Request $request,$nobukti)
    {
        $jurheadold = JurHead::where('nobukti',$nobukti)->first();
        JurHead::where("nobukti",$nobukti)->update(['status' => 'HAPUS']);

        $nextno = JurHead::where('periode',date('my',strtotime($jurheadold->tanggal)))->count();
        $nextno = str_pad(($nextno + 1),5,'0',STR_PAD_LEFT);

        DB::connection('pgsql')->table('a_jurhead_test')->insert(
            ['periode' => date('my'), 'nobukti' => date('my').'~'.$nextno, 'keterangan' => $request->input('input_keterangan'), 'tanggal' => date('Y-m-d',strtotime($jurheadold->tanggal)), 'kantor' => strtoupper($jurheadold->kantor)]
        );
        if(count($request->input('input_noperk_debet')) > 0){
            for($i=0;$i<count($request->input('input_noperk_debet'));$i++){
                if(($request->input('input_noperk_debet')[$i] <> null) || ($request->input('input_noperk_debet')[$i] <> '')){
                    DB::connection('pgsql')->table('a_jurdet_test')->insert(
                        ['periode' => date('my'), 'nobukti' => date('my').'~'.$nextno, 'noperk' => $request->input('input_noperk_debet')[$i], 'ket' => $request->input('input_keterangan'), 'jmldebet' => ABCController::formatangka($request->input('input_jml_debet')[$i]), 'jmlkredit' => 0]
                    );
                }
            }
        }
        if(count($request->input('input_noperk_kredit')) > 0){
            for($i=0;$i<count($request->input('input_noperk_kredit'));$i++){
                if(($request->input('input_noperk_kredit')[$i] <> null) || ($request->input('input_noperk_kredit')[$i] <> '')){
                    DB::connection('pgsql')->table('a_jurdet_test')->insert(
                        ['periode' => date('my'), 'nobukti' => date('my').'~'.$nextno, 'noperk' => $request->input('input_noperk_kredit')[$i], 'ket' => $request->input('input_keterangan'), 'jmldebet' => 0, 'jmlkredit' => ABCController::formatangka($request->input('input_jml_kredit')[$i])]
                    );
                }
            }
        }

        $tanggaldari = $request->input('input_tanggaldari');
        $tanggalsampai = $request->input('input_tanggalsampai');
        $namakantor = $request->input('input_kantor');
        $kantor = ABCKantor::all();

        if(($tanggaldari <> null) && ($tanggalsampai <> null)){
            if($namakantor <> null){
                return redirect('/jurnal/'.$tanggaldari.'/'.$tanggalsampai.'/'.$namakantor);
            } else {
                return redirect('/jurnal/'.$tanggaldari.'/'.$tanggalsampai);
            }
        } else {
            return redirect('/jurnal');
        }            
    }
    public function hapusJurnal($nobukti,$tanggaldari=null,$tanggalsampai=null,$namakantor=null)
    {
        JurHead::where("nobukti",$nobukti)->update(['status' => 'HAPUS']);
        
        if($namakantor <> null){
            return redirect('/jurnal/'.$tanggaldari.'/'.$tanggalsampai.'/'.$namakantor);
        } else {
            return redirect('/jurnal/'.$tanggaldari.'/'.$tanggalsampai);
        }
    }
    //public function viewNeraca(Request $request,$inputbulan=null,$inputtahun=null,$namakantor=null)
    public function viewNeraca(Request $request,$tanggaldari=null,$tanggalsampai=null,$namakantor=null)
    {
        $kantor = ABCKantor::all();
        //$datenow = date('Y-m-01',strtotime($inputtahun.'-'.$inputbulan.))
        // if(($inputbulan <> null) && ($inputtahun <> null)){
        $totalawal = 0 ;
        $totalakhir = 0;
        $totaldebet = 0 ;
        $totalkredit = 0;
        if(($tanggaldari <> null) && ($tanggalsampai <> null)){
            $periode = date('my',strtotime($tanggaldari));
            $periodelalu = date('my', strtotime($tanggaldari.' first day of previous month'));
            // $periode = $inputbulan.date('y',strtotime($inputtahun));
            // $periodelalu = date('my', strtotime($inputtahun.'-'.$inputbulan.'-01'.' first day of previous month'));
            // Log::info($periode);
            // Log::info($periodelalu);
            // $page = (Input::get('page')) ? Input::get('page') : 1;
            // $limit = 20;
            // $offset = ($page-1) * $limit;

            if($namakantor <> null){
                // $saldoawal = posting::where('periode',$periodelalu)->get();
                // $saldoperkiraan = DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.periode,a_jurdet_test.noperk,nameshort,sum(jmldebet) as debet,sum(jmlkredit) as kredit from a_jurdet_test,a_perkiraan where periode = '".$periode."' AND a_jurdet_test.noperk=a_perkiraan.noperk AND nobukti IN (select nobukti from a_jurhead_test where kantor = '".$namakantor."' AND periode = '".$periode."') GROUP BY a_jurdet_test.noperk,nameshort,periode ORDER BY a_jurdet_test.noperk;"));
                $saldoperkiraan = DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.periode,a_jurdet_test.noperk,nameshort,sum(jmldebet) as debet,sum(jmlkredit) as kredit from a_jurdet_test,a_perkiraan where periode = '".$periode."' AND a_jurdet_test.noperk=a_perkiraan.noperk AND nobukti IN (select nobukti from a_jurhead_test where kantor = '".$namakantor."' AND periode = '".$periode."' AND tanggal >= '".date('Y-m-d', strtotime($tanggaldari))."' AND tanggal <= '".date('Y-m-d', strtotime($tanggalsampai))."' AND status IS NULL) GROUP BY a_jurdet_test.noperk,nameshort,periode ORDER BY a_jurdet_test.noperk;"));
                foreach ($saldoperkiraan as $s) {
                    $saldoawal = posting::where('periode',$periodelalu)->where('noperk',$s->noperk)->where('kantor',$namakantor)->first();
                    //$jempol = posting::where('periode',$periode)->where('noperk',$s->noperk)->where('kantor',$namakantor)->first();
                    $saldoperkawal = DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.periode,a_jurdet_test.noperk,nameshort,sum(jmldebet) as debet,sum(jmlkredit) as kredit from a_jurdet_test,a_perkiraan where periode = '".$periode."' AND a_jurdet_test.noperk='".$s->noperk."' AND a_jurdet_test.noperk=a_perkiraan.noperk AND nobukti IN (select nobukti from a_jurhead_test where kantor = '".$namakantor."' AND periode = '".$periode."' AND tanggal < '".date('Y-m-d', strtotime($tanggaldari))."' AND status IS NULL) GROUP BY a_jurdet_test.noperk,nameshort,periode ORDER BY a_jurdet_test.noperk;"));
                    if(count($saldoawal) > 0){
                        // $saldoperkiraan->awaldebet = $saldoawal->sld_debet;
                        // $saldoperkiraan->awalkredit = $saldoawal->sld_kredit;
                        $perk = perkiraan::where('noperk',$s->noperk)->first();
                        if($perk->dk == 'D'){
                            // $s->awal = $saldoawal->aw_debet-$saldoawal->aw_kredit;
                            // $s->akhir = $saldoawal->sld_debet-$saldoawal->sld_kredit;
                            if(count($saldoperkawal) > 0){
                                $s->awal = $saldoawal->saldoakhir+$saldoperkawal[0]->debet-$ssaldoperkawal[0]->kredit;
                            } else {
                                $s->awal = $saldoawal->saldoakhir;
                            }
                            $s->akhir = $s->awal+$s->debet-$s->kredit;
                        } else {
                            // $s->awal = $saldoawal->aw_kredit-$saldoawal->aw_debet;
                            // $s->akhir = $saldoawal->sld_kredit-$saldoawal->sld_debet;
                            if(count($saldoperkawal) > 0){
                                $s->awal = $saldoawal->saldoakhir+$saldoperkawal[0]->kredit-$saldoperkawal[0]->debet;
                            } else {
                                $s->awal = $saldoawal->saldoakhir;
                            }
                            $s->akhir = $s->awal+$s->kredit-$s->debet;
                        }
                        $totaldebet += $s->debet;
                        $totalkredit += $s->kredit;
                    }
                    $totalawal += $s->awal;
                    $totalakhir += $s->akhir;
                }
                //$pagination = new Paginator($jurhead, $total, $limit,$page,array("path" => url('/jurnal/'.$tanggaldari.'/'.$tanggalsampai)));
            } else {
                $saldoperkiraan = DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.periode,a_jurdet_test.noperk,nameshort,sum(jmldebet) as debet,sum(jmlkredit) as kredit from a_jurdet_test,a_perkiraan where periode = '".$periode."' AND a_jurdet_test.noperk=a_perkiraan.noperk AND nobukti IN (select nobukti from a_jurhead_test where periode = '".$periode."' AND tanggal >= '".date('Y-m-d', strtotime($tanggaldari))."' AND tanggal <= '".date('Y-m-d', strtotime($tanggalsampai))."' AND status IS NULL)GROUP BY a_jurdet_test.noperk,nameshort,periode ORDER BY a_jurdet_test.noperk;"));
                foreach ($saldoperkiraan as $s) {
                    $saldoawal = DB::connection('pgsql')->select(DB::raw("select sum(aw_debet) as awdebet,sum(aw_kredit) as awkredit,sum(sld_debet) as slddebet,sum(sld_kredit) as sldkredit,sum(saldoakhir) as saldoakhir from posting where periode = '".$periodelalu."' AND noperk='".$s->noperk."'"))[0];
                    //$jempol = DB::connection('pgsql')->select(DB::raw("select sum(aw_debet) as awdebet,sum(aw_kredit) as awkredit,sum(sld_debet) as slddebet,sum(sld_kredit) as sldkredit,sum(saldoakhir) as saldoakhir from posting where periode = '".$periodelalu."' AND noperk='".$s->noperk."'"))[0];
                    $saldoperkawal = DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.periode,a_jurdet_test.noperk,nameshort,sum(jmldebet) as debet,sum(jmlkredit) as kredit from a_jurdet_test,a_perkiraan where periode = '".$periode."' AND a_jurdet_test.noperk='".$s->noperk."' AND a_jurdet_test.noperk=a_perkiraan.noperk AND nobukti IN (select nobukti from a_jurhead_test where periode = '".$periode."' AND tanggal < '".date('Y-m-d', strtotime($tanggaldari))."' AND status IS NULL) GROUP BY a_jurdet_test.noperk,nameshort,periode ORDER BY a_jurdet_test.noperk;"));
                    if(count($saldoawal) > 0){
                        // $saldoperkiraan->awaldebet = $saldoawal->sld_debet;
                        // $saldoperkiraan->awalkredit = $saldoawal->sld_kredit;
                        $perk = perkiraan::where('noperk',$s->noperk)->first();
                        if($perk->dk == 'D'){
                            // $s->awal = $saldoawal->awdebet-$saldoawal->awkredit;
                            // $s->akhir = $saldoawal->slddebet-$saldoawal->sldkredit;
                            if(count($saldoperkawal) > 0){
                                $s->awal = $saldoawal->saldoakhir+$saldoperkawal[0]->debet-$saldoperkawal[0]->kredit;
                            } else {
                                $s->awal = $saldoawal->saldoakhir;
                            }
                            $s->akhir = $s->awal+$s->debet-$s->kredit;
                        } else {
                            // $s->awal = $saldoawal->awkredit-$saldoawal->awdebet;
                            // $s->akhir = $saldoawal->sldkredit-$saldoawal->slddebet;
                            if(count($saldoperkawal) > 0){
                                $s->awal = $saldoawal->saldoakhir+$saldoperkawal[0]->kredit-$saldoperkawal[0]->debet;
                            } else {
                                $s->awal = $saldoawal->saldoakhir;
                            }
                            $s->akhir = $s->awal+$s->kredit-$s->debet;
                        }
                        $totaldebet += $s->debet;
                        $totalkredit += $s->kredit;
                    }
                    $totalawal += $s->awal;
                    $totalakhir += $s->akhir;
                }
                //$pagination = new Paginator($jurhead, $total, $limit,$page,array("path" => url('/jurnal/'.$tanggaldari.'/'.$tanggalsampai)));
            }

            return view('laporan.neraca',compact('kantor','saldoperkiraan','tanggaldari','tanggalsampai','namakantor','totalawal','totalakhir','totaldebet','totalkredit'));
        } else {
            return view('laporan.neraca',compact('kantor'));
        }
    }
    public function viewDetJurnal(Request $request,$tanggaldari,$tanggalsampai,$noperk,$namakantor=null)
    {
        //$kantor = ABCKantor::whereRaw('status IN ("PUSAT","CABANG")')->get();
        //$kantor = ABCKantor::all();
        $perk = perkiraan::where('noperk',$noperk)->first();
        $user = Auth::user();
        $periode = date('my',strtotime($tanggaldari));
        $periodelalu = date('my', strtotime($tanggaldari.' first day of previous month'));
        $totalawal = 0 ;
        $totalakhir = 0 ;
        $totaldebet = 0 ;
        $totalkredit = 0 ;
        if(($tanggaldari <> null) && ($tanggalsampai <> null)){
            // $page = (Input::get('page')) ? Input::get('page') : 1; // Get the current page for the request
            // $limit = 20;
            // $offset = ($page-1) * $limit;

            if($namakantor <> null){
                $saldoawal = posting::where('periode',$periodelalu)->where('noperk',$noperk)->where('kantor',$namakantor)->first();
                $totalperklalu = DB::connection('pgsql')->select(DB::raw("select sum(jmldebet) as debet,sum(jmlkredit) as kredit FROM a_jurhead_test,a_jurdet_test,a_perkiraan WHERE kantor='".$namakantor."' AND tanggal<'".date('Y-m-d',strtotime($tanggaldari))."' AND a_jurhead_test.periode='".$periode."' AND a_jurdet_test.nobukti=a_jurhead_test.nobukti AND a_jurdet_test.noperk='".$noperk."' AND a_jurdet_test.noperk=a_perkiraan.noperk;"));
                //$total = count(DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.noperk,periode,nobukti,keterangan,jmldebet,jmlkredit,nameshort FROM a_jurhead_test,a_jurdet_test,a_perkiraan WHERE kantor='".$namakantor."' AND tanggal>='".date('Y-m-d',strtotime($tanggaldari))."' AND tanggal<='".date('Y-m-d',strtotime($tanggalsampai))."' AND a_jurdet_test.nobukti=a_jurhead_test.nobukti AND a_jurdet_test.noperk='".$noperk."' AND a_jurdet_test.noperk=a_perkiraan.noperk;")));
                $transperk = DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.noperk,a_jurhead_test.periode,a_jurhead_test.nobukti,keterangan,jmldebet,jmlkredit,nameshort FROM a_jurhead_test,a_jurdet_test,a_perkiraan WHERE kantor='".$namakantor."' AND tanggal>='".date('Y-m-d',strtotime($tanggaldari))."' AND tanggal<='".date('Y-m-d',strtotime($tanggalsampai))."' AND a_jurdet_test.nobukti=a_jurhead_test.nobukti AND a_jurdet_test.noperk='".$noperk."' AND a_jurdet_test.noperk=a_perkiraan.noperk;"));
                //$pagination = new Paginator($transperk, $total, $limit,$page,array("path" => url('/detjurnal/'.$tanggaldari.'/'.$tanggalsampai.'/'.$noperk.'/'.$namakantor)));
            } else {
                //$saldoawal = posting::where('periode',$periodelalu)->where('noperk',$noperk)->first();
                $saldoawal = DB::connection('pgsql')->select(DB::raw("select sum(saldoakhir) as saldoakhir from posting where periode = '".$periodelalu."' AND noperk='".$noperk."'"))[0];
                $totalperklalu = DB::connection('pgsql')->select(DB::raw("select sum(jmldebet) as debet,sum(jmlkredit) as kredit FROM a_jurhead_test,a_jurdet_test,a_perkiraan WHERE tanggal<'".date('Y-m-d',strtotime($tanggaldari))."' AND a_jurhead_test.periode='".$periode."' AND a_jurdet_test.nobukti=a_jurhead_test.nobukti AND a_jurdet_test.noperk='".$noperk."' AND a_jurdet_test.noperk=a_perkiraan.noperk;"));
                //$total = count(DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.noperk,periode,nobukti,keterangan,jmldebet,jmlkredit,nameshort FROM a_jurhead_test,a_jurdet_test,a_perkiraan WHERE tanggal>='".date('Y-m-d',strtotime($tanggaldari))."' AND tanggal<='".date('Y-m-d',strtotime($tanggalsampai))."' AND a_jurdet_test.nobukti=a_jurhead_test.nobukti AND a_jurdet_test.noperk='".$noperk."' AND a_jurdet_test.noperk=a_perkiraan.noperk;")));
                $transperk = DB::connection('pgsql')->select(DB::raw("select a_jurdet_test.noperk,a_jurhead_test.periode,a_jurhead_test.nobukti,keterangan,jmldebet,jmlkredit,nameshort FROM a_jurhead_test,a_jurdet_test,a_perkiraan WHERE tanggal>='".date('Y-m-d',strtotime($tanggaldari))."' AND tanggal<='".date('Y-m-d',strtotime($tanggalsampai))."' AND a_jurdet_test.nobukti=a_jurhead_test.nobukti AND a_jurdet_test.noperk='".$noperk."' AND a_jurdet_test.noperk=a_perkiraan.noperk;"));
                //$pagination = new Paginator($transperk, $total, $limit,$page,array("path" => url('/detjurnal/'.$tanggaldari.'/'.$tanggalsampai.'/'.$noperk)));
            }
            foreach ($transperk as $p) {
                if($p->jmldebet > 0){
                    $totaldebet += $p->jmldebet;
                } elseif($p->jmlkredit > 0) {
                    $totalkredit += $p->jmlkredit;
                }
            }
            if(count($totalperklalu) > 0){
                $totaldebetlalu = $totalperklalu[0]->debet;
                $totalkreditlalu = $totalperklalu[0]->kredit;
            } else {
                $totaldebetlalu = 0;
                $totalkreditlalu = 0;
            }
            if($perk->dk == 'D'){
                $totalawal = $saldoawal->saldoakhir+$totaldebetlalu-$totalkreditlalu;
                $totalakhir = $saldoawal->saldoakhir+$totaldebetlalu-$totalkreditlalu+$totaldebet-$totalkredit;
            } else {
                $totalawal = $saldoawal->saldoakhir+$totalkreditlalu-$totaldebetlalu;
                $totalakhir = $saldoawal->saldoakhir+$totalkreditlalu-$totaldebetlalu+$totalkredit-$totaldebet;
            }
            
            return view('laporan.detjurnal',compact('totaltransperk','transperk','perk','noperk','tanggaldari','tanggalsampai','namakantor','totalawal','totalakhir','totaldebet','totalkredit'));
        }
    }

}
