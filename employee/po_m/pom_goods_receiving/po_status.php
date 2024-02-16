<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
.nav-monitoring {
    background-color: #007bff;
    color: white!important;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
}
.nav-monitoring:hover {
    background-color: #007bff!important;
    color: white!important;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
}
</style>
<!-- <link rel="stylesheet" href="css/cpo.css"> -->
<div class="card card-outline card-primary">
	<div class="card-header">
	<h3 class="card-title"><b><i>Closed Purchase Orders</b></i></h3><br>
	<hr>
	<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
	<tr>
		<td>
			<h3 class="card-title"><b><i>Approval Status</b></i></h3><br>
			<hr>
			<div style="color:red; font-weight:bold; font-style:italic;"><span class="badge badge-danger"><i class="fa fa-hourglass-half" aria-hidden="true"></i></span> - Pending for Approvals</div>
			<div style="color:blue; font-weight:bold; font-style:italic;"><span class="badge badge-primary"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> - Purchasing Supervisor Approved</div>
			<div style="color:green; font-weight:bold; font-style:italic;"><span class="badge badge-success"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> - Finance Manager Approved</div>
			<div style="color:gray; font-weight:bold; font-style:italic;"><span class="badge badge-secondary"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> - Chief Finance Officer Approved</div>
		</td>
		<td>
			<h3 class="card-title"><b><i>Delivery Status</b></i></h3><br>
			<hr>
			<div style="color:red; font-weight:bold; font-style:italic;"><span class="badge badge-danger"><i class="fa fa-truck" aria-hidden="true"></i></span> - Still to be delivered</div>
			<div style="color:blue; font-weight:bold; font-style:italic;"><span class="badge badge-primary"><i class="fa fa-truck" aria-hidden="true"></i></span> - Successfully delivered</div>
            <div style="color:red; font-weight:bold; font-style:italic;"><span class="badge badge-danger" style="background-color:transparent;">   </span></div>
			<div style="color:blue; font-weight:bold; font-style:italic;"><span class="badge badge-primary" style="background-color:transparent;">   </span></div>
        </td>
	</tr>
	</table>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div id="closed-purchase-orders-table">
        <table class="table table-bordered table-stripped" style="width:100%;text-align:center;">
            <colgroup>
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="35%">
                <col width="20%">
                <col width="10%">
                <col width="5%">
                <!-- <col width="7%"> -->
            </colgroup>
            <thead>
                <tr class="bg-navy disabled">
                    <th>#</th>
                    <th>Date Created</th>
                    <th>PO #</th>
                    <th>Supplier</th>
                    <th>Requesting Dept.</th>
                    <th>Total Amount</th>
                    <th>Status</th>
                    <!-- <th>Action</th> -->
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                $qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id order by po.date_created DESC");
                while($row = $qry->fetch_assoc()):
                    $row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
                    $row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
                
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
                        if ($row['status'] == '1' && $row['status2'] == '0' && $row['status3'] == '0') {
                            echo '<span class="badge badge-primary"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>';
                        } elseif ($row['status'] == '1' && $row['status2'] == '1' && $row['status3'] == '0') {
                            echo '<span class="badge badge-success"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>';
                        } elseif ($row['status'] == '1' && $row['status2'] == '1' && $row['status3'] == '1') {
                            echo '<span class="badge badge-secondary"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span>';
                        } else {
                            echo '<span class="badge badge-danger"><i class="fa fa-hourglass-half" aria-hidden="true"></i></span>';
                        }
                        ?>
                        <?php 
                        $qry_approved = $conn->query("SELECT * FROM `po_approved_list` WHERE id='{$row['id']}'");
                        while($row_approved = $qry_approved->fetch_assoc()):
                            if ($row_approved['status']=='0'){
                                echo '<span class="badge badge-primary"><i class="fa fa-truck" aria-hidden="true"></i> </span>';
                            } else {
                                echo '<span class="badge badge-danger"><i class="fa fa-truck" aria-hidden="true"></i></span>';
                            }
                        endwhile;
                        ?>
                    </td>

                    <!-- <td align="center">
                        <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                            Action
                            <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                            <?php 
                            if ($row['fpo_status'] != '3'){?>
                                <a class="dropdown-item" href="?page=po_purchase_orders/manage_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                            <?php } else{ ?>
                                <a class="dropdown-item" href="?page=po_purchase_orders/verify_po&id=<?php echo $row['id'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                            <?php } ?>
                            <?php if ($row['fpo_status'] != '3'){?>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                            <?php }?>
                        </div>
                    </td> -->
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
        $('.table th, .table td').addClass('px-1 py-0 align-middle');
        $('#closed-purchase-orders-table table').DataTable({
            "paging": true,      
            "lengthChange": true, 
            "searching": true,   
            "ordering": true,    
            "info": true,        
            "autoWidth": false  
        });
    });
</script>
