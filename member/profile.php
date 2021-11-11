<?php
include("header.php");
include("top-header.php");
$limit = 5;
$log = activitiesLog($id, $limit);
$query = mysqli_query($mysqli,"select * from members where id='$id'");
$row = mysqli_fetch_array($query);

if(empty($row['img'])){
  $img = $set['installUrl'].'assets/logo/avatar.png';
}else{
   $img = $set['installUrl'].'assets/images/'.$row['img'];
}
?>


  <div class="nk-content nk-content-lg nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-inner">
                            <div class="nk-content-body">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <div class="nk-block-head-sub">
                                            <span>My Profile</span>
                                        </div>
                                        <h2 class="nk-block-title fw-normal">Account Info</h2>
                                        <div class="nk-block-des">
                                            <p>
                                                You have full control to manage your own account setting. 
                                               
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                    <div class="nk-block nk-block-lg">
                                      
                                        <div class="">
                                            <div class="card-inner">
                                                <ul class="nav nav-tabs mt-n3" id="myTab">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab" href="#tabItem5">
                                                            <ion-icon class="icon" name="person-circle"></ion-icon>
                                                            <span>Personal</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#tabItem6">
                                                            <ion-icon class="icon" name="lock-closed"></ion-icon>
                                                            <span>Security</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#tabItem7">
                                                            <ion-icon class="icon" name="notifications"></ion-icon>
                                                            <span>Notifications</span>
                                                        </a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#tabItem8">
                                                            <ion-icon class="icon" name="wallet"></ion-icon>
                                                            <span>Bank Account Details</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div class="tab-pane active" id="tabItem5">
                                                        <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">Personal Information</h5>
                                            <div class="nk-block-des">
                                                <p>Basic info, like your name and address, that you use on Nio Platform.</p>
                                            </div>
                                        </div>
                                        </div>
                                                      <div class="card card-bordered">
                                                        <div class="nk-data data-list">
                                        <div class="data-item">
                                        <div class="data-col">
                                            <input type="file" name="image" id="input-file-now" class="dropify" data-default-file="<?php echo $img;  ?>" />
                                          </div>
                                      </div>

                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Full Name</span>
                                                    <span class="data-value"><?php echo $row['name'];  ?></span>
                                                </div>
                                                <div class="data-col data-col-end">
                                                    <a href="#" data-id="<?php echo $row['id']; ?>" id="<?php echo $row['id'];  ?>" data-toggle="modal" data-target="#profile-edit" class="link text-danger usermodal"><ion-icon class="text-danger icon" name="create"></ion-icon> Update</a>
                                                </div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Email</span>
                                                    <span class="data-value"><?php echo $row['email'];  ?></span>
                                                </div>
                                                <div class="data-col data-col-end">
                                                    
                                                </div>
                                            </div>
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Phone Number</span>
                                                    <?php if($row['phone']==''){  ?>
                                                    <span class="data-value text-soft">Not add yet</span>
                                                <?php }else{ ?>
                                                    <span class="data-value"><?php echo $row['phone'];  ?></span>
                                                <?php } ?>
                                                </div>
                                                <div class="data-col data-col-end">
                                                    
                                                </div>
                                            </div>
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit">
                                                <div class="data-col">
                                                    <span class="data-label">Date of Birth</span>
                                                    <span class="data-value"><?php echo $row['dob'];  ?></span>
                                                </div>
                                                <div class="data-col data-col-end">
                                                    
                                                </div>
                                            </div>
                                            <div class="data-item" data-toggle="modal" data-target="#profile-edit" data-tab-target="#address">
                                                <div class="data-col">
                                                    <span class="data-label">Gender</span>
                                                    <span class="data-value">
                                                        <?php echo $row['gender'];  ?>
                                                    </span>
                                                </div>
                                             <div class="data-col data-col-end">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                                    </div>

                                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">Next of Kin's Information</h5>
                                            <div class="nk-block-des">
                                                <p></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-bordered">
                                        <div class="nk-data data-list">
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Name</span>
                                                    <?php if($row['kin_name'] !=''){ ?>
                                                    <span class="data-value">
                                                        <?php echo $row['kin_name'];  ?></span>
                                                    <?php }else{ ?>
                                                        <span class="data-value text-soft">Not add yet</span>
                                                    <?php } ?>
                                                </div>
                                                <div class="data-col data-col-end">
                                                    <a href="#" data-id="<?php echo $row['id']; ?>" id="<?php echo $row['id'];  ?>" data-toggle="modal" data-target="#nextofkin" class="link text-danger nokmodal"><ion-icon class="text-danger icon" name="create"></ion-icon> Update</a>
                                                </div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Phone</span>
                                                     <?php if($row['kin_phone'] !=''){ ?>
                                                    <span class="data-value">
                                                        <?php echo $row['kin_phone'];  ?></span>
                                                    <?php }else{ ?>
                                                        <span class="data-value text-soft">Not add yet</span>
                                                    <?php } ?>
                                                </div>
                                                <div class="data-col data-col-end">
                                                   
                                                </div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Address</span>
                                                     <?php if($row['kin_address'] !=''){ ?>
                                                    <span class="data-value">
                                                        <?php echo $row['kin_address'];  ?></span>
                                                    <?php }else{ ?>
                                                        <span class="data-value text-soft col_red">Not add yet</span>
                                                    <?php } ?>
                                                </div>
                                                <div class="data-col data-col-end">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                                    </div><!--tab 1 #end-->



                                                    <div class="tab-pane" id="tabItem6">
                                                       
                                                        <div class="nk-block">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">Security Settings</h5>
                                            <div class="nk-block-des">
                                                <p>These settings are helps you keep your account secure.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-bordered">
                                        <div class="card-inner-group">
                                            <div class="card-inner">
                                                <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                    <div class="nk-block-text">
                                                        <h6>Save my Activity Logs</h6>
                                                        <p>You can save all your  activity logs including unusual activity detected.</p>
                                                    </div>
                                                    <div class="nk-block-actions">
                                                        <ul class="align-center gx-3">
                                                            <li class="order-md-last">
                                                                <div class="custom-control custom-switch mr-n2">
                                                                <input type="checkbox" class="custom-control-input activity-log" id="<?php echo $row['id']; ?>" value="<?php echo $row['id']; ?>">
                                                                    <label class="custom-control-label" for="activity-log"></label>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-inner">
                                                <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                    <div class="nk-block-text">
                                                        <h6>Change Password</h6>
                                                        <p>Set a unique password to protect your account.</p>
                                                    </div>
                                                    <div class="nk-block-actions flex-shrink-sm-0">
                                                        <ul class="align-center flex-wrap flex-sm-nowrap gx-3 gy-2">
                                                            <li class="order-md-last">
                                                                <a href="#" data-id="<?php echo $row['id']; ?>" id="<?php echo $row['id'];  ?>" data-toggle="modal" data-target="#modalPass" class="btn btn-info passUpdate">Change Password</a>
                                                            </li>
                                                            <li>
                                                                <em class="text-soft text-date fs-12px">
                                                                    <!--Last changed: <span>Nov 19, 2020</span>-->
                                                                </em>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-inner">
                                                <div class="between-center flex-wrap flex-md-nowrap g-3">
                                                    <div class="nk-block-text">
                                                        <h6>
                                                            2FA Authentication <span class="badge badge-danger">Disabled</span>
                                                        </h6>
                                                        <p>Secure your account with 2FA security. When it is activated you will need to enter not only your password, but also a special code using app. You can receive this code by in mobile app. </p>
                                                    </div>
                                                    <div class="nk-block-actions">
                                                        <a href="#" class="btn btn-primary">Enable</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-head-content">
                                            <div class="nk-block-title-group">
                                                <h6 class="nk-block-title title">Recent Activity</h6>
                                                <a href="profile-activity" class="link">See full log</a>
                                            </div>
                                            <div class="nk-block-des">
                                                <p>This information about the last login activity on your account.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-bordered">
                                        <table class="table table-ulogs">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th class="tb-col-os">
                                                        <span class="overline-title">
                                                            Browser <span class="d-sm-none">/ IP</span>
                                                        </span>
                                                    </th>
                                                    <th class="tb-col-ip">
                                                        <span class="overline-title">IP</span>
                                                    </th>
                                                    <th class="tb-col-time">
                                                        <span class="overline-title">Time</span>
                                                    </th>
                                                    <th class="tb-col-action">
                                                        <span class="overline-title">&nbsp;</span>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if(!$log){
                                                    echo '<tr><td colspan="3">No Logs Available.</td></tr>';
                                                }else{
                                                foreach ($log as $logs) { ?>
                                                <tr>
                                                    <td class="tb-col-os"><?php echo $logs['browser']; ?></td>
                                                    <td class="tb-col-ip">
                                                        <span class="sub-text"><?php echo $logs['ip']; ?></span>
                                                    </td>
                                                    <td class="tb-col-time">
                                                        <span class="sub-text">
                                                            <?php echo $logs['log_time']; ?>
                                                        </span>
                                                    </td>
                                                    <td class="tb-col-action">
                                                       
                                                    </td>
                                                </tr>
                                                <?php }

                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                                    </div><!--Tab 2 #end-->


                                                    <div class="tab-pane" id="tabItem7">

                                                        <div class="nk-block">
                                    <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">Notification Settings</h5>
                                            <div class="nk-block-des">
                                                <p>You will get only notification what have enabled.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-head-content">
                                            <h6>Security Alerts</h6>
                                            <div class="nk-block-des">
                                                <p>You will get only those email notification what you want.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block-content">
                                        <div class="gy-3">
                                            <div class="g-item">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="unusual-activity">
                                                    <label class="custom-control-label" for="unusual-activity">Email me whenever encounter unusual activity</label>
                                                </div>
                                            </div>
                                            <div class="g-item">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="new-browser">
                                                    <label class="custom-control-label" for="new-browser">Email me if new browser is used to sign in</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block-head nk-block-head-sm">
                                        <div class="nk-block-head-content">
                                            <h6 class="nk-block-title-sm">News</h6>
                                            <div class="nk-block-des">
                                                <p>You will get only those email notification what you want.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="nk-block-content">
                                        <div class="gy-3">
                                            <div class="g-item">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="latest-sale">
                                                    <label class="custom-control-label" for="latest-sale">Notify me by email about sales and latest news</label>
                                                </div>
                                            </div>
                                            <div class="g-item">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="feature-update">
                                                    <label class="custom-control-label" for="feature-update">Email me about new features and updates</label>
                                                </div>
                                            </div>
                                            <div class="g-item">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="account-tips">
                                                    <label class="custom-control-label" for="account-tips">Email me about tips on using account</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                                       
                                                    </div>


                                                    <div class="tab-pane" id="tabItem8">
                                                        
                                                                   <div class="nk-block-head">
                                        <div class="nk-block-head-content">
                                            <h5 class="nk-block-title">Bank Account Information</h5>
                                            <div class="nk-block-des">
                                                <p>To start investing on Ganado platform, you need to update your account information</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card card-bordered">
                                        <div class="nk-data data-list">
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Account Name</span>
                                                    <?php if($row['account_name'] !=''){ ?>
                                                    <span class="data-value">
                                                        <?php echo $row['account_name'];  ?></span>
                                                    <?php }else{ ?>
                                                        <span class="data-value text-soft">Not add yet</span>
                                                    <?php } ?>
                                                </div>
                                                <div class="data-col data-col-end">
                                                    <a href="#" data-toggle="modal" data-target="#modalBank" class="link text-danger"><ion-icon class="text-danger icon" name="create"></ion-icon> Update</a>
                                                </div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Account No.</span>
                                                     <?php if($row['account_number'] !=''){ ?>
                                                    <span class="data-value">
                                                        <?php echo $row['account_number'];  ?></span>
                                                    <?php }else{ ?>
                                                        <span class="data-value text-soft">Not add yet</span>
                                                    <?php } ?>
                                                </div>
                                                <div class="data-col data-col-end">
                                                   
                                                </div>
                                            </div>
                                            <div class="data-item">
                                                <div class="data-col">
                                                    <span class="data-label">Bank Name</span>
                                                     <?php if($ac_code !=''){ ?>
                                                    <span class="data-value">
                                                         <select class="browser-default select mselect"  id="cf_1268591">
                                             
                                               <?php

                                            $slq = mysqli_query($mysqli,"select * from banks");
                                            while ($brow = mysqli_fetch_array($slq)) {
                                              if($brow['code'] == $ac_code){
                                                $acode = "selected";
                                              }else{
                                                $acode = "";
                                              }
                                              ?>
                                              <option value="<?php echo $brow['code'];  ?>" <?php echo $acode; ?>><?php echo $brow['name'];  ?></option>
                                              <?php
                                              # code...
                                            }
                                            ?>
          
              </select>

                                                        </span>
                                                    <?php }else{ ?>
                                                        <span class="data-value text-soft col_red">Not add yet</span>
                                                    <?php } ?>
                                                </div>
                                                <div class="data-col data-col-end">
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      
                                    </div>
                               
                               
                            </div>
                        </div>
                    </div>
                </div>




<div class="modal fade zoom" tabindex="-1" id="modalBank">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <ion-icon class="icon" name="wallet"></ion-icon> Bank Account Details</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                    <ion-icon name="close"></ion-icon>
                </a>
            </div>
            <div class="modal-body" id="pass-con">
                <div class="alert alert-info">To update your account information, enter <b>account number</b> and <b>select your bank</b> </div>
              <form id="updateform">
               <table class="table table-ulogs table-borderless">
              <tbody>
               <tr>
               <th>Bank Account Name</th>
               <td>
                    <input type="text" class="login-page_input recipient-name form-control" name="bank_account_name" id="bank_account_name" value="<?php echo $row['account_name'];  ?>" readonly>

               </td>
               </tr>
               <tr>
               <th>Bank Account Number</th>
               <td>
                 <input type="text" class="login-page_input form-control" id="bank_account_number" name="bank_account_number" value="<?php echo $row['account_number'];  ?>">
               </td>
               </tr>
               <tr>
               <th>Bank Name</th>
               <td>
                 <select id="get_bank_code" class="form-control" name="bankname"  >
              <option value=""></option>
               <?php

                            $slq = mysqli_query($mysqli,"select * from banks");
                            while ($brow = mysqli_fetch_array($slq)) {
                              if($brow['code'] == $ac_code){
                                $acode = "selected";
                              }else{
                                $acode = "";
                              }
                              ?>
                              <option value="<?php echo $brow['code'];  ?>" <?php echo $acode; ?>><?php echo $brow['name'];  ?></option>
                              <?php
                              # code...
                            }
                            ?>
          
              </select>
              </td>
               </tr>


               
              
               </tbody> 
               </table>
                <div class="col-lg-12">

                        <div align="center">
                          <input type="hidden" id="desctxs" name="desctxs" value="Payout on investment">
                          <input type="hidden" class="form-control" name="_token" value="<?php echo genTranxRef($length);  ?>">
                              <input type="hidden" name="email" value="<?php echo $row['email'];  ?>">
                                <button class="btn btn-success btn-md mt-10" id="updateInfo" style="display: none;">Update</button>
                                <div class="resolve"></div>
                           
                        </div>
   </div>
             
              </form>
               
            </div>
            
        </div>
    </div>
</div>

<?php
include("footer.php");
?>
<script type="text/javascript">
    $(document).ready(function () {
    $('#cf_1268591').attr("disabled", true); 
    });



//Get user's details and update data
$(document).ready(function(){
    $(".usermodal").click(function() {
     
     var pid = $(this).attr('id'); // get id of clicked row
     $('#contents').html(''); // leave this div blank
     $('#user-modal').show();      // load ajax loader on button click
   
     $.ajax({
          url: '../inc/members/getUser.php',
          type: 'POST',
          data: 'uid='+pid,
          dataType: 'html'
     })
     .done(function(data){
          console.log(pid); 
          $('#contents').html(data); // load here
          $('#modal-loader').hide(); // hide loader  
           $('#user-modal').show();
     })
     .fail(function(){
          $('contents').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });

    });


    //next of kin

        $(".nokmodal").click(function() {
     
     var pid = $(this).attr('id'); // get id of clicked row
     $('#nokcontents').html(''); // leave this div blank
     $('#user-modal').show();      // load ajax loader on button click
   
     $.ajax({
          url: '../inc/members/getNok.php',
          type: 'POST',
          data: 'uid='+pid,
          dataType: 'html'
     })
     .done(function(data){
          console.log(pid); 
          $('#nokcontents').html(data); // load here
          
     })
     .fail(function(){
          $('#nokcontents').html('<i class="glyphicon glyphicon-info-sign"></i> Something went wrong, Please try again...');
          $('#modal-loader').hide();
     });

    });

});

$(document).ready(function(){
        //User's account status update
      $('.ustaDetails').on('click', function() {
          
      var checkStatus = this.checked ? 1 : 0;
      var id = $(this).attr('id');
     
    $.post("../inc/user/user_status_updates.php", {"id": id, "sta":checkStatus, }, 
    function(data) {
        if(data == 1){
           // $('#email_status').prop( "checked", true );
             M.toast({html: "User Account Activated"});
            //alert(data);
        }else if(data == 0){
            //$('#email_status').prop( "checked", false );
             M.toast({html: "User Account Deactivated"});
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });
    });
});


$(".passUpdate").click(function(e) {
e.preventDefault();

var id              = $(this).attr('id'); // get id of clicked row 
//var email           = $(this).attr("data-email"); 

$("#pass_id").val(id);

});



$(document).ready(function() {

//Check for account number supply

$('#get_bank_code').on('change', function(event){

var account_number =$('#bank_account_number').val();
var bank_code      = $('#get_bank_code').val();


    $.ajax({
       type: "POST",
       url: '../inc/members/validateAccount.php',
       data: {ac_no: account_number, bank_code: bank_code},
       //dataType: "json",
       success: function(response)
       {

        if (response == 1) {
            /*$("#pname").val(response.data['name']);
            $("#pemail").val(response.data['email']);
             $("#refcode").val(response.data['ref']);*/
            //console.log(response.data['ref']);
            $('.payForm').show();
            $('.regForm').hide();

        } else {
            console.log(response);
             /*$("#msgs").html('<div class="alert alert-danger text-left">'+response.message+'</div>').show();
          setTimeout(function() {
              $("#msgs").fadeOut(500);
          }, 30000);*/
        }
            
       }


   });


});
});
</script>