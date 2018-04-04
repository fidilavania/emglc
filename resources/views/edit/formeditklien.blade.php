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
            <form class="form-horizontal" id="simpanform" role="form" method="POST" action="{{ url('/saveklienedit/$nonsb') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                    <div class="panel-heading"><h4 align="center">EDIT DATA UNIT BISNIS</h4></div>
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
                                    <label class="col-sm-3 control-label">Tanggal*</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_tanggal_mohon" id="tanggalmohon" value="{{date('d-m-Y')}}" >
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
                                    <label class="col-sm-3 control-label">Nama Unit Bisnis*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nama_ub" autocomplete="off" value="{{trim($klien->kantor,' ')}}" style="text-transform:uppercase" placeholder="Nama UB" required readonly />
                                        </div>
                                </div>
                                <div class="row form-group" hidden="">
                                    <label class="col-sm-3 control-label">No Reg</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="no_reg" autocomplete="off" value="{{trim($klien->no_reg,' ')}}" />
                                        </div>
                                </div>
                                <!-- <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kode Unit Bisnis*</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="kode_ub" required>
                                                <option>-Pilih Kode UB-</option>
                                                    @foreach($kantor as $kan)
                                                        <option value="{{$kan->kode_kantor}}">{{$kan->kode_kantor}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                </div> -->
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Alamat*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="input_alamat" autocomplete="off" value="{{trim($klien->alamat,' ')}}" style="text-transform:uppercase" placeholder="ALAMAT" required />
                                        </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">RT/RW</label>
                                         <div class="col-sm-9">
                                            <input type="text" class="form-control" name="input_rt" autocomplete="off" value="{{trim($klien->rtrw,' ')}}"  placeholder="000/000" id="rt" id="pesanrt" />
                                        </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kelurahan*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="input_kelurahan" autocomplete="off" value="{{trim($klien->lurah,' ')}}" style="text-transform:uppercase" placeholder="KELURAHAN" required />
                                        </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kecamatan*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="input_kecamatan" autocomplete="off" value="{{trim($klien->camat,' ')}}" style="text-transform:uppercase" placeholder="KECAMATAN" required />
                                        </div>
                                </div>
                                 <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kodya*</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="input_kodya" required>
                                                <option replace>{{trim($klien->kodya,' ')}}</option>
                                                <option>-Pilih Kodya-</option>
                                                @foreach($kodya as $k)
                                                <option value="{{$k->desc2}}">{{$k->desc2}}</option>
                                                 @endforeach
                                             </select>
                                        </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kode Pos</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="input_kodepos" autocomplete="off" value="{{trim($klien->kodepos,' ')}}" maxlength="5" placeholder="651xx" id="kodepos" id="pesanpos"  />
                                        </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Berdiri*</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" name="input_tanggalberdiri" id="tanggallahir" placeholder ="{{date('d-m-Y')}}" value="{{date('d-m-Y',strtotime(trim($klien->tgl_berdiri,' ')))}}" required>
                                        </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nomor Telepon*</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="tlp" autocomplete="off" value="{{trim($klien->no_tlp,' ')}}" placeholder="0321812134"  required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Alamat WEB</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="web" autocomplete="off" value="{{trim($klien->web,' ')}}" placeholder="WEB"  />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Facebook</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="facebook" autocomplete="off" value="{{trim($klien->fb,' ')}}" placeholder="facebook"  />
                                    </div>
                                </div>
                                 <div class="row form-group">
                                    <label class="col-sm-3 control-label">Instagram</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="instagram" autocomplete="off" value="{{trim($klien->ig,' ')}}" placeholder="instagram"  />
                                    </div>
                                </div>
                            </div>           
                        <div class="row submitbtn1">
                            <!-- <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" name="simpanbutton">KE KREDIT</button>
                            </div> -->
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">SIMPAN</button>
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

$('#sKota').on('change', function(){
    $.post('{{ URL::to('site/data') }}', {type: 'kecamatan', id: $('#sKota').val()}, function(e){
        $('#sKecamatan').html(e);
    });
    $('#sDesa').html('');
});
$('#sKecamatan').on('change', function(){
    $.post('{{ URL::to('site/data') }}', {type: 'desa', id: $('#sKecamatan').val()}, function(e){
        $('#sDesa').html(e);
    });
});
// 
    var SUBM = 0;
    function isNumber(nama,pesan) {
        var val = $('[name="'+nama+'"]').val().replace(/[\s-()]+/g, "");
        //return !isNaN(parseFloat(val)) && isFinite(val);
        if(!(!isNaN(parseFloat(val)) && isFinite(val))){
            $('.errormsg').append('<li class="text-danger">'+pesan+' hanya berisi angka</li>');
            $('[name="'+nama+'"]').css("background-color", "#F9CECE");
        }
    }
    function checkEmpty(nama,pesan){
        if($('[name="'+nama+'"]').val() == ''){
            $('.errormsg').append('<li class="text-danger">'+pesan+' wajib diisi</li>');
            $('[name="'+nama+'"]').css("background-color", "#F9CECE");
        }
    }
    $(document).ready(function() {

         $("#tanggalmohon").datepicker({ dateFormat: 'dd-mm-yy' });
         $("#tanggalberlaku").datepicker({ dateFormat: 'dd-mm-yy' });
         $("#tanggallahir").datepicker({ dateFormat: 'dd-mm-yy' });
         $("#tanggallahirps").datepicker({ dateFormat: 'dd-mm-yy' });
        $('[name="input_pendapatan_nasabah"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="input_biaya_hidup_nasabah"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        

        $("#hp").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesan").html("isikan angka").show().fadeOut("slow");
                return false;
            }
         });
        $("#hpku").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanku").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#ktp").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanktp").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#kodepos").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanpos").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#tanggungan").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesantang").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#pendapatan").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesandapat").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#biaya").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanbi").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });

        //angular??


        $("#ktpps").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanktps").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#rtps").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanrts").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#rt").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanrt").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#rw").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanrw").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#rwps").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanrws").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        
        $("#posps").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanposs").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
});
</script>
@endsection
