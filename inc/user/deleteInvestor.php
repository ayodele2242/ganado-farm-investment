<?php

require_once("../config.php");
 
//Retrieve form data. 
$id=$_POST['id'];


//get investor email first




$que = mysqli_query($mysqli,"select email from members where id='$id'");
$row = mysqli_fetch_array($que);

$count = mysqli_num_rows($que);
if($count < 1){
    echo "No result exist in the database for this user";
}else{

$email = $row['email'];
//check if this investor already invested
$ique = mysqli_query($mysqli,"select * from plans where email='$email' and status ='active' and payment_status='successful'");

$getc = mysqli_num_rows($ique);
if($getc > 0){
   echo "You cannot delete this account. There\'s an active investment on the account";
}else{

//update database and and echo 1 for success 
$query1 = mysqli_query($mysqli,"DELETE FROM members where id='$id'");
$query2 = mysqli_query($mysqli,"DELETE FROM plans where email='$email'");
 
if($query1 && $query2){
	echo 1;
}else{
	echo "Error occured: ".$mysqli->error;
}

}

}

?>
 