<?php
	include("connection.php");
    if(isset($_GET["phoneno"])){
        $phoneno=mysqli_real_escape_string($conn,$_GET["phoneno"]);
        $statement="SELECT * FROM tblproduce WHERE fldphoneno='$phoneno' ORDER BY fldtimestamp DESC";          
        $query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
        $produce=array();
        while($record=mysqli_fetch_assoc($query)){
            $produce[]=$record; 
        }
        echo json_encode($produce);
    }
?>