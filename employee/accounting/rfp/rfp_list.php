<?php if($_settings->chk_flashdata('success')): 
$usercode = $_settings->userdata('user_code'); 
$department = $_settings->userdata('deparment'); 	
$usertype = $_settings->userdata('user_code'); 
?>
	
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
	.nav-rfp-list{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-rfp-list:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><b><i>Request for Payment List</b></i></h3>
		<div class="card-tools">
			<a href="?page=rfp/manage_rfp" class="btn btn-flat btn-primary" style="font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
				<colgroup>
					<col width="5%">
					<col width="5%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr class="bg-navy disabled">
                        <th>#</th>
						<th>RFP No.</th>
						<th>Preparer</th>
						<th>Name</th>
						<th>Req. Dept.</th>
						<th>Payment Form</th>
						<th>Bank Name</th>
						<th>Tran. Date</th>
						<th>Release Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$i = 1;
					
					$qry = $conn->query("SELECT * FROM tbl_rfp WHERE req_dept = '" . $_settings->userdata('department') . "';");
					while($row = $qry->fetch_assoc()):
						$tblId = $row['id'];
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php echo $row['rfp_no'] ?></td>
							<td>
								<?php 
								$prep = $row['preparer'];
								$prep_qry = "SELECT * FROM users WHERE user_code = $prep;";
								$prep_result = $conn->query($prep_qry);

								if($prep_result->num_rows > 0){
									$prep_row = $prep_result->fetch_assoc();
									$username = $prep_row['username'];
									$dept = $prep_row['department'];
									echo '<b>' . $username . '</b> - ' . $dept;
								}
								?>
							</td>
							<td><?php echo $row['name'] ?></td>
							<td><?php echo $row['req_dept']; ?></td>
							<td>
								<?php if ($row['payment_form'] == 0): ?>
									Check
								<?php else: ?>
									Cash
								<?php endif; ?>
							</td>
							<td><?php echo $row['bank_name']; ?></td>
							<td><?php echo date("Y-m-d",strtotime($row['transaction_date'])) ?></td>
							<td><?php echo date("Y-m-d",strtotime($row['release_date'])) ?></td>
							<td align="center">
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
									<?php 
									$qry_approved = $conn->query("SELECT type FROM users WHERE user_code = '" . $_settings->userdata('user_code') . "'"); 
									
									while ($row = $qry_approved->fetch_assoc()):
										$type = $row['type'];
										
										if ($type <= 4): 
										?>
											<a class="dropdown-item approved_data" href="javascript:void(0)" data-id="<?php echo $tblId ?>">
												<span class="fa fa-thumbs-up text-success"></span> Approved
											</a>
											<div class="dropdown-divider"></div>
										<?php endif; ?>
									<?php endwhile; ?>	
										<a class="dropdown-item view_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">
											<span class="fa fa-eye text-dark"></span> View
										</a>
										<div class="dropdown-divider"></div>
										
										<a class="dropdown-item edit_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">
											<span class="fa fa-edit text-primary"></span> Edit
										</a>

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
    $('[data-toggle="tooltip"]').tooltip();

	$('.approved_data').click(function(){
        _conf("Are you sure you want to approved this request for payment?","approved_rfp",[$(this).attr('data-id')])
    })
	
    $('.view_data').click(function() {
        var id = $(this).data('id').toString();
		var redirectUrl = '?page=rfp/manage_rfp&id=' + id;
		window.location.href = redirectUrl;
    });

	$('.edit_data').click(function() {
        var id = $(this).data('id').toString();
		var redirectUrl = '?page=rfp/manage_rfp&id=' + id;
		window.location.href = redirectUrl;
    });

    $('.modal-title').css('font-size', '18px');
    $('.table th,.table td').addClass('px-1 py-0 align-middle')
    $('.table').dataTable();
});
function approved_rfp($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=approved_rfp",
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