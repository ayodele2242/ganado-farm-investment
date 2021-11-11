<?php
    include "../functions.php";
    
    /*$t = date("Y-m-d H:i:s");
	$tv = time(); 
	$id = $_SESSION['id'];
	$fullname = $_SESSION['fname'] ;
	$uname = $_SESSION['uname'];*/

	
    $title = $mysqli->real_escape_string($_POST['page_title']);
    $c = $mysqli->real_escape_string(clean($_POST['jobdes']));
	$present = $mysqli->real_escape_string($_POST['parent']); 
    $alias = $mysqli->real_escape_string($_POST['page_alias']);
    $mk = $mysqli->real_escape_string($_POST['meta_keywords']);
    $md = $mysqli->real_escape_string($_POST['meta_desc']);
    $sta = $mysqli->real_escape_string($_POST['status']);
    $cat = $mysqli->real_escape_string($_POST['category']);
    $tag = $mysqli->real_escape_string($_POST['tags']);
    $link = $mysqli->real_escape_string($_POST['plink']);
    $time = time();

    $by = $_POST['by'];
    
    $postedon = date('Y-m-d H:i');

    $upload_dir = '../../assets/images/'; // upload directory
    $video = '../../assets/videos/';
    $audio = '../../assets/audios/';
    
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
            }else{
                $pic = '';
            }
            
           if(!empty($imgFile) && in_array($imgExt, $valid_extensions)){
                move_uploaded_file($tmp_dir,$upload_dir.$pic);
            }
            if(!empty($imgFile) && in_array($imgExt, $vid_extensions)){
                move_uploaded_file($tmp_dir,$video.$pic);
            }
            if(!empty($imgFile) && in_array($imgExt, $aud_extensions)){
                move_uploaded_file($tmp_dir,$audio.$pic);
            }

    

	$sql2 = "SELECT page_title, page_desc FROM mp_pages WHERE  page_title  = '$title' AND page_desc = '$c'";
    $result = mysqli_query($mysqli, $sql2) or die($mysqli->error);
    $count = mysqli_num_rows($result);
    if ($count == 0) {
    	$sql = "INSERT INTO mp_pages 
		(posted_by, nav_id, page_title, page_desc, meta_keywords, meta_desc, parent, status, page_alias,post_category,post_tags, img,img_type, pdate, ptime) 
		values('$by','$link','$title', '$c', '$mk', '$md', '$present', '$sta','$alias','$cat','$tag','$pic', '$imgType', '$postedon', '$time')";
    $insert = mysqli_query($mysqli, $sql);
    
    if($insert){
    echo "added"; 

    /*mysqli_query($mysqli, "insert into user_log (username,name,action,time, user_id, mydate, mtime)values('$uname','$fullname','Created page title ($title)', '$tv', '$id', '$t', '$tv')");*/
   
    }
    else{
        echo $mysqli->error;
    }

    }else{
    	 echo "1";
    }
?>