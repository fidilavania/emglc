<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ========== Meta Tags ========== -->
    <meta charset="UTF-8">
    <meta name="description" content="Cocoon -Portfolio">
    <meta name="keywords" content="Cocoon , Portfolio">
    <meta name="author" content="Pharaohlab">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- ========== Title ========== -->
    <title> Galery</title>
    <!-- ========== Favicon Ico ========== -->
    <!--<link rel="icon" href="fav.ico">-->
    <!-- ========== STYLESHEETS ========== -->
    <!-- Bootstrap CSS -->
    <link href="/foto_cocoon/html/assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Fonts Icon CSS -->
    <link href="/foto_cocoon/html/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="/foto_cocoon/html/assets/css/et-line.css" rel="stylesheet">
    <link href="/foto_cocoon/html/assets/css/ionicons.min.css" rel="stylesheet">
    <!-- Carousel CSS -->
    <link href="/foto_cocoon/html/assets/css/slick.css" rel="stylesheet">
    <!-- Magnific-popup -->
    <link rel="stylesheet" href="/foto_cocoon/html/assets/css/magnific-popup.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="/foto_cocoon/html/assets/css/animate.min.css">
    <!-- Custom styles for this template -->
    <link href="/foto_cocoon/html/assets/css/main.css" rel="stylesheet">
</head>
<body>
<div class="loader">
    <div class="loader-outter"></div>
    <div class="loader-inner"></div>
</div>
<form action="{{ url('/savefoto') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="body-container container-fluid">
    <a class="menu-btn" href="javascript:void(0)">
        <i class="ion ion-grid"></i>
    </a>
    <div class="row justify-content-left">
        <!--=================== side menu ====================-->
        <div class="col-lg-2 col-md-3 col-12 menu_block">
            <div class="logo_box">
                <a href="#">
                    <img src="/pic/emg.png" alt="cocoon">
                </a>
            </div>
            <div class="side_menu_section">
                <ul class="menu_nav">
                      <li class="active">
                          <a href="/fotologin">
                              Welcome <br> {{ Auth::user()->nama_lengkap }} ({{ Auth::user()->kantor }})
                          </a>
                      </li>
                      <li class="">
                          <a href="/fotologin">
                              Home
                          </a>
                      </li>
                      <li class="">
                        @if(strpos(Auth::user()->kantor, 'EMG') !== false)
                          <a href="/upload">
                              Upload
                          </a>
                        @endif
                      </li>
                      <li class="">
                          <a href="auth/logout">
                              Logout
                          </a>
                      </li>
                </ul>
            </div>
            <div class="side_menu_section">
                <ul  id="filtr-container"  class="filter_nav">
                    <li  data-filter="*" class="active"><a href="javascript:void(0)" >all</a></li>
                    @foreach($foto as $f)
                    <li data-filter=".branding"> <a href="javascript:void(0)">{{$f->kegiatan}}</a></li>
                   
                    @endforeach
                </ul>
            </div>
            <div class="side_menu_bottom">
                <div class="side_menu_bottom_inner">
                    
                    <div class="copy_right">
                        <p class="copyright">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | EMG Learning Center</p>
                    </div>
                </div>
            </div>
        </div>
        <!--=================== side menu end====================-->

        <!--=================== content body ====================-->
        <div class="col-lg-10 col-md-9 col-12 body_block  align-content-center">
            <div class="portfolio">
                <div class="container-fluid">
                    <!--=================== masaonry portfolio start====================-->
                    <div class="grid img-container justify-content-center no-gutters">
                        <div class="grid-sizer col-sm-12 col-md-6 col-lg-3"></div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Operator</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="opr" autocomplete="off" value="{{ trim(Auth::user()->nama_lengkap,' ') }}" style="text-transform:uppercase;" readonly />
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Tanggal</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="input_tanggal_mohon" id="tanggalmohon" value="{{date('d-m-Y')}}" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nama Kegiatan</label>
                                    <div class="col-sm-9">
                                      <input type="text" class="form-control" name="kegiatan" placeholder="Isi Nama Kegiatan" value="">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 control-label">Nama Kantor</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="kantor" style="height:50px" required>
                                                <option value>-Pilih Nama UB-</option>
                                                    @foreach($kantor as $kan)  
                                                        <option value="{{$kan->kode_kantor}}">{{$kan->nama}}</option>
                                                    @endforeach
                                            </select>
                                        </div>
                                </div>
                            </div>
                        </div>
                        <div class="input-group control-group increment" >
                          <input type="file" name="filename" class="form-control">
                          <div class="input-group-btn"> 
                            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
                          </div>
                        </div>
                        <div class="clone hide">
                          <div class="control-group input-group" style="margin-top:10px">
                            <input type="file" name="filename" class="form-control">
                            <div class="input-group-btn"> 
                              <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
                            </div>
                          </div>
                        </div>

                        <br>
                        <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
                    </div>

                    <!--=================== masaonry portfolio end====================-->
                </div>
            </div>
        

        </div>
        <!--=================== content body end ====================-->
    </div>
</div>
</form>


@yield('content')
<!-- jquery -->
<script src="/foto_cocoon/html/assets/js/jquery.min.js"></script>
<!-- bootstrap -->
<script src="/foto_cocoon/html/assets/js/popper.js"></script>
<script src="/foto_cocoon/html/assets/js/bootstrap.min.js"></script>
<script src="/foto_cocoon/html/assets/js/waypoints.min.js"></script>
<!--slick carousel -->
<script src="/foto_cocoon/html/assets/js/slick.min.js"></script>
<!--Portfolio Filter-->
<script src="/foto_cocoon/html/assets/js/imgloaded.js"></script>
<script src="/foto_cocoon/html/assets/js/isotope.js"></script>
<!-- Magnific-popup -->
<script src="/foto_cocoon/html/assets/js/jquery.magnific-popup.min.js"></script>
<!--Counter-->
<script src="/foto_cocoon/html/assets/js/jquery.counterup.min.js"></script>
<!-- WOW JS -->
<script src="/foto_cocoon/html/assets/js/wow.min.js"></script>
<!-- Custom js -->
<script src="/foto_cocoon/html/assets/js/main.js"></script>

<script type="text/javascript">
$(document).ready(function() {

      $(".btn-success").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });
</script>

@yield('js')
</body>
</html>