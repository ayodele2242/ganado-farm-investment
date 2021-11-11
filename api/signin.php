<?php

header('Access-Control-Allow-Origin: *');

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-type: application/json; charset=utf-8", true);
  
    include("../inc/functions.php");
  
    //if($_SERVER["REQUEST_METHOD"]=="POST"){ 
    $setSql = "SELECT * FROM store_setting";
    $setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
    $set = mysqli_fetch_array($setRes);
    
 
        $postdata = file_get_contents("php://input");
        if (isset($postdata)) {
            $request = json_decode($postdata);
            $email = mysqli_real_escape_string($mysqli,$request->email);
            $password = encryptIt($request->password);

            $sql="SELECT * FROM members WHERE  email = '$email' AND password='$password'";


            $resultset = mysqli_query($mysqli, $sql) or die("database error:". mysqli_error($mysqli));
            $row = mysqli_fetch_array($resultset);
            if(empty($row['img'])){
              $img = $set['installUrl'].'assets/logo/avatar.png';
            }else{
               $img = $set['installUrl'].'assets/images/'.$row['img'];
            }

            if($row['password']==$password AND $row['email']==$email AND $row['status']=='1'){
               
                $response=array(
                                'status'=>'success',
                                "data"=>array(
                                    "id"=>$row['id'],
                                    "name"=>ucwords($row['name']),
                                    "phone"=>$row['phone'],
                                    "email"=>$row['email'],
                                    "dob"=>$row['dob'],
                                    "gender"=>$row['gender'],
                                    "acname"=>$row['account_name'],
                                    "acno"=>$row['account_number'],
                                    "bank_name"=>$row['bank_name'],
                                    "bank_code"=>$row['bank_code'],
                                    "myimg" => $img,
                                    "imgname" => $row['img'],
                                    "trans_code"=>$row['Trx_code'],
                                    "kin_name"=>$row['kin_name'],
                                    "kin_phone"=>$row['kin_phone'],
                                    "kin_address"=>$row['kin_address'],
                                    "kin_gender"=>$row['kin_gender']

                                    )

                                );

                            //die(json_encode($response));
            }else if($row['password']==$password AND  $row['email']==$email AND $row['status'] == '0' ){
             $response=array('status'=>'Account not yet activated. Please check your email for activation link.');
            }   else{
                $response=array('status'=>'Invalid login details entered');
            }
        ////} else{
            //$response=array("response"=>"failed");
        //}
        echo json_encode($response);
    }
    //}
?>