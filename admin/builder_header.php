<?php
include('../inc/admins.php');  


// Set your cookie before redirecting to the login page
setcookie("redirect","", time()-3600);
$current_page = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$expire=time() + (86400 * 30);
setcookie("redirect", $current_page, $expire, "/");
?>
<!DOCTYPE html>

<html class="loading" lang="en" data-textdirection="ltr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="admin, dashboard, eCommerce, analytic dashboard, <?php echo $name;  ?>">
    <meta name="author" content="Fagshop">
    <title><?php echo $name;  ?></title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/favicon/apple-touch-icon-152x152.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/favicon/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,700,900|Roboto+Condensed:400,300,700' rel='stylesheet' type='text/css'>
        
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/animate.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/chartist.min.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/materialize.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/dashboard-modern.css">
    <!--<link rel="stylesheet" type="text/css" href="../assets/default/main/css/form-wizard.css">-->
    <link rel="stylesheet" type="text/css" href="../assets/default/main/css/custom.css">
   
    
    <!--//Page Builder-->
    <link rel="stylesheet" href="../assets/page_builder/css/style.css">
    <link rel="stylesheet" href="../assets/page_builder/css/toastr.min.css">
    <link rel="stylesheet" href="../assets/page_builder/css/grapes.min.css?v0.15.3">
    <link rel="stylesheet" href="../assets/page_builder/css/grapesjs-preset-webpage.min.css">
    <link rel="stylesheet" href="../assets/page_builder/css/tooltip.css">
    <link rel="stylesheet" href="../assets/page_builder/css/grapesjs-plugin-filestack.css">
    <link rel="stylesheet" href="../assets/page_builder/css/demos.css">
   
   

     

    <!-- -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery-1.11.1.min.js"></script>
    

    <script src="../assets/page_builder/js/grapes.min.js"></script>
    <!--<script src="//unpkg.com/grapesjs"></script>-->
    <script src="../assets/page_builder/js/toastr.min.js"></script>
    <script src="../assets/page_builder/js/grapesjs-preset-webpage.min.js"></script>
    <script src="../assets/page_builder/js/grapesjs-lory-slider.min.js"></script>
    <script src="../assets/page_builder/js/grapesjs-tabs.min.js"></script>
    <script src="../assets/page_builder/js/grapesjs-custom-code.min.js"></script>
    <script src="../assets/page_builder/js/grapesjs-touch.min.js?0.1.1"></script>
    <script src="../assets/page_builder/js/grapesjs-parser-postcss.min.js"></script>
    <script src="../assets/page_builder/js/grapesjs-tooltip.min.js?0.1.1"></script>
    <script src="../assets/page_builder/js/grapesjs-tui-image-editor.min.js"></script>
    

     
    <script type="text/javascript">
        $(window).load(function() {
            $(".page-loader-wrapper").fadeOut("slow");
        });

    </script>

    <script>
    /*tinymce.init({
        selector : '#richTextArea',
        plugins : 'image',
        toolbar : 'image',

        images_upload_url : 'upload.php',
        automatic_uploads : false,

        images_upload_handler : function(blobInfo, success, failure) {
            var xhr, formData;

            xhr = new XMLHttpRequest();
            xhr.withCredentials = false;
            xhr.open('POST', 'upload.php');

            xhr.onload = function() {
                var json;

                if (xhr.status != 200) {
                    failure('HTTP Error: ' + xhr.status);
                    return;
                }

                json = JSON.parse(xhr.responseText);

                if (!json || typeof json.file_path != 'string') {
                    failure('Invalid JSON: ' + xhr.responseText);
                    return;
                }

                success(json.file_path);
            };

            formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            xhr.send(formData);
        },
    });*/
</script>

<style>
        .panel {
          width: 90%;
          max-width: 700px;
          border-radius: 3px;
          padding: 30px 20px;
          margin: 150px auto 0px;
          background-color: #d983a6;
          box-shadow: 0px 3px 10px 0px rgba(0,0,0,0.25);
          color:rgba(255,255,255,0.75);
          font: caption;
          font-weight: 100;
        }

        .welcome {
          text-align: center;
          font-weight: 100;
          margin: 0px;
        }

        .logo {
          width: 70px;
          height: 70px;
          vertical-align: middle;
        }

        .logo path {
          pointer-events: none;
          fill: none;
          stroke-linecap: round;
          stroke-width: 7;
          stroke: #fff
        }

        .big-title {
          text-align: center;
          font-size: 3.5rem;
          margin: 15px 0;
        }

        .description {
          text-align: justify;
          font-size: 1rem;
          line-height: 1.5rem;
        }

      </style>
    </head>
     

 
  <!-- END: Head-->
  <body id="welcomeText" class="vertical-modern-menu" >

  <!-- Page Loader -->
    <div class="page-loader-wrapper anim" style="background:none;">
        <div class="loader">
            <p>
                <a class="btn btn-floating pulse btn-large">
                    <img src="../assets/img/cart.png" class="responsive-img mb-10 circle">
                </a>
            </p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->