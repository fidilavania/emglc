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
            <form class="form-horizontal" id="simpanform" role="form" method="POST" action="{{ url('/savemenu/$nomak') }}" >
                <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <div class="panel panel-primary" id="panelnasabah">
                    <div class="panel-heading"><h4 align="center">MENU UTAMA</h4></div>
                    <div class="panel-body nav-tabs-animate">
                        <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                            <li class="active" role="presentation"><a data-toggle="tab" href="#memo" aria-controls="memo" role="tab">MEMO</a><i class="fa"></i></li>
                            <li role="presentation"><a data-toggle="tab" href="#debitur" aria-controls="debitur" role="tab">DEBITUR</a><i class="fa"></i></li>
                            <li role="presentation"><a data-toggle="tab" href="#uang" aria-controls="uang" role="tab">DATA KEUANGAN</a><i class="fa"></i></li>
                            <li role="presentation"><a data-toggle="tab" href="#managemen" aria-controls="managemen" role="tab">MANAGEMENT</a><i class="fa"></i></li>
                            <li role="presentation"><a data-toggle="tab" href="#aktif" aria-controls="aktif" role="tab">AKTIFITAS</a><i class="fa"></i></li> 
                        </ul>
                        <div class="row"><br>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Tanggal</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="input_tanggal_mohon" id="tanggalmohon" value="{{date('d-m-Y')}}" readonly>
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
                            </div>
                        </div>
                        <div class="tab-content">
                        <fieldset class="tab-pane active animation-slide-left" id="memo" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Jenis Memo Kredit</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="memo" value="" style="text-transform:uppercase;" placeholder="" data-toggle="tooltip" data-placement="right" title="" />
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Tanggal Memo Sekarang</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" name="input_tanggal_mohon" id="tanggalmohon" value="{{date('d-m-Y')}}" data-toggle="tooltip" data-placement="right" title="Kolom ini akan diisi secara otomatis oleh komputer" readonly>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Tanggal Memo Sebelum</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" name="tglmemodulu" id="tanggalmohon" value="{{date('d-m-Y')}}" data-toggle="tooltip" data-placement="right" title="Isi dengan format Tanggal dd-mm-yyyy" >
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Tujuan Permohonan Kredit</label>
                                        <div class="col-sm-8">
                                          <textarea rows="8" cols="70" name="tujuan" value="" placeholder="Isi Tujuan" style="text-transform: uppercase; margin: 0px; height: 83px; width: 913px;" data-toggle="tooltip" data-placement="right" title=""></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Nama Kantor Pusat/Cabang</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="namakantor" data-toggle="tooltip" data-placement="right" title="Nama Kantor Cabang / Kas:Isi dengan format 'Wilayah / Nama Kota Masing - masing Kantor'contoh : Malang, Kediri, Blitar, Gresik, Jember, Banyuwangi, dll">
                                                <option value >-Pilih Nama UB-</option>
                                                    @foreach($kantor as $kan)  
                                                        <option value="{{$kan->kode_induk}}-{{$kan->kode_kantor}}">{{$kan->nama}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">No Memo</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="no_memo" value="" data-toggle="tooltip" data-placement="right" title="No MAK: Isi dengan format huruf dan angka sesuai dengan format yang berlaku di BPR masing masing" >
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <!-- <div class="tab-pane animation-slide-left" role="tabpanel" id="debitur">
                                <div class="col-sm-12" align="right">
                                    <button type="submit" class="btn btn-primary" name="next"  >SELANJUTNYA >> </button>
                                </div>
                            </div> -->
                        </fieldset>
                        <fieldset class="tab-pane animation-slide-left" id="debitur" role="tabpanel">
                            <div class="panel-primary"><h4 align="center">Data Debitur</h4></div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Nama Debitur</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="nama" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Badan Hukum Debitur</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="badan" data-toggle="tooltip" data-placement="right" title="" required>
                                                <option value >-Pilih Nama Badan Hukum Debitur-</option>
                                                    @foreach($badanhukum as $b)  
                                                        <option value="{{$b->kode}}">{{$b->nama}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">No KTP (Deb/Calon Deb)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="ktp" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Jenis Usaha</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="usaha" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Pekerjaan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="pekerjaan" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Alamat KTP</label><br>
                                            <div class="col-sm-8">
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Nama Jalan/Dusun</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="dusun_ktp" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Kelurahan / Kecamatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="lurah_ktp" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Kota/Kode Pos</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="kota_ktp" placeholder="ISI KOTA" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="pos_ktp" placeholder="ISI KODEPOS" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Idem Alamat KTP</label><br>
                                            <div class="col-sm-8">
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Alamat Usaha</label><br>
                                            <div class="col-sm-8">
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Nama Jalan/Dusun</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="dusun_usaha" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Kelurahan / Kecamatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="lurah_usaha" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Kota/Kode Pos</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="kota_usaha" placeholder="ISI KOTA" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="pos_usaha" placeholder="ISI KODEPOS" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">No Rekening Dana BPR</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="norek" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Status Perkawinan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="kawin" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Nama Pasangan/Orang Tua</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="pasangan" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">No KTP Pasangan/ Orang Tua</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="ktp_pasangan" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Menjadi Debitur Sejak</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="sejak" data-toggle="tooltip" data-placement="right" title="" required>
                                                    <option value >-Pilih-</option>
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="tanggal_deb" placeholder="ISI TANGGAL" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Aktivitas Rekening Pinjaman</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="aktivitas" data-toggle="tooltip" data-placement="right" title="" required>
                                                    <option value >-Pilih Aktifitas Rekening Pinjaman-</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Nama AO</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="ao" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Referensi fee Marketing</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="ref" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Perekomendasi</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="rekom" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Nama Perekomendasi</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="nama_rekom" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-primary"><h4 align="center">Group Exposure (Dalam Rp)</h4></div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered" name="daftarnasabahtable">
                                        <thead>
                                            <th></th>
                                            <th>Nama</th>
                                            <th>Jenis Fasilitas</th>
                                            <th>Baki Debet (Rp.)</th>
                                            <th>Suku Bunga (%)</th>
                                            <th>Jangka Waktu (Bulan)</th>
                                        </thead>
                                        <tbody class="tambahgroup">
                                            <tr class="row">
                                                <td><input type="text" class="form-control" name="nama_groub[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><select class="form-control" name="jenis[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                        <option value >-Pilih-</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="baki[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="sb[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="jw[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add"><i class="glyphicon glyphicon-plus"></i></button>
                                                </td>
                                            </tr>
                                            <tr class="row" id="tambahgroup" data-op="tambahgroup" hidden>
                                                <td><input type="text" class="form-control" name="nama_groub[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td>
                                                    <select class="form-control" name="jenis[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                        <option value >-Pilih-</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="baki[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="sb[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="jw[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td class="input-group-btn"> 
                                                    <button class="btn btn-danger" name="hapus" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                             <td colspan="3" align="center"><b>Total Baki Debet</b></td>
                                             <td><input type="text" class="form-control" name="total_baki" ></td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="panel-primary"><h4 align="center">Rincian Fasilitas Pinjaman </h4></div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered" name="daftarnasabahtable">
                                        <thead>
                                            <tr>
                                                <th rowspan="2"></th>
                                                <th rowspan="2">Jenis Fasilitas</th>
                                                <th rowspan="2">Limit yg ada saat ini (Rp.)</th>
                                                <th colspan="3">Jenis Permohonan</th>
                                                <th rowspan="2">Jumlah (Rp.)</th>
                                                <th rowspan="2">Suku Bunga (%/Bulan)</th>
                                                <th rowspan="2">Provisi (%)</th>
                                                <th rowspan="2">Adm (Rp.)</th>
                                                <th rowspan="2">Jangka Waktu (Bulan)</th>
                                            </tr>
                                            <tr>
                                                <th>Baru (Rp.)</th>
                                                <th>Perpanjangan (Rp.)</th>
                                                <th>Penambahan/ Pengurangan (Rp.)</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tambahgroup_rinci">
                                            <tr class="row">
                                                <td><select class="form-control" name="jenis_r[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                        <option value >-Pilih Jenis Fasilitas-</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="limit[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="baru_r[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="panjang[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="penambahan[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="jumlah_r[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="bunga_r[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="prov[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="admin[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="jw_r[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>

                                                <td class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add_rinci"><i class="glyphicon glyphicon-plus"></i></button>
                                                </td>
                                            </tr>
                                            <tr class="row" id="tambahgroup_rinci" data-op="tambahgroup_rinci" hidden>
                                                <td><select class="form-control" name="jenis_r[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                        <option value >-Pilih Jenis Fasilitas-</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="limit[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="baru_r[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="panjang[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="penambahan[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="jumlah_r[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="bunga_r[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="prov[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="admin[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="jw_r[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                
                                                <td class="input-group-btn"> 
                                                    <button class="btn btn-danger" name="hapus_rinci" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                             <td colspan="2" align="center"><b>Total</b></td>
                                             <td><input type="text" class="form-control" name="total_limit" ></td>
                                             <td><input type="text" class="form-control total_baru" ></td>
                                             <td><input type="text" class="form-control total_panjang" ></td>
                                             <td><input type="text" class="form-control total_tambah" ></td>
                                             <td><input type="text" class="form-control total_jumlah" ></td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="panel-primary"><h4 align="center">Rincian Fasilitas di LJK Lain </h4></div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered" name="daftarnasabahtable">
                                        <thead>
                                            <th></th>
                                            <th>Nama LJK</th>
                                            <th>Jenis Fasilitas</th>
                                            <th>Plafon (Rp.)</th>
                                            <th>Baki Debet (Rp.)</th>
                                            <th>Agunan</th>
                                            <th>Jatuh Tempo</th>
                                            <th>BPR Take-Over</th>
                                            <th>SLIK</th>
                                            <th>Angs/Bln (Rp.)</th>
                                        </thead>
                                        <tbody class="tambahgroup_ljk">
                                            <tr class="row">
                                                <td><input type="text" class="form-control" name="nama_ljk[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><select class="form-control" name="jenis_ljk[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                        <option value >-Pilih Jenis Fasilitas-</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="plafon_ljk[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="baki_ljk[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><select class="form-control" name="agunan_ljk[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                        <option value >-Pilih Agunan-</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="tempo_ljk[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><select class="form-control" name="bprto_ljk[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                        <option value >-Pilih BPR Take-Over-</option>
                                                    </select>
                                                </td>
                                                <td><select class="form-control" name="slik_ljk[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                        <option value >-Pilih SLIK-</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="angsbulan[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                
                                                <td class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add_ljk"><i class="glyphicon glyphicon-plus"></i></button>
                                                </td>
                                            </tr>
                                            <tr class="row" id="tambahgroup_ljk" data-op="tambahgroup_ljk" hidden>
                                                <td><input type="text" class="form-control" name="nama_ljk[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><select class="form-control" name="jenis_ljk[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                        <option value >-Pilih Jenis Fasilitas-</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="plafon_ljk[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="baki_ljk[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><select class="form-control" name="agunan_ljk[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                        <option value >-Pilih Agunan-</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="tempo_ljk[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><select class="form-control" name="bprto_ljk[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                        <option value >-Pilih BPR Take-Over-</option>
                                                    </select>
                                                </td>
                                                <td><select class="form-control" name="slik_ljk[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                        <option value >-Pilih SLIK-</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="angsbulan[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                
                                                <td class="input-group-btn"> 
                                                    <button class="btn btn-danger" name="hapus_ljk" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row form-group">
                                        <label class="col-sm-2 control-label">SLIK</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="slik_pilih" data-toggle="tooltip" data-placement="right" title="" required>
                                                    <option value >-Pilih SLIK-</option>
                                                </select>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="tab-pane animation-slide-left" id="uang" role="tabpanel">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Biaya-Biaya :</label>
                                        <div class="col-sm-8">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Kebutuhan Rumah Tangga</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="keb_rumah" value="" style="text-transform:uppercase;" placeholder="" data-toggle="tooltip" data-placement="right" title="" />
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Listrik dan Air (PDAM)</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="listrik_air" value="" style="text-transform:uppercase;" placeholder="" data-toggle="tooltip" data-placement="right" title="" />
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Biaya Pendidikan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="pendidikkan" value="" style="text-transform:uppercase;" placeholder="" data-toggle="tooltip" data-placement="right" title="" />
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Lain-Lain :</label>
                                        <div class="col-sm-8">
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Arisan</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="arisan" value="" style="text-transform:uppercase;" placeholder="" data-toggle="tooltip" data-placement="right" title="" />
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Sumbangan + Lainnya</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="sumbang" value="" style="text-transform:uppercase;" placeholder="" data-toggle="tooltip" data-placement="right" title="" />
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Total :</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" name="total" value="" style="text-transform:uppercase;" placeholder="" data-toggle="tooltip" data-placement="right" title="" />
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="col-sm-6">
                                   
                                </div>
                            </div>
                        </fieldset>
                        <fieldset class="tab-pane animation-slide-left" id="managemen" role="tabpanel">
                            <div class="panel panel-primary" id="panelkredit">
                                <div class="panel-heading"><h4 align="center">Data Manajemen Usaha dan Pekerjaan Profesi</h4></div>
                                    <div class="row"><br>
                                        <div class="col-sm-12">
                                            <div class="row form-group">
                                                <label class="col-sm-2 control-label">Pendalaman Usaha</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="pendalaman" data-toggle="tooltip" data-placement="right" title="" required>
                                                            <option value >-Pilih Pendalaman Usaha-</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 control-label">Komentar</label>
                                                <div class="col-sm-9">
                                                <textarea name="komentar_pendalaman" value="" placeholder="Isi Komentar" style="text-transform: uppercase; margin: 0px; width: 827px; height: 88px;" data-toggle="tooltip" data-placement="right" title=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 control-label">Reputasi Lokal</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="reputasi" data-toggle="tooltip" data-placement="right" title="" required>
                                                            <option value >-Pilih Reputasi Lokal-</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 control-label">Komentar</label>
                                                <div class="col-sm-9">
                                                <textarea name="komentar_reputasi" value="" placeholder="Isi Komentar" style="text-transform: uppercase; margin: 0px; width: 827px; height: 88px;" data-toggle="tooltip" data-placement="right" title=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 control-label">Hubungan Dengan LJK</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="pendalaman" data-toggle="tooltip" data-placement="right" title="" required>
                                                            <option value >-Pilih Hubungan Dengan LJK-</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 control-label">Komentar</label>
                                                <div class="col-sm-9">
                                                <textarea name="komentar_ljk" value="" placeholder="Isi Komentar" style="text-transform: uppercase; margin: 0px; width: 827px; height: 88px;" data-toggle="tooltip" data-placement="right" title=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </fieldset>
                        <fieldset class="tab-pane animation-slide-left" id="aktif" role="tabpanel">
                            <div class="panel panel-primary" id="panelkredit">
                                <div class="panel-heading"><h4 align="center">Data Aktifitas Usaha dan Idustri/Pekerjaan-Profesi</h4></div>
                                    <div class="row"><br>
                                        <div class="col-sm-12">
                                            <div class="row form-group">
                                                <label class="col-sm-2 control-label">Prospek Bisnis Masa Datang</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="prospek" data-toggle="tooltip" data-placement="right" title="" required>
                                                            <option value >-Pilih Prospek Bisnis Masa Datang-</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 control-label">Komentar</label>
                                                <div class="col-sm-9">
                                                <textarea name="komentar_prospek" value="" placeholder="Isi Komentar" style="text-transform: uppercase; margin: 0px; width: 827px; height: 88px;" data-toggle="tooltip" data-placement="right" title=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 control-label">Kemampuan Mengelola Usaha</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="kemampuan" data-toggle="tooltip" data-placement="right" title="" required>
                                                            <option value >-Pilih Kemampuan Mengelola Usaha-</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 control-label">Komentar</label>
                                                <div class="col-sm-9">
                                                <textarea name="komentar_kemampuan" value="" placeholder="Isi Komentar" style="text-transform: uppercase; margin: 0px; width: 827px; height: 88px;" data-toggle="tooltip" data-placement="right" title=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 control-label">Permodalan</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="modal" data-toggle="tooltip" data-placement="right" title="" required>
                                                            <option value >-Pilih Permodalan-</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 control-label">Komentar</label>
                                                <div class="col-sm-9">
                                                <textarea name="komentar_modal" value="" placeholder="Isi Komentar" style="text-transform: uppercase; margin: 0px; width: 827px; height: 88px;" data-toggle="tooltip" data-placement="right" title=""></textarea>
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 control-label">Trada Cheking dan Info Lainnya</label>
                                                    <div class="col-sm-9">
                                                        <select class="form-control" name="info" data-toggle="tooltip" data-placement="right" title="" required>
                                                            <option value >-Pilih Trada Cheking dan Info Lainnya-</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class="row form-group">
                                                <label class="col-sm-2 control-label">Komentar</label>
                                                <div class="col-sm-9">
                                                <textarea name="komentar_info" value="" placeholder="Isi Komentar" style="text-transform: uppercase; margin: 0px; width: 827px; height: 88px;" data-toggle="tooltip" data-placement="right" title=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="row submitbtn1">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan menyimpan data ini?')">SIMPAN</button>
                                </div>
                            </div>
                        </fieldset>
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
            var $template = $('#tambahgroup'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                .appendTo('.tambahgroup');
             $('[name="hapus"]').on('click',function(){
                $(this).closest("tr.row").remove();
                    e.preventDefault();;
            });
        });

       $('#add_rinci').click(function(){
            var $template = $('#tambahgroup_rinci'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                .appendTo('.tambahgroup_rinci');
             $('[name="hapus_rinci"]').on('click',function(){
                $(this).closest("tr.row").remove();
                    e.preventDefault();;
            });
        });

       $('#add_ljk').click(function(){
            var $template = $('#tambahgroup_ljk'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                .appendTo('.tambahgroup_ljk');
             $('[name="hapus_ljk"]').on('click',function(){
                $(this).closest("tr.row").remove();
                    e.preventDefault();;
            });
        });


    });
</script>
@endsection
