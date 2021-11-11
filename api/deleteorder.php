<?php
	include("connection.php");
	if (isset($_GET["who"]) && isset($_GET["id"])){
		$order=$_GET["id"];
		$who=$_GET["who"];
		if($who=="farmer"){
			$statement="UPDATE tblorders SET fldcomplete='Denied' WHERE fldorderid='$order'";
		}elseif ($who=="buyer"){
			$statement="UPDATE tblorders SET fldcomplete='Cancelled' WHERE fldorderid='$order'";
		}elseif($who=='approve'){
			$statement="UPDATE tblorders SET fldcomplete='Approved' WHERE fldorderid='$order'";
		}else{
			$statement="DELETE FROM tblorders WHERE fldorderid='$order'";
		}
		$query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
        $response=array("response"=>"success"); 
        echo json_encode($response);
	}
?>