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
        <li class="tab-link" data-tab="tab-5"><b>Payment Overdue</b></li>
        <li class="tab-link" data-tab="tab-6"><b>Payment Window</b></li>
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
              <button type="button" class="btn btn-primary add_payment" data-id="<?php echo md5($property_id)  ?>"><span class="fa fa-plus"> Add Payments </span></button>   
              <a href="<?php echo base_url ?>/report/print_properties.php?id=<?php echo md5($property_id); ?>", target="_blank" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print">Print</span> </a>            
            </div>  
                    <table class="table2 table-bordered table-stripped">
                    <?php $qry4 = $conn->query("SELECT * FROM property_payments where md5(property_id) = '{$_GET['id']}' ");
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
                              <th style="text-align:center;font-size:15px;">BALANCE</th>
                          </tr>
                      </thead>
                    <tbody>
                        <?php
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
            </div>
     
            <div id="tab-4" class="tab-content" style="border:solid 1px gainsboro;">
              <div class="container" style="background-color:#F5F5F5;float:right;margin-bottom:20px;border-radius:5px;padding:5px;">
          
              <?php
                      
                //include 'payment_schedule.php'; 
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
            <div id="tab-5" class="tab-content" style="border:solid 1px gainsboro;">
             
                <form method="" id="set-paydate">
                    <label class="control-label">Pay Date: </label>
                    <input type="date" name="pay_date_input" id="pay_date_input" value="<?php echo date('Y-m-d'); ?>">
                    <button type="button" class="btn btn-primary set_pay_date_button" data-date="" data-id="<?php echo md5($property_id)  ?>"><span class="fa fa-plus"> Set Paydate </span></button> 
                </form>
  
              
            </div>

            <div id="tab-6" class="tab-content" style="border:solid 1px gainsboro;">
             
             <form method="">
                 <label class="control-label">Pay Date: </label>
                 <input type="date" name="pay_date_input" id="pay_date_input" value="<?php echo date('Y-m-d'); ?>">
                 <button type="button" class="btn btn-primary set_pay_date_button" data-date="" data-id="<?php echo md5($property_id)  ?>"><span class="fa fa-plus"> Set Paydate </span></button> 
             
                 <table class="table3 table-bordered table-hover table-striped" id="comm_table" style="width:100%;">
									<thead>
										<tr>
											<th width="20">
												<a href="#" class="btn btn-success btn-md add-row"><span class="fa fa-plus" aria-hidden="true"></span></a>
											</th>
											<th width="500">
												<label class="control-label">&nbsp;Due Date</label>
											</th>
											<th  width="90">
											<label class="control-label">&nbsp;Pay Date</label>
											</th>
											<th width="90">
												<label class="control-label">&nbsp;Or No</label>
											</th>
											<th width="150">
												<label class="control-label">&nbsp;Interest</label>
											</th>
											<th width="200">
												<label class="control-label">&nbsp;Principal</label>
											</th>
                      <th width="200">
												<label class="control-label">&nbsp;Surcharge</label>
											</th>
                      <th width="200">
												<label class="control-label">&nbsp;Rebate</label>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										if(isset($_GET['id']) && $_GET['id'] > 0){
										$qry = $conn->query("SELECT * FROM t_csr_commission WHERE md5(c_csr_no) ='{$_GET['id']}'");
										while($rows = $qry->fetch_assoc()):
											$agent_name = $rows['c_agent'];
											$position = $rows['c_position'];
											$code = $rows['c_code'];
											$rate = $rows['c_rate'];
											$comm_amt = $rows['c_amount'];
										?>
										<tr>
											<td>
												<a href="#" class="btn btn-danger btn-md delete-row"><span class="fa fa-times" ></span></a>
											</td>
											<td style="padding-top:10px;">
												<!-- <a href="#" class="btn btn-danger btn-md delete-row"><span class="fa fa-times" aria-hidden="true"></span></a> -->
												
												<div class="form-group form-group-sm">
													<input type="text" style="width:60%" class="form-control form-group-sm item-input agent-name" name="agent_name[]" value="<?php echo isset($agent_name) ? $agent_name : ''; ?>">
													<p class="item-select"> <a href="#"  class="btn btn-flat btn-md bg-maroon" ><span class="fa fa-search" aria-hidden="true"></span> Select Existing Agent</a></p>
									
												</div>
											</td>
											<td style="padding-top:10px;">
													<input type="text" class="form-control agent-pos" name="agent_position[]" value="<?php echo isset($position) ? $position : ''; ?>" readonly>
											</td>
											<td style="padding-top:10px;">
													<input type="text" class="form-control agent-code" name="agent_code[]" value="<?php echo isset($code) ? $code : ''; ?>" readonly>
											</td>
											<td style="padding-top:10px;">
													<input type="text" class="form-control calculate agent-rate required" name="agent_rate[]" value="<?php echo isset($rate) ? $rate : 0; ?>">
											</td>
											<td style="padding-top:10px;">
													<input type="text" class="form-control comm-amt" name="comm_amt[]" value="<?php echo isset($comm_amt) ? $comm_amt : 0; ?>" >
											</td>
										</tr>
										<?php endwhile; 
										
										}else{ ?>
											<tr><td>
												<a href="#" class="btn btn-danger btn-md delete-row"><span class="fa fa-times" ></span></a>
											</td>
											<td style="padding-top:10px;">
												<!-- <a href="#" class="btn btn-danger btn-md delete-row"><span class="fa fa-times" aria-hidden="true"></span></a> -->
												
												<div class="form-group form-group-sm no-margin-bottom">
													<input type="text" style="width:60%" class="form-control form-group-sm item-input agent-name" name="agent_name[]" value="<?php echo isset($agent_name) ? $agent_name : ''; ?>">
													<p class="item-select"> <a href="#"  class="btn btn-flat btn-md bg-maroon" ><span class="fa fa-search" aria-hidden="true"></span> Select Existing Agent</a></p>
									
												</div>
											</td>
											<td>
												<div class="form-group form-group-sm" style="padding-top:10px;margin-top:-35px;">
													<input type="text" class="form-control agent-pos" name="agent_position[]" value="<?php echo isset($position) ? $position : ''; ?>" readonly>
												</div>
											</td>
											<td>
												<div class="form-group form-group-sm" style="padding-top:10px;margin-top:-35px;">
													
													<input type="text" class="form-control agent-code" name="agent_code[]" value="<?php echo isset($code) ? $code : ''; ?>" aria-describedby="sizing-addon1" readonly>
												</div>
											</td>
											<td>
												<div class="form-group form-group-sm" style="padding-top:10px;margin-top:-35px;">
													<input type="number" class="form-control calculate agent-rate required" name="agent_rate[]" value="<?php echo isset($rate) ? $rate : 0; ?>">
												</div>
											</td>
											<td>
												<div class="form-group form-group-sm" style="padding-top:10px;margin-top:-35px;">
													<input type="text" class="form-control comm-amt" name="comm_amt[]" value="<?php echo isset($comm_amt) ? $comm_amt : 0; ?>" aria-describedby="sizing-addon1">
												</div>
											</td>
										</tr>
										<?php }
										?>
									</tbody>
								</table>
                      
             
             </form>

           
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


  $('.set_pay_date_button').click(function(){
		/* uni_modal('Add Payment','payments.php?id='+$(this).attr('data-id')) */
    var payDateInput = document.getElementById("pay_date_input");
    var setPayDateButton = document.querySelector(".set_pay_date_button");  
    setPayDateButton.setAttribute("data-date", payDateInput.value);
	  uni_modal_right("<i class='fa fa-plus'></i> Overdue",'clients/over_due_details.php?id='+$(this).attr('data-id')+"&paydate="+$(this).attr('data-date'),"large")

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