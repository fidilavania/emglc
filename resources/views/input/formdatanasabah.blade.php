@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="panelbank">
                <div class="panel-heading"><h4 align="center">DAFTAR NASABAH</h4></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered" name="daftarnasabahtable">
                                    <thead>
                                        <th>No Nasabah</th>
                                        <th>No CIF</th>
                                        <th>Nama</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Nama Ibu Kandung</th>
                                        <th>Tempat, Tanggal Lahir</th>
                                        <th>Alamat</th>
                                        <th>NPWP</th>
                                        <th></th>
                                    </thead>
                                    <div class="form-inline padding-bottom-15">
                                        <div class="row">
                                            <div class="col-sm-12 text-center">     
                                                <div class="form-group">
                                                    <input id="cif" type="text"  placeholder="Cari Nomor CIF" class="form-control" autocomplete="off" style="text-transform:uppercase">
                                                    <input id="nama" type="text"  placeholder="Cari Nama Nasabah" class="form-control" autocomplete="off" style="text-transform:uppercase">
                                                    <input id="ibu" type="text"  placeholder="Cari Nama Ibu " class="form-control" autocomplete="off" style="text-transform:uppercase">
                                                    <input id="alamat" type="text"  placeholder="Cari Alamat" class="form-control" autocomplete="off" style="text-transform:uppercase">
                                                </div>                                        
                                                <a href="{{ url('/lihatdata') }}" id="clear-filter" title="clear filter">[KEMBALI]</a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <tbody>
                                        @foreach($nsblist as $nsb)
                                        @if($nsb->kondisi != 'NON  ')
                                            <tr class="accordion-toggle" data-toggle="collapse" data-target="#{{$nsb->no_nsb}}">
                                                <td data-id="{{$nsb->no_nsb}}">{{$nsb->no_nsb}}</td>
                                                <td>{{$nsb->no_cif}}</td>
                                                <td>{{$nsb->nama}}</td>
                                                <td>{{$nsb->kelamin}}</td>
                                                <td>{{$nsb->namaibu}}</td>
                                                <td>{{$nsb->tmplahir}}, {{date('d-m-Y',strtotime($nsb->tgllahir))}}</td>
                                                <td>{{$nsb->alamat}}</td>
                                                <td>{{$nsb->npwp}}</td>
                                                @if(strpos(Auth::user()->fungsi, '2525') !== false)
                                                <td><input type="button" class="btn btn-danger" name="tambahbutton" value="Perbarui" /></td>
                                                @endif
                                        @endif
                                            </tr>
                                            <tr class="accordion-body collapse" id="{{$nsb->no_nsb}}">
                                              <td colspan="8">
                                                <table class="table table-bordered kredittable">
                                                  <thead>
                                                    <th>NPP</th>
                                                    <th>Sistem</th>
                                                    <th>Lama</th>
                                                    <th>Plafon</th>
                                                    <th>BBT</th>
                                                    <th>Baki Debet</th>
                                                    <th>Tanggal Mulai</th>
                                                    <th>Tanggal Lunas</th>
                                                    <th></th>
                                                    <th></th>
                                                  </thead>
                                                  <tbody>
                                                    @foreach($datakredit[$nsb->no_nsb] as $data)
                                                        <tr>
                                                            <td data-id="{{$data->no_kredit}}">{{$data->no_ref}}</td>
                                                            <td>{{$data->sistem}}</td>
                                                            <td>{{$data->lama}}</td>
                                                            <td>{{number_format($data->pinj_pokok,0,'','.')}}</td>
                                                            <td>{{number_format($data->bbt,0,'','.')}}</td>

                                                            @if($data->sistem != 'RK        ')
                                                            <td>{{number_format($data->bakidebet,0,'','.')}}</td>
                                                            @elseif($data->sistem == 'RK        ')
                                                            <td>{{number_format($rktran->saldo_piutang,0,'','.')}}</td>
                                                            @endif

                                                            <td>{{date('d-m-Y',strtotime($data->tgl_mulai))}}</td>

                                                            @if($data->tgl_lunas == '1970-01-01 00:00:00')
                                                            <td>-</td>
                                                            @elseif($data->tgl_lunas == '1970-01-01')
                                                            <td>-</td>
                                                            @elseif($data->tgl_lunas == '1900-01-01 00:00:00')
                                                            <td>-</td>
                                                            @elseif($data->tgl_lunas == '')
                                                            <td>-</td>
                                                            @else
                                                            <td>{{date('d-m-Y',strtotime($data->tgl_lunas))}}
                                                            </td>
                                                            @endif

                                                            @if(strpos(Auth::user()->fungsi, '1111') !== false)
                                                            <td><input type="button" class="btn btn-primary" name="detkreditbutton" value="Detail" /></td>
                                                            @endif
                                                            @if(strpos(Auth::user()->fungsi, '3333') !== false)
                                                            <td><input type="button" class="btn btn-primary" name="Simulasi" value="Simulasi" /></td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                                  </tbody>
                                                </table>
                                              </td> 
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
                                            <a href="{{ url('/addnasabah') }}" id="clear-filter" title="Input Nasabah Baru">[Masukkan Nasabah Baru]</a>
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

        <?php
            //if(strpos(Auth::user()->fungsi, '1050') !== false){
        ?>
        $('[name="Simulasi"]').click(function() {
            console.log($(this).parent().parent().find('td:nth-child(2)').text());
            console.log($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Simulasi');
            if($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Simulasi'){
                window.open('{{url("/angsuran")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id'));
            } else {
                window.open('{{url("/angsuran")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id'));
            }
        });
        $('[name="detkreditbutton"]').click(function() {
            console.log($(this).parent().parent().find('td:nth-child(2)').text());
            console.log($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Detail');
            if($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Detail'){
                window.open('{{url("/viewkredit")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id'));
            } else {
                window.open('{{url("/viewkredit")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id'));
            }
        });
        $('[name="tambahbutton"]').click(function() {
            console.log($(this).parent().parent().find('td:nth-child(2)').text());
            console.log($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Detail');
            if($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Detail'){
                window.open('{{url("/nasabahbaru")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id'));
            } else {
                window.open('{{url("/nasabahbaru")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id'));
            }
        });

        
        <?php
            //}
        ?>
        <?php
            //if(strpos(Auth::user()->fungsi, '1002') !== false){
        ?>
        $('[name="inputrkbutton"]').click(function() {
            window.open('{{url("/kreditrk/formkredit")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id'));
        });
        <?php
            //}
        ?>
        
        $("#nama").on('keyup',function(e){
            //Search saat tekan Enter
              if(e.keyCode==13){
                if($("#nama").val() != ""){
                    var searchword = $("#nama").val().replace('/', '\/');
                    window.location = '{{url("/lihatdata")}}'+'/'+searchword;
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
                    window.location = '{{url("/lihatdata")}}'+'/'+searchword;
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
                    window.location = '{{url("/lihatdata")}}'+'/'+searchword;
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
                    window.location = '{{url("/lihatdata")}}'+'/'+searchword;
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
