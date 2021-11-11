<?php
header('Content-Type: application/json');


include "../functions.php";
    
echo $id = $_GET['id'];

$result = mysqli_query($mysqli, "SELECT * FROM mp_pages WHERE page_id='$id'");
$response= array();
while($row = mysqli_fetch_array($result))

{
array_push($response, array(
"gjs-components"=>$row['gjs-component'], 
"gjs-css"=>$row['css'], 
"gjs-html"=>$row['page_desc'], 
"gjs-style"=>$row['gjs-styles']
));

}

echo json_encode($response);

mysqli_close($mysqli);


	?>