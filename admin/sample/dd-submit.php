<!doctype html public "-//w3c//dtd html 3.2//en">

<html>

<head>
<title>(Type a title for your page here)</title>
</head>

<body >
<?Php
error_reporting(0);// With this no error reporting will be there
$category=$_POST['category'];
$sub_category=$_POST['sub-category'];
$t1=$_POST['t1'];

echo "Category : $category <br> 
Sub-category = $sub_category <br>
Text field = $t1";

?>
</body>

</html>
