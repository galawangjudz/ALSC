<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
.table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
}

.table td, .table th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

.table tr:nth-child(even) {
  background-color: #dddddd;
}


.tabs {
  list-style: none;
  margin: 0;
  padding: 0;
}

.tab-link {
  display: inline-block;
  margin: 0;
  padding: 10px 15px;
  background-color: #ddd;
  color: #333;
  cursor: pointer;
}

.tab-link.current {
  background-color: #fff;
}

.tab-content {
  display: none;
  padding: 20px;
  background-color: #fff;
}

.tab-content.current {
  display: block;
}

</style>
<?php $qry = $conn->query("SELECT * FROM property_clients where md5(property_id) = '{$_GET['id']}' ");
	$row= $qry->fetch_assoc();
  $client_id = $row['client_id'];
?>


<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
      <div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary update_client" href=""><i class="fa fa-edit"></i> Update Details</a>
			</div>
	</div>
	<div class="card-body">
		<div class="container-fluid">

        
        <table style="width: 100%">
        <tr><th>Client ID</th><td><?php echo $row['client_id'];?></td></tr>
        <tr><th>Client Last Name</th><td><?php echo $row['last_name'];?></td></tr>
        <tr><th>Client First Name</th><td><?php echo $row['first_name'];?></td></tr>
        <tr><th>Client Middle Name</th><td><?php echo $row['middle_name'];?></td></tr>
        <tr><th>Client Physical Address</th><td><?php echo $row['address'];?></td></tr>
        <tr><th>Clien Contact No</th><td><?php echo $row['contact_no'];?></td></tr>
        <tr><th>Client Email Address</th><td><?php echo $row['email'];?></td></tr>
        </table>

        <hr>
        <ul class="tabs">
        <li class="tab-link current" data-tab="tab-1">Family Member</li>
        <li class="tab-link" data-tab="tab-2">Properties</li>
        <li class="tab-link" data-tab="tab-3">Payments</li>
      <!--     <li class="tab-link" data-tab="tab-4">Tab 4</li> -->
        </ul>

            <div id="tab-1" class="tab-content current">
               
                <table class="table table-bordered table-stripped">
                
                    <thead>
                        <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Address</th>
                        <th>Contact No</th>
                        <th>Email Address</th>
                        <th>Relationship</th>
                    
                
                        </tr>
                    </thead>
                    <tbody>
                    <?php $qry2 = $conn->query("SELECT * FROM family_members where client_id = $client_id ");
                      $row = $qry2->fetch_assoc();
                    ?>
                    <tr>

                      <td class="text-center"><?php echo $row['last_name'] ?> </td>
                      <td class="text-center"><?php echo $row['first_name'] ?></td>
                      <td class="text-center"><?php echo $row['address'] ?></td>
                      <td class="text-center"><?php echo $row['contact_no'] ?></td>
                      <td class="text-center"><?php echo $row['email'] ?></td>
                      <?php if($row['relationship'] == 0){ ?>
                          <td class="text-center"><span class="badge badge-primary">None</span></td>
                      <?php }elseif($row['relationship'] == 1){ ?>
                          <td class="text-center"><span class="badge badge-primary">And</span></td>
                      <?php }elseif($row['relationship'] == 2){ ?>
                          <td class="text-center"><span class="badge badge-primary">Spouses</span></td>           
                      <?php }elseif($row['relationship'] == 3){ ?>
                          <td class="text-center"><span class="badge badge-primary">Married To</span></td>
                      <?php }elseif($row['relationship'] == 4){ ?>
                          <td class="text-center"><span class="badge badge-primary">Minor/Represented by Legal Guardian</span></td>
                      <?php } ?>

                    </tr>
                    </tbody>
                </table>

            </div>

            <div id="tab-2" class="tab-content">
                <table class="table table-bordered table-stripped">
                    
                    <thead>
                        <tr>
                        <th>Property ID</th>
                        <th>Location</th>
                        <th>Net TCP</th>
                        
                    
                
                        </tr>
                    </thead>
                    <tbody>
                      <?php $qry3 = $conn->query("SELECT p.*, r.c_acronym, l.c_block, l.c_lot FROM properties p LEFT JOIN t_lots l on l.c_lid = p.c_lot_lid LEFT JOIN t_projects r ON l.c_site = r.c_code where md5(property_id) = '{$_GET['id']}' ");
                        $row = $qry3->fetch_assoc()
                        ;$property_id = $row["property_id"];
                        $property_id_part1 = substr($property_id, 0, 2);
                        $property_id_part2 = substr($property_id, 2, 6);
                        $property_id_part3 = substr($property_id, 8, 5);
                      ?>
                      <tr>
                      <td class="text-center"><?php echo $property_id_part1 . "-" . $property_id_part2 . "-" . $property_id_part3 ?> </td>
                      <td class="text-center"><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></td>
                      <td class="text-center"><?php echo number_format($row['c_net_tcp'],2) ?></td>

                      </tr>

                    </tbody>
                </table>
            </div>

            <div id="tab-3" class="tab-content">
                <table class="table table-bordered table-stripped">
                    
                    <thead>
                        <tr>
                        <th>Payment ID</th>
                        <th>Client Property</th>
                        <th>Amount Paid</th>
                        <th>Balance</th>
                        <th>Due Date</th>
                
                        </tr>
                    </thead>
                    <tbody>
                    
                    </tbody>
                </table>
            </div>
  <!--   
            <div id="tab-4" class="tab-content">
            <p>This is tab 4 content.</p>
            </div> -->




      
         
               
        </div>
    </div>
</div>

</body>
<script>
$(document).ready(function() {

  $('.tab-link').click(function() {
    var tab_id = $(this).attr('data-tab');

    $('.tab-link').removeClass('current');
    $('.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
  })
});
</script>