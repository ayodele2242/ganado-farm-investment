<?php

header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
	header("Content-Type: application/json; charset=utf-8");

	include "../inc/config.php";


$data = array();
		$query = mysqli_query($mysqli, "SELECT * FROM master_user ORDER BY user_id DESC");

		while($row = mysqli_fetch_array($query)){

			$data[] = array(
				'user_id' 		=> $row['user_id'],
				'user_name' 	=> $row['user_name'],
				'phone_number' 	=> $row['phone_number'],
				'gender' 		=> $row['gender'],
				'images'		=> $row['images'],
				'created_at' 	=> $row['created_at'],
			);
		}

		if($query) $result = json_encode(array('success'=>true, 'result'=>$data));
		else $result = json_encode(array('success'=>false));
		echo $result;

?>
