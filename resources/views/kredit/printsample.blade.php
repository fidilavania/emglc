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
    {{-- <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"> --}}
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link href="{{asset('/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

    <style>

        body {
            /*font-family: 'Lato';*/
            min-height: 1000px;
            font: 92.5%;
            background-image: url("/pic/image.jpg");
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
                                <font size="5">HISTORY PAYMENT</font>
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
                                <td >Tanggal Realisasi</td><td colspan=2>: {{date('d-m-Y',strtotime($datanasabah->tgl_kredit))}}</td>
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

                        </table>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table-bordered" style="padding: 1px 4px 0px 4px;margin: 0 auto;border-spacing: 0;" border="0" name="histpaymenttable" width=100% >
                                    <thead>
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
                                        </tr>
                                        <tr>
                                            <th colspan="6" scope="col" align="center"></th>
                                            <th scope="col" align="center">{{number_format(($datanasabah->plafon+$datanasabah->bbt),0,'','.')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $spiutang = $datanasabah->plafon+$datanasabah->bbt;
                                            foreach($dataangs as $angs){
                                                $spiutang -= $angs->pokok+$angs->bunga;
                                                echo '<tr>';
                                                echo '<td class="angsuran'.$angs->bayar_ke.'tgljadwal">'.date('d-m-Y',strtotime($angs->tgl_angsur)).'</td>';
                                                echo '<td class="angsuran'.$angs->bayar_ke.'bayarke">'.$angs->bayar_ke.'</td>';
                                                echo '<td class="angsuran'.$angs->bayar_ke.'angsuranjadwal">'.number_format(($angs->angs_pokok+$angs->angs_bunga),0,'','.').'</td>';
                                                echo '<td style="display:none;" class="angsuran'.$angs->bayar_ke.'pokokjadwal">'.number_format($angs->angs_pokok,0,'','.').'</td>';
                                                echo '<td style="display:none;" class="angsuran'.$angs->bayar_ke.'bungajadwal">'.number_format($angs->angs_bunga,0,'','.').'</td>';
                                                if($angs->angs_ke <> ""){
                                                    //echo '<td class="angsuran'.$angs->bayar_ke.'nobukti">'.$angs->angs_nobukti.'</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'tglangsuran">'.date('d-m-y',strtotime($angs->angs_tgl)).'</td>';
                                                    echo '<td style="display:none;" class="angsuran'.$angs->bayar_ke.'angsurandibayar">'.($angs->pokok+$angs->bunga).'</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'angsurpokok">'.number_format($angs->pokok,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'angsurbunga">'.number_format($angs->bunga,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'saldopiutang">'.number_format($spiutang,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'dendakena">'.number_format($angs->dendakena,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'denda">'.number_format($angs->denda,0,'','.').'</td>';
                                                } else {
                                                    //echo '<td class="angsuran'.$angs->bayar_ke.'nobukti">-</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'tglangsuran">-</td>';
                                                    echo '<td style="display:none;" class="angsuran'.$angs->bayar_ke.'angsurandibayar">0</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'angsurpokok">0</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'angsurbunga">0</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'saldopiutang">-</td>';
                                                    if($angs->dendakena === 0){
                                                        echo '<td class="angsuran'.$angs->bayar_ke.'dendakena">-</td>';
                                                    } else {
                                                        echo '<td class="angsuran'.$angs->bayar_ke.'dendakena">'.number_format($angs->dendakena,0,'','.').'</td>';
                                                    }
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'denda">-</td>';
                                                }
                                                if($angs->angs_ke <> ""){
                                                    if($angs->diff > 0){
                                                        echo '<td class="angsuran'.$angs->bayar_ke.'catatan">Tlt <span class="text-danger">'.abs($angs->diff).'</span> hari';
                                                    } elseif($angs->diff < 0){
                                                        echo '<td class="angsuran'.$angs->bayar_ke.'catatan">Cpt '.abs($angs->diff).' hari';
                                                    } elseif($angs->diff == 0) {
                                                        echo '<td class="angsuran'.$angs->bayar_ke.'catatan">Tpt waktu';
                                                    }
                                                    if(($angs->angs_pokok+$angs->angs_bunga) > ($angs->pokok+$angs->bunga)){
                                                        echo ',sbgn</td>';
                                                    } else {
                                                        echo '</td>';
                                                    }
                                                } else {
                                                    if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($angs->tgl_angsur))))->format('%r%a') < 0){
                                                        echo '<td class="angsuran'.$angs->bayar_ke.'catatan">Tlt '.abs(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($angs->tgl_angsur))))->format('%r%a')).' hari</td>';;
                                                    } else {
                                                        echo '<td class="angsuran'.$angs->bayar_ke.'catatan">-</td>';    
                                                    }
                                                }
                                                echo '</tr>';

                                            }
                                        ?>
                                        <th colspan="10" style="background-color: #ededed" >Dicetak oleh : ({{ trim(Auth::user()->nama_lengkap,' ') }}) Tanggal : {{date('d-m-Y')}}</th>
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
            /*while (daydiff(parseDate(dd+'-'+mm+'-'+yyyy),parseDate($('.angsuran'+i+'tgljadwal').text())) <= 0) {
                console.log('The number is '+i);
                console.log('Today date '+parseDate(dd+'-'+mm+'-'+yyyy));
                console.log('Angsuran date '+parseDate($('.angsuran'+i+'tgljadwal').text()));
                console.log('Tunggakan '+daydiff(parseDate(dd+'-'+mm+'-'+yyyy),parseDate($('.angsuran'+i+'tgljadwal').text())));
                var angsuranjadwal = $('.angsuran'+i+'angsuranjadwal').text().split('.').join('');
                var angsurandibayar = $('.angsuran'+i+'angsurandibayar').text().split('.').join('');
                jmlbayar -= angsuranjadwal-angsurandibayar;
                console.log('Yang harus dibayar '+angsuranjadwal);
                console.log('Yang dibayar dulu '+angsurandibayar);
                console.log('Sisa belum terbayar '+(angsuranjadwal-angsurandibayar));
                console.log('Sisa yang dibayar nasabah '+jmlbayar);
                if(jmlbayar === 0){
                    break;
                }
                i++;
            }*/
            // 
            //console.log(daydiff(parseDate('01-03-2016'),parseDate('21-01-2016')));
         
    });
</script>
</body>
</html>
@endif