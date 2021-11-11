<?php
    include "../functions.php";
    
   
	$id = $_POST['pid'];
    $title = $mysqli->real_escape_string($_POST['page_title']);
    $c = $mysqli->real_escape_string(clean($_POST['jobdes']));
	$present = $mysqli->real_escape_string($_POST['parent']); 
    $alias = $mysqli->real_escape_string($_POST['page_alias']);
    $mk = $mysqli->real_escape_string($_POST['meta_keywords']);
    $md = $mysqli->real_escape_string($_POST['meta_desc']);
    $sta = $mysqli->real_escape_string($_POST['status']);
    $cat = $mysqli->real_escape_string($_POST['category']);
    $tag = $mysqli->real_escape_string($_POST['tags']);
    
    $photoid = $mysqli->real_escape_string($_POST['hidImg']);
    $link = $mysqli->real_escape_string($_POST['plink']);
    $time = time();
    
    $postedon = date('Y-m-d H:i');

    $upload_dir = '../../assets/images/'; // upload directory
    $video = '../videos/';
    $audio = '../audios/';
    
    //Image 0ne
        $imgFile = $_FILES['userImage']['name'];
		$tmp_dir = $_FILES['userImage']['tmp_name'];
        $imgSize = $_FILES['userImage']['size'];
        $imgType = $_FILES['userImage']['type'];
        


        $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
		
			// valid image extensions
            $valid_extensions = array('jpeg', 'jpg', 'png'); // image extensions
            $vid_extensions = array('avi', 'mp4', 'wav','3gp','AAC','flv','wmv'); // video extensions
            $aud_extensions = array('mp3'); // audio extensions
            
            
            
		
			// rename uploading image
            $userpic = rand(1000,1000000).".".$imgExt;
            if(!empty($imgFile)){
                $pic = $userpic;
                }else if(empty($imgFile) && $photoid != ''){
                $pic  = $photoid;
                }
                else if(!empty($imgFile) && $photoid == ''){
                    $pic  = $photoid;
                    }
                else{
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

    
  
    	$sql = "UPDATE mp_pages SET nav_id='$link', page_title = '$title', page_desc = '$c', meta_keywords='$mk', meta_desc='$md', parent='$present', 
        status='$sta', page_alias='$alias', post_category = '$cat',post_tags='$tag', img='$pic',img_type='$imgType', pdate='$postedon', ptime='$time' 
        WHERE page_id='$id'";
        $update = mysqli_query($mysqli, $sql);
        
        if($update){
        echo "updated"; 

       /* mysqli_query($mysqli, "insert into user_log (username,name,action,time, user_id, mydate, mtime)values('$uname','$fullname','Edited page title ($title)', '$tv', '$id', '$t', '$tv')");*/
    
        }
        else{
            echo $mysqli->error;
        }

    
?>