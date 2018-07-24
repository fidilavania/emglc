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

            <form class="form-horizontal" id="simpanform" role="form" method="POST" action="{{ url('/savesdm/$nonsb') }}" enctype="multipart/form-data" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                    <div class="panel-heading"><h4 align="center">MASUKKAN DATA SDM</h4></div>
                    <div class="row">
                        <div class="col-sm-3">
                            <?php
                                echo "<font color='#ff0000'>wajib diisi*</font><br>";
                            ?>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_tanggal_mohon" id="tanggalmohon" value="{{date('d-m-Y')}}" readonly>
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
                                    <label class="col-sm-3 control-label">Nama*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_nama" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="NAMA" maxlength="50" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Jenis Kelamin*</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="input_jenis_kelamin" ng-model="kelamin" required>
                                            <option value >-Pilih Jenis Kelamin-</option>
                                            <option value="PRIA">PRIA</option>
                                            <option value="WANITA">WANITA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tempat Lahir</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_lahir" autocomplete="off" value="" style="text-transform:uppercase" placeholder="tempat" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Lahir*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_tanggal_lahir" id="tanggallahir" placeholder ="{{date('d-m-Y')}}"  required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nomor Telepon Rumah</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_telepon_rumah" autocomplete="off" value="" placeholder="0321xxxxxx" id="hp" id="pesan"  />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nomor Telepon Seluler*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_hp" autocomplete="off" value="" placeholder="081xxxxxxxx" id="hpku" id="pesanku" required/>
                                    </div>
                                </div>
                                
                                <!-- <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kode Jenis Identitas*</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="input_jenisid" required>
                                            <option value >-Pilih ID-</option>
                                            <option value="1">1 - KTP</option>
                                            <option value="2">2 - PASPOR</option>
                                            <option value="3">3 - NPWP</option>                                            
                                        </select>
                                    </div>
                                </div> -->
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">No KTP*</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_no_identitas" autocomplete="off" value="" style="text-transform:uppercase" maxlength="16" placeholder="323232323232323" id="ktp" id="pesanktp" required/>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">No KK</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_kk" autocomplete="off" value="" style="text-transform:uppercase" maxlength="16" placeholder="323232323232323" id="kk" id="pesankk"/>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                        <label class="col-sm-3 control-label">Agama*</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="input_agama" required>
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
                                    <label class="col-sm-3 control-label">No NPWP</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="input_no_npwp" value="" placeholder="npwp" style="text-transform:uppercase"/>
                                    </div>
                                </div>
                                <!-- <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tgl Berlaku</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_tanggal_berlaku" id="tanggalberlaku" placeholder ="{{date('d-m-Y')}}" >
                                    </div>
                                </div> -->
                               <div class="row form-group">
                                    <label class="col-sm-3 control-label">Status Rumah*</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="status_rumah" required>
                                                 <option value>-Pilih Status-</option>
                                                @foreach($status as $s)
                                                <option value="{{$s->kode_status}}">{{$s->status}}</option>
                                                 @endforeach
                                             </select>
                                        </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nama Kantor*</label>
                                        <div class="col-sm-8">
                                           <!--  <input type="text" class="form-control" name="kantor" value="{{ trim(Auth::user()->kantor,' ') }}" placeholder="npwp" style="text-transform:uppercase" readonly /> -->
                                            <select class="form-control" name="kantor" required>
                                                <option value>-Pilih Nama UB-</option>
                                                    @foreach($mkantor as $kan)  
                                                        <option value="{{$kan->kode_induk}}-{{$kan->kode_kantor}}">{{$kan->nama}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="row form-group" hidden="" >
                                    <label class="col-sm-3 control-label">Kantor Induk</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="induk_kantor" value="" style="text-transform:uppercase" placeholder=""  />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Status Kantor*</label>
                                   <div class="col-sm-8">
                                        <select class="form-control" name="input_status" required>
                                            <option value >-Pilih Status-</option>
                                            <option value="PUSAT">PUSAT</option>
                                            <option value="KAS PUSAT">KAS PUSAT</option>
                                            <option value="CABANG">CABANG</option>
                                            <option value="KAS CABANG">KAS CABANG</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Jabatan*</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="input_jabatan" required>
                                                <option value>-Pilih Jabatan-</option>
                                                    @foreach($jabatan as $jb)
                                                        <option value="{{$jb->jabatankantor}}">{{$jb->jabatankantor}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Pendidikan Terakhir*</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="pendidikan" required>
                                            <option value >-Pilih Pendidikan-</option>
                                            @foreach($gelar as $g)
                                                <option value="{{$g->kode}}">{{$g->gelar}}</option>    
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-8">
                                        <input type="email" class="form-control" name="input_email" autocomplete="off" 
                                        placeholder="noreply@gmail.com" />
                                    </div>
                                </div>
                                <div class="row form-group" hidden="">
                                    <label class="col-sm-3 control-label">Nama Ibu*</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="input_nama_ibu" value="" style="text-transform:uppercase" placeholder="NAMA"  />
                                    </div>
                                </div>
                                <div class="row form-group" hidden="">
                                    <label class="col-sm-3 control-label">Nama Ayah*</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="input_nama_ayah" value="" style="text-transform:uppercase" placeholder="NAMA"  />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Kerja*</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="input_tglkerja" value=""  placeholder="{{date('d-m-Y')}}" id="input_tglkerja" required />

                                     
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                
                                 <div class="form-group">
                                    <label class="col-sm-3 control-label">Upload Foto</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control-file" name="img_upload">Maksimal 2MB
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Status Pernikahan*</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="input_status_nikah" id="pernikahan" required/>
                                                <option value >-Pilih Status-</option>
                                                <option value="0">0 - Kawin</option>
                                                <option value="1">1 - Belum Kawin</option>
                                                <option value="2">2 - Cerai Hidup</option>
                                                <option value="3">3 - Cerai Mati</option>
                                            </select>
                                        </div>
                                        <div></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" align="right">
                                <!-- <input  type="button" class="btn btn-primary" value="Tambah Pasangan" id="addKantor" /> -->
                                <!-- <br/>
                                <br/> -->
                                <!-- <div class="KantorTambah"> -->
                                    <div id="kantorTambah" data-op ="kantor" hidden>
                                        <div class="row">
                                                                            <div class="col-sm-12">                                        
                                                                                <div class="panel panel-primary">
                                                                                  <div class="panel-heading" align="center">DATA PASANGAN SESUAI KTP</div>
                                                                                  <div class="panel-body">
                                                                                  <div class="col-sm-6">
                                                                                    <div class="row form-group">
                                                                                        <label class="col-sm-3 control-label">Nama*</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input type="text" class="form-control" name="input_nama_ps" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="NAMA" />
                                                                                        </div>                                
                                                                                    </div>
                                                                                    <div class="row form-group">
                                                                                        <label class="col-sm-3 control-label">Tempat/ Tanggal Lahir*</label>
                                                                                        <div class="col-sm-9">
                                                                                          <input type="text" class="form-control" name="input_tempat_lahir_ps" autocomplete="off" value="" style="text-transform:uppercase" placeholder="tempat" />
                                                                                        </div>
                                                                                        <div class="col-sm-9">
                                                                                          <input type="text" class="form-control" name="input_tanggal_lahir_ps" id="tanggallahirps" value="" placeholder = "{{date('d-m-Y')}}"" >
                                                                                        </div>
                                                                                    </div> 
                                                                                    <div class="row form-group">
                                                                                        <label class="col-sm-3 control-label">Pendidikan Terakhir</label>
                                                                                        <div class="col-sm-9">
                                                                                            <select class="form-control" name="input_gelar_ps">
                                                                                                <option value >-Pilih Gelar-</option>
                                                                                                @foreach($gelar as $g)
                                                                                                    <option value="{{$g->kode}}">{{$g->gelar}}</option>    
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row form-group">
                                                                                        <label class="col-sm-3 control-label">Agama*</label>
                                                                                        <div class="col-sm-9">
                                                                                            <select class="form-control" name="input_agama_ps">
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
                                                                                        <label class="col-sm-3 control-label">Nomor KTP*</label>
                                                                                            <div class="col-sm-9">
                                                                                              <input type="text" class="form-control" name="input_ktp_ps" autocomplete="off" value="" style="text-transform:uppercase" maxlength="16" id="ktpps" id="pesanktps" placeholder="3232323232323232" />
                                                                                            </div>
                                                                                    </div>
                                                                                     <div class="row form-group">
                                                                                        <label class="col-sm-3 control-label">Nomor Telp*</label>
                                                                                            <div class="col-sm-9">
                                                                                              <input type="text" class="form-control" name="input_nom_ps" autocomplete="off" value="" style="text-transform:uppercase" id="tlpps" id="pesantlps" placeholder="081222323232" />
                                                                                            </div>
                                                                                    </div>   
                                                                                </div>
                                                                                <div class="col-sm-6"> 
                                                                                    <div class="row form-group">
                                                                                        <label class="col-sm-3 control-label">Alamat/Kode Pos*</label>
                                                                                        <div class="col-sm-6">
                                                                                            <input type="text" class="form-control" name="input_alamat_ps" autocomplete="off" value="" style="text-transform:uppercase" placeholder="ALAMAT" />
                                                                                        </div>
                                                                                        <div class="col-sm-3">
                                                                                            <input type="text" class="form-control" name="input_kodepos_ps" autocomplete="off" value="" maxlength="5" placeholder="651xx" id="posps" id="pesanposs" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row form-group">
                                                                                        <label class="col-sm-3 control-label">RT/RW</label>
                                                                                        <div class="col-sm-5">
                                                                                            <input type="text" class="form-control" name="input_rt_ps" autocomplete="off" value="" maxlength="3" placeholder="000" id="rtps" id="pesanrts" />
                                                                                        </div>
                                                                                        <div class="col-sm-4">
                                                                                            <input type="text" class="form-control" name="input_rw_ps" autocomplete="off" value="" maxlength="3" placeholder="111"  id="rwps" id="pesanrws" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row form-group">
                                                                                        <label class="col-sm-3 control-label">Propinsi :*</label>
                                                                                        <div class="col-sm-9">
                                                                                          <select class="form-control" name="propinsips" >
                                                                                                     <option>-Pilih Propinsi-</option>
                                                                                                    @foreach($propinsi as $prop)
                                                                                                     <option value="{{$prop->propinsi}}">{{$prop->propinsi}}</option>
                                                                                                    @endforeach
                                                                                          </select>                        
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row form-group">
                                                                                        <label class="col-sm-3 control-label">Kodya :*</label>
                                                                                        <div class="col-sm-9">
                                                                                          <select class="form-control" name="input_kodya_ps" >
                                                                                                     <option>-Pilih Kodya Kab-</option>
                                                                                                    @foreach($kodya as $dati2)
                                                                                                    <option value="{{$dati2->kodya}}">{{$dati2->kodya}}</option>
                                                                                                     @endforeach
                                                                                          </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row form-group">
                                                                                        <label class="col-sm-3 control-label">Kecamatan :*</label>
                                                                                        <div class="col-sm-9">
                                                                                          <select class="form-control" name="input_kecamatan_ps" >
                                                                                                     <option>-Pilih Kecamatan-</option>
                                                                                                    @foreach($camat as $cmt)
                                                                                                    <option value="{{$cmt->camat}}">{{$cmt->camat}}</option>
                                                                                                     @endforeach
                                                                                          </select>
                                                                                        </div>
                                                                                    </div>
                                                                               
                                                                                    <div class="row form-group">
                                                                                        <label class="col-sm-3 control-label">Kelurahan :*</label>
                                                                                        <div class="col-sm-9">
                                                                                          <select class="form-control" name="input_kelurahan_ps" >
                                                                                                     <option>-Pilih Kelurahan-</option>
                                                                                                    @foreach($lurah as $lrh)
                                                                                                        <option value="{{$lrh->lurah}}">{{$lrh->lurah}}</option>
                                                                                                     @endforeach
                                                                                                    
                                                                                          </select>
                                                                                        </div>
                                                                                    </div>
                                                                        
                                                                                </div>
                                                                     <div class="col-sm-12">
                                                                        <input type="button" value="Hapus Pasangan" class="btn btn-danger pull-right" name="hapusalat" />
                                                                    </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                        </div>
                                    </div>
                                <!-- </div -->
                        </div>
                        <div class="col-sm-12">                                        
                            <div class="panel panel-primary">
                                <div class="panel-heading" align="center">DATA ALAMAT</div>
                                    <div class="panel-body">
                                        <div class="col-sm-6">
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Alamat KTP*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="input_alamatktp" autocomplete="off" value="" style="text-transform:uppercase" placeholder="ALAMAT" required />
                                        </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">RT/RW</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="input_rtktp" autocomplete="off" value="" maxlength="3" placeholder="000" id="rt" id="pesanrt" />
                                                            </div>
                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control" name="input_rwktp" autocomplete="off" value="" maxlength="3" placeholder="111" id="rw" id="pesanrw" />
                                                    </div>
                                            </div>
                            
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Propinsi :*</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="propinsiktp" required>
                                                 <option value>-Pilih Propinsi-</option>
                                                @foreach($propinsi as $prop)
                                                 <option value="{{$prop->propinsi}}">{{$prop->propinsi}}</option>
                                                @endforeach
                                      </select>                        
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kodya :*</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="input_kodyaktp" required>
                                                 <option value>-Pilih Kodya Kab-</option>
                                                @foreach($kodya as $dati2)
                                                <option value="{{$dati2->kodya}}">{{$dati2->kodya}}</option>
                                                 @endforeach
                                      </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kecamatan :*</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="input_kecamatanktp" required>
                                                 <option value>-Pilih Kecamatan-</option>
                                                @foreach($camat as $cmt)
                                                <option value="{{$cmt->camat}}">{{$cmt->camat}}</option>
                                                 @endforeach
                                      </select>
                                    </div>
                                </div>
                           
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kelurahan :*</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="input_kelurahanktp" required>
                                                 <option value>-Pilih Kelurahan-</option>
                                                @foreach($lurah as $lrh)
                                                    <option value="{{$lrh->lurah}}">{{$lrh->lurah}}</option>
                                                 @endforeach
                                                
                                      </select>
                                    </div>
                                </div>
                            
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kode Pos*</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="input_kodeposktp" autocomplete="off" value="" maxlength="5" placeholder="651xx" id="kodepos" id="pesanpos"  />
                                                    </div>
                                            </div> 
                                        </div>
                                        <div class="col-sm-6">
                                            
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Alamat Tinggal*</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="input_alamat" autocomplete="off" value="" style="text-transform:uppercase" placeholder="ALAMAT" required />
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">RT/RW</label>
                                                     <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="input_rt" autocomplete="off" value="" maxlength="3" placeholder="000" id="rt" id="pesanrt" />
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <input type="text" class="form-control" name="input_rw" autocomplete="off" value="" maxlength="3" placeholder="111" id="rw" id="pesanrw" />
                                                     </div>
                                            </div>

                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Propinsi :*</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="propinsi" required>
                                                 <option value>-Pilih Propinsi-</option>
                                                @foreach($propinsi as $prop)
                                                 <option value="{{$prop->propinsi}}">{{$prop->propinsi}}</option>
                                                @endforeach
                                                
                                      </select>
                                                                              
                                    </div>
                                     
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kodya :*</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="input_kodya" required>
                                                 <option value>-Pilih Kodya Kab-</option>
                                                @foreach($kodya as $dati2)
                                                <option value="{{$dati2->kodya}}">{{$dati2->kodya}}</option>
                                                 @endforeach
                                      </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kecamatan :*</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="input_kecamatan" required>
                                                 <option value>-Pilih Kecamatan-</option>
                                                @foreach($camat as $cmt)
                                                <option value="{{$cmt->camat}}">{{$cmt->camat}}</option>
                                                 @endforeach
                                      </select>
                                    </div>
                                </div>
                           
                            
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Kelurahan :*</label>
                                    <div class="col-sm-9">
                                      <select class="form-control" name="input_kelurahan" required>
                                                 <option value>-Pilih Kelurahan-</option>
                                                @foreach($lurah as $lrh)
                                                    <option value="{{$lrh->lurah}}">{{$lrh->lurah}}</option>
                                                 @endforeach
                                                
                                      </select>
                                    </div>
                                </div>
                                      
                                             <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kode Pos*</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="input_kodepos" autocomplete="off" value="" maxlength="5" placeholder="651xx" id="kodepos" id="pesanpos"  />
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                       
                        <div class="row submitbtn1">
                            <!-- <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" name="simpanbutton">KE KREDIT</button>
                            </div> -->
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">SIMPAN</button>
                                <a href="{{ url('/datasdm') }}" id="clear-filter" title="Input SDM Baru">[Kembali Ke Daftar]</a>
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

    $(document).ready(function() {

        $('[name="status_rumah"]').select2({ width: '100%' });
        $('[name="kantor"]').select2({ width: '100%' });
        $('[name="input_jabatan"]').select2({ width: '100%' });
        $('[name="pendidikan"]').select2({ width: '100%' });
        $('[name="input_jenis_kelamin"]').select2({ width: '100%' });
        $('[name="input_agama"]').select2({ width: '100%' });
        $('[name="input_status"]').select2({ width: '100%' });
        // $('[name="input_status_nikah"]').select2({ width: '100%' });
        $('[name="input_kodyaktp"]').select2({ width: '100%' });
        $('[name="input_kodya"]').select2({ width: '100%' });

        $('[name="propinsiktp"]').select2({ width: '100%' });
        $('[name="propinsi"]').select2({ width: '100%' });
        $('[name="input_kelurahan"]').select2({ width: '100%' });
        $('[name="input_kecamatan"]').select2({ width: '100%' });
        $('[name="input_kecamatanktp"]').select2({ width: '100%' });
        $('[name="input_kelurahanktp"]').select2({ width: '100%' });
        // $('[name="input_kodya_ps"]').select2({ width: '100%' });
        // $('[name="propinsips"]').select2({ width: '100%' });
       
       
        $('#input_tglkerja').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});
        $('#tanggallahir').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});
        //$('#tanggallahirps').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});
       
        $('[name="input_status_nikah"]').change(function(){
            var nikahi = ($('[name="input_status_nikah"]').val());
            if(nikahi == "0"){
                $('#kantorTambah').show();
                    // $('#kantorTambah').clone().appendTo('#kantorTambah');
                // console.log('masuk');
                 /*var $template = $('#kantorTambah'),
                    $clone    = $template
                                    .clone()
                                    .removeAttr('hidden')
                                    .removeAttr('id')
                                    //.attr('id','tanahBangunanForm'+$('[data-jaminan="tanahBangunan"]').length)
                                    //.attr('id','tanahBangunanForm'+INC_OP)
                                    //.insertBefore($template);
                                    .appendTo();*/
                // $('[name="input_tanggal_lahir_ps"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
                //$("#tanggallahirps").datepicker({ dateFormat: 'dd-mm-yy' });
                $('[name="input_tanggal_lahir_ps"]').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});

                $('[name="input_kodya_ps"]').select2({ width: '100%' });
                $('[name="propinsips"]').select2({ width: '100%' });
                $('[name="input_kelurahan_ps"]').select2({ width: '100%' });
                $('[name="input_kecamatan_ps"]').select2({ width: '100%' });

                    $('[name="propinsips"]').change(function(){
                        console.log($('[name="propinsips"]').val());
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                      }
                        });
                        $.ajax({
                            url:"{{ url('/pilih') }}",
                            type:"POST",
                            data: {'pilih' : $('[name="propinsips"]').val()
                            },
                            success: function(response){
                                var content = '<option value >-Pilih-</option>';
                                for(var x = 0; x < response.length; x++){
                                    content += '<option value="'+response[x].kodya+'">'+response[x].kodya+'</option>';
                                }
                                $('[name="input_kodya_ps"]').empty();
                                $('[name="input_kodya_ps"]').append(content);
                            },
                            error: function()
                            {
                              alert('Data tidak ditemukan');
                            }
                        });
                    });

                    $('[name="input_kodya_ps"]').change(function(){
                        console.log($('[name="input_kodya_ps"]').val());
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                      }
                        });
                        $.ajax({
                            url:"{{ url('/pilihcamat') }}",
                            type:"POST",
                            data: {'pilihcamat' : $('[name="input_kodya_ps"]').val()
                            },
                            success: function(response){
                                var content = '<option value >-Pilih-</option>';
                                for(var x = 0; x < response.length; x++){
                                    content += '<option value="'+response[x].camat+'">'+response[x].camat+'</option>';
                                }
                                $('[name="input_kecamatan_ps"]').empty();
                                $('[name="input_kecamatan_ps"]').append(content);
                            },
                            error: function()
                            {
                              alert('Data tidak ditemukan');
                            }
                        });
                    });
                    $('[name="input_kecamatan_ps"]').change(function(){
                        console.log($('[name="input_kecamatan_ps"]').val());
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                      }
                        });
                        $.ajax({
                            url:"{{ url('/pilihlurah') }}",
                            type:"POST",
                            data: {'pilihlurah' : $('[name="input_kecamatan_ps"]').val()
                            },
                            success: function(response){
                                var content = '<option value >-Pilih-</option>';
                                for(var x = 0; x < response.length; x++){
                                    content += '<option value="'+response[x].lurah+'">'+response[x].lurah+'</option>';
                                }
                                $('[name="input_kelurahan_ps"]').empty();
                                $('[name="input_kelurahan_ps"]').append(content);
                            },
                            error: function()
                            {
                              alert('Data tidak ditemukan');
                            }
                        });
                    });


                $('[name="input_ktp_ps"]').keypress(function(data){
                    if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
                    {
                        $("#pesanktps").html("isikan angka").show().fadeOut("slow");
                        return false;
                    }
                });
                
                $('[name="input_nom_ps"]').keypress(function(data){
                    if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
                    {
                        $("#pesanrws").html("isikan angka").show().fadeOut("slow");
                        return false;
                    }
                });
                
                $('[name="input_kodepos_ps"]').keypress(function(data){
                    if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
                    {
                        $("#pesanposs").html("isikan angka").show().fadeOut("slow");
                        return false;
                    }
                });

                $("#ktpps").keypress(function(data){
                    if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
                    {
                        $("#pesanktps").html("isikan angka").show().fadeOut("slow");
                        return false;
                    }
                });
                $('[name="input_rt_ps"]').keypress(function(data){
                    if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
                    {
                        $("#pesanrts").html("isikan angka").show().fadeOut("slow");
                        return false;
                    }
                });
                $('[name="input_rw_ps"]').keypress(function(data){
                    if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
                    {
                        $("#pesanrws").html("isikan angka").show().fadeOut("slow");
                        return false;
                    }
                });
                
                $('[name="hapusalat"]').on('click',function(){
                    $('[name="propinsips"]').select2('destroy');
                    $('[name="input_kodya_ps"]').select2('destroy');
                    $('[name="input_kelurahan_ps"]').select2('destroy');
                    $('[name="input_kecamatan_ps"]').select2('destroy');
                    $('#kantorTambah').hide();
                    //$(this).closest("div.row").remove();
                        //e.preventDefault();
                    // $(this).parent().parent().parent().remove();
                });
            }
       });


        $("#hp").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesan").html("isikan angka").show().fadeOut("slow");
                return false;
            }
         });
        $("#hpku").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanku").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#ktp").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanktp").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#kodepos").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanpos").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
             
        $("#rt").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanrt").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#rw").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanrw").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
       
        $('[name="propinsiktp"]').change(function(){
            console.log($('[name="propinsiktp"]').val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
            });
            $.ajax({
                url:"{{ url('/pilih') }}",
                type:"POST",
                data: {'pilih' : $('[name="propinsiktp"]').val()
                },
                success: function(response){
                    var content = '<option value >-Pilih-</option>';
                    for(var x = 0; x < response.length; x++){
                        content += '<option value="'+response[x].kodya+'">'+response[x].kodya+'</option>';
                    }
                    $('[name="input_kodyaktp"]').empty();
                    $('[name="input_kodyaktp"]').append(content);
                },
                error: function()
                {
                  alert('Data tidak ditemukan');
                }
            });
        });

        $('[name="input_kodyaktp"]').change(function(){
            console.log($('[name="input_kodyaktp"]').val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
            });
            $.ajax({
                url:"{{ url('/pilihcamat') }}",
                type:"POST",
                data: {'pilihcamat' : $('[name="input_kodyaktp"]').val()
                },
                success: function(response){
                    var content = '<option value >-Pilih-</option>';
                    for(var x = 0; x < response.length; x++){
                        content += '<option value="'+response[x].camat+'">'+response[x].camat+'</option>';
                    }
                    $('[name="input_kecamatanktp"]').empty();
                    $('[name="input_kecamatanktp"]').append(content);
                },
                error: function()
                {
                  alert('Data tidak ditemukan');
                }
            });
        });
        $('[name="input_kecamatanktp"]').change(function(){
            console.log($('[name="input_kecamatanktp"]').val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
            });
            $.ajax({
                url:"{{ url('/pilihlurah') }}",
                type:"POST",
                data: {'pilihlurah' : $('[name="input_kecamatanktp"]').val()
                },
                success: function(response){
                    var content = '<option value >-Pilih-</option>';
                    for(var x = 0; x < response.length; x++){
                        content += '<option value="'+response[x].lurah+'">'+response[x].lurah+'</option>';
                    }
                    $('[name="input_kelurahanktp"]').empty();
                    $('[name="input_kelurahanktp"]').append(content);
                },
                error: function()
                {
                  alert('Data tidak ditemukan');
                }
            });
        });

        $('[name="propinsi"]').change(function(){
            console.log($('[name="propinsi"]').val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
            });
            $.ajax({
                url:"{{ url('/pilih') }}",
                type:"POST",
                data: {'pilih' : $('[name="propinsi"]').val()
                },
                success: function(response){
                    var content = '<option value >-Pilih-</option>';
                    for(var x = 0; x < response.length; x++){
                        content += '<option value="'+response[x].kodya+'">'+response[x].kodya+'</option>';
                    }
                    $('[name="input_kodya"]').empty();
                    $('[name="input_kodya"]').append(content);
                },
                error: function()
                {
                  alert('Data tidak ditemukan');
                }
            });
        });

        $('[name="input_kodya"]').change(function(){
            console.log($('[name="input_kodya"]').val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
            });
            $.ajax({
                url:"{{ url('/pilihcamat') }}",
                type:"POST",
                data: {'pilihcamat' : $('[name="input_kodya"]').val()
                },
                success: function(response){
                    var content = '<option value >-Pilih-</option>';
                    for(var x = 0; x < response.length; x++){
                        content += '<option value="'+response[x].camat+'">'+response[x].camat+'</option>';
                    }
                    $('[name="input_kecamatan"]').empty();
                    $('[name="input_kecamatan"]').append(content);
                },
                error: function()
                {
                  alert('Data tidak ditemukan');
                }
            });
        });
        $('[name="input_kecamatan"]').change(function(){
            console.log($('[name="input_kecamatan"]').val());
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
            });
            $.ajax({
                url:"{{ url('/pilihlurah') }}",
                type:"POST",
                data: {'pilihlurah' : $('[name="input_kecamatan"]').val()
                },
                success: function(response){
                    var content = '<option value >-Pilih-</option>';
                    for(var x = 0; x < response.length; x++){
                        content += '<option value="'+response[x].lurah+'">'+response[x].lurah+'</option>';
                    }
                    $('[name="input_kelurahan"]').empty();
                    $('[name="input_kelurahan"]').append(content);
                },
                error: function()
                {
                  alert('Data tidak ditemukan');
                }
            });
        }); 
});
</script>
@endsection

