<?php if($_settings->chk_flashdata('success')): 
$usercode = $_settings->userdata('user_code'); 
$department = $_settings->userdata('department'); 	
$usertype = $_settings->userdata('user_code'); 
$position = $_settings->userdata('position'); 
$publicRfpNo;
$columnName;


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
	body{
        font-size:12px!important;
    }
	.view_data:hover span.badge {
        background-color: #007bff!important;
        color: white!important;
        border-color: #007bff!important;
    }
	.print_data:hover span.badge {
        background-color: black!important;
        color: white!important;
        border-color: black!important;
    }
    .disapproved_data:hover span.badge {
        background-color: #ff0000!important;
        color: white!important;
        border-color: #ff0000!important;
    }
    .approved_data:hover span.badge {
        background-color:#28a745!important;
        color: white!important;
        border-color: #28a745!important;
    }
	.edit_data:hover span.badge {
        background-color:#6c757d!important;
        color: white!important;
        border-color: #6c757d!important;
    }
	button{
		border: 1px solid #000; 
		background-color: #f0f0f0; 
		cursor: pointer;
		width: auto;
	}
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><b><i>Request for Payment List</b></i></h3>
		<table>
			<tr>
				<td style="float:right;">
					<button id="export-csv-btn" class="btn btn-flat btn-success btn-sm"><i class="fas fa-file-export"></i> Export</button>
				</td>
				<td style="float:right;">
					<a href="?page=rfp/manage_rfp" class="btn btn-flat btn-primary btn-sm" style="font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Create New</a>
				</td>
			</tr>
		</table>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
				<!-- <colgroup>
					<col width="5%">
					<col width="8%">
					<col width="9%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
					<col width="18%">
				</colgroup> -->
				<thead>
					<tr class="bg-navy disabled">
                        <th>#</th>
						<th>RFP No.</th>
						<th>Preparer</th>
						<!-- <th>Name</th> -->
						<th>Req. Dept.</th>
						<!-- <th>Payment Form</th>
						<th>Bank Name</th> -->
						<th>Tran. Date</th>
						<th>Check Date</th>
						<th>Amount</th>
						<th>Approver 1</th>
						<th>Approver 2</th>
						<th>Approver 3</th>
						<th>Approver 4</th>
						<th>Approver 5</th>
						<th>Approver 6</th>
						<!-- <th>Approver 7</th> -->
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$i = 1;
					if (($_settings->userdata('division') != 'MNGR' && $_settings->userdata('division') != 'SPVR') || ($_settings->userdata('user_code') == '20051') || ($_settings->userdata('division') == 'MNGR' && $_settings->userdata('department') == 'Marketing') || ($_settings->userdata('division') == 'MNGR' && $_settings->userdata('department') == 'Corporate Communications') || ($_settings->userdata('division') == 'SPVR' && $_settings->userdata('department') == 'General Services') || ($_settings->userdata('division') == 'MNGR' && $_settings->userdata('department') == 'Const. and Impln.') || ($_settings->userdata('division') == 'SPVR' && $_settings->userdata('department') == 'Documentation and Loan') || ($_settings->userdata('division') == 'MNGR' && $_settings->userdata('department') == 'Legal') || ($_settings->userdata('division') == 'MNGR' && $_settings->userdata('department') == 'IT') || ($_settings->userdata('division') == 'SPVR' && $_settings->userdata('department') == 'Audit') || ($_settings->userdata('division') == 'SPVR' && $_settings->userdata('department') == 'Inventory Control') || ($_settings->userdata('division') == 'SPVR' && $_settings->userdata('department') == 'Personnel') || ($_settings->userdata('division') == 'SPVR' && $_settings->userdata('department') == 'Project Admin') || ($_settings->userdata('division') == 'SPVR' && $_settings->userdata('department') == 'Technical Planning') || ($_settings->userdata('division') == 'SPVR' && $_settings->userdata('department') == 'Electrical')) {
						$qry = $conn->query("SELECT DISTINCT tbl_rfp.check_date,tbl_rfp.amount,tbl_rfp.id, tbl_rfp.rfp_no, tbl_rfp.preparer,tbl_rfp.name,tbl_rfp.req_dept,tbl_rfp.bank_name,tbl_rfp.release_date,tbl_rfp.transaction_date,tbl_rfp.payment_form, 
						tbl_rfp.status1 AS U1,tbl_rfp.status2 AS U2, tbl_rfp.status3 AS U3, tbl_rfp.status4 AS U4, tbl_rfp.status5 AS U5,tbl_rfp.status6 AS U6,tbl_rfp.status7 AS U7 FROM tbl_rfp WHERE req_dept = '" . $_settings->userdata('department') . "' ORDER BY tbl_rfp.transaction_date DESC");
					} else if($_settings->userdata('user_code') == 10009) {
						$qry = $conn->query("SELECT 
						tbl_rfp.id, 
						tbl_rfp.rfp_no, 
						tbl_rfp.preparer,
						tbl_rfp.name,
						tbl_rfp.req_dept,
						tbl_rfp.bank_name,
						tbl_rfp.check_date,tbl_rfp.amount,
						tbl_rfp.release_date,
						tbl_rfp.transaction_date,
						tbl_rfp.payment_form, 
						MAX(tbl_rfp_approvals.status1) AS S1,
						MAX(tbl_rfp_approvals.status2) AS S2,
						MAX(tbl_rfp_approvals.status3) AS S3,
						MAX(tbl_rfp_approvals.status4) AS S4,
						MAX(tbl_rfp_approvals.status5) AS S5,
						MAX(tbl_rfp_approvals.status6) AS S6,
						MAX(tbl_rfp_approvals.status7) AS S7,
						MAX(tbl_rfp.status1) AS U1,
						MAX(tbl_rfp.status2) AS U2,
						MAX(tbl_rfp.status3) AS U3,
						MAX(tbl_rfp.status4) AS U4,
						MAX(tbl_rfp.status5) AS U5,
						MAX(tbl_rfp.status6) AS U6,
						MAX(tbl_rfp.status7) AS U7
					FROM tbl_rfp 
					JOIN tbl_rfp_approvals ON tbl_rfp.req_dept = 'Documentation and Loan' || tbl_rfp.req_dept = 'Inventory Control' || tbl_rfp.req_dept = 'Permits and Licenses'
						AND (
							tbl_rfp.status1 = " . $_settings->userdata('user_code') . "
							OR tbl_rfp.status2 = " . $_settings->userdata('user_code') . "
							OR tbl_rfp.status3 = " . $_settings->userdata('user_code') . "
							OR tbl_rfp.status4 = " . $_settings->userdata('user_code') . "
							OR tbl_rfp.status5 = " . $_settings->userdata('user_code') . "
							OR tbl_rfp.status6 = " . $_settings->userdata('user_code') . "
							OR tbl_rfp.status7 = " . $_settings->userdata('user_code') . "
						)
					GROUP BY 
						tbl_rfp.id, 
						tbl_rfp.rfp_no, 
						tbl_rfp.preparer,
						tbl_rfp.name,
						tbl_rfp.req_dept,
						tbl_rfp.bank_name,
						tbl_rfp.check_date,tbl_rfp.amount,
						tbl_rfp.release_date,
						tbl_rfp.transaction_date,
						tbl_rfp.payment_form ORDER BY tbl_rfp.transaction_date DESC;
						");
					}else if($_settings->userdata('user_code') == 10070) {
						$qry = $conn->query("SELECT 
						tbl_rfp.id, 
						tbl_rfp.rfp_no, 
						tbl_rfp.preparer,
						tbl_rfp.name,
						tbl_rfp.req_dept,
						tbl_rfp.bank_name,
						tbl_rfp.check_date,tbl_rfp.amount,
						tbl_rfp.release_date,
						tbl_rfp.transaction_date,
						tbl_rfp.payment_form, 
						MAX(tbl_rfp_approvals.status1) AS S1,
						MAX(tbl_rfp_approvals.status2) AS S2,
						MAX(tbl_rfp_approvals.status3) AS S3,
						MAX(tbl_rfp_approvals.status4) AS S4,
						MAX(tbl_rfp_approvals.status5) AS S5,
						MAX(tbl_rfp_approvals.status6) AS S6,
						MAX(tbl_rfp_approvals.status7) AS S7,
						MAX(tbl_rfp.status1) AS U1,
						MAX(tbl_rfp.status2) AS U2,
						MAX(tbl_rfp.status3) AS U3,
						MAX(tbl_rfp.status4) AS U4,
						MAX(tbl_rfp.status5) AS U5,
						MAX(tbl_rfp.status6) AS U6,
						MAX(tbl_rfp.status7) AS U7
					FROM tbl_rfp 
					JOIN tbl_rfp_approvals ON tbl_rfp.req_dept = 'General Services' || tbl_rfp.req_dept = 'Personnel' || tbl_rfp.req_dept = 'Executive'
						-- AND (
						-- 	tbl_rfp.status1 = " . $_settings->userdata('user_code') . "
						-- 	OR tbl_rfp.status2 = " . $_settings->userdata('user_code') . "
						-- 	OR tbl_rfp.status3 = " . $_settings->userdata('user_code') . "
						-- 	OR tbl_rfp.status4 = " . $_settings->userdata('user_code') . "
						-- 	OR tbl_rfp.status5 = " . $_settings->userdata('user_code') . "
						-- 	OR tbl_rfp.status6 = " . $_settings->userdata('user_code') . "
						-- 	OR tbl_rfp.status7 = " . $_settings->userdata('user_code') . "
						-- )
					GROUP BY 
						tbl_rfp.id, 
						tbl_rfp.rfp_no, 
						tbl_rfp.preparer,
						tbl_rfp.name,
						tbl_rfp.req_dept,
						tbl_rfp.bank_name,
						tbl_rfp.check_date,tbl_rfp.amount,
						tbl_rfp.release_date,
						tbl_rfp.transaction_date,
						tbl_rfp.payment_form ORDER BY tbl_rfp.transaction_date DESC;
						");
					}else if($_settings->userdata('user_code') == 10026) {
						$qry = $conn->query("SELECT DISTINCT 
							tbl_rfp.check_date,
							tbl_rfp.amount,
							tbl_rfp.id,
							tbl_rfp.rfp_no,
							tbl_rfp.preparer,
							tbl_rfp.name,
							tbl_rfp.req_dept,
							tbl_rfp.bank_name,
							tbl_rfp.release_date,
							tbl_rfp.transaction_date,
							tbl_rfp.payment_form, 
							tbl_rfp.status1 AS U1,
							tbl_rfp.status2 AS U2,
							tbl_rfp.status3 AS U3,
							tbl_rfp.status4 AS U4,
							tbl_rfp.status5 AS U5,
							tbl_rfp.status6 AS U6,
							tbl_rfp.status7 AS U7 
						FROM tbl_rfp 
						WHERE tbl_rfp.req_dept = 'Design and Devt.' OR 
							tbl_rfp.req_dept = 'Technical Planning' OR 
							tbl_rfp.req_dept = 'Electrical' OR 
							tbl_rfp.req_dept = 'Permits and Licenses' OR 
							tbl_rfp.req_dept = 'Engineering' OR 
							tbl_rfp.req_dept = 'Contracts and Doc.' 
						ORDER BY tbl_rfp.transaction_date DESC
					");

					}else {
						$qry = $conn->query("SELECT 
						tbl_rfp.id, 
						tbl_rfp.rfp_no, 
						tbl_rfp.preparer,
						tbl_rfp.name,
						tbl_rfp.req_dept,
						tbl_rfp.bank_name,
						tbl_rfp.check_date,tbl_rfp.amount,
						tbl_rfp.release_date,
						tbl_rfp.transaction_date,
						tbl_rfp.payment_form, 
						MAX(tbl_rfp_approvals.status1) AS S1,
						MAX(tbl_rfp_approvals.status2) AS S2,
						MAX(tbl_rfp_approvals.status3) AS S3,
						MAX(tbl_rfp_approvals.status4) AS S4,
						MAX(tbl_rfp_approvals.status5) AS S5,
						MAX(tbl_rfp_approvals.status6) AS S6,
						MAX(tbl_rfp_approvals.status7) AS S7,
						MAX(tbl_rfp.status1) AS U1,
						MAX(tbl_rfp.status2) AS U2,
						MAX(tbl_rfp.status3) AS U3,
						MAX(tbl_rfp.status4) AS U4,
						MAX(tbl_rfp.status5) AS U5,
						MAX(tbl_rfp.status6) AS U6,
						MAX(tbl_rfp.status7) AS U7
					FROM tbl_rfp 
					JOIN tbl_rfp_approvals ON tbl_rfp.req_dept = '" . $_settings->userdata('department') . "'
						AND (
							tbl_rfp.status1 = " . $_settings->userdata('user_code') . "
							OR tbl_rfp.status2 = " . $_settings->userdata('user_code') . "
							OR tbl_rfp.status3 = " . $_settings->userdata('user_code') . "
							OR tbl_rfp.status4 = " . $_settings->userdata('user_code') . "
							OR tbl_rfp.status5 = " . $_settings->userdata('user_code') . "
							OR tbl_rfp.status6 = " . $_settings->userdata('user_code') . "
							OR tbl_rfp.status7 = " . $_settings->userdata('user_code') . "
						)
					GROUP BY 
						tbl_rfp.id, 
						tbl_rfp.rfp_no, 
						tbl_rfp.preparer,
						tbl_rfp.name,
						tbl_rfp.req_dept,
						tbl_rfp.bank_name,
						tbl_rfp.check_date,tbl_rfp.amount,
						tbl_rfp.release_date,
						tbl_rfp.transaction_date,
						tbl_rfp.payment_form ORDER BY tbl_rfp.transaction_date DESC;
						");
					}
					while($row = $qry->fetch_assoc()):
						$tblId = $row['rfp_no'];
		
						for ($j = 1; $j <= 7; $j++) {
							$columnName = 'U' . $j;
							if ($row[$columnName] == $_settings->userdata('user_code')) {
								$columnNumber = preg_replace('/[^0-9]/', '', $columnName);
								$statusColumnName = 'status' . $columnNumber;
								//echo $statusColumnName;
							}
						}
						
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php 
							$publicRfpNo = $row['rfp_no'];
							echo $publicRfpNo ?></td>
							<td>
								<?php 
								$prep = $row['preparer'];
								$prep_qry = "SELECT * FROM users WHERE user_code = $prep;";
								$prep_result = $conn->query($prep_qry);

								if($prep_result->num_rows > 0){
										$prep_row = $prep_result->fetch_assoc();
										$lname = $prep_row['lastname'];
										$fname = $prep_row['firstname'];
										$pos = $prep_row['position'];
										echo '<b>' . $fname . ' ' . $lname .'</b>';
									}
								?>
							</td>
							<!-- <td><?php echo $row['name'] ?></td> -->
							<td><?php echo $row['req_dept']; ?></td>
							<!-- <td>
								<?php if ($row['payment_form'] == 0): ?>
									Check
								<?php else: ?>
									Cash
								<?php endif; ?>
							</td> -->
							<!-- <td><?php echo $row['bank_name']; ?></td> -->
							<td><?php echo date("Y-m-d",strtotime($row['transaction_date'])) ?></td>
							<td><?php echo date("Y-m-d",strtotime($row['check_date'])) ?></td>
							<td><?php echo number_format(($row['amount']),2) ?></td>
							<td class="">
								<?php 
									$app1_qry = "SELECT * FROM users WHERE user_code = '" . $row['U1'] . "'";
									$app1_result = $conn->query($app1_qry);

									if($app1_result->num_rows > 0){
										$app1_row = $app1_result->fetch_assoc();
										$lname = $app1_row['lastname'];
										$fname = $app1_row['firstname'];
										$pos = $app1_row['position'];
										echo '<b>' . $fname . ' ' . $lname .'</b>';
									}
								?>
								
								<?php 
									$app1_qry = "SELECT a.status1 AS a1, b.status1 AS b1 
												FROM tbl_rfp a 
												RIGHT JOIN tbl_rfp_approvals b ON a.rfp_no = b.rfp_no 
												WHERE a.rfp_no = '" . $publicRfpNo . "'";
									$app1_result = $conn->query($app1_qry);

									if($app1_result->num_rows > 0){
										$app1_row = $app1_result->fetch_assoc();
										$statsa1 = $app1_row['a1'];
										$statsb1 = $app1_row['b1'];
										
										
										if ($statsa1 == null && $statsb1 == 0) {
											
											echo '<span>-</span>';
										} else {
											switch($statsb1){
												case 2:
													echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Disapproved</span>';
													break;
												case 1:
													echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Approved</span>';
													break;
												default:
													echo '<span class="badge badge-default border px-3 rounded-pill">Pending</span>';
													break;
											}
										}
									} else {
										echo '';
									}
								?>
							</td>
							<td class="">
								<?php 
									$app2_qry = "SELECT * FROM users WHERE user_code = '" . $row['U2'] . "'";
									$app2_result = $conn->query($app2_qry);

									if($app2_result->num_rows > 0){
										$app2_row = $app2_result->fetch_assoc();
										$lname = $app2_row['lastname'];
										$fname = $app2_row['firstname'];
										$pos2 = $app2_row['position'];
										echo '<b>' . $fname . ' ' . $lname .'</b>';
									}
								?>
								
								<?php 
									$app2_qry = "SELECT a.status2 AS a2, b.status2 AS b2 
												FROM tbl_rfp a 
												RIGHT JOIN tbl_rfp_approvals b ON a.rfp_no = b.rfp_no 
												WHERE a.rfp_no = '" . $publicRfpNo . "'";
									$app2_result = $conn->query($app2_qry);

									if($app2_result->num_rows > 0){
										$app2_row = $app2_result->fetch_assoc();
										$statsa2 = $app2_row['a2'];
										$statsb2 = $app2_row['b2'];
										
										
										if ($statsa2 == null && $statsb2 == 0) {
											
											echo '<span>-</span>';
										} else {
											switch($statsb2){
												case 2:
													echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Disapproved</span>';
													break;
												case 1:
													echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Approved</span>';
													break;
												default:
													echo '<span class="badge badge-default border px-3 rounded-pill">Pending</span>';
													break;
											}
										}
									} else {
										echo '';
									}
								?>
							</td>
							<td class="">
								<?php 
									$app3_qry = "SELECT * FROM users WHERE user_code = '" . $row['U3'] . "'";
									$app3_result = $conn->query($app3_qry);

									if($app3_result->num_rows > 0){
										$app3_row = $app3_result->fetch_assoc();
										$lname = $app3_row['lastname'];
										$fname = $app3_row['firstname'];
										$pos3 = $app3_row['position'];
										echo '<b>' . $fname . ' ' . $lname .'</b> ';
									}
								?>
								
								<?php 
									$app3_qry = "SELECT a.status3 AS a3, b.status3 AS b3 
												FROM tbl_rfp a 
												RIGHT JOIN tbl_rfp_approvals b ON a.rfp_no = b.rfp_no 
												WHERE a.rfp_no = '" . $publicRfpNo . "'";
									$app3_result = $conn->query($app3_qry);

									if($app3_result->num_rows > 0){
										$app3_row = $app3_result->fetch_assoc();
										$statsa3 = $app3_row['a3'];
										$statsb3 = $app3_row['b3'];
										
										
										if ($statsa3 == null && $statsb3 == 0) {
											
											echo '<span>-</span>';
										} else {
											switch($statsb3){
												case 2:
													echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Disapproved</span>';
													break;
												case 1:
													echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Approved</span>';
													break;
												default:
													echo '<span class="badge badge-default border px-3 rounded-pill">Pending</span>';
													break;
											}
										}
									} else {
										echo '';
									}
								?>
							</td>
							<td class="">
								<?php 
									$app4_qry = "SELECT * FROM users WHERE user_code = '" . $row['U4'] . "'";
									$app4_result = $conn->query($app4_qry);

									if($app4_result->num_rows > 0){
										$app4_row = $app4_result->fetch_assoc();
										$lname = $app4_row['lastname'];
										$fname = $app4_row['firstname'];
										$pos4 = $app4_row['position'];
										echo '<b>' . $fname . ' ' . $lname .'</b>';
									}
								?>
								
								<?php 
									$app4_qry = "SELECT a.status4 AS a4, b.status4 AS b4 
												FROM tbl_rfp a 
												RIGHT JOIN tbl_rfp_approvals b ON a.rfp_no = b.rfp_no 
												WHERE a.rfp_no = '" . $publicRfpNo . "'";
									$app4_result = $conn->query($app4_qry);

									if($app4_result->num_rows > 0){
										$app4_row = $app4_result->fetch_assoc();
										$statsa4 = $app4_row['a4'];
										$statsb4 = $app4_row['b4'];
										
										
										if ($statsa4 == null && $statsb4 == 0) {
											
											echo '<span>-</span>';
										} else {
											switch($statsb4){
												case 2:
													echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Disapproved</span>';
													break;
												case 1:
													echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Approved</span>';
													break;
												default:
													echo '<span class="badge badge-default border px-3 rounded-pill">Pending</span>';
													break;
											}
										}
									} else {
										echo '';
									}
								?>
							</td>
							
							<td class="">
								<?php 
									$app5_qry = "SELECT * FROM users WHERE user_code = '" . $row['U5'] . "'";
									$app5_result = $conn->query($app5_qry);

									if($app5_result->num_rows > 0){
										$app5_row = $app5_result->fetch_assoc();
										$lname = $app5_row['lastname'];
										$fname = $app5_row['firstname'];
										$pos5 = $app5_row['position'];
										echo '<b>' . $fname . ' ' . $lname .'</b>';
									} else {
										echo '';
									}
								?>
								
								<?php 
									$app5_qry = "SELECT a.status5 AS a5, b.status5 AS b5 
												FROM tbl_rfp a 
												RIGHT JOIN tbl_rfp_approvals b ON a.rfp_no = b.rfp_no 
												WHERE a.rfp_no = '" . $publicRfpNo . "'";
									$app5_result = $conn->query($app5_qry);

									if($app5_result->num_rows > 0){
										$app5_row = $app5_result->fetch_assoc();
										$statsa5 = $app5_row['a5'];
										$statsb5 = $app5_row['b5'];
										
										
										if ($statsa5 == null && $statsb5 == 0) {
											
											echo '<span>-</span>';
										} else {
											switch($statsb5){
												case 2:
													echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Disapproved</span>';
													break;
												case 1:
													echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Approved</span>';
													break;
												default:
													echo '<span class="badge badge-default border px-3 rounded-pill">Pending</span>';
													break;
											}
										}
									} else {
										echo '';
									}
								?>
							</td>
							<td class="">
								<?php 
									$app6_qry = "SELECT * FROM users WHERE user_code = '" . $row['U6'] . "'";
									$app6_result = $conn->query($app6_qry);

									if($app6_result->num_rows > 0){
										$app6_row = $app6_result->fetch_assoc();
										$lname = $app6_row['lastname'];
										$fname = $app6_row['firstname'];
										$pos6 = $app6_row['position'];
										echo '<b>' . $fname . ' ' . $lname .'</b>';
									} else {
										echo '';
									}
								?>
								
								<?php 
									$app6_qry = "SELECT a.status6 AS a6, b.status6 AS b6 
												FROM tbl_rfp a 
												RIGHT JOIN tbl_rfp_approvals b ON a.rfp_no = b.rfp_no 
												WHERE a.rfp_no = '" . $publicRfpNo . "'";
									$app6_result = $conn->query($app6_qry);

									if($app6_result->num_rows > 0){
										$app6_row = $app6_result->fetch_assoc();
										$statsa6 = $app6_row['a6'];
										$statsb6 = $app6_row['b6'];
										
										
										if ($statsa6 == null && $statsb6 == 0) {
											
											echo '<span>-</span>';
										} else {
											switch($statsb6){
												case 2:
													echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Disapproved</span>';
													break;
												case 1:
													echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Approved</span>';
													break;
												default:
													echo '<span class="badge badge-default border px-3 rounded-pill">Pending</span>';
													break;
											}
										}
									} else {
										echo '';
									}
								?>
							</td>
							
							<!-- <td class="">
								<?php 
									$app7_qry = "SELECT * FROM users WHERE user_code = '" . $row['U7'] . "'";
									$app7_result = $conn->query($app7_qry);

									if($app7_result->num_rows > 0){
										$app7_row = $app7_result->fetch_assoc();
										$lname = $app7_row['lastname'];
										$fname = $app7_row['firstname'];
										$pos7 = $app7_row['position'];
										echo '<b>' . $fname . ' ' . $lname .'</b>';
									} else {
										echo '';
									}
								?>
								
								<?php 
									$app7_qry = "SELECT a.status7 AS a7, b.status7 AS b7 
												FROM tbl_rfp a 
												RIGHT JOIN tbl_rfp_approvals b ON a.rfp_no = b.rfp_no 
												WHERE a.rfp_no = '" . $publicRfpNo . "'";
									$app7_result = $conn->query($app7_qry);

									if($app7_result->num_rows > 0){
										$app7_row = $app7_result->fetch_assoc();
										$statsa7 = $app7_row['a7'];
										$statsb7 = $app7_row['b7'];
										
										
										if ($statsa7 == null && $statsb7 == 0) {
											
											echo '<span>-</span>';
										} else {
											switch($statsb7){
												case 2:
													echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Disapproved</span>';
													break;
												case 1:
													echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Approved</span>';
													break;
												default:
													echo '<span class="badge badge-default border px-3 rounded-pill">Pending</span>';
													break;
											}
										}
									} else {
										echo '';
									}
								?>
							</td> -->
							<td align="center">
								<?php 
									$qry_approved = $conn->query("SELECT type FROM users WHERE user_code = '" . $_settings->userdata('user_code') . "'"); 

									while ($row_approved = $qry_approved->fetch_assoc()):
										$type = $row_approved['type'];
										$userCode = $_settings->userdata('user_code');
										$a = $userCode; 

										if ($type <= 4): 
											$qry_filtered = $conn->query("SELECT a.rfp_no, a.status1, a.status2, a.status3, a.status4, a.status5, a.status6, a.status7
											FROM tbl_rfp_approvals AS a
											JOIN tbl_rfp AS r ON a.rfp_no = r.rfp_no
											WHERE a.rfp_no = '{$tblId}'
											AND (
												(r.status1 = '{$userCode}' AND a.status1 = 0) OR
												(r.status2 = '{$userCode}' AND a.status2 = 0 AND a.status1 = 1) OR
												(r.status3 = '{$userCode}' AND a.status3 = 0 AND a.status2 = 1 AND a.status1 = 1) OR
												(r.status4 = '{$userCode}' AND a.status4 = 0 AND a.status3 = 1 AND a.status2 = 1 AND a.status1 = 1) OR
												(r.status5 = '{$userCode}' AND a.status5 = 0 AND a.status4 = 1 AND a.status3 = 1 AND a.status2 = 1 AND a.status1 = 1) OR
												(r.status6 = '{$userCode}' AND a.status6 = 0 AND a.status5 = 1 AND a.status4 = 1 AND a.status3 = 1 AND a.status2 = 1 AND a.status1 = 1) OR
												(r.status7 = '{$userCode}' AND a.status7 = 0 AND a.status6 = 1 AND a.status5 = 1 AND a.status4 = 1 AND a.status3 = 1 AND a.status2 = 1 AND a.status1 = 1)
											);
											");

											while ($row_filtered = $qry_filtered->fetch_assoc()):
											?>
												<button style="border:none;background-color:transparent;margin:-5px;" type="button" class="approved_data" href="javascript:void(0)" data-id="<?php echo $tblId ?>" data-user="<?php echo $_settings->userdata('user_code') ?>">	
													<span class="badge rounded-circle p-2" style="color:#28a745; background-color: white; border: 1px solid gainsboro; border-radius: 50%;"  data-toggle="tooltip" data-placement="top" title="Approved">
														<i class="fa fa-thumbs-up fa-lg" aria-hidden="true"></i>
													</span>
												</button>
												<button style="border:none;background-color:transparent;margin:-5px;" type="button" class="disapproved_data" href="javascript:void(0)" data-id="<?php echo $tblId ?>" data-user="<?php echo $_settings->userdata('user_code') ?>">
													<span class="badge rounded-circle p-2" style="color:#ff0000; background-color: white; border: 1px solid gainsboro; border-radius: 50%;"  data-toggle="tooltip" data-placement="top" title="Disapproved">
														<i class="fa fa-thumbs-down fa-lg" aria-hidden="true"></i>
													</span>
												</button>
												<!-- <div class="dropdown-divider"></div> -->
											<?php endwhile; ?>

										<?php endif; ?>

										<?php 
											if (($type > 4) || (($type == 3) && ($_settings->userdata('department') == 'Marketing') || ($_settings->userdata('department') == 'Corporate Communications') || ($_settings->userdata('department') == 'General Services') || ($_settings->userdata('department') == 'Const. and Impln.') || ($_settings->userdata('department') == 'Documentation and Loan') || ($_settings->userdata('department') == 'Inventory Control') || ($_settings->userdata('department') == 'Legal') || ($_settings->userdata('department') == 'IT') || ($_settings->userdata('department') == 'Audit') || ($_settings->userdata('department') == 'Personnel') || ($_settings->userdata('department') == 'Project Admin') || ($_settings->userdata('department') == 'Executive') || ($_settings->userdata('department') == 'Technical Planning') || ($_settings->userdata('department') == 'Permits and Licenses') || ($_settings->userdata('department') == 'Electrical'))) {  
												$qry_filtered = $conn->query("SELECT rfp_no, status1
                              FROM tbl_rfp_approvals
                              WHERE status1 = 0 AND rfp_no = '{$tblId}' AND {$prep} = '{$_settings->userdata('user_code')}';");

												if ($qry_filtered->num_rows > 0) { 
											?>
													<a class="edit_data" href="javascript:void(0)" data-id="<?php echo $tblId ?>">
														<span class="badge rounded-circle p-2" style="color:#6c757d; background-color: white; border: 1px solid gainsboro; border-radius: 50%;"  data-toggle="tooltip" data-placement="top" title="Edit">
															<i class="fa fa-edit fa-lg" aria-hidden="true"></i>
														</span>
													</a>
													
											<?php 
												}
											} 
											?>


									<?php endwhile; ?>	
										<button type="button" style="border:none;background-color:transparent;" class="view_data" href="javascript:void(0)" data-id="<?php echo $tblId ?>">
											<span class="badge rounded-circle p-2" style="margin:-5px;color:#1184ff; background-color: white; border: 1px solid gainsboro; border-radius: 50%;"  data-toggle="tooltip" data-placement="top" title="View">
												<i class="fa fa-eye fa-lg" aria-hidden="true"></i>
											</span>
										</button>
										<button type="button" style="border:none;background-color:transparent;" class="print_data" data-id="<?php echo $tblId ?>" 
												onclick="window.open('<?php echo base_url ?>/report/voucher_report/print_rfp.php?id=<?php echo $tblId ?>', '_blank')"
												data-toggle="tooltip" data-placement="top" title="Print"> 
												<span class="badge rounded-circle p-2" style="margin:-5px;background-color: white; border: 1px solid gainsboro; border-radius: 50%;"  data-toggle="tooltip" data-placement="top" title="Print">
													<i class="fa fa-print fa-lg" aria-hidden="true"></i>
												</span>
										</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("export-csv-btn").addEventListener("click", function() {
        exportAllTableDataToCSV();
    });
});

function exportAllTableDataToCSV() {
    var csv = [];
    var currentDate = new Date();
    var formattedDate = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();

    csv.push("Request for Payment List as of " + formattedDate + "\n\n");

    var headers = [];
    $('.table th').each(function(index) {
        if (index < $('.table th').length - 1) { 
            headers.push($(this).text());
        }
    });
    csv.push(headers.join(","));

    var table = $('.table').DataTable();
    var data = table.rows().data();

    data.each(function(rowData) {
        var row = [];
        rowData.forEach(function(cellData, index) {

            var plainText = cellData.replace(/<[^>]+>/g, '').replace(/\r?\n|\r/g, '');
            if (index === 6) { 
                plainText = plainText.replace(/,/g, '');
            }
            if (index >= 7) { 
                plainText = plainText.replace(/(\S+)\s+(\S+)$/g, '$1 ($2)'); 
            }
            row.push(plainText);
        });
        csv.push(row.join(","));
    });

    var filename = "RFP_asof_" + formattedDate + '.csv';
    downloadCSV(csv.join("\n"), filename);
}

function downloadCSV(csv, filename) {
    var csvFile = new Blob([csv], { type: "text/csv" });
    var downloadLink = document.createElement("a");

    downloadLink.download = filename;
    downloadLink.href = window.URL.createObjectURL(csvFile);

    downloadLink.style.display = "none";

    document.body.appendChild(downloadLink);

    downloadLink.click();

    document.body.removeChild(downloadLink);
}
   
</script>
<script>
	$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();

	$('.approved_data').click(function(){
        _conf("Are you sure you want to approved this request for payment?","approved_rfp",[$(this).attr('data-id'),$(this).attr('data-user')])
    })

		$('.disapproved_data').click(function(){
        _conf("Are you sure you want to disapproved this request for payment?","disapproved_rfp",[$(this).attr('data-id'),$(this).attr('data-user')])
    })
	
    $('.view_data').click(function() {
        var id = $(this).data('id').toString();
		var redirectUrl = '?page=rfp/view_rfp&id=' + id;
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
function approved_rfp($id,$userId){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=approved_rfp",
			method:"POST",
			data:{id: $id, userId: $userId},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.replace('./?page=rfp/rfp_list')
					//location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
function disapproved_rfp($id,$userId){
	start_loader();
	$.ajax({
		url:_base_url_+"classes/Master.php?f=disapproved_rfp",
		method:"POST",
		data:{id: $id, userId: $userId},
		dataType:"json",
		error:err=>{
			console.log(err)
			alert_toast("An error occured.",'error');
			end_loader();
		},
		success:function(resp){
			if(typeof resp== 'object' && resp.status == 'success'){
				location.replace('./?page=rfp/rfp_list')
			}else{
				alert_toast("An error occured.",'error');
				end_loader();
			}
		}
	})
}
</script>