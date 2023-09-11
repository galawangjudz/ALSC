
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
    $po_number = 'PO - ' . str_pad($next_po_number, 3, '0', STR_PAD_LEFT);
}


?>
<style>
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
	}
	.instruction{
		font-weight:bold;
		font-style:italic;
		color:red;
		font-size:14px;
	}
</style>

<script>
$(document).ready(function() {
    $(".align-middle").each(function() {
        var itemStatusInput = $(this).find('input[name="item_status[]"]');
        var itemNotesTextarea = $(this).closest('tr').find('[name="item_notes[]"]');
        if (itemStatusInput.val() == '0') {
            $(this).find('.item-checkbox').prop('checked', true);
            itemNotesTextarea.prop('readonly', true);
        } else {
            // Add the "unchecked-row" class to the row
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
            // Remove the "unchecked-row" class when the checkbox is checked
            $(this).closest('tr').removeClass('unchecked-row');
        } else {
            itemNotesTextarea.prop('readonly', false);
            // Add the "unchecked-row" class when the checkbox is unchecked
            $(this).closest('tr').addClass('unchecked-row');
        }
    });
});
</script>

<?php
	$subtotal = 0;
	$usertype = $_settings->userdata('user_type'); 
	$type = $_settings->userdata('id');
	$level = $_settings->userdata('type');
	$department = $_settings->userdata('department');
?>
<body onload="">
<div class="card card-outline card-info">
	<div class="card-header">
		<h5 class="card-title"><b><i><?php echo isset($id) ? "Update Purchase Order": "New Purchase Order" ?></b></i></h5>
	</div>
	<div class="card-body">
		<form action="" id="po-form">
			<input type="text" value="<?php echo $level; ?>">
			<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="row">
                <div class="col-md-6 form-group">
					<label for="supplier_id">Supplier:</label>
					<select name="supplier_id" id="supplier_id" class="custom-select custom-select-sm rounded-0 select2">
						<option value="" disabled <?php echo !isset($supplier_id) ? "selected" : '' ?>></option>
						<?php 
						$supplier_qry = $conn->query("SELECT * FROM `supplier_list` order by `name` asc");
						while($row = $supplier_qry->fetch_assoc()):
							$vatable = $row['vatable'];
						?>
						<option 
							value="<?php echo $row['id'] ?>" 
							data-vatable="<?php echo $vatable ?>"
							<?php echo isset($supplier_id) && $supplier_id == $row['id'] ? 'selected' : '' ?> 
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
                    <!-- <input type="text" class="form-control form-control-sm rounded-0" name="department" id="department" value="<?php echo $department; ?>" style="background-color:gainsboro;text-align:center;border:none;text-decoration-line:underline;font-style:italic;font-weight:bold;pointer-events:none;color:black;" readonly/> -->
					<select name="department" id="department" class="custom-select custom-select-sm rounded-0">
				
						<option value="" id="department" disabled <?php echo !isset($department) ? "selected" :'' ?>></option>
						<?php 
							$reqdept_qry = $conn->query("SELECT * FROM `department_list` order by `department` asc");
							while($row = $reqdept_qry->fetch_assoc()):
						?>
						<option value="<?php echo $row['department'] ?>" <?php echo isset($department) && $department == $row['department'] ? 'selected' : '' ?>><?php echo $row['department'] ?></option>
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
			<div class="instruction">Please deselect the item you wish to remove and provide your justification in the notes section for removing the item.</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered" id="item-list">
						<!-- <colgroup>
							<col width="5%">
							<col width="5%">
							<col width="25%">
							<col width="5%">
							<col width="5%">
							<col width="35%">
							<col width="10%">
							<col width="20%">
							<col width="20%">
						</colgroup> -->
						<thead>
							<tr class="bg-navy disabled">
							<th class="px-1 py-1 text-center"></th>
								<th class="px-1 py-1 text-center">Select</th>
								<th class="px-1 py-1 text-center">Note</th>
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
							$order_items_qry = $conn->query("SELECT o.*,i.name, i.description FROM `order_items` o inner join item_list i on o.item_id = i.id where o.`po_id` = '$id' ");
							echo $conn->error;
							while($row = $order_items_qry->fetch_assoc()):
							?>
							<tr class="po-item" data-id="">
								<td class="align-middle p-1 text-center">
									<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
								</td>
								<td class="align-middle p-0 text-center">
									<input type="checkbox" class="item-checkbox" data-rowid="<?php echo $row['id'] ?>">
									<input type="hidden" name="item_status[]" id="item_status_<?php echo $row['id'] ?>" value="<?php echo $row['item_status'] ?>">
								</td>

								<td class="align-middle p-0 text-center">
									<textarea id="item_notes" name="item_notes[]"><?php echo empty($row['item_notes']) ? '' : $row['item_notes']; ?></textarea>
								</td>
								<td class="align-middle p-0 text-center">
									<input type="number" class="text-center w-100 border-0" step="any" name="qty[]" value="<?php echo $row['quantity'] ?>"/>
								</td>
								<!-- <td class="align-middle p-1">
									<input type="text" class="text-center w-100 border-0" name="unit[]" value="<?php echo $row['unit'] ?>"/>
								</td> -->
								<!-- <td class="align-middle p-1 item-unit"><?php echo $row['default_unit'] ?></td> -->
								<td class="align-middle p-0 text-center">
									<input type="text" class="align-middle p-1 item-unit" step="any" name="default_unit[]" value="<?php echo $row['default_unit'] ?>"/>
								</td>
								<td class="align-middle p-1">
									<input type="hidden" name="item_id[]" value="<?php echo $row['item_id'] ?>">
									<input type="text" class="text-center w-100 border-0 item_id" value="<?php echo $row['name'] ?>" required/>
								</td>
								<td class="align-middle p-1 item-description">
									<?php echo $row['description'] ?>
								</td>
								<td class="align-middle p-1">
                                	<input type="text" step="any" class="text-right w-100 border-0" name="unit_price[]" value="<?php echo $row['unit_price'] ?>"/>
								</td>
									<td class="align-middle p-1 text-right"><?php echo number_format($row['quantity'] * $row['unit_price']) ?>

								</td>
							</tr>
							<?php endwhile;endif; ?>
						</tbody>
						<tfoot>
							<tr class="bg-lightblue">
								<tr>
									<th class="p-1 text-right" colspan="8"><span>
										<button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button>
									</span> Sub Total</th>
									<th class="p-1 text-right" id="sub_total">0</th>
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="8">Discount (%):
									<input type="number" step="any" name="discount_percentage" class="border-light text-right" value="<?php echo isset($discount_percentage) ? $discount_percentage : 0 ?>">
									</th>
									<th class="p-1"><input type="text" class="w-100 border-0 text-right" readonly value="<?php echo number_format(isset($discount_amount) ? $discount_amount : 0) ?>" name="discount_amount"></th>
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="8">Tax Inclusive (%):
									<input type="number" step="any" id="tax_percentage" name="tax_percentage" class="border-light text-right" value="<?php echo isset($tax_percentage) ? $tax_percentage : 0 ?>">
									</th>
									<th class="p-1"><input type="text" class="w-100 border-0 text-right" readonly value="<?php echo isset($tax_amount) ? $tax_amount : 0 ?>" name="tax_amount"></th>
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="8">Total:</th>
									<th class="p-1 text-right" id="total">0</th>
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
					<br>
					<div class="form-group">
						<label for="status2">Status:</label>
						<select name="status2" id="status2" class="form-control">
							<option value="0"></option>
							<option value="1" <?php echo $status2 == 1 ? 'selected' : ''; ?>>Approved</option>
							<option value="2" <?php echo $status2 == 2 ? 'selected' : ''; ?>>Declined</option>
							<option value="3" <?php echo $status2 == 3 ? 'selected' : ''; ?>>For Review</option>
						</select>
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
					<a class="btn btn-flat btn-default" href="?page=po/requisitions/pending_req" style="width:100%;margin-left:5px;font-size:14px;"><i class='fa fa-times-circle'></i>&nbsp;&nbsp;Cancel</a>
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
			<input type="checkbox" class="item-checkbox">
			<input type="text" name="item_status[]" id="item_status_<?php echo $row['id'] ?>">
		</td>
		<td class="align-middle p-0 text-center">
			<textarea name="item_notes[]" id="item_notes"></textarea>
		</td>
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
			<input type="text" class="text-center w-100 border-0 item_id" required/>
		</td>
		<td class="align-middle p-1 item-description"></td>
		<td class="align-middle p-1">
			<input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]" value="0"/>
		</td>
		<td class="align-middle p-1 text-right total-price">0</td>
	</tr>
</table>
</body>
<script>
	$(document).ready(function() {
    // ...

    // Function to check if all checkboxes are checked
    function areAllCheckboxesChecked() {
        // Get all the item-checkbox input elements
        const checkboxes = $('.item-checkbox');

        // Use Array.every() to check if all checkboxes are checked
        const allChecked = checkboxes.toArray().every(function (checkbox) {
            return $(checkbox).prop('checked');
        });

        return allChecked;
    }

    // Add a click event handler for the check button
    $('#checkItemStatusButton').click(function () {
        const allChecked = areAllCheckboxesChecked();

        if (allChecked) {
            alert('All checkboxes are checked.');
        } else {
            alert('Not all checkboxes are checked.');
        }
    });

    // ...
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

    $(document).ready(function() {
    $("#supplier_id").change(function() {
        var selectedOption = $(this).find("option:selected");
        var vatable = parseFloat(selectedOption.data("vatable")) || 0;
        var subtotal = parseFloat($('#sub_total').text().replace(/,/g, '')) || 0;

        // Calculate the discount based on the vatable percentage
        var discount = (subtotal * vatable) / 100;
        
        // Update the discount input field and trigger the calculate function
        $('[name="tax_percentage"]').val(vatable);
        $('[name="tax_amount"]').val(discount.toLocaleString('en-US'));
        
		var total = subtotal - discount;

        // Update the total input field
        $('#total').text(total.toLocaleString('en-US'));
    });
});

	function rem_item(_this){
		_this.closest('tr').remove()
	}
	function calculate(){
		var _total = 0
		$('.po-item').each(function(){
			var qty = $(this).find("[name='qty[]']").val()
			var unit_price = $(this).find("[name='unit_price[]']").val()
			var row_total = 0;
			if(qty > 0 && unit_price > 0){
				row_total = parseFloat(qty) * parseFloat(unit_price)
			}
			$(this).find('.total-price').text(parseFloat(row_total).toLocaleString('en-US'))
		})
		$('.total-price').each(function(){
			var _price = $(this).text()
				_price = _price.replace(/\,/gi,'')
				_total += parseFloat(_price)
		})
		var discount_perc = 0
		if($('[name="discount_percentage"]').val() > 0){
			discount_perc = $('[name="discount_percentage"]').val()
		}
		var discount_amount = _total * (discount_perc/100);
		$('[name="discount_amount"]').val(parseFloat(discount_amount).toLocaleString("en-US"))
		var tax_perc = 0
		if($('[name="tax_percentage"]').val() > 0){
			tax_perc = $('[name="tax_percentage"]').val()
		}
		var tax_amount = _total * (tax_perc/100);
		$('[name="tax_amount"]').val(parseFloat(tax_amount).toLocaleString("en-US"))
		$('#sub_total').text(parseFloat(_total).toLocaleString("en-US"))
		$('#total').text(parseFloat(_total-discount_amount).toLocaleString("en-US"))
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
				//_item.find('.item-unit').text(ui.item.default_unit)
				_item.find('.item-unit').attr('type', 'text').val(ui.item.default_unit);
			}
		})
	}
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
				url:_base_url_+"classes/Master.php?f=save_po",
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
						location.href = "./?page=po/requisitions/pending_req";
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

	function calculateTotal() {
    var _total = 0;
    $('.po-item').each(function() {
        var qty = parseFloat($(this).find("[name='qty[]']").val()) || 0;
        var unit_price = parseFloat($(this).find("[name='unit_price[]']").val()) || 0;
        var row_total = qty * unit_price;
        _total += row_total;
        $(this).find('.total-price').text(parseFloat(row_total).toLocaleString('en-US'));
    });

    var discount_perc = parseFloat($('[name="discount_percentage"]').val()) || 0;
    var discount_amount = _total * (discount_perc / 100);
    $('[name="discount_amount"]').val(parseFloat(discount_amount).toLocaleString('en-US'));

    var tax_perc = parseFloat($('[name="tax_percentage"]').val()) || 0;
    var tax_amount = _total * (tax_perc / 100);
    $('[name="tax_amount"]').val(parseFloat(tax_amount).toLocaleString('en-US'));

    $('#sub_total').text(parseFloat(_total).toLocaleString('en-US'));
    $('#total').text(parseFloat(_total - discount_amount).toLocaleString('en-US'));
}
$(document).ready(function() {

    calculateTotal();


    $('body').on('input', '.po-item [name="qty[]"], .po-item [name="unit_price[]"]', function() {
        calculateTotal();
    });

    $('#item-list tfoot').find('[name="discount_percentage"], [name="tax_percentage"]').on('input', function() {
        calculateTotal();
    });

});
</script>