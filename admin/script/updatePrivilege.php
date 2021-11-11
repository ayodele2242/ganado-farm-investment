<?php
require_once("../../inc/functions.php");

if(empty($_POST['ucode']) && empty($_POST['module'])){
	echo "Select menu module";
}else{
$urole = $_POST['ucode'];

//error_reporting(0);

//Check if modules have already been assigned to this user in the database
$check = "SELECT rr_rolecode, rr_modulecode FROM role_rights WHERE rr_rolecode = '$urole' AND rr_modulecode IN ('".implode("','",$_POST['module'])."')";
$query = mysqli_query($mysqli, $check);
$count = mysqli_num_rows($query);


if($count == 0){


if(!empty($_POST['module'])){
$rowCount = count($_POST['module']);

for($i = 0; $i < $rowCount; $i++)
 { 
if(!empty($_POST['module'][$i])) {		
$module = $_POST['module'][$i];
}else{
	echo "Select menu module";
}
if(!empty($_POST['create'][$i])){
$create = $_POST['create'][$i];	
}else{
	echo "Select create privilege for this module<br/>";
}
if(!empty($_POST['edit'][$i])){
$edit = $_POST['edit'][$i];
}else{
	echo "Select edit privilege for this module<br/>";
}
if(!empty($_POST['delete'][$i])){
$del = $_POST['delete'][$i];
}else{
	echo "Select delete privilege for this module<br/>";
}
if(!empty($_POST['view'][$i])){
$view = $_POST['view'][$i];
}else{
	echo "Select view privilege for this module<br/>";
}

if(!empty($_POST['module'][$i]) && !empty($_POST['create'][$i]) && !empty($_POST['edit'][$i]) && !empty($_POST['delete'][$i]) && !empty($_POST['view'][$i])) {	

 
                $sql = "INSERT INTO role_rights(rr_rolecode,rr_modulecode,rr_create,rr_edit,rr_delete,rr_view) 
                VALUES('$urole', '$module','$create','$edit','$del','$view')";

              $suc =  mysqli_query($mysqli, $sql); 
              } else{
              	echo "Check for empty module privileges <br/>";
              }
            
 }
}else{
	echo "error :".$mysqli->error;
}

if(isset($suc)){
 echo "i";
}else{
 	echo "Module Error: ".$mysqli->error;
 }  


}else{

echo "You have already assigned ".implode(", ",$_POST['module'])." to this user";

}


}



?>