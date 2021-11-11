<?php
include('../inc/admins.php'); 
// Logout
		$tv  = time();
	    $act = "Logged Out";
        session_destroy();
        header("Location: login/login");
		 mysqli_query($mysqli, "insert into logs(uid,name,action,etime)values('$id',$name','$act', '$tv')") or die(mysqli_error($mysqli));
   

?>