

<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>


<div class="navbar">
    <div class="navbar-menu">
    <a href="#home" id="home-link" onclick="highlightLink('home-link')">Home</a>
    <a href="#about" id="about-link" onclick="highlightLink('about-link')">About</a>
    <a href="#services" id="services-link" onclick="highlightLink('services-link')">Services</a>
    <a href="#contact" id="contact-link" onclick="highlightLink('contact-link')">Contact</a>
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