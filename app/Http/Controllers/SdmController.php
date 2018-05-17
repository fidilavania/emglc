<?php

namespace App\Http\Controllers;

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

class SdmController extends Controller
{

	public function viewDataSdm($key=null)
    {
        $sql3 ="SELECT mst_jabatan.jabatankantor,sdm.jabatan,mst_jabatan.kode
            from mst_jabatan,sdm 
            where 
            sdm.jabatan=mst_jabatan.kode";
        $lihat1 = DB::connection('mysql')->select(DB::raw($sql3));  

        $datakredit = array();

        if($key == null){
            $nsblist = sdm::select('no_sdm','nama','tempat_lahir','tgl_lahir','jenis_kel','ktp','alamat_tinggal','nohp','jabatan','notlp','nohp','tgl_kerja','kantor')->paginate(20);
        } else {
            $nsblist = sdm::select('no_sdm','nama','tempat_lahir','tgl_lahir','jenis_kel','ktp','alamat_tinggal','nohp','jabatan','notlp','nohp','tgl_kerja','kantor')->whereRaw
            ("nama LIKE '%".strtoupper($key)."%'OR alamat_ktp LIKE '%".strtoupper($key)."%' OR alamat_tinggal LIKE '%".strtoupper($key)."%'OR no_sdm LIKE '%".strtoupper($key)."%'")->paginate(20);
        }

        return view('data.formdatasdm',compact('nsblist','datakredit','lihat1'));   
    }
    
    public function viewFormSDM()
    {
        $kodya = DB::connection('mysql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $gelar = DB::connection('mysql')->table('mst_gelar')->orderBy('kode','asc')->orderBy('kode','asc')->get();
        $kelurahan = DB::connection('mysql')->table('mst_kelurahan')->where('status','ada')->orderBy('nama','asc')->get();
        $kecamatan = DB::connection('mysql')->table('mst_kecamatan')->where('status','ada')->orderBy('nama','asc')->get();
        $kab = DB::connection('mysql')->table('mst_kabupaten')->where('status','ada')->orderBy('nama','asc')->get();
        $kantor = DB::connection('mysql')->table('mst_kantor')->get();
        $jabatan = DB::connection('mysql')->table('mst_jabatan')->get();
        $status = DB::connection('mysql')->table('mst_statusrumah')->get();

        $sql3 ="SELECT mst_jabatan.jabatankantor,sdm.jabatan,mst_jabatan.kode
            from mst_jabatan,sdm 
            where 
            sdm.jabatan=mst_jabatan.kode";
        $lihat1 = DB::connection('mysql')->select(DB::raw($sql3));

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

    public function viewFormSDMEdit($nonsb)
    {
        $kodya = DB::connection('mysql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $gelar = DB::connection('mysql')->table('mst_gelar')->orderBy('kode','asc')->orderBy('kode','asc')->get();
        $kelurahan = DB::connection('mysql')->table('mst_kelurahan')->where('status','ada')->orderBy('nama','asc')->get();
        $kecamatan = DB::connection('mysql')->table('mst_kecamatan')->where('status','ada')->orderBy('nama','asc')->get();
        $kab = DB::connection('mysql')->table('mst_kabupaten')->where('status','ada')->orderBy('nama','asc')->get();
        $kantor = DB::connection('mysql')->table('mst_kantor')->get();
        $jabatan = DB::connection('mysql')->table('mst_jabatan')->get();
        $status = DB::connection('mysql')->table('mst_statusrumah')->get();
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
            DB::connection('mysql')->table('sdm')->where('foto',$request->input('img_upload'))->update([
            'foto' => 'foto/'.$name
        
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
        'opr'               => strtoupper($request->input('opr'))
        
        ]);
         
        
        return redirect('/datasdm');
    }
}
