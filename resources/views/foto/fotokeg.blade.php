@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="panelbank">
                <div class="panel-heading"><h4 align="center">FOTO KEGIATAN</h4></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered" name="daftarnasabahtable">
                                    <thead>
                                        <th>No</th>
                                        <th>Kegiatan</th>
                                        @if(strpos(Auth::user()->kantor, 'EMG') !== false)
                                        <th>Foto</th>
                                        @endif
                                        <th colspan="3"></th>
                                    </thead>
                                    <div class="form-inline padding-bottom-15">
                                        <div class="row">
                                            <div class="col-sm-12 text-center">     
                                                <div class="form-group">
                                                    <input id="kegiatan" type="text"  placeholder="Cari Kegiatan" class="form-control" autocomplete="off" style="text-transform:uppercase">
                                                </div>                                        
                                                <a href="{{ url('/fotokeg') }}" id="clear-filter" title="clear filter">[KEMBALI]</a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <tbody>
                                        @foreach($nsblist as $nsb)
                                            <tr class="accordion-toggle" data-toggle="collapse" data-target="#{{$nsb->id}}">
                                                <td align="center">{{$nsb->id}}</td>
                                                <td>{{$nsb->kegiatan}}</td>
                                                @if(strpos(Auth::user()->kantor, 'EMG') !== false)
                                                <td>{{$nsb->foto}}</td>
                                                @endif
                                                @if($nsb->foto != '')
                                                <td><a href="{{$nsb->foto}}" id="clear-filter" >
                                                    <input type="button" class="btn btn-success" name="foto" value="DOWNLOAD FOTO">
                                                </a></td>
                                                @else
                                                <td><a><input type="button" class="btn btn-danger" name="foto" value="DOWNLOAD FOTO">
                                                </a></td>
                                                @endif
                                            </tr>
                                         @endforeach
                                    
                                    </tbody>
                                </table>
                                <div class="page">
                                    <nav class="paging"> 
                                        {{$nsblist->links()}}
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

        
        $("#kegiatan").on('keyup',function(e){
            //Search saat tekan Enter
              if(e.keyCode==13){
                if($("#kegiatan").val() != ""){
                    var searchword = $("#kegiatan").val().replace('/', '\/');
                    window.location = '{{url("/fotokeg")}}'+'/'+searchword;
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
