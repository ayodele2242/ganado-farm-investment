<?php
	require_once('../functions.php');

	/*t = date("Y-m-d H:i:s");
	$tv = time(); 
	$id = $_SESSION['id'];
	$fullname = $_SESSION['name'] ;
	$uname = $_SESSION['uname'];*/

	$name=$mysqli->real_escape_string($_POST['name']);
	$link = slug($name);
	$parent_id=$mysqli->real_escape_string($_POST['parent']);
	$position=$mysqli->real_escape_string($_POST['position']);
	$sta=$mysqli->real_escape_string($_POST['status']);
	

	$sql2 = "SELECT * FROM navigation_bar WHERE name = '$name'";
    $result = mysqli_query($mysqli,$sql2) or die($mysqli->error);
    $count = mysqli_num_rows($result);
    if ($count == 0) {
    	$sql = "INSERT INTO navigation_bar(parent_id,name, link,position,status)values('$parent_id','$name','$link','$position','$sta')";
	$done =	mysqli_query($mysqli, $sql);

	if($done){
		echo "added";
	}else{
		echo $mysqli->error;
	}

    }else{
		echo "Category already exist";
    }
?>