<?php
require_once '../functions.php';

// Get Settings Data
        $setSql = "SELECT * FROM store_setting";
        $setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
        $set = mysqli_fetch_array($setRes);


if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])){


$name = safe_input($mysqli,$_POST['name']);
$phone = safe_input($mysqli,$_POST['phone']);
$pass = encryptIt($_POST['password']);
$dob  = safe_input($mysqli,$_POST['dob']);
$ac_no = safe_input($mysqli,$_POST['bank_account_number']);
$acname = safe_input($mysqli,$_POST['bank_account_name']);
$bank = safe_input($mysqli,$_POST['bank_name']);


if($_POST['password'] != $_POST['cpassword']){
	echo "Password and confirm password are not equal";
}


//Check for valid email
$email = safe_input($mysqli, $_POST['email']);
$emailB = filter_var($email, FILTER_SANITIZE_EMAIL);
if (filter_var($emailB, FILTER_VALIDATE_EMAIL) === false ||
    $emailB != $email
) {
    echo "This email adress isn't valid<br/>";
}



//get if email already exist in db
$getU = "SELECT email from members WHERE email ='$email'";

$ok = mysqli_query($mysqli, $getU);
$countIt = mysqli_num_rows($ok);

if($countIt > 0){
	echo "That email address already exist. If it belongs to you please log in.";
}else{
if ($_POST['password'] == $_POST['cpassword']) {
	# code...

$email_activation_key = md5($email . $name);

$sql = mysqli_query($mysqli,"insert into members(name,email,phone,dob,password,account_name,account_number,bank_name,token)values('$name','$email','$phone','$dob','$pass','$acname','$ac_no','$bank','$email_activation_key')");


if($sql){
	echo 1;

	// create account verification link
        $link = 'https://' . $_SERVER['SERVER_NAME'] . '/activation?key=' . $email_activation_key;
        $to      = $email;
        $from = 'security@gapp.ng'; 
        $fromName = 'Ganado Farm'; 
 
$subject = "Verify Your Email Address.";

$htmlContent = '
<html> 
    <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
          <title>Verify Your Email Address</title> 
    </head> 
    <body> 

<div style=" text-align:center"><img src="'.$set['installUrl'].'logo/'.$set['logo']. '" width="120" height="80"/></div>    

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

if(mail($to, $subject, $htmlContent, $headers,'-fsecurity@gapp.ng')){
}  else{
    print_r(error_get_last());
}

}else{
	echo "Error occured: ".$mysqli->error;
}

}
}


}else{
	echo "Check for empty values in your inputs.";
}















?>