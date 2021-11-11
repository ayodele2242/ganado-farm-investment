<?php
include("header.php");
include("header_bottom.php");
include("left_nav.php");
?>


    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-deep-purple-blue gradient-shadow"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s10 m6 l6">
                 <h5 class="mt-0 mb-0 text-white p-5"><i class="material-icons">attach_money</i> Currency Options</h5>
              </div>
              
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
 
      <div class="card-content">
        <p>
The following options affect how prices are displayed on the frontend of your store.

  </p>     
    <form id="currencyupdateForm" class="refresh">
      <div class="col s12">
      
        <div class="card-contents">
        
            <div class="row">
               <div class="input-field col s12 m2">
                <label for="currency">Currency</label>
              </div>
              <div class="input-field col s12 m7">
                <select id="currency" class="browser-default mselect" name="currency">
                  <?php echo currency(); ?>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s12 m2">
                <label for="currency">Currency Position</label>
              </div>
              <div class="input-field col s12 m7">
                <select id="currency_position" class="browser-default mselect" name="currency_position">
                  <option value="left" <?php if($cpost == "left"){ echo "selected";} ?>>Left</option>
                  <option value="right" <?php if($cpost == "right"){ echo "selected";} ?>>Right</option>
                  <option value="left-space" <?php if($cpost == "left-space"){ echo "selected";} ?>>Left with a space</option>
                   <option value="right-space" <?php if($cpost == "right-space"){ echo "selected";} ?>>Right with a space</option>
                </select>
              </div>
            </div>


              <div class="row">
                <div class="input-field col s12">
                <button class="btn cyan waves-effect waves-light right" type="submit" id="updateCurrency">Update</button>
               
              </div>
            </div>
          </form>
        
                        
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