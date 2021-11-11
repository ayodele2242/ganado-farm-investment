<?php
require_once 'functions.php';


$username = preg_replace('#[^A-Za-z0-9]#i', '',$_POST['username']);
$password = encryptIt($_POST['password']);
$sql = "
SELECT 
u_userid, 
Name, 
u_username, 
u_password,
status 
FROM 
system_users 
WHERE 
u_username = '$username' 
OR 
email='$username' 
AND u_password='$password'";


$resultset = mysqli_query($mysqli, $sql) or die("database error:". mysqli_error($mysqli));

$row = mysqli_fetch_array($resultset);



if($row['u_password']==$password AND  $row['u_username']==$username || $row['email']==$username AND $row['status']=='1'){
echo "ok";

$_SESSION['uid'] = $row['u_userid'];
$name            = $row['Name'];
$user_ip 		 = getUserIP();
$tv 			 = time();
$id 			 = $_SESSION['uid'];
//$date            = date("Y-m-d H:i");

mysqli_query($mysqli, "insert into logs(uid,name,action,ipAddress,etime)values('$id','$name','Logged In', '$user_ip', '$tv')") or die(mysqli_error($mysqli));

}else if($row['u_password']==$password AND  $row['u_username']==$username || $row['email']==$username AND $row['status'] == '0' ){
echo "i";
}	
else if($row['u_password']==$password AND  $row['u_username']==$username || $row['email']==$username AND $row['status'] == '2'){
echo "s";
}else {
echo " Invalid login details entered"; // wrong details
}


?>