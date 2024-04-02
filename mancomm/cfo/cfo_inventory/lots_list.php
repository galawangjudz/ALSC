<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
    .nav-lot{
        background-color:#007bff;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-lot:hover{
		background-color:#007bff!important;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
	}
</style>
<?php
// $usertype = $_settings->userdata('user_type');
// if (!isset($usertype)) {
//     include '404.html';
//   exit;
// }
// $user_role = $usertype;
// if ($user_role != 'CFO') {
//     include '404.html';
//   exit;
// }
?>
<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title"><b><i>Lots List</b></i></h5>
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
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT c_lid, c_acronym, c_block, c_lot, c_lot_area, c_price_sqm, i.c_status
                            FROM t_lots i 
                            JOIN t_projects c 
                            ON i.c_site = c.c_code
                            WHERE i.c_site = c.c_code  
                            ORDER BY c.c_acronym, i.c_block, i.c_lot");
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
</script>