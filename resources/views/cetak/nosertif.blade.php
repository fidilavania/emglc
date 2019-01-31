@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="panelbank">
                <div class="panel-heading"><h4 align="center">BUAT NOMOR SERTIFIKAT</h4></div>
                    <div class="panel-body">
                        <div class="row">
                                
                            <div class="col-sm-12">
                                <table class="table table-bordered" name="daftarnasabahtable">
                                    <thead>
                                        <th>No</th>
                                        <th>No SDM</th>
                                        <th>Nama</th>
                                        <th>Jabatan</th>
                                        <th>Kantor Induk</th>
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
                                                  echo '<td align="center">'.$no.'</td>'; 
                                                  echo '<td>'.$aa->no_sdm.'</td>';
                                                  echo '<td>'.$aa->nama.'</td>';
                                                  echo '<td>'.$aa->jabatan.'</td>';
                                                  echo '<td>'.$aa->induk_kantor.'</td>';
                                                  echo '<td>'.$aa->kantor.'</td>';
                                                  echo '<td>'.$aa->kode_modul.'</td>';
                                                  echo '<td>'.$aa->tgl_keg.'</td>';
                                                  echo '<td>'.$aa->lokasi_keg.'</td>';
                                                  echo '<td>'.sprintf("%04s", $no).'</td>';
                                                  echo '</tr>';
                                                }
                                            }
                                        ?>
                                    </tbody>
                                </table>
                                <input type="button" class="btn btn-primary" name="excel" value="Expor Excel" />
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    $(document).ready(function() {
        $('[name="excel"]').click(function() {
            console.log($(this).parent().parent().find('td:nth-child(2)').text());
            console.log($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'Expor Excel');
            if($(this).parent().parent().find('td:nth-child(2)').text().trim() == 'View'){
                window.location.href = '{{url("/excelsertif")}}';
            } else {
                window.location.href = '{{url("/excelsertif")}}';
            }
        });
    });
</script>
@endsection
