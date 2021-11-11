<?php
require_once '../functions.php';



if(!empty($_POST['name'])){
$name = safe_input($mysqli,$_POST['name']);
}else{
	echo "Name is required<br/>";
}

if(!empty($_POST['phone'])){
$phone = safe_input($mysqli,$_POST['phone']);
}else{
$phone = "";
}
$email = safe_input($mysqli, $_POST['email']);

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


if(!empty($_POST['dob'])){
$dob = safe_input($mysqli,$_POST['dob']);
}else{
	$dob = "";
}

if(!empty($_POST['gender'])){
$gender = safe_input($mysqli,$_POST['gender']);
}else{
	$gender = "";
}

if(!empty($_POST['kname'])){
$kname = safe_input($mysqli,$_POST['kname']);
}else{
	$kname = "";
}

if(!empty($_POST['kphone'])){
$kphone = safe_input($mysqli,$_POST['kphone']);
}else{
	$kphone = "";
}

if(!empty($_POST['kaddr'])){
$kaddr = safe_input($mysqli,$_POST['kaddr']);
}else{
	$kaddr = "";
}






$old_password=safe_input($mysqli,$_POST['old_password']);
$new_password=safe_input($mysqli,$_POST['new_password']);
$con_password=safe_input($mysqli,$_POST['con_password']);
$chg_pwd=mysqli_query($mysqli,"select * from members where email = '$email'");
$chg_pwd1=mysqli_fetch_array($chg_pwd);
$data_pwd=$chg_pwd1['password'];

if(!empty($old_password) && !empty($new_password) && !empty($con_password)){

if($data_pwd==encryptIt($old_password)){
if($new_password==$con_password){
$update_pwd=mysqli_query($mysqli,"update members set password='$new_password' where email = '$email'");
echo "Update Sucessfully !!!";
}
else{
echo "Your new and Retype Password is not match !!!";
}
}
else
{
echo "Your old password is wrong !!!";
}
}


if (!empty($_FILES['image'])) {


/* Getting file name */
$filename = $_FILES['image']['name'];

/* Location */
$location = "../../assets/images/".$filename;
$uploadOk = 1;
$imageFileType = pathinfo($location,PATHINFO_EXTENSION);

/* Valid Extensions */
$valid_extensions = array("jpg","jpeg","png");
/* Check file extension */
if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
   $uploadOk = 0;
   echo "Invalid image uploaded";
}

if($uploadOk == 0){
   echo "Error updating profile image";
}else{
   /* Upload file */
   move_uploaded_file($_FILES['image']['tmp_name'],$location);
      //echo $location;
   }
}else{
	$filename = "";
}






$sql = mysqli_query($mysqli,"update members set name='$name',phone='$phone',dob='$dob',gender='$gender', img='$filename', kin_name ='$kname', kin_phone = '$kphone', kin_address = '$kaddr' where email = '$email'");


if($sql){
	echo 1;

}else{
	echo "Error occured: ".$mysqli->error;
}





















?>