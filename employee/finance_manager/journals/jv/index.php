<?php
function format_num($number){
	$decimals = 0;
	$num_ex = explode('.',$number);
	$decimals = isset($num_ex[1]) ? strlen($num_ex[1]) : 0 ;
	return number_format($number,$decimals);
}
?>
<style>
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
	.nav-jv-list{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-jv-list:hover{
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
		<h3 class="card-title"><b><i>Journal Voucher Entries</b></i></h3>
		<div class="card-tools">
			<!-- <button class="btn btn-primary btn-flat" id="create_new" type="button" style="font-size:14px;"><i class="fa fa-pen-square"></i>&nbsp;&nbsp;Add New Voucher Setup</button> -->
			<!-- <a href="<?php echo base_url ?>employee/accounting/?page=journals/manage_journal" class="btn btn-primary btn-flat" style="font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Add New Voucher Setup</a> -->
		</div>
		<br><br>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-hover table-bordered" id="sup-div">
				<colgroup>
					<col width="10%">
					<col width="20%">
					<col width="40%">
					<col width="10%">
					<col width="5%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr>
						<th style="text-align:center;">Voucher #</th>
                        <th style="text-align:center;">Doc No.</th>
						<th style="text-align:center;">Name</th>
                        <th style="text-align:center;">Posting Date</th>
						<th style="text-align:center;">Status</th>
						<th style="text-align:center;">Action</th>
					</tr>
				</thead>
				<tbody>
                    
					<?php 
					
					// $users = $conn->query("SELECT user_code,username FROM `users` where user_code in (SELECT `user_id` FROM `vs_entries`)");
					// $user_arr = array_column($users->fetch_all(MYSQLI_ASSOC),'username','user_code');
					$journals = $conn->query("SELECT DISTINCT jve.c_status, jve.name, jve.jv_num, jvi.doc_no, jve.posting_date FROM jv_entries jve RIGHT JOIN jv_items jvi ON jve.jv_num = jvi.journal_id;
                    ");
					while($row = $journals->fetch_assoc()):
					?>
					<tr>
                        <td class="text-center"><?= $row['jv_num'] ?></td>
                        <td class="text-center"><?= $row['doc_no'] ?></td>
						<td class="text-center"><?= $row['name'] ?></td>
						<td class="text-center"><?= date("M d, Y", strtotime($row['posting_date'])) ?></td>
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
							<button type="button" class="btn btn-flat btn-default btn-sm view_data custom-badge" data-id="<?php echo $row['jv_num'] ?>"
								data-toggle="tooltip" data-placement="top" title="View">
								<span class="fa fa-eye text-primary"></span>
							</button>
							<?php $qry_get_pending = $conn->query("SELECT c_status,jv_num FROM jv_entries WHERE jv_num = '" . $row['jv_num'] . "' and c_status = 0"); ?>
							<?php if ($qry_get_pending->num_rows > 0): ?>
								<button type="button" class="btn btn-flat btn-default btn-sm approved_data custom-badge" data-id="<?php echo $row['jv_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Approve">
									<span class="fa fa-thumbs-up text-success"></span>
								</button>
								<button type="button" class="btn btn-flat btn-default btn-sm disapproved_data custom-badge" data-id="<?php echo $row['jv_num'] ?>"
										data-toggle="tooltip" data-placement="top" title="Disapprove">
									<span class="fa fa-thumbs-down text-danger"></span>
								</button>
								<?php endif; ?>

								<button type="button" class="btn btn-flat btn-default btn-sm edit_data custom-badge" data-id="<?php echo $row['jv_num'] ?>"
									data-toggle="tooltip" data-placement="top" title="Edit">
									<span class="fa fa-edit text-info"></span>
								</button>
								<button type="button" class="btn btn-flat btn-default btn-sm print_data custom-badge" data-id="<?php echo $row['jv_num'] ?>"
									onclick="window.open('<?php echo base_url ?>/report/voucher_report/print_journal_voucher.php?id=<?php echo $row['jv_num'] ?>', '_blank')"
									data-toggle="tooltip" data-placement="top" title="Print">
								<span class="fas fa-print"></span>
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

<script>

	$(document).ready(function(){
		
        $('[data-toggle="tooltip"]').tooltip();

		$('.edit_data').click(function() {
			var dataId = $(this).attr('data-id');
			var redirectUrl = '?page=journals/jv/manage_jv&id=' + dataId;
			window.location.href = redirectUrl;
		})

		$('.view_data').click(function() {
			var dataId = $(this).attr('data-id');
			var redirectUrl = '?page=journals/jv/jv_view&id=' + dataId;
			window.location.href = redirectUrl;
		})
		
		$('.approved_data').click(function(){
			_conf("Are you sure you want to approve this journal voucher?","approved_jv",[$(this).attr('data-id')])
		})

		$('.disapproved_data').click(function(){
			_conf("Are you sure you want to disapprove this journal voucher permanently?","disapproved_jv",[$(this).attr('data-id')])
		})

		$('.table td,.table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: [2,4] }
            ],
        });
	})
	function approved_jv($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=approved_jv",
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
	function disapproved_jv($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=disapproved_jv",
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
