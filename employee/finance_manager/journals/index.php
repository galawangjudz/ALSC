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
			<table class="table table-hover table-bordered" id="sup-div">
				<colgroup>
					<col width="10%">
					<col width="15%">
					<col width="30%">
					<col width="10%">
					<col width="20%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>Voucher #</th>
						<th>Date</th>
						<th>Supplier Name</th>
                        <th>PO Type</th>
						<th>Status</th>
						<th style="text-align:center;">Action</th>
					</tr>
				</thead>
				<tbody>
				
					<?php 
					$journals = $conn->query("SELECT j.po_no as poNo, s.name as sname, j.c_status as stats, j.journal_date, j.v_num, s.* FROM `vs_entries` j inner join `supplier_list` s on j.supplier_id = s.id order by j.date_updated desc");
					while($row = $journals->fetch_assoc()):
					?>
					<tr>
                        <td class=""><?= $row['v_num'] ?></td>
						<td class="text-center"><?= date("M d, Y", strtotime($row['journal_date'])) ?></td>
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
								<button type="button" class="btn btn-flat btn-default btn-sm approved_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Approve">
									<span class="fa fa-thumbs-up text-success"></span>
								</button>
								<button type="button" class="btn btn-flat btn-default btn-sm disapproved_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Disapprove">
									<span class="fa fa-thumbs-down text-danger"></span>
								</button>
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
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

			<table class="table table-hover table-bordered" id="agent-div">
				<colgroup>
					<col width="10%">
					<col width="15%">
					<col width="40%">
					<col width="20%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>Voucher #</th>
						<th>Date</th>
						<th>Agent Name</th>
						<th>Status</th>
						<th style="text-align:center;">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$journals = $conn->query("SELECT j.c_status as stats, j.journal_date, j.v_num, s.* FROM `vs_entries` j inner join `t_agents` s on j.supplier_id = s.c_code order by j.date_updated desc");
					while($row = $journals->fetch_assoc()):
					?>
					<tr>
                        <td class=""><?= $row['v_num'] ?></td>
						<td class="text-center"><?= date("M d, Y", strtotime($row['journal_date'])) ?></td>
                        <td class=""><?= $row['c_last_name'] ?>, <?= $row['c_first_name'] ?> <?= $row['c_middle_initial'] ?></td>
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
								<button type="button" class="btn btn-flat btn-default btn-sm approved_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Approve">
									<span class="fa fa-thumbs-up text-success"></span>
								</button>
								<button type="button" class="btn btn-flat btn-default btn-sm disapproved_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Disapprove">
									<span class="fa fa-thumbs-down text-danger"></span>
								</button>
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
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

			<table class="table table-hover table-bordered" id="emp-div">
				<colgroup>
					<col width="10%">
					<col width="15%">
					<col width="40%">
					<col width="20%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>Voucher #</th>
						<th>Date</th>
						<th>Employee Name</th>
						<th>Status</th>
						<th style="text-align:center;">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$journals = $conn->query("SELECT j.c_status as stats, j.journal_date, j.v_num, s.* FROM `vs_entries` j inner join `users` s on j.supplier_id = s.user_code order by j.date_updated desc");
					while($row = $journals->fetch_assoc()):
					?>
					<tr>
                        <td class=""><?= $row['v_num'] ?></td>
						<td class="text-center"><?= date("M d, Y", strtotime($row['journal_date'])) ?></td>
                        <td class=""><?= $row['lastname'] ?>, <?= $row['firstname'] ?></td>
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
								<button type="button" class="btn btn-flat btn-default btn-sm approved_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Approve">
									<span class="fa fa-thumbs-up text-success"></span>
								</button>
								<button type="button" class="btn btn-flat btn-default btn-sm disapproved_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Disapprove">
									<span class="fa fa-thumbs-down text-danger"></span>
								</button>
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
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
			<table class="table table-hover table-bordered" id="client-div">
				<colgroup>
					<col width="10%">
					<col width="15%">
					<col width="40%">
					<col width="20%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th>Voucher #</th>
						<th>Date</th>
                        <!-- <th>P.O. #</th> -->
						<th>Client Name</th>
                        <th>Status</th>
						<th style="text-align:center;">Action</th>
					</tr>
				</thead>
				<tbody>
                    
					<?php 
					
					//$users = $conn->query("SELECT user_code,username FROM `users` where user_code in (SELECT `user_id` FROM `vs_entries`)");
					//$user_arr = array_column($users->fetch_all(MYSQLI_ASSOC),'username','user_code');
					$journals = $conn->query("SELECT j.c_status as stats, j.journal_date, j.v_num, s.* FROM `vs_entries` j inner join `property_clients` s on j.supplier_id = s.client_id order by j.date_updated desc");
					while($row = $journals->fetch_assoc()):
					?>
					<tr>
                        <td class=""><?= $row['v_num'] ?></td>
						<td class="text-center"><?= date("M d, Y", strtotime($row['journal_date'])) ?></td>
						<!-- <td class=""><?= $row['po_no'] ?></td> -->
						
                        <td class=""><?= $row['last_name'] ?>, <?= $row['first_name'] ?></td>
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
								<button type="button" class="btn btn-flat btn-default btn-sm approved_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Approve">
									<span class="fa fa-thumbs-up text-success"></span>
								</button>
								<button type="button" class="btn btn-flat btn-default btn-sm disapproved_data custom-badge" data-id="<?php echo $row['v_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Disapprove">
									<span class="fa fa-thumbs-down text-danger"></span>
								</button>
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
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
$(document).ready(function() {
    $("input[type=radio][name=divChoice]").change(function() {
        var selectedValue = $(this).val();

        $("#emp-div, #agent-div, #sup-div, #client-div").hide();
        $(".dataTables_length, .dataTables_info, .dataTables_paginate, .dataTables_filter").hide();

        $("#" + selectedValue).show();
        
        // Destroy existing DataTables instances
        $(".table").DataTable().destroy();

        // Initialize DataTable for the selected table
        $("#" + selectedValue).DataTable({
            // your DataTable options here
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

		$('.approved_data').click(function(){
			_conf("Are you sure you want to approve this voucher setup?","approved_vs",[$(this).attr('data-id')])
		})
		$('.disapproved_data').click(function(){
			_conf("Are you sure you want to disapprove this voucher setup?","disapproved_vs",[$(this).attr('data-id')])
		})
	})

	function disapproved_vs($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=disapproved_vs",
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

	function approved_vs($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=approved_vs",
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
