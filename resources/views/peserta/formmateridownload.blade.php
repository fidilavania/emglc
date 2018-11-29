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
                            
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6" hidden>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Input</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_tanggal_mohon" id="tanggalmohon" value="{{date('d-m-Y',strtotime($materi->tgl_input))}}" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group" hidden>
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
                                        <textarea rows="10" cols="135" name="peserta" placeholder="Isi Peserta" style="text-transform: uppercase; margin: 0px; height: 211px; width: 912px;" readonly>{{trim($materi->peserta,' ')}}</textarea>
                                    </div>
                                </div>
                                <div class="summernote">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Silabus</label>
                                    <div class="col-sm-9">
                                        <textarea rows="20" cols="135" name="silabus" placeholder="Isi Silabus" style="text-transform: uppercase; margin: 0px; height: 409px; width: 912px;" id="silabus" readonly>{{$materi->silabus}}</textarea>
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
                        <div class="col-sm-12">
                            @if($materi->foto != '')
                                <a href="{{$materi->foto}}" id="clear-filter" >
                                    <input type="button" class="btn btn-success" name="foto" value="DOWNLOAD FOTO">
                                </a>
                            @endif
                            @if($materi->materi != '')
                                <a href="{{$materi->materi}}" id="clear-filter" >
                                    <input type="button" class="btn btn-success" name="materi" value="DOWNLOAD MATERI">
                                </a>
                            @endif
                        </div>
                        <br><br>
                        <div class="row submitbtn1">
                            <div class="col-sm-12">
                                <a href="{{ url('/pendaftaran') }}" id="clear-filter" title="Input SDM Baru">[Kembali Ke Daftar]</a>
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

        // $('[name="materi"]').click(function() {
        //     console.log($(this).parent().parent().find('td:nth-child(2)').text());
        //     console.log($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Materi');
        //     if($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Materi'){
        //         window.location.href = '{{$materi->materi}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
        //     } else {
        //         window.location.href ='{{$materi->materi}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
        //     }
        // });


        // $('[name="materi"]').click(function() {
        //     window.location.href = '{{$materi->materi}}'+'/'+'{{trim($materi->kode_modul,' ')}}'+'/'+$(this).val();
        // });

    });
</script>
@endsection
