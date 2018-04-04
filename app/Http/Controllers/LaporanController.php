<?php

namespace App\Http\Controllers;

// use Illuminate\Database\Query\paginate;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;
use App\Http\Requests;
use App\Laporan;
use App\Prekredit;
use App\PasanganNasabah;
use App\Nasabah;
use App\kredit;
use App\penjamin;
use App\agunan;
use App\AngsJadwal;
use App\AgunanSertifikat;
use App\AgunanKendaraan;
use App\AgunanKredit;
use App\refkodekantor;
use App\Pengurus;
use App\ABCKantor;
use Hash;
use Input;
use DB;
use Auth;
use Log;
use Object;
use App\Http\Controllers\Controller;
use App\Jobs;
use Illuminate\Contracts\Queue\ShouldQueue;


class LaporanController extends Controller
{
    public function viewFormLaporan($tahun,$kode_kantor,$nourut)
    {
         $nokredit = $tahun.'/'.$kode_kantor.'/'.$nourut;
    	$lapuang = Laporan::where('no_kredit',$nokredit)->get();
        $daftar = Kredit::where('no_kredit',$nokredit)->get();
            
        $prekredit = Prekredit::where('no_kredit',$nokredit)->first();
        
        return view('lapkeuangan.forminputlapkeuangan',compact('prekredit','lapuang','daftar'));   
    }
    public function saveDataLaporan(Request $request)
    {
        DB::connection('pgsql')->table('lapkeuangan')->where('no_nsb',$request->input('no_nsb'))->update([
            'tgl_adden'     => date('Y-m-d 00:00:00',strtotime($request->input('input_tgladen'))),
            ]);
    	
        $lap = new Laporan;
        $lap->no_nsb = $request->input('no_nsb');
        // $lap->no_cif = $request->input('no_cif');
        $lap->no_kredit = $request->input('no_kredit');
        $lap->tahunan = date('Y-m-d H:i:s',strtotime($request->input('input_posisi_lapKeuangan_tahunan')));
        // $lap->tahunan  = $request->input('input_posisi_lapKeuangan_tahunan');
        $lap->aset = DataController::formatangka($request->input('input_aset'));
        $lap->aset_lancar = DataController::formatangka($request->input('input_aset_lancar'));
        $lap->kas = DataController::formatangka($request->input('input_kas'));
        $lap->piutang_usaha_al = DataController::formatangka($request->input('input_piutang_usaha_al'));
        $lap->investasi_lancar = DataController::formatangka($request->input('input_investasi_lacar'));
        $lap->aset_lancar_lain = DataController::formatangka($request->input('input_aset_lancar_lain'));
        $lap->aset_tdk_lancar = DataController::formatangka($request->input('input_aset_tdk_lancar'));
        $lap->piutang_usaha_atl = DataController::formatangka($request->input('input_piutang_usaha_atl'));
        $lap->invest_tdk_lancar = DataController::formatangka($request->input('input_invest_tdk_lancar'));
        $lap->aset_tdk_lancar_lain = DataController::formatangka($request->input('input_aset_tdk_lancar_lain'));
        $lap->lia = DataController::formatangka($request->input('input_lia'));
        $lap->lia_pndk = DataController::formatangka($request->input('input_lia_pndk'));
        $lap->pinjaman_pndk = DataController::formatangka($request->input('input_pinjaman_pndk'));
        $lap->utang_usaha_pndk = DataController::formatangka($request->input('input_utang_usaha_pndk'));
        $lap->lia_pndk_lain = DataController::formatangka($request->input('input_lia_pndk_lain'));
        $lap->lia_pnjg = DataController::formatangka($request->input('input_lia_pnjng'));
        $lap->pinjaman_pnjng = DataController::formatangka($request->input('input_pinjaman_pnjng'));
        $lap->utang_usaha_pnjng = DataController::formatangka($request->input('input_utang_usaha_panjang'));
        $lap->lia_pnjng_lain = DataController::formatangka($request->input('input_lia_panjang_lain'));
        $lap->ekuitas = DataController::formatangka($request->input('input_ekuitas'));
        $lap->pendapatan_usaha = DataController::formatangka($request->input('input_pendapatan_usaha'));
        $lap->beban_pokok = DataController::formatangka($request->input('input_beban_pokok'));
        $lap->labarugi = DataController::formatangka($request->input('input_labarugi'));
        $lap->pendapatan_lain = DataController::formatangka($request->input('input_pendapatan_lain'));
        $lap->beban_lain = DataController::formatangka($request->input('input_beban_lain'));
        $lap->labarugi_lalu = DataController::formatangka($request->input('input_labarugi_sblmPajak'));
        $lap->labarugi_tahun = DataController::formatangka($request->input('input_labarugi_tahun'));
        $lap->kode_kantor = substr($lap->no_kredit,7,2);
        $lap->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')));
        $lap->opr = $request->input('opr');
    	$lap->save();

    	return redirect('/');
    }

     public function viewFormLapBadan($nonsb, $tahun,$kode_kantor,$nourut)
    {
        $nasabah = Nasabah::where('no_nsb',$nonsb)->first();
        $nokredit = $tahun.'/'.$kode_kantor.'/'.$nourut;
        $prekredit = Prekredit::where('no_kredit',$nokredit)->first();

        return view('lapkeuangan.forminputlapbadan',compact('nasabah','prekredit'));   
    }

    public function saveDataBadan(Request $request,$nonsb,$nokredit)
    {
        $nasabah = Nasabah::where('no_nsb',$request->input('no_nsb'))->first();
        $prekredit = Prekredit::where('no_kredit',$request->input('no_kredit'))->first();

        $lap = new Laporan;
        $lap->no_nsb =$nasabah->no_nsb;
        // $lap->no_cif=$nasabah->no_cif;
        $lap->no_kredit=$prekredit->no_kredit;  

        $lap->tahunan = date('Y-m-d H:i:s',strtotime($request->input('input_posisi_lapKeuangan_tahunan')));
        $lap->aset = $request->input('input_aset');
        $lap->aset_lancar = $request->input('input_aset_lancar');
        $lap->kas = DataController::formatangka($request->input('input_kas'));
        $lap->piutang_usaha_al = DataController::formatangka($request->input('input_piutang_usaha_al'));
        $lap->investasi_lancar = DataController::formatangka($request->input('input_investasi_lacar'));
        $lap->aset_lancar_lain = DataController::formatangka($request->input('input_aset_lancar_lain'));
        $lap->aset_tdk_lancar = DataController::formatangka($request->input('input_aset_tdk_lancar'));
        $lap->piutang_usaha_atl = DataController::formatangka($request->input('input_piutang_usaha_atl'));
        $lap->invest_tdk_lancar = DataController::formatangka($request->input('input_invest_tdk_lancar'));
        $lap->aset_tdk_lancar_lain = DataController::formatangka($request->input('input_aset_tdk_lancar_lain'));
        $lap->lia = DataController::formatangka($request->input('input_lia'));
        $lap->lia_pndk = DataController::formatangka($request->input('input_lia_pndk'));
        $lap->pinjaman_pndk = DataController::formatangka($request->input('input_pinjaman_pndk'));
        $lap->utang_usaha_pndk = DataController::formatangka($request->input('input_utang_usaha_pndk'));
        $lap->lia_pndk_lain = DataController::formatangka($request->input('input_lia_pndk_lain'));
        $lap->lia_pnjg = DataController::formatangka($request->input('input_lia_pnjng'));
        $lap->pinjaman_pnjng = DataController::formatangka($request->input('input_pinjaman_pnjng'));
        $lap->utang_usaha_pnjng = DataController::formatangka($request->input('input_utang_usaha_panjang'));
        $lap->lia_pnjng_lain = DataController::formatangka($request->input('input_lia_panjang_lain'));
        $lap->ekuitas = DataController::formatangka($request->input('input_ekuitas'));
        $lap->pendapatan_usaha = DataController::formatangka($request->input('input_pendapatan_usaha'));
        $lap->beban_pokok = DataController::formatangka($request->input('input_beban_pokok'));
        $lap->labarugi = DataController::formatangka($request->input('input_labarugi'));
        $lap->pendapatan_lain = DataController::formatangka($request->input('input_pendapatan_lain'));
        $lap->beban_lain = DataController::formatangka($request->input('input_beban_lain'));
        $lap->labarugi_lalu = DataController::formatangka($request->input('input_labarugi_sblmPajak'));
        $lap->labarugi_tahun = DataController::formatangka($request->input('input_labarugi_tahun'));
        $lap->kode_kantor = substr($lap->no_kredit,7,2);
        $lap->tgl_pakai = date('Y-m-d H:i:s',strtotime($request->input('input_pakai')));
        $lap->opr = $request->input('opr');
        $lap->save();

        return redirect('/addpengurus/'.$nasabah->no_nsb.'/'.$prekredit->no_kredit);
        // return redirect('/addagunan/'.$nasabah->no_nsb.'/'.$prekredit->no_kredit);
        // return redirect('/addagunan/'.$lap->no_nsb.'/'.$lap->no_kredit);
    }
    
     public function viewlaplunas()
    {
               
       $sql = "SELECT kredit.no_kredit,no_ref,sistem,tgl_kredit,saldo_piutang,saldo_bbt,bbt,pinj_pokok,nama,sistem,pinj_prsbunga,
                 lama,jatuhtempo,ak.ke,tgl_lunas,(kredit.pinj_pokok+kredit.bbt) as ssutang
                 -- agunan_kend.merktype,agunan_kend.niltaksasi,agunan_sert.sertstatus,agunan_sert.niltaksasi 
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_kartu GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 -- RIGHT JOIN agunan_kend ON ak.no_kredit = agunan_kend.no_kredit
                 -- RIGHT JOIN agunan_sert ON ak.no_kredit = agunan_sert.no_kredit
                 WHERE ";
                 $sql .= "kredit.no_kredit=prekredit.no_kredit and tgl_lunas ::timestamp 
                    = '".date('Y-m-d 00:00:00')."' order by saldo_piutang DESC";

        $nsblist = DB::connection('pgsql')->select(DB::raw($sql));

        $jumlah =  "SELECT count(no_kredit) as nomor,sum(pinj_pokok) as jumpokok,sum(bbt) as jumbbt,sum(kredit.pinj_pokok+kredit.bbt) as jumsalpi FROM kredit 
        where tgl_lunas::timestamp = '".date('Y-m-d 00:00:00')."'";
        
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('lapkeuangan.laplunas',compact('nsblist','jumlah','nsblistjumlah'));
    }

    public function viewlaplunasnpp($key=null)
    {
               
        $kunci = strtoupper($key);

       $sql = "SELECT kredit.no_kredit,no_ref,sistem,tgl_kredit,saldo_piutang,saldo_bbt,bbt,pinj_pokok,nama,sistem,pinj_prsbunga,
                 lama,jatuhtempo,ak.ke,tgl_lunas,(kredit.pinj_pokok+kredit.bbt) as ssutang
                 -- agunan_kend.merktype,agunan_kend.niltaksasi,agunan_sert.sertstatus,agunan_sert.niltaksasi 
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_kartu GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 -- RIGHT JOIN agunan_kend ON ak.no_kredit = agunan_kend.no_kredit
                 -- RIGHT JOIN agunan_sert ON ak.no_kredit = agunan_sert.no_kredit
                 WHERE ";
                 $sql .= "kredit.no_kredit=prekredit.no_kredit AND kredit.no_ref LIKE '%".$kunci."%'";

        $nsblist = DB::connection('pgsql')->select(DB::raw($sql));

        $jumlah =  "SELECT count(no_kredit) as nomor,sum(pinj_pokok) as jumpokok,sum(bbt) as jumbbt,sum(kredit.pinj_pokok+kredit.bbt) as jumsalpi FROM kredit 
        where kredit.no_ref LIKE '%".$kunci."%'";
        
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('lapkeuangan.laplunasnpp',compact('nsblist','jumlah','nsblistjumlah','kunci'));
    }

     public function viewlaplunastgl ($tanggal=null)
    {
        
       $tgl = explode('/', $tanggal);
       // $sql = Kredit::whereMonth('tgl_kredit','=',$tgl[0])->whereDay('tgl_kredit','=',$tgl[1])->whereYear('tgl_kredit','=',$tgl[2])->first();
       $sql = "SELECT kredit.no_kredit,no_ref,sistem,tgl_kredit,saldo_piutang,saldo_bbt,bbt,pinj_pokok,nama,sistem,pinj_prsbunga,
                 lama,jatuhtempo,ak.ke,tgl_lunas,(kredit.pinj_pokok+kredit.bbt) as ssutang
                 -- agunan_kend.merktype,agunan_kend.niltaksasi,agunan_sert.sertstatus,agunan_sert.niltaksasi 
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_kartu GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 -- RIGHT JOIN agunan_kend ON ak.no_kredit = agunan_kend.no_kredit
                 -- RIGHT JOIN agunan_sert ON ak.no_kredit = agunan_sert.no_kredit
                 WHERE ";   
        if ($tgl <> null)
        {

             $sql .= "kredit.no_kredit=prekredit.no_kredit and 
             tgl_lunas::timestamp = '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."' 
             order by saldo_piutang DESC";

        }else{

             $sql .= "kredit.no_kredit=prekredit.no_kredit order by saldo_piutang DESC";
        }

        $nsblist = DB::connection('pgsql')->select(DB::raw($sql));  

        $jumlah =  "SELECT count(no_kredit) as nomor, sum(pinj_pokok) as jumpokok,sum(bbt) as jumbbt,sum(kredit.pinj_pokok+kredit.bbt) as jumsalpi FROM kredit 
        where tgl_lunas::timestamp 
              = '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'";
        
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('lapkeuangan.laplunastgl',compact('nsblist','jumlah','nsblistjumlah'));
    }

     public function viewlaplunastgl2 ($tanggal1=null,$tanggal2=null)
    {

       $sql = "SELECT kredit.no_kredit,no_ref,sistem,tgl_kredit,saldo_piutang,saldo_bbt,bbt,pinj_pokok,nama,sistem,pinj_prsbunga,
                 lama,jatuhtempo,ak.ke,tgl_lunas,(kredit.pinj_pokok+kredit.bbt) as ssutang
                 -- agunan_kend.merktype,agunan_kend.niltaksasi,agunan_sert.sertstatus,agunan_sert.niltaksasi 
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_kartu GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 -- RIGHT JOIN agunan_kend ON ak.no_kredit = agunan_kend.no_kredit
                 -- RIGHT JOIN agunan_sert ON ak.no_kredit = agunan_sert.no_kredit
                 WHERE ";   
                 
             $sql .= "kredit.no_kredit=prekredit.no_kredit 
             and tgl_lunas::timestamp 
             BETWEEN  '".date('Y-m-d 00:00:00',strtotime($tanggal1))."'
             and  '".date('Y-m-d 00:00:00',strtotime($tanggal2))."' 
             order by saldo_piutang DESC";


             // echo "dari = " . $tanggal1;
             // echo "sampai = " . $tanggal2;
             // echo "sql = " . $sql;
             // Log::info('sql '+$sql);

        // }else{

        //      $sql .= "kredit.no_kredit=prekredit.no_kredit order by saldo_piutang DESC";
  
        // }

        $nsblist = DB::connection('pgsql')->select(DB::raw($sql));  

        $jumlah =  "SELECT count(no_kredit) as nomor, sum(pinj_pokok) as jumpokok,sum(bbt) as jumbbt,sum(kredit.pinj_pokok+kredit.bbt) as jumsalpi FROM kredit 
        where tgl_lunas::timestamp 
            BETWEEN  '".date('Y-m-d 00:00:00',strtotime($tanggal1))."'
             and  '".date('Y-m-d 00:00:00',strtotime($tanggal2))."'";
        
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  


        return view('lapkeuangan.laplunastgl2',compact('nsblist','tanggal1','tanggal2','jumlah','nsblistjumlah'));
    }


    public function viewRealNasabah()
    {
               
       $sql = "SELECT kredit.no_kredit,no_ref,sistem,tgl_kredit,saldo_piutang,saldo_bbt,bbt,pinj_pokok,nama,sistem,pinj_prsbunga,
                 lama,jatuhtempo,ak.ke,tgl_lunas,(kredit.pinj_pokok+kredit.bbt) as ssutang
                 -- agunan_kend.merktype,agunan_kend.niltaksasi,agunan_sert.sertstatus,agunan_sert.niltaksasi 
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_kartu GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 -- RIGHT JOIN agunan_kend ON ak.no_kredit = agunan_kend.no_kredit
                 -- RIGHT JOIN agunan_sert ON ak.no_kredit = agunan_sert.no_kredit
                 WHERE ";
                 $sql .= "kredit.no_kredit=prekredit.no_kredit and tgl_kredit ::timestamp 
                    = '".date('Y-m-d 00:00:00')."' order by saldo_piutang DESC";

        $nsblist = DB::connection('pgsql')->select(DB::raw($sql));

        $jumlah =  "SELECT count(no_kredit) as nomor,sum(pinj_pokok) as jumpokok,sum(bbt) as jumbbt,sum(kredit.pinj_pokok+kredit.bbt) as jumsalpi FROM kredit 
        where tgl_kredit::timestamp = '".date('Y-m-d 00:00:00')."'";
        
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('lapkeuangan.formreal2',compact('nsblist','jumlah','nsblistjumlah'));
    }

    public function viewDafNasabah($tanggal=null)
    {
        
       $tgl = explode('/', $tanggal);
       // $sql = Kredit::whereMonth('tgl_kredit','=',$tgl[0])->whereDay('tgl_kredit','=',$tgl[1])->whereYear('tgl_kredit','=',$tgl[2])->first();
       $sql = "SELECT kredit.no_kredit,no_ref,sistem,tgl_kredit,saldo_piutang,saldo_bbt,bbt,pinj_pokok,nama,sistem,pinj_prsbunga,
                 lama,jatuhtempo,ak.ke,tgl_lunas,(kredit.pinj_pokok+kredit.bbt) as ssutang
                 -- agunan_kend.merktype,agunan_kend.niltaksasi,agunan_sert.sertstatus,agunan_sert.niltaksasi 
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_kartu GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 -- RIGHT JOIN agunan_kend ON ak.no_kredit = agunan_kend.no_kredit
                 -- RIGHT JOIN agunan_sert ON ak.no_kredit = agunan_sert.no_kredit
                 WHERE ";   
        if ($tgl <> null)
        {

             $sql .= "kredit.no_kredit=prekredit.no_kredit and 
             tgl_kredit::timestamp = '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."' 
             order by saldo_piutang DESC";

        }else{

             $sql .= "kredit.no_kredit=prekredit.no_kredit order by saldo_piutang DESC";
        }

        $nsblist = DB::connection('pgsql')->select(DB::raw($sql));  

        $jumlah =  "SELECT count(no_kredit) as nomor, sum(pinj_pokok) as jumpokok,sum(bbt) as jumbbt,sum(kredit.pinj_pokok+kredit.bbt) as jumsalpi FROM kredit 
        where tgl_kredit::timestamp 
              = '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'";
        
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('lapkeuangan.formreal',compact('nsblist','jumlah','nsblistjumlah'));
    }

    public function viewDaf2Nasabah($tanggal1=null,$tanggal2=null)
    {
        
       $sql = "SELECT kredit.no_kredit,no_ref,sistem,tgl_kredit,saldo_piutang,saldo_bbt,bbt,pinj_pokok,nama,sistem,pinj_prsbunga,
                 lama,jatuhtempo,ak.ke,tgl_lunas,(kredit.pinj_pokok+kredit.bbt) as ssutang
                 -- agunan_kend.merktype,agunan_kend.niltaksasi,agunan_sert.sertstatus,agunan_sert.niltaksasi 
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_kartu GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 -- RIGHT JOIN agunan_kend ON ak.no_kredit = agunan_kend.no_kredit
                 -- RIGHT JOIN agunan_sert ON ak.no_kredit = agunan_sert.no_kredit
                 WHERE ";   
                 
             $sql .= "kredit.no_kredit=prekredit.no_kredit 
             and tgl_kredit::timestamp 
             BETWEEN  '".date('Y-m-d 00:00:00',strtotime($tanggal1))."'
             and  '".date('Y-m-d 00:00:00',strtotime($tanggal2))."' 
             order by saldo_piutang DESC";


             // echo "dari = " . $tanggal1;
             // echo "sampai = " . $tanggal2;
             // echo "sql = " . $sql;
             // Log::info('sql '+$sql);

        // }else{

        //      $sql .= "kredit.no_kredit=prekredit.no_kredit order by saldo_piutang DESC";
  
        // }

        $nsblist = DB::connection('pgsql')->select(DB::raw($sql));  

        $jumlah =  "SELECT count(no_kredit) as nomor, sum(pinj_pokok) as jumpokok,sum(bbt) as jumbbt,sum(kredit.pinj_pokok+kredit.bbt) as jumsalpi FROM kredit 
        where tgl_kredit::timestamp 
            BETWEEN  '".date('Y-m-d 00:00:00',strtotime($tanggal1))."'
             and  '".date('Y-m-d 00:00:00',strtotime($tanggal2))."'";
        
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  


        return view('lapkeuangan.formreal3',compact('nsblist','tanggal1','tanggal2','jumlah','nsblistjumlah'));
    }

     public function viewDafNPP($key=null)
    {
               
        $kunci = strtoupper($key);

       $sql = "SELECT kredit.no_kredit,no_ref,sistem,tgl_kredit,saldo_piutang,saldo_bbt,bbt,pinj_pokok,nama,sistem,pinj_prsbunga,
                 lama,jatuhtempo,ak.ke,tgl_lunas,(kredit.pinj_pokok+kredit.bbt) as ssutang
                 -- agunan_kend.merktype,agunan_kend.niltaksasi,agunan_sert.sertstatus,agunan_sert.niltaksasi 
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_kartu GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 -- RIGHT JOIN agunan_kend ON ak.no_kredit = agunan_kend.no_kredit
                 -- RIGHT JOIN agunan_sert ON ak.no_kredit = agunan_sert.no_kredit
                 WHERE ";
                 $sql .= "kredit.no_kredit=prekredit.no_kredit AND kredit.no_ref LIKE '%".$kunci."%'";

        $nsblist = DB::connection('pgsql')->select(DB::raw($sql));

        $jumlah =  "SELECT count(no_kredit) as nomor,sum(pinj_pokok) as jumpokok,sum(bbt) as jumbbt,sum(kredit.pinj_pokok+kredit.bbt) as jumsalpi FROM kredit 
        where kredit.no_ref LIKE '%".$kunci."%'";
        
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('lapkeuangan.formrealnpp',compact('nsblist','jumlah','nsblistjumlah','kunci'));
    }

    public function viewAngsuran($key=null)
    {

        $sql = "SELECT kredit.no_kredit,no_ref,prekredit.nama,angsuran_bayar.pokok,angsuran_bayar.bunga,angsuran_bayar.opr,
                 angsuran_bayar.nobukti,angsuran_bayar.transfer_tgl,angsuran_bayar.tanggal,(angsuran_bayar.pokok+angsuran_bayar.bunga) as angsur
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_bayar GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 RIGHT JOIN angsuran_bayar ON ak.no_kredit = angsuran_bayar.no_kredit
                 WHERE ";  

                $sql .= "kredit.no_kredit=prekredit.no_kredit and angsuran_bayar.tanggal::timestamp 
                    = '".date('Y-m-d 00:00:00')."' order by nama ASC";
            

         $nsblist = DB::connection('pgsql')->select(DB::raw($sql));  

        $jumlah =  "SELECT count(no_kredit) as nomor,sum(pokok) as jumpokok,sum(bunga) as jumbunga,sum(pokok+bunga) as jumangsur FROM angsuran_bayar 
        where tanggal::timestamp = '".date('Y-m-d 00:00:00')."'";
        
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('laporan.lapbayarku',compact('kode_kantor','nsblist','tanggal','jumlah','nsblistjumlah','npp'));
    }

    public function viewAngsuranNPP($key=null)
    {
        // $kolom = $kol;
        $kunci = strtoupper($key);

        $sql = "SELECT kredit.no_kredit,no_ref,prekredit.nama,angsuran_bayar.pokok,angsuran_bayar.bunga,angsuran_bayar.opr,
                 angsuran_bayar.nobukti,angsuran_bayar.transfer_tgl,angsuran_bayar.tanggal,(angsuran_bayar.pokok+angsuran_bayar.bunga) as angsur
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_bayar GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 RIGHT JOIN angsuran_bayar ON ak.no_kredit = angsuran_bayar.no_kredit
                 WHERE ";  

        $sql .= "kredit.no_ref LIKE '%".$kunci."%' AND kredit.no_kredit=prekredit.no_kredit";
         
        $nsblist = DB::connection('pgsql')->select(DB::raw($sql));  

        $jumlah =  "SELECT count(kredit.no_kredit) as nomor,sum(pokok) as jumpokok,sum(bunga) as jumbunga,sum(pokok+bunga) as jumangsur FROM angsuran_bayar,kredit 
        where kredit.no_ref LIKE '%".$kunci."%' AND kredit.no_kredit=angsuran_bayar.no_kredit";
        
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

    
        return view('laporan.lapbayarnpp',compact('kode_kantor','nsblist','tanggal','jumlah','nsblistjumlah','npp','kolom','kunci'));
    }

    public function viewAngsuranHari($tanggal=null)
    {
        $tgl = explode('-', $tanggal);

        $sql = "SELECT kredit.no_kredit,no_ref,prekredit.nama,angsuran_bayar.pokok,angsuran_bayar.bunga,angsuran_bayar.opr,
                 angsuran_bayar.nobukti,angsuran_bayar.transfer_tgl,angsuran_bayar.tanggal,(angsuran_bayar.pokok+angsuran_bayar.bunga) as angsur
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_bayar GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 RIGHT JOIN angsuran_bayar ON ak.no_kredit = angsuran_bayar.no_kredit
                 WHERE ";  

        if ($tgl <> null)
        {

             $sql .= "kredit.no_kredit=prekredit.no_kredit and angsuran_bayar.tanggal::timestamp 
              = '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."' 
             order by nama ASC";

        }else{

             $sql .= "kredit.no_kredit=prekredit.no_kredit order by nama ASC";
        }

         $nsblist = DB::connection('pgsql')->select(DB::raw($sql));

        $jumlah =  "SELECT count(no_kredit) as nomor,sum(pokok) as jumpokok,sum(bunga) as jumbunga,sum(pokok+bunga) as jumangsur FROM angsuran_bayar 
        where tanggal::timestamp 
              = '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'";
        
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('laporan.lapbayarhari',compact('kode_kantor','nsblist','tanggal','jumlah','nsblistjumlah'));
    }

    public function viewAngsuranTanggal($tanggal1=null,$tanggal2=null)
    {
        // sum(angsuran_bayar.pokok) as jumpokok, sum(angsuran_bayar.bunga) as jumbunga, sum(angsuran_bayar.pokok+angsuran_bayar.bunga) as jumangsur 

        $sql = "SELECT kredit.no_kredit,no_ref,prekredit.nama,angsuran_bayar.pokok,angsuran_bayar.bunga,angsuran_bayar.opr,
                 angsuran_bayar.nobukti,angsuran_bayar.transfer_tgl,angsuran_bayar.tanggal,(angsuran_bayar.pokok+angsuran_bayar.bunga) as angsur 
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_bayar GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 RIGHT JOIN angsuran_bayar ON ak.no_kredit = angsuran_bayar.no_kredit
                 WHERE ";  

        $sql .= "kredit.no_kredit=prekredit.no_kredit 
             and angsuran_bayar.tanggal::timestamp 
             BETWEEN  '".date('Y-m-d 00:00:00',strtotime($tanggal1))."'
             and  '".date('Y-m-d 00:00:00',strtotime($tanggal2))."' 
             order by nama ASC";

         $nsblist = DB::connection('pgsql')->select(DB::raw($sql));  

        $jumlah =  "SELECT count(no_kredit) as nomor,sum(pokok) as jumpokok,sum(bunga) as jumbunga,sum(pokok+bunga) as jumangsur FROM angsuran_bayar 
        where tanggal::timestamp 
             BETWEEN  '".date('Y-m-d 00:00:00',strtotime($tanggal1))."'
             and  '".date('Y-m-d 00:00:00',strtotime($tanggal2))."'";
        
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('laporan.lapbayartanggal',compact('kode_kantor','nsblist','tanggal1','tanggal2','jumlah','nsblistjumlah'));
    }

    public function viewTempo()
    {


        // $sql = "SELECT kredit.no_kredit, no_ref,arav,tgl_mulai,pinj_prsbunga,saldo_piutang,prekredit.nama,prekredit.nohp,prekredit.notelp,
        //         angsuran_jadwal.angs_pokok,angsuran_jadwal.angs_bunga,
        //         angsuran_jadwal.tgl_angsur,(angsuran_jadwal.angs_pokok+angsuran_jadwal.angs_bunga) as angsuran,
        //         angsuran_kartu.angs_tgl,angsuran_kartu.angs_ke,
        //         angsuran_kartu.transfer_tgl, CASE WHEN transfer_tgl <> '1900-01-01 00:00:00' THEN DATE_PART('day', transfer_tgl::timestamp - tgl_angsur::timestamp) ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
        //             END as diff,(angsuran_kartu.angs_titippokok+angsuran_kartu.angs_pokok) as pokok,(angsuran_kartu.angs_titipbunga+angsuran_kartu.angs_bunga) as bunga,angsuran_kartu.denda,angsuran_jadwal.bayar_ke
        //          FROM prekredit,(select no_kredit,count(no_kredit) as ke 
        //          FROM angsuran_jadwal GROUP BY no_kredit) as ak 
        //          RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
        //          RIGHT JOIN angsuran_jadwal ON ak.no_kredit = angsuran_jadwal.no_kredit
        //          RIGHT JOIN angsuran_kartu ON ak.no_kredit = angsuran_kartu.no_kredit
        //          WHERE ";  

        //         $sql .= "kredit.no_kredit=prekredit.no_kredit and angsuran_jadwal.tgl_angsur::timestamp 
        //             = '".date('Y-m-d 00:00:00')."' AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke order by nama ASC";
            

        $sql = "SELECT
                    angsuran_jadwal.no_kredit,
                    angsuran_jadwal.tgl_angsur,
                    angsuran_jadwal.sangs,
                    angsuran_jadwal.angs_pokok,
                    angsuran_jadwal.angs_bunga,
                    angsuran_jadwal.bayar_ke,
                    angsuran_jadwal.janji_palsu,
                    angsuran_kartu.angs_ke,
                    angsuran_kartu.angs_nobukti,
                    angsuran_kartu.angs_tgl,
                    (angsuran_jadwal.angs_pokok+angsuran_jadwal.angs_bunga) as angsuran,
                    (angsuran_kartu.angs_titippokok+angsuran_kartu.angs_pokok) as pokok,
                    (angsuran_kartu.angs_titipbunga+angsuran_kartu.angs_bunga) as bunga,
                    kredit.no_ref,
                    prekredit.nohp,
                    prekredit.notelp,
                    kredit.tgl_mulai,
                    prekredit.nama,
                    CASE WHEN transfer_tgl <> '1900-01-01 00:00:00' THEN DATE_PART('day', transfer_tgl::timestamp - tgl_angsur::timestamp) ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
                    END as diff,
                    kredit.saldo_piutang AS saldo_piutang_akhir,
                    angsuran_kartu.sld_piutang AS saldo_piutang
                FROM
                    angsuran_jadwal
                    Left Join angsuran_kartu ON angsuran_kartu.no_kredit = angsuran_jadwal.no_kredit AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
                    Left Join prekredit ON angsuran_jadwal.no_kredit = prekredit.no_kredit
                    Left Join kredit ON angsuran_jadwal.no_kredit = kredit.no_kredit
                WHERE
                    angsuran_jadwal.tgl_angsur >=  '".date('Y-m-d 00:00:00')."' AND
                    angsuran_jadwal.tgl_angsur <=  '".date('Y-m-d 00:00:00')."' AND kredit.saldo_piutang > 0 
                ORDER BY angsuran_jadwal.tgl_angsur,prekredit.nama ";
        $nsblist = DB::connection('pgsql')->select(DB::raw($sql)); 
       
        foreach($nsblist as $angs){
                $arr = array(0,0,0,0,0);
                $arr[0] = $angs->tgl_mulai;
                $arr[1] = $angs->angs_bunga;
               
                $after = date('d',strtotime(intval($arr[0])));
                $lastDate = date('t');
                $angs->lastDate = $lastDate;
                // $angs->$after = $after;

                $bhr = ($arr[1]/$lastDate);
                $bakhir = (($lastDate-$after)*$bhr);
                $bit = ($arr[1]-$bakhir);
                $angs->bit = $bit;
         // $jakrual =0;
         // $jakrual += $bit;
        // Log::info($jakrual);
       }     

                $jakrual = 0;
                foreach ($nsblist as $angs) {
                $jakrual += $angs->bit;
                }

        $jumlah =  "SELECT count(angsuran_jadwal.no_kredit) as nomor FROM angsuran_jadwal 
                    Left Join angsuran_kartu ON angsuran_kartu.no_kredit = angsuran_jadwal.no_kredit AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
                    Left Join kredit ON angsuran_jadwal.no_kredit = kredit.no_kredit
                    where angsuran_jadwal.tgl_angsur::timestamp= '".date('Y-m-d 00:00:00')."' AND kredit.saldo_piutang > 0 ";
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('laporan.jatuhtempo.laptempoo',compact('nsblist','bit','akrual','jakrual','lastDate','after','nsblistjumlah'));
    }

     public function viewTempoNPP($key=null)
    {
        $kunci = strtoupper($key);

        // $sql = "SELECT kredit.no_kredit,no_ref,arav,tgl_mulai,pinj_prsbunga,saldo_piutang,prekredit.nama,prekredit.nohp,prekredit.notelp,
        //         angsuran_jadwal.angs_pokok,angsuran_jadwal.angs_bunga,
        //         angsuran_jadwal.tgl_angsur,(angsuran_jadwal.angs_pokok+angsuran_jadwal.angs_bunga) as angsuran,
        //         angsuran_kartu.angs_tgl,angsuran_kartu.angs_ke,
        //         angsuran_kartu.transfer_tgl, CASE WHEN transfer_tgl <> '1900-01-01 00:00:00' THEN DATE_PART('day', transfer_tgl::timestamp - tgl_angsur::timestamp) ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
        //             END as diff,(angsuran_kartu.angs_titippokok+angsuran_kartu.angs_pokok) as pokok,(angsuran_kartu.angs_titipbunga+angsuran_kartu.angs_bunga) as bunga,angsuran_kartu.denda,angsuran_jadwal.bayar_ke
        //          FROM prekredit,(select no_kredit,count(no_kredit) as ke 
        //          FROM angsuran_jadwal GROUP BY no_kredit) as ak 
        //          RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
        //          RIGHT JOIN angsuran_jadwal ON ak.no_kredit = angsuran_jadwal.no_kredit
        //          RIGHT JOIN angsuran_kartu ON ak.no_kredit = angsuran_kartu.no_kredit
        //          WHERE ";  

        //          $sql .= "kredit.no_ref LIKE '%".$kunci."%' AND kredit.no_kredit=prekredit.no_kredit AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke";
                  
         $sql = "SELECT
                    angsuran_jadwal.no_kredit,
                    angsuran_jadwal.tgl_angsur,
                    angsuran_jadwal.sangs,
                    angsuran_jadwal.angs_pokok,
                    angsuran_jadwal.angs_bunga,
                    angsuran_jadwal.bayar_ke,
                    angsuran_jadwal.janji_palsu,
                    angsuran_kartu.angs_ke,
                    angsuran_kartu.angs_nobukti,
                    angsuran_kartu.angs_tgl,
                    (angsuran_jadwal.angs_pokok+angsuran_jadwal.angs_bunga) as angsuran,
                    (angsuran_kartu.angs_titippokok+angsuran_kartu.angs_pokok) as pokok,
                    (angsuran_kartu.angs_titipbunga+angsuran_kartu.angs_bunga) as bunga,
                    kredit.no_ref,
                    prekredit.nohp,
                    prekredit.notelp,
                    kredit.tgl_mulai,
                    prekredit.nama,
                    CASE WHEN transfer_tgl <> '1900-01-01 00:00:00' THEN DATE_PART('day', transfer_tgl::timestamp - tgl_angsur::timestamp) ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
                    END as diff,
                    kredit.saldo_piutang AS saldo_piutang_akhir,
                    angsuran_kartu.sld_piutang AS saldo_piutang
                FROM
                    angsuran_jadwal
                    Left Join angsuran_kartu ON angsuran_kartu.no_kredit = angsuran_jadwal.no_kredit AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
                    Left Join prekredit ON angsuran_jadwal.no_kredit = prekredit.no_kredit
                    Left Join kredit ON angsuran_jadwal.no_kredit = kredit.no_kredit
                WHERE
                    kredit.no_ref LIKE '%".$kunci."%' AND kredit.saldo_piutang > 0 
                    ORDER BY angsuran_jadwal.tgl_angsur,prekredit.nama ";
            

         $nsblist = DB::connection('pgsql')->select(DB::raw($sql)); 


       foreach($nsblist as $angs){
                $arr = array(0,0,0,0,0);
                $arr[0] = $angs->tgl_mulai;
                $arr[1] = $angs->angs_bunga;
               
                $after = date('d',strtotime(intval($arr[0])));
                $lastDate = date('t');
                $angs->lastDate = $lastDate;
                // $angs->$after = $after;

                $bhr = ($arr[1]/$lastDate);
                $bakhir = (($lastDate-$after)*$bhr);
                $bit = ($arr[1]-$bakhir);
                $angs->bit = $bit;
         // $jakrual =0;
         // $jakrual += $bit;
        // Log::info($jakrual);
       }     

                $jakrual = 0;
                foreach ($nsblist as $angs) {
                $jakrual += $angs->bit;
                }
         $jumlah =  "SELECT count(angsuran_jadwal.no_kredit) as nomor FROM angsuran_jadwal 
                    Left Join angsuran_kartu ON angsuran_kartu.no_kredit = angsuran_jadwal.no_kredit AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
                    Left Join kredit ON angsuran_jadwal.no_kredit = kredit.no_kredit
                    where kredit.no_ref LIKE '%".$kunci."%' AND kredit.saldo_piutang > 0 ";
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('laporan.jatuhtempo.laptemponpp',compact('nsblist','bit','akrual','jakrual','lastDate','after','nsblistjumlah'));
    }

    public function viewTempoHari($tanggal=null)
    {
        $tgl = explode('-', $tanggal);

        // $sql = "SELECT kredit.no_kredit,no_ref,arav,tgl_mulai,pinj_prsbunga,saldo_piutang,prekredit.nama,prekredit.nohp,prekredit.notelp,
        //         angsuran_jadwal.angs_pokok,angsuran_jadwal.angs_bunga,
        //         angsuran_jadwal.tgl_angsur,(angsuran_jadwal.angs_pokok+angsuran_jadwal.angs_bunga) as angsuran,
        //         angsuran_kartu.angs_tgl,angsuran_kartu.angs_ke,
        //         angsuran_kartu.transfer_tgl, CASE WHEN transfer_tgl <> '1900-01-01 00:00:00' THEN DATE_PART('day', transfer_tgl::timestamp - tgl_angsur::timestamp) ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
        //             END as diff,(angsuran_kartu.angs_titippokok+angsuran_kartu.angs_pokok) as pokok,(angsuran_kartu.angs_titipbunga+angsuran_kartu.angs_bunga) as bunga,angsuran_kartu.denda,angsuran_jadwal.bayar_ke
        //          FROM prekredit,(select no_kredit,count(no_kredit) as ke 
        //          FROM angsuran_jadwal GROUP BY no_kredit) as ak 
        //          RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
        //          RIGHT JOIN angsuran_jadwal ON ak.no_kredit = angsuran_jadwal.no_kredit
        //          RIGHT JOIN angsuran_kartu ON ak.no_kredit = angsuran_kartu.no_kredit
        //          WHERE ";  


        //      $sql .= "kredit.no_kredit=prekredit.no_kredit and angsuran_jadwal.tgl_angsur::timestamp 
        //       = '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'  AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
        //      order by nama ASC";
        $sql = "SELECT
                    angsuran_jadwal.no_kredit,
                    angsuran_jadwal.tgl_angsur,
                    angsuran_jadwal.sangs,
                    angsuran_jadwal.angs_pokok,
                    angsuran_jadwal.angs_bunga,
                    angsuran_jadwal.bayar_ke,
                    angsuran_jadwal.janji_palsu,
                    angsuran_kartu.angs_ke,
                    angsuran_kartu.angs_nobukti,
                    angsuran_kartu.angs_tgl,
                    (angsuran_jadwal.angs_pokok+angsuran_jadwal.angs_bunga) as angsuran,
                    (angsuran_kartu.angs_titippokok+angsuran_kartu.angs_pokok) as pokok,
                    (angsuran_kartu.angs_titipbunga+angsuran_kartu.angs_bunga) as bunga,
                    kredit.no_ref,
                    prekredit.nohp,
                    prekredit.notelp,
                    kredit.tgl_mulai,
                    prekredit.nama,
                    CASE WHEN transfer_tgl <> '1900-01-01 00:00:00' THEN DATE_PART('day', transfer_tgl::timestamp - tgl_angsur::timestamp) ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
                    END as diff,
                    kredit.saldo_piutang AS saldo_piutang_akhir,
                    angsuran_kartu.sld_piutang AS saldo_piutang
                FROM
                    angsuran_jadwal
                    Left Join angsuran_kartu ON angsuran_kartu.no_kredit = angsuran_jadwal.no_kredit AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
                    Left Join prekredit ON angsuran_jadwal.no_kredit = prekredit.no_kredit
                    Left Join kredit ON angsuran_jadwal.no_kredit = kredit.no_kredit
                WHERE
                    angsuran_jadwal.tgl_angsur >=  '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."' AND
                    angsuran_jadwal.tgl_angsur <=  '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."' AND kredit.saldo_piutang > 0 
                ORDER BY angsuran_jadwal.tgl_angsur,prekredit.nama ";

         $nsblist = DB::connection('pgsql')->select(DB::raw($sql)); 

        foreach($nsblist as $angs){
                $arr = array(0,0,0,0,0);
                $arr[0] = $angs->tgl_mulai;
                $arr[1] = $angs->angs_bunga;
               
                $after = date('d',strtotime(intval($arr[0])));
                $lastDate = date('t');
                // $lastDate = date('t',strtotime($nextYear.'-'.$nextMonth.'-01'));
                $angs->lastDate = $lastDate;
                // $angs->$after = $after;

                $bhr = ($arr[1]/$lastDate);
                $bakhir = (($lastDate-$after)*$bhr);
                $bit = ($arr[1]-$bakhir);
                $angs->bit = $bit;
         // $jakrual =0;
         // $jakrual += $bit;
        // Log::info($jakrual);
       }     

                $jakrual = 0;
                foreach ($nsblist as $angs) {
                $jakrual += $angs->bit;
                }  

        $jumlah =  "SELECT count(angsuran_jadwal.no_kredit) as nomor FROM angsuran_jadwal 
                     Left Join angsuran_kartu ON angsuran_kartu.no_kredit = angsuran_jadwal.no_kredit AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
                    Left Join kredit ON angsuran_jadwal.no_kredit = kredit.no_kredit
                    where angsuran_jadwal.tgl_angsur::timestamp= '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."' AND kredit.saldo_piutang > 0 ";
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('laporan.jatuhtempo.laptempohari',compact('nsblist','bit','akrual','jakrual','lastDate','after','nsblistjumlah'));
    }

     public function viewTempoTanggal($tanggal1=null,$tanggal2=null)
    {
        // $tgl = explode('-', $tanggal);

        // $sql = "SELECT kredit.no_kredit,no_ref,arav,tgl_mulai,pinj_prsbunga,saldo_piutang,prekredit.nama,prekredit.nohp,prekredit.notelp,
        //         angsuran_jadwal.angs_pokok,angsuran_jadwal.angs_bunga,
        //         angsuran_jadwal.tgl_angsur,(angsuran_jadwal.angs_pokok+angsuran_jadwal.angs_bunga) as angsuran,
        //         angsuran_kartu.angs_tgl,angsuran_kartu.angs_ke,
        //         angsuran_kartu.transfer_tgl, CASE WHEN transfer_tgl <> '1900-01-01 00:00:00' THEN DATE_PART('day', transfer_tgl::timestamp - tgl_angsur::timestamp) ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
        //             END as diff,(angsuran_kartu.angs_titippokok+angsuran_kartu.angs_pokok) as pokok,(angsuran_kartu.angs_titipbunga+angsuran_kartu.angs_bunga) as bunga,angsuran_kartu.denda,angsuran_jadwal.bayar_ke
        //          FROM prekredit,(select no_kredit,count(no_kredit) as ke 
        //          FROM angsuran_jadwal GROUP BY no_kredit) as ak 
        //          RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
        //          RIGHT JOIN angsuran_jadwal ON ak.no_kredit = angsuran_jadwal.no_kredit
        //          RIGHT JOIN angsuran_kartu ON ak.no_kredit = angsuran_kartu.no_kredit
        //          WHERE ";  


        //      $sql .= "kredit.no_kredit=prekredit.no_kredit 
        //      and angsuran_jadwal.tgl_angsur::timestamp 
        //      BETWEEN  '".date('Y-m-d 00:00:00',strtotime($tanggal1))."'
        //      and  '".date('Y-m-d 00:00:00',strtotime($tanggal2))."' AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
        //      order by nama ASC";

         // GROUP BY kredit.no_kredit,
         //             angsuran_jadwal.no_kredit,
         //            angsuran_jadwal.tgl_angsur,
         //            angsuran_jadwal.sangs,
         //            angsuran_jadwal.angs_pokok,
         //            angsuran_jadwal.angs_bunga,
         //            angsuran_jadwal.bayar_ke,
         //            angsuran_jadwal.janji_palsu,
         //            angsuran_kartu.angs_ke,
         //            angsuran_kartu.angs_nobukti,
         //            angsuran_kartu.angs_tgl,
         //            angsuran_jadwal.angs_pokok,
         //            angsuran_jadwal.angs_bunga,
         //            angsuran_kartu.angs_titippokok,
         //            angsuran_kartu.angs_pokok,
         //            angsuran_kartu.angs_titipbunga,
         //            angsuran_kartu.angs_bunga,
         //            kredit.no_ref,                    
         //            prekredit.nohp,
         //            prekredit.notelp,
         //            kredit.tgl_mulai,
         //            prekredit.nama,
         //            angsuran_kartu.transfer_tgl,
         //            kredit.saldo_piutang,
         //            angsuran_kartu.sld_piutang

         $sql = "SELECT
                    angsuran_jadwal.no_kredit,
                    angsuran_jadwal.tgl_angsur,
                    angsuran_jadwal.sangs,
                    angsuran_jadwal.angs_pokok,
                    angsuran_jadwal.angs_bunga,
                    angsuran_jadwal.bayar_ke,
                    angsuran_jadwal.janji_palsu,
                    angsuran_kartu.angs_ke,
                    angsuran_kartu.angs_nobukti,
                    angsuran_kartu.angs_tgl,
                    (angsuran_jadwal.angs_pokok+angsuran_jadwal.angs_bunga) as angsuran,
                    (angsuran_kartu.angs_titippokok+angsuran_kartu.angs_pokok) as pokok,
                    (angsuran_kartu.angs_titipbunga+angsuran_kartu.angs_bunga) as bunga,
                    kredit.no_ref,
                    prekredit.nohp,
                    prekredit.notelp,
                    kredit.tgl_mulai,
                    prekredit.nama,

                    CASE WHEN transfer_tgl <> '1900-01-01 00:00:00' THEN DATE_PART('day', transfer_tgl::timestamp - tgl_angsur::timestamp) ELSE DATE_PART('day', angs_tgl::timestamp - tgl_angsur::timestamp)
                    END as diff,
                    kredit.saldo_piutang AS saldo_piutang_akhir,
                    angsuran_kartu.sld_piutang AS saldo_piutang
                FROM
                    angsuran_jadwal
                    Left Join angsuran_kartu ON angsuran_kartu.no_kredit = angsuran_jadwal.no_kredit AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
                    Left Join prekredit ON angsuran_jadwal.no_kredit = prekredit.no_kredit
                    Left Join kredit ON angsuran_jadwal.no_kredit = kredit.no_kredit
                WHERE
                     angsuran_jadwal.tgl_angsur >=  '".date('Y-m-d 00:00:00',strtotime($tanggal1))."' AND
                    angsuran_jadwal.tgl_angsur <=  '".date('Y-m-d 00:00:00',strtotime($tanggal2))."' AND kredit.saldo_piutang > 0
                    ORDER BY angsuran_jadwal.tgl_angsur,prekredit.nama ";

         $nsblist = DB::connection('pgsql')->select(DB::raw($sql)); 

       foreach($nsblist as $angs){
                $arr = array(0,0,0,0,0);
                $arr[0] = $angs->tgl_mulai;
                $arr[1] = $angs->angs_bunga;
               
                $after = date('d',strtotime(intval($arr[0])));
                $lastDate = date('t');
                $angs->lastDate = $lastDate;
                // $angs->$after = $after;

                $bhr = ($arr[1]/$lastDate);
                $bakhir = (($lastDate-$after)*$bhr);
                $bit = ($arr[1]-$bakhir);
                $angs->bit = $bit;
         // $jakrual =0;
         // $jakrual += $bit;
        // Log::info($jakrual);
       }     

                $jakrual = 0;
                foreach ($nsblist as $angs) {
                $jakrual += $angs->bit;
                }  

         $jumlah =  "SELECT count(angsuran_jadwal.no_kredit) as nomor FROM angsuran_jadwal 
                    Left Join angsuran_kartu ON angsuran_kartu.no_kredit = angsuran_jadwal.no_kredit AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
                    Left Join kredit ON angsuran_jadwal.no_kredit = kredit.no_kredit
                    where angsuran_jadwal.tgl_angsur >=  '".date('Y-m-d 00:00:00',strtotime($tanggal1))."' AND
                    angsuran_jadwal.tgl_angsur <=  '".date('Y-m-d 00:00:00',strtotime($tanggal2))."' AND kredit.saldo_piutang > 0 ";
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah));  

        return view('laporan.jatuhtempo.laptempotanggal',compact('nsblist','bit','akrual','jakrual','lastDate','after','nsblistjumlah'));
    }

    public function viewNominatif()
    {
        // ini_set('max_execution_time', '3000');
        // ini_set('memory_limit','512M');
        $page = (Input::get('page')) ? Input::get('page') : 1; // Get the current page for the request
        $limit = 10;
        $offset = ($page-1) * $limit;

        $sql = "SELECT kredit.no_kredit,kredit.pinj_pokok,kredit.bakidebet,pinj_prsbunga,saldo_bbt,tgl_kredit,jatuhtempo, 
                no_ref,lama,tgl_mulai,saldo_piutang,prekredit.nama
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_jadwal GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 WHERE ";  

        $sql .= "kredit.no_kredit=prekredit.no_kredit AND (kredit.tgl_lunas = '1900-01-01 00:00:00' OR kredit.tgl_lunas = '1970-01-01 00:00:00' OR kredit.tgl_lunas >= '".date('Y-m-d 00:00:00')."') AND (kredit.tgl_hapusint = '1900-01-01 00:00:00' OR kredit.tgl_hapusint = '1970-01-01 00:00:00') AND  (kredit.tgl_hapusbi = '1900-01-01 00:00:00' OR kredit.tgl_hapusbi = '1970-01-01 00:00:00') order by nama ASC";

        $total = count(DB::connection('pgsql')->select(DB::raw($sql.";")));
        Log::info($total);
        
        $nsblist = DB::connection('pgsql')->select(DB::raw($sql." LIMIT ".$limit." OFFSET ".$offset.";"));
        
        $pagination = new Paginator($nsblist, $total, $limit,$page,array("path" => url('/lapnominatif')));

        // $nsblist = DB::connection('pgsql')->select(DB::raw($sql)); 

        // $jumlah =  "SELECT count(kredit.no_kredit) as nomor FROM kredit 
        //             RIGHT JOIN prekredit ON prekredit.no_kredit = kredit.no_kredit where
        //             kredit.no_kredit=prekredit.no_kredit AND (kredit.tgl_lunas = '1900-01-01 00:00:00' OR kredit.tgl_lunas = '1970-01-01 00:00:00' OR kredit.tgl_lunas >= '".date('Y-m-d 00:00:00')."') AND (kredit.tgl_hapusint = '1900-01-01 00:00:00' OR kredit.tgl_hapusint = '1970-01-01 00:00:00') AND  (kredit.tgl_hapusbi = '1900-01-01 00:00:00' OR kredit.tgl_hapusbi = '1970-01-01 00:00:00')";
        // $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah)); 

        $jumlah =  "SELECT count(kredit.no_kredit) as nomor,sum(kredit.pinj_pokok) as jpokok2,sum(kredit.bakidebet) as jbakidebet2, sum(kredit.saldo_bbt) as jsbbt2, sum(kredit.bakidebet+kredit.saldo_bbt) as jsalpi2 FROM kredit 
                    RIGHT JOIN prekredit ON prekredit.no_kredit = kredit.no_kredit where
                    kredit.no_kredit=prekredit.no_kredit AND (kredit.tgl_lunas = '1900-01-01 00:00:00' OR kredit.tgl_lunas = '1970-01-01 00:00:00' OR kredit.tgl_lunas >= '".date('Y-m-d 00:00:00')."') AND (kredit.tgl_hapusint = '1900-01-01 00:00:00' OR kredit.tgl_hapusint = '1970-01-01 00:00:00') AND  (kredit.tgl_hapusbi = '1900-01-01 00:00:00' OR kredit.tgl_hapusbi = '1970-01-01 00:00:00')";
         $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah)); 

         // $jumlah2 =  "SELECT sum(kredit.pinj_pokok) as jpokok2,sum(kredit.bakidebet) as jbakidebet2, sum(kredit.saldo_bbt) as jsbbt2, sum(kredit.bakidebet+kredit.saldo_bbt) as jsalpi2 FROM kredit 
         //            LEFT JOIN prekredit ON prekredit.no_kredit = kredit.no_kredit where
         //            kredit.no_kredit=prekredit.no_kredit AND (kredit.tgl_lunas = '1900-01-01 00:00:00' OR kredit.tgl_lunas = '1970-01-01 00:00:00' OR kredit.tgl_lunas >= '".date('Y-m-d 00:00:00')."') AND (kredit.tgl_hapusint = '1900-01-01 00:00:00' OR kredit.tgl_hapusint = '1970-01-01 00:00:00') AND  (kredit.tgl_hapusbi = '1900-01-01 00:00:00' OR kredit.tgl_hapusbi = '1970-01-01 00:00:00')";
         // $nsblistjumlah2 = DB::connection('pgsql')->select(DB::raw($jumlah2)); 

        // $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah." LIMIT ".$limit." OFFSET ".$offset.";"));

        $jpokok = 0;
        $jbakidebet = 0;
        $jsbbt = 0;
        $jsalpi = 0;

        foreach ($nsblist as $nsb)
            {
                $jpokok += $nsb->pinj_pokok;
                $tunggak = "SELECT
                                count(*) as tunggak
                            FROM
                                angsuran_jadwal
                                Left JOIN angsuran_kartu ON angsuran_kartu.no_kredit = angsuran_jadwal.no_kredit AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
                            WHERE
                                angsuran_jadwal.no_kredit = '".$nsb->no_kredit."' AND
                                angsuran_jadwal.tgl_angsur <=  '".date('Y-m-d 00:00:00')."' AND
                                angsuran_kartu.angs_tgl ISNULL";

                $tunggaklist = DB::connection('pgsql')->select(DB::raw($tunggak))[0]; 
                $nsb->tunggak = $tunggaklist->tunggak;


                //Log::info($nsb->tunggak);
            
                $baki = "SELECT no_kredit,((pinj_pokok)-(select (sum(pokok)) from angsuran_bayar ab 
                         where ab.no_kredit='".$nsb->no_kredit."' and tanggal <= '".date('Y-m-d 00:00:00')."'
                         ))as baki from kredit where no_kredit='".$nsb->no_kredit."'";

                $bakilist = DB::connection('pgsql')->select(DB::raw($baki))[0]; 
                $nsb->baki = $bakilist->baki;
                // Log::info($nsb->baki);

               // menghitung Faktor pengurang
                $fkurang = "SELECT
                                kredit.no_kredit,
                                kredit.otr,
                                kredit.pengikatan,
                                agunan_kredit.jenis,
                                agunan_kredit.niltaksasi,
                                agunan_kredit.nilnjop,
                                agunan_kredit.nilhaktg,
                                CASE 
                                WHEN
                                    agunan_kredit.niltaksasi != '0' and agunan_kredit.jenis != '1-3' 
                                THEN
                                    (agunan_kredit.niltaksasi*50/100)
                                WHEN
                                    agunan_kredit.niltaksasi = '0' and agunan_kredit.jenis != '1-3' 
                                THEN
                                    (kredit.otr*50/100)
                                WHEN
                                    kredit.pengikatan = 'SHM' and agunan_kredit.jenis = '1-3' and agunan_kredit.nilnjop != '0'
                                THEN
                                    (agunan_kredit.nilnjop*60/100)
                                WHEN
                                    kredit.pengikatan = 'APHT' and agunan_kredit.jenis = '1-3' and agunan_kredit.nilnjop != '0'
                                THEN
                                    (agunan_kredit.nilhaktg*80/100)
                                WHEN
                                    kredit.pengikatan = 'SHM' and agunan_kredit.jenis = '1-3' and agunan_kredit.nilnjop = '0'
                                THEN
                                    (kredit.otr*60/100)
                                WHEN
                                    kredit.pengikatan = 'APHT' and agunan_kredit.jenis = '1-3' and agunan_kredit.nilnjop = '0'
                                THEN
                                    (kredit.otr*80/100)
                                END
                                    as fpengurang
                                FROM
                                    agunan_kredit,
                                    kredit
                                WHERE
                                    kredit.no_kredit = '".$nsb->no_kredit."' ";

                $fpenguranglist = DB::connection('pgsql')->select(DB::raw($fkurang))[0]; 
                $nsb->fp = $fpenguranglist->fpengurang;

                $ppap   = $nsb->baki-$nsb->fp; 
                if ($ppap < 0) {
                    $ppap = 0;
                }
                $nsb->fp1 = $ppap; 
                

                // menghitung saldo bbt
                $sbbt = "SELECT no_kredit,((bbt)-(select (sum(angs_titipbunga)+sum(angs_bunga)) from angsuran_kartu ak 
                         where ak.no_kredit='".$nsb->no_kredit."' and angs_tgl <= '".date('Y-m-d 00:00:00')."'
                         ))as bbt from kredit where no_kredit='".$nsb->no_kredit."'";

                $sbbtlist = DB::connection('pgsql')->select(DB::raw($sbbt))[0]; 
                $nsb->bbt = $sbbtlist->bbt;

                $nsb->salpi = $nsb->baki+$nsb->bbt;

                $jbakidebet += $nsb->baki;
                $jsbbt += $nsb->bbt;
                $jsalpi += $nsb->salpi;
        }
        Log::info($jbakidebet);
        Log::info($jsbbt);

        $sql = "SELECT SUM(kredit.bakidebet) as bakidebet,SUM(kredit.pinj_pokok) as pinjpokok,SUM(kredit.saldo_bbt) as bbt,SUM(kredit.saldo_piutang) as salpi
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_jadwal GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 WHERE ";  

        $sql .= "kredit.no_kredit=prekredit.no_kredit AND (kredit.tgl_lunas = '1900-01-01 00:00:00' OR kredit.tgl_lunas = '1970-01-01 00:00:00' OR kredit.tgl_lunas >= '".date('Y-m-d 00:00:00')."') AND (kredit.tgl_hapusint = '1900-01-01 00:00:00' OR kredit.tgl_hapusint = '1970-01-01 00:00:00') AND  (kredit.tgl_hapusbi = '1900-01-01 00:00:00' OR kredit.tgl_hapusbi = '1970-01-01 00:00:00') group by prekredit.nama";

        $totalkredit = DB::connection('pgsql')->select(DB::raw($sql.";"));
        
        $jmlall = array('jpokok'=>0,'jbakidebet'=>0,'jsbbt'=>0,'jsalpi'=>0);
        foreach(array_chunk($totalkredit, 50) as $kredit){
            foreach($kredit as $k){
                $jmlall['jpokok'] += $k->pinjpokok;
                $jmlall['jbakidebet'] += $k->bakidebet;
                $jmlall['jsbbt'] += $k->bbt;
                $jmlall['jsalpi'] += $k->salpi;   
            }
        }
        Log::info($jmlall);
        return view('laporan.lapnominatif',compact('nsblist','tunggak','tunggaklist','nsblistjumlah','bakilist','pagination','jpokok','jsalbbt','jsalpi','jbakidebet','ppap','jsbbt','sbbtlist','saldopi','jppap','bakiKL','bakiKLDM','bakiD','bakiM','npf','bakiL','bakiDP','arr','nsblist2','bakilist2','tunggaklist2','jbakiM','jbakiD','jbakiKL','jbakiL','jbakiDP','jbakidebet2','jpokok2','jsalpi2','jsbbt2'));
    }

    public function getNomTotal(Request $request)
    {
        // ini_set('max_execution_time', '3000');
        // ini_set('memory_limit','512M');
        $page = $request->input('page'); // Get the current page for the request
        $limit = 10;
        $offset = ($page-1) * $limit;

        $sql = "SELECT kredit.no_kredit,kredit.pinj_pokok,kredit.bakidebet,pinj_prsbunga,saldo_bbt,tgl_kredit,jatuhtempo, 
                no_ref,lama,tgl_mulai,saldo_piutang,prekredit.nama
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_jadwal GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 WHERE ";  

        $sql .= "kredit.no_kredit=prekredit.no_kredit AND (kredit.tgl_lunas = '1900-01-01 00:00:00' OR kredit.tgl_lunas = '1970-01-01 00:00:00' OR kredit.tgl_lunas >= '".date('Y-m-d 00:00:00')."') AND (kredit.tgl_hapusint = '1900-01-01 00:00:00' OR kredit.tgl_hapusint = '1970-01-01 00:00:00') AND  (kredit.tgl_hapusbi = '1900-01-01 00:00:00' OR kredit.tgl_hapusbi = '1970-01-01 00:00:00') order by nama ASC";
        
        $nsblist = DB::connection('pgsql')->select(DB::raw($sql." LIMIT ".$limit." OFFSET ".$offset.";"));

        $hasil = array('jpokok'=>0,'jbakidebet'=>0,'jsbbt'=>0,'jsalpi'=>0);
        foreach ($nsblist as $nsb)
        {
                $hasil['jpokok'] += $nsb->pinj_pokok;

                // $baki = "SELECT no_kredit,((pinj_pokok)-(select (sum(pokok)) from angsuran_bayar ab 
                //          where ab.no_kredit='".$nsb->no_kredit."' and tanggal <= '".date('Y-m-d 00:00:00')."'
                //          ))as baki from kredit where no_kredit='".$nsb->no_kredit."'";
                $baki = "SELECT no_kredit,((pinj_pokok)-(select (sum(angs_titippokok)+sum(angs_pokok)) from angsuran_kartu ak 
                         where ak.no_kredit='".$nsb->no_kredit."' and angs_tgl <= '".date('Y-m-d 00:00:00')."'
                         ))as baki from kredit where no_kredit='".$nsb->no_kredit."'";


                $bakilist = DB::connection('pgsql')->select(DB::raw($baki))[0]; 
                $hasil['jbakidebet'] += $bakilist->baki;

                // menghitung saldo bbt
                $sbbt = "SELECT no_kredit,((bbt)-(select (sum(angs_titipbunga)+sum(angs_bunga)) from angsuran_kartu ak 
                         where ak.no_kredit='".$nsb->no_kredit."' and angs_tgl <= '".date('Y-m-d 00:00:00')."'
                         ))as bbt from kredit where no_kredit='".$nsb->no_kredit."'";

                $sbbtlist = DB::connection('pgsql')->select(DB::raw($sbbt))[0]; 
                $hasil['jsbbt'] += $sbbtlist->bbt;

                $hasil['jsalpi'] += $hasil['jbakidebet']+$hasil['jsbbt'];
        }
        Log::info($hasil['jbakidebet']);
        //Log::info($page.' bunga'.$hasil['jsbbt']);
        return $hasil;
    }

    public function viewNominatifTanggal($tanggal=null)
    {
        // $tgl = explode('-', $tanggal);
        $page = (Input::get('page')) ? Input::get('page') : 1; // Get the current page for the request
        $limit = 10;
        $offset = ($page-1) * $limit;

        $sql = "SELECT kredit.no_kredit,kredit.pinj_pokok,kredit.bakidebet,pinj_prsbunga,saldo_bbt,tgl_kredit,jatuhtempo, 
                no_ref,lama,tgl_mulai,saldo_piutang,prekredit.nama
                 FROM prekredit,(select no_kredit,count(no_kredit) as ke 
                 FROM angsuran_jadwal GROUP BY no_kredit) as ak 
                 RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
                 WHERE ";  

        $sql .= "kredit.no_kredit=prekredit.no_kredit AND (kredit.tgl_lunas = '1900-01-01 00:00:00' OR kredit.tgl_lunas = '1970-01-01 00:00:00' OR kredit.tgl_lunas >= '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."') AND (kredit.tgl_hapusint = '1900-01-01 00:00:00' OR kredit.tgl_hapusint = '1970-01-01 00:00:00') AND  (kredit.tgl_hapusbi = '1900-01-01 00:00:00' OR kredit.tgl_hapusbi = '1970-01-01 00:00:00') order by nama ASC";

        $total = count(DB::connection('pgsql')->select(DB::raw($sql.";"))); 
        
        $nsblist = DB::connection('pgsql')->select(DB::raw($sql." LIMIT ".$limit." OFFSET ".$offset.";"));

        $pagination = new Paginator($nsblist, $total, $limit,$page,array("path" => url('/lapnominatiftanggal/'.$tanggal)));


                $jbakidebet = 0;
                $jsbbt = 0;
                $jsalpi = 0;
                // $jppap = 0;
                foreach ($nsblist as $b) {
                $jbakidebet += $b->baki;
                $jsbbt += $b->bbt;
                $jsalpi += $b->salpi;
                // $jppap += $ppap;
                }     

        return view('laporan.lapnominatif',compact('nsblist','tunggak','tunggaklist','nsblistjumlah','bakilist','pagination','jpokok','jsalbbt','jsalpi','jbakidebet','ppap','jsbbt','sbbtlist','saldopi','jppap','bakiKL','bakiKLDM','bakiD','bakiM','npf','bakiL','bakiDP','arr','nsblist2','bakilist2','tunggaklist2','jbakiM','jbakiD','jbakiKL','jbakiL','jbakiDP','jbakidebet2','jpokok2','jsalpi2','jsbbt2','jumlah2','nsblistjumlah2'));
    }

    // public function viewNominatifTanggal($tanggal=null)
    // {
    //     // $tgl = explode('-', $tanggal);

    //     $page = (Input::get('page')) ? Input::get('page') : 1; // Get the current page for the request
    //     $limit = 10;
    //     $offset = ($page-1) * $limit;

    //     $sql = "SELECT kredit.no_kredit,kredit.pinj_pokok,kredit.bakidebet,pinj_prsbunga,saldo_bbt,tgl_kredit,jatuhtempo, 
    //             no_ref,lama,tgl_mulai,saldo_piutang,prekredit.nama
    //              FROM prekredit,(select no_kredit,count(no_kredit) as ke 
    //              FROM angsuran_jadwal GROUP BY no_kredit) as ak 
    //              RIGHT JOIN kredit ON ak.no_kredit = kredit.no_kredit 
    //              WHERE ";  

    //     $sql .= "kredit.no_kredit=prekredit.no_kredit AND (kredit.tgl_lunas = '1900-01-01 00:00:00' OR kredit.tgl_lunas = '1970-01-01 00:00:00' OR kredit.tgl_lunas >= '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."') AND (kredit.tgl_hapusint = '1900-01-01 00:00:00' OR kredit.tgl_hapusint = '1970-01-01 00:00:00') AND  (kredit.tgl_hapusbi = '1900-01-01 00:00:00' OR kredit.tgl_hapusbi = '1970-01-01 00:00:00') order by nama ASC";

    //     $total = count(DB::connection('pgsql')->select(DB::raw($sql.";")));
        
    //     $nsblist = DB::connection('pgsql')->select(DB::raw($sql." LIMIT ".$limit." OFFSET ".$offset.";"));

    //     $pagination = new Paginator($nsblist, $total, $limit,$page,array("path" => url('/lapnominatiftanggal/'.$tanggal)));

    //     // $nsblist = DB::connection('pgsql')->select(DB::raw($sql)); 


    //     $jumlah =  "SELECT count(kredit.no_kredit) as nomor FROM kredit 
    //                 RIGHT JOIN prekredit ON prekredit.no_kredit = kredit.no_kredit where
    //                 kredit.no_kredit=prekredit.no_kredit AND (kredit.tgl_lunas = '1900-01-01 00:00:00' OR kredit.tgl_lunas = '1970-01-01 00:00:00' OR kredit.tgl_lunas >= '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."') AND (kredit.tgl_hapusint = '1900-01-01 00:00:00' OR kredit.tgl_hapusint = '1970-01-01 00:00:00') AND  (kredit.tgl_hapusbi = '1900-01-01 00:00:00' OR kredit.tgl_hapusbi = '1970-01-01 00:00:00')";
    //     $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah." LIMIT ".$limit." OFFSET ".$offset.";"));


    //     $jpokok2 = 0;
    //     foreach ($nsblist2 as $nsb) {
    //         $jpokok2 += $nsb->pinj_pokok;
    //     }

    //     foreach ($nsblist2 as $nsb2)
    //     {

    //     //         $tunggak2 = "SELECT
    //     //                         count(*) as tunggak2
    //     //                     FROM
    //     //                         angsuran_jadwal
    //     //                         Left JOIN angsuran_kartu ON angsuran_kartu.no_kredit = angsuran_jadwal.no_kredit AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
    //     //                     WHERE
    //     //                         angsuran_jadwal.no_kredit = '".$nsb->no_kredit."' AND
    //     //                         angsuran_jadwal.tgl_angsur <=  '".date('Y-m-d 00:00:00')."' AND
    //     //                         angsuran_kartu.angs_tgl ISNULL";

    //     //         $tunggaklist2 = DB::connection('pgsql')->select(DB::raw($tunggak2))[0]; 
    //     //         $nsb2->tunggak2 = $tunggaklist2->tunggak2;

    //             $baki2 = "SELECT no_kredit,((pinj_pokok)-(select (sum(pokok)) from angsuran_bayar ab 
    //                      where ab.no_kredit='".$nsb2->no_kredit."' and tanggal <= '".date('Y-m-d 00:00:00')."'
    //                      ))as baki2 from kredit where no_kredit='".$nsb2->no_kredit."'";

    //             $bakilist2 = DB::connection('pgsql')->select(DB::raw($baki2))[0]; 
    //             $nsb2->baki2 = $bakilist2->baki2;

    //     //             if ( $tunggaklist2->tunggak2 <= 1){
    //     //                 $bakiL = (((5/100)*$bakilist2->baki2)*($tunggaklist2->tunggak2));
    //     //                 // $arr[3] = $bakiL;
    //     //             $nsb2->bakiL = $bakiL;
    //     //             }
    //     //             if ( $tunggaklist2->tunggak2 > 1  && $tunggaklist2->tunggak2 <=3){
    //     //                 $bakiDP = (((5/100)*$bakilist2->baki2)*($tunggaklist2->tunggak2));  
    //     //                 // $arr[4] = $bakiDP;
    //     //             $nsb2->bakiDP = $bakiDP;
    //     //             }
    //     //             if ( $tunggaklist2->tunggak2 > 3 && $tunggaklist2->tunggak2 <= 6){
    //     //                 $bakiKL = (((10/100)*$bakilist2->baki2)*($tunggaklist2->tunggak2));
    //     //                 // $arr[0] = $bakiKL;
    //     //             $nsb2->bakiKL = $bakiKL;
    //     //             }
    //     //             if ( $tunggaklist2->tunggak2 > 6 && $tunggaklist2->tunggak2 <= 12){
    //     //                 $bakiD = (((50/100)*$bakilist2->baki2)*($tunggaklist2->tunggak2));
    //     //                 // $arr[1] = $bakiD;
    //     //             $nsb2->bakiD = $bakiD;
    //     //             }
    //     //             if ( $tunggaklist2->tunggak2 > 12){
    //     //                 $bakiM  = (((100/100)*$bakilist2->baki2)*($tunggaklist2->tunggak2));
    //     //                 // $arr[2] = $bakiM;
    //     //             $nsb2->bakiM = $bakiM;
    //     //             }

    //     //         $jbakiL = 0;
    //     //         $jbakiDP = 0;
    //     //         $jbakiKL = 0;
    //     //         $jbakiD = 0;
    //     //         $jbakiM =0;
    //     //         $jbakiL += $nsb2->bakiL;
    //     //         $jbakiDP += $nsb2->bakiDP;
    //     //         $jbakiKL += $nsb2->bakiKL;
    //     //         $jbakiD += $nsb2->bakiD;
    //     //         $jbakiM +=  $nsb2->bakiM;
    //             $sbbt2 = "SELECT no_kredit,((bbt)-(select (sum(angs_titipbunga)+sum(angs_bunga)) from angsuran_kartu ak 
    //                      where ak.no_kredit='".$nsb2->no_kredit."' and angs_tgl <= '".date('Y-m-d 00:00:00')."'
    //                      ))as bbt2 from kredit where no_kredit='".$nsb2->no_kredit."'";

    //             $sbbtlist = DB::connection('pgsql')->select(DB::raw($sbbt2))[0]; 
    //             $nsb2->bbt2 = $sbbtlist->bbt2;

    //             $arr = array(0,0,0,0,0);
    //             $arr[0] = $nsb2->baki2;
    //             $arr[1] = $nsb2->bbt2; 
    //             $saldopi2   = $arr[0]+$arr[1]; 
    //             $nsb2->salpi2 = $saldopi2;   
    //     }

    //             $jbakidebet2 = 0;
    //             $jsbbt2 = 0;
    //             $jsalpi2 = 0;
    //             // $jppap = 0;
    //             foreach ($nsblist2 as $b) {
    //             $jbakidebet2 += $b->baki2;
    //             $jsbbt2 += $b->bbt2;
    //             $jsalpi2 += $b->salpi2;
    //             // $jppap += $ppap;
    //             }
    //             // $jbakiL = 0;
    //             // $jbakiDP = 0;
    //             // $jbakiKL = 0;
    //             // $jbakiD = 0;
    //             // $jbakiM =0;
    //             // // $jppap = 0;
    //             // foreach ($nsblist2 as $nsb2) {
    //             // $jbakiL += $nsb2->bakiL;
    //             // $jbakiDP += $nsb2->bakiDP;
    //             // $jbakiKL += $nsb2->bakiKL;
    //             // $jbakiD += $nsb2->bakiD;
    //             // $jbakiM +=  $nsb2->bakiM;
    //             // // $jppap += $ppap;
    //             // }  


    //     $jpokok = 0;
    //     foreach ($nsblist as $nsb) {
    //         $jpokok += $nsb->pinj_pokok;
    //     }

    //     foreach ($nsblist as $nsb)
    //         {

    //             $tunggak = "SELECT
    //                             count(*) as tunggak
    //                         FROM
    //                             angsuran_jadwal
    //                             Left JOIN angsuran_kartu ON angsuran_kartu.no_kredit = angsuran_jadwal.no_kredit AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
    //                         WHERE
    //                             angsuran_jadwal.no_kredit = '".$nsb->no_kredit."' AND
    //                             angsuran_jadwal.tgl_angsur <=  '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."' AND
    //                             angsuran_kartu.angs_tgl ISNULL";

    //             $tunggaklist = DB::connection('pgsql')->select(DB::raw($tunggak))[0]; 
    //             $nsb->tunggak = $tunggaklist->tunggak;

    //             //Log::info($nsb->tunggak);
            
    //             $baki = "SELECT no_kredit,((pinj_pokok)-(select (sum(pokok)) from angsuran_bayar ab 
    //                      where ab.no_kredit='".$nsb->no_kredit."' 
    //                      and tanggal <= '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'
    //                      ))as baki from kredit where no_kredit='".$nsb->no_kredit."'";

    //             $bakilist = DB::connection('pgsql')->select(DB::raw($baki))[0]; 
    //             $nsb->baki = $bakilist->baki;

    //            // menghitung Faktor pengurang
    //             $fkurang = "SELECT
    //                             kredit.no_kredit,
    //                             kredit.otr,
    //                             kredit.pengikatan,
    //                             agunan_kredit.jenis,
    //                             agunan_kredit.niltaksasi,
    //                             agunan_kredit.nilnjop,
    //                             agunan_kredit.nilhaktg,
    //                             CASE 
    //                             WHEN
    //                                 agunan_kredit.niltaksasi != '0' and agunan_kredit.jenis != '1-3' 
    //                             THEN
    //                                 (agunan_kredit.niltaksasi*50/100)
    //                             WHEN
    //                                 agunan_kredit.niltaksasi = '0' and agunan_kredit.jenis != '1-3' 
    //                             THEN
    //                                 (kredit.otr*50/100)
    //                             WHEN
    //                                 kredit.pengikatan = 'SHM' and agunan_kredit.jenis = '1-3' and agunan_kredit.nilnjop != '0'
    //                             THEN
    //                                 (agunan_kredit.nilnjop*60/100)
    //                             WHEN
    //                                 kredit.pengikatan = 'APHT' and agunan_kredit.jenis = '1-3' and agunan_kredit.nilnjop != '0'
    //                             THEN
    //                                 (agunan_kredit.nilhaktg*80/100)
    //                             WHEN
    //                                 kredit.pengikatan = 'SHM' and agunan_kredit.jenis = '1-3' and agunan_kredit.nilnjop = '0'
    //                             THEN
    //                                 (kredit.otr*60/100)
    //                             WHEN
    //                                 kredit.pengikatan = 'APHT' and agunan_kredit.jenis = '1-3' and agunan_kredit.nilnjop = '0'
    //                             THEN
    //                                 (kredit.otr*80/100)
    //                             END
    //                                 as fpengurang
    //                             FROM
    //                                 agunan_kredit,
    //                                 kredit
    //                             WHERE
    //                                 kredit.no_kredit = '".$nsb->no_kredit."' ";

    //             $fpenguranglist = DB::connection('pgsql')->select(DB::raw($fkurang))[0]; 
    //             $nsb->fp = $fpenguranglist->fpengurang;

    //             $arr = array(0,0,0,0,0);
    //             $arr[0] = $nsb->baki;
    //             $arr[1] = $nsb->fp; 
    //             $ppap   = $arr[0]-$arr[1]; 
    //             if ($ppap < 0) {
    //                 $ppap = 0;
    //             }
    //             $nsb->fp1 = $ppap;   

    //             // menghitung saldo bbt
    //             $sbbt = "SELECT no_kredit,((bbt)-(select (sum(angs_titipbunga)+sum(angs_bunga)) from angsuran_kartu ak 
    //                      where ak.no_kredit='".$nsb->no_kredit."' and angs_tgl <= 
    //                      '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'
    //                      ))as bbt from kredit where no_kredit='".$nsb->no_kredit."'";

    //             $sbbtlist = DB::connection('pgsql')->select(DB::raw($sbbt))[0]; 
    //             $nsb->bbt = $sbbtlist->bbt;

    //             $arr = array(0,0,0,0,0);
    //             $arr[0] = $nsb->baki;
    //             $arr[1] = $nsb->bbt; 
    //             $saldopi   = $arr[0]+$arr[1]; 
    //             $nsb->salpi = $saldopi;   

    //     }

    //             $jbakidebet = 0;
    //             $jsbbt = 0;
    //             $jsalpi = 0;
    //             // $jppap = 0;
    //             foreach ($nsblist as $b) {
    //             $jbakidebet += $b->baki;
    //             $jsbbt += $b->bbt;
    //             $jsalpi += $b->salpi;
    //             // $jppap += $b->fp1;
    //             }

    //     return view('laporan.lapnominatiftanggal',compact('nsblist','tunggak','tunggaklist','nsblistjumlah','bakilist','pagination','jpokok','jsalbbt','jsalpi','jbakidebet','ppap','jsbbt','sbbtlist','saldopi','jppap'));
    // }

    public function viewTunggak()
    {
        $page = (Input::get('page')) ? Input::get('page') : 1; // Get the current page for the request
        $limit = 50;
        $offset = ($page-1) * $limit;

        $sql = "SELECT
                    prekredit.no_kredit,
                    kredit.no_ref,
                    prekredit.nama,
                    kredit.tgl_kredit,
                    kredit.pinj_pokok,
                    kredit.saldo_piutang,
                    kredit.jatuhtempo
                FROM
                    kredit
                LEFT JOIN prekredit ON prekredit.no_kredit = kredit.no_kredit
                WHERE
                    kredit.tgl_kredit < '".date('Y-m-d 00:00:00')."'
                AND (
                kredit.tgl_lunas > '".date('Y-m-d 00:00:00')."'
                    OR kredit.tgl_lunas = '1900-01-01 00:00:00' OR kredit.tgl_lunas = '1970-01-01 00:00:00'
                )
                AND (
                    kredit.tgl_hapusbi > '".date('Y-m-d 00:00:00')."'
                    OR kredit.tgl_hapusbi = '1900-01-01 00:00:00' OR kredit.tgl_hapusbi = '1970-01-01 00:00:00'
                )
                AND (
                    kredit.tgl_hapusint > '".date('Y-m-d 00:00:00')."'
                    OR kredit.tgl_hapusint = '1900-01-01 00:00:00' OR kredit.tgl_hapusint = '1970-01-01 00:00:00'
                )";

        $total = count(DB::connection('pgsql')->select(DB::raw($sql.";")));
        
        $tunggaklist = DB::connection('pgsql')->select(DB::raw($sql." LIMIT ".$limit." OFFSET ".$offset.";"));

        $pagination = new Paginator($tunggaklist, $total, $limit,$page,array("path" => url('/laptunggak/')));

        // $tunggaklist = DB::connection('pgsql')->select(DB::raw($sql)); 

        $jumlah =  "SELECT count(kredit.no_kredit) as nomor FROM kredit 
                    RIGHT JOIN prekredit ON prekredit.no_kredit = kredit.no_kredit where
                    kredit.tgl_kredit < '".date('Y-m-d 00:00:00')."'
                    AND (
                    kredit.tgl_lunas > '".date('Y-m-d 00:00:00')."'
                        OR kredit.tgl_lunas = '1900-01-01 00:00:00' OR kredit.tgl_lunas = '1970-01-01 00:00:00'
                    )
                    AND (
                        kredit.tgl_hapusbi > '".date('Y-m-d 00:00:00')."'
                        OR kredit.tgl_hapusbi = '1900-01-01 00:00:00' OR kredit.tgl_hapusbi = '1970-01-01 00:00:00'
                    )
                    AND (
                        kredit.tgl_hapusint > '".date('Y-m-d 00:00:00')."'
                        OR kredit.tgl_hapusint = '1900-01-01 00:00:00' OR kredit.tgl_hapusint = '1970-01-01 00:00:00'
                    )";
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah." LIMIT ".$limit." OFFSET ".$offset.";"));

        $jpokok = 0;
        foreach ($tunggaklist as $t) {
            $jpokok += $t->pinj_pokok;
        }

        foreach ($tunggaklist as $t)
            {
        
                $piutang1 = "SELECT no_kredit,((pinj_pokok)-(select(sum(angs_pokok)) from angsuran_jadwal aj
                            where aj.no_kredit= '".$t->no_kredit."'
                            and tgl_angsur <= '".date('Y-m-d 00:00:00')."'
                            )) as piutang1 from kredit where no_kredit='".$t->no_kredit."' ";
                $utanglist1 = DB::connection('pgsql')->select(DB::raw($piutang1)); 

                if(empty($utanglist1)) {
                    $van = '0';
                }else{
                    $piutang = "SELECT no_kredit,((pinj_pokok)-(select(sum(angs_pokok)) from angsuran_jadwal aj
                            where aj.no_kredit= '".$t->no_kredit."'
                            and tgl_angsur <= '".date('Y-m-d 00:00:00')."'
                            )) as piutang from kredit where no_kredit='".$t->no_kredit."' ";
                    $utanglist = DB::connection('pgsql')->select(DB::raw($piutang))[0]; 
                    $t->piutang = $utanglist->piutang;
                }
                // Log::info($t->piutang);

                $bunga1 = "SELECT no_kredit,((bbt)-(select(sum(angs_bunga)) from angsuran_jadwal aj
                         where aj.no_kredit= '".$t->no_kredit."'
                            and tgl_angsur <= '".date('Y-m-d 00:00:00')."'
                            )) as bungautang1 from kredit where no_kredit='".$t->no_kredit."' ";
                $bungalist1 = DB::connection('pgsql')->select(DB::raw($bunga1)); 

                if(empty($bungalist1)) {
                    $vaan = '0';
                }else{
                    $bunga = "SELECT no_kredit,((bbt)-(select(sum(angs_bunga)) from angsuran_jadwal aj
                             where aj.no_kredit= '".$t->no_kredit."'
                                and tgl_angsur <= '".date('Y-m-d 00:00:00')."'
                                )) as bunga from kredit where no_kredit='".$t->no_kredit."' ";
                    $bungalist = DB::connection('pgsql')->select(DB::raw($bunga))[0]; 
                    $t->bunga = $bungalist->bunga;
                }

                $kantor = substr($t->no_kredit,7,2);
                $t->kantor = $kantor;
                // Log::info($t->kantor);

                $tunggak = "SELECT
                                count(*) as tunggak
                            FROM
                                angsuran_jadwal
                                Left JOIN angsuran_kartu ON angsuran_kartu.no_kredit = angsuran_jadwal.no_kredit AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
                            WHERE
                                angsuran_jadwal.no_kredit = '".$t->no_kredit."' AND
                                angsuran_jadwal.tgl_angsur <=  '".date('Y-m-d 00:00:00')."' AND
                                angsuran_kartu.angs_tgl ISNULL";

                $tunggaklist1 = DB::connection('pgsql')->select(DB::raw($tunggak))[0]; 
                $t->tunggak = $tunggaklist1->tunggak;

                $pokok = "SELECT SUM (angsuran_jadwal.angs_pokok) - SUM (
                                        angsuran_kartu.angs_pokok + angsuran_kartu.angs_titippokok
                                    ) as pokoktunggak
                            FROM
                                angsuran_jadwal 
                            LEFT JOIN angsuran_kartu ON angsuran_jadwal.no_kredit = angsuran_kartu.no_kredit
                            AND angsuran_jadwal.bayar_ke = angsuran_kartu.angs_ke
                            WHERE
                                angsuran_jadwal.no_kredit = '".$t->no_kredit."'
                            AND angsuran_jadwal.tgl_angsur <= '".date('Y-m-d 00:00:00')."' ";
                $pokoklist = DB::connection('pgsql')->select(DB::raw($pokok))[0]; 
                $t->pokok = $pokoklist->pokoktunggak;
                // Log::info($t->pokok);

                $bungat = "SELECT SUM (angsuran_jadwal.angs_bunga) - SUM (
                                        angsuran_kartu.angs_bunga + angsuran_kartu.angs_titipbunga
                                    ) as bungatunggak
                            FROM
                                angsuran_jadwal 
                            LEFT JOIN angsuran_kartu ON angsuran_jadwal.no_kredit = angsuran_kartu.no_kredit
                            AND angsuran_jadwal.bayar_ke = angsuran_kartu.angs_ke
                            WHERE
                                angsuran_jadwal.no_kredit = '".$t->no_kredit."'
                            AND angsuran_jadwal.tgl_angsur <= '".date('Y-m-d 00:00:00')."' ";
                $bungalisttunggak = DB::connection('pgsql')->select(DB::raw($bungat))[0]; 
                $t->bungatunggak = $bungalisttunggak->bungatunggak;

                $titipan1 ="SELECT angsuran_kartu.no_kredit,angs_titipbunga as bungatitip,angs_titippokok as pokoktitip from angsuran_kartu
                            LEFT JOIN angsuran_jadwal ON angsuran_jadwal.no_kredit = angsuran_kartu.no_kredit
                            AND angsuran_jadwal.bayar_ke = angsuran_kartu.angs_ke
                            where angsuran_kartu.no_kredit = '".$t->no_kredit."'
                            and angs_tgl <= '".date('Y-m-d 00:00:00')."' ";
                $titipanlist1 = DB::connection('pgsql')->select(DB::raw($titipan1));    

                if(empty($titipanlist1)) {
                    $vania1 = '0';
                }else{
                   $titipan ="SELECT angsuran_kartu.no_kredit,angs_titipbunga as bungatitip,angs_titippokok as pokoktitip from angsuran_kartu
                            LEFT JOIN angsuran_jadwal ON angsuran_jadwal.no_kredit = angsuran_kartu.no_kredit
                            AND angsuran_jadwal.bayar_ke = angsuran_kartu.angs_ke
                            where angsuran_kartu.no_kredit = '".$t->no_kredit."'
                            and angs_tgl <= '".date('Y-m-d 00:00:00')."' ";

                    $titipanlist = DB::connection('pgsql')->select(DB::raw($titipan))[0];               
                
                    $t->bungatitip = $titipanlist->bungatitip;
                    $t->pokoktitip = $titipanlist->pokoktitip;
                    Log::info($t->bungatitip);
                    Log::info($t->pokoktitip);
                }

        }

                $jpiutang = 0;
                $jbunga = 0;
                foreach ($tunggaklist as $t) {
                    if(empty($t->piutang)) {
                        $jpiutang1=0;
                    }else{
                        $jpiutang += $t->piutang;
                    }
                    if(empty($t->bunga)) {
                        $jbunga1=0;
                    }else{
                        $jbunga += $t->bunga;
                    }
                }

        return view('laporan.laptunggak',compact('tunggaklist','pagination','utanglist','bungalist','pokoklist','bungalisttunggak','tunggaklist1','titipanlist','vania1','jpokok','jpiutang','jbunga','piutang1','bunga1','piutang','nsblistjumlah'));
    }

    public function viewTunggakTanggal($tanggal=null)
    {
        $page = (Input::get('page')) ? Input::get('page') : 1; // Get the current page for the request
        $limit = 50;
        $offset = ($page-1) * $limit;

        $sql = "SELECT
                    prekredit.no_kredit,
                    kredit.no_ref,
                    prekredit.nama,
                    kredit.tgl_kredit,
                    kredit.pinj_pokok,
                    kredit.saldo_piutang,
                    kredit.jatuhtempo
                FROM
                    kredit
                LEFT JOIN prekredit ON prekredit.no_kredit = kredit.no_kredit
                WHERE
                    kredit.tgl_kredit < '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'
                AND (
                kredit.tgl_lunas > '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'
                    OR kredit.tgl_lunas = '1900-01-01 00:00:00' OR kredit.tgl_lunas = '1970-01-01 00:00:00'
                )
                AND (
                    kredit.tgl_hapusbi > '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'
                    OR kredit.tgl_hapusbi = '1900-01-01 00:00:00' OR kredit.tgl_hapusbi = '1970-01-01 00:00:00'
                )
                AND (
                    kredit.tgl_hapusint > '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'
                    OR kredit.tgl_hapusint = '1900-01-01 00:00:00' OR kredit.tgl_hapusint = '1970-01-01 00:00:00'
                )";

        $total = count(DB::connection('pgsql')->select(DB::raw($sql.";")));
        
        $tunggaklist = DB::connection('pgsql')->select(DB::raw($sql." LIMIT ".$limit." OFFSET ".$offset.";"));

        $pagination = new Paginator($tunggaklist, $total, $limit,$page,array("path" => url('/laptunggaktanggal/'.$tanggal)));

        // $tunggaklist = DB::connection('pgsql')->select(DB::raw($sql)); 

        $jumlah =  "SELECT count(kredit.no_kredit) as nomor FROM kredit 
                    RIGHT JOIN prekredit ON prekredit.no_kredit = kredit.no_kredit where
                    kredit.tgl_kredit < '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'
                    AND (
                    kredit.tgl_lunas > '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'
                        OR kredit.tgl_lunas = '1900-01-01 00:00:00' OR kredit.tgl_lunas = '1970-01-01 00:00:00'
                    )
                    AND (
                        kredit.tgl_hapusbi > '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'
                        OR kredit.tgl_hapusbi = '1900-01-01 00:00:00' OR kredit.tgl_hapusbi = '1970-01-01 00:00:00'
                    )
                    AND (
                        kredit.tgl_hapusint > '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'
                        OR kredit.tgl_hapusint = '1900-01-01 00:00:00' OR kredit.tgl_hapusint = '1970-01-01 00:00:00'
                    )";
        $nsblistjumlah = DB::connection('pgsql')->select(DB::raw($jumlah." LIMIT ".$limit." OFFSET ".$offset.";"));

        $jpokok = 0;
        foreach ($tunggaklist as $t) {
            $jpokok += $t->pinj_pokok;
        }

        foreach ($tunggaklist as $t)
            {
                $piutang1 = "SELECT no_kredit,((pinj_pokok)-(select(sum(angs_pokok)) from angsuran_jadwal aj
                            where aj.no_kredit= '".$t->no_kredit."'
                            and tgl_angsur <= '".date('Y-m-d',strtotime($tanggal))."'
                            )) as piutang1 from kredit where no_kredit='".$t->no_kredit."' ";
                $utanglist1 = DB::connection('pgsql')->select(DB::raw($piutang1)); 

                if(empty($utanglist1)) {
                    $van = '0';
                }else{
                    $piutang = "SELECT no_kredit,((pinj_pokok)-(select(sum(angs_pokok)) from angsuran_jadwal aj
                            where aj.no_kredit= '".$t->no_kredit."'
                            and tgl_angsur <= '".date('Y-m-d',strtotime($tanggal))."'
                            )) as piutang from kredit where no_kredit='".$t->no_kredit."' ";
                    $utanglist = DB::connection('pgsql')->select(DB::raw($piutang))[0]; 
                    $t->piutang = $utanglist->piutang;
                }
                // Log::info($t->piutang);

                $bunga1 = "SELECT no_kredit,((bbt)-(select(sum(angs_bunga)) from angsuran_jadwal aj
                         where aj.no_kredit= '".$t->no_kredit."'
                            and tgl_angsur <= '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'
                            )) as bungautang1 from kredit where no_kredit='".$t->no_kredit."' ";
                $bungalist1 = DB::connection('pgsql')->select(DB::raw($bunga1)); 

                if(empty($bungalist1)) {
                    $vaan = '0';
                }else{
                $bunga = "SELECT no_kredit,((bbt)-(select(sum(angs_bunga)) from angsuran_jadwal aj
                         where aj.no_kredit= '".$t->no_kredit."'
                            and tgl_angsur <= '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."'
                            )) as bunga from kredit where no_kredit='".$t->no_kredit."' ";
                $bungalist = DB::connection('pgsql')->select(DB::raw($bunga))[0]; 
                $t->bunga = $bungalist->bunga;
                }

                $kantor = substr($t->no_kredit,7,2);
                $t->kantor = $kantor;
                // Log::info($t->kantor);

                $tunggak = "SELECT
                                count(*) as tunggak
                            FROM
                                angsuran_jadwal
                                Left JOIN angsuran_kartu ON angsuran_kartu.no_kredit = angsuran_jadwal.no_kredit AND angsuran_kartu.angs_ke = angsuran_jadwal.bayar_ke
                            WHERE
                                angsuran_jadwal.no_kredit = '".$t->no_kredit."' AND
                                angsuran_jadwal.tgl_angsur <=  '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."' AND
                                angsuran_kartu.angs_tgl ISNULL";

                $tunggaklist1 = DB::connection('pgsql')->select(DB::raw($tunggak))[0]; 
                $t->tunggak = $tunggaklist1->tunggak;

                $pokok = "SELECT SUM (angsuran_jadwal.angs_pokok) - SUM (
                                        angsuran_kartu.angs_pokok + angsuran_kartu.angs_titippokok
                                    ) as pokoktunggak
                            FROM
                                angsuran_jadwal 
                            LEFT JOIN angsuran_kartu ON angsuran_jadwal.no_kredit = angsuran_kartu.no_kredit
                            AND angsuran_jadwal.bayar_ke = angsuran_kartu.angs_ke
                            WHERE
                                angsuran_jadwal.no_kredit = '".$t->no_kredit."'
                            AND angsuran_jadwal.tgl_angsur <= '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."' ";
                $pokoklist = DB::connection('pgsql')->select(DB::raw($pokok))[0]; 
                $t->pokok = $pokoklist->pokoktunggak;
                // Log::info($t->pokok);

                $bungat = "SELECT SUM (angsuran_jadwal.angs_bunga) - SUM (
                                        angsuran_kartu.angs_bunga + angsuran_kartu.angs_titipbunga
                                    ) as bungatunggak
                            FROM
                                angsuran_jadwal 
                            LEFT JOIN angsuran_kartu ON angsuran_jadwal.no_kredit = angsuran_kartu.no_kredit
                            AND angsuran_jadwal.bayar_ke = angsuran_kartu.angs_ke
                            WHERE
                                angsuran_jadwal.no_kredit = '".$t->no_kredit."'
                            AND angsuran_jadwal.tgl_angsur <= '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."' ";
                $bungalisttunggak = DB::connection('pgsql')->select(DB::raw($bungat))[0]; 
                $t->bungatunggak = $bungalisttunggak->bungatunggak;

                $titipan1 ="SELECT angsuran_kartu.no_kredit,angs_titipbunga as bungatitip,angs_titippokok as pokoktitip from angsuran_kartu
                            LEFT JOIN angsuran_jadwal ON angsuran_jadwal.no_kredit = angsuran_kartu.no_kredit
                            AND angsuran_jadwal.bayar_ke = angsuran_kartu.angs_ke
                            where angsuran_kartu.no_kredit = '".$t->no_kredit."'
                            and angs_tgl <= '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."' ";
                $titipanlist1 = DB::connection('pgsql')->select(DB::raw($titipan1));    

                if(empty($titipanlist1)) {
                    $vania1 = '0';
                }else{
                   $titipan ="SELECT angsuran_kartu.no_kredit,angs_titipbunga as bungatitip,angs_titippokok as pokoktitip from angsuran_kartu
                            LEFT JOIN angsuran_jadwal ON angsuran_jadwal.no_kredit = angsuran_kartu.no_kredit
                            AND angsuran_jadwal.bayar_ke = angsuran_kartu.angs_ke
                            where angsuran_kartu.no_kredit = '".$t->no_kredit."'
                            and angs_tgl <= '".date('Y-m-d',strtotime($tanggal))." 00:00:00"."' ";

                    $titipanlist = DB::connection('pgsql')->select(DB::raw($titipan))[0];               
                
                    $t->bungatitip = $titipanlist->bungatitip;
                    $t->pokoktitip = $titipanlist->pokoktitip;
                    Log::info($t->bungatitip);
                    Log::info($t->pokoktitip);
                }

        }

                $jpiutang = 0;
                $jbunga = 0;
                foreach ($tunggaklist as $t) {
                    if(empty($t->piutang)) {
                        $jpiutang1=0;
                    }else{
                        $jpiutang += $t->piutang;
                    }
                    if(empty($t->bunga)) {
                        $jbunga1=0;
                    }else{
                        $jbunga += $t->bunga;
                    }
                }

        return view('laporan.laptunggaktanggal',compact('tunggaklist','pagination','utanglist','bungalist','pokoklist','bungalisttunggak','tunggaklist1','titipanlist','vania1','jpokok','jpiutang','jbunga','piutang1','bunga1','piutang','nsblistjumlah'));
    }

    public function viewJurnal()
    {


       $kode_kantor = refkodekantor::all();

        return view('laporan.jurnal',compact('kode_kantor'));
    }


    
}
