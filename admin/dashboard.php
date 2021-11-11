<?php
include("header.php");
include("header_bottom.php");
include("left_nav.php");






//echo json_encode(array('children_data'=>$response));


?>


    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="col s12">
          <div class="container">


<!-- card stats start -->
   <div id="card-stats" class="pt-0">
      <div class="row">
         <div class="col s12 m6 l4">
            <div class="card animate fadeLeft">
               <div class="card-content cyan white-text">
                  <p class="card-stats-title"><i class="material-icons">person_outline</i> Total Investors</p>
                  <h4 class="card-stats-number white-text"><?php echo getMembers();  ?></h4>
                  <p class="card-stats-compare">
                     
                  </p>
               </div>
               <div class="card-action cyan darken-1">
                 
               </div>
            </div>
         </div>
         <div class="col s12 m6 l4">
            <div class="card animate fadeLeft">
               <div class="card-content  purple darken-4 white-text">
                  <p class="card-stats-title"><i class="material-icons">query_builder</i> Current Investments</p>
                  <h4 class="card-stats-number white-text"><?php echo activeInvestment(); ?></h4>
                  <p class="card-stats-compare">
                     
                  </p>
               </div>
               <div class="card-action purple">
                  
               </div>
            </div>
         </div>
         <div class="col s12 m6 l4">
            <div class="card animate fadeRight">
               <div class="card-content orange lighten-1 white-text">
                  <p class="card-stats-title"><i class="material-icons">timer</i> Ended Investment</p>
                  <h4 class="card-stats-number white-text"><?php echo endedInvestment(); ?></h4>
                  <p class="card-stats-compare">
                     
                  </p>
               </div>
               <div class="card-action orange">
                  
               </div>
            </div>
         </div>
         <div class="col s12 m6 l4">
            <div class="card animate fadeRight">
               <div class="card-content green lighten-1 white-text">
                  <p class="card-stats-title"><i class="material-icons">content_copy</i> Total Capital</p>
                  <h4 class="card-stats-number white-text"><?php echo currentCapital(); ?></h4>
                  <p class="card-stats-compare">
                    
                  </p>
               </div>
               <div class="card-action green">
                 
               </div>
            </div>
         </div>

          <div class="col s12 m6 l4">
            <div class="card animate fadeRight">
               <div class="card-content blue darken-4 white-text">
                  <p class="card-stats-title"><i class="material-icons">remove_red_eye</i> Current invested Farms</p>
                  <h4 class="card-stats-number white-text"><?php echo currentInvestedFarm(); ?></h4>
                  <p class="card-stats-compare">
                    
                  </p>
               </div>
               <div class="card-action blue">
                 
               </div>
            </div>
         </div>


         <div class="col s12 m6 l4">
            <div class="card animate fadeRight">
               <div class="card-content teal darken-4 white-text">
                  <p class="card-stats-title"><i class="material-icons">money</i> Total returns of users</p>
                  <h4 class="card-stats-number white-text"><?php echo totalReturns(); ?></h4>
                  <p class="card-stats-compare">
                    
                  </p>
               </div>
               <div class="card-action teal">
                 
               </div>
            </div>
         </div>




 <div class="col s12 m6 l6">
            <div class="card animate fadeRight">
               <div class="card-content amber accent-4 white-text">
                  <p class="card-stats-title"><i class="material-icons">content_copy</i> Current Capital</p>
                  <h4 class="card-stats-number white-text"><?php echo currentActiveCapital(); ?></h4>
                  <p class="card-stats-compare">
                    
                  </p>
               </div>
               <div class="card-action amber">
                 
               </div>
            </div>
         </div>


<div class="col s12 m6 l6">
            <div class="card animate fadeRight">
               <div class="card-content grey darken-3 white-text">
                  <p class="card-stats-title"><i class="material-icons">money</i> Current returns of users</p>
                  <h4 class="card-stats-number white-text"><?php echo totalActiveReturns(); ?></h4>
                  <p class="card-stats-compare">
                    
                  </p>
               </div>
               <div class="card-action grey">
                 
               </div>
            </div>
         </div>


<div class="col s12 l12" id="chartContainer" style="height: 400px;">

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

<script type="text/javascript">
$(function () {
    var chart = new CanvasJS.Chart("chartContainer", {
        theme: "light2",
        zoomEnabled: true,
        animationEnabled: true,
        title: {
            text: "Capital Invested and Returns"
        },
        data: [
        {
            type: "line",
            dataPoints: <?php echo json_encode($response, JSON_NUMERIC_CHECK); ?>
        }
        ]
    });
    chart.render();
});
</script>


<script type="text/javascript">
    $(function () {
        var chart = new CanvasJS.Chart("chartContainer", {
            title: {
                text: "Total Capital/Returns Chart"
            },
            animationEnabled: true,
            legend: {
                verticalAlign: "center",
                horizontalAlign: "left",
                fontSize: 15,
                fontFamily: "Helvetica"
            },
            theme: "light1",
            data: [
            {
                type: "pie",
                indexLabelFontFamily: "Garamond",
                indexLabelFontSize: 20,
                indexLabel: " {label} ₦{y}",
                startAngle: -1,
                showInLegend: true,
                toolTipContent: "{legendText} ₦{y}",
                dataPoints: <?php echo json_encode($response); ?>
            }
            ]
        });
        chart.render();
    });
</script>