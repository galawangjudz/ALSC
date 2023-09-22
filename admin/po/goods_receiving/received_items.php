<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `po_approved_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
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
	$type = $_settings->userdata('id');
	$level = $_settings->userdata('type');
?>
<div class="card card-outline card-info">
	<div class="card-header">
		<form action="" id="po-form">
		<h3 class="card-title"><b><i><?php echo isset($id) ? "Update Purchase Order Details": "New Purchase Order" ?></b></i></h5>
		<div class="card-tools">
			<button class="btn btn-sm btn-flat btn-success" id="print" type="button" style="font-size:14px;float:right;margin-left:5px;"><i class="fa fa-print"></i>&nbsp;&nbsp;Print</button>
		</div>
	</div>
	<div class="card-body" id="out-print">
		<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
		<div class="row">
			<div class="col-6 d-flex align-items-center">
				<div>
				<h2><label style="backround-color:red;">PURCHASE ORDER</h2>
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
            $receiver_qry = $conn->query("SELECT * FROM users where id = '{$receiver_id}'");
            $receiver2_qry = $conn->query("SELECT * FROM users where id = '{$receiver2_id}'");
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
						<?php if($level < 4): ?>
							<col width="15%">
						<?php endif; ?>
						<col width="8%">
						<col width="8%">
						<?php if($level < 4): ?>
							<col width="9%">
						<?php endif; ?>
					</colgroup>
					<thead>
						<tr class="bg-navy disabled">
							<th class="px-1 py-1 text-center">Qty Ordered</th>
							<th class="px-1 py-1 text-center">Unit</th>
							<th class="px-1 py-1 text-center">Item</th>
							<th class="px-1 py-1 text-center">Description</th>
							<?php if($level < 4): ?>
								<th class="px-1 py-1 text-center">Price (per piece)</th>
							<?php endif; ?>
							<th class="px-1 py-1 text-center">Received</th>
							<th class="px-1 py-1 text-center">Outstanding</th>
							<th class="px-1 py-1 text-center">No. of Delivered Items</th>
							<?php if($level < 4): ?>
								<th class="px-1 py-1 text-center">Total</th>
							<?php endif; ?>
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
								<input type="number" class="text-center w-100 border-0" step="any" name="qty[]" value="<?php echo $row['quantity'] ?>" style="pointer-events:none;border:none;background-color: transparent;"/>
							</td>
							<td class="align-middle p-1">
								<input type="text" class="text-center w-100 border-0" name="unit[]" value="<?php echo $row['default_unit'] ?>" style="pointer-events:none;border:none;background-color: transparent;"/>
							</td>
							<td class="align-middle p-1">
								<input type="hidden" name="item_id[]" value="<?php echo $row['item_id'] ?>">
								<input type="text" class="w-100 border-0 item_id" value="<?php echo $row['name'] ?>" style="pointer-events:none;border:none;background-color: transparent;" required/>
							</td>
							<td class="align-middle p-1 item-description"><?php echo $row['description'] ?></td>
							<input type="hidden" name="unit_price[]" value="<?php echo ($row['unit_price']) ?>"/>
							<?php if($level < 4): ?>
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
								<input type="number" step="any" class="text-right w-100 border-0" name="del_items[]" id="txtdelitems" style="background-color:yellow;;text-align:center;" value="0"/>
							</td>
							<?php if($level < 4): ?>
								<td class="align-middle p-1 text-right total-price"><?php echo number_format($row['quantity'] * $row['unit_price']) ?></td>
							<?php endif; ?>
						</tr>
						<?php endwhile;endif; ?>
					</tbody>
					<tr style="display:none;">
						<td class="p-1 text-right" colspan="8">Total Outstanding:</td>
						<td class="p-1 text-right" id="outstanding-total">0</td>
					</tr>
					<?php if($level < 4): ?>
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
					<?php if ($level <= 4){ ?>
					<div class="col-md-6" id="hidden-status">
						<label for="status" class="control-label">Status:</label>
						<select name="status" id="status" class="form-control form-control-sm rounded-0">
							<option value="0" <?php echo ($status == 0) ? 'selected' : ''; ?>>Closed</option>
							<option value="1" <?php echo ($status == 1) ? 'selected' : ''; ?>>Open</option>
						</select>
					</div>
				<?php } ?>
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

