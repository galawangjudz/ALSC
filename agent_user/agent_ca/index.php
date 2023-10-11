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
		<a href="<?php echo base_url ?>agent_user/?page=agent_ca" id="ca-link" class="main_menu" onclick="highlightLink('ca-link')"><i class="nav-icon fas fa-hands-helping"></i>&nbsp;&nbsp;&nbsp;Credit Assessments List</a>
		<a href="<?php echo base_url ?>agent_user/?page=agent_fa" class="main_menu" onclick="highlightLink('fa-link')"><i class="nav-icon fas fa-file"></i>&nbsp;&nbsp;&nbsp;CFO Approvals List</a>
	</div>
</div>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h3 class="card-title"><b><i>Credit Assessments List</b></i></h3>
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
                    <th>CA Status</th>
					<?php if ($usertype == "IT Admin" || $usertype == 'CA'): ?>	
                    <th>Actions</th>
					<?php endif; ?>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * FROM t_approval_csr i inner join t_csr_view x on i.c_csr_no = x.c_csr_no where c_csr_status = 1 and c_reserve_status = 1 ORDER BY c_date_approved DESC");
						while($row = $qry->fetch_assoc()):
							$i ++;
                            $ra_id = $row["ra_id"];
                            $status=$row["c_csr_status"];
                            $date_created=$row["c_date_created"];
                            $id=$row["c_csr_no"];
                            $lid = $row["c_lot_lid"];

							$exp_date=new DateTime($row["c_reserved_duration"]);
                            $exp_date_str=$row["c_reserved_duration"];
                            $exp_date_only=date("Y-m-d",strtotime($exp_date_str));
                            //echo $exp_date_only;

                            $today_date=date('Y/m/d H:i:s');
                            $today_date_only=date("Y-m-d",strtotime($today_date));
                            //echo $today_date_only;

                            $exp=strtotime($exp_date_str);
                            $td=strtotime($today_date);
					?>
						<tr>
                            <td class="text-center"><?php echo $row["ra_id"] ?></td>
                            <td class="text-center"><?php echo $row["ref_no"] ?></td>
                            <td class="text-center"><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></td>
                            <td class="text-center"><?php echo $row["last_name"]. ','  .$row["first_name"] .' ' .$row["middle_name"]?></td>


							<?php if ($row['c_ca_status'] == 0): ?>
                                <td><span class="badge badge-warning">Pending</span>
								<span class="badge badge-info"><b id="demo<?php echo $id ?>"></b></span></td>
                            <?php elseif($row['c_ca_status'] == 1): ?>
                                <td><span class="badge badge-success">CA Approved</span></td>
                            <?php elseif ($row['c_ca_status'] == 2): ?>
                                <td><span class="badge badge-danger">Disapproved</span></td>
                            <?php elseif ($row['c_ca_status'] == 3): ?>
                                <td><span class="badge badge-info">For Revision</span></td>
                            <?php else: ?>
                                <td><span class="badge badge-danger"> Lapsed </span></td>
                            <?php endif; ?>
							

							<script>						
								var countDownDate<?php echo $id ?> = new Date("<?php echo $row["c_reserved_duration"]?>").getTime();

								var x<?php echo $id ?> = setInterval(function() {

								var now<?php echo $id ?> = new Date().getTime();

								var distance<?php echo $id ?> = countDownDate<?php echo $id ?> - now<?php echo $id ?>;

								var days<?php echo $id ?> = Math.floor(distance<?php echo $id ?> / (1000 * 60 * 60 * 24));
								var hours<?php echo $id ?> = Math.floor((distance<?php echo $id ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
								var minutes<?php echo $id ?> = Math.floor((distance<?php echo $id ?> % (1000 * 60 * 60)) / (1000 * 60));
								var seconds<?php echo $id ?> = Math.floor((distance<?php echo $id ?> % (1000 * 60)) / 1000);
									
								if (distance<?php echo $id ?> < 0) {
									clearInterval(x<?php echo $id ?>);
									var element = document.getElementById("demo<?php echo $id ?>");
									if (element !== null) {
										element.innerHTML = "Expired";
									}

								}else{
									var element = document.getElementById("demo<?php echo $id ?>");
									if (element !== null) {
										element.innerHTML = " Time Left: " + days<?php echo $id ?>+ "d " + hours<?php echo $id ?> + "h " + minutes<?php echo $id?> + "m " + seconds<?php echo $id ?> + "s ";;
									}
									 

								}
								}, 1000);
							</script>
						<?php 
								
						$exp_date=new DateTime($row["c_reserved_duration"]);
						$exp_date_str=$row["c_reserved_duration"];
						$exp_date_only=date("Y-m-d",strtotime($exp_date_str));
						//echo $exp_date_only;

						$today_date=date('Y/m/d H:i:s');
						$today_date_only=date("Y-m-d",strtotime($today_date));
						//echo $today_date_only;

						$exp=strtotime($exp_date_str);
						$td=strtotime($today_date);		

						if(($td>$exp) && ($row['c_ca_status'] == 0) && ($row['c_reserve_status'] == 1)){
							$update_app = $conn->query("UPDATE t_approval_csr SET c_ca_status = 4 WHERE c_csr_no = '".$id."'");
							$update_lot = $conn->query("UPDATE t_lots SET c_status = 'Available' WHERE c_lid = '".$lid."'");
						} 
						?> 
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>
</div>
<script>
	$('.ca_approval').click(function(){
		uni_modal("<i class='fa fa-check'></i> Approval",'credit_assestment/manage_ca.php?id='+$(this).attr('data-id'),"mid-large")
	})
	$(document).ready(function(){
		$('.table').dataTable(
			{"ordering":false}
		);
	})
</script>