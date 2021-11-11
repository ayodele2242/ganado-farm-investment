<!--<div class="slider-wrapper theme-default">

<div id="slider" class="nivoSlider"> 

<?php
            
            //$sele = mysqli_query($mysqli, "select * from slidder where status='1' order by id desc limit 5");
            //while($ro = mysqli_fetch_array($sele)){

 //$id = $ro['img_name'];
           // $anim = mysqli_query($mysqli, "select * from slidder_animation where slidder_id = '$id' ");
            //$row = mysqli_fetch_array($anim);
?>


	<img src="<?php //echo $set['installUrl']; ?>assets/images/<?php //echo $ro['img_name']; ?>"  class="img-fluid img-responsive nimg">

     <div class="carousel-caption d-md-block">
              <h3 class="icon-container" class="animated bounceInDown">
                <span class="fa fa-heart"></span>
              </h3>
              <h3 class="animated bounceInUp">
                This is the caption for slide 2
              </h3>
              <button class="btn btn-primary btn-lg" class="animated zoomInRight">Button</button>
            </div>


<?php
//}
?>

</div>
</div>-->

<?php
$sql = "select * from slidder where status='1' order by id desc limit 5";
$res = $mysqli->query($sql);

$rows = array();
while ($row = $res->fetch_assoc()) {
    $rows[] = $row;
}
?>
<div id="carouselControls" class="carousel slide carousel-fade" data-ride="carousel">
<div class="carousel-inner" role="listbox">
    <!--Indicators-->
  
<?php $i = 1; ?>
<?php 
foreach ($rows as $row){ 
           $id = $row['id'];
            $anim = mysqli_query($mysqli, "select * from slidder_animation where slidder_id = '$id' ");
  $type = $row['img_type']; 

    if($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png'){
       $img = '<img src="assets/uploads/'.$row['img_name'].'"  class="d-block w-100"  >';
    }else {
        $img = '<div class="view"><a href="#"><video class="video-fluid" autoplay loop muted>
        <source src="assets/uploads/'.$row['img_name'].'" type="'.$type.'">
        Your browser does not support the video tag.
        </video></a></div>
        ';
}          

?>
<?php $item_class = ($i == 1) ? 'carousel-item active ' : 'carousel-item item'; ?>
    <div class="<?php echo $item_class; ?>">
        <!--Mask color-->
      
      
        <?php   echo $img; ?>
      
      <!--<div class="mask rgba-indigo-light"></div>-->
 

  <!--Caption-->
  
      <div class="carousel-caption d-md-block">
        <?php
  while($rows = mysqli_fetch_array($anim)){ 
    $post = $rows['text_position'];
    if($post == 'right'){
        $position = 'rights';
    }elseif($post == 'left'){
        $position = 'lefts';
    }
    elseif($post == 'center'){
        $position = 'centers';
    }elseif($post == 'top'){
        $position = 'tops';
    }elseif($post == 'bottom'){
        $position = 'bottoms';
    }elseif($post == 'center_left'){
        $position = 'center_left';
    }
    elseif($post == 'center_right'){
        $position = 'center_right';
    }
    else{
        $position = '';
    }
    ?>
        <div class="m-bt-10  <?php echo $position;  ?> cbody">
          <h1 class="h1-responsive animated <?php echo $rows['animation_type']; ?>"><?php echo $rows['slider_text']; ?></h1>
          <p class="animated <?php echo $rows['animation_type']; ?>"><?php echo $rows['descr']; ?></p>
          <?php
          if(!empty($rows['url'])){ ?>
          <a class="btn btn-md btn-info animated lightSpeedIn" href="<?php echo $rows['url']; ?>"><?php echo $rows['btn_text']; ?></a>
      <?php } ?>
        </div>

        <?php
         } ?>
      </div>
      <!--Caption-->
      
    </div>
<?php $i++; ?>
<?php } ?>
  </div>
  <!--<a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>-->
</div>
