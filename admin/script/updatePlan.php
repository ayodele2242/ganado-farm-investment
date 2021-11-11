<?php

require_once("../../inc/config.php");

$setSql = "SELECT * FROM store_setting";
    $setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
    $set = mysqli_fetch_array($setRes);

 
 if(!empty($_POST['name']) && !empty($_POST['percentage']) && !empty($_POST['duration']) && !empty($_POST['amount'])){
	$name=$mysqli->real_escape_string($_POST['name']);
	$percent=$mysqli->real_escape_string($_POST['percentage']);
	$duration=$mysqli->real_escape_string($_POST['duration']);
	$amt=$mysqli->real_escape_string($_POST['amount']);

	$id = $mysqli->real_escape_string($_POST['id']);

	$pimg = $_POST['pimg'];


if (!empty($_FILES['image']['name'])) {
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
   echo "Invalid image uploaded<br/>";
}

if($uploadOk == 0){
   echo "Error updating image";
}else{
   /* Upload file */
   move_uploaded_file($_FILES['image']['tmp_name'],$location);
      //echo $location;
   }
}else{
	$filename = $pimg;
}
	

	$sql2 = "SELECT * FROM plans WHERE plan_id = '$id'";
    $result = mysqli_query($mysqli,$sql2) or die($mysqli->error);
    $count = mysqli_num_rows($result);
    if ($count == 0) {
    	$sql = "UPDATE farm_packages SET category='$name',percent='$percent',duration='$duration',capital='$amt',img='$filename' WHERE id='$id'";
	$done =	mysqli_query($mysqli, $sql);

	if($done){
		echo 1;
	}else{
		echo $mysqli->error;
	}

    }else{
		echo "You can not update this plan. Investors are already on it";
    }
}else{
	echo "Check for empty values";
}


?>
 