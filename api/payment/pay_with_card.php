<?php
//require_once("../../config/config.php");
//require_once("../../config/function.php");
require_once("../functions.php");


/*id: 16
name: Adewale Akinwale
plan: Cocoa
email: kignsley@gmail.com
interest: 12
amount: 500000*/


$id      = safe_input($mysqli,$_POST['id']);
$name    = safe_input($mysqli,$_POST['name']);
$plan    = safe_input($mysqli,$_POST['plan']);
$email   = safe_input($mysqli,$_POST['email']);
$rate    = safe_input($mysqli,$_POST['interest']);
$amt     = safe_input($mysqli,$_POST['amount']);
$duration = safe_input($mysqli,$_POST['duration']);


$interesttotal = ceil((($amt / 100 * $rate) * $duration)/50)*50;
$interestdue = round($amt / 100 * $rate);
$totalAmt = $amt + $interesttotal;

$mdate = date("Y-m-d H:m:s");

$date = date("Y-m-d");// current date

if($duration < 2){
  $mtime = "+ $duration month";
}else{
$mtime = "+ $duration months";
}

$exp_time = strtotime(date("Y-m-d", strtotime($date)) . $mtime);
$exp_date = date('Y-m-d', $exp_time);
$sta         = "active";

$person = array( 
    "id"     => $id,
    "name"   => $name, 
    "plan"   => $plan,
    "amount" => $amt,
    "email"  => $email,
    "date"   => $mdate
); 


$sql = mysqli_query($mysqli,"insert into plans(email,interest,amount_invested,plan,duration,totInterest,Amt_to_get,plan_id,status,exp_time,exp_date, created_date)
  values('$email','$rate','$amt','$plan','$duration','$interesttotal','$totalAmt','$id','$sta','$exp_time','$exp_date','$mdate')");

if($sql){
  //echo 1;
  $return["json"] = json_encode($person);
 echo json_encode($person);
}else{
  echo "Error occured: ". $mysqli->error;
}





?>