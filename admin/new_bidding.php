
<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["BIDDINGS"]["ADD NEW BIDDING"]["create"]) || 
authorize($_SESSION["access"]["BIDDINGS"]["ADD NEW BIDDING"]["edit"]) || 
authorize($_SESSION["access"]["BIDDINGS"]["ADD NEW BIDDING"]["view"]) || 
authorize($_SESSION["access"]["BIDDINGS"]["ADD NEW BIDDING"]["delete"]) ) {
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">gazel</i> BIDDINGS</h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-content gradient-shadow">
            
    <div class="row" id="refreshme">
      
<div class="col m5">
  <div id="result"></div>
<form autocomplete="off" id="biddingform" class="">
                <div class="form-group mb-2">
                    <label>Bidding No.</label>
                <input type="text" name="bid"  required="required" class="form-control">
                </div>

                 <div class="form-group mb-2">
                    <label>Bidding Name</label>
                <input type="text" name="name"  required="required" class="form-control">
                </div>

                <div class="form-group stas mb-2" >
                  <label>Category</label>  
                <select name="category" class="browser-default  mselect">
                        <option value="0">Select Category</option>
                        <?php 
                        echo cat_list();//  functions.php 
                        ?>
                        </select>
                </div>

                <div class="form-group mb-2">
                <label>Estimated Cost</label>
                <input type="number" name="cost"  class="form-control">
                </div>

                <div class="form-group mb-2">
                 

                <label class="col l12">Expiring Date</label>
              
                <input type="text" class="form-control datepicker col m8" name="expiretime" id="expiretime"  required placeholder="Date">
                <input type="text" class="form-control col m4 timepicker" id="date-time" name="time" placeholder="Time">
               
              
                </div>

                <div class="form-group mb-2">
                <label>Status</label>
                <select name="status" class="browser-default  mselect" required="required">
                         <option value="">Select Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        </select>
                </div>
                <div class="form-group mb-5">
                <div align="center">
                  <input type="text" name="by">
                  <?php if (authorize($_SESSION["access"]["BIDDINGS"]["ADD NEW BIDDING"]["create"])) { ?>
                <button type="submit" class="btn btn-md btn-info biddingButton" id="biddingsubmit"><i class="fa fa-plus"></i> Create</button>
                <?php } ?>
                </div>
                </div>

                </form>
      </div>
      <div class="col m7 s12">

       <table class="table_view table">
       <thead>
       <th>Bidding No</th> 
       <th>Name</th>
       <th>Category</th>
       <th>Cost</th>
       <th>Expiring</th>
       <th>Number of Bidders</th>
       <th>Number of views</th>
        <?php if (authorize($_SESSION["access"]["BIDDINGS"]["ADD NEW BIDDING"]["edit"])) { ?><th>Bidding Status</th><?php } ?>
       <th></th>
 
       </thead>
       <tbody class="refresh">
       <?php  
       $biddigs = getBiddings();
       foreach($biddigs as $rows){
        
        if($rows['status'] == '1'){
        $esta = "checked";
         }else{
        $esta = "";
        }
        $date = $rows['closing_d'];
        $date1 = strtr($date, '/', '-');
        $mainDate = date('Y-m-d H:i', strtotime($date1));
        ?> 
        <tr class="animated fadeIn" id="auction<?php echo $rows['tender_no'] ?>">
        <td><?php echo ucwords($rows['tender_no']); ?></td>  
        <td><?php echo ucwords($rows['line_no']); ?></td>
        <td><?php echo ucwords($rows['category']); ?></td>
        <td><?php echo number_format($rows['estimatedcost']); ?></td>
        <td>

        <div class="countdown">
        <span id="clock-<?php echo $rows['tender_no'] ?>"></span>
      </div>
   <script type="text/javascript">
            $('#clock-<?php echo $rows['tender_no'] ?>').countdown('<?php echo $mainDate;  ?>')
        .on('update.countdown', function(event) {
          var format = '%H:%M:%S';
          if(event.offset.totalDays > 0) {
            format = '%-d day%!d ' + format;
          }
          if(event.offset.weeks > 0) {
            format = '%-w week%!w ' + format;
          }
          $(this).html(event.strftime(format));
        })
        .on('finish.countdown', function(event) {
          $(this).html('This offer has expired!')
            .parent().addClass('disabled');

        });
     </script>
        </td>
        <td><?php echo $rows['no_of_bidders']; ?></td>
        <td><?php echo $rows['views']; ?></td>
        <td>
           <?php if (authorize($_SESSION["access"]["BIDDINGS"]["ADD NEW BIDDING"]["edit"])) { ?>
          <div class="switch">
            <label>
              <input type="checkbox" <?php echo $esta; ?> class="bidDetails" id="<?php echo $rows['tender_no']; ?>" value="<?php echo $rows['tender_no']; ?>">
              <span class="lever"></span>
            </label>
          </div>
          <?php } ?>
        </td>
      
        <td class="tbtn"> 
          <!--<button id="<?php //echo  $rows['u_rolecode']; ?>" class="btn btn-floating uprivileges btn-small waves-effect waves-light orange z-depth-3"  ><i class="material-icons left">supervisor_account</i></button>-->
           <?php if (authorize($_SESSION["access"]["BIDDINGS"]["ADD NEW BIDDING"]["edit"])) { ?>
          <!--<a href="#user-modal" data-id="<?php //echo $rows['tender_no']; ?>" id="<?php //echo $rows['tender_no']; ?>" class="btn btn-floating waves-effect waves-light green z-depth-3 btn-small modal-trigger umodal" type="button" title="Edit"><i class="material-icons left">create</i></a>-->
        <?php } ?>
         <?php if (authorize($_SESSION["access"]["BIDDINGS"]["ADD NEW BIDDING"]["delete"])) { ?>
          <button id="<?php echo $rows['tender_no']; ?>" class="btn btn-floating delBid waves-effect waves-light red z-depth-4 btn-small" type="button" title="Delete"><i class="material-icons left">delete</i></button>
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

  
<!-- remove modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="menuModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Delete</h4>
        </div>
        <div class="modal-body">
          <p >Do you really want to delete it?</p>
          <div class="removeMessages"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn default modal-close" data-dismiss="modal">Close</button>
          <button type="button" class="btn red btn-small" id="removeBtn"><i class="material-icons left">delete</i> Delete</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- /remove modal -->

  <!-- remove modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="menuactivateModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      
        <div class="modal-body">
          <div align="center">
          <div class="switch">
            <label>
              De-activated
              <input type="checkbox" <?php echo $mactive; ?> class="menuDetails" id="activateBtn">
              <span class="lever"></span>
            </label>
            Activated
           </div>
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn default modal-close" data-dismiss="modal">Close</button>
         
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- /remove modal -->

<?php
include("footer.php");
?>

<script type="text/javascript">
  
$(document).ready(function() {
    $("#biddingsubmit").click(function() {
    

       $.ajax({
            type : 'POST',
            url  : '../inc/bidding/addBid.php',
            data : $("#biddingform").serialize(),
            success :  function(data)
            {
                if(data.trim()=="i")
                {

                    $("#result").fadeIn(1000, function(){
                    $("#result").html('<div class="alert-success green darken-4 text-white"> <i class="material-icons">done</i> Insertion was Successful!!</div>'); 
                    
                    $('#biddingform').trigger("reset");
                     location.reload();
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
 
    });
});




//Delete User from users' list
 $(document).ready(function(){
    $(".delBid").click(function() {
     var pid = $(this).attr('id'); // get id of clicked row  
     //confirm("Are you sure you want to delete "+pid+"? There is no undo."); 
     $.post("../inc/bidding/deleteUser.php", {"id": pid, }, 
    function(data) {
        if(data == 1){
             M.toast({html: "Item Delected"});
             $(".refresh").load(location.href + ".refresh");
             location.reload();
            //alert(data);
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });

    });
  });



$(document).ready(function(){
        //User's account status update
      $('.bidDetails').on('click', function() {
      var checkStatus = this.checked ? 1 : 0;
      var id = $(this).attr('id');
     
    $.post("../inc/bidding/user_status_updates.php", {"id": id, "sta":checkStatus, }, 
    function(data) {
        if(data == 1){
           // $('#email_status').prop( "checked", true );
             M.toast({html: "Bidding Activated"});
            //alert(data);
        }else if(data == 0){
            //$('#email_status').prop( "checked", false );
             M.toast({html: "Bidding Deactivated"});
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });
    });


 });



var Table;

$(document).ready(function() {
  Table = $(".table").DataTable({
    
    "scrollY": 330,
        "scrollX": true,
    "pageLength": 150,
    
  });
  

});
  
</script>