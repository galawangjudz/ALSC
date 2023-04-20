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
.modal-content{
    width:1200px;
    margin-right:0px;
    margin-left:0px;
    height:auto;
    display: block!important; /* remove extra space below image */
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
}
body{
  font-size:14px;
}
.payment_table_container{
  float:left;
  height:auto;
  width:100%;
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
        <li class="tab-link" data-tab="tab-3"><b>Payment Record</b></li>
        <li class="tab-link" data-tab="tab-4"><b>Payment Schedule</b></li>
       <!--  <li class="tab-link" data-tab="tab-6"><b>Payment Window</b></li> -->
        </ul>

            <div id="tab-1" class="tab-content current" style="border:solid 1px gainsboro;">
              <?php $qry2 = $conn->query("SELECT * FROM family_members where client_id = $client_id ");
                if($qry2->num_rows <= 0){
                    echo "No Details founds";
                }else{ ?> 
                <table class="table2 table-bordered table-stripped">
                 
                    <thead style="text-align:center;"> 
                        <tr>
                        <th style="text-align:center;font-size:13px;">LAST NAME</th> 
                        <th style="text-align:center;font-size:13px;">FIRST NAME</th>
                        <th style="text-align:center;font-size:13px;">ADDRESS</th>
                        <th style="text-align:center;font-size:13px;">CONTACT NO</th>
                        <th style="text-align:center;font-size:13px;">EMAIL ADDRESS</th>
                        <th style="text-align:center;font-size:13px;">RELATIONSHIP</th>
                  
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                         while($row = $qry2->fetch_assoc()):
                      ?>
                      <tr>
                        <td class="text-center" style="font-size:13px;width:20%;"><?php echo $row['last_name'] ?> </td>
                        <td class="text-center" style="font-size:13px;width:20%;"><?php echo $row['first_name'] ?></td>
                        <td class="text-center" style="font-size:13px;width:30%;"><?php echo $row['address'] ?></td>
                        <td class="text-center" style="font-size:13px;width:10%;"><?php echo $row['contact_no'] ?></td>
                        <td class="text-center" style="font-size:13px;"><?php echo $row['email'] ?></td>
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
                <table class="table2 table-bordered table-stripped" style="width:100%;">
                    <?php $qry3 = $conn->query("SELECT p.*, r.c_acronym, l.c_block, l.c_lot FROM properties p LEFT JOIN t_lots l on l.c_lid = p.c_lot_lid LEFT JOIN t_projects r ON l.c_site = r.c_code where md5(property_id) = '{$_GET['id']}' ");
                    if($qry3->num_rows <= 0){
                        echo "No Details founds";
                    }else{ ?>     
                     <thead> 
                        <tr>
                          <th style="text-align:center;font-size:13px;">PROPERTY ID</th>
                          <th style="text-align:center;font-size:13px;">LOCATION</th>
                          <th style="text-align:center;font-size:13px;">TYPE</th>
                          <th style="text-align:center;font-size:13px;">NET TCP</th>  
                          <th style="text-align:center;font-size:13px;">ACTION</th>          
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
                            <td class="text-center" style="font-size:13px;width:20%;"><?php echo $property_id_part1 . "-" . $property_id_part2 . "-" . $property_id_part3 ?> </td>
                            <td class="text-center" style="font-size:13px;width:20%;"><?php echo $row["c_acronym"]. ' Block ' .$row["c_block"] . ' Lot '.$row["c_lot"] ?></td>
                            <?php if($row['c_type'] == 1){ ?>
                                <td class="text-center" style="width:20%;"><span class="badge badge-primary">Lot Only</span></td>
                            <?php }elseif($row['c_type'] == 2){ ?>
                                <td class="text-center" style="width:20%;"><span class="badge badge-primary">House Only</span></td>
                            <?php }elseif($row['c_type'] == 3){ ?>
                                <td class="text-center" style="width:20%;"><span class="badge badge-primary">Packaged</span></td>         
                            <?php }elseif($row['c_type'] == 4){ ?>
                                <td class="text-center" style="width:20%;"><span class="badge badge-primary">Fence</span></td>
                            <?php }elseif($row['c_type'] == 5){ ?>
                                <td class="text-center" style="width:20%;"><span class="badge badge-primary">Add Cost</span></td>
                            <?php } ?>        
                            <td class="text-center" style="font-size:13px;width:20%;"><?php echo number_format($row['c_net_tcp'],2) ?></td>
                            <td class="text-center" style="font-size:12px;width:20%;"><a class="btn btn-success btn-s view_data" style="font-weight:bold;font-size:12px;height:30px;width:100px;" data-id="<?php echo md5($row['property_id']) ?>">View</a></td>
                            <?php endwhile; }?>
                          </tr>

                    </tbody>
                </table>
            </div>

            <div id="tab-3" class="tab-content" style="border:solid 1px gainsboro;">  
              <div class="container" style="background-color:#F5F5F5;float:right;margin-bottom:20px;border-radius:5px;padding:5px;">
                <!-- <button type="button" class="btn btn-primary add_payment" data-id="<?php echo md5($property_id)  ?>"><span class="fa fa-plus"> Add Payments </span></button>    -->
                <a href="./?page=clients/payment_wdw&id=<?php echo md5($property_id); ?>", target="_blank" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print">New Payment</span> </a>              
                <a href="<?php echo base_url ?>/report/print_properties.php?id=<?php echo md5($property_id); ?>", target="_blank" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print">Print</span></a>            
                <a href="http://localhost/ALSC/admin/?page=clients/test.php?id=<?php echo md5($property_id)  ?>" class="btn btn-primary"> E-mail</a>
              </div>  
                    <table class="table2 table-bordered table-stripped">
                    <?php $qry4 = $conn->query("SELECT * FROM property_payments where md5(property_id) = '{$_GET['id']}' ORDER by due_date, pay_date, payment_count ASC");
                     if($qry4->num_rows <= 0){
                           echo "No Payment Records";
                     }else{  ?>      
   
                      <thead> 
                          <tr>
                            <!--   <th style="text-align:center;font-size:13px;">PROPERTY ID</th> -->
                              <th style="text-align:center;font-size:13px;">DUE DATE</th>
                              <th style="text-align:center;font-size:13px;">PAY DATE</th>
                              <th style="text-align:center;font-size:13px;">OR NO</th>
                              <th style="text-align:center;font-size:13px;">AMOUNT PAID</th>
                              <th style="text-align:center;font-size:13px;">INTEREST</th>
                              <th style="text-align:center;font-size:13px;">PRINCIPAL</th>
                              <th style="text-align:center;font-size:13px;">SURCHARGE</th>
                              <th style="text-align:center;font-size:13px;">REBATE</th>
                              <th style="text-align:center;font-size:13px;">PERIOD</th>
                              <th style="text-align:center;font-size:13px;">BALANCE</th>
                          </tr>
                      </thead>
                    <tbody>
                        <?php
                        $total_rebate = 0;
                        
                        while($row= $qry4->fetch_assoc()): 
                 
                       /*    $property_id = $row["property_id"];
                          $property_id_part1 = substr($property_id, 0, 2);
                          $property_id_part2 = substr($property_id, 2, 6);
                          $property_id_part3 = substr($property_id, 8, 5); */

                         /*  $payment_id = $row['payment_id']; */
                          $due_dte = $row['due_date'];
                          $pay_dte = $row['pay_date'];
                          $or_no = $row['or_no'];
                          $amt_paid = $row['payment_amount'];
                          $interest = $row['interest'];
                          $principal = $row['principal'];
                          $surcharge = $row['surcharge'];
                          $rebate = $row['rebate'];
                          $period = $row['status'];
                          $balance = $row['remaining_balance'];

                          $total_rebate += $rebate;

                      ?>
                      <tr>
                       <!-- 
                        <td class="text-center" style="font-size:13px;width:20%;"><?php echo $property_id_part1 . "-" . $property_id_part2 . "-" . $property_id_part3 ?> </td>
                        --> <td class="text-center" style="font-size:13px;width:12%;"><?php echo $due_dte ?> </td> 
                        <td class="text-center" style="font-size:13px;width:12%;"><?php echo $pay_dte ?> </td> 
                        <td class="text-center" style="font-size:13px;width:10%;"><?php echo $or_no ?> </td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo number_format($amt_paid,2) ?> </td> 
                        <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($interest,2) ?> </td> 
                        <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($principal,2) ?> </td> 
                        <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($surcharge,2) ?> </td> 
                        <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($rebate,2) ?> </td> 
                        <td class="text-center" style="font-size:13px;width:10%;"><?php echo $period ?> </td> 
                        <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($balance,2) ?> </td>  
                      </tr>
                        <?php endwhile ; } ?>
                    </tbody>
                </table>

                <div class="row">
                <div class="col-md-12">
                    <div class="form-group">         
        
                         
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <table>
                          <tr>
                          <?php $qry_prin = "SELECT SUM(payment_amount) AS p_amnt_total FROM property_payments where md5(property_id) = '{$_GET['id']}'";

                            $result = mysqli_query($conn, $qry_prin);

                            // Check if the query was successful
                            if (mysqli_num_rows($result) > 0) {
                                // Fetch the result as an associative array
                                $row = mysqli_fetch_assoc($result);
                                // Get the sum value
                                $total_prin = $row["p_amnt_total"];
                                // Display the sum value
                            } else {
                                echo "No results found.";
                            }
                            ?>
                            <?php $qry_surcharge = "SELECT SUM(surcharge) AS p_surcharge FROM property_payments where md5(property_id) = '{$_GET['id']}'";

                            $result = mysqli_query($conn, $qry_surcharge);

                            // Check if the query was successful
                            if (mysqli_num_rows($result) > 0) {
                                // Fetch the result as an associative array
                                $row = mysqli_fetch_assoc($result);
                                // Get the sum value
                                $total_surcharge = $row["p_surcharge"];
                                // Display the sum value
                            } else {
                                echo "No results found.";
                            }
                            ?>
                            <?php $qry_interest = "SELECT SUM(interest) AS p_interest FROM property_payments where md5(property_id) = '{$_GET['id']}'";

                            $result = mysqli_query($conn, $qry_interest);

                            // Check if the query was successful
                            if (mysqli_num_rows($result) > 0) {
                                // Fetch the result as an associative array
                                $row = mysqli_fetch_assoc($result);
                                // Get the sum value
                                $total_interest = $row["p_interest"];
                                // Display the sum value
                            } else {
                                echo "No results found.";
                            }
                            ?>
                            <?php $qry_amt_due = "SELECT SUM(amount_due) AS p_amt_due FROM property_payments where md5(property_id) = '{$_GET['id']}'";

                              $result = mysqli_query($conn, $qry_amt_due);

                              // Check if the query was successful
                              if (mysqli_num_rows($result) > 0) {
                                  // Fetch the result as an associative array
                                  $row = mysqli_fetch_assoc($result);
                                  // Get the sum value
                                  $total_amt_due = $row["p_amt_due"];

                                  $main_total = $total_amt_due + $total_interest + $total_surcharge + $total_prin;
                                  // Display the sum value
                              } else {
                                  echo "No results found.";
                              }
                              ?>
                              <td style="font-size:12px;"><label class="control-label">Total Principal: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_prin" id="tot_prin" value="<?php echo number_format($total_prin,2) ?>" style="width:125px;"></td>
                              <td style="font-size:12px;"><label class="control-label">Total Rebate: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_reb" id="tot_reb" value="<?php echo number_format($total_rebate,2) ?>" style="width:125px;"></td>
                              <td style="font-size:12px;"><label class="control-label">Total Surcharge: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_sur" id="tot_sur" value="<?php echo number_format($total_surcharge,2) ?>" style="width:125px;"></td>
                              <td style="font-size:12px;"><label class="control-label">Total Interest: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_int" id="tot_int" value="<?php echo number_format($total_interest,2) ?>" style="width:125px;"></td>
                              <td style="font-size:12px;"><label>Total Amount Due: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_amt_due" id="tot_amt_due" value="<?php echo number_format($main_total,2) ?>" style="width:125px;"></td>
                          </tr>
                      </table>
                    </div>
                </div>
                
            </div>   

            </div>
     
            <div id="tab-4" class="tab-content" style="border:solid 1px gainsboro;">
              <div class="container" style="background-color:#F5F5F5;float:right;margin-bottom:20px;border-radius:5px;padding:5px;">
          
              <?php
                      
                include 'payment_record.php'; 
                $id = $_GET['id'];
                $all_payments = load_data($id); 
                $over_due    = $all_payments[0];
                $total_amt_due = $all_payments[1];
                $total_interest =  $all_payments[2];
                $total_principal = $all_payments[3];
                $total_surcharge = $all_payments[4];

                ?>
            
              <a href="<?php echo base_url ?>/report/print_payment_schedule.php?id=<?php echo md5($property_id); ?>", target="_blank" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print"></span> Print</a>
            </div>
              <table class="table2 table-bordered table-stripped">
                  <thead> 
                      <tr>
                          <th class="text-center" style="font-size:13px;">DUE DATE</th>
                          <th class="text-center" style="font-size:13px;">PAY DATE</th>
                          <th class="text-center" style="font-size:13px;">OR NO</th>
                          <th class="text-center" style="font-size:13px;">AMOUNT PAID</th> 
                          <th class="text-center" style="font-size:13px;">AMOUNT DUE</th>
                          <th class="text-center" style="font-size:13px;">INTEREST</th>
                          <th class="text-center" style="font-size:13px;">PRINCIPAL</th>
                          <th class="text-center" style="font-size:13px;">SURCHARGE</th>
                          <th class="text-center" style="font-size:13px;">REBATE</th>
                          <th class="text-center" style="font-size:13px;">PERIOD</th>
                          <th class="text-center" style="font-size:13px;">BALANCE</th>
                      </tr>
                  </thead>
                <tbody>
              
                   <?php 
                    foreach ($over_due as $l_data): ?>
                      <tr>
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[0] ?></td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[1] ?></td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[2] ?> </td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[3] ?> </td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[4] ?> </td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[5] ?> </td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[6] ?> </td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[7] ?> </td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[8] ?> </td>  
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[9] ?> </td>  
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[10] ?> </td>  
                      </tr>
                      <?php endforeach; ?>
                </tbody>
              </table>
            
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">         
        
                         
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                      <table>
                          <tr>
                              <td style="font-size:12px;"><label class="control-label">Total Principal: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_prin" id="tot_prin" value="<?php echo isset($total_principal) ? $total_principal: ''; ?>" disabled></td>
                              <td style="font-size:12px;"><label class="control-label">Total Surcharge: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_sur" id="tot_sur" value="<?php echo isset($total_surcharge) ? $total_surcharge : ''; ?>" disabled></td>
                              <td style="font-size:12px;"><label class="control-label">Total Interest: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_int" id="tot_int" value="<?php echo isset($total_interest) ? $total_interest : ''; ?>" disabled></td>
                              <td style="font-size:12px;"><label>Total Amount Due: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_amt_due" id="tot_amt_due" value="<?php echo isset($total_amt_due) ? $total_amt_due : ''; ?>" disabled></td>
                          </tr>
                      </table>
                    </div>
                </div>
            </div>               
            </div>
           
         </div>
        </div>
    </div>
</div>
</body>

<script>
$(document).ready(function() {
  $('.table').dataTable(
			{"ordering":false}
		);



  $('.view_data').click(function(){
		/* uni_modal('CA Approval','manage_ca.php?id='+$(this).attr('data-id')) */
	  uni_modal_right("<i class='fa fa-info'></i> Property Details",'clients/property_details.php?id='+$(this).attr('data-id'),"mid-large")

	})

  
  $('.add_payment').click(function(){
		/* uni_modal('Add Payment','payments.php?id='+$(this).attr('data-id')) */
	  uni_modal("<i class='fa fa-plus'></i> Add Payments",'clients/payments.php?id='+$(this).attr('data-id'),"mid-large")

	})

  $('.new_payment').click(function(){
		
	  uni_modal("<i class='fa fa-plus'></i> Add Payments",'clients/payments.php?id='+$(this).attr('data-id'),"mid-large")

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

$(document).ready(function() {



  $('#uni_modal').on('shown.bs.modal', function (){
       check_paydate();
    });
      

    $(document).on('keyup', ".pay-date", function(e) {
        e.preventDefault();
        check_paydate();


    });	



 });

  function check_paydate(){

      const due_date = new Date($('.due-date').val());
      const pay_date = new Date($('.pay-date').val());
      const payment_type2 = $('.payment-type2').val();
      const pay_status = $('.pay-stat').val();
      const pay_stat_acro = pay_status.substring(0, 2);
      const interest_rate =  $('.int-rate').val();
      const underpay =  $('.under-pay').val();
      const excess =  $('.excess').val();
      const over_due_mode =  $('.over-due-mode').val();
      const monthly_payment =  $('.monthly-pay').val();
      const numStr = $('.amt-due').val();
      const monthly_pay  = parseFloat(numStr.replace(",", ""));


      //console.log(pay_stat_acro);
      if (pay_date > due_date) {
          const timeDiff = Math.abs(pay_date.getTime() - due_date.getTime());
          const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
          //console.log(monthly_pay);
          const l_sur = (monthly_pay * ((0.6/360) * diffDays));

          const tot_amt_due = monthly_pay + l_sur;
          //console.log(tot_amt_due);
          $('#surcharge').val(l_sur.toFixed(2));
          $('#rebate_amt').val('0.0');
          $('#tot_amount_due').val(tot_amt_due.toFixed(2));
         // $('#amount_paid').val(tot_amt_due.toFixed(2));
          //console.log(`${pa_status.substr(0,2)}`);
          //console.log(pay_status);
          console.log(`The payment is ${diffDays} days late. The late surcharge is ${l_sur}.`);

        
      }else if ((pay_stat_acro == 'MA') || ((pay_status == 'FPD') && (payment_type2 == 'Monthy Amortization')) && (pay_date < due_date)) {

        console.log(interest_rate);
        const timeDiff = Math.abs(due_date.getTime() - pay_date.getTime());
        const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 

        
        if (interest_rate == 12){
              l_rebate_value = 0.02;
        }else if (interest_rate == 14){
              l_rebate_value = 0.0225;
        }else if (interest_rate == 15){
              l_rebate_value = 0.0225;
        } else if (interest_rate == 16){
              l_rebate_value = 0.025;
        } else if (interest_rate == 17){
              l_rebate_value = 0.025;
        } else if (interest_rate == 18){
              l_rebate_value = 0.025;
        }else if (interest_rate == 19){
              l_rebate_value = 0.025;
        }else if (interest_rate == 20){
              l_rebate_value = 0.025;
        }else if (interest_rate == 21){
              l_rebate_value = 0.025;
        } else if (interest_rate == 22){
              l_rebate_value = 0.0275;
        } else if (interest_rate == 23){
              l_rebate_value = 0.0275;
        }else if (interest_rate == 24){
              l_rebate_value = 0.03;
        }else{
              l_rebate_value = 0;
        }
        if (diffDays > 2){
              if (underpay == 1){
                  l_rebate = (monthly_payment * l_rebate_value);
              }else{
                  l_rebate = (monthly_pay * l_rebate_value);
              }

        }else{
              l_rebate = 0;
        }

        console.log(diffDays);
        console.log(l_rebate);
        $('#rebate_amt').val(l_rebate.toFixed(2));
        l_monthly = (monthly_pay - l_rebate);
        $('#tot_amount_due').val(l_monthly.toFixed(2));
        //$('#amount_paid').val(l_monthly.toFixed(2));

      }else{
          if ((excess != -1) && (over_due_mode == 0)){
              return;
          }
          $('#tot_amount_due').val(monthly_pay.toFixed(2));
         // $('#amount_paid').val(monthly_pay.toFixed(2));
          $('#surcharge').val('0.0');
          $('#rebate_amt').val('0.0');
      }


      }






</script>