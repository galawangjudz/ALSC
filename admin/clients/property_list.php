

<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
	.nav-prop-list{
		background-color:#007bff;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
	}
	.nav-prop-list:hover{
		background-color:#007bff!important;
		color:white!important;
		box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
	}
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
	.dropdown1:hover .dropdown-menu1 {
		display: block;
		margin-top:40px;
		float:left;
		width:227px;
		height:130px;
		line-height:30px;
		text-align:center;
		color:black!important;
	}

	.dropdown-menu1 li a{
		color:black!important;
		border:gainsboro 1px solid;
		display: block;
		height:40px;
		line-height:40px;
	}
	.dropdown-menu1 li a:hover{
		color:black!important;
		border:gainsboro 1px solid;
		display: block;
		height:40px;
		line-height:40px;
		background-color:#E8E8E8;
	}
</style>
<div class="card" id="container" style="display: flex; justify-content: center;">
    <div class="navbar-menu" style="width:100%; margin-left: auto; margin-right: auto; max-width: 1200px;">
		<div class="dropdown">
			<a href="#" class="main_menu dropdown-toggle" style="border-left:solid 3px white;" onclick="highlightLink('ralink')"><i class="nav-icon fas fa-list"></i>&nbsp;&nbsp;&nbsp;RA List</a>
				<ul class="dropdown-menu" style="border-radius:0px;height:122px;">
					<li><a href="<?php echo base_url ?>admin/?page=sales" style="margin-top:-8px;"><i class="nav-icon fas fa-clock"></i>&nbsp;&nbsp;&nbsp;Pending</a></li>
					<li><a href="<?php echo base_url ?>admin/?page=revision"><i class="nav-icon fa fa-pen"></i>&nbsp;&nbsp;&nbsp;Revision</a></li>
					<li><a href="<?php echo base_url ?>admin/?page=ra"><i class="nav-icon fas fa-thumbs-up"></i>&nbsp;&nbsp;&nbsp;Approved</a></li>
				</ul>
		</div>
		<?php if ($usertype == 'IT Admin' || $usertype == 'Cashier' || $usertype == 'Billing'){ ?>
		<a href="<?php echo base_url ?>admin/?page=reservation" class="main_menu" id="res-link" onclick="highlightLink('res-link')"><i class="nav-icon fas fa-calendar"></i>&nbsp;&nbsp;&nbsp;Reservation List</a>
		
		<?php }else{ ?>
		<a href="<?php echo base_url ?>admin/?page=reservation" class="main_menu" id="res-link1" onclick="highlightLink('res-link')"><i class="nav-icon fas fa-calendar"></i>&nbsp;&nbsp;&nbsp;Reservation List</a>
		<?php } ?>
		
		<a href="<?php echo base_url ?>admin/?page=credit_assestment" class="main_menu" id="ca-link" onclick="highlightLink('ca-link')"><i class="nav-icon fas fa-hands-helping"></i>&nbsp;&nbsp;&nbsp;Credit Assessment List</a>
		<a href="<?php echo base_url ?>admin/?page=final_approval" class="main_menu" id="fa-link" onclick="highlightLink('fa-link')"><i class="nav-icon fas fa-file"></i>&nbsp;&nbsp;&nbsp;CFO Approval List</a>
		
		<div class="dropdown" style="position: relative;">
			<a href="#" class="main_menu dropdown-toggle" id="ra-link" onclick="highlightLink('ralink')"><i class="nav-icon fas fa-home"></i>&nbsp;&nbsp;&nbsp;Property Accounts</a>
				<ul class="dropdown-menu" style="position: absolute; right: 0; transform: translateX(400%);height:122px;border-radius:0px;">
					<li><a href="<?php echo base_url ?>admin/?page=clients/property_list" style="margin-top:-8px;"><i class="nav-icon fas fa-check-circle"></i>&nbsp;&nbsp;&nbsp;Active</a></li>
					<li><a href="<?php echo base_url ?>admin/?page=transfer"><i class="fa fa-retweet" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Reopen</a></li>
					<li><a href="<?php echo base_url ?>admin/?page=backout"><i class="fa fa-archive" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Backout</a></li>
				</ul>
		</div>
	</div>
</div>

<div class="card card-outline rounded-0 card-green">
		<div class="card-header">
			<h5 class="card-title"><b><i>List of Active Accounts</b></i></h5>
			<!-- <div class="card-tools">
				<a class="btn btn-block btn-sm btn-primary btn-flat border-primary new_lot" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
			</div> -->
		</div>
		<div class="card-body">
            <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped" style="text-align:center;">
                    <thead>
                        <tr class="bg-gradient-success text-light">
                        <?php if ($usertype == 'IT Admin' || $usertype == 'Cashier' || $usertype == 'Billing'): ?>
				        <th>Actions</th>
                        <?php endif?>
                        <th>Property ID</th>
                        <th>Client Name</th>
                        <th>Location</th>
                        <th>Net TCP</th>
						<th>Account Status</th>
                
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT x.property_id, CONCAT_WS(' ',y.first_name, y.last_name) as full_name, x.c_net_tcp,x.c_account_status,  q.c_acronym, 
                            z.c_block, z.c_lot FROM properties x, property_clients y , t_lots z, t_projects q WHERE 
                            x.property_id = y.property_id
                            and x.c_lot_lid = z.c_lid 
                            and z.c_site = q.c_code and x.c_active = 1 and x.c_reopen = 0 ORDER BY x.c_date_of_sale DESC") ;
                            while($row = $qry->fetch_assoc()):
                                
                        ?>
                        <tr>
                        <?php if ($usertype == 'IT Admin' || $usertype == 'Cashier' || $usertype == 'Billing'): ?>
                        <td align="center">
                                <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                    Action
                                <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">
                                <a class="dropdown-item view-data" href="./?page=clients/property&id=<?php echo md5($row['property_id']) ?>"><span class="fa fa-eye text-success"></span> View</a>   
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item backout" data-lot-id="<?php echo $row['property_id'] ?>"><span class="fa fa-edit text-primary  "></span> Edit</a>
                                </div>
                        </td>
                        <?php endif; ?>
                        <?php 
                        $property_id = $row["property_id"];
                        $property_id_part1 = substr($property_id, 0, 2);
                        $property_id_part2 = substr($property_id, 2, 8);
                        $property_id_part3 = substr($property_id, 10, 3);
                        ?>
                        <td><?php echo $property_id_part1 . "-" . $property_id_part2 . "-" . $property_id_part3 ?></td>
                        <td><?php echo $row["full_name"] ?></td>
                        <td><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></td>
                        <td><?php echo number_format($row["c_net_tcp"],2) ?></td>
						<td><?php echo $row["c_account_status"] ?></td>
                    
                    
                        </tr>
                    <?php endwhile; ?>
                    </tbody></table>
           
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
</script>