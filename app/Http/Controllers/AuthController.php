<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Log;
use App\User;
use App\ABCJabatan;
use App\ABCKantor;
use App\master_kantor;
use App\LKH;
use Hash;
use Validator;
use App\Http\Controllers\Controller;
use Session;

class AuthController extends Controller
{
    
    public function viewAwal()
    {
        return view('awal');   
    }
    // public function __construct()
    // {
    //     $this->middleware('guest')->except('logout');
    // }
    public function login()
    {
        // try {
        //     DB::connection()->getPdo();
        // } catch (\Exception $e) {
        //     die("Could not connect to the database.  Please check your configuration.");
        // }
        $user = User::all();
        //Log::info(json_encode($user));
        if (Auth::check()) {
            return redirect('/pilih');
        }
        return view('login');
    }
    public function authenticate(Request $request)
    {
        if (Auth::attempt(['username' => $request->input('inputusername'), 'password' => $request->input('inputpassword')])) {
            // Authentication passed...
            $user = Auth::user();
            
            return redirect('/pilih');
        }else{
            //return view('login',compact('lkh','buka'));
            return view('login');
        }
        /*if(Auth::attempt(['username' => $request->input('username'), 'password' => $request->input("password")])){
            //menyimpan data fungsi user dalam session
            $user = Auth::user();
            $jabatan = ABCJabatan::find($user->jabatan);
            $functions = explode(',',$jabatan->fungsi);
            session(['fungsi_user'=>$functions]);
            $response = array('success'=>true,'url'=>'/');
        }
        else {
            $response = array('success'=>false,'reason'=>'Username atau Password tidak cocok');  
        }
        return Response()->json($response);*/
    }
    public function Logout()
    {
        Session::flush();
        Auth::logout();
        return redirect('/welcome');
    }
}
