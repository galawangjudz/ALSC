<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<!-- <link rel="stylesheet" href="css/cpo.css"> -->
<div class="card card-outline card-primary">
	<div class="card-header">
	<h3 class="card-title"><b><i>Closed Purchase Orders</b></i></h3>
		<!-- <div class="card-tools">
			<a href="javascript:void(0)" id="create_new" class="btn btn-flat btn-primary" style="font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Create New</a>
		</div> -->
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div id="closed-purchase-orders-table">
            <table class="table table-hover table-striped" style="text-align:center;">
                    <colgroup>
                    <col width="5%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                    <col width="15%">
                </colgroup>
                <thead>
                    <tr class="bg-navy disabled">
                        <th>#</th>
                        <th>Date Created</th>
                        <th>P.O. #</th>
                        <th>Supplier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT po.*, s.name as sname, s.id as sup_id,s.vatable,s.wt
                            FROM `po_approved_list` po
                            INNER JOIN `supplier_list` s ON po.supplier_id = s.id
                            WHERE po.status = 0 
                            GROUP BY po.po_no
                            ORDER BY po.date_created DESC;
                            ");
                            while($row = $qry->fetch_assoc()):
                                $row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
                        ?>
                            <tr>
                                <td class="text-center"><?php echo $i++; ?></td>
                                <td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
                                <td class=""><?php echo $row['po_no'] ?></td>
                                <td class=""><?php echo $row['sname'] ?></td>
                                <td align="center">
                                    <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                            Action
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
									<div class="dropdown-menu" role="menu">
										<?php if($row['vatable']==null): ?>
											<a class="dropdown-item view_supplier" href="javascript:void(0)" data-id="<?php echo $row['sup_id'] ?>">
												<span class="fa fa-edit text-danger"></span>&nbsp;&nbsp;Update Supplier
											</a>
										<?php else: ?>
											<a class="dropdown-item view_supplier" href="javascript:void(0)" data-id="<?php echo $row['sup_id'] ?>">
												<span class="fa fa-edit text-primary"></span>&nbsp;&nbsp;Update Supplier
											</a>
										<?php endif; ?>
									

										<!-- <a class="dropdown-item view_items" href="javascript:void(0)" data-id = "<?php echo $row['id'] ?>"><span class="fa fa-info text-primary"></span>&nbsp;&nbsp;Map Items</a> -->
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="?page=closed_po/items_update&id=<?php echo $row['id'] ?>"><span class="fa fa-map text-primary"></span>&nbsp;&nbsp;Items Mapping</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="?page=closed_po/cpo_setup&id=<?php echo $row['id'] ?>"><span class="fa fa-eye text-primary"></span> Create Voucher Setup</a>
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
		$('.view_item_price_history').click(function(){
			uni_modal_right("<i class='fa fa-info'></i> Price History", "po_items/item_price_history.php?id=" + $(this).attr('data-id') + "&name=" + $(this).attr('data-name'), "mid-large");
		});
		$('.delete_data').click(function(){
			_conf("Are you sure you want to delete this item permanently?","delete_item",[$(this).attr('data-id')])
		})
		$('#create_new').click(function(){
			uni_modal("<i class='fa fa-plus'></i> Create New Item","po_items/manage_item.php")
		})
		$('.view_supplier').click(function(){
			uni_modal("<i class='fa fa-info-circle'></i> Supplier's Details","closed_po/cpo_supplier_update.php?id="+$(this).attr('data-id'),"")
		})
		$('.view_items').click(function(){
			uni_modal("<i class='fa fa-info-circle'></i> Item's Details","closed_po/items_update.php?id="+$(this).attr('data-id'),"")
		})
		$('.edit_data').click(function(){
			uni_modal("<i class='fa fa-edit'></i> Edit Item's Details","po_items/manage_item.php?id="+$(this).attr('data-id'))
		})
		$('.table th,.table td').addClass('px-1 py-0 align-middle')
		$('.table').dataTable();
	})
	function delete_item($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_item",
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