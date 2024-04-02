<?php 
require_once('../../../config.php');

if(isset($_GET['id']) && ($_GET['cid'])) {
    $prop = $conn->query("SELECT * FROM pending_restructuring where md5(property_id) = '{$_GET['id']}' and id ='{$_GET['cid']}' ");    
    
    while($row=$prop->fetch_assoc()){
    
        ///LOT
        $cid = $row['id'];
        $prop_id = $row['property_id'];
        $account_status = $row['c_account_status'];
        $payment_type1 = $row['c_payment_type1'];
				$net_dp = $row['c_net_dp'];
				$less_dp = $row['less_dp'];
				$acc_surcharge1 = $row['acc_surcharge1'];
				$new_net_dp = ($net_dp - $less_dp) + $acc_surcharge1;
				$no_payments = $row['c_no_payments'];
				$monthly_down = $row['c_monthly_down'];
				$first_dp = $row['c_first_dp'];
				$full_down = $row['c_full_down'];
				$payment_type2 = $row['c_payment_type2'];	
				$amt_to_be_financed = $row['c_amt_financed'];	
				$acc_surcharge2 = $row['acc_surcharge2'];
				$acc_interest = $row['acc_interest'];
				$total_sur = $acc_surcharge1 + $acc_surcharge2;
				$terms= $row['c_terms'];
				$interest_rate = $row['c_interest_rate'];
				$fixed_factor = $row['c_fixed_factor'];
				$start_date = $row['c_start_date'];
				$monthly_amortization = $row['c_monthly_payment'];
				$mode = '1';
				$acc_status = $row['c_account_status'];
				$balance = $row['c_balance'];
				$balance = (float) str_replace(",", "", $balance);
				$new_amt_to_be_financed = $balance + $acc_interest + $acc_surcharge2;
			  $total_balance = $acc_surcharge1 + $new_amt_to_be_financed;
				$restructured_date = $row['c_restructured_date'];
				$amount_due = $acc_interest + $total_sur;


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
	<h3 class="card-title"><b>Restructured No: <i><?php echo $cid ?></i> </b></h3>
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
                        <input type="hidden" class="form-control margin-bottom required prop-id" name="prop_id" id="prop_id" value="<?php echo isset($prop_id) ? $prop_id : 0; ?>">
     
                        <label class="control-label">Balance:</label>
                        <input type="text" class="form-control margin-bottom required balance" name="balance" id="balance" value="<?php echo isset($balance) ? number_format($balance,2) : 0; ?>" tabindex = "1" readonly>
                    </div>
                </div>
                <div class="col-md-6">	
                    <div class="form-group">
                        <label class="control-label">Account Status: </label>
                        <input type="text" class="form-control margin-bottom required acc-status" name="acc_stat" id="acc_stat" value="<?php echo isset($account_status) ? $account_status : ''; ?>" tabindex ="1" readonly>
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">	
                  <div class="form-group">
                    <label class="control-label">Restructuring Date: </label>
                    <input type="date" class="form-control restructured-date" name="restructured_date" id="restructured_date" value="<?php echo date('Y-m-d'); ?>" readonly>
                  </div>
              </div>
          </div>
    <div class="space"></div>
    <div class="payment_box" id = "p1_box">
        <div class="col-md-12"  id = "pay_type1">	
            <label for="p1" class="control-label">Payment Type 1: </label>
            <input type="text" class="form-control margin-bottom required p1" name="p1_type" id="p1_type" value="<?php echo isset($payment_type1) ? $payment_type1 : ''; ?>" readonly>
        </div>	
      
    </div>
    <div class="payment_box2" id = "p2_box">
        <div class="col-md-12" id= "pay_type2">
            <label for="p2" class="control-label">Payment Type 2: </label>
            <input type="text" class="form-control margin-bottom required p2" name="p2_type" id="p2_type" value="<?php echo isset($payment_type2) ? $payment_type2 : ''; ?>" readonly>
          
        </div>
    </div>
    <div class="space"></div>
    <div class="payment_box" id="p1">
        <div class="col-md-12">
            <div class="form-group down-frm" id= "down_frm" >
                <label for="net_dp" class="control-label">Total DP Due: </label>
                <input type="text" class="form-control margin-bottom required net-dp" name="net_dp" id="net_dp" value="<?php echo isset($net_dp) ? $net_dp : 0; ?>" readonly>
                <label for="less_paymt_dte" class="control-label" >Less Paym't to Date : </label>
                <input type="text" class="form-control less-paymt-date" name="less_paymt_dte" id="less_paymt_dte" value="<?php echo isset($less_dp) ? $less_dp : 0; ?>" readonly>
                <label for="dp_bal" class="control-label">DP Balance : </label>
                <input type="text" class="form-control margin-bottom required dp-bal" name="dp_bal" id="dp_bal" value="<?php echo isset($new_net_dp) ? $new_net_dp : 0; ?>" readonly>
                <label for="acc_surcharge1" class="control-label" >Accrued Surcharge: </label>
                <input type="text" class="form-control margin-bottom required acc-surcharge1" name="acc_surcharge1" id="acc_surcharge1" value="<?php echo isset($acc_surcharge1) ? $acc_surcharge1 : 0; ?>" readonly>
                <label class="control-label">Rem. DP Term/s : </label>
                <input type="text" class="form-control margin-bottom required no-payment" name="no_payment" id="no_payment" value="<?php echo isset($no_payments) ? $no_payments : 0; ?>" maxlength= "2" readonly>
                <label class="control-label" id = "mo_down_text">Monthly Down: </label>
                <input type="text" class="form-control margin-bottom required monthly-down" name="monthly_down" value="<?php echo isset($monthly_down) ? $monthly_down : 0; ?>" id="monthly_down" readonly>
                <label class="control-label">Commencing: </label>
                <input type="date" class="form-control first-dp-date" name="first_dp_date" id = "first_dp_date" value="<?php echo isset($first_dp) ? $first_dp : ''; ?>" readonly>
                    
            
                <label class="control-label">Until: </label>
                
                <input type="date" class="form-control full-down-date" name="full_down_date" id = "full_down_date" value="<?php echo isset($full_down) ? $full_down : ''; ?>" readonly>
                    
                
            </div>
        </div>
    </div>		
    <div class="payment_box2" id="p2">	
        <div class="col-md-12">
             <label class="control-label" id ="amt_tobe_financed_text" >Amount to be Financed:</label>
             <input type="text" class="form-control margin-bottom required amt-to-be-financed" name="amt_to_be_financed" id="amt_to_be_financed" value="<?php echo isset($amt_to_be_financed) ? $amt_to_be_financed : 0; ?>" readonly>
             <label class="control-label" id="acc_int_text">Acc. Interest:</label>
             <input type="text" class="form-control margin-bottom required acc-interest" name="acc_interest" id="acc_interest" value="<?php echo isset($acc_interest) ? $acc_interest : 0; ?>" readonly>
             <label class="control-label"  id="acc_sur_text" >Acc. Surcharge:</label>
             <input type="text" class="form-control margin-bottom required acc-surcharge2" name="acc_surcharge2" id="acc_surcharge2" value="<?php echo isset($acc_surcharge2) ? $acc_surcharge2 : 0; ?>" readonly>
             <label class="control-label"  id="adj_text" >Adj. Principal Balance:</label>
             <input type="text" class="form-control margin-bottom required adj-prin-bal" name="adj_prin_bal" id="adj_prin_bal" value="<?php echo isset($new_amt_to_be_financed) ? $new_amt_to_be_financed : 0; ?>" readonly>
           
             <div class="form-group monthly-frm" id = "monthly_frm">
                <label class="control-label">Terms: </label>
                <input type="text" class="form-control margin-bottom required term-days" name="terms" id="terms" value="<?php echo isset($terms) ? $terms : 1; ?>" readonly>
                <label class="control-label" id='rate_text'>Interest Rate: </label>
                <input type="text" class="form-control margin-bottom required interest-rate" name="interest_rate" id="interest_rate" value="<?php echo isset($interest_rate) ? $interest_rate : 0; ?>" readonly>
                <label class="control-label" id='factor_text' >Fixed Factor: </label>
                <input type="text" class="form-control margin-bottom required fixed-factor" name="fixed_factor" id="fixed_factor" value="<?php echo isset($fixed_factor) ? $fixed_factor : 0; ?>" readonly>
                <label class="control-label">Monthly Payment: </label>
                <input type="text" class="form-control margin-bottom required monthly-amor" name="monthly_amortization" id="monthly_amortization" value="<?php echo isset($monthly_amortization) ? $monthly_amortization : 0; ?> "readonly>	
            </div>
            <label class="control-label" id= "start_text">Start Date: </label>	
        
            <input type="date" class="form-control required mo-start-date" name="start_date" id = "start_date" value="<?php echo isset($start_date) ? $start_date : ''; ?>" readonly>
                
            
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

});

</script>