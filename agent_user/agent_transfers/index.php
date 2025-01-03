<style>
	.nav-ra{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
	}
	.nav-ra:hover{
		background-color:#007bff!important;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
</style>
<div class="card" id="container" style="display: flex; justify-content: center;">
    <div class="navbar-menu" style="width:100%; margin-left: auto; margin-right: auto; max-width: 1200px;">
		<div class="dropdown">
			<a href="#" class="main_menu dropdown-toggle" style="border-left:solid 3px white;" onclick="highlightLink('ralink')"><i class="nav-icon fas fa-list"></i>&nbsp;&nbsp;&nbsp;RAs List</a>
				<ul class="dropdown-menu" style="border-radius:0px;height:122px;">
					<li><a href="<?php echo base_url ?>agent_user/?page=agent_sales" style="margin-top:-8px;"><i class="nav-icon fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Pendings</a></li>
					<li><a href="<?php echo base_url ?>agent_user/?page=agent_revisions"><i class="nav-icon fa fa-pen"></i>&nbsp;&nbsp;&nbsp;Revisions</a></li>
					<li><a href="<?php echo base_url ?>agent_user/?page=agent_ra"><i class="nav-icon fas fa-thumbs-up"></i>&nbsp;&nbsp;&nbsp;Approved</a></li>
				</ul>
		</div>
		<a href="<?php echo base_url ?>agent_user/?page=agent_ca" class="main_menu" onclick="highlightLink('ca-link')"><i class="nav-icon fas fa-hands-helping"></i>&nbsp;&nbsp;&nbsp;Credit Assessments List</a>
		<a href="<?php echo base_url ?>agent_user/?page=agent_fa" class="main_menu" onclick="highlightLink('fa-link')"><i class="nav-icon fas fa-file"></i>&nbsp;&nbsp;&nbsp;CFO Approvals List</a>
		<div class="dropdown" style="position: relative;">
			<a href="#" class="main_menu dropdown-toggle" id="ra-link" onclick="highlightLink('ralink')"><i class="nav-icon fas fa-home"></i>&nbsp;&nbsp;&nbsp;Property Accounts</a>
				<ul class="dropdown-menu" style="position: absolute; right: 0; transform: translateX(300%);height:122px;border-radius:0px;">
					<li><a href="<?php echo base_url ?>agent_user/?page=agent_clients/properties_list" style="margin-top:-8px;"><i class="nav-icon fas fa-check-circle"></i>&nbsp;&nbsp;&nbsp;Active Acounts</a></li>
					<li><a href="<?php echo base_url ?>agent_user/?page=agent_transfers" style="background-color:#E8E8E8;"><i class="fa fa-retweet" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Reopen Accounts</a></li>
					<li><a href="<?php echo base_url ?>agent_user/?page=agent_backouts"><i class="fa fa-archive" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Backouts</a></li>
				</ul>
		</div>
	</div>
</div>
<div class="card card-outline card-primary rounded-0">
	<div class="card-header">
		<h3 class="card-title"><b><i>List of Reopen Accounts</b></i></h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
		<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
            <thead>
                <tr class="bg-gradient-primary text-light">
                    <th>Property ID</th>
                    <th>Location</th>
                    <th>Net TCP</th>
                    <th>Account Status</th>
                    <th>Type</th>
                </tr>
            </thead>
            <tbody>
					<?php 
						$i = 1;
						$qry = $conn->query("SELECT p.*, r.c_acronym, l.c_block, l.c_lot FROM properties p LEFT JOIN t_lots l on l.c_lid = p.c_lot_lid LEFT JOIN t_projects r ON l.c_site = r.c_code where c_reopen = 1 and c_active = 1");
						while($row = $qry->fetch_assoc()):
					?>
						<tr>
							<td align="center">
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
								<a class="dropdown-item create_new" href="./?page=transfer/create&id=<?php echo md5($row['c_csr_no']) ?>&prop_id=<?php echo $row['property_id']?>" ><span class="fa fa-eye text-dark"></span> Create</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['property_id'] ?>"  data-csr="<?php echo $row["c_csr_no"] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
								</div>
							</td>
							<?php 
							$property_id = $row["property_id"];
							$property_id_part1 = substr($property_id, 0, 2);
							$property_id_part2 = substr($property_id, 2, 8);
							$property_id_part3 = substr($property_id, 10, 3);
							?>
							<td><?php echo $property_id_part1 . "-" . $property_id_part2 . "-" . $property_id_part3 ?></td>
							<td class=""><p class="m-0 truncate-1"><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></p></td>
							<td><?php echo number_format($row["c_net_tcp"],2) ?></td>
							<td><?php echo $row["c_account_status"] ?></td>
								<td class="text-center">
								<?php 
                                switch($row['c_reopen']){
                                    case 0:
                                        echo '<span class="badge badge-danger bg-gradient-primary">Active</span>';
                                        break;
                                    case 1:
                                        echo '<span class="badge badge-primary bg-gradient-danger">Reopen</span>';
                                        break;
                                    default:
                                        echo '<span class="badge badge-default">N/A</span>';
                                        break;
                                }
								?>
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
        $('.create_new').click(function(){
			uni_modal("Update Account Details","transfer/create.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.delete_data').click(function(){
			_conf("Are you sure to Backout '<b>"+$(this).attr('data-id')+"</b>' from Reopen List permanently?","backout_acc",[$(this).attr('data-id'),$(this).attr('data-csr')])
		})
		$('.view_data').click(function(){
			uni_modal("Account Details","backout/view_backout.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.table td, .table th').addClass('py-1 px-2 align-middle')
		$('.table').dataTable({
            columnDefs: [
                { orderable: false, targets: 5 }
            ],
        });
	})
    function backout_acc($prop_id,$csr_no){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=backout_acc",
            method:"POST",
            data:{prop_id: $prop_id, csr_no: $csr_no},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("Can't Backout!",'error');
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