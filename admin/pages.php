<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["PAGES"]["CREATE PAGES"]["create"]) || 
authorize($_SESSION["access"]["PAGES"]["CREATE PAGES"]["edit"]) || 
authorize($_SESSION["access"]["PAGES"]["CREATE PAGES"]["view"]) || 
authorize($_SESSION["access"]["PAGES"]["CREATE PAGES"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You dont have the permission to access this page");
}

include("left_nav.php");


?>

    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-blue-grey-blue gradient-shadow"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">note</i> Create Pages</h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-content gradient-shadow">
      <form enctype="multipart/form-data" id="page">
      <div class="row">
    <div class="col m8 s12">
      

                <div class="form-group mb-2">
                 <div class="form-line">
                 <input type="text" name="page_title" id="page_title" class="form-control" value="" placeholder="Page Title" autocomplete="off"  onkeyup="changeAlias();"  />
                 
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
                                    $sql = mysqli_query($mysqli,"SELECT * FROM mp_pages WHERE status = 'active' AND parent = -1 ORDER BY page_title ASC");
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
  <div class="form-line">
  <input type="hidden"  name="page_alias" id="page_alias" class="form-control" value="" placeholder=""  readonly/>
   </div>
</div>  

<div class="form-group mb-2">
  <div class="form-line">
  <input type="text" name="meta_keywords" id="meta_keywords" class="form-control" value="" placeholder="Meta Keywords" autocomplete="off"/>  
  </div>
</div>                                   


 <div class="form-group mb-2">
  <div class="form-line">
  <input type="text" name="meta_desc" id="meta_desc" class="form-control" value="" placeholder="Meta Description" autocomplete="off"   />
    
 </div>
</div>     

<div class="form-group mb-2">
    <label>Publish Status</label>
    <div class="form-line" >
   <select name="status" class="browser-default mselect select">
  <option value="">Status</option>
  <option value="publish">Publish</option>
  <option value="draft">Draft</option>
  <option value="pending">Pend Review</option>
  </select>
   </div>
</div>
    </div>  

    <div class="col m4 s12">

<div class="form-group mb-2">
    
    <input id="tags" type="text" class="form-control" placeholder="Tags" name="tags">
   
</div>

  
<div class="form-group mb-2">
   <label style="font-size: 14px;">Featured Image/Video/Audio</label>
    <div class="form-line">
    <div id="kv-avatar-errors-2" class="center-block" style="width:200px;display:none"></div>
  <div class="kv-avatar center-block" style="width:212px;">
      <input id="avatar-2" name="userImage" type="file" class="file-loading">
  </div>

   </div>
</div>   



    </div> <!--col m3 ends-->
<div class="col s12">
    <div class="form-group form-float mb-2">
  
      
      <textarea name="jobdes"  id="ckeditor" >
        
      </textarea>
    
  

  </div> 
</div>

<div class="col s12 l12 mt-5">
<div align="center">
  <input  type="hidden" class="form-control" name="by" value="<?php echo $email; ?>">                           
  <button type="submit" class="btn btn-primary btn-md" id="btn-submit"><span class="fa fa-plus"></span> &nbsp; Create</button>
</div>
                              
 </div> 

</form>


      </div>

    </div>

                        
</div>
</div>
</div>
</div>
</div>
</div>


<?php include("right_menu.php"); ?>
         
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

  



<?php
include("footer.php");
?>