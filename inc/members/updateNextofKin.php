<?php
require_once '../functions.php';

$id = safe_input($mysqli,$_POST['id']);

if(!empty($_POST['kname'])){
$name = safe_input($mysqli,$_POST['kname']);
}else{
	echo "<br/>Name is required<br/>";
}

if(!empty($_POST['kphone'])){
$phone = safe_input($mysqli,$_POST['kphone']);
}else{
echo "Phone number is required<br/>";
}

if(!empty($_POST['kaddr'])){
$kaddr = safe_input($mysqli,$_POST['kaddr']);
}else{
echo "Address is required<br/>";
}


if(!empty($_POST['gender'])){
$gender = safe_input($mysqli,$_POST['gender']);
}else{
	$gender = "";
}



if(!empty($_POST['kname']) && !empty($_POST['kphone']) && !empty($_POST['kaddr'])){

$sql = mysqli_query($mysqli,"update members set kin_name ='$name', kin_phone = '$phone',  kin_address = '$kaddr', kin_gender = '$gender' where id = '$id'");


if($sql){
	echo 1;

}else{
	echo "Error occured: ".$mysqli->error;
}

}

?>