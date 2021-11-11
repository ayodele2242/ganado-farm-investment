<?php
    include("connection.php");
    if($_SERVER["REQUEST_METHOD"]=="POST"){        
        $postdata = file_get_contents("php://input");
        if (isset($postdata)) {
            $request = json_decode($postdata);
            $phoneno = mysqli_real_escape_string($conn,$request->phoneno);
            $latitude =mysqli_real_escape_string($conn,$request->lat);
            $longitude =mysqli_real_escape_string($conn,$request->lng);

            $statement="UPDATE tblclients SET fldlat='$latitude',fldlng='$longitude' WHERE fldphoneno='$phoneno'";
            $query=mysqli_query($conn,$statement) or die(error());
            $response=array("response"=>"success");

        } else{
            $response=array("response"=>"error");
        }
        echo json_encode($response);
    }
    function error(){
        $response=array("response"=>"error");
        echo json_encode($response);
    }
?>