@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-primary" id="panelbank">
                <div class="panel-heading"><h4 align="center">LAPORAN DATA SDM</h4></div>
                    <div class="panel-body">
                        <div class="row">
                                @foreach($listall as $all)
                                <div class="panel-heading"><b>Total Seluruh Data Entry : {{$all->total}} SDM</b></div>
                                @endforeach
                            <div class="col-sm-12">
                                <table class="table table-bordered" name="daftarnasabahtable">
                                    <thead>
                                        <th>No</th>
                                        <th>Kode Kantor</th>
                                        <th>Nama Kantor</th>
                                        <th>Jumlah Data Entry</th>
                                        
                                    </thead>
                                    <hr />
                                    <tbody>
                                        <?php
                                            $no = 0;
                                            foreach ($nsblist as $nsb) {
                                              $no++;
                                              echo '<td align="center">'.$no.'</td>'; 
                                              echo '<td>'.$nsb->kode_kantor.'</td>';
                                              echo '<td>'.$nsb->nama.'</td>';
                                              echo '<td align="center">'.$nsb->total.'</td>';
                                              echo '</tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
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
        
    });
</script>
@endsection
