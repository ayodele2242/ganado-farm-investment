<?php 

require_once('../config.php'); 

$output = array('success' => false, 'messages' => array());

$Id = $_POST['member_id'];

$sql = "DELETE FROM slidder WHERE id = {$Id}";
$sql2 = "DELETE FROM slidder_animation WHERE slidder_id = {$Id}";
$query = $mysqli->query($sql);
$query2 = $mysqli->query($sql2);
if($query === TRUE && $query2 === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Successfully Deleted';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error while deleting the information. '. $mysqli->error;
}

// close database connection
$mysqli->close();

echo json_encode($output);