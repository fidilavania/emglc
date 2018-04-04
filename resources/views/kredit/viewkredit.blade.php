@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="panelkredit">
             <form class="form-horizontal" id="viewkreditform" role="form" >
                <!-- <div class="panel-heading"><h4 align="center">DETAIL DATA</h4></div> -->
                <div style="border: 15px outset #2a4aeb; height: 70px; text-align: center; width: 1140px;"><h4 align="center">DETAIL DATA</h4></div>
                    <div class="panel-body nav-tabs-animate">
                        <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                            <li class="active" role="presentation"><a data-toggle="tab" href="#kredit" aria-controls="kredit" role="tab">KREDIT</a><i class="fa"></i></li>
                            <li  role="presentation"><a data-toggle="tab" href="#datapenjamin" aria-controls="datapenjamin" role="tab">PENJAMIN</a><i class="fa"></i></li>
                            <li  role="presentation"><a data-toggle="tab" href="#agsertifikat" aria-controls="agsertifikat" role="tab">AGUNAN SERTIFIKAT</a><i class="fa"></i></li>
                            <li  role="presentation"><a data-toggle="tab" href="#agkendaraan" aria-controls="agkendaraan" role="tab">AGUNAN KENDARAAN</a><i class="fa"></i></li>
                            <li  role="presentation"><a data-toggle="tab" href="#alberat" aria-controls="alberat" role="tab">ALAT BERAT</a><i class="fa"></i></li>
                            <li  role="presentation"><a data-toggle="tab" href="#lapuang" aria-controls="lapuang" role="tab">LAPORAN KEUANGAN</a><i class="fa"></i></li>
                            <li  role="presentation"><a data-toggle="tab" href="#pengurus" aria-controls="pengurus" role="tab">PENGURUS</a><i class="fa"></i></li>
                        </ul>
                        <div class="tab-content">                          
                            <!-- fill nasabah -->
                            <div class="row" style="background-color: #ffffcc">
                                    <div class="col-sm-12" >
                                    @foreach($prekredit as $p)
                                        <div class="col-sm-6" >
                                            <br>
                                            <div class="row form-group">
                                                <div class="col-sm-6">
                                                    <b>Data Nasabah</b>
                                                </div>
                                            </div>
                                             <div class="row form-group">
                                                <div class="col-sm-6">
                                                    <b>Nama : {{$p->nama}}</b>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-12">
                                                    <b>Alamat : {{$p->alamat}} RT/RW {{$p->rtrw}} {{$p->desa}} {{$p->camat}}</b>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-12">
                                                    <b>No. Telepon : {{$p->notelp}} / {{$p->nohp}} </b>
                                                </div>
                                            </div>
                                            
                                        </div>

                                    @endforeach
                                    </div>
                                </div>
                                 <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/> 
                                <br>
                    <fieldset class="tab-pane active animation-slide-left" id="kredit" role="tabpanel">
                    <div class="panel panel-bordered">
                            <div class="panel-body">
                            @foreach($daftar as $daf)
                                @if(($daf->tgl_hapusint != '1900-01-01 00:00:00')||($daf->tgl_hapusbi != '1900-01-01 00:00:00'))
                                <div class="row" data-id="{{$daf->no_kredit}}">
                                    <div class="col-sm-12">
                                        <div class="col-sm-6">
                                            <div class="row form-group">
                                                <div class="col-sm-6">
                                                    <b>Tanggal Hapus Intern :</b>
                                                </div>
                                                <div class="col-sm-6">
                                                   {{date('d-m-Y',strtotime($daf->tgl_hapusint))}}
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-6">
                                                    <b>Nomor Hapus Intern :</b>
                                                </div>
                                                <div class="col-sm-6">
                                                   {{$daf->no_hapusint}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row form-group">
                                                <div class="col-sm-6">
                                                    <b>Tanggal Hapus BI :</b>
                                                </div>
                                                <div class="col-sm-6">
                                                   {{date('d-m-Y',strtotime($daf->tgl_hapusbi))}}
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-6">
                                                    <b>Nomor Hapus BI :</b>
                                                </div>
                                                <div class="col-sm-6">
                                                   {{$daf->no_hapusbi}}
                                                </div>
                                            </div>
                                            <div class="row form-group" hidden>
                                                <div class="col-sm-6">
                                                    <b>Nomor Kredit :</b>
                                                </div>
                                                <div class="col-sm-6">
                                                    {{$daf->no_kredit}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                @endif
                            @endforeach
                                    
                                     @foreach($daftar as $daf)
                                      @if(($daf->tgl_hapusint != '1900-01-01 00:00:00')||($daf->tgl_hapusbi != '1900-01-01 00:00:00'))
                                            <div hidden="text"  data-id="{{$daf->no_kredit}}">
                                                <div class="col-sm-1">
                                                    <div class="col-sm-6"><b>Nomor Kredit :</b></div>
                                                    <div class="col-sm-6"> {{$daf->no_kredit}}</div>
                                                </div>
                                            </div>
                                                 <div class="col-sm-6"><br>
                                                    <!-- <input type="button" class="btn btn-danger" name="aden" value="ADDENDUM_KREDIT" /> -->
                                                <!-- </div> -->
                                    <!-- <div class="class-col-sm-3"> -->
                                        <!-- <input type="button" class="btn btn-danger" name="aden" value="ADDENDUM_KREDIT" /> -->
                                        <input type="button" class="btn btn-warning" name="hapus" value="HAPUS BUKU">
                                    </div>
                                    @endif
                                   
                                    @endforeach
                                    @foreach($daftar as $daf)
                                     @if(($daf->tgl_hapusint == '1900-01-01 00:00:00')||($daf->tgl_hapusbi == '1900-01-01 00:00:00'))
                                         <div class="row" data-id="{{$daf->no_kredit}}" >
                                            <div class="col-sm-6" style="background-color: #c0c0c0">
                                                    <?php
                                                    echo '<div class="panel-heading"><b>DAFTAR KREDIT BIAYA</b></div>';
                                                        foreach ($biaya as $bi) {
                                                            switch (trim($bi->biaya,' ')) {
                                                                case 'adm':
                                                                    echo '<div class="col-sm-6 ">Biaya administrasi</div> Rp.'.number_format($bi->jml,0,'','.').',00<br />';
                                                                    break;
                                                                case 'provisi':
                                                                    echo '<div class="col-sm-6 ">Biaya provisi</div> Rp. </label>'.number_format($bi->jml,0,'','.').',00<br />';
                                                                    break;
                                                                case 'notaris':
                                                                    echo '<div class="col-sm-6 ">Biaya notaris</div> Rp. </label>'.number_format($bi->jml,0,'','.').',00<br />';
                                                                    break;
                                                                case 'polis':
                                                                    echo '<div class="col-sm-6 ">Biaya polis</div> Rp. </label>'.number_format($bi->jml,0,'','.').',00<br />';
                                                                    break;
                                                                case 'ass':
                                                                    echo '<div class="col-sm-6 ">Biaya asuransi agunan</div> Rp. </label>'.number_format($bi->jml,0,'','.').',00<br />';
                                                                    break;
                                                                case 'assjiwa':
                                                                    echo '<div class="col-sm-6 ">Biaya asuransi jiwa</div> Rp. </label>'.number_format($bi->jml,0,'','.').',00<br />';
                                                                    break;
                                                                case 'feemitra':
                                                                    echo '<div class="col-sm-6 ">Biaya fee agen</div> Rp. </label>'.number_format($bi->jml,0,'','.').',00<br />';
                                                                    break;
                                                                case 'lain':
                                                                    echo '<div class="col-sm-6 ">Biaya lain-lain</div> Rp. </label>'.number_format($bi->jml,0,'','.').',00<br />';
                                                                    break;
                                                                 // case 'fudisia':
                                                                 //    echo '<label>Biaya Fudisia Rp. </label>'.number_format($bi->jml,0,'','.').',00<br />';
                                                                 //    break;
                                                            }
                                                        }
                                                    ?>
                                            </div>
                                        </div>
                                        <br><br>
                                        <div class="row" data-id="{{$daf->no_kredit}}">
                                            <div class="col-sm-12">  
                                                <div class="col-sm-6">
                                                    <div class="row form-group">
                                                        <div class="col-sm-6">
                                                        <b>Operator</b>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        : {{$daf->opr}}
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-6">
                                                        <b>Nomor Kredit </b>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        : {{$daf->no_kredit}}
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-6">
                                                        <b>Nomor NPP </b>
                                                        </div>
                                                        <div class="col-sm-6">
                                                        : {{$daf->no_ref}}
                                                        </div>
                                                    </div>
                                                    @foreach($lihat1 as $l)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6"> <b>Kode Sifat Kredit </b> </div>
                                                        <div class="col-sm-6">: {{$l->kode}} - {{$l->note}}</div>
                                                    </div>
                                                    @endforeach
                                                    @foreach($lihat2 as $l)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Kode Jenis Kredit </b></div>
                                                        <div class="col-sm-6">: {{$l->sandi}} - {{$l->nama}}</div>
                                                    </div>
                                                    @endforeach
                                                    @foreach($lihat3 as $ll)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Kode Skim </b></div>
                                                        <div class="col-sm-6">: {{$ll->kode}} - {{$ll->skim}}
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    <!-- <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Nomor Akad Awal </b></div>
                                                        <div class="col-sm-6">                                        
                                                            {{$daf->no_mohon}}
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Tanggal Akad Awal </b></div>
                                                        <div class="col-sm-6">
                                                         {{date('d-m-Y',strtotime($daf->tgl_mhn))}}
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Nomor Akad Akhir </b></div>
                                                        <div class="col-sm-6">
                                                            {{$daf->no_mohon_akhir}}
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Tanggal Akad Akhir </b></div>
                                                        <div class="col-sm-6">
                                                         {{date('d-m-Y',strtotime($daf->tgl_mohon_akhir))}}
                                                        </div>
                                                    </div> -->
                                                    @foreach($lihat4 as $l)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Kode Kategori Debitur </b></div>
                                                        <div class="col-sm-6">
                                                       : {{$l->sandi}} - {{$l->nama}}
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @foreach($lihat5 as $l)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Kode Jenis Penggunaan </b></div>
                                                        <div class="col-sm-6">
                                                        : {{$l->kode}} - {{$l->jns_penggunaan}}
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @foreach($lihat6 as $l)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Kode Orientasi Penggunaan </b></div>
                                                        <div class="col-sm-6">
                                                           : {{$l->kode}} - {{$l->jenis_penggunaan}}
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @foreach($lihat7 as $l)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Kode Sektor Ekonomi </b></div>
                                                        <div class="col-sm-6">
                                                            : {{$l->kode}} - {{$l->sektor_eko}}                                   
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @foreach($lihat8 as $l)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Kode Kab/Kota </b></div>
                                                        <div class="col-sm-6">: 
                                                            {{$l->desc1}} - {{$l->desc2}}
                                                    </div>
                                                    </div>
                                                    @endforeach
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Kode Valuta </b></div>
                                                        @if($daf->valuta == 'IDR')
                                                        <div class="col-sm-6">: IDR - Indonesian Rupiah</div>
                                                        @elseif($daf->valuta != 'IDR')
                                                        <div class="col-sm-6">: {{$daf->valuta}}</div>
                                                        @endif
                                                    </div>
                                                    @foreach($lihat9 as $l)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Jenis Suku Bunga </b></div>
                                                        <div class="col-sm-6">: 
                                                            {{$l->sadi}} - {{$l->bunga}}
                                                         </div>
                                                    </div>
                                                    @endforeach
                                                    @foreach($lihat10 as $l)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Kredit Program Pemerintah </b></div>
                                                        <div class="col-sm-6">: 
                                                            {{$l->sandi}} - {{$l->fas}}
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                                <div class="col-sm-6">
                                                    @foreach($lihat11 as $l)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Sumber Dana </b></div>
                                                        <div class="col-sm-6">: 
                                                           {{$l->sandi}} - {{$l->nama}}
                                                        </div>
                                                    </div>
                                                     @endforeach
                                                     @foreach($lihat12 as $l)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Takeover dari </b></div>
                                                        <div class="col-sm-6">: 
                                                           {{$l->kode}} - {{$l->nama}}
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    @foreach($lihat13 as $ll)
                                                     <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Kode Kolekbilitas </b></div>
                                                        <div class="col-sm-6">: 
                                                            {{$ll->sandi}} - {{$ll->nama}}
                                                        </div>
                                                    </div> 
                                                    @endforeach
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Tanggal Macet </b></div>
                                                        @if($daf->tgl_macet == '1970-01-01 00:00:00')
                                                        <div class="col-sm-6">: -</div>
                                                        @elseif($daf->tgl_macet == '1970-01-01')
                                                        <div class="col-sm-6">: -</div>
                                                        @elseif($daf->tgl_macet == '1900-01-01 00:00:00')
                                                        <div class="col-sm-6">: -</div>
                                                        @elseif($daf->tgl_macet == '')
                                                        <div class="col-sm-6">: -</div>
                                                        @else
                                                        <div class="col-sm-6">: {{date('d-m-Y',strtotime($daf->tgl_macet))}}
                                                        </div>
                                                        @endif
                                                    </div>
                                                     @foreach($lihat14 as $l)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Kode Sebab Macet </b></div>
                                                        <div class="col-sm-6">: 
                                                           {{$l->kode}} - {{$l->sbb_macet}}
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Frekuensi Tunggakan </b></div>
                                                        <div class="col-sm-6">: 
                                                            {{$daf->frektunggak}}
                                                        </div>
                                                    </div>  
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Frekuensi Restrukturisasi </b></div>
                                                        <div class="col-sm-6">: 
                                                           {{$daf->frekres}}
                                                        </div>
                                                    </div> 
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 " ><b>Tanggal Restrukturisasi Awal </b></div>
                                                        @if($daf->tgl_resawal == '1970-01-01 00:00:00')
                                                        <div class="col-sm-6">: -</div>
                                                        @elseif($daf->tgl_resawal == '1970-01-01')
                                                        <div class="col-sm-6">: -</div>
                                                        @elseif($daf->tgl_resawal == '')
                                                        <div class="col-sm-6">: -</div>
                                                        @else
                                                        <div class="col-sm-6">: {{date('d-m-Y',strtotime($daf->tgl_resawal))}}
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Tanggal Restrukturisasi Akhir </b></div>
                                                         @if($daf->tgl_resakhir == '1970-01-01 00:00:00')
                                                        <div class="col-sm-6">: -</div>
                                                         @elseif($daf->tgl_resakhir == '1970-01-01')
                                                        <div class="col-sm-6">: -</div>
                                                        @elseif($daf->tgl_resakhir == '')
                                                        <div class="col-sm-6">: -</div>
                                                        @else
                                                        <div class="col-sm-6">: {{date('d-m-Y',strtotime($daf->tgl_resakhir))}}
                                                        </div>
                                                        @endif
                                                    </div>
                                                     @foreach($lihat15 as $l)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Kode Cara Restrukturisasi </b></div>
                                                        <div class="col-sm-6">: 
                                                             {{$l->kode}} - {{$l->cara}}                                   
                                                        </div>
                                                    </div>  
                                                    @endforeach
                                                    @foreach($lihat16 as $l)
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Kode Kondisi </b></div>
                                                        <div class="col-sm-6">: 
                                                            {{$l->kode}} - {{$l->nama}}
                                                        </div>
                                                    </div>  
                                                    @endforeach
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Tanggal Kondisi </b></div>
                                                         @if($daf->tgl_kondisi == '')
                                                        <div class="col-sm-6">: -</div>
                                                         @elseif($daf->tgl_kondisi == '1970-01-01')
                                                        <div class="col-sm-6">: -</div>
                                                        @else
                                                        <div class="col-sm-6">: {{date('d-m-Y',strtotime($daf->tgl_kondisi))}}</div>
                                                        @endif
                                                    </div>                              
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Keterangan </b></div>
                                                        <div class="col-sm-6">: 
                                                            {{$daf->ket}}
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 "><b>Kode Kantor Cabang </b></div>  
                                                        @if ($daf->kode_kantor == 00)
                                                        <div class="col-sm-6">: 00 - MALANG</div>
                                                        @elseif ($daf->kode_kantor == 02)
                                                        <div class="col-sm-6">: 02 - BATU</div>
                                                        @elseif ($daf->kode_kantor == 01)
                                                        <div class="col-sm-6">: 01 - KEPANJEN</div>
                                                        @elseif ($daf->kode_kantor == 03)
                                                        <div class="col-sm-6">: 03 - SURABAYA</div>
                                                        @elseif ($daf->kode_kantor == 10)
                                                        <div class="col-sm-6">: 10 - KEDIRI</div>
                                                        @elseif ($daf->kode_kantor == 05)
                                                        <div class="col-sm-6">: 05 - DINOYO</div>
                                                        @else
                                                        <div class="col-sm-6">: {{$daf->kode_kantor}}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                         
                                        
                                        <div class="panel-heading"><h4 align="center">DATA KREDIT NASABAH</h4></div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                            
                                            <div class="col-sm-6">
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 ">Jenis Kredit</div>
                                                        <div class="col-sm-6">
                                                        @if($daf->arav == 'AR')
                                                            <input class="form-control" name="input_jeniskredit"  value="ARREAR" readonly />
                                                        @elseif($daf->arav == 'AV')
                                                        <input class="form-control" name="input_jeniskredit"  value="ADVANCE" readonly />
                                                        @else
                                                        <input class="form-control" name="input_jeniskredit"  value="{{$daf->arav}}" readonly />
                                                        @endif
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 ">Produk Kredit</div>
                                                        <div class="col-sm-6">
                                                            <input class="form-control" name="input_jenisproduk"  value="{{$daf->sistem}}" readonly />
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-6">
                                                            <div class="control-div" for="inputJangkaWaktuPembayaran">Pembayaran Pokok Tiap</div> 
                                                          </div>
                                                          <div class="col-sm-6">
                                                            <div class="input-group">
                                                              <input type="text" class="form-control" name="input_jangkawaktu_pembayaran" autocomplete="off" value="{{$daf->jangka}}" readonly />
                                                              <span class="input-group-addon">bulan</span>
                                                            </div>
                                                          </div>
                                                        </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 ">Jangka Waktu</div>
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                <input type='text' class="form-control" name="input_lama" autocomplete="off"  value="{{$daf->lama}}" style="text-transform:uppercase;" readonly  />
                                                                <span class="input-group-addon">bulan</span>
                                                                </div>
                                                            </div>
                                                    </div> 
                                                    <div class="row form-group">
                                                        <div class="col-sm-6 ">Nilai Proyek</div>
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">Rp.</span>
                                                                        <input type='text' class="form-control" name="input_nilaiproyek" autocomplete="off" value="{{number_format($daf->nilaiproyek,0,'','.')}}" readonly required />
                                                                    </div>                                        
                                                            </div>
                                                    </div>                                               
                                            </div>
                                            <div class="col-sm-6">
                                                    <div class="row form-group">
                                                        <div class="col-sm-6">Dp</div>
                                                            <div class="col-sm-6">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon">Rp.</span>
                                                                        <input type='text' class="form-control" name="input_nilaiproyek" autocomplete="off" value="{{number_format($daf->dp,0,'','.')}}" readonly required />
                                                                    </div>                                        
                                                            </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-6">Baki Debet</div>
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">Rp.</span>
                                                                <input type='text' class="form-control" id="inputbaki" name="input_baki" autocomplete="off" value="{{number_format($daf->bakidebet,0,'','.')}}" readonly  />
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-6">Plafon Awal</div>
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">Rp.</span>
                                                                <input type='text' class="form-control" name="input_plafon" autocomplete="off" value="{{number_format($daf->plafon,0,'','.')}}" readonly required />
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    <div class="row form-group">
                                                        <div class="col-sm-6">Pinjaman Pokok</div>
                                                        <div class="col-sm-6">
                                                            <div class="input-group">
                                                                <span class="input-group-addon">Rp.</span>
                                                                <input type='text' class="form-control" name="input_pinjm_pokok" autocomplete="off" value="{{number_format($daf->pinj_pokok,0,'','.')}}" required readonly />
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    <div class="row form-group">
                                                        <div class="col-sm-6">Suku Bunga</div>
                                                         <div class="col-sm-6">
                                                         @if($daf->sistem == 'FLAT       ')
                                                            <div class="input-group">
                                                                <input type='text' class="form-control" name=name="input_bunga_per_tahun" autocomplete="off" value="{{$daf->pinj_prsbunga}}" readonly required />
                                                                <span class="input-group-addon">% / tahun</span>
                                                            </div>
                                                        @else
                                                            <div class="input-group">
                                                                <input type='text' class="form-control" name=name="input_bunga_per_tahun" autocomplete="off" value="{{$daf->pinj_prsbunga}}" readonly required />
                                                                <span class="input-group-addon">% </span>
                                                            </div>
                                                        @endif
                                                        </div>
                                                    </div>  
                                                    <br><br>
                                                    </div>
                                            </div>

                                        
                                            <!--Panel Tabel Pembayaran -->
                                           
                                        <div class="panel-heading"><h4 align="center">TABEL PEMBAYARAN</h4></div>
                                                <div class="col-sm-12">
                                                    <div class="col-sm-6">
                                                        <div class="row form-group">
                                                          <div class="col-sm-6">
                                                            <div class="control-div" for="">Angsuran Pokok</div>
                                                          </div>
                                                          <div class="col-sm-6">
                                                            <div class="input-group">
                                                              <span class="input-group-addon">Rp.</span>
                                                              <input type="text" class="form-control" id="inputAngsuranPokok" name="input_angsuran_pokok" autocomplete="off" value="{{number_format($daf->angsur_pokok,0,'','.')}}" readonly />
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="row form-group">
                                                          <div class="col-sm-6">
                                                            <div class="control-div" for="">Angsuran Bunga</div>
                                                          </div>
                                                          <div class="col-sm-6">
                                                            <div class="input-group">
                                                              <span class="input-group-addon">Rp.</span>
                                                              <input type="text" class="form-control" id="inputAngsuranBunga" name="input_angsuran_bunga" autocomplete="off" value="{{number_format($daf->angsur_bunga,0,'','.')}}" readonly/>
                                                            </div>
                                                          </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-sm-6 ">BBT</div>
                                                                <div class="col-sm-6">
                                                                    <div class="input-group">
                                                                            <span class="input-group-addon">Rp.</span>
                                                                            <input type='text' class="form-control" name="input_bbt" autocomplete="off" value="{{number_format($daf->bbt,0,'','.')}}" readonly required />
                                                                    </div>
                                                                </div>
                                                            </div>  
                                                        <div class="row form-group">
                                                            <div class="col-sm-6 ">Saldo Piutang</div>
                                                                <div class="col-sm-6">
                                                                    <div class="input-group">
                                                                            <span class="input-group-addon">Rp.</span>
                                                                            <input type='text' class="form-control" name="input_saldo_piutang" autocomplete="off" value="{{number_format($daf->pinj_pokok+$daf->bbt,0,'','.')}}" required readonly />
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="row form-group">
                                                            <div class="col-sm-6 ">Tanggal NPP Kredit</div>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control" name='input_tgl_kredit' value="{{date('d-m-Y',strtotime($daf->tgl_kredit))}}" readonly>
                                                                </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-sm-6 ">Tanggal Mulai Angsuran</div>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control" name='input_tgl_mulai' value="{{date('d-m-Y',strtotime($daf->tgl_mulai))}}" readonly>
                                                                </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-sm-6 ">Tanggal Jatuh Tempo Angsuran</div>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control" name='input_tgl_akhir' value="{{date('d-m-Y',strtotime($daf->tgl_akhir))}}" readonly>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                     @endif
                                      @if(($daf->tgl_hapusint == '1900-01-01 00:00:00')||($daf->tgl_hapusbi == '1900-01-01 00:00:00'))
                                      
                                            <div hidden="text"  data-id="{{$daf->no_kredit}}">
                                                <div class="col-sm-1">
                                                    <div class="col-sm-6"><b>Nomor Kredit :</b></div>
                                                    <div class="col-sm-6"> {{$daf->no_kredit}}</div>
                                                </div>
                                            </div>
                                           
                                                 <div class="col-sm-row"><br>
                                                  @if(strpos(Auth::user()->fungsi, '2525') !== false)
                                                    <input type="button" class="btn btn-danger" name="aden" value="ADDENDUM_KREDIT" />
                                               
                                        <input type="button" class="btn btn-warning" name="hapus" value="HAPUS BUKU">
                                            @endif
                                         <input type="button" class="btn btn-primary" name="hapus" value="CETAK HISTORY PAYMENT">
                                          <input type="button" class="btn btn-primary" name="hapus" value="CETAK JADWAL">
                                          <input type="button" class="btn btn-primary" name="hapus" value="CETAK KARTU PEMBAYARAN">
                                    @if(strpos(Auth::user()->fungsi, '2525') !== false)
                                          <input type="button" class="btn btn-primary" name="hapus" value="PERBANDINGAN">
                                    @endif
                                          <br><br>
                                    </div>
                                    @endif
                                    @endforeach

                                   
                                    </div><br>
                                           <div class="row" style="overflow: auto;max-height:500px">
                                                <div class="col-sm-12">

                                    <!-- ada bagian yang di hapus. dimasukkan di notepad -->

                            </div>
                        </div>
                    </fieldset>

                        <fieldset class="tab-pane animation-slide-left" id="datapenjamin" role="tabpanel">
                                <div class="panel panel-bordered">
                                    <div class="panel-body">
                                    @foreach($jamin as $jam)
                                        <div class="row" datapen-id="{{$jam->no_kredit}}" >
                                            <div class="col-sm-12">  
                                                <div class="col-sm-6">
                                                    <div class="row form-group">
                                                        <div class="col-sm-3">
                                                        <b>Operator:</b>
                                                        </div>
                                                        <div class="col-sm-9">
                                                        {{$jam->opr}}
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-3">
                                                        <b>Nomor Kredit :</b>
                                                        </div>
                                                        <div class="col-sm-9">
                                                        {{$jam->no_kredit}}
                                                        </div>
                                                    </div>
                                                    @foreach($daftar as $daf)
                                                     <div class="row form-group">
                                                        <div class="col-sm-3">
                                                            <b>Nomor NPP :</b>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            {{$daf->no_ref}}
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                    <!-- <div class="row form-group">
                                                        <div class="col-sm-3"><b>Nomor Nasabah:</b></div>
                                                        <div class="col-sm-9">{{$jam->no_nsb}}
                                                        </div>
                                                    </div> -->
                                                    <!-- <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Nomor Kredit</label>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="input_nm_penjamin" autocomplete="off" value="{{$jam->no_kredit}}" style="text-transform:uppercase;"  readonly />
                                                        </div>
                                                    </div> -->
                                                    <div class="row form-group">
                                                        <div class="col-sm-3 ">Nama Penjamin</div>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="input_nm_penjamin" autocomplete="off" value="{{$jam->nm_penjamin}}" style="text-transform:uppercase;"  readonly/>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-3 ">Kode Golongan Penjamin</div>
                                                        @if($jam->goldeb == 9000)
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="input_kode_gol_Penjamin" value="Perseorangan (Penduduk)" style="text-transform:uppercase;" readonly />
                                                        </div>
                                                        @else
                                                         <div class="col-sm-9">
                                                        <input class="form-control" name="input_kode_gol_Penjamin" value="{{$jam->goldeb}}" style="text-transform:uppercase;" readonly /></div>
                                                        @endif
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-3 ">Kode Jenis Identitas Penjamin</div>
                                                        @if($jam->idpenjamin == "1")
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="input_kode_jns_idPenjamin" autocomplete="off" value="KTP" style="text-transform:uppercase;" readonly/>
                                                        </div>
                                                        @elseif ($jam->idpenjamin == "2")
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="input_kode_jns_idPenjamin" autocomplete="off" value="PASPOR" style="text-transform:uppercase;" readonly/>
                                                        </div>
                                                        @elseif ($jam->idpenjamin == "3")
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="input_kode_jns_idPenjamin" autocomplete="off" value="npwp" style="text-transform:uppercase;" readonly/>
                                                        </div>
                                                        @else
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="input_kode_jns_idPenjamin" style="text-transform:uppercase;" value="{{$jam->idpenjamin}}" readonly/>
                                                        </div>
                                                        @endif
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-3 ">Nomor ID Penjamin</div>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="input_nom_id_penjamin" autocomplete="off" value="{{$jam->nom_id_penjamin}}" style="text-transform:uppercase;" maxlength="16"  readonly/>
                                                        </div>
                                                    </div> 
                                                     <div class="row form-group">
                                                        <div class="col-sm-3 ">Alamat</div>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="input_alamat" autocomplete="off" value="{{$jam->alamat}}" style="text-transform:uppercase"  readonly />
                                                        </div>
                                                    </div>
                                                   
                                                </div>
                                                <div class="col-sm-6"> 
                                                    
                                                   
                                                     <div class="row form-group">
                                                        <div class="col-sm-3 ">Kelurahan</div>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" value="{{$jam->kelurahan}}" style="text-transform:uppercase" readonly/>
                                                        </div>
                                                    </div>
                                                     <div class="row form-group">
                                                        <div class="col-sm-3 ">Kecamatan</div>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" value="{{$jam->kecamatan}}" style="text-transform:uppercase" readonly/>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-3 ">Kodya</div>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="input_kodya" value="{{$jam->kodya}}" style="text-transform:uppercase" readonly/>
                                                        </div>
                                                    </div>
                                                     <div class="row form-group">
                                                        <div class="col-sm-3 ">Kode Pos</div>
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="input_kodya" value="{{$jam->kodepos}}" style="text-transform:uppercase" readonly/>
                                                        </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-3 ">Kode Jenis Segmen Fasilitas</div>
                                                        @if($jam->segfas == "F01")
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="input_kode_segFas" value="F01 - Kredit" style="text-transform:uppercase" readonly/>
                                                        </div>
                                                        @else
                                                        <div class="col-sm-9">
                                                            <input class="form-control" name="input_kode_segFas" value="{{$jam->segfas}}" style="text-transform:uppercase" readonly/>
                                                        </div>
                                                        @endif
                                                    </div>  
                                                    <div class="row form-group">
                                                        <div class="col-sm-3 ">Persentase Dijamin</div>
                                                        <div class="col-sm-9">
                                                            <div class="input-group">
                                                                <input type="text" class="form-control" name="input_persent_dijamin" autocomplete="off" value="{{$jam->present_dijamin}}"  readonly/>
                                                                <span class="input-group-addon">%</span>
                                                            </div>                                        
                                                        </div>                                    
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-sm-3 ">Keterangan</div>
                                                        <div class="col-sm-9">
                                                            <input type="text" class="form-control" name="input_ket" autocomplete="off" value="{{$jam->ket}}" style="text-transform:uppercase;"  readonly />
                                                        </div>
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                         <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                         @endforeach
                                         <div class="row form-group">
                                            @foreach($daftar as $daf)
                                             <!-- if((strpos(Auth::user()->fungsi, '1001') !== false)||(strpos(Auth::user()->fungsi, '7777') !== false)) -->
                                            <div hidden="text" class="col-sm-12" datain-id="{{$daf->no_kredit}}">
                                                <div class="col-sm-6">
                                                    <div class="col-sm-6"><b>Nomor Kredit :</b></div>
                                                    <div class="col-sm-6"> {{$daf->no_kredit}}</div>
                                                </div>
                                            </div>
                                                 <div class="col-sm-3"><br>
                                                    <input type="button" class="btn btn-danger" name="aden" value="ADDENDUM PENJAMIN" />
                                                </div>
                                            <!-- endif -->
                                            @endforeach
                                        </div> 

                                    </div>
                                </div>
                        </fieldset>

                        <fieldset class="tab-pane animation-slide-left"  id="agsertifikat" role="tabpanel">
                                <div class="panel panel-bordered">
                                    <div class="panel-body">
                                    <!-- foreach($agkredit as $ser) -->
                                    @foreach($sertifikat as $ser)
                                    @if(($ser->status == '                                                  ')
                                     ||($ser->status == 'dipinjam                                          ')
                                     ||($ser->status == 'tukar                                             ')
                                     ||($ser->status == 'pengganti                                         ')
                                     ||($ser->status == 'kembali                                           ')
                                     ||($ser->status == '')
                                     ||($ser->status == 'OK                                                '))
                                        <div class="row" dataag-id="{{$ser->no_kredit}}">
                                            <div class="col-sm-12" >  
                                              <div class="col-sm-6">
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Operator:</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ser->opr}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Status Agunan :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ser->status}}
                                                    </div>
                                                </div>
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Nomor Kredit :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        {{$ser->no_kredit}}
                                                    </div>
                                                </div>
                                                @foreach($daftar as $daf)
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                        <b>Nomor NPP :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        {{$daf->no_ref}}
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="row form-grtoup">
                                                <div class="col-sm-6 ">Kode Agunan</div>
                                                    <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="input_agunan1[]" autocomplete="off" style="text-transform:uppercase;" value="{{$ser->jenis}}" readonly />
                                                    </div>                        
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">No Sertifikat</div>
                                                    <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="input_no_sertifikat[]" autocomplete="off" style="text-transform:uppercase;" value="{{$ser->nosertif}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Jenis Sertifikat</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_jenis_sertifikat[]" value="{{$ser->sertstatus}}" readonly />
                                                    </div>    
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Segmen Fasilitas</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_jns_segFas[]" value="{{$ser->jenisfas}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Status Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_stat_agunan[]" value="{{$ser->kd_status}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Agunan</div>
                                                    <div class="col-sm-6">
                                                    <input class="form-control" name="input_kode_jns_agunan[]" value="{{$ser->jenisagun}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Peringkat Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_peringkat_agunan[]" autocomplete="off" value="{{$ser->peringkat}}" style="text-transform:uppercase;" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Lembaga Pemeringkat</div>
                                                    <div class="col-sm-6">
                                                    <input class="form-control" name="input_kode_lembaga_pemeringkat[]" value="{{$ser->lembaga}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Pengikatan</div>
                                                    <div class="col-sm-6">
                                                    <input class="form-control" name="input_kode_jns_pengikat[]" value="{{$ser->ikat}}"  readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Pengikatan</div>
                                                    <div class="col-sm-6">
                                                    @if ($ser->tgl_ikat == '')
                                                      <input type="text" class="form-control" name="input_tgl_pengikatan[]" value="-" readonly>
                                                    @elseif ($ser->tgl_ikat =='1970-01-01')
                                                     <input type="text" class="form-control" name="input_tgl_pengikatan[]" value="-" readonly>
                                                    @else
                                                     <input type="text" class="form-control" name="input_tgl_pengikatan[]" value="{{date('d-m-Y',strtotime($ser->tgl_ikat))}}" readonly>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nama Pemilik</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nama_pemilik_sert[]" autocomplete="off" value="{{$ser->pemilik}}" style="text-transform:uppercase" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Alamat Pemilik</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_alamat_pemilik_sert[]" autocomplete="off" value="{{$ser->alamat}}" style="text-transform:uppercase" readonly/>
                                                    </div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 ">Bukti Kepemilikan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_bukti_kepemilikan[]" autocomplete="off" value="{{$ser->bukti}}" style="text-transform:uppercase;" readonly/>
                                                    </div>
                                                </div> -->
                                                
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Alamat Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_lokasi_sert[]" autocomplete="off" value="{{$ser->lokasi}}" style="text-transform:uppercase" readonly/>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-sm-6">  
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Kode Kab/Kota</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kodya_nasabah[]" value="{{$ser->kodya}}" readonly style="text-transform:uppercase" >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Luas Tanah</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_luas_tanah[]" autocomplete="off" value="{{$ser->luastanah}}" readonly />
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Luas Bangunan</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_luas_bangunan[]" autocomplete="off" value="{{$ser->luasbangunan}}" readonly/>
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai NJOP</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_njop_sert[]" autocomplete="off" value="{{number_format($ser->nilnjop,0,'','.')}}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai HT</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_ht_sert[]" autocomplete="off" value="{{number_format($ser->nilhaktg,0,'','.')}}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Pasar</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_pasar_sert[]" autocomplete="off" value="{{number_format($ser->nilpasar,0,'','.')}}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Taksasi</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_taksasi_sert[]" autocomplete="off" value="{{number_format($ser->niltaksasi,0,'','.')}}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Agunan Menurut LJK</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_agunanLJK[]" autocomplete="off" value="{{number_format($ser->ljk,0,'','.')}}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian LJK</div>
                                                    <div class="col-sm-6">
                                                    @if ($ser->tgl_nilai == '')
                                                      <input type="text" class="form-control" name="input_tgl_penilaianLJK[]" value="-" readonly>
                                                    @elseif ($ser->tgl_nilai =='1970-01-01')
                                                     <input type="text" class="form-control" name="input_tgl_penilaianLJK[]" value="-" readonly>
                                                    @else
                                                    <input type="text" class="form-control" name="input_tgl_penilaianLJK[]" value="{{date('d-m-Y',strtotime($ser->tgl_nilai))}}" readonly>
                                                    @endif
                                                      
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Agunan Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="nilai_agunan_penilaiIndependent[]" autocomplete="off" value="{{number_format($ser->indep,0,'','.')}}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nama Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nm_penilai[]" autocomplete="off" value="{{$ser->namaindep}}" style="text-transform:uppercase;" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                    @if ($ser->tgl_indep == '')
                                                      <input type="text" class="form-control" name="input_tgl_penilaian[]" value="-" readonly >
                                                    @elseif ($ser->tgl_indep =='1970-01-01')
                                                    <input type="text" class="form-control" name="input_tgl_penilaian[]" value="-" readonly >
                                                    @else
                                                   <input type="text" class="form-control" name="input_tgl_penilaian[]" value="{{date('d-m-Y',strtotime($ser->tgl_indep))}}" readonly >
                                                    @endif
                                                      
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Status Paripasu</div>
                                                    <div class="col-sm-6">
                                                            <input type="text"  class="form-control" name="input_status_paripasu[]" value="{{$ser->paripasu}}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Pesentase Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_persent_paripasu[]" autocomplete="off" value="{{$ser->persen}}" readonly/>
                                                            <span class="input-group-addon">%</span>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Status Kredit Join</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_join[]" value="{{$ser->s_join}}" readonly>
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Diasuransikan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_diasuransikan[]" value="{{$ser->asuransi}}" readonly>
                                                    </div>                                                       
                                                </div>
                                    </div>
                                    </div>
                                        
                                    </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                     @endif
                                     @endforeach

                                    <!--  @foreach($agkredit as $ser)
                                     @if(($ser->status == '                                                  ')
                                     ||($ser->status == 'dipinjam                                          ')
                                     ||($ser->status == 'tukar                                             ')
                                     ||($ser->status == 'pengganti                                         ')
                                     ||($ser->status == 'kembali                                           ')
                                     ||($ser->status == '')
                                     ||($ser->status == 'OK                                                '))
                                    @if(($ser->jenis == '1-3            '))
                                        <div class="row" dataag-id="{{$ser->no_kredit}}">
                                            <div class="col-sm-12" >  
                                              <div class="col-sm-6">
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Operator:</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ser->opr}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Status Agunan :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ser->status}}
                                                    </div>
                                                </div>
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Nomor Kredit :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        {{$ser->no_kredit}}
                                                    </div>
                                                </div>
                                                 @foreach($daftar as $daf)
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                        <b>Nomor NPP :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        {{$daf->no_ref}}
                                                    </div>
                                                </div>
                                                @endforeach  
                                                <div class="row form-group">
                                                <div class="col-sm-6 ">Kode Agunan</div>
                                                    <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="input_agunan1[]" autocomplete="off" style="text-transform:uppercase;" value="{{$ser->jenis}}" readonly />
                                                    </div>                        
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">No Sertifikat</div>
                                                    <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="input_no_sertifikat[]" autocomplete="off" style="text-transform:uppercase;" value="{{$ser->nosertif}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Jenis Sertifikat</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_jenis_sertifikat[]" value="{{$ser->sertstatus}}" readonly />
                                                    </div>    
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Segmen Fasilitas</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_jns_segFas[]" value="{{$ser->jenisfas}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Status Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_stat_agunan[]" value="{{$ser->kd_status}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Agunan</div>
                                                    <div class="col-sm-6">
                                                    <input class="form-control" name="input_kode_jns_agunan[]" value="{{$ser->jenisagun}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Peringkat Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_peringkat_agunan[]" autocomplete="off" value="{{$ser->peringkat}}" style="text-transform:uppercase;" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Lembaga Pemeringkat</div>
                                                    <div class="col-sm-6">
                                                    <input class="form-control" name="input_kode_lembaga_pemeringkat[]" value="{{$ser->lembaga}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Pengikatan</div>
                                                    <div class="col-sm-6">
                                                    <input class="form-control" name="input_kode_jns_pengikat[]" value="{{$ser->ikat}}"  readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Pengikatan</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_pengikatan[]" value="{{date('d-m-Y',strtotime($ser->tgl_ikat))}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nama Pemilik</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nama_pemilik_sert[]" autocomplete="off" value="{{$ser->pemilik}}" style="text-transform:uppercase" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Alamat Pemilik</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_alamat_pemilik_sert[]" autocomplete="off" value="{{$ser->alamat}}" style="text-transform:uppercase" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Alamat Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_lokasi_sert[]" autocomplete="off" value="{{$ser->lokasi}}" style="text-transform:uppercase" readonly/>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-sm-6">  
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Kode Kab/Kota</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kodya_nasabah[]" value="{{$ser->kodya}}" readonly style="text-transform:uppercase" >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Luas Tanah</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_luas_tanah[]" autocomplete="off" value="{{$ser->luastanah}}" readonly />
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Luas Bangunan</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_luas_bangunan[]" autocomplete="off" value="{{$ser->luasbangunan}}" readonly/>
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai NJOP</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_njop_sert[]" autocomplete="off" value="{{$ser->nilnjop}}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai HT</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_ht_sert[]" autocomplete="off" value="{{$ser->nilhaktg}}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Pasar</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_pasar_sert[]" autocomplete="off" value="{{$ser->nilpasar}}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Taksasi</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_taksasi_sert[]" autocomplete="off" value="{{$ser->niltaksasi}}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Agunan Menurut LJK</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_agunanLJK[]" autocomplete="off" value="{{$ser->ljk}}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian LJK</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_penilaianLJK[]" value="{{date('d-m-Y',strtotime($ser->tgl_nilai))}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Agunan Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="nilai_agunan_penilaiIndependent[]" autocomplete="off" value="{{$ser->indep}}" readonly/>
                                                        </div>
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nama Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nm_penilai[]" autocomplete="off" value="{{$ser->namaindep}}" style="text-transform:uppercase;" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_penilaian[]" value="{{date('d-m-Y',strtotime($ser->tgl_indep))}}" readonly >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Status Paripasu</div>
                                                    <div class="col-sm-6">
                                                            <input type="text"  class="form-control" name="input_status_paripasu[]" value="{{$ser->paripasu}}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Pesentase Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_persent_paripasu[]" autocomplete="off" value="{{$ser->persen}}" readonly/>
                                                            <span class="input-group-addon">%</span>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Status Kredit Join</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_join[]" value="{{$ser->s_join}}" readonly>
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Diasuransikan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_diasuransikan[]" value="{{$ser->asuransi}}" readonly>
                                                    </div>                                                       
                                                </div>
                                    </div>
                                    </div>
                                        
                                    </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                      @endif
                                     @endif
                                    @endforeach -->
                                     <div class="row form-group">
                                            <!-- if((strpos(Auth::user()->fungsi, '1001') !== false)||(strpos(Auth::user()->fungsi, '7777') !== false)) -->
                                            @foreach($daftar as $daf)
                                            <div hidden="text"  datain-id="{{$daf->no_kredit}}">
                                                <!-- <div class="col-sm-6"> -->
                                                    <div class="col-sm-6"><b>Nomor Kredit :</b></div>
                                                    <div class="col-sm-6"> {{$daf->no_kredit}}</div>
                                                <!-- </div> -->
                                            </div>
                                                 <div class="col-sm-6"><br>
                                                    <input type="button" class="btn btn-danger" name="aden" value="ADDENDUM AGUNAN" />
                                                <!-- </div> -->
                                            @endforeach
                                                <input type="button" class="btn btn-warning" name="hapus" value="MUTASI AGUNAN">
                                                <!-- <input type="button" class="btn btn-warning" name="hapus" value="TUKAR AGUNAN"> -->
                                            </div>
                                             <!-- endif -->
                                        </div>  
                                    </div>
                                </div>
                        </fieldset>

                        <fieldset class="tab-pane animation-slide-left" id="agkendaraan" role="tabpanel">
                                <div class="panel panel-bordered">
                                <div class="panel-body">
                                    @foreach($kendaraan as $ken)
                                    @if(($ken->status == '          ')||($ken->status == 'dipinjam  ')||($ken->status == 'tukar     ')||($ken->status == 'pengganti ')||($ken->status == '')||($ken->status ==  'kembali   ')||($ken->status ==  'OK        '))
                                    @if(($ken->jenis != '1-7            '))
                                    <div class="row"  dataag-id="{{$ken->no_kredit}}"><br>
                                        <div class="col-sm-12"> 
                                            <div class="col-sm-6">
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Operator:</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ken->opr}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Status Agunan :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ken->status}}
                                                    </div>
                                                </div>
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Nomor Kredit :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ken->no_kredit}}
                                                    </div>
                                                </div>
                                                 @foreach($daftar as $daf)
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                        <b>Nomor NPP :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        {{$daf->no_ref}}
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="row form-group">
                                                <div class="col-sm-6 ">Kode Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name='input_agunan1[]' value="{{$ken->jenis}}" readonly />
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Jenis Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_jenis_kendaraan[]" value="{{$ken->jenisken}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Status Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_status_kendaraan[]" value="{{$ken->kd_status}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Pemilik</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nama_pemilik_kend[]" autocomplete="off" value="{{$ken->pemilik}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Alamat</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_alamat_pemilik_kend[]" autocomplete="off" value="{{$ken->alamat}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Kab/Kota</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kodya_nasabah[]" readonly" value="{{$ken->kodya}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Segmen Fasilitas</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_jns_segFas[]" value="{{$ken->jenisfas}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_jns_agunan[]" value="{{$ken->jenisagun}}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Peringkat Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_peringkat_agunan[]" autocomplete="off" value="{{$ken->peringkat}}" style="text-transform:uppercase;" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Lembaga Pemeringkat</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_lembaga_pemeringkat[]" value="{{$ken->lembaga}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Pengikatan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_jns_pengikatan[]" value="{{$ken->ikat}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Pengikatan</div>
                                                    <div class="col-sm-6">
                                                     @if ($ken->tgl_ikat == '')
                                                      <input type="text" class="form-control" name="input_tgl_pengikatan[]" value="-" readonly>
                                                    @elseif ($ken->tgl_ikat =='1970-01-01')
                                                     <input type="text" class="form-control" name="input_tgl_pengikatan[]" value="-" readonly>
                                                    @else
                                                     <input type="text" class="form-control" name="input_tgl_pengikatan[]" value="{{date('d-m-Y',strtotime($ken->tgl_ikat))}}" readonly>
                                                    @endif
                                                    </div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 ">Bukti Kepemilikan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_bukti_kepemilikan[]" autocomplete="off" value="{{$ken->bukti}}" style="text-transform:uppercase;" readonly />
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">No STNK</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_stnk[]" autocomplete="off" value="{{$ken->nostnk}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Berlaku</div>
                                                    <div class="col-sm-6">
                                                    @if ($ken->berlaku == '')
                                                     <input type="text" class="form-control" name="input_tgl_berlaku_stnk[]" value="-" readonly >
                                                    @elseif ($ken->berlaku =='1970-01-01')
                                                     <input type="text" class="form-control" name="input_tgl_berlaku_stnk[]" value="-" readonly >
                                                    @else
                                                     <input type="text" class="form-control" name="input_tgl_berlaku_stnk[]" value="{{date('d-m-Y',strtotime($ken->berlaku))}}" readonly >
                                                    @endif
                                                      
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6 ">Dealer</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_dealer_kend[]" autocomplete="off" value="{{$ken->dealer}}" style="text-transform:uppercase" readonly />
                                                    </div>
                                                </div>   
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Merk / Tipe</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_merk_kend[]" autocomplete="off" value="{{$ken->merktype}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div>
                                                                                          
                                            </div>
                                            <div class="col-sm-6">                                               
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tahun</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_tahun_kend[]" autocomplete="off" value="{{$ken->tahun}}" readonly style="text-transform:uppercase" />
                                                    </div>
                                                </div>  
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Warna</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_warna_kend[]" autocomplete="off" value="{{$ken->warna}}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor Polisi</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_polisi[]" autocomplete="off" value="{{$ken->nopolisi}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor BPKB</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_bpkb[]" autocomplete="off" value="{{$ken->nobpkb}}" style="text-transform:uppercase" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor Rangka</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_rangka[]" autocomplete="off" value="{{$ken->norangka}}" readonly style="text-transform:uppercase"  />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor Mesin</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_mesin[]" autocomplete="off" value="{{$ken->nomesin}}" readonly style="text-transform:uppercase" />
                                                    </div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 ">Kelompok</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_kelompok_kend[]" autocomplete="off" value="{{$ken->kelompok}}" readonly style="text-transform:uppercase"  />
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_kendaraan[]" autocomplete="off" value="{{number_format($ken->nilai,0,'','.')}}" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Taksasi</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_taksasi_ken[]" autocomplete="off" value="{{number_format($ken->niltaksasi,0,'','.')}}" readonly  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Pasar</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_pasar_ken[]" autocomplete="off" value="{{number_format($ken->nilpasar,0,'','.')}}" readonly  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Agunan Menurut LJK</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_agunanLJK[]" autocomplete="off" value="{{number_format($ken->ljk,0,'','.')}}" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian LJK</div>
                                                    <div class="col-sm-6">
                                                    @if ($ken->tgl_nilai == '')
                                                    <input type="text" class="form-control" name="input_tgl_penilaianLJK[]" value="-"  readonly>
                                                    @elseif ($ken->tgl_nilai =='1970-01-01')
                                                    <input type="text" class="form-control" name="input_tgl_penilaianLJK[]" value="-"  readonly>
                                                    @else
                                                    <input type="text" class="form-control" name="input_tgl_penilaianLJK[]" value="{{date('d-m-Y',strtotime($ken->tgl_nilai))}}"  readonly>
                                                    @endif
                                                      
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Agunan Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="nilai_agunan_penilaiIndependent[]" autocomplete="off" value="{{number_format($ken->indep,0,'','.')}}" readonly />
                                                        </div>
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nama Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nm_penilai[]" autocomplete="off" value="{{$ken->namaindep}}" readonly style="text-transform:uppercase;"  penilai Independent" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                     @if ($ken->tgl_indep == '')
                                                      <input type="text" class="form-control" name="input_tgl_penilaian[]" value="-" readonly >
                                                    @elseif ($ken->tgl_indep =='1970-01-01')
                                                    <input type="text" class="form-control" name="input_tgl_penilaian[]" value="-" readonly >
                                                    @else
                                                   <input type="text" class="form-control" name="input_tgl_penilaian[]" value="{{date('d-m-Y',strtotime($ken->tgl_indep))}}" readonly >
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Status Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_status_paripasu[]" value="{{$ken->paripasu}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Pesentase Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_persent_paripasu[]" autocomplete="off" value="{{$ken->persen}}" readonly />
                                                            <span class="input-group-addon">%</span>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Status Kredit Join</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_join[]" value="{{$ken->s_join}}" readonly>
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Diasuransikan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_diasuransikan[]" value="{{$ken->asuransi}}" readonly>
                                                    </div>                                                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                    @endif
                                     @endif
                                     @endforeach
<!-- 
                                     @foreach($agkredit as $ken)
                                    @if(($ken->status == '                                                  ')
                                     ||($ken->status == 'dipinjam                                          ')
                                     ||($ken->status == 'tukar                                             ')
                                     ||($ken->status == 'pengganti                                         ')
                                     ||($ken->status == 'kembali                                           ')
                                     ||($ken->status == '')
                                     ||($ken->status == 'OK                                                '))
                                     @if(($ken->jenis != '1-7            '))
                                    <div class="row"  dataag-id="{{$ken->no_kredit}}"><br>
                                        <div class="col-sm-12"> 
                                            <div class="col-sm-6">
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Operator:</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ken->opr}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Status Agunan :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ken->status}}
                                                    </div>
                                                </div>
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Nomor Kredit :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ken->no_kredit}}
                                                    </div>
                                                </div>
                                                 @foreach($daftar as $daf)
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                        <b>Nomor NPP :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        {{$daf->no_ref}}
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="row form-group">
                                                <div class="col-sm-6 ">Kode Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name='input_agunan1[]' value="{{$ken->jenis}}" readonly />
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Jenis Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_jenis_kendaraan[]" value="{{$ken->jenisken}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Status Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_status_kendaraan[]" value="{{$ken->kd_status}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Pemilik</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nama_pemilik_kend[]" autocomplete="off" value="{{$ken->pemilik}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Alamat</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_alamat_pemilik_kend[]" autocomplete="off" value="{{$ken->alamat}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Kab/Kota</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kodya_nasabah[]" readonly" value="{{$ken->kodya}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Segmen Fasilitas</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_jns_segFas[]" value="{{$ken->jenisfas}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_jns_agunan[]" value="{{$ken->jenisagun}}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Peringkat Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_peringkat_agunan[]" autocomplete="off" value="{{$ken->peringkat}}" style="text-transform:uppercase;" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Lembaga Pemeringkat</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_lembaga_pemeringkat[]" value="{{$ken->lembaga}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Pengikatan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_jns_pengikatan[]" value="{{$ken->ikat}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Pengikatan</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_pengikatan[]" value="{{date('d-m-Y',strtotime($ken->tgl_ikat))}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">No STNK</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_stnk[]" autocomplete="off" value="{{$ken->nostnk}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Berlaku</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_berlaku_stnk[]" value="{{date('d-m-Y',strtotime($ken->berlaku))}}" readonly >
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6 ">Dealer</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_dealer_kend[]" autocomplete="off" value="{{$ken->dealer}}" style="text-transform:uppercase" readonly />
                                                    </div>
                                                </div>   
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Merk / Tipe</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_merk_kend[]" autocomplete="off" value="{{$ken->merktype}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div>
                                                                                          
                                            </div>
                                            <div class="col-sm-6">                                               
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tahun</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_tahun_kend[]" autocomplete="off" value="{{$ken->tahun}}" readonly style="text-transform:uppercase" />
                                                    </div>
                                                </div>  
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Warna</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_warna_kend[]" autocomplete="off" value="{{$ken->warna}}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor Polisi</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_polisi[]" autocomplete="off" value="{{$ken->nopolisi}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor BPKB</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_bpkb[]" autocomplete="off" value="{{$ken->nobpkb}}" style="text-transform:uppercase" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor Rangka</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_rangka[]" autocomplete="off" value="{{$ken->norangka}}" readonly style="text-transform:uppercase"  />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor Mesin</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_mesin[]" autocomplete="off" value="{{$ken->nomesin}}" readonly style="text-transform:uppercase" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_kendaraan[]" autocomplete="off" value="{{$ken->nilai}}" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Taksasi</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_taksasi_ken[]" autocomplete="off" value="{{$ken->niltaksasi}}" readonly  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Pasar</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_pasar_ken[]" autocomplete="off" value="{{$ken->nilpasar}}" readonly  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Agunan Menurut LJK</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_agunanLJK[]" autocomplete="off" value="{{$ken->ljk}}" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian LJK</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_penilaianLJK[]" value="{{date('d-m-Y',strtotime($ken->tgl_nilai))}}"  readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Agunan Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="nilai_agunan_penilaiIndependent[]" autocomplete="off" value="{{$ken->indep}}" readonly />
                                                        </div>
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nama Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nm_penilai[]" autocomplete="off" value="{{$ken->namaindep}}" readonly style="text-transform:uppercase;"  penilai Independent" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_penilaian[]" value="{{date('d-m-Y',strtotime($ken->tgl_indep))}}" readonly >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Status Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_status_paripasu[]" value="{{$ken->paripasu}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Pesentase Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_persent_paripasu[]" autocomplete="off" value="{{$ken->persen}}" readonly />
                                                            <span class="input-group-addon">%</span>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Status Kredit Join</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_join[]" value="{{$ken->s_join}}" readonly>
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Diasuransikan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_diasuransikan[]" value="{{$ken->asuransi}}" readonly>
                                                    </div>                                                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                    @endif
                                     @endif
                                     @endforeach -->

                                     <div class="row form-group">
                                            <!-- if((strpos(Auth::user()->fungsi, '1001') !== false)||(strpos(Auth::user()->fungsi, '7777') !== false)) -->
                                            @foreach($daftar as $daf)
                                            <div hidden="text" class="col-sm-12" datain-id="{{$daf->no_kredit}}">
                                                <div class="col-sm-6">
                                                    <div class="col-sm-6"><b>Nomor Kredit :</b></div>
                                                    <div class="col-sm-6"> {{$daf->no_kredit}}</div>
                                                </div>
                                            </div>
                                                <div class="col-sm-6"><br>
                                                    <input type="button" class="btn btn-danger" name="aden" value="ADDENDUM AGUNAN" />
                                                <!-- </div> -->
                                            @endforeach
                                                <input type="button" class="btn btn-warning" name="hapus" value="MUTASI AGUNAN">
                                                <!-- <input type="button" class="btn btn-warning" name="hapus" value="TUKAR AGUNAN"> -->
                                            </div>
                                            <!-- endif -->
                                        </div> 
                                </div>
                                </div>
                        </fieldset>

                        <fieldset class="tab-pane animation-slide-left" id="alberat" role="tabpanel">
                                <div class="panel panel-bordered">
                                <div class="panel-body">
                                    @foreach($agkredit as $ken)
                                      @if(($ken->status == '                                                  ')
                                     ||($ken->status == 'dipinjam                                          ')
                                     ||($ken->status == 'tukar                                             ')
                                     ||($ken->status == 'pengganti                                         ')
                                     ||($ken->status == 'kembali                                           ')
                                     ||($ken->status == '')
                                     ||($ken->status == 'OK                                                '))
                                    @if(($ken->jenis == '1-7            '))
                                    <div class="row"  dataag-id="{{$ken->no_kredit}}"><br>
                                        <div class="col-sm-12"> 
                                            <div class="col-sm-6">
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Operator:</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ken->opr}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Status Agunan :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ken->status}}
                                                    </div>
                                                </div>
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Nomor Kredit :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ken->no_kredit}}
                                                    </div>
                                                </div>
                                                 @foreach($daftar as $daf)
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                        <b>Nomor NPP :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        {{$daf->no_ref}}
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="row form-group">
                                                <div class="col-sm-6 ">Kode Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name='input_agunan1[]' value="{{$ken->jenis}}" readonly />
                                                    </div>                                    
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 ">Jenis Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_jenis_kendaraan[]" value="{{$ken->jenisken}}" readonly>
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Status Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_status_kendaraan[]" value="{{$ken->kd_status}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Pemilik</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nama_pemilik_kend[]" autocomplete="off" value="{{$ken->pemilik}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Alamat</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_alamat_pemilik_kend[]" autocomplete="off" value="{{$ken->alamat}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Kab/Kota</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kodya_nasabah[]" value="{{$ken->kodya}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Segmen Fasilitas</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_jns_segFas[]" value="{{$ken->jenisfas}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_jns_agunan[]" value="{{$ken->jenisagun}}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Peringkat Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_peringkat_agunan[]" autocomplete="off" value="{{$ken->peringkat}}" style="text-transform:uppercase;" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Lembaga Pemeringkat</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_lembaga_pemeringkat[]" value="{{$ken->lembaga}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Pengikatan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_jns_pengikatan[]" value="{{$ken->ikat}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Pengikatan</div>
                                                    <div class="col-sm-6">
                                                     @if ($ken->tgl_ikat == '')
                                                      <input type="text" class="form-control" name="input_tgl_pengikatan[]" value="-" readonly>
                                                    @elseif ($ken->tgl_ikat =='1970-01-01')
                                                     <input type="text" class="form-control" name="input_tgl_pengikatan[]" value="-" readonly>
                                                    @else
                                                     <input type="text" class="form-control" name="input_tgl_pengikatan[]" value="{{date('d-m-Y',strtotime($ken->tgl_ikat))}}" readonly>
                                                    @endif
                                                    </div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 ">Bukti Kepemilikan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_bukti_kepemilikan[]" autocomplete="off" value="{{$ken->bukti}}" style="text-transform:uppercase;" readonly />
                                                    </div>
                                                </div> -->
                                               <!--  <div class="row form-group">
                                                    <div class="col-sm-6 ">No Stnk</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_stnk[]" autocomplete="off" value="{{$ken->nostnk}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div> -->
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Berlaku</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_berlaku_stnk[]" value="{{date('d-m-Y',strtotime($ken->berlaku))}}" readonly >
                                                    </div>
                                                </div>  -->
                                                 <!-- <div class="row form-group">
                                                    <div class="col-sm-6 ">Dealer</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_dealer_kend[]" autocomplete="off" value="{{$ken->dealer}}" style="text-transform:uppercase" readonly />
                                                    </div>
                                                </div>    -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Merk / Tipe</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_merk_kend[]" autocomplete="off" value="{{$ken->merktype}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div>
                                                                                          
                                            </div>
                                            <div class="col-sm-6">                                               
                                               <!--  <div class="row form-group">
                                                    <div class="col-sm-6 ">Tahun</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_tahun_kend[]" autocomplete="off" value="{{$ken->tahun}}" readonly style="text-transform:uppercase" />
                                                    </div>
                                                </div>   -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Spesifikasi</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_warna_kend[]" autocomplete="off" value="{{$ken->warna}}" readonly/>
                                                    </div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor Polisi</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_polisi[]" autocomplete="off" value="{{$ken->nopolisi}}" readonly />
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor SERI</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_bpkb[]" autocomplete="off" value="{{$ken->nobpkb}}" style="text-transform:uppercase" readonly />
                                                    </div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor Rangka</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_rangka[]" autocomplete="off" value="{{$ken->norangka}}" readonly style="text-transform:uppercase"  />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor Mesin</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_mesin[]" autocomplete="off" value="{{$ken->nomesin}}" readonly style="text-transform:uppercase" />
                                                    </div>
                                                </div> -->
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 ">Kelompok</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_kelompok_kend[]" autocomplete="off" value="{{$ken->kelompok}}" readonly style="text-transform:uppercase"  />
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_kendaraan[]" autocomplete="off" value="{{number_format($ken->nilai,0,'','.')}}" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Taksasi</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_taksasi_ken[]" autocomplete="off" value="{{number_format($ken->niltaksasi,0,'','.')}}" readonly  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Pasar</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_pasar_ken[]" autocomplete="off" value="{{number_format($ken->nilpasar,0,'','.')}}" readonly  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Agunan Menurut LJK</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_agunanLJK[]" autocomplete="off" value="{{number_format($ken->ljk,0,'','.')}}" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian LJK</div>
                                                    <div class="col-sm-6">
                                                   @if ($ken->tgl_nilai == '')
                                                    <input type="text" class="form-control" name="input_tgl_penilaianLJK[]" value="-"  readonly>
                                                    @elseif ($ken->tgl_nilai =='1970-01-01')
                                                    <input type="text" class="form-control" name="input_tgl_penilaianLJK[]" value="-"  readonly>
                                                    @else
                                                    <input type="text" class="form-control" name="input_tgl_penilaianLJK[]" value="{{date('d-m-Y',strtotime($ken->tgl_nilai))}}"  readonly>
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Agunan Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="nilai_agunan_penilaiIndependent[]" autocomplete="off" value="{{number_format($ken->indep,0,'','.')}}" readonly />
                                                        </div>
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nama Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nm_penilai[]" autocomplete="off" value="{{$ken->namaindep}}" readonly style="text-transform:uppercase;"  penilai Independent" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                     @if ($ser->tgl_indep == '')
                                                      <input type="text" class="form-control" name="input_tgl_penilaian[]" value="-" readonly >
                                                    @elseif ($ser->tgl_indep =='1970-01-01')
                                                    <input type="text" class="form-control" name="input_tgl_penilaian[]" value="-" readonly >
                                                    @else
                                                   <input type="text" class="form-control" name="input_tgl_penilaian[]" value="{{date('d-m-Y',strtotime($ser->tgl_indep))}}" readonly >
                                                    @endif
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Status Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_status_paripasu[]" value="{{$ken->paripasu}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Pesentase Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_persent_paripasu[]" autocomplete="off" value="{{$ken->persen}}" readonly />
                                                            <span class="input-group-addon">%</span>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Status Kredit Join</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_join[]" value="{{$ken->s_join}}" readonly>
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Diasuransikan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_diasuransikan[]" value="{{$ken->asuransi}}" readonly>
                                                    </div>                                                       
                                                </div>
                                                 <div class="row form-group">
                                                    <div class="col-sm-6 ">Fungsi</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_fungsi[]" value="{{$ken->ket}}" readonly>
                                                    </div>                                                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                     @endif
                                     @endif
                                     @endforeach

                                   <!--   @foreach($agkredit as $ken)
                                     @if(($ken->status == '                                                  ')
                                     ||($ken->status == 'dipinjam                                          ')
                                     ||($ken->status == 'tukar                                             ')
                                     ||($ken->status == 'pengganti                                         ')
                                     ||($ken->status == 'kembali                                           ')
                                     ||($ken->status == '')
                                     ||($ken->status == 'OK                                                '))
                                    @if(($ken->jenis == '1-7            '))
                                    <div class="row"  dataag-id="{{$ken->no_kredit}}"><br>
                                        <div class="col-sm-12"> 
                                            <div class="col-sm-6">
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Operator:</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ken->opr}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Status Agunan :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ken->status}}
                                                    </div>
                                                </div>
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Nomor Kredit :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ken->no_kredit}}
                                                    </div>
                                                </div>
                                                 @foreach($daftar as $daf)
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                        <b>Nomor NPP :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        {{$daf->no_ref}}
                                                    </div>
                                                </div>
                                                @endforeach
                                                <div class="row form-group">
                                                <div class="col-sm-6 ">Kode Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name='input_agunan1[]' value="{{$ken->jenis}}" readonly />
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Status Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_status_kendaraan[]" value="{{$ken->kd_status}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Pemilik</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nama_pemilik_kend[]" autocomplete="off" value="{{$ken->pemilik}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Alamat</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_alamat_pemilik_kend[]" autocomplete="off" value="{{$ken->alamat}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Kab/Kota</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kodya_nasabah[]" readonly" value="{{$ken->kodya}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Segmen Fasilitas</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_jns_segFas[]" value="{{$ken->jenisfas}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_jns_agunan[]" value="{{$ken->jenisagun}}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Peringkat Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_peringkat_agunan[]" autocomplete="off" value="{{$ken->peringkat}}" style="text-transform:uppercase;" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Lembaga Pemeringkat</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_lembaga_pemeringkat[]" value="{{$ken->lembaga}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Pengikatan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_kode_jns_pengikatan[]" value="{{$ken->ikat}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Pengikatan</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_pengikatan[]" value="{{date('d-m-Y',strtotime($ken->tgl_ikat))}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Merk / Tipe</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_merk_kend[]" autocomplete="off" value="{{$ken->merktype}}" style="text-transform:uppercase"  readonly />
                                                    </div>
                                                </div>
                                                                                          
                                            </div>
                                            <div class="col-sm-6"> 
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Spesifikasi</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_warna_kend[]" autocomplete="off" value="{{$ken->warna}}" readonly/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor SERI</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_bpkb[]" autocomplete="off" value="{{$ken->nobpkb}}" style="text-transform:uppercase" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_kendaraan[]" autocomplete="off" value="{{$ken->nilai}}" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Taksasi</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_taksasi_ken[]" autocomplete="off" value="{{$ken->niltaksasi}}" readonly  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Pasar</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_pasar_ken[]" autocomplete="off" value="{{$ken->nilpasar}}" readonly  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Agunan Menurut LJK</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_agunanLJK[]" autocomplete="off" value="{{$ken->ljk}}" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian LJK</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_penilaianLJK[]" value="{{date('d-m-Y',strtotime($ken->tgl_nilai))}}"  readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Agunan Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="nilai_agunan_penilaiIndependent[]" autocomplete="off" value="{{$ken->indep}}" readonly />
                                                        </div>
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nama Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nm_penilai[]" autocomplete="off" value="{{$ken->namaindep}}" readonly style="text-transform:uppercase;"  penilai Independent" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_penilaian[]" value="{{date('d-m-Y',strtotime($ken->tgl_indep))}}" readonly >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Status Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_status_paripasu[]" value="{{$ken->paripasu}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Pesentase Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_persent_paripasu[]" autocomplete="off" value="{{$ken->persen}}" readonly />
                                                            <span class="input-group-addon">%</span>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Status Kredit Join</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_join[]" value="{{$ken->s_join}}" readonly>
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Diasuransikan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_diasuransikan[]" value="{{$ken->asuransi}}" readonly>
                                                    </div>                                                       
                                                </div>
                                                 <div class="row form-group">
                                                    <div class="col-sm-6 ">Fungsi</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_fungsi[]" value="{{$ken->ket}}" readonly>
                                                    </div>                                                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                     @endif
                                     @endif
                                     @endforeach -->

                                     <div class="row form-group">
                                            <!-- if((strpos(Auth::user()->fungsi, '1001') !== false)||(strpos(Auth::user()->fungsi, '7777') !== false)) -->
                                            @foreach($daftar as $daf)
                                            <div hidden="text" class="col-sm-12" datain-id="{{$daf->no_kredit}}">
                                                <div class="col-sm-6">
                                                    <div class="col-sm-6"><b>Nomor Kredit :</b></div>
                                                    <div class="col-sm-6"> {{$daf->no_kredit}}</div>
                                                </div>
                                            </div>
                                                <div class="col-sm-6"><br>
                                                    <input type="button" class="btn btn-danger" name="aden" value="ADDENDUM AGUNAN" />
                                                <!-- </div> -->
                                            @endforeach
                                                <input type="button" class="btn btn-warning" name="hapus" value="MUTASI AGUNAN">
                                                <!-- <input type="button" class="btn btn-warning" name="hapus" value="TUKAR AGUNAN"> -->
                                            </div>
                                            <!-- endif -->
                                        </div> 
                                </div>
                                </div>
                        </fieldset>

                        <fieldset class="tab-pane animation-slide-left" id="lapuang" role="tabpanel">
                            <div class="panel panel-bordered">
                            <div class="panel-body">
                                @foreach($lapkeuang as $lu)
                                    <div class="row"  datauang-id="{{$lu->no_kredit}}"><br>
                                    <div class="col-sm-12">  
                                         <div class="col-sm-6"> 
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Operator :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$lu->opr}}
                                                    </div>
                                                </div> 
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Nomor Kredit :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$lu->no_kredit}}
                                                    </div>
                                                </div>  
                                                 @foreach($daftar as $daf)
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                        <b>Nomor NPP :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        {{$daf->no_ref}}
                                                    </div>
                                                </div>
                                                @endforeach  
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Posisi Laporan Keuangan Tahunan:</div>
                                                    <div class="col-sm-6">                                                           
                                                        <input type="text" class="form-control" name="input_posisi_lapKeuangan_tahunan" autocomplete="off" value="{{date('d-m-Y',strtotime($lu->tahunan))}}" readonly />
                                                    </div>
                                                </div>
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Aset:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_aset" autocomplete="off" value="{{number_format($lu->aset,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Aset Lancar:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_aset_lancar" autocomplete="off" value="{{number_format($lu->aset_lancar,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Kas dan Setara Kas (Aset Lancar):</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_kas" autocomplete="off" value="{{number_format($lu->kas,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Piutang Usaha (Aset Lancar):</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_piutang_usaha_al" autocomplete="off" value="{{number_format($lu->piutang_usaha_al,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Investasi (Aset Lancar):</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_investasi_lacar" autocomplete="off" value="{{number_format($lu->investasi_lancar,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Aset Lancar Lain:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_aset_lancar_lain" autocomplete="off" value="{{number_format($lu->aset_lancar_lain,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Aset Tidak Lancar:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_aset_tdk_lancar" autocomplete="off" value="{{number_format($lu->aset_tdk_lancar,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Piutang Usaha (Aset Tidak Lancar):</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_piutang_usaha_atl" autocomplete="off" value="{{number_format($lu->piutang_usaha_atl,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Investasi (Aset Tidak Lancar):</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_invest_tdk_lancar" autocomplete="off" value="{{number_format($lu->invest_tdk_lancar,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Aset Tidak Lancar Lain:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_aset_tdk_lancar_lain" autocomplete="off" value="{{number_format($lu->aset_tdk_lancar_lain,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Liabilitas:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_lia" autocomplete="off" value="{{number_format($lu->lia,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Liabilitas Jangka Pendek:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_lia_pndk" autocomplete="off" value="{{number_format($lu->lia_pndk,0,'','.')}}" placeholder="0" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                               
                                            </div>
                                        <div class="col-sm-6">
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Pinjaman Jangka Pendek:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_pinjaman_pndk" autocomplete="off" value="{{number_format($lu->pinjaman_pndk,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group"><br>
                                                    <div class="col-sm-6">Utang Usaha Jangka Pendek:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_utang_usaha_pndk" autocomplete="off" value="{{number_format($lu->utang_usaha_pndk,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Liabilitas Jangka Pendek Lain:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_lia_pndk_lain" autocomplete="off" value="{{number_format($lu->lia_pndk_lain,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Liabilitas Jangka Panjang:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_lia_pnjng" autocomplete="off" value="{{number_format($lu->lia_pnjg,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Pinjaman Jangka Panjang:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_pinjaman_pnjng" autocomplete="off" value="{{number_format($lu->pinjaman_pnjng,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Utang Usaha Jangka Panjang:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_utang_usaha_panjang" autocomplete="off" value="{{number_format($lu->utang_usaha_pnjng,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Liabilitas Jangka Panjang Lain:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_lia_panjang_lain" autocomplete="off" value="{{number_format($lu->lia_pnjng_lain,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Ekuitas:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_ekuitas" autocomplete="off" value="{{number_format($lu->ekuitas,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Pendapatan Usaha:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_pendapatan_usaha" autocomplete="off" value="{{number_format($lu->pendapatan_usaha,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Beban Pokok Pendapatan:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_beban_pokok" autocomplete="off" value="{{number_format($lu->beban_pokok,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Laba/Rugi Bruto:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_labarugi" autocomplete="off" value="{{number_format($lu->labarugi,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Pendapatan Lain-Lain:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_pendapatan_lain" autocomplete="off" value="{{number_format($lu->pendapatan_lain,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Beban Lain-Lain:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_beban_lain" autocomplete="off" value="{{number_format($lu->beban_lain,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Laba/Rugi Sebelum Pajak:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_labarugi_sblmPajak" autocomplete="off" value="{{number_format($lu->labarugi_lalu,0,'','.')}}" placeholder="0" readonly/>
                                                        </div>
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">Laba/Rugi Tahun Berjalan:</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_labarugi_tahun" autocomplete="off" value="{{number_format($lu->labarugi_tahun,0,'','.')}}" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                
                                        <div class="col-sm-12"> 
                                            <div class="col-sm-6">
                                                 
                                            </div>
                                        </div>
                                    </div>
                                    <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                @endforeach
                                    <div class="row form-group">
                                            @foreach($daftar as $daf)
                                             <!-- if((strpos(Auth::user()->fungsi, '1001') !== false)||(strpos(Auth::user()->fungsi, '7777') !== false)) -->

                                            <div hidden="text" class="col-sm-12" datain-id="{{$daf->no_kredit}}">
                                                <div class="col-sm-6">
                                                    <div class="col-sm-6"><b>Nomor Kredit :</b></div>
                                                    <div class="col-sm-6"> {{$daf->no_kredit}}</div>
                                                </div>
                                            </div>
                                                <div class="col-sm-3"><br>
                                                    <input type="button" class="btn btn-danger" name="aden" value="ADDENDUM LAPORAN KEUANGAN" />
                                                </div>
                                            <!-- endif -->
                                            @endforeach
                                    </div> 
                                </div>
                                </div>
                            </fieldset>
                        
                        <fieldset class="tab-pane animation-slide-left" id="pengurus" role="tabpanel">
                            <div class="panel panel-bordered">
                                <div class="panel-body">
                                    @foreach($pengurus as $ur)
                                    <div class="row" datapen-id="{{$ur->no_kredit}}" >
                                    <div class="col-sm-12"> 
                                        <div class="col-sm-6">
                                            <div class="row form-group">
                                                <div class="col-sm-6"><b>Operator:</b></div>
                                                <div class="col-sm-6">{{$ur->opr}}
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-6"><b>Nomor Nasabah:</b></div>
                                                <div class="col-sm-6">{{$ur->no_nsb}}
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-6"><b>Nomor Kredit:</b></div>
                                                <div class="col-sm-6">{{$ur->no_kredit}}
                                                </div>
                                            </div>
                                             @foreach($daftar as $daf)
                                                 <div class="row form-group">
                                                    <div class="col-sm-6">
                                                        <b>Nomor NPP :</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        {{$daf->no_ref}}
                                                    </div>
                                                </div>
                                                @endforeach
                                            <div class="row form-group">
                                                <div class="col-sm-6">Kode Jenis Identitas Pengurus:</div>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="input_kode_idPengurus" required value="{{$ur->kode_jns_idPengurus}}" readonly>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-6">Nomor ID Pengurus:</div>
                                                    <div class="col-sm-6">
                                                        <input  class="form-control" name="input_nom_idPengurus" autocomplete="off" value="{{$ur->nom_idPengurus}}"  readonly>
                                                    </div>
                                            </div>  
                                            <div class="row form-group">
                                                <div class="col-sm-6">Nama Pengurus:</div>
                                                <div class="col-sm-6">
                                                    <input  class="form-control" name="input_nm_pengurus" autocomplete="off" value="{{$ur->nm_pengurus}}"  readonly>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-6">Jenis Kelamin:</div>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="input_jnsKel" value="{{$ur->jnsKel}}" readonly>
                                                </div>
                                            </div>                              
                                            
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="row form-group">
                                                <div class="col-sm-6">Alamat:</div>
                                                <div class="col-sm-6">
                                                    <input  class="form-control" name="input_alamat" autocomplete="off" value="{{$ur->alamat}}"  readonly>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-6">Kelurahan:</div>
                                                <div class="col-sm-6">
                                                    <input  class="form-control" name="input_kelurahan" autocomplete="off" value="{{$ur->kelurahan}}"  readonly>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-6">Kecamatan:</div>
                                                <div class="col-sm-6">
                                                    <input  class="form-control" name="input_kecamatan" autocomplete="off" value="{{$ur->kecamatan}}"  readonly>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-6">Kodya:</div>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="input_kode_sandi_KotKab" value="{{$ur->kode_sandi_KotKab}}" readonly>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-6">Kode Jabatan:</div>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="input_kode_jabatan" value="{{$ur->kode_jabatan}}" readonly >
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-6">Pangsa Kepemilikan:</div>
                                                <div class="col-sm-6">
                                                   <div class="input-group">
                                                    <input class="form-control" name="input_pangsa_kepemilikan" autocomplete="off" value="{{$ur->pangsa_kepemilikan}}"  readonly>
                                                    <span class="input-group-addon">%</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-sm-6">Status Pengurus:</div>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="input_status_pengurus" value="{{$ur->status_pengurus}}" readonly>
                                                </div>
                                            </div>      
                                        </div> 
                                    </div>
                                    </div>
                                         <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                   @endforeach
                                         <div class="row form-group">
                                            @foreach($daftar as $daf)
                                             <!-- if((strpos(Auth::user()->fungsi, '1001') !== false)||(strpos(Auth::user()->fungsi, '7777') !== false)) -->
                                            <div hidden="text" class="col-sm-12" datain-id="{{$daf->no_kredit}}">
                                                <div class="col-sm-6">
                                                    <div class="col-sm-6"><b>Nomor Kredit :</b></div>
                                                    <div class="col-sm-6"> {{$daf->no_kredit}}</div>
                                                </div>
                                            </div>
                                                 <div class="col-sm-3"><br>
                                                    <input type="button" class="btn btn-danger" name="aden" value="ADDENDUM PENGURUS" />
                                                </div>
                                            <!-- endif -->
                                            @endforeach
                                        </div> 

                                    </div>
                                </div>
                        </fieldset>
                        <div class="row submitbtn1">
                            <div class="col-sm-12"><br>
                                <a href="{{ url('/lihatdata') }}" id="clear-filter" title="Input Nasabah Baru">[Kembali Ke Daftar]</a>
                                <a href="{{ url('/addnasabah') }}" id="clear-filter" title="Input Nasabah Baru">[Tambah Nasabah Individu]</a>
                                <a href="{{ url('/addnasabahbadan') }}" id="clear-filter" title="Input Nasabah Baru">[Tambah Nasabah Badan Usaha]</a>
                           </div>
                        </div>
                    </div>
                    
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')

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
       

    $('[name="hapus"]').click(function(){
            if($(this).val() == 'HAPUS BUKU'){
               window.open('{{url("/hapuskredit")}}'+'/'+$(this).parent().parent().find('div:first').attr('data-id'));
            } else if($(this).val() == 'MUTASI AGUNAN'){
                window.open('{{url("/hapusagunan")}}'+'/'+$(this).parent().parent().find('div:first').attr('datain-id'));
            } else if($(this).val() == 'TUKAR AGUNAN'){
                window.open('{{url("/tukaragunan")}}'+'/'+$(this).parent().parent().find('div:first').attr('datain-id'));
            } else if($(this).val() == 'CETAK HISTORY PAYMENT'){
                window.open('{{url("/cetak")}}'+'/'+$(this).parent().parent().find('div:first').attr('data-id'));
            } else if($(this).val() == 'CETAK JADWAL'){
                window.open('{{url("/cetakjadwal")}}'+'/'+$(this).parent().parent().find('div:first').attr('data-id'));
            } else if($(this).val() == 'CETAK KARTU ANGSURAN'){
                window.open('{{url("/cetakkartu")}}'+'/'+$(this).parent().parent().find('div:first').attr('data-id'));
            } else if($(this).val() == 'CETAK KARTU PEMBAYARAN'){
                window.open('{{url("/cetakbayar")}}'+'/'+$(this).parent().parent().find('div:first').attr('data-id'));
            } else if($(this).val() == 'PERBANDINGAN'){
                window.open('{{url("/banding")}}'+'/'+$(this).parent().parent().find('div:first').attr('data-id'));
            } 

        });

    $('[name="aden"]').click(function(){
            if($(this).val() == 'ADDENDUM_KREDIT'){
               window.open('{{url("/addkreditaden")}}'+'/'+$(this).parent().parent().find('div:first').attr('data-id'));
            } else if($(this).val() == 'ADDENDUM_AGUNAN'){
                window.open('{{url("/addagunanaden")}}'+'/'+$(this).parent().parent().find('div:first').attr('dataag-id'));
            } else if($(this).val() == 'ADDENDUM_PENJAMIN'){
                window.open('{{url("/addpenjaminaden")}}'+'/'+$(this).parent().parent().find('div:first').attr('datapen-id'));
            } else if($(this).val() == 'ADDENDUM PENJAMIN'){
                window.open('{{url("/addpenjaminaden")}}'+'/'+$(this).parent().parent().find('div:first').attr('datain-id'));
            } else if($(this).val() == 'ADDENDUM AGUNAN'){
                window.open('{{url("/addagunanaden")}}'+'/'+$(this).parent().parent().find('div:first').attr('datain-id'));
            } else if($(this).val() == 'ADDENDUM LAPORAN KEUANGAN'){
                window.open('{{url("/addlaporan")}}'+'/'+$(this).parent().parent().find('div:first').attr('datain-id'));
            } else if($(this).val() == 'ADDENDUM PENGURUS'){
                window.open('{{url("/addpengurusaden")}}'+'/'+$(this).parent().parent().find('div:first').attr('datain-id'));
            } 
        });
// $("#").datepicker({ dateFormat: 'dd-mm-yy' });
});
</script>
@endsection