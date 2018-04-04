<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Http\Controllers\ABCController;
//use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Requests;
use App\Nasabah;
use App\Laporan;
use App\PasanganNasabah;
use App\Prekredit;
use App\kredit;
use App\AgunanSertifikat;
use App\AgunanKendaraan;
use App\AgunanKredit;
use App\DafKreditBiaya;
use App\Data;
use App\AgunanKeluar;
use App\ABCKantor;
use App\AngsKartu;
use App\AngsBayar;
//use App\ABCKantor;
//use App\RKRekening;
//use App\RKTransaksi;
//use App\RKKodeTrans;
///use App\LKH;
//use App\TransRK;
//use App\RKPosting;
//use App\ABCBank;
use App\AngsJadwal;
use App\refkodekantor;
use App\LKH;
use Auth;
use DB;
use Log;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
//use Auth;
use Input;

class KreditController extends Controller
{

    public function angsuran($tahun,$kode_kantor,$nourut)
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

        $datanasabah = DB::connection('pgsql')->select(DB::raw("SELECT kredit.no_kredit,tgl_kredit,sistem,no_ref,pinj_pokok,nama,plafon,pinj_prsbunga,bbt,saldo_piutang,sistem,lama,tgl_mulai,tgl_akhir,jatuhtempo,tgl_lunas,alamat,rtrw,desa,camat,kodya,notelp,nohp,angsuran_jadwal.angs_pokok,angsuran_jadwal.angs_bunga,angsuran_jadwal.bayar_ke FROM kredit,prekredit,angsuran_jadwal WHERE kredit.no_kredit = '".$nokredit."' AND kredit.no_kredit=prekredit.no_kredit AND kredit.no_kredit=angsuran_jadwal.no_kredit;"))[0];

        

        $dataangsuran = DB::connection('pgsql')->select(DB::raw("SELECT aj.no_kredit,bayar_ke,angs_ke,tgl_angsur,sal_pokok, angs_tgl,DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp) as diff,angs_nobukti,aj.angs_pokok,aj.angs_bunga,pokok,bunga,denda,spokok,sbbt
                                                                FROM angsuran_jadwal aj LEFT OUTER JOIN (SELECT no_kredit,angs_nobukti,angs_ke,denda,(angs_titippokok+angs_pokok) as pokok,(angs_titipbunga+angs_bunga) as bunga,angs_tgl, ((angs_titippokok+angs_pokok)) as spokok, (plafon*((angs_titipbunga+angs_bunga)/12)) as sbbt FROM angsuran_kartu ORDER BY angs_ke) as ak ON ak.no_kredit = aj.no_kredit AND angs_ke = bayar_ke
                                                                WHERE aj.no_kredit='".$nokredit."' ORDER BY bayar_ke,angs_tgl;"));

        $sql8 ="SELECT mst_dati2.desc1,mst_dati2.desc2,nasabah.dati2,nasabah.no_nsb,prekredit.no_nsb
                from mst_dati2,prekredit,nasabah
                where nasabah.no_nsb = prekredit.no_nsb and prekredit.no_kredit='".$nokredit."' 
                AND 
                mst_dati2.desc1=nasabah.dati2";
        $lihat8 = DB::connection('pgsql')->select(DB::raw($sql8));

        $jadwal = AngsJadwal::where('no_kredit',$nokredit)->orderBy('bayar_ke','asc')->get();

         if($datanasabah->saldo_piutang > 0){
                $bayarangsuran = 1;
            } else {
                $bayarangsuran = 0;
            }
            //denda
            $arr = array(0,0,0,0,0);
            $dataangs = array();
            $tgk = 0;

            foreach($dataangsuran as $key=>$angs){
                if($angs->angs_ke <> ""){
                    if($angs->diff <= 3){
                        $angs->dendakena = 0;
                    } else {
                        if($arr[0] == $angs->angs_ke){
                            $diff = date_diff(date_create(date('Y-m-d',strtotime($angs->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$angs->angs_ke]->angs_tgl))))->format('%r%a');
                            $angs->dendakena = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]))/100)*100*abs($diff);        
                        } else {
                            $angs->dendakena = ceil((0.5/100)*($angs->angs_pokok+$angs->angs_bunga)/100)*100*$angs->diff;
                        }
                    }
                    if($arr[0] == $angs->angs_ke){
                        $angs->pokok += $arr[1];
                        $angs->bunga += $arr[2];
                        $angs->denda += $arr[3];
                        $angs->dendakena += $arr[4];
                        $arr[1] = $angs->pokok;
                        $arr[2] = $angs->bunga;
                        $arr[3] = $angs->denda;
                        $arr[4] = $angs->dendakena;
                    } else {
                        $arr[0] = $angs->angs_ke;
                        $arr[1] = $angs->pokok;
                        $arr[2] = $angs->bunga;
                        $arr[3] = $angs->denda;
                        $arr[4] = $angs->dendakena;
                    }
                    if(($tgk == 0) && (($angs->angs_pokok+$angs->angs_bunga) <> ($angs->pokok+$angs->bunga))){
                        $tgk = $angs->bayar_ke;
                    }
                } else {
                    $angs->dendakena = 0;
                    if($tgk == 0){
                        $tgk = $angs->bayar_ke;
                    }
                }
                if($bayarangsuran === 1){
                    $dataangs[$angs->bayar_ke] = $angs;
                } elseif($bayarangsuran === 0) {
                    if(!isset($dataangs[$angs->bayar_ke])){
                        $dataangs[$angs->bayar_ke] = $angs;
                    }
                    $dataangs[$angs->bayar_ke]->denda = $angs->denda;
                    
                }
            }
            if(!isset($dataangs[$tgk])){
                $tgk = count($dataangs);
            }
                $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$tgk]->tgl_angsur))))->format('%r%a');
                if($diff < 0){
                    if(isset($dataangs[$tgk-1])){
                        $dataangs[$tgk]->tunggak = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$tgk-1]->tgl_angsur))))->format('%r%a');    
                    } else {
                        $dataangs[$tgk]->tunggak = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($datanasabah->tgl_kredit))))->format('%r%a');    
                    }
                } else {
                    $dataangs[$tgk]->tunggak = 0;
                }
                $i = $tgk;
                if($dataangs[$i]->angs_tgl <> ""){
                    if(strtotime(date('Y-m-d')) < strtotime($dataangs[$i]->tgl_angsur)){
                        $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$tgk]->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$tgk]->tgl_angsur))))->format('%r%a');
                    } else {
                        $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$tgk]->angs_tgl))))->format('%r%a');
                    }
                }
                $totaltunggak = array('pokok'=>0,'bunga'=>0);
                
                if($diff <= 0){
                    while ($diff <= 0) {
                        $dataangs[$i]->sisa_tunggak = ($dataangs[$i]->angs_pokok+$dataangs[$i]->angs_bunga)-($dataangs[$i]->pokok+$dataangs[$i]->bunga);
                        $totaltunggak['pokok'] += $dataangs[$i]->angs_pokok-$dataangs[$i]->pokok;
                        $totaltunggak['bunga'] += $dataangs[$i]->angs_bunga-$dataangs[$i]->bunga;
                        if($diff < -3){
                            $dataangs[$i]->dendakena += ceil((0.5/100)*$dataangs[$i]->sisa_tunggak/100)*100*abs($diff);
                        } else {
                            $dataangs[$i]->dendakena += 0;
                        }
                        $i++;
                        if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i-1]->tgl_angsur))))->format('%r%a') == 0){
                            $tgkangsur = $i-$tgk-1;
                        } else {
                            $tgkangsur = $i-$tgk;
                        }
                        if(isset($dataangs[$i])){
                            if($dataangs[$i]->angs_tgl <> ""){
                                if(strtotime(date('Y-m-d')) < strtotime($dataangs[$i]->tgl_angsur)){
                                    $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))))->format('%r%a');
                                } else {
                                    $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))))->format('%r%a');
                                }
                            } else {
                                $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))))->format('%r%a');
                            }
                        } else {
                            break;
                        }
                    }
                } else {
                    $tgkangsur = 0;
                }
                if(!isset($dataangs[$tgk]->sisa_tunggak)){
                    $dataangs[$tgk]->sisa_tunggak = ($dataangs[$tgk]->angs_pokok+$dataangs[$tgk]->angs_bunga)-($dataangs[$tgk]->pokok+$dataangs[$tgk]->pokok);
                }
            if($bayarangsuran === 0){
                $tgkangsur = 0;
                $totaltunggak['pokok'] = 0;
                $totaltunggak['bunga'] = 0;
            }
            $totaldenda = 0;
            foreach($dataangs as $angs){
                if($angs->dendakena <> 0){
                    $totaldenda += $angs->dendakena;
                }
                if($angs->denda <> 0){
                    $totaldenda -= $angs->denda;
                }
            }
        
        return view('kredit.angsuran',compact('sifatkrd','jns_krd','skim','kadeb','goldeb','jnsbiaya','ori','eko','dati2','jenisbunga','kreditpp','sumber','kolek','sebabmacet','cara','kondisi','valuta','res','kode_kantor','daftar','biaya','jadwal','bayar','prekredit','nokredit','ljk','totalsaldo','totalpokok','ao','lihat1','datanasabah','lihat8','jadwal','dataangs','tgk','totaldenda','nasabahbayar','jadwal','lastday','bulan','tahun','spokok','sbbt','spiutang'));
        
    }
    public function viewFormKredit($nonsb)
    {
        
        
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
        
        $nasabah = Nasabah::where('no_nsb',$nonsb)->first();
        $lapuang = Laporan::where('no_nsb',$nonsb)->get();

        // $totalsaldo = array();
        $totalsaldo  = DB::connection('pgsql')->select(DB::raw("SELECT MIN(bakidebet) as bakidebet from angsuran_kartu where no_kredit in (SELECT no_kredit from kredit where tgl_lunas::text LIKE '1900-01-01%' AND no_kredit IN (SELECT no_kredit FROM prekredit WHERE no_nsb='".$nonsb."')) GROUP BY no_kredit")); 
        $totalpokok = 0;
        foreach ($totalsaldo as $t) {
            $totalpokok += $t->bakidebet;
        }
        //$totalsaldo = DB::connection('pgsql')->table('angsuran_kartu')->whereRaw("no_kredit in (SELECT no_kredit from kredit where tgl_lunas::text LIKE '1900-01-01%' AND no_kredit IN (SELECT no_kredit FROM prekredit WHERE no_nsb='".$nonsb."')) GROUP BY angs_tgl ORDER BY angs_tgl DESC LIMIT 1")->min('bakidebet');
        // echo "total saldo nasabah =".$totalsaldo; 
        // Log::info($totalpokok);
        
        return view('kredit.forminputkredit',compact('sifatkrd','jns_krd','skim','kadeb','goldeb','jnsbiaya','ori','eko','dati2','jenisbunga','kreditpp','sumber','kolek','sebabmacet','cara','kondisi','valuta','res','kode_kantor','nasabah','ljk','totalsaldo','totalpokok','lapuang','ao'));
        
    } 
    public function saveDataKredit(Request $request,$nonsb)
    {
       // Log::info($nonsb);
       // $totalpokok = 0;
       $lapuang = Laporan::where('no_nsb',$nonsb)->get();
       $kode_kantor =refkodekantor::where('kode_angka')->first();

       $nasabah = Nasabah::where('no_nsb',$request->input('no_nsb'))->first();
       $ke = Prekredit::where('no_nsb',$request->input('no_nsb'))->count() + 1;
        if($ke > 1){
            $lastno = Prekredit::where('no_nsb',$request->input('no_nsb'))->pluck('no_kredit')->first();
            $nokredit = date('y').'/ABC.'.$request->input('input_kantor').'/'.substr($lastno,10,7).'-'.str_pad($ke, 3,'0',STR_PAD_LEFT);
        } else {
           $lastno = DB::connection('pgsql')->select(DB::raw('select max(substr(no_kredit,11,7)) as no from prekredit'))[0];
           $nokredit = date('y').'/ABC.'.$request->input('input_kantor').'/'.str_pad((int) ($lastno->no + 1),7,STR_PAD_LEFT).'-001';
        }

        
       
        $prekredit = new Prekredit;
        $prekredit->no_mohon = str_pad(((int) Prekredit::max('no_mohon') + 1),10,'0',STR_PAD_LEFT);
        $prekredit->no_kredit = $nokredit;
        $prekredit->tgl_mohon = date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_kredit'))); 
        $prekredit->no_nsb = $request->input('no_nsb');
        $prekredit->no_cif = $nasabah->no_cif;
        $prekredit->nama = $nasabah->nama;
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

        $prekredit->nobadan = $nasabah->nobadan;
        $prekredit->jenisbadan = $nasabah->jenisbadan;
        $prekredit->tempatberdiri = $nasabah->tempatberdiri;
        $prekredit->noakta = $nasabah->noakta;
        $prekredit->tglakta = $nasabah->tglakta;
        $prekredit->opr = $request->input('opr');

        $prekredit->kode_kantor = $request->input('input_kantor');

        if(count($request->input('input_no_sertifikat')) > 0){
            $prekredit->jenkend = $request->input('input_jenis_sertifikat')[0];
        } elseif(count($request->input('input_jenis_kendaraan')) > 0){
            $prekredit->jenkend = $request->input('input_status_kendaraan')[0];
        }
        $prekredit->save();


        $kredit = new Kredit;
        $kredit->namaao = $request->input('nama_ao');
        $kredit->no_nsb = $request->input('no_nsb');
        // $kredit->no_cif = $request->input('no_cif');
        $kredit->no_kredit = $prekredit->no_kredit;
        //$kredit->no_kredit = $request->input('no_kredit');
        $kredit->no_ref= $request->input('no_ref');
        $kredit->ke = $ke;
        //$kredit->jenis = $request->input('input_agunan1');
        $kredit->no_ref = strtoupper($request->input('input_no_npp'));
        $kredit->sifatkrd = $request->input('input_sifatkrd');
        $kredit->jns_krd = $request->input('input_kode_jenis_kredit');
        $kredit->skim = $request->input('input_skim');       
        $kredit->no_mohon = $prekredit->no_mohon;
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

        Log::info($kredit->tgl_mulai);

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
            $kredit->pinj_prsbunga = $request->input('input_bunga')*12;
        }else{
            $kredit->pinj_prsbunga = $request->input('input_bunga');
        }

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

        return redirect('/addagunan/'.$nasabah->no_nsb.'/'.$prekredit->no_kredit);
    }

    public function viewFormKreditBadan($nonsb)
    {
        
        
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
        
        $nasabah = Nasabah::where('no_nsb',$nonsb)->first();
        
        return view('kredit.forminputkreditbadan',compact('sifatkrd','jns_krd','skim','kadeb','goldeb','jnsbiaya','ori','eko','dati2','jenisbunga','kreditpp','sumber','kolek','sebabmacet','cara','kondisi','valuta','res','kode_kantor','nasabah','ljk','ao'));
        
    } 
    public function saveDataKreditBadan(Request $request,$nonsb)
    {
       
       $kode_kantor =refkodekantor::where('kode_angka')->first();

       $nasabah = Nasabah::where('no_nsb',$request->input('no_nsb'))->first();
       $ke = Prekredit::where('no_nsb',$request->input('no_nsb'))->count() + 1;
        if($ke > 1){
            $lastno = Prekredit::where('no_nsb',$request->input('no_nsb'))->pluck('no_kredit')->first();
            $nokredit = date('y').'/ABC.'.$request->input('input_kantor').'/'.substr($lastno,10,7).'-'.str_pad($ke, 3,'0',STR_PAD_LEFT);
        } else {
           $lastno = DB::connection('pgsql')->select(DB::raw('select max(substr(no_kredit,11,7)) as no from prekredit'))[0];
           $nokredit = date('y').'/ABC.'.$request->input('input_kantor').'/'.str_pad((int) ($lastno->no + 1),7,STR_PAD_LEFT).'-001';
        }
       
        $prekredit = new Prekredit;
        $prekredit->no_mohon = str_pad(((int) Prekredit::max('no_mohon') + 1),10,'0',STR_PAD_LEFT);
        $prekredit->no_kredit = $nokredit;
        $prekredit->tgl_mohon = date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_kredit')));
        $prekredit->no_nsb = $request->input('no_nsb');
        $prekredit->no_cif = $nasabah->no_cif;
        $prekredit->nama = $nasabah->nama;
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

        $prekredit->nobadan = $nasabah->nobadan;
        $prekredit->jenisbadan = $nasabah->jenisbadan;
        $prekredit->tempatberdiri = $nasabah->tempatberdiri;
        $prekredit->noakta = $nasabah->noakta;
        $prekredit->tglakta = $nasabah->tglakta;
        $prekredit->opr = $request->input('opr');

        $prekredit->kode_kantor = $request->input('input_kantor');

        if(count($request->input('input_no_sertifikat')) > 0){
            $prekredit->jenkend = $request->input('input_jenis_sertifikat')[0];
        } elseif(count($request->input('input_jenis_kendaraan')) > 0){
            $prekredit->jenkend = $request->input('input_status_kendaraan')[0];
        }
        $prekredit->save();


        $kredit = new Kredit;
        $kredit->namaao = $request->input('nama_ao');
        $kredit->no_nsb = $request->input('no_nsb');
        // $kredit->no_cif = $request->input('no_cif');
        $kredit->no_kredit = $prekredit->no_kredit;
        //$kredit->no_kredit = $request->input('no_kredit');
        $kredit->no_ref= $request->input('no_ref');
        $kredit->ke = $ke;
        //$kredit->jenis = $request->input('input_agunan1');
        $kredit->no_ref = strtoupper($request->input('input_no_npp'));
        $kredit->sifatkrd = $request->input('input_sifatkrd');
        $kredit->jns_krd = $request->input('input_kode_jenis_kredit');
        $kredit->skim = $request->input('input_skim');       
        $kredit->no_mohon = $prekredit->no_mohon;
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
        //untuk buat nomor npp 
        // $status = refkodekantor::where('kode_angka', $kredit->kode_kantor)->firstOrFail()->status;
        // //echo "status = " . $status;
        //      if ($status == "PUSAT"){
        //          $last = Kredit::where('no_nsb',$request->input('no_nsb'))->pluck('no_ref')->first();
        //          $npp = substr($last,10,7).'/NPP'.'/'.$request->input('input_agunan1').'/'.date('m').'/'.date('y');
        // }
        // else 
        //     if ($status == "POS"){
        //         $npp = str_pad(((int)kredit::max('no_ref')+1),7,'0',STR_PAD_LEFT).'-'.$status.'/NPP'.'/'.$request->input('input_agunan1').'/'.date('m').'/'.date('y');
        // }else 
        //     if ($status == "CABANG"){
        //         $npp = str_pad(((int)kredit::max('no_ref')+1),7,'0',STR_PAD_LEFT).'-'.$status.'/NPP'.'/'.$request->input('input_agunan1').'/'.date('m').'/'.date('y');
        //     }   
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
        
        return redirect('/addlapbadan/'.$nasabah->no_nsb.'/'.$prekredit->no_kredit);
        // return redirect('/addagunan/'.$nasabah->no_nsb.'/'.$prekredit->no_kredit);
    }

    public function viewFormKreditParipasu($nonsb)
    {
        
        
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
        
        $nasabah = Nasabah::where('no_nsb',$nonsb)->get();
        $prekredit = prekredit::where('no_nsb',$nonsb)->get();

        
        return view('kredit.forminputkreditparipasu',compact('sifatkrd','jns_krd','skim','kadeb','goldeb','jnsbiaya','ori','eko','dati2','jenisbunga','kreditpp','sumber','kolek','sebabmacet','cara','kondisi','valuta','res','kode_kantor','nasabah','ljk','prekredit','ao'));
        
    } 
    public function saveDataKreditParipasu(Request $request,$nonsb)
    {
       
       $kode_kantor =refkodekantor::where('kode_angka')->first();

       $nasabah = Nasabah::where('no_nsb',$request->input('no_nsb'))->first();
       $ke = Prekredit::where('no_nsb',$request->input('no_nsb'))->count() + 1;
        if($ke > 1){
            $lastno = Prekredit::where('no_nsb',$request->input('no_nsb'))->pluck('no_kredit')->first();
            $nokredit = date('y').'/ABC.'.$request->input('input_kantor').'/'.substr($lastno,10,7).'-'.str_pad($ke, 3,'0',STR_PAD_LEFT);
        } else {
           $lastno = DB::connection('pgsql')->select(DB::raw('select max(substr(no_kredit,11,7)) as no from prekredit'))[0];
           $nokredit = date('y').'/ABC.'.$request->input('input_kantor').'/'.str_pad((int) ($lastno->no + 1),7,STR_PAD_LEFT).'-001';
        }
       
        $prekredit = new Prekredit;
        $prekredit->no_mohon = str_pad(((int) Prekredit::max('no_mohon') + 1),10,'0',STR_PAD_LEFT);
        $prekredit->no_kredit = $nokredit;
        $prekredit->tgl_mohon = date('Y-m-d 00:00:00',strtotime($request->input('input_tgl_kredit')));
        $prekredit->no_nsb = $request->input('no_nsb');
        // $prekredit->no_cif = $request->input('no_cif');
        $prekredit->nama = $nasabah->nama;
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

        $prekredit->nobadan = $nasabah->nobadan;
        $prekredit->jenisbadan = $nasabah->jenisbadan;
        $prekredit->tempatberdiri = $nasabah->tempatberdiri;
        $prekredit->noakta = $nasabah->noakta;
        $prekredit->tglakta = $nasabah->tglakta;
        $prekredit->opr = $request->input('opr');

        $prekredit->kode_kantor = $request->input('input_kantor');

        if(count($request->input('input_no_sertifikat')) > 0){
            $prekredit->jenkend = $request->input('input_jenis_sertifikat')[0];
        } elseif(count($request->input('input_jenis_kendaraan')) > 0){
            $prekredit->jenkend = $request->input('input_status_kendaraan')[0];
        }
        $prekredit->save();


        $kredit = new Kredit;
        $kredit->namaao = $request->input('nama_ao');
        $kredit->no_nsb = $request->input('no_nsb');
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
        //untuk buat nomor npp 
        // $status = refkodekantor::where('kode_angka', $kredit->kode_kantor)->firstOrFail()->status;
        // //echo "status = " . $status;
        //      if ($status == "PUSAT"){
        //          $last = Kredit::where('no_nsb',$request->input('no_nsb'))->pluck('no_ref')->first();
        //          $npp = substr($last,10,7).'/NPP'.'/'.$request->input('input_agunan1').'/'.date('m').'/'.date('y');
        // }
        // else 
        //     if ($status == "POS"){
        //         $npp = str_pad(((int)kredit::max('no_ref')+1),7,'0',STR_PAD_LEFT).'-'.$status.'/NPP'.'/'.$request->input('input_agunan1').'/'.date('m').'/'.date('y');
        // }else 
        //     if ($status == "CABANG"){
        //         $npp = str_pad(((int)kredit::max('no_ref')+1),7,'0',STR_PAD_LEFT).'-'.$status.'/NPP'.'/'.$request->input('input_agunan1').'/'.date('m').'/'.date('y');
        //     }       
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
        
        return redirect('/addagunanparipasu/'.$nasabah->no_nsb.'/'.$prekredit->no_kredit);
        // return redirect('/addagunan/'.$nasabah->no_nsb.'/'.$prekredit->no_kredit);
    }

    public function viewBayarAngsuran(Request $request,$tahun,$kantor,$nourut)
    {
        $nokredit = $tahun.'/'.$kantor.'/'.$nourut;
        $tgllkh = LKH::find($request->session()->get('lkh'));

       // $datanasabah = DB::connection('pgsql')->select(DB::raw("select kredit.no_kredit,nama,kelamin,tmplahir,tgllahir,alamat,notelp,kodya,no_ref,sistem,lama,tgl_mulai,tgl_lunas,kredit.plafon,bbt,saldo_piutang,sum(potongan) as potongan,sum(angs_pokok+angs_titippokok) as pokok,sum(angs_bunga+angs_titipbunga) as bunga,SUM(denda) as denda,SUM(potongan_pokok) as potpokok,SUM(potongan_bunga) as potbunga,SUM(potongan_denda) as potdenda 
       //                      from prekredit,kredit JOIN angsuran_kartu ON kredit.no_kredit = angsuran_kartu.no_kredit 
       //                      where prekredit.no_mohon=kredit.no_mohon and kredit.no_kredit = '".$nokredit."' GROUP BY kredit.no_kredit,kredit.no_ref,nama,tmplahir,tgllahir,alamat,notelp,kodya,kelamin,tgl_lunas,kredit.plafon,bbt,saldo_piutang,lama,tgl_mulai,sistem"))[0];            
        $datanasabah = DB::connection('pgsql')->select(DB::raw("SELECT kredit.no_kredit,tgl_kredit,sistem,no_ref,nama,alamat,lama,pinj_prsbunga,tgl_mulai,tgl_akhir,notelp,plafon,bbt,bakidebet,saldo_bbt,saldo_piutang,tgl_lunas FROM kredit,prekredit WHERE kredit.no_kredit = '".$nokredit."' AND kredit.no_kredit=prekredit.no_kredit;"))[0];
        $dataangsuran = DB::connection('pgsql')->select(DB::raw("SELECT aj.no_kredit,bayar_ke,angs_ke,tgl_angsur,angs_tgl,transfer_tgl,
                                                                    CASE
                                                                      WHEN transfer_tgl <> '1900-01-01 00:00:00' THEN DATE_PART('day', transfer_tgl::timestamp - tgl_angsur::timestamp)
                                                                      ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
                                                                    END as diff,angs_nobukti,bunga_sldbbt,bakidebet,sld_piutang,aj.angs_pokok,aj.angs_bunga,pokok,bunga,denda
                                                                    FROM angsuran_jadwal aj LEFT OUTER JOIN (SELECT no_kredit,angs_nobukti,angs_ke,denda,bunga_sldbbt,bakidebet,sld_piutang,(angs_titippokok+angs_pokok) as pokok,(angs_titipbunga+angs_bunga) as bunga,angs_tgl,transfer_tgl FROM angsuran_kartu ORDER BY angs_ke) as ak ON ak.no_kredit = aj.no_kredit AND angs_ke = bayar_ke
                                                                    WHERE aj.no_kredit='".$nokredit."' ORDER BY bayar_ke,angs_tgl;")); 
        
        if($datanasabah->saldo_piutang > 0){
            $bayarangsuran = 1; 
        } else {
            $bayarangsuran = 0;
        }
        //denda
        $arr = array(0,0,0,0,0,0,0,0);
        $dataangs = array();
        $tgk = 0;
        //$bayarangsuran = 1;
        foreach($dataangsuran as $key=>$angs){
            if($angs->angs_ke <> ""){
                if($angs->diff <= 3){
                    $angs->dendakena = 0;
                    $angs->dendakena2 = 0;
                } else {
                    if($arr[0] == $angs->angs_ke){
                        //$diff = date_diff(date_create(date('Y-m-d',strtotime($angs->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[($angs->angs_ke-1)]->angs_tgl))))->format('%r%a');
                        //$diff = date_diff(date_create(date('Y-m-d',strtotime($angs->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$angs->angs_ke]->angs_tgl))))->format('%r%a');
                        // if(strtotime('1900-01-01 00:00:00') >= strtotime($angs->transfer_tgl)){
                        //     $diff = date_diff(date_create(date('Y-m-d',strtotime($angs->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$angs->angs_ke]->tgl_angsur))))->format('%r%a');
                        // } else {
                        //     $diff = date_diff(date_create(date('Y-m-d',strtotime($angs->transfer_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$angs->angs_ke]->tgl_angsur))))->format('%r%a');
                        // }
                        //$diff = date_diff(date_create(date('Y-m-d',strtotime($angs->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangsuran[($key-1)]->angs_tgl))))->format('%r%a');
                        //$angs->dendakena += ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]))/100)*100*$angs->diff;        
                        if($arr[6] > 0){
                            $angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff-$arr[6]);                
                        } else {
                            $angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff);                
                        }
                        //$angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff-$arr[6]);
                        if((($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga)) > 0){
                            $angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]))/100)*100*$angs->diff2;
                        } else {
                            $angs->dendakena2 = 0;
                        }
                    } else {
                        if(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga) > 0){
                            $angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga))/100)*100*$angs->diff2;
                        } else {
                            $angs->dendakena2 = 0;
                        }
                        $angs->dendakena = ceil((0.5/100)*($angs->angs_pokok+$angs->angs_bunga)/100)*100*$angs->diff;
                    }
                }

                if($arr[0] == $angs->angs_ke){
                    if(($angs->pokok+$angs->bunga == 0)){
                        $angs->angs_tgl = $arr[5];
                        $angs->diff = $arr[6];
                    }
                    $angs->pokok += $arr[1];
                    $angs->bunga += $arr[2];
                    $angs->denda += $arr[3];
                    $angs->dendakena += $arr[4];
                    $arr[1] = $angs->pokok;
                    $arr[2] = $angs->bunga;
                    $arr[3] = $angs->denda;
                    $arr[4] = $angs->dendakena;
                    $arr[5] = $angs->angs_tgl;
                    $arr[6] = $angs->diff;
                    if($arr[7] < $angs->sld_piutang){
                        $angs->sld_piutang = $arr[7];
                    }
                    $arr[7] = $angs->sld_piutang;
                    if(($tgk == $angs->angs_ke) && (($angs->angs_pokok+$angs->angs_bunga) === ($angs->pokok+$angs->bunga))){
                        $tgk = 0;
                    }
                } else {
                    $arr[0] = $angs->angs_ke;
                    $arr[1] = $angs->pokok;
                    $arr[2] = $angs->bunga;
                    $arr[3] = $angs->denda;
                    $arr[4] = $angs->dendakena;
                    $arr[5] = $angs->angs_tgl;
                    $arr[6] = $angs->diff;
                    $arr[7] = $angs->sld_piutang;
                    if(($tgk == 0) && (($angs->angs_pokok+$angs->angs_bunga) <> ($angs->pokok+$angs->bunga))){
                        $tgk = $angs->bayar_ke;
                    }
                }
                // if(($tgk == 0) && (($angs->angs_pokok+$angs->angs_bunga) <> ($angs->pokok+$angs->bunga))){
                //     $tgk = $angs->bayar_ke;
                // }
            } else {
                //$angs->dendakena = 0;
                //$diff = date_diff(date_create(date('Y-m-d',strtotime($angs->tgl_angsur))), date_create(date('Y-m-d',strtotime($angs->angs_tgl))))->format('%a');
                if($angs->diff <= 3){
                    $angs->dendakena = 0;
                } else {
                    $angs->dendakena = ceil((0.5/100)*($angs->angs_pokok+$angs->angs_bunga)/100)*100*$angs->diff;
                }
                $angs->dendakena2 = 0;
                if($tgk == 0){
                    $tgk = $angs->bayar_ke;
                }
            }
            //$diff = date_diff(date_create(date('Y-m-d',strtotime($angs->tgl_angsur))), date_create(date('Y-m-d',strtotime($angs->angs_tgl))))->format('%a');
            //$diff = date_diff(date_create(date('Y-m-d',strtotime($angs->angs_tgl))), date_create(date('Y-m-d',strtotime($angs->tgl_angsur))))->format('%r%a');
            
            if($bayarangsuran === 1){
                $dataangs[$angs->bayar_ke] = $angs;
            } elseif($bayarangsuran === 0) {
                $dataangs[$angs->bayar_ke] = $angs;
                // if(!isset($dataangs[$angs->bayar_ke])){
                //     $dataangs[$angs->bayar_ke] = $angs;
                // }
                // if($dataangs[$angs->bayar_ke]->sld_piutang > $angs->sld_piutang){
                //     $dataangs[$angs->bayar_ke]->sld_piutang = $angs->sld_piutang;
                // }
                $dataangs[$angs->bayar_ke]->denda = $angs->denda;       
            }
        }
        if(!isset($dataangs[$tgk])){
            $tgk = count($dataangs);
        }
        $totaltunggak = array('pokok'=>0,'bunga'=>0);
        $i = $tgk;
        if($dataangs[$i]->diff > 0){
            while ($i <= count($dataangs) && $dataangs[$i]->diff <> null) {
                $dataangs[$i]->sisa_tunggak = ($dataangs[$i]->angs_pokok+$dataangs[$i]->angs_bunga)-($dataangs[$i]->pokok+$dataangs[$i]->bunga);
                $totaltunggak['pokok'] += $dataangs[$i]->angs_pokok-$dataangs[$i]->pokok;
                $totaltunggak['bunga'] += $dataangs[$i]->angs_bunga-$dataangs[$i]->bunga;
                /*if($dataangs[$i]->diff > 0){
                    $dataangs[$i]->dendakena += ceil((0.5/100)*$dataangs[$i]->sisa_tunggak/100)*100*$dataangs[$i]->diff;
                } else {
                    $dataangs[$i]->dendakena += 0;
                }*/
                $i++;
                if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i-1]->tgl_angsur))))->format('%r%a') == 0){
                    $tgkangsur = $i-$tgk-1;
                } else {
                    $tgkangsur = $i-$tgk;
                }
            }
        } else {
            $tgkangsur = 0;
        }
        if(!isset($dataangs[$tgk]->sisa_tunggak)){
            $dataangs[$tgk]->sisa_tunggak = ($dataangs[$tgk]->angs_pokok+$dataangs[$tgk]->angs_bunga)-($dataangs[$tgk]->pokok+$dataangs[$tgk]->pokok);
        }
        if($bayarangsuran === 0){
            $tgkangsur = 0;
            $totaltunggak['pokok'] = 0;
            $totaltunggak['bunga'] = 0;
        }
        $totaldenda = 0;
        foreach($dataangs as $angs){
            $angs->dendakena += $angs->dendakena2;
            if(($angs->angs_pokok+$angs->angs_bunga) > ($angs->pokok+$angs->bunga)){
                $angs->diff += $angs->diff2;
            }
            if($angs->dendakena > 0){
                $totaldenda += $angs->dendakena;
            }
            // if($angs->dendakena2 > 0){
            //     $totaldenda += $angs->dendakena2;
            // }
            if($angs->denda <> 0){
                $totaldenda -= $angs->denda;
            }
        }
        /*for($x=1;$x<=count($dataangs);$x++){
            $totaldenda += $dataangs[$x]->dendakena;
            $totaldenda -= $dataangs[$x]->denda;
        }*/

        // $dafbank = ABCBank::all();
        
        return view('kredit.bayarangsuran', compact('dataangs','datanasabah','tgk','totaldenda','tgkangsur','totaltunggak','dafbank','bayarangsuran'));
    }
    
    public function printBayarAngsuran($tahun,$kantor,$nourut)
    {
        // $nasabahbayar = $pembayaran;
        $nokredit = $tahun.'/'.$kantor.'/'.$nourut;
        $tgl = date('Y-m-d');
        // $tgk = $request->input('tgk');

        $sql8 ="SELECT mst_dati2.desc1,mst_dati2.desc2,nasabah.dati2,nasabah.no_nsb,prekredit.no_nsb
                from mst_dati2,prekredit,nasabah
                where nasabah.no_nsb = prekredit.no_nsb and prekredit.no_kredit='".$nokredit."' 
                AND 
                mst_dati2.desc1=nasabah.dati2";
        $lihat8 = DB::connection('pgsql')->select(DB::raw($sql8));

        //$jadwal = AngsJadwal::where('no_kredit',$nokredit)->orderBy('bayar_ke','asc')->get();
        $kredit = kredit::where('no_kredit',$nokredit)->first();
        if(trim($kredit->sistem,' ') != 'RK'){
                // $datanasabah = DB::connection('pgsql')->select(DB::raw("SELECT kredit.no_kredit,tgl_kredit,sistem,no_ref,nama,plafon,pinj_prsbunga,bbt,saldo_piutang,sistem,lama,tgl_mulai,tgl_lunas,jatuhtempo,alamat,rtrw,desa,camat,kodya,notelp,nohp,angsuran_jadwal.angs_pokok,angsuran_jadwal.angs_bunga FROM kredit,prekredit,angsuran_jadwal WHERE kredit.no_kredit = '".$nokredit."' AND kredit.no_kredit=prekredit.no_kredit AND kredit.no_kredit=angsuran_jadwal.no_kredit;"))[0];

                // $dataangsuran = DB::connection('pgsql')->select(DB::raw("SELECT aj.no_kredit,bayar_ke,angs_ke,tgl_angsur,angs_tgl,transfer_tgl,pot_bunga,
                //                                                     CASE
                //                                                       WHEN ('".date('Y-m-d')."' > tgl_angsur AND angs_tgl IS NULL) THEN DATE_PART('day', '".date('Y-m-d')."' - tgl_angsur::timestamp)
                //                                                       ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
                //                                                     END as diff,angs_nobukti,bunga_sldbbt,bakidebet,sld_piutang,aj.angs_pokok,aj.angs_bunga,pokok,bunga,denda,
                //                                                     CASE
                //                                                         WHEN ((pokok+bunga) < (aj.angs_pokok+aj.angs_bunga) AND angs_tgl >= tgl_angsur) THEN DATE_PART('day', '".date('Y-m-d')."' - angs_tgl::timestamp)
                //                                                         WHEN ((pokok+bunga) < (aj.angs_pokok+aj.angs_bunga) AND angs_tgl < tgl_angsur) THEN DATE_PART('day', '".date('Y-m-d')."' - tgl_angsur::timestamp)
                //                                                         ELSE 0
                //                                                     END as diff2
                //                                                     FROM angsuran_jadwal aj LEFT OUTER JOIN (SELECT no_kredit,angs_nobukti,angs_ke,denda,bunga_sldbbt,bakidebet,sld_piutang,(angs_titippokok+angs_pokok) as pokok,(angs_titipbunga+angs_bunga) as bunga,angs_tgl,transfer_tgl FROM angsuran_kartu ORDER BY angs_ke) as ak ON ak.no_kredit = aj.no_kredit AND angs_ke = bayar_ke
                //                                                     WHERE aj.no_kredit='".$nokredit."' ORDER BY bayar_ke,angs_tgl;"));
             $datanasabah = DB::connection('pgsql')->select(DB::raw("SELECT kredit.no_kredit,tgl_kredit,sistem,no_ref,nama,plafon,pinj_prsbunga,bbt,saldo_piutang,sistem,lama,tgl_mulai,tgl_lunas,jatuhtempo,alamat,rtrw,desa,camat,kodya,notelp,nohp,angsuran_jadwal.angs_pokok,angsuran_jadwal.angs_bunga FROM kredit,prekredit,angsuran_jadwal WHERE kredit.no_kredit = '".$nokredit."' AND kredit.no_kredit=prekredit.no_kredit AND kredit.no_kredit=angsuran_jadwal.no_kredit;"))[0];
        $dataangsuran = DB::connection('pgsql')->select(DB::raw("SELECT aj.no_kredit,bayar_ke,angs_ke,tgl_angsur,angs_tgl,transfer_tgl,pot_bunga,
                                                                CASE
                                                                  WHEN ('".date('Y-m-d',strtotime($tgl))."' > tgl_angsur AND angs_tgl IS NULL) THEN DATE_PART('day', '".date('Y-m-d',strtotime($tgl))."' - tgl_angsur::timestamp)
                                                                  ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
                                                                END as diff,angs_nobukti,bunga_sldbbt,bakidebet,sld_piutang,aj.angs_pokok,aj.angs_bunga,pokok,bunga,denda
                                                                FROM angsuran_jadwal aj LEFT OUTER JOIN (SELECT no_kredit,angs_nobukti,angs_ke,denda,bunga_sldbbt,bakidebet,sld_piutang,(angs_titippokok+angs_pokok) as pokok,(angs_titipbunga+angs_bunga) as bunga,angs_tgl,transfer_tgl FROM angsuran_kartu ORDER BY angs_ke) as ak ON ak.no_kredit = aj.no_kredit AND angs_ke = bayar_ke
                                                                WHERE aj.no_kredit='".$nokredit."' ORDER BY bayar_ke,angs_tgl;"));

            
               if($datanasabah->saldo_piutang > 0){
            $bayarangsuran = 1; 
        } else {
            $bayarangsuran = 0;
        }
        //denda
        $arr = array(0,0,0,0,0,0,0,0);
        $dataangs = array();
        $tgk = 0;
        //$bayarangsuran = 1;
        foreach($dataangsuran as $key=>$angs){
            if($angs->angs_ke <> ""){
                if($arr[0] == $angs->angs_ke){
                    //if($arr[6] > 3) {
                    if($angs->diff > 3) {
                        //$angs->diff = date_diff(date_create(date('Y-m-d',strtotime($angs->angs_tgl))), date_create(date('Y-m-d',strtotime($arr[5]))))->format('%r%a');
                        //$angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff-$arr[6]);
                        if($arr[6] > 0) {
                            $angs->dendakena = ((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))*abs($angs->diff-$arr[6]);
                        } else {
                            $angs->dendakena = ((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))*abs($angs->diff);
                        }
                    } else {
                        $angs->dendakena = 0;
                    }
                } else {
                    if($angs->diff <= 3){
                        $angs->dendakena = 0;
                    } else {
                        //$angs->dendakena = ceil(((0.5/100)*($angs->angs_pokok+$angs->angs_bunga))/100)*100*abs($angs->diff);
                        $angs->dendakena = ((0.5/100)*($angs->angs_pokok+$angs->angs_bunga))*abs($angs->diff);
                    }
                }
                /*if(($angs->diff <= 3) && ($angs->diff2 <= 3)){
                    $angs->dendakena = 0;
                    $angs->dendakena2 = 0;
                } elseif(($angs->diff <= 3) && ($angs->diff2 > 3)){
                    $angs->dendakena = 0;
                    //$angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga))/100)*100*($angs->diff+$angs->diff2);
                    if($arr[0] == $angs->angs_ke){
                        if((($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga)) > 0){
                            //$angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga))/100)*100*$angs->diff2;
                            $angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga))/100)*100*abs($angs->diff2-);
                        } else {
                            $angs->dendakena2 = 0;
                        }
                    } else {
                        if(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga) > 0){
                            $angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga))/100)*100*$angs->diff2;
                        } else {
                            $angs->dendakena2 = 0;
                        }
                    }
                } else {
                    if($arr[0] == $angs->angs_ke){
                        if($arr[6] > 0){
                            $angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff-$arr[6]);                
                        } else {
                            $angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff);                
                        }
                        //$angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff-$arr[6]);
                        if((($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga)) > 0){
                            $angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga))/100)*100*$angs->diff2;
                        } else {
                            $angs->dendakena2 = 0;
                        }
                    } else {
                        if(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga) > 0){
                            $angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga))/100)*100*$angs->diff2;
                        } else {
                            $angs->dendakena2 = 0;
                        }
                        $angs->dendakena = ceil((0.5/100)*($angs->angs_pokok+$angs->angs_bunga)/100)*100*$angs->diff;
                    }
                }*/
                if($arr[0] == $angs->angs_ke){
                    // if(($angs->pokok+$angs->bunga == 0)){
                    //     $angs->angs_tgl = $arr[5];
                    //     $angs->diff = $arr[6];
                    // }
                    $angs->pokok += $arr[1];
                    $angs->bunga += $arr[2];
                    $angs->denda += $arr[3];
                    $angs->dendakena += $arr[4];
                    $arr[1] = $angs->pokok;
                    $arr[2] = $angs->bunga;
                    $arr[3] = $angs->denda;
                    $arr[4] = $angs->dendakena;
                    $arr[5] = $angs->angs_tgl;
                    $arr[6] = $angs->diff;
                    if($arr[7] < $angs->sld_piutang){
                        $angs->sld_piutang = $arr[7];
                    }
                    $arr[7] = $angs->sld_piutang;
                    if(($tgk == $angs->angs_ke) && (($angs->angs_pokok+$angs->angs_bunga) === ($angs->pokok+$angs->bunga))){
                        $tgk = 0;
                    }
                } else {
                    $arr[0] = $angs->angs_ke;
                    $arr[1] = $angs->pokok;
                    $arr[2] = $angs->bunga;
                    $arr[3] = $angs->denda;
                    $arr[4] = $angs->dendakena;
                    $arr[5] = $angs->angs_tgl;
                    $arr[6] = $angs->diff;
                    $arr[7] = $angs->sld_piutang;
                    if(($tgk == 0) && (($angs->angs_pokok+$angs->angs_bunga) <> ($angs->pokok+$angs->bunga))){
                        $tgk = $angs->bayar_ke;
                    }
                }
            } else {
                if($angs->diff <= 3){
                    $angs->dendakena = 0;
                } else {
                    //$angs->dendakena = ceil((0.5/100)*($angs->angs_pokok+$angs->angs_bunga)/100)*100*$angs->diff;
                    $angs->dendakena = (0.5/100)*($angs->angs_pokok+$angs->angs_bunga)*$angs->diff;
                }
                $angs->dendakena2 = 0;
                if($tgk == 0){
                    $tgk = $angs->bayar_ke;
                }
            }

            if($bayarangsuran === 1){
                $dataangs[$angs->bayar_ke] = $angs;
            } elseif($bayarangsuran === 0) {
                $dataangs[$angs->bayar_ke] = $angs;
                $dataangs[$angs->bayar_ke]->denda = $angs->denda;       
            }
        }
        if(!isset($dataangs[$tgk])){
            $tgk = count($dataangs);
        }
        $totaltunggak = array('pokok'=>0,'bunga'=>0);
        $i = $tgk;
        //if($dataangs[$i]->angs_ke <> ""){
            $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a');
        //}
        if($diff > 0){
            //while ($i <= count($dataangs) && $dataangs[$i]->angs_ke <> "") {
            while ($i <= count($dataangs) && $dataangs[$i]->diff <> null) {
                $dataangs[$i]->sisa_tunggak = ($dataangs[$i]->angs_pokok+$dataangs[$i]->angs_bunga)-($dataangs[$i]->pokok+$dataangs[$i]->bunga);
                $totaltunggak['pokok'] += $dataangs[$i]->angs_pokok-$dataangs[$i]->pokok;
                $totaltunggak['bunga'] += $dataangs[$i]->angs_bunga-$dataangs[$i]->bunga;
                if(($dataangs[$i]->angs_ke <> "") && ($dataangs[$i]->diff < 0)){
                    $dataangs[$i]->dendakena += (0.5/100)*$dataangs[$i]->sisa_tunggak*abs(date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a'));
                } elseif(($dataangs[$i]->angs_ke <> "") && ($dataangs[$i]->diff >= 0)) {
                    $dataangs[$i]->dendakena += (0.5/100)*$dataangs[$i]->sisa_tunggak*abs(date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a')-$dataangs[$i]->diff);
                }
                $i++;
                if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i-1]->tgl_angsur))))->format('%r%a') == 0){
                    $tgkangsur = $i-$tgk-1;
                } else {
                    $tgkangsur = $i-$tgk;
                }
            }
        } else {
            $tgkangsur = 0;
        }
        /*if($dataangs[$i]->diff > 0){
            //while ($i <= count($dataangs) && $dataangs[$i]->angs_ke <> "") {
            while ($i <= count($dataangs) && $dataangs[$i]->diff <> null) {
                $dataangs[$i]->sisa_tunggak = ($dataangs[$i]->angs_pokok+$dataangs[$i]->angs_bunga)-($dataangs[$i]->pokok+$dataangs[$i]->bunga);
                $totaltunggak['pokok'] += $dataangs[$i]->angs_pokok-$dataangs[$i]->pokok;
                $totaltunggak['bunga'] += $dataangs[$i]->angs_bunga-$dataangs[$i]->bunga;
                $dataangs[$i]->diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a');
                if(($dataangs[$i]->angs_ke <> "") && ($dataangs[$i]->diff > 0)){
                    //$dataangs[$i]->dendakena += ceil((0.5/100)*$dataangs[$i]->sisa_tunggak/100)*100*abs(date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))), date_create(date('Y-m-d')))->format('%r%a'));
                    $dataangs[$i]->dendakena += (0.5/100)*$dataangs[$i]->sisa_tunggak*abs(date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))), date_create(date('Y-m-d')))->format('%r%a'));
                }
                $i++;
                if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i-1]->tgl_angsur))))->format('%r%a') == 0){
                    $tgkangsur = $i-$tgk-1;
                } else {
                    $tgkangsur = $i-$tgk;
                }
            }
        } else {
            $tgkangsur = 0;
        }*/
        if(!isset($dataangs[$tgk]->sisa_tunggak)){
            $dataangs[$tgk]->sisa_tunggak = ($dataangs[$tgk]->angs_pokok+$dataangs[$tgk]->angs_bunga)-($dataangs[$tgk]->pokok+$dataangs[$tgk]->pokok);
        }
        if($bayarangsuran === 0){
            $tgkangsur = 0;
            $totaltunggak['pokok'] = 0;
            $totaltunggak['bunga'] = 0;
        }
        $totaldenda = 0;
        foreach($dataangs as $angs){
            // $angs->dendakena += $angs->dendakena2;
            // if(($angs->angs_pokok+$angs->angs_bunga) > ($angs->pokok+$angs->bunga)){
            //     $angs->diff += $angs->diff2;
            // }
            $angs->dendakena = ceil($angs->dendakena/100)*100;
            if($angs->dendakena > 0){
                $totaldenda += $angs->dendakena;
            }
            if($angs->denda <> 0){
                $totaldenda -= $angs->denda;
            }
        }

    }
        return view('kredit.printsample', compact('kredit','dataangs','datanasabah','tgk','totaldenda','nasabahbayar','jadwal','lihat8'));
    }

 public function printbanding($tahun,$kantor,$nourut)
    {
        // $nasabahbayar = $pembayaran;
        $nokredit = $tahun.'/'.$kantor.'/'.$nourut;
        $tgl = date('Y-m-d');
        // $tgk = $request->input('tgk');

        $sql8 ="SELECT mst_dati2.desc1,mst_dati2.desc2,nasabah.dati2,nasabah.no_nsb,prekredit.no_nsb
                from mst_dati2,prekredit,nasabah
                where nasabah.no_nsb = prekredit.no_nsb and prekredit.no_kredit='".$nokredit."' 
                AND 
                mst_dati2.desc1=nasabah.dati2";
        $lihat8 = DB::connection('pgsql')->select(DB::raw($sql8));

        //$jadwal = AngsJadwal::where('no_kredit',$nokredit)->orderBy('bayar_ke','asc')->get();
        $kredit = kredit::where('no_kredit',$nokredit)->first();
        if(trim($kredit->sistem,' ') != 'RK'){
          
        $datanasabah = DB::connection('pgsql')->select(DB::raw("SELECT kredit.no_kredit,tgl_kredit,sistem,no_ref,nama,plafon,pinj_prsbunga,bbt,saldo_piutang,sistem,lama,tgl_mulai,tgl_lunas,jatuhtempo,alamat,rtrw,desa,camat,kodya,notelp,nohp,angsuran_jadwal.angs_pokok,angsuran_jadwal.angs_bunga FROM kredit,prekredit,angsuran_jadwal WHERE kredit.no_kredit = '".$nokredit."' AND kredit.no_kredit=prekredit.no_kredit AND kredit.no_kredit=angsuran_jadwal.no_kredit;"))[0];
        $dataangsuran = DB::connection('pgsql')->select(DB::raw("SELECT aj.no_kredit,bayar_ke,angs_ke,tgl_angsur,angs_tgl,transfer_tgl,pot_bunga,
                                                                CASE
                                                                  WHEN ('".date('Y-m-d',strtotime($tgl))."' > tgl_angsur AND angs_tgl IS NULL) THEN DATE_PART('day', '".date('Y-m-d',strtotime($tgl))."' - tgl_angsur::timestamp)
                                                                  ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
                                                                END as diff,angs_nobukti,bunga_sldbbt,bakidebet,sld_piutang,aj.angs_pokok,aj.angs_bunga,pokok,bunga,denda
                                                                FROM angsuran_jadwal aj LEFT OUTER JOIN (SELECT no_kredit,angs_nobukti,angs_ke,denda,bunga_sldbbt,bakidebet,sld_piutang,(angs_titippokok+angs_pokok) as pokok,(angs_titipbunga+angs_bunga) as bunga,angs_tgl,transfer_tgl FROM angsuran_kartu ORDER BY angs_ke) as ak ON ak.no_kredit = aj.no_kredit AND angs_ke = bayar_ke
                                                                WHERE aj.no_kredit='".$nokredit."' ORDER BY bayar_ke,angs_tgl;"));

            
        if($datanasabah->saldo_piutang > 0){
            $bayarangsuran = 1; 
        } else {
            $bayarangsuran = 0;
        }
        //denda
        $arr = array(0,0,0,0,0,0,0,0);
        $dataangs = array();
        $tgk = 0;
        //$bayarangsuran = 1;
        foreach($dataangsuran as $key=>$angs){
            if($angs->angs_ke <> ""){
                if($arr[0] == $angs->angs_ke){
                    //if($arr[6] > 3) {
                    if($angs->diff > 3) {
                        //$angs->diff = date_diff(date_create(date('Y-m-d',strtotime($angs->angs_tgl))), date_create(date('Y-m-d',strtotime($arr[5]))))->format('%r%a');
                        //$angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff-$arr[6]);
                        $angs->dendakena = ((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))*abs($angs->diff-$arr[6]);
                    } else {
                        $angs->dendakena = 0;
                    }
                } else {
                    if($angs->diff <= 3){
                        $angs->dendakena = 0;
                    } else {
                        //$angs->dendakena = ceil(((0.5/100)*($angs->angs_pokok+$angs->angs_bunga))/100)*100*abs($angs->diff);
                        $angs->dendakena = ((0.5/100)*($angs->angs_pokok+$angs->angs_bunga))*abs($angs->diff);
                    }
                }
               
                if($arr[0] == $angs->angs_ke){
                    // if(($angs->pokok+$angs->bunga == 0)){
                    //     $angs->angs_tgl = $arr[5];
                    //     $angs->diff = $arr[6];
                    // }
                    $angs->pokok += $arr[1];
                    $angs->bunga += $arr[2];
                    $angs->denda += $arr[3];
                    $angs->dendakena += $arr[4];
                    $arr[1] = $angs->pokok;
                    $arr[2] = $angs->bunga;
                    $arr[3] = $angs->denda;
                    $arr[4] = $angs->dendakena;
                    $arr[5] = $angs->angs_tgl;
                    $arr[6] = $angs->diff;
                    if($arr[7] < $angs->sld_piutang){
                        $angs->sld_piutang = $arr[7];
                    }
                    $arr[7] = $angs->sld_piutang;
                    if(($tgk == $angs->angs_ke) && (($angs->angs_pokok+$angs->angs_bunga) === ($angs->pokok+$angs->bunga))){
                        $tgk = 0;
                    }
                } else {
                    $arr[0] = $angs->angs_ke;
                    $arr[1] = $angs->pokok;
                    $arr[2] = $angs->bunga;
                    $arr[3] = $angs->denda;
                    $arr[4] = $angs->dendakena;
                    $arr[5] = $angs->angs_tgl;
                    $arr[6] = $angs->diff;
                    $arr[7] = $angs->sld_piutang;
                    if(($tgk == 0) && (($angs->angs_pokok+$angs->angs_bunga) <> ($angs->pokok+$angs->bunga))){
                        $tgk = $angs->bayar_ke;
                    }
                }
            } else {
                if($angs->diff <= 3){
                    $angs->dendakena = 0;
                } else {
                    //$angs->dendakena = ceil((0.5/100)*($angs->angs_pokok+$angs->angs_bunga)/100)*100*$angs->diff;
                    $angs->dendakena = (0.5/100)*($angs->angs_pokok+$angs->angs_bunga)*$angs->diff;
                }
                $angs->dendakena2 = 0;
                if($tgk == 0){
                    $tgk = $angs->bayar_ke;
                }
            }
            if($bayarangsuran === 1){
                $dataangs[$angs->bayar_ke] = $angs;
            } elseif($bayarangsuran === 0) {
                $dataangs[$angs->bayar_ke] = $angs;
                $dataangs[$angs->bayar_ke]->denda = $angs->denda;       
            }
        }
        if(!isset($dataangs[$tgk])){
            $tgk = count($dataangs);
        }
        $totaltunggak = array('pokok'=>0,'bunga'=>0);
        $i = $tgk;
        if($dataangs[$i]->diff > 0){
            //while ($i <= count($dataangs) && $dataangs[$i]->angs_ke <> "") {
            while ($i <= count($dataangs) && $dataangs[$i]->diff <> null) {
                $dataangs[$i]->sisa_tunggak = ($dataangs[$i]->angs_pokok+$dataangs[$i]->angs_bunga)-($dataangs[$i]->pokok+$dataangs[$i]->bunga);
                $totaltunggak['pokok'] += $dataangs[$i]->angs_pokok-$dataangs[$i]->pokok;
                $totaltunggak['bunga'] += $dataangs[$i]->angs_bunga-$dataangs[$i]->bunga;
                $dataangs[$i]->diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a');
                if($dataangs[$i]->angs_ke <> ""){
                    //$dataangs[$i]->dendakena += ceil((0.5/100)*$dataangs[$i]->sisa_tunggak/100)*100*abs(date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))), date_create(date('Y-m-d')))->format('%r%a'));
                    $dataangs[$i]->dendakena += (0.5/100)*$dataangs[$i]->sisa_tunggak*abs(date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))), date_create(date('Y-m-d')))->format('%r%a'));
                }
                $i++;
                if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i-1]->tgl_angsur))))->format('%r%a') == 0){
                    $tgkangsur = $i-$tgk-1;
                } else {
                    $tgkangsur = $i-$tgk;
                }
            }
        } else {
            $tgkangsur = 0;
        }
        if(!isset($dataangs[$tgk]->sisa_tunggak)){
            $dataangs[$tgk]->sisa_tunggak = ($dataangs[$tgk]->angs_pokok+$dataangs[$tgk]->angs_bunga)-($dataangs[$tgk]->pokok+$dataangs[$tgk]->pokok);
        }
        if($bayarangsuran === 0){
            $tgkangsur = 0;
            $totaltunggak['pokok'] = 0;
            $totaltunggak['bunga'] = 0;
        }
        $totaldenda = 0;

        foreach($dataangs as $angs2){
            // $angs->dendakena += $angs->dendakena2;
            // if(($angs->angs_pokok+$angs->angs_bunga) > ($angs->pokok+$angs->bunga)){
            //     $angs->diff += $angs->diff2;
            // }
            $angs2->dendakena = ($angs2->dendakena/100)*100;
            if($angs2->dendakena > 0){
                $totaldenda += $angs2->dendakena;
            }
            if($angs2->denda <> 0){
                $totaldenda -= $angs2->denda;
            }
        }

        foreach($dataangs as $angs){
            // $angs->dendakena += $angs->dendakena2;
            // if(($angs->angs_pokok+$angs->angs_bunga) > ($angs->pokok+$angs->bunga)){
            //     $angs->diff += $angs->diff2;
            // }
            $angs->dendakena = ceil($angs->dendakena/100)*100;
            if($angs->dendakena > 0){
                $totaldenda += $angs->dendakena;
            }
            if($angs->denda <> 0){
                $totaldenda -= $angs->denda;
            }
        }

        

        }
        return view('kredit.perbandingan', compact('kredit','dataangs','datanasabah','tgk','totaldenda','nasabahbayar','jadwal','lihat8'));
    }
     public function printJadwal($tahun,$kantor,$nourut)
    {
        // $nasabahbayar = $pembayaran;
        $nokredit = $tahun.'/'.$kantor.'/'.$nourut;

        $sql8 ="SELECT mst_dati2.desc1,mst_dati2.desc2,nasabah.dati2,nasabah.no_nsb,prekredit.no_nsb
                from mst_dati2,prekredit,nasabah
                where nasabah.no_nsb = prekredit.no_nsb and prekredit.no_kredit='".$nokredit."' 
                AND 
                mst_dati2.desc1=nasabah.dati2";
        $lihat8 = DB::connection('pgsql')->select(DB::raw($sql8));

        $jadwal = AngsJadwal::where('no_kredit',$nokredit)->orderBy('bayar_ke','asc')->get();

        $datanasabah = DB::connection('pgsql')->select(DB::raw("SELECT kredit.no_kredit,tgl_kredit,sistem,no_ref,pinj_pokok,nama,plafon,pinj_prsbunga,bbt,saldo_piutang,sistem,lama,tgl_mulai,tgl_akhir,jatuhtempo,tgl_lunas,alamat,rtrw,desa,camat,kodya,notelp,nohp,angsuran_jadwal.angs_pokok,angsuran_jadwal.angs_bunga,angsuran_jadwal.bayar_ke FROM kredit,prekredit,angsuran_jadwal WHERE kredit.no_kredit = '".$nokredit."' AND kredit.no_kredit=prekredit.no_kredit AND kredit.no_kredit=angsuran_jadwal.no_kredit;"))[0];

        

        $dataangsuran = DB::connection('pgsql')->select(DB::raw("SELECT aj.no_kredit,bayar_ke,angs_ke,tgl_angsur,sal_pokok, angs_tgl,DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp) as diff,angs_nobukti,aj.angs_pokok,aj.angs_bunga,pokok,bunga,denda,spokok,sbbt
                                                                FROM angsuran_jadwal aj LEFT OUTER JOIN (SELECT no_kredit,angs_nobukti,angs_ke,denda,(angs_titippokok+angs_pokok) as pokok,(angs_titipbunga+angs_bunga) as bunga,angs_tgl, ((angs_titippokok+angs_pokok)) as spokok, (plafon*((angs_titipbunga+angs_bunga)/12)) as sbbt FROM angsuran_kartu ORDER BY angs_ke) as ak ON ak.no_kredit = aj.no_kredit AND angs_ke = bayar_ke
                                                                WHERE aj.no_kredit='".$nokredit."' ORDER BY bayar_ke,angs_tgl;"));
        if($datanasabah->saldo_piutang > 0){
                $bayarangsuran = 1;
            } else {
                $bayarangsuran = 0;
            }
            //denda
            $arr = array(0,0,0,0,0);
            $dataangs = array();
            $tgk = 0;

            foreach($dataangsuran as $key=>$angs){
                if($angs->angs_ke <> ""){
                    if($angs->diff <= 3){
                        $angs->dendakena = 0;
                    } else {
                        if($arr[0] == $angs->angs_ke){
                            $diff = date_diff(date_create(date('Y-m-d',strtotime($angs->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$angs->angs_ke]->angs_tgl))))->format('%r%a');
                            $angs->dendakena = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]))/100)*100*abs($diff);        
                        } else {
                            $angs->dendakena = ceil((0.5/100)*($angs->angs_pokok+$angs->angs_bunga)/100)*100*$angs->diff;
                        }
                    }
                    if($arr[0] == $angs->angs_ke){
                        $angs->pokok += $arr[1];
                        $angs->bunga += $arr[2];
                        $angs->denda += $arr[3];
                        $angs->dendakena += $arr[4];
                        $arr[1] = $angs->pokok;
                        $arr[2] = $angs->bunga;
                        $arr[3] = $angs->denda;
                        $arr[4] = $angs->dendakena;
                    } else {
                        $arr[0] = $angs->angs_ke;
                        $arr[1] = $angs->pokok;
                        $arr[2] = $angs->bunga;
                        $arr[3] = $angs->denda;
                        $arr[4] = $angs->dendakena;
                    }
                    if(($tgk == 0) && (($angs->angs_pokok+$angs->angs_bunga) <> ($angs->pokok+$angs->bunga))){
                        $tgk = $angs->bayar_ke;
                    }
                } else {
                    $angs->dendakena = 0;
                    if($tgk == 0){
                        $tgk = $angs->bayar_ke;
                    }
                }
                if($bayarangsuran === 1){
                    $dataangs[$angs->bayar_ke] = $angs;
                } elseif($bayarangsuran === 0) {
                    if(!isset($dataangs[$angs->bayar_ke])){
                        $dataangs[$angs->bayar_ke] = $angs;
                    }
                    $dataangs[$angs->bayar_ke]->denda = $angs->denda;
                    
                }
            }
            if(!isset($dataangs[$tgk])){
                $tgk = count($dataangs);
            }
                $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$tgk]->tgl_angsur))))->format('%r%a');
                if($diff < 0){
                    if(isset($dataangs[$tgk-1])){
                        $dataangs[$tgk]->tunggak = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$tgk-1]->tgl_angsur))))->format('%r%a');    
                    } else {
                        $dataangs[$tgk]->tunggak = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($datanasabah->tgl_kredit))))->format('%r%a');    
                    }
                } else {
                    $dataangs[$tgk]->tunggak = 0;
                }
                $i = $tgk;
                if($dataangs[$i]->angs_tgl <> ""){
                    if(strtotime(date('Y-m-d')) < strtotime($dataangs[$i]->tgl_angsur)){
                        $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$tgk]->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$tgk]->tgl_angsur))))->format('%r%a');
                    } else {
                        $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$tgk]->angs_tgl))))->format('%r%a');
                    }
                }
                $totaltunggak = array('pokok'=>0,'bunga'=>0);
                
                if($diff <= 0){
                    while ($diff <= 0) {
                        $dataangs[$i]->sisa_tunggak = ($dataangs[$i]->angs_pokok+$dataangs[$i]->angs_bunga)-($dataangs[$i]->pokok+$dataangs[$i]->bunga);
                        $totaltunggak['pokok'] += $dataangs[$i]->angs_pokok-$dataangs[$i]->pokok;
                        $totaltunggak['bunga'] += $dataangs[$i]->angs_bunga-$dataangs[$i]->bunga;
                        if($diff < -3){
                            $dataangs[$i]->dendakena += ceil((0.5/100)*$dataangs[$i]->sisa_tunggak/100)*100*abs($diff);
                        } else {
                            $dataangs[$i]->dendakena += 0;
                        }
                        $i++;
                        if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i-1]->tgl_angsur))))->format('%r%a') == 0){
                            $tgkangsur = $i-$tgk-1;
                        } else {
                            $tgkangsur = $i-$tgk;
                        }
                        if(isset($dataangs[$i])){
                            if($dataangs[$i]->angs_tgl <> ""){
                                if(strtotime(date('Y-m-d')) < strtotime($dataangs[$i]->tgl_angsur)){
                                    $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))))->format('%r%a');
                                } else {
                                    $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))))->format('%r%a');
                                }
                            } else {
                                $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))))->format('%r%a');
                            }
                        } else {
                            break;
                        }
                    }
                } else {
                    $tgkangsur = 0;
                }
                if(!isset($dataangs[$tgk]->sisa_tunggak)){
                    $dataangs[$tgk]->sisa_tunggak = ($dataangs[$tgk]->angs_pokok+$dataangs[$tgk]->angs_bunga)-($dataangs[$tgk]->pokok+$dataangs[$tgk]->pokok);
                }
            if($bayarangsuran === 0){
                $tgkangsur = 0;
                $totaltunggak['pokok'] = 0;
                $totaltunggak['bunga'] = 0;
            }
            $totaldenda = 0;
            foreach($dataangs as $angs){
                if($angs->dendakena <> 0){
                    $totaldenda += $angs->dendakena;
                }
                if($angs->denda <> 0){
                    $totaldenda -= $angs->denda;
                }
            }

            // hitung saldo
            // $spokok     = 0;
            // $sbbt       = 0;
            // $spiutang   = 0;
            // foreach($dataangsuran as $db){
            // $spokok -= $db->spokok;
            // $sbbt -= $db->sbbt;
            // $spiutang -= $db->spokok+$db->sbbt;
            //  }

        return view('kredit.printjadwal', compact('dataangs','datanasabah','tgk','totaldenda','nasabahbayar','jadwal','lastday','bulan','tahun','spokok','sbbt','spiutang','lihat8'));
    }

    public function printKartu($tahun,$kantor,$nourut)
    {
        // $nasabahbayar = $pembayaran;
        $nokredit = $tahun.'/'.$kantor.'/'.$nourut;

        $sql8 ="SELECT mst_dati2.desc1,mst_dati2.desc2,nasabah.dati2,nasabah.no_nsb,prekredit.no_nsb
                from mst_dati2,prekredit,nasabah
                where nasabah.no_nsb = prekredit.no_nsb and prekredit.no_kredit='".$nokredit."' 
                AND 
                mst_dati2.desc1=nasabah.dati2";
        $lihat8 = DB::connection('pgsql')->select(DB::raw($sql8));

        $jadwal = AngsJadwal::where('no_kredit',$nokredit)->orderBy('bayar_ke','asc')->get();

        $datanasabah = DB::connection('pgsql')->select(DB::raw("SELECT kredit.no_kredit,tgl_kredit,sistem,no_ref,nama,plafon,pinj_prsbunga,bbt,saldo_piutang,sistem,lama,tgl_mulai,tgl_lunas,jatuhtempo,alamat,rtrw,desa,camat,kodya,notelp,nohp,angsuran_jadwal.angs_pokok,angsuran_jadwal.angs_bunga FROM kredit,prekredit,angsuran_jadwal WHERE kredit.no_kredit = '".$nokredit."' AND kredit.no_kredit=prekredit.no_kredit AND kredit.no_kredit=angsuran_jadwal.no_kredit;"))[0];
        
        $dataangsuran = DB::connection('pgsql')->select(DB::raw("SELECT aj.no_kredit,bayar_ke,angs_ke,tgl_angsur,sal_pokok, angs_tgl,DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp) as diff,angs_nobukti,aj.angs_pokok,aj.angs_bunga,pokok,bunga,denda,spokok,sbbt
                                                                FROM angsuran_jadwal aj LEFT OUTER JOIN (SELECT no_kredit,angs_nobukti,angs_ke,denda,(angs_titippokok+angs_pokok) as pokok,(angs_titipbunga+angs_bunga) as bunga,angs_tgl, ((angs_titippokok+angs_pokok)) as spokok, (plafon*((angs_titipbunga+angs_bunga)/12)) as sbbt FROM angsuran_kartu ORDER BY angs_ke) as ak ON ak.no_kredit = aj.no_kredit AND angs_ke = bayar_ke
                                                                WHERE aj.no_kredit='".$nokredit."' ORDER BY bayar_ke,angs_tgl;"));
        if($datanasabah->saldo_piutang > 0){
                $bayarangsuran = 1;
            } else {
                $bayarangsuran = 0;
            }
            //denda
            $arr = array(0,0,0,0,0);
            $dataangs = array();
            $tgk = 0;

            foreach($dataangsuran as $key=>$angs){
                if($angs->angs_ke <> ""){
                    if($angs->diff <= 3){
                        $angs->dendakena = 0;
                    } else {
                        if($arr[0] == $angs->angs_ke){
                            $diff = date_diff(date_create(date('Y-m-d',strtotime($angs->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$angs->angs_ke]->angs_tgl))))->format('%r%a');
                            $angs->dendakena = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]))/100)*100*abs($diff);        
                        } else {
                            $angs->dendakena = ceil((0.5/100)*($angs->angs_pokok+$angs->angs_bunga)/100)*100*$angs->diff;
                        }
                    }
                    if($arr[0] == $angs->angs_ke){
                        $angs->pokok += $arr[1];
                        $angs->bunga += $arr[2];
                        $angs->denda += $arr[3];
                        $angs->dendakena += $arr[4];
                        $arr[1] = $angs->pokok;
                        $arr[2] = $angs->bunga;
                        $arr[3] = $angs->denda;
                        $arr[4] = $angs->dendakena;
                    } else {
                        $arr[0] = $angs->angs_ke;
                        $arr[1] = $angs->pokok;
                        $arr[2] = $angs->bunga;
                        $arr[3] = $angs->denda;
                        $arr[4] = $angs->dendakena;
                    }
                    if(($tgk == 0) && (($angs->angs_pokok+$angs->angs_bunga) <> ($angs->pokok+$angs->bunga))){
                        $tgk = $angs->bayar_ke;
                    }
                } else {
                    $angs->dendakena = 0;
                    if($tgk == 0){
                        $tgk = $angs->bayar_ke;
                    }
                }
                if($bayarangsuran === 1){
                    $dataangs[$angs->bayar_ke] = $angs;
                } elseif($bayarangsuran === 0) {
                    if(!isset($dataangs[$angs->bayar_ke])){
                        $dataangs[$angs->bayar_ke] = $angs;
                    }
                    $dataangs[$angs->bayar_ke]->denda = $angs->denda;
                    
                }
            }
            if(!isset($dataangs[$tgk])){
                $tgk = count($dataangs);
            }
                $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$tgk]->tgl_angsur))))->format('%r%a');
                if($diff < 0){
                    if(isset($dataangs[$tgk-1])){
                        $dataangs[$tgk]->tunggak = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$tgk-1]->tgl_angsur))))->format('%r%a');    
                    } else {
                        $dataangs[$tgk]->tunggak = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($datanasabah->tgl_kredit))))->format('%r%a');    
                    }
                } else {
                    $dataangs[$tgk]->tunggak = 0;
                }
                $i = $tgk;
                if($dataangs[$i]->angs_tgl <> ""){
                    if(strtotime(date('Y-m-d')) < strtotime($dataangs[$i]->tgl_angsur)){
                        $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$tgk]->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$tgk]->tgl_angsur))))->format('%r%a');
                    } else {
                        $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$tgk]->angs_tgl))))->format('%r%a');
                    }
                }
                $totaltunggak = array('pokok'=>0,'bunga'=>0);
                
                if($diff <= 0){
                    while ($diff <= 0) {
                        $dataangs[$i]->sisa_tunggak = ($dataangs[$i]->angs_pokok+$dataangs[$i]->angs_bunga)-($dataangs[$i]->pokok+$dataangs[$i]->bunga);
                        $totaltunggak['pokok'] += $dataangs[$i]->angs_pokok-$dataangs[$i]->pokok;
                        $totaltunggak['bunga'] += $dataangs[$i]->angs_bunga-$dataangs[$i]->bunga;
                        if($diff < -3){
                            $dataangs[$i]->dendakena += ceil((0.5/100)*$dataangs[$i]->sisa_tunggak/100)*100*abs($diff);
                        } else {
                            $dataangs[$i]->dendakena += 0;
                        }
                        $i++;
                        if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i-1]->tgl_angsur))))->format('%r%a') == 0){
                            $tgkangsur = $i-$tgk-1;
                        } else {
                            $tgkangsur = $i-$tgk;
                        }
                        if(isset($dataangs[$i])){
                            if($dataangs[$i]->angs_tgl <> ""){
                                if(strtotime(date('Y-m-d')) < strtotime($dataangs[$i]->tgl_angsur)){
                                    $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))))->format('%r%a');
                                } else {
                                    $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))))->format('%r%a');
                                }
                            } else {
                                $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))))->format('%r%a');
                            }
                        } else {
                            break;
                        }
                    }
                } else {
                    $tgkangsur = 0;
                }
                if(!isset($dataangs[$tgk]->sisa_tunggak)){
                    $dataangs[$tgk]->sisa_tunggak = ($dataangs[$tgk]->angs_pokok+$dataangs[$tgk]->angs_bunga)-($dataangs[$tgk]->pokok+$dataangs[$tgk]->pokok);
                }
            if($bayarangsuran === 0){
                $tgkangsur = 0;
                $totaltunggak['pokok'] = 0;
                $totaltunggak['bunga'] = 0;
            }
            $totaldenda = 0;
            foreach($dataangs as $angs){
                if($angs->dendakena <> 0){
                    $totaldenda += $angs->dendakena;
                }
                if($angs->denda <> 0){
                    $totaldenda -= $angs->denda;
                }
            }
    // }

        return view('kredit.printkartu', compact('dataangs','datanasabah','tgk','totaldenda','nasabahbayar','jadwal','lihat8'));
    }

    public function printBayar($tahun,$kantor,$nourut)
    {
        // $nasabahbayar = $pembayaran;
        $nokredit = $tahun.'/'.$kantor.'/'.$nourut;

        $sql8 ="SELECT mst_dati2.desc1,mst_dati2.desc2,nasabah.dati2,nasabah.no_nsb,prekredit.no_nsb
                from mst_dati2,prekredit,nasabah
                where nasabah.no_nsb = prekredit.no_nsb and prekredit.no_kredit='".$nokredit."' 
                AND 
                mst_dati2.desc1=nasabah.dati2";
        $lihat8 = DB::connection('pgsql')->select(DB::raw($sql8));

        $jadwal = AngsJadwal::where('no_kredit',$nokredit)->orderBy('bayar_ke','asc')->get();
        // $sumtotal = kredit::where('no_kredit',$nokredit)->get();
        // ,kredit.pinj_pokok,kredit.bakidebet,kredit.bbt,kredit.saldo_bbt

        $datanasabah = DB::connection('pgsql')->select(DB::raw("SELECT kredit.no_kredit,tgl_kredit,pinj_pokok,bakidebet,bbt,saldo_bbt,sistem,no_ref,nama,plafon,pinj_prsbunga,bbt,saldo_piutang,sistem,lama,tgl_mulai,tgl_lunas,jatuhtempo,alamat,rtrw,desa,camat,kodya,notelp,nohp,angsuran_jadwal.angs_pokok,angsuran_jadwal.angs_bunga FROM kredit,prekredit,angsuran_jadwal WHERE kredit.no_kredit = '".$nokredit."' AND kredit.no_kredit=prekredit.no_kredit AND kredit.no_kredit=angsuran_jadwal.no_kredit;"))[0];
        
        $dataangsuran = DB::connection('pgsql')->select(DB::raw("SELECT aj.no_kredit,bayar_ke,angs_ke,tgl_angsur,angs_tgl,DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp) as diff,angs_nobukti,aj.angs_pokok,aj.angs_bunga,pokok,bunga,denda
                                                                FROM angsuran_jadwal aj LEFT OUTER JOIN (SELECT no_kredit,angs_nobukti,angs_ke,denda,(angs_titippokok+angs_pokok) as pokok,(angs_titipbunga+angs_bunga) as bunga,angs_tgl FROM angsuran_kartu ORDER BY angs_ke) as ak ON ak.no_kredit = aj.no_kredit AND angs_ke = bayar_ke
                                                                WHERE aj.no_kredit='".$nokredit."' ORDER BY bayar_ke,angs_tgl;"));
        if($datanasabah->saldo_piutang > 0){
                $bayarangsuran = 1;
            } else {
                $bayarangsuran = 0;
            }
            //denda
            $arr = array(0,0,0,0,0);
            $dataangs = array();
            $tgk = 0;

            foreach($dataangsuran as $key=>$angs){
                if($angs->angs_ke <> ""){
                    if($angs->diff <= 3){
                        $angs->dendakena = 0;
                    } else {
                        if($arr[0] == $angs->angs_ke){
                            $diff = date_diff(date_create(date('Y-m-d',strtotime($angs->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$angs->angs_ke]->angs_tgl))))->format('%r%a');
                            $angs->dendakena = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]))/100)*100*abs($diff);        
                        } else {
                            $angs->dendakena = ceil((0.5/100)*($angs->angs_pokok+$angs->angs_bunga)/100)*100*$angs->diff;
                        }
                    }
                    if($arr[0] == $angs->angs_ke){
                        $angs->pokok += $arr[1];
                        $angs->bunga += $arr[2];
                        $angs->denda += $arr[3];
                        $angs->dendakena += $arr[4];
                        $arr[1] = $angs->pokok;
                        $arr[2] = $angs->bunga;
                        $arr[3] = $angs->denda;
                        $arr[4] = $angs->dendakena;
                    } else {
                        $arr[0] = $angs->angs_ke;
                        $arr[1] = $angs->pokok;
                        $arr[2] = $angs->bunga;
                        $arr[3] = $angs->denda;
                        $arr[4] = $angs->dendakena;
                    }
                    if(($tgk == 0) && (($angs->angs_pokok+$angs->angs_bunga) <> ($angs->pokok+$angs->bunga))){
                        $tgk = $angs->bayar_ke;
                    }
                } else {
                    $angs->dendakena = 0;
                    if($tgk == 0){
                        $tgk = $angs->bayar_ke;
                    }
                }
                if($bayarangsuran === 1){
                    $dataangs[$angs->bayar_ke] = $angs;
                } elseif($bayarangsuran === 0) {
                    if(!isset($dataangs[$angs->bayar_ke])){
                        $dataangs[$angs->bayar_ke] = $angs;
                    }
                    $dataangs[$angs->bayar_ke]->denda = $angs->denda;
                    
                }
            }
            if(!isset($dataangs[$tgk])){
                $tgk = count($dataangs);
            }
                $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$tgk]->tgl_angsur))))->format('%r%a');
                if($diff < 0){
                    if(isset($dataangs[$tgk-1])){
                        $dataangs[$tgk]->tunggak = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$tgk-1]->tgl_angsur))))->format('%r%a');    
                    } else {
                        $dataangs[$tgk]->tunggak = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($datanasabah->tgl_kredit))))->format('%r%a');    
                    }
                } else {
                    $dataangs[$tgk]->tunggak = 0;
                }
                $i = $tgk;
                if($dataangs[$i]->angs_tgl <> ""){
                    if(strtotime(date('Y-m-d')) < strtotime($dataangs[$i]->tgl_angsur)){
                        $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$tgk]->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$tgk]->tgl_angsur))))->format('%r%a');
                    } else {
                        $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$tgk]->angs_tgl))))->format('%r%a');
                    }
                }
                $totaltunggak = array('pokok'=>0,'bunga'=>0);
                
                if($diff <= 0){
                    while ($diff <= 0) {
                        $dataangs[$i]->sisa_tunggak = ($dataangs[$i]->angs_pokok+$dataangs[$i]->angs_bunga)-($dataangs[$i]->pokok+$dataangs[$i]->bunga);
                        $totaltunggak['pokok'] += $dataangs[$i]->angs_pokok-$dataangs[$i]->pokok;
                        $totaltunggak['bunga'] += $dataangs[$i]->angs_bunga-$dataangs[$i]->bunga;
                        if($diff < -3){
                            $dataangs[$i]->dendakena += ceil((0.5/100)*$dataangs[$i]->sisa_tunggak/100)*100*abs($diff);
                        } else {
                            $dataangs[$i]->dendakena += 0;
                        }
                        $i++;
                        if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i-1]->tgl_angsur))))->format('%r%a') == 0){
                            $tgkangsur = $i-$tgk-1;
                        } else {
                            $tgkangsur = $i-$tgk;
                        }
                        if(isset($dataangs[$i])){
                            if($dataangs[$i]->angs_tgl <> ""){
                                if(strtotime(date('Y-m-d')) < strtotime($dataangs[$i]->tgl_angsur)){
                                    $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))), date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))))->format('%r%a');
                                } else {
                                    $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))))->format('%r%a');
                                }
                            } else {
                                $diff = date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))))->format('%r%a');
                            }
                        } else {
                            break;
                        }
                    }
                } else {
                    $tgkangsur = 0;
                }
                if(!isset($dataangs[$tgk]->sisa_tunggak)){
                    $dataangs[$tgk]->sisa_tunggak = ($dataangs[$tgk]->angs_pokok+$dataangs[$tgk]->angs_bunga)-($dataangs[$tgk]->pokok+$dataangs[$tgk]->pokok);
                }
            if($bayarangsuran === 0){
                $tgkangsur = 0;
                $totaltunggak['pokok'] = 0;
                $totaltunggak['bunga'] = 0;
            }
            $totaldenda = 0;
            foreach($dataangs as $angs){
                if($angs->dendakena <> 0){
                    $totaldenda += $angs->dendakena;
                }
                if($angs->denda <> 0){
                    $totaldenda -= $angs->denda;
                }
            }

        return view('kredit.printbayar', compact('dataangs','datanasabah','tgk','totaldenda','nasabahbayar','jadwal','sum','sumtotal','lihat8'));
    }

    public function viewDafNasabah(Request $request,$kol=null,$key=null)
    {
        $kolom = $kol;
        $kunci = strtoupper($key);

        $page = (Input::get('page')) ? Input::get('page') : 1; // Get the current page for the request
        $limit = 20;
        $offset = ($page-1) * $limit;

        $sql = "SELECT kredit.no_kredit,prekredit.no_nsb,no_ref,sistem,tgl_mulai,tgl_akhir,saldo_piutang,pinj_pokok,nama,ak.ke,tgl_lunas FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                FROM angsuran_kartu GROUP BY no_kredit) as ak RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit
                WHERE ";
        if(($kolom <> null) && ($key <> null)){
            $sql .= $kolom." LIKE '%".$kunci."%' AND kredit.no_kredit=prekredit.no_kredit order by saldo_piutang DESC";
        } else {
            $sql .= "kredit.no_kredit=prekredit.no_kredit order by saldo_piutang DESC";
        }
        $total = count(DB::connection('pgsql')->select(DB::raw($sql.";")));
        
        $nsblist = DB::connection('pgsql')->select(DB::raw($sql." LIMIT ".$limit." OFFSET ".$offset.";"));

        $pagination = new Paginator($nsblist, $total, $limit,$page,array("path" => url('/dafnasabah/'.$kolom.'/'.$key)));

        $url = url('/dafnasabah/');

        return view('kredit.daftarnasabah', compact('nsblist','pagination'));
    }

    public function viewSimAngsuran($nokredit)
    {
        //$nokredit = $tahun.'/'.$kantor.'/'.$nourut;
        $tgl = date('Y-m-d');

        $datanasabah = DB::connection('pgsql')->select(DB::raw("SELECT kredit.no_kredit,tgl_kredit,sistem,no_ref,nama,alamat,lama,pinj_prsbunga,tgl_mulai,tgl_akhir,notelp,plafon,bbt,bakidebet,saldo_bbt,saldo_piutang,tgl_lunas FROM kredit,prekredit WHERE kredit.no_kredit = '".$nokredit."' AND kredit.no_kredit=prekredit.no_kredit;"))[0];
        // $dataangsuran = DB::connection('pgsql')->select(DB::raw("SELECT aj.no_kredit,bayar_ke,angs_ke,tgl_angsur,angs_tgl,transfer_tgl,pot_bunga,
        //                                                         CASE
        //                                                           WHEN ('".date('Y-m-d')."' > tgl_angsur AND angs_tgl IS NULL) THEN DATE_PART('day', '".date('Y-m-d')."' - tgl_angsur::timestamp)
        //                                                           ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
        //                                                         END as diff,angs_nobukti,bunga_sldbbt,bakidebet,sld_piutang,aj.angs_pokok,aj.angs_bunga,pokok,bunga,denda,
        //                                                         CASE
        //                                                             WHEN ((pokok+bunga) < (aj.angs_pokok+aj.angs_bunga) AND angs_tgl >= tgl_angsur) THEN DATE_PART('day', '".date('Y-m-d')."' - angs_tgl::timestamp)
        //                                                             WHEN ((pokok+bunga) < (aj.angs_pokok+aj.angs_bunga) AND angs_tgl < tgl_angsur) THEN DATE_PART('day', '".date('Y-m-d')."' - tgl_angsur::timestamp)
        //                                                             ELSE 0
        //                                                         END as diff2
        //                                                         FROM angsuran_jadwal aj LEFT OUTER JOIN (SELECT no_kredit,angs_nobukti,angs_ke,denda,bunga_sldbbt,bakidebet,sld_piutang,(angs_titippokok+angs_pokok) as pokok,(angs_titipbunga+angs_bunga) as bunga,angs_tgl,transfer_tgl FROM angsuran_kartu ORDER BY angs_ke) as ak ON ak.no_kredit = aj.no_kredit AND angs_ke = bayar_ke
        //                                                         WHERE aj.no_kredit='".$nokredit."' ORDER BY bayar_ke,angs_tgl;"));
        $dataangsuran = DB::connection('pgsql')->select(DB::raw("SELECT aj.no_kredit,bayar_ke,angs_ke,tgl_angsur,angs_tgl,transfer_tgl,pot_bunga,
                                                                CASE
                                                                  WHEN ('".date('Y-m-d')."' > tgl_angsur AND angs_tgl IS NULL) THEN DATE_PART('day', '".date('Y-m-d')."' - tgl_angsur::timestamp)
                                                                  ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
                                                                END as diff,angs_nobukti,bunga_sldbbt,bakidebet,sld_piutang,aj.angs_pokok,aj.angs_bunga,pokok,bunga,denda
                                                                FROM angsuran_jadwal aj LEFT OUTER JOIN (SELECT no_kredit,angs_nobukti,angs_ke,denda,bunga_sldbbt,bakidebet,sld_piutang,(angs_titippokok+angs_pokok) as pokok,(angs_titipbunga+angs_bunga) as bunga,angs_tgl,transfer_tgl FROM angsuran_kartu ORDER BY angs_ke) as ak ON ak.no_kredit = aj.no_kredit AND angs_ke = bayar_ke
                                                                WHERE aj.no_kredit='".$nokredit."' ORDER BY bayar_ke,angs_tgl;"));
        
        if($datanasabah->saldo_piutang > 0){
            $bayarangsuran = 1; 
        } else {
            $bayarangsuran = 0;
        }
        //denda
        $arr = array(0,0,0,0,0,0,0,0);
        $dataangs = array();
        $tgk = 0;
        //$bayarangsuran = 1;
        foreach($dataangsuran as $key=>$angs){
            if($angs->angs_ke <> ""){
                if($arr[0] == $angs->angs_ke){
                    //if($arr[6] > 3) {
                    if($angs->diff > 3) {
                        //$angs->diff = date_diff(date_create(date('Y-m-d',strtotime($angs->angs_tgl))), date_create(date('Y-m-d',strtotime($arr[5]))))->format('%r%a');
                        //$angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff-$arr[6]);
                        if($arr[6] > 0) {
                            $angs->dendakena = ((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))*abs($angs->diff-$arr[6]);
                        } else {
                            $angs->dendakena = ((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))*abs($angs->diff);
                        }
                    } else {
                        $angs->dendakena = 0;
                    }
                } else {
                    if($angs->diff <= 3){
                        $angs->dendakena = 0;
                    } else {
                        //$angs->dendakena = ceil(((0.5/100)*($angs->angs_pokok+$angs->angs_bunga))/100)*100*abs($angs->diff);
                        $angs->dendakena = ((0.5/100)*($angs->angs_pokok+$angs->angs_bunga))*abs($angs->diff);
                    }
                }
                /*if(($angs->diff <= 3) && ($angs->diff2 <= 3)){
                    $angs->dendakena = 0;
                    $angs->dendakena2 = 0;
                } elseif(($angs->diff <= 3) && ($angs->diff2 > 3)){
                    $angs->dendakena = 0;
                    //$angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga))/100)*100*($angs->diff+$angs->diff2);
                    if($arr[0] == $angs->angs_ke){
                        if((($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga)) > 0){
                            //$angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga))/100)*100*$angs->diff2;
                            $angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga))/100)*100*abs($angs->diff2-);
                        } else {
                            $angs->dendakena2 = 0;
                        }
                    } else {
                        if(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga) > 0){
                            $angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga))/100)*100*$angs->diff2;
                        } else {
                            $angs->dendakena2 = 0;
                        }
                    }
                } else {
                    if($arr[0] == $angs->angs_ke){
                        if($arr[6] > 0){
                            $angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff-$arr[6]);                
                        } else {
                            $angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff);                
                        }
                        //$angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff-$arr[6]);
                        if((($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga)) > 0){
                            $angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2]+$angs->pokok+$angs->bunga))/100)*100*$angs->diff2;
                        } else {
                            $angs->dendakena2 = 0;
                        }
                    } else {
                        if(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga) > 0){
                            $angs->dendakena2 = ceil((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($angs->pokok+$angs->bunga))/100)*100*$angs->diff2;
                        } else {
                            $angs->dendakena2 = 0;
                        }
                        $angs->dendakena = ceil((0.5/100)*($angs->angs_pokok+$angs->angs_bunga)/100)*100*$angs->diff;
                    }
                }*/
                if($arr[0] == $angs->angs_ke){
                    // if(($angs->pokok+$angs->bunga == 0)){
                    //     $angs->angs_tgl = $arr[5];
                    //     $angs->diff = $arr[6];
                    // }
                    if(($angs->pokok <= 0) && ($angs->bunga <= 0)){
                        $angs->diff = $arr[6];
                    }
                    $angs->pokok += $arr[1];
                    $angs->bunga += $arr[2];
                    $angs->denda += $arr[3];
                    $angs->dendakena += $arr[4];
                    $arr[1] = $angs->pokok;
                    $arr[2] = $angs->bunga;
                    $arr[3] = $angs->denda;
                    $arr[4] = $angs->dendakena;
                    $arr[5] = $angs->angs_tgl;
                    $arr[6] = $angs->diff;
                    if($arr[7] < $angs->sld_piutang){
                        $angs->sld_piutang = $arr[7];
                    }
                    $arr[7] = $angs->sld_piutang;
                    if(($tgk == $angs->angs_ke) && (($angs->angs_pokok+$angs->angs_bunga) === ($angs->pokok+$angs->bunga))){
                        $tgk = 0;
                    }
                } else {
                    if(($angs->pokok <= 0) && ($angs->bunga <= 0)){
                        $angs->diff = 0;
                    }
                    $arr[0] = $angs->angs_ke;
                    $arr[1] = $angs->pokok;
                    $arr[2] = $angs->bunga;
                    $arr[3] = $angs->denda;
                    $arr[4] = $angs->dendakena;
                    $arr[5] = $angs->angs_tgl;
                    $arr[6] = $angs->diff;
                    $arr[7] = $angs->sld_piutang;
                    if(($tgk == 0) && (($angs->angs_pokok+$angs->angs_bunga) <> ($angs->pokok+$angs->bunga))){
                        $tgk = $angs->bayar_ke;
                    }
                }
            } else {
                if($angs->diff <= 3){
                    $angs->dendakena = 0;
                } else {
                    //$angs->dendakena = ceil((0.5/100)*($angs->angs_pokok+$angs->angs_bunga)/100)*100*$angs->diff;
                    $angs->dendakena = (0.5/100)*($angs->angs_pokok+$angs->angs_bunga)*$angs->diff;
                }
                $angs->dendakena2 = 0;
                if($tgk == 0){
                    $tgk = $angs->bayar_ke;
                }
            }

            if($bayarangsuran === 1){
                $dataangs[$angs->bayar_ke] = $angs;
            } elseif($bayarangsuran === 0) {
                $dataangs[$angs->bayar_ke] = $angs;
                $dataangs[$angs->bayar_ke]->denda = $angs->denda;       
            }
        }
        if(!isset($dataangs[$tgk])){
            $tgk = count($dataangs);
        }
        $totaltunggak = array('pokok'=>0,'bunga'=>0);
        $i = $tgk;
        //if($dataangs[$i]->angs_ke <> ""){
            $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a');
        //}
        if($diff > 0){
            //while ($i <= count($dataangs) && $dataangs[$i]->angs_ke <> "") {
            while ($i <= count($dataangs) && $dataangs[$i]->diff <> null) {
                $dataangs[$i]->sisa_tunggak = ($dataangs[$i]->angs_pokok+$dataangs[$i]->angs_bunga)-($dataangs[$i]->pokok+$dataangs[$i]->bunga);
                $totaltunggak['pokok'] += $dataangs[$i]->angs_pokok-$dataangs[$i]->pokok;
                $totaltunggak['bunga'] += $dataangs[$i]->angs_bunga-$dataangs[$i]->bunga;
                if(($dataangs[$i]->angs_ke <> "") && ($dataangs[$i]->diff < 0)){
                    $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a');
                    if($diff > 3){
                        //$dataangs[$i]->dendakena += (0.5/100)*$dataangs[$i]->sisa_tunggak*abs(date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a'));
                        $dataangs[$i]->dendakena += (0.5/100)*$dataangs[$i]->sisa_tunggak*abs($diff);
                    }
                    $dataangs[$i]->diff = $diff;
                } elseif(($dataangs[$i]->angs_ke <> "") && ($dataangs[$i]->diff >= 0)) {
                    $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a')-$dataangs[$i]->diff;
                    if($diff > 3){
                        $dataangs[$i]->dendakena += (0.5/100)*$dataangs[$i]->sisa_tunggak*abs($diff);
                    }
                    $dataangs[$i]->diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a');
                }
                $i++;
                if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i-1]->tgl_angsur))))->format('%r%a') == 0){
                    $tgkangsur = $i-$tgk-1;
                } else {
                    $tgkangsur = $i-$tgk;
                }
            }
        } else {
            $tgkangsur = 0;
        }
        /*if($dataangs[$i]->diff > 0){
            //while ($i <= count($dataangs) && $dataangs[$i]->angs_ke <> "") {
            while ($i <= count($dataangs) && $dataangs[$i]->diff <> null) {
                $dataangs[$i]->sisa_tunggak = ($dataangs[$i]->angs_pokok+$dataangs[$i]->angs_bunga)-($dataangs[$i]->pokok+$dataangs[$i]->bunga);
                $totaltunggak['pokok'] += $dataangs[$i]->angs_pokok-$dataangs[$i]->pokok;
                $totaltunggak['bunga'] += $dataangs[$i]->angs_bunga-$dataangs[$i]->bunga;
                $dataangs[$i]->diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->tgl_angsur))), date_create(date('Y-m-d')))->format('%r%a');
                if(($dataangs[$i]->angs_ke <> "") && ($dataangs[$i]->diff > 0)){
                    //$dataangs[$i]->dendakena += ceil((0.5/100)*$dataangs[$i]->sisa_tunggak/100)*100*abs(date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))), date_create(date('Y-m-d')))->format('%r%a'));
                    $dataangs[$i]->dendakena += (0.5/100)*$dataangs[$i]->sisa_tunggak*abs(date_diff(date_create(date('Y-m-d',strtotime($dataangs[$i]->angs_tgl))), date_create(date('Y-m-d')))->format('%r%a'));
                }
                $i++;
                if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($dataangs[$i-1]->tgl_angsur))))->format('%r%a') == 0){
                    $tgkangsur = $i-$tgk-1;
                } else {
                    $tgkangsur = $i-$tgk;
                }
            }
        } else {
            $tgkangsur = 0;
        }*/
        if(!isset($dataangs[$tgk]->sisa_tunggak)){
            $dataangs[$tgk]->sisa_tunggak = ($dataangs[$tgk]->angs_pokok+$dataangs[$tgk]->angs_bunga)-($dataangs[$tgk]->pokok+$dataangs[$tgk]->pokok);
        }
        if($bayarangsuran === 0){
            $tgkangsur = 0;
            $totaltunggak['pokok'] = 0;
            $totaltunggak['bunga'] = 0;
        }
        $totaldenda = 0;
        foreach($dataangs as $angs){
            // $angs->dendakena += $angs->dendakena2;
            // if(($angs->angs_pokok+$angs->angs_bunga) > ($angs->pokok+$angs->bunga)){
            //     $angs->diff += $angs->diff2;
            // }
            $angs->dendakena = ceil($angs->dendakena/100)*100;
            if($angs->dendakena > 0){
                $totaldenda += $angs->dendakena;
            }
            if($angs->denda <> 0){
                $totaldenda -= $angs->denda;
            }
        }
        return view('kredit.simangsuran', compact('dataangs','datanasabah','tgk','totaldenda','tgkangsur','totaltunggak','bayarangsuran'));
    }

    public function getSimAngsuran(Request $request,$nokredit)
    {
        //$nokredit = $tahun.'/'.$kantor.'/'.$nourut;
        $tgl = date('Y-m-d',strtotime($request->input('tanggal')));
        $tgk = $request->input('tgk');

        $datanasabah = DB::connection('pgsql')->select(DB::raw("SELECT kredit.no_kredit,tgl_kredit,sistem,no_ref,nama,alamat,lama,pinj_prsbunga,tgl_mulai,tgl_akhir,notelp,plafon,bbt,bakidebet,saldo_bbt,saldo_piutang,tgl_lunas FROM kredit,prekredit WHERE kredit.no_kredit = '".$nokredit."' AND kredit.no_kredit=prekredit.no_kredit;"))[0];
        $dataangsuran = DB::connection('pgsql')->select(DB::raw("SELECT aj.no_kredit,bayar_ke,angs_ke,tgl_angsur,angs_tgl,transfer_tgl,pot_bunga,
                                                                CASE
                                                                  WHEN ('".date('Y-m-d',strtotime($tgl))."' > tgl_angsur AND angs_tgl IS NULL) THEN DATE_PART('day', '".date('Y-m-d',strtotime($tgl))."' - tgl_angsur::timestamp)
                                                                  ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
                                                                END as diff,angs_nobukti,bunga_sldbbt,bakidebet,sld_piutang,aj.angs_pokok,aj.angs_bunga,pokok,bunga,denda
                                                                FROM angsuran_jadwal aj LEFT OUTER JOIN (SELECT no_kredit,angs_nobukti,angs_ke,denda,bunga_sldbbt,bakidebet,sld_piutang,(angs_titippokok+angs_pokok) as pokok,(angs_titipbunga+angs_bunga) as bunga,angs_tgl,transfer_tgl FROM angsuran_kartu ORDER BY angs_ke) as ak ON ak.no_kredit = aj.no_kredit AND angs_ke = bayar_ke
                                                                WHERE aj.no_kredit='".$nokredit."' ORDER BY bayar_ke,angs_tgl;"));
        
        if($datanasabah->saldo_piutang > 0){
            $bayarangsuran = 1; 
        } else {
            $bayarangsuran = 0;
        }
        //denda
        $arr = array(0,0,0,0,0,0,0,0);
        $dataangs = array();
        $sisaangs = 0;
        $tgk = 0;
        $i = 0;
        //$bayarangsuran = 1;
        foreach($dataangsuran as $key=>$angs){
            if($angs->angs_ke <> ""){
                if($arr[0] == $angs->angs_ke){
                    if($angs->diff > 3) {
                        //$angs->diff = date_diff(date_create(date('Y-m-d',strtotime($angs->angs_tgl))), date_create(date('Y-m-d',strtotime($arr[5]))))->format('%r%a');
                        //$angs->dendakena = ceil(((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))/100)*100*abs($angs->diff-$arr[6]);
                        if($arr[6] > 0) {
                            $angs->dendakena = ((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))*abs($angs->diff-$arr[6]);
                        } else {
                            $angs->dendakena = ((0.5/100)*(($angs->angs_pokok+$angs->angs_bunga)-($arr[1]+$arr[2])))*abs($angs->diff);
                        }
                    } else {
                        $angs->dendakena = 0;
                    }
                } else {
                    if($angs->diff <= 3){
                        $angs->dendakena = 0;
                    } else {
                        //$angs->dendakena = ceil(((0.5/100)*($angs->angs_pokok+$angs->angs_bunga))/100)*100*abs($angs->diff);
                        $angs->dendakena = ((0.5/100)*($angs->angs_pokok+$angs->angs_bunga))*abs($angs->diff);
                    }
                }
                if($arr[0] == $angs->angs_ke){
                    // if(($angs->pokok+$angs->bunga == 0)){
                    //     $angs->angs_tgl = $arr[5];
                    //     $angs->diff = $arr[6];
                    // }
                    if(($angs->pokok <= 0) && ($angs->bunga <= 0)){
                        $angs->diff = $arr[6];
                    }
                    $angs->pokok += $arr[1];
                    $angs->bunga += $arr[2];
                    $angs->denda += $arr[3];
                    $angs->dendakena += $arr[4];
                    $arr[1] = $angs->pokok;
                    $arr[2] = $angs->bunga;
                    $arr[3] = $angs->denda;
                    $arr[4] = $angs->dendakena;
                    $arr[5] = $angs->angs_tgl;
                    $arr[6] = $angs->diff;
                    if($arr[7] < $angs->sld_piutang){
                        $angs->sld_piutang = $arr[7];
                    }
                    $arr[7] = $angs->sld_piutang;
                    if(($tgk == $angs->angs_ke) && (($angs->angs_pokok+$angs->angs_bunga) === ($angs->pokok+$angs->bunga))){
                        $tgk = 0;
                    }
                } else {
                    if(($angs->pokok <= 0) && ($angs->bunga <= 0)){
                        $angs->diff = $arr[6];
                    }
                    $arr[0] = $angs->angs_ke;
                    $arr[1] = $angs->pokok;
                    $arr[2] = $angs->bunga;
                    $arr[3] = $angs->denda;
                    $arr[4] = $angs->dendakena;
                    $arr[5] = $angs->angs_tgl;
                    $arr[6] = $angs->diff;
                    $arr[7] = $angs->sld_piutang;
                    if(($tgk == 0) && (($angs->angs_pokok+$angs->angs_bunga) <> ($angs->pokok+$angs->bunga))){
                        $tgk = $angs->bayar_ke;
                    }
                }
            } else {
                if($angs->diff <= 3){
                    $angs->dendakena = 0;
                } else {
                    //$angs->dendakena = ceil((0.5/100)*($angs->angs_pokok+$angs->angs_bunga)/100)*100*$angs->diff;
                    $angs->dendakena = (0.5/100)*($angs->angs_pokok+$angs->angs_bunga)*$angs->diff;
                }
                $angs->dendakena2 = 0;
                if($tgk == 0){
                    $tgk = $angs->bayar_ke;
                }
            }
            if($bayarangsuran === 1){
                $dataangs[$angs->bayar_ke] = $angs;
            } elseif($bayarangsuran === 0) {
                $dataangs[$angs->bayar_ke] = $angs;
                $dataangs[$angs->bayar_ke]->denda = $angs->denda;       
            }
            if($angs->tgl_angsur > $tgl){ 
                $sisaangs += 1;
                if($i == 0){
                    $i = $angs->bayar_ke;
                }
            }

        }
        
        $totaltunggak = array('pokok'=>0,'bunga'=>0);
        $x = $tgk;
        //if($dataangs[$x]->angs_ke <> ""){
            $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$x]->tgl_angsur))), date_create(date('Y-m-d',strtotime($tgl))))->format('%r%a');
        //}
        if($diff > 0){
            //while ($x <= count($dataangs) && $dataangs[$x]->angs_ke <> "") {
            while ($x <= count($dataangs) && $dataangs[$x]->diff <> null) {
                $dataangs[$x]->sisa_tunggak = ($dataangs[$x]->angs_pokok+$dataangs[$x]->angs_bunga)-($dataangs[$x]->pokok+$dataangs[$x]->bunga);
                $totaltunggak['pokok'] += $dataangs[$x]->angs_pokok-$dataangs[$x]->pokok;
                $totaltunggak['bunga'] += $dataangs[$x]->angs_bunga-$dataangs[$x]->bunga;
                if(($dataangs[$x]->angs_ke <> "") && ($dataangs[$x]->diff < 0)){
                    $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$x]->tgl_angsur))), date_create(date('Y-m-d',strtotime($tgl))))->format('%r%a');
                    if($diff > 3){
                        //$dataangs[$x]->dendakena += (0.5/100)*$dataangs[$x]->sisa_tunggak*abs(date_diff(date_create(date('Y-m-d',strtotime($dataangs[$x]->tgl_angsur))), date_create(date('Y-m-d',strtotime($tgl))))->format('%r%a'));
                        $dataangs[$x]->dendakena += (0.5/100)*$dataangs[$x]->sisa_tunggak*abs($diff);
                    }
                    $dataangs[$x]->diff = $diff;
                } elseif(($dataangs[$x]->angs_ke <> "") && ($dataangs[$x]->diff >= 0)) {
                    $diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$x]->tgl_angsur))), date_create(date('Y-m-d',strtotime($tgl))))->format('%r%a')-$dataangs[$x]->diff;
                    if($diff > 3){
                        $dataangs[$x]->dendakena += (0.5/100)*$dataangs[$x]->sisa_tunggak*abs($diff);
                    }
                    $dataangs[$x]->diff = date_diff(date_create(date('Y-m-d',strtotime($dataangs[$x]->tgl_angsur))), date_create(date('Y-m-d',strtotime($tgl))))->format('%r%a');
                }
                $x++;
                if(date_diff(date_create(date('Y-m-d',strtotime($tgl))), date_create(date('Y-m-d',strtotime($dataangs[$x-1]->tgl_angsur))))->format('%r%a') == 0){
                    $tgkangsur = $x-$tgk-1;
                } else {
                    $tgkangsur = $x-$tgk;
                }
            }
        } else {
            $tgkangsur = 0;
        }
        $pinalti = 0;
        $tambbunga = 0;
        if($request->input('status') === 'true'){
            if($sisaangs >= 2){
                if($datanasabah->tgl_kredit > date('Y-m-d',strtotime('31-03-2016'))){
                    $pinalti = (5/100)*$datanasabah->bakidebet;
                } else {
                    $pinalti = (2/100)*$datanasabah->bakidebet;
                }
                $diff = date_diff(date_create(date('Y-m-d',strtotime($tgl))), date_create(date('Y-m-d',strtotime($dataangs[$x]->tgl_angsur))))->format('%r%a'); //bila telat hasilnya minus
                //Log::info($diff);
                if($diff == 0){
                    $tambbunga = $dataangs[$x]->angs_bunga-$dataangs[$x]->bunga;
                } else {
                    $tambbunga = ceil($dataangs[$tgk]->angs_bunga/30*abs(date_diff(date_create(date('Y-m-d',strtotime($tgl))), date_create(date('Y-m-d',strtotime($dataangs[$i-1]->tgl_angsur))))->format('%r%a')));
                }
            }
            $totaltunggak['pokok'] = $datanasabah->bakidebet;
            $totaltunggak['bunga'] += $tambbunga;
        }
        $totaldenda = 0;
        foreach($dataangs as $angs){
            // $angs->dendakena += $angs->dendakena2;
            // if(($angs->angs_pokok+$angs->angs_bunga) > ($angs->pokok+$angs->bunga)){
            //     $angs->diff += $angs->diff2;
            // }
            $angs->dendakena = ceil($angs->dendakena/100)*100;
            if($angs->dendakena > 0){
                $totaldenda += $angs->dendakena;
            }
            if($angs->denda <> 0){
                $totaldenda -= $angs->denda;
            }
        }
        //return view('kredit.simangsuran', compact('dataangs','datanasabah','tgk','totaldenda','tgkangsur','totaltunggak','bayarangsuran'));
        return array('tunggak'=>$totaltunggak,'denda'=>$totaldenda,'pinalti'=>$pinalti,'dataangs'=>$dataangs,'tgk'=>$tgk);
    }
   
}