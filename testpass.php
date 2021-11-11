<?php

	//Encryption function
function encryptIt($string) {
    return base64_encode($string . "_@#!@");
}

//Decodes encryption
function decryptIt($str) {
    $str = base64_decode($str);
    return str_replace("_@#!@", "", $str);
}

echo encryptIt('chizzy2013');
?>