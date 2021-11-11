<?php	
header('Content-type:application/json;charset=utf-8');	
require_once('../config.php');
     $json = array();
	$keyword = strval($_GET['country']);
	$search_param = "%$keyword%";
	
	$sql = mysqli_query($mysqli,"SELECT * FROM countries WHERE name LIKE '$search_param'");
	

	if (mysqli_num_rows($sql) > 0) {
		while($row = mysqli_fetch_assoc($sql)) {
		  $countryList=array('name'=>$row['name']);
          array_push($json,$countryList);
		//$countryResult[] = $row["name"];
		}
		echo json_encode($json, true);
	}
	$mysqli->close();
?>