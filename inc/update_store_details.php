<?php
require_once("config.php");


 if($_POST['installUrl'] == "") {
        $url = "";
    }  else{
    	$url = $mysqli->real_escape_string($_POST['installUrl']);
    }

  //$url = $mysqli->real_escape_string($_POST['installUrl']);
  $name = $mysqli->real_escape_string($_POST['storeName']);
  $email = $mysqli->real_escape_string($_POST['Email']);
  $cont = $mysqli->real_escape_string($_POST['contactNum']);
  $contry = $mysqli->real_escape_string($_POST['country']);
  $st = $mysqli->real_escape_string($_POST['state']);
  $addr = $mysqli->real_escape_string($_POST['address']);
  $des = $mysqli->real_escape_string($_POST['descr']);
  $key = $mysqli->real_escape_string($_POST['keywords']);
  $author = $mysqli->real_escape_string($_POST['author']);
  $fb = $mysqli->real_escape_string($_POST['facebook']);
  $t = $mysqli->real_escape_string($_POST['twitter']);
  $i = $mysqli->real_escape_string($_POST['instagram']);
  $y = $mysqli->real_escape_string($_POST['youtube']);

$update = "UPDATE store_setting SET installUrl='$url', storeName='$name', Email='$email', contactNum='$cont', country='$contry', state='$st', address='$addr', descr='$des', keywords='$key', author='$author', facebook='$fb', twitter='$t', instagram='$i', youtube='$y'";

$tw = mysqli_query($mysqli,$update);

if($tw){
	echo "done";
}else{
	echo "Error occured: ". $mysqli->error;
}


?>