
<?php
include('conn2.php');
if(isset($_POST['field']) && isset($_POST['value']) && isset($_POST['id'])){
   $field = $_POST['field'];
   $value = $_POST['value'];
   $editid = $_POST['id'];
 
    $sql = "UPDATE t_invoice SET ".$field."='".$value."' WHERE payment_id = $editid"; 
    $update = $conn->query($sql); 
 
   echo 1;
}else{
   echo 0;
}
exit;
?>