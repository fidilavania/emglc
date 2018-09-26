@extends('layouts.apprbb')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading" align="center">Rencana Bisnis BPR</div>
                <div class="panel-body" align="center">
                @if(strpos(Auth::user()->jenis, 'RBB') !== false)
                <b >Login Sukses</b>
                @else
                <b >Anda Tidak Punya Akses di Halaman ini</b>
                @endif
                </div>
                <div class="panel-body" align="center">
                    <!-- <img src="/pic/siakadlogo.jpg" align="center" width="300" height="150"><br><br> -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
