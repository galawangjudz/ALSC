<?Php
error_reporting(0);// With this no error reporting will be there
@$c_code=$_GET['c_code'];
//$cat_id=2;
/// Preventing injection attack //// 
if(!is_numeric($c_code)){
echo "Data Error";
exit;
 }
/// end of checking injection attack ////
require "config.php";

$no_of_records = $dbo->query("select count(c_code) from t_division where c_code='$c_code'")->fetchColumn();

if($no_of_records >=1){
$sql="select c_division from t_division where c_code='$c_code'";
$row=$dbo->prepare($sql);
$row->execute();
$result=$row->fetchAll(PDO::FETCH_ASSOC);
}else{
$result='';
}

$main = array('data'=>$result,'no_of_records'=>$no_of_records);
echo json_encode($main);
?>
