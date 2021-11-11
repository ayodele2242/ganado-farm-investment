<?php
include("header.php");
include("header_bottom.php");
include("left_nav.php");
?>


    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="col s12">
          <div class="container">
            <!--card stats start-->
<div id="card-stats">
  <div id="msg"></div>
   <div class="row">
      
     <div class="col s12 iheader-text">All paid out farm plans</div>




     <?php

//$plans = getPlans()
//DO NOT limit this query with LIMIT keyword, or...things will break!
$querys = "SELECT * FROM plans where email='$email' and status = 'inactive' and payment_status='paid'";
$getifs = mysqli_query ($mysqli, $querys);

if(mysqli_num_rows($getifs) < 1){
   echo '<div class="col s12 alert alert-danger" style="text-align:center; padding: 7px; font-weight:bolder;">Nothing here.</div>';
}else{

 //these variables are passed via URL
$limits = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 40; //list per page
$pages = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 1; //starting page
$links2 = 10;

$paginators = new Paginator($mysqli, $querys ); //__constructor is called
$results2 = $paginators->getData( $limits, $pages );
     
for ($ps = 0; $ps < count($results2->data); $ps++):
//store in $get variable for easier reading
$get = $results2->data[$ps]; 

$date = $get['exp_date'];
//$date1 = strtr($date, '/', '-');
$mainDate = date('Y-m-d H:i', strtotime($date));


$today = date("Y-m-d H:i"); 

$startdate = $mainDate;   
$offset = strtotime("+1 day");
$enddate = date($startdate, $offset);    
$today_date = new DateTime($today);
$expiry_date = new DateTime($enddate);

?>



    <div class="col l4 s12 card">
          <div class="card-content">
            <p><h5><?php echo $get['plan'];  ?></h5></p>
            <div class="row">
               <div class="col s12 mb-0">Interest Rate: <?php echo $get['interest'];  ?>%</div>
               <div class="col s12 mt-0">Amount Invested: <?php echo '₦'.number_format($get['amount_invested']);  ?></div>
               <div class="col s12 mt-6">Cashout Amount: <?php echo '₦'.number_format($get['Amt_to_get']);  ?></div>
            </div>
          </div>

          <div class="card-action align-item-right">
           
            <?php
            if ($expiry_date < $today_date) { 

            ?>

            
          <?php }else{ ?>
             <div class="countdown">
        <span style="font-weight: bolder;" id="clock-<?php echo $get['id'] ?>"></span>
      </div>
   <script type="text/javascript">
            $('#clock-<?php echo $get['id'] ?>').countdown('<?php echo $mainDate;  ?>')
        .on('update.countdown', function(event) {
          var format = '%H:%M:%S';
          if(event.offset.totalDays > 0) {
            format = '%-d day%!d ' + format;
          }
          
          if(event.offset.weeks > 0) {
            format = '%-w week%!w ' + format;
          }
          /*if(event.offset.months > 0) {
            format = '%-m month%!d ' + format;
          }
          if(event.offset.year > 0) {
            format = '%-y year%!d ' + format;
          }*/
          $(this).html("Expire in: "+event.strftime(format)).parent()
          .addClass('active');
        })
        .on('finish.countdown', function(event) {
          $(this).html('Expired!')
            .parent().addClass('disabled');

        });
     </script>

          <?php
          }
          ?>


          </div>
        
      
    </div>







<?php
 endfor;
//} 
 echo '<div class="col l12 mt-5">';
echo $paginators->createLinks( $links2, 'pagination pagination-sm' );
echo '</div>';
}
?>








     
  
      
     
   </div>



<div class="row">
<div class="col-lg-12">

    

</div>
</div>

</div>
<!--card stats end-->

<?php include("right_menu.php"); ?>
         
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

  

    
 

<?php
include("footer.php");
?>

