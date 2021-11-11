<?php

require_once("../../inc/config.php");
 
 //if(isset($_POST['id'])){
//Retrieve form data. 
$id=$_POST['id'];
$transid=$_POST['transid'];
$status = $_POST['status'];
 
//update database and and echo 1 for success 
$link = "UPDATE plans SET transId='$transid', trasaction_status='$status WHERE id='$id'";
 
if(mysqli_query($mysqli, $link)){
	echo 1;
}else{
	echo $mysqli->error;
}

//}



?>
 