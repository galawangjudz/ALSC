<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<link rel="stylesheet" href="css/items.css">
<div class="card card-outline card-primary">
	<div class="card-header">
	<h3 class="card-title"><b><i>List of Items/Services</b></i></h3>
		<div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary" style="font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
				<colgroup>
					<col width="5%">
					<col width="12%">
					<col width="22%">
					<col width="22%">
					<col width="20%">
					<col width="12%">
					<col width="6%">
					<col width="8%">
				</colgroup>
				<thead>
					<tr class="bg-navy disabled">
						<th>#</th>
						<th>Code</th>
						<th>Name</th>
						<th>Description</th>
						<th>Supplier</th>
						<th>Date Created</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					$qry = $conn->query("SELECT * from `item_list` order by (`date_created`) desc");
					while($row = $qry->fetch_assoc()):
						$row['description'] = html_entity_decode($row['description']);
					?>
					<tr>
						<td class="text-center"><?php echo $i++; ?></td>
						<td><?php echo $row['item_code'] ?></td>
						<td>
						<?php
						$qry_get_price = $conn->query("SELECT * from approved_order_items where item_id = '" . $row['id'] . "'");
						if ($qry_get_price->num_rows > 0) {
							echo "<a class='basic-link view_item_price_history' data-id='" . $row['id'] . "' data-name='" . $row['name'] . "'>" . $row['name'] . "</a>";
						} else {
							echo $row['name'];
						}
						?>    	
						</td>
						<td class='truncate-3' title="<?php echo $row['description'] ?>"><?php echo $row['description'] ?></td>
						<td>
						<?php
							$supplierId = $row['supplier_id'];
							$query = "SELECT * FROM supplier_list WHERE id = '$supplierId'";
							$result = $conn->query($query);

							if ($result) {
								$supplierData = $result->fetch_assoc();
								echo $supplierData['name'];
							} else {
								echo "Error: " . $conn->error;
							}
						?>
						</td>
						<td><?php echo $row['date_created'] ?></td>
						<td class="text-center">
							<?php if($row['status'] == 1): ?>
								<span class="badge rounded-pill badge-primary"><i class="fa fa-check fa-xs" aria-hidden="true"></i></span>
							<?php else: ?>
								<span class="badge rounded-pill badge-secondary"><i class="fa fa-times fa-xs" aria-hidden="true"></i></span>
							<?php endif; ?>
						</td>
						<td align="center">
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon py-0" data-toggle="dropdown">
									Action
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
								<a class="dropdown-item view_data" href="javascript:void(0)" data-id = "<?php echo $row['id'] ?>"><span class="fa fa-info text-primary"></span> View</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item edit_data" href="javascript:void(0)" data-id = "<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
			_conf("Are you sure you want to delete this item/service permanently?","delete_item",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Create New Item/Service","po_items/manage_item.php")
		})
		$('.view_data').click(function(){
			uni_modal("<i class='fa fa-info-circle'></i> Details","po_items/view_details.php?id="+$(this).attr('data-id'),"")
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Edit Details","po_items/manage_item.php?id="+$(this).attr('data-id'))
		})
		$('.modal-title').css('font-size', '18px');
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