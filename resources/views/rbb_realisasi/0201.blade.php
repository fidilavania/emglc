@extends('layouts.apprbb')

@section('content')
<div class="container">
    <div class="col-sm-12">
        <div class="row">
            <div class="panel panel-primary">
                <div class="panel-heading"><h4 align="center">Data Realiasi Bisnis BPR</h4></div>
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
                                    <div class="col-sm-7">
                                        <select class="form-control" name="periode">
                                            <option value>-Pilih Periode-</option>
                                            @foreach($periode as $p)
                                                <option value="{{$p->periode}}">{{$p->periode}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-1">
                                            <input type="button" class="btn btn-primary" name="submbutton" value="Tampilkan" />
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
                                <label><h4>Realisasi Neraca</h4></label>
                                <table class="table1" name="tabelA">
                                    <thead>
                                        <tr>
                                            <th class="th3" rowspan="2">Periode</th>
                                            <th rowspan="2">Kantor</th>
                                            <th rowspan="2">Komponen</th>
                                            <th class="th2" rowspan="2">Pos-Pos Neraca</th>
                                            <th rowspan="2">Nominal Rencana (dalam Ribuan Rp.)</th>
                                            <th colspan="2">Realisasi</th>
                                            <th colspan="2">Selisih</th>
                                        </tr>
                                        <tr>
                                            <th>Nominal Realisasi Semester Tahun Penyusunan Laporan (dalam Ribuan Rp.)</th>
                                            <th>Persen Realisasi (%)</th>
                                            <th>Nominal Selisih Semester Tahun Penyusunan Laporan (dalam Ribuan Rp.)</th>
                                            <th>Persen Selisih (%)</th>
                                        </tr>
                                    </thead>
                                    <hr />
                                    <tbody>
                                       @foreach($rbbA as $A)
                                        <tr>
                                            <td>{{$A->periode}}</td>
                                            <td>{{$A->no_kantor}}</td>
                                            @if($A->basic == 'Tidak')
                                            <td></td>
                                            @else
                                            <td>{{$A->komponen}}</td>
                                            @endif
                                            <td>{{$A->pos}}</td>
                                            @if($A->basic == 'Tidak')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->nom,0,'','.')}}</td>
                                            @endif

                                            @if($A->basic == 'Tidak')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->nom_real,0,'','.')}}</td>
                                            @endif

                                            @if($A->basic == 'Tidak')
                                            <td></td>
                                            @else
                                            <td class="td1">{{($A->persen_real)}}</td>
                                            @endif

                                            @if($A->basic == 'Tidak')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->nom_selisih,0,'','.')}}</td>
                                            @endif

                                            @if($A->basic == 'Tidak')
                                            <td></td>
                                            @else
                                            <td class="td1">{{($A->persen_selisih)}}</td>
                                            @endif

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

@section('js')
<script type="text/javascript">
    
    $(document).ready(function() {
        $('[name="submbutton"]').click(function(){
            if($(this).val() == 'Tampilkan'){
                 window.location.href = '{{url("/0201R")}}'+'/'+$('[name="periode"]').val();
            }
            
        });
    });
</script>
@endsection
