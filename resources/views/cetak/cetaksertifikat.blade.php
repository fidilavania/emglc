<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Cetak Sertifikat</title>
    <!-- <link rel="stylesheet" href="/cetak/sertif/css/syle.css"> -->
    <link rel='stylesheet' type='text/css' href='/cetak/sertif/css/style.css' />
    <link rel='stylesheet' type='text/css' href='/cetak/sertif/css/print.css' media="print" />
    <script type='text/javascript' src='/cetak/sertif/js/jquery-1.3.2.min.js'></script>
    <script type='text/javascript' src='/cetak/sertif/js/example.js'></script>

    <style>
        @media print 
        {
            @page {
              size: A4 landscape; 
            }
        }
       
       .container {
            position: relative;
            text-align: center;
            color: black;
        }

        /* Centered text */
        .centered {
            position: absolute;
            top: 51%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        /* Bottom left text */
        .bottom-left {
            position: absolute;
            bottom: 100px;
            left: 90px;
        }

        /* Top left text */
        .top-left {
            position: absolute;
            top: 8px;
            left: 16px;
        }

        /* Top right text */
        .top-right {
            position: absolute;
            top: 8px;
            right: 16px;
        }

        /* Bottom right text */
        .bottom-right {
            position: absolute;
            bottom: 8px;
            right: 16px;
            color: black;
        }

    </style>
  </head>
<body onclick="window.print()">
    @foreach($sertifikat as $a)
    
    <div class="container">
      <img src="/pic/sertif.jpg" alt="Snow" style="width:99%;">
      <!-- <div class="bottom-left">Bottom Left</div>
      <div class="top-left">Top Left</div>
      <div class="top-right">Top Right</div>
      <div class="bottom-right">Bottom Right</div>
      <div class="centered">Centered</div> -->

      <div class="centered">
            <br>
            
            <h3><b>Nomor : {{$a->no_sertif}}/EMG.LC/{{substr($tanggal->tgl_keg,-4)}}</b></h3><br>
            
            <h4>Diberikan Kepada :</h4>
            <h3 style="letter-spacing: 2px;" >{{$a->nama}}</h3>
            <!-- <h3 style="letter-spacing: 2px;" >{{$a->kantor}}</h3> -->
              <?php
                // foreach ($all as $a) {
                    if(trim($a->kantor_kerja,'') == 'TKW'){
                    echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Trikarya Waranugraha</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'MUKAR'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Mitra Usaha Karangploso</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'MUCUNG'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Mitra Usaha Sumberpucung</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'MUTU'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Mitra Usaha Turen</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'MUJEN'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Mitra Usaha Kepanjen</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'ARTH'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Artha Karya Jaya Wajak</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'MSP'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Mojosari Pahala Pakto</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'BPS'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Balongpanggang Sentosa</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'WPP'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Wlingi Pahala Pakto</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'APM'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Anugerah Paktomas</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'BHP'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Berkah Pakto</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'NICE'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Niaga Cemerlang</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'MUK'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Mitra Usaha Kasembon</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'KAM'){
                      echo '<td><h3 style="letter-spacing: 2px;" >BPR Kerta Arthamandiri</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'SKM'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Sukorejo Makmur</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'SPG'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Swadhanamas Pakto</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'RANI'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Rogojampi Artha Niaga</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'ADA'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Ambulu Dhanaartha</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'BRK'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Binareksa Karyaartha</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'BKP'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Baskara Pakto</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'MAP'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Mojoagung Pahala Pakto</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'PDA'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Puridana Arthamas</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'APUNG'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Artha Pundhi Kencana Jombang</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'AMANA'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Artha Pundhi Mandiri Nganjuk</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'AMIBA'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Artha Pundhi Mandiri Bagor</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'ADHITO'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Artha Pundhi Kencana Kertosono</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'TAS'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Tumpang Artha Sarana</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'ANK'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Armindo Kencana</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'KRP'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT BPR Karunia Pakto</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'MUGAR'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Mitra Usaha Pesanggaran</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'MUSO'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Mitra Usaha Bondowoso</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'RINA'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Rizki Sakinah</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'MUSA'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Mitra Usaha Sumberayu</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'MUJO'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Mitra Usaha Jaya Srono</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'MUJA'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Mitra Usaha Jajag</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'MUBER'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Mitra Usaha Jember</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'ABC'){
                      echo '<td><h3 style="letter-spacing: 2px;" >PT Anugerah Buana Central Multifinance</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'AKMK'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Artha Karya Mandiri Krian</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'AKMS'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Artha Karya Mandiri Singosari</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'ABRI'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Abadi Lestari</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'WAN'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Wahana Artha Nugra</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'ANM'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Artha Niaga Manukan</h3></td>';
                    }else
                    if(trim($a->kantor_kerja,'') == 'APN'){
                      echo '<td><h3 style="letter-spacing: 2px;" >KSP Artha Pundi Ngoro</h3></td>';
                    }else{
                      echo '<td><h3 style="letter-spacing: 2px;" >'.$a->kantor_kerja.'</h3></td>';
                    }
                // }
              ?>
            <br><h4>Telah Mengikuti</h4>
            <h2><b>{{trim($materi->nama_modul,' ')}}</b></h2>
            <h3><b>Pada Tanggal : {{trim($tanggal->tgl_keg,' ')}}</b></h3>
            <h3><b>Di : {{trim($tanggal->lokasi_keg,' ')}}</b></h3>
            
      </div>
      <br>
      <div class="bottom-left">
        <strong>
            <table>
                <tr>
                    <th>Trainer</th>
                    <th>:</th>  
                    <th>{{trim($materi->fasilitator,' ')}}</th> 
                </tr>
                <tr>
                    <th>Penyelenggara</th>
                    <th>:</th>  
                    <th>PT Eddy Muljono Group</th> 
                </tr>
                <tr>
                    <th>Direktur</th>
                    <th>:</th>  
                    <th>Setya Hadi Rustomo</th> 
                </tr>
                <tr>
                    <th>Office</th>
                    <th>:</th>  
                    <th>GRAHA EMG - Jl. Raden Tumenggung Suryo No. 32-34. Telp (0341) 404433 - Malang</th> 
                </tr>
            </table>
        </strong>
      </div>
    </div>
    
    @endforeach
</body>
</html>