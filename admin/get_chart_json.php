<?php
header('Access-Control_Allow-Origin: *');
header('Content-Type: application/json');

include('../inc/admins.php');  

/*$result = mysqli_query($mysqli,"SELECT sum(amount_invested) as capital, sum(Amt_to_get) as returns from plans");
$count = mysqli_num_rows($result);

if ($count > 0) {
    $arrayToEncode =  ['Total Capital', 'Total Returns'];
    while ($row = $result->fetch_assoc()) {
        $arrayToEncode[] = [$row['capital'], $row['returns']];
    }
    echo json_encode($arrayToEncode);
}*/
$result = mysqli_query($mysqli,"SELECT sum(amount_invested) as capital, sum(Amt_to_get) as returns from plans");
$count = mysqli_num_rows($result);
$response = array();
 while($row = mysqli_fetch_array($result))

{
                $response = array(
                    array("y" => $row["capital"], "legendText" => "Total Capital", "label" => "Total Capital"),
                    array("y" => $row["returns"], "legendText" => "Total Returns", "label" => "Total Returns")
               );

}

echo json_encode($response);

?>