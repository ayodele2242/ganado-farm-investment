<?php

require_once("../../inc/config.php");
 
//Retrieve form data. 
$id=$_POST['id'];


//update database and and echo 1 for success 
$query2 = mysqli_query($mysqli,"DELETE FROM role_rights where id='$id'");
 
if($query2){
	echo 1;
}else{
	echo $mysqli->error;
}

?>
 