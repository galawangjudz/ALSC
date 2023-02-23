
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
      function function1() {
        // create and return an array of user data
        $users = array(
            array("name" => "John", "age" => 25, "email" => "john@example.com"),
            array("name" => "Jane", "age" => 30, "email" => "jane@example.com"),
            array("name" => "Bob", "age" => 40, "email" => "bob@example.com")
        );
        
        return $users;
    }



    function load_data($id){
          $conn = mysqli_connect('localhost', 'root', '', 'alscdb');
          if (!$conn) {
              die('Could not connect to database: ' . mysqli_connect_error());
          }



          $l_pay_date_val = '2024-12-31';
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

          $payments_data = array(); 
          $count = 1;
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
                return $all_payments;
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

              return $all_payments;
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
                                  $t_due_date  = $l_date2->format('m/d/y');
                                  $l_due_date_val = $l_date2;
                                  $l_count = $l_last_stat_cnt + 1;
                            else:
                                  $l_date = new DateTime($l_date);
                                  $t_due_date  = $l_date->format('m/d/y');
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
                                    $l_date = new DateTime($l_date2);
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
                      $l_principal_amt = floatval(str_replace(',', '',$l_principal));
                      $l_new_bal = $l_bal - $l_principal_amt;
                      $l_new_bal = number_format($l_new_bal,2);
              
                    

              }elseif ($l_pay_type1 == 'Spot Cash' && $l_acc_status == 'Reservation') {
                    $l_date = date('Y-m-d',strtotime($l_start_date));
                    $l_due_date = $l_date->format('m/d/y');
                    $l_due_date_val =  date('Y-m-d',strtotime($l_start_date));
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
                    $l_new_bal = number_format($l_new_bal) ;

            }elseif ($l_pay_type1 == 'Full DownPayment' && $l_acc_status == 'Reservation') {
                    $l_date = date('Y-m-d', strtotime($l_full_dp));
                    $l_due_date = $l_date->format('m/d/y');
                    $l_due_date_val =  date('Y-m-d',strtotime($l_full_dp));
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
                    $l_new_bal = number_format($l_new_bal) ;
                    $l_date_bago = $l_start_date;
            }elseif (($l_acc_status == 'Full DownPayment' && $l_pay_type2 == 'Deferred Cash Payment') || ($l_pay_type1 == 'No DownPayment' && $l_pay_type2 == 'Deferred Cash Payment') || $l_acc_status == 'Deferred Cash Payment') {
                    $l_date =  date('Y-m-d', strtotime($l_start_date));
                    $l_monthly_pay = $l_monthly_ma;  
                    $l_fpd = $l_bal;
                    if ($l_bal <= $l_monthly_pay):
                          $l_fp_mode = 1;
                    else:
                          $l_fp_mode = 0;

                          if ($l_date_bago == $l_full_dp) {
                          
                            $l_due_date_val_old = add($l_date,1);
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
                               
                                $l_date2 = add($l_date,1);
                                $l_due_date_val = $l_date2;
                                $l_date = $l_date2;
                                $t_due_date = $l_date->format('m/d/y');
                                $l_count = $l_last_stat_cnt + 1;
                          else:
                                $t_due_date = "2023-03-31";
                                $l_due_date_val = new Datetime($l_date);
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
                                $l_date2 = add($l_date,1);
                                $l_due_date_val = $l_date2;
                                $l_new_due_date_val = $l_due_date_val;
                                $l_date = '2023-03-03';
                                $t_due_date = $l_date2->format('m/d/y');
                                $l_count = $l_last_stat_cnt + 1;
                               
                                $l_amt_due = number_format($l_monthly_pay,2);
                               
                                if ($l_ma_terms == $l_count || $l_fp_mode == 1) {
                                      $l_status = 'FPD';
                                      $l_monthly_pay = $l_fpd;
                                      $l_amt_due = ftom($l_monthly_pay);
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
                    $l_new_bal = number_format($l_new_bal,2) ;
            }else{
              $total_amount_due_ent =($l_tot_amnt_due);
              $total_principal_ent = ($l_tot_principal);
              $total_surcharge_ent = ($l_tot_surcharge);
              $total_interest_ent = ($l_tot_interest);
            }
            $l_bal = floatval(str_replace(',', '',$l_new_bal));
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

       
            
            $l_last_due_date =  '2023-02-17';
            $l_last_amt_paid = floatval($l_amt_due);
            $l_last_amt_due = floatval($l_amt_due);
            $l_last_status = $l_status;
            $l_last_stat_cnt = $l_count;

      
            $l_due_date_val = add($l_last_due_date, 1);
            $l_due_date_val = $l_due_date_val->format('Y-m-d');

           
            if ($count == 15){
              $l_mode = 0;
            }else{
              $l_mode = 1;
              $count += 1;  
            }
           /*  if ($l_mode == 1 && ($l_due_date_val > $l_pay_date_val)){
                if ($l_date_bago != $l_full_dp){
                    $l_mode = 0;
                }
                    $l_mode = 1;
            } */

         
            endwhile;	

      return $all_payments;      
      }                   