<?php
	include("connection.php");
	header('Content-Type: application/json');
	if($_SERVER["REQUEST_METHOD"]=="POST"){		
	    $postdata = file_get_contents("php://input");
	    if (isset($postdata)) {
	        $request = json_decode($postdata);
	        $farmer=mysqli_real_escape_string($conn,$request->farmer);
	        $buyer=mysqli_real_escape_string($conn,$request->buyer);
	        $product=mysqli_real_escape_string($conn,$request->product);
	        $units=mysqli_real_escape_string($conn,$request->units);
	        $timestamp=time()."000";

	        $statement="INSERT INTO tblorders VALUES('','$farmer','$buyer','$product','$units','$timestamp','Pending')";
	        $query=mysqli_query($conn,$statement) or die(failedInsert());
	        $statement_update="UPDATE tblproducts SET flddemand=flddemand+1 WHERE fldproduct='$product'";
	        $query=mysqli_query($conn,$statement_update) or die(failedInsert());
	        $response=array("response"=>"success");
		}else {
	        $response=array("response"=>"failed");
	    }
	    echo json_encode($response);	    
	}
	function failedInsert(){
		$response=array("response"=>"failed");
		echo json_encode($response);
	}
?>