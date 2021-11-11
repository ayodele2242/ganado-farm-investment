<?php
	include("connection.php");
	header('Content-Type: application/json');
	if($_SERVER["REQUEST_METHOD"]=="POST"){		
	    $postdata = file_get_contents("php://input");
	    if (isset($postdata)) {
	        $request = json_decode($postdata);

	        $phoneno=mysqli_real_escape_string($conn,$request->phoneno);
	        $company=mysqli_real_escape_string($conn,$request->company);
	        $type=mysqli_real_escape_string($conn,$request->type);
	        $firstname=mysqli_real_escape_string($conn,$request->firstname);
	        $lastname=mysqli_real_escape_string($conn,$request->lastname);
	        $district=mysqli_real_escape_string($conn,$request->district);
	        $status="Active";	        
	        $password=mysqli_real_escape_string($conn,$request->password);
	        if($request->form=="signup"){
	        	$statement="INSERT INTO tblclients VALUES('$phoneno','$company','$type','$firstname','$lastname','$district','0','0','$status',MD5('$password'))";
	        	$query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
	        	$response=array("response"=>"success");
	        }else{
	        	$statement="UPDATE tblclients SET fldcompany='$company',fldlastname='$lastname',flddistrict='$district',fldstatus='$status',fldpassword=MD5('$password') WHERE fldphoneno='$phoneno'";
	        	$query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
	        	$statement="SELECT * FROM tblclients WHERE fldphoneno='$phoneno'";
	        	$query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
	        	$response=mysqli_fetch_assoc($query);
	        	$response["response"]="success";
	        }
		}else {
	        $response=array("response"=>"failed");
	    }
	    echo json_encode($response);	    
	}

?>