<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
//require_once("../../config/config.php");
//require_once("../../config/function.php");
require_once("../functions.php");




$id      = safe_input($mysqli,$_POST['id']);
$name    = safe_input($mysqli,$_POST['name']);
$plan    = safe_input($mysqli,$_POST['plan']);
$email   = safe_input($mysqli,$_POST['email']);
$rate    = safe_input($mysqli,$_POST['interest']);
$amt     = safe_input($mysqli,$_POST['amount']);
$duration = safe_input($mysqli,$_POST['duration']);


$interesttotal = ceil((($amt / 100 * $rate) * $duration)/50)*50;
$interestdue = round($amt / 100 * $rate);
$totalAmt = $amt + $interestdue;

$mdate = date("Y-m-d H:m:s");
$mtdate = date("m:s");
$ref = genTranxRef(15).$mtdate;

$date = date("Y-m-d");// current date

if($duration < 2){
  $mtime = "+ $duration month";
}else{
$mtime = "+ $duration months";
}

$exp_time = strtotime(date("Y-m-d", strtotime($date)) . $mtime);
$exp_date = date('Y-m-d', $exp_time);
$sta         = "active";
$now = time(); // or your date as well
//Daily return calculation
$your_date = strtotime($exp_date);
$datediff = $your_date-$now;
//Calculate date difference
$gdate =  round($datediff / (60 * 60 * 24));
//Divide amount by number of days
$currentgrowthrate = round($totalAmt/$gdate);

$person = array( 
    "id"     => $id,
    "name"   => $name, 
    "plan"   => $plan,
    "amount" => $amt,
    "email"  => $email,
    "date"   => $mdate,
    "ref"    => $ref
); 


$sql = mysqli_query($mysqli,"insert into plans(email,interest,amount_invested,plan,duration,totInterest,Amt_to_get,plan_id, ref, status,exp_time,exp_date,daily_growth, created_date)
  values('$email','$rate','$amt','$plan','$duration','$interestdue','$totalAmt','$id','$ref','$sta','$exp_time','$exp_date','$currentgrowthrate', '$mdate')");

if($sql){
  //echo 1;
  $return["json"] = json_encode($person);
 echo json_encode($person);
}else{
  echo "Error occured: ". $mysqli->error;
}





?>