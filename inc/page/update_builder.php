<?php
    include "../functions.php";
    
	
    $id = $mysqli->real_escape_string($_POST['id']);
    $html = $mysqli->real_escape_string(clean($_POST['html']));
	$css = $mysqli->real_escape_string($_POST['css']); 

    

    

    $sql = "UPDATE mp_pages SET page_desc = '$html', css = '$css'  where page_id = '$id'";
    $insert = mysqli_query($mysqli, $sql);

if($insert){
    echo "added"; 
    }
    else{
        echo $mysqli->error;
    }

    

mysqli_close($mysqli);



	?>