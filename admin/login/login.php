<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Log in to your page ">
    <meta name="keywords" content="Fagshop, login, admin">
    <meta name="author" content="Fagshop">
    <title>Admin Login Page</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="../../assets/default/main/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../assets/default/main/css/materialize.css">
    <link rel="stylesheet" type="text/css" href="../../assets/default/main/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../assets/default/main/css/login.css">
    <link rel="stylesheet" type="text/css" href="../../assets/default/main/css/jquery.toast.css">
    <link rel="stylesheet" type="text/css" href="../../assets/default/main/css/color.css">
    <link rel="stylesheet" type="text/css" href="../../assets/default/main/css/animate.css">


    <!--<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
    <script type="text/javascript" src="../../assets/js/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="../../assets/js/login.js"></script>
    
   

    
    
    </head>
  <!-- END: Head-->
  <body class="login-bg" >
    <div class="row">
      <div class="col s12">
        <div class="container">

          <div id="login-page" class="row">

            <div class="col m7 s12 mb-1">

              <h1 class="htext text-center center-align col-light-blue animated fadeIn" style="text-align: center;">
            
                Admin Login  
                
              
              </h1>
            </div>

  <div class="col m4 s12  z-depth-5 card-panel border-radius-6 login-card  animated fadeIn bg-light-blue">

    <form id="login-form" autocomplete="off" >
      <div class="row">
        <div class="input-field col s12">
          <div class="icon-box">
          <img src="../../assets/img/login.png" class="img-responsive">
        </div>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="username" type="text">
          <label for="username" class="center-align">Username</label>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input class="password " id="password" type="password" >
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m12 l12 ml-2 mt-1">
          <div class="row">
             <div class="input-field col s6 m6 l6">
            <label>
              <input type="checkbox" />
              <span>Remember Me</span>
            </label>
          </div>

           <div class="input-field col s6 m6 l6">
            <label>
          <a href="user-forgot-password" class="col-black">Forgot password ?</a>
          </label>
        </div>

          </div>
        </div>
      </div>
      <div class="row logme">
        <div class="input-field col s12">

           <button class="btn  btn-small bg-white col-light-blue  waves-effect waves-light mbtn " name="login_button" value="Login" type="Submit">Login</button>
        
        </div>
      </div>
     <div class="btn_overlay"></div>
    </form>
  </div>



</div>
        </div>
      </div>
    </div>

    <!-- BEGIN VENDOR JS-->
    <script src="../../assets/default/main/js/vendors.min.js" type="text/javascript"></script>
    <script src="../../assets/default/main/js/plugins.js" type="text/javascript"></script>
    <script src="../../assets/default/main/js/customizer.js" type="text/javascript"></script>
    <script src="../../assets/default/main/js/jquery.toast.js" type="text/javascript"></script>
    
  </body>
</html>