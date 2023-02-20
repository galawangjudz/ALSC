<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
table tr{
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
  border:solid 1px;
  padding-left:10px!important;
  border:solid 1px gainsboro;
}
table td{
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 50%;
  border:solid 1px gainsboro;
  padding:5px;
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
  background-color: #F0F0F0;
}

.tab-content {
  display: none;
  padding: 20px;
  background-color: #fff;
}
.tab-content.current {
  display: block;
}
thead {
background-color: black;
color: white;
}

.dataTables_wrapper thead th {
    font-family: Arial, sans-serif;
    font-size: 2px;
} -->
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
  
<div class="card-header">
		<h1 class="card-title" style="font-size:22px;"><b>Client Information</b></h1>
</div>
	<div class="card-body">
		<div class="container-fluid">

        
        <table style="width: 100%;">
        <tr><th style="padding-left:5px;">Client ID: </th><td><b><?php echo $row['client_id'];?></b></td></tr>
        <tr><th style="padding-left:5px;">Property ID: </th><td><?php echo $row['property_id'];?></td></tr>
        <tr><th style="padding-left:5px;">Last Name: </th><td><?php echo $row['last_name'];?></td></tr>
        <tr><th style="padding-left:5px;">First Name: </th><td><?php echo $row['first_name'];?></td></tr>
        <tr><th style="padding-left:5px;">Middle Name: </th><td><?php echo $row['middle_name'];?></td></tr>
        <tr><th style="padding-left:5px;">Suffix Name: </th><td><?php echo $row['suffix_name'];?></td></tr>
        <tr><th style="padding-left:5px;">Physical Address: </th><td><?php echo $row['address'];?></td></tr>
        <tr><th style="padding-left:5px;">Zip Code: </th><td><?php echo $row['zip_code'];?></td></tr>
        <tr><th style="padding-left:5px;">Address Abroad: </th><td><?php echo $row['address_abroad'];?></td></tr>
        <tr><th style="padding-left:5px;">Birthdate: </th><td><?php echo $row['birthdate'];?></td></tr>
        <tr><th style="padding-left:5px;">Age: </th><td><?php echo $row['age'];?></td></tr>
        <tr><th style="padding-left:5px;">Viber: </th><td><?php echo $row['viber'];?></td></tr>
        <tr><th style="padding-left:5px;">Gender: </th><td><?php echo $row['gender'];?></td></tr>
        <tr><th style="padding-left:5px;">Civil Status: </th><td><?php echo $row['civil_status'];?></td></tr>
        <tr><th style="padding-left:5px;">Citizenship: </th><td><?php echo $row['citizenship'];?></td></tr>
        <tr><th style="padding-left:5px;">ID Presented: </th><td><?php echo $row['id_presented'];?></td></tr>
        <tr><th style="padding-left:5px;">Tin No: </th><td><?php echo $row['tin_no'];?></td></tr>
        <tr><th style="padding-left:5px;">Contact No: </th><td><?php echo $row['contact_no'];?></td></tr>
        <tr><th style="padding-left:5px;">Contact Abroad: </th><td><?php echo $row['contact_abroad'];?></td></tr>
        <tr><th style="padding-left:5px;">Email Address: </th><td><?php echo $row['email'];?></td></tr>
        </table>

        <hr>

        <ul class="tabs">
        <li class="tab-link current" data-tab="tab-1"><b>Family Member</b></li>
        <li class="tab-link" data-tab="tab-2"><b>Properties</b></li>
        <li class="tab-link" data-tab="tab-3"><b>Payments</b></li>
      <!--     <li class="tab-link" data-tab="tab-4">Tab 4</li> -->
        </ul>

            <div id="tab-1" class="tab-content current" style="border:solid 1px gainsboro;">
              <?php $qry2 = $conn->query("SELECT * FROM family_members where client_id = $client_id ");
                if($qry2->num_rows <= 0){
                    echo "No Details founds";
                }else{ ?> 
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
                    <?php 
                         while($row = $qry2->fetch_assoc()):
                        
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
                        <?php }
                      endwhile; }?>

                      </tr>

                    </tbody>
                </table>

            </div>

            <div id="tab-2" class="tab-content" style="border:solid 1px gainsboro;">
                <table class="table table-bordered table-stripped">
                    <?php $qry3 = $conn->query("SELECT p.*, r.c_acronym, l.c_block, l.c_lot FROM properties p LEFT JOIN t_lots l on l.c_lid = p.c_lot_lid LEFT JOIN t_projects r ON l.c_site = r.c_code where md5(property_id) = '{$_GET['id']}' ");
                    if($qry3->num_rows <= 0){
                        echo "No Details founds";
                    }else{ ?>     
                    <thead>
                     
                        <tr>
                          <th style="text-align:center;">Property ID</th>
                          <th style="text-align:center;">Location</th>
                          <th style="text-align:center;">Type</th>
                          <th style="text-align:center;">Net TCP</th>  
                          <th style="text-align:center;">Action</th>          
                        </tr>
                    </thead>
                    <tbody>
                      <?php 
                         while($row = $qry3->fetch_assoc()):
                              $property_id = $row["property_id"];
                              $property_id_part1 = substr($property_id, 0, 2);
                              $property_id_part2 = substr($property_id, 2, 6);
                              $property_id_part3 = substr($property_id, 8, 5);
                      ?>
                           <tr>
                            <td class="text-center" style="width:20%;"><?php echo $property_id_part1 . "-" . $property_id_part2 . "-" . $property_id_part3 ?> </td>
                            <td class="text-center" style="width:30%;"><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></td>
                            <?php if($row['c_type'] == 1){ ?>
                                <td class="text-center" style="width:10%;"><span class="badge badge-primary">Lot Only</span></td>
                            <?php }elseif($row['c_type'] == 2){ ?>
                                <td class="text-center" style="width:10%;"><span class="badge badge-primary">House Only</span></td>
                            <?php }elseif($row['c_type'] == 3){ ?>
                                <td class="text-center" style="width:10%;"><span class="badge badge-primary">Packaged</span></td>         
                            <?php }elseif($row['c_type'] == 4){ ?>
                                <td class="text-center" style="width:10%;"><span class="badge badge-primary">Fence</span></td>
                            <?php }elseif($row['c_type'] == 5){ ?>
                                <td class="text-center" style="width:10%;"><span class="badge badge-primary">Add Cost</span></td>
                            <?php } ?>        
                            <td class="text-center" style="width:30%;"><?php echo number_format($row['c_net_tcp'],2) ?></td>
                            <td class="text-center" style="width:10%;"> <a class="btn btn-success btn-s view_data" data-id="<?php echo md5($row['property_id'])  ?>">View</a> </td>
                            <?php endwhile; }?>
                          </tr>

                    </tbody>
                </table>
            </div>

            <div id="tab-3" class="tab-content" style="border:solid 1px gainsboro;">   
                    <table class="table table-bordered table-stripped">
                    <?php $qry4 = $conn->query("SELECT * FROM property_payments where md5(property_id) = '{$_GET['id']}' ");
                     if($qry4->num_rows <= 0){
                           echo "No Payment Records";
                     }else{  ?>      
   
                      <thead> 
                          <tr>
                              <th >Property ID</th>
                              <th>Due Date</th>
                              <th>Pay Date</th>
                              <th>Or No</th>
                              <th>Amount Paid</th>
                              <th>Interest</th>
                              <th>Principal</th>
                              <th>Surcharge</th>
                              <th>Rebate</th>
                              <th>Period</th>
                              <th>Balance</th>
                          </tr>
                      </thead>
                    <tbody>
                        <?php
                        while($row= $qry4->fetch_assoc()): 
                 
                          $property_id = $row["property_id"];
                          $property_id_part1 = substr($property_id, 0, 2);
                          $property_id_part2 = substr($property_id, 2, 6);
                          $property_id_part3 = substr($property_id, 8, 5);

                          $payment_id = $row['payment_id'];
                          $due_dte = $row['due_date'];
                          $pay_dte = $row['payment_date'];
                          $or_no = $row['or_no'];
                          $amt_paid = $row['payment_amount'];
                          $interest = $row['interest'];
                          $principal = $row['principal'];
                          $surcharge = $row['surcharge'];
                          $rebate = $row['rebate'];
                          $period = $row['status'];
                          $balance = $row['remaining_balance'];

                      ?>
                      <tr>
                       
                        <td class="text-center"><?php echo $property_id_part1 . "-" . $property_id_part2 . "-" . $property_id_part3 ?> </td>
                        <td class="text-center"><?php echo $due_dte ?> </td> 
                        <td class="text-center"><?php echo $pay_dte ?> </td> 
                        <td class="text-center"><?php echo $or_no ?> </td> 
                        <td class="text-center"><?php echo $amt_paid ?> </td> 
                        <td class="text-center"><?php echo $interest ?> </td> 
                        <td class="text-center"><?php echo $principal ?> </td> 
                        <td class="text-center"><?php echo $surcharge ?> </td> 
                        <td class="text-center"><?php echo $rebate ?> </td> 
                        <td class="text-center"><?php echo $period ?> </td> 
                        <td class="text-center"><?php echo $balance ?> </td>  
                      </tr>
                        <?php endwhile ; } ?>
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

  $('.view_data').click(function(){
		/* uni_modal('CA Approval','manage_ca.php?id='+$(this).attr('data-id')) */
	  uni_modal_right("<i class='fa fa-info'></i> Property Details",'clients/property_details.php?id='+$(this).attr('data-id'),"mid-large")

	})
  $('#data-table').dataTable({

  }); 
   
  $('.tab-link').click(function() {
    var tab_id = $(this).attr('data-tab');

    $('.tab-link').removeClass('current');
    $('.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
  })
});
</script>