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
                                        <input type="text" class="form-control" name="input_nama" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="NAMA" required />
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
                                        <label class="col-sm-3 control-label">Agama*</label>
                                        <div class="col-sm-9">
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
                            </div>
                            <div class="col-sm-6">
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
                                                 <option>-Pilih Status-</option>
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
                                                <option>-Pilih Nama UB-</option>
                                                    @foreach($mkantor as $kan)
                                                    @if( trim($kan->kode_induk,' ') == trim(Auth::user()->kantor,' '))    
                                                        <option value="{{$kan->kode_induk}}-{{$kan->kode_kantor}}">{{$kan->nama}}</option>
                                                    @endif
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
                                                <option>-Pilih Jabatan-</option>
                                                    @foreach($jabatan as $jb)
                                                        <option value="{{$jb->kode}}">{{$jb->jabatankantor}}</option>
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
                                        <input type="file" class="form-control-file" name="img_upload">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Status Pernikahan*</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="input_status_nikah" ng-model="pernikahan" required/>
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
                        <div ng-if="pernikahan == 0">
                                        <div class="col-sm-12">                                        
                                            <div class="panel panel-primary">
                                              <div class="panel-heading" align="center">DATA PASANGAN SESUAI KTP</div>
                                              <div class="panel-body">
                                              <div class="col-sm-6">
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama*</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="input_nama_ps" autocomplete="off" value="" style="text-transform:uppercase;" required placeholder="NAMA" />
                                                    </div>                                
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tempat/ Tanggal Lahir*</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" name="input_tempat_lahir_ps" autocomplete="off" value="" style="text-transform:uppercase" placeholder="tempat" />
                                                    </div>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" name="input_tanggal_lahir_ps" id="tanggallahirps" value="" required placeholder = "{{date('d-m-Y')}}"" >
                                                    </div>
                                                </div> 
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Gelar</label>
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
                                                    <label class="col-sm-3 control-label">Kelurahan</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="input_kelurahan_ps" autocomplete="off" value="" style="text-transform:uppercase" placeholder="kelurahan" />
                                                       
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Kecamatan</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="input_kecamatan_ps" autocomplete="off" value="" style="text-transform:uppercase" placeholder="kecamatan" />
                                                     
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Kodya</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="input_kodya_ps">
                                                            <!-- <option value="1293" >1293 - Malang,Kota</option> -->
                                                            <option>-Pilih Kodya-</option>
                                                            @foreach($kodyaa as $k)
                                                                <option value="{{$k->desc2}}">{{$k->desc2}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                                </div>
                                            </div>
                                        </div>
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
                                                <label class="col-sm-3 control-label">Kelurahan*</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="input_kelurahanktp" autocomplete="off" value="" style="text-transform:uppercase" placeholder="KELURAHAN" required />
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kecamatan*</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="input_kecamatanktp" autocomplete="off" value="" style="text-transform:uppercase" placeholder="KECAMATAN" required />
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kodya*</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="input_kodyaktp" required>
                                                                    <!-- <option value="1293" >1293 - Malang,Kota</option> -->
                                                                    <option>-Pilih Kodya-</option>
                                                                    @foreach($kodyaa as $k)
                                                                        <option value="{{$k->desc2}}">{{$k->desc2}}</option>
                                                                    @endforeach
                                                                </select>
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kode Pos</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="input_kodeposktp" autocomplete="off" value="" maxlength="5" placeholder="651xx" id="kodepos" id="pesanpos"  />
                                                    </div>
                                            </div>   
                                            <div class="row form-group">
                                            <!-- <label class="col-sm-3 control-label">Alamat KTP*</label> -->
                                            <div class="col-sm-8">
                                                <input type='button' class="btn btn-danger" name="generatesample" style="text-transform:uppercase" value="Alamat tinggal sama dengan KTP"> <br>
                                            </div>
                                            </div>  
                                        </div>
                                        <div class="col-sm-6">
                                            
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Alamat Tinggal*</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_alamat" autocomplete="off" value="" style="text-transform:uppercase" placeholder="ALAMAT" required />
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">RT/RW</label>
                                                     <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="input_rt" autocomplete="off" value="" maxlength="3" placeholder="000" id="rt" id="pesanrt" />
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="input_rw" autocomplete="off" value="" maxlength="3" placeholder="111" id="rw" id="pesanrw" />
                                                     </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kelurahan*</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_kelurahan" autocomplete="off" value="" style="text-transform:uppercase" placeholder="KELURAHAN" required />
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kecamatan*</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_kecamatan" autocomplete="off" value="" style="text-transform:uppercase" placeholder="KECAMATAN" required />
                                                    </div>
                                            </div>
                                             <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kodya*</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kodya" required>
                                                            <!-- <option value="1293" >1293 - Malang,Kota</option> -->
                                                             <option>-Pilih Kodya-</option>
                                                            @foreach($kodyaa as $k)
                                                            <option value="{{$k->desc2}}">{{$k->desc2}}</option>
                                                             @endforeach
                                                         </select>
                                                    </div>
                                            </div>
                                             <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kode Pos</label>
                                                    <div class="col-sm-8">
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

    var SUBM = 0;
    function isNumber(nama,pesan) {
        var val = $('[name="'+nama+'"]').val().replace(/[\s-()]+/g, "");
        //return !isNaN(parseFloat(val)) && isFinite(val);
        if(!(!isNaN(parseFloat(val)) && isFinite(val))){
            $('.errormsg').append('<li class="text-danger">'+pesan+' hanya berisi angka</li>');
            $('[name="'+nama+'"]').css("background-color", "#F9CECE");
        }
    }
    function checkEmpty(nama,pesan){
        if($('[name="'+nama+'"]').val() == ''){
            $('.errormsg').append('<li class="text-danger">'+pesan+' wajib diisi</li>');
            $('[name="'+nama+'"]').css("background-color", "#F9CECE");
        }
    }

    $(document).ready(function() {

        

        $('[name="generatesample"]').click(function(){

        var alamatktp = ($('[name="input_alamatktp"]').val());
        var rtktp = ($('[name="input_rtktp"]').val());
        var rwktp = ($('[name="input_rwktp"]').val());
        var kelurahanktp = ($('[name="input_kelurahanktp"]').val());
        var kecamatanktp = ($('[name="input_kecamatanktp"]').val());
        var kodyaktp = ($('[name="input_kodyaktp"]').val());
        var kodeposktp = ($('[name="input_kodeposktp"]').val());

        $('[name="input_alamat"]').val(alamatktp);
        $('[name="input_rt"]').val(rtktp);
        $('[name="input_rw"]').val(rwktp);
        $('[name="input_kelurahan"]').val(kelurahanktp);
        $('[name="input_kecamatan"]').val(kecamatanktp);
        $('[name="input_kodya"]').val(kodyaktp);
        $('[name="input_kodepos"]').val(kodeposktp);

        });
        // $('[name="input_tanggal_lahir"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $("#tanggalmohon").datepicker({ dateFormat: 'dd-mm-yy' });
        // $("#tanggalberlaku").datepicker({ dateFormat: 'dd-mm-yy' });
        // $("#tanggallahir").datepicker({ dateFormat: 'dd-mm-yy' });
        // $("#tanggallahirps").datepicker({ dateFormat: 'dd-mm-yy' });
        // $("#input_tglkerja").datepicker({ dateFormat: 'dd-mm-yy' });
        $('[name="input_pendapatan"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="input_biaya_hidup"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('#input_tglkerja').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});
        $('#tanggallahir').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});
        $('#tanggallahirps').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});
        

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
        $("#tanggungan").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesantang").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#pendapatan").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesandapat").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#biaya").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanbi").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });

        //angular??


        $("#ktpps").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanktps").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        $("#rtps").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanrts").html("isikan angka").show().fadeOut("slow");
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
        $("#rwps").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanrws").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
        
        $("#posps").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanposs").html("isikan angka").show().fadeOut("slow");
                return false;
            }
        });
});
</script>
@endsection
