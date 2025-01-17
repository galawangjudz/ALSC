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
</style>
<div class="card card-outline card-primary">
	<div class="card-header">
		<h3 class="card-title"><b><i>Voucher Setup Entries</b></i></h3>
		<div class="card-tools">
			<!-- <button class="btn btn-primary btn-flat" id="create_new" type="button" style="font-size:14px;"><i class="fa fa-pen-square"></i>&nbsp;&nbsp;Add New Voucher Setup</button> -->
			<a href="<?php echo base_url ?>admin/?page=journals/manage_journal" class="btn btn-primary btn-flat" style="font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Add New Voucher Setup</a>
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-hover table-striped table-bordered">
				<colgroup>
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="45%">
					<col width="15%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th>Voucher #</th>
						<th>Date</th>
                        <th>P.O. #</th>
						<th>Supplier Name</th>
                        <th>Preparer</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
                    
					<?php 
					$swhere = "";
					if($_settings->userdata('type') != 1){
						$swhere = " where user_id = '{$_settings->userdata('id')}' ";
					}
					$users = $conn->query("SELECT id,username FROM `users` where id in (SELECT `user_id` FROM `vs_entries` {$swhere})");
					$user_arr = array_column($users->fetch_all(MYSQLI_ASSOC),'username','user_code');
					$journals = $conn->query("SELECT j.*, s.name as sname FROM `vs_entries` j inner join `supplier_list` s on j.supplier_id = s.id {$swhere} order by date(journal_date) asc");
					while($row = $journals->fetch_assoc()):
					?>
					<tr>
                        <td class=""><?= $row['id'] ?></td>
						<td class="text-center"><?= date("M d, Y", strtotime($row['journal_date'])) ?></td>
						<td class=""><?= $row['po_no'] ?></td>
						
                        <td class=""><?= $row['sname'] ?></td>

						
						<td><?= isset($user_arr[$row['user_id']]) ? $user_arr[$row['user_id']] : "N/A" ?></td>
						<td class="text-center">
							<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
								<span class="sr-only">Toggle Dropdown</span>
							</button>
							<div class="dropdown-menu" role="menu">
								<a class="dropdown-item export_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-file-export text-secondary"></span> Export</a>
								<div class="dropdown-divider"></div>
								<a href="<?php echo base_url ?>/report/print_voucher.php?id=<?php echo $row['id'] ?>", target="_blank" class="dropdown-item"><span class="fas fa-print"></span>&nbsp;&nbsp;Print</a>         
								<div class="dropdown-divider"></div>
								<a class="dropdown-item edit_data" href="javascript:void(0)" data-id ="<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"  data-code="<?php echo $row['code'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
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
		// $('#create_new').click(function(){
		// 	uni_modal("Voucher Setup Entry","journals/manage_journal.php",'mid-large')
		// })
		// $('.edit_data').click(function(){
		// 	uni_modal("Edit Voucher Setup Entry","journals/manage_journal.php?id="+$(this).attr('data-id'),"mid-large")
		// })
		$('.export_data').click(function() {
			var dataId = $(this).attr('data-id');
			var redirectUrl = '?page=journals/export_voucher&id=' + dataId;
			window.location.href = redirectUrl;
		})
		$('.edit_data').click(function() {
			var dataId = $(this).attr('data-id');
			var redirectUrl = '?page=journals/manage_journal&id=' + dataId;
			window.location.href = redirectUrl;
		})
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
