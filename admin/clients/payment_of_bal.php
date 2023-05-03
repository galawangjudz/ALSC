<?php 

include 'common.php';

include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php
if(isset($_GET['id'])){
    include('payment_reload.php');
}

?>
<form action="" method="POST" id="payment_of_bal">

<table>
            <tr>
                <td style="width:25%;font-size:14px;"><label for="due_date">Due Date:</label></td>
                <td style="width:25%;font-size:14px;"><input type="date" class="form-control-sm margin-bottom due-date" name="due_date" value="<?php echo date("Y-m-d", strtotime($due_date_ent)); ?>" style="width:100%;"></td>
                <td style="width:25%;font-size:14px;"><label for="pay_date">Pay Date:</label></td><td style="width:25%;font-size:14px;"><input type="date" class="form-control-sm margin-bottom pay-date" id="pay_date" name="pay_date" value="<?php echo date('Y-m-d'); ?>" style="width:100%;"></td>
            </tr>
            <tr>
                <td style="width:25%;font-size:14px;"><label for="amount_due">Amount Due:</label></td>
                <td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom amt-due"  id="amount_due" name="amount_due" value="0.00"></td>
                <td style="width:25%;font-size:14px;"><label for="surcharge">Surcharge:</label></td><td style="width:25%;font-size:14px;">
                <input type="text" class="form-control-sm margin-bottom surcharge-amt" id="surcharge" name="surcharge" value="0.00" required></td>
            </tr>
            <tr>
                <td style="width:25%;font-size:14px;"><label for="amount_due">Interest:</label></td>
                <td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom amt-due"  id="interest_amt" name="interest_amt" value="0.00" required></td>
                <td style="width:25%;font-size:14px;"><label for="surcharge">Principal:</label></td><td style="width:25%;font-size:14px;">
                <input type="text" class="form-control-sm margin-bottom surcharge-amt" id="surcharge" name="surcharge" value="0.00" required></td>
            </tr>
            <tr>
                <td style="width:25%;font-size:14px;"><label for="rebate">Rebate:</label></td><td style="width:25%;font-size:14px;">
                <input type="text" class="form-control-sm margin-bottom rebate-amt" id="rebate_amt" name="rebate_amt" value="0.00" required></td>
                <td style="width:25%;font-size:14px;"><label for="status">Status:</label></td><td style="width:25%;font-size:14px;">
                <input type="text" class="form-control-sm margin-bottom pay-stat"  id="status" name="status" value="FPD"></td>
                 </tr>
        </table>
        <br>
        <table>
            <tr>
                <td style="width:25%;font-size:14px;"><label for="tot_amt_due">Total Amount Due:</label></td><td style="width:25%;font-size:14px;">
                <input type="text" class="form-control-sm margin-bottom tot-amt-due"  id="tot_amount_due" name="tot_amount_due" value="0.00" required></td><td style="width:25%;font-size:14px;"><label for="balance">Balance:</label></td><td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom balance-amt"  id="balance" name="balance" value="<?php echo $balance_ent; ?>" required></td>
            </tr>
            <tr>
                <td style="width:25%;font-size:14px;"><label for="amount_paid">Amount Paid:</label></td>
                <td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom amt-paid"  id="amount_paid" name="amount_paid" value="0.00" required></td><td style="width:25%;font-size:14px;"><label for="or_no">OR #:</label></td><td style="width:25%;font-size:14px;"><input type="text" class="form-control-sm margin-bottom or-no"  id="or_no_ent" name="or_no_ent" required></td>
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
     
        
    </form>


    <script>
	
    $(document).ready(function(){

	
	


	$('#payment_of_bal').submit(function(e){
		e.preventDefault();
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=payment_of_balance",
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
				
						alert_toast(resp.msg,'error');
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
