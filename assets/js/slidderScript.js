var sliderTable;

$(document).ready(function() {
   $("#sliderTable").DataTable({
    "ajax": "../inc/slidder/retrieve.php",
    //"processing": true,
    //"serverSide": true,
		 "scrollY": 300,
    "scrollX": true,
		"pageLength": 150,
		"order": [],
     responsive: true,
    "sDom":"tpr" 

	});
	
});



$(document).ready(function (e) {
    
$("#sliderForm").on('submit',(function(e) {
        e.preventDefault();

       
        $.ajax({
            url: "../inc/slidder/upload.php",
            type: "POST",
            data:  new FormData($("#sliderForm")[0]),//new FormData(this),
            
            contentType: false,
            cache: false,
            processData: false,
            async: false,
            success: function(data)
            {
          if(data=="saved")
          {
            
                             M.toast({html: "Added to database"});
                        
                               $('input[type="text"]').val('');
                               $('input[type="file"]').val('');
                               $('select').val('');
                               $(".stas").load(location.href + " .stas");
                               $("#avatar-2").val('');
                                $(".fileinput-remove-button").click();
                                
                //empTable.ajax.reload(null, false);
          }
          else{
                    M.toast({html: data});
                    console.log(data);
        
                        
          }
      

            },
            error: function() 
            {
            }           
       });
    }));
});







//Slidder upload
$(document).ready(function (e) {
  
            $("#sliderForms").on('submit',(function(e) {

              var drEvent = $('#input-file-max-fs').dropify();
               drEvent = drEvent.data('dropify');
                e.preventDefault();
                var input = $("#input-file-max-fs");
                $.ajax({
                    url: "../inc/slidder/upload.php",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    processData:false,
                    success: function(data)
                    {
                    if(data=="saved"){
                     //M.toast({html: "Successfully saved"});
                      M.toast({
                        html: 'Successfully saved'
                      });
                     
                     $("#sliderTable").DataTable().ajax.reload();
                     $('#sliderForm').trigger("reset");
                     drEvent.resetPreview();
                     drEvent.clearElement();
                     
                      
                    } else{     
                   
                      M.toast({html: data});

                    }
                    },
                    error: function() 
                    {
                    }           
               });
            }));
        });

//Slidder upload
$(document).ready(function (e) {
  
            $("#sliderUpdateForm").on('submit',(function(e) {

              
                e.preventDefault();
                var input = $("#input-file-max-fs");
                $.ajax({
                    url: "../inc/slidder/slider_update.php",
                    type: "POST",
                    data:  new FormData(this),
                    contentType: false,
                    processData:false,
                    success: function(data)
                    {
                    if(data=="saved"){
                     M.toast({html: "Successfully updated"});
                     /* M.toast({
                        heading: 'Success',
                        text: 'Successfully updated',
                        showHideTransition: 'fade',
                        icon: 'success',
                        position: 'top-right',
                        loader: false

                        //html: data

                      });*/
                     
                    } else{     
                     M.toast({
                              heading: 'Error',
                              html: data,
                              showHideTransition: 'fade',
                              icon: 'error',
                              position: 'top-right',
                              loader: false
                          })
                     

                    }
                    },
                    error: function() 
                    {
                    }           
               });
            }));
        });




$(document).ready(function() {
      $('.slideUpdates').on('click', function() {
      var scheckStatus = this.checked ? 1 : 0;
      var id = $(this).attr('id');
      alert(id);
     
    $.post("../inc/slidder/slidder_status_updates.php", {"id": id, "sta":scheckStatus }, 
    function(data) {
        if(data == 1){
             M.toast({html: "Slider Activated"});
        }else if(data == 0){
             M.toast({html: "slider Deactivated"});
        }else{
            M.toast({html: data});
        }
        
    });

  });

}); 



function removeSlider(id = null) {
  if(id) {
    // click on remove button
    $("#removeBtn").unbind('click').bind('click', function() {
      $.ajax({
        url: '../inc/slidder/remove.php',
        type: 'post',
        data: {member_id : id},
        dataType: 'json',
        success:function(response) {
          if(response.success == true) {        
             M.toast({html: response.messages});

         // refresh the table
           $("#sliderTable").DataTable().ajax.reload();
           $('.removeMessages').slideDown('slow');

            // close the modal
            
            $('#sliderModal').modal('close');

          } else {
            $(".removeMessages").html('<div class="card-alert card red" ><div class="card-content white-text">'+
                '<button type="button" class="close white-text" data-dismiss="alert" aria-label="Close">'+
                  '<span aria-hidden="true">×</span></button>'+
                '<strong> <i class="material-icons left">insert_emoticon</i> </strong>'+response.messages+
              '</div></div>');
          }
        }
      });
    }); // click remove btn
  } else {
    alert('Error: Refresh the page again');
  }
}