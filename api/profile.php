<?php
    include("connection.php");
    if(isset($_GET["phoneno"])){ 
        $phoneno = mysqli_real_escape_string($conn,$_GET["phoneno"]);
        $statement="SELECT * FROM tblclients WHERE fldphoneno='$phoneno' LIMIT 0,1";
        $query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
        if(mysqli_num_rows($query)==1){
            $response=mysqli_fetch_assoc($query);
            $response['response']='success';
        }else{
            $response=array("response"=>"failed");
        }
        echo json_encode($response);
    }    
?>