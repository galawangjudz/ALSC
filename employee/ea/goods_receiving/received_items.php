<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `po_approved_list` where id = '{$_GET['id']}'");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
			
        }
		$vatableValue = $vatable;
    }
//echo $vatableValue;
}
?>

<style>
    .readonly-row {
        background-color: #f0f0f0;
    }
    .select-readonly {
        pointer-events: none;
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
	.nav-gr{
	background-color:#007bff;
	color:white!important;
	box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-gr:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
</style>
<?php
	$usertype = $_settings->userdata('position'); 
	$type = $_settings->userdata('user_code');
	$level = $_settings->userdata('type');
	$dept = $_settings->userdata('department');

?>
<?php
$query = $conn->query("SELECT COUNT(DISTINCT gr_id) AS max_doc_no FROM `tbl_gl_trans` WHERE doc_type = 'GR'");

if ($query) {
    $row = $query->fetch_assoc();
    $maxDocNo = $row['max_doc_no'];
    $newDocNo = '1' . sprintf('%05d', $maxDocNo + 1);

   // echo $newDocNo;
} else {
    echo "Error executing query: " . $conn->error;
}

$qry = $conn->query("SELECT MAX(v_num) AS max_id FROM `vs_entries`");
if ($qry->num_rows > 0) {
	$row = $qry->fetch_assoc();
	$next_v_number = $row['max_id'] + 1;
} else {
	$next_v_number = 1;
}
$v_number = str_pad($next_v_number, STR_PAD_LEFT);

//echo $v_number;
?>


<script>
$(document).ready(function() {
    var type = <?php echo json_encode($type); ?>;
    var receiverId = <?php echo json_encode($receiver_id); ?>;
    var receiver2Id = <?php echo json_encode($receiver2_id); ?>;

    function toggleDelItemsReadonly(isClosed) {
        var isDisabled = (type !== receiverId) && (type !== receiver2Id);

        $('input[name="del_items[]"]').prop('readonly', isClosed || isDisabled); 
        if (isClosed && isDisabled) {
            $('input[name="del_items[]"]').closest('tr').addClass('readonly-row');
        } else {
            $('input[name="del_items[]"]').closest('tr').removeClass('readonly-row');
        }
    }

    var initialStatus = $('#status').val();
    toggleDelItemsReadonly(initialStatus === '0');

    $('#status').on('change', function() {
        var selectedStatus = $(this).val();
        toggleDelItemsReadonly(selectedStatus === '0');
    });
});

</script>


<div class="card card-outline card-info">
	<div class="card-header">
		<form action="" id="po-form">
		<h3 class="card-title"><b><i><?php echo isset($id) ? "Update Purchase Order Details": "New Purchase Order" ?></b></i></h5>
		<div class="card-tools">
			<button class="btn btn-sm btn-flat btn-success" id="print" type="button" style="font-size:14px;float:right;margin-left:5px;"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</button>
		</div>
	</div>
	<div class="card-body" id="out-print">
		<input type="hidden" name ="vatableValue" value="<?php echo $vatableValue ?>">
		<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="row">
			<div class="col-6 d-flex align-items-center">
				<div>
				<h2><label style="backround-color:red;">GOODS RECEIVED</h2>
					<p class="m-0"><b><?php echo $_settings->info('company_name') ?></b></p>
					<p class="m-0"><?php echo $_settings->info('company_email') ?></p>
					<p class="m-0"><?php echo $_settings->info('company_address') ?></p>
				</div>
			</div>
			<div class="col-6">
				<img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" height="200px" style="float:right;">
			</div>
		</div>
		<div class="row mb-2">
			<div class="col-6">
				<p class="m-0"><b>Vendor:</b></p>
				<?php 
				$sup_qry = $conn->query("SELECT * FROM supplier_list where id = '{$supplier_id}'");
				$supplier = $sup_qry->fetch_array();
				?>
				<div>
					<p class="m-0"><input type="hidden" id="supplier_id" name="supplier_id" value="<?php echo $supplier['id'] ?>"></p>
					<p class="m-0"><b><?php echo $supplier['name'] ?></b></p>
					<p class="m-0"><?php echo $supplier['address'] ?></p>
					<p class="m-0"><?php echo $supplier['contact_person'] ?></p>
					<p class="m-0"><?php echo $supplier['contact'] ?></p>
					<p class="m-0"><?php echo $supplier['email'] ?></p>
				</div>
			</div>
			<div class="col-6 row">
				<div class="col-6">
					<p  class="m-0"><b>G.R. #:</b></p>
						<?php 
							$gr_qry = $conn->query("SHOW TABLE STATUS LIKE 'tbl_gr_list'");
							$gl_qry = $conn->query("SHOW TABLE STATUS LIKE 'tbl_gl_list'");

							$gr = $gr_qry->fetch_assoc();
							$gl = $gl_qry->fetch_assoc();

							$max_gr_id = sprintf("%03d", $gr['Auto_increment']);
							$max_gl_id = sprintf("%03d", $gl['Auto_increment']);
						?>
						<p>GR - <input type="text" value="<?php echo $max_gr_id ?>" id="gr_no" name="gr_no" style="border:none;color:black;pointer-events:none;"></p>
					<p  class="m-0"><b>P.O. #:</b></p>
					<p><input type="text" value="<?php echo $po_no ?>" id="po_no" name="po_no" style="border:none;color:black;pointer-events:none;"></p>

					<p  class="m-0"><b>Requesting Department:</b></p>
					<p><input type="text" value="<?php echo isset($department) ? $department : '' ?>" id="department" name="department" style="border:none;color:black;pointer-events:none;"></p>
					<input type="hidden" id="po_id" name="po_id" value="<?php echo $id; ?>">
					<input type="hidden" id="usertype" name="usertype" value="<?php echo $usertype; ?>">
				</div>
				<div class="col-6">
					<p  class="m-0"><b>Date Created:</b></p>
					<p><input type="text" value="<?php echo date("F j, Y",strtotime($date_created)) ?>" style="border:none;color:black;pointer-events:none;"></p>

					<p  class="m-0"><b>Requested Delivery Date:</b></p>
					<p><input type="text" value="<?php echo date("F j, Y",strtotime($delivery_date)) ?>" style="border:none;color:black;pointer-events:none;"></p>
				</div>
			</div>
    	</div>	
		<br>
        <?php 
            $receiver_qry = $conn->query("SELECT * FROM users where user_code = '{$receiver_id}'");
            $receiver2_qry = $conn->query("SELECT * FROM users where user_code = '{$receiver2_id}'");
            $receiver = $receiver_qry->fetch_array();
            $receiver2 = $receiver2_qry->fetch_array();
        ?>
        <hr>
        <p class="m-0"><b>Ship To:</b></p>
		<div class="row mb-2">
    <?php if ($receiver !== null): ?>
        <div class="col-6">
            <div class="form-group">
                <p class="m-0"><b><?php echo $receiver['firstname'] ?> <?php echo $receiver['lastname'] ?></b></p>
                <p class="m-0"><?php echo $receiver['phone'] ?></p>
            </div>
        </div>
    <?php endif; ?>
    
    <?php if ($receiver2 !== null): ?>
        <div class="col-6">
            <div class="form-group">
                <p class="m-0"><b><?php echo $receiver2['firstname'] ?> <?php echo $receiver2['lastname'] ?></b></p>
                <p class="m-0"><?php echo $receiver2['phone'] ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>

		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped table-bordered" id="item-list">
					<colgroup>
						<col width="5%">
						<col width="10%">
						<col width="30%">
						<col width="30%">
					
						<col width="8%">
						<col width="8%">
						<col width="8%">
						
					</colgroup>
					<thead>
						<tr class="bg-navy disabled">
							<th class="px-1 py-1 text-center">Qty Ordered</th>
							<th class="px-1 py-1 text-center">Unit</th>
							<th class="px-1 py-1 text-center">Item</th>
							<th class="px-1 py-1 text-center">Description</th>
						
							<th class="px-1 py-1 text-center">Received</th>
							<th class="px-1 py-1 text-center">Outstanding</th>
							<th class="px-1 py-1 text-center">No. of Delivered Items</th>
						</tr>
					</thead>
					<tbody>
					<?php 
					if (isset($id)) :
						$order_items_qry = $conn->query("SELECT o.*, i.name, i.description, i.account_code, i.type, i.item_code
							FROM approved_order_items o
							INNER JOIN item_list i ON o.item_id = i.id
							WHERE o.po_id = '$id'
							AND o.gr_id = (
								SELECT MAX(gr_id)
								FROM approved_order_items
								WHERE po_id = '$id'
							);
						");
						echo $conn->error;

						while($row = $order_items_qry->fetch_assoc()):
						?>
						<tr class="po-item" data-id="">
							<td class="align-middle p-0 text-center">
								<input type="number" class="text-center w-100 border-0" step="any" name="qty[]" value="<?php echo $row['quantity'] ?>" style="pointer-events:none;border:none;background-color: transparent;"/>
							</td>
							<td class="align-middle p-1">
								<input type="text" class="text-center w-100 border-0" name="unit[]" value="<?php echo $row['default_unit'] ?>" style="pointer-events:none;border:none;background-color: transparent;"/>
							</td>
							<td class="align-middle p-1">
								<input type="hidden" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>">
								<input type="hidden" name="doc_no" value="<?php echo $newDocNo; ?>" readonly>
								<input type="hidden" name="type" value="<?php echo $row['type'] ?>" readonly>
								<input type="hidden" name="item_id[]" value="<?php echo $row['item_id'] ?>">
								<input type="hidden" name="account_code[]" value="<?php echo $row['account_code'] ?>">
								<input type="text" class="w-100 border-0 item_id" data-item-id="<?php echo $row['item_id']; ?>" value="<?php echo $row['name']; ?>" style="pointer-events:none;border:none;background-color: transparent;" required/>
							</td>
							<td class="align-middle p-1 item-description"><?php echo $row['description'] ?></td>
							<input type="hidden" name="unit_price[]" value="<?php echo ($row['unit_price']) ?>"/>
							<?php if($level < 0): ?>
								<td class="align-middle p-1">
									<input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]"  value="<?php echo ($row['unit_price']) ?>"/>
								</td>
							<?php endif; ?>
							<td class="align-middle p-1">
								<input type="number" step="any" class="text-right w-100 border-0" name="received[]" id="txtreceived" value="<?php echo ($row['received']) ?>"  style="pointer-events:none;border:none;background-color: aqua;" readonly/>
							</td>
							<td class="align-middle p-1">
								<input type="number" step="any" class="text-right w-100 border-0" name="outstanding[]"  id="txtoutstanding" value="<?php echo ($row['outstanding']) ?>"  style="pointer-events:none;border:none;background-color: gainsboro;" readonly/>
							</td>
							<td class="align-middle p-1">
								<input type="number" step="any" class="text-right w-100 border-0 txtdel" name="del_items[]" id="txtdelitems" style="background-color: yellow; text-align: center;" value="0" onblur="calculateAmount(this)" onchange="setDefaultIfEmpty(this)"/>
							</td>
							<input type="hidden" name="item_code[]" id="item_code" value="<?php echo ($row['item_code']) ?>">
							<input type="hidden" value="0" name="amount[]" id="amount">
							<input type="hidden" name="type[]" id="type" value="<?php echo ($row['type']) ?>">
							<td style="display:none;"><input type='text' name='vat_amt' id='vat_amt' value='0'></td>
							<td style="display:none;"><input type='text' name='ex_vat' id='ex_vat' value='0'></td>
							<td style="display:none;"><input type='text' name='tot' id='tot' value='0'></td>
							<input type="hidden" value="<?php echo $max_gr_id ?>" id="gr_id" name="gr_id" style="border:none;color:black;pointer-events:none;">
						</tr>
						<?php
						$grIdValue = $row['gr_id'];
						?>
						<!-- <a class="dropdown-item gl_data" href="javascript:void(0)" data-id ="<?php echo $row['gr_id']; ?>"><span class="fa fa-file-export text-secondary"></span> General Ledger</a> -->
						<?php endwhile;
						 
						endif;
						?>

					</tbody>
					
					<?php 
						if(isset($id)):
							$order_items_qry = $conn->query("SELECT ac.*,g.* FROM account_list ac JOIN group_list g
								ON ac.group_id = g.id WHERE ac.name = 'Deferred Input VAT'");
							echo $conn->error;
							while($row = $order_items_qry->fetch_assoc()):
					?>
							<tr class="po-item" data-id="" style="display:none;">
								<td class="align-middle p-1">
									<br>
									GType:<input type="text" name="gtype_vat" id="gtype_vat" value="<?php echo $row['type'] ?>">
									<input type="text" name="account_code_vat" value="<?php echo $row['code'] ?>">
									<input type="text" name="item_code_vat" value="0">
									VAT <input type="text" value="0" name="amount_vat" id="vat_total">
									Extra Ko Na. Total ng TOTSUM - VAT <input type="text" value="0" name="totDec" id="totDec">
								</td>
							</tr>
					<?php
							endwhile;
						endif;
					?>
						<?php 
						if(isset($id)):
						$order_items_qry = $conn->query("SELECT ac.*,g.* FROM account_list ac JOIN group_list g
						ON ac.group_id = g.id WHERE ac.name = 'Goods Receipt'");
						
						echo $conn->error;
						while($row = $order_items_qry->fetch_assoc()):
						?>
					
						<tr class="po-item" data-id="" style="display:none;">
							<td class="align-middle p-1">
							<br>
								GType:<input type="text" name="gtype_gr" id="gtype_gr" value="<?php echo $row['type'] ?>">
								<input type="text" name="account_code_gr" value="<?php echo $row['code'] ?>">
								<input type="text" name="item_code_gr" value="0">
								GR <input type="text" value="0" name="amount_gr" id="gr_total">
							</td>
						</tr>
						
						<?php endwhile;endif; ?>


						<?php 
						if(isset($id)):
						$order_items_qry = $conn->query("SELECT ac.*,g.* FROM account_list ac JOIN group_list g
						ON ac.group_id = g.id WHERE ac.name = 'Deferred Expanded Withholding Tax Payable'");
						
						echo $conn->error;
						while($row = $order_items_qry->fetch_assoc()):
						?>
					
						<tr class="po-item" data-id="" style="display:none;">
							<td class="align-middle p-1">
							<br>
								GType:<input type="text" name="gtype_ewt" id="gtype_ewt" value="<?php echo $row['type'] ?>">
								<input type="text" name="account_code_ewt" value="<?php echo $row['code'] ?>">
								<input type="text" name="item_code_ewt" value="0">
								EWT<input type="text" value="0" name="amount_ewt" id="ewt_total">
							</td>
						</tr>
						
						<?php endwhile;endif; ?>
					<tr style="display:none;">
						<td class="p-1 text-right" colspan="8">Total Outstanding:</td>
						<td class="p-1 text-right" id="outstanding-total">0</td>
					</tr>
					<?php if($level < 0): ?>
						<tfoot>
							<tr class="bg-lightblue">
								<tr>
									<th class="p-1 text-right" colspan="8"><span><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button></span> Sub Total</th>
									<th class="p-1 text-right" id="sub_total">0</th>
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="8">Discount (%):
										<input type="number" step="any" name="discount_percentage" class="border-light text-right" value="<?php echo isset($discount_percentage) ? $discount_percentage : 0 ?>">
									</th>
									<th class="p-1"><input type="text" class="w-100 border-0 text-right" readonly value="<?php echo isset($discount_amount) ? $discount_amount : 0 ?>" name="discount_amount"></th>
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="8">Tax Inclusive (%):
										<input type="number" step="any" name="tax_percentage" class="border-light text-right" value="<?php echo isset($tax_percentage) ? $tax_percentage : 0 ?>">
									</th>
									<th class="p-1">
										<input type="text" class="w-100 border-0 text-right" readonly value="<?php echo isset($tax_amount) ? $tax_amount : 0 ?>" name="tax_amount">
									</th>
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="8">Total:</th>
									<th class="p-1 text-right" id="total">0</th>
								</tr>
							</tr>
						</tfoot>
					<?php endif; ?>
				</table>
				<div class="row">
					<div class="col-md-6">
						<label for="notes" class="control-label">Remarks:</label>
						<textarea name="notes" id="notes" cols="10" rows="4" class="form-control rounded-0" style="pointer-events:none;"><?php echo isset($notes) ? $notes : '' ?></textarea>
					</div>
					<div class="col-md-6" id="hidden-status">
						<label for="status" class="control-label">Status:</label>
						<select name="status" id="status" class="form-control form-control-sm rounded-0">
							<option value="0" <?php echo ($status == 0) ? 'selected' : ''; ?>>Closed</option>
							<option value="1" <?php echo ($status == 1) ? 'selected' : ''; ?>>Open</option>
						</select>
					</div>
				</div>
				<br>
			</div>
		</div>
	</form>
	<div class="card-footer" id="hidden-status">
		<table style="width:100%;">
			<tr>
				<td>
					<button class="btn btn-flat btn-default bg-maroon" style="width:100%;margin-right:5px;font-size:14px;" form="po-form" id="save-button">Save</button>
				</td>
				<td>
					<a class="btn btn-flat btn-default" style="width:100%;margin-left:5px;font-size:14px;" href="?page=po/po_goods_receiving/received_items_status"><i class="fa fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
				</td>
			</tr>
		</table>
	</div>
</div>
	<table class="d-none" id="item-clone">
		<tr class="po-item" data-id="">
			<td class="align-middle p-1 text-center">
				<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
			</td>
			<td class="align-middle p-0 text-center">
				<input type="number" class="text-center w-100 border-0" step="any" name="qty[]"/>
			</td>
			<td class="align-middle p-1">
				<input type="text" class="text-center w-100 border-0" name="unit[]"/>
			</td>
			<td class="align-middle p-1">
				<input type="text" name="item_id[]">
				<input type="text" class="text-center w-100 border-0 item_id" required/>
			</td>
			<td class="align-middle p-1 item-description"></td>
			<td class="align-middle p-1">
				<input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]" value="0"/>
			</td>
			<td class="align-middle p-1">
				<input type="number" step="any" class="text-right w-100 border-0" name="received[]" value="0"/>
			</td>
			<td class="align-middle p-1">
				<input type="number" step="any" class="text-right w-100 border-0" name="outstanding[]" value="0"/>
			</td>
			<td class="align-middle p-1">
				<input type="number" step="any" class="text-right w-100 border-0" name="del_items[]" value="0"/>
			</td>
			<td class="align-middle p-1 text-right total-price">0</td>
		</tr>
		
	</table>
	
</div>

<div class="modal fade" id="unlinkedItemsModal" tabindex="-1" role="dialog" aria-labelledby="unlinkedItemsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unlinkedItemsModalLabel">Unlinked Items</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="unlinkedItemsModalContent">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="redirectButton" data-dismiss="modal">Manage Items</button>
            </div>
        </div>
    </div>
</div>
<!-- <div class="modal fade" id="unlinkedItemsModal" tabindex="-1" role="dialog" aria-labelledby="unlinkedItemsModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unlinkedItemsModalLabel">Unlinked Items</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>The item is not linked. Please link the item before entering received quantity.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div> -->
<script>
	function setDefaultIfEmpty(inputElement) {
    if (inputElement.value === "") {
        inputElement.value = "0";
    }
}

    var supplierId = '<?php echo $supplier_id; ?>';
	var dept = '<?php echo $dept; ?>';
	
    function handleReceivedClick(element) {
        var row = element.closest('tr');
        var accountCode = row.querySelector('input[name="account_code[]"]').value;
		var itemId = row.querySelector('input[name="item_id[]"]').value;

        if (accountCode == 0) {
           
            $.ajax({
				type: 'POST',
				url: 'po/goods_receiving/fetch_unlinked_items.php', 
				data: {
					supplier_id: supplierId,
					item_id: itemId,
				},
				success: function(response) {
					console.log("Supp:", supplierId);
					console.log("Supp:", itemId);
					console.log("Supp:", dept);
					try {
						var data = JSON.parse(response);

						if (data.error) {
							$('#unlinkedItemsModal .modal-body').html('<p class="text-danger">' + data.error + '</p>');
						} else {
							$('#unlinkedItemsModal .modal-body').empty();
							var table = $('<table class="table table-bordered"></table>');
							var thead = $('<thead><tr><th>Name</th><th>Account Code</th><th>Item Code</th><th>Description</th><th>Supplier Name</th></tr></thead>');
							var tbody = $('<tbody></tbody>');

							$.each(data, function(index, item) {
								var row = $('<tr><td>' + item.name + '</td><td>' + item.account_code + '</td><td>' + item.item_code + '</td><td>' + item.description + '</td><td>' + item.supplier_name + '</td></tr>');
								tbody.append(row);
							});

							table.append(thead).append(tbody);

							$('#unlinkedItemsModal .modal-body').append(table);
						}

						$('#unlinkedItemsModal').modal('show');
					} catch (e) {
						console.error('Error parsing JSON:', e);
						$('#unlinkedItemsModal .modal-body').html('<p class="text-danger">Error parsing JSON</p>');
					}
				},
				error: function(error) {
					console.error('Error fetching data:', error);
				}
			});

        }
    }
	
    document.querySelectorAll('input[name="del_items[]"]').forEach(function (element) {
        element.addEventListener('click', function () {
            handleReceivedClick(this);
        });
    });
</script>

<script>
$(document).ready(function () {
    var saveButton = document.getElementById("save-button");

    $('#redirectButton').on('click', function () {
        var dept = '<?php echo $dept; ?>';

        if (dept !== 'Accounting') {
            $('#redirectButton').prop('disabled', true);
            alert('You need to contact the Accounting Department for linking.');
        } else {
            window.location.href = '.?page=po/items&supplier_id=' + supplierId;
        }

        $(saveButton).prop('disabled', true);
    });

    $('#unlinkedItemsModal').on('hidden.bs.modal', function () {
        $('.txtdel').prop('disabled', true);

        $(saveButton).prop('disabled', true);
    });
});



function calculateAmount(input){

	var vatableValue = <?php echo isset($vatableValue) ? $vatableValue : 0; ?>;
	console.log(vatableValue);
	if (vatableValue == 1){
		calculateAmountInc(input);
	}else if(vatableValue == 2){
		calculateAmountExc(input);
	}else{
		calculateAmountNonVATZeroR(input);
	}
}

function calculateAmountInc(input) {
    var tr = $(input).closest('.po-item');
    var delitems = parseFloat(input.value);
    var unitPrice = parseFloat(tr.find('[name="unit_price[]"]').val());
    var vatableValue = <?php echo isset($vatableValue) ? $vatableValue : 0; ?>;
    var currentType = tr.find('[name="type"]').val();
    var originalAmount = delitems * unitPrice;

    var amount = originalAmount;
    tr.find('[name="amount[]"]').val(amount.toFixed(2));

    var exVatField = tr.find('[name="ex_vat"]');
    var originalExVatValue = vatableValue == 1 ? originalAmount / 1.12 * 0.12 : originalAmount * 0.12;

    var exVatValueCopy = originalExVatValue;
    exVatField.val(originalExVatValue.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    var amountAfterSubtraction = originalAmount - exVatValueCopy;
    tr.find('[name="amount[]"]').val(amountAfterSubtraction.toFixed(2));

    var vatAmtField = tr.find('[name="vat_amt"]');
    var vatRate = currentType == 1 ? 0.01 : 0.02;
    var vatAmount = amountAfterSubtraction * vatRate;
    vatAmtField.val(vatAmount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    var totField = tr.find('[name="tot"]');
    var totAmount = originalAmount;
	totField.val(totAmount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

	var totSum = 0;
    var totalEwt = 0;
    var totalVat = 0;  
	var totDeduct = 0;

    $('.po-item [name="tot"]').each(function() {
        totSum += parseFloat($(this).val().replace(/,/g, '')) || 0;
    });


    $('[name="vat_amt"]').each(function() {
        totalEwt += parseFloat($(this).val().replace(/,/g, ''));
    });

    $('[name="ex_vat"]').each(function() {
        totalVat+= parseFloat($(this).val().replace(/,/g, ''));
    });

	totDeduct = (totSum - totalVat);
	totSum = (totDeduct + totalVat) - totalEwt;

	$('#totDec').val(totDeduct.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    $('#ewt_total').val(totalEwt.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    $('#vat_total').val(totalVat.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    $('#gr_total').val(totSum.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
}


function calculateAmountNonVATZeroR(input) {
    var tr = $(input).closest('.po-item');
    var delitems = parseFloat(input.value);
    var unitPrice = parseFloat(tr.find('[name="unit_price[]"]').val());
    var vatableValue = <?php echo isset($vatableValue) ? $vatableValue : 0; ?>;
	var currentType = $(this).closest('.po-item').find('[name="type"]').val();
    var amount = delitems * unitPrice;

    tr.find('[name="amount[]"]').val(amount.toFixed(2));

    var vatAmtField = tr.find('[name="vat_amt"]');
    var vatRate = tr.find('[name="type[]"]').val() == 1 ? 0.01 : 0.02;
    var vatAmount = amount * vatRate;
    vatAmtField.val(vatAmount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    var exVatField = tr.find('[name="ex_vat"]');
    var originalExVatValue = vatableValue == 1 ? amount / 1.12 * 0.12 : amount * 0.12;

	var exVatValueCopy = originalExVatValue;
    exVatField.val(originalExVatValue.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

	if(vatableValue < 3){
		var amountAfterSubtraction = amount - exVatValueCopy;
		tr.find('[name="amount[]"]').val(amountAfterSubtraction.toFixed(2));
	}else{
		console.log(originalExVatValue);
		exVatField.val(originalExVatValue.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
	}

	/////////////////////////VATABLE SIDE///////////////////////
	var totalAmount = 0;
	var totalVat = 0;
	var vatableValue = <?php echo isset($vatableValue) ? $vatableValue : 0; ?>; 

	$('[name="amount[]"]').each(function () {
		totalAmount += parseFloat($(this).val().replace(/,/g, ''));
	});

	if (vatableValue == 1) {
		totalVat = totalAmount / 1.12 * 0.12;
	} else if (vatableValue == 2) {
		totalVat = totalAmount * 0.12;
	}else{
		totalVat = 0;
	}
	$('#vat_total').val(totalVat.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));


	/////////////////////////EWT SIDE///////////////////////
	var totalAmount = 0;
	var totalEwt = 0;

	$('[name="amount[]"]').each(function() {
		totalAmount += parseFloat($(this).val().replace(/,/g, ''));

		var currentType = $(this).closest('.po-item').find('[name="type"]').val();

		if (currentType == 1) {
			totalEwt = totalAmount * 0.01;
		} else {
			totalEwt = totalAmount * 0.02;
		}
	});

	$('#ewt_total').val(totalEwt.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

	/////////////////////////Goods Receipt SIDE///////////////////////
	var totalAmount = 0;
	var totalGR = 0;

        $('[name="amount[]"]').each(function() {
            totalAmount += parseFloat($(this).val().replace(/,/g, ''));
			
			if (currentType == 1) {
				totalVat = totalAmount / 1.12 * 0.12;
			} else {
				totalVat = totalAmount * 0.12;
			}
			//totalGR = (totalAmount + totalVat) - totalEwt;
			if (vatableValue > 2) {
				totalGR = (totalAmount) - totalEwt;
			}else{
				totalGR = (totalAmount + totalVat) - totalEwt;
			}

        });

        $('#gr_total').val(totalGR.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
}


function calculateAmountExc(input) {
    var tr = $(input).closest('.po-item');
    var delitems = parseFloat(input.value);
    var unitPrice = parseFloat(tr.find('[name="unit_price[]"]').val());
    var vatableValue = <?php echo isset($vatableValue) ? $vatableValue : 0; ?>;
	var currentType = $(this).closest('.po-item').find('[name="type"]').val();
    var amount = delitems * unitPrice;

    tr.find('[name="amount[]"]').val(amount.toFixed(2));

    var vatAmtField = tr.find('[name="vat_amt"]');
    var vatRate = tr.find('[name="type[]"]').val() == 1 ? 0.01 : 0.02;
    var vatAmount = amount * vatRate;
    vatAmtField.val(vatAmount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    var exVatField = tr.find('[name="ex_vat"]');
    var originalExVatValue = vatableValue == 1 ? amount / 1.12 * 0.12 : amount * 0.12;

	var totalAmount = 0;
	var totalVat = 0;
	var vatableValue = <?php echo isset($vatableValue) ? $vatableValue : 0; ?>; 

	$('[name="amount[]"]').each(function () {
		totalAmount += parseFloat($(this).val().replace(/,/g, ''));
	});

	if (vatableValue == 1) {
		totalVat = totalAmount / 1.12 * 0.12;
	} else if (vatableValue == 2) {
		totalVat = totalAmount * 0.12;
	}else{
		totalVat = 0;
	}
	$('#vat_total').val(totalVat.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

	var totalAmount = 0;
	var totalEwt = 0;

	$('[name="amount[]"]').each(function() {
		totalAmount += parseFloat($(this).val().replace(/,/g, ''));

		var currentType = $(this).closest('.po-item').find('[name="type"]').val();

		if (currentType == 1) {
			totalEwt = totalAmount * 0.01;
		} else {
			totalEwt = totalAmount * 0.02;
		}
	});

	$('#ewt_total').val(totalEwt.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

	var totalAmount = 0;
	var totalGR = 0;

        $('[name="amount[]"]').each(function() {
            totalAmount += parseFloat($(this).val().replace(/,/g, ''));
			
			if (currentType == 1) {
				totalVat = totalAmount / 1.12 * 0.12;
			} else {
				totalVat = totalAmount * 0.12;
			}

			if (vatableValue > 2) {
				totalGR = (totalAmount) - totalEwt;
			}else{
				totalGR = (totalAmount + totalVat) - totalEwt;
			}

        });

        $('#gr_total').val(totalGR.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
}
</script>


<script>
	$(document).ready(function(){
		$('.gl_data').click(function() {
			var dataId = $(this).attr('data-id');
			var redirectUrl = '?page=po/goods_receiving/gl_trans&id=' + dataId;
			window.location.href = redirectUrl;
			
		})
	});
	$(function(){
		$('#print').click(function(e){
			e.preventDefault();
			start_loader();
			var _h = $('head').clone();
			var _p = $('#out-print').clone();

			_p.find('.po-item').each(function() {
				var received = parseFloat($(this).find("[name='received[]']").val());
				var outstanding = parseFloat($(this).find("[name='outstanding[]']").val());

				// if (received === 0 && outstanding > 0) {
				// 	$(this).remove();
				// }
			});

			var _el = $('<div>');
			_p.find('thead th').attr('style','color:black !important');
			_el.append(_h);
			_el.append(_p);
			_el.find('#hidden-status').css('display', 'none');
			_el.find('#txtreceived').css('background-color', 'transparent');
			_el.find('#txtoutstanding').css('background-color', 'transparent');
			_el.find('#txtdelitems').css('background-color', 'transparent');
			_el.find('#notes').css('width', '100%');
			var nw = window.open("","","width=1200,height=950");
			nw.document.write(_el.html());
			nw.document.close();
			
			setTimeout(() => {
				nw.print();
				setTimeout(() => {
					end_loader();
					nw.close();
				}, 300);
			}, 200);
		});
	});
	function rem_item(_this){
		_this.closest('tr').remove()
	}
	
	function _autocomplete(_item){
		_item.find('.item_id').autocomplete({
			source:function(request, response){
				$.ajax({
					url:_base_url_+"classes/Master.php?f=search_items",
					method:'POST',
					data:{q:request.term},
					dataType:'json',
					error:err=>{
						//console.log(err)
					},
					success:function(resp){
						response(resp)
					}
				})
			},
			select:function(event,ui){
				//console.log(ui)
				_item.find('input[name="item_id[]"]').val(ui.item.id)
				_item.find('.item-description').text(ui.item.description)
			}
		})
	}
	$(document).ready(function(){
		$('#add_row').click(function(){
			var tr = $('#item-clone tr').clone()
			$('#item-list tbody').append(tr)
			_autocomplete(tr)
			tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress',function(e){
			
			})
		})
		if($('#item-list .po-item').length > 0){
			$('#item-list .po-item').each(function(){
				var tr = $(this)
				_autocomplete(tr)
				tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress',function(e){
			
				})
				tr.find('[name="qty[]"],[name="unit_price[]"]').trigger('keypress')
			})
		}else{
		$('#add_row').trigger('click')
		}
        $('.select2').select2({placeholder:"Please Select here",width:"relative"})
		$('#po-form').submit(function (e) {
			e.preventDefault();
			var _this = $(this);
			if ($('[name="del_items[]"]').filter(function () {
        		return $(this).val() != 0;
			}).length === 0) {
				alert_toast(" Hala. Wala ka pong ni-received.", 'warning');
				return false;
			}

			var confirmed = confirm("Are you sure you want to save?");

			if (!confirmed) {
				return false; 
			}

			$('.err-msg').remove();
			$('[name="po_no"]').removeClass('border-danger');

			if ($('#item-list .po-item').length <= 0) {
				alert_toast(" Please add at least 1 item on the list.", 'warning');
				return false;
			}

			start_loader();

			$.ajax({
				url: _base_url_ + "classes/Master.php?f=update_status_gr",
				data: new FormData($(this)[0]),
				cache: false,
				contentType: false,
				processData: false,
				method: 'POST',
				type: 'POST',
				dataType: 'json',
				error: err => {
					alert_toast("An error occurred", 'error');
					end_loader();
				},
				success: function (resp) {
					if (typeof resp == 'object' && resp.status == 'success') {
						location.href = "./?page=goods_receiving/received_items_status";
					} else if ((resp.status == 'failed' || resp.status == 'po_failed') && !!resp.msg) {
						var el = $('<div>')
						el.addClass("alert alert-danger err-msg").text(resp.msg)
						_this.prepend(el)
						el.show('slow')
						$("html, body").animate({ scrollTop: 0 }, "fast");
						end_loader()
						if (resp.status == 'po_failed') {
							$('[name="po_no"]').addClass('border-danger').focus()
						}
					} else {
						alert_toast("An error occurred", 'error');
						end_loader();
					}
				}
			});
		});

		initDeliveredItemsEvents();
		$('#add_row').click(function() {
			var tr = $('#item-clone tr').clone();
			$('#item-list tbody').append(tr);
			_autocomplete(tr);
			tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress', function(e) {
			
			});
		

			initDeliveredItemsEvents();
		});
	})
	function initDeliveredItemsEvents() {
    $('#item-list .po-item').each(function () {
        var tr = $(this);

        tr.find('[name="received[]"]').data('initial-received', parseFloat(tr.find('[name="received[]"]').val()));
        tr.find('[name="outstanding[]"]').data('initial-outstanding', parseFloat(tr.find('[name="outstanding[]"]').val()));

        tr.find('[name="del_items[]"]').on('input', function (e) {
            var deliveredItems = parseFloat($(this).val());

            if (isNaN(deliveredItems) || deliveredItems === 0) {
                tr.find('[name="received[]"]').val(tr.find('[name="received[]"]').data('initial-received'));
                tr.find('[name="outstanding[]"]').val(tr.find('[name="outstanding[]"]').data('initial-outstanding'));
                tr.find('[name="qty[]"],[name="unit_price[]"]').trigger('input');
                return;
            }

            var initialReceived = tr.find('[name="received[]"]').data('initial-received');
            var initialOutstanding = tr.find('[name="outstanding[]"]').data('initial-outstanding');

            var maxDeliveredItems = initialOutstanding;

            if (deliveredItems > maxDeliveredItems) {
                deliveredItems = maxDeliveredItems;
                $(this).val(deliveredItems);
            }

            var received = initialReceived + deliveredItems;
            var outstanding = initialOutstanding - deliveredItems;

            if (outstanding < 0) {
                outstanding = 0;
            }

            tr.find('[name="received[]"]').val(received);
            tr.find('[name="outstanding[]"]').val(outstanding);
            tr.find('[name="qty[]"],[name="unit_price[]"]').trigger('input');
        });
    });
}


	function calculateOutstandingTotal() {
		var totalOutstanding = 0;
		$('.po-item').each(function() {
			var outstanding = parseFloat($(this).find("[name='outstanding[]']").val());


			totalOutstanding += isNaN(outstanding) ? 0 : outstanding;
		});

		$('#outstanding-total').text(parseFloat(totalOutstanding).toLocaleString("en-US"));
	}

	$(document).ready(function() {
		initDeliveredItemsEvents(); 
		$('#item-list input[name="del_items[]"]').on('input', function() {
			calculateOutstandingTotal();
		});
	});

	calculateOutstandingTotal();

	function updateStatusBasedOnOutstanding() {
		var totalOutstanding = parseFloat($('#outstanding-total').text().replace(/,/g, '')) || 0;
		var status = totalOutstanding <= 0 ? 0 : 1; 
		$('#status').val(status);
	}

	updateStatusBasedOnOutstanding();

	$(document).ready(function() {
		initDeliveredItemsEvents(); 
		$('#item-list input[name="del_items[]"]').on('input', function() {
			calculateOutstandingTotal(); 
			updateStatusBasedOnOutstanding(); 
		});
	});
    $(document).ready(function() {
        $('#status').addClass('select-readonly');
    });
	document.addEventListener("DOMContentLoaded", function () {
        var statusSelect = document.getElementById("status");
        var saveButton = document.getElementById("save-button");
        function updateButtonState() {
            var status = statusSelect.value;

            if (status === "0") {

                saveButton.disabled = true;
            } else {
                saveButton.disabled = false;
            }
        }
        updateButtonState();
        statusSelect.addEventListener("change", updateButtonState);
    });
</script>

