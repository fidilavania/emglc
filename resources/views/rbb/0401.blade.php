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
                                    <label class="col-sm-3 control-label">Tanggal</label>
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
                                <label><h4>Proyeksi Laba Rugi</h4></label>
                                <table class="table1" name="tabelA">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">Periode</th>
                                            <th rowspan="2">Kantor</th>
                                            <th rowspan="2">Komponen</th>
                                            <th rowspan="2">Pos-Pos Laba Rugi</th>
                                            <th colspan="1">Kinerja</th>
                                            <th colspan="5">Proyeksi</th>
                                        </tr>
                                        <tr>
                                            <th>Bulan Oktober Tahun Penyusunan Laporan (dalam Ribuan Rp.)</th>
                                            <th>Bulan Desember Tahun Penyusunan Laporan (dalam Ribuan Rp.)</th>
                                            <th>Bulan Juni Tahun Pertama Rencana Bisnis (dalam Ribuan Rp.)</th>
                                            <th>Bulan Desember Tahun Pertama Rencana Bisnis (dalam Ribuan Rp.)</th>
                                            <th>Bulan Desember Tahun Kedua Rencana Bisnis (dalam Ribuan Rp.)</th>
                                            <th>Bulan Desember Tahun Ketiga Rencana Bisnis (dalam Ribuan Rp.)</th>
                                        </tr>
                                    </thead>
                                    <hr />
                                    <tbody>
                                        @foreach($rbb as $A)
                                        <tr>
                                            <td>{{$A->periode}}</td>
                                            <td>{{$A->no_kantor}}</td>
                                            <td>{{$A->komponen}}</td>
                                            <td>{{$A->pos}}</td>
                                            <td>{{$A->kinerja_okt}}</td>
                                            <td>{{$A->pro_des}}</td>
                                            <td>{{$A->pro_juni}}</td>
                                            <td>{{$A->pro_des1}}</td>
                                            <td>{{$A->pro_des2}}</td>
                                            <td>{{$A->pro_des3}}</td>

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
