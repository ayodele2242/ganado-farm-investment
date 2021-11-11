<?php

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");
header("Content-Type: application/json; charset=utf-8");
	
require_once '../functions.php';




$email = safe_input($mysqli, $_POST['email']);


if(!empty($_POST['Transfer_Ref_Code'])){
$ref =  safe_input($mysqli,$_POST['Transfer_Ref_Code']);
}else{
	$ref = "";
}

if(!empty($_POST['bank_account_number'])){
$ac_no = safe_input($mysqli,$_POST['bank_account_number']);
}else{
	$ac_no = "";
}

if(!empty($_POST['bank_account_name'])){
$acname = safe_input($mysqli,$_POST['bank_account_name']);
}else{
	$acname = "";
}
if(!empty($_POST['bankname'])){
$bank =  safe_input($mysqli,$_POST['bankname']);
}else{
	$bank = "";
}







$sql = mysqli_query($mysqli,"update members set account_name='$acname',account_number='$ac_no',bank_code='$bank', Trx_code='$ref' where email = '$email'");


if($sql){
	echo 1;

}else{
	echo "Error occured: ".$mysqli->error;
}





















?>