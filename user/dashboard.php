<?php
include("header.php");
include("header_bottom.php");
include("left_nav.php");

$chart_data="";
$sell = getDailyGrowth($email);
    foreach($sell as $row){
  
          $productname[]  = $row['plan']  ;
            $rate[] = $row['daily_growth'];
}
?>

 <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="col s12">
          <div class="container">
            <!--card stats start-->
<div id="card-stats">
  <div id="msg"></div>

 <div class="col s12  mb-3 ">List of farm products you can invest on</div>

 <?php if($acno == ""){ ?>
<div class="col s12 alert alert-danger p-6">Your bank info need to be updated before you can invest. Go to your profile page to update your info.</div>
<?php
}
    if($productname){
    ?>
   <div class="row mt-2">
         
    <div class="col s12">
            <div class="iheader-text">Daily Growth on Farm Plans </div>
            <canvas  id="chartjs_bar"></canvas> 
        </div> 

</div>
 <?php } ?>
 <div class="row">

     <?php

//$plans = getPlans()
//DO NOT limit this query with LIMIT keyword, or...things will break!
$querys = "SELECT * FROM farm_packages where status='active' order by id desc";
$getifs = mysqli_query ($mysqli, $querys);

if(mysqli_num_rows($getifs) < 1){
   echo '<div class="col s12 alert alert-danger" style="text-align:center; padding: 7px; font-weight:bolder;">No plans to invest on at the moment. Please check back later.</div>';
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

$interesttotal = ceil((($get['capital'] / 100 * $get['percent']) * $get['duration'])/50)*50;
$interestdue = round($get['capital'] / 100 * $get['percent']);
$totalAmt = $get['capital'] + $interesttotal;

if(empty($get['img'])){
$myimg  = $set['installUrl'].'assets/img/farm.png';
}else{
$myimg = $set['installUrl'].'assets/images/'.$get['img'];
}
?>





    <div class="col m4  s12">
          <div class="card-content card-bg mb-3" style="padding-bottom: 4px; ">
            <div class="col-lg-12 col-sm-12 "><img src="<?php echo $myimg; ?>" style="width: 100%; max-height: 200px;"/></div>
            <p><h5><?php echo $get['category'];  ?></h5></p>
            <div class="row">
              <div class="col s12 mb-0 col-black">Interest Rate: <?php echo $get['percent'];  ?>%</div>
              <div class="col s12 mb-0 col-black">Duration: <?php echo $get['duration'];  ?> Months</div>
               <div class="col s12 mt-3 col-black"> Minimum amount to invest: <?php echo '₦'.number_format($get['capital']);  ?></div>
            </div>
         
          <div class="card-action align-item-right">

            <?php if($acno != ""){ ?>

           <a href="#mymodal" id="<?php echo $get['id']; ?>" data-email="<?php echo $email; ?>" data-duration="<?php echo $get['duration']; ?>" data-rate="<?php echo $get['percent']; ?>" data-amt="<?php echo $get['capital']; ?>" data-track-amt="<?php echo $get['capital']; ?>" data-total="<?php echo $totalAmt; ?>" data-totalinterest="<?php echo $interesttotal; ?>" data-cat="<?php echo $get['category']; ?>" data-name="<?php echo $name; ?>"  class="waves-effect waves-light btn btn-default col-white investme modal-trigger">Invest</a>

         <?php } ?>

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

  

  <div id="mymodal" class="modal">
    <div class="modal-content">                            
    <div id="basic-form" class="card card card-default scrollspy">
        <div class="card-content">
          <div class="card-title bidtitle l12"></div>
          <form id="reinvestForm">
           

            <div class="row">

          <div class="col s12 alert-info mb-3">
           
            You can increase the amount to invest on this plan but can't go below this amount.
            </div>
          

          
          <div class="input-field row">
          <div for="first_name" class="col l4 s12">Minimum Amount to invest </div>
          <input placeholder="Minimum Amount to invest" id="mainAmt" name="amount"  type="text" class="validate col l8 s12">
          
         </div>
       
              
              <div class="col s12">
                 <input type="hidden" id="id" name="id">
                 <input type="hidden" id="name" readonly="" name="name">
                 <input type="hidden" id="plan" readonly="" name="plan">
                 <input type="hidden" id="email" readonly="" name="email">
                 <input type="hidden" id="duration" name="duration">
                 <input type="hidden" id="rate" name="rate">
                 
                
                 <input type="hidden" id="trackamount" >

              </div>
            </div>
            
            <div class="row">

              <div class="col s12" id="dmsg"></div>
             
              <div class="row">
                <div class="input-field col s12">
                  <button class="btn btn-default col-white waves-effect waves-light right invest" type="submit">Invest</button>
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

   $(".investme").click(function(e) {
      e.preventDefault();

       var id              = $(this).attr('id'); // get id of clicked row 
       var email           = $(this).attr("data-email"); 
       var duration        = $(this).attr("data-duration"); 
       var percent         = $(this).attr("data-rate");
       var amt             = $(this).attr("data-amt"); 
       var totAmt          = $(this).attr("data-total");  
       var totInterest     = $(this).attr("data-totalinterest");
       var cat             = $(this).attr("data-cat");
       var name            = $(this).attr("data-name");
       var track_amt       = $(this).attr("data-track-amt");
       
//alert(totAmt);



       $("#id").val(id);
       $(".bidtitle").html("You are about to invest on <b>"+cat+"</b>");
       $("#name").val(name);
       $("#plan").val(cat);
       $("#email").val(email);
       $("#duration").val(duration);
       $("#rate").val(percent);
       $("#amt").val(totAmt);
       $("#interest").val(totInterest);
       $("#mainAmt").val(amt);
       $("#trackamount").val(track_amt);
    });






      var ctx = document.getElementById("chartjs_bar").getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels:<?php echo json_encode($productname); ?>,
                        datasets: [{
                            backgroundColor: [
                               "#5969ff",
                                "#ff407b",
                                "#25d5f2",
                                "#ffc750",
                                "#2ec551",
                                "#7040fa",
                                "#ff004e"
                            ],
                            data:<?php echo json_encode($rate); ?>,
                        }]
                    },
                    options: {
                           legend: {
                        display: false,
                        position: 'bottom',
 
                        labels: {
                            fontColor: '#71748d',
                            fontFamily: 'Circular Std Book',
                            fontSize: 14,
                        }
                    },
 
 
                }
                });
    </script>