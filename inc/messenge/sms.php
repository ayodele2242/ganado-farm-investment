<?php 
require_once('../../inc/functions.php');
error_reporting(0);
if($_POST){
//if(isset($_POST['phonelist']) && isset($_POST['subject_sms']) && isset($_POST['body_sms'])){
$cphone = "234".substr($_POST['phonelist'], 1).",";    
$phone = substr($cphone, 0, -1);
$contactlist = explode(",",$phone);
$title_sms = $_POST['subject_sms'];
$body_sms = $_POST['body_sms'];
$sms_part=substr($body_sms,0,160);




///////////////////////////////-------------------------/////////////////////////////
$username = urlencode("OJOB");
$password = urlencode("osunojob");
$message = urlencode($sms_part);
$sender = urlencode($title_sms);
$customer = $contactlist;


$msg = "";
$inew = array();
$inewm = array();
foreach($customer as $new){

$url = "https://www.bulksmsnigeria.com/api/v1/sms/create?api_token=MlXw8ewPrn4u8v5jctszoCFpg2Hjs2XA9AzfJhOC1ymNLL1xipjTc027HsPA&from=".$sender."&to=".$new."&body=".$message."&dnd=2";

	//$url = "http://api2.infobip.com/api/sendsms/plain?user=".$username."&password=".$password."&SMSText=".$message."&sender=".$sender."&GSM=".$new;
	//"https://sms.kullsms.com/customer/bulksms/?username=".$username."&password=".$password."&message=".$message."&sender=".$sender."&mobiles=".$customer."";

	$response = file_get_contents($url);

	$data = json_decode($response, true);

	//print_r($data);
  
  foreach ($data as $value) {
    # code...
    //$msg =  $value["message"];
    $inew[$value['status']] = $value; 
   //$inewm[$value['message']] = $value; 
  }

}
		
  if(array_key_exists('success', $inew)){
        echo 1;
    }else {
      echo "Error sending sms. Make sure you have enough sufficient funds in your account.";
    }


}
									
?>

												
												
												
												
												
												



													

