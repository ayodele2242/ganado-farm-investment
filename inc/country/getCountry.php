<?php
require_once("../config.php"); 


if(!empty($_POST["country_id"])){
    //Fetch all state data
    $query = "SELECT name FROM states WHERE country_id = ".$_POST["country_id"]." ORDER BY name ASC";
    $get = mysqli_query($mysqli,$query);
    
    //Count total number of rows
    $rowCount = mysqli_num_rows($get);
    
    //State option list
    if($rowCount > 0){
        echo '<option value="">Select state</option>';
        while($row = mysqli_fetch_assoc($get)){ 
            echo '<option value="'.$row['name'].'">'.$row['name'].'</option>';
        }
    }else{
        echo $mysqli->error;
    }
}elseif(!empty($_POST["state_id"])){
    //Fetch all city data
    $query = $db->query("SELECT * FROM cities WHERE state_id = ".$_POST['state_id']." AND status = 1 ORDER BY city_name ASC");
    
    //Count total number of rows
    $rowCount = $query->num_rows;
    
    //City option list
    if($rowCount > 0){
        echo '<option value="">Select city</option>';
        while($row = $query->fetch_assoc()){ 
            echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
        }
    }else{
        echo '<option value="">City not available</option>';
    }
}

?>