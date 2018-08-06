<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Cetak Daftar Hadir</title>
    <link rel="stylesheet" href="/cetak/css1/boot.css">
    <style>
      /*@import url(href="/cetak/css1/boot.css");
      body, h1, h2, h3, h4, h5, h6{
      font-family: 'Bree Serif', serif;
      }
      header
        {
        display: none;
        }*/
    </style>
  </head>
  
  <body href="#" onclick="window.print()">
    <div class="container">
      <div class="row">
        <div class="col-xs-6">
            <img src="/pic/emg.png" height="80" width="80" href="#" onclick="window.print()">
        </div>
        <div class="col-xs-6 text-right">
          <img src="/pic/ATM-logo.jpg" height="80" width="170" href="#" onclick="window.print()"> 
          <!-- <h1>EMG LEARNING CENTER</h1> -->
          <!-- <h1><small>Formulir Pendaftaran</small></h1> -->
        </div>
      </div>
      <div class="row" align="center">
        <div class="col-sm-12">
          <!-- <div class="panel panel-default"> -->
            <!-- <div class="panel-default"> -->
              <h4><b>DAFTAR HADIR PESERTA</b></h4>
              <h4 align="center"><b>{{trim($materi->nama_modul,' ')}}</b><a href="#"></a></h4>
            <!-- </div> -->
          <!-- </div> -->
        </div>
      </div>
      <!-- / end client details section -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              <h4 align="center"><b>No.</b></h4>
            </th>
            <th>
              <h4 align="center"><b>Nama</b></h4>
            </th>
            <th>
              <h4 align="center"><b>Jenis Kelamin</b></h4>
            </th>
            <th>
              <h4 align="center"><b>Unit Bisnis</b></h4>
            </th>
            <th>
              <h4 align="center"><b>Jabatan</b></h4>
            </th>
            <th colspan="2" width="400px">
              <h4 align="center"><b>Tanda Tangan</b></h4>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
            $no = 0;
            foreach ($all as $a) {
              $no++;
              echo '<td align="center">'.$no.'</td>'; 
              echo '<td>'.$a->nama.'</td>';
              echo '<td>'.$a->jenis_kel.'</td>';
              echo '<td>'.$a->kantor.'</td>';
              echo '<td>'.$a->jabatan.'</td>';
              if($no % 2 == 0){
                echo '<td  bgcolor="#FF7F50"></td>';
                echo '<td><font size="1">'.$no.'</font></td>';
              } else {
                echo '<td><font size="1">'.$no.'</font></td>';
                echo '<td bgcolor="#FF7F50"></td>';
              }
              echo '</tr>';
            }
          ?>
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
             <!--  <p align="center"><b>{{date('d-m-Y')}}</b></p>
              <br><br><br><br>
              <p align="center">________________________</p>
              <p align="center"><b>Direktur Utama</b></p> -->
        </div>
      </div>
    </div>
  </body>
</html>