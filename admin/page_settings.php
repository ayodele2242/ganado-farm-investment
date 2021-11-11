
<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["SETTINGS"]["PAGE SETTINGS"]["create"]) || 
authorize($_SESSION["access"]["SETTINGS"]["PAGE SETTINGS"]["edit"]) || 
authorize($_SESSION["access"]["SETTINGS"]["PAGE SETTINGS"]["view"]) || 
authorize($_SESSION["access"]["SETTINGS"]["PAGE SETTINGS"]["delete"]) ) {
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
        <div class="content-wrapper-before unique-color-dark gradient-shadow"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                <h5 class="mt-0 mb-0 text-white" ><i class="fa fa-build"></i> Front-End Settings</h5>
              </div>
              
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-content">
            
    <div class="row">
        <div class="col s12">
            <form  class="form-horizontal" id="editSetting" >

              <div class="row">
<div class="col s12 mb-3"><h5>Top Header Settings</h5><hr></div>
<div class="row mb-2">
              <div class="col m3 s12">
                Background Color
              </div>

              <div class="col m7 s12">
                <input type='color' class='basic' value='#f594d0' name="top_header_bgrd_color" />
              </div> 

</div>
<div class="row mb-2">
              <div class="col m3 s12">
                Text Color
              </div>

              <div class="col m7 s12">
                <input type='color' class='basic' value='#ffffff' name="top_header_text_color"/>
              </div>
</div>
<div class="row mb-2">
              <div class="col m3 s12">
                Link Color
              </div>

              <div class="col m7 s12">
                <input type='color' class='basic' value='#f0f0f0' name="top_header_link_color"/>
              </div>  
</div>
<div class="row mb-2">
              <div class="col m3 s12">
                Text Hover Color
              </div>

              <div class="col m7 s12">
                <input type='color' class='basic' value='#ffffff' name="top_header_text_hover_color"/>
              </div>
</div>
<div class="row mb-2">
              <div class="col m3 s12">
                Text Active Color
              </div>

              <div class="col m7 s12">
                <input type='color' class='basic' value='#ffffff' name="top_header_text_active_color"/>
              </div>
</div>

            </div>




              </div>
           
            <div class="row">

  <div class="col s12 mb-3"><h5>Header Settings</h5><hr></div>        
<div class="row mb-2">
              <div class="col m3 s12">
                Header Background Color
              </div>

              <div class="col m7 s12">
                <input type='color' class='basic' value='#f594d0' name="header_bgrd_color" />
              </div> 

</div>
<div class="row mb-2">
              <div class="col m3 s12">
                Header Text Color
              </div>

              <div class="col m7 s12">
                <input type='color' class='basic' value='#ffffff' name="header_text_color"/>
              </div>
</div>
<div class="row mb-2">
              <div class="col m3 s12">
                Header Link Color
              </div>

              <div class="col m7 s12">
                <input type='color' class='basic' value='#f0f0f0' name="header_link_color"/>
              </div>  
</div>
<div class="row mb-2">
              <div class="col m3 s12">
                Header Text Hover Color
              </div>

              <div class="col m7 s12">
                <input type='color' class='basic' value='#ffffff' name="header_text_hover_color"/>
              </div>
</div>
<div class="row mb-2">
              <div class="col m3 s12">
                Header Text Active Color
              </div>

              <div class="col m7 s12">
                <input type='color' class='basic' value='#ffffff' name="header_text_active_color"/>
              </div>
</div>

            </div>










            <div class="row mt-2 mt-2">
               <div class="col s12 mb-3"><h5>Footer Settings</h5><hr></div>
              <div class="col m3 s12">
                footer Background Color
              </div>

              <div class="col m7 s12">
                <input type='color' class='showAlpha' id="showAlpha" value='#f594d0' />
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

  
                <div id="modal1" class="modal">
                  <div class="modal-content">

                  <div id="body-overlay"><div><img src="../assets/img/loading.gif" width="64px" height="64px"/></div></div>
                  <div class="">Click on <img src="../assets/img/photo.png"  class="responsive-img" height="30" width="30" /> on the image below to see menu for uploading your image.
                   </div> 
                  <div id="error"></div>
                  <div class="bgColor">

                  <form id="uploadForm"  method="post">
                     <div id="targetOuter">
                      <div id="targetLayer"><?php if (file_exists("../assets/img/cart.png")){?><img src="../assets/img/cart.png" width="200px" height="200px" class="upload-preview" /><?php }?></div>
                      <img src="../assets/img/photo.png"  class="icon-choose-image"/>
                      <div class="icon-choose-image" onClick="showUploadOption()"></div>
                      <div id="profile-upload-option" class="pink darken-4">
                        <div class="profile-upload-option-list"><input name="userImage" id="userImage" type="file" class="inputFile" onChange="showPreview(this);"></input><span>Upload</span></div>
                        <div class="profile-upload-option-list" onClick="removeProfilePhoto();">Remove</div>
                        <div class="profile-upload-option-list" onClick="hideUploadOption();">Cancel</div>
                      </div>
                    </div>  
                    <div>
                      <div align="center">
                    <input type="submit" value="Update Photo" class="btn btn-small teal darken-4 btn-submit" onClick="hideUploadOption();"/>
                  </div>
                    </div>
                  </form>
                </div>  

                  </div>
                  <div class="modal-footer">
                    <a href="#!" class="modal-action modal-close waves-effect waves-red btn-flat ">Close</a>
                    
                  </div>
                </div>

    
 

<?php
include("footer.php");
?>