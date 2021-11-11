<?php
	header('Access-Control-Allow-Origin: *'); 
	$target_dir="../account/avatars/";
	$target_file=$target_dir.basename($_FILES["photo"]["name"]);
	$uploadOk=1;
	$imageFileType=pathinfo($target_file,PATHINFO_EXTENSION);
	$check=getimagesize($_FILES["photo"]["tmp_name"]);
	if($check!=false){
		//echo "File is an image - ".$check(["mime"]).".";
		$uploadOk=1;
		if(move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)){
			$response=array("response"=>"success");
		}else{
			$response=array("response"=>"error-000");
		}
	}else{
		$uploadOk=0;
		$response=array("response"=>"error-001");
	}
	echo json_encode($response);
?>