<?php 
require_once('../config.php'); 


$output = array('data' => array());


$sql = "SELECT * FROM farm_packages order by id desc";
$query = $mysqli->query($sql);

$x = 1;
while ($row = $query->fetch_assoc()) {
 
	
	

	$actionButton = '
	<a  type="button" id="'.$row['id'].'" data-name="'.$row['category'].'"  class="btn btn-floating waves-effect waves-light green z-depth-4 btn-small editPro " onclick="updatePackage('.$row['id'].')"> <i class="material-icons left">edit</i>
    </a>	

	<a href="#menuModal" type="button" data-toggle="modal"  class="btn btn-floating waves-effect waves-light red z-depth-4 btn-small  modal-trigger" onclick="removePackage('.$row['id'].')"> <i class="material-icons left">delete</i>
    </a>	
	';
	
	$output['data'][] = array(
		$x,
		$row['category'],
		$row['duration'],
		$row['percent'].'%',
		
		number_format($row['capital']),	
		$actionButton
	);

	$x++;
}

// database connection close
$mysqli->close();

echo json_encode($output);