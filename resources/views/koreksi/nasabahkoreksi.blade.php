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
            <form class="form-horizontal" id="viewkreditform" role="form" method="post" action="{{ url('/savenasabahkoreksi/'.$nonsb) }}" >
             <!-- <form class="form-horizontal" id="viewkreditform" role="form" method="post" action="{{ url('/savenasabahbaru/$nonsb') }}" > -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                <div class="panel-heading"><h4 align="center">KOREKSI DATA NASABAH</h4></div>
                        <div class="panel-body"> 
                        <div class="row">
                            
                        
                <div class="col-sm-3">
                                <?php
                                    echo "<font color='#ff0000'>* wajib diisi</font><br>";
                                ?>
                            </div>
                        </div>
                @foreach($nasabah as $nas)
                    @if(($nas->kelamin == 'PRIA      ')||($nas->kelamin == 'WANITA    ')||($nas->kelamin == '          '))
                    <div class="panel-heading"><h4 align="center"><b>NASABAH INDIVIDU</b></h4></div><br>
                            <div clas="row" data-id="{{$nas->no_nsb}}">
                                  <div class="col-sm-12">   
                                     <div class="col-sm-6">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Nomor Nasabah</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" value="{{$nas->no_nsb}}" style="text-transform:uppercase;" readonly />
                                            </div>
                                        </div>
                                     </div>
                                      <div class="col-sm-6">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Operator</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="opr" autocomplete="off" value="{{ trim(Auth::user()->nama_lengkap,' ') }}" style="text-transform:uppercase;" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Nomor CIF</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="no_cif" autocomplete="off" value="{{trim($nas->no_cif,' ')}}" style="text-transform:uppercase;" readonly />
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="input_nama_nasabah" autocomplete="off" value="{{trim($nas->nama,' ')}}" style="text-transform:uppercase;" required/>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Gelar</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="input_gelar" required>
                                                    <option replace>{{trim($nas->gelar,' ' )}}</option>
                                                    <option value >-Ganti Gelar-</option>
                                                    @foreach($gelar as $g)
                                                        <option value="{{$g->kode}}">{{$g->kode}} - {{$g->gelar}}</option>    
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Jenis Kelamin</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="input_jenis_kelamin_nasabah" required>
                                                    <option replace>{{trim($nas->kelamin,' ')}}</option>
                                                    <option value >-Ganti Jenis Kelamin-</option>
                                                    <option value="PRIA">L - LAKI-LAKI</option>
                                                    <option value="WANITA">P - PEREMPUAN</option>
                                                    <!-- <option value="B">BADAN USAHA</option> -->
                                                </select>
                                            </div>
                                        </div>                                       
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Tempat/Tgl Lahir</label>
                                            <div class="col-sm-5">
                                              <input type="text" class="form-control" name="input_tempat_lahir_nasabah" autocomplete="off" value="{{trim($nas->tmplahir,' ')}}" style="text-transform:uppercase" required/>
                                            </div>
                                            <div class="col-sm-4">
                                              <input type="text" class="form-control" name="input_tanggal_lahir_nasabah" id="tanggallahir" value="{{date('d-m-Y',strtotime(trim($nas->tgllahir,' ')))}}" required >
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Nomor Telepon</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="input_telepon_rumah_nasabah" autocomplete="off" value="{{trim($nas->notelp,' ')}}" required/>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Nomor Telepon Seluler</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="input_no_hp_nasabah" autocomplete="off" value="{{trim($nas->nohp,' ')}}" />
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="input_email" autocomplete="off" value="{{trim($nas->email,' ')}}" />
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">No NPWP</label>
                                            <div class="col-sm-9">
                                              <input type="text" class="form-control" name="input_no_npwp" value="{{trim($nas->npwp,' ')}}" />
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Kode Jenis Identitas Penjamin</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="input_jenisid" required>
                                                    <option replace>{{trim($nas->id,' ')}}</option>
                                                    <option value >-Ganti ID-</option>
                                                    <option value="1">1 - KTP</option>
                                                    <option value="2">2 - PASPOR</option>
                                                    <option value="3">3 - NPWP</option>                                            
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*No Identitas</label>
                                            <div class="col-sm-9">
                                              <input type="text" class="form-control" name="input_no_identitas_nasabah" autocomplete="off" value="{{trim($nas->noktp,' ')}}" style="text-transform:uppercase" required/>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Tgl Berlaku</label>
                                            <div class="col-sm-9">
                                              <input type="text" class="form-control" name="input_tanggal_berlaku_nasabah" id="tanggalberlaku" value="{{date('d-m-Y',strtotime(trim($nas->tglktp,' ')))}}" >
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Alamat/Kode Pos</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="input_alamat_nasabah" autocomplete="off" value="{{trim($nas->alamat,' ')}}" style="text-transform:uppercase" required/>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control" name="input_kodepos_nasabah" autocomplete="off" value="{{trim($nas->kodepos,' ')}}" maxlength="5" />
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                        <label class="col-sm-3 control-label">RT/RW</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="input_rt_nasabah" autocomplete="off" value="{{trim($nas->rtrw,' ')}}" maxlength="7" />
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Kelurahan</label>
                                            <div class="col-sm-9">
                                                     <input type="text" class="form-control" name="input_kelurahan_nasabah" autocomplete="off" value="{{trim($nas->desa,' ')}}" style="text-transform:uppercase" required/>
                                                    <!-- <select class="form-control" name="input_kelurahan_nasabah" required>
                                                    <option replace>{{trim($nas->desa,' ')}}</option>
                                                    <option value >-Ganti Kelurahan-</option>
                                                    @foreach($kelurahan as $k)
                                                        <option value="{{$k->nama}}">{{$k->nama}}</option>
                                                    @endforeach
                                                </select> -->
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Kecamatan</label>
                                            <div class="col-sm-9">
                                                 <input type="text" class="form-control" name="input_kecamatan_nasabah" autocomplete="off" value="{{trim($nas->camat,' ')}}" style="text-transform:uppercase" required/>
                                                <!-- <select class="form-control" name="input_kecamatan_nasabah" required>
                                                    <option replace>{{trim($nas->camat,' ')}}</option>
                                                    <option value >-Ganti Kecamatan-</option>
                                                    @foreach($kecamatan as $k)
                                                        <option value="{{$k->nama}}">{{$k->nama}}</option>
                                                    @endforeach
                                                </select> -->
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Kodya</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="input_kodya_nasabah" required>
                                                    <option>{{trim($nas->dati2,' ')}}</option>
                                                    <option>-Ganti Kodya-</option>
                                                    @foreach($kodya as $k)
                                                        <option value="{{$k->desc1}}-{{$k->desc2}}">{{$k->desc1}}-{{$k->desc2}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                         <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Kode Negara Domisili</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="input_negara" required>
                                                    <option replace>{{trim($nas->negara,' ')}}</option>
                                                    <option value >-Ganti Kode Negara-</option>
                                                    @foreach($negara as $n)
                                                        <option value="{{$n->kode}}">{{$n->kode}} - {{$n->note}}</option>    
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"> 
                                       
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Nama Ibu Kandung</label>
                                            <div class="col-sm-8">
                                              <input type="text" class="form-control" name="input_nama_ibu_kandung_nasabah" value="{{trim($nas->namaibu,' ')}}" style="text-transform:uppercase" required />
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                        <label class="col-sm-3 control-label">*Pekerjaan Nasabah</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="input_pekerjaan_nasabah" required>
                                                    <option replace>{{trim($nas->kerja,' ')}}</option>
                                                    <option value >-Ganti Pekerjaan-</option>
                                                    @foreach($kerja as $k)
                                                        <option value="{{$k->kode}}">{{$k->kode}} - {{$k->note}}</option>    
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Tempat Bekerja</label>
                                            <div class="col-sm-8">
                                              <input type="text" class="form-control" name="input_tempat" value="{{trim($nas->tkerja,' ')}}" style="text-transform:uppercase" placeholder="tempat bekerja" required />
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Alamat Tempat Bekerja</label>
                                            <div class="col-sm-8">
                                              <input type="text" class="form-control" name="input_tempat_kerja" value="{{trim($nas->alamat_kerja,' ')}}" style="text-transform:uppercase" />
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Kode Sumber Penghasilan</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="input_sumber">
                                                    <option replace>{{trim($nas->sumber,' ')}}</option>
                                                    <option value >-Ganti Kode Sumber Penghasilan-</option>
                                                    @foreach($sumber as $s)
                                                        <option value="{{$s->kode}}">{{$s->kode}} - {{$s->nama}}</option>    
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                         <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Usaha</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="input_usaha_nasabah" required>
                                                    <option replace>{{trim($nas->kd_usaha,' ')}}</option>
                                                    <option value >-Ganti Bidang Usaha-</option>
                                                    @foreach($usaha as $u)
                                                        <option value="{{$u->kode}}">{{$u->kode}} - {{$u->sektor_eko}}</option>  
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Jumlah Tanggungan</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                  <input type="text" class="form-control" name="input_tanggungan" value="{{trim($nas->tanggungan,' ')}}" style="text-transform:uppercase" />
                                                <span class="input-group-addon">orang</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Pendapatan</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type="text" class="form-control" name="input_pendapatan_nasabah" autocomplete="off" value="{{trim($nas->gaji,' ')}}" required/>
                                                    <span class="input-group-addon">/ bulan</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Biaya Hidup</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type="text" class="form-control" name="input_biaya_hidup_nasabah" autocomplete="off" value="{{trim($nas->bi_hidup,' ')}}" />
                                                    <span class="input-group-addon">/ bulan</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Kode Hubungan Dengan Pelapor</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="input_bank" required>
                                                    <option replace>{{trim($nas->hubbank,' ')}}</option>
                                                    <option value >-Ganti Kode Hubungan Dengan Pelapor-</option>
                                                    @foreach($hubbank as $hb)
                                                        <option value="{{$hb->kode}}">{{$hb->kode}} - {{$hb->pelapor}}</option>    
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Kode Golongan Debitur</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="input_goldeb" required>
                                                    <option replace>{{trim($nas->goldeb,' ')}}</option>
                                                    <option value >-Ganti Kode Gololngan Debitur-</option>
                                                    @foreach($goldeb as $g)
                                                        <option value="{{$g->sandi}}">{{$g->sandi}} - {{$g->nama}}</option>    
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Perjanjian Pisah Harta</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="input_pisah_harta">
                                                    <option replace>{{trim($nas->pisah_harta,' ')}}</option>
                                                    <option value >-Ganti Perjanjian Pisah Harta-</option>
                                                    <option value="Y">YA</option>
                                                    <option value="T">TIDAK</option>
                                                </select>
                                            </div>                                       
                                        </div> 
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Melanggar bmpk bmpd bmpp</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="input_melanggar" required>
                                                    <option replace>{{trim($nas->melanggar,' ')}}</option>
                                                    <option value >-Ganti Melanggar bmpk bmpd bmpp-</option>
                                                    <option value="Y">YA</option>
                                                    <option value="T">TIDAK</option>
                                                </select>
                                            </div>  
                                        </div> 
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Melampaui bmpk bmpd bmpp</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="input_melampaui" required>
                                                    <option replace>{{trim($nas->melampaui,' ')}}</option>
                                                    <option value >-Ganti Melampaui bmpk bmpd bmpp-</option>
                                                    <option value="Y">YA</option>
                                                    <option value="T">TIDAK</option>
                                                </select>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                            </div>
                         
                                <div class="row">
                                    <!-- <div class="col-sm-12"> -->
                                        <div class="col-sm-6">
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">*Agama/Status</label>
                                                <div class="col-sm-4">
                                                    <select class="form-control" name="input_agama_nasabah" required  />
                                                        <option replace >{{trim($nas->agama,' ')}}</option>
                                                        <option value>-Ganti Agama-</option>
                                                        <option value="ISLAM">Islam</option>
                                                        <option value="KATHOLIK">Katolik</option>
                                                        <option value="PROTESTAN">Protestan</option>
                                                        <option value="BUDDHA">Buddha</option>
                                                        <option value="HINDU">Hindu</option>
                                                        <option value="KHONGHUCU">Khonghucu</option>
                                                    </select>
                                                </div>
                                                <div class="col-sm-5">
                                                    <select class="form-control" name ="input_status_nikah" >
                                                        <option replace >{{trim($nas->pernikahan,' ')}}</option>
                                                        <option value >-Ganti Status-</option>
                                                        <option value="0">0 - Kawin</option>
                                                        <option value="1">1 - Belum Kawin</option>
                                                        <option value="2">2 - Cerai Hidup</option>
                                                        <option value="3">3 - Cerai Mati</option>
                                                    </select>
                                                </div>
                                                <!-- <div class="col-sm-5">
                                                    <input class="form-control" name="input_status_nikah" value="{{trim($nas->pernikahan,' ')}}" >
                                                </div> -->
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </div>
                                <!-- <div class="panel-body"> -->
                                        <div class="row">
                                            <div class="col-sm-6" align="right">
                                                <input type="button" class="btn btn-warning" value="Tambah Pasangan" id="addAgSert" />
                                            </div>
                                        </div>
                                        <div class="AgunanSertifikat">

                                        </div>
                                    <br>
                                    <!-- </div> -->
                                        
                                        <!-- if($nas->pernikahan == 0) -->
                                    @if($nas->pernikahan == '0')
                                        @foreach ($psnasabah as $ps)
                                       <!-- ada isie -->
                                       
                                       <!--  <div class="row">
                                            <div class="panel panel-primary">
                                            <div class="panel-heading" align="center">DATA PASANGAN NASABAH</div>
                                                <div class="panel-body">
                                                      <div class="col-sm-12">
                                                     <div class="col-sm-4">
                                                        <div class="row form-group">
                                                            <div class="col-sm-6"><b>No.Nasabah :</b></div>
                                                            <div class="col-sm-6">{{trim($ps->no_nsb,' ')}}
                                                            </div>                                
                                                        </div>
                                                         @foreach ($nasabah as $nas)
                                                        <div class="row form-group">
                                                            <div class="col-sm-6"><b>No.CIF :</b></div>
                                                            <div class="col-sm-6">{{trim($nas->no_cif,' ')}}
                                                            </div>                                
                                                        </div>
                                                        @endforeach
                                                        <div class="row form-group" hidden>
                                                            <div class="col-sm-6"><b>Nikah :</b></div>
                                                            <div class="col-sm-6">{{trim($ps->ps_nikah,' ')}}
                                                            </div>                                
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-sm-6"><b>Nama :</b></div>
                                                            <div class="col-sm-6">{{trim($ps->ps_nama,' ')}}
                                                            </div>                                
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-sm-6"><b>Tempat/ Tanggal Lahir :</b></div>
                                                            <div class="col-sm-6">{{trim($ps->ps_tmplahir,' ')}} / {{date('d-m-Y',strtotime(trim($ps->ps_tgllahir,' ')))}}
                                                            </div>
                                                        </div> 

                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="row form-group">
                                                            <div class="col-sm-6"><b>Gelar :</b></div>
                                                            <div class="col-sm-6">{{trim($ps->ps_gelar,' ')}}
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-sm-6"><b>Agama :</b></div>
                                                            <div class="col-sm-6">{{trim($ps->ps_agama,' ')}}
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-sm-6"><b>Nomor Identitas :</b></div>
                                                                <div class="col-sm-6">{{trim($ps->ps_noktp,' ')}}
                                                                </div>
                                                        </div>                             
                                                        <div class="row form-group">
                                                            <div class="col-sm-6"><b>Nomor Telp :</b></div>
                                                                <div class="col-sm-6">{{trim($ps->ps_nohp,' ')}}
                                                                </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-sm-6"><b>Pekerjaan :</b></div>
                                                                <div class="col-sm-6">{{trim($ps->ps_pekerjaan,' ')}}
                                                                </div>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <div class="row form-group">
                                                            <div class="col-sm-6"><b>Alamat/Kode Pos :</b></div>
                                                            <div class="col-sm-6">{{trim($ps->ps_alamat,' ')}} 
                                                            / {{trim($ps->ps_kodepos,' ')}}
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-sm-6"><b>RT/RW :</b></div>
                                                            <div class="col-sm-6">{{trim($ps->ps_rtrw,' ')}}
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-sm-6"><b>Kelurahan :</b></div>
                                                            <div class="col-sm-6">{{trim($ps->ps_desa,' ')}}
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-sm-6"><b>Kecamatan :</b></div>
                                                            <div class="col-sm-6">{{trim($ps->ps_camat,' ')}}
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <div class="col-sm-6"><b>Kodya :</b></div>
                                                            <div class="col-sm-6">{{trim($ps->ps_kodya,' ')}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </div> -->
                                       
                                        
                                        <!-- endif -->
                                        <!-- kosongan -->
                                        <!-- foreach ($psnasabah as $ps) -->
                                        <!-- <div ng-if="pernikahan == 0">  -->
                                       
                                            <div class="panel panel-danger">   
                                                <div class="panel-heading" align="center">DATA PASANGAN NASABAH</div>
                                                <div class="panel-body">
                                                      <div class="col-sm-6">
                                                      @foreach($nasabah as $nas)
                                                      <div class="row form-group">
                                                            <label class="col-sm-3 control-label">No. Nasabah</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="input_no_nsb" autocomplete="off" value="{{$nas->no_nsb}}" style="text-transform:uppercase;" readonly  />
                                                            </div>                                
                                                        </div>
                                                    @endforeach
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">*Nama</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="input_nama_nasabah_ps" autocomplete="off" value="{{trim($ps->ps_nama,' ')}}" style="text-transform:uppercase;" required placeholder="NAMA" />
                                                            </div> 
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">*Tempat/ Tanggal Lahir</label>
                                                            <div class="col-sm-9">
                                                              <input type="text" class="form-control" name="input_tempat_lahir_nasabah_ps" autocomplete="off" value="{{trim($ps->ps_tmplahir,' ')}}" style="text-transform:uppercase" placeholder="tempat" />
                                                            </div>
                                                            <div class="col-sm-9">
                                                              <input type="text" class="form-control" name="input_tanggal_lahir_nasabah_ps" id="tanggallahirps" value="{{date('d-m-Y',strtotime(trim($ps->ps_tgllahir,' ')))}}" required placeholder = "dd-mm-yyyy" >
                                                            </div>
                                                        </div> 
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Gelar</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" name="input_gelar_ps">
                                                                     <option replace>{{trim($ps->ps_gelar,' ')}}</option>
                                                                    <option value >-Pilih Gelar-</option>
                                                                    @foreach($gelar as $g)
                                                                        <option value="{{$g->kode}}">{{$g->kode}} - {{$g->gelar}}</option>    
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Agama</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" name="input_agama_nasabah_ps">
                                                                    <option replace >{{trim($ps->ps_agama,' ')}}</option>
                                                                    <option value >-Pilih Agama-</option>
                                                                    <option value="ISLAM">Islam</option>
                                                                    <option value="KATHOLIK">Katolik</option>
                                                                    <option value="PROTESTAN">Protestan</option>
                                                                    <option value="BUDDHA">Buddha</option>
                                                                    <option value="HINDU">Hindu</option>
                                                                    <option value="KHONGHUCU">Khonghucu</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">*Nomor Identitas</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" name="input_ktp_ps" autocomplete="off" value="{{trim($ps->ps_noktp,' ')}}" style="text-transform:uppercase" maxlength="16" placeholder="3232323232323232" />
                                                                </div>
                                                        </div>
                                                           
                                                    </div>
                                                    <div class="col-sm-6">   
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Nomor Telp</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" name="input_nom_nasabah_ps" autocomplete="off" value="{{trim($ps->ps_nohp,' ')}}" style="text-transform:uppercase" placeholder="081222323232" />
                                                                </div>
                                                        </div> 
                                                        
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Pekerjaan</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" name="input_kerja_ps">
                                                                     <option replace >{{trim($ps->ps_pekerjaan,' ')}}</option>
                                                                    <option value >-Pilih Pekerjaan-</option>
                                                                   
                                                                    @foreach($kerja as $k)
                                                                        <option value="{{$k->kode}}">{{$k->kode}} - {{$k->note}}</option>    
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>  
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">*Alamat/Kode Pos</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control" name="input_alamat_nasabah_ps" autocomplete="off" value="{{trim($ps->ps_alamat,' ')}}" style="text-transform:uppercase" placeholder="ALAMAT" />
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="text" class="form-control" name="input_kodepos_nasabah_ps" autocomplete="off" value="{{trim($ps->ps_kodepos,' ')}}" maxlength="5" placeholder="651xx" />
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">RT/RW</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="input_rt_nasabah_ps" autocomplete="off" value="{{trim($ps->ps_rtrw,' ')}}" maxlength="7" placeholder="000" />
                                                            </div>
                                                            <!-- <div class="col-sm-4">
                                                                <input type="text" class="form-control" name="input_rw_nasabah_ps" autocomplete="off" value="" maxlength="3" placeholder="111" />
                                                            </div> -->
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Kelurahan</label>
                                                            <div class="col-sm-9">
                                                                     <input type="text" class="form-control" name="input_kelurahan_nasabah_ps" autocomplete="off" value="{{trim($ps->ps_desa,' ')}}" style="text-transform:uppercase" placeholder="kelurahan" />
                                                                    <!-- <select class="form-control" name="input_kelurahan_nasabah_ps" required>
                                                                    <option value >-Pilih Kelurahan-</option>
                                                                    @foreach($kelurahan as $k)
                                                                        <option value="{{$k->nama}}">{{$k->nama}}</option>
                                                                    @endforeach
                                                                </select> -->
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Kecamatan</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="input_kecamatan_nasabah_ps" autocomplete="off" value="{{trim($ps->ps_camat,' ')}}" style="text-transform:uppercase" placeholder="kecamatan" />
                                                                <!-- <select class="form-control" name="input_kecamatan_nasabah_ps" required>
                                                                    <option value >-Pilih Kecamatan-</option>
                                                                    @foreach($kecamatan as $k)
                                                                        <option value="{{$k->nama}}">{{$k->nama}}</option>
                                                                    @endforeach
                                                                </select> -->
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Kodya</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" name="input_kodya_nasabah_ps">
                                                                    <option replace>{{trim($ps->ps_kodya,' ')}}</option>
                                                                    <option value >-Pilih Kodya-</option>
                                                                    @foreach($kodya as $k)
                                                                        <option value="{{$k->desc2}}">{{$k->desc1}} - {{$k->desc2}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                   
                                                    </div>
                                                </div>
                                            </div> 
                                         
                                        <!-- </div>  -->
                                        @endforeach
                                    @endif 
                                </div>  
                    
                    @endif
                @endforeach
                
                @foreach($nasabah as $nas)
                    @if($nas->kelamin == 'BADANUSAHA')
                    <div class="panel-heading"><h4 align="center"><b>NASABAH BADAN USAHA</b></h4></div><br>
                    <div class="row" data-id="{{$nas->no_nsb}}">
                                        <div class="row form-group" hidden>
                                            <label class="col-sm-3 control-label">*Pendapatan</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type="text" class="form-control" name="input_pendapatan_nasabah" autocomplete="off" value="{{trim($nas->gaji,' ')}}" required/>
                                                    <span class="input-group-addon">/ bulan</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group" hidden>
                                            <label class="col-sm-3 control-label">Biaya Hidup</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type="text" class="form-control" name="input_biaya_hidup_nasabah" autocomplete="off" value="{{trim($nas->bi_hidup,' ')}}" />
                                                    <span class="input-group-addon">/ bulan</span>
                                                </div>
                                            </div>
                                        </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nomor Nasabah</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" value="{{$nas->no_nsb}}" style="text-transform:uppercase;" readonly />
                                        </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Operator</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="opr" autocomplete="off" value="{{ trim(Auth::user()->nama_lengkap,' ') }}" style="text-transform:uppercase;" readonly />
                                            </div>
                                        </div>
                                    </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group">
                                            <label class="col-sm-3 control-label">Nomor CIF</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="no_cif" autocomplete="off" value="{{trim($nas->no_cif,' ')}}" style="text-transform:uppercase;" readonly />
                                            </div>
                                        </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*No NPWP Badan Usaha</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_no_npwp" autocomplete="off" value="{{trim($nas->nobadan,' ')}}" style="text-transform:uppercase" maxlength="16" placeholder="323232323232323"  required/>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Nama Badan Usaha</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_nama_nasabah" autocomplete="off" value="{{trim($nas->nama,' ')}}" style="text-transform:uppercase;" placeholder="NAMA" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Jenis Kelamin</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_jenis_kelamin_nasabah" autocomplete="off" value="BADANUSAHA" style="text-transform:uppercase;" required />
                                    </div>
                                </div>
                                 <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Kode Bentuk Badan Usaha</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="input_badan" required>
                                            <option replace>{{trim($nas->jenisbadan,' ' )}}</option>
                                            <option value >-Ganti Kode Badan Usaha-</option>
                                            @foreach($badan as $n)
                                                <option value="{{$n->kode}}">{{$n->kode}} - {{$n->jns_badanusaha}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Tempat Pendirian</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_tempatberdiri" autocomplete="off" value="{{trim($nas->tempatberdiri,' ')}}" style="text-transform:uppercase;" placeholder="tmpat pendirian" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Nomor Akta Pendirian</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_noakta" autocomplete="off" 
                                        value="{{trim($nas->noakta,' ')}}" style="text-transform:uppercase;" placeholder="Nomor Akta Pendirian" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Tanggal Akta Pendirian</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_tanggal_akta" id="tanggalberlaku" value="{{date('d-m-Y',strtotime(trim($nas->tglakta,' ')))}}" >
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Nomor Akta Perubahan Terakhir</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_noakhir" autocomplete="off" value="{{trim($nas->noakhir,' ')}}" style="text-transform:uppercase;" placeholder="Nomor Akta Perubahan Terakhir" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Tanggal Akta Perubahan Terakhir</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_tanggal_aktaubah" id="tanggalakta" value="{{date('d-m-Y',strtotime(trim($nas->tglubah,' ')))}}" required >
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Nomor Telepon</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_telepon_rumah_nasabah" autocomplete="off" value="{{trim($nas->notelp,' ')}}" placeholder="0321812134"  required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nomor Telepon Seluler</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_no_hp_nasabah" autocomplete="off" value="{{trim($nas->nohp,' ')}}" placeholder="081222323232"  />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" name="input_email" autocomplete="off" 
                                        placeholder="noreply@gmail.com" value="{{trim($nas->email,' ')}}" />
                                    </div>
                                </div>
                                
                                
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Alamat/Kode Pos</label>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="input_alamat_nasabah" autocomplete="off" value="{{trim($nas->alamat,' ')}}" style="text-transform:uppercase" placeholder="ALAMAT" required />
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" name="input_kodepos_nasabah" autocomplete="off" value="{{trim($nas->kodepos,' ')}}" maxlength="5" placeholder="651xx" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                <label class="col-sm-3 control-label">RT/RW</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_rt_nasabah" autocomplete="off" value="{{trim($nas->rtrw,' ')}}" maxlength="7" placeholder="000" >
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Kelurahan</label>
                                            <div class="col-sm-8">
                                                    <select class="form-control" name="input_kelurahan_nasabah" required>
                                                    <option replace>{{trim($nas->desa,' ')}}</option>
                                                    <option value >-Ganti Kelurahan-</option>
                                                    @foreach($kelurahan as $k)
                                                        <option value="{{$k->nama}}">{{$k->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Kecamatan</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="input_kecamatan_nasabah" required>
                                                    <option replace>{{trim($nas->camat,' ')}}</option>
                                                    <option value >-Ganti Kecamatan-</option>
                                                    @foreach($kecamatan as $k)
                                                        <option value="{{$k->nama}}">{{$k->nama}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Kodya</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="input_kodya_nasabah" required>
                                            <option>{{trim($nas->dati2,' ')}}</option>
                                            <option>-Ganti Kodya-</option>
                                            @foreach($kodya as $k)
                                                <option value="{{$k->desc1}}-{{$k->desc2}}">{{$k->desc1}}-{{$k->desc2}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Kode Negara Domisili</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="input_negara" required>
                                            <option replace>{{trim($nas->negara,' ' )}}</option>
                                            <option value >-Ganti Kode Negara-</option>
                                            @foreach($negara as $n)
                                                <option value="{{$n->kode}}">{{$n->kode}} - {{$n->note}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Kode Bidang Usaha</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name='input_usaha_nasabah' required>
                                            <option replace>{{trim($nas->kd_usaha,' ' )}}</option>
                                                <option value >-Ganti Kode Bidang Usaha-</option>
                                                    @foreach($eko as $ek)
                                                        <option value='{{$ek->kode}}'>{{$ek->kode}} - {{$ek->sektor_eko}}</option>
                                                    @endforeach
                                            </select>                                        
                                        </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Kode Hubungan Dengan Pelapor</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="input_bank" required>
                                            <option replace>{{trim($nas->hubbank,' ' )}}</option>
                                            <option value >-Pilih Kode Hubungan Dengan Pelapor-</option>
                                            @foreach($hubbank as $hb)
                                                <option value="{{$hb->kode}}">{{$hb->kode}} - {{$hb->pelapor}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                 <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Melanggar bmpk bmpd bmpp</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="input_melanggar">
                                                    <option replace>{{trim($nas->melanggar,' ')}}</option>
                                                    <option value >-Ganti Melanggar bmpk bmpd bmpp-</option>
                                                    <option value="Y">YA</option>
                                                    <option value="T">TIDAK</option>
                                            </select>
                                        </div>  
                                </div> 
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Melampaui bmpk bmpd bmpp</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="input_melampaui">
                                                    <option replace>{{trim($nas->melampaui,' ')}}</option>
                                                    <option value >-Ganti Melampaui bmpk bmpd bmpp-</option>
                                                    <option value="Y">YA</option>
                                                    <option value="T">TIDAK</option>
                                            </select>
                                        </div>    
                                </div>
                                 <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Go Public</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="input_go" required>
                                            <option replace>{{trim($nas->go,' ')}}</option>
                                            <option value >-Ganti Go Public-</option>
                                            <option value="Y">YA</option>
                                            <option value="T">TIDAK</option>
                                        </select>
                                    </div>                                       
                                </div> 
                                 <div class="row form-group">
                                    <label class="col-sm-3 control-label">*Kode Golongan Debitur</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="input_goldeb" required>
                                            <option replace>{{trim($nas->goldeb,' ')}}</option>
                                            <option value >-Ganti Kode Gololngan Debitur-</option>
                                            @foreach($goldeb as $g)
                                                <option value="{{$g->sandi}}">{{$g->sandi}} - {{$g->nama}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Rating Debitur</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="input_rating" autocomplete="off" 
                                        value="{{trim($nas->rating,' ')}}" style="text-transform:uppercase" placeholder="Rating debitur"  />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kode Lembaga Pemeringkat</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="input_kode_lembaga_pemeringkat">
                                                <option replace>{{trim($nas->lembaga,' ')}}</option>
                                                <option value >-Ganti Kode Lembaga Pemeringkat-</option>
                                                @foreach($lembaga as $l)
                                                    <option value="{{$l->kode}}">{{$l->kode}} - {{$l->lmbg_peringkat}}</option>
                                                @endforeach
                                            </select> 
                                        </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Pemeringkat</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="input_tanggal_peringkat" id="tanggalperingkat" value="{{date('d-m-Y',strtotime(trim($nas->tglperingkat,' ')))}}" >
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nama Grup Debitur</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="input_grub" autocomplete="off" 
                                        value="{{trim($nas->grub,' ')}}" style="text-transform:uppercase" placeholder="grub debitur" />
                                    </div>
                                </div>
                            </div>
                        </div>
                         <div class="row submitbtn1">
                            <div class="col-sm-12">
                                     <!-- foreach($nasabah as $nas)
                                        <div class="row submitbtn0">
                                                <div class="text" class="col-sm-12" data-id="{{$nas->no_nsb}}" hidden>
                                                    <div class="col-sm-6">
                                                                <div class="col-sm-6"><b>Nomor nsb :</b></div>
                                                                <div class="col-sm-6"> {{$nas->no_nsb}}</div>
                                                            </div>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="button" class="btn btn-primary" name="kreditbadan" value="SIMPAN || KE KREDIT" />
                                                    
                                                </div>
                                            <br>
                                        </div>
                                    endforeach -->
                            </div>
                        </div>
                    @endif
                @endforeach
                                    <div class="row submitbtn1">
                                    <div class="col-sm-12">
                                    <!-- ismi -->
                                    <!-- if((strpos(Auth::user()->fungsi, '1001') !== false)||(strpos(Auth::user()->fungsi, '7777') !== false)) -->
                                        <button type="submit" class="btn btn-primary" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">SIMPAN</button>
                                    <!-- endif -->
                                    <!-- PUTRI -->
                                    <!-- if((strpos(Auth::user()->fungsi, '0001') !== false)||(strpos(Auth::user()->fungsi, '7777') !== false)) -->
                                        <!-- <button type="submit" class="btn btn-primary" name="simpanbutton">SIMPAN</button> -->
                                    <!-- endif -->
                                        <!-- <a href="{{ url('/addnasabah') }}" id="clear-filter" title="Input Nasabah Baru">[Tambah Nasabah Individu]</a>
                                        <a href="{{ url('/addnasabahbadan') }}" id="clear-filter" title="Input Nasabah Baru">[Tambah Nasabah Badan Usaha]</a> -->
                                    </div>
                                    </div>
                                </div>
                                </div>
                            
                        
                    
                    </div>
                </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="agunanSertifikat" data-op ="agunanSert" hidden>
    <hr style="height:1px;border:none;color:#444;background-color:#444;" />
    <div class="row">
        <div class="col-sm-12">
            <input type="button" value="Hapus"  class="btn btn-danger pull-right" name="hapusSert" />
        </div>
    </div>
    <br />
    <div class="panel panel-danger">   
                                                <div class="panel-heading" align="center">DATA PASANGAN NASABAH</div>
                                                <div class="panel-body">
                                                      <div class="col-sm-6">
                                                      @foreach($nasabah as $nas)
                                                      <div class="row form-group">
                                                            <label class="col-sm-3 control-label">No. Nasabah</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="input_no_nsb" autocomplete="off" value="{{$nas->no_nsb}}" style="text-transform:uppercase;" readonly  />
                                                            </div>                                
                                                        </div>
                                                    @endforeach
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">*Nama</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="input_nama_nasabah_ps" autocomplete="off" value="" style="text-transform:uppercase;" required placeholder="NAMA" />
                                                            </div> 
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">*Tempat/ Tanggal Lahir</label>
                                                            <div class="col-sm-9">
                                                              <input type="text" class="form-control" name="input_tempat_lahir_nasabah_ps" autocomplete="off" value="" style="text-transform:uppercase" placeholder="tempat" />
                                                            </div>
                                                            <div class="col-sm-9">
                                                              <input type="text" class="form-control" name="input_tanggal_lahir_nasabah_ps" id="tanggallahirps" value="" required placeholder = "dd-mm-yyyy" >
                                                            </div>
                                                        </div> 
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Gelar</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" name="input_gelar_ps">
                                                                    <option value >-Pilih Gelar-</option>
                                                                    @foreach($gelar as $g)
                                                                        <option value="{{$g->kode}}">{{$g->kode}} - {{$g->gelar}}</option>    
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Agama</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" name="input_agama_nasabah_ps">
                                                                    <option value >-Pilih Agama-</option>
                                                                    <option value="ISLAM">Islam</option>
                                                                    <option value="KATHOLIK">Katolik</option>
                                                                    <option value="PROTESTAN">Protestan</option>
                                                                    <option value="BUDDHA">Buddha</option>
                                                                    <option value="HINDU">Hindu</option>
                                                                    <option value="KHONGHUCU">Khonghucu</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">*Nomor Identitas</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" name="input_ktp_ps" autocomplete="off" value="" style="text-transform:uppercase" maxlength="16" placeholder="3232323232323232" />
                                                                </div>
                                                        </div>
                                                           
                                                    </div>
                                                    <div class="col-sm-6">   
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Nomor Telp</label>
                                                                <div class="col-sm-9">
                                                                  <input type="text" class="form-control" name="input_nom_nasabah_ps" autocomplete="off" value="" style="text-transform:uppercase" placeholder="081222323232" />
                                                                </div>
                                                        </div> 
                                                        
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Pekerjaan</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" name="input_kerja_ps">-->
                                                                    <option value >-Pilih Pekerjaan-</option>
                                                                    @foreach($kerja as $k)
                                                                        <option value="{{$k->kode}}">{{$k->kode}} - {{$k->note}}</option>    
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>  
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">*Alamat/Kode Pos</label>
                                                            <div class="col-sm-6">
                                                                <input type="text" class="form-control" name="input_alamat_nasabah_ps" autocomplete="off" value="" style="text-transform:uppercase" placeholder="ALAMAT" />
                                                            </div>
                                                            <div class="col-sm-3">
                                                                <input type="text" class="form-control" name="input_kodepos_nasabah_ps" autocomplete="off" value="" maxlength="5" placeholder="651xx" />
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">RT/RW</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="input_rt_nasabah_ps" autocomplete="off" value="" maxlength="7" placeholder="000" />
                                                            </div>
                                                            <!-- <div class="col-sm-4">
                                                                <input type="text" class="form-control" name="input_rw_nasabah_ps" autocomplete="off" value="" maxlength="3" placeholder="111" />
                                                            </div> -->
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Kelurahan</label>
                                                            <div class="col-sm-9">
                                                                     <input type="text" class="form-control" name="input_kelurahan_nasabah_ps" autocomplete="off" value="" style="text-transform:uppercase" placeholder="kelurahan" />
                                                                    <!-- <select class="form-control" name="input_kelurahan_nasabah_ps" required>
                                                                    <option value >-Pilih Kelurahan-</option>
                                                                    @foreach($kelurahan as $k)
                                                                        <option value="{{$k->nama}}">{{$k->nama}}</option>
                                                                    @endforeach
                                                                </select> -->
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Kecamatan</label>
                                                            <div class="col-sm-9">
                                                                <input type="text" class="form-control" name="input_kecamatan_nasabah_ps" autocomplete="off" value="" style="text-transform:uppercase" placeholder="kecamatan" />
                                                                <!-- <select class="form-control" name="input_kecamatan_nasabah_ps" required>
                                                                    <option value >-Pilih Kecamatan-</option>
                                                                    @foreach($kecamatan as $k)
                                                                        <option value="{{$k->nama}}">{{$k->nama}}</option>
                                                                    @endforeach
                                                                </select> -->
                                                            </div>
                                                        </div>
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Kodya</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" name="input_kodya_nasabah_ps">
                                                                    <option value >-Pilih Kodya-</option>
                                                                    @foreach($kodya as $k)
                                                                        <option value="{{$k->desc2}}">{{$k->desc1}} - {{$k->desc2}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                   
                                                    </div>
                                                </div>
                                            </div>    
</div>
@endsection

@section('js')

<script type="text/javascript">
$(document).ready(function() {
        $('[name="input_pendapatan_nasabah"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="input_biaya_hidup_nasabah"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

    $('[name="paripasu"]').click(function(){
            if($(this).val() == 'TAMBAH KREDIT PARIPASU'){
               window.open('{{url("/addkreditparipasu")}}'+'/'+$(this).parent().parent().find('div:first').attr('data-id'));
            } 
        });
    $('[name="kreditbadan"]').click(function(){
            if($(this).val() == 'SIMPAN || KE KREDIT'){
               open('{{url("/addkreditbadan")}}'+'/'+$(this).parent().parent().find('div:first').attr('data-id'));
            } 
        });

         // $("#tanggalmohon").datepicker({ dateFormat: 'dd-mm-yy' });
         $("#tanggalberlaku").datepicker({ dateFormat: 'dd-mm-yy' });
         $("#tanggallahir").datepicker({ dateFormat: 'dd-mm-yy' });
         $("#tanggallahirps").datepicker({ dateFormat: 'dd-mm-yy' });
         $("#tanggalberlaku").datepicker({ dateFormat: 'dd-mm-yy' });
         $("#tanggalakta").datepicker({ dateFormat: 'dd-mm-yy' });
         $("#tanggalperingkat").datepicker({ dateFormat: 'dd-mm-yy' });

    $('#addAgSert').click(function(){
            var $template = $('#agunanSertifikat'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                //.attr('id','tanahBangunanForm'+$('[data-jaminan="tanahBangunan"]').length)
                                //.attr('id','tanahBangunanForm'+INC_OP)
                                //.insertBefore($template);
                                .appendTo('.AgunanSertifikat');
            // $('[name="input_tgl_pengikatan[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            // $('[name="input_tgl_penilaianLJK[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            // $('[name="input_tgl_penilaian[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            $('[name="input_nilai_taksasi_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_pasar_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_njop_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_ht_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_agunanLJK[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilai_agunan_penilaiIndependent[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

            $("#input_tgl_pengikatan").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_penilaianLJK").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_penilaian").datepicker({ dateFormat: 'dd-mm-yy' });
            $('[name="input_status_paripasu[]"]').on('change', function(){
                if ($(this).val() == "Y") {
                   $(this).parent().parent().parent().find('[name="input_persent_paripasu[]"]').removeAttr("readonly");
                    $(this).parent().parent().parent().find('[name="input_persent_paripasu[]"]').removeAttr("readonly");
                } else if ($(this).val() == "T") {
                  $(this).parent().parent().parent().find('[name="input_persent_paripasu[]"]').val();
                  $(this).parent().parent().parent().find('[name="input_persent_paripasu[]"]').attr("readonly","readonly");
                  }
                  
           });
            // $('[name="input_nilai_njop_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            // $('[name="input_nilai_ht_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            // $('[name="input_nilai_pasar_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            // $('[name="input_nilai_taksasi_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="hapusSert"]').on('click',function(){
                $(this).parent().parent().parent().remove();
            });
        });
         
});
</script>
@endsection