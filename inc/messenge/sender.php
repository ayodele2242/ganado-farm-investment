<?php
require_once '../../inc/fetch.php';
if($_POST){


$addr = $_POST['emaillist'];
$emailist = explode(";",$addr);

  $sendit = "";
//-------------------log email invite into db-------------------
foreach ($emailist AS $addy) {

$bquery = mysqli_query($mysqli,"select name FROM members WHERE email = '$addy'");
$erow = mysqli_fetch_array($bquery);
$name = ucwords($erow['name']);

$subject = $_POST['subject'];
$msg = $_POST['msg'];   
$site_name = $set['storeName'];
$link = $set['Email'];
$to = $addy;	

        $message = "";
        $message .= '<html>
        <body>
        <div style="width:100%; background:rgba(255,0,0,0.1); padding:2px;">

        <p style="text-align:center; padding:1px;"> <img src="'. $set['installUrl'].'assets/logo/'.$set['logo'] .'"/></p>
        <p></p>
		<p></p>
         <p>Hello ' .$name. '</p>
         <p></p>
		<p></p>
		<p>'.$msg.'</p>
		<p></p>
		<p></p>
		<p></p>
		<p><b>Ganado Farm Team</b></p>
		</div>
		</body>
		</html>';
		
		$from_mail = $site_name.'<'.$link.'>';

       
		
		$from = $from_mail;
		
		// To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
		// Create email headers
		$headers .= 'From: '.$from."\r\n".
			'Reply-To: '.$from."\r\n" .
			'X-Mailer: PHP/' . phpversion();	
			
  
  $sendit =  mail($to, $subject, $message, $headers);
   	
}

if($sendit)
{
	echo "Mail Sent";
}
else{
echo "Email sending failed. Try again.";	
}


}

?>