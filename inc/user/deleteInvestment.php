<?php

require_once("../config.php");
 
//Retrieve form data. 
$id=$_POST['id'];


//update database and and echo 1 for success 
$query1 = mysqli_query($mysqli,"DELETE FROM plans where id='$id'");

if($query1){
	echo 1;
}else{
	echo $mysqli->error;
}

?>
 