<style>
    .img-thumb-path{
        width:100px;
        height:80px;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<div class="card card-outline card-primary rounded-0 shadow">
	<div class="card-header">
		<h3 class="card-title"><b><i>List of Transfer Accounts</b></i></h3>
		<div class="card-tools">
			<!-- <a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary" style="font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Add New</a>
		 --></div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-hover table-striped">
				<colgroup>
					<col width="5%">
					<col width="20%">
					<col width="20%">
					<col width="25%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr class="bg-gradient-primary text-light">
						<th>#</th>
						<th>Date Transfer</th>
						<th>Account</th>
						<th>Location</th>
						<th>Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT p.*, r.c_acronym, l.c_block, l.c_lot FROM properties p LEFT JOIN t_lots l on l.c_lid = p.c_lot_lid LEFT JOIN t_projects r ON l.c_site = r.c_code where c_reopen = 1");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo date("Y-m-d",strtotime($row['c_date_of_sale'])) ?></td>
							<td class=""><?php echo $row['property_id'] ?></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></p></td>
							<td class="text-center">
								<?php 
									switch($row['c_reopen']){
										case 0:
											echo '<span class="badge badge-danger bg-gradient-primary px-3 rounded-pill">Active</span>';
											break;
										case 1:
											echo '<span class="badge badge-primary bg-gradient-danger px-3 rounded-pill">Reopen</span>';
											break;
										default:
											echo '<span class="badge badge-default border px-3 rounded-pill">N/A</span>';
												break;
									}
								?>
							</td>
							<td align="center">
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
								<a class="dropdown-item create_new" href="./?page=transfer/create&id=<?php echo md5($row['c_csr_no']) ?>&prop_id=<?php echo $row['property_id']?>" ><span class="fa fa-eye text-dark"></span> Create</a>
								<div class="dropdown-divider"></div>
							<!-- 	<a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['property_id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
								<div class="dropdown-divider"></div> -->
								<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['property_id'] ?>"  data-name="<?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"]  ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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

        $('.create_new').click(function(){
			uni_modal("Update Account Details","transfer/create.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.delete_data').click(function(){
			_conf("Are you sure to delete '<b>"+$(this).attr('data-name')+"</b>' from Accounts List permanently?","delete_account",[$(this).attr('data-id')])
		})
		$('.view_data').click(function(){
			uni_modal("Account Details","backout/view_backout.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.table td, .table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
	})
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