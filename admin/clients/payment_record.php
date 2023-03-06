
<?php
    function is_leap_year($year) {
      return date('L', strtotime("$year-01-01"));
    }


    function auto_date($last_day,$date)
      {
       
        $date_arr = date_parse($date);

        $year = $date_arr['year'];
        $month = $date_arr['month'];
        $day = $date_arr['day'];
        $change_date = 0;
        $date_of_sale = '2023-02-17';
/*    
        $year = date('Y', strtotime($date));
        $month = date('m', strtotime($date));
        $day = date('d', strtotime($date)); */
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


          $payments = $conn->query("SELECT remaining_balance, due_date, payment_amount, amount_due, status, status_count, pay_date, surcharge, principal, interest, or_no, rebate, payment_count FROM property_payments WHERE md5(property_id) = '{$_GET['id']}' ORDER by due_date, pay_date, payment_count, remaining_balance DESC");
          $l_last = $payments->num_rows - 1;
          $payments_data = array(); 
          if($payments->num_rows <= 0){
              echo ('No Payment Records for this Account!');
          } 
          while($row = $payments->fetch_assoc()) {
            $payments_data[] = $row; 
 
          }
         
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
            
            return $all_payments; 
    }