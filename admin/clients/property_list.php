

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
	#pl-link{
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
			<h5 class="card-title">Properties</h5>
			<!-- <div class="card-tools">
				<a class="btn btn-block btn-sm btn-primary btn-flat border-primary new_lot" href="javascript:void(0)"><i class="fa fa-plus"></i> Add New</a>
			</div> -->
		</div>
		<div class="card-body">
            <div class="container-fluid">
            <div class="container-fluid">
                <table class="table table-bordered table-stripped" >
                    <thead>
                        <tr>
                        <?php if ($usertype == 'IT Admin'): ?>
				        <th>Actions</th>
                        <?php endif?>
                        <th>Property ID</th>
                        <th>Client Name</th>
                        <th>Location</th>
                        <th>Net TCP</th>
                
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                        $i = 1;
                            $qry = $conn->query("SELECT x.property_id, CONCAT_WS(' ',y.first_name, y.last_name) as full_name, x.c_net_tcp,  q.c_acronym, 
                            z.c_block, z.c_lot FROM properties x, property_clients y , t_lots z, t_projects q WHERE 
                            x.property_id = y.property_id
                            and x.c_lot_lid = z.c_lid 
                            and z.c_site = q.c_code ");
                            while($row = $qry->fetch_assoc()):
                                
                        ?>
                        <tr>
                        <?php if ($usertype == 'IT Admin'): ?>
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
                    
                    
                        </tr>
                    <?php endwhile; ?>
                    </tbody></table>
           
	        </div>                
            </div>

	</div>
<script>
  $(document).ready(function() {

$('.table').dataTable();
 
});
</script>