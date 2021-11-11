<?php
//error_reporting(0);
include('inc/fetch.php');

if(isset($_GET['pid'])){
   $p = $_GET['pid'];
    $qu = mysqli_query ($mysqli,"SELECT name, link FROM navigation_bar where  link = '$p'");
    $getc = mysqli_num_rows($qu);
    $pt = mysqli_fetch_array($qu);  
}  




//get page content

$pcont = mysqli_query($mysqli,"select * from mp_pages where nav_id = '".$pt['link']."'");
$cget = mysqli_fetch_array($pcont);
//echo $cget['page_title'];
//session_destroy(); 

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="description" content="<?php echo $set['descr']; ?>">
    <meta name="author" content="<?php echo $set['storeName']; ?>">
    <meta name="keyword" content="<?php echo $set['keywords']; ?>">
    <link rel="icon"  href="<?php echo $set['installUrl'].'assets/logo/'.$set['logo']; ?>" type="image/x-icon" />
    
    <script class='remove'>
     if('serviceWorker' in navigator) {
  navigator.serviceWorker
  .register('./service.js')
  .then(function() {
    console.log("Service Worker registered successfully");
  })
  .catch(function() {
    console.log("Service worker registration failed")
  });
}
    </script>
    

    
<link rel="manifest" href="manifest.json">

<meta name="mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="application-name" content="Ganado Farms">
<meta name="apple-mobile-web-app-title" content="Ganado Farms">
<meta name="theme-color" content="#547323">
<meta name="msapplication-navbutton-color" content="#547323">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<meta name="msapplication-starturl" content="/index.php">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link rel="icon" type="image/png" sizes="16x16" href="Icon-16.png">
<link rel="apple-touch-icon" type="image/png" sizes="16x16" href="Icon-16.png">
<link rel="icon" type="image/png" sizes="20x20" href="Icon-20.png">
<link rel="apple-touch-icon" type="image/png" sizes="20x20" href="Icon-20.png">
<link rel="icon" type="image/png" sizes="29x29" href="Icon-29.png">
<link rel="apple-touch-icon" type="image/png" sizes="29x29" href="Icon-29.png">
<link rel="icon" type="image/png" sizes="32x32" href="Icon-32.png">
<link rel="apple-touch-icon" type="image/png" sizes="32x32" href="Icon-32.png">
<link rel="icon" type="image/png" sizes="40x40" href="Icon-40.png">
<link rel="apple-touch-icon" type="image/png" sizes="40x40" href="Icon-40.png">
<link rel="icon" type="image/png" sizes="48x48" href="Icon-48.png">
<link rel="apple-touch-icon" type="image/png" sizes="48x48" href="Icon-48.png">
<link rel="icon" type="image/png" sizes="50x50" href="Icon-50.png">
<link rel="apple-touch-icon" type="image/png" sizes="50x50" href="Icon-50.png">
<link rel="icon" type="image/png" sizes="55x55" href="Icon-55.png">
<link rel="apple-touch-icon" type="image/png" sizes="55x55" href="Icon-55.png">
<link rel="icon" type="image/png" sizes="57x57" href="Icon-57.png">
<link rel="apple-touch-icon" type="image/png" sizes="57x57" href="Icon-57.png">
<link rel="icon" type="image/png" sizes="58x58" href="Icon-58.png">
<link rel="apple-touch-icon" type="image/png" sizes="58x58" href="Icon-58.png">
<link rel="icon" type="image/png" sizes="60x60" href="Icon-60.png">
<link rel="apple-touch-icon" type="image/png" sizes="60x60" href="Icon-60.png">
<link rel="icon" type="image/png" sizes="64x64" href="Icon-64.png">
<link rel="apple-touch-icon" type="image/png" sizes="64x64" href="Icon-64.png">
<link rel="icon" type="image/png" sizes="72x72" href="Icon-72.png">
<link rel="apple-touch-icon" type="image/png" sizes="72x72" href="Icon-72.png">
<link rel="icon" type="image/png" sizes="76x76" href="Icon-76.png">
<link rel="apple-touch-icon" type="image/png" sizes="76x76" href="Icon-76.png">
<link rel="icon" type="image/png" sizes="80x80" href="Icon-80.png">
<link rel="apple-touch-icon" type="image/png" sizes="80x80" href="Icon-80.png">
<link rel="icon" type="image/png" sizes="87x87" href="Icon-87.png">
<link rel="apple-touch-icon" type="image/png" sizes="87x87" href="Icon-87.png">
<link rel="icon" type="image/png" sizes="88x88" href="Icon-88.png">
<link rel="apple-touch-icon" type="image/png" sizes="88x88" href="Icon-88.png">
<link rel="icon" type="image/png" sizes="100x100" href="Icon-100.png">
<link rel="apple-touch-icon" type="image/png" sizes="100x100" href="Icon-100.png">
<link rel="icon" type="image/png" sizes="114x114" href="Icon-114.png">
<link rel="apple-touch-icon" type="image/png" sizes="114x114" href="Icon-114.png">
<link rel="icon" type="image/png" sizes="120x120" href="Icon-120.png">
<link rel="apple-touch-icon" type="image/png" sizes="120x120" href="Icon-120.png">
<link rel="icon" type="image/png" sizes="128x128" href="Icon-128.png">
<link rel="apple-touch-icon" type="image/png" sizes="128x128" href="Icon-128.png">
<link rel="icon" type="image/png" sizes="144x144" href="Icon-144.png">
<link rel="apple-touch-icon" type="image/png" sizes="144x144" href="Icon-144.png">
<link rel="icon" type="image/png" sizes="152x152" href="Icon-152.png">
<link rel="apple-touch-icon" type="image/png" sizes="152x152" href="Icon-152.png">
<link rel="icon" type="image/png" sizes="167x167" href="Icon-167.png">
<link rel="apple-touch-icon" type="image/png" sizes="167x167" href="Icon-167.png">
<link rel="icon" type="image/png" sizes="172x172" href="Icon-172.png">
<link rel="apple-touch-icon" type="image/png" sizes="172x172" href="Icon-172.png">
<link rel="icon" type="image/png" sizes="180x180" href="Icon-180.png">
<link rel="apple-touch-icon" type="image/png" sizes="180x180" href="Icon-180.png">
<link rel="icon" type="image/png" sizes="196x196" href="Icon-196.png">
<link rel="apple-touch-icon" type="image/png" sizes="196x196" href="Icon-196.png">
<link rel="icon" type="image/png" sizes="256x256" href="Icon-256.png">
<link rel="apple-touch-icon" type="image/png" sizes="256x256" href="Icon-256.png">
<link rel="icon" type="image/png" sizes="512x512" href="Icon-512.png">
<link rel="apple-touch-icon" type="image/png" sizes="512x512" href="Icon-512.png">
<link rel="icon" type="image/png" sizes="1024x1024" href="Icon-1024.png">
<link rel="apple-touch-icon" type="image/png" sizes="1024x1024" href="Icon-1024.png">
<link rel="icon" type="image/png" sizes="36x36" href="Icon-36.png">
<link rel="apple-touch-icon" type="image/png" sizes="36x36" href="Icon-36.png">
<link rel="icon" type="image/png" sizes="96x96" href="Icon-96.png">
<link rel="apple-touch-icon" type="image/png" sizes="96x96" href="Icon-96.png">
<link rel="icon" type="image/png" sizes="192x192" href="Icon-192.png">
<link rel="apple-touch-icon" type="image/png" sizes="192x192" href="Icon-192.png">
    
    
        <meta name="theme-color" content="#557220" />
		<meta name="msapplication-navbutton-color" content="#557220" />
		<meta name="apple-mobile-web-app-status-bar-style" content="#557220" />

    <title> <?php if(!empty($pt['name'])){ echo ucwords($pt['name']); }else { echo "Ganado Farm"; }   ?></title>

  <!-- Font Awesome -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Bootstrap core CSS -->
  <link href="assets/mdb/css/bootstrap.min.css" rel="stylesheet">
  <!-- Material Design Bootstrap -->
  <link href="assets/mdb/css/mdb.min.css" rel="stylesheet">
  <!-- Your custom styles (optional) -->
  <link href="assets/mdb/css/style.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/default/main/css/animate.css">
  <link rel="stylesheet" type="text/css" href="assets/default/main/css/animate.min.css" />
  <link rel="stylesheet" type="text/css" href="assets/default/main/css/color.css">
  <link rel="stylesheet" type="text/css" href="assets/default/css/menu.css">
  <link rel="stylesheet" type="text/css" href="assets/default/main/css/table.css">
  <link rel="stylesheet" type="text/css" href="assets/default/main/css/rtabs.css">
  <link rel="stylesheet" type="text/css" href="assets/default/main/css/login.css">
  <link rel="stylesheet" type="text/css" href="assets/default/main/css/chatbox.css">
  <link rel="stylesheet" type="text/css" href="assets/css/singlePage.css">
  <link href="assets/lib/ionicons/css/ionicons.min.css" rel="stylesheet">
  <link href="assets/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  <link href="assets/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/default/main/css/registrationForm_upload.css">
   <link rel="stylesheet" type="text/css" href="pages-materialize.css">
 <!-- <link rel="stylesheet" href="assets/themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="assets/themes/light/light.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="assets/themes/dark/dark.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="assets/themes/bar/bar.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="assets/themes/nivo-slider.css" type="text/css" media="screen" />-->


<script type="text/javascript" src="https://www.app.gapp.ng/assets/js/jquery-1.11.1.min.js"></script>


    


 <script type="text/javascript">
   $(document).ready(function()
{
$("#sbtn").show();

var cvalue = $("#isCActive").val();

if(cvalue == ""){
  $("#uDetails").show();
  $("#chat-input").prop('disabled',true);
  //$("#chat-input").append("Enter your info to start chatting");

}else{
   $("#chat-input").prop('disabled',false);;
   $("#uDetails").hide();
}


});
 </script>  

<style type="text/css">
  body {
    padding: 0;
    margin: 0;
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
          z-index: 1030;
        }

.title{
font-weight: bolder;
font-size: 23px;

  }
.hide{
  display: none;
}

  <?php 
if(!empty($cget['css'])){ echo $cget['css']; }
?>
</style>



 
</head>

<body>



<!--Modal: modalCookie-->
<div class="modal fade top" id="modalCookie1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true" data-backdrop="true">
  <div class="modal-dialog modal-frame modal-top modal-notify modal-info" role="document">
    <!--Content-->
    <div class="modal-content">
      <!--Body-->
      <div class="modal-body">
        <div class="row d-flex justify-content-center align-items-center">

<div class="" align="center">

         <div class="input-group lg-form form-lg form-2 pl-0">
  <input class="form-control my-0 py-1 lime-border" type="text" placeholder="Search" aria-label="Search">
  <div class="input-group-append">
    <span class="input-group-text lime lighten-2" id="basic-text1"><a href="#" id="search"><i class="fa fa-search text-grey"
        aria-hidden="true"></i></a></span>
  </div>
</div>

</div>

          
        </div>
      </div>
    </div>
    <!--/.Content-->
  </div>
</div>
<!--Modal: modalCookie-->


<div id="msgs"></div>

<!--Modal: modal30-->


