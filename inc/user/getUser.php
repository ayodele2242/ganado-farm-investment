
<?php
   
 require_once '../config.php';

	
 
 if (isset($_REQUEST['uid'])) {
   
 $id = intval($_REQUEST['uid']);
 $query = mysqli_query($mysqli,"SELECT * FROM system_users WHERE u_userid='$id'");
 $row = mysqli_fetch_array($query);
 $u = $row['u_rolecode'];

 


 ?>
   
 <div class="row">
 
<div class="col m12 s12 mb-3">
<form id="fine">
 <table class="table table_view">
 <tr>
 <td colspan="10"><div align="center"><h5> <?php echo $row['Name']; ?></h5></div></td>
 </tr>	
 
 <tr>
 <th>Email ID</th>
 <td><input type="email" name="email" value="<?php echo $row['email']; ?>" ></td>
 </tr>
 <tr>
 <th>Phone Number</th>
 <td><input type="text" name="phone" value="<?php echo $row['phone']; ?>" ></td>
 </tr>
 <tr>
<td colspan="10"><div align="center"><button type="button" id="updateIt" class="btn btn-default btn-sm">Update</button> </div></td>
 </tr>	
 </table>
<input type="hidden" name="id" value="<?php echo $row['u_userid']; ?>">
</form>

</div>
  <div class="col m4 s4 mb-3 refresh">
<table id="tableData" class="table table_view">
 	 <tr>
<td colspan="10"><div align="center"><h5>Assigned Menus</h5></div></td>
 </tr>
 <?php 
  $pri = mysqli_query($mysqli,"SELECT * FROM role_rights WHERE rr_rolecode='$u'");

 $count = mysqli_num_rows($pri);
 if($count < 1){
 	echo ' <tr><td colspan="10">
 	 <div align="center" class="card-content red-text">
                  <p>No menu Privilege assigned to this user</p>
                </div>
 	</td></tr>';
 }else{

  while($row2 = mysqli_fetch_array($pri)){ ?>
<tr>
 <td><?php echo $row2['rr_modulecode']; ?></td>
 <td> <button id="<?php echo $row2['id'];  ?>" class="btn btn-delete btn-floating waves-effect waves-light red z-depth-2 btn-small" type="button" title="Delete"><i class="material-icons left">delete</i></button></td>
</tr>

<?php } } ?>
 </table>
  </div>	
   <div class="col m8 s8 mb-3 form-fields refresh">
       <div align="center" class="card-content red-text">
                  <h5>Assign More Menu(s)</h5>
       </div>
<form id="mPrivilege">
<?php
$ccsql="SELECT mod_modulecode FROM module 
    WHERE mod_modulecode NOT IN(
    SELECT rr_modulecode  FROM role_rights WHERE rr_rolecode ='$u') ";
$ccsql_run = mysqli_query($mysqli, $ccsql);
$countp = mysqli_num_rows($ccsql_run);
if($countp == 0){
	echo '<div align="center" class="card-content red-text">
                  <p>All Privileges have been assigned to this user</p>
                </div>';
}else{

?>


<table role="table" class="table table_view rowfy" id="user_table"> 
                                         <tbody role="rowgroup">
                                        <tr id="template" role="row"> 
                                         
                                          <td role="cell">
                                            <select name="module[]" class="browser-default mselect select module">
                                             <option value="" class="validate" disabled selected>Select User Menu Module</option>  
                                          <?php 
                                          

                                           while($row=mysqli_fetch_array($ccsql_run)){       
   										      	echo '
										        <option value="'.$row["mod_modulecode"].'"> '.$row["mod_modulecode"].'</option>
										      	';
										        
											}	
                                           ?>
                                          </select>
                                        </td>
                                      <td role="cell">
                                      <select name="create[]" class="browser-default mselect select create">
                                      <option value="" class="validate" disabled selected>Create</option>
                                      <option>No</option>
                                      <option>Yes</option>
                                      </select>
                                      </td>
                                      <td role="cell">
                                      <select name="edit[]" class="browser-default mselect select edit">
                                      <option value="" class="validate" disabled selected>Edit</option>
                                     <option>No</option>
                                      <option>Yes</option>
                                      </select>
                                      </td>
                                      <td role="cell">
                                       <select name="delete[]" class="browser-default mselect select delete">
                                      <option value=""  disabled selected>Delete</option>
                                      <option>No</option>
                                      <option >Yes</option>
                                      </select>
                                      </td>
                                      <td role="cell">
                                       <select name="view[]" class="browser-default mselect select view">
                                      <option value=""  disabled selected>View</option>
                                      <option>No</option>
                                      <option >Yes</option>
                                      </select>

                                      </td>
                                     
                                     </tr>
                                   </tbody>
                                        </table>  
										<input type="hidden" name="ucode" value="<?php echo $u; ?>">
                                        <div class="row" style="margin-top: 15px; margin-bottom: 15px;">

										                     <div class="col m4 s4 mb-3 mb">
                                           <button id="add-line" class="btn btn-floating addme waves-effect waves-light green" type="button" ><i class="material-icons left">add</i></button>

                                         </div>
                                   
                                          <div class="col m4 s4 mb-3 mb">
                                            <button class="waves-effect waves dark btn btn-primary" id="submitUser"
                                                type="submit">
                                               Submit
                                               
                                            </button> 
                                    
                                           </div>
                                        </div>	
                                    <?php } ?>

</form>
 </div>

 </div>	



<?php } ?>


<script type="text/javascript">

//Get user's details and update data
$(document).ready(function(){
    $(".pmodal").click(function() {

     var pid = $(this).attr('id'); // get id of clicked row
     $('#content').show(); // leave this div blank
     $('#modal-loader').show();      // load ajax loader on button click

     $.ajax({
          url: '../incs/user/getUser.php',
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

});


//Update store setting table
$(document).ready(function() {
    $("#updateIt").click(function() {
        // using serialize function of jQuery to get all values of form
        var serializedData = $("#fine").serialize();
        //var loader='<img src="../assets/img/loading.gif" width="40" height="40"/>';
        alert(serializedData);
         
       $.ajax({

            type : 'POST',
            url  : '../admin/script/updateUser.php',
            data : serializedData,
            success :  function(data)
            {
                if(data == 1)
                {

                	 M.toast({html: '<i class="material-icons">done</i> Update was Successful'});
                	
                }else{

                	M.toast({html: '<div class="alert-danger red darken-3"><i class="material-icons">help_outline</i>  '+data+' !</div>'});
                    

                }
            }
        });
        return false;

 
    });
});


//Delete User from users' list
 $(document).ready(function(){
    $(".btn-delete").click(function() {
     var pid = $(this).attr('id'); // get id of clicked row  
     //confirm("Are you sure you want to delete "+pid+"? There is no undo."); 
     $.post("../admin/script/deleteMenu.php", {"id": pid, }, 
    function(data) {
        if(data == 1){
        	 $(".refresh").load(location.href + ".refresh");
             M.toast({html: "Menu Privilege Delected"});
             $("#tableData").load();
             
            //alert(data);
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });

    });
  });



$(document).ready(function() {
    var template = $('#template'),
        id = 0;
    
    $("#add-line").click(function() {
        if(!template.is(':visible'))
        {
            template.show();
            return;
        }
        var row = template.clone().append('<td><button class="btn btn-small btn btn-floating '
      + ($(this).is(":last-child") ?
        'rowfy-addrow remove red">-' :
        'rowfy-deleterow remove waves-effect waves-light red">-') 
      +'</button></td>');
        //template.find(".mselect").val();
        row.attr('id', 'row_' + (++id));
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
});
 



$(document).ready(function() {
    $("#submitUser").click(function() {

    	var sender = $("#mPrivilege").serialize();
    	//console.log(sender);

    

     var error = '';

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
            url  : '../admin/script/updatePrivilege.php',
            data : sender,
            success :  function(data)
            {
                if(data=="i")
                {
                  
                	 M.toast({html: '<i class="material-icons">done</i> Insertion was Successful!!', classes: 'alert-success'});
                   setTimeout('window.location.href = "all_users"; ',1000);
                }
                else{

                	M.toast({
                		html: data, classes: 'alert-danger'

                		});


                }
            }
        });
        return false;

} else
  {

  	 M.toast({
  	 	html: error,
  		type: "warning",
  	 });

    
  }
 
    });
}); 
 </script>


