@extends('layouts.apprbb')

@section('content')
<div class="container">
    <div class="col-sm-12">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading"><h4 align="center">Data Rencana Bisnis BPR</h4></div>
                <div class="panel-body" align="center">
                
                </div>
                <div class="panel-body" align="center">
                    <form action="{{ url('/proses') }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group" hidden>
                                    <label class="col-sm-3 control-label" >Tanggal</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="input_tanggal_mohon" id="tanggalmohon" value="{{date('d-m-Y')}}" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Periode</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="periode" autocomplete="off" value="{{date('Y')}}-12-31" style="text-transform:uppercase;" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group" hidden>
                                    <label class="col-sm-3 control-label">Operator</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="opr" autocomplete="off" value="{{ trim(Auth::user()->nama_lengkap,' ') }}" style="text-transform:uppercase;" readonly />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kantor</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="kantor" autocomplete="off" value="{{ trim(Auth::user()->kantor,' ') }}" style="text-transform:uppercase;" readonly />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br><br>
                        <div class="row" style="overflow: auto;max-height:10000px">
                            <div class="col-sm-12">
                                <label><h4>Target Rasio-Rasio dan Pos-Pos Keuangan</h4></label>
                                <table class="table1" name="tabelA">
                                    <thead>
                                        <tr>
                                            <th class="th3" rowspan="3">Periode</th>
                                            <th rowspan="3">Kantor</th>
                                            <th rowspan="3">Komponen</th>
                                            <th class="th4" rowspan="3">Rasio</th>
                                            <th colspan="3">Kinerja</th>
                                            <th colspan="15">Proyeksi</th>
                                        </tr>
                                        <tr>
                                            <th colspan="3">Bulan Oktober Tahun Penyusunan Laporan</th>
                                            <th colspan="3">Bulan Desember Tahun Penyusunan Laporan</th>
                                            <th colspan="3">Bulan Juni Tahun Pertama Rencana Bisnis</th>
                                            <th colspan="3">Bulan Desember Tahun Pertama Rencana Bisnis</th>
                                            <th colspan="3">Bulan Desember Tahun Kedua Rencana Bisnis</th>
                                            <th colspan="3">Bulan Desember Tahun Ketiga Rencana Bisnis</th>
                                        </tr>
                                        <tr>
                                            <th>Pembilang (dalam Ribuan Rp.)</th>
                                            <th>Penyebut (dalam Ribuan Rp.)</th>
                                            <th>%</th>
                                            <th>Pembilang (dalam Ribuan Rp.)</th>
                                            <th>Penyebut (dalam Ribuan Rp.)</th>
                                            <th>%</th>
                                            <th>Pembilang (dalam Ribuan Rp.)</th>
                                            <th>Penyebut (dalam Ribuan Rp.)</th>
                                            <th>%</th>
                                            <th>Pembilang (dalam Ribuan Rp.)</th>
                                            <th>Penyebut (dalam Ribuan Rp.)</th>
                                            <th>%</th>
                                            <th>Pembilang (dalam Ribuan Rp.)</th>
                                            <th>Penyebut (dalam Ribuan Rp.)</th>
                                            <th>%</th>
                                            <th>Pembilang (dalam Ribuan Rp.)</th>
                                            <th>Penyebut (dalam Ribuan Rp.)</th>
                                            <th>%</th>
                                        </tr>
                                    </thead>
                                    <hr />
                                    <tbody>
                                        @foreach($rbb as $A)
                                        <tr>
                                            <td>{{$A->periode}}</td>
                                            <td>{{$A->no_kantor}}</td>
                                            <td>{{$A->komponen}}</td>
                                            <td>{{$A->rasio}}</td>
                                            @if($A->komponen == '')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->kinerja_okt_pembilang,0,'','.')}}</td>
                                            @endif
                                            @if($A->komponen == '')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->kinerja_okt_penyebut,0,'','.')}}</td>
                                            @endif
                                            <td class="td1">{{$A->kinerja_persen}}</td>
                                            @if($A->komponen == '')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->proyeksi_des_pembilang,0,'','.')}}</td>
                                            @endif
                                            @if($A->komponen == '')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->proyeksi_des_penyebut,0,'','.')}}</td>
                                            @endif
                                            <td class="td1">{{$A->proyeksi_des_persen}}</td>
                                            @if($A->komponen == '')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->proyeksi_jun_pembilang,0,'','.')}}</td>
                                            @endif
                                            @if($A->komponen == '')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->proyeksi_jun_penyebut,0,'','.')}}</td>
                                            @endif
                                            <td class="td1">{{$A->proyeksi_jun_persen}}</td>
                                            @if($A->komponen == '')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->proyeksi_des_pembilang_1,0,'','.')}}</td>
                                            @endif
                                            @if($A->komponen == '')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->proyeksi_des_penyebut_1,0,'','.')}}</td>
                                            @endif
                                            <td class="td1">{{$A->proyeksi_des_persen_1}}</td>
                                            @if($A->komponen == '')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->proyeksi_des_pembilang_2,0,'','.')}}</td>
                                            @endif
                                            @if($A->komponen == '')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->proyeksi_des_penyebut_2,0,'','.')}}</td>
                                            @endif
                                            <td class="td1">{{$A->proyeksi_des_persen_2}}</td>
                                            @if($A->komponen == '')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->proyeksi_des_pembilang_3,0,'','.')}}</td>
                                            @endif
                                            @if($A->komponen == '')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->proyeksi_des_penyebut_3,0,'','.')}}</td>
                                            @endif
                                            <td class="td1">{{$A->proyeksi_des_persen_3}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
