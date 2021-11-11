<?php
include("header.php");
include("link.php");
?>



  
<section class="my-1" style="padding: 7px; ">
<?php
//get parent details


if($getc < 1){
    echo '<div class="alert alert-danger">No post yet for this link</div>';
}else{

  if($_GET['pid'] == 'home'){
    header("Location: index");
  }else{

  $ids = $pt['nav_id'];
    $pd = mysqli_query($mysqli,"select parent_id, link from navigation_bar where link = '$ids'");
    $rob = mysqli_fetch_array($pd);
   echo $na = $rob['parent_id'];

    $pd2 = mysqli_query($mysqli,"select name, link from navigation_bar where id = '$na'");
    $rob2 = mysqli_fetch_assoc($pd2);
    $na2 = $rob2['link'];

    if($na2){
      $slash = " > ";
    }else{
      $slash = "";
    }

    if(empty($pt['page_title'])){
      $ptitle = ucfirst($_GET['pid']);
    }else{
      $ptitle = $pt['page_title'];
    }
    

    echo  '<p><h4><a class="text-success" href="index"><i class="fa fa-home"></i> Home</a> > <a href="page?pid='.$rob2['link'].'">'.ucwords($rob2['name']).'</a>'. $slash .''.ucwords($pt['link']).'</h4></p>';
    $type = $cget['img_type'];
    if($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png'){
        echo '<img src="'.$set['installUrl'].'assets/uploads/'.$pt['img'].'"  class="img-fluid img-thumbnail">';
    }else if($type == 'video/mp4' || $type == 'video/avi' || $type == 'video/wav' || $type == 'video/3gp' || $type == 'video/AAC'
    || $type == 'video/flv' || $type == 'video/wmv'){
        echo '<video controls="" class="img-fluid">
        <source src="'.$set['installUrl'].'assets/uploads/'.$pt['img'].'" type="'.$type.'">
        Your browser does not support the video tag.
        </video>
        ';
    }elseif($type == 'audio/mp3'){
     echo '<audio id="audio" autoplay controls src="'.$set['installUrl'].'assets/uploads/'.$pt['img'].'" type="'.$type.'" class="img-fluid"></audio>';
    }
     
      $s = html_entity_decode($cget['page_desc']); 
      
      echo eval('?>' . utf8_encode($s) . '<?php ');
      
      } 

}
    ?> 
</section>



 <?php include("footer.php"); ?>


