<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php

function is_leap_year($year) {
  return date('L', strtotime("$year-01-01"));
}



function validate_date($year,$month,$day){
    if (($month == 1) || ($month == 6) || ($month == 9) || ($month == 11)):
        if ($day == 31):
            $l_new_day = '30';
        else:
            $l_new_day = $day;
        endif;
    elseif ($month == 2):
        if ($day > 28):
            $l_leap = is_leap_year($year);

            if ($l_leap):
                $l_new_day = '28';
            else:
                $l_new_day = '29';
            endif;

        else:
            $l_new_day = $day;
        endif;

    else:
        $l_new_day = $day;


    endif;


    return $l_new_day;

}

function auto_date($last_day,$date)
  {
   
    $date_arr = date_parse($date);

    $year = $date_arr['year'];
    $month = $date_arr['month'];
    $day = $date_arr['day'];
    /* $change_date = 0; */
    $conn = mysqli_connect('localhost', 'root', '', 'alscdb');
    if (!$conn) {
        die('Could not connect to database: ' . mysqli_connect_error());
    }
    $l_col = "c_retention,c_change_date,c_restructured,c_date_of_sale";
    $l_sql = sprintf("SELECT %s FROM properties WHERE md5(property_id) = '{$_GET['id']}' ", $l_col);
    $l_qry = $conn->query($l_sql);
    
    while($row=$l_qry->fetch_assoc()):
        $l_retention = $row['c_retention'];
        $change_date = $row['c_change_date'];
        $restructured = $row['c_restructured'];
        $date_of_sale = $row['c_date_of_sale'];
    endwhile;

    $l_leap = is_leap_year($year);

    if($date_of_sale == 31 && $last_day >= 28 && $change_date != 1){
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
              else:
                  $l_date1 = $date ; 
              endif;
              $dt = new DateTime($l_date1);
              $dt->modify('+31 days');
              $l_result = $dt->format('Y-m-d');

        else:
              if ($last_day <= 30):
                  $l_date1 = $date ;            
              else:
                  $l_date1 = $year .'-'.$month . '-'. '30';         
              endif;     
              $dt = new DateTime($l_date1);
              $dt->modify('+31 days');
              $l_result = $dt->format('Y-m-d');
        endif;

    elseif($month == 4 or $month == 6 or $month == 9 or $month == 11):
          if ($last_day == 31):
                $dt = new DateTime($date);
                $dt->modify('+1 month');
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

  function load_data($id,$pay_date){
    $conn = mysqli_connect('localhost', 'root', '', 'alscdb');
    if (!$conn) {
        die('Could not connect to database: ' . mysqli_connect_error());
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
    
        $last_day = 0;
        $l_x = $l_ma_terms - 1;
        $end = new DateTime($pay_date);
        /* $end->modify("+{$l_x} month"); */
        $l_pay_date_val = $end->format('Y-m-d');
        //$l_pay_date_val = '2023-12-31';


        endwhile;
    $payments = $conn->query("SELECT remaining_balance, due_date, payment_amount, amount_due, status, status_count, pay_date, surcharge, principal, interest, or_no, rebate, payment_count FROM property_payments WHERE md5(property_id) = '{$_GET['id']}' ORDER by due_date, pay_date, payment_count, remaining_balance DESC");
    $l_last = $payments->num_rows - 1;
    if($payments->num_rows <= 0){
        echo ('No Payment Records for this Account!');
    } 
    $l_last = $payments->num_rows - 1;


    $payments_data = array(); 
 /*  $count = 1; */
    while($row = $payments->fetch_assoc()) {
        $payments_data[] = $row; 

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
              $t_due_date = date('m/d/y', $l_date);
              
          }
          else{
              $t_due_date = '';
          }
          if ($payments_data[$x]['pay_date'] != 0){
              $l_date = strtotime($payments_data[$x]['pay_date']);
              $l_last_pay_date1 =  date('m/d/y', $l_date);
          }
          else{
              $l_last_pay_date1 = '';
          }
        $l_data = array($t_due_date, $l_last_pay_date1, $payments_data[$x]['or_no'], number_format($payments_data[$x]['payment_amount'],2), 
        number_format($payments_data[$x]['amount_due'],2), number_format($payments_data[$x]['interest'],2), 
        number_format($payments_data[$x]['principal'],2), number_format($payments_data[$x]['surcharge'],2), number_format($payments_data[$x]['rebate'],2), 
        str_replace(" ", "", $payments_data[$x]['status']), number_format($payments_data[$x]['remaining_balance'],2));
        array_push($all_payments, $l_data);
        
      endif;
      }
        
    if ($l_acc_status == 'Fully Paid'):
      
       
        $l_tot_amnt_due = $l_bal;
        $l_tot_principal = $l_bal;
        $l_tot_surcharge = ('0.0');
        $l_tot_interest = ('0.0');

        
        return array($all_payments, number_format($l_tot_amnt_due,2), number_format($l_tot_interest,2), number_format($l_tot_principal,2), number_format($l_tot_surcharge,2));      



        endif;
    $l_tot_amnt_due = 0;
    $l_tot_surcharge = 0;
    $l_tot_principal = 0;
    $l_tot_interest = 0;


    if ($l_retention == '1') {
        $l_due_date = date('Y-m-d',strtotime($l_last_due_date));
        $last_day   = date('d', strtotime($l_last_due_date));
        $t_due_date = new Datetime(auto_date($last_day,$l_due_date));
        $t_due_date = $t_due_date->format('m/d/y');
        $l_data = array($t_due_date,"----------",'******','0.00',number_format($l_bal,2),'0.00',number_format($l_bal,2),'0.00','0.00','RETENTION',number_format($l_bal,2));
        array_push($all_payments, $l_data);
      
        $l_tot_amnt_due = $l_bal;
        $l_tot_principal = $l_bal;
        $l_tot_surcharge = ('0.0');
        $l_tot_interest = ('0.0');

        return array($all_payments, number_format($l_tot_amnt_due,2), number_format($l_tot_interest,2), number_format($l_tot_principal,2), number_format($l_tot_surcharge,2));      

    }

    $l_mode = 1;
    $l_date_bago = $l_start_date; 
    while ($l_mode == 1):
          if (($l_pay_type1 == 'Partial DownPayment' && ($l_acc_status == 'Reservation' || $l_acc_status == 'Partial DownPayment')) || ($l_pay_type1 == 'Full DownPayment' && $l_acc_status == 'Partial DownPayment')) {
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
                            
                            
                              //$l_date2 =add($l_date,1);
                            
                              $l_date2 = new Datetime(auto_date($last_day,$l_date));
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
                      /*  $l_new_due_date_val = $t_due_date; */
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
                        //echo $payments_data[2]['status'];
                       // echo $l_last_status;
                        //echo $l_last;
                        if ($l_last_amt_paid < $l_last_amt_due):
                                  $l_last_tot_surcharge = 0;
                                  $l_last_tot_prin = 0;

                                  for ($x = 0; $x <= $l_last; $x++) {
                                    try {
                                      if ($l_last_status == $payments_data[$x]['status'] && $l_last_due_date == $payments_data[$x]['due_date']) {
                                          $l_last_tot_prin += $payments_data[$x]['principal'];
                                          $l_last_tot_surcharge += $payments_data[$x]['surcharge'];
                                          if ($l_last_amt_paid < $payments_data[$x]['surcharge']) {
                                                $l_tot_surcharge += ($l_last_tot_surcharge - $l_last_amt_paid);
                                          } 
                                          elseif ($l_last_amt_paid == $payments_data[$x]['surcharge']) {
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
                                
                                $l_date2 = new Datetime(auto_date($last_day,$l_date));
                                /* $l_date2 = add($l_date,1); */
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
      
            

          }elseif ($l_pay_type1 == 'Spot Cash' && $l_acc_status == 'Reservation') {
            
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

          }elseif ($l_pay_type1 == 'Full DownPayment' && $l_acc_status == 'Reservation') {
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

          }elseif (($l_acc_status == 'Full DownPayment' && $l_pay_type2 == 'Deferred Cash Payment') || ($l_pay_type1 == 'No DownPayment' && $l_pay_type2 == 'Deferred Cash Payment') || $l_acc_status == 'Deferred Cash Payment') {
                $l_date =  date('Y-m-d', strtotime($l_start_date));
                $last_day = date('d', strtotime($l_date));
                $l_monthly_pay = $l_monthly_ma;  
            
                $l_fpd = $l_bal;
                if ($l_bal <= $l_monthly_pay):
                      $l_fp_mode = 1;
                else:
                      $l_fp_mode = 0;

                      if ($l_date_bago == $l_full_dp) {
                      

                        
                        //$l_due_date_val_old = add($l_date,1);
                        $l_due_date_val_old = new Datetime(auto_date($last_day,$l_date));
                        $l_date_old = $l_due_date_val_old->format('m/d/y');
                        $l_date_bago = $l_date_old->format('Y-m-d');
                      }
                endif;
                if ($l_acc_status == 'Full DownPayment' || $l_acc_status == 'Reservation' || $l_last_status == 'RESTRUCTURED' || $l_last_status == 'RECOMPUTED' || $l_last_status == 'ADDITIONAL') {
                      if ($l_last_status == 'ADDITIONAL' && $l_acc_status != 'Full DownPayment'):
                            $l_date = date('Y-m-d', strtotime($l_last_due_date));
                            if ($l_change_date == '1'):
                                  $l_date = date('Y-m-d',strtotime($l_start_date));
                            endif;
                          
                            //$l_date2 = add($l_date,1);
                          
                            $l_date2 = new Datetime(auto_date($last_day,$l_date));
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
                                  if ($l_last_status == $payments_data[$x]['status'] && $l_last_due_date == $payments_data[$x]['due_date']) {
                                  $l_last_tot_prin += $payments_data[$x]['principal'];
                                  $l_last_tot_surcharge += $payments_data[$x]['surcharge'];
                                  if ($l_last_amt_paid < $payments_data[$x]['surcharge']) {
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
                            $l_date2 = new Datetime(auto_date($last_day,$l_date));
                            //$l_date2 = add($l_date,1);
                            $l_due_date_val = $l_date2;
                            $l_new_due_date_val = $l_due_date_val;
                            //$l_date = new Datetime ($l_date);
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


        }elseif (($l_acc_status == 'Full DownPayment' && $l_pay_type2 == 'Monthly Amortization') || ($l_pay_type1 == 'No DownPayment' && $l_pay_type2 == 'Monthly Amortization') || $l_acc_status == 'Monthly Amortization') {
                $l_date = date('Y-m-d', strtotime($l_start_date));
                $last_day = date('d', strtotime($l_date));
                $l_monthly_pay = $l_monthly_ma;
            
                if ($l_date_bago == $l_full_dp):
                    $l_due_date_val_old = new Datetime(auto_date($last_day,$l_date));
                    $l_date_old =$l_due_date_val_old;
                  
                    $l_date_bago = $l_date_old->format('Y-m-d');
                endif;

                if ($l_acc_status == 'Full DownPayment' || $l_acc_status == 'Reservation' || $l_last_status == 'RESTRUCTURED' || $l_last_status == 'RECOMPUTED' || $l_last_status == 'ADDITIONAL') {
                    if ($l_last_status == 'ADDITIONAL' && $l_acc_status != 'Full DownPayment'):
                          $l_date = date('Y-m-d', strtotime($l_last_due_date));
                        
                          if ($l_change_date == '1'):  
                              $l_date = date('Y-m-d', strtotime($l_start_date));  
                          endif;
                          $l_date2 = new Datetime(auto_date($last_day,$l_date));
                          //$l_date2 = add($l_date, 1);
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


                            while ($l_last_status == $payments_data[$x_y]['status']){
                                    $l_last_interest = $payments_data[$x_y-1]['remaining_balance'] * ($l_int_rate/1200);
                                    $l_last_tot_prin += $payments_data[$x_y]['principal'];
                                    $l_tot_int += $payments_data[$x_y]['interest'];
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
                                          if ($l_last_status == $payments_data[$x]['status'] && $l_last_due_date == $payments_data[$x]['remaining_balance']) {
                                              $l_last_tot_prin += $payments_data[$x]['principal'];
                                              $l_last_tot_surcharge += $payments_data[$x]['surcharge'];
                                              if ($l_last_amt_paid < $payments_data[$x]['surcharge']):
                                                  $l_tot_surcharge += ($l_last_tot_surcharge - $l_last_amt_paid);
                                              endif;
                                        
                                              $l_last_tot_int += $payments_data[$x]['interest'];
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
                                    $_interest = $l_last_interest - $l_last_tot_int;
                                endif;
                                if ($l_last_interest == $l_tot_int):
                                    $_interest = 0.00;
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
                        $l_date2 = new Datetime(auto_date($last_day,$l_date));
                        //$l_date2 = add($l_date, 1);
                        $l_due_date_val = $l_date2;
                        $l_new_due_date_val = $l_due_date_val;
                        $t_due_date = $l_date2->format('m/d/y');
                        $l_count = $l_last_stat_cnt + 1;
                        $l_interest = $l_bal * ($l_int_rate/1200);
                        $l_principal = $l_monthly_pay - $l_interest;
                      /*   echo $l_monthly_pay;
                        echo $l_interest; */
                      /*  echo $l_principal; */
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
            //echo $l_pay_date_value ;
              //echo $l_int_rate;
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
                      //echo $l_days;
                      if ($l_days > 2) {
                        $l_rebate = number_format($l_monthly_pay * $l_rebate_value,2);
                      } else {
                        $l_rebate = 0;
                      }
                  }else{ 
                  $l_rebate = 0;
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
        //echo $l_pay_date_val;
        // echo '|';
       //$l_due_date_val = $t_due_date->format('m/d/y');
    
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



     
        //$l_new_date = date('Y-m-d',strtotime($l_new_due_date_val));
        /* $l_due_date_value =  new Datetime(auto_date($last_day,$l_date));   */
        $l_due_date_value =  new Datetime(auto_date($last_day,$l_last_due_date));  
        //$l_due_date_val = add($l_last_due_date, 1);
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

if (isset($_POST['property_id']) && isset($_POST['pay_date'])) {
    $property_id = $_POST['property_id'];
    $pay_date = $_POST['pay_date'];

    // Perform your logic here and prepare your response
    $response = array(
        'success' => true,
        'message' => 'Payment date checked successfully',
        'data' => array(
            'property_id' => $property_id,
            'pay_date' => $pay_date
        )
    );

    // Convert the response data to JSON format
    $json_response = json_encode($response);

    // Set the content type header to JSON
    header('Content-Type: application/json');

    // Send the JSON response back to the client
    echo $json_response;
    exit;
}



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

        $last_stat_count = $last_payment['status_count'];
        $last_pay_count = $last_payment['payment_count'];
        //code start here 

        
        if($acc_status == 'Fully Paid'):
            $amount_ent = '';
            $amount_paid_ent = '';
            $surcharge_ent = '';
            $rebate_ent = '';
            $total_amount_due_ent = '';
            $due_date_ent = '';
            $payment_status_ent = '';
            return ;
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
                            $amount_paid_ent = (numbe_format($last_payment['remaining_balance'],2));
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

<div class="card card-outline rounded-0 card-maroon">
    
	<div class="card-header">
	<h3 class="card-title"><b>Property ID #: <i><?php echo $prop_id ?></i> </b></h3>
	</div>
	<div class="card-body">
    <div class="container-fluid">




        <table class="table2 table-bordered table-stripped">
            PAYMENT RECORD
                    <?php $qry4 = $conn->query("SELECT * FROM property_payments where md5(property_id) = '{$_GET['id']}' ORDER by due_date, pay_date, payment_count, remaining_balance DESC");
                     if($qry4->num_rows <= 0){
                           echo "No Payment Records";
                     }else{  ?>      
   
                      <thead> 
                          <tr>
                            <!--   <th style="text-align:center;font-size:13px;">PROPERTY ID</th> -->
                              <th style="text-align:center;font-size:13px;">DUE DATE</th>
                              <th style="text-align:center;font-size:13px;">PAY DATE</th>
                              <th style="text-align:center;font-size:13px;">SI NO</th>
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
<br><br>
<table class="table2 table-bordered table-stripped">
            PAYMENT RECORD TO INSERT<br>
                    <?php $qry4 = $conn->query("SELECT * FROM t_invoice where md5(property_id) = '{$_GET['id']}' ORDER by due_date, pay_date, payment_count, remaining_balance DESC");
                     if($qry4->num_rows <= 0){
                           echo "No Payment Records";
                     }else{  ?>      
   
                      <thead> 
                          <tr>
                            <!--   <th style="text-align:center;font-size:13px;">PROPERTY ID</th> -->
                              <th style="text-align:center;font-size:13px;">DUE DATE</th>
                              <th style="text-align:center;font-size:13px;">PAY DATE</th>
                              <th style="text-align:center;font-size:13px;">SI NO</th>
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
<br><br>





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

       <!--      <td style="width:25%;font-size:14px;"><label for="pay_date">Pay Date:</label></td><td style="width:25%;font-size:14px;"><input type="date" class="form-control-sm margin-bottom pay-date" id="pay_date" name="pay_date" value="<?php echo date('Y-m-d'); ?>" style="width:100%;"></td>
 -->
           <!--  <?php      

            $pay_date = date('2024-12-31');
            $all_payments = load_data($prop_id, $pay_date);
            $over_due    = $all_payments[0];
            $total_amt_due = $all_payments[1];
            $total_interest =  $all_payments[2];
            $total_principal = $all_payments[3];
            $total_surcharge = $all_payments[4];  

            ?>


            <table class="table2 table-bordered table-stripped">
                 <thead> 
                   <tr>
                       <th class="text-center" style="font-size:13px;">DUE DATE</th>
                       <th class="text-center" style="font-size:13px;">PAY DATE</th>
                       <th class="text-center" style="font-size:13px;">SI NO</th>
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

              
 -->

        <hr>
        <table>
            <tr>
                <td style="width:25%;font-size:14px;"><label for="due_date">Due Date:</label></td><td style="width:25%;font-size:14px;"><input type="date" class="form-control-sm margin-bottom due-date" name="due_date" value="<?php echo date("Y-m-d", strtotime($due_date_ent)); ?>" style="width:100%;"></td><td style="width:25%;font-size:14px;"><label for="pay_date">Pay Date:</label></td><td style="width:25%;font-size:14px;"><input type="date" class="form-control-sm margin-bottom pay-date" id="pay_date" name="pay_date" value="<?php echo date('Y-m-d'); ?>" style="width:100%;"></td>
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
                <td style="width:25%;font-size:14px;"><label for="amount_paid">Amount Paid:</label></td><td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom amt-paid"  id="amount_paid" name="amount_paid" value="<?php echo $amount_paid_ent; ?>" required></td><td style="width:25%;font-size:14px;"><label for="or_no">Sales Invoice #:</label></td><td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom or-no"  id="or_no_ent" name="or_no_ent" required></td>
            </tr>
        </table>
        <input type="text" class="form-control-sm margin-bottom int-rate"  id="interest_rate" name="interest_rate" value="<?php echo $interest_rate; ?>"> 
        <input type="text" class="form-control-sm margin-bottom under-pay"  id="under_pay" name="under_pay" value="<?php echo $underpay; ?>"> 
        <input type="text" class="form-control-sm margin-bottom excess"  id="excess" name="excess" value="<?php echo $excess; ?>"> 
        <input type="text" class="form-control-sm margin-bottom over-due-mode"  id="over_due_mode" name="over_due_mode" value="<?php echo $over_due_mode_upay; ?>">   
        <input type="text" class="form-control-sm margin-bottom monthly-pay"  id="monthly_pay" name="monthly_pay" value="<?php echo $monthly_pay; ?>">   
        <input type="text" class="form-control-sm margin-bottom status-count"  id="status_count" name="status_count" value="<?php echo $count; ?>">   
        <input type="text" class="form-control-sm margin-bottom payment-count"  id="payment_count" name="payment_count" value="<?php echo $last_pay_count; ?>">   
        <input type="text" class="form-control-sm margin-bottom "  id="ma_balance" name="ma_balance" value="<?php echo $ma_balance; ?>">   
        <input type="text" class="form-control-sm margin-bottom "  id="last_interest" name="last_interest" value="<?php echo isset($last_interest) ? $last_interest  : 0; ?>">   
     


        
        </form>

    </div>
	</div>
</div>
<script>
    

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
				url:_base_url_+"classes/Master.php?f=save_payment",
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
                        location.reload();
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
	
</script>