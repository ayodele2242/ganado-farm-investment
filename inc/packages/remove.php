<?php 

require_once('../config.php'); 



$id = $_POST['member_id'];

//Let check if this package has investors on it

$query = mysqli_query($mysqli,"select plan_id from plans where plan_id='$id'");
$count = mysqli_num_rows($query);
if($count > 0){
	echo "You can't delete this plan. It has investors on it already";
}else{


$sql = "DELETE FROM farm_packages WHERE id = {$id}";
$query = $mysqli->query($sql);
if($query === TRUE) {
	echo 1;
} else {
	echo  'Error while deleting. '. $mysqli->error;
}


}

// close database connection
$mysqli->close();

