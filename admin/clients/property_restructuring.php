<?php 
require_once('../../config.php');

if(isset($_GET['id'])){
    $prop = $conn->query("SELECT property_id ,c_account_type1, c_date_of_sale, c_account_status, c_payment_type1, c_payment_type2
    , c_net_dp, c_no_payments, c_monthly_down, c_first_dp, c_full_down, c_amt_financed, c_terms, c_interest_rate, c_fixed_factor
    , c_monthly_payment, c_start_date, c_remarks, c_balance FROM properties where md5(property_id) = '{$_GET['id']}' ");    
    while($row=$prop->fetch_assoc()){
    
        ///LOT
        $prop_id = $row['property_id'];
        $date_of_sale = $row['c_date_of_sale'];
        $account_status = $row['c_account_status'];
        $balance = $row['c_balance'];
        $payment_type1 = $row['c_payment_type1'];
        $payment_type2 = $row['c_payment_type2'];
        $amt_fnanced = $row['c_amt_financed'];
        $monthly_down = $row['c_monthly_down'];
        $first_dp = $row['c_first_dp'];
        $account_type1 = $row['c_account_type1'];
      
        $full_down = $row['c_full_down'];
        $terms = $row['c_terms'];
        $interest_rate = $row['c_interest_rate'];
        $fixed_factor = $row['c_fixed_factor'];
        $monthly_payment = $row['c_monthly_payment'];
        $no_payments = $row['c_no_payments'];
        $net_dp = $row['c_net_dp'];
        $start_date = $row['c_start_date'];


        }

    }
?>
<?php
$username = $_settings->userdata('username'); 
$type = $_settings->userdata('id');
?>
<style>
#item-list th, #item-list td{
	padding:5px 3px!important;
}

.container-fluid p{
    margin: unset
}

.has-error .checkbox,
.has-error .checkbox-inline,
.has-error .control-label,
.has-error .help-block,
.has-error .radio,
.has-error .radio-inline,
.has-error.checkbox label,
.has-error.checkbox-inline label,
.has-error.radio label,
.has-error.radio-inline label {
    color: #a94442
}

.has-error .form-control {
    border-color: #a94442;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075);
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075)
}
.has-error .form-control:focus {
    border-color: #843534;
    -webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483;
    box-shadow: inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 6px #ce8483
}
.has-error .input-group-addon {
    color: #a94442;
    background-color: #f2dede;
    border-color: #a94442
}
.has-error .form-control-feedback {
    color: #a94442
}
/* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
  font-weight:bold;
}
/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
.lot_box{
  width:49%;
  height:auto;
  float:left;
  border: solid #36454F 1px;
  padding-left:15px;
  padding-right:15px;
  padding-bottom:15px;
  border-radius:5px;
}
.payment_box{
  width:49%;
  height:auto;
  float:left;
  border: solid #36454F 1px;
  padding-left:15px;
  padding-right:15px;
  padding-bottom:15px;
  padding-top:15px;
  border-radius:5px;
}
.payment_box2{
  width:49%;
  height:auto;
  float:left;
  border: solid #36454F 1px;
  padding-left:15px;
  padding-right:15px;
  padding-bottom:15px;
  padding-top:15px;
  border-radius:5px;
  margin-left:2%;
}
.add_cost_box{
  width:100%;
  height:auto;
  float:left;
  border: solid #36454F 1px;
  padding-left:15px;
  padding-right:15px;
  padding-bottom:15px;
  border-radius:5px;
  margin-top:15px;
}
.house_box{
  width:49%;
  height:auto;
  float:left;
  border: solid #36454F 1px;
  padding-left:15px;
  padding-right:15px;
  padding-bottom:15px;
  border-radius:5px;
  margin-left:2%;
}
.main_box{
  float:left;
  width:100%;
  height:auto;
  padding-left:15px;
  padding-right:15px!important;
  padding-top:15px;
  border: solid #36454F 1px;
  padding-bottom:15px;
  border-radius:5px;
}
#btnfind{
  margin-left:25px;
  font-weight:bold;
}
#invoice_totals{
  width:100%;
  margin-left:10px;
  margin-right:10px;
}
.space{
  float:left;
  width:100%;
  height:15px;
}
.hr_vertical
 {
   background-color:#C80000;
   color:#C80000;
   position:absolute;
   left:130px;
   border:2px;
 }
 .title_comment{
	color:black;
	font-weight:bold;
  font-size:20px;
  padding-top:5px;
  padding-bottom:15px;
  margin-top:5px;
}
#txtarea_comment{
  width:100%;
  border-radius:5px;
}
 .titles{
	color:black;
	font-weight:bold;
	text-align:center;
  font-size:20px;
  padding-top:5px;
  padding-bottom:5px;
  margin-top:5px;
}
.control-label{
  display: inline-block;
  width: auto;
}
input{
  font-size:15px!important;
  color: black!important;
  margin-top:-5px;
}
.hr_space{
	margin-top:18px;
	display:block;
}
.main-header{
  background-color:white;
}
.alsc{
  width:50px;
  height:100px;
  float:left;
}
.small{
  float:left;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  font-size:15px;
  margin-left:5px;
  color:black;
  font-weight: 500;
}
#remarks{
  width:100%;
  margin-left:10px;
  margin-right:10px;
}

.textarea {
  width: 100%;
}

#invoice_notes{
  height:125px;
}

.textarea textarea {
  width: 100%;
  padding: 10px;
  resize: none;
}
.type-title{
	float:left;
}


</style>
<body onload="showTab()">
<div class="card card-outline rounded-0 card-maroon">
    
	<div class="card-header">
	<h3 class="card-title"><b>Property ID#: <i><?php echo $prop_id ?></i> </b></h3>
	</div>
	<div class="card-body">
    <div class="container-fluid">
 
    <div class="panel-heading">
        <div class="titles"><center><h5>Payment Computation<h5></center></div>
    </div>

    <form action="" id="restructuring">
             
    <div class="panel-body form-group form-group-sm">
        <div class="main_box">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <input type="hidden" id="comm" name="comm" value="<?php echo $username; ?> restructured account with property ID # <?php echo $prop_id; ?>.">
                        <input type="hidden" class="form-control margin-bottom required prop-id" name="prop_id" id="prop_id" value="<?php echo isset($prop_id) ? $prop_id : 0; ?>">
     
                        <label class="control-label">Balance:</label>
                        <input type="text" class="form-control margin-bottom required balance" name="balance" id="balance" value="<?php echo isset($balance) ? number_format($balance,2) : 0; ?>" tabindex = "1" >
                    </div>
                </div>
                <div class="col-md-6">	
                    <div class="form-group">
                        <label class="control-label">Account Status: </label>

                       <!--  <div class="form-group">

                          <style>
                              select:invalid { color: gray; }
                          </style>
                          <select name="payment_type1" id="payment_type1" class="form-control required acc-status">
                              <option name="payment_type1" value="Partial DownPayment" <?php echo isset($account_status) && $account_status == "Partial DownPayment" ? 'selected' : '' ?>>Partial DownPayment</option>
                              <option name="payment_type1" value="Monthly Amortization" <?php echo isset($account_status) && $account_status == "Monthly Amortization" ? 'selected' : '' ?>>Monthly Amortization</option>
                              <option name="payment_type1" value="Deferred Cash Payment" <?php echo isset($account_status) && $account_status == "Deferred Cash Payment" ? 'selected' : '' ?>>Deferred Cash Payment</option>
                          </select>	
                        </div>	 -->
                        <input type="text" class="form-control margin-bottom required acc-status" name="acc_stat" id="acc_stat" value="<?php echo isset($account_status) ? $account_status : 0; ?>" tabindex ="1" >
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">	
                  <div class="form-group">
                    <label class="control-label">Restructuring Date: </label>
                    <input type="date" class="form-control restructured-date" name="restructured_date" id="restructured_date" value="<?php echo date('Y-m-d'); ?>" >
                  </div>
              </div>
          </div>
    <div class="space"></div>
    <div class="payment_box" id = "p1_box">
        <div class="col-md-12"  id = "pay_type1">	
            <label class="control-label">Payment Type 1: </label>
            <div class="form-group">
            <style>
                select:invalid { color: gray; }
            </style>
            
            <select name="payment_type1" id="payment_type1" class="form-control required pay-type1" tabindex = "2">
            <?php if ($account_status == 'Monthly Amortization'): ?>
                <option name="payment_type1" value="Partial DownPayment" <?php echo isset($payment_type1) && $payment_type1 == "Partial DownPayment" ? 'selected' : '' ?> disabled style="background-color: gainsboro; color: black;">Partial DownPayment</option>
                <option name="payment_type1" value="Full DownPayment" <?php echo isset($payment_type1) && $payment_type1 == "Full DownPayment" ? 'selected' : '' ?> disabled style="background-color: gainsboro; color: black;">Full DownPayment</option>
                <option name="payment_type1" value="No DownPayment" <?php echo isset($payment_type1) && $payment_type1 == "No DownPayment" ? 'selected' : '' ?> disabled style="background-color: gainsboro; color: black;">No DownPayment</option>
              <?php elseif ($account_status == 'Reservation'): ?>
                <option name="payment_type1" value="Partial DownPayment" <?php echo isset($payment_type1) && $payment_type1 == "Partial DownPayment" ? 'selected' : '' ?>>Partial DownPayment</option>
                <option name="payment_type1" value="Full DownPayment" <?php echo isset($payment_type1) && $payment_type1 == "Full DownPayment" ? 'selected' : '' ?>>Full DownPayment</option>
                <option name="payment_type1" value="No DownPayment" <?php echo isset($payment_type1) && $payment_type1 == "No DownPayment" ? 'selected' : '' ?>>No DownPayment</option>
            <?php elseif ($account_status == 'Partial DownPayment'): ?>
                <option name="payment_type1" value="Partial DownPayment" <?php echo isset($payment_type1) && $payment_type1 == "Partial DownPayment" ? 'selected' : '' ?>>Partial DownPayment</option>
                <option name="payment_type1" value="Full DownPayment" <?php echo isset($payment_type1) && $payment_type1 == "Full DownPayment" ? 'selected' : '' ?>>Full DownPayment</option>
                <option name="payment_type1" value="No DownPayment" <?php echo isset($payment_type1) && $payment_type1 == "No DownPayment" ? 'selected' : '' ?>>No DownPayment</option>
            <?php endif; ?>
              </select>	
          </div>	
      </div>
    </div>
    <div class="payment_box2" id = "p2_box">
        <div class="col-md-12" id= "pay_type2">
            <label class="control-label">Payment Type 2: </label>
            <div class="form-group">
                <style>
                    select:invalid { color: gray; }
                </style>
                <select name="payment_type2" id="payment_type2" class="form-control required pay-type2" tabindex = "3" >
                <?php if ($account_status == 'Deferred Cash Payment'): ?>
                    <option name="payment_type2" value="Deferred Cash Payment" <?php echo isset($payment_type2) && $payment_type2 == "Deferred Cash Payment" ? 'selected' : '' ?>>Deferred Cash Payment</option>
                    <option name="payment_type2" value="Monthly Amortization" <?php echo isset($payment_type2) && $payment_type2 =! "Monthly Amortization" ? 'selected' : '' ?>>Monthly Amortization</option>
                <?php elseif ($account_status == 'Reservation'): ?>
                    <option name="payment_type2" value="Deferred Cash Payment" <?php echo isset($payment_type2) && $payment_type2 == "Deferred Cash Payment" ? 'selected' : '' ?>>Deferred Cash Payment</option>
                    <option name="payment_type2" value="Monthly Amortization" <?php echo isset($payment_type2) && $payment_type2 == "Monthly Amortization" ? 'selected' : '' ?>>Monthly Amortization</option>
                <?php elseif ($account_status == 'Monthly Amortization'): ?>
                    <option name="payment_type2" value="Monthly Amortization" <?php echo isset($payment_type2) && $payment_type2 == "Monthly Amortization" ? 'selected' : '' ?>>Monthly Amortization</option>
                    <option name="payment_type2" value="Deferred Cash Payment" <?php echo isset($payment_type2) && $payment_type2 =! "Deferred Cash Payment" ? 'selected' : '' ?> disabled style="background-color: gainsboro; color: black;">Deferred Cash Payment</option>
                <?php elseif ($account_status == 'Partial DownPayment' || $account_status == 'Full DownPayment'): ?>
                    <option name="payment_type2" value="Monthly Amortization" <?php echo isset($payment_type2) && $payment_type2 == "Monthly Amortization" ? 'selected' : '' ?>>Monthly Amortization</option>
                    <option name="payment_type2" value="Deferred Cash Payment" <?php echo isset($payment_type2) && $payment_type2 == "Deferred Cash Payment" ? 'selected' : '' ?>>Deferred Cash Payment</option>
                <?php endif; ?>
                </select>	
            </div>
        </div>
    </div>
    <div class="space"></div>
    <div class="payment_box" id="p1">
        <div class="col-md-12">
            <div class="form-group down-frm" id= "down_frm" >
                <label for="net_dp" class="control-label">Total DP Due: </label>
                <input type="text" class="form-control margin-bottom required net-dp" name="net_dp" id="net_dp" value="<?php echo isset($net_dp) ? $net_dp : 0; ?>" readonly>
                <label for="less_paymt_dte" class="control-label" >Less Paym't to Date : </label>
                <input type="text" class="form-control less-paymt-date" name="less_paymt_dte" id="less_paymt_dte" value="0">
                <label for="dp_bal" class="control-label">DP Balance : </label>
                <input type="text" class="form-control margin-bottom required dp-bal" name="dp_bal" id="dp_bal" value="<?php echo isset($net_dp) ? $net_dp : 0; ?>" readonly>
                <label for="acc_surcharge1" class="control-label" >Accrued Surcharge: </label>
                <input type="text" class="form-control margin-bottom required acc-surcharge1" name="acc_surcharge1" id="acc_surcharge1" value="0">
                <label for= "rem_dp" class="control-label">Rem. DP Term/s : </label>
                <input type="text" class="form-control margin-bottom required rem-dp" name="rem_dp" id="rem_dp" value="<?php echo isset($no_payments) ? $no_payments : 0; ?>" maxlength= "2">
                <label for= "monthly_down" class="control-label" id ="mo_down_text">Monthly Down: </label>
                <input type="text" class="form-control margin-bottom required monthly-down" name="monthly_down" id="monthly_down" value="<?php echo isset($monthly_down) ? $monthly_down : 0; ?>"  >
                <label class="control-label">Commencing: </label>
                <input type="date" class="form-control first-dp-date" name="first_dp_date" id = "first_dp_date" value="<?php echo isset($first_dp) ? $first_dp : ''; ?>">
                <label class="control-label">Until: </label>        
                <input type="date" class="form-control full-down-date" name="full_down_date" id = "full_down_date" value="<?php echo isset($full_down) ? $full_down : ''; ?>">
                    
                
            </div>
        </div>
    </div>		
    <div class="payment_box2" id="p2">	
        <div class="col-md-12">
             <label class="control-label" id ="amt_tobe_financed_text" >Amount to be Financed:</label>
             <input type="text" class="form-control margin-bottom required amt-to-be-financed" name="amt_to_be_financed" id="amt_to_be_financed" value="<?php echo isset($amt_fnanced) ? $amt_fnanced : 0; ?>"readonly>
             <label class="control-label" id="acc_int_text">Acc. Interest:</label>
             <input type="text" class="form-control margin-bottom required acc-interest" name="acc_interest" id="acc_interest" value="0">
             <label class="control-label"  id="acc_sur_text" >Acc. Surcharge:</label>
             <input type="text" class="form-control margin-bottom required acc-surcharge2" name="acc_surcharge2" id="acc_surcharge2" value="0">
             <label class="control-label"  id="adj_text" >Adj. Principal Balance:</label>
             <input type="text" class="form-control margin-bottom required adj-prin-bal" name="adj_prin_bal" id="adj_prin_bal" value="<?php echo isset($amt_fnanced) ? $amt_fnanced : 0; ?>" readonly>
           
             <div class="form-group monthly-frm" id = "monthly_frm">
                <label class="control-label">Terms: </label>
                <input type="text" class="form-control margin-bottom required term-days" name="terms" id="terms" value="<?php echo isset($terms) ? $terms : 1; ?>">
                <label for='interest_rate' class="control-label" id='rate_text'>Interest Rate: </label>
                <input type="text" class="form-control margin-bottom required interest-rate" name="interest_rate" id="interest_rate" value="<?php echo isset($interest_rate) ? $interest_rate : 0; ?>">
                <label for='fixed_factor' class="control-label" id='factor_text' >Fixed Factor: </label>
                <input type="text" class="form-control margin-bottom required fixed-factor" name="fixed_factor" id="fixed_factor" value="<?php echo isset($fixed_factor) ? $fixed_factor : 0; ?>" readonly>
                <label class="control-label">Monthly Payment: </label>
                <input type="text" class="form-control margin-bottom required monthly-amor" name="monthly_amortization" id="monthly_amortization" value="<?php echo isset($monthly_payment) ? $monthly_payment : 0; ?> "readonly>	
            </div>
            <label class="control-label" id= "start_text">Start Date: </label>	
            <input type="date" class="form-control required mo-start-date" name="start_date" id = "start_date" value="<?php echo isset($start_date) ? $start_date : ''; ?>">
        </div>
    </div>
    </div>
	</div>
</div>

</form>

</body>
<script>

$(document).ready(function() {

  <?php if ($payment_type2 == 'Deferred Cash Payment' ):?>
        $("#interest_rate").val(0);
        $("#fixed_factor").val(0);
        $('#interest_rate').hide();
        $('#rate_text').hide();
        $('#factor_text').hide();
        $('#fixed_factor').hide();
  <?php endif; ?> 


    <?php if (($account_status == 'Monthly Amortization') || ($account_status == 'Full DownPayment') || ($account_status == 'No DownPayment') ): ?>
        $('#down_frm').hide();
        $('#net_dp').hide();
        $('#less_paymt_dte').hide();
        $('#dp_bal').hide();
        $('#acc_surcharge1').hide();
        $('#no_payment').hide();
        $('#monthly_down').hide();
        $('#first_dp_date').hide();
        $('#full_down_date').hide();
        
        $('#p1').hide();
        $('#p1').hide();
        $('#p1_box').hide();
        $('#p2_box').width('65%');
        $('#p2').width('65%');
      <?php elseif ($account_status == 'Deferred Cash Payment' ):?>
            $('#down_frm').hide();
            $('#net_dp').hide();
            $('#less_paymt_dte').hide();
            $('#dp_bal').hide();
            $('#acc_surcharge1').hide();
            $('#no_payment').hide();
            $('#monthly_down').hide();
            $('#first_dp_date').hide();
            $('#full_down_date').hide();
            $('#p1').hide();
            $('#p1').hide();
            $('#p1_box').hide();
            $('#p2_box').width('65%');
            $('#p2').width('65%');
            $("#interest_rate").val(0);
            $("#fixed_factor").val(0);
            $('#interest_rate').hide();
            $('#fixed_factor').hide();
            $('#rate_text').hide();
            $('#factor_text').hide();
        

      <?php else: ?>
          $('#down_frm').show();
        /*  $('#net_dp').show();
          $('#less_paymt_dte').show();
          $('#dp_bal').show();
          $('#acc_surcharge1').show();
          $('#no_payment').show();
          $('#monthly_down').show();
          $('#first_dp_date').show();
          $('#full_down_date').show(); */
    <?php endif; ?>

    var balance = <?php echo $balance; ?>; 
    <?php if ($account_status == 'Monthly Amortization' || $account_status == 'Full DownPayment' || $account_status == 'Deferred Cash Payment'): ?>
      
          $('#amt_to_be_financed').val(balance); 
          $('#adj_prin_bal').val(balance); 
    <?php endif; ?>


       


});


$(document).on('change', ".acc-interest", function(e) {
		e.preventDefault();
		compute_adj_prin();


	});


  $(document).on('change', ".less-paymt-date", function(e) {
		e.preventDefault();
    var net_dp = $('.net-dp').val();
    var less = $('.less-paymt-date').val();
    var acc_sur1 = $('.acc-surcharge1').val();
    dp_bal =  parseFloat(net_dp) -  parseFloat(less) ;
    total_dp_bal = dp_bal + parseFloat(acc_sur1);
  
    $("#dp_bal").val(total_dp_bal);

    compute_rem_dp();
	});


  $(document).on('change', ".rem-dp", function(e) {
		e.preventDefault();
    compute_rem_dp();
	});



  $(document).on('change', ".first-dp-date", function(e) {
		e.preventDefault();
		auto_terms();


	});


  $(document).on('change', ".acc-surcharge1", function(e) {
		e.preventDefault();
    var net_dp = $('.net-dp').val();
    var less = $('.less-paymt-date').val();
    var acc_sur1 = $('.acc-surcharge1').val();
    dp_bal =  parseFloat(net_dp) -  parseFloat(less) ;
    total_dp_bal = dp_bal + parseFloat(acc_sur1);
  
    $("#dp_bal").val(total_dp_bal);
    compute_rem_dp();

	});
 
	

  $(document).on('change', ".acc-surcharge2", function(e) {
		e.preventDefault();
		compute_adj_prin();


	});


  $(document).on('change', ".term-days", function(e) {
		e.preventDefault();
		compute_adj_prin();



	});

  $(document).on('change', ".adj-prin-bal", function(e) {
		e.preventDefault();
		compute_adj_prin();


	});

  $(document).on('change', ".interest-rate", function(e) {
		e.preventDefault();
		compute_adj_prin();


	});

  $(document).on('change', ".pay-type2", function(e) {
		e.preventDefault();
   
		payment_type2_changed();


	});

  $(document).on('change', ".pay-type1", function(e) {
		e.preventDefault();
   
		payment_type1_changed();


	});

  function payment_type1_changed(){
		var l_payment_type1 = $('.pay-type1').val();

		$('#loan_text').text("Amount to be financed :");
	/* 	$('#interest_rate').show();
		$('#fixed_factor').show(); */
    $('#down_frm').show();
		$('#monthly_frm').show();
		/* $('#rate_text').show();
		$('#factor_text').show(); */
		$('#ma_text').text("Monthly Amortization ");
    var balance = <?php echo $amt_fnanced; ?>; 
    $('#amt_to_be_financed').val(balance); 
    $('#adj_prin_bal').val(balance); 
		if (l_payment_type1 == "Full DownPayment"){
          if (acc_stat != 'Monthly Amortization' || acc_stat != 'Deferred Cash Payment'){
              $('.acc-status').val("Reservation");
          }
          $('#no_payment').val(1);
          $('#no_payment').hide();
          net_dp_ent = $('.net-dp').val();
          $('#monthly_down').val(net_dp_ent);
          $('#rem_dp').val(1);
          $('#net_dp').show();
          $('#less_paymt_dte').show();
          $('#dp_bal').show();
          $('#acc_surcharge1').show();
          $('#no_payment').show();
          $('#monthly_down').show();
          $('#first_dp_date').hide();
          $('#full_down_date').show();
         
    }else if (l_payment_type1 == "No DownPayment"){
          if (acc_stat != 'Monthly Amortization' || acc_stat != 'Deferred Cash Payment'){
              $('.acc-status').val("Reservation");
          }
          var balance = <?php echo $balance; ?>; 
          $('#amt_to_be_financed').val(balance); 
          $('#adj_prin_bal').val(balance); 
          $('#no_payment').val(1);
         
        /*   $('#net_dp').hide();
          $('#less_paymt_dte').hide();
          $('#dp_bal').hide();
          $('#acc_surcharge1').hide();
          $('#no_payment').hide();
          $('#monthly_down').hide();
          $('#first_dp_date').hide();
          $('#full_down_date').hide(); */
          $('#down_frm').hide();
      
    }else{
      if (acc_stat != 'Monthly Amortization' || acc_stat != 'Deferred Cash Payment'){
              $('.acc-status').val("Reservation");
      }
      $('#net_dp').show();
      $('#less_paymt_dte').show();
      $('#dp_bal').show();
      $('#acc_surcharge1').show();
      $('#no_payment').show();
      $('#monthly_down').show();
      $('#first_dp_date').show();
      $('#full_down_date').show();
    
    }

		compute_adj_prin();

	}





  function payment_type2_changed(){
		var l_payment_type2 = $('.pay-type2').val();
    var acc_stat = $('.acc-status').val();
		$('#loan_text').text("Amount to be financed :");
		$('#interest_rate').show();
		$('#fixed_factor').show();
		$('#monthly_frm').show();
		$('#rate_text').show()
		$('#factor_text').show()
		$('#ma_text').text("Monthly Amortization ");
    if (acc_stat == 'Monthly Amortization' || acc_stat == 'Deferred Cash Payment'){
          $('.acc-status').val("Monthly Amortization");
    }
		if (l_payment_type2 == "Deferred Cash Payment"){
          $('#ma_text').text("Deferred Cash Payment ");
          if (acc_stat == 'Monthly Amortization' || acc_stat == 'Deferred Cash Payment'){
              $('.acc-status').val("Deferred Cash Payment");
          }
          $('#loan_text').text("Deferred Amount:");
          $("#interest_rate").val(0);
          $("#fixed_factor").val(0);

          $('#rate_text').hide();
          $('#interest_rate').hide();
          $('#factor_text').hide();
          $('#fixed_factor').hide();
		}else{
          $('#rate_text').show();
          $('#factor_text').show();
          $('#interest_rate').show();
          $('#fixed_factor').show();
    }

		compute_adj_prin();

	}


  function compute_rem_dp(){
		var l_no_pay = $('.rem-dp').val();
		var l_net_dp = $('.dp-bal').val();

		var l_mo_down = parseFloat(l_net_dp) / parseFloat(l_no_pay);
		l_mo_down = isFinite(l_mo_down) ? l_mo_down : 0.0;
		//alert(l_mo_down);
		$("#monthly_down").val(l_mo_down.toFixed(2));		
		auto_terms();
	}

	function auto_terms(){
		var l_no_pay = $('.rem-dp').val();
		var l_start_date = $('.first-dp-date').val();
	
    console.log(l_start_date);
		fd_dte = new Date(l_start_date);
		if(l_no_pay == 0){
			l_no_pay = 1
		}
		fd_dte.setMonth(fd_dte.getMonth()+ parseFloat(l_no_pay - 1));
		
		var fd_dte = fd_dte.toISOString().slice(0, 10);
 
		$('#full_down_date').val(fd_dte);


		var l_fd_dte = $('.full-down-date').val();

		start_dte = new Date(l_fd_dte);

		start_dte.setMonth(start_dte.getMonth()+ 1);
		
		var start_dte = start_dte.toISOString().slice(0, 10);

		$('#start_date').val(start_dte);
		//alert(end_dte);
		

	}


  function compute_adj_prin(){
    var balance = $('.amt-to-be-financed').val();
    var acc_sur = $('.acc-surcharge2').val();
    var acc_int = $('.acc-interest').val();
    var l_terms = $('.term-days').val();
    let acc_stat = $('.acc-status').val();
    let p2 = $('#payment_type2').val();
    var l_rate = $('.interest-rate').val();
		l_x = '1200';
		if (l_rate == 0){
			l_rate_value = 0;
		}else{
			var l_rate_value = parseFloat(l_rate)/ parseFloat(l_x);
		}

    total =  parseFloat(balance) +  parseFloat(acc_sur) +  parseFloat(acc_int);

    $("#adj_prin_bal").val(total);
    if (p2 == "Deferred Cash Payment")
      { 
        if (l_terms == 0){
          $("#monthly_amortization").val(0);
        }
        ma = total / l_terms;

        $("#monthly_amortization").val(ma);

    }else{
    var l_factor = parseFloat(l_rate_value)/(1-(1+parseFloat(l_rate_value))**(-parseFloat(l_terms)));

    if (l_factor == 0){
      return
    }

    l_factor = isNaN(l_factor) ? 0 : l_factor;
  
    var monthly_ma = parseFloat(total)*parseFloat(l_factor);
    monthly_ma = isFinite(monthly_ma) ? monthly_ma : 0;
    $("#fixed_factor").val(l_factor.toFixed(8));
    $("#monthly_amortization").val(monthly_ma.toFixed(2));
  }
  }


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

      $('#restructuring').submit(function(e){
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
				url:_base_url_+"classes/Master.php?f=create_restructured",
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
              end_loader();
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