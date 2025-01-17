
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
    


    function add($date_str, $months)
      {
        $date = new DateTime($date_str);
        $start_day = $date->format('j');
    
        $date->modify("+{$months} month");
      /*   $l_date=  $date->format('Y-m-d  ');
        echo $l_date; */
        $end_day = $date->format('j');
    
        if ($start_day != $end_day)
            $date->modify('last day of last month');
    
        return $date;
      }
   


    function load_data($id){
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
            $end = new DateTime($l_start_date);
            $end->modify("+{$l_ma_terms} month");
            $l_pay_date_val = $end->format('Y-m-d');

    

            endwhile;


          $payments = $conn->query("SELECT remaining_balance, due_date, payment_amount, amount_due, status, status_count, pay_date, surcharge, principal, interest, or_no, rebate, payment_count FROM property_payments WHERE md5(property_id) = '{$_GET['id']}' ORDER by payment_count");
          $l_last = $payments->num_rows - 1;
          $payments_data = array(); 
          if($payments->num_rows <= 0){
              echo ('No Payment Records for this Account!');
          } 
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



         /*  $count = 1; */
         $all_payments= array();
         for ($x = 0; $x < $payments->num_rows ; $x++){
            if ($payments_data[$x]['due_date'] != 0):
                $l_date = strtotime($payments_data[$x]['due_date']);
                $t_due_date = date('m/d/y', $l_date);
               //self.due = $payments_data[x]['due_date']
            else:
                $t_due_date = '';
            endif;
            if ($payments_data[$x]['pay_date'] != 0):
                $l_date = strtotime($payments_data[$x]['pay_date']);
                $l_pay_date = date('m/d/y', $l_date);
                //self.pay = $payments_data[x]['pay_date']
                
            else:
                $l_pay_date = '';
            endif;
            $l_stat = $payments_data[$x]['status'];
            $t_amount_due = $payments_data[$x]['amount_due'];
            
            $l_data = array($t_due_date, $l_pay_date, $payments_data[$x]['or_no'], number_format($payments_data[$x]['payment_amount'],2), 
            number_format($payments_data[$x]['amount_due'],2), number_format($payments_data[$x]['interest'],2), 
            number_format($payments_data[$x]['principal'],2), number_format($payments_data[$x]['surcharge'],2), number_format($payments_data[$x]['rebate'],2), 
            str_replace(" ", "", $payments_data[$x]['status']), number_format($payments_data[$x]['remaining_balance'],2));
            array_push($all_payments, $l_data);
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
                                        //echo $l_amt_due;
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
                            $l_date_bago = $l_date_old;
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
            }
            $l_pay_date_value = new Datetime($l_pay_date_val);
            $l_surcharge = '0.00';
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