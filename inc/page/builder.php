<?php
    include "../functions.php";
    
	
    $link = $mysqli->real_escape_string($_POST['link']);
    $html = $mysqli->real_escape_string(clean($_POST['html']));
	$css = $mysqli->real_escape_string($_POST['css']); 

    $string = str_replace('-', ' ', $link);

    $title = ucwords($string);
    $time = time();


    $sql2 = "SELECT page_title FROM mp_pages WHERE  page_title  = '$link'";
    $result = mysqli_query($mysqli, $sql2) or die($mysqli->error);
    $count = mysqli_num_rows($result);
    if ($count == 0) {
    	$sql = "INSERT INTO mp_pages 
		(nav_id,page_title, page_desc, ptime, css) 
		values('$link','$title','$html', '$time', '$css')";
    $insert = mysqli_query($mysqli, $sql);
    
    if($insert){
    echo "added";  
    }
    else{
        echo $mysqli->error;
    }

    }else{
    	 //echo "1";

    $sql = "UPDATE mp_pages SET
		page_title = '$title', page_desc = '$html', css = '$css' WHERE  nav_id = '$link'
	   ";
    $insert = mysqli_query($mysqli, $sql);

if($insert){
    echo "added"; 
    }
    else{
        echo $mysqli->error;
    }

    }





	?>