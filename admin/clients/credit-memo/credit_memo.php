<?php 
include '../../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
#item-list th, #item-list td{
	padding:5px 3px!important;
}
.container-fluid p{
    margin: unset
}
#uni_modal .modal-footer{
    display: none;
} 
</style>

<?php
	if (isset($_GET['id'])) {
		$prop = $conn->query("SELECT * FROM property_clients where md5(property_id) = '{$_GET['id']}'");    
		while($row=$prop->fetch_assoc()){
			$prop_id = $row['property_id'];
			$lname = $row['last_name'];
			$fname = $row['first_name'];
			$mname = $row['middle_name'];
			}
	}
?>
<?php

	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}

	$sql = "SELECT DISTINCT(or_no) FROM property_payments where md5(property_id) = '{$_GET['id']}'";
	$result = mysqli_query($conn, $sql);

	$orData = array();
	while ($row = mysqli_fetch_assoc($result)) {
		$orData[] = $row['or_no'];
	}
?>
<body>
<div class="card card-outline rounded-0 card-dark">
	<div class="card-header">
		<h3 class="card-title"><b><i>Credit/Debit Memo</b></i></h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">	
			<form action="" id="manage-cm">
				<table class="table table-striped table-hover table-bordered" id="data-table">
					<tr>
						<td>
							<label class="control-label">Account Number: </label>
						</td>
						<td>
							<input type="hidden" name="cm_id" id="cm_id" value="<?php echo $prop_id ?>">
							<label class="control-label"><?php echo $prop_id ?></label>
						</td>
					</tr>
					<tr>
						<td>
							<label class="control-label">Client Name: </label>
						</td>
						<td>
							<b><?php echo $lname; ?>
							<?php echo $fname; ?>
							<?php echo $mname; ?>,</b>
						</td>
					</tr>
					<tr>
						<td>
							<label class="control-label">Credit/Debit: </label>
						</td>
						<td>
							<select name="cm" id="cm" class="form-control" tabindex ="6">
								<option value="CM" <?php echo isset($meta['cm_status']) && $meta['cm_status'] == "CM" ? 'selected': '' ?>>Credit</option>
								<option value="DM"<?php echo isset($meta['cm_status']) && $meta['cm_status'] == "DM" ? 'selected': '' ?>>Debit</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label>Date:</label>
						</td>
						<td>
							<input type="date" class="form-control required" name="cm_date" id="cm_date" value ="<?php echo date('Y-m-d') ?>" readonly>
						</td>
					</tr>
					<tr>
						<td>
							<label>Credit/Debit Amount: </label>
						</td>
						<td>
							<input type="number" class="form-control required" name="cm_amount" id="cm_amount" value="0">
						</td>
					</tr>
					<tr>
						<td>
							<label class="control-label">Reason: </label>
						</td>
						<td>
							<select class="form-control" name="cm_reason">
								<option value="bills_payment">Bills Payment</option>
								<option value="deletion">Deletion</option>
								<option value="overpayment" >Overpayment</option>
								<option value="overpayment" >Others</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>
							<label class="control-label">Reference: </label>
						</td>
						<td>
						<select name="cm_reference" id="cm_reference" class="form-control">
							<option value='' selected>Select</option>
							<?php
							foreach ($orData as $data) {
								if (!preg_match('/^[A-Za-z]/', $data)) { 
									echo "<option value='" . $data . "' " . (isset($data) && $data == $row['data'] ? 'selected' : '') . " >" . $data . "</option>";
								}
							}
							?>
						</select>
						</td>
					</tr>
				</table>
			</form>
		</div>
		<div class="card-footer">
			<table style="width:100%;">
				<tr>
					<td>
						<button class="btn btn-flat btn-default bg-maroon" form="manage-cm"  style="width:100%;margin-right:5px;font-size:14px;"><i class='fa fa-save'></i>&nbsp;&nbsp;Save</button>
					</td>
					<td>
						<a class="btn btn-flat btn-default" href="./?page=clients/payment_wdw&id=<?php echo md5($prop_id) ?>" style="width:100%;margin-left:5px;font-size:14px;"><i class='fa fa-times-circle'></i>&nbsp;&nbsp;Cancel</a>
					</td>
				</tr>
			</table>
		</div>
	</div>
</div>
<script>
function validateForm() {

	var errorCounter = 0;

	$(".required").each(function(i, obj) {

		if($(this).val() === ''){
			$(this).parent().addClass("has-error");
			errorCounter++;
		} else{ 
			$(this).parent().removeClass("has-error"); 
		}

	});
	
	return errorCounter;

}
$(document).ready(function(){

$('#manage-cm').submit(function(e){
	e.preventDefault();
	var _this = $(this)
	$('.err-msg').remove();
	
	var errorCounter = validateForm();
	if (errorCounter > 0) {
		alert_toast("It appear's you have forgotten to complete something!","warning");	  
		return false;
	}else{
		$(".required").parent().removeClass("has-error")
	}    
	start_loader();
	$.ajax({
			url:_base_url_+"classes/Master.php?f=save_cm",
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
					var el = $('<div>')
						el.addClass("alert alert-danger err-msg").text(resp.msg)
						_this.prepend(el)
						el.show('slow')
						end_loader()
				}else{
					alert_toast("An error occured",'error');
					end_loader();
					console.log(resp)
				}
			}
		})
	})
})
$(document).ready(function() {
  $('#cm_amount').on('input', function() {
    let inputValue = $(this).val().trim();
    let cmValue = $('#cm').val();
    if (inputValue.length > 0 && inputValue.charAt(0) !== '-') {
      if (cmValue === 'CM') {
        $(this).val('-' + inputValue);
      } else {
        $(this).val(inputValue.replace(/-/g, ''));
      }
    }
    let regex = /^-?\d*\.?\d*$/;
    if (!regex.test(inputValue)) {
      $(this).val(inputValue.replace(/[^-\d.]/g, ''));
    }
  });
  $('#cm').change(function() {
    let cmValue = $(this).val();
    let inputValue = $('#cm_amount').val().trim();

    if (cmValue === 'CM') {
      if (inputValue.length > 0 && inputValue.charAt(0) !== '-') {
        $('#cm_amount').val('-' + inputValue);
      }
    } else {
      $('#cm_amount').val(inputValue.replace(/-/g, ''));
    }
  });
});

</script>