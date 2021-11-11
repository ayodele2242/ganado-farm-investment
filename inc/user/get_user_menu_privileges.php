<?php
include '../config.php';

$id = $_GET["id"];
$query = "SELECT rr_modulecode FROM role_rights WHERE rr_rolecode = '$id'";
$showit = mysqli_query($mysqli, $query);
$count = mysqli_num_rows($showit);
if ($count  > 0) { ?>
<ul>
 
 <?php while($row = mysqli_fetch_array($showit)){  ?>
  <li class=''><?php echo $row['rr_modulecode'] ?></li>  
 <?php } ?>

</ul>
<?php

}else{
  echo "Nothing to show";
}
?>