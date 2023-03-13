<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php


if(isset($_GET['id'])){

    $account_info = [];
    $last_payment = [];
    $payment_rec = [];
    $over_due_mode = 0;
    $over_pay_mode = 0;
    $over_due_mode_upay = 0;
    $excess = -1;
    $or_no = '';

    
    $prop = $conn->query("SELECT * FROM properties where md5(property_id) = '{$_GET['id']}' ");    
    while($row=$prop->fetch_assoc()){
    
        ///LOT
        $prop_id = $row['property_id'];
        $type = $row['c_type'];
        $lot_area = $row['c_lot_area'];
        $price_sqm = $row['c_price_sqm'];
        $lot_disc = $row['c_lot_discount'];
        $lot_disc_amt = $row['c_lot_discount_amt'];
        $lres = $lot_area * $price_sqm;
        $lcp = $lres-($lres*($lot_disc*0.01));
        $l_acc_type = $row['c_account_type'];
        $l_acc_type1 = $row['c_account_type1'];
        $acc_status = $row['c_account_status'];
        $l_date_of_sale = $row['c_date_of_sale'];
        $retention = $row['c_retention'];

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
        $vat = $row['c_vat_amount'];
        $vat_amt = (0.01 * $vat)*$tcp;
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
        $change_date = $row['c_change_date'];

        $payments = $conn->query("SELECT due_date,pay_date, payment_amount,amount_due,surcharge,interest,principal,remaining_balance,status,status_count,payment_count FROM property_payments WHERE md5(property_id) = '{$_GET['id']}' ORDER by due_date, pay_date, payment_count, remaining_balance DESC");
        $l_last = $payments->num_rows - 1;
        $payments_data = array(); 
        if($payments->num_rows <= 0){
            echo ('No Payment Records for this Account!');
        } 
        while($row = $payments->fetch_assoc()) {
          $payments_data[] = $row; 

        }
       
        $last_cnt = $l_last;
        $payment_rec = $payments_data;
        $last_payment = $payments_data[$l_last];
       
        $check_date = 0;
        $reopen_value = 0;
        $monthly_pay = 0;
        $count = 0;
        $last_sur = 0;
        $pay_mode = 0;
        $due_date = 0;
        $payment_mode = 0;
        $underpay = 0;
        $last_principal = 0;
        $last_interest = 0;
        $ma_balance = 0;
        $change_date = $change_date;
        $l_net_tcp = $net_tcp;
        $l_30_prcnt = $l_net_tcp * 0.30;
        $rem_prcnt = $l_net_tcp - $l_30_prcnt;
        $last_pay_date = strtotime($last_payment['pay_date']);
        $balance_ent = number_format($last_payment['remaining_balance'],2);
        $old_balance = $last_payment['remaining_balance'];

        }

        if($acc_status == 'Fully Paid'):
            return ;
        endif;

        if($retention == 'Retention'):
            $l_date = $last_pay_date;

        elseif(($p1 == 'Partial DownPayment') && ($acc_status == 'Reservation' || $acc_status == 'Partial DownPayment') || ($p1 == 'Full DownPayment' && $acc_status == 'Partial DownPayment')):
            //$rebate_ent->set_sensitive(0);

            $l_date = date('Y-m-d', strtotime($first_dp));
            $day = date('d', strtotime($l_date));
            $l_full_down = $last_payment['remaining_balance'] - $amt_fnanced;
            $monthly_pay = $monthly_down;
            if ($l_full_down <= $monthly_pay) {
                $l_fd_mode = 1;
            } else {
                $l_fd_mode = 0;
            }
            if ($acc_status == 'Reservation' || $last_payment['status'] == 'RESTRUCTURED' || $last_payment['status'] == 'RECOMPUTED' || $last_payment['status'] == 'ADDITIONAL'):
                $due_date_ent = (date('m/d/Y', strtotime($first_dp)));
                $due_date = strtotime(gmdate('Y-m-d', strtotime($first_dp)));
                $amount_paid_ent = (number_format($monthly_down));
                $amount_ent = (number_format($monthly_down));
                $count = 1;
                if ($last_payment['status'] == 'ADDITIONAL'):
                        $l_date = date('Y-m-d', strtotime($last_payment['due_date']));
                        $t_year = date('Y', strtotime($l_date));
                        $t_month = date('m', strtotime($l_date));
                        if ($retention == '1'):
                            $l_date = date('Y-m-d', strtotime(($first_dp)));
                        endif;
                        $t_day = date('d', strtotime($l_date));
                        $l_date2 = auto_date($due_date, $t_year, $t_month, $t_day);
                        $due_date = strtotime(gmdate('Y-m-d', $l_date2));
                        $l_date = gmdate('Y-m-d', $l_date2);
                        $due_date_ent = (date('m/d/Y', strtotime($l_date)));
                        $count = $last_payment[9] + 1;

                endif;
                if ($no_payments == $count || $l_fd_mode == 1):
                    $l_status = 'FD';
                else:
                    $l_status = 'PD - ' . strval($count);
                endif;

                $payment_status_ent = $l_status;

            elseif ($acc_status == 'Partial DownPayment'):
                $l_date = $due_date;
                if ($retention == 1):
                    $l_date = '';
                endif;
                $due_date_ent = $l_date;

                if ($last_payment['payment_amount'] < $last_payment['amount_due']):
                    $underpay = 1;
                    $l_surcharge = 0;
                    for ($x = 0; $x < $last_payment['payment_count'] + 1; $x++) {
                        try {
                            if ($last_payment['due_date'] == $payment_rec[$x]['due_date']) {
                                $last_principal += $payment_rec[$x]['principal'];
                                $l_surcharge += $payment_rec[$x]['surcharge'];
                            }
                        } catch (Exception $e) {
                            //pass
                        }
                    }

                    if ($last_payment['surcharge'] == 0):
                        $last_sur = 0;
          
                    elseif ($last_payment['payment_amount'] < $last_payment['surcharge']):
                        $last_sur = $last_payment['payment_amount'];
                            
                        $over_due_mode_upay = 1;
                    else:
                        $last_sur = $last_payment['surcharge'];
                
                        $over_due_mode_upay = 1;
                    endif;

                    $monthly_pay = $monthly_down - $last_principal;
                    $l_monthly = $last_payment['amount_due'] - $last_payment['payment_amount'];
                    $count = $last_payment['status_count'];
                    $due_date = strtotime($l_date);
                    $amount_paid_ent = (number_format($l_monthly,2));
                    $amount_ent = (number_format($l_monthly,2));
                    $total_amount_due_ent = (number_format($l_monthly,2));
                    if ($no_payments == $count || $l_fd_mode == 1) {
                        $l_status = 'FD';
                        $monthly_pay = $l_full_down;
                        $amount_paid_ent = number_format($monthly_pay,2);
                        $amount_ent = number_format($monthly_pay,2);
                        $total_amount_due_ent = (number_format($monthly_pay,2));
                    } else {
                        $l_status = 'PD - ' . strval($count);
                    }
                else:
                    $l_date2 = $auto_date($due_date, $t_year, $t_month, $t_day);
                    $due_date = $l_date2;
                    $l_date = gmdate($l_date2);
                    $due_date_ent = (date("m/d/Y", $l_date));
                    $count = $last_payment['status'] + 1;
                    $amount_paid_ent = (number_format($monthly_pay,2));
                    $amount_ent = (number_format($monthly_pay,2));
                    $total_amount_due_ent = (number_format($monthly_pay,2));
                                
                    if ($no_payments == $count || $l_fd_mode == 1) {
                        $l_status = 'FD';
                        $monthly_pay = $l_full_down;
                        $amount_paid_ent = (number_format($monthly_pay,2));
                        $amount_ent = (number_format($monthly_pay,2));
                        $total_amount_due_ent = (number_format($monthly_pay,2));
                    } else {
                        $l_status = 'PD - ' . strval($count);
                    }
                endif;     
            endif;    
            $payment_status_ent = $l_status	;

        elseif ($p1 == 'Spot Cash' && $acc_status == 'Reservation'):
            $l_date = $start_date;
            $due_date_ent = (strftime("%m/%d/%Y", $l_date));
            $payment_status_ent = ('SC');
            $due_date = $start_date;
            $amount_paid_ent = (number_format($last_payment['remaining_balance'],2));
            $amount_ent = (number_format($last_payment['remaining_balance'],2));
            $total_amount_due_ent = (number_format($last_payment['remaining_balance'],2));
            $balance_ent = (number_format($last_payment['remaining_balance'],2));
            
        elseif ($p1 == 'Full DownPayment' && $acc_status == 'Reservation'):
          
            $l_date = $full_down;
            $day = strftime("%d", $l_date);
            $due_date_ent = (strftime("%m/%d/%Y", $l_date));
            $payment_status_ent = 'FD';
            $due_date = $full_down;
            if ($last_payment['status_count'] == 'RES') {
                $monthly_pay = $net_dp;
            } elseif ($last_payment['status_count'] == 'PFD') {
                $monthly_pay = $last_payment['amount_due'] - $last_payment['payment_amount'];
                $l_date = ($last_payment['pay_date']);
                $due_date = timegm($l_date);
            }
            $amount_paid_ent = number_format($monthly_pay,2);
            $amount_ent = number_format($monthly_pay,2);
            $total_amount_due_ent = number_format($monthly_pay,2);
            $count = 1;
        elseif (($acc_status == 'Full DownPayment' && $p2 == 'Deferred Cash Payment') || ($p1 == 'No DownPayment' && $p2 == 'Deferred Cash Payment') || $acc_status == 'Deferred Cash Payment'):
 
            $l_date = gmtime(timegm(get_date($full_down)));
            $day = strftime("%d", $l_date);
            $monthly_pay = $first_dp;
            $l_full_payment = 0;
            // check for fully paid
            if ($last_payment['remaining_balance'] <= $monthly_pay):
                $l_fp_mode = 1;
                $l_full_payment = $last_payment['remaining_balance'];
            else:
                $l_fp_mode = 0;
            endif;
        
            if ($acc_status == 'Full DownPayment' || $acc_status == 'Reservation' || $last_payment['status'] == 'RESTRUCTURED' || $last_payment['status'] == 'RECOMPUTED' || $last_payment['status'] == 'ADDITIONAL'):
                $due_date_ent = (strftime("%m/%d/%Y", $l_date));
                $due_date = timegm($l_date);
                $amount_paid_ent = (number_format($monthly_pay));
                $amount_ent = (number_format($monthly_pay));
                $total_amount_due_ent = (number_format($monthly_pay));
                $count = 1;
                if ($last_payment['status'] == 'ADDITIONAL'):
                    $l_date = gmtime(timegm(get_date($last_payment['due_date'])));
                    $t_year = strftime("%Y", $l_date);
                    $t_month = strftime("%m", $l_date);
                    if ($retention == '1') {
                         $l_date = gmtime(timegm(get_date($rst['first_dp'])));
                    }
                endif;
                $t_day = strftime("%d", $l_date);
                $l_date2 = auto_date($due_date, $t_year, $t_month, $t_day);
                $due_date = $l_date2;
                $l_date = gmtime($l_date2);
                $due_date_ent = (strftime("%m/%d/%Y", $l_date));
                $count = $last_payment['status_count'] + 1;
                
                if ($terms == $count || $l_fp_mode == 1):
                    $l_full_payment = $last_payment['remaining_balance'];
                    $l_status = 'FPD';
                    $monthly_pay = $l_full_payment;
                    $amount_paid_ent = number_format($monthly_pay,2);
                    $amount_ent = number_format($monthly_pay,2);
                    $total_amount_due_ent = number_format($monthly_pay,2);
                else:
                    $l_status = 'DFC - ' . strval($count);
                endif;
                $payment_status_ent = ($l_status);
                  
            elseif ($acc_status == 'Deferred Cash Payment'):
                $l_date = gmdate("Y-m-d", strtotime($last_payment['due_date']));
                $t_year = date("Y", strtotime($l_date));
                $t_month = date("m", strtotime($l_date));
                if ($retention == '1') {
                    $l_date = date("Y-m-d", strtotime($start_date));
                }
                $t_day = $validate_date($t_year, $t_month, date("d", strtotime($l_date)));
                $due_date_ent = ($t_month . '/' . $t_day . '/' . $t_year);
            
                // under_pay
                if ($last_payment['payment_amount'] < $last_payment['amount_due']):
                    $underpay = 1;
                    $l_surcharge = 0;

                    for ($x = 0; $x < $last_payment['payment_count'] + 1; $x++) {
                        try {
                            if ($last_payment['status'] == $payment_rec[$x]['status'] && $last_payment['due_date'] == $payment_rec[$x]['due_date']) {
                                $last_principal += $payment_rec[$x]['principal'];
                                $l_surcharge += $payment_rec[$x]['surcharge'];
                            }
                        } catch (Exception $e) {
                            // pass
                        }
                    }
                    if ($last_payment['amount_due'] == 0) {
                        $last_sur = 0;
                   
                    } elseif ($last_payment['payment_amount'] < $last_payment['amount_due']) {
                        $last_sur = $last_payment['payment_amount'];
       
                        $over_due_mode_upay = 1;
                    } else {
                        $last_sur = $last_payment['surcharge'];
                    
                        $over_due_mode_upay = 1;
                    }

                    $monthly_pay = $monthly_payment - $last_principal;
                    echo $monthly_pay . ' ' . $monthly_payment . ' ' . $last_principal;
                    $l_monthly = $last_payment['amount_due'] - $last_payment['amount_paid'];
                    $count = $last_payment['status_count'];
                    $due_date = strtotime($l_date);
                    $amount_paid_ent = (number_format($l_monthly));
                    $amount_ent = (number_format($l_monthly));
                    $total_amount_due_ent = (number_format($l_monthly));
                    if ($terms == $count || $l_fp_mode == 1) {
                            $l_status = 'FPD';
                    $monthly_pay = $l_full_payment;
                    $amount_paid_ent = (number_format($monthly_pay));
                    $amount_ent = (number_format($monthly_pay));
                    $total_amount_due_ent = (number_format($monthly_pay));
                    } else {
                            $l_status = 'DFC - ' . strval($count);
                    }

                else:

                    // something nawawala dito//
                
          
                endif;
        elseif (($acc_status == 'Full DownPayment' && $p2 == 'Monthly Amortization') || ($p1 == 'No DownPayment' && $p2 == 'Monthly Amortization') || $acc_status == 'Monthly Amortization'):
      /*           $credit_principal_mnu->set_sensitive(1);
                $revert_interest->set_sensitive(1);
                $revert_rebate->set_sensitive(1); */
                $l_date = gmdate(timegm(get_date($start_date)));
                $day = strftime("%d", $l_date);
                $monthly_pay = $monthly_payment;
            
                 
                if ($acc_status == 'Full DownPayment' || $acc_status == 'Reservation' || $last_payment['status'] == 'RESTRUCTURED' || $last_payment['status'] == 'RECOMPUTED' || $last_payment['status'] == 'ADDITIONAL'):
                    $due_date = strftime("%m/%d/%Y", $l_date);
                    $due_date_ent = ($due_date);
                    $due_date = timegm($l_date);
                    $amount = number_format($rst[27]);
                    $amount_paid_ent = ($amount);
                    $amount_ent = ($amount);
                    $total_amount_due_ent = ($amount);
                    $count = 1;
                    if ($last_payment['status'] == 'ADDITIONAL') {
                        $l_date = date(get_date($last_payment['due_date']));
                        $t_year = strftime("%Y", $l_date);
                        $t_month = strftime("%m", $l_date);
                        if ($retention == '1') {
                            $l_date = date(get_date($rst['first_dp']));
                        }
                        $t_day = strftime("%d", $l_date);
                        $l_date2 = auto_date($due_date, $t_year, $t_month, $t_day);
                        $due_date = $l_date2;
                        $l_date = gmdate($l_date2);
                        $due_date_ent = (strftime("%m/%d/%Y", $l_date));
                        $count = $last_payment[9] + 1;
                    }
                    $l_interest = $last_payment['remaining-balance'] * ($interest_rate / 1200);
                    $l_principal = $monthly_payment - $l_interest;
                    if ($last_payment['remaining_balance'] <= $l_principal || $terms == $count) {
                        $l_status = 'FPD';
                        $monthly_pay = $last_payment['remaining_balance'] + $l_interest;
                        $amount_paid_ent = number_format($monthly_pay,2);
                        $amount_ent = number_format($monthly_pay,2);
                        $total_amount_due_ent = number_format($monthly_pay,2);
                    }else {
                        $l_status = 'MA - ' . strval($count);
                    }
                    $payment_status_ent = ($l_status);


                elseif ($acc_status == 'Monthly Amortization'):
                    $l_date = gmtime(timegm(get_date($last_payment['due_date'])));
                    $t_year = strftime("%Y", $l_date);
                    $t_month = strftime("%m", $l_date);
                    if ($retention == '1') {
                        $l_date = gmtime(timegm(get_date($start_date)));
                    }
                    $t_day = $validate_date($t_year, $t_month, strftime("%d", $l_date));
                    $due_date_ent = ($t_month . '/' . $t_day . '/' . $t_year);
                    //under_pay
                    if ($last_payment[2] < $last_payment[3]) {
                        $l_surcharge = 0;
                        $underpay = 1;
                        $x_y = $last_cnt;
                        $l_cnt = 0;
                        $l_tot_int = 0;
                        while ($last_payment[8] == $payment_rec[$x_y][8]) {
                            $l_last_interest = $payment_rec[$x_y][7] * ($rst[25] / 1200);
                            $l_tot_int += $payment_rec[$x_y][5];
                            $x_y -= 1;
                            $l_cnt += 1;
                            $l_int_last = $l_last_interest - $l_tot_int;
                        }
                        $monthly_pay = $monthly_pay - $last_principal - $last_interest;
                        if ($l_cnt > 1) {
                            // implement additional code here   
                            foreach (range(0, $last_payment[10]) as $x) {
                                try {
                                    /*
                                    Eric Note ito sa sarili mo : Ngayon ay 09-07-12.
                                    Kung sakali lang naman na may mag-error na negative ang result sa surcharges
                                    ng mga agesnts na MA ang status, i-uncomment mo yung nasa itaas at i-comment mo
                                    yung nasa ibaba. Yung nasa ibaba ay gumagana sa DFC.
                                    */
                                    if ($last_payment[8] == $payment_rec[$x][8] && $last_payment[0] == $payment_rec[$x][0]) {
                                        $last_principal += $payment_rec[$x][6];
                                        $last_interest += $payment_rec[$x][5];
                                        $l_surcharge += $payment_rec[$x][4];
                                    }
                                } catch (\Throwable $th) {
                                    // do nothing
                                }
                            }  
                            $monthly_pay = $monthly_pay - $last_principal - $last_interest;  
            
                        }else {
                            $monthly_pay = $last_payment[3] - $last_payment[2];
                            $last_interest = $l_tot_int;
                            $ma_balance = $last_payment[7] + $last_principal;
                        }
                        if ($last_payment[4] == 0) {
                            $last_sur = 0;
                        }elseif ($last_payment[2] < $last_payment[4]) {
                            $last_sur = $last_payment[2];
                            $over_due_mode_upay = 1;
                            $monthly_pay = $rst[27];
                        }else {
                            $last_sur = $last_payment[4];
                            $over_due_mode_upay = 1;
                        }

                endif;
        endif;

    }
?>
<style>
#item-list th, #item-list td{
	padding:5px 3px!important;
}

.container-fluid p{
    margin: unset
}


</style>

<div class="card card-outline rounded-0 card-maroon">
    
	<div class="card-header">
	<h3 class="card-title">Property ID# <?php echo $prop_id ?> </h3>
	</div>
	<div class="card-body">
    <div class="container-fluid">
        <form action="" method="POST">
            <label for="prop_id">Property ID:</label>
            <input type="text" id="prop_id" name="prop_id" value="<?php echo $prop_id; ?>"><br>

            <label for="acc_type1">Account Type1:</label>
            <input type="text" id="acc_type1" name="acc_type1" value="<?php echo $l_acc_type; ?>"><br>

            <label for="acc_type2">Account Type2:</label>
            <input type="text" id="acc_type2" name="acc_type2" value="<?php echo $l_acc_type1; ?>"><br>

            <label for="date_of_sale">Date of Sale:</label>
            <input type="date" id="date_of_sale" name="date_of_sale" value="<?php echo $l_date_of_sale; ?>"><br>

            <label for="acc_status">Account Status:</label>
            <input type="text" id="acc" name="acc_status" value="<?php echo $acc_status; ?>"><br>

            <label for="acc_option">Account Option:</label>
            <input type="text" id="acc_option" name="acc_option" value="<?php echo $retention; ?>"><br>

            <label for="payment_type1">Payment Type 1:</label>
            <input type="text" id="payment_type1" name="payment_type1" value="<?php echo $p1; ?>"><br>

            <label for="payment_type2">Payment Type 2:</label>
            <input type="text" id="payment_type2" name="payment_type2" value="<?php echo $p2; ?>"><br>
            
            <label for="due_date">Due Date:</label>
            <input type="date" id="due_date" name="due_date" value="<?php echo $due_date; ?>"><br>

            <label for="pay_date">Pay Date:</label>
            <input type="date" id="pay_date" name="pay_date" value="<?php echo date('Y-m-d'); ?>"><br>

            <label for="status">Status:</label>
            <input type="text" id="status" name="status" ><br>

            <label for="amount_due">Amount Due:</label>
            <input type="text" id="amount_due" name="amount_due" ><br>
            
            <label for="surcharge">Surcharge:</label>
            <input type="text" id="surcharge" name="surcharge" required><br>

            <label for="rebate">Rebate:</label>
            <input type="text" id="rebate" name="rebate" required><br>

            <label for="tot_amt_due">Total Amount Due:</label>
            <input type="text" id="tot_amt_due" name="tot_amt_due" required><br>

            <label for="balance">Balance:</label>
            <input type="text" id="balance" name="balance" required><br>

            <label for="amount_paid">Amount Paid:</label>
            <input type="text" id="amount_paid" name="amount_paid" required><br>

            <label for="or_no">Or #:</label>
            <input type="text" id="or_no" name="or_no" required><br>
        </form>


    </div>
	</div>
</div>
<script>


	
</script>