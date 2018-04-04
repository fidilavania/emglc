@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="panelbank">
                <div class="panel-heading"><h4 align="center">DAFTAR SDM</h4></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered" name="daftarnasabahtable">
                                    <thead>
                                        <th>No SDM</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th>Jabatan</th>
                                        <th>No HP</th>
                                        <th>No Telpon</th>
                                        <th>Tanggal Mulai Bekerja</th>
                                        <th></th>
                                    </thead>
                                    <div class="form-inline padding-bottom-15">
                                        <div class="row">
                                            <div class="col-sm-12 text-center">     
                                                <div class="form-group">
                                                    <input id="cif" type="text"  placeholder="Cari Nomor SDM" class="form-control" autocomplete="off" style="text-transform:uppercase">
                                                    <input id="nama" type="text"  placeholder="Cari Nama Nasabah" class="form-control" autocomplete="off" style="text-transform:uppercase">
                                                    <input id="alamat" type="text"  placeholder="Cari Alamat" class="form-control" autocomplete="off" style="text-transform:uppercase">
                                                </div>                                        
                                                <a href="{{ url('/datasdm') }}" id="clear-filter" title="clear filter">[KEMBALI]</a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <tbody>
                                        @foreach($nsblist as $nsb)
                                        <!-- @if($nsb->kondisi != 'NON  ') -->
                                            <tr class="accordion-toggle" data-toggle="collapse" data-target="#{{$nsb->no_sdm}}">
                                                <td data-id="{{$nsb->no_sdm}}">{{$nsb->no_sdm}}</td>
                                                <td>{{$nsb->nama}}</td>
                                                <td>{{$nsb->jenis_kel}}</td>
                                                <td>{{$nsb->tempat_lahir}}, {{date('d-m-Y',strtotime($nsb->tgl_lahir))}}</td>
                                                <td>{{$nsb->alamat_tinggal}}</td>
                                                <td>{{$nsb->jabatan}}</td>
                                                <td>{{$nsb->nohp}}</td>
                                                <td>{{$nsb->notlp}}</td>
                                                <td>{{date('d-m-Y',strtotime($nsb->tgl_kerja))}}</td>
                                                <!-- @if(strpos(Auth::user()->fungsi, '2525') !== false) -->
                                                <td><input type="button" class="btn btn-danger" name="tambahbutton" value="Edit" /></td>
                                                <!-- @endif -->
                                        <!-- @endif -->
                                            </tr>
                                         @endforeach
                                    
                                    </tbody>
                                </table>
                                <div class="page">
                                    <nav class="paging"> 
                                        {{$nsblist->links()}}
                                    </nav>
                                </div>
                                @if(count($nsblist) == 0)
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <a href="{{ url('/addsdm') }}" id="clear-filter" title="Input SDM Baru">[Masukkan SDM Baru]</a>
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
        $('[name="daftarnasabahtable"] tbody tr').click(function() {
            
        });

        $('[name="tambahbutton"]').click(function() {
            console.log($(this).parent().parent().find('td:nth-child(2)').text());
            console.log($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Edit');
            if($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Edit'){
                window.location.href = '{{url("/editsdm")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
            } else {
                window.location.href = '{{url("/editsdm")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
            }
        });

       
        $("#nama").on('keyup',function(e){
            //Search saat tekan Enter
              if(e.keyCode==13){
                if($("#nama").val() != ""){
                    var searchword = $("#nama").val().replace('/', '\/');
                    window.location = '{{url("/datasdm")}}'+'/'+searchword;
                } else {
                    return false;
                }
              }
              else {
                e.preventDefault();
              }
          });
        $("#ibu").on('keyup',function(e){
            //Search saat tekan Enter
              if(e.keyCode==13){
                if($("#ibu").val() != ""){
                    var searchword = $("#ibu").val().replace('/', '\/');
                    window.location = '{{url("/datasdm")}}'+'/'+searchword;
                } else {
                    return false;
                }
              }
              else {
                e.preventDefault();
              }
          });
        $("#alamat").on('keyup',function(e){
            //Search saat tekan Enter
              if(e.keyCode==13){
                if($("#alamat").val() != ""){
                    var searchword = $("#alamat").val().replace('/', '\/');
                    window.location = '{{url("/datasdm")}}'+'/'+searchword;
                } else {
                    return false;
                }
              }
              else {
                e.preventDefault();
              }
          });    
        $("#cif").on('keyup',function(e){
            //Search saat tekan Enter
              if(e.keyCode==13){
                if($("#cif").val() != ""){
                    var searchword = $("#cif").val().replace('/', '\/');
                    window.location = '{{url("/datasdm")}}'+'/'+searchword;
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
