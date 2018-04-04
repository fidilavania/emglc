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
            <form class="form-horizontal" id="simpankreditform" role="form" method="POST" action="{{ url('/saveAgunanparipasu/$nonsb/$nokredit') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel" id="panelkredit">
                    <div class="panel-body nav-tabs-animate">
                        <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                            <li role="presentation"><a data-toggle="tab" href="#agsertifikat" aria-controls="agsertifikat" role="tab">AGUNAN SERTIFIKAT PARIPASU</a><i class="fa"></i></li>
                            <li role="presentation"><a data-toggle="tab" href="#agkendaraan" aria-controls="agkendaraan" role="tab">AGUNAN KENDARAAN PARIPASU</a><i class="fa"></i></li>
                            <li role="presentation"><a data-toggle="tab" href="#alberat" aria-controls="alberat" role="tab">ALAT BERAT</a><i class="fa"></i></li>
                        </ul>
                        <div class="row"><div class="row form-group"> </div></div>
                        <div class="row">
                          <div class="col-sm-12"> 
                            <div class="col-sm-6"> 
                            <div class="row form-group">
                            <label class="col-sm-4 control-label">Nomor Nasabah</label>
                            <div class="col-sm-8">                                        
                                <input type="text" class="form-control" name="no_nsb[]" autocomplete="off" style="text-transform:uppercase;" value="{{$nasabah->no_nsb}}" readonly />
                            </div>
                                </div> 
                            <div class="row form-group">
                            <label class="col-sm-4 control-label">Nomor Kredit</label>
                                <div class="col-sm-8">                                        
                                <input type="text" class="form-control" name="no_kredit[]" autocomplete="off" style="text-transform:uppercase;" value="{{$prekredit->no_kredit}}" readonly />
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
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nomor CIF</label>
                                    <div class="col-sm-7">                                        
                                        <input type="text" class="form-control" name="no_cif[]" autocomplete="off" style="text-transform:uppercase;" value="{{$nasabah->no_cif}}" readonly  />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label" name = "pakai" value = "pakai">Tanggal Pakai</label>
                                        <div class="col-sm-7">
                                            <div class="input-group date">
                                                <input type="text" id="inputtglpakai" name="input_pakai" class="form-control" value="{{date('d-m-Y')}}" readonly />
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
                                                <input type="button" class="btn btn-primary" value="Lihat Jaminan" id="addAgSert" />
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
                                                <input type="button" class="btn btn-primary" value="Lihat Jaminan" id="addAgKend" />
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
                                                <input type="button" class="btn btn-primary" value="Lihat Jaminan" id="addBeratAden" />
                                            </div>
                                        </div>
                                            <div class="alatBeratAden">

                                            </div>                                        
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                             <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                <button type="submit" class="btn btn-primary" name="simpankreditbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">KE PENJAMIN</button>
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
    @foreach($agkredit as $ser)
    @if(($ser->status == '                                                  ')
                                     ||($ser->status == 'dipinjam                                          ')
                                     ||($ser->status == 'tukar                                             ')
                                     ||($ser->status == 'pengganti                                         ')
                                     ||($ser->status == 'kembali                                           ')
                                     ||($ser->status == '')
                                     ||($ser->status == 'OK                                                '))
                                      @if(($ser->jenis == '1-3            '))
    <div class="row">
        <div class="col-sm-12">
            <input type="button" value="Hapus"  class="btn btn-warning pull-right" name="hapusSert" />
        </div>
                                <div class="row" dataag-id="{{$ser->no_kredit}}">
                                    <div class="col-sm-12" >  
                                        <div class="col-sm-6">
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Status Agunan:</div>
                                                    <div class="col-sm-6" >
                                                    <input type="text" class="form-control" name="status_s[]" autocomplete="off" value="{{$ser->status}}" readonly />
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
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Nomor Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nomor_s[]" autocomplete="off" value="{{trim($ser->no_agunan,' ')}}"  readonly />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6 ">*Kode Agunan</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name='input_agunan1_s[]' required>
                                                            <option replace >{{trim($ser->jenis,' ')}}</option>
                                                            <option value='1-1'>1-1 - Roda Dua</option>
                                                            <option value='1-2'>1-2 - Roda Empat</option>
                                                            <option value='1-3'>1-3 - Sertifikat</option>
                                                            <option value='1-4'>1-4 - Elektronik</option>
                                                            <option value='1-5'>1-5 - SGU</option>
                                                            <option value='1-6'>1-6 - Anjak Piutang</option>
                                                            <option value='1-7'>1-7 - KKTA</option>
                                                        </select>
                                                    <!-- <input type="text" class="form-control" name="input_agunan1_s[]" autocomplete="off" style="text-transform:uppercase;" value="{{trim($ser->jenis,' ')}}" required /> -->
                                                    </div>                        
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*No Sertifikat</div>
                                                    <div class="col-sm-6">
                                                    <input type="text" class="form-control" name="input_no_sertifikat_s[]" autocomplete="off" style="text-transform:uppercase;" value="{{trim($ser->nosertif,' ')}}"  />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Jenis Sertifikat</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_jenis_sertifikat_s[]" required>
                                                            <option replace >{{trim($ser->sertstatus,' ')}}</option>
                                                            <option value="SHM">SHM</option>
                                                            <option value="HGB">SHGB</option>
                                                        </select>
                                                        <!-- <input class="form-control" name="input_jenis_sertifikat_s[]" value="{{trim($ser->sertstatus,' ')}}"  /> -->
                                                    </div>    
                                                </div>
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-6 ">*Kode Jenis Segmen Fasilitas</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_kode_jns_segFas_s[]" required>
                                                            <option replace >{{trim($ser->jenisfas,' ')}}</option>
                                                            @foreach($jenisfas as $sf)
                                                                <option value="{{$sf->sandi}}">{{$sf->sandi}} - {{$sf->fas}}</option>
                                                            @endforeach
                                                        </select> 
                                                        <!-- <input class="form-control" name="input_kode_jns_segFas_s[]" value="{{trim($ser->jenisfas,' ')}}"  /> -->
                                                    </div>
                                                </div>--}}
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Kode Status Agunan</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_kode_stat_agunan_s[]" required>
                                                            <option replace >{{trim($ser->kd_status,' ')}}</option>
                                                            @foreach($status as $s)
                                                                <option value="{{$s->sandi}}">{{$s->sandi}} - {{$s->agun}}</option>
                                                            @endforeach
                                                        </select> 
                                                        <!-- <input class="form-control" name="input_kode_stat_agunan_s[]" value="{{trim($ser->kd_status,' ')}}"  /> -->
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Kode Jenis Agunan</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_kode_jns_agunan_s[]" required>
                                                            <option replace >{{trim($ser->jenisagun,' ')}}</option>
                                                            @foreach($jenisagun as $a)
                                                                <option value="{{$a->kode}}">{{$a->kode}} - {{$a->nama}}</option>
                                                            @endforeach
                                                        </select> 
                                                    <!-- <input class="form-control" name="input_kode_jns_agunan_s[]" value="{{trim($ser->jenisagun,' ')}}"  /> -->
                                                    </div>
                                                </div>
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-6 ">Peringkat Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_peringkat_agunan_s[]" autocomplete="off" value="{{trim($ser->peringkat,' ')}}" style="text-transform:uppercase;" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Lembaga Pemeringkat</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_kode_lembaga_pemeringkat_s[]">
                                                            <option replace >{{trim($ser->lembaga,' ')}}</option>
                                                            @foreach($lembaga as $l)
                                                                <option value="{{$l->kode}}">{{$l->kode}} - {{$l->lmbg_peringkat}}</option>
                                                            @endforeach
                                                        </select> 
                                                    <!-- <input class="form-control" name="input_kode_lembaga_pemeringkat_s[]" value="{{trim($ser->lembaga,' ')}}"  /> -->
                                                    </div>
                                                </div>--}}
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Pengikatan</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_kode_jns_pengikatan_s[]">
                                                            <option replace >{{trim($ser->ikat,' ')}}</option>
                                                            @foreach($ikat as $i)
                                                                <option value="{{$i->kode}}">{{$i->kode}} - {{$i->nama}}</option>
                                                            @endforeach
                                                        </select> 
                                                    <!-- <input class="form-control" name="input_kode_jns_pengikat_s[]" value="{{trim($ser->ikat,' ')}}"  /> -->
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Pengikatan</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_pengikatan_s[]" value="{{date('d-m-Y',strtotime($ser->tgl_ikat))}}" >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nama Pemilik</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nama_pemilik_sert_s[]" autocomplete="off" value="{{trim($ser->pemilik,' ')}}" style="text-transform:uppercase" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Alamat Pemilik</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_alamat_pemilik_sert_s[]" autocomplete="off" value="{{trim($ser->alamat,' ')}}" style="text-transform:uppercase" />
                                                    </div>
                                                </div>
                                                <!-- <div class="row form-group">
                                                    <div class="col-sm-6 ">Bukti Kepemilikan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_bukti_kepemilikan_s[]" autocomplete="off" value="{{trim($ser->bukti,' ')}}" style="text-transform:uppercase;" />
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Alamat Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_lokasi_sert_s[]" autocomplete="off" value="{{trim($ser->lokasi,' ')}}" style="text-transform:uppercase" />
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="col-sm-6">  
                                                <div class="row form-group">
                                                    <div class="col-sm-6">*Kode Kab/Kota Agunan</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_kodya_nasabah_s[]" required>
                                                            <option replace >{{trim($ser->kodya,' ')}}</option>
                                                            @foreach($dati2 as $k)
                                                                <option value="{{$k->desc1}}">{{$k->desc1}} - {{$k->desc2}}</option>
                                                            @endforeach
                                                        </select>
                                                        <!-- <input class="form-control" name="input_kodya_nasabah_s[]" 
                                                        value="{{trim($ser->kodya,' ')}}"  style="text-transform:uppercase" > -->
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Luas Tanah</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_luas_tanah_s[]" autocomplete="off" value="{{trim($ser->luastanah,' ')}}"  />
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Luas Bangunan</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_luas_bangunan_s[]" autocomplete="off" value="{{trim($ser->luasbangunan,' ')}}" />
                                                            <span class="input-group-addon">m<sup>2</sup></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai NJOP</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_njop_sert_s[]" autocomplete="off" value="{{trim($ser->nilnjop,' ')}}" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai HT</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_ht_sert_s[]" autocomplete="off" value="{{trim($ser->nilhaktg,' ')}}" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai Pasar</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_pasar_sert_s[]" autocomplete="off" value="{{trim($ser->nilpasar,' ')}}" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai Taksasi</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_taksasi_sert_s[]" autocomplete="off" value="{{trim($ser->niltaksasi,' ')}}" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai Agunan Menurut LJK</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_agunanLJK_s[]" autocomplete="off" value="{{trim($ser->ljk,' ')}}" required/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian LJK</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_penilaianLJK_s[]" value="{{date('d-m-Y',strtotime($ser->tgl_nilai))}}" >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai Agunan Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="nilai_agunan_penilaiIndependent_s[]" autocomplete="off" value="{{trim($ser->indep,' ')}}" required/>
                                                        </div>
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nama Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nm_penilai_s[]" autocomplete="off" value="{{trim($ser->namaindep,' ')}}" style="text-transform:uppercase;" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_penilaian_s[]" value="{{date('d-m-Y',strtotime($ser->tgl_indep))}}"  >
                                                    </div>
                                                </div>--}}
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Status Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_status_paripasu_s[]" required>
                                                            <option replace>{{trim($ser->paripasu,' ')}}</option>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                            <!-- <input type="text"  class="form-control" name="input_status_paripasu_s[]" value="{{trim($ser->paripasu,' ')}}" required/> -->
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Persentase Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_persent_paripasu_s[]" autocomplete="off" value="{{trim($ser->persen,' ')}}" required/>
                                                            <span class="input-group-addon">%</span>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">*Status Kredit Join</div>
                                                    <div class="col-sm-6">
                                                         <select class="form-control" name="input_join_s[]" required>
                                                            <option replace>{{trim($ser->s_join,' ')}}</option>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                        <!-- <input type="text" class="form-control" name="input_join_s[]" value="{{trim($ser->s_join,' ')}}" > -->
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Diasuransikan</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_diasuransikan_s[]" required>
                                                            <option replace>{{trim($ser->asuransi,' ')}}</option>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                        <!-- <input type="text" class="form-control" name="input_diasuransikan[]" value="{{trim($ser->asuransi,' ')}}" > -->
                                                    </div>                                                       
                                                </div>
                                        </div>
                                    </div>
                                        
                                </div>
                                <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
    </div>                         
    @endif
    @endif
    @endforeach
</div>

<div id="agunanKendaraan" data-op ="agunanKend" hidden>
    <hr style="height:1px;border:none;color:#444;background-color:#444;" />
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
            <input type="button" value="Hapus"  class="btn btn-warning pull-right" name="hapusKend" />
        </div>
    
                                    <div class="row"  dataag-id="{{$ken->no_kredit}}"><br>
                                        <div class="col-sm-12"> 
                                            <div class="col-sm-6">
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Status Agunan:</div>
                                                    <div class="col-sm-6" >
                                                    <input type="text" class="form-control" name="status_k[]" autocomplete="off" value="{{$ken->status}}" readonly />
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
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Nomor Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nomor_k[]" autocomplete="off" value="{{trim($ken->no_agunan,' ')}}"  readonly  />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6 ">*Kode Agunan</div>
                                                    <div class="col-sm-6">
                                                        <!-- <input type="text" class="form-control" name='input_agunan1_k[]' value="{{trim($ken->jenis,' ')}}"  /> -->
                                                        <select class="form-control" name='input_agunan1_k[]' required>
                                                            <option replace >{{trim($ken->jenis,' ')}}</option>
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
                                                    <div class="col-sm-6 ">*Jenis Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <!-- <input class="form-control" name="input_jenis_kendaraan_k[]" value="{{trim($ken->jenisken,' ')}}" > -->
                                                        <select class="form-control" name="input_jenis_kendaraan_k[]" required>
                                                            <option replace >{{trim($ken->jenisken,' ')}}</option>
                                                            <option value="1-1">1-1 - Roda Dua</option>
                                                            <option value="1-2">1-2 - Roda Empat</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Kode Status Agunan</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_kode_stat_agunan_k[]" required>
                                                            <option replace >{{trim($ken->kd_status,' ')}}</option>
                                                            @foreach($status as $s)
                                                                <option value="{{$s->sandi}}">{{$s->sandi}} - {{$s->agun}}</option>
                                                            @endforeach
                                                        </select> 
                                                        <!-- <input class="form-control" name="input_kode_stat_agunan_k[]" value="{{trim($ken->kd_status,' ')}}" > -->
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Pemilik</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nama_pemilik_kend_k[]" autocomplete="off" value="{{trim($ken->pemilik,' ')}}" style="text-transform:uppercase"   required />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Alamat Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_alamat_pemilik_kend_k[]" autocomplete="off" value="{{trim($ken->alamat,' ')}}" style="text-transform:uppercase"   required />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Kode Kab/Kota Agunan</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_kodya_nasabah_k[]" required>
                                                            <option replace >{{trim($ken->kodya,' ')}}</option>
                                                            @foreach($dati2 as $k)
                                                                <option value="{{$k->desc1}}">{{$k->desc1}} - {{$k->desc2}}</option>
                                                            @endforeach
                                                        </select>
                                                        <!-- <input class="form-control" name="input_kodya_nasabah_k[]"  value="{{trim($ken->kodya,' ')}}" > -->
                                                    </div>
                                                </div>
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-6 ">*Kode Jenis Segmen Fasilitas</div>
                                                    <div class="col-sm-6">
                                                        <!-- <input class="form-control" name="input_kode_jns_segFas_k[]" value="{{trim($ken->jenisfas,' ')}}" > -->
                                                        <select class="form-control" name="input_kode_jns_segFas_k[]" required>
                                                            <option replace >{{trim($ken->jenisfas,' ')}}</option>
                                                            @foreach($jenisfas as $sf)
                                                                <option value="{{$sf->sandi}}">{{$sf->sandi}} - {{$sf->fas}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>--}}
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Kode Jenis Agunan</div>
                                                    <div class="col-sm-6">
                                                        <!-- <input class="form-control" name="input_kode_jns_agunan_k[]" value="{{trim($ken->jenisagun,' ')}}" /> -->
                                                        <select class="form-control" name="input_kode_jns_agunan_k[]" required>
                                                            <option replace >{{trim($ken->jenisagun,' ')}}</option>
                                                            @foreach($jenisagun as $a)
                                                                <option value="{{$a->kode}}">{{$a->kode}} - {{$a->nama}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-6 ">Peringkat Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_peringkat_agunan_k[]" autocomplete="off" value="{{trim($ken->peringkat,' ')}}" style="text-transform:uppercase;"  />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Lembaga Pemeringkat</div>
                                                    <div class="col-sm-6">
                                                        <!-- <input class="form-control" name="input_kode_lembaga_pemeringkat_k[]" value="{{trim($ken->lembaga,' ')}}" > -->
                                                        <select class="form-control" name="input_kode_lembaga_pemeringkat_k[]">
                                                            <option replace >{{trim($ken->lembaga,' ')}}</option>
                                                            @foreach($lembaga as $l)
                                                                <option value="{{$l->kode}}">{{$l->kode}} - {{$l->lmbg_peringkat}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>--}}
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Pengikatan</div>
                                                    <div class="col-sm-6">
                                                        <!-- <input class="form-control" name="input_kode_jns_pengikatan_k[]" value="{{trim($ken->ikat,' ')}}" > -->
                                                        <select class="form-control" name="input_kode_jns_pengikatan_k[]">
                                                            <option replace >{{trim($ken->ikat,' ')}}</option>
                                                            @foreach($ikat as $i)
                                                                <option value="{{$i->kode}}">{{$i->kode}} - {{$i->nama}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Pengikatan</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_pengikatan_k[]" value="{{date('d-m-Y',strtotime($ken->tgl_ikat))}}" >
                                                    </div>
                                                </div>
                                               <!--  <div class="row form-group">
                                                    <div class="col-sm-6 ">Bukti Kepemilikan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_bukti_kepemilikan_k[]" autocomplete="off" value="{{trim($ken->bukti,' ')}}" style="text-transform:uppercase;"  />
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">No STNK</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_stnk_k[]" autocomplete="off" value="{{trim($ken->nostnk,' ')}}" style="text-transform:uppercase" maxlength="25"  />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Berlaku</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_berlaku_stnk_k[]" value="{{date('d-m-Y',strtotime($ken->berlaku))}}"  >
                                                    </div>
                                                </div> 
                                                 <div class="row form-group">
                                                    <div class="col-sm-6 ">Dealer</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_dealer_kend_k[]" autocomplete="off" value="{{trim($ken->dealer,' ')}}" style="text-transform:uppercase"  />
                                                    </div>
                                                </div>   
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Merk / Tipe</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_merk_kend_k[]" autocomplete="off" value="{{trim($ken->merktype,' ')}}" style="text-transform:uppercase"   />
                                                    </div>
                                                </div>
                                                                                          
                                            </div>
                                            <div class="col-sm-6">                                               
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Tahun</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_tahun_kend_k[]" autocomplete="off" value="{{trim($ken->tahun,' ')}}" maxlength="4" id="thn" id="pesanth"  style="text-transform:uppercase" />
                                                    </div>
                                                </div>  
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Warna</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_warna_kend_k[]" autocomplete="off" value="{{trim($ken->warna,' ')}}" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor Polisi</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_polisi_k[]" autocomplete="off" value="{{trim($ken->nopolisi,' ')}}"  />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nomor BPKB</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_bpkb_k[]" autocomplete="off" value="{{trim($ken->nobpkb,' ')}}" style="text-transform:uppercase"  />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor Rangka</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_rangka_k[]" autocomplete="off" value="{{trim($ken->norangka,' ')}}"  style="text-transform:uppercase"  />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nomor Mesin</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_mesin_k[]" autocomplete="off" value="{{trim($ken->nomesin,' ')}}"  style="text-transform:uppercase" />
                                                    </div>
                                                </div>
                                               <!--  <div class="row form-group">
                                                    <div class="col-sm-6 ">Kelompok</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_kelompok_kend_k[]" autocomplete="off" value="{{trim($ken->kelompok,' ')}}" required style="text-transform:uppercase"  />
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_kendaraan_k[]" autocomplete="off" value="{{trim($ken->nilai,' ')}}" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai Taksasi</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_taksasi_ken_k[]" autocomplete="off" value="{{trim($ken->niltaksasi,' ')}}" required  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai Pasar</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_pasar_ken_k[]" autocomplete="off" value="{{trim($ken->nilpasar,' ')}}" required  />
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai Agunan Menurut LJK</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_agunanLJK_k[]" autocomplete="off" value="{{trim($ken->ljk,' ')}}" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian LJK</div>
                                                    <div class="col-sm-6">
                                                    <!-- $('input.datepicker').Zebra_DatePicker(); -->
                                                      <input type="text" class="form-control" name="input_tgl_penilaianLJK_k[]" value="{{date('d-m-Y',strtotime($ken->tgl_nilai))}}"  >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai Agunan Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="nilai_agunan_penilaiIndependent_k[]" autocomplete="off" value="{{trim($ken->indep,' ')}}" required />
                                                        </div>
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nama Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nm_penilai_k[]" autocomplete="off" value="{{trim($ken->namaindep,' ')}}"  style="text-transform:uppercase;"  penilai Independent" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_penilaian_k[]" value="{{date('d-m-Y',strtotime($ken->tgl_indep))}}"  >
                                                    </div>
                                                </div>--}}
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Status Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_status_paripasu_k[]" required>
                                                            <option replace>{{trim($ken->paripasu,' ')}}</option>
                                                            <option value >-Ganti Status-</option>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                        <!-- <input type="text" class="form-control" name="input_status_paripasu_k[]" value="{{trim($ken->paripasu,' ')}}" required> -->
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Persentase Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_persent_paripasu_k[]" autocomplete="off" value="{{trim($ken->persen,' ')}}" required />
                                                            <span class="input-group-addon">%</span>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">*Status Kredit Join</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_join_k[]" required>
                                                            <option replace>{{trim($ken->s_join,' ')}}</option>
                                                            <option value >-Ganti Status-</option>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                        <!-- <input type="text" class="form-control" name="input_join_k[]" value="{{trim($ken->s_join,' ')}}" > -->
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Diasuransikan</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_diasuransikan_k[]" required>
                                                            <option replace>{{trim($ken->asuransi,' ')}}</option>
                                                            <option value >-Ganti Status-</option>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                        <!-- <input type="text" class="form-control" name="input_diasuransikan[]" value="{{trim($ken->asuransi,' ')}}" > -->
                                                    </div>                                                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
    </div>
    @endif
    @endif
@endforeach
</div>

<div id="alatBeratAden" data-op ="alatBeratAden" hidden>
    <hr style="height:1px;border:none;color:#444;background-color:#444;" />
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
            <input type="button" value="Hapus"  class="btn btn-warning pull-right" name="hapusalat" />
        </div>
    
                                     <div class="row"  dataag-id="{{$ken->no_kredit}}"><br>
                                        <div class="col-sm-12"> 
                                            <div class="col-sm-6">
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Status Agunan:</div>
                                                    <div class="col-sm-6" >
                                                    <input type="text" class="form-control" name="status_k[]" autocomplete="off" value="{{$ken->status}}" readonly />
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
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Nomor Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nomor_k[]" autocomplete="off" value="{{trim($ken->no_agunan,' ')}}"  readonly  />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6 ">Kode Agunan</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name='input_agunan1_k[]' required>
                                                            <option replace >{{trim($ken->jenis,' ')}}</option>
                                                            <option value='1-1'>1-1 - Roda Dua</option>
                                                            <option value='1-2'>1-2 - Roda Empat</option>
                                                            <option value='1-3'>1-3 - Sertifikat</option>
                                                            <option value='1-4'>1-4 - Elektronik</option>
                                                            <option value='1-5'>1-5 - SGU</option>
                                                            <option value='1-6'>1-6 - Anjak Piutang</option>
                                                            <option value='1-7'>1-7 - KKTA</option>
                                                        </select>
                                                        <!-- <input type="text" class="form-control" name='input_agunan1_k[]' value="{{trim($ken->jenis,' ')}}"  /> -->
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <div class="col-sm-6 ">Jenis Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <input class="form-control" name="input_jenis_kendaraan_k[]" value="{{trim($ken->jenisken,' ')}}" >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Kode Status Agunan</div>
                                                    <div class="col-sm-6">
                                                        <!-- <input class="form-control" name="input_kode_stat_agunan_k[]" value="{{trim($ken->kd_status,' ')}}" > -->
                                                        <select class="form-control" name="input_kode_stat_agunan_k[]" required>
                                                            <option replace >{{trim($ken->kd_status,' ')}}</option>
                                                            @foreach($status as $s)
                                                                <option value="{{$s->sandi}}">{{$s->sandi}} - {{$s->agun}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Pemilik</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nama_pemilik_kend_k[]" autocomplete="off" value="{{trim($ken->pemilik,' ')}}" style="text-transform:uppercase"   required />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Alamat Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_alamat_pemilik_kend_k[]" autocomplete="off" value="{{trim($ken->alamat,' ')}}" style="text-transform:uppercase"   required />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Kode Kab/Kota Agunan</div>
                                                    <div class="col-sm-6">
                                                        <!-- <input class="form-control" name="input_kodya_nasabah_k[]"  value="{{trim($ken->kodya,' ')}}" > -->
                                                        <select class="form-control" name="input_kodya_nasabah_k[]" required>
                                                            <option replace >{{trim($ken->kodya,' ')}}</option>
                                                            @foreach($dati2 as $k)
                                                                <option value="{{$k->desc1}}">{{$k->desc1}} - {{$k->desc2}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-6 ">*Kode Jenis Segmen Fasilitas</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_kode_jns_segFas_k[]" required>
                                                            <option replace >{{trim($ken->jenisfas,' ')}}</option>
                                                            @foreach($jenisfas as $sf)
                                                                <option value="{{$sf->sandi}}">{{$sf->sandi}} - {{$sf->fas}}</option>
                                                            @endforeach
                                                        </select><!--  
                                                        <input class="form-control" name="input_kode_jns_segFas_k[]" value="{{trim($ken->jenisfas,' ')}}" > -->
                                                    </div>
                                                </div>--}}
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Kode Jenis Agunan</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_kode_jns_agunan_k[]" required>
                                                            <option replace >{{trim($ken->jenisagun,' ')}}</option>
                                                            @foreach($jenisagun as $a)
                                                                <option value="{{$a->kode}}">{{$a->kode}} - {{$a->nama}}</option>
                                                            @endforeach
                                                        </select> 
                                                        <!-- <input class="form-control" name="input_kode_jns_agunan_k[]" value="{{trim($ken->jenisagun,' ')}}" /> -->
                                                    </div>
                                                </div>
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-6 ">Peringkat Agunan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_peringkat_agunan_k[]" autocomplete="off" value="{{trim($ken->peringkat,' ')}}" style="text-transform:uppercase;"  />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Lembaga Pemeringkat</div>
                                                    <div class="col-sm-6">
                                                        <!-- <input class="form-control" name="input_kode_lembaga_pemeringkat_k[]" value="{{trim($ken->lembaga,' ')}}" > -->
                                                        <select class="form-control" name="input_kode_lembaga_pemeringkat_k[]">
                                                            <option replace >{{trim($ken->lembaga,' ')}}</option>
                                                            @foreach($lembaga as $l)
                                                                <option value="{{$l->kode}}">{{$l->kode}} - {{$l->lmbg_peringkat}}</option>
                                                            @endforeach
                                                        </select> 
                                                    </div>
                                                </div>--}}
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Kode Jenis Pengikatan</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_kode_jns_pengikatan_k[]">
                                                            <option replace >{{trim($ken->ikat,' ')}}</option>
                                                            @foreach($ikat as $i)
                                                                <option value="{{$i->kode}}">{{$i->kode}} - {{$i->nama}}</option>
                                                            @endforeach
                                                        </select> 
                                                        <!-- <input class="form-control" name="input_kode_jns_pengikatan_k[]" value="{{trim($ken->ikat,' ')}}" > -->
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Pengikatan</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_pengikatan_k[]" value="{{date('d-m-Y',strtotime($ken->tgl_ikat))}}" >
                                                    </div>
                                                </div>
                                               <!--  <div class="row form-group">
                                                    <div class="col-sm-6 ">Bukti Kepemilikan</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_bukti_kepemilikan_k[]" autocomplete="off" value="{{trim($ken->bukti,' ')}}" style="text-transform:uppercase;"  />
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Merk / Tipe</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_merk_kend_k[]" autocomplete="off" value="{{trim($ken->merktype,' ')}}" style="text-transform:uppercase" required  />
                                                    </div>
                                                </div>
                                                                                          
                                            </div>
                                            <div class="col-sm-6">                                               
                                                
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Spesifikasi</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_warna_kend_k[]" autocomplete="off" value="{{trim($ken->warna,' ')}}" />
                                                    </div>
                                                </div>
                                                
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nomor Seri</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_no_bpkb_k[]" autocomplete="off" value="{{trim($ken->nobpkb,' ')}}" style="text-transform:uppercase" required />
                                                    </div>
                                                </div>
                                               <!--  <div class="row form-group">
                                                    <div class="col-sm-6 ">Kelompok</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_kelompok_kend_k[]" autocomplete="off" value="{{trim($ken->kelompok,' ')}}" required style="text-transform:uppercase"  />
                                                    </div>
                                                </div> -->
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai Kendaraan</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_kendaraan_k[]" autocomplete="off" value="{{trim($ken->nilai,' ')}}" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai Taksasi</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_taksasi_ken_k[]" autocomplete="off" value="{{trim($ken->niltaksasi,' ')}}" required  />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai Pasar</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_pasar_ken_k[]" autocomplete="off" value="{{trim($ken->nilpasar,' ')}}" required  />
                                                        </div>
                                                    </div>
                                                </div>
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-6 ">Nilai Agunan Menurut LJK</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_nilai_agunanLJK_k[]" autocomplete="off" value="{{trim($ken->ljk,' ')}}" required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian LJK</div>
                                                    <div class="col-sm-6">
                                                    <!-- $('input.datepicker').Zebra_DatePicker(); -->
                                                      <input type="text" class="form-control" name="input_tgl_penilaianLJK_k[]" value="{{date('d-m-Y',strtotime($ken->tgl_nilai))}}"  >
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Nilai Agunan Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="nilai_agunan_penilaiIndependent_k[]" autocomplete="off" value="{{trim($ken->indep,' ')}}" required />
                                                        </div>
                                                    </div>
                                                </div>                                                              
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Nama Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_nm_penilai_k[]" autocomplete="off" value="{{trim($ken->namaindep,' ')}}"  style="text-transform:uppercase;"  penilai Independent" />
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Tanggal Penilaian Penilai Independent</div>
                                                    <div class="col-sm-6">
                                                      <input type="text" class="form-control" name="input_tgl_penilaian_k[]" value="{{date('d-m-Y',strtotime($ken->tgl_indep))}}"  >
                                                    </div>
                                                </div>--}}
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Status Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_status_paripasu_k[]" required>
                                                            <option replace>{{trim($ken->paripasu,' ')}}</option>
                                                            <option value >-Ganti Status-</option>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                        <!-- <input type="text" class="form-control" name="input_status_paripasu_k[]" value="{{trim($ken->paripasu,' ')}}" required> -->
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Persentase Paripasu</div>
                                                    <div class="col-sm-6">
                                                        <div class="input-group">
                                                            <input type="text" class="form-control" name="input_persent_paripasu_k[]" autocomplete="off" value="{{trim($ken->persen,' ')}}" required />
                                                            <span class="input-group-addon">%</span>
                                                        </div>                                        
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">*Status Kredit Join</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_join_k[]" required>
                                                            <option replace >{{trim($ken->s_join,' ')}}</option>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                        <!-- <input type="text" class="form-control" name="input_join_k[]" value="{{trim($ken->s_join,' ')}}" > -->
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">*Diasuransikan</div>
                                                    <div class="col-sm-6">
                                                        <!-- <input type="text" class="form-control" name="input_diasuransikan_k[]" value="{{trim($ken->asuransi,' ')}}" > -->
                                                        <select class="form-control" name="input_diasuransikan_k[]" required>
                                                             <option replace >{{trim($ken->asuransi,' ')}}</option>
                                                            <option value="T" >TIDAK</option>
                                                            <option value="Y">YA</option>
                                                        </select>
                                                    </div>                                                       
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Fungsi</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_diasuransikan_k[]" value="{{trim($ken->ket,' ')}}" >
                                                    </div>                                                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
    </div>
    @endif
    @endif
    @endforeach
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
                                // .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                //.attr('id','tanahBangunanForm'+$('[data-jaminan="tanahBangunan"]').length)
                                //.attr('id','tanahBangunanForm'+INC_OP)
                                //.insertBefore($template);
                                .appendTo('.AgunanSertifikat');
            $('[name="input_nilai_taksasi_sert_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_pasar_sert_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_njop_sert_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_ht_sert_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_agunanLJK_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilai_agunan_penilaiIndependent_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

            $('[name="input_tgl_pengikatan_s[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            $('[name="input_tgl_penilaianLJK_s[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            $('[name="input_tgl_penilaian_s[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            // $('[name="input_nilai_njop_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            // $('[name="input_nilai_ht_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            // $('[name="input_nilai_pasar_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            // $('[name="input_nilai_taksasi_sert[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="hapusSert"]').on('click',function(){
                 $(this).closest("div.row").remove();
                    e.preventDefault();
            });
        });

        $('#addAgKend').click(function(){
            var $template = $('#agunanKendaraan'),
                $clone    = $template
                                // .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                //.attr('id','tanahBangunanForm'+$('[data-jaminan="tanahBangunan"]').length)
                                //.attr('id','tanahBangunanForm'+INC_OP)
                                //.insertBefore($template);
                                .appendTo('.AgunanKendaraan');
            $('[name="input_tgl_pengikatan_k[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            $('[name="input_tgl_berlaku_stnk_k[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });           
            $('[name="input_tgl_penilaianLJK_k[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            $('[name="input_tgl_penilaian_k[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            $('[name="input_nilai_kendaraan_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_taksasi_ken_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_pasar_ken_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_agunanLJK_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilai_agunan_penilaiIndependent_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            // $('[name="input_nilai_kendaraan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $("#thn").keypress(function(data){
                if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
                {
                    $("#pesanth").html("isikan angka").show().fadeOut("slow");
                    return false;
                }
            });
           $('[name="hapusKend"]').on('click',function(){
                $(this).closest("div.row").remove();
                    e.preventDefault();
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
            $('[name="input_tgl_pengikatan_k[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            $('[name="input_tgl_berlaku_stnk_k[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });           
            $('[name="input_tgl_penilaianLJK_k[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            $('[name="input_tgl_penilaian_k[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
            
            $('[name="input_nilai_kendaraan_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_taksasi_ken_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_pasar_ken_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_agunanLJK_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilai_agunan_penilaiIndependent_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
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
                $(this).closest("div.row").remove();
                    e.preventDefault();
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
