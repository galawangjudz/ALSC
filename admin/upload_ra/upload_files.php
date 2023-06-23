<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php 
$getID = $_GET['id'];
?>
<!-- <?php
	function test(){
		$fileName = "falls-06.jpg";
		$filePath = "uploads/";
		$myFile = $filePath.$fileName;
		
		if(file_exists($myFile)){
			echo "$fileName exists!!!";
			echo $myFile;
		}else{
			echo "$fileName does not exist!!!";
			echo $myFile;
		}
	}
?> -->


<style>
	.container-fluid p{
		margin: unset;
	}
 	#uni_modal .modal-footer{
		display: none;
	} 
</style>
<!doctype html>
<html>

    <head>
       </head>  
    	<body>
        <!-- Modal -->
		<form action="" method="post" enctype="multipart/form-data" id="upload-file">
			<input id="id" type="hidden" name="id" value= "<?php echo $getID ?>" />
			<input type="hidden" name="getFileName" id="getFileName" class="form-control required">	
			<table>
				<tr>
					<td>
					<label class="control-label">Select file:</label>
					<input id="file" type="file" name="fileRA" class='form-control required' style="margin-bottom:15px;" onchange="moveToFolder()" multiple/>
					</td>
					<td>
						<label class="control-label">File Name:</label>
						<input type="text" name="title" id="title" class="form-control required" style="margin-bottom:15px;" onchange="moveToFolder()">
					</td>
				</tr>
				<tr>
					<td>
						<button id="upload" style="width:100%;font-size:14px;" class="btn btn-flat bg-info" disabled><i class="fa fa-upload" aria-hidden="true"></i>&nbsp;&nbsp;Upload</button>
					</td>
					<td>
						<button type="button" class="btn btn-flat bg-maroon" data-dismiss="modal" style="width:100%; font-size:14px;"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Close</button>
                    </td>
				</tr>
			</table>	
		</form>	
    </body>
</html>

<script>
    var titleInput = document.getElementById("title");
    var uploadButton = document.getElementById("upload");

    titleInput.addEventListener("input", function() {
      if (titleInput.value.trim() === "") {
        uploadButton.disabled = true;
      } else {
        uploadButton.disabled = false;
      }
    });
  </script>
<script>
	$('#upload').on('click', function() {
    var file_data = $('#file').prop('files')[0]; 
/* 	var csr_no =   $('#csr_no').value(); */
    var form_data = new FormData();                  
    form_data.append('file', file_data);
                         
    $.ajax({
        url: _base_url_+'admin/upload_ra/upload.php', // <-- point to server-side PHP script 
        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(resp){
           
        }
     });
	});

   
    $('#upload-file').submit(function(e){
		e.preventDefault();
        var _this = $(this)
        $('.err-msg').remove();
        start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=upload_file",
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			dataType: 'json',
			error:err=>{
				console.log(err)
				alert_toast("An error occured",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp =='object' && resp.status == 'success'){
					location.reload();
				}else if(resp.status == 'failed' && !!resp.msg){
					alert_toast(resp.msg,'error');
				}else{
					alert_toast("An error occured",'error');
					end_loader();
					console.log(resp)
				}
			}
		
		})
	
	})
</script>
<script>
	function moveToFolder(){

		var filename=document.getElementById('file').files[0].name;

		document.getElementById('getFileName').value=filename;
	}
</script>


