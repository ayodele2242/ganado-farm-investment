
<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["BIDDINGS"]["BIDDING LIST"]["create"]) || 
authorize($_SESSION["access"]["BIDDINGS"]["BIDDING LIST"]["edit"]) || 
authorize($_SESSION["access"]["BIDDINGS"]["BIDDING LIST"]["view"]) || 
authorize($_SESSION["access"]["BIDDINGS"]["BIDDING LIST"]["delete"]) ) {
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">gazel</i> BIDDING LIST</h4>
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

      <div class="col m12 s12">

       <table class="table_view table">
       <thead>
       <th>Bidding No</th> 
       <th>Name</th>
       <th>Category</th>
       <th>Cost</th>
       <th>Ending in</th>
       <th>Number of Bidders</th>
       <th>Number of views</th>
        <?php if (authorize($_SESSION["access"]["BIDDINGS"]["BIDDING LIST"]["edit"])) { ?><th>Bidding Status</th><?php } ?>
       
 
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

         $today = date("Y-m-d H:i"); 

        $startdate = $mainDate;   
        $offset = strtotime("+1 day");
        $enddate = date($startdate, $offset);    
        $today_date = new DateTime($today);
        $expiry_date = new DateTime($enddate);


        ?> 
        <tr class="animated fadeIn">
        <td><?php echo ucwords($rows['tender_no']); ?></td>  
        <td><?php echo ucwords($rows['line_no']); ?></td>
        <td><?php echo ucwords($rows['category']); ?></td>
        <td><?php echo number_format($rows['estimatedcost']); ?></td>
        <td> 
         <div class="countdown disabled">
        <span style="font-weight: bolder;" id="clock-<?php echo $rows['tender_no'] ?>"></span>
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

           <?php if (authorize($_SESSION["access"]["BIDDINGS"]["BIDDING LIST"]["edit"])) { 

                $today = date("Y-m-d H:i");  
                

                $startdate = $mainDate;
                $expire = strtotime($startdate. ' + 1 day');
                $today = strtotime("today midnight");

                if ($expiry_date < $today_date) { 
                  echo "<span class='text-danger' style='font-weight:bolder;font-size:16px;'>Expired</span>";
                  }else{
                  echo "<span class='text-success' style='font-weight:bolder;font-size:14px;'>Running</span>";
                  }

               
               } 
               ?>
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

