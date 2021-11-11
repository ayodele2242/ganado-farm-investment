<?php
include("header.php");
include("link.php");
?>


<?php
//include("slider.php");
$hcont = mysqli_query($mysqli,"select * from mp_pages where nav_id = 'home'");
$count = mysqli_num_rows($hcont);

?>

<section class="pt-1 pb-5 mb-2 pr-body">

<div class="row">
      
     <div class="col-lg-12 s12"><h4 class="text-success">Our Farm Plans</h4></div>

   <?php

//$plans = getPlans()
//DO NOT limit this query with LIMIT keyword, or...things will break!
$querys = "SELECT * FROM farm_packages order by id desc";
$getifs = mysqli_query ($mysqli, $querys);

if(mysqli_num_rows($getifs) < 1){
   echo '<div class="col-lg-12 s12 alert alert-danger" style="text-align:center; padding: 7px; font-weight:bolder;">No plans to invest on at the moment. Please check back later.</div>';
}else{

 //these variables are passed via URL
$limits = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 9; //list per page
$pages = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1; //starting page
$links2 = 10;

$paginators = new Paginator($mysqli, $querys ); //__constructor is called
$results2 = $paginators->getData( $limits, $pages );
     
for ($ps = 0; $ps < count($results2->data); $ps++):
//store in $get variable for easier reading
$get = $results2->data[$ps]; 

$interesttotal = ceil((($get['capital'] / 100 * $get['percent']) * $get['duration'])/50)*50;
$interestdue = round($get['capital'] / 100 * $get['percent']);
$totalAmt = $get['capital'] + $interesttotal;

 if(empty($get['img'])){
$myimg  = $set['installUrl'].'assets/img/farm.png';
}else{
$myimg = $set['installUrl'].'assets/images/'.$get['img'];
}
?>



    <div class="col-lg-4 pb-2  animated fadeIn">
    	<div class="col-grey z-depth-4 card-bg">
        <div class="col-lg-12 col-sm-12 "><img src="<?php echo $myimg; ?>" style="width: 100%; max-height: 200px;"/></div>
    	<div class="row">

            <div class="col-lg-12 col-sm-12 title col-black bolder"><?php echo $get['category'];  ?></div>
              <div class="col-lg-6 col-sm-12 s12 mb-0 col-black"><strong>Interest Rate: <?php echo $get['percent'];  ?>%</strong></div>
              <div class="col-lg-6 col-sm-12 mb-0 col-black"><strong>Duration: <?php echo $get['duration'];  ?> Months</strong></div>
              <div class="col-lg-12 col-sm-12 mt-2 col-black"><strong>Amount to Invest: <?php echo '₦'.number_format($get['capital']);  ?></strong></div>
            <div class="col-lg-12">
            <a type="button" class="waves-effect waves-light btn btn-default col-white invest">Invest</a>
          </div>

          </div>

     </div>     
          
    </div>
      
    







<?php
 endfor;
//} 
 echo '<div class="col-lg-12 animated fadeInUp">';
echo $paginators->createLinks( $links2, 'pagination pagination-sm pg-blue' );
echo '</div>';
}
?>



</div>

</section>

  
<section>







<?php
if($count < 1){
    echo '<div class="alert alert-danger">No post yet for this link</div>';
}else{
    $hget = mysqli_fetch_array($hcont);
    ?>
 <style><?php echo   $hget['css']; ?></style>
 <?php
     $s = html_entity_decode($hget['page_desc']); 
      
      echo eval('?>' . utf8_encode($s) . '<?php ');
    
}

?>
</section>









 <?php include("footer.php"); ?>

 

 <script type="text/javascript">
  $(document).ready(function() {
  $(".invest").click(function(e) {
      e.preventDefault();
       $("#msgs").html('<div class="alert alert-info">You need to login before you can invest.</div>').show();
             setTimeout(function() {
        $("#msgs").fadeOut(1500);
    }, 10000);
     
    });
 });
 </script>