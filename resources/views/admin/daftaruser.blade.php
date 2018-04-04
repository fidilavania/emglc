@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="panelbank">
                <div class="panel-heading"><h4 align="center">DAFTAR USER</h4></div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-hover" name="daftarusertable">
                                    <thead>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>username</th>
                                        <th>Kantor</th>
                                        <th>Jabatan</th>
                                        <th>Status</th>
                                    </thead>
                                    <div class="form-inline padding-bottom-15">
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <div class="form-group">
                                                    <select id="searchcolumn" class="form-control">
                                                      <option value="nama_lengkap">Nama Lengkap</option>
                                                      <option value="nama">Kantor</option>
                                                      <option value="jabatankantor">Jabatan</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input id="searchkey" type="text" placeholder="Search" class="form-control"autocomplete="off">
                                                </div>
                                                <a href="{{url('/lihatuser')}}" id="clear-filter" title="clear filter">[clear]</a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <tbody>
                                         @foreach($user as $u)
                                            <tr>
                                                <td data-id="{{$u->id}}">{{$u->id}}</td>
                                                <td>{{$u->nama_lengkap}}</td>
                                                <td>{{$u->username}}</td>
                                                <td>{{$u->nama}}</td>
                                                <td>{{$u->jabatankantor}}</td>
                                                @if($u->status == 0)
                                                    <td><span class="label label-table label-danger">Tidak Aktif</span></td>
                                                @elseif($u->status == 1)
                                                    <td><span class="label label-table label-success">Aktif</span></td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                
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
       
        $("#searchkey").on('keyup',function(e){
            //Search saat tekan Enter
              if(e.keyCode==13){
                if($("#searchkey").val() != ""){
                    if($("#searchcolumn").val() == 'no_ref'){
                        var searchword = $("#searchkey").val().replace('/', '\/');
                    } else {
                        var searchword = $("#searchkey").val();
                    }
                    window.location = '{{url("/lihatuser")}}'+'/'+$("#searchcolumn").val()+'/'+searchword;
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
