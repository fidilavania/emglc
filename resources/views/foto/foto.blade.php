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
<form action="{{ url('auth/login') }}" method="POST" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="body-container container-fluid">
    <a class="menu-btn" href="javascript:void(0)">
        <i class="ion ion-grid"></i>
    </a>
    <div class="row justify-content-center">
        <!--=================== side menu ====================-->
        <div class="col-lg-2 col-md-3 col-12 menu_block">

            <!--logo -->
            <div class="logo_box">
                <a href="#">
                    <img src="/pic/emg.png" alt="cocoon">
                </a>
            </div>
            <!--logo end-->

            <!--main menu -->
            <div class="side_menu_section">
                <ul class="menu_nav">
                      <li class="active">
                          <a href="auth/login">
                              Login
                          </a>
                      </li>
                </ul>
            </div>
            <!--main menu end -->

            <!--filter menu -->
            <div class="side_menu_section">
                <!-- <h4 class="side_title">filter by:</h4> -->
                <ul  id="filtr-container"  class="filter_nav">
                    <li  data-filter="*" class="active"><a href="javascript:void(0)" >all</a></li>
                    @foreach($foto as $f)
                    <li data-filter=".branding"> <a href="javascript:void(0)">{{$f->kegiatan}}</a></li>
                    <!-- <li data-filter=".design"><a href="javascript:void(0)">design</a></li>
                    <li data-filter=".photography"><a href="javascript:void(0)">photography</a></li>
                    <li data-filter=".architecture"><a href="javascript:void(0)">architecture</a></li> -->
                    @endforeach
                </ul>
            </div>
            <!--filter menu end -->

            <!--social and copyright -->
            <div class="side_menu_bottom">
                <div class="side_menu_bottom_inner">
                    
                    <div class="copy_right">
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        <p class="copyright">Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | EMG Learning Center</p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </div>
                </div>
            </div>
            <!--social and copyright end -->

        </div>
        <!--=================== side menu end====================-->

        <!--=================== content body ====================-->
        <div class="col-lg-10 col-md-9 col-12 body_block  align-content-center">
            <div class="portfolio">
                <div class="container-fluid">
                    <!--=================== masaonry portfolio start====================-->
                    <div class="grid img-container justify-content-center no-gutters">
                        <div class="grid-sizer col-sm-12 col-md-6 col-lg-3"></div>
                        {{-- @foreach($picture as $f)
                        <div class="grid-item branding  col-sm-12 col-md-6 col-lg-3">
                            <a href="{{$picture}}" title="{{$f->kegiatan}}">
                                <div class="project_box_one">
                                    <img src="{{$galery}}" alt="pro1" height="180" width="150"/>
                                    <div class="product_info">
                                        <div class="product_info_text">
                                            <div class="product_info_text_inner">
                                                <i class="ion ion-plus"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach --}}
                        @foreach ($picture as $picture)
                                   <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                       <img class="d-block w-100" src="{{ $picture['src'] }}" alt="First slide">
                                       <div class="carousel-caption">
                                           <form action="{{ url('picture/' . $picture['name']) }}" method="POST">
                                               {{ csrf_field() }}
                                               {{ method_field('DELETE') }}
                                               <button type="submit" class="btn btn-default">Remove</button>
                                           </form>
                                       </div>
                                   </div>
                        @endforeach
                    </div>
                    <!--=================== masaonry portfolio end====================-->
                </div>
            </div>
        </div>
        <!--=================== content body end ====================-->
    </div>
</div>
</form>


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
</body>
</html>