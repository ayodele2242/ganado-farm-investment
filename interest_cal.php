<?php
$loan_principal = "250000";
$loan_interest = 12;
$loan_period = 12;


$loan_interesttotal = ceil((($loan_principal / 100 * $loan_interest) * $loan_period)/50)*50;
$loan_interestdue = round($loan_principal / 100 * $loan_interest);
$totalAmt = $loan_principal + $loan_interesttotal;






echo $loan_interesttotal .'  <br/>  '.$totalAmt;
//= Return percentage / Duration of Investment (Months) * Capital Invested

$date = date("Y-m-d");// current date

if($loan_period < 2){
	$mtime = "+ $loan_period month";
}else{
$mtime = "+ $loan_period months";
}

$dates = strtotime(date("Y-m-d", strtotime($date)) . $mtime);
echo $dates.'<br/>';
echo date('Y-m-d', $dates);

//$oneMonthAgo = new \DateTime($mtime);
//echo $oneMonthAgo->format('Y-m-d');
?>
