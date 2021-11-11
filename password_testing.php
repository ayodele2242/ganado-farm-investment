<?php
$dbhost = 'localhost'; 
$dbuser = 'ganadoap_ganadof';
$dbpass = 'father2242';
$dbname = 'ganadoap_ganadofarm';

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


//Encryption function
function easy_crypt($string) {
    return base64_encode($string . "_@#!@");
}

//Decodes encryption
function easy_decrypt($str) {
    $str = base64_decode($str);
    return str_replace("_@#!@", "", $str);
}



	function encryptIt($value) {
		// The encodeKey MUST match the decodeKey
		$encodeKey = 'swGn@7q#5y0z%E4!C#5y@9Tx@_*-=098765zyrad';
		$encoded = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($encodeKey), $value, MCRYPT_MODE_CBC, md5(md5($encodeKey))));
		return($encoded);
	}

    /*
     * Function to decrypt sensitive data from the database for displaying
     *
     * @param string	$value		The text to be decrypted
	 * @param 			$decodeKey	The Key to use for decryption
     * @return						The decrypted text
     */
	function decryptIt($value) {
		// The decodeKey MUST match the encodeKey
		$decodeKey = 'swGn@7q#5y0z%E4!C#5y@9Tx@_*-=098765zyrad';
		$decoded = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($decodeKey), base64_decode($value), MCRYPT_MODE_CBC, md5(md5($decodeKey))), "\0");
		return($decoded);
	}


$query = mysqli_query($mysqli,"SELECT id, password FROM members WHERE id BETWEEN 44 AND 72");


while($row = mysqli_fetch_array($query)){

	$id = $row['id'];
	$pas = $row['password'];

$pass = decryptIt($pas);

echo $pass.'<br/>';

$enc = easy_crypt($pass);

$dec = 	easy_decrypt($enc);

echo $enc.'<br/>';
echo $dec;

}
?>