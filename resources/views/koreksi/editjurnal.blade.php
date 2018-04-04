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
                      <form class="form-horizontal" id="editjurnalform" role="form" method="POST" action="{{ url('/editjurnalsave/'.$jurhead->nobukti) }}" >
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
                                      <input type="text" class="form-control" name="input_tanggal" value="{{date('d-m-Y',strtotime($jurhead->tanggal))}}" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-2 control-label">Keterangan Jurnal</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="input_keterangan" autocomplete="off" value="{{$jurhead->keterangan}}" />
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
                                    @foreach($jurdetdebet as $j)
                                        <div class="row form-group">
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="input_noperk_debet[]" autocomplete="off" value="{{$j->noperk}}" />
                                            </div>
                                            <div class="col-sm-6">
                                                <!-- <input type="text" class="form-control" name="input_nameshort_debet" autocomplete="off" value="{{$j->nameshort}}" /> -->
                                                <select class="form-control" name="input_nameshort_debet[]">
                                                    @foreach($perk as $p)
                                                        @if(trim($j->noperk) == trim($p->noperk))
                                                            <option value="{{$p->noperk}}" selected="selected">{{$p->nameshort}}</option>
                                                        @else
                                                            <option value="{{$p->noperk}}">{{$p->nameshort}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type="text" class="form-control" name="input_jml_debet[]" autocomplete="off" value="{{number_format($j->jmldebet,0,'','.')}}" />
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="button" value="Hapus" class="btn btn-warning pull-right" name="hapusJurnalDebet" />
                                            </div>
                                        </div>
                                    @endforeach
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
                                    @foreach($jurdetkredit as $j)
                                        <div class="row form-group">
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="input_noperk_kredit[]" autocomplete="off" value="{{$j->noperk}}" />
                                            </div>
                                            <div class="col-sm-6">
                                                <!-- <input type="text" class="form-control" name="input_nameshort_kredit" autocomplete="off" value="{{$j->nameshort}}" /> -->
                                                <select class="form-control" name="input_nameshort_kredit[]">
                                                    @foreach($perk as $p)
                                                        @if(trim($j->noperk) == trim($p->noperk))
                                                            <option value="{{$p->noperk}}" selected="selected">{{$p->nameshort}}</option>
                                                        @else
                                                            <option value="{{$p->noperk}}">{{$p->nameshort}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type="text" class="form-control" name="input_jml_kredit[]" autocomplete="off" value="{{number_format($j->jmlkredit,0,'','.')}}" />
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <input type="button" value="Hapus" class="btn btn-warning pull-right" name="hapusJurnalKredit" />
                                            </div>
                                        </div>
                                    @endforeach
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

            $('#editjurnalform').submit(function(e){
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
                    if(confirm('Apakah anda yakin akan mengedit jurnal ?')){
                        return true;
                    } else {
                        return false;
                    }
                }
            });
        });
        
    });
</script>
@endsection
s