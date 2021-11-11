<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["SETTINGS"]["WEBSITE DETAILS"]["create"]) || 
authorize($_SESSION["access"]["SETTINGS"]["WEBSITE DETAILS"]["edit"]) || 
authorize($_SESSION["access"]["SETTINGS"]["WEBSITE DETAILS"]["view"]) || 
authorize($_SESSION["access"]["SETTINGS"]["WEBSITE DETAILS"]["delete"]) ) {
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
                <h5 class="mt-0 mb-0 text-white" ><i class="material-icons">settings</i> Website Settings</h5>
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
                    <ul class="stepper horizontal" id="horizStepper">
                        <li class="step active">
                         
                            <div class="step-title waves-effect">Website Info</div>
                            <div class="step-content">

                               <div class="row">

                                <div class="col m3 s12">Update Website Logo</div>
                                 <div class="col m4 s12 myimg">
                                  <?php
                                  if(empty($set['logo'])){
                                  ?>
                                  <img src="../assets/logo/avatar.png" class="img responsive-img">
                                <?php }else{
                                  ?>
                                  <img id="profile_pics"  data-holder-rendered="true" src="<?php echo $set['installUrl']; ?>assets/logo/<?php echo $set['logo']; ?>" class="img">
                                  <?php
                                 }
                                 ?>
                                 </div>
                                 <div class="col m5 s12 left-ibtn">
                                 <a class="waves-effect waves-light btn btn-small cyan darken-2 modal-trigger mb-2 mr-1" href="#modal1">
                                <span class="glyphicon glyphicon-camera"></span> Click to Update Logo
                                </a> 
                                 </div>

                               </div>

                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="firstName"><?php echo $installURLField; ?> <span class="red-text">*</span></label>
                                        <input type="text" name="installUrl" id="installUrl" class="validate" placeholder="https//your_website.com/"  value="<?php echo clean($set['installUrl']); ?>"
                                            aria-required="true" required="" required>
                                            <span class="help-block"><?php echo $installURLHelp; ?> e.g https://your_website.com/</span> 
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="lastName">Website Name: <span class="red-text">*</span></label>
                                        <input type="text" id="storeName" name="storeName" value="<?php echo clean($set['storeName']); ?>" class="validate" aria-required="true" name="lastName" required="" required>
                                        <span class="help-block"><?php echo $siteNameHelp; ?></span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="Email"><?php echo $siteEmailField; ?><span class="red-text">*</span></label>
                                        <input type="email" class="validate" name="Email" value="<?php echo clean($set['Email']); ?>" id="Email" required=""
                                            required>
                                            <span class="help-block"><?php echo $siteEmailHelp; ?></span>
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="contactNum">Contact Number: <span class="red-text">*</span></label>
                                        <input type="text" class="validate" name="contactNum" value="<?php echo clean($set['contactNum']); ?>" id="contactNum"
                                            required="" required>
                                            <span class="help-block">For multiple phone numbers use comma e.g. xxx-xxxx-xxx, xxx-xxx-xxxxx</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                    <select id="mcountry" name="country">
                                      <option value="">Select Country</option>
                                    <?php echo getCountry(); ?>
                                    </select>
                                     <label>Country</label>
                                    </div>
                                    <div class="input-field col m6 s12">
                                       
                                       <select id="mstates" class="browser-default mselect" name="state">
                                         
                                       </select>
                                         <input type="hidden" name="mstate" value="<?php echo clean($set['state']); ?>">
                                    </div>
                                </div>

                                  <div class="row">
                                    <div class="input-field col m12 s12">
                                  <label>Office Location</label>
                                  <input type="text" required name="address" value="<?php echo clean($set['address']); ?>" />
                                    </div>
                                   
                                </div>


                                <div class="step-actions">
                                    <div class="row">

                                        <!--<div class="col m6 s12 mb-1">
                                            <button class="btn btn-light btn-small previous-step" disabled>
                                                <i class="material-icons left">arrow_back</i>
                                                Prev
                                            </button>
                                        </div>-->
                                        <div class="col m6 s12 mb-1">
                                            <button class="waves-effect gradient-45deg-purple-deep-orange waves dark btn btn-small btn-primary next-step"
                                                type="submit">
                                                Next
                                                <i class="material-icons right">arrow_forward</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="step">
                            <div class="step-title waves-effect">SEO</div>
                            <div class="step-content">
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="description">description</label>
                                        <textarea name="descr" id="desc" rows="4" class="materialize-textarea">
                                          <?php echo clean($set['descr']); ?>
                                        </textarea>
                                        <span class="help-block">Website description for SEO. e.g. little details about your store(slogan, motto, etc) </span>
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="job">Keywords </label>
                                        <input type="text" class="" id="keywords" name="keywords" value="<?php echo clean($set['keywords']); ?>">
                                        <span class="help-block">Word(s) that can easily be used by SE to find your site separated by comma</span>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col m12 s12">
                                        <label for="company">Author</label>
                                        <input type="text" class="" id="author" name="author" value="<?php echo clean($set['author']); ?>">
                                    </div>
                                   
                                </div>
                               
                                <div class="step-actions">
                                    <div class="row">
                                        <!--<div class="col m4 s12 mb-3">
                                            <button class="red btn btn-reset" type="reset">
                                                <i class="material-icons left">clear</i>Reset
                                            </button>
                                        </div>-->
                                        <div class="col m6 s12 mb-1">
                                            <button class="btn btn-light previous-step">
                                                <i class="material-icons left">arrow_back</i>
                                                Prev
                                            </button>
                                        </div>



                                        <div class="col m6 s12 mb-1">
                                            <button class="waves-effect gradient-45deg-purple-deep-orange waves dark btn btn-primary next-step"
                                                type="submit">
                                                Next
                                                <i class="material-icons right">arrow_forward</i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="step">
                            <div class="step-title waves-effect">Social Networks</div>
                            <div class="step-content">
                              <div class="row">
                             <div class="col s12">
                            <div class="card-panel light-blue lighten-2 white-text">
                              <i class="material-icons">help_outline</i>  When adding social handles, just type in the name only without url e.g. <strong>mystore not https://www.facebook.com/mystore</strong>
                            </div> 
                          </div>
                              </div>
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="eventName">Facebook</label>
                                        <input type="text" class="facebook" id="facebook" name="facebook" value="<?php echo clean($set['facebook']); ?>">
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="eventName">Twitter</label>
                                        <input type="text" class="twitter" id="twitter" name="twitter" value="<?php echo clean($set['twitter']); ?>">

                                    </div>
                                </div>
                                <div class="row">
                                   
                                    <div class="input-field col m6 s12">
                                        <label for="eventName">Instagram</label>
                                        <input type="text" class="instagram" id="instagram" name="instagram" value="<?php echo clean($set['instagram']); ?>">

                                    </div>
                                    
                                     
                                    <div class="input-field col m6 s12">
                                         <label for="eventName">Youtube</label>
                                        <input type="text" class="youtube" id="youtube" name="youtube" value="<?php echo clean($set['youtube']); ?>">

                                     </div>
                                    
                                </div>
                                 <div class="row">
                                  <div class="col m12 s12">
                                  <div id="result"></div>
                                 </div>
                               </div>
                                
                                <div class="step-actions">
                                    <div class="row">
                                       
                                         <div class="col m6 s12 mb-1">
                                            <button class="btn btn-light btn-small previous-step">
                                                <i class="material-icons left">arrow_back</i>
                                                Prev
                                            </button>
                                        </div>
                                        <div class="col m6 s12 mb-1">
                                        <?php if (authorize($_SESSION["access"]["SETTINGS"]["WEBSITE DETAILS"]["edit"])) { ?>
                                          <button type="input" name="submit" value="editSettings" class="waves-effect waves-dark btn btn-primary btn-small ibtn" id="updateStoreForm"><i class="material-icons">edit</i> <?php echo $saveChangesBtn; ?>
                                           </button>
                                        <?php } ?>
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
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