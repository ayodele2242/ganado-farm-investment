<?php

    header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Credentials: true");
	header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
	header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
	header("Content-Type: application/json; charset=utf-8");      

	 include("../inc/functions.php");
  
    //if($_SERVER["REQUEST_METHOD"]=="POST"){ 
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

	elseif($postjson['aksi'] == 'get_user'){
		$data = array();
		$query = mysqli_query($mysqli, "SELECT * FROM members WHERE  email = '$postjson[email]' ");

		while($row = mysqli_fetch_array($query)){
		    
		     if(empty($row['img'])){
              $img = $set['installUrl'].'assets/logo/avatar.png';
            }else{
               $img = $set['installUrl'].'assets/images/'.$row['img'];
            }

			$data[] = array(
			 "id"=>$row['id'],
            "name"=>ucwords($row['name']),
            "phone"=>$row['phone'],
            "email"=>$row['email'],
            "dob"=>$row['dob'],
            "gender"=>$row['gender'],
            "acname"=>$row['account_name'],
            "acno"=>$row['account_number'],
            "bank_name"=>$row['bank_name'],
            "bank_code"=>$row['bank_code'],
            "myimg" => $img,
            "trans_code"=>$row['Trx_code']
			);
		}

		if($query) $result = json_encode(array('success'=>true, 'data'=>$data));
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