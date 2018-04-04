@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-danger" id="panelerror" hidden>
                <div class="panel-body">
                    <ul class="errormsg">
                    </ul>
                </div>
            </div>
            <form class="form-horizontal" id="simpankreditform" role="form" method="POST" action="{{ url('/savehapus/$nokredit') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                    <div class="panel-heading"><h4 align="center">HAPUS DATA KREDIT</h4></div>
                        <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Nomor Nasabah</label>
                                            <div class="col-sm-9">                                        
                                                <input type="text" class="form-control" name="no_nsb" autocomplete="off" style="text-transform:uppercase;" value="{{$prekredit->no_nsb}}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Nomor CIF</label>
                                            <div class="col-sm-9">                                        
                                                <input type="text" class="form-control" name="no_cif" autocomplete="off" style="text-transform:uppercase;" value="{{$prekredit->no_cif}}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Nomor Kredit</label>
                                            <div class="col-sm-9">                                        
                                                <input type="text" class="form-control" name="no_kredit" autocomplete="off" style="text-transform:uppercase;" value="{{$kredit->no_kredit}}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Nomor NPP</label>
                                            <div class="col-sm-9">                                        
                                                <input type="text" class="form-control" name="no_npp" autocomplete="off" style="text-transform:uppercase;" value="{{$kredit->no_ref}}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                            <div class="col-sm-9">
                                                <input type="checkbox" id="hapusintern" ng-model="in"/><b>Hapus Intern</b><br>
                                                <div class="row form-group" ng-if="in">
                                                    <div class="row form-group" >
                                                        <label class="col-sm-3 control-label">Tanggal Hapus</label>
                                                        <div class="col-sm-9">
                                                          <input type="text" class="form-control" name='input_tgl_hpsin' id="tanggalin" value="{{date('d-m-Y',strtotime($kredit->tgl_hapusint))}}">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group" >
                                                        <label class="col-sm-3 control-label">Nomor Hapus</label>
                                                        <div class="col-sm-9">
                                                            <input type='text' class="form-control" name="input_no_hpsin" autocomplete="off" value="{{trim($kredit->no_hapusint,' ')}}" style="text-transform:uppercase;" placeholder="nomor hapus" maxlength="20"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                            <div class="col-sm-9">
                                                <input type="checkbox" id="hapusbi" ng-model="bi"/><b>Hapus BI</b><br>
                                               <div class="row form-group" ng-if="bi">
                                                    <div class="row form-group" >
                                                        <label class="col-sm-3 control-label">Tanggal Hapus</label>
                                                        <div class="col-sm-9">
                                                          <input type="text" class="form-control" name='input_tgl_hpsbi' id="tanggalbi" value="{{date('d-m-Y',strtotime($kredit->tgl_hapusbi))}}">
                                                        </div>
                                                    </div>
                                                    <div class="row form-group" >
                                                        <label class="col-sm-3 control-label">Nomor Hapus</label>
                                                        <div class="col-sm-9">
                                                            <input type='text' class="form-control" name="input_no_hpsbi" autocomplete="off" value="{{trim($kredit->no_hapusbi,' ')}}" style="text-transform:uppercase;" placeholder="nomor hapus" maxlength="20" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <div class="row submitbtn1">
                                <div class="col-sm-12">
                                    <button type="submit" id="simpandata" class="btn btn-danger" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">HAPUS</button>
                                </div>
                            </div>
                        </div>

                </div>

        </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$("#hapusintern").checkbox(function(){
    $("#tanggalin").datepicker({ dateFormat: 'dd-mm-yy' });
}
$("#hapusbi").checkbox(function(){
    $("#tanggalbi").datepicker({ dateFormat: 'dd-mm-yy' });
}
</script>
@endsection
