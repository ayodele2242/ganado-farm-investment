<?php
include("header.php");
include("link.php");
?>



 <section class="pb-5 py-md-5" >
  
  <div class="container">

<?php

if (!empty($_GET['key']) && isset($_GET['key'])) {
  $id = safe_input($mysqli,$_GET['key']);

  $query = mysqli_query($mysqli,"select token from members where token='$id'");
  $count =mysqli_num_rows($query);
  $row = mysqli_fetch_array($query);

 
    if ($count > 0) {
 
        // activate user
        $aquery = mysqli_query($mysqli,"UPDATE members SET status = 1, token = '' WHERE token = '$id'");
      if($aquery){
        echo '<div class="alert alert-success">Your account is activated, please click <a href="login-register">here</a>  to login</div>';
      }else{
        echo '<div class="alert alert-danger">Account activation failed, please try again.</div>';
      }
 
    } else {
        echo '<div class="alert alert-danger">Invalid activation key!</div>';
    }
 
} else {
   echo '<div class="alert alert-danger">Invalid activation key!</div>';
}
 
?>





  </div>
</section>

 
<?php 
include("footer.php");
 ?>



