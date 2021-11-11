<?php
require_once('../admins.php');
?>


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
                                     <input type="number" name="priority[]" class="autocomplete_txt">
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

                           
                </form>

<script type="text/javascript">
  //Get tax state from the selected country
$(document).ready(function()
{
$("#taxcountry").change(function()
{
var country_id=$(this).val();
var post_id = 'country_id='+ country_id;
 
$.ajax
({
type: "POST",
url: "states.php",
data: post_id,
cache: false,
success: function(cities)
{
$('#mstates').empty();
$("#taxstates").html(cities);
} 
});
 
}).trigger('change');
});


</script>                