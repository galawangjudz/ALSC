<?php if($_settings->chk_flashdata('success')): 
$usercode = $_settings->userdata('user_code'); 
$department = $_settings->userdata('department'); 	
$usertype = $_settings->userdata('user_code'); 
$position = $_settings->userdata('position'); 
$publicTbaNo;
$columnName;


?>
	
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
	.nav-tba-list{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-tba-list:hover{
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
		<h3 class="card-title"><b><i>TBA List</b></i></h3>
		<div class="card-tools">
		<button id="export-btn" class="btn btn-flat btn-success btn-sm"><i class="fas fa-file-export"></i> Export</button>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
				<thead>
					<tr class="bg-navy disabled">
                        <th>#</th>
						<th>TBA No.</th>
						<th>Preparer</th>
						<th>Req. Dept.</th>
						<th>Tran. Date</th>
						<th>Date Needed</th>
						<th>Amount</th>
						<th>Approver 1</th>
						<th>Approver 2</th>
						<th>Approver 3</th>
						<th>Approver 4</th>
						<th>Approver 5</th>
						<th>Approver 6</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
				<?php 
					$i = 1;
						if ($_settings->userdata('division') == 'MNGR' || $_settings->userdata('division') == 'SPVR') {
							$qry = $conn->query("SELECT DISTINCT tbl_tba.amount,tbl_tba.id, tbl_tba.tba_no, tbl_tba.preparer,tbl_tba.acc_person,tbl_tba.req_dept,tbl_tba.date_needed,tbl_tba.transaction_date,tbl_tba.payment_form, 
						tbl_tba.status1 AS U1,tbl_tba.status2 AS U2, tbl_tba.status3 AS U3, tbl_tba.status4 AS U4, tbl_tba.status5 AS U5,tbl_tba.status6 AS U6,tbl_tba.status7 AS U7 FROM tbl_tba ORDER BY tbl_tba.transaction_date DESC");
					} 
					while($row = $qry->fetch_assoc()):
						$tblId = $row['tba_no'];
		
						for ($j = 1; $j <= 7; $j++) {
							$columnName = 'U' . $j;
							if ($row[$columnName] == $_settings->userdata('user_code')) {
								$columnNumber = preg_replace('/[^0-9]/', '', $columnName);
								$statusColumnName = 'status' . $columnNumber;
							}
						}
						
					?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td><?php 
							$publicTbaNo = $row['tba_no'];
							echo $publicTbaNo ?></td>
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
							<td><?php echo $row['req_dept']; ?></td>
							<td><?php echo date("Y-m-d",strtotime($row['transaction_date'])) ?></td>
							<td><?php echo date("Y-m-d",strtotime($row['date_needed'])) ?></td>
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
												FROM tbl_tba a 
												RIGHT JOIN tbl_tba_approvals b ON a.tba_no = b.tba_no 
												WHERE a.tba_no = '" . $publicTbaNo . "'";
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
												FROM tbl_tba a 
												RIGHT JOIN tbl_tba_approvals b ON a.tba_no = b.tba_no 
												WHERE a.tba_no = '" . $publicTbaNo . "'";
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
												FROM tbl_tba a 
												RIGHT JOIN tbl_tba_approvals b ON a.tba_no = b.tba_no 
												WHERE a.tba_no = '" . $publicTbaNo . "'";
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
												FROM tbl_tba a 
												RIGHT JOIN tbl_tba_approvals b ON a.tba_no = b.tba_no 
												WHERE a.tba_no = '" . $publicTbaNo . "'";
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
												FROM tbl_tba a 
												RIGHT JOIN tbl_tba_approvals b ON a.tba_no = b.tba_no 
												WHERE a.tba_no = '" . $publicTbaNo . "'";
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
												FROM tbl_tba a 
												RIGHT JOIN tbl_tba_approvals b ON a.tba_no = b.tba_no 
												WHERE a.tba_no = '" . $publicTbaNo . "'";
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
							<td align="center">
								<?php 
									$qry_approved = $conn->query("SELECT type FROM users WHERE user_code = '" . $_settings->userdata('user_code') . "'"); 

									while ($row_approved = $qry_approved->fetch_assoc()):
										$type = $row_approved['type'];
										$userCode = $_settings->userdata('user_code');
										$a = $userCode; 

										if ($type <= 4): 
											$qry_filtered = $conn->query("SELECT a.tba_no, a.status1, a.status2, a.status3, a.status4, a.status5, a.status6, a.status7
											FROM tbl_tba_approvals AS a
											JOIN tbl_tba AS r ON a.tba_no = r.tba_no
											WHERE a.tba_no = '{$tblId}'
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
										<?php endwhile; ?>
										<?php endif; ?>
									<?php endwhile; ?>	
										<button type="button" style="border:none;background-color:transparent;" class="view_data" href="javascript:void(0)" data-id="<?php echo $tblId ?>">
											<span class="badge rounded-circle p-2" style="margin:-5px;color:#1184ff; background-color: white; border: 1px solid gainsboro; border-radius: 50%;"  data-toggle="tooltip" data-placement="top" title="View">
												<i class="fa fa-eye fa-lg" aria-hidden="true"></i>
											</span>
										</button>
										<button type="button" style="border:none;background-color:transparent;" class="print_data" data-id="<?php echo $tblId ?>" 
												onclick="window.open('<?php echo base_url ?>/report/voucher_report/print_tba.php?id=<?php echo $tblId ?>', '_blank')"
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
    document.getElementById("export-btn").addEventListener("click", function() {
        exportAllTableDataToCSV();
    });
});

function exportAllTableDataToCSV() {
    var csv = [];
    var currentDate = new Date();
    var formattedDate = currentDate.getFullYear() + '-' + (currentDate.getMonth() + 1) + '-' + currentDate.getDate();

    csv.push("TBA List as of " + formattedDate + "\n\n");

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

    var filename = "TBA_asof_" + formattedDate + '.csv';
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
        _conf("Are you sure you want to approved this TBA?","approved_tba",[$(this).attr('data-id'),$(this).attr('data-user')])
    })

		$('.disapproved_data').click(function(){
        _conf("Are you sure you want to disapproved this TBA?","disapproved_tba",[$(this).attr('data-id'),$(this).attr('data-user')])
    })
	
    $('.view_data').click(function() {
        var id = $(this).data('id').toString();
		var redirectUrl = '?page=tba/view_tba&id=' + id;
		window.location.href = redirectUrl;
    });

	$('.edit_data').click(function() {
        var id = $(this).data('id').toString();
		var redirectUrl = '?page=tba/manage_tba&id=' + id;
		window.location.href = redirectUrl;
    });

    $('.modal-title').css('font-size', '18px');
    $('.table th,.table td').addClass('px-1 py-0 align-middle')
    $('.table').dataTable();
});
function approved_tba($id,$userId){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=approved_tba",
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
					location.replace('./?page=tba/tba_list')
					//location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
function disapproved_tba($id,$userId){
	start_loader();
	$.ajax({
		url:_base_url_+"classes/Master.php?f=disapproved_tba",
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
				location.replace('./?page=tba/tba_list')
			}else{
				alert_toast("An error occured.",'error');
				end_loader();
			}
		}
	})
}
</script>