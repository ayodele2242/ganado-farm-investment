<?php

require "inc/config.php";

$query = mysqli_query($mysqli,"SELECT * FROM plans WHERE exp_date < DATE(NOW()) and status='active'");

$count = mysqli_num_rows($query);
if($count > 0){
	while($row = mysqli_fetch_array($query)){
		$id = $row['id'];
	//Update payment status column
   mysqli_query($mysqli,"UPDATE plans SET status = 'waiting_withdrawal', payment_status='waiting' WHERE id = '$id'");

}
}


?>