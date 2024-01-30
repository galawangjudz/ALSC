
<?php
$delivery_date = date('Y-m-d', strtotime(date('Y-m-d') . ' +1 week'));
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
    $qry = $conn->query("SHOW TABLE STATUS LIKE 'po_list'");
    
    if ($qry->num_rows > 0) {
        $row = $qry->fetch_assoc();
        $next_po_number = $row['Auto_increment'];
    } else {
        $next_po_number = 1;
    }

    $po_number = str_pad($next_po_number, '0', STR_PAD_LEFT);
}
?>
<script src="js/po_scripts.js"></script>
<script>
    var vatableValue = <?php echo json_encode($vatable); ?>;
</script>

<link rel="stylesheet" href="css/manage_po.css">
<body onload="calculate()">
	<div class="card card-outline card-info">
		<div class="card-header">
			<h5 class="card-title"><b><i><?php echo isset($id) ? "Update Purchase Order": "New Purchase Order" ?></b></i></h5>
		</div>
		<div class="card-body">
			<form action="" id="po-form">
				<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
					<div class="card-body">
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="supplier_id">Supplier:</label>
								<?php
									$supplier_qry = $conn->query("SELECT * FROM `supplier_list` WHERE status = 1 ORDER BY `name` ASC");
									$terms = '';
									?>

									<select name="supplier_id" id="supplier_id" class="custom-select custom-select-sm rounded-0 select2">
										<option value="" disabled <?php echo !isset($supplier_id) ? "selected" : '' ?>></option>
										<?php while ($row = $supplier_qry->fetch_assoc()): ?>
											<option
												value="<?php echo $row['id'] ?>"
												data-vatable="<?php echo $row['vatable'] ?>"
												data-terms="<?php echo $row['terms']; ?>"
												<?php echo isset($supplier_id) && $supplier_id == $row['id'] ? 'selected' : '' ?>
												<?php echo $row['status'] == 0 ? 'disabled' : '' ?>
											><?php echo $row['name'] ?></option>
											<?php
											if (isset($supplier_id) && $supplier_id == $row['id']) {
												$terms = $row['terms'];
											}
											?>
										<?php endwhile; ?>
									</select>
							</div>
							<!-- <div class="col-md-4 form-group">
								<label for="p_terms">Payment Terms:</label>
								<?php
								if ($terms !== '') {
									$terms_qry = $conn->query("SELECT terms FROM `payment_terms` WHERE terms_indicator = $terms;");
									while ($row = $terms_qry->fetch_assoc()):
										$pterms = $row['terms'];
										?>
										<input type="text" id="p_terms" class="form-control form-control-sm rounded-0" value="<?php echo $pterms; ?>" readonly>
									<?php endwhile;
								} else {
									?>
									<input type="text" id="p_terms" class="form-control form-control-sm rounded-0" readonly>
								<?php } ?>
							</div> -->
							<!-- <input type="hidden" id="termsTextbox" value="<?php echo $terms; ?>"  class="form-control"> -->
							<div class="col-md-6 form-group">
								<label for="department">Delivery Date:</label>
								<?php
								// $formattedDate = date('Y-m-d', strtotime($delivery_date)); ?>
								<input type="date" class="form-control form-control-sm rounded-0" id="delivery_date" name="delivery_date" value="<?php echo isset($delivery_date) ? $delivery_date : '' ?>" style="background-color:yellow;">
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="department">Requesting Department:</label>
								<select name="department" id="department" class="custom-select custom-select-sm rounded-0 select2">
									<option value="" disabled <?php echo !isset($department) ? "selected" : '' ?>></option>
									<?php 
									$dept_qry = $conn->query("SELECT * FROM `department_list` order by `department` asc");
									while($row = $dept_qry->fetch_assoc()):
										$deptValue = $row['department']; 
									?>
									<option 
										value="<?php echo $deptValue ?>" 
										<?php echo isset($department) && $department == $deptValue ? 'selected' : '' ?> 
										><?php echo $deptValue ?>
									</option>
									<?php endwhile; ?>
								</select>
							</div>
							<div class="col-md-6 form-group">
								<label for="po_no">P.O. #: <span class="po_err_msg text-danger"></span></label>
								<input type="text" class="form-control form-control-sm rounded-0" id="po_no" name="po_no" value="<?php echo $po_number; ?>" readonly>
							</div>
						</div>
					</div>
					<hr>
					<div class="card-body">
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
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped table-bordered" id="item-list">
								<colgroup>
									<col width="3%">
									<col width="7%">
									<col width="10%">
									<col width="30%">
									<col width="30%">
									<col width="10%">
									<col width="10%">
									<col width="10%">
								</colgroup>
								<thead>
									<tr class="bg-navy disabled">
										<th class="px-1 py-1 text-center"></th>
										<th class="px-1 py-1 text-center">Qty</th>
										<th class="px-1 py-1 text-center">Unit</th>
										<th class="px-1 py-1 text-center">Item</th>
										<th class="px-1 py-1 text-center">Description</th>
										<th class="px-1 py-1 text-center">Price before Tax</th>
										<th class="px-1 py-1 text-center">VAT amount</th>
										<th class="px-1 py-1 text-center">Line Total</th>
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
											<td class="align-middle p-1 text-center">
												<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
											</td>
											<td class="align-middle p-0 text-center">
												<input type="number" class="text-center w-100 border-0 quantity" step="any" name="qty[]" value="<?php echo $row['quantity'] ?>"/>
											</td>
											<td class="align-middle p-0 text-center">
												<input type="text" class="text-center w-100 border-0 item-unit" step="any" name="default_unit[]" value="<?php echo $row['default_unit'] ?>" style="background-color:gainsboro;" readonly/>
											</td>
											<td class="align-middle p-1">
												<input type="hidden" name="item_id[]" value="<?php echo $row['item_id'] ?>">
												<input type="text" class="text-left w-100 border-0 item_id" id="item" value="<?php echo $row['name'] ?>" required/>
											</td>
											<td class="align-middle p-1 item-description">
												<?php echo $row['description'] ?>
											</td>
											<td class="align-middle p-0 text-center">
												<input type="text" class="text-center w-100 border-0 item-price" step="any" name="unit_price[]" value="<?php echo $row['unit_price'] ?>"/>
											</td>
											<td class="align-middle p-1">
												<input type="text" class="text-center w-100 border-0 item-vat" name="vat_included[]" style="background-color:red;" readonly>
											</td>
											<td class="align-middle p-1 text-right total"><?php echo number_format($row['quantity'] * $row['unit_price'], 2) ?></td>
										</tr>
									<?php endwhile;endif; ?>
								</tbody>
								<tfoot>
									<tr class="bg-lightblue">
										<tr>
											<th class="p-1 text-right" colspan="7">
												<span><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button></span> 
												Sub-Total
											</th>
											<th class="p-1 text-right" id="sub_total">0</th>
										</tr>
										<tr>
											<th class="p-1 text-right" colspan="7">
											VAT</th>
											<th class="p-1 text-right" id="vat_total" name="tax_amount" value="<?php echo isset($tax_amount) ? $tax_amount : 0 ?>">0</th>
											<input type="hidden" id="copytax" name="tax_amount">
										</tr>
										<tr>
											<th class="p-1 text-right" colspan="7">Total:</th>
											<th class="p-1 text-right" id="total">0</th>
										</tr>
										<tr>
										<table class="table-bordered">
											<tr style="padding-left:150px;align-items: center;text-align: center;">
												<td>
													<input type="radio" class="form-check-input" id="nonVatRadio" name="vatType" value="nonvat" onchange="updateValue()" required />
													<label for="nonVatRadio">Non-VAT</label>
												</td>
												<td>
													<input type="radio" class="form-check-input" id="zeroRatedRadio" name="vatType" value="zerorated" onchange="updateValue()" required />
													<label for="zeroRatedRadio">Zero-Rated</label>
												</td>
												<td>
													<input type="radio" class="form-check-input" id="inclusiveRadio" name="vatType" value="inclusive" onchange="updateValue()" required />
													<label for="inclusiveRadio">Inclusive</label>
												</td>
												<td>
													<input type="radio" class="form-check-input" id="exclusiveRadio" name="vatType" value="exclusive" onchange="updateValue()" required />
													<label for="exclusiveRadio">Exclusive</label>
												</td>
											</tr>
											<input type="hidden" id="rdoText" name="vatable" value="<?php echo $vatable ?>" />
										</table>
										</tr>
									</tr>
								</tfoot>
							</table>
							<br>
							<div class="row">
								<div class="col-md-12">
									<label for="notes" class="control-label">Notes:</label>
									<textarea name="notes" id="notes" cols="10" rows="4" class="form-control rounded-0"><?php echo isset($notes) ? $notes : '' ?></textarea>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		<div class="card-footer">
			<table style="width:100%;">
				<tr>
					<td>
						<button class="btn btn-flat btn-default bg-maroon" form="po-form" style="width:100%;margin-right:5px;font-size:14px;" onclick="copyTaxValue()"><i class='fa fa-save'></i>&nbsp;&nbsp;Save</button>
					</td>
					<td>
						<a class="btn btn-flat btn-default" href="?page=po_purchase_orders/" style="width:100%;margin-left:5px;font-size:14px;"><i class='fa fa-times-circle'></i>&nbsp;&nbsp;Cancel</a>
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
				<input type="number" class="text-center w-100 border-0" step="any" name="qty[]" required/>
			</td>
			<td class="align-middle p-1 item-unit">
				<input type="text" class="text-center w-100 border-0 item-unit" name="default_unit[]" style="background-color:gainsboro;" readonly>
			</td>
			<td class="align-middle p-1">
				<input type="hidden" name="item_id[]">
				<input type="text" class="text-left w-100 border-0 item_id" id="item" required/>
			</td>
			<td class="align-middle p-1 item-description"></td>
			<td class="align-middle p-1">
				<input type="text" class="text-center w-100 border-0 item-price" name="unit_price[]" oninput="formatDecimal(this)">
			</td>
			<td class="align-middle p-1">
				<input type="text" class="text-center w-100 border-0 item-vat" name="vat_included[]" style="background-color:gainsboro;" readonly>
			</td>
			
			<!-- <td class="align-middle p-1 text-right total-vat">0</td> -->
			<td class="align-middle p-1 text-right total-price">0</td>
		</tr>
	</table>
</body>
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
// 	function updateDeliveryDate() {
//     var termsId = $('#termsTextbox').val();

//     $.ajax({
//         type: 'POST',
//         url: 'po_purchase_orders/get_terms.php',
//         data: { termsId: termsId },
//         success: function(response) {
//             try {
//                 var data = JSON.parse(response);

//                 var deliveryDateInput = $('#delivery_date');
// 				var pterms = $('#p_terms');

//                 var daysToAdd = parseInt(data.days_before_due);

// 				if (daysToAdd === 0) {
//                     daysToAdd = parseInt(data.days_in_following_month);
//                 }

//                 if (daysToAdd === 0 && parseInt(data.days_in_following_month) === 0) {
//                     var currentDate = new Date();
//                     deliveryDateInput.val(currentDate.toISOString().split('T')[0]);
//                     return;
//                 }
//                 var currentDeliveryDate = new Date(deliveryDateInput.val());

//                 currentDeliveryDate.setDate(currentDeliveryDate.getDate() + daysToAdd);

//                 deliveryDateInput.val(currentDeliveryDate.toISOString().split('T')[0]);
// 				pterms.val(data.terms);

//             } catch (error) {
//                 console.error('Error parsing JSON response:', error);
//             }
//         },
//         error: function(xhr, status, error) {
//             console.error('Error in AJAX request:', xhr.responseText);
//         }
//     });
// }

function copyTaxValue() {
	var taxAmountValue = document.getElementById('vat_total').textContent;
	var taxAmountWithoutCommas = taxAmountValue.replace(/,/g, ''); 

	document.getElementById('copytax').value = taxAmountWithoutCommas;
}

$('input[name="vatType"]').change(function() {
    calculate();
});

// function updateInclusiveValues() {
//     $('input[name="unit_price[]"]').each(function() {
//         var unitPrice = parseFloat($(this).val());
//         var qty = parseFloat($(this).closest('.po-item').find('input[name="qty[]"]').val());

//         if (!isNaN(unitPrice) && !isNaN(qty)) {
//             var taxRate = 0.12;
//             var totalPrice = unitPrice * qty;
//             var inclusiveVatPrice = (totalPrice / 1.12) * taxRate;

//             $(this).closest('.po-item').find('input[name="vat_included[]"]').val(inclusiveVatPrice.toFixed(2));
//         }
//     });

//     calculate();
// }

// function updateExclusiveValues() {
//     $('input[name="unit_price[]"]').each(function() {
//         var unitPrice = parseFloat($(this).val());
//         var qty = parseFloat($(this).closest('.po-item').find('input[name="qty[]"]').val());

//         if (!isNaN(unitPrice) && !isNaN(qty)) {
//             var taxRate = 0.12;
//             var totalPrice = unitPrice * qty;
//             var exclusiveVatPrice = totalPrice * taxRate;

//             $(this).closest('.po-item').find('input[name="vat_included[]"]').val(exclusiveVatPrice.toFixed(2));
//         }
//     });

//     calculate();
// }

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

        _total += row_total;
        _vat_total += result;

        $(this).find('[name="vat_included[]"]').val(result.toFixed(2));
        $(this).find('.total-price').text(parseFloat(row_total).toLocaleString('en-US'));
    });

    $('#sub_total').text(parseFloat(_total).toLocaleString("en-US"));
    $('#vat_total').text(parseFloat(_vat_total).toLocaleString("en-US"));

    if (rdoText === "1") {
		$('#total').text(parseFloat(_total).toLocaleString("en-US"));
    } else if (rdoText === "2") {
		$('#total').text(parseFloat(_total + _vat_total).toLocaleString("en-US"));
    } else {
        $('#total').text(parseFloat(_total).toLocaleString("en-US"));
    }
}


 $(document).ready(function() {
	var originalTbody = $('#item-list tbody').html();

	$('#supplier_id').on('change', function() {
		var selectedSupplier = $(this).val();

		$('#item-list tbody').empty();

		if (selectedSupplier !== '') {
			$('#item-list tbody').append('<tr class="po-item" data-id=""></tr>');
			calculate();
		} else {
			$('#item-list tbody').html(originalTbody);
		}
	});
});



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
document.addEventListener('change', function(event) {
	if (event.target.classList.contains('item-checkbox')) {
		var textboxId = 'item_status_' + event.target.dataset.rowid;
		var textbox = document.getElementById(textboxId);
		if (event.target.checked) {
			textbox.value = '0';
		} else {
			textbox.value = '1';
		}
	}
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
		// var terms = $(this).find(':selected').data('terms');
        // $('#termsTextbox').val(terms);
        
        // updateDeliveryDate();
		console.log("Selected Supplier ID: " + selectedSupplierId);
		_autocomplete(item, selectedSupplierId);
	});
});
$(document).ready(function(){
	$('#add_row').click(function(){
		var tr = $('#item-clone tr').clone()
		$('#item-list tbody').append(tr)
		_autocomplete(tr)
		tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress', function (e) {
		calculate();
	});


	})
	if($('#item-list .po-item').length > 0){
		$('#item-list .po-item').each(function(){
			var tr = $(this)
			_autocomplete(tr)
			tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress',function(e){
				calculate();
			})
			tr.find('[name="qty[]"],[name="unit_price[]"]').trigger('keypress')
			calculate();
		})
	}else{
	$('#add_row').trigger('click')
	}
	$('.select2').select2({placeholder:"Please Select here",width:"relative"})
	$('#po-form').submit(function(e) {
		e.preventDefault();
		var _this = $(this)
		$('.err-msg').remove();
		$('[name="po_no"]').removeClass('border-danger')

		// var invalidItem = false;
		// $('#item-list .po-item').each(function() {
		// 	var description = $(this).find('.item-description').text().trim();
		// 	if (!description) {
		// 		invalidItem = true;
		// 		return false; 
		// 	}
		// });

		// if (invalidItem) {
		// 	alert_toast("Please make sure all entered items are valid.", 'warning');
		// 	return false;
		// }

		if ($('#item-list .po-item').length <= 0) {
			alert_toast("Please add at least 1 item to the list.", 'warning')
			return false;
		}

		start_loader();
		$.ajax({
			url: _base_url_ + "classes/Master.php?f=manage_po",
			data: new FormData($(this)[0]),
			cache: false,
			contentType: false,
			processData: false,
			method: 'POST',
			type: 'POST',
			dataType: 'json',
			error: err => {
				console.log(err)
				alert_toast("An error occurred", 'error');
				end_loader();
			},
			success: function(resp) {
				if (typeof resp == 'object' && resp.status == 'success') {
					location.href = "./?page=po_purchase_orders";
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
					console.log(resp)
				}
			}
		})
	});
})
</script>