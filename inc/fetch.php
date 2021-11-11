<?php
		
		include('functions.php');
		
		$msgBox = '';
		$activeAccount = '';
		$nowActive = '';


		
		// Get Settings Data
		$setSql = "SELECT * FROM store_setting";
		$setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
		$set = mysqli_fetch_array($setRes);
		
		

function getBiddings(){
	global $mysqli;
    $query = "SELECT * FROM tender ORDER BY inserted_by DESC";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    }

function getUserBiddings($cid){
	global $mysqli;
    $query = "SELECT * FROM tender  WHERE category = '$cid' ORDER BY inserted_by DESC";
    $result = mysqli_query($mysqli,$query);
    $resArr = array(); //create the result array
    while($row = mysqli_fetch_assoc($result)) { //loop the rows returned from db
      $resArr[] = $row; //add row to array
    }
    return $resArr;   
    }    

function getName($id){
	global $mysqli;
	$ccsql="SELECT name FROM navigation_bar WHERE id='$id'";
		$ccsql_run = mysqli_query($mysqli, $ccsql);
		
		$row=mysqli_fetch_array($ccsql_run);      
   
      	if($row['name'] != ""){
      		echo $row['name'];
      	}else{
      		echo "Unknow Category";
      	}
	  

	}


		
// Reset Account Password Form
if (isset($_POST['submit']) && $_POST['submit'] == 'resetPass') {
	// Set the email address
	$theEmail = (isset($_POST['theEmail'])) ? $mysqli->real_escape_string($_POST['theEmail']) : '';
	
	// Validation
	if ($_POST['theEmail'] == "") {
	$msgBox = alertBox($accEmailAddyReq, "<i class='fa fa-times-circle'></i>", "danger");
	} else {
	$query = "SELECT userEmail FROM users WHERE userEmail = ?";
	$stmt = $mysqli->prepare($query);
	$stmt->bind_param("s",$theEmail);
	$stmt->execute();
	$stmt->bind_result($userEmail);
	$stmt->store_result();
	$numrows = $stmt->num_rows();
	
	if ($numrows == 1){
	// Generate a RANDOM Hash for a password
	$randomPassword = uniqid(rand());
	
	// Take the first 8 digits and use them as the password we intend to email the user
	$emailPassword = substr($randomPassword, 0, 8);
	
	// Encrypt $emailPassword for the database
	$newpassword = encryptIt($emailPassword);
	
	//update password in db
	$updatesql = "UPDATE users SET password = ? WHERE userEmail = ?";
	$update = $mysqli->prepare($updatesql);
	$update->bind_param("ss", $newpassword, $theEmail);
	$update->execute();
	if($update == true){
	// Send out the email in HTML
	$installUrl 	= $set['installUrl'];
	$siteName 		= $set['siteName'];
	$siteEmail		= $set['siteEmail'];
	
	$title = $resetPassEmailTitle;
	$address = $_POST['newEmail'];
	$body = '
	<div style="padding:1px; font-size:14px; backgound:#fff; border:none;  width:600px; over-flow:hidden;">
	<div style="background:#066; font-weight:bold; text-align:center; margin-bottom:4px;">'.$subject.'</div>
	<p>'.$resetPassEmail1.'</p>
	<hr>
	<p>Your new password: '.$emailPassword.'</p>
	<hr>
	<p>'.$resetPassEmail2.'</p>
	<p>'.$resetPassEmail3.' '.$set['installUrl'].'admin/login</p>
	<p>'.$thankYouText.'<br>'.$siteName.'</p>
	</div>';
	
	echo Send_Email($body,$address,$title);
	$msgBox = alertBox($passwordResetMsg, "<i class='fa fa-check-square'></i>", "success");
	$isReset = 'true';
	$stmt->close();
	}
	} else {
	// No account found
	$msgBox = alertBox($accNotFoundMsg, "<i class='fa fa-warning'></i>", "warning");
	}
	}
	}
	
	// Create a New Account Form
			if (isset($_POST['submit']) && $_POST['submit'] == 'createAccount') {
			// User Validations
				if($_POST['name'] == '') {
					$msgBox = alertBox("Your name is required", "<i class='fa fa-times-circle'></i>", "danger");
				}
				elseif($_POST['username'] == '') {
					$msgBox = alertBox("A username is required", "<i class='fa fa-times-circle'></i>", "danger");
				}
				elseif($_POST['newEmail'] == '') {
					$msgBox = alertBox($validEmailAddyReq, "<i class='fa fa-times-circle'></i>", "danger");
				} 
				else if($_POST['password'] == '') {
					$msgBox = alertBox($newPassReq, "<i class='fa fa-times-circle'></i>", "danger");
				} else if($_POST['password'] != $_POST['passwordr']) {
					$msgBox = alertBox($passwordsNotMatchMsg, "<i class='fa fa-times-circle'></i>", "danger");
				} else if($_POST['institute_cat'] == '') {
					$msgBox = alertBox("Select school category from the drop down", "<i class='fa fa-times-circle'></i>", "danger");
				// Black Hole Trap to help reduce bot registrations
				} else if($_POST['institute_name'] == '') {
					$msgBox = alertBox("School name is required", "<i class='fa fa-times-circle'></i>", "danger");
				} 	
							
	else {
					// Set some variables
					$sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
					socket_connect($sock, "8.8.8.8", 53);
					socket_getsockname($sock, $name); // $name passed by reference
					$localAddr = $name;
					gethostname();
					$host = gethostbyname(gethostname());
					$hostaddr =  gethostbyaddr($_SERVER['REMOTE_ADDR']);
					$sysinfo =  php_uname();
					$lic = $mysqli->real_escape_string($_POST['pin']);
					$newEmail = $mysqli->real_escape_string($_POST['newEmail']);
					$username = $mysqli->real_escape_string($_POST['username']);
					$password = encryptIt($_POST['password']);
					$name = $mysqli->real_escape_string($_POST['name']);
					$instc = $mysqli->real_escape_string($_POST['institute_cat']);
					$instn = $mysqli->real_escape_string($_POST['institute_name']);
					$expire = "365";
					$sta = "active";
					$joinDate = date("Y-m-d H:i:s");
							//$hash = md5(rand(0,1000));
							//$isActive = '0';
					// Check for Duplicate username
					$check = mysqli_query($mysqli, "SELECT username FROM sch_details WHERE username = '".$username."'");
					if (mysqli_num_rows($check) > 0 ) {
						// If duplicates are found
						$msgBox = alertBox("Username already exist in the database.", "<i class='fa fa-times-circle'></i>", "danger");
					}	
					$checks = mysqli_query($mysqli, "SELECT userEmail FROM sch_details WHERE userEmail = '$newEmail'");
					if (mysqli_num_rows($checks) > 0 ) {
						// If duplicates are found
						$msgBox = alertBox($duplicateAccountMsg, "<i class='fa fa-times-circle'></i>", "danger");
				}
					$mystmt = mysqli_query($mysqli,"INSERT INTO sch_details(username,password,name,userEmail,institute_cat,													institute_name,license,status,sys_ip,host_ip,sys_name,sys_info,numberdays,date_registered) VALUES ('$username','$password','$name','$newEmail','$instc','$instn','$lic','$sta','$localAddr','$host','$hostaddr','$sysinfo','$expire','$joinDate')
							");
							
							
							if($mystmt){
							$del = mysqli_query($mysqli, "delete from license_keys where license = '$lic' ");
							}
							if($del){
							$msgBox = alertBox($newAccountCreatedMsg, "<i class='fa fa-check-square'></i>", "success");
							header("refresh:2;sign-in?".randNumber());
							session_destroy();
							
							
								// destroy session
								
	
							// Send out the email in HTML
							$installUrl = $set['installUrl'];
							$siteName = $set['siteName'];
							$siteEmail = $set['siteEmail'];
							$sitePhone = $set['phone'];
							$newPass = $mysqli->real_escape_string($_POST['password']);
							$logo = $set['schoolLogo'];
	
							$title = $newAccountEmailSubject;
							
							function randNumber(){
							$length = 1000;
							return $randomString = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);	 
							 }
	
							// -------------------------------
							// ---- START Edit Email Text ----
							// -------------------------------
							$bodym = '
				  <div style="background-color: #00BCD4; padding-left: 0; max-width: 500px; margin: 5% auto; overflow-x: hidden;">
				 <div style="font-size: 36px; padding:5px; display: block; width: 100%; text-align: left; color: #fff;">
					   <span style="float:left"><img src="'.$installUrl.'logo/'.$logo.'" width="80" height="80"></span>
					   <span style="float:left">'.$title.'</span> 
				  </div>
				  
				  <div style="font-size: 14px; text-decoration: none; background:#fff; padding:2px; color: #00BCD4;">
				  <p style="margin-bottom:2px; color: #00BCD4;">
				  Thank you for subscribing to our service('.$siteName.'). We do hope you enjoy the ride with us as we try to make our service convinient and user friendly experience for you.
				  </p>
				  
				   <p style="margin-bottom:2px; color: #00BCD4;">
				   Please do find below your details:
				   </p>
				   
				   <p>
				   <strong>Name:</strong> '.$name.'<br>
				   <strong>School Name:</strong> '.$instn.'<br>
				   <strong>Username:</strong> '.$username.'<br>
				   <strong>Email Address:</strong> '.$newEmail.'<br>
				   </p>
				   <p>
				   <strong>License Key:</strong> '.$pin.'<br>
				   </p>
				   <p>
				   To login click or copy this link: '.$installUrl.'sign-in?token='.randNumber().'
				   </p>
				   
				   <p>
				   You can contact us at: '.$siteEmail.' or by phone: '.$sitePhone.'
				   </p>
				   
				   
				  <p style="color=#00BCD4; font-size:14px; text-align:center; padding:4px; ">
				  Copyright &copy; 2014 -  '.date("Y").'; Infonet Management Consultants. All Rights Reserved.
				  </p>
				  </div>
				  
				  
				  </div>
				  ';
							
							
							// -------------------------------
							// ---- END Edit Email Text ----
							// -------------------------------
	
								//echo Send_Email($bodym, $newEmail, $title);
								
								//unset($_SESSION['pin']);
							//$stmt->close();
						
					}else{
					$msgBox = alertBox($mysqli->error, "<i class='fa fa-times-circle'></i>", "danger");	
					
					}
				}
				}
		

	
	// Edit Account
	if (isset($_POST['submit']) && $_POST['submit'] == 'editProfile') {
	if($_POST['passwordNew'] == "") {
	$msgBox = alertBox("Enter your new password", "<i class='fa fa-times-circle'></i>", "danger");
	}else  if($_POST['passwordNew'] != $_POST['passwordRepeat']) {
	$msgBox = alertBox("Both new and repeat passwords are not equal", "<i class='fa fa-warning'></i>", "warning");
	} else {
	if($_POST['currentPass'] != '') {
	$currPass = encryptIt($_POST['currentPass']);
	} else {
	$currPass = '';
	}
	
	if($_POST['currentPass'] == '') {
	$newPassword = $_POST['passwordOld'];
	
	
	
	$stmt = $mysqli->prepare("UPDATE
	users
	SET
	password = ?
	WHERE
	id = ?"
	);
	$stmt->bind_param('ss',
	
	$newPassword,
	$userId
	);
	$stmt->execute();
	$msgBox = alertBox("Updated Successfully", "<i class='fa fa-check-square'></i>", "success");
	$stmt->close();
	} else if ($_POST['currentPass'] != '' && encryptIt($_POST['currentPass']) == $_POST['passwordOld']) {
	$newPassword = encryptIt($_POST['passwordNew']);
	
	$stmt = $mysqli->prepare("UPDATE
	users
	SET
	
	password = 
	WHERE
	id = ?"
	);
	$stmt->bind_param('ss',
	$newPassword,
	$userId
	);
	$stmt->execute();
	$msgBox = alertBox("Updated Successfully", "<i class='fa fa-check-square'></i>", "success");
	$stmt->close();
	} else {
	$msgBox = alertBox("Error updating password. Check your input.", "<i class='fa fa-warning'></i>", "warning");
	}
	}
	}
	
	
	
	?>