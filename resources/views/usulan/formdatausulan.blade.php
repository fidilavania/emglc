@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="panelbank">
                <div class="panel-heading"><h4 align="center">DAFTAR USULAN / SARAN</h4></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered" name="daftarnasabahtable">
                                    <thead>
                                        <th>Nama</th>
                                        <th>Kantor</th>
                                        <th>Usulan</th>
                                        <th>Tanggal_Input</th>
                                    </thead>
                                    <div class="form-inline padding-bottom-15">
                                        <div class="row">
                                            <div class="col-sm-12 text-center">     
                                                <div class="form-group">
                                                    <input id="kantor" type="text"  placeholder="Cari Kantor" class="form-control" autocomplete="off" style="text-transform:uppercase">
                                                    <input id="nama" type="text"  placeholder="Cari Nama" class="form-control" autocomplete="off" style="text-transform:uppercase">
                                                </div>                                        
                                                <a href="{{ url('/usullihat') }}" id="clear-filter" title="clear filter">[KEMBALI]</a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <tbody>
                                        @foreach($lihatusulan as $nsb)
                                        @if( trim($nsb->kantor,' ') == trim(Auth::user()->kantor,' ') && trim(Auth::user()->kantor,' ') != 'EMG' )  
                                            <tr class="accordion-toggle" data-toggle="collapse" data-target="#{{$nsb->nama}}">
                                                <td data-id="{{$nsb->nama}}">{{$nsb->nama}}</td>
                                                <td>{{$nsb->kantor}}</td>
                                                <?php
                                                echo '<td>'.nl2br($nsb->usulan).'</td>';
                                                ?>
                                                <td>{{date('d-m-Y',strtotime($nsb->tanggal))}}</td></td>
                                                <!-- <td><input type="button" class="btn btn-primary" name="view" value="Peserta" /></td> -->
                                            </tr>
                                        @endif
                                        @endforeach

                                        @foreach($lihatusulan as $nsb)
                                        @if( trim(Auth::user()->kantor,' ') == 'EMG')
                                            <tr class="accordion-toggle" data-toggle="collapse" data-target="#{{$nsb->nama}}">
                                                <td data-id="{{$nsb->nama}}">{{$nsb->nama}}</td>
                                                <td>{{$nsb->kantor}}</td>
                                                <?php
                                                echo '<td>'.nl2br($nsb->usulan).'</td>';
                                                ?>
                                                <td>{{date('d-m-Y',strtotime($nsb->tanggal))}}</td></td>
                                                <!-- <td><input type="button" class="btn btn-primary" name="view" value="Peserta" /></td> -->
                                            </tr>
                                        @endif
                                        @endforeach

                                    </tbody>
                                </table>
                                <div class="page">
                                    <nav class="paging"> 
                                        {{$lihatusulan->links()}}
                                    </nav>
                                </div>
                                @if(count($lihatusulan) == 0)
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="{{ url('/usul') }}" id="clear-filter" title="Input Usulan">[Masukkan Usulan]</a>
                                        </div>
                                    </div>
                                @endif
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

        
        $('[name="inputrkbutton"]').click(function() {
            window.open('{{url("/kreditrk/formkredit")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id'));
        });
 
        $("#nama").on('keyup',function(e){
            //Search saat tekan Enter
              if(e.keyCode==13){
                if($("#nama").val() != ""){
                    var searchword = $("#nama").val().replace('/', '\/');
                    window.location = '{{url("/usullihat")}}'+'/'+searchword;
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
                    window.location = '{{url("/usullihat")}}'+'/'+searchword;
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
