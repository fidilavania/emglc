<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
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
use Input;
//use App\Agunan;
use App\Http\Controllers\Controller;

class ValidController extends Controller
{
     public function viewbmpk($nokredit)
    {  
        $prekredit = prekredit_nuk::where('no_kredit',$nokredit)->first();
        $kredit = kredit_nuk::where('no_kredit',$nokredit)->first();
        $kode_kantor = refkodekantor::all();
        // $totalsaldo  = DB::connection('pgsql')->select(DB::raw("SELECT MIN(bakidebet) as bakidebet from angsuran_kartu where no_kredit in (SELECT no_kredit from kredit where tgl_lunas::text LIKE '1900-01-01%' AND no_kredit IN (SELECT no_kredit FROM prekredit WHERE no_nsb='".$nokredit."')) GROUP BY no_kredit")); 
        // $totalpokok = 0;
        // foreach ($totalsaldo as $t) {
        //     $totalpokok += $t->bakidebet;
        // }

        return view('validasi.bmpk',compact('prekredit','kredit','totalpokok','kode_kantor'));   
    }

    public function savevalidasi (Request $request,$nokredit)
    {

    	$kredit_nuk = kredit_nuk::where('no_kredit',$request->input('no_kredit'))->first();
    	$prekredit_nuk = prekredit_nuk::where('no_kredit',$request->input('no_kredit'))->first();
    	$agunan_sert_nuk = agunan_sert_nuk::where('no_kredit',$request->input('no_kredit'))->first();
    	$agunan_kend_nuk = agunan_kend_nuk::where('no_kredit',$request->input('no_kredit'))->first();
    	$biaya_nuk = kredit_biaya_nuk::where('no_kredit',$request->input('no_kredit'))->first();
    	$ta_nuk = angsuran_jadwal_nuk::where('no_kredit',$request->input('no_kredit'))->first();

    	//untuk buat nomor npp 
    	$kode_kantor =refkodekantor::where('kode_angka')->first();
    	$kredit = Kredit::where('no_kredit',$nokredit)->get();

        $status = refkodekantor::where('kode_angka', $kredit_nuk->kode_kantor)->firstOrFail()->status;
        //echo "status = " . $status;
             if ($status == "PUSAT"){
                 $last = Kredit::where('no_nsb',$prekredit_nuk->no_nsb)->pluck('no_ref')->first();
                 $npp = substr($last,10,7).'/NPP'.'/'.$agunan_sert_nuk->jenis.'/'.DataController::romanNumerals(date('m')).'/'.date('y');
        }
        else 
            if ($status == "POS"){
                $npp = str_pad(((int)Kredit::max('no_ref')+1),7,'0',STR_PAD_LEFT).'-'.$status.'/NPP'.'/'.$agunan_sert_nuk->jenis.'/'.DataController::romanNumerals(date('m')).'/'.date('y');
        }else 
            if ($status == "CABANG"){
                $npp = str_pad(((int)Kredit::max('no_ref')+1),7,'0',STR_PAD_LEFT).'-'.$status.'/NPP'.'/'.$agunan_sert_nuk->jenis.'/'.DataController::romanNumerals(date('m')).'/'.date('y');
            }   
        // Log::info($npp);


        DB::connection('pgsql')->table('kredit_nuk')->where('no_kredit',$request->input('no_kredit'))->update([
            'no_kredit'         => ($request->input('no_kredit')),
            'validasi'          => ($request->input('opr'))
        ]);

        if($request->input('fungsi') == '1111'){

	        $prekredit = new Prekredit;
	        $prekredit->no_mohon = str_pad(((int) Prekredit::max('no_mohon') + 1),10,'0',STR_PAD_LEFT);
	        $prekredit->no_kredit = $kredit_nuk->npk;
	        $prekredit->tgl_mohon = date('Y-m-d 00:00:00',strtotime($request->input('input_pakai')));
	        $prekredit->no_nsb = $prekredit_nuk->no_nsb;
	        $prekredit->no_cif = $prekredit_nuk->no_cif;
	        $prekredit->nama = $prekredit_nuk->nama;
	        $prekredit->kelamin = $prekredit_nuk->kelamin ;
	        $prekredit->tmplahir = $prekredit_nuk->tmplahir ;
	        $prekredit->tgllahir = $prekredit_nuk->tgllahir ;
	        $prekredit->alamat = $prekredit_nuk->alamat ;
	        $prekredit->notelp = $prekredit_nuk->notelp ;
	        $prekredit->nohp = $prekredit_nuk->nohp ;
	        $prekredit->rtrw = $prekredit_nuk->rtrw ;
	        $prekredit->desa = $prekredit_nuk->desa ;
	        $prekredit->camat = $prekredit_nuk->camat ;
	        $prekredit->kodya = $prekredit_nuk->kodya ;
	        $prekredit->noktp = $prekredit_nuk->noktp ;
	        $prekredit->agama = $prekredit_nuk->agama ;
	        $prekredit->pekerjaan = $prekredit_nuk->pekerjaan ;
	        $prekredit->usaha = $prekredit_nuk->usaha ;
	        $prekredit->nobadan = $prekredit_nuk->nobadan;
	        $prekredit->jenisbadan = $prekredit_nuk->jenisbadan;
	        $prekredit->tempatberdiri = $prekredit_nuk->tempatberdiri;
	        $prekredit->noakta = $prekredit_nuk->noakta;
	        $prekredit->tglakta = $prekredit_nuk->tglakta;
	        $prekredit->opr = ($request->input('nama_opr'));
	        $prekredit->kode_kantor = $prekredit_nuk->kode_kantor;
	        $prekredit->jenkend = $prekredit_nuk->jenkend;
	        $prekredit->save();
	              
        	$kredit = new Kredit;
	        $kredit->namaao =$kredit_nuk->namaao;
	        $kredit->no_nsb =$kredit_nuk->no_nsb;
	        $kredit->no_kredit = $kredit_nuk->npk;
	        $kredit->ke = $kredit_nuk->ke;
	        $kredit->no_ref =  $npp;
	        $kredit->sifatkrd =$kredit_nuk->sifatkrd;
	        $kredit->jns_krd =$kredit_nuk->jns_krd;
	        $kredit->skim =$kredit_nuk->skim;       
	        $kredit->no_mohon = $prekredit->no_mohon;
	        $kredit->no_akad = $kredit_nuk->no_akad;
	        $kredit->tgl_mhn = date('Y-m-d 00:00:00',strtotime($request->input('input_pakai')));
	        $kredit->no_mohon_akhir = $kredit_nuk->no_mohon_akhir; 
	        $kredit->tgl_mohon_akhir = $kredit_nuk->tgl_mohon_akhir;
	        $kredit->lama =$kredit_nuk->lama;
	        $kredit->tgl_kredit = date('Y-m-d 00:00:00',strtotime($request->input('input_pakai')));
	        $kredit->tgl_mulai = $kredit_nuk->tgl_mulai;
	        $kredit->tgl_akhir = $kredit_nuk->tgl_akhir;
	        $kredit->jatuhtempo =$kredit_nuk->jatuhtempo;
	        $kredit->goldeb = $kredit_nuk->goldeb;
	        $kredit->jnsbiaya =$kredit_nuk->jnsbiaya;
	        $kredit->ori =$kredit_nuk->ori;
	        $kredit->eko =$kredit_nuk->eko;
	        $kredit->dati2 =$kredit_nuk->dati2;
	        $kredit->valuta =$kredit_nuk->valuta;
	        $kredit->jenisbunga =$kredit_nuk->jenisbunga;
	        $kredit->kreditpp =$kredit_nuk->kreditpp;
	        $kredit->sumber =$kredit_nuk->sumber;
	        $kredit->kolek =$kredit_nuk->kolek;
	        $kredit->tgl_macet =$kredit_nuk->tgl_macet;
	        $kredit->sebabmacet =$kredit_nuk->sebabmacet;
	        $kredit->tgl_nunggak =$kredit_nuk->tgl_nunggak;
	        $kredit->frektunggak =$kredit_nuk->frektunggak;
	        $kredit->frekres =$kredit_nuk->frekres;
	        $kredit->tgl_resawal =$kredit_nuk->tgl_resawal;
	        $kredit->tgl_resakhir =$kredit_nuk->tgl_resakhir;
	        $kredit->res =$kredit_nuk->res;
	        $kredit->kondisi =$kredit_nuk->kondisi;
	        $kredit->tgl_kondisi =$kredit_nuk->tgl_kondisi;
	        $kredit->to =$kredit_nuk->to;
	        $kredit->ket =$kredit_nuk->ket;
	        $kredit->kode_kantor =$kredit_nuk->kode_kantor;

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
	            $kredit->pinj_prsbunga = $request->input('input_bunga')*12;
	        }else{
	            $kredit->pinj_prsbunga = $request->input('input_bunga');
	        }

	        // $kredit->arav =$kredit_nuk->arav;
	        // $kredit->sistem =$kredit_nuk->sistem;
	        // $kredit->nilaiproyek =$kredit_nuk->nilaiproyek;
	        // $kredit->dp =$kredit_nuk->dp;
	        // $kredit->plafon =$kredit_nuk->plafon;
	        // $kredit->bakidebet =$kredit_nuk->bakidebet;
	        // $kredit->pinj_pokok =$kredit_nuk->pinj_pokok;
	        // $kredit->jangka =$kredit_nuk->jangka;
	        // $kredit->bbt =$kredit_nuk->bbt;
	        // $kredit->saldo_bbt =$kredit_nuk->saldo_bbt;
	        // $kredit->saldo_piutang =$kredit_nuk->saldo_piutang;
	        // $kredit->angsur_pokok =$kredit_nuk->angsur_pokok;
	        // $kredit->angsur_bunga =$kredit_nuk->angsur_bunga;
	        // $kredit->opr =($request->input('nama_opr'));
	        // $kredit->pinj_prsbunga =$kredit_nuk->pinj_prsbunga;

	        $kredit->save();

	        if(isset($agunan_sert_nuk->nosertif)){ 
		        if(count($agunan_sert_nuk->nosertif) > 0){
		            $nextno =(int) AgunanSertifikat::max('no_agunan') + 1;
		            for($i=0;$i<count($agunan_sert_nuk->nosertif);$i++){
		                if(($agunan_sert_nuk->nosertif[$i] <> null) || ($agunan_sert_nuk->nosertif[$i] <> '')){
		                    $agunansert = new AgunanSertifikat;
		                    // $agunansert->status =('         ')[$i]; 
		                    $agunansert->jenis = $agunan_sert_nuk->jenis[$i]; 
		                    $agunansert->no_nsb = $agunan_sert_nuk->no_nsb; 
		                    $agunansert->no_kredit= $kredit_nuk->npk;
		                 	$agunansert->nosertif = $agunan_sert_nuk->nosertif[$i];
		                    $agunansert->kodya = $agunan_sert_nuk->kodya[$i];
		                    $agunansert->lokkodya = strtoupper($agunan_sert_nuk->lokkodya[$i]);
		                    $agunansert->sertstatus = $agunan_sert_nuk->sertstatus[$i];
		                    // $agunansert->jenisfas = $agunan_sert_nuk->jenisfas[$i];
		                    $agunansert->kd_status = $agunan_sert_nuk->kd_status[$i];
		                    $agunansert->jenisagun = $agunan_sert_nuk->jenisagun[$i];
		                    // $agunansert->peringkat = $agunan_sert_nuk->peringkat[$i];
		                    // $agunansert->lembaga = $agunan_sert_nuk->lembaga[$i];
		                    $agunansert->ikat = $agunan_sert_nuk->ikat[$i];
		                    $agunansert->tgl_ikat = date('Y-m-d H:i:s',strtotime($agunan_sert_nuk->tgl_ikat[$i]));
		                    $agunansert->bukti = $agunan_sert_nuk->bukti[$i];
		                    // $agunansert->ljk = DataController::formatangka($agunan_sert_nuk->ljk[$i]);
		                    // $agunansert->tgl_nilai = date('Y-m-d H:i:s',strtotime($agunan_sert_nuk->tgl_nilai[$i]));
		                    // $agunansert->indep = DataController::formatangka($agunan_sert_nuk->indep[$i]);
		                    // $agunansert->namaindep = $agunan_sert_nuk->namaindep[$i];
		                    // $agunansert->tgl_indep = date('Y-m-d H:i:s',strtotime($agunan_sert_nuk->tgl_indep[$i]));
		                    $agunansert->paripasu = $agunan_sert_nuk->paripasu[$i];
		                    $agunansert->persen = $agunan_sert_nuk->persen[$i];
		                    $agunansert->asuransi = $agunan_sert_nuk->asuransi[$i];
		                    $agunansert->s_join = $agunan_sert_nuk->s_join[$i];
		                    $agunansert->pemilik = strtoupper($agunan_sert_nuk->pemilik[$i]);
		                    $agunansert->alamat = strtoupper($agunan_sert_nuk->alamat[$i]);
		                    $agunansert->no_agunan = str_pad($nextno,5,'0',STR_PAD_LEFT);
		                    $agunansert->no_mohon = $prekredit->no_mohon;
		                    $agunansert->nilpasar = DataController::formatangka($agunan_sert_nuk->nilpasar[$i]);
		                    $agunansert->niltaksasi = DataController::formatangka($agunan_sert_nuk->niltaksasi[$i]);
		                    $agunansert->nilnjop = DataController::formatangka($agunan_sert_nuk->nilnjop[$i]);
		                    $agunansert->nilhaktg = DataController::formatangka($agunan_sert_nuk->nilhaktg[$i]);
		                    $agunansert->lokasi = strtoupper($agunan_sert_nuk->lokasi[$i]);
		                    $agunansert->luastanah = $agunan_sert_nuk->luastanah[$i];
		                    $agunansert->luasbangunan = $agunan_sert_nuk->luasbangunan[$i];
		                    $agunansert->sfkt_ket = strtoupper($agunan_sert_nuk->sfkt_ket[$i]);
		                    $agunansert->kode_kantor = substr($kredit_nuk->npk,7,2);
		                    $agunansert->tgl_pakai = date('Y-m-d H:i:s',strtotime($agunan_sert_nuk->tgl_pakai));
		                    // $agunansert->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')[$i]));
		                    $agunansert->opr = $request->input('opr');
		                    $agunansert->save();
		                    $nextno = (int) $agunansert->no_agunan + 1;
		                }
		            }
		        }
		    }else{   
		        if(count($agunan_kend_nuk->jenisken) > 0){
		            $nextno =(int) AgunanKendaraan::max('no_agunan') + 1;
		            for($i=0;$i<count($agunan_kend_nuk->jenisken);$i++){
		                if(($agunan_kend_nuk->merktype[$i] <> null) || ($agunan_kend_nuk->merktype[$i] <> '')){
		                    $agunankend = new AgunanKendaraan;  
		                    // $agunankend->status = ('         ')[$i]; 
		                    $agunankend->jenis = $agunan_kend_nuk->jenis[$i];        
		                    //     $agun = $agunan_kend_nuk->.'-'.str_pad(((int) agunan::max('no_agunan')+1),6,'0',STR_PAD_LEFT);
		                    // $agunankend->no_agunan = $agun;
		                    $agunankend->no_agunan = str_pad($nextno,5,'0',STR_PAD_LEFT);
		                    $agunankend->no_nsb = $agunan_kend_nuk ->no_nsb;
		                    // $agunankend->no_cif =$nasabah->no_cif;
		                $agunankend->no_mohon = $prekredit->no_mohon;
		                    $agunankend->no_kredit = $kredit_nuk->npk;
		                    // $agunankend->kode_kantor=$kredit->kode_kantor;   
		                    $agunankend->jenisken = $agunan_kend_nuk->jenisken[$i];
		                    $agunankend->pemilik = strtoupper($agunan_kend_nuk->pemilik[$i]);
		                    $agunankend->alamat = strtoupper($agunan_kend_nuk->alamat[$i]);
		                    $agunankend->kodya = strtoupper($agunan_kend_nuk->kodya[$i]);
		                    $agunankend->merktype = strtoupper($agunan_kend_nuk->merktype[$i]);
		                    $agunankend->tahun = $agunan_kend_nuk->tahun[$i];
		                    // $agunankend->jenisfas = $agunan_kend_nuk->jenisfas[$i];
		                    $agunankend->kd_status = $agunan_kend_nuk->kd_status[$i];
		                    // $agunankend->statusken = $agunan_kend_nuk->statusken[$i];
		                    $agunankend->jenisagun = $agunan_kend_nuk->jenisagun[$i];
		                    // $agunankend->peringkat = $agunan_kend_nuk->peringkat[$i];
		                    // $agunankend->lembaga = $agunan_kend_nuk->lembaga[$i];
		                    $agunankend->ikat = $agunan_kend_nuk->ikat[$i];
		                    $agunankend->tgl_ikat = date('Y-m-d H:i:s',strtotime($agunan_kend_nuk->tgl_ikat[$i]));
		                    $agunankend->bukti = $agunan_kend_nuk->bukti[$i];
		                    // $agunankend->ljk = DataController::formatangka($agunan_kend_nuk->ljk[$i]);
		                    // $agunankend->tgl_nilai = date('Y-m-d H:i:s',strtotime($agunan_kend_nuk->tgl_nilai[$i]));
		                    // $agunankend->indep = DataController::formatangka($agunan_kend_nuk->indep[$i]);
		                    // $agunankend->namaindep = $agunan_kend_nuk->namaindep[$i];
		                    // $agunankend->tgl_indep = date('Y-m-d H:i:s',strtotime($agunan_kend_nuk->tgl_indep[$i]));
		                    $agunankend->paripasu = $agunan_kend_nuk->paripasu[$i];
		                    $agunankend->persen = $agunan_kend_nuk->persen[$i];
		                    $agunankend->asuransi = $agunan_kend_nuk->asuransi[$i];
		                    $agunankend->s_join = $agunan_kend_nuk->s_join[$i];
		                    $agunankend->warna = strtoupper($agunan_kend_nuk->warna[$i]);
		                    $agunankend->nopolisi = strtoupper($agunan_kend_nuk->nopolisi[$i]);
		                    $agunankend->nobpkb = strtoupper($agunan_kend_nuk->nobpkb[$i]);
		                    $agunankend->norangka = strtoupper($agunan_kend_nuk->norangka[$i]);
		                    $agunankend->nomesin = strtoupper($agunan_kend_nuk->nomesin[$i]);
		                    $agunankend->nilai = DataController::formatangka($agunan_kend_nuk->nilai[$i]);
		                    // $agunankend->camat = strtoupper($agunan_kend_nuk->[$i]);
		                    $agunankend->dealer = strtoupper($agunan_kend_nuk->dealer[$i]);
		                    $agunankend->nostnk = strtoupper($agunan_kend_nuk->nostnk[$i]);
		                    $agunankend->berlaku = date('Y-m-d H:i:s',strtotime($agunan_kend_nuk->berlaku[$i]));
		                    // $agunankend->kelompok = strtoupper($agunan_kend_nuk->[$i]);
		                    $agunankend->nilpasar = DataController::formatangka($agunan_kend_nuk->nilpasar[$i]);
		                    $agunankend->niltaksasi = DataController::formatangka($agunan_kend_nuk->niltaksasi[$i]);
		                    $agunankend->kode_kantor = substr($kredit_nuk->npk,7,2);
		                    $agunankend->nilnjop = $agunan_kend_nuk->niltaksasi;
		                    $agunankend->tgl_pakai = date('Y-m-d H:i:s',strtotime($agunan_kend_nuk->tgl_pakai));
		                    // $agunankend->tgl_pakai = date('Y-m-d H:i:s',strtotime($agunan_kend_nuk->[$i]));
		                    $agunankend->ket = strtoupper($agunan_kend_nuk->ket[$i]);
		                    $agunankend->opr = $request->input('opr');
		                    $agunankend->save();
		                    $nextno = (int) $agunankend->no_agunan + 1;
		                }
		            }
		        }
		    }

	     //    $arrbiaya = array('adm','provisi','notaris','polis','ass','assjiwa','feemitra','lain');
	     //    $nextno = (int) DafKreditBiaya::max('id') + 1;
	     //    $jmlbiaya = 0;
	     //    for($i=0;$i<count($arrbiaya);$i++){
	     //        if(DataController::formatangka($biaya_nuk->jml) >= 0){
	     //            $biaya = new DafKreditBiaya;
	     //            $biaya->id = $nextno;
	     //            $biaya->no_kredit = $kredit_nuk->npk;
	     //            $biaya->biaya = $arrbiaya[$i];
	     //            $biaya->jml = DataController::formatangka($biaya_nuk->jml);
	     //            $biaya->bayar = $biaya_nuk->bayar;
	     //            $biaya->save();
	     //            $nextno = (int) $biaya->id + 1;
	     //        }   
	     //    }

		    // if($kredit_nuk->sistem != "TARIKSETOR"){
		    //     for($i=0;$i<count($ta_nuk->no_kredit);$i++){
	     //           	$ta = new AngsJadwal;
	     //            $ta->no_kredit = $kredit_nuk->npk[$i];
	     //            $ta->bayar_ke = $ta_nuk->bayar_ke[$i];
	     //            $ta->angsur = $ta_nuk->angsur[$i];
	     //            $ta->angs_pokok = $ta_nuk->angs_pokok[$i];
	     //            $ta->angs_bunga = $kredit->angsur_bunga[$i];
	     //            $ta->sal_bbt = $ta_nuk->sal_bbt [$i];
	     //            $ta->sal_piutang = $ta_nuk->sal_piutang[$i];
	     //            $ta->haribunga =  $ta_nuk->haribunga[$i];
	     //            $ta->sal_pokok = $ta_nuk->sal_pokok[$i];
	     //            $ta->tgl_angsur = date('Y-m-d',strtotime($ta_nuk->tgl_angsur)[$i]);
	     //            $ta->save();
	     //        }
	     //    }
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

        }


        // return redirect('/cetakjadwal/'.$nokredit);
        return redirect('/koreksidatanuk');
    }

    public function viewlapnuk()
    {  
         // WHERE kredit_nuk.tgl_kredit >= '".ymd($tgl)."' AND kredit_nuk.tgl_kredit <= '".ymd($tgl2)."') ".$limit_max." ".$sis." ".$nsb_ktr." ".$carinama." 

    	$page = (Input::get('page')) ? Input::get('page') : 1; // Get the current page for the request
        $limit = 10;
        $offset = ($page-1) * $limit;
        // $kredit = kredit_nuk::all();


         $kode_kantor = refkodekantor::all();

         $sql = "SELECT 
         			prekredit_nuk.no_kredit,
					prekredit_nuk.nama,
					prekredit_nuk.nuk,
					prekredit_nuk.no_mohon,
					prekredit_nuk.status,
					prekredit_nuk.jam_dok,
					prekredit_nuk.pengajuan,
					kredit_nuk.no_ref,
					kredit_nuk.tgl_kredit,
					kredit_nuk.sistem,
					kredit_nuk.pinj_prsbunga,
					kredit_nuk.pinj_pokok,
					kredit_nuk.bbt,
					kredit_nuk.plafon,
					kredit_nuk.saldo_piutang,
					kredit_nuk.lama,
					kredit_nuk.tgl_mulai,
					kredit_nuk.tgl_akhir,
					kredit_nuk.advance,
					kredit_nuk.angsur_pokok,
					kredit_nuk.nbulan,
					kredit_nuk.jatuhtempo,
					kredit_nuk.namaao,
					kredit_nuk.validasi,
					kredit_nuk.pinj_pokok+kredit_nuk.bbt as slp,
					kredit_nuk.no_mohon as no_mohon_krd         
                FROM kredit_nuk Left Join prekredit_nuk ON kredit_nuk.no_kredit = prekredit_nuk.no_kredit 
                where prekredit_nuk.pengajuan= 'VALID#0'  
                -- left join angsuran_jadwal_nuk on kredit_nuk.no_kredit = angsuran_jadwal_nuk.no_kredit         
                ORDER BY prekredit_nuk.no_mohon DESC ";

        $total = count(DB::connection('pgsql')->select(DB::raw($sql.";")));
        Log::info($total);

        $nsblist = DB::connection('pgsql')->select(DB::raw($sql." LIMIT ".$limit." OFFSET ".$offset.";"));

        $pagination = new Paginator($nsblist, $total, $limit,$page,array("path" => url('/laporan/lapnuk')));

        

        // $jumlah =  "SELECT count(no_kredit) as nomor,sum(pinj_pokok) as jumpokok,sum(bbt) as jumbbt,sum(kredit.pinj_pokok+kredit.bbt) as jumsalpi FROM kredit 
        // where tgl_kredit::timestamp = '".date('Y-m-d 00:00:00')."'";
        
        // $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('laporan.lapnuk',compact('kode_kantor','nsblist','angs','pagination','kredit'));
    }

    public function viewnukNPP($key=null)
    {  
         // WHERE kredit_nuk.tgl_kredit >= '".ymd($tgl)."' AND kredit_nuk.tgl_kredit <= '".ymd($tgl2)."') ".$limit_max." ".$sis." ".$nsb_ktr." ".$carinama." 

    	$page = (Input::get('page')) ? Input::get('page') : 1; // Get the current page for the request
        $limit = 10;
        $offset = ($page-1) * $limit;
        // $kredit = kredit_nuk::all();
        $kunci = strtoupper($key);


         $kode_kantor = refkodekantor::all();

         $sql = "SELECT 
         			prekredit_nuk.no_kredit,
					prekredit_nuk.nama,
					prekredit_nuk.nuk,
					prekredit_nuk.no_mohon,
					prekredit_nuk.status,
					prekredit_nuk.jam_dok,
					prekredit_nuk.pengajuan,
					kredit_nuk.no_kredit,
					kredit_nuk.no_ref,
					kredit_nuk.tgl_kredit,
					kredit_nuk.sistem,
					kredit_nuk.pinj_prsbunga,
					kredit_nuk.pinj_pokok,
					kredit_nuk.bbt,
					kredit_nuk.plafon,
					kredit_nuk.saldo_piutang,
					kredit_nuk.lama,
					kredit_nuk.tgl_mulai,
					kredit_nuk.tgl_akhir,
					kredit_nuk.advance,
					kredit_nuk.angsur_pokok,
					kredit_nuk.nbulan,
					kredit_nuk.jatuhtempo,
					kredit_nuk.namaao,
					kredit_nuk.validasi,
					kredit_nuk.pinj_pokok+kredit_nuk.bbt as slp,
					kredit_nuk.no_mohon as no_mohon_krd         
                FROM kredit_nuk Left Join prekredit_nuk ON kredit_nuk.no_kredit = prekredit_nuk.no_kredit 
                where ";
                $sql .= "kredit_nuk.no_kredit=prekredit_nuk.no_kredit AND prekredit_nuk.nuk LIKE '%".$kunci."%' AND
                prekredit_nuk.pengajuan= 'VALID#0'      
                ORDER BY prekredit_nuk.no_mohon DESC ";

        $total = count(DB::connection('pgsql')->select(DB::raw($sql.";")));
        Log::info($total);

        $nsblist = DB::connection('pgsql')->select(DB::raw($sql." LIMIT ".$limit." OFFSET ".$offset.";"));

        $pagination = new Paginator($nsblist, $total, $limit,$page,array("path" => url('/laporan/lapnuk')));

        

        // $jumlah =  "SELECT count(no_kredit) as nomor,sum(pinj_pokok) as jumpokok,sum(bbt) as jumbbt,sum(kredit.pinj_pokok+kredit.bbt) as jumsalpi FROM kredit 
        // where tgl_kredit::timestamp = '".date('Y-m-d 00:00:00')."'";
        
        // $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('laporan.lapnuknpp',compact('kode_kantor','nsblist','angs','pagination','kredit','kunci'));
    }

    public function viewnukTanggal($tanggal=null)
    {  
         // WHERE kredit_nuk.tgl_kredit >= '".ymd($tgl)."' AND kredit_nuk.tgl_kredit <= '".ymd($tgl2)."') ".$limit_max." ".$sis." ".$nsb_ktr." ".$carinama." 

    	$page = (Input::get('page')) ? Input::get('page') : 1; // Get the current page for the request
        $limit = 10;
        $offset = ($page-1) * $limit;
        // $kredit = kredit_nuk::all();
        $tgl = explode('/', $tanggal);


         $kode_kantor = refkodekantor::all();

         $sql = "SELECT 
         			prekredit_nuk.no_kredit,
					prekredit_nuk.nama,
					prekredit_nuk.nuk,
					prekredit_nuk.no_mohon,
					prekredit_nuk.status,
					prekredit_nuk.jam_dok,
					prekredit_nuk.pengajuan,
					kredit_nuk.no_kredit,
					kredit_nuk.no_ref,
					kredit_nuk.saldo_piutang,
					kredit_nuk.tgl_kredit,
					kredit_nuk.sistem,
					kredit_nuk.pinj_prsbunga,
					kredit_nuk.pinj_pokok,
					kredit_nuk.bbt,
					kredit_nuk.plafon,
					kredit_nuk.saldo_piutang,
					kredit_nuk.lama,
					kredit_nuk.tgl_mulai,
					kredit_nuk.tgl_akhir,
					kredit_nuk.advance,
					kredit_nuk.angsur_pokok,
					kredit_nuk.nbulan,
					kredit_nuk.jatuhtempo,
					kredit_nuk.namaao,
					kredit_nuk.validasi,
					kredit_nuk.pinj_pokok+kredit_nuk.bbt as slp,
					kredit_nuk.no_mohon as no_mohon_krd         
                FROM kredit_nuk Left Join prekredit_nuk ON kredit_nuk.no_kredit = prekredit_nuk.no_kredit 
                where ";
                	if ($tgl <> null)
			        {

			             $sql .= "kredit_nuk.no_kredit=prekredit_nuk.no_kredit and 
			             tgl_kredit::timestamp = '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."' 
			             order by saldo_piutang DESC";

			        }else{

			             $sql .= "kredit.no_kredit=prekredit.no_kredit order by saldo_piutang DESC";
			        }

        $total = count(DB::connection('pgsql')->select(DB::raw($sql.";")));
        Log::info($total);

        $nsblist = DB::connection('pgsql')->select(DB::raw($sql." LIMIT ".$limit." OFFSET ".$offset.";"));

        $pagination = new Paginator($nsblist, $total, $limit,$page,array("path" => url('/laporan/lapnuk')));

        

        // $jumlah =  "SELECT count(no_kredit) as nomor,sum(pinj_pokok) as jumpokok,sum(bbt) as jumbbt,sum(kredit.pinj_pokok+kredit.bbt) as jumsalpi FROM kredit 
        // where tgl_kredit::timestamp = '".date('Y-m-d 00:00:00')."'";
        
        // $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('laporan.lapnuktgl',compact('kode_kantor','nsblist','angs','pagination','kredit','kunci'));
    }

    public function viewnukTanggal2($tanggal1=null,$tanggal2=null)
    {  
         // WHERE kredit_nuk.tgl_kredit >= '".ymd($tgl)."' AND kredit_nuk.tgl_kredit <= '".ymd($tgl2)."') ".$limit_max." ".$sis." ".$nsb_ktr." ".$carinama." 

    	$page = (Input::get('page')) ? Input::get('page') : 1; // Get the current page for the request
        $limit = 10;
        $offset = ($page-1) * $limit;
        // $kredit = kredit_nuk::all();
        // $tgl = explode('/', $tanggal);


         $kode_kantor = refkodekantor::all();

         $sql = "SELECT 
         			prekredit_nuk.no_kredit,
					prekredit_nuk.nama,
					prekredit_nuk.nuk,
					prekredit_nuk.no_mohon,
					prekredit_nuk.status,
					prekredit_nuk.jam_dok,
					prekredit_nuk.pengajuan,
					kredit_nuk.no_kredit,
					kredit_nuk.no_ref,
					kredit_nuk.saldo_piutang,
					kredit_nuk.tgl_kredit,
					kredit_nuk.sistem,
					kredit_nuk.pinj_prsbunga,
					kredit_nuk.pinj_pokok,
					kredit_nuk.bbt,
					kredit_nuk.plafon,
					kredit_nuk.saldo_piutang,
					kredit_nuk.lama,
					kredit_nuk.tgl_mulai,
					kredit_nuk.tgl_akhir,
					kredit_nuk.advance,
					kredit_nuk.angsur_pokok,
					kredit_nuk.nbulan,
					kredit_nuk.jatuhtempo,
					kredit_nuk.namaao,
					kredit_nuk.validasi,
					kredit_nuk.pinj_pokok+kredit_nuk.bbt as slp,
					kredit_nuk.no_mohon as no_mohon_krd         
                FROM kredit_nuk Left Join prekredit_nuk ON kredit_nuk.no_kredit = prekredit_nuk.no_kredit 
                where ";
                	$sql .= "kredit_nuk.no_kredit=prekredit_nuk.no_kredit 
		             and tgl_kredit::timestamp 
		             BETWEEN  '".date('Y-m-d 00:00:00',strtotime($tanggal1))."'
		             and  '".date('Y-m-d 00:00:00',strtotime($tanggal2))."' 
		             order by saldo_piutang DESC";

        $total = count(DB::connection('pgsql')->select(DB::raw($sql.";")));
        Log::info($total);

        $nsblist = DB::connection('pgsql')->select(DB::raw($sql." LIMIT ".$limit." OFFSET ".$offset.";"));

        $pagination = new Paginator($nsblist, $total, $limit,$page,array("path" => url('/laporan/lapnuk')));

        

        // $jumlah =  "SELECT count(no_kredit) as nomor,sum(pinj_pokok) as jumpokok,sum(bbt) as jumbbt,sum(kredit.pinj_pokok+kredit.bbt) as jumsalpi FROM kredit 
        // where tgl_kredit::timestamp = '".date('Y-m-d 00:00:00')."'";
        
        // $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('laporan.lapnuktgl2',compact('kode_kantor','nsblist','angs','pagination','kredit','kunci'));
    }
}
