<?php

require "inc/config.php";

$query = mysqli_query($mysqli,"SELECT * FROM plans WHERE exp_date > DATE(NOW()) and status='active'");

$now = time(); // or your date as well
$count = mysqli_num_rows($query);
if($count > 0){
	while($row = mysqli_fetch_array($query)){
$date = $row['exp_date'];

$your_date = strtotime($date);
$datediff = $your_date-$now;

$gdate =  round($datediff / (60 * 60 * 24));
$currentgrowthrate = round($row['Amt_to_get']/$gdate);

//echo $currentgrowthrate.'<br/>';

		$id = $row['id'];

    
    /*if($row['daily_growth'] == ""){
    mysqli_query($mysqli,"insert into plans(daily_growth) values('$currentgrowthrate')") or die(mysqli_error($mysqli));
    }else{*/

	//Update payment status column
   mysqli_query($mysqli,"UPDATE plans SET daily_growth = daily_growth+$currentgrowthrate  WHERE id = '$id'")or die(mysqli_error($mysqli));
   //}

}
}


?>