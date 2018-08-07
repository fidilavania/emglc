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
              <h4 align="center"><b>Kantor</b></h4>
            </th>
            <th>
              <h4 align="center"><b>Jabatan</b></h4>
            </th>
            <th >
              <h4 align="center"><b>Tanda Tangan</b></h4>
            </th>
          </tr>
        </thead>
        <tbody style="text-transform:uppercase;">
          <?php
            $no = 0;
            foreach ($all as $a) {
              $no++;
              echo '<td align="center">'.$no.'</td>'; 
              echo '<td>'.$a->nama.'</td>';
              echo '<td>'.$a->jenis_kel.'</td>';
              // foreach ($lihat1 as $l ) {
              //   echo '<td>'.$l->nama.'</td>';
              // }
              if(trim($a->kantor,'') == 'TKW'){
                echo '<td>PT BPR Trikarya Waranugraha</td>';
                }else
                if(trim($a->kantor,'') == 'MUKAR'){
                  echo '<td>KSP Mitra Usaha Karangploso</td>';
                }else
                if(trim($a->kantor,'') == 'MUCUNG'){
                  echo '<td>KSP Mitra Usaha Sumberpucung</td>';
                }else
                if(trim($a->kantor,'') == 'MUTU'){
                  echo '<td>KSP Mitra Usaha Turen</td>';
                }else
                if(trim($a->kantor,'') == 'MUJEN'){
                  echo '<td>KSP Mitra Usaha Kepanjen</td>';
                }else
                if(trim($a->kantor,'') == 'ARTH'){
                  echo '<td>KSP Artha Karya Jaya Wajak</td>';
                }else
                if(trim($a->kantor,'') == 'MSP'){
                  echo '<td>PT BPR Mojosari Pahala Pakto</td>';
                }else
                if(trim($a->kantor,'') == 'BPS'){
                  echo '<td>PT BPR Balongpanggang Sentosa</td>';
                }else
                if(trim($a->kantor,'') == 'WPP'){
                  echo '<td>PT BPR Wlingi Pahala Pakto</td>';
                }else
                if(trim($a->kantor,'') == 'APM'){
                  echo '<td>PT BPR Anugerah Paktomas</td>';
                }else
                if(trim($a->kantor,'') == 'BHP'){
                  echo '<td>PT BPR Berkah Pakto</td>';
                }else
                if(trim($a->kantor,'') == 'NICE'){
                  echo '<td>KSP Niaga Cemerlang</td>';
                }else
                if(trim($a->kantor,'') == 'MUK'){
                  echo '<td>KSP Mitra Usaha Kasembon</td>';
                }else
                if(trim($a->kantor,'') == 'KAM'){
                  echo '<td>BPR Kerta Arthamandiri</td>';
                }else
                if(trim($a->kantor,'') == 'SKM'){
                  echo '<td>PT BPR Sukorejo Makmur</td>';
                }else
                if(trim($a->kantor,'') == 'SPG'){
                  echo '<td>PT BPR Swadhanamas Pakto</td>';
                }else
                if(trim($a->kantor,'') == 'RANI'){
                  echo '<td>PT BPR Rogojampi Artha Niaga</td>';
                }else
                if(trim($a->kantor,'') == 'ADA'){
                  echo '<td>PT BPR Ambulu Dhanaartha</td>';
                }else
                if(trim($a->kantor,'') == 'BRK'){
                  echo '<td>PT BPR Binareksa Karyaartha</td>';
                }else
                if(trim($a->kantor,'') == 'BKP'){
                  echo '<td>PT BPR Baskara Pakto</td>';
                }else
                if(trim($a->kantor,'') == 'MAP'){
                  echo '<td>PT BPR Mojoagung Pahala Pakto</td>';
                }else
                if(trim($a->kantor,'') == 'PDA'){
                  echo '<td>PT BPR Puridana Arthamas</td>';
                }else
                if(trim($a->kantor,'') == 'APUNG'){
                  echo '<td>KSP Artha Pundhi Kencana Jombang</td>';
                }else
                if(trim($a->kantor,'') == 'AMANA'){
                  echo '<td>KSP Artha Pundhi Mandiri Nganjuk</td>';
                }else
                if(trim($a->kantor,'') == 'AMIBA'){
                  echo '<td>KSP Artha Pundhi Mandiri Bagor</td>';
                }else
                if(trim($a->kantor,'') == 'ADHITO'){
                  echo '<td>KSP Artha Pundhi Kencana Kertosono</td>';
                }else
                if(trim($a->kantor,'') == 'TAS'){
                  echo '<td>PT BPR Tumpang Artha Sarana</td>';
                }else
                if(trim($a->kantor,'') == 'ANK'){
                  echo '<td>PT BPR Armindo Kencana</td>';
                }else
                if(trim($a->kantor,'') == 'KRP'){
                  echo '<td>PT BPR Karunia Pakto</td>';
                }else
                if(trim($a->kantor,'') == 'MUGAR'){
                  echo '<td>KSP Mitra Usaha Pesanggaran</td>';
                }else
                if(trim($a->kantor,'') == 'MUSO'){
                  echo '<td>KSP Mitra Usaha Bondowoso</td>';
                }else
                if(trim($a->kantor,'') == 'RINA'){
                  echo '<td>KSP Rizki Sakinah</td>';
                }else
                if(trim($a->kantor,'') == 'MUSA'){
                  echo '<td>KSP Mitra Usaha Sumberayu</td>';
                }else
                if(trim($a->kantor,'') == 'MUJO'){
                  echo '<td>KSP Mitra Usaha Jaya Srono</td>';
                }else
                if(trim($a->kantor,'') == 'MUJA'){
                  echo '<td>KSP Mitra Usaha Jajag</td>';
                }else
                if(trim($a->kantor,'') == 'MUBER'){
                  echo '<td>KSP Mitra Usaha Jember</td>';
                }else
                if(trim($a->kantor,'') == 'ABC'){
                  echo '<td>PT Anugerah Buana Central Multifinance</td>';
                }else
                if(trim($a->kantor,'') == 'AKMK'){
                  echo '<td>KSP Artha Karya Mandiri Krian</td>';
                }else
                if(trim($a->kantor,'') == 'AKMS'){
                  echo '<td>KSP Artha Karya Mandiri Singosari</td>';
                }else
                if(trim($a->kantor,'') == 'ABRI'){
                  echo '<td>KSP Abadi Lestari</td>';
                }else
                if(trim($a->kantor,'') == 'WAN'){
                  echo '<td>KSP Wahana Artha Nugra</td>';
                }else
                if(trim($a->kantor,'') == 'ANM'){
                  echo '<td>KSP Artha Niaga Manukan</td>';
                }else
                if(trim($a->kantor,'') == 'APN'){
                  echo '<td>KSP Artha Pundi Ngoro</td>';
                }else{
                  echo '<td>'.$a->kantor.'</td>';
              }
              echo '<td>'.$a->jabatan.'</td>';
              // if($no % 2 == 0){
              //   echo '<td  bgcolor="#FF7F50"></td>';
              //   echo '<td><font size="1">'.$no.'</font></td>';
              // } else {
              //   echo '<td><font size="1">'.$no.'</font></td>';
              //   echo '<td bgcolor="#FF7F50"></td>';
              // }
              echo '<td></td>';
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