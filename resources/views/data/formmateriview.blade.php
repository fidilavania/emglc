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
                    <div class="panel-heading"><h4 align="center">DETAIL MATERI</h4></div>
                    <div class="row">
                        <div class="col-sm-3">
                            <?php
                               
                            ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Input</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_tanggal_mohon" id="tanggalmohon" value="{{date('d-m-Y',strtotime($materi->tgl_input))}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Operator</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="opr" autocomplete="off" value="{{trim($materi->opr,' ')}}" style="text-transform:uppercase;" readonly />
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
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Fasilitator</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_fasilitator" autocomplete="off" value="{{trim($materi->fasilitator,' ')}}" style="text-transform:uppercase;" placeholder="Nama Fasilitator" readonly />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Peserta</label>
                                    <div class="col-sm-9">
                                        <textarea rows="10" cols="135" name="peserta" placeholder="Isi Peserta" style="text-transform:uppercase;" readonly>{{trim($materi->peserta,' ')}}</textarea>
                                    </div>
                                </div>
                                <div class="summernote">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Silabus</label>
                                    <div class="col-sm-9">
                                        <textarea rows="20" cols="135" name="silabus" placeholder="Isi Silabus" style="text-transform:uppercase;" id="silabus" readonly>{{$materi->silabus}}</textarea>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Durasi</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="durasi" autocomplete="off" value="{{trim($materi->durasi,' ')}}" style="text-transform:uppercase;" placeholder="durasi" readonly  />
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
                                            <input type="text" class="form-control" name="biaya" autocomplete="off" value="{{number_format($materi->biaya,0,'','.')}}" style="text-transform:uppercase;" placeholder="00000"  readonly />
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
                        <div class="row">
                            <!-- @foreach($peserta as $p)
                                <div class="col-sm-4">   
                                    <input type="text" class="form-control" value="{{trim($p->tgl_keg,' ')}}" readonly >
                                </div>
                            @endforeach -->
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                    <div class="panel-heading"><h4 align="center">DAFTAR PESERTA</h4></div>
                                    <table class="table table-bordered"  style="border-style: solid 1px #000000;" width=100% >
                                        <thead>
                                            <th>No.</th>
                                            <th>No. SDM</th>
                                            <th>Kantor</th>
                                            <th>Nama</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Jabatan</th>
                                            <!-- <th>Tanggal Kegiatan</th> -->
                                            <!-- <th>Lokasi Kegiatan</th> -->
                                            <!-- <th>Tanggal Kegiatan</th>
                                            <th>Lokasi Kegiatan</th> -->
                                        </thead>
                                        <tbody>
                                            @foreach($peserta as $p)
                                                <td data-id="{{$p->kode_modul}}" hidden></td>
                                            @endforeach
                                            <?php
                                            $no = 0;
                                                foreach ($all as $a) {
                                                $no++;
                                                    echo '<td align="center">'.$no.'</td>'; 
                                                    // echo '<tr>';
                                                    echo '<td align="center">'.$a->no_sdm.'</td>'; 
                                                    echo '<td>'.$a->kantor.'</td>';
                                                    echo '<td>'.$a->nama.'</td>';
                                                    echo '<td>'.$a->jenis_kel.'</td>';
                                                    echo '<td>'.$a->jabatan.'</td>';
                                                    // echo '<td>'.$p->tgl_keg.'</td>';
                                                    // echo '<td>'.$p->lokasi_keg.'</td>';
                                                    echo '</tr>';
                                                        // echo '<td>'.$p->tgl_keg.'</td>';
                                                    // }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                            </div>
                        </div>
                            <div class="col-sm-12">
                                @if($materi->materi != '')
                                <a href="{{$materi->materi}}" id="clear-filter" >
                                    <input type="button" class="btn btn-success" name="materi" value="DOWNLOAD MATERI">
                                </a>
                                @endif
                                <input type="button" class="btn btn-primary" name="cetak" value="Daftar Hadir" />
                                <input type="button" class="btn btn-primary" name="excel" value="Expor Excel" />
                                <br/>
                                <br/>
                            </div>
                        <br><br>
                        <div class="row submitbtn1">
                            <!-- <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" name="simpanbutton">KE KREDIT</button>
                            </div> -->
                            <div class="col-sm-12">
                                <a href="{{ url('/datamateri') }}" id="clear-filter" title="Input SDM Baru">[Kembali Ke Daftar]</a>
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

        $('[name="cetak"]').click(function() {
            console.log($(this).parent().parent().find('td:nth-child(2)').text());
            console.log($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Daftar Hadir');
            if($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'View'){
                window.location.href = '{{url("/presensi")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
            } else {
                window.location.href = '{{url("/presensi")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
            }
        });

        $('[name="excel"]').click(function() {
            console.log($(this).parent().parent().find('td:nth-child(2)').text());
            console.log($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Expor Excel');
            if($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'View'){
                window.location.href = '{{url("/presensiexcel")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
            } else {
                window.location.href = '{{url("/presensiexcel")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
            }
        });

        

    });
</script>
@endsection
