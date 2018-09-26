<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Log;
use App\UserRbb;
use App\ABCJabatan;
use App\ABCKantor;
use App\master_kantor;
use App\LKH;
use Hash;
use Validator;
use App\Http\Controllers\Controller;
use Session;

class RbbController extends Controller
{
    public function viewPilih()
    {
        return view('rbb/pilih');   
    }

    public function viewHomeRbb()
    {
        return view('rbb/homerbb');   
    }

}
