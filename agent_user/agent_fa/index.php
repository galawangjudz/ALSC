<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

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
	<div class="navbar-menu" style="width: 100%; display: flex; justify-content: center; max-width: 1200px; margin: 0 auto;">
		<div class="dropdown">
			<a href="#" class="main_menu dropdown-toggle" style="border-left: solid 3px white;" onclick="highlightLink('ralink')"><i class="nav-icon fas fa-list"></i>&nbsp;&nbsp;&nbsp;RAs List</a>
			<ul class="dropdown-menu" style="border-radius: 0px; height: 122px; margin: 2px; padding-top:2px;"> 
				<li><a href="<?php echo base_url ?>agent_user/?page=agent_sales" style="margin-top: -8px;"><i class="nav-icon fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Pendings</a></li>
				<li><a href="<?php echo base_url ?>agent_user/?page=agent_revisions"><i class="nav-icon fa fa-pen"></i>&nbsp;&nbsp;&nbsp;Revisions</a></li>
				<li><a href="<?php echo base_url ?>agent_user/?page=agent_ra"><i class="nav-icon fas fa-thumbs-up"></i>&nbsp;&nbsp;&nbsp;Approved</a></li>
			</ul>
		</div>
		<a href="<?php echo base_url ?>agent_user/?page=agent_ca" class="main_menu" onclick="highlightLink('ca-link')"><i class="nav-icon fas fa-hands-helping"></i>&nbsp;&nbsp;&nbsp;Credit Assessments List</a>
		<a href="<?php echo base_url ?>agent_user/?page=agent_fa"  id="fa-link" class="main_menu" onclick="highlightLink('fa-link')"><i class="nav-icon fas fa-file"></i>&nbsp;&nbsp;&nbsp;CFO Approvals List</a>
	</div>
</div>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h3 class="card-title"><b><i>CFO Approvals List</b></i></h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped" style="width:100%;text-align:center;">
				<thead>
					<tr>
                    <th>RA No.</th>
					<th>Ref. No.</th>
                    <th>Location </th>
                    <th>Buyer Name </th>
                    <th>CFO Status</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * FROM t_approval_csr i inner join t_csr_view x on i.c_csr_no = x.c_csr_no where c_ca_status = 1 ORDER BY c_date_approved DESC");
						while($row = $qry->fetch_assoc()):
							$i ++;
                            $ra_id = $row["ra_id"];
                            $status=$row["c_csr_status"];
                            $date_created=$row["c_date_created"];
                            $id=$row["c_csr_no"];
                            $lid = $row["c_lot_lid"];
							$csr_no = $row['c_csr_no'];
					?>
						<tr>
                            <td class="text-center"><?php echo $row["ra_id"] ?></td>
                            <td class="text-center"><?php echo $row["ref_no"] ?></td>
                            <td class="text-center"><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></td>
                            <td class="text-center"><?php echo $row["last_name"]. ','  .$row["first_name"] .' ' .$row["middle_name"]?></td>
							<?php if ($row['cfo_status'] == 0): ?>
                                <td><span class="badge badge-warning">Pending</span>
                            <?php elseif($row['cfo_status'] == 1): ?>
                                <td><span class="badge badge-success">Booked</span></td>
                            <?php endif; ?>
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
		
		$('.table').dataTable(
			{"ordering":false}
		);
	})
    $(document).ready(function(){
        $('.booked_data').click(function(){
            uni_modal_right("<i class='fa fa-check'></i> Final Approval",'final_approval/fa-view.php?id='+$(this).attr('csr_no')+"&csr="+$(this).attr('ra_id')+"&lid="+$(this).attr('data-lot-id'),"mid-large")
        })
    })
</script>