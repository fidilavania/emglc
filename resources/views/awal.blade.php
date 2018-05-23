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
    }

    .button1 {background-color: #CD5C5C;color: white;} 
    .button2 {background-color: #4B0082;color: white;}
    .button3 {background-color: #228B22;color: white;} 
  
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
            window.location.href ='{{url("/welcome")}}';
        });

      $('[name="cafe"]').click(function() {
            window.location.href ='{{url("/welcome")}}';
        });

      $('[name="digital"]').click(function() {
            window.location.href ='{{url("/welcome")}}';
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