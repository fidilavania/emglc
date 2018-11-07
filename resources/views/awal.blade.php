<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Loading Bootstrap -->
  <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">

  
<title>EMG LEARNING CENTER</title>
<link rel="icon" href="/pic/logo.ico" type="image/x-icon">
<style>
  body{
    min-height: 500px;
    background-image: url("/pic/welcome.jpg");
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
        max-height:400px;
        
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
      border-radius: 12px;
      -webkit-transition-duration: 0.4s; /* Safari */
      transition-duration: 0.4s;
      cursor: pointer;
      box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);
      
    }
    .button:hover {
      background-color: #A9A9A9;
      color: white;
      box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
      padding-right: 25px;
    }
    .button span {
      cursor: pointer;
      display: inline-block;
      position: relative;
      transition: 0.5s;
    }

    .button span:after {
      content: '\00bb';
      position: absolute;
      opacity: 0;
      top: 0;
      right: -20px;
      transition: 0.5s;
    }
    .button:hover span:after {
      opacity: 1;
      right: 0;
    }

    .button1 {background-color: #CD5C5C;color: white;} 
    .button2 {background-color: #4B0082;color: white;}
    .button3 {background-color: #228B22;color: white;} 
    .button4 {background-color: #FF7F50; color: white; } 
  
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
                <div class="row">
                  <div class="col-sm-12">
                    <div class="col-sm-6">
                        <div class="row form-group">
                            <div>
                              <button class="button" type="submit" class="btn btn-danger" name="emg" value="emg">EMG LEARNING CENTER</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row form-group">
                            <div>
                             <button class="button button1" type="submit" class="btn btn-danger" name="graha" value="graha">GRAHA EMG</button>
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
                             <button class="button button2" type="submit" class="btn btn-danger" name="cafe" value="cafe">CAFETARIA</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row form-group">
                            <div>
                              <button class="button button3" type="submit" class="btn btn-danger" name="digital" value="digital">DIGITAL FINANCIAL SERVICE</button>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="col-sm-3">
                    </div>
                    <div class="col-sm-4">
                        <div class="row form-group">
                            <div>
                             <button class="button button4" type="submit" name="foto" value="cafe">GALERY FOTO</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
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
    $(document).ready(function() {

      $('[name="emg"]').click(function() {
            //window.location.href ='{{url("auth/postlogin")}}';
            window.location.href ='{{url("auth/login")}}';
        });

      $('[name="graha"]').click(function() {
            window.location.href ='{{url("/graha")}}';
        });

      $('[name="cafe"]').click(function() {
            window.location.href ='{{url("/welcome")}}';
        });

      $('[name="digital"]').click(function() {
            window.location.href ='{{url("/welcome")}}';
        });

      $('[name="foto"]').click(function() {
            window.location.href ='{{url("/fotoemg")}}';
        });

      // $("#loginform").submit(function(){
      //   if(($('[name="inputusername"]').val() == "") || ($('[name="inputpassword"]').val() == "")){
      //     var content = '<p class="text-danger">Username atau Password tidak boleh kosong</p>';
      //     $('[name="errorpanel"]').empty();
      //     $('[name="errorpanel"]').append('<p class="text-danger">Username atau Password tidak boleh kosong</p>');
      //     $('[name="errorpanel"]').show();
      //     return false;
      //   }
      // });
      
    });
  </script>
</body>
</html>