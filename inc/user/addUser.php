<?php
require_once("../functions.php");

$name = safe_input($mysqli,$_POST['name']);
$email = safe_input($mysqli, $_POST['Email']);
$phone = safe_input($mysqli,$_POST['contactNum']);
$username = safe_input($mysqli,$_POST['username']);
$pass = encryptIt($_POST['password']);
$sta =  $_POST['status'];
$role = $_POST['urole'];

$u_me = strtoupper($username);

//get if user already exist in db
$getU = "SELECT u_username from system_users WHERE u_username ='$username'";

   $ok = mysqli_query($mysqli, $getU);
   $countIt = mysqli_num_rows($ok);
   

//Check if modules have already been assigned to this user in the database
$check = "SELECT rr_rolecode, rr_modulecode FROM role_rights WHERE rr_rolecode = '$username' AND rr_modulecode IN ('".implode("','",$_POST['module'])."')";
$query = mysqli_query($mysqli, $check);
$count = mysqli_num_rows($query);

if($count == 0 && $countIt == 0){


if(!empty($_POST['module'])){
$rowCount = count($_POST['module']);

for($i = 0; $i < $rowCount; $i++)
 { 		
$module = $_POST['module'][$i];
$edit = $_POST['edit'][$i];
$view = $_POST['view'][$i];
$create = $_POST['create'][$i];
$del = $_POST['delete'][$i];

 
                $sql = "INSERT INTO role_rights(rr_rolecode,rr_modulecode,rr_create,rr_edit,rr_delete,rr_view) 
                VALUES('$u_me', '$module','$create','$edit','$del','$view')";

              $suc =  mysqli_query($mysqli, $sql);  
            
 }
}else{
	echo "error :".$mysqli->error;
}

 if($suc){

 	$user = mysqli_query($mysqli, "insert into system_users(
	Name,
	u_username,
	u_password,
	email,
	phone,
	u_rolecode,
	status
	)values(
	'$name',
	'$username',
	'$pass',
	'$email',
	'$phone',
	'$u_me',
	'$sta') 
	");

if($suc){
	echo "i";
}else{
	echo "Error occured: ". $mysqli->error;
}


 }else{
 	echo "Module Error: ".$mysqli->error;
 }  


}else{

if($count > 0){
echo "You have already assigned ".implode(", ",$_POST['module'])." to this user";
}else if($countIt > 0){
	echo "Username already exist in the database.";
}

}






?>