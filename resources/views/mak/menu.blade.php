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
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Jenis Memo Kredit</label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="memo" value="" style="text-transform:uppercase;" placeholder="" data-toggle="tooltip" data-placement="right" title="Jenis Memo Kredit:
Mohon dipilih sesuai dengan pengajuan kredit calon debitur,
Baru : Hanya untuk pengajuan baru baik calon debitur yang belum maupun yang sudah memiliki kredit di BPR
Perpanjangan : Untuk permohonan Perpanjangan fasilitas debitur yang akan jatuh tempo
Penambahan : Untuk permohonan Penambahan Plafon Kredit
Pengurangan: Untuk permohonan Penurunan Plafon Kredit
Perubahan : Untuk permohonan Perubahan fasilitas, suku bunga
Lain - lain : Untuk permohonan selain dari Jenis Memo Kredit di atas, seperti : permohonan pengambilan sebagian agunan atau
penggantian jaminan, dll" />
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
                                      <textarea rows="8" cols="70" name="tujuan" value="" placeholder="Isi Tujuan" style="text-transform: uppercase; margin: 0px; height: 83px; width: 913px;" data-toggle="tooltip" data-placement="right" title="Tujuan Permohonan Kredit:
- Diisi dengan format 'Teks',  max.  240 karakter"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-4 control-label">Nama Kantor Pusat/Cabang</label>
                                    <div class="col-sm-8">
                                        <select class="form-control" name="namakantor" data-toggle="tooltip" data-placement="right" title="Nama Kantor Cabang / Kas:Isi dengan format 'Wilayah / Nama Kota Masing - masing Kantor'contoh : Malang, Kediri, Blitar, Gresik, Jember, Banyuwangi, dll" required>
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
                                        <th>Baki Debet</th>
                                        <th>S.B (%)</th>
                                        <th>JW (Bulan)</th>
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
                                                <button class="btn btn-success" type="button" id="add"><i class="glyphicon glyphicon-plus"></i>Tambah</button>
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
                                                <button class="btn btn-danger" name="hapus" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus</button>
                                            </td>
                                        </tr>
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
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
        $('[name="tglmemodulu"]').mask('99-99-9999',{placeholder:"dd-mm-yyyy"});

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

    });
</script>
@endsection
