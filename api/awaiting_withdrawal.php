<?php

	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
	header("Content-Type: application/json; charset=utf-8");

	include "../inc/config.php";

	 $setSql = "SELECT * FROM store_setting";
    $setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
    $set = mysqli_fetch_array($setRes);

    /*$postdata = file_get_contents("php://input");
    $request = json_decode($postdata);
    $email = mysqli_real_escape_string($mysqli,$request->email);*/


    
     $email = $_GET['email'];

	$data = array();

		$query = mysqli_query($mysqli, "SELECT * FROM plans where email='$email' and status = 'waiting_withdrawal'");

		while($get = mysqli_fetch_array($query)){
$date = $get['exp_date'];
//$date1 = strtr($date, '/', '-');
$mainDate = date('Y-m-d H:i', strtotime($date));


$today = date("Y-m-d H:i"); 

$startdate = $mainDate;   
$offset = strtotime("+1 day");
$enddate = date($startdate, $offset);    
$today_date = new DateTime($today);
$expiry_date = new DateTime($enddate);


$interesttotal = ceil((($get['Amt_to_get'] / 100 * $get['interest']) * $get['duration'])/50)*50;
$interestdue = round($get['Amt_to_get'] / 100 * $get['interest']);
$totalAmt = $get['Amt_to_get'] + $interesttotal;

			if ($expiry_date < $today_date) { 
				$sta = 'show';
			}else{
				$sta = '';
			}



			$data[] = array(
				"id"    => $get['id'],
			    "category"   => ucwords($get['plan']),
			    "interest"   => $get['interest'],
			    "amt_invested"   => $get['amount_invested'],
			    "daily_return"    => $get['daily_growth'],
			    "expected_return"  => $get['Amt_to_get'],
                "totalAmt"         =>  $totalAmt,
                "totInterest"      => $get['totInterest'],
			    "maturity_date"     =>  $mainDate,
			    "exp_date" => $expiry_date,
			    "today_date" => $today_date,
			    "btn_status" => $sta
			);
		}

		if($query) $result = json_encode(array('success'=>true, 'result'=>$data));
		else $result = json_encode(array('success'=>false));
		echo $result;









?>