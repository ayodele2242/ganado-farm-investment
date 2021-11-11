<?php
require_once '../functions.php';

// Get Settings Data
$setSql = "SELECT * FROM store_setting";
$setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
$set = mysqli_fetch_array($setRes);

if(empty($_POST['email'])){
	echo "Enter your password";
}else{

$email = safe_input($mysqli,$_POST['email']);
$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
if (filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||
    $emailB != $email
) {
    echo "This email address isn't valid";
}else{

//get if email already exist in db
$getU = "SELECT password, last_name, first_name from customer_login WHERE email ='$email'";

$ok = mysqli_query($mysqli, $getU);
$countIt = mysqli_num_rows($ok);

if($countIt < 1){
   echo "That email address does not exist in our database. Please check and try again.";
}else{
$row = mysqli_fetch_array($ok);
$password = decryptIt($row['password']);
$name = ucwords($row['last_name'] .' '.$row['first_name']);
        
$to      = $email;
$from = 'security@akawocommunity.com'; 
$fromName = 'AKAWO Community'; 
 
$subject = "Password Recovery.";

$htmlContent .= '
<html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
          <title>Password Recovery</title> 
    </head> 
    <body> 

<div style=" text-align:center"><img src="'.$set['installUrl'].'assets/logo/'.$set['logo']. '" width="120" height="80"/></div>    

<p>Hello ' .$name.',</p>
<p>You made a request for password recovery. Please find it below. </p>

<p></p>
<p></p>
<p><strong>'.$password.'</strong></p>
<p></p>
<p></p>
<p></p>
<p></p>
<p>AKAWO Community Team.</p>
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

if(mail($to, $subject, $htmlContent, $headers,'-fsecurity@akawocommunity.com')){
    echo 1;
}  else{
    echo "Error sending email. Please try again later.";
}
   


 }


}




}

?>