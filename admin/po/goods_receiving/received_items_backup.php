<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `po_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
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
</style>
<?php
$usertype = $_settings->userdata('user_type'); 
$type = $_settings->userdata('user_code');
$level = $_settings->userdata('type');
?>
<div class="card card-outline card-info">
	<div class="card-header">
		<form action="" id="po-form">
		<h3 class="card-title"><?php echo isset($id) ? "Update Purchase Order Details": "New Purchase Order" ?> </h3>
	</div>
	<div class="card-tools">
            <button class="btn btn-sm btn-flat btn-success" id="print" type="button"><i class="fa fa-print"></i> Print</button>
	</div>
	<div class="card-body" id="out-print">
			<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
			<div class="row">
				<div class="col-md-6 form-group">
					<label for="supplier_id">Supplier</label>
						<select name="supplier_id" id="supplier_id" class="custom-select custom-select-sm rounded-0 select2">
							<option value="" disabled <?php echo !isset($supplier_id) ? "selected" :'' ?>></option>
							<?php 
								$supplier_qry = $conn->query("SELECT * FROM `supplier_list` order by `name` asc");
								while($row = $supplier_qry->fetch_assoc()):
							?>
							<option value="<?php echo $row['id'] ?>" <?php echo isset($supplier_id) && $supplier_id == $row['id'] ? 'selected' : '' ?> <?php echo $row['status'] == 0? 'disabled' : '' ?>><?php echo $row['name'] ?></option>
							<?php endwhile; ?>
						</select>
				</div>
				<div class="col-md-6 form-group">
					<label for="po_no">PO # <span class="po_err_msg text-danger"></span></label>
					<input type="text" class="form-control form-control-sm rounded-0" id="po_no" name="po_no" value="<?php echo isset($po_no) ? $po_no : '' ?>">
					<small><i>Leave this blank to Automatically Generate upon saving.</i></small>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6 form-group">
					<label for="department">Requesting Department:</label>
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
			</div>
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered" id="item-list">
						<colgroup>
							<col width="5%">
							<col width="10%">
							<col width="20%">
							<col width="30%">
							<col width="15%">
							<col width="15%">
                            <col width="15%">
                            <col width="15%">
						</colgroup>
						<thead>
							<tr class="bg-navy disabled">
								<th class="px-1 py-1 text-center">Qty Ordered</th>
								<th class="px-1 py-1 text-center">Unit</th>
								<th class="px-1 py-1 text-center">Item</th>
								<th class="px-1 py-1 text-center">Description</th>
								<th class="px-1 py-1 text-center">Price (per piece)</th>
                                <th class="px-1 py-1 text-center">Received</th>
                                <th class="px-1 py-1 text-center">Outstanding</th>
                                <th class="px-1 py-1 text-center">No. of Delivered Items</th>
								<th class="px-1 py-1 text-center">Total</th>
							</tr>
						</thead>
						<tbody>
							<?php 
							if(isset($id)):
							$order_items_qry = $conn->query("SELECT o.*,i.name, i.description FROM `approved_order_items` o inner join item_list i on o.item_id = i.id where o.`po_id` = '$id' ");
							echo $conn->error;
							while($row = $order_items_qry->fetch_assoc()):
							?>
							<tr class="po-item" data-id="">
								<td class="align-middle p-0 text-center">
									<input type="number" class="text-center w-100 border-0" step="any" name="qty[]" value="<?php echo $row['quantity'] ?>"/>
								</td>
								<td class="align-middle p-1">
									<input type="text" class="text-center w-100 border-0" name="unit[]" value="<?php echo $row['unit'] ?>"/>
								</td>
								<td class="align-middle p-1">
									<input type="hidden" name="item_id[]" value="<?php echo $row['item_id'] ?>">
									<input type="text" class="text-center w-100 border-0 item_id" value="<?php echo $row['name'] ?>" required/>
								</td>
								<td class="align-middle p-1 item-description"><?php echo $row['description'] ?></td>
								<td class="align-middle p-1">
									<input type="number" step="any" class="text-right w-100 border-0" name="unit_price[]"  value="<?php echo ($row['unit_price']) ?>"/>
								</td>
                                <td class="align-middle p-1">
									<input type="number" step="any" class="text-right w-100 border-0" name="received[]"  value="<?php echo ($row['received']) ?>" readonly/>
								</td>
                                <td class="align-middle p-1">
									<input type="number" step="any" class="text-right w-100 border-0" name="outstanding[]"  value="<?php echo ($row['outstanding']) ?>" readonly/>
								</td>
                                <td class="align-middle p-1">
									<input type="number" step="any" class="text-right w-100 border-0" name="del_items[]"  value="0"/>
								</td>
								<td class="align-middle p-1 text-right total-price"><?php echo number_format($row['quantity'] * $row['unit_price']) ?></td>
							</tr>
							<?php endwhile;endif; ?>
						</tbody>
						<tfoot>
							<tr class="bg-lightblue">
								<tr>
									<th class="p-1 text-right" colspan="8"><span><button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button></span> Sub Total</th>
									<th class="p-1 text-right" id="sub_total">0</th>
								</tr>
                                <tr>
                                	<td class="p-1 text-right" id="outstanding-total">0</td>
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
					</table>
					<div class="row">
						<div class="col-md-6">
							<label for="notes" class="control-label">Remarks:</label>
							<textarea name="notes" id="notes" cols="10" rows="4" class="form-control rounded-0"><?php echo isset($notes) ? $notes : '' ?></textarea>
						</div>
						<?php if ($level < 4){ ?>
								<div class="col-md-6">
									<label for="status" class="control-label">Status:</label>
									<select name="status" id="status" class="form-control form-control-sm rounded-0">
										<option value="0" <?php echo isset($status) && $status == 0 ? 'selected': '' ?>>Closed</option>
										<option value="1" <?php echo isset($status) && $status == 1 ? 'selected': '' ?>>Open</option>
									</select>
								</div>
						<?php } ?>
					</div>
				</div>
			</div>
		</form>
		<div class="card-footer">
			<button class="btn btn-flat btn-primary" form="po-form">Save</button>
			<a class="btn btn-flat btn-default" href="?page=purchase_orders">Cancel</a>
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
				<input type="hidden" name="item_id[]">
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
<script>
	$(function(){
    $('#print').click(function(e){
        e.preventDefault();
        start_loader();
        var _h = $('head').clone();
        var _p = $('#out-print').clone();

        _p.find('.po-item').each(function() {
            var received = parseFloat($(this).find("[name='received[]']").val());
            var outstanding = parseFloat($(this).find("[name='outstanding[]']").val());

            if (received === 0 && outstanding > 0) {
                $(this).remove();
            }
        });

        var _el = $('<div>');
        _p.find('thead th').attr('style','color:black !important');
        _el.append(_h);
        _el.append(_p);

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

</script>
<script>
	function rem_item(_this){
		_this.closest('tr').remove()
	}
	function calculate(){
		var _total = 0
		$('.po-item').each(function(){
			var outstanding = $(this).find("[name='outstanding[]']").val()
			var unit_price = $(this).find("[name='unit_price[]']").val()
			var row_total = 0;
			if(outstanding > 0 && unit_price > 0){
				row_total = parseFloat(outstanding) * parseFloat(unit_price)
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
				calculate();
			});
			$('#item-list tfoot').find('[name="discount_percentage"],[name="tax_percentage"]').on('input keypress', function(e) {
				calculate();
			});

			initDeliveredItemsEvents();
		});
	})
    function initDeliveredItemsEvents() {
    $('#item-list .po-item').each(function() {
        var tr = $(this);
        tr.find('[name="received[]"]').data('initial-received', parseFloat(tr.find('[name="received[]"]').val()));
		tr.find('[name="outstanding[]"]').data('initial-outstanding', parseFloat(tr.find('[name="outstanding[]"]').val()));
        tr.find('[name="del_items[]"]').on('input', function(e) {
            var deliveredItems = parseFloat($(this).val());
            var initialReceived = tr.find('[name="received[]"]').data('initial-received');

			var initialOutstanding = tr.find('[name="outstanding[]"]').data('initial-outstanding');

            var received = initialReceived + deliveredItems;
			var outstanding =initialOutstanding -deliveredItems;

            tr.find('[name="received[]"]').val(received);
			tr.find('[name="outstanding[]"]').val(outstanding);
            tr.find('[name="qty[]"],[name="unit_price[]"]').trigger('input');
        });
    });
}

</script>

