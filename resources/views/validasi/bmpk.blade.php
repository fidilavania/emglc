@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="panelbank">
                <div class="panel-heading"><h4 align="center">Validasi</h4>
                <!-- <h4 align="center">(Batas Minimal Pembiayaan Kredit)</h4> -->
                </div>
                    <div class="panel-body">
                        <form class="form-horizontal" id="simpanform" role="form" method="POST" action="{{ url('/validasi/$nokredit') }}" >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="row form-group">
                                    <label class="col-sm-3 control-label" name = "pakai" value = "pakai">Tanggal</label>
                                        <div class="col-sm-9">
                                            <div class="input-group date">
                                                <input type="text" id="inputtglpakai" name="input_pakai" class="form-control" value="{{date('d-m-Y')}}" required readonly />
                                            <div class="input-group-addon">
                                                <span class="fa fa-calendar"></span>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row form-group" hidden>
                                        <label class="col-sm-3 control-label">Nomor kredit</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="no_kredit" value="{{trim($kredit->no_kredit,' ')}}" readonly>
                                            </div>
                                    </div>
                                    <div class="row form-group" >
                                        <label class="col-sm-3 control-label">Nomor NUK</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nuk" value="{{$prekredit->no_ref}}" readonly>
                                            </div>
                                    </div>
                                    <div class="row form-group" >
                                        <label class="col-sm-3 control-label">Nomor NPK</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nuk" value="{{$kredit->npk}}" readonly>
                                            </div>
                                    </div>
                                    <div class="row form-group" >
                                        <label class="col-sm-3 control-label">Nama</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="nama" value="{{$prekredit->nama}}" readonly>
                                            </div>
                                    </div>
                                    <div class="row form-group" >
                                        <label class="col-sm-3 control-label">Nomor CIF</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="cif" value="{{$prekredit->no_cif}}" readonly>
                                            </div>
                                    </div>
                                    {{--<div class="row form-group" >
                                        <label class="col-sm-3 control-label">Plafon</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="plafon" value="{{$kredit->plafon}}" readonly>
                                            </div>
                                    </div>
                                    <div class="row form-group" >
                                        <label class="col-sm-3 control-label">Tanggal Kredit</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="tglkredit" value="{{date('d-m-Y',strtotime($kredit->tgl_kredit))}}" readonly>
                                            </div>
                                    </div>
                                    <div class="row form-group" >
                                        <label class="col-sm-3 control-label">Tanggal Jatuh Tempo</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="tgltempo" value="{{date('d-m-Y',strtotime($kredit->jatuhtempo))}}" readonly>
                                            </div>
                                    </div>
                                    <div class="row form-group" >
                                        <label class="col-sm-3 control-label">Jangka Waktu</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="lama" value="{{$kredit->lama}}" readonly>
                                            </div>
                                    </div>--}}
                                </div>
                                <div class="col-sm-6">
                                   <div class="row form-group">
                                        <label class="col-sm-3 control-label">Operator :</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="nama_opr" value="{{trim(Auth::user()->nama_lengkap,' ')}}" readonly>
                                            <!-- <label class="col-sm-9 control-label">{{trim(Auth::user()->nama_lengkap,' ')}}</label> -->
                                        </div>
                                    </div> 
                                    <div class="row form-group" hidden>
                                        <label class="col-sm-3 control-label">Kode Operator :</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="opr" value="{{trim(Auth::user()->jabatan,' ')}}" readonly>
                                            <!-- <label class="col-sm-9 control-label">{{trim(Auth::user()->nama_lengkap,' ')}}</label> -->
                                        </div>
                                    </div>
                                    <div class="row form-group" hidden>
                                        <label class="col-sm-3 control-label">Kode Fungsi :</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="fungsi" value="{{trim(Auth::user()->fungsi,' ')}}" readonly>
                                            <!-- <label class="col-sm-9 control-label">{{trim(Auth::user()->nama_lengkap,' ')}}</label> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row submitbtn1">
                                <!-- <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary" name="simpanbutton">KE KREDIT</button>
                                </div> -->
                        @if(trim(Auth::user()->fungsi,' ')=='1111')
                            <div class="panel-heading"><h4 align="center">SIMULASI KREDIT NASABAH</h4></div><br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-4">
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Administrasi</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_adm" autocomplete="off" value="0" id="ad" id="pesanid"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Provisi</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_provisi" autocomplete="off" value="0" id="pr" id="pesanpr"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Notaris</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_notaris" autocomplete="off" value="0" id="not" id="pesannot"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Polis</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_polis" autocomplete="off" value="0" id="pol" id="pesanpol"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Asuransi Agunan</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_ass" autocomplete="off" value="0" id="as" id="pesanas"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Asuransi Jiwa</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_assjiwa" autocomplete="off" value="0" id="ji" id="pesanji"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Fee Mitra</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_feemitra" autocomplete="off" value="0" id="fe" id="pesanfe"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3 control-label">*Lainnya</label>
                                                    <div class="col-sm-9">
                                                        <div class="input-group">
                                                            <span class="input-group-addon">Rp.</span>
                                                            <input type="text" class="form-control" name="input_biaya_lain" autocomplete="off" value="0" id="lain" id="pesanlain"  required />
                                                        </div>
                                                    </div>
                                                </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">*Jenis Kredit</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" name="input_jeniskredit" required>
                                                    <option value="AR">ARREAR</option>
                                                    <option value="AV">ADVANCE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                          <div class="col-sm-3">
                                              <label class="control-label">*Produk Kredit</label> 
                                          </div>
                                          <div class="col-sm-9">
                                          <select class="form-control" id="inputJenisAngsuran" name="input_jenis_angsuran" required>
                                              <option value="FLAT">Angsuran Flat</option>
                                              <option value="BUNGA">Angsuran Bunga-Bunga</option>
                                              <option value="TARIKSETOR">Tarik Setor</option>
                                              <option value="BUNGATURUN">Bunga Menurun</option>
                                          </select>
                                          </div>
                                        </div>
                                        <div class="row form-group">
                                        <div class="col-sm-3">
                                            <label class="control-label" for="inputJangkaWaktuPembayaran">Pembayaran Pokok Tiap</label> 
                                          </div>
                                          <div class="col-sm-9">
                                            <div class="input-group">
                                              <input type="text" class="form-control" name="input_jangkawaktu_pembayaran" autocomplete="off" value=1 id="bulan" id="pesanbulan" readonly />
                                              <span class="input-group-addon">bulan</span>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row form-group">
                                          <div class="col-sm-3">
                                            <label class="control-label" for="inputJangkaWaktu">*Jangka Waktu</label> 
                                          </div>
                                          <div class="col-sm-9">
                                            <div class="input-group">
                                              <input type="text" class="form-control rincian" id="inputJangkaWaktu" name="input_jangka_waktu" autocomplete="off" value='' required />
                                              <span class="input-group-addon">bulan</span>
                                            </div>
                                          </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Nilai Proyek</label>
                                            <div class="col-sm-9">
                                                 <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type='text' class="form-control" name="input_nilaiproyek" autocomplete="off" value="0" placeholder="0" id="nilpro" id="pesanpro" />
                                                </div>                                        
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Dp</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type='text' class="form-control" name="input_dp" autocomplete="off" value="" placeholder="0" id="dp" id="pesandp" required readonly />
                                                </div>
                                            </div>
                                        </div> 
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Plafon Awal</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type='text' class="form-control" id="inputplafon" name="input_plafon" autocomplete="off" value="" placeholder="0" readonly  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Baki Debet</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type='text' class="form-control" id="inputbaki" name="input_baki" autocomplete="off" value="" placeholder="0" readonly  />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col-sm-3">
                                              <label class="control-label" for="">*Pinjaman Pokok</label>
                                            </div>
                                            <div class="col-sm-9">
                                              <div class="input-group">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control" id="inputPokokHutang" name="input_pokok_hutang" autocomplete="off" value=0  required  />
                                              </div>
                                              <!-- ng-model="pinj_pokok" -->
                                            </div>
                                        </div>
                                        {{--<div class="row form-group" >
                                            <div class="col-sm-3">
                                              <label class="control-label" for="">Total Pokok</label>
                                            </div>
                                            <div class="col-sm-9">
                                              <div class="input-group">
                                                <span class="input-group-addon">Rp.</span>
                                                <input type="text" class="form-control" id="pinjam" autocomplete="off" 
                                                value='{{number_format($totalpokok,0,'','.')}}' readonly />
                                              </div>
                                            </div>
                                        </div>--}}
                                         
                                        <div class="row form-group">
                                            <div class="col-sm-3">
                                                <label class="control-label" for="inputBunga">*Suku Bunga</label> 
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input type="text" class="form-control" id="inputBunga" name="input_bunga" autocomplete="off" value=''  required />
                                                    <span class="input-group-addon">% / bulan</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group pull-right">
                                              <div class="row">
                                                <div class="col-sm-4">
                                                  <button type="button" id="generateTable" class="btn btn-primary">Tampilkan Simulasi</button>
                                                </div>
                                              </div>
                                        </div>
                                    </div>
                                </div> 
  <!--Panel Tabel Pembayaran -->
                            <div class="row">
                                <div class="panel-heading text-center">
                                    <h4 class="panel-title">TABEL SIMULASI PEMBAYARAN</h4>
                                </div><br>
                                <div class="col-sm-12">
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                          <div class="col-sm-3">
                                            <label class="control-label" for="">Angsuran Pokok</label>
                                          </div>
                                          <div class="col-sm-8">
                                            <div class="input-group">
                                              <span class="input-group-addon">Rp.</span>
                                              <input type="text" class="form-control" id="inputAngsuranPokok" name="input_angsuran_pokok" autocomplete="off" value="0" readonly />
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row form-group">
                                          <div class="col-sm-3">
                                            <label class="control-label" for="">Angsuran Bunga</label>
                                          </div>
                                          <div class="col-sm-8">
                                            <div class="input-group">
                                              <span class="input-group-addon">Rp.</span>
                                              <input type="text" class="form-control" id="inputAngsuranBunga" name="input_angsuran_bunga" autocomplete="off" value="0" readonly/>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Saldo BBT</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type='text' class="form-control" name="input_bbt" autocomplete="off" value="0" placeholder="0"  readonly/>
                                                </div>
                                            </div>
                                        </div>  
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Saldo Piutang</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <span class="input-group-addon">Rp.</span>
                                                    <input type='text' class="form-control" name="input_saldo_piutang" autocomplete="off" value="0" placeholder="0"  readonly/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Tanggal NPP Kredit</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name='input_tgl_kredit' value="{{date('d-m-Y')}}" id="tgl_npp" readonly>
                                                </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Tanggal Mulai Angsuran</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name='input_tgl_mulai' value="{{date('d-m-Y')}}" id="tgl_mulai" readonly>
                                                </div>
                                        </div>
                                         <!-- Log::info(input_tgl_mulai) -->
                                        <div class="row form-group">
                                            <label class="col-sm-3 control-label">Tanggal Jatuh Tempo Angsuran</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name='input_tgl_akhir' value="{{date('d-m-Y')}}" id="tgl_tempo" readonly>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div id="tabelPembayaran">
                            </div>
                        @endif
                                @if ($kredit->validasi == '')
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan memvalidasi data ini?')"><h4 align="center">Validasi</h4></button>
                                </div>
                                @endif
                        
                                @if ($kredit->validasi != '')
                                <div class="col-sm-6">
                                    <button type="submit" class="btn btn-primary" name="simpanbutton" onclick="return confirm('Apakah anda yakin akan memvalidasi data ini?')"><h4 align="center">Validasi </h4></button>
                                    <label> Tervalidasi {{$kredit->validasi}} </label>
                                </div>
                                @endif

                            </div>
                        </form>
                    </div>
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
//     function isNumber(nama,pesan) {
//         var val = $('[name="'+nama+'"]').val().replace(/[\s-()]+/g, "");
//         //return !isNaN(parseFloat(val)) && isFinite(val);
//         if(!(!isNaN(parseFloat(val)) && isFinite(val))){
//             $('.errormsg').append('<li class="text-danger">'+pesan+' hanya berisi angka</li>');
//             $('[name="'+nama+'"]').css("background-color", "#F9CECE");
//         }
//     }
//     function checkEmpty(nama,pesan){
//         if($('[name="'+nama+'"]').val() == ''){
//             $('.errormsg').append('<li class="text-danger">'+pesan+' wajib diisi</li>');
//             $('[name="'+nama+'"]').css("background-color", "#F9CECE");
//         }
//     }

// function afterGet(data)
// {
    
// }
// function afterPost(data)
// {
    
// }
function number_format (number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}
$(document).ready(function(){
   
     $('[name="input_biaya_adm"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_biaya_provisi"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_biaya_notaris"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_biaya_polis"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_biaya_ass"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_biaya_assjiwa"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_biaya_feemitra"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_biaya_lain"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     
     $('[name="input_nilaiproyek"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_dp"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_plafon"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_baki"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
     $('[name="input_pokok_hutang"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

     $('[name="input_dp"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});


    $("#tanggalmohon").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalmohonakhir").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalkondisi").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalresawal").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalresakhir").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalnunggak").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tanggalmacet").datepicker({ dateFormat: 'dd-mm-yy' });
    $("#tahunan").datepicker({ dateFormat: 'dd-mm-yy' });

    $("#ft").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanft").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#fr").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanfr").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#ad").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanad").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#pr").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanpr").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#not").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesannot").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#pol").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanpol").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#as").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanas").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#ji").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanji").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#fe").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanfe").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#lain").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanlain").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#bulan").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanbulan").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    // $("#inputJangkaWaktu").keypress(function(data){
    //         if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
    //         {
    //             $("#inputJangkaWaktu").html("isikan angka").show().fadeOut("slow");
    //             return false;
    //         }
    // });
    $("#nilpro").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesanpro").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    $("#dp").keypress(function(data){
            if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
            {
                $("#pesandp").html("isikan angka").show().fadeOut("slow");
                return false;
            }
    });
    // $("#pkk").keypress(function(data){
    //         if(data.which!=8 && data.which!=0 && (data.which<48 || data.which>57))
    //         {
    //             $("#pesanpkk").html("isikan angka").show().fadeOut("slow");
    //             return false;
    //         }
    // });

    $('[name="input_jenis_angsuran"]').on('change', function(){
                if ($(this).val() == "FLAT") {
                  $('[name="input_jangkawaktu_pembayaran"]').val(1);
                  $('[name="input_jangkawaktu_pembayaran"]').prop("readonly",true);
                }
                else if($(this).val() == "BUNGA") {
                  $('[name="input_jangkawaktu_pembayaran"]').removeAttr("readonly");
                }
                else if($(this).val() == "BUNGATURUN") {
                  $('[name="input_jangkawaktu_pembayaran"]').removeAttr("readonly");
                  // $('[name="input_jeniskredit"]').val("AR"),
                  // $('[name="input_jeniskredit"]').prop("readonly",true);
                } else if ($(this).val() == "TARIKSETOR") {
                  $('[name="input_jangkawaktu_pembayaran"]').val(1);
                  $('[name="input_jangkawaktu_pembayaran"]').prop("readonly",true);
                }
           });
    // $('[name="input_bunga"]').mask('00,00', {reverse: true,selectOnFocus: true});
    // $('[name="input_pokok_hutang"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});

    $("#generateTable").click(function(){
          var bungaperbulan = parseFloat($('[name="input_bunga"]').val().split(',').join("."));
          var jangkawaktu = parseInt($('[name="input_jangka_waktu"]').val());
          var jangkawaktupembayaran = parseInt($('[name="input_jangkawaktu_pembayaran"]').val());
          var pokokhutang = parseInt($('[name="input_pokok_hutang"]').val().split('.').join(""));
          
          var dp = Math.ceil((40*pokokhutang)/100);
          $('[name="input_dp"]').val(dp);

          $('[name="input_plafon"]').val(pokokhutang);
          $('[name="input_baki"]').val(pokokhutang);

          var bunga_per_bulan = Math.ceil((pokokhutang*(bungaperbulan/100)));
          var pokok_per_bulan = Math.ceil((pokokhutang/Math.floor(jangkawaktu/jangkawaktupembayaran)));
          if($('[name="input_jenis_angsuran"]').val() == "BUNGATURUN"){
              var bunga_per_bulan = 0;
          }
          if($('[name="input_jenis_angsuran"]').val() == "TARIKSETOR"){
              var bunga_per_bulan = 0;
              var pokok_per_bulan = 0;
        } 


        //memasukkan dalam kolom isian d form
          $('[name="input_angsuran_pokok"]').val(pokok_per_bulan);
          $('[name="input_angsuran_bunga"]').val(bunga_per_bulan);
          
          var d = new Date();
          if (d.getDate() < 10){
            //'0'+
            var dateToday = d.getDate();
          } else { var dateToday = d.getDate(); }
          if ((d.getMonth()+1) < 10){
            //'0'+
            var monthToday = (d.getMonth()+1);
          } else { var monthToday = d.getMonth()+1; }
          var dateNow = dateToday + "-" + monthToday + "-" + d.getFullYear();
          var content = '';
              $('#tabelPembayaran').empty();
                content += '<div class="row"><div class="col-sm-12">';
                    // if($('[name="input_jenis_angsuran"]').val() == "TARIKSETOR"){
                    // }

                    if(($('[name="input_jenis_angsuran"]').val() == "FLAT") || ($('[name="input_jenis_angsuran"]').val() == "BUNGA")){
                        content += '<hr /><table class="table table-striped" style="width:100%;">'+
                                      '<col><colgroup span="4"></colgroup><colgroup span="3"></colgroup>'+
                                      '<tr>'+
                                          '<th colspan="4" scope="colgroup"><h5 align="center">JADWAL</h5></th>'+
                                          '<th colspan="4" scope="colgroup"><h5 align="center">SALDO</h5></th>'+
                                      '</tr>'+
                                      '<tr>'+
                                          '<th scope="col" align="center">Ke</th>'+
                                          '<th scope="col" align="center">Tanggal</th>'+
                                          '<th scope="col" align="center">Angsuran</th>'+
                                          '<th scope="col" align="center">Angs. Pokok</th>'+
                                          '<th scope="col" align="center">Angs. Bunga</th>'+
                                          '<th scope="col" align="center">Saldo Pokok</th>'+
                                          '<th scope="col" align="center">Saldo BBT</th>'+
                                          '<th scope="col" align="center">Saldo Piutang</th>'+
                                      '</tr><tr><td colspan="5"></td>';

                        //coba simpan
                        // content += input('<td>'+$('[name="input_pokok_hutang"]').val()+'</td>')[]row;
                        // <input name="angsuran" value="14000">
                        //endcoba
                        content += '<td>'+$('[name="input_pokok_hutang"]').val()+'</td>';
                        content += '<td>'+(parseFloat($('[name="input_angsuran_bunga"]').val().split('.').join(""))*$('[name="input_jangka_waktu"]').val())+'</td>';
                        content += '<td>'+(parseFloat($('[name="input_pokok_hutang"]').val().split('.').join(""))+parseFloat($('[name="input_angsuran_bunga"]').val().split('.').join(""))*$('[name="input_jangka_waktu"]').val())+'</td></tr>';

                       
                        // Tabel Pembayaran Angsuran
                        var bungaperangsuran = parseFloat($('[name="input_angsuran_bunga"]').val().split('.').join(""));
                        var pokokperangsuran = parseFloat($('[name="input_angsuran_pokok"]').val().split('.').join(""));

                        var saldopokok = parseFloat($('[name="input_pokok_hutang"]').val().split('.').join(""));
                        var saldobbt = bungaperangsuran*$('[name="input_jangka_waktu"]').val();

                        //masuk ke saldo bbt dan piutang
                        $('[name="input_bbt"]').val(saldobbt);
                        $('[name="input_saldo_piutang"]').val(saldopokok+saldobbt) ;
                         //untuk tanggal
                        var after = d.getFullYear() + "-" + monthToday + "-" + dateToday;
                        //bukan tanggal
                        for(var x = 0; x < $('[name="input_jangka_waktu"]').val(); x++){
                          if((x+1) % $('[name="input_jangkawaktu_pembayaran"]').val() == 0){
                            if((saldopokok - pokokperangsuran) < 0){
                              pokokperangsuran += saldopokok - pokokperangsuran;
                            }
                            saldopokok -= pokokperangsuran;
                          } else {
                            saldopokok -= 0;
                          }
                          saldobbt -= bungaperangsuran;
                          var saldopiutang = saldopokok+saldobbt;
                        
                            //end bukan tanggal

                            //tanggal arrear
                            if($('[name="input_jeniskredit"]').val() != "AV"){ //arear
                                var before = after.split('-');
                                if(before[1] == 12) {
                                    var nextMonth = '1';
                                    var nextYear = parseInt(before[0],10)+1;
                                } else {
                                    if ((parseInt(before[1],10)+1) < 10){
                                        //'0'+
                                      var nextMonth = (parseInt(before[1],10)+1);
                                    } else { var nextMonth = parseInt(before[1],10)+1; }
                                    var nextYear = before[0];
                                }
                                var lastDate = new Date(nextYear, nextMonth, 0);
                                if(parseInt(before[2],10) > lastDate.getDate()){
                                    var nextDay = lastDate.getDate();
                                } else {
                                    // var nextDay = before[2];
                                     var nextDay = dateToday;
                                }
                                after = nextYear+'-'+nextMonth+'-'+nextDay;

                                if(x === 0){
                                    $('[name="input_tgl_mulai"]').val(nextDay+"-"+nextMonth+"-"+nextYear);//arear
                                }
                                $('[name="input_tgl_akhir"]').val(nextDay+"-"+nextMonth+"-"+nextYear);

                                content += '<tr><td>'+(x+1)+'</td>'+
                                           '<td>'+nextDay+'-'+nextMonth+'-'+nextYear+'</td>';

                            }else{ //advance

                               var before = after.split('-');
                                if(before[1] == 12) {
                                    var nextMonth = '1';
                                    var nextYear = parseInt(before[0],10)+1;
                                } else {
                                    if ((parseInt(before[1],10)+1) < 10){
                                        //'0'+
                                      var nextMonth = (parseInt(before[1],10)+1);
                                    } else { var nextMonth = parseInt(before[1],10)+1; }
                                    var nextYear = before[0];
                                }
                                var lastDate = new Date(nextYear, parseInt(before[1],10), 0);
                                if(parseInt(before[2],10) > lastDate.getDate()){
                                    var nextDay = lastDate.getDate();
                                } else {
                                    // var nextDay = before[2];
                                     var nextDay = dateToday;
                                }
                                after = nextYear+'-'+nextMonth+'-'+nextDay;


                                $('[name="input_tgl_mulai"]').val(dateNow);//advance
                                $('[name="input_tgl_akhir"]').val(nextDay+"-"+((parseInt(before[1],10)))+"-"+parseInt(before[0],10));

                                content += '<tr><td>'+(x+1)+'</td>'+
                                           '<td>'+nextDay+'-'+(parseInt(before[1],10))+'-'+parseInt(before[0],10)+'</td>';
                            }
                            //end tanggal

                          if((x+1) % $('[name="input_jangkawaktu_pembayaran"]').val() == 0){
                            content += '<td>'+number_format((pokokperangsuran+bungaperangsuran),0,'','.')+'</td>'+'<td>'+number_format(pokokperangsuran,0,'','.')+'</td>';
                          } else {
                            content += '<td>'+number_format(bungaperangsuran,0,'','.')+'</td>'+'<td>0</td>';
                          }
                           // if((x+1) % $('[name="input_jangkawaktu_pembayaran"]').val() == 0){
                          //   content += '<td>'+(input(name="saldopokokototal"(pokokperangsuran+bungaperangsuran)))+'</td>'+'<td>'+(input(name="saldopokokper"(pokokperangsuran)))+'</td>';
                          // } else {
                          //   content += '<td>'+(input(name="bungaper"(bungaperangsuran)))+'</td>'+'<td>0</td>';
                          // }
                          content += 
                                     '<td>'+number_format(bungaperangsuran,0,'','.') +'</td>'+
                                     '<td>'+number_format(saldopokok,0,'','.')+'</td>'+
                                     '<td>'+number_format(saldobbt,0,'','.')+'</td>'+
                                     '<td>'+number_format(saldopiutang,0,'','.')+'</td></tr>';
                                     // '<td>'+ '(input (name="bungaper" value(bungaperangsuran)))' +'</td>'+
                                     // '<td>'+ '(input (name="saldopok"value(saldopokok)))' +'</td>'+
                                     // '<td>'+ '(input (name="saldob" value(saldobbt)))'+'</td>'+
                                     // '<td>'+ '(input (name="saldopiut" value(saldopiutang)))'+'</td></tr>';
                          }
                    //tanggal
                    //}

                        content += '</table>';

                    
                    } 
    //end code. yang bawah gak dipakek

                    //untuk bunga menurun
                    else if ($('[name="input_jenis_angsuran"]').val() == "BUNGATURUN")
                        {
                      content +=  '<hr /><table class="table table-striped" style="width:100%;">'+
                                  '<col><colgroup span="4"></colgroup><colgroup span="3"></colgroup>'+
                                  '<tr>'+
                                      '<th colspan="5" scope="colgroup"><h5 align="center">JADWAL</h5></th>'+
                                      '<th colspan="3" scope="colgroup"><h5 align="center">SALDO</h5></th>'+
                                  '</tr>'+
                                  '<tr>'+
                                      '<th scope="col" align="center">Ke</th>'+
                                      '<th scope="col" align="center">Tanggal</th>'+
                                      '<th scope="col" align="center">Angsuran</th>'+
                                      '<th scope="col" align="center">Angs. Pokok</th>'+
                                      '<th scope="col" align="center">Angs. Bunga</th>'+
                                      '<th scope="col" align="center">Saldo Pokok</th>'+
                                      '<th scope="col" align="center">Saldo BBT</th>'+
                                      '<th scope="col" align="center">Saldo Piutang</th></tr>';


                      // Tabel Pembayaran Angsuran
                      var pokokperangsuran = parseFloat($('[name="input_angsuran_pokok"]').val().split('.').join(""));

                      var saldopokok = parseFloat($('[name="input_pokok_hutang"]').val().split('.').join(""));
                      var saldobbt = 0;
                      var saldo = saldopokok;
                      for(var x = 0; x < $('[name="input_jangka_waktu"]').val(); x++){
                            var bunga = Math.ceil(saldo*(parseFloat($('[name="input_bunga"]').val().split(',').join('.'))/100));
                            saldo -= pokokperangsuran;
                            saldobbt += bunga;
                      }
                      content += '<tr><td colspan="5"></td><td>'+$('[name="input_pokok_hutang"]').val()+'</td><td>'+saldobbt+'</td><td>'+(saldopokok+saldobbt)+'</td></tr>';
                      var after = d.getFullYear() + "-" + monthToday + "-" + dateToday;

                      $('[name="input_bbt"]').val(saldobbt);
                        $('[name="input_saldo_piutang"]').val(saldopokok+saldobbt) ;
                        
                      for(var x = 0; x < $('[name="input_jangka_waktu"]').val(); x++){
                        var saldo = saldopokok;
                        /*if((saldopokok - pokokperangsuran) < 0){
                          pokokperangsuran += saldopokok - pokokperangsuran;
                        }
                        saldopokok -= pokokperangsuran*/
                        if((x+1) % $('[name="input_jangkawaktu_pembayaran"]').val() == 0){
                            if((saldopokok - pokokperangsuran) < 0){
                              pokokperangsuran += saldopokok - pokokperangsuran;
                            }
                            saldopokok -= pokokperangsuran;
                        } else {
                            saldopokok -= 0;
                        }

                    
                        //tanggal arear
                        if($('[name="input_jeniskredit"]').val() != "AV"){
                        var before = after.split('-');
                        if(before[1] == 12) {
                            var nextMonth = '1';
                            var nextYear = parseInt(before[0],10)+1;
                        } else {
                            if ((parseInt(before[1],10)+1) < 10){
                              var nextMonth = (parseInt(before[1],10)+1);
                            } else { var nextMonth = parseInt(before[1],10)+1; }
                            var nextYear = before[0];
                        }
                        var lastDate = new Date(nextYear, nextMonth, 0);
                        if(parseInt(before[2],10) > lastDate.getDate()){
                            var nextDay = lastDate.getDate();
                        } else {
                            var nextDay = dateToday;
                        }
                        after = nextYear+'-'+nextMonth+'-'+nextDay;
                        var diff = lastDate.getDate();
                        //var bunga = Math.ceil(saldo*(parseFloat($('[name="input_bunga"]').val().split(',').join('.'))/100)/30*diff);
                        //var bunga = Math.ceil((saldo*(parseFloat($('[name="input_bunga"]').val().split(',').join('.'))/100)*diff/30));
                        var bunga = Math.ceil(saldo*(parseFloat($('[name="input_bunga"]').val().split(',').join('.'))/100));
                        //var saldobbt = bunga*$('[name="input_jangka_waktu"]').val();
                        //var saldopiutang = saldo+bunga;
                        saldobbt -= bunga;
                        saldopiutang = saldopokok+saldobbt;

                        // var saldobbt = (parseFloat($('[name="input_angsuran_bunga"]').val().split('.').join(""))*$('[name="input_jangka_waktu"]').val());
                        // var saldopiutang = (parseFloat($('[name="input_pokok_hutang"]').val().split('.').join(""))+parseFloat($('[name="input_angsuran_bunga"]').val().split('.').join(""))*$('[name="input_jangka_waktu"]').val());
                        // $('[name="input_bbt"]').val(saldobbt);
                        // $('[name="input_saldo_piutang"]').val(saldopiutang) ;


                        if(x === 0){
                                    $('[name="input_tgl_mulai"]').val(nextDay+"-"+nextMonth+"-"+nextYear);//arear
                                }
                                $('[name="input_tgl_akhir"]').val(nextDay+"-"+nextMonth+"-"+nextYear);

                        content += '<tr><td>'+(x+1)+'</td>'+
                                 '<td>'+nextDay+'-'+nextMonth+'-'+nextYear+'</td>';
                                 //'<td>'+diff+'</td>';
                        }else{
                        var before = after.split('-');
                        if(before[1] == 12) {
                            var nextMonth = '01';
                            var nextYear = parseInt(before[0],10)+1;
                        } else {
                            if ((parseInt(before[1],10)+1) < 10){
                              var nextMonth = '0'+(parseInt(before[1],10)+1);
                            } else { var nextMonth = parseInt(before[1],10)+1; }
                            var nextYear = before[0];
                        }
                        var lastDate = new Date(nextYear, nextMonth, 0);
                        if(parseInt(before[2],10) > lastDate.getDate()){
                            var nextDay = lastDate.getDate();
                        } else {
                            var nextDay = dateToday;
                        }
                        after = nextYear+'-'+nextMonth+'-'+nextDay;
                        var diff = Math.floor((new Date(after) - new Date(before)) / (1000 * 60 * 60 * 24));
                        //var bunga = Math.ceil(saldo*(parseFloat($('[name="input_bunga"]').val().split(',').join('.'))/100)/30*diff);
                        var bunga = Math.ceil(saldo*(parseFloat($('[name="input_bunga"]').val().split(',').join('.'))/100));
                        //var saldobbt = bunga*$('[name="input_jangka_waktu"]').val();
                        //var saldopiutang = saldo+bunga;
                        saldobbt -= bunga;
                        saldopiutang = saldopokok+saldobbt;
                        // var saldobbt = bunga*$('[name="input_jangka_waktu"]').val();
                        // var saldopiutang = (parseFloat($('[name="input_pokok_hutang"]').val().split('.').join(""))+parseFloat($('[name="input_angsuran_bunga"]').val().split('.').join(""))*$('[name="input_jangka_waktu"]').val());
                        // $('[name="input_bbt"]').val(saldobbt);
                        // $('[name="input_saldo_piutang"]').val(saldopiutang) ;


                        $('[name="input_tgl_mulai"]').val(dateNow);//advance
                                $('[name="input_tgl_akhir"]').val(nextDay+"-"+((parseInt(before[1],10)))+"-"+parseInt(before[0],10));

                        content += '<tr><td>'+(x+1)+'</td>'+
                                 '<td>'+nextDay+'-'+(parseInt(before[1],10))+'-'+parseInt(before[0],10)+'</td>';
                                 // '<td>'+diff+'</td>';
                    }
                        if((x+1) % $('[name="input_jangkawaktu_pembayaran"]').val() == 0){
                            content += '<td>'+number_format((pokokperangsuran+bunga),0,'','.')+'</td>'+'<td>'+number_format(pokokperangsuran,0,'','.')+'</td>';
                        } else {
                            content += '<td>'+number_format(bunga,0,'','.')+'</td>'+'<td>0</td>';
                        }
                        content += '<td>'+number_format(bunga,0,'','.')+'</td>'+
                                   '<td>'+number_format(saldopokok,0,'','.')+'</td>'+
                                   '<td>'+number_format(saldobbt,0,'','.')+'</td>'+
                                   '<td>'+number_format(saldopiutang,0,'','.')+'</td></tr>'; 
                        
                      }

                      content += '</table>';
                    }
                    else if ($('[name="input_jenis_angsuran"]').val() == "TARIKSETOR"){

                        var saldobbt = 0;
                        var saldopiutang = 0;
                        $('[name="input_bbt"]').val(saldobbt);
                        $('[name="input_saldo_piutang"]').val(saldopiutang) ;
                    }

              content += '</div></div>';
              
              $('#tabelPembayaran').append(content);  


    // $(document).ready(function() {
        
        // $('[name="input_tgl_akad_awal"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tgl_akad_akhir"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tlg_awal_kredit"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tgl_mulai"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tlg_jthtempo"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tgl_macet"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tgl_nunggak"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tgl_restukturisasi_awl"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tgl_restukturisasi_akhir"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });
        // $('[name="input_tgl_kondisi"]').datepicker({ format: 'dd-mm-yyyy', autoclose: true });

        // $('[name="input_plafon_awal"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        // $('[name="input_real"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        // $('[name="input_denda"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        // $('[name="input_baki_debet"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
        // $('[name="input_nilai_mata_uang_asal"]').mask('000.000.000.000.000', {reverse: true,selectOnFocus: true});
               
        // $('#simpankreditform').on('keyup keypress', function(e) {
        //     var code = e.keyCode || e.which;
        //     if (code == 13) { 
        //         e.preventDefault();
        //         return false;
        //     }
        // });  
        // $('#simpankreditform').submit(function(e){
        //     $('.errormsg').empty();
        //     $('#panelerror').hide();
        //     $('input').css('background-color', 'transparent');
            
            // checkEmpty('input_nom_rekFas','Nomor Rekening Fasilitas');
            // checkEmpty('input_nom_CIF_debitur','Nomor CIF Debitur');
            // checkEmpty('input_kode_sifat_kredit','Kode Sifat Kredit');
            // checkEmpty('input_kode_jenis_kredit','Kode Jenis Kredit');
            // checkEmpty('input_kode_skim','Kode Skim');
            // checkEmpty('input_nom_akad_awal','Nomor Akad Awal');
            // checkEmpty('input_tgl_akad_awal','Tanggal Akad Awal');
            // checkEmpty('input_nom_akad_akhir','Nomor Akad Akhir');
            // checkEmpty('input_tgl_akad_akhir','Tanggal Akad Akhir');
            // checkEmpty('input_baru_perpanjangan','Baru/Perpanjangan');
            // checkEmpty('input_tlg_awal_kredit','Tanggal Awal Kredit');
            // checkEmpty('input_tgl_mulai','Tanggal Mulai');
            // checkEmpty('input_tlg_jthtempo','Tanggal Jatuh Tempo');
            // checkEmpty('input_kode_kategori_debitur','Kode Kategori Debitur');
            // checkEmpty('input_kode_jns_penggunaan','Kode Jenis Penggunaan');
            // checkEmpty('input_kode_orientasi_penggunaan','Kode Orientasi Penggunaan');
            // checkEmpty('input_kode_sektor_eko','Kode Sektor Ekonomi');
            // checkEmpty('input_kode_KotKab','Kode Kota/Kabupaten');
            // checkEmpty('input_nilai_proyek','Nilai Proyek');
            // checkEmpty('input_kode_valuta','Kode Valuta');
            // checkEmpty('input_present_bunga','Persentase Bunga');
            // checkEmpty('input_jns_sukubunga','Jenis Suku Bunga');
            // checkEmpty('input_kredit_prog_pemerintah','Kredit Program Pemerintah');
            // checkEmpty('input_to_dari','Takeover Dari');
            // checkEmpty('input_sumber_dana','Sumber Dana');
            // isNumber('input_plafon_awal','Plafon Awal');
            // isNumber('input_real','Realisasi');
            // isNumber('input_denda','Denda');
            // isNumber('input_baki_debet','Baki Debet');
            // isNumber('input_nilai_mata_uang_asal','Nilai Mata Uang Asal');
            // checkEmpty('input_kode_kolekbilitas','Kode Kolekbilitas');
            // checkEmpty('input_tgl_macet','Tanggal Macet');
            // checkEmpty('input_kode_sebabmacet','Kode Sebab Macet');
            // checkEmpty('input_tgl_nunggak','Tanggal Nunggak');
            // checkEmpty('input_frek_tunggakan','Frekuensi Tunggakan');
            // checkEmpty('input_frek_restukturisasi','Frekuensi Restrukturisasi');
            // checkEmpty('input_tgl_restukturisasi_awl','Tanggal Restrukturisasi Awal');
            // checkEmpty('input_tgl_restrukturisasi_akhr','Tanggal Restrukturisasi Akhir');
            // checkEmpty('input_kode_cara_restrukturisasi','Kode Cara Restrukturisasi');
            // checkEmpty('input_kode_kondisi','Kode Kondisi');
            // checkEmpty('input_tgl_kondisi','Tanggal Kondisi');
            // checkEmpty('input_ket','Keterangan');
            // checkEmpty('input_kode_kantor_cabang','Kode Kantor Cabang');
                       
            // if(SUBM == 0){
            //     if($('.errormsg').is(':empty')){
            //         if(confirm('Apakah anda yakin semua entry sudah benar ?')){
            //             SUBM = 1;
            //             return true;
            //         } else {
            //             return false;
            //         }
            //     } else {
            //         $('#panelerror').show();
            //         return false;
            //     }
            // } else {
            //     return false;
            // }
    });
            
});
</script>
@endsection
