<?php
include("header.php");
include("header_bottom.php");
include("left_nav.php");
?>


    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="col s12">
          <div class="container">
            <!--card stats start-->
<div id="card-stats">
   <div class="row">
      <div class="col">

        <div class="cardss">

          <h3>Set a new password</h3>

        <div>
          <?php
          if (count($_POST) > 0) {
    $result = mysqli_query($mysqli, "SELECT * from system_users WHERE email='$email'");
    $row = mysqli_fetch_array($result);
    if (encryptIt($_POST["oldPass"]) == $row["password"]) {
        mysqli_query($mysqli, "UPDATE emp set password='" . encryptIt($_POST["newPass"]) . "' WHERE email='" . $_SESSION["email"] . "'");
        $message = '<div class="alert alert-success">Password Changed</div>';
    } else
        $message = '<div class="alert alert-danger">Current Password is not correct</div>';
}

?>
          <div align="center">
             <div class="message"><?php if(isset($message)) { echo $message; } ?></div>

            <form action="" method="post">
              <div class=" md-outline">
                <label data-error="wrong" data-success="right" for="newPass">Current password</label>
                <input type="password" name="oldPass" id="oldPass" class="form-control" required="">
                
              </div>
              <div class=" md-outline">
                <label data-error="wrong" data-success="right" for="newPass">New password</label>
                <input type="password" id="newPass" name="newPass" class="form-control" required="">
                
              </div>

              <div class=" md-outline">
                 <label data-error="wrong" data-success="right" for="newPassConfirm">Confirm password</label>
                <input type="password" id="newPassConfirm" name="newPassConfirm" class="form-control" required="">
               
              </div>
<div align="right">
              <button type="submit" class="btn btn-primary mb-4" name="s">Change password</button>
</div>
            </form>
          </div>


        </div>
        
      </div>
   </div>
</div>
<!--card stats end-->

<?php include("right_menu.php"); ?>
         
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

  

    
 

<?php
include("footer.php");
?>