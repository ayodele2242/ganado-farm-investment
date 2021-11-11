<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["PAGES"]["CREATE PAGES"]["create"]) || 
authorize($_SESSION["access"]["PAGES"]["PAGES LIST"]["edit"]) || 
authorize($_SESSION["access"]["PAGES"]["PAGES LIST"]["view"]) || 
authorize($_SESSION["access"]["PAGES"]["PAGES LIST"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

$id = $_GET['page_id'];

$m = mysqli_query($mysqli, "select * from mp_pages where page_id = '$id'");
$f = mysqli_fetch_array($m);


// upload directories
$upload_dir = '../assets/uploads/'; 
    $video = '../videos/';
    $audio = '../audios/';

$valid_extensions = array('jpeg', 'jpg', 'png'); // image extensions

$aud_extensions = array('mp3'); // audio extensions
$type = $f['img_type'];

include("left_nav.php");


?>

<div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-blue-grey-blue gradient-shadow"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h4 class="mt-0 mb-0 text-white" ><i class="fa fa-edit"></i> Edit <?php echo $f['page_title']; ?></h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
<div class="card-content gradient-shadow">
<form enctype="multipart/form-data" id="pagedit" class="editform row">

  <div class="col m9 s12">
  	
  	<div class="form-group mb-2">
       <div class="form-line">
         <input type="text" name="page_title" id="page_title" class="form-control" value="<?php echo $f['page_title']; ?>" placeholder="Page Title" autocomplete="off"  onkeyup="changeAlias();"  />
         <input type="hidden"  name="page_alias" id="page_alias" class="form-control" value="<?php echo $f['page_alias']; ?>" placeholder=""  readonly/>
       </div>
    </div> 


    <div class="form-group mb-2" >
	    <label>Select Page Link</label>  
	    <select name="plink" class="form-control browser-default mselect select">
	    <?php 
	    echo menu_list();//  functions.php 
	    ?>
	    </select>
	</div> 


                 <div class="form-group mb-2" style="display:none;">
                     <div class="form-line">
                    <label for="post_tags">Post Categories</label>
                 <select name="category" class="browser-default mselect select">
                    <?php
                        $query = mysqli_query($mysqli,"SELECT * FROM categories");
                        $count = mysqli_num_rows($query);
                        if($count < 1){
                            echo '<option value="Uncategorized">Uncategorized</option>';
                        }else{
                        while($row = mysqli_fetch_array($query)) {
                            echo "<option value='".$row['category_id']."'>".$row['category']."</option>";
                        }
                    }
                    ?>
                </select>




	         <select name="parent" class="form-control browser-default mselect select mb-2" id="parent" style="display:none;">
	        <option value="-1">No Parent</option>
	        <?php
	        $sql = mysqli_query($mysqli,"SELECT * FROM mp_pages WHERE parent = -1 ORDER BY page_title ASC");
	        $optionsRs = mysqli_fetch_array($sql);
	        foreach ($optionsRs as $rs) {
	            ?>
	            <option value="<?php echo stripslashes($rs["page_id"]); ?>" <?php echo ($details[0]["parent"] == $rs["page_id"]) ? 'selected="selected"' : ''; ?>  >
	                <?php echo stripslashes($rs["page_title"]); ?>
	            </option>
	            <?php
	        }
	        ?>
	         </select>

	         </div>
	         </div>

<div class="form-group mb-2">
    
    <input id="tags" type="text" class="form-control" placeholder="Tags" name="tags" value="<?php echo $f['post_tags']; ?>">
   
</div>
	          

<div class="form-group mb-2">
   <!--<label style="font-size: 14px;">Featured Image/Video/Audio</label>-->
    <div class="center-block" style="width:200px">
 <div class="stasy">
 <?php
  if($type == 'image/jpeg' || $type == 'image/jpg' || $type == 'image/png'){
    echo '<img src="user_images/'.$f['img'].'" width="200" height="150" >';
}else if($type == 'video/mp4' || $type == 'video/avi' || $type == 'video/wav' || $type == 'video/3gp' || $type == 'video/AAC'
|| $type == 'video/flv' || $type == 'video/wmv'){
    echo '<video width="200" height="150" controls="">
    <source src="videos/'.$f['img'].'" type="'.$type.'">
    Your browser does not support the video tag.
    </video>
    ';
}elseif($type == 'audio/mp3'){
 echo '<audio id="audio" autoplay controls src="audios/'.$f['img'].'" type="'.$type.'"></audio>';
}

 ?>
 </div>
</div>   
</div>

    </div><!--col m9-->

  <div class="col m3 s12">


<div class="form-group mb-2">
  <div class="form-line">
  <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" value="<?php echo $f['meta_keywords']; ?>" placeholder="Meta Keywords" autocomplete="off"/>  
  </div>
</div> 
<div class="form-group mb-2">
  <div class="form-line">
  <input type="text" name="meta_desc" id="meta_desc" class="form-control" value="<?php echo $f['meta_desc']; ?>" placeholder="Meta Description" autocomplete="off"   />
    
 </div>
</div>

<div class="form-group mb-2">
    <label>Publish Status</label>
    <div class="form-line" >
   <select name="status" class="browser-default mselect select">
   <option value="draft" <?php echo ($f["status"] == 'draft') ? 'selected="selected"' : ''; ?>  >
                            <?php if($f["status"] == 'draft'){ echo 'Drafted';}else{ echo 'Draft'; }?>
                                        </option>
                            <option value="publish" <?php echo ($f["status"] == 'publish') ? 'selected="selected"' : ''; ?>  >
                            <?php if($f["status"] == 'publish'){ echo 'Published';}else{ echo 'Publish'; }?> 
                                        </option>  
                            <option value="pending" <?php echo ($f["status"] == 'pending') ? 'selected="selected"' : ''; ?>  >
                            <?php if($f["status"] == 'pending'){ echo 'Pending Review';}else{ echo 'Pend Review'; }?> 
                           
                                        </option>                      

  </select>
   </div>
</div>

<div class="form-line">
                            <div id="kv-avatar-errors-2" class="center-block" style="width:200px;display:none"></div>
                            <div class="kv-avatar center-block" style="width:200px">
                                <input id="avatar-2" name="userImage" type="file" class="file-loading">
                            </div>
                            <input name="hidImg" class="rid3" type="hidden" value="<?php echo $f['img']; ?>">
                       </div>


  </div><!--col m3 ends-->

  <div class="col s12">

<div class="form-group mb-1">
<textarea name="jobdes"  id="editor" class="form-control">
  <?php echo $f['page_desc']; ?>
</textarea>
</div> 


<div class="form-group" align="center">
                                <input type="hidden" class="form-control" name="pid" value="<?php echo $f['page_id']; ?>">
                                                           
                                <button type="submit" class="btn btn-primary btn-md" id="btn-submit">Update</button>
                            </div>     
</div><!--col s12 ends-->


</form>
</div>
</div>
</div>
</div>
<?php include("right_menu.php"); ?>   
</div>
</div>
   	













<?php
include("footer.php");
?>