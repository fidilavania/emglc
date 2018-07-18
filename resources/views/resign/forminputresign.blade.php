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

            <form class="form-horizontal" id="simpanform" role="form" method="POST" action="{{ url('/saveresign/$nonsb') }}" enctype="multipart/form-data" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                    <div class="panel-heading"><h4 align="center">DATA RESIGN</h4></div>
                    <div class="row">
                        <div class="col-sm-3">
                            <?php
                                echo "<font color='#ff0000'>wajib diisi*</font><br>";
                            ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_tanggal_mohon" id="tanggalmohon" value="{{date('d-m-Y')}}" readonly>
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
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nama</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_nama" autocomplete="off" value="{{trim($sdm->nama,' ')}}" style="text-transform:uppercase;" placeholder="NAMA" readonly />
                                    </div>
                                </div>
                                <div class="row form-group" hidden="">
                                    <label class="col-sm-3 control-label">no sdm</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_nosdm" autocomplete="off" value="{{trim($sdm->no_sdm,' ')}}" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Jenis Kelamin</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_jenis_kelamin" autocomplete="off" value="{{trim($sdm->jenis_kel,' ')}}" readonly />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nomor Telepon Rumah</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_telepon_rumah" autocomplete="off" value="{{trim($sdm->notlp,' ')}}" placeholder="0321xxxxxx" id="hp" id="pesan" readonly />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nomor Telepon Seluler</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_hp" autocomplete="off" value="{{trim($sdm->nohp,' ')}}" placeholder="081xxxxxxxx" id="hpku" id="pesanku" readonly/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">No KTP</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="input_no_identitas" autocomplete="off" value="{{trim($sdm->ktp,' ')}}" style="text-transform:uppercase" maxlength="16" placeholder="323232323232323" id="ktp" id="pesanktp" readonly/>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">No KK</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="input_kk" autocomplete="off" value="{{trim($sdm->no_kk,' ')}}" style="text-transform:uppercase" maxlength="16" placeholder="323232323232323" id="kk" id="pesankk" readonly/>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nama Kantor</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="kantor" value="{{trim($sdm->kantor,' ')}}" placeholder="kantor" style="text-transform:uppercase" readonly />
                                        </div>
                                </div>
                                <div class="row form-group" hidden>
                                    <label class="col-sm-3 control-label">Induk Kantor</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="induk_kantor" value="{{trim($sdm->induk_kantor,' ')}}" placeholder="indukkantor" style="text-transform:uppercase" readonly />
                                        </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Kerja*</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="input_tglkerja" value="{{date('d-m-Y',strtotime(trim($sdm->tgl_kerja)))}}" style="text-transform:uppercase" placeholder="{{date('d-m-Y')}}" id="input_tglkerja" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">                                        
                            <div class="panel panel-primary">
                                <div class="panel-heading" align="center">MASUKKAN DATA</div>
                                    <div class="panel-body">
                                        <div class="col-sm-6">
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Tanggal Keluar</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="tanggal" autocomplete="off" value="" id="tanggal" placeholder="dd-mm-yyyy" required />
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Alasan Keluar</label>
                                                <div class="col-sm-9">
                                                     <textarea rows="10" cols="120" name="alasan" value="" placeholder="alasan" style="text-transform;" id="alasan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                       
                        <div class="row submitbtn1">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">SIMPAN</button>
                                <a href="{{ url('/datasdm') }}" id="clear-filter" title="Input SDM Baru">[Kembali Ke Daftar]</a>
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
    $(document).ready(function() {
         $('#tanggal').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});
    });
</script>
@endsection
