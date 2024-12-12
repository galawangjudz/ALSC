
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
  width: 100%; 
  top:0;
  overflow-x: auto;
  padding:1%;
}
.right-div {
  width: 70%;
  top:0;
  /* overflow-x: auto; */
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
.nav-payment{
    background-color:#007bff;
    color:white!important;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
}
.nav-payment:hover{
    background-color:#007bff!important;
    color:white!important;
    box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
}
</style>

<?php 
##ODBC_CONNECTION

$dsn = "PostgreSQL30"; 
$user = "postgres";    
$pass = "admin12345";    

$conn = odbc_connect($dsn, $user, $pass);

if (!$conn) {
    die("Connection failed: " . odbc_errormsg());
}

$l_acct_no = isset($_GET["acct_no"]) ? $_GET["acct_no"] : '' ;

if($l_acct_no != ''){
  
    $l_find = $l_acct_no;

	$l_sql = "SELECT * FROM t_buyers_account where c_account_no = '%s' order by c_account_no ";
    $query = sprintf($l_sql, $l_find);
	$l_qry = odbc_exec($conn, $query);
	$row = odbc_fetch_array($l_qry);
    if ($row === false) {
        echo "Error: No account found with the provided account number.";
    } else {
		while (odbc_fetch_row($l_qry)):
			 ///LOT
             $l_acct_no = $row['c_account_no'];
             $type = $row['c_type'];
             $lot_area = $row['c_lot_area'];
             $price_sqm = $row['c_price_sqm'];
             $lot_disc = $row['c_lot_discount'];
             $lot_disc_amt = $row['c_lot_discount_amt'];
             $lres = $lot_area * $price_sqm;
             $lcp = $lres-($lres*($lot_disc*0.01));
     
             //HOUSE
             $house_model = $row['c_house_model'];
             $floor_area = $row['c_floor_area'];
             $house_price_sqm = $row['c_house_price_sqm'];
             $house_disc = $row['c_house_discount'];
             $house_disc_amt = $row['c_house_discount_amt'];
             $hres = $floor_area * $house_price_sqm;
             $hcp = $hres-($hres*($house_disc*0.01));
             
             //PAYMENT
             $tcp = $row['c_tcp'];
             $tcp_discount = $row['c_tcp_discount'];
             $tcp_discount_amt = $row['c_tcp_discount_amt'];
             
             $vat_amt = $row['c_vat_amount'];
             $vat =$vat_amt/$tcp * 100;
             $net_tcp = $row['c_net_tcp'];
     
             $reservation = $row['c_reservation'];
             $p1 = $row['c_payment_type1'];
             $p2 = $row['c_payment_type2'];
     
             $amt_fnanced = $row['c_amt_financed'];
             $monthly_down = $row['c_monthly_down'];
             $first_dp = $row['c_first_dp'];
             $full_down = $row['c_full_down'];
             $terms = $row['c_terms'];
             $interest_rate = $row['c_interest_rate'];
             $fixed_factor = $row['c_fixed_factor'];
             $monthly_payment = $row['c_monthly_payment'];
             $no_payments = $row['c_no_payments'];
             $net_dp = $row['c_net_dp'];
             $down_percent = $row['c_down_percent'];
             $start_date = $row['c_start_date'];
		endwhile;
	}

}
?>
<div class="main_container">
    <div class="left-div"> 
        <div class="card card-outline rounded-0 card-maroon" style="padding:5px;">
            <div class="container-fluid">
                <h3 class="card-title"><b>PAYMENT WINDOWS</b></h3>     
                <br><hr style="height:1px;border-width:0;color:gray;background-color:gray">
                <form action="" id="filter">
                    <?php $l_acct_no  = '' ?>
                    <div class="row align-items-end">
                        <input type="hidden" id="page" name="page" value="payment_window" class="form-control form-control-sm rounded-0">
                        <div class="col-md-3 form-group">
                            <input type="text" id="acct_no" name="acct_no" value="<?= $l_acct_no ?>" class="form-control" placeholder="Enter Account No" maxlength="11">
                        </div>
                        <div class="col-md-3 form-group">
                            <button class="btn btn-primary"><i class="fa fa-search"></i> Find Account</button>
                        </div>
                    </div>
                </form>

                <form action="" method="POST" id="save_payment">

                    <table class="table2 table-bordered table-stripped" style="width:100%;table-layout: fixed;"> 
                       

                        <tr>
                            <td style="width:25%;font-size:13px;"><label for="account_no">Account No:</label></td>
                            <td style="width:25%;font-size:13px;"><label for="acc_status">Account Status:</label></td>
                        </tr>
                        <tr>
                        <td style="width:25%;font-size:13px;">
                            <input type="text" class="form-control-sm margin-bottom" id="account_no" name="account_no" value="<?= isset($row['c_account_no']) ? $row['c_account_no'] : '' ?>" style="width:100%; display:inline-block;" readonly>
                         
                        </td>
                            
                            <td style="width:25%;font-size:13px;" readonly><input type="text" class="form-control-sm margin-bottom" id="acc_status" name="acc_status" value="<?= isset($row['c_account_status']) ? $row['c_account_status'] : '' ?>" style="width:100%;" readonly></td>
                        </tr>
                     

                        <tr>
                        
                            <td style="width:25%;font-size:13px;"><label for="buyers_name">Buyer's Name:</label></td>
                            <td style="width:25%;"><label for="date_of_sale">Date of Sale:</label></td>
                        </tr>
                     
                        <tr>
                            <td style="width:25%;font-size:13px;" readonly><input type="text" class="form-control-sm margin-bottom" id="buyers_name" name="buyers_name" value="<?= isset($row['c_b1_first_name']) ? $row['c_b1_first_name'] : '' ?>" style="width:100%;" readonly> </td>    
                            <td style="width:25%;font-size:13px;" readonly><input type="text" class="form-control-sm margin-bottom" id="date_of_sale" name="date_of_sale" value="<?= isset($row['c_date_of_sale']) ? $row['c_date_of_sale'] : '' ?>" style="width:100%;" readonly></td>
                       
                        </tr>
                     
                        <tr>
                            <td colspan="2" style="width:25%;font-size:13px;"><label for="address">Address:</label></td> 
                        </tr>
                        <tr>
                            <td colspan="2" style="width:100%;font-size:13px;"><input type="text" class="form-control-sm margin-bottom due-date" id="address" name="address" value="<?= isset($row['c_address']) ? $row['c_address'] : '' ?>" style="width:100%;" readonly></td>
                        </tr>
                        <tr>
                        <td style="width:25%;font-size:13px;"><label for="contact_no">Contact No: </label></td>
                            <td style="width:25%;font-size:13px;"><label for="net_tcp">Net TCP:</label></td> 
                           
                        </tr>
                        <tr>
                            <td style="width:25%;font-size:13px;"><input type="text" class="form-control-sm margin-bottom trans-date" id="contact_no" name="contact_no" value="<?= isset($row['c_mobile_no']) ? $row['c_mobile_no'] : '-----' ?>" style="width:100%;"></td>
                            <td style="width:25%;font-size:13px;"> <input type="text" class="form-control-sm margin-bottom or-date" id="net_tcp" name="net_tcp" value="<?= isset($row['c_net_tcp']) ? number_format($row['c_net_tcp'],2) : '-----' ?>" style="width:100%;"></td>
                       
                        </tr>
                       
                        
                        <tr>
                            <td style="width:25%;font-size:13px;"><label for="email_ent">Email:</label></td>
                            <td style="width:25%;font-size:13px;"><label for="vat_amt">Vat Amount:</label></td>
                        </tr>
                        <tr>
                            <td style="width:25%;font-size:13px;"><input type="text" class="form-control-sm margin-bottom pay-stat"  id="email_ent" name="email_ent" value="<?= isset($row['c_email']) ? $row['c_email'] : '-----' ?>" style="width:100%;" readonly></td>
                            <td style="width:25%;font-size:13px;"><input type="text" class="form-control-sm margin-bottom rebate-amt" id="vat_amt" name="vat_amt" value="<?= isset($row['c_vat_amount']) ? $row['c_vat_amount'] : '-----' ?>" style="width:100%;" readonly></td>
                        </tr>
                        <tr>
                        </tr>
                        <tr>

                        </tr>
                
                        <tr>
                            <td style="width:25%;font-size:13px;"><label for="balance">Balance:</label></td>
                            <td style="width:25%;font-size:13px;padding-left:10px;"><label for="payment_type1">Payment Type 1:</label></td>
                            
                        </tr>
                        <tr>
                            <td style="width:25%;font-size:13px;"><input type="text" class="form-control-sm margin-bottom balance"  id="balance" name="balance" value="<?= isset($row['c_balance']) ? number_format($row['c_balance'],2) : '' ?>" style="width:100%;" readonly></td>
                            <td style="width:25%;font-size:13px;"><input type="text" class="form-control-sm margin-bottom payment_type1"  id="payment_type1" name="payment_type1" value="<?= isset($row['c_payment_type1']) ? $row['c_payment_type1'] : '' ?>" style="width:100%;" readonly></td>
                        </tr>
                        <tr>
                            <td style="width:25%;font-size:13px;"><label for="account_option">Account Option:</label></td>
                            <td style="width:25%;font-size:13px;padding-left:10px;"><label for="payment_type2">Payment Type 2:</label></td>
                        </tr>
                        <tr>
                            <td style="width:25%;font-size:13px;"><input type="text" class="form-control-sm margin-bottom amt-paid"  id="account_option" name="account_option" value="<?= isset($row['c_account_type1']) ? $row['c_account_type1'] : '' ?>" style="width:100%;" required></td>
                            <td style="width:25%;font-size:13px;"><input type="text" class="form-control-sm margin-bottom or-no"  id="payment_type2" name="payment_type2" value="<?= isset($row['c_payment_type2']) ? $row['c_payment_type2'] : '' ?>" style="width:100%;" required ></td>
                        </tr>
                    </table>
                    <input type="hidden" class="form-control-sm margin-bottom due-date2" name="due_date2" value="<?php echo date("Y-m-d", strtotime($due_date)); ?>" style="width:100%;" readonly>
                           
                    <input type="hidden" class="form-control-sm margin-bottom int-rate"  id="interest_rate" name="interest_rate" value="<?php echo $interest_rate; ?>"> 
                    <input type="hidden" class="form-control-sm margin-bottom under-pay"  id="under_pay" name="under_pay" value="<?php echo $underpay; ?>"> 
                    <input type="hidden" class="form-control-sm margin-bottom excess"  id="excess" name="excess" value="<?php echo $excess; ?>"> 
                    <input type="hidden" class="form-control-sm margin-bottom last-excess"  id="last_excess" name="last_excess" value="<?php echo $last_excess; ?>"> 
                    <input type="hidden" class="form-control-sm margin-bottom retention"  id="retention" name="retention" value="<?php echo $retention; ?>"> 
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
                   
                </form>

                <form method="post" id="print_payment_func">
                    <h3 class="card-title"><b>DUES TABLE</b></h3>
                    <?php 
                        include 'over_due_details.php'; 
                    ?>
                    <?php
                        $pay_date = date('Y-m-d');
                        if (empty($row)) {
                            $id = null;
                            $all_payments = [null, null, null, null, null];  
                            $over_due = [];  
                        } else {
                            $id = $row['c_account_no'];
                            $all_payments = load_data($conn2, $id, $pay_date) ?? [null, null, null, null, null];
                            $over_due = $all_payments[0] ?? []; 
                        }
                        $total_amt_due = $all_payments[1] ?? null;
                        $total_interest = $all_payments[2] ?? null;
                        $total_principal = $all_payments[3] ?? null;
                        $total_surcharge = $all_payments[4] ?? null;
                    ?>
                        <div class="table-responsive">   
                        <table class="table2 table-bordered table-striped" id="overdue_table" style="width:100%;">
                            <thead> 
                                <tr>
                                    <th style="text-align:center;font-size:13px;">DUE DATE</th>
                                    <th style="text-align:center;font-size:13px;">PAID DATE</th>
                                    <th style="text-align:center;font-size:13px;">OR NO</th>
                                    <th style="text-align:center;font-size:13px;">AMT PAID</th> 
                                    <th style="text-align:center;font-size:13px;">AMT DUE</th>
                                    <th style="text-align:center;font-size:13px;">PENALTY</th>
                                    <th style="text-align:center;font-size:13px;">INTEREST</th>
                                    <th style="text-align:center;font-size:13px;">PRINCIPAL</th>
                                    <th style="text-align:center;font-size:13px;">REBATE</th>
                                    <th style="text-align:center;font-size:13px;">PERIOD</th>
                                    <th style="text-align:center;font-size:13px;">BALANCE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($over_due)): ?>
                                    <?php foreach ($over_due as $l_data): ?>
                                        <tr>
                                            <td class="text-center" style="font-size:13px;width:8.5%;"><?php echo htmlspecialchars($l_data[0]) ?></td> 
                                            <td class="text-center" style="font-size:13px;width:8%;"><?php echo htmlspecialchars($l_data[1]) ?></td> 
                                            <td class="text-center" style="font-size:13px;width:8%;"><?php echo htmlspecialchars($l_data[2]) ?></td> 
                                            <td class="text-center editable" style="font-size:13px;width:12%;"><?php echo htmlspecialchars($l_data[3]) ?></td> <!-- AMT PAID (Editable) -->
                                            <td class="text-center " style="font-size:13px;width:12%;"><?php echo htmlspecialchars($l_data[4]) ?></td> <!-- AMT DUE (Non-editable) -->
                                            <td class="text-center editable" style="font-size:13px;width:10%;"><?php echo htmlspecialchars($l_data[7]) ?></td> <!-- PENALTY (Editable) -->
                                            <td class="text-center " style="font-size:13px;width:10%;"><?php echo htmlspecialchars($l_data[5]) ?></td> <!-- INTEREST (Non-editable) -->
                                            <td class="text-center" style="font-size:13px;width:12%;"><?php echo htmlspecialchars($l_data[6]) ?></td> <!-- PRINCIPAL (Non-editable) -->
                                            <td class="text-center" style="font-size:13px;width:12%;"><?php echo htmlspecialchars(str_replace(",", "", $l_data[8])) ?></td>  <!-- REBATE (Non-editable) -->
                                            <td class="text-center" style="font-size:13px;width:12%;"><?php echo htmlspecialchars($l_data[9]) ?></td>  <!-- PERIOD (Non-editable) -->
                                            <td class="text-center" style="font-size:13px;width:15%;"><?php echo htmlspecialchars($l_data[10]) ?></td>  <!-- BALANCE (Non-editable) -->
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="11" class="text-center" style="font-size:13px;">No overdue data available.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                    </table>
                    <script>
                        document.querySelectorAll("#overdue_table td.editable").forEach(function(cell) {
                            cell.addEventListener("click", function() {
                                this.setAttribute("contenteditable", "true");
                            });
                            cell.addEventListener("keydown", function(e) {
                                if (e.key === "Enter") {
                                    e.preventDefault();
                                    this.setAttribute("contenteditable", "false");
                                }
                            });

                            cell.addEventListener("blur", function() {
                                this.setAttribute("contenteditable", "false");
                            });
                        });
                    </script>
                    <table class="table2 table-bordered table-stripped" id="data-table">
                          <tr>
                          <?php $qry_prin = "SELECT SUM(principal) AS p_principal FROM property_payments where md5(property_id) = '{$_GET['id']}' ";

                            $result = mysqli_query($conn, $qry_prin);
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $total_prin = $row["p_principal"];
                            } else {
                                echo "No results found.";
                            }
                            ?>
                            <?php $qry_surcharge = "SELECT SUM(surcharge) AS p_surcharge FROM property_payments where md5(property_id) = '{$_GET['id']}' ";

                            $result = mysqli_query($conn, $qry_surcharge);
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $total_surcharge = $row["p_surcharge"];
                            } else {
                                echo "No results found.";
                            }
                            ?>
                            <?php $qry_interest = "SELECT SUM(interest) AS p_interest FROM property_payments where md5(property_id) = '{$_GET['id']}' ";

                            $result = mysqli_query($conn, $qry_interest);
                            if (mysqli_num_rows($result) > 0) {
                                $row = mysqli_fetch_assoc($result);
                                $total_interest = $row["p_interest"];
                            } else {
                                echo "No results found.";
                            }
                            ?>
                            <?php $qry_amt_due = "SELECT SUM(amount_due) AS p_amt_due FROM property_payments where md5(property_id) = '{$_GET['id']}' ";

                              $result = mysqli_query($conn, $qry_amt_due);
                              if (mysqli_num_rows($result) > 0) {
                                  $row = mysqli_fetch_assoc($result);
                                  $total_amt_due = $row["p_amt_due"];
                                  $main_total = $total_amt_due + $total_interest + $total_surcharge + $total_prin;
                              } else {
                                  echo "No results found.";
                              }
                              ?>
                              
                              
                              <td style="font-size:12px; width: 50%;"><label for="tot_prin" class="control-label" style="width: 100%;">Total Principal: </label></td>
                              <td style="width: 50%;"><input type="text" class="form-control-sm" name="tot_prin" id="tot_prin" value="<?php echo number_format($total_prin,2) ?>" style="width: 100%;"></td>
                              <td style="font-size:12px; width: 50%;"><label for="tot_reb" class="control-label" style="width: 100%;">Total Rebate: </label></td>
                              <td style="width: 50%;"><input type="text" class= "form-control-sm" name="tot_reb" id="tot_reb" value="<?php echo number_format($total_rebate,2) ?>" style="width: 100%;"></td>
                              <td style="font-size:12px; width: 50%;"><label for="tot_sur" class="control-label" style="width: 100%;">Total Surcharge: </label></td>
                              <td style="width: 50%;"><input type="text" class= "form-control-sm" name="tot_sur" id="tot_sur" value="<?php echo number_format($total_surcharge,2) ?>" style="width: 100%;"></td>
                              <td style="font-size:12px; width: 50%;"><label for="tot_int" class="control-label" style="width: 100%;">Total Interest: </label></td>
                              <td style="width: 50%;"><input type="text" class= "form-control-sm" name="tot_int" id="tot_int" value="<?php echo number_format($total_interest,2) ?>" style="width: 100%;"></td>
                              <td style="font-size:12px; width: 50%;"><label for="tot_amt_due" class="control-label" style="width: 100%;">Total Amount Due: </label></td>
                              <td style="width: 50%;"><input type="text" class= "form-control-sm" name="tot_amt_due" id="tot_amt_due" value="<?php echo number_format($main_total,2) ?>" style="width: 100%;"></td>
                          </tr>
                      </table>
                    <table style="width:30%;float:right;table-layout: fixed;">
                        <tr>
                            <td style="font-size:12px;"><label for="tot_prin" class="control-label">Total Principal: </label></td>
                            <td><input type="text" class="form-control-sm" name="tot_prin" id="tot_prin" value="" style="width:70%;float:right;text-align:right;font-weight:bold;font-size:12px;" readonly></td>
                        </tr>   
                        <tr>
                            <td style="font-size:12px;"><label for="tot_sur" class="control-label">Total Surcharge: </label></td>
                            <td><input type="text" class= "form-control-sm" name="tot_sur" id="tot_sur" value="" style="width:70%;float:right;text-align:right;font-weight:bold;font-size:12px;" readonly></td>
                        </tr>   
                        <tr>
                            <td style="font-size:12px;"><label for="tot_int" class="control-label">Total Interest: </label></td>
                            <td><input type="text" class= "form-control-sm" name="tot_int" id="tot_int" value="" style="width:70%;float:right;text-align:right;font-weight:bold;font-size:12px;" readonly></td>
                        </tr>   
                        <tr>
                            <td style="font-size:12px;"><label for="tot_rebate" class="control-label">Total Rebate: </label></td>
                            <td><input type="text" class= "form-control-sm" name="tot_rebate" id="tot_rebate" value="" style="width:70%;float:right;text-align:right;font-weight:bold;font-size:12px;" readonly></td>
                        </tr>  
                        <tr>  

                            <td style="font-size:12px;"><label for="tot_amt_pd">Total Amount to be Paid: </label></td>
                            <td><input type="text" class= "form-control-sm" name="tot_amt_pd" id="tot_amt_pd" value="" style="width:70%;float:right;text-align:right;font-weight:bold;font-size:12px;" readonly></td>

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
                            <label>Particulars:</label>
                        </td>
                        <td>
                            <textarea class="b_particulars" name="b_particulars" placeholder = "Description" style="height:80px;width:100%;border:none;resize:none;"></textarea>
                        </td>
                    </tr>
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
                            <label for="check_date">Check Date: </label>
                        <td>
                            <input type="date" class= "form-control-sm" name="check_date" id="check_date" value="" style="width:100%;">
                        </td>
                    </tr>
                    <tr class="default-hide">
                        <td>
                            <label for="check_number">Check Number: </label>
                        <td>
                            <input type="number" class= "form-control-sm" name="check_number" id="check_number" style="width:100%;">
                        </td>
                        
                    </tr>
                    <tr class="default-hide">
                        <td>
                            <label for="branch">Bank/Branch: </label>
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
                            <b><input type="text" class="form-control-sm margin-bottom"  id="user" name="user" value="<?php echo $_settings->userdata('username') ?>" style="width:100%;"></b>
                        </td>
                    </tr>
                    </table>
                    <table class="table2 table-bordered table-stripped" style="width:100%;table-layout: fixed;">
                        <tr>
                            <td>
                            <button type="submit" name="submit" class="btn btn-flat btn-primary" style="width: 100%; font-size: 14px;">
                            <i class="fas fa-save"></i>&nbsp;&nbsp;Save
                            </button>
                            </td>
                            <td>
                                <a href="<?php echo base_url ?>/report/print_payment.php?id=<?php echo md5($prop_id); ?>", target="_blank" class="btn btn-flat btn-success pull-right" style="width:100%;font-size:14px;"><i class="fas fa-print"></i>&nbsp;&nbsp;Print</a>
                            </td>
                        </tr>
                        
                    </table>
                    <table class="table2 table-bordered table-stripped" style="width:100%;table-layout: fixed;">
                            <tr>
                                <td><a href="<?php echo base_url ?>admin/?page=reports/or_logs", class="btn btn-flat btn-dark" style="width:100%;font-size:14px;"><i class="nav-icon fas fa-book"></i>&nbsp;&nbsp;OR Logs</a></td>
                            </tr>
                        </table>
                </form>
            </div>
        </div>

       

        </div>
    </div>
</div>


<script>
function findAccount() {
    let accountNo = document.getElementById('account_no').value;
    if (accountNo === "") {
        alert("Please enter an account number.");
        return;
    }

    let l_col = "c_account_no, c_account_type, c_account_type1, c_date_of_sale, c_account_status, c_b1_last_name, \
    c_b1_first_name, c_b1_middle_name, c_b2_last_name, c_b2_first_name, c_b2_middle_name, c_address, c_city_prov, \
    c_zip_code, c_tel_no, c_type, c_lot_area, c_price_sqm, c_lot_discount, c_house_model, c_floor_area, \
    c_house_price_sqm, c_unit_status, c_net_tcp, c_reservation, c_or_no, c_payment_type1, c_payment_type2, \
    c_down_percent, c_net_dp, c_no_payments, c_monthly_down, c_first_dp, c_full_down, c_loanable_amt, c_loan_or_no, \
    c_loan_date, c_amt_financed, c_terms, c_interest_rate, c_fixed_factor, c_monthly_payment, c_start_date, c_remarks, \
    c_retention, c_change_date, c_account_mode, c_balance, c_waived_surcharge, c_network, c_division, \
    c_lick_account, c_buyer_type, c_reopen, c_mobile_no, c_address_abroad, c_tel_abroad, c_mobile_abroad, \
    c_email, c_civil_status, c_birthday, c_sex, c_employment_status, c_other_employ, c_address_use, \
    COALESCE(c_vatable, 0) AS c_vatable, COALESCE(c_vat_amount, 0) AS c_vat_amount, COALESCE(c_lot_discount_amount, 0) AS c_lot_discount_amount, \
    COALESCE(c_h_discount, 0) AS c_h_discount, COALESCE(c_h_discount_amount, 0) AS c_h_discount_amount, \
    COALESCE(c_tcp_discount, 0) AS c_tcp_discount, COALESCE(c_tcp_discount_amount, 0) AS c_tcp_discount_amount, \
    COALESCE(c_tcp, 0) AS c_tcp, c_pdc, c_consent";

    let l_find = accountNo;
    if (l_find.charAt(0) === '/') {
        l_find = l_find.replace('/', '');
        let l_fx = l_find.indexOf(' ');
        let l_blockx = 0;
        let l_lotx = 0;
        let l_sitex;

        if (l_fx === -1) {
            l_sitex = getSiteCode(l_find.toUpperCase());
        } else {
            l_sitex = getSiteCode(l_find.slice(0, l_fx).toUpperCase());
        }

        if (l_sitex === 0) {
            alert("Buyer's Account not Found!!");
            document.getElementById('account_no').focus();
            return;
        }

        l_find = l_find.slice(l_fx + 1);
        l_fx = l_find.indexOf(' ');
        if (l_fx === -1) {
            l_blockx = parseInt(l_find);
        } else {
            l_blockx = parseInt(l_find.slice(0, l_fx));
            l_find = l_find.slice(l_fx + 1);
            l_lotx = parseInt(l_find);
        }

        if (l_blockx === 0) {
            l_find = l_sitex.toString().padStart(3, '0');
        } else if (l_lotx === 0) {
            l_find = l_sitex.toString().padStart(3, '0') + l_blockx.toString().padStart(3, '0');
        } else {
            l_find = l_sitex.toString().padStart(3, '0') + l_blockx.toString().padStart(3, '0') + l_lotx.toString().padStart(2, '0');
        }

        document.getElementById('account_no').value = l_find;
    }

    l_find = l_find.replace(/-/g, '');

    if (!isNaN(l_find)) {
        // Perform AJAX or Fetch to call the backend to search by account number
        fetch(`/search?account_no=${l_find}`)
            .then(response => response.json())
            .then(result => {
                if (result.length === 0) {
                    alert("Buyer's Account not Found!!");
                    document.getElementById('acc_status').value = '';
                } else {
                    loadFields(result);
                }
            })
            .catch(error => console.error('Error:', error));
    } else {
        // Perform AJAX or Fetch to call the backend to search by last name
        fetch(`/search?last_name=${l_find}`)
            .then(response => response.json())
            .then(result => {
                if (result.length === 0) {
                    alert("Buyer's Account not Found!!");
                    document.getElementById('acc_status').value = '';
                } else {
                    loadFields(result);
                }
            })
            .catch(error => console.error('Error:', error));
    }
}

function getSiteCode($acronym, $conn) {
    $g_site = []; // To simulate global variable in Python for caching

    // If the cache is empty, query the database
    if (empty($g_site)) {
        $l_sql = "SELECT c_acronym, c_code FROM t_projects ORDER BY c_acronym ASC";
        $result = odbc_exec($conn, $l_sql);

        if ($result) {
            while ($row = odbc_fetch_array($result)) {
                // Remove '-' and convert to uppercase (equivalent of `str_replace` and `strtoupper`)
                $acronym_strip = strtoupper(str_replace('-', '', $row['c_acronym']));
                $g_site[$acronym_strip] = $row['c_code'];
            }
        } else {
            // Handle query error
            "Error executing query: " . odbc_errormsg($conn);
        }
    }

    // Remove '-' from acronym and convert to uppercase for comparison
    $acronym_strip = strtoupper(str_replace('-', '', $acronym));

    // Check if the acronym exists in the cached list
    if (array_key_exists($acronym_strip, $g_site)) {
        return $g_site[$acronym_strip];
    } else {
        return 0; // Return 0 if not found
    }
}


function loadFields(result) {
    // Example of setting the account status field
    document.getElementById('acc_status').value = result[0].c_account_status;
}
</script>
<script>
$('#makeMeSummernote').summernote({
    height:200,
    toolbar: [
        [ 'style', [ 'style' ] ],
        [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
        [ 'fontname', [ 'fontname' ] ],
        [ 'fontsize', [ 'fontsize' ] ],
        [ 'color', [ 'color' ] ],
        [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
        [ 'table', [ 'table' ] ],
        [ 'insert', [ 'link'] ],
        [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
    ]
});
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


window.onload = check_paydate();                  
    $(document).ready(function() {
    $(document).on('change', ".surcharge_percent", function(e) {
            e.preventDefault(); 
            check_paydate();
        });
        $(document).on('keyup', ".trans-date", function(e) {
            e.preventDefault(); 
            document.getElementById("radio0").checked = true;
            let status = $('#status').val();
            //console.log(status);
            if ((status == 'Credit to Principal') || (status == 'Payment of Balance')){
                return;
            }
            
            check_paydate();
                
        });

        $(document).on('blur', ".amt-paid", function(e) {
            e.preventDefault(); 
            
            let amount = $('.amt-paid').val();
            let tot_amt_due =  $('.tot-amt-due').val();
            let rebate =  $('#rebate_amt').val();
            tot_amt = parseFloat(tot_amt_due.replace(/[^0-9.-]+/g,""))
            reb = parseFloat(rebate.replace(/[^0-9.-]+/g,""))
            if (amount < tot_amt){
                $('#rebate_amt').val('0.00');
                adjust = tot_amt + reb;
                const final_adj = formatCurrency(adjust);   
                $('#tot_amount_due').val(final_adj);
                
            }else{
                check_paydate();
            }
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

    const due_date = new Date($('.due-date2').val());
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
    //console.log(numStr);
    //console.log(monthly_pay);


  
    if (pay_date > due_date) {
        const timeDiff = Math.abs(pay_date.getTime() - due_date.getTime());
        const diffDays = Math.ceil(timeDiff / (1000 * 3600 * 24)); 
        
        console.log(diffDays);
    
        let l_sur = (monthly_pay * ((0.6/360) * diffDays));
        //console.log(l_sur);

        if (diffDays <= 2) {
            l_sur = 0;
        }


        tot_amt_due = monthly_pay + l_sur;
        //console.log(tot_amt_due);
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

        //console.log(interest_rate);
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

        //console.log(monthly_pay);

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

    document.getElementById("radio0").checked = true;
    radio0.disabled = true;
    radio25.disabled = true;
    radio50.disabled = true;
    radio75.disabled = true;
    radio100.disabled = true;

        if (last_excess == -1 || last_excess <= 0){
                $('#amount_paid').val(l_balance);
        }
}


function PaymentofBalance() {
    let l_balance =  parseFloat($('.balance-amt').val().replace(/[^0-9.-]+/g,""));
    
    let rebate = (l_balance * 0.025).toFixed(2);
    let amt_due = (l_balance - rebate);
    let tot_amt_due = formatCurrency(amt_due.toFixed(2));
    let l_rebate = formatCurrency(rebate);

    document.getElementById("radio0").checked = true;
    radio0.disabled = true;
    radio25.disabled = true;
    radio50.disabled = true;
    radio75.disabled = true;
    radio100.disabled = true;

    amount_paid.readOnly = true;

    $('#status').val('Payment of Balance');
    $('#surcharge').val('0.0');
    $('#rebate_amt').val(l_rebate);
    $('#tot_amount_due').val(tot_amt_due);
    $('#amount_due').val(tot_amt_due);
    $('#amount_paid').val(tot_amt_due);
    const last_due_date = new Date($('.last-due').val());
    const last_stat_count = $('.last-stat-count').val();
    $('#status_count').val(last_stat_count);
    $('.due-date').val(last_due_date.toISOString().substr(0, 10));
    const last_excess =  $('.last-excess').val();
    //const l_balance =  $('.balance-amt').val();
        if (last_excess == -1 || last_excess <= 0){
                $('#amount_paid').val(tot_amt_due);
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
            alert_toast("An error 2",'error');
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



    $(document).on('click', ".credit-pri", function(e) {
        e.preventDefault(); 
        CreditPrincipal();
    });

    $(document).on('click', ".add-payment-bal", function(e) {
        e.preventDefault(); 
        PaymentofBalance();
    });

    $('.delete-all').click(function(){
        _conf("Are you sure you want to delete all? ","DeleteAll");

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
        
        var result = confirm('Are you sure you want to save the payment?');
  
        if (result == true) {

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
                }
            }
        })
    }else{

        return false;
    }

    })

    $('#save_payment').submit(function(e){
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();

            var statusValue = $("#status").val();
            var sur_amt = parseFloat($("#surcharge").val().replace(/[^0-9.-]+/g,""));
            var amt_paid = parseFloat($("#amount_paid").val().replace(/[^0-9.-]+/g,""));
            //console.log(sur_amt);
            //console.log(amt_paid);
            if (isNaN(sur_amt) || isNaN(amt_paid)) {
                alert_toast("Please enter valid numeric values for surcharge and amount paid", "warning");
                return false;
            }

            if (amt_paid < sur_amt) {
                alert_toast("Amount must be higher or equal to surcharge", "warning");
                return false;
            }
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
                            window.scrollTo(0, 0);

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


        if (statusValue === "Credit to Principal" || statusValue === 'Payment of Balance' || statusValue === 'RETENTION') {
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


function paid_btns() {
    var confirmed = confirm("Are you sure you want to continue?");
    if (confirmed) {

      return true;
    } else {

      return false;
    }
  }


const radioButtons = document.querySelectorAll('input[name="surcharge_percent"]');

radioButtons.forEach(radioButton => {
  radioButton.addEventListener("change", () => {
    check_paydate();
    const surchargeEntry = document.getElementById("surcharge");
    surcharge_value = surchargeEntry.value;
    surcharge_amt  = parseFloat(surcharge_value.replace(/[^0-9.-]+/g,""));
    const selectedValue = parseInt(document.querySelector('input[name="surcharge_percent"]:checked').value);
    
    $('#sur_percent').val(selectedValue);
    

    const surchargeAmount = surcharge_amt - (surcharge_amt * (selectedValue / 100));
    
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
$(document).ready(function(){
    $('.table').dataTable(); 
})

function sendData() {

    document.getElementById("p_amt").value = document.getElementById("p-amount").value;
    document.getElementById("p_date").value = document.getElementById("p-date").value;

}

function getTableRowId(rowNum) {
    var getDiv = document.getElementById("composeEmail");
    getDiv.style.display = "block";
    var row = document.getElementById(rowNum);

  var rowId = row.getAttribute("id");

  document.getElementById("test").value=rowId;
  document.getElementById("p_amt").value = document.getElementById("p-amount"+rowId).value;
    document.getElementById("p_date").value = document.getElementById("p-date"+rowId).value;
}
</script>

<script>
$(document).on('click', ".credit-memo", function(e) {
    <?php
    $js_prop_id = md5($prop_id);

    $qry = $conn->query("SELECT status FROM property_payments WHERE md5(property_id) = '{$js_prop_id}' ORDER by payment_count ASC");
    if ($qry->num_rows > 0) {
        $payments_data = array();
        while ($row = $qry->fetch_assoc()) {
            $payments_data[] = $row;
        }
        $last_row = end($payments_data);
        $status = $last_row['status'];

        echo "var status = '{$status}';";
        if ($status === 'RESTRUCTURED') {
            echo "alert('Cannot create Credit/Debit Memo for restructured accounts.');";
        } else {
            echo "uni_modal(\"<i class='fa fa-plus'></i>&nbsp;&nbsp;Credit/Debit Memo\", \"clients/credit-memo/credit_memo.php?id={$js_prop_id}\", \"mid-large\");";
        }
    } else {
        echo "alert('No Payment Records yet!');";
    }
    ?>
});
</script>


