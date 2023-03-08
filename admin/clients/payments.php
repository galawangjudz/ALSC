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

        if($acc_status == 'Fully Paid'):
            return ;
        endif;

        if($retention == 'Retention'):
            $l_date = $last_pay_date;

        elseif(($p1 == 'Partial DownPayment') && ($acc_status == 'Reservation' || $acc_status == 'Partial DownPayment') || ($p1 == 'Full DownPayment' && $acc_status == 'Partial DownPayment')):
            $this->rebate_ent->set_sensitive(0);

            $l_date = date('Y-m-d', strtotime($first_dp));
            $day = date('d', strtotime($l_date));
            $l_full_down = $last_payment['remaining_balance'] - $amt_fnanced;
            $monthly_pay = $monthly_down;
            if ($l_full_down <= $monthly_pay) {
                $l_fd_mode = 1;
            } else {
                $l_fd_mode = 0;
            }
        elseif ($acc_status == 'Reservation' || $last_payment['status'] == 'RESTRUCTURED' || $last_payment['status'] == 'RECOMPUTED' || $last_payment['status'] == 'ADDITIONAL'):
            $due_date_ent = (date('m/d/Y', strtotime($first_dp)));
            $due_date = strtotime(gmdate('Y-m-d', strtotime($first_dp)));
            $amount_paid_ent = (number_format($monthly_down));
            $amount_ent = (number_format($monthly_down));
            $count = 1;
            if ($this->last_payment[8] == 'ADDITIONAL') {
                $l_date = date('Y-m-d', strtotime($last_payment['due_date']));
                $t_year = date('Y', strtotime($l_date));
                $t_month = date('m', strtotime($l_date));
                if ($retention == '1') {
                    $l_date = date('Y-m-d', strtotime(($first_dp)));
                }
                $t_day = date('d', strtotime($l_date));
                $l_date2 = auto_date($due_date, $t_year, $t_month, $t_day);
                $due_date = strtotime(gmdate('Y-m-d', $l_date2));
                $l_date = gmdate('Y-m-d', $l_date2);
                $due_date_ent = (date('m/d/Y', strtotime($l_date)));
                $count = $last_payment[9] + 1;

            }
            if ($no_payments == $count || $l_fd_mode == 1) {
                $l_status = 'FD';
            } else {
                $l_status = 'PD - ' . strval($count);
            }

        elseif ($last_payment['payment_amount'] < $last_payment['amount_due']) :
            $l_surcharge = 0;
            for ($x = 0; $x < $last_payment['payment_count'] + 1; $x++) {
                try {
                    if ($this->last_payment[0] == $this->payment_rec[$x][0]) {
                        $this->last_principal += $this->payment_rec[$x][6];
                        $l_surcharge += $this->payment_rec[$x][4];
                    }
                } catch (Exception $e) {
                    //pass
                }
            }

        





        endif;    


        
        

        }

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