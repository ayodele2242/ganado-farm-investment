<?php
include("header.php");
include("link.php");
?>


<?php
//include("slider.php");
$hcont = mysqli_query($mysqli,"select * from faqs");
$count = mysqli_num_rows($hcont);
$row = mysqli_fetch_array($hcont);
?>

<section class="pt-1 pb-5 mb-2 pr-body">

<div class="row">
      
     <div class="col-lg-12 s12"><h4>FAQs</h4></div>
<div class="col-lg-12 s12">
   <?php
 $s = html_entity_decode($row['content']); 
      
      echo eval('?>' . utf8_encode($s) . '<?php ');
?>



</div>      

</div>

</section>










 <?php include("footer.php"); ?>

 
