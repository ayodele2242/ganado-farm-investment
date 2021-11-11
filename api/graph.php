<?php

    header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
	header("Content-Type: application/json; charset=utf-8");  
  
    include("../inc/config.php");
    
     $postdata = file_get_contents("php://input");
     
      if (isset($postdata)) {
           $request = json_decode($postdata);
           $email = mysqli_real_escape_string($mysqli,$request->email);
           
    $query  = "SELECT distinct plan, daily_growth  FROM plans where email = '$email' and status = 'active' and exp_date > DATE(NOW()) and transId !=''";
    $result = mysqli_query($mysqli,$query);
           
     $response = array();      
           
    while($row = mysqli_fetch_array($result)){
        
         array_push($response, array(
             "plan"=>$row['plan'] ,
            "rate"=>$row['daily_growth']
            ));
  
          
}

echo json_encode(array("server_response"=> $response));
mysqli_close($mysqli);
          
          
      }