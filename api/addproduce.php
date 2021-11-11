<?php
	include("connection.php");
	header('Content-Type: application/json');
	if($_SERVER["REQUEST_METHOD"]=="POST"){		
	    $postdata = file_get_contents("php://input");
	    if (isset($postdata)) {
	        $request = json_decode($postdata);

	        $phoneno=mysqli_real_escape_string($conn,$request->phoneno);
	        $name=mysqli_real_escape_string($conn,$request->name);
	        $cost=mysqli_real_escape_string($conn,$request->cost);
	        $cost=$cost*100;
	        $unit=mysqli_real_escape_string($conn,$request->unit);
	        $comment=mysqli_real_escape_string($conn,$request->comment);
	        $timestamp=time()."000";
	        $statement="INSERT INTO tblproduce VALUES('$phoneno','$name','$cost','$unit','Yes','$comment','$timestamp')";
	        $update_statement="UPDATE tblproduce SET fldcost='$cost', fldavailable='Yes', fldunit='$unit', fldcomment='$comment', fldtimestamp='$timestamp' WHERE fldphoneno='$phoneno' and fldproduct='$name'";
	        $query=mysqli_query($conn,$statement) or die(update($conn,$update_statement));
	        $response=array("response"=>"success");
		}else {
	        $response=array("response"=>"failed");
	    }
	    echo json_encode($response);	    
	}
	function update($conn,$statement){
		$query=mysqli_query($conn,$statement) or die(failed());
		$response=array("response"=>"success");
		echo json_encode($response);
	}

	function failed(){
		$response=array("response"=>"failed");
		echo json_encode($response);
	}
?>