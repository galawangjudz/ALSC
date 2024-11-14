

<script>
	$(document).ready(function () {
    $("#supplier_id").on("change", function () {
        var supplier_id = $(this).val(); 
        alert("Supplier ID selected: " + supplier_id); 
        $('.item_id').each(function () {
            var your_item = $(this);
            _autocomplete(your_item, supplier_id);
        });
    });
});

function _autocomplete(your_item, supplier_id) {
    your_item.autocomplete({
        source: function (request, response) {
            $.ajax({
                url: _base_url_ + "classes/Master.php?f=search_items2",
                method: 'POST',
                data: {
                    q: request.term,
                    supplier_id: supplier_id 
                },
                dataType: 'json',
                error: function (err) {
                    console.log(err);
                },
                success: function (resp) {
                    response(resp);
                }
            });
        },
        select: function (event, ui) {
            console.log(ui);
			_item.find('input[name="item_id[]"]').val(ui.your_item.id)
			_item.find('.item-description').text(ui.your_item.description)
			//_item.find('.item-unit').text(ui.item.default_unit)
			_item.find('.item-unit').attr('type', 'text').val(ui.your_item.default_unit);
			_item.find('.item-price').attr('type', 'text').val(ui.your_item.unit_price);
        }
    });
}

</script>

<?php
	$subtotal = 0;
	$usertype = $_settings->userdata('user_type'); 
	$type = $_settings->userdata('user_code');
	$level = $_settings->userdata('type');
?>
<body onload="">
<div class="card card-outline card-info">
	<div class="card-header">
		<h5 class="card-title"><b><i><?php echo isset($id) ? "Update Purchase Order": "New Purchase Order" ?></b></i></h5>
	</div>
	<div class="card-body">
		<form action="" id="po-form">
			<input type="hidden" value="<?php echo $level; ?>">
			<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">

				<div class="card-body">
					<div class="row">
						<div class="col-md-6 form-group">
							<label for="supplier_id">Supplier:</label>
							<select name="supplier_id" id="supplier_id" class="custom-select custom-select-sm rounded-0 select2">
								<option value="" disabled <?php echo !isset($supplier_id) ? "selected" : '' ?>></option>
								<?php 
								$supplier_qry = $conn->query("SELECT * FROM `supplier_list` WHERE status = 1 order by `name` asc");
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
					</div>

					
				</div>
				<hr>
				
		
			<div class="row">
				<div class="col-md-12">
					<table class="table table-striped table-bordered" id="item-list">
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
									<input type="text" class="align-middle p-1 item-price" step="any" name="unit_price[]" value="<?php echo $row['unit_price'] ?>"/>
								</td>
									<td class="align-middle p-1 text-right"><?php echo number_format($row['quantity'] * $row['unit_price']) ?>
								</td>
							</tr>
							<?php endwhile;endif; ?>
						</tbody>
						<tfoot>
							<tr class="bg-lightblue">
								<tr>
									<th class="p-1 text-right" colspan="6"><span>
										<button class="btn btn btn-sm btn-flat btn-primary py-0 mx-1" type="button" id="add_row">Add Row</button>
									</span> Sub Total</th>
									<th class="p-1 text-right" id="sub_total">0</th>
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="6">Discount (%):
									<input type="number" step="any" name="discount_percentage" class="border-light text-right" value="<?php echo isset($discount_percentage) ? $discount_percentage : 0 ?>">
									</th>
									<th class="p-1"><input type="text" class="w-100 border-0 text-right" readonly value="<?php echo number_format(isset($discount_amount) ? $discount_amount : 0) ?>" name="discount_amount"></th>
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="6">Tax Inclusive (%):
									<input type="number" step="any" id="tax_percentage" name="tax_percentage" class="border-light text-right" value="<?php echo isset($tax_percentage) ? $tax_percentage : 0 ?>">
									</th>
									<th class="p-1"><input type="text" class="w-100 border-0 text-right" readonly value="<?php echo isset($tax_amount) ? $tax_amount : 0 ?>" name="tax_amount"></th>
								</tr>
								<tr>
									<th class="p-1 text-right" colspan="6">Total:</th>
									<th class="p-1 text-right" id="total">0</th>
								</tr>
							</tr>
						</tfoot>
					</table>
					
					
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
		<td class="align-middle p-1 text-center">
			<button class="btn btn-sm btn-danger py-0" type="button" onclick="rem_item($(this))"><i class="fa fa-times"></i></button>
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
			<input type="text" class="text-right w-100 border-0 item-price" name="unit_price[]">
		</td>
		<td class="align-middle p-1 text-right total-price">0</td>
	</tr>
</table>
</body>
<script>
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
				url:_base_url_+"classes/Master.php?f=manage_po",
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
						location.href = "./?page=po/purchase_orders";
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