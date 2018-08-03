<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>SIAKAD EMG</title>
    <link rel="icon" href="/pic/logo.ico" type="image/x-icon">
 
    <!-- Bootstrap core CSS -->
    <link href="{{asset('/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('/datepicker/dist/css/bootstrap-datepicker.css')}}" rel="stylesheet">
    <link href="{{asset('/select2/dist/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('/fontawesome/css/font-awesome.min.css')}}" rel="stylesheet">

    <style>
      body {
         /*font-family: 'Lato';*/
            min-height: 500px;
            background-image: url("/pic/image.jpg");
            background-attachment:fixed;
            background-size: 100%;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
       /* background-image: url("/pic/image.jpg");
        background-size: 100%;*/
            
        }

      table {
        font-size: 12px;
      }
      
      th {
        border:solid 1px black;
            margin:0px;
            padding:0px;
            border-collapse: collapse;
            border-spacing: 5;
            text-align:center;
            background-color: #ededed;
            
        }
      tr.active td{
            color: red !important;
        } 
        td.angka{
            text-align: right;
        }
        
        /*#header{
            bottom: 10;
            position: fixed;
            top: 10;
            z-index: 100;
            height:20px;
            background-color:#FFFFE0;
            width:1140px;
            -webkit-box-shadow: #666 1px 1px 2px;
            -moz-box-shadow: #666 1px 1px 2px;
            box-shadow:     #666 1px 1px 2px;
            padding:1px;
        }

        #konten {
          padding:5px;
          margin-top:50px;
          margin-bottom:1px;
      }*/

    </style>

  </head>

  <body ng-app="ABCApps">
    <div id="top" class="elevator"></div>
    <div class="container">

      <!-- Static navbar -->
      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/"><img src="/pic/logohome.jpg"></a>
            <a class="navbar-brand" href="/">EMG LEARNING CENTER</a>
          </div>
          <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-left"> 
              
                <li class="">
                  <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data Modul Pelatihan<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                  @if(strpos(Auth::user()->fungsi, '1111') !== false)
                    <li><a href="{{ url('/addmateri') }}">Input Materi</a></li>
                  @endif
                  @if(strpos(Auth::user()->fungsi, '2222') !== false)
                    <li><a href="{{ url('/datamateri') }}">Daftar Materi</a></li> 
                  @endif
                  @if(strpos(Auth::user()->fungsi, '0000') !== false)
                    <li><a href="{{ url('/pendaftaran') }}">Pendaftaran</a></li> 
                  @endif
                    <!-- <li><a>Pendaftaran</a></li>  -->
                </li>
                  </ul>
              @if(strpos(Auth::user()->fungsi, '1111') !== false)
                <li class="">
                <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data Klien<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ url('/addklien') }}">Input Klien</a></li> 
                    <li><a href="{{ url('/dataklien') }}">Daftar Klien</a></li> 
                </li>
                </ul>
              @endif
                <li class="">
                  <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Data SDM<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                  @if(strpos(Auth::user()->fungsi, '0000') !== false)
                    <li><a href="{{ url('/addsdm') }}">Input SDM</a></li> 
                  @endif
                    <li><a href="{{ url('/datasdm') }}">Daftar SDM</a></li> 
                </li>
                  </ul>

                <li class="">
                  <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Resign<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="{{ url('/dataresign') }}">Daftar Resign</a></li> 
                </li>
                  </ul>

                <li class="">
                  <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Laporan<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    @if(strpos(Auth::user()->fungsi, '1111') !== false)
                    <!-- <li><a href="{{ url('/materi') }}">Laporan Kegiatan</a></li>  -->
                    <li><a href="{{ url('/lapsdm') }}">Laporan Data SDM</a></li>
                    @endif
                    <li><a href="{{ url('/piagam') }}">Piagam Kerjasama</a></li> 
                </li>
                  </ul>

              </ul>
            </ul>
            <ul class="nav navbar-nav navbar-right">
            <li class="">
              <a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ Auth::user()->nama_lengkap }} ({{ Auth::user()->kantor }}) <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li class=""><a href="{{ url('auth/logout') }}">Logout<span class="sr-only">(current)</span></a></li>    
               @if(strpos(Auth::user()->fungsi, '2222') !== false)
               <li><a href="{{ url('/addkantor') }}">Daftar Kantor</a></li>
               <li><a href="{{ url('/addjabatan') }}">Daftar Jabatan</a></li>
               @endif
               @if(strpos(Auth::user()->fungsi, '1111') !== false)
               <li><a href="{{ url('/lihatuser') }}">Daftar User</a></li>
               <li><a href="{{ url('/adduser') }}">Input User</a></li>
               @endif
               <li><a href="{{ url('/usullihat') }}">Daftar Usulan</a></li>
               <li><a href="{{ url('/usul') }}">Usulan</a></li>

            </li> 
            </ul>          
            </ul>
            <ul class="nav navbar-nav navbar-right">
                        
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>
    <!-- <div class="alert alert-success" role="alert">Sukses</div> -->
    
   <!--  <div class="progress">
        <div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
          <span class="sr-only">20% Complete</span>
        </div>
    </div> -->
    </div> <!-- /container -->
    <div id="bottom" class="elevator"></div>

    @yield('content')
    <script type="text/javascript"> 

    function stopRKey(evt) { 
      var evt = (evt) ? evt : ((event) ? event : null); 
      var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
      if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
    } 

    document.onkeypress = stopRKey; 

    </script>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    
    <script src="/summernote.css"></script>
    <script src="/summernote.js"></script>
    <script src="/offline/jquery.min.js"></script>
    <script src="/offline/jquery2.min.js"></script>
    <script src="{{asset('/bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="/js/angular.min.js"></script>
    <script src="/js/angular/modul.js"></script>
    <link rel="stylesheet" href="/offline/jquery-ui.css" type="text/css" rel="stylesheet"/>
    <script src="/offline/jquery-1.12.4.js"></script>
    <script src="/offline/jquery-ui.js"></script>
    <script src="{{asset('/jquery_mask/jquery.mask.min.js')}}"></script>
 

    <link rel="stylesheet" href="/offline/development-bundle/themes/base/jquery.ui.all.css">
    <script src="/offline/js/jquery-1.7.1.min.js"></script>
    <script src="/offline/development-bundle/ui/jquery.ui.core.js"></script>
    <script src="/offline/development-bundle/ui/jquery.ui.widget.js"></script>
    <script src="/offline/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <script src="{{asset('/select2/dist/js/select2.full.min.js')}}"></script>
    <link rel="stylesheet" href="/offline/development-bundle/demos/demos.css">
    <script>
    $(function() {
        $( "#datepicker" ).datepicker();
 
    });
    </script>

    <!-- dropdown -->
    <script src="/dropdown/jquery-1.10.2.min.js"></script>
        <script src="/dropdown/jquery.chained.min.js"></script>
        <!-- <script>
            $("#kota").chained("#provinsi");
            $("#kecamatan").chained("#kota");
    </script> -->

    <!-- untuk membuat back to top (gak jadi)-->
    <link rel="stylesheet" href="{{asset('/elev/src/jquery.elevator.css')}}">
    <script src="{{asset('/elev/src/jquery.elevator.js')}}"></script>

    <!-- untuk back to top -->
    <span class='back-to-top'><a href='#'> &#8593; </a></span>
    <!-- <span class='back-to-top-a'><a href='http://contohblognih.blogspot.com/'>CB</a></span> -->
    <style>
      .back-to-top {position: fixed ;bottom:20px;right:10px;z-index:9999999}
      .back-to-top-a {font-size:10px;z-index:9999999;opacity:0.2;position:fixed;bottom:0;}
      .back-to-top a {font-size: 30px ;background-color: #DD3434 ;color:#FFF;-webkit-transition:all .3s ease;-moz-transition:all .3s ease;transition:all .3s ease;padding:12px 18px 20px;text-decoration: none}.back-to-top a:hover {background-color: #272727 ;text-decoration: none}
    </style>
    <!-- end backtotop -->
    @yield('js')
  </body>
</html>
