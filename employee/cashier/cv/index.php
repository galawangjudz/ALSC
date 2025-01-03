<u?php
function format_num($number){
	$decimals = 0;
	$num_ex = explode('.',$number);
	$decimals = isset($num_ex[1]) ? strlen($num_ex[1]) : 0 ;
	return number_format($number,$decimals);
}
?>
<style>
	#sup-div_wrapper .dataTables_filter,
	#sup-div_wrapper .dataTables_paginate {
		display: none;
	}

	#agent-div_wrapper .dataTables_filter,
	#agent-div_wrapper .dataTables_paginate {
		display: none;
	}

	#emp-div_wrapper .dataTables_filter,
	#emp-div_wrapper .dataTables_paginate {
		display: none;
	}

	#client-div_wrapper .dataTables_filter,
	#client-div_wrapper .dataTables_paginate {
		display: none;
	}

	#sup-div_wrapper .dataTables_length,
	#agent-div_wrapper .dataTables_length,
	#client-div_wrapper .dataTables_length,
	#emp-div_wrapper .dataTables_length {
		display: none;
	}
	#sup-div_wrapper .dataTables_info,
	#agent-div_wrapper .dataTables_info,
	#client-div_wrapper .dataTables_info,
	#emp-div_wrapper .dataTables_info {
		display: none;
	}

	#sup-div{
        display:none;
    }
    #agent-div{
        display:none;
    }
    #emp-div{
        display:none;
    }
	#client-div{
        display:none;
    }
	th.p-0, td.p-0{
		padding: 0 !important;
	}
    .rdo-btn {
        display: flex;
        width: 100%;
    }

    .rdo-btn label {
        flex: 1;
        text-align: center; 
        margin: 0; 
        padding: 10px; 
        box-sizing: border-box; 
    }

    .rdo-btn input[type="radio"] {
        margin: 0;
        vertical-align: middle; 
    }
	.preview-div{
        border:solid 1px gainsboro;
        padding:10px;
        border-radius:5px;
    }
	.nav-maincv{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-maincv:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
	body{
		font-size:14px;
	}
	.check_data:hover span.badge {
		background-color:#28a745!important;
        color: white!important;
		border-color:#28a745!important;
    }
	.print_data:hover span.badge {
		background-color:black!important;
        color: white!important;
		border-color:black!important;
    }
	.approved_data:hover span.badge {
		background-color:#007bff!important;
        color: white!important;
		border-color:#007bff!important;
    }
	.disapproved_data:hover span.badge {
		background-color:#dc3545!important;
        color: white!important;
		border-color:#dc3545!important;
    }
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
	<h3 class="card-title"><b><i>Check Voucher Setup Entries</b></i></h3>
		<br><br>
		<div class="preview-div">
			<div class="card-tools">
				<label class="control-label" style="font-style:italic;">Select View:</label>
				<!-- <a href="?page=cv/manage_check_voucher" class="btn btn-flat btn-primary" style="font-size:14px;float:right;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Create New Check Voucher</a> -->
			</div>
			<hr>
			<div class="rdo-btn">
				<label>
					<input type="radio" name="divChoice" value="emp-div" id="emp-radio"> Employees
				</label>
				<label>
					<input type="radio" name="divChoice" value="agent-div" id="agent-radio"> Agents
				</label>
				<label>
					<input type="radio" name="divChoice" value="sup-div" id="sup-radio"> Suppliers
				</label>
				<label>
					<input type="radio" name="divChoice" value="client-div" id="sup-radio"> Clients
				</label>
			</div>
			
		</div>
	</div>

	<div class="card-body">
        <div class="container-fluid">
		
			<table class="table table-hover table-striped table-bordered" id="sup-div">
				<colgroup>
					<col width="15%">
					<col width="15%">
					<!-- <col width="15%"> -->
					<col width="40%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead style="text-align:center;">
					<tr>
						<th>CV #</th>
						<th>CV Date</th>
                        <!-- <th>P.O. #</th> -->
						<th>Supplier Name</th>
                        <th>AS tatus</th>
						<th>CFO Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					
					// $users = $conn->query("SELECT user_code,username FROM `users` where user_code in (SELECT `user_id` FROM `vs_entries`)");
					// $user_arr = array_column($users->fetch_all(MYSQLI_ASSOC),'username','user_code');
					$journals = $conn->query("SELECT j.*, s.name as sname FROM `cv_entries` j inner join `supplier_list` s on j.supplier_id = s.id order by date_created desc");
					while($row = $journals->fetch_assoc()):
					?>
					<tr>
                        <td class=""><?= $row['c_num'] ?></td>
						<td class="text-center"><?= date("M d, Y", strtotime($row['cv_date'])) ?></td>
						<!-- <td class=""><?= $row['po_no'] ?></td> -->
						
                        <td class=""><?= $row['sname'] ?></td>
						<!-- <td class="text-center">
							<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
								<?php if ($row['c_status'] == 1): ?>
									<span class="fa fa-check text-primary"></span> Claimed
								<?php else: ?>
									<span class="fa fa-times text-secondary"></span> Unclaimed
								<?php endif; ?>
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu" role="menu">
								<a class="dropdown-item claim_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>" data-status="1">
									<span class="fa fa-check text-primary"></span> Claimed
								</a>
								<a class="dropdown-item unclaim_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>" data-status="0">
									<span class="fa fa-times text-secondary"></span> Unclaimed
								</a>
							</div>
						</td> -->
						<!-- <td><?= isset($user_arr[$row['user_id']]) ? $user_arr[$row['user_id']] : "N/A" ?></td> -->
						<td class="text-center">
						<?php 
							switch($row['c_status']){
								case 0:
									echo '<span class="badge badge-secondary px-3 rounded-pill">Pending</span>';
									break;
								case 1:
									echo '<span class="badge badge-primary px-3 rounded-pill">Approved</span>';
									break;
								default:
									echo '<span class="badge badge-danger px-3 rounded-pill">Disapproved</span>';
									break;
							}
						?>
						</td>
						<td class="text-center">
						<?php 
							switch($row['c_status2']){
								case 0:
									echo '<span class="badge badge-secondary px-3 rounded-pill">Pending</span>';
									break;
								case 1:
									echo '<span class="badge badge-primary px-3 rounded-pill">Approved</span>';
									break;
								default:
									echo '<span class="badge badge-danger px-3 rounded-pill">Disapproved</span>';
									break;
							}
						?>
						</td>
						<td class="text-center">
							<?php 
							$qry_get_pending = $conn->query("SELECT cv.c_status, cv.c_num, chk.check_num 
															FROM cv_entries cv 
															JOIN check_details chk ON cv.c_num = chk.c_num 
															WHERE cv.c_num = '" . $row['c_num'] . "' 
															AND cv.c_status = 0 
															AND chk.check_num IS NOT NULL");
							if ($_settings->userdata('user_code') == '10007' && $qry_get_pending->num_rows > 0): ?>
								<button type="button" style="border:none;background-color:transparent;margin:-5px;" class="btn btn-flat btn-default btn-sm approved_data custom-badge" data-id="<?php echo $row['c_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Approve">
									<span class="badge rounded-circle p-2" style="color:#007bff; background-color: white; border: 1px solid gainsboro; border-radius: 50%;" data-toggle="tooltip" data-placement="top" title="Approve">
										<i class="fa fa-thumbs-up fa-lg aria-hidden="true"></i>
									</span>
								</button>
								<button type="button" style="border:none;background-color:transparent;margin:-5px;" class="btn btn-flat btn-default btn-sm disapproved_data custom-badge" data-id="<?php echo $row['c_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Disapprove">
									<span class="badge rounded-circle p-2" style="color:#dc3545; background-color: white; border: 1px solid gainsboro; border-radius: 50%;" data-toggle="tooltip" data-placement="top" title="Disapprove">
										<i class="fa fa-thumbs-down fa-lg aria-hidden="true"></i>
									</span>
								</button>
							<?php endif; ?>


							<button type="button" style="border:none;background-color:transparent;margin:-5px;" class="check_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>">
								<span class="badge rounded-circle p-2" style="color:#28a745; background-color: white; border: 1px solid gainsboro; border-radius: 50%; margin-right:5px;"  data-toggle="tooltip" data-placement="top" title="Check Details">
									<i class="fa fa-money-check fa-lg" aria-hidden="true"></i>
								</span>
							</button>
							
							<?php 
							$qry_get_check = $conn->query("SELECT * FROM check_details
															WHERE c_num = '" . $row['c_num'] . "' 
															AND check_num IS NOT NULL");
							if ($qry_get_check->num_rows > 0): ?>
							<a class="print_data" href="<?php echo base_url ?>/report/print_check_voucher.php?id=<?php echo $row['c_num'] ?>" target="_blank" style="border:none;background-color:transparent;margin:-5px;">
								<span class="badge rounded-circle p-2" style="color:black; background-color: white; border: 1px solid gainsboro; border-radius: 50%;"  data-toggle="tooltip" data-placement="top" title="Print">
									<i class="fa fa-print fa-lg" aria-hidden="true"></i>
								</span>
							</a>     
							
							<?php endif; ?>

							<?php 
							$qry_edit = $conn->query("SELECT * FROM cv_entries
															WHERE c_num = '" . $row['c_num'] . "' 
															AND (c_status = 0)");
							if ($qry_edit->num_rows > 0): ?>
							<a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['c_num'] ?>">
								<!-- <span class="fa fa-edit text-primary"></span> Edit -->
							</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

			<table class="table table-hover table-striped table-bordered" id="agent-div">
				<colgroup>
					<col width="15%">
					<col width="15%">
					<!-- <col width="15%"> -->
					<col width="40%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead style="text-align:center;">
					<tr>
						<th>CV #</th>
						<th>Date</th>
                        <!-- <th>P.O. #</th> -->
						<th>Agent Name</th>
                        <th>AS tatus</th>
						<th>CFO Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					
					// $users = $conn->query("SELECT user_code,username FROM `users` where user_code in (SELECT `user_id` FROM `vs_entries`)");
					// $user_arr = array_column($users->fetch_all(MYSQLI_ASSOC),'username','user_code');
					$journals = $conn->query("SELECT j.c_status as stats,j.c_status2, j.c_num, j.cv_date, s.* FROM `cv_entries` j inner join `t_agents` s on j.supplier_id = s.c_code order by date(cv_date) desc");
					while($row = $journals->fetch_assoc()):
					?>
					<tr>
                        <td class=""><?= $row['c_num'] ?></td>
						<td class="text-center"><?= date("M d, Y", strtotime($row['cv_date'])) ?></td>
						<!-- <td class=""><?= $row['po_no'] ?></td> -->
						
                        <td class=""><?= $row['c_first_name'] ?> <?= $row['c_middle_initial'] ?> <?= $row['c_last_name'] ?></td>

						<!-- <td class="text-center">
							<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
								<?php if ($row['claimStats'] == 1): ?>
									<span class="fa fa-check text-primary"></span> Claimed
								<?php else: ?>
									<span class="fa fa-times text-secondary"></span> Unclaimed
								<?php endif; ?>
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu" role="menu">
								<a class="dropdown-item claim_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>" data-status="1">
									<span class="fa fa-check text-primary"></span> Claimed
								</a>
								<a class="dropdown-item unclaim_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>" data-status="0">
									<span class="fa fa-times text-secondary"></span> Unclaimed
								</a>
							</div>
						</td> -->

						<!-- <td><?= isset($user_arr[$row['user_id']]) ? $user_arr[$row['user_id']] : "N/A" ?></td> -->
						<td class="text-center">
						<?php 
							switch($row['stats']){
								case 0:
									echo '<span class="badge badge-secondary px-3 rounded-pill">Pending</span>';
									break;
								case 1:
									echo '<span class="badge badge-primary px-3 rounded-pill">Approved</span>';
									break;
								default:
									echo '<span class="badge badge-danger px-3 rounded-pill">Disapproved</span>';
									break;
							}
						?>
						</td>
						<td class="text-center">
						<?php 
							switch($row['c_status2']){
								case 0:
									echo '<span class="badge badge-secondary px-3 rounded-pill">Pending</span>';
									break;
								case 1:
									echo '<span class="badge badge-primary px-3 rounded-pill">Approved</span>';
									break;
								default:
									echo '<span class="badge badge-danger px-3 rounded-pill">Disapproved</span>';
									break;
							}
						?>
						</td>
						<td class="text-center">
							<?php 
							$qry_get_pending = $conn->query("SELECT cv.c_status, cv.c_num, chk.check_num 
															FROM cv_entries cv 
															JOIN check_details chk ON cv.c_num = chk.c_num 
															WHERE cv.c_num = '" . $row['c_num'] . "' 
															AND cv.c_status = 0 
															AND chk.check_num IS NOT NULL");
							if ($_settings->userdata('user_code') == '10007' && $qry_get_pending->num_rows > 0): ?>
								<button type="button" style="border:none;background-color:transparent;margin:-5px;" class="btn btn-flat btn-default btn-sm approved_data custom-badge" data-id="<?php echo $row['c_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Approve">
									<span class="badge rounded-circle p-2" style="color:#007bff; background-color: white; border: 1px solid gainsboro; border-radius: 50%;" data-toggle="tooltip" data-placement="top" title="Approve">
										<i class="fa fa-thumbs-up fa-lg aria-hidden="true"></i>
									</span>
								</button>
								<button type="button" style="border:none;background-color:transparent;margin:-5px;" class="btn btn-flat btn-default btn-sm disapproved_data custom-badge" data-id="<?php echo $row['c_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Disapprove">
									<span class="badge rounded-circle p-2" style="color:#dc3545; background-color: white; border: 1px solid gainsboro; border-radius: 50%;" data-toggle="tooltip" data-placement="top" title="Disapprove">
										<i class="fa fa-thumbs-down fa-lg aria-hidden="true"></i>
									</span>
								</button>
							<?php endif; ?>
								<button type="button" style="border:none;background-color:transparent;margin:-5px;" class="check_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>">
									<span class="badge rounded-circle p-2" style="color:#28a745; background-color: white; border: 1px solid gainsboro; border-radius: 50%; margin-right:5px;"  data-toggle="tooltip" data-placement="top" title="Check Details">
										<i class="fa fa-money-check fa-lg" aria-hidden="true"></i>
									</span>
								</button>
							
							<?php 
							$qry_get_check = $conn->query("SELECT * FROM check_details
															WHERE c_num = '" . $row['c_num'] . "' 
															AND check_num IS NOT NULL");
							if ($qry_get_check->num_rows > 0): ?>
							<a class="print_data" href="<?php echo base_url ?>/report/print_check_voucher.php?id=<?php echo $row['c_num'] ?>" target="_blank" style="border:none;background-color:transparent;margin:-5px;">
								<span class="badge rounded-circle p-2" style="color:black; background-color: white; border: 1px solid gainsboro; border-radius: 50%;"  data-toggle="tooltip" data-placement="top" title="Print">
									<i class="fa fa-print fa-lg" aria-hidden="true"></i>
								</span>
							</a>      
							<?php endif; ?>

							<?php 
							$qry_edit = $conn->query("SELECT * FROM cv_entries
															WHERE c_num = '" . $row['c_num'] . "' 
															AND (c_status = 0)");
							if ($qry_edit->num_rows > 0): ?>
							<a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['c_num'] ?>">
								<!-- <span class="fa fa-edit text-primary"></span> Edit -->
							</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

			<table class="table table-hover table-striped table-bordered" id="emp-div">
				<colgroup>
					<col width="15%">
					<col width="15%">
					<!-- <col width="15%"> -->
					<col width="40%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead style="text-align:center;">
					<tr>
						<th>CV #</th>
						<th>Date</th>
                        <!-- <th>P.O. #</th> -->
						<th>Employee Name</th>
                        <th>AS tatus</th>
						<th>CFO Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    
					<?php 
					
					//$users = $conn->query("SELECT user_code,username FROM `users` where user_code in (SELECT `user_id` FROM `vs_entries`)");
					//$user_arr = array_column($users->fetch_all(MYSQLI_ASSOC),'username','user_code');
					$journals = $conn->query("SELECT j.*, s.* FROM `cv_entries` j inner join `users` s on j.supplier_id = s.user_code order by date(cv_date) desc");
					while($row = $journals->fetch_assoc()):
					?>
					<tr>
                        <td class=""><?= $row['c_num'] ?></td>
						<td class="text-center"><?= date("M d, Y", strtotime($row['cv_date'])) ?></td>
						<!-- <td class=""><?= $row['po_no'] ?></td> -->
						
                        <td class=""><?= $row['firstname'] ?> <?= $row['lastname'] ?></td>

						<!-- <td class="text-center">
							<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
								<?php if ($row['c_status'] == 1): ?>
									<span class="fa fa-check text-primary"></span> Claimed
								<?php else: ?>
									<span class="fa fa-times text-secondary"></span> Unclaimed
								<?php endif; ?>
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu" role="menu">
								<a class="dropdown-item claim_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>" data-status="1">
									<span class="fa fa-check text-primary"></span> Claimed
								</a>
								<a class="dropdown-item unclaim_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>" data-status="0">
									<span class="fa fa-times text-secondary"></span> Unclaimed
								</a>
							</div>
						</td> -->

						<!-- <td><?= isset($user_arr[$row['user_id']]) ? $user_arr[$row['user_id']] : "N/A" ?></td> -->
						<td class="text-center">
						<?php 
							switch($row['c_status']){
								case 0:
									echo '<span class="badge badge-secondary px-3 rounded-pill">Pending</span>';
									break;
								case 1:
									echo '<span class="badge badge-primary px-3 rounded-pill">Approved</span>';
									break;
								default:
									echo '<span class="badge badge-danger px-3 rounded-pill">Disapproved</span>';
									break;
							}
						?>
						</td>
						<td class="text-center">
						<?php 
							switch($row['c_status2']){
								case 0:
									echo '<span class="badge badge-secondary px-3 rounded-pill">Pending</span>';
									break;
								case 1:
									echo '<span class="badge badge-primary px-3 rounded-pill">Approved</span>';
									break;
								default:
									echo '<span class="badge badge-danger px-3 rounded-pill">Disapproved</span>';
									break;
							}
						?>
						</td>
						<td class="text-center">
							<?php 
							$qry_get_pending = $conn->query("SELECT cv.c_status, cv.c_num, chk.check_num 
															FROM cv_entries cv 
															JOIN check_details chk ON cv.c_num = chk.c_num 
															WHERE cv.c_num = '" . $row['c_num'] . "' 
															AND cv.c_status = 0 
															AND chk.check_num IS NOT NULL");
							if ($_settings->userdata('user_code') == '10007' && $qry_get_pending->num_rows > 0): ?>
								<button type="button" style="border:none;background-color:transparent;margin:-5px;" class="btn btn-flat btn-default btn-sm approved_data custom-badge" data-id="<?php echo $row['c_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Approve">
									<span class="badge rounded-circle p-2" style="color:#007bff; background-color: white; border: 1px solid gainsboro; border-radius: 50%;" data-toggle="tooltip" data-placement="top" title="Approve">
										<i class="fa fa-thumbs-up fa-lg aria-hidden="true"></i>
									</span>
								</button>
								<button type="button" style="border:none;background-color:transparent;margin:-5px;" class="btn btn-flat btn-default btn-sm disapproved_data custom-badge" data-id="<?php echo $row['c_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Disapprove">
									<span class="badge rounded-circle p-2" style="color:#dc3545; background-color: white; border: 1px solid gainsboro; border-radius: 50%;" data-toggle="tooltip" data-placement="top" title="Disapprove">
										<i class="fa fa-thumbs-down fa-lg aria-hidden="true"></i>
									</span>
								</button>
							<?php endif; ?>
							
						
							<button type="button" style="border:none;background-color:transparent;margin:-5px;" class="check_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>">
									<span class="badge rounded-circle p-2" style="color:#28a745; background-color: white; border: 1px solid gainsboro; border-radius: 50%; margin-right:5px;"  data-toggle="tooltip" data-placement="top" title="Check Details">
										<i class="fa fa-money-check fa-lg" aria-hidden="true"></i>
									</span>
							</button>
						
							<?php 
							$qry_get_check = $conn->query("SELECT * FROM check_details
															WHERE c_num = '" . $row['c_num'] . "' 
															AND check_num IS NOT NULL");
							if ($qry_get_check->num_rows > 0): ?>
							<a class="print_data" href="<?php echo base_url ?>/report/print_check_voucher.php?id=<?php echo $row['c_num'] ?>" target="_blank" style="border:none;background-color:transparent;margin:-5px;">
								<span class="badge rounded-circle p-2" style="color:black; background-color: white; border: 1px solid gainsboro; border-radius: 50%;"  data-toggle="tooltip" data-placement="top" title="Print">
									<i class="fa fa-print fa-lg" aria-hidden="true"></i>
								</span>
							</a>       
							<?php endif; ?>

							<?php 
							$qry_edit = $conn->query("SELECT * FROM cv_entries
															WHERE c_num = '" . $row['c_num'] . "' 
															AND (c_status = 0)");
							if ($qry_edit->num_rows > 0): ?>
							<a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['c_num'] ?>">
								<!-- <span class="fa fa-edit text-primary"></span> Edit -->
							</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

			<table class="table table-hover table-striped table-bordered" id="client-div">
				<colgroup>
					<col width="15%">
					<col width="15%">
					<!-- <col width="15%"> -->
					<col width="40%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead style="text-align:center;">
					<tr>
						<th>CV #</th>
						<th>Date</th>
                        <!-- <th>P.O. #</th> -->
						<th>Client Name</th>
                        <th>AS tatus</th>
						<th>CFO Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    
					<?php 
					
					//$users = $conn->query("SELECT user_code,username FROM `users` where user_code in (SELECT `user_id` FROM `vs_entries`)");
					//$user_arr = array_column($users->fetch_all(MYSQLI_ASSOC),'username','user_code');
					$journals = $conn->query("SELECT j.*, s.* FROM `cv_entries` j inner join `property_clients` s on j.supplier_id = s.client_id order by date(cv_date) desc");
					while($row = $journals->fetch_assoc()):
					?>
					<tr>
                        <td class=""><?= $row['c_num'] ?></td>
						<td class="text-center"><?= date("M d, Y", strtotime($row['cv_date'])) ?></td>
						<!-- <td class=""><?= $row['po_no'] ?></td> -->
						
                        <td class=""><?= $row['first_name'] ?> <?= $row['last_name'] ?></td>

						
						<!-- <td class="text-center">
							<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
								<?php if ($row['c_status'] == 1): ?>
									<span class="fa fa-check text-primary"></span> Claimed
								<?php else: ?>
									<span class="fa fa-times text-secondary"></span> Unclaimed
								<?php endif; ?>
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu" role="menu">
								<a class="dropdown-item claim_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>" data-status="1">
									<span class="fa fa-check text-primary"></span> Claimed
								</a>
								<a class="dropdown-item unclaim_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>" data-status="0">
									<span class="fa fa-times text-secondary"></span> Unclaimed
								</a>
							</div>
						</td> -->

						<!-- <td><?= isset($user_arr[$row['user_id']]) ? $user_arr[$row['user_id']] : "N/A" ?></td> -->
						<td class="text-center">
						<?php 
							switch($row['c_status']){
								case 0:
									echo '<span class="badge badge-secondary px-3 rounded-pill">Pending</span>';
									break;
								case 1:
									echo '<span class="badge badge-primary px-3 rounded-pill">Approved</span>';
									break;
								default:
									echo '<span class="badge badge-danger px-3 rounded-pill">Disapproved</span>';
									break;
							}
						?>
						</td>
						<td class="text-center">
						<?php 
							switch($row['c_status2']){
								case 0:
									echo '<span class="badge badge-secondary px-3 rounded-pill">Pending</span>';
									break;
								case 1:
									echo '<span class="badge badge-primary px-3 rounded-pill">Approved</span>';
									break;
								default:
									echo '<span class="badge badge-danger px-3 rounded-pill">Disapproved</span>';
									break;
							}
						?>
						</td>
						<td class="text-center">
							<?php 
							$qry_get_pending = $conn->query("SELECT cv.c_status, cv.c_num, chk.check_num 
															FROM cv_entries cv 
															JOIN check_details chk ON cv.c_num = chk.c_num 
															WHERE cv.c_num = '" . $row['c_num'] . "' 
															AND cv.c_status = 0 
															AND chk.check_num IS NOT NULL");
							if ($_settings->userdata('user_code') == '10007' && $qry_get_pending->num_rows > 0): ?>
								<button type="button" style="border:none;background-color:transparent;margin:-5px;" class="btn btn-flat btn-default btn-sm approved_data custom-badge" data-id="<?php echo $row['c_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Approve">
									<span class="badge rounded-circle p-2" style="color:#007bff; background-color: white; border: 1px solid gainsboro; border-radius: 50%;" data-toggle="tooltip" data-placement="top" title="Approve">
										<i class="fa fa-thumbs-up fa-lg aria-hidden="true"></i>
									</span>
								</button>
								<button type="button" style="border:none;background-color:transparent;margin:-5px;" class="btn btn-flat btn-default btn-sm disapproved_data custom-badge" data-id="<?php echo $row['c_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Disapprove">
									<span class="badge rounded-circle p-2" style="color:#dc3545; background-color: white; border: 1px solid gainsboro; border-radius: 50%;" data-toggle="tooltip" data-placement="top" title="Disapprove">
										<i class="fa fa-thumbs-down fa-lg aria-hidden="true"></i>
									</span>
								</button>
							<?php endif; ?>
							
						
							<button type="button" style="border:none;background-color:transparent;margin:-5px;" class="check_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>">
									<span class="badge rounded-circle p-2" style="color:#28a745; background-color: white; border: 1px solid gainsboro; border-radius: 50%; margin-right:5px;"  data-toggle="tooltip" data-placement="top" title="Check Details">
										<i class="fa fa-money-check fa-lg" aria-hidden="true"></i>
									</span>
							</button>
						
							<?php 
							$qry_get_check = $conn->query("SELECT * FROM check_details
															WHERE c_num = '" . $row['c_num'] . "' 
															AND check_num IS NOT NULL");
							if ($qry_get_check->num_rows > 0): ?>
							<a class="print_data" href="<?php echo base_url ?>/report/print_check_voucher.php?id=<?php echo $row['c_num'] ?>" target="_blank" style="border:none;background-color:transparent;margin:-5px;">
								<span class="badge rounded-circle p-2" style="color:black; background-color: white; border: 1px solid gainsboro; border-radius: 50%;"  data-toggle="tooltip" data-placement="top" title="Print">
									<i class="fa fa-print fa-lg" aria-hidden="true"></i>
								</span>
							</a>     
							<?php endif; ?>

							<?php 
							$qry_edit = $conn->query("SELECT * FROM cv_entries
															WHERE c_num = '" . $row['c_num'] . "' 
															AND (c_status = 0)");
							if ($qry_edit->num_rows > 0): ?>
							<a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['c_num'] ?>">
								<!-- <span class="fa fa-edit text-primary"></span> Edit -->
							</a>
							<?php endif; ?>
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
    $('[data-toggle="tooltip"]').tooltip();
		});
	$('.approved_data').click(function(){
		_conf("Are you sure you want to approve this voucher setup?","approved_cv",[$(this).attr('data-id')])
	})
	$('.disapproved_data').click(function(){
		_conf("Are you sure you want to disapprove this voucher setup?","disapproved_cv",[$(this).attr('data-id')])
	})
$(document).ready(function() {
    $("input[type=radio][name=divChoice]").change(function() {
        var selectedValue = $(this).val();

        $("#emp-div, #agent-div, #sup-div,#client-div").hide();
        $(".dataTables_length, .dataTables_info, .dataTables_paginate, .dataTables_filter").hide();


        $("#" + selectedValue).show();
        $("#" + selectedValue + "_wrapper .dataTables_length, " +
            "#" + selectedValue + "_wrapper .dataTables_info, " +
            "#" + selectedValue + "_wrapper .dataTables_paginate, " +
            "#" + selectedValue + "_wrapper .dataTables_filter").show();
    });
});

	$(document).ready(function(){
		// $('#create_new').click(function(){
		// 	uni_modal("Voucher Setup Entry","journals/manage_journal.php",'mid-large')
		// })
		// $('.edit_data').click(function(){
		// 	uni_modal("Edit Voucher Setup Entry","journals/manage_journal.php?id="+$(this).attr('data-id'),"mid-large")
		// })
		$('.claim_data').click(function(){
			_conf("Are you sure you want to update this check voucher details?","claim_cv",[$(this).attr('data-id')])
		})
		$('.unclaim_data').click(function(){
			_conf("Are you sure you want to update this check voucher details?","unclaimed_cv",[$(this).attr('data-id')])
		})
		$('.edit_data').click(function() {
			var dataId = $(this).attr('data-id');
			var redirectUrl = '?page=cv/manage_check_voucher&id=' + dataId;
			window.location.href = redirectUrl;
		})
		$('.check_data').click(function () {
			var dataId = $(this).attr('data-id');
			var modalTitle = "<i class='fa fa-edit'></i> Check Details";

			var closeButton = '<button type="button" class="close" data-dismiss="modal" aria-label="Close">';
			closeButton += '<span aria-hidden="true">&times;</span></button>';

			var modalContent = '<div class="modal-header">' + modalTitle + closeButton + '</div>';
			var url = "check/manage_check.php?id=" + dataId;
			uni_modal(modalContent, url);
		});

        $('.modal-title').css('font-size', '18px');
		$('.delete_data').click(function(){
			_conf("Are you sure you want to delete this voucher setup entry permanently?","delete_vs",[$(this).attr('data-id')])
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: [2,4] }
            ],
        });
	})
	
	function delete_vs($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_vs",
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
	function claim_cv($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=claim_cv",
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
	function unclaimed_cv($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=unclaimed_cv",
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

	function approved_cv($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=approved_cv",
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
	function disapproved_cv($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=disapproved_cv",
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
<script>
function redirectSoa() {
    // window.location.href = "<?php echo base_url ?>/report/print_soa.php?id=<?php echo md5($prop_id); ?>";
    window.open("<?php echo base_url ?>/report/print_soa.php?id=<?php echo md5($prop_id); ?>", "_blank");
}
$(document).ready(function(){
$('.print_data').submit(function(e){
    e.preventDefault();
    var _this = $(this)
    $('.err-msg').remove();
    start_loader();
    $.ajax({
        url:_base_url_+"classes/Master.php?f=print_payment_func",
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        dataType: 'json',
        error:err=>{
            console.log(err)
            alert_toast("An error occured",'error');
            end_loader();
        },
        success:function(resp){
            if(typeof resp =='object' && resp.status == 'success'){
                var nw = window.open("/journals/print_voucher.php?id="+resp.id,"_blank","width=700,height=500")
                    setTimeout(()=>{
                        nw.print()
                        setTimeout(()=>{
                            nw.close()
                            end_loader();
                            location.replace('./?page=print_payment/print-payment-view&id='+resp.id_encrypt)
                        },500)
                    },500)
            }else if(resp.status == 'failed' && !!resp.msg){
                var el = $('<div>')
                    el.addClass("alert alert-danger err-msg").text(resp.msg)
                    _this.prepend(el)
                    el.show('slow')
                    end_loader()
            }else{
                alert_toast("An error occured",'error');
                end_loader();
                console.log(resp)
            }
        }
    })
})
});
</script>
