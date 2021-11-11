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


	$postjson = json_decode(file_get_contents('php://input'), true);

	if($postjson['aksi'] == 'add_user'){
		$data = array();

		$datenow = date('Y-m-d');

		$datenowxx = date('Y-m-d_H_i_s'); // remove duplicate name image 
		if(empty($postjson['images'])){
			$directory = "images/no-image.png";
		}else{
        
		$entry = base64_decode($postjson['images']);
		$img = imagecreatefromstring($entry);

		$directory = "images/img_user".$datenowxx.".jpg"; // save gambar to folder sever 
		imagejpeg($img, $directory);
		imagedestroy($img);

		}

		$query = mysqli_query($mysqli, "INSERT INTO master_user SET
			user_name 		= '$postjson[user_name]',
			phone_number 	= '$postjson[phone_number]',
			gender 			= '$postjson[gender]',
			images 			= '$directory',
			created_at		= '$datenow'
		");

		$idadd = mysqli_insert_id($mysqli);

		if($query){
			$result = json_encode(array('success'=>true, 'idadd'=>$idadd));
		} 
		else{ 
			$result = json_encode(array('success'=>false));
		}
		echo $result;
	}

	elseif($postjson['aksi'] == 'get_plans'){
		$data = array();
		$query = mysqli_query($mysqli, "SELECT * FROM farm_packages where status='active' order by id desc");

		while($get = mysqli_fetch_array($query)){
			  $interesttotal = ceil((($get['capital'] / 100 * $get['percent']) * $get['duration'])/50)*50;
			$interestdue = round($get['capital'] / 100 * $get['percent']);
			$totalAmt = $get['capital'] + $interestdue;

			if(empty($get['img'])){
			$myimg  = $set['installUrl'].'assets/img/farm.png';
			}else{
			$myimg = $set['installUrl'].'assets/images/'.$get['img'];
			}


			$data[] = array(
				"id"    => $get['id'],
				"img"        => $myimg,
			    "category"   => ucwords($get['category']),
			    "percent"    => $get['percent'],
			    "duration"   => $get['duration'],
			    "capital"    => $get['capital'],
			    "details"    => $get['details'],
			    "capFormat"  => '₦'.number_format($get['capital']),
			    "totAmt"     =>  $totalAmt,
			    "totInterest" => $interestdue
			);
		}

		if($query) $result = json_encode(array('success'=>true, 'result'=>$data));
		else $result = json_encode(array('success'=>false));
		echo $result;
	}

	elseif($postjson['aksi'] == 'update_user'){
		$query = mysqli_query($mysqli, "UPDATE master_user SET
			user_name 		= '$postjson[user_name]',
			phone_number 	= '$postjson[phone_number]',
			gender 			= '$postjson[gender]' WHERE user_id='$postjson[user_id]'");

		if($query) $result = json_encode(array('success'=>true));
		else $result = json_encode(array('success'=>false));
		echo $result;
	}

	elseif($postjson['aksi'] == 'del_user'){
		$query = mysqli_query($mysqli, "DELETE FROM master_user WHERE user_id='$postjson[user_id]'");

		if($query) $result = json_encode(array('success'=>true));
		else $result = json_encode(array('success'=>false));
		echo $result;
	}

	elseif($postjson['aksi'] == 'get_datasingle'){
		$data = array();
		$query = mysqli_query($mysqli, "SELECT * FROM master_user WHERE user_id='$postjson[user_id]'");

		while($row = mysqli_fetch_array($query)){

			$data[] = array(
				'user_name' 	=> $row['user_name'],
				'phone_number' 	=> $row['phone_number'],
				'gender' 		=> $row['gender'],
				'created_at' 	=> $row['created_at']
			);
		}

		if($query) $result = json_encode(array('success'=>true, 'result'=>$data));
		else $result = json_encode(array('success'=>false));
		echo $result;
	}