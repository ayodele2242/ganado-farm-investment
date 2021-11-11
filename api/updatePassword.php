<?php

if (isset($_SERVER['HTTP_ORIGIN'])) {

        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");

        header('Access-Control-Allow-Credentials: true');

        header('Access-Control-Max-Age: 86400');    // cache for 1 day

    }

    // Access-Control headers are received during OPTIONS requests

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

        if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))

            header("Access-Control-Allow-Methods: GET, POST, OPTIONS");        

       if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))

            header("Access-Control-Allow-Headers:        {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

        exit(0);

    }

  include "../inc/functions.php";

    $data = file_get_contents("php://input");

    if (isset($data)) {

        $request = json_decode($data);
		$oldpass = $request->oldpass;
        $newPass = $request->newPass;
        $confirmPass = $request->confirmPass;
        $email = $request->email;
        

    }


$oldpass = encryptIt($oldpass);
$newPass = stripslashes($newPass);
$confirmPass = $confirmPass;

$pass = encryptIt($newPass);



$sel = mysqli_query($mysqli, "SELECT password FROM members WHERE password = '$oldpass' and email='$email'");
$count = mysqli_num_rows($sel);

if($count == 0){
	$response= "Your old password is wrong. Please check and try again.";
}else if($oldpass == $pass){
$response= "You can not update to your old password. Try another one.";
}else{
$sql = "UPDATE members SET password = '$pass' WHERE email = '$email'";

if ($mysqli->query($sql) === TRUE) {
$response= "Done";
} else {
   $response= "Error occured: " . $mysqli->error;
}



}//else
 echo json_encode( $response);

?>