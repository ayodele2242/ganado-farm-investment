<?php
	$host="localhost";
	$uname="root";
	$pwd="";
	$dbase="ama";
	$conn=mysqli_connect($host,$uname,$pwd,$dbase);
	if(!$conn){
		die();
	}else{
		header('Access-Control-Allow-Origin: *'); 
	}
?>