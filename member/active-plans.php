<?php
include("header.php");
include("top-header.php");


?>

<div class="nk-content nk-content-lg nk-content-fluid">
                    <div class="container-xl wide-lg">
                        <div class="nk-content-inner">
                            <div class="nk-content-bodys">
                                <div class="nk-block-head text-center">
                                    <div class="nk-block-head-content">
                                        
                                        <div class="nk-block-head-content">
                                            <h2 class="nk-block-title fw-normal">My Active Investment</h2>
                                            <div class="nk-block-des">
                                                <p>List of your active farm plans invested on.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block row">
                                    
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


<div class="col-lg-4 mb-3 animated fadeIn border-radius">

 <div class="card shadow">
    <div class="plan-item-head">
        <div class="plan-item-heading">
            <h4 class="plan-item-title card-title title"><?php echo $get['plan'];  ?></h4>
            <p class="sub-text text-info text-bolder">Expected Return: <?php echo '₦'.number_format($get['Amt_to_get'],2);  ?></p>
        </div>
        <div class="plan-item-summary card-text">
            <div class="row">
                <div class="col-6">
                    <span class="sub-text"><?php echo $get['interest'];  ?>%</span>
                    <span class="sub-text">Interest Rate</span>
                </div>
                <div class="col-6">
                    <span class="sub-text"><?php echo '₦'.number_format($get['amount_invested'],2);  ?></span>
                    <span class="sub-text">Amount Invested</span>
                </div>
                <div class="col-lg-12 mt-1 col-grey text-bolder">Daily Returns: <?php echo '₦'.number_format($get['daily_growth'],2);  ?></div>
            </div>
        </div>
        <div class="card-action align-item-right mt-3">
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
            if ($expiry_date > $today_date) { 

            ?>
           

            <a href="#" class="waves-effect waves-light btn bg-grey col-white">Roll Over</a>

            <a href="#" class="waves-effect waves-light btn btn-default btn-success-inactive disabled col-white">Cashout</a>

          <?php } ?>
             

          </div>
    </div>
   
</div>


</div>
<?php
 endfor;
//} 
 echo '<div class="col-lg-12 l12 mt-5">';
echo $paginators->createLinks( $links2, 'pagination pagination-lg justify-content-center' );
echo '</div>';
}
?>
                                   


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

  




<?php
include("footer.php");
?>

