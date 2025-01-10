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
		border-right:solid 3px white;
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
	#fa-link{
		border-bottom: solid 2px blue;
		background-color:#E8E8E8;
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
	#res-link1{
		color: currentColor;
		cursor: not-allowed;
		opacity: 0.5;
		text-decoration: none;
		pointer-events: none;
	}
	.dataTables_wrapper .dataTables_length,
	.dataTables_wrapper .dataTables_info {
		text-align: left !important;
	}

</style>

<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h3 class="card-title"><b><i>CFO Approval List</b></i></h3>
	</div>
	<div class="card-body">
		<div class="table-container">
			<table class="table table-bordered table-striped" id="data-table">
				<thead>
					<tr>
                    <th>RA No.</th>
					<th>Ref. No.</th>
                    <th>Location </th>
                    <th>Buyer Name </th>
                    <th>CFO Status</th>
					
                    <th>Actions</th>
					
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * FROM t_approval_csr i inner join t_csr_view x on i.c_csr_no = x.c_csr_no where cfo_status = 1 ORDER BY c_date_approved DESC");
						while($row = $qry->fetch_assoc()):
							$i ++;
                            $ra_id = $row["ra_id"];
                            $status=$row["c_csr_status"];
                            $date_created=$row["c_date_created"];
                            $id=$row["c_csr_no"];
                            $lid = $row["c_lot_lid"];
							$csr_no = $row['c_csr_no'];

						
					?>
						<tr>
                            <td class="text-center"><?php echo $row["ra_id"] ?></td>
                            <td class="text-center"><?php echo $row["ref_no"] ?></td>
                            <td class="text-center"><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></td>
                            <td class="text-center"><?php echo $row["last_name"]. ','  .$row["first_name"] .' ' .$row["middle_name"]?></td>


							<?php if ($row['cfo_status'] == 0): ?>
                                <td><span class="badge badge-warning">Pending</span>
                            <?php elseif($row['cfo_status'] == 1): ?>
                                <td><span class="badge badge-success">Booked</span></td>
                            <?php endif; ?>
						
							
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
								  <a class="dropdown-item view_data" href="./?page=cfo_ra/ra-view&id=<?php echo md5($row['c_csr_no']) ?>"><span class="fa fa-eye text-primary"></span> View</a>
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


	/* $(document).ready(function(){
		
		$('.table').dataTable(
			{"ordering":false}
		);
		
	}) */

		$(document).ready(function(){
			$('.booked_data').click(function(){
				uni_modal_right("<i class='fa fa-check'></i> Final Approval",'fa-view.php?id='+$(this).attr('csr_no')+"&csr="+$(this).attr('ra_id')+"&lid="+$(this).attr('data-lot-id'),"mid-large")
				//uni_modal("<i class='fa fa-paint-brush'></i> Edit Lot",'inventory/manage_lot.php?id='+$(this).attr('data-lot-id'),"mid-large")
			})
		})
	// function cfo_approval($ra_id,$csr_no,$lid){
	// 	start_loader();
	// 	$.ajax({
	// 		url:_base_url_+"classes/Master.php?f=cfo_booked",
	// 		method:"POST",
	// 		data:{ra_id:$ra_id,csr_no:$csr_no,lid:$lid},
	// 		dataType:"json",
	// 		error:err=>{
	// 			console.log(err)
	// 			alert_toast("An error occured.",'error');
	// 			end_loader();
	// 		},
	// 		success:function(resp){
	// 			if(typeof resp== 'object' && resp.status == 'success'){
	// 				location.reload();
	// 			}else{
	// 				alert_toast("An error occured.",'error');
	// 				end_loader();
	// 			}
	// 		}
	// 	})
	// }
</script>