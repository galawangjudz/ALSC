<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
	.nav-acc{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-acc:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
</style>
<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title"><b><i>Chart of Accounts</b></i></h5>
			<div class="card-tools">
				<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary" style="font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Add New</a>
			</div>
		</div>
		<div class="card-body">
            <div class="container-fluid">
            <div class="container-fluid">
                	<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
						<colgroup>
							<col width="5%">
							<col width="20%">
							<col width="20%">
							<col width="25%">
							<col width="15%">
						</colgroup>
						<thead>
							<tr>
							<th>#</th>
							<th>Code</th>
							<th>Group List</th>
							<th>Account Name</th>
							<!-- <th>Description</th>
							<th>Status</th> -->
							<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php 
							$i = 1;
							
							$qry = $conn->query("SELECT accounts.*, g.name as gname FROM `group_list` g INNER JOIN `account_list` accounts ON g.id = accounts.group_id WHERE accounts.delete_flag = 0");

							while ($row = $qry->fetch_assoc()):
								$id = $row['id'];
								$name = $row['name'];
								$gname = $row['gname'];
								?>
									<tr>
										<td class="text-center"><?php echo $i++; ?></td>
										<td class=""><?php echo $row['code'] ?></td>
										<td class=""><?php echo $row['gname'] ?></td>
										<td class=""><?php echo $row['name'] ?></td>
										<!-- <td class=""><p class="m-0 truncate-1"><?php echo $row['description'] ?></p></td> -->
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
												<?php $qry_get_accs = $conn->query("SELECT account FROM tbl_gl_trans WHERE account = '" . $row['code'] . "'"); ?>
												<?php if ($qry_get_accs->num_rows <= 0): ?>
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
<script>
    $(document).ready(function(){
		$('.table').dataTable();
	})
	$('#create_new').click(function(){
		uni_modal("Add New Account","accounts/manage_account.php",'mid-large')
	})
	$('.edit_data').click(function(){
		uni_modal("Update Account Details","accounts/manage_account.php?id="+$(this).attr('data-id'),'mid-large')
	})
	$('.delete_data').click(function(){
		_conf("Are you sure you want to delete '<b>"+$(this).attr('data-name')+"</b>' from Chart of Accounts permanently?","delete_account",[$(this).attr('data-id')])
	})
	$('.view_data').click(function(){
		uni_modal("Account Details","accounts/view_account.php?id="+$(this).attr('data-id'),'mid-large')
	})
	$('.table td, .table th').addClass('py-1 px-2 align-middle')
	$('.table').dataTable({
		columnDefs: [
			{ orderable: false, targets: 5 }
		],
	});

    function delete_account($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_account",
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
					console.log('dsdsds');
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>