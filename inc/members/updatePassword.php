<?php
require_once '../functions.php';




$id = safe_input($mysqli,$_POST['pass_id']);
$oldpass = encryptIt($_POST['old_password']);
$newPass = stripslashes($_POST['new_password']);
$confirmPass = stripslashes($_POST['con_password']);

$pass = encryptIt($newPass);

if($newPass != $confirmPass){
	echo "<br/>Your new and confirm password are not equal";
}else if(empty($_POST['old_password']) || empty($_POST['new_password']) || empty($_POST['con_password'])){
	echo "Check for empty input values";
}
else{
$sel = mysqli_query($mysqli, "SELECT password FROM members WHERE password = '$oldpass' and id='$id'");
$count = mysqli_num_rows($sel);

if($count == 0){
echo "Your old password is wrong. Please check and try again.";
}else if($oldpass == $pass){
echo "You can not update to your old password. Try another one.";
}else{
$sql = "UPDATE members SET password = '$pass' WHERE id = '$id'";

if ($mysqli->query($sql) === TRUE) {
echo 1;
} else {
 echo "Error occured: " . $mysqli->error;
}

}


}


?>