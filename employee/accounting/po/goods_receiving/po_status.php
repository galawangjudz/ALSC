<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<!-- <link rel="stylesheet" href="css/cpo.css"> -->
<div class="card card-outline card-primary">
	<div class="card-header">
	<h3 class="card-title"><b><i>Closed Purchase Orders</b></i></h3><br>
	Blue - PO Approved<br>
	Green - Finance Manager Approved<br>
	Gray - CFO Approved<br>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div id="closed-purchase-orders-table">
        <table class="table table-bordered table-stripped" style="width:100%;text-align:center;">
							<colgroup>
								<col width="6%">
								<col width="10%">
								<col width="6%">
								<col width="30%">
								<col width="15%">
								<col width="10%">
								<col width="8%">
								<col width="7%">
							</colgroup>
							<thead>
								<tr class="bg-navy disabled">
									<th>#</th>
									<th>Date Created</th>
									<th>PO #</th>
									<th>Supplier</th>
									<th>Requesting Dept.</th>
									<th>Total Amount</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								$i = 1;
								$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id order by po.date_created DESC");
								while($row = $qry->fetch_assoc()):
									$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
									$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
								?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
									<td class=""><?php echo $row['po_no'] ?></td>
									<td class=""><?php echo $row['sname'] ?></td>
									<td class=""><?php echo $row['department'] ?></td>
									<td class="text-right"><?php echo number_format($row['total_amount'],2) ?></td>
                                    <td>
										<?php 
											if ($row['status'] == '1' && $row['status2'] == '0' && $row['status3'] == '0') {
												echo '<span class="badge badge-primary">PO Approved</span>';
											} elseif ($row['status'] == '1' && $row['status2'] == '1' && $row['status3'] == '0') {
												echo '<span class="badge badge-success">FM Approved</span>';
											} elseif ($row['status'] == '1' && $row['status2'] == '1' && $row['status3'] == '1') {
												echo '<span class="badge badge-secondary">CFO Approved</span>';
											} else {
												echo '<span class="badge badge-danger">Pending</span>';
											}
										?>
                                    </td>



									<td align="center">
										<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
												Action
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<div class="dropdown-menu" role="menu">
											<?php 
												if ($row['fpo_status'] != '3'){?>
													<a class="dropdown-item" href="?page=po_purchase_orders/manage_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
												<?php } else{ ?>
													<a class="dropdown-item" href="?page=po_purchase_orders/verify_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
												<?php } ?>
												

												<?php if ($row['fpo_status'] != '3'){?>
													<div class="dropdown-divider"></div>
												<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
											<?php }?>
										</div>
									</td>
								</tr>
								<?php endwhile; ?>
							</tbody>
						</table>
        </div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.view_item_price_history').click(function(){
			uni_modal_right("<i class='fa fa-info'></i> Price History", "po_items/item_price_history.php?id=" + $(this).attr('data-id') + "&name=" + $(this).attr('data-name'), "mid-large");
		});
		$('.delete_data').click(function(){
			_conf("Are you sure you want to delete this item permanently?","delete_item",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Create New Item","po_items/manage_item.php")
		})
		$('.view_supplier').click(function(){
			uni_modal("<i class='fa fa-info-circle'></i> Supplier's Details","closed_po/cpo_supplier_update.php?id="+$(this).attr('data-id'),"")
		})
		$('.view_items').click(function(){
			uni_modal("<i class='fa fa-info-circle'></i> Item's Details","closed_po/items_update.php?id="+$(this).attr('data-id'),"")
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Edit Item's Details","po_items/manage_item.php?id="+$(this).attr('data-id'))
		})
		$('.table th,.table td').addClass('px-1 py-0 align-middle')
		$('.table').dataTable();
	})
	function delete_item($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_item",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>