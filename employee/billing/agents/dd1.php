<!doctype html public "-//w3c//dtd html 3.2//en">
<html>
<head>
<title>plus2net demo scripts using JQuery</title>
</head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script  src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<body>
<script>
$(document).ready(function() {
////////////
$('#t1').hide();
$('#category').change(function(){
//var st=$('#category option:selected').text();
var c_code=$('#category').val();
$('#sub-category').empty(); //remove all existing options
///////
$.get('<?php echo base_url ?>admin/?page=agents/dd1ck.php',{'c_code':c_code},function(return_data){
$('#msg').text(" Number of Records found :"+return_data.no_of_records);
if(return_data.no_of_records>=1){
$.each(return_data.data, function(key,value){
		$("#sub-category").append("<option value=" + value.c_code +">"+value.c_division+"</option>");
	});
}else{
/// add text box and hide 2nd subcategory 
$('#sub-category').hide();
$('#t1').show();
}
}, "json");
///////
});
/////////////////////
});
</script>
<div id=msg> &nbsp;</div><br><br>
<form method=post action=dd-submit.php>
<select name=category id=category>
<option value='' selected>Select</option>
<?Php
require "config.php";// connection to database 
$sql="select * from t_network "; // Query to collect data 

foreach ($dbo->query($sql) as $row) {
echo "<option value=$row[c_code]>$row[c_network]</option>";
}
?>
</select>
<select name=sub-category id=sub-category>
</select> <input type=text name=t1 id=t1>
<input type=submit value=Submit></form>
</body>
</html>
