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
                                            <h2 class="nk-block-title fw-normal">Investment Plan</h2>
                                            <div class="nk-block-des">
                                                <p>Choose your investment plan and start earning.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block row">
                                    
                                 <?php

//$plans = getPlans()
//DO NOT limit this query with LIMIT keyword, or...things will break!
$querys = "SELECT * FROM farm_packages where status='active' order by id desc";
$getifs = mysqli_query ($mysqli, $querys);

if(mysqli_num_rows($getifs) < 1){
   echo '<div class="col-lg-12 col-md-6 s12 alert alert-danger" style="text-align:center; padding: 7px; font-weight:bolder;">No plans to invest on at the moment. Please check back later.</div>';
}else{

 //these variables are passed via URL
$limits = ( isset( $_GET['limit'] ) ) ? $_GET['limit'] : 6; //list per page
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

<div class="col-lg-4 mb-3 animated fadeIn border-radius">

 <div class="card shadow">
    <img src="<?php echo $myimg; ?>" class="card-img-top" alt="">
    <div class="plan-item-head">
        <div class="plan-item-heading">
            <h4 class="plan-item-title card-title title"><?php echo $get['category'];  ?></h4>
            <p class="sub-text text-info text-bolder">Minimum amount to invest: <?php echo '₦'.number_format($get['capital']);  ?></p>
        </div>
        <div class="plan-item-summary card-text">
            <div class="row">
                <div class="col-6">
                    <span class="lead-text"><?php echo $get['percent'];  ?>%</span>
                    <span class="sub-text">Interest Rate</span>
                </div>
                <div class="col-6">
                    <span class="lead-text"><?php echo $get['duration'];  ?></span>
                    <span class="sub-text">Months</span>
                </div>
            </div>
        </div>
        <div class="card-action align-item-right mt-3">

            <?php if($acno != ""){ ?>

           <a href="#" data-toggle="modal" data-target="#mymodal" id="<?php echo $get['id']; ?>" data-email="<?php echo $email; ?>" data-duration="<?php echo $get['duration']; ?>" data-rate="<?php echo $get['percent']; ?>" data-amt="<?php echo $get['capital']; ?>" data-track-amt="<?php echo $get['capital']; ?>" data-total="<?php echo $totalAmt; ?>" data-totalinterest="<?php echo $interesttotal; ?>" data-cat="<?php echo $get['category']; ?>" data-name="<?php echo $name; ?>"  class="waves-effect waves-light btn btn-default col-white investme modal-trigger">Invest</a>

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

  


   <div class="modal fade zoom" tabindex="-1" id="mymodal">
            <div class="modal-dialog modal-lg" role="document">
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
                  <div class="col-lg-12 alert alert-info mb-3 text-bolder">
                    You can increase the amount to invest on this plan but can't go below this amount.
                    </div>
                    <div class="col-lg-12 mt-2 mb-2" id="msgs"></div>
                  <div class="input-field row">
                  <div for="first_name" class="col-lg-6 col-sm-12">
                  Minimum Amount to invest 
                  </div>
                  <div class="col-lg-6 col-sm-12">
                    <div class="form-group">
                        <div class="form-control-wrap">
                            <div class="form-text-hint">
                                <span class="overline-title">₦</span>
                            </div>
                            <input type="text" class="form-control" id="mainAmt" name="amount" placeholder="Minimum Amount to Invest">
                        </div>
                    </div>
                </div>

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
                    </div>
                    <div class="modal-footer bg-light">
                        <button class="btn btn-default col-white waves-effect waves-light right invest" type="submit">Invest</button>
                    </div>
                    </form>
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


    </script>