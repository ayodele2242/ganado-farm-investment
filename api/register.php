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
 
  include("../inc/fetch.php");

  // Get Settings Data
        $setSql = "SELECT * FROM store_setting";
        $setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
        $set = mysqli_fetch_array($setRes);
  
    $data = file_get_contents("php://input");
    if (isset($data)) {
        $request = json_decode($data);
		$name = $request->name;
		$password = $request->password;
		$mobile = $request->mobile;
		$emailadd = $request->email;
        $dob = $request->dob;
        $gender = $request->gender;
 
	}

$name = safe_input($mysqli,$name);
$mypassword = encryptIt($password);
$dob = safe_input($mysqli,$dob);
$date1 = strtr($dob, '/', '-');

$sdate =  date('Y-m-d', strtotime($date1));

//Check for valid email
$email = safe_input($mysqli, $emailadd);
$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
if (filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||
    $emailB != $email
) {
    $response= "This email adress isn't valid";
}

//get if email already exist in db
$getU = "SELECT email from members WHERE email ='$email'";

$ok = mysqli_query($mysqli, $getU);
$countIt = mysqli_num_rows($ok);

if($countIt > 0){
   $response= "That email address already exist. If it belongs to you please log in.";
}else{

$email_activation_key = md5($email . $name);


$sql = mysqli_query($mysqli,"insert into members(name,email,phone,dob,password,gender,token,platform)values('$name','$email','$mobile','$sdate','$mypassword','$gender','$email_activation_key','From App')");


if($sql){
	$response= "done";


    // create account verification link
        $link = 'https://' . $_SERVER['SERVER_NAME'] . '/activation?key=' . $email_activation_key;
        $to      = $email;
        $from = 'info@app.gapp.ng'; 
$fromName = 'Ganado Farm'; 
 
$subject = "Verify Your Email Address.";

$htmlContent = '
<html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
          <title>Verify Your Email Address</title> 
    </head> 
    <body> 

<div style=" text-align:center"><img src="'.$set['installUrl'].'assets/logo/'.$set['logo']. '" width="140" height="130"/></div>    

<p>Hello ' .$name.',</p>
<p>Thank you for registering on Ganado Farm. To gain access to your account you need to verify your email address. </p>
<p>
Please follow the link below to verify your email address
</p>

<p></p>
<p></p>
<p></p>
<p>'.$link.'</p>
<p></p>
<p></p>
<p></p>
<p></p>
<p>Ganado Farm Team.</p>
</body> 
</html>';


// Set content-type header for sending HTML email 
$headers = "MIME-Version: 1.0" . "\r\n"; 
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
// Additional headers 
$headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 

//$headers  ="From: billing@homeawayfromhomelagos.com";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

mail($to, $subject, $htmlContent, $headers, '-finfo@app.gapp.ng');  
   
} else {
   $response= "Error: " . $sql . "<br>" . $mysqli->error;
}
 

 }
  
	echo json_encode( $response);

 
?>
