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
		
		$emailadd = $request->email;
       
 
	}


//Check for valid email
$email = safe_input($mysqli, $emailadd);
$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
if (filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||
    $emailB != $email
) {
    $response= "This email address isn't valid";
}

//get if email already exist in db
$getU = "SELECT password, name from members WHERE email ='$email'";

$ok = mysqli_query($mysqli, $getU);
$countIt = mysqli_num_rows($ok);

if($countIt < 1){
   $response= "That email address does not exist in our database. Please check and try again.";
}else{
$row = mysqli_fetch_array($ok);
$password = decryptIt($row['password']);
$name = ucwords($row['name']);
        
        $to      = $email;
        $from = 'security@app.gapp.ng'; 
$fromName = 'Ganado Farm'; 
 
$subject = "Password Recovery.";

$htmlContent .= '
<html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
          <title>Password Recovery</title> 
    </head> 
    <body> 

<div style=" text-align:center"><img src="'.$set['installUrl'].'assets/logo/'.$set['logo']. '" width="140" height="140"/></div>    

<p>Hello ' .$name.',</p>
<p>You made a request for password recovery. Please find it below. </p>

<p></p>
<p></p>
<p><strong>'.$password.'</strong></p>
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

if(mail($to, $subject, $htmlContent, $headers,'-fsecurity@app.gapp.ng')){
    $response="sent";
}  else{
    $response="Error sending email. Please try again later.";
}
   


 }
  
	echo json_encode( $response);

 
?>
