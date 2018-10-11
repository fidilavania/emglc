@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="paneltranslain">
                <div class="panel-heading"><h4 align="center">USER BARU</h4></div>
                    <div class="panel-body">
                      <form class="form-horizontal" id="userbaruform" role="form" method="POST" action="{{ url('/admin/saveuser') }}">
                      <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-12 alert alert-danger" name="errorpanel" hidden>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">Nama Lengkap*</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="input_nama_lengkap" autocomplete="off" value="" placeholder="NAMA LENGKAP" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">Email</label>
                                    <div class="col-sm-4">
                                        <input type="email" class="form-control" name="input_email" autocomplete="off" value="" placeholder="email@gmail.com"  />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">Nomor HP/Tlp</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="tlp" autocomplete="off" value="" placeholder="081233xxxxxxxx"  />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">Username*</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="input_username" autocomplete="off" value="" placeholder="USERNAME" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">Pilih Kantor*</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="input_kantor" required>
                                            <option value >Pilih Kantor</option>
                                            @foreach($mkantor as $k)
                                                <option value="{{$k->kode_kantor}}">{{$k->nama}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">Pilih Jabatan*</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="input_jabatan" required>
                                            <option value >Pilih Jabatan</option>
                                            @foreach($jabatan as $k)
                                                <option value="{{$k->kode}}">{{$k->jabatankantor}}</option>
                                            @endforeach
                                        </select>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">Password*</label>
                                    <div class="col-sm-4">
                                        <input type="password" class="form-control" name="input_password" autocomplete="off" value="" placeholder="MASUKKAN PASSWORD" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">Konfirmasi Password*</label>
                                    <div class="col-sm-4">
                                        <input type="password" class="form-control" name="input_konfirmasi_password" autocomplete="off" value="" placeholder="ULANGI PASSWORD" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">Modul*</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="input_modul" required>
                                            <option value >Pilih Modul</option>
                                            @foreach($modul as $m)
                                                <option value="{{$m->nama}}">{{$m->nama}}</option>
                                            @endforeach
                                        </select>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">Hak Akses*</label>
                                    <div class="col-sm-4">
                                        <select class="form-control" name="input_akses" required>
                                            <option value >Pilih Hak Akses</option>
                                            @foreach($akses as $k)
                                                <option value="{{$k->kode}}">{{$k->nama}}</option>
                                            @endforeach
                                        </select>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">&nbsp;</label>
                                    <div class="col-sm-2">
                                        <button type="submit" class="btn btn-primary" name="simpantranslainbutton">SIMPAN</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                      </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
$(document).ready(function() {
    $('[name="input_jabatan"]').select2({ width: '100%' });
    $('[name="input_kantor"]').select2({ width: '100%' });

    $('#userbaruform').submit(function(){
        $('[name="errorpanel"]').empty();
            var content = '<ul>';
            if($('[name="input_nama_lengkap"]').val() == ""){
                content += '<li class="text-danger">Field nama lengkap tidak boleh kosong</li>';
                $('[name="input_nama_lengkap"]').css("background-color", "#F9CECE");
            }
            if($('[name="input_username"]').val() == ""){
                content += '<li class="text-danger">Field username tidak boleh kosong</li>';
                $('[name="input_username"]').css("background-color", "#F9CECE");
            }
            if($('[name="input_kantor"]').val() == ""){
                content += '<li class="text-danger">Field kantor tidak boleh kosong</li>';
                $('[name="input_kantor"]').css("background-color", "#F9CECE");
            }
            if($('[name="input_jabatan"]').val() == ""){
                content += '<li class="text-danger">Field jabatan tidak boleh kosong</li>';
                $('[name="input_jabatan"]').css("background-color", "#F9CECE");
            }
            if($('[name="input_password"]').val() == ""){
                content += '<li class="text-danger">Field password tidak boleh kosong</li>';
                $('[name="input_password"]').css("background-color", "#F9CECE");
            }
            if($('[name="input_konfirmasi_password"]').val() == ""){
                content += '<li class="text-danger">Field konfirmasi password tidak boleh kosong</li>';
                $('[name="input_konfirmasi_password"]').css("background-color", "#F9CECE");
            }
            if($('[name="input_konfirmasi_password"]').val() !== $('[name="input_password"]').val()){
                content += '<li class="text-danger">Field password dan konfirmasi password tidak sama</li>';
                $('[name="input_password"]').css("background-color", "#F9CECE");
                $('[name="input_konfirmasi_password"]').css("background-color", "#F9CECE");
            }
            content += '</ul>';
            if(content != '<ul></ul>'){
                $('[name="errorpanel"]').append(content).show();
                return false;
            } else {
                return confirm('Apakah anda yakin data yang dimasukkan sudah benar ?');
            }
    });
});
</script>
@endsection
