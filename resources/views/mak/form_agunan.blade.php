@extends('layouts.appmak')

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
            <form class="form-horizontal" id="simpanform" role="form" method="POST" action="{{ url('/saveagunan/$nomak') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelkredit">
                    <div class="panel-heading"><h4 align="center">LAPORAN HASIL PENILAIAN AGUNAN</h4></div>
                    <div class="panel-body nav-tabs-animate">
                        <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                            <li role="presentation"><a data-toggle="tab" href="#tabungan" aria-controls="tabungan" role="tab">TABUNGAN/DEPOSITO</a><i class="fa"></i></li>
                            <li role="presentation"><a data-toggle="tab" href="#tanah" aria-controls="tanah" role="tab">PROPERTI (TANAH DAN BANGUNAN)</a><i class="fa"></i></li>
                            <li role="presentation"><a data-toggle="tab" href="#motor" aria-controls="motor" role="tab">KENDARAAN BERMOTOR</a><i class="fa"></i></li>
                            <li role="presentation"><a data-toggle="tab" href="#logam" aria-controls="logam" role="tab">LOGAM MULIA</a><i class="fa"></i></li>                            
                        </ul>
                        <div class="row"><br>
                            <div class="col-sm-12">
                                <div class="col-sm-6">
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Tanggal</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" name="input_tanggal_mohon" id="tanggalmohon" value="{{date('d-m-Y')}}" readonly>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Nama Debitur</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="nama_deb" autocomplete="off" value="" style="text-transform:uppercase;" readonly />
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Nama Kantor Cabang/Kas</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="kantor" autocomplete="off" value="" style="text-transform:uppercase;" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Operator</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="opr" autocomplete="off" value="{{ trim(Auth::user()->nama_lengkap,' ') }}" style="text-transform:uppercase;" readonly />
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Tanggal Pengisian</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="tgl_isi" autocomplete="off" value="" style="text-transform:uppercase;" readonly />
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">No. Memo</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="no_memo" autocomplete="off" value="" style="text-transform:uppercase;" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="tab-content">
                                <fieldset class="tab-pane animation-slide-left" id="tabungan" role="tabpanel">
                                    <div class="panel panel-bordered">
                                        <div class="panel-heading text-center">
                                            <h4 class="panel-title">RINCIAN AGUNAN TABUNGAN/DEPOSITO (Khusus Pinjaman Back to Back)</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row form-group">
                                                    <label class="col-sm-4 control-label">Cash Cover</label>
                                                        <div class="col-sm-8">
                                                            <select class="form-control" name="cover" data-toggle="tooltip" data-placement="right" title="" required>
                                                                <option value >-Pilih-</option>
                                                                <option value="100">100% Covered</option>
                                                            </select>
                                                        </div>
                                                </div>
                                            </div>
                                            </div>
                                            <div class="tambah_tab">
                                                <div class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add_tab"><i class="glyphicon glyphicon-plus"></i>Tambah Tabungan</button>
                                                </div>
                                            </div>
                                            <div id="tambah_tab" data-op="tambah_tab" hidden>
                                                <div class="row"><br>
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-6">
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nama Pemilik</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="nama_tab[]" placeholder="NAMA" value="" data-toggle="tooltip" data-placement="right" title="Nama Debitur / Calon Debitur:  Isi dengan format 'Nama' contoh : Dwi Tjahjono" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Jenis Rekening</label>
                                                                    <div class="col-sm-8">
                                                                        <select class="form-control" name="jenis_tab[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                                            <option value >-Pilih Jenis Rekening-</option>
                                                                            @foreach($jenisrek as $b)  
                                                                                <option value="{{$b->kode}}">{{$b->kode}} - {{$b->nama}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nomor Rekening</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="no_rek[]" placeholder="0" value="" data-toggle="tooltip" data-placement="right" title="Disi dengan format angka" >
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nomor Bilyet</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="bilyet[]" value="" placeholder="0" data-toggle="tooltip" data-placement="right" title="Disi dengan format angka" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Saldo (Rp)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="saldo[]" value="" maxlength="35" placeholder="0" data-toggle="tooltip" data-placement="right" title="Disi dengan format angka maksimal 35 karakter" >
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="input-group-btn"> 
                                                            <button class="btn btn-danger" name="hapus_tab" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus Tabungan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="tab-pane animation-slide-left" id="tanah" role="tabpanel">
                                    <div class="panel panel-bordered">
                                        <div class="panel-heading text-center">
                                          <h4 class="panel-title">RINCIAN PROPERTI (TANAH DAN BANGUNAN)</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="tambah">
                                                <div class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add"><i class="glyphicon glyphicon-plus"></i>Tambah Properti</button>
                                                </div>
                                            </div>
                                            <div id="tambah" data-op="tambah" hidden>
                                                <div class="row"><br>
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-6">
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Jenis Properti</label>
                                                                    <div class="col-sm-8">
                                                                        <select class="form-control" name="jenis[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                                            <option value >-Pilih Jenis Properti-</option>
                                                                            @foreach($jenispro as $b)  
                                                                                <option value="{{$b->kode}}">{{$b->kode}} - {{$b->nama}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Jenis Kepemilikan</label>
                                                                    <div class="col-sm-3">
                                                                        <select class="form-control" name="milik[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                                            <option value >-Pilih-</option>
                                                                            @foreach($jenismilik as $b)  
                                                                                <option value="{{$b->kode}}">{{$b->kode}} - {{$b->nama}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <label class="col-sm-2 control-label">No</label>
                                                                    <div class="col-sm-3">
                                                                        <input type="text" class="form-control" name="no_milik[]" placeholder="NOMOR" value="" data-toggle="tooltip" data-placement="right" title="No. Bukti Kepemilikan" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Lokasi (Dusun/Jalan)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="lokasi[]" value="" data-toggle="tooltip" data-placement="right" title="" placeholder="LOKASI" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Kel/Kec/Kabupaten</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="dati[]" value="" data-toggle="tooltip" data-placement="right" title="" placeholder="KEL/KEC/KAB" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Luas Tanah (m2)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="luas_tanah[]" value="" data-toggle="tooltip" data-placement="right" title="" placeholder="0" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Harga Tanah/m2 (Rp)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="hargatanah[]" value="" placeholder="0" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Luas Bangunan (m2)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="luas_bangun[]" value="" placeholder="0" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Harga Bangunan/m2 (Rp)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="hargabangunan[]" value="" placeholder="0" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nama Pemilik</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="nama_pemilik[]" value="" placeholder="NAMA PEMILIK" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Tanggal Penilaian/Penilai</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="tgl_nilai[]" value="" placeholder="dd-mm-yyyy" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nilai Pasar (Rp)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="nilpasar[]" value="" placeholder="0" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nilai Likuiditas (Rp)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="nilliki[]" value="" placeholder="0" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nilai Pengikatan (Rp)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="nilikat[]" value="" placeholder="0" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Asuransi</label>
                                                                    <div class="col-sm-8">
                                                                        <select class="form-control" name="asu[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                                            <option value >-Pilih Asuransi-</option>
                                                                            @foreach($yatidak as $m)  
                                                                                <option value="{{$m->kode}}">{{$m->kode}} - {{$m->Keterangan}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Kondisi Jalan</label>
                                                                    <div class="col-sm-8">
                                                                        <select class="form-control" name="konjln[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                                            <option value >-Pilih Kondisi Jalan-</option>
                                                                            @foreach($jalan as $m)  
                                                                                <option value="{{$m->kode}}">{{$m->kode}} - {{$m->keterangan}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Kualitas Agunan</label>
                                                                    <div class="col-sm-8">
                                                                        <select class="form-control" name="kualitas[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                                            <option value >-Pilih Kualitas Agunan-</option>
                                                                            @foreach($agunan as $m)  
                                                                                <option value="{{$m->kode}}">{{$m->kode}} - {{$m->keterangan}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">Upload Foto Depan</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Tampak Depan</span>
                                                                        <input type="file" class="form-control-file" name="depan">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">Upload Foto Belakang</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Tampak Belakang</span>
                                                                        <input type="file" class="form-control-file" name="belakang">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">Upload Foto Samping Kanan</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Tampak Samping Kanan</span>
                                                                        <input type="file" class="form-control-file" name="kanan">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">Upload Foto Samping Kiri</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Tampak Samping Kiri</span>
                                                                        <input type="file" class="form-control-file" name="kiri">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">Upload Foto Agunan dan Nasabah</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Agunan dan Nasabah</span>
                                                                        <input type="file" class="form-control-file" name="agundeb">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="row form-group">
                                                            <label class="col-sm-4 control-label">Penjaminan Fasilitas</label>
                                                                <div class="col-sm-8">
                                                                    <table>
                                                                        <thead>
                                                                            <th>Valid</th>
                                                                            <th>Fas 1</th>
                                                                            <th>Fas 2</th>
                                                                            <th>Fas 3</th>
                                                                            <th>Fas 4</th>
                                                                        </thead>
                                                                            <td>100%</td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                    </table>
                                                                </div>
                                                        </div>
                                                        <div class="input-group-btn"> 
                                                            <button class="btn btn-danger" name="hapus" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus Properti</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row form-group">
                                                        <label class="col-sm-4 control-label">Total Nilai Pasar (Rp)</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="total_pasar_tanah" readonly placeholder="-" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                            </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-sm-4 control-label">Total Nilai Likuiditasi (Rp)</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="total_likuiditasi_tanah" readonly placeholder="-" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                            </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-sm-4 control-label">Total Nilai Pengikatan (Rp)</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="total_pengikatan_tanah" readonly placeholder="-" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button class="btn btn-success" name="hitung_tanah" style="height: 148px; width: 148px" )">HITUNG</button>
                                                    <button class="btn btn-danger" name="kosong_tanah" style="height: 148px; width: 148px" )">KOSONGKAN</button>
                                                </div>
                                            </div>
                                            <br><br>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="tab-pane animation-slide-left" id="motor" role="tabpanel">
                                    <div class="panel panel-bordered">
                                        <div class="panel-heading text-center">
                                          <h4 class="panel-title">RINCIAN AGUNAN KENDARAAN BERMOTOR</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="tambah_kendaraan">
                                                <div class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add_kendaraan"><i class="glyphicon glyphicon-plus"></i>Tambah Kendaraan</button>
                                                </div>
                                            </div>
                                            <div id="tambah_kendaraan" data-op="tambah_kendaraan" hidden>
                                                <div class="row"><br>
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-6">
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nama STNK</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="nama_stnk[]" value="" placeholder="STNK" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nomor Polisi</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="nopol[]" value="" placeholder="NOPOL" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Daerah/ Wilayah</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="wilayah[]" value="" placeholder="DAERAH/WILAYAH" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nomor Rangka</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="rangka[]" value="" placeholder="NOMOR RANGKA" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nomor Mesin</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="mesin[]" value="" placeholder="NOMOR MESIN" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nomor STNK</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="stnk[]" value="" placeholder="NOMOR STNK" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nomor BPKB</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="bpkb[]" value="" placeholder="NOMOR BPKB" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Tahun/Warna</label>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control" name="tahun[]" placeholder="TAHUN" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <input type="text" class="form-control" name="warna[]" placeholder="WARNA" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Jenis/Merk/Type</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="jenis_kend[]" value="" placeholder="JENIS/MERK/TYPE" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Tanggal Penilaian/Penilai</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="tgl_nilai_kend[]" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nilai Pasar (Rp)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="nilpasar_kend[]" value=""  placeholder ="0" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nilai Likuiditas (Rp)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="nilliki_kend[]" value="" placeholder="0" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nilai Pengikatan (Rp)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="nilikat_kend[]" value="" placeholder="0" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Data Pembanding</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="banding[]" value="" placeholder="DATA PEMBANDING" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Asuransi</label>
                                                                    <div class="col-sm-8">
                                                                        <select class="form-control" name="asu_kend[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                                            <option value >-Pilih Asuransi-</option>
                                                                            @foreach($yatidak as $m)  
                                                                                <option value="{{$m->kode}}">{{$m->kode}} - {{$m->Keterangan}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Kualitas Agunan</label>
                                                                    <div class="col-sm-8">
                                                                        <select class="form-control" name="agunan_kend[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                                            <option value >-Pilih Kualitas Agunan-</option>
                                                                            @foreach($agunan as $m)  
                                                                                <option value="{{$m->kode}}">{{$m->kode}} - {{$m->keterangan}}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">Upload Foto Depan</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Tampak Depan</span>
                                                                        <input type="file" class="form-control-file" name="depan_kend[]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">Upload Foto Belakang</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Tampak Belakang</span>
                                                                        <input type="file" class="form-control-file" name="belakang_kend[]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">Upload Foto Samping Kanan</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Tampak Samping Kanan</span>
                                                                        <input type="file" class="form-control-file" name="kanan_kend[]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">Upload Foto Samping Kiri</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Tampak Samping Kiri</span>
                                                                        <input type="file" class="form-control-file" name="kiri_kend[]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-4 control-label">Upload Foto Agunan dan Nasabah</label>
                                                                <div class="col-sm-8">
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">Agunan dan Nasabah</span>
                                                                        <input type="file" class="form-control-file" name="agundeb_kend[]">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-6">
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="row form-group">
                                                            <label class="col-sm-4 control-label">Penjaminan Fasilitas</label>
                                                                <div class="col-sm-8">
                                                                    <table>
                                                                        <thead>
                                                                            <th>Valid</th>
                                                                            <th>Fas 1</th>
                                                                            <th>Fas 2</th>
                                                                            <th>Fas 3</th>
                                                                            <th>Fas 4</th>
                                                                        </thead>
                                                                            <td>100%</td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                    </table>
                                                                </div>
                                                        </div>
                                                        <div class="input-group-btn"> 
                                                            <button class="btn btn-danger" name="hapus_kendaraan" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus Kendaraan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row form-group">
                                                        <label class="col-sm-4 control-label">Total Nilai Pasar (Rp)</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="total_pasar_motor" readonly placeholder="-" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                            </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-sm-4 control-label">Total Nilai Likuiditasi (Rp)</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="total_likuiditasi_motor" readonly placeholder="-" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                            </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-sm-4 control-label">Total Nilai Pengikatan (Rp)</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="total_pengikatan_motor" readonly placeholder="-" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button class="btn btn-success" name="hitung_motor" style="height: 148px; width: 148px" )">HITUNG</button>
                                                    <button class="btn btn-danger" name="kosong_motor" style="height: 148px; width: 148px" )">KOSONGKAN</button>
                                                </div>
                                            </div>
                                            <br><br>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="tab-pane animation-slide-left" id="logam" role="tabpanel">
                                    <div class="panel panel-bordered">
                                        <div class="panel-heading text-center">
                                          <h4 class="panel-title">RINCIAN AGUNAN LOGAM MULIA/EMAS</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="tambah_logam">
                                                <div class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add_logam"><i class="glyphicon glyphicon-plus"></i>Tambah Logam</button>
                                                </div>
                                            </div>
                                            <div id="tambah_logam" data-op="tambah_logam" hidden>
                                                <div class="row"><br>
                                                    <div class="col-sm-12">
                                                        <div class="col-sm-6">
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Jenis Agunan</label>
                                                                    <div class="col-sm-8">
                                                                        <!-- <select class="form-control" name="jenis_logam[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                                            <option value >-Pilih Jenis Agunan-</option>
                                                                        </select> -->
                                                                        <input type="text" class="form-control" name="jenis_logam[]" placeholder="JENIS" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nama Pemilik</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="nama_logam[]" placeholder="NAMA PEMILIK" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Bukti Kepimilikan</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="bukti_logam[]" placeholder="BUKTI KEPEMILIKAN" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Berat</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="berat[]" placeholder="0" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Kadar</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="kadar[]" placeholder="0" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nilai Pasar (Rp)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="nilpasar_logam[]" placeholder="0" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <label class="col-sm-4 control-label">Nilai Likuiditas (Rp)</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control" name="nilliki_logam[]" placeholder="0" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="row form-group">
                                                            <label class="col-sm-4 control-label">Penjaminan Fasilitas</label>
                                                                <div class="col-sm-8">
                                                                    <table>
                                                                        <thead>
                                                                            <th>Valid</th>
                                                                            <th>Fas 1</th>
                                                                            <th>Fas 2</th>
                                                                            <th>Fas 3</th>
                                                                            <th>Fas 4</th>
                                                                        </thead>
                                                                            <td>100%</td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                            <td></td>
                                                                    </table>
                                                                </div>
                                                        </div>
                                                        <div class="input-group-btn"> 
                                                            <button class="btn btn-danger" name="hapus_logam" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus Logam</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="row form-group">
                                                        <label class="col-sm-4 control-label">Total Nilai Pasar (Rp)</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="total_pasar_logam" readonly placeholder="-" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                            </div>
                                                    </div>
                                                    <div class="row form-group">
                                                        <label class="col-sm-4 control-label">Total Nilai Likuiditasi (Rp)</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" name="total_likuiditasi_logam" readonly placeholder="-" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                            </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <button class="btn btn-success" name="hitung_logam" style="height: 80px; width: 120px" )">HITUNG</button>
                                                    <button class="btn btn-danger" name="kosong_logam" style="height: 80px; width: 120px" )">KOSONGKAN</button>
                                                </div>
                                            </div>
                                            <br><br>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="row submitbtn1">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">SIMPAN</button>
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
       $('#add').click(function(){
            var $template = $('#tambah'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                .appendTo('.tambah');

             $('[name="hargatanah[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
             $('[name="hargabangunan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
             $('[name="nilpasar[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
             $('[name="nilliki[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
             $('[name="nilikat[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

             $('[name="tgl_nilai[]"]').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});

             $('[name="total_pasar_tanah"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
             $('[name="total_likuiditasi_tanah"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
             $('[name="total_pengikatan_tanah"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

             $('[name="hapus"]').on('click',function(){
                $(this).closest("div.row").remove();
                    e.preventDefault();
            });
        });

        $('#add_kendaraan').click(function(){
            var $template = $('#tambah_kendaraan'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                .appendTo('.tambah_kendaraan');

            $('[name="tgl_nilai_kend[]"]').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});

            $('[name="nilpasar_kend[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilliki_kend[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilikat_kend[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="total_pasar_motor"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="total_likuiditasi_motor"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="total_pengikatan_motor"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
                                
             $('[name="hapus_kendaraan"]').on('click',function(){
                $(this).closest("div.row").remove();
                    e.preventDefault();
            });
        });

        $('#add_logam').click(function(){
            var $template = $('#tambah_logam'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                .appendTo('.tambah_logam');

            $('[name="nilpasar_logam[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="nilliki_logam[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="total_pasar_logam"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="total_likuiditasi_logam"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

             $('[name="hapus_logam"]').on('click',function(){
                $(this).closest("div.row").remove();
                    e.preventDefault();
            });
        });

        $('#add_tab').click(function(){
            var $template = $('#tambah_tab'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                .appendTo('.tambah_tab');

            $('[name="saldo[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

             $('[name="hapus_tab"]').on('click',function(){
                $(this).closest("div.row").remove();
                    e.preventDefault();
            });
        });

    });
</script>
@endsection
