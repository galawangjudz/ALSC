
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
    $po_number = str_pad($next_po_number, '0', STR_PAD_LEFT);
}
?>

<script src="js/po_scripts.js"></script>

<script>
$(document).ready(function() {
    $('#supplier_id').prop('disabled', true);
    $('#supplier_id').on('mousedown keydown', function(e) {
        e.preventDefault();
    });
});
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
							<div class="col-md-6 form-group">
								<label for="po_no">P.O. #: <span class="po_err_msg text-danger"></span></label>
								<input type="text" class="form-control form-control-sm rounded-0" id="po_no" name="po_no" value="<?php echo $po_number; ?>" readonly>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 form-group">
								<label for="department">Requesting Department:</label>
                                <select name="department" id="department" class="custom-select custom-select-sm rounded-0 select2">
                                    <option value=""></option>
                                    <?php 
                                    $dept_qry = $conn->query("SELECT * FROM `department_list` ORDER BY `department` ASC");
                                    while($row = $dept_qry->fetch_assoc()):
                                        $deptValue = $row['department']; 
                                    ?>
                                    <option 
                                        value="<?php echo $deptValue ?>" 
                                        <?php echo isset($department) && $department == $deptValue ? 'selected' : '' ?> 
                                    ><?php echo $deptValue ?></option>
                                    <?php endwhile; ?>
                                </select>

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
								</colgroup>
								<thead>
									<tr class="bg-navy disabled">
										<th class="px-1 py-1 text-center"></th>
										<th class="px-1 py-1 text-center">Qty</th>
										<th class="px-1 py-1 text-center">Unit</th>
										<th class="px-1 py-1 text-center">Item</th>
										<th class="px-1 py-1 text-center">Description</th>
										<th class="px-1 py-1 text-center">Price (per piece)</th>
										<th class="px-1 py-1 text-center">Total</th>
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
												<input type="text" class="text-center w-100 border-0 item-unit" step="any" name="default_unit[]" value="<?php echo $row['default_unit'] ?>"/>
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
											<td class="align-middle p-1 text-right total"><?php echo number_format($row['quantity'] * $row['unit_price'], 2) ?></td>
										</tr>
									<?php endwhile;endif; ?>
								</tbody>
								<tfoot>
									<tr class="bg-lightblue">
									<tr>
										<th class="p-1 text-right" colspan="6"><span>
											<button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button>
										</span> Total</th>
										<th class="p-1 text-right" id="sub_total">0</th>
									</tr>
									<tr>
										<th class="p-1 text-right" colspan="6">Tax (<span id="tax_label"></span>):
											<input type="hidden" step="any" id="vatable" name="vatable" class="border-light text-right" value="<?php echo isset($vatable) ? $vatable : 0 ?>" readonly>
										</th>
										<th class="p-1"><input type="text" class="w-100 border-0 text-right" readonly value="<?php echo isset($tax_amount) ? $tax_amount : 0 ?>" name="tax_amount" id="tax_amount"></th>
									</tr>
									<!-- <tr>
										<th class="p-1 text-right" colspan="6">Total:</th>
										<th class="p-1 text-right" id="total">0</th>
									</tr> -->
								</tr>
								</tfoot>
							</table>
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
						<button class="btn btn-flat btn-default bg-maroon" form="po-form" style="width:100%;margin-right:5px;font-size:14px;"><i class='fa fa-save'></i>&nbsp;&nbsp;Save</button>
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
				<input type="text" class="text-center w-100 border-0 item-unit" name="default_unit[]">
			</td>
			<td class="align-middle p-1">
				<input type="hidden" name="item_id[]">
				<input type="text" class="text-left w-100 border-0 item_id" id="item" required/>
			</td>
			<td class="align-middle p-1 item-description"></td>
			<td class="align-middle p-1">
				<input type="text" class="text-center w-100 border-0 item-price" name="unit_price[]" oninput="formatDecimal(this)">
			</td>
			<td class="align-middle p-1 text-right total-price">0</td>
		</tr>
	</table>
</body>
<script>
	$(document).ready(function() {

    function setTaxLabel() {
        var tax_perc = $('[name="vatable"]').val();
        var taxLabel = $('#tax_label');

        if (tax_perc === '0') {
            taxLabel.text('Non-VAT');
        } else if (tax_perc === '1') {
            taxLabel.text('Inclusive');
        } else if (tax_perc === '2') {
            taxLabel.text('Exclusive');
        } else if (tax_perc === '3') {
            taxLabel.text('Zero rated');
        } else {
            taxLabel.text('');
           
        }
    }

    setTaxLabel();
});

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
	
	function calculate() {
		var _total = 0;

		$('.po-item').each(function () {
			var qty = $(this).find("[name='qty[]']").val();
			var unit_price = $(this).find("[name='unit_price[]']").val();
			var item_status = $(this).find("[name='item_status[]']").val(); 
			var row_total = 0;

			if (item_status !== "1" && item_status !== "2" && qty > 0 && unit_price > 0) {
				row_total = parseFloat(qty) * parseFloat(unit_price);
			}

			$(this).find('.total-price').text(parseFloat(row_total).toLocaleString('en-US'));
			_total += row_total;
		});


		tax_perc = $('[name="vatable"]').val();
		var taxTotal;
		var tax_amount;
		//var tax_amount = _total * (tax_perc / 100);

		if(tax_perc == 2){
			tax_amount = _total * 0.12;
			//taxTotal = _total - tax_amount;
		}else if(tax_perc == 1){
			var tax_amount_sub = (_total / 1.12) * 0.12;
			tax_amount = tax_amount_sub;
			//taxTotal =_total - tax_amount;
		}else{
			//taxTotal = 0;
			tax_amount = 0;
		}

		$('[name="tax_amount"]').val(parseFloat(tax_amount).toFixed(2).toLocaleString("en-US"));


		$('#sub_total').text(parseFloat(_total).toLocaleString("en-US"));
		$('#total').text(parseFloat(_total + tax_amount).toLocaleString("en-US"));
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

			console.log("Selected Supplier ID: " + selectedSupplierId);
			_autocomplete(item, selectedSupplierId);
		});
	});
	$(document).ready(function() {
		$("#supplier_id").change(function() {
			$('[name="vatable"]').val('');

			var selectedOption = $(this).find("option:selected");
			var vatable = selectedOption.data("vatable");

			if (vatable !== null) {
				$('[name="vatable"]').val(vatable);
			}

			var subtotal = parseFloat($('#sub_total').text().replace(/,/g, '')) || 0;
			var discount = (subtotal * vatable) / 100;

			$('[name="tax_amount"]').val(discount.toLocaleString('en-US'));

			var total = subtotal - discount;

			$('#total').text(total.toLocaleString('en-US'));
			tax_perc = $('[name="vatable"]').val();

			var taxLabel = $('#tax_label');
			console.log('tax_perc:', tax_perc);

			if (tax_perc === '0') {
				taxLabel.text('Non-VAT');
			} else if (tax_perc === '1') {
				taxLabel.text('Inclusive');
			} else if (tax_perc === '2') {
				taxLabel.text('Exclusive');
			} else if (tax_perc === '3') {
				taxLabel.text('Zero rated');
			} else {
				taxLabel.text('');
				//console.log('Unexpected tax percentage value:', tax_perc);
				//alert('Oops! Looks like there\'s no tax group set for this supplier. Please make sure to assign the correct tax group.');
			}
		});

		//$("#supplier_id").trigger("change");
	});



	$(document).ready(function(){
		$('#add_row').click(function(){
			var tr = $('#item-clone tr').clone()
			$('#item-list tbody').append(tr)
			_autocomplete(tr)
			tr.find('[name="qty[]"],[name="unit_price[]"]').on('input keypress',function(e){
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
				tr.find('[name="qty[]"],[name="unit_price[]"]').trigger('keypress')
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