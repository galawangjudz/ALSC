<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
.disabled-link {
  pointer-events: none;
  opacity: 0.6;
  cursor: default;
}
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
/* #uni_modal .modal-footer{
		font-size:12px!important;
    font-weight: bold;
	}  */
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
    width:100%;
    margin-right:auto;
    margin-left:auto;
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
#view_tooltip:hover span {
    opacity:1;
    width: auto;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding:5px;
    transition: opacity 0.5s ease;
}

</style>
<?php $qry = $conn->query("SELECT * FROM property_clients where md5(property_id) = '{$_GET['id']}' ");
	$row= $qry->fetch_assoc();
  $client_id = $row['client_id'];
  // $acc_stat = $row['c_reopen'];

?>

<!-- <body onload="check_reopen()"> -->
<body>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
      <div class="card-tools">
				<a class="btn btn-block btn-default btn-flat bg-maroon update_client" client-id="<?php echo $client_id; ?>" style="font-size:14px;"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update Details</a>
			</div>
	</div>
  
<div class="card-header">
<h5 class="card-title"><b><i>Client Information</b></i></h5>
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
        <!-- <input type="hidden" value="<?php echo $row['c_reopen'];?>" id="txt_reopen"/> -->
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
              <a class="btn btn-flat btn-primary add_member" id="add_member_btn" client-id="<?php echo $client_id; ?>" style="margin-bottom:10px;font-size:14px;"><span class="fas fa-plus"></span>&nbsp;&nbsp;Add Member</a>
              <?php $qry2 = $conn->query("SELECT * FROM family_members where client_id = $client_id and status=1");
                    $qry9 = $conn->query("SELECT * FROM family_members where client_id = $client_id and status=0");
                    $qry8 = $conn->query("SELECT * FROM family_members where client_id = $client_id and status=2");
                if($qry8->num_rows > 0){
                  echo "<a class='btn btn-flat bg-secondary' client-id='' style='margin-bottom:10px;font-size:14px;margin-right:3px;' href='" . base_url . "admin/?page=clients/family_members/inactive_list&id=$client_id'><span class='fas fa-minus'></span>&nbsp;&nbsp;View Inactive Members List</a>";
                }
                if($qry9->num_rows > 0){
                  echo "<a class='btn btn-flat bg-maroon' client-id='' style='margin-bottom:10px;font-size:14px;' href='" . base_url . "admin/?page=clients/family_members&id=$client_id'><span class='fas fa-eye'></span>&nbsp;&nbsp;View Pending List</a>";
                }
                if($qry2->num_rows <= 0 and $qry9->num_rows <= 0){
                  echo " No Family Member Found";
                }
                else if($qry2->num_rows > 0){ ?> 
                <table class="table2 table-bordered table-stripped">
                 
                    <thead style="text-align:center;"> 
                        <tr>
                        <th style="text-align:center;font-size:13px;">LAST NAME</th> 
                        <th style="text-align:center;font-size:13px;">FIRST NAME</th>
                        <th style="text-align:center;font-size:13px;">ADDRESS</th>
                        <th style="text-align:center;font-size:13px;">CONTACT NO</th>
                        <th style="text-align:center;font-size:13px;">EMAIL ADDRESS</th>
                        <th style="text-align:center;font-size:13px;">RELATIONSHIP</th>
                        <th style="text-align:center;font-size:13px;">ACTION</th>
                  
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
                        <?php } ?>
                        <td class="text-center" style="font-size:12px;width:20%;"><a class="btn btn-flat btn-success btn-s update_family_mem" style="font-size:12px;height:30px;width:100px;" data-id="<?php echo $row['member_id'] ?>"><i class="fa fa-edit"></i>&nbsp;&nbsp;Update</a></td>

                          <?php
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
                          <th style="text-align:center;font-size:13px;">RETETION STATUS</th>
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
                                <td class="text-center" style="width:15%;"><span class="badge badge-primary">Lot Only</span></td>
                            <?php }elseif($row['c_type'] == 2){ ?>
                                <td class="text-center" style="width:15%;"><span class="badge badge-primary">House Only</span></td>
                            <?php }elseif($row['c_type'] == 3){ ?>
                                <td class="text-center" style="width:15%;"><span class="badge badge-primary">Packaged</span></td>         
                            <?php }elseif($row['c_type'] == 4){ ?>
                                <td class="text-center" style="width:15%;"><span class="badge badge-primary">Fence</span></td>
                            <?php }elseif($row['c_type'] == 5){ ?>
                                <td class="text-center" style="width:15%;"><span class="badge badge-primary">Add Cost</span></td>
                            <?php } ?>      
                            <?php if($row['c_retention'] == 1){ ?>
                                <td class="text-center" style="width:10%;"><span class="badge badge-danger">Retention</span></td>
                            <?php }elseif($row['c_retention'] == 0){ ?>
                                <td class="text-center" style="width:10%;"><span class="badge badge-primary">Regular</span></td>
                            <?php } ?>  
                            <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($row['c_net_tcp'],2) ?></td>
                            <td class="text-center" style="font-size:12px;width:30%;">
                              <a class="btn btn-flat btn-success btn-s view_data" style="font-size: 12px; height: 30px; width: 37px;" data-id="<?php echo md5($row['property_id']) ?>" id="view_tooltip">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                                <span class="tooltip">View</span>
                              </a>
                              <a class="btn btn-flat btn-warning btn-s retention_acc" style="font-size:12px;height:30px;width:37px;" prop-id="<?php echo $row['property_id'] ?>" id="view_tooltip">
                                <i class="fa fa-magnet" aria-hidden="true"></i>
                                <span class="tooltip">Retention</span></a>
                                <?php
                                  $qry12 = $conn->query("SELECT * FROM pending_restructuring where md5(property_id) = '{$_GET['id']}' and pending_status = 1 ");
                                  if ($qry12->num_rows > 0) {
                                      echo '<a class="btn btn-primary btn-flat restructured_data disabled" style="font-size:12px;height:30px;width:37px;" data-id="' . md5($row['property_id']) . '" id="view_tooltip" onclick="return false;">
                                          <i class="fa fa-redo" aria-hidden="true"></i>
                                          <span class="tooltip">Restructuring</span>
                                      </a>';
                                  } else {
                                      echo '<a class="btn btn-primary btn-flat restructured_data" style="font-size:12px;height:30px;width:37px;" data-id="' . md5($row['property_id']) . '" id="view_tooltip">
                                          <i class="fa fa-redo" aria-hidden="true"></i>
                                          <span class="tooltip">Restructuring</span>
                                      </a>';
                                  }
                                  ?>
                              <a class="btn btn-danger btn-flat backout_acc" style="font-size: 12px; height: 30px; width: 37px;" prop-id="<?php echo $row['property_id'] ?>" csr-no="<?php echo $row['c_csr_no'] ?>" id="view_tooltip">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                <span class="tooltip">Backout</span>
                              </a>
                            </td>                            
                            <?php endwhile; }?>  
                                
                            </tbody>
                        </table>
                       
                         
                            <?php  $history = " WITH RECURSIVE cte AS (
                                        SELECT *
                                        FROM properties
                                        WHERE md5(property_id) = '{$_GET['id']}'
                                        
                                        UNION ALL
                                        
                                        SELECT t.*
                                        FROM properties t
                                        JOIN cte ON t.property_id = cte.old_property_id
                                    )
                                    SELECT *
                                    FROM cte where md5(property_id) != '{$_GET['id']}'
                                    ORDER BY property_id ";
                            //echo $history;
                            $qry4 = $conn->query($history);

                                 
                                if($qry4->num_rows <= 0){ ?>
                                  <tbody>
                                    
                                      <td>
                                        <?php  echo ""; ?>
                                      <td>
                                    
                                  </tbody>
                                </table>
                                <?php }else{ ?>

                                      <br>
                                      <h5 class="card-title"><b><i>Old Account History</b></i></h5>
                                      <table class="table2 table-bordered table-stripped" style="width:100%;">
                                        <thead> 
                                      
                                            <tr>
                                              <th style="text-align:center;font-size:13px;">PROPERTY ID</th>
                                              <th style="text-align:center;font-size:13px;">LOCATION</th>
                                              <th style="text-align:center;font-size:13px;">TYPE</th>
                                              <th style="text-align:center;font-size:13px;">RETETION STATUS</th>
                                              <th style="text-align:center;font-size:13px;">NET TCP</th>  
                                              <th style="text-align:center;font-size:13px;">ACTION</th>          
                                            </tr>
                                        </thead>
                                        <tbody><?php
                                    while($row = $qry4->fetch_assoc()):
                                      $property_id = $row["property_id"];
                                      //echo $property_id;
                                      $qry3 = $conn->query("SELECT p.*, r.c_acronym, l.c_block, l.c_lot FROM properties p LEFT JOIN t_lots l on l.c_lid = p.c_lot_lid LEFT JOIN t_projects r ON l.c_site = r.c_code where property_id =" .$property_id);
                                      
                                     $row_details = $qry3->fetch_assoc();

                                      $property_id_part1 = substr($property_id, 0, 2);
                                      $property_id_part2 = substr($property_id, 2, 6);
                                      $property_id_part3 = substr($property_id, 8, 5);
                                    ?>    
                                   <tr>
                                   <td class="text-center" style="font-size:13px;width:20%;"><?php echo $property_id_part1 . "-" . $property_id_part2 . "-" . $property_id_part3?> <span class="badge badge-danger">Old Account</span></td>
                                   <td class="text-center" style="font-size:13px;width:20%;"><?php echo $row_details["c_acronym"]. ' Block ' .$row_details["c_block"] . ' Lot '.$row_details["c_lot"] ?></td>
                                   <?php if($row['c_type'] == 1){ ?>
                                      <td class="text-center" style="width:15%;"><span class="badge badge-primary">Lot Only</span></td>
                                  <?php }elseif($row['c_type'] == 2){ ?>
                                      <td class="text-center" style="width:15%;"><span class="badge badge-primary">House Only</span></td>
                                  <?php }elseif($row['c_type'] == 3){ ?>
                                      <td class="text-center" style="width:15%;"><span class="badge badge-primary">Packaged</span></td>         
                                  <?php }elseif($row['c_type'] == 4){ ?>
                                      <td class="text-center" style="width:15%;"><span class="badge badge-primary">Fence</span></td>
                                  <?php }elseif($row['c_type'] == 5){ ?>
                                      <td class="text-center" style="width:15%;"><span class="badge badge-primary">Add Cost</span></td>
                                  <?php } ?>      
                                  <?php if($row['c_retention'] == 1){ ?>
                                      <td class="text-center" style="width:10%;"><span class="badge badge-danger">Retention</span></td>
                                  <?php }elseif($row['c_retention'] == 0){ ?>
                                      <td class="text-center" style="width:10%;"><span class="badge badge-primary">Regular</span></td>
                                  <?php } ?> 
                                  <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($row['c_net_tcp'],2) ?></td>
                                  <td class="text-center" style="font-size:12px;width:30%;">
                                  <a class="btn btn-flat btn-success btn-s view_data" style="font-size: 12px; height: 30px; width: 37px;" data-id="<?php echo md5($row['property_id']) ?>" id="view_tooltip">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                    <span class="tooltip">View</span>
                                  </a>

                                   <tr>
                                  <?php endwhile ; }?>
                          </tr>

                    </tbody>
                </table>
            </div>

            <div id="tab-3" class="tab-content" style="border:solid 1px gainsboro;">  
              <div style="background-color:#F5F5F5;margin-bottom:20px;border-radius:5px;padding:5px;">
                <!-- <button type="button" class="btn btn-primary add_payment" data-id="<?php echo md5($property_id)  ?>"><span class="fa fa-plus"> Add Payments </span></button>    -->
                <table style="width:100%;">
                  <tr style="width:100%;">
                    <td style="width:10%;">
                    <?php
                      $qry11 = $conn->query("SELECT * FROM pending_restructuring where md5(property_id) = '{$_GET['id']}' and pending_status=1");
                      if($qry11->num_rows > 0){
                        echo '<a href="" class="btn btn-flat bg-maroon pull-right disabled-link" style="width:100%; font-size:13px;" disabled><span class="fas fa-redo"></span>&nbsp;&nbsp;Pending for Restructuring</a>';
                      }else{
                        echo "<a href='./?page=clients/payment_wdw&id=" . md5($property_id) . "' class='btn btn-flat btn-success pull-right' style='width:100%; font-size:13px;'><span class='fas fa-plus'></span>&nbsp;&nbsp;New Payment</a>";

                      }
                    ?>
                    </td>
                    <td style="width:10%;">
                      <a href="<?php echo base_url ?>/report/print_properties.php?id=<?php echo md5($property_id); ?>", target="_blank" class="btn btn-flat btn-secondary pull-right"  style="width:100%;font-size:13px;"><span class="fas fa-print"></span>&nbsp;&nbsp;Print</a>            
                    </td>
                    <td style="width:10%;">
                      <a class="btn btn-flat btn-danger delete-last-or" prop-id="<?php echo $property_id; ?>" style="width:100%;font-size:13px;"><span class="fas fa-trash"></span>&nbsp;&nbsp;Delete Last OR</a>
                    </td>
                    <td style="width:10%;">
                      <a class="btn btn-flat btn-info undo-delete-last-or" prop-id="<?php echo $property_id; ?>" style="width:100%;font-size:13px;"><span class="fas fa-undo"></span>&nbsp;&nbsp;Undo</a>
                    </td>
                    <td style="width:10%;">
                     <!-- <?php
                          $qry13 = $conn->query("SELECT * FROM t_av_summary where md5(property_id) = '{$_GET['id']}'");
                          if($qry13->num_rows > 0){
                            echo '<a href="" class="btn btn-flat bg-maroon pull-right disabled-link" style="width:100%; font-size:13px;" disabled><span class="fas fa-redo"></span>&nbsp;&nbsp;Pending for AV</a>';
                          }else{
                            echo '<a class="btn btn-flat btn-dark new_av" prop-id="<?php echo $property_id; ?>" style="width:100%;font-size:13px;"><span class="fas fa-receipt"></span>&nbsp;&nbsp;AV</a>';
                      }
                    ?> -->
                      <a class="btn btn-flat btn-dark new_av" prop-id="<?php echo $property_id; ?>" style="width:100%;font-size:13px;"><span class="fas fa-receipt"></span>&nbsp;&nbsp;AV</a>
                    </td>
                  </tr>
                </table>
              </div>  
                    <table class="table2 table-bordered table-stripped">
                    <?php $qry4 = $conn->query("SELECT * FROM property_payments where md5(property_id) = '{$_GET['id']}'  ORDER by due_date, pay_date, payment_count ASC");
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
                              <th style="text-align:center;font-size:13px;">SURCHARGE</th>
                              <th style="text-align:center;font-size:13px;">INTEREST</th>
                              <th style="text-align:center;font-size:13px;">PRINCIPAL</th>
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
                        <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($surcharge,2) ?> </td>  
                        <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($interest,2) ?> </td> 
                        <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($principal,2) ?> </td> 
                        <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($rebate,2) ?> </td> 
                        <td class="text-center" style="font-size:13px;width:10%;"><?php echo $period ?> </td> 
                        <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($balance,2) ?> </td>  
                      </tr>
                        <?php endwhile ; } ?>
                    </tbody>
                </table>

              
                <div class="col-md-12">
                    <div class="form-group">
                      <table>
                          <tr>
                          <?php $qry_prin = "SELECT SUM(principal) AS p_principal FROM property_payments where md5(property_id) = '{$_GET['id']}' ";

                            $result = mysqli_query($conn, $qry_prin);

                            // Check if the query was successful
                            if (mysqli_num_rows($result) > 0) {
                                // Fetch the result as an associative array
                                $row = mysqli_fetch_assoc($result);
                                // Get the sum value
                                $total_prin = $row["p_principal"];
                                // Display the sum value
                            } else {
                                echo "No results found.";
                            }
                            ?>
                            <?php $qry_surcharge = "SELECT SUM(surcharge) AS p_surcharge FROM property_payments where md5(property_id) = '{$_GET['id']}' ";

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
                            <?php $qry_interest = "SELECT SUM(interest) AS p_interest FROM property_payments where md5(property_id) = '{$_GET['id']}' ";

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
                            <?php $qry_amt_due = "SELECT SUM(amount_due) AS p_amt_due FROM property_payments where md5(property_id) = '{$_GET['id']}' ";

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
                              <td style="font-size:12px;"><label for="tot_prin" class="control-label">Total Principal: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_prin" id="tot_prin" value="<?php echo number_format($total_prin,2) ?>" style="width:125px;"></td>
                              <td style="font-size:12px;"><label for="tot_reb" class="control-label">Total Rebate: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_reb" id="tot_reb" value="<?php echo number_format($total_rebate,2) ?>" style="width:125px;"></td>
                              <td style="font-size:12px;"><label for="tot_sur" class="control-label">Total Surcharge: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_sur" id="tot_sur" value="<?php echo number_format($total_surcharge,2) ?>" style="width:125px;"></td>
                              <td style="font-size:12px;"><label for="tot_int" class="control-label">Total Interest: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_int" id="tot_int" value="<?php echo number_format($total_interest,2) ?>" style="width:125px;"></td>
                              <td style="font-size:12px;"><label for="tot_amt_due" class="control-label">Total Amount Due: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_amt_due" id="tot_amt_due" value="<?php echo number_format($main_total,2) ?>" style="width:125px;"></td>
                          </tr>
                      </table>
                    </div>
                </div>
                
            </div>   

            </div>
     
            <div id="tab-4" class="tab-content" style="border:solid 1px gainsboro;">
              
          
              <?php
                      
                include 'payment_schedule_to_fpd.php'; 
                $id = $_GET['id'];
                $all_payments = load_data($id); 
                $over_due    = $all_payments[0];
                $total_amt_due = $all_payments[1];
                $total_interest =  $all_payments[2];
                $total_principal = $all_payments[3];
                $total_surcharge = $all_payments[4];

                ?>
            
              <a href="<?php echo base_url ?>/report/print_payment_schedule.php?id=<?php echo md5($property_id); ?>", target="_blank" class="btn btn-flat btn-secondary pull-right" style="margin-bottom:10px;font-size:13px;"><span class="fas fa-print"></span>&nbsp;&nbsp;Print</a>
           
              <table class="table2 table-bordered table-stripped">
                  <thead> 
                      <tr>
                          <th class="text-center" style="font-size:13px;">DUE DATE</th>
                          <th class="text-center" style="font-size:13px;">PAY DATE</th>
                          <th class="text-center" style="font-size:13px;">OR NO</th>
                          <th class="text-center" style="font-size:13px;">AMOUNT PAID</th> 
                          <th class="text-center" style="font-size:13px;">AMOUNT DUE</th>
                          <th class="text-center" style="font-size:13px;">SURCHARGE</th>
                          <th class="text-center" style="font-size:13px;">INTEREST</th>
                          <th class="text-center" style="font-size:13px;">PRINCIPAL</th>
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
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[7] ?> </td>  
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[5] ?> </td>
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[6] ?> </td> 
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
                              <td style="font-size:12px;"><label for="tot_prin2" class="control-label">Total Principal: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_prin2" id="tot_prin2" value="<?php echo isset($total_prin) ? number_format($total_prin): ''; ?>.00" disabled></td>
                              <td style="font-size:12px;"><label for="tot_sur2" class="control-label">Total Surcharge: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_sur2" id="tot_sur2" value="<?php echo isset($total_surcharge) ? $total_surcharge : ''; ?>" disabled></td>
                              <td style="font-size:12px;"><label for="tot_int2" class="control-label">Total Interest: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_int2" id="tot_int2" value="<?php echo isset($total_interest) ? $total_interest : ''; ?>" disabled></td>
                              <td style="font-size:12px;"><label for="tot_amt_due2">Total Amount Due: </label></td>
                              <td><input type="text" class= "form-control-sm" name="tot_amt_due2" id="tot_amt_due2" value="<?php echo isset($total_amt_due) ? $total_amt_due : ''; ?>" disabled></td>
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


  $('.restructured_data').click(function(){
		/* uni_modal('CA Approval','manage_ca.php?id='+$(this).attr('data-id')) */
	  uni_modal("<i class='fa fa-info'></i> Restructuring",'clients/property_restructuring.php?id='+$(this).attr('data-id'),"mid-large")

	})



  $('.new_payment').click(function(){
		
	  uni_modal("<i class='fa fa-plus'></i> Add Payments",'clients/payments.php?id='+$(this).attr('data-id'),"mid-large")

	})



  $('#data-table').dataTable({

  }); 

    $('.retention_acc').click(function(){
        _conf("Are you sure you want to retention?","retention_acc",[$(this).attr('prop-id')])
    }) 

    $('.backout_acc').click(function(){
        _conf("Are you sure you want to backout ?","backout_acc",[$(this).attr('prop-id'),$(this).attr('csr-no')])
    }) 


    $('.delete-last-or').click(function(){
        _conf("Are you sure you want to delete this OR?","delete_last_or",[$(this).attr('prop-id')])
    }) 

    $('.undo-delete-last-or').click(function(){
        _conf("Are you sure you want to undo the deletion of this OR?","undo_delete_last_or",[$(this).attr('prop-id')])
    }) 

   
  $('.tab-link').click(function() {
    var tab_id = $(this).attr('data-tab');

    $('.tab-link').removeClass('current');
    $('.tab-content').removeClass('current');

    $(this).addClass('current');
    $("#"+tab_id).addClass('current');
  })
});



 function undo_delete_last_or($prop_id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=undo_delete_payment",
            method:"POST",
            data:{prop_id: $prop_id},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("Can't delete last payment!",'error');
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

    function retention_acc($prop_id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=set_retention",
            method:"POST",
            data:{prop_id: $prop_id},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("Can't Retention!",'error');
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


    function backout_acc($prop_id,$csr_no){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=backout_acc",
            method:"POST",
            data:{prop_id: $prop_id, csr_no: $csr_no},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("Can't Backout!",'error');
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

    // function move_to_av($prop_id){
    //     start_loader();
    //     $.ajax({
    //         url:_base_url_+"classes/Master.php?f=move_to_av",
    //         method:"POST",
    //         data:{prop_id: $prop_id},
    //         dataType:"json",
    //         error:err=>{
    //             console.log(err)
    //             alert_toast("An error occured!",'error');
    //             end_loader();
    //         },
    //         success:function(resp){
    //             if(typeof resp== 'object' && resp.status == 'success'){
    //                 location.reload();
    //             }else{
    //                 alert_toast("An error occured.",'error');
    //                 end_loader();
    //             }
    //         }
    //     })
    // }


  function delete_last_or($prop_id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_payment",
            method:"POST",
            data:{prop_id: $prop_id},
            dataType:"json",
            error:err=>{
                console.log(err)
                alert_toast("Can't delete last payment!",'error');
                end_loader();
            },
            success:function(resp){
                console.log(resp)
                if(typeof resp== 'object' && resp.status == 'success'){
                    location.reload();
                }else{
                    alert_toast("Can't delete last payment!",'error');
                    end_loader();
                }
            }
        })
    }


    $('.update_client').click(function(){
      //uni_modal_right("<i class='fa fa-paint-brush'></i> Edit Client",'sales/client_update.php?id='+$(this).attr('client-id'),"mid-large")
      uni_modal("<i class='fa fa-paint-brush'></i> Edit Client",'clients/client_update.php?id='+$(this).attr('client-id'),"mid-large")

    })

    
    $('.add_member').click(function(){
      //uni_modal_right("<i class='fa fa-paint-brush'></i> Edit Client",'sales/client_update.php?id='+$(this).attr('client-id'),"mid-large")
      uni_modal("<i class='fa fa-paint-brush'></i> Add Member",'clients/save_member.php?cid='+$(this).attr('client-id'),"mid-large")

    })

    $('.new_av').click(function(){
        uni_modal("<i class='fa fa-plus'></i> Move to AV",'clients/application_voucher/av_payment.php?id='+$(this).attr('prop-id'),"mid-large")
    })

    $('.new_av2').click(function(){
        uni_modal("<i class='fa fa-plus'></i> Move to AV",'clients/application_voucher/av_modal2.php?id='+$(this).attr('prop-id'),"mid-large")
    })
 
 
    $('.update_family_mem').click(function(){
      //uni_modal_right("<i class='fa fa-paint-brush'></i> Edit Client",'sales/client_update.php?id='+$(this).attr('client-id'),"mid-large")
      uni_modal("<i class='fa fa-paint-brush'></i> Update Member",'clients/save_member.php?id='+$(this).attr('data-id'),"mid-large")

    })
    
    function check_reopen(){
    var reopen_stat = document.getElementById('txt_reopen').value;
  
    if (reopen_stat == '1'){
      alert('This account is for reopen!');
      //document.getElementById('add_member_btn').disabled = true;

    }
  }

</script>