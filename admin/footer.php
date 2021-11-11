
     <!-- Logout div starts here -->
<div class="modal" id="signOut" >
        <div class="modal-content">
            <div class="modal-body">
                <p class="lead">Hello <strong><?php echo ucwords($name).' </strong>'. $signOutQuip; ?></p>
            </div>
            <div class="modal-footer">
                <a href="logout" class="btn btn-danger btn-small btn-icon-alt"><?php echo $signOutBtn; ?> <i class="fa fa-sign-out"></i></a>
                <button type="button" class="btn btn-default btn-small btn-icon" data-dismiss="modal"><i class="fa fa-times-circle"></i> <?php echo $cancelBtn; ?></button>
            </div>
        </div>
</div><!-- Logout div ends here -->
    

    <!-- END: Footer-->
    <script src="<?php echo $set['installUrl'];  ?>assets/default/main/js/vendors.min.js" type="text/javascript"></script>
     <script src="<?php echo $set['installUrl'];  ?>assets/default/main/js/jquery.repeater.min.js"></script>
    <script src="<?php echo $set['installUrl'];  ?>assets/default/main/js/plugins.min.js" type="text/javascript"></script>
    
     
    <script src="<?php echo $set['installUrl'];  ?>assets/default/main/js/customizer.js" type="text/javascript"></script>
     
    <script src="../assets/default/main/js/dropify.min.js"></script>
     <script src="../assets/default/main/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="../assets/default/main/js/dataTables.select.min.js" type="text/javascript"></script>
    <script src="../assets/default/main/js/mstepper.min.js" type="text/javascript"></script>
    <!--<script src="../assets/default/main/js/chart.min.js" type="text/javascript"></script>
    <script src="../assets/default/main/js/chartist.min.js" type="text/javascript"></script>
    <script src="../assets/default/main/js/chartist-plugin-tooltip.js" type="text/javascript"></script>
    <script src="../assets/default/main/js/chartist-plugin-fill-donut.min.js" type="text/javascript"></script>-->
    <script src="../assets/default/main/js/form-wizard.js" type="text/javascript"></script>
    <script src="../assets/default/main/js/form-file-uploads.js"></script>
    <script src="../assets/default/main/js/fileinput.min.js"></script>
    
     
    <!--<script src="../assets/default/main/js/jquery.localizationTool.js" type="text/javascript" charset="utf-8"></script>-->
    <script src="../assets/default/main/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="../assets/js/custom.js"></script>  
    <script type="text/javascript" src="../assets/js/slidderScript.js"></script>
    <script type="text/javascript" src="../assets/js/menu.js"></script>
    <script type="text/javascript" src="../assets/js/addpage.js"></script>
    
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    
    


<script>
 $(document).ready(function(){
(function ($) {
    $(function () {

        //initialize all modals           
        $('.modal').modal();

        //now you can open modal from code
        $('#modal1').modal('open');

        //or by click on trigger
        $('.trigger-modal').modal();

    }); // end of document ready
})(jQuery); // end of jQuery name space
 });
  </script>

     
     
    <script type="text/javascript">


//Logout session
var idleMax = 25; // Logout after 25 minutes of IDLE
  var idleTime = 0;
  var idleInterval = setInterval("timerIncrement()", 60000);  // 1 minute interval    
  $( "body" ).mousemove(function( event ) {
      idleTime = 0; // reset to zero
});

// count minutes
function timerIncrement() {
    idleTime = idleTime + 1;
    if (idleTime > idleMax) { 
        window.location="logout.php";
    }
}       
//Logout session ends

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


var table;

$(document).ready(function() {
  table = $("#table").DataTable({
    "scrollY": 330,
        "scrollX": true,
    "pageLength": 150
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


   
    
<script type="text/javascript">
$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#myTab a[href="' + activeTab + '"]').tab('show');

    }
});
</script>


  </body>
</html>