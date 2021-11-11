<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["PAGES"]["PAGES LIST"]["create"]) || 
authorize($_SESSION["access"]["PAGES"]["PAGES LIST"]["edit"]) || 
authorize($_SESSION["access"]["PAGES"]["PAGES LIST"]["view"]) || 
authorize($_SESSION["access"]["PAGES"]["PAGES LIST"]["delete"]) ) {
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">note</i> Pages List</h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-content gradient-shadow">
     

<div class="stas screen2">
<?php
//DO NOT limit this query with LIMIT keyword, or...things will break!
$querys = "SELECT * FROM mp_pages order by page_id desc";

$getifs = mysqli_query ($mysqli, $querys);

if(mysqli_num_rows($getifs) < 1){
    echo '<div class="col s12 alert red" style="text-align:center; padding: 7px; font-weight:bolder;">You are yet to create a page.</div>';
}else{

//these variables are passed via URL
$limits = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 15; //list per page
$pages = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1; //starting page
$links2 = 10;

$paginators = new Paginator($mysqli, $querys ); //__constructor is called



    $results2 = $paginators->getData( $limits, $pages );
     
for ($ps = 0; $ps < count($results2->data); $ps++):
//store in $get variable for easier reading
        $get = $results2->data[$ps]; 
       
   /*     if($get['status']=='draft' || $get['status']=='')
   {
  $sta = '
  <select id=codes1_'.$get['page_id'].' onchange="getcodes1(this,'.$get['page_id'].')" class="inactives oks browser-default select mselect">
    <option value="draft"  selected >Drafted</option>
    <option value="publish">Publish</option>
    <option value="pending">Pend Review</option>
  </select>
  ';
  }elseif($get['status']=='publish')
   {
  $sta  = '
  <select id=codes1_'.$get['page_id'].' onchange="getcodes1(this,'.$get['page_id'].')" class="sta-active oks browser-default select mselect">
    <option value="publish"  selected >Published</option>
    <option value="draft">Draft It</option>
    <option value="pending" >Pend Review</option>
  </select>
  
  ';
   }
  elseif($get['status']=='pending')
   {
  $sta  = '
  <select id=codes1_'.$get['page_id'].' onchange="getcodes1(this,'.$get['page_id'].')" class="suspend oks browser-default select mselect">
     <option value="pending"  selected >Pending</option>
    <option value="publish">Publish</option>
    <option value="draft" >Draft It</option>
  </select>
  ';

   }*/
        ?>
    <div class="row clearfix " style="background:#f1f1f1; padding:15px; margin-bottom:25px;">    
    
   <div class="col m6 s12 alert bg-purple"><strong><?php echo $get['page_title'];  ?>   </strong> (<?php echo get_timeago($get['ptime']); ?>) <!--- <a href="readme?id=<?php //echo $get['page_id']; ?>" class="white bg-navy" style="padding:6px;"> Read More...</a>--></div>
   <div class="col m2 s12  alert alert-default "><?php echo $sta; ?></div>
   <div class="col m4 s12 alert">
   <span class="pull-right">

   
     <a href="#" id="<?php echo $get['page_id']; ?>" class="text col-red delPage" style="font-size:14px; margin:10px; cursor:pointer;"
      > <i class="fa fa-trash"></i> Delete </a>     
  
     </span>
    
    <span class="pull-right">
    <!--<a type="button" data-toggle="modal" id="page_id" href="#cModal" class="text-info modal-trigger" style="font-size:14px; margin:10px;"  data-id="<?php // $get['page_id']; ?>"> <span class="fa fa-eye"></span> View</a>  -->    
      
    <a href="edit_builder?page_id=<?php echo $get['page_id']; ?>" title="Edit Content" class="text-warning" style="font-size:14px; margin:10px;" ><i class="fa fa-edit"></i> Edit</a></span>
    
   </div>
   
   
   <!--<div class="col s12 alert alert-default text height textbody" id="textbody" ?>

   <?php //echo html_entity_decode($get['page_desc']);  ?> 
    
   </div> --> 


   </div>
       
<?php
 endfor;

//} 
echo $paginators->createLinks( $links2, 'pagination pagination-sm' );
}
?>


</div>




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

  

 <div class="modal fade" id="cModal" tabindex="-1" role="dialog" aria-labelledby="cModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content lg-modal modal-lg">
      <div class="modal-body">
            <div class="fetched-data alert alert-default"></div>
      </div>
      <div class="modal-footer">
           
                <!--<button type="button" class="btn btn-default print" onClick="window.print();return false">Print</button>-->
            </div>
    </div>
  </div>
</div>    




  <!-- remove modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="cdModal">
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


<?php
include("footer.php");
?>