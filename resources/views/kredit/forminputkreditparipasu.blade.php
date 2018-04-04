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
            <form class="form-horizontal" id="simpankreditform" role="form" method="POST" action="{{ url('/savekreditparipasu/$nonsb') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                    <div class="panel-heading"><h4 align="center">MASUKKAN DATA KREDIT PARIPASU</h4></div>
                            <div class="panel-body">
                            <div class="col-sm-3">
                                <?php
                                    echo "<font color='#ff0000'>* wajib diisi</font><br>";
                                ?>
                            </div>
                                    <div class="row">
                                    <div class="col-sm-12">  
                                        <div class="col-sm-6">
                                                <!-- <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal Permohonan</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="input_tgl_permohonan" autocomplete="off" style="text-transform:uppercase;" value="{{date('d-m-Y')}}" readonly />
                                                    </div>
                                                </div> -->
                                        @foreach($nasabah as $nas)
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nomor Nasabah</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="no_nsb" autocomplete="off" style="text-transform:uppercase;" value="{{$nas->no_nsb}}" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nomor CIF</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="no_cif" autocomplete="off" style="text-transform:uppercase;" value="{{$nas->no_cif}}" readonly />
                                                    </div>
                                                </div>
                                         @endforeach
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Nomor NPP</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="input_no_npp" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="masukkan nomor npp" maxlength="30" required />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama AO</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='nama_ao' >
                                                            <option value >-Pilih AO-</option>
                                                            @foreach($ao as $g)
                                                                <option value='{{$g->kodeao}}'>{{$g->kodeao}} - {{$g->kota}} - {{$g->namaao}} </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Kode Sifat Kredit</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='input_sifatkrd' required>
                                                            <option value >-Pilih Kode Sifat Kredit-</option>
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
                                                            <!-- <option value="9000" >9000 - Perseorangan (Penduduk)</option> -->
                                                            <option value >-Pilih Kode Takeover Dari-</option>
                                                            @foreach($ljk as $g)
                                                                <option value='{{$g->kode}}'>{{$g->kode}} - {{$g->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Frekuensi Restrukturisasi</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name='input_frekres' autocomplete="off" value="0" style="text-transform:uppercase;" placeholder="frekuensi restrukturisasi" id="fr" id="pesanfr"  readonly />
                                                    </div>
                                                </div>  
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal Restrukturisasi Awal</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" name='input_tgl_resawal' id="tanggalresawal" placeholder ="{{date('d-m-Y')}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal Restrukturisasi Akhir</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" name='input_tgl_resakhir'  id="tanggalresakhir" placeholder ="{{date('d-m-Y')}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Kode Cara Restrukturisasi</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='input_res' readonly>
                                                            <option value >-Pilih Kode Cara Restukturisasi-</option>
                                                            @foreach($res as $c)
                                                                <option value='{{$c->kode}}'>{{$c->kode}} - {{$c->cara}}</option>
                                                            @endforeach
                                                        </select>                                       
                                                    </div>
                                                </div>  
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Kode Jenis Kredit</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='input_kode_jenis_kredit' required>
                                                            <option value="05" >05 - Kredit/pembiayaan yang diberikan</option>
                                                            <option value >-Pilih Kode Jenis Kredit-</option>
                                                            @foreach($jns_krd as $j)
                                                                <option value='{{$j->sandi}}'>{{$j->sandi}} - {{$j->nama}}</option>
                                                            @endforeach
                                                        </select>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Kode Skim</label>
                                                    <div class="col-sm-9">
                                                    <select class="form-control" name='input_skim' required>
                                                            <option value="00" >00 - Konvensional</option>
                                                            <option value >-Pilih Kode Skim-</option>
                                                            @foreach($skim as $sm)
                                                                <option value='{{$sm->kode}}'>{{$sm->kode}} - {{$sm->skim}}</option>
                                                            @endforeach
                                                        </select>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">Nomor Akad Awal</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name='input_no_mohon' autocomplete="off" value="" style="text-transform:uppercase;" placeholder="nomor akad awal" />
                                                    </div>
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">Tanggal Akad Awal</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" name='input_tgl_mohon' id="tanggalmohon" placeholder ="{{date('d-m-Y')}}">
                                                    </div>
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">Nomor Akad Akhir</label>
                                                    <div class="col-sm-9">
                                                        <input type='text' class="form-control" name="input_no_mohon_akhir" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="nomor akad akhir" />
                                                    </div>
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">Tanggal Akad Akhir</label>
                                                    <div class="col-sm-9">
                                                      <input type='text' class="form-control" name="input_tgl_mohon_akhir" id="tanggalmohonakhir" placeholder ="{{date('d-m-Y')}}">
                                                    </div>
                                                </div>
                                               <!--  <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Baru/ Perpanjangan</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="input_baru_perpanjangan" required>
                                                            <option value >-Pilih Baru/Perpanjangan-</option>
                                                            <option value="1">Baru</option>
                                                            <option value="2">Perpanjangan</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Kode Kategori Debitur</label>
                                                    <div class="col-sm-9">
                                                    <select class="form-control" name='input_goldeb' required>
                                                            <!-- <option value="9000" >9000 - Perseorangan (Penduduk)</option> -->
                                                            <option value >-Pilih Kode Kategori Golongan Debitur-</option>
                                                            @foreach($kadeb as $g)
                                                                <option value='{{$g->sandi}}'>{{$g->sandi}} - {{$g->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Kode Jenis Penggunaan</label>
                                                    <div class="col-sm-9">
                                                    <select class="form-control" name='input_guna' required>
                                                            <option value >-Pilih Kode Jenis Penggunaan-</option>
                                                            @foreach($jnsbiaya as $jn)
                                                                <option value='{{$jn->kode}}'>{{$jn->kode}} - {{$jn->jns_penggunaan}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Kode Orientasi Penggunaan</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='input_ori' required>
                                                            <option value >-Pilih Kode Orientasi Penggunaan-</option>
                                                            @foreach($ori as $o)
                                                                <option value='{{$o->kode}}'>{{$o->kode}} - {{$o->jenis_penggunaan}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                        </div>
                                        <div class="col-sm-6">
                                                 <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Operator</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="opr" autocomplete="off" value="{{ trim(Auth::user()->nama_lengkap,' ') }}" style="text-transform:uppercase;" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Kode Kab/Kota</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='input_kodya_nasabah' required>
                                                            <option value="1293" >1293 - Malang,Kota</option>
                                                            <option value >-Pilih Kodya-</option>
                                                            @foreach($dati2 as $k)
                                                                <option value='{{$k->desc1}}'>{{$k->desc1}} - {{$k->desc2}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Kode Sektor Ekonomi</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='input_eko' required>
                                                            <option value="930000" >930000 - Jasa Kegiatan Lainnya</option>
                                                            <option value >-Pilih Kode Sektor Ekonomi-</option>
                                                            @foreach($eko as $ek)
                                                                <option value='{{$ek->kode}}'>{{$ek->kode}} - {{$ek->sektor_eko}}</option>
                                                            @endforeach
                                                        </select>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Kode Valuta</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='input_valuta'>
                                                            <option value="IDR" >IDR - Indonesian Rupiah</option>
                                                            <option value >-Pilih Kode Valuta-</option>
                                                            @foreach($valuta as $v)
                                                                <option default='IDR' value='{{$v->kode}}'>{{$v->kode}} - {{$v->nama_valuta}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Jenis Suku Bunga</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='input_jenis_bunga' required>
                                                            <option value="1" >1 - Suku Bunga Fixed</option>
                                                            <option value >-Pilih Jenis Suku Bunga-</option>
                                                            @foreach($jenisbunga as $b)
                                                                <option value='{{$b->sadi}}'>{{$b->sadi}} - {{$b->bunga}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Kredit Program Pemerintah</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='input_kreditpp' required>
                                                            <option value="001" >001 - Kredit Bukan Program Pemerintah</option>
                                                            <option value >-Pilih Kredit Program Pemerintah-</option>
                                                            @foreach($kreditpp as $p)
                                                                <option value='{{$p->sandi}}'>{{$p->sandi}} - {{$p->fas}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                  <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Sumber Dana</label>
                                                    <div class="col-sm-9">
                                                    <select class="form-control" name='input_sumber' required>
                                                            <option value="9000" >9000 - Perseorangan (Penduduk)</option>
                                                            <option value >-Pilih Kode Sumber Dana-</option>
                                                            @foreach($goldeb as $g)
                                                                <option value='{{$g->sandi}}'>{{$g->sandi}} - {{$g->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Kode Kolekbilitas</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='input_kolek'  required>
                                                            <option value >-Pilih Kode Kolekbilitas-</option>
                                                            <option value='1'>1 - Lancar</option>
                                                            <option value='2'>2 - Dalam Perhatian Khusus</option>
                                                            <option value='3'>3 - Kurang Lancar</option>
                                                            <option value='4'>4 - Diragukan</option>
                                                            <option value='5'>5 - Macet</option>
                                                            
                                                        </select>
                                                    </div>
                                                </div>  
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal Macet</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" name="input_tgl_macet" id="tanggalmacet" placeholder ="{{date('d-m-Y')}}" readonly >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Kode Sebab Macet</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='input_sebabmacet' readonly >
                                                            <option value >-Pilih Kode Sebab Macet-</option>
                                                            @foreach($sebabmacet as $m)
                                                                <option value='{{$m->kode}}'>{{$m->kode}} - {{$m->sbb_macet}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>  
                                                <!-- <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal Nunggak</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" name='input_tgl_nunggak' id="tanggalnunggak" placeholder ="{{date('d-m-Y')}}" >
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Frekuensi Tunggakan</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name='input_frek_tunggakan' autocomplete="off" value="0" style="text-transform:uppercase;" placeholder="frekuensi tunggakan" id="ft" id="pesanft" required />
                                                    </div>
                                                </div>  
                                                
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Kode Kondisi</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='input_kondisi' required>
                                                            <option value="00">00 - Fasilitas Aktif</option>
                                                            <option value >-Pilih Kode Kondisi-</option>
                                                            @foreach($kondisi as $k)
                                                                <option value='{{$k->kode}}'>{{$k->kode}} - {{$k->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>  
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal Kondisi</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" name='input_tgl_kondisi' id="tanggalkondisi" placeholder ="{{date('d-m-Y')}}" readonly>
                                                    </div>
                                                </div>  
                                                <div class="row form-group">
                                                <label class="col-sm-3 control-label">Keterangan</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name='input_ket' autocomplete="off" value="" style="text-transform:uppercase;" placeholder="keterangan" />
                                                    </div>
                                                </div> 
                                                <div class="row form-group">
                                                <label class="col-sm-3 control-label">*Kode Kantor Cabang</label>  <div class="col-sm-9">
                                                    <select class="form-control" name='input_kantor' required>
                                                        <option value >-Pilih Kode Kantor Cabang-</option>
                                                            @foreach($kode_kantor as $kn)
                                                            <option value='{{$kn->kode_angka}}''>{{$kn->kode_angka . ' ' . $kn->kode_huruf}}</option>
                                                            @endforeach
                                                    </select> 
                                                </div>
                                            </div>       
                                        </div>                           
                                    </div>   
                                </div>
                            <div class="panel-heading"><h4 align="center">SIMULASI KREDIT NASABAH</h4></div><br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Administrasi</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_adm" autocomplete="off" value="0" id="ad" id="pesanid"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Provisi</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_provisi" autocomplete="off" value="0" id="pr" id="pesanpr"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Notaris</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_notaris" autocomplete="off" value="0" id="not" id="pesannot"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Polis</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_polis" autocomplete="off" value="0" id="pol" id="pesanpol"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Asuransi Agunan</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_ass" autocomplete="off" value="0" id="as" id="pesanas"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Asuransi Jiwa</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_assjiwa" autocomplete="off" value="0" id="ji" id="pesanji"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Fee Mitra</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_feemitra" autocomplete="off" value="0" id="fe" id="pesanfe"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Lainnya</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_lain" autocomplete="off" value="0" id="lain" id="pesanlain"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Jenis Kredit</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="input_jeniskredit" required>
                                                    <option value="AR">ARREAR</option>
                                                    <option value="AV">ADVANCE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                          <div class="col-sm-3">
                                              <label class="control-label">*Produk Kredit</label> 
                                          </div>
                                          <div class="col-sm-9">
                                          <select class="form-control" id="inputJenisAngsuran" name="input_jenis_angsuran" required>
                                              <option value="FLAT">Angsuran Flat</option>
                                              <option value="BUNGA">Angsuran Bunga-Bunga</option>
                                              <option value="TARIKSETOR">Tarik Setor</option>
                                              <option value="BUNGATURUN">Bunga Menurun</option>
                                          </select>
                                          </div>
                                        </div>
                                        <div class="row form-group">
                                        <div class="col-sm-3">
                                            <label class="control-label" for="inputJangkaWaktuPembayaran">Pembayaran Pokok Tiap</label> 
                                          </div>
                                          <div class="col-sm-9">
                                            <div class="input-group">
                                              <input type="text" class="form-control" name="input_jangkawaktu_pembayaran" autocomplete="off" value=1 id="bulan" id="pesanbulan" readonly />
                                              <span class="input-group-addon">bulan</span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row form-group">
                                          <div class="col-sm-3">
                                            <label class="control-label" for="inputJangkaWaktu">*Jangka Waktu</label> 
                                          </div>
                                          <div class="col-sm-9">
                                            <div class="input-group">
                                              <input type="text" class="form-control rincian" id="inputJangkaWaktu" name="input_jangka_waktu" autocomplete="off" value='' required />
                                              <span class="input-group-addon">bulan</span>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Nilai Proyek</label>
                                            <div class="col-sm-9">
                                                 <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type='text' class="form-control" name="input_nilaiproyek" autocomplete="off" value="0" placeholder="0" id="nilpro" id="pesanpro" />
                                                </div>                                        
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Dp</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type='text' class="form-control" name="input_dp" autocomplete="off" value="" placeholder="0" id="dp" id="pesandp" required readonly  />
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Plafon Awal</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type='text' class="form-control" id="inputplafon" name="input_plafon" autocomplete="off" value="" placeholder="0" readonly  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Baki Debet</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type='text' class="form-control" id="inputbaki" name="input_baki" autocomplete="off" value="" placeholder="0" readonly  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-3">
                                              <label class="control-label" for="">*Pinjaman Pokok</label>
                                            </div>
                                            <div class="col-sm-9">
                                              <div class="input-group">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control" id="inputPokokHutang" name="input_pokok_hutang" autocomplete="off" value=0  required />
                                              </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-3">
                                                <label class="control-label" for="inputBunga">*Suku Bunga</label> 
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="inputBunga" name="input_bunga" autocomplete="off" value='' required />
                                                    <span class="input-group-addon">% / bulan</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pull-right">
                                              <div class="row">
                                                <div class="col-sm-4">
                                                  <button type="button" id="generateTable" class="btn btn-primary">Tampilkan Simulasi</button>
                                                </div>
                                              </div>
                                        </div>
                                    </div>
                                </div> 
  <!--Panel Tabel Pembayaran -->
                            <div class="row">
                                <div class="panel-heading text-center">
                                    <h4 class="panel-title">TABEL SIMULASI PEMBAYARAN</h4>
                                </div><br>
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                          <div class="col-sm-3">
                                            <label class="control-label" for="">Angsuran Pokok</label>
                                          </div>
                                          <div class="col-sm-8">
                                            <div class="input-group">
                                              <span class="input-group-addon">Rp.</span>
                                              <input type="text" class="form-control" id="inputAngsuranPokok" name="input_angsuran_pokok" autocomplete="off" value="0" readonly />
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row form-group">
                                          <div class="col-sm-3">
                                            <label class="control-label" for="">Angsuran Bunga</label>
                                          </div>
                                          <div class="col-sm-8">
                                            <div class="input-group">
                                              <span class="input-group-addon">Rp.</span>
                                              <input type="text" class="form-control" id="inputAngsuranBunga" name="input_angsuran_bunga" autocomplete="off" value="0" readonly/>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Saldo BBT</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type='text' class="form-control" name="input_bbt" autocomplete="off" value="0" placeholder="0"  readonly/>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Saldo Piutang</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type='text' class="form-control" name="input_saldo_piutang" autocomplete="off" value="0" placeholder="0"  readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Tanggal NPP Kredit</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name='input_tgl_kredit' value="{{date('d-m-Y')}}" readonly>
                                                </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Tanggal Mulai Angsuran</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name='input_tgl_mulai' value="{{date('d-m-Y')}}" readonly>
                                                </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Tanggal Jatuh Tempo Angsuran</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name='input_tgl_akhir' value="{{date('d-m-Y')}}" readonly>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div id="tabelPembayaran">
                            </div>

                            <div class="row submitbtn1">
                                <div class="col-sm-12">
                                    <button type="submit" id="simpandata" class="btn btn-primary" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">KE AGUNAN PARIPASU</button>
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
 $('[name="input_kondisi"]').on('change', function(){
                if ($(this).val() != "00") {
                   $(this).parent().parent().parent().find('[name="input_tgl_kondisi"]').removeAttr("readonly");
                } else if ($(this).val() == "00") {
                  $(this).parent().parent().parent().find('[name="input_tgl_kondisi"]').val();
                  $(this).parent().parent().parent().find('[name="input_tgl_kondisi"]').attr("readonly","readonly");
                  }
           });

$('[name="input_kolek"]').on('change', function(){
                if ($(this).val() == "5") {
                   $(this).parent().parent().parent().find('[name="input_tgl_macet"]').removeAttr("readonly");
                    $(this).parent().parent().parent().find('[name="input_sebabmacet"]').removeAttr("readonly");
                } else if ($(this).val() == "1") {
                  $(this).parent().parent().parent().find('[name="input_tgl_macet"]').val();
                  $(this).parent().parent().parent().find('[name="input_tgl_macet"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="input_sebabmacet"]').val();
                  $(this).parent().parent().parent().find('[name="input_sebabmacet"]').attr("readonly","readonly");
                  }
                  else if ($(this).val() == "2") {
                  $(this).parent().parent().parent().find('[name="input_tgl_macet"]').val();
                  $(this).parent().parent().parent().find('[name="input_tgl_macet"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="input_sebabmacet"]').val();
                  $(this).parent().parent().parent().find('[name="input_sebabmacet"]').attr("readonly","readonly");
                  }
                  else if ($(this).val() == "3") {
                  $(this).parent().parent().parent().find('[name="input_tgl_macet"]').val();
                  $(this).parent().parent().parent().find('[name="input_tgl_macet"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="input_sebabmacet"]').val();
                  $(this).parent().parent().parent().find('[name="input_sebabmacet"]').attr("readonly","readonly");
                  }
                  else if ($(this).val() == "4") {
                  $(this).parent().parent().parent().find('[name="input_tgl_macet"]').val();
                  $(this).parent().parent().parent().find('[name="input_tgl_macet"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="input_sebabmacet"]').val();
                  $(this).parent().parent().parent().find('[name="input_sebabmacet"]').attr("readonly","readonly");
                  }
           });    

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
