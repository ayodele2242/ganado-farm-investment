<?php

require_once("../config.php");


$cur=$mysqli->real_escape_string($_POST['currency']);
$cur_post = $_POST['currency_position'];

 $get_cur = explode(',' , $cur);	

 $curre1  = $get_cur[0];
 $country = $get_cur[1];

 
//update database and and echo 1 for success 
$link = "UPDATE currency_setting SET currency='$curre1', currency_position='$cur_post', country_name='$country'";
 
if(mysqli_query($mysqli, $link)){
	echo 1;
}else{
	echo $mysqli->error;
}

//}



?>
 