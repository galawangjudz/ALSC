<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php
// file name
$filename = $_FILES['file']['name'];
/* $getID = $_POST['csr_no']; */
/* $getID = $_POST['id']; */
// Location
$location = 'uploads/'.$filename;

// file extension
$file_extension = pathinfo($location, PATHINFO_EXTENSION);
$file_extension = strtolower($file_extension);

// Valid image extensions
$image_ext = array("jpg","png","jpeg","gif","pdf");

$resp = 0;
if(in_array($file_extension,$image_ext)){
	// Upload file
	if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
		$resp = $location;


       /*  $insert = $conn->query("INSERT into tbl_attachments(c_csr_no,title,name) VALUES('$getID','$filename','".$filename."')");   

 */
    
	}
}

return $resp;


?>