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
                                    <label class="col-sm-3 control-label">Tanggal</label>
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
                            <div class="row form-group" hidden>
                                    <label class="col-sm-3 control-label">Kantor</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="kantor" autocomplete="off" value="{{ trim(Auth::user()->kantor,' ') }}" style="text-transform:uppercase;" readonly />
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
                                <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Tanggal Kegiatan</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control"  value="{{$peserta->tgl_keg}}" style="text-transform:uppercase;"  readonly />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Lokasi Kegiatan</label>
                                        <div class="col-sm-7">
                                        <input type="text" class="form-control"  value="{{$peserta->lokasi_keg}}" style="text-transform:uppercase;"  readonly />
                                    </div>
                                </div>
                                </div>
                                <br><br><br><br><br>
                                @if(isset($peserta))
                                @foreach($arr as $aa)
                                    <label>Kantor : {{$aa[key($aa)]->kantor}}</label>
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
                                            @foreach($aa as $a)
                                            <tr>
                                                <td data-id="{{$peserta->kode_modul}}/{{$a->kantor}}">{{$a->no_sdm}}</td>
                                                <td>{{$a->kantor}}</td>
                                                <td>{{$a->nama}}</td>
                                                <td>{{$a->jenis_kel}}</td>
                                                <td>{{$a->jabatan}}</td>
                                                <td>{{$a->alamat_tinggal}}</td>
                                                <td>{{$a->notlp}}</td>
                                                <td>{{$a->nohp}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <?php
                                        echo '<button type="button" class="btn btn-success" name="cetak" value="'.$aa[key($aa)]->kantor.'">Cetak Pendaftaran '.$aa[key($aa)]->kantor.'</button>';
                                    ?>
                                    <br><br>
                                @endforeach
                                @endif
                                
                            </div>

                            <div class="col-sm-12">
                                <br/>
                                <br/>
                            </div>
                            <!-- <div class="col-sm-12">
                                <input type="button" class="btn btn-warning" value="Edit Peserta" id="editKantor" />
                                <br/>
                                <br/>
                                <div class="KantorEdit">
                                </div>
                            </div> -->
                            @endif
                            <br>
                            @if(empty($peserta))
                            <div class="col-sm-12">
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
                                <a href="{{ url('/pendaftaran') }}" id="clear-filter" title="KEMBALI">[Kembali Ke Daftar]</a>
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
        <div class="col-sm-12">
            @if(isset($matdet))
            <div class="col-sm-6">
                <div class="row form-group">
                    <label class="col-sm-4 control-label">Tanggal Kegiatan</label>
                        <div class="col-sm-7">
                            <select class="form-control" name="tanggal_keg" required>
                                <option value>-Pilih Tanggal-</option>
                                @if($matdet->tgl_mulai_1 == '1970-01-01')
                                <option>-</option>
                                @else
                                <option value="{{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_1,' ')))}} sampai {{date('d-m-Y',strtotime(trim($matdet->tgl_end_1,' ')))}}">
                                    {{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_1,' ')))}} s/d {{date('d-m-Y',strtotime(trim($matdet->tgl_end_1,' ')))}}</option>
                                @endif
                                @if($matdet->tgl_mulai_2 == '1970-01-01')
                                <option>-</option>
                                @else
                                <option value="{{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_2,' ')))}} sampai {{date('d-m-Y',strtotime(trim($matdet->tgl_end_2,' ')))}}">
                                    {{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_2,' ')))}} s/d {{date('d-m-Y',strtotime(trim($matdet->tgl_end_2,' ')))}}</option>
                                @endif
                                @if($matdet->tgl_mulai_3 == '1970-01-01')
                                <option>-</option>
                                @else
                                <option value="{{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_3,' ')))}} sampai {{date('d-m-Y',strtotime(trim($matdet->tgl_end_3,' ')))}}">
                                    {{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_3,' ')))}} s/d {{date('d-m-Y',strtotime(trim($matdet->tgl_end_3,' ')))}}</option>
                                @endif
                                @if($matdet->tgl_mulai_3 == '1970-01-01')
                                <option>-</option>
                                @else
                                <option value="{{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_4,' ')))}} sampai {{date('d-m-Y',strtotime(trim($matdet->tgl_end_4,' ')))}}">
                                    {{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_4,' ')))}} s/d {{date('d-m-Y',strtotime(trim($matdet->tgl_end_4,' ')))}}</option>
                                @endif
                                @if($matdet->tgl_mulai_5 == '1970-01-01')
                                <option>-</option>
                                @else
                                <option value="{{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_5,' ')))}} sampai {{date('d-m-Y',strtotime(trim($matdet->tgl_end_5,' ')))}}">
                                    {{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_5,' ')))}} s/d {{date('d-m-Y',strtotime(trim($matdet->tgl_end_5,' ')))}}</option>
                                @endif
                            </select>
                        </div>
                </div> 
                <div class="row form-group">
                    <label class="col-sm-4 control-label">Lokasi Kegiatan</label>
                        <div class="col-sm-7">
                            <select class="form-control" name="lokasi_keg" required>
                                <option value>-Pilih Lokasi-</option>
                                <option value="{{trim($matdet->lokasi_1,' ')}}">{{trim($matdet->lokasi_1,' ')}}</option>
                                <option value="{{trim($matdet->lokasi_2,' ')}}">{{trim($matdet->lokasi_2,' ')}}</option>
                                <option value="{{trim($matdet->lokasi_3,' ')}}">{{trim($matdet->lokasi_3,' ')}}</option>
                                <option value="{{trim($matdet->lokasi_4,' ')}}">{{trim($matdet->lokasi_4,' ')}}</option>
                                <option value="{{trim($matdet->lokasi_5,' ')}}">{{trim($matdet->lokasi_5,' ')}}</option>
                            </select>
                        </div>
                </div>              
            </div>
            @endif
            @if(empty($matdet))
            <div class="col-sm-6">
            </div>
            @endif
        </div>
        <!-- <div class="col-sm-12"> -->
            <div class="col-sm-12">
                <table class="table-bordered"  style="border-style: solid 1px #000000;" width=100% >
                    <thead>
                        <th>No. SDM</th>
                        <th>Nama</th>
                        <th>JK</th>
                        <th>Kantor</th>
                        <th>Jabatan</th>
                    </thead>
                    <tbody>
                        <?php
                            foreach($sdm as $j){
                                if( trim($j->induk_kantor,' ') == trim(Auth::user()->kantor,' ')) {
                                echo '<tr>';
                                // <input type="text" class="form-control" name="lokasi3" autocomplete="off" value="{{trim($detail->lokasi_3,' ')}}" style="text-transform:uppercase;" placeholder="Lokasi" readonly />
                                echo '<td>'."<input type='checkbox' name='peserta[]' id='peserta' value='".$j->no_sdm."'/>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;$j->no_sdm".'</td>'; 
                                echo '<td>'.$j->nama.'</td>';
                                if(trim($j->jenis_kel,' ') == 'WANITA'){
                                echo '<td>P</td>';
                                }else{
                                echo '<td>L</td>';    
                                }
                                echo '<td>'.$j->kantor.'</td>';
                                echo '<td>'.$j->jabatan.'</td>';
                                echo '</tr>';
                                }
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        <!-- </div> -->
    </div>
</div>
@if(isset($peserta))
<div id="kantorEdit" data-op ="kantoredit" hidden>
 <div class="panel-body">
    <div class="row">
        <div class="panel-primary"><h4 align="center">EDIT PESERTA</h4></div><br><br>
        <div class="col-sm-12">
            <div class="col-sm-6">

                <table class="table-bordered"  style="border-style: solid 1px #000000;" width=100% >
                    <thead>
                        <th>No. SDM</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                    </thead>
                    <tbody>
                        <td><input type="text" name="nomor" value="{{$peserta->nomor}}" hidden /></td>
                        <?php
                            foreach($sdm as $j){
                                if( trim($j->induk_kantor,' ') == trim(Auth::user()->kantor,' ')) {
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
            @if(isset($matdet))
            <div class="col-sm-6">
                <div class="row form-group">
                    <label class="col-sm-3 control-label">Tanggal Kegiatan</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="tanggal_keg">
                                <option>-Pilih Tanggal-</option>
                                @if($matdet->tgl_mulai_1 == '1970-01-01')
                                <option>-</option>
                                @else
                                <option value="{{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_1,' ')))}} sampai {{date('d-m-Y',strtotime(trim($matdet->tgl_end_1,' ')))}}">
                                    {{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_1,' ')))}} s/d {{date('d-m-Y',strtotime(trim($matdet->tgl_end_1,' ')))}}</option>
                                @endif
                                @if($matdet->tgl_mulai_2 == '1970-01-01')
                                <option>-</option>
                                @else
                                <option value="{{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_2,' ')))}} sampai {{date('d-m-Y',strtotime(trim($matdet->tgl_end_2,' ')))}}">
                                    {{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_2,' ')))}} s/d {{date('d-m-Y',strtotime(trim($matdet->tgl_end_2,' ')))}}</option>
                                @endif
                                @if($matdet->tgl_mulai_3 == '1970-01-01')
                                <option>-</option>
                                @else
                                <option value="{{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_3,' ')))}} sampai {{date('d-m-Y',strtotime(trim($matdet->tgl_end_3,' ')))}}">
                                    {{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_3,' ')))}} s/d {{date('d-m-Y',strtotime(trim($matdet->tgl_end_3,' ')))}}</option>
                                @endif
                                @if($matdet->tgl_mulai_3 == '1970-01-01')
                                <option>-</option>
                                @else
                                <option value="{{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_4,' ')))}} sampai {{date('d-m-Y',strtotime(trim($matdet->tgl_end_4,' ')))}}">
                                    {{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_4,' ')))}} s/d {{date('d-m-Y',strtotime(trim($matdet->tgl_end_4,' ')))}}</option>
                                @endif
                                @if($matdet->tgl_mulai_5 == '1970-01-01')
                                <option>-</option>
                                @else
                                <option value="{{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_5,' ')))}} sampai {{date('d-m-Y',strtotime(trim($matdet->tgl_end_5,' ')))}}">
                                    {{date('d-m-Y',strtotime(trim($matdet->tgl_mulai_5,' ')))}} s/d {{date('d-m-Y',strtotime(trim($matdet->tgl_end_5,' ')))}}</option>
                                @endif
                            </select>
                        </div>
                </div> 
                <div class="row form-group">
                    <label class="col-sm-3 control-label">Lokasi Kegiatan</label>
                        <div class="col-sm-8">
                            <select class="form-control" name="lokasi_keg">
                                <option>-Pilih Lokasi-</option>
                                <option value="{{trim($matdet->lokasi_1,' ')}}">{{trim($matdet->lokasi_1,' ')}}</option>
                                <option value="{{trim($matdet->lokasi_2,' ')}}">{{trim($matdet->lokasi_2,' ')}}</option>
                                <option value="{{trim($matdet->lokasi_3,' ')}}">{{trim($matdet->lokasi_3,' ')}}</option>
                                <option value="{{trim($matdet->lokasi_4,' ')}}">{{trim($matdet->lokasi_4,' ')}}</option>
                                <option value="{{trim($matdet->lokasi_5,' ')}}">{{trim($matdet->lokasi_5,' ')}}</option>
                            </select>
                        </div>
                </div>              
            </div>
            @endif
            @if(empty($matdet))
            <div class="col-sm-6">
            </div>
            @endif
            <div class="row submitbtn1">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">SIMPAN</button>
                                <!-- <a href="{{ url('/pendaftaran') }}" id="clear-filter" title="KEMBALI">[Kembali Ke Daftar]</a> -->
                            </div>
                        </div>
        </div>
    </div>
</div>
@endif
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

        $('#editKantor').click(function(){
            var $template = $('#kantorEdit'),
                $clone    = $template
                                // .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                //.attr('id','tanahBangunanForm'+$('[data-jaminan="tanahBangunan"]').length)
                                //.attr('id','tanahBangunanForm'+INC_OP)
                                //.insertBefore($template);
                                .appendTo('.KantorEdit');
            
        });

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


        $("#tanggallahir").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggallahirps").datepicker({ dateFormat: 'dd-mm-yy' });
        $('[name="input_pendapatan"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="input_biaya_hidup"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

        // $('[name="cetak"]').click(function() {
        //     console.log($(this).parent().parent().find('td:nth-child(2)').text());
        //     console.log($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Cetak Pendaftaran');
        //     if($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'View'){
        //         window.location.href = '{{url("/cetak")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
        //     } else {
        //         window.location.href = '{{url("/cetak")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
        //     }
        // });

        $('[name="cetak"]').click(function() {
            window.location.href = '{{url("/cetak")}}'+'/'+'{{trim($materi->kode_modul,' ')}}'+'/'+$(this).val();
        });
        

       
});
</script>
@endsection
