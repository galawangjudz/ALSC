<?php 
include '../../../config.php';
if($_settings->chk_flashdata('success')): ?>
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
.not-bold-label {
    font-weight: normal!important;
}
</style>

<?php
$originalId = $_GET['id'];
$newId = substr($originalId, 2); 
	if (isset($_GET['id'])) {
		$prop = $conn->query("SELECT y.*, z.*, x.* FROM t_credit_memo AS y INNER JOIN property_payments AS z ON y.reference = z.or_no INNER JOIN
        property_clients AS x ON z.property_id = x.property_id WHERE y.reference = '{$_GET['id']}' or y.cm_id = '{$newId}'");    
        
		while($row=$prop->fetch_assoc()){
			$cm_id = $row['cm_id'];
            $prop_id = $row['property_id'];
            $cm_ref = $row['reference'];
            $lname = $row['last_name'];
            $fname = $row['first_name'];
            $mname = $row['middle_name'];
            $cm_date = $row['cm_date'];
            $cm_amount = $row['credit_amount'];
            $cm_reason = $row['reason'];
			}
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
							<label class="control-label">Credit/Debit Memo #: </label>
						</td>
						<td>
							<input type="hidden" name="cm_id" id="cm_id" value="<?php echo $cm_id ?>">
							<label class="control-label"><?php echo $cm_id ?></label>
						</td>
					</tr>
                    <tr>
						<td>
							<label class="control-label">Property ID: </label>
						</td>
						<td>
                            <label><?php echo $prop_id ?></label>
						</td>
					</tr>
                    <tr>
						<td>
							<label class="control-label">Client Name: </label>
						</td>
						<td>
							<?php echo $lname; ?>
							<?php echo $fname; ?>
							<?php echo $mname; ?>,
						</td>
					</tr>
                    
                    <tr>
						<td>
							<label class="control-label">Reference #: </label>
						</td>
						<td>
							<labe class="not-bold-label"><?php echo $cm_ref ?></label>
						</td>
					</tr>
					
					<tr>
						<td>
							<label class="control-label">Date:</label>
						</td>
						<td>
                            <label class="not-bold-label"><?php echo $cm_date; ?></label>
						</td>
					</tr>
					<tr>
						<td>
							<label class="control-label">Credit/Debit Amount: </label>
						</td>
                        <td>
                            <span class="not-bold-label"><?php echo number_format($cm_amount, 2, '.', ','); ?></span>
                        </td>
					</tr>
					<tr>
						<td>
							<label class="control-label">Reason: </label>
						</td>
						<td>
							<select class="form-control" name="cm_reason">
								<option value="bills_payment" <?php if($cm_reason == 'bills_payment') echo 'selected'; ?>>Bills Payment</option>
								<option value="deletion" <?php if($cm_reason == 'deletion') echo 'selected'; ?>>Deletion</option>
								<option value="overpayment" <?php if($cm_reason == 'overpayment') echo 'selected'; ?>>Overpayment</option>
							</select>
						</td>
					</tr>
					
				</table>
			</form>
		</div>
		
	</div>
</div>