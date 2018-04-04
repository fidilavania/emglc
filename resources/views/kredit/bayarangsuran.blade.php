@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="panelangsuran">
                <div class="panel-heading"><h4 align="center">PEMBAYARAN ANGSURAN</h4></div>
                    <div class="panel-body">
                      <form class="form-horizontal" id="bayarangsuranform" role="form" method="POST" action="{{ url('/kredit/angsuran/bayar/save/'.$datanasabah->no_kredit) }}" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="input_tunggak_ke" value="{{$tgk}}" />
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Tanggal</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="input_tanggal" value="{{date('d-m-Y')}}" readonly>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Nama</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="input_nama_nasabah" autocomplete="off" value="{{$datanasabah->nama}}" readonly />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">NPP</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="input_npp_nasabah" autocomplete="off" value="{{$datanasabah->no_ref}}" readonly />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Keterangan</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="input_keterangan_nasabah" autocomplete="off" value="ANGSURAN {{$datanasabah->nama}}" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Sistem</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="input_sistem_angsuran" autocomplete="off" value="{{$datanasabah->sistem}}" readonly />
                                    </div>
                                    {{-- <label class="col-sm-1 control-label">Ke</label>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="input_angsuran_ke" autocomplete="off" value="{{$tgk}}" readonly />
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="text" class="form-control" name="input_angsuran_ke_sampai" autocomplete="off" value="{{$tgk}}" />
                                    </div> --}}
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Tunggak / Jatuh Tempo</label>
                                    <div class="col-sm-4">
                                        {{--<input type="text" class="form-control" name="input_tunggakan" autocomplete="off" value="{{abs($dataangs[$tgk]->tunggak)}} hari" readonly />--}}
                                        <input type="text" class="form-control" name="input_tunggakan" autocomplete="off" value="{{$tgkangsur}} angsuran" readonly />
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control" name="input_jatuh_tempo" autocomplete="off" value="{{date('d-m-Y',strtotime($dataangs[$tgk]->tgl_angsur))}}" readonly />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Bayar Pokok</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="text" class="form-control" name="input_jumlah_pokok" autocomplete="off" value="{{number_format($totaltunggak['pokok'],0,'','.')}}" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Bayar Bunga</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="text" class="form-control" name="input_jumlah_bunga" autocomplete="off" value="{{number_format($totaltunggak['bunga'],0,'','.')}}" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Total Bayar</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="text" class="form-control" name="input_jumlah_total" autocomplete="off" value="{{number_format(($totaltunggak['pokok']+$totaltunggak['bunga']),0,'','.')}}" readonly/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Bayar Lunas</label>
                                    <input id="inputBayarLunas" class="changeBayarLunas" name="input_bayar_lunas" type="checkbox" value="LUNAS">
                                    <label for="inputBayarLunas">LUNAS</label>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Jumlah Bayar</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="text" class="form-control" name="input_jumlah_bayar" autocomplete="off" value="{{number_format($dataangs[$tgk]->sisa_tunggak,0,'','.')}}" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Potongan Pokok</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="text" class="form-control" name="input_jumlah_potongan_pokok" autocomplete="off" value=0 />
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Potongan Bunga</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="text" class="form-control" name="input_jumlah_potongan_bunga" autocomplete="off" value=0 />
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Denda Belum Bayar</label>
                                    <div class="col-sm-8">
                                            <span>Rp. {{number_format($totaldenda,0,'','.')}},00</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Denda Angsuran</label>
                                    <div class="col-sm-8">
                                            <span>Rp. {{number_format($dataangs[$tgk]->dendakena,0,'','.')}},00</span>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Denda</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="text" class="form-control" name="input_jumlah_denda" autocomplete="off" value="0" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Potongan Denda</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="text" class="form-control" name="input_jumlah_potongan_denda" autocomplete="off" value=0 />
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group" style="background-color:#F7819F">
                                    <label class="col-sm-4 control-label">Total Bayar</label>
                                    <div class="col-sm-8">
                                        <label name="total_bayar">Rp. {{number_format($totaldenda,0,'','.')}},00</label>
                                    </div>
                                </div>
                                {{--<div class="row form-group">
                                    <label class="col-sm-4 control-label">Potongan</label>
                                    <div class="col-sm-8">
                                        <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                            <input type="text" class="form-control" name="input_jumlah_potongan" autocomplete="off" value=0 />
                                        </div>
                                    </div>
                                </div>--}}
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Cara Pembayaran</label>
                                    <div class="col-sm-3">
                                        <input type="radio" id="inputJenisTunai" name="input_cara_pembayaran" value="TUNAI" checked />
                                        <label for="inputJenisTunai">Tunai</label>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="radio" id="inputJenisNonTunai" name="input_cara_pembayaran" value="NON TUNAI" />
                                        <label for="inputJenisNonTunai">Non Tunai</label>
                                    </div>
                                    <div class="col-sm-2">
                                        <input type="radio" id="inputJenisTitipan" name="input_cara_pembayaran" value="TITIPAN" />
                                        <label for="inputJenisTitipan">Titipan</label>
                                    </div>
                                </div>
                                <div class="row form-group fieldnontunai" hidden>
                                    <label class="col-sm-4 control-label">Rek. ABC / Tanggal</label>
                                    <div class="col-sm-3">
                                      
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                              <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                            <input type="text" class="form-control" name="input_tanggal_transfer" value="{{date('d-m-Y')}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group fieldnontunai" hidden>
                                    <label class="col-sm-4 control-label">Rek. Asal / Atas Nama</label>
                                    <div class="col-sm-3">
                                        
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" name="input_atas_nama_dari" autocomplete="off" value="{{$datanasabah->nama}}" style="text-transform:uppercase" />
                                    </div>
                                </div>
                                @if(strtotime($datanasabah->tgl_lunas) <= strtotime('1970-01-01'))
                                    <div class="row form-group">
                                        <label class="col-sm-2 control-label">&nbsp;</label>
                                        <div class="col-sm-4">
                                            {{-- <button type="submit" class="btn btn-primary" name="simpanbayarangsuranbutton">SIMPAN</button> --}}
                                            {{--<input type="button" class="btn btn-primary" name="generatesample" value="GENERATE" />--}}
                                            {{-- <input type="button" class="btn btn-primary" name="printsample" value="PRINT" data-url="{{url('kredit/angsuran/bayar/print')}}" /> --}}
                                        </div>
                                        <div class="col-sm-4">
                                            <button type="submit" class="btn btn-primary" name="simpanbayarangsuranbutton">SIMPAN</button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                      </form>
                        <hr />
                        <div class="row">
                            <div class="col-sm-12">
                                @if(strtotime($datanasabah->tgl_lunas) > strtotime('1970-01-01'))
                                    <h3 style="color:red">LUNAS tanggal {{date('d-m-Y',strtotime($datanasabah->tgl_lunas))}}</h3>
                                @endif
                            </div>
                        </div>
                        <div class="row" style="overflow: auto;max-height:500px">
                            <div class="col-sm-12">
                                <table class="table" name="datanasabahtable">
                                    <thead>
                                        <col>
                                        <colgroup span="3"></colgroup>
                                        <colgroup span="3"></colgroup>
                                        <tr>
                                            <th colspan="3" scope="colgroup" align="center">Data Debitur</th>
                                            <th colspan="3" scope="colgroup" align="center">Piutang Kredit</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>No Kredit</td>
                                            <td>:</td>
                                            <td>{{$datanasabah->no_ref}}</td>
                                            <td>Plafon</td>
                                            <td>:</td>
                                            <td>Rp. {{number_format($datanasabah->plafon,0,'','.')}}</td>
                                        </tr>
                                        <tr>
                                            <td>Nama</td>
                                            <td>:</td>
                                            <td>{{$datanasabah->nama}}</td>
                                            <td>Bunga</td>
                                            <td>:</td>
                                            <td>{{$datanasabah->pinj_prsbunga}}%</td>
                                        </tr>
                                        <tr>
                                            <td>Alamat</td>
                                            <td>:</td>
                                            <td>{{$datanasabah->alamat}}</td>
                                            <td>Tgl Angsuran</td>
                                            <td>:</td>
                                            <td>{{date('d-m-Y',strtotime($datanasabah->tgl_mulai))}} s/d {{date('d-m-Y',strtotime($datanasabah->tgl_akhir))}}</td>
                                        </tr>
                                        <tr>
                                            <td>Telepon</td>
                                            <td>:</td>
                                            <td>{{$datanasabah->notelp}}</td>
                                            <td>Jangka Waktu</td>
                                            <td>:</td>
                                            <td>{{$datanasabah->lama}} bulan</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row" style="overflow: auto;max-height:500px">
                            <div class="col-sm-12">
                                <table class="table table-bordered" name="histpaymenttable">
                                    <thead>
                                        <col>
                                        <colgroup span="4"></colgroup>
                                        <colgroup span="4"></colgroup>
                                        <colgroup span="1"></colgroup>
                                        <tr>
                                            <th colspan="4" scope="colgroup" align="center">Jadwal</th>
                                            <th colspan="4" scope="colgroup" align="center">Pembayaran</th>
                                            <th colspan="1" scope="colgroup" align="center">Saldo</th>
                                            <th colspan="1" rowspan="3" scope="colgroup" align="center">Denda</th>
                                            <th colspan="1" rowspan="3" scope="colgroup" align="center">Bayar Denda</th>
                                            <th colspan="1" rowspan="3" scope="colgroup" align="center">Catatan</th>
                                        </tr>
                                        <tr>
                                            <th scope="col" align="center">Tanggal</th>
                                            <th scope="col" align="center">Ke</th>
                                            <th scope="col" align="center">Pokok</th>
                                            <th scope="col" align="center">Bunga</th>
                                            <th scope="col" align="center">No Bukti</th>
                                            <th scope="col" align="center">Tgl.Bayar</th>
                                            <th scope="col" align="center">Pokok</th>
                                            <th scope="col" align="center">Bunga</th>
                                            <th scope="col" align="center">Saldo Piutang</th>
                                        </tr>
                                        <tr>
                                            <th colspan="8" scope="col" align="center"></th>
                                            <th scope="col" align="center">{{number_format(($datanasabah->plafon+$datanasabah->bbt),0,'','.')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $spiutang = $datanasabah->plafon+$datanasabah->bbt;
                                            foreach($dataangs as $angs){
                                                //$spiutang -= $angs->pokok+$angs->bunga;
                                                echo '<tr>';
                                                echo '<td class="angsuran'.$angs->bayar_ke.'tgljadwal">'.date('d-m-Y',strtotime($angs->tgl_angsur)).'</td>';
                                                echo '<td class="angsuran'.$angs->bayar_ke.'bayarke">'.$angs->bayar_ke.'</td>';
                                                echo '<td style="display:none;" class="angsuran'.$angs->bayar_ke.'angsuranjadwal">'.number_format(($angs->angs_pokok+$angs->angs_bunga),0,'','.').'</td>';
                                                echo '<td class="angsuran'.$angs->bayar_ke.'pokokjadwal">'.number_format($angs->angs_pokok,0,'','.').'</td>';
                                                echo '<td class="angsuran'.$angs->bayar_ke.'bungajadwal">'.number_format($angs->angs_bunga,0,'','.').'</td>';
                                                if($angs->angs_ke <> ""){
                                                    $spiutang -= $angs->pokok+$angs->bunga;
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'nobukti">'.$angs->angs_nobukti.'</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'tglangsuran">'.date('d-m-Y',strtotime($angs->angs_tgl)).'</td>';
                                                    echo '<td style="display:none;" class="angsuran'.$angs->bayar_ke.'angsurandibayar">'.($angs->pokok+$angs->bunga).'</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'angsurpokok">'.number_format($angs->pokok,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'angsurbunga">'.number_format($angs->bunga,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'saldopiutang">'.number_format($spiutang,0,'','.').'</td>';
                                                    //echo '<td class="angsuran'.$angs->bayar_ke.'saldopiutang">'.number_format($angs->sld_piutang,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'dendakena">'.number_format($angs->dendakena,0,'','.').'</td>';
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'denda">'.number_format($angs->denda,0,'','.').'</td>';
                                                    //$spiutang = $spiutang - ($angs->pokok+$angs->bunga);
                                                } else {
                                                    echo '<td class="angsuran'.$angs->bayar_ke.'nobukti">-</td>';
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
                                                        echo '<td class="angsuran'.$angs->bayar_ke.'catatan">Terlambat <span class="text-danger">'.abs($angs->diff).'</span> hari';
                                                    } elseif($angs->diff < 0){
                                                        echo '<td class="angsuran'.$angs->bayar_ke.'catatan">Cepat '.abs($angs->diff).' hari';
                                                    } elseif($angs->diff == 0) {
                                                        echo '<td class="angsuran'.$angs->bayar_ke.'catatan">Tepat waktu';
                                                    }
                                                    if(($angs->angs_pokok+$angs->angs_bunga) > ($angs->pokok+$angs->bunga)){
                                                        echo ', Belum Penuh</td>';
                                                    } else {
                                                        echo ', Penuh</td>';
                                                    }
                                                } else {
                                                    if(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($angs->tgl_angsur))))->format('%r%a') < 0){
                                                        echo '<td class="angsuran'.$angs->bayar_ke.'catatan">Terlambat '.abs(date_diff(date_create(date('Y-m-d')), date_create(date('Y-m-d',strtotime($angs->tgl_angsur))))->format('%r%a')).' hari</td>';;
                                                    } else {
                                                        echo '<td class="angsuran'.$angs->bayar_ke.'catatan">-</td>';    
                                                    }
                                                }
                                                echo '</tr>';
                                            }
                                        ?>
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
    var CONTENT;
    var SUBM = 0;
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
    function generateNote(i,dd,mm,yyyy)
    {
        var diff = daydiff(parseDate(dd+'-'+mm+'-'+yyyy),parseDate($('.angsuran'+i+'tgljadwal').text()));
                    //console.log(diff);
                    var cat = '';
                    var angsurjadwal = parseFloat($('.angsuran'+i+'pokokjadwal').text().split('.').join(''))+parseFloat($('.angsuran'+i+'bungajadwal').text().split('.').join(''));
                    var angsurkartu = parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))+parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''));
                    if(diff < 0){
                        cat += 'Terlambat '+Math.abs(diff)+' hari, ';
                    } else if(diff > 0) {
                        cat += 'Cepat '+Math.abs(diff)+' hari, ';
                    } else if(diff == 0) {
                        cat += 'Tepat Waktu, ';
                    }
                    if(angsurkartu < angsurjadwal){
                        cat += 'Belum Penuh';
                    } else {
                        cat += 'Penuh';
                    }
                    $('.angsuran'+i+'catatan').text(cat);
                    /*if((i-1) == 0){
                        $('.angsuran'+i+'saldopiutang').text(number_format(("{{$datanasabah->plafon+$datanasabah->bbt}}"-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                    } else {
                        $('.angsuran'+i+'saldopiutang').text(number_format((parseFloat($('.angsuran'+(i-1)+'saldopiutang').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                    }*/
    }

    $(document).ready(function() {
        CONTENT = $('[name="histpaymenttable"]').html();
        //console.log(CONTENT.toString());
        jQuery('[name="histpaymenttable"]').fitText(1, { minFontSize: '10px', maxFontSize: '13px' });

        $('[name="total_bayar"]').text("Rp. {{number_format(($dataangs[$tgk]->sisa_tunggak),0,'','.')}},00");

        $('[name="input_tanggal_transfer"]').datepicker({
            format: 'dd-mm-yyyy',
            autoclose: true
        }).on('changeDate', function(e) {
            // Revalidate the date field
            //alert('sukses');
        });

        $('[name="input_transfer_ke"]').select2({ width: '100%' });
        $('[name="input_transfer_dari"]').select2({ width: '100%' });

        $('[name="printsample"]').click(function(){
            var base_url = $(this).attr('data-url');
            var no_kredit = <?php echo '"'.trim($datanasabah->no_kredit).'"'; ?>;
            window.open(base_url+'/'+no_kredit.toString()+'/'+$('[name="input_jumlah_bayar"]').val().split('.').join(''));
        });
        //$('[name="input_cara_pembayaran"]:checked').val();
        $('[name="input_cara_pembayaran"]').click(function(){
            //alert($('[name="input_cara_pembayaran"]:checked').val());
            //if($('[name="input_cara_pembayaran"]:checked').val() === 'TRANSFER'){
            if(($('[name="input_cara_pembayaran"]:checked').val() === 'NON TUNAI') || ($('[name="input_cara_pembayaran"]:checked').val() === 'TITIPAN')){
                $('.fieldnontunai').show();
            } else {
                $('.fieldnontunai').hide();
            }
        });

        $('[name="input_jumlah_bayar"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="input_jumlah_denda"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        //$('[name="input_jumlah_potongan"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="input_jumlah_potongan_pokok"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="input_jumlah_potongan_bunga"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="input_jumlah_potongan_denda"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

        /*$('[name="input_angsuran_ke_sampai"]').change(function(e){
            if(!isNumber($('[name="input_angsuran_ke_sampai"]').val())){
                $('[name="input_angsuran_ke_sampai"]').val($('[name="input_angsuran_ke"]').val());
            } else {
                if($('[name="input_angsuran_ke_sampai"]').val() > parseInt("{{end($dataangs)->bayar_ke}}")){
                    $('[name="input_angsuran_ke_sampai"]').val($('[name="input_angsuran_ke"]').val());
                }
            }
            var jmlangs = 0;
            for(var x=$('[name="input_angsuran_ke"]').val();x<=$('[name="input_angsuran_ke_sampai"]').val();x++){
                var a = $('[name="input_angsuran_ke"]').val();
                jmlangs += parseFloat($('.angsuran'+x+'angsuranjadwal').text().split('.').join(''))-parseFloat($('.angsuran'+x+'angsurandibayar').text());
            }
            $('#bayar_angsuran').text('Rp. '+number_format(jmlangs,0,'','.')+',00');
            $('[name="input_jumlah_bayar"]').val(number_format(jmlangs,0,'','.'));
        });*/

        $('#bayarangsuranform').on('keyup keypress', function(e) {
            var code = e.keyCode || e.which;
            if (code == 13) { 
                e.preventDefault();
                return false;
            }
        });  
        $('#bayarangsuranform').submit(function(e){
            if(SUBM == 0){
                if(confirm('Apakah anda yakin semua entry sudah benar ?')){
                    SUBM = 1;
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        });
        $('[name="input_bayar_lunas"]').click(function(){
            if($('[name="input_bayar_lunas"]').is(':checked')){
                    $('[name="input_jumlah_pokok"]').val("{{number_format($datanasabah->bakidebet,0,'','.')}}");
                    $('[name="input_jumlah_bunga"]').val("{{number_format($datanasabah->saldo_bbt,0,'','.')}}");
                    $('[name="input_jumlah_total"]').val("{{number_format($datanasabah->saldo_piutang,0,'','.')}}");
                var totaldenda = '{{$totaldenda}}';
                var bayardenda = parseFloat($('[name="input_jumlah_denda"]').val().split('.').join(''));
                $('[name="input_jumlah_potongan_denda"]').val(number_format((totaldenda-bayardenda),0,'','.'));
                //$('#bayarbiayaform').attr("action","{{ url('/kredit/angsuran/lunas/save/'.$datanasabah->no_kredit) }}");
            } else {
                $('[name="input_jumlah_pokok"]').val("{{number_format($totaltunggak['pokok'],0,'','.')}}");
                $('[name="input_jumlah_bunga"]').val("{{number_format($totaltunggak['bunga'],0,'','.')}}");
                $('[name="input_jumlah_total"]').val("{{number_format(($totaltunggak['pokok']+$totaltunggak['bunga']),0,'','.')}}");
                $('[name="input_jumlah_potongan_denda"]').val(0);
            }
        });
        $('[name="input_jumlah_bayar"]').on('change textInput input',function(){
            if($('[name="input_bayar_lunas"]').is(':checked')){
                var saldopokok = parseFloat($('[name="input_jumlah_pokok"]').val().split('.').join(''));
                var saldobunga = parseFloat($('[name="input_jumlah_bunga"]').val().split('.').join(''));
                var jmlbayar = parseFloat($('[name="input_jumlah_bayar"]').val().split('.').join(''));
                if(jmlbayar >= saldopokok){
                    $('[name="input_jumlah_potongan_pokok"]').val(0);
                    $('[name="input_jumlah_potongan_bunga"]').val(number_format((saldobunga-(jmlbayar-saldopokok)),0,'','.'));
                } else {
                    $('[name="input_jumlah_potongan_pokok"]').val(number_format(saldopokok-jmlbayar,0,'','.'));
                    $('[name="input_jumlah_potongan_bunga"]').val(number_format(saldobunga,0,'','.'));
                }
            }
            $('[name="total_bayar"]').text("Rp. "+number_format((parseFloat($('[name="input_jumlah_bayar"]').val().split('.').join(''))+parseFloat($('[name="input_jumlah_denda"]').val().split('.').join(''))),0,'','.')+",00");
        });
        $('[name="input_jumlah_denda"]').on('change textInput input',function(){
            if($('[name="input_bayar_lunas"]').is(':checked')){
                var totaldenda = '{{$totaldenda}}';
                var bayardenda = parseFloat($('[name="input_jumlah_denda"]').val().split('.').join(''));
                $('[name="input_jumlah_potongan_denda"]').val(number_format((totaldenda-bayardenda),0,'','.'));
            }
            $('[name="total_bayar"]').text("Rp. "+number_format((parseFloat($('[name="input_jumlah_bayar"]').val().split('.').join(''))+parseFloat($('[name="input_jumlah_denda"]').val().split('.').join(''))),0,'','.')+",00");
        });

        $('[name="generatesample"]').click(function(){
            $('[name="histpaymenttable"]').empty();
            $('[name="histpaymenttable"]').append(CONTENT);

            //var jmlbayar = parseFloat($('[name="input_jumlah_bayar"]').val().split('.').join(''))+parseFloat($('[name="input_jumlah_potongan"]').val().split('.').join(''));
            var jmlbayar = parseFloat($('[name="input_jumlah_bayar"]').val().split('.').join(''));
            var potpokok = parseFloat($('[name="input_jumlah_potongan_pokok"]').val().split('.').join(''));
            var potbunga = parseFloat($('[name="input_jumlah_potongan_bunga"]').val().split('.').join(''));
            var denda = parseFloat($('[name="input_jumlah_denda"]').val().split('.').join(''))+parseFloat($('[name="input_jumlah_potongan_denda"]').val().split('.').join(''));
            var tunggakke = parseInt("{{$tgk}}");
            var bakidebet = parseFloat("{{$datanasabah->bakidebet}}");

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
            var x = 1;
            while (denda > 0){
                if(($('.angsuran'+x+'dendakena').text().split('.').join('') != 0) && ($('.angsuran'+x+'dendakena').text().split('.').join('') != '-')){
                    if($('.angsuran'+x+'denda').text().split('.').join('') == '-'){
                        var dendabayar = 0;
                    } else {
                        var dendabayar = parseFloat($('.angsuran'+x+'denda').text().split('.').join(''));
                    }
                    var sisadenda = parseFloat($('.angsuran'+x+'dendakena').text().split('.').join('')) - dendabayar;
                    if(denda < sisadenda){
                        $('.angsuran'+x+'denda').text(number_format((dendabayar+denda),0,'','.'));
                        denda = 0;
                    } else {
                        denda -= sisadenda;
                        $('.angsuran'+x+'denda').text($('.angsuran'+x+'dendakena').text());

                    }
                }
                x++;
            }
            while (jmlbayar > 0) {
                /*if($('[name="input_cara_pembayaran"]:checked').val() == "TUNAI"){
                    var tanggal = parseDate(dd+'-'+mm+'-'+yyyy);
                    console.log('TUNAI '+parseDate(dd+'-'+mm+'-'+yyyy));
                } else {
                    var tanggal = parseDate($('[name="input_tanggal_transfer"]').val());
                    console.log('NON TUNAI '+parseDate($('[name="input_tanggal_transfer"]').val()));
                }
                console.log(tanggal);
                console.log(daydiff(tanggal,parseDate($('.angsuran'+i+'tgljadwal').text())));*/
                if(!$('[name="input_bayar_lunas"]').is(':checked')){
                    if(daydiff(parseDate(dd+'-'+mm+'-'+yyyy),parseDate($('.angsuran'+i+'tgljadwal').text())) <= 0){
                        if(parseInt("{{$tgkangsur}}") < 3){
                            var sisabunga = parseFloat($('.angsuran'+i+'bungajadwal').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''));
                            if(jmlbayar < sisabunga){
                                $('.angsuran'+i+'angsurbunga').text(number_format((parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))+jmlbayar),0,'','.'));
                                jmlbayar = 0;
                            } else {
                                jmlbayar -= sisabunga;
                                $('.angsuran'+i+'angsurbunga').text($('.angsuran'+i+'bungajadwal').text());
                            }
                        } else if(parseInt("{{$tgkangsur}}") >= 3){
                            var sisapokok = parseFloat($('.angsuran'+i+'pokokjadwal').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''));
                            if(jmlbayar < sisapokok){
                                $('.angsuran'+i+'angsurpokok').text(number_format((parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))+jmlbayar),0,'','.'));
                                jmlbayar = 0;
                            } else {
                                jmlbayar -= sisapokok;
                                $('.angsuran'+i+'angsurpokok').text($('.angsuran'+i+'pokokjadwal').text());
                            }
                            //$('.angsuran'+i+'angsurpokok').text(i);
                        }
                        generateNote(i,dd,mm,yyyy);
                        if((i-1) == 0){
                            $('.angsuran'+i+'saldopiutang').text(number_format(("{{$datanasabah->plafon+$datanasabah->bbt}}"-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                        } else {
                            $('.angsuran'+i+'saldopiutang').text(number_format((parseFloat($('.angsuran'+(i-1)+'saldopiutang').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                        }
                        
                        i++;    
                    } else if(daydiff(parseDate(dd+'-'+mm+'-'+yyyy),parseDate($('.angsuran'+j+'tgljadwal').text())) <= 0){
                        if(parseInt("{{$tgkangsur}}") < 3){
                            var sisapokok = parseFloat($('.angsuran'+j+'pokokjadwal').text().split('.').join(''))-parseFloat($('.angsuran'+j+'angsurpokok').text().split('.').join(''));

                            if(jmlbayar < sisapokok){
                                $('.angsuran'+j+'angsurpokok').text(number_format((parseFloat($('.angsuran'+j+'angsurpokok').text().split('.').join(''))+jmlbayar),0,'','.'));
                                jmlbayar = 0;
                            } else {
                                jmlbayar -= sisapokok;
                                $('.angsuran'+j+'angsurpokok').text($('.angsuran'+j+'pokokjadwal').text());
                            }
                        } else if(parseInt("{{$tgkangsur}}") >= 3){
                            var sisabunga = parseFloat($('.angsuran'+j+'bungajadwal').text().split('.').join(''))-parseFloat($('.angsuran'+j+'angsurbunga').text().split('.').join(''));
                            
                            if(jmlbayar < sisabunga){
                                $('.angsuran'+j+'angsurbunga').text(number_format((parseFloat($('.angsuran'+j+'angsurbunga').text().split('.').join(''))+jmlbayar),0,'','.'));
                                jmlbayar = 0;
                            } else {
                                jmlbayar -= sisabunga;
                                $('.angsuran'+j+'angsurbunga').text($('.angsuran'+j+'bungajadwal').text());
                            }
                        }
                        generateNote(j,dd,mm,yyyy);
                        if((j-1) == 0){
                            $('.angsuran'+j+'saldopiutang').text(number_format(("{{$datanasabah->plafon+$datanasabah->bbt}}"-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+j+'angsurbunga').text().split('.').join(''))),0,'','.'));
                        } else {
                            $('.angsuran'+j+'saldopiutang').text(number_format((parseFloat($('.angsuran'+(j-1)+'saldopiutang').text().split('.').join(''))-parseFloat($('.angsuran'+j+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+j+'angsurbunga').text().split('.').join(''))),0,'','.'));
                        }
                        j++;    
                    } else {
                        var sisabunga = parseFloat($('.angsuran'+i+'bungajadwal').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''));
                        if(jmlbayar < sisabunga){
                            $('.angsuran'+i+'angsurbunga').text(number_format((jmlbayar+parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                            jmlbayar = 0;
                        } else {
                            $('.angsuran'+i+'angsurbunga').text($('.angsuran'+i+'bungajadwal').text());
                            jmlbayar -= sisabunga;
                            var sisapokok = parseFloat($('.angsuran'+i+'pokokjadwal').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''));
                            if(jmlbayar < sisapokok){
                                $('.angsuran'+i+'angsurpokok').text(number_format((jmlbayar+parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))),0,'','.'));
                                jmlbayar = 0;
                            } else {
                                $('.angsuran'+i+'angsurpokok').text($('.angsuran'+i+'pokokjadwal').text());
                                jmlbayar -= sisapokok;
                            }
                        }
                        generateNote(i,dd,mm,yyyy);
                        if((i-1) == 0){
                            $('.angsuran'+i+'saldopiutang').text(number_format(("{{$datanasabah->plafon+$datanasabah->bbt}}"-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                        } else {
                            $('.angsuran'+i+'saldopiutang').text(number_format((parseFloat($('.angsuran'+(i-1)+'saldopiutang').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                        }
                        //$('.angsuran'+i+'saldopiutang').text(number_format((parseFloat($('.angsuran'+(i-1)+'saldopiutang').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                        i++;
                    }
                } else {
                    var sisapokok = parseFloat($('.angsuran'+i+'pokokjadwal').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''));
                    /*if(sisapokok != 0){
                        if(jmlbayar < sisapokok){
                            $('.angsuran'+i+'angsurpokok').text(number_format((jmlbayar+parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))),0,'','.'));
                            jmlbayar = 0;
                        } else {
                            $('.angsuran'+i+'angsurpokok').text($('.angsuran'+i+'pokokjadwal').text());
                            jmlbayar -= sisapokok;
                        }
                    } else {
                        var sisabunga = parseFloat($('.angsuran'+i+'bungajadwal').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''));
                        if(jmlbayar < sisabunga){
                            $('.angsuran'+i+'angsurbunga').text(number_format((parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))+jmlbayar),0,'','.'));
                            jmlbayar = 0;
                        } else {
                            jmlbayar -= sisabunga;
                            $('.angsuran'+i+'angsurbunga').text($('.angsuran'+i+'bungajadwal').text());
                        }
                    }*/
                    if(bakidebet > 0){
                        var sisapokok = parseFloat($('.angsuran'+i+'pokokjadwal').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''));
                        if(jmlbayar < sisapokok){
                            $('.angsuran'+i+'angsurpokok').text(number_format((jmlbayar+parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))),0,'','.'));
                            jmlbayar = 0;
                            bakidebet -= jmlbayar;
                        } else {
                            $('.angsuran'+i+'angsurpokok').text($('.angsuran'+i+'pokokjadwal').text());
                            jmlbayar -= sisapokok;
                            bakidebet -= sisapokok;
                        }
                        generateNote(i,dd,mm,yyyy);
                        if((i-1) == 0){
                            $('.angsuran'+i+'saldopiutang').text(number_format(("{{$datanasabah->plafon+$datanasabah->bbt}}"-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                        } else {
                            $('.angsuran'+i+'saldopiutang').text(number_format((parseFloat($('.angsuran'+(i-1)+'saldopiutang').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                        }
                        if(bakidebet == 0){
                            i = parseInt("{{$tgk}}");
                        } else {
                            i++;
                        }
                    } else {
                        var sisabunga = parseFloat($('.angsuran'+i+'bungajadwal').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''));
                        if(jmlbayar < sisabunga){
                            $('.angsuran'+i+'angsurbunga').text(number_format((parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))+jmlbayar),0,'','.'));
                            jmlbayar = 0;
                        } else {
                            jmlbayar -= sisabunga;
                            $('.angsuran'+i+'angsurbunga').text($('.angsuran'+i+'bungajadwal').text());
                        }
                        generateNote(i,dd,mm,yyyy);
                        if((i-1) == 0){
                            $('.angsuran'+i+'saldopiutang').text(number_format(("{{$datanasabah->plafon+$datanasabah->bbt}}"-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                        } else {
                            $('.angsuran'+i+'saldopiutang').text(number_format((parseFloat($('.angsuran'+(i-1)+'saldopiutang').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                        }
                        i++;
                    }
                }
            }
            //console.log(daydiff(parseDate('01-03-2016'),parseDate('21-01-2016')));
            i = parseInt("{{$tgk}}");
            while(potpokok > 0){
                var sisapokok = parseFloat($('.angsuran'+i+'pokokjadwal').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''));
                if(sisapokok == 0){
                    i++;
                } else {
                    if(potpokok < sisapokok){
                        $('.angsuran'+i+'angsurpokok').text(number_format((parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))+potpokok),0,'','.'));
                        potpokok = 0;
                    } else {
                        potpokok -= sisapokok;
                        $('.angsuran'+i+'angsurpokok').text($('.angsuran'+i+'pokokjadwal').text());
                    }
                    generateNote(i,dd,mm,yyyy);
                    if((i-1) == 0){
                        $('.angsuran'+i+'saldopiutang').text(number_format(("{{$datanasabah->plafon+$datanasabah->bbt}}"-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                    } else {
                        $('.angsuran'+i+'saldopiutang').text(number_format((parseFloat($('.angsuran'+(i-1)+'saldopiutang').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                    }
                    i++;
                }
            }
            i = parseInt("{{$tgk}}");
            while(potbunga > 0){
                var sisabunga = parseFloat($('.angsuran'+i+'bungajadwal').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''));
                if(sisabunga == 0){
                    i++;
                } else {
                    if(potbunga < sisabunga){
                        $('.angsuran'+i+'angsurbunga').text(number_format((parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))+potbunga),0,'','.'));
                        potbunga = 0;
                    } else {
                        potbunga -= sisabunga;
                        $('.angsuran'+i+'angsurbunga').text($('.angsuran'+i+'bungajadwal').text());
                    }
                    generateNote(i,dd,mm,yyyy);
                    if((i-1) == 0){
                        $('.angsuran'+i+'saldopiutang').text(number_format(("{{$datanasabah->plafon+$datanasabah->bbt}}"-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                    } else {
                        $('.angsuran'+i+'saldopiutang').text(number_format((parseFloat($('.angsuran'+(i-1)+'saldopiutang').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurpokok').text().split('.').join(''))-parseFloat($('.angsuran'+i+'angsurbunga').text().split('.').join(''))),0,'','.'));
                    }
                    i++;
                }
            }
        }); 
    });
</script>
@endsection
