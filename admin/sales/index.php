<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
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
			<!-- 	<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="20%">
					<col width="30%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
				</colgroup> -->
				<thead>
					<tr>
					<th>No.</th>
					<th>Ref. No.</th>
					<th>Prepared by </th>	
					<th>Location </th>		
					<th>Buyers Name</th>
					<th>Net TCP</th>
					<th>Prepared Date</th>
					<th>SM Approval</th>
					<th>Coo Approval</th>
					<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("select q.c_acronym, z.c_block, z.c_lot, y.last_name, y.first_name, y.middle_name, y.suffix_name , x.* from t_csr x , t_csr_buyers y ,
											t_lots z,  t_projects q
											where c_revised = 0 and  x.c_csr_no = y.c_csr_no 
											and x.c_lot_lid = z.c_lid 
											and z.c_site = q.c_code 
											and y.c_buyer_count = 1");
						while($row = $qry->fetch_assoc()):
							$timeStamp = date( "m/d/Y", strtotime($row['c_date_updated']));
					?>
						<tr>
                                <td><?php echo $i++ ?></td>
                                <td><?php echo $row['ref_no'] ?></td>
                                <td class="text-center"><?php echo $row["c_created_by"] ?></td>
                                <td><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></td>
                                <td class="text-center"><?php echo $row["last_name"]. ' ' .$row["suffix_name"]. ','  .$row["first_name"] .' ' .$row["middle_name"]?></td>

                                <td class="text-right"><?php echo "P".number_format($row["c_net_tcp"], 2) ?></td>
                                <td class="text-center"><?php echo $timeStamp ?> </td>
                                
                        
                        
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
                                <td class="text-center"><span class="badge badge-danger">Disapproved</span></td>
                            
                            <?php }elseif($row['coo_approval'] == 1){ ?>
                                <td class="text-center"><span class="badge badge-success">Approved</span></td>
                            <?php }
                            elseif($row['coo_approval'] == 2){ ?> 
                                <td class="text-center"><span class="badge badge-default">Cancelled</span></td>
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
		$('.table').dataTable();
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