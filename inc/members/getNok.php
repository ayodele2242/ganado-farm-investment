
<?php
   
 require_once '../config.php';

	
 
 if (isset($_REQUEST['uid'])) {
   
 $id = intval($_REQUEST['uid']);
 $query = mysqli_query($mysqli,"SELECT * FROM members WHERE id='$id'");
 $row = mysqli_fetch_array($query);


 


 ?>
   
<div class="card">
<div class="col m12 s12 mb-3">
<form id="fine">
 <table class="table table-ulogs table-borderless">
<tbody>
 <tr>
 <th>Full Name</th>
 <td><input type="text" class="form-control" name="kname" value="<?php echo $row['kin_name']; ?>" ></td>
 </tr>
 <tr>
 <th>Phone Number</th>
 <td><input type="text" class="form-control" name="kphone" value="<?php echo $row['kin_phone']; ?>" ></td>
 </tr>
 <tr>
 <th>Address</th>
 <td>
  <textarea class="form-control" name="kaddr"><?php echo $row['kin_address'];  ?></textarea>
</td>
 </tr>
 <tr>
 <th>Gender</th>
 <td>
    <select id="gender" class="form-control form-select" name="gender">
      <option value="">Gender</option>
      <option <?php if($row['kin_gender'] == 'Male'){ echo "selected"; }  ?>>Male</option>
      <option <?php if($row['kin_gender'] == 'Female'){ echo "selected"; }  ?>>Female</option>

    </select>
 </td>
 </tr>
 <tr>
<td colspan="10"><div align="center"><button type="button" id="updateIt" class="btn btn-default btn-sm col-white">Update</button> </div></td>
 </tr>
 </tbody>	
 </table>
<input type="hidden" name="id" value="<?php echo $row['id']; ?>">
</form>

</div>



 </div>	



<?php } ?>


<script type="text/javascript">

//Update store setting table
$(document).ready(function() {
    $("#updateIt").click(function() {
        // using serialize function of jQuery to get all values of form
        var serializedData = $("#fine").serialize();
        //var loader='<img src="../assets/img/loading.gif" width="40" height="40"/>';
                 
       $.ajax({

            type : 'POST',
            url  : '../inc/members/updateNextofKin.php',
            data : serializedData,
            success :  function(data)
            {
                if(data == 1)
                {

                   $.toast({ 
                      text : 'Update was Successful', 
                      showHideTransition : 'fade',
                      bgColor : 'green',            
                      textColor : '#fff',
                      allowToastClose : false,
                      hideAfter : 4000,
                      loader: false,            
                      stack : 5,                     
                      textAlign : 'center', 
                      position : 'top-right'  
                  });
                   window.location="profile";
                	// M.toast({html: '<i class="material-icons">done</i> Update was Successful'});
                	
                }else{

                  $.toast({ 
                      text : 'Error occured '+data, 
                      showHideTransition : 'fade',
                      bgColor : 'red',            
                      textColor : '#fff',
                      allowToastClose : false,
                      hideAfter : 4000,
                      loader: false,            
                      stack : 5,                     
                      textAlign : 'center', 
                      position : 'top-right'  
                  });

                	
                    

                }
            }
        });
        return false;

 
    });
});



 </script>


