<!doctype html>
<html lang="en" moznomarginboxes mozdisallowselectionprint>
  <head>
    <meta charset="UTF-8">
    <title>Cetak Pendaftaran</title>
    <link rel="stylesheet" href="/cetak/css1/boot.css">
    <style>
      @import url(href="/cetak/css1/boot.css");
      body, h1, h2, h3, h4, h5, h6{
      font-family: 'Bree Serif', serif;
      }
      header
        {
        display: none;
        }
    </style>
  </head>
  
  <body href="#" onclick="window.print()">
    <div class="container">
      <div class="row">
        <div class="col-xs-6">
          <h1>
            <img src="/pic/emg.png" height="110" width="110" href="#" onclick="window.print()">
          </h1>
        </div>
        <div class="col-xs-6 text-right">
          <br>
          <img src="/pic/ATM-logo.jpg" height="90" width="180" href="#" onclick="window.print()"> 
          <!-- <h1>EMG LEARNING CENTER</h1> -->
          <h1><small>Formulir Pendaftaran</small></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-5">
          <div class="panel panel-default">
            <div class="panel-default">
              <h4 align="center">{{trim($materi->nama_modul,' ')}}  <a href="#"></a></h4>
            </div>
            <div class="panel-body">
              <p>
                Tanggal&nbsp: {{$peserta->tgl_keg}} <br>
                Lokasi&nbsp&nbsp&nbsp: {{$peserta->lokasi_keg}} <br>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xs-5 col-xs-offset-2 text-center">
          <div class="panel panel-default">
            <div class="panel-default">
              @foreach($lihat1 as $l)
                <h3><b>{{$l->nama}}</b></h3>
              @endforeach
            </div>
          </div>
        </div>
      </div>
      <p><h4>Menyetujui Surat Penawaran No :  _________________________________________</h4></p>
      <p><h4>Kami mendaftarkan peserta sebagai berikut :</h4></p>
      <!-- / end client details section -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th colspan="2">
              <h4 align="center"><b>Nama</b></h4>
            </th>
            <!-- <th>
              <h4 align="center"><b>Kantor</b></h4>
            </th> -->
            <th>
              <h4 align="center"><b>Jabatan</b></h4>
            </th>
            <th>
              <h4 align="center"><b>Jenis Kelamin</b></h4>
            </th>
          </tr>
        </thead>
        <tbody>
            @if(isset($peserta))
            @foreach($datasdm as $data)
                <tr>
                    <td data-id="{{$peserta->kode_modul}}" colspan="2" >{{$data->nama}}</td>
                    <!-- <td>{{$data->kantor}}</td> -->
                    <td>{{$data->jabatan}}</td>
                    <td>{{$data->jenis_kel}}</td>                        
                </tr>
            @endforeach
            @endif
        </tbody>
      </table>
      <div class="row text-right">
        <div class="col-xs-2 col-xs-offset-8">
          <!-- <p>
            <strong>
            Sub Total : <br>
            TAX : <br>
            Total : <br>
            </strong>
          </p> -->
        </div>
        <div class="col-xs-2">
          <strong>
          <!-- $1200.00 <br>
          N/A <br>
          $1200.00 <br> -->
          </strong>
        </div>
      </div>
      <br><br>
      <div class="row">
        <div class="col-xs-5">
          <!-- <div class="panel panel"> -->
            <!-- <div class="panel-body"> -->
              <p align="center"><b>{{date('d-m-Y')}}</b></p>
              <br><br><br><br>
              <p align="center">________________________</p>
              <p align="center"><b>Direksi / Pimpinan</b></p>
            <!-- </div> -->
          <!-- </div> -->
        </div>
      </div>
    </div>
  </body>
</html>