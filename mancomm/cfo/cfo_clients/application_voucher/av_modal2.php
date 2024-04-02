<?php 
/* include '../../config.php'; */
require_once('../../../config.php');
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php
$usertype = $_settings->userdata('user_type');
if (!isset($usertype)) {
    include '404.html';
  exit;
}

$user_role = $usertype;

if ($user_role != 'IT Admin') {
    include '404.html';
  exit;
}

?>
<?php
if(isset($_GET['id'])){
    $prop_id = $_GET['id'];
    $payments = $conn->query("SELECT * FROM property_payments WHERE payment_amount != 0 and property_id =" . $prop_id);

    if ($payments) {
    $payRow = $payments->fetch_array();
    foreach ($payRow as $k => $v) {
        $meta[$k] = $v;
    }
    }
}
?>

<div class="card card-outline rounded-0 card-maroon">
<h3 class="card-title" style="padding-top:10px; padding-left:10px;"><b>Application Voucher ID#: <i><?php echo $prop_id ?></i> </b></h3>
    <div class="table-responsive">
    <h4>Item Form:</h4>
        <div class="row align-items-end">
     
            <div class="col-md-2">
                <div class="form-group">
                    <label for="or_no" class="control-label">OR No</label>
                    <input type="text" id="or_no"  class="form-control">
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="amt_paid" class="control-label">Amount Paid</label>
                    <input type="number"  id="amount_paid"  class="form-control text-right">
                </div>
            </div>
            <div class="col-md-2 pb-1">
                <div class="form-group">
                    <button class="btn btn-flat btn-default bg-maroon" type="button" id="add_item"><i class="fa fa-plus"></i> Add</button>
                </div>
            </div>
        </div>

        <div class="row">
					<div class="col-md-12">
						<table class="table table-bordered" id="item-list">
							<colgroup>
								<col width="10%">
								<col width="15%">
								<col width="30%">
								<col width="15%">
								<col width="15%">
								<col width="5%">
							</colgroup>
							<thead>
								<tr>
                                    <th>Payment Amt</th>
                                    <th style="width:25%;">Pay Date</th>
                                    <th style="width:25%;">Due Date</th>
                                    <th>OR No</th>
                                    <th style="width:20%;">Amt Due</th>
                                    <th>Interest</th>
                                    <th>Rebate</th>
                                    <th>Surcharge</th>
                                    <th>Principal</th>
                                    <th>Remaining Balance</th>
                                    <th>Status</th>
						
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th class="text-right" colspan="4">Sub Total</th>
									<th class="text-right" id="sub_total">0</th>
									<th><input type="hidden" name="sub_total" value="0"></th>
								</tr>
								<tr>
									<th class="text-right" colspan="4">Tax Rate</th>
									<th class="text-right" id="tax_rate"></th>
									<th><input type="hidden" name="tax_rate" value=""></th>
								</tr>
								<tr>
									<th class="text-right" colspan="4">Tax</th>
									<th class="text-right" id="tax">0</th>
									<th></th>
								</tr>
								<tr>
									<th class="text-right" colspan="4">Grand Total</th>
									<th class="text-right" id="gtotal">0</th>
									<th><input type="hidden" name="total_amount" value="0"></th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-7">
						<div class="form-group">
							<label for="remarks" class="control-label">Remarks</label>
							<textarea name="remarks" id="" cols="30" rows="2" class="form-control form no-resize summernote"><?php echo isset($remarks) ? $remarks : ''; ?></textarea>
						</div>
					</div>
				</div>
    
    </div>
</div>