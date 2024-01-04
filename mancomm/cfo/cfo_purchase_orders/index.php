<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php
$usertype = $_settings->userdata('user_type'); 
$type = $_settings->userdata('user_code');
$level = $_settings->userdata('type');
?>
<style>
	.nav-cpo {
		background-color: #007bff;
		color: white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
	}
	.nav-cpo:hover {
		background-color: #007bff!important;
		color: white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
	}
	.main_menu {
		float: left;
		width: 227px;
		height: 40px;
		line-height: 40px;
		text-align: center;
		color: black!important;
		border-right: solid 3px white;
	}
	#main-title {
		font-style: italic;
		font-weight: bold;
	}
	.main_menu:hover {
		border-bottom: solid 2px blue;
		background-color: #E8E8E8;
	}
	#container {
		display: flex;
		justify-content: center;
		align-items: center;
		background-color: transparent;
	}
	.navbar-menu {
		width: 908px; 
		margin: auto; 
		display: flex;
		flex-direction: row;
		align-items: center; 
		justify-content: space-around;
	}
	.table{
		font-size:13px;
	}
</style>
<div class="card" id="container">
	<div class="navbar-menu">
		<a href="javascript:void(0);" onclick="showPendingPOsTable()" class="main_menu" id="pending-link" style="border-left:solid 3px white;"><i class="nav-icon fa fa-check-square"></i>&nbsp;&nbsp;&nbsp;Pending POs</a>
		<a href="javascript:void(0);" onclick="showApprovedPOsTable()" class="main_menu" id="approved-link"><i class="nav-icon fa fa-cart-arrow-down"></i>&nbsp;&nbsp;&nbsp;Approved POs</a>
		<a href="javascript:void(0);" onclick="showDeclinedPOsTable()" class="main_menu" id="declined-link"><i class="nav-icon fa fa-check-square"></i>&nbsp;&nbsp;&nbsp;Declined POs</a>
		<a href="javascript:void(0);" onclick="showForReviewPOsTable()" class="main_menu" id="review-link"><i class="nav-icon fa fa-check-square"></i>&nbsp;&nbsp;&nbsp;For Review POs</a>
	</div>
</div>
<div class="card card-outline card-primary">
	<div class="card-header">
		<b><i><h5 class="card-title" id="main-title">List of Pending Purchase Orders</b></i></h5>
		<?php if($usertype == "Purchasing Officer"): ?>
		<div class="card-tools">
			<a href="./?page=cfo_purchase_orders/manage_po" class="btn btn-flat btn-primary" style="font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Create New Purchase Order</a>
		</div>
		<?php endif; ?>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			
			<div id="pending-table" style="display: none;">
				<table class="table table-bordered table-stripped" style="width:100%;text-align:center;">
					<thead>
						<tr class="bg-navy disabled">
							<th>#</th>
							<th>Date Created</th>
							<th>PO #</th>
							<th>Supplier</th>
							<th>Requesting Dept.</th>
							<th>Total Amount</th>
							<th>FM Status</th>
							<th>CFO Status</th>
							<th>Action</th>
						</tr>
					</thead>
						<?php if ($usertype=="Purchasing Officer"): ?>
						<tbody>
							<?php 
							$i = 1;
							$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id WHERE po.status='1' and po.status2='0' and po.status3='0' order by po.date_created DESC");
							while($row = $qry->fetch_assoc()):
								$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
								$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
								$orderItemsTotal = $conn->query("SELECT SUM(quantity * unit_price) as total FROM order_items WHERE po_id = '{$row['id']}'")->fetch_array()['total'];

								$result = $conn->query("SELECT vatable, tax_amount FROM po_list WHERE po_no = '{$row['id']}'");
								$rowFromPoList = $result->fetch_assoc();
								$totalVat = isset($rowFromPoList['tax_amount']) ? $rowFromPoList['tax_amount'] : 0;
								$vatable = isset($rowFromPoList['vatable']) ? $rowFromPoList['vatable'] : 0;

								
								if ($vatable == 1) {
									$totalAmountWithTax = $orderItemsTotal;
								} elseif ($vatable == 2) {
									$totalAmountWithTax = $orderItemsTotal + $totalVat;
								} else {
									$totalAmountWithTax = $orderItemsTotal;
								}

								$row['total_amount'] = $totalAmountWithTax;
							?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
								<td class=""><?php echo $row['po_no'] ?></td>
								<td class=""><?php echo $row['sname'] ?></td>
								<td class=""><?php echo $row['department'] ?></td>
								<td class="text-right"><?php echo number_format($row['total_amount'],2) ?></td>
								<td>
								<?php 
								switch ($row['status2']) {
									case '1':
										echo '<span class="badge badge-success">Approved</span>';
										break;
									case '2':
										echo '<span class="badge badge-danger">Declined</span>';
										break;
									case '3':
										echo '<span class="badge badge-warning">For Review</span>';
										break;
									default:
										echo '<span class="badge badge-secondary">Pending</span>';
										break;
								}
								?>
								</td>
								<td>
								<?php 
								switch ($row['status3']) {
									case '1':
										echo '<span class="badge badge-success">Approved</span>';
										break;
									case '2':
										echo '<span class="badge badge-danger">Declined</span>';
										break;
									case '3':
										echo '<span class="badge badge-warning">For Review</span>';
										break;
									default:
										echo '<span class="badge badge-secondary">Pending</span>';
										break;
								}
								?>
								</td>
								<td align="center">
									<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
											Action
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<?php 
											if ($row['fpo_status'] != '3'){?>
												<a class="dropdown-item" href="?page=cfo_purchase_orders/manage_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
											<?php } else{ ?>
												<a class="dropdown-item" href="?page=cfo_purchase_orders/verify_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
											<?php } ?>
											

											<?php if ($row['fpo_status'] != '3'){?>
												<div class="dropdown-divider"></div>
											<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
										<?php }?>
									</div>
								</td>
							</tr>
							<?php endwhile; ?>
						</tbody>
						<?php elseif ($level == 3): ?>
						<tbody>
							<?php 
							$i = 1;
							$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id WHERE po.status='1' and po.status2='0' and po.status3='0' order by po.date_created DESC");
							while($row = $qry->fetch_assoc()):
								$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
								$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
								$orderItemsTotal = $conn->query("SELECT SUM(quantity * unit_price) as total FROM order_items WHERE po_id = '{$row['id']}'")->fetch_array()['total'];

								$result = $conn->query("SELECT vatable, tax_amount FROM po_list WHERE po_no = '{$row['id']}'");
								$rowFromPoList = $result->fetch_assoc();
								$totalVat = isset($rowFromPoList['tax_amount']) ? $rowFromPoList['tax_amount'] : 0;
								$vatable = isset($rowFromPoList['vatable']) ? $rowFromPoList['vatable'] : 0;

								
								if ($vatable == 1) {
									$totalAmountWithTax = $orderItemsTotal;
								} elseif ($vatable == 2) {
									$totalAmountWithTax = $orderItemsTotal + $totalVat;
								} else {
									$totalAmountWithTax = $orderItemsTotal;
								}

								$row['total_amount'] = $totalAmountWithTax;
							?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
									<td class=""><?php echo $row['po_no'] ?></td>
									<td class=""><?php echo $row['sname'] ?></td>
									<td class=""><?php echo $row['department'] ?></td>
									<td class="text-right"><?php echo number_format($row['total_amount'],2) ?></td>
									<td>
										<?php 
											switch ($row['status2']) {
												case '1':
													echo '<span class="badge badge-success">Approved</span>';
													break;
												case '2':
													echo '<span class="badge badge-danger">Declined</span>';
													break;
												case '3':
													echo '<span class="badge badge-warning">For Review</span>';
													break;
												default:
													echo '<span class="badge badge-secondary">Pending</span>';
													break;
											}
										?>
									</td>
									<td>
										<?php 
											switch ($row['status3']) {
												case '1':
													echo '<span class="badge badge-success">Approved</span>';
													break;
												case '2':
													echo '<span class="badge badge-danger">Declined</span>';
													break;
												case '3':
													echo '<span class="badge badge-warning">For Review</span>';
													break;
												default:
													echo '<span class="badge badge-secondary">Pending</span>';
													break;
											}
										?>
									</td>
									<td align="center">
										<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
												Action
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<div class="dropdown-menu" role="menu">
											<a class="dropdown-item" href="?page=cfo_purchase_orders/verify_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>	
										</div>
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
						<?php elseif ($level == 2): ?>
						<tbody>
							<?php 
							$i = 1;
							$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id WHERE po.status='1' and po.status2='1' and po.status3='0' order by po.date_created DESC");
							while($row = $qry->fetch_assoc()):
								$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
								$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
								$orderItemsTotal = $conn->query("SELECT SUM(quantity * unit_price) as total FROM order_items WHERE po_id = '{$row['id']}'")->fetch_array()['total'];

								$result = $conn->query("SELECT vatable, tax_amount FROM po_list WHERE po_no = '{$row['id']}'");
								$rowFromPoList = $result->fetch_assoc();
								$totalVat = isset($rowFromPoList['tax_amount']) ? $rowFromPoList['tax_amount'] : 0;
								$vatable = isset($rowFromPoList['vatable']) ? $rowFromPoList['vatable'] : 0;

								
								if ($vatable == 1) {
									$totalAmountWithTax = $orderItemsTotal;
								} elseif ($vatable == 2) {
									$totalAmountWithTax = $orderItemsTotal + $totalVat;
								} else {
									$totalAmountWithTax = $orderItemsTotal;
								}

								$row['total_amount'] = $totalAmountWithTax;
							?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
									<td class=""><?php echo $row['po_no'] ?></td>
									<td class=""><?php echo $row['sname'] ?></td>
									<td class=""><?php echo $row['department'] ?></td>
									<td class="text-right"><?php echo number_format($row['total_amount'],2) ?></td>
									<td>
										<?php 
											switch ($row['status2']) {
												case '1':
													echo '<span class="badge badge-success">Approved</span>';
													break;
												case '2':
													echo '<span class="badge badge-danger">Declined</span>';
													break;
												case '3':
													echo '<span class="badge badge-warning">For Review</span>';
													break;
												default:
													echo '<span class="badge badge-secondary">Pending</span>';
													break;
											}
										?>
									</td>
									<td>
										<?php 
											switch ($row['status3']) {
												case '1':
													echo '<span class="badge badge-success">Approved</span>';
													break;
												case '2':
													echo '<span class="badge badge-danger">Declined</span>';
													break;
												case '3':
													echo '<span class="badge badge-warning">For Review</span>';
													break;
												default:
													echo '<span class="badge badge-secondary">Pending</span>';
													break;
											}
										?>
									</td>
									<td align="center">
										<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
												Action
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<div class="dropdown-menu" role="menu">
											<a class="dropdown-item" href="?page=cfo_purchase_orders/verify_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>	
										</div>
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					<?php endif; ?>
				</table>
			</div>
			
			<div id="approved-table" style="display: none;">
				<table class="table table-bordered table-stripped" style="width:100%;text-align:center;">
						<thead>
							<tr class="bg-navy disabled">
								<th>#</th>
								<th>Date Created</th>
								<th>PO #</th>
								<th>Supplier</th>
								<th>Requesting Dept.</th>
								<th>Total Amount</th>
								<th>FM Status</th>
								<th>CFO Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<?php if ($usertype == "Purchasing Officer"): ?>
						<tbody>
							<?php 
							$i = 1;
							//$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id WHERE po.status=1 and ((po.status2=1 or po.status3=1) and (po.status2!=2 and po.status3!=2)) order by po.date_created DESC");
							$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id WHERE po.status=1 and (po.status2 = 1 or po.status3 = 1) order by po.date_created DESC");
							while($row = $qry->fetch_assoc()):
								$id =  $row['id'];
								$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
								$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
								$orderItemsTotal = $conn->query("SELECT SUM(quantity * unit_price) as total FROM order_items WHERE po_id = '{$row['id']}'")->fetch_array()['total'];

								$result = $conn->query("SELECT vatable, tax_amount FROM po_list WHERE po_no = '{$row['id']}'");
								$rowFromPoList = $result->fetch_assoc();
								$totalVat = isset($rowFromPoList['tax_amount']) ? $rowFromPoList['tax_amount'] : 0;
								$vatable = isset($rowFromPoList['vatable']) ? $rowFromPoList['vatable'] : 0;

								
								if ($vatable == 1) {
									$totalAmountWithTax = $orderItemsTotal;
								} elseif ($vatable == 2) {
									$totalAmountWithTax = $orderItemsTotal + $totalVat;
								} else {
									$totalAmountWithTax = $orderItemsTotal;
								}

								$row['total_amount'] = $totalAmountWithTax;
							?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
								<td class=""><?php echo $row['po_no'] ?></td>
								<td class=""><?php echo $row['sname'] ?></td>
								<td class=""><?php echo ($row['department']) ?></td>
								<td class="text-right"><?php echo number_format($row['total_amount'],2) ?></td>
								<td>
									<?php 
										switch ($row['status2']) {
											case '1':
												echo '<span class="badge badge-success">Approved</span>';
												break;
											case '2':
												echo '<span class="badge badge-danger">Declined</span>';
												break;
											case '3':
												echo '<span class="badge badge-warning">For Review</span>';
												break;
											default:
												echo '<span class="badge badge-secondary">Pending</span>';
												break;
										}
									?>
								</td>
								<td>
									<?php 
										switch ($row['status3']) {
											case '1':
												echo '<span class="badge badge-success">Approved</span>';
												break;
											case '2':
												echo '<span class="badge badge-danger">Declined</span>';
												break;
											case '3':
												echo '<span class="badge badge-warning">For Review</span>';
												break;
											default:
												echo '<span class="badge badge-secondary">Pending</span>';
												break;
										}
									?>
								</td>
								<td align="center">
									<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
											Action
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<a class="dropdown-item" href="?page=cfo_purchase_orders/view_po&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
									</div>
								</td>
							</tr>
							<?php endwhile; ?>
						</tbody>
						<?php elseif ($level == 3): ?>
						<tbody>
							<?php 
							$i = 1;
							$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id WHERE po.status=1 and po.status2=1 order by po.date_created DESC");
							while($row = $qry->fetch_assoc()):
								$id =  $row['id'];
								$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
								$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
								$orderItemsTotal = $conn->query("SELECT SUM(quantity * unit_price) as total FROM order_items WHERE po_id = '{$row['id']}'")->fetch_array()['total'];

								$result = $conn->query("SELECT vatable, tax_amount FROM po_list WHERE po_no = '{$row['id']}'");
								$rowFromPoList = $result->fetch_assoc();
								$totalVat = isset($rowFromPoList['tax_amount']) ? $rowFromPoList['tax_amount'] : 0;
								$vatable = isset($rowFromPoList['vatable']) ? $rowFromPoList['vatable'] : 0;

								
								if ($vatable == 1) {
									$totalAmountWithTax = $orderItemsTotal;
								} elseif ($vatable == 2) {
									$totalAmountWithTax = $orderItemsTotal + $totalVat;
								} else {
									$totalAmountWithTax = $orderItemsTotal;
								}

								$row['total_amount'] = $totalAmountWithTax;
							?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
								<td class=""><?php echo $row['po_no'] ?></td>
								<td class=""><?php echo $row['sname'] ?></td>
								<td class=""><?php echo ($row['department']) ?></td>
								<td class="text-right"><?php echo number_format($row['total_amount'],2) ?></td>
								<td>
									<?php 
									switch ($row['status2']) {
										case '1':
											echo '<span class="badge badge-success">Approved</span>';
											break;
										case '2':
											echo '<span class="badge badge-danger">Declined</span>';
											break;
										case '3':
											echo '<span class="badge badge-warning">For Review</span>';
											break;
										default:
											echo '<span class="badge badge-secondary">Pending</span>';
											break;
									}
									?>
								</td>
								<td>
									<?php 
									switch ($row['status3']) {
										case '1':
											echo '<span class="badge badge-success">Approved</span>';
											break;
										case '2':
											echo '<span class="badge badge-danger">Declined</span>';
											break;
										case '3':
											echo '<span class="badge badge-warning">For Review</span>';
											break;
										default:
											echo '<span class="badge badge-secondary">Pending</span>';
											break;
									}
									?>
								</td>
								<td align="center">
									<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
											Action
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<a class="dropdown-item" href="?page=cfo_purchase_orders/view_po&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
									</div>
								</td>
							</tr>
							<?php endwhile; ?>
						</tbody>
						<?php elseif ($level == 2): ?>
						<tbody>
							<?php 
							$i = 1;
							$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id WHERE po.status3=1 order by po.date_created DESC");
							while($row = $qry->fetch_assoc()):
								$id =  $row['id'];
								$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
								$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
								$orderItemsTotal = $conn->query("SELECT SUM(quantity * unit_price) as total FROM order_items WHERE po_id = '{$row['id']}'")->fetch_array()['total'];

								$result = $conn->query("SELECT vatable, tax_amount FROM po_list WHERE po_no = '{$row['id']}'");
								$rowFromPoList = $result->fetch_assoc();
								$totalVat = isset($rowFromPoList['tax_amount']) ? $rowFromPoList['tax_amount'] : 0;
								$vatable = isset($rowFromPoList['vatable']) ? $rowFromPoList['vatable'] : 0;

								
								if ($vatable == 1) {
									$totalAmountWithTax = $orderItemsTotal;
								} elseif ($vatable == 2) {
									$totalAmountWithTax = $orderItemsTotal + $totalVat;
								} else {
									$totalAmountWithTax = $orderItemsTotal;
								}

								$row['total_amount'] = $totalAmountWithTax;
							?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
								<td class=""><?php echo $row['po_no'] ?></td>
								<td class=""><?php echo $row['sname'] ?></td>
								<td class=""><?php echo ($row['department']) ?></td>
								<td class="text-right"><?php echo number_format($row['total_amount'],2) ?></td>
								<td>
								<?php 
									switch ($row['status2']) {
										case '1':
											echo '<span class="badge badge-success">Approved</span>';
											break;
										case '2':
											echo '<span class="badge badge-danger">Declined</span>';
											break;
										case '3':
											echo '<span class="badge badge-warning">For Review</span>';
											break;
										default:
											echo '<span class="badge badge-secondary">Pending</span>';
											break;
									}
								?>
								</td>
								<td>
								<?php 
									switch ($row['status3']) {
										case '1':
											echo '<span class="badge badge-success">Approved</span>';
											break;
										case '2':
											echo '<span class="badge badge-danger">Declined</span>';
											break;
										case '3':
											echo '<span class="badge badge-warning">For Review</span>';
											break;
										default:
											echo '<span class="badge badge-secondary">Pending</span>';
											break;
									}
								?>
								</td>
								<td align="center">
									<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
											Action
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
										<a class="dropdown-item" href="?page=cfo_purchase_orders/view_po&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>	
									</div>
								</td>
							</tr>
							<?php endwhile; ?>
						</tbody>
					<?php endif; ?>
				</table>
			</div>

			<div id="declined-table" style="display: none;">
				<table class="table table-bordered table-stripped" style="width:100%;text-align:center;">
					<thead>
						<tr class="bg-navy disabled">
							<th>#</th>
							<th>Date Created</th>
							<th>PO #</th>
							<th>Supplier</th>
							<th>Requesting Dept.</th>
							<th>Total Amount</th>
							<th>FM Status</th>
							<th>CFO Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<?php if ($usertype == "Purchasing Officer"): ?>
					<tbody>
						<?php 
						$i = 1;
						$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id WHERE po.status=1 and (po.status2='2' or po.status3='2') order by po.date_created DESC");
						while($row = $qry->fetch_assoc()):
							$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
							$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
							$orderItemsTotal = $conn->query("SELECT SUM(quantity * unit_price) as total FROM order_items WHERE po_id = '{$row['id']}'")->fetch_array()['total'];

							$result = $conn->query("SELECT vatable, tax_amount FROM po_list WHERE po_no = '{$row['id']}'");
							$rowFromPoList = $result->fetch_assoc();
							$totalVat = isset($rowFromPoList['tax_amount']) ? $rowFromPoList['tax_amount'] : 0;
							$vatable = isset($rowFromPoList['vatable']) ? $rowFromPoList['vatable'] : 0;

							
							if ($vatable == 1) {
								$totalAmountWithTax = $orderItemsTotal;
							} elseif ($vatable == 2) {
								$totalAmountWithTax = $orderItemsTotal + $totalVat;
							} else {
								$totalAmountWithTax = $orderItemsTotal;
							}

							$row['total_amount'] = $totalAmountWithTax;
						?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
							<td class=""><?php echo $row['po_no'] ?></td>
							<td class=""><?php echo $row['sname'] ?></td>
							<td class=""><?php echo ($row['department']) ?></td>
							<td class="text-right"><?php echo number_format($row['total_amount'],2) ?></td>
							<td>
							<?php 
							switch ($row['status2']) {
								case '1':
									echo '<span class="badge badge-success">Approved</span>';
									break;
								case '2':
									echo '<span class="badge badge-danger">Declined</span>';
									break;
								case '3':
									echo '<span class="badge badge-warning">For Review</span>';
									break;
								default:
									echo '<span class="badge badge-secondary">Pending</span>';
									break;
							}
							?>
							</td>
							<td>
							<?php 
							switch ($row['status3']) {
								case '1':
									echo '<span class="badge badge-success">Approved</span>';
									break;
								case '2':
									echo '<span class="badge badge-danger">Declined</span>';
									break;
								case '3':
									echo '<span class="badge badge-warning">For Review</span>';
									break;
								default:
									echo '<span>--</span>';
									break;
							}
							?>
							</td>
							<td align="center">
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
								Action
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
									<a class="dropdown-item" href="?page=cfo_purchase_orders/view_po&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
								</div>
							</td>
						</tr>
						<?php endwhile; ?>
					</tbody>
					<?php elseif ($level== 3): ?>
					<tbody>
						<?php 
						$i = 1;
						$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id WHERE po.status2='2' order by po.date_created DESC");
						while($row = $qry->fetch_assoc()):
							$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
							$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
							$orderItemsTotal = $conn->query("SELECT SUM(quantity * unit_price) as total FROM order_items WHERE po_id = '{$row['id']}'")->fetch_array()['total'];

							$result = $conn->query("SELECT vatable, tax_amount FROM po_list WHERE po_no = '{$row['id']}'");
							$rowFromPoList = $result->fetch_assoc();
							$totalVat = isset($rowFromPoList['tax_amount']) ? $rowFromPoList['tax_amount'] : 0;
							$vatable = isset($rowFromPoList['vatable']) ? $rowFromPoList['vatable'] : 0;

							
							if ($vatable == 1) {
								$totalAmountWithTax = $orderItemsTotal;
							} elseif ($vatable == 2) {
								$totalAmountWithTax = $orderItemsTotal + $totalVat;
							} else {
								$totalAmountWithTax = $orderItemsTotal;
							}

							$row['total_amount'] = $totalAmountWithTax;
						?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
							<td class=""><?php echo $row['po_no'] ?></td>
							<td class=""><?php echo $row['sname'] ?></td>
							<td class=""><?php echo ($row['department']) ?></td>
							<td class="text-right"><?php echo number_format($row['total_amount'],2) ?></td>
							<td>
							<?php 
								switch ($row['status2']) {
									case '1':
										echo '<span class="badge badge-success">Approved</span>';
										break;
									case '2':
										echo '<span class="badge badge-danger">Declined</span>';
										break;
									case '3':
										echo '<span class="badge badge-warning">For Review</span>';
										break;
									default:
										echo '<span class="badge badge-secondary">Pending</span>';
										break;
								}
							?>
							</td>
							<td>
								<?php 
									echo '--';
								?>
							</td>
							<td align="center">
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
									<a class="dropdown-item" href="?page=cfo_purchase_orders/view_po&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
									<!-- <?php 
										if ($level== 1 || $usertype == "Purchasing Officer"){?>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="?page=po/purchase_orders/manage_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
										<?php } ?>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a> -->
								</div>
							</td>
						</tr>
						<?php endwhile; ?>
					</tbody>
					<?php elseif ($level == 2): ?>
					<tbody>
						<?php 
						$i = 1;
						$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id WHERE po.status3='2' order by po.date_created DESC");
						while($row = $qry->fetch_assoc()):
							$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
							$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
							$orderItemsTotal = $conn->query("SELECT SUM(quantity * unit_price) as total FROM order_items WHERE po_id = '{$row['id']}'")->fetch_array()['total'];

							$result = $conn->query("SELECT vatable, tax_amount FROM po_list WHERE po_no = '{$row['id']}'");
							$rowFromPoList = $result->fetch_assoc();
							$totalVat = isset($rowFromPoList['tax_amount']) ? $rowFromPoList['tax_amount'] : 0;
							$vatable = isset($rowFromPoList['vatable']) ? $rowFromPoList['vatable'] : 0;

							
							if ($vatable == 1) {
								$totalAmountWithTax = $orderItemsTotal;
							} elseif ($vatable == 2) {
								$totalAmountWithTax = $orderItemsTotal + $totalVat;
							} else {
								$totalAmountWithTax = $orderItemsTotal;
							}

							$row['total_amount'] = $totalAmountWithTax;
						?>
						<tr>
							<td class="text-center"><?php echo $i++; ?></td>
							<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
							<td class=""><?php echo $row['po_no'] ?></td>
							<td class=""><?php echo $row['sname'] ?></td>
							<td class=""><?php echo ($row['department']) ?></td>
							<td class="text-right"><?php echo number_format($row['total_amount'],2) ?></td>
							<td>
							<?php 
								switch ($row['status2']) {
									case '1':
										echo '<span class="badge badge-success">Approved</span>';
										break;
									case '2':
										echo '<span class="badge badge-danger">Declined</span>';
										break;
									case '3':
										echo '<span class="badge badge-warning">For Review</span>';
										break;
									default:
										echo '<span class="badge badge-secondary">Pending</span>';
										break;
								}
								?>
							</td>
							<td>
							<?php 
								switch ($row['status3']) {
									case '1':
										echo '<span class="badge badge-success">Approved</span>';
										break;
									case '2':
										echo '<span class="badge badge-danger">Declined</span>';
										break;
									case '3':
										echo '<span class="badge badge-warning">For Review</span>';
										break;
									default:
										echo '<span class="badge badge-secondary">Pending</span>';
										break;
								}
							?>
							</td>
							<td align="center">
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
										Action
									<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
									<a class="dropdown-item" href="?page=cfo_purchase_orders/view_po&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
									<!-- <?php 
										if ($level == 1 || $usertype == "Purchasing Officer"){?>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="?page=po/purchase_orders/manage_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
										<?php } ?>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a> -->
								</div>
							</td>
						</tr>
						<?php endwhile; ?>
					</tbody>
					<?php endif; ?>
				</table>
			</div>

			<div id="review-table" style="display: none;">
				<table class="table table-bordered table-stripped" style="width:100%;text-align:center;">
					<thead>
						<tr class="bg-navy disabled">
							<th>#</th>
							<th>Date Created</th>
							<th>PO #</th>
							<th>Supplier</th>
							<th>Requesting Dept.</th>
							<th>FM Status</th>
							<th>CFO Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<?php if ($level == 3): ?>
						<tbody>
							<?php 
							$i = 1;
								$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id WHERE (po.status=3 or po.status2='3') order by po.date_created DESC");
								while($row = $qry->fetch_assoc()):
									$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
								?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
									<td class=""><?php echo $row['po_no'] ?></td>
									<td class=""><?php echo $row['sname'] ?></td>
									<td class=""><?php echo $row['department'] ?></td>
									<td>
									<?php 
										switch ($row['status2']) {
											case '1':
												echo '<span class="badge badge-success">Approved</span>';
												break;
											case '2':
												echo '<span class="badge badge-danger">Declined</span>';
												break;
											case '3':
												echo '<span class="badge badge-warning">For Review</span>';
												break;
											default:
												echo '<span class="badge badge-secondary">Pending</span>';
												break;
										}
									?>
									</td>
									<td>
									<?php 
										switch ($row['status3']) {
											case '1':
												echo '<span class="badge badge-success">Approved</span>';
												break;
											case '2':
												echo '<span class="badge badge-danger">Declined</span>';
												break;
											case '3':
												echo '<span class="badge badge-warning">For Review</span>';
												break;
											default:
												echo '<span class="badge badge-secondary">Pending</span>';
												break;
										}
									?>
									</td>
									<td align="center">
										<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
												Action
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<div class="dropdown-menu" role="menu">
											<a class="dropdown-item" href="?page=cfo_purchase_orders/verify_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
										</div>
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
						<?php elseif ($usertype == "Purchasing Officer"): ?>
						<!-- <thead>
							<tr class="bg-navy disabled">
								<th>#</th>
								<th>Date Created</th>
								<th>PO #</th>
								<th>Supplier</th>
								<th>Requesting Dept.</th>
								<th>PS Status</th>
								<th>FM Status</th>
								<th>CFO Status</th>
								<th>Action</th>
							</tr>
						</thead> -->
						<tbody>
							<?php 
							$i = 1;
								$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id WHERE po.status=3 or po.status2=3 or po.status3=3 order by po.date_created DESC");
								while($row = $qry->fetch_assoc()):
									$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
								?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
									<td class=""><?php echo $row['po_no'] ?></td>
									<td class=""><?php echo $row['sname'] ?></td>
									<td class=""><?php echo $row['department'] ?></td>
									<!-- <td>
									<?php 
										switch ($row['status']) {
											case '1':
												echo '<span class="badge badge-success">Approved</span>';
												break;
											case '2':
												echo '<span class="badge badge-danger">Declined</span>';
												break;
											case '3':
												echo '<span class="badge badge-warning">For Review</span>';
												break;
											default:
												echo '<span class="badge badge-secondary">Pending</span>';
												break;
										}
									?>
									</td> -->
									<td>
									<?php 
										switch ($row['status2']) {
											case '1':
												echo '<span class="badge badge-success">Approved</span>';
												break;
											case '2':
												echo '<span class="badge badge-danger">Declined</span>';
												break;
											case '3':
												echo '<span class="badge badge-warning">For Review</span>';
												break;
											default:
												echo '<span class="badge badge-secondary">Pending</span>';
												break;
										}
									?>
									</td>
									<td>
									<?php 
										switch ($row['status3']) {
											case '1':
												echo '<span class="badge badge-success">Approved</span>';
												break;
											case '2':
												echo '<span class="badge badge-danger">Declined</span>';
												break;
											case '3':
												echo '<span class="badge badge-warning">For Review</span>';
												break;
											default:
												echo '<span class="badge badge-secondary">Pending</span>';
												break;
										}
									?>
									</td>
									<td align="center">
										<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
												Action
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<div class="dropdown-menu" role="menu">
											<a class="dropdown-item" href="?page=cfo_purchase_orders/verify_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
										</div>
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					<?php elseif ($level == 2): ?>
						<!-- <thead>
							<tr class="bg-navy disabled">
								<th>#</th>
								<th>Date Created</th>
								<th>PO #</th>
								<th>Supplier</th>
								<th>Requesting Dept.</th>
								<th>PS Status</th>
								<th>FM Status</th>
								<th>CFO Status</th>
								<th>Action</th>
							</tr>
						</thead> -->
						<tbody>
							<?php 
							$i = 1;
							$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id WHERE po.status='1' and po.status2='1' and po.status3='3' order by po.date_created DESC");
							while($row = $qry->fetch_assoc()):
								$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
							?>
								<tr>
									<td class="text-center"><?php echo $i++; ?></td>
									<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
									<td class=""><?php echo $row['po_no'] ?></td>
									<td class=""><?php echo $row['sname'] ?></td>
									<td class=""><?php echo $row['department'] ?></td>
									<!-- <td>
									<?php 
										switch ($row['status']) {
											case '1':
												echo '<span class="badge badge-success">Approved</span>';
												break;
											case '2':
												echo '<span class="badge badge-danger">Declined</span>';
												break;
											case '3':
												echo '<span class="badge badge-warning">For Review</span>';
												break;
											default:
												echo '<span class="badge badge-secondary">Pending</span>';
												break;
										}
									?>
									</td> -->
									<td>
									<?php 
										switch ($row['status2']) {
										case '1':
											echo '<span class="badge badge-success">Approved</span>';
											break;
										case '2':
											echo '<span class="badge badge-danger">Declined</span>';
											break;
										case '3':
											echo '<span class="badge badge-warning">For Review</span>';
											break;
										default:
											echo '<span class="badge badge-secondary">Pending</span>';
											break;
										}
									?>
									</td>
									<td>
									<?php 
									switch ($row['status3']) {
										case '1':
											echo '<span class="badge badge-success">Approved</span>';
											break;
										case '2':
											echo '<span class="badge badge-danger">Declined</span>';
											break;
										case '3':
											echo '<span class="badge badge-warning">For Review</span>';
											break;
										default:
											echo '<span class="badge badge-secondary">Pending</span>';
											break;
									}
									?>
									</td>
									<td align="center">
										<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
												Action
											<span class="sr-only">Toggle Dropdown</span>
										</button>
										<div class="dropdown-menu" role="menu">
											<a class="dropdown-item" href="?page=cfo_purchase_orders/verify_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
										</div>
									</td>
								</tr>
							<?php endwhile; ?>
						</tbody>
					<?php endif; ?>
				</table>
			</div>
		</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this rent permanently?","delete_po",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Reservaton Details","cfo_purchase_orders/view_details.php?id="+$(this).attr('data-id'),'mid-large')
		})
		$('.table th,.table td').addClass('px-1 py-0 align-middle')
		$('.table').dataTable();
	})
	function delete_po($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_po",
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

	function showPendingPOsTable() {
		document.getElementById('pending-table').style.display = 'block';
		document.getElementById('approved-table').style.display = 'none';
		document.getElementById('declined-table').style.display = 'none';
		document.getElementById('review-table').style.display = 'none';

		document.getElementById('pending-link').style.borderBottom = 'solid 2px blue';
		document.getElementById('pending-link').style.backgroundColor = '#E8E8E8';
		document.getElementById('approved-link').style.borderBottom = 'none';
		document.getElementById('approved-link').style.backgroundColor = 'transparent';
		document.getElementById('declined-link').style.borderBottom = 'none';
		document.getElementById('declined-link').style.backgroundColor = 'transparent';
		document.getElementById('review-link').style.borderBottom = 'none';
		document.getElementById('review-link').style.backgroundColor = 'transparent';

		document.getElementById('main-title').textContent = 'List of Pending Purchase Orders';
	}

    function showApprovedPOsTable() {
        document.getElementById('pending-table').style.display = 'none';
		document.getElementById('approved-table').style.display = 'block';
		document.getElementById('declined-table').style.display = 'none';
		document.getElementById('review-table').style.display = 'none';

		document.getElementById('pending-link').style.borderBottom = 'none';
		document.getElementById('pending-link').style.backgroundColor = 'transparent';
		document.getElementById('approved-link').style.borderBottom = 'solid 2px blue';
		document.getElementById('approved-link').style.backgroundColor = '#E8E8E8';
		document.getElementById('declined-link').style.borderBottom = 'none';
		document.getElementById('declined-link').style.backgroundColor = 'transparent';
		document.getElementById('review-link').style.borderBottom = 'none';
		document.getElementById('review-link').style.backgroundColor = 'transparent';

		document.getElementById('main-title').textContent = 'List of Approved Purchase Orders';
    }

	function showDeclinedPOsTable() {
        document.getElementById('pending-table').style.display = 'none';
		document.getElementById('approved-table').style.display = 'none';
		document.getElementById('declined-table').style.display = 'block';
		document.getElementById('review-table').style.display = 'none';

		document.getElementById('pending-link').style.borderBottom = 'none';
		document.getElementById('pending-link').style.backgroundColor = 'transparent';
		document.getElementById('approved-link').style.borderBottom = 'none';
		document.getElementById('approved-link').style.backgroundColor = 'transparent';
		document.getElementById('declined-link').style.borderBottom = 'solid 2px blue';
		document.getElementById('declined-link').style.backgroundColor = '#E8E8E8';
		document.getElementById('review-link').style.borderBottom = 'none';
		document.getElementById('review-link').style.backgroundColor = 'transparent';

		document.getElementById('main-title').textContent = 'List of Declined Purchase Orders';
    }

	function showForReviewPOsTable() {
        document.getElementById('pending-table').style.display = 'none';
		document.getElementById('approved-table').style.display = 'none';
		document.getElementById('declined-table').style.display = 'none';
		document.getElementById('review-table').style.display = 'block';

		document.getElementById('pending-link').style.borderBottom = 'none';
		document.getElementById('pending-link').style.backgroundColor = 'transparent';
		document.getElementById('approved-link').style.borderBottom = 'none';
		document.getElementById('approved-link').style.backgroundColor = 'transparent';
		document.getElementById('declined-link').style.borderBottom = 'none';
		document.getElementById('declined-link').style.backgroundColor = 'transparent';
		document.getElementById('review-link').style.borderBottom = 'solid 2px blue';
		document.getElementById('review-link').style.backgroundColor = '#E8E8E8';

		document.getElementById('main-title').textContent = 'List of Purchase Orders for Revision';
    }

    showPendingPOsTable();

</script>