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
	#sup-div_wrapper .dataTables_length,
	#agent-div_wrapper .dataTables_length,
	#emp-div_wrapper .dataTables_length {
		display: none;
	}
	#sup-div_wrapper .dataTables_info,
	#agent-div_wrapper .dataTables_info,
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
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><b><i>Check Voucher Setup Entries</b></i></h3>
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
			</div>
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered" id="sup-div">
				<colgroup>
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="45%">
					<!-- <col width="15%"> -->
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>CV #</th>
						<th>Date</th>
                        <th>P.O. #</th>
						<th>Supplier Name</th>
                        <!-- <th>Preparer</th> -->
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    
					<?php 
					
					// $users = $conn->query("SELECT user_code,username FROM `users` where user_code in (SELECT `user_id` FROM `vs_entries`)");
					// $user_arr = array_column($users->fetch_all(MYSQLI_ASSOC),'username','user_code');
					$journals = $conn->query("SELECT j.*, s.name as sname FROM `cv_entries` j inner join `supplier_list` s on j.supplier_id = s.id order by date(cv_date) asc");
					while($row = $journals->fetch_assoc()):
					?>
					<tr>
                        <td class=""><?= $row['c_num'] ?></td>
						<td class="text-center"><?= date("M d, Y", strtotime($row['cv_date'])) ?></td>
						<td class=""><?= $row['po_no'] ?></td>
						
                        <td class=""><?= $row['sname'] ?></td>

						
						<!-- <td><?= isset($user_arr[$row['user_id']]) ? $user_arr[$row['user_id']] : "N/A" ?></td> -->
						<td class="text-center">
							<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu" role="menu">
								<a href="<?php echo base_url ?>/report/print_check_voucher.php?id=<?php echo $row['c_num'] ?>", target="_blank" class="dropdown-item"><span class="fas fa-print"></span>&nbsp;&nbsp;Print</a>         
								<div class="dropdown-divider"></div>
								<a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['c_num'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>"  data-code="<?php echo $row['code'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
							</div>
						</td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

			<table class="table table-hover table-striped table-bordered" id="agent-div">
				<colgroup>
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="45%">
					<!-- <col width="15%"> -->
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>CV #</th>
						<th>Date</th>
                        <th>P.O. #</th>
						<th>Agent Name</th>
                        <!-- <th>Preparer</th> -->
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    
					<?php 
					
					// $users = $conn->query("SELECT user_code,username FROM `users` where user_code in (SELECT `user_id` FROM `vs_entries`)");
					// $user_arr = array_column($users->fetch_all(MYSQLI_ASSOC),'username','user_code');
					$journals = $conn->query("SELECT j.*, s.* FROM `cv_entries` j inner join `t_agents` s on j.supplier_id = s.c_code order by date(cv_date) asc");
					while($row = $journals->fetch_assoc()):
					?>
					<tr>
                        <td class=""><?= $row['c_num'] ?></td>
						<td class="text-center"><?= date("M d, Y", strtotime($row['cv_date'])) ?></td>
						<td class=""><?= $row['po_no'] ?></td>
						
                        <td class=""><?= $row['c_last_name'] ?>, <?= $row['c_first_name'] ?> <?= $row['c_middle_initial'] ?></td>

						
						<!-- <td><?= isset($user_arr[$row['user_id']]) ? $user_arr[$row['user_id']] : "N/A" ?></td> -->
						<td class="text-center">
							<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu" role="menu">
								<a href="<?php echo base_url ?>/report/print_check_voucher.php?id=<?php echo $row['c_num'] ?>", target="_blank" class="dropdown-item"><span class="fas fa-print"></span>&nbsp;&nbsp;Print</a>         
								<div class="dropdown-divider"></div>
								<a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['c_num'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>"  data-code="<?php echo $row['code'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
							</div>
						</td>
					</tr>
					<?php endwhile; ?>
				</tbody>
			</table>

			<table class="table table-hover table-striped table-bordered" id="emp-div">
				<colgroup>
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="45%">
					<!-- <col width="15%"> -->
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>CV #</th>
						<th>Date</th>
                        <th>P.O. #</th>
						<th>Employee Name</th>
                        <!-- <th>Preparer</th> -->
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    
					<?php 
					
					//$users = $conn->query("SELECT user_code,username FROM `users` where user_code in (SELECT `user_id` FROM `vs_entries`)");
					//$user_arr = array_column($users->fetch_all(MYSQLI_ASSOC),'username','user_code');
					$journals = $conn->query("SELECT j.*, s.* FROM `cv_entries` j inner join `users` s on j.supplier_id = s.user_id order by date(cv_date) asc");
					while($row = $journals->fetch_assoc()):
					?>
					<tr>
                        <td class=""><?= $row['c_num'] ?></td>
						<td class="text-center"><?= date("M d, Y", strtotime($row['cv_date'])) ?></td>
						<td class=""><?= $row['po_no'] ?></td>
						
                        <td class=""><?= $row['lastname'] ?>, <?= $row['firstname'] ?></td>

						
						<!-- <td><?= isset($user_arr[$row['user_id']]) ? $user_arr[$row['user_id']] : "N/A" ?></td> -->
						<td class="text-center">
							<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu" role="menu">
								<a href="<?php echo base_url ?>/report/print_check_voucher.php?id=<?php echo $row['c_num'] ?>", target="_blank" class="dropdown-item"><span class="fas fa-print"></span>&nbsp;&nbsp;Print</a>         
								<div class="dropdown-divider"></div>
								<a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['c_num'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['c_num'] ?>"  data-code="<?php echo $row['code'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
							</div>
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

        $("#emp-div, #agent-div, #sup-div").hide();
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
		$('.edit_data').click(function() {
			var dataId = $(this).attr('data-id');
			var redirectUrl = '?page=cv/manage_check_voucher&id=' + dataId;
			window.location.href = redirectUrl;
		})
		$('.delete_data').click(function(){
			_conf("Are you sure you want to delete this voucher setup entry permanently?","delete_cv",[$(this).attr('data-id')])
		})
		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: [2,4] }
            ],
        });
	})
	function delete_cv($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_cv",
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
                var nw = window.open("/cv/print_check_voucher.php?id="+resp.id,"_blank","width=700,height=500")
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
