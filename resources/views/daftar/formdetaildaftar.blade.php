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
            <form class="form-horizontal" id="simpanform" role="form" method="POST" action="{{ url('/savedetaildaftar/$nonsb') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                    <div class="panel-heading"><h4 align="center">TAMBAH PESERTA</h4></div>
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
                                    <div class="col-sm-8">
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
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="kode_modul" autocomplete="off" value="{{trim($materi->kode_modul,' ')}}" style="text-transform:uppercase;" readonly />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nama Modul</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="namamodul" autocomplete="off" value="{{trim($materi->nama_modul,' ')}}" style="text-transform:uppercase;" placeholder="Nama Modul" readonly />
                                    </div>
                                </div>
                                
                                <!-- <div class="row form-group">
                                    <label class="col-sm-3 control-label">Peserta</label>
                                    <div class="col-sm-9">
                                        <textarea rows="10" cols="54" name="peserta" placeholder="Isi Peserta" style="text-transform:uppercase;">.readonly {{trim($materi->peserta,' ')}}</textarea>
                                    </div>
                                </div> -->
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
                        <div class="row">
                            <div class="col-sm-12">
                                @if(isset($peserta))
                                <h4 align="center">DAFTAR PESERTA</h4>
                                <table class="table table-bordered" name="datasdm">
                                    <thead>
                                        <th>No SDM</th>
                                        <th>Kantor</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Jabatan</th>
                                        <th>Alamat</th>
                                        <th>No Tlp</th>
                                        <th>No Hp</th>
                                    </thead>
                                    <tbody>
                                        @if(isset($peserta))
                                        @foreach($datasdm as $data)
                                        <tr>
                                            <td data-id="{{$data->no_sdm}}">{{$data->no_sdm}}</td>
                                            <td>{{$data->kantor}}</td>
                                            <td>{{$data->nama}}</td>
                                            <td>{{$data->jenis_kel}}</td>
                                            <td>{{$data->jabatan}}</td>
                                            <td>{{$data->alamat_tinggal}}</td>
                                            <td>{{$data->notlp}}</td>
                                            <td>{{$data->nohp}}</td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                                @endif
                                <br>
                            </div>
                            @if(empty($peserta))
                            <div class="col-sm-6">
                                <input type="button" class="btn btn-primary" value="Tambah Peserta" id="addKantor" />
                                <br/>
                                <br/>
                                <div class="KantorTambah">
                                </div>
                            </div>
                            @endif
                        </div>
                        <br/>
                        <br/>
                        @if(isset($peserta))
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="{{ url('/pendaftaran') }}" id="clear-filter" title="KEMBALI">[Kembali Ke Daftar]</a>
                            </div>
                        </div>
                        @endif
                        @if(empty($peserta))
                        <div class="row submitbtn1">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">SIMPAN</button>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="kantorTambah" data-op ="kantor" hidden>
 <div class="panel-body">
    <div class="row">
        <div class="col-sm-15">
            <table class="table-bordered"  style="border-style: solid 1px #000000;" width=100% >
                <thead>
                    <th>No. SDM</th>
                    <th>Nama</th>
                    <th>Jabatan</th>
                </thead>
                <tbody>
                    <?php
                        foreach($sdm as $j){
                            if( trim($j->kantor,' ') == trim(Auth::user()->kantor,' ')) {
                            echo '<tr>';
                            // <input type="text" class="form-control" name="lokasi3" autocomplete="off" value="{{trim($detail->lokasi_3,' ')}}" style="text-transform:uppercase;" placeholder="Lokasi" readonly />
                            echo '<td>'."<input type='checkbox' name='peserta[]' id='peserta' value='".$j->no_sdm."'/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;$j->no_sdm".'</td>'; 
                            echo '<td>'.$j->nama.'</td>';
                            echo '<td>'.$j->jabatan.'</td>';
                            echo '</tr>';
                            }
                        }
                    ?>
                </tbody>
            </table>
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
                                // .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                //.attr('id','tanahBangunanForm'+$('[data-jaminan="tanahBangunan"]').length)
                                //.attr('id','tanahBangunanForm'+INC_OP)
                                //.insertBefore($template);
                                .appendTo('.KantorTambah');
            
        });

        // $("#tanggalmohon").datepicker({ dateFormat: 'dd-mm-yy' });
        // $("#tanggal_laksana1").datepicker({ dateFormat: 'dd-mm-yy' });
        // $("#tanggal_laksana2").datepicker({ dateFormat: 'dd-mm-yy' });
        // $("#tanggal_laksana3").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggallahir").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggallahirps").datepicker({ dateFormat: 'dd-mm-yy' });
        $('[name="input_pendapatan"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="input_biaya_hidup"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        

       
});
</script>
@endsection
