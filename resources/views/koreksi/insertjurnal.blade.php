@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="paneljurnal">
                <div class="panel-heading">
                    <h4 align="center">Laporan Jurnal</h4>
                </div>
                    <div class="panel-body">
                      <form class="form-horizontal" id="insertjurnalform" role="form" method="POST" action="{{ url('/tambahjurnalsave/') }}" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="input_tanggaldari" value="{{ date('d-m-Y',strtotime($tanggaldari)) }}" />
                        <input type="hidden" name="input_tanggalsampai" value="{{ date('d-m-Y',strtotime($tanggalsampai)) }}" />
                        <input type="hidden" name="input_kantor" value="{{ $namakantor }}" />
                        <div class="row">
                            <div class="col-sm-12 alert alert-danger" name="errorpanel" hidden>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">Tanggal Jurnal</label>
                                    <div class="col-sm-10">
                                        <div class="input-group date">
                                            <input type="text" id="inputTanggalJurnal" name="input_tanggal_jurnal" class="form-control" value="{{date('d-m-Y')}}" readonly>
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">Kantor</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="input_namakantor">
                                            <option value >Pilih Kantor</option>
                                                @foreach($kantor as $k)
                                                    <option value="{{strtoupper($k->kodejurnal)}}">{{$k->kota}}</option>
                                                @endforeach  
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">Keterangan Jurnal</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="input_keterangan" autocomplete="off" value="" />
                                    </div>
                                </div>
                                <hr />
                                <div class="row form-group">
                                    <label class="col-sm-12">Jurnal Debet</label>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-12">
                                        <input type="button" class="btn btn-primary" value="Tambah Jurnal Debet" id="addDebet" />
                                    </div>
                                </div>
                                <div class="JurnalDebet">
                                    
                                </div>
                                <hr />
                                <div class="row form-group">
                                    <label class="col-sm-12">Jurnal Kredit</label>
                                </div>
                                <div class="row form-group">
                                    <div class="col-sm-12">
                                        <input type="button" class="btn btn-primary" value="Tambah Jurnal Kredit" id="addKredit" />
                                    </div>
                                </div>
                                <div class="JurnalKredit">
                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-1">
                                        <input type="submit" class="btn btn-primary" name="submbutton" value="SIMPAN" />
                                    </div>
                                </div>
                            </div>
                        </div>
                      </form>
                    </div>
            </div>
        </div>
    </div>
</div>
<div id="jurnalDebet" data-op ="jurnalDebet" hidden>
    <div class="row form-group">
        <div class="col-sm-2">
            <input type="text" class="form-control" name="input_noperk_debet[]" autocomplete="off" value="" />
        </div>
        <div class="col-sm-6">
            <select class="form-control" name="input_nameshort_debet[]">
                <option value >Pilih Perkiraan Debet</option>
                @foreach($perk as $p)
                    <option value="{{$p->noperk}}">{{$p->nameshort}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <div class="input-group">
                <span class="input-group-addon">Rp.</span>
                <input type="text" class="form-control" name="input_jml_debet[]" autocomplete="off" value="" />
            </div>
        </div>
        <div class="col-sm-1">
            <input type="button" value="Hapus" class="btn btn-warning pull-right" name="hapusJurnalDebet" />
        </div>
    </div>
</div>
<div id="jurnalKredit" data-op ="jurnalKredit" hidden>
    <div class="row form-group">
        <div class="col-sm-2">
            <input type="text" class="form-control" name="input_noperk_kredit[]" autocomplete="off" value="" />
        </div>
        <div class="col-sm-6">
            <select class="form-control" name="input_nameshort_kredit[]">
                <option value >Pilih Perkiraan Kredit</option>
                @foreach($perk as $p)
                    <option value="{{$p->noperk}}">{{$p->nameshort}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-sm-3">
            <div class="input-group">
                <span class="input-group-addon">Rp.</span>
                <input type="text" class="form-control" name="input_jml_kredit[]" autocomplete="off" value="" />
            </div>
        </div>
        <div class="col-sm-1">
            <input type="button" value="Hapus" class="btn btn-warning pull-right" name="hapusJurnalKredit" />
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('[name="input_jml_debet[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="input_jml_kredit[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="input_nameshort_debet[]"]').select2({ width: '100%' });
        $('[name="input_nameshort_kredit[]"]').select2({ width: '100%' });
        $('[name="input_nameshort_debet[]"]').change(function(){
            // console.log('masuk');
            // console.log($(this).parent().parent());
            // console.log($(this).parent().parent().parent().find('input[name="input_noperk_debet[]"]').val());
            $(this).parent().parent().find('[name="input_noperk_debet[]"]').val($(this).val());
        });
        $('[name="input_nameshort_kredit[]"]').change(function(){
            $(this).parent().parent().find('[name="input_noperk_kredit[]"]').val($(this).val());
        });
        
        $('#addDebet').click(function(){
            $('[name="input_nameshort_debet[]"]').select2('destroy');
            var $template = $('#jurnalDebet'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                //.attr('id','tanahBangunanForm'+$('[data-jaminan="tanahBangunan"]').length)
                                //.attr('id','tanahBangunanForm'+INC_OP)
                                //.insertBefore($template);
                                .appendTo('.JurnalDebet');
            $('[name="input_jml_debet[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nameshort_debet[]"]').select2({ width: '100%' });
            $('[name="hapusJurnalDebet"]').on('click',function(){
                $(this).parent().parent().parent().remove();
            });
            $('[name="input_nameshort_debet[]"]').change(function(){
                $(this).parent().parent().find('[name="input_noperk_debet[]"]').val($(this).val());
            });
        });

        $('#addKredit').click(function(){
            $('[name="input_nameshort_kredit[]"]').select2('destroy');
            var $template = $('#jurnalKredit'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                //.attr('id','tanahBangunanForm'+$('[data-jaminan="tanahBangunan"]').length)
                                //.attr('id','tanahBangunanForm'+INC_OP)
                                //.insertBefore($template);
                                .appendTo('.JurnalKredit');
            $('[name="input_jml_kredit[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nameshort_kredit[]"]').select2({ width: '100%' });
            $('[name="hapusJurnalKredit"]').on('click',function(){
                $(this).parent().parent().parent().remove();
            });
            $('[name="input_nameshort_kredit[]"]').change(function(){
                $(this).parent().parent().find('[name="input_noperk_kredit[]"]').val($(this).val());
            });
        });
        $('#insertjurnalform').submit(function(e){
            $('[name="errorpanel"]').empty();
            var content = '<ul>';
            if($('[name="input_namakantor"]').val() === ''){
                content += '<li>Kantor harus dipilih</li>';
            }
            var jmldebet = 0;
            var jmlkredit = 0;
            $(this).find('[name="input_jml_debet[]"]').each( function( i , e ) {
                var v = parseFloat($( e ).val().split('.').join(''));
                if ( !isNaN( v ) )
                    jmldebet += v;
            } );
            $(this).find('[name="input_jml_kredit[]"]').each( function( i , e ) {
                var v = parseFloat($( e ).val().split('.').join(''));
                if ( !isNaN( v ) )
                    jmlkredit += v;
            } );
            if(jmldebet !== jmlkredit){
                content += '<li>Jumlah debet dan kredit tidak sama</li>';
            }
            content += '</ul>';

            if(content != '<ul></ul>'){
                $('[name="errorpanel"]').append(content).show();
                return false;
            } else {
                if(confirm('Apakah anda yakin akan menambah jurnal ?')){
                    return true;
                } else {
                    return false;
                }
            }
        });
    });
</script>
@endsection