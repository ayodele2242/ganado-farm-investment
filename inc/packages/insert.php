<?php
	require_once('../functions.php');

	
if(!empty($_POST['name']) && !empty($_POST['percentage']) && !empty($_POST['duration']) && !empty($_POST['amount'])){
	$name=$mysqli->real_escape_string($_POST['name']);
	$percent=$mysqli->real_escape_string($_POST['percentage']);
	$duration=$mysqli->real_escape_string($_POST['duration']);
	$amt=$mysqli->real_escape_string($_POST['amount']);
	$descr = $mysqli->real_escape_string($_POST['info']);


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
   echo "Error updating profile images";
}else{
   /* Upload file */
   move_uploaded_file($_FILES['image']['tmp_name'],$location);
      //echo $location;
   }
}else{
	$filename = "";
}

	

	$sql2 = "SELECT * FROM farm_packages WHERE category = '$name' and duration = '$duration'";
    $result = mysqli_query($mysqli,$sql2) or die($mysqli->error);
    $count = mysqli_num_rows($result);
    if ($count < 1) {
    	$sql = "INSERT INTO farm_packages(category,percent,duration,capital,details,img)values('$name','$percent','$duration','$amt','$descr','$filename')";
	$done =	mysqli_query($mysqli, $sql);

	if($done){
		echo "done";
	}else{
		echo $mysqli->error;
	}

    }else{
		echo "Farm plan already exist";
    }
}else{
	echo "Check for empty values";
}
?>