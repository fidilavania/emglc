<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\klien;
use App\materi;
use App\sdm;
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
use DB;
use Auth;
use Log;
use Input;

class InputController extends Controller
{
   
    public function viewFormJabatan()
    {
        $jabatan = DB::connection('pgsql')->table('mst_jabatan')->get();

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
        $kantor = DB::connection('pgsql')->table('mst_kantor')->get();

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


    public function viewFormSDM()
    {
        $kodya = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $gelar = DB::connection('pgsql')->table('mst_gelar')->orderBy('kode','asc')->orderBy('kode','asc')->get();
        $kelurahan = DB::connection('pgsql')->table('mst_kelurahan')->where('status','ada')->orderBy('nama','asc')->get();
        $kecamatan = DB::connection('pgsql')->table('mst_kecamatan')->where('status','ada')->orderBy('nama','asc')->get();
        $kab = DB::connection('pgsql')->table('mst_kabupaten')->where('status','ada')->orderBy('nama','asc')->get();
        $kantor = DB::connection('pgsql')->table('mst_kantor')->get();
        $jabatan = DB::connection('pgsql')->table('mst_jabatan')->get();
        $status = DB::connection('pgsql')->table('mst_statusrumah')->get();

        $sql3 ="SELECT mst_jabatan.jabatankantor,sdm.jabatan,mst_jabatan.kode
            from mst_jabatan,sdm 
            where 
            sdm.jabatan=mst_jabatan.kode";
        $lihat1 = DB::connection('pgsql')->select(DB::raw($sql3));

        return view('input.forminputsdm',compact('kodya','jabatan','kelurahan','kecamatan','kab','gelar','status','kantor','lihat1'));   
    }
    public function saveDataSDM(Request $request,$nonsb)
    {
        
        $lastnonsb = sdm::max('no_sdm');
        $nonsb = (int) $lastnonsb + 1;

        // Log::info(json_encode($dati));
        $sdm = new sdm;
        $sdm->no_sdm = str_pad($nonsb, 6, '0',STR_PAD_LEFT);
        $sdm->tgl_input = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')));
		$sdm->opr = strtoupper($request->input('opr'));
		$sdm->nama = strtoupper($request->input('input_nama'));
		$sdm->jenis_kel = strtoupper($request->input('input_jenis_kelamin'));
		$sdm->tempat_lahir = strtoupper($request->input('input_lahir'));
		$sdm->tgl_lahir = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir')));
		$sdm->notlp = strtoupper($request->input('input_telepon_rumah'));
		$sdm->nohp = strtoupper($request->input('input_hp'));
		$sdm->ktp = strtoupper($request->input('input_no_identitas'));
		$sdm->npwp = ($request->input('input_no_npwp'));
		$sdm->alamat_tinggal = strtoupper($request->input('input_alamat'));
		$sdm->rtrw_tinggal = $request->input('input_rt').'/'.$request->input('input_rw');
		$sdm->lurah_tinggal = strtoupper($request->input('input_kelurahan'));
		$sdm->camat_tinggal = strtoupper($request->input('input_kecamatan'));
		$sdm->kodya_tinggal = strtoupper($request->input('input_kodya'));
		$sdm->kodepos_tinggal = strtoupper($request->input('input_kodepos'));
		$sdm->alamat_ktp = strtoupper($request->input('input_alamatktp'));
		$sdm->rtrw_ktp = $request->input('input_rtktp').'/'.$request->input('input_rwktp');
		$sdm->lurah_ktp = strtoupper($request->input('input_kelurahanktp'));
		$sdm->camat_ktp = strtoupper($request->input('input_kecamatanktp'));
		$sdm->kodya_ktp = strtoupper($request->input('input_kodyaktp'));
		$sdm->kodepos_ktp = strtoupper($request->input('input_kodeposktp'));
		$sdm->kantor = strtoupper($request->input('kantor'));
		$sdm->jabatan = strtoupper($request->input('input_jabatan'));
		$sdm->pendidikan = strtoupper($request->input('pendidikan'));
		$sdm->email = ($request->input('input_email'));
		$sdm->tgl_kerja = date('Y-m-d H:i:s',strtotime($request->input('input_tglkerja')));
		$sdm->agama = strtoupper($request->input('input_agama'));
		$sdm->status_rumah = strtoupper($request->input('status_rumah'));
		$sdm->nikah = strtoupper($request->input('input_status_nikah'));
		$sdm->nama_ps = strtoupper($request->input('input_nama_ps'));
		$sdm->tempat_lahir_ps = date('Y-m-d H:i:s',strtotime($request->input('input_tempat_lahir_ps')));
		$sdm->lahir_ps = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir_ps')));
		$sdm->gelar_ps = strtoupper($request->input('input_gelar_ps'));
		$sdm->agama_ps = strtoupper($request->input('input_agama_ps'));
		$sdm->ktp_ps = ($request->input('input_ktp_ps'));
		$sdm->tlp_ps = ($request->input('input_nom_ps'));
		$sdm->alamat_ps = strtoupper($request->input('input_alamat_ps'));
		$sdm->kodepos_ps = strtoupper($request->input('input_kodepos_ps'));
		$sdm->rtrw_ps = $request->input('input_rt_ps').'/'.$request->input('input_rw_ps');
		$sdm->lurah_ps = strtoupper($request->input('input_kelurahan_ps'));
		$sdm->camat_ps = strtoupper($request->input('input_kecamatan_ps'));
		$sdm->kodya_ps = strtoupper($request->input('input_kodya_ps'));

        //log::info($request->hasFile('img_upload'));
        if ($request->hasFile('img_upload')) {
            $image = $request->file('img_upload');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('foto');
            $image->move($destinationPath, $name);
            $sdm->foto = 'foto/'.$name;
        }

        // $photoName = time().'.'.$request->input('input_img')->getClientOriginalExtension();
        // $request->input('input_img')->move(public_path('foto'), $photoName);

        //$sdm->foto = $destinationPath.'/'.$name;
        $sdm->save();
        
        return redirect('/datasdm');
    }

    public function viewFormKlien()
    {
        $kodya = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $kelurahan = DB::connection('pgsql')->table('mst_kelurahan')->where('status','ada')->orderBy('nama','asc')->get();
        $kecamatan = DB::connection('pgsql')->table('mst_kecamatan')->where('status','ada')->orderBy('nama','asc')->get();
        $kab = DB::connection('pgsql')->table('mst_kabupaten')->where('status','ada')->orderBy('nama','asc')->get();
        $kantor = DB::connection('pgsql')->table('mst_kantor')->get();

        return view('input.forminputklien',compact('kodya','kelurahan','kecamatan','kab','kantor'));   
    }

    public function saveDataKlien(Request $request,$nonsb)
    {
    	$lastnonsb = klien::max('no_reg');

		// Log::info(json_encode($dati));
    	$klien = new klien;

    	if($request->input('input_status') == '0000'){
    		$klien->no_reg = trim($request->input('nama_ub'),' ').'0000';
    	}else
    	if($request->input('input_status') == '0001'){
    		$nonsb = (int) substr($lastnonsb,-2,2) + 1;
    		$klien->no_reg = trim($request->input('nama_ub'),' ').'00'.str_pad($nonsb, 2, '0',STR_PAD_LEFT);
    	}else
    	if($request->input('input_status') == '0100'){
    		$nonsb = (int) substr($lastnonsb,-4,2) + 1;
    		$klien->no_reg = trim($request->input('nama_ub'),' ').str_pad($nonsb, 2, '0',STR_PAD_LEFT).'00';
    	}else
    	if($request->input('input_status') == '0101'){
    		$nonsb = (int) substr($lastnonsb,-2,2) + 1;
    		$klien->no_reg = trim($request->input('nama_ub'),' ').'01'.str_pad($nonsb, 2, '0',STR_PAD_LEFT);
    	}
    	// Log::info($dati);

    	$klien->tgl_input = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')));
		$klien->opr = strtoupper($request->input('opr'));
		$klien->kantor = strtoupper($request->input('nama_ub'));
		$klien->alamat = strtoupper($request->input('input_alamat'));
		$klien->rtrw = $request->input('input_rt').'/'.$request->input('input_rw');
		$klien->lurah = strtoupper($request->input('input_kelurahan'));
		$klien->camat = strtoupper($request->input('input_kecamatan'));
		$klien->kodya = strtoupper($request->input('input_kodya'));
		$klien->kodepos = strtoupper($request->input('input_kodepos'));
		$klien->tgl_berdiri = strtoupper($request->input('input_tanggalberdiri'));
		$klien->no_tlp = ($request->input('tlp'));
		$klien->web = ($request->input('web'));
		$klien->fb = ($request->input('facebook'));
		$klien->ig = ($request->input('instagram'));
		$klien->save();

		return redirect('/dataklien');
    }
    
    public function viewFormMateri()
    {
        $kodya = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
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
		$materi->opr = strtoupper($request->input('opr'));
		$materi->nama_modul = strtoupper($request->input('namamodul'));
        $materi->fasilitator = strtoupper($request->input('input_fasilitator'));
		$materi->peserta = strtoupper($request->input('peserta'));
		$materi->silabus = ($request->input('silabus'));
		$materi->durasi = strtoupper($request->input('durasi'));
        $materi->biaya = DataController::formatangka($request->input('biaya'));
        $materi->save();
        
       
        return redirect('/datamateri');
        
    }

    public function viewFormKlienEdit($nonsb)
    {
        $kodya = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $kelurahan = DB::connection('pgsql')->table('mst_kelurahan')->where('status','ada')->orderBy('nama','asc')->get();
        $kecamatan = DB::connection('pgsql')->table('mst_kecamatan')->where('status','ada')->orderBy('nama','asc')->get();
        $kab = DB::connection('pgsql')->table('mst_kabupaten')->where('status','ada')->orderBy('nama','asc')->get();
        $kantor = DB::connection('pgsql')->table('mst_kantor')->get();
        $klien = klien::where('no_reg',$nonsb)->first();

        return view('edit.formeditklien',compact('kodya','kelurahan','kecamatan','kab','kantor','klien'));   
    }

    public function saveDataKlienEdit(Request $request,$nonsb)
    {
        DB::connection('pgsql')->table('klien')->where('no_reg',$request->input('no_reg'))->update([
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
        'tgl_berdiri' => strtoupper($request->input('input_tanggalberdiri')),
        'no_tlp' => ($request->input('tlp')),
        'web' => ($request->input('web')),
        'fb' => ($request->input('facebook')),
        'ig' => ($request->input('instagram'))
        ]);

        return redirect('/dataklien');
    }

    public function viewFormMateriEdit($nonsb)
    {
        $kodya = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $materi = materi::where('kode_modul',$nonsb)->first();
        return view('edit.formeditmateri',compact('kodya','materi'));   
    }

    public function saveDataMateriEdit(Request $request,$nonsb)
    {
       
        DB::connection('pgsql')->table('materi')->where('kode_modul',$request->input('kode_modul'))->update([
        'kode_modul' => ($request->input('kode_modul')),
        'tgl_input' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
        'opr' => strtoupper($request->input('opr')),
        'nama_modul' => strtoupper($request->input('namamodul')),
        'fasilitator' => strtoupper($request->input('input_fasilitator')),
        'peserta' => strtoupper($request->input('peserta')),
        'silabus' => ($request->input('silabus')),
        'durasi' => strtoupper($request->input('durasi')),
        'biaya' => DataController::formatangka($request->input('biaya'))
        ]);
        
       
        return redirect('/datamateri');
        
    }

    public function viewFormSDMEdit($nonsb)
    {
        $kodya = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $gelar = DB::connection('pgsql')->table('mst_gelar')->orderBy('kode','asc')->orderBy('kode','asc')->get();
        $kelurahan = DB::connection('pgsql')->table('mst_kelurahan')->where('status','ada')->orderBy('nama','asc')->get();
        $kecamatan = DB::connection('pgsql')->table('mst_kecamatan')->where('status','ada')->orderBy('nama','asc')->get();
        $kab = DB::connection('pgsql')->table('mst_kabupaten')->where('status','ada')->orderBy('nama','asc')->get();
        $kantor = DB::connection('pgsql')->table('mst_kantor')->get();
        $jabatan = DB::connection('pgsql')->table('mst_jabatan')->get();
        $status = DB::connection('pgsql')->table('mst_statusrumah')->get();
        $sdm = sdm::where('no_sdm',$nonsb)->first();

        // $imagePath = public_path('foto');
        // $image = sdm::make(sdm::get($imagePath))->resize(320,240)->encode();
        // Storage::put($imagePath,$image);

        // $sdm->foto = $imagePath;

        return view('edit.formeditsdm',compact('kodya','jabatan','kelurahan','kecamatan','kab','gelar','status','kantor','sdm'));   
    }
    public function saveDataSDMEdit(Request $request,$nonsb)
    {
       
        
         
            if ($request->hasFile('img_upload')) {
            $image = $request->file('img_upload');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('foto');
            $image->move($destinationPath, $name);
            DB::connection('pgsql')->table('sdm')->where('foto',$request->input('img_upload'))->update([
            'foto' => 'foto/'.$name
        
        ]);
        }
       
        

        DB::connection('pgsql')->table('sdm')->where('no_sdm',$request->input('input_nosdm'))->update([
        'no_sdm'            => ($request->input('input_nosdm')),
        'tgl_input'             => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
        'opr'                   => strtoupper($request->input('opr')),
        'nama'                  => strtoupper($request->input('input_nama')),
        'jenis_kel'             => strtoupper($request->input('input_jenis_kelamin')),
        'tempat_lahir'          => strtoupper($request->input('input_lahir')),
        'tgl_lahir'             => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir'))),
        'notlp'                 => strtoupper($request->input('input_telepon_rumah')),
        'nohp'                  => strtoupper($request->input('input_hp')),
        'ktp'                   => strtoupper($request->input('input_no_identitas')),
        'npwp'                  => ($request->input('input_no_npwp')),
        'alamat_tinggal'         => strtoupper($request->input('input_alamat')),
        'rtrw_tinggal'       => $request->input('input_rt'),
        'lurah_tinggal'      => strtoupper($request->input('input_kelurahan')),
        'camat_tinggal'      => strtoupper($request->input('input_kecamatan')),
        'kodya_tinggal'      => strtoupper($request->input('input_kodya')),
        'kodepos_tinggal'        => strtoupper($request->input('input_kodepos')),
        'alamat_ktp'         => strtoupper($request->input('input_alamatktp')),
        'rtrw_ktp'       => $request->input('input_rtktp'),
        'lurah_ktp'      => strtoupper($request->input('input_kelurahanktp')),
        'camat_ktp'      => strtoupper($request->input('input_kecamatanktp')),
        'kodya_ktp'      => strtoupper($request->input('input_kodyaktp')),
        'kodepos_ktp'        => strtoupper($request->input('input_kodeposktp')),
        'kantor'         => strtoupper($request->input('kantor')),
        'jabatan'        => strtoupper($request->input('input_jabatan')),
        'pendidikan'         => strtoupper($request->input('pendidikan')),
        'email'      => ($request->input('input_email')),
        'tgl_kerja'      => date('Y-m-d H:i:s',strtotime($request->input('input_tglkerja'))),
        'agama'      => strtoupper($request->input('input_agama')),
        'status_rumah'       => strtoupper($request->input('status_rumah')),
        'nikah'      => strtoupper($request->input('input_status_nikah')),
        'nama_ps'        => strtoupper($request->input('input_nama_ps')),
        'tempat_lahir_ps'        => strtoupper($request->input('input_tempat_lahir_ps')),
        'lahir_ps'       => ($request->input('input_tanggal_lahir_ps')),
        'gelar_ps'       => strtoupper($request->input('input_gelar_ps')),
        'agama_ps'       => strtoupper($request->input('input_agama_ps')),
        'ktp_ps'         => ($request->input('input_ktp_ps')),
        'tlp_ps'         => ($request->input('input_nom_ps')),
        'alamat_ps'      => strtoupper($request->input('input_alamat_ps')),
        'kodepos_ps'         => strtoupper($request->input('input_kodepos_ps')),
        'rtrw_ps'        => $request->input('input_rt_ps'),
        'lurah_ps'       => strtoupper($request->input('input_kelurahan_ps')),
        'camat_ps'       => strtoupper($request->input('input_kecamatan_ps')),
        'kodya_ps'       => strtoupper($request->input('input_kodya_ps')),
        'opr'               => strtoupper($request->input('opr'))
        
        ]);
         
        
        return redirect('/datasdm');
    }

}



