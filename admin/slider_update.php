
<?php
include("header.php");
include("header_bottom.php");
include("left_nav.php");


if(isset($_GET['id'])){
$id =  $_GET['id']; 
 $slides = getSlides($id);
       $slideA = getSlideAnim($id);
       foreach($slides as $rows){
        $img = substr($rows['img_name'],3);  
        $url = $rows['url'];
        


       }
?>


    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <!-- BEGIN: Page Main-->
    <div id="main">
      <div class="row">
        <div class="content-wrapper-before gradient-45deg-purple-deep-purple gradient-shadow"></div>
        <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
          <!-- Search for small screen-->
          <div class="container">
            <div class="row">
              <div class="col s12 m6 l6">
                <h5 class="mt-0 mb-0 text-white" ><i class="material-icons">image</i> Sliders Creator Update</h5>
              </div>
              
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-contents">
            
    <div class="row">
    <div class="col s12 m12 l12">
     
             
            
<form id="sliderUpdateForm" class="" enctype="multipart/form-data">
  <div class="row">
  <div class="col s12 m12">
    <input type="file" name="slidderImg" id="input-file-max-fs" class="dropify" data-max-file-size="2M" data-default-file="<?php  echo $img; ?>" />
    <input type="hidden" name="hidImg" value="<?php echo $rows['img_name']; ?>">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
  </div>
</div>
 <div class="row form-fields">
     <div class="col s12 m12 ">
    <table role="table " class="rowfy" id="slidder_table"> 
       <tbody>
       <?php
      foreach($slideA as $row){
      $atype = $row['animation_type'];
      $tpost = $row['text_position'];
        ?>
      <tr>
        <td><input type="text" name="slider_text[]" placeholder="Enter slider overlay text" value="<?php echo $row['slider_text'];  ?>">
        </td>
        <td>
          <select name="animation_type[]" class="input input--dropdown js--animations browser-default mselect select">
        <optgroup label="Attention Seekers">
          <option>Select slidder overlay text effect</option>
          <option value="bounce" <?php if($atype == 'bounce')  {echo "selected"; } ?>>bounce</option>
          <option value="flash" <?php if($atype == 'flash')  {echo "selected"; } ?>>flash</option>
          <option value="pulse" <?php if($atype == 'pulse')  {echo "selected"; } ?>>pulse</option>
          <option value="rubberBand" <?php if($atype == 'rubberBand')  {echo "selected"; } ?>>rubberBand</option>
          <option value="shake" <?php if($atype == 'shake')  {echo "selected"; } ?>>shake</option>
          <option value="swing" <?php if($atype == 'swing')  {echo "selected"; } ?>>swing</option>
          <option value="tada" <?php if($atype == 'tada')  {echo "selected"; } ?>>tada</option>
          <option value="wobble" <?php if($atype == 'wobble')  {echo "selected"; } ?>>wobble</option>
          <option value="jello" <?php if($atype == 'jello')  {echo "selected"; } ?>>jello</option>
          <option value="heartBeat" <?php if($atype == 'heartBeat')  {echo "selected"; } ?>>heartBeat</option>
        </optgroup>

        <optgroup label="Bouncing Entrances">
          <option value="bounceIn" <?php if($atype == 'bounceIn')  {echo "selected"; } ?>>bounceIn</option>
          <option value="bounceInDown" <?php if($atype == 'bounceInDown')  {echo "selected"; } ?>>bounceInDown</option>
          <option value="bounceInLeft" <?php if($atype == 'bounceInLeft')  {echo "selected"; } ?>>bounceInLeft</option>
          <option value="bounceInRight" <?php if($atype == 'bounceInRight')  {echo "selected"; } ?>>bounceInRight</option>
          <option value="bounceInUp" <?php if($atype == 'bounceInUp')  {echo "selected"; } ?>>bounceInUp</option>
        </optgroup>

        <optgroup label="Bouncing Exits">
          <option value="bounceOut" <?php if($atype == 'bounceOut')  {echo "selected"; } ?>>bounceOut</option>
          <option value="bounceOutDown" <?php if($atype == 'bounceOutDown')  {echo "selected"; } ?>>bounceOutDown</option>
          <option value="bounceOutLeft" <?php if($atype == 'bounceOutLeft')  {echo "selected"; } ?>>bounceOutLeft</option>
          <option value="bounceOutRight" <?php if($atype == 'bounceOutRight')  {echo "selected"; } ?>>bounceOutRight</option>
          <option value="bounceOutUp" <?php if($atype == 'bounceOutUp')  {echo "selected"; } ?>>bounceOutUp</option>
        </optgroup>

        <optgroup label="Fading Entrances">
          <option value="fadeIn" <?php if($atype == 'fadeIn')  {echo "selected"; } ?>>fadeIn</option>
          <option value="fadeInDown" <?php if($atype == 'fadeInDown')  {echo "selected"; } ?>>fadeInDown</option>
          <option value="fadeInDownBig" <?php if($atype == 'fadeInDownBig')  {echo "selected"; } ?>>fadeInDownBig</option>
          <option value="fadeInLeft" <?php if($atype == 'fadeInLeft')  {echo "selected"; } ?>>fadeInLeft</option>
          <option value="fadeInLeftBig" <?php if($atype == 'fadeInLeftBig')  {echo "selected"; } ?>>fadeInLeftBig</option>
          <option value="fadeInRight" <?php if($atype == 'fadeInRight')  {echo "selected"; } ?>>fadeInRight</option>
          <option value="fadeInRightBig" <?php if($atype == 'fadeInRightBig')  {echo "selected"; } ?>>fadeInRightBig</option>
          <option value="fadeInUp" <?php if($atype == 'fadeInUp')  {echo "selected"; } ?>>fadeInUp</option>
          <option value="fadeInUpBig" <?php if($atype == 'fadeInUpBig')  {echo "selected"; } ?>>fadeInUpBig</option>
        </optgroup>

        <optgroup label="Fading Exits">
          <option value="fadeOut" <?php if($atype == 'fadeOut')  {echo "selected"; } ?>>fadeOut</option>
          <option value="fadeOutDown" <?php if($atype == 'fadeOutDown')  {echo "selected"; } ?>>fadeOutDown</option>
          <option value="fadeOutDownBig" <?php if($atype == 'fadeOutDownBig')  {echo "selected"; } ?>>fadeOutDownBig</option>
          <option value="fadeOutLeft" <?php if($atype == 'fadeOutLeft')  {echo "selected"; } ?>>fadeOutLeft</option>
          <option value="fadeOutLeftBig" <?php if($atype == 'fadeOutLeftBig')  {echo "selected"; } ?>>fadeOutLeftBig</option>
          <option value="fadeOutRight" <?php if($atype == 'fadeOutRight')  {echo "selected"; } ?>>fadeOutRight</option>
          <option value="fadeOutRightBig" <?php if($atype == 'fadeOutRightBig')  {echo "selected"; } ?>>fadeOutRightBig</option>
          <option value="fadeOutUp" <?php if($atype == 'fadeOutUp')  {echo "selected"; } ?>>fadeOutUp</option>
          <option value="fadeOutUpBig" <?php if($atype == 'fadeOutUpBig')  {echo "selected"; } ?>>fadeOutUpBig</option>
        </optgroup>

        <optgroup label="Flippers">
          <option value="flip" <?php if($atype == 'flip')  {echo "selected"; } ?>>flip</option>
          <option value="flipInX" <?php if($atype == 'flipInX')  {echo "selected"; } ?>>flipInX</option>
          <option value="flipInY" <?php if($atype == 'flipInY')  {echo "selected"; } ?>>flipInY</option>
          <option value="flipOutX" <?php if($atype == 'flipOutX')  {echo "selected"; } ?>>flipOutX</option>
          <option value="flipOutY" <?php if($atype == 'flipOutY')  {echo "selected"; } ?>>flipOutY</option>
        </optgroup>

        <optgroup label="Lightspeed">
          <option value="lightSpeedIn" <?php if($atype == 'lightSpeedIn')  {echo "selected"; } ?>>lightSpeedIn</option>
          <option value="lightSpeedOut" <?php if($atype == 'lightSpeedOut')  {echo "selected"; } ?>>lightSpeedOut</option>
        </optgroup>

        <optgroup label="Rotating Entrances">
          <option value="rotateIn" <?php if($atype == 'rotateIn')  {echo "selected"; } ?>>rotateIn</option>
          <option value="rotateInDownLeft" <?php if($atype == 'rotateInDownLeft')  {echo "selected"; } ?>>rotateInDownLeft</option>
          <option value="rotateInDownRight" <?php if($atype == 'rotateInDownRight')  {echo "selected"; } ?>>rotateInDownRight</option>
          <option value="rotateInUpLeft" <?php if($atype == 'rotateInUpLeft')  {echo "selected"; } ?>>rotateInUpLeft</option>
          <option value="rotateInUpRight" <?php if($atype == 'rotateInUpRight')  {echo "selected"; } ?>>rotateInUpRight</option>
        </optgroup>

        <optgroup label="Rotating Exits">
          <option value="rotateOut" <?php if($atype == 'rotateOut')  {echo "selected"; } ?>>rotateOut</option>
          <option value="rotateOutDownLeft" <?php if($atype == 'rotateOutDownLeft')  {echo "selected"; } ?>>rotateOutDownLeft</option>
          <option value="rotateOutDownRight" <?php if($atype == 'rotateOutDownRight')  {echo "selected"; } ?>>rotateOutDownRight</option>
          <option value="rotateOutUpLeft" <?php if($atype == 'rotateOutUpLeft')  {echo "selected"; } ?>>rotateOutUpLeft</option>
          <option value="rotateOutUpRight" <?php if($atype == 'rotateOutUpRight')  {echo "selected"; } ?>>rotateOutUpRight</option>
        </optgroup>

        <optgroup label="Sliding Entrances">
          <option value="slideInUp" <?php if($atype == 'slideInUp')  {echo "selected"; } ?>>slideInUp</option>
          <option value="slideInDown" <?php if($atype == 'slideInDown')  {echo "selected"; } ?>>slideInDown</option>
          <option value="slideInLeft" <?php if($atype == 'slideInLeft')  {echo "selected"; } ?>>slideInLeft</option>
          <option value="slideInRight" <?php if($atype == 'slideInRight')  {echo "selected"; } ?>>slideInRight</option>

        </optgroup>
        <optgroup label="Sliding Exits">
          <option value="slideOutUp" <?php if($atype == 'slideOutUp')  {echo "selected"; } ?>>slideOutUp</option>
          <option value="slideOutDown" <?php if($atype == 'slideOutDown')  {echo "selected"; } ?>>slideOutDown</option>
          <option value="slideOutLeft" <?php if($atype == 'slideOutLeft')  {echo "selected"; } ?>>slideOutLeft</option>
          <option value="slideOutRight" <?php if($atype == 'slideOutRight')  {echo "selected"; } ?>>slideOutRight</option>
          
        </optgroup>
        
        <optgroup label="Zoom Entrances">
          <option value="zoomIn" <?php if($atype == 'zoomIn') {echo "selected"; }   ?>>zoomIn</option>
          <option value="zoomInDown" <?php if($atype == 'zoomInDown') {echo "selected"; }   ?>>zoomInDown</option>
          <option value="zoomInLeft" <?php if($atype == 'zoomInLeft') {echo "selected"; }  ?>>zoomInLeft</option>
          <option value="zoomInRight" <?php if($atype == 'zoomInRight')  {echo "selected"; }  ?>>zoomInRight</option>
          <option value="zoomInUp" <?php if($atype == 'zoomInUp')  {echo "selected"; }?> >zoomInUp</option>
        </optgroup>
        
        <optgroup label="Zoom Exits">
          <option value="zoomOut" <?php if($atype == 'zoomOut')  {echo "selected"; } ?> >zoomOut</option>
          <option value="zoomOutDown" <?php if($atype == 'zoomOut')  {echo "selected"; } ?> >zoomOutDown</option>
          <option value="zoomOutLeft" <?php if($atype == 'zoomOutLeft')  {echo "selected"; } ?>>zoomOutLeft</option>
          <option value="zoomOutRight" <?php if($atype == 'zoomOutRight')  {echo "selected"; } ?>>zoomOutRight</option>
          <option value="zoomOutUp" <?php if($atype == 'zoomOutUp')  {echo "selected"; } ?>>zoomOutUp</option>
        </optgroup>

        <optgroup label="Specials">
          <option value="hinge" <?php if($atype == 'hinge')  {echo "selected"; } ?>>hinge</option>
          <option value="jackInTheBox" <?php if($atype == 'jackInTheBox')  {echo "selected"; } ?>>jackInTheBox</option>
          <option value="rollIn" <?php if($atype == 'rollIn')  {echo "selected"; } ?>>rollIn</option>
          <option value="rollOut" <?php if($atype == 'rollOut')  {echo "selected"; } ?>>rollOut</option>
        </optgroup>
      </select>
        </td>
        <td>
         <select name="text_position[]" class="browser-default mselect select">
            <option>Text Position</option>
            <option value="right" <?php if($tpost == 'right')  {echo "selected"; } ?>>Right</option>
            <option value="left" <?php if($tpost == 'left')  {echo "selected"; } ?>>Left</option>
            <option value="center" <?php if($tpost == 'center')  {echo "selected"; } ?>>Center</option>

           </select> 
           <input type="hidden" name="aid[]" value="<?php echo $row['id'];  ?>">
        </td>
      </tr>
      <?php
       }
      ?>


      <!--<tr id="template" role="row"> 
        <td role="cell">
          <input type="text" name="slider_text[]" placeholder="Enter slider overlay text">

        </td>  
        <td role="cell">
           <select name="animation_type[]" class="input input--dropdown js--animations browser-default mselect select">
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
        </td> 
        <td>
          <select name="text_position[]" class="browser-default mselect select">
            <option>Text Position</option>
            <option value="right">Right</option>
            <option value="left">Left</option>
            <option value="center">Center</option>

           </select> 
        </td>  

       </tr>-->
       <tr>
        <td colspan="5">
      <div class="input-field" id="area">
         <input type="text" name="url" placeholder="Enter url" value="<?php echo $url; ?>">
         
      </div>
        </td>

       </tr>

      <tr>
      <td colspan="5">
        <div class="col m6 s12 mb-1 mb">
      
      </div>
      <div class="col m6 s12 mb-1 mb row">
      <a href="#"  id="add-line" class="addMore waves-effect waves-light bg-deep-purple mb-1" style="padding: 8px;">Add More</a>

    <button class="waves-effect waves dark btn btn-primary mb-1" id="submitSlide"
        type="submit">
       Update
    </button> 
       </div>

      </td>
      </tr>  


       </tbody>

    </table>  
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
</div>
</div>


<?php include("right_menu.php"); ?>
         
          </div>
        </div>
      </div>
    </div>
    <!-- END: Page Main-->

  



 


    
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
}
include("footer.php");
?>