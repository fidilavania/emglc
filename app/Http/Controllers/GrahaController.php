<?php

namespace App\Http\Controllers;

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
use App\foto;
use App\sdm_photo;
use App\jabatan_mst;
use App\kantor_mst;
use App\master_kantor;
use DB;
use Auth;
use Log;
use Input;
use Illuminate\Support\Facades\Storage;

class GrahaController extends Controller
{
    public function formgraha()
    {
        
        return view('graha.graha');   
    }

    public function formfotologin(Request $request,$key=null)
    {
        $datakredit = array();

        if($key == null){
            $nsblist = foto::select('id','kantor','kegiatan','foto','opr','tgl_input')->paginate(20);
        } else {
            $nsblist = foto::select('id','kantor','kegiatan','foto','opr','tgl_input')->whereRaw
            ("kegiatan LIKE '%".strtoupper($key)."%'")->paginate(20);

        }
        
        return view('foto.fotokeg',compact('nsblist','datakredit'));   
    }

    public function formUploadFoto()
    {
        return view('foto.uploadfoto');   
    }

    public function saveUploadFoto(Request $request,$nourut)
    {
        
        $lastnourut = foto::max('id');
        $nourut = (int) $lastnourut + 1;

        $foto = new foto;
        $foto->id = str_pad($nourut, 7, '0',STR_PAD_LEFT);
        $foto->tgl_input = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')));
        $foto->opr = strtoupper($request->input('opr'));
        $foto->kegiatan = strtoupper($request->input('kegiatan'));
        $foto->foto = ($request->input('foto'));
        $foto->save();

        return redirect('/fotokeg');
        // return back()->with('success', 'Your images has been successfully');
    }

    // public function formupload()
    // {
    //     $foto = DB::connection('mysql')->table('foto')->get();
    //     $kantor = DB::connection('mysql')->table('mst_kantor')->get();

    //     return view('foto.upload',compact('foto','kantor'));   
    // }

    // public function formfoto()
    // {
    //     $foto = DB::connection('mysql')->table('foto')->get();

    //     foreach ($foto as $f) {
    //       $galery = Storage::disk('s3')->files($f->nama);
    //       // $galery = Storage::get($f->nama);
    //       // $galery = Storage::disk('s3')->exists($f->nama);
    //       // $galery = Storage::url($f->nama);
    //       // $galery = Storage::disk('s3')->exists($f->nama);
    //     }
    //     log::info($galery);


    //     $url = 'https://s3.' . env('AWS_DEFAULT_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
    //     $picture = [];
    //     $files = Storage::disk('s3')->files('picture');
    //        foreach ($files as $file) {
    //            $picture[] = [
    //                'name' => str_replace('picture/', '', $file),
    //                'src' => $url . $file
    //            ];
    //        }

    //     return view('foto.foto',compact('foto','galery','picture'));   
    // }

    // public function saveFotoGalery(Request $request)
    // {
     
    //       $upload = new foto;
    //       $upload->id = rand(1,9999999999);
    //       $upload->tgl_input = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')));
    //       $upload->kantor = strtoupper($request->input('kantor'));
    //       $upload->opr = strtoupper($request->input('opr'));
    //       $upload->kegiatan = strtoupper($request->input('kegiatan'));
    //       // $upload->nama = $request->input('filenama[]'.$arrfoto[$i]);
    //       if ($request->hasFile('filename')) {
    //           $fileContents = $request->file('filename');
    //           $paths3 =  Storage::disk('s3')->put('picture', $fileContents,'public');
    //           $upload->nama = $paths3;
    //       }
    //       $upload->save();

    //     return back()->with('success', 'Your images has been successfully');
    // }
}

