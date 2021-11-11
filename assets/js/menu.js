var menuTable;

$(document).ready(function() {
	menuTable = $("#menuTable").DataTable({
		"ajax": "../inc/menus/retrieve.php",
		"scrollY": 330,
        "scrollX": true,
		"pageLength": 150,
		"order": []
	});
	

});

 // Insert class
 $('#menuform').submit(function(event){
	event.preventDefault();
	//var data = $("#register-form").serialize();
	$.ajax({
	  url: "../inc/menus/insert.php",
	  method: "post",
	  data: $('form').serialize(),
	  success: function(data){
		//$('#message').html(strMessage);
		//$('#menuform')[0].reset();
		//menuTable.ajax.reload(null, false);
		if(data==1){
		$("#message").fadeIn(1000, function(){
     	$("#message").html('<div class="alert alert-danger"> <span class="fa fa-info-circle"></span> &nbsp; Dupliate entry. Category already exist in the database! </div>');
		});

		}else if(data=="added")
		{
			$("#message").fadeIn(1000, function(){
				$("#message").html('<div class="alert alert-success"> <span class="fa fa-check"></span> &nbsp; Added to database! </div>');
			  
				   });

				    $('#menuform')[0].reset();
					$("#menuTable").DataTable().ajax.reload();
					$(".stas").load(location.href + " .stas");
					M.toast({html: "Category created successfully"});
		}
		else{

			$("#message").fadeIn(1000, function(){

				$("#message").html('<div class="alert red col-white"><span class="fa fa-info-circle"></span> &nbsp; '+data+' !</div>');
				$("#btn-submit").html('<i class="fa fa-plus"></i> Add Category');
			});

		}

	  }
	})
  })

$(document).ready(function(){
        //Menu's status update
$('.menuDetails').on('click', function() {
      var checkStatus = this.checked ? 1 : 0;
      var id = $(this).attr('id');
     alert(id);
    $.post("../inc/menus/menu_status_updates.php", {"id": id, "sta":checkStatus }, 
    function(data) {
        if(data == 1){
           // $('#email_status').prop( "checked", true );
             M.toast({html: "Category Activated"});
            //alert(data);
        }else if(data == 0){
            //$('#email_status').prop( "checked", false );
             M.toast({html: "Category Deactivated"});
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });
    });

});


function removeMenu(id = null) {
  if(id) {
    // click on remove button
    
    $("#removeBtn").unbind('click').bind('click', function() {
      $.ajax({
        url: '../inc/menus/remove.php',
        type: 'post',
        data: {member_id : id},
        dataType: 'json',
        success:function(response) {
          if(response.success == true) {        
             M.toast({html: response.messages});

         // refresh the table
           $("#menuTable").DataTable().ajax.reload();
           $('.removeMessages').slideDown('slow');

            // close the modal
            $(".modal").modal('hide');
            $("#menuModal").modal('close');
            //$(".modal-close").click();

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


function activateMenu(id = null) {
  if(id) {
    //alert(id);
    // click on remove button
    
    $("#activateBtn").unbind('click').bind('click', function() {
        var checkStatus = this.checked ? 1 : 0;
      $.ajax({
        url: '../inc/menus/menu_status_updates.php',
        type: 'post',
        data: {id : id, sta : checkStatus},
        ///dataType: 'json',
        success:function(data) {
         if(data == 1){
           // $('#email_status').prop( "checked", true );
           $("#menuTable").DataTable().ajax.reload();
             M.toast({html: "Category Activated"});

            //alert(data);
        }else if(data == 0){
            //$('#email_status').prop( "checked", false );
            $("#menuTable").DataTable().ajax.reload();
             M.toast({html: "Category Deactivated"});
        }else{
            M.toast({html: data});
            //alert(data);
        }
        }
      });
    }); // click remove btn
  } else {
    alert('Error: Refresh the page again');
  }
}



   