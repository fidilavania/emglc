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
use App\mst_nikah;
use App\Http\Controllers\Controller;
use App\mst_camat;
use App\sdm_photo;
use App\jabatan_mst;
use App\kantor_mst;
use App\master_kantor;
use App\usulan;
use App\resign;
use App\mst_statusrumah;
use DB;
use Auth;
use Log;
use Input;
use Illuminate\Support\Facades\Storage;

class SdmController extends Controller
{

    public function viewFormResign($nonsb)
    {
        $sdm = sdm::where('no_sdm',$nonsb)->first();
        
        return view('resign.forminputresign',compact('sdm'));   
    }

    public function saveDataResign(Request $request,$nonsb)
    {
        
        $res = new resign;
        $res->no_sdm = $request->input('input_nosdm');
        $res->tgl_input = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')));
        $res->nama = strtoupper($request->input('input_nama'));
        $res->opr = strtoupper($request->input('opr'));
        $res->kantor =strtoupper($request->input('kantor'));
        $res->induk_kantor =strtoupper($request->input('induk_kantor'));
        $res->alasan = $request->input('alasan');
        $res->tanggal = date('Y-m-d H:i:s',strtotime($request->input('tanggal'))); 
        $res->save();

        DB::connection('mysql')->table('sdm')->where('no_sdm',$request->input('input_nosdm'))->update([
            'status' => 0
        ]);
        
        return redirect('/dataresign');
    }

    public function viewDataResign($key=null)
    {
        $datakredit = array();

        if(trim(Auth::user()->kantor,' ') != 'EMG' ){
            if($key == null){
                $lihatresign = resign::select('no_sdm','nama','alasan','tanggal','kantor','induk_kantor')->where('induk_kantor',Auth::user()->kantor)->paginate(20);
            } else {
                $lihatresign = resign::select('no_sdm','nama','alasan','tanggal','kantor','induk_kantor')->whereRaw
                ("(nama LIKE '%".strtoupper($key)."%'OR kantor LIKE '%".strtoupper($key)."%') AND induk_kantor = '".Auth::user()->kantor."' ")->paginate(20);
            }
        }else{
            if($key == null){
                $lihatresign = resign::select('no_sdm','nama','alasan','tanggal','kantor','induk_kantor')->paginate(20);
            } else {
                $lihatresign = resign::select('no_sdm','nama','alasan','tanggal','kantor','induk_kantor')->whereRaw
                ("nama LIKE '%".strtoupper($key)."%'OR kantor LIKE '%".strtoupper($key)."%'")->paginate(20);
            }
        }

        return view('resign.dataresign',compact('lihatresign'));   
    }

    public function viewusulan()
    {
        
        return view('usulan.forminputusulan');   
    }

    public function saveUsulan(Request $request)
    {
        
        $usul = new usulan;
        $usul->tanggal = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')));
        $usul->nama = strtoupper($request->input('nama'));
        $usul->kantor = strtoupper($request->input('kantor'));
        $usul->usulan = ($request->input('usulan'));
        $usul->save();
        
        return redirect('/usullihat');
    }

    public function viewLihatUsulan($key=null)
    {
        $datakredit = array();

        if($key == null){
            $lihatusulan = usulan::select('tanggal','nama','kantor','usulan')->paginate(20);
        } else {
            $lihatusulan = usulan::select('tanggal','nama','kantor','usulan')->whereRaw
            ("nama LIKE '%".strtoupper($key)."%'OR kantor LIKE '%".strtoupper($key)."%'")->paginate(20);
        }

        return view('usulan.formdatausulan',compact('lihatusulan'));   
    }

	public function viewDataSdm($key=null,$kol=null)
    {
        $sql3 ="SELECT mst_jabatan.jabatankantor,sdm.jabatan,mst_jabatan.kode
            from mst_jabatan,sdm 
            where 
            sdm.jabatan=mst_jabatan.kode";
        $lihat1 = DB::connection('mysql')->select(DB::raw($sql3));  

        $datakredit = array();

        if(trim(Auth::user()->kantor,' ') != 'EMG' ){
           if($key == null){
            $nsblist = sdm::select('no_sdm','nama','tempat_lahir','tgl_lahir','jenis_kel','ktp','alamat_tinggal','nohp','jabatan','notlp','nohp','tgl_kerja','kantor','induk_kantor','status')->where('status','1')->where('induk_kantor',Auth::user()->kantor)->paginate(20);
            } else {
                // $nsblist = sdm::select('no_sdm','nama','tempat_lahir','tgl_lahir','jenis_kel','ktp','alamat_tinggal','nohp','jabatan','notlp','nohp','tgl_kerja','kantor','induk_kantor','status')->whereRaw
                // ("nama LIKE '%".strtoupper($key)."%'OR kantor LIKE '%".strtoupper($key)."%' OR alamat_tinggal LIKE '%".strtoupper($key)."%'OR no_sdm LIKE '%".strtoupper($key)."%'")->where('status','1')->where('induk_kantor',Auth::user()->kantor)->paginate(20);
                /*$nsblist = sdm::select('no_sdm','nama','tempat_lahir','tgl_lahir','jenis_kel','ktp','alamat_tinggal','nohp','jabatan','notlp','nohp','tgl_kerja','kantor','induk_kantor','status')->whereRaw
                ("(nama LIKE '%".strtoupper($key)."%' OR alamat_tinggal LIKE '%".strtoupper($key)."%'OR no_sdm LIKE '%".strtoupper($key)."%') AND status = 1 AND induk_kantor = '".Auth::user()->kantor."'")->paginate(20);*/
                $nsblist = sdm::select('no_sdm','nama','tempat_lahir','tgl_lahir','jenis_kel','ktp','alamat_tinggal','nohp','jabatan','notlp','nohp','tgl_kerja','kantor','induk_kantor','status')->whereRaw
                ($kol." LIKE '%".strtoupper($key)."%' AND status = 1 AND induk_kantor = '".Auth::user()->kantor."'")->paginate(20);
            } 
        }else{
            if($key == null){
            $nsblist = sdm::select('no_sdm','nama','tempat_lahir','tgl_lahir','jenis_kel','ktp','alamat_tinggal','nohp','jabatan','notlp','nohp','tgl_kerja','kantor','induk_kantor','status')->where('status','1')->paginate(20);
            } else {
                /*$nsblist = sdm::select('no_sdm','nama','tempat_lahir','tgl_lahir','jenis_kel','ktp','alamat_tinggal','nohp','jabatan','notlp','nohp','tgl_kerja','kantor','induk_kantor','status')->whereRaw
                ("(nama LIKE '%".strtoupper($key)."%'OR kantor LIKE '%".strtoupper($key)."%' OR alamat_tinggal LIKE '%".strtoupper($key)."%'OR no_sdm LIKE '%".strtoupper($key)."%') AND status = 1")->paginate(20);*/
                $nsblist = sdm::select('no_sdm','nama','tempat_lahir','tgl_lahir','jenis_kel','ktp','alamat_tinggal','nohp','jabatan','notlp','nohp','tgl_kerja','kantor','induk_kantor','status')->whereRaw
                ($kol." LIKE '%".strtoupper($key)."%' AND status = 1")->paginate(20);
            }
        }

    if(trim(Auth::user()->kantor,' ') != 'EMG' ){
        $jumlah =  "SELECT count(no_sdm) as total FROM sdm where status = 1 AND status = 1 AND induk_kantor = '".Auth::user()->kantor."' ";
        $listjumlah = DB::connection('mysql')->select(DB::raw($jumlah));  
    }else{
        $jumlah =  "SELECT count(no_sdm) as total FROM sdm where status = 1 ";
        $listjumlah = DB::connection('mysql')->select(DB::raw($jumlah));  
    }
        

        return view('data.formdatasdm',compact('nsblist','datakredit','lihat1','listjumlah'));   
    }


    public function viewFormSDM()
    {
        $gelar = DB::connection('mysql')->table('mst_gelar')->orderBy('kode','asc')->orderBy('kode','asc')->get();
        $kantor = DB::connection('mysql')->table('mst_kantor')->get();
        $jabatan = DB::connection('mysql')->table('mst_jabatan')->get();
        $status = DB::connection('mysql')->table('mst_statusrumah')->get();
        $mkantor = DB::connection('mysql')->table('master_kantor')->where('kode_induk',Auth::user()->kantor)->get();

        $propinsi = DB::connection('mysql')->select(DB::raw("SELECT distinct(propinsi) as propinsi FROM mst_camat;")); 
        $kodya = DB::connection('mysql')->select(DB::raw("SELECT distinct(kodya) as kodya FROM mst_camat where propinsi = 'Bali';")); 
        $camat = DB::connection('mysql')->select(DB::raw("SELECT distinct(camat) as camat FROM mst_camat where kodya = 'Malang.kota';"));  
        $lurah = DB::connection('mysql')->select(DB::raw("SELECT distinct(lurah) as lurah FROM mst_camat where camat = 'Blimbing';"));  
        // $kodepos = DB::connection('mysql')->table('mst_camat')->first();

        $sql3 ="SELECT mst_jabatan.jabatankantor,sdm.jabatan,mst_jabatan.kode
            from mst_jabatan,sdm 
            where 
            sdm.jabatan=mst_jabatan.kode";
        $lihat1 = DB::connection('mysql')->select(DB::raw($sql3));

        return view('input.forminputsdm',compact('jabatan','gelar','status','kantor','lihat1','mkantor','propinsi','kodya','camat','lurah','kodepos','master_propinsi'));   
    }

    public function input()
    {
      // $camat = DB::connection('pgsql')->table('mst_camat')->where('status','AKTIF')->orderBy('camat','asc')->get();
    $propinsi = DB::connection('mysql')->select(DB::raw("SELECT distinct(propinsi) as propinsi FROM mst_camat;")); 
    $kodya = DB::connection('mysql')->select(DB::raw("SELECT distinct(kodya) as kodya FROM mst_camat where propinsi = 'Bali';")); 
    $camat = DB::connection('mysql')->select(DB::raw("SELECT distinct(camat) as camat FROM mst_camat where kodya = 'Malang.kota';"));  
    $lurah = DB::connection('mysql')->select(DB::raw("SELECT distinct lurah,kodepos FROM mst_camat where camat = 'Blimbing';"));  
    $kodepos = DB::connection('mysql')->select(DB::raw("SELECT distinct (kodepos) as kodepos FROM mst_camat where camat = 'Blimbing' and lurah = 'Blimbing';"));     
    $kerja = DB::connection('mysql')->select(DB::raw("SELECT kode,note,kodeslik FROM mst_kerja;"));     
    $bidang = DB::connection('mysql')->select(DB::raw("SELECT note,kode FROM mst_usaha;"));     

         // $kodepos = DB::connection('pgsql')->select(DB::raw("SELECT distinct(kodepos) as kodepos FROM mst_camat where camat = 'Blimbing';"));  
      //log::info($camat);
    return view('input.forminputsdm',compact('propinsi','kodya','camat','lurah','kodepos','kerja','bidang'));

    }
    
    public function pilih(Request $request)
    {
        $kodya = DB::connection('mysql')->select(DB::raw("SELECT distinct(kodya) as kodya FROM mst_camat where propinsi ='".$request->input('pilih')."';"));
        return $kodya;
    }

    public function pilihcamat(Request $request)
    {
        $camat = DB::connection('mysql')->select(DB::raw("SELECT distinct(camat) as camat FROM mst_camat where kodya ='".$request->input('pilihcamat')."';"));
        return $camat;
    }

    public function pilihlurah(Request $request)
    {
      $lurah = DB::connection('mysql')->select(DB::raw("SELECT distinct lurah,kodepos  FROM mst_camat where camat ='".$request->input('pilihlurah')."';"));
      return $lurah;
    }
    


    public function saveDataSDM(Request $request,$nonsb)
    {
        
        $lastnonsb = sdm::max('no_sdm');
        $nonsb = (int) $lastnonsb + 1;

        $mkantor = explode('-', $request->input('kantor'));
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
		$sdm->kantor = $mkantor[1];
        $sdm->induk_kantor = $mkantor[0];
        $sdm->status_kantor = strtoupper($request->input('input_status'));
		$sdm->jabatan = strtoupper($request->input('input_jabatan'));
		$sdm->pendidikan = strtoupper($request->input('pendidikan'));
		$sdm->email = ($request->input('input_email'));
		$sdm->tgl_kerja = date('Y-m-d H:i:s',strtotime($request->input('input_tglkerja')));
		$sdm->agama = strtoupper($request->input('input_agama'));
		$sdm->status_rumah = strtoupper($request->input('status_rumah'));
		$sdm->nikah = strtoupper($request->input('input_status_nikah'));
		$sdm->nama_ps = strtoupper($request->input('input_nama_ps'));
		$sdm->tempat_lahir_ps = strtoupper($request->input('input_tempat_lahir_ps'));
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

        $sdm->prop = strtoupper($request->input('propinsi'));
        $sdm->propktp = strtoupper($request->input('propinsiktp'));
        $sdm->propps = strtoupper($request->input('propinsips'));
        $sdm->no_kk = strtoupper($request->input('input_kk'));

        $sdm->status = 1;
        


        //log::info($request->hasFile('img_upload'));
        // if ($request->hasFile('img_upload')) {
        //     $image = $request->file('img_upload');
        //     $name = time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('foto');
        //     $image->move($destinationPath, $name);
        //     $sdm->foto = 'foto/'.$name;
        // }

        if ($request->hasFile('img_upload')) {
            $fileContents = $request->file('img_upload');
            $paths3 =  Storage::disk('s3')->put('foto', $fileContents,'public');
            $sdm->foto = $paths3;
        }

        // $photoName = time().'.'.$request->input('input_img')->getClientOriginalExtension();
        // $request->input('input_img')->move(public_path('foto'), $photoName);

        //$sdm->foto = $destinationPath.'/'.$name;
        $sdm->save();
        
        return redirect('/datasdm');
    }

    public function viewFormSDMview($nonsb)
    {
        $kodya = DB::connection('mysql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $gelar = DB::connection('mysql')->table('mst_gelar')->get();
        $kantor = DB::connection('mysql')->table('mst_kantor')->get();
        $jabatan = DB::connection('mysql')->table('mst_jabatan')->get();
        $status = DB::connection('mysql')->table('mst_statusrumah')->get();
        $nikah = DB::connection('mysql')->table('mst_nikah')->get();
        $sdm = sdm::where('no_sdm',$nonsb)->first();
        $mkantor = DB::connection('mysql')->table('master_kantor')->get();

        $foto = Storage::disk('s3')->url($sdm->foto);


        // $imagePath = public_path('foto');
        // $image = sdm::make(sdm::get($imagePath))->resize(320,240)->encode();
        // Storage::put($imagePath,$image);

        // $sdm->foto = $imagePath;

        // $sql2 ="SELECT mst_krd.nama,mst_krd.sandi,kredit.jns_krd
        //         from mst_krd,kredit 
        //         where kredit.no_kredit='".$nokredit."' 
        //         AND 
        //         kredit.jns_krd=mst_krd.sandi";
        //         $lihat2 = DB::connection('pgsql')->select(DB::raw($sql2)); 

       $sql1 ="SELECT mst_statusrumah.kode_status,mst_statusrumah.status,sdm.status_rumah 
            from mst_statusrumah,sdm 
            where sdm.no_sdm='".$nonsb."' 
            AND
            sdm.status_rumah=mst_statusrumah.kode_status";
        $lihat1 = DB::connection('mysql')->select(DB::raw($sql1));  

        $sql1 ="SELECT mst_jabatan.kode,mst_jabatan.jabatankantor,sdm.jabatan 
            from mst_jabatan,sdm 
            where sdm.no_sdm='".$nonsb."' 
            AND
            sdm.jabatan=mst_jabatan.kode";
        $lihat2 = DB::connection('mysql')->select(DB::raw($sql1));  

        $sql1 ="SELECT mst_gelar.kode,mst_gelar.gelar,sdm.pendidikan 
            from mst_gelar,sdm 
            where sdm.no_sdm='".$nonsb."' 
            AND
            sdm.pendidikan=mst_gelar.kode";
        $lihat3 = DB::connection('mysql')->select(DB::raw($sql1));  

        $sql1 ="SELECT mst_nikah.kode,mst_nikah.nama,sdm.nikah 
            from mst_nikah,sdm 
            where sdm.no_sdm='".$nonsb."' 
            AND
            sdm.nikah=mst_nikah.kode";
        $lihat4 = DB::connection('mysql')->select(DB::raw($sql1));  

        $sql1 ="SELECT mst_gelar.kode,mst_gelar.gelar,sdm.gelar_ps 
            from mst_gelar,sdm 
            where sdm.no_sdm='".$nonsb."' 
            AND
            sdm.gelar_ps=mst_gelar.kode";
        $lihat5 = DB::connection('mysql')->select(DB::raw($sql1));  

        return view('edit.formviewsdm',compact('kodya','jabatan','kelurahan','kecamatan','kab','gelar','status','kantor','sdm','nikah','mkantor','lihat1','lihat2','lihat3','lihat4','lihat5','foto'));   
    }

    public function viewFormSDMEdit($nonsb)
    {
        $gelar = DB::connection('mysql')->table('mst_gelar')->get();
        $kantor = DB::connection('mysql')->table('mst_kantor')->get();
        $jabatan = DB::connection('mysql')->table('mst_jabatan')->get();
        $status = DB::connection('mysql')->table('mst_statusrumah')->get();
        $nikah = DB::connection('mysql')->table('mst_nikah')->get();
        $sdm = sdm::where('no_sdm',$nonsb)->first();
        $mkantor = DB::connection('mysql')->table('master_kantor')->get();

        $propinsi = DB::connection('mysql')->select(DB::raw("SELECT distinct(propinsi) as propinsi FROM mst_camat;")); 
        $kodya = DB::connection('mysql')->select(DB::raw("SELECT distinct(kodya) as kodya FROM mst_camat where propinsi = 'Bali';")); 
        $camat = DB::connection('mysql')->select(DB::raw("SELECT distinct(camat) as camat FROM mst_camat where kodya = 'Malang.kota';"));  
        $lurah = DB::connection('mysql')->select(DB::raw("SELECT distinct(lurah) as lurah FROM mst_camat where camat = 'Blimbing';"));  
        $kodepos = DB::connection('mysql')->table('mst_camat')->first();
        // $imagePath = public_path('foto');
        // $image = sdm::make(sdm::get($imagePath))->resize(320,240)->encode();
        // Storage::put($imagePath,$image);

        // $sdm->foto = $imagePath;

        $foto = Storage::disk('s3')->url($sdm->foto);


        $sql1 ="SELECT mst_statusrumah.kode_status,mst_statusrumah.status,sdm.status_rumah 
            from mst_statusrumah,sdm 
            where sdm.no_sdm='".$nonsb."' 
            AND
            sdm.status_rumah=mst_statusrumah.kode_status";
        $lihat1 = DB::connection('mysql')->select(DB::raw($sql1));  

        $sql1 ="SELECT mst_jabatan.kode,mst_jabatan.jabatankantor,sdm.jabatan 
            from mst_jabatan,sdm 
            where sdm.no_sdm='".$nonsb."' 
            AND
            sdm.jabatan=mst_jabatan.kode";
        $lihat2 = DB::connection('mysql')->select(DB::raw($sql1));  

        $sql1 ="SELECT mst_gelar.kode,mst_gelar.gelar,sdm.pendidikan 
            from mst_gelar,sdm 
            where sdm.no_sdm='".$nonsb."' 
            AND
            sdm.pendidikan=mst_gelar.kode";
        $lihat3 = DB::connection('mysql')->select(DB::raw($sql1));  

        $sql1 ="SELECT mst_nikah.kode,mst_nikah.nama,sdm.nikah 
            from mst_nikah,sdm 
            where sdm.no_sdm='".$nonsb."' 
            AND
            sdm.nikah=mst_nikah.kode";
        $lihat4 = DB::connection('mysql')->select(DB::raw($sql1));  

        $sql1 ="SELECT mst_gelar.kode,mst_gelar.gelar,sdm.gelar_ps 
            from mst_gelar,sdm 
            where sdm.no_sdm='".$nonsb."' 
            AND
            sdm.gelar_ps=mst_gelar.kode";
        $lihat5 = DB::connection('mysql')->select(DB::raw($sql1));  

        return view('edit.formeditsdm',compact('kodya','jabatan','kelurahan','camat','lurah','gelar','status','kantor','sdm','nikah','mkantor','lihat1','lihat2','lihat3','lihat4','propinsi','lihat5','foto'));   
    }
    public function saveDataSDMEdit(Request $request,$nonsb)
    {               
        Log::info($request->hasFile('img_upload'));
        // if ($request->hasFile('img_upload')) {
        //     Log::info('masuk');
        //     $image = $request->file('img_upload');
        //     $name = time().'.'.$image->getClientOriginalExtension();
        //     $destinationPath = public_path('foto');
        //     $image->move($destinationPath, $name);
        //     DB::connection('mysql')->table('sdm')->where('no_sdm',$request->input('input_nosdm'))->update([
        //         'foto' => 'foto/'.$name
        
        //     ]);
        // }
       
       if ($request->hasFile('img_upload')) {
            $fileContents = $request->file('img_upload');
            $paths3 =  Storage::disk('s3')->put('foto', $fileContents,'public');
            DB::connection('mysql')->table('sdm')->where('no_sdm',$request->input('input_nosdm'))->update([
                'foto' => $paths3
            ]);
        }
        

        DB::connection('mysql')->table('sdm')->where('no_sdm',$request->input('input_nosdm'))->update([
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
        'status_kantor' => strtoupper($request->input('input_status')),
        'jabatan'        => strtoupper($request->input('input_jabatan')),
        'pendidikan'         => strtoupper($request->input('pendidikan')),
        'email'      => ($request->input('input_email')),
        'tgl_kerja'      => date('Y-m-d H:i:s',strtotime($request->input('input_tglkerja'))),
        'agama'      => strtoupper($request->input('input_agama')),
        'status_rumah'       => strtoupper($request->input('status_rumah')),
        'nikah'      => strtoupper($request->input('input_status_nikah')),
        'nama_ps'        => strtoupper($request->input('input_nama_ps')),
        'tempat_lahir_ps'        => strtoupper($request->input('input_tempat_lahir_ps')),
        'lahir_ps'       => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir_ps'))),
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
        'opr'               => strtoupper($request->input('opr')),

        'prop' => strtoupper($request->input('propinsi')),
        'propktp' => strtoupper($request->input('propinsiktp')),
        'propps' => strtoupper($request->input('propinsips')),
        'no_kk' => strtoupper($request->input('input_kk')),
        'status' => 1
        
        ]);
         
        
        return redirect('/datasdm');
    }
}
