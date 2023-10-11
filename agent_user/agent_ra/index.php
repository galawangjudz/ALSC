<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
    .nav-ra{
        background-color:#007bff;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-ra:hover{
		background-color:#007bff!important;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
	}
</style>
<div class="card" id="container" style="display: flex; justify-content: center;">
	<div class="navbar-menu" style="width: 100%; display: flex; justify-content: center; max-width: 1200px; margin: 0 auto;">
		<div class="dropdown">
		<a href="#" class="main_menu dropdown-toggle" id="ra-link" style="border-left: solid 3px white;" onclick="highlightLink('ralink')"><i class="nav-icon fas fa-list"></i>&nbsp;&nbsp;&nbsp;RAs List</a>
		<ul class="dropdown-menu" style="border-radius: 0px; height: 122px; margin: 2px; padding-top:2px;"> 
			<li><a href="<?php echo base_url ?>agent_user/?page=agent_sales" style="margin-top: -8px;"><i class="nav-icon fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Pendings</a></li>
			<li><a href="<?php echo base_url ?>agent_user/?page=agent_revisions"><i class="nav-icon fa fa-pen"></i>&nbsp;&nbsp;&nbsp;Revisions</a></li>
			<li><a href="<?php echo base_url ?>agent_user/?page=agent_ra" style="background-color: #E8E8E8;"><i class="nav-icon fas fa-thumbs-up"></i>&nbsp;&nbsp;&nbsp;Approved</a></li>
		</ul>
	</div>
		<a href="<?php echo base_url ?>agent_user/?page=agent_ca" class="main_menu" onclick="highlightLink('ca-link')"><i class="nav-icon fas fa-hands-helping"></i>&nbsp;&nbsp;&nbsp;Credit Assessments List</a>
		<a href="<?php echo base_url ?>agent_user/?page=agent_fa" class="main_menu" onclick="highlightLink('fa-link')"><i class="nav-icon fas fa-file"></i>&nbsp;&nbsp;&nbsp;CFO Approvals List</a>
	</div>
</div>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h3 class="card-title"><b><i>List of Approved RAs</b></i></h3>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped" style="width:100%;text-align:center;">
				<thead>
					<tr>
					<th>RA No.</th>
                    <th>Ref. No.</th>
                    <th>Location </th>
                    <th>Buyer Name </th>
					<th>Net TCP </th>
                    <th>Approval Status</th>
                    <th>Reserve Status</th>
                    <th>CA Status</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$type = $_settings->userdata('type');
						$username = $_settings->userdata('username');
						$where = "c_created_by = '$username'";
						if ($type < 5 ){
							$qry = $conn->query("SELECT * FROM t_approval_csr i inner join t_csr_view x on i.c_csr_no = x.c_csr_no 
												ORDER BY c_date_approved DESC");
						}else{
							$qry = $conn->query("SELECT * FROM t_approval_csr i inner join t_csr_view x on i.c_csr_no = x.c_csr_no 
												and ".$where." ORDER BY c_date_approved DESC");
						}
						
						while($row = $qry->fetch_assoc()):
							$i ++;
                            $ra_id = $row["ra_id"];
                            $status=$row["c_csr_status"];
                            $date_created=$row["c_date_created"];
                            $id=$row["c_csr_no"];
                            $lid = $row["c_lot_lid"];

                            $exp_date=new DateTime($row["c_duration"]);
                            $exp_date_str=$row["c_duration"];
                            $exp_date_only=date("Y-m-d",strtotime($exp_date_str));
                            //echo $exp_date_only;

                            $today_date=date('Y/m/d H:i:s');
                            $today_date_only=date("Y-m-d",strtotime($today_date));
                            //echo $today_date_only;

                            $exp=strtotime($exp_date_str);
                            $td=strtotime($today_date);
					?>
						<tr>
                        <td class="text-center"><?php echo $row["ra_id"] ?></td>
						<td class="text-center"><?php echo $row["ref_no"] ?></td>
						<td class="text-center"><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></td>
						<td class="text-center"><?php echo $row["last_name"]. ','  .$row["first_name"] .' ' .$row["middle_name"]?></td>
						<td class="text-center"><?php echo number_format($row["c_net_tcp"],2) ?></td>		

						<?php if($row['c_csr_status'] == 1 && ($row['c_reserve_status'] == 0)): ?>
							<td><span class="badge badge-success">COO Approved</span>
							<span class="badge badge-info"><b id="demo<?php echo $id ?>"></b></span></td>
						<?php elseif (($row['c_csr_status'] == 1) && ($row['c_reserve_status'] != 0)): ?>
							<td><span class="badge badge-success">COO Approved </span></td>
						<?php elseif ($row['c_csr_status'] == 2): ?>
							<td><span class="badge badge-danger">Lapsed</span>
							<span class="badge badge-danger"><b id="demo<?php echo $id ?>"></b></span></td>
						<?php elseif ($row['c_csr_status'] == 3): ?>
							<td><span class="badge badge-danger">Cancelled</span></td>
						<?php else: ?>
							<td><span class="badge badge-warning">Pending</span>
							</td>
						<?php endif; ?>

						<script>
						var countDownDate<?php echo $id ?> = new Date("<?php echo $row["c_duration"]?>").getTime();
						var x<?php echo $id ?> = setInterval(function() {
						var now<?php echo $id ?> = new Date().getTime();
						var distance<?php echo $id ?> = countDownDate<?php echo $id ?> - now<?php echo $id ?>;
						var days<?php echo $id ?> = Math.floor(distance<?php echo $id ?> / (1000 * 60 * 60 * 24));
						var hours<?php echo $id ?> = Math.floor((distance<?php echo $id ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
						var minutes<?php echo $id ?> = Math.floor((distance<?php echo $id ?> % (1000 * 60 * 60)) / (1000 * 60));
						var seconds<?php echo $id ?> = Math.floor((distance<?php echo $id ?> % (1000 * 60)) / 1000);
							
				
						if (distance<?php echo $id ?> < 0) {
							clearInterval(x<?php echo $id ?>);
							var element = document.getElementById("demo<?php echo $id ?>");
							if (element !== null) {
								element.innerHTML = "Expired";
							}
						}else{
							var element = document.getElementById("demo<?php echo $id ?>");
							if (element !== null) {
								element.innerHTML = " Time Left: " + days<?php echo $id ?>+ "d " + hours<?php echo $id ?> + "h " + minutes<?php echo $id?> + "m " + seconds<?php echo $id ?> + "s ";
								}
						
							}
						}, 1000);

						</script>
						<?php 
							$exp_date=new DateTime($row["c_duration"]);
							$exp_date_str=$row["c_duration"];
							$exp_date_only=date("Y-m-d",strtotime($exp_date_str));
					
							$today_date=date('Y/m/d H:i:s');
							$today_date_only=date("Y-m-d",strtotime($today_date));

							$exp=strtotime($exp_date_str);
							$td=strtotime($today_date);		
	
							if(($td>$exp) && ($row['c_reserve_status'] == 0)  && ($row['c_csr_status'] == 1)){
								$update_csr = $conn->query("UPDATE t_csr SET coo_approval = 2, c_active = 0 WHERE c_csr_no = '".$id."'");	
								$update_app = $conn->query("UPDATE t_approval_csr SET c_csr_status = 2 WHERE c_csr_no = '".$id."'");
								$update_lot = $conn->query("UPDATE t_lots SET c_status = 'Available' WHERE c_lid = '".$lid."'");
							}
						?> 
							
						<?php if($row['c_reserve_status'] == 1): ?>
							<td><span class="badge badge-success">Paid</span></td>
						<?php elseif($row['c_reserve_status'] == 0): ?>
							<td><span class="badge badge-warning">Unpaid</span></td>
						<?php elseif($row['c_reserve_status'] == 2): ?>
							<td><span class="badge badge-info">Partially Paid</span></td>
						<?php endif; ?>

						<?php if($row['c_ca_status'] == 1): ?>
							<td><span class="badge badge-success">CA Approved</span></td>
						<?php elseif ($row['c_ca_status'] == 0): ?>
							<td><span class="badge badge-warning">Pending</span></td>
						<?php elseif ($row['c_ca_status'] == 2): ?>
							<td><span class="badge badge-danger">Disapproved</span></td>
							<?php elseif ($row['c_ca_status'] == 3): ?>
							<td><span class="badge badge-info">For Revision</span></td>
						<?php else: ?>
							<td><span class="badge badge-danger">Expired </span></td>
						<?php endif; ?>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
	$('.table').dataTable(
		{
			"ordering": false
		}
	);	
	$('.delete_data').click(function(){
		_conf("Are you sure you want to delete this RA permanently?","delete_csr",[$(this).attr('data-id')])
	})

	$('#uni_modal').on('shown.bs.modal', function() {
		$('.select2').select2({width:'resolve'})
		$('.summernote').summernote({
			height: 200,
			toolbar: [
				[ 'style', [ 'style' ] ],
				[ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
				[ 'fontname', [ 'fontname' ] ],
				[ 'fontsize', [ 'fontsize' ] ],
				[ 'color', [ 'color' ] ],
				[ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
				[ 'table', [ 'table' ] ],
				[ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
			]
		})
	})
	})
	$('.extend_data').click(function(){
        uni_modal("<i class='fa fa-clock'></i> Extend Approval Time",'ra/extend_approval.php?id='+$(this).attr('data-id'),"mid-small")
    })

	$('.cancel_data').click(function(){
        _conf("Are you sure you want to cancel this approval?","cancel_approval",[$(this).attr('data-id'),$(this).attr('lid')])
    }) 
	function extend_approval($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=extend_coo_approval",
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
	function cancel_approval($id,$lid){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=cancel_approval",
			method:"POST",
			data:{id:$id,lid:$lid},
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