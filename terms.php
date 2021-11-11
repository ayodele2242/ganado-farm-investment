<?php
include("header.php");
include("link.php");
?>


<?php
//include("slider.php");
$hcont = mysqli_query($mysqli,"select * from terms");
$count = mysqli_num_rows($hcont);
$row = mysqli_fetch_array($hcont);
?>

<section class="pt-1 pb-5 mb-2 pr-body">

<div class="row">
      
     <div class="col-lg-12 s12"><h4>Terms & Conditions</h4></div>
<div class="col-lg-12 s12">
   <?php
 $s = html_entity_decode($row['content']); 
      
      echo eval('?>' . utf8_encode($s) . '<?php ');
?>



</div>      

</div>

</section>

  
<section>







<?php
if($count < 1){
    echo '<div class="alert alert-danger">No post yet for this link</div>';
}else{
    $hget = mysqli_fetch_array($hcont);
    ?>
 <style><?php echo   $hget['css']; ?></style>
 <?php
     $s = html_entity_decode($hget['page_desc']); 
      
      echo eval('?>' . utf8_encode($s) . '<?php ');
    
}

?>
</section>









 <?php include("footer.php"); ?>

 
