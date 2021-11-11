
<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");

require '../inc/functions.php'; 

//if(isset($_POST['transId']) && !empty($_POST['reference'])){
$id   = safe_input($mysqli,$_POST['id']);
$trx_code = safe_input($mysqli,$_POST['trx_code']);
$amt   = safe_input($mysqli,$_POST['amt']);

$gdetails = mysqli_query($mysqli,"select email, plan from plans where id = '$id'");
$erow = mysqli_fetch_array($gdetails);
$email = $erow['email'];
$plan  = $erow['plan'];

$mquery = mysqli_query($mysqli,"update plans set 	status = 'inactive', payment_status='paid', payment_code='$trx_code' where id = '$id'");
 
if($mquery){
  echo 1;
/*
$bquery = mysqli_query($mysqli,"select name from members where email = '$email'");
$erow = mysqli_fetch_array($bquery);
$name = $erow['name'];
//sending email

$to      = $email;
$from = 'ganadofarm@buildit.com.ng'; 
$fromName = 'Ganado Farm'; 
 
$subject = "Payment sent to you.";

$htmlContent .= '
<html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
          <title>Investment</title> 
    </head> 
    <body> 
<p>Hello ' .$name. '</p>
<p>Thank you for being part of our family at Ganado Farm! We have made a transfer of NGN '.number_format($amt). 'to your account. </p>
<p>
Please, if you do not receive the payment within 24 hours get in touch with us.
</p>
';

 

$htmlContent .= '
<p>Thank you.</p>
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

mail($to, $subject, $htmlContent, $headers);    
   */ 

}else{
  echo "Error occured: ". $mysqli->error;
}
/*}else{
	echo "Transacrion Failed. Please try again";
}*/

?>

    


