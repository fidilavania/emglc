<?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=hasil.xls");
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="{{asset('/bootstrap/css/bootstrap.min.css')}}" media="all" rel="stylesheet">
    <style type="text/css">
    </style>
  </head>
  
  <body>
    <div class="row">
                             <table class="table table-bordered" name="daftarnasabahtable">
                                    <thead>
                                        <th>No</th>
                                        <th>No SDM</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Kantor</th>
                                        <th>Kode Pelatihan</th>
                                        <th>Tanggal Kegiatan</th>
                                        <th>Lokasi Kegiatan</th>
                                        <th>Nomor Sertifikat</th>
                                    </thead>
                                    <hr />
                                    <tbody>
                                        <?php
                                            $no = 0;
                                            foreach ($all as $aa) {
                                                if(substr($aa->tgl_keg, -4) == 2018){
                                                  $no++;
                                                   echo '<td>'.'`'.sprintf("%06s", $no).'</td>';
                                                  echo '<td>'.'`'.$aa->no_sdm.'</td>';
                                                  echo '<td>'.$aa->nama.'</td>';
                                                  echo '<td>'.$aa->jabatan.'</td>';
                                                  echo '<td>'.$aa->kantor.'</td>';
                                                  echo '<td>'.$aa->kode_modul.'</td>';
                                                  echo '<td>'.$aa->tgl_keg.'</td>';
                                                  echo '<td>'.$aa->lokasi_keg.'</td>';
                                                  echo '<td>'.'`'.sprintf("%04s", $no).'</td>';
                                                  echo '</tr>';
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
    </div>
  </body>
</html>