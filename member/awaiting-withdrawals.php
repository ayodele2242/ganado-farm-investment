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
                                            <h2 class="nk-block-title fw-normal">My Investment</h2>
                                            <div class="nk-block-des">
                                                <p>List of your active farm plans awaiting withdrawal.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block row">
                                    
<?php

//$plans = getPlans()
//DO NOT limit this query with LIMIT keyword, or...things will break!
$querys = "SELECT * FROM plans where email='$email' and status = 'waiting_withdrawal'";
$getifs = mysqli_query ($mysqli, $querys);

if(mysqli_num_rows($getifs) < 1){
   echo '<div class="col s12 alert alert-danger" style="text-align:center; padding: 7px; font-weight:bolder;">No expired active plans to withdraw from at the moment. Please check back later.</div>';
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
            if ($expiry_date < $today_date) { 

            ?>
             <div class="card-action align-item-right">
                       <a href="#" data-toggle="modal" data-target="#modaldemo98" id="<?php echo $get['id']; ?>"  data-amt="<?php echo $get['Amt_to_get']; ?>" data-plan="<?php echo $get['plan']; ?>" data-trx="<?php echo $get['Trx_code']; ?>" class="waves-effect waves-light btn btn-success col-white modal-trigger withdraw">Cashout</a>

            <a href="#" data-toggle="modal" data-target="#mymodal" id="<?php echo $get['id']; ?>" data-pid="<?php echo $get['plan_id']; ?>" data-email="<?php echo $email; ?>" data-duration="<?php echo $get['duration']; ?>" data-rate="<?php echo $get['interest']; ?>" data-amt="<?php echo $get['Amt_to_get']; ?>" data-total="<?php echo $totalAmt; ?>" data-totalinterest="<?php echo $interesttotal; ?>" data-cat="<?php echo $get['plan']; ?>" data-name="<?php echo $name; ?>"  class="waves-effect waves-light btn btn-warning col-white reinvest modal-trigger">Rollover</a>

             
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

  


<div class="modal fade zoom" tabindex="-1" id="modaldemo98">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><ion-icon class="icon" name="notifications"></ion-icon> Notification</h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                   <ion-icon class="icon" name="close"></ion-icon>
                </a>
            </div>
            <div class="modal-body">
               <p>
            <strong>To withdraw your cash, please use the GAPP app.</strong>
          </p>
          <p>
            If you haven't download our app, go to google PlayStore to download it.
          </p>
            </div>
            
        </div>
    </div>
</div>


<div class="modal fade zoom" tabindex="-1" id="mymodal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title bidtitle"></h5>
                <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                   <ion-icon class="icon" name="close"></ion-icon>
                </a>
            </div>
            <form id="reinvestForm">
            <div class="modal-body">
               <div class="row">
                <div class="card-title iAmt col-lg-12 mb-3"></div>

              <div class="col-lg-12">
                 <input type="hidden" id="id" name="id">
                 <input type="hidden" id="plan" readonly="" name="plan">
                 <input type="hidden" id="name" readonly="" name="name">
                 <input type="hidden" id="email" readonly="" name="email">
                 <input type="hidden" id="duration" name="duration">
                 <input type="hidden" id="rate" name="rate">
                 <input type="hidden" id="amt" name="totAmt">
                 <input type="hidden" id="mainAmt" name="amount">
                 <input type="hidden" id="interest" name="interest">
              </div>
               <div class="col-lg-12"><div class="col s12" id="dmsg"></div></div>

            </div>

            </div>

            <div class="modal-footer bg-light">
              <button class="btn btn-warning col-white  waves-effect waves-light right okMe" type="submit">Rollover</button>
            </div>
          </form>
            
        </div>
    </div>
</div>



<?php
include("footer.php");
?>

<script type="text/javascript">
  $(document).ready(function() {

        function format(n, sep, decimals) {
        sep = sep || "."; // Default to period as decimal separator
        decimals = decimals || 2; // Default to 2 decimals

        return n.toLocaleString().split(sep)[0]
            + sep
            + n.toFixed(decimals).split(sep)[1];
       }

   $(".reinvest").click(function(e) {
      e.preventDefault();

       var id              = $(this).attr('id'); // get id of clicked row 
       var planid            = $(this).attr("data-pid");
       var name            = $(this).attr("data-name");
       var email           = $(this).attr("data-email"); 
       var duration        = $(this).attr("data-duration"); 

       var percent         = $(this).attr("data-rate");
       var amttoInvest     = $(this).attr("data-amt");
       var cat             = $(this).attr("data-cat");
       
       var totInterest     = $(this).attr("data-totalinterest");
       var totAmt          = $(this).attr("data-total");  
       var amt            = $(this).attr("data-amt");  
       
       
//alert(totAmt);



       $("#id").val(id);
       $(".bidtitle").html("You are about to re-invest on <b>"+cat+"</b>");
       $(".iAmt").html("Rollover Amount: <b>"+amt+"</b>");
       $("#name").val(name);
       $("#plan").val(cat);
       $("#email").val(email);
       $("#duration").val(duration);
       $("#rate").val(percent);
       $("#amt").val(totAmt);
       $("#interest").val(totInterest);
       $("#mainAmt").val(amt);
    });

 });


//Send request
    $(document).ready(function() {

        function format(n, sep, decimals) {
        sep = sep || "."; // Default to period as decimal separator
        decimals = decimals || 2; // Default to 2 decimals

        return n.toLocaleString().split(sep)[0]
            + sep
            + n.toFixed(decimals).split(sep)[1];
       }

   $(".okMe").click(function(e) {
      e.preventDefault();



      var id = $("#id").val();
      var name =  $("#name").val();
      var cat = $("#plan").val();
      var email = $("#email").val();
      var duration = $("#duration").val();
      var rate = $("#rate").val();
      var amttoInvest =  $("#mainAmt").val();
      var totAmt  = $("#amt").val();
      var interest = $("#interest").val();


   // alert(message);
     $.ajax({
            url: 're-invest-money.php',
            method: 'post',
            async:false,
            data:{id: id},
            success: function (data) {
              if(data == 1){

                $.toast({ 
            text : 'You have successfully re-invested on '+ cat, 
            showHideTransition : 'fade',
            bgColor : 'green',            
            textColor : '#fff',
            allowToastClose : false,
            hideAfter : 2000,
            loader: false,            
            stack : 5,                     
            textAlign : 'center', 
            position : 'top-right'  
            });
 
              setTimeout(' window.location.href = "active-plans"; ',1000);
                  
                  }else{

            $.toast({ 
            text : 'Error occured: '+ data, 
            showHideTransition : 'fade',
            bgColor : 'red',            
            textColor : '#fff',
            allowToastClose : false,
            hideAfter : 2000,
            loader: false,            
            stack : 5,                     
            textAlign : 'center', 
            position : 'top-right'  
            });

                   
                  }
            }
          });


    });

 });

</script>