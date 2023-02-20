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
	}
	.navbar{
		width:100%;
		height:auto;
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
	#fa-link{
		border-bottom: solid 2px blue;
		background-color:#F5F5F5;
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
</style>

<div class="card" id="container">
    <div class="navbar-menu">
		<div class="dropdown">
			<a href="#" class="main_menu dropdown-toggle" id="ra-link" onclick="highlightLink('ralink')">RA List</a>
				<ul class="dropdown-menu">
					<li><a href="<?php echo base_url ?>admin/?page=sales">Pending</a></li>
					<li><a href="<?php echo base_url ?>admin/?page=revision">Revision</a></li>
					<li><a href="<?php echo base_url ?>admin/?page=ra">Approved</a></li>
				</ul>
		</div>
		<a href="<?php echo base_url ?>admin/?page=reservation" class="main_menu" id="res-link" onclick="highlightLink('res-link')">Reservation List</a>
		<a href="<?php echo base_url ?>admin/?page=credit_assestment" class="main_menu" id="ca-link" onclick="highlightLink('ca-link')">Credit Assessment List</a>
		<a href="<?php echo base_url ?>admin/?page=final_approval" class="main_menu" id="fa-link" onclick="highlightLink('fa-link')">CFO Approval List</a>
		<a href="<?php echo base_url ?>admin/?page=clients/property_list" class="main_menu" id="pl-link" onclick="highlightLink('pl-link')">Property Accounts</a>
	</div>
</div>


<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
		<h3 class="card-title">CFO Approval List</h3>
		
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="container-fluid">
			<table class="table table-bordered table-stripped">
	 
				<thead>
					<tr>
                    <th>RA No.</th>
					<th>Ref. No.</th>
                    <th>Location </th>
                    <th>Buyer Name </th>
                    <th>CFO Status</th>
					<?php if ($usertype == "IT Admin" || $usertype == 'CFO'): ?>	
                    <th>Actions</th>
					<?php endif; ?>
					</tr>
				</thead>
				<tbody>
					<?php 
					$i = 1;
						$qry = $conn->query("SELECT * FROM t_approval_csr i inner join t_csr_view x on i.c_csr_no = x.c_csr_no where c_ca_status = 1 ORDER BY c_date_approved");
						while($row = $qry->fetch_assoc()):
							$i ++;
                            $ra_id = $row["ra_id"];
                            $status=$row["c_csr_status"];
                            $date_created=$row["c_date_created"];
                            $id=$row["c_csr_no"];
                            $lid = $row["c_lot_lid"];


						
					?>
						<tr>
                            <td class="text-center"><?php echo $row["ra_id"] ?></td>
                            <td class="text-center"><?php echo $row["ref_no"] ?></td>
                            <td class="text-center"><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></td>
                            <td class="text-center"><?php echo $row["last_name"]. ','  .$row["first_name"] .' ' .$row["middle_name"]?></td>


							<?php if ($row['cfo_status'] == 0): ?>
                                <td><span class="badge badge-warning">Pending</span>
                            <?php elseif($row['cfo_status'] == 1): ?>
                                <td><span class="badge badge-success">Booked</span></td>
                            <?php endif; ?>
						
							<?php if (($usertype == "IT Admin" || $usertype == 'CFO') && $row['cfo_status'] == 0 ): ?>	
							<td align="center">
								 <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
				                  		Action
				                    <span class="sr-only">Toggle Dropdown</span>
				                  </button>
				                  <div class="dropdown-menu" role="menu">
				                    <a class="dropdown-item booked_data" ra-id = "<?php echo $row['ra_id']?>" csr_id = "<?php echo $row['c_csr_no']?>" data-lot-id="<?php echo $row['c_lot_lid'] ?>"><span class="fa fa-check text-primary"></span> Approved</a>
								 </div>
							</td>
							<?php else: ?>
								<td align="center">
									---
								</td>	
							<?php endif; ?>	
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
		$('.booked_data').click(function(){
			_conf("Are you sure to booked this RA?","cfo_approval",[$(this).attr('ra-id'),$(this).attr('csr_id'),$(this).attr('data-lot-id')])
		}) 
	})	
	function cfo_approval($ra_id,$csr_no,$lid){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=cfo_booked",
			method:"POST",
			data:{ra_id:$ra_id,csr_no:$csr_no,lid:$lid},
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




	$(document).ready(function(){
		
		$('.table').dataTable(
			{"ordering":false}
		);
		
	})

</script>