<?php

header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
	header("Content-Type: application/json; charset=utf-8");

	
require '../inc/functions.php';

$id           = safe_input($mysqli,$_POST['id']);

 
//get details from plans

$sql = mysqli_query($mysqli,"select * from plans where id='$id'");

//we new to move previous details to history table
$row = mysqli_fetch_array($sql);



$querys = mysqli_query($mysqli,"insert into history(email,interest,amount_invested,plan,duration,totInterest,Amt_to_get,plan_id,transId,status,exp_time,exp_date)
	values('".$row['email']."','".$row['interest']."','".$row['amount_invested']."','".$row['plan']."','".$row['duration']."','".$row['totInterest']."','".$row['Amt_to_get']."','".$row['plan_id']."','".$row['transId']."','".$row['status']."','".$row['exp_time']."','".$row['exp_date']."')");

if($querys){
 //let update plans table for user new update


$amttoInvest = $row['Amt_to_get'];
$rate = $row['interest'];
$amt  = $row['Amt_to_get'];
$duration = $row['duration'];

$interesttotal = ceil((($amt / 100 * $rate) * $duration)/50)*50;
$interestdue = round($amt / 100 * $rate);
$totalAmt = $amt + $interestdue;

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
$now = time(); // or your date as well
//Daily return calculation
$your_date = strtotime($exp_date);
$datediff = $your_date-$now;
//Calculate date difference
$gdate =  round($datediff / (60 * 60 * 24));
//Divide amount by number of days
$currentgrowthrate = round($row['Amt_to_get']/$gdate);




$update = mysqli_query($mysqli,"update plans set amount_invested = '$amttoInvest', totInterest = '$interestdue', Amt_to_get='$totalAmt', exp_time='$exp_time', exp_date='$exp_date', status='active', payment_status='',re_invest_status='yes', daily_growth='$currentgrowthrate' where id='$id' ");

if($update){
	echo 1;
}else{
	echo "Error occured while re-investing: ". $mysqli->error;
}


}else{
	echo "Error occured while inserting: ". $mysqli->error;
}





?>