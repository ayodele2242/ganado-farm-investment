<?php
include("header.php");
include("header_bottom.php");

$status = FALSE;
if ( authorize($_SESSION["access"]["USER"]["ADD USER"]["create"]) || 
authorize($_SESSION["access"]["USER"]["ADD USER"]["edit"]) || 
authorize($_SESSION["access"]["USER"]["ADD USER"]["view"]) || 
authorize($_SESSION["access"]["USER"]["ADD USER"]["delete"]) ) {
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
               <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">person_add</i> Add User</h4>
              </div>
              
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->

            
    <!-- Horizontal Stepper -->

    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content pb-0">
                    <form name="add_user" id="addUserForm">  
                    <ul class="stepper horizontal" id="horizStepper">
                        <li class="step active">
                            <div class="step-title waves-effect">User Personal Information</div>
                            <div class="step-content">
                                <div class="row">
                                    <div class="input-field col m12 s12">
                                        <label for="firstName">Full Name: <span class="red-text">*</span></label>
                                        <input type="text" id="name" name="name" class="validate name"
                                            aria-required="true" required="" required>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="Email">Email:</label>
                                        <input type="email"  name="Email" id="Email">
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="contactNum">Contact Number: </label>
                                        <input type="text" name="contactNum" id="contactNum">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="input-field col m6 s12">
                                        <label for="Email">Username: <span class="red-text">*</span></label>
                                        <input type="text" class="validate username" name="username" id="username" required=""
                                            required>
                                    </div>
                                    <div class="input-field col m6 s12">
                                        <label for="contactNum">Password: <span class="red-text">*</span></label>
                                        <input type="password" class="validate password" name="password" id="password"
                                            required="" required>
                                    </div>
                                </div>

                                <div class="row">
                                   <div class="input-field col m6 s12">
                                    <select name="urole" class="browser-default mselect select role">
                                      <option value="">Select User Role</option>
                                      <?php
                                      echo roles();
                                      ?>
                                    </select>

                                   </div>
                                    <div class="input-field col m6 s12">
                                      <select name="status" class="browser-default mselect select status">
                                      <option value="" disabled selected>Account Status</option>
                                      <option value="active">Active</option>
                                      <option value="inactive">Inactive</option>
                                     
                                    </select>
                                  
                                    </div>
                                   
                                </div>

                                <div class="step-actions">
                                    <div class="row">
                                        
                                        <div class="col m12 s12 mb-3">
                                            <button class="waves-effect gradient-45deg-purple-deep-orange waves dark btn  btn-small next-step"
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
                            <div class="step-title waves-effect">Privileges</div>
                            <div class="step-content">
                                <div class="row" >

                                    <div class="col m12 s12 table-responsive form-fields">
                                
                                        <table role="table" class="table_view rowfy" id="user_table"> 
                                         <tbody role="rowgroup">
                                        <tr id="template" role="row"> 
                                         
                                          <td role="cell">
                                            <select name="module[]" class="browser-default mselect select module">
                                             <option value="" class="validate" disabled selected>Select User Menu Module</option>  
                                          <?php echo modules(); ?>
                                          </select>
                                        </td>
                                        <td role="cell">
                                      <select name="create[]" class="browser-default mselect select create">
                                      <option value="" class="validate" disabled selected>Create</option>
                                      <option>No</option>
                                      <option>Yes</option>
                                      </select>
                                      </td>
                                      <td role="cell">
                                      <select name="edit[]" class="browser-default mselect select edit">
                                      <option value="" class="validate" disabled selected>Edit</option>
                                     <option>No</option>
                                      <option>Yes</option>
                                      </select>
                                      </td>
                                      <td role="cell">
                                       <select name="delete[]" class="browser-default mselect select delete">
                                      <option value=""  disabled selected>Delete</option>
                                      <option>No</option>
                                      <option >Yes</option>
                                      </select>
                                      </td>
                                      <td role="cell">
                                       <select name="view[]" class="browser-default mselect select view">
                                      <option value=""  disabled selected>View</option>
                                      <option>No</option>
                                      <option >Yes</option>
                                      </select>

                                      </td>
                                     
                                     </tr>
                                   </tbody>
                                        </table>  


                                    </div> 
                                </div>
                               
                                
                                <div class="row">
                                   <div class="col m4 s4 mb-3 mb">
                                        <button class="btn btn-light previous-step">
                                  <i class="material-icons left">arrow_back</i>
                                                Prev
                                  </button>
                                        </div>

                                         <div class="col m4 s4 mb-3 mb">
                                           <button id="add-line" class="btn btn-floating addme waves-effect waves-light green" type="button" ><i class="material-icons left">add</i></button>

                                         </div>
                                   
                                          <div class="col m4 s4 mb-3 mb">
                                            <button class="waves-effect waves dark btn btn-primary" id="submitUser"
                                                type="submit">
                                               Submit
                                               
                                          </button> 
                                    
                                         </div>
                                        
                                        <div id="result" class="col m12 s12 mb-3"></div>

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

  

    
 

<?php
include("footer.php");
?>