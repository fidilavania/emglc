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
                                        <input type="text" class="form-control" name="input_tanggal_mohon" id="input_tanggal_mohon" value="{{date('d-m-Y')}}" readonly>
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
                                            <select class="form-control" name="memo" data-toggle="tooltip" data-placement="right">
                                                <option value >-Pilih Jenis Memo-</option>
                                                    @foreach($jmemo as $jm)  
                                                        <option value="{{$jm->kode}}">{{$jm->kode}} - {{$jm->jenis}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Tanggal Memo Sekarang</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" name="tgl_now" id="tgl_now" value="{{date('d-m-Y')}}" data-toggle="tooltip" data-placement="right" title="Kolom ini akan diisi secara otomatis oleh komputer" readonly>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Tanggal Memo Sebelum</label>
                                        <div class="col-sm-8">
                                          <input type="text" class="form-control" value="" name="tgl_last" id="tgl_last" placeholder="{{date('d-m-Y')}}" data-toggle="tooltip" data-placement="right" title="Isi dengan format Tanggal dd-mm-yyyy" >
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
                                                <input type="text" class="form-control" name="no_memo" value="" data-toggle="tooltip" data-placement="right" title="No MAK: Isi dengan format huruf dan angka sesuai dengan format yang berlaku di BPR masing masing" placeholder="NOMOR MEMO" >
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
                                                <input type="text" class="form-control" name="nama" value="" data-toggle="tooltip" data-placement="right" title= "Nama Debitur / Calon Debitur:  Isi dengan format 'Nama' contoh : Dwi Tjahjono" placeholder="NAMA DEBITUR" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Badan Hukum Debitur</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" name="badan" data-toggle="tooltip" data-placement="right" title="" required>
                                                <option value >-Pilih Nama Badan Hukum Debitur-</option>
                                                    @foreach($badanhukum as $b)  
                                                        <option value="{{$b->kode}}">{{$b->kode}} - {{$b->nama}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">No KTP (Deb/Calon Deb)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="ktp" value="" data-toggle="tooltip" data-placement="right" title="Nomor KTP (Deb / Calon Deb): Isi dengan format 'Nomor Identitas KTP' contoh : 3509201305830001" placeholder="NOMOR KTP" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Jenis Usaha</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="usaha" data-toggle="tooltip" data-placement="right" title="">
                                                    <option value >-Pilih Jenis Usaha-</option>
                                                    @foreach($jusaha as $j)  
                                                        <option value="{{$j->kode}}">{{$j->kode}} - {{$j->Jenis_usaha}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Pekerjaan</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="pekerjaan" data-toggle="tooltip" data-placement="right" title="">
                                                    <option value >-Pilih Pekerjaan-</option>
                                                    @foreach($kerja as $p)  
                                                        <option value="{{$p->kode}}">{{$p->kode}} - {{$p->pekerjaan}}</option>
                                                    @endforeach
                                                </select>
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
                                                <input type="text" class="form-control" name="dusun_ktp" value="" placeholder="ISI NAMA JALAN" data-toggle="tooltip" data-placement="right" title="Nama Jalan: Isi dengan format 'Nama Jalan / Dusun' tempat tinggal debitur. contoh : Jl Raya Karawaci 99" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Kelurahan / Kecamatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="lurah_ktp" value="" placeholder="ISI KELURAHAN/KECAMATAN" data-toggle="tooltip" data-placement="right" title="Kelurahan / Kecamatan: Isi dengan format 'Nama Kelurahan / Kecamatan' tempat tinggal debitur. contoh : Klojen / Gresik" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Kota/Kode Pos</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="kota_ktp" placeholder="ISI KOTA" value="" data-toggle="tooltip" data-placement="right" title="Kota : Isi dengan format 'Nama Kota' tempat tinggal debitur. contoh : Gresik, Surabaya, Sidoarjo, Jember, Banyuwangi, Lumajang, Bondowoso dll  " >
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="pos_ktp" placeholder="ISI KODEPOS" value="" data-toggle="tooltip" data-placement="right" title="Kode Pos : Isi dengan format 'Kode Pos' tempat tinggal debitur. contoh : 68135, 68121, 68121, dll  " >
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
                                                <input type="text" class="form-control" name="dusun_usaha" value="" placeholder="ISI NAMA JALAN" data-toggle="tooltip" data-placement="right" title="Nama Jalan: BILA ALAMAT USAHA TIDAK SAMA dengan ALAMAT RUMAH :  Isi dengan format 'Nama Jalan / Dusun' tempat tinggal debitur. contoh : Jl Diponegoro 67" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Kelurahan / Kecamatan</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="lurah_usaha" value="" placeholder="ISI KELURAHAN/KECAMATAN" data-toggle="tooltip" data-placement="right" title="Kelurahan / Kecamatan: Isi dengan format 'Nama Kelurahan / Kecamatan' tempat tinggal debitur. contoh : Klojen / Gresik" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Kota/Kode Pos</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="kota_usaha" placeholder="ISI KOTA" value="" data-toggle="tooltip" data-placement="right" title="Kota : Isi dengan format 'Nama Kota' tempat tinggal debitur. contoh : Gresik, Surabaya, Sidoarjo, Jember, Banyuwangi, Lumajang, Bondowoso dll " >
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="pos_usaha" placeholder="ISI KODEPOS" value="" data-toggle="tooltip" data-placement="right" title="Kode Pos : Isi dengan format 'Kode Pos' tempat tinggal debitur. contoh : 68135, 68121, 68121, dll  " >
                                            </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">No Rekening Dana BPR</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="norek" value="" data-toggle="tooltip" placeholder="ISI NO REKENING" data-placement="right" title="No. Rekening Tab / Dep pada BPR: Untuk Debitur Baru, fill ini JANGAN diisi, untuk Debitur Lama mohon Isi dengan format 'Rekening Tab/Dep'. contoh : 02.009999.07 (Rek Tab)  ;   01.007777.01 (Rek Dep)" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Status Perkawinan</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="kawin" data-toggle="tooltip" data-placement="right" title="">
                                                    <option value >-Pilih Status Perkawinan-</option>
                                                    @foreach($nikah as $n)  
                                                        <option value="{{$n->kode}}">{{$n->kode}} - {{$n->Status}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Nama Pasangan/Orang Tua</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="pasangan" value="" placeholder="ISI NAMA" data-toggle="tooltip" data-placement="right" title="Nama Pasangan / Orang Tua: Isi dengan format 'Nama Suami / Istri / Orang Tua (untuk yang belum Menikah)' debitur" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">No KTP Pasangan/ Orang Tua</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="ktp_pasangan" value="" placeholder="ISI NO KTP" data-toggle="tooltip" data-placement="right" title="Nomor KTP Pasangan / Ortu: Isi dengan format 'Nomor Identitas KTP Pasangan / Orang Tua' debitur" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Menjadi Debitur Sejak</label>
                                            <div class="col-sm-4">
                                                <select class="form-control" name="sejak" data-toggle="tooltip" data-placement="right" title="" required>
                                                    <option value >-Pilih Status Debitur-</option>
                                                    @foreach($dep as $n)  
                                                        <option value="{{$n->kode}}">{{$n->kode}} - {{$n->status}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="tanggal_deb" id="tanggal_deb" placeholder="dd-mm-yyyy" value="" data-toggle="tooltip" data-placement="right" title="" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Aktivitas Rekening Pinjaman</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="aktivitas" data-toggle="tooltip" data-placement="right" title="" required>
                                                    <option value >-Pilih Aktifitas Rekening Pinjaman-</option>
                                                    @foreach($kolek as $n)  
                                                        <option value="{{$n->kode}}">{{$n->kode}} - {{$n->kolektibilitas}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Nama AO</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="ao" value="" placeholder="ISI NAMA AO" data-toggle="tooltip" data-placement="right" title="Nama AO:Isi dengan format 'Nama Lengkap AO'. contoh : Dwi Tjahjono" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Referensi fee Marketing</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="ref" value="" placeholder="ISI REFRENSI" data-toggle="tooltip" data-placement="right" title="Referensi Fee Marketing: Mohon diisi dengan 'Nama Lengkap  yang mereferensikan'. contoh : Joko, Anie, Gaguk" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Perekomendasi</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="rekom" value="" data-toggle="tooltip" placeholder="ISI PEREKOMENDASI" data-placement="right" title="Perekomendasi :Isi dengan Jabatan  :  SPV, Ka Kas, KaCab, Ka Kredit" >
                                            </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Nama Perekomendasi</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="nama_rekom" value="" data-toggle="tooltip" placeholder="ISI NAMA" data-placement="right" title="Nama Perekomendasi :Isi dengan :  Nama Personil SPV, Ka Kas, KaCab, Ka Kredit" >
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
                                            <th title=" Nama: Isi dengan format 'Nama Exposure (Anak dalam 1 KK, Anak tidak dalam 1 KK (ada keterkaitan usaha & permodalan), Diluar anak yang memiliki keterkaitan usaha & permodalan)' contoh : Sri Wahyuni">Nama</th>
                                            <th>Jenis Fasilitas</th>
                                            <th title="Baki Debet:Diisi dengan Sisa Baki Debet Pinjaman">Baki Debet (Rp.)</th>
                                            <th title="Suku Bunga: (dlm bentuk persentasi) Isi dengan format 'Angka'" >Suku Bunga (%)</th>
                                            <th title="Jangka Waktu:Isi dengan format 'Angka'">Jangka Waktu (Bulan)</th>
                                        </thead>
                                        <tbody class="tambahgroup">
                                            <tr class="row" id="tambahgroup" data-op="tambahgroup" >
                                                <td><input type="text" class="form-control" name="nama_groub[]" value="" placeholder="-" ></td>
                                                <td><select class="form-control" name="jenis[]" required>
                                                        <option value >-Pilih-</option>
                                                        @foreach($gjefas as $g)  
                                                            <option value="{{$g->kode}}">{{$g->kode}} - {{$g->jenis_fasilitas}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="baki[]" value="" placeholder="-" ></td>
                                                <td><input type="text" class="form-control" name="sb[]" value="" placeholder="-" ></td>
                                                <td><input type="text" class="form-control" name="jw[]" value="" placeholder="-" ></td>
                                                <td class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add"><i class="glyphicon glyphicon-plus"></i></button>
                                                </td>
                                                <td class="input-group-btn"> 
                                                    <button class="btn btn-danger" name="hapus" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                                </td>
                                            </tr>
                                            <!-- <tr class="row" id="tambahgroup1" data-op="tambahgroup1" hidden>
                                                <td><input type="text" class="form-control" name="nama_groub[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td>
                                                    <select class="form-control" name="jenis[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                        <option value >-Pilih-</option>
                                                        @foreach($gjefas as $g)  
                                                            <option value="{{$g->kode}}">{{$g->kode}} - {{$g->jenis_fasilitas}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="baki[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="sb[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td><input type="text" class="form-control" name="jw[]" value="" data-toggle="tooltip" data-placement="right" title="" ></td>
                                                <td class="input-group-btn"> 
                                                    <button class="btn btn-danger" name="hapus" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                                </td>
                                            </tr> -->
                                        </tbody>
                                        <tbody>
                                             <td colspan="3" align="center"><b>Total Baki Debet</b></td>
                                             <td><input type="text" class="form-control" name="total_baki" placeholder="-" readonly ></td>
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
                                                <th rowspan="2" title="Jumlah Plafon Saat ini (Rupiah): Diisi dengan format 'Angka'">Limit yg ada saat ini (Rp.)</th>
                                                <th colspan="3">Jenis Permohonan</th>
                                                <th rowspan="2">Jumlah (Rp.)</th>
                                                <th rowspan="2" title="Suku Bunga: (dlm bentuk persentasi): Isi dengan format 'Angka'">Suku Bunga (%/Bulan)</th>
                                                <th rowspan="2" title="Provisi: (dlm bentuk persentasi): Isi dengan format 'Angka'" >Provisi (%)</th>
                                                <th rowspan="2" title="Administrasi: (dlm bentuk persentasi): Isi dengan format 'Angka'" >Adm (Rp.)</th>
                                                <th rowspan="2" title="Jangka Waktu: Isi dengan format 'Angka', untuk Fasilitas lama yang masih Berjalan...mohon diisi dengan sisa jangka waktu kredit yang masih berlaku., contoh : misal pinjaman flat dengan jangka waktu 60 bulan, namun sudah berjalan selama 24 bulan, maka  sisa jangka waktu sama dengan 36 bulan, jadi kolom Jangka waktu mohon diisi dengan angka 36">Jangka Waktu (Bulan)</th>
                                            </tr>
                                            <tr>
                                                <th>Baru (Rp.)</th>
                                                <th>Perpanjangan (Rp.)</th>
                                                <th title="Penambahan / Pengurangan: untuk 'Pengurangan' mohon diisikan dengan ditambahi tanda minus (-), contoh : -50000000">Penambahan/ Pengurangan (Rp.)</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tambahgroup_rinci">
                                            <tr class="row" id="tambahgroup_rinci" data-op="tambahgroup_rinci">
                                                <td><select class="form-control" name="jenis_r[]" data-toggle="tooltip" data-placement="right" title="" required>
                                                        <option value >-Pilih-</option>
                                                        @foreach($gjefas as $g)  
                                                            <option value="{{$g->kode}}">{{$g->kode}} - {{$g->jenis_fasilitas}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="limit[]" value="" placeholder="-" ></td>
                                                <td><input type="text" class="form-control" name="baru_r[]" value="" placeholder="-" ></td>
                                                <td><input type="text" class="form-control" name="panjang[]" value="" placeholder="-" ></td>
                                                <td><input type="text" class="form-control" name="penambahan[]" value="" placeholder="-" ></td>
                                                <td><input type="text" class="form-control" name="jumlah_r[]" value="" placeholder="-" ></td>
                                                <td><input type="text" class="form-control" name="bunga_r[]" value="" placeholder="-" ></td>
                                                <td><input type="text" class="form-control" name="prov[]" value="" placeholder="-" ></td>
                                                <td><input type="text" class="form-control" name="admin[]" value="" placeholder="-" ></td>
                                                <td><input type="text" class="form-control" name="jw_r[]" value="" placeholder="-" ></td>
                                                <td class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add_rinci"><i class="glyphicon glyphicon-plus"></i></button>
                                                </td>
                                                <td class="input-group-btn"> 
                                                    <button class="btn btn-danger" name="hapus_rinci" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                                </td>
                                            </tr>
                                            <!-- <tr class="row" id="tambahgroup_rinci1" data-op="tambahgroup_rinci1" hidden>
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
                                            </tr> -->
                                        </tbody>
                                        <tbody>
                                             <td colspan="2" align="center"><b>Total</b></td>
                                             <td><input type="text" class="form-control" name="total_limit" placeholder="-" readonly ></td>
                                             <td><input type="text" class="form-control" name="total_baru" placeholder="-" readonly ></td>
                                             <td><input type="text" class="form-control" name="total_panjang" placeholder="-" readonly ></td>
                                             <td><input type="text" class="form-control" name="total_tambah" placeholder="-" readonly ></td>
                                             <td><input type="text" class="form-control" name="total_jumlah" placeholder="-" readonly ></td>
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
                                            <th title="Nama Bank:Diisi dengan format 'Huruf dan/atau Angka',  max.  35 karakter, termasuk nama suami  / istri">Nama LJK</th>
                                            <th>Jenis Fasilitas</th>
                                            <th title="Plafon: (dlm bentuk persentasi): Isi dengan format 'Angka'">Plafon (Rp.)</th>
                                            <th title="Baki Debet: (dlm bentuk persentasi): Isi dengan format 'Angka'">Baki Debet (Rp.)</th>
                                            <th>Agunan</th>
                                            <th>Jatuh Tempo</th>
                                            <th>BPR Take-Over</th>
                                            <th title="ISI SESUAI HASIL i-DEP">SLIK</th>
                                            <th title="Angsuran/Bulan: (dlm bentuk persentasi): Isi dengan format 'Angka'">Angs/Bln (Rp.)</th>
                                        </thead>
                                        <tbody class="tambahgroup_ljk">
                                            <tr class="row" id="tambahgroup_ljk" data-op="tambahgroup_ljk">
                                                <td><input type="text" class="form-control" name="nama_ljk[]" value="" placeholder="-" ></td>
                                                <td><select class="form-control" name="jenis_ljk[]" placeholder="-" required>
                                                        <option value >-Pilih-</option>
                                                        @foreach($mjefas as $m)  
                                                            <option value="{{$m->kode}}">{{$m->kode}} - {{$m->jenis_fasilitas}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="plafon_ljk[]" value="" placeholder="-" ></td>
                                                <td><input type="text" class="form-control" name="baki_ljk[]" value="" placeholder="-" ></td>
                                                <td><select class="form-control" name="agunan_ljk[]" placeholder="-" required>
                                                        <option value >-Pilih Agunan-</option>
                                                        @foreach($ragun as $r)  
                                                            <option value="{{$r->kode}}">{{$r->kode}} - {{$r->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="tempo_ljk[]" id="tempo_ljk[]" value="" placeholder="-" ></td>
                                                <td><select class="form-control" name="bprto_ljk[]" placeholder="-" required>
                                                        <option value >-Pilih BPR Take-Over-</option>
                                                        @foreach($yatidak as $m)  
                                                            <option value="{{$m->kode}}">{{$m->kode}} - {{$m->Keterangan}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><select class="form-control" name="slik_ljk[]" placeholder="-" required>
                                                        <option value >-Pilih SLIK-</option>
                                                        @foreach($slik as $m)  
                                                            <option value="{{$m->kode}}">{{$m->kode}} - {{$m->nama}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td><input type="text" class="form-control" name="angsbulan[]" value="" placeholder="-" ></td>
                                                <td class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add_ljk"><i class="glyphicon glyphicon-plus"></i></button>
                                                </td>
                                                <td class="input-group-btn"> 
                                                    <button class="btn btn-danger" name="hapus_ljk" type="button"><i class="glyphicon glyphicon-remove"></i> </button>
                                                </td>
                                            </tr>
                                            <!-- <tr class="row" id="tambahgroup_ljk1" data-op="tambahgroup_ljk1" hidden>
                                                <td><input type="text" class="form-control" name="nama_ljk[]" value="" placeholder="-" ></td>
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
                                            </tr> -->
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
                                                    @foreach($s_slik as $s)  
                                                        <option value="{{$s->kode}}">{{$s->kode}} - {{$s->Keterangan}}</option>
                                                    @endforeach
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
                                            <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control" name="keb_rumah" value="" style="text-transform:uppercase;" placeholder="-" id="keb"   />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Listrik dan Air (PDAM)</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control" name="listrik_air" value="" style="text-transform:uppercase;" placeholder="-" id="lis" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Biaya Pendidikan</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control" name="pendidikkan" value="" style="text-transform:uppercase;" placeholder="-" id="didik"  />
                                            </div>
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
                                            <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control" name="arisan" value="" style="text-transform:uppercase;" placeholder="-" id="aris"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Sumbangan + Lainnya</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control" name="sumbang" value="" style="text-transform:uppercase;" placeholder="-" id="sum"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group">
                                        <label class="col-sm-4 control-label">Total :</label>
                                        <div class="col-sm-8">
                                            <div class="input-group">
                                            <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control" name="total" value="" style="text-transform:uppercase;" placeholder="-" id="tot" readonly />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group pull-right">
                                        <div class="row">
                                             <div class="col-sm-3">
                                                <button type="button" id="generateTable" class="btn btn-primary" onclick="jumlah()">JUMLAHKAN</button>
                                            </div>
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
                                                            @foreach($p_usaha as $p)  
                                                                <option value="{{$p->kode}}">{{$p->kode}} - {{$p->keterangan}}</option>
                                                            @endforeach
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
                                                            @foreach($r_lokal as $p)  
                                                                <option value="{{$p->kode}}">{{$p->kode}} - {{$p->keterangan}}</option>
                                                            @endforeach
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
                                                             @foreach($hub_bank as $p)  
                                                                <option value="{{$p->kode}}">{{$p->kode}} - {{$p->keterangan}}</option>
                                                            @endforeach
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
                                                            @foreach($prospek as $p)  
                                                                <option value="{{$p->kode}}">{{$p->kode}} - {{$p->keterangan}}</option>
                                                            @endforeach
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
                                                            @foreach($usaha as $p)  
                                                                <option value="{{$p->kode}}">{{$p->kode}} - {{$p->keterangan}}</option>
                                                            @endforeach
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
                                                            @foreach($modal as $p)  
                                                                <option value="{{$p->kode}}">{{$p->kode}} - {{$p->keterangan}}</option>
                                                            @endforeach
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
                                                            @foreach($trade as $p)  
                                                                <option value="{{$p->kode}}">{{$p->kode}} - {{$p->keterangan}}</option>
                                                            @endforeach
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
    // Data Keuangan
        $('[name="keb_rumah"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="listrik_air"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="pendidikkan"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="arisan"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="sumbang"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="total"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

        function jumlah(){
            var keb  = parseInt($('[name="keb_rumah"]').val().split('.').join(""));
            var lis  = parseInt($('[name="listrik_air"]').val().split('.').join(""));
            var didik  = parseInt($('[name="pendidikkan"]').val().split('.').join(""));
            var aris  = parseInt($('[name="arisan"]').val().split('.').join(""));
            var sum  = parseInt($('[name="sumbang"]').val().split('.').join(""));
            var tot  = parseInt($('[name="total"]').val().split('.').join(""));

            var tot = Math.ceil(keb+lis+didik+aris+sum);

            $('[name="total"]').val(tot);

        }

    $(document).ready(function() {

    // memo
        $('#tgl_last').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});
        $('#tanggal_deb').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});

    // debitur
        $('[name="total_baki[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="baki[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

        $('[name="limit[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="baru_r[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="panjang[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="penambahan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="jumlah_r[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="admin[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="total_limit[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="total_baru[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="total_panjang[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="total_tambah[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="total_jumlah[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

        $('[name="plafon_ljk[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="baki_ljk[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="angsbulan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        $('[name="tempo_ljk[]"]').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});

    // Debitur
        $('#add').click(function(){
            var $template = $('#tambahgroup'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                .appendTo('.tambahgroup');

            $('[name="total_baki[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="baki[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

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

            $('[name="limit[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="baru_r[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="panjang[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="penambahan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="jumlah_r[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="admin[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="total_limit[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="total_baru[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="total_panjang[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="total_tambah[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="total_jumlah[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});


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

            $('[name="plafon_ljk[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="baki_ljk[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="angsbulan[]"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
            $('[name="tempo_ljk[]"]').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});

             $('[name="hapus_ljk"]').on('click',function(){
                $(this).closest("tr.row").remove();
                    e.preventDefault();;
            });
        });

    });
</script>
@endsection
