<?php
include("header.php");
include("header_bottom.php");
include("left_nav.php");

$query = mysqli_query($mysqli,"select * from members where id='$id'");
$row = mysqli_fetch_array($query);

if(empty($row['img'])){
  $img = $set['installUrl'].'assets/logo/avatar.png';
}else{
   $img = $set['installUrl'].'assets/images/'.$row['img'];
}
?>




    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="col s12">
          <div class="container">

            <!--card stats start-->

<div id="card" >
  <form id="updateform" style="background: #ffffff;">
   <div class="row">
   <div class="col m12" id="msg"></div>

   </div>
      <div class="col m7">
       <h5 class="mb-4">Personal Details</h5><br/>

       <div class="col s12 l12">
        <input type="file" name="image" id="input-file-now" class="dropify" data-default-file="<?php echo $img;  ?>" />
      </div>
      
                            <input class="login-page_input col-black" type="text" name="name" autocomplete="off" value="<?php echo $row['name'];  ?>" placeholder="name">
                           
                        
                        <label class="login-page_label">
                         
                        <input type="number" class="login-page_input"  name="phone" id="phone_number"  value="<?php echo $row['phone'];  ?>" placeholder="Phone Number">
                        
                        </label>

                        <label class="login-page_label">
                          
                            <input class="login-page_input datepicker" type="text" name="dob" autocomplete="off" value="<?php echo $row['dob'];  ?>" placeholder="Date of birth">
                           
                        </label>

                         <label class="login-page_label">
                           
                            <select id="gender" class="form-control" name="gender">
                              <option value="">Gender</option>
                              <option <?php if($row['gender'] == 'Male'){ echo "selected"; }  ?>>Male</option>
                              <option <?php if($row['gender'] == 'Female'){ echo "selected"; }  ?>>Female</option>

                            </select>
                           
                        </label>
                        
                        <h5 class="mb-4">Next of Kin's Details</h5><br/>
                        
                        <label class="login-page_label">
                             <input class="login-page_input col-black" type="text" name="kname" autocomplete="off" value="<?php echo $row['kin_name'];  ?>" placeholder="Next of Kin Name">
                        </label>
                        <label class="login-page_label">
                             <input class="login-page_input col-black" type="text" name="kphone" autocomplete="off" value="<?php echo $row['kin_phone'];  ?>" placeholder="Next of Kin Phone Number">
                        </label>
                        
                        <label class="login-page_label">
                            <textarea rows="6" class="login-page_input col-black" placeholder="Next of Kin Address" name="kaddr" ><?php echo $row['kin_address'];  ?></textarea>
                             
                        </label>

   </div>

 



   <div class="col m4">
  
    <h5 class="mb-4">Update Password</h5><br/>
                        <label class="login-page_label">
                         
                            <input class="login-page_input col-black" type="password" name="old_password" placeholder="Old Password" autocomplete="off">  
                        </label>
                        <label class="login-page_label">
                          
                            <input class="login-page_input col-black" type="password" name="new_password" autocomplete="off" placeholder="New Password">  
                        </label>
                        <label class="login-page_label col-black">
                          
                            <input class="login-page_input col-black" type="password" name="con_password" placeholder="Confirm Password" autocomplete="off">
                            
                        </label>
  
   </div>

   <div class="col m12">

                        <div align="center">
                          
                              <input type="hidden" name="email" value="<?php echo $row['email'];  ?>">
                                <button class="btn btn-success btn-md mt-10" id="updateInfo">Update</button>
                           
                        </div>
   </div>
    </form>
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


<script type="text/javascript">
  $(document).ready(function() {
  $('#updateform').submit(function(e) {
    e.preventDefault();
      
    $.ajax({
       type: "POST",
       url: '../inc/members/update.php',
       data: new FormData(this),
       contentType: false,
       cache: false,
       processData:false,
       success: function(data)
       {
           if(data.trim() == 1){

                   $("#msgs").html('<div class="alert alert-success">Successfully updated.</div>').show();
                   setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);
                    $("#msg").html('<div class="alert alert-success">Successfully updated.</div>');

                     setTimeout(function() {
              $("#msg").fadeOut(1500);
          }, 10000);
                   
                  }else{
                    $("#msgs").html('<div class="alert alert-danger text-left">'+data+'</div>').show();
          setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);

          $("#msg").html('<div class="alert alert-danger text-left">'+data+'</div>')
                  }

                   setTimeout(function() {
              $("#msg").fadeOut(1500);
          }, 10000);

       }
   });
 });
});
</script>