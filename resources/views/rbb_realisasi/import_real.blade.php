@extends('layouts.apprbb')

@section('content')
<div class="container">
   @if ( Session::has('success') )
        <div class="alert alert-success alert-dismissible" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>{{ Session::get('success') }}</strong>
    </div>
    @endif

    @if ( Session::has('error') )
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            <span class="sr-only">Close</span>
        </button>
        <strong>{{ Session::get('error') }}</strong>
    </div>
    @endif

    @if (count($errors) > 0)
    <div class="alert alert-danger">
      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
      <div>
        @foreach ($errors->all() as $error)
        <p>{{ $error }}</p>
        @endforeach
        </div>
    </div>
    @endif

    <div class="col-sm-12">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading"><h4 align="center">Import Realisasi Bisnis BPR</h4></div>
                <div class="panel-body" align="center">
                
                </div>
                <div class="panel-body" align="center">
                    <form action="{{ url('/prosesR') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_tanggal_mohon" id="tanggalmohon" value="{{date('d-m-Y')}}" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Periode</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="periode" required>
                                            <option value >-Pilih Periode-</option>
                                            <!-- <option value="{{date('Y', strtotime('-1 year'))}}-12-31"> -->
                                            <option value="{{date('Y')}}-12-31">{{date('Y')}}-12-31</option>
                                            <option value="{{date('Y')}}-06-30">{{date('Y')}}-06-30</option>
                                        </select>
                                        <!-- <input type="text" class="form-control" name="periode" autocomplete="off" value="{{date('Y')}}-12-31" style="text-transform:uppercase;" required /> -->
                                    </div>
                                </div>

                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Operator</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="opr" autocomplete="off" value="{{ trim(Auth::user()->nama_lengkap,' ') }}" style="text-transform:uppercase;" readonly />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kode Kantor LJK</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="" autocomplete="off" value="{{ trim($ljk->kode_rbb,' ') }}" style="text-transform:uppercase;" readonly />
                                    </div>
                                </div>
                                <div class="row form-group" hidden>
                                    <label class="col-sm-3 control-label">Kantor</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="kantor" autocomplete="off" value="{{ trim(Auth::user()->kantor,' ') }}" style="text-transform:uppercase;" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="row">
                            <!-- <embed src="/informasi/ojk.pdf" width="550" height="600"> </embed> -->
                            <div class="col-sm-12">
                                Pilih File RBB : <input type="file" name="file" class="form-control" required>
                                <br>
                                <!-- <input type="submit" class="btn btn-primary btn-lg" style="margin-top: 3%"> -->
                                <button type="submit" class="btn btn-primary btn-lg" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan import data ini?'<br>'Apakah anda sudah mengganti periode?')">IMPORT</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
