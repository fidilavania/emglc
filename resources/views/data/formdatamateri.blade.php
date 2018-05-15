@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="panelbank">
                <div class="panel-heading"><h4 align="center">DAFTAR MATERI</h4></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered" name="daftarnasabahtable">
                                    <thead>
                                        <th>Kode Materi</th>
                                        <th>Nama Modul</th>
                                        <th>Silabus</th>
                                        <th>Peserta</th>
                                        <th>Fasilitator</th>
                                        <th>Durasi</th>
                                        <th>Biaya Investasi</th>
                                        <th colspan="3"></th>
                                    </thead>
                                    <div class="form-inline padding-bottom-15">
                                        <div class="row">
                                            <div class="col-sm-12 text-center">     
                                                <div class="form-group">
                                                    <input id="cif" type="text"  placeholder="Cari Kode Materi" class="form-control" autocomplete="off" style="text-transform:uppercase">
                                                    <input id="nama" type="text"  placeholder="Cari Nama Modul" class="form-control" autocomplete="off" style="text-transform:uppercase">
                                                </div>                                        
                                                <a href="{{ url('/datamateri') }}" id="clear-filter" title="clear filter">[KEMBALI]</a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <tbody>
                                        @foreach($nsblist as $nsb)
                                            <tr class="accordion-toggle" data-toggle="collapse" data-target="#{{$nsb->kode_modul}}">
                                                <td data-id="{{$nsb->kode_modul}}">{{$nsb->kode_modul}}</td>
                                                <td>{{$nsb->nama_modul}}</td>
                                                <?php
                                                echo '<td>'.nl2br($nsb->silabus).'</td>';
                                                echo '<td>'.nl2br($nsb->peserta).'</td>';
                                                ?>
                                                <td>{{$nsb->fasilitator}}</td>
                                                <td>{{$nsb->durasi}}</td>
                                                <td>{{number_format($nsb->biaya,0,'','.')}}</td>
                                                <td><input type="button" class="btn btn-danger" name="tambah" value="Edit" /></td>
                                                <td><input type="button" class="btn btn-primary" name="tambahbutton" value="Detail" /></td>
                                                <!-- <td><input type="button" class="btn btn-primary" name="view" value="Peserta" /></td> -->
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
                                            <a href="{{ url('/addmateri') }}" id="clear-filter" title="Input Materi Baru">[Masukkan Materi Baru]</a>
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

        // $('#summernote').summernote({
        //     toolbar:[

        //       // This is a Custom Button in a new Toolbar Area
        //       ['custom', ['examplePlugin']],

        //       // You can also add Interaction to an existing Toolbar Area
        //       ['style', ['style' ,'examplePlugin']]
        //     ]
        // });
        $('[name="tambah"]').click(function() {
            console.log($(this).parent().parent().find('td:nth-child(2)').text());
            console.log($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Edit');
            if($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Edit'){
                window.location.href = '{{url("/editmateri")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
            } else {
                window.location.href ='{{url("/editmateri")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
            }
        });

        $('[name="tambahbutton"]').click(function() {
            console.log($(this).parent().parent().find('td:nth-child(2)').text());
            console.log($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Detail');
            if($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Detail'){
                window.location.href = '{{url("/daftar")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
            } else {
                window.location.href ='{{url("/daftar")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
            }
        });

        $('[name="view"]').click(function() {
            console.log($(this).parent().parent().find('td:nth-child(2)').text());
            console.log($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Peserta');
            if($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Peserta'){
                window.location.href = '{{url("/detaildaftar")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
            } else {
                window.location.href ='{{url("/detaildaftar")}}'+'/'+$(this).parent().parent().find('td:first').attr('data-id');
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
                    window.location = '{{url("/datamateri")}}'+'/'+searchword;
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
                    window.location = '{{url("/datamateri")}}'+'/'+searchword;
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
                    window.location = '{{url("/datamateri")}}'+'/'+searchword;
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
                    window.location = '{{url("/datamateri")}}'+'/'+searchword;
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
