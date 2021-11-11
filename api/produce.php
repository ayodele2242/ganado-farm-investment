<?php
	include("connection.php");
    if(isset($_GET["product"]) && isset($_GET["criteria"])){
        $product=mysqli_real_escape_string($conn,$_GET["product"]);
        $criteria=mysqli_real_escape_string($conn,$_GET["criteria"]);
        switch($criteria){
            case "all":
                $statement="SELECT * FROM tblproduce WHERE fldproduct='$product' ORDER BY fldphoneno ASC ";
                break;
            case "latest":
                $statement="SELECT * FROM tblproduce WHERE fldproduct='$product' ORDER BY fldtimestamp DESC LIMIT 0, 25";
                break;
            case "price":
                $statement="SELECT * FROM tblproduce WHERE fldproduct='$product' ORDER BY fldcost DESC LIMIT 0, 25";
                break;
            default:
                $statement="SELECT * FROM tblproduce WHERE fldproduct='$product' ORDER BY fldphoneno ASC ";
        }          
        $query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
        $produce=array();
        while($record=mysqli_fetch_assoc($query)){
            $statement="SELECT * FROM tblclients WHERE fldphoneno='$record[fldphoneno]' LIMIT 0,1";
            $client_query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
            $record["supplier"]=mysqli_fetch_assoc($client_query);
            $host= gethostname();
            $ip = gethostbyname($host);
            $record["fldavatar"]="http://$ip/ama/account/avatars/$record[fldphoneno].jpg";
            $produce[]=$record; 
        }
        echo json_encode($produce);
    }
?>