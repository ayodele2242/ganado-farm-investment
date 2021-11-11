
     <!-- Logout div starts here -->
<div class="modal fade" id="signOut" >
        <div class="modal-content">
            <div class="modal-body">
                <p class="lead">Hello <strong><?php echo ucwords($name).' </strong>'. $signOutQuip; ?></p>
            </div>
            <div class="modal-footer">
                <a href="logout" class="btn btn-danger btn-small btn-icon-alt"><?php echo $signOutBtn; ?> <i class="fa fa-sign-out"></i></a>
                <!--<button type="button" class="btn btn-default btn-small btn-icon" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times-circle"></i> Close</button>-->
            </div>
        </div>
</div><!-- Logout div ends here -->
    

    <!-- END: Footer-->
    <script src="../assets/default/main/js/vendors.min.js" type="text/javascript"></script>
     <script src="../assets/default/main/js/jquery.repeater.min.js"></script>
    <script src="../assets/default/main/js/plugins.min.js" type="text/javascript"></script>
    
     
    <script src="../assets/default/main/js/customizer.js" type="text/javascript"></script>
    <script src="../assets/default/main/js/dropify.min.js"></script>
     <script src="../assets/default/main/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../assets/default/main/js/dataTables.select.min.js" type="text/javascript"></script>
    <script src="../assets/default/main/js/mstepper.min.js" type="text/javascript"></script>
    <script src="../assets/default/main/js/form-wizard.js" type="text/javascript"></script>
    <script src="../assets/default/main/js/form-file-uploads.js"></script>
    <script src="../assets/default/main/js/fileinput.min.js"></script>
     <script src="https://js.paystack.co/v1/inline.js"></script>
    
     
    <!--<script src="../assets/default/main/js/jquery.localizationTool.js" type="text/javascript" charset="utf-8"></script>-->
    <script src="../assets/default/main/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="../assets/js/custom.js"></script>  
    <script type="text/javascript" src="../assets/js/slidderScript.js"></script>
    <script type="text/javascript" src="../assets/js/menu.js"></script>
    <script type="text/javascript" src="../assets/js/package.js"></script>
    <script type="text/javascript" src="../assets/js/addpage.js"></script>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    
    




     
     
    <script type="text/javascript">
    
    String.prototype.trim = function() {
    try {
        return this.replace(/^\s+|\s+$/g, "");
    } catch(e) {
        return this;
    }
}

      $(document).ready(function() {

        function format(n, sep, decimals) {
        sep = sep || "."; // Default to period as decimal separator
        decimals = decimals || 2; // Default to 2 decimals

        return n.toLocaleString().split(sep)[0]
            + sep
            + n.toFixed(decimals).split(sep)[1];
       }

   $(".invest").click(function(e) {
      e.preventDefault();

      
       var id              = $("#id").val();
       var name            = $("#name").val();
       var cat             = $("#plan").val();
       var email           = $("#email").val();
       var duration        = $("#duration").val();
       var interest        = $("#rate").val();    
       var amttoInvest     = $("#mainAmt").val();
       var trackamount     = $("#trackamount").val();


   if(amttoInvest == ""){
    $("#msgs").html('<div class="alert alert-danger text-left">Amount to invest can not be empty.</div>').show();
      setTimeout(function() {
          $("#msgs").fadeOut(1500);
      }, 10000);

   }else if(parseInt($("#mainAmt").val()) < parseInt($("#trackamount").val())){
    $("#msgs").html('<div class="alert alert-danger text-left">Amount to invest can not be less than the minimum amount set.</div>').show();
      setTimeout(function() {
          $("#msgs").fadeOut(1500);
      }, 10000);
   }else{
    
  var globalData;
//var email;


var orderObj = {
    id: id,
    name: name,
    plan: cat,
    email: email,
    interest: interest,
    amount: amttoInvest,
    duration: duration

  };
    // Send the data to save using post
    var posting = $.post( '../inc/payment/pay_with_card.php', orderObj );

 posting.done(function( data ) {
     //console.log(JSON.stringify(data));
      var email = data.email;
      var handler = PaystackPop.setup({
      key: 'pk_live_3e3d199056a054e3b1b5863422fcb79b91b59916',


      name: data.name,
      email: data.email,
      amount: data.amount*100,
      



      metadata: {
        cartid: data.transId,
        orderid: data.transId,
        custom_fields: [
        {
            display_name: "Customer Name",
            variable_name: "customer_name",
            value: data.name
          },
           {
            display_name: "Plan Name",
            variable_name: "plan_name",
            value: data.plan
          },
          {
            display_name: "Paid on",
            variable_name: "paid_on",
            value: 'App'
          },
          {
            display_name: "Paid via",
            variable_name: "paid_via",
            value: 'Inline Popup'
          }
        ]
      },
      callback: function(response){
         var pay_res = response.reference;
         var amt = data.amount*100;

         
        jQuery.ajax({
            url: 'payment_success.php',
            method: 'post',
            async:false,
            data:{reference: pay_res, transId: data.id, email: data.email, date: data.date, ref: data.ref},
            success: function (data) {
              if(data.trim() == 1){

              
              $('.modal').modal('hide');
              $("#mymodal").modal('hide');
               window.location="active-plans";
               
               /* jQuery("#msgs").html('<div class="alert alert-success ">'+data+'</div>').show();
              setTimeout(function() {
                  jQuery("#msgs").fadeOut(1500);
              }, 10000);*/

              

              }else{
                jQuery("#msgs").html('<div class="alert alert-danger text-left">'+data+'</div>').show();
      setTimeout(function() {
          jQuery("#msgs").fadeOut(1500);
      }, 10000);
              }
            }
          });
          
      },
      onClose: function(){
        
         var amt = data.amount*100;

         //document.location.href="payment_failed.php?reference="+pay_res+"&transId="+jresponse.id+"&email="+jresponse.email;

       jQuery.ajax({
            url: 'payment_failed.php',
            method: 'post',
            async:false,
            data:{transId: data.id, email: data.email, date: data.date, ref: data.ref},
            success: function (data) {
              if(data == "done"){

                //jQuery("#mainDiv").hide();
               // jQuery("#successInfo").show();

              jQuery("#btn").click();

              }else{
                jQuery("#msgs").html('<div class="alert alert-danger text-left">'+data+'</div>').show();
      setTimeout(function() {
          jQuery("#msgs").fadeOut(1500);
      }, 10000);
              }
            }
          });




      }
    });
    handler.openIframe();
       
       
     // console.log(response[0].email);
    });
    posting.fail(function( data ) { /* and if it failed... */ });


   }//else ends


       


    });

 });



      //Get user's details and update data
$(document).ready(function(){
    $(".delPage").click(function() {

       var pid = $(this).attr('id'); // get id of clicked row
    
$.ajax({
        url: '../inc/page/remove.php',
        type: 'post',
        data: {member_id : pid},
        dataType: 'json',
        success:function(response) {
          if(response.success == true) {            
            
                         M.toast({html: response.messages});

                        // close the modal
            $("#cdModal").modal('close');    

            // refresh the table
            $(".stas").load(location.href + " .stas");

            

          } else {
             M.toast({html: response.messages});
          }
        }
      });

});



     

    });






      $(document).ready(function() {
      $("time.timeago").timeago();
      jQuery.timeago.settings.allowFuture = true;
      jQuery.timeago.settings.strings.inPast = "time has elapsed";
      jQuery.timeago.settings.allowPast = false;
    });

       $(document).ready(function(){
      $('input.timepicker').timepicker({
         timeFormat: 'HH:mm',
       
        maxHour: 24,
        maxMinutes: 60,
        dynamic: true,
        dropdown: true,
        scrollbar: true,
        
        interval: 1 // 15 minutes
      });
      });


        $(window).load(function() {
            $(".page-loader-wrapper").fadeOut("slow");
        });

    </script>
    <!--<script type="text/javascript" src="../assets/js/app.js"></script>-->

    <?php //include('../assets/js/app.php'); ?>
    <script type="text/javascript">
        $(document).ready(function(){  
        (function($){
            $(window).on("load",function(){
                $(".scrollable").mCustomScrollbar({
                 axis:"yx", // vertical and horizontal scrollbar
                 theme:"dark-3"
    });
            });
        })(jQuery);


     // $(element).perfectScrollbar('update');  
    });


    </script>
    <script type="text/javascript">
      var btnCust = '<button type="button" class="btn bg-green btn-small" title="Add picture tags" ' + 
        'onclick="alert(\'<?php echo $set['installUrl']; ?>assets/logo/<?php echo $set['logo']; ?>\')">' +
        '<i class="fa fa-tag"></i>' +
        '</button>'; 
    $("#avatar-2").fileinput({
      overwriteInitial: true,
      maxFileSize: '',
      showClose: false,
      showCaption: false,
      showBrowse: false,
      browseOnZoneClick: true,
      removeLabel: '',
      removeIcon: '<i class="fa fa-remove"></i>',
      removeTitle: 'Cancel or reset changes',
      elErrorContainer: '#kv-avatar-errors-2',
      msgErrorClass: 'alert alert-block alert-danger',
      defaultPreviewContent: '<img src="<?php echo $set['installUrl']; ?>assets/logo/<?php echo $set['logo']; ?>" alt="Your Avatar" style="width:200px;"><h6 class="text-muted">Click to select image</h6>',
      layoutTemplates: {main2: '{preview} ' },
      allowedFileExtensions: ["jpg", "png", "gif", "avi", "mp3", "mp4", "wav","3gp","AAC","flv"]
    });

  </script>
   
   <script type="text/javascript">
      //<![CDATA[

        // This call can be placed at any point after the
        // <textarea>, or inside a <head><script> in a
        // window.onload event handler.

        // Replace the <textarea id="editor"> with an CKEditor
        // instance, using default configurations.
       
        CKEDITOR.replace( 'editor',
                {
                    filebrowserBrowseUrl :'<?php echo $set['installUrl']; ?>assets/ckeditor/filemanager/browser/default/browser.html?Connector=<?php echo $set['installUrl']; ?>assets/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl : '<?php echo $set['installUrl']; ?>assets/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector=<?php echo $set['installUrl']; ?>assets/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl :'<?php echo $set['installUrl']; ?>assets/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=<?php echo $set['installUrl']; ?>assets/ckeditor/filemanager/connectors/php/connector.php',
          filebrowserUploadUrl  :'<?php echo $set['installUrl']; ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=File',
          filebrowserImageUploadUrl : '<?php echo $set['installUrl']; ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
          filebrowserFlashUploadUrl : '<?php echo $set['installUrl']; ?>assets/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
                });
             


      //]]>
      </script> 
   

     <script>
       var stepper = document.querySelector('.stepper');
       var stepperInstace = new MStepper(stepper, {
          // options
          firstActive: 0 // this is the default
       })

    </script>
   
     
     <script type="text/javascript">
    $(document).ready(function()
    {
           $('.timer').bootstrapMaterialDatePicker
      ({
        date: false,
        shortTime: false,
                format: 'HH:mm A',
                twelvehour: true
      });


      $.material.init()
    });
    </script>  

<script>
$('.time').bootstrapMaterialDatePicker({ format : 'HH:mm', minDate : new Date() }); 
</script>    
 
<script>
$('.date').bootstrapMaterialDatePicker({ weekStart : 0, time: false }); 
$('.date2').bootstrapMaterialDatePicker({ weekStart : 0, time: false }); 
$('.datepicker').datepicker({ 
    format : 'MM/DD/YYYY hh:mm', 
    twelvehour: true
});



$('#date-time').formatter({
        'pattern': '{{9999}}/{{99}}/{{99}} {{99}}:{{99}}',
      });
</script>


   



  </body>
</html>