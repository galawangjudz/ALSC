<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php


if(isset($_GET['id'])){
    $l_date1 = gmdate('U', $this->pay_date_dte->get_time() + 86400);
    $t_year = gmdate('Y', $l_date1);
    $t_month = gmdate('m', $l_date1);
    $t_day = gmdate('d', $l_date1);
    $l_date1 = array(intval($t_year), intval($t_month), intval($t_day), 0, 0, 0);
    $l_pay_date_val = gmmktime($l_date1[3], $l_date1[4], $l_date1[5], $l_date1[1], $l_date1[2], $l_date1[0]);
    
    $l_col = "property_id,c_account_type,c_account_type1,c_account_status,c_net_tcp,c_payment_type1,c_payment_type2,c_net_dp,c_no_payments,c_monthly_down,c_first_dp,c_full_down,c_amt_financed,c_terms,c_interest_rate,c_fixed_factor,c_monthly_payment,c_start_date,c_retention,c_change_date,c_restructured,c_date_of_sale";
    $l_sql = sprintf("SELECT %s FROM t_properties WHERE md5(property_id) = '{$_GET['id']}' ", $l_col);
    $l_qry = $this->cnx->query($l_sql);
    $l_b_rst = pg_fetch_all($l_qry);
    
    $l_acc_type = $l_b_rst[0][1];
    $l_acc_type1 = $l_b_rst[0][2];
    $l_acc_status = $l_b_rst[0][3];
    $l_net_tcp = $l_b_rst[0][4];
    $l_pay_type1 = $l_b_rst[0][5];
    $l_pay_type2 = $l_b_rst[0][6];
    $l_net_dp = $l_b_rst[0][7];
    $l_num_pay = $l_b_rst[0][8];
    $l_monthly_dp = $l_b_rst[0][9];
    $l_first_dp = $l_b_rst[0][10];
    $l_full_dp = $l_b_rst[0][11];
    $l_amt_fin = $l_b_rst[0][12];
    $l_ma_terms = $l_b_rst[0][13];
    $l_int_rate = $l_b_rst[0][14];
    $l_fixed_factor = $l_b_rst[0][15];
    $l_monthly_ma = $l_b_rst[0][16];
    $l_start_date = $l_b_rst[0][17];
    $l_retention = $l_b_rst[0][18];
    $l_change_date = $l_b_rst[0][19];
    $l_restructured = $l_b_rst[0][20];
    $l_waived_sur = $l_b_rst[0][21];
    $l_date_of_sale = $l_b_rst[0][22];


    $payments = $conn->query("SELECT remaining_balance, due_date, payment_amount, amount_due, status, status_count, pay_date, surcharge, principal, interest, or_no, rebate, payment_count FROM property_payments WHERE md5(property_id) = '{$_GET['id']}' ORDER by due_date, pay_date, payment_count, remaining_balance DESC");
    $l_last = $payments->num_rows - 1;
    if($payments->num_rows <= 0){
        echo ('No Payment Records for this Account!');
    } 
    
    while($row=$payments->fetch_assoc()):
        $l_bal = $row[$l_last][0];
        $l_last_due_date = $row[$l_last][1];
        $l_last_pay_date = $row[$l_last][6];
        $l_last_amt_paid = $row[$l_last][2];
        $l_last_amt_due = $row[$l_last][3];
        $l_last_sur = $row[$l_last][7];
        $l_last_int = $row[$l_last][9];
        $l_last_status = $row[$l_last][4];
        $l_last_stat_cnt = $row[$l_last][5];
        $l_last_rebate = $row[$l_last][11];
        $l_last_prin = $row[$l_last][8];
        $l_last_or_no = $row[$l_last][10];
        $l_last_pay_cnt = $row[$l_last][12];

        for ($x = 0; $x < num_rows($payments); $x++){
            if ($l_last_pay_date == $row[$x][6]){
                if ($row[$x][1] != 0){
                    $l_date = gmdate(timegm(get_date($row[$x][1])));
                    $l_due_date = strftime("%m/%d/%Y",$l_date);
                }
                else{
                    $l_due_date = '';
                }
                if ($row[$x][6] != 0){
                    $l_date = gmdate(timegm(get_date($row[$x][6])));
                    $l_last_pay_date1 = strftime("%m/%d/%Y",$l_date);
                }
                else{
                    $l_last_pay_date1 = '';
                }
                $l_data = [$l_due_date, $l_last_pay_date1, $$row[$x][10], ftom($row[$x][2]), ftom($row[$x][3]), ftom($row[$x][9]), ftom($row[$x][8]), ftom($row[$x][7]), ftom($row[$x][11]), str_replace(" ", "", $row[$x][4]), ftom($row[$x][0])];
                $this->payment_cls[] = $l_data;
            }
        }

    $l_date = gmdate(timegm(get_date($l_date_of_sale)));
    $this->day1 = strftime("%d", $l_date);


    endwhile;

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
            <label for="amount_paid">Amount Paid:</label>
            <input type="number" id="amount_paid" name="amount_paid" required><br>

            <label for="or_no">OR Number:</label>
            <input type="text" id="or_no" name="or_no" required><br>

            <label for="pay_date">Payment Date:</label>
            <input type="date" id="pay_date" name="pay_date" required><br>
        </form>


    </div>
	</div>
</div>
<script>


</script>