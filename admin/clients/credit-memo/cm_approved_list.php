

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
        width:100%;
        height:100%;
        margin:auto;
		margin-right:auto;
    } 
    .nav-cm {
    background-color: #007bff;
    color: white !important;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-cm:hover {
        background-color: #007bff !important;
    }
	/* Custom styles for the buttons */
	.custom-btn {
		font-size: 14px;
		padding: 5px;
		padding-bottom: 3px;
	}

	/* Specific style for the "Details" button */
	.btn-details {
		font-size: 14px;
	}

</style>
<div class="card" id="container" style="display: flex; justify-content: center;">
    <div class="navbar-menu" style="max-width: 1200px; margin: 0 auto;">
        <a href="<?php echo base_url ?>admin/?page=clients/credit-memo/cm_list" class="main_menu" style="border-left: solid 3px white;" onclick="highlightLink('res-link')">
			<i class="fa fa-clock" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Pending List
        </a>
        <a href="<?php echo base_url ?>admin/?page=clients/credit-memo/cm_approved_list" class="main_menu" id="approved-link">
			<i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Approved List
		</a>
        <a href="<?php echo base_url ?>admin/?page=clients/credit-memo/cm_disapproved_list" class="main_menu">
			<i class="fa fa-thumbs-down" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Disapproved List
        </a>
    </div>
</div>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">

		<h3 class="card-title"><b><i>Credit/Debit Memo</b></i></h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
			<div class="table-responsive">
				<table class="table table-bordered table-stripped" style="text-align:center;font-size:13px;">
					<thead>
                        <tr>
                            <th>Credit/Debit Memo #</th>
                            <th>Date</th>
                            <th>Credit/Debit Amount</th>
                            <th>Reason</th>
                            <th>Reference</th>
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
						$qry = $conn->query("SELECT * FROM t_credit_memo WHERE lvl1 = 1");
						while($row = $qry->fetch_assoc()):   
								  
                        ?>
                        <tr>
						<td><?php echo $row["cm_id"] ?></td>
						<td><?php echo $row["cm_date"] ?></td>
						<td><?php echo number_format($row["credit_amount"], 2) ?></td>
						<td><?php echo $row["reason"] ?></td>
						<td><?php echo $row["reference"] ?></td>
						
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
							<a class="btn btn-flat btn-sm view_cm btn-info btn-details" data-id="<?php echo $row['reference'] ?>">
								<i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;Details
							</a>
							<a href="<?php echo base_url ?>/report/print_cm.php?id=<?php echo $row['reference']; ?>" target="_blank" class="btn btn-flat btn-sm btn-success custom-btn">
								<i class="fas fa-print"></i>&nbsp;&nbsp;CM
							</a>
						</td>
                        </tr>
                    	<?php endwhile; ?>
						<?php        
					}elseif($usertype=='Manager'){
                        $qry = $conn->query("SELECT * FROM t_credit_memo WHERE lvl1 = 1 and lvl2 = 1");
						while($row = $qry->fetch_assoc()):   
									  
							?>
							<tr>
						<td><?php echo $row["cm_id"] ?></td>
						<td><?php echo $row["cm_date"] ?></td>
						<td><?php echo number_format($row["credit_amount"], 2) ?></td>
						<td><?php echo $row["reason"] ?></td>
						<td><?php echo $row["reference"] ?></td>
						
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
							<a class="btn btn-flat btn-sm view_cm btn-info btn-details" data-id="<?php echo $row['reference'] ?>">
								<i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;Details
							</a>
							<a href="<?php echo base_url ?>/report/print_cm.php?id=<?php echo $row['reference']; ?>" target="_blank" class="btn btn-flat btn-sm btn-success custom-btn">
								<i class="fas fa-print"></i>&nbsp;&nbsp;CM
							</a>
						</td>
                        </tr>
							<?php endwhile; ?>
							<?php        
							}elseif($usertype=='CFO' || $usertype=='IT Admin'){
								//$qry = $conn->query("SELECT y.*, z.* FROM t_av_summary AS y INNER JOIN property_clients AS z ON y.property_id = z.property_id WHERE y.lvl1 = 0");
								$qry = $conn->query("SELECT * FROM t_credit_memo WHERE lvl1 = 1 and lvl2 = 1 and lvl3 = 1");
								while($row = $qry->fetch_assoc()):   
										  
								?>
								<tr>
                                <td><?php echo $row["cm_id"] ?></td>
                                <td><?php echo $row["cm_date"] ?></td>
                                <td><?php echo number_format($row["credit_amount"], 2) ?></td>
                                <td><?php echo $row["reason"] ?></td>
                                <td><?php echo $row["reference"] ?></td>
                                
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
									<a class="btn btn-flat btn-sm view_cm btn-info btn-details" data-id="<?php echo $row['reference'] ?>">
										<i class="fa fa-info-circle" aria-hidden="true"></i>&nbsp;&nbsp;Details
									</a>
									<a href="<?php echo base_url ?>/report/print_cm.php?id=<?php echo $row['reference']; ?>" target="_blank" class="btn btn-flat btn-sm btn-success custom-btn">
										<i class="fas fa-print"></i>&nbsp;&nbsp;CM
									</a>
								</td>
                                </tr>
								<?php endwhile; ?>
								<?php        
							}
						?>
					</tbody>
				</table>
			</div>                     
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
$('.view_cm').click(function(){
	uni_modal_2('<i class="fa fa-eye" aria-hidden="true"></i>&nbsp;&nbsp;View Credit/Debit Memo', 'clients/credit-memo/cm_modal.php?id=' + $(this).attr('data-id'), 'mid-large');
})
$('.approved_cm').click(function(){
    _conf("Are you sure you want to approve this application voucher?", "approved_cm", [$(this).attr('data-id'),$(this).attr('value')]);
})
$('.disapproved_cm').click(function(){
	_conf("Are you sure you want to disapprove this application voucher?","disapproved_cm",[$(this).attr('data-id'),$(this).attr('value')]);
}) 
function approved_cm($data_id,$value){
	start_loader();
	$.ajax({
		url:_base_url_+"classes/Master.php?f=cm_approval",
		method:"POST",
		data:{data_id: $data_id, value: $value},
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
function disapproved_cm($data_id,$value){
	start_loader();
	$.ajax({
		url:_base_url_+"classes/Master.php?f=cm_disapproval",
		method:"POST",
		data:{data_id: $data_id, value: $value},
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