<?php
include("header.php");
include("header_bottom.php");

include("left_nav.php");



?>

    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-blue-grey-blue gradient-shadow"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">message</i> Messenger</h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
<div class="card-content">

<div class="mtabs">

  <div class="tab">
<input type="radio" id="tab-5" name="tab-group-2" checked>
<label for="tab-5"><span class="fa fa-envelope"></span> &nbsp; Email</label>
<div class="contents">
 <form id="messenger-form" class="form-vertical">

<div class="input-field col s12">
<select class="form-control smode mselect select browser-default" name="smode" id="smode" >
<option value="">Select Mail List</option>
<option value="All">All Investors</option>
<option value="A">Active Investment</option>
<option value="I">In-Active Investment</option>
</select>
</div>



<div class="input-field col s12">
<input type="text" name="emaillist" id="emaillist" class="form-control" value="" >
</div>

<div class="input-field col s12">
<input type="text" class="form-control" name="subject" id="subject"  placeholder="Subject" value="">
</div>




<div class="input-field col s12">
<textarea name="msg" id="editor"  rows="15" class="form-control no-resize msg" Placeholder="Start Typing" ></textarea>
</div>

<div class="input-field col s12">

<div align="center">
<button type="submit" class="btn btn-info btnEmail"  id="btn-submit">
<span class="fa fa-envelope"></span> &nbsp; Send Mail
</button> 
</div>
</div>

</form> 
    </div>
  </div>
  <div class="tab">
    <input type="radio" id="tab-6" name="tab-group-2">
    <label for="tab-6"><span class="fa fa-comment"></span> &nbsp; SMS</label>
    <div class="contents">
      <form id="sms-form" class="form-vertical">

<div class="input-field col s12">
<select class="form-control smode mselect select browser-default" name="smode" id="sms" >
<option value="">Select Phone List</option>
<option value="All">All Investors</option>
<option value="A">Active Investment</option>
<option value="I">In-Active Investment</option>
<option value="m">Enter phone number manually</option>
</select>
</div>



<div class="input-field col s12">
 <input type="text" class="form-control" value=""  id="phonelist" name="phonelist"  placeholder="Phone Number"/>
</div>

<div class="input-field col s12">
<input type="text" class="form-control" id="subject_sms" name="subject_sms" value="" placeholder="SMS sender" >
</div>




<div class="input-field col s12">
  <span class="control-label" id="charLeft" class="charsRemaining"></span> Characters left
<textarea class="form-control col s12 countit" rows="6"  id="body_sms" name="body_sms"   placeholder="Message" style="height: 200px;"></textarea>

</div>

<div class="input-field col s12">

<div align="center">
<button type="submit" class="btn bg-light-blue btnSMS"  id="btn-submit">
<span class="fa fa-comment-o"></span> &nbsp; Send SMS
</button> 
</div>
</div>

</form>
    </div>
  </div>
</div>


</div>
</div>

                        
</div><!--container-->
</div>
</div>
</div>



<?php include("right_menu.php"); ?>
         
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

  



<?php
include("footer.php");
?>
<script type='text/javascript'>
$(document).ready(function() {
    $('.countit').keyup(function() {
        var len = this.value.length;
        if (len >= 160) {
            this.value = this.value.substring(0, 160);
        }
        $('#charLeft').text(160 - len);
    });
});
  
$(document).ready(function(){ 
    
$('#smode').change(function(){
var confirm_no = $(this).val();
$.ajax({
   type:'POST',
  data:"confirm_no="+confirm_no,
   url:'get_email.php',
   success:function(data){
    if(data.trim() == 'No email for this selection.'){
       $('.btnEmail').prop('disabled', true);
       $('#emaillist').val(data);

    }else{

       $('#emaillist').val(data);
       $('.btnEmail').prop('disabled', false);

       }
   } 

});
});
});
</script>
<script>
$(document).ready(function(){  
    $('#sms').change(function(){
    var sms = $(this).val();
    $.ajax({
       type:'POST',
      data:"sms="+sms,
       url:'get_email.php',
       success:function(data){
         if(data.trim() == 'No phone number available for this selection.'){
       $('.btnSMS').prop('disabled', true);
       $('#phonelist').val(data);

    }else{

       $('#phonelist').val(data);
       $('.btnSMS').prop('disabled', false);

       }
           
       } 
    
    });
    });
    });

$(document).ready(function (e) {
$("#messenger-form").on('submit',(function(e) {
        e.preventDefault();

        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }

         var editor = CKEDITOR.instances['editor'].getData();

        if($("#smode").val() == ""){
           M.toast({html: "Select mail list", classes: 'alert-danger'});
        }else if($("#subject").val() == ""){
           M.toast({html: "Enter email subject", classes: 'alert-danger'});
        }else if(editor == ""){
          M.toast({html: "Enter email message", classes: 'alert-danger'});
        } else{

        
        $.ajax({
            url: "../inc/messenge/sender.php",
            type: "POST",
            data:  new FormData($("#messenger-form")[0]),//new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            async: false,
            success: function(data)
            {



       if(data.trim()=="Mail Sent")
          {
            M.toast({html: "Successfully sent", classes: 'alert-success' });
                               
          
          }
          else{
                    M.toast({html: data, classes: 'alert-danger'});

          }
      

            },
            error: function() 
            {
            }           
       });//ajax
      }

    }));
});







$(document).ready(function (e) {
$("#sms-form").on('submit',(function(e) {
        e.preventDefault();

      

        if($("#sms").val() == ""){
           M.toast({html: "Select phone list", classes: 'alert-danger'});
        }else if($("#subject_sms").val() == ""){
           M.toast({html: "Enter sms sender", classes: 'alert-danger'});
        }else if($("#body_sms").val() == ""){
          M.toast({html: "Enter sms message", classes: 'alert-danger'});
        } else{

        
        $.ajax({
            url: "../inc/messenge/sms.php",
            type: "POST",
            data:  $("#sms-form").serialize(),
            
            success: function(data)
            {
               
             
      
              if(data.trim() == 1){
                M.toast({html: "Message sent", classes: "alert-success" });
                $('#sms-form')[0].reset();
              }else{
                 M.toast({html: data, classes: "alert-danger"});
              }

           
      

            },
            error: function() 
            {
            }           
       });//ajax
      }

    }));
});
</script>
