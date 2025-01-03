<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php
$usertype = $_settings->userdata('user_type'); 
$type = $_settings->userdata('user_code');
$level = $_settings->userdata('type');
$department = $_settings->userdata('department');
?>
<style>
	.nav-gr{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-gr:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
    #pending-link{
		border-bottom: solid 2px blue;
        background-color:#E8E8E8;
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
    #container {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color:transparent;
    }
</style>

<?php if($level > 3){ ?>
<div class="card" id="container">
    <div class="navbar-menu">
		<a href="<?php echo base_url ?>admin/?page=po/requisitions/pending_req" class="main_menu" id="pending-link" style="border-left:solid 3px white;"><i class="nav-icon fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Pending Requests</a>
		<a href="<?php echo base_url ?>admin/?page=po/goods_receiving" class="main_menu" id="approved-link"><i class="nav-icon fas fa-thumbs-up"></i>&nbsp;&nbsp;&nbsp;Approved POs</a>
		<a href="<?php echo base_url ?>admin/?page=po/requisitions/declined_req" class="main_menu" id="declined-link"><i class="nav-icon fas fa-times"></i>&nbsp;&nbsp;&nbsp;Declined Requests</a>
	</div>
</div>
<?php }?>
<div class="card card-outline card-primary">
	<div class="card-header">
		<b><i><h5 class="card-title">List of Pending Purchase Requests</b></i></h5>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-hover table-striped" style="text-align:center;">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
				</colgroup>
				<thead>
					<tr class="bg-navy disabled">
						<th>#</th>
						<th>Date Created</th>
						<th>PO #</th>
						<th>Supplier</th>
						<!-- <th>Items</th> -->
						<!-- <th>Total Amount</th> -->
						<th>PS Status</th>
						<th>FM Status</th>
                        <th>CFO Status</th>

                        <!-- <th>Status 3</th> -->
						<th>Action</th>
					</tr>
				</thead>
					<tbody>
						<?php 
						$i = 1;
							//$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id order by unix_timestamp(po.date_updated) ");
							$qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id WHERE (po.department='$department') and (po.status=0 or po.status2=0 or po.status3=0) order by po.date_created DESC");
							while($row = $qry->fetch_assoc()):
								$id =  $row['id'];
								$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
								$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
						?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
								<td class=""><?php echo $row['po_no'] ?></td>
								<td class=""><?php echo $row['sname'] ?></td>
								<!-- <td class="text-right"><?php echo number_format($row['item_count']) ?></td> -->
								<!-- <td class="text-right"><?php echo number_format($row['total_amount']) ?></td> -->
								<td>
									<?php 
										switch ($row['status']) {
											case '1':
												echo '<span class="badge badge-success">Approved</span>';
												break;
											case '2':
												echo '<span class="badge badge-danger">Declined</span>';
												break;
											default:
												echo '<span class="badge badge-secondary">Pending</span>';
												break;
										}
									?>
								</td>
								<td>
									<?php 
										switch ($row['status2']) {
											case '1':
												echo '<span class="badge badge-success">Approved</span>';
												break;
											case '2':
												echo '<span class="badge badge-danger">Declined</span>';
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
										<a class="dropdown-item" href="?page=po/requisitions/view_req&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> View</a>
									<?php if ($row['status'] == 0){ ?>
                                        <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="?page=po/requisitions/manage_req&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                    <?php } ?>
                                        <!-- <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a> -->
									</div>
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
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this rent permanently?","delete_po",[$(this).attr('data-id')])
		})
		$('.view_details').click(function(){
			uni_modal("Reservaton Details","po/purchase_orders/view_details.php?id="+$(this).attr('data-id'),'mid-large')
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
</script>