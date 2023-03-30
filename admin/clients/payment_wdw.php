

<div class="card card-outline rounded-0 card-maroon">
    
	<div class="card-header">
	<h3 class="card-title">Property ID# <?php echo $prop_id ?> </h3>
	</div>
	<div class="card-body">
    <div class="container-fluid">
        <form action="" method="POST">
            <label for="prop_id">Property ID:</label>
            <input type="text" id="prop_id" name="prop_id" value="<?php echo $prop_id; ?>"><br>

            <label for="acc_type1">Account Type 1:</label>
            <input type="text" id="acc_type1" name="acc_type1" value="<?php echo $l_acc_type; ?>"><br>

            <label for="acc_type2">Account Type 2:</label>
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