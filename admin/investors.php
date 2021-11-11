<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTORS"]["create"]) || 
authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTORS"]["edit"]) || 
authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTORS"]["view"]) || 
authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTORS"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include("left_nav.php");
?>

<style>
    .tbtns{
        display: flex;
    }
</style>


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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">people</i> Investors</h4>
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

     <table id="table" class="table_view">
       <thead>
       <th>Name</th>
       <th>Email</th>
       <th>Phone</th>
       <th>DoB</th>
       <th>Gender</th>
       <th>Account Name</th>
       <th>Account Number</th>
       <th>Bank</th>
       <th>Next of Kin's Name</th>
       <th>Next of Kin's Phone</th>
       <th>Next of Kin's Address</th>
        <?php if (authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTORS"]["edit"])) { ?><th>Account Status</th><?php } ?>
      
 
       </thead>
       <tbody class="refresh">
       <?php  
       $investors = getInvestors();
       foreach($investors as $rows){
        
        if($rows['status'] == '1'){
        $esta = "checked";
         }else{
        $esta = "";
        }
        $bcode = $rows['bank_code']
        ?> 
        <tr class="animated fadeIn">
        <td><?php echo ucwords($rows['name']); ?></td>
        <td><?php echo ucwords($rows['email']); ?></td>
         <td><?php echo $rows['phone']; ?></td>
        <td><?php echo $rows['dob']; ?></td>
        <td><?php echo $rows['gender']; ?></td>
        <td><?php echo $rows['account_name']; ?></td>
         <td><?php echo $rows['account_number']; ?></td>
          <td><?php echo getBankName($bcode); ?></td>
          <td><?php echo $rows['kin_name']; ?></td>
          <td><?php echo $rows['kin_phone']; ?></td>
          <td><?php echo $rows['kin_address']; ?></td>
       
        <td class="tbtns">
           <?php if (authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTORS"]["edit"])) { ?>
          <div class="switch">
            <label>
              <input type="checkbox" <?php echo $esta; ?> class="invDetails" id="<?php echo $rows['id']; ?>" value="<?php echo $rows['id']; ?>">
              <span class="lever"></span>
            </label>
          </div>
          <?php 
               
           } 
          if (authorize($_SESSION["access"]["INVESTORS"]["ALL INVESTORS"]["delete"])) { ?>
          <button id="<?php echo $rows['id']; ?>" data-name="<?php echo ucwords($rows['name']); ?>" class="btn btn-floating delUser waves-effect waves-light red z-depth-4 btn-small" type="button" title="Delete"><i class="material-icons left">delete</i></button>
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

  

 <div id="INVESTORS-modal" class="modal">
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
<script>
 //Delete User from users' list
 $(document).ready(function(){
    $(".delUser").click(function() {
     var pid = $(this).attr('id'); // get id of clicked row  
     var name = $(this).attr('data-name');

     
     if (confirm("Are you sure you want to delete for "+name+"? There is no undo.")) {
     $.post("../inc/user/deleteInvestor.php", {"id": pid, }, 
    function(data) {
        if(data == 1){
             M.toast({html: "Investor Account Delected"});
             location.reload();
            // $(".refresh").load(location.href + ".refresh");
            //alert(data);
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });
    }

    });
  });
</script>



<script type="text/javascript">
  
$(document).ready(function(){
   //User's account status update
      $('.invDetails').on('click', function() {
       
      var checkStatus = this.checked ? 1 : 0;
      var id = $(this).attr('id');
      
     
    $.post("../inc/members/investor_status_updates.php", {"id": id, "sta":checkStatus, }, 
    function(data) {
        if(data == 1){
           // $('#email_status').prop( "checked", true );
             M.toast({html: "User Account Activated", classes: 'alert-success'});
            //alert(data);
        }else if(data == 0){
            //$('#email_status').prop( "checked", false );
             M.toast({html: "User Account Deactivated", classes: 'alert-warning'});
        }else{
            M.toast({html: data, classes: 'alert-danger'});
            //alert(data);
        }
        
    });
    });

});
</script>