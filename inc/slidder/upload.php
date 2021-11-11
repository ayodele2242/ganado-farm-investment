<?php 
include('../config.php');

//if (isset($_FILES["userImage"]["name"])) {
//Image 0ne
        $imgFile = $_FILES['userImage']['name'];
		$tmp_dir = $_FILES['userImage']['tmp_name'];
        $imgSize = $_FILES['userImage']['size'];
        $imgType = $_FILES['userImage']['type'];
      

        $upload_dir = '../../assets/uploads/'; // upload directory


 		$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
		// valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png'); // image extensions
        $vid_extensions = array('avi', 'mp4', 'wav','3gp','AAC','flv','wmv'); // video extensions
        $aud_extensions = array('mp3'); // audio extensions

        // rename uploading image
        $userpic = rand(1000,1000000).".".$imgExt;
        if(!empty($imgFile)){
        $pic = $userpic;
        }else{
         $pic = '';
        }


        if(!empty($imgFile) && in_array($imgExt, $valid_extensions)){
                move_uploaded_file($tmp_dir,$upload_dir.$pic);
        }
        if(!empty($imgFile) && in_array($imgExt, $vid_extensions)){
            move_uploaded_file($tmp_dir,$upload_dir.$pic);
        }
        if(!empty($imgFile) && in_array($imgExt, $aud_extensions)){
            move_uploaded_file($tmp_dir,$upload_dir.$pic);
        }


        // insert into database
				$sql = "INSERT INTO slidder (img_name,img_type) VALUES ('$pic','$imgType')";

				
				if ($mysqli->query($sql) === TRUE) {

					$last_id = $mysqli->insert_id;

				 if(!empty($_POST['slider_text'])){

					$rowCount = count($_POST['slider_text']);

					for($i = 0; $i < $rowCount; $i++)
					 { 		
					$stext 	  = $mysqli->real_escape_string($_POST['slider_text'][$i]);	
					$atype    = $_POST['animation_type'][$i];
					$position = $_POST['text_position'][$i];
					$desc     = $mysqli->real_escape_string($_POST['descr'][$i]); 
					$url 	  = $mysqli->real_escape_string($_POST['url'][$i]); 
					/*if($url == ""){
					$urlf = "";
					}else{
					$urlf = $url;
					}*/

					                $sql = "INSERT INTO slidder_animation(slidder_id,slider_text,descr,animation_type,	text_position,url) 
					                VALUES('$last_id', '$stext','$desc','$atype','$position', '$url')";

					              $suc =  mysqli_query($mysqli, $sql);  
					            
					 }
					 if( $suc){
				 	echo "saved";
				 }else{
				 	echo $mysqli->error;
				 }
				 }

				 


					
				} 
				else {
				echo "Query could not execute.! " . $mysqli->error;
				}


//}

?>