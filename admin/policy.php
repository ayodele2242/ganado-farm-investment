<?php
include("header.php");
include("header_bottom.php");

include("left_nav.php");
$query = mysqli_query($mysqli,"select * from policy");
$row = mysqli_fetch_array($query);


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
                <h4 class="mt-0 mb-0 text-white" ><i class="material-icons">note</i> Private Policy Page</h4>
              </div>
             
            </div>
          </div>
        </div>
        <div class="col s12">
          <div class="container">
            <!--Basic Card-->
<div class="card">
      <div class="card-content gradient-shadow">
      <form enctype="multipart/form-data" id="faqpage">
      

<div class="col s12">
    <div class="form-group form-float mb-2">
  
      
      <textarea name="jobdes"  id="editor" >
         <?php
        echo $row['content'];

        ?>
        
      </textarea>
    
  

  </div> 


<div align="center">                       
  <button type="submit" class="btn btn-primary btn-md" id="btn-submit">Update</button>
</div>

</div>

<div class="col s12 l12 mt-5">

                              
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

<script type="text/javascript">
  $(document).ready(function (e) {
    
$("#faqpage").on('submit',(function(e) {
        e.preventDefault();

        for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }
        
        $.ajax({
            url: "../inc/page/policy.php",
            type: "POST",
            data:  new FormData($("#faqpage")[0]),//new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            async: false,
            success: function(data)
            {
       if(data=="added")
          {
            M.toast({html: "Updated successfully", classes: 'alert-success' });
                               
          
          }
          else{
                    M.toast({html: data, classes: 'alert-danger'});

          }
      

            },
            error: function() 
            {
            }           
       });
    }));
});
</script>