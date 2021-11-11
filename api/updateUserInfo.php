<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");

include("../inc/config.php");

$postjson = json_decode(file_get_contents('php://input'), true);


if($postjson['aksi'] == 'update_user'){
		$data = array();

		$datenow = date('Y-m-d');
		$dob = $postjson['dob'];
		$date1 = strtr($dob, '/', '-');

        $sdate =  date('Y-m-d', strtotime($date1));
        $kname = $mysqli->real_escape_string($postjson['kname']); 
        $kphone = $mysqli->real_escape_string($postjson['kphone']); 
        $kaddr = $mysqli->real_escape_string($postjson['kaddr']); 

		$query = mysqli_query($mysqli, "
		UPDATE members SET name = '$postjson[name]', 
		phone = '$postjson[phone]', gender = '$postjson[gender]', 
		dob = '$sdate', kin_name = '$kname', kin_phone = '$kphone', 
		kin_address = '$kaddr'  where id = '$postjson[myid]'
		");

		//$idadd = mysqli_insert_id($mysqli);

		if($query){
			$result = json_encode(array('success'=>true));
		} 
		else{ 
			$result = json_encode(array('success'=>false));
		}
		echo $result;
	}


if($postjson['aksi'] == 'update_picture'){
		$data = array();

		$datenow = date('Y-m-d');

		$datenowxx = date('Y-m-d_H_i_s'); // remove duplicate name image 
		if(empty($postjson['images'])){
			$directory = "../assets/logo/avatar.png";
		}else{
        
		$entry = base64_decode($postjson['images']);
		$img = imagecreatefromstring($entry);
		

		$directory = "../assets/images/img_user".$datenowxx.".jpg"; // save to folder sever 
		
		imagejpeg($img, $directory);
		imagedestroy($img);

		}
		
		if(!empty($entry)){
		    $imagename = "img_user".$datenowxx.".jpg";
		}else{
		    $imagename = $postjson['myimg'];
		}

		$query = mysqli_query($mysqli, " UPDATE members SET img = '$imagename' where id = '$postjson[myid]'
		");

		//$idadd = mysqli_insert_id($mysqli);

		if($query){
			$result = json_encode(array('success'=>true));
		} 
		else{ 
			$result = json_encode(array('success'=>false));
		}
		echo $result;
	}


?>