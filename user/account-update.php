<?php
include("header.php");
include("header_bottom.php");
include("left_nav.php");

$query = mysqli_query($mysqli,"select * from members where id='$id'");
$row = mysqli_fetch_array($query);
?>


    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="col s12">
          <div class="container">
            <!--card stats start-->
<div id="card-stats">
  <div align="center">
   <form id="updateform">
    
   <div class="row">
   <div class="col m12 alert-message"></div>


   <div class="col m4">
<h5 class="mb-4">Update Bank Info.</h5><br/>
<div class="alert text-info">To update your account information, enter account number and select your bank </div>
 <label class="login-page_label">
                            <input type="text" class="login-page_input recipient-name" name="bank_account_name" id="bank_account_name" value="<?php echo $row['account_name'];  ?>" placeholder="Bank Account Name" readonly>
                            
                       </label>
                        <label class="login-page_label">
                            <input type="text" class="login-page_input" id="bank_account_number" name="bank_account_number" value="<?php echo $row['account_number'];  ?>" placeholder="Bank Account Number">
                        </label>
                        <label class="login-page_label">
                            <input type="text" class="login-page_input" id="Transfer_Ref_Code" name="Transfer_Ref_Code" value="" placeholder="Ref Code" readonly="" hidden="hidden">
                        </label>
            <div class="login-page_label">
            
              <select id="get_bank_code" class="browser-default select mselect" name="bankname"  >
              <option value="">--Bank Name--</option>
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
              
              </div>                   

</div>





   <div class="col m12">

                        <div align="center">
                          <input type="hidden" id="desctxs" name="desctxs" value="Payout on investment">
                          <input type="hidden" class="form-control" name="_token" value="<?php echo genTranxRef($length);  ?>">
                              <input type="hidden" name="email" value="<?php echo $row['email'];  ?>">
                                <button class="btn btn-success btn-md mt-10" id="updateInfo" style="display: none;">Update</button>
                                <div class="resolve"></div>
                           
                        </div>
   </div>
 </div>

    </form>
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


<script type="text/javascript">







  $(document).ready(function() {

//Check for account number supply

 $('#get_bank_code').on('change', function(event){
           
            var account_number =$('#bank_account_number').val();
            var bank_code      = $('#get_bank_code').val();

            event.preventDefault();
            var url_api = 'https://api.paystack.co/bank/resolve';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    'Authorization': 'Bearer sk_live_226cf64eb7dbd6d20d29eb42c04f7153eea5697f'
                }
            });
            $.ajax({
            type: 'GET',
            url: url_api,
            async: false,
            cache: false,
            dataType: 'json',
            data:{
                    "account_number" :account_number,
                    "bank_code": bank_code
                },
            beforeSend: function(){
                $(".resolve").html('<div class=" alert alert-info">Please wait while resolving your account details</div>');
               },
                   
            success: function(result) {
               
                    if(result.status == true){
                      $('.resolve').html('<div class="alert alert-success"><strong>'+result.message+'</strong></div>');
                        $('.recipient-name').val(result['data']['account_name']);
                        //$('#bank_code').val(result['data']['account_number']);


            var account_number = $('#bank_account_number').val();
            var bank_code      = $('#get_bank_code').val();
            var desctxs = $('#desctxs').val();
            var name_recipient = $('#bank_account_name').val();
            event.preventDefault();

            var trf_url_api = 'https://api.paystack.co/transferrecipient';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    'Authorization': 'Bearer sk_live_226cf64eb7dbd6d20d29eb42c04f7153eea5697f'
                }
            });
             $.ajax({
                url: trf_url_api,
                type: 'POST',
                data:{
                    "account_number" :account_number,
                    "bank_code": bank_code,
                    "description":desctxs,
                    "name":name_recipient
                },
                beforeSend: function(){
                $(".resolve").html('<div class="alert alert-default">Processing account deails</div>');
               },
               complete:function(data){
                $(".resolve").hide();
                },
                dataType:"json",
                success: function(data){
                  $(".resolve").hide();
                //$('#modaldemo98').modal('hide');
                //$('#modaldemotxs').modal('show');
                
                $('.alrt-alrt').html('<span class="alert-inner--text"><strong>'+data['message']+'</strong></span>');
                $('#Transfer_Ref_Code').val(data['data']['recipient_code']);
                //$('#account_number_name').val(data['data']['name']+"---"+data['data']['details']['account_number']);


                //Save to database
                  $.ajax({
                   type: "POST",
                   url: '../inc/members/accountUpdate.php',
                   data: $('#updateform').serialize(),
                   beforeSend: function(){
                    $(".resolve").html('<div class="alert alert-default">Saving account deails</div>');
                   },
                   success: function(data)
                   {
                       if(data.trim() == 1){
                                
                               $(".resolve").html('<div class="alert alert-success">Account updated successfully.</div>').show();
                               setTimeout(function() {
                          $("#msgs").fadeOut(1500);
                      }, 10000);
                                        
                              }else{
                                 //$(".resolve").hide();
                                $(".resolve").html('<div class="alert alert-danger text-left">'+data+'</div>').show();
                      setTimeout(function() {
                          $("#msgs").fadeOut(1500);
                      }, 10000);
                     
                              }

                               setTimeout(function() {
                          $("#msg").fadeOut(1500);
                      }, 10000);

                   }
               });



                     
                }
            });


                    }else{
                      alert(result['message']);
                        $('.resolve').html('<div class="alert alert-danger"><strong>'+result.message+'</strong></div>');
                    }
            }
           });


    });



  $('#updateform').submit(function(e) {
    e.preventDefault();

    


      
    $.ajax({
       type: "POST",
       url: '../inc/members/acount-update.php',
       data: $(this).serialize(),
       success: function(data)
       {
           if(data.trim() == 1){

                   $("#msgs").html('<div class="alert alert-success">Successfully updated.</div>').show();
                   setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);
                            
                  }else{
                    $("#msgs").html('<div class="alert alert-danger text-left">'+data+'</div>').show();
          setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);
         
                  }

                   setTimeout(function() {
              $("#msg").fadeOut(1500);
          }, 10000);

       }
   });
 });
});
</script>