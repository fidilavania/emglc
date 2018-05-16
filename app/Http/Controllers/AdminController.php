<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\refkodekantor;
use App\Jabatan;
use Hash;
use Auth;
use App\kredit;
use DB;
use Log;
use Input;
use App\User;
use App\jabatan_mst;
use App\mst_kantor;
use App\mst_jabatan;
use App\kantor_mst;
use App\mst_akses;
use App\ABCJabatan;
use App\Http\Requests;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;


class AdminController extends Controller
{
     public function getFormUser()
    {
    	// $kantor = DB::connection('pgsql')->table('mst_kantor')->get();
    	// $jabatan = DB::connection('pgsql')->table('mst_jabatan')->get();
        $kantor = mst_kantor::all();
        $jabatan = mst_jabatan::all();
        $akses = mst_akses::all();
		return view('admin.formuser', compact('kantor','jabatan','akses'));
    }
    public function postSaveUser(Request $request)
    {
        $lastnonsb = User::max('id');
        $nonsb = (int) $lastnonsb + 1;

    	$user = new User;
        $user->id = $nonsb;
    	$user->username = $request->input('input_username');
    	$user->nama_lengkap = $request->input('input_nama_lengkap');
    	$user->jabatan = $request->input('input_jabatan');
    	$user->kantor = $request->input('input_kantor');
        $user->fungsi = $request->input('input_akses');
    	$user->status = 1;
    	$user->password = Hash::make($request->input('input_password'));
    	$user->save();
        // DB::table('users')->insert([
        //     ['username' => $request->input('input_username'), 
        //      'nama_lengkap' => $request->input('input_nama_lengkap'),
        //      'jabatan' =>$request->input('input_jabatan'),
        //      'kantor' =>$request->input('input_kantor'),
        //      'fungsi' =>1111,
        //      'status' =>1,
        //      'password' =>Hash::make($request->input('input_password'))]
        // ]);

    	return redirect('/lihatuser');
    	// return redirect('/');
    }
   public function getDaftarUser($kol=null,$key=null)
    {
  
        $kolom = $kol;
        $kunci = strtoupper($key);

        // $sql = "SELECT id,username,nama_lengkap,jabatan,kantor_mst.nama,status,jabatan_mst.jabatankantor FROM users,kantor_mst,jabatan_mst WHERE ";
        // if(($kolom <> null) && ($key <> null)){
        //     $sql .= $kolom." LIKE '%".$kunci."%' AND kode_kantor=kantor AND jabatan_mst.kode=jabatan ORDER BY id";
        // } else {
        //     $sql .= "kode_kantor=kantor AND jabatan_mst.kode=jabatan ORDER BY id";
        // }
        // $user = DB::connection('mysql')->select(DB::raw($sql.";"));

        // $total = count(DB::connection('mysql')->select(DB::raw($sql.";")));
        
        // $nsblist = DB::connection('mysql')->select(DB::raw($sql));

        // $url = url('/lihatuser');

        $sql = "SELECT id,username,nama_lengkap,jabatan,mst_kantor.nama,status,mst_jabatan.jabatankantor FROM users,mst_kantor,mst_jabatan WHERE ";
        if(($kolom <> null) && ($key <> null)){
            $sql .= $kolom." LIKE '%".$kunci."%' AND kode_kantor=kantor AND mst_jabatan.kode=jabatan ORDER BY id";
        } else {
            $sql .= "kode_kantor=kantor AND mst_jabatan.kode=jabatan ORDER BY id";
        }
        $user = DB::connection('mysql')->select(DB::raw($sql.";"));

        $total = count(DB::connection('mysql')->select(DB::raw($sql.";")));
        
        $nsblist = DB::connection('mysql')->select(DB::raw($sql));

        $url = url('/lihatuser');

        return view('admin.daftaruser', compact('user','pagination'));
    }

    
}
