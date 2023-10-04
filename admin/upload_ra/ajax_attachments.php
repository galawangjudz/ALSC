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
        display: block!important; /
    }
    .container1{
        width:1000px!important;
        height:500px;
        display: block!important; 
    }
    .main_content{
        width:100%;
        height:100%;
        max-width: 100%!important;
        max-height: 100%!important;
        display: block!important; 
    }
    .main_content1{
        width:47%!important;
        height:500px;
        display: block!important; 
    }
</style>
<?php
    $a_name=$row['name'];
    $res = substr($a_name, -4);
    
    if($res == ".jpg" || $res == "jpeg" || $res == ".png"){
        ?>
        <div class="container">
            <img src="upload_ra/uploads/<?php echo $row['name']; ?>" class="main_content">
        </div>
    <?php
    }else{
        ?>
        <div class="container1">
            <embed type="application/pdf" src="upload_ra/uploads/<?php echo $row['name']; ?>" class="main_content1">
        </div>
    <?php
    }
?>
    
        <!-- <td width="100"><embed type="application/pdf" src="attachments/<php echo $row['name']; ?>" style="height:150px;width:150px;"></td> -->

<?php } ?>
