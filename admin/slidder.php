<?php
include("header.php");
include("header_bottom.php");
include("left_nav.php");
?>





 <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-purple-deep-purple gradient-shadow"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s12 m6 l6">
                <h5 class="mt-0 mb-0 text-white" ><i class="material-icons">image</i> Sliders Creator</h5>
              </div>
              
            </div>
          </div>
        </div>
        <div class="col s12">
        <div class="container">
            <!--Basic Card-->
      <div class="card">
      <div class="card-contents">
 
              <div  class="col s12  white">
                <form id="sliderForm" class="mt-4" enctype="multipart/form-data">
                    <div class="row">

                    <div class="col s12 m12">
                                    
                    <label style="font-size: 14px;">Image/Video</label>
                    <div class="form-line">
                    <div id="kv-avatar-errors-2" class="center-block" style="width:200px;display:none"></div>
                    <div class="kv-avatar center-block" style="width:212px;">
                      <input id="avatar-2" name="userImage" type="file" class="file-loading">
                    </div>


                    </div>   

                  </div>


 <div class="row divform-fields">
     <div class="col s12 m12 rowfy">
    
       <div class="row mt-4" id="template" style="padding: 5px; background: #f1f1f1;" >
     
        <div class="col m4 s12">
         
          <input type="text" name="slider_text[]" placeholder="Enter slider overlay text">
        
        </div>  
         
        <div class="col m4 s12">
           <select name="animation_type[]" class="input input--dropdown js--animations browser-default mselect select" >
        <optgroup label="Attention Seekers">
          <option>Select slidder overlay text effect</option>
          <option value="bounce">bounce</option>
          <option value="flash">flash</option>
          <option value="pulse">pulse</option>
          <option value="rubberBand">rubberBand</option>
          <option value="shake">shake</option>
          <option value="swing">swing</option>
          <option value="tada">tada</option>
          <option value="wobble">wobble</option>
          <option value="jello">jello</option>
          <option value="heartBeat">heartBeat</option>
        </optgroup>

        <optgroup label="Bouncing Entrances">
          <option value="bounceIn">bounceIn</option>
          <option value="bounceInDown">bounceInDown</option>
          <option value="bounceInLeft">bounceInLeft</option>
          <option value="bounceInRight">bounceInRight</option>
          <option value="bounceInUp">bounceInUp</option>
        </optgroup>

        <optgroup label="Bouncing Exits">
          <option value="bounceOut">bounceOut</option>
          <option value="bounceOutDown">bounceOutDown</option>
          <option value="bounceOutLeft">bounceOutLeft</option>
          <option value="bounceOutRight">bounceOutRight</option>
          <option value="bounceOutUp">bounceOutUp</option>
        </optgroup>

        <optgroup label="Fading Entrances">
          <option value="fadeIn">fadeIn</option>
          <option value="fadeInDown">fadeInDown</option>
          <option value="fadeInDownBig">fadeInDownBig</option>
          <option value="fadeInLeft">fadeInLeft</option>
          <option value="fadeInLeftBig">fadeInLeftBig</option>
          <option value="fadeInRight">fadeInRight</option>
          <option value="fadeInRightBig">fadeInRightBig</option>
          <option value="fadeInUp">fadeInUp</option>
          <option value="fadeInUpBig">fadeInUpBig</option>
        </optgroup>

        <optgroup label="Fading Exits">
          <option value="fadeOut">fadeOut</option>
          <option value="fadeOutDown">fadeOutDown</option>
          <option value="fadeOutDownBig">fadeOutDownBig</option>
          <option value="fadeOutLeft">fadeOutLeft</option>
          <option value="fadeOutLeftBig">fadeOutLeftBig</option>
          <option value="fadeOutRight">fadeOutRight</option>
          <option value="fadeOutRightBig">fadeOutRightBig</option>
          <option value="fadeOutUp">fadeOutUp</option>
          <option value="fadeOutUpBig">fadeOutUpBig</option>
        </optgroup>

        <optgroup label="Flippers">
          <option value="flip">flip</option>
          <option value="flipInX">flipInX</option>
          <option value="flipInY">flipInY</option>
          <option value="flipOutX">flipOutX</option>
          <option value="flipOutY">flipOutY</option>
        </optgroup>

        <optgroup label="Lightspeed">
          <option value="lightSpeedIn">lightSpeedIn</option>
          <option value="lightSpeedOut">lightSpeedOut</option>
        </optgroup>

        <optgroup label="Rotating Entrances">
          <option value="rotateIn">rotateIn</option>
          <option value="rotateInDownLeft">rotateInDownLeft</option>
          <option value="rotateInDownRight">rotateInDownRight</option>
          <option value="rotateInUpLeft">rotateInUpLeft</option>
          <option value="rotateInUpRight">rotateInUpRight</option>
        </optgroup>

        <optgroup label="Rotating Exits">
          <option value="rotateOut">rotateOut</option>
          <option value="rotateOutDownLeft">rotateOutDownLeft</option>
          <option value="rotateOutDownRight">rotateOutDownRight</option>
          <option value="rotateOutUpLeft">rotateOutUpLeft</option>
          <option value="rotateOutUpRight">rotateOutUpRight</option>
        </optgroup>

        <optgroup label="Sliding Entrances">
          <option value="slideInUp">slideInUp</option>
          <option value="slideInDown">slideInDown</option>
          <option value="slideInLeft">slideInLeft</option>
          <option value="slideInRight">slideInRight</option>

        </optgroup>
        <optgroup label="Sliding Exits">
          <option value="slideOutUp">slideOutUp</option>
          <option value="slideOutDown">slideOutDown</option>
          <option value="slideOutLeft">slideOutLeft</option>
          <option value="slideOutRight">slideOutRight</option>
          
        </optgroup>
        
        <optgroup label="Zoom Entrances">
          <option value="zoomIn">zoomIn</option>
          <option value="zoomInDown">zoomInDown</option>
          <option value="zoomInLeft">zoomInLeft</option>
          <option value="zoomInRight">zoomInRight</option>
          <option value="zoomInUp">zoomInUp</option>
        </optgroup>
        
        <optgroup label="Zoom Exits">
          <option value="zoomOut">zoomOut</option>
          <option value="zoomOutDown">zoomOutDown</option>
          <option value="zoomOutLeft">zoomOutLeft</option>
          <option value="zoomOutRight">zoomOutRight</option>
          <option value="zoomOutUp">zoomOutUp</option>
        </optgroup>

        <optgroup label="Specials">
          <option value="hinge">hinge</option>
          <option value="jackInTheBox">jackInTheBox</option>
          <option value="rollIn">rollIn</option>
          <option value="rollOut">rollOut</option>
        </optgroup>
      </select>
        </div>
        <div class="col m4 s12">
          <select name="text_position[]" class="browser-default mselect select">
            <option>Text Position</option>
            <option value="right">Right</option>
            <option value="left">Left</option>
            <option value="center">Center</option>
            <option value="center_left">Center Left</option>
            <option value="center_right">Center Right</option>

           </select> 
        </div>  
 <div class="col m12 s12 mt-3">
         <textarea name="descr[]"  rows="15" placeholder="Description"   class="form-control" ></textarea>
         
         </div>
       
           <div class="col m12 s12">
         <!-- <label>
        <input type="checkbox" id="myCheck"  onclick="addbox();"/>
        <span>Check to add url on slide</span>
      </label>-->

     
         <input type="text" name="url[]" placeholder="Enter url if you want to add button link to slide">
    
        </div>

        </div>
      
        <div class="col m6 s12 mb-1 mb">
      
      </div>
      <div class="col m6 s12 mt-2 row">
      <a href="#"  id="add-line" class="addMore waves-effect waves-light bg-deep-purple mb-1" style="padding: 8px;">Add More</a>

    <button class="waves-effect waves dark btn btn-primary mb-1" id="submitSlide"
        type="submit" >
       Submit
    </button> 
       </div>

    </div>
    </div>



                  </form>
               

              </div>

               <div  class="col s12 ">
             
            <table id="sliderTable" class="table_view">
            <thead>
            <tr>
            <th>Actions</th>  
            <th>Image</th>
            <th>Url</th>
            <th>Slider Text</th>
            <th>Animation Type</th>
            <th>Text Position</th>
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
  


<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModal2Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
            <div class="fetched-data"></div>
      </div>
      <div class="modal-footer">
           
                <!--<button type="button" class="btn btn-default print" onClick="window.print();return false">Print</button>-->
            </div>
    </div>
  </div>
</div>


<!-- remove modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="sliderModal">
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




<script>
  function testAnim(x) {
    $('#animationSandbox').removeClass().addClass(x + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function(){
      $(this).removeClass();
    });
  };

  $(document).ready(function(){
    $('.js--triggerAnimation').click(function(e){
      e.preventDefault();
      var anim = $('.js--animations').val();
      testAnim(anim);
    });

    $('.js--animations').change(function(){
      var anim = $(this).val();
      testAnim(anim);
    });
  });

</script>

<?php
include("footer.php");
?>