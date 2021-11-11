<?php
    
    include('../../includes/config.php');


    $q = strtolower($_GET["q"]);
    if (!$q) return;

    $sql = "select subjects as value from subjects WHERE subjects LIKE '$q%'";

    /*$sql = "SELECT class FROM class 
    WHERE class LIKE '%".$_GET['query']."%'
    LIMIT 10"; */
    $rsd = mysqli_query($mysqli, $sql); 
    while($rs = mysqli_fetch_assoc($rsd)) {
        $rows[]=$rs;
    }
    // I am working on learning MySQLi but until that sticks, this MySQL will do.
    print json_encode($rows);

?>