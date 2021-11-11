

$(document).ready(function () {
  //called when key is pressed in textbox
   $(".digit").keypress(function (e) {
     //if the letter is not digit then display error and don't type anything
     if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
        //display error message
        $(".derror").html("Only digits allow").show().fadeOut("slow");
               return false;
    }
   });
});


 function changeContent() {
        var cont = $.trim($("#ckeditor").val());
        cont = cont.replace(/[^a-zA-Z0-9-]+/g, '-');
        $("#mycont").val(cont.toLowerCase());
  }

function changeAlias() {
        var title = $.trim($("#page_title").val());
        title = title.replace(/[^a-zA-Z0-9-]+/g, '-');
        $("#page_alias").val(title.toLowerCase());
    }


function changeContent() {
        var cont = $.trim($("#ckeditor").val());
        cont = cont.replace(/[^a-zA-Z0-9-]+/g, '-');
        $("#mycont").val(cont.toLowerCase());
    }    

//Remove dispayed message box after 5secs
window.setTimeout(function() {
    $(".removeMessages").fadeTo(500, 0).slideUp(500, function(){
    $(this).remove(); 
    });
  }, 10000);
//Remove dispayed message box ends



/*$(document).ready(function(){
    $('#mstates').html('<option value="" >Select country to see states list</option>');
    
    $('#mcountry').on('change',function(){

        var countryID = $(this).val();
        //alert(countryID);

        if(countryID){
            $.ajax({
                type:'POST',
                url:'../inc/country.php',
                //dataType: 'Json',

                data:'country_id='+countryID,
                cache: false,
                success:function(data){

               // $('#mstates').empty();
               // $.each(data, function(key, value) {

                    $('#mstates').html(data);
                    console.log(data);

                //});

                }
            }); 
        }else{
           $('#mstates').html('<option value="" >You have not selected any country</option>');
        }
    }).trigger('change');
    
});*/

$(document).ready(function()
{
$("#mcountry").change(function()
{
var country_id=$(this).val();
var post_id = 'country_id='+ country_id;
 
$.ajax
({
type: "POST",
url: "../inc/country.php",
data: post_id,
cache: false,
success: function(cities)
{
$("#mstates").html(cities);
} 
});
 
}).trigger('change');
});

//Get tax state from the selected country
$(document).ready(function()
{
$("#taxcountry").change(function()
{
var country_id=$(this).val();
var post_id = 'country_id='+ country_id;
 
$.ajax
({
type: "POST",
url: "../inc/tax/states.php",
data: post_id,
cache: false,
success: function(cities)
{
$('#mstates').empty();
$("#taxstates").html(cities);
} 
});
 
}).trigger('change');
});


$(function() {
    $('.modal').modal();
    $('#modal3').modal('open');
    $('#modal3').modal('close');
  });


//store image update
function showPreview(objFileInput) {
            hideUploadOption();
            if (objFileInput.files[0]) {
                var fileReader = new FileReader();
                fileReader.onload = function (e) {
                    $("#targetLayer").html('<img src="'+e.target.result+'" width="200px" height="200px" class="upload-preview" />');
                    $("#targetLayer").css('opacity','0.7');
                    $(".icon-choose-image").css('opacity','0.5');
                }
                fileReader.readAsDataURL(objFileInput.files[0]);
            }
        }
        function showUploadOption(){
            $("#profile-upload-option").css('display','block');
        }

        function hideUploadOption(){
            $("#profile-upload-option").css('display','none');
        }

        function removeProfilePhoto(){
            hideUploadOption();
            $("#userImage").val('');
            $.ajax({
                url: "remove.php",
                type: "POST",
                data:  new FormData(this),
                beforeSend: function(){$("#body-overlay").show();},
                contentType: false,
                processData:false,
                success: function(data)
                {               
                $("#targetLayer").html('');
                setInterval(function() {$("#body-overlay").hide(); },500);
                },
                error: function() 
                {
                }           
            });
        }
        $(document).ready(function (e) {
            $("#uploadForm").on('submit',(function(e) {
                e.preventDefault();
                $.ajax({
                    url: "../inc/store-logo-update",
                    type: "POST",
                    data:  new FormData(this),
                    beforeSend: function(){
                    $("#error").fadeOut();
                    $(".btn-submit").html('<img src="../img/processing.gif" width="30" /> &nbsp; Updating...');
                    },
                    contentType: false,
                    processData:false,
                    success: function(data)
                    {
                        if(data==0){
                    $(".btn-submit").html('Try again');
                    $("#error").fadeIn(1000, function(){
                        $("#error").html('<div class="alert alert-danger red darken-3"> <i class="material-icons">help_outline</i> &nbsp; Invalid/Empty file uploaded. Please upload a valid file.</div>');
                        
                    });
                }else if(data==1){
                    $(".btn-submit").html('Try again');
                    $("#error").fadeIn(1000, function(){
                        $("#error").html('<div class="alert alert-danger red darken-3"> <i class="material-icons">help_outline</i>  File too large. Compress the file before uploading. File size should not be more than 1mb.</div>');
                        
                    });

                    } else{     
                    $("#targetLayer").css('opacity','1');
                    setInterval(function() {$("#body-overlay").hide(); },500);
                    $(".showit").html('<img src="'+e.target.result+'"  class="img" />');
                    

                    $(".myimg").load(location.href + " .myimg");
                    $(".btn-submit").html('<i class="material-icons">done</i> &nbsp; Updated');
                    $("#error").fadeIn(1000, function(){
                    $("#error").html('<div class="alert alert-success  green darken-4"> <i class="material-icons">done</i> &nbsp; Logo Updated Successfully.</div>');
                        
                    });
                    }
                    },
                    error: function() 
                    {
                    }           
               });
            }));
        });


//Update store setting table
$(document).ready(function() {
    $("#updateStoreForm").click(function() {
        // using serialize function of jQuery to get all values of form
        var serializedData = $("#editSetting").serialize();
 
       $.ajax({

            type : 'POST',
            url  : '../inc/update_store_details.php',
            data : serializedData,
            success :  function(data)
            {
                if(data=="done")
                {
                    $("#result").fadeIn(1000, function(){
                    $("#result").html('<div class="alert-success green darken-4"> <i class="material-icons">done</i> Update was Successful!!</div>'); 
                });
                

                 // reload the datatables
                //$("#userTable").DataTable().ajax.reload();
                // this function is built in function of datatables;
                
                }
                else{

                    $("#result").fadeIn(1000, function(){
                        $("#result").html('<div class="alert-danger red darken-3"><i class="material-icons">help_outline</i>  '+data+' !</div>');

                        

                    });

                }
            }
        });
        return false;

 
    });
});





//Email Status update on check button
$(document).ready(function(){

$('#email_status').on('click', function() {
    var checkStatus = this.checked ? 1 : 0;
     //alert(checkStatus);
    $.post("../inc/status_updates.php", {"email": checkStatus}, 
    function(data) {
        if(data == 1){
           // $('#email_status').prop( "checked", true );
             M.toast({html: "Email Notifications Activated"});
            //alert(data);
        }else if(data == 0){
            //$('#email_status').prop( "checked", false );
             M.toast({html: "Email Notifications Deactivated"});
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });
});


//Activity Status
$('#activity_status').on('click', function() {
    var checkStatus = this.checked ? 1 : 0;
     //alert(checkStatus);
    $.post("../inc/status_updates.php", {"activity": checkStatus}, 
    function(data) {
        if(data == 1){
           // $('#email_status').prop( "checked", true );
             M.toast({html: "Activity Status Activated"});
            //alert(data);
        }else if(data == 0){
            //$('#email_status').prop( "checked", false );
             M.toast({html: "Activity Status Deactivated"});
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });
});

//Notification
$('#notification').on('click', function() {
    var checkStatus = this.checked ? 1 : 0;
     //alert(checkStatus);
    $.post("../inc/status_updates.php", {"notify": checkStatus}, 
    function(data) {
        if(data == 1){
           // $('#email_status').prop( "checked", true );
             M.toast({html: "Notifications Activated"});
            //alert(data);
        }else if(data == 0){
            //$('#email_status').prop( "checked", false );
             M.toast({html: "Notifications Deactivated"});
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });
});

});




$(document).ready(function() {
    $("#submitUser").click(function() {
     var error = '';

    $('.name').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Enter user name </p>";
    return false;
   }
   count = count + 1;
  }); 

  $('.username').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Enter username for this user </p>";
    return false;
   }
   count = count + 1;
  });  

  $('.password').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Enter password for this user </p>";
    return false;
   }
   count = count + 1;
  }); 

  $('.role').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select the category of user you are creating </p>";
    return false;
   }
   count = count + 1;
  });   

   $('.status').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select account status for this user </p>";
    return false;
   }
   count = count + 1;
  });   

    $('.module').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select module to add to user/'s privileges </p>";
    return false;
   }
   count = count + 1;
  });

  $('.create').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on create </p>";
    return false;
   }
   count = count + 1;
  });  

  $('.delete').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on delete</p>";
    return false;
   }
   count = count + 1;
  });  
  
  $('.view').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on view </p>";
    return false;
   }
   count = count + 1;
  });  

  $('.edit').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on edit</p>";
    return false;
   }
   count = count + 1;
  });  

  if(error == '')
  {
       $.ajax({
            type : 'POST',
            url  : '../inc/user/addUser.php',
            data : $("#addUserForm").serialize(),
            success :  function(data)
            {
                if(data=="i")
                {

                    $("#result").fadeIn(1000, function(){
                    $("#result").html('<div class="alert-success green darken-4"> <i class="material-icons">done</i> Insertion was Successful!!</div>'); 
                
                    $('#addUserForm').trigger("reset");
                });
                
                }
                else{

                    $("#result").fadeIn(1000, function(){
                        $("#result").html('<div class="alert-danger red darken-3"><i class="material-icons">help_outline</i>  '+data+' !</div>');

                        

                    });

                }
            }
        });
        return false;

} else
  {

    swal(
{
  title: "<i class='text-danger'>Error Occured</i>",
  html: error,
  type: "warning",
  //showCancelButton: true,
  confirmButtonClass: "btn-danger",
  //confirmButtonText: "Yes, delete it!",
  closeOnConfirm: false
}
);

  }
 
    });
});




$(document).ready(function() {
    var template = $('#template'),
        id = 0;
        //template.hide();
    $("#add-line").click(function() {
      
        if(!template.is(':visible'))
        {
            template.show();
            //$(".hideIt").show();

            return;
        }
        var row = template.clone().append('<td><button class="btn btn-small btn btn-floating '
      + ($(this).is(":last-child") ?
        'rowfy-addrow remove red">-' :
        'rowfy-deleterow remove waves-effect waves-light red">-') 
      +'</button></td>');


        template.find(".mselect").val();
        template.find("select").val();
        template.find(".text").val()=='';
        template.find(".autocomplete_txt").val()=='';
        row.attr('id', 'row_' + (++id));
        //row.attr('id', 'row_' + (++id));
        console.log(row.attr('id', 'row_' + (++id)));
        template.after(row);

        //$(this).removeClass('rowfy-addrow btn-success').addClass('rowfy-deleterow btn-danger').text('-');
    });
    
    $('.form-fields').on('click', '.remove', function(){
        var row = $(this).closest('tr');

        if(row.attr('id') == 'template')
        {
            row.hide();
            
        }
        else
        {
            row.remove();

        }
    });


    $('.divform-fields').on('click', '.remove', function(){
        var row = $(this).closest('div');

        if(row.attr('id') == 'template')
        {
            row.hide();
            
        }
        else
        {
            row.remove();

        }
    });
});



//Clone div
$(document).ready(function() {
    var templates = $('#templates'),
        id = 0;
        //template.hide();
    $("#iadd-line").click(function() {
      //alert("hello"+ templates);
        if(!templates.is(':visible'))
        {
            templates.show();
            //$(".hideIt").show();

            return;
        }
        var rows = templates.clone().append('<div class ="col m1 s12"><button class="btn btn-small btn btn-floating '
      + ($(this).is(":last-child") ?
        'rowfy-addrow remove red">-' :
        'rowfy-deleterow remove waves-effect waves-light red">-') 
      +'</button></div>');


        templates.find(".mselect").val();
        templates.find("select").val();
        templates.find(".text").val()=='';
        templates.find(".autocomplete_txt").val()=='';
        row.attr('id', 'row_' + (++id));
        //row.attr('id', 'row_' + (++id));
        console.log(rows.attr('id', 'row_' + (++id)));
        templates.after(rows);

        //$(this).removeClass('rowfy-addrow btn-success').addClass('rowfy-deleterow btn-danger').text('-');
    });
    
    $('.iform-fields').on('click', '.remove', function(){
        var rows = $(this).closest('div');

        if(rows.attr('id') == 'templates')
        {
            rows.hide();
            
        }
        else
        {
            rows.remove();

        }
    });
});


//taxTable tr cloning
$(document).ready(function() {
  $("#tblDoc").click(function() {
    addAnotherRow();
    //alert("mr");
  });
});
var counter = 0;

function addAnotherRow() {
  ++counter;
  var row = $("#tblDoc tr:nth-child(2)").clone();
  row.find('input').val('');
  row.find('select').val('0');
  row.find(":input").attr("id", function() {
    var currId = $(this).attr("id");
    return currId.replaceAt(currId.length - 1, counter);
  });
  $('#tableTax').append(row);
}
String.prototype.replaceAt = function(index, character) {
  return this.substr(0, index) + character;
}


$(document).ready(function(){ 

 $('.usprivileges').tooltip({
  content:function(result){
   $.post('../inc/user/get_user_menu_privileges.php', 
   {
    id:$(this).attr('id')
   }, 
   function(data){
    result(data);
   });
  }
 });
  
});  

//User's privileges display
 $(document).ready(function(){
        $('.uprivileges').tooltip({
        title: getUser,
        html: true
        });
         function getUser()
        {
            var fetch_data = '';
            var id = $(this).attr('id');
            console.log(id);
            $.ajax({
                url: '../inc/user/get_user_menu_privileges.php',
                method: "GET",
                async:false,
                data:{id:id},
                success:function(data)
                {
                    get_data = data;

                }
            });
            return get_data;
        }

});  









$(document).ready(function(){
     


document.getElementById("myCheck").addEventListener("click", function() {
    toggle('area');
});

function toggle(obj) {

    var el = document.getElementById(obj);

    el.style.display = (el.style.display != 'none' ? 'none' : '' );
}

});      



//Currency setting
$(document).ready(function() {
    $("#updateCurrency").click(function() {

      var cur = $("#currencyupdateForm").serialize();
      
       $.ajax({
            type : 'POST',
            url  : '../inc/settings/currency_update.php',
            data : cur,
            success :  function(data)
            {
                if(data == 1)
                {
                  $(".refresh").load(location.href + ".refresh");
                   M.toast({html: '<div class="alert-success green darken-4"> <i class="material-icons">done</i> Updated Successfully</div>'});
                }
                else{

                  M.toast({
                    html: '<div class="alert-danger red darken-3"><i class="material-icons">help_outline</i>  '+data+' !</div>'

                    });


                }
            }
        });
        return false;
    });
}); 



//Autocomplete
  $(document).ready(function() {
  $(document).on('input', 'input.autocomplete', function() {
    var inputText = $(this).val();
    //alert(inputText);
    $.ajax({
      type: 'GET',
      data:'country='+inputText,
      url: '../inc/tax/server.php',
      dataType: "json",
      success: function(response) {
      var countryArray = response;
        var countryList = {};
        
        for (var i = 0; i < countryArray.length; i++) {
          countryList[countryArray[i].name] = countryArray[i];

        }
        console.log(countryList);
        $('input.autocomplete').autocomplete({
         data: countryList
        });
      }
    });
  });
});
 
 /*$(document).ready(function(){
    $(document).on('input', 'input.autocomplete', function() {
        let inputText = $(this).val();

        $.get('../inc/tax/server.php?country=' + inputText)
            .done(function(suggestions) {
              console.log(suggestions);
                $('input.autocomplete').autocomplete({
                    data: suggestions
                });
            });
    });
}); */



//Tax settings
$(document).ready(function() {
    $("#TaxFormButton").click(function() {
        // using serialize function of jQuery to get all values of form
        var serializedData = $("#TaxForm").serialize();
 
       $.ajax({

            type : 'POST',
            url  : '../inc/tax/insert.php',
            data : serializedData,
            success :  function(data)
            {
                if(data=="done")
                {
                    $("#result").fadeIn(1000, function(){
                    $("#result").html('<div class="alert-success green darken-4"> <i class="material-icons">done</i> Update was Successful!!</div>'); 
                });
               
                $("#taxTable").DataTable().ajax.reload();
                   
                }
                else{

                    $("#result").fadeIn(1000, function(){
                        $("#result").html('<div class="alert-danger red darken-3"><i class="material-icons">help_outline</i>  '+data+' !</div>');

                    });

                }
            }
        });
        return false;

 
    });
});






var xmlhttp
function ConnectToNet(url)
{
    xmlhttp=null;
    try {
        netscape.security.PrivilegeManager.enablePrivilege("UniversalBrowserRead");
    } catch (e) {

    //For IE it comes here.
    //alert("Permission UniversalBrowserRead denied.");
   }
    // code for Mozilla, etc.
    if (window.XMLHttpRequest){
        xmlhttp=new XMLHttpRequest()
    }
    // code for IE
    else if (window.ActiveXObject){
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP")
    }
    if (xmlhttp!=null){
        xmlhttp.onreadystatechange=state_Change
        xmlhttp.open("GET",url,true)
        xmlhttp.send(null)
    }
    else{
        alert("Your browser does not support XMLHTTP.")
    }
}

function state_Change()
{
    // if xmlhttp shows "loaded"
    if (xmlhttp.readyState==4){
        try{
              // if "OK"    
            if (xmlhttp.status==200){
            var objDiv = document.getElementById('msgs');
            objDiv.innerHTML = "<font color=blue>Internet is connected.</font>";
            alert("Internet is Connected.");
            return;
        }
          else{
            alert("Problem retrieving XML data")
        }
    } catch(err){
        var objDiv = document.getElementById('msgs');
        objDiv.innerHTML += "<font color=red>Internet is not connected.<br/></font>";
        setTimeout("ConnectToNet('http://www.google.com')",20000);
    }
  }
}

