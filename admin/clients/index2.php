
<!doctype html>
<html>
<head>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />    
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type='text/javascript'>
$(document).ready(function(){
  
 // Show Input element
 $('.edit').click(function(){
  $('.txtedit').hide();
  $(this).next('.txtedit').show().focus();
  $(this).hide();
 });
 
 // Save data
 $(".txtedit").focusout(function(){
   
  // Get edit id, field name and value
  var id = this.id;
  var split_id = id.split("_");
  var field_name = split_id[0];
  var edit_id = split_id[1];
  var value = $(this).val();
   
  // Hide Input element
  $(this).hide();
 
  // Hide and Change Text of the container with input elmeent
  $(this).prev('.edit').show();
  $(this).prev('.edit').text(value);
 
  $.ajax({
   url: _base_url_+"admin/clients/update.php",
   type: 'post',
   data: { field:field_name, value:value, id:edit_id },
   success:function(response){
      if(response == 1){ 
         console.log('Save successfully'); 
      }else{ 
         console.log("Not saved.");  
      }
   }
  });
  
 });
 
});
</script>
</head>
<body >
<div class="container" >
    <div class="row" style="padding:50px;">

        <table width='100%' border='0'>
         <tr>
          <th width='10%'>No</th>
          <th width='40%'>Username</th>
          <th width='40%'>Name</th>
          <th width='40%'>Pass</th>
         </tr>
         <?php 
         include('conn2.php');
         $count = 1;
         $query = $conn->query("SELECT * FROM users order by id");
         while ($row = $query ->fetch_object()) {
          $id = $row->id;
          $username = $row->username;
          $name = $row->name;
          $pass = $row->pass;
         ?>
         <tr>
          <td><?php echo $count; ?></td>
          <td> 
            <div class='edit' > <?php echo $username; ?></div> 
            <input type='text' class='txtedit' value='<?php echo $username; ?>' id='username_<?php echo $id; ?>' >
          </td>
          <td> 
           <div class='edit' ><?php echo $name; ?> </div> 
           <input type='text' class='txtedit' value='<?php echo $name; ?>' id='name_<?php echo $id; ?>' >
          </td>
          <td> 
           <div class='edit' ><?php echo $pass; ?> </div> 
           <input type='text' class='txtedit' value='<?php echo $pass; ?>' id='pass_<?php echo $id; ?>' >
          </td>
         </tr>
         <?php
         $count ++;
         }
         ?> 
        </table>
   </div>
</div>
<style>
.edit{
 width: 100%;
 height: 25px;
}
.editMode{
 border: 1px solid black;
}
table {
 border:3px solid lavender;
 border-radius:3px;
}
table tr:nth-child(1){
 background-color:dodgerblue;
}
table tr:nth-child(1) th{
 color:white;
 padding:10px 0px;
 letter-spacing: 1px;
}
table td{
 padding:10px;
}
table tr:nth-child(even){
 background-color:lavender;
 color:black;
}
.txtedit{
 display: none;
 width: 99%;
 height: 30px;
}
</style>
</body>
</html>