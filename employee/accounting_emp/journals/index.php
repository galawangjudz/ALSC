<?php
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

	#all-div_wrapper .dataTables_filter,
	#all-div_wrapper .dataTables_paginate {
		display: none;
	}

	#sup-div_wrapper .dataTables_length,
	#agent-div_wrapper .dataTables_length,
	#client-div_wrapper .dataTables_length,
	#all-div_wrapper .dataTables_length,
	#emp-div_wrapper .dataTables_length {
		display: none;
	}
	#sup-div_wrapper .dataTables_info,
	#agent-div_wrapper .dataTables_info,
	#client-div_wrapper .dataTables_info,
	#all-div_wrapper .dataTables_info,
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
	#all-div{
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
	.nav-journal{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-journal:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
	.custom-badge {
        border-radius: 50% !important;
        overflow: hidden!important;
		background-color:white!important;
    }
	table{
		font-size:14px;
	}
	.edit_data_supplier:hover .custom-badge {
        background-color: #007bff!important; 
        color: white!important;
    }
    .delete_data:hover .custom-badge {
        background-color: #dc3545!important;
        color: white!important;
    }

    .print_data:hover .custom-badge {
        background-color: #28a745!important;
        color: white!important;
    }
	/* .transferred-row {
		background-color: lightblue !important;
	}

	.red-row {
		background-color: #ffcccc; 
	} */

</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><b><i>Voucher Setup Entries</b></i></h3>
		<div class="card-tools">
			<!-- <button class="btn btn-primary btn-flat" id="create_new" type="button" style="font-size:14px;"><i class="fa fa-pen-square"></i>&nbsp;&nbsp;Add New Voucher Setup</button> -->
			<!-- <a href="<?php echo base_url ?>employee/accounting/?page=journals/manage_journal" class="btn btn-primary btn-flat" style="font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Add New Voucher Setup</a> -->
		</div>
		<br><br>
		<div class="preview-div">
			<label class="control-label" style="font-style:italic;">Select View:</label>
			<hr>
			<div class="rdo-btn">
				<label>
					<input type="radio" name="divChoice" value="emp-div" id="emp-radio"> Employees
				</label>
				<!-- <label>
					<input type="radio" name="divChoice" value="agent-div" id="agent-radio"> Agents
				</label> -->
				<label>
					<input type="radio" name="divChoice" value="sup-div" id="sup-radio"> Suppliers
				</label>
				<label>
					<input type="radio" name="divChoice" value="client-div" id="sup-radio"> Clients
				</label>
				<label>
					<input type="radio" name="divChoice" value="all-div" id="all-radio"> All
				</label>
			</div>
		</div>
	</div>

	<div class="card-body">
        <div class="container-fluid">
			<div class="form-group">
				<label for="start_date">Start Date:</label>
				<input type="date" class="form-control" id="start_date">
			</div>
			<div class="form-group">
				<label for="end_date">End Date:</label>
				<input type="date" class="form-control" id="end_date">
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-primary" id="filter_button">Filter</button>
				<!-- <button id="updateStatusButton" class="btn btn-primary">Move to Check Voucher List</button> -->
			</div>

			<table class="table table-hover table-bordered" id="sup-div">
				<thead>
					<tr style="text-align:center;">
						<th>Voucher #</th>
						<th>Date Created</th>
						<th>Due Date</th>
						<th>Supplier Name</th>
                        <th>PO Type</th>
						<th>Status</th>
						<th style="text-align:center;">Action</th>
						<!-- <th style="text-align:center;">Select</th> -->
					</tr>
				</thead>
				<tbody>
				
					<?php 
					$journals = $conn->query("SELECT j.po_no as poNo, j.m_status AS stats1,s.name as sname, j.c_status as stats, j.journal_date,j.due_date, j.v_num, s.* FROM `vs_entries` j inner join `supplier_list` s on j.supplier_id = s.id order by j.date_updated desc");
					while($row = $journals->fetch_assoc()):
						// $rowClass = '';
						// if ($row['stats'] == 1 && $row['stats1'] == 1) {
						// 	$rowClass = 'transferred-row';
						// }
					?>
					<!-- <tr class="<?= $rowClass ?>"> -->
					<tr>
                        <td class=""><?= $row['v_num'] ?></td>
						<td class="text-center"><?= date("Y-m-d", strtotime($row['journal_date'])) ?></td>
						<td class="text-center"><?= date("Y-m-d", strtotime($row['due_date'])) ?></td>
						<!-- <td class=""><?= $row['po_no'] ?></td> -->
						
                        <td class=""><?= $row['sname'] ?></td>
						<td class="">
							<input type="text" value="<?php echo !empty($row['poNo']) ? 'PO' : 'non-PO'; ?>" id="po_no" style="border:none;cursor:default;background:transparent;" readonly>
						</td>
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
							<?php $qry_get_pending = $conn->query("SELECT c_status,v_num FROM vs_entries WHERE v_num = '" . $row['v_num'] . "' and c_status = 0"); ?>
								<?php if ($qry_get_pending->num_rows > 0): ?>
								<button type="button" class="btn btn-flat btn-default btn-sm edit_data_supplier custom-badge" data-id="<?php echo $row['v_num'] ?>"
									data-toggle="tooltip" data-placement="top" title="Edit">
									<span class="fa fa-edit text-primary"></span>
								</button>
								<?php endif; ?>
								<!-- <button type="button" class="btn btn-flat btn-default btn-sm delete_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Delete">
									<span class="fa fa-trash text-danger"></span>
								</button> -->
								<button type="button" class="btn btn-flat btn-default btn-sm print_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
										onclick="window.open('<?php echo base_url ?>/report/voucher_report/print_voucher.php?id=<?php echo $row['v_num'] ?>', '_blank')"
										data-toggle="tooltip" data-placement="top" title="Print">
									<span class="fas fa-print"></span>
								</button>
							</div>
						</td>
						<!-- <td class="text-center">
							<?php 
								if ($row['stats'] == 1 && $row['stats1'] == 1) {
									echo '<span class="badge badge-primary px-3 rounded-pill">already transferred</span>';
								} elseif ($row['stats'] == 1) {
									echo '<input type="checkbox" name="select_voucher" value="' . $row['v_num'] . '">';
								} else {
									echo '-';
								}
							?>
						</td> -->
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

			<table class="table table-hover table-bordered" id="agent-div">
				<thead>
					<tr style="text-align:center;">
						<th>Voucher #</th>
						<th>Date Created</th>
						<th>Due Date</th>
						<th>Agent Name</th>
						<th>Status</th>
						<th style="text-align:center;">Action</th>
						<!-- <th style="text-align:center;">Select</th> -->
					</tr>
				</thead>
				<tbody>
					<?php 
					$journals = $conn->query("SELECT j.c_status as stats, j.m_status AS stats1,j.journal_date, j.due_date,j.v_num, s.* FROM `vs_entries` j inner join `t_agents` s on j.supplier_id = s.c_code order by j.date_updated desc");
					while($row = $journals->fetch_assoc()):
						// $rowClass = '';
						// if ($row['stats'] == 1 && $row['stats1'] == 1) {
						// 	$rowClass = 'transferred-row';
						// }
					?>
					<!-- <tr class="<?= $rowClass ?>"> -->
					<tr>
                        <td class=""><?= $row['v_num'] ?></td>
						<td class="text-center"><?= date("Y-m-d", strtotime($row['journal_date'])) ?></td>
						<td class="text-center"><?= date("Y-m-d", strtotime($row['due_date'])) ?></td>
                        <td class=""><?= $row['c_first_name'] ?> <?= $row['c_middle_initial'] ?> <?= $row['c_last_name'] ?></td>
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
							<?php $qry_get_pending = $conn->query("SELECT c_status,v_num FROM vs_entries WHERE v_num = '" . $row['v_num'] . "' and c_status = 0"); ?>
								<?php if ($qry_get_pending->num_rows > 0): ?>
							<button type="button" class="btn btn-flat btn-default btn-sm edit_data_agent custom-badge " data-id="<?php echo $row['v_num'] ?>"
									data-toggle="tooltip" data-placement="top" title="Edit">
								<span class="fa fa-edit text-primary fa-small"></span>
							</button>
							<?php endif; ?>
							<!-- <button type="button" class="btn btn-flat btn-default btn-sm delete_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
									data-toggle="tooltip" data-placement="top" title="Delete">
								<span class="fa fa-trash text-danger fa-small"></span>
							</button> -->
							<button type="button" class="btn btn-flat btn-default btn-sm print_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
									onclick="window.open('<?php echo base_url ?>/report/voucher_report/print_voucher_agent.php?id=<?php echo $row['v_num'] ?>', '_blank')"
									data-toggle="tooltip" data-placement="top" title="Print">
								<span class="fas fa-print fa-small"></span>
							</button>
						</td>
						<!-- <td class="text-center">
							<?php 
								if ($row['stats'] == 1 && $row['stats1'] == 1) {
									echo '<span class="badge badge-primary px-3 rounded-pill">already transferred</span>';
								} elseif ($row['stats'] == 1) {
									echo '<input type="checkbox" name="select_voucher" value="' . $row['v_num'] . '">';
								} else {
									echo '-';
								}
							?>
						</td> -->
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

			<table class="table table-hover table-bordered" id="emp-div">
				<thead>
					<tr style="text-align:center;">
						<th>Voucher #</th>
						<th>Date Created</th>
						<th>Due Date</th>
						<th>Employee Name</th>
						<th>Status</th>
						<th style="text-align:center;">Action</th>
						<!-- <th style="text-align:center;">Select</th> -->
					</tr>
				</thead>
				<tbody>
					<?php 
					$journals = $conn->query("SELECT j.c_status as stats, j.m_status AS stats1,j.journal_date, j.due_date,j.v_num, s.* FROM `vs_entries` j inner join `users` s on j.supplier_id = s.user_code order by j.date_updated desc");
					while($row = $journals->fetch_assoc()):
						// $rowClass = '';
						// if ($row['stats'] == 1 && $row['stats1'] == 1) {
						// 	$rowClass = 'transferred-row';
						// }
					?>
					<!-- <tr class="<?= $rowClass ?>"> -->
					<tr>
                        <td class=""><?= $row['v_num'] ?></td>
						<td class="text-center"><?= date("Y-m-d", strtotime($row['journal_date'])) ?></td>
						<td class="text-center"><?= date("Y-m-d", strtotime($row['due_date'])) ?></td>
                        <td class=""><?= $row['firstname'] ?> <?= $row['lastname'] ?></td>
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
							<?php $qry_get_pending = $conn->query("SELECT c_status,v_num FROM vs_entries WHERE v_num = '" . $row['v_num'] . "' and c_status = 0"); ?>
								<?php if ($qry_get_pending->num_rows > 0): ?>
							<button type="button" class="btn btn-flat btn-default btn-sm edit_data_employee custom-badge" data-id="<?php echo $row['v_num'] ?>"
									data-toggle="tooltip" data-placement="top" title="Edit">
								<span class="fa fa-edit text-primary"></span>
							</button>
							<?php endif; ?>
							<!-- <button type="button" class="btn btn-flat btn-default btn-sm delete_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
									data-toggle="tooltip" data-placement="top" title="Delete">
								<span class="fa fa-trash text-danger"></span>
							</button> -->
							<button type="button" class="btn btn-flat btn-default btn-sm print_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
									onclick="window.open('<?php echo base_url ?>/report/voucher_report/print_voucher_emp.php?id=<?php echo $row['v_num'] ?>', '_blank')"
									data-toggle="tooltip" data-placement="top" title="Print">
								<span class="fas fa-print"></span>
							</button>
						</td>
						<!-- <td class="text-center">
							<?php 
								if ($row['stats'] == 1 && $row['stats1'] == 1) {
									echo '<span class="badge badge-primary px-3 rounded-pill">already transferred</span>';
								} elseif ($row['stats'] == 1) {
									echo '<input type="checkbox" name="select_voucher" value="' . $row['v_num'] . '">';
								} else {
									echo '-';
								}
							?>
						</td> -->
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
			<table class="table table-hover table-bordered" id="client-div">
			
				<thead>
					<tr style="text-align:center;">
						<th>Voucher #</th>
						<th>Date Created</th>
						<th>Due Date</th>
                        <!-- <th>P.O. #</th> -->
						<th>Client Name</th>
                        <th>Status</th>
						<th style="text-align:center;">Action</th>
						<!-- <th style="text-align:center;">Select</th> -->
					</tr>
				</thead>
				<tbody>
                    
					<?php 
					
					//$users = $conn->query("SELECT user_code,username FROM `users` where user_code in (SELECT `user_id` FROM `vs_entries`)");
					//$user_arr = array_column($users->fetch_all(MYSQLI_ASSOC),'username','user_code');
					$journals = $conn->query("SELECT j.c_status as stats, j.m_status AS stats1, j.journal_date, j.due_date,j.v_num, s.* FROM `vs_entries` j inner join `property_clients` s on j.supplier_id = s.client_id order by j.date_updated desc");
					while($row = $journals->fetch_assoc()):
						// $rowClass = '';
						// if ($row['stats'] == 1 && $row['stats1'] == 1) {
						// 	$rowClass = 'transferred-row';
						// }
					?>
					<!-- <tr class="<?= $rowClass ?>"> -->
					<tr>
                        <td class=""><?= $row['v_num'] ?></td>
						<td class="text-center"><?= date("Y-m-d", strtotime($row['journal_date'])) ?></td>
						<td class="text-center"><?= date("Y-m-d", strtotime($row['due_date'])) ?></td>
						<!-- <td class=""><?= $row['po_no'] ?></td> -->
						
                        <td class=""><?= $row['first_name'] ?> <?= $row['last_name'] ?></td>

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
						<!-- <td><?= isset($user_arr[$row['user_id']]) ? $user_arr[$row['user_id']] : "N/A" ?></td> -->
						<td class="text-center">
							<!-- <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu" role="menu"> -->
								<!-- <a class="dropdown-item export_data" href="javascript:void(0)" data-id ="<?php echo $row['v_num'] ?>"><span class="fa fa-file-export text-secondary"></span> Export</a>
								<div class="dropdown-divider"></div> -->
								<!-- <a href="<?php echo base_url ?>/report/voucher_report/print_voucher_client.php?id=<?php echo $row['v_num'] ?>", target="_blank" class="dropdown-item"><span class="fas fa-print"></span>&nbsp;&nbsp;Print</a>         
								<div class="dropdown-divider"></div>
								<a class="dropdown-item edit_data_client" href="javascript:void(0)" data-id ="<?php echo $row['v_num'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['v_num'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
							</div> -->
							<?php $qry_get_pending = $conn->query("SELECT c_status,v_num FROM vs_entries WHERE v_num = '" . $row['v_num'] . "' and c_status = 0"); ?>
								<?php if ($qry_get_pending->num_rows > 0): ?>
							<button type="button" class="btn btn-flat btn-default btn-sm edit_data_client custom-badge " data-id="<?php echo $row['v_num'] ?>"
									data-toggle="tooltip" data-placement="top" title="Edit">
								<span class="fa fa-edit text-primary fa-small"></span>
							</button>
							<?php endif; ?>
							<!-- <button type="button" class="btn btn-flat btn-default btn-sm delete_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
									data-toggle="tooltip" data-placement="top" title="Delete">
								<span class="fa fa-trash text-danger fa-small"></span>
							</button> -->
							<button type="button" class="btn btn-flat btn-default btn-sm print_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
									onclick="window.open('<?php echo base_url ?>/report/voucher_report/print_voucher_client.php?id=<?php echo $row['v_num'] ?>', '_blank')"
									data-toggle="tooltip" data-placement="top" title="Print">
								<span class="fas fa-print fa-small"></span>
							</button>
						</td>
						<!-- <td class="text-center">
							<?php 
								if ($row['stats'] == 1 && $row['stats1'] == 1) {
									echo '<span class="badge badge-primary px-3 rounded-pill">already transferred</span>';
								} elseif ($row['stats'] == 1) {
									echo '<input type="checkbox" name="select_voucher" value="' . $row['v_num'] . '">';
								} else {
									echo '-';
								}
							?>
						</td> -->
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
			<table class="table table-hover table-bordered" id="all-div">
				<thead>
					<tr style="text-align:center;">
						<th>Voucher #</th>
						<th>Date Created</th>
						<th>Due Date</th>
						<th>Name</th>
						<th>Supplier Type</th>
						<th>Type</th>
						<th>Status</th>
						<th style="text-align:center;">Action</th>
						<!-- <th style="text-align:center;">Select</th> -->
					</tr>
				</thead>
				<tbody>
					<?php 
					$journals = $conn->query("SELECT 
						j.c_status AS stats, j.m_status AS stats1,
						j.journal_date, j.due_date,
						j.v_num, 
						j.po_no AS poNo,
						COALESCE(sl.name, CONCAT(pc.first_name, ' ', pc.last_name), CONCAT(ta.c_first_name, ' ', ta.c_last_name), CONCAT(u.firstname, ' ', u.lastname)) AS supplier_name,
						CASE
							WHEN sl.name IS NOT NULL THEN 'Supplier'
							WHEN pc.client_id IS NOT NULL THEN 'Client'
							WHEN ta.c_code IS NOT NULL THEN 'Agent'
							WHEN u.user_code IS NOT NULL THEN 'User'
							ELSE 'Unknown'
						END AS supplier_type,
						u.*, 
						sl.*, 
						ta.*, 
						pc.*
					FROM 
						vs_entries j
					LEFT JOIN 
						property_clients pc ON j.supplier_id = pc.client_id
					LEFT JOIN 
						supplier_list sl ON j.supplier_id = sl.id
					LEFT JOIN 
						t_agents ta ON j.supplier_id = ta.c_code
					LEFT JOIN 
						users u ON j.supplier_id = u.user_code
					ORDER BY 
						j.date_updated DESC;
					");
					while($row = $journals->fetch_assoc()):
						// $rowClass = '';
						// if ($row['stats'] == 1 && $row['stats1'] == 1) {
						// 	$rowClass = 'transferred-row';
						// }
					?>
					<!-- <tr class="<?= $rowClass ?>"> -->
					<tr>
						<td class=""><?= $row['v_num'] ?></td>
						<td class="text-center"><?= date("Y-m-d", strtotime($row['journal_date'])) ?></td>
						<td class="text-center"><?= date("Y-m-d", strtotime($row['due_date'])) ?></td>
						<td class=""><?= $row['supplier_name'] ?></td>
						<td class="">
							<?php if ($row['supplier_type'] == 'Supplier'): ?>
								<input type="text" value="<?= !empty($row['poNo']) ? 'PO' : 'non-PO'; ?>" id="po_no" style="border:none;cursor:default;background:transparent;" readonly>
							<?php else: ?>
								-
							<?php endif; ?>
						</td>
						<td><?= $row['supplier_type'] ?></td>
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
							<?php $qry_get_pending = $conn->query("SELECT c_status, v_num FROM vs_entries WHERE v_num = '" . $row['v_num'] . "' AND c_status = 0"); ?>
							<?php if ($qry_get_pending->num_rows > 0): ?>
							<?php 
								$edit_class = '';
								switch($row['supplier_type']) {
									case 'Agent':
										$edit_class = 'edit_data_agent';
										break;
									case 'Client':
										$edit_class = 'edit_data_client';
										break;
									case 'Supplier':
										$edit_class = 'edit_data_supplier';
										break;
									case 'User':
										$edit_class = 'edit_data_employee';
										break;
								}
							?>
							<button type="button" class="btn btn-flat btn-default btn-sm <?= $edit_class ?> custom-badge" data-id="<?= $row['v_num'] ?>"
									data-toggle="tooltip" data-placement="top" title="Edit">
								<span class="fa fa-edit text-primary"></span>
							</button>
							<?php endif; ?>
							<button type="button" class="btn btn-flat btn-default btn-sm print_data custom-badge" data-id="<?= $row['v_num'] ?>"
									onclick="window.open('<?php echo base_url ?>/report/voucher_report/print_voucher_emp.php?id=<?= $row['v_num'] ?>', '_blank')"
									data-toggle="tooltip" data-placement="top" title="Print">
								<span class="fas fa-print"></span>
							</button>
						</td>
						<!-- <td class="text-center">
							<?php 
								if ($row['stats'] == 1 && $row['stats1'] == 1) {
									echo '<span class="badge badge-primary px-3 rounded-pill">already transferred</span>';
								} elseif ($row['stats'] == 1) {
									echo '<input type="checkbox" name="select_voucher" value="' . $row['v_num'] . '">';
								} else {
									echo '-';
								}
							?>
						</td> -->
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

		</div>
	</div>
</div>

<script>
	$(document).ready(function() {
		colorRows();

		function colorRows() {
			var currentDate = new Date();
			$('tbody tr').each(function() {
				if ($(this).find('td:eq(5) span').hasClass('badge-primary')) {
					return true; 
				}
				var rowDate = new Date($(this).find('td:eq(2)').text()); 
				var timeDiff = Math.abs(currentDate.getTime() - rowDate.getTime());
				var diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24));
				if (diffDays < 14) {
					$(this).addClass('red-row');
				}
			});
		}
	});

    $(document).ready(function() {
        function filterTableByDateRange() {
            var startDate = new Date($('#start_date').val());
            var endDate = new Date($('#end_date').val());

            var tableIds = ['#emp-div', '#agent-div', '#sup-div', '#client-div', '#all-div'];

            tableIds.forEach(function(tableId) {
                $(tableId + ' tbody tr').each(function() {
                    var rowDateStr = $(this).find('td:nth-child(2)').text(); 
                    var rowDate = new Date(rowDateStr);

                    if ((isNaN(startDate) || rowDate >= startDate) && (isNaN(endDate) || rowDate <= endDate)) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        }

        $('#filter_button').on('click', function() {
            filterTableByDateRange();
        });
    });
</script>
<script>
$(document).ready(function() {
    $("input[type=radio][name=divChoice]").change(function() {
        var selectedValue = $(this).val();

        $("#emp-div, #agent-div, #sup-div, #client-div, #all-div").hide();
        $(".dataTables_length, .dataTables_info, .dataTables_paginate, .dataTables_filter").hide();

        $("#" + selectedValue).show();
        
   
        $(".table").DataTable().destroy();

      
        $("#" + selectedValue).DataTable({
        
        });

        $("#" + selectedValue + "_wrapper .dataTables_length, " +
            "#" + selectedValue + "_wrapper .dataTables_info, " +
            "#" + selectedValue + "_wrapper .dataTables_paginate, " +
            "#" + selectedValue + "_wrapper .dataTables_filter").show();
    });
});
</script>
<script>

	$(document).ready(function(){
		// $('#create_new').click(function(){
		// 	uni_modal("Voucher Setup Entry","journals/manage_journal.php",'mid-large')
		// })
		// $('.edit_data').click(function(){
		// 	uni_modal("Edit Voucher Setup Entry","journals/manage_journal.php?id="+$(this).attr('data-id'),"mid-large")
		// })
		// $('.export_data').click(function() {
		// 	var dataId = $(this).attr('data-id');
		// 	var redirectUrl = '?page=journals/export_voucher&id=' + dataId;
		// 	window.location.href = redirectUrl;
		// })
		
        $('[data-toggle="tooltip"]').tooltip();
    
		$('.edit_data_supplier').click(function() {
			var dataId = $(this).attr('data-id');
			var poNoValue = $(this).closest('tr').find('#po_no').val();
			var redirectUrl = '';

			if (poNoValue === 'PO') {
				redirectUrl = '?page=journals/vs/m_supplier_voucher_mod&id=' + dataId;
			} else {
				redirectUrl = '?page=journals/vs/m_nonpo_supplier_voucher&id=' + dataId;
			}

			window.location.href = redirectUrl;
		});

		$('.edit_data_agent').click(function() {
			var dataId = $(this).attr('data-id');
			var redirectUrl = '?page=journals/vs/m_agent_voucher&id=' + dataId;
			window.location.href = redirectUrl;
		})
		$('.edit_data_employee').click(function() {
			var dataId = $(this).attr('data-id');
			var redirectUrl = '?page=journals/vs/m_employee_voucher&id=' + dataId;
			window.location.href = redirectUrl;
		})
		$('.edit_data_client').click(function() {
			var dataId = $(this).attr('data-id');
			var redirectUrl = '?page=journals/vs/m_client_voucher&id=' + dataId;
			window.location.href = redirectUrl;
		})
		$('.delete_data').click(function(){
			_conf("Are you sure you want to delete this voucher setup entry permanently?","delete_vs",[$(this).attr('data-id')])
		})
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
	
</script>
<script>
$(document).ready(function() {
    var selectedVouchers = new Set();

    $(document).on('change', 'input[name="select_voucher"]', function() {
        if ($(this).is(':checked')) {
            selectedVouchers.add($(this).val());
        } else {
            selectedVouchers.delete($(this).val());
        }
    });

    $('#updateStatusButton').click(function() {
		if (confirm("Are you sure you want to update the status of selected vouchers?")) {
			if (selectedVouchers.size > 0) {
				start_loader();
				$.ajax({
					url: _base_url_ + "classes/Master.php?f=update_m_status",
					method: "POST",
					data: {
						vouchers: Array.from(selectedVouchers)
					},
					dataType: "json",
					error: function(err) {
						console.log(err);
						alert_toast("An error occurred.", 'error');
						end_loader();
					},
					success: function(resp) {
						if (typeof resp == 'object' && resp.status == 'success') {
							location.reload();
						} else {
							alert_toast("An error occurred.", 'error');
							end_loader();
						}
					}
				});
			} else {
				alert('Please select at least one voucher.');
			}
		} else {
			return false;
		}
	});
});
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
