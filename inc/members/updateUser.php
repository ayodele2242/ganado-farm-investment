<?php
require_once '../functions.php';

$id = safe_input($mysqli,$_POST['id']);

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


if(!empty($_POST['name']) && !empty($_POST['phone']) && !empty($_POST['gender']) && !empty($_POST['dob'])){

$sql = mysqli_query($mysqli,"update members set name='$name',phone='$phone',dob='$dob',gender='$gender', img='$filename' where id = '$id'");


if($sql){
	echo 1;

}else{
	echo "Error occured: ".$mysqli->error;
}

}

?>