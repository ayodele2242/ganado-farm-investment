<?php
include("functions.php");
if(!isset($_SESSION['uid'])){
    redirect('login/login');
}else{ 
//error_reporting(0);	
$msgBox = '';
$activeAccount = '';
$nowActive = '';  


$t = date("Y-m-d H:i:s");
$tv = time(); 

$id = $_SESSION['uid'];
$user = mysqli_query($mysqli, "select * from system_users where u_userid='$id' ");
$d = mysqli_fetch_assoc($user);

$name  = $d['Name'];
$uname = $d['u_username'];
$email = $d['email'];
$_SESSION["rolecode"] = $d['u_rolecode'];
$tel   = $d['phone'];

$_SESSION['name'] = $name;
$_SESSION['uname'] = $uname;

$neverText = '';

//Get country from currency table
$currency = mysqli_query($mysqli, "select country_name,currency_position from currency_setting ");
$country = mysqli_fetch_assoc($currency);
$cname = $country['country_name'];
$cpost = $country['currency_position'];
$ccode = $country['code'];


//get states name from states table
$state = mysqli_query($mysqli, "select name from states");
$cstate = mysqli_fetch_assoc($state);
$sname = $cstate['name'];
$_SESSION['state'] = $sname;


// Logout
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action == 'logout') {
          session_unset();
        session_destroy();
         redirect('login/login');
    }
}

//get users privilege
//$mpri = mysqli_query($mysqli,"select ")

//get store settings details
$que = "select * from store_setting";
$our = mysqli_query($mysqli,$que);
$set = mysqli_fetch_array($our);
$country_name = $set['country'];
$_SESSION['stateName'] = $set['state'];

//get tax settings details
$que2 = "select countrycode, statecode from tax_details";
$our2 = mysqli_query($mysqli,$que2);
$taxm = mysqli_fetch_array($our2);
$taxcountry = $taxm['countrycode'];
$_SESSION['stateN'] = $taxm['state'];


if($set['email_status'] == 1){
	$es = "checked";
}else{
	$es = "";
}
if($set['activity_status'] == 1){
	$active = "checked";
}else{
	$active = "";
}
if($set['notification_status'] == 1){
	$notify = "checked";
}else{
	$notify = "";
}



//Menu Status
$mque = "select status from navigation_bar";
$mour = mysqli_query($mysqli,$mque);
$msta = mysqli_fetch_array($mour);
if($msta['status'] == 1){
    $mactive = "checked";
}else{
    $mactive = "";
}

function roles(){
global $mysqli;
$urole="SELECT * FROM role";
$run = mysqli_query($mysqli, $urole);
while ($row=mysqli_fetch_array($run)) {
	echo '<option value="'.$row['role_rolecode'].'">'.$row['role_rolecode'].'</option>';
      }

}

function currency(){
global $mysqli;
global $cname;
$cur="SELECT * FROM currency";
$run = mysqli_query($mysqli, $cur);
while ($row=mysqli_fetch_array($run)) {
    if($row['name'] == $cname){
        $selected = "selected";
    }else{
        $selected = "";
    }
    echo '<option value="'.$row['currency_symbol'].','.$row['name'].'" '.$selected.'>'.$row['name'].' ('.$row['code'].')   '. $row['currency_symbol'].'</option>';
      }

}


function countryCode(){
    global $mysqli;
    global $taxcountry;
    $ccsql="SELECT id,name,iso2 FROM countries";
        $ccsql_run = mysqli_query($mysqli, $ccsql);
        while ($row=mysqli_fetch_array($ccsql_run)) {
       if($row['iso2'] == $ccode){
        $selected = "selected";
        }else{
            $selected = "";
        }
            echo '<option value="'.$row["id"].'" '.$selected.'>'.$row['name']. ' ('.$row['iso2'].')</option>';
    }
}

function stateCode(){
global $mysqli;
global $sname;
$cur="SELECT * FROM states ORDER BY name";
$run = mysqli_query($mysqli, $cur);
while ($row=mysqli_fetch_array($run)) {
    if($row['states'] == $sname){
        $selected = "selected";
    }else{
        $selected = "";
    }
    echo '<option value="'.$row['name'].'" '.$selected.'>'.$row['name'].'</option>';
    }

}

function getUsers(){
	global $mysqli;
    $query = "SELECT * FROM system_users ORDER BY name ASC ";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    }


function getPlans(){
    global $mysqli;
    $query = "SELECT * FROM farm_packages order by id desc ";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

function getInvestors(){
    global $mysqli;
    $query = "SELECT * FROM members order by name desc ";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

function getInvestments(){
    global $mysqli;
    $query = "SELECT p.*, m.name, m.phone FROM plans p JOIN members m ON p.email = m.email WHERE p.trasaction_status = 'successful'  ";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

function failedInvestments(){
    global $mysqli;
    $query = "SELECT p.*, m.name, m.phone FROM plans p JOIN members m ON p.email = m.email WHERE p.trasaction_status != 'successful'";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}


function getBIDDERS(){
    global $mysqli;
    $query = "SELECT c.*, a.address, a.city, a.state FROM contractor c left join address a on c.email = a.email";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    }

function getBiddings(){
    global $mysqli;
    $query = "SELECT * FROM tender ORDER BY closing_d DESC LIMIT 35";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    }


function getSlides($id){
    global $mysqli;
    $query = "SELECT * FROM slidder WHERE id='$id'";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}

function getSlideAnim($id){
    global $mysqli;
    $query = "SELECT * FROM slidder_animation WHERE slidder_id='$id'";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
}


function modules(){
	global $mysqli;
	$ccsql="SELECT mod_modulecode FROM module";
		$ccsql_run = mysqli_query($mysqli, $ccsql);
		
		while($row=mysqli_fetch_array($ccsql_run)){       
   
      	echo '
        <option value="'.$row["mod_modulecode"].'"> '.$row["mod_modulecode"].'</option>
      	';
        
	}		//echo '<option value="'.$row["mod_modulecode"].'">'.$row["mod_modulecode"].'</option>';
	  

	}





function getMembers(){
    global $mysqli;
    $query = "SELECT count(*) as totMembers FROM members";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);
   if($row['totMembers'] > 0){
    echo   $row['totMembers'];
  }else{
    echo "0";
  }
    }

 function endedInvestment(){
    global $mysqli;
    $query = "SELECT count(*) as endedInvestment FROM plans WHERE exp_date < DATE(NOW()) and email !=''";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['endedInvestment'] > 0){
    echo   $row['endedInvestment'];
  }else{
    echo "0";
  }
    }  


  function activeInvestment(){
    global $mysqli;
    $query = "SELECT count(*) as activeInvestment FROM plans WHERE exp_date > DATE(NOW()) and transId !=''";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['activeInvestment'] > 0){
    echo   $row['activeInvestment'];
  }else{
    echo "0";
  }
    }     


  function currentCapital(){
    global $mysqli;
    $query = "SELECT SUM(amount_invested) as currentCapital FROM plans where transId !=''";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['currentCapital'] > 0){
    echo   '₦ '.number_format($row['currentCapital']);
  }else{
    echo "₦0";
  }
    }  

function currentActiveCapital(){
    global $mysqli;
    $query = "SELECT SUM(amount_invested) as currentCapital FROM plans WHERE exp_date > DATE(NOW()) and transId !=''";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['currentCapital'] > 0){
    echo   '₦ '.number_format($row['currentCapital']);
  }else{
    echo "₦0";
  }
    }  


  function totalReturns(){
    global $mysqli;
    $query = "SELECT SUM(Amt_to_get) as totalReturns FROM plans where status='active' and transId !=''";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['totalReturns'] > 0){
    echo   '₦ '.number_format($row['totalReturns']);
  }else{
    echo "₦0";
  }
    }    
    

function getBankName($bcode){
    global $mysqli;
    $query = "SELECT name from banks where code = '$bcode'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['name'] != ""){
    echo   ucfirst($row['name']);
  }else{
    echo "";
  }
    }        


function totalActiveReturns(){
    global $mysqli;
    $query = "SELECT SUM(totInterest) as totalReturns FROM plans WHERE exp_date > DATE(NOW()) and transId !=''";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['totalReturns'] > 0){
    echo   '₦ '.number_format($row['totalReturns']);
  }else{
    echo "₦0";
  }
    }        



function currentInvestedFarm(){
    global $mysqli;
    $query = "SELECT COUNT(DISTINCT plan_id) as currentInvestedFarm FROM plans WHERE exp_date > DATE(NOW()) and transId !='' and status='active'";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['currentInvestedFarm'] > 0){
    echo   $row['currentInvestedFarm'];
  }else{
    echo "0";
  }
    }   

    

function liveBiding(){
    global $mysqli;
    $query = "SELECT count(*) as totContrator FROM `tender` WHERE opening_d <= now()";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['totContrator'] > 0){
    echo   $row['totContrator'];
  }else{
    echo "0";
  }
    }       

function bidings(){
   global $mysqli;
    $query = "SELECT count(*) as totBidings FROM bidding";
    $result = mysqli_query($mysqli,$query);
    $row = mysqli_fetch_array($result);

    if($row['totBidings'] > 0){
    echo   $row['totBidings'];
  }else{
    echo "0";
  }
   
    }    


function owing()
{
    global $mysqli;
    $sql = "SELECT COUNT(*) FROM account where Amount_Owning!=0";
    if ($result=mysqli_query($mysqli, $sql)){
        $row= mysqli_fetch_array($result);
        $rowcount = $row[0];
        mysqli_free_result($result);
    }
    return $rowcount;
}




//Get user assigned menus privileges
// if the rights are not set then add them in the current session
if (!isset($_SESSION["access"])) {

    try {

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname FROM module WHERE 1 GROUP BY `mod_modulegrouporder`, mod_modulegroupcode, mod_modulegroupname,`mod_moduleorder` ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC  ";


        $stmt = $db_con->prepare($sql);
        $stmt->execute();
        $commonModules = $stmt->fetchAll();

        $sql = "SELECT mod_modulegroupcode, mod_modulegroupname, mod_modulepagename,  mod_modulecode, mod_modulename FROM module  WHERE 1  ORDER BY `mod_modulegrouporder` ASC, `mod_moduleorder` ASC ";

        $stmt = $db_con->prepare($sql);
        $stmt->execute();
        $allModules = $stmt->fetchAll();

        $sql = "SELECT rr_modulecode, rr_create, rr_edit, rr_delete, rr_view FROM role_rights WHERE rr_rolecode = :rc ORDER BY `rr_modulecode` ASC  ";

        $stmt = $db_con->prepare($sql);
        $stmt->bindValue(":rc", $_SESSION["rolecode"]);
        
        
        $stmt->execute();
        $userRights = $stmt->fetchAll();

       $_SESSION["access"] = set_rights($allModules, $userRights, $commonModules);

    } catch (Exception $ex) {

        echo $ex->getMessage();
    }
}









	
}


?>