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
            <form class="form-horizontal" id="simpanform" role="form" method="POST" action="{{ url('/savejabatan/$nonsb') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                    <div class="panel-heading"><h4 align="center">MASUKKAN DATA JABATAN</h4></div>
                    <div class="row">
                        <div class="col-sm-3">
                            <?php
                                echo "<font color='#ff0000'>wajib diisi*</font><br>";
                            ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <!-- <div class="row"> -->
                            <!-- <div class="col-sm-6">
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
                            </div> -->
                        <!-- </div> -->
                        
                        <table class="table-bordered"  style="border-style: solid 1px #000000;" width=80% >
                            <thead>
                                <th>Grade</th>
                                <th>Jabatan</th>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($jabatan as $j){
                                        echo '<tr>';
                                        echo '<td>'.$j->grade.'</td>';
                                        echo '<td>'.$j->jabatankantor.'</td>';
                                        echo '</tr>';
                                    }
                                ?>
                            </tbody>
                        </table>
                        <input type="button" class="btn btn-primary" value="Tambah Jabatan" id="addKantor" />
                        <div class="KantorTambah">
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
<div id="kantorTambah" data-op ="kantor" hidden>
    <div class="row">
        <div class="col-sm-6">
            <div class="row form-group">
                <label class="col-sm-3 control-label">Grade</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="input_grade" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="grade" required />
                </div>
            </div>
            <div class="row form-group">
                <label class="col-sm-3 control-label">Jabatan</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="input_jabatan" autocomplete="off" value=""  placeholder="jabatan" required />
                </div>
            </div>
        </div>
        <div class="col-sm-6">
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

        $('#addKantor').click(function(){
            var $template = $('#kantorTambah'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                //.attr('id','tanahBangunanForm'+$('[data-jaminan="tanahBangunan"]').length)
                                //.attr('id','tanahBangunanForm'+INC_OP)
                                //.insertBefore($template);
                                .appendTo('.KantorTambah');
            
        });

        $("#tanggalmohon").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggalberlaku").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggallahir").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggallahirps").datepicker({ dateFormat: 'dd-mm-yy' });
        $('[name="input_pendapatan"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="input_biaya_hidup"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        

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
