<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
.table{
    font-size: 12px;
}
.table-responsive {
    overflow-x: auto;
    overflow-y: hidden;
    white-space: nowrap; 
}
#data-table {
    min-width: 1200px; 
    width: auto; 
}
@media (min-width: 768px) {
	#uni_modal, #confirm_modal {
		display: none; 
		align-items: center;
		justify-content: center;
		margin: 0 140px;
	}
}
@media (min-width: 820px) {
	#uni_modal, #confirm_modal {
		display: none; 
		align-items: center;
		justify-content: center;
		margin: 0 160px;
	}
}
@media (min-width: 1024px) {
	#uni_modal, #confirm_modal {
		display: none; 
		align-items: center;
		justify-content: center;
		margin: 0 20px;
	}
}
</style>
<link rel="stylesheet" href="css/supplier.css">
<div class="card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><b><i>List of Suppliers</b></i></h3>
		<div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary" style="font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<div class="table-responsive" style="overflow-x: auto;">
				<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
					<colgroup>
						<col width="8%">
						<col width="10%">
						<col width="30%">
						<!-- <col width="20%"> -->
						<col width="30%">
						<!-- <col width="6%"> -->
						<col width="6%">
						<col width="10%">
					</colgroup>
					<thead>
						<tr class="bg-navy disabled">
							<th>#</th>
							<th>Date Created</th>
							<th>Supplier</th>
							<!-- <th>Contact Person</th> -->
							<th>Address</th>
							<!-- <th>Vatable</th> -->
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `supplier_list` order by (`date_created`) asc ");
						while($row = $qry->fetch_assoc()):
						?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td>
								<td><?php echo $row['short_name'] ?></td>
								<!-- <td>
									<p class="m-0">
										<?php echo $row['contact_person'] ?><br>
										<?php echo $row['contact'] ?>
									</p>
								</td> -->
								<td class='truncate-3' title="<?php echo $row['address'] ?>"><?php echo $row['address'] ?></td>
								<!-- <td>
									<?php if($row['vatable'] == 0): ?>
										<span class="badge badge-secondary">No</span>
									<?php else: ?>
										<span class="badge badge-primary">Yes</span>
									<?php endif; ?>
								</td> -->
								<td class="text-center">
									<?php if($row['status'] == 1): ?>
										<span class="badge badge-success">Active</span>
									<?php else: ?>
										<span class="badge badge-secondary">Inactive</span>
									<?php endif; ?>
								</td>
								<td align="center">
									<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon py-0" data-toggle="dropdown">
											Action
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<a class="dropdown-item view_data" href="javascript:void(0)" data-id = "<?php echo $row['id'] ?>"><span class="fa fa-info text-primary"></span>&nbsp;&nbsp;View</a>
										<?php $qry_get_svs = $conn->query("SELECT supplier_id FROM po_list WHERE supplier_id = '" . $row['id'] . "'"); ?>
										<?php if ($qry_get_svs->num_rows <= 0): ?>
											<div class="dropdown-divider"></div>
												<a class="dropdown-item edit_data" href="javascript:void(0)" data-id = "<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">
												<span class="fa fa-trash text-danger"></span> Delete
											</a>
										<?php endif; ?>
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
		$('.delete_data').click(function(){
			_conf("Are you sure you want to delete this supplier permanently?","delete_supplier",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Register New Supplier","po_suppliers/manage_supplier.php")
		})
		$('.view_data').click(function(){
			uni_modal("<i class='fa fa-info-circle'></i> Supplier's Details","po_suppliers/view_details.php?id="+$(this).attr('data-id'),"")
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Edit Supplier's Details","po_suppliers/manage_supplier.php?id="+$(this).attr('data-id'))
		})
		$('.modal-title').css('font-size', '18px');
		$('.table th,.table td').addClass('px-1 py-0 align-middle')
		$('.table').dataTable();

	})
	function delete_supplier($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_supplier",
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