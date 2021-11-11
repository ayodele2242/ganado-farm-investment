<?php 
include('../config.php');



$id = $_POST['id'];
$url = $mysqli->real_escape_string($_POST['url']); 
$photoid = $mysqli->real_escape_string($_POST['hidImg']);

if($url == ""){
$urlf = "";
}else{
$urlf = $url;
}




$fileName = $_FILES['slidderImg']['name'];

$type = explode('.', $fileName);
$type = $type[count($type) - 1];

$imgUrl = '../../assets/uploads/' . uniqid(rand()) . '.' . $type;

if(!empty($fileName)){
$pic = $imgUrl;
}else if(empty($fileName) && $photoid != ''){
$pic  = $photoid;
}else{
$pic = '';
}



if(!empty($fileName)){
move_uploaded_file($_FILES['slidderImg']['tmp_name'], $imgUrl);

}
// Update database
$sql = $mysqli->query("UPDATE slidder SET img_name ='$pic', url='$urlf' WHERE id='$id'");



if(!empty($_POST['slider_text'])){

$rowCount = count($_POST['slider_text']);

	for($i = 0; $i < $rowCount; $i++)
{ 		
$aid = $_POST['aid'][$i];	
$stext 	  = $_POST['slider_text'][$i];	
$atype    = $_POST['animation_type'][$i];
$position = $_POST['text_position'][$i];

	    $sql = "UPDATE slidder_animation SET slider_text='$stext',animation_type='$atype',text_position='$position' WHERE slidder_id = '$aid'"; 

	     $suc =  mysqli_query($mysqli, $sql); 
        
    }       
         
//}
//}

if( $suc){
echo "saved";
}else{
echo $mysqli->error;
}



} 
else {
echo "Query could not execute.! " . $mysqli->error;
}




