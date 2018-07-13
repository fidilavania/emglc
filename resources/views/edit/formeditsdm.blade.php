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

            <form class="form-horizontal" id="simpanform" role="form" method="POST" action="{{ url('/savesdmedit/$nonsb') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                    <div class="panel-heading"><h4 align="center">EDIT DATA SDM</h4></div>
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
                                    <label class="col-sm-3 control-label">Foto</label>
                                    <div class="col-sm-9">
                                         <img src="{{url(trim($sdm->foto,' '))}}" height="170" width="150"/>
                                         <!-- <input type="file" class="form-control-file" name="img_upload"> -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-3 control-label">Upload Foto</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control-file" name="img_upload">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nama*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_nama" autocomplete="off" value="{{trim($sdm->nama,' ')}}" style="text-transform:uppercase;" placeholder="NAMA" required />
                                    </div>
                                </div>
                                <div class="row form-group" hidden="">
                                    <label class="col-sm-3 control-label">no sdm*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_nosdm" autocomplete="off" value="{{trim($sdm->no_sdm,' ')}}" />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Jenis Kelamin*</label>
                                    <div class="col-sm-9">
                                        <select class="form-control" name="input_jenis_kelamin" required>
                                            <option replace>{{trim($sdm->jenis_kel,' ')}}</option>
                                            <option>-Ganti Jenis Kelamin-</option>
                                            <option value="PRIA">PRIA</option>
                                            <option value="WANITA">WANITA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tempat Lahir</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_lahir" autocomplete="off" value="{{trim($sdm->tempat_lahir,' ')}}" style="text-transform:uppercase" placeholder="tempat" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal Lahir*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_tanggal_lahir" id="tanggallahir" placeholder ="{{date('d-m-Y')}}" value="{{date('d-m-Y',strtotime(trim($sdm->tgl_lahir)))}}" required>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nomor Telepon Rumah</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_telepon_rumah" autocomplete="off" value="{{trim($sdm->notlp,' ')}}" placeholder="0321xxxxxx" id="hp" id="pesan"  />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nomor Telepon Seluler*</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="input_hp" autocomplete="off" value="{{trim($sdm->nohp,' ')}}" placeholder="081xxxxxxxx" id="hpku" id="pesanku" required/>
                                    </div>
                                </div>
                                <div class="row form-group">
                                        <label class="col-sm-3 control-label">Agama*</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="input_agama" required>
                                                <option replace>{{trim($sdm->agama,' ')}}</option>
                                                <option>-Ganti Agama-</option>
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
                                    <label class="col-sm-3 control-label">No KTP*</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="input_no_identitas" autocomplete="off" value="{{trim($sdm->ktp,' ')}}" style="text-transform:uppercase" maxlength="16" placeholder="323232323232323" id="ktp" id="pesanktp" required/>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">No KK</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="input_kk" autocomplete="off" value="{{trim($sdm->no_kk,' ')}}" style="text-transform:uppercase" maxlength="16" placeholder="323232323232323" id="kk" id="pesankk"/>
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">No NPWP</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" name="input_no_npwp" value="{{trim($sdm->npwp,' ')}}" placeholder="npwp" style="text-transform:uppercase"/>
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
                                                @foreach($lihat1 as $l)
                                                    <option value="{{$l->status_rumah}}">{{trim($l->status,' ')}}</option>
                                                @endforeach
                                                <!-- <option replace>{{trim($sdm->status_rumah,' ')}}</option> -->
                                                <option>-Ganti Status-</option>
                                                @foreach($status as $s)
                                                <option value="{{$s->kode_status}}">{{$s->status}}</option>
                                                 @endforeach
                                             </select>
                                        </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nama Kantor*</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="kantor" value="{{trim($sdm->kantor,' ')}}" placeholder="kantor" style="text-transform:uppercase" readonly />
                                        </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Status Kantor*</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="input_status" required>
                                            <option replace>{{trim($sdm->status_kantor,' ')}}</option>
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
                                                <option replace>{{trim($sdm->jabatan,' ')}}</option>
                                                <option>-Ganti Jabatan-</option>
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
                                            @foreach($lihat3 as $l)
                                                    <option  value="{{trim($l->pendidikan,' ')}}">{{trim($l->gelar,' ')}}</option>
                                            @endforeach
                                            <option>-Ganti Pendidikan-</option>
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
                                        placeholder="noreply@gmail.com" value="{{trim($sdm->email,' ')}}" />
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
                                      <input type="text" class="form-control" name="input_tglkerja" value="{{date('d-m-Y',strtotime(trim($sdm->tgl_kerja)))}}" style="text-transform:uppercase" placeholder="{{date('d-m-Y')}}" id="input_tglkerja" required />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Status Pernikahan*</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="input_status_nikah" id="pernikahan" required>
                                                @if($sdm->nikah == '0')
                                                <option value="0">Kawin</option>
                                                @else
                                                    @foreach($lihat4 as $l)
                                                    <option value="{{trim($l->nikah,' ')}}">{{trim($l->nama,' ')}}</option>
                                                    @endforeach
                                                @endif
                                                <option >-Ganti Status-</option>
                                                <option value="0">0 - Kawin</option>
                                                <option value="1">1 - Belum Kawin</option>
                                                <option value="2">2 - Cerai Hidup</option>
                                                <option value="3">3 - Cerai Mati</option>
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-6">
                                <!-- ng-model="pernikahan" -->
                                
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
                            <!-- <div class="row"> -->
                                            <div class="col-sm-6">
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama*</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="input_nama_ps" autocomplete="off" value="{{trim($sdm->nama_ps,' ')}}" style="text-transform:uppercase;" required placeholder="NAMA" />
                                                    </div>                                
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tempat/ Tanggal Lahir*</label>
                                                    <div class="col-sm-9">
                                                      <input type="text" class="form-control" name="input_tempat_lahir_ps" autocomplete="off" value="{{trim($sdm->tempat_lahir_ps,' ')}}" style="text-transform:uppercase" placeholder="tempat" />
                                                    </div>
                                                    <div class="col-sm-9">
                                                      @if($sdm->lahir_ps == '1970-01-01')
                                                      <input type="text" class="form-control" name="input_tanggal_lahir_ps" id="tanggallahirps" value="" required placeholder = "{{date('d-m-Y')}}" >
                                                      @else
                                                      <input type="text" class="form-control" name="input_tanggal_lahir_ps" id="tanggallahirps" value="{{date('d-m-Y',strtotime(trim($sdm->lahir_ps)))}}" required placeholder = "{{date('d-m-Y')}}" >
                                                      @endif
                                                    </div>
                                                </div> 
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Gelar</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="input_gelar_ps" required>
                                                            @foreach($lihat5 as $l)
                                                                    <option  value="{{trim($l->gelar_ps,' ')}}">{{trim($l->gelar,' ')}}</option>
                                                            @endforeach
                                                            <option>-Ganti Pendidikan-</option>
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
                                                            <option replace>{{trim($sdm->agama_ps,' ')}}</option>
                                                            <option value >-Ganti Agama-</option>
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
                                                          <input type="text" class="form-control" name="input_ktp_ps" autocomplete="off" value="{{trim($sdm->ktp_ps,' ')}}" style="text-transform:uppercase" maxlength="16" id="ktpps" id="pesanktps" placeholder="3232323232323232" />
                                                        </div>
                                                </div>
                                                 <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nomor Telp*</label>
                                                        <div class="col-sm-9">
                                                          <input type="text" class="form-control" name="input_nom_ps" autocomplete="off" value="{{trim($sdm->tlp_ps,' ')}}" style="text-transform:uppercase" id="tlpps" id="pesantlps" placeholder="081222323232" />
                                                        </div>
                                                </div>   
                                            </div>
                                            <div class="col-sm-6"> 
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Alamat/Kode Pos*</label>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_alamat_ps" autocomplete="off" value="{{trim($sdm->alamat_ps,' ')}}" style="text-transform:uppercase" placeholder="ALAMAT" />
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="text" class="form-control" name="input_kodepos_ps" autocomplete="off" value="{{trim($sdm->kodepos_ps,' ')}}" maxlength="5" placeholder="651xx" id="posps" id="pesanposs" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">RT/RW</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="input_rt_ps" autocomplete="off" value="{{trim($sdm->rtrw_ps,' ')}}" placeholder="000/000"  />
                                                    </div>
                                                </div>
                                                    <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Propinsi :</label>
                                                            <div class="col-sm-9">
                                                                <select class="form-control" name="propinsips" required>
                                                                    <option replace>{{trim($sdm->propps,' ')}}</option>
                                                                    <option>-Pilih Propinsi-</option>
                                                                    @foreach($propinsi as $prop)
                                                                    <option value="{{$prop->propinsi}}">{{$prop->propinsi}}</option>
                                                                    @endforeach
                                                                </select>                        
                                                            </div>
                                                    </div>
                                                                                    <div class="row form-group">
                                                                                        <label class="col-sm-3 control-label">Kodya :</label>
                                                                                        <div class="col-sm-9">
                                                                                          <select class="form-control" name="input_kodya_ps" required>
                                                                                                    <option replace>{{trim($sdm->kodya_ps,' ')}}</option>
                                                                                                     <option>-Pilih Kodya Kab-</option>
                                                                                                    @foreach($kodya as $dati2)
                                                                                                    <option value="{{$dati2->kodya}}">{{$dati2->kodya}}</option>
                                                                                                     @endforeach
                                                                                          </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row form-group">
                                                                                        <label class="col-sm-3 control-label">Kecamatan :</label>
                                                                                        <div class="col-sm-9">
                                                                                          <select class="form-control" name="input_kecamatan_ps" required>
                                                                                                    <option replace>{{trim($sdm->camat_ps,' ')}}</option>
                                                                                                     <option>-Pilih Kecamatan-</option>
                                                                                                    @foreach($camat as $cmt)
                                                                                                    <option value="{{$cmt->camat}}">{{$cmt->camat}}</option>
                                                                                                     @endforeach
                                                                                          </select>
                                                                                        </div>
                                                                                    </div>
                                                                               
                                                                                    <div class="row form-group">
                                                                                        <label class="col-sm-3 control-label">Kelurahan :</label>
                                                                                        <div class="col-sm-9">
                                                                                          <select class="form-control" name="input_kelurahan_ps" required>
                                                                                                    <option replace>{{trim($sdm->lurah_ps,' ')}}</option>
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
                            <!-- </div> -->
                        </div>
                </div>
        </div>
    </div>
</div>
                                <!-- </div> -->
                            </div>
                        <div class="col-sm-12">                                        
                            <div class="panel panel-primary">
                                <div class="panel-heading" align="center">DATA ALAMAT</div>
                                    <div class="panel-body">
                                        <div class="col-sm-6">
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Alamat KTP*</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="input_alamatktp" autocomplete="off" value="{{trim($sdm->alamat_ktp,' ')}}" style="text-transform:uppercase" placeholder="ALAMAT" required />
                                        </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">RT/RW</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="input_rtktp" autocomplete="off" value="{{trim($sdm->rtrw_ktp,' ')}}" placeholder="000/000"  />
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Propinsi</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="propinsiktp" required>
                                                                    <option replace>{{trim($sdm->propktp,' ')}}</option>
                                                                    <option>-Pilih Propinsi-</option>
                                                                    @foreach($propinsi as $k)
                                                                        <option value="{{$k->propinsi}}">{{$k->propinsi}}</option>
                                                                    @endforeach
                                                        </select>
                                                        <!-- <input type="text" class="form-control" name="propinsiktp" autocomplete="off" value="{{trim($sdm->propktp,' ')}}" style="text-transform:uppercase" placeholder="PROPINSI" required /> -->
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kodya*</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="input_kodyaktp" required>
                                                                   <option replace>{{trim($sdm->kodya_ktp,' ')}}</option>
                                                                    <option>-Ganti Kodya-</option>
                                                                    @foreach($kodya as $dati2)
                                                                    <option value="{{$dati2->kodya}}">{{$dati2->kodya}}</option>
                                                                    @endforeach
                                                                </select>
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kecamatan :</label>
                                                <div class="col-sm-9">
                                                  <select class="form-control" name="input_kecamatanktp" required>
                                                             <option replace>{{trim($sdm->camat_ktp,' ')}}</option>
                                                             <option>-Pilih Kecamatan-</option>
                                                            @foreach($camat as $cmt)
                                                            <option value="{{$cmt->camat}}">{{$cmt->camat}}</option>
                                                             @endforeach
                                                  </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kelurahan :</label>
                                                <div class="col-sm-9">
                                                  <select class="form-control" name="input_kelurahanktp" required>
                                                            <option replace>{{trim($sdm->lurah_ktp,' ')}}</option>
                                                            <option>-Pilih Kelurahan-</option>
                                                            @foreach($lurah as $lrh)
                                                                <option value="{{$lrh->lurah}}">{{$lrh->lurah}}</option>
                                                             @endforeach
                                                            
                                                  </select>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kode Pos</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" name="input_kodeposktp" autocomplete="off" value="{{trim($sdm->kodepos_ktp,' ')}}" maxlength="5" placeholder="651xx" id="kodepos" id="pesanpos"  />
                                                    </div>
                                            </div>   
                                            <div class="row form-group">
                                            <!-- <label class="col-sm-3 control-label">Alamat KTP*</label> -->
                                            <div class="col-sm-8">
                                                <!-- <input type='button' class="btn btn-danger" name="generatesample" style="text-transform:uppercase" value="Alamat tinggal sama dengan KTP"> <br> -->
                                            </div>
                                            </div>  
                                        </div>
                                        <div class="col-sm-6">
                                            
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Alamat Tinggal*</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_alamat" autocomplete="off" value="{{trim($sdm->alamat_tinggal,' ')}}" style="text-transform:uppercase" placeholder="ALAMAT" required />
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">RT/RW</label>
                                                     <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_rt" autocomplete="off" value="{{trim($sdm->rtrw_tinggal,' ')}}" placeholder="000/000"/>
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Propinsi</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="propinsi" required>
                                                                    <option replace>{{trim($sdm->prop,' ')}}</option>
                                                                    <option>-Pilih Propinsi-</option>
                                                                    @foreach($propinsi as $k)
                                                                        <option value="{{$k->propinsi}}">{{$k->propinsi}}</option>
                                                                    @endforeach
                                                        </select>
                                                        <!-- <input type="text" class="form-control" name="propinsi" autocomplete="off" value="{{trim($sdm->prop,' ')}}" style="text-transform:uppercase" placeholder="PROPINSI" required /> -->
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kodya*</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kodya" required>
                                                            <option replace>{{trim($sdm->kodya_tinggal,' ')}}</option>
                                                            <option>-Ganti Kodya-</option>
                                                            @foreach($kodya as $dati2)
                                                            <option value="{{$dati2->kodya}}">{{$dati2->kodya}}</option>
                                                            @endforeach
                                                         </select>
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kecamatan :</label>
                                                <div class="col-sm-8">
                                                  <select class="form-control" name="input_kecamatan" required>
                                                            <option replace>{{trim($sdm->camat_tinggal,' ')}}</option>
                                                            <option>-Pilih Kecamatan-</option>
                                                            @foreach($camat as $cmt)
                                                            <option value="{{$cmt->camat}}">{{$cmt->camat}}</option>
                                                             @endforeach
                                                  </select>
                                                </div>
                                            </div>
                                            <!-- <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kecamatan*</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_kecamatan" autocomplete="off" value="{{trim($sdm->camat_tinggal,' ')}}" style="text-transform:uppercase" placeholder="KECAMATAN" required />
                                                    </div>
                                            </div> -->
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kelurahan :</label>
                                                <div class="col-sm-8">
                                                  <select class="form-control" name="input_kelurahan" required>
                                                            <option replace>{{trim($sdm->lurah_tinggal,' ')}}</option>
                                                            <option>-Pilih Kelurahan-</option>
                                                            @foreach($lurah as $lrh)
                                                                <option value="{{$lrh->lurah}}">{{$lrh->lurah}}</option>
                                                             @endforeach
                                                            
                                                  </select>
                                                </div>
                                            </div>
                                            <!-- <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kelurahan*</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_kelurahan" autocomplete="off" value="{{trim($sdm->lurah_tinggal,' ')}}" style="text-transform:uppercase" placeholder="KELURAHAN" required />
                                                    </div>
                                            </div> -->
                                             <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kode Pos</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_kodepos" autocomplete="off" value="{{trim($sdm->kodepos_tinggal,' ')}}" maxlength="5" placeholder="651xx" id="kodepos" id="pesanpos"  />
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
        $('[name="input_status_nikah"]').select2({ width: '100%' });
        $('[name="input_kodyaktp"]').select2({ width: '100%' });
        $('[name="input_kodya"]').select2({ width: '100%' });

        $('[name="propinsiktp"]').select2({ width: '100%' });
        $('[name="propinsi"]').select2({ width: '100%' });
        $('[name="input_kelurahan"]').select2({ width: '100%' });
        $('[name="input_kecamatan"]').select2({ width: '100%' });
        $('[name="input_kecamatanktp"]').select2({ width: '100%' });
        $('[name="input_kelurahanktp"]').select2({ width: '100%' });
       
       
        $('#input_tglkerja').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});
        $('#tanggallahir').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});
       
        $('#pernikahan').each(function(){
            var $nikah = ($('#pernikahan').val());
            if($nikah == "0"){
                $('#kantorTambah').show();

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
                                var content = '';
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
                                var content = '';
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
                                var content = '';
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

                $('[name="input_tanggal_lahir_ps"]').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});

                $('[name="input_kodya_ps"]').select2({ width: '100%' });
                $('[name="propinsips"]').select2({ width: '100%' });
                $('[name="input_kelurahan_ps"]').select2({ width: '100%' });
                $('[name="input_kecamatan_ps"]').select2({ width: '100%' });

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

                $('[name="hapusalat"]').on('click',function(){
                    $('[name="propinsips"]').select2('destroy');
                    $('[name="input_kodya_ps"]').select2('destroy');
                    $('[name="input_kelurahan_ps"]').select2('destroy');
                    $('[name="input_kecamatan_ps"]').select2('destroy');
                    $('#kantorTambah').hide();
                });
            }
        });

        $('#pernikahan').change(function(){
            var $nikah = ($('#pernikahan').val());
            if($nikah == "0"){
                $('#kantorTambah').show();

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
                                var content = '';
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
                                var content = '';
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
                                var content = '';
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

                $('[name="input_tanggal_lahir_ps"]').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});

                $('[name="input_kodya_ps"]').select2({ width: '100%' });
                $('[name="propinsips"]').select2({ width: '100%' });
                $('[name="input_kelurahan_ps"]').select2({ width: '100%' });
                $('[name="input_kecamatan_ps"]').select2({ width: '100%' });

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

                $('[name="hapusalat"]').on('click',function(){
                    $('[name="propinsips"]').select2('destroy');
                    $('[name="input_kodya_ps"]').select2('destroy');
                    $('[name="input_kelurahan_ps"]').select2('destroy');
                    $('[name="input_kecamatan_ps"]').select2('destroy');
                    $('#kantorTambah').hide();
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
                    var content = '';
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
                    var content = '';
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
                    var content = '';
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
                    var content = '';
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
                    var content = '';
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
                    var content = '';
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
