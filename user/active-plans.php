<?php
include("header.php");
include("header_bottom.php");
include("left_nav.php");
$length = 10;
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
      
     <div class="col s12 iheader-text">List of your active farm plans invested on</div>




     <?php

//$plans = getPlans()
//DO NOT limit this query with LIMIT keyword, or...things will break!
$querys = "SELECT p.*, m.Trx_code FROM plans p JOIN members m on p.email=m.email where p.email='$email' and p.status = 'active' and p.transId != ''";
$getifs = mysqli_query ($mysqli, $querys);

if(mysqli_num_rows($getifs) < 1){
   echo '<div class="col s12 alert alert-danger" style="text-align:center; padding: 7px; font-weight:bolder;">You don\'t have any active plans at the moment.</div>';
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



$now = time(); // or your date as well
$your_date = strtotime($date);
$datediff = $your_date-$now;

$gdate =  round($datediff / (60 * 60 * 24));

$currentgrowthrate = $get['Amt_to_get']/$gdate;


?>



         <div class="col l4 s12 mb-2">
          <div class="card-content bgreen ">
            <p><h5 class="col-white"><?php echo $get['plan'];  ?></h5></p>
            <div class="row ">
               <div class="col s12 mb-0 col-white">Interest Rate: <?php echo $get['interest'];  ?>%</div>
               <div class="col s12 mt-0 col-white">Amount Invested: <?php echo '₦'.number_format($get['amount_invested']);  ?></div>
                <div class="col s12 mt-1 col-white">Daily Returns: <?php echo '₦'.number_format($get['daily_growth']);  ?></div>
               <div class="col s12 mt-6 col-white">Expected Return: <?php echo '₦'.number_format($get['Amt_to_get']);  ?></div>

              
            </div>
          

          <div class="card-action align-item-right">
           
           
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
          $(this).html("Maturity Date: "+event.strftime(format)).parent()
          .addClass('active');
        })
        .on('finish.countdown', function(event) {
          $(this).html('Expired!')
            .parent().addClass('disabled');

        });
     </script>

          <?php
          //}
          ?>


 <div class="card-action align-item-right mt-1">
           
            <?php
            if ($expiry_date > $today_date) { 

            ?>
           

            <a href="#" class="waves-effect waves-light btn bg-grey col-white">Roll Over</a>

            <a href="#" class="waves-effect waves-light btn btn-success-inactive disabled btn col-white">Cashout</a>

          <?php } ?>
             

          </div>

          </div>

         
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


