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

		$query = mysqli_query($mysqli, "SELECT p.*, m.Trx_code FROM plans p JOIN members m on p.email=m.email where p.email='$email' and p.status = 'active' and transid !='' order by id desc");

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

			$now = time(); // or your date as well
			$your_date = strtotime($date);
			$datediff = $your_date-$now;
			$gdate =  round($datediff / (60 * 60 * 24));

			$currentgrowthrate = $get['Amt_to_get']/$gdate;

			if ($expiry_date > $today_date) { 
				$sta = 'show';
			}else{
				$sta = '';
			}



			$data[] = array(
				"id"    => $get['id'],
			    "category"   => ucwords($get['plan']),
			    "interest"   => $get['interest'],
			    "amt_invested"   => '₦'.number_format($get['amount_invested']),
			    "daily_return"    => '₦'.number_format($get['daily_growth']),
			    "expected_return"  => '₦'.number_format($get['Amt_to_get']),
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