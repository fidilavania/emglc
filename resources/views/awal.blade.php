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
    background-image: url("/pic/bg2.gif");
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
        max-width:500px;
        max-height:320px;
        
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
    }

    .button2 {background-color: #e7e7e7; color: black;} /* Gray */ 
  
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
            <form class="form-horizontal" id="loginform" role="form" method="POST" action="{{ url('/auth/postlogin') }}">
              <input type="hidden" name="_token" value="{{ csrf_token() }}" />
              <br><br><br><br><br>
                <div class="row">
                    <div class="col-sm-7">
                        <div class="row form-group">
                            <div>
                              <button class="button" type="submit" class="btn btn-danger" name="loginbutton">PELATIHAN 1</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <div class="row form-group">
                            <div>
                             <button class="button button2" type="submit" class="btn btn-danger" name=""><a href="{{ url('/welcome') }}">PELATIHAN 2</a></button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
  </div>
  <!-- End Page -->

 <!-- Plugins For This Page -->
  <script src="{{asset('jquery.js')}}"></script>
  <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>


  <script type="text/javascript">
    $(document).ready(function() {
      $("#loginform").submit(function(){
        if(($('[name="inputusername"]').val() == "") || ($('[name="inputpassword"]').val() == "")){
          var content = '<p class="text-danger">Username atau Password tidak boleh kosong</p>';
          $('[name="errorpanel"]').empty();
          $('[name="errorpanel"]').append('<p class="text-danger">Username atau Password tidak boleh kosong</p>');
          $('[name="errorpanel"]').show();
          return false;
        }
      });
      
    });
  </script>
</body>
</html>