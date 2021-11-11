<?php
   include("../includes/functions.php");
  $id = $_POST['page_id'];
  $status = $_POST['status'];
  $query = "UPDATE mp_pages SET status = '$status' where page_id ='$id'";
  $update = mysqli_query($mysqli, $query);
  ?>