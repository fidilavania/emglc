<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
  <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  
<title>LOGIN EMG LEARNING CENTER</title>
<link rel="icon" href="/pic/logo.ico" type="image/x-icon">
<style>
  body{
      min-height: 500px;
      background-image: url("/pic/pilih.jpg");
      background-size: 100%;
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      /*background: #999;*/
      padding: 40px;
      font-family: "Open Sans Condensed", sans-serif;
  }
    #panellogin{
        margin:auto;
        position:absolute; 
        left:0; right:0;
        top:0; bottom:0;
        max-width:700px;
        max-height:300px;
        
        overflow:auto;
    }

      #bg {
      position: fixed;
      left: 0;
      top: 0;
      width: 100%;
      height: 100%;
      background: url(http://lorempixel.com/800/500/nature) no-repeat center center fixed;
      background-size: cover;
      -webkit-filter: blur(5px);    
    }
    #transparan{
      background:#000;opacity:0.4;filter:alpha(opacity=40);
    }

    .button {
      background-color: #008CBA;
      border: none;
      color: white;
      padding: 15px 32px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      font-size: 16px;
      margin: 4px 2px;
      cursor: pointer;
      width: 20em;  height: 5em;

      /*border-radius: 50%;*/
    }

    .button1 {background-color: #CD5C5C;color: white;} 
    .button2 {background-color: #FF8000;color: white;}
    .button3 {background-color: #228B22;color: white;} 
    .openbtn {border-radius: 12px;
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
     background-image: linear-gradient(to right, #000099 , #4682B4);
      }

    {{-- .sidepanel  {
        width: 0;
        position: fixed;
        z-index: 1;
        height: 300px;
        /*top: 0;
        left: 0;*/
        margin: 4px 170px;
        background-image: linear-gradient(to right, #708090 , #4682B4);
        overflow-x: hidden;
        transition: 0.5s;
        padding-top: 60px;
        border-radius: 12px;
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
    }

    .sidepanel a {
        padding: 8px 8px 8px 32px;
        text-decoration: none;
        font-size: 25px;
        color: #ffffff;
        display: block;
        transition: 0.3s;
    }

    .sidepanel a:hover {
        text-shadow: 0 0 3px #FF0000, 0 0 5px #0000FF;
    }

    .sidepanel .closebtn {
        position: absolute;
        top: 0;
        right: 25px;
        font-size: 36px;
    }  --}}
   
    .openbtn {
        font-size: 20px;
        cursor: pointer;
        background-color: #111;
        color: white;
        padding: 10px 15px;
        border: none;
    }

    .openbtn:hover {
        background-color:#444;
    } 

    .overlay {
        height: 100%;
        width: 0;
        position: fixed;
        z-index: 1;
        top: 0;
        left: 0;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0, 0.1);
        overflow-x: hidden;
        transition: 0.5s;
    }

    .overlay-content {
        position: relative;
        top: 25%;
        width: 100%;
        text-align: center;
        margin-top: 30px;
    }

    .overlay a {
        padding: 8px;
        text-decoration: none;
        font-size: 36px;
        color: white;
        text-shadow: 2px 2px 4px #000000;
        display: block;
        transition: 0.3s;
    }

    .overlay a:hover, .overlay a:focus {
        color: #f1f1f1;
        text-shadow: 0 0 3px #FF0000, 0 0 5px #0000FF;
    }

    .overlay .closebtn {
        position: absolute;
        top: 20px;
        right: 45px;
        font-size: 60px;
    }

    @media screen and (max-height: 450px) {
      .overlay a {font-size: 20px}
      .overlay .closebtn {
        font-size: 40px;
        top: 15px;
        right: 35px;
      }
    }
  
</style>
</head>
<body>
 <!-- Page -->
  <div class="transparan1" id="panellogin">
        <!-- Default panel contents -->
        <div class="panel-heading"><h4 align="center"><b></b></h4></div>
        <div class="panel-body">
            <div class="alert alert-danger" name="errorpanel" hidden>
            </div>
            <!-- <form class="form-horizontal" id="loginform" role="form" method="POST" action="{{ url('/auth/postlogin') }}"> -->

              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                <!-- <div class="row">
                  <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="row form-group">
                            <div>
                              <button class="button" type="submit" class="btn btn-danger" name="emg" value="emg">SIAKAD</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row form-group">
                            <div>
                             <button class="button button1" type="submit" class="btn btn-danger" name="graha" value="graha">RBB</button>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="row form-group">
                            <div>
                             <button class="button button3" type="submit" class="btn btn-danger" name="mak" value="foto">ANALISA KREDIT</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row form-group">
                            <div>
                             <button class="button button2" type="submit" class="btn btn-danger" name="foto" value="foto">GALERY FOTO</button>
                            </div>
                        </div>
                    </div>
                  </div>
                </div> -->
                <div class="row">
                    <div class="col-sm-12" align="center">
                      <br><br><button class="openbtn" onclick="openNav()" >☰ PILIH MENU</button>  
                      <div id="myNav" class="overlay">
                        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                        <div class="overlay-content">
                        @if(strpos(Auth::user()->jenis, 'SIAKAD') !== false)
                        <a href='/' name="emg" value="emg"> SIAKAD </a>
                        @endif
                        @if(strpos(Auth::user()->jenis, 'RBB') !== false)
                        <a href='/homerbb' name="graha" value="graha"> RBB </a>
                        @endif
                        @if(strpos(Auth::user()->jenis, 'MAK') !== false)
                        <a href='/mak' name="mak" value="foto"> ANALISA KREDIT </a>
                        @endif
                        @if(strpos(Auth::user()->username, 'vania') !== false)
                        <a href='/fotologin' name="foto" value="foto"> GALERY FOTO </a>
                        @endif
                      </div>
                  </div>
                </div>
            <!-- </form> -->
        </div>
  </div>
  <!-- End Page -->

 <!-- Plugins For This Page -->
  <script src="{{asset('jquery.js')}}"></script>
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>


  <script type="text/javascript">
    // function openNav() {
    //       document.getElementById("mySidepanel").style.width = "350px";
    //   }

    //   function closeNav() {
    //       document.getElementById("mySidepanel").style.width = "0";
    //   }

    function openNav() {
      document.getElementById("myNav").style.width = "30%";
    }

    function closeNav() {
      document.getElementById("myNav").style.width = "0%";
    }
    $(document).ready(function() {

      $('[name="emg"]').click(function() {
            //window.location.href ='{{url("auth/postlogin")}}';
            window.location.href ='{{url("/")}}';
        });

      $('[name="graha"]').click(function() {
            window.location.href ='{{url("/homerbb")}}';
        });

      $('[name="foto"]').click(function() {
            window.location.href ='{{url("/fotologin")}}';
        });

      $('[name="mak"]').click(function() {
            window.location.href ='{{url("/mak")}}';
        });
    });
  </script>
</body>
</html>