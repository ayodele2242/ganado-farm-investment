<?php
    include "../functions.php";
    
	
   
    $html = $mysqli->real_escape_string(clean($_POST['jobdes']));
	
    

    

    $sql = "UPDATE policy SET content = '$html'";
    $insert = mysqli_query($mysqli, $sql);

if($insert){
    echo "added"; 
    }
    else{
        echo $mysqli->error;
    }

    

mysqli_close($mysqli);



	?>