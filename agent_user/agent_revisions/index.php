<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
	.nav-ra{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
	}
	.nav-ra:hover{
		background-color:#007bff!important;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
	}
</style>
<div class="card" id="container" style="display: flex; justify-content: center;">
	<div class="navbar-menu" style="width: 100%; display: flex; justify-content: center; max-width: 1200px; margin: 0 auto;">
		<div class="dropdown">
			<a href="#" class="main_menu dropdown-toggle" style="border-left: solid 3px white;" onclick="highlightLink('ralink')"><i class="nav-icon fas fa-list"></i>&nbsp;&nbsp;&nbsp;RAs List</a>
			<ul class="dropdown-menu" style="border-radius: 0px; height: 122px; margin: 2px; padding-top:2px;"> 
				<li><a href="<?php echo base_url ?>agent_user/?page=agent_sales" style="margin-top: -8px;"><i class="nav-icon fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Pendings</a></li>
				<li><a href="<?php echo base_url ?>agent_user/?page=agent_revisions" style="background-color:#E8E8E8;"><i class="nav-icon fa fa-pen"></i>&nbsp;&nbsp;&nbsp;Revisions</a></li>
				<li><a href="<?php echo base_url ?>agent_user/?page=agent_ra"><i class="nav-icon fas fa-thumbs-up"></i>&nbsp;&nbsp;&nbsp;Approved</a></li>
			</ul>
		</div>
		<a href="<?php echo base_url ?>agent_user/?page=agent_ca" class="main_menu" onclick="highlightLink('ca-link')"><i class="nav-icon fas fa-hands-helping"></i>&nbsp;&nbsp;&nbsp;Credit Assessments List</a>
		<a href="<?php echo base_url ?>agent_user/?page=agent_fa" class="main_menu" onclick="highlightLink('fa-link')"><i class="nav-icon fas fa-file"></i>&nbsp;&nbsp;&nbsp;CFO Approvals List</a>
	</div>
</div>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h3 class="card-title"><b><i>List of `For Revisions`</b></i></h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped" style="text-align:center;width:100%;">
				<thead>
					<tr>
					<th>Prepared Date</th>
					<th>Prepared by </th>	
					<th>Ref. No.</th>
					<th>Status</th>
					<th>Location </th>		
					<th>Buyers Name</th>
					<th>Net TCP</th>
					<th>SOS Approval</th>
					<th>COO Approval</th>
					<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
					$type = $_settings->userdata('type');
					$username = $_settings->userdata('username');
					$where = "c_created_by = '$username'";

					if ($type < 5 ){
						$qry = $conn->query("select q.c_acronym, z.c_block, z.c_lot, y.last_name, y.first_name, y.middle_name, y.suffix_name , x.* from t_csr x , t_csr_buyers y ,
										t_lots z,  t_projects q
										where c_revised = 1 and  x.c_csr_no = y.c_csr_no 
										and x.c_lot_lid = z.c_lid 
										and z.c_site = q.c_code 
										and y.c_buyer_count = 1 order by c_date_updated DESC");
					}else{

						$qry = $conn->query("select q.c_acronym, z.c_block, z.c_lot, y.last_name, y.first_name, y.middle_name, y.suffix_name , x.* from t_csr x , t_csr_buyers y ,
										t_lots z,  t_projects q
										where c_revised = 1 and  x.c_csr_no = y.c_csr_no 
										and x.c_lot_lid = z.c_lid 
										and z.c_site = q.c_code 
										and y.c_buyer_count = 1 and ".$where."  order by c_date_updated DESC");
					}
						while($row = $qry->fetch_assoc()):
							$timeStamp = date( "m/d/Y", strtotime($row['c_date_updated']));
					?>
						<tr>
								<td class="text-center"><?php echo $timeStamp ?> </td>
								<td class="text-center"><?php echo $row["c_created_by"] ?></td>
                                <td><?php echo $row['ref_no'] ?></td>
								<?php if($row['c_active'] == 0): ?>
									<td class="text-center"><span class="badge badge-danger">Inactive</span></td>
								<?php else: ?>
									<td class="text-center"><span class="badge badge-success">Active</span></td>
								<?php endif;?>
                                
                                <td><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></td>
                                <td class="text-center"><?php echo $row["last_name"]. ' ' .$row["suffix_name"]. ','  .$row["first_name"] .' ' .$row["middle_name"]?></td>

                                <td class="text-right"><?php echo "P".number_format($row["c_net_tcp"], 2) ?></td>

                        
                            <?php if($row['c_verify'] == 0){ ?>
                                <td class="text-center"><span class="badge badge-warning">Pending</span></td>
                            <?php }elseif($row['c_verify'] == 1){ ?>
                                <td class="text-center"><span class="badge badge-info">SOS Verified</span></td>
                            <?php }elseif($row['c_verify'] == 2){ ?>
                                <td class="text-center"><span class="badge badge-danger">SOS Void</span></td>
                            <?php } ?>
                             
                            
							<?php if($row['coo_approval'] == 0){ ?> 
                                <td class="text-center"><span class="badge badge-warning">Pending</span></td>
                            <?php }elseif($row['coo_approval'] == 3){ ?>
                                <td class="text-center"><span class="badge badge-danger">Cancelled</span></td>
                            
                            <?php }elseif($row['coo_approval'] == 1){ ?>
                                <td class="text-center"><span class="badge badge-success">Approved</span></td>
                            <?php }
                            elseif($row['coo_approval'] == 2){ ?> 
                                <td class="text-center"><span class="badge badge-danger">Lapsed</span></td>
                            <?php } ?>
							<td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
								<div class="dropdown-menu" role="menu">
								<?php if($row['c_verify'] == 1){ ?> 
                                	<div class="dropdown-menu" role="menu">
									<a class="dropdown-item" href="./?page=agent_revisions/ra-view&id=<?php echo md5($row['c_csr_no']) ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
								<?php }else {?> 
									<a class="dropdown-item" href="./?page=agent_revisions/ra-view&id=<?php echo md5($row['c_csr_no']) ?>"><span class="fa fa-eye text-primary"></span> View</a>
								<?php } ?>
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
			_conf("Are you sure you want to delete this RA permanently?","delete_csr",[$(this).attr('data-id')])
		})
		$('.table').dataTable(
			{"ordering":false}
		);
		$('#uni_modal').on('shown.bs.modal', function() {
			$('.select2').select2({width:'resolve'})
			$('.summernote').summernote({
				height: 200,
				toolbar: [
					[ 'style', [ 'style' ] ],
					[ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
					[ 'fontname', [ 'fontname' ] ],
					[ 'fontsize', [ 'fontsize' ] ],
					[ 'color', [ 'color' ] ],
					[ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
					[ 'table', [ 'table' ] ],
					[ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
				]
			})
		})
	})
	function delete_csr($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_csr",
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