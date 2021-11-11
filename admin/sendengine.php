<?php 
require_once('../includes/functions.php');


$addr = $_POST['email'];
$phone = $_POST['phone'];
$title_sms = $_POST['subject_sms'];
$body_sms = $_POST['body_sms'];
$sms_part=substr($body_sms,0,160);

$contactlist = explode(",",$phone);
$emailist = explode(";",$addr);

//--------------sms processing--------------
foreach ($contactlist AS $phone_num) {
$title_sms = $_POST['subject_sms'];
$body_sms = $_POST['body_sms'];
$sms_part=substr($body_sms,0,160);
//-------------------log sms invite into db-------------------

$in = new Sql(DBNAME,"INSERT INTO smsinvite_log (id,sentto_addresses,title,body) VALUES (NULL,'$phone_num','$title_sms','$sms_part')");
													
//echo Send_Email($body,$addy,$title);

$_SESSION['success_mail'] = "Message Sent!";
}
///////////////////////////////-------------------------/////////////////////////////
$username = urlencode("OJOB");
$password = urlencode("osunojob");
$message = urlencode($sms_part);
$sender = urlencode($title_sms);
$customer = $contactlist;

//http://api2.infobip.com/api/sendsms/plain?user=OJOB&password=osunojob&sender=OJOB-CENTER&SMSText=Hello this is OJOB&GSM=2348050367060


foreach($customer as $new){
	$url = "http://api2.infobip.com/api/sendsms/plain?user=".$username."&password=".$password."&SMSText=".$message."&sender=".$sender."&GSM=".$new;
	//"https://sms.kullsms.com/customer/bulksms/?username=".$username."&password=".$password."&message=".$message."&sender=".$sender."&mobiles=".$customer."";
	$response = file_get_contents($url);

	$data = json_decode($response, true);

	print_r($data);
}




//-------------------log email invite into db-------------------
foreach ($emailist AS $addy) {
$title = $_POST['subject'];
$body = $_POST['body'];

$inv = new Sql(DBNAME,"INSERT INTO emailinvite_log (id,sentto_addresses,title,body) VALUES (NULL,'$addr','$title','$body')");
													
echo Send_Email($body,$addy,$title);

$_SESSION['success_mail'] = "Message Sent!";
header("location: training-invitation");										
																								
}


									
																								
?>

												
												
												
												
												
												



													

