
<?php
    include 'common.php';


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
    while($row=$prop->fetch_assoc()):
    
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

/* 
        $invoices = $conn->query("SELECT due_date,pay_date,payment_amount,amount_due,surcharge,interest,principal,remaining_balance,status,status_count,payment_count,excess,account_status,or_no FROM t_invoice WHERE md5(property_id) = '{$_GET['id']}' ORDER by due_date, pay_date, payment_count, remaining_balance DESC");
        $l_last = $invoices->num_rows - 1;
        $payments_data = array(); 
        if($invoices->num_rows <= 0){

            $payments = $conn->query("SELECT due_date,pay_date, payment_amount,amount_due,surcharge,interest,principal,remaining_balance,status,status_count,payment_count FROM property_payments WHERE md5(property_id) = '{$_GET['id']}' ORDER by due_date, pay_date, payment_count, remaining_balance DESC");
            $l_last = $payments->num_rows - 1;
            $payments_data = array(); 
            if($payments->num_rows <= 0){
                echo ('No Payment Records for this Account!');
            } 
            while($row = $payments->fetch_assoc()) {
              $payments_data[] = $row; 
            }
        }
        while($row2 = $invoices->fetch_assoc()) {
          $payments_data[] = $row2; 

        }
 */

        $invoices = $conn->query("SELECT due_date,pay_date, payment_amount,amount_due,surcharge,interest,principal,remaining_balance,status,status_count,payment_count, 0 AS excess, NULL as account_status, or_no FROM property_payments WHERE md5(property_id) = '{$_GET['id']}'  UNION SELECT due_date,pay_date,payment_amount,amount_due,surcharge,interest,principal,remaining_balance,status,status_count,payment_count,excess,account_status,or_no FROM t_invoice WHERE md5(property_id) = '{$_GET['id']}'  ORDER by due_date, pay_date, payment_count, remaining_balance DESC");
        $l_last = $invoices->num_rows - 1;
        $payments_data = array(); 
        if($invoices->num_rows <= 0){
                echo ('No Payment Records for this Account!');
        }
        while($row2 = $invoices->fetch_assoc()) {
          $payments_data[] = $row2; 

        }


       
        $last_cnt = $l_last;
        $payment_rec = $payments_data;
        $last_payment = $payments_data[$l_last];
       

        
        

        $last_excess = isset($last_payment['excess']) ? $last_payment['excess'] : 0;
        $last_acc_stat = isset($last_payment['account_status']) ? $last_payment['account_status'] : '';
        $last_or_ent = isset($last_payment['or_no']) ? $last_payment['or_no'] : '';
        $last_pay_ent = isset($last_payment['pay_date']) ? $last_payment['pay_date'] : date('Y-m-d');
       
       
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
        //$old_balance = $last_payment['remaining_balance'];

        $last_stat_count = $last_payment['status_count'];
        $last_pay_count = $last_payment['payment_count'];

       
     
        if ($last_acc_stat != ''){
            $acc_status = $last_acc_stat;
        }

        echo $acc_status;
        //code start here 

        
        if($acc_status == 'Fully Paid'):
            $amount_ent = '';
            $amount_paid_ent = '';
            $surcharge_ent = '';
            $rebate_ent = '';
            $total_amount_due_ent = '';
            $due_date_ent = '';
            $payment_status_ent = '';
            
        endif;

        if($retention == '1'):
            $l_date = $last_pay_date;
            $amount_ent = '0.00';
            $amount_paid_ent = number_format($last_payment['remaining_balance'],2);
            $surcharge_ent = '0.00';
            $rebate_ent = '0.00';
            $total_amount_due_ent = '0.00';
            $due_date_ent = $l_date;
            $payment_status_ent = 'RETENTION';

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
                //$due_date = strtotime(gmdate('Y-m-d', strtotime($first_dp)));
                $due_date = new DateTime($due_date_ent);
                $amount_paid_ent = (number_format($monthly_down,2));
                $amount_ent = (number_format($monthly_down,2));
                $total_amount_due_ent = (number_format($monthly_down,2));
                $count = 1;
                if ($last_payment['status'] == 'ADDITIONAL'):
                        $l_date = date('Y-m-d', strtotime($last_payment['due_date']));
                        
                        if ($retention == '1'):
                            $l_date = new DateTime($first_dp);
                        endif;
                        $t_day = date('d', strtotime($l_date));
                        $l_date2 =  new Datetime(auto_date($t_day,$l_date));
                        $due_date_ent = $l_date2->format('m/d/y');
                        $count = floatval($last_payment['status_count']) + 1;

                endif;
                if ($no_payments == $count || $l_fd_mode == 1):
                    $l_status = 'FD';
                else:
                    $l_status = 'PD - ' . strval($count);
                endif;

                $payment_status_ent = $l_status;

            elseif ($acc_status == 'Partial DownPayment'):
                $l_date = $last_payment['due_date'];
                $t_year = date('Y', strtotime($l_date));
                $t_month = date('m', strtotime($l_date));
                
                if ($retention == 1):
                    $l_date = date("Y-m-d", strtotime($full_down));
                endif;
                $day = date('d', strtotime($l_date));
                $t_day = validate_date($t_year,$t_month,$day);
                $due_date_ent = $t_year .'/'. $t_month .'/'. $t_day;
                //$due_date_ent = date('m/d/Y', strtotime($l_date));
                if ($last_payment['payment_amount'] < $last_payment['amount_due']):
                    $underpay = 1;
                    $l_surcharge = 0;
                    for ($x = 0; $x < floatval($last_payment['payment_count']); $x++) {
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
                    //echo $day;
                    $l_date2 = new Datetime(auto_date($day,$l_date));
                    $due_date = $l_date2;
                    $due_date_ent = $due_date->format('m/d/y');
                    //echo $last_payment['status_count'];
                    $count = floatval($last_payment['status_count']) + 1;
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
            $l_date = date('Y-m-d', strtotime($start_date));
            $day = date('d', strtotime($l_date));
            $due_date_ent = date('m/d/Y', strtotime($l_date));
            $payment_status_ent = ('SC');
            $due_date = $start_date;
            $amount_paid_ent = (number_format($last_payment['remaining_balance'],2));
            $amount_ent = (number_format($last_payment['remaining_balance'],2));
            $total_amount_due_ent = (number_format($last_payment['remaining_balance'],2));
            $balance_ent = (number_format($last_payment['remaining_balance'],2));
            
        elseif ($p1 == 'Full DownPayment' && $acc_status == 'Reservation'):
            $l_date = date('Y-m-d', strtotime($full_down));
            $day = date('d', strtotime($l_date));
            $due_date_ent = date('m/d/Y', strtotime($l_date));
            $payment_status_ent = 'FD';
            $due_date = $full_down;
            if ($last_payment['status'] == 'RES') {
                $monthly_pay = $net_dp;
            } elseif ($last_payment['status'] == 'PFD') {
                $monthly_pay = $last_payment['amount_due'] - $last_payment['payment_amount'];
                $l_date = ($last_payment['pay_date']);
                $due_date = timegm($l_date);
            }
            $amount_paid_ent = number_format($monthly_pay,2);
            $amount_ent = number_format($monthly_pay,2);
            $total_amount_due_ent = number_format($monthly_pay,2);
            $count = 1;
        elseif (($acc_status == 'Full DownPayment' && $p2 == 'Deferred Cash Payment') || ($p1 == 'No DownPayment' && $p2 == 'Deferred Cash Payment') || $acc_status == 'Deferred Cash Payment'):
 
            $l_date = date('Y-m-d', strtotime($full_down));
            $day = date('d', strtotime($l_date));
            $monthly_pay = $monthly_payment;
            $l_full_payment = 0;
            // check for fully paid
            if ($last_payment['remaining_balance'] <= $monthly_pay):
                $l_fp_mode = 1;
                $l_full_payment = $last_payment['remaining_balance'];
            else:
                $l_fp_mode = 0;
            endif;
        
            if ($acc_status == 'Full DownPayment' || $acc_status == 'Reservation' || $last_payment['status'] == 'RESTRUCTURED' || $last_payment['status'] == 'RECOMPUTED' || $last_payment['status'] == 'ADDITIONAL'):
                $due_date_ent = date('Y-m-d', strtotime($l_date));
                $due_date = new Datetime($due_date_ent);
                $amount_paid_ent = (number_format($monthly_pay,2));
                $amount_ent = (number_format($monthly_pay,2));
                $total_amount_due_ent = (number_format($monthly_pay,2));
                $count = 1;
                if ($last_payment['status'] == 'ADDITIONAL'):
                    $l_date = date('Y-m-d', strtotime($last_payment['due_date']));
                        
                    if ($retention == '1'):
                        $l_date = new DateTime($first_dp);
                    endif;
                    $t_day =  date('d', strtotime($l_date));
                    $l_date2 = new Datetime(auto_date($day,$due_date_ent));
                    $due_date = $l_date2;
                    $due_date_ent = $due_date->format('m/d/y');
                    $count = $last_payment['status_count'] + 1;
                endif;
               
                
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
                $l_date = $last_payment['due_date'];
                $t_year = date('Y', strtotime($l_date));
                $t_month = date('m', strtotime($l_date));
                
                if ($retention == 1):
                    $l_date = date("Y-m-d", strtotime($start_date));
                endif;
                $day = date('d', strtotime($l_date));
                $t_day = validate_date($t_year,$t_month,$day);
                $due_date_ent = $t_year .'/'. $t_month .'/'. $t_day;
                // under_pay
                if ($last_payment['payment_amount'] < $last_payment['amount_due']):
                    $underpay = 1;
                    $l_surcharge = 0;

                    for ($x = 0; $x < floatval($last_payment['payment_count']); $x++) {
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
                    $l_monthly = $last_payment['amount_due'] - $last_payment['payment_amount'];
                    $count = $last_payment['status_count'];
                    $due_date = strtotime($l_date);
                    $amount_paid_ent = (number_format($l_monthly,2));
                    $amount_ent = (number_format($l_monthly,2));
                    $total_amount_due_ent = (number_format($l_monthly,2));
                    if ($terms == $count || $l_fp_mode == 1) {
                            $l_status = 'FPD';
                            $monthly_pay = $l_full_payment;
                            $amount_paid_ent = (number_format($monthly_pay,2));
                            $amount_ent = (number_format($monthly_pay));
                            $total_amount_due_ent = (number_format($monthly_pay,2));
                    } else {
                            $l_status = 'DFC - ' . strval($count);
                    }

                else:
                
                    $l_date2 = new Datetime(auto_date($day,$due_date_ent));
                    $due_date = $l_date2;
                    $due_date_ent = $due_date->format('m/d/y');
                    $count = floatval($last_payment['status_count']) + 1;
                    $amount_paid_ent = (number_format($monthly_pay,2));
                    $amount_ent = (number_format($monthly_pay,2));
                    $total_amount_due_ent = (number_format($monthly_pay,2));
                    if ($terms == $count || $l_fp_mode == 1) {
                            $l_status = 'FPD';
                            $l_full_payment = $last_payment['remaining_balance'];
                            $monthly_pay = $l_full_payment;
                            $amount_paid_ent = (number_format($monthly_pay,2));
                            $amount_ent = (number_format($monthly_pay,2));
                            $total_amount_due_ent = (number_format($monthly_pay,2));
                    } else {
                            $l_status = 'DFC - ' . strval($count);
                    }
                   
                endif;
            endif;
            $payment_status_ent = $l_status	;
                
        elseif (($acc_status == 'Full DownPayment' && $p2 == 'Monthly Amortization') || ($p1 == 'No DownPayment' && $p2 == 'Monthly Amortization') || $acc_status == 'Monthly Amortization'):
                $l_date = date('Y-m-d', strtotime($start_date));
                $day = date('d', strtotime($l_date));
                $monthly_pay = $monthly_payment;
            
                
                if ($acc_status == 'Full DownPayment' || $acc_status == 'Reservation' || $last_payment['status'] == 'RESTRUCTURED' || $last_payment['status'] == 'RECOMPUTED' || $last_payment['status'] == 'ADDITIONAL'):
                    $due_date = date('m/d/Y', strtotime($l_date));
                    $due_date_ent = $due_date;
                    $due_date = $due_date_ent;
                    $amount = number_format($monthly_payment,2);
                    $amount_paid_ent = ($amount);
                    $amount_ent = $amount;
                    $total_amount_due_ent = $amount;
                    $count = 1;
                    if ($last_payment['status'] == 'ADDITIONAL') {
                        $l_date = date('Y-m-d', strtotime($last_payment['due_date']));
                        $t_year =  date('Y', strtotime($l_date));
                        $t_month =  date('m', strtotime($l_date));
                        if ($retention == '1') {
                            $l_date = date('Y-m-d', strtotime($last_payment['first_dp']));
                        }
                        $t_day =  date('d', strtotime($l_date));
                        $l_date2 = new Datetime(auto_date($t_day,$due_date));
                        $due_date = $l_date2;
                        $due_date_ent = $due_date->format('m/d/y');
                        $count = $last_payment[9] + 1;
                    }
                    $l_interest = $last_payment['remaining_balance'] * ($interest_rate / 1200);
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
                    $l_date = date('Y-m-d', strtotime($last_payment['due_date']));
                    $t_year =  date('Y', strtotime($l_date));
                    $t_month =  date('m', strtotime($l_date));
                    if ($retention == '1') {
                        $l_date = date('Y-m-d', strtotime($start_date));
                    }
                    $day = date('d', strtotime($l_date));
                    $t_day = validate_date($t_year,$t_month,$day);
                    $due_date_ent = $t_year .'/'. $t_month .'/'. $t_day;
                    //under_pay
                    if ($last_payment['payment_amount'] < $last_payment['amount_due']):
                        $l_surcharge = 0;
                        $underpay = 1;
                        $x_y = $last_cnt;
                        $l_cnt = 0;
                        $l_tot_int = 0;
                        while ($last_payment['status'] == $payment_rec[$x_y]['status']) {
                            $l_last_interest = $payment_rec[$x_y]['remaining_balance'] * ($interest_rate / 1200);
                            $l_tot_int += $payment_rec[$x_y]['interest'];
                            $x_y -= 1;
                            $l_cnt += 1;
                            $l_int_last = $l_last_interest - $l_tot_int;
                        }
                        $monthly_pay = $monthly_pay - $last_principal - $last_interest;
                        if ($l_cnt > 1) {
                            // implement additional code here   
                            for ($x = 0; $x < floatval($last_payment['payment_count']); $x++) {
                                try {
                                   
                                    if ($last_payment['status'] == $payment_rec[$x]['status'] && $last_payment['due_date'] == $payment_rec[$x]['due_date']) {
                                        $last_principal += $payment_rec[$x]['principal'];
                                        $last_interest += $payment_rec[$x]['interest'];
                                        $l_surcharge += $payment_rec[$x]['surcharge'];
                                    }
                                } catch (Exception $e) {
                                    //pass
                                }
                            }  
                            $monthly_pay = $monthly_pay - $last_principal - $last_interest;  
            
                        }else {
                            $monthly_pay = $last_payment['amount_due'] - $last_payment['payment_amount'];
                            $last_interest = $l_tot_int;
                            $ma_balance = $last_payment['remaining_balance'] + $last_principal;
                        }
                        if ($last_payment['surcharge'] == 0):
                            $last_sur = 0;
                        elseif ($last_payment['payment_amount'] < $last_payment['surcharge']):
                            $last_sur = $last_payment['payment_amount'];
                            $over_due_mode_upay = 1;
                            $monthly_pay = $monthly_payment;
                        else:
                            $last_sur = $last_payment['surcharge'];
                            $over_due_mode_upay = 1;
                        endif;
                        
                        if ($last_payment['payment_amount'] < $last_payment['amount_due']):
                                $l_date = date('Y-m-d', strtotime($last_payment['due_date']));
                        endif;

                        $l_monthly = $last_payment['amount_due'] - $last_payment['payment_amount'];
                        $count = $last_payment['status_count'];
                        //$due_date = timegm($l_date);
                        $amount_paid_ent = (number_format($monthly_pay,2));
                        $amount_ent = (number_format($monthly_pay,2));
                        $total_amount_due_ent = (number_format($monthly_pay,2));

                        if ($l_cnt > 1) {
                            $l_interest = $l_int_last;
                        } else {
                            $l_interest = $ma_balance * ($interest_rate / 1200);
                        }
                        if ($last_interest < $l_interest) {
                            $l_interest = $l_interest - $last_interest;
                        } else {
                            $l_interest = 0.00;
                        }
                        if ($l_cnt > 1) {
                            $l_principal = $monthly_pay - $l_last_interest;
                        } else {
                            $l_principal = $monthly_pay - $l_interest;
                        }
                        if ($last_payment['remaining_balance'] <= $l_principal || $terms == $count) {
                            $l_status = 'FPD';
                            $monthly_pay = $last_payment['remaining_balance'] + $l_interest;
                            $amount_paid_ent = (number_format($last_payment['remaining_balance'],2));
                            $amount_ent = (number_format($monthly_pay,2));
                            $total_amount_due_ent = (number_format($last_payment['remaining_balance'],2 ));
                        } else {
                            $l_status = 'MA - ' . strval($count);
                        }
                        $payment_status_ent = ($l_status);



                    else:
                        $l_date = new Datetime(auto_date($t_day,$due_date_ent));
                        $due_date = $l_date;
                        $due_date_ent = $due_date->format('m/d/y');
                        $count = floatval($last_payment['status_count']) + 1;
                        $amount_paid_ent = (number_format($monthly_pay,2));
                        $amount_ent = (number_format($monthly_pay,2));
                        $total_amount_due_ent = (number_format($monthly_pay,2));

                        $l_interest = $last_payment['remaining_balance'] * ($interest_rate /1200);
                        $l_principal = $monthly_pay - $l_interest;
                        if ($last_payment['remaining_balance'] <= $l_principal || $terms == $count) {
                            $interest = $l_interest;
                            $l_status = 'FPD';
                            $monthly_pay = $last_payment['remaining_balance'] + $l_interest;
                            $amount_paid_ent = (number_format($last_payment['remaining_balance'],2));
                            $amount_ent = (number_format($monthly_pay,2));
                            $total_amount_due_ent = (number_format($last_payment['remaining_balance'],2));
                        } else {
                            $l_status = 'MA - ' . strval($count);
                        }
                        $payment_status_ent = ($l_status);
                    endif;

                endif;   
            
               
        else:        
        
            echo "Error";
            
        endif;

    endwhile;

}
/*  */
?>
<style>
#item-list th, #item-list td{
	padding:5px 3px!important;
}

.container-fluid p{
    margin: unset
}


</style>

<script>
  

</script>

<div class="card card-outline rounded-0 card-maroon">
    
	<div class="card-header">
	<h3 class="card-title"><b>Property ID #: <i><?php echo $prop_id ?></i> </b></h3>
	</div>
	<div class="card-body">
    <div class="container-fluid">
    <form action="" method="POST" id="save_payment">

        <table>
            <tr>
                <td style="width:25%;font-size:14px;"><label for="prop_id">Property ID:</label></td><td style="width:25%;font-size:14px;"><input type="text" id="prop_id" name="prop_id" value="<?php echo $prop_id; ?>"></td><td style="width:25%;font-size:14px;"><label for="acc_status">Account Status:</label></td><td style="width:25%;font-size:14px;"><input type="text" id="acc_status" name="acc_status" value="<?php echo $acc_status; ?>"></td>
            </tr>
            <tr>
                <td style="width:25%;font-size:14px;"><label for="acc_type1">Account Type1:</label></td><td style="width:25%;font-size:14px;"><input type="text" id="acc_type1" name="acc_type1" value="<?php echo $l_acc_type; ?>"></td><td style="width:25%;font-size:14px;"><label for="acc_option">Account Option:</label></td><td style="width:25%;font-size:14px;"><input type="text" id="acc_option" name="acc_option" value="<?php echo isset($retention) && $retention == 1 ? 'Retention' : '' ?>"><br></td>
            </tr>
            <tr>
                <td style="width:25%;font-size:14px;"><label for="acc_type2">Account Type2:</label></td><td style="width:25%;font-size:14px;"> <input type="text" id="acc_type2" name="acc_type2" value="<?php echo $l_acc_type1; ?>"></td><td style="width:25%;font-size:14px;"><label for="payment_type1">Payment Type 1:</label></td><td style="width:25%;font-size:14px;"><input type="text" id="payment_type1" name="payment_type1" value="<?php echo $p1; ?>"></td>
            </tr>
            <tr>
                <td style="width:25%;font-size:14px;"><label for="date_of_sale">Date of Sale:</label></td><td style="width:25%;font-size:14px;"><input type="date" id="date_of_sale" name="date_of_sale" value="<?php echo $l_date_of_sale; ?>" style="width:100%;font-size:14px;"></td><td style="width:25%;"><label for="payment_type2">Payment Type 2:</label></td><td style="width:25%;font-size:14px;"><input type="text" id="payment_type2" name="payment_type2" value="<?php echo $p2; ?>"></td>
            </tr>
        </table>
        <hr>

        <table>
            <?php 
                if ($last_excess != -1 && $last_excess != 0){
                    $amount_paid_ent = $last_excess;
                    $or_ent = $last_or_ent;
                    $pay_date_ent = $last_pay_ent;
                }
               
                ?>
            <tr>

                <td style="width:25%;font-size:14px;"><label for="due_date">Due Date:</label></td>
                <td style="width:25%;font-size:14px;"><input type="date" class="form-control-sm margin-bottom due-date" name="due_date" value="<?php echo date("Y-m-d", strtotime($due_date_ent)); ?>" style="width:100%;"></td>
                <td style="width:25%;font-size:14px;"><label for="pay_date">Pay Date:</label></td>
                <td style="width:25%;font-size:14px;"><input type="date" class="form-control-sm margin-bottom pay-date" id="pay_date" name="pay_date" value="<?php echo isset($pay_date_ent) ? date("Y-m-d", strtotime($pay_date_ent)) : date("Y-m-d");?>" style="width:100%;"></td>
            </tr>
            <tr>
                <td style="width:25%;font-size:14px;"><label for="amount_due">Amount Due:</label></td><td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom amt-due"  id="amount_due" name="amount_due" value="<?php echo $amount_ent; ?>"></td><td style="width:25%;font-size:14px;"><label for="surcharge">Surcharge:</label></td><td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom surcharge-amt" id="surcharge" name="surcharge" value="<?php echo isset($surcharge_ent) ? $surcharge_ent : 0.00; ?>" required></td>
            </tr>
            <tr>
                <td style="width:25%;font-size:14px;"><label for="status">Status:</label></td><td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom pay-stat"  id="status" name="status" value="<?php echo $payment_status_ent; ?>"></td><td style="width:25%;font-size:14px;"><label for="rebate">Rebate:</label></td><td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom rebate-amt" id="rebate_amt" name="rebate_amt" value="<?php echo isset($rebate_ent) ? $rebate_ent : 0.00; ?>" required></td>
            </tr>
        </table>
        <br>
        <table>
            <tr>
                <td style="width:25%;font-size:14px;"><label for="tot_amt_due">Total Amount Due:</label></td><td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom tot-amt-due"  id="tot_amount_due" name="tot_amount_due" value="<?php echo isset($total_amount_due_ent) ? $total_amount_due_ent : 0.00; ?>" required></td><td style="width:25%;font-size:14px;"><label for="balance">Balance:</label></td><td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom balance-amt"  id="balance" name="balance" value="<?php echo $balance_ent; ?>" required></td>
            </tr>
            <tr>
                
                
                <td style="width:25%;font-size:14px;"><label for="amount_paid">Amount Paid:</label></td><td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom amt-paid"  id="amount_paid" name="amount_paid" value="<?php echo $amount_paid_ent; ?>" required></td><td style="width:25%;font-size:14px;"><label for="or_no">OR #:</label></td><td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom or-no"  id="or_no_ent" name="or_no_ent" value="<?php echo isset($or_ent) ? $or_ent : ''; ?>" required></td>
            </tr>
        </table>
        <input type="hidden" class="form-control-sm margin-bottom int-rate"  id="interest_rate" name="interest_rate" value="<?php echo $interest_rate; ?>"> 
        <input type="hidden" class="form-control-sm margin-bottom under-pay"  id="under_pay" name="under_pay" value="<?php echo $underpay; ?>"> 
        <input type="hidden" class="form-control-sm margin-bottom excess"  id="excess" name="excess" value="<?php echo $excess; ?>"> 
        <input type="hidden" class="form-control-sm margin-bottom over-due-mode"  id="over_due_mode" name="over_due_mode" value="<?php echo $over_due_mode_upay; ?>">   
        <input type="hidden" class="form-control-sm margin-bottom monthly-pay"  id="monthly_pay" name="monthly_pay" value="<?php echo $monthly_pay; ?>">   
        <input type="hidden" class="form-control-sm margin-bottom status-count"  id="status_count" name="status_count" value="<?php echo $count; ?>">   
        <input type="hidden" class="form-control-sm margin-bottom payment-count"  id="payment_count" name="payment_count" value="<?php echo $last_pay_count; ?>">   
        <input type="hidden" class="form-control-sm margin-bottom "  id="ma_balance" name="ma_balance" value="<?php echo $ma_balance; ?>">   
        <input type="hidden" class="form-control-sm margin-bottom "  id="last_interest" name="last_interest" value="<?php echo isset($last_interest) ? $last_interest  : 0; ?>">   
    

        <input type="submit" name="submit" value="Submit">

        
        </form>

            <table class="table2 table-bordered table-stripped">
                    <?php $qry4 = $conn->query("SELECT * FROM t_invoice where md5(property_id) = '{$_GET['id']}' ORDER by due_date, pay_date, payment_count ASC");
                     if($qry4->num_rows <= 0){
                           echo "No Payment Records";
                     }else{  ?>      
   
                      <thead> 
                          <tr>
                              <th style="text-align:center;font-size:13px;">Action</th>
                              <th style="text-align:center;font-size:13px;">Payment ID</th>
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
                          $invoice_id = $row['invoice_id'];
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

                      
                      
                      echo "<tr id='{$row['invoice_id']}'>";
                      echo "<td><button onclick='deleteRow({$row['invoice_id']})'>Delete</button></td>";
                
                    echo "<td>{$row['invoice_id']}</td>";
                       ?>
                         
                        <td class="text-center" style="font-size:13px;width:12%;"><?php echo $due_dte ?> </td> 
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
        </thead>
        <tbody>
        </tbody>
    </table>

  
    </div>
	</div>
</div>
<script>

    
   function deleteRow(rowId) {
   
   $.ajax({
       url:_base_url_+'classes/Master.php?f=delete_invoice',
       method:'POST',
       data:{rowId: rowId},
       dataType:"json",
       error:err=>{
           console.log(err)
           alert_toast("An error occured",'error');
           end_loader();
           },
     
       success:function(resp){
           $('#' + rowId).remove();
           console.log(resp);
           location.reload();

           }
      
   });
}  
 


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

        $('#save_payment').submit(function(e){
			e.preventDefault();
            var _this = $(this)
		 	$('.err-msg').remove();
			
             var errorCounter = validateForm();
             if (errorCounter > 0) {
                alert_toast("It appear's you have forgotten to complete something!","warning");	  
                return false;
            }else{
                $(".required").parent().removeClass("has-error")
            }    
            start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=add_payment",
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
                        data = [resp['data']];
                        $.each(data, function(index, payments) {
                            
                        
                            compute(payments.excess);

                            location.reload();
                        
                                                
                    });
                  
                    

                    // Show success message and reload page
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
		})
        
	})
	




    	// remove commission row
	$('#payment-table').on('click', ".delete-pay-row", function(e) {
		e.preventDefault();
		$(this).closest('tr').remove();

            
	});


    function compute(excess){
        if (excess == -1){
            excesspay = 0;
        }else{
            excesspay = excess;
        }
        $('#amount_paid').val(excesspay.toFixed(2));
  
        
    }




</script>