<?php 
require_once('../config.php'); 


$output = array('data' => array());


$sql = "SELECT * FROM  navigation_bar  order by id desc";
$query = $mysqli->query($sql);

$x = 1;
while ($row = $query->fetch_assoc()) {
 
	//$status = $row['status'];

	if($row['status'] == "1"){
	$es = "checked";
	}else{
	$es = "";
	}

	if($row['status'] == "1"){
	$sta  = '

  <a href="#menuactivateModal" type="button" data-toggle="modal"  class="btn btn-floating waves-effect waves-light green z-depth-4 btn-small  modal-trigger" onclick="activateMenu('.$row['id'].')"> <i class="material-icons left">edit</i>
    </a>	
           ';
	 }else{
	 	$sta  = ' 

  <a href="#menuactivateModal" type="button" data-toggle="modal"  class="btn btn-floating waves-effect waves-light red z-depth-4 btn-small  modal-trigger" onclick="activateMenu('.$row['id'].')"> <i class="material-icons left">edit</i>
    </a>	
           ';
	 }
	

	$actionButton = '
	<a href="#menuModal" type="button" data-toggle="modal"  class="btn btn-floating waves-effect waves-light red z-depth-4 btn-small  modal-trigger" onclick="removeMenu('.$row['id'].')"> <i class="material-icons left">delete</i>
    </a>	
	';
	
	$output['data'][] = array(
		$x,
		$row['parent_id'],
		$row['name'],
		$row['link'],
		$row['position'],
		$sta,		
		$actionButton
	);

	$x++;
}

// database connection close
$mysqli->close();

echo json_encode($output);