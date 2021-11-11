<script type="text/javascript">
$(document).ready(function(){
 
 $(document).on('click', '.add', function(){
  var html = '';
  html += '<tr class="tr">';
  html += '<td><a href="#" class="text-danger remove"><span class="fa fa-close"></span></a> <select name="module" class="browser-default mselect select"><option value="" class="validate" disabled selected>Select User Module</option>  <?php echo modules(); ?></select></td>';
   html += '<td><select name="create[]" class="browser-default mselect select"><option value="" class="validate" disabled selected>Create</option><option value="yes">No</option><option value="no">Yes</option></select></td>';
  html += '<td><select name="edit[]" class="browser-default mselect select"><option value="" class="validate" disabled selected>Edit</option><option value="yes">No</option><option value="no">Yes</option></select></td>';
  html += '<td> <select name="delete[]" class="browser-default delete select"><option value=""  disabled selected>Delete</option><option value="yes">No</option><option value="no">Yes</option></select></td>';
  html += '<td><select name="view[]" class="browser-default mselect select"><option value=""  disabled selected>View</option><option value="yes">No</option><option value="no">Yes</option></select></td>';
 
  html += '</tr>';
  $('#user_table').append(html);
 });

 
 $(document).on('click', '.remove', function(){
  $(this).closest('tr').remove();
 });



 });	




</script>