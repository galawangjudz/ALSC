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
	$usertype = $_settings->userdata('user_type'); 
	$type = $_settings->userdata('user_code');
	$level = $_settings->userdata('type');
?>
<?php
$query = $conn->query("SELECT MAX(CAST(SUBSTRING(doc_no, 2) AS UNSIGNED)) AS max_doc_no FROM `tbl_gl_trans`");

if ($query) {
    $row = $query->fetch_assoc();
    $maxDocNo = $row['max_doc_no'];
    if ($maxDocNo === null) {
        $maxDocNo = 0;
    }
    $newDocNo = '2' . sprintf('%05d', $maxDocNo + 1);

    //echo $newDocNo;
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

echo $v_number;
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
		<input type="text" name ="vatableValue" value="<?php echo $vatableValue ?>">
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
						<?php if($level < 0): ?>
							<col width="15%">
						<?php endif; ?>
						<col width="8%">
						<col width="8%">
						<col width="8%">
						<col width="8%">
						<col width="8%">
						<?php if($level < 0): ?>
							<col width="9%">
						<?php endif; ?>
					</colgroup>
					<thead>
						<tr class="bg-navy disabled">
							<th class="px-1 py-1 text-center">Qty Ordered</th>
							<th class="px-1 py-1 text-center">Unit</th>
							<th class="px-1 py-1 text-center">Item</th>
							<th class="px-1 py-1 text-center">Description</th>
							<?php if($level < 0): ?>
								<th class="px-1 py-1 text-center">Price (per piece)</th>
							<?php endif; ?>
							<th class="px-1 py-1 text-center">Received</th>
							<th class="px-1 py-1 text-center">Outstanding</th>
							<th class="px-1 py-1 text-center">No. of Delivered Items</th>
							<!-- <th class="px-1 py-1 text-center">Item Code</th>
							<th class="px-1 py-1 text-center">Subtotal</th>
							<th class="px-1 py-1 text-center">Type</th>
							<th class="px-1 py-1 text-center">VAT per Item</th>
							<th class="px-1 py-1 text-center">Ex-VAT</th> -->
							<?php if($level < 0): ?>
								<th class="px-1 py-1 text-center">Total</th>
							<?php endif; ?>
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
								<input type="text" id="vs_num" name="vs_num" class="form-control form-control-sm form-control-border rounded-0" value="<?= isset($v_number) ? $v_number : "" ?>">
								<input type="text" name="doc_no" value="<?php echo $newDocNo; ?>" readonly>
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
								<input type="number" step="any" class="text-right w-100 border-0" name="del_items[]" id="txtdelitems" style="background-color:yellow;;text-align:center;" value="0" oninput="calculateAmount(this)"/>
							</td>
							<input type="hidden" name="item_code[]" id="item_code" value="<?php echo ($row['item_code']) ?>">
							<input type="hidden" value="0" name="amount[]" id="amount">
							<input type="hidden" name="type[]" id="type" value="<?php echo ($row['type']) ?>">
							<!-- <td><input type='text' name='vat_amt' id='vat_amt'></td>
							<td><input type='text' name='ex_vat' id='ex_vat'></td> -->
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
							$order_items_qry = $conn->query("SELECT * FROM account_list
								WHERE code = '11081'");
							echo $conn->error;
							while($row = $order_items_qry->fetch_assoc()):
					?>
							<tr class="po-item" data-id="" style="display:none;">
								<td class="align-middle p-1">
									<br>
									<input type="text" name="account_code_vat" value="<?php echo $row['code'] ?>">
									<input type="text" name="item_code_vat" value="0">
									<input type="text" value="0" name="amount_vat" id="vat_total">
								</td>
							</tr>
					<?php
							endwhile;
						endif;
					?>

						
						<?php 
						if(isset($id)):
						$order_items_qry = $conn->query("SELECT * FROM account_list
							WHERE code = '20147'");
						
						echo $conn->error;
						while($row = $order_items_qry->fetch_assoc()):
						?>
					
						<tr class="po-item" data-id="" style="display:none;">
							<td class="align-middle p-1">
							<br>
								<input type="hidden" name="account_code_gr" value="<?php echo $row['code'] ?>">
								<input type="hidden" name="item_code_gr" value="0">
								<input type="hidden" value="0" name="amount_gr" id="gr_total">
							</td>
						</tr>
						
						<?php endwhile;endif; ?>


						<?php 
						if(isset($id)):
						$order_items_qry = $conn->query("SELECT * FROM account_list
							WHERE code = '21032'");
						
						echo $conn->error;
						while($row = $order_items_qry->fetch_assoc()):
						?>
					
						<tr class="po-item" data-id="" style="display:none;">
						
							<td class="align-middle p-1">
							<br>
								<input type="hidden" name="account_code_ewt" value="<?php echo $row['code'] ?>">
								<input type="hidden" name="item_code_ewt" value="0">
								<input type="hidden" value="0" name="amount_ewt" id="ewt_total">
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
						<label for="notes" class="control-label">Notes:</label>
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
					<a class="btn btn-flat btn-default" style="width:100%;margin-left:5px;font-size:14px;" href="?page=po/goods_receiving"><i class="fa fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
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
<div class="modal fade" id="zeroAccountCodeModal" tabindex="-1" role="dialog" aria-labelledby="zeroAccountCodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="zeroAccountCodeModalLabel"><b>Unlinked Item/s</b></h5>
                
            </div>
            <div class="modal-body" id="zeroAccountCodeModalBody">
            </div>
        </div>
    </div>
</div>
<script>

    $('#save-button').on('click', function () {
      
        var itemsAreUnlinked = checkUnlinkedItems(); 

        if (itemsAreUnlinked) {

            displayUnlinkedItemModal();
        }
    });

    function checkUnlinkedItems() {

        var selectedSupplierId = $('#supplier_id').val();
        var itemsWithZeroAccountCode = getUnlinkedItems(selectedSupplierId);
        return itemsWithZeroAccountCode.length > 0;
    }

    function getUnlinkedItems(supplierId) {
    console.log('Supplier ID:', supplierId);
    $.ajax({
        url: 'journals/items-link.php',
        type: 'POST',
        data: { supplier_id: supplierId },
        success: function (data) {
            var items = JSON.parse(data);

            console.log(items);
            var itemsWithZeroAccountCode = items.filter(function (item) {
                return item.account_code == 0;
            });

            if (itemsWithZeroAccountCode.length > 0) {
                displayZeroAccountCodeModal(itemsWithZeroAccountCode, supplierId); 
            }
        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}


    function displayUnlinkedItemModal() {
        var selectedSupplierId = $('#supplier_id').val();
        var itemsWithZeroAccountCode = getUnlinkedItems(selectedSupplierId);

        if (itemsWithZeroAccountCode.length > 0) {
            displayZeroAccountCodeModal(itemsWithZeroAccountCode, selectedSupplierId);
        }
    }

	
	function displayZeroAccountCodeModal(items, supplierId) {
    var modalBody = $('#zeroAccountCodeModalBody');
    modalBody.empty();
    var table = $('<table class="table table-bordered">');
    var thead = $('<thead>').append('<tr><th style="width:40%;">Name</th><th style="width:10%">Code</th><th style="width:50%">Description</th></tr>');

    table.append(thead);

    var tbody = $('<tbody>');
    items.forEach(function (item) {
        var row = $('<tr>');
        row.append('<td>' + item.name + '</td>');
        row.append('<td>' + item.item_code + '</td>');
        row.append('<td>' + item.description + '</td>');
        tbody.append(row);
    });
    table.append(tbody);
    modalBody.append(table);
    var modal = $('#zeroAccountCodeModal');
    modal.find('.modal-dialog').removeClass('modal-lg'); 
    modal.find('.modal-dialog').addClass('custom-modal-width'); 
    modalBody.append('<button id="redirectButton" class="btn btn-primary" style="width:100%;">Manage Items</button>');
    $('#zeroAccountCodeModal').modal({
    backdrop: 'static',
    keyboard: false
});

$('#zeroAccountCodeModal').modal('show');
    $('#redirectButton').on('click', function () {
        window.location.href = '.?page=po/items&supplier_id=' + supplierId;
    });    
}


	function calculateAmount(input) {
		var tr = $(input).closest('.po-item');
		var delitems = parseFloat(input.value);
		var unitPrice = parseFloat(tr.find('[name="unit_price[]"]').val());
		var vatableValue = <?php echo isset($vatableValue) ? $vatableValue : 0; ?>;
		var amount = delitems * unitPrice;

		tr.find('[name="amount[]"]').val(amount.toFixed(2));

		var vatAmtField = tr.find('[name="vat_amt"]');
		var vatRate = tr.find('[name="type[]"]').val() == 1 ? 0.01 : 0.02;
		var vatAmount = amount * vatRate;
		vatAmtField.val(vatAmount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

		var exVatField = tr.find('[name="ex_vat"]');
		var exVatValue = vatableValue == 1 ? amount / 1.12 * 0.12 : amount * 0.12;
		exVatField.val(exVatValue.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

		updateVatTotal();
		updateEWTTotal();
		updateGR();
	}


	function updateVatTotal() {
		var totalAmount = 0;
		var totalVat = 0;
		var vatableValue = <?php echo isset($vatableValue) ? $vatableValue : 0; ?>; 

		$('[name="amount[]"]').each(function () {
			totalAmount += parseFloat($(this).val().replace(/,/g, ''));
		});

		if (vatableValue == 1) {
			totalVat = totalAmount / 1.12 * 0.12;
		} else {
			totalVat = totalAmount * 0.12;
		}

		$('#vat_total').val(totalVat.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
	}


	function updateGR() {
        var totalAmount = 0;
		var totalGR = 0;
		var vatableValue = <?php echo isset($vatableValue) ? $vatableValue : 0; ?>; 

        $('[name="amount[]"]').each(function() {
            totalAmount += parseFloat($(this).val().replace(/,/g, ''));
			
			if (vatableValue == 1) {
				totalVat = totalAmount / 1.12 * 0.12;
			} else {
				totalVat = totalAmount * 0.12;
			}
			

			if ($('[name="type[]"]').val() == 1) {
				totalEwt = totalAmount * 0.01;
			} else {
				totalEwt = totalAmount * 0.02;
			}

			totalGR = (totalAmount + totalVat) - totalEwt;
        });

        $('#gr_total').val(totalGR.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    }


	function updateEWTTotal() {
		var totalAmount = 0;
		var totalEwt = 0;
		var vatableValue = <?php echo isset($vatableValue) ? $vatableValue : 0; ?>; 

		$('[name="amount[]"]').each(function() {
			totalAmount += parseFloat($(this).val().replace(/,/g, ''));

			if (vatableValue == 1) {
				totalVat = totalAmount / 1.12 * 0.12;
			} else {
				totalVat = totalAmount * 0.12;
			}

			if ($('[name="type[]"]').val() == 1) {
				totalEwt = totalAmount * 0.01;
			} else {
				totalEwt = totalAmount * 0.02;
			}
		});

		$('#ewt_total').val(totalEwt.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
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
						console.log(err)
					},
					success:function(resp){
						response(resp)
					}
				})
			},
			select:function(event,ui){
				console.log(ui)
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
				url:_base_url_+"classes/Master.php?f=update_status_gr",
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
						//location.href = "./?page=po/purchase_orders/view_po&id="+resp.id;
                        location.reload();
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

