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
use App\Kelurahan;
use App\Kecamatan;
use App\kab;
use App\sdm_photo;
use App\jabatan_mst;
use App\kantor_mst;
use App\master_kantor;
use DB;
use Auth;
use Log;
use Input;
use Illuminate\Support\Facades\Storage;
// use League\Flysystem\AwsS3v3\AwsS3Adapter as S3Adapter;
// use League\Flysystem\AwsS3v3\AwsS3Adapter;

class LaporanController extends Controller
{
    public function formpiagam()
    {
        
        return view('laporan.piagam');   
    }

    public function formlapsdm()
    {
        // $datakredit = array();
        // $nsblist = master_kantor::select('nama','kode_kantor')->paginate(100);

        $jumlah =  "SELECT master_kantor.nama,master_kantor.kode_kantor,sdm.kantor,count(sdm.no_sdm) as total
					FROM sdm,master_kantor 
					WHERE
					sdm.kantor = master_kantor.kode_kantor and sdm.status = '1'
					GROUP BY master_kantor.nama,master_kantor.kode_kantor,sdm.kantor";
        $nsblist = DB::connection('mysql')->select(DB::raw($jumlah));  

        $totallist =  "SELECT count(no_sdm) as total FROM sdm where status = 1 ";
        $listall = DB::connection('mysql')->select(DB::raw($totallist));  

        // $mkantor = DB::connection('mysql')->table('master_kantor')->get();
       

        return view('laporan.lapdatasdm',compact('nsblist','listall'));   
    }

     public function formcoba()
    {
        
        return view('cetak.coba');   
    }

    public function saveCoba(Request $request)
    {
        $fileContents = $request->file('fileToUpload');
        $paths3 =  Storage::disk('s3')->put('picture', $fileContents,'public');
        echo Storage::disk('s3')->url($paths3);
        // Storage::put('https://console.aws.amazon.com/s3/buckets/siakad-emg/picture/', $fileContents);

        // log::info( Storage::disk('s3'));
        
        // if ($request->hasFile('fileToUpload')) {
        //     $image = $request->file('fileToUpload');
        //     $name = time().'.'.$image->getClientOriginalExtension();
        //     Storage::disk('s3')->put('https://console.aws.amazon.com/s3/buckets/siakad-emg/picture/', $fileContents);
        //     // $destinationPath = public_path('foto');

        //     $image->move($destinationPath, $name);
        //     // $sdm->foto = 'foto/'.$name;
        // }
        // return redirect('/');
    }
}
