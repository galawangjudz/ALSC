<style>
	.nav-group{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-group:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
</style>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h3 class="card-title"><b><i>List of Account Groups</b></i></h3>
		<div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary" style="font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Add New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;">
				<colgroup>
					<col width="5%">
					<!-- <col width="20%"> -->
					<col width="20%">
					<!-- <col width="25%"> -->
					<col width="10%">
					<!-- <col width="15%"> -->
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>#</th>
						<!-- <th>Date Created</th> -->
						<th>Name</th>
						<!-- <th>Description</th> -->
						<th>Type</th>
						<!-- <th>Status</th> -->
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `group_list` where delete_flag = 0 order by `name` asc ");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<!-- <td class=""><?php echo date("Y-m-d H:i",strtotime($row['date_created'])) ?></td> -->
							<td class=""><?php echo $row['name'] ?></td>
							<!-- <td class=""><p class="m-0 truncate-1"><?php echo $row['description'] ?></p></td> -->
							<td class="text-center"><?= $row['type'] == 1 ? 'Debit' : 'Credit' ?></td>
							<!-- <td class="text-center">
								<?php 
									switch($row['status']){
										case 0:
											echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Inactive</span>';
											break;
										case 1:
											echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Active</span>';
											break;
										default:
											echo '<span class="badge badge-default border px-3 rounded-pill">N/A</span>';
												break;
									}
								?>
							</td> -->
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-eye text-dark"></span> View</a>
				                    <?php $qry_get_group = $conn->query("SELECT gl.account,a.group_id,g.id FROM tbl_gl_trans gl LEFT JOIN account_list a ON gl.account = a.code
LEFT JOIN group_list g ON a.group_id = g.id WHERE g.id = '" . $row['id'] . "'"); ?>
									<?php if ($qry_get_group->num_rows <= 0): ?>
										<div class="dropdown-divider"></div>
											<a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"  data-name="<?php echo $row['name'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
		$('.table').dataTable();
	})
	$('#create_new').click(function(){
		uni_modal("Add New Account's Group","groups/manage_group.php")
	})
	$('.edit_data').click(function(){
		uni_modal("Update Account's Group Details","groups/manage_group.php?id="+$(this).attr('data-id'))
	})
	$('.delete_data').click(function(){
		_conf("Are you sure you want to delete '<b>"+$(this).attr('data-name')+"</b>' from Account's Group List permanently?","delete_group",[$(this).attr('data-id')])
	})
	$('.view_data').click(function(){
		uni_modal("Account's Group Details","groups/view_group.php?id="+$(this).attr('data-id'))
	})
	$('.table td, .table th').addClass('py-1 px-2 align-middle')
	$('.table').dataTable({
		columnDefs: [
			{ orderable: false, targets: 5 }
		],
	});
	
	function delete_group($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_group",
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