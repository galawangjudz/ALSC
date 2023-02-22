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
        <li class="tab-link" data-tab="tab-4"><b>Payment Schedule</b></li>
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
              <button type="button" class="btn btn-success add_payment" data-id="<?php echo md5($property_id)  ?>" ><span class="fa fa-plus"> Add Payments </span></button>          

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
                       
                        <td class="text-center"><?php echo $property_id_part1 . "-" . $property_id_part2 . "-" . $property_id_part3 ?> </td>
                        <td class="text-center"><?php echo $due_dte ?> </td> 
                        <td class="text-center"><?php echo $pay_dte ?> </td> 
                        <td class="text-center"><?php echo $or_no ?> </td> 
                        <td class="text-center"><?php echo number_format($amt_paid,2) ?> </td> 
                        <td class="text-center"><?php echo number_format($interest,2) ?> </td> 
                        <td class="text-center"><?php echo number_format($principal,2) ?> </td> 
                        <td class="text-center"><?php echo number_format($surcharge,2) ?> </td> 
                        <td class="text-center"><?php echo number_format($rebate,2) ?> </td> 
                        <td class="text-center"><?php echo $period ?> </td> 
                        <td class="text-center"><?php echo number_format($balance,2) ?> </td>  
                      </tr>
                        <?php endwhile ; } ?>
                    </tbody>
                </table>
            </div>
     
            <div id="tab-4" class="tab-content" style="border:solid 1px gainsboro;">
                  <table class="table table-bordered table-stripped">
                      <thead> 
                          <tr>
                              <th>Due Date</th>
                              <th>Pay Date</th>
                              <th>Or No</th>
                              <th>Amount Paid</th> 
                              <th>Amount Due</th>
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
                  function add($date_str, $months)
                    {
                     $date = new DateTime($date_str);
                     $start_day = $date->format('j');
                 
                     $date->modify("+{$months} month");
                     $end_day = $date->format('j');
                 
                     if ($start_day != $end_day)
                         $date->modify('last day of last month');
                 
                     return $date;
                    }



                  $l_col = "property_id,c_account_type,c_account_type1,c_account_status,c_net_tcp,c_payment_type1,c_payment_type2,c_net_dp,c_no_payments,c_monthly_down,c_first_dp,c_full_down,c_amt_financed,c_terms,c_interest_rate,c_fixed_factor,c_monthly_payment,c_start_date,c_retention,c_change_date,c_restructured,c_date_of_sale";
                  $l_sql = sprintf("SELECT %s FROM properties WHERE md5(property_id) = '{$_GET['id']}' ", $l_col);
                  $l_qry = $conn->query($l_sql);
                 
                  while($row=$l_qry->fetch_assoc()):
                    $l_acc_type = $row['c_account_type'];
                    $l_acc_type1 = $row['c_account_type1'];
                    $l_acc_status = $row['c_account_status'];
                    $l_net_tcp = $row['c_net_tcp'];
                    $l_pay_type1 = $row['c_payment_type1'];
                    $l_pay_type2 = $row['c_payment_type2'];
                    $l_net_dp = $row['c_net_dp'];
                    $l_num_pay = $row['c_no_payments'];
                    $l_monthly_dp = $row['c_monthly_down'];
                    $l_first_dp = $row['c_first_dp'];
                    $l_full_dp = $row['c_full_down'];
                    $l_amt_fin = $row['c_amt_financed'];
                    $l_ma_terms = $row['c_terms'];
                    $l_int_rate = $row['c_interest_rate'];
                    $l_fixed_factor = $row['c_fixed_factor'];
                    $l_monthly_ma = $row['c_monthly_payment'];
                    $l_start_date = $row['c_start_date'];
                    $l_retention = $row['c_retention'];
                    $l_change_date = $row['c_change_date'];
                    $l_restructured = $row['c_restructured'];
                    $l_date_of_sale = $row['c_date_of_sale'];
                
                    endwhile;


                  $payments = $conn->query("SELECT remaining_balance, due_date, payment_amount, amount_due, status, status_count, pay_date, surcharge, principal, interest, or_no, rebate, payment_count FROM property_payments WHERE md5(property_id) = '{$_GET['id']}' ORDER by due_date, pay_date, payment_count, remaining_balance DESC");
                  $l_last = $payments->num_rows - 1;
                  if($payments->num_rows <= 0){
                      echo ('No Payment Records for this Account!');
                  } 
                  $l_last = $payments->num_rows - 1;

                  $payments_data = array(); // create an empty array to store the rows
                  while($row = $payments->fetch_assoc()) {
                        $payments_data[] = $row; // add the current row to the array
                       /*  print_r($payments_data[0]['remaining_balance']); */
                    }
                    $last_row = $payments_data[$l_last];

                    $l_bal = $last_row['remaining_balance'];
                    $l_last_due_date = $last_row['due_date'];
                    $l_last_pay_date = $last_row['pay_date'];
                    $l_last_amt_paid = $last_row['payment_amount'];
                    $l_last_amt_due = $last_row['amount_due'];
                    $l_last_sur = $last_row['surcharge'];
                    $l_last_int = $last_row['interest'];
                    $l_last_status = $last_row['status'];
                    $l_last_stat_cnt = $last_row['status_count'];
                    $l_last_rebate = $last_row['rebate'];
                    $l_last_prin = $last_row['principal'];
                    $l_last_or_no = $last_row['or_no'];
                    $l_last_pay_cnt = $last_row['payment_count'];


                    $all_payments= array();
                    for ($x = 0; $x < $payments->num_rows; $x++){
                      if ($l_last_pay_date == $payments_data[$x]['pay_date']):
                          if ($payments_data[$x]['due_date'] != 0){
                              $l_date = strtotime($payments_data[$x]['due_date']);
                              $l_due_date = date('m/d/y', $l_date);
                             
                          }
                          else{
                              $l_due_date = '';
                          }
                          if ($payments_data[$x]['pay_date'] != 0){
                              $l_date = strtotime($payments_data[$x]['pay_date']);
                              $l_last_pay_date1 =  date('m/d/y', $l_date);
                          }
                          else{
                              $l_last_pay_date1 = '';
                          }
                          $l_data = array($l_due_date, $l_last_pay_date1, $payments_data[$x]['or_no'], number_format($payments_data[$x]['payment_amount'],2), 
                          number_format($payments_data[$x]['amount_due'],2), number_format($payments_data[$x]['interest'],2), 
                          number_format($payments_data[$x]['principal'],2), number_format($payments_data[$x]['surcharge'],2), number_format($payments_data[$x]['rebate'],2), 
                          str_replace(" ", "", $payments_data[$x]['status']), number_format($payments_data[$x]['remaining_balance'],2));
                          array_push($all_payments, $l_data);
                        
                      endif;
                      }
                        
                    if ($l_acc_status == 'Fully Paid'):
                        return;
                        endif;
                    $l_tot_amnt_due = 0;
                    $l_tot_surcharge = 0;
                    $l_tot_principal = 0;
                    $l_tot_interest = 0;


                    if ($l_retention == '1') {
                      $l_due_date = date('Y-m-d',strtotime($l_last_due_date));
                      $t_due_date = add($l_due_date,1);
                      $t_due_date = $t_due_date->format('m/d/y');
                
                      $l_data = array($t_due_date,"----------",'******','0.00',number_format($l_bal,2),'0.00',number_format($l_bal,2),'0.00','0.00','RETENTION',number_format($l_bal,2));
                      array_push($all_payments, $l_data);
                    }else {
                      $l_mode = 1;
                      $l_date_bago = $l_start_date;
                    }

                    $l_mode = 1;
                    $l_date_bago = $l_start_date;
                    while ($l_mode == 1):
                          if (($l_pay_type1 == 'Partial DownPayment' && ($l_acc_status == 'Reservation' || $l_acc_status == 'Partial DownPayment')) || ($l_pay_type1 == 'Full DownPayment' && $l_acc_status == 'Partial DownPayment')) {
                                  $l_date = date('Y-m-d',strtotime($l_first_dp));
                                  
                                  // check for fulldown
                                  $l_full_down = $l_bal - $l_amt_fin;
                                  $l_monthly_pay = $l_monthly_dp;
                                  if ($l_full_down <= $l_monthly_pay):
                                    $l_fd_mode = 1;
                                  else:
                                    $l_fd_mode = 0;
                                  endif;
                                  if ($l_acc_status == 'Reservation' || $l_last_status == 'RESTRUCTURED' || $l_last_status == 'RECOMPUTED' || $l_last_status == 'ADDITIONAL'):
                                          if ($l_last_status == 'ADDITIONAL'):
                                            $l_date = date('Y-m-d',strtotime($l_last_due_date));
                                          
                                            if ($l_change_date == '1'):
                                                $l_date = date('Y-m-d',strtotime($l_first_dp));
                                            endif;
                                          
                                            $l_date2 =add($l_date,1);
                                            $l_due_date  = $l_date2->format('m/d/y');
                                            $l_due_date_val = $l_date2;
                                            $l_count = $l_last_stat_cnt + 1;
                                          else:
                                            $l_due_date  = $l_date->format('m/d/y');
                                            $l_due_date_val =$l_date;
                                            $l_count = 1;
                                          endif;
                                        $l_new_due_date_val = $l_due_date_val;
                                        $l_amt_due = number_format($l_monthly_pay,2);
                                        $l_principal = $l_amt_due;
                                        if ($l_num_pay == $l_count || $l_fd_mode == 1):
                                            $l_acc_status = 'Full DownPayment';
                                            $l_status = 'FD';
                                            $l_count = 0;
                                        else:
                                            $l_status = 'PD-' . strval($l_count);
                                            $l_acc_status = 'Partial DownPayment';
                                        endif;
                                  elseif ($l_acc_status == 'Partial DownPayment'):
                                        $l_date = date('Y-m-d',strtotime($l_last_due_date));
                                        if ($l_change_date == '1'):
                                                $l_date =  date('Y-m-d',strtotime($l_first_dp));
                                        endif;
                                        if ($l_last_amt_paid < $l_last_amt_due):
                                                  $l_last_tot_surcharge = 0;
                                                  $l_last_tot_prin = 0;

                                                  for ($x = 0; $x <= $l_last; $x++) {
                                                    try {
                                                      if ($l_last_status == $payments_data[$x]['status'] && $l_last_due_date == $payment_data[$x]['due_date']) {
                                                          $l_last_tot_prin += $payments_data[$x]['principal'];
                                                          $l_last_tot_surcharge += $payments_data[$x]['surcharge'];
                                                          if ($l_last_amt_paid < $payments_data[$x]['surcharge']) {
                                                          $l_tot_surcharge += ($l_last_tot_surcharge - $l_last_amt_paid);
                                                          } elseif ($l_last_amt_paid == $payments_data[$x]['surcharge']) {
                                                          $l_tot_surcharge = 0;
                                                          }
                                                    }
                                                    } catch (Exception $e) {
                                                    // do nothing
                                                    }
                                                    }
                                                  if (strtotime(($l_last_pay_date)) > strtotime(($l_last_due_date))):
                                                    $l_date = strtotime($l_last_pay_date);
                                                  else:
                                                    $l_date = strtotime($l_last_due_date);
                                                  endif;
                                                
                                                  $l_monthly = $l_last_amt_due - $l_last_amt_paid;
                                                  if ($l_last_tot_surcharge > 0 && $l_last_tot_prin > 0):
                                                    $l_monthly_pay = $l_monthly;
                                                  else:
                                                    $l_monthly_pay = $l_monthly_pay - $l_last_tot_prin;
                                                  endif;
                                                  $l_count = $l_last_stat_cnt;
                                                  $l_due_date_val = date('Y-m-d',($l_date));
                                                  $l_new_due_date_val = date('Y-m-d',($l_last_due_date));
                                                  $l_amt_due = number_format($l_monthly,2);
                                                  
                                                  
                                                  if ($l_last_tot_prin == 0 && $l_last_tot_surcharge > 0):
                                                    $l_principal = number_format($l_monthly_dp,2);
                                                  else:
                                                    $l_principal = $l_amt_due;
                                                  endif;
                                                  
                                                  if ($l_num_pay == $l_count || $l_fd_mode == 1):
                                                    $l_status = 'FD';
                                                    $l_monthly_pay = $l_full_down;
                                                    $l_principal = number_format($l_full_down,2);
                                                    $l_amt_due = number_format(($l_monthly_pay + $l_tot_surcharge),2);
                                                    $l_acc_status = 'Full DownPayment';
                                                    $l_count = 0;
                                                  else:
                                                    $l_status = 'PD-' .strval($l_count);
                                                    $l_acc_status = 'Partial DownPayment';
                                                  endif;
                                        else:  
                                                $l_date2 = $l_date;
                                                $l_due_date_val = $l_date2;
                                                $l_new_due_date_val = $l_due_date_val;
                                                $l_date = $l_date2;
                                                $l_due_date =  $l_date->format('m/d/y');
                                                $l_count = $l_last_stat_cnt + 1;
                                                $l_amt_due = number_format($l_monthly_pay,2);
                                                $l_principal = $l_amt_due;

                                                if ($l_num_pay == $l_count || $l_fd_mode == 1):
                                                  $l_status = 'FD';
                                                  $l_monthly_pay = $l_full_down;
                                                  $l_amt_due = number_format($l_monthly_pay,2);
                                                  $l_principal = $l_amt_due;
                                                  $l_acc_status = 'Full DownPayment';
                                                  $l_count = 0;
                                                else:
                                                    $l_status = 'PD-' . strval($l_count);
                                                    $l_acc_status = 'Partial DownPayment';
                                                endif;
                                          endif;
                                  endif;
                                  $l_rebate = '0.00';
                                  $l_interest = '0.00'; 
                                  $l_new_bal = ($l_bal - floatval($l_principal));
                                  $l_new_bal = number_format($l_new_bal) ;

                          }elseif ($l_pay_type1 == 'Spot Cash' && $l_acc_status == 'Reservation') {
                            $l_date = date('Y-m-d',strtotime($l_start_date));
                            $l_due_date = $l_date->format('m/d/y');
                            $l_due_date_val = strtotime($l_start_date);
                            $l_new_due_date_val = $l_due_date_val;
                            $l_status = 'FPD';
                            $l_monthly_pay = $l_bal;
                            $l_amt_due = number_format($l_bal,2);
                            $l_rebate = '0.00';
                            $l_interest = '0.00';
                            $l_principal = $l_amt_due;
                            $l_mode = 0;
                            $l_count = 1;
                            $l_acc_status = 'Fully Paid';
                            $l_new_bal = ($l_bal - floatval($l_principal));
                            $l_new_bal = number_format($l_new_bal) ;

                        }elseif ($l_pay_type1 == 'Full DownPayment' && $l_acc_status == 'Reservation') {
                          $l_date = date('Y-m-d', strtotime($l_full_dp));
                          $l_due_date = $l_date->format('m/d/y');
                          $l_due_date_val = strtotime($l_full_dp);
                          $l_new_due_date_val = $l_due_date_val;
                          $l_status = 'FD';
                          $l_monthly_pay = $l_net_dp;
                          $l_amt_due = number_format($l_net_dp,2);
                          $l_rebate = '0.00';
                          $l_interest = '0.00';
                          $l_principal = $l_amt_due;
                          $l_count = 0;
                          $l_acc_status = 'Full DownPayment';
                          $l_new_bal = ($l_bal - floatval($l_principal));
                          $l_new_bal = number_format($l_new_bal) ;
                          $l_date_bago = $l_start_date;
                        }else{
                          $total_amount_due_ent =($l_tot_amnt_due);
                          $total_principal_ent = ($l_tot_principal);
                          $total_surcharge_ent = ($l_tot_surcharge);
                          $total_interest_ent = ($l_tot_interest);
                        }
                        $l_bal = floatval($l_new_bal);
                        $l_surcharge = '0.00';
                        $l_data = array($t_due_date,"----------","******",'0.00',$l_amt_due,$l_interest,$l_principal,$l_surcharge,$l_rebate,$l_status,$l_new_bal);
                        array_push($all_payments, $l_data);

                        $l_tot_amnt_due += floatval($l_amt_due);
                        $l_tot_surcharge += floatval($l_surcharge);
                        $l_tot_principal += floatval($l_principal);
                        $l_tot_interest += floatval($l_interest);
                        $l_interest = 0.00;
                        $l_surcharge = 0.00;
                        $l_rebate = 0.00;

                        $l_last_due_date =$l_new_due_date_val->format('Y-m-d');
                        $l_last_amt_paid = floatval($l_amt_due);
                        $l_last_amt_due = floatval($l_amt_due);
                        $l_last_status = $l_status;
                        $l_last_stat_cnt = $l_count;

                  
                        $l_due_date_val = add($last_due_date, 1);
                        $l_due_date_val = $l_due_date_val->format('Y-m-d');

                        if ($l_mode == 1 and $l_due_date_val > $l_pay_date_val){
                            if ($l_date_bago != $l_full_dp){
                                $l_mode = 0;
                            }
                                $l_mode = 1;
                        }

                        $l_mode = 0;
                        endwhile;

                    ?>
                       <?php foreach ($all_payments as $l_data): ?>
                         

                          <tr>
                            <td class="text-center"><?php echo $l_data[0] ?></td> 
                            <td class="text-center"><?php echo $l_data[1] ?></td> 
                            <td class="text-center"><?php echo $l_data[2] ?> </td> 
                            <td class="text-center"><?php echo $l_data[3] ?> </td> 
                            <td class="text-center"><?php echo $l_data[4] ?> </td> 
                            <td class="text-center"><?php echo $l_data[5] ?> </td> 
                            <td class="text-center"><?php echo $l_data[6] ?> </td> 
                            <td class="text-center"><?php echo $l_data[7] ?> </td> 
                            <td class="text-center"><?php echo $l_data[8] ?> </td>  
                            <td class="text-center"><?php echo $l_data[9] ?> </td>  
                            <td class="text-center"><?php echo $l_data[10] ?> </td>  
                          </tr>
                         
                         <?php endforeach; ?>


                    </tbody>
                  </table>
                  
                  
            </div>
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

  
  $('.add_payment').click(function(){
		/* uni_modal('Add Payment','payments.php?id='+$(this).attr('data-id')) */
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
</script>