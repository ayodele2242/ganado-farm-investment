<?php
session_start();
ob_start();

set_time_limit(0);

$dbhost = 'localhost'; 
$dbuser = 'root';
$dbpass = '';
$dbname = 'ganado';

//Mysqli
$mysqli = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
if (mysqli_connect_errno()) {
printf("MySQLi connection failed: ", mysqli_connect_error());
exit();
}

// Change character set to utf8
if (!$mysqli->set_charset('utf8')) {
printf('Error loading character set utf8: %s\n', $mysqli->error);
}

//PDO
try{

$db_con = new PDO("mysql:host={$dbhost};dbname={$dbname}",$dbuser,$dbpass);
$db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
echo $e->getMessage();
}

// Upload configs.
define('UPLOAD_DIR', '../uploads');
define('UPLOAD_MAX_FILE_SIZE', 10485760); // 10MB.
define('UPLOAD_ALLOWED_MIME_TYPES', 'image/jpeg,image/png,image/gif');


function genTranxRef($length)
{
//return TransactionRefGen::getHashedToken();
$token = "";
$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
$codeAlphabet.= "0123456789";
$max = strlen($codeAlphabet);



for ($i=0; $i < $length; $i++) {
$token .= $codeAlphabet[rand(0, $max-1)];
}

return $token;
}
?>
