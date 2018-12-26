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
                                <label><h4>Realisasi Rasio Keuangan Pokok dan Pos-Pos Tertentu Lainnya</h4></label>
                                <table class="table1" name="tabelA">
                                    <thead>
                                        <tr>
                                            <th class="th3" rowspan="2">Periode</th>
                                            <th rowspan="2">Kantor</th>
                                            <th rowspan="2">Komponen</th>
                                            <th class="th2" rowspan="2">Pos-Pos Laba Rugi</th>
                                            <th colspan="3">Target</th>
                                            <th colspan="3">Realisasi</th>
                                            <th>Deviasi</th>
                                        </tr>
                                        <tr>
                                            <th>Pembilang (dalam Ribuan Rp.)</th>
                                            <th>Penyebut (dalam Ribuan Rp.)</th>
                                            <th>%</th>
                                            <th>Pembilang (dalam Ribuan Rp.)</th>
                                            <th>Penyebut (dalam Ribuan Rp.)</th>
                                            <th>%</th>
                                            <th>%</th>
                                        </tr>
                                    </thead>
                                    <hr />
                                    <tbody>
                                       @foreach($rbbC as $A)
                                        <tr>
                                            <td>{{$A->periode}}</td>
                                            <td>{{$A->no_kantor}}</td>
                                            @if($A->komponen == 0)
                                            <td></td>
                                            @else
                                            <td>{{$A->komponen}}</td>
                                            @endif
                                            <td>{{$A->pos}}</td>

                                            @if($A->basic == 'Tidak')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->t_pembilang,0,'','.')}}</td>
                                            @endif

                                            @if($A->basic == 'Tidak')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->t_penyebut,0,'','.')}}</td>
                                            @endif

                                            @if($A->basic == 'Tidak')
                                            <td></td>
                                            @else
                                            <td class="td1">{{($A->t_persen)}}</td>
                                            @endif

                                            @if($A->basic == 'Tidak')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->r_pembilang,0,'','.')}}</td>
                                            @endif

                                            @if($A->basic == 'Tidak')
                                            <td></td>
                                            @else
                                            <td class="td1">{{number_format($A->r_penyebut,0,'','.')}}</td>
                                            @endif

                                            @if($A->basic == 'Tidak')
                                            <td></td>
                                            @else
                                            <td class="td1">{{($A->r_persen)}}</td>
                                            @endif

                                            @if($A->basic == 'Tidak')
                                            <td></td>
                                            @else
                                            <td class="td1">{{($A->deviasi)}}</td>
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
                 window.location.href = '{{url("/0401R")}}'+'/'+$('[name="periode"]').val();
            }
            
        });
    });
</script>
@endsection
