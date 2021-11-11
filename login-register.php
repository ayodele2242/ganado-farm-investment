<?php
error_reporting(0);
include("header.php");
include("link.php");

// Store cookies
if(isset($_POST["submit-login"]))   
{  
 if(!empty($_POST["email"]) && !empty($_POST["password"]))
 {
  
  
   if(!empty($_POST["remember"]))   
   {  
    setcookie ("member_login",$_POST["email"],time()+ (10 * 365 * 24 * 60 * 60));  
    setcookie ("member_password",$_POST["password"],time()+ (10 * 365 * 24 * 60 * 60));

   
    
   }  
   else  
   {  
    if(isset($_COOKIE["member_login"]))   
    {  
     setcookie ("member_login","");  
    }  
    if(isset($_COOKIE["member_password"]))   
    {  
     setcookie ("member_password","");  
    }  
   }  
     
}
}
?>
 
<link rel="stylesheet" href="assets/login/css/normalize.css">
<link rel="stylesheet" href="assets/login/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/login/css/login-page_demo.css">
<link rel="stylesheet" href="assets/login/css/login-page_style.css">
<link rel="stylesheet" href="assets/login/css/login-page_responsive.css">
<link rel="stylesheet" href="assets/css/bootstrap-datepicker.css">  
<style type="text/css">
  .backgrid th,
.backgrid td {
  display: table-cell;
  position: relative; 
  overflow: visible;
} 
</style>



 <div class="login-page_container"style="height:100vh;">

        <!--       Sign in Side      -->

        <div class="login-section page-side section-ope">
            <div class="section-page_intro">
                <img src="assets/login/img/green-icon.png" alt="signin-icon">
                <p class="section-page-intro_title col-green">Sign In</p>
            </div>

            <div class="login-form-area">
                <p class="form-title col-green">Sign In</p>
                <div class="section-form">
                    <form class="login-form" id="loginform" method="post">
                        <label class="login-page_label">
                            <input class="login-page_input col-green" value="<?php if(isset($_COOKIE["member_login"])) { echo $_COOKIE["member_login"]; } ?>" type="email" name="email" id="lemail" autocomplete="off">
                            <span class="login-page_placeholder col-green">Email</span>
                        </label>
                        <label class="login-page_label">
                            <input class="login-page_input col-green" value="<?php if(isset($_COOKIE["member_password"])) { echo $_COOKIE["member_password"]; } ?>" type="password" id="lpassword" name="password">
                            <span class="login-page_placeholder col-green">Password</span>
                        </label>
                        
                        <label class="login-page_label">
                            <input class="login-page_input col-green" type="checkbox" id=""  name="remember" <?php if(isset($_COOKIE["member_login"])) { ?> checked <?php } ?> >
                            <span class="col-green">Remember me</span>
                        </label>
                        
                        <div class="login-section_submit">
                            <div class="login-page_forget">
                            <a href="">Forget Your Password ?</a>
                        </div>
                            <div class="login-page-submit-btn">
                                <input type="submit"  name="submit-login" value="submit">
                            </div>
                        </div>
                        
                    </form>

                    <form class="forget-form" id="forgotForm">
                        <p class="forget-title">Forget Your Password</p>
                        <label class="login-page_label">
                            <input class="login-page_input" type="email" name="email" autocomplete="off">
                           <span class="login-page_placeholder col-green">Enter registered email</span>
                        </label>
                        <div class="login-section_submit">

                        	<div class="back">
                            <a href="#" class="login-page_back">Sign In</a>
                           </div>

                            <div class="login-page-submit-btn"><input type="submit" class="mlogin" name="submit-login" value="submit" id="forgotMe"></div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <!--       Sign up Side      -->

        <div class="signup-section page-side section-clos">
            <div class="section-page_intro">
                <img src="assets/login/img/signup-icon.png" alt="signup-icon">
                <p class="section-page-intro_title">Sign Up</p>
            </div>

            <div class="signup-form-area">
                <p class="form-title">Sign Up</p>
                <div class="section-form">
                    <form class="signup-form" id="registerform">
                       <label class="login-page_label">
                            <input class="login-page_input col-while" type="text" name="name" autocomplete="off">
                            <span class="login-page_placeholder col-while">Name</span>
                        </label>
                        <label class="login-page_label">
                            <input class="login-page_input col-while" type="email" name="email" autocomplete="off">
                            <span class="login-page_placeholder col-while">Email</span>
                        </label>
                        <label class="login-page_label">
                        <input type="number" class="login-page_input col-while"  name="phone" id="phone_number" >
                        <span class="login-page_placeholder col-while">Phone Number</span>
                        </label>

                        <!--<label class="login-page_label"> -->
                        <!--    <input class="login-page_input datepicker col-while" type="text" name="dob" autocomplete="off" auto-complete="off">-->
                        <!--    <span class="login-page_placeholder col-while">DoB</span>-->
                        <!--</label>-->
                        <label class="login-page_label">
                            <input class="login-page_input col-while" type="password" name="password">
                            <span class="login-page_placeholder col-while">Password</span>
                        </label>
                        <label class="login-page_label">
                            <input class="login-page_input col-while" type="password" name="cpassword">
                            <span class="login-page_placeholder col-while">Confirm Password</span>
                        </label>

                       <label class="login-page_label hide">
                            <input type="text" class="login-page_input col-while" name="bank_account_name" id="bank_account_name">
                            <span class="login-page_placeholder col-while">Bank Account Name</span>
                       </label>
                        <label class="login-page_label hide">
                            <input type="text" class="login-page_input col-while" id="bank_account_number" name="bank_account_number" >
                             <span class="login-page_placeholder col-while">Bank Account Number</span>
                        </label>
						<label class="login-page_label hide col-while">
						
							<select id="bank_name" class="form-control" name="bank_name">
							<option value="">--Bank Name--</option>
							<option>First Bank</option>
							<option>UBA</option>
							<option>Fidelity Bank</option>
							<option>Ecobank</option>
							<option>Access</option>
							<option>Diamond Bank</option>
							<option>Guaranty Trust Bank</option>
							<option>Heritage Bank</option>
							<option>Citi Bank</option>
							<option>Keystone Bank</option>
							<option>Skye Bank</option>
							<option>MainStreet Bank</option>
							<option>Skye Bank</option>
							<option>Stanbic IBTC Bank</option>
							<option>Standard Chartered Bank</option>
							<option>Sterling Bank</option>
							<option>Sun Trust</option>
							<option>Union Bank</option>
							<option>Unity Bank</option>
							<option>Wema Bank</option>
							<option>Zenith Bank</option>
							<option>First City Monument Bank</option>
							<option>Enterprise Bank</option>
							</select>
							
							</label>                   



                        <div class="signup-section_submit">
                            <ul>
                                <!--<li><a href="#" target="_blank"><i class="fa fa-facebook fa-fw"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-twitter fa-fw"></i></a></li>
                                <li><a href="#" target="_blank"><i class="fa fa-google fa-fw"></i></a></li>-->
                            </ul>
                            <div class="login-page-submit-btn">
                                <input type="submit" name="submit-signup" value="submit">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>








 <?php include("footer.php"); ?>
 