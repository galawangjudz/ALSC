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
	.main_menu{
		float:left;
		width:227px;
		height:40px;
		line-height:40px;
		text-align:center;
		color:black!important;
		border-right:solid 3px white;
	}
	.main_menu:hover{
		border-bottom: solid 2px blue;
		background-color:#E8E8E8;
	}
	#container{
		margin-right:auto;
		margin-left:auto;
		width:100%;
		position:relative;
		padding-left:50px;
		padding-right:50px;
		background-color:transparent;
	}
	#ca-link{
		border-bottom: solid 2px blue;
		background-color:#E8E8E8;
	}
	.dropdown:hover .dropdown-menu {
		display: block;
		margin-top:40px;
		float:left;
		width:227px;
		height:130px;
		line-height:30px;
		text-align:center;
		color:black!important;
	}
	.dropdown-menu li a{
		color:black!important;
		border:gainsboro 1px solid;
		display: block;
		height:40px;
		line-height:40px;
	}
	.dropdown-menu li a:hover{
		color:black!important;
		border:gainsboro 1px solid;
		display: block;
		height:40px;
		line-height:40px;
		background-color:#E8E8E8;
	}
	#res-link1{
		color: currentColor;
		cursor: not-allowed;
		opacity: 0.5;
		text-decoration: none;
		pointer-events: none;
	}
	.table-container {
  		overflow-x: auto;
  		max-width: 100%;
	}
	table {
		table-layout: fixed;
		width: 100%;
	}
</style>
<div class="card" id="container" style="display: flex; justify-content: center;">
    <div class="navbar-menu" style="width:100%; margin-left: auto; margin-right: auto; max-width: 1200px;">
		<div class="dropdown">
			<a href="#" class="main_menu dropdown-toggle" id="ra-link" style="border-left:solid 3px white;" onclick="highlightLink('ralink')"><i class="nav-icon fas fa-list"></i>&nbsp;&nbsp;&nbsp;RAs List</a>
				<ul class="dropdown-menu" style="border-radius:0px;height:122px;">
					<li><a href="<?php echo base_url ?>admin/?page=sales" style="margin-top:-8px;"><i class="nav-icon fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Pendings</a></li>
					<li><a href="<?php echo base_url ?>admin/?page=revision"><i class="nav-icon fa fa-pen"></i>&nbsp;&nbsp;&nbsp;Revisions</a></li>
					<li><a href="<?php echo base_url ?>admin/?page=ra"><i class="nav-icon fas fa-thumbs-up"></i>&nbsp;&nbsp;&nbsp;Approved</a></li>
				</ul>
		</div>
		<?php if ($usertype == "IT Admin" || $usertype == 'Cashier'){ ?>
		<a href="<?php echo base_url ?>admin/?page=reservation" class="main_menu" id="res-link" onclick="highlightLink('res-link')"><i class="nav-icon fas fa-calendar"></i>&nbsp;&nbsp;&nbsp;Reservations List</a>
		
		<?php }else{ ?>
		<a href="<?php echo base_url ?>admin/?page=reservation" class="main_menu" id="res-link1" onclick="highlightLink('res-link')"><i class="nav-icon fas fa-calendar"></i>&nbsp;&nbsp;&nbsp;Reservations List</a>
		<?php } ?>
		
		<a href="<?php echo base_url ?>admin/?page=credit_assestment" class="main_menu" id="ca-link" onclick="highlightLink('ca-link')"><i class="nav-icon fas fa-hands-helping"></i>&nbsp;&nbsp;&nbsp;Credit Assessments List</a>
		<a href="<?php echo base_url ?>admin/?page=final_approval" class="main_menu" id="fa-link" onclick="highlightLink('fa-link')"><i class="nav-icon fas fa-file"></i>&nbsp;&nbsp;&nbsp;CFO Approvals List</a>
		<!-- <a href="<?php echo base_url ?>admin/?page=clients/property_list" class="main_menu" id="pl-link" onclick="highlightLink('pl-link')"><i class="nav-icon fas fa-home"></i>&nbsp;&nbsp;&nbsp;Property Accounts</a> -->
		<div class="dropdown" style="position: relative;">
			<a href="#" class="main_menu dropdown-toggle" onclick="highlightLink('ralink')"><i class="nav-icon fas fa-home"></i>&nbsp;&nbsp;&nbsp;Property Accounts</a>
				<ul class="dropdown-menu" style="position: absolute; right: 0; transform: translateX(400%);height:122px;border-radius:0px;">
					<li><a href="<?php echo base_url ?>admin/?page=clients/property_list" style="margin-top:-8px;"><i class="nav-icon fas fa-check-circle"></i>&nbsp;&nbsp;&nbsp;Active Accounts</a></li>
					<li><a href="<?php echo base_url ?>admin/?page=transfer"><i class="fa fa-retweet" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Reopen Accounts</a></li>
					<li><a href="<?php echo base_url ?>admin/?page=backout"><i class="fa fa-archive" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Backouts</a></li>
				</ul>
		</div>
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
								// Set the date we're counting down to
								var countDownDate<?php echo $id ?> = new Date("<?php echo $row["c_reserved_duration"]?>").getTime();

								// Update the count down every 1 second
								var x<?php echo $id ?> = setInterval(function() {

								// Get today's date and time
								var now<?php echo $id ?> = new Date().getTime();

								// Find the distance between now and the count down date
								var distance<?php echo $id ?> = countDownDate<?php echo $id ?> - now<?php echo $id ?>;

								// Time calculations for hours, minutes and seconds
								var days<?php echo $id ?> = Math.floor(distance<?php echo $id ?> / (1000 * 60 * 60 * 24));
								var hours<?php echo $id ?> = Math.floor((distance<?php echo $id ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
								var minutes<?php echo $id ?> = Math.floor((distance<?php echo $id ?> % (1000 * 60 * 60)) / (1000 * 60));
								var seconds<?php echo $id ?> = Math.floor((distance<?php echo $id ?> % (1000 * 60)) / 1000);
									

								// Display the result in the element with id="demo"
								//document.getElementById("demo<?php echo $id ?>").innerHTML = " Time Left: " + days<?php echo $id ?>+ "d " + hours<?php echo $id ?> + "h " + minutes<?php echo $id?> + "m " + seconds<?php echo $id ?> + "s ";

								// If the count down is finished, write some text
								if (distance<?php echo $id ?> < 0) {
									clearInterval(x<?php echo $id ?>);
									//document.getElementById("demo<?php echo $id ?>").innerHTML = " Expired";
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
							<?php if ($usertype == "IT Admin" || $usertype == 'CA'): ?>	
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item view_data" href="./?page=credit_assestment/ca-view&id=<?php echo md5($row['c_csr_no']) ?>"><span class="fa fa-eye text-primary"></span>&nbsp;&nbsp;Evaluation</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item ca_approval" data-id="<?php echo md5($row['c_csr_no']) ?>"><span class="fa fa-check text-success"></span>&nbsp;&nbsp;CA Approval</a>
								  </div>
							</td>
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
	$('.ca_approval').click(function(){
		/* uni_modal('CA Approval','manage_ca.php?id='+$(this).attr('data-id')) */
		uni_modal("<i class='fa fa-check'></i> Approval",'credit_assestment/manage_ca.php?id='+$(this).attr('data-id'),"mid-large")

	})

	$(document).ready(function(){
		
		$('.table').dataTable(
			{"ordering":false}
		);
		
	})

</script>