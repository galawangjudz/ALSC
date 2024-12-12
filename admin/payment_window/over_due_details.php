<?php
function auto_date($cnx2,$id,$last_day, $date) {
  
    $date_arr = date_parse($date);
    $year = $date_arr['year'];
    $month = $date_arr['month'];
    $day = $date_arr['day'];

    $l_sql = "SELECT c_retention, c_change_date, c_restructured, c_date_of_sale 
    FROM t_buyers_account
    WHERE c_account_no = '$id'";
    $l_qry = odbc_exec($cnx2, $l_sql);

    if (!$l_qry) {
    die('Error in SQL query: ' . odbc_errormsg($cnx2));
    }

    if ($row = odbc_fetch_array($l_qry)) {
    $change_date = $row['c_change_date'];
    $date_of_sale = $row['c_date_of_sale'];
    $day_of_Sale = substr($date_of_sale,8,2);
    }

    $l_leap = ($year % 4 == 0 && $year % 100 != 0) || ($year % 400 == 0);

    if ($day_of_Sale == 31 && $last_day >= 28 && $change_date != 1) {
        $last_day = 31;
       
    }
    
    if ($month == 1):
        if ($last_day < 28):
            $dt = new DateTime($date);
            $dt->modify('+31 days');
            $l_result = $dt->format('Y-m-d');     
        else:
            if ($l_leap):
                  $l_result = $year .'-02-29';
            else:
                  $l_result = $year .'-02-28';
               
            endif;

        endif;
    elseif($month == 2):
        if ($last_day > 28):
            if($last_day == 29):
                $l_result = $year .'-03-29'; 
            elseif($last_day == 30):
                $l_result = $year .'-03-30'; 
            elseif($last_day == 31):
                $l_result = $year .'-03-31';
            endif;
        else:

            if($l_leap):
                $dt = new DateTime($date);
                $dt->modify('+29 days');
                $l_result = $dt->format('Y-m-d');
            else:
                $dt = new DateTime($date);
                $dt->modify('+28 days');
                $l_result = $dt->format('Y-m-d');
            endif;
        endif;
    
    elseif($month == 3 or $month == 5 or $month == 7 or $month == 8 or $month == 10 or $month == 12):
        if($month ==7 or $month == 12):
              if($last_day >= 30):
                  $l_date1 = $year .'-' .$month . '-'. $last_day ; 
                  $dt = new DateTime($l_date1);
                  $dt->modify('+31 days');
              else:
                  $l_date1 = $date ; 
                  $dt = new DateTime($l_date1);
                  $dt->modify('+31 days');
              endif;
        else:
           
              if ($last_day <= 30):
                  $l_date1 = $date ; 
                 
                  $month = intval($month) + 1;
                  $l_date1 = $year .'-' . $month . '-'. $last_day ; 
            
                  $dt = new DateTime($l_date1);
                  
               
              else:
                  
                  $l_date1 = $year .'-'.$month . '-'. '30'; 
                  $dt = new DateTime($l_date1);
                  $dt->modify('+31 days');   
              endif;     
              
        endif;
      
        $l_result = $dt->format('Y-m-d');

    elseif($month == 4 or $month == 6 or $month == 9 or $month == 11):
          if ($last_day == 31):
                $month = intval($month) + 1;
                $l_date1 = $year .'-' . $month . '-'. $last_day ; 
                $dt = new DateTime($l_date1);
                $l_result = $dt->format('Y-m-d');
          else:
                $dt = new DateTime($date);
                $dt->modify('+30 days');
                $l_result = $dt->format('Y-m-d');
          endif;
    else:
          
    endif;

    return $l_result;

}

function auto_date2($cnx2,$id, $last_day,$date) {
    $date_arr = date_parse($date);
    $year = $date_arr['year'];
    $month = $date_arr['month'];
    $day = $date_arr['day'];

    // Prepare and execute the query
    $l_sql = "SELECT c_retention, c_change_date, c_restructured, c_date_of_sale 
              FROM t_buyers_account
              WHERE c_account_no = '$id'";
    $l_qry = odbc_exec($cnx2, $l_sql);

    if (!$l_qry) {
        die('Error in SQL query: ' . odbc_errormsg($cnx2));
    }

    // Fetch results
    if ($row = odbc_fetch_array($l_qry)) {
        $change_date = $row['c_change_date'];
        $date_of_sale = $row['c_date_of_sale'];
        $day_of_sale = (int) substr($date_of_sale, 8, 2);
    }
    if ($day_of_sale == 31 && $last_day >= 28 && $change_date != 1) {
        $last_day = 31;
       
    }
    $dt = new DateTime($date);

    // Add one month
    $dt->modify('+1 month');

    // If the day is greater than the last day of the new month, adjust to the last day
    $last_day_of_new_month = $dt->format('t'); // 't' gives the last day of the month
    if ($last_day > $last_day_of_new_month) {
        $dt->setDate($dt->format('Y'), $dt->format('m'), $last_day_of_new_month);
    } else {
        $dt->setDate($dt->format('Y'), $dt->format('m'), $last_day);
    }

    return $dt->format('Y-m-d');
}



?>

<?php

function load_data($conn2,$id,$l_pay_date_val){
    
        // Query to get buyer's account details
        $query1 = "SELECT * FROM t_buyers_account WHERE c_account_no = ?";

        // Prepare and execute the statement
        $stmt1 = odbc_prepare($conn2, $query1);
        $result1 = odbc_execute($stmt1, array($id));

        if (odbc_num_rows($stmt1) <= 0) {
            echo "No record";
        } else {
            while ($row2 = odbc_fetch_array($stmt1)) {
                $l_acc_type = $row2['c_account_type'];
                $l_acc_type1 = $row2['c_account_type1'];
                $l_acc_status = $row2['c_account_status'];
                $l_net_tcp = $row2['c_net_tcp'];
                $l_pay_type1 = $row2['c_payment_type1'];
                $l_pay_type2 = $row2['c_payment_type2'];
                $l_net_dp = $row2['c_net_dp'];
                $l_num_pay = $row2['c_no_payments'];
                $l_monthly_dp = $row2['c_monthly_down'];
                $l_first_dp = $row2['c_first_dp'];
                $l_full_dp = $row2['c_full_down'];
                $l_amt_fin = $row2['c_amt_financed'];
                $l_ma_terms = $row2['c_terms'];
                $l_int_rate = $row2['c_interest_rate'];
                $l_fixed_factor = $row2['c_fixed_factor'];
                $l_monthly_ma = $row2['c_monthly_payment'];
                $l_start_date = $row2['c_start_date'];
                $l_retention = $row2['c_retention'];
                $l_change_date = $row2['c_change_date'];
                $l_restructured = $row2['c_restructured'];
                $l_date_of_sale = $row2['c_date_of_sale'];
            
            }   
        }
       // Query to get payment records
        $query = "SELECT c_account_no, c_balance, c_due_date, c_amount_paid, c_amount_due, c_status, c_status_count, c_pay_date, c_surcharge, c_principal, c_interest, c_or_no, c_rebate, c_payment_count 
        FROM t_payment
        WHERE c_account_no = ?
        ORDER BY c_payment_count";

        // Prepare and execute the statement
        $stmt = odbc_prepare($conn2, $query);
        $result = odbc_execute($stmt, array($id));
       
        if (odbc_num_rows($stmt) <= 0) {
        echo 'No Payment Records for this Account!';
        }

        // Fetch all payments data
        $payments_data = array();
        while ($row = odbc_fetch_array($stmt)) {
        $payments_data[] = $row;
        }

        // Determine the index of the last row
        $l_last = count($payments_data) - 1;

        if ($l_last >= 0) {
        $last_row = $payments_data[$l_last];
        $acc_no = $last_row['c_account_no'];

        $l_bal = $last_row['c_balance'];
        $l_last_due_date = $last_row['c_due_date'];
        $l_last_pay_date = $last_row['c_pay_date'];
        $l_last_amt_paid = $last_row['c_amount_paid'];
        $l_last_amt_due = $last_row['c_amount_due'];
        $l_last_sur = $last_row['c_surcharge'];
        $l_last_int = $last_row['c_interest'];
        $l_last_status = $last_row['c_status'];
        $l_last_stat_cnt = $last_row['c_status_count'];
        $l_last_rebate = $last_row['c_rebate'];
        $l_last_prin = $last_row['c_principal'];
        $l_last_or_no = $last_row['c_or_no'];
        $l_last_pay_cnt = $last_row['c_payment_count'];

        // Prepare array to hold all payments
        $all_payments = array();

     
        // Iterate over the payments_data array
        foreach ($payments_data as $payment) {
            if ($l_last_pay_date == $payment['c_pay_date']) {
            // Format due date
            if ($payment['c_due_date'] != '0000-00-00') {
                $l_date = strtotime($payment['c_due_date']);
                $t_due_date = date('m/d/y', $l_date);
            } else {
                $t_due_date = '';
            }
          
            // Format pay date
            if ($payment['c_pay_date'] != '0000-00-00') {
                $l_date = strtotime($payment['c_pay_date']);
                $l_last_pay_date1 = date('m/d/y', $l_date);
            } else {
                $l_last_pay_date1 = '';
            }

            // Prepare payment data
            $l_data = array(
                $t_due_date,
                $l_last_pay_date1,
                $payment['c_or_no'],
                number_format($payment['c_amount_paid'], 2),
                number_format($payment['c_amount_due'], 2),
                number_format($payment['c_interest'], 2),
                number_format($payment['c_principal'], 2),
                number_format($payment['c_surcharge'], 2),
                number_format($payment['c_rebate'], 2),
                str_replace(" ", "", $payment['c_status']),
                number_format($payment['c_balance'], 2)
            );
           
            // Add payment data to array
            $all_payments[] = $l_data;
            }
        }
        }
        if ($l_acc_status == 'Fully Paid') {
            $l_tot_amnt_due = $l_bal;
            $l_tot_principal = $l_bal;
            $l_tot_surcharge = '0.0';
            $l_tot_interest = '0.0';

            return array($all_payments, number_format($l_tot_amnt_due, 2), number_format($l_tot_interest, 2), number_format($l_tot_principal, 2), number_format($l_tot_surcharge, 2));      
        }

        $l_tot_amnt_due = 0;
        $l_tot_surcharge = 0;
        $l_tot_principal = 0;
        $l_tot_interest = 0;

        if ($l_retention == '1') {
            $l_due_date = date('Y-m-d', strtotime($l_last_due_date));
            $last_day   = date('d', strtotime($l_last_due_date));
            $t_due_date = new DateTime(auto_date($conn2,$acc_no,$last_day, $l_due_date));
            $t_due_date = $t_due_date->format('m/d/y');
            $l_data = array(
                $t_due_date,
                "----------",
                '******',
                '0.00',
                number_format($l_bal, 2),
                '0.00',
                number_format($l_bal, 2),
                '0.00',
                '0.00',
                'RETENTION',
                number_format($l_bal, 2)
                
            ); 
            array_push($all_payments, $l_data);
            $l_tot_amnt_due = $l_bal;
            $l_tot_principal = $l_bal;
            $l_tot_surcharge = '0.0';
            $l_tot_interest = '0.0';

            return array($all_payments, number_format($l_tot_amnt_due, 2), number_format($l_tot_interest, 2), number_format($l_tot_principal, 2), number_format($l_tot_surcharge, 2));      
        }

        $l_mode = 1;
        $l_date_bago = $l_start_date;
     
        while ($l_mode == 1):
            
            if (($l_pay_type1 == 'PD' && ($l_acc_status == 'Reservation' || $l_acc_status == 'Partial DownPayment')) || ($l_pay_type1 == 'FD' && $l_acc_status == 'Partial DownPayment')) {
                    $l_date = date('Y-m-d',strtotime($l_first_dp));
                    $last_day = date('d', strtotime($l_date));
                
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
                            
                
                                $l_date2 = new Datetime(auto_date($conn2,$acc_no,$last_day,$l_date));
                                $t_due_date  = $l_date2->format('m/d/y');
                                $l_due_date_val = $l_date2;
                                $l_count = $l_last_stat_cnt + 1;
                        else:

                                $l_date2 = new DateTime($l_date);
                                $t_due_date  = $l_date2->format('m/d/y');
                                $l_due_date_val = $l_date2;
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
                                        if ($l_last_status == $payments_data[$x]['c_status'] && $l_last_due_date == $payments_data[$x]['c_due_date']) {
                                            $l_last_tot_prin += $payments_data[$x]['c_principal'];
                                            $l_last_tot_surcharge += $payments_data[$x]['c_surcharge'];
                                            if ($l_last_amt_paid < $payments_data[$x]['c_surcharge']) {
                                                $l_tot_surcharge += ($l_last_tot_surcharge - $l_last_amt_paid);
                                            } 
                                            elseif ($l_last_amt_paid == $payments_data[$x]['c_surcharge']) {
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
                                    $l_due_date_val = new Datetime(date('Y-m-d',($l_date)));
                                    $l_new_due_date_val = date('Y-m-d',strtotime($l_last_due_date));
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
                                
                                $l_date2 = new Datetime(auto_date($conn2,$acc_no,$last_day,$l_date));
                          
                                $l_due_date_val = $l_date2;
                                $l_new_due_date_val = $l_due_date_val;
                                $t_due_date =  $l_date2->format('m/d/y');
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
                    $l_principal_amt = floatval(str_replace(',', '',$l_principal));
                    $l_new_bal = $l_bal - $l_principal_amt;
                    $l_new_bal = number_format($l_new_bal,2);

            

            }elseif ($l_pay_type1 == 'SC' && $l_acc_status == 'Reservation') {
            
                $l_date = date('Y-m-d',strtotime($l_start_date));   
                $l_date2 = new Datetime($l_date);               
                $t_due_date = $l_date2->format('m/d/y');
                $l_due_date_val =  new DateTime($l_date);
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
                $l_principal_amt = floatval(str_replace(',', '',$l_principal));
                $l_new_bal =  $l_bal - $l_principal_amt;
                $l_new_bal = number_format($l_new_bal,2) ;

            }elseif ($l_pay_type1 == 'FD' && $l_acc_status == 'Reservation') {
                $l_date = date('Y-m-d', strtotime($l_full_dp));
                $l_date2 = new Datetime($l_date);
                $t_due_date = $l_date2->format('m/d/y');
                $l_due_date_val =  new DateTime($l_date);
                $l_new_due_date_val = $l_due_date_val;
                $l_status = 'FD';
                $l_monthly_pay = $l_net_dp;
                $l_amt_due = number_format($l_net_dp,2);
                $l_rebate = '0.00';
                $l_interest = '0.00';
                $l_principal = $l_amt_due;
                $l_count = 0;
                $l_acc_status = 'Full DownPayment';
                $l_principal_amt = floatval(str_replace(',', '',$l_principal));
                $l_new_bal =  $l_bal - $l_principal_amt;
                $l_new_bal = number_format($l_new_bal,2) ;
                $l_date_bago = $l_start_date;

            }elseif (($l_acc_status == 'Full DownPayment' && $l_pay_type2 == 'DFC') || ($l_pay_type1 == 'ND' && $l_pay_type2 == 'DFC') || $l_acc_status == 'Deferred Cash Payment') {
                $l_date =  date('Y-m-d', strtotime($l_start_date));
                $last_day = date('d', strtotime($l_date));
                $l_monthly_pay = $l_monthly_ma;  
            
                $l_fpd = $l_bal;
                if ($l_bal <= $l_monthly_pay):
                        $l_fp_mode = 1;
                else:
                        $l_fp_mode = 0;

                        if ($l_date_bago == $l_full_dp) {
                        

                
                        $l_due_date_val_old = new Datetime(auto_date($conn2,$acc_no,$last_day,$l_date));
                        $l_date_old = $l_due_date_val_old->format('m/d/y');
                        $l_date_bago = $l_date_old;
                        }
                endif;
                if ($l_acc_status == 'Full DownPayment' || $l_acc_status == 'Reservation' || $l_last_status == 'RESTRUCTURED' || $l_last_status == 'RECOMPUTED' || $l_last_status == 'ADDITIONAL') {
                        
                    
                        if ($l_last_status == 'ADDITIONAL' && $l_acc_status != 'Full DownPayment'):
                            $l_date = date('Y-m-d', strtotime($l_last_due_date));
                            if ($l_change_date == '1'):
                                    $l_date = date('Y-m-d',strtotime($l_start_date));
                            endif;
                            
                        
                            
                            $l_date2 = new Datetime(auto_date($conn2,$acc_no,$last_day,$l_date));
                            $l_due_date_val = $l_date2;
                            $l_date = $l_date2;
                            $t_due_date = $l_date->format('m/d/y');
                            $l_count = $l_last_stat_cnt + 1;
                        else:
                            $l_date2 = new Datetime($l_date);
                            $t_due_date = $l_date2->format('m/d/y');
                            $l_due_date_val = new DateTime($l_date);
                            $l_count = 1;
                        endif;

                        if ($l_ma_terms == $l_count || $l_fp_mode == 1):
                            $l_acc_status = 'Fully Paid';
                            $l_status = 'FPD';
                            $l_mode = 0;
                            $l_monthly_pay = $l_fpd;
                        else:
                            $l_status = 'DFC-' . strval($l_count);
                            $l_acc_status = 'Deferred Cash Payment';
                        endif;
                    $l_new_due_date_val = $l_due_date_val;
                    $l_amt_due = number_format($l_monthly_pay,2);
                    $l_principal = $l_amt_due;
                }elseif ($l_acc_status == 'Deferred Cash Payment') {
                        $l_date = date('Y-m-d', strtotime($l_last_due_date));
                    
                        if ($l_change_date == '1'):
                            $l_date = date('Y-m-d', strtotime($l_start_date));
                        endif;
                    
                        if ($l_last_amt_paid < $l_last_amt_due):
                    
                            $l_last_tot_surcharge = 0;
                            $l_last_tot_prin = 0;

                            for ($x=0; $x<=$l_last; $x++) {
                                    try {
                                    if ($l_last_status == $payments_data[$x]['c_status'] && $l_last_due_date == $payments_data[$x]['c_due_date']) {
                                    $l_last_tot_prin += $payments_data[$x]['c_principal'];
                                    $l_last_tot_surcharge += $payments_data[$x]['c_surcharge'];
                                    if ($l_last_amt_paid < $payments_data[$x]['c_surcharge']) {
                                    $l_tot_surcharge += ($l_last_tot_surcharge - $l_last_amt_paid);
                                    }
                            
                                    }
                                    } catch (Exception $e) {
                                    // do nothing
                                    }
                                    }
                            if (date('Y-m-d', strtotime($l_last_pay_date)) > date('Y-m-d', strtotime($l_last_due_date))):
                                $l_date = date('Y-m-d', strtotime($l_last_pay_date));
                            else:
                                $l_date = date('Y-m-d', strtotime($l_last_due_date));
                            endif;

                            $l_monthly_pay =  $l_monthly_pay - $l_last_tot_prin;
                            $l_monthly = $l_last_amt_due - $l_last_amt_paid;
                            $l_count = $l_last_stat_cnt;
                            $l_due_date_val = new Datetime($l_date);
                            $l_new_due_date_val = new Datetime($l_last_due_date);
                            $l_amt_due = number_format($l_monthly,2);
                        
                            if ($l_last_tot_prin == 0 && $l_last_tot_surcharge > 0):
                                $l_principal = number_format($l_monthly_ma,2);
                            else:
                                $l_principal = $l_amt_due;
                            endif;
                        
                            if ($l_ma_terms == $l_count || $l_fp_mode == 1):
                                $l_tot_amnt_due += $l_tot_surcharge;
                                $l_status = 'FPD';
                                $l_monthly_pay = $l_fpd;
                                $l_amt_due = number_format($l_monthly_pay,2);
                                $l_acc_status = 'Fully Paid';
                                $l_mode = 0;
                            else:
                                $l_status = 'DFC-' . strval($l_count);
                                $l_acc_status = 'Deferred Cash Payment';
                            endif;  
                        
                        else:
                            $l_date2 = new Datetime(auto_date($conn2,$acc_no,$last_day,$l_date));
                  
                            $l_due_date_val = $l_date2;
                            $l_new_due_date_val = $l_due_date_val;
               
                            $t_due_date = $l_date2->format('m/d/y');
                            $l_count = $l_last_stat_cnt + 1;
                            
                            $l_amt_due = number_format($l_monthly_pay,2);
                            
                            if ($l_ma_terms == $l_count || $l_fp_mode == 1) {
                                    $l_status = 'FPD';
                                    $l_monthly_pay = $l_fpd;
                                    $l_amt_due = number_format($l_monthly_pay,2);
                                    $l_acc_status = 'Fully Paid';
                                    $l_mode = 0;
                            } else {
                                    $l_status = 'DFC-' . strval($l_count);
                                    $l_acc_status = 'Deferred Cash Payment';
                            }
                            $l_principal = $l_amt_due;

                        endif;
                }
                $l_rebate = '0.00';
                $l_interest = '0.00';

                $l_principal_amt = floatval(str_replace(',', '',$l_principal));
                $l_new_bal =  $l_bal - $l_principal_amt;
                $l_new_bal = number_format($l_new_bal,2);


            }elseif (($l_acc_status == 'Full DownPayment' && $l_pay_type2 == 'MA') || ($l_pay_type1 == 'ND' && $l_pay_type2 == 'MA') || $l_acc_status == 'Monthly Amortization') {
                $l_date = date('Y-m-d', strtotime($l_start_date));
                $last_day = date('d', strtotime($l_date));
                $l_monthly_pay = $l_monthly_ma;
            
                if ($l_date_bago == $l_full_dp):
                    $l_due_date_val_old = new Datetime(auto_date($conn2,$acc_no,$last_day,$l_date));
                    $l_date_old =$l_due_date_val_old;
                    
                    $l_date_bago = $l_date_old->format('Y-m-d');
                endif;

                if ($l_acc_status == 'Full DownPayment' || $l_acc_status == 'Reservation' || $l_last_status == 'RESTRUCTURED' || $l_last_status == 'RECOMPUTED' || $l_last_status == 'ADDITIONAL') {
                    if ($l_last_status == 'ADDITIONAL' && $l_acc_status != 'Full DownPayment'):
                            $l_date = date('Y-m-d', strtotime($l_last_due_date));
                        
                            if ($l_change_date == '1'):  
                                $l_date = date('Y-m-d', strtotime($l_start_date));  
                            endif;
                            $l_date2 = new Datetime(auto_date($conn2,$acc_no,$last_day,$l_date));
                          
                            $l_due_date_val = $l_date2;
                            $t_due_date = $l_date2->format('m/d/y');
                            $l_count = $l_last_stat_cnt + 1;
                    else:
                            $l_due_date = new Datetime($l_date);
                            $t_due_date = $l_due_date->format('m/d/y');
                            $l_due_date_val = $l_due_date;
                            $l_count = 1;
                    endif;
                    $l_interest = $l_bal * ($l_int_rate / 1200);
                    $l_principal = $l_monthly_pay - $l_interest;
                    if ($l_bal <= $l_principal || $l_ma_terms == $l_count):
                        $l_monthly_pay = $l_bal + $l_interest;
                        $l_acc_status = 'Fully Paid';
                        $l_status = 'FPD';
                        $l_mode = 0;
                        $l_principal = $l_bal;
                    
                    else:
                        $l_status = 'MA-' . strval($l_count);
                        $l_acc_status = 'Monthly Amortization';
                    endif;

                    $l_new_due_date_val = $l_due_date_val;
                    $l_amt_due = number_format($l_monthly_pay,2);
                    
                }elseif (($l_acc_status == 'Monthly Amortization')) {
                      
                        $l_date = date('Y-m-d', strtotime($l_last_due_date));
                        if ($l_change_date == '1') :
                            $l_date = date('Y-m-d', strtotime($l_start_date));
                        endif;

                        if ($l_last_amt_paid < $l_last_amt_due) {
                            // $l_underpay = 1;
                            $l_last_tot_surcharge = 0;
                            $l_last_tot_prin = 0;
                            $l_last_tot_int = 0;
                            $x_y = $l_last;
                            $l_cnt = 0;
                            $l_tot_int = 0;


                            while ($l_last_status == $payments_data[$x_y]['c_status']){
                                    $l_last_interest = $payments_data[$x_y-1]['c_balance'] * ($l_int_rate/1200);
                                    $l_last_tot_prin += $payments_data[$x_y]['c_principal'];
                                    $l_tot_int += $payments_data[$x_y]['c_interest'];
                                    $x_y -= 1;
                                    $l_cnt += 1;
                        
                                    $l_int_last = $l_last_interest - $l_tot_int;

                                    }

                            if ($l_cnt > 1):
                                $l_monthly_pay = $l_monthly_pay - $l_last_tot_prin - $l_last_tot_int;
                            
                            else:
                                $l_last_tot_prin = 0;
                                $l_monthly_pay = $l_monthly_pay - $l_last_tot_int;
                            endif;

                            if ($l_cnt < 2):
                                    for ($x = 0; $x <= $l_last; $x++) {
                                        try {
                                             
                                            if ($l_last_status == $payments_data[$x]['c_status'] && $l_last_due_date == $payments_data[$x]['c_balance']) {
                                                $l_last_tot_prin += $payments_data[$x]['c_principal'];
                                                $l_last_tot_surcharge += $payments_data[$x]['c_surcharge'];
                                                if ($l_last_amt_paid < $payments_data[$x]['c_surcharge']):
                                                    $l_tot_surcharge += ($l_last_tot_surcharge - $l_last_amt_paid);
                                                endif;
                                        
                                                $l_last_tot_int += $payments_data[$x]['c_interest'];
                                            }
                                        } catch (Exception $e) {
                                            // Do nothing
                                        }
                                    }
                                    $l_monthly_pay = $l_monthly_pay - $l_last_tot_prin - $l_last_tot_int;

                            else:
                                    $l_monthly_pay = $l_last_amt_due - $l_last_amt_paid;
                            endif;

                            $l_ma_balance = $l_bal + $l_last_tot_prin;
                            if (strtotime($l_last_pay_date) > strtotime($l_last_due_date)):
                                    $l_date =  date('Y-m-d', strtotime($l_last_pay_date));
                            else:
                                    $l_date =  date('Y-m-d', strtotime($l_last_due_date));
                            endif;


                            if ($l_cnt >= 1):
                                $l_interest = $l_int_last;
                            else:
                                $l_interest = $l_ma_balance * ($l_int_rate / 1200);
                            endif;

                            
                            $l_monthly = $l_last_amt_due - $l_last_amt_paid;
                            if ($l_last_tot_int < $l_last_interest):
                                if ($l_last_tot_int > 0):
                                    $l_interest = $l_last_interest - $l_last_tot_int;
                                endif;
                                if ($l_last_interest == $l_tot_int):
                                    $l_interest = 0.00;
                                endif;
                            else:
                                $l_interest = 0.00;
                            endif;


                            if ($l_cnt > 1):
                                    $l_principal = $l_monthly_ma - $l_last_interest - $l_last_tot_prin;
                            elseif ($l_cnt == 1):
                                    if ($l_last_interest >= $l_interest):
                                        $l_principal = $l_monthly_ma - $l_last_interest - $l_last_tot_prin;

                                        if ($l_last_tot_surcharge == 0 || $l_tot_int > 0):
                                                $l_monthly_pay = $l_monthly;
                                        else:
                                                $l_monthly_pay = $l_monthly_ma;

                                        endif;

                                        
                                    else:
                                        $l_principal = $l_monthly;
                                        $l_monthly_pay = $l_monthly;
                                    endif;
                            else:
                                    $l_principal = $l_monthly_pay - $l_interest;
                            endif;
                            $l_count = $l_last_stat_cnt;
                           
                            $l_due_date_val = new Datetime($l_date);
                            $l_new_due_date_val = new Datetime($l_last_due_date);
                          
                            $l_amt_due = number_format($l_monthly,2);
                            if ($l_bal <= $l_principal || $l_ma_terms == $l_count):
                                $l_tot_amnt_due += $l_tot_surcharge;
                                $l_monthly_pay = $l_bal + $l_interest;
                                $l_acc_status = 'Fully Paid';
                                $l_status = 'FPD';
                                $l_mode = 0;
                                $l_amt_due = number_format($l_monthly_pay,2);
                                $l_principal = $l_bal;
                            else:
                                $l_status = 'MA-' . strval($l_count);
                                $l_acc_status = 'Monthly Amortization';
                                $l_amt_due = number_format($l_monthly,2);
                            endif;
                    
                            
                        }else{
                            
                            $l_date2 = new Datetime(auto_date($conn2,$acc_no,$last_day,$l_date));
                           
                            $l_due_date_val = $l_date2;
                            $l_new_due_date_val = $l_due_date_val;
                            $t_due_date = $l_date2->format('m/d/y');
                            $l_count = $l_last_stat_cnt + 1;
                            $l_interest = $l_bal * ($l_int_rate/1200);
                            $l_principal = $l_monthly_pay - $l_interest;
                        
                            if ($l_bal <= $l_principal || $l_ma_terms == $l_count):
                                    $l_monthly_pay = $l_bal + $l_interest;
                                    $l_acc_status = 'Fully Paid';
                                    $l_status = 'FPD';
                                    $l_mode = 0;
                                    $l_amt_due = number_format($l_monthly_pay,2);
                                    $l_principal = $l_bal;
                            else:
                                    $l_status = 'MA-' . strval($l_count);
                                    $l_acc_status = 'Monthly Amortization';
                                    $l_amt_due = number_format($l_monthly_pay,2);
                            endif;
                            
                        }         
                    }
                $l_pay_date_value = new Datetime($l_pay_date_val);
                
                if ($l_pay_date_value < $l_due_date_val) {
                    $interval = $l_pay_date_value->diff($l_due_date_val);
                    $l_days = $interval->days;
                    
                    if ($l_int_rate == 12){
                            $l_rebate_value = 0.02;
                    }else if ($l_int_rate == 14){
                            $l_rebate_value = 0.0225;
                    }else if ($l_int_rate == 15){
                            $l_rebate_value = 0.0225;
                    } else if ($l_int_rate == 16){
                            $l_rebate_value = 0.025;
                    } else if ($l_int_rate == 17){
                            $l_rebate_value = 0.025;
                    } else if ($l_int_rate == 18){
                            $l_rebate_value = 0.025;
                    }else if ($l_int_rate == 19){
                            $l_rebate_value = 0.025;
                    }else if ($l_int_rate == 20){
                            $l_rebate_value = 0.025;
                    }else if ($l_int_rate == 21){
                            $l_rebate_value = 0.025;
                    } else if ($l_int_rate == 22){
                            $l_rebate_value = 0.0275;
                    } else if ($l_int_rate == 23){
                            $l_rebate_value = 0.0275;
                    }else if ($l_int_rate == 24){
                            $l_rebate_value = 0.03;
                    }else{
                            $l_rebate_value = 0;
                    }
                    if ($l_days > 2) {
                        $l_rebate = number_format($l_monthly_pay * $l_rebate_value,2);
                        } else {
                        $l_rebate = 0;
                        }
                    }else{
                    $l_rebate = '0.00';
                }
                    $l_amt_due = number_format(floatval(str_replace(',', '',$l_amt_due)) - floatval(str_replace(',', '',$l_rebate)),2);
                    $l_principal = number_format($l_principal,2);
                    $l_interest = number_format($l_interest,2);
                    $l_new_bal = number_format($l_bal - (floatval(str_replace(',', '',($l_principal))) - floatval(str_replace(',', '',$l_rebate))),2);


            }else{
                    
                
                    $total_amount_due_ent =($l_tot_amnt_due);
                    $total_principal_ent = ($l_tot_principal);
                    $total_surcharge_ent = ($l_tot_surcharge);
                    $total_interest_ent = ($l_tot_interest);
                    return;
            }
            $l_pay_date_value = new Datetime($l_pay_date_val);
       

            if ($l_pay_date_value > $l_due_date_val && floatval($l_rebate) == 0) {
                
                $interval = $l_pay_date_value->diff($l_due_date_val);
                $l_days = $interval->days;
                $l_sur =$l_monthly_pay * (0.6/360) * $l_days;
                $l_surcharge =  number_format($l_sur,2);
                $l_amt_due = floatval(str_replace(',', '',$l_amt_due)) + $l_sur;
                $l_amt_due = number_format($l_amt_due,2);
            } else {
            
                $l_surcharge = '0.00';
            }

            $l_bal = floatval(str_replace(',', '',$l_new_bal));
            $l_data = array($t_due_date,"----------","******",'0.00',$l_amt_due,$l_interest,$l_principal,$l_surcharge,$l_rebate,$l_status,$l_new_bal);

            array_push($all_payments, $l_data);

            $l_tot_amnt_due += floatval(str_replace(',', '',$l_amt_due));
            $l_tot_surcharge += floatval(str_replace(',', '',$l_surcharge));
            $l_tot_principal += floatval(str_replace(',', '',$l_principal));
            $l_tot_interest += floatval(str_replace(',', '',$l_interest));
            $l_interest = 0.00;
            $l_surcharge = 0.00;
            $l_rebate = 0.00;



            $l_last_due_date =  $t_due_date; 
            $l_last_amt_paid = floatval(str_replace(',', '',$l_amt_due));
            $l_last_amt_due = floatval(str_replace(',', '',$l_amt_due));
            $l_last_status = $l_status;
            $l_last_stat_cnt = $l_count;



            
           
            $l_due_date_value =  new Datetime(auto_date($conn2,$acc_no,$last_day,$l_last_due_date));  
          
          
            $l_due_date_val = $l_due_date_value->format('Y-m-d');
            
            if ($l_mode == 1 && $l_due_date_value > $l_pay_date_value):
                if ($l_date_bago != $l_full_dp):
                    $l_mode = 0;
                else:
                    $l_mode = 1;
                endif;

            endif;


        endwhile;	

        return array($all_payments, number_format($l_tot_amnt_due,2), number_format($l_tot_interest,2), number_format($l_tot_principal,2), number_format($l_tot_surcharge,2));      


}


?>