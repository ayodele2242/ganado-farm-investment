<?php
	include("connection.php");
    if(isset($_GET["type"]) && isset($_GET["phoneno"])){
        $orders=array();
        $type=mysqli_real_escape_string($conn,$_GET["type"]);
        $phoneno=mysqli_real_escape_string($conn,$_GET["phoneno"]);
        if($type=="sales"){
            $statement="SELECT * FROM tblorders WHERE fldphoneno_farmer='$phoneno' and (fldcomplete='Pending' or fldcomplete='Approved') ORDER BY fldtimestamp DESC";
        }else{
            $statement="SELECT * FROM tblorders WHERE fldphoneno_buyer='$phoneno' and fldcomplete!='Cancelled' ORDER BY fldtimestamp DESC";
        }      
        $query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
        while($record=mysqli_fetch_assoc($query)){ 
            $statement="SELECT * FROM tblproduce WHERE fldproduct='$record[fldproduct]' and fldphoneno='$record[fldphoneno_farmer]' LIMIT 0,1";  
            $query_produce=mysqli_query($conn,$statement) or die(mysqli_error($conn));
            $produce=mysqli_fetch_assoc($query_produce);
            $record['fldunit']=$produce["fldunit"];
            $record['fldcost']=$produce["fldcost"];
            $host= gethostname();
            $ip = gethostbyname($host);
            if($type=="sales"){
                $record["fldavatar"]="http://$ip/ama/account/avatars/$record[fldphoneno_buyer].jpg";
                $record["avatar_phone"]=$record["fldphoneno_buyer"];
            }else{
                $record["fldavatar"]="http://$ip/ama/account/avatars/$record[fldphoneno_farmer].jpg";
                $record["avatar_phone"]=$record["fldphoneno_farmer"];
            }          
            
            $orders[]=$record;
        }
        echo json_encode($orders);
    }
?>