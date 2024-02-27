<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
	.nav-cl{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-cl:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
</style>
<div class="card card-outline rounded-0 card-maroon">
		<div class="card-header">
			<h5 class="card-title"><b><i>Check List</b></i></h5>
		</div>
		<div class="card-body">
            <div class="container-fluid">
            <div class="container-fluid">
                	<table class="table table-bordered table-stripped" id="data-table" style="text-align:center;width:100%;">
						<!-- <colgroup>
							<col width="5%">
							<col width="20%">
							<col width="20%">
							<col width="25%">
							<col width="15%">
						</colgroup> -->
						<thead>
							<tr>
							<th>#</th>
							<th>CV #</th>
							<th>Voucher #</th>
							<th>ID/Code</th>
							<th>Date Created</th>
							<th>Check Date</th> 
                            <th>Check #</th> 
                            <th>Name</th> 
                            <th>Status</th> 
                            <th>Date Claimed</th> 
							</tr>
						</thead>
						<tbody>
                            <?php 
                                $i = 1;

                                $qry = $conn->query("SELECT * FROM cv_entries;");

                                while ($row = $qry->fetch_assoc()):
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i++; ?></td>
                                    <td class=""><?php echo $row['c_num'] ?></td>
                                    <td class=""><?php echo $row['v_num'] ?></td>
                                    <td class=""><?php echo $row['supplier_id'] ?></td>
                                    <td class=""><?php echo $row['cv_date'] ?></td>
                                    <td class=""><?php echo $row['check_date'] ?></td>
                                    <td class=""><?php echo $row['check_num'] ?></td>
                                    <td class=""><?php echo $row['check_name'] ?></td>
                                    <td class="">
                                        <?php 
                                            switch($row['c_status']){
                                                case 0:
                                                    echo '<span class="badge badge-danger bg-gradient-danger px-3 rounded-pill">Unclaimed</span>';
                                                    break;
                                                case 1:
                                                    echo '<span class="badge badge-primary bg-gradient-primary px-3 rounded-pill">Claimed</span>';
                                                    break;
                                                default:
                                                    echo '<span class="badge badge-default border px-3 rounded-pill">N/A</span>';
                                                    break;
                                            }
                                        ?>
                                    </td>
                                    
                                    <td class="">
                                        <?php 
                                            echo ($row['c_status'] == 0) ? '-' : $row['date_updated'];
                                        ?>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                   </table>
	            </div>                
            </div>
	</div>
<script>
    $(document).ready(function(){
		$('.table').dataTable();
	})
	$('.table td, .table th').addClass('py-1 px-2 align-middle')
	$('.table').dataTable({
		columnDefs: [
			{ orderable: false, targets: 5 }
		],
	});

</script>