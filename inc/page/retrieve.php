<?php 
require_once('../../includes/functions.php'); 


$output = array('data' => array());
//$snam = $_SESSION['fname'];

$sql = "SELECT * FROM employee  order by id desc limit 30";
$query = $mysqli->query($sql);

$x = 1;
while ($row = $query->fetch_assoc()) {
 
	$status = $row['status'];



	if($row['status']=='inactive' || $row['status']=='')
	 {
	$sta = '
	<select id=code1_'.$row['id'].' onchange="getcode1(this,'.$row['id'].')" class="inactives oks">
		<option value="inactive"  selected >Inactivated</option>
		<option value="active">Activate</option>
		<option value="suspended">Suspend</option>
	</select>
	';
	}elseif($row['status']=='active')
	 {
	$sta  = '
	<select id=code1_'.$row['id'].' onchange="getcode1(this,'.$row['id'].')" class="sta-active oks">
		<option value="active"  selected >Activated</option>
		<option value="inactive"  >Inactivate</option>
		<option value="suspended" >Suspend</option>
	</select>
	
	';
	 }
	elseif($row['status']=='suspended')
	 {
	$sta  = '
	<select id=code1_'.$row['id'].' onchange="getcode1(this,'.$row['id'].')" class="suspend oks">
	   <option value="suspended"  selected >Suspended</option>
		<option value="active"  >Activate</option>
		<option value="inactive" >Inactivate</option>
	</select>
	';

	 }

	$actionButton = '

	<div class="btn-group">
	<button type="button" class="btn bg-cyan dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Action <span class="caret"></span>
	</button>
	<ul class="dropdown-menu">
		<li><a href="javascript:void(0);">Action</a></li>
		<li class="bg-light-blue"><a type="button" data-toggle="modal" id="ecustId" data-target="#eModal"   data-id='.$row['id'].'"> <span class="glyphicon glyphicon-search"></span> View More</a>	    
		</li>
		<li class="bg-orange"><a href="edit_user?id='.$row['id'].'"><span class="glyphicon glyphicon-pencil"></span> Update</a></li>
		<li class="bg-red"><a href="javascript:void(0);" data-toggle="modal" data-target="#userModal" class="text text-danger" onclick="removeUser('.$row['id'].')"> <span class="glyphicon glyphicon-trash"></span> Delete</a></li>
		
	</ul>
</div>
	';
	
	$output['data'][] = array(
		$x,
		$row['surname'],
		$row['othername'],
		$row['username'],
		$row['userEmail'],
		$row['phoneno'],
		$row['dept'],
		$row['position'],
		$sta,
		$actionButton
	);

	$x++;
}

// database connection close
$mysqli->close();

echo json_encode($output);