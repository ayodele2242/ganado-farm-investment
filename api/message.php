<?php
	include("connection.php");
	if(isset($_GET["from"]) && isset($_GET["to"]) && isset($_GET["message"])){
        $from=mysqli_real_escape_string($conn,$_GET["from"]);
        $to=mysqli_real_escape_string($conn,$_GET["to"]);	        
        $message=mysqli_real_escape_string($conn,$_GET["message"]);
        $timestamp=time()."000";
        $statement="INSERT INTO tblchats VALUES('','$from','$to','$message','success','$timestamp')";
	    $query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
	    $response=array("response"=>"success");
	    echo json_encode($response);
	}
		    
?>