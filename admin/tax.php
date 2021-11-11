
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
                 <h5 class="mt-0 mb-0 text-white p-5"><i class="fa fa-percent"></i> Tax</h5>
              </div>
              
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="cards">
 
      <div class="card-contents">
        <p class="text-white">
            The following options affect how prices are displayed on the frontend of your store.
        </p>     
   
      <main>

  <input id="tab1" type="radio" name="tabs" checked>
  <label for="tab1">Settings</label>

  <input id="tab2" type="radio" name="tabs">
  <label for="tab2">Tax</label>

 <!-- <input id="tab3" type="radio" name="tabs">
  <label for="tab3">Add more tabs</label>

  <input id="tab4" type="radio" name="tabs">
  <label for="tab4">Add more tabs</label>-->

  <section id="content1">
    <div class="row">
               <div class="input-field col s12 m2">
                <label for="currency">Enable taxes</label>
              </div>
              <div class="input-field col s12 m7">
                   <div class="switch left">
                      <label>
                        No
                        <input type="checkbox" <?php echo $tex_active; ?> id="tax_status" value="tax_status" name="tax_status">
                        <span class="lever"></span>
                        Yes
                      </label>
                    </div>

              </div>
              <span class="help-block">Rates will be configurable and taxes will be calculated during checkout.</span> 
            </div>

            <div class="row">
               <div class="input-field col s12 m2">
                <label for="currency">Enable coupons </label>
              </div>
              <div class="input-field col s12 m7">
                   <div class="switch left">
                      <label>
                        No
                        <input type="checkbox" <?php echo $tex_active; ?> id="coupon_status" value="coupon_status" name="coupon_status">
                        <span class="lever"></span>
                        Yes
                      </label>
                    </div>

              </div>
              <span class="help-block">Coupons can be applied from the cart and checkout pages.</span> 
            </div>

            


              <div class="row">
                <div class="input-field col s12">
                <button class="btn cyan waves-effect waves-light right" type="submit" id="updateCurrency">Update</button>
               
              </div>
      </div>
  </section>

  <section id="content2">
     <form id="taxForm" class="form-fields">

 

    <table id="tableTax" class="table mtable">
                        <thead class="thead-light">
                            <tr id="th">
                               
                                <th scope="col">Country Code</th>
                                <th scope="col">State Code</th>
                                <th scope="col">Postcode / Zip</th>
                                <th scope="col">City</th>
                                <th scope="col">Rate %</th>
                                <th scope="col">Tax Name</th>
                                <th scope="col">Priority</th>
                               <th scope="col">Compound</th>
                                <th scope="col">Shipping</th>

                            </tr>
                        </thead>


                        
                     
                    </table>
                  
                           
                </form>
     <div class="btn-container">
        <a href="#tax-modal" class="btn btn-small  waves-effect waves-light green z-depth-3 modal-trigger taxModal" id="add-line">
           <i class="fa fa-plus-circle"></i> Add Row
        </a>
        
    </div> 
  </section>

  <!--<section id="content3">
    
  </section>

  <section id="content4">
   
  </section>-->

</main>
     
  
                        
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

  


<div id="tax-modal" class="modal">
    <div class="modal-content">
     <div id="modal-loader" style="display: none; text-align: center;">
           <!-- ajax loader -->
           <img src="../assets/img/loading.gif">
           </div>
           <div class="alert alert-success green darken-4 mb-5">To ship to all countries or states leave it as <span class="reds">*</span>.</div>                 
           <!-- mysql data will be load here -->                          
           <div id="contents">
             <form id="taxForm">
   
                            <div class="row">
                              <div class="col m4 s12"> Country Code</div>
                                <div class="col m8 s12">
                                  <select id="taxcountry" name="countrycode[]" class="browser-default countrycode select taxcountry">
                                     <option value="*">*</option>  
                                    <?php echo countryCode(); ?>
                                    </select>

                                </div>
                              </div>
                              <div class="row">
                                <div class="col m4 s12">State Code</div>
                                <div class="col m8 s12">
                                   <select id="taxstates" name="statecode[]" class="browser-default countrycode select taxstates">
                                     
                                    </select>
                                    
                                </div>
                              </div>
                              <div class="row">
                                <div class="col m4 s12">Postcode / Zip</div>
                                <div class="col m8 s12">
                                  
                                    <input type="text" name="postcode[]" id="autocompletes" class="autocompletes autocomplete_txt darken-4" placeholder="*">
                                   
                                </div>
                                </div>
                                <div class="row">
                                   <div class="col m4 s12">City</div>
                                <div class="col m8 s12">
                                    <input type="text" data-type="city_" name="city[]" id="city_1" class="autocomplete_txt" autocomplete="off" placeholder="*">
                                </div>
                              </div>
                              <div class="row">
                                <div class="col m4 s12">Rate %</div>
                                <div class="col m8 s12">
                                    <input type="text" data-type="rate" name="rate[]" id="rate_1" class="autocomplete_txt" autocomplete="off" placeholder="0.0000">
                                </div>
                               </div> 
                               <div class="row">
                                <div class="col m4 s12">Tax Name</div>
                                <div class="col m8 s12">
                                  <input type="text" data-type="taxname" name="taxname[]" id="taxname_1" class="autocomplete_txt" autocomplete="off" placeholder="">
                                </div>
                              </div>
                              <div class="row">
                                 <div class="col m4 s12">Priority</div>
                                 <div class="col m8 s12">
                                     <input type="text" name="priority[]" class="autocomplete_txt digit" placeholder="1">
                                </div >
                              </div>
                              <div class="row">
                                <div class="col m4 s12">Compound</div>
                                
                                 <div class="col m8 s12">
                                   <label>
                                    <input type="checkbox" name="compound[]" class="filled-in" value="compound" />
                                    <span></span>
                                  </label>  
                                  
                                </div>
                              </div>
                              <div class="row">
                                <div class="col m4 s12">Shipping</div>
                                 <div class="col m8 s12">
                                    <label>
                                    <input type="checkbox" name="shipping[]" value="shipping" />
                                    <span></span>
                                    </label>
                                </div>
                                
                            </div>
<div class="row">
<div class="col m12">
  <div align="center" class="mt-5"><button id="TaxFormButton" class="btn btn-small bg-grey">Submit</button></div></div>
</div>
                           
                </form>


           </div>
    </div>
    
  </div>
    
    
 

<?php
include("footer.php");
?>