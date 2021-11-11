<?php 

require_once('../config.php'); 


$output = array('success' => false, 'messages' => array());

$memberId = $_POST['member_id'];

$sql = "DELETE FROM mp_pages WHERE page_id = {$memberId}";
$query = $mysqli->query($sql);
if($query === TRUE) {
	$output['success'] = true;
	$output['messages'] = 'Successfully Deleted';
} else {
	$output['success'] = false;
	$output['messages'] = 'Error while deleting the information.' ;
}

// close database connection
$mysqli->close();

echo json_encode($output);