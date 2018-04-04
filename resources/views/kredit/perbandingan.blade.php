<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>SLIK ABC FINANCE</title>
    <link rel="icon" href="/pic/logo.ico" type="image/x-icon">

    <!-- Fonts -->
    <link href="/offline/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'> -->
    <!-- <link href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700" rel='stylesheet' type='text/css'> -->

    <!-- Styles -->
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <!-- <link href="{{asset('/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet"> -->

    <style>

        body {
            /*font-family: 'Lato';*/
            min-height: 1000px;
            font: 92.5%;
            /*background-image: url("/pic/image.jpg");*/
            background-attachment:fixed;
            background-size: cover;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
        }

        .fa-btn {
            margin-right: 15px;
        }

        table,td,th{
            border:solid 1px black;
            margin:0px;
            padding:0px;
            border-collapse: collapse;
            border-spacing: 5;
            text-align:center;
            font-size:11px;
            /*font{color:red;}*/
            /*p{font-size:18px;color:red;}*/
        }
        h1 {
           color: blue;
        }
        td{
            text-align:left;
            padding-left:40px;
            border:solid 0px #ededed;
        }

    </style>
</head>
<body id="app-layout">
 <!-- <input type="button" class="btn btn-primary" value="CETAK" onclick="window.print()"> -->
<div class="container">
    <div class="row">
  
        <div class="col-sm-12">
            <div class="panel panel-primary" id="panelbank">
                    <div class="panel-body">
                        <table width=100%>
                        @if(trim($kredit->sistem,' ') != 'RK')
                             <th colspan="12" width=100% >
                                <?php
                                if($datanasabah->saldo_piutang ==0 && $datanasabah->tgl_lunas!='1900-01-01 00:00:00'){
                                    echo '<font size=5 color=red >LUNAS: '.date('d-m-Y',strtotime($datanasabah->tgl_lunas)).'</font>';
                                    // echo '<font size=3 color=red>'.date('d-m-Y',strtotime($datanasabah->tgl_lunas)).'</font>';
                                    }
                                ?> 
                            </th>
                        @endif
                         <tr>
                            <th colspan="12" style="background-color: #ededed" width=100% onclick="window.print()" >
                                <font size="5">PERBANDINGAN</font>
                            </th>
                            <tr>
                                <th colspan=3>DATA DEBITUR</th>
                                <th colspan=4>PIUTANG KREDIT</th>
                            </tr>  
                        @if(trim($kredit->sistem,' ') != 'RK')   
                            <tr>
                                <td>NPP</td><td colspan=2>: {{$datanasabah->no_ref}}</td>
                                <td style="border-left:solid 1px #000;">Pinjaman Pokok</td><td colspan=2>: Rp {{number_format($datanasabah->plafon,0,'','.')}}</td>
                                 <td style="border-right:solid 1px #000;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td >Tanggal Realisasi</td><td colspan=2>: {{date('d-m-Y',strtotime($datanasabah->tgl_mulai))}}</td>
                                <td style="border-left:solid 1px #000;">Suku Bunga</td><td colspan=2>: {{$datanasabah->pinj_prsbunga}}% PA</td>
                                 <td style="border-right:solid 1px #000;">&nbsp;</td>
                            </tr>
                            <tr>
                                <td>Nama</td><td colspan=2>: {{$datanasabah->nama}}</td>
                                <td style="border-left:solid 1px #000;">Tgl. Angs</td><td colspan=2>: {{date('d-m-Y',strtotime($datanasabah->tgl_mulai))}} &nbsp;<b>S/d</b>&nbsp; {{date('d-m-Y',strtotime($datanasabah->jatuhtempo))}}</td>
                                 <td style="border-right:solid 1px #000;">&nbsp;</td>
                            </tr>  
                             <tr>
                                <td>Alamat</td><td colspan=2>: {{$datanasabah->alamat}} {{$datanasabah->rtrw}} {{$datanasabah->desa}} {{$datanasabah->camat}}  
                                @foreach($lihat8 as $l){{$l->desc2}} @endforeach</td>
                                <td style="border-left:solid 1px #000;">Jatuh Tempo</td><td colspan=2>: {{date('d-m-Y',strtotime($datanasabah->jatuhtempo))}}</td>
                                 <td style="border-right:solid 1px #000;">&nbsp;</td>
                            </tr>  
                             <tr>
                                <td>No. Telp</td><td colspan=2>: {{$datanasabah->notelp}}/{{$datanasabah->nohp}}</td>
                                <td style="border-left:solid 1px #000;">Jangka Waktu</td><td colspan=2>: {{$datanasabah->lama}} Bulan</td>
                                 <td style="border-right:solid 1px #000;">&nbsp;</td>
                            </tr>  
                           
                            <tr>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td style="border-left:solid 1px #000;">Sistem</td><td colspan=2>: {{$datanasabah->sistem}}</td>
                                 <td style="border-right:solid 1px #000;">&nbsp;</td>
                            </tr>

                             <tr>
                                 
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td style="border-left:solid 1px #000;">Denda</td><td colspan=2>: Rp
                                {{number_format((($datanasabah->angs_pokok+$datanasabah->angs_bunga)*(0.5/100)/100)*100),0,'','.'}} / hari</td>
                                <td style="border-right:solid 1px #000;">&nbsp;</td>
                            </tr>

                            <tr>
                                 
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td style="border-left:solid 1px #000;">Denda belum dibayar</td><td colspan=2>: Rp {{number_format($totaldenda,0,'','.')}}</td>
                                <td style="border-right:solid 1px #000;">&nbsp;</td>
                            </tr>

                           
                        
                        </tr>
                        </tr>
                                        <div class="form-group pull-right">
                                              <div class="row">
                                                <div class="col-sm-4">
                                                  <button type="button" id="generateTable" class="btn btn-primary">Tampilkan Simulasi</button>
                                                </div>
                                              </div>
                                        </div>
                        </table>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table-bordered" style="padding: 1px 4px 0px 4px;margin: 0 auto;border-spacing: 0;" border="0" name="histpaymenttable" width=100% >
                                    <thead>
                                         <th colspan="10" scope="colgroup" align="center" style="background-color: #ededed" >Data ABC</th>
                                          <th colspan="10" scope="colgroup" align="center" style="background-color: #ededed" >Data Cloud</th>
                                        <col>
                                        <colgroup span="3"></colgroup>
                                        <colgroup span="3"></colgroup>
                                        <colgroup span="1"></colgroup>
                                        <tr>
                                            <th colspan="3" scope="colgroup" align="center" style="background-color: #ededed" >Jadwal</th>
                                            <th colspan="3" scope="colgroup" align="center" style="background-color: #ededed">Pembayaran</th>
                                            <th colspan="1" scope="colgroup" align="center" style="background-color: #ededed">Saldo</th>
                                            <th colspan="1" rowspan="3" scope="colgroup" align="center" style="background-color: #ededed">Denda</th>
                                            <th colspan="1" rowspan="3" scope="colgroup" align="center" style="background-color: #ededed">Bayar Denda</th>
                                            <th colspan="1" rowspan="3" scope="colgroup" align="center" style="background-color: #ededed">Catatan</th>

                                            <th colspan="3" scope="colgroup" align="center" style="background-color: #ededed" >Jadwal</th>
                                            <th colspan="3" scope="colgroup" align="center" style="background-color: #ededed">Pembayaran</th>
                                            <th colspan="1" scope="colgroup" align="center" style="background-color: #ededed">Saldo</th>
                                            <th colspan="1" rowspan="3" scope="colgroup" align="center" style="background-color: #ededed">Denda</th>
                                            <th colspan="1" rowspan="3" scope="colgroup" align="center" style="background-color: #ededed">Bayar Denda</th>
                                            <th colspan="1" rowspan="3" scope="colgroup" align="center" style="background-color: #ededed">Catatan</th>
                                        </tr>

                                        <tr>
                                            <th scope="col" align="center">Tanggal</th>
                                            <th scope="col" align="center">Ke</th>
                                            <th scope="col" align="center">Angsuran</th>
                                            {{-- <th scope="col" align="center">Pokok</th>
                                            <th scope="col" align="center">Bunga</th> --}}
                                            {{-- <th scope="col" align="center">No Bukti</th> --}}
                                            <th scope="col" align="center">Tgl.Bayar</th>
                                            <th scope="col" align="center">Pokok</th>
                                            <th scope="col" align="center">Bunga</th>
                                            <th scope="col" align="center">Saldo Piutang</th>

                                            <th scope="col" align="center">Tanggal</th>
                                            <th scope="col" align="center">Ke</th>
                                            <th scope="col" align="center">Angsuran</th>
                                            {{-- <th scope="col" align="center">Pokok</th>
                                            <th scope="col" align="center">Bunga</th> --}}
                                            {{-- <th scope="col" align="center">No Bukti</th> --}}
                                            <th scope="col" align="center">Tgl.Bayar</th>
                                            <th scope="col" align="center">Pokok</th>
                                            <th scope="col" align="center">Bunga</th>
                                            <th scope="col" align="center">Saldo Piutang</th>
                                        </tr>
                                        <tr>
                                            <th colspan="6" scope="col" align="center"></th>
                                            <th scope="col" align="center">{{number_format(($datanasabah->plafon+$datanasabah->bbt),0,'','.')}}</th>

                                            <th colspan="6" scope="col" align="center"></th>
                                            <th scope="col" align="center">{{number_format(($datanasabah->plafon+$datanasabah->bbt),0,'','.')}}</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $spiutang = $datanasabah->plafon+$datanasabah->bbt;
                                            foreach($dataangs as $angs2){
                                                $spiutang -= $angs2->pokok+$angs2->bunga;
                                                echo '<tr>';
                                                echo '<td class="angsuran'.$angs2->bayar_ke.'tgljadwal">'.date('d-m-Y',strtotime($angs2->tgl_angsur)).'</td>';
                                                echo '<td class="angsuran'.$angs2->bayar_ke.'bayarke">'.$angs2->bayar_ke.'</td>';
                                                echo '<td class="angsuran'.$angs2->bayar_ke.'angsuranjadwal">'.number_format(($angs2->angs_pokok+$angs2->angs_bunga),0,'','.').'</td>';
                                                echo '<td style="display:none;" class="angsuran'.$angs2->bayar_ke.'pokokjadwal">'.number_format($angs2->angs_pokok,0,'','.').'</td>';
                                                echo '<td style="display:none;" class="angsuran'.$angs2->bayar_ke.'bungajadwal">'.number_format($angs2->angs_bunga,0,'','.').'</td>';
                                                if($angs2->angs_ke <> ""){
                                                    //echo '<td class="angsuran'.$angs2->bayar_ke.'nobukti">'.$angs2->angs_nobukti.'</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'tglangsuran">'.date('d-m-y',strtotime($angs2->angs_tgl)).'</td>';
                                                    echo '<td style="display:none;" class="angsuran'.$angs2->bayar_ke.'angsurandibayar">'.($angs2->pokok+$angs2->bunga).'</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'angsurpokok">'.number_format($angs2->pokok,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'angsurbunga">'.number_format($angs2->bunga,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'saldopiutang">'.number_format($spiutang,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'dendakena">'.number_format($angs2->dendakena,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'denda">'.number_format($angs2->denda,0,'','.').'</td>';
                                                } else {
                                                    //echo '<td class="angsuran'.$angs2->bayar_ke.'nobukti">-</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'tglangsuran">-</td>';
                                                    echo '<td style="display:none;" class="angsuran'.$angs2->bayar_ke.'angsurandibayar">0</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'angsurpokok">0</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'angsurbunga">0</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'saldopiutang">-</td>';
                                                    if($angs2->dendakena === 0){
                                                        echo '<td class="angsuran'.$angs2->bayar_ke.'dendakena">-</td>';
                                                    } else {
                                                        echo '<td class="angsuran'.$angs2->bayar_ke.'dendakena">'.number_format($angs2->dendakena,0,'','.').'</td>';
                                                    }
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'denda">-</td>';
                                                }
                                                if($angs2->angs_ke <> ""){
                                                    if($angs2->diff > 0){
                                                        echo '<td class="angsuran'.$angs2->bayar_ke.'catatan">Tlt <span class="text-danger">'.abs($angs2->diff).'</span> hari';
                                                    } elseif($angs2->diff < 0){
                                                        echo '<td class="angsuran'.$angs2->bayar_ke.'catatan">Cpt '.abs($angs2->diff).' hari';
                                                    } elseif($angs2->diff == 0) {
                                                        echo '<td class="angsuran'.$angs2->bayar_ke.'catatan">Tepat waktu';
                                                    }
                                                    if(($angs2->angs_pokok+$angs2->angs_bunga) > ($angs2->pokok+$angs2->bunga)){
                                                        echo ',sebagian</td>';
                                                    } else {
                                                        echo '</td>';
                                                    }
                                                } else {
                                                    if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($angs2->tgl_angsur))))->format('%r%a') < 0){
                                                        echo '<td class="angsuran'.$angs2->bayar_ke.'catatan">Tlt '.abs(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($angs2->tgl_angsur))))->format('%r%a')).' hari</td>';;
                                                    } else {
                                                        echo '<td class="angsuran'.$angs2->bayar_ke.'catatan">-</td>';    
                                                    }
                                                }
                                            

                                                echo '<td class="angsuran'.$angs2->bayar_ke.'tgljadwal">'.date('d-m-Y',strtotime($angs2->tgl_angsur)).'</td>';
                                                echo '<td class="angsuran'.$angs2->bayar_ke.'bayarke">'.$angs2->bayar_ke.'</td>';
                                                echo '<td class="angsuran'.$angs2->bayar_ke.'angsuranjadwal">'.number_format(($angs2->angs_pokok+$angs2->angs_bunga),0,'','.').'</td>';
                                                echo '<td style="display:none;" class="angsuran'.$angs2->bayar_ke.'pokokjadwal">'.number_format($angs2->angs_pokok,0,'','.').'</td>';
                                                echo '<td style="display:none;" class="angsuran'.$angs2->bayar_ke.'bungajadwal">'.number_format($angs2->angs_bunga,0,'','.').'</td>';
                                                if($angs2->angs_ke <> ""){
                                                    //echo '<td class="angsuran'.$angs2->bayar_ke.'nobukti">'.$angs2->angs_nobukti.'</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'tglangsuran">'.date('d-m-y',strtotime($angs2->angs_tgl)).'</td>';
                                                    echo '<td style="display:none;" class="angsuran'.$angs2->bayar_ke.'angsurandibayar">'.($angs2->pokok+$angs2->bunga).'</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'angsurpokok">'.number_format($angs2->pokok,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'angsurbunga">'.number_format($angs2->bunga,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'saldopiutang">'.number_format($spiutang,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'dendakena">'.number_format($angs2->dendakena,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'denda">'.number_format($angs2->denda,0,'','.').'</td>';
                                                } else {
                                                    //echo '<td class="angsuran'.$angs2->bayar_ke.'nobukti">-</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'tglangsuran">-</td>';
                                                    echo '<td style="display:none;" class="angsuran'.$angs2->bayar_ke.'angsurandibayar">0</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'angsurpokok">0</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'angsurbunga">0</td>';
                                                    echo '<td class="angsuran'.$angs2->bayar_ke.'saldopiutang">-</td>';
                                                    
                                                foreach($dataangs as $angs22){
                                                    if($angs22->dendakena === 0){
                                                        echo '<td class="angsuran'.$angs22->bayar_ke.'dendakena">-</td>';
                                                    } else {
                                                        echo '<td class="angsuran'.$angs22->bayar_ke.'dendakena">'.number_format($angs2->dendakena,0,'','.').'</td>';
                                                    }
                                                    echo '<td class="angsuran'.$angs22->bayar_ke.'denda">-</td>';
                                                }

                                                }
                                                if($angs2->angs_ke <> ""){
                                                    if($angs2->diff > 0){
                                                        echo '<td class="angsuran'.$angs2->bayar_ke.'catatan">Tlt <span class="text-danger">'.abs($angs2->diff).'</span> hari';
                                                    } elseif($angs2->diff < 0){
                                                        echo '<td class="angsuran'.$angs2->bayar_ke.'catatan">Cpt '.abs($angs2->diff).' hari';
                                                    } elseif($angs2->diff == 0) {
                                                        echo '<td class="angsuran'.$angs2->bayar_ke.'catatan">Tepat waktu';
                                                    }
                                                    if(($angs2->angs_pokok+$angs2->angs_bunga) > ($angs2->pokok+$angs2->bunga)){
                                                        echo ',sebagian</td>';
                                                    } else {
                                                        echo '</td>';
                                                    }
                                                } else {
                                                    if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($angs2->tgl_angsur))))->format('%r%a') < 0){
                                                        echo '<td class="angsuran'.$angs2->bayar_ke.'catatan">Tlt '.abs(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($angs2->tgl_angsur))))->format('%r%a')).' hari</td>';;
                                                    } else {
                                                        echo '<td class="angsuran'.$angs2->bayar_ke.'catatan">-</td>';    
                                                    }
                                                }


                                                echo '</tr>';



                                            }
                                        ?>


                                        <th colspan="20" style="background-color: #ededed" >Dicetak oleh : ({{ trim(Auth::user()->nama_lengkap,' ') }}) Tanggal : {{date('d-m-Y')}}</th>
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


<script src="{{asset('jquery.js')}}"></script>
<script src="{{asset('/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('/jquery_mask/jquery.mask.min.js')}}"></script>
<script src="{{asset('/fittext/jquery.fittext.js')}}"></script>

<script type="text/javascript">
    var CONTENT;
    function isNumber(n) {
      return !isNaN(parseFloat(n)) && isFinite(n);
    }
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
    function parseDate(str) {
        var mdy = str.split('-')
        return new Date(mdy[2], mdy[1]-1, mdy[0]);
    }

    function daydiff(first, second) {
        return Math.round((second-first)/(1000*60*60*24));
    }

    $(document).ready(function() {
        CONTENT = $('[name="histpaymenttable"] tbody').clone();
        //console.log(CONTENT);
        //jQuery('[name="histpaymenttable"]').fitText(1, { minFontSize: '10px', maxFontSize: '13px' });


            // $('[name="histpaymenttable"]').empty();
            // $('[name="histpaymenttable"]').append(CONTENT);

            var jmlbayar = parseFloat("");
            console.log(jmlbayar);
            //var denda = parseFloat($('[name="input_jumlah_denda"]').val().split('.').join(''));
            var tunggakke = parseInt("{{$tgk}}");

            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1; //January is 0!
            var yyyy = today.getFullYear();

            if(dd<10) {
                dd='0'+dd
            } 

            if(mm<10) {
                mm='0'+mm
            } 

            var i = parseInt("{{$tgk}}");
            var j = parseInt("{{$tgk}}");
            


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
    
    $("#inputtgladen").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalmohon").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalmohonakhir").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalkondisi").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalresawal").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalresakhir").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalnunggak").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalmacet").datepicker({ dateFormat: 'dd-mm-yy' });

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
                else if($(this).val() == "BUNGA MENURUN") {
                  $('[name="input_jangkawaktu_pembayaran"]').removeAttr("readonly");
                  // $('[name="input_jeniskredit"]').val("AR"),
                  // $('[name="input_jeniskredit"]').prop("readonly",true);
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

          var dp = Math.ceil((40*pokokhutang)/100);
          $('[name="input_dp"]').val(dp);

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


   
    });
    });
</script>
</body>
</html>
@endif