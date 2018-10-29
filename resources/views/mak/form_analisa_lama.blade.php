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
                    <div class="panel-heading"><h4 align="center">LAPORAN ANALISA USAHA</h4></div>
                    <div class="panel-body nav-tabs-animate">
                        <ul class="nav nav-tabs nav-tabs-line" data-plugin="nav-tabs" role="tablist">
                            <li role="presentation"><a data-toggle="tab" href="#tani" aria-controls="tani" role="tab">PERTANIAN</a><i class="fa"></i></li>
                            <li role="presentation"><a data-toggle="tab" href="#dagang" aria-controls="dagang" role="tab">PERDAGANGAN</a><i class="fa"></i></li>
                            <li role="presentation"><a data-toggle="tab" href="#konstruksi" aria-controls="konstruksi" role="tab">KONSTRUKSI</a><i class="fa"></i></li>
                            <li role="presentation"><a data-toggle="tab" href="#ternak" aria-controls="ternak" role="tab">PETERNAKAN</a><i class="fa"></i></li>  
                            <li role="presentation"><a data-toggle="tab" href="#jasa" aria-controls="jasa" role="tab">JASA</a><i class="fa"></i></li>  
                            <li role="presentation"><a data-toggle="tab" href="#profesi" aria-controls="profesi" role="tab">PROFESI</a><i class="fa"></i></li>                            
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
                                <fieldset class="tab-pane animation-slide-left" id="tani" role="tabpanel">
                                    <div class="panel panel-bordered">
                                        <div class="panel-heading text-center">
                                            <h4 class="panel-title">RINCIAN ANALISA USAHA PERTANIAN</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="tambah_tani">
                                                <div class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add_tani"><i class="glyphicon glyphicon-plus"></i>Tambah Pertanian</button>
                                                </div>
                                            </div>
                                            <div id="tambah_tani" data-op="tambah_tani" hidden>
                                                <div class="row"><br>
                                                    <div class="col-sm-6">
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Jenis Usaha</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="jenis_tani[]" placeholder="ISI JENIS USAHA" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                 </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <table class="table table-bordered">
                                                            <thead style="background-color: grey">
                                                                <th>Pendapatan</th>
                                                                <th colspan="2">Uraian</th>
                                                                <th>Jumlah</th>
                                                            </thead>
                                                            <tbody>
                                                                <td rowspan="5">- Produksi</td>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah[]" value=""></td>
                                                                <tr>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td align="center" colspan="2"><b>Total Pendapatan</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_dapat[]" value=""></td>
                                                                </tr>
                                                                <tr align="center" style="background-color: grey">
                                                                    <td><b>Biaya Produksi</b></td>
                                                                    <td><b>Uraian (@/1 Ha)</b></td>
                                                                    <td><b>Jumlah</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Sewa Lahan</td>
                                                                    <td><input type="text" class="form-control" name="uraian_sewa[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_sewa[]" value=""></td>
                                                                    <td rowspan="9"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Pengolahan Lahan</td>
                                                                    <td><input type="text" class="form-control" name="uraian_olah[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_olah[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Pembelian Bibit/Benih</td>
                                                                    <td><input type="text" class="form-control" name="uraian_bibit[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_bibit[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Biaya Pupuk</td>
                                                                    <td><input type="text" class="form-control" name="uraian_pupuk[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_pupuk[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Biaya Obat-Obatan</td>
                                                                    <td><input type="text" class="form-control" name="uraian_obat[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_obat[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Biaya Irigasi</td>
                                                                    <td><input type="text" class="form-control" name="uraian_irigasi[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_irigasi[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Tenaga Keja (Tanam)</td>
                                                                    <td><input type="text" class="form-control" name="uraian_tanam[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_tanam[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Tenaga Kerja (Pemeliharaan)</td>
                                                                    <td><input type="text" class="form-control" name="uraian_lihara[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_lihara[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Biaya Lain-Lain</td>
                                                                    <td><input type="text" class="form-control" name="uraian_lain[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_lain[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td align="center" colspan="2"><b>Sub Total Biaya Produksi</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_produksi[]" value=""></td>
                                                                </tr>
                                                                <tr align="center" style="background-color: grey">
                                                                    <td><b>Biaya Panen</b></td>
                                                                    <td><b>Uraian (@/1 Ha)</b></td>
                                                                    <td><b>Jumlah</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Sewa Peralatan</td>
                                                                    <td><input type="text" class="form-control" name="uraian_alat[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_alat[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Tenaga Kerja (Panen)</td>
                                                                    <td><input type="text" class="form-control" name="uraian_panen[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_panen[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Tenaga Kerja (Angkut)</td>
                                                                    <td><input type="text" class="form-control" name="uraian_angkut[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_angkut[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Tenaga Kerja (Tebang)</td>
                                                                    <td><input type="text" class="form-control" name="uraian_tebang[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_tebang[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Transportasi</td>
                                                                    <td><input type="text" class="form-control" name="uraian_trans[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_trans[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Biaya Lain-lain</td>
                                                                    <td><input type="text" class="form-control" name="uraian_lain2[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_lain2[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td rowspan="4"></td>
                                                                    <td align="center" colspan="2"><b>Sub Total Biaya Garab/Panen</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_panen[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" colspan="2"><b>Keuntungan dalam 1 Kali Panen</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="untung[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center"><b>Jumlah Bulan/Panen</b></td>
                                                                    <td class="input-group"><input type="text" class="form-control" name="kalipanen[]" value=""><span class="input-group-addon">Kali</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" colspan="2"><b>Keuntungan dalam 1 Bulan</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_untung[]" value=""></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-sm-12"><br>
                                                        <div class="input-group-btn"> 
                                                            <button class="btn btn-danger" name="hapus_tani" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus Pertanian</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="tab-pane animation-slide-left" id="dagang" role="tabpanel">
                                    <div class="panel panel-bordered">
                                        <div class="panel-heading text-center">
                                            <h4 class="panel-title">RINCIAN ANALISA USAHA PERDAGANGAN</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="tambah_dagang">
                                                <div class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add_dagang"><i class="glyphicon glyphicon-plus"></i>Tambah Perdagangan</button>
                                                </div>
                                            </div>
                                            <div id="tambah_dagang" data-op="tambah_dagang" hidden>
                                                <div class="row"><br>
                                                    <div class="col-sm-6">
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Jenis Usaha</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="jenis_dagang[]" placeholder="ISI JENIS USAHA" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                 </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <table class="table table-bordered">
                                                            <thead style="background-color: grey">
                                                                <th>Pendapatan</th>
                                                                <th colspan="2">Uraian</th>
                                                                <th>Jumlah</th>
                                                            </thead>
                                                            <tbody>
                                                                <td rowspan="5">- Produksi</td>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_dagang[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_dagang[]" value=""></td>
                                                                <tr>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_dagang[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_dagang[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_dagang[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_dagang[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_dagang[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_dagang[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_dagang[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_dagang[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td align="center" colspan="2"><b>Total Pendapatan</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_dapat_dagang[]" value=""></td>
                                                                </tr>
                                                                <tr align="center" style="background-color: grey">
                                                                    <td><b>Biaya Penjualan</b></td>
                                                                    <td><b>Uraian</b></td>
                                                                    <td><b>Jumlah</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td align="center" colspan="2"><b>Sub Total Biaya Penjualan</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_jual[]" value=""></td>
                                                                </tr>
                                                                <tr align="center" style="background-color: grey">
                                                                    <td><b>Biaya Operasional</b></td>
                                                                    <td><b>Uraian</b></td>
                                                                    <td><b>Jumlah</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Sewa Tempat Usaha</td>
                                                                    <td><input type="text" class="form-control" name="uraian_sewa_dagang[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_sewa_dagang[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Telepone</td>
                                                                    <td><input type="text" class="form-control" name="uraian_tlp[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_tlp[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Listrik</td>
                                                                    <td><input type="text" class="form-control" name="uraian_listrik[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_listrik[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Air</td>
                                                                    <td><input type="text" class="form-control" name="uraian_air[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_air[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Tenaga Kerja (Operasional)</td>
                                                                    <td><input type="text" class="form-control" name="uraian_op[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_op[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Administrasi dan Umum</td>
                                                                    <td><input type="text" class="form-control" name="uraian_umum[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_umum[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Biaya Lain-lain</td>
                                                                    <td><input type="text" class="form-control" name="uraian_lain2_dagang[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_lain2_dagang[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td rowspan="4"></td>
                                                                    <td align="center" colspan="2"><b>Sub Total Operasional</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_op[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" colspan="2"><b>Keuntungan dalam 1 Bulan</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_untung_dagang[]" value=""></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-sm-12"><br>
                                                        <div class="input-group-btn"> 
                                                            <button class="btn btn-danger" name="hapus_dagang" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus Perdagangan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="tab-pane animation-slide-left" id="konstruksi" role="tabpanel">
                                    <div class="panel panel-bordered">
                                        <div class="panel-heading text-center">
                                            <h4 class="panel-title">RINCIAN ANALISA USAHA KONSTRUKSI</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="tambah_konstruksi">
                                                <div class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add_konstruksi"><i class="glyphicon glyphicon-plus"></i>Tambah Konstruksi</button>
                                                </div>
                                            </div>
                                            <div id="tambah_konstruksi" data-op="tambah_konstruksi" hidden>
                                                <div class="row"><br>
                                                    <div class="col-sm-6">
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Jenis Usaha</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="jenis_konst[]" placeholder="ISI JENIS USAHA" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                 </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <table class="table table-bordered">
                                                            <thead style="background-color: grey">
                                                                <th>Pendapatan</th>
                                                                <th colspan="2">Uraian</th>
                                                                <th>Jumlah</th>
                                                            </thead>
                                                            <tbody>
                                                                <td rowspan="5">- Produksi</td>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_konst[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_konst[]" value=""></td>
                                                                <tr>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_konst[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_konst[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_konst[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_konst[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_konst[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_konst[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_konst[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_konst[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td align="center" colspan="2"><b>Total Pendapatan</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_dapat_konst[]" value=""></td>
                                                                </tr>
                                                                <tr align="center" style="background-color: grey">
                                                                    <td><b>Biaya-Biaya</b></td>
                                                                    <td><b>Uraian</b></td>
                                                                    <td><b>Jumlah</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="konst_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_konst_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_konst_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="konst_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_konst_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_konst_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="konst_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_konst_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_konst_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="konst_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_konst_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_konst_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="konst_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_konst_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_konst_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="konst_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_konst_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_konst_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="konst_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_konst_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_konst_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="konst_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_konst_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_konst_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td rowspan="4"></td>
                                                                    <td align="center" colspan="2"><b>Sub Total Biaya-Biaya</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" colspan="2"><b>Keuntungan dalam 1 Bulan</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_untung_konst[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center"><b>Jumlah Bulan dalam 1 Kali Proyek</b></td>
                                                                    <td class="input-group"><input type="text" class="form-control" name="kalikonst[]" value=""><span class="input-group-addon">Kali</span></td>
                                                                </tr>
                                                                 <tr>
                                                                    <td align="center" colspan="2"><b>Keuntungan dalam 1 Bulan</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_untung_konst1[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-sm-12"><br>
                                                        <div class="input-group-btn"> 
                                                            <button class="btn btn-danger" name="hapus_konstruksi" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus Konstruksi</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="tab-pane animation-slide-left" id="ternak" role="tabpanel">
                                    <div class="panel panel-bordered">
                                        <div class="panel-heading text-center">
                                            <h4 class="panel-title">RINCIAN ANALISA USAHA PETERNAKAN</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="tambah_ternak">
                                                <div class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add_ternak"><i class="glyphicon glyphicon-plus"></i>Tambah Peternakan</button>
                                                </div>
                                            </div>
                                            <div id="tambah_ternak" data-op="tambah_ternak" hidden>
                                                <div class="row"><br>
                                                    <div class="col-sm-6">
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Jenis Usaha</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="jenis_ternak[]" placeholder="ISI JENIS USAHA" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                 </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <table class="table table-bordered">
                                                            <thead style="background-color: grey">
                                                                <th>Pendapatan</th>
                                                                <th colspan="2">Uraian</th>
                                                                <th>Jumlah</th>
                                                            </thead>
                                                            <tbody>
                                                                <td rowspan="4">- Produksi</td>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_ternak[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_ternak[]" value=""></td>
                                                                <tr>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_ternak[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_ternak[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_ternak[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_ternak[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" colspan="2"><b>Total Pendapatan</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_dapat_ternak[]" value=""></td>
                                                                </tr>
                                                                <tr align="center" style="background-color: grey">
                                                                    <td><b>Biaya Produksi</b></td>
                                                                    <td><b>Uraian</b></td>
                                                                    <td><b>Jumlah</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Pembelian Bibit/Benih</td>
                                                                    <td><input type="text" class="form-control" name="uraian_bibit[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_bibit[]" value=""></td>
                                                                    <td rowspan="5"></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Pakan Ternak</td>
                                                                    <td><input type="text" class="form-control" name="uraian_pakan[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_pakan[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Obat-Obatan</td>
                                                                    <td><input type="text" class="form-control" name="uraian_obat[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_obat[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Tenaga Keja (Pemelihara/vaksi)</td>
                                                                    <td><input type="text" class="form-control" name="uraian_vaksin[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_vaksin[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Lain-Lain</td>
                                                                    <td><input type="text" class="form-control" name="uraian_lain_ternak[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_lain_ternak[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Biaya Irigasi</td>
                                                                    <td><input type="text" class="form-control" name="uraian_irigasi[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_irigasi[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td align="center" colspan="2"><b>Sub Total Biaya Produksi</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_produksi_ternak[]" value=""></td>
                                                                </tr>
                                                                <tr align="center" style="background-color: grey">
                                                                    <td><b>Biaya Operasional</b></td>
                                                                    <td><b>Uraian</b></td>
                                                                    <td><b>Jumlah</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Listrik</td>
                                                                    <td><input type="text" class="form-control" name="uraian_listrik_ternak[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_listrik_ternak[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Telepone</td>
                                                                    <td><input type="text" class="form-control" name="uraian_tlp_ternak[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_tlp_ternak[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Air</td>
                                                                    <td><input type="text" class="form-control" name="uraian_air_ternak[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_air_ternak[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>- Lain-Lain</td>
                                                                    <td><input type="text" class="form-control" name="uraian_lain3_ternak[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_lain3_ternak[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td rowspan="4"></td>
                                                                    <td align="center" colspan="2"><b>Sub Total Operasional</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_op_ternak[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center"><b>Jumlah Bulan/Panen</b></td>
                                                                    <td class="input-group"><input type="text" class="form-control" name="kaliternak[]" value=""><span class="input-group-addon">Kali</span></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" colspan="2"><b>Keuntungan Usaha dalam 1 Bulan</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_untung_ternak[]" value=""></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-sm-12"><br>
                                                        <div class="input-group-btn"> 
                                                            <button class="btn btn-danger" name="hapus_ternak" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus Peternakan</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="tab-pane animation-slide-left" id="jasa" role="tabpanel">
                                    <div class="panel panel-bordered">
                                        <div class="panel-heading text-center">
                                            <h4 class="panel-title">RINCIAN ANALISA JASA</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="tambah_jasa">
                                                <div class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add_jasa"><i class="glyphicon glyphicon-plus"></i>Tambah Jasa</button>
                                                </div>
                                            </div>
                                            <div id="tambah_jasa" data-op="tambah_jasa" hidden>
                                                <div class="row"><br>
                                                    <div class="col-sm-6">
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Jenis Jasa</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="jenis_jasa[]" placeholder="ISI JENIS JASA" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                 </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <table class="table table-bordered">
                                                            <thead style="background-color: grey">
                                                                <th>Pendapatan</th>
                                                                <th colspan="2">Uraian</th>
                                                                <th>Jumlah</th>
                                                            </thead>
                                                            <tbody>
                                                                <td><input type="text" class="form-control" name="jasa[]" value=""></td>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_jasa[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_jasa[]" value=""></td>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="jasa[]" value=""></td>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_jasa[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_jasa[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="jasa[]" value=""></td>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_jasa[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_jasa[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="jasa[]" value=""></td>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_jasa[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_jasa[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="jasa[]" value=""></td>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_jasa[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_jasa[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td></td>
                                                                    <td align="center" colspan="2"><b>Total Pendapatan</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_dapat_jasa[]" value=""></td>
                                                                </tr>
                                                                <tr align="center" style="background-color: grey">
                                                                    <td><b>Biaya-Biaya</b></td>
                                                                    <td><b>Uraian</b></td>
                                                                    <td><b>Jumlah</b></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="jasa_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_jasa_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_jasa_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="jasa_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_jasa_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_jasa_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="jasa_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_jasa_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_jasa_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="jasa_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_jasa_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_jasa_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="jasa_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_jasa_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_jasa_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="jasa_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_jasa_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_jasa_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="jasa_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_jasa_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_jasa_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="jasa_biaya[]" value=""></td>
                                                                    <td><input type="text" class="form-control" name="uraian_jasa_biaya[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_jasa_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td rowspan="4"></td>
                                                                    <td align="center" colspan="2"><b>Sub Total Pengeluaran</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_biaya[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" colspan="2"><b>Keuntungan dalam 1 Bulan</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_untung_jasa[]" value=""></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-sm-12"><br>
                                                        <div class="input-group-btn"> 
                                                            <button class="btn btn-danger" name="hapus_jasa" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus Jasa</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br><br>
                                        </div>
                                    </div>
                                </fieldset>
                                <fieldset class="tab-pane animation-slide-left" id="profesi" role="tabpanel">
                                    <div class="panel panel-bordered">
                                        <div class="panel-heading text-center">
                                            <h4 class="panel-title">RINCIAN ANALISA PROFESI</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="tambah_profesi">
                                                <div class="input-group-btn"> 
                                                    <button class="btn btn-success" type="button" id="add_profesi"><i class="glyphicon glyphicon-plus"></i>Tambah Profesi</button>
                                                </div>
                                            </div>
                                            <div id="tambah_profesi" data-op="tambah_profesi" hidden>
                                                <div class="row"><br>
                                                    <div class="col-sm-6">
                                                        <div class="row form-group">
                                                            <label class="col-sm-3 control-label">Jenis Profesi</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" name="jenis_prof[]" placeholder="ISI JENIS PROFESI" value="" data-toggle="tooltip" data-placement="right" title="" >
                                                                 </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <table class="table table-bordered">
                                                            <thead style="background-color: grey">
                                                                <th>Pendapatan</th>
                                                                <th colspan="2">Uraian</th>
                                                                <th>Jumlah</th>
                                                            </thead>
                                                            <tbody>
                                                                <td><input type="text" class="form-control" name="profesi[]" value=""></td>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_profesi[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_profesi[]" value=""></td>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="profesi[]" value=""></td>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_profesi[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_profesi[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="profesi[]" value=""></td>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_profesi[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_profesi[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="profesi[]" value=""></td>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_profesi[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_profesi[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><input type="text" class="form-control" name="profesi[]" value=""></td>
                                                                    <td colspan="2"><input type="text" class="form-control" name="uraian_profesi[]" value=""></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="jumlah_profesi[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td rowspan="2"></td>
                                                                    <td align="center" colspan="2"><b>Total Pendapatan</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_profesi[]" value=""></td>
                                                                </tr>
                                                                <tr>
                                                                    <td align="center" colspan="2"><b>Pendapatan dalam 1 Bulan</b></td>
                                                                    <td class="input-group"><span class="input-group-addon">Rp.</span><input type="text" class="form-control" name="total_profesi[]" value=""></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="col-sm-12"><br>
                                                        <div class="input-group-btn"> 
                                                            <button class="btn btn-danger" name="hapus_profesi" type="button"><i class="glyphicon glyphicon-remove"></i> Hapus Profesi</button>
                                                        </div>
                                                    </div>
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
       $('#add_tani').click(function(){
            var $template = $('#tambah_tani'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                .appendTo('.tambah_tani');
             $('[name="hapus_tani"]').on('click',function(){
                $(this).closest("div.row").remove();
                    e.preventDefault();;
            });
        });

       $('#add_dagang').click(function(){
            var $template = $('#tambah_dagang'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                .appendTo('.tambah_dagang');
             $('[name="hapus_dagang"]').on('click',function(){
                $(this).closest("div.row").remove();
                    e.preventDefault();;
            });
        });

       $('#add_konstruksi').click(function(){
            var $template = $('#tambah_konstruksi'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                .appendTo('.tambah_konstruksi');
             $('[name="hapus_konstruksi"]').on('click',function(){
                $(this).closest("div.row").remove();
                    e.preventDefault();;
            });
        });

       $('#add_ternak').click(function(){
            var $template = $('#tambah_ternak'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                .appendTo('.tambah_ternak');
             $('[name="hapus_ternak"]').on('click',function(){
                $(this).closest("div.row").remove();
                    e.preventDefault();;
            });
        });

       $('#add_jasa').click(function(){
            var $template = $('#tambah_jasa'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                .appendTo('.tambah_jasa');
             $('[name="hapus_jasa"]').on('click',function(){
                $(this).closest("div.row").remove();
                    e.preventDefault();;
            });
        });

       $('#add_profesi').click(function(){
            var $template = $('#tambah_profesi'),
                $clone    = $template
                                .clone()
                                .removeAttr('hidden')
                                .removeAttr('id')
                                .appendTo('.tambah_profesi');
             $('[name="hapus_profesi"]').on('click',function(){
                $(this).closest("div.row").remove();
                    e.preventDefault();;
            });
        });

    
    });
</script>
@endsection
