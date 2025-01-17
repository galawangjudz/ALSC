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
.table{
    font-size: 12px!important;
}
</style>
<!-- <link rel="stylesheet" href="css/cpo.css"> -->
<div class="card-outline card-primary">
	<div class="card-header">
	<h3 class="card-title"><b><i>PO Monitoring</b></i></h3><br>
	<hr>
	<table id="data-table" class="table-responsive-sm table-striped table-bordered">
	<tr>
        <td style="padding: 10px;">
			<h3 class="card-title"><b><i>Approval Status</b></i></h3><br>
			<hr>
			<div style="color:red; font-weight:bold; font-style:italic;"><span class="badge badge-danger"><i class="fa fa-hourglass-half" aria-hidden="true"></i></span> - Pending for Approvals</div>
			<div style="color:blue; font-weight:bold; font-style:italic;"><span class="badge badge-primary"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> - Purchasing Supervisor Approved</div>
			<div style="color:green; font-weight:bold; font-style:italic;"><span class="badge badge-success"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> - Finance Manager Approved</div>
			<div style="color:gray; font-weight:bold; font-style:italic;"><span class="badge badge-secondary"><i class="fa fa-thumbs-up" aria-hidden="true"></i></span> - Chief Finance Officer Approved</div>
		</td>
		<td style="padding: 10px;">
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
        <div class="table-responsive" style="overflow-x: auto;">
            <div id="closed-purchase-orders-table">
            <table class="table table-bordered table-striped" id="data-table" style="text-align: center; width: auto; min-width: 1000px;width:100%">
                    <thead>
                        <tr class="bg-navy disabled">
                            <th>#</th>
                            <th>Date Created</th>
                            <th>PO #</th>
                            <th>Supplier</th>
                            <th>Requesting Dept.</th>
                            <th>Remaining Balance</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        $qry = $conn->query("SELECT po.*, s.name as sname FROM `po_list` po inner join `supplier_list` s on po.supplier_id = s.id order by po.date_created DESC");
                        while($row = $qry->fetch_assoc()):
                            $row['item_count'] = $conn->query("SELECT * FROM order_items where po_id = '{$row['id']}'")->num_rows;
                            $row['total_amount'] = $conn->query("SELECT sum(quantity * unit_price) as total FROM order_items where po_id = '{$row['id']}'")->fetch_array()['total'];
                            $result = $conn->query("SELECT o.date_purchased, g.doc_no, g.gr_id, g.po_id, SUM(o.outstanding * o.unit_price) AS rem_bal
                            FROM tbl_gr_list g
                            INNER JOIN approved_order_items o ON g.gr_id = o.gr_id
                            WHERE g.po_id = '{$row['id']}'
                            GROUP BY g.gr_id, g.po_id
                            ORDER BY g.gr_id DESC
                            LIMIT 1");
                                if ($result && $result->num_rows > 0) {
                                    $row_rem_bal = $result->fetch_assoc();

                                    $row['rem_bal'] = $row_rem_bal['rem_bal'];
                                } else {
                                    $row['rem_bal'] = $row['total_amount']; 
                                }
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class=""><?php echo date("M d,Y H:i",strtotime($row['date_created'])) ; ?></td>
                            <td class=""><?php echo $row['po_no'] ?></td>
                            <td class=""><?php echo $row['sname'] ?></td>
                            <td class=""><?php echo $row['department'] ?></td>
                            <td class="text-right"><?php echo number_format($row['rem_bal'],2) ?></td>
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
                            <td align="center">
                                <?php $qry_get_gr = $conn->query("SELECT g.*, o.* FROM tbl_gr_list g INNER JOIN approved_order_items o ON g.gr_id = o.gr_id WHERE g.po_id = '" . $row['id'] . "'"); ?>
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown" <?php echo ($qry_get_gr->num_rows == 0) ? 'disabled' : ''; ?>>
                                    Action
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                    <?php
                                    
                                    if ($qry_get_gr->num_rows > 0) {
                                        echo "<a class='dropdown-item gr-list' gr-id='" . $row["id"] . "'><span class='fa fa-list text-primary'></span> GR List</a>";
                                    }
                                    ?>                                            
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
    $('.gr-list').click(function(){
		uni_modal_right("GR List",'pom_goods_receiving/gr_list.php?id='+$(this).attr('gr-id'),"mid-large")
	})
</script>
