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
            <form class="form-horizontal" id="simpankreditform" role="form" method="POST" action="{{ url('/savehapusagun/$nokredit') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                    <div class="panel-heading"><h4 align="center">MUTASI DATA AGUNAN</h4></div>
                        <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Nomor Nasabah</label>
                                            <div class="col-sm-9">                                        
                                                <input type="text" class="form-control" name="no_nsb" autocomplete="off" style="text-transform:uppercase;" value="{{$prekredit->no_nsb}}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Nomor CIF</label>
                                            <div class="col-sm-9">                                        
                                                <input type="text" class="form-control" name="no_cif" autocomplete="off" style="text-transform:uppercase;" value="{{$prekredit->no_cif}}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row form-group" data-id="{{$kredit->no_kredit}}">
                                            <label class="col-sm-3 control-label">Nomor Kredit</label>
                                            <div class="col-sm-9">                                        
                                                <input type="text" class="form-control" name="no_kredit" autocomplete="off" style="text-transform:uppercase;" value="{{$kredit->no_kredit}}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Nomor NPP</label>
                                            <div class="col-sm-9">                                        
                                                <input type="text" class="form-control" name="no_npp" autocomplete="off" style="text-transform:uppercase;" value="{{$kredit->no_ref}}" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr style="height:2px;border:none;color:#444;background-color:#151B8D;"/>

                            @foreach($agkredit as $ser)
                                   @if(($ser->status == '                                                  ')
                                     ||($ser->status == 'dipinjam                                          ')
                                     ||($ser->status == 'tukar                                             ')
                                     ||($ser->status == 'pengganti                                         ')
                                     ||($ser->status == 'kembali                                           ')
                                     ||($ser->status == '')
                                     ||($ser->status == 'OK                                                '))
                                     @if(($ser->jenis == '1-3            '))
                                <div class="panel-heading"><h4 align="center"><b>AGUNAN SERTIFIKAT</b></h4></div>
                                 <div class="row">
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
                                                    <input type="text" class="form-control" name="tanggal[]" id="tanggal" autocomplete="off" style="text-transform:uppercase;"  placeholder="{{date('d-m-Y')}}" />
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
                                                    <input type="text" class="form-control" name="opr[]" autocomplete="off" style="text-transform:uppercase;" value="{{ Auth::user()->nama_lengkap }}" placeholder="nama petugas" readonly="" />
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
                                 </div>
                                 <!-- <hr style="height:1px;border:none;color:#444;background-color:#FF0000;"/> -->
                                    <div class="row">
                                        <div class="col-sm-12"><br>
                                            <div class="col-sm-3">
                                                <div class="row form-group">
                                                <div class="col-sm-6"><b>Kode Agunan:</b></div>
                                                    <div class="col-sm-6" name='jenis'>{{trim($ser->jenis,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6"><b>Status Agunan:</b></div>
                                                    <div class="col-sm-6" name='jenis'>{{trim($ser->status,' ')}}</div>
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
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Jenis Segmen Fasilitas:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->jenisfas,' ')}}</div>
                                                </div>--}}
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Status Agunan:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->kd_status,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Jenis Agunan:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->jenisagun,' ')}}</div>
                                                </div>
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-6"><b>Peringkat Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ser->peringkat}}
                                                    </div>
                                                </div>--}}
                                            </div>
                                            <div class="col-sm-3">
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-6"><b>Kode Lembaga Pemeringkat:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->lembaga,' ')}}</div>
                                                </div>--}}
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
                                               <!--  <div class="row form-group">
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
                                                    <div class="col-sm-6"><b>Kode Kab/Kota Agunan:</b></div>
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
                                                    <div class="col-sm-6">Rp.{{$ser->niltaksasi}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai Pasar:</b></div>
                                                    <div class="col-sm-6">Rp.{{$ser->nilpasar}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai NJOP:</b></div>
                                                    <div class="col-sm-6">Rp. {{$ser->nilnjop}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai HT:</b></div>
                                                    <div class="col-sm-6">Rp. {{$ser->nilhaktg}}
                                                    </div>
                                                </div>
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai Agunan Menurut LJK:</b></div>
                                                    <div class="col-sm-6">Rp. {{$ser->ljk}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Tanggal Penilaian LJK:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ser->tgl_nilai))}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai Agunan Penilai Independent:</b></div>
                                                    <div class="col-sm-6">Rp. {{$ser->indep}} 
                                                    </div>
                                                </div>--}} 
                                            </div>
                                            <div class="col-sm-3">
                                                                                                             
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-6"><b>Nama Penilai Independent:</b></div>
                                                    <div class="col-sm-6">{{$ser->namaindep}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Tanggal Penilaian Penilai Independent:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ser->tgl_indep))}}
                                                    </div>
                                                </div>--}}
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Status Paripasu:</b></div>
                                                    <div class="col-sm-6">{{trim($ser->paripasu,' ')}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Pesentase Paripasu:</b></div>
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

                            <!-- @foreach($agkredit as $ser)
                                   @if(($ser->status == '                                                  ')
                                     ||($ser->status == 'dipinjam                                          ')
                                     ||($ser->status == 'tukar                                             ')
                                     ||($ser->status == 'pengganti                                         ')
                                     ||($ser->status == 'kembali                                           ')
                                     ||($ser->status == '')
                                     ||($ser->status == 'OK                                                '))
                                    @if(($ser->jenis == '1-3            '))
                                <div class="panel-heading"><h4 align="center"><b>AGUNAN SERTIFIKAT</b></h4></div>
                                 <div class="row">
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
                                                    <input type="text" class="form-control" name="tanggal[]" id="tanggal" autocomplete="off" style="text-transform:uppercase;"  placeholder="{{date('d-m-Y')}}" />
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
                                                    <input type="text" class="form-control" name="opr[]" autocomplete="off" style="text-transform:uppercase;" value="{{ Auth::user()->nama_lengkap }}" placeholder="nama petugas" readonly="" />
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
                                 </div>
                                    <div class="row">
                                        <div class="col-sm-12"><br>
                                            <div class="col-sm-3">
                                                <div class="row form-group">
                                                <div class="col-sm-6"><b>Kode Agunan:</b></div>
                                                    <div class="col-sm-6" name='jenis'>{{trim($ser->jenis,' ')}}</div>
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6"><b>Status Agunan:</b></div>
                                                    <div class="col-sm-6" name='jenis'>{{trim($ser->status,' ')}}</div>
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
                                                    <div class="col-sm-6"><b>Kode Kab/Kota Agunan:</b></div>
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
                                                    <div class="col-sm-6">Rp.{{$ser->niltaksasi}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai Pasar:</b></div>
                                                    <div class="col-sm-6">Rp.{{$ser->nilpasar}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai NJOP:</b></div>
                                                    <div class="col-sm-6">Rp. {{$ser->nilnjop}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai HT:</b></div>
                                                    <div class="col-sm-6">Rp. {{$ser->nilhaktg}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai Agunan Menurut LJK:</b></div>
                                                    <div class="col-sm-6">Rp. {{$ser->ljk}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Tanggal Penilaian LJK:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ser->tgl_nilai))}}</div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6"><b>Nilai Agunan Penilai Independent:</b></div>
                                                    <div class="col-sm-6">Rp. {{$ser->indep}} 
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
                                                    <div class="col-sm-6"><b>Pesentase Paripasu:</b></div>
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
 -->
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
                                <div class="panel-heading"><h4 align="center"><b>AGUNAN KENDARAAN</b></h4></div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <!-- <input type="checkbox" id="jual" ng-model="jual"/><b>JUAL AGUNAN</b><br> -->
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <div class="pilihan">
                                            </div>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="input_status[]" >
                                                        <option replace>{{($ken->status)}}</option>
                                                        <option value >-Pilih Status Mutasi Agunan-</option>
                                                        <option value="dipinjam">Dipinjam</option>
                                                        <option value="tukar">Tukar</option>
                                                        <!-- <option value="pengganti">Pengganti</option> -->
                                                        <option value="keluar">Keluar</option>
                                                        <option value="kembali">Kembali</option>
                                                        <option value="hapus">Hapus</option>
                                                        <option value="jual" >Jual</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="tanggal[]" id="tanggal" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="{{date('d-m-Y')}}" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nomor surat</label>
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
                                                    <input type="text" class="form-control" name="opr[]" autocomplete="off" style="text-transform:uppercase;" value="{{ Auth::user()->nama_lengkap }}" placeholder="nama petugas" readonly="" />
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
                                                        <input type="text" class="form-control" name="nm_aju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama pengaju"  readonly />
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
                                                        <input type="text" class="form-control" name="nm_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama penyutuju" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Persetujuan</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Jual</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_jual[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly/>
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
                                                {{--<div class="row form-group">
                                                    <div class="col-sm-5 "><b>Nilai Agunan Menurut LJK</b></div>
                                                    <div colspan=1 class="col-sm-5">: Rp.{{$ken->ljk}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-5 "><b>Tanggal Penilaian LJK</b></div>
                                                    <div colspan=1 class="col-sm-5">: {{date('d-m-Y',strtotime($ken->tgl_nilai))}}
                                                    </div>
                                                </div>--}}
                                            <!-- </div>
                                            <div class="col-sm-3"> -->
                                                
                                                
                                                {{--<div class="row form-group">
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
                                                </div>--}}
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
                                    @if(($ken->jenis == '1-2            ')
                                     ||($ken->jenis == '1-1            ')
                                     ||($ken->jenis == '1-4            ')
                                     ||($ken->jenis == '1-5            ')
                                     ||($ken->jenis == '1-6            '))
                                <div class="panel-heading"><h4 align="center"><b>AGUNAN KENDARAAN</b></h4></div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <div class="pilihan">
                                            </div>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="input_status[]" >
                                                        <option replace>{{($ken->status)}}</option>
                                                        <option value >-Pilih Status Mutasi Agunan-</option>
                                                        <option value="dipinjam">Dipinjam</option>
                                                        <option value="tukar">Tukar</option>
                                                        <option value="keluar">Keluar</option>
                                                        <option value="kembali">Kembali</option>
                                                        <option value="hapus">Hapus</option>
                                                        <option value="jual" >Jual</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="tanggal[]" id="tanggal" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="{{date('d-m-Y')}}" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nomor surat</label>
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
                                                    <input type="text" class="form-control" name="opr[]" autocomplete="off" style="text-transform:uppercase;" value="{{ Auth::user()->nama_lengkap }}" placeholder="nama petugas" readonly="" />
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
                                                        <input type="text" class="form-control" name="nm_aju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama pengaju"  readonly />
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
                                                        <input type="text" class="form-control" name="nm_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama penyutuju" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Persetujuan</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Jual</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_jual[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly/>
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
                                                <div class="col-sm-6 "><b>Kode Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ken->jenis}}
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6 "><b>Status Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ken->status}}
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
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tahun:</b></div>
                                                    <div class="col-sm-6">{{$ken->tahun}}
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <div class="col-sm-3">                                               
                                                
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
                                                    <div class="col-sm-6">Rp.{{$ken->nilai}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Taksasi:</b></div>
                                                    <div class="col-sm-6">Rp.{{$ken->niltaksasi}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Pasar:</b></div>
                                                    <div class="col-sm-6">Rp.{{$ken->nilpasar}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Agunan Menurut LJK:</b></div>
                                                    <div class="col-sm-6">Rp.{{$ken->ljk}}
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
                                                    <div class="col-sm-6">Rp.{{$ken->indep}}
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
                                                    <div class="col-sm-6 "><b>Pesentase Paripasu:</b></div>
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

                             @foreach($agkredit as $ken)
                                @if(($ken->status == '                                                  ')
                                     ||($ken->status == 'dipinjam                                          ')
                                     ||($ken->status == 'tukar                                             ')
                                     ||($ken->status == 'pengganti                                         ')
                                     ||($ken->status == 'kembali                                           ')
                                     ||($ken->status == '')
                                     ||($ken->status == 'OK                                                '))
                                 @if(($ken->jenis == '1-7            '))
                                 <div class="panel-heading"><h4 align="center"><b>AGUNAN ALAT BERAT</b></h4></div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <!-- <input type="checkbox" id="jual" ng-model="jual"/><b>JUAL AGUNAN</b><br> -->
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <div class="pilihan">
                                            </div>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="input_status[]" >
                                                        <option replace>{{($ken->status)}}</option>
                                                        <option value >-Pilih Status Mutasi Agunan-</option>
                                                        <option value="dipinjam">Dipinjam</option>
                                                        <option value="tukar">Tukar</option>
                                                        <!-- <option value="pengganti">Pengganti</option> -->
                                                        <option value="keluar">Keluar</option>
                                                        <option value="kembali">Kembali</option>
                                                        <option value="hapus">Hapus</option>
                                                        <option value="jual" >Jual</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="tanggal[]" id="tanggal" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="{{date('d-m-Y')}}" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nomor surat</label>
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
                                                    <input type="text" class="form-control" name="opr[]" autocomplete="off" style="text-transform:uppercase;" value="{{ Auth::user()->nama_lengkap }}" placeholder="nama petugas" readonly="" />
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
                                                        <input type="text" class="form-control" name="nm_aju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama pengaju"  readonly />
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
                                                        <input type="text" class="form-control" name="nm_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama penyutuju" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Persetujuan</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Jual</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_jual[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly/>
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
                                                
                                               
                                                {{--<div class="row form-group">
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
                                                </div>--}}
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

                          <!--  @foreach($agkredit as $ken)
                                    @if(($ken->status == '                                                  ')
                                     ||($ken->status == 'dipinjam                                          ')
                                     ||($ken->status == 'tukar                                             ')
                                     ||($ken->status == 'pengganti                                         ')
                                     ||($ken->status == 'kembali                                           ')
                                     ||($ken->status == '')
                                     ||($ken->status == 'OK                                                '))
                                     @if(($ken->jenis == '1-7            '))
                                 <div class="panel-heading"><h4 align="center"><b>AGUNAN ALAT BERAT</b></h4></div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                        </div>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
                                            <div class="pilihan">
                                            </div>
                                                <div class="col-sm-12">
                                                    <select class="form-control" name="input_status[]" >
                                                        <option replace>{{($ken->status)}}</option>
                                                        <option value >-Pilih Status Mutasi Agunan-</option>
                                                        <option value="dipinjam">Dipinjam</option>
                                                        <option value="tukar">Tukar</option>
                                                        <option value="keluar">Keluar</option>
                                                        <option value="kembali">Kembali</option>
                                                        <option value="hapus">Hapus</option>
                                                        <option value="jual" >Jual</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="col-sm-4" >
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Tanggal</label>
                                                <div class="col-sm-9">                                        
                                                    <input type="text" class="form-control" name="tanggal[]" id="tanggal" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="{{date('d-m-Y')}}" />
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                    <label class="col-sm-3 control-label">Nomor surat</label>
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
                                                    <input type="text" class="form-control" name="opr[]" autocomplete="off" style="text-transform:uppercase;" value="{{ Auth::user()->nama_lengkap }}" placeholder="nama petugas" readonly="" />
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
                                                        <input type="text" class="form-control" name="nm_aju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama pengaju"  readonly />
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
                                                        <input type="text" class="form-control" name="nm_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="" placeholder="nama penyutuju" readonly/>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Persetujuan</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_setuju[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                        <label class="col-sm-3 control-label">Harga Jual</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">   
                                                            <span class="input-group-addon">Rp.</span>                                     
                                                            <input type="text" class="form-control" name="hrg_jual[]" autocomplete="off" style="text-transform:uppercase;" value="0" placeholder="0" readonly/>
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
                                                <div class="col-sm-6 "><b>Kode Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ken->jenis}}
                                                    </div>                                    
                                                </div>
                                                <div class="row form-group">
                                                <div class="col-sm-6 "><b>Status Agunan:</b></div>
                                                    <div class="col-sm-6">{{$ken->status}}
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
                                                    <div class="col-sm-6 "><b>Nomor SERI:</b></div>
                                                    <div class="col-sm-6">{{$ken->nobpkb}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Kendaraan:</b></div>
                                                    <div class="col-sm-6">Rp.{{$ken->nilai}}
                                                    </div>
                                                </div>                                     
                                            </div>
                                            <div class="col-sm-3">                                               
                                                
                                                
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Taksasi:</b></div>
                                                    <div class="col-sm-6">Rp.{{$ken->niltaksasi}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Pasar:</b></div>
                                                    <div class="col-sm-6">Rp.{{$ken->nilpasar}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Agunan Menurut LJK:</b></div>
                                                    <div class="col-sm-6">Rp.{{$ken->ljk}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Tanggal Penilaian LJK:</b></div>
                                                    <div class="col-sm-6">{{date('d-m-Y',strtotime($ken->tgl_nilai))}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Nilai Agunan Penilai Independent:</b></div>
                                                    <div class="col-sm-6">Rp.{{$ken->indep}}
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
                                            </div>
                                            <div class="col-sm-3">
                                                
                                                
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Status Paripasu:</b></div>
                                                    <div class="col-sm-6">{{$ken->paripasu}}
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <div class="col-sm-6 "><b>Pesentase Paripasu:</b></div>
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

                                        <div class="row form-group">
                                            <div hidden="text" class="col-sm-12" data-id="{{$kredit->no_kredit}}">
                                                <div class="col-sm-6">
                                                    <div class="col-sm-6"><b>Nomor Kredit :</b></div>
                                                    <div class="col-sm-6"> {{$kredit->no_kredit}}</div>
                                                </div>
                                            </div>
                                                <div class="col-sm-6"><br>
                                                <input type="button" class="btn btn-warning" name="hapus" value="TAMBAH AGUNAN PENGGANTI">
                                               
                                            </div>
                                        </div> 
                            <div class="row submitbtn1">
                                <div class="col-sm-12">
                                    <button type="submit" id="simpandata" class="btn btn-primary" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">SIMPAN</button>
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
    $(document).ready(function() {
        $('[name="hapus"]').click(function(){
           if($(this).val() == 'TAMBAH AGUNAN PENGGANTI'){
                window.open('{{url("/tukaragunan")}}'+'/'+$(this).parent().parent().find('div:first').attr('data-id'));
            } 

        });
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


        $("#tanggal").datepicker({ dateFormat: 'dd-mm-yy' });
        // $('[name="tanggal[]"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
    });

</script>
@endsection
