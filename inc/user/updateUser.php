<?php

require_once("../functions.php");
 
//Retrieve form data. 
$id=$_POST['id'];
$email=$_POST['email'];
$phone = "phone";

 
 
//update database and and echo 1 for success 
$link = mysqli_query($mysqli,"UPDATE system_users SET email='$email', phone='$phone' where u_userid='$id'");
 
if(!$link){
	echo $mysqli->error;
}else{
	echo '1';
}

?>
 