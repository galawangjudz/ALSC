<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
	.main_menu{
		float:left;
		width:227px;
		height:40px;
		line-height:40px;
		text-align:center;
		color:black!important;
	}
	.navbar{
		width:100%;
		height:auto;
	}
	.main_menu:hover{
		border-bottom: solid 2px blue;
		background-color:#E8E8E8;
	}
	#container{
		margin-right:auto;
		margin-left:auto;
		width:100%;
		position:relative;
		padding-left:50px;
		padding-right:50px;
		background-color:transparent;
	}
	#ra-link{
		border-bottom: solid 2px blue;
		background-color:#F5F5F5;
	}
	.dropdown:hover .dropdown-menu {
		display: block;
		margin-top:40px;
		float:left;
		width:227px;
		height:130px;
		line-height:30px;
		text-align:center;
		color:black!important;
	}
	.dropdown-menu li a{
		color:black!important;
		border:gainsboro 1px solid;
		display: block;
		height:40px;
		line-height:40px;
	}
	.dropdown-menu li a:hover{
		color:black!important;
		border:gainsboro 1px solid;
		display: block;
		height:40px;
		line-height:40px;
		background-color:#E8E8E8;
	}
</style>

<div class="card" id="container">
    <div class="navbar-menu">
		<div class="dropdown">
			<a href="#" class="main_menu dropdown-toggle" id="ra-link" onclick="highlightLink('ralink')">RA List</a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo base_url ?>admin/?page=sales">Pending</a></li>
					<li><a href="<?php echo base_url ?>admin/?page=revision">Revision</a></li>
					<li><a href="<?php echo base_url ?>admin/?page=ra">Approved</a></li>
				</ul>
		</div>
		<a href="<?php echo base_url ?>admin/?page=reservation" class="main_menu" id="res-link" onclick="highlightLink('res-link')">Reservation List</a>
		<a href="<?php echo base_url ?>admin/?page=credit_assestment" class="main_menu" id="ca-link" onclick="highlightLink('ca-link')">Credit Assessment List</a>
		<a href="<?php echo base_url ?>admin/?page=final_approval" class="main_menu" id="fa-link" onclick="highlightLink('fa-link')">CFO Approval List</a>
		<a href="<?php echo base_url ?>admin/?page=clients/property_list" class="main_menu" id="pl-link" onclick="highlightLink('pl-link')">Property Accounts</a>
	</div>
</div>

<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h3 class="card-title">List of Pending RA</h3>
		<div class="card-tools">
			<a href="./?page=sales/create" class="btn btn-flat btn-default bg-maroon"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped">
				
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
												where c_revised = 0 and  x.c_csr_no = y.c_csr_no 
												and x.c_lot_lid = z.c_lid 
												and z.c_site = q.c_code 
											and y.c_buyer_count = 1 order by c_date_updated DESC");
						}else{

							$qry = $conn->query("select q.c_acronym, z.c_block, z.c_lot, y.last_name, y.first_name, y.middle_name, y.suffix_name , x.* from t_csr x , t_csr_buyers y ,
											t_lots z,  t_projects q
											where c_revised = 0 and  x.c_csr_no = y.c_csr_no 
											and x.c_lot_lid = z.c_lid 
											and z.c_site = q.c_code 
											and y.c_buyer_count = 1 and ".$where."  order by c_date_updated DESC");
						}
						while($row = $qry->fetch_assoc()):
							$timeStamp = date( "m/d/Y", strtotime($row['c_date_updated']));
					?>
						<tr>
								<td class="text-center"><?php echo $timeStamp; ?> </td>
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
                           
                            <?php }elseif($row['coo_approval'] == 1){ ?>
                                <td class="text-center"><span class="badge badge-success">Approved</span></td>
                            <?php }
                            elseif($row['coo_approval'] == 2){ ?> 
                                <td class="text-center"><span class="badge badge-danger">Expired</span></td>
                            <?php }
							 elseif($row['coo_approval'] == 3){ ?>
                                <td class="text-center"><span class="badge badge-danger">Cancelled</span></td>
							<?php } 
							elseif($row['coo_approval'] == 4){ ?> 
							 	<td class="text-center"><span class="badge badge-danger">Disapproved</span></td>
							<?php } ?>

							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="./?page=sales/view&id=<?php echo md5($row['c_csr_no']) ?>"><span class="fa fa-eye text-primary"></span> View</a>
				                    <?php if ($row['c_verify'] == 0): ?>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item edit_data" href="./?page=sales/create&id=<?php echo md5($row['c_csr_no']) ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
									<div class="dropdown-divider"></div>
				                    <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['c_csr_no'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
			_conf("Are you sure to delete this RA permanently?","delete_csr",[$(this).attr('data-id')])
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