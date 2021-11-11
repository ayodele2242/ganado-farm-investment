
<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["BIDDERS"]["ALL BIDDERS"]["create"]) || 
authorize($_SESSION["access"]["BIDDERS"]["ALL BIDDERS"]["edit"]) || 
authorize($_SESSION["access"]["BIDDERS"]["ALL BIDDERS"]["view"]) || 
authorize($_SESSION["access"]["BIDDERS"]["ALL BIDDERS"]["delete"]) ) {
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">people</i> ALL BIDDERS</h4>
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

       <table class="table_view">
       <thead>
       <th class="th-sm">ID
        </th>
        <th class="th-sm">Contractor ID
        </th>
        <th class="th-sm">Name
        </th>
        <th class="th-sm">Specialty
        </th>
        <th class="th-sm">Phone
        </th>
        <th class="th-sm">Email</th>
        <th class="th-sm">Address</th>
        <th class="th-sm">City</th>
        <th class="th-sm">State</th>
                  
 
       </thead>
       <tbody class="refresh">
       <?php  
       $biddigs = getBIDDERS();
        $i = 1;
       foreach($biddigs as $row){
       
        ?> 
        <tr class="animated fadeIn">
        <td><?php  echo $i; ?></td>
              <td><?php  echo $row['contractorid']; ?></td>
              <td><?php  echo $row['name']; ?></td>
              <td><?php  echo $row['speciality']; ?></td>
              <td><?php  echo $row['Phone']; ?></td>
              <td><?php  echo $row['email']; ?></td>
              <td><?php  echo $row['address']; ?></td>
              <td><?php  echo $row['city']; ?></td>
              <td><?php  echo $row['state']; ?></td>
        </tr>
        <?php
        $i++;
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

  

<?php
include("footer.php");
?>


<script type="text/javascript">

  var Table;

$(document).ready(function() {
  Table = $(".table_view").DataTable({
    
    "scrollY": 330,
        "scrollX": true,
    "pageLength": 150,
    
  });
  

});
</script>