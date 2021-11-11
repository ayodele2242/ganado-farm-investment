<?php
require_once '../functions.php';



$email = safe_input($mysqli, $_POST['email']);
$pass = $_POST['password'];



  setcookie ("member_login",$email,time()+ (10 * 365 * 24 * 60 * 60));  
    setcookie ("member_password",$pass,time()+ (10 * 365 * 24 * 60 * 60));

?>