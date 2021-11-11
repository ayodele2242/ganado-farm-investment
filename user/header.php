<?php
include('../inc/users.php');  
    $setSql = "SELECT * FROM store_setting";
    $setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
    $set = mysqli_fetch_array($setRes);


if(empty($d['img'])){
  $myimg  = $set['installUrl'].'assets/logo/avatar.png';
}else{
   $myimg = $set['installUrl'].'assets/images/'.$d['img'];
}



?>
<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="admin, dashboard, eCommerce, analytic dashboard, <?php echo $name;  ?>">
    <meta name="author" content="Fagsoft">
    <title><?php echo $name;  ?></title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,900|Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>


    <!--<link rel="stylesheet" type="text/css" media="screen" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" />-->
    
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/mstepper.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/animate.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/chartist.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/chartist-plugin-tooltip.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/materialize.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/style.css">



    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/custom.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/jquery.mCustomScrollbar.css" />
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/animate.min.css" />
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/color.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/table.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/tabs.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/dropify.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/spectrum.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/docs.css">

    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">

    
    
   
   

     

    <!-- -->
     <script type="text/javascript" src="../assets/js/jquery-1.11.1.min.js"></script>
     <script src="../assets/js/jquery.countdown.min.js"></script>
     <script src="../assets/default/main/js/spectrum.js"></script>
     
     

     

     
    <script type="text/javascript">
        $(window).load(function() {
            $(".page-loader-wrapper").fadeOut("slow");
        });
    </script>


<style type="text/css">
    .danger{
        background: #ff4444;
        color: #ffffff;
    }

    .menu-title{
      color: #ffffff;
    }
    a > i.material-icons{
      color: #ffffff;
    }

    #msgs {
         
          height: auto;
          width: auto;
          position: fixed;
          text-align: center;
          justify-content: center;
          align-items: center;
          left: 50%;
          margin-left: -37.5%;
                }
        #msgs {
          z-index: 1090;
        }

        .iheader-text{
          font-weight: bolder;
          font-size: 18px;
        }
.p-6{
  padding: 6px;
}

.disabled {
  pointer-events: none;
  cursor: default;
  opacity: 0.5;
}

.bgreen{
  background: #9acd32;
 
  padding: 7px;
}

.lightgreen{
  background: #dcedc8;
  padding: 7px;
  margin-bottom: 10px;
}

.mrowi{
  background: #fff;
}

.login-page_input input{
  color: #000;
}

::placeholder{
  color: #000;
  font-weight: bold;
  }
label{
font-size: 14px;
font-weight: bolder;
color: #000;
}
</style>



    </head>
     

 
  <!-- END: Head-->
  <body id="welcomeText" class="vertical-modern-menu" >

  <div id="msgs"></div>