<?php
    include("connection.php");
    $all=array();
    if(isset($_GET["u"])){        
        $u=$_GET["u"];
        if($u=="farmer"){
            $statement="SELECT * FROM tblproducts ORDER BY flddemand DESC";
        }else{
            $statement="SELECT * FROM tblproducts ORDER BY fldproduct ASC";
        }
        $query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
        $products=array();
        while($record=mysqli_fetch_assoc($query)){      
            $product=$record['fldproduct'];
            $statement="SELECT fldproduct FROM tblproduce WHERE fldproduct='$product'";
            $produce_query=mysqli_query($conn,$statement) or die(mysqli_error($conn));
            $listing=mysqli_num_rows($produce_query);

            $record["fldlisting"]=$listing;     
            $products[]=$record;
        }
        $statement_total="SELECT SUM(flddemand) FROM tblproducts";
        $query_total=mysqli_query($conn,$statement_total) or die(mysqli_error($conn));
        $all["products"]=$products;
        $all["total"]=mysqli_fetch_assoc($query_total)["SUM(flddemand)"];
    }
    echo json_encode($all);
?>