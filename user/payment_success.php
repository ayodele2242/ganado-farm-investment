<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
require '../inc/functions.php'; 

//if(isset($_POST['transId']) && !empty($_POST['reference'])){
$id   = safe_input($mysqli,$_POST['transId']);
$reference = safe_input($mysqli,$_POST['reference']);
$email     = safe_input($mysqli,$_POST['email']);
$date      = safe_input($mysqli,$_POST['date']);
$ref       = safe_input($mysqli,$_POST['ref']);
//get buys details


$mquery = mysqli_query($mysqli,"update plans set transId = '$reference', trasaction_status='successful' where  email='$email' and ref='$ref'");
 
if($mquery){
  echo 1;

$bquery = mysqli_query($mysqli,"select name from members where email = '$email'");
$erow = mysqli_fetch_array($bquery);
$name = $erow['name'];
//sending email

$to      = $email;
$from = 'info@app.gapp.ng'; 
$fromName = 'Ganado Farm'; 
 
$subject = "Your investment info has been confirmed.";

$htmlContent .= '
<html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
          <title>Investment</title> 
    </head> 
    <body> 
<p>Hello ' .$name. '</p>
<p>Thank you for being part of our family at Ganado Farm! Your investment has been successfully confirmed. </p>
<p>
You can monitor your investment progress from your dashboard.
</p>

<table class="table table-striped"  width="100%" cellpadding="0" cellspacing="0">

<tbody>
';

    $query = mysqli_query ($mysqli, "SELECT * FROM plans WHERE  email='$email' and ref='$ref'" );
    while($order = mysqli_fetch_array($query))
        {    
        	 
        $htmlContent .= "<tr>
        
        <td>Plan</td><td class=leftstyle>".$order['plan']."</td><tr>
        <tr><td>Duration</td><td class=rightstyle>".$order['duration']."</td></tr>
        <tr><td>Amount Invested</td><td class=rightstyle>".$order['amount_invested']."</td></tr>
        <tr><td>Expected Return</td><td class=rightstyle>".$order['Amt_to_get']."</td></tr>

        <tr><td>Maturity Date</td><td class=rightstyle>".$order['exp_date']."</td>
        
      </tr>";
    }

$htmlContent .= '</tbody></<table>
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

mail($to, $subject, $htmlContent, $headers,'-finfo@app.gapp.ng'); 

}else{
  echo "Error occured: ". $mysqli->error;
}
/*}else{
	echo "Transacrion Failed. Please try again";
}*/

?>

    


