<?php 
require_once('../includes/functions.php');

if($_POST){

$phone = substr($_POST['phone'], 0, -1);
$contactlist = explode(",",$phone);
$title_sms = $_POST['subject_sms'];
$body_sms = $_POST['body_sms'];
$sms_part=substr($body_sms,0,160);

try
    {

foreach ($contactlist AS $phone_num) {
            $title_sms = $_POST['subject_sms'];
            $body_sms = $_POST['body_sms'];
            $sms_part=substr($body_sms,0,160);
    
   $stmt = $mysqli->prepare("INSERT INTO smsinvite_log(sentto_addresses,title,body)VALUES(:onum, :ttle, :same )");
   $stmt->bindParam(":onum", $phone_num);
   $stmt->bindParam(":ttle", $title_sms);
   $stmt->bindParam(":same", $sms_part);
 
   if($stmt->execute())
   {
     echo  "sm";    
   }
   else
   {
       echo "Query could not execute !";
   }

     }

///////////////////////////////-------------------------/////////////////////////////
$username = urlencode("OJOB");
$password = urlencode("osunojob");
$message = urlencode($sms_part);
$sender = urlencode($title_sms);
$customer = $contactlist;

//http://api2.infobip.com/api/sendsms/plain?user=OJOB&password=osunojob&sender=OJOB-CENTER&SMSText=Hello this is OJOB&GSM=2347069605705


foreach($customer as $new){
	$url = "http://api2.infobip.com/api/sendsms/plain?user=".$username."&password=".$password."&SMSText=".$message."&sender=".$sender."&GSM=".$new;
	//"https://sms.kullsms.com/customer/bulksms/?username=".$username."&password=".$password."&message=".$message."&sender=".$sender."&mobiles=".$customer."";
	$response = file_get_contents($url);

	$data = json_decode($response, true);

	print_r($data);
}
		
    }
    catch(PDOException $e){
        echo $e->getMessage();
    }

}
									
?>

												
												
												
												
												
												



													

