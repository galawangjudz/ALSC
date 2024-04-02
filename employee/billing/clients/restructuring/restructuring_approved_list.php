

<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php
	$usertype = $_settings->userdata('user_type');
?>

<style>
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
	#approved-link{
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
    #uni_modal_2{
        width:150%;
        height:100%;
        margin:auto;
		margin-left:-25%;
		margin-right:auto;
    } 
    .nav-res {
    background-color: #007bff;
    color: white !important;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-res:hover {
        background-color: #007bff !important;
    }
    #view_tooltip:hover span {
    opacity:1;
    width: auto;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding:5px;
    transition: opacity 0.5s ease;
}

</style>
<div class="card" id="container" style="display: flex; justify-content: center;">
    <div class="navbar-menu" style="max-width: 1200px; margin: 0 auto;">
        <a href="<?php echo base_url ?>admin/?page=clients/restructuring/restructuring_list" class="main_menu" style="border-left: solid 3px white;" onclick="highlightLink('res-link')">
			<i class="fa fa-clock" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Pending List
        </a>
        <a href="<?php echo base_url ?>admin/?page=clients/restructuring/restructuring_approved_list" id="approved-link" class="main_menu">
			<i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Approved List
		</a>
        <a href="<?php echo base_url ?>admin/?page=clients/restructuring/restructuring_disapproved_list" class="main_menu">
			<i class="fa fa-thumbs-down" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Disapproved List
        </a>
    </div>
</div>

<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h3 class="card-title"><b><i>Restructuring List</b></i></h3>
		</div>
		<div class="card-body">
            <div class="container-fluid">
			<div class="table-responsive">
                <table class="table table-bordered table-stripped" style="text-align:center;font-size:14px;">
                    <thead>
                        <tr>
						<th>Restructured No.</th>
						<th>Property ID</th>
						<th>Last Name</th>
						<th>First Name</th>
						<th>Middle Name</th>
                        <!-- <th>Payment Amt.</th>
                        <th>Pay Date</th>
						<th>Due Date</th>
                        <th>OR No.</th>
                        <th>Amt Due</th>
						<th>Rebate</th>
						<th>Surcharge</th>
                        <th>Interest</th>
                        <th>Principal</th>
                        <th>Rem Bal</th> -->
                        <th>Billing Status</th>
                        <th>FM Status</th>
                        <th>CFO Status</th>
                        <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php                         
					$i = 1;
					if($usertype=='Billing')
					{
						/* $qry = $conn->query("SELECT z.last_name, z.first_name, z.middle_name,y.property_id, y.payment_amount, y.pay_date, y.due_date, y.or_no,
						y.amount_due, y.rebate, y.surcharge, y.interest, y.principal,
						y.remaining_balance, y.payment_count,
						y.lvl3, y.lvl1, y.lvl2 FROM property_payments y INNER JOIN property_clients z ON y.property_id = z.property_id WHERE y.lvl1=1
						GROUP BY y.property_id;"); */



						$qry = $conn->query("SELECT  y.id , z.last_name, z.first_name, z.middle_name,y.property_id, y.pending_status,
						y.lvl3, y.lvl1, y.lvl2 FROM pending_restructuring y INNER JOIN property_clients z ON y.property_id = z.property_id WHERE y.lvl1=1
						");
                            while($row = $qry->fetch_assoc()):   
								  
                        ?>
                        <tr>
						<td><?php echo $row["id"]; ?> </a></td>
						<td><?php echo $row["property_id"] ?></a></td>
						<?php $prop_id = $row["property_id"]; ?>
						<?php $cid = $row["id"]; ?>
						<td><?php echo $row["last_name"] ?></a></td>
						<td><?php echo $row["first_name"] ?></a></td>
						<td><?php echo $row["middle_name"] ?></a></td>
                        <!-- <td><?php echo number_format($row["payment_amount"],2) ?></td>
                        <td><?php echo $row["pay_date"] ?></td>
						<td><?php echo $row["due_date"] ?></td>
						<td><?php echo $row["or_no"] ?></td>
                        <td><?php echo number_format($row["amount_due"],2) ?></td>
                        <td><?php echo number_format($row["rebate"],2) ?></td>
						<td><?php echo number_format($row["surcharge"],2) ?></td>
                        <td><?php echo number_format($row["interest"],2) ?></td>
                        <td><?php echo number_format($row["principal"],2) ?></td>
                        <td><?php echo number_format($row["remaining_balance"],2) ?></td> -->

                        <?php if($row['lvl1'] == 0): ?>
							<td><span class="badge badge-warning">Pending</span></td>
						<?php elseif ($row['lvl1'] == 1): ?>
							<td><span class="badge badge-success">Approved </span></td>
						<?php elseif ($row['lvl1'] == 2): ?>
							<td><span class="badge badge-danger">Disapproved </span></td>
						<?php endif; ?>

                        <?php if($row['lvl2'] == 0): ?>
							<td><span class="badge badge-warning">Pending</span></td>
						<?php elseif ($row['lvl2'] == 1): ?>
							<td><span class="badge badge-success">Approved </span></td>
						<?php elseif ($row['lvl2'] == 2): ?>
							<td><span class="badge badge-danger">Disapproved </span></td>
						<?php endif; ?>

                        <?php if($row['lvl3'] == 0): ?>
							<td><span class="badge badge-warning">Pending</span></td>
						<?php elseif ($row['lvl3'] == 1): ?>
							<td><span class="badge badge-success">Approved </span></td>
						<?php elseif ($row['lvl3'] == 2): ?>
							<td><span class="badge badge-danger">Disapproved </span></td>
						<?php endif; ?>

                        <td>
							<a class="btn btn-flat btn-success btn-s view_res" style="font-size: 12px; height: 30px; width: 37px;" cid="<?php echo $cid ?>" data-id="<?php echo md5($row['property_id']) ?>" id="view_tooltip">
									<i class="fa fa-eye" aria-hidden="true"></i>
									<span class="tooltip">View</span>
							</a>
							<!-- <?php
							?>
							<?php 
								if($usertype=="Billing"):
									echo '<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['property_id'] . '" value="4" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
									echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
									echo '<span class="tooltip">Approved</span>';
									echo '</a>';
								elseif($usertype=="Manager"):
									echo '<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['property_id'] . '" value="3" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
									echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
									echo '<span class="tooltip">Approved</span>';
									echo '</a>';
								elseif($usertype=="CHIEF FINANCE OFFICER"):
									echo '<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['property_id'] . '" value="2" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
									echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
									echo '<span class="tooltip">Approved</span>';
									echo '</a>';
								elseif($usertype=="IT Admin"):
									echo '<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['property_id'] . '" value="1" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
									echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
									echo '<span class="tooltip">Approved</span>';
									echo '</a>';
								endif;
							?>
							<?php 
							if($usertype=="Billing"):
                            	echo '<a class="btn btn-flat btn-danger btn-s disapproved_res" style="font-size: 12px; height: 30px; width: 37px;" data-id="' . $row['property_id'] . '" value="4" id="view_tooltip">';
                                echo '<i class="fa fa-thumbs-down" aria-hidden="true"></i>';
                                echo '<span class="tooltip">Disapproved</span>';
                            	echo '</a>';
							elseif($usertype=="Manager"):	
								echo '<a class="btn btn-flat btn-danger btn-s disapproved_res" style="font-size: 12px; height: 30px; width: 37px;" data-id="' . $row['property_id'] . '" value="3" id="view_tooltip">';
                                echo '<i class="fa fa-thumbs-down" aria-hidden="true"></i>';
                                echo '<span class="tooltip">Disapproved</span>';
                            	echo '</a>';
							elseif($usertype=="CHIEF FINANCE OFFICER"):	
								echo '<a class="btn btn-flat btn-danger btn-s disapproved_res" style="font-size: 12px; height: 30px; width: 37px;" data-id="' . $row['property_id'] . '" value="2" id="view_tooltip">';
                                echo '<i class="fa fa-thumbs-down" aria-hidden="true"></i>';
                                echo '<span class="tooltip">Disapproved</span>';
                            	echo '</a>';
							elseif($usertype=="IT Admin"):
								echo '<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['property_id'] . '" value="1" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
								echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
								echo '<span class="tooltip">Approved</span>';
								echo '</a>';
							endif;
							?> -->
                        	</td>
                        </tr>
                    <?php endwhile; ?>
					<?php                         
					}
					elseif($usertype=='Manager')
					{
						/* $qry = $conn->query("SELECT z.last_name, z.first_name, z.middle_name,y.property_id, y.payment_amount, y.pay_date, y.due_date, y.or_no,
						y.amount_due, y.rebate, y.surcharge, y.interest, y.principal,
						y.remaining_balance, y.payment_count,
						y.lvl3, y.lvl1, y.lvl2 FROM property_payments y INNER JOIN property_clients z ON y.property_id = z.property_id WHERE y.lvl1=1 and y.lvl2=1
						GROUP BY y.property_id;");
						 */

						
						$qry = $conn->query("SELECT  y.id , z.last_name, z.first_name, z.middle_name,y.property_id, y.pending_status,
						y.lvl3, y.lvl1, y.lvl2 FROM pending_restructuring y INNER JOIN property_clients z ON y.property_id = z.property_id WHERE y.lvl1=1 and y.lvl2=1
						");
								while($row = $qry->fetch_assoc()):   
									  
							?>
							<tr>
							<td><?php echo $row["id"]; ?> </a></td>
							<td><?php echo $row["property_id"] ?></a></td>
							<?php $prop_id = $row["property_id"]; ?>
							<?php $cid = $row["id"]; ?>
							<td><?php echo $row["last_name"] ?></a></td>
							<td><?php echo $row["first_name"] ?></a></td>
							<td><?php echo $row["middle_name"] ?></a></td>
							<!-- <td><?php echo number_format($row["payment_amount"],2) ?></td>
							<td><?php echo $row["pay_date"] ?></td>
							<td><?php echo $row["due_date"] ?></td>
							<td><?php echo $row["or_no"] ?></td>
							<td><?php echo number_format($row["amount_due"],2) ?></td>
							<td><?php echo number_format($row["rebate"],2) ?></td>
							<td><?php echo number_format($row["surcharge"],2) ?></td>
							<td><?php echo number_format($row["interest"],2) ?></td>
							<td><?php echo number_format($row["principal"],2) ?></td>
							<td><?php echo number_format($row["remaining_balance"],2) ?></td> -->
	
							<?php if($row['lvl1'] == 0): ?>
								<td><span class="badge badge-warning">Pending</span></td>
							<?php elseif ($row['lvl1'] == 1): ?>
								<td><span class="badge badge-success">Approved </span></td>
							<?php elseif ($row['lvl1'] == 2): ?>
								<td><span class="badge badge-danger">Disapproved </span></td>
							<?php endif; ?>
	
							<?php if($row['lvl2'] == 0): ?>
								<td><span class="badge badge-warning">Pending</span></td>
							<?php elseif ($row['lvl2'] == 1): ?>
								<td><span class="badge badge-success">Approved </span></td>
							<?php elseif ($row['lvl2'] == 2): ?>
								<td><span class="badge badge-danger">Disapproved </span></td>
							<?php endif; ?>
	
							<?php if($row['lvl3'] == 0): ?>
								<td><span class="badge badge-warning">Pending</span></td>
							<?php elseif ($row['lvl3'] == 1): ?>
								<td><span class="badge badge-success">Approved </span></td>
							<?php elseif ($row['lvl3'] == 2): ?>
								<td><span class="badge badge-danger">Disapproved </span></td>
							<?php endif; ?>
	
							<td>
								<a class="btn btn-flat btn-success btn-s view_res" style="font-size: 12px; height: 30px; width: 37px;" cid="<?php echo $cid ?>" data-id="<?php echo md5($row['property_id']) ?>" id="view_tooltip">
									<i class="fa fa-eye" aria-hidden="true"></i>
									<span class="tooltip">View</span>
								</a>
								<!-- <?php
								?>
								<?php 
									if($usertype=="Billing"):
										echo '<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['property_id'] . '" value="4" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
										echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
										echo '<span class="tooltip">Approved</span>';
										echo '</a>';
									elseif($usertype=="Manager"):
										echo '<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['property_id'] . '" value="3" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
										echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
										echo '<span class="tooltip">Approved</span>';
										echo '</a>';
									elseif($usertype=="CHIEF FINANCE OFFICER"):
										echo '<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['property_id'] . '" value="2" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
										echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
										echo '<span class="tooltip">Approved</span>';
										echo '</a>';
									elseif($usertype=="IT Admin"):
										echo '<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['property_id'] . '" value="1" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
										echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
										echo '<span class="tooltip">Approved</span>';
										echo '</a>';
									endif;
								?>
								<?php 
								if($usertype=="Billing"):
									echo '<a class="btn btn-flat btn-danger btn-s disapproved_res" style="font-size: 12px; height: 30px; width: 37px;" data-id="' . $row['property_id'] . '" value="4" id="view_tooltip">';
									echo '<i class="fa fa-thumbs-down" aria-hidden="true"></i>';
									echo '<span class="tooltip">Disapproved</span>';
									echo '</a>';
								elseif($usertype=="Manager"):	
									echo '<a class="btn btn-flat btn-danger btn-s disapproved_res" style="font-size: 12px; height: 30px; width: 37px;" data-id="' . $row['property_id'] . '" value="3" id="view_tooltip">';
									echo '<i class="fa fa-thumbs-down" aria-hidden="true"></i>';
									echo '<span class="tooltip">Disapproved</span>';
									echo '</a>';
								elseif($usertype=="CHIEF FINANCE OFFICER"):	
									echo '<a class="btn btn-flat btn-danger btn-s disapproved_res" style="font-size: 12px; height: 30px; width: 37px;" data-id="' . $row['property_id'] . '" value="2" id="view_tooltip">';
									echo '<i class="fa fa-thumbs-down" aria-hidden="true"></i>';
									echo '<span class="tooltip">Disapproved</span>';
									echo '</a>';
								elseif($usertype=="IT Admin"):
									echo '<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['property_id'] . '" value="1" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
									echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
									echo '<span class="tooltip">Approved</span>';
									echo '</a>';
								endif;
								?> -->
								</td>
							</tr>
						<?php endwhile; ?>
					<?php                         
					}
					elseif($usertype=='CFO' or $usertype=='COO' or $usertype=='IT Admin')
					{
					/* 	$qry = $conn->query("SELECT z.last_name, z.first_name, z.middle_name,y.property_id, y.payment_amount, y.pay_date, y.due_date, y.or_no,
						y.amount_due, y.rebate, y.surcharge, y.interest, y.principal,
						y.remaining_balance, y.payment_count,
						y.lvl3, y.lvl1, y.lvl2 FROM property_payments y INNER JOIN property_clients z ON y.property_id = z.property_id WHERE y.lvl1=1 and y.lvl2=1 and y.lvl3=1
						GROUP BY y.property_id;"); */

						
						$qry = $conn->query("SELECT y.id , z.last_name, z.first_name, z.middle_name,y.property_id, y.pending_status,
						y.lvl3, y.lvl1, y.lvl2 FROM pending_restructuring y INNER JOIN property_clients z ON y.property_id = z.property_id WHERE y.lvl1=1 and y.lvl2=1 and y.lvl3=1
						");
                            while($row = $qry->fetch_assoc()):   
								  
                        ?>
                        <tr>
						<td><?php echo $row["id"]; ?> </a></td>
						<td><?php echo $row["property_id"] ?></a></td>
						<?php $prop_id = $row["property_id"]; ?>
						<?php $cid = $row["id"]; ?>
						<td><?php echo $row["last_name"] ?></a></td>
						<td><?php echo $row["first_name"] ?></a></td>
						<td><?php echo $row["middle_name"] ?></a></td>
                        <!-- <td><?php echo number_format($row["payment_amount"],2) ?></td>
                        <td><?php echo $row["pay_date"] ?></td>
						<td><?php echo $row["due_date"] ?></td>
						<td><?php echo $row["or_no"] ?></td>
                        <td><?php echo number_format($row["amount_due"],2) ?></td>
                        <td><?php echo number_format($row["rebate"],2) ?></td>
						<td><?php echo number_format($row["surcharge"],2) ?></td>
                        <td><?php echo number_format($row["interest"],2) ?></td>
                        <td><?php echo number_format($row["principal"],2) ?></td>
                        <td><?php echo number_format($row["remaining_balance"],2) ?></td> -->

                        <?php if($row['lvl1'] == 0): ?>
							<td><span class="badge badge-warning">Pending</span></td>
						<?php elseif ($row['lvl1'] == 1): ?>
							<td><span class="badge badge-success">Approved </span></td>
						<?php elseif ($row['lvl1'] == 2): ?>
							<td><span class="badge badge-danger">Disapproved </span></td>
						<?php endif; ?>

                        <?php if($row['lvl2'] == 0): ?>
							<td><span class="badge badge-warning">Pending</span></td>
						<?php elseif ($row['lvl2'] == 1): ?>
							<td><span class="badge badge-success">Approved </span></td>
						<?php elseif ($row['lvl2'] == 2): ?>
							<td><span class="badge badge-danger">Disapproved </span></td>
						<?php endif; ?>

                        <?php if($row['lvl3'] == 0): ?>
							<td><span class="badge badge-warning">Pending</span></td>
						<?php elseif ($row['lvl3'] == 1): ?>
							<td><span class="badge badge-success">Approved </span></td>
						<?php elseif ($row['lvl3'] == 2): ?>
							<td><span class="badge badge-danger">Disapproved </span></td>
						<?php endif; ?>

                        <td>
							<a class="btn btn-flat btn-success btn-s view_res" style="font-size: 12px; height: 30px; width: 37px;" cid="<?php echo $cid ?>" data-id="<?php echo md5($row['property_id']) ?>" id="view_tooltip">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="tooltip">View</span>
                            </a>
							<!-- <?php
							?>
							<?php 
								if($usertype=="Billing"):
									echo '<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['property_id'] . '" value="4" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
									echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
									echo '<span class="tooltip">Approved</span>';
									echo '</a>';
								elseif($usertype=="Manager"):
									echo '<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['property_id'] . '" value="3" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
									echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
									echo '<span class="tooltip">Approved</span>';
									echo '</a>';
								elseif($usertype=="CHIEF FINANCE OFFICER"):
									echo '<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['property_id'] . '" value="2" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
									echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
									echo '<span class="tooltip">Approved</span>';
									echo '</a>';
								elseif($usertype=="IT Admin"):
									echo '<a class="btn btn-flat btn-primary btn-s approved_res" data-id="' . $row['property_id'] . '" value="1" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
									echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
									echo '<span class="tooltip">Approved</span>';
									echo '</a>';
								endif;
							?>
							<?php 
							if($usertype=="Billing"):
                            	echo '<a class="btn btn-flat btn-danger btn-s disapproved_res" style="font-size: 12px; height: 30px; width: 37px;" data-id="' . $row['property_id'] . '" value="4" id="view_tooltip">';
                                echo '<i class="fa fa-thumbs-down" aria-hidden="true"></i>';
                                echo '<span class="tooltip">Disapproved</span>';
                            	echo '</a>';
							elseif($usertype=="Manager"):	
								echo '<a class="btn btn-flat btn-danger btn-s disapproved_res" style="font-size: 12px; height: 30px; width: 37px;" data-id="' . $row['property_id'] . '" value="3" id="view_tooltip">';
                                echo '<i class="fa fa-thumbs-down" aria-hidden="true"></i>';
                                echo '<span class="tooltip">Disapproved</span>';
                            	echo '</a>';
							elseif($usertype=="CHIEF FINANCE OFFICER"):	
								echo '<a class="btn btn-flat btn-danger btn-s disapproved_res" style="font-size: 12px; height: 30px; width: 37px;" data-id="' . $row['property_id'] . '" value="2" id="view_tooltip">';
                                echo '<i class="fa fa-thumbs-down" aria-hidden="true"></i>';
                                echo '<span class="tooltip">Disapproved</span>';
                            	echo '</a>';
							elseif($usertype=="IT Admin"):
								echo '<a class="btn btn-flat btn-primary btn-s disapproved_res" data-id="' . $row['property_id'] . '" value="1" style="font-size: 12px; height: 30px; width: 37px;" id="view_tooltip">';
								echo '<i class="fa fa-thumbs-up" aria-hidden="true"></i>';
								echo '<span class="tooltip">Approved</span>';
								echo '</a>';
							endif;
							?> -->
                        </td>
                        </tr>
						<?php endwhile; ?>
					<?php                         
					} ?>
                    </tbody>
					</table>
					</div>                     
            </div>

	</div>

<script>
$(document).ready(function() {
    $('.table').dataTable(
        {
            "ordering": false
        }
    ); 
});
/* $('.view_res_coo').click(function(){
	uni_modal_right("<i class='fa fa-info'></i> Restructuring Details",'clients/restructuring/restructuring_approved_view.php?id='+$(this).attr('data-id'),"mid-large")
}) */
$('.view_res').click(function(){
	uni_modal_right("<i class='fa fa-info'></i> Restructuring Details",'clients/restructuring/restructuring_details.php?id='+$(this).attr('data-id') + '&cid=' + $(this).attr('cid') ,"mid-large")
})
$('.approved_res').click(function(){
	_conf("Are you sure you want to restructure this account?","approved_res",[$(this).attr('data-id'),$(this).attr('value')])
	//uni_modal_right("<i class='fa fa-info'></i> Restructuring Details",'clients/restructuring/restructuring_details.php?id='+$(this).attr('data-id'),"mid-large")
})

$('.disapproved_res').click(function(){
	_conf("Are you sure you want to restructure this account?","disapproved_res",[$(this).attr('data-id'),$(this).attr('value')])
	//uni_modal_right("<i class='fa fa-info'></i> Restructuring Details",'clients/restructuring/restructuring_details.php?id='+$(this).attr('data-id'),"mid-large")
}) 
function approved_res($data_id,$value){
	start_loader();
	$.ajax({
		url:_base_url_+"classes/Master.php?f=res_approval",
		method:"POST",
		data: { data_id: $data_id, value: $value},
		dataType:"json",
		error:err=>{
			console.log(err)
			alert_toast("Error!",'error');
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
function disapproved_res($data_id,$value){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=res_disapproval",
            method:"POST",
            data: { data_id: $data_id, value: $value},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("Error!",'error');
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