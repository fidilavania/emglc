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
            <form class="form-horizontal" id="simpankreditform" role="form" method="POST" action="{{ url('/savetambahagun/$nokredit') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel" id="panelkredit">
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
                                    <label class="col-sm-4 control-label">Nomor Nasabah</label>
                                    <div class="col-sm-8">                                        
                                        <input type="text" class="form-control" name="no_nsb[]" autocomplete="off" style="text-transform:uppercase;" value="{{$prekredit->no_nsb}}" readonly required />
                                    </div>
                                </div> 
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Nomor Kredit</label>
                                        <div class="col-sm-8">                                        
                                        <input type="text" class="form-control" name="no_kredit[]" autocomplete="off" style="text-transform:uppercase;" value="{{$prekredit->no_kredit}}" readonly required />
                                        </div>
                                </div>

                                        @foreach($kredit as $daf)
                                        <div class="row form-group">
                                            <label class="col-sm-4 control-label">Nomor NPP</label>
                                                <div class="col-sm-8">                                        
                                                <input type="text" class="form-control" autocomplete="off" style="text-transform:uppercase;" value="{{$daf->no_ref}}" readonly required />
                                                </div>
                                        </div>
                                        @endforeach
                          </div>
                            <div class="col-sm-6"> 
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Operator</label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" name="opr" autocomplete="off" value="{{ trim(Auth::user()->nama_lengkap,' ') }}" style="text-transform:uppercase;" readonly />
                                    </div>
                                </div>
                                <!-- <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nomor CIF</label>
                                    <div class="col-sm-7">                                        
                                        <input type="text" class="form-control" name="no_cif[]" autocomplete="off" style="text-transform:uppercase;" value="{{$prekredit->no_cif}}" readonly required />
                                    </div>
                                </div>  -->
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
                        <div class="row">
                        <div class="tab-content">
                            <fieldset class="tab-pane animation-slide-left" id="agsertifikat" role="tabpanel">
                                <div class="panel panel-bordered">
                                    <div class="panel-heading text-center">
                                      {{-- <h4 class="panel-title">AGUNAN SERTIFIKAT</h4> --}}
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-sm-2">
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
    <hr style="height:1px;border:none;color:#444;background-color:#444;" />
    <div class="row">
        <div class="col-sm-12">
            <input type="button" value="Hapus"  class="btn btn-warning pull-right" name="hapusSert" />
        </div>
    </div>
    <br />
    <div class="row">
                            <div class="col-sm-3">
                                <?php
                                    echo "<font color='#ff0000'>* wajib diisi</font><br>";
                                ?>
                            </div><br>
                                            <div class="col-sm-6">
                                                
                                                <div class="row form-group">
                                                <label class="col-sm-4 control-label">*Kode Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name='input_agunan_s[]' required>
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
                                                        <input type="text" class="form-control" name="input_lokasi_sert_s[]" autocomplete="off" value="" style="text-transform:uppercase" placeholder="Alamat agunan" required />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">*Kode Kab/Kota Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name="input_kodya_nasabah_s[]" required>
                                                            <option value="1293" >1293 - Malang,Kota</option>
                                                            <option value >-Pilih Kodya-</option>
                                                            @foreach($dati2 as $k)
                                                                <option value="{{$k->desc2}}">{{$k->desc1}} - {{$k->desc2}}</option>
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
                                                    <label class="col-sm-4 control-label">*Nilai Agunan Penilai Independent</label>
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
                                                    <label class="col-sm-4 control-label">*Persentase Paripasu</label>
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
                                                        <input type="text" class="form-control" name="input_keterangan_sert[]" autocomplete="off" vYalue="" />
                                                    </div>
                                                </div> -->
                                            </div>
    </div>
</div>
<div id="agunanKendaraan" data-op ="agunanKend" hidden>
    <hr style="height:1px;border:none;color:#444;background-color:#444;" />
    <div class="row">
        <div class="col-sm-12">
            <input type="button" value="Hapus" class="btn btn-warning pull-right" name="hapusKend" />
        </div>
    </div>
    <br />
    <div class="row">
                            <div class="col-sm-3">
                                <?php
                                    echo "<font color='#ff0000'>* wajib diisi</font><br>";
                                ?>
                            </div><br>
                                            <div class="col-sm-6">
                                                 
                                                <div class="row form-group">
                                                <label class="col-sm-4 control-label">*Kode Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name='input_agunan_k[]' required>
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
                                                                <option value="{{$k->desc2}}">{{$k->desc1}} - {{$k->desc2}}</option>
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
                                                    <label class="col-sm-4 control-label">Status Paripasu</label>
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
<div id="AlatBerat" data-op ="AlatBerat" hidden>
    <hr style="height:1px;border:none;color:#444;background-color:#444;" />
    <div class="row">
        <div class="col-sm-12">
            <input type="button" value="Hapus" class="btn btn-warning pull-right" name="hapusalat" />
        </div>
    </div>
    <br />
    <div class="row">
                            <div class="col-sm-3">
                                <?php
                                    echo "<font color='#ff0000'>* wajib diisi</font><br>";
                                ?>
                            </div><br>
                                            <div class="col-sm-6">
                                                 
                                                <div class="row form-group">
                                                <label class="col-sm-4 control-label">*Kode Agunan</label>
                                                    <div class="col-sm-8">
                                                        <select class="form-control" name='input_agunan_k[]' required>
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
                                                                <option value="{{$k->desc2}}">{{$k->desc1}} - {{$k->desc2}}</option>
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
                                                 <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Spesifikasi</label>
                                                    <div class="col-sm-8">
                                                        <input type="text" class="form-control" name="input_warna_kend_k[]" autocomplete="off" value="" style="text-transform:uppercase;" placeholder="Spesifikasi" />
                                                    </div>
                                                </div>                                
                                            </div>
                                            <div class="col-sm-6">                                               
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
            $('[name="input_nilai_taksasi_sert_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_pasar_sert_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_njop_sert_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_ht_sert_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_agunanLJK_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilai_agunan_penilaiIndependent_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

            $("#input_tgl_pengikatan_s").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_penilaianLJK_s").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_penilaian_s").datepicker({ dateFormat: 'dd-mm-yy' });
            $('[name="input_status_paripasu_s[]"]').on('change', function(){
                if ($(this).val() == "Y") {
                   $(this).parent().parent().parent().find('[name="input_persent_paripasu_s[]"]').removeAttr("readonly");
                    $(this).parent().parent().parent().find('[name="input_persent_paripasu_s[]"]').removeAttr("readonly");
                } else if ($(this).val() == "T") {
                  $(this).parent().parent().parent().find('[name="input_persent_paripasu_s[]"]').val();
                  $(this).parent().parent().parent().find('[name="input_persent_paripasu_s[]"]').attr("readonly","readonly");
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
            $('[name="input_nilai_kendaraan_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_taksasi_ken_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_pasar_ken_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_agunanLJK_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilai_agunan_penilaiIndependent_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $("#input_tgl_pengikatan_k").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_berlaku_stnk_k").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_penilaianLJK_k").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_penilaian_k").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#thn").keypress(function(data){
                if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
                {
                    $("#pesanth").html("isikan angka").show().fadeOut("slow");
                    return false;
                }
            });
            $('[name="input_status_paripasu_k[]"]').on('change', function(){
                if ($(this).val() == "Y") {
                   $(this).parent().parent().parent().find('[name="input_persent_paripasu_k[]"]').removeAttr("readonly");
                    $(this).parent().parent().parent().find('[name="input_persent_paripasu_k[]"]').removeAttr("readonly");
                } else if ($(this).val() == "T") {
                  $(this).parent().parent().parent().find('[name="input_persent_paripasu_k[]"]').val();
                  $(this).parent().parent().parent().find('[name="input_persent_paripasu_k[]"]').attr("readonly","readonly");
                  }
                  
           });
            // $('[name="input_nilai_kendaraan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="hapusKend"]').on('click',function(){
                $(this).parent().parent().parent().remove();
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
            $('[name="input_nilai_kendaraan_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_taksasi_ken_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_pasar_ken_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_agunanLJK_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilai_agunan_penilaiIndependent_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            
            $("#input_tgl_pengikatan_k").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_berlaku_stnk_k").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_penilaianLJK_k").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#input_tgl_penilaian_k").datepicker({ dateFormat: 'dd-mm-yy' });
            $("#thn").keypress(function(data){
                if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
                {
                    $("#pesanth").html("isikan angka").show().fadeOut("slow");
                    return false;
                }
            });
            $('[name="input_status_paripasu_k[]"]').on('change', function(){
                if ($(this).val() == "Y") {
                   $(this).parent().parent().parent().find('[name="input_persent_paripasu_k[]"]').removeAttr("readonly");
                    $(this).parent().parent().parent().find('[name="input_persent_paripasu_k[]"]').removeAttr("readonly");
                } else if ($(this).val() == "T") {
                  $(this).parent().parent().parent().find('[name="input_persent_paripasu_k[]"]').val();
                  $(this).parent().parent().parent().find('[name="input_persent_paripasu_k[]"]').attr("readonly","readonly");
                  }
                  
           });
            // $("#input_tgl_penilaian").datepicker({ dateFormat: 'dd-mm-yy' });
            // $("#thn").keypress(function(data){
            //     if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            //     {
            //         $("#pesanth").html("isikan angka").show().fadeOut("slow");
            //         return false;
            //     }
            // });
            // $('[name="input_nilai_kendaraan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="hapusalat"]').on('click',function(){
                $(this).parent().parent().parent().remove();
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
