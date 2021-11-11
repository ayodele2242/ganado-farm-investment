<?php
	include("connection.php");
    if(isset($_GET["product"]) && isset($_GET["phoneno"])){
        $phoneno=mysqli_real_escape_string($conn,$_GET["phoneno"]);
        $product=mysqli_real_escape_string($conn,$_GET["product"]);
        $statement="DELETE FROM tblproduce WHERE fldproduct='$product' and fldphoneno='$phoneno'";                
        $query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
        $response=array("response"=>"success"); 
        echo json_encode($response);
    }
?>