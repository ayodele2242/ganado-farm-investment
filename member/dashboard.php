<?php
include("header.php");
include("top-header.php");

$chart_data="";
$sell = getDailyGrowth($email);
    foreach($sell as $row){
  
          $productname[]  = $row['plan']  ;
            $rate[] = $row['daily_growth'];
}
$limit = 10;
$hist = planHistory($email, $limit);
?>
<script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>



    <div class="nk-content nk-content-lg nk-content-fluid ">
                    <div class="container-xl wide-lg ">
                        <div class="nk-content-inner">
                            <div class="nk-content-body mt-5">
                                <div class="nk-block-head">
                                    <div class="nk-block-between-md g-3">
                                        <div class="nk-block-head-content">
                                            <div class="nk-block-head-sub">
                                                <span>Welcome!</span>
                                            </div>
                                            <div class="align-center flex-wrap pb-2 gx-4 gy-3">
                                                <div>
                                                    <h2 class="nk-block-title fw-normal"><?php echo ucwords($name); ?></h2>
                                                </div>
                                                <div>
                                                <a href="active-plans" class="btn btn-white btn-light">
                                                    My Plans  <ion-icon class="icon ml-2" name="arrow-forward"></ion-icon>

                                                        
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="nk-block-des">
                                                <p>At a glance summary of your investment account.</p>
                                                <?php echo easy_decrypt('cGFzc3dvcmRfQCMhQA=='); ?>
                                            </div>
                                        </div>
                                         <!--<div class="nk-block-head-content d-none d-md-block">
                                             <div class="nk-slider nk-slider-s1">
                                                 <div class="slider-init" data-slick='{"dots": true, "arrows": false, "fade": true}'>

                                                    hello

                                                 </div>
                                                 

                                             </div>
                                         </div>-->
                                        
                                        </div>
                                    </div>
                                </div>
                                 <?php if($acno == ""){ ?>
                                <div class="nk-block">
                                    <div class="nk-news card card-bordered alert alert-danger">
                                        <div class="card-inner">
                                            <div class="nk-news-list">
                                                <a class="nk-news-item" href="#">
                                                    <div class="nk-news-icon">
                                                        <ion-icon class="icons" name="information-circle-outline"></ion-icon>
                                                    </div>
                                                   
                                                    <div class="nk-news-text">
                                                        
                                                           Your bank info need to be updated before you can invest. Go to your profile page to update your info.
                                                      
                                                        
                                                    </div>
                                                

                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="nk-block">
                                    <div class="row gy-gs">
                                        <div class="col-md-6 col-lg-4">
                                            <div class="nk-wg-card is-dark card card-bordered">
                                                <div class="card-inner">
                                                    <div class="nk-iv-wg2">
                                                        <div class="nk-iv-wg2-title">
                                                            <h6 class="title">
                                                                Total Daily Growth <ion-icon name="information-circle-outline"></ion-icon>
                                                            </h6>
                                                        </div>
                                                        <div class="nk-iv-wg2-text">
                                                            <div class="nk-iv-wg2-amount">
                                                                <?php  echo getBalance($email); ?> 
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-4">
                                            <div class="nk-wg-card is-s1 card card-bordered">
                                                <div class="card-inner">
                                                    <div class="nk-iv-wg2">
                                                        <div class="nk-iv-wg2-title">
                                                            <h6 class="title">
                                                                Total Invested <ion-icon name="information-circle-outline"></ion-icon>
                                                            </h6>
                                                        </div>
                                                        <div class="nk-iv-wg2-text">
                                                            <div class="nk-iv-wg2-amount">
                                                               <?php echo totInvested($email); ?>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-lg-4">
                                            <div class="nk-wg-card is-s3 card card-bordered">
                                                <div class="card-inner">
                                                    <div class="nk-iv-wg2">
                                                        <div class="nk-iv-wg2-title">
                                                            <h6 class="title">
                                                                Total Profits <ion-icon name="information-circle-outline"></ion-icon>
                                                            </h6>
                                                        </div>
                                                        <div class="nk-iv-wg2-text">
                                                            <div class="nk-iv-wg2-amount">
                                                                <?php echo totReturned($email);  ?> 
                                                               
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="nk-block">
                                    <div class="row gy-gs">
                                      
                                        <div class="col-md-6 col-lg-7">
                                            <div class="nk-wg-card card card-bordered h-100">
                                                <div class="card-inner h-100">
                                                     <div class="nk-iv-wg2">
                                                        <div class="nk-iv-wg2-title">
                                                            <h6 class="title">Daily Growth on Farm Plans Investment</h6>
                                                        </div>
                                                        <div class="nk-iv-wg2-text">
                                                            <?php if($productname){  ?>

                                                                <canvas  id="chartjs_bar"></canvas> 

                                                             <?php }else{ echo '<div class="tell-body"><div class="text-danger tell pt-5">You are yet to invest</div></div>'; } ?>

                                                        </div>
                                                     </div>
                                                </div>

                                            </div>
                                         </div>

                                        <div class="col-md-12 col-lg-5">
                                            <div class="nk-wg-card card card-bordered h-100">
                                                <div class="card-inner h-100">
                                                    <div class="nk-iv-wg2">
                                                        <div class="nk-iv-wg2-title">
                                                            <h6 class="title">My Investment</h6>
                                                        </div>
                                                        <div class="nk-iv-wg2-text">
                                                            <div class="ui-v2 mb-3">
                                                                <small class="text-success"> <ion-icon name="arrow-up"></ion-icon> Successful Payment </small> &nbsp;&nbsp; <small class="text-danger"> <ion-icon name="arrow-down"></ion-icon> Failed Payment </small>

                                                            </div>
                                                           
                                                            <ul class="nk-iv-wg2-list">
                                                                <?php foreach($hist as $planhistory){ 

                                                                    ?>
                                                                <li <?php  if($planhistory['transId'] != ""){ echo 'class="text-success"'; }else{ echo 'class="text-danger"'; } ?>>
                                                                     <?php if($planhistory['transId'] != ""){ 
                                                                        echo '<ion-icon name="arrow-up"></ion-icon>'; }else{ 
                                                                        echo '<ion-icon name="arrow-down"></ion-icon>'; } 
                                                                       ?>
                                                                    <span class="item-label">

                                                                        <a href="#" <?php  if($planhistory['transId'] != ""){ echo 'class="text-success"'; }else{ echo 'class="text-danger"'; } ?>>

                                                                            <?php echo $planhistory['plan']; ?> </a>
                                                                        <small>- <?php echo $planhistory['interest']; ?>% for <?php echo $planhistory['duration']; ?> Months</small>
                                                                    </span>
                                                                    <span class="item-value"><?php echo number_format($planhistory['amount_invested'],2); ?></span>

                                                                     
                                                                </li>

                                                            <?php } ?>
                                                               
                                                            </ul>
                                                        </div>
                                                        <div class="nk-iv-wg2-cta">
                                                            <a href="#" class="btn btn-light btn-lg btn-block">See all Investment</a>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                         


                                    </div>
                                </div>
                                <div class="nk-block">
                                    <div class="card card-bordered">
                                        <div class="nk-refwg">
                                            <div class="nk-refwg-invite card-inner">
                                                <div class="nk-refwg-head g-3">
                                                    <div class="nk-refwg-title">
                                                        <h5 class="title">Refer Us & Earn</h5>
                                                        <div class="title-sub">Use the bellow link to invite your friends.</div>
                                                    </div>
                                                    <div class="nk-refwg-action">
                                                        <a href="#" class="btn btn-primary">Invite</a>
                                                    </div>
                                                </div>
                                                <div class="nk-refwg-url">
                                                    <div class="form-control-wrap">
                                                        <div class="form-clip clipboard-init">
                                                           <ion-icon name="copy"></ion-icon>
                                                            <span class="clipboard-text" onclick="copy('hello world')">Copy Link</span>
                                                        </div>
                                                        <div class="form-icon">
                                                           <ion-icon name="link"></ion-icon>
                                                        </div>
                                                        <input type="text" class="form-control copy-text" id="refUrl" value="<?php echo $set['installUrl']; ?>?ref=4945KD48">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-refwg-stats card-inner bg-lighter">
                                                <div class="nk-refwg-group g-3">
                                                    <div class="nk-refwg-name">
                                                        <h6 class="title">
                                                            My Referral  <ion-icon name="information-circle" data-toggle="tooltip" data-placement="right" title="Referral Informations"></ion-icon>
                                                           
                                                        </h6>
                                                    </div>
                                                    <div class="nk-refwg-info g-3">
                                                        <div class="nk-refwg-sub">
                                                            <div class="title">0</div>
                                                            <div class="sub-text">Total Joined</div>
                                                        </div>
                                                        <div class="nk-refwg-sub">
                                                            <div class="title">0</div>
                                                            <div class="sub-text">Referral Earn</div>
                                                        </div>
                                                    </div>
                                                    <div class="nk-refwg-more dropdown mt-n1 mr-n1">
                                                        <a href="#" class="btn btn-icon btn-trigger" data-toggle="dropdown">
                                                           <ion-icon name="more"></ion-icon>
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-xs dropdown-menu-right">
                                                            <ul class="link-list-plain sm">
                                                                <li>
                                                                    <a href="#">7 days</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">15 Days</a>
                                                                </li>
                                                                <li>
                                                                    <a href="#">30 Days</a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="nk-refwg-ck">
                                                    <canvas class="chart-refer-stats" id="refBarChart"></canvas>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

<?php
include("footer.php");
?>

<script type="text/javascript">

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