<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\Validator::class,
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Prekredit;
use App\prekredit_nuk;
use App\kredit_nuk;
use App\kredit_nuk_his;
use App\PasanganNasabah;
use App\Nasabah;
use App\kredit;
use App\penjamin;
use App\agunan;
use App\Data;
use App\AgunanKredit;
use App\AgunanSertifikat;
use App\AgunanKendaraan;
use App\AgunanKeluar;
use App\DafKreditBiaya;
use App\kredit_biaya_nuk_his;
use App\kredit_biaya_nuk;
use App\AngsKartu;
use App\AngsBayar;
use App\AngsJadwal;
use App\refkodekantor;
use App\RKKodeTrans;
use App\RKTransaksi;
use App\RKRekening;
use App\Pengurus;
use App\Laporan;
use App\ABCKantor;
use App\agunan_kend_nuk;
use App\agunan_sert_nuk;
use App\angsuran_jadwal_nuk;
use Auth;
use DB;
use Log;
//use App\Agunan;
use App\Http\Controllers\Controller;

class DataController extends Controller
{
    public static function formatangka($a) 
    {
         $a = str_replace( '.', '', $a);
         return $a;
    }

    public static function romanNumerals($num) 
    {
        $n = intval($num);
        $res = '';
     
        /*** roman_numerals array  ***/
        $roman_numerals = array(
                    'M'  => 1000,
                    'CM' => 900,
                    'D'  => 500,
                    'CD' => 400,
                    'C'  => 100,
                    'XC' => 90,
                    'L'  => 50,
                    'XL' => 40,
                    'X'  => 10,
                    'IX' => 9,
                    'V'  => 5,
                    'IV' => 4,
                    'I'  => 1);
     
        foreach ($roman_numerals as $roman => $number) 
        {
            /*** divide to get  matches ***/
            $matches = intval($n / $number);
     
            /*** assign the roman char * $matches ***/
            $res .= str_repeat($roman, $matches);
     
            /*** substract from the number ***/
            $n = $n % $number;
        }
     
        /*** return the res ***/
        return $res;
    }
    
     public function viewSummary()
    {  
        $jenisfas =  DB::connection('pgsql')->table('mst_sefas')->orderBy('sandi','asc')->get();
        $kolek = DB::connection('pgsql')->table('mst_kolek')->orderBy('sandi','asc')->get();
        return view('summary.summary',compact('jenisfas','kolek'));   
    }

     public function viewFormDataNasabah($key=null)
    {


        $datakredit = array();

        if($key == null){
            $nsblist = Nasabah::select('no_cif','no_nsb','nama','kelamin','namaibu','tmplahir','tgllahir','alamat','kondisi','npwp')->paginate(20);
        } else {
            $nsblist = Nasabah::select('no_cif','no_nsb','nama','kelamin','namaibu','tmplahir','tgllahir','alamat','kondisi','npwp')->whereRaw
            ("nama LIKE '%".strtoupper($key)."%'OR namaibu LIKE '%".strtoupper($key)."%' OR alamat LIKE '%".strtoupper($key)."%'OR no_cif LIKE '%".strtoupper($key)."%'")->paginate(20);
        }

        foreach ($nsblist as $list) {
            $datakredit[$list->no_nsb] = kredit::select('no_kredit','no_ref','sistem','lama','plafon','bbt','pinj_pokok','bakidebet','tgl_mulai','tgl_lunas')->whereRaw("no_mohon IN (SELECT no_mohon FROM prekredit WHERE no_nsb = '".$list->no_nsb."')")->get();
        }  

        //  foreach ($nsblist as $list) {
        //     $datapengurus[$list->no_nsb] = pegurus::select('nm_pengurus','kode_jabatan','pangsa_kepemilikan','status_pengurus')->whereRaw("no_mohon IN (SELECT no_mohon FROM prekredit WHERE no_nsb = '".$list->no_nsb."')")->get();
        // }   

        return view('nasabah.formdatanasabah',compact('nsblist','datakredit'));   
    }

    public function viewKoreksi($key=null)
    {

        $datakredit = array();

        if($key == null){
            $nsblist = Nasabah::select('no_nsb','no_cif','nama','kelamin','namaibu','tmplahir','tgllahir','alamat','kondisi')->paginate(20);
        } else {
            $nsblist = Nasabah::select('no_nsb','no_cif','nama','kelamin','namaibu','tmplahir','tgllahir','alamat','kondisi')->whereRaw("nama LIKE '%".strtoupper($key)."%'OR namaibu LIKE '%".strtoupper($key)."%' OR alamat LIKE '%".strtoupper($key)."%' OR no_cif LIKE '%".strtoupper($key)."%'" )->paginate(20);
        }

        foreach ($nsblist as $list) {
            $datakredit[$list->no_nsb] = Kredit::select('no_kredit','no_ref','sistem','lama','plafon','bbt','tgl_mulai','tgl_lunas')->whereRaw("no_mohon IN (SELECT no_mohon FROM prekredit WHERE no_nsb = '".$list->no_nsb."')")->get();
        }   

        //  foreach ($nsblist as $list) {
        //     $datapengurus[$list->no_nsb] = pegurus::select('nm_pengurus','kode_jabatan','pangsa_kepemilikan','status_pengurus')->whereRaw("no_mohon IN (SELECT no_mohon FROM prekredit WHERE no_nsb = '".$list->no_nsb."')")->get();
        // }   

        return view('koreksi.koreksidata',compact('nsblist','datakredit'));   
    }

    public function viewkorekkredit($tahun,$kode_kantor,$nourut)
    {
        $nokredit = $tahun.'/'.$kode_kantor.'/'.$nourut;
        $sifatkrd = DB::connection('pgsql')->table('mst_sifat_kredit')->orderBy('kode','asc')->get();
        $jns_krd = DB::connection('pgsql')->table('mst_krd')->orderBy('sandi','asc')->get();
        $skim = DB::connection('pgsql')->table('mst_skim')->orderBy('kode','asc')->get();
        $kadeb = DB::connection('pgsql')->table('mst_debitur')->orderBy('sandi','asc')->get();
        $goldeb = DB::connection('pgsql')->table('mst_goldeb')->where('status',' ')->orderBy('sandi','asc')->get();
        $jnsbiaya = DB::connection('pgsql')->table('mst_guna')->orderBy('kode','asc')->get();
        $ori = DB::connection('pgsql')->table('mst_ori')->orderBy('kode','asc')->get();
        $eko = DB::connection('pgsql')->table('mst_eko')->where('status',' ')->orderBy('kode','asc')->get();
        $dati2 = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $jenisbunga = DB::connection('pgsql')->table('mst_bunga')->orderBy('sadi','asc')->get();
        $kreditpp = DB::connection('pgsql')->table('mst_kreditpp')->orderBy('sandi','asc')->get();
        $sumber = DB::connection('pgsql')->table('mst_sumber')->get();
        $kolek = DB::connection('pgsql')->table('mst_kolek')->orderBy('sandi','asc')->get();
        $sebabmacet = DB::connection('pgsql')->table('mst_sebab')->orderBy('kode','asc')->get();
        $cara = DB::connection('pgsql')->table('mst_cara')->orderBy('kode','asc')->get();
        $kondisi = DB::connection('pgsql')->table('mst_kondisi')->orderBy('kode','asc')->get();
        $valuta = DB::connection('pgsql')->table('mst_valuta')->orderBy('kode','asc')->get();
        $res = DB::connection('pgsql')->table('mst_cara')->orderBy('kode','asc')->get();
        $ljk = DB::connection('pgsql')->table('mst_ljk')->where('status',' ')->orderBy('kode','asc')->get();
        $ao = DB::connection('pgsql')->table('mst_ao')->where('aktif','1')->orderBy('kota','asc')->get();
        $kode_kantor = refkodekantor::all();
        
        $prekredit = Prekredit::where('no_kredit',$nokredit)->first();
        $kredit = Kredit::where('no_kredit',$nokredit)->first();

        return view('koreksi.koreksikredit',compact('sifatkrd','jns_krd','skim','kadeb','goldeb','jnsbiaya','ori','eko','dati2','jenisbunga','kreditpp','sumber','kolek','sebabmacet','cara','kondisi','valuta','res','kode_kantor','nasabah','ljk','totalsaldo','totalpokok','lapuang','ao','prekredit','kredit'));
    }

     public function savekoreksikredit(Request $request,$nokredit)
    {
        DB::connection('pgsql')->table('kredit')->where('no_kredit',$request->input('no_kredit'))->update([
            'no_kredit'         => ($request->input('no_kredit')),
            'to'                => ($request->input('input_to_dari')),
            'sifatkrd'          => ($request->input('input_sifatkrd')),
            'opr'               => ($request->input('opr'))
        ]);
        
        return redirect('/koreksidata');
    }


    public function dataFormKoreksidata ($tahun,$kode_kantor,$nourut)
    { 
       
        $nokredit = $tahun.'/'.$kode_kantor.'/'.$nourut;
        $prekredit = Prekredit::where('no_kredit',$nokredit)->get();
        $daftar = Kredit::where('no_kredit',$nokredit)->get();
        $biaya = DafKreditBiaya::where('no_kredit',$nokredit)->get();

    $daftar = Kredit::where('no_kredit',$nokredit)->get();
    $kendaraan = AgunanKendaraan::where('no_kredit',$nokredit)->get();
    $sertifikat = AgunanSertifikat::where('no_kredit',$nokredit)->get();
        $agkredit = AgunanKredit::where('no_kredit',$nokredit)->get();
        $lapkeuang = laporan::where('no_kredit',$nokredit)->get();
        $pengurus = Pengurus::where('no_kredit',$nokredit)->get();
        $jamin = penjamin::whereRaw("no_kredit LIKE '%".$nokredit."%'")->get();
        // Log::info($nokredit);
        // Log::info($jamin);
    $prekredit = Prekredit::where('no_kredit',$nokredit)->get();
        
        $kodya = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $segfas = DB::connection('pgsql')->table('mst_sefas')->orderBy('sandi','asc')->get();
        $goldeb =DB::connection('pgsql')->table('mst_goldeb')->where('status',' ')->orderBy('sandi','asc')->get();
        $kelurahan = DB::connection('pgsql')->table('mst_kelurahan')->where('status','ada')->orderBy('nama','asc')->get();
        $kecamatan = DB::connection('pgsql')->table('mst_kecamatan')->where('status','ada')->orderBy('nama','asc')->get();
        $jenisfas =  DB::connection('pgsql')->table('mst_sefas')->orderBy('sandi','asc')->get();
        $status =  DB::connection('pgsql')->table('mst_stat')->orderBy('sandi','asc')->get();
        $jenisagun =  DB::connection('pgsql')->table('mst_agunan')->orderBy('kode','asc')->get();
        $lembaga =  DB::connection('pgsql')->table('lembaga')->orderBy('kode','asc')->get();
        $ikat =  DB::connection('pgsql')->table('mst_ikat')->orderBy('kode','asc')->get();
        $dati2 = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc1','asc')->get();
        $kerja = DB::connection('pgsql')->table('mst_kerja')->orderBy('kode','asc')->get();
         $gelar = DB::connection('pgsql')->table('mst_gelar')->orderBy('kode','asc')->orderBy('kode','asc')->get();
        $negara = DB::connection('pgsql')->table('mst_negara')->orderBy('kode','asc')->get();
        $hubbank = DB::connection('pgsql')->table('mst_lapor')->orderBy('kode','asc')->get();
        $sumber = DB::connection('pgsql')->table('mst_sumber')->orderBy('kode','asc')->get();
        $jabatan = DB::connection('pgsql')->table('mst_jabatan')->orderBy('kode','asc')->get();
        

        return view('koreksi.viewkoreksi',compact('daftar','biaya','kendaraan','sertifikat','jamin','dataangsuran','datanasabah','tgk','totaldenda','tgkangsur','totaltunggak','bayarangsuran','jadwal','kartu','bayar','data','lapkeuang','pengurus','prekredit','agkredit','kodya','segfas','goldeb','kelurahan','kecamatan','jenisfas','lembaga','ikat','dati2','status','jenisagun','kerja','gelar','negara','hubbank','sumber','jabatan'));
    }

    public function saveKoreksi(Request $request,$nokredit)
    {
        //  if(count($request->input('input_nom_id_penjamin')) > 0){
        //     for($i=0;$i<count($request->input('input_nom_id_penjamin'));$i++){
        //         // if(($request->input('input_nom_id_penjamin')[$i] <> null) || ($request->input('input_nom_id_penjamin')[$i] <> '')){
        //             DB::connection('pgsql') ->table('penjamin')->where('no_nsb',$nonsb)->update([
        //                 'no_nsb'            => ($nonsb),
        //                 'nom_id_penjamin'   => ($request->input('input_nom_id_penjamin')[$i]),
        //                 'segfas'            => ($request->input('input_kode_segFas')[$i]),
        //                 'idpenjamin'        => ($request->input('input_kode_jns_idPenjamin')[$i]),
        //                 'nm_penjamin'       => ($request->input('input_nm_penjamin')[$i]),
        //                 'nm_lengkap'        => ($request->input('input_nm_lengkap')[$i]),
        //                 'goldeb'            => ($request->input('input_kode_gol_Penjamin')[$i]),
        //                 'alamat'            => ($request->input('input_alamat')[$i]),
        //                 'kodepos'           => ($request->input('input_kodepos')[$i]),
        //                 'kelurahan'         => ($request->input('input_kelurahan')[$i]),
        //                 'kecamatan'         => ($request->input('input_kecamatan')[$i]),
        //                 'present_dijamin'   => ($request->input('input_persent_dijamin')[$i]),
        //                 'ket'               => ($request->input('input_ket')[$i]),
        //                 'kodya'             => ($request->input('input_kodya')[$i])
        //             ]);
        //         }
        //     // }
        // }
        $prekredit = Prekredit::where('no_kredit',$nokredit)->first();

        $kendaraan = AgunanKendaraan::where('no_kredit',$nokredit)->first();
        $sertifikat = AgunanSertifikat::where('no_kredit',$nokredit)->first();

        // if(isset($kendaraan->no_agunan)||isset($sertifikat->no_agunan)){ 
            if(count($request->input('input_jenis_kendaraan_k')) > 0){
                for($i=0;$i<count($request->input('input_jenis_kendaraan_k'));$i++){
                    if(($request->input('input_merk_kend_k')[$i] <> null) || ($request->input('input_merk_kend_k')[$i] <> '')){
                    DB::connection('pgsql')->table('agunan_kend')->where('no_agunan',$request->input('input_nomor_k')[$i])->update([
                    'no_nsb'     => ($request->input('no_nsb')[$i]),
                    'status'     => ($request->input('status_k')[$i]),
                    'jenis'      => ($request->input('input_agunan1_k')[$i]),    
                    'jenisken'   => ($request->input('input_jenis_kendaraan_k')[$i]),
                    'pemilik'    => (strtoupper($request->input('input_nama_pemilik_kend_k')[$i])),
                    'alamat'     => (strtoupper($request->input('input_alamat_pemilik_kend_k')[$i])),
                    'kodya'      => (strtoupper($request->input('input_kodya_nasabah_k')[$i])),
                    'merktype'   => (strtoupper($request->input('input_merk_kend_k')[$i])),
                    'tahun'      => ($request->input('input_tahun_kend_k')[$i]),
                    // 'jenisfas'   => ($request->input('input_kode_jns_segFas_k')[$i]),
                    'kd_status'  => ($request->input('input_kode_stat_agunan_k')[$i]),
                    'jenisagun'  => ($request->input('input_kode_jns_agunan_k')[$i]),
                    // 'peringkat'  => ($request->input('input_peringkat_agunan_k')[$i]),
                    // 'lembaga'    => ($request->input('input_kode_lembaga_pemeringkat_k')[$i]),
                    'ikat'       => ($request->input('input_kode_jns_pengikatan_k')[$i]),
                    'tgl_ikat'   => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_k')[$i]))),
                    'bukti'      => ($request->input('input_no_bpkb_k')[$i]),
                    // 'ljk'        => (DataController::formatangka($request->input('input_nilai_agunanLJK_k')[$i])),
                    // 'tgl_nilai'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_k')[$i]))),
                    // 'indep'      => (DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_k')[$i])),
                    // 'namaindep'  => ($request->input('input_nm_penilai_k')[$i]),
                    // 'tgl_indep'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_k')[$i]))),
                    'paripasu'   => ($request->input('input_status_paripasu_k')[$i]),
                    'persen'     => ($request->input('input_persent_paripasu_k')[$i]),
                    'asuransi'   => ($request->input('input_diasuransikan_k')[$i]),
                    's_join'     => ($request->input('input_join_k')[$i]),
                    'warna'      => (strtoupper($request->input('input_warna_kend_k')[$i])),
                    'nopolisi'   => (strtoupper($request->input('input_no_polisi_k')[$i])),
                    'nobpkb'     => (strtoupper($request->input('input_no_bpkb_k')[$i])),
                    'norangka'   => (strtoupper($request->input('input_no_rangka_k')[$i])),
                    'nomesin'    => (strtoupper($request->input('input_no_mesin_k')[$i])),
                    'nilai'      => (DataController::formatangka($request->input('input_nilai_kendaraan_k')[$i])),
                    'dealer'     => (strtoupper($request->input('input_dealer_kend_k')[$i])),
                    'nostnk'     => (strtoupper($request->input('input_no_stnk_k')[$i])),
                    'berlaku'    => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_berlaku_stnk_k')[$i]))),
                    'nilpasar'   => (DataController::formatangka($request->input('input_nilai_pasar_ken_k')[$i])),
                    'niltaksasi' => (DataController::formatangka($request->input('input_nilai_taksasi_ken_k')[$i])),
                    'nilnjop'    => (DataController::formatangka($request->input('input_nilai_taksasi_ken_k')[$i])),
                    'ket'        => (strtoupper($request->input('input_fungsi_k')[$i])),
                    'opr'        => ($request->input('opr')[$i])
                    ]);
                    } 
                }                                               
            }

            if(count($request->input('input_jenis_kendaraan_k')) > 0){
                for($i=0;$i<count($request->input('input_jenis_kendaraan_k'));$i++){
                    if(($request->input('input_merk_kend_k')[$i] <> null) || ($request->input('input_merk_kend_k')[$i] <> '')){
                    DB::connection('pgsql')->table('agunan_kredit')->where('no_agunan',$request->input('input_nomor_k')[$i])->update([
                     'no_nsb'     => ($request->input('no_nsb')[$i]),
                    'status'     => ($request->input('status_k')[$i]),
                    'jenis'      => ($request->input('input_agunan1_k')[$i]),    
                    'jenisken'   => ($request->input('input_jenis_kendaraan_k')[$i]),
                    'pemilik'    => (strtoupper($request->input('input_nama_pemilik_kend_k')[$i])),
                    'alamat'     => (strtoupper($request->input('input_alamat_pemilik_kend_k')[$i])),
                    'kodya'      => (strtoupper($request->input('input_kodya_nasabah_k')[$i])),
                    'merktype'   => (strtoupper($request->input('input_merk_kend_k')[$i])),
                    'tahun'      => ($request->input('input_tahun_kend_k')[$i]),
                    // 'jenisfas'   => ($request->input('input_kode_jns_segFas_k')[$i]),
                    'kd_status'  => ($request->input('input_kode_stat_agunan_k')[$i]),
                    'jenisagun'  => ($request->input('input_kode_jns_agunan_k')[$i]),
                    // 'peringkat'  => ($request->input('input_peringkat_agunan_k')[$i]),
                    // 'lembaga'    => ($request->input('input_kode_lembaga_pemeringkat_k')[$i]),
                    'ikat'       => ($request->input('input_kode_jns_pengikatan_k')[$i]),
                    'tgl_ikat'   => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_k')[$i]))),
                    'bukti'      => ($request->input('input_no_bpkb_k')[$i]),
                    // 'ljk'        => (DataController::formatangka($request->input('input_nilai_agunanLJK_k')[$i])),
                    // 'tgl_nilai'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_k')[$i]))),
                    // 'indep'      => (DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_k')[$i])),
                    // 'namaindep'  => ($request->input('input_nm_penilai_k')[$i]),
                    // 'tgl_indep'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_k')[$i]))),
                    'paripasu'   => ($request->input('input_status_paripasu_k')[$i]),
                    'persen'     => ($request->input('input_persent_paripasu_k')[$i]),
                    'asuransi'   => ($request->input('input_diasuransikan_k')[$i]),
                    's_join'     => ($request->input('input_join_k')[$i]),
                    'warna'      => (strtoupper($request->input('input_warna_kend_k')[$i])),
                    'nopolisi'   => (strtoupper($request->input('input_no_polisi_k')[$i])),
                    'nobpkb'     => (strtoupper($request->input('input_no_bpkb_k')[$i])),
                    'norangka'   => (strtoupper($request->input('input_no_rangka_k')[$i])),
                    'nomesin'    => (strtoupper($request->input('input_no_mesin_k')[$i])),
                    'nilai'      => (DataController::formatangka($request->input('input_nilai_kendaraan_k')[$i])),
                    'dealer'     => (strtoupper($request->input('input_dealer_kend_k')[$i])),
                    'nostnk'     => (strtoupper($request->input('input_no_stnk_k')[$i])),
                    'berlaku'    => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_berlaku_stnk_k')[$i]))),
                    'nilpasar'   => (DataController::formatangka($request->input('input_nilai_pasar_ken_k')[$i])),
                    'niltaksasi' => (DataController::formatangka($request->input('input_nilai_taksasi_ken_k')[$i])),
                    'nilnjop'    => (DataController::formatangka($request->input('input_nilai_taksasi_ken_k')[$i])),
                    'ket'        => (strtoupper($request->input('input_fungsi_k')[$i])),
                    'opr'        => ($request->input('opr')[$i])
                    ]);
                     }      
                }
            }   

            if(count($request->input('input_no_sertifikat_s')) > 0){
                for($i=0;$i<count($request->input('input_no_sertifikat_s'));$i++){
                    if(($request->input('input_no_sertifikat_s')[$i] <> null) || ($request->input('input_no_sertifikat_s')[$i] <> '')){
                        DB::connection('pgsql')->table('agunan_sert')->where('no_agunan',$request->input('input_nomor_s')[$i])->update([
                        'no_nsb'     => ($request->input('no_nsb')[$i]),
                        'status'     => ($request->input('status_s')[$i]),
                        'jenis'      => ($request->input('input_agunan1_s')[$i]), 
                        'nosertif'   => ($request->input('input_no_sertifikat_s')[$i]),
                        'kodya'      => ($request->input('input_kodya_nasabah_s')[$i]),
                        'lokkodya'   => (strtoupper($request->input('input_lokasi_sert_s')[$i])),
                        'sertstatus' => ($request->input('input_jenis_sertifikat_s')[$i]),
                        // 'jenisfas'   => ($request->input('input_kode_jns_segFas_s')[$i]),
                        'kd_status'  => ($request->input('input_kode_stat_agunan_s')[$i]),
                        'jenisagun'  => ($request->input('input_kode_jns_agunan_s')[$i]),
                        // 'peringkat'  => ($request->input('input_peringkat_agunan_s')[$i]),
                        // 'lembaga'    => ($request->input('input_kode_lembaga_pemeringkat_s')[$i]),
                        'ikat'       => ($request->input('input_kode_jns_pengikatan_s')[$i]),
                        'tgl_ikat'   => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_s')[$i]))),
                        'bukti'      => ($request->input('input_no_sertifikat_s')[$i]),
                        // 'ljk'        => (DataController::formatangka($request->input('input_nilai_agunanLJK_s')[$i])),
                        // 'tgl_nilai'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_s')[$i]))),
                        // 'indep'      => (DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_s')[$i])),
                        // 'namaindep'  => ($request->input('input_nm_penilai_s')[$i]),
                        // 'tgl_indep'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_s')[$i]))),
                        'paripasu'   => ($request->input('input_status_paripasu_s')[$i]),
                        'persen'     => ($request->input('input_persent_paripasu_s')[$i]),
                        'asuransi'   => ($request->input('input_diasuransikan_s')[$i]),
                        's_join'     => ($request->input('input_join_s')[$i]),
                        'pemilik'    => (strtoupper($request->input('input_nama_pemilik_sert_s')[$i])),
                        'alamat'     => (strtoupper($request->input('input_alamat_pemilik_sert_s')[$i])),
                        'nilpasar'   => (DataController::formatangka($request->input('input_nilai_pasar_sert_s')[$i])),
                        'niltaksasi' => (DataController::formatangka($request->input('input_nilai_taksasi_sert_s')[$i])),
                        'nilnjop'    => (DataController::formatangka($request->input('input_nilai_njop_sert_s')[$i])),
                        'nilhaktg'   => (DataController::formatangka($request->input('input_nilai_ht_sert_s')[$i])),
                        'lokasi'     => (strtoupper($request->input('input_lokasi_sert_s')[$i])),
                        'luastanah'  => ($request->input('input_luas_tanah_s')[$i]),
                        'luasbangunan'   => ($request->input('input_luas_bangunan_s')[$i]),
                        'sfkt_ket'   => (strtoupper($request->input('input_keterangan_sert_s')[$i])),
                        'opr'        => ($request->input('opr')[$i])
                        ]);
                     }      
                }
            }   

            if(count($request->input('input_no_sertifikat_s')) > 0){
                for($i=0;$i<count($request->input('input_no_sertifikat_s'));$i++){
                    if(($request->input('input_no_sertifikat_s')[$i] <> null) || ($request->input('input_no_sertifikat_s')[$i] <> '')){
                        DB::connection('pgsql')->table('agunan_kredit')->where('no_agunan',$request->input('input_nomor_s')[$i])->update([
                        'no_nsb'     => ($request->input('no_nsb')[$i]),
                        'status'     => ($request->input('status_s')[$i]),
                        'jenis'      => ($request->input('input_agunan1_s')[$i]), 
                        'nosertif'   => ($request->input('input_no_sertifikat_s')[$i]),
                        'kodya'      => ($request->input('input_kodya_nasabah_s')[$i]),
                        'lokkodya'   => (strtoupper($request->input('input_lokasi_sert_s')[$i])),
                        'sertstatus' => ($request->input('input_jenis_sertifikat_s')[$i]),
                        // 'jenisfas'   => ($request->input('input_kode_jns_segFas_s')[$i]),
                        'kd_status'  => ($request->input('input_kode_stat_agunan_s')[$i]),
                        'jenisagun'  => ($request->input('input_kode_jns_agunan_s')[$i]),
                        // 'peringkat'  => ($request->input('input_peringkat_agunan_s')[$i]),
                        // 'lembaga'    => ($request->input('input_kode_lembaga_pemeringkat_s')[$i]),
                        'ikat'       => ($request->input('input_kode_jns_pengikatan_s')[$i]),
                        'tgl_ikat'   => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_s')[$i]))),
                        'bukti'      => ($request->input('input_no_sertifikat_s')[$i]),
                        // 'ljk'        => (DataController::formatangka($request->input('input_nilai_agunanLJK_s')[$i])),
                        // 'tgl_nilai'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_s')[$i]))),
                        // 'indep'      => (DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_s')[$i])),
                        // 'namaindep'  => ($request->input('input_nm_penilai_s')[$i]),
                        // 'tgl_indep'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_s')[$i]))),
                        'paripasu'   => ($request->input('input_status_paripasu_s')[$i]),
                        'persen'     => ($request->input('input_persent_paripasu_s')[$i]),
                        'asuransi'   => ($request->input('input_diasuransikan_s')[$i]),
                        's_join'     => ($request->input('input_join_s')[$i]),
                        'pemilik'    => (strtoupper($request->input('input_nama_pemilik_sert_s')[$i])),
                        'alamat'     => (strtoupper($request->input('input_alamat_pemilik_sert_s')[$i])),
                        'nilpasar'   => (DataController::formatangka($request->input('input_nilai_pasar_sert_s')[$i])),
                        'niltaksasi' => (DataController::formatangka($request->input('input_nilai_taksasi_sert_s')[$i])),
                        'nilnjop'    => (DataController::formatangka($request->input('input_nilai_njop_sert_s')[$i])),
                        'nilhaktg'   => (DataController::formatangka($request->input('input_nilai_ht_sert_s')[$i])),
                        'lokasi'     => (strtoupper($request->input('input_lokasi_sert_s')[$i])),
                        'luastanah'  => ($request->input('input_luas_tanah_s')[$i]),
                        'luasbangunan'   => ($request->input('input_luas_bangunan_s')[$i]),
                        'sfkt_ket'   => (strtoupper($request->input('input_keterangan_sert_s')[$i])),
                        'opr'        => ($request->input('opr')[$i])
                        ]);
                     }      
                }
            }   
        // } 

        $kendaraan = AgunanKendaraan::where('no_kredit',$nokredit)->first();
        $sertifikat = AgunanSertifikat::where('no_kredit',$nokredit)->first();

        // if(empty($kendaraan->no_agunan)||empty($sertifikat->no_agunan)){ 
        //     if(count($request->input('input_no_sertifikat_s')) > 0){
        //         $nextno =(int) AgunanSertifikat::max('no_agunan') + 1;
        //         for($i=0;$i<count($request->input('input_no_sertifikat_s'));$i++){
        //             if(($request->input('input_no_sertifikat_s')[$i] <> null) || ($request->input('input_no_sertifikat_s')[$i] <> '')){
        //                 $agunansert = new AgunanSertifikat;
        //                 // $agunansert->status =('         ')[$i]; 
        //                 $agunansert->jenis = $request->input('input_agunan_s')[$i]; 
        //                 $agunansert->no_nsb = $request->input('no_nsb')[$i]; 
        //                 // $agunansert->no_cif =$nasabah->no_cif; 
        //                 $agunansert->no_kredit= $request->input('no_kredit')[$i]; 
        //                 $agunansert->nosertif = $request->input('input_no_sertifikat_s')[$i];
        //                 $agunansert->kodya = $request->input('input_kodya_nasabah_s')[$i];
        //                 $agunansert->lokkodya = strtoupper($request->input('input_lokasi_sert_s')[$i]);
        //                 $agunansert->sertstatus = $request->input('input_jenis_sertifikat_s')[$i];
        //                 $agunansert->jenisfas = $request->input('input_kode_jns_segFas_s')[$i];
        //                 $agunansert->kd_status = $request->input('input_kode_stat_agunan_s')[$i];
        //                 $agunansert->jenisagun = $request->input('input_kode_jns_agunan_s')[$i];
        //                 $agunansert->peringkat = $request->input('input_peringkat_agunan_s')[$i];
        //                 $agunansert->lembaga = $request->input('input_kode_lembaga_pemeringkat_s')[$i];
        //                 $agunansert->ikat = $request->input('input_kode_jns_pengikatan_s')[$i];
        //                 $agunansert->tgl_ikat = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_s')[$i]));
        //                 $agunansert->bukti = $request->input('input_no_sertifikat_s')[$i];
        //                 $agunansert->ljk = DataController::formatangka($request->input('input_nilai_agunanLJK_s')[$i]);
        //                 $agunansert->tgl_nilai = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_s')[$i]));
        //                 $agunansert->indep = DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_s')[$i]);
        //                 $agunansert->namaindep = $request->input('input_nm_penilai_s')[$i];
        //                 $agunansert->tgl_indep = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_s')[$i]));
        //                 $agunansert->paripasu = $request->input('input_status_paripasu_s')[$i];
        //                 $agunansert->persen = $request->input('input_persent_paripasu_s')[$i];
        //                 $agunansert->asuransi = $request->input('input_diasuransikan_s')[$i];
        //                 $agunansert->s_join = $request->input('input_join_s')[$i];
        //                 $agunansert->pemilik = strtoupper($request->input('input_nama_pemilik_sert_s')[$i]);
        //                 $agunansert->alamat = strtoupper($request->input('input_alamat_pemilik_sert_s')[$i]);
        //                 $agunansert->no_agunan = str_pad($nextno,5,'0',STR_PAD_LEFT);
        //                 $agunansert->no_mohon = $request->input('no_mohon')[$i]; 
        //                 $agunansert->nilpasar = DataController::formatangka($request->input('input_nilai_pasar_sert_s')[$i]);
        //                 $agunansert->niltaksasi = DataController::formatangka($request->input('input_nilai_taksasi_sert_s')[$i]);
        //                 $agunansert->nilnjop = DataController::formatangka($request->input('input_nilai_njop_sert_s')[$i]);
        //                 $agunansert->nilhaktg = DataController::formatangka($request->input('input_nilai_ht_sert_s')[$i]);
        //                 $agunansert->lokasi = strtoupper($request->input('input_lokasi_sert_s')[$i]);
        //                 $agunansert->luastanah = $request->input('input_luas_tanah_s')[$i];
        //                 $agunansert->luasbangunan = $request->input('input_luas_bangunan_s')[$i];
        //                 $agunansert->sfkt_ket = strtoupper($request->input('input_keterangan_sert_s')[$i]);
        //                 $agunansert->kode_kantor = substr($agunansert->no_kredit,7,2);
        //                 // $agunansert->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')[$i]));
        //                 $agunansert->opr = $request->input('opr')[$i];
        //                 $agunansert->save();
        //                 $nextno = (int) $agunansert->no_agunan + 1;
        //             }
        //         }
        //     }
        //     if(count($request->input('input_jenis_kendaraan_k')) > 0){
        //         $nextno =(int) AgunanKendaraan::max('no_agunan') + 1;
        //         for($i=0;$i<count($request->input('input_jenis_kendaraan_k'));$i++){
        //             if(($request->input('input_merk_kend_k')[$i] <> null) || ($request->input('input_merk_kend_k')[$i] <> '')){
        //                 $agunankend = new AgunanKendaraan;  
        //                 // $agunankend->status = ('         ')[$i]; 
        //                 $agunankend->jenis = $request->input('input_agunan_k')[$i];        
        //                 //     $agun = $request->input('input_agunan1_k').'-'.str_pad(((int) agunan::max('no_agunan')+1),6,'0',STR_PAD_LEFT);
        //                 // $agunankend->no_agunan = $agun;
        //                 $agunankend->no_agunan = str_pad($nextno,5,'0',STR_PAD_LEFT);
        //                 $agunankend->no_nsb = $request->input('no_nsb')[$i];
        //                 // $agunankend->no_cif =$nasabah->no_cif;
        //                 $agunankend->no_mohon = $request->input('no_mohon')[$i]; 
        //                 $agunankend->no_kredit = $request->input('no_kredit')[$i]; 
        //                 // $agunankend->kode_kantor=$kredit->kode_kantor;   
        //                 $agunankend->jenisken = $request->input('input_jenis_kendaraan_k')[$i];
        //                 $agunankend->pemilik = strtoupper($request->input('input_nama_pemilik_kend_k')[$i]);
        //                 $agunankend->alamat = strtoupper($request->input('input_alamat_pemilik_kend_k')[$i]);
        //                 $agunankend->kodya = strtoupper($request->input('input_kodya_nasabah_k')[$i]);
        //                 $agunankend->merktype = strtoupper($request->input('input_merk_kend_k')[$i].' / '.$request->input('input_tipe_kend_k')[$i]);
        //                 $agunankend->tahun = $request->input('input_tahun_kend_k')[$i];
        //                 $agunankend->jenisfas = $request->input('input_kode_jns_segFas_k')[$i];
        //                 $agunankend->kd_status = $request->input('input_kode_stat_agunan_k')[$i];
        //                 // $agunankend->statusken = $request->input('input_status_kendaraan_k')[$i];
        //                 $agunankend->jenisagun = $request->input('input_kode_jns_agunan_k')[$i];
        //                 $agunankend->peringkat = $request->input('input_peringkat_agunan_k')[$i];
        //                 $agunankend->lembaga = $request->input('input_kode_lembaga_pemeringkat_k')[$i];
        //                 $agunankend->ikat = $request->input('input_kode_jns_pengikatan_k')[$i];
        //                 $agunankend->tgl_ikat = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_k')[$i]));
        //                 $agunankend->bukti = $request->input('input_no_bpkb_k')[$i];
        //                 $agunankend->ljk = DataController::formatangka($request->input('input_nilai_agunanLJK_k')[$i]);
        //                 $agunankend->tgl_nilai = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_k')[$i]));
        //                 $agunankend->indep = DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_k')[$i]);
        //                 $agunankend->namaindep = $request->input('input_nm_penilai_k')[$i];
        //                 $agunankend->tgl_indep = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_k')[$i]));
        //                 $agunankend->paripasu = $request->input('input_status_paripasu_k')[$i];
        //                 $agunankend->persen = $request->input('input_persent_paripasu_k')[$i];
        //                 $agunankend->asuransi = $request->input('input_diasuransikan_k')[$i];
        //                 $agunankend->s_join = $request->input('input_join_k')[$i];
        //                 $agunankend->warna = strtoupper($request->input('input_warna_kend_k')[$i]);
        //                 $agunankend->nopolisi = strtoupper($request->input('input_no_polisi_k')[$i]);
        //                 $agunankend->nobpkb = strtoupper($request->input('input_no_bpkb_k')[$i]);
        //                 $agunankend->norangka = strtoupper($request->input('input_no_rangka_k')[$i]);
        //                 $agunankend->nomesin = strtoupper($request->input('input_no_mesin_k')[$i]);
        //                 $agunankend->nilai = DataController::formatangka($request->input('input_nilai_kendaraan_k')[$i]);
        //                 // $agunankend->camat = strtoupper($request->input('input_kecamatan_pemilik_kend_k')[$i]);
        //                 $agunankend->dealer = strtoupper($request->input('input_dealer_kend_k')[$i]);
        //                 $agunankend->nostnk = strtoupper($request->input('input_no_stnk_k')[$i]);
        //                 $agunankend->berlaku = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_berlaku_stnk_k')[$i]));
        //                 // $agunankend->kelompok = strtoupper($request->input('input_kelompok_kend_k')[$i]);
        //                 $agunankend->nilpasar = DataController::formatangka($request->input('input_nilai_pasar_ken_k')[$i]);
        //                 $agunankend->niltaksasi = DataController::formatangka($request->input('input_nilai_taksasi_ken_k')[$i]);
        //                 $agunankend->kode_kantor = substr($agunankend->no_kredit,7,2);
        //                 $agunankend->nilnjop = $agunankend->niltaksasi;
        //                 // $agunankend->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')[$i]));
        //                 $agunankend->ket = strtoupper($request->input('input_fungsi_k')[$i]);
        //                 $agunankend->opr = $request->input('opr')[$i];
        //                 $agunankend->save();
        //                 $nextno = (int) $agunankend->no_agunan + 1;
        //             }
        //         }
        //     }

        //     if(count($request->input('input_no_sertifikat_s')) > 0){
        //         $nextno =(int) AgunanSertifikat::max('no_agunan') + 1;
        //         for($i=0;$i<count($request->input('input_no_sertifikat_s'));$i++){
        //             if(($request->input('input_no_sertifikat_s')[$i] <> null) || ($request->input('input_no_sertifikat_s')[$i] <> '')){
        //                 $agunankredit = new AgunanKredit;
        //                 // $agunankredit->status = ('         ')[$i]; 
        //                 $agunankredit->jenis = $request->input('input_agunan_s')[$i]; 
        //                 $agunankredit->no_nsb = $request->input('no_nsb')[$i]; 
        //                 // $agunankredit->no_cif =$nasabah->no_cif;
        //                 $agunankredit->no_kredit= $request->input('no_kredit')[$i]; 
        //                 $agunankredit->nosertif = $request->input('input_no_sertifikat_s')[$i];
        //                 $agunankredit->kodya = $request->input('input_kodya_nasabah_s')[$i];
        //                 $agunankredit->lokkodya = strtoupper($request->input('input_lokasi_sert_s')[$i]);
        //                 $agunankredit->sertstatus = $request->input('input_jenis_sertifikat_s')[$i];
        //                 $agunankredit->jenisfas = $request->input('input_kode_jns_segFas_s')[$i];
        //                 $agunankredit->kd_status = $request->input('input_kode_stat_agunan_s')[$i];
        //                 $agunankredit->jenisagun = $request->input('input_kode_jns_agunan_s')[$i];
        //                 $agunankredit->peringkat = $request->input('input_peringkat_agunan_s')[$i];
        //                 $agunankredit->lembaga = $request->input('input_kode_lembaga_pemeringkat_s')[$i];
        //                 $agunankredit->ikat = $request->input('input_kode_jns_pengikatan_s')[$i];
        //                 $agunankredit->tgl_ikat = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_s')[$i]));
        //                 $agunankredit->bukti = $request->input('input_no_sertifikat_s')[$i];
        //                 $agunankredit->ljk = DataController::formatangka($request->input('input_nilai_agunanLJK_s')[$i]);
        //                 $agunankredit->tgl_nilai = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_s')[$i]));
        //                 $agunankredit->indep = DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_s')[$i]);
        //                 $agunankredit->namaindep = $request->input('input_nm_penilai_s')[$i];
        //                 $agunankredit->tgl_indep = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_s')[$i]));
        //                 $agunankredit->paripasu = $request->input('input_status_paripasu_s')[$i];
        //                 $agunankredit->persen = $request->input('input_persent_paripasu_s')[$i];
        //                 $agunankredit->asuransi = $request->input('input_diasuransikan_s')[$i];
        //                 $agunankredit->s_join = $request->input('input_join_s')[$i];
        //                 $agunankredit->pemilik = strtoupper($request->input('input_nama_pemilik_sert_s')[$i]);
        //                 $agunankredit->alamat = strtoupper($request->input('input_alamat_pemilik_sert_s')[$i]);
        //                 $agunankredit->no_agunan = str_pad($nextno,5,'0',STR_PAD_LEFT);
        //                 $agunankredit->no_mohon = $request->input('no_mohon')[$i]; 
        //                 $agunankredit->nilpasar = DataController::formatangka($request->input('input_nilai_pasar_sert_s')[$i]);
        //                 $agunankredit->niltaksasi = DataController::formatangka($request->input('input_nilai_taksasi_sert_s')[$i]);
        //                 $agunankredit->nilnjop = DataController::formatangka($request->input('input_nilai_njop_sert_s')[$i]);
        //                 $agunankredit->nilhaktg = DataController::formatangka($request->input('input_nilai_ht_sert_s')[$i]);
        //                 $agunankredit->lokasi = strtoupper($request->input('input_lokasi_sert_s')[$i]);
        //                 $agunankredit->luastanah = $request->input('input_luas_tanah_s')[$i];
        //                 $agunankredit->luasbangunan = $request->input('input_luas_bangunan_s')[$i];
        //                 $agunankredit->sfkt_ket = strtoupper($request->input('input_keterangan_sert_s')[$i]);
        //                 $agunankredit->kode_kantor = substr($agunankredit->no_kredit,7,2);
        //                 // $agunankredit->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')[$i]));
        //                 $agunankredit->opr = $request->input('opr')[$i];
        //                 $agunankredit->save();
        //                 $nextno = (int) $agunankredit->no_agunan + 1;
        //             }
        //         }
        //     }
        //     if(count($request->input('input_jenis_kendaraan_k')) > 0){
        //         $nextno =(int) AgunanKendaraan::max('no_agunan') + 1;
        //         for($i=0;$i<count($request->input('input_jenis_kendaraan_k'));$i++){
        //             if(($request->input('input_merk_kend_k')[$i] <> null) || ($request->input('input_merk_kend_k')[$i] <> '')){
        //                 $agunankredit = new AgunanKredit;  
        //                 // $agunankredit->status = ('         ')[$i]; 
        //                 $agunankredit->jenis = $request->input('input_agunan_k')[$i];        
        //                 //     $agun = $request->input('input_agunan1_k').'-'.str_pad(((int) agunan::max('no_agunan')+1),6,'0',STR_PAD_LEFT);
        //                 // $agunankredit->no_agunan = $agun;
        //                 $agunankredit->no_agunan = str_pad($nextno,5,'0',STR_PAD_LEFT);
        //                 $agunankredit->no_nsb = $request->input('no_nsb')[$i];
        //                 // $agunankredit->no_cif =$nasabah->no_cif;
        //                 $agunankredit->no_mohon = $request->input('no_mohon')[$i]; 
        //                 $agunankredit->no_kredit = $request->input('no_kredit')[$i]; 
        //                 // $agunankredit->kode_kantor=$kredit->kode_kantor;   
        //                 $agunankredit->jenisken = $request->input('input_jenis_kendaraan_k')[$i];
        //                 $agunankredit->pemilik = strtoupper($request->input('input_nama_pemilik_kend_k')[$i]);
        //                 $agunankredit->alamat = strtoupper($request->input('input_alamat_pemilik_kend_k')[$i]);
        //                 $agunankredit->kodya = strtoupper($request->input('input_kodya_nasabah_k')[$i]);
        //                 $agunankredit->merktype = strtoupper($request->input('input_merk_kend_k')[$i].' / '.$request->input('input_tipe_kend_k')[$i]);
        //                 $agunankredit->tahun = $request->input('input_tahun_kend_k')[$i];
        //                 $agunankredit->jenisfas = $request->input('input_kode_jns_segFas_k')[$i];
        //                 $agunankredit->kd_status = $request->input('input_kode_stat_agunan_k')[$i];
        //                 // $agunankredit->statusken = $request->input('input_status_kendaraan_k')[$i];
        //                 $agunankredit->jenisagun = $request->input('input_kode_jns_agunan_k')[$i];
        //                 $agunankredit->peringkat = $request->input('input_peringkat_agunan_k')[$i];
        //                 $agunankredit->lembaga = $request->input('input_kode_lembaga_pemeringkat_k')[$i];
        //                 $agunankredit->ikat = $request->input('input_kode_jns_pengikatan_k')[$i];
        //                 $agunankredit->tgl_ikat = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_k')[$i]));
        //                 $agunankredit->bukti = $request->input('input_no_bpkb_k')[$i];
        //                 $agunankredit->ljk = DataController::formatangka($request->input('input_nilai_agunanLJK_k')[$i]);
        //                 $agunankredit->tgl_nilai = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_k')[$i]));
        //                 $agunankredit->indep = DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_k')[$i]);
        //                 $agunankredit->namaindep = $request->input('input_nm_penilai_k')[$i];
        //                 $agunankredit->tgl_indep = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_k')[$i]));
        //                 $agunankredit->paripasu = $request->input('input_status_paripasu_k')[$i];
        //                 $agunankredit->persen = $request->input('input_persent_paripasu_k')[$i];
        //                 $agunankredit->asuransi = $request->input('input_diasuransikan_k')[$i];
        //                 $agunankredit->s_join = $request->input('input_join_k')[$i];
        //                 $agunankredit->warna = strtoupper($request->input('input_warna_kend_k')[$i]);
        //                 $agunankredit->nopolisi = strtoupper($request->input('input_no_polisi_k')[$i]);
        //                 $agunankredit->nobpkb = strtoupper($request->input('input_no_bpkb_k')[$i]);
        //                 $agunankredit->norangka = strtoupper($request->input('input_no_rangka_k')[$i]);
        //                 $agunankredit->nomesin = strtoupper($request->input('input_no_mesin_k')[$i]);
        //                 $agunankredit->nilai = DataController::formatangka($request->input('input_nilai_kendaraan_k')[$i]);
        //                 // $agunankredit->camat = strtoupper($request->input('input_kecamatan_pemilik_kend_k')[$i]);
        //                 $agunankredit->dealer = strtoupper($request->input('input_dealer_kend_k')[$i]);
        //                 $agunankredit->nostnk = strtoupper($request->input('input_no_stnk_k')[$i]);
        //                 $agunankredit->berlaku = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_berlaku_stnk_k')[$i]));
        //                 // $agunankredit->kelompok = strtoupper($request->input('input_kelompok_kend_k')[$i]);
        //                 $agunankredit->nilpasar = DataController::formatangka($request->input('input_nilai_pasar_ken_k')[$i]);
        //                 $agunankredit->niltaksasi = DataController::formatangka($request->input('input_nilai_taksasi_ken_k')[$i]);
        //                 $agunankredit->kode_kantor = substr($agunankredit->no_kredit,7,2);
        //                 $agunankredit->nilnjop = $agunankredit->niltaksasi;
        //                 // $agunankredit->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')[$i]));
        //                 $agunankredit->ket = strtoupper($request->input('input_fungsi_k')[$i]);
        //                 $agunankredit->opr = $request->input('opr')[$i];
        //                 $agunankredit->save();
        //                 $nextno = (int) $agunankredit->no_agunan + 1;
        //             }
        //         }
        //     }
        // }                        

        return redirect('/koreksidata');
    }

    public function viewtambahagunan($tahun,$kode_kantor,$nourut)
    {

        $jenisfas =  DB::connection('pgsql')->table('mst_sefas')->orderBy('sandi','asc')->get();
        $status =  DB::connection('pgsql')->table('mst_stat')->orderBy('sandi','asc')->get();
        $jenisagun =  DB::connection('pgsql')->table('mst_agunan')->orderBy('kode','asc')->get();
        $lembaga =  DB::connection('pgsql')->table('lembaga')->orderBy('kode','asc')->get();
        $ikat =  DB::connection('pgsql')->table('mst_ikat')->orderBy('kode','asc')->get();
        $dati2 = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
       
        // $nasabah = Nasabah::where('no_nsb',$nonsb)->first();
        $nokredit = $tahun.'/'.$kode_kantor.'/'.$nourut;
        $prekredit = Prekredit::where('no_kredit',$nokredit)->first();
        $kredit = Kredit::where('no_kredit',$nokredit)->get();

        return view('koreksi.tambahagunan',compact('jenisfas','status','jenisagun','lembaga','ikat','dati2','nasabah','prekredit','kredit'));   
        }

    public function savetambahagunan(Request $request,$nokredit)
    {
        $nasabah = Nasabah::where('no_nsb',$request->input('no_nsb'))->first();
        $prekredit = Prekredit::where('no_kredit',$request->input('no_kredit'))->first();
        $kredit = Kredit::where('no_kredit',$nokredit)->get();

        if(count($request->input('input_no_sertifikat_s')) > 0){
            $nextno =(int) AgunanSertifikat::max('no_agunan') + 1;
            for($i=0;$i<count($request->input('input_no_sertifikat_s'));$i++){
                if(($request->input('input_no_sertifikat_s')[$i] <> null) || ($request->input('input_no_sertifikat_s')[$i] <> '')){
                    $agunansert = new AgunanSertifikat;
                    // $agunansert->status =('         ')[$i]; 
                    $agunansert->jenis = $request->input('input_agunan_s')[$i]; 
                    $agunansert->no_nsb =$nasabah->no_nsb; 
                    // $agunansert->no_cif =$nasabah->no_cif; 
                    $agunansert->no_kredit=$prekredit->no_kredit;
                    $agunansert->nosertif = $request->input('input_no_sertifikat_s')[$i];
                    $agunansert->kodya = $request->input('input_kodya_nasabah_s')[$i];
                    $agunansert->lokkodya = strtoupper($request->input('input_lokasi_sert_s')[$i]);
                    $agunansert->sertstatus = $request->input('input_jenis_sertifikat_s')[$i];
                    // $agunansert->jenisfas = $request->input('input_kode_jns_segFas_s')[$i];
                    $agunansert->kd_status = $request->input('input_kode_stat_agunan_s')[$i];
                    $agunansert->jenisagun = $request->input('input_kode_jns_agunan_s')[$i];
                    // $agunansert->peringkat = $request->input('input_peringkat_agunan_s')[$i];
                    // $agunansert->lembaga = $request->input('input_kode_lembaga_pemeringkat_s')[$i];
                    $agunansert->ikat = $request->input('input_kode_jns_pengikatan_s')[$i];
                    $agunansert->tgl_ikat = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_s')[$i]));
                    $agunansert->bukti = $request->input('input_no_sertifikat_s')[$i];
                    // $agunansert->ljk = DataController::formatangka($request->input('input_nilai_agunanLJK_s')[$i]);
                    // $agunansert->tgl_nilai = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_s')[$i]));
                    // $agunansert->indep = DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_s')[$i]);
                    // $agunansert->namaindep = $request->input('input_nm_penilai_s')[$i];
                    // $agunansert->tgl_indep = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_s')[$i]));
                    $agunansert->paripasu = $request->input('input_status_paripasu_s')[$i];
                    $agunansert->persen = $request->input('input_persent_paripasu_s')[$i];
                    $agunansert->asuransi = $request->input('input_diasuransikan_s')[$i];
                    $agunansert->s_join = $request->input('input_join_s')[$i];
                    $agunansert->pemilik = strtoupper($request->input('input_nama_pemilik_sert_s')[$i]);
                    $agunansert->alamat = strtoupper($request->input('input_alamat_pemilik_sert_s')[$i]);
                    $agunansert->no_agunan = str_pad($nextno,5,'0',STR_PAD_LEFT);
                    $agunansert->no_mohon = $prekredit->no_mohon;
                    $agunansert->nilpasar = DataController::formatangka($request->input('input_nilai_pasar_sert_s')[$i]);
                    $agunansert->niltaksasi = DataController::formatangka($request->input('input_nilai_taksasi_sert_s')[$i]);
                    $agunansert->nilnjop = DataController::formatangka($request->input('input_nilai_njop_sert_s')[$i]);
                    $agunansert->nilhaktg = DataController::formatangka($request->input('input_nilai_ht_sert_s')[$i]);
                    $agunansert->lokasi = strtoupper($request->input('input_lokasi_sert_s')[$i]);
                    $agunansert->luastanah = $request->input('input_luas_tanah_s')[$i];
                    $agunansert->luasbangunan = $request->input('input_luas_bangunan_s')[$i];
                    $agunansert->sfkt_ket = strtoupper($request->input('input_keterangan_sert_s')[$i]);
                    $agunansert->kode_kantor = substr($agunansert->no_kredit,7,2);
                    $agunansert->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')));
                    // $agunansert->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')[$i]));
                    $agunansert->opr = $request->input('opr');
                    $agunansert->save();
                    $nextno = (int) $agunansert->no_agunan + 1;
                }
            }
        }
        if(count($request->input('input_jenis_kendaraan_k')) > 0){
            $nextno =(int) AgunanKendaraan::max('no_agunan') + 1;
            for($i=0;$i<count($request->input('input_jenis_kendaraan_k'));$i++){
                if(($request->input('input_merk_kend_k')[$i] <> null) || ($request->input('input_merk_kend_k')[$i] <> '')){
                    $agunankend = new AgunanKendaraan;  
                    // $agunankend->status = ('         ')[$i]; 
                    $agunankend->jenis = $request->input('input_agunan_k')[$i];        
                    //     $agun = $request->input('input_agunan1_k').'-'.str_pad(((int) agunan::max('no_agunan')+1),6,'0',STR_PAD_LEFT);
                    // $agunankend->no_agunan = $agun;
                    $agunankend->no_agunan = str_pad($nextno,5,'0',STR_PAD_LEFT);
                    $agunankend->no_nsb =$nasabah->no_nsb;
                    // $agunankend->no_cif =$nasabah->no_cif;
                    $agunankend->no_mohon = $prekredit->no_mohon;
                    $agunankend->no_kredit = $prekredit->no_kredit;
                    // $agunankend->kode_kantor=$kredit->kode_kantor;   
                    $agunankend->jenisken = $request->input('input_jenis_kendaraan_k')[$i];
                    $agunankend->pemilik = strtoupper($request->input('input_nama_pemilik_kend_k')[$i]);
                    $agunankend->alamat = strtoupper($request->input('input_alamat_pemilik_kend_k')[$i]);
                    $agunankend->kodya = strtoupper($request->input('input_kodya_nasabah_k')[$i]);
                    $agunankend->merktype = strtoupper($request->input('input_merk_kend_k')[$i].' / '.$request->input('input_tipe_kend_k')[$i]);
                    $agunankend->tahun = $request->input('input_tahun_kend_k')[$i];
                    // $agunankend->jenisfas = $request->input('input_kode_jns_segFas_k')[$i];
                    $agunankend->kd_status = $request->input('input_kode_stat_agunan_k')[$i];
                    // $agunankend->statusken = $request->input('input_status_kendaraan_k')[$i];
                    $agunankend->jenisagun = $request->input('input_kode_jns_agunan_k')[$i];
                    // $agunankend->peringkat = $request->input('input_peringkat_agunan_k')[$i];
                    // $agunankend->lembaga = $request->input('input_kode_lembaga_pemeringkat_k')[$i];
                    $agunankend->ikat = $request->input('input_kode_jns_pengikatan_k')[$i];
                    $agunankend->tgl_ikat = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_k')[$i]));
                    $agunankend->bukti = $request->input('input_no_bpkb_k')[$i];
                    // $agunankend->ljk = DataController::formatangka($request->input('input_nilai_agunanLJK_k')[$i]);
                    // $agunankend->tgl_nilai = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_k')[$i]));
                    // $agunankend->indep = DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_k')[$i]);
                    // $agunankend->namaindep = $request->input('input_nm_penilai_k')[$i];
                    // $agunankend->tgl_indep = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_k')[$i]));
                    $agunankend->paripasu = $request->input('input_status_paripasu_k')[$i];
                    $agunankend->persen = $request->input('input_persent_paripasu_k')[$i];
                    $agunankend->asuransi = $request->input('input_diasuransikan_k')[$i];
                    $agunankend->s_join = $request->input('input_join_k')[$i];
                    $agunankend->warna = strtoupper($request->input('input_warna_kend_k')[$i]);
                    $agunankend->nopolisi = strtoupper($request->input('input_no_polisi_k')[$i]);
                    $agunankend->nobpkb = strtoupper($request->input('input_no_bpkb_k')[$i]);
                    $agunankend->norangka = strtoupper($request->input('input_no_rangka_k')[$i]);
                    $agunankend->nomesin = strtoupper($request->input('input_no_mesin_k')[$i]);
                    $agunankend->nilai = DataController::formatangka($request->input('input_nilai_kendaraan_k')[$i]);
                    // $agunankend->camat = strtoupper($request->input('input_kecamatan_pemilik_kend_k')[$i]);
                    $agunankend->dealer = strtoupper($request->input('input_dealer_kend_k')[$i]);
                    $agunankend->nostnk = strtoupper($request->input('input_no_stnk_k')[$i]);
                    $agunankend->berlaku = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_berlaku_stnk_k')[$i]));
                    // $agunankend->kelompok = strtoupper($request->input('input_kelompok_kend_k')[$i]);
                    $agunankend->nilpasar = DataController::formatangka($request->input('input_nilai_pasar_ken_k')[$i]);
                    $agunankend->niltaksasi = DataController::formatangka($request->input('input_nilai_taksasi_ken_k')[$i]);
                    $agunankend->kode_kantor = substr($agunankend->no_kredit,7,2);
                    $agunankend->nilnjop = $agunankend->niltaksasi;
                    $agunankend->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')));
                    // $agunankend->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')[$i]));
                    $agunankend->ket = strtoupper($request->input('input_fungsi_k')[$i]);
                    $agunankend->opr = $request->input('opr');
                    $agunankend->save();
                    $nextno = (int) $agunankend->no_agunan + 1;
                }
            }
        }

        if(count($request->input('input_no_sertifikat_s')) > 0){
            $nextno =(int) AgunanSertifikat::max('no_agunan') + 1;
            for($i=0;$i<count($request->input('input_no_sertifikat_s'));$i++){
                if(($request->input('input_no_sertifikat_s')[$i] <> null) || ($request->input('input_no_sertifikat_s')[$i] <> '')){
                    $agunankredit = new AgunanKredit;
                    // $agunankredit->status = ('         ')[$i]; 
                    $agunankredit->jenis = $request->input('input_agunan_s')[$i]; 
                    $agunankredit->no_nsb =$nasabah->no_nsb; 
                    // $agunankredit->no_cif =$nasabah->no_cif;
                    $agunankredit->no_kredit=$prekredit->no_kredit;
                    $agunankredit->nosertif = $request->input('input_no_sertifikat_s')[$i];
                    $agunankredit->kodya = $request->input('input_kodya_nasabah_s')[$i];
                    $agunankredit->lokkodya = strtoupper($request->input('input_lokasi_sert_s')[$i]);
                    $agunankredit->sertstatus = $request->input('input_jenis_sertifikat_s')[$i];
                    // $agunankredit->jenisfas = $request->input('input_kode_jns_segFas_s')[$i];
                    $agunankredit->kd_status = $request->input('input_kode_stat_agunan_s')[$i];
                    $agunankredit->jenisagun = $request->input('input_kode_jns_agunan_s')[$i];
                    // $agunankredit->peringkat = $request->input('input_peringkat_agunan_s')[$i];
                    // $agunankredit->lembaga = $request->input('input_kode_lembaga_pemeringkat_s')[$i];
                    $agunankredit->ikat = $request->input('input_kode_jns_pengikatan_s')[$i];
                    $agunankredit->tgl_ikat = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_s')[$i]));
                    $agunankredit->bukti = $request->input('input_no_sertifikat_s')[$i];
                    // $agunankredit->ljk = DataController::formatangka($request->input('input_nilai_agunanLJK_s')[$i]);
                    // $agunankredit->tgl_nilai = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_s')[$i]));
                    // $agunankredit->indep = DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_s')[$i]);
                    // $agunankredit->namaindep = $request->input('input_nm_penilai_s')[$i];
                    // $agunankredit->tgl_indep = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_s')[$i]));
                    $agunankredit->paripasu = $request->input('input_status_paripasu_s')[$i];
                    $agunankredit->persen = $request->input('input_persent_paripasu_s')[$i];
                    $agunankredit->asuransi = $request->input('input_diasuransikan_s')[$i];
                    $agunankredit->s_join = $request->input('input_join_s')[$i];
                    $agunankredit->pemilik = strtoupper($request->input('input_nama_pemilik_sert_s')[$i]);
                    $agunankredit->alamat = strtoupper($request->input('input_alamat_pemilik_sert_s')[$i]);
                    $agunankredit->no_agunan = str_pad($nextno,5,'0',STR_PAD_LEFT);
                    $agunankredit->no_mohon = $prekredit->no_mohon;
                    $agunankredit->nilpasar = DataController::formatangka($request->input('input_nilai_pasar_sert_s')[$i]);
                    $agunankredit->niltaksasi = DataController::formatangka($request->input('input_nilai_taksasi_sert_s')[$i]);
                    $agunankredit->nilnjop = DataController::formatangka($request->input('input_nilai_njop_sert_s')[$i]);
                    $agunankredit->nilhaktg = DataController::formatangka($request->input('input_nilai_ht_sert_s')[$i]);
                    $agunankredit->lokasi = strtoupper($request->input('input_lokasi_sert_s')[$i]);
                    $agunankredit->luastanah = $request->input('input_luas_tanah_s')[$i];
                    $agunankredit->luasbangunan = $request->input('input_luas_bangunan_s')[$i];
                    $agunankredit->sfkt_ket = strtoupper($request->input('input_keterangan_sert_s')[$i]);
                    $agunankredit->kode_kantor = substr($agunankredit->no_kredit,7,2);
                    $agunankredit->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')));
                    // $agunankredit->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')[$i]));
                    $agunankredit->opr = $request->input('opr');
                    $agunankredit->save();
                    $nextno = (int) $agunankredit->no_agunan + 1;
                }
            }
        }
        if(count($request->input('input_jenis_kendaraan_k')) > 0){
            $nextno =(int) AgunanKendaraan::max('no_agunan') + 1;
            for($i=0;$i<count($request->input('input_jenis_kendaraan_k'));$i++){
                if(($request->input('input_merk_kend_k')[$i] <> null) || ($request->input('input_merk_kend_k')[$i] <> '')){
                    $agunankredit = new AgunanKredit;  
                    // $agunankredit->status = ('         ')[$i]; 
                    $agunankredit->jenis = $request->input('input_agunan_k')[$i];        
                    //     $agun = $request->input('input_agunan1_k').'-'.str_pad(((int) agunan::max('no_agunan')+1),6,'0',STR_PAD_LEFT);
                    // $agunankredit->no_agunan = $agun;
                    $agunankredit->no_agunan = str_pad($nextno,5,'0',STR_PAD_LEFT);
                    $agunankredit->no_nsb =$nasabah->no_nsb;
                    // $agunankredit->no_cif =$nasabah->no_cif;
                    $agunankredit->no_mohon = $prekredit->no_mohon;
                    $agunankredit->no_kredit = $prekredit->no_kredit;
                    // $agunankredit->kode_kantor=$kredit->kode_kantor;   
                    $agunankredit->jenisken = $request->input('input_jenis_kendaraan_k')[$i];
                    $agunankredit->pemilik = strtoupper($request->input('input_nama_pemilik_kend_k')[$i]);
                    $agunankredit->alamat = strtoupper($request->input('input_alamat_pemilik_kend_k')[$i]);
                    $agunankredit->kodya = strtoupper($request->input('input_kodya_nasabah_k')[$i]);
                    $agunankredit->merktype = strtoupper($request->input('input_merk_kend_k')[$i].' / '.$request->input('input_tipe_kend_k')[$i]);
                    $agunankredit->tahun = $request->input('input_tahun_kend_k')[$i];
                    // $agunankredit->jenisfas = $request->input('input_kode_jns_segFas_k')[$i];
                    $agunankredit->kd_status = $request->input('input_kode_stat_agunan_k')[$i];
                    // $agunankredit->statusken = $request->input('input_status_kendaraan_k')[$i];
                    $agunankredit->jenisagun = $request->input('input_kode_jns_agunan_k')[$i];
                    // $agunankredit->peringkat = $request->input('input_peringkat_agunan_k')[$i];
                    // $agunankredit->lembaga = $request->input('input_kode_lembaga_pemeringkat_k')[$i];
                    $agunankredit->ikat = $request->input('input_kode_jns_pengikatan_k')[$i];
                    $agunankredit->tgl_ikat = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_k')[$i]));
                    $agunankredit->bukti = $request->input('input_no_bpkb_k')[$i];
                    // $agunankredit->ljk = DataController::formatangka($request->input('input_nilai_agunanLJK_k')[$i]);
                    // $agunankredit->tgl_nilai = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_k')[$i]));
                    // $agunankredit->indep = DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_k')[$i]);
                    // $agunankredit->namaindep = $request->input('input_nm_penilai_k')[$i];
                    // $agunankredit->tgl_indep = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_k')[$i]));
                    $agunankredit->paripasu = $request->input('input_status_paripasu_k')[$i];
                    $agunankredit->persen = $request->input('input_persent_paripasu_k')[$i];
                    $agunankredit->asuransi = $request->input('input_diasuransikan_k')[$i];
                    $agunankredit->s_join = $request->input('input_join_k')[$i];
                    $agunankredit->warna = strtoupper($request->input('input_warna_kend_k')[$i]);
                    $agunankredit->nopolisi = strtoupper($request->input('input_no_polisi_k')[$i]);
                    $agunankredit->nobpkb = strtoupper($request->input('input_no_bpkb_k')[$i]);
                    $agunankredit->norangka = strtoupper($request->input('input_no_rangka_k')[$i]);
                    $agunankredit->nomesin = strtoupper($request->input('input_no_mesin_k')[$i]);
                    $agunankredit->nilai = DataController::formatangka($request->input('input_nilai_kendaraan_k')[$i]);
                    // $agunankredit->camat = strtoupper($request->input('input_kecamatan_pemilik_kend_k')[$i]);
                    $agunankredit->dealer = strtoupper($request->input('input_dealer_kend_k')[$i]);
                    $agunankredit->nostnk = strtoupper($request->input('input_no_stnk_k')[$i]);
                    $agunankredit->berlaku = date('Y-m-d H:i:s',strtotime($request->input('input_tgl_berlaku_stnk_k')[$i]));
                    // $agunankredit->kelompok = strtoupper($request->input('input_kelompok_kend_k')[$i]);
                    $agunankredit->nilpasar = DataController::formatangka($request->input('input_nilai_pasar_ken_k')[$i]);
                    $agunankredit->niltaksasi = DataController::formatangka($request->input('input_nilai_taksasi_ken_k')[$i]);
                    $agunankredit->kode_kantor = substr($agunankredit->no_kredit,7,2);
                    $agunankredit->nilnjop = $agunankredit->niltaksasi;
                    $agunankredit->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')));
                    // $agunankredit->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')[$i]));
                    $agunankredit->ket = strtoupper($request->input('input_fungsi_k')[$i]);
                    $agunankredit->opr = $request->input('opr');
                    $agunankredit->save();
                    $nextno = (int) $agunankredit->no_agunan + 1;
                }
            }
        }

        
        return redirect('/koreksidata');
    }
    
     public function dataFormNasabahKoreksi($nonsb)
    {
        $nasabah = Nasabah::where('no_nsb',$nonsb)->get();
        $psnasabah = PasanganNasabah::where('no_nsb',$nonsb)->get();
        $pengurus = Pengurus::where('no_nsb',$nonsb)->get();
        // log::info(json_encode($psnasabah));

        $kodya = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc1','asc')->get();
        $kerja = DB::connection('pgsql')->table('mst_kerja')->orderBy('kode','asc')->get();
        $usaha = DB::connection('pgsql')->table('mst_eko')->where('status',' ')->orderBy('kode','asc')->get();
        $gelar = DB::connection('pgsql')->table('mst_gelar')->orderBy('kode','asc')->orderBy('kode','asc')->get();
        $negara = DB::connection('pgsql')->table('mst_negara')->orderBy('kode','asc')->get();
        $hubbank = DB::connection('pgsql')->table('mst_lapor')->orderBy('kode','asc')->get();
        $goldeb = DB::connection('pgsql')->table('mst_goldeb')->where('status',' ')->orderBy('sandi','asc')->get();
        $sumber = DB::connection('pgsql')->table('mst_sumber')->orderBy('kode','asc')->get();
        $jabatan = DB::connection('pgsql')->table('mst_jabatan')->orderBy('kode','asc')->get();
        $badan = DB::connection('pgsql')->table('mst_badanusaha')->orderBy('kode','asc')->get();
        $eko = DB::connection('pgsql')->table('mst_eko')->where('status',' ')->orderBy('kode','asc')->get();
        $lembaga =  DB::connection('pgsql')->table('lembaga')->orderBy('kode','asc')->get();
        $kelurahan = DB::connection('pgsql')->table('mst_kelurahan')->where('status','ada')->orderBy('nama','asc')->get();
        $kecamatan = DB::connection('pgsql')->table('mst_kecamatan')->where('status','ada')->orderBy('nama','asc')->get();
        // if(isset($psnasabah)){
        //     $psnasabah = PasanganNasabah::where('no_nsb',$nonsb)->get();
        // }
        // else{
            
        // }

        return view('koreksi.nasabahkoreksi',compact('nasabah','psnasabah','nonsb','kodya','kerja','usaha','gelar','negara','hubbank','goldeb','sumber','jabatan','pengurus','eko','lembaga','badan','kelurahan','kecamatan'));   
    }

     public function saveFormNasabahKoreksi(Request $request,$nonsb)
    {
        $psnasabah = PasanganNasabah::where('no_nsb',$nonsb)->get();
        $dati = $request->input('input_kodya_nasabah');
        // $dati = explode('-',$request->input('input_kodya_nasabah'));

        DB::connection('pgsql')->table('nasabah')->where('no_nsb',$nonsb)->update([
            'no_nsb'        => ($nonsb),
            'no_cif'        => ($request->input('no_cif')),
            'nama'          => ($request->input('input_nama_nasabah')),
            'kelamin'       => ($request->input('input_jenis_kelamin_nasabah')),
            'tmplahir'      => ($request->input('input_tempat_lahir_nasabah')),
            'tgllahir'      => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir_nasabah'))),
            'alamat'        => ($request->input('input_alamat_nasabah')),
            'notelp'        => ($request->input('input_telepon_rumah_nasabah')),
            'rtrw'          => ($request->input('input_rt_nasabah')),
            'desa'          => ($request->input('input_kelurahan_nasabah')),
            'camat'         => ($request->input('input_kecamatan_nasabah')),
            'kodya'         => substr($dati,5),
            'agama'         => ($request->input('input_agama_nasabah')),
            'noktp'         => ($request->input('input_no_identitas_nasabah')),
            'kodepos'       => ($request->input('input_kodepos_nasabah')),
            'dati2'         => substr($dati,0,4),
            'npwp'          => ($request->input('input_no_npwp')),
            'namaibu'       => ($request->input('input_nama_ibu_kandung_nasabah')),
            'kerja'         => ($request->input('input_pekerjaan_nasabah')),
            'kd_usaha'      => ($request->input('input_usaha_nasabah')),
            'email'         => ($request->input('input_email')),
            'nohp'          => ($request->input('input_no_hp_nasabah')),
            'tglktp'        => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_berlaku_nasabah'))),
            'gelar'         => ($request->input('input_gelar')),
            'negara'        => ($request->input('input_negara')),
            'tkerja'        => ($request->input('input_tempat')),
            'alamat_kerja'  => ($request->input('input_tempat_kerja')),
            'sumber'        => ($request->input('input_sumber')),
            'tanggungan'    => ($request->input('input_tanggungan')),
            'hubbank'       => ($request->input('input_bank')),
            'goldeb'        => ($request->input('input_goldeb')),
            'tgl_mohon'     => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
            'pisah_harta'   => ($request->input('input_pisah_harta')),
            'melanggar'     => ($request->input('input_melanggar')),
            'melampaui'     => ($request->input('input_melampaui')),
            'bi_hidup'      =>  DataController::formatangka($request->input('input_biaya_hidup_nasabah')),
            'gaji'          =>  DataController::formatangka($request->input('input_pendapatan_nasabah')),
            'id'            => ($request->input('input_jenisid')),
            'pernikahan'    => ($request->input('input_status_nikah')),
            'negara'        => ($request->input('input_negara')),
            'hubbank'       => ($request->input('input_bank')),
            'nobadan'       => ($request->input('input_no_npwp')),
            'jenisbadan'    => ($request->input('input_badan')),
            'tempatberdiri' => ($request->input('input_tempatberdiri')),
            'noakta'        => ($request->input('input_noakta')),
            'tglakta'       => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_akta'))),
            'noakhir'       => ($request->input('input_noakhir')),
            'tglubah'       => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_aktaubah'))),
            // 'kd_usaha'      => ($request->input('input_eko')),
            'go'            => ($request->input('input_go')),
            'rating'        => ($request->input('input_rating')),
            'lembaga'       => ($request->input('input_kode_lembaga_pemeringkat')),
            'tglperingkat'  => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_peringkat'))),
            'grub'          => ($request->input('input_grub')),
            'opr'           => ($request->input('opr'))
            ]);
        
        // for($i=0;$i<count($nonsb);$i++){
        $dati = $request->input('input_kodya_nasabah');
         DB::connection('pgsql')->table('prekredit')->whereRaw("no_mohon=(select max(no_mohon) from prekredit where no_nsb='".$nonsb."')")->update([
            'no_nsb'  => ($nonsb),
            'nama' =>  ($request->input('input_nama_nasabah')),
            'kelamin' => ($request->input('input_jenis_kelamin_nasabah')),
            'tmplahir' => ($request->input('input_tempat_lahir_nasabah')),
            'tgllahir' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir_nasabah'))),
            'alamat' => ($request->input('input_alamat_nasabah')),
            'notelp' => ($request->input('input_telepon_rumah_nasabah')),
            'nohp' => ($request->input('input_no_hp_nasabah')),
            'rtrw' => ($request->input('input_rt_nasabah')),
            'desa' => ($request->input('input_kelurahan_nasabah')),
            'camat' => ($request->input('input_kecamatan_nasabah')),
            'kodya' => substr($dati,5),
            'noktp' => ($request->input('input_no_identitas_nasabah')),
            'agama' => ($request->input('input_agama_nasabah')),
            'pekerjaan' => ($request->input('input_pekerjaan_nasabah')),
            'usaha' => ($request->input('input_usaha_nasabah')),
            'nobadan' => ($request->input('input_no_npwp')),
            'jenisbadan' => ($request->input('input_badan')),
            'tempatberdiri' => ($request->input('input_tempatberdiri')),
            'noakta' => ($request->input('input_noakta')),
            'tglakta' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_akta'))),
            'opr' => ($request->input('opr'))
            ]);
        // }
        
         $psnasabah = PasanganNasabah::where('no_nsb',$nonsb)->first();
        if(isset($psnasabah->ps_nama)){ 
                DB::connection('pgsql')->table('nasabah_ps')->where('no_nsb',$nonsb)->update([
                    'no_nsb'        => ($nonsb),
                    'ps_nama'       => ($request->input('input_nama_nasabah_ps')),
                    // 'ps_nikah'       => ($request->input('input_nikah')),
                    'ps_tgllahir'   => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir_nasabah_ps'))),
                    'ps_gelar'      => ($request->input('input_gelar_ps')),
                    'ps_nohp'       => ($request->input('input_nom_nasabah_ps')),
                    'ps_tmplahir'   => ($request->input('input_tempat_lahir_nasabah_ps')),
                    'ps_agama'      => ($request->input('input_agama_nasabah_ps')),
                    'ps_noktp'      => ($request->input('input_ktp_ps')),
                    'ps_pekerjaan'  => ($request->input('input_kerja_ps')),
                    'ps_alamat'     => ($request->input('input_alamat_nasabah_ps')),
                    'ps_kodepos'    => ($request->input('input_kodepos_nasabah_ps')),
                    'ps_kodya'      => ($request->input('input_kodya_nasabah_ps')),
                    'ps_rtrw'       => ($request->input('input_rt_nasabah_ps')),
                    'ps_desa'       => ($request->input('input_kelurahan_nasabah_ps')),
                    'ps_camat'      => ($request->input('input_kecamatan_nasabah_ps'))
                    ]);
        }

        if(empty($psnasabah->ps_nama)){ 
            $psnasabah = new PasanganNasabah;
            $psnasabah->no_nsb = $request->input('input_no_nsb');
            // $psnasabah->ps_nikah = $request->input('input_nikah');
            // $psnasabah->no_cif = $request->input('no_cif');
            $psnasabah->ps_nama = strtoupper($request->input('input_nama_nasabah_ps'));
            $psnasabah->ps_gelar  = $request->input('input_gelar');
            $psnasabah->ps_tmplahir = strtoupper($request->input('input_tempat_lahir_nasabah_ps'));
            $psnasabah->ps_tgllahir = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir_nasabah_ps')));
            $psnasabah->ps_agama = $request->input('input_agama_nasabah');
            $psnasabah->ps_noktp = $request->input('input_ktp_ps');
            $psnasabah->ps_nohp = $request->input('input_nom_nasabah_ps');
            $psnasabah->ps_pekerjaan = $request->input('input_kerja_ps');
            $psnasabah->ps_alamat = strtoupper($request->input('input_alamat_nasabah_ps'));
            $psnasabah->ps_kodepos = strtoupper($request->input('input_kodepos_nasabah_ps'));
            $psnasabah->ps_kodya = ($request->input('input_kodya_nasabah_ps'));
            $psnasabah->ps_rtrw = $request->input('input_rt_nasabah_ps');
            $psnasabah->ps_desa = strtoupper($request->input('input_kelurahan_nasabah_ps'));
            $psnasabah->ps_camat = strtoupper($request->input('input_kecamatan_nasabah_ps'));
            $psnasabah->opr = $request->input('opr');
            $psnasabah->save();
        }
        
        return redirect('/koreksidata');
       
    }

    public function dataFormNasabahBaru($nonsb)
    {
        $nasabah = Nasabah::where('no_nsb',$nonsb)->get();
        $psnasabah = PasanganNasabah::where('no_nsb',$nonsb)->get();
        $pengurus = Pengurus::where('no_nsb',$nonsb)->get();
        // log::info(json_encode($psnasabah));

        $kodya = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc1','asc')->get();
        $kerja = DB::connection('pgsql')->table('mst_kerja')->orderBy('kode','asc')->get();
        $usaha = DB::connection('pgsql')->table('mst_eko')->where('status',' ')->orderBy('kode','asc')->get();
        $gelar = DB::connection('pgsql')->table('mst_gelar')->orderBy('kode','asc')->orderBy('kode','asc')->get();
        $negara = DB::connection('pgsql')->table('mst_negara')->orderBy('kode','asc')->get();
        $hubbank = DB::connection('pgsql')->table('mst_lapor')->orderBy('kode','asc')->get();
        $goldeb = DB::connection('pgsql')->table('mst_goldeb')->where('status',' ')->orderBy('sandi','asc')->get();
        $sumber = DB::connection('pgsql')->table('mst_sumber')->orderBy('kode','asc')->get();
        $jabatan = DB::connection('pgsql')->table('mst_jabatan')->orderBy('kode','asc')->get();
        $badan = DB::connection('pgsql')->table('mst_badanusaha')->orderBy('kode','asc')->get();
        $eko = DB::connection('pgsql')->table('mst_eko')->where('status',' ')->orderBy('kode','asc')->get();
        $lembaga =  DB::connection('pgsql')->table('lembaga')->orderBy('kode','asc')->get();
        $kelurahan = DB::connection('pgsql')->table('mst_kelurahan')->where('status','ada')->orderBy('nama','asc')->get();
        $kecamatan = DB::connection('pgsql')->table('mst_kecamatan')->where('status','ada')->orderBy('nama','asc')->get();
        // if(isset($psnasabah)){
        //     $psnasabah = PasanganNasabah::where('no_nsb',$nonsb)->get();
        // }
        // else{
            
        // }

        return view('nasabah.nasabahbaru',compact('nasabah','psnasabah','nonsb','kodya','kerja','usaha','gelar','negara','hubbank','goldeb','sumber','jabatan','pengurus','eko','lembaga','badan','kelurahan','kecamatan'));   
    }
    
    public function saveFormNasabahBaru(Request $request,$nonsb)
    {
        $psnasabah = PasanganNasabah::where('no_nsb',$nonsb)->first();
        $dati = $request->input('input_kodya_nasabah');
        // $dati = explode('-',$request->input('input_kodya_nasabah'));

        DB::connection('pgsql')->table('nasabah')->where('no_nsb',$nonsb)->update([
            'no_nsb'        => ($nonsb),
            'no_cif'        => ($request->input('no_cif')),
            'nama'          => ($request->input('input_nama_nasabah')),
            'kelamin'       => ($request->input('input_jenis_kelamin_nasabah')),
            'tmplahir'      => ($request->input('input_tempat_lahir_nasabah')),
            'tgllahir'      => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir_nasabah'))),
            'alamat'        => ($request->input('input_alamat_nasabah')),
            'notelp'        => ($request->input('input_telepon_rumah_nasabah')),
            'rtrw'          => ($request->input('input_rt_nasabah')),
            'desa'          => ($request->input('input_kelurahan_nasabah')),
            'camat'         => ($request->input('input_kecamatan_nasabah')),
            'kodya'         => substr($dati,5),
            'agama'         => ($request->input('input_agama_nasabah')),
            'noktp'         => ($request->input('input_no_identitas_nasabah')),
            'npwp'          => ($request->input('input_no_npwp')),
            'kodepos'       => ($request->input('input_kodepos_nasabah')),
            'dati2'         => substr($dati,0,4),
            'npwp'          => ($request->input('input_no_npwp_nasabah')),
            'namaibu'       => ($request->input('input_nama_ibu_kandung_nasabah')),
            'kerja'         => ($request->input('input_pekerjaan_nasabah')),
            'kd_usaha'      => ($request->input('input_usaha_nasabah')),
            'email'         => ($request->input('input_email')),
            'nohp'          => ($request->input('input_no_hp_nasabah')),
            'tglktp'        => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_berlaku_nasabah'))),
            'gelar'         => ($request->input('input_gelar')),
            'negara'        => ($request->input('input_negara')),
            'tkerja'        => ($request->input('input_tempat')),
            'alamat_kerja'  => ($request->input('input_tempat_kerja')),
            'sumber'        => ($request->input('input_sumber')),
            'tanggungan'    => ($request->input('input_tanggungan')),
            'hubbank'       => ($request->input('input_bank')),
            'goldeb'        => ($request->input('input_goldeb')),
            'tgl_mohon'     => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
            'pisah_harta'   => ($request->input('input_pisah_harta')),
            'melanggar'     => ($request->input('input_melanggar')),
            'melampaui'     => ($request->input('input_melampaui')),
            'bi_hidup'      =>  DataController::formatangka($request->input('input_biaya_hidup_nasabah')),
            'gaji'          =>  DataController::formatangka($request->input('input_pendapatan_nasabah')),
            'id'            => ($request->input('input_jenisid')),
            'pernikahan'    => ($request->input('input_status_nikah')),
            'negara'        => ($request->input('input_negara')),
            'hubbank'       => ($request->input('input_bank')),
            'nobadan'       => ($request->input('input_no_npwp')),
            'jenisbadan'    => ($request->input('input_badan')),
            'tempatberdiri' => ($request->input('input_tempatberdiri')),
            'noakta'        => ($request->input('input_noakta')),
            'tglakta'       => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_akta'))),
            'noakhir'       => ($request->input('input_noakhir')),
            'tglubah'       => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_aktaubah'))),
            // 'kd_usaha'      => ($request->input('input_eko')),
            'go'            => ($request->input('input_go')),
            'rating'        => ($request->input('input_rating')),
            'lembaga'       => ($request->input('input_kode_lembaga_pemeringkat')),
            'tglperingkat'  => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_peringkat'))),
            'grub'          => ($request->input('input_grub')),
            'opr'           => ($request->input('opr'))
            ]);

        $psnasabah = PasanganNasabah::where('no_nsb',$nonsb)->first();
        if(isset($psnasabah->ps_nama)){ 
                DB::connection('pgsql')->table('nasabah_ps')->where('no_nsb',$nonsb)->update([
                    'no_nsb'        => ($nonsb),
                    'ps_nama'       => ($request->input('input_nama_nasabah_ps')),
                    // 'ps_nikah'       => ($request->input('input_nikah')),
                    'ps_tgllahir'   => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir_nasabah_ps'))),
                    'ps_gelar'      => ($request->input('input_gelar_ps')),
                    'ps_nohp'       => ($request->input('input_nom_nasabah_ps')),
                    'ps_tmplahir'   => ($request->input('input_tempat_lahir_nasabah_ps')),
                    'ps_agama'      => ($request->input('input_agama_nasabah_ps')),
                    'ps_noktp'      => ($request->input('input_ktp_ps')),
                    'ps_pekerjaan'  => ($request->input('input_kerja_ps')),
                    'ps_alamat'     => ($request->input('input_alamat_nasabah_ps')),
                    'ps_kodepos'    => ($request->input('input_kodepos_nasabah_ps')),
                    'ps_kodya'      => ($request->input('input_kodya_nasabah_ps')),
                    'ps_rtrw'       => ($request->input('input_rt_nasabah_ps')),
                    'ps_desa'       => ($request->input('input_kelurahan_nasabah_ps')),
                    'ps_camat'      => ($request->input('input_kecamatan_nasabah_ps'))
                    ]);
        }

        if(empty($psnasabah->ps_nama)){ 
            $psnasabah = new PasanganNasabah;
            $psnasabah->no_nsb = $request->input('input_no_nsb');
            // $psnasabah->ps_nikah = $request->input('input_nikah');
            // $psnasabah->no_cif = $request->input('no_cif');
            $psnasabah->ps_nama = strtoupper($request->input('input_nama_nasabah_ps'));
            $psnasabah->ps_gelar  = $request->input('input_gelar');
            $psnasabah->ps_tmplahir = strtoupper($request->input('input_tempat_lahir_nasabah_ps'));
            $psnasabah->ps_tgllahir = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir_nasabah_ps')));
            $psnasabah->ps_agama = $request->input('input_agama_nasabah');
            $psnasabah->ps_noktp = $request->input('input_ktp_ps');
            $psnasabah->ps_nohp = $request->input('input_nom_nasabah_ps');
            $psnasabah->ps_pekerjaan = $request->input('input_kerja_ps');
            $psnasabah->ps_alamat = strtoupper($request->input('input_alamat_nasabah_ps'));
            $psnasabah->ps_kodepos = strtoupper($request->input('input_kodepos_nasabah_ps'));
            $psnasabah->ps_kodya = ($request->input('input_kodya_nasabah_ps'));
            $psnasabah->ps_rtrw = $request->input('input_rt_nasabah_ps');
            $psnasabah->ps_desa = strtoupper($request->input('input_kelurahan_nasabah_ps'));
            $psnasabah->ps_camat = strtoupper($request->input('input_kecamatan_nasabah_ps'));
            $psnasabah->opr = $request->input('opr');
            $psnasabah->save();
        }
        
            return redirect('/addkredit/'.$nonsb);
        // endif
         // return redirect('/addkreditparipasu/'.$nonsb);


         // if((strpos(Auth::user()->fungsi, '0001') !== false)||(strpos(Auth::user()->fungsi, '7777') !== false))
         //    return redirect('/');
         // endif
    }

        //Log::info('/addkredit/'.$nasabah->no_nsb);
    
    public function dataFormViewKredit ($tahun,$kode_kantor,$nourut)
    { 
       
        $nokredit = $tahun.'/'.$kode_kantor.'/'.$nourut;
        $daftar = Kredit::where('no_kredit',$nokredit)->get();
        $biaya = DafKreditBiaya::where('no_kredit',$nokredit)->get();
        $kendaraan = AgunanKendaraan::where('no_kredit',$nokredit)->get();
        $sertifikat = AgunanSertifikat::where('no_kredit',$nokredit)->get();
        $agkredit = AgunanKredit::where('no_kredit',$nokredit)->get();
        $lapkeuang = laporan::where('no_kredit',$nokredit)->get();
        $pengurus = Pengurus::where('no_kredit',$nokredit)->get();
        $jamin = penjamin::whereRaw("no_kredit LIKE '%".$nokredit."%'")->get();
        $rktran = RKTransaksi::where('norek',$nokredit)->first();

            $sql1 ="SELECT mst_sifat_kredit.kode,mst_sifat_kredit.note,kredit.sifatkrd 
            from mst_sifat_kredit,kredit 
            where kredit.no_kredit='".$nokredit."' 
            AND
            kredit.sifatkrd=mst_sifat_kredit.kode";
            $lihat1 = DB::connection('pgsql')->select(DB::raw($sql1));  

                $sql2 ="SELECT mst_krd.nama,mst_krd.sandi,kredit.jns_krd
                from mst_krd,kredit 
                where kredit.no_kredit='".$nokredit."' 
                AND 
                kredit.jns_krd=mst_krd.sandi";
                $lihat2 = DB::connection('pgsql')->select(DB::raw($sql2)); 

            $sql3 ="SELECT mst_skim.kode,kredit.skim,mst_skim.skim
            from mst_skim,kredit 
            where kredit.no_kredit='".$nokredit."' 
            AND
            kredit.skim=mst_skim.kode";
            $lihat3 = DB::connection('pgsql')->select(DB::raw($sql3));  

                $sql4 ="SELECT mst_debitur.nama,mst_debitur.sandi,kredit.goldeb
                from mst_debitur,kredit 
                where kredit.no_kredit='".$nokredit."' 
                AND 
                mst_debitur.sandi=kredit.goldeb";
                $lihat4 = DB::connection('pgsql')->select(DB::raw($sql4)); 

            $sql5 ="SELECT mst_guna.kode,kredit.jnsbiaya,mst_guna.jns_penggunaan
            from mst_guna,kredit 
            where kredit.no_kredit='".$nokredit."' 
            AND
            kredit.jnsbiaya=mst_guna.kode";
            $lihat5 = DB::connection('pgsql')->select(DB::raw($sql5));  

                $sql6 ="SELECT mst_ori.jenis_penggunaan,mst_ori.kode,kredit.ori
                from mst_ori,kredit 
                where kredit.no_kredit='".$nokredit."' 
                AND 
                mst_ori.kode=kredit.ori";
                $lihat6 = DB::connection('pgsql')->select(DB::raw($sql6));

            $sql7 ="SELECT mst_eko.kode,kredit.eko,mst_eko.sektor_eko
            from mst_eko,kredit 
            where kredit.no_kredit='".$nokredit."' 
            AND
            kredit.eko=mst_eko.kode";
            $lihat7 = DB::connection('pgsql')->select(DB::raw($sql7)); 

                $sql8 ="SELECT mst_dati2.desc1,mst_dati2.desc2,kredit.dati2
                from mst_dati2,kredit 
                where kredit.no_kredit='".$nokredit."' 
                AND 
                mst_dati2.desc1=kredit.dati2";
                $lihat8 = DB::connection('pgsql')->select(DB::raw($sql8));

            $sql9 ="SELECT mst_bunga.bunga,kredit.jenisbunga,mst_bunga.sadi
            from mst_bunga,kredit 
            where kredit.no_kredit='".$nokredit."' 
            AND
            kredit.jenisbunga=mst_bunga.sadi";
            $lihat9 = DB::connection('pgsql')->select(DB::raw($sql9)); 

                $sql10 ="SELECT mst_kreditpp.sandi,mst_kreditpp.fas,kredit.kreditpp
                from mst_kreditpp,kredit 
                where kredit.no_kredit='".$nokredit."' 
                AND 
                mst_kreditpp.sandi=kredit.kreditpp";
                $lihat10 = DB::connection('pgsql')->select(DB::raw($sql10));

            $sql11 ="SELECT mst_goldeb.nama,kredit.sumber,mst_goldeb.sandi
            from mst_goldeb,kredit 
            where kredit.no_kredit='".$nokredit."' 
            AND
            kredit.sumber=mst_goldeb.sandi";
            $lihat11 = DB::connection('pgsql')->select(DB::raw($sql11)); 

                $sql12 ="SELECT mst_ljk.kode,mst_ljk.nama,kredit.to
                from mst_ljk,kredit 
                where kredit.no_kredit='".$nokredit."' 
                AND 
                mst_ljk.kode=kredit.to";
                $lihat12 = DB::connection('pgsql')->select(DB::raw($sql12));

            $sql13 ="SELECT mst_kolek.nama,kredit.kolek,mst_kolek.sandi
            from mst_kolek,kredit 
            where kredit.no_kredit='".$nokredit."' 
            AND
            kredit.kolek=mst_kolek.sandi";
            $lihat13 = DB::connection('pgsql')->select(DB::raw($sql13)); 

                $sql14 ="SELECT mst_sebab.kode,mst_sebab.sbb_macet,kredit.sebabmacet
                from mst_sebab,kredit 
                where kredit.no_kredit='".$nokredit."' 
                AND 
                mst_sebab.kode=kredit.sebabmacet";
                $lihat14 = DB::connection('pgsql')->select(DB::raw($sql14));

            $sql15 ="SELECT mst_cara.cara,kredit.res,mst_cara.kode
            from mst_cara,kredit 
            where kredit.no_kredit='".$nokredit."' 
            AND
            kredit.res=mst_cara.kode";
            $lihat15 = DB::connection('pgsql')->select(DB::raw($sql15)); 

                $sql16 ="SELECT mst_kondisi.kode,mst_kondisi.nama,kredit.kondisi
                from mst_kondisi,kredit 
                where kredit.no_kredit='".$nokredit."' 
                AND 
                mst_kondisi.kode=kredit.kondisi";
                $lihat16 = DB::connection('pgsql')->select(DB::raw($sql16));

            // $sql17 ="SELECT mst_goldeb.nama,penjamin.goldeb,mst_goldeb.sandi
            // from mst_goldeb,penjamin 
            // where penjamin.no_kredit LIKE '%".$nokredit."%'
            // AND
            // penjamin.goldeb=mst_goldeb.sandi";
            // $lihat17 = DB::connection('pgsql')->select(DB::raw($sql17)); 

        $bayar = AngsBayar::where('no_kredit',$nokredit)->get();
        $jadwal = AngsJadwal::where('no_kredit',$nokredit)->orderBy('bayar_ke','asc')->get();

        $prekredit = Prekredit::where('no_kredit',$nokredit)->get();

        $data = DB::connection('pgsql')->select(DB::raw("select kredit.no_kredit,tgl_kredit,nama,kelamin,tmplahir,tgllahir,alamat,notelp,kodya,no_ref,sistem,lama,tgl_mulai,tgl_lunas,kredit.plafon,bbt,saldo_piutang,sum(potongan) as potongan,sum(angs_pokok+angs_titippokok) as pokok,sum(angs_bunga+angs_titipbunga) as bunga,SUM(denda) as denda,SUM(potongan_pokok) as potpokok,SUM(potongan_bunga) as potbunga,SUM(potongan_denda) as potdenda
                                    from prekredit,kredit JOIN angsuran_kartu ON kredit.no_kredit = angsuran_kartu.no_kredit 
                                    where prekredit.no_mohon=kredit.no_mohon and kredit.no_kredit = '".$nokredit."' GROUP BY kredit.no_kredit,kredit.no_ref,nama,tgl_kredit,tmplahir,tgllahir,alamat,notelp,kodya,kelamin,tgl_lunas,kredit.plafon,bbt,saldo_piutang,lama,tgl_mulai,sistem"));     

        if(empty($data)){
            // $daftar = Kredit::where('no_kredit',$nokredit)->get();
             $jadwal = AngsJadwal::where('no_kredit',$nokredit)->orderBy('bayar_ke','asc')->get();
        }
        // if(isset($bayar))
        else{
            $datanasabah = DB::connection('pgsql')->select(DB::raw("select kredit.no_kredit,nama,kelamin,tgl_kredit,tmplahir,tgllahir,alamat,notelp,kodya,no_ref,sistem,lama,tgl_mulai,tgl_lunas,kredit.plafon,bbt,saldo_piutang,sum(potongan) as potongan,sum(angs_pokok+angs_titippokok) as pokok,sum(angs_bunga+angs_titipbunga) as bunga,SUM(denda) as denda,SUM(potongan_pokok) as potpokok,SUM(potongan_bunga) as potbunga,SUM(potongan_denda) as potdenda
                            from prekredit,kredit JOIN angsuran_kartu ON kredit.no_kredit = angsuran_kartu.no_kredit 
                            where prekredit.no_mohon=kredit.no_mohon and kredit.no_kredit = '".$nokredit."' GROUP BY kredit.no_kredit,kredit.no_ref,nama,tgl_kredit,tmplahir,tgllahir,alamat,notelp,kodya,kelamin,tgl_lunas,kredit.plafon,bbt,saldo_piutang,lama,tgl_mulai,sistem"))[0];   
            $dataangsuran = DB::connection('pgsql')->select(DB::raw("SELECT aj.no_kredit,bayar_ke,angs_ke,tgl_angsur,angs_tgl,transfer_tgl,pot_bunga,
                                                                CASE
                                                                  WHEN ('".date('Y-m-d')."' > tgl_angsur AND angs_tgl IS NULL) THEN DATE_PART('day', '".date('Y-m-d')."' - tgl_angsur::timestamp)
                                                                  ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
                                                                END as diff,angs_nobukti,bunga_sldbbt,bakidebet,sld_piutang,aj.angs_pokok,aj.angs_bunga,pokok,bunga,denda
                                                                FROM angsuran_jadwal aj LEFT OUTER JOIN (SELECT no_kredit,angs_nobukti,angs_ke,denda,bunga_sldbbt,bakidebet,sld_piutang,(angs_titippokok+angs_pokok) as pokok,(angs_titipbunga+angs_bunga) as bunga,angs_tgl,transfer_tgl FROM angsuran_kartu ORDER BY angs_ke) as ak ON ak.no_kredit = aj.no_kredit AND angs_ke = bayar_ke
                                                                WHERE aj.no_kredit='".$nokredit."' ORDER BY bayar_ke,angs_tgl;"));

                 
            // $dataangsuran = DB::connection('pgsql')->select(DB::raw("SELECT aj.no_kredit,bayar_ke,angs_ke,tgl_angsur,angs_tgl,transfer_tgl,
            //                                                         CASE
            //                                                           WHEN transfer_tgl <> '1900-01-01 00:00:00' THEN DATE_PART('day', transfer_tgl::timestamp - tgl_angsur::timestamp)
            //                                                           ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
            //                                                         END as diff,angs_nobukti,bunga_sldbbt,bakidebet,sld_piutang,aj.angs_pokok,aj.angs_bunga,pokok,bunga,denda
            //                                                         FROM angsuran_jadwal aj LEFT OUTER JOIN (SELECT no_kredit,angs_nobukti,angs_ke,denda,bunga_sldbbt,bakidebet,sld_piutang,(angs_titippokok+angs_pokok) as pokok,(angs_titipbunga+angs_bunga) as bunga,angs_tgl,transfer_tgl FROM angsuran_kartu ORDER BY angs_ke) as ak ON ak.no_kredit = aj.no_kredit AND angs_ke = bayar_ke
            //                                                         WHERE aj.no_kredit='".$nokredit."' ORDER BY bayar_ke,angs_tgl;")); 
        // if($datanasabah->saldo_piutang > 0){
        //     $bayarangsuran = 1; 
        // } else {
        //     $bayarangsuran = 0;
        // }
        // //denda
        // $arr = array(0,0,0,0,0,0,0,0);
        // $dataangs = array();
        // $tgk = 0;
        // //$bayarangsuran = 1;
        // foreach($dataangsuran as $key=>$angs){
        //     if($angs->angs_ke <> ""){
        //         if($arr[0] == $angs->angs_ke){
        //             //if($arr[6] > 3) {
        //             if($angs->diff > 3) {
        //                 //$angs->diff = date_diff(date_create(date('Y-m-d',strtotime($angs->angs_tgl))), date_create(date('Y-m-d',strtotime($arr[5]))))->format('%r%a');
        //                 //$angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff-$arr[6]);
        //                 if($arr[6] > 0) {
        //                     $angs->dendakena = ((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))*abs($angs->diff-$arr[6]);
        //                 } else {
        //                     $angs->dendakena = ((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))*abs($angs->diff);
        //                 }
        //             } else {
        //                 $angs->dendakena = 0;
        //             }
        //         } else {
        //             if($angs->diff <= 3){
        //                 $angs->dendakena = 0;
        //             } else {
        //                 //$angs->dendakena = ceil(((0.5/100)*($angs->angs_pokok+$angs->angs_bunga))/100)*100*abs($angs->diff);
        //                 $angs->dendakena = ((0.5/100)*($angs->angs_pokok+$angs->angs_bunga))*abs($angs->diff);
        //             }
        //         }
        //         /*if(($angs->diff <= 3) && ($angs->diff2 <= 3)){
        //             $angs->dendakena = 0;
        //             $angs->dendakena2 = 0;
        //         } elseif(($angs->diff <= 3) && ($angs->diff2 > 3)){
        //             $angs->dendakena = 0;
        //             //$angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga))/100)*100*($angs->diff+$angs->diff2);
        //             if($arr[0] == $angs->angs_ke){
        //                 if((($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga)) > 0){
        //                     //$angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga))/100)*100*$angs->diff2;
        //                     $angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga))/100)*100*abs($angs->diff2-);
        //                 } else {
        //                     $angs->dendakena2 = 0;
        //                 }
        //             } else {
        //                 if(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga) > 0){
        //                     $angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga))/100)*100*$angs->diff2;
        //                 } else {
        //                     $angs->dendakena2 = 0;
        //                 }
        //             }
        //         } else {
        //             if($arr[0] == $angs->angs_ke){
        //                 if($arr[6] > 0){
        //                     $angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff-$arr[6]);                
        //                 } else {
        //                     $angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff);                
        //                 }
        //                 //$angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff-$arr[6]);
        //                 if((($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga)) > 0){
        //                     $angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga))/100)*100*$angs->diff2;
        //                 } else {
        //                     $angs->dendakena2 = 0;
        //                 }
        //             } else {
        //                 if(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga) > 0){
        //                     $angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga))/100)*100*$angs->diff2;
        //                 } else {
        //                     $angs->dendakena2 = 0;
        //                 }
        //                 $angs->dendakena = ceil((0.5/100)*($angs->angs_pokok+$angs->angs_bunga)/100)*100*$angs->diff;
        //             }
        //         }*/
        //         if($arr[0] == $angs->angs_ke){
        //             // if(($angs->pokok+$angs->bunga == 0)){
        //             //     $angs->angs_tgl = $arr[5];
        //             //     $angs->diff = $arr[6];
        //             // }
        //             $angs->pokok += $arr[1];
        //             $angs->bunga += $arr[2];
        //             $angs->denda += $arr[3];
        //             $angs->dendakena += $arr[4];
        //             $arr[1] = $angs->pokok;
        //             $arr[2] = $angs->bunga;
        //             $arr[3] = $angs->denda;
        //             $arr[4] = $angs->dendakena;
        //             $arr[5] = $angs->angs_tgl;
        //             $arr[6] = $angs->diff;
        //             if($arr[7] < $angs->sld_piutang){
        //                 $angs->sld_piutang = $arr[7];
        //             }
        //             $arr[7] = $angs->sld_piutang;
        //             if(($tgk == $angs->angs_ke) && (($angs->angs_pokok+$angs->angs_bunga) === ($angs->pokok+$angs->bunga))){
        //                 $tgk = 0;
        //             }
        //         } else {
        //             $arr[0] = $angs->angs_ke;
        //             $arr[1] = $angs->pokok;
        //             $arr[2] = $angs->bunga;
        //             $arr[3] = $angs->denda;
        //             $arr[4] = $angs->dendakena;
        //             $arr[5] = $angs->angs_tgl;
        //             $arr[6] = $angs->diff;
        //             $arr[7] = $angs->sld_piutang;
        //             if(($tgk == 0) && (($angs->angs_pokok+$angs->angs_bunga) <> ($angs->pokok+$angs->bunga))){
        //                 $tgk = $angs->bayar_ke;
        //             }
        //         }
        //     } else {
        //         if($angs->diff <= 3){
        //             $angs->dendakena = 0;
        //         } else {
        //             //$angs->dendakena = ceil((0.5/100)*($angs->angs_pokok+$angs->angs_bunga)/100)*100*$angs->diff;
        //             $angs->dendakena = (0.5/100)*($angs->angs_pokok+$angs->angs_bunga)*$angs->diff;
        //         }
        //         $angs->dendakena2 = 0;
        //         if($tgk == 0){
        //             $tgk = $angs->bayar_ke;
        //         }
        //     }

        //     if($bayarangsuran === 1){
        //         $dataangs[$angs->bayar_ke] = $angs;
        //     } elseif($bayarangsuran === 0) {
        //         $dataangs[$angs->bayar_ke] = $angs;
        //         $dataangs[$angs->bayar_ke]->denda = $angs->denda;       
        //     }
        // }
        // if(!isset($dataangs[$tgk])){
        //     $tgk = count($dataangs);
        // }
        // $totaltunggak = array('pokok'=>0,'bunga'=>0);
        // $i = $tgk;
        // //if($dataangs[$i]->angs_ke <> ""){
        //     $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a');
        // //}
        // if($diff > 0){
        //     //while ($i <= count($dataangs) && $dataangs[$i]->angs_ke <> "") {
        //     while ($i <= count($dataangs) && $dataangs[$i]->diff <> null) {
        //         $dataangs[$i]->sisa_tunggak = ($dataangs[$i]->angs_pokok+$dataangs[$i]->angs_bunga)-($dataangs[$i]->pokok+$dataangs[$i]->bunga);
        //         $totaltunggak['pokok'] += $dataangs[$i]->angs_pokok-$dataangs[$i]->pokok;
        //         $totaltunggak['bunga'] += $dataangs[$i]->angs_bunga-$dataangs[$i]->bunga;
        //         if(($dataangs[$i]->angs_ke <> "") && ($dataangs[$i]->diff < 0)){
        //             $dataangs[$i]->dendakena += (0.5/100)*$dataangs[$i]->sisa_tunggak*abs(date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a'));
        //         } elseif(($dataangs[$i]->angs_ke <> "") && ($dataangs[$i]->diff >= 0)) {
        //             $dataangs[$i]->dendakena += (0.5/100)*$dataangs[$i]->sisa_tunggak*abs(date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a')-$dataangs[$i]->diff);
        //         }
        //         $i++;
        //         if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i-1]->tgl_angsur))))->format('%r%a') == 0){
        //             $tgkangsur = $i-$tgk-1;
        //         } else {
        //             $tgkangsur = $i-$tgk;
        //         }
        //     }
        // } else {
        //     $tgkangsur = 0;
        // }
        // /*if($dataangs[$i]->diff > 0){
        //     //while ($i <= count($dataangs) && $dataangs[$i]->angs_ke <> "") {
        //     while ($i <= count($dataangs) && $dataangs[$i]->diff <> null) {
        //         $dataangs[$i]->sisa_tunggak = ($dataangs[$i]->angs_pokok+$dataangs[$i]->angs_bunga)-($dataangs[$i]->pokok+$dataangs[$i]->bunga);
        //         $totaltunggak['pokok'] += $dataangs[$i]->angs_pokok-$dataangs[$i]->pokok;
        //         $totaltunggak['bunga'] += $dataangs[$i]->angs_bunga-$dataangs[$i]->bunga;
        //         $dataangs[$i]->diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a');
        //         if(($dataangs[$i]->angs_ke <> "") && ($dataangs[$i]->diff > 0)){
        //             //$dataangs[$i]->dendakena += ceil((0.5/100)*$dataangs[$i]->sisa_tunggak/100)*100*abs(date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))), date_create(date('Y-m-d')))->format('%r%a'));
        //             $dataangs[$i]->dendakena += (0.5/100)*$dataangs[$i]->sisa_tunggak*abs(date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))), date_create(date('Y-m-d')))->format('%r%a'));
        //         }
        //         $i++;
        //         if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i-1]->tgl_angsur))))->format('%r%a') == 0){
        //             $tgkangsur = $i-$tgk-1;
        //         } else {
        //             $tgkangsur = $i-$tgk;
        //         }
        //     }
        // } else {
        //     $tgkangsur = 0;
        // }*/
        // if(!isset($dataangs[$tgk]->sisa_tunggak)){
        //     $dataangs[$tgk]->sisa_tunggak = ($dataangs[$tgk]->angs_pokok+$dataangs[$tgk]->angs_bunga)-($dataangs[$tgk]->pokok+$dataangs[$tgk]->pokok);
        // }
        // if($bayarangsuran === 0){
        //     $tgkangsur = 0;
        //     $totaltunggak['pokok'] = 0;
        //     $totaltunggak['bunga'] = 0;
        // }
        // $totaldenda = 0;
        // foreach($dataangs as $angs){
        //     // $angs->dendakena += $angs->dendakena2;
        //     // if(($angs->angs_pokok+$angs->angs_bunga) > ($angs->pokok+$angs->bunga)){
        //     //     $angs->diff += $angs->diff2;
        //     // }
        //     $angs->dendakena = ceil($angs->dendakena/100)*100;
        //     if($angs->dendakena > 0){
        //         $totaldenda += $angs->dendakena;
        //     }
        //     if($angs->denda <> 0){
        //         $totaldenda -= $angs->denda;
        //     }
        // }
       }

        return view('kredit.viewkredit',compact('rktran','data','daftar','biaya','kendaraan','sertifikat','jamin','dataangsuran','datanasabah','tgk','totaldenda','tgkangsur','totaltunggak','bayarangsuran','jadwal','kartu','bayar','data','lapkeuang','pengurus','prekredit','agkredit','lihat1','lihat2','lihat3','lihat4','lihat5','lihat6','lihat7','lihat8','lihat9','lihat10','lihat11','lihat12','lihat13','lihat14','lihat15','lihat16','lihat17','dataangs'));
    }

    public function viewFormKreditAden($tahun,$kode_kantor,$nourut)
     // public function viewFormKreditAden($nokredit)
    {
        $nokredit = $tahun.'/'.$kode_kantor.'/'.$nourut;
        $prekredit = Prekredit::where('no_kredit',$nokredit)->get();
        $daftar = Kredit::where('no_kredit',$nokredit)->get();
        $biaya = DafKreditBiaya::where('no_kredit',$nokredit)->get();
        // $kendaraan = AgunanKendaraan::where('no_kredit',$nokredit)->get();
        // $sertifikat = AgunanSertifikat::where('no_kredit',$nokredit)->get();
        // $lihatpenjamin = penjamin::where('no_kredit',$nokredit)->get();
        $bayar = AngsBayar::where('no_kredit',$nokredit)->get();
        $jadwal = AngsJadwal::where('no_kredit',$nokredit)->orderBy('bayar_ke','asc')->get();
        
        $sifatkrd = DB::connection('pgsql')->table('mst_sifat_kredit')->orderBy('kode','asc')->get();
        $jns_krd = DB::connection('pgsql')->table('mst_krd')->orderBy('sandi','asc')->get();
        $skim = DB::connection('pgsql')->table('mst_skim')->orderBy('kode','asc')->get();
        $kadeb = DB::connection('pgsql')->table('mst_debitur')->orderBy('sandi','asc')->get();
        $goldeb = DB::connection('pgsql')->table('mst_goldeb')->where('status',' ')->orderBy('sandi','asc')->get();
        $jnsbiaya = DB::connection('pgsql')->table('mst_guna')->orderBy('kode','asc')->get();
        $ori = DB::connection('pgsql')->table('mst_ori')->orderBy('kode','asc')->get();
        $eko = DB::connection('pgsql')->table('mst_eko')->where('status',' ')->orderBy('kode','asc')->get();
        $dati2 = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc1','asc')->get();
        $jenisbunga = DB::connection('pgsql')->table('mst_bunga')->orderBy('sadi','asc')->get();
        $kreditpp = DB::connection('pgsql')->table('mst_kreditpp')->orderBy('sandi','asc')->get();
        $sumber = DB::connection('pgsql')->table('mst_sumber')->get();
        $kolek = DB::connection('pgsql')->table('mst_kolek')->orderBy('sandi','asc')->get();
        $sebabmacet = DB::connection('pgsql')->table('mst_sebab')->orderBy('kode','asc')->get();
        $cara = DB::connection('pgsql')->table('mst_cara')->orderBy('kode','asc')->get();
        $kondisi = DB::connection('pgsql')->table('mst_kondisi')->get();
        $valuta = DB::connection('pgsql')->table('mst_valuta')->get();
        $res = DB::connection('pgsql')->table('mst_cara')->get();
        $kode_kantor = refkodekantor::all();
        $ljk = DB::connection('pgsql')->table('mst_ljk')->where('status',' ')->orderBy('kode','asc')->get();
        $ao = DB::connection('pgsql')->table('mst_ao')->where('aktif','1')->orderBy('kota','asc')->get();

        $sql1 ="SELECT mst_ao.kodeao,mst_ao.namaao as aoku,kredit.namaao 
            from mst_ao,kredit 
            where kredit.no_kredit='".$nokredit."' 
            AND
            kredit.namaao=mst_ao.kodeao";
            $lihat1 = DB::connection('pgsql')->select(DB::raw($sql1));  

       // $totalsaldo  = DB::connection('pgsql')->select(DB::raw("SELECT MIN(bakidebet) as bakidebet from angsuran_kartu where no_kredit in (SELECT no_kredit from kredit where tgl_lunas::text LIKE '1900-01-01%' AND no_kredit IN (SELECT no_kredit FROM prekredit WHERE no_nsb='".$nonsb."')) GROUP BY no_kredit")); 
       //  $totalpokok = 0;
       //  foreach ($totalsaldo as $t) {
       //      $totalpokok += $t->bakidebet;
       //  }
        
        return view('kredit.kreditaden',compact('sifatkrd','jns_krd','skim','kadeb','goldeb','jnsbiaya','ori','eko','dati2','jenisbunga','kreditpp','sumber','kolek','sebabmacet','cara','kondisi','valuta','res','kode_kantor','daftar','biaya','jadwal','bayar','prekredit','nokredit','ljk','totalsaldo','totalpokok','ao','lihat1'));
        
    } 
    public function saveDataKreditAden(Request $request,$nokredit)
   {
       
       $kode_kantor =refkodekantor::where('kode_angka')->first();
       $daftar = Kredit::where('no_kredit',$nokredit)->first();
       // $lastno = Kredit::where('no_kredit',$nokredit)->first();

       $nasabah = Nasabah::where('no_nsb',$request->input('no_nsb'))->first();
       $ke = Prekredit::where('no_nsb',$request->input('no_nsb'))->count() + 1;
        if($ke > 1){
            $lastno = Prekredit::where('no_nsb',$request->input('no_nsb'))->pluck('no_kredit')->first();
            $nokredit = date('y').'/ABC.'.$request->input('input_kantor').'/'.substr($lastno,10,7).'-'.str_pad($ke, 3,'0',STR_PAD_LEFT);
        } 
       
        $prekredit = new Prekredit;
        $prekredit->no_mohon = str_pad(((int) Prekredit::max('no_mohon') + 1),10,'0',STR_PAD_LEFT);
        $prekredit->no_kredit = $nokredit;
        $prekredit->tgl_mohon = date('Y-m-d 00:00:00',strtotime($request->input('input_tgladen')));
        // $prekredit->no_nsb = $request->input('no_nsb');
        $prekredit->no_nsb = $request->input('no_nsb');
        $prekredit->nama = $nasabah->nama;
        $prekredit->no_cif = $nasabah->no_cif;
        $prekredit->kelamin = $nasabah->kelamin ;
        $prekredit->tmplahir = $nasabah->tmplahir ;
        $prekredit->tgllahir = $nasabah->tgllahir ;
        $prekredit->alamat = $nasabah->alamat ;
        $prekredit->notelp = $nasabah->notelp ;
        $prekredit->nohp = $nasabah->nohp ;
        $prekredit->rtrw = $nasabah->rtrw ;
        $prekredit->desa = $nasabah->desa ;
        $prekredit->camat = $nasabah->camat ;
        $prekredit->kodya = $nasabah->kodya ;
        $prekredit->noktp = $nasabah->noktp ;
        $prekredit->agama = $nasabah->agama ;
        $prekredit->pekerjaan = $nasabah->pekerjaan ;
        $prekredit->usaha = $nasabah->usaha ;
        $prekredit->opr = $request->input('opr');
        if(count($request->input('input_no_sertifikat')) > 0){
            $prekredit->jenkend = $request->input('input_jenis_sertifikat')[0];
        } elseif(count($request->input('input_jenis_kendaraan')) > 0){
            $prekredit->jenkend = $request->input('input_status_kendaraan')[0];
        }
        $prekredit->save();


        DB::connection('pgsql')->table('kredit')->where('no_kredit',$request->input('kredit'))->update([
            'tgl_adden'     => date('Y-m-d',strtotime($request->input('input_tgladen'))),
            ]);

        $kredit = new Kredit;
        $kredit->namaao = $request->input('nama_ao');
        $kredit->no_nsb = $request->input('no_nsb');
        // $kredit->no_cif = $request->input('no_cif');
        $kredit->no_kredit = $prekredit->no_kredit;
        $kredit->no_ref= $request->input('no_ref');
        //$kredit->no_kredit = $request->input('no_kredit');
        //$kredit->no_ref= $npp;
        $kredit->ke = $ke;
        //$kredit->jenis = $request->input('input_agunan1');
        $kredit->no_ref = strtoupper($request->input('input_no_npp'));
        $kredit->sifatkrd = $request->input('input_sifatkrd');
        $kredit->jns_krd = $request->input('input_kode_jenis_kredit');
        $kredit->skim = $request->input('input_skim');       
        $kredit->no_mohon = $prekredit->no_mohon;
        $kredit->no_akad = $request->input('input_no_mohon'); 
        $kredit->tgl_mhn = date('Y-m-d',strtotime($request->input('input_tgl_mohon')));
        // $kredit->tgl_adden = date('Y-m-d',strtotime($request->input('input_tgladen')));
        $kredit->no_mohon_akhir = $request->input('input_no_mohon_akhir'); 
        $kredit->tgl_mohon_akhir = date('Y-m-d',strtotime($request->input('input_tgl_mohon_akhir')));

        //lama mempegaruhi tgl
        $kredit->lama = $request->input('input_jangka_waktu');
        $kredit->tgl_kredit = date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_kredit')));
        $kredit->tgl_mulai = date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_mulai')));
        $kredit->tgl_akhir = date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_akhir')));
        $kredit->jatuhtempo = $kredit->tgl_akhir;

        $kredit->goldeb = $request->input('input_goldeb');
        $kredit->jnsbiaya = $request->input('input_guna');
        $kredit->ori = $request->input('input_ori');
        $kredit->eko = $request->input('input_eko');
        $kredit->dati2 = $request->input('input_kodya_nasabah');
        $kredit->valuta = $request->input('input_valuta');
        $kredit->jenisbunga = $request->input('input_jenis_bunga');
        $kredit->kreditpp = $request->input('input_kreditpp');
        $kredit->sumber = $request->input('input_sumber');
        $kredit->kolek = $request->input('input_kolek');
        $kredit->tgl_macet = date('Y-m-d',strtotime($request->input('input_tgl_macet')));
        $kredit->sebabmacet = $request->input('input_sebabmacet');
        $kredit->tgl_nunggak = date('Y-m-d',strtotime($request->input('input_tgl_nunggak')));
        $kredit->frektunggak = $request->input('input_frek_tunggakan');
        $kredit->frekres = $request->input('input_frekres');
        $kredit->tgl_resawal = date('Y-m-d',strtotime($request->input('input_tgl_resawal')));
        $kredit->tgl_resakhir = date('Y-m-d',strtotime($request->input('input_tgl_resakhir')));
        $kredit->res = $request->input('input_res');
        $kredit->kondisi = $request->input('input_kondisi');
        $kredit->tgl_kondisi = date('Y-m-d',strtotime($request->input('input_tgl_kondisi')));
        // $kredit->barupanjang = $request->input('input_baru_perpanjangan');
        $kredit->to = $request->input('input_to_dari');
        $kredit->ket = $request->input('input_ket');
        $kredit->kode_kantor = $request->input('input_kantor');

        //pakek rumus
        $kredit->arav = $request->input('input_jeniskredit');
        $kredit->sistem = $request->input('input_jenis_angsuran');
        $kredit->nilaiproyek = DataController::formatangka($request->input('input_nilaiproyek'));
        $kredit->dp = DataController::formatangka($request->input('input_dp'));
        if ($request->input('input_jenis_angsuran') == "FLAT"){
            $kredit->pinj_prsbunga = $request->input('input_bunga')*12;
        }else{
            $kredit->pinj_prsbunga = $request->input('input_bunga');
        }
        $kredit->plafon = DataController::formatangka($request->input('input_plafon'));
        $kredit->bakidebet = DataController::formatangka($request->input('input_baki'));
        $kredit->pinj_pokok = DataController::formatangka($request->input('input_pokok_hutang'));
        $kredit->jangka = $request->input('input_jangkawaktu_pembayaran');
        $kredit->bbt = $request->input('input_bbt');
        $kredit->saldo_bbt = $request->input('input_bbt');
        $kredit->saldo_piutang = $request->input('input_saldo_piutang');

        $kredit->angsur_pokok = $request->input('input_angsuran_pokok');
        $kredit->angsur_bunga = $request->input('input_angsuran_bunga');
        $kredit->opr = $request->input('opr');      
        $kredit->save();

        $arrbiaya = array('adm','provisi','notaris','polis','ass','assjiwa','feemitra','lain');
        $nextno = (int) DafKreditBiaya::max('id') + 1;
        $jmlbiaya = 0;
        for($i=0;$i<count($arrbiaya);$i++){
            if(DataController::formatangka($request->input('input_biaya_'.$arrbiaya[$i])) >= 0){
                $biaya = new DafKreditBiaya;
                $biaya->id = $nextno;
                $biaya->no_kredit = $prekredit->no_kredit;
                $biaya->biaya = $arrbiaya[$i];
                $biaya->jml = DataController::formatangka($request->input('input_biaya_'.$arrbiaya[$i]));
                if($request->input('input_cara_bayar_'.$arrbiaya[$i]) == null){
                    $biaya->bayar = 'true';
                    // $biaya->lunas = 'false';
                } else {
                    // $biaya->bayar = 'false';
                    $biaya->lunas = 'true';
                }
                // if(($biaya->biaya == 'adm') || ($biaya->biaya == 'provisi')){
                //   $biaya->jml_dibayar = $biaya->jml;
                // }
                //$biaya->lunas = 'false';
                $biaya->save();
                // $jmlbiaya += $biaya->jml;
                $nextno = (int) $biaya->id + 1;
            }   
        }

        // $kredit = Kredit::where('no_kredit',$request->input('no_kredit'))->get();
        // $kreditpembiayaan = NUKStrukturPembiayaan::where('nuk_id',$npp->nuk_id)->get();
        //gak usah for each
        // foreach ($kreditpembiayaan as $kredit) {
            // if(($kredit->sistem == "FLAT") && (($kredit->sistem <> "BUNGA-BUNGA"))){
                // if($kredit->pokok_hutang < $kredit->jumlah_pencairan){
                //     //dia pinjem brbp
                //     $saldopokok = $kredit->jumlah_pencairan;
                // }else{
                //     $saldopokok = $kredit->pokok_hutang;
                // }
                //saldonya bbt berapa (bunga x jangka waktu)
                $saldobbt = ($request->input('input_angsuran_bunga'))*($request->input('input_jangka_waktu'));
                $angspokok = $request->input('input_angsuran_pokok');
                $saldopokok = $request->input('input_plafon');
                
                $saldobbt2 = 0;

                $saldo = $saldopokok;
                      for($x = 0; $x < $request->input('input_jangka_waktu'); $x++){
                            $bunga = ceil($saldo*(($request->input('input_bunga'))/100));
                            $saldo -= $angspokok;
                            $saldobbt2 += $bunga;
                      }
                //tanggal
                $after = date('Y-m-d'); 
                //end tanggal
                // Log::info($request->input('input_jangka_waktu'));
                for($x=0;$x<$request->input('input_jangka_waktu');$x++){
                    $saldo = $saldopokok;
                    if(($x+1) % ($request->input('input_jangkawaktu_pembayaran')) == 0){
                        if(($saldopokok - $angspokok) < 0 ){
                        //     ($request->input('input_angsuran_pokok')) += ($saldopokok - ($request->input('input_angsuran_pokok')));
                            $angspokok += $saldopokok - $angspokok;
                        }
                        $saldopokok -= $angspokok;
                    }
                    else{
                        $saldopokok -= 0;
                    }
                    
                    $saldobbt -= $request->input('input_angsuran_bunga');
                    $saldopiutang = $saldopokok+$saldobbt;

                    //tanggal arear
                
                        if((($request->input('input_jeniskredit')) == 'AV') && ($x==0)){
                            $before = explode('-', $after);
                            if($before[1] == 01){
                                $nextMonth = '12';
                                $nextYear = intval($before[0])-1;
                            }else{
                                $nextMonth = str_pad((intval($before[1])-1),2,'0',STR_PAD_LEFT);
                                $nextYear = $before[0];
                            }
                            $lastDate = date('t',strtotime($nextYear.'-'.$nextMonth.'-01'));
                            if(intval($before[2]) > intval($lastDate)){
                                $nextDay = $lastDate;
                            }else{
                                $nextDay = date('d',strtotime(date('Y-m-d')));
                            }
                            $after = $nextYear.'-'.$nextMonth.'-'.$nextDay;
                            $diff = date('t',strtotime((intval($before[0])).'-'.(intval($before[1]))));

                        }
                            $before = explode('-', $after);
                            if($before[1] == 12){
                                $nextMonth = '01';
                                $nextYear = intval($before[0])+1;
                            }else{
                                $nextMonth = str_pad((intval($before[1])+1),2,'0',STR_PAD_LEFT);
                                $nextYear = $before[0];
                            }
                            $lastDate = date('t',strtotime($nextYear.'-'.$nextMonth.'-01'));
                            if(intval($before[2]) > intval($lastDate)){
                                $nextDay = $lastDate;
                            }else{
                                $nextDay = date('d',strtotime(date('Y-m-d')));
                            }
                            $after = $nextYear.'-'.$nextMonth.'-'.$nextDay;

                        $diff = date('t',strtotime($nextYear.'-'.$nextMonth.'-01'));
                        $bunga = ceil($saldo*(($request->input('input_bunga'))/100));
                        
                        $saldobbt2 -= $bunga;
                        $saldopiutang2 = $saldopokok+$saldobbt2;
                           
                        if($kredit->sistem != "TARIKSETOR"){
                        $ta = new AngsJadwal;
                        $ta->no_kredit = $prekredit->no_kredit;
                        // $ta->struktur_id = $kredit->id;
                        $ta->bayar_ke = $x+1;
                        if($kredit->sistem == "FLAT" || $kredit->sistem == "BUNGA"){
                            if(($x+1) % $kredit->jangka == 0){
                                $ta->angsur = $kredit->angsur_pokok+$kredit->angsur_bunga;
                                $ta->angs_pokok = $kredit->angsur_pokok;
                            }else if($kredit->sistem == "BUNGATURUN"){
                                $ta->angsur = $kredit->angsur_bunga;
                                $ta->angs_pokok = 0;
                            }
                        $ta->angs_bunga = $kredit->angsur_bunga;
                        $ta->sal_bbt = $saldobbt;
                        $ta->sal_piutang = $saldopokok+$saldobbt;
                        }else{
                            if(($x+1) % $kredit->jangka == 0){
                                $ta->angsur = $kredit->angsur_pokok+$bunga;
                                $ta->angs_pokok = $kredit->angsur_pokok;
                            }else{
                                $ta->angsur = $bunga;
                                $ta->angs_pokok = 0;
                            }
                        $ta->angs_bunga = $bunga;
                        $ta->sal_bbt = $saldobbt2;
                        $ta->sal_piutang = $saldopokok+$saldobbt2;
                        }

                        $ta->haribunga = $diff;
                        $ta->sal_pokok = $saldopokok;
                        // $ta->sal_bbt = $saldobbt;
                        // $ta->sal_piutang = $saldopokok+$saldobbt;

                        //kasih if untuk tanggal
                        $ta->tgl_angsur = date('Y-m-d',strtotime($after));
                        // if($kredit->arav != 'AV'){
                        //     $ta->tgl_angsur = date('Y-m-d',strtotime($after));
                        // }else{
                        //     $ta->tgl_angsur = date('Y-m-d',strtotime($current));
                        // }
                        // $ta->tanggal_akhir_bulan = date('Y-m-t',strtotime($after));
                        // $ta->jumlah_hari = date_diff(date_create($ta->tanggal_angsuran), date_create($ta->tanggal_akhir_bulan))->format('%a') + 1;
                        // $ta->akhir_bulan = ceil((($kredit->angsur_bunga/30)*$ta->jumlah_hari)/100)*100;
                        // $ta->saat_angsuran = ceil(($kredit->angsur_bunga - $ta->akhir_bulan)/100)*100;
                        $ta->save();
                    }
                }

        // $totalsaldo  = DB::connection('pgsql')->select(DB::raw("SELECT MIN(bakidebet) as bakidebet from angsuran_kartu where no_kredit in (SELECT no_kredit from kredit where tgl_lunas::text LIKE '1900-01-01%' AND no_kredit IN (SELECT no_kredit FROM prekredit WHERE no_nsb='".$request->input('no_nsb')."')) GROUP BY no_kredit")); 
        // $totalpokok = 0;
        // foreach ($totalsaldo as $t) {
        //     $totalpokok += $t->bakidebet;
        // }
        
        // if($totalpokok >= 5000000000){

        // $lap = new Laporan;
        // $lap->no_nsb = $request->input('no_nsb');
        // $lap->no_cif = $request->input('no_cif');
        // $lap->no_kredit = $prekredit->no_kredit;
        // $lap->tahunan  = date('Y-m-d H:i:s',strtotime($request->input('input_posisi_lapKeuangan_tahunan')));
        // $lap->aset = $request->input('input_aset');
        // $lap->aset_lancar = $request->input('input_aset_lancar');
        // $lap->kas = $request->input('input_kas');
        // $lap->piutang_usaha_al = $request->input('input_piutang_usaha_al');
        // $lap->investasi_lancar = $request->input('input_investasi_lacar');
        // $lap->aset_lancar_lain = $request->input('input_aset_lancar_lain');
        // $lap->aset_tdk_lancar = $request->input('input_aset_tdk_lancar');
        // $lap->piutang_usaha_atl = $request->input('input_piutang_usaha_atl');
        // $lap->invest_tdk_lancar = $request->input('input_invest_tdk_lancar');
        // $lap->aset_tdk_lancar_lain = $request->input('input_aset_tdk_lancar_lain');
        // $lap->lia = $request->input('input_lia');
        // $lap->lia_pndk = $request->input('input_lia_pndk');
        // $lap->pinjaman_pndk = $request->input('input_pinjaman_pndk');
        // $lap->utang_usaha_pndk = $request->input('input_utang_usaha_pndk');
        // $lap->lia_pndk_lain = $request->input('input_lia_pndk_lain');
        // $lap->lia_pnjg = $request->input('input_lia_pnjng');
        // $lap->pinjaman_pnjng = $request->input('input_pinjaman_pnjng');
        // $lap->utang_usaha_pnjng = $request->input('input_utang_usaha_panjang');
        // $lap->lia_pnjng_lain = $request->input('input_lia_panjang_lain');
        // $lap->ekuitas = $request->input('input_ekuitas');
        // $lap->pendapatan_usaha = $request->input('input_pendapatan_usaha');
        // $lap->beban_pokok = $request->input('input_beban_pokok');
        // $lap->labarugi = $request->input('input_labarugi');
        // $lap->pendapatan_lain = $request->input('input_pendapatan_lain');
        // $lap->beban_lain = $request->input('input_beban_lain');
        // $lap->labarugi_lalu = $request->input('input_labarugi_sblmPajak');
        // $lap->labarugi_tahun = $request->input('input_labarugi_tahun');
        // $lap->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')));
        // $lap->save();
        // }
                
        // echo "no kredit =".$nokredit; 
        return redirect('/');
    }

    public function viewFormKreditHapus($tahun,$kode_kantor,$nourut)
    {
        $nokredit = $tahun.'/'.$kode_kantor.'/'.$nourut;
        $prekredit = Prekredit::where('no_kredit',$nokredit)->first();
        $kredit = Kredit::where('no_kredit',$nokredit)->first();

        return view('kredit.hapuskredit',compact('prekredit','kredit'));
    }
    public function saveDataKreditHapus(Request $request,$nokredit)
    {
        DB::connection('pgsql')->table('kredit')->where('no_kredit',$request->input('no_kredit'))->update([
            'kondisi'          => ('03'),
            'tgl_kondisi'      => date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_hpsbi'))),
            'tgl_hapusint'     => date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_hpsin'))),
            'no_hapusint'      => ($request->input('input_no_hpsin')),
            'tgl_hapusbi'      => date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_hpsbi'))),
            'no_hapusbi'       => ($request->input('input_no_hpsbi'))
            ]);
        return redirect('/');
    }

    public function viewFormAgunHapus($tahun,$kode_kantor,$nourut)
    {
        $nokredit = $tahun.'/'.$kode_kantor.'/'.$nourut;
        $prekredit = Prekredit::where('no_kredit',$nokredit)->first();
        $kredit = Kredit::where('no_kredit',$nokredit)->first();
        $agkredit = AgunanKredit::where('no_kredit',$nokredit)->get();

        $sertifikat = AgunanSertifikat::where('no_kredit',$nokredit)->get();
        $kendaraan = AgunanKendaraan::where('no_kredit',$nokredit)->get();

        return view('agunan.hapusagunan',compact('prekredit','kredit','sertifikat','kendaraan','agkredit'));
    }
    public function saveDataAgunHapus(Request $request,$nokredit)
        {
        // $nasabah = Nasabah::where('no_nsb',$request->input('no_nsb'))->first();
        $prekredit = Prekredit::where('no_kredit',$nokredit)->get();
        $kredit = Kredit::where('no_kredit',$nokredit)->get();
        $sertifikat = AgunanSertifikat::where('no_kredit',$nokredit)->get();
        $kendaraan = AgunanKendaraan::where('no_kredit',$nokredit)->get();

        /*DB::connection('pgsql')->table('agunan_kend')->where('no_kredit',$request->input('no_kredit'))->where('no_agunan',$request->input('nomor')[$i])->update([
            'status'     => ($request->input('input_status')),
            ]);*/
 
        if(count($request->input('nobukti')) > 0){
            // $nextno =(int) AgunanSertifikat::max('no_agunan') + 1;
            for($i=0;$i<count($request->input('nobukti'));$i++){
                DB::connection('pgsql')->table('agunan_kend')->where('no_kredit',$request->input('no_kredit'))->where('no_agunan',$request->input('nomor')[$i])->update([
                    'status'     => ($request->input('input_status')[$i]),
                    ]);
                DB::connection('pgsql')->table('agunan_sert')->where('no_kredit',$request->input('no_kredit'))->where('no_agunan',$request->input('nomor')[$i])->update([
                            'status'     => ($request->input('input_status')[$i]),
                            ]);
                DB::connection('pgsql')->table('agunan_kredit')->where('no_kredit',$request->input('no_kredit'))->where('no_agunan',$request->input('nomor')[$i])->update([
                            'status'     => ($request->input('input_status')[$i]),
                            ]);
                if(($request->input('nobukti')[$i] <> null) || ($request->input('nobukti')[$i] <> '')){
                    $agunkeluar = new AgunanKeluar;
                    $agunkeluar->no_nsb =$request->input('no_nsb'); 
                    // $agunkeluar->no_cif =$request->input('no_cif'); 
                    $agunkeluar->no_kredit=$request->input('no_kredit');

                    $agunkeluar->nobukti = $request->input('nobukti')[$i];
                    $agunkeluar->tanggal = date('Y-m-d H:i:s',strtotime($request->input('tanggal')[$i]));
                    $agunkeluar->jenis = $request->input('jenis')[$i];
                    $agunkeluar->opr = $request->input('opr')[$i];
                    $agunkeluar->peminjam = $request->input('peminjam')[$i];
                    $agunkeluar->keterangan = $request->input('ket')[$i];
                    $agunkeluar->no_agunan = $request->input('nomor')[$i];
                    $agunkeluar->nm_pengaju = $request->input('nm_aju')[$i];
                    $agunkeluar->hrg_pengaju = $request->input('hrg_aju')[$i];
                    $agunkeluar->nm_setuju = $request->input('nm_setuju')[$i];
                    $agunkeluar->hrg_setuju = $request->input('hrg_setuju')[$i];
                    $agunkeluar->hrg_jual = $request->input('hrg_jual')[$i];
                    $agunkeluar->save();
                    // $nextno = (int) $agunansert->no_agunan + 1;
                }
            }
        }
        
        return redirect('/');
    }

//koreksi NUK

    public function dataFormKoreksikredit($nokreditnuk)
    {
        // $nokredit = $tahun.'/'.$kode_kantor.'/'.$nourut;
        
        $sifatkrd = DB::connection('pgsql')->table('mst_sifat_kredit')->orderBy('kode','asc')->get();
        $jns_krd = DB::connection('pgsql')->table('mst_krd')->orderBy('sandi','asc')->get();
        $skim = DB::connection('pgsql')->table('mst_skim')->orderBy('kode','asc')->get();
        $kadeb = DB::connection('pgsql')->table('mst_debitur')->orderBy('sandi','asc')->get();
        $goldeb = DB::connection('pgsql')->table('mst_goldeb')->where('status',' ')->orderBy('sandi','asc')->get();
        $jnsbiaya = DB::connection('pgsql')->table('mst_guna')->orderBy('kode','asc')->get();
        $ori = DB::connection('pgsql')->table('mst_ori')->orderBy('kode','asc')->get();
        $eko = DB::connection('pgsql')->table('mst_eko')->where('status',' ')->orderBy('kode','asc')->get();
        $dati2 = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $jenisbunga = DB::connection('pgsql')->table('mst_bunga')->orderBy('sadi','asc')->get();
        $kreditpp = DB::connection('pgsql')->table('mst_kreditpp')->orderBy('sandi','asc')->get();
        $sumber = DB::connection('pgsql')->table('mst_sumber')->get();
        $kolek = DB::connection('pgsql')->table('mst_kolek')->orderBy('sandi','asc')->get();
        $sebabmacet = DB::connection('pgsql')->table('mst_sebab')->orderBy('kode','asc')->get();
        $cara = DB::connection('pgsql')->table('mst_cara')->orderBy('kode','asc')->get();
        $kondisi = DB::connection('pgsql')->table('mst_kondisi')->orderBy('kode','asc')->get();
        $valuta = DB::connection('pgsql')->table('mst_valuta')->orderBy('kode','asc')->get();
        $res = DB::connection('pgsql')->table('mst_cara')->orderBy('kode','asc')->get();
        $ljk = DB::connection('pgsql')->table('mst_ljk')->where('status',' ')->orderBy('kode','asc')->get();
        $ao = DB::connection('pgsql')->table('mst_ao')->orderBy('kota','asc')->get();
        $kode_kantor = refkodekantor::all();
        
        $prekredit = prekredit_nuk::where('no_kredit',$nokreditnuk)->first();
        $kredit = kredit_nuk::where('no_kredit',$nokreditnuk)->first();
        $lapuang = Laporan::where('no_kredit',$nokreditnuk)->get();

        // $totalsaldo  = DB::connection('pgsql')->select(DB::raw("SELECT MIN(bakidebet) as bakidebet from angsuran_kartu where no_kredit in (SELECT no_kredit from kredit where tgl_lunas::text LIKE '1900-01-01%' AND no_kredit IN (SELECT no_kredit FROM prekredit WHERE no_nsb='".$nonsb."')) GROUP BY no_kredit")); 
        // $totalpokok = 0;
        // foreach ($totalsaldo as $t) {
        //     $totalpokok += $t->bakidebet;
        // }
                
        return view('nuk.koreksikreditnuk',compact('sifatkrd','jns_krd','skim','kadeb','goldeb','jnsbiaya','ori','eko','dati2','jenisbunga','kreditpp','sumber','kolek','sebabmacet','cara','kondisi','valuta','res','kode_kantor','nasabah','ljk','totalsaldo','totalpokok','lapuang','ao','prekredit','kredit'));
        
    } 

    public function savekreditkorek(Request $request,$nokreditnuk)
    {
       // Log::info($nonsb);
       // $totalpokok = 0;
       // $lapuang = Laporan::where('no_nsb',$nonsb)->get();
       $kode_kantor =refkodekantor::where('kode_angka')->first();

       // $nasabah = Nasabah::where('no_nsb',$request->input('no_nsb'))->first();
       // $ke = Prekredit::where('no_nsb',$request->input('no_nsb'))->count() + 1;
       //  if($ke > 1){
       //      $lastno = Prekredit::where('no_nsb',$request->input('no_nsb'))->pluck('no_kredit')->first();
       //      $nokredit = date('y').'/ABC.'.$request->input('input_kantor').'/'.substr($lastno,10,7).'-'.str_pad($ke, 3,'0',STR_PAD_LEFT);
       //  } else {
       //     $lastno = DB::connection('pgsql')->select(DB::raw('select max(substr(no_kredit,11,7)) as no from prekredit'))[0];
       //     $nokredit = date('y').'/ABC.'.$request->input('input_kantor').'/'.str_pad((int) ($lastno->no + 1),7,STR_PAD_LEFT).'-001';
       //  }
       
        // $prekredit = new prekredit_nuk;
        // $prekredit->no_mohon = str_pad(((int) Prekredit::max('no_mohon') + 1),10,'0',STR_PAD_LEFT);
        // $prekredit->no_kredit = $nokreditnuk;
        // $prekredit->tgl_mohon = date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_kredit'))); 
        // $prekredit->no_nsb = $request->input('no_nsb');
        // $prekredit->no_cif = $nasabah->no_cif;
        // $prekredit->nama = $nasabah->nama;
        // $prekredit->kelamin = $nasabah->kelamin ;
        // $prekredit->tmplahir = $nasabah->tmplahir ;
        // $prekredit->tgllahir = $nasabah->tgllahir ;
        // $prekredit->alamat = $nasabah->alamat ;
        // $prekredit->notelp = $nasabah->notelp ;
        // $prekredit->nohp = $nasabah->nohp ;
        // $prekredit->rtrw = $nasabah->rtrw ;
        // $prekredit->desa = $nasabah->desa ;
        // $prekredit->camat = $nasabah->camat ;
        // $prekredit->kodya = $nasabah->kodya ;
        // $prekredit->noktp = $nasabah->noktp ;
        // $prekredit->agama = $nasabah->agama ;
        // $prekredit->pekerjaan = $nasabah->pekerjaan ;
        // $prekredit->usaha = $nasabah->usaha ;

        // $prekredit->nobadan = $nasabah->nobadan;
        // $prekredit->jenisbadan = $nasabah->jenisbadan;
        // $prekredit->tempatberdiri = $nasabah->tempatberdiri;
        // $prekredit->noakta = $nasabah->noakta;
        // $prekredit->tglakta = $nasabah->tglakta;
        // $prekredit->opr = $request->input('opr');

        // $prekredit->kode_kantor = $request->input('input_kantor');

        // if(count($request->input('input_no_sertifikat')) > 0){
        //     $prekredit->jenkend = $request->input('input_jenis_sertifikat')[0];
        // } elseif(count($request->input('input_jenis_kendaraan')) > 0){
        //     $prekredit->jenkend = $request->input('input_status_kendaraan')[0];
        // }
        // $prekredit->save();

        $prekredit = prekredit_nuk::where('no_kredit',$nokreditnuk)->get();

        DB::connection('pgsql')->table('kredit_nuk')->where('no_kredit',$request->input('no_kredit'))->update([
            'namaao' => ($request->input('nama_ao')),
            'no_nsb' => ($request->input('no_nsb')),
            'no_kredit' => ($request->input('no_kredit')),
            'no_ref'=> ($request->input('no_ref')),
            'ke' => ($request->input('ke')),
            'no_ref' => (strtoupper($request->input('input_no_npp'))),
            'sifatkrd' => ($request->input('input_sifatkrd')),
            'jns_krd' => ($request->input('input_kode_jenis_kredit')),
            'skim' => ($request->input('input_skim')),       
            'no_mohon' => ($request->input('no_mohon')),
            'no_akad' => ($request->input('input_no_mohon')), 
            'tgl_mhn' => (date('Y-m-d',strtotime($request->input('input_tgl_mohon')))),
            'no_mohon_akhir' => ($request->input('input_no_mohon_akhir')), 
            'tgl_mohon_akhir' => (date('Y-m-d',strtotime($request->input('input_tgl_mohon_akhir')))),
            'lama' => ($request->input('input_jangka_waktu')),
            'tgl_kredit' => (date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_kredit')))),
            'tgl_mulai' => (date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_mulai')))),
            'tgl_akhir' => (date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_akhir')))),
            'jatuhtempo' => ( date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_akhir')))),
            'goldeb' => ($request->input('input_goldeb')),
            'jnsbiaya' => ($request->input('input_guna')),
            'ori' => ($request->input('input_ori')),
            'eko' => ($request->input('input_eko')),
            'dati2' => ($request->input('input_kodya_nasabah')),
            'valuta' => ($request->input('input_valuta')),
            'jenisbunga' => ($request->input('input_jenis_bunga')),
            'kreditpp' => ($request->input('input_kreditpp')),
            'sumber' => ($request->input('input_sumber')),
            'kolek' => ($request->input('input_kolek')),
            'tgl_macet' => (date('Y-m-d',strtotime($request->input('input_tgl_macet')))),
            'sebabmacet' => ($request->input('input_sebabmacet')),
            'tgl_nunggak' => (date('Y-m-d',strtotime($request->input('input_tgl_nunggak')))),
            'frektunggak' => ($request->input('input_frek_tunggakan')),
            'frekres' => ($request->input('input_frekres')),
            'tgl_resawal' => (date('Y-m-d',strtotime($request->input('input_tgl_resawal')))),
            'tgl_resakhir' => (date('Y-m-d',strtotime($request->input('input_tgl_resakhir')))),
            'res' => ($request->input('input_res')),
            'kondisi' => ($request->input('input_kondisi')),
            'tgl_kondisi' => (date('Y-m-d',strtotime($request->input('input_tgl_kondisi')))),
            'to' => ($request->input('input_to_dari')),
            'ket' => ($request->input('input_ket')),
            'kode_kantor' => ($request->input('input_kantor')),

            //pakek rumus
            'arav' => ($request->input('input_jeniskredit')),
            'sistem' => ($request->input('input_jenis_angsuran')),
            'nilaiproyek' => (DataController::formatangka($request->input('input_nilaiproyek'))),
            'dp' => (DataController::formatangka($request->input('input_dp'))),
            
            'plafon' => (DataController::formatangka($request->input('input_plafon'))),
            'bakidebet' => (DataController::formatangka($request->input('input_baki'))),
            'pinj_pokok' => (DataController::formatangka($request->input('input_pokok_hutang'))),
            'jangka' => ($request->input('input_jangkawaktu_pembayaran')),
            'bbt' => ($request->input('input_bbt')),
            'saldo_bbt' => ($request->input('input_bbt')),
            'saldo_piutang' => ($request->input('input_saldo_piutang')),
            'angsur_pokok' => ($request->input('input_angsuran_pokok')),
            'angsur_bunga' => ($request->input('input_angsuran_bunga')),
            'opr' => ($request->input('opr'))
            ]);
            
            if ($request->input('input_jenis_angsuran') == "FLAT"){
                DB::connection('pgsql')->table('kredit_nuk')->where('no_kredit',$request->input('no_kredit'))->update(['pinj_prsbunga' => ($request->input('input_bunga')*12)]);
            }else{
                DB::connection('pgsql')->table('kredit_nuk')->where('no_kredit',$request->input('no_kredit'))->update(['pinj_prsbunga' => ($request->input('input_bunga'))]);
            }


        $kredit = new kredit_nuk_his;
        $kredit->namaao = $request->input('nama_ao');
        $kredit->no_nsb = $request->input('no_nsb');
        // $kredit->no_cif = $request->input('no_cif');
        $kredit->no_kredit = $request->input('no_kredit');
        //$kredit->no_kredit = $request->input('no_kredit');
        $kredit->no_ref= $request->input('no_ref');
        $kredit->ke = $request->input('ke');
        //$kredit->jenis = $request->input('input_agunan1');
        $kredit->no_ref = strtoupper($request->input('input_no_npp'));
        $kredit->sifatkrd = $request->input('input_sifatkrd');
        $kredit->jns_krd = $request->input('input_kode_jenis_kredit');
        $kredit->skim = $request->input('input_skim');       
        $kredit->no_mohon = $request->input('no_mohon');
        $kredit->no_akad = $request->input('input_no_mohon'); 
        $kredit->tgl_mhn = date('Y-m-d',strtotime($request->input('input_tgl_mohon')));
        $kredit->no_mohon_akhir = $request->input('input_no_mohon_akhir'); 
        $kredit->tgl_mohon_akhir = date('Y-m-d',strtotime($request->input('input_tgl_mohon_akhir')));

        //lama mempegaruhi tgl
        $kredit->lama = $request->input('input_jangka_waktu');
        $kredit->tgl_kredit = date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_kredit')));
        $kredit->tgl_mulai = date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_mulai')));
        $kredit->tgl_akhir = date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_akhir')));
        $kredit->jatuhtempo = $kredit->tgl_akhir;

        // Log::info($kredit->tgl_mulai);

        $kredit->goldeb = $request->input('input_goldeb');
        $kredit->jnsbiaya = $request->input('input_guna');
        $kredit->ori = $request->input('input_ori');
        $kredit->eko = $request->input('input_eko');
        $kredit->dati2 = $request->input('input_kodya_nasabah');
        $kredit->valuta = $request->input('input_valuta');
        $kredit->jenisbunga = $request->input('input_jenis_bunga');
        $kredit->kreditpp = $request->input('input_kreditpp');
        $kredit->sumber = $request->input('input_sumber');
        $kredit->kolek = $request->input('input_kolek');
        $kredit->tgl_macet = date('Y-m-d',strtotime($request->input('input_tgl_macet')));
        $kredit->sebabmacet = $request->input('input_sebabmacet');
        $kredit->tgl_nunggak = date('Y-m-d',strtotime($request->input('input_tgl_nunggak')));
        $kredit->frektunggak = $request->input('input_frek_tunggakan');
        $kredit->frekres = $request->input('input_frekres');
        $kredit->tgl_resawal = date('Y-m-d',strtotime($request->input('input_tgl_resawal')));
        $kredit->tgl_resakhir = date('Y-m-d',strtotime($request->input('input_tgl_resakhir')));
        $kredit->res = $request->input('input_res');
        $kredit->kondisi = $request->input('input_kondisi');
        $kredit->tgl_kondisi = date('Y-m-d',strtotime($request->input('input_tgl_kondisi')));
        // $kredit->barupanjang = $request->input('input_baru_perpanjangan');
        $kredit->to = $request->input('input_to_dari');
        $kredit->ket = $request->input('input_ket');
        $kredit->kode_kantor = $request->input('input_kantor');

        //pakek rumus
        $kredit->arav = $request->input('input_jeniskredit');
        $kredit->sistem = $request->input('input_jenis_angsuran');
        $kredit->nilaiproyek = DataController::formatangka($request->input('input_nilaiproyek'));
        $kredit->dp = DataController::formatangka($request->input('input_dp'));
        
        $kredit->plafon = DataController::formatangka($request->input('input_plafon'));
        $kredit->bakidebet = DataController::formatangka($request->input('input_baki'));
        $kredit->pinj_pokok = DataController::formatangka($request->input('input_pokok_hutang'));
        $kredit->jangka = $request->input('input_jangkawaktu_pembayaran');
        $kredit->bbt = $request->input('input_bbt');
        $kredit->saldo_bbt = $request->input('input_bbt');
        $kredit->saldo_piutang = $request->input('input_saldo_piutang');

        $kredit->angsur_pokok = $request->input('input_angsuran_pokok');
        $kredit->angsur_bunga = $request->input('input_angsuran_bunga');
        $kredit->opr = $request->input('opr');

        if ($request->input('input_jenis_angsuran') == "FLAT"){
             DB::connection('pgsql')->table('kredit_nuk_his')->where('no_kredit',$request->input('no_kredit'))->update([
                'pinj_prsbunga' => ($request->input('input_bunga')*12)]);
        }else{
             DB::connection('pgsql')->table('kredit_nuk_his')->where('no_kredit',$request->input('no_kredit'))->update([
            'pinj_prsbunga' => ($request->input('input_bunga'))]);
        }

        $kredit->save();

        $arrbiaya = array('adm','provisi','notaris','polis','ass','assjiwa','feemitra','lain');
        $nextno = (int) kredit_biaya_nuk_his::max('id') + 1;
        $jmlbiaya = 0;
        for($i=0;$i<count($arrbiaya);$i++){
            if(DataController::formatangka($request->input('input_biaya_'.$arrbiaya[$i])) >= 0){
                $biaya = new kredit_biaya_nuk_his;
                $biaya->id = $nextno;
                $biaya->no_kredit = $request->input('no_kredit');
                $biaya->biaya = $arrbiaya[$i];
                $biaya->jml = DataController::formatangka($request->input('input_biaya_'.$arrbiaya[$i]));
                if($request->input('input_cara_bayar_'.$arrbiaya[$i]) == null){
                    $biaya->bayar = 'true';
                    // $biaya->lunas = 'false';
                } else {
                    // $biaya->bayar = 'false';
                    $biaya->lunas = 'true';
                }
                // if(($biaya->biaya == 'adm') || ($biaya->biaya == 'provisi')){
                //   $biaya->jml_dibayar = $biaya->jml;
                // }
                //$biaya->lunas = 'false';
                $biaya->save();
                // $jmlbiaya += $biaya->jml;
                $nextno = (int) $biaya->id + 1;
                
            }   
        }

        $arrbiaya = array('adm','provisi','notaris','polis','ass','assjiwa','feemitra','lain');
        $nextno = (int) kredit_biaya_nuk::max('id') + 1;
        $jmlbiaya = 0;
        for($i=0;$i<count($arrbiaya);$i++){
            if(DataController::formatangka($request->input('input_biaya_'.$arrbiaya[$i])) >= 0){
                DB::connection('pgsql')->table('kredit_biaya_nuk')->where('no_kredit',$request->input('no_kredit'))->update([
                    'id'          => ($nextno),
                    'no_kredit'   => ($request->input('no_kredit')),
                    'biaya'       => ($arrbiaya[$i]),
                    'jml'         => DataController::formatangka($request->input('input_biaya_'.$arrbiaya[$i]))
                ]);
                    if($request->input('input_cara_bayar_'.$arrbiaya[$i]) == null){
                        DB::connection('pgsql')->table('kredit_biaya_nuk')->where('no_kredit',$request->input('no_kredit'))->update(['bayar' => (true)]);
                    } else {
                        DB::connection('pgsql')->table('kredit_biaya_nuk')->where('no_kredit',$request->input('no_kredit'))->update(['lunas' => (true)]);
                    }
                $nextno  = (int) $biaya->id + 1;
            }   
        }

       

        
                $saldobbt = ($request->input('input_angsuran_bunga'))*($request->input('input_jangka_waktu'));
                $angspokok = $request->input('input_angsuran_pokok');
                $saldopokok = $request->input('input_plafon');
                
                $saldobbt2 = 0;

                $saldo = $saldopokok;
                      for($x = 0; $x < $request->input('input_jangka_waktu'); $x++){
                            $bunga = ceil($saldo*(($request->input('input_bunga'))/100));
                            $saldo -= $angspokok;
                            $saldobbt2 += $bunga;
                      }
                //tanggal
                $after = date('Y-m-d'); 
                //end tanggal
                // Log::info($request->input('input_jangka_waktu'));
                for($x=0;$x<$request->input('input_jangka_waktu');$x++){
                    $saldo = $saldopokok;
                    if(($x+1) % ($request->input('input_jangkawaktu_pembayaran')) == 0){
                        if(($saldopokok - $angspokok) < 0 ){
                        //     ($request->input('input_angsuran_pokok')) += ($saldopokok - ($request->input('input_angsuran_pokok')));
                            $angspokok += $saldopokok - $angspokok;
                        }
                        $saldopokok -= $angspokok;
                    }
                    else{
                        $saldopokok -= 0;
                    }
                    
                    $saldobbt -= $request->input('input_angsuran_bunga');
                    $saldopiutang = $saldopokok+$saldobbt;

                    //tanggal arear
                
                        if((($request->input('input_jeniskredit')) == 'AV') && ($x==0)){
                            $before = explode('-', $after);
                            if($before[1] == 01){
                                $nextMonth = '12';
                                $nextYear = intval($before[0])-1;
                            }else{
                                $nextMonth = str_pad((intval($before[1])-1),2,'0',STR_PAD_LEFT);
                                $nextYear = $before[0];
                            }
                            $lastDate = date('t',strtotime($nextYear.'-'.$nextMonth.'-01'));
                            if(intval($before[2]) > intval($lastDate)){
                                $nextDay = $lastDate;
                            }else{
                                $nextDay = date('d',strtotime(date('Y-m-d')));
                            }
                            $after = $nextYear.'-'.$nextMonth.'-'.$nextDay;
                            $diff = date('t',strtotime((intval($before[0])).'-'.(intval($before[1]))));

                        }
                            $before = explode('-', $after);
                            if($before[1] == 12){
                                $nextMonth = '01';
                                $nextYear = intval($before[0])+1;
                            }else{
                                $nextMonth = str_pad((intval($before[1])+1),2,'0',STR_PAD_LEFT);
                                $nextYear = $before[0];
                            }
                            $lastDate = date('t',strtotime($nextYear.'-'.$nextMonth.'-01'));
                            if(intval($before[2]) > intval($lastDate)){
                                $nextDay = $lastDate;
                            }else{
                                $nextDay = date('d',strtotime(date('Y-m-d')));
                            }
                            $after = $nextYear.'-'.$nextMonth.'-'.$nextDay;

                        $diff = date('t',strtotime($nextYear.'-'.$nextMonth.'-01'));
                        $bunga = ceil($saldo*(($request->input('input_bunga'))/100));
                        
                        $saldobbt2 -= $bunga;
                        $saldopiutang2 = $saldopokok+$saldobbt2;
                    
                    // if($kredit->sistem != "TARIKSETOR"){
                    //     $ta = new AngsJadwal;
                    //     $ta->no_kredit = $request->input('no_kredit');
                    //     // $ta->struktur_id = $kredit->id;
                    //     $ta->bayar_ke = $x+1;
                    //     if($kredit->sistem == "FLAT" || $kredit->sistem == "BUNGA"){
                    //         if(($x+1) % $kredit->jangka == 0){
                    //             $ta->angsur = $kredit->angsur_pokok+$kredit->angsur_bunga;
                    //             $ta->angs_pokok = $kredit->angsur_pokok;
                    //         }else if($kredit->sistem == "BUNGATURUN"){
                    //             $ta->angsur = $kredit->angsur_bunga;
                    //             $ta->angs_pokok = 0;
                    //         }
                    //     $ta->angs_bunga = $kredit->angsur_bunga;
                    //     $ta->sal_bbt = $saldobbt;
                    //     $ta->sal_piutang = $saldopokok+$saldobbt;
                    //     }else{
                    //         if(($x+1) % $kredit->jangka == 0){
                    //             $ta->angsur = $kredit->angsur_pokok+$bunga;
                    //             $ta->angs_pokok = $kredit->angsur_pokok;
                    //         }else{
                    //             $ta->angsur = $bunga;
                    //             $ta->angs_pokok = 0;
                    //         }
                    //     $ta->angs_bunga = $bunga;
                    //     $ta->sal_bbt = $saldobbt2;
                    //     $ta->sal_piutang = $saldopokok+$saldobbt2;
                    //     }

                    //     $ta->haribunga = $diff;
                    //     $ta->sal_pokok = $saldopokok;
                    //     // $ta->sal_bbt = $saldobbt;
                    //     // $ta->sal_piutang = $saldopokok+$saldobbt;

                    //     //kasih if untuk tanggal
                    //     $ta->tgl_angsur = date('Y-m-d',strtotime($after));
                    //     // if($kredit->arav != 'AV'){
                    //     //     $ta->tgl_angsur = date('Y-m-d',strtotime($after));
                    //     // }else{
                    //     //     $ta->tgl_angsur = date('Y-m-d',strtotime($current));
                    //     // }
                    //     // $ta->tanggal_akhir_bulan = date('Y-m-t',strtotime($after));
                    //     // $ta->jumlah_hari = date_diff(date_create($ta->tanggal_angsuran), date_create($ta->tanggal_akhir_bulan))->format('%a') + 1;
                    //     // $ta->akhir_bulan = ceil((($kredit->angsur_bunga/30)*$ta->jumlah_hari)/100)*100;
                    //     // $ta->saat_angsuran = ceil(($kredit->angsur_bunga - $ta->akhir_bulan)/100)*100;
                    //     $ta->save();
                    // }

                    if($kredit->sistem != "TARIKSETOR"){
                    DB::connection('pgsql')->table('angsuran_jadwal_nuk')->where('no_kredit',$request->input('no_kredit'))->update([
                        'no_kredit' => ($request->input('no_kredit')),
                        'bayar_ke'  => ($x+1)
                        ]);
                    }
                       
                    if($kredit->sistem == "FLAT" || $kredit->sistem == "BUNGA"){
                            if(($x+1) % $kredit->jangka == 0){
                            DB::connection('pgsql')->table('angsuran_jadwal_nuk')->where('no_kredit',$request->input('no_kredit'))->update([
                                'angsur'        => ($kredit->angsur_pokok+$kredit->angsur_bunga),
                                'angs_pokok'    => ($kredit->angsur_pokok)]);
                            }else if('sistem' == "BUNGATURUN"){
                                if(($x+1) % $kredit->jangka == 0){
                                DB::connection('pgsql')->table('angsuran_jadwal_nuk')->where('no_kredit',$request->input('no_kredit'))->update([
                                    'angsur'     => ($kredit->angsur_bunga),
                                    'angs_pokok'     => (0)]);
                                
                            }
                        $ta->angs_bunga = $kredit->angsur_bunga;
                        $ta->sal_bbt = $saldobbt;
                        $ta->sal_piutang = $saldopokok+$saldobbt;
                        }else{
                            if(($x+1) % $kredit->jangka == 0){
                             DB::connection('pgsql')->table('angsuran_jadwal_nuk')->where('no_kredit',$request->input('no_kredit'))->update([
                                'angsur' => ($kredit->angsur_pokok+$bunga),
                                'angs_pokok' => ($kredit->angsur_pokok)]);
                            }else{
                                DB::connection('pgsql')->table('angsuran_jadwal_nuk')->where('no_kredit',$request->input('no_kredit'))->update([
                                'angsur' => ($bunga),
                                'angs_pokok' => (0)]);
                            }
                            DB::connection('pgsql')->table('angsuran_jadwal_nuk')->where('no_kredit',$request->input('no_kredit'))->update([
                            'angs_bunga' => ($bunga),
                            'sal_bbt' => ($saldobbt2),
                            'sal_piutang' => ($saldopokok+$saldobbt2)
                            ]);
                        }
                        

                        DB::connection('pgsql')->table('angsuran_jadwal_nuk')->where('no_kredit',$request->input('no_kredit'))->update([
                            'haribunga' => ($diff),
                            'sal_pokok' => ($saldopokok),
                            'tgl_angsur' => (date('Y-m-d',strtotime($after)))
                        ]);
                    }

                }   
        
       $totalsaldo  = DB::connection('pgsql')->select(DB::raw("SELECT MIN(bakidebet) as bakidebet from angsuran_kartu where no_kredit in (SELECT no_kredit from kredit where tgl_lunas::text LIKE '1900-01-01%' AND no_kredit IN (SELECT no_kredit FROM prekredit WHERE no_nsb='".$request->input('no_nsb')."')) GROUP BY no_kredit")); 
        $totalpokok = 0;
        foreach ($totalsaldo as $t) {
            $totalpokok += $t->bakidebet;
        }
        // Log::info($nonsb);
        // Log::info(json_encode($totalsaldo));
        // Log::info($totalpokok);
        // Log::info($totalpokok >= 5000000000); 

        if($totalpokok >= 5000000000){

            $lap = new Laporan;
            $lap->no_nsb = $request->input('no_nsb');
            // $lap->no_cif = $request->input('no_cif');
            $lap->no_kredit = $kredit->no_kredit;
            $lap->tahunan = date('Y-m-d H:i:s',strtotime($request->input('input_posisi_lapKeuangan_tahunan')));
            $lap->aset = DataController::formatangka ($request->input('input_aset'));
            $lap->aset_lancar = DataController::formatangka ($request->input('input_aset_lancar'));
            $lap->kas = DataController::formatangka ($request->input('input_kas'));
            $lap->piutang_usaha_al = DataController::formatangka ($request->input('input_piutang_usaha_al'));
            $lap->investasi_lancar = DataController::formatangka ($request->input('input_investasi_lacar'));
            $lap->aset_lancar_lain = DataController::formatangka ($request->input('input_aset_lancar_lain'));
            $lap->aset_tdk_lancar = DataController::formatangka ($request->input('input_aset_tdk_lancar'));
            $lap->piutang_usaha_atl = DataController::formatangka ($request->input('input_piutang_usaha_atl'));
            $lap->invest_tdk_lancar = DataController::formatangka ($request->input('input_invest_tdk_lancar'));
            $lap->aset_tdk_lancar_lain = DataController::formatangka ($request->input('input_aset_tdk_lancar_lain'));
            $lap->lia = DataController::formatangka ($request->input('input_lia'));
            $lap->lia_pndk = DataController::formatangka ($request->input('input_lia_pndk'));
            $lap->pinjaman_pndk = DataController::formatangka ($request->input('input_pinjaman_pndk'));
            $lap->utang_usaha_pndk = DataController::formatangka ($request->input('input_utang_usaha_pndk'));
            $lap->lia_pndk_lain = DataController::formatangka ($request->input('input_lia_pndk_lain'));
            $lap->lia_pnjg = DataController::formatangka ($request->input('input_lia_pnjng'));
            $lap->pinjaman_pnjng = DataController::formatangka ($request->input('input_pinjaman_pnjng'));
            $lap->utang_usaha_pnjng = DataController::formatangka ($request->input('input_utang_usaha_panjang'));
            $lap->lia_pnjng_lain = DataController::formatangka ($request->input('input_lia_panjang_lain'));
            $lap->ekuitas = DataController::formatangka ($request->input('input_ekuitas'));
            $lap->pendapatan_usaha = DataController::formatangka ($request->input('input_pendapatan_usaha'));
            $lap->beban_pokok = DataController::formatangka ($request->input('input_beban_pokok'));
            $lap->labarugi = DataController::formatangka ($request->input('input_labarugi'));
            $lap->pendapatan_lain = DataController::formatangka ($request->input('input_pendapatan_lain'));
            $lap->beban_lain = DataController::formatangka ($request->input('input_beban_lain'));
            $lap->labarugi_lalu = DataController::formatangka ($request->input('input_labarugi_sblmPajak'));
            $lap->labarugi_tahun = DataController::formatangka ($request->input('input_labarugi_tahun'));
            $lap->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')));
            $lap->save();
        }

        return redirect('/koreksidatanuk');
    }

    public function dataFormNasabahKoreksinuk($nonsb)
    {
        $nasabah = Nasabah::where('no_nsb',$nonsb)->get();
        $psnasabah = PasanganNasabah::where('no_nsb',$nonsb)->get();
        $pengurus = Pengurus::where('no_nsb',$nonsb)->get();
        // log::info(json_encode($psnasabah));

        $kodya = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc1','asc')->get();
        $kerja = DB::connection('pgsql')->table('mst_kerja')->orderBy('kode','asc')->get();
        $usaha = DB::connection('pgsql')->table('mst_eko')->where('status',' ')->orderBy('kode','asc')->get();
        $gelar = DB::connection('pgsql')->table('mst_gelar')->orderBy('kode','asc')->orderBy('kode','asc')->get();
        $negara = DB::connection('pgsql')->table('mst_negara')->orderBy('kode','asc')->get();
        $hubbank = DB::connection('pgsql')->table('mst_lapor')->orderBy('kode','asc')->get();
        $goldeb = DB::connection('pgsql')->table('mst_goldeb')->where('status',' ')->orderBy('sandi','asc')->get();
        $sumber = DB::connection('pgsql')->table('mst_sumber')->orderBy('kode','asc')->get();
        $jabatan = DB::connection('pgsql')->table('mst_jabatan')->orderBy('kode','asc')->get();
        $badan = DB::connection('pgsql')->table('mst_badanusaha')->orderBy('kode','asc')->get();
        $eko = DB::connection('pgsql')->table('mst_eko')->where('status',' ')->orderBy('kode','asc')->get();
        $lembaga =  DB::connection('pgsql')->table('lembaga')->orderBy('kode','asc')->get();
        $kelurahan = DB::connection('pgsql')->table('mst_kelurahan')->where('status','ada')->orderBy('nama','asc')->get();
        $kecamatan = DB::connection('pgsql')->table('mst_kecamatan')->where('status','ada')->orderBy('nama','asc')->get();
        // if(isset($psnasabah)){
        //     $psnasabah = PasanganNasabah::where('no_nsb',$nonsb)->get();
        // }
        // else{
            
        // }

        return view('nuk.nasabahkoreksinuk',compact('nasabah','psnasabah','nonsb','kodya','kerja','usaha','gelar','negara','hubbank','goldeb','sumber','jabatan','pengurus','eko','lembaga','badan','kelurahan','kecamatan'));   
    }

     public function saveFormNasabahKoreksinuk(Request $request,$nonsb)
    {
        $psnasabah = PasanganNasabah::where('no_nsb',$nonsb)->get();
        $dati = $request->input('input_kodya_nasabah');
        // $dati = explode('-',$request->input('input_kodya_nasabah'));

        DB::connection('pgsql')->table('nasabah')->where('no_nsb',$nonsb)->update([
            'no_nsb'        => ($nonsb),
            'no_cif'        => ($request->input('no_cif')),
            'nama'          => ($request->input('input_nama_nasabah')),
            'kelamin'       => ($request->input('input_jenis_kelamin_nasabah')),
            'tmplahir'      => ($request->input('input_tempat_lahir_nasabah')),
            'tgllahir'      => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir_nasabah'))),
            'alamat'        => ($request->input('input_alamat_nasabah')),
            'notelp'        => ($request->input('input_telepon_rumah_nasabah')),
            'rtrw'          => ($request->input('input_rt_nasabah')),
            'desa'          => ($request->input('input_kelurahan_nasabah')),
            'camat'         => ($request->input('input_kecamatan_nasabah')),
            'kodya'         => substr($dati,5),
            'agama'         => ($request->input('input_agama_nasabah')),
            'noktp'         => ($request->input('input_no_identitas_nasabah')),
            'kodepos'       => ($request->input('input_kodepos_nasabah')),
            'dati2'         => substr($dati,0,4),
            'npwp'          => ($request->input('input_no_npwp')),
            'namaibu'       => ($request->input('input_nama_ibu_kandung_nasabah')),
            'kerja'         => ($request->input('input_pekerjaan_nasabah')),
            'kd_usaha'      => ($request->input('input_usaha_nasabah')),
            'email'         => ($request->input('input_email')),
            'nohp'          => ($request->input('input_no_hp_nasabah')),
            'tglktp'        => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_berlaku_nasabah'))),
            'gelar'         => ($request->input('input_gelar')),
            'negara'        => ($request->input('input_negara')),
            'tkerja'        => ($request->input('input_tempat')),
            'alamat_kerja'  => ($request->input('input_tempat_kerja')),
            'sumber'        => ($request->input('input_sumber')),
            'tanggungan'    => ($request->input('input_tanggungan')),
            'hubbank'       => ($request->input('input_bank')),
            'goldeb'        => ($request->input('input_goldeb')),
            'tgl_mohon'     => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon'))),
            'pisah_harta'   => ($request->input('input_pisah_harta')),
            'melanggar'     => ($request->input('input_melanggar')),
            'melampaui'     => ($request->input('input_melampaui')),
            'bi_hidup'      =>  DataController::formatangka($request->input('input_biaya_hidup_nasabah')),
            'gaji'          =>  DataController::formatangka($request->input('input_pendapatan_nasabah')),
            'id'            => ($request->input('input_jenisid')),
            'pernikahan'    => ($request->input('input_status_nikah')),
            'negara'        => ($request->input('input_negara')),
            'hubbank'       => ($request->input('input_bank')),
            'nobadan'       => ($request->input('input_no_npwp')),
            'jenisbadan'    => ($request->input('input_badan')),
            'tempatberdiri' => ($request->input('input_tempatberdiri')),
            'noakta'        => ($request->input('input_noakta')),
            'tglakta'       => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_akta'))),
            'noakhir'       => ($request->input('input_noakhir')),
            'tglubah'       => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_aktaubah'))),
            // 'kd_usaha'      => ($request->input('input_eko')),
            'go'            => ($request->input('input_go')),
            'rating'        => ($request->input('input_rating')),
            'lembaga'       => ($request->input('input_kode_lembaga_pemeringkat')),
            'tglperingkat'  => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_peringkat'))),
            'grub'          => ($request->input('input_grub')),
            'opr'           => ($request->input('opr'))
            ]);
        
        // for($i=0;$i<count($nonsb);$i++){
        $dati = $request->input('input_kodya_nasabah');
         DB::connection('pgsql')->table('prekredit_nuk')->whereRaw("no_mohon=(select max(no_mohon) from prekredit_nuk where no_nsb='".$nonsb."')")->update([
            'no_nsb'  => ($nonsb),
            'nama' =>  ($request->input('input_nama_nasabah')),
            'kelamin' => ($request->input('input_jenis_kelamin_nasabah')),
            'tmplahir' => ($request->input('input_tempat_lahir_nasabah')),
            'tgllahir' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir_nasabah'))),
            'alamat' => ($request->input('input_alamat_nasabah')),
            'notelp' => ($request->input('input_telepon_rumah_nasabah')),
            'nohp' => ($request->input('input_no_hp_nasabah')),
            'rtrw' => ($request->input('input_rt_nasabah')),
            'desa' => ($request->input('input_kelurahan_nasabah')),
            'camat' => ($request->input('input_kecamatan_nasabah')),
            'kodya' => substr($dati,5),
            'noktp' => ($request->input('input_no_identitas_nasabah')),
            'agama' => ($request->input('input_agama_nasabah')),
            'pekerjaan' => ($request->input('input_pekerjaan_nasabah')),
            'usaha' => ($request->input('input_usaha_nasabah')),
            'nobadan' => ($request->input('input_no_npwp')),
            'jenisbadan' => ($request->input('input_badan')),
            'tempatberdiri' => ($request->input('input_tempatberdiri')),
            'noakta' => ($request->input('input_noakta')),
            'tglakta' => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_akta'))),
            'opr' => ($request->input('opr'))
            ]);
        // }
        
         $psnasabah = PasanganNasabah::where('no_nsb',$nonsb)->first();
        if(isset($psnasabah->ps_nama)){ 
                DB::connection('pgsql')->table('nasabah_ps')->where('no_nsb',$nonsb)->update([
                    'no_nsb'        => ($nonsb),
                    'ps_nama'       => ($request->input('input_nama_nasabah_ps')),
                    // 'ps_nikah'       => ($request->input('input_nikah')),
                    'ps_tgllahir'   => date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir_nasabah_ps'))),
                    'ps_gelar'      => ($request->input('input_gelar_ps')),
                    'ps_nohp'       => ($request->input('input_nom_nasabah_ps')),
                    'ps_tmplahir'   => ($request->input('input_tempat_lahir_nasabah_ps')),
                    'ps_agama'      => ($request->input('input_agama_nasabah_ps')),
                    'ps_noktp'      => ($request->input('input_ktp_ps')),
                    'ps_pekerjaan'  => ($request->input('input_kerja_ps')),
                    'ps_alamat'     => ($request->input('input_alamat_nasabah_ps')),
                    'ps_kodepos'    => ($request->input('input_kodepos_nasabah_ps')),
                    'ps_kodya'      => ($request->input('input_kodya_nasabah_ps')),
                    'ps_rtrw'       => ($request->input('input_rt_nasabah_ps')),
                    'ps_desa'       => ($request->input('input_kelurahan_nasabah_ps')),
                    'ps_camat'      => ($request->input('input_kecamatan_nasabah_ps'))
                    ]);
        }

        if(empty($psnasabah->ps_nama)){ 
            $psnasabah = new PasanganNasabah;
            $psnasabah->no_nsb = $request->input('input_no_nsb');
            // $psnasabah->ps_nikah = $request->input('input_nikah');
            // $psnasabah->no_cif = $request->input('no_cif');
            $psnasabah->ps_nama = strtoupper($request->input('input_nama_nasabah_ps'));
            $psnasabah->ps_gelar  = $request->input('input_gelar');
            $psnasabah->ps_tmplahir = strtoupper($request->input('input_tempat_lahir_nasabah_ps'));
            $psnasabah->ps_tgllahir = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_lahir_nasabah_ps')));
            $psnasabah->ps_agama = $request->input('input_agama_nasabah');
            $psnasabah->ps_noktp = $request->input('input_ktp_ps');
            $psnasabah->ps_nohp = $request->input('input_nom_nasabah_ps');
            $psnasabah->ps_pekerjaan = $request->input('input_kerja_ps');
            $psnasabah->ps_alamat = strtoupper($request->input('input_alamat_nasabah_ps'));
            $psnasabah->ps_kodepos = strtoupper($request->input('input_kodepos_nasabah_ps'));
            $psnasabah->ps_kodya = ($request->input('input_kodya_nasabah_ps'));
            $psnasabah->ps_rtrw = $request->input('input_rt_nasabah_ps');
            $psnasabah->ps_desa = strtoupper($request->input('input_kelurahan_nasabah_ps'));
            $psnasabah->ps_camat = strtoupper($request->input('input_kecamatan_nasabah_ps'));
            $psnasabah->opr = $request->input('opr');
            $psnasabah->save();
        }
        
        return redirect('/koreksidatanuk');
       
    }

    public function viewKoreksinuk($key=null)
    {

        $datakredit = array();

        if($key == null){
            $nsblist = Nasabah::select('no_nsb','no_cif','nama','kelamin','namaibu','tmplahir','tgllahir','alamat','kondisi')->paginate(20);
        } else {
            $nsblist = Nasabah::select('no_nsb','no_cif','nama','kelamin','namaibu','tmplahir','tgllahir','alamat','kondisi')->whereRaw("nama LIKE '%".strtoupper($key)."%'OR namaibu LIKE '%".strtoupper($key)."%' OR alamat LIKE '%".strtoupper($key)."%' OR no_cif LIKE '%".strtoupper($key)."%'" )->paginate(20);
        }

        foreach ($nsblist as $list) {
            $datakredit[$list->no_nsb] = kredit_nuk::select('no_kredit','validasi','no_ref','sistem','lama','plafon','bbt','tgl_mulai','tgl_lunas')->whereRaw("no_mohon IN (SELECT no_mohon FROM prekredit_nuk WHERE no_nsb = '".$list->no_nsb."')")->orderby('no_mohon','des')->get();
        }   

        //  foreach ($nsblist as $list) {
        //     $datapengurus[$list->no_nsb] = pegurus::select('nm_pengurus','kode_jabatan','pangsa_kepemilikan','status_pengurus')->whereRaw("no_mohon IN (SELECT no_mohon FROM prekredit WHERE no_nsb = '".$list->no_nsb."')")->get();
        // }   

        return view('nuk.koreksidatanuk',compact('nsblist','datakredit'));   
    }

     public function dataFormKoreksidatanuk ($nokredit)
    { 
       
        // $nokredit = $tahun.'/'.$kode_kantor.'/'.$nourut;
        $prekredit = Prekredit::where('no_kredit',$nokredit)->get();
        $daftar = Kredit::where('no_kredit',$nokredit)->get();
        $biaya = DafKreditBiaya::where('no_kredit',$nokredit)->get();

    $daftar = kredit_nuk::where('no_kredit',$nokredit)->get();
    $kendaraan = agunan_kend_nuk::where('no_kredit',$nokredit)->get();
    $sertifikat = agunan_sert_nuk::where('no_kredit',$nokredit)->get();
        $agkredit = AgunanKredit::where('no_kredit',$nokredit)->get();
        $lapkeuang = laporan::where('no_kredit',$nokredit)->get();
        $pengurus = Pengurus::where('no_kredit',$nokredit)->get();
        $jamin = penjamin::whereRaw("no_kredit LIKE '%".$nokredit."%'")->get();
        // Log::info($nokredit);
        // Log::info($jamin);
    $prekredit = prekredit_nuk::where('no_kredit',$nokredit)->get();
        
        $kodya = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc2','asc')->get();
        $segfas = DB::connection('pgsql')->table('mst_sefas')->orderBy('sandi','asc')->get();
        $goldeb =DB::connection('pgsql')->table('mst_goldeb')->where('status',' ')->orderBy('sandi','asc')->get();
        $kelurahan = DB::connection('pgsql')->table('mst_kelurahan')->where('status','ada')->orderBy('nama','asc')->get();
        $kecamatan = DB::connection('pgsql')->table('mst_kecamatan')->where('status','ada')->orderBy('nama','asc')->get();
        $jenisfas =  DB::connection('pgsql')->table('mst_sefas')->orderBy('sandi','asc')->get();
        $status =  DB::connection('pgsql')->table('mst_stat')->orderBy('sandi','asc')->get();
        $jenisagun =  DB::connection('pgsql')->table('mst_agunan')->orderBy('kode','asc')->get();
        $lembaga =  DB::connection('pgsql')->table('lembaga')->orderBy('kode','asc')->get();
        $ikat =  DB::connection('pgsql')->table('mst_ikat')->orderBy('kode','asc')->get();
        $dati2 = DB::connection('pgsql')->table('mst_dati2')->where('status',' ')->orderBy('desc1','asc')->get();
        $kerja = DB::connection('pgsql')->table('mst_kerja')->orderBy('kode','asc')->get();
         $gelar = DB::connection('pgsql')->table('mst_gelar')->orderBy('kode','asc')->orderBy('kode','asc')->get();
        $negara = DB::connection('pgsql')->table('mst_negara')->orderBy('kode','asc')->get();
        $hubbank = DB::connection('pgsql')->table('mst_lapor')->orderBy('kode','asc')->get();
        $sumber = DB::connection('pgsql')->table('mst_sumber')->orderBy('kode','asc')->get();
        $jabatan = DB::connection('pgsql')->table('mst_jabatan')->orderBy('kode','asc')->get();
        

        return view('nuk.viewkoreksinuk',compact('daftar','biaya','kendaraan','sertifikat','jamin','dataangsuran','datanasabah','tgk','totaldenda','tgkangsur','totaltunggak','bayarangsuran','jadwal','kartu','bayar','data','lapkeuang','pengurus','prekredit','agkredit','kodya','segfas','goldeb','kelurahan','kecamatan','jenisfas','lembaga','ikat','dati2','status','jenisagun','kerja','gelar','negara','hubbank','sumber','jabatan'));
    }

    public function saveKoreksinuk(Request $request,$nokredit)
    {
        //  if(count($request->input('input_nom_id_penjamin')) > 0){
        //     for($i=0;$i<count($request->input('input_nom_id_penjamin'));$i++){
        //         // if(($request->input('input_nom_id_penjamin')[$i] <> null) || ($request->input('input_nom_id_penjamin')[$i] <> '')){
        //             DB::connection('pgsql') ->table('penjamin')->where('no_nsb',$nonsb)->update([
        //                 'no_nsb'            => ($nonsb),
        //                 'nom_id_penjamin'   => ($request->input('input_nom_id_penjamin')[$i]),
        //                 'segfas'            => ($request->input('input_kode_segFas')[$i]),
        //                 'idpenjamin'        => ($request->input('input_kode_jns_idPenjamin')[$i]),
        //                 'nm_penjamin'       => ($request->input('input_nm_penjamin')[$i]),
        //                 'nm_lengkap'        => ($request->input('input_nm_lengkap')[$i]),
        //                 'goldeb'            => ($request->input('input_kode_gol_Penjamin')[$i]),
        //                 'alamat'            => ($request->input('input_alamat')[$i]),
        //                 'kodepos'           => ($request->input('input_kodepos')[$i]),
        //                 'kelurahan'         => ($request->input('input_kelurahan')[$i]),
        //                 'kecamatan'         => ($request->input('input_kecamatan')[$i]),
        //                 'present_dijamin'   => ($request->input('input_persent_dijamin')[$i]),
        //                 'ket'               => ($request->input('input_ket')[$i]),
        //                 'kodya'             => ($request->input('input_kodya')[$i])
        //             ]);
        //         }
        //     // }
        // }
        if(count($request->input('input_jenis_kendaraan_k')) > 0){
            for($i=0;$i<count($request->input('input_jenis_kendaraan_k'));$i++){
                if(($request->input('input_merk_kend_k')[$i] <> null) || ($request->input('input_merk_kend_k')[$i] <> '')){
                DB::connection('pgsql')->table('agunan_kend_nuk')->where('no_agunan',$request->input('input_nomor_k')[$i])->update([
                'no_nsb'     => ($request->input('no_nsb')[$i]),
                'status'     => ($request->input('status_k')[$i]),
                'jenis'      => ($request->input('input_agunan1_k')[$i]),    
                'jenisken'   => ($request->input('input_jenis_kendaraan_k')[$i]),
                'pemilik'    => (strtoupper($request->input('input_nama_pemilik_kend_k')[$i])),
                'alamat'     => (strtoupper($request->input('input_alamat_pemilik_kend_k')[$i])),
                'kodya'      => (strtoupper($request->input('input_kodya_nasabah_k')[$i])),
                'merktype'   => (strtoupper($request->input('input_merk_kend_k')[$i])),
                'tahun'      => ($request->input('input_tahun_kend_k')[$i]),
                // 'jenisfas'   => ($request->input('input_kode_jns_segFas_k')[$i]),
                'kd_status'  => ($request->input('input_kode_stat_agunan_k')[$i]),
                'jenisagun'  => ($request->input('input_kode_jns_agunan_k')[$i]),
                // 'peringkat'  => ($request->input('input_peringkat_agunan_k')[$i]),
                // 'lembaga'    => ($request->input('input_kode_lembaga_pemeringkat_k')[$i]),
                'ikat'       => ($request->input('input_kode_jns_pengikatan_k')[$i]),
                'tgl_ikat'   => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_k')[$i]))),
                'bukti'      => ($request->input('input_no_bpkb_k')[$i]),
                // 'ljk'        => (DataController::formatangka($request->input('input_nilai_agunanLJK_k')[$i])),
                // 'tgl_nilai'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_k')[$i]))),
                // 'indep'      => (DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_k')[$i])),
                // 'namaindep'  => ($request->input('input_nm_penilai_k')[$i]),
                // 'tgl_indep'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_k')[$i]))),
                'paripasu'   => ($request->input('input_status_paripasu_k')[$i]),
                'persen'     => ($request->input('input_persent_paripasu_k')[$i]),
                'asuransi'   => ($request->input('input_diasuransikan_k')[$i]),
                's_join'     => ($request->input('input_join_k')[$i]),
                'warna'      => (strtoupper($request->input('input_warna_kend_k')[$i])),
                'nopolisi'   => (strtoupper($request->input('input_no_polisi_k')[$i])),
                'nobpkb'     => (strtoupper($request->input('input_no_bpkb_k')[$i])),
                'norangka'   => (strtoupper($request->input('input_no_rangka_k')[$i])),
                'nomesin'    => (strtoupper($request->input('input_no_mesin_k')[$i])),
                'nilai'      => (DataController::formatangka($request->input('input_nilai_kendaraan_k')[$i])),
                'dealer'     => (strtoupper($request->input('input_dealer_kend_k')[$i])),
                'nostnk'     => (strtoupper($request->input('input_no_stnk_k')[$i])),
                'berlaku'    => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_berlaku_stnk_k')[$i]))),
                'nilpasar'   => (DataController::formatangka($request->input('input_nilai_pasar_ken_k')[$i])),
                'niltaksasi' => (DataController::formatangka($request->input('input_nilai_taksasi_ken_k')[$i])),
                'nilnjop'    => (DataController::formatangka($request->input('input_nilai_taksasi_ken_k')[$i])),
                'ket'        => (strtoupper($request->input('input_fungsi_k')[$i])),
                'opr'        => ($request->input('opr')[$i])
                ]);
                } 
            }                                               
        }

        // if(count($request->input('input_jenis_kendaraan_k')) > 0){
        //     for($i=0;$i<count($request->input('input_jenis_kendaraan_k'));$i++){
        //         if(($request->input('input_merk_kend_k')[$i] <> null) || ($request->input('input_merk_kend_k')[$i] <> '')){
        //         DB::connection('pgsql')->table('agunan_kredit')->where('no_agunan',$request->input('input_nomor_k')[$i])->update([
        //          'no_nsb'     => ($request->input('no_nsb')[$i]),
        //         'status'     => ($request->input('status_k')[$i]),
        //         'jenis'      => ($request->input('input_agunan1_k')[$i]),    
        //         'jenisken'   => ($request->input('input_jenis_kendaraan_k')[$i]),
        //         'pemilik'    => (strtoupper($request->input('input_nama_pemilik_kend_k')[$i])),
        //         'alamat'     => (strtoupper($request->input('input_alamat_pemilik_kend_k')[$i])),
        //         'kodya'      => (strtoupper($request->input('input_kodya_nasabah_k')[$i])),
        //         'merktype'   => (strtoupper($request->input('input_merk_kend_k')[$i])),
        //         'tahun'      => ($request->input('input_tahun_kend_k')[$i]),
        //         'jenisfas'   => ($request->input('input_kode_jns_segFas_k')[$i]),
        //         'kd_status'  => ($request->input('input_kode_stat_agunan_k')[$i]),
        //         'jenisagun'  => ($request->input('input_kode_jns_agunan_k')[$i]),
        //         'peringkat'  => ($request->input('input_peringkat_agunan_k')[$i]),
        //         'lembaga'    => ($request->input('input_kode_lembaga_pemeringkat_k')[$i]),
        //         'ikat'       => ($request->input('input_kode_jns_pengikatan_k')[$i]),
        //         'tgl_ikat'   => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_k')[$i]))),
        //         'bukti'      => ($request->input('input_no_bpkb_k')[$i]),
        //         'ljk'        => (DataController::formatangka($request->input('input_nilai_agunanLJK_k')[$i])),
        //         'tgl_nilai'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_k')[$i]))),
        //         'indep'      => (DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_k')[$i])),
        //         'namaindep'  => ($request->input('input_nm_penilai_k')[$i]),
        //         'tgl_indep'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_k')[$i]))),
        //         'paripasu'   => ($request->input('input_status_paripasu_k')[$i]),
        //         'persen'     => ($request->input('input_persent_paripasu_k')[$i]),
        //         'asuransi'   => ($request->input('input_diasuransikan_k')[$i]),
        //         's_join'     => ($request->input('input_join_k')[$i]),
        //         'warna'      => (strtoupper($request->input('input_warna_kend_k')[$i])),
        //         'nopolisi'   => (strtoupper($request->input('input_no_polisi_k')[$i])),
        //         'nobpkb'     => (strtoupper($request->input('input_no_bpkb_k')[$i])),
        //         'norangka'   => (strtoupper($request->input('input_no_rangka_k')[$i])),
        //         'nomesin'    => (strtoupper($request->input('input_no_mesin_k')[$i])),
        //         'nilai'      => (DataController::formatangka($request->input('input_nilai_kendaraan_k')[$i])),
        //         'dealer'     => (strtoupper($request->input('input_dealer_kend_k')[$i])),
        //         'nostnk'     => (strtoupper($request->input('input_no_stnk_k')[$i])),
        //         'berlaku'    => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_berlaku_stnk_k')[$i]))),
        //         'nilpasar'   => (DataController::formatangka($request->input('input_nilai_pasar_ken_k')[$i])),
        //         'niltaksasi' => (DataController::formatangka($request->input('input_nilai_taksasi_ken_k')[$i])),
        //         'nilnjop'    => (DataController::formatangka($request->input('input_nilai_taksasi_ken_k')[$i])),
        //         'ket'        => (strtoupper($request->input('input_fungsi_k')[$i])),
        //         'opr'        => ($request->input('opr')[$i])
        //         ]);
        //          }      
        //     }
        // }   

        if(count($request->input('input_no_sertifikat_s')) > 0){
            for($i=0;$i<count($request->input('input_no_sertifikat_s'));$i++){
                if(($request->input('input_no_sertifikat_s')[$i] <> null) || ($request->input('input_no_sertifikat_s')[$i] <> '')){
                    DB::connection('pgsql')->table('agunan_sert_nuk')->where('no_agunan',$request->input('input_nomor_s')[$i])->update([
                    'no_nsb'     => ($request->input('no_nsb')[$i]),
                    'status'     => ($request->input('status_s')[$i]),
                    'jenis'      => ($request->input('input_agunan1_s')[$i]), 
                    'nosertif'   => ($request->input('input_no_sertifikat_s')[$i]),
                    'kodya'      => ($request->input('input_kodya_nasabah_s')[$i]),
                    'lokkodya'   => (strtoupper($request->input('input_lokasi_sert_s')[$i])),
                    'sertstatus' => ($request->input('input_jenis_sertifikat_s')[$i]),
                    // 'jenisfas'   => ($request->input('input_kode_jns_segFas_s')[$i]),
                    'kd_status'  => ($request->input('input_kode_stat_agunan_s')[$i]),
                    'jenisagun'  => ($request->input('input_kode_jns_agunan_s')[$i]),
                    // 'peringkat'  => ($request->input('input_peringkat_agunan_s')[$i]),
                    // 'lembaga'    => ($request->input('input_kode_lembaga_pemeringkat_s')[$i]),
                    'ikat'       => ($request->input('input_kode_jns_pengikatan_s')[$i]),
                    'tgl_ikat'   => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_s')[$i]))),
                    'bukti'      => ($request->input('input_no_sertifikat_s')[$i]),
                    // 'ljk'        => (DataController::formatangka($request->input('input_nilai_agunanLJK_s')[$i])),
                    // 'tgl_nilai'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_s')[$i]))),
                    // 'indep'      => (DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_s')[$i])),
                    // 'namaindep'  => ($request->input('input_nm_penilai_s')[$i]),
                    // 'tgl_indep'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_s')[$i]))),
                    'paripasu'   => ($request->input('input_status_paripasu_s')[$i]),
                    'persen'     => ($request->input('input_persent_paripasu_s')[$i]),
                    'asuransi'   => ($request->input('input_diasuransikan_s')[$i]),
                    's_join'     => ($request->input('input_join_s')[$i]),
                    'pemilik'    => (strtoupper($request->input('input_nama_pemilik_sert_s')[$i])),
                    'alamat'     => (strtoupper($request->input('input_alamat_pemilik_sert_s')[$i])),
                    'nilpasar'   => (DataController::formatangka($request->input('input_nilai_pasar_sert_s')[$i])),
                    'niltaksasi' => (DataController::formatangka($request->input('input_nilai_taksasi_sert_s')[$i])),
                    'nilnjop'    => (DataController::formatangka($request->input('input_nilai_njop_sert_s')[$i])),
                    'nilhaktg'   => (DataController::formatangka($request->input('input_nilai_ht_sert_s')[$i])),
                    'lokasi'     => (strtoupper($request->input('input_lokasi_sert_s')[$i])),
                    'luastanah'  => ($request->input('input_luas_tanah_s')[$i]),
                    'luasbangunan'   => ($request->input('input_luas_bangunan_s')[$i]),
                    'sfkt_ket'   => (strtoupper($request->input('input_keterangan_sert_s')[$i])),
                    'opr'        => ($request->input('opr')[$i])
                    ]);
                 }      
            }
        }   

        // if(count($request->input('input_no_sertifikat_s')) > 0){
        //     for($i=0;$i<count($request->input('input_no_sertifikat_s'));$i++){
        //         if(($request->input('input_no_sertifikat_s')[$i] <> null) || ($request->input('input_no_sertifikat_s')[$i] <> '')){
        //             DB::connection('pgsql')->table('agunan_kredit')->where('no_agunan',$request->input('input_nomor_s')[$i])->update([
        //             'no_nsb'     => ($request->input('no_nsb')[$i]),
        //             'status'     => ($request->input('status_s')[$i]),
        //             'jenis'      => ($request->input('input_agunan1_s')[$i]), 
        //             'nosertif'   => ($request->input('input_no_sertifikat_s')[$i]),
        //             'kodya'      => ($request->input('input_kodya_nasabah_s')[$i]),
        //             'lokkodya'   => (strtoupper($request->input('input_lokasi_sert_s')[$i])),
        //             'sertstatus' => ($request->input('input_jenis_sertifikat_s')[$i]),
        //             'jenisfas'   => ($request->input('input_kode_jns_segFas_s')[$i]),
        //             'kd_status'  => ($request->input('input_kode_stat_agunan_s')[$i]),
        //             'jenisagun'  => ($request->input('input_kode_jns_agunan_s')[$i]),
        //             'peringkat'  => ($request->input('input_peringkat_agunan_s')[$i]),
        //             'lembaga'    => ($request->input('input_kode_lembaga_pemeringkat_s')[$i]),
        //             'ikat'       => ($request->input('input_kode_jns_pengikatan_s')[$i]),
        //             'tgl_ikat'   => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_pengikatan_s')[$i]))),
        //             'bukti'      => ($request->input('input_no_sertifikat_s')[$i]),
        //             'ljk'        => (DataController::formatangka($request->input('input_nilai_agunanLJK_s')[$i])),
        //             'tgl_nilai'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaianLJK_s')[$i]))),
        //             'indep'      => (DataController::formatangka($request->input('nilai_agunan_penilaiIndependent_s')[$i])),
        //             'namaindep'  => ($request->input('input_nm_penilai_s')[$i]),
        //             'tgl_indep'  => (date('Y-m-d H:i:s',strtotime($request->input('input_tgl_penilaian_s')[$i]))),
        //             'paripasu'   => ($request->input('input_status_paripasu_s')[$i]),
        //             'persen'     => ($request->input('input_persent_paripasu_s')[$i]),
        //             'asuransi'   => ($request->input('input_diasuransikan_s')[$i]),
        //             's_join'     => ($request->input('input_join_s')[$i]),
        //             'pemilik'    => (strtoupper($request->input('input_nama_pemilik_sert_s')[$i])),
        //             'alamat'     => (strtoupper($request->input('input_alamat_pemilik_sert_s')[$i])),
        //             'nilpasar'   => (DataController::formatangka($request->input('input_nilai_pasar_sert_s')[$i])),
        //             'niltaksasi' => (DataController::formatangka($request->input('input_nilai_taksasi_sert_s')[$i])),
        //             'nilnjop'    => (DataController::formatangka($request->input('input_nilai_njop_sert_s')[$i])),
        //             'nilhaktg'   => (DataController::formatangka($request->input('input_nilai_ht_sert_s')[$i])),
        //             'lokasi'     => (strtoupper($request->input('input_lokasi_sert_s')[$i])),
        //             'luastanah'  => ($request->input('input_luas_tanah_s')[$i]),
        //             'luasbangunan'   => ($request->input('input_luas_bangunan_s')[$i]),
        //             'sfkt_ket'   => (strtoupper($request->input('input_keterangan_sert_s')[$i])),
        //             'opr'        => ($request->input('opr')[$i])
        //             ]);
        //          }      
        //     }
        // }   
                                       

        return redirect('/koreksidatanuk');
    }
    
          
}