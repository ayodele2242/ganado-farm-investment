<?php

require_once("../../inc/config.php");
 
 //if(isset($_POST['id'])){
//Retrieve form data. 
$id=$_POST['id'];
$email=$_POST['email'];
$phone = $_POST['phone'];
 
//update database and and echo 1 for success 
$link = "UPDATE system_users SET email='$email', phone='$phone' WHERE u_userid='$id'";
 
if(mysqli_query($mysqli, $link)){
	echo 1;
}else{
	echo $mysqli->error;
}

//}



?>
 