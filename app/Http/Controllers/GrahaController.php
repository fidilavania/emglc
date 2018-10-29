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

     public function formfoto()
    {
       	$foto = DB::connection('mysql')->table('foto')->get();
       	// $sdm = sdm::all();
       	// $datafoto = Storage::get($foto);

        // log::info($datafoto);
        return view('foto.foto',compact('foto'));   
    }

    public function formfotologin()
    {
        $foto = DB::connection('mysql')->table('foto')->get();
        // $sdm = sdm::all();
        // $datafoto = Storage::get($foto);

        // log::info($datafoto);
        return view('foto.fotologin',compact('foto'));   
    }

    public function formupload()
    {
        $foto = DB::connection('mysql')->table('foto')->get();
        $kantor = DB::connection('mysql')->table('mst_kantor')->get();

        return view('foto.upload',compact('foto','kantor'));   
    }

    public function saveFoto(Request $request)
    {
        // $this->validate($request, [
        //         'filename' => 'required',
        //         'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        // ]);
        
        // if($request->hasfile('filename'))
        //  {
        //     foreach($request->file('filename') as $image)
        //     {
        //         $name=$image->getClientOriginalName();
        //         $image->move(public_path().'/images/', $name);  
        //         $data[] = $name;  
        //     }
        //  }
        //  $form= new foto();
        //  $form->nama=json_encode($data);
         
        
        // $form->save();
        // if(count($request->input('filename')) > 0){
        //     $nextno =(int) foto::max('id') + 1;
        //     for($i=0;$i<count($request->input('filename'));$i++){
        //         if(($request->input('filename')[$i] <> null) || ($request->input('filename')[$i] <> '')){
        //             $upload = new foto;
        //             $upload->tgl_input = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')))[$i];
        //             $upload->opr = strtoupper($request->input('opr'))[$i];
        //             $upload->kegiatan = strtoupper($request->input('kegiatan'))[$i];
        //             if ($request->hasFile('filename')[$i]) {
        //                 $fileContents = $request->file('filename')[$i];
        //                 $paths3 =  Storage::disk('s3')->put('nama', $fileContents,'public');
        //                 $upload->nama = $paths3;
        //             }
        //             $upload->save();
        //             $nextno = (int) $upload->id + 1;
        //         }
        //     }
        // }

        $arrfoto = array('filenama[]');
        for($i=0;$i<count($arrfoto);$i++){
          $upload = new foto;
          $upload->id = rand(1,9999999999);
          $upload->tgl_input = date('Y-m-d H:i:s',strtotime($request->input('input_tanggal_mohon')));
          $upload->kantor = strtoupper($request->input('kantor'));
          $upload->opr = strtoupper($request->input('opr'));
          $upload->kegiatan = strtoupper($request->input('kegiatan'));
          $upload->nama = $request->input('filenama[]'.$arrfoto[$i]);
          // if ($request->hasFile('filename')) {
          //     $fileContents = $request->file('filename');
          //     $paths3 =  Storage::disk('s3')->put('picture', $fileContents,'public');
          //     $upload->nama = $paths3;
          // }
          $upload->save();
        }
        
        
        // return redirect('/datasdm');

        return back()->with('success', 'Your images has been successfully');
    }
}

