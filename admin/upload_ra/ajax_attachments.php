<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php

$a_id = $_POST['csrno'];
 
$sql = "select * from tbl_attachments where id=".$a_id;
$result = mysqli_query($conn,$sql);
while( $row = mysqli_fetch_array($result) ){
?>
<style>
    .container{
        width:auto;
        height:auto;
        max-width: 100%!important;
        max-height: 100%!important;
        display: block!important; /* remove extra space below image */
    }
    .container1{
        width:1000px!important;
        height:500px;
        display: block!important; /* remove extra space below image */
    }
    .main_content{
        width:100%;
        height:100%;
        max-width: 100%!important;
        max-height: 100%!important;
        display: block!important; /* remove extra space below image */
    }
    .main_content1{
        width:1000px!important;
        height:500px;
        display: block!important; /* remove extra space below image */
    }
</style>
<?php
    $a_name=$row['name'];
    $res = substr($a_name, -4);
    
   
    $path = './admin/upload_ra/uploads/'+$a_name;

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename='.$path);
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');

    readfile($path);  


}
?>