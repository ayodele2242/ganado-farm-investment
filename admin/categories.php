<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["MENU CATEGORIES"]["CREATE MENU"]["create"]) || 
authorize($_SESSION["access"]["MENU CATEGORIES"]["CREATE MENU"]["edit"]) || 
authorize($_SESSION["access"]["MENU CATEGORIES"]["CREATE MENU"]["view"]) || 
authorize($_SESSION["access"]["MENU CATEGORIES"]["CREATE MENU"]["delete"]) ) {
 $status = TRUE;
}

if ($status === FALSE) {
die("You do not have the permission to access this page");
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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">dehaze</i> CREATE MENU</h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-content gradient-shadow">
            
    <div class="row">
      
<div class="col m5">
  <div id="message" class="removeMessages"></div>
<form autocomplete="off" id="menuform" class="">
                <div class="form-group mb-2">
                    <label>Menu Name</label>
                <input type="text" name="name"  required="required" class="form-control">
                </div>

                <div class="form-group stas mb-2" >
                  <label>Parent</label>  
                <select name="parent" class="browser-default  mselect">
                        <option value="0">No Parent</option>
                        <?php 
                        echo cat_list();//  functions.php 
                        ?>
                        </select>
                </div>

                <div class="form-group mb-2">
                <label>Position</label>
                <input type="number" name="position"  class="form-control">
                </div>

                <div class="form-group mb-2">
                <label>Status</label>
                <select name="status" class="browser-default  mselect" required="required">
                         <option value="">Select Menu Status</option>
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                        </select>
                </div>
                <div class="form-group mb-5">
                <div align="center">
                  <?php if (authorize($_SESSION["access"]["MENU CATEGORIES"]["CREATE MENU"]["create"])) { ?>
                <button type="submit" class="btn btn-md btn-info insertButton" id="btn-submit"><i class="fa fa-plus"></i> Add Menu</button>
                <?php } ?>
                </div>
                </div>

                </form>
      </div>
      <div class="col m7 s12">

       <table id="menuTable" class="table table_view">
                    <thead class="heading">
                      <tr>
                        <th>#No</th>
                        <th>Parent ID</th>
                        <th>Menu Name</th>
                        <th>Link</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    
                  </table>
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

  
<!-- remove modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="menuModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title"><span class="glyphicon glyphicon-trash"></span> Delete</h4>
        </div>
        <div class="modal-body">
          <p >Do you really want to delete it?</p>
          <div class="removeMessages"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn default modal-close" data-dismiss="modal">Close</button>
          <button type="button" class="btn red btn-small" id="removeBtn"><i class="material-icons left">delete</i> Delete</button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- /remove modal -->

  <!-- remove modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="menuactivateModal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
      
        <div class="modal-body">
          <div align="center">
          <div class="switch">
            <label>
              De-activated
              <input type="checkbox" <?php echo $mactive; ?> class="menuDetails" id="activateBtn">
              <span class="lever"></span>
            </label>
            Activated
           </div>
         </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn default modal-close" data-dismiss="modal">Close</button>
         
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->
  <!-- /remove modal -->

<?php
include("footer.php");
?>

