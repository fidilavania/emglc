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
            <form class="form-horizontal" id="simpanform" role="form" method="POST" action="{{ url('/savemateri/$nonsb') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                    <div class="panel-heading"><h4 align="center">MASUKKAN DATA MATERI</h4></div>
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
                                    <label class="col-sm-3 control-label">Nama Modul</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="namamodul" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="Nama Modul" required />
                                    </div>
                                </div>
                               <!--  <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Pelaksanaan</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="tanggal_laksana" id='tanggal_laksana' placeholder ="{{date('d-m-Y')}}"  required>
                                    </div>
                                </div> -->
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Fasilitator</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_fasilitator" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="Nama Fasilitator" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Peserta</label>
                                    <div class="col-sm-9">
                                        <textarea rows="10" cols="135" name="peserta" value="" placeholder="Isi Peserta" style="text-transform:uppercase;"></textarea>
                                    </div>
                                </div>
                                <!-- <div class="summernote">summernote 1</div> -->
                                <div class="summernote">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Silabus</label>
                                    <div class="col-sm-9">
                                        <textarea rows="20" cols="135" name="silabus" value="" placeholder="Isi Silabus" style="text-transform:uppercase;" id="silabus"></textarea>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Durasi</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="durasi" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="durasi"  />
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
                                            <input type="text" class="form-control" name="biaya" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="00000"  />
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
    
    $(document).ready(function() {

        
        $("#tanggal_laksana").datepicker({ dateFormat: 'dd-mm-yy' });
        $('[name="biaya"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        

       
});
</script>
@endsection
