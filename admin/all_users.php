<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["USER"]["ALL USERS"]["create"]) || 
authorize($_SESSION["access"]["USER"]["ALL USERS"]["edit"]) || 
authorize($_SESSION["access"]["USER"]["ALL USERS"]["view"]) || 
authorize($_SESSION["access"]["USER"]["ALL USERS"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">people</i> Users</h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-content gradient-shadow">
            
    <div class="row">
        <div class="col s12 refresh">

           <div class="switch" style="padding: 10px; margin-bottom: 10px;"> 
            Account Status Indicator: 
    <label>
       <i class="text-green">Activated</i>
      <input type="checkbox" checked disabled>
      <span class="lever"></span>
    </label>
     <label>
     De-activated
      <input disabled type="checkbox">
      <span class="lever"></span>
  
    </label>

  </div>

     <table class="table_view">
       <thead>
       <th>Name</th>
       <th>Email</th>
       <th>Username</th>
       <th>Phone</th>
        <?php if (authorize($_SESSION["access"]["USER"]["ALL USERS"]["edit"])) { ?><th>Account Status</th><?php } ?>
       <th></th>
 
       </thead>
       <tbody class="refresh">
       <?php  
       $users = getUsers();
       foreach($users as $rows){
        
        if($rows['status'] == '1'){
        $esta = "checked";
         }else{
        $esta = "";
        }
        ?> 
        <tr class="animated fadeIn">
        <td><?php echo ucwords($rows['Name']); ?></td>
        <td><?php echo ucwords($rows['email']); ?></td>
        <td><?php echo $rows['u_username']; ?></td>
        <td><?php echo $rows['phone']; ?></td>
        <td>
           <?php if (authorize($_SESSION["access"]["USER"]["ALL USERS"]["edit"])) { ?>
          <div class="switch">
            <label>
              <input type="checkbox" <?php echo $esta; ?> class="ustaDetails" id="<?php echo $rows['u_userid']; ?>" value="<?php echo $rows['u_userid']; ?>">
              <span class="lever"></span>
            </label>
          </div>
          <?php } ?>
        </td>
      
        <td class="tbtn"> 
          <!--<button id="<?php //echo  $rows['u_rolecode']; ?>" class="btn btn-floating uprivileges btn-small waves-effect waves-light orange z-depth-3"  ><i class="material-icons left">supervisor_account</i></button>-->
           <?php if (authorize($_SESSION["access"]["USER"]["ALL USERS"]["edit"])) { ?>
          <a href="#user-modal" data-id="<?php echo $rows['u_userid']; ?>" id="<?php echo $rows['u_userid']; ?>" class="btn btn-floating waves-effect waves-light green z-depth-3 btn-small modal-trigger usermodal" type="button" title="Edit"><i class="material-icons left">create</i></a>
        <?php } ?>
         <?php if (authorize($_SESSION["access"]["USER"]["ALL USERS"]["delete"])) { ?>
          <button id="<?php echo $rows['u_rolecode']; ?>" class="btn btn-floating delUser waves-effect waves-light red z-depth-4 btn-small" type="button" title="Delete"><i class="material-icons left">delete</i></button>
      <?php } ?>
        </td>
        </tr>
        <?php
        }
        ?>
       </tbody>


     </table>       
            
                   
        </div>
    </div>

                        
</div>
</div>
</div>
</div>
</div>
</div>


<?php include("right_menu.php"); ?>
         
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

  

 <div id="user-modal" class="modal">
    <div class="modal-content">
     <div id="modal-loader" style="display: none; text-align: center;">
           <!-- ajax loader -->
           <img src="../assets/img/loading.gif">
           </div>
                            
           <!-- mysql data will be load here -->                          
           <div id="contents"></div>
    </div>
    
  </div>
    


<?php
include("footer.php");
?>

<script type="text/javascript">
//Get user's details and update data
$(document).ready(function(){
    $(".usermodal").click(function() {
     
     var pid = $(this).attr('id'); // get id of clicked row
     $('#contents').html(''); // leave this div blank
     $('#user-modal').show();      // load ajax loader on button click
   
     $.ajax({
          url: '../inc/user/getUser.php',
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


 //Delete User from users' list
 $(document).ready(function(){
    $(".delUser").click(function() {
     var pid = $(this).attr('id'); // get id of clicked row  
     //confirm("Are you sure you want to delete "+pid+"? There is no undo."); 
     $.post("../inc/user/deleteUser.php", {"id": pid, }, 
    function(data) {
        if(data == 1){
             M.toast({html: "User Account Delected"});
             $(".refresh").load(location.href + ".refresh");
            //alert(data);
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });

    });
  });
</script>

