<?php
//Get first letter of a str

function initials($str) {
    $ret = '';
    foreach (explode(' ', $str) as $word)
        $ret .= strtoupper($word[0]);
    return $ret;
}



function obfuscate_email($email)
{
    $em   = explode("@",$email);
    $name = implode('@', array_slice($em, 0, count($em)-1));
    $len  = floor(strlen($name)/2);

    return substr($name,0, $len) . str_repeat('*', $len) . "@" . end($em);   
}

function planHistory($email, $limit){
    global $mysqli;
    $query = "SELECT * FROM plans WHERE email='$email' limit $limit";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

//log activities
function activitiesLog($id, $limit){
    global $mysqli;
    $query = "SELECT * FROM users_log WHERE user_id='$id' limit $limit";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

function getBalance($email){
    global $mysqli;
    $query = "SELECT sum(daily_growth) as totAmt FROM plans where transId !='' and trasaction_status='successful' and email='$email'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);
   if($row['totAmt'] > 0){
    echo   number_format($row['totAmt'],2);
  }else{
    echo "0";
  }
 }

 function totInvested($email){
    global $mysqli;
    $query = "SELECT sum(amount_invested) as totInv FROM plans where transId !='' and trasaction_status='successful' and email='$email'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);
   if($row['totInv'] > 0){
    echo   number_format($row['totInv'],2);
  }else{
    echo "0";
  }
 }

  function totReturned($email){
    global $mysqli;
    $query = "SELECT sum(Amt_to_get) as totGet FROM plans where transId !='' and trasaction_status='successful' and email='$email'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);
   if($row['totGet'] > 0){
    echo   number_format($row['totGet'],2);
  }else{
    echo "0";
  }
 }

?>