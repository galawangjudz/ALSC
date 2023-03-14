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
	<h3 class="card-title">Property ID# <?php echo $prop_id ?> </h3>
	</div>
	<div class="card-body">
    <div class="container-fluid">
        <form action="" method="POST" id="save_payment">
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
            <input type="date" id="due_date" name="due_date" value="<?php echo date('Y-m-d'); ?>"><br>

            <label for="pay_date">Pay Date:</label>
            <input type="date" id="pay_date" name="pay_date" value="<?php echo date('Y-m-d'); ?>"><br>

            <label for="status">Status:</label>
            <input type="text" id="status" name="status" ><br>

            <label for="amount_due">Amount Due:</label>
            <input type="text" id="amount_due" name="amount_due" ><br>

            <label for="principal">Principal:</label>
            <input type="text" id="principal" name="principal" required><br>

            
            <label for="surcharge">Surcharge:</label>
            <input type="text" id="surcharge" name="surcharge" required><br>

            <label for="amount_paid">Interest:</label>
            <input type="text" id="interest" name="interest" required><br>

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

            <label for="status_count">Status Count:</label>
            <input type="text" id="status_count" name="status_count" required><br>

            <label for="payment_count">Payment Count:</label>
            <input type="text" id="payment_count" name="payment_count" required><br>
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