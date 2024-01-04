
<?php
$delivery_date = date('Y-m-d', strtotime('+1 week'));
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `po_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
$is_new_po = true;

if (isset($_GET['id']) && $_GET['id'] > 0) {
    $existing_po_id = $_GET['id'];

    $qry = $conn->query("SELECT po_no FROM `po_list` WHERE id = $existing_po_id");
    if ($qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        $po_number = $row['po_no'];
        $is_new_po = false;
    } else {
        $po_number = 'Selected PO not found';
    }
} else {
    $qry = $conn->query("SELECT MAX(id) AS max_id FROM `po_list`");
    if ($qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        $next_po_number = $row['max_id'] + 1;
    } else {
        $next_po_number = 1;
    }
    $po_number = str_pad($next_po_number, 3, '0', STR_PAD_LEFT);
}

?>
<style>
	.ui-autocomplete {
		max-height: 200px; 
		overflow-y: auto;
		border: 1px solid #ccc; 
		background-color: white; 
		position: absolute; 
		z-index: 1000; 
	}

	.ui-menu-item {
		padding: 5px; 
		cursor: pointer; 
		list-style-type: circle;
	}

	.ui-menu-item:hover {
		background-color: #f0f0f0; 
	}

    span.select2-selection.select2-selection--single {
        border-radius: 0;
        padding: 0.25rem 0.5rem;
        padding-top: 0.25rem;
        padding-right: 0.5rem;
        padding-bottom: 0.25rem;
        padding-left: 0.5rem;
        height: auto;
    }
	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
	-webkit-appearance: none;
	margin: 0;
	}

	input[type=number] {
	-moz-appearance: textfield;
	}
	[name="tax_percentage"],[name="discount_percentage"]{
		width:5vw;
	}
	.nav-cpo{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-cpo:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
    .hidden-cell {
        display: none;
    }
	input{
		border:none;
		font-size: 12px!important;
	}
	.sup_cont,.r-container{
		display: none;
	}
	.form-control{
		font-size: 12px!important;
	}
	label{
		font-size: 13px!important;
	}
	.table{
		font-size: 12px!important;
	}
</style>
<!-- <style>
	.sup_cont{
		display: none !important;
	}	
</style> -->
<script>
document.addEventListener('change', function(event) {
	if (event.target.classList.contains('item-checkbox')) {
		var textboxId = 'item_status_' + event.target.dataset.rowid;
		var textbox = document.getElementById(textboxId);
		if (event.target.checked) {
			textbox.value = '0';
		} else {
			textbox.value = '1';
		}
		calculate();
	}
});
$(document).ready(function() {
    var level = <?php echo $level; ?>;
    var supplierValue = $('#supplier_id').val();
    var departmentValue = $('#department').val();
    var status2Val = <?php echo $status2; ?>;
    var status3Val = <?php echo $status3; ?>;

    if (level != 4) {
        $('input[name="qty[]"], input[name="default_unit[]"], input[name="item_id[]"], input[name="unit_price[]"]').prop('readonly', true);
        $('#delivery_date').prop('readonly', true);
		$('#discount_percentage').prop('readonly', true);
		$('#tax_percentage').prop('readonly', true);
		$('#discount_percentage, #tax_percentage').css('background-color', 'whitesmoke');
        $('#notes').prop('readonly', true);
		$('#receiver').prop('readonly', true);
		$('#receiver_contact_no').prop('readonly', true);
    }
	
});
$(document).ready(function() {
    $(".align-middle").each(function() {
        var itemStatusInput = $(this).find('input[name="item_status[]"]');
        var itemNotesTextarea = $(this).closest('tr').find('[name="item_notes[]"]');
        if (itemStatusInput.val() == '0') {
            $(this).find('.item-checkbox').prop('checked', true);
            //itemNotesTextarea.prop('readonly', true);
        } else {
            $(this).closest('tr').addClass('unchecked-row');
        }
    });
});
$(document).ready(function() {
    $('body').on('change', '.item-checkbox', function() {
        var itemStatusInput = $(this).closest('tr').find('[name="item_status[]"]');
        var itemNotesTextarea = $(this).closest('tr').find('[name="item_notes[]"]');

        itemStatusInput.val(this.checked ? 0 : 1);

        if (this.checked) {
            itemNotesTextarea.prop('readonly', true);
            $(this).closest('tr').removeClass('unchecked-row');
        } else {
            itemNotesTextarea.prop('readonly', false);
            $(this).closest('tr').addClass('unchecked-row');
        }
    });
});
document.addEventListener("DOMContentLoaded", function () {
		var statusDropdown = document.getElementById("status");
        var level = <?php echo $level; ?>;
		var selectedStatus = statusDropdown.value;

        if (level === 4) {
            var itemStatusInputs = document.querySelectorAll("input[name='item_status[]']");
			if (selectedStatus === "1") {
				itemStatusInputs.forEach(function (input) {
						if (input.value === "1") {
						input.value = "2";
					}
				});
				}else{
				itemStatusInputs.forEach(function (input) {
					if (input.value === "2") {
						input.value = "1";
					}
				});
			}
        }
    });
$(document).ready(function() {
    $(".align-middle").each(function() {
        var itemStatusInput = $(this).find('input[name="item_status[]"]');
        var itemNotesTextarea = $(this).closest('tr').find('[name="item_notes[]"]');
        if (itemStatusInput.val() == '0') {
            $(this).find('.item-checkbox').prop('checked', true);
        } else {

            $(this).closest('tr').addClass('unchecked-row');
        }
		
    });
});

$(document).ready(function() {
    $('body').on('change', '.item-checkbox', function() {
        var itemStatusInput = $(this).closest('tr').find('[name="item_status[]"]');
        var itemNotesTextarea = $(this).closest('tr').find('[name="item_notes[]"]');

        itemStatusInput.val(this.checked ? 0 : 1);

        if (this.checked) {

            $(this).closest('tr').removeClass('unchecked-row');
        } else {

            $(this).closest('tr').addClass('unchecked-row');
        }
    });
});
</script>

<?php
	$subtotal = 0;
	$usertype = $_settings->userdata('user_type'); 
	$type = $_settings->userdata('user_code');
	$level = $_settings->userdata('type');
?>
<body onload="calculate()">
<div class="card card-outline card-info">
	<div class="card-header">
		<h5 class="card-title"><b><i><?php echo isset($id) ? "Update Purchase Order": "New Purchase Order" ?></b></i></h5>
	</div>
	<div class="card-body">
		<form action="" id="po-form">
			<input type="hidden" value="<?php echo $level; ?>">
			<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
				<div class="card-body">
					<div class="sup_cont">
						<label for="supplier_id">Supplier:</label>
						<select name="supplier_id" id="supplier_id" class="custom-select custom-select-sm rounded-0 select2">
							<option value="" disabled <?php echo !isset($supplier_id) ? "selected" : '' ?>></option>
							<?php 
							$supplier_qry = $conn->query("SELECT * FROM `supplier_list` WHERE status = 1 ORDER BY `name` ASC");
							while ($row = $supplier_qry->fetch_assoc()):
								//$vatable = $row['vatable'];
							?>
							<option 
								value="<?php echo $row['id'] ?>" 
								data-vatable="<?php echo $vatable ?>"
								<?php echo isset($supplier_id) && $supplier_id == $row['id'] ? 'selected' : '' ?> <?php echo $row['status'] == 0? 'disabled' : '' ?>
							><?php echo $row['name'] ?></option>
							<?php endwhile; ?>
						</select>
					</div>
					<div class="row">
						<div class="col-md-6 form-group">
							<label><b>Supplier:</b></label>
							<?php 
							$supplier_qry = $conn->query("SELECT * FROM supplier_list where id = '{$supplier_id}'");
							while ($row = $supplier_qry->fetch_assoc()):
								//$vatable = $row['vatable'];
							?>
							<div>
								<p class="m-0"><input type="hidden" id="supplier_id" name="supplier_id" value="<?php echo $row['id'] ?>"></p>
								<input type="text" class="form-control form-control-sm rounded-0" value="<?php echo $row['name'] ?>" readonly>
							</div>
							<?php endwhile; ?>
						</div>
					<div class="col-md-6 form-group">
						<input type="hidden" name ="po_id" value="<?php echo $id; ?>">
						<label for="po_no">P.O. #: <span class="po_err_msg text-danger"></span></label>
						<input type="text" class="form-control form-control-sm rounded-0" id="po_no" name="po_no" value="<?php echo $po_number; ?>" readonly>
					</div>
				</div>

					<div class="row">
						<div class="col-md-6 form-group">
						<label><b>Requesting Department:</b></label>
                    	<p><input type="text" class="form-control form-control-sm rounded-0" value="<?php echo isset($department) ? $department : '' ?>" id="department" name="department" readonly></p>
						</div>
						<div class="col-md-6 form-group">
							<label for="department">Delivery Date:</label>
							<?php
							$formattedDate = date('Y-m-d', strtotime($delivery_date)); ?>
							<input type="date" class="form-control form-control-sm rounded-0" id="delivery_date" name="delivery_date" value="<?php echo isset($formattedDate) ? $formattedDate : '' ?>">
						</div>
					</div>
				</div>
				<hr>
				<?php 
					$receiver_qry = $conn->query("SELECT * FROM users where user_code = '{$receiver_id}'");
					$receiver2_qry = $conn->query("SELECT * FROM users where user_code = '{$receiver2_id}'");
					$receiver = $receiver_qry->fetch_array();
					$receiver2 = $receiver2_qry->fetch_array();
				?>
				<div class="card-body">
					<div class="row">
							<?php if ($receiver !== null): ?>
							<div class="col-md-6 form-group">
								<label for="receiver">Receiver 1:</label>
								<div class="form-group">
									<input type="text" class="form-control form-control-sm rounded-0" value="<?php echo $receiver['firstname'] ?> <?php echo $receiver['lastname'] ?>" readonly></p>
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label for="contact_no1">Contact #:</label>
								<input type="text" class="form-control form-control-sm rounded-0" value="<?php echo $receiver['phone'] ?>" readonly>
							</div>
							<?php else: ?>
								<p class="m-0"></p>
							<?php endif; ?>

							<?php if ($receiver2 !== null): ?>
								<div class="col-md-6 form-group">
									<label for="receiver">Receiver 2:</label>
									<div class="form-group">
										<input type="text" class="form-control form-control-sm rounded-0" value="<?php echo $receiver2['firstname'] ?> <?php echo $receiver2['lastname'] ?>" readonly></p>
									</div>
								</div>
								<div class="col-md-6 form-group">
									<label for="contact_no2">Contact #:</label>
									<input type="text" class="form-control form-control-sm rounded-0" value="<?php echo $receiver2['phone'] ?>" readonly>
								</div>
							<?php else: ?>
								<p class="m-0"></p>
							<?php endif; ?>
						</div>
					<div class="r-container">
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="receiver">Receiver 1:</label>
								<select name="receiver_id" id="receiver_id" class="custom-select custom-select-sm rounded-0 select2" required>
									<?php 
									$receiver_qry = $conn->query("SELECT * FROM `users`");
									$isReceiverIdZero = isset($receiver_id) && $receiver_id == 0;
									?>
									<option value="" <?php echo $isReceiverIdZero ? "selected" : '' ?>></option>
									<?php 
									while($row = $receiver_qry->fetch_assoc()):
										$recValue = $row['firstname'] . ' ' . $row['lastname'];
									?>
									<option 
										value="<?php echo $row['user_code'] ?>" 
										data-contact1="<?php echo $row['phone'] ?>"
										<?php echo isset($receiver_id) && $receiver_id == $row['user_code'] ? 'selected' : '' ?>>
										<?php echo $recValue ?></option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-md-6 form-group">
								<label for="contact_no1">Contact #:</label>
								<input type="text" class="form-control form-control-sm rounded-0" id="contact_no1" value="<?php echo isset($contact_no1) ? $contact_no1 : '' ?>" readonly>
							</div>
							<div class="col-md-6 form-group">
								<label for="receiver">Receiver 2:</label>
								<select name="receiver2_id" id="receiver2_id" class="custom-select custom-select-sm rounded-0 select2">
									<option value="" disabled <?php echo !isset($receiver2_id) ? "selected" : '' ?>></option>
									<?php 
									$receiver2_qry = $conn->query("SELECT * FROM `users`");
									$isReceiverIdZero2 = isset($receiver2_id) && $receiver2_id == 0;
									?>
									<option value="" <?php echo $isReceiverIdZero2 ? "selected" : '' ?>></option>
									<?php 
									while($row = $receiver2_qry->fetch_assoc()):
										$recValue2 = $row['firstname'] . ' ' . $row['lastname'];
									?>
									<option 
										value="<?php echo $row['user_code'] ?>" 
										data-contact2="<?php echo $row['phone'] ?>"
										<?php echo isset($receiver2_id) && $receiver2_id == $row['user_code'] ? 'selected' : '' ?>>
										<?php echo $recValue2 ?></option>
									<?php endwhile; ?>
								</select>
							</div>

							<div class="col-md-6 form-group">
								<label for="contact_no2">Contact #:</label>
								<input type="text" class="form-control form-control-sm rounded-0" id="contact_no2" value="<?php echo isset($contact_no2) ? $contact_no2 : '' ?>" readonly>
							</div>
						</div>
					</div>
			<!-- <div>Please deselect the item you wish to remove and provide your justification in the notes section for removing the item.</div> -->
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered" id="item-list" style="width:100%">
						<colgroup>
							<col width="5%">
							<col width="10%">
							<col width="25%">
							<col width="20%">
							<col width="10%">
							<col width="10%">
							<!-- <col width="10%"> -->
							<col width="5%">
							<col width="25%">
						</colgroup>
						<thead>
							<tr class="bg-navy disabled">
								<?php if($level == 4 and ($fpo_status != 3)): ?>
									<th class="px-1 py-1 text-center"></th>
								<?php endif; ?>
								<th class="px-1 py-1 text-center">Qty</th>
								<th class="px-1 py-1 text-center">Unit</th>
								<th class="px-1 py-1 text-center">Item</th>
								<th class="px-1 py-1 text-center">Description</th>
								<th class="px-1 py-1 text-center">Price before Tax</th>
								<th class="px-1 py-1 text-center">Total</th>
								<!-- <th class="px-1 py-1 text-center">Vat Amount</th> -->
								<th class="px-1 py-1 text-center">Select</th>
								<th class="px-1 py-1 text-center">Note</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if(isset($id)):
							$order_items_qry = $conn->query("SELECT o.*,i.name, i.description FROM `order_items` o inner join item_list i on o.item_id = i.id where o.`po_id` = '$id' and o.item_status != 2 ");
							echo $conn->error;
							while($row = $order_items_qry->fetch_assoc()):
							?>
							<tr class="po-item" data-id="">
							<?php if($level == 4 and ($fpo_status != 3)): ?>
								<td class="align-middle p-1 text-center">
									<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
								</td>
							<?php endif; ?>
								<td class="align-middle p-0 text-center">
									<input type="number" class="text-center w-100 border-0" step="any" name="qty[]" value="<?php echo $row['quantity'] ?>" style="background-color:transparent" readonly/>
								</td>
								<!-- <td class="align-middle p-1">
									<input type="text" class="text-center w-100 border-0" name="unit[]" value="<?php echo $row['unit'] ?>"/>
								</td> -->
								<!-- <td class="align-middle p-1 item-unit"><?php echo $row['default_unit'] ?></td> -->
								<td class="align-middle p-0 text-center">
									<input type="text" class="align-middle p-1 item-unit" step="any" name="default_unit[]" value="<?php echo $row['default_unit'] ?>" style="background-color:transparent"/>
								</td>
								<td class="align-middle p-1">
									<input type="hidden" name="item_id[]" value="<?php echo $row['item_id'] ?>">
									<input type="text" class="text-center w-100 border-0 item_id" id="item" value="<?php echo $row['name'] ?>" style="background-color:transparent" required/>
								</td>
								<td class="align-middle p-1 item-description">
									<?php echo $row['description'] ?>
								</td>
								<td class="align-middle p-1">
									<input type="text" class="align-middle p-1 item-price" step="any" name="unit_price[]" value="<?php echo $row['unit_price'] ?>" style="background-color:transparent"/>
								</td>
									<td class="align-middle p-1 text-right"><?php echo number_format($row['quantity'] * $row['unit_price'],2) ?>
								</td>
								
									<input type="hidden" class="text-center w-100 border-0 item-vat" name="vat_included[]" readonly>
								
								<td class="align-middle p-0 text-center">
									<input type="checkbox" class="item-checkbox" data-rowid="<?php echo $row['id'] ?>">
									<input type="hidden" name="item_status[]" id="item_status_<?php echo $row['id'] ?>" value="<?php echo $row['item_status'] ?>">
								</td>

								<td class="align-middle p-0 text-center">
									<textarea id="item_notes" name="item_notes[]"><?php echo empty($row['item_notes']) ? '' : $row['item_notes']; ?></textarea>
								</td>
							</tr>
							<?php endwhile;endif; ?>
						</tbody>
						<tfoot>
							<tr class="bg-lightblue">
								<tr>
									<th class="p-1 text-right" colspan="5">
										Sub-Total
									</th>
									<th class="p-1 text-right" id="sub_total">0</th>
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="5">
									VAT</th>
									<th class="p-1 text-right" id="vat_total" name="tax_amount" value="<?php echo isset($tax_amount) ? $tax_amount : 0 ?>">0</th>
									<input type="text" id="copytax" name="tax_amount" value="<?php echo isset($tax_amount) ? $tax_amount : 0 ?>">
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="5">Total:</th>
									<th class="p-1 text-right" id="total">0</th>
								</tr>
								<tr>
									<table class="table-bordered">
										<tr style="padding-left:150px;align-items: center;text-align: center;">
											<td>
												<input type="radio" class="form-check-input" id="nonVatRadio" name="vatType" value="nonvat" onchange="updateValue()"/>
												<label for="nonVatRadio">Non-VAT</label>
											</td>
											<td>
												<input type="radio" class="form-check-input" id="zeroRatedRadio" name="vatType" value="zerorated" onchange="updateValue()"/>
												<label for="zeroRatedRadio">Zero-Rated</label>
											</td>
											<td>
												<input type="radio" class="form-check-input" id="inclusiveRadio" name="vatType" value="inclusive" onchange="updateValue()"/>
												<label for="inclusiveRadio">Inclusive</label>
											</td>
											<td>
												<input type="radio" class="form-check-input" id="exclusiveRadio" name="vatType" value="exclusive" onchange="updateValue()"/>
												<label for="exclusiveRadio">Exclusive</label>
											</td>
										</tr>
										<input type="text" id="rdoText" name="vatable" value="<?php echo $vatable ?>">
									</table>
								</tr>
							</tr>
						</tfoot>
					</table>
					<div class="row">
                        <div class="col-md-12">
							<label for="notes" class="control-label">Notes:</label>
							<textarea name="notes" id="notes" cols="10" rows="4" class="form-control rounded-0"><?php echo isset($notes) ? $notes : '' ?></textarea>
						</div>
					</div>
					<div class="form-group">
						<input type="hidden" value="<?php echo $level; ?>" name="level">
						<input type="hidden" value="0" name="selected_index">
						<label for="status">Status:</label>

						<!-- Purchasing Officer -->
						<?php if ($level == 4) { ?>
							<select name="status" id="status" class="form-control">
								<option value="0"></option>
								<option value="1" <?php echo $status == 1 ? 'selected' : ''; ?>>Approved</option>
								<option value="2" <?php echo $status == 2 ? 'selected' : ''; ?>>Declined</option>
								<option value="3" <?php echo $status == 3 ? 'selected' : ''; ?>>For Review</option>
							</select>


						<!-- Finance Manager -->
						<?php } elseif ($level == 3) { ?>
							<select name="status2" id="status2" class="form-control">
								<option value="0"></option>
								<option value="1" <?php echo $status2 == 1 ? 'selected' : ''; ?>>Approved</option>
								<option value="2" <?php echo $status2 == 2 ? 'selected' : ''; ?>>Declined</option>
								<option value="3" <?php echo $status2 == 3 ? 'selected' : ''; ?>>For Review</option>
							</select>

						<!-- COO/CFO -->
						<?php } elseif ($level == 2) { ?>
							<select name="status3" id="status3" class="form-control">
								<option value="0"></option>
								<option value="1" <?php echo $status3 == 1 ? 'selected' : ''; ?>>Approved</option>
								<option value="2" <?php echo $status3 == 2 ? 'selected' : ''; ?>>Declined</option>
								<option value="3" <?php echo $status3 == 3 ? 'selected' : ''; ?>>For Review</option>
							</select>
						<?php } ?>
					</div>
			    </div>
            </div>
		</form>
	</div>

	<div class="card-footer">
		<table style="width:100%;">
			<tr>
				<td>
					<button class="btn btn-flat btn-default bg-maroon" form="po-form" style="width:100%;margin-right:5px;font-size:14px;"><i class='fa fa-save'></i>&nbsp;&nbsp;Save</button>
				</td>
				<td>
					<a class="btn btn-flat btn-default" href="?page=po/purchase_orders/" style="width:100%;margin-left:5px;font-size:14px;"><i class='fa fa-times-circle'></i>&nbsp;&nbsp;Cancel</a>
				</td>
			</tr>
		</table>
	</div>
</div>
<table class="d-none" id="item-clone">
	<tr class="po-item" data-id="">
	<?php if($level == 4 and ($fpo_status != 3)): ?>
		<td class="align-middle p-1 text-center">
			<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
		</td>
	<?php endif; ?>
		<td class="align-middle p-0 text-center">
			<input type="number" class="text-center w-100 border-0" step="any" name="qty[]" required/>
		</td>

			<!-- <input type="text" class="text-center w-100 border-0" name="unit[]" required/> -->
		<!-- <td class="align-middle p-1 item-unit"></td> -->
		<td class="align-middle p-1 item-unit">
			<input type="text" class="text-right w-100 border-0 item-unit" name="default_unit[]">
		</td>
		<td class="align-middle p-1">
			<input type="hidden" name="item_id[]">
			<input type="text" class="text-center w-100 border-0 item_id" id="item" required/>
		</td>
		<td class="align-middle p-1 item-description"></td>
		<td class="align-middle p-1">
			<input type="text" class="text-right w-100 border-0 item-price" name="unit_price[]">
		</td>
		<td class="align-middle p-1">
			<input type="text" class="text-center w-100 border-0 item-vat" name="vat_included[]" style="background-color:red;" readonly>
		</td>
		<td class="align-middle p-1 text-right total-price">0</td>
		<td class="align-middle p-0 text-center">
			<input type="checkbox" class="item-checkbox">
			<input type="hidden" name="item_status[]" id="item_status_<?php echo $row['id'] ?>">
		</td>
		<td class="align-middle p-0 text-center">
			<textarea name="item_notes[]" id="item_notes"></textarea>
		</td>
	</tr>
</table>
<script>
	document.addEventListener("DOMContentLoaded", function() {

		updateValueOnPageLoad();
	});

	function updateValueOnPageLoad() {

		var rdoTextValue = document.getElementById('rdoText').value;


		if (rdoTextValue == 1) {
			document.getElementById('inclusiveRadio').checked = true;
		} else if (rdoTextValue == 2) {
			document.getElementById('exclusiveRadio').checked = true;
		} else if (rdoTextValue == 3) {
			document.getElementById('nonVatRadio').checked = true;
		} else if (rdoTextValue == 4) {
			document.getElementById('zeroRatedRadio').checked = true;
		}else {
			document.getElementById('inclusiveRadio').checked = false;
			document.getElementById('exclusiveRadio').checked = false;
			document.getElementById('nonVatRadio').checked = false;
			document.getElementById('zeroRatedRadio').checked = false;
		}
		updateValue();
	}
	
	function updateValue() {
		var radioValue = document.querySelector('input[name="vatType"]:checked').value;
		var textBox = document.getElementById('rdoText');


		if (radioValue === 'inclusive') {
			textBox.value = 1;
		} else if (radioValue === 'exclusive') {
			textBox.value = 2;
		}else if (radioValue === 'nonvat') {
			textBox.value = 3;
		}else if (radioValue === 'zerorated') {
			textBox.value = 4;
		}else{
			textBox.value = 0;
		}
	}
</script>
<script>

	$(document).ready(function() {
		function updateContactInfo() {
			var selectedOption = $('#receiver_id').find(':selected');
			var contactNumber = selectedOption.data('contact1');
			$('#contact_no1').val(contactNumber);
		}
		updateContactInfo();
		$('#receiver_id').change(function() {
			updateContactInfo();
		});
	});

	$(document).ready(function() {
		function updateContactInfo() {
			var selectedOption = $('#receiver2_id').find(':selected');
			var contactNumber = selectedOption.data('contact2');
			$('#contact_no2').val(contactNumber);
		}

		updateContactInfo();
		$('#receiver2_id').change(function() {
			updateContactInfo();
		});
	});



	$(document).ready(function() {
		$('body').on('change', '.item-checkbox', function() {
			var itemStatusInput = $(this).closest('tr').find('[name="item_status[]"]');

			itemStatusInput.val(this.checked ? 0 : 1);
		});
	});



	function rem_item(_this){
		_this.closest('tr').remove()
		calculate();
	}
	function calculate() {
    var _total = 0;
    var _vat_total = 0;
    var rdoText = document.getElementById('rdoText').value;

    $('.po-item').each(function () {
        var qty = parseFloat($(this).find('[name="qty[]"]').val()) || 0;
        var unit_price = parseFloat($(this).find('[name="unit_price[]"]').val()) || 0;
        var item_status = $(this).find("[name='item_status[]']").val();
        var row_total = 0;
        var result = 0;

        if (item_status !== "1" && item_status !== "2" && qty > 0 && unit_price > 0) {
            row_total = parseFloat(qty) * parseFloat(unit_price);
        }

        if (rdoText === "1") {
            result = (qty * unit_price) / 1.12 * 0.12;
        } else if (rdoText === "2") {
            result = qty * unit_price * 0.12;
        }
		if (item_status !== "1" && item_status !== "2" && qty > 0 && unit_price > 0) {
            _vat_total += result;
        }
        _total += row_total;
        

        $(this).find('[name="vat_included[]"]').val(result.toFixed(2));
        $(this).find('.total-price').text(parseFloat(row_total).toLocaleString('en-US'));
    });

    $('#sub_total').text(parseFloat(_total).toLocaleString("en-US"));
    $('#vat_total').text(parseFloat(_vat_total).toLocaleString("en-US"));

	if (rdoText === "2") {
		$('#total').text(parseFloat(_total + _vat_total).toLocaleString("en-US"));
    } else {
		$('#total').text(parseFloat(_total).toLocaleString("en-US"));
    }
}


$('input[name="vatType"]').change(function() {
    calculate();
});

	var selectedSupplierId; 

	$(document).ready(function() {
		selectedSupplierId = $("#supplier_id").val();

	_autocomplete(item, selectedSupplierId);
	});
	function _autocomplete(_item, supplierId) {
    _item.find('.item_id').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=search_items",
                method: 'POST',
                data: {
                    q: request.term,
                    supplier_id: selectedSupplierId
                },
				dataType: 'json',
				error: err => {
					console.log(err);
				},
				success: function(resp) {
					console.log("Supplier ID from PHP:", resp.supplier_id);
					response(resp.items); 
				}
            });
        },
			select: function(event, ui) {
				console.log(ui)
				_item.find('input[name="item_id[]"]').val(ui.item.id)
				_item.find('.item-description').text(ui.item.description)
				_item.find('.item-unit').val(ui.item.default_unit);
				_item.find('.item-price').val(ui.item.unit_price || 0);
			}
		})
	}

	var item = $('#item');

	$(document).ready(function() {
		$("#supplier_id").change(function() {
			selectedSupplierId = $(this).val();
			selectedSupplierId = parseInt($(this).val(), 10);

			console.log("Selected Supplier ID: " + selectedSupplierId);
			_autocomplete(item, selectedSupplierId);
		});
	});

	
	
	$(document).ready(function(){
		$('#add_row').click(function(){
			var tr = $('#item-clone tr').clone()
			$('#item-list tbody').append(tr)
			_autocomplete(tr)
			tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress',function(e){
				calculate()
			})
			$('#item-list tfoot').find('[name="discount_percentage"],[name="tax_percentage"]').on('input keypress',function(e){
				calculate()
			})
		})
		if($('#item-list .po-item').length > 0){
			$('#item-list .po-item').each(function(){
				var tr = $(this)
				_autocomplete(tr)
				tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress',function(e){
					calculate()
				})
				$('#item-list tfoot').find('[name="discount_percentage"],[name="tax_percentage"]').on('input keypress',function(e){
					calculate()
				})
				tr.find('[name="qty[]"],[name="unit_price[]"]').trigger('keypress')
			})
		}else{
		$('#add_row').trigger('click')
		}
        $('.select2').select2({placeholder:"Please Select here",width:"relative"})
		$('#po-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			$('.err-msg').remove();
			$('[name="po_no"]').removeClass('border-danger')
			if($('#item-list .po-item').length <= 0){
				alert_toast(" Please add atleast 1 item on the list.",'warning')
				return false;
			}
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=update_status_po",
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
						location.href = "./?page=cfo_purchase_orders";
					}else if((resp.status == 'failed' || resp.status == 'po_failed') && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: 0 }, "fast");
                            end_loader()
							if(resp.status == 'po_failed'){
								$('[name="po_no"]').addClass('border-danger').focus()
							}
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})
	})
</script>
<script>
function updateSelectedIndex() {
    var selectedIndexInput = document.querySelector('input[name="selected_index"]');
    
    var selectedValue;
    if (<?php echo $level; ?> == 4) {
      selectedValue = document.querySelector('#status').value;
    } else if (<?php echo $level; ?> == 3) {
      selectedValue = document.querySelector('#status2').value;
    } else if (<?php echo $level; ?> == 2) {
      selectedValue = document.querySelector('#status3').value;
    }
    selectedIndexInput.value = selectedValue;
  }

  document.addEventListener('DOMContentLoaded', function () {
    updateSelectedIndex();
    
    var statusDropdowns = document.querySelectorAll('select[name^="status"]');
    statusDropdowns.forEach(function (dropdown) {
      dropdown.addEventListener('change', updateSelectedIndex);
    });
  });
</script>
<script>
document.addEventListener('change', function(event) {
    if (event.target.classList.contains('item-checkbox')) {
        var textboxId = 'item_status_' + event.target.dataset.rowid;
        var textbox = document.getElementById(textboxId);
        var userlevel = <?php echo $level; ?>; 
        if (event.target.checked) {
            textbox.value = '0';
        } else {
            if (userlevel === 4) { 
                textbox.value = '2';
            } else {
                textbox.value = '1';
            }
        }
    }
});


</script>
