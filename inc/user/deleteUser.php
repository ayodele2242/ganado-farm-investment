<?php

require_once("../config.php");
 
//Retrieve form data. 
$id=$_POST['id'];


//update database and and echo 1 for success 
$query1 = mysqli_query($mysqli,"DELETE FROM system_users where u_rolecode='$id'");
$query2 = mysqli_query($mysqli,"DELETE FROM role_rights where rr_rolecode='$id'");
 
if($query1 && $query2){
	echo 1;
}else{
	echo $mysqli->error;
}

?>
 