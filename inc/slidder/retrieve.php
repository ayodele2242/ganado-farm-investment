<?php 
require_once('../../inc/functions.php'); 
$output = array('data' => array());



$sql = "SELECT  b.id,b.img_name,b.status,b.img_type, 
GROUP_CONCAT(a.url) url, 
GROUP_CONCAT(a.slider_text) slider_text, 
GROUP_CONCAT(a.animation_type) as animation_type, 
GROUP_CONCAT(a.text_position) as text_position
FROM slidder b INNER JOIN slidder_animation a
 ON FIND_IN_SET(b.id, a.slidder_id) > 0
GROUP BY b.id ORDER BY b.id DESC";

$query = $mysqli->query($sql);

$x = 1;

while ($row = $query->fetch_assoc()) {
$type = $row['img_type'];	

    if($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png'){
       $img = '<img src="../assets/uploads/'.$row['img_name'].'"  class="img-fluid img-thumbnail" width="40" height="40">';
    }else {
        $img = '<video controls="" class="img-fluid" width="40" height="40">
        <source src="../assets/uploads/'.$row['img_name'].'" type="'.$type.'">
        Your browser does not support the video tag.
        </video>
        ';
}



//$img = '<img src="../assets/uploads/'.$row['img_name'].'" width="40" height="40"/>';

if($row['status'] == 1){
	$sta = "checked";
}else{
	$sta = "";
}

$btn = '<div class="switch">
            <label>
              <input type="checkbox" '.$sta.' class="slideUpdates" id="'.$row['id'].'" value="'.$row['id'].'">
              <span class="lever"></span>
            </label>
            <a href="#sliderModal" type="button" data-toggle="modal"  class="btn btn-floating waves-effect waves-light red z-depth-4 btn-small  modal-trigger" onclick="removeSlider('.$row['id'].')"> <i class="material-icons left">delete</i>
            </a>	
            <a href="slider_update?id='.$row['id'].'" type="button" class="btn btn-floating waves-effect waves-light green z-depth-4 btn-small"> <i class="material-icons left">edit</i></span>
            </a>	

        </div>';


$output['data'][] = array(
		//$x,
		$btn,
		$img,
		$row['url'],
		$row['slider_text'],
		$row['animation_type'],
		$row['text_position']
);
	//$x++;
}

// database connection close
$mysqli->close();

echo json_encode($output);
?>