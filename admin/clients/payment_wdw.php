
<?php 
include 'common.php';

if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<?php

if(isset($_GET['id'])){
    include('payment_reload.php');
}

?>

<body onload="">
<div class="card-body">
    <div class="divBtnOverdue">
        <button class="btn btn-light" id="overduebtn" style="float:right;margin-top:5px;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z"/>
        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z"/>
        </svg>
        </button><h3 class="card-title" style="float:right;padding-top:15px;"><b>VIEW/HIDE OVERDUE DETAILS&nbsp;&nbsp;&nbsp;</b></h3><br>
    </div>
</div>

    <!-- <div class="card-header">
        <h3 class="card-title"><b>Property ID #: <i><?php echo $prop_id ?></i> </b></h3>
    </div> -->
    <!-- <label style="float:left;height:30px;width:100px;;background-color:red;">Set Due Date: </label> -->
    <div class="top_table"> 
        <div id='overduediv' style="display:none;">
            <div class="card card-outline rounded-0 card-maroon"> 
                <form action="<?php echo base_url ?>admin/?page=clients/payment_wdw&id=<?php echo $getID ?>" method="post" style="padding-top:15px;padding-left:15px;">
                    <input type="date" name="pay_date_input" id="pay_date_input" value="<?php echo isset($pay_date_ent) ? date("Y-m-d", strtotime($pay_date_ent)) : date("Y-m-d");?>">
                    <button type="submit" name="submit" class="btn btn-primary btn-sm">Submit</button>
                </form>
            <?php include 'over_due_details.php'; ?>
            </div>
        </div>
    </div>
</body>

<style>

.not-clickable {
    pointer-events: none;
    opacity: 0.5;
}

.divBtnOverdue{
    height:50px;
    width:103%!important;
    margin-left:-1.5%!important;
    padding-right:1%;
    background-color:#E1E1E1;
    border-radius:5px;
}
#item-list th, #item-list td{
	padding:5px 3px!important;
}

.container-fluid p{
    margin: unset
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
.container {
  display: flex;
  justify-content: space-between; 
  align-items: flex-start;
  width:100%!important;
  height:auto;
}
.left-div {
  width: 30%; 
  top:0;
  overflow-x: auto;
  padding:1%;
}
.right-div {
  width: 70%;
  top:0;
  overflow-x: auto;
  padding:1%;
}
.main_container{
    display: flex;
    justify-content: space-between; 
    align-items: flex-start;
    width:100%!important;
    height:auto;
}
.hide-row {
  display: none;
}
.default-hide {
  display: none;
}
</style>
<div class="main_container">
    <div class="left-div"> 
        <div class="card card-outline rounded-0 card-maroon" style="padding:5px;">
            <div class="container-fluid">
                <h3 class="card-title"><b>TRANSACTION</b></h3>     
                <br><hr style="height:1px;border-width:0;color:gray;background-color:gray">
                <form action="" method="POST" id="save_payment">
                    <table class="table2 table-bordered table-stripped" style="width:100%;table-layout: fixed;"> 
                        <tr>
                            <td style="width:25%;font-size:13px;"><label for="prop_id">Property ID:</label></td>
                            <td style="width:25%;font-size:13px;"><label for="acc_status">Account Status:</label></td>
                        </tr>
                        <tr>
                            <td style="width:25%;font-size:13px;"><input type="text" id="prop_id" name="prop_id" value="<?php echo $prop_id; ?>" style="width:100%;" readonly></td>
                            <td style="width:25%;font-size:13px;" readonly><input type="text" id="acc_status" name="acc_status" value="<?php echo $acc_status; ?>" style="width:100%;" readonly></td>
                        </tr>
                       <!--  <tr>
                            <td style="width:25%;font-size:13px;"><label for="acc_type1">Account Type1:</label></td>
                            <td style="width:25%;font-size:13px;"><label for="acc_option">Account Option:</label></td>
                        </tr> -->
                       <!--  <tr>
                            <td style="width:25%;font-size:13px;"><input type="text" id="acc_type1" name="acc_type1" value="<?php echo $l_acc_type; ?>" style="width:100%;" readonly></td>
                            <td style="width:25%;font-size:13px;" readonly><input type="text" id="acc_option" name="acc_option" value="<?php echo isset($retention) && $retention == 1 ? 'Retention' : '' ?>" style="width:100%;" readonly><br></td>
                        </tr> -->

                        <tr>
                           <!--  <td style="width:25%;font-size:13px;"><label for="acc_type2">Account Type2:</label></td> -->
                            <td style="width:25%;font-size:13px;"><label for="payment_type1">Payment Type 1:</label></td>
                            <td style="width:25%;"><label for="payment_type2">Payment Type 2:</label></td>
                        </tr>
                        </tr>
                        <tr>
                           <!--  <td style="width:25%;font-size:13px;"> <input type="text" id="acc_type2" name="acc_type2" value="<?php echo $l_acc_type1; ?>" style="width:100%;" readonly></td>
                           -->  <td style="width:25%;font-size:13px;" readonly><input type="text" id="payment_type1" name="payment_type1" value="<?php echo $p1; ?>" style="width:100%;" readonly> </td>    
                                <td style="width:25%;font-size:13px;" readonly><input type="text" id="payment_type2" name="payment_type2" value="<?php echo $p2; ?>" style="width:100%;" readonly></td>
                       
                        </tr>
                       <!--  <tr>
                            <td style="width:25%;font-size:13px;"><label for="date_of_sale">Date of Sale:</label></td>
                            
                        <tr>
                            <td style="width:25%;font-size:13px;"><input type="date" id="date_of_sale" name="date_of_sale" value="<?php echo $l_date_of_sale; ?>" style="width:100%;font-size:14px;" readonly></td>
                            </tr> -->

                        <?php 
                            //echo $last_excess ;
                            $trans_date_ent = $last_trans_date;
                            $or_date_ent = $last_or_date;
                            if ($last_excess != -1 && $last_excess != 0){
                                $amount_paid_ent = number_format($last_excess,2,'.',',');
                                $or_ent = $last_or_ent;
                                
                                
                                }
                
                         ?>
                        <tr>
                            <td style="width:25%;font-size:13px;"><label for="due_date_label">Due Date:</label></td> 
                            <td style="width:25%;font-size:13px;"><label for="amount_due">Amount Due:</label></td>
                           
                        </tr>
                        <tr>
                            <td style="width:25%;font-size:13px;"><input type="date" class="form-control-sm margin-bottom due-date" name="due_date" value="<?php echo date("Y-m-d", strtotime($due_date_ent)); ?>" style="width:100%;" readonly></td>
                            <td style="width:25%;font-size:13px;" readonly><input type="text" class="form-control-sm margin-bottom amt-due"  id="amount_due" name="amount_due" value="<?php echo $amount_ent; ?>" style="width:100%;" readonly></td>
                          
                        </tr>
                        <tr>
                        <td style="width:25%;font-size:13px;"><label for="pay_date">Transaction Date: </label></td>
                            <td style="width:25%;font-size:13px;"><label for="due_date_label">OR Date:</label></td> 
                           
                        </tr>
                        <tr>
                            <td style="width:25%;font-size:13px;"><input type="date" class="form-control-sm margin-bottom trans-date" id="trans_date_ent" name="trans_date_ent" value="<?php echo isset($trans_date_ent) ? date("Y-m-d", strtotime($trans_date_ent)) : date("Y-m-d");?>" style="width:100%;"></td>
                            <td style="width:25%;font-size:13px;"> <input type="date" class="form-control-sm margin-bottom or-date" id="or_date_ent" name="or_date_ent" value="<?php echo isset($pay_date_ent) ? date("Y-m-d", strtotime($pay_date_ent)) : date("Y-m-d");?>" style="width:100%;"></td>
                       
                        </tr>
                        <tr>
                            <td style="width:25%;font-size:13px;"><label for="surcharge">Surcharge:</label>
                                <br>
                                <table style="margin: 0 auto;">
                                    <tr style="">
                                        <td>
                                            <div style="float:left;margin-right:2px;margin-top:2px;">
                                                <input type="radio" name="surcharge_percent" value="0" id="radio0">
                                            </div>
                                            <div style="float:left">
                                                <label class="light">0%<label>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="float:left;margin-right:2px;margin-top:2px;">
                                                <input type="radio" name="surcharge_percent" value="25" id="radio25">
                                            </div>
                                            <div style="float:left">
                                                <label for="radio25">25%</label>
                                            </div>
                                        </td>
                                        <td>    
                                            <div style="float:left;margin-right:2px;margin-top:2px;">
                                                <input type="radio" name="surcharge_percent" value="50" id="radio50">
                                            </div>
                                            <div style="float:left">
                                                <label for="radio25">50%</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table style="margin: 0 auto;">
                                    <tr>
                                        <td>
                                            <div style="float:left;margin-right:2px;margin-top:2px;">
                                                <input type="radio" name="surcharge_percent" value="75" id="radio75">
                                            </div>
                                            <div style="float:left">
                                                <label for="radio25">75%</label>
                                            </div>
                                        </td>
                                        <td>
                                            <div style="float:left;margin-right:2px;margin-top:2px;">
                                                <input type="radio" name="surcharge_percent" value="100" id="radio100">
                                            </div>
                                            <div style="float:left">
                                                <label for="radio25">100%</label>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </td>   

                            <td style="width:25%;font-size:13px;" readonly><input type="text" class="form-control-sm margin-bottom surcharge-amt" id="surcharge" name="surcharge" value="<?php echo isset($surcharge_ent) ? $surcharge_ent : 0.00; ?>" style="width:100%;" readonly></td>
                       

                        </tr>
                        
                        <tr>
                            <td style="width:25%;font-size:13px;"><label for="status">Status:</label></td>
                            <td style="width:25%;font-size:13px;"><label for="rebate">Rebate:</label></td>
                        </tr>
                        <tr>
                            <td style="width:25%;font-size:13px;"><input type="text" class="form-control-sm margin-bottom pay-stat"  id="status" name="status" value="<?php echo $payment_status_ent; ?>" style="width:100%;" readonly></td>
                            <td style="width:25%;font-size:13px;"><input type="text" class="form-control-sm margin-bottom rebate-amt" id="rebate_amt" name="rebate_amt" value="<?php echo isset($rebate_ent) ? $rebate_ent : 0.00; ?>" style="width:100%;" readonly></td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>

                        </tr>
                    </table>

                  
                    <br>
                    <table class="table2 table-bordered table-stripped" style="width:100%;table-layout: fixed;">
                        <tr>
                            <td style="width:25%;font-size:13px;"><label for="tot_amt_due">Total Amount Due:</label></td>
                            <td style="width:25%;font-size:13px;padding-left:10px;"><label for="balance">Balance:</label></td>
                            
                        </tr>
                        <tr>
                            <td style="width:25%;font-size:13px;"><input type="text" class="form-control-sm margin-bottom tot-amt-due"  id="tot_amount_due" name="tot_amount_due" value="<?php echo isset($total_amount_due_ent) ? $total_amount_due_ent : 0.00; ?>" style="width:100%;" readonly></td>
                            <td style="width:25%;font-size:13px;"><input type="text" class="form-control-sm margin-bottom balance-amt"  id="balance" name="balance" value="<?php echo $balance_ent; ?>" style="width:100%;" readonly></td>
                        </tr>
                        <tr>
                            <td style="width:25%;font-size:13px;"><label for="amount_paid">Amount Paid:</label></td>
                            <td style="width:25%;font-size:13px;padding-left:10px;"><label for="or_no">OR #:</label></td>
                        </tr>
                        <tr>
                            <td style="width:25%;font-size:13px;"><input type="text" class="form-control-sm margin-bottom amt-paid"  id="amount_paid" name="amount_paid" value="<?php echo $amount_paid_ent; ?>" style="width:100%;" required></td>
                            <td style="width:25%;font-size:13px;"><input type="text" class="form-control-sm margin-bottom or-no"  id="or_no_ent" name="or_no_ent" value="<?php echo isset($or_ent) ? $or_ent : ''; ?>" style="width:100%;" required ></td>
                        </tr>
                    </table>
                    <input type="hidden" class="form-control-sm margin-bottom int-rate"  id="interest_rate" name="interest_rate" value="<?php echo $interest_rate; ?>"> 
                    <input type="hidden" class="form-control-sm margin-bottom under-pay"  id="under_pay" name="under_pay" value="<?php echo $underpay; ?>"> 
                    <input type="hidden" class="form-control-sm margin-bottom excess"  id="excess" name="excess" value="<?php echo $excess; ?>"> 
                    <input type="hidden" class="form-control-sm margin-bottom last-excess"  id="last_excess" name="last_excess" value="<?php echo $last_excess; ?>"> 
                    <input type="hidden" class="form-control-sm margin-bottom over-due-mode"  id="over_due_mode" name="over_due_mode" value="<?php echo $over_due_mode_upay; ?>">   
                    <input type="hidden" class="form-control-sm margin-bottom monthly-pay"  id="monthly_pay" name="monthly_pay" value="<?php echo $monthly_pay; ?>">   
                    <input type="hidden" class="form-control-sm margin-bottom status-count"  id="status_count" name="status_count" value="<?php echo $count; ?>">   
                    <input type="hidden" class="form-control-sm margin-bottom last-stat-count"  id="last_stat_count" name="last_stat_count" value="<?php echo $last_stat_count; ?>">   
                    <input type="hidden" class="form-control-sm margin-bottom payment-count"  id="payment_count" name="payment_count" value="<?php echo $last_pay_count; ?>">   
                    <input type="hidden" class="form-control-sm margin-bottom last-due"  id="last_due" name="last_due" value="<?php echo $last_due; ?>"> 
                    <input type="hidden" class="form-control-sm margin-bottom "  id="ma_balance" name="ma_balance" value="<?php echo $ma_balance; ?>">   
                    <input type="hidden" class="form-control-sm margin-bottom "  id="last_interest" name="last_interest" value="<?php echo isset($last_interest) ? $last_interest  : 0; ?>">   
                    <input type="hidden" class="form-control-sm margin-bottom "  id="sur_percent" name="sur_percent" value="<?php echo isset($sur_percent) ? $sur_percent  : 0; ?>"> 
                    <br>
                    <table style="width:100%;table-layout: fixed;">
                        <tr>
                            <td>
                                <?php 
                                    if ($acc_status == 'Fully Paid'){
                                        echo ' <input type="submit" name="submit" value="Add to List &#43;" class="btn btn-secondary not-clickable" disabled style="width:100%;font-size:15px;">';
                                        
                                    }else{
                                        echo '<input type="submit" name="submit" value="Add to List &#43;" class="btn btn-info" style="width:100%;font-size:15px;">';
                                    }
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            <?php 
                                if (($acc_status == 'Full DownPayment' && $p2 == 'Monthly Amortization') || ($p1 == 'No DownPayment' && $p2 == 'Monthly Amortization') || ($acc_status == 'Monthly Amortization')){
                                    echo '<a href="#" class="btn btn-success btn-md credit-pri" id="credit_principal" style="width:100%;font-size:15px;">Credit to Principal <i class="fa fa-wallet"></i></a> ';
                                }
                            ?>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>
                            <!-- <a href="#" class="btn btn-success btn-md move-in" id="move_in">Move In Fee</a>  -->

                            
                            <a href="#" class="btn btn-secondary btn-md add-payment-bal" data-id="<?php echo md5($prop_id) ?>" style="width:100%;font-size:15px;">Payment of Balance <i class='fa fa-coins'></i></a> 

                            <a href="#" class="btn btn-danger btn-md delete-all" id="delete_all" style="width:100%;font-size:15px;">Delete All <i class='fa fa-trash'></i></a> 
                            <br>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div> 
    </div>
    <div class="right-div">
        <div class="card card-outline rounded-0 card-maroon" style="padding:5px;">
            <div class="container-fluid">
                <form method="post" id="print_payment_func">
                    <h3 class="card-title"><b>PREVIEW TABLE</b></h3>
                    <br><hr style="height:1px;border-width:0;color:gray;background-color:gray">
                    <table class="table2 table-bordered table-stripped" style="width:100%;table-layout: fixed;">
                        <thead> 
                            <tr>
                                <th style="text-align:center;font-size:11px;width:5%;">ACTION</th>
                                <th style="text-align:center;font-size:11px;">DUE DATE</th>
                                <th style="text-align:center;font-size:11px;">PAY DATE</th>
                                <th style="text-align:center;font-size:11px;">OR NO</th>
                                <th style="text-align:center;font-size:11px;">AMT PAID</th>
                                <th style="text-align:center;font-size:11px;">AMT DUE</th>
                                <th style="text-align:center;font-size:11px;">SURCHARGE</th>
                                <th style="text-align:center;font-size:11px;">INTEREST</th>
                                <th style="text-align:center;font-size:11px;">PRINCIPAL</th>
                                <th style="text-align:center;font-size:11px;">REBATE</th>
                                <th style="text-align:center;font-size:11px;">PERIOD</th>
                                <th style="text-align:center;font-size:11px;">BALANCE</th>
                            </tr>
                        </thead>
                        <?php $qry4 = $conn->query("SELECT * FROM t_invoice where md5(property_id) = '{$_GET['id']}' ORDER by due_date, pay_date, payment_count ASC");
                                $last_row = $qry4->num_rows - 1;
                                $i = 0;
                                if($qry4->num_rows <= 0){
                                echo "<div class='text-center' style='font-size:15px;position:absolute;margin-top:40px;font-weight:bold;'>  No Payment Record </div>";
                                }else{  ?>      
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
                                    $amt_due = $row['amount_due'];
                                    $interest = $row['interest'];
                                    $principal = $row['principal'];
                                    $surcharge = $row['surcharge'];
                                    $rebate = $row['rebate'];
                                    $period = $row['status'];
                                    $balance = $row['remaining_balance'];
                                    $sur_per = $row['surcharge_percent'];

                                    $total_rebate += $rebate;
             
                                echo "<tr id='{$row['invoice_id']}'>";
                        
                                if ($i == $last_row){
                                    echo "<td style='font-size:12px;width:5%;text-align:center;'><a href='#' class='btn btn-danger btn-sm delete-row' onclick='deleteRow({$row['invoice_id']})'><span class='fa fa-times' ></span></a></td>";
                                
                                }else{
                                echo "<td class='text-center'><span class='badge badge-info'>Added</span>  </td>";
                                
                                }
                                $i++;
                            ?>  
                            <td class="text-center" style="font-size:13px;width:8%;"><?php echo date('m/d/Y', strtotime($due_dte)); ?> </td> 
                            <td class="text-center" style="font-size:13px;width:10%;"><?php echo  date('m/d/Y', strtotime($pay_date)); ?> </td> 
                            <td class="text-center" style="font-size:13px;width:5%;"><?php echo $or_no ?> </td> 
                            <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($amt_paid,2) ?> </td> 
                            <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($amt_due,2) ?> </td> 
                            <td class="text-center" style="font-size:13px;width:8%;"><?php echo number_format($surcharge,2) ?> <span class='badge badge-primary'> Less <?php echo $sur_per ?> % </span> </td> 
                            <td class="text-center" style="font-size:13px;width:8%;"><?php echo number_format($interest,2) ?> </td> 
                            <td class="text-center" style="font-size:13px;width:10%;"><?php echo number_format($principal,2) ?> </td> 
                            <td class="text-center" style="font-size:13px;width:8%;"><?php echo number_format($rebate,2) ?> </td> 
                            <td class="text-center" style="font-size:13px;width:8%;"><?php echo $period ?> </td> 
                            <td class="text-center" style="font-size:13px;width:12%;"><?php echo number_format($balance,2) ?> </td>  
                            </tr>
                        <?php endwhile ; } ?>
                        </thead>
                    </table>
                    <?php 
                        $sql_prin = "SELECT SUM(principal) AS total_principal  FROM t_invoice WHERE md5(property_id) = '{$_GET['id']}' ";
                        $result_prin = mysqli_query($conn, $sql_prin);
                        $row_prin = mysqli_fetch_assoc($result_prin);
                    ?>

                    <?php 
                        $sql_sur = "SELECT SUM(surcharge) AS total_surcharge FROM t_invoice WHERE md5(property_id) = '{$_GET['id']}' ";
                        $result_sur = mysqli_query($conn, $sql_sur);
                        $row_sur = mysqli_fetch_assoc($result_sur);
                    ?>
                    <?php 
                        $sql_int = "SELECT SUM(interest) AS total_interest FROM t_invoice WHERE md5(property_id) = '{$_GET['id']}' ";
                        $result_int = mysqli_query($conn, $sql_int);
                        $row_int = mysqli_fetch_assoc($result_int);
                    ?>
                    <?php 
                        $sql_due = "SELECT SUM(payment_amount) AS total_amt_paid FROM t_invoice WHERE md5(property_id) = '{$_GET['id']}' ";
                        $result_due = mysqli_query($conn, $sql_due);
                        $row_due = mysqli_fetch_assoc($result_due);
                    ?>
                    <?php 
                        $sql_rebate = "SELECT SUM(rebate) AS total_rebate FROM t_invoice WHERE md5(property_id) = '{$_GET['id']}' ";
                        $result_rebate = mysqli_query($conn, $sql_rebate);
                        $row_rebate = mysqli_fetch_assoc($result_rebate);
                    ?>
                    <table style="width:30%;float:right;table-layout: fixed;">
                        <tr>
                            <td style="font-size:12px;"><label class="control-label">Total Principal: </label></td>
                            <td><input type="text" class= "form-control-sm" name="tot_prin" id="tot_prin" value="<?php echo (number_format($row_prin['total_principal'],2)) ? (number_format($row_prin['total_principal'],2)): ''; ?>" style="width:70%;float:right;text-align:right;font-weight:bold;font-size:12px;" readonly></td>
                        </tr>   
                        <tr>
                            <td style="font-size:12px;"><label class="control-label">Total Surcharge: </label></td>
                            <td><input type="text" class= "form-control-sm" name="tot_sur" id="tot_sur" value="<?php echo (number_format($row_sur['total_surcharge'],2)) ? (number_format($row_sur['total_surcharge'],2)) : ''; ?>" style="width:70%;float:right;text-align:right;font-weight:bold;font-size:12px;" readonly></td>
                        </tr>   
                        <tr>
                            <td style="font-size:12px;"><label class="control-label">Total Interest: </label></td>
                            <td><input type="text" class= "form-control-sm" name="tot_int" id="tot_int" value="<?php echo (number_format($row_int['total_interest'],2)) ? (number_format($row_int['total_interest'],2)) : ''; ?>" style="width:70%;float:right;text-align:right;font-weight:bold;font-size:12px;" readonly></td>
                        </tr>   
                        <tr>
                            <td style="font-size:12px;"><label class="control-label">Total Rebate: </label></td>
                            <td><input type="text" class= "form-control-sm" name="tot_rebate" id="tot_rebate" value="<?php echo (number_format($row_rebate['total_rebate'],2)) ? (number_format($row_rebate['total_rebate'],2)): ''; ?>" style="width:70%;float:right;text-align:right;font-weight:bold;font-size:12px;" readonly></td>
                        </tr>  
                        <tr>  

                            <td style="font-size:12px;"><label>Total Amount to be Paid: </label></td>
                            <td><input type="text" class= "form-control-sm" name="tot_amt_pd" id="tot_amt_pd" value="<?php echo (number_format($row_due['total_amt_paid'],2)) ? (number_format($row_due['total_amt_paid'],2)) : ''; ?>" style="width:70%;float:right;text-align:right;font-weight:bold;font-size:12px;" readonly></td>

                            <!-- <td><input type="text" class= "form-control-sm" name="tot_amt_due" id="tot_amt_due" disabled></td> -->
                        </tr>
                        <tr>
                            <!-- <td>
                                <button type="button" class="btn btn-primary btn-s paid_btn" prop-id ="<?php $prop_id ?>" style="width:100%;font-size:15px;">Save&nbsp;&nbsp; <i class='fa fa-save'></i></button>
                               
                            </td>

                            <td>
                                <a href="<?php echo base_url ?>/report/print_payment.php?id=<?php echo md5($prop_id); ?>", target="_blank" class="btn btn-success pull-right" style="width:100%;font-size:15px;">Print&nbsp;&nbsp;  <i class='fa fa-print'></i></a>
                            </td> -->
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        
        <div class="card card-outline rounded-0 card-maroon" style="padding:5px;">
            <div class="container-fluid">
                <form action="" method="POST" id="or_form_logs">
                    <input type="hidden" id="prop_id" name="prop_id" value="<?php echo $prop_id; ?>" style="width:100%;" readonly>
                    <input type="hidden" class="form-control-sm margin-bottom pay-date" id="pay_date_ent1" name="pay_date_ent1" value="<?php echo isset($trans_date_ent) ? date("Y-m-d", strtotime($trans_date_ent)) : date("Y-m-d");?>" style="width:100%;">
                    <?php 
                        $sql_or = "SELECT or_no AS or_no FROM t_invoice WHERE md5(property_id) = '{$_GET['id']}' ORDER BY gen_time DESC limit 1";
                        //$sql_or = "SELECT or_no FROM t_invoice WHERE md5(property_id) = '{$_GET['id']}' ORDER BY or_no DESC limit 1";
                        $result_or = mysqli_query($conn, $sql_or);
                        $row_or = mysqli_fetch_assoc($result_or);
                    ?>
                    <?php 
                        $sql_sur = "SELECT SUM(surcharge) AS total_surcharge FROM t_invoice WHERE md5(property_id) = '{$_GET['id']}' ";
                        $result_sur = mysqli_query($conn, $sql_sur);
                        $row_sur = mysqli_fetch_assoc($result_sur);
                    ?>
                    <input type="hidden" id="or_no" name="or_no" value="<?php echo $row_or['or_no'] ? $row_or['or_no']: ''; ?>" style="width:100%;" required>
                    <input type="hidden" id="amt_pd" name="amt_pd" value="<?php echo ($row_due['total_amt_paid']) ? ($row_due['total_amt_paid']) : ''; ?>" style="width:100%;" required>
                    <input type="hidden" id="amt_due" name="amt_due" value="<?php echo isset($total_amount_due_ent) ? str_replace(',', '', $total_amount_due_ent) : '0.00'; ?>" style="width:100%;" readonly>
                    <input type="hidden" name="amt_surcharge" id="amt_surcharge" value="<?php echo ($row_sur['total_surcharge']) ? ($row_sur['total_surcharge']) : ''; ?>" style="width:100%;" readonly>
                    <input type="hidden" class= "form-control-sm" name="amt_interest" id="amt_interest" value="<?php echo ($row_int['total_interest']) ? ($row_int['total_interest']) : ''; ?>" style="width:100%;" readonly>
                    <input type="hidden" class="form-control-sm margin-bottom amt-prin"  id="amt_principal" name="amt_principal" value="<?php echo ($row_prin['total_principal']) ? ($row_prin['total_principal']) : ''; ?>" style="width:100%;" required>
                    <input type="hidden" class= "form-control-sm" name="amt_rebate" id="amt_rebate" value="<?php echo ($row_rebate['total_rebate']) ? ($row_rebate['total_rebate']): ''; ?>" style="width:100%;" readonly>
                    <input type="hidden" class="form-control-sm margin-bottom balance-amt"  id="balance" name="balance" value="<?php echo str_replace(',', '', $balance_ent); ?>" style="width:100%;" readonly>
                    
                    
                    <table class="table2 table-bordered table-stripped" style="width:100%;table-layout: fixed;">

                    <tr>
                        <td>
                            <label>Mode of Payment:</label>
                        </td>
                        <td>
                            <select required name="mode_of_payment" id="mode_of_payment" class="form-control required" >
                                <option value="-1" <?php echo isset($meta['mode_of_payment']) && $meta['mode_of_payment'] == "cash" ? 'selected': '' ?>>CASH</option>
                                <option value="0" <?php echo isset($meta['mode_of_payment']) && $meta['mode_of_payment'] == "check" ? 'selected': '' ?>>CHECK</option>
                                <option value="1" <?php echo isset($meta['mode_of_payment']) && $meta['mode_of_payment'] == "thru bank" ? 'selected': '' ?>>THRU BANK</option>
                            </select>


                            <!-- <input type="text" class="form-control-sm margin-bottom"  id="mode_of_payment" name="mode_of_payment" value="CASH" style="width:100%;"> -->
                        </td>
                    </tr>

                <table class="table2 table-bordered table-stripped" style="width:100%;table-layout: fixed;" id="myTable">
                    <tr class="default-hide">
                        <td>
                            <label>Check Date: </label>
                        <td>
                            <input type="date" class= "form-control-sm" name="check_date" id="check_date" value="date()" style="width:100%;">
                        </td>
                        
                    </tr>
                    <tr class="default-hide">
                        <td>
                            <label>Bank/Branch: </label>
                        </td>
                        <td>
                            <input type="text" class= "form-control-sm" name="branch" id="branch" style="width:100%;">
                        </td>
                    </tr>
                </table>
                <table class="table2 table-bordered table-stripped" style="width:100%;table-layout: fixed;">
                    <tr>
                        <td>
                            <label>User:</label>
                        </td>
                        <td>
                            <b><input type="text" class="form-control-sm margin-bottom"  id="user" name="user" value="<?php echo $_settings->userdata('username') ?>" style="width:100%;" readonly></b>
                        </td>
                    </tr>
                   
                    </table>
                    <table class="table2 table-bordered table-stripped" style="width:100%;table-layout: fixed;">
                        <tr>
                            <td>

                                <input type="submit" name="submit" value="Save" class="btn btn-primary btn-s paid_btns" style="width:100%;font-size:15px;">
                            </td>
                            <td>
                                <a href="<?php echo base_url ?>/report/print_payment.php?id=<?php echo md5($prop_id); ?>", target="_blank" class="btn btn-success pull-right" style="width:100%;font-size:15px;">Print&nbsp;&nbsp;</a>
                                <a href="<?php echo base_url ?>/admin/?page=logs/or_logs", target="_blank" class="btn btn-dark" style="width:100%;font-size:15px;">OR Logs</a>

                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>

        <div class="card card-outline rounded-0 card-maroon" style="padding:5px;">
            <div class="container-fluid">
                <h3 class="card-title"><b>CLIENT'S OR LOGS</b></h3>
                <br><hr style="height:1px;border-width:0;color:gray;background-color:gray">
                <div class="logs_cont" style="overflow-x: auto;max-height:500px;">
                <table class="table2 table-bordered table-stripped" style="width:100%;table-layout: fixed;overflow-x: auto;overflow-y: auto;">
                    <thead>
                        <tr>
                        <th style="text-align:center;font-size:11px;">#</th>
                        <!-- <th>Property ID</th> -->
                        <th style="text-align:center;font-size:11px;">OR NO</th>
                        <th style="text-align:center;font-size:11px;">PAY DATE</th>
                        <th style="text-align:center;font-size:11px;">AMOUT PAID</th>
                        <!-- <th>Amt Due</th>
                        <th>Surcharge</th>
                        <th>Interest</th>
                        <th>Principal</th>
                        <th>Rebate</th>
                        <th>Remaining Balance</th>
                        <th>Mode of Payment</th>
                        <th>Check Date</th>
                        <th>Branch</th> -->
                        <th style="text-align:center;font-size:11px;">PREPARER</th>
                        <th style="text-align:center;font-size:11px;">DATE PREPARED</th>
				        <th style="text-align:center;font-size:11px;">ACTION</th>
                        </tr>
                    </thead>
                    <?php $qry4 = $conn->query("SELECT * FROM or_logs where md5(property_id) = '{$_GET['id']}' ORDER by gen_time DESC");
                            $last_row = $qry4->num_rows - 1;
                            $i = 1;
                            if($qry4->num_rows <= 0){
                            echo "<div class='text-center' style='font-size:15px;position:absolute;margin-top:40px;font-weight:bold;'>  No Payment Record </div>";
                            }else{  ?>      
                        <tbody>
                            <tr>
                            <?php
                            while($row= $qry4->fetch_assoc()): 
                                ?>
                                <tr>
                                    <td class="text-center" style="font-size:13px;width:2%;"><?php echo $i++ ?></td>
                                    <td class="text-center" style="font-size:13px;width:8%;"><?php echo $row["or_no"] ?></td>
                                    <td class="text-center" style="font-size:13px;width:8%;"><?php echo $row["pay_date"] ?></td>

                                    
                                    <td class="text-center" style="font-size:13px;width:8%;"><?php echo $row["amount_paid"] ?></td>
                                    <!-- <td><?php echo $row["amount_due"] ?></td>
                                    <td><?php echo $row["surcharge"] ?></td>
                                    <td><?php echo $row["interest"] ?></td>
                                    <td><?php echo $row["principal"] ?></td>
                                    <td><?php echo $row["rebate"] ?></td>
                                    <td><?php echo $row["remaining_balance"] ?></td>
                                    <td><?php echo $row["mode_of_payment"] ?></td>
                                    <td><?php echo $row["check_date"] ?></td>
                                    <td><?php echo $row["branch"] ?></td> -->


                                    <td class="text-center" style="font-size:13px;width:8%;"><?php echo $row["user"] ?></td>
                                    <td class="text-center" style="font-size:13px;width:15%;"><?php echo $row["gen_time"] ?></td>
                                    
                                    <td class="text-center" style="font-size:13px;width:8%;">
                                        <a href="<?php echo base_url ?>/report/print_soa.php?id=<?php echo $row["or_id"]; ?>", target="_blank" class="btn btn-primary btn-sm" style="width:100%;">Print OR</a>
                                    </td> 
                                </tr>
                            <?php endwhile ; } ?>
                            </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
$(document).ready(function() {
    $('#myTable tr.default-hide').hide();

  $('#mode_of_payment').on('change', function() {
    var selectedValue = $(this).val();
    $('#myTable tr').each(function() {
      if (selectedValue === '-1') {
        $(this).hide();
      } else if ($(this).index() === 0) {
        $(this).show();
      } else if ($(this).index() === 1) {
        $(this).show();
      }else {
        $(this).hide();
      }
    });
  });
});



// function or_no_onchange(){
//     document.getElementById('or_no_ent1').value = document.getElementById('or_no_ent2').value;
//     document.getElementById('pay_date_ent1').value = document.getElementById('pay_date_ent').value;
//     document.getElementById('tot_amt_pd1').value = document.getElementById('amount_paid').value;
//     document.getElementById('tot_amt_due1').value = document.getElementById('amount_due').value;
//     document.getElementById('surcharge1').value = document.getElementById('tot_sur').value;
//     document.getElementById('tot_int1').value = document.getElementById('tot_int').value;
//     document.getElementById('tot_prin1').value = document.getElementById('tot_prin').value;
// }

window.onload = check_paydate();

                            
   $(document).ready(function() {


        
    $(document).on('change', ".surcharge_percent", function(e) {
            e.preventDefault(); 
            check_paydate();
        });

        $(document).on('keyup', ".trans-date", function(e) {
            e.preventDefault(); 
            document.getElementById("radio0").checked = true;
            check_paydate();
        });

        $(document).on('blur', ".amt-paid", function(e) {
            e.preventDefault(); 
            let amount = $('.amt-paid').val();
            amount = amount.replace(/[^0-9.-]+/g,"");
            if (isNaN(amount)) {
                alert("Please enter a number!");
                $('#amount_paid').val(0);
            }else{
                const formattedAmount = formatCurrency(amount);   
                $('#amount_paid').val(formattedAmount);
            }
        });


});




function formatCurrency(amount) {
    const formatter = new Intl.NumberFormat('en-PH', {
    style: 'decimal',
    currency: 'PHP',
    minimumFractionDigits: 2
  });

  return formatter.format(amount);
}


function check_paydate(){

    const due_date = new Date($('.due-date').val());
    const pay_date = new Date($('.trans-date').val());
    const payment_type2 = $('.payment-type2').val();
    const pay_status = $('.pay-stat').val();
    const pay_stat_acro = pay_status.substring(0, 2);
    const interest_rate =  $('.int-rate').val();
    const underpay =  $('.under-pay').val();
    const excess =  $('.excess').val();
    const last_excess =  $('.last-excess').val();
    const over_due_mode =  $('.over-due-mode').val();
    const monthly_payment =  $('.monthly-pay').val();
    const numStr = $('.amt-due').val();
    monthly_pay  = parseFloat(numStr.replace(/[^0-9.-]+/g,""));
    console.log(numStr);
    console.log(monthly_pay);


    //console.log(pay_stat_acro);
    if (pay_date > due_date) {
        const timeDiff = Math.abs(pay_date.getTime() - due_date.getTime());
        const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
        
        //console.log(monthly_pay);
    
        let l_sur = (monthly_pay * ((0.6/360) * diffDays));
   
        if (diffDays <= 2) {
            l_sur = 0;
        }


        tot_amt_due = monthly_pay + l_sur;
        console.log(tot_amt_due);
        const total_amt_due = tot_amt_due.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
        });
        
        const l_surcharge = l_sur.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
        });
        //console.log(tot_amt_due);
        $('#surcharge').val(l_surcharge);
        $('#rebate_amt').val('0.00');
        $('#tot_amount_due').val(total_amt_due);
        if (last_excess == -1 || last_excess <= 0){
            $('#amount_paid').val(total_amt_due);
        }

    
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

        //console.log(diffDays);
        //console.log(l_rebate);

        const l_reb = l_rebate.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
        });

        $('#surcharge').val(0.00);
        $('#rebate_amt').val(l_reb);

        l_monthly = (monthly_pay - l_rebate);

        const l_monthly_pay = l_monthly.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
        });


        l_monthly_pay2 = monthly_pay.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
        });

        $('#tot_amount_due').val(l_monthly_pay);
        if (last_excess == -1 || last_excess <= 0){
                $('#amount_paid').val(l_monthly_pay);
        }
        //$('#amount_paid').val(l_monthly.toFixed(2));

    }else{

        console.log(monthly_pay);

        l_monthly_pay2 = monthly_pay.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
        });
        
        if ((excess != -1) && (over_due_mode == 0)){
            return;
        }

        $('#tot_amount_due').val(l_monthly_pay2);
        if (last_excess == -1 || last_excess <= 0){
            $('#amount_paid').val(l_monthly_pay2);
        }
        $('#surcharge').val('0.0');
        $('#rebate_amt').val('0.0');
    }
}

function deleteRow(rowId) {
    start_loader();
    $.ajax({
        url:_base_url_+'classes/Master.php?f=delete_invoice',
        method:'POST',
        data:{rowId: rowId},
        dataType:"json",
        error:err=>{
            //console.log(err)
            alert_toast("An error occured",'error');
            end_loader();
            },
        success:function(resp){
            $('#' + rowId).remove();
            
            end_loader();
            location.reload();
            }
        
    });
}  
function CreditPrincipal() {
    $('#status').val('Credit to Principal');
    $('#surcharge').val('0.0');
    $('#rebate_amt').val('0.0');
    $('#tot_amount_due').val('0.0');
    $('#amount_due').val('0.0');
    const last_due_date = new Date($('.last-due').val());
    const last_stat_count = $('.last-stat-count').val();
    $('#status_count').val(last_stat_count);
    $('.due-date').val(last_due_date.toISOString().substr(0, 10));
    const last_excess =  $('.last-excess').val();
    const l_balance =  $('.balance-amt').val();
        if (last_excess == -1 || last_excess <= 0){
                $('#amount_paid').val(l_balance);
        }
}


function DeleteAll() {
    start_loader();
    $.ajax({
        url:_base_url_+'classes/Master.php?f=delete_all_invoice',
        method:'POST',
        data:{prop_id:'<?php echo $prop_id ?>'},
        dataType:"json",
        error:err=>{
            //console.log(err)
            alert_toast("An error occured",'error');
            end_loader();
            },
        success:function(resp){
            if(typeof resp =='object' && resp.status == 'success'){
                location.reload();
        
            }else{
                alert_toast(resp.err,'error');
                end_loader();
                console.log(resp)
            }
            }
        
        })

}



function payments(){
    start_loader();
    $.ajax({
        url:_base_url_+'classes/Master.php?f=save_payment',
        method:'POST',
        data:{prop_id:'<?php echo $prop_id ?>'},
        dataType:"json",
        error:err=>{
            console.log(err)
            alert_toast("An error occured",'error');
            end_loader();
            },
        success:function(resp){
            if(typeof resp =='object' && resp.status == 'success'){
                // location.reload();
                // redirectSoa();
                location.reload();
        
            }else{
                alert_toast(resp.err,'error');
                end_loader();
                //console.log(resp)
            }
        }
    })
}
function compute(excess){
    if (excess == -1){
        excesspay = 0;
    }else{
        excesspay = excess;
    }
    $('#amount_paid').val(excesspay.toFixed(2));  
}

let btn = document.getElementById('overduebtn');
let div = document.getElementById('overduediv');

btn.addEventListener('click',()=>{
   
    if(div.style.display==='none'){
        div.style.display='block';

       
    }else{
        div.style.display='none';
    }
})
function validateForm() {
	    // error handling
	    var errorCounter = 0;

	    $(".required").each(function(i, obj) {

	        if($(this).val() === ''){
	            $(this).parent().addClass("has-error");
	            errorCounter++;
	        } else{ 
	            $(this).parent().removeClass("has-error"); 
	        }

	    });
		
	    return errorCounter;
	}
    

$(document).ready(function(){


    $('.add-payment-bal').click(function(){

     /*  alert($(this).attr('data-id')); */
	  uni_modal("<i class='fa fa-plus'></i> Payment of Balance",'clients/payment_of_bal.php?id='+$(this).attr('data-id'),"mid-large")

	})

    $(document).on('click', ".credit-pri", function(e) {
        e.preventDefault(); 
        CreditPrincipal();
    });

    $('.delete-all').click(function(){
        _conf("Are you sure you want to delete all? ","DeleteAll");

    });

    $('.paid_btns').click(function(){
    _conf("Are you sure you want to proceed with this request? Click 'Continue' to confirm or 'Close' to cancel the request.","payments");
    event.preventDefault();
    });


    $('#or_form_logs').submit(function(e){
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();

            var statusValue = $("#status").val();

            var errorCounter = validateForm();
            if (errorCounter > 0) {
            alert_toast("It appear's you have forgotten to complete something!","warning");	  
            return false;
        }else{
            $(".required").parent().removeClass("has-error")
        }    
        
        $.ajax({
            url:_base_url_+'classes/Master.php?f=save_or_logs',
            method:'POST',
            data: new FormData(_this[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error:err=>{
                console.log(err)
                alert_toast("An error occured",'error');
                end_loader();
                },
            success:function(resp){
                if(typeof resp =='object' && resp.status == 'success'){
                    payments();
            
                }else{
                    alert_toast(resp.err,'error');
                    end_loader();
                    //console.log(resp)
                }
            }
        })

        })


    

    $('#save_payment').submit(function(e){
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();

            var statusValue = $("#status").val();

            var errorCounter = validateForm();
            if (errorCounter > 0) {
            alert_toast("It appear's you have forgotten to complete something!","warning");	  
            return false;
        }else{
            $(".required").parent().removeClass("has-error")
        }    
        start_loader();


        function addPaymentForm() {
            $.ajax({
                url:_base_url_+"classes/Master.php?f=add_payment",
                data: new FormData(_this[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error:err=>{
                    console.log(err)
                    alert_toast("An error occured",'error');
                    end_loader();
                },
                success:function(resp){
                    if(typeof resp =='object' && resp.status == 'success'){
                        data = [resp['data']];
                        $.each(data, function(index, payments) {
                            compute(payments.excess);
                            check_paydate();
                            location.reload();
                    });
            
                    end_loader();
                    }else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            end_loader()
                    }else{
                        alert_toast("An error occured",'error');
                        end_loader();
                        console.log(resp)
                    }
                }
            })
        }


        function CreditPrincipalForm() {
            $.ajax({
                url:_base_url_+"classes/Master.php?f=credit_principal",
                data: new FormData(_this[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error:err=>{
                    console.log(err)
                    alert_toast("An error occured",'error');
                    end_loader();
                },
                success:function(resp){
                    if(typeof resp =='object' && resp.status == 'success'){
                        data = [resp['data']];
                        $.each(data, function(index, payments) {
                            compute(payments.excess);
                            location.reload();
                    });
            
                    end_loader();
                    }else if(resp.status == 'failed' && resp.msg){
                            alert_toast(resp.msg,'error');
                            end_loader()
                    }else{
                        alert_toast("An error occured",'error');
                        end_loader();
                        console.log(resp)
                    }
                }
            })
        }
        if (statusValue === "Credit to Principal") {
            CreditPrincipalForm();
        }else{
            addPaymentForm();
        }
    })




});

</script>
<script>
function redirectSoa() {
    
    // window.location.href = "<?php echo base_url ?>/report/print_soa.php?id=<?php echo md5($prop_id); ?>";
    window.open("<?php echo base_url ?>/report/print_soa.php?id=<?php echo md5($prop_id); ?>", "_blank");
}
$(document).ready(function(){

$('#print_payment_func').submit(function(e){
    e.preventDefault();
    var _this = $(this)
    $('.err-msg').remove();
    start_loader();
    $.ajax({
        url:_base_url_+"classes/Master.php?f=print_payment_func",
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        dataType: 'json',
        error:err=>{
            console.log(err)
            alert_toast("An error occured",'error');
            end_loader();
        },
        success:function(resp){
            if(typeof resp =='object' && resp.status == 'success'){
                var nw = window.open("./report/print_payment.php?id="+resp.id,"_blank","width=700,height=500")
                    setTimeout(()=>{
                        nw.print()
                        setTimeout(()=>{
                            nw.close()
                            end_loader();
                            location.replace('./?page=print_payment/print-payment-view&id='+resp.id_encrypt)
                        },500)
                    },500)
            }else if(resp.status == 'failed' && !!resp.msg){
                var el = $('<div>')
                    el.addClass("alert alert-danger err-msg").text(resp.msg)
                    _this.prepend(el)
                    el.show('slow')
                    end_loader()
            }else{
                alert_toast("An error occured",'error');
                end_loader();
                console.log(resp)
            }
        }
    })
})

});
</script>

<script>



// Get a reference to the surcharge entry element


// Get a reference to the radio buttons
const radioButtons = document.querySelectorAll('input[name="surcharge_percent"]');

// Add an event listener to each radio button
radioButtons.forEach(radioButton => {
  radioButton.addEventListener("change", () => {
    check_paydate();
    const surchargeEntry = document.getElementById("surcharge");
    surcharge_value = surchargeEntry.value;
    console.log(surcharge_value);
    surcharge_amt  = parseFloat(surcharge_value.replace(/[^0-9.-]+/g,""));
    // Get the value of the selected radio button
    const selectedValue = parseInt(document.querySelector('input[name="surcharge_percent"]:checked').value);
    
    $('#sur_percent').val(selectedValue);
    
    // Calculate the surcharge amount based on the selected percentage
    const surchargeAmount = surcharge_amt - (surcharge_amt * (selectedValue / 100));
    
    // Update the surcharge entry value
    const numStr = $('.amt-due').val();
    const excess =  $('.excess').val();
    const last_excess =  $('.last-excess').val();
    const monthly_pay  = parseFloat(numStr.replace(/[^0-9.-]+/g,""));

    l_tot_amt_due = monthly_pay + surchargeAmount;


    l_surcharge = surchargeAmount.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
        });

    l_tot_amt_due = l_tot_amt_due.toLocaleString(undefined, {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
        });
    surchargeEntry.value = l_surcharge;

    $('#tot_amount_due').val(l_tot_amt_due);
        if (last_excess == -1 || last_excess <= 0){
                $('#amount_paid').val(l_tot_amt_due);
        }
    
  });
});



</script>