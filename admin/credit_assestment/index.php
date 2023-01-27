<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h3 class="card-title">Credit Assestment List</h3>
		
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped">
	
				<thead>
					<tr>
                    <th>RA No.</th>
					<th>Ref. No.</th>
                    <th>Location </th>
                    <th>Buyer Name </th>
                    <th>CA Status</th>
                    <th>Actions</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * FROM t_approval_csr i inner join t_csr_view x on i.c_csr_no = x.c_csr_no where c_csr_status = 1 and c_reserve_status = 1 ORDER BY c_date_approved");
						while($row = $qry->fetch_assoc()):
							$i ++;
                            $ra_id = $row["ra_id"];
                            $status=$row["c_csr_status"];
                            $date_created=$row["c_date_created"];
                            $id=$row["c_csr_no"];
                            $lid = $row["c_lot_lid"];
					?>
						<tr>
                            <td class="text-center"><?php echo $row["ra_id"] ?></td>
                            <td class="text-center"><?php echo $row["ref_no"] ?></td>
                            <td class="text-center"><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></td>
                            <td class="text-center"><?php echo $row["last_name"]. ','  .$row["first_name"] .' ' .$row["middle_name"]?></td>

                            <?php if($row['c_ca_status'] == 1): ?>
                                <td><span class="badge badge-success">CA Approved</span></td>
                            <?php elseif ($row['c_ca_status'] == 0): ?>
                                <td><span class="badge badge-warning">Pending</span></td>
                            <?php elseif ($row['c_ca_status'] == 2): ?>
                                <td><span class="badge badge-danger">Disapproved</span></td>
                            <?php elseif ($row['c_ca_status'] == 3): ?>
                                <td><span class="badge badge-danger">For Revision</span></td>
                            <?php else: ?>
                                <td><span class="badge badge-danger"> --- </span></td>
                            <?php endif; ?>

							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="./?page=credit_assestment/ca-view&id=<?php echo md5($row['c_csr_no']) ?>"><span class="fa fa-eye text-primary"></span> View</a>
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
			_conf("Are you sure to delete this invoice permanently?","delete_csr",[$(this).attr('data-id')])
		})
		$('.table').dataTable();
		
	})
	
</script>