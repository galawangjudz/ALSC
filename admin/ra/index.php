<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
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
	#ra-link{
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

</style>
<div class="card" id="container">
    <div class="navbar-menu">
		<div class="dropdown">
			<a href="#" class="main_menu dropdown-toggle" id="ra-link" style="border-left:solid 3px white;" onclick="highlightLink('ralink')"><i class="nav-icon fas fa-list"></i>&nbsp;&nbsp;&nbsp;RA List</a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo base_url ?>admin/?page=sales"><i class="nav-icon fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Pending</a></li>
					<li><a href="<?php echo base_url ?>admin/?page=revision"><i class="nav-icon fa fa-pen"></i>&nbsp;&nbsp;&nbsp;Revision</a></li>
					<li><a href="<?php echo base_url ?>admin/?page=ra"><i class="nav-icon fas fa-thumbs-up"></i>&nbsp;&nbsp;&nbsp;Approved</a></li>
				</ul>
		</div>
		<?php if ($usertype == "IT Admin" || $usertype == 'Cashier'){ ?>
		<a href="<?php echo base_url ?>admin/?page=reservation" class="main_menu" id="res-link" onclick="highlightLink('res-link')"><i class="nav-icon fas fa-calendar"></i>&nbsp;&nbsp;&nbsp;Reservation List</a>
		
		<?php }else{ ?>
		<a href="<?php echo base_url ?>admin/?page=reservation" class="main_menu" id="res-link1" onclick="highlightLink('res-link')"><i class="nav-icon fas fa-calendar"></i>&nbsp;&nbsp;&nbsp;Reservation List</a>
		<?php } ?>
		
		<a href="<?php echo base_url ?>admin/?page=credit_assestment" class="main_menu" id="ca-link" onclick="highlightLink('ca-link')"><i class="nav-icon fas fa-hands-helping"></i>&nbsp;&nbsp;&nbsp;Credit Assessment List</a>
		<a href="<?php echo base_url ?>admin/?page=final_approval" class="main_menu" id="fa-link" onclick="highlightLink('fa-link')"><i class="nav-icon fas fa-file"></i>&nbsp;&nbsp;&nbsp;CFO Approval List</a>
		<a href="<?php echo base_url ?>admin/?page=clients/property_list" class="main_menu" id="pl-link" onclick="highlightLink('pl-link')"><i class="nav-icon fas fa-home"></i>&nbsp;&nbsp;&nbsp;Property Accounts</a>
	</div>
</div>

<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h3 class="card-title">List of Approved RA</h3>
		
	</div>
	<div class="card-body">
	
        <div class="container-fluid">
			<table class="table table-bordered table-stripped " >
			<!-- 	<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="15%">
					<col width="20%">
					<col width="30%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
					<col width="15%">
				</colgroup> -->
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
                    <th>Actions</th>
				
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
						// Set the date we're counting down to
						var countDownDate<?php echo $id ?> = new Date("<?php echo $row["c_duration"]?>").getTime();

						// Update the count down every 1 second
						var x<?php echo $id ?> = setInterval(function() {

						// Get today's date and time
						var now<?php echo $id ?> = new Date().getTime();
						
						// Find the distance between now and the count down date
						var distance<?php echo $id ?> = countDownDate<?php echo $id ?> - now<?php echo $id ?>;
						
						// Time calculations for hours, minutes and seconds
						var days<?php echo $id ?> = Math.floor(distance<?php echo $id ?> / (1000 * 60 * 60 * 24));
						var hours<?php echo $id ?> = Math.floor((distance<?php echo $id ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
						var minutes<?php echo $id ?> = Math.floor((distance<?php echo $id ?> % (1000 * 60 * 60)) / (1000 * 60));
						var seconds<?php echo $id ?> = Math.floor((distance<?php echo $id ?> % (1000 * 60)) / 1000);
							
						
						// Display the result in the element with id="demo"
						
						document.getElementById("demo<?php echo $id ?>").innerHTML = " Time Left: " + days<?php echo $id ?>+ "d " + hours<?php echo $id ?> + "h " + minutes<?php echo $id?> + "m " + seconds<?php echo $id ?> + "s ";
						
						// If the count down is finished, write some text
						if (distance<?php echo $id ?> < 0) {
							clearInterval(x<?php echo $id ?>);
							document.getElementById("demo<?php echo $id ?>").innerHTML = " Expired";
						
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
								$update_csr = $conn->query("UPDATE t_csr SET coo_approval = 2 WHERE c_csr_no = '".$id."'");	
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
				
					
						<td align="center">
								<button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
									Action
								<span class="sr-only">Toggle Dropdown</span>
								</button>
								<div class="dropdown-menu" role="menu">
								<a class="dropdown-item view_data" href="./?page=ra/ra-view&id=<?php echo md5($row['c_csr_no']) ?>"><span class="fa fa-eye text-primary"></span> View</a>
								
								
								<?php if (($usertype == 'IT Admin' || $usertype == 'COO')): ?>	
									<div class="dropdown-divider"></div>
									<a class="dropdown-item extend_data" href="javascript:void(0)" data-id ="<?php echo $row['c_csr_no']?>"><span class="fa fa-hourglass text-success"></span> Extend</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item cancel_data"  href="javascript:void(0)" lid="<?php echo $row['c_lot_lid']?>" data-id ="<?php echo $row['c_csr_no']?>"><span class="fa fa-stop-circle text-danger"></span> Cancel</a>
									
								<?php endif ; ?>
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
	$('.table').dataTable(
		{
			"ordering": false
		}
	);	


	$('.delete_data').click(function(){
		_conf("Are you sure to delete this RA permanently?","delete_csr",[$(this).attr('data-id')])
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
        _conf("Are you sure to cancel this Approval?","cancel_approval",[$(this).attr('data-id'),$(this).attr('lid')])
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