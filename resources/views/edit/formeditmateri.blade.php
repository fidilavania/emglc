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
            <form class="form-horizontal" id="simpanform" role="form" method="POST" action="{{ url('/savemateriedit/$nonsb') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                    <div class="panel-heading"><h4 align="center">EDIT DATA MATERI</h4></div>
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
                                    <label class="col-sm-3 control-label">Kode Modul</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="kode_modul" autocomplete="off" value="{{trim($materi->kode_modul,' ')}}" style="text-transform:uppercase;" readonly />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nama Modul</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="namamodul" autocomplete="off" value="{{trim($materi->nama_modul,' ')}}" style="text-transform:uppercase;" placeholder="Nama Modul" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Fasilitator</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_fasilitator" autocomplete="off" value="{{trim($materi->fasilitator,' ')}}" style="text-transform:uppercase;" placeholder="Nama Fasilitator" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Peserta</label>
                                    <div class="col-sm-9">
                                        <textarea rows="10" cols="135" name="peserta" placeholder="Isi Peserta" style="text-transform:uppercase;">{{trim($materi->peserta,' ')}}</textarea>
                                    </div>
                                </div>
                                <!-- <div class="summernote">summernote 1</div> -->
                                <div class="summernote">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Silabus</label>
                                    <div class="col-sm-9">
                                        <textarea rows="20" cols="135" name="silabus" placeholder="Isi Silabus" style="text-transform:uppercase;" id="silabus">{{$materi->silabus}}</textarea>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Durasi</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="durasi" autocomplete="off" value="{{trim($materi->durasi,' ')}}" style="text-transform:uppercase;" placeholder="durasi"  />
                                            <span class="input-group-addon">Sesi</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Biaya Investasi</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="text" class="form-control" name="biaya" autocomplete="off" value="{{trim($materi->biaya,' ')}}" style="text-transform:uppercase;" placeholder="00000"  />
                                        </div>
                                    </div>
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
    (function (factory) {
          /* Global define */
          if (typeof define === 'function' && define.amd) {
            // AMD. Register as an anonymous module.
            define(['jquery'], factory);
          } else if (typeof module === 'object' && module.exports) {
            // Node/CommonJS
            module.exports = factory(require('jquery'));
          } else {
            // Browser globals
            factory(window.jQuery);
          }
    }
    $(document).ready(function() {

        $('.summernote').summernote();

        $("#tanggalmohon").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggalberlaku").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggallahir").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggallahirps").datepicker({ dateFormat: 'dd-mm-yy' });
        $('[name="input_pendapatan_nasabah"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="input_biaya_hidup_nasabah"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="biaya"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        

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
