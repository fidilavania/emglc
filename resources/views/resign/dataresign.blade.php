@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="panelbank">
                <div class="panel-heading"><h4 align="center">DAFTAR RESIGN</h4></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered" name="daftarnasabahtable">
                                    <thead>
                                        <th>No SDM</th>
                                        <th>Kantor</th>
                                        <th>Nama</th>
                                        <th>Alasan</th>
                                        <th>Tanggal Keluar</th>
                                    </thead>
                                    <div class="form-inline padding-bottom-15">
                                       
                                        <div class="row">
                                            <div class="col-sm-12 text-center">     
                                                <div class="form-group">
                                                    <input id="nama" type="text"  placeholder="Cari Nama Nasabah" class="form-control" autocomplete="off" style="text-transform:uppercase">
                                                    <input id="kantor" type="text"  placeholder="Cari Kantor" class="form-control" autocomplete="off" style="text-transform:uppercase">
                                                </div>                                        
                                                <a href="{{ url('/dataresign') }}" id="clear-filter" title="clear filter">[KEMBALI]</a>
                                            </div>
                                        </div>
                                        <br>
                                    </div>
                                    <hr />
                                    <tbody>
                                        @foreach($lihatresign as $nsb)
                                        @if( trim($nsb->kantor,' ') == trim(Auth::user()->kantor,' ') && trim(Auth::user()->kantor,' ') != 'EMG')  
                                            <tr class="accordion-toggle" data-toggle="collapse" data-target="#{{$nsb->no_sdm}}">
                                                <td data-id="{{$nsb->no_sdm}}">{{$nsb->no_sdm}}</td>
                                                <td>{{$nsb->kantor}}</td>
                                                <td>{{$nsb->nama}}</td>
                                                <td>{{$nsb->alasan}}</td>
                                                <td>{{date('d-m-Y',strtotime($nsb->tanggal))}}</td>
                                            </tr>
                                        @endif
                                        @endforeach

                                        @foreach($lihatresign as $nsb)
                                        @if( trim(Auth::user()->kantor,' ') == 'EMG')
                                            <tr class="accordion-toggle" data-toggle="collapse" data-target="#{{$nsb->no_sdm}}">
                                                <td data-id="{{$nsb->no_sdm}}">{{$nsb->no_sdm}}</td>
                                                <td>{{$nsb->kantor}}</td>
                                                <td>{{$nsb->nama}}</td>
                                                <td>{{$nsb->alasan}}</td>
                                                <td>{{date('d-m-Y',strtotime($nsb->tanggal))}}</td>
                                            </tr>
                                        @endif
                                        @endforeach
                                    
                                    </tbody>
                                </table>
                                <div class="page">
                                    <nav class="paging"> 
                                        {{$lihatresign->links()}}
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    function isNumber(n) {
      return !isNaN(parseFloat(n)) && isFinite(n);
    }
    $(document).ready(function() {
     
        $("#nama").on('keyup',function(e){
            //Search saat tekan Enter
              if(e.keyCode==13){
                if($("#nama").val() != ""){
                    var searchword = $("#nama").val().replace('/', '\/');
                    window.location = '{{url("/dataresign")}}'+'/'+searchword;
                } else {
                    return false;
                }
              }
              else {
                e.preventDefault();
              }
          });
     
        $("#kantor").on('keyup',function(e){
            //Search saat tekan Enter
              if(e.keyCode==13){
                if($("#kantor").val() != ""){
                    var searchword = $("#kantor").val().replace('/', '\/');
                    window.location = '{{url("/dataresign")}}'+'/'+searchword;
                } else {
                    return false;
                }
              }
              else {
                e.preventDefault();
              }
          });     
    });
</script>
@endsection
