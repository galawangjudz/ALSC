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
	.nav-adv{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-adv:hover{
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
	#main-title{
		font-style: italic;
        font-weight: bold;
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
<div class="card card-outline card-primary">
	<div class="card-header">
		<b><i><h5 class="card-title" id="main-title">Direct Voucher List</b></i></h5>
		<div class="card-tools">
			<a href="./?page=po/adv/manage_ad_voucher" class="btn btn-flat btn-primary" style="font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Add New Direct Voucher</a>
		</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<div id="pending-table" style="display: none;">
				<table class="table table-bordered table-stripped" style="width:100%;text-align:center;">
					<thead>
						<tr class="bg-navy disabled">
							<th>#</th>
							<th>Transaction No.</th>
                            <th>Transaction Date</th>
							<th>Supplier</th>
							<th>Bank Account</th>
							<th>Amount Paid</th>
							<th>Payment Type</th>
							<th>Actions</th>
						</tr>
					</thead>
                    <tbody>
							<?php 
							$i = 1;
							$qry = $conn->query("SELECT ad.*, s.name as sname FROM `adv` ad inner join `supplier_list` s on ad.supplier_id = s.id;");
							while($row = $qry->fetch_assoc()):
								$row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
								$row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
							?>
							<tr>
								<td class="text-center"><?php echo $i++; ?></td>
								<td class=""><?php echo $row['transaction_no'] ?></td>
								<td class=""><?php echo date("M d,Y",strtotime($row['transaction_date'])) ; ?></td>
								<td class=""><?php echo $row['sname'] ?></td>
								<td class=""><?php echo $row['bank'] ?></td>
                                <td class=""><?php echo number_format($row['amount_paid']) ?></td>
								<td class=""><?php echo $row['payment_type'] ?></td>
                                <td align="center">
									<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
											Action
										<span class="sr-only">Toggle Dropdown</span>
									</button>
									<div class="dropdown-menu" role="menu">
                                        <a class="dropdown-item" href="?page=po/purchase_orders/manage_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                
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