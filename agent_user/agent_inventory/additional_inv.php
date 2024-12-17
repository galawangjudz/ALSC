<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
    .nav-add-inv{
        background-color:#007bff;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-add-inv:hover{
		background-color:#007bff!important;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
	}
</style>

<div class="card card-outline rounded-0 card-maroon">
        <div class="card-header">
			<h5 class="card-title"><b><i>Privilege Lot List</b></i></h5>
			    <div class="card-tools">
                    <a class="btn btn-block btn-primary btn-flat border-primary add_privilege" href="javascript:void(0)" style="font-size:14px;"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add New</a>
			    </div> 
		</div>
		<div class="card-body">
            <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
                    <thead>
                        <tr>
                        <th>Lot ID</th>
                        <th>Phase</th>
                        <th>Block</th>
                        <th>Lot</th>
                        <th>Lot Area</th>
                        <th>Price SQM</th>
                        <th>Status</th>
                        <th>Assigned to</th>
                        <th>Created at</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        /* $i = 1;
                            $qry = $conn->query("SELECT c_lid, c_acronym, c_block, c_lot, c_lot_area, c_price_sqm, i.c_status
                            FROM t_lots i 
                            JOIN t_projects c 
                            ON i.c_site = c.c_code
                            WHERE i.c_site = c.c_code  and (i.c_status = 'Sold' or i.c_status = 'Packaged')
                            ORDER BY c.c_acronym, i.c_block, i.c_lot");
                            while($row = $qry->fetch_assoc()):    */
                            $i = 1;
                            $qry = $conn->query("SELECT 
                                i.c_lid, 
                                c.c_acronym, 
                                i.c_block, 
                                i.c_lot, 
                                i.c_lot_area, 
                                i.c_price_sqm, 
                                i.c_status,
                                a.c_agent_code,
                                a.c_created_at
                            FROM 
                                t_additional_inventory a
                            LEFT JOIN 
                                t_lots i 
                                ON a.c_lot_lid = i.c_lid
                            LEFT JOIN 
                                t_projects c 
                                ON i.c_site = c.c_code
                            WHERE 
                                i.c_status IN ('Sold', 'Packaged')
                            ORDER BY 
                                c.c_acronym, i.c_block, i.c_lot
                            ");
                            while($row = $qry->fetch_assoc()):
                        ?>
                        <tr>
                        <td><?php echo $row["c_lid"] ?></td>
                        <td><?php echo $row["c_acronym"] ?></td>
                        <td><?php echo $row["c_block"] ?></td>
                        <td><?php echo $row["c_lot"] ?></td>
                        <td><?php echo $row["c_lot_area"] ?></td>
                        <td><?php echo number_format($row["c_price_sqm"],2) ?></td>
                        <?php if($row['c_status'] == "Available"): ?>
                           <td class="text-center"><span class=" badge badge-primary">Available</span></td>
                        <?php elseif($row['c_status'] == "Reserved"): ?>
                           <td class="text-center"><span class=" badge badge-success">Reserved</span></td>
                        <?php elseif($row['c_status'] == "Pre-Reserved"): ?>
                           <td class="text-center"><span class=" badge badge-info">Pre-Reserved</span></td>
                        <?php elseif($row['c_status'] == "On Hold"): ?>
                          <td class="text-center"><span class="badge badge-secondary">On Hold</span></td>
                        <?php elseif($row['c_status'] == "Packaged"): ?>
                            <td class="text-center"><span class=" badge badge-warning">Packaged</span></td>
                        <?php elseif($row['c_status'] == "Sold"): ?>
                           <td class="text-center"><span class=" badge badge-danger">Sold</span></td>
                        <?php endif; ?>
                        <td><?php echo $row["c_agent_code"] ?></td>
                        <td><?php echo $row["c_created_at"] ?></td>
                        <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item edit_data" data-id="<?php echo $row['c_code'] ?>"><span class="fa fa-edit text-primary"></span> Edit</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item delete_data" data-id="<?php echo $row['c_code'] ?>"><span class="fa fa-trash text-danger"></span> Delete</a>
                                </div>
                                
                        </td>
                        </tr>
                    <?php endwhile; ?>
                    </tbody></table>
	            </div>                
            </div>
	</div>
<script>
    $(document).ready(function(){
		$('.table').dataTable();
	})

    $('.add_privilege').click(function(){
        uni_modal("<i class='fa fa-plus'></i> New Privilege",'agent_inventory/privilege_inv.php',"mid-large")
    })

</script>