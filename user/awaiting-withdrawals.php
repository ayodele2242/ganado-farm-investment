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
      
     <div class="col s12 iheader-text">List of your active farm plans awaiting withdrawal</div>




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


$interesttotal = ceil((($get['Amt_to_get'] / 100 * $get['interest']) * $get['duration'])/50)*50;
$interestdue = round($get['Amt_to_get'] / 100 * $get['interest']);
$totalAmt = $get['Amt_to_get'] + $interesttotal;

?>



    <div class="col l4 s12 card">
          <div class="card-content">
            <p><h5><?php echo $get['plan'];  ?></h5></p>
            <div class="row">
               <div class="col s12 mb-0">Interest Rate: <?php echo $get['interest'];  ?>%</div>
               <div class="col s12 mt-0">Amount Invested: <?php echo '₦'.number_format($get['amount_invested']);  ?></div>
               <div class="col s12 mt-6">Expected Amount: <?php echo '₦'.number_format($get['Amt_to_get']);  ?></div>
            </div>
          </div>

         

            <?php
            if ($expiry_date < $today_date) { 

            ?>
             <div class="card-action align-item-right">
                       <a href="#modaldemo98" id="<?php echo $get['id']; ?>"  data-amt="<?php echo $get['Amt_to_get']; ?>" data-plan="<?php echo $get['plan']; ?>" data-trx="<?php echo $get['Trx_code']; ?>" class="waves-effect waves-light btn btn-success col-white modal-trigger withdraw">Cashout</a>

            <a href="#mymodal" id="<?php echo $get['id']; ?>" data-pid="<?php echo $get['plan_id']; ?>" data-email="<?php echo $email; ?>" data-duration="<?php echo $get['duration']; ?>" data-rate="<?php echo $get['interest']; ?>" data-amt="<?php echo $get['Amt_to_get']; ?>" data-total="<?php echo $totalAmt; ?>" data-totalinterest="<?php echo $interesttotal; ?>" data-cat="<?php echo $get['plan']; ?>" data-name="<?php echo $name; ?>"  class="waves-effect waves-light btn btn-warning col-white reinvest modal-trigger">Rollover</a>

             
          <?php } ?>
             

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




<div id="modaldemo98" class="modal">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h5 class="modal-title all-title">Notification</h5>
                
            </div>
            <div class="modal-body">

            <div class="otp-div">

               <div class="alert alert-info" role="alert">
                <p>
                    <strong>To withdraw your cash, please use the GAPP app.</strong>
                  </p>
                  <p>
                    If you haven't download our app, go to google PlayStore to download it.
                  </p>
                </div>
            </div><!--otp-div #end-->

        </div>
    </div><!-- modal-dialog -->
</div><!-- modal -->

</div>    

  

 <div id="mymodal" class="modal">
    <div class="modal-content">                            
    <div id="basic-form" class="card card card-default scrollspy">
        <div class="card-content">
          <div class="card-title bidtitle l12"></div>
          <div class="card-title iAmt l12"></div>
          <form id="reinvestForm">
            <div class="row">


              <div class="col s12">
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
            </div>
            
            <div class="row">

              <div class="col s12" id="dmsg"></div>
             
              <div class="row">
                <div class="input-field col s12">
                  <button class="btn btn-warning col-white  waves-effect waves-light right okMe" type="submit">Rollover</button>
                </div>
              </div>
            </div>
          </form>
        </div>
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
                   $("#msg").html('<div class="alert alert-success">You have successfully re-invested on <b>'+ cat+'</b></div>').show();
                   setTimeout(function() {
              $("#msg").fadeOut(1500);
          }, 10000);
                   
                   setTimeout(' window.location.href = "active-plans"; ',1000);
                  
                  }else{
                    $("#msgs").html('<div class="alert alert-danger text-left">'+data+'</div>').show();
          setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);
                  }
            }
          });


    });

 });

</script>