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
            <form class="form-horizontal" id="simpankreditform" role="form" method="POST" action="{{ url('/saveAgunanAden/$nokredit') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelkredit">
                <div class="panel-heading"><h4 align="center">ADENDUM AGUNAN</h4></div>
                <!-- <div style="border: 20px outset #2a4aeb; height: 80px; text-align: center; width: 1140px; "><h4 align="center"><b>ADDENDUM AGUNAN</b></h4></div> -->
                    <div class="panel-body nav-tabs-animate">
                        <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                            <li role="presentation"><a data-toggle="tab" href="#agsertifikat" aria-controls="agsertifikat" role="tab">AGUNAN SERTIFIKAT</a><i class="fa"></i></li>
                            <li role="presentation"><a data-toggle="tab" href="#agkendaraan" aria-controls="agkendaraan" role="tab">AGUNAN KENDARAAN</a><i class="fa"></i></li>
                            <li role="presentation"><a data-toggle="tab" href="#alberat" aria-controls="alberat" role="tab">ALAT BERAT</a><i class="fa"></i></li>
                        </ul>
                        <div class="row"><div class="row form-group"> </div></div>
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="col-sm-6">  
                                <div class="row form-group">
                                    <label class="col-sm-5 control-label">Nomor Nasabah</label>
                                    <div class="col-sm-7">                                        
                                        <input type="text" class="form-control" name="no_nsb[]" autocomplete="off" style="text-transform:   uppercase;" value="{{$prekredit->no_nsb}}" readonly required />
                                    </div>
                                </div> 
                                <div class="row form-group">
                                            <label class="col-sm-5 control-label">Nomor CIF</label>
                                            <div class="col-sm-7">                                        
                                                <input type="text" class="form-control" name="no_cif[]" autocomplete="off" style="text-transform:uppercase;" value="{{$prekredit->no_cif}}" readonly required />
                                            </div>
                                        </div>
                                <div class="row form-group">
                                    <label class="col-sm-5 control-label">Nomor Kredit</label>
                                        <div class="col-sm-7">                                        
                                        <input type="text" class="form-control" name="no_kredit[]" autocomplete="off" style="text-transform:uppercase;" value="{{$prekredit->no_kredit}}" readonly required />
                                        </div>
                                </div>
                               
                            </div>
                                 <div class="col-sm-6"> 
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Operator</label>
                                            <div class="col-sm-7">
                                                <input type="text" class="form-control" name="opr" autocomplete="off" value="{{ trim(Auth::user()->nama_lengkap,' ') }}" style="text-transform:uppercase;" readonly />
                                            </div>
                                        </div>
                                        @foreach($daftar as $daf)
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Nomor NPP</label>
                                                <div class="col-sm-7">                                        
                                                <input type="text" class="form-control" autocomplete="off" style="text-transform:uppercase;" value="{{$daf->no_ref}}" readonly required />
                                                </div>
                                        </div>
                                        @endforeach
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label" name = "aden" value = "aden">Tanggal Addendum</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group date">
                                                        <input type="text" id="inputtgladen" name="input_tgladen" class="form-control" value="{{date('d-m-Y')}}" required readonly />
                                                    <div class="input-group-addon">
                                                        <span class="fa fa-calendar"></span>
                                                    </div>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label" name = "pakai" value = "pakai">Tanggal Pakai</label>
                                                <div class="col-sm-7">
                                                    <div class="input-group date">
                                                        <input type="text" id="inputtglpakai" name="input_pakai" class="form-control" value="{{date('d-m-Y')}}" required readonly />
                                                    <div class="input-group-addon">
                                                        <span class="fa fa-calendar"></span>
                                                    </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                            </div>
                            
                        </div>
                        </div> 
                        <!-- <h4 align="center">-DATA AGUNAN NASABAH-</h4> 
                        <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/> -->

                        <div class="tab-content">
                            <fieldset class="tab-pane animation-slide-left" id="agsertifikat" role="tabpanel">
                                <div class="panel panel-bordered">
                                    <div class="panel-heading text-center">
                                      {{-- <h4 class="panel-title">AGUNAN SERTIFIKAT</h4> --}}
                                    </div>
                                    <div class="panel-body">
                                     
                                    
                                         <div class="row">
                                            <div class="col-sm-2">
                                                <input type="button" class="btn btn-primary" value="Mutasi Jaminan Sertifikat" id="addAgSertAden" />
                                            </div>
                                        </div>
                                            <div class="AgunanSertifikatAden">
                                            </div>
                                        <div class="row">
                                            <div class="col-sm-2"><br>
                                                <input type="button" class="btn btn-primary" value="Tambah Jaminan" id="addAgSert" />
                                            </div>
                                        </div>
                                        <div class="AgunanSertifikat">
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            
                            <fieldset class="tab-pane animation-slide-left" id="agkendaraan" role="tabpanel">
                                <div class="panel panel-bordered">
                                    <div class="panel-heading text-center">
                                      {{-- <h4 class="panel-title">AGUNAN KENDARAAN</h4> --}}
                                    </div>
                                    <div class="panel-body">

                                        <div class="row">
                                            <div class="col-sm-2">
                                                <input type="button" class="btn btn-primary" value="Mutasi Jaminan Kendaraan" id="addAgKendAden" />
                                            </div>
                                        </div>
                                            <div class="AgunanKendaraanAden">

                                            </div>
                                        <div class="row">
                                            <div class="col-sm-2"><br>
                                                <input type="button" class="btn btn-primary" value="Tambah Jaminan" id="addAgKend" />
                                            </div>
                                        </div>
                                        <div class="AgunanKendaraan">

                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="tab-pane animation-slide-left" id="alberat" role="tabpanel">
                                <div class="panel panel-bordered">
                                    <div class="panel-heading text-center">
                                      {{-- <h4 class="panel-title">ALAT BERAT</h4> --}}
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-2">
                                                <input type="button" class="btn btn-primary" value="Mutasi Jaminan Alat Berat" id="addBeratAden" />
                                            </div>
                                        </div>
                                            <div class="alatBeratAden">

                                            </div>
                                        <div class="row">
                                            <div class="col-sm-2"><br>
                                                <input type="button" class="btn btn-primary" value="Tambah Jaminan" id="addBerat" />
                                            </div>
                                        </div>
                                        <div class="AlatBerat">

                                        </div>
                                        
                                    </div>
                                </div>
                            </fieldset>

                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                            <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                <button type="submit" class="btn btn-primary" name="simpankreditbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">SIMPAN</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="agunanSertifikat" data-op ="agunanSert" hidden>
<!-- <hr style="height:1px;border:none;color:#444;background-color:#444;" /> -->
    <div class="row">
        <div class="col-sm-12">
            <input type="button" value="Hapus"  class="btn btn-warning pull-right" name="hapusSert" />
        </div>
    <br />
        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <?php
                                    echo "<font color='#ff0000'>* wajib diisi</font><br>";
                                ?>
                            </div><br>
                                            <div class="col-sm-6">
                                                <div class="row form-group" >
                                                    <label class="col-sm-4 control-label">Status Agunan:</label>
                                                    <div class="col-sm-8" >
                                                   <select class="form-control" name="status_s[]">
                                                        <option value="">Baru</option>
                                                        <option value="pengganti">Pengganti</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                <label class="col-sm-4 control-label">*Kode Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name='input_agunan1_s[]' required>
                                                            <option value >-Pilih Kode Agunan-</option>
                                                            <option value='1-1'>1-1 - Roda Dua</option>
                                                            <option value='1-2'>1-2 - Roda Empat</option>
                                                            <option value='1-3'>1-3 - Sertifikat</option>
                                                            <option value='1-4'>1-4 - Elektronik</option>
                                                            <option value='1-5'>1-5 - SGU</option>
                                                            <option value='1-6'>1-6 - Anjak Piutang</option>
                                                            <option value='1-7'>1-7 - KKTA</option>
                                                        </select>
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nomor Sertifikat</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_no_sertifikat_s[]" autocomplete="off" value="" placeholder="NOMOR SERTIFIKAT" required/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Jenis Sertifikat</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_jenis_sertifikat_s[]" required>
                                                            <option value >-Pilih Jenis Sertifikat-</option>
                                                            <option value="SHM">SHM</option>
                                                            <option value="HGB">SHGB</option>
                                                        </select>
                                                    </div>    
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Kode Jenis Segmen Fasilitas</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_jns_segFas_s[]" required>
                                                            <option value="F01" >F01 - Kredit</option>
                                                            <option value >-Pilih Kode Jenis Segmen Fasilitas-</option>
                                                            @foreach($jenisfas as $sf)
                                                                <option value="{{$sf->sandi}}">{{$sf->sandi}} - {{$sf->fas}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Kode Status Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_stat_agunan_s[]" required>
                                                            <option value="1" >1 - tersedia</option>
                                                            <option value >-Pilih Kode Status Agunan-</option>
                                                            @foreach($status as $s)
                                                                <option value="{{$s->sandi}}">{{$s->sandi}} - {{$s->agun}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Kode Jenis Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_jns_agunan_s[]" required>
                                                            <option value >-Pilih Kode Jenis Agunan-</option>
                                                            @foreach($jenisagun as $a)
                                                                <option value="{{$a->kode}}">{{$a->kode}} - {{$a->nama}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Peringkat Agunan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_peringkat_agunan_s[]" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="peringkat agunan" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Kode Lembaga Pemeringkat</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_lembaga_pemeringkat_s[]">
                                                            <option value >-Pilih Kode Lembaga Pemeringkat-</option>
                                                            @foreach($lembaga as $l)
                                                                <option value="{{$l->kode}}">{{$l->kode}} - {{$l->lmbg_peringkat}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Kode Jenis Pengikatan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_jns_pengikatan_s[]">
                                                            <option value >-Pilih Kode Jenis Pengikatan-</option>
                                                            @foreach($ikat as $i)
                                                                <option value="{{$i->kode}}">{{$i->kode}} - {{$i->nama}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Tanggal Pengikatan</label>
                                                    <div class="col-sm-8">
                                                      <input type="text" class="form-control" name="input_tgl_pengikatan_s[]" placeholder ="{{date('d-m-Y')}}" id="input_tgl_pengikatan" >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nama Pemilik</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_nama_pemilik_sert_s[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="nama"  required/>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Alamat Pemilik</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_alamat_pemilik_sert_s[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="alamat"  />
                                                    </div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Bukti Kepemilikan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_bukti_kepemilikan_s[]" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="bukti kepemilikan" required />
                                                    </div>
                                                </div> -->
                                                
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Alamat Agunan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_lokasi_sert_s[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="lokasi" required />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Kode Kab/Kota Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kodya_nasabah_s[]" required>
                                                            <option value="1293" >1293 - Malang,Kota</option>
                                                            <option value >-Pilih Kodya-</option>
                                                            @foreach($dati2 as $k)
                                                                <option value="{{$k->desc1}}">{{$k->desc1}} - {{$k->desc2}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="col-sm-6">  
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Luas Tanah</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_luas_tanah_s[]" autocomplete="off" value="0" placeholder="0"  />
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Luas Bangunan</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_luas_bangunan_s[]" autocomplete="off" value="0" placeholder="0"  />
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai Taksasi</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_taksasi_sert_s[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai Pasar</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_pasar_sert_s[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai NJOP</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_njop_sert_s[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai HT</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_ht_sert_s[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai Agunan Menurut LJK</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_agunanLJK_s[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Tanggal Penilaian LJK</label>
                                                    <div class="col-sm-8">
                                                    <!-- $('input.datepicker').Zebra_DatePicker(); -->
                                                      <input type="text" class="form-control" name="input_tgl_penilaianLJK_s[]" placeholder ="{{date('d-m-Y')}}" id="input_tgl_penilaianLJK" >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Nilai Agunan Penilai Independent</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="nilai_agunan_penilaiIndependent_s[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Nama Penilai Independent</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_nm_penilai_s[]" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="NAMA" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Tanggal Penilaian Penilai Independent</label>
                                                    <div class="col-sm-8">
                                                      <input type="text" class="form-control" name="input_tgl_penilaian_s[]" placeholder ="{{date('d-m-Y')}}" id="input_tgl_penilaian" >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Status Paripasu</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_status_paripasu_s[]" required>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Persentase Paripasu</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_persent_paripasu_s[]" autocomplete="off" value="0" readonly />
                                                            <span class="input-group-addon">%</span>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Status Kredit Join</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_join_s[]" required>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Diasuransikan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_diasuransikan_s[]" required>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                    </div>                                                       
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Keterangan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_keterangan_sert_s[]" autocomplete="off" vYalue="" />
                                                    </div>
                                                </div> -->
                                            </div>
    </div>
    </div>
     
</div>


<div id="agunanKendaraan" data-op ="agunanKend" hidden>
    
    <div class="row">
        <div class="col-sm-12"><br>
            <input type="button" value="Hapus" class="btn btn-warning pull-right" name="hapusKend" />
        </div>
    <br>
        <div class="col-sm-12">
                            <div class="col-sm-3">
                                <?php
                                    echo "<font color='#ff0000'>* wajib diisi</font><br>";
                                ?>
                            </div><br>
                                            <div class="col-sm-6">
                                                 <div class="row form-group" >
                                                    <label class="col-sm-4 control-label">Status Agunan:</label>
                                                    <div class="col-sm-8" >
                                                   <select class="form-control" name="status_k[]">
                                                        <option value="">Baru</option>
                                                        <option value="pengganti">Pengganti</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                <label class="col-sm-4 control-label">*Kode Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name='input_agunan1_k[]' required>
                                                            <option value >-Pilih Kode Agunan-</option>
                                                            <option value='1-1'>1-1 - Roda Dua</option>
                                                            <option value='1-2'>1-2 - Roda Empat</option>
                                                            <option value='1-3'>1-3 - Sertifikat</option>
                                                            <option value='1-4'>1-4 - Elektronik</option>
                                                            <option value='1-5'>1-5 - SGU</option>
                                                            <option value='1-6'>1-6 - Anjak Piutang</option>
                                                            <option value='1-7'>1-7 - KKTA</option>
                                                        </select>
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Jenis Kendaraan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_jenis_kendaraan_k[]" required>
                                                            <option value >-Pilih Jenis Kendaraan-</option>
                                                            <option value="1-1">1-1 - Roda Dua</option>
                                                            <option value="1-2">1-2 - Roda Empat</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Status Kendaraan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_status_kendaraan_k[]">
                                                            <option value >-Pilih Status Kendaraan-</option>
                                                            <option value="NEW">NEW</option>
                                                            <option value="MK">SEC</option>
                                                            <option value="LB">LEASEBACK</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                                                 <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Kode Status Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_stat_agunan_k[]" required>
                                                            <option value="1" >1 - tersedia</option>
                                                            <option value >-Pilih Kode Status Agunan-</option>
                                                            @foreach($status as $s)
                                                                <option value="{{$s->sandi}}">{{$s->sandi}} - {{$s->agun}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Pemilik</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_nama_pemilik_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="pemilik" required />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Alamat Agunan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_alamat_pemilik_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="alamat" required />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Kode Kab/Kota Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kodya_nasabah_k[]" required>
                                                            <option value="1293" >1293 - Malang,Kota</option>
                                                            <option value >-Pilih Kodya-</option>
                                                            @foreach($dati2 as $k)
                                                                <option value="{{$k->desc1}}">{{$k->desc1}} - {{$k->desc2}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Kode Jenis Segmen Fasilitas</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_jns_segFas_k[]" required>
                                                            <option value="F01" >F01 - Kredit</option>
                                                            <option value >-Pilih Kode Jenis Segmen Fasilitas-</option>
                                                            @foreach($jenisfas as $sf)
                                                                <option value="{{$sf->sandi}}">{{$sf->sandi}} - {{$sf->fas}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Kode Jenis Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_jns_agunan_k[]" required>
                                                            <option value >-Pilih Kode Jenis Agunan-</option>
                                                            @foreach($jenisagun as $a)
                                                                <option value="{{$a->kode}}">{{$a->kode}} - {{$a->nama}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Peringkat Agunan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_peringkat_agunan_k[]" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="peringkat agunan" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Kode Lembaga Pemeringkat</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_lembaga_pemeringkat_k[]">
                                                            <option value >-Pilih Kode Lembaga Pemeringkat-</option>
                                                            @foreach($lembaga as $l)
                                                                <option value="{{$l->kode}}">{{$l->kode}} - {{$l->lmbg_peringkat}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Kode Jenis Pengikatan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_jns_pengikatan_k[]">
                                                            <option value >-Pilih Kode Jenis Pengikatan-</option>
                                                            @foreach($ikat as $i)
                                                                <option value="{{$i->kode}}">{{$i->kode}} - {{$i->nama}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Tanggal Pengikatan</label>
                                                    <div class="col-sm-8">
                                                      <input type="text" class="form-control" name="input_tgl_pengikatan_k[]" placeholder ="{{date('d-m-Y')}}" id="input_tgl_pengikatan" >
                                                    </div>
                                                </div>
                                               <!--  <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Bukti Kepemilikan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_bukti_kepemilikan_k[]" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="bukti kepemilikan" required />
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">No STNK</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_no_stnk_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="STNK" maxlength="25" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Tanggal Berlaku</label>
                                                    <div class="col-sm-8">
                                                      <input type="text" class="form-control" name="input_tgl_berlaku_stnk_k[]" placeholder ="{{date('d-m-Y')}}" id="input_tgl_berlaku_stnk" >
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Dealer</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_dealer_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="dealer" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Merk / Tipe</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="input_merk_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="merk" required />
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="input_tipe_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="tipe" required />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Tahun</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_tahun_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="tahun" maxlength="4" id="thn" id="pesanth" required/>
                                                    </div>
                                                </div>                                               
                                            </div>
                                            <div class="col-sm-6">                                               
                                                
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Warna</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_warna_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="warna" required />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Nomor Polisi</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_no_polisi_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="nomor polisi"  />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nomor BPKB</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_no_bpkb_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="nomor bpkb" required />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Nomor Rangka</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_no_rangka_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="no rangka"  />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Nomor Mesin</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_no_mesin_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="NOMOR Mesin"  />
                                                    </div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Kelompok</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_kelompok_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="kelompok" />
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai Kendaraan</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_kendaraan_k[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai Taksasi</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_taksasi_ken_k[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai Pasar</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_pasar_ken_k[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai Agunan Menurut LJK</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_agunanLJK_k[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Tanggal Penilaian LJK</label>
                                                    <div class="col-sm-8">
                                                      <input type="text" class="form-control" name="input_tgl_penilaianLJK_k[]" placeholder ="{{date('d-m-Y')}}" id="input_tgl_penilaianLJK" >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai Agunan Penilai Independent</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="nilai_agunan_penilaiIndependent_k[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Nama Penilai Independent</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_nm_penilai_k[]" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="nama penilai Independent" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Tanggal Penilaian Penilai Independent</label>
                                                    <div class="col-sm-8">
                                                      <input type="text" class="form-control" name="input_tgl_penilaian_k[]" placeholder ="{{date('d-m-Y')}}" id="input_tgl_penilaian" >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Status Paripasu</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_status_paripasu_k[]" required>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Persentase Paripasu</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_persent_paripasu_k[]" autocomplete="off" value="0" readonly />
                                                            <span class="input-group-addon">%</span>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Status Kredit Join</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_join_k[]" required>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Diasuransikan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_diasuransikan_k[]" required>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                    </div>                                                       
                                                </div>
                                            </div>
    </div>

    </div>

</div>

<div id="AlatBerat" data-op ="AlatBerat" hidden>
    <hr style="height:1px;border:none;color:#444;background-color:#444;" />
    <div class="row">
        <div class="col-sm-12">
            <input type="button" value="Hapus" class="btn btn-warning pull-right" name="hapusalat" />
        </div>
    </div>
    <br />
    <div class="col-sm-12">
                            <div class="col-sm-3">
                                <?php
                                    echo "<font color='#ff0000'>* wajib diisi</font><br>";
                                ?>
                            </div><br>
                                            <div class="col-sm-6">
                                                 <div class="row form-group" >
                                                    <label class="col-sm-4 control-label">Status Agunan:</label>
                                                    <div class="col-sm-8" >
                                                   <select class="form-control" name="status_k[]">
                                                        <option value="">Baru</option>
                                                        <option value="pengganti">Pengganti</option>
                                                    </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                <label class="col-sm-4 control-label">*Kode Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name='input_agunan1_k[]' required>
                                                            <option value >-Pilih Kode Agunan-</option>
                                                            <option value='1-1'>1-1 - Roda Dua</option>
                                                            <option value='1-2'>1-2 - Roda Empat</option>
                                                            <option value='1-3'>1-3 - Sertifikat</option>
                                                            <option value='1-4'>1-4 - Elektronik</option>
                                                            <option value='1-5'>1-5 - SGU</option>
                                                            <option value='1-6'>1-6 - Anjak Piutang</option>
                                                            <option value='1-7'>1-7 - KKTA</option>
                                                        </select>
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <label class="col-sm-4 control-label">*Jenis Kendaraan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_jenis_kendaraan_k[]" >
                                                            <option value >-Pilih Jenis Kendaraan-</option>
                                                            <option value="1-1">1-1 - Roda Dua</option>
                                                            <option value="1-2">1-2 - Roda Empat</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                 <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Kode Status Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_stat_agunan_k[]" required>
                                                            <option value="1" >1 - tersedia</option>
                                                            <option value >-Pilih Kode Status Agunan-</option>
                                                            @foreach($status as $s)
                                                                <option value="{{$s->sandi}}">{{$s->sandi}} - {{$s->agun}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Pemilik</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_nama_pemilik_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="pemilik" required />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Alamat Agunan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_alamat_pemilik_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="alamat" required />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Kode Kab/Kota Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kodya_nasabah_k[]" required>
                                                            <option value="1293" >1293 - Malang,Kota</option>
                                                            <option value >-Pilih Kodya-</option>
                                                            @foreach($dati2 as $k)
                                                                <option value="{{$k->desc1}}">{{$k->desc1}} - {{$k->desc2}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Kode Jenis Segmen Fasilitas</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_jns_segFas_k[]" required>
                                                            <option value="F01" >F01 - Kredit</option>
                                                            <option value >-Pilih Kode Jenis Segmen Fasilitas-</option>
                                                            @foreach($jenisfas as $sf)
                                                                <option value="{{$sf->sandi}}">{{$sf->sandi}} - {{$sf->fas}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Kode Jenis Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_jns_agunan_k[]" required>
                                                            <option value >-Pilih Kode Jenis Agunan-</option>
                                                            @foreach($jenisagun as $a)
                                                                <option value="{{$a->kode}}">{{$a->kode}} - {{$a->nama}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Peringkat Agunan</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_peringkat_agunan_k[]" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="peringkat agunan" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Kode Lembaga Pemeringkat</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_lembaga_pemeringkat_k[]">
                                                            <option value >-Pilih Kode Lembaga Pemeringkat-</option>
                                                            @foreach($lembaga as $l)
                                                                <option value="{{$l->kode}}">{{$l->kode}} - {{$l->lmbg_peringkat}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Kode Jenis Pengikatan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kode_jns_pengikatan_k[]">
                                                            <option value >-Pilih Kode Jenis Pengikatan-</option>
                                                            @foreach($ikat as $i)
                                                                <option value="{{$i->kode}}">{{$i->kode}} - {{$i->nama}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Tanggal Pengikatan</label>
                                                    <div class="col-sm-8">
                                                      <input type="text" class="form-control" name="input_tgl_pengikatan_k[]" placeholder ="{{date('d-m-Y')}}" id="input_tgl_pengikatan" >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Merk / Tipe</label>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="input_merk_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="merk" required />
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <input type="text" class="form-control" name="input_tipe_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="tipe" required />
                                                    </div>
                                                </div>     
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nomor SERI</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_no_bpkb_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="nomor seri" required />
                                                    </div>
                                                </div>      
                                                                               
                                            </div>
                                            <div class="col-sm-6">  
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Spesifikasi</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_warna_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="Spesifikasi" />
                                                    </div>
                                                </div>                                               
                                                <!-- <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Kelompok</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_kelompok_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="kelompok" />
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai Taksasi</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_taksasi_ken_k[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai Kendaraan</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_kendaraan_k[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai Pasar</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_pasar_ken_k[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai Agunan Menurut LJK</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_agunanLJK_k[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Tanggal Penilaian LJK</label>
                                                    <div class="col-sm-8">
                                                      <input type="text" class="form-control" name="input_tgl_penilaianLJK_k[]" placeholder ="{{date('d-m-Y')}}" id="input_tgl_penilaianLJK" >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Nilai Agunan Penilai Independent</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="nilai_agunan_penilaiIndependent_k[]" autocomplete="off" value="0" placeholder="0" required/>
                                                        </div>
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Nama Penilai Independent</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_nm_penilai_k[]" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="nama penilai Independent" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Tanggal Penilaian Penilai Independent</label>
                                                    <div class="col-sm-8">
                                                      <input type="text" class="form-control" name="input_tgl_penilaian_k[]" placeholder ="{{date('d-m-Y')}}" id="input_tgl_penilaian" >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Status Paripasu</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_status_paripasu_k[]" required>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Persentase Paripasu</label>
                                                    <div class="col-sm-8">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_persent_paripasu_k[]" autocomplete="off" value="0" readonly />
                                                            <span class="input-group-addon">%</span>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Status Kredit Join</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_join_k[]" required>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Diasuransikan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_diasuransikan_k[]" required>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Fungsi</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_fungsi_k[]" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="Fungsi" />
                                                    </div>
                                                </div>
                                            </div>
    </div>
</div>

<div id="agunanSertifikatAden" data-op ="agunanSertifikatAden" hidden>
    <div class="row">
        <br>
                                @foreach($agkredit as $ser)
                                   @if(($ser->status == '                                                  ')
                                     ||($ser->status == 'dipinjam                                          ')
                                     ||($ser->status == 'tukar                                             ')
                                     ||($ser->status == 'pengganti                                         ')
                                     ||($ser->status == 'kembali                                           ')
                                     ||($ser->status == '')
                                     ||($ser->status == 'OK                                                '))
                                      @if(($ser->jenis == '1-3            '))
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <div class="pilihan">
                                            </div>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="input_status[]">
                                                        <option replace>{{($ser->status)}}</option>
                                                        <option value >-Pilih Status Mutasi Agunan-</option>
                                                        <option value="dipinjam">Dipinjam</option>
                                                        <option value="tukar">Tukar</option>
                                                        <!-- <option value="pengganti">Pengganti</option> -->
                                                        <option value="keluar">Keluar</option>
                                                        <option value="kembali">Kembali</option>
                                                        <option value="hapus">Hapus</option>
                                                        <option value="jual">Jual</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="tanggal" id="tanggal" autocomplete="off" style="text-transform:uppercase;"  placeholder="{{date('d-m-Y')}}" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nomor Surat</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="nobukti[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nomor surat" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kode Agunan</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='jenis[]'>
                                                            <option value >-Pilih Kode Agunan-</option>
                                                            <option value='1-1'>1-1 - Roda Dua</option>
                                                            <option value='1-2'>1-2 - Roda Empat</option>
                                                            <option value='1-3'>1-3 - Sertifikat</option>
                                                            <option value='1-4'>1-4 - Elektronik</option>
                                                            <option value='1-5'>1-5 - SGU</option>
                                                            <option value='1-6'>1-6 - Anjak Piutang</option>
                                                            <option value='1-7'>1-7 - KKTA</option>
                                                        </select>
                                                    </div>                                    
                                            </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama Petugas</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="opr[]" autocomplete="off" style="text-transform:uppercase;" value="{{ Auth::user()->nama_lengkap }}" placeholder="nama petugas" readonly />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama Penerima</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="peminjam[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="Nama Penerima" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Keterangan</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="ket[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="keterangan" />
                                                </div>
                                            </div>
                                            <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">No agunan</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="nomor[]" autocomplete="off" style="text-transform:uppercase;" value="{{trim($ser->no_agunan,' ')}}" placeholder="keterangan" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Nama Pengaju</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="nm_aju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama pengaju" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Pengajuan</label>
                                                    <div class="col-sm-9">   
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_aju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Nama Peyetuju</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="nm_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama penyutuju" readonly />
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Persetujuan</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Jual</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_jual[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12"><br>
                                            <div class="col-sm-3">
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Status Agunan:</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ser->status}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6 "><b>Operator:</b></div>
                                                    <div class="col-sm-6">{{$ser->opr}}
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6"><b>Kode Agunan:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->jenis,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nomor Sertifikat:</b></div>
                                                    <div class="col-sm-6">{{$ser->nosertif}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Jenis Sertifikat:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->sertstatus,' ')}}</div>    
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Jenis Segmen Fasilitas:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->jenisfas,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Status Agunan:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->kd_status,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Jenis Agunan:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->jenisagun,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Peringkat Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ser->peringkat}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Lembaga Pemeringkat:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->lembaga,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Jenis Pengikatan:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->ikat,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Tanggal Pengikatan:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ser->tgl_ikat))}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nama Pemilik:</b></div>
                                                    <div class="col-sm-6">{{$ser->pemilik}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Alamat Pemilik:</b></div>
                                                    <div class="col-sm-6">{{$ser->alamat}}</div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6"><b>Bukti Kepemilikan:</b></div>
                                                    <div class="col-sm-6">{{$ser->bukti}}
                                                    </div>
                                                </div> -->
                                                
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Alamat Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ser->lokasi}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Kab/Kota:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->kodya,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Luas Tanah:</b></div>
                                                    <div class="col-sm-6">{{$ser->luastanah}} m<sup>2</sup>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">  

                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Luas Bangunan:</b></div>
                                                    <div class="col-sm-6">{{$ser->luasbangunan}} m<sup>2</sup>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai Taksasi:</b></div>
                                                    <div class="col-sm-6">Rp.{{number_format($ser->niltaksasi,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai Pasar:</b></div>
                                                    <div class="col-sm-6">Rp.{{number_format($ser->nilpasar,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai NJOP:</b></div>
                                                    <div class="col-sm-6">Rp. {{number_format($ser->nilnjop,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai HT:</b></div>
                                                    <div class="col-sm-6">Rp. {{number_format($ser->nilhaktg,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai Agunan Menurut LJK:</b></div>
                                                    <div class="col-sm-6">Rp. {{number_format($ser->ljk,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Tanggal Penilaian LJK:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ser->tgl_nilai))}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai Agunan Penilai Independent:</b></div>
                                                    <div class="col-sm-6">Rp. {{number_format($ser->indep,0,'','.')}} 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nama Penilai Independent:</b></div>
                                                    <div class="col-sm-6">{{$ser->namaindep}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Tanggal Penilaian Penilai Independent:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ser->tgl_indep))}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Status Paripasu:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->paripasu,' ')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Persentase Paripasu:</b></div>
                                                    <div class="col-sm-6">{{$ser->persen}} %       
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Status Kredit Join:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->s_join,' ')}}</div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Diasuransikan:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->asuransi,' ')}}</div>                                                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                     @endif
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
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <div class="pilihan">
                                            </div>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="input_status[]">
                                                        <option replace>{{($ser->status)}}</option>
                                                        <option value >-Pilih Status Mutasi Agunan-</option>
                                                        <option value="dipinjam">Dipinjam</option>
                                                        <option value="tukar">Tukar</option>
                                                        <option value="keluar">Keluar</option>
                                                        <option value="kembali">Kembali</option>
                                                        <option value="hapus">Hapus</option>
                                                        <option value="jual">Jual</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="tanggal" id="tanggal" autocomplete="off" style="text-transform:uppercase;"  placeholder="{{date('d-m-Y')}}" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nomor Surat</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="nobukti[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nomor surat" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kode Agunan</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='jenis[]'>
                                                            <option value >-Pilih Kode Agunan-</option>
                                                            <option value='1-1'>1-1 - Roda Dua</option>
                                                            <option value='1-2'>1-2 - Roda Empat</option>
                                                            <option value='1-3'>1-3 - Sertifikat</option>
                                                            <option value='1-4'>1-4 - Elektronik</option>
                                                            <option value='1-5'>1-5 - SGU</option>
                                                            <option value='1-6'>1-6 - Anjak Piutang</option>
                                                            <option value='1-7'>1-7 - KKTA</option>
                                                        </select>
                                                    </div>                                    
                                            </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama Petugas</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="opr[]" autocomplete="off" style="text-transform:uppercase;" value="{{ Auth::user()->nama_lengkap }}" placeholder="nama petugas" readonly />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama Penerima</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="peminjam[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="Nama Penerima" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Keterangan</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="ket[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="keterangan" />
                                                </div>
                                            </div>
                                            <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">No agunan</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="nomor[]" autocomplete="off" style="text-transform:uppercase;" value="{{trim($ser->no_agunan,' ')}}" placeholder="keterangan" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Nama Pengaju</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="nm_aju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama pengaju" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Pengajuan</label>
                                                    <div class="col-sm-9">   
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_aju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Nama Peyetuju</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="nm_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama penyutuju" readonly />
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Persetujuan</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Jual</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_jual[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12"><br>
                                            <div class="col-sm-3">
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Status Agunan:</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ser->status}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6 "><b>Operator:</b></div>
                                                    <div class="col-sm-6">{{$ser->opr}}
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6"><b>Kode Agunan:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->jenis,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nomor Sertifikat:</b></div>
                                                    <div class="col-sm-6">{{$ser->nosertif}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Jenis Sertifikat:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->sertstatus,' ')}}</div>    
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Jenis Segmen Fasilitas:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->jenisfas,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Status Agunan:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->kd_status,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Jenis Agunan:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->jenisagun,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Peringkat Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ser->peringkat}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Lembaga Pemeringkat:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->lembaga,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Jenis Pengikatan:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->ikat,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Tanggal Pengikatan:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ser->tgl_ikat))}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nama Pemilik:</b></div>
                                                    <div class="col-sm-6">{{$ser->pemilik}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Alamat Pemilik:</b></div>
                                                    <div class="col-sm-6">{{$ser->alamat}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Alamat Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ser->lokasi}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Kab/Kota:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->kodya,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Luas Tanah:</b></div>
                                                    <div class="col-sm-6">{{$ser->luastanah}} m<sup>2</sup>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-3">  

                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Luas Bangunan:</b></div>
                                                    <div class="col-sm-6">{{$ser->luasbangunan}} m<sup>2</sup>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai Taksasi:</b></div>
                                                    <div class="col-sm-6">Rp.{{number_format($ser->niltaksasi,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai Pasar:</b></div>
                                                    <div class="col-sm-6">Rp.{{number_format($ser->nilpasar,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai NJOP:</b></div>
                                                    <div class="col-sm-6">Rp. {{number_format($ser->nilnjop,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai HT:</b></div>
                                                    <div class="col-sm-6">Rp. {{number_format($ser->nilhaktg,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai Agunan Menurut LJK:</b></div>
                                                    <div class="col-sm-6">Rp. {{number_format($ser->ljk,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Tanggal Penilaian LJK:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ser->tgl_nilai))}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai Agunan Penilai Independent:</b></div>
                                                    <div class="col-sm-6">Rp. {{number_format($ser->indep,0,'','.')}} 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nama Penilai Independent:</b></div>
                                                    <div class="col-sm-6">{{$ser->namaindep}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Tanggal Penilaian Penilai Independent:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ser->tgl_indep))}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Status Paripasu:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->paripasu,' ')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Persentase Paripasu:</b></div>
                                                    <div class="col-sm-6">{{$ser->persen}} %       
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Status Kredit Join:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->s_join,' ')}}</div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Diasuransikan:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->asuransi,' ')}}</div>                                                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                    @endif
                                     @endif
                                    @endforeach -->
</div>

<div id="agunanKendaraanAden" data-op ="agunanKendaraanAden" hidden>
    <div class="row">
        <br>
                            @foreach($agkredit as $ken)
                              @if(($ken->status == '                                                  ')
                                     ||($ken->status == 'dipinjam                                          ')
                                     ||($ken->status == 'tukar                                             ')
                                     ||($ken->status == 'pengganti                                         ')
                                     ||($ken->status == 'kembali                                           ')
                                     ||($ken->status == '')
                                     ||($ken->status == 'OK                                                '))
                           @if(($ken->jenis == '1-2            ')
                                     ||($ken->jenis == '1-1            ')
                                     ||($ken->jenis == '1-4            ')
                                     ||($ken->jenis == '1-5            ')
                                     ||($ken->jenis == '1-6            '))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <div class="pilihan">
                                            </div>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="input_status[]">
                                                        <option replace>{{($ken->status)}}</option>
                                                        <option value >-Pilih Status Mutasi Agunan-</option>
                                                        <option value="dipinjam">Dipinjam</option>
                                                        <option value="tukar">Tukar</option>
                                                        <!-- <option value="pengganti">Pengganti</option> -->
                                                        <option value="keluar">Keluar</option>
                                                        <option value="kembali">Kembali</option>
                                                        <option value="hapus">Hapus</option>
                                                        <option value="jual">Jual</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="tanggal" id="tanggal" autocomplete="off" style="text-transform:uppercase;"  placeholder="{{date('d-m-Y')}}" value="" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nomor Surat</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="nobukti[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nomor surat" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kode Agunan</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='jenis[]'>
                                                            <option value >-Pilih Kode Agunan-</option>
                                                            <option value='1-1'>1-1 - Roda Dua</option>
                                                            <option value='1-2'>1-2 - Roda Empat</option>
                                                            <option value='1-3'>1-3 - Sertifikat</option>
                                                            <option value='1-4'>1-4 - Elektronik</option>
                                                            <option value='1-5'>1-5 - SGU</option>
                                                            <option value='1-6'>1-6 - Anjak Piutang</option>
                                                            <option value='1-7'>1-7 - KKTA</option>
                                                        </select>
                                                    </div>                                    
                                            </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama Petugas</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="opr[]" autocomplete="off" style="text-transform:uppercase;" value="{{ Auth::user()->nama_lengkap }}" placeholder="nama petugas" readonly />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama Penerima</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="peminjam[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="Nama Penerima" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Keterangan</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="ket[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="keterangan" />
                                                </div>
                                            </div>
                                            <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">No agunan</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="nomor[]" autocomplete="off" style="text-transform:uppercase;" value="{{trim($ken->no_agunan,' ')}}" placeholder="keterangan" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Nama Pengaju</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="nm_aju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama pengaju" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Pengajuan</label>
                                                    <div class="col-sm-9">   
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_aju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Nama Peyetuju</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="nm_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama penyutuju" readonly />
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Persetujuan</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Jual</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_jual[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="row"><br>
                                        <div class="col-sm-12"> 
                                            <div class="col-sm-6">
                                                <div class="row form-group">
                                                <div class="col-sm-5 "><b>Kode Agunan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->jenis}}
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-5 "><b>Status Agunan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->status}}
                                                    </div>                                    
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Jenis Kendaraan:</b></div>
                                                    <div class="col-sm-5">{{$ken->jenisken}}
                                                    </div>
                                                </div> -->
                                               <!--  <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Status Kendaraan:</b></div>
                                                    <div class="col-sm-5">{{$ken->kd_status}}
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Pemilik</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->pemilik}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Alamat Agunan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->alamat}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Kode Kab/Kota Agunan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->kodya}}
                                                    </div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Kode Jenis Segmen Fasilitas:</b></div>
                                                    <div class="col-sm-5">{{$ken->jenisfas}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Kode Jenis Agunan:</b></div>
                                                    <div class="col-sm-5">{{$ken->jenisagun}}
                                                    </div>
                                                </div> -->
                                                
                                            <!-- </div>
                                            <div class="col-sm-3"> -->
                                               <!--  <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Peringkat Agunan:</b></div>
                                                    <div class="col-sm-5">{{$ken->peringkat}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Kode Lembaga Pemeringkat:</b></div>
                                                    <div class="col-sm-5">{{$ken->lembaga}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Kode Jenis Pengikatan:</b></div>
                                                    <div class="col-sm-5">{{$ken->ikat}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Tanggal Pengikatan:</b></div>
                                                    <div class="col-sm-5">{{date('d-m-Y',strtotime($ken->tgl_ikat))}}
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>No STNK</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->nostnk}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Tanggal Berlaku</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{date('d-m-Y',strtotime($ken->berlaku))}}
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Dealer</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->dealer}}
                                                    </div>
                                                </div>   
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Merk / Tipe</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->merktype}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Tahun</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->tahun}}
                                                    </div>
                                                </div>   
                                                 <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Warna</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->warna}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Nomor Polisi</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->nopolisi}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Nomor BPKB</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->nobpkb}}
                                                    </div>
                                                </div>     
                                                 <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Nomor Rangka</b></div>
                                                    <!-- <div colspan=1>: </div> -->
                                                    <div colspan=1 class="col-sm-5">: {{$ken->norangka}}
                                                    </div>
                                                </div>                                    
                                            </div>
                                            <div class="col-sm-6">                                               
                                                
                                               
                                               
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Nomor Mesin</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->nomesin}}
                                                    </div>
                                                </div>

                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Nilai Kendaraan</b></div>
                                                    <div colspan=1 class="col-sm-5">: Rp.{{$ken->nilai}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Nilai Taksasi</b></div>
                                                    <div colspan=1 class="col-sm-5">: Rp.{{$ken->niltaksasi}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Nilai Pasar</b></div>
                                                    <div colspan=1 class="col-sm-5">: Rp.{{$ken->nilpasar}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Nilai Agunan Menurut LJK</b></div>
                                                    <div colspan=1 class="col-sm-5">: Rp.{{$ken->ljk}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Tanggal Penilaian LJK</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{date('d-m-Y',strtotime($ken->tgl_nilai))}}
                                                    </div>
                                                </div>
                                            <!-- </div>
                                            <div class="col-sm-3"> -->
                                                
                                                
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Nilai Agunan Penilai Independent</b></div>
                                                    <div colspan=1 class="col-sm-5">: Rp.{{$ken->indep}}
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Nama Penilai Independent</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->namaindep}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Tanggal Penilaian Penilai Independent</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{date('d-m-Y',strtotime($ken->tgl_indep))}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Status Paripasu</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->paripasu}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Pesentase Paripasu</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->persen}}%          
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5"><b>Status Kredit Join</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{trim($ken->s_join,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Diasuransikan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->asuransi}}
                                                    </div>                                                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                            @endif
                            @endif
                            @endforeach

                            <!--  @foreach($agkredit as $ken)
                                    @if(($ken->status == '                                                  ')
                                     ||($ken->status == 'dipinjam                                          ')
                                     ||($ken->status == 'tukar                                             ')
                                     ||($ken->status == 'pengganti                                         ')
                                     ||($ken->status == 'kembali                                           ')
                                     ||($ken->status == '')
                                     ||($ken->status == 'OK                                                '))
                                     @if(($ken->jenis != '1-7            '))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <div class="pilihan">
                                            </div>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="input_status[]">
                                                        <option replace>{{($ken->status)}}</option>
                                                        <option value >-Pilih Status Mutasi Agunan-</option>
                                                        <option value="dipinjam">Dipinjam</option>
                                                        <option value="tukar">Tukar</option>
                                                        <option value="keluar">Keluar</option>
                                                        <option value="kembali">Kembali</option>
                                                        <option value="hapus">Hapus</option>
                                                        <option value="jual">Jual</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="tanggal" id="tanggal" autocomplete="off" style="text-transform:uppercase;"  placeholder="{{date('d-m-Y')}}" value="" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nomor Surat</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="nobukti[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nomor surat" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kode Agunan</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='jenis[]'>
                                                            <option value >-Pilih Kode Agunan-</option>
                                                            <option value='1-1'>1-1 - Roda Dua</option>
                                                            <option value='1-2'>1-2 - Roda Empat</option>
                                                            <option value='1-3'>1-3 - Sertifikat</option>
                                                            <option value='1-4'>1-4 - Elektronik</option>
                                                            <option value='1-5'>1-5 - SGU</option>
                                                            <option value='1-6'>1-6 - Anjak Piutang</option>
                                                            <option value='1-7'>1-7 - KKTA</option>
                                                        </select>
                                                    </div>                                    
                                            </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama Petugas</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="opr[]" autocomplete="off" style="text-transform:uppercase;" value="{{ Auth::user()->nama_lengkap }}" placeholder="nama petugas" readonly />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama Penerima</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="peminjam[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="Nama Penerima" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Keterangan</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="ket[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="keterangan" />
                                                </div>
                                            </div>
                                            <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">No agunan</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="nomor[]" autocomplete="off" style="text-transform:uppercase;" value="{{trim($ken->no_agunan,' ')}}" placeholder="keterangan" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Nama Pengaju</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="nm_aju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama pengaju" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Pengajuan</label>
                                                    <div class="col-sm-9">   
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_aju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Nama Peyetuju</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="nm_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama penyutuju" readonly />
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Persetujuan</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Jual</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_jual[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                 </div>
                                <div class="row"><br>
                                        <div class="col-sm-12"> 
                                            <div class="col-sm-3">
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Status Agunan:</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ken->status}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6 "><b>Operator:</b></div>
                                                    <div class="col-sm-6">{{$ken->opr}}
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6 "><b>Kode Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ken->jenis}}
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Jenis Kendaraan:</b></div>
                                                    <div class="col-sm-6">{{$ken->jenisken}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Status Kendaraan:</b></div>
                                                    <div class="col-sm-6">{{$ken->kd_status}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Pemilik:</b></div>
                                                    <div class="col-sm-6">{{$ken->pemilik}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Alamat Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ken->alamat}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Kab/Kota Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ken->kodya}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Jenis Segmen Fasilitas:</b></div>
                                                    <div class="col-sm-6">{{$ken->jenisfas}}
                                                    </div>
                                                </div>

                                                
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Jenis Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ken->jenisagun}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Peringkat Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ken->peringkat}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Lembaga Pemeringkat:</b></div>
                                                    <div class="col-sm-6">{{$ken->lembaga}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Jenis Pengikatan:</b></div>
                                                    <div class="col-sm-6">{{$ken->ikat}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tanggal Pengikatan:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ken->tgl_ikat))}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>No STNK:</b></div>
                                                    <div class="col-sm-6">{{$ken->nostnk}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tanggal Berlaku:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ken->berlaku))}}
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Dealer:</b></div>
                                                    <div class="col-sm-6">{{$ken->dealer}}
                                                    </div>
                                                </div>   
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Merk / Tipe:</b></div>
                                                    <div class="col-sm-6">{{$ken->merktype}}
                                                    </div>
                                                </div>
                                                                                          
                                            </div>
                                            <div class="col-sm-3">                                               
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tahun:</b></div>
                                                    <div class="col-sm-6">{{$ken->tahun}}
                                                    </div>
                                                </div>  
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Warna:</b></div>
                                                    <div class="col-sm-6">{{$ken->warna}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nomor Polisi:</b></div>
                                                    <div class="col-sm-6">{{$ken->nopolisi}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nomor BPKB:</b></div>
                                                    <div class="col-sm-6">{{$ken->nobpkb}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nomor Rangka:</b></div>
                                                    <div class="col-sm-6">{{$ken->norangka}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nomor Mesin:</b></div>
                                                    <div class="col-sm-6">{{$ken->nomesin}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Kendaraan:</b></div>
                                                    <div class="col-sm-6">Rp.{{number_format($ken->nilai,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Taksasi:</b></div>
                                                    <div class="col-sm-6">Rp.{{number_format($ken->niltaksasi,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Pasar:</b></div>
                                                    <div class="col-sm-6">Rp.{{number_format($ken->nilpasar,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Agunan Menurut LJK:</b></div>
                                                    <div class="col-sm-6">Rp.{{number_format($ken->ljk,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tanggal Penilaian LJK:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ken->tgl_nilai))}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                
                                                
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Agunan Penilai Independent:</b></div>
                                                    <div class="col-sm-6">Rp.{{number_format($ken->indep,0,'','.')}}
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nama Penilai Independent:</b></div>
                                                    <div class="col-sm-6">{{$ken->namaindep}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tanggal Penilaian Penilai Independent:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ken->tgl_indep))}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Status Paripasu:</b></div>
                                                    <div class="col-sm-6">{{$ken->paripasu}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Persentase Paripasu:</b></div>
                                                    <div class="col-sm-6">{{$ken->persen}}%          
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Status Kredit Join:</b></div>
                                                    <div class="col-sm-6">{{trim($ken->s_join,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Diasuransikan:</b></div>
                                                    <div class="col-sm-6">{{$ken->asuransi}}
                                                    </div>                                                       
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                            @endif
                            @endif
                            @endforeach -->
</div>

<div id="alatBeratAden" data-op ="alatBeratAden" hidden>
    <div class="row">
        <br>
                            @foreach($agkredit as $ken)
                             @if(($ken->status == '                                                  ')
                                     ||($ken->status == 'dipinjam                                          ')
                                     ||($ken->status == 'tukar                                             ')
                                     ||($ken->status == 'pengganti                                         ')
                                     ||($ken->status == 'kembali                                           ')
                                     ||($ken->status == '')
                                     ||($ken->status == 'OK                                                '))
                             @if(($ken->jenis == '1-7            '))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <div class="pilihan">
                                            </div>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="input_status[]">
                                                        <option replace>{{($ken->status)}}</option>
                                                        <option value >-Pilih Status Mutasi Agunan-</option>
                                                        <option value="dipinjam">Dipinjam</option>
                                                        <option value="tukar">Tukar</option>
                                                        <!-- <option value="pengganti">Pengganti</option> -->
                                                        <option value="keluar">Keluar</option>
                                                        <option value="kembali">Kembali</option>
                                                        <option value="hapus">Hapus</option>
                                                        <option value="jual">Jual</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="tanggal" id="tanggal" autocomplete="off" style="text-transform:uppercase;"  placeholder="{{date('d-m-Y')}}" value="" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nomor Surat</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="nobukti[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nomor surat" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kode Agunan</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='jenis[]'>
                                                            <option value >-Pilih Kode Agunan-</option>
                                                            <option value='1-1'>1-1 - Roda Dua</option>
                                                            <option value='1-2'>1-2 - Roda Empat</option>
                                                            <option value='1-3'>1-3 - Sertifikat</option>
                                                            <option value='1-4'>1-4 - Elektronik</option>
                                                            <option value='1-5'>1-5 - SGU</option>
                                                            <option value='1-6'>1-6 - Anjak Piutang</option>
                                                            <option value='1-7'>1-7 - KKTA</option>
                                                        </select>
                                                    </div>                                    
                                            </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama Petugas</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="opr[]" autocomplete="off" style="text-transform:uppercase;" value="{{ Auth::user()->nama_lengkap }}" placeholder="nama petugas" readonly />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama Penerima</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="peminjam[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="Nama Penerima" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Keterangan</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="ket[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="keterangan" />
                                                </div>
                                            </div>
                                            <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">No agunan</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="nomor[]" autocomplete="off" style="text-transform:uppercase;" value="{{trim($ken->no_agunan,' ')}}" placeholder="keterangan" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Nama Pengaju</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="nm_aju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama pengaju" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Pengajuan</label>
                                                    <div class="col-sm-9">   
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_aju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Nama Peyetuju</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="nm_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama penyutuju" readonly />
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Persetujuan</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Jual</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_jual[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                 </div>
                                 <div class="row"><br>
                                        <div class="col-sm-12"> 
                                            <div class="col-sm-6">
                                                <div class="row form-group">
                                                <div class="col-sm-6 "><b>Kode Agunan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->jenis}}
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6 "><b>Status Agunan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->status}}
                                                    </div>                                    
                                                </div>
                                               <!--  <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Jenis Kendaraan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->jenisken}}
                                                    </div>
                                                </div> -->
                                               <!--  <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Status Kendaraan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->kd_status}}
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Pemilik</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->pemilik}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Alamat Agunan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->alamat}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Kab/Kota Agunan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->kodya}}
                                                    </div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Jenis Segmen Fasilitas</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->jenisfas}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Jenis Agunan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->jenisagun}}
                                                    </div>
                                                </div> -->
                                               
                                            <!-- </div>
                                            <div class="col-sm-3"> -->
                                                 <!-- <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Peringkat Agunan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->peringkat}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Lembaga Pemeringkat</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->lembaga}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Jenis Pengikatan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->ikat}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tanggal Pengikatan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{date('d-m-Y',strtotime($ken->tgl_ikat))}}
                                                    </div>
                                                </div> -->
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Bukti Kepemilikan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->bukti}}
                                                    </div>
                                                </div> -->
                                               <!--  <div class="row form-group">
                                                    <div class="col-sm-6 "><b>No STNK</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->nostnk}}
                                                    </div>
                                                </div> -->
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tanggal Berlaku</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{date('d-m-Y',strtotime($ken->berlaku))}}
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Dealer</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->dealer}}
                                                    </div>
                                                </div>    -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Merk / Tipe</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->merktype}}
                                                    </div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tahun</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->tahun}}
                                                    </div>
                                                </div>    -->    
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Spesifikasi</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->warna}}
                                                    </div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nomor Polisi</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->nopolisi}}
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nomor SERI</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->nobpkb}}
                                                    </div>
                                                </div>
                                               <!--  <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nomor Rangka</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->norangka}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nomor Mesin</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->nomesin}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kelompok</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->kelompok}}
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Kendaraan</b></div>
                                                    <div colspan=1 class="col-sm-5">: Rp.{{$ken->nilai}}
                                                    </div>
                                                </div>      
                                                 <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Taksasi</b></div>
                                                    <div colspan=1 class="col-sm-5">: Rp.{{$ken->niltaksasi}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Pasar</b></div>
                                                    <div colspan=1 class="col-sm-5">: Rp.{{$ken->nilpasar}}
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-sm-6">      
                                                
                                               
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Agunan Menurut LJK</b></div>
                                                    <div colspan=1 class="col-sm-5">: Rp.{{$ken->ljk}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tanggal Penilaian LJK</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{date('d-m-Y',strtotime($ken->tgl_nilai))}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Agunan Penilai Independent</b></div>
                                                    <div colspan=1 class="col-sm-5">: Rp.{{$ken->indep}}
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nama Penilai Independent</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->namaindep}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tanggal Penilaian Penilai Independent</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{date('d-m-Y',strtotime($ken->tgl_indep))}}
                                                    </div>
                                                </div>
                                            <!-- </div>
                                            <div class="col-sm-3"> -->
                                                
                                                
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Status Paripasu</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->paripasu}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Pesentase Paripasu</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->persen}}%          
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Status Kredit Join</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{trim($ken->s_join,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Diasuransikan</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->asuransi}}
                                                    </div>                                                       
                                                </div>
                                                 <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Fungsi</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{$ken->ket}}
                                                    </div>                                                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                            @endif
                            @endif
                            @endforeach

                             <!-- @foreach($agkredit as $ken)
                                     @if(($ken->status == '                                                  ')
                                     ||($ken->status == 'dipinjam                                          ')
                                     ||($ken->status == 'tukar                                             ')
                                     ||($ken->status == 'pengganti                                         ')
                                     ||($ken->status == 'kembali                                           ')
                                     ||($ken->status == '')
                                     ||($ken->status == 'OK                                                '))
                                    @if(($ken->jenis == '1-7            '))
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <div class="pilihan">
                                            </div>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="input_status[]">
                                                        <option replace>{{($ken->status)}}</option>
                                                        <option value >-Pilih Status Mutasi Agunan-</option>
                                                        <option value="dipinjam">Dipinjam</option>
                                                        <option value="tukar">Tukar</option>
                                                        <option value="keluar">Keluar</option>
                                                        <option value="kembali">Kembali</option>
                                                        <option value="hapus">Hapus</option>
                                                        <option value="jual">Jual</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="tanggal" id="tanggal" autocomplete="off" style="text-transform:uppercase;"  placeholder="{{date('d-m-Y')}}" value="" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nomor Surat</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="nobukti[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nomor surat" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-3 control-label">Kode Agunan</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name='jenis[]'>
                                                            <option value >-Pilih Kode Agunan-</option>
                                                            <option value='1-1'>1-1 - Roda Dua</option>
                                                            <option value='1-2'>1-2 - Roda Empat</option>
                                                            <option value='1-3'>1-3 - Sertifikat</option>
                                                            <option value='1-4'>1-4 - Elektronik</option>
                                                            <option value='1-5'>1-5 - SGU</option>
                                                            <option value='1-6'>1-6 - Anjak Piutang</option>
                                                            <option value='1-7'>1-7 - KKTA</option>
                                                        </select>
                                                    </div>                                    
                                            </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama Petugas</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="opr[]" autocomplete="off" style="text-transform:uppercase;" value="{{ Auth::user()->nama_lengkap }}" placeholder="nama petugas" readonly />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nama Penerima</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="peminjam[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="Nama Penerima" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Keterangan</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="ket[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="keterangan" />
                                                </div>
                                            </div>
                                            <div class="row form-group" hidden>
                                                    <label class="col-sm-3 control-label">No agunan</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="nomor[]" autocomplete="off" style="text-transform:uppercase;" value="{{trim($ken->no_agunan,' ')}}" placeholder="keterangan" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4"></div>
                                        <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Nama Pengaju</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="nm_aju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama pengaju" readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Pengajuan</label>
                                                    <div class="col-sm-9">   
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_aju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Nama Peyetuju</label>
                                                    <div class="col-sm-9">                                        
                                                        <input type="text" class="form-control" name="nm_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama penyutuju" readonly />
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Persetujuan</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Jual</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_jual[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                 </div>
                                <div class="row"><br>
                                        <div class="col-sm-12"> 
                                            <div class="col-sm-3">
                                                <div class="row form-group">
                                                    <div class="col-sm-6">
                                                    <b>Status Agunan:</b>
                                                    </div>
                                                    <div class="col-sm-6">
                                                    {{$ken->status}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6 "><b>Operator:</b></div>
                                                    <div class="col-sm-6">{{$ken->opr}}
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6 "><b>Kode Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ken->jenis}}
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <div class="col-sm-6 "><b>Jenis Kendaraan:</b></div>
                                                    <div class="col-sm-6">{{$ken->jenisken}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Status Kendaraan:</b></div>
                                                    <div class="col-sm-6">{{$ken->kd_status}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Pemilik:</b></div>
                                                    <div class="col-sm-6">{{$ken->pemilik}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Alamat Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ken->alamat}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Kab/Kota Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ken->kodya}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Jenis Segmen Fasilitas:</b></div>
                                                    <div class="col-sm-6">{{$ken->jenisfas}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Jenis Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ken->jenisagun}}
                                                    </div>
                                                </div>
                                                
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Peringkat Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ken->peringkat}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Lembaga Pemeringkat:</b></div>
                                                    <div class="col-sm-6">{{$ken->lembaga}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Kode Jenis Pengikatan:</b></div>
                                                    <div class="col-sm-6">{{$ken->ikat}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tanggal Pengikatan:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ken->tgl_ikat))}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Merk / Tipe:</b></div>
                                                    <div class="col-sm-6">{{$ken->merktype}}
                                                    </div>
                                                </div>  
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Spesifikasi:</b></div>
                                                    <div class="col-sm-6">{{$ken->warna}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nomor Seri:</b></div>
                                                    <div class="col-sm-6">{{$ken->nobpkb}}
                                                    </div>
                                                </div>                                       
                                            </div>
                                            <div class="col-sm-3">   
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Kendaraan:</b></div>
                                                    <div class="col-sm-6">Rp.{{number_format($ken->nilai,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Taksasi:</b></div>
                                                    <div class="col-sm-6">Rp.{{number_format($ken->niltaksasi,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Pasar:</b></div>
                                                    <div class="col-sm-6">Rp.{{number_format($ken->nilpasar,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Agunan Menurut LJK:</b></div>
                                                    <div class="col-sm-6">Rp.{{number_format($ken->ljk,0,'','.')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tanggal Penilaian LJK:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ken->tgl_nilai))}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Agunan Penilai Independent:</b></div>
                                                    <div class="col-sm-6">Rp.{{number_format($ken->indep,0,'','.')}}
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nama Penilai Independent:</b></div>
                                                    <div class="col-sm-6">{{$ken->namaindep}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tanggal Penilaian Penilai Independent:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ken->tgl_indep))}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Status Paripasu:</b></div>
                                                    <div class="col-sm-6">{{$ken->paripasu}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Persentase Paripasu:</b></div>
                                                    <div class="col-sm-6">{{$ken->persen}}%          
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Status Kredit Join:</b></div>
                                                    <div class="col-sm-6">{{trim($ken->s_join,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Diasuransikan:</b></div>
                                                    <div class="col-sm-6">{{$ken->asuransi}}
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Fungsi:</b></div>
                                                    <div class="col-sm-6">{{$ken->ket}}
                                                    </div>                                                       
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                            @endif
                            @endif
                            @endforeach -->
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
            $('[name="'+nama+'"]').css("background-color", "#F8CECE");
        }
    }
    function checkEmpty(nama,pesan){
        if($('[name="'+nama+'"]').val() == ''){
            $('.errormsg').append('<li class="text-danger">'+pesan+' wajib diisi</li>');
            $('[name="'+nama+'"]').css("background-color", "#F8CECE");
        }
    }
    $(document).ready(function() {
         // $("#inputtgladen").datepicker({ dateFormat: 'dd-mm-yy' });
        $("#tanggal").datepicker({ dateFormat: 'dd-mm-yy' });
        $('[name="input_status[]"]').on('change', function(){
                if ($(this).val() == "dipinjam") {
                  $(this).parent().parent().parent().find('[name="nm_aju[]"]').val();
                  $(this).parent().parent().parent().find('[name="nm_aju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_aju[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_aju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="nm_setuju[]"]').val();
                  $(this).parent().parent().parent().find('[name="nm_setuju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_setuju[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_setuju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_jual[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_jual[]"]').attr("readonly","readonly");
                } else if ($(this).val() == "tukar") {
                  $(this).parent().parent().parent().find('[name="nm_aju[]"]').val();
                  $(this).parent().parent().parent().find('[name="nm_aju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_aju[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_aju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="nm_setuju[]"]').val();
                  $(this).parent().parent().parent().find('[name="nm_setuju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_setuju[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_setuju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_jual[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_jual[]"]').attr("readonly","readonly");
                } else if ($(this).val() == "pengganti") {
                  $(this).parent().parent().parent().find('[name="nm_aju[]"]').val();
                  $(this).parent().parent().parent().find('[name="nm_aju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_aju[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_aju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="nm_setuju[]"]').val();
                  $(this).parent().parent().parent().find('[name="nm_setuju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_setuju[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_setuju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_jual[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_jual[]"]').attr("readonly","readonly");
                } else if ($(this).val() == "keluar") {
                  $(this).parent().parent().parent().find('[name="nm_aju[]"]').val();
                  $(this).parent().parent().parent().find('[name="nm_aju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_aju[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_aju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="nm_setuju[]"]').val();
                  $(this).parent().parent().parent().find('[name="nm_setuju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_setuju[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_setuju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_jual[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_jual[]"]').attr("readonly","readonly");
                } else if ($(this).val() == "hapus") {
                  $(this).parent().parent().parent().find('[name="nm_aju[]"]').val();
                  $(this).parent().parent().parent().find('[name="nm_aju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_aju[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_aju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="nm_setuju[]"]').val();
                  $(this).parent().parent().parent().find('[name="nm_setuju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_setuju[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_setuju[]"]').attr("readonly","readonly");
                  $(this).parent().parent().parent().find('[name="hrg_jual[]"]').val();
                  $(this).parent().parent().parent().find('[name="hrg_jual[]"]').attr("readonly","readonly");
                } else if($(this).val() == "jual") {
                  $(this).parent().parent().parent().find('[name="nm_aju[]"]').removeAttr("readonly");
                  $(this).parent().parent().parent().find('[name="hrg_aju[]"]').removeAttr("readonly");
                  $(this).parent().parent().parent().find('[name="nm_setuju[]"]').removeAttr("readonly");
                  $(this).parent().parent().parent().find('[name="hrg_setuju[]"]').removeAttr("readonly");
                  $(this).parent().parent().parent().find('[name="hrg_jual[]"]').removeAttr("readonly");
                }
           });

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
                $(this).closest("div.row").remove();
                    e.preventDefault();
                // $(this).parent().parent().parent().remove();
            });
        });


        $('#addAgKend').click(function(){
            var $template = $('#agunanKendaraan'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                //.attr('id','tanahBangunanForm'+$('[data-jaminan="tanahBangunan"]').length)
                                //.attr('id','tanahBangunanForm'+INC_OP)
                                //.insertBefore($template);
                                .appendTo('.AgunanKendaraan');
            // $('[name="input_tgl_pengikatan[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            // $('[name="input_tgl_berlaku_stnk[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });           
            // $('[name="input_tgl_penilaianLJK[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            // $('[name="input_tgl_penilaian[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            $('[name="input_nilai_kendaraan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_taksasi_ken[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_pasar_ken[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_agunanLJK[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilai_agunan_penilaiIndependent[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

            $("#input_tgl_pengikatan").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_berlaku_stnk").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_penilaianLJK").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_penilaian").datepicker({ dateFormat: 'dd-mm-yy' });
            // $('[name="input_nilai_kendaraan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $("#thn").keypress(function(data){
                if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
                {
                    $("#pesanth").html("isikan angka").show().fadeOut("slow");
                    return false;
                }
            });
            $('[name="input_status_paripasu[]"]').on('change', function(){
                if ($(this).val() == "Y") {
                   $(this).parent().parent().parent().find('[name="input_persent_paripasu[]"]').removeAttr("readonly");
                    $(this).parent().parent().parent().find('[name="input_persent_paripasu[]"]').removeAttr("readonly");
                } else if ($(this).val() == "T") {
                  $(this).parent().parent().parent().find('[name="input_persent_paripasu[]"]').val();
                  $(this).parent().parent().parent().find('[name="input_persent_paripasu[]"]').attr("readonly","readonly");
                  }
                  
           });
            $('[name="hapusKend"]').on('click',function(){
                $(this).closest("div.row").remove();
                    e.preventDefault();
                // $(this).parent().parent().parent().remove();
            });
        });

        $('#addBerat').click(function(){
            var $template = $('#AlatBerat'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                //.attr('id','tanahBangunanForm'+$('[data-jaminan="tanahBangunan"]').length)
                                //.attr('id','tanahBangunanForm'+INC_OP)
                                //.insertBefore($template);
                                .appendTo('.AlatBerat');
                $('[name="input_nilai_kendaraan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
                $('[name="input_nilai_taksasi_ken[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
                $('[name="input_nilai_pasar_ken[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
                $('[name="input_nilai_agunanLJK[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
                $('[name="nilai_agunan_penilaiIndependent[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

                $("#input_tgl_pengikatan").datepicker({ dateFormat: 'dd-mm-yy' });
                $("#input_tgl_berlaku_stnk").datepicker({ dateFormat: 'dd-mm-yy' });
                $("#input_tgl_penilaianLJK").datepicker({ dateFormat: 'dd-mm-yy' });
                $("#input_tgl_penilaian").datepicker({ dateFormat: 'dd-mm-yy' });
                // $('[name="input_nilai_kendaraan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
                $("#thn").keypress(function(data){
                    if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
                    {
                        $("#pesanth").html("isikan angka").show().fadeOut("slow");
                        return false;
                    }
                });
                $('[name="input_status_paripasu[]"]').on('change', function(){
                    if ($(this).val() == "Y") {
                       $(this).parent().parent().parent().find('[name="input_persent_paripasu[]"]').removeAttr("readonly");
                        $(this).parent().parent().parent().find('[name="input_persent_paripasu[]"]').removeAttr("readonly");
                    } else if ($(this).val() == "T") {
                      $(this).parent().parent().parent().find('[name="input_persent_paripasu[]"]').val();
                      $(this).parent().parent().parent().find('[name="input_persent_paripasu[]"]').attr("readonly","readonly");
                      }
                      
               });
            $('[name="hapusalat"]').on('click',function(){
                $(this).parent().parent().parent().remove();
            });
        });

        $('#addAgSertAden').click(function(){
            var $template = $('#agunanSertifikatAden'),
                $clone    = $template
                                // .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                //.attr('id','tanahBangunanForm'+$('[data-jaminan="tanahBangunan"]').length)
                                //.attr('id','tanahBangunanForm'+INC_OP)
                                //.insertBefore($template);
                                .appendTo('.AgunanSertifikatAden');
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
            // $('[name="input_nilai_njop_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            // $('[name="input_nilai_ht_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            // $('[name="input_nilai_pasar_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            // $('[name="input_nilai_taksasi_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="hapusSertAden"]').on('click',function(){
                 $(this).closest("div.row").remove();
                    e.preventDefault();
                // $(this).parent().parent().parent().remove();
            });
        });

        $('#addAgKendAden').click(function(){
            var $template = $('#agunanKendaraanAden'),
                $clone    = $template
                                // .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                //.attr('id','tanahBangunanForm'+$('[data-jaminan="tanahBangunan"]').length)
                                //.attr('id','tanahBangunanForm'+INC_OP)
                                //.insertBefore($template);
                                .appendTo('.AgunanKendaraanAden');
            // $('[name="input_tgl_pengikatan[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            // $('[name="input_tgl_berlaku_stnk[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });           
            // $('[name="input_tgl_penilaianLJK[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            // $('[name="input_tgl_penilaian[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            $('[name="input_nilai_kendaraan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_taksasi_ken[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_pasar_ken[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_agunanLJK[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilai_agunan_penilaiIndependent[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $("#input_tgl_pengikatan").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_berlaku_stnk").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_penilaianLJK").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_penilaian").datepicker({ dateFormat: 'dd-mm-yy' });
            // $('[name="input_nilai_kendaraan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $("#thn").keypress(function(data){
                if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
                {
                    $("#pesanth").html("isikan angka").show().fadeOut("slow");
                    return false;
                }
            });
            $('[name="hapusKendAden"]').on('click',function(){
                $(this).closest("div.row").remove();
                    e.preventDefault();

                // $(this).parent().parent().parent().remove();
            });
        });

        $('#addBeratAden').click(function(){
            var $template = $('#alatBeratAden'),
                $clone    = $template
                                // .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                //.attr('id','tanahBangunanForm'+$('[data-jaminan="tanahBangunan"]').length)
                                //.attr('id','tanahBangunanForm'+INC_OP)
                                //.insertBefore($template);
                                .appendTo('.alatBeratAden');
            $('[name="input_nilai_kendaraan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_taksasi_ken[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_pasar_ken[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_agunanLJK[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilai_agunan_penilaiIndependent[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            
            $("#input_tgl_pengikatan").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_berlaku_stnk").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_penilaianLJK").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_penilaian").datepicker({ dateFormat: 'dd-mm-yy' });
            // $("#input_tgl_pengikatan").datepicker({ dateFormat: 'dd-mm-yy' });
            // $("#input_tgl_berlaku_stnk").datepicker({ dateFormat: 'dd-mm-yy' });
            // $("#input_tgl_penilaianLJK").datepicker({ dateFormat: 'dd-mm-yy' });
            // $("#input_tgl_penilaian").datepicker({ dateFormat: 'dd-mm-yy' });
            // // $('[name="input_nilai_kendaraan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            // $("#thn").keypress(function(data){
            //     if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            //     {
            //         $("#pesanth").html("isikan angka").show().fadeOut("slow");
            //         return false;
            //     }
            // });
            $('[name="hapusBeratAden"]').on('click',function(){
                $(this).closest("div.row").remove();
                    e.preventDefault();

                // $(this).parent().parent().parent().remove();
            });
        });

        $('#simpankreditform').on('keyup keypress', function(e) {
            var code = e.keyCode || e.which;
            if (code == 14) { 
                e.preventDefault();
                return false;
            }
        });  
        // $('#simpankreditform').submit(function(e){
        //     $('.errormsg').empty();
            
        //     if(SUBM == 0){
        //         if($('.errormsg').is(':empty')){
        //             if(confirm('Apakah anda yakin semua entry sudah benar ?')){
        //                 SUBM = 1;
        //                 return true;
        //             } else {
        //                 return false;
        //             }
        //         } else {
        //             return false;
        //         }
        //     } else {
        //         return false;
        //     }
        // });
    });
</script>
@endsection
