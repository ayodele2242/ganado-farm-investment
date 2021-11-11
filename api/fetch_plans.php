<?php

header('Access-Control-Allow-Origin: *');

header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-type: application/json; charset=utf-8", true);
  
    include("../inc/config.php");


 $response = array(); 
    $setSql = "SELECT * FROM store_setting";
    $setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
    $set = mysqli_fetch_array($setRes);


 // select first 3 posts
 $query = "SELECT * FROM farm_packages order by id desc";
 $result = mysqli_query($mysqli,$query);

 $count = mysqli_num_rows($result);


 while($get = mysqli_fetch_array($result)){
    $interesttotal = ceil((($get['capital'] / 100 * $get['percent']) * $get['duration'])/50)*50;
$interestdue = round($get['capital'] / 100 * $get['percent']);
$totalAmt = $get['capital'] + $interestdue;

if(empty($get['img'])){
$myimg  = $set['installUrl'].'assets/img/farm.png';
}else{
$myimg = $set['installUrl'].'assets/images/'.$get['img'];
}


array_push($response, array(
       
      "img"        => $myimg,
    "category"   => ucwords($get['category']),
    "percent"    => $get['percent'],
    "duration"   => $get['duration'],
    "capital"    => $get['capital'],
    "capFormat"    => '₦'.number_format($get['capital']),
    "totAmt"    =>  $totalAmt,
    "totInterest" => $interestdue
        )
    
    );

 }


 echo json_encode(array("data" => $response));



?>