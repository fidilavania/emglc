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
                                <table class="table table-hover" name="daftarnasabahtable">
                                    <thead>
                                        <th>No Nasabah</th>
                                        <th>Nama</th>
                                        <th>NPP</th>
                                        <th>Tanggal Mulai</th>
                                        <th>Tanggal Akhir</th>
                                        <th>Pokok Pinjaman</th>
                                        <th>Saldo Piutang</th>
                                    </thead>
                                    <div class="form-inline padding-bottom-15">
                                        <div class="row">
                                            <div class="col-sm-12 text-center">
                                                <div class="form-group">
                                                    <select id="searchcolumn" class="form-control">
                                                      <option value="nama">Nama</option>
                                                      <option value="no_ref">NPP</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input id="searchkey" type="text" data-fungsi="{{url('/kredit/nasabah/cari')}}" placeholder="Search" class="form-control"autocomplete="off">
                                                </div>
                                                <a href="{{url('/dafnasabah')}}" id="clear-filter" title="clear filter">[clear]</a>
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                    <tbody>
                                        @foreach($nsblist as $nsb)
                                            <tr>
                                                <td data-id="{{$nsb->no_kredit}}" data-sistem="{{trim($nsb->sistem)}}">{{$nsb->no_nsb}}</td>
                                                <td>{{$nsb->nama}}</td>
                                                <td>{{$nsb->no_ref}}</td>
                                                <td>{{date('d-m-Y',strtotime($nsb->tgl_mulai))}}</td>
                                                <td>{{date('d-m-Y',strtotime($nsb->tgl_akhir))}}</td>
                                                <td>{{number_format($nsb->pinj_pokok,0,'','.')}}</td>
                                                <td>{{number_format($nsb->saldo_piutang,0,'','.')}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="page">
                                    <nav class="paging"> 
                                        {{$pagination->links()}}
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
        $('[name="daftarnasabahtable"] tbody tr').click(function() {
            //alert($(this).find('td:first').attr('data-id'));
            //window.location = '{{url("/kredit/angsuran/bayar")}}'+'/'+$(this).find('td:first').attr('data-id');
            if($(this).find('td:first').attr('data-sistem') == 'RK'){
                window.open('{{url("/kredit/daftarnasabah/rekkorantrans")}}'+'/'+$(this).find('td:first').attr('data-id'));
            } else {
                window.open('{{url("/simulasiangsuran")}}'+'/'+$(this).find('td:first').attr('data-id'));
            }
        });
        /*$('#clear-filter').click(function (e) {
            window.location = '{{url("/kredit/daftarnasabah/angsur")}};
        });*/
        $("#searchkey").on('keyup',function(e){
            //Search saat tekan Enter
              if(e.keyCode==13){
                /*var link = $(this).attr('data-fungsi');

              $.ajaxSetup({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  }
              });

              $.ajax({
                url:link,
                type:"POST",
                dataType:"JSON",
                data: {'searchkey' : $("#searchkey").val(),
                       'searchcolumn' : $("#searchcolumn").val()},
                success: function(response){
                        console.log(response.nsblist);
                        console.log(response.pagination);
                        $('[name="daftarnasabahtable"] tbody').empty();
                        for(var x=0;x<response.nsblist.length;x++){
                            var tglmulai = response.nsblist[x].tgl_mulai.split('-');
                            var tglakhir = response.nsblist[x].tgl_akhir.split('-');
                            var content = '<tr>'+
                                            '<td>'+response.nsblist[x].no_mohon+'</td>'+
                                            '<td>'+response.nsblist[x].nama+'</td>'+
                                            '<td>'+response.nsblist[x].no_ref+'</td>'+
                                            '<td>'+tglmulai[2]+'-'+tglmulai[1]+'-'+tglmulai[0]+'</td>'+
                                            '<td>'+tglakhir[2]+'-'+tglakhir[1]+'-'+tglakhir[0]+'</td>'+
                                            '<td>'+number_format(response.nsblist[x].pinj_pokok,0,"",".")+'</td>'+
                                            '<td>'+number_format(response.nsblist[x].saldo_piutang,0,"",".")+'</td>'+
                                        '</tr>';
                            $('[name="daftarnasabahtable"] tbody').append(content);
                        }
                        $('.paging').empty();
                        $('.paging').append(response.pagination);
                        //paginate(response.pagination,response.url);
                  },
                error: function(data){
                  alert('Tidak ditemukan');
                }
                });*/
                if($("#searchkey").val() != ""){
                    if($("#searchcolumn").val() == 'no_ref'){
                        var searchword = $("#searchkey").val().replace('/', '\/');
                    } else {
                        var searchword = $("#searchkey").val();
                    }
                    window.location = '{{url("/dafnasabah")}}'+'/'+$("#searchcolumn").val()+'/'+searchword;
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
