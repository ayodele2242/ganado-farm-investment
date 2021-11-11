<?php
header('Access-Control-Allow-Origin: *');
    header("Access-Control-Allow-Credentials: true");
    header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
    header("Content-Type: application/json; charset=utf-8");
  
    include("../inc/config.php");


$postjson = json_decode(file_get_contents('php://input'), true);

$email = $postjson['email'];


        $data = array();
        $query = mysqli_query($mysqli, "SELECT * FROM plans where email='$email' and status = 'inactive' and payment_status='paid'");

        while($get = mysqli_fetch_array($query)){

            $data[] = array(
                'id'       => $get['id'],
                'plan'     => $get['plan'],
                'amt_invested'  => $get['amount_invested'],
                'returned'        => $get['Amt_to_get']
            );
        }

        if($query) $result = json_encode(array('success'=>true, 'result'=>$data));
        else $result = json_encode(array('success'=>false));
        echo $result;
    



?>