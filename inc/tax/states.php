<?php
require_once("../config.php"); 
 $cname = $_SESSION['stateN'];
 $id = $_POST["country_id"];

   $sql = "SELECT * FROM  states WHERE country_id = $id"; 
   $result = mysqli_query($mysqli,$sql);
   $count = mysqli_num_rows($result);

   //$json = [];
   if($count > 0){
   	echo '<option value="*">*</option>';
   while($row = mysqli_fetch_assoc($result)){

   	   if($row['name'] == $cname){
        $selected = "selected";
    }else{
        $selected = "";
    }
    echo '<option value="'.$row['name'].'" '.$selected.'>'.$row['name'].'</option>';
        //$json[$row['id']] = $row['name'];

   }
}else{
  echo '<option value="*">*</option>';
	//echo $mysqli->error;
   //echo json_encode($json);
}

?>