<?php
require_once("../config.php");

if (isset($_POST['id']) and isset($_POST['sta'])){
    $id = $_POST['id'];
    $sta = $_POST['sta'];
    $query = "UPDATE members SET status = '$sta' WHERE id = '$id'"; 

    $exe = mysqli_query($mysqli,$query);

    if($exe && $sta == 1){
    	echo 1;
    }else if($exe && $sta == 0){
    	echo 0;
    }else{
    	echo "Error occured: ".$mysqli->error;
    }

}




?>