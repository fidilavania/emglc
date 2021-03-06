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
            <form class="form-horizontal" id="simpanform" role="form" method="POST" action="{{ url('/savedaftar/$nonsb') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                    <div class="panel-heading"><h4 align="center">DETAIL</h4></div>
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
                                        <input type="text" class="form-control" name="namamodul" autocomplete="off" value="{{trim($materi->nama_modul,' ')}}" style="text-transform:uppercase;" placeholder="Nama Modul" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Fasilitator</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="input_fasilitator" autocomplete="off" value="{{trim($materi->fasilitator,' ')}}" style="text-transform:uppercase;" placeholder="Nama Fasilitator" readonly />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Biaya Investasi</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="text" class="form-control" name="biaya" autocomplete="off" value="{{number_format($materi->biaya,0,'','.')}}" style="text-transform:uppercase;" placeholder="00000" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(isset($matdet))
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Pelaksanaan 1</label>
                                    <div class="col-sm-4">
                                        @if($matdet->tgl_mulai_1 == '1970-01-01')
                                        <input type="text" class="form-control" name="tanggal_end_1" id='tanggal_end_1' placeholder ="{{date('d-m-Y')}}" value="-" readonly >
                                        @else
                                        <input type="text" class="form-control" name="tanggal_laksana1" id='tanggal_laksana1' placeholder ="{{date('d-m-Y')}}" value="{{date('d-m-Y',strtotime($matdet->tgl_mulai_1))}}" readonly > 
                                        @endif
                                    </div>
                                    <label class="col-sm-1">s/d</label>
                                    <div class="col-sm-4">
                                        @if($matdet->tgl_end_1 == '1970-01-01')
                                        <input type="text" class="form-control" name="tanggal_end_1" id='tanggal_end_1' placeholder ="{{date('d-m-Y')}}" value="-" readonly >
                                        @else
                                        <input type="text" class="form-control" name="tanggal_end_1" id='tanggal_end_1' placeholder ="{{date('d-m-Y')}}" value="{{date('d-m-Y',strtotime($matdet->tgl_end_1))}}" readonly >
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Pelaksanaan 2</label>
                                    <div class="col-sm-4">
                                        @if($matdet->tgl_mulai_2 == '1970-01-01')
                                        <input type="text" class="form-control" name="tanggal_end_1" id='tanggal_end_1' placeholder ="{{date('d-m-Y')}}" value="-" readonly >
                                        @else
                                        <input type="text" class="form-control" name="tanggal_laksana2" id='tanggal_laksana2' placeholder ="{{date('d-m-Y')}}" value="{{date('d-m-Y',strtotime($matdet->tgl_mulai_2))}}" readonly >
                                        @endif
                                    </div>
                                    <label class="col-sm-1">s/d</label>
                                    <div class="col-sm-4">
                                        @if($matdet->tgl_end_2 == '1970-01-01')
                                        <input type="text" class="form-control" name="tanggal_end_1" id='tanggal_end_1' placeholder ="{{date('d-m-Y')}}" value="-" readonly >
                                        @else
                                        <input type="text" class="form-control" name="tanggal_end_2" id='tanggal_end_2' placeholder ="{{date('d-m-Y')}}" value="{{date('d-m-Y',strtotime($matdet->tgl_end_2))}}" readonly >
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Pelaksanaan 3</label>
                                    <div class="col-sm-4">
                                        @if($matdet->tgl_mulai_3 == '1970-01-01')
                                        <input type="text" class="form-control" name="tanggal_end_1" id='tanggal_end_1' placeholder ="{{date('d-m-Y')}}" value="-" readonly >
                                        @else
                                        <input type="text" class="form-control" name="tanggal_laksana3" id='tanggal_laksana3' placeholder ="{{date('d-m-Y')}}" value="{{date('d-m-Y',strtotime($matdet->tgl_mulai_3))}}" readonly >
                                        @endif
                                    </div>
                                    <label class="col-sm-1">s/d</label>
                                    <div class="col-sm-4">
                                        @if($matdet->tgl_end_3 == '1970-01-01')
                                        <input type="text" class="form-control" name="tanggal_end_1" id='tanggal_end_1' placeholder ="{{date('d-m-Y')}}" value="-" readonly >
                                        @else
                                        <input type="text" class="form-control" name="tanggal_end_3" id='tanggal_end_3' placeholder ="{{date('d-m-Y')}}" value="{{date('d-m-Y',strtotime($matdet->tgl_end_3))}}" readonly >
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Pelaksanaan 4</label>
                                    <div class="col-sm-4">
                                        @if($matdet->tgl_mulai_4 == '1970-01-01')
                                        <input type="text" class="form-control" name="tanggal_end_1" id='tanggal_end_1' placeholder ="{{date('d-m-Y')}}" value="-" readonly >
                                        @else
                                        <input type="text" class="form-control" name="tanggal_laksana4" id='tanggal_laksana4' placeholder ="{{date('d-m-Y')}}" value="{{date('d-m-Y',strtotime($matdet->tgl_mulai_4))}}" readonly >
                                        @endif
                                    </div>
                                    <label class="col-sm-1">s/d</label>
                                    <div class="col-sm-4">
                                        @if($matdet->tgl_end_4 == '1970-01-01')
                                        <input type="text" class="form-control" name="tanggal_end_1" id='tanggal_end_1' placeholder ="{{date('d-m-Y')}}" value="-" readonly >
                                        @else
                                        <input type="text" class="form-control" name="tanggal_end_4" id='tanggal_end_4' placeholder ="{{date('d-m-Y')}}" value="{{date('d-m-Y',strtotime($matdet->tgl_end_4))}}" readonly >
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Pelaksanaan 5</label>
                                    <div class="col-sm-4">
                                        @if($matdet->tgl_mulai_5 == '1970-01-01')
                                        <input type="text" class="form-control" name="tanggal_end_1" id='tanggal_end_1' placeholder ="{{date('d-m-Y')}}" value="-" readonly >
                                        @else
                                        <input type="text" class="form-control" name="tanggal_laksana5" id='tanggal_laksana5' placeholder ="{{date('d-m-Y')}}" value="{{date('d-m-Y',strtotime($matdet->tgl_mulai_5))}}" readonly >
                                        @endif
                                    </div>
                                    <label class="col-sm-1">s/d</label>
                                    <div class="col-sm-4">
                                        @if($matdet->tgl_end_5 == '1970-01-01')
                                        <input type="text" class="form-control" name="tanggal_end_1" id='tanggal_end_1' placeholder ="{{date('d-m-Y')}}" value="-" readonly >
                                        @else
                                        <input type="text" class="form-control" name="tanggal_end_5" id='tanggal_end_5' placeholder ="{{date('d-m-Y')}}" value="{{date('d-m-Y',strtotime($matdet->tgl_end_5))}}" readonly >
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Lokasi Pelaksanaan 1</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="lokasi1" autocomplete="off" style="text-transform:uppercase;" placeholder="Lokasi" value="{{trim($matdet->lokasi_1,' ')}}" readonly />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Lokasi Pelaksanaan 2</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="lokasi2" autocomplete="off" value="{{trim($matdet->lokasi_2,' ')}}" readonly style="text-transform:uppercase;" placeholder="Lokasi" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Lokasi Pelaksanaan 3</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="lokasi3" autocomplete="off" value="{{trim($matdet->lokasi_3,' ')}}" readonly style="text-transform:uppercase;" placeholder="Lokasi" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Lokasi Pelaksanaan 4</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="lokasi4" autocomplete="off" value="{{trim($matdet->lokasi_4,' ')}}" readonly style="text-transform:uppercase;" placeholder="Lokasi" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Lokasi Pelaksanaan 5</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="lokasi5" autocomplete="off" value="{{trim($matdet->lokasi_5,' ')}}" readonly style="text-transform:uppercase;" placeholder="Lokasi" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(empty($matdet))
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Pelaksanaan 1</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="tanggal_laksana1" id='tanggal_laksana1' placeholder ="{{date('d-m-Y')}}" > 
                                    </div>
                                    <label class="col-sm-1">-</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="tanggal_end_1" id='tanggal_end_1' placeholder ="{{date('d-m-Y')}}" >
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Pelaksanaan 2</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="tanggal_laksana2" id='tanggal_laksana2' placeholder ="{{date('d-m-Y')}}" >
                                    </div>
                                    <label class="col-sm-1">-</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="tanggal_end_2" id='tanggal_end_2' placeholder ="{{date('d-m-Y')}}" >
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Pelaksanaan 3</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="tanggal_laksana3" id='tanggal_laksana3' placeholder ="{{date('d-m-Y')}}" >
                                    </div>
                                    <label class="col-sm-1">-</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="tanggal_end_3" id='tanggal_end_3' placeholder ="{{date('d-m-Y')}}" >
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Pelaksanaan 4</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="tanggal_laksana4" id='tanggal_laksana4' placeholder ="{{date('d-m-Y')}}" >
                                    </div>
                                    <label class="col-sm-1">-</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="tanggal_end_4" id='tanggal_end_4' placeholder ="{{date('d-m-Y')}}" >
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Pelaksanaan 5</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="tanggal_laksana5" id='tanggal_laksana5' placeholder ="{{date('d-m-Y')}}" >
                                    </div>
                                    <label class="col-sm-1">-</label>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="tanggal_end_5" id='tanggal_end_5' placeholder ="{{date('d-m-Y')}}" >
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Lokasi Pelaksanaan 1</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="lokasi1" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="Lokasi" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Lokasi Pelaksanaan 2</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="lokasi2" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="Lokasi" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Lokasi Pelaksanaan 3</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="lokasi3" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="Lokasi" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Lokasi Pelaksanaan 4</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="lokasi4" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="Lokasi" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Lokasi Pelaksanaan 5</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="lokasi5" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="Lokasi" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <!-- <input type="button" class="btn btn-primary" value="Tambah Peserta" id="addKantor" /> -->
                        <br/>
                        <br/>
                        <div class="KantorTambah">
                        </div>
                        <br/>
                        <br/>
                        <div class="row submitbtn1">
                            <!-- <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" name="simpanbutton">KE KREDIT</button>
                            </div> -->
                            @if(empty($matdet))
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">SIMPAN</button>
                            </div>
                            @endif
                            @if(isset($matdet))
                            <div class="col-sm-12">
                                <a href="{{ url('/datamateri') }}" id="clear-filter" title="Kembali">[Kembali Ke Daftar]</a>
                            </div>
                            @endif
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

        $("#tanggal_laksana1").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggal_laksana2").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggal_laksana3").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggal_laksana4").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggal_laksana5").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggal_end_1").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggal_end_2").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggal_end_3").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggal_end_4").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggal_end_5").datepicker({ dateFormat: 'dd-mm-yy' });
       
});
</script>
@endsection
