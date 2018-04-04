@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="panelkredit">
             <form class="form-horizontal" id="viewkreditform" role="form" method="POST" action="{{ url('/savekorek/$nokredit') }}"  >
                <!-- <div class="panel-heading"><h4 align="center">DETAIL DATA</h4></div> -->
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div style="border: 15px outset #2a4aeb; height: 70px; text-align: center; width: 1140px;"><h4 align="center">KOREKSI DATA</h4></div>
                    <div class="panel-body nav-tabs-animate">
                        <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                            <!-- <li class="active" role="presentation"><a data-toggle="tab" href="#kredit" aria-controls="kredit" role="tab">KREDIT</a><i class="fa"></i></li> -->
                            <!-- <li class="active" role="presentation"><a data-toggle="tab" href="#datapenjamin" aria-controls="datapenjamin" role="tab">PENJAMIN</a><i class="fa"></i></li> -->
                            <li class="active"   role="presentation"><a data-toggle="tab" href="#agsertifikat" aria-controls="agsertifikat" role="tab">AGUNAN SERTIFIKAT</a><i class="fa"></i></li>
                            <li  role="presentation"><a data-toggle="tab" href="#agkendaraan" aria-controls="agkendaraan" role="tab">AGUNAN KENDARAAN</a><i class="fa"></i></li>
                            <li  role="presentation"><a data-toggle="tab" href="#alberat" aria-controls="alberat" role="tab">ALAT BERAT</a><i class="fa"></i></li>
                            <!-- <li  role="presentation"><a data-toggle="tab" href="#lapuang" aria-controls="lapuang" role="tab">LAPORAN KEUANGAN</a><i class="fa"></i></li> -->
                            <!-- <li  role="presentation"><a data-toggle="tab" href="#pengurus" aria-controls="pengurus" role="tab">PENGURUS</a><i class="fa"></i></li> -->
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
                                                @foreach($daftar as $daf)
                                                 <div class="row form-group">
                                                    <div class="col-sm-12">
                                                        <b>Nomor NPP : {{$daf->no_ref}}</b>
                                                    </div>
                                                </div>
                                                 @endforeach
                                        </div>
                                        
                                    </div>
                                @endforeach
                                </div>
                                 <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/> 
                                <br>
              

                        <fieldset class="tab-pane  active animation-slide-left"  id="agsertifikat" role="tabpanel">
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
                                                    <div class="col-sm-6">Status Agunan:</div>
                                                    <div class="col-sm-6" >
                                                    <input type="text" class="form-control" name="status_s[]" autocomplete="off" value="{{$ser->status}}" readonly />
                                                    </div>
                                                </div>
                                                @foreach($prekredit as $pre)
                                                 <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nomor Nasabah</b></div>
                                                    <div class="col-sm-6">                                        
                                                        <input type="text" class="form-control" name="no_nsb[]" autocomplete="off" style="text-transform:uppercase;" value="{{trim($pre->no_nsb,' ')}}" readonly />
                                                    </div>
                                                </div> 
                                                @endforeach
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
                                                <div class="row form-group">
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
                                                </div>
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
                                                <div class="row form-group">
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
                                                </div>
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
                                                    <div class="col-sm-6 ">Tanggal Pengkaitan</div>
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
                                                    <div class="col-sm-6 ">Operator</div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" name="opr[]" autocomplete="off" value="{{ trim(Auth::user()->nama_lengkap,' ') }}" style="text-transform:uppercase;" readonly />
                                                        </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6">*Kode Kab/Kota Agunan</div>
                                                    <div class="col-sm-6">
                                                        <select class="form-control" name="input_kodya_nasabah_s[]" required>
                                                            <option replace >{{trim($ser->kodya,' ')}}</option>
                                                            @foreach($dati2 as $k)
                                                                <option value="{{$k->desc2}}">{{$k->desc1}} - {{$k->desc2}}</option>
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
                                                <div class="row form-group">
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
                                                </div>
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
                                     @endif
                                     @endforeach

                                     
                                     <!-- <div class="row form-group">
                                            @if((strpos(Auth::user()->fungsi, '1001') !== false)||(strpos(Auth::user()->fungsi, '7777') !== false))
                                            @foreach($daftar as $daf)
                                            <div hidden="text"  datain-id="{{$daf->no_kredit}}">
                                                    <div class="col-sm-6"><b>Nomor Kredit :</b></div>
                                                    <div class="col-sm-6"> {{$daf->no_kredit}}</div>
                                            </div>
                                                 <div class="col-sm-6"><br>
                                                    <input type="button" class="btn btn-danger" name="aden" value="KOREKSI AGUNAN" />
                                            @endforeach
                                            </div>
                                             @endif
                                        </div>   -->

                                        <div class="row">
                                            <div class="col-sm-2">
                                                <input type="button" class="btn btn-danger" value="Tambah Jaminan" id="addAgSert" />
                                            </div>
                                        </div>
                                        <div class="AgunanSertifikat">

                                        </div>
                                    </div>
                                </div>
                        </fieldset>

                        <fieldset class="tab-pane animation-slide-left" id="agkendaraan" role="tabpanel">
                                <div class="panel panel-bordered">
                                <div class="panel-body">

                                    @foreach($kendaraan as $ken)
                                     @if(($ken->status == '          ')||($ken->status == 'dipinjam  ')||($ken->status == 'tukar     ')||($ken->status == 'pengganti ')||($ken->status == '')||($ken->status == 'kembali   ')||($ken->status ==  'OK        '))
                                     @if(($ken->jenis != '1-7            '))
                                    <div class="row"  dataag-id="{{$ken->no_kredit}}"><br>
                                        <div class="col-sm-12"> 
                                            <div class="col-sm-6">
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Status Agunan:</div>
                                                    <div class="col-sm-6" >
                                                    <input type="text" class="form-control" name="status_k[]" autocomplete="off" value="{{$ken->status}}" readonly />
                                                    </div>
                                                </div>
                                                 @foreach($prekredit as $pre)
                                                 <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nomor Nasabah</b></div>
                                                    <div class="col-sm-6">                                        
                                                        <input type="text" class="form-control" name="no_nsb[]" autocomplete="off" style="text-transform:uppercase;" value="{{trim($pre->no_nsb,' ')}}" readonly />
                                                    </div>
                                                </div> 
                                                @endforeach
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
                                                        <!-- <input type="text" class="form-control" name='input_agunan1[]' value="{{trim($ken->jenis,' ')}}"  /> -->
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
                                                        <!-- <input class="form-control" name="input_jenis_kendaraan[]" value="{{trim($ken->jenisken,' ')}}" > -->
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
                                                                <option value="{{$k->desc2}}">{{$k->desc1}} - {{$k->desc2}}</option>
                                                            @endforeach
                                                        </select>
                                                        <!-- <input class="form-control" name="input_kodya_nasabah_k[]"  value="{{trim($ken->kodya,' ')}}" > -->
                                                    </div>
                                                </div>
                                                <div class="row form-group">
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
                                                </div>
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
                                                <div class="row form-group">
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
                                                </div>
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
                                                    <div class="col-sm-6 ">Tanggal Pengkaitan</div>
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
                                                        <input type="text" class="form-control" maxlength="25" name="input_no_stnk_k[]" autocomplete="off" value="{{trim($ken->nostnk,' ')}}" style="text-transform:uppercase"   />
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
                                                
                                                                                          
                                            </div>
                                            <div class="col-sm-6"> 
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Operator</div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" name="opr[]" autocomplete="off" value="{{ trim(Auth::user()->nama_lengkap,' ') }}" style="text-transform:uppercase;" readonly />
                                                        </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 ">Merk / Tipe</div>
                                                    <div class="col-sm-6">
                                                        <input type="text" class="form-control" name="input_merk_kend_k[]" autocomplete="off" value="{{trim($ken->merktype,' ')}}" style="text-transform:uppercase"   />
                                                    </div>
                                                </div>                                              
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
                                                <div class="row form-group">
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
                                                </div>
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
                                    @endif
                                     @endif
                                     @endforeach

                                    

                                     <!-- <div class="row form-group">
                                            @if((strpos(Auth::user()->fungsi, '1001') !== false)||(strpos(Auth::user()->fungsi, '7777') !== false))
                                            @foreach($daftar as $daf)
                                            <div hidden="text" class="col-sm-12" datain-id="{{$daf->no_kredit}}">
                                                <div class="col-sm-6">
                                                    <div class="col-sm-6"><b>Nomor Kredit :</b></div>
                                                    <div class="col-sm-6"> {{$daf->no_kredit}}</div>
                                                </div>
                                            </div>
                                                <div class="col-sm-6"><br>
                                                    <input type="button" class="btn btn-danger" name="aden" value="KOREKSI AGUNAN" />
                                            @endforeach
                                            </div>
                                            @endif
                                        </div>  -->
                                    <div class="row">
                                            <div class="col-sm-2">
                                                <input type="button" class="btn btn-danger" value="Tambah Jaminan" id="addAgKend" />
                                            </div>
                                        </div>
                                        <div class="AgunanKendaraan">

                                        </div>
                                </div>
                                </div>
                        </fieldset>

                        <fieldset class="tab-pane animation-slide-left" id="alberat" role="tabpanel">
                            <div class="panel panel-bordered">
                                <div class="panel-body">
                                    @foreach($kendaraan as $ken)
                                     @if(($ken->status == '          ')||($ken->status == 'dipinjam  ')||($ken->status == 'tukar     ')||($ken->status == 'pengganti ')||($ken->status ==  'OK        '))
                                    @if(($ken->jenis == '1-7            '))
                                    <div class="row"  dataag-id="{{$ken->no_kredit}}"><br>
                                        <div class="col-sm-12"> 
                                            <div class="col-sm-6">
                                                <div class="row form-group">
                                                    <div class="col-sm-6">Status Agunan:</div>
                                                    <div class="col-sm-6" >
                                                    <input type="text" class="form-control" name="status_k[]" autocomplete="off" value="{{$ken->status}}" readonly />
                                                    </div>
                                                </div>
                                                 @foreach($prekredit as $pre)
                                                 <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nomor Nasabah</b></div>
                                                    <div class="col-sm-6">                                        
                                                        <input type="text" class="form-control" name="no_nsb[]" autocomplete="off" style="text-transform:uppercase;" value="{{trim($pre->no_nsb,' ')}}" readonly />
                                                    </div>
                                                </div> 
                                                
                                                @endforeach
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
                                                                <option value="{{$k->desc2}}">{{$k->desc1}} - {{$k->desc2}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
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
                                                </div>
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
                                                <div class="row form-group">
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
                                                </div>
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
                                                    <div class="col-sm-6 ">Tanggal Pengkaitan</div>
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
                                                    <div class="col-sm-6 ">Operator</div>
                                                        <div class="col-sm-6">
                                                            <input type="text" class="form-control" name="opr[]" autocomplete="off" value="{{ trim(Auth::user()->nama_lengkap,' ') }}" style="text-transform:uppercase;" readonly />
                                                        </div>
                                                </div>
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
                                                <div class="row form-group">
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
                                                </div>
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
                                                        <input type="text" class="form-control" name="input_fungsi_k[]" value="{{trim($ken->ket,' ')}}" >
                                                    </div>                                                       
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>
                                     @endif
                                     @endif
                                     @endforeach

                                     

                                    <!--  <div class="row form-group">
                                            @if((strpos(Auth::user()->fungsi, '1001') !== false)||(strpos(Auth::user()->fungsi, '7777') !== false))
                                            @foreach($daftar as $daf)
                                            <div hidden="text" class="col-sm-12" datain-id="{{$daf->no_kredit}}">
                                                <div class="col-sm-6">
                                                    <div class="col-sm-6"><b>Nomor Kredit :</b></div>
                                                    <div class="col-sm-6"> {{$daf->no_kredit}}</div>
                                                </div>
                                            </div>
                                                <div class="col-sm-6"><br>
                                                    <input type="button" class="btn btn-danger" name="aden" value="KOREKSI AGUNAN" />
                                            @endforeach
                                            </div>
                                            @endif
                                        </div>  -->
                                    <!-- <div class="row">
                                            <div class="col-sm-2">
                                                <input type="button" class="btn btn-danger" value="Tambah Jaminan" id="addBerat" />
                                            </div>
                                        </div>
                                        <div class="AlatBerat">

                                    </div> -->
                                </div>
                            </div>
                        </fieldset>

                       
                        <div class="row submitbtn1">
                            <div class="col-sm-12"><br>
                                <button type="submit" class="btn btn-primary" name="simpanbutton">SIMPAN</button>
                                <a href="{{ url('/koreksidata') }}" id="clear-filter" title="Input Nasabah Baru">[Kembali Ke Daftar]</a>
                                <!-- <a href="{{ url('/addnasabah') }}" id="clear-filter" title="Input Nasabah Baru">[Tambah Nasabah Individu]</a>
                                <a href="{{ url('/addnasabahbadan') }}" id="clear-filter" title="Input Nasabah Baru">[Tambah Nasabah Badan Usaha]</a> -->
                           </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
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
                                                 @foreach($prekredit as $pre)
                                                 <div class="row form-group" hidden>
                                                    <div class="col-sm-6"><b>Nomor Nasabah</b></div>
                                                    <div class="col-sm-6">                                        
                                                        <input type="text" class="form-control" name="no_nsb[]" autocomplete="off" style="text-transform:uppercase;" value="{{trim($pre->no_nsb,' ')}}" readonly />
                                                    </div>
                                                </div> 
                                                <div class="row form-group" hidden>
                                                    <div class="col-sm-6">No Kredit:</div>
                                                        <div class="col-sm-6" >
                                                            <input  class="form-control" name="no_kredit[]" autocomplete="off" value="{{trim($pre->no_kredit,' ')}}" readonly />
                                                        </div>
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <div class="col-sm-6">No Mohon:</div>
                                                        <div class="col-sm-6" >
                                                            <input  class="form-control" name="no_mohon[]" autocomplete="off" value="{{trim($pre->no_mohon,' ')}}" readonly />
                                                        </div>
                                                </div>
                                                @endforeach
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
                                                 @foreach($prekredit as $pre)
                                                <div class="row form-group" hidden>
                                                    <div class="col-sm-6"><b>Nomor Nasabah</b></div>
                                                    <div class="col-sm-6">                                        
                                                        <input type="text" class="form-control" name="no_nsb[]" autocomplete="off" style="text-transform:uppercase;" value="{{trim($pre->no_nsb,' ')}}" readonly />
                                                    </div>
                                                </div> 
                                                <div class="row form-group" hidden>
                                                    <div class="col-sm-6">No Kredit:</div>
                                                        <div class="col-sm-6" >
                                                            <input  class="form-control" name="no_kredit[]" autocomplete="off" value="{{trim($pre->no_kredit,' ')}}" readonly />
                                                        </div>
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <div class="col-sm-6">No Mohon:</div>
                                                        <div class="col-sm-6" >
                                                            <input  class="form-control" name="no_mohon[]" autocomplete="off" value="{{trim($pre->no_mohon,' ')}}" readonly />
                                                        </div>
                                                </div>
                                                @endforeach
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
                                                 @foreach($prekredit as $pre)
                                                <div class="row form-group" hidden>
                                                    <div class="col-sm-6"><b>Nomor Nasabah</b></div>
                                                    <div class="col-sm-6">                                        
                                                        <input type="text" class="form-control" name="no_nsb[]" autocomplete="off" style="text-transform:uppercase;" value="{{trim($pre->no_nsb,' ')}}" readonly />
                                                    </div>
                                                </div>  
                                                <div class="row form-group" hidden>
                                                    <div class="col-sm-6">No Kredit:</div>
                                                        <div class="col-sm-6" >
                                                            <input  class="form-control" name="no_kredit[]" autocomplete="off" value="{{trim($pre->no_kredit,' ')}}" readonly />
                                                        </div>
                                                </div>
                                                <div class="row form-group" hidden>
                                                    <div class="col-sm-6">No Mohon:</div>
                                                        <div class="col-sm-6" >
                                                            <input  class="form-control" name="no_mohon[]" autocomplete="off" value="{{trim($pre->no_mohon,' ')}}" readonly />
                                                        </div>
                                                </div>
                                                @endforeach
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
function jumlah(){
//aset
    var kas = parseInt($('[name="input_kas"]').val().split('.').join(""));
    var piutanglancar = parseInt($('[name="input_piutang_usaha_al"]').val().split('.').join(""));
    var inveslancar = parseInt($('[name="input_investasi_lacar"]').val().split('.').join(""));
    var asetlainlancar = parseInt($('[name="input_aset_lancar_lain"]').val().split('.').join(""));
    var asetlancar = parseInt($('[name="input_aset_lancar"]').val().split('.').join(""));

    var piutangtidak = parseInt($('[name="input_piutang_usaha_atl"]').val().split('.').join(""));
    var investidak = parseInt($('[name="input_invest_tdk_lancar"]').val().split('.').join(""));
    var asetlaintidak = parseInt($('[name="input_aset_tdk_lancar_lain"]').val().split('.').join(""));
    var asettdklancar = parseInt($('[name="input_aset_tdk_lancar"]').val().split('.').join(""));

    var aset = parseInt($('[name="input_aset"]').val().split('.').join(""));

    var asetlancar = Math.ceil((kas+piutanglancar+inveslancar+asetlainlancar));
    var asettdklancar = Math.ceil((piutangtidak+investidak+asetlaintidak));
    var aset = Math.ceil((asetlancar+asettdklancar));
    $('[name="input_aset"]').val(aset);
    $('[name="input_aset_lancar"]').val(asetlancar);
    $('[name="input_aset_tdk_lancar"]').val(asettdklancar);

//lia
    var utangpendek = parseInt($('[name="input_utang_usaha_pndk"]').val().split('.').join(""));
    var pinjampendek = parseInt($('[name="input_pinjaman_pndk"]').val().split('.').join(""));
    var lialainpendek = parseInt($('[name="input_lia_pndk_lain"]').val().split('.').join(""));
    var liapendek = parseInt($('[name="input_lia_pndk"]').val().split('.').join(""));

    var utangpanjang = parseInt($('[name="input_utang_usaha_panjang"]').val().split('.').join(""));
    var pinjampanjang = parseInt($('[name="input_pinjaman_pnjng"]').val().split('.').join(""));
    var lialainpanjang = parseInt($('[name="input_lia_panjang_lain"]').val().split('.').join(""));
    var liapanjang = parseInt($('[name="input_lia_pnjng"]').val().split('.').join(""));

    var lia  = parseInt($('[name="input_lia"]').val().split('.').join(""));

    var liapendek = Math.ceil((utangpendek+pinjampendek+lialainpendek));
    var liapanjang = Math.ceil((utangpanjang+pinjampanjang+lialainpanjang));
    var lia = Math.ceil((liapendek+liapanjang));

    $('[name="input_lia_pndk"]').val(liapendek);
    $('[name="input_lia_pnjng"]').val(liapanjang);
    $('[name="input_lia"]').val(lia);
//lainnya
    var pendapatan = parseInt($('[name="input_pendapatan_usaha"]').val().split('.').join(""));
    var beban = parseInt($('[name="input_beban_pokok"]').val().split('.').join(""));
    var bruto = parseInt($('[name="input_labarugi"]').val().split('.').join(""));
    var pendapatanlain = parseInt($('[name="input_pendapatan_lain"]').val().split('.').join(""));
    var bebanlain = parseInt($('[name="input_beban_lain"]').val().split('.').join(""));
    var pajak = parseInt($('[name="input_labarugi_sblmPajak"]').val().split('.').join(""));
    var tahun = parseInt($('[name="input_labarugi_tahun"]').val().split('.').join(""));
    var ekui = parseInt($('[name="input_ekuitas"]').val().split('.').join(""));

    var bruto = Math.ceil((pendapatan-beban));
    var pajak = Math.ceil((bruto+pendapatanlain)-bebanlain);
    var ekui = Math.ceil((aset-lia));

    $('[name="input_labarugi"]').val(bruto);
    $('[name="input_labarugi_sblmPajak"]').val(pajak);
    $('[name="input_ekuitas"]').val(ekui);
}
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
        $("#tahunan").datepicker({ dateFormat: 'dd-mm-yy' });
  
    });
$(document).ready(function() {

     $('[name="input_nilai_taksasi_sert_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_pasar_sert_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_njop_sert_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_ht_sert_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_agunanLJK_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilai_agunan_penilaiIndependent_s[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_nilai_kendaraan_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_taksasi_ken_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_pasar_ken_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="input_nilai_agunanLJK_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilai_agunan_penilaiIndependent_k[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

    $('[name="hapus"]').click(function(){
            if($(this).val() == 'HAPUS BUKU'){
               window.open('{{url("/hapuskredit")}}'+'/'+$(this).parent().parent().find('div:first').attr('data-id'));
            } else if($(this).val() == 'MUTASI AGUNAN'){
                window.open('{{url("/hapusagunan")}}'+'/'+$(this).parent().parent().find('div:first').attr('datain-id'));
            } else if($(this).val() == 'TUKAR AGUNAN'){
                window.open('{{url("/tukaragunan")}}'+'/'+$(this).parent().parent().find('div:first').attr('datain-id'));
            } 

        });

    $('[name="aden"]').click(function(){
            if($(this).val() == 'KOREKSI_KREDIT'){
               window.open('{{url("/addkreditaden")}}'+'/'+$(this).parent().parent().find('div:first').attr('data-id'));
            } else if($(this).val() == 'KOREKSI_AGUNAN'){
                window.open('{{url("/korekagun")}}'+'/'+$(this).parent().parent().find('div:first').attr('dataag-id'));
            } else if($(this).val() == 'KOREKSI_PENJAMIN'){
                window.open('{{url("/addpenjaminaden")}}'+'/'+$(this).parent().parent().find('div:first').attr('datapen-id'));
            } else if($(this).val() == 'KOREKSI PENJAMIN'){
                window.open('{{url("/addpenjaminaden")}}'+'/'+$(this).parent().parent().find('div:first').attr('datain-id'));
            } else if($(this).val() == 'KOREKSI AGUNAN'){
                window.open('{{url("/korekagun")}}'+'/'+$(this).parent().parent().find('div:first').attr('datain-id'));
            } else if($(this).val() == 'KOREKSI LAPORAN KEUANGAN'){
                window.open('{{url("/addlaporan")}}'+'/'+$(this).parent().parent().find('div:first').attr('datain-id'));
            } else if($(this).val() == 'KOREKSI PENGURUS'){
                window.open('{{url("/addpengurusaden")}}'+'/'+$(this).parent().parent().find('div:first').attr('datain-id'));
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
// $("#").datepicker({ dateFormat: 'dd-mm-yy' });
});
</script>
@endsection
