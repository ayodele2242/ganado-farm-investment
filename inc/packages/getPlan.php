<script type="text/javascript" src="../assets/js/jquery-1.11.1.min.js"></script>
<script src="../assets/ckeditor/ckeditor.js"></script>
<script src="../assets/ckeditor/config.js"></script>
<?php
   
 require_once '../config.php';
$setSql = "SELECT * FROM store_setting";
    $setRes = mysqli_query($mysqli, $setSql) or die('site setting failed: ' .mysqli_error($mysqli));
    $set = mysqli_fetch_array($setRes);
	
 
 if (isset($_REQUEST['uid'])) {
   
 $id = intval($_REQUEST['uid']);
 $query = mysqli_query($mysqli,"SELECT * FROM farm_packages WHERE id='$id'");
 $row = mysqli_fetch_array($query);
 $u = $row['id'];

 if(empty($row['img'])){
$myimg  = $set['installUrl'].'assets/img/farm.png';
}else{
$myimg = $set['installUrl'].'assets/images/'.$row['img'];
}


 ?>
   
 <div class="row">
 
<div class="col m12 s12 mb-3">
<div id="message" class="removeMessages"></div>
<form autocomplete="off" id="fine" class="">
                 <div class="form-group mb-2">
                  <div align="center">
                  <img src="<?php echo $myimg; ?>" width="100" height="100">
                </div>
                </div>

                <div class="form-group mb-2">
                  
                  <input type="file" name="image" id="input-file-now" class="dropify" />

                  <input type="hidden" name="pimg" value="<?php echo $row['img'];  ?>">
                
                </div>
                <div class="form-group mb-2">
                    <label>Type of Farm</label>
                <input type="text" name="name"  required="required" class="form-control" placeholder="Type of Farm" value="<?php echo $row['category'];  ?>">
                </div>

                <div class="form-group stas mb-2" >
                  <label>Percentage</label>  
                <input type="text" name="percentage"  required="required" class="form-control" placeholder="Percentage" value="<?php echo $row['percent'];  ?>">
                </div>
                
                 <div class="form-group mb-2">
                <label>Status</label>
                <select name="status" class="browser-default  mselect" required="required">
                    
                        
                        <option value="">Select Status</option>
                        <option value="active" <?php if($row['status'] == "active") echo "selected";  ?>>Running</option>
                        <option value="stopped" <?php if($row['status'] == "stopped") echo "selected";  ?>>Inactive</option>
                        
                        </select>
                </div>

                <div class="form-group mb-2">
                <label>Duration</label>
                <select name="duration" class="browser-default  mselect" required="required">
                    
                        
                        <option value="">Select Duration</option>
                        <option value="1" <?php if($row['duration'] == "1") echo "selected";  ?>>1 Month</option>
                        <option value="2" <?php if($row['duration'] == "2") echo "selected";  ?>>2 Months</option>
                        <option value="3" <?php if($row['duration'] == "3") echo "selected";  ?>>3 Months</option>
                        <option value="4" <?php if($row['duration'] == "4") echo "selected";  ?>>4 Months</option>
                        <option value="5" <?php if($row['duration'] == "5") echo "selected";  ?>>5 Months</option>
                        <option value="6" <?php if($row['duration'] == "6") echo "selected";  ?>>6 Months</option>
                        <option value="7" <?php if($row['duration'] == "7") echo "selected";  ?>>7 Months</option>
                        <option value="8" <?php if($row['duration'] == "8") echo "selected";  ?>>8 Months</option>
                        <option value="9" <?php if($row['duration'] == "9") echo "selected";  ?>>9 Months</option>
                        <option value="10" <?php if($row['duration'] == "10") echo "selected";  ?>>10 Months</option>
                        <option value="11" <?php if($row['duration'] == "11") echo "selected";  ?>>11 Months</option>
                        <option value="12" <?php if($row['duration'] == "12") echo "selected";  ?>>12 Months</option>
                        </select>
                </div>

                 <div class="form-group  mb-2" >
                  <label>Capital</label>  
                <input type="number" name="amount"  required="required" class="form-control" placeholder="Capital" value="<?php echo $row['capital'];  ?>">
                </div>

                <div class="form-group mb-2">
                <label>Farm Details</label>
                <textarea id="editor" name="info"><?php echo $row['details'];  ?></textarea>
                </div>
                <div class="form-group mb-5">
                <div align="center">
                 <input type="hidden" name="id" value="<?php echo $row['id'];  ?>">
                <button type="submit" class="btn btn-md btn-info updatePlan" id="updateMyPlan">Update</button>
               
                </div>
                </div>

                </form>
      
 </div>

 </div>	



<?php } ?>


<script type="text/javascript">

//Update store setting table
$(document).ready(function() {
    $("#updateMyPlan").click(function() {
        // using serialize function of jQuery to get all values of form
        var serializedData = new FormData($("#fine")[0]); //$("#fine").serialize();
        //var loader='<img src="../assets/img/loading.gif" width="40" height="40"/>';
        //alert(serializedData);         
       $.ajax({

            type : 'POST',
            url  : '../inc/packages/updatePlan.php',
            data : serializedData,
            contentType: false,
            cache: false,
            processData: false,
            async: false,
            success :  function(data)
            {
                if(data.trim() == 1)
                {

                	 M.toast({html: 'Update was Successful', classes: 'alert-success'});
                   setTimeout(' window.location.href = "plans"; ',1000);
                	
                }else{

                	M.toast({html: data, classes: 'alert-danger'});
                    

                }
            }
        });
        return false;

 
    });
});


//Delete User from users' list
 $(document).ready(function(){
    $(".btn-delete").click(function() {
     var pid = $(this).attr('id'); // get id of clicked row  
     //confirm("Are you sure you want to delete "+pid+"? There is no undo."); 
     $.post("../admin/script/deleteMenu.php", {"id": pid, }, 
    function(data) {
        if(data == 1){
        	 $(".refresh").load(location.href + ".refresh");
             M.toast({html: "Menu Privilege Delected"});
             $("#tableData").load();
             
            //alert(data);
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });

    });
  });



$(document).ready(function() {
    var template = $('#template'),
        id = 0;
    
    $("#add-line").click(function() {
        if(!template.is(':visible'))
        {
            template.show();
            return;
        }
        var row = template.clone().append('<td><button class="btn btn-small btn btn-floating '
      + ($(this).is(":last-child") ?
        'rowfy-addrow remove red">-' :
        'rowfy-deleterow remove waves-effect waves-light red">-') 
      +'</button></td>');
        //template.find(".mselect").val();
        row.attr('id', 'row_' + (++id));
        template.after(row);

        //$(this).removeClass('rowfy-addrow btn-success').addClass('rowfy-deleterow btn-danger').text('-');
    });
    
    $('.form-fields').on('click', '.remove', function(){
        var row = $(this).closest('tr');
        if(row.attr('id') == 'template')
        {
            row.hide();
        }
        else
        {
            row.remove();
        }
    });
});
 



$(document).ready(function() {
    $("#submitUser").click(function() {

    	var sender = $("#mPrivilege").serialize();
    	//console.log(sender);

    

     var error = '';

    $('.module').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select module to add to user/'s privileges </p>";
    return false;
   }
   count = count + 1;
  });

  $('.create').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on create </p>";
    return false;
   }
   count = count + 1;
  });  

  $('.delete').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on delete</p>";
    return false;
   }
   count = count + 1;
  });  
  
  $('.view').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on view </p>";
    return false;
   }
   count = count + 1;
  });  

  $('.edit').each(function(){
   var count = 1;
   if($(this).val() == '')
   {
    error += "<p class='text-danger'>Select permission on edit</p>";
    return false;
   }
   count = count + 1;
  });  

  if(error == '')
  {
       $.ajax({
            type : 'POST',
            url  : '../admin/script/updatePrivilege.php',
            data : sender,
            success :  function(data)
            {
                if(data=="i")
                {
                  $(".refresh").load(location.href + ".refresh");
                	 M.toast({html: '<div class="alert-success green darken-4"> <i class="material-icons">done</i> Insertion was Successful!!</div>'});

                    

                }
                else{

                	M.toast({
                		html: '<div class="alert-danger alert">'+data+' !</div>'

                		});


                }
            }
        });
        return false;

} else
  {

  	 M.toast({
  	 	html: error,
  		type: "warning",
  	 });

    
  }
 
    });
}); 
 </script>
 
 <script type="text/javascript">
      //<![CDATA[

        // This call can be placed at any point after the
        // <textarea>, or inside a <head><script> in a
        // window.onload event handler.

        // Replace the <textarea id="editor"> with an CKEditor
        // instance, using default configurations.
       
        CKEDITOR.replace( 'editor',
                {
                    filebrowserBrowseUrl :'../assets/ckeditor/filemanager/browser/default/browser.html?Connector=../assets/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserImageBrowseUrl : '../assets/ckeditor/filemanager/browser/default/browser.html?Type=Image&Connector='../'assets/ckeditor/filemanager/connectors/php/connector.php',
                    filebrowserFlashBrowseUrl :'../assets/ckeditor/filemanager/browser/default/browser.html?Type=Flash&Connector=../assets/ckeditor/filemanager/connectors/php/connector.php',
          filebrowserUploadUrl  :'../assets/ckeditor/filemanager/connectors/php/upload.php?Type=File',
          filebrowserImageUploadUrl : '../assets/ckeditor/filemanager/connectors/php/upload.php?Type=Image',
          filebrowserFlashUploadUrl : '../assets/ckeditor/filemanager/connectors/php/upload.php?Type=Flash'
                });
             


      //]]>
      </script> 


