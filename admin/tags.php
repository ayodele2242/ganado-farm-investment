<form  method="post" action="">
            <div class="row">
                <label>Tag:</label>
				<input class="form-control auto" type="text" id="tag" /> <br>
                <div class="btn btn-default" id="addTag">Add Tag</div>
                <div class="clearfix"></div><br>
                    <div class="tagForm">
                        <ul id="tagList">
                            <?php 
                            include('../inc/config.php'); 
                            $tags = mysqli_query($mysqli,"SELECT * FROM tags");
                                if(mysqli_num_rows($tags) > 0) {
                                    while($tag = mysqli_fetch_array($tags)) {
                                        
                                        echo '<li class="tag" id="id_'.$tag['id'].'"> '.$tag['tag'].' <button class="deleteTagExsit btn-warning" id="id_'.$tag['id'].'">X</button></li>';
                                        
                                    } 
                                }?>         
                        </ul>
                    </div>
                <div class="buttons-box clearfix">
                    <input class="btn btn-info btn-lg pull-right" type="submit" value="Save" name="save">
                </div>
            </div>
		  </form>
          
            <?php if (isset($_POST['save'])) {
                    if(!empty($_POST['multiTag'])) {
                        foreach ($_POST['multiTag'] as $key=>$tag) {
      
                        $tag = mysqli_real_escape_string($mysqli,$tag); 
                        echo "Tag(s): ".$tag.", ";
                
                        $upTags = "INSERT INTO tags (tag) VALUES ('$tag')";
                        if ($mysqli->query($upTags) === TRUE) echo "added to DB";
                        header("Refresh:1");
                    }
                }
            }?>