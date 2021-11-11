<?php
require_once("config.php");

if (isset($_POST['email'])){
    $email = $_POST['email'];
    $query = "UPDATE store_setting SET email_status = $email"; 

    $exe = mysqli_query($mysqli,$query);

    if($exe && $email == 1){
    	echo 1;
    }else if($exe && $email == 0){
    	echo 0;
    }else{
    	echo "Error occured: ".$mysqli->error;
    }

}

//Activity Status
if (isset($_POST['activity'])){
    $activity = $_POST['activity'];
    $query = "UPDATE store_setting SET activity_status = $activity"; 

    $exe = mysqli_query($mysqli,$query);

    if($exe && $activity == 1){
        echo 1;
    }else if($exe && $activity == 0){
        echo 0;
    }else{
        echo "Error occured: ".$mysqli->error;
    }

}

//Activity Status
if (isset($_POST['notify'])){
    $notify = $_POST['notify'];
    $query = "UPDATE store_setting SET notification_status = $notify"; 

    $exe = mysqli_query($mysqli,$query);

    if($exe && $notify == 1){
        echo 1;
    }else if($exe && $notify == 0){
        echo 0;
    }else{
        echo "Error occured: ".$mysqli->error;
    }

}




?>