<?php
require_once('../functions.php');

$rowCount = count($_POST['countrycode']);

for($i = 0; $i < $rowCount; $i++){
      
    $countrycode = $mysqli->real_escape_string($_POST['countrycode']); 
    $statecode = $mysqli->real_escape_string($_POST['statecode']); 
    $postcode = $mysqli->real_escape_string($_POST['postcode']);
    $city = $mysqli->real_escape_string($_POST['city']); 
    $rate = $mysqli->real_escape_string($_POST['rate']); 
    $taxname = $mysqli->real_escape_string($_POST['taxname']); 
    $priority = $mysqli->real_escape_string($_POST['priority']); 
    $compound = $mysqli->real_escape_string($_POST['compound']); 
    $shipping = $mysqli->real_escape_string($_POST['shipping']); 


    $upTags = "INSERT INTO tags (tag) VALUES ('$tag')";
    if ($mysqli->query($upTags) === TRUE) echo "added to DB";
    header("Refresh:1");
}

?>