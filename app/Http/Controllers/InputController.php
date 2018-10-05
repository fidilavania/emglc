<?php

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
use App\mst_camat;
use App\kab;
use App\sdm_photo;
use App\jabatan_mst;
use App\kantor_mst;
use App\master_kantor;
use DB;
use Auth;
use Log;
use Input;

class InputController extends Controller
{

    public function viewFormMateri()
    {
        $kodya = DB::connection('mysql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        return view('input.forminputmateri',compact('kodya'));   
    }

    public function saveDataMateri(Request $request,$nonsb)
    {

        $lastnonsb = materi::max('kode_modul');
        $nonsb = (int) substr($lastnonsb,3,3) + 1;

        
        // Log::info(substr($lastnonsb,3,3) );
        // Log::info(json_encode('kode_modul'));

        $materi = new materi;
        $materi->kode_modul = 'EMG'.str_pad($nonsb, 3, '0',STR_PAD_LEFT);
        // $materi->kode_modul = $nonsb;
        $materi->tgl_input = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')));
        // $materi->tanggal = date('Y-m-d H:i:s',strtotime($request->input('tanggal_laksana')));
        $materi->opr = strtoupper($request->input('opr'));
        $materi->nama_modul = strtoupper($request->input('namamodul'));
        $materi->fasilitator = strtoupper($request->input('input_fasilitator'));
        $materi->peserta = strtoupper($request->input('peserta'));
        $materi->silabus = ($request->input('silabus'));
        $materi->durasi = strtoupper($request->input('durasi'));
        $materi->biaya = DataController::formatangka($request->input('biaya'));
        $materi->materi = '';
        $materi->save();
        
       
        return redirect('/viewmateri/'.$materi->kode_modul);
        
    }

    public function viewFormMateriEdit($nonsb)
    {
        $kodya = DB::connection('mysql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $materi = materi::where('kode_modul',$nonsb)->first();
        return view('edit.formeditmateri',compact('kodya','materi'));   
    }

    public function saveDataMateriEdit(Request $request,$nonsb)
    {
       
        DB::connection('mysql')->table('materi')->where('kode_modul',$request->input('kode_modul'))->update([
        'kode_modul' => ($request->input('kode_modul')),
        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
        'opr' => strtoupper($request->input('opr')),
        'nama_modul' => strtoupper($request->input('namamodul')),
        // 'tanggal' => ($request->input('tanggal_laksana')),
        'fasilitator' => strtoupper($request->input('input_fasilitator')),
        'peserta' => strtoupper($request->input('peserta')),
        'silabus' => ($request->input('silabus')),
        'durasi' => strtoupper($request->input('durasi')),
        'biaya' => DataController::formatangka($request->input('biaya'))
        ]);
        
       
        return redirect('/viewmateri/'.$request->input('kode_modul'));
        
    }
   
    public function viewFormDaftar($nonsb)
    {
        $sdm = DB::connection('mysql')->table('sdm')->get();
        $materi = DB::connection('mysql')->table('materi')->where('kode_modul',$nonsb)->first();
        $matdet = materi_detail::where('kode_modul',$nonsb)->first();
        
        return view('input.formdetail',compact('sdm','materi','matdet'));   
    }

    public function saveDaftar(Request $request,$nonsb)
    {
        $detail = materi_detail::where('kode_modul',$nonsb)->get();

        $detail = new materi_detail;
        $detail->tgl_input = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')));
        $detail->opr = strtoupper($request->input('opr'));
        $detail->kode_modul = strtoupper($request->input('kode_modul'));
        $detail->tgl_mulai_1 = date('Y-m-d H:i:s',strtotime($request->input('tanggal_laksana1')));
        $detail->tgl_mulai_2 = date('Y-m-d H:i:s',strtotime($request->input('tanggal_laksana2')));
        $detail->tgl_mulai_3 = date('Y-m-d H:i:s',strtotime($request->input('tanggal_laksana3')));
        $detail->tgl_mulai_4 = date('Y-m-d H:i:s',strtotime($request->input('tanggal_laksana4')));
        $detail->tgl_mulai_5 = date('Y-m-d H:i:s',strtotime($request->input('tanggal_laksana5')));
        $detail->tgl_end_1 = date('Y-m-d H:i:s',strtotime($request->input('tanggal_end_1')));
        $detail->tgl_end_2 = date('Y-m-d H:i:s',strtotime($request->input('tanggal_end_2')));
        $detail->tgl_end_3 = date('Y-m-d H:i:s',strtotime($request->input('tanggal_end_3')));
        $detail->tgl_end_4 = date('Y-m-d H:i:s',strtotime($request->input('tanggal_end_4')));
        $detail->tgl_end_5 = date('Y-m-d H:i:s',strtotime($request->input('tanggal_end_5')));
        $detail->lokasi_1 = strtoupper($request->input('lokasi1'));
        $detail->lokasi_2 = strtoupper($request->input('lokasi2'));
        $detail->lokasi_3 = strtoupper($request->input('lokasi3'));
        $detail->lokasi_4 = strtoupper($request->input('lokasi4'));
        $detail->lokasi_5 = strtoupper($request->input('lokasi5'));
        $detail->save();

        return redirect('/daftar/'.$detail->kode_modul);
    }

    public function viewFormJabatan()
    {
        $jabatan = DB::connection('mysql')->table('mst_jabatan')->get();

        return view('input.forminputjabatan',compact('jabatan'));   
    }

    public function saveDataJabatan(Request $request,$nonsb)
    {
        $lastnonsb = mst_jabatan::max('kode');
        $nonsb = (int) $lastnonsb + 1;

    	$mstjabatan = new mst_jabatan;
        $mstjabatan->kode = str_pad($nonsb, 3, '0',STR_PAD_LEFT);
		$mstjabatan->grade = strtoupper($request->input('input_grade'));
		$mstjabatan->jabatankantor = ($request->input('input_jabatan'));

        $mstjabatan->save();
        
        // $lastnonsb = jabatan_mst::max('kode');
        // $nonsb = (int) $lastnonsb + 1;

        // $jabatan_mst = new jabatan_mst;
        // $jabatan_mst->kode = str_pad($nonsb, 3, '0',STR_PAD_LEFT);
        // $jabatan_mst->grade = strtoupper($request->input('input_grade'));
        // $jabatan_mst->jabatankantor = ($request->input('input_jabatan'));

        // $jabatan_mst->save();

        return redirect('/addjabatan');
    }

    public function viewFormKantor()
    {
        // $kantor = DB::connection('mysql')->table('mst_kantor')->get();
        $kantor = DB::connection('mysql')->table('master_kantor')->get();

        return view('input.forminputkantor',compact('kantor'));   
    }

    public function saveDataKantor(Request $request,$nonsb)
    {
        $mstkantor = new mst_kantor;
        $mstkantor->kode_kantor = strtoupper($request->input('input_kode'));
        $mstkantor->nama = strtoupper($request->input('input_nama'));
        $mstkantor->save();
        
        return redirect('/addkantor');

        // $kantor_mst = new kantor_mst;
        // $kantor_mst->kode_kantor = strtoupper($request->input('input_kode'));
        // $kantor_mst->nama = strtoupper($request->input('input_nama'));
        // $kantor_mst->save();
        
        return redirect('/addkantor');
    }

    public function viewFormKlien()
    {
        $kodya = DB::connection('mysql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        // $kelurahan = DB::connection('mysql')->table('mst_kelurahan')->where('status','ada')->orderBy('nama','asc')->get();
        // $kecamatan = DB::connection('mysql')->table('mst_kecamatan')->where('status','ada')->orderBy('nama','asc')->get();
        // $kab = DB::connection('mysql')->table('mst_kabupaten')->where('status','ada')->orderBy('nama','asc')->get();
        $kantor = DB::connection('mysql')->table('master_kantor')->get();

        return view('input.forminputklien',compact('kodya','kelurahan','kecamatan','kab','kantor'));   
    }

    public function saveDataKlien(Request $request,$nonsb)
    {
    	$lastnonsb = klien::max('no_reg');
        $nonsb = (int) $lastnonsb + 1;

		// Log::info(json_encode($dati));
    	$klien = new klien;

    	// if($request->input('input_status') == '0000'){
    	// 	$klien->no_reg = trim($request->input('nama_ub'),' ').'0000';
    	// }else
    	// if($request->input('input_status') == '0001'){
    	// 	$nonsb = (int) substr($lastnonsb,-2,2) + 1;
    	// 	$klien->no_reg = trim($request->input('nama_ub'),' ').'00'.str_pad($nonsb, 2, '0',STR_PAD_LEFT);
    	// }else
    	// if($request->input('input_status') == '0100'){
    	// 	$nonsb = (int) substr($lastnonsb,-4,2) + 1;
    	// 	$klien->no_reg = trim($request->input('nama_ub'),' ').str_pad($nonsb, 2, '0',STR_PAD_LEFT).'00';
    	// }else
    	// if($request->input('input_status') == '0101'){
    	// 	$nonsb = (int) substr($lastnonsb,-2,2) + 1;
    	// 	$klien->no_reg = trim($request->input('nama_ub'),' ').'01'.str_pad($nonsb, 2, '0',STR_PAD_LEFT);
    	// }
    	// Log::info($dati);

    	$klien->tgl_input = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')));
		$klien->opr = strtoupper($request->input('opr'));
		$klien->kantor = strtoupper($request->input('nama_ub'));
        $klien->no_reg = trim($request->input('nama_ub'),' ').str_pad($nonsb, 4, '0',STR_PAD_LEFT);
		$klien->alamat = strtoupper($request->input('input_alamat'));
		$klien->rtrw = $request->input('input_rt').'/'.$request->input('input_rw');
		$klien->lurah = strtoupper($request->input('input_kelurahan'));
		$klien->camat = strtoupper($request->input('input_kecamatan'));
		$klien->kodya = strtoupper($request->input('input_kodya'));
		$klien->kodepos = strtoupper($request->input('input_kodepos'));
		$klien->tgl_berdiri = date('Y-m-d H:i:s',strtotime($request->input('input_tanggalberdiri')));
		$klien->no_tlp = ($request->input('tlp'));
		$klien->web = ($request->input('web'));
		$klien->fb = ($request->input('facebook'));
		$klien->ig = ($request->input('instagram'));
		$klien->save();

		return redirect('/dataklien');
    }
    

    public function viewFormKlienEdit($nonsb)
    {
        $kodya = DB::connection('mysql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $kantor = DB::connection('mysql')->table('master_kantor')->get();
        $klien = klien::where('no_reg',$nonsb)->first();

        return view('edit.formeditklien',compact('kodya','kantor','klien'));   
    }

    public function saveDataKlienEdit(Request $request,$nonsb)
    {
        DB::connection('mysql')->table('klien')->where('no_reg',$request->input('no_reg'))->update([
        'no_reg'    => ($request->input('no_reg')),
        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
        'opr' => strtoupper($request->input('opr')),
        'kantor' => strtoupper($request->input('nama_ub')),
        'alamat' => strtoupper($request->input('input_alamat')),
        'rtrw' => $request->input('input_rt'),
        'lurah' => strtoupper($request->input('input_kelurahan')),
        'camat' => strtoupper($request->input('input_kecamatan')),
        'kodya' => strtoupper($request->input('input_kodya')),
        'kodepos' => strtoupper($request->input('input_kodepos')),
        'tgl_berdiri' => date('Y-m-d 00:00:00',strtotime($request->input('input_tanggalberdiri'))),
        'no_tlp' => ($request->input('tlp')),
        'web' => ($request->input('web')),
        'fb' => ($request->input('facebook')),
        'ig' => ($request->input('instagram'))
        ]);

        return redirect('/dataklien');
    }

}



