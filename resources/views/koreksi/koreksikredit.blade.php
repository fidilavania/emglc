@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-danger" id="panelerror" hidden>
                <div class="panel-body">
                    <ul class="errormsg">
                    </ul>
                </div>
            </div>
            <form class="form-horizontal" id="simpankreditform" role="form" method="POST" action="{{ url('/savekorekkredit/$nokredit') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                    <div class="panel-heading"><h4 align="center">KOREKSI DATA KREDIT</h4></div>
                            <div class="panel-body">
                            <div class="col-sm-3">
                                <?php
                                    echo "<font color='#ff0000'>* wajib diisi</font><br>";
                                ?>
                            </div><br>
                                <div class="row">
                                    <div class="col-sm-12">  
                                        <div class="col-sm-6">
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Operator</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="opr" autocomplete="off" value="{{ trim(Auth::user()->nama_lengkap,' ') }}" style="text-transform:uppercase;" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nomor Nasabah</label> 
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="no_nsb" autocomplete="off" style="text-transform:uppercase;" value="{{$prekredit->no_nsb}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama Nasabah</label> 
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="nama" autocomplete="off" style="text-transform:uppercase;" value="{{$prekredit->nama}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">Nomor Kredit</label> 
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="no_kredit" autocomplete="off" style="text-transform:uppercase;" value="{{$kredit->no_kredit}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">KE</label> 
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="ke" autocomplete="off" style="text-transform:uppercase;" value="{{$kredit->ke}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">No Mohon</label> 
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="no_mohon" autocomplete="off" style="text-transform:uppercase;" value="{{$kredit->no_mohon}}" readonly />
                                                    </div>
                                                </div>
                                                 <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Nomor NPP</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="input_no_npp" autocomplete="off" style="text-transform:uppercase;" value="{{$kredit->no_ref}}" placeholder="Nomor NPP" maxlength="30" required readonly />
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-sm-6">
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Kode Sifat Kredit</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="input_sifatkrd" required>
                                                            <option replace>{{trim($kredit->sifatkrd,' ')}}</option>
                                                            <option value='1'>1 - Kredit yang di Restrukturisasi</option>
                                                            <option value='2'>2 - Pengambil alihan kredit</option>
                                                            <option value='3'>3 - Kredit sub Ordinasi</option>
                                                            <option value='9'>9 - Lainnya</option>
                                                        </select>
                                                    </div>                                   
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Takeover Dari</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='input_to_dari' readonly >
                                                            <option replace>{{trim($kredit->to,' ')}}</option>
                                                            @foreach($ljk as $g)
                                                                <option value='{{$g->kode}}'>{{$g->kode}} - {{$g->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">*Frekuensi Restrukturisasi</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="input_frekres" autocomplete="off" value="{{trim($kredit->frekres,' ')}}" style="text-transform:uppercase;" placeholder="frekuensi restrukturisasi" id="fr" id="pesanfr" readonly />
                                                    </div>
                                                </div>  
                                                <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">Tanggal Restrukturisasi Awal</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" name="input_tgl_resawal" id="tanggalresawal" placeholder ="{{date('d-m-Y')}}" value="{{date('d-m-Y',strtotime(trim($kredit->tgl_resawal,' ')))}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">Tanggal Restrukturisasi Akhir</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" name="input_tgl_resakhir"  id="tanggalresakhir" placeholder ="{{date('d-m-Y')}}" value="{{date('d-m-Y',strtotime(trim($kredit->tgl_resakhir,' ')))}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">Kode Cara Restrukturisasi</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="input_res" readonly >
                                                            <option replace>{{trim($kredit->res,' ' )}}</option>
                                                            @foreach($res as $c)
                                                                <option value='{{$c->kode}}'>{{$c->kode}} - {{$c->cara}}</option>
                                                            @endforeach
                                                        </select>                                       
                                                    </div>
                                                </div> 
                                        </div>                           
                                    </div>   
                                </div>
                            <div class="row submitbtn1">
                                <div class="col-sm-12">
                                    <button type="submit" id="simpandata" class="btn btn-primary" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">SIMPAN</button>
                                </div>
                            </div>
                        </div>

                </div>

        </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">

 $('[name="input_kas"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_piutang_usaha_al"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_investasi_lacar"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_aset_lancar_lain"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_aset_lancar"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_piutang_usaha_atl"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_invest_tdk_lancar"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_aset_tdk_lancar_lain"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_aset_tdk_lancar"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_piutang_usaha_atl"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_invest_tdk_lancar"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_aset_tdk_lancar_lain"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_aset_tdk_lancar"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_aset"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_utang_usaha_pndk"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_pinjaman_pndk"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_lia_pndk_lain"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_lia_pndk"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_utang_usaha_panjang"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_pinjaman_pnjng"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_lia_panjang_lain"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_lia_pnjng"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_lia"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_pendapatan_usaha"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_beban_pokok"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_labarugi"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_pendapatan_lain"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_beban_lain"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_labarugi_sblmPajak"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_labarugi_tahun"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 $('[name="input_ekuitas"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
 
 $("#tahunan").datepicker({ dateFormat: 'dd-mm-yy' });

 $('[name="input_kolek"]').on('change', function(){
                if ($(this).val() == "5") {
                   $(this).parent().parent().parent().find('[name="input_tgl_macet"]').removeAttr("readonly");
                    $(this).parent().parent().parent().find('[name="input_sebabmacet"]').removeAttr("readonly");
                } else if ($(this).val() != "5") {
                  $(this).parent().parent().parent().find('[name="input_tgl_macet"]').val();
                  $(this).parent().parent().parent().find('[name="input_tgl_macet"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="input_sebabmacet"]').val();
                  $(this).parent().parent().parent().find('[name="input_sebabmacet"]').attr("readonly","readonly");
                  }
                  // else if ($(this).val() == "2") {
                  // $(this).parent().parent().parent().find('[name="input_tgl_macet"]').val();
                  // $(this).parent().parent().parent().find('[name="input_tgl_macet"]').attr("readonly","readonly");
                  // $(this).parent().parent().parent().find('[name="input_sebabmacet"]').val();
                  // $(this).parent().parent().parent().find('[name="input_sebabmacet"]').attr("readonly","readonly");
                  // }
                  // else if ($(this).val() == "3") {
                  // $(this).parent().parent().parent().find('[name="input_tgl_macet"]').val();
                  // $(this).parent().parent().parent().find('[name="input_tgl_macet"]').attr("readonly","readonly");
                  // $(this).parent().parent().parent().find('[name="input_sebabmacet"]').val();
                  // $(this).parent().parent().parent().find('[name="input_sebabmacet"]').attr("readonly","readonly");
                  // }
                  // else if ($(this).val() == "4") {
                  // $(this).parent().parent().parent().find('[name="input_tgl_macet"]').val();
                  // $(this).parent().parent().parent().find('[name="input_tgl_macet"]').attr("readonly","readonly");
                  // $(this).parent().parent().parent().find('[name="input_sebabmacet"]').val();
                  // $(this).parent().parent().parent().find('[name="input_sebabmacet"]').attr("readonly","readonly");
                  // }
           });
  
  $('[name="input_kondisi"]').on('change', function(){
                if ($(this).val() != "00") {
                   $(this).parent().parent().parent().find('[name="input_tgl_kondisi"]').removeAttr("readonly");
                } else if ($(this).val() == "00") {
                  $(this).parent().parent().parent().find('[name="input_tgl_kondisi"]').val();
                  $(this).parent().parent().parent().find('[name="input_tgl_kondisi"]').attr("readonly","readonly");
                  }
           });

  $('[name="input_sifatkrd"]').on('change', function(){
                if ($(this).val() == '1') {
                   $(this).parent().parent().parent().find('[name="input_tgl_resawal"]').removeAttr("readonly");
                   $(this).parent().parent().parent().find('[name="input_tgl_resakhir"]').removeAttr("readonly");
                   $(this).parent().parent().parent().find('[name="input_frekres"]').removeAttr("readonly");
                   $(this).parent().parent().parent().find('[name="input_res"]').removeAttr("readonly");
                } else if ($(this).val() != '1') {
                  $(this).parent().parent().parent().find('[name="input_tgl_resawal"]').val();
                  $(this).parent().parent().parent().find('[name="input_tgl_resawal"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="input_tgl_resakhir"]').val();
                  $(this).parent().parent().parent().find('[name="input_tgl_resakhir"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="input_frekres"]').val();
                  $(this).parent().parent().parent().find('[name="input_frekres"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="input_res"]').val();
                  $(this).parent().parent().parent().find('[name="input_res"]').attr("readonly","readonly");
                } 
 });

  $('[name="input_sifatkrd"]').on('change', function(){
                if ($(this).val() == '2') {
                   $(this).parent().parent().parent().find('[name="input_to_dari"]').removeAttr("readonly");
                } else if ($(this).val() != '2') {
                  $(this).parent().parent().parent().find('[name="input_to_dari"]').val();
                  $(this).parent().parent().parent().find('[name="input_to_dari"]').attr("readonly","readonly");
                } 
 });
//penjumlahan   
            
function jumlah(){
//aset
    var kas = parseInt($('[name="input_kas"]').val().split('.').join(""));
    var piutanglancar = parseInt($('[name="input_piutang_usaha_al"]').val().split('.').join(""));
    var inveslancar = parseInt($('[name="input_investasi_lacar"]').val().split('.').join(""));
    var asetlainlancar = parseInt($('[name="input_aset_lancar_lain"]').val().split('.').join(""));
    var asetlancar = parseInt($('[name="input_aset_lancar"]').val().split('.').join(""));

    var piutangtidak = parseInt($('[name="input_piutang_usaha_atl"]').val().split('.').join(""));
    var investidak = parseInt($('[name="input_invest_tdk_lancar"]').val().split('.').join(""));
    var asetlaintidak = parseInt($('[name="input_aset_tdk_lancar_lain"]').val().split('.').join(""));
    var asettdklancar = parseInt($('[name="input_aset_tdk_lancar"]').val().split('.').join(""));

    var aset = parseInt($('[name="input_aset"]').val().split('.').join(""));

    var asetlancar = Math.ceil((kas+piutanglancar+inveslancar+asetlainlancar));
    var asettdklancar = Math.ceil((piutangtidak+investidak+asetlaintidak));
    var aset = Math.ceil((asetlancar+asettdklancar));
    $('[name="input_aset"]').val(aset);
    $('[name="input_aset_lancar"]').val(asetlancar);
    $('[name="input_aset_tdk_lancar"]').val(asettdklancar);

//lia
    var utangpendek = parseInt($('[name="input_utang_usaha_pndk"]').val().split('.').join(""));
    var pinjampendek = parseInt($('[name="input_pinjaman_pndk"]').val().split('.').join(""));
    var lialainpendek = parseInt($('[name="input_lia_pndk_lain"]').val().split('.').join(""));
    var liapendek = parseInt($('[name="input_lia_pndk"]').val().split('.').join(""));

    var utangpanjang = parseInt($('[name="input_utang_usaha_panjang"]').val().split('.').join(""));
    var pinjampanjang = parseInt($('[name="input_pinjaman_pnjng"]').val().split('.').join(""));
    var lialainpanjang = parseInt($('[name="input_lia_panjang_lain"]').val().split('.').join(""));
    var liapanjang = parseInt($('[name="input_lia_pnjng"]').val().split('.').join(""));

    var lia  = parseInt($('[name="input_lia"]').val().split('.').join(""));

    var liapendek = Math.ceil((utangpendek+pinjampendek+lialainpendek));
    var liapanjang = Math.ceil((utangpanjang+pinjampanjang+lialainpanjang));
    var lia = Math.ceil((liapendek+liapanjang));

    $('[name="input_lia_pndk"]').val(liapendek);
    $('[name="input_lia_pnjng"]').val(liapanjang);
    $('[name="input_lia"]').val(lia);
//lainnya
    var pendapatan = parseInt($('[name="input_pendapatan_usaha"]').val().split('.').join(""));
    var beban = parseInt($('[name="input_beban_pokok"]').val().split('.').join(""));
    var bruto = parseInt($('[name="input_labarugi"]').val().split('.').join(""));
    var pendapatanlain = parseInt($('[name="input_pendapatan_lain"]').val().split('.').join(""));
    var bebanlain = parseInt($('[name="input_beban_lain"]').val().split('.').join(""));
    var pajak = parseInt($('[name="input_labarugi_sblmPajak"]').val().split('.').join(""));
    var tahun = parseInt($('[name="input_labarugi_tahun"]').val().split('.').join(""));
    var ekui = parseInt($('[name="input_ekuitas"]').val().split('.').join(""));

    var bruto = Math.ceil((pendapatan-beban));
    var pajak = Math.ceil((bruto+pendapatanlain)-bebanlain);
    var ekui = Math.ceil((aset-lia));

    $('[name="input_labarugi"]').val(bruto);
    $('[name="input_labarugi_sblmPajak"]').val(pajak);
    $('[name="input_ekuitas"]').val(ekui);
}
    var SUBM = 0;
//     function isNumber(nama,pesan) {
//         var val = $('[name="'+nama+'"]').val().replace(/[\s-()]+/g, "");
//         //return !isNaN(parseFloat(val)) && isFinite(val);
//         if(!(!isNaN(parseFloat(val)) && isFinite(val))){
//             $('.errormsg').append('<li class="text-danger">'+pesan+' hanya berisi angka</li>');
//             $('[name="'+nama+'"]').css("background-color", "#F9CECE");
//         }
//     }
//     function checkEmpty(nama,pesan){
//         if($('[name="'+nama+'"]').val() == ''){
//             $('.errormsg').append('<li class="text-danger">'+pesan+' wajib diisi</li>');
//             $('[name="'+nama+'"]').css("background-color", "#F9CECE");
//         }
//     }

// function afterGet(data)
// {
    
// }
// function afterPost(data)
// {
    
// }
function number_format (number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
$(document).ready(function(){
   
     $('[name="input_biaya_adm"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_biaya_provisi"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_biaya_notaris"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_biaya_polis"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_biaya_ass"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_biaya_assjiwa"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_biaya_feemitra"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_biaya_lain"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     
     $('[name="input_nilaiproyek"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_dp"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_plafon"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_baki"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_pokok_hutang"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

    $("#tanggalmohon").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalmohonakhir").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalkondisi").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalresawal").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalresakhir").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalnunggak").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalmacet").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tahunan").datepicker({ dateFormat: 'dd-mm-yy' });

    $("#ft").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanft").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#fr").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanfr").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#ad").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanad").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#pr").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanpr").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#not").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesannot").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#pol").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanpol").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#as").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanas").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#ji").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanji").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#fe").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanfe").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#lain").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanlain").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#bulan").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanbulan").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    // $("#inputJangkaWaktu").keypress(function(data){
    //         if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
    //         {
    //             $("#inputJangkaWaktu").html("isikan angka").show().fadeOut("slow");
    //             return false;
    //         }
    // });
    $("#nilpro").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanpro").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#dp").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesandp").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    // $("#pkk").keypress(function(data){
    //         if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
    //         {
    //             $("#pesanpkk").html("isikan angka").show().fadeOut("slow");
    //             return false;
    //         }
    // });

    $('[name="input_jenis_angsuran"]').on('change', function(){
                if ($(this).val() == "FLAT") {
                  $('[name="input_jangkawaktu_pembayaran"]').val(1);
                  $('[name="input_jangkawaktu_pembayaran"]').prop("readonly",true);
                }
                else if($(this).val() == "BUNGA") {
                  $('[name="input_jangkawaktu_pembayaran"]').removeAttr("readonly");
                }
                else if($(this).val() == "BUNGATURUN") {
                  $('[name="input_jangkawaktu_pembayaran"]').removeAttr("readonly");
                  // $('[name="input_jeniskredit"]').val("AR"),
                  // $('[name="input_jeniskredit"]').prop("readonly",true);
                } else if ($(this).val() == "TARIKSETOR") {
                  $('[name="input_jangkawaktu_pembayaran"]').val(1);
                  $('[name="input_jangkawaktu_pembayaran"]').prop("readonly",true);
                }
           });
    // $('[name="input_bunga"]').mask('00,00', {reverse: true,selectOnFocus: true});
    // $('[name="input_pokok_hutang"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

    $("#generateTable").click(function(){
          var bungaperbulan = parseFloat($('[name="input_bunga"]').val().split(',').join("."));
          var jangkawaktu = parseInt($('[name="input_jangka_waktu"]').val());
          var jangkawaktupembayaran = parseInt($('[name="input_jangkawaktu_pembayaran"]').val());
          var pokokhutang = parseInt($('[name="input_pokok_hutang"]').val().split('.').join(""));
          $('[name="input_plafon"]').val(pokokhutang);
          $('[name="input_baki"]').val(pokokhutang);

          var bunga_per_bulan = Math.ceil((pokokhutang*(bungaperbulan/100)));
          var pokok_per_bulan = Math.ceil((pokokhutang/Math.floor(jangkawaktu/jangkawaktupembayaran)));
          if($('[name="input_jenis_angsuran"]').val() == "BUNGATURUN"){
              var bunga_per_bulan = 0;
          }
          if($('[name="input_jenis_angsuran"]').val() == "TARIKSETOR"){
              var bunga_per_bulan = 0;
              var pokok_per_bulan = 0;
        } 


        //memasukkan dalam kolom isian d form
          $('[name="input_angsuran_pokok"]').val(pokok_per_bulan);
          $('[name="input_angsuran_bunga"]').val(bunga_per_bulan);
          
          var d = new Date();
          if (d.getDate() < 10){
            //'0'+
            var dateToday = d.getDate();
          } else { var dateToday = d.getDate(); }
          if ((d.getMonth()+1) < 10){
            //'0'+
            var monthToday = (d.getMonth()+1);
          } else { var monthToday = d.getMonth()+1; }
          var dateNow = dateToday + "-" + monthToday + "-" + d.getFullYear();
          var content = '';
              $('#tabelPembayaran').empty();
                content += '<div class="row"><div class="col-sm-12">';
                    // if($('[name="input_jenis_angsuran"]').val() == "TARIKSETOR"){
                    // }

                    if(($('[name="input_jenis_angsuran"]').val() == "FLAT") || ($('[name="input_jenis_angsuran"]').val() == "BUNGA")){
                        content += '<hr /><table class="table table-striped" style="width:100%;">'+
                                      '<col><colgroup span="4"></colgroup><colgroup span="3"></colgroup>'+
                                      '<tr>'+
                                          '<th colspan="4" scope="colgroup"><h5 align="center">JADWAL</h5></th>'+
                                          '<th colspan="4" scope="colgroup"><h5 align="center">SALDO</h5></th>'+
                                      '</tr>'+
                                      '<tr>'+
                                          '<th scope="col" align="center">Ke</th>'+
                                          '<th scope="col" align="center">Tanggal</th>'+
                                          '<th scope="col" align="center">Angsuran</th>'+
                                          '<th scope="col" align="center">Angs. Pokok</th>'+
                                          '<th scope="col" align="center">Angs. Bunga</th>'+
                                          '<th scope="col" align="center">Saldo Pokok</th>'+
                                          '<th scope="col" align="center">Saldo BBT</th>'+
                                          '<th scope="col" align="center">Saldo Piutang</th>'+
                                      '</tr><tr><td colspan="5"></td>';

                        //coba simpan
                        // content += input('<td>'+$('[name="input_pokok_hutang"]').val()+'</td>')[]row;
                        // <input name="angsuran" value="14000">
                        //endcoba
                        content += '<td>'+$('[name="input_pokok_hutang"]').val()+'</td>';
                        content += '<td>'+(parseFloat($('[name="input_angsuran_bunga"]').val().split('.').join(""))*$('[name="input_jangka_waktu"]').val())+'</td>';
                        content += '<td>'+(parseFloat($('[name="input_pokok_hutang"]').val().split('.').join(""))+parseFloat($('[name="input_angsuran_bunga"]').val().split('.').join(""))*$('[name="input_jangka_waktu"]').val())+'</td></tr>';

                       
                        // Tabel Pembayaran Angsuran
                        var bungaperangsuran = parseFloat($('[name="input_angsuran_bunga"]').val().split('.').join(""));
                        var pokokperangsuran = parseFloat($('[name="input_angsuran_pokok"]').val().split('.').join(""));

                        var saldopokok = parseFloat($('[name="input_pokok_hutang"]').val().split('.').join(""));
                        var saldobbt = bungaperangsuran*$('[name="input_jangka_waktu"]').val();

                        //masuk ke saldo bbt dan piutang
                        $('[name="input_bbt"]').val(saldobbt);
                        $('[name="input_saldo_piutang"]').val(saldopokok+saldobbt) ;
                         //untuk tanggal
                        var after = d.getFullYear() + "-" + monthToday + "-" + dateToday;
                        //bukan tanggal
                        for(var x = 0; x < $('[name="input_jangka_waktu"]').val(); x++){
                          if((x+1) % $('[name="input_jangkawaktu_pembayaran"]').val() == 0){
                            if((saldopokok - pokokperangsuran) < 0){
                              pokokperangsuran += saldopokok - pokokperangsuran;
                            }
                            saldopokok -= pokokperangsuran;
                          } else {
                            saldopokok -= 0;
                          }
                          saldobbt -= bungaperangsuran;
                          var saldopiutang = saldopokok+saldobbt;
                        
                            //end bukan tanggal

                            //tanggal arrear
                            if($('[name="input_jeniskredit"]').val() != "AV"){ //arear
                                var before = after.split('-');
                                if(before[1] == 12) {
                                    var nextMonth = '1';
                                    var nextYear = parseInt(before[0],10)+1;
                                } else {
                                    if ((parseInt(before[1],10)+1) < 10){
                                        //'0'+
                                      var nextMonth = (parseInt(before[1],10)+1);
                                    } else { var nextMonth = parseInt(before[1],10)+1; }
                                    var nextYear = before[0];
                                }
                                var lastDate = new Date(nextYear, nextMonth, 0);
                                if(parseInt(before[2],10) > lastDate.getDate()){
                                    var nextDay = lastDate.getDate();
                                } else {
                                    // var nextDay = before[2];
                                     var nextDay = dateToday;
                                }
                                after = nextYear+'-'+nextMonth+'-'+nextDay;

                                if(x === 0){
                                    $('[name="input_tgl_mulai"]').val(nextDay+"-"+nextMonth+"-"+nextYear);//arear
                                }
                                $('[name="input_tgl_akhir"]').val(nextDay+"-"+nextMonth+"-"+nextYear);

                                content += '<tr><td>'+(x+1)+'</td>'+
                                           '<td>'+nextDay+'-'+nextMonth+'-'+nextYear+'</td>';

                            }else{ //advance

                               var before = after.split('-');
                                if(before[1] == 12) {
                                    var nextMonth = '1';
                                    var nextYear = parseInt(before[0],10)+1;
                                } else {
                                    if ((parseInt(before[1],10)+1) < 10){
                                        //'0'+
                                      var nextMonth = (parseInt(before[1],10)+1);
                                    } else { var nextMonth = parseInt(before[1],10)+1; }
                                    var nextYear = before[0];
                                }
                                var lastDate = new Date(nextYear, parseInt(before[1],10), 0);
                                if(parseInt(before[2],10) > lastDate.getDate()){
                                    var nextDay = lastDate.getDate();
                                } else {
                                    // var nextDay = before[2];
                                     var nextDay = dateToday;
                                }
                                after = nextYear+'-'+nextMonth+'-'+nextDay;


                                $('[name="input_tgl_mulai"]').val(dateNow);//advance
                                $('[name="input_tgl_akhir"]').val(nextDay+"-"+((parseInt(before[1],10)))+"-"+parseInt(before[0],10));

                                content += '<tr><td>'+(x+1)+'</td>'+
                                           '<td>'+nextDay+'-'+(parseInt(before[1],10))+'-'+parseInt(before[0],10)+'</td>';
                            }
                            //end tanggal

                          if((x+1) % $('[name="input_jangkawaktu_pembayaran"]').val() == 0){
                            content += '<td>'+number_format((pokokperangsuran+bungaperangsuran),0,'','.')+'</td>'+'<td>'+number_format(pokokperangsuran,0,'','.')+'</td>';
                          } else {
                            content += '<td>'+number_format(bungaperangsuran,0,'','.')+'</td>'+'<td>0</td>';
                          }
                           // if((x+1) % $('[name="input_jangkawaktu_pembayaran"]').val() == 0){
                          //   content += '<td>'+(input(name="saldopokokototal"(pokokperangsuran+bungaperangsuran)))+'</td>'+'<td>'+(input(name="saldopokokper"(pokokperangsuran)))+'</td>';
                          // } else {
                          //   content += '<td>'+(input(name="bungaper"(bungaperangsuran)))+'</td>'+'<td>0</td>';
                          // }
                          content += 
                                     '<td>'+number_format(bungaperangsuran,0,'','.') +'</td>'+
                                     '<td>'+number_format(saldopokok,0,'','.')+'</td>'+
                                     '<td>'+number_format(saldobbt,0,'','.')+'</td>'+
                                     '<td>'+number_format(saldopiutang,0,'','.')+'</td></tr>';
                                     // '<td>'+ '(input (name="bungaper" value(bungaperangsuran)))' +'</td>'+
                                     // '<td>'+ '(input (name="saldopok"value(saldopokok)))' +'</td>'+
                                     // '<td>'+ '(input (name="saldob" value(saldobbt)))'+'</td>'+
                                     // '<td>'+ '(input (name="saldopiut" value(saldopiutang)))'+'</td></tr>';
                          }
                    //tanggal
                    //}

                        content += '</table>';

                    
                    } 
    //end code. yang bawah gak dipakek

                    //untuk bunga menurun
                    else if ($('[name="input_jenis_angsuran"]').val() == "BUNGATURUN")
                        {
                      content +=  '<hr /><table class="table table-striped" style="width:100%;">'+
                                  '<col><colgroup span="4"></colgroup><colgroup span="3"></colgroup>'+
                                  '<tr>'+
                                      '<th colspan="5" scope="colgroup"><h5 align="center">JADWAL</h5></th>'+
                                      '<th colspan="3" scope="colgroup"><h5 align="center">SALDO</h5></th>'+
                                  '</tr>'+
                                  '<tr>'+
                                      '<th scope="col" align="center">Ke</th>'+
                                      '<th scope="col" align="center">Tanggal</th>'+
                                      '<th scope="col" align="center">Angsuran</th>'+
                                      '<th scope="col" align="center">Angs. Pokok</th>'+
                                      '<th scope="col" align="center">Angs. Bunga</th>'+
                                      '<th scope="col" align="center">Saldo Pokok</th>'+
                                      '<th scope="col" align="center">Saldo BBT</th>'+
                                      '<th scope="col" align="center">Saldo Piutang</th></tr>';


                      // Tabel Pembayaran Angsuran
                      var pokokperangsuran = parseFloat($('[name="input_angsuran_pokok"]').val().split('.').join(""));

                      var saldopokok = parseFloat($('[name="input_pokok_hutang"]').val().split('.').join(""));
                      var saldobbt = 0;
                      var saldo = saldopokok;
                      for(var x = 0; x < $('[name="input_jangka_waktu"]').val(); x++){
                            var bunga = Math.ceil(saldo*(parseFloat($('[name="input_bunga"]').val().split(',').join('.'))/100));
                            saldo -= pokokperangsuran;
                            saldobbt += bunga;
                      }
                      content += '<tr><td colspan="5"></td><td>'+$('[name="input_pokok_hutang"]').val()+'</td><td>'+saldobbt+'</td><td>'+(saldopokok+saldobbt)+'</td></tr>';
                      var after = d.getFullYear() + "-" + monthToday + "-" + dateToday;

                      $('[name="input_bbt"]').val(saldobbt);
                        $('[name="input_saldo_piutang"]').val(saldopokok+saldobbt) ;
                        
                      for(var x = 0; x < $('[name="input_jangka_waktu"]').val(); x++){
                        var saldo = saldopokok;
                        /*if((saldopokok - pokokperangsuran) < 0){
                          pokokperangsuran += saldopokok - pokokperangsuran;
                        }
                        saldopokok -= pokokperangsuran*/
                        if((x+1) % $('[name="input_jangkawaktu_pembayaran"]').val() == 0){
                            if((saldopokok - pokokperangsuran) < 0){
                              pokokperangsuran += saldopokok - pokokperangsuran;
                            }
                            saldopokok -= pokokperangsuran;
                        } else {
                            saldopokok -= 0;
                        }

                    
                        //tanggal arear
                        if($('[name="input_jeniskredit"]').val() != "AV"){
                        var before = after.split('-');
                        if(before[1] == 12) {
                            var nextMonth = '1';
                            var nextYear = parseInt(before[0],10)+1;
                        } else {
                            if ((parseInt(before[1],10)+1) < 10){
                              var nextMonth = (parseInt(before[1],10)+1);
                            } else { var nextMonth = parseInt(before[1],10)+1; }
                            var nextYear = before[0];
                        }
                        var lastDate = new Date(nextYear, nextMonth, 0);
                        if(parseInt(before[2],10) > lastDate.getDate()){
                            var nextDay = lastDate.getDate();
                        } else {
                            var nextDay = dateToday;
                        }
                        after = nextYear+'-'+nextMonth+'-'+nextDay;
                        var diff = lastDate.getDate();
                        //var bunga = Math.ceil(saldo*(parseFloat($('[name="input_bunga"]').val().split(',').join('.'))/100)/30*diff);
                        //var bunga = Math.ceil((saldo*(parseFloat($('[name="input_bunga"]').val().split(',').join('.'))/100)*diff/30));
                        var bunga = Math.ceil(saldo*(parseFloat($('[name="input_bunga"]').val().split(',').join('.'))/100));
                        //var saldobbt = bunga*$('[name="input_jangka_waktu"]').val();
                        //var saldopiutang = saldo+bunga;
                        saldobbt -= bunga;
                        saldopiutang = saldopokok+saldobbt;

                        // var saldobbt = (parseFloat($('[name="input_angsuran_bunga"]').val().split('.').join(""))*$('[name="input_jangka_waktu"]').val());
                        // var saldopiutang = (parseFloat($('[name="input_pokok_hutang"]').val().split('.').join(""))+parseFloat($('[name="input_angsuran_bunga"]').val().split('.').join(""))*$('[name="input_jangka_waktu"]').val());
                        // $('[name="input_bbt"]').val(saldobbt);
                        // $('[name="input_saldo_piutang"]').val(saldopiutang) ;


                        if(x === 0){
                                    $('[name="input_tgl_mulai"]').val(nextDay+"-"+nextMonth+"-"+nextYear);//arear
                                }
                                $('[name="input_tgl_akhir"]').val(nextDay+"-"+nextMonth+"-"+nextYear);

                        content += '<tr><td>'+(x+1)+'</td>'+
                                 '<td>'+nextDay+'-'+nextMonth+'-'+nextYear+'</td>';
                                 //'<td>'+diff+'</td>';
                        }else{
                        var before = after.split('-');
                        if(before[1] == 12) {
                            var nextMonth = '01';
                            var nextYear = parseInt(before[0],10)+1;
                        } else {
                            if ((parseInt(before[1],10)+1) < 10){
                              var nextMonth = '0'+(parseInt(before[1],10)+1);
                            } else { var nextMonth = parseInt(before[1],10)+1; }
                            var nextYear = before[0];
                        }
                        var lastDate = new Date(nextYear, nextMonth, 0);
                        if(parseInt(before[2],10) > lastDate.getDate()){
                            var nextDay = lastDate.getDate();
                        } else {
                            var nextDay = dateToday;
                        }
                        after = nextYear+'-'+nextMonth+'-'+nextDay;
                        var diff = Math.floor((new Date(after) - new Date(before)) / (1000 * 60 * 60 * 24));
                        //var bunga = Math.ceil(saldo*(parseFloat($('[name="input_bunga"]').val().split(',').join('.'))/100)/30*diff);
                        var bunga = Math.ceil(saldo*(parseFloat($('[name="input_bunga"]').val().split(',').join('.'))/100));
                        //var saldobbt = bunga*$('[name="input_jangka_waktu"]').val();
                        //var saldopiutang = saldo+bunga;
                        saldobbt -= bunga;
                        saldopiutang = saldopokok+saldobbt;
                        // var saldobbt = bunga*$('[name="input_jangka_waktu"]').val();
                        // var saldopiutang = (parseFloat($('[name="input_pokok_hutang"]').val().split('.').join(""))+parseFloat($('[name="input_angsuran_bunga"]').val().split('.').join(""))*$('[name="input_jangka_waktu"]').val());
                        // $('[name="input_bbt"]').val(saldobbt);
                        // $('[name="input_saldo_piutang"]').val(saldopiutang) ;


                        $('[name="input_tgl_mulai"]').val(dateNow);//advance
                                $('[name="input_tgl_akhir"]').val(nextDay+"-"+((parseInt(before[1],10)))+"-"+parseInt(before[0],10));

                        content += '<tr><td>'+(x+1)+'</td>'+
                                 '<td>'+nextDay+'-'+(parseInt(before[1],10))+'-'+parseInt(before[0],10)+'</td>';
                                 // '<td>'+diff+'</td>';
                    }
                        if((x+1) % $('[name="input_jangkawaktu_pembayaran"]').val() == 0){
                            content += '<td>'+number_format((pokokperangsuran+bunga),0,'','.')+'</td>'+'<td>'+number_format(pokokperangsuran,0,'','.')+'</td>';
                        } else {
                            content += '<td>'+number_format(bunga,0,'','.')+'</td>'+'<td>0</td>';
                        }
                        content += '<td>'+number_format(bunga,0,'','.')+'</td>'+
                                   '<td>'+number_format(saldopokok,0,'','.')+'</td>'+
                                   '<td>'+number_format(saldobbt,0,'','.')+'</td>'+
                                   '<td>'+number_format(saldopiutang,0,'','.')+'</td></tr>'; 
                        
                      }

                      content += '</table>';
                    }
                    else if ($('[name="input_jenis_angsuran"]').val() == "TARIKSETOR"){

                        var saldobbt = 0;
                        var saldopiutang = 0;
                        $('[name="input_bbt"]').val(saldobbt);
                        $('[name="input_saldo_piutang"]').val(saldopiutang) ;
                    }

              content += '</div></div>';
              
              $('#tabelPembayaran').append(content);  


    // $(document).ready(function() {
        
        // $('[name="input_tgl_akad_awal"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tgl_akad_akhir"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tlg_awal_kredit"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tgl_mulai"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tlg_jthtempo"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tgl_macet"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tgl_nunggak"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tgl_restukturisasi_awl"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tgl_restukturisasi_akhir"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tgl_kondisi"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });

        // $('[name="input_plafon_awal"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        // $('[name="input_real"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        // $('[name="input_denda"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        // $('[name="input_baki_debet"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        // $('[name="input_nilai_mata_uang_asal"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
               
        // $('#simpankreditform').on('keyup keypress', function(e) {
        //     var code = e.keyCode || e.which;
        //     if (code == 13) { 
        //         e.preventDefault();
        //         return false;
        //     }
        // });  
        // $('#simpankreditform').submit(function(e){
        //     $('.errormsg').empty();
        //     $('#panelerror').hide();
        //     $('input').css('background-color', 'transparent');
            
            // checkEmpty('input_nom_rekFas','Nomor Rekening Fasilitas');
            // checkEmpty('input_nom_CIF_debitur','Nomor CIF Debitur');
            // checkEmpty('input_kode_sifat_kredit','Kode Sifat Kredit');
            // checkEmpty('input_kode_jenis_kredit','Kode Jenis Kredit');
            // checkEmpty('input_kode_skim','Kode Skim');
            // checkEmpty('input_nom_akad_awal','Nomor Akad Awal');
            // checkEmpty('input_tgl_akad_awal','Tanggal Akad Awal');
            // checkEmpty('input_nom_akad_akhir','Nomor Akad Akhir');
            // checkEmpty('input_tgl_akad_akhir','Tanggal Akad Akhir');
            // checkEmpty('input_baru_perpanjangan','Baru/Perpanjangan');
            // checkEmpty('input_tlg_awal_kredit','Tanggal Awal Kredit');
            // checkEmpty('input_tgl_mulai','Tanggal Mulai');
            // checkEmpty('input_tlg_jthtempo','Tanggal Jatuh Tempo');
            // checkEmpty('input_kode_kategori_debitur','Kode Kategori Debitur');
            // checkEmpty('input_kode_jns_penggunaan','Kode Jenis Penggunaan');
            // checkEmpty('input_kode_orientasi_penggunaan','Kode Orientasi Penggunaan');
            // checkEmpty('input_kode_sektor_eko','Kode Sektor Ekonomi');
            // checkEmpty('input_kode_KotKab','Kode Kota/Kabupaten');
            // checkEmpty('input_nilai_proyek','Nilai Proyek');
            // checkEmpty('input_kode_valuta','Kode Valuta');
            // checkEmpty('input_present_bunga','Persentase Bunga');
            // checkEmpty('input_jns_sukubunga','Jenis Suku Bunga');
            // checkEmpty('input_kredit_prog_pemerintah','Kredit Program Pemerintah');
            // checkEmpty('input_to_dari','Takeover Dari');
            // checkEmpty('input_sumber_dana','Sumber Dana');
            // isNumber('input_plafon_awal','Plafon Awal');
            // isNumber('input_real','Realisasi');
            // isNumber('input_denda','Denda');
            // isNumber('input_baki_debet','Baki Debet');
            // isNumber('input_nilai_mata_uang_asal','Nilai Mata Uang Asal');
            // checkEmpty('input_kode_kolekbilitas','Kode Kolekbilitas');
            // checkEmpty('input_tgl_macet','Tanggal Macet');
            // checkEmpty('input_kode_sebabmacet','Kode Sebab Macet');
            // checkEmpty('input_tgl_nunggak','Tanggal Nunggak');
            // checkEmpty('input_frek_tunggakan','Frekuensi Tunggakan');
            // checkEmpty('input_frek_restukturisasi','Frekuensi Restrukturisasi');
            // checkEmpty('input_tgl_restukturisasi_awl','Tanggal Restrukturisasi Awal');
            // checkEmpty('input_tgl_restrukturisasi_akhr','Tanggal Restrukturisasi Akhir');
            // checkEmpty('input_kode_cara_restrukturisasi','Kode Cara Restrukturisasi');
            // checkEmpty('input_kode_kondisi','Kode Kondisi');
            // checkEmpty('input_tgl_kondisi','Tanggal Kondisi');
            // checkEmpty('input_ket','Keterangan');
            // checkEmpty('input_kode_kantor_cabang','Kode Kantor Cabang');
                       
            // if(SUBM == 0){
            //     if($('.errormsg').is(':empty')){
            //         if(confirm('Apakah anda yakin semua entry sudah benar ?')){
            //             SUBM = 1;
            //             return true;
            //         } else {
            //             return false;
            //         }
            //     } else {
            //         $('#panelerror').show();
            //         return false;
            //     }
            // } else {
            //     return false;
            // }
    });
            
});
</script>
@endsection
