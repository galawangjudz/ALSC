<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
	.nav-cl{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-cl:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
</style>
<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title"><b><i>Check List</b></i></h5>
		</div>
		<div class="card-body">
            <div class="container-fluid">
            <div class="container-fluid">
                	<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
						<!-- <colgroup>
							<col width="5%">
							<col width="20%">
							<col width="20%">
							<col width="25%">
							<col width="15%">
						</colgroup> -->
						<thead>
							<tr>
							<th>#</th>
							<th>CV #</th>
							<th>Voucher #</th>
							<th>ID/Code</th>
							<th>Check Date</th> 
                            <th>Check #</th> 
                            <th>Check Name</th> 
                            <th>Status</th> 
                            <th>Date Claimed</th> 
                            <th>Action</th> 
							</tr>
						</thead>
						<tbody>
                            <?php 
                                $i = 1;

                                $qry = $conn->query("SELECT a.c_num, a.v_num, a.supplier_id, a.check_date,c.check_num,c.check_name,c.c_status,c.date_updated FROM check_details c INNER JOIN cv_entries a ON c.c_num = a.c_num ORDER BY c.date_updated DESC;");

                                while ($row = $qry->fetch_assoc()):
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++; ?></td>
                                    <td class=""><?php echo $row['c_num'] ?></td>
                                    <td class=""><?php echo $row['v_num'] ?></td>
                                    <td class=""><?php echo $row['supplier_id'] ?></td>
                                    <td class=""><?php echo $row['check_date'] ?></td>
                                    <td class=""><?php echo $row['check_num'] ?></td>
                                    <td class=""><?php echo $row['check_name'] ?></td>
                                    <td class="">
                                        <?php 
                                            switch($row['c_status']){
                                                case 0:
                                                    echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Unclaimed</span>';
                                                    break;
                                                case 1:
                                                    echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Claimed</span>';
                                                    break;
                                                default:
                                                    echo '<span class="badge badge-default border px-3 rounded-pill">N/A</span>';
                                                    break;
                                            }
                                        ?>
                                    </td>
                                    <td class="">
                                        <?php 
                                            echo ($row['c_status'] == 0) ? '-' : date('Y-m-d H:i:s', strtotime($row['date_updated']));
                                        ?>
                                    </td>
                                    <td class="text-center">
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
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                   </table>
	            </div>                
            </div>
	</div>
<script>
    $('.claim_data').click(function(){
        _conf("Are you sure you want to update this check voucher details?","claim_cv",[$(this).attr('data-id')])
    })
    $('.unclaim_data').click(function(){
        _conf("Are you sure you want to update this check voucher details?","unclaimed_cv",[$(this).attr('data-id')])
    })
    $(document).ready(function(){
		$('.table').dataTable();
	})
	$('.table td, .table th').addClass('py-1 px-2 align-middle')
	$('.table').dataTable({
		columnDefs: [
			{ orderable: false, targets: 5 }
		],
	});
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
</script>