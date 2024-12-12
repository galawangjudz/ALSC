<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<style>
	.nav-create{
        background-color:#007bff;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
    .nav-create:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }
</style>
<?php endif;?>
<?php 

$username = $_settings->userdata('username'); 

if(isset($_GET['id']) && $_GET['id'] > 0){
	$csr = $conn->query("SELECT x.*, y.* FROM t_csr x inner join t_additional_cost y on x.c_csr_no = y.c_csr_no where md5(x.c_csr_no) = '{$_GET['id']}' ");

	if($csr->num_rows > 0){
		while($row = $csr->fetch_assoc()):
			$prop_id = null;
			$c_csr_no =  $row['c_csr_no'];
			$lot_id = $row['c_lot_lid'];
			$csr_type = $row['c_type'];
			$lot_area = $row['c_lot_area'];
			$price_sqm = $row['c_price_sqm'];
			$lot_discount = $row['c_lot_discount'];
			$lot_discount_amt = $row['c_lot_discount_amt'];
			$house_model = $row['c_house_model'];
			$floor_area = $row['c_floor_area'];
			$house_price_sqm = $row['c_house_price_sqm'];
			$house_discount = $row['c_house_discount'];
			$house_discount_amt = $row['c_house_discount_amt'];
			$process_fee = $row['c_processing_fee'];
			$pf_month = $row['pf_mo'];
			$tcp_discount = $row['c_tcp_discount'];
			$tcp_discount_amt = $row['c_tcp_discount_amt'];
			$tcp = $row['c_tcp'];
			$vat_amt_computed = $row['c_vat_amount'];
			$net_tcp = $row['c_net_tcp'];
			$net_tcp1 = $row['c_net_tcp'];
			$reservation = $row['c_reservation'];
			$payment_type1 = $row['c_payment_type1'];
			$payment_type2 = $row['c_payment_type2'];
			$down_percent = $row['c_down_percent'];
			$net_dp = $row['c_net_dp'];
			$no_payments = $row['c_no_payments'];
			$monthly_down = $row['c_monthly_down'];
			$first_dp = $row['c_first_dp'];
			$full_down = $row['c_full_down'];
			$amt_financed = $row['c_amt_financed'];
			$terms = $row['c_terms'];
			$interest_rate = $row['c_interest_rate'];
			$fixed_factor = $row['c_fixed_factor'];
			$monthly_payment = $row['c_monthly_payment'];
			$start_date = $row['c_start_date'];
			$remarks = $row['c_remarks'];
			$date_created = $row['c_date_created'];
			$date_updated = $row['c_date_updated'];
			$floor_elev = $row['floor_elevation'];
			$aircon_outlets = $row['aircon_outlets'];
			$aircon_grill = $row['aircon_grill'];
			$conv_outlet = $row['conv_outlet'];
			$service_area = $row['service_area'];
			$others = $row['others'];
			$aircon_outlet_price = $row['aircon_outlet_price'];
			$aircon_grill_price = $row['aircon_grill_price'];
			$conv_outlet_price = $row['conv_outlet_price'];
			$service_area_price = $row['service_area_price'];
			$others_price = $row['others_price'];
			$floor_elev_price = $row['floor_elev_price'];

			$ac_outlet_subtotal = $aircon_outlets * $aircon_outlet_price;
			$ac_grill_subtotal = $aircon_grill * $aircon_grill_price;
			$conv_outlet_subtotal = $conv_outlet * $conv_outlet_price;
			$service_subtotal = $service_area * $service_area_price;
			$others_subtotal = $others * $others_price;

			$add_cost = $floor_elev_price + $ac_outlet_subtotal + $ac_grill_subtotal + $conv_outlet_subtotal + $service_subtotal + $others_subtotal;

			
			$lcp =($lot_area * $price_sqm) - $lot_discount_amt;
			$amount = $lot_area * $price_sqm;

			$hcp = ($floor_area * $house_price_sqm) - $house_discount_amt; 
			if ($vat_amt_computed == 0){
				$vat_percent = 0.00;
			}else{
				$vat_percent = round(($vat_amt_computed / $tcp) * 100,2) ;
				
			}
		endwhile;
	}

	$qry = $conn->query("SELECT x.*, y.c_acronym FROM t_lots x LEFT join t_projects y on x.c_site = y.c_code WHERE c_lid ='" . $conn->real_escape_string($lot_id) ."'");
	while($rows = $qry->fetch_assoc()):
		$phase = $rows['c_acronym'];
		$block = $rows['c_block'];
		$lot = $rows['c_lot'];
	endwhile;
}

?>

<style>
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
  padding-bottom:15px;
  margin-top:10px;
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
.nav-ra{
        background-color:#007bff;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1);
    }
	.nav-ra:hover{
        background-color:#007bff!important;
        color:white!important;
        box-shadow: 0 2px 2px 0 rgba(0, 0, 0, 0.2), 0 1px 1px 0 rgba(0, 0, 0, 0.1)!important;
    }

</style>

<style>
    /* General Styles */
.lot_box, .house_box {
    border: solid #36454F 1px;
    border-radius: 5px;
    padding: 15px;
    margin-bottom: 20px;
}

/* Form-section visibility */
.form-section {
    display: none; /* Hide by default */
}

.form-section.active {
    display: block; /* Show when active */
}

/* Media Queries for Responsiveness */
@media (min-width: 576px) {
    .lot_box, .house_box {
        width: 100%; /* Full width on small screens */
        float: none; /* Remove float on small screens */
    }
}

@media (min-width: 768px) {
    .lot_box, .house_box {
        width: 48%; /* Two boxes per row on medium screens */
        float: left;
        margin-right: 2%;
    }

    .lot_box:last-child, .house_box:last-child {
        margin-right: 0;
    }
}

@media (min-width: 992px) {
    .lot_box, .house_box {
        width: 32%; /* Three boxes per row on large screens */
        float: left;
        margin-right: 1.33%;
    }

    .lot_box:nth-child(3n), .house_box:nth-child(3n) {
        margin-right: 0;
    }
}

</style>

<div class="card card-outline rounded-0 card-blue">
	<div class="card-header">
		<h3 class="card-title"><b><i>New Reservation Application</b></i></h3>
	</div>
	<div class="card-body">
	<div class="container-fluid">
		<form method="" id="save_csr">
			<input type="hidden" name="username" value="<?php echo $_settings->userdata('username'); ?>">
			<input type="hidden" name="c_csr_no" value="<?php echo isset($c_csr_no) ? $c_csr_no : '';  ?>">
			<input type="hidden" name="prop_id" id="prop_id" value="<?php echo isset($prop_id) ? $prop_id : '';  ?>">
			<input type="hidden" name="comm" id="comm" value="<?php echo $username ?> added a new RA with reference #">
			<input type="hidden" name="comm2" id="comm2" value="<?php echo $username ?> updated RA with reference #">
			<div id="Buyer" class="tabcontent">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">	
							<div class="panel-body form-group form-group-sm">
								<table class="table3 table-bordered table-stripped" id="buyer_table" style="width:100%;">
									<thead>
										<tr>
											<th>
											<div class="panel-heading">
												<a href="#" class="btn btn-flat btn-primary float-left btn-md add-buyer-row" style="font-size:14px;"><span class="fa fa-plus" aria-hidden="true"></span></a>
												<div class="titles"><center> Buyer's Information Details</center></div>
												<div class="clear"></div>
											</div>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php 
											if(isset($_GET['id']) && $_GET['id'] > 0){
	
											$qry = $conn->query("SELECT * FROM t_csr_buyers where md5(c_csr_no) = '{$_GET['id']}' ");
											
											if($qry->num_rows > 0){	
												while($row = $qry->fetch_assoc()):
													$buyer_count = $row['c_buyer_count']; // customer buyers no
													$customer_last_name_1 = $row['last_name']; // customer last name
													$customer_suffix_name_1 = $row['suffix_name']; // customer suffix name
													$customer_first_name_1 = $row['first_name']; // customer first name
													$customer_middle_name_1 = $row['middle_name']; // customer middle name
													$customer_address_1 = $row['address']; // customer address
													$customer_zip_code = $row['zip_code']; // customer zip_code
													$customer_address_abroad = $row['address_abroad']; // customer address abroad
													$citizenship = $row['citizenship'];
													$id_presented = $row['id_presented'];
													$tin_no = $row['tin_no'];
													$birth_date = $row['birthdate']; // customer birthday
													$customer_age = $row['age']; // customer age
													$contact_no = $row['contact_no']; // customer phone 
													$contact_abroad = $row['contact_abroad']; // customer phone number
													$customer_email = $row['email']; // customer civil status
													$customer_viber= $row['viber']; // customer viber
													$customer_gender = $row['gender']; // customer phone number
													$civil_status = $row['civil_status']; // customer civil status

													$civil_status = $row['civil_status']; // customer civil status
													$relationship = $row['relationship'];		
										?>
										<tr>
											<td>
												<div class="form-group form-group-sm  no-margin-bottom">
													<div class="card-tools">
													<a href="#" class="btn btn-flat btn-danger float-right delete-buyer-row" style="font-size:14px;"><span class="fa fa-times" aria-hidden="true"></span></a>
													</div>
													<p class="select-customer"> <a href="#"  class="btn btn-flat bg-maroon" style="font-size:14px;"><span class="fa fa-plus" aria-hidden="true"></span>&nbsp;&nbsp;Select Existing Client</a></p>
												</div>
												<div class="main_box">
													<div class="row">
														<div class="col-md-3">		
															<div class="form-group">
															<label class="control-label">Last Name: </label>
																<input type="text" class="form-control margin-bottom buyer-last required" name="last_name[]" value="<?php echo isset($customer_last_name_1) ? $customer_last_name_1 : ''; ?>">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="control-label">First Name: </label>
																<input type="text" class="form-control margin-bottom buyer-first required" name="first_name[]" value="<?php echo isset($customer_first_name_1) ? $customer_first_name_1 : ''; ?>">
															</div>
															
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="control-label">Middle Name: </label>
																<input type="text" class="form-control margin-bottom buyer-middle" name="middle_name[]" value="<?php echo isset($customer_middle_name_1) ? $customer_middle_name_1 : ''; ?>">
															</div>
														</div>
														<div class="col-md-3">		
															<div class="form-group">
															<label class="control-label">Suffix Name: </label>
																<input type="text" class="form-control margin-bottom buyer-suffix" name="suffix_name[]" value="<?php echo isset($customer_suffix_name_1) ? $customer_suffix_name_1 : ''; ?>">
															</div>
														</div>
													</div>
													<hr>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Citizenship: </label>
																<input type="text" class="form-control margin-bottom buyer-ctzn required" name="citizenship[]" value="<?php echo isset($citizenship) ? $citizenship : ''; ?>">
															</div>
														</div>
														<div class="col-md-2">
															<label class="control-label">Civil Status: </label>
															<style>
																select:invalid { color: gray; }
															</style>
															<select name="civil_status[]" id="civil_status" class="form-control buyer-civil required">
															
																<option name="civil_status" value="Single" <?php echo isset($civil_status) && $civil_status == "Single" ? 'selected' : '' ?>>Single</option>
																<option name="civil_status" value="Married" <?php echo isset($civil_status) && $civil_status == "Married" ? 'selected' : '' ?>>Married</option>
																<option name="civil_status" value="Divorced" <?php echo isset($civil_status) && $civil_status == "Divorced" ? 'selected' : '' ?>>Divorced</option>
																<option name="civil_status" value="Widowed" <?php echo isset($civil_status) && $civil_status == "Widowed" ? 'selected' : '' ?>>Widowed</option>
															</select>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<style>
																	select:invalid { color: gray; }
																</style>
																<label class="control-label">Gender: </label>
																<select name="gender[]" id="customer_gender" class="form-control buyer-gender required">
																	
																		<option name="customer_gender" value="M" <?php echo isset($customer_gender) && $customer_gender == "M" ? 'selected' : '' ?>>Male</option>
																		<option name="customer_gender" value="F" <?php echo isset($customer_gender) && $customer_gender == "F" ? 'selected' : '' ?>>Female</option>
																</select>
															</div>
														</div>

														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Birthdate: </label>
																	<input type="text" class="form-control buyer-bday required datepicker" name="birth_day[]" placeholder="YYYY-MM-DD" value="<?php echo isset($birth_date) ? $birth_date : ''; ?>">

																	<!-- <input type="date" class="form-control buyer-bday required" name="birth_day[]" placeholder="YYYY-MM-DD" value="<?php echo isset($birth_date) ? $birth_date : ''; ?>">		
														 -->	</div>
														</div>
														<div class="col-md-1">
															<div class="form-group">
																<label class="control-label">Age: </label>
																<input type="text" class="form-control margin-bottom buyer-age required" name="age[]" id="age" value="<?php echo isset($customer_age) ? $customer_age : ''; ?> "readonly>
															</div>
														</div>	
														<div class="col-md-3">
															<div class="form-group">
																<style>
																	select:invalid { color: gray; }
																</style>
																<label class="control-label">Relationship: </label>
																<select name="relationship[]" id="relationship" class="form-control required">
																		<option name="customer_relation" value="0" <?php echo isset($relationship) && $relationship == 0 ? 'selected' : '' ?>>None</option>
																		<option name="customer_relation" value="1" <?php echo isset($relationship) && $relationship == 1 ? 'selected' : '' ?>>And</option>
																		<option name="customer_relation" value="2" <?php echo isset($relationship) && $relationship == 2 ? 'selected' : '' ?>>Spouses</option>
																		<option name="customer_relation" value="3" <?php echo isset($relationship) && $relationship == 3 ? 'selected' : '' ?>>Married To</option>
																		<option name="customer_relation" value="4" <?php echo isset($relationship) && $relationship == 4 ? 'selected' : '' ?>>Minor/Represented by Legal Guardian</option>
																</select>
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-3">
															<div class="form-group">
																<label class="control-label">Type of Valid ID Presented: </label>
																<input type="text" class="form-control margin-bottom" name="id_presented[]" value="<?php echo isset($id_presented) ? $id_presented : ''; ?>">
															</div>	
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Tin #: </label>
																<input type="text" class="form-control margin-bottom" name="tin_no[]" value="<?php echo isset($tin_no) ? $tin_no : ''; ?>">
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Contact Number: </label>
																<input type="text" class="form-control margin-bottom buyer-contact required" name="contact_no[]" value="<?php echo isset($contact_no) ? $contact_no: ''; ?>">
															</div>	
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Viber Account: </label>
																<input type="text" class="form-control margin-bottom buyer-viber" name="viber[]" value="<?php echo isset($customer_viber) ? $customer_viber : ''; ?>">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="control-label">Email Address: </label>
															
																<input type="email" class="form-control margin-bottom buyer-email required" name="email[]" value="<?php echo isset($customer_email) ? $customer_email : ''; ?>">
																
															</div>
														</div>
													</div>

													<div class="row">
														<div class="col-md-9">
															<div class="form-group">
																<label class="control-label">Residential/Billing Address: </label>
																<input type="text" class="form-control margin-bottom buyer-address required" name="address[]" value="<?php echo isset($customer_address_1) ? $customer_address_1 : ''; ?>">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="control-label">Area Code : </label>
																<input type="text" class="form-control margin-bottom buyer-zipcode required" name="zip_code[]" value="<?php echo isset($customer_zip_code) ? $customer_zip_code : ''; ?>">
															</div>
														</div>
														<div class="col-md-9">
															<div class="form-group">
																<label class="control-label">Address Abroad (if any): </label>
																<input type="text" class="form-control margin-bottom buyer-add-abroad" name="address_abroad[]" value="<?php echo isset($customer_address_abroad) ? $customer_address_abroad : ''; ?>">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="control-label">Contact Number Abroad : </label>
																<input type="text" class="form-control margin-bottom" name="contact_abroad[]" value="<?php echo isset($contact_abroad) ? $contact_abroad : ''; ?>">
															</div>
														</div>
													</div>  
												</div>
											</td>	
										</tr>
											<?php 

												endwhile;
											}	
											}
											else{
												?>
												<tr>
											
												<td>
													<div class="form-group form-group-sm  no-margin-bottom">
														<div class="card-tools" style="margin-top:5px;">
														<a href="#" class="btn btn-flat btn-danger float-right delete-buyer-row" style="font-size:14px;"><span class="fa fa-times" aria-hidden="true"></span></a>
														</div>
														<p class="select-customer"> <a href="#"  class="btn btn-flat bg-maroon" style="font-size:14px;"><span class="fa fa-plus" aria-hidden="true"></span>&nbsp;&nbsp;Select Existing Client</a></p>
											
													</div>
													<div class="main_box">
													
														<div class="row">
															<div class="col-md-3">		
																<div class="form-group">
																<label class="control-label">Last Name: </label>
																	<input type="text" class="form-control margin-bottom buyer-last required" name="last_name[]" value="<?php echo isset($customer_last_name_1) ? $customer_last_name_1 : ''; ?>">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label class="control-label">First Name: </label>
																	<input type="text" class="form-control margin-bottom buyer-first required" name="first_name[]" value="<?php echo isset($customer_first_name_1) ? $customer_first_name_1 : ''; ?>">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label class="control-label">Middle Name: </label>
																	<input type="text" class="form-control margin-bottom buyer-middle" name="middle_name[]" value="<?php echo isset($customer_middle_name_1) ? $customer_middle_name_1 : ''; ?>">
																</div>
															</div>
															<div class="col-md-3">		
																<div class="form-group">
																<label class="control-label">Suffix Name: </label>
																	<input type="text" class="form-control margin-bottom buyer-suffix" name="suffix_name[]" value="<?php echo isset($customer_suffix_name_1) ? $customer_suffix_name_1 : ''; ?>">
																</div>
															</div>
														</div>
														<hr>
														<div class="row">
															<div class="col-md-2">
																<div class="form-group">
																	<label class="control-label">Citizenship: </label>
																	<input type="text" class="form-control margin-bottom buyer-ctzn required" name="citizenship[]" value="<?php echo isset($citizenship) ? $citizenship : ''; ?>">
																</div>
															</div>
															<div class="col-md-2">
																<label class="control-label">Civil Status: </label>
																<style>
																	select:invalid { color: gray; }
																</style>
																<select name="civil_status[]" id="civil_status" class="form-control buyer-civil required">
																
																	<option name="civil_status" value="Single" <?php echo isset($civil_status) && $civil_status == "Single" ? 'selected' : '' ?>>Single</option>
																	<option name="civil_status" value="Married" <?php echo isset($civil_status) && $civil_status == "Married" ? 'selected' : '' ?>>Married</option>
																	<option name="civil_status" value="Divorced" <?php echo isset($civil_status) && $civil_status == "Divorced" ? 'selected' : '' ?>>Divorced</option>
																	<option name="civil_status" value="Widowed" <?php echo isset($civil_status) && $civil_status == "Widowed" ? 'selected' : '' ?>>Widowed</option>
																</select>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<style>
																		select:invalid { color: gray; }
																	</style>
																	<label class="control-label">Gender: </label>
																	<select name="gender[]" id="customer_gender" class="form-control buyer-gender required">
																		
																			<option name="customer_gender" value="M" <?php echo isset($customer_gender) && $customer_gender == "M" ? 'selected' : '' ?>>Male</option>
																			<option name="customer_gender" value="F" <?php echo isset($customer_gender) && $customer_gender == "F" ? 'selected' : '' ?>>Female</option>
																	</select>
																</div>
															</div>
	
															<div class="col-md-2">
																<div class="form-group">
																	<label class="control-label">Birthdate: </label>
																		<input type="text" class="form-control buyer-bday required datepicker" name="birth_day[]" placeholder="YYYY-MM-DD" value="<?php echo isset($birth_date) ? $birth_date : ''; ?>">
																	<!-- 	<input type="date" class="form-control buyer-bday required" name="birth_day[]" placeholder="YYYY-MM-DD" value="<?php echo isset($birth_date) ? $birth_date : ''; ?>">		 -->
																	
																
																</div>
															</div>
															<div class="col-md-1">
																<div class="form-group">
																	<label class="control-label">Age: </label>
																	<input type="text" class="form-control margin-bottom buyer-age required" name="age[]" id="age" value="<?php echo isset($customer_age) ? $customer_age : ''; ?> "readonly>
																</div>
															</div>	
																	
															<div class="col-md-3">
																<div class="form-group">
																	<style>
																		select:invalid { color: gray; }
																	</style>
																	<label class="control-label">Relationship: </label>
																	<select name="relationship[]" id="relationship" class="form-control required">
																			<option name="customer_relation" value="0" <?php echo isset($relationship) && $relationship == 0 ? 'selected' : '' ?>>None</option>
																			<option name="customer_relation" value="1" <?php echo isset($relationship) && $relationship == 1 ? 'selected' : '' ?>>And</option>
																			<option name="customer_relation" value="2" <?php echo isset($relationship) && $relationship == 2 ? 'selected' : '' ?>>Spouses</option>
																			<option name="customer_relation" value="3" <?php echo isset($relationship) && $relationship == 3 ? 'selected' : '' ?>>Married To</option>
																			<option name="customer_relation" value="4" <?php echo isset($relationship) && $relationship == 4 ? 'selected' : '' ?>>Minor/Represented by Legal Guardian</option>
		
																	</select>
																</div>
															</div>
														</div>

														
														<div class="row">
															<div class="col-md-3">
																<div class="form-group">
																	<label class="control-label">Type of Valid ID Presented: </label>
																	<input type="text" class="form-control margin-bottom" name="id_presented[]" value="<?php echo isset($id_presented) ? $id_presented : ''; ?>">
																</div>	
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label class="control-label">Tin #: </label>
																	<input type="text" class="form-control margin-bottom" name="tin_no[]" value="<?php echo isset($tin_no) ? $tin_no : ''; ?>">
																</div>
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label class="control-label">Contact Number: </label>
																	<input type="text" class="form-control margin-bottom buyer-contact required" name="contact_no[]" value="<?php echo isset($contact_no) ? $contact_no: ''; ?>">
																</div>	
															</div>
															<div class="col-md-2">
																<div class="form-group">
																	<label class="control-label">Viber Account: </label>
																	<input type="text" class="form-control margin-bottom buyer-viber" name="viber[]" value="<?php echo isset($customer_viber) ? $customer_viber : ''; ?>">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label class="control-label">Email Address: </label>
																
																	<input type="email" class="form-control margin-bottom buyer-email required" name="email[]" value="<?php echo isset($customer_email) ? $customer_email : ''; ?>">
																	
																</div>
															</div>
														</div>
	
														<div class="row">
															<div class="col-md-9">
																<div class="form-group">
																	<label class="control-label">Residential/Billing Address: </label>
																	<input type="text" class="form-control margin-bottom buyer-address required" name="address[]" value="<?php echo isset($customer_address_1) ? $customer_address_1 : ''; ?>">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label class="control-label">Area Code : </label>
																	<input type="text" class="form-control margin-bottom buyer-zipcode required" name="zip_code[]" value="<?php echo isset($customer_zip_code) ? $customer_zip_code : ''; ?>">
																</div>
															</div>
															<div class="col-md-9">
																<div class="form-group">
																	<label class="control-label">Address Abroad (if any): </label>
																	<input type="text" class="form-control margin-bottom buyer-add-abroad" name="address_abroad[]" value="<?php echo isset($customer_address_abroad) ? $customer_address_abroad : ''; ?>">
																</div>
															</div>
															<div class="col-md-3">
																<div class="form-group">
																	<label class="control-label">Contact Number Abroad : </label>
																	<input type="text" class="form-control margin-bottom" name="contact_abroad[]" value="<?php echo isset($contact_abroad) ? $contact_abroad : ''; ?>">
																</div>
															</div>
														</div>  

													</div>
												
												</td>	
											</tr>
											<?php
												
											}
														
											
											?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="Investment" class="tabcontent">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							
							<div class="panel-body form-group form-group-sm">
								
								<div class="row">
									<div class="col-md-4">
										<?php
										// Assuming you have a valid ODBC connection in $conn2

										// Query to fetch project options
										$query = "SELECT DISTINCT c_province FROM t_projects"; // Adjust the query according to your schema
										$result = odbc_exec($conn2, $query);

										if (!$result) {
											die("Query failed: " . odbc_errormsg($conn2));
										}

										// Generate the options for the select element
										$options = '<option value="">Select Location</option>';
										while ($row = odbc_fetch_array($result)) {
											$options .= '<option value="' . htmlspecialchars($row['c_province']) . '">' . htmlspecialchars($row['c_province']) . '</option>';
										}

										// Close the connection
										odbc_close($conn2);
										?>
										<div class="form-group">
											<label for="location">Location <span class="req">*</span></label>
											<div style="display:flex;flex-flow:row;">
												<select class="form-control" name="location" id="location">
													<?php echo $options; ?>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="project_map">Project /Phase <span class="req">*</span></label>
											<div style="display:flex;flex-flow:row;">
												<select class="form-control" name="project_map" id="project_map">
													<option value="">Select Project</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="block_lot">Block-Lot <span class="req">*</span></label>
											<div style="display:flex;flex-flow:row;">
												<select class="form-control" name="block_lot" id="block_lot">
													<option value="">Select Block</option>
												</select>
											</div>
										</div>
										<div class="form-group">
											<label for="house_model">House Model <span class="req">*</span></label>
											<div style="display:flex;flex-flow:row;">
												<select class="form-control" name="house_model" id="house_model">
													<option value="">Select House Model</option>
												</select>
											</div>
										</div>
										
										<div class="form-group">
											<label for="house_model">Less: Discount(%) <span class="req">*</span></label>
											<div style="display:flex;flex-flow:row;">
											<input type="text" class="form-control margin-bottom tcp-disc" name="tcp_disc" id="tcp_disc" value="<?php echo isset($tcp_discount) ? $tcp_discount : 0; ?>">
											</div>
										</div>
									</div>
									<div class="col-md-8">
										<table class="table table-sm">
											<thead class="thead-dark">
												<tr>
													<th scope="col">&nbsp;</th>
													<th scope="col" class="text-right">SUMMARY</th>
													<th scope="col">&nbsp;</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<th scope="row" width="30%">Total Contract Price</th>
													<td class="text-right" width="30%">PHP 3,033,562.00</td>
													<th scope="col">&nbsp;</th>
												</tr>
												<tr>
													<th scope="row">Less: Discount(%)</th>
													<td class="text-right">PHP 455,034.00</td>
													<th scope="col">&nbsp;</th>
												</tr>
												<tr>
													<th scope="row">Processing Fee</th>
													<td class="text-right">PHP 3,033,562.00</td>
													<th scope="col">Vat</th>
												</tr>
												<tr>
													<th scope="row" width="30%">Total Net Contract Price</th>
													<td class="text-right" width="30%">PHP 0.00</td>
													<th scope="col">&nbsp;</th>
												</tr>
												<tr>
													<th scope="row">Less: Reservation Fee</th>
													<td class="text-right">PHP 30,000.00</td>
													<th scope="col">&nbsp;</th>
												</tr>
												<tr>
													<th scope="row">Less: Discount (.00%)</th>
													<td class="text-right">PHP 0.00</td>
													<th scope="col">&nbsp;</th>
												</tr>
												<tr>
													<th class="text-right" scope="row">Amount Due</th>
													<td class="text-right">PHP 425,034.00</td>
													<th scope="col"></th>
												</tr>
												<tr>
													<th class="text-right" scope="row">15.00%(36)</th>
													<td class="text-right">PHP 11,807.00</td>
													<th scope="col">Month 1 to 36</th>
												</tr>
												<tr>
													<th class="text-right" scope="row">Balance(85%)</th>
													<td class="text-right">PHP 2,578,528.00</td>
													<th scope="col">Upon Turnover</th>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
								
							
						</div>
					</div>
				</div>    
			</div>

			<div id="Payment" class="tabcontent">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
							<div class="panel-heading">
								<div class="titles">Payment Computation</div>
							</div>
							<div class="panel-body form-group form-group-sm">
								<div class="main_box">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Total Selling Price:</label>
												<input type="text" class="form-control margin-bottom required net-tcp-1" name="net_tcp1" id="net_tcp1" value="<?php echo isset($net_tcp1) ? $net_tcp1 : 0; ?>" tabindex = "1" >
											</div>
										</div>
										<div class="col-md-6">	
											<div class="form-group">
												<label class="control-label">Reservation: </label>
												<input type="text" class="form-control margin-bottom required reservation-fee" name="reservation" id="reservation" value="<?php echo isset($reservation) ? $reservation : 0; ?>" tabindex ="1" required>
											</div>
										</div>
									</div>
								</div>
								<div class="space"></div>
								<div class="payment_box">
									<div class="col-md-12"  id = "pay_type1">	
										<label class="control-label">Payment Type 1: </label>
										<div class="form-group">
										<style>
											select:invalid { color: gray; }
										</style>
										<select name="payment_type1" id="payment_type1" class="form-control required payment-type1" tabindex = "2">
											<option name="payment_type1" value="Partial DownPayment" <?php echo isset($payment_type1) && $payment_type1 == "Partial DownPayment" ? 'selected' : '' ?>>Partial DownPayment</option>
											<option name="payment_type1" value="Full DownPayment" <?php echo isset($payment_type1) && $payment_type1 == "Full DownPayment" ? 'selected' : '' ?>>Full DownPayment</option>
											<option name="payment_type1" value="No DownPayment" <?php echo isset($payment_type1) && $payment_type1 == "No DownPayment" ? 'selected' : '' ?>>No DownPayment</option>
											<option name="payment_type1" value="Spot Cash" <?php echo isset($payment_type1) && $payment_type1 == "Spot Cash" ? 'selected' : '' ?>>Spot Cash</option>
										</select>	
									</div>	
								</div>
								</div>
								<div class="payment_box2">
									<div class="col-md-12 " id= "pay_type2">
										<label class="control-label">Payment Type 2: </label>
										<div class="form-group">
											<style>
												select:invalid { color: gray; }
											</style>
											<select name="payment_type2" id="payment_type2" class="form-control required payment-type2" tabindex = "3" >
												<option name="payment_type2" value="None" <?php echo isset($payment_type2) && $payment_type2 == "None" ? 'selected' : '' ?>>None</option>
												<option name="payment_type2" value="Monthly Amortization" <?php echo isset($payment_type2) && $payment_type2 == "Monthly Amortization" ? 'selected' : '' ?>>Monthly Amortization</option>
												<option name="payment_type2" value="Deferred Cash Payment" <?php echo isset($payment_type2) && $payment_type2 == "Deferred Cash Payment" ? 'selected' : '' ?>>Deferred Cash Payment</option>
											</select>	
										</div>
									</div>
								</div>
								<div class="space"></div>
								<div class="payment_box" id="p1">
									<div class="col-md-12">
										<div class="form-group down-frm" id= "down_frm" >
											<label class="control-label">Down %: </label>
											<input type="text" class="form-control margin-bottom required down-percent" name="down_percent" id="down_percent" value="<?php echo isset($down_percent) ? $down_percent : 0; ?>">
											<label class="control-label">Net DP: </label>
											<input type="text" class="form-control margin-bottom required net-dp" name="net_dp" id="net_dp" value="<?php echo isset($net_dp) ? $net_dp : 0; ?>">
											<label class="control-label" id= "no_pay_text"># Payments : </label>
											<input type="text" class="form-control margin-bottom required no-payment" name="no_payment" id="no_payment" value="<?php echo isset($no_payments) ? $no_payments : 0; ?>" maxlength= "2">
											<label class="control-label" id = "mo_down_text">Monthly Down: </label>
											<input type="text" class="form-control margin-bottom required monthly-down" name="monthly_down" value="<?php echo isset($monthly_down) ? $monthly_down : 0; ?>" id="monthly_down" >
											<label class="control-label">First DP: </label>
											<input type="date" class="form-control first-dp-date" name="first_dp_date" id = "first_dp_date" value="<?php echo isset($first_dp) ? $first_dp : ''; ?>">
												
										
											<label class="control-label">Full Down: </label>
											
											<input type="date" class="form-control full-down-date" name="full_down_date" id = "full_down_date" value="<?php echo isset($full_down) ? $full_down : ''; ?>">
												
											
										</div>
									</div>
								</div>		
								<div class="payment_box2" id="p2">	
									<div class="col-md-12">
										<label class="control-label" id='loan_text'>Amount to be Financed:</label>
										<input type="text" class="form-control margin-bottom required amt-to-be-financed" name="amt_to_be_financed" id="amt_to_be_financed" value="<?php echo isset($amt_financed) ? $amt_financed : 0; ?>">
										<div class="form-group monthly-frm" id = "monthly_frm">
											<label class="control-label">Terms: </label>
											<input type="text" class="form-control margin-bottom required terms-count" name="terms" id="terms" value="<?php echo isset($terms) ? $terms : 1; ?>">
											<label class="control-label" id='rate_text'>Interest Rate: </label>
											<input type="text" class="form-control margin-bottom required interest-rate" name="interest_rate" id="interest_rate" value="<?php echo isset($interest_rate) ? $interest_rate : 0; ?>">
											<label class="control-label" id='factor_text' >Fixed Factor: </label>
											<input type="text" class="form-control margin-bottom required fixed-factor" name="fixed_factor" id="fixed_factor" value="<?php echo isset($fixed_factor) ? $fixed_factor : 0; ?>">
											<label class="control-label">Monthly Payment: </label>
											<input type="text" class="form-control margin-bottom required monthly-amor" name="monthly_amortization" id="monthly_amortization" value="<?php echo isset($monthly_payment) ? $monthly_payment : 0; ?>">	
										</div>
										<label class="control-label" id= "start_text">Start Date: </label>	
									
										<input type="date" class="form-control required mo-start-date" name="start_date" id = "start_date" value="<?php echo isset($start_date) ? $start_date : ''; ?>">
											
										
									</div>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="Agents and Commission" class="tabcontent">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
								<div class="panel-heading">
								<div class="titles"><center>Agent and Commission</center></div>
									<div class="clear"></div>
								</div>
							<div class="panel-body form-group form-group-sm">
								<table class="table3 table-bordered table-hover table-striped" id="comm_table" style="width:100%;">
									<thead>
										<tr>
											<th width="20">
												<a href="#" class="btn btn-flat btn-primary btn-md add-row" style="font-size:14px;margin-left:5px;"><span class="fa fa-plus" aria-hidden="true"></span></a>
											</th>
											<th width="500">
												<label class="control-label">&nbsp;Agents</label>
											</th>
											<th  width="90">
											<label class="control-label">&nbsp;Position</label>
											</th>
											<th width="90">
												<label class="control-label">&nbsp;Code</label>
											</th>
											<th width="150">
												<label class="control-label">&nbsp;Rate</label>
											</th>
											<th width="200">
												<label class="control-label">&nbsp;Amount</label>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										if(isset($_GET['id']) && $_GET['id'] > 0){
										$qry = $conn->query("SELECT * FROM t_csr_commission WHERE md5(c_csr_no) ='{$_GET['id']}'");
										while($rows = $qry->fetch_assoc()):
											$agent_name = $rows['c_agent'];
											$position = $rows['c_position'];
											$code = $rows['c_code'];
											$rate = $rows['c_rate'];
											$comm_amt = $rows['c_amount'];
										?>
										<tr>
											<td>
												<a href="#" class="btn btn-danger delete-row" style="font-size:14px;"><span class="fa fa-times" ></span></a>
											</td>
											<td style="padding-top:10px;">
												<!-- <a href="#" class="btn btn-danger btn-md delete-row"><span class="fa fa-times" aria-hidden="true"></span></a> -->
												
												<div class="form-group form-group-sm">
													<input type="text" style="width:60%" class="form-control form-group-sm item-input agent-name" name="agent_name[]" value="<?php echo isset($agent_name) ? $agent_name : ''; ?>">
													<p class="item-select"> <a href="#"  class="btn btn-flat btn-md bg-maroon" style="font-size:14px;"><span class="fa fa-search" aria-hidden="true"></span>&nbsp;&nbsp;Select Existing Agent</a></p>
									
												</div>
											</td>
											<td style="padding-top:10px;">
													<input type="text" class="form-control agent-pos" name="agent_position[]" value="<?php echo isset($position) ? $position : ''; ?>" readonly>
											</td>
											<td style="padding-top:10px;">
													<input type="text" class="form-control agent-code" name="agent_code[]" value="<?php echo isset($code) ? $code : ''; ?>" readonly>
											</td>
											<td style="padding-top:10px;">
													<input type="text" class="form-control calculate agent-rate required" name="agent_rate[]" value="<?php echo isset($rate) ? $rate : 0; ?>">
											</td>
											<td style="padding-top:10px;">
													<input type="text" class="form-control comm-amt" name="comm_amt[]" value="<?php echo isset($comm_amt) ? $comm_amt : 0; ?>" >
											</td>
										</tr>
										<?php endwhile; 
										
										}else{ ?>
											<tr><td>
												<a href="#" class="btn btn-flat btn-danger delete-row" style="font-size:14px;margin-left:5px;"><span class="fa fa-times" ></span></a>
											</td>
											<td style="padding-top:10px;">
												<!-- <a href="#" class="btn btn-danger btn-md delete-row"><span class="fa fa-times" aria-hidden="true"></span></a> -->
												
												<div class="form-group form-group-sm no-margin-bottom">
													<input type="text" style="width:60%" class="form-control form-group-sm item-input agent-name" name="agent_name[]" value="<?php echo isset($agent_name) ? $agent_name : ''; ?>">
													<p class="item-select" style="margin-top:5px;"> <a href="#"  class="btn btn-flat btn-md bg-maroon" style="font-size:14px;"><span class="fa fa-search" aria-hidden="true"></span>&nbsp;&nbsp;Select Existing Agent</a></p>
									
												</div>
											</td>
											<td>
												<div class="form-group form-group-sm" style="padding-top:10px;margin-top:-35px;">
													<input type="text" class="form-control agent-pos" name="agent_position[]" value="<?php echo isset($position) ? $position : ''; ?>" readonly>
												</div>
											</td>
											<td>
												<div class="form-group form-group-sm" style="padding-top:10px;margin-top:-35px;">
													
													<input type="text" class="form-control agent-code" name="agent_code[]" value="<?php echo isset($code) ? $code : ''; ?>" aria-describedby="sizing-addon1" readonly>
												</div>
											</td>
											<td>
												<div class="form-group form-group-sm" style="padding-top:10px;margin-top:-35px;">
													<input type="number" class="form-control calculate agent-rate required" name="agent_rate[]" value="<?php echo isset($rate) ? $rate : 0; ?>">
												</div>
											</td>
											<td>
												<div class="form-group form-group-sm" style="padding-top:10px;margin-top:-35px;">
													<input type="text" class="form-control comm-amt" name="comm_amt[]" value="<?php echo isset($comm_amt) ? $comm_amt : 0; ?>" aria-describedby="sizing-addon1">
												</div>
											</td>
										</tr>
										<?php }
										?>
									</tbody>
								</table>
								<hr>
								<div class="space"></div>
									<div class="main_box">
								
					
										<div class="row">
											<div class="col-md-12">
												<label class="control-label">Additional Notes: </label>
												<div class="input-group form-group-sm textarea no-margin-bottom">
													<textarea class-"form-control" name="invoice_notes" id="invoice_notes"></textarea>
												</div>	
											</div>
										</div>
									</div>
								
									<!-- <div class="col-md-12 margin-top btn-group">
										<input type="submit" id="create_csr" class="btn btn-success float-right btn-l" value="Create CSR" data-loading-text="Creating...">
									</div> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			</div>
		</form>
    </div>
    </div>


<div id="insert_customer" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Client Details</h5>
			</div>
			<div class="modal-body">
				<table class="table2 table-bordered table-stripped" style="width:100%;font-size:16px;">
					<thead>
						<tr>

						<th style="text-align:center;">Last Name</th>
						<th style="text-align:center;">First Name</th>
						<th style="text-align:center;">Middle Name</th>
						<th style="text-align:center;">Email</th>
						<th style="text-align:center;">Phone</th>
						<th style="text-align:center;">Actions</th>

						</tr>
					</thead>
					<tbody>
					<?php
					$type = $_settings->userdata('type');
					$username = $_settings->userdata('username');
					$where = "c_created_by = '$username'";
					if ($type < 5 ){
	
						$query =$conn->query("SELECT * FROM t_buyer_info ORDER BY last_name ASC");
					}else{
						$query = $conn->query("SELECT * FROM t_buyer_info where ".$where." ORDER BY last_name ASC");
					}
	
					//$query =$conn->query("SELECT * FROM t_buyer_info ORDER BY last_name ASC");

					while($row = $query->fetch_assoc()): ?>

						<tr>
							<td style="text-align:center;"><?php echo $row["last_name"] ?></td>
							<td style="text-align:center;"><?php echo $row["first_name"] ?></td>
							<td style="text-align:center;"><?php echo $row["middle_name"] ?></td>
							<td style="text-align:center;"><?php echo $row["email"] ?></td>
							<td style="text-align:center;"><?php echo $row["contact_no"] ?></td>
							<td style="text-align:center;"><a href="#" class="btn btn-flat btn-primary btn-xs customer-select" data-customer-civil="<?php echo $row['civil_status']?>" data-customer-gender="<?php echo $row['gender'] ?>" data-customer-age="<?php echo $row['age'] ?>" data-customer-birthday="<?php echo $row['birthdate'] ?>" data-customer-viber="<?php echo $row['viber'] ?>" data-customer-address-1="<?php echo $row['address'] ?>" data-customer-zip-code="<?php echo $row['zip_code'] ?>"  data-customer-address-abroad="<?php echo $row['address_abroad'] ?>" data-customer-lname="<?php echo $row['last_name'] ?>" data-customer-fname="<?php echo $row['first_name'] ?>" data-customer-mname="<?php echo $row['middle_name'] ?>" data-customer-sname="<?php echo $row['suffix_name'] ?>" data-customer-email="<?php echo $row['email'] ?>" data-customer-phone="<?php echo $row['contact_no'] ?>" data-customer-ctzn="<?php echo $row['citizenship'] ?>"  style="width:100%;font-size:14px;"><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>&nbsp;&nbsp;Select</a></td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-flat btn-default" data-dismiss="modal" style="width:100%; margin-left:5px;font-size:14px;"><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</button>
		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div id="insert_lot" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		<div class="modal-header">
			<!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			 --><h4 class="modal-title">Select Lot</h4>
		</div>
		<div class="modal-body">			
			<table class="table table-bordered table-stripped">
				<thead>
					<tr>
						<th style="text-align:center;">Lot ID</th>
						<th style="text-align:center;">Project</th>
						<th style="text-align:center;">Block</th>
						<th style="text-align:center;">Lot</th>
						<th style="text-align:center;">Status </th>
						<th style="text-align:center;">Actions</th>
					</tr>
				</thead>
				<tbody>
				<?php
				$query =$conn->query("SELECT c_lid, c.c_acronym, h.c_house_lid, h.c_house_model, h.c_floor_area, 
				h.c_h_price_sqm , i.c_block, i.c_lot, i.c_status, i.c_lot_area, i.c_price_sqm 
				FROM t_lots i 
				LEFT JOIN t_projects c 
				ON i.c_site = c.c_code
				LEFT JOIN t_house h  
				ON i.c_house_lid = h.c_house_lid
				WHERE i.c_site = c.c_code  and  (i.c_status = 'Available' )
				ORDER BY c.c_acronym, i.c_block, i.c_lot");

				while($row = $query->fetch_assoc()): ?>
					<tr>
						<td style="text-align:center;"><?php echo $row["c_lid"] ?></td>
						<td style="text-align:center;"><?php echo $row["c_acronym"] ?></td>
						<td style="text-align:center;"><?php echo $row["c_block"] ?></td>
						<td style="text-align:center;"><?php echo $row["c_lot"] ?></td>
						<td style="text-align:center;"><?php echo $row["c_status"] ?></td>
						<td style="text-align:center;"><a href="#" class="btn btn-flat btn-primary btn-xs lot-select" data-lot-lid="<?php echo $row['c_lid'] ?>" data-house-lid="<?php echo $row['c_house_lid'] ?>" data-floor-area="<?php echo $row['c_floor_area'] ?>" data-house-price="<?php echo $row['c_h_price_sqm'] ?>" data-house-model="<?php echo $row['c_house_model'] ?>" data-lot-site="<?php echo $row['c_acronym'] ?>" data-lot-block="<?php echo $row['c_block'] ?>" data-lot-lot="<?php echo $row['c_lot'] ?>" data-lot-lot-area="<?php echo $row['c_lot_area'] ?>" data-lot-per-sqm="<?php echo $row['c_price_sqm'] ?>" style="width:100%;font-size:14px;"><center><i class="fa fa-arrow-circle-right" aria-hidden="true"></i>&nbsp;&nbsp;Select</center></a></td>
					</tr>
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn btn-flat btn-default"  style="width:100%; margin-left:5px;font-size:14px;"><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</button>
		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->	
</div><!-- /.modal -->
<div id="insert" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<!-- <h4 class="modal-title" style="float:left;font-size:16px;">Select Agent</h4> -->
			</div>
			<div class="modal-body">
				<div class="form-group">
				<label for="agent_name" class="control-label">Agents</label>
					<select class="form-control item-select">
						<?php 
							$i = 0;
							$qry = $conn->query("SELECT * FROM t_agents ORDER BY c_last_name ASC");
							while($row = $qry->fetch_assoc()):
							$i++;
						?>
						<option value="<?php echo $row['c_code'] ?> - <?php echo $row["c_position"] ?> "><?php echo $row["c_last_name"] ?> , <?php echo $row["c_first_name"] ?> </option>
						<?php endwhile; ?>
					</select>
				</div>
			</div>
			<div class="modal-footer">
				<table style="width:100%;">
					<tr>
						<td>
							<button type="button" data-dismiss="modal" class="btn btn-flat btn-default bg-primary" id="selected" style="width:100%; margin-right:5px;font-size:14px;"><i class="fa fa-plus" aria-hidden="true"></i>&nbsp;&nbsp;Add</button>
						</td>
						<td>
							<button type="button" data-dismiss="modal" class="btn btn-flat btn-default" style="width:100%; margin-left:5px;font-size:14px;"><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Cancel</button>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</div>
</body>
<script>

<script>
	
	$(".buyer-bday").on("change", function() {
            // Get the entered date value
            var enteredDate = $(this).val();
            // Check if the entered date is in YYYY-MM-DD format
            var datePattern = /^\d{4}-\d{2}-\d{2}$/;
            if (datePattern.test(enteredDate)) {
				$(this).parent().removeClass("has-error");
				
                // Split the entered date into year, month, and day
                var parts = enteredDate.split("-");
                var year = parseInt(parts[0], 10);
                var month = parseInt(parts[1], 10);
                var day = parseInt(parts[2], 10);

                // Calculate the age
                var currentDate = new Date();
                var age = currentDate.getFullYear() - year;

                // If the birthday hasn't occurred yet this year, subtract 1 from age
                if (
                    currentDate.getMonth() + 1 < month ||
                    (currentDate.getMonth() + 1 === month && currentDate.getDate() < day)
                ) {
                    age--;
                }

                // Update the age input field
                $("#age").val(age);
            } else {
                // If the entered date is not in the correct format, you can handle the error here.
                // For example, you can display a message to the user or clear the age field.
				
				$(this).parent().addClass("has-error");
				$(".buyer-bday").val("");
                $("#age").val("");
                alert_toast("Please enter a valid date in YYYY-MM-DD format.",'error');
            }
        });

	$(".buyer-first").on("input", function() {
		validateNoSpecialChars(this);
    });

	$(".convert-num").on("blur", function() {
		formatNumber(this);
	});
		
	$(document).ready(function(){
		$('.table').dataTable();

		$('.table2').dataTable();

		const today = new Date();
		const myDateInput = document.getElementById("first_dp_date");
		const myDateInput2 = document.getElementById("full_down_date");
		const myDateInput3 = document.getElementById("start_date");
		myDateInput.value = today.toISOString().substr(0, 10);
		myDateInput2.value = today.toISOString().substr(0, 10);
		myDateInput3.value = today.toISOString().substr(0, 10);
	})

	function redirectToMail() {
        window.location.href = "./mail.php";
    }
	function tabclicked1(){
		document.getElementById('activation_text').value='1';
		document.getElementById('onlink1').style.backgroundColor="#ccc";
		document.getElementById('onlink2').style.backgroundColor="#f1f1f1";
		document.getElementById('onlink3').style.backgroundColor="#f1f1f1";
		document.getElementById('onlink4').style.backgroundColor="#f1f1f1";
	}
	function tabclicked2(){
		document.getElementById('activation_text').value='0';
		document.getElementById('onlink1').style.backgroundColor="#f1f1f1";
		document.getElementById('onlink2').style.backgroundColor="#ccc";
		document.getElementById('onlink3').style.backgroundColor="#f1f1f1";
		document.getElementById('onlink4').style.backgroundColor="#f1f1f1";
	}
	function tabclicked3(){
		
		//$('.full_down_date').val(dt);
		//$('.first_dp_date').val(dt);

		document.getElementById('activation_text').value='0';
		document.getElementById('onlink1').style.backgroundColor="#f1f1f1";
		document.getElementById('onlink2').style.backgroundColor="#f1f1f1";
		document.getElementById('onlink3').style.backgroundColor="#ccc";
		document.getElementById('onlink4').style.backgroundColor="#f1f1f1";
	}
	function tabclicked4(){
		document.getElementById('activation_text').value='0';
		document.getElementById('onlink1').style.backgroundColor="#f1f1f1";
		document.getElementById('onlink2').style.backgroundColor="#f1f1f1";
		document.getElementById('onlink3').style.backgroundColor="#f1f1f1c";
		document.getElementById('onlink4').style.backgroundColor="#ccc";
	}



	var cloned = $('#comm_table tr:last').clone();
	cloned.find('input').val('');
	$('#comm_table').on('click', ".add-row", function(e) {
		e.preventDefault();
		cloned.clone().appendTo('#comm_table'); 
	});

	// remove commission row
	$('#comm_table').on('click', ".delete-row", function(e) {
		e.preventDefault();
			$(this).closest('tr').remove();
		//calculateTotal();
	});
	$('#buyer_table').on('click', ".delete-buyer-row", function(e) {
		e.preventDefault();
			$(this).closest('tr').remove();
		//calculateTotal();
	});

	function updateTotals(elem) {
	net_tcp = $('.total-tcp').val()
	var tr = $(elem).closest('tr'),
		name = $('[name="agent_name[]"]', tr).val(),
		pos = $('[name="agent_position[]"]', tr).val(),
		code = $('[name="agent_code[]"]', tr).val(),
		rate= $('[name="agent_rate[]"]', tr).val(),
		subtotal = (parseFloat(rate) / 100) * parseFloat(net_tcp);

	$('.comm-amt', tr).val(subtotal.toFixed(2));
	
	}

	
	$(document).on('click', ".select-customer", function(e) {

		e.preventDefault;

		var customer = $(this);

		$('#insert_customer').modal({ backdrop: 'static', keyboard: false }).one('click', '.customer-select', function(e) {

			//old version
			var customer_last_name = $(this).attr('data-customer-lname');
			var customer_first_name = $(this).attr('data-customer-fname');
			var customer_middle_name = $(this).attr('data-customer-mname');
			var customer_suffix_name = $(this).attr('data-customer-sname');

			var customer_email = $(this).attr('data-customer-email');
			var customer_phone = $(this).attr('data-customer-phone');

			var customer_address_1 = $(this).attr('data-customer-address-1');
			var customer_zip_code = $(this).attr('data-customer-zip-code');

			var customer_address_abroad = $(this).attr('data-customer-address-abroad');

			var customer_viber = $(this).attr('data-customer-viber');
			var customer_birthday = $(this).attr('data-customer-birthday');
			var customer_age = $(this).attr('data-customer-age');
			var customer_gender = $(this).attr('data-customer-gender');
			var customer_civil = $(this).attr('data-customer-civil');
			var customer_ctzn = $(this).attr('data-customer-ctzn');

			//new version
			
		/* 	$('.buyer-last').val(customer_last_name); */

			$(customer).closest('tr').find('.buyer-last').val(customer_last_name);
			$(customer).closest('tr').find('.buyer-first').val(customer_first_name);
			$(customer).closest('tr').find('.buyer-middle').val(customer_middle_name);
			$(customer).closest('tr').find('.buyer-suffix').val(customer_suffix_name);
			$(customer).closest('tr').find('.buyer-address').val(customer_address_1);
			$(customer).closest('tr').find('.buyer-zipcode').val(customer_zip_code);
			$(customer).closest('tr').find('.buyer-add-abroad').val(customer_address_abroad);
			$(customer).closest('tr').find('.buyer-viber').val(customer_viber);
			$(customer).closest('tr').find('.buyer-bday').val(customer_birthday);
			$(customer).closest('tr').find('.buyer-age').val(customer_age);
			$(customer).closest('tr').find('.buyer-contact').val(customer_phone);
			$(customer).closest('tr').find('.buyer-email').val(customer_email);
			$(customer).closest('tr').find('.buyer-gender').val(customer_gender);
			$(customer).closest('tr').find('.buyer-civl').val(customer_civil);
			$(customer).closest('tr').find('.buyer-ctzn').val(customer_ctzn);

			$('#insert_customer').modal('hide');

		});
		return false;
		});
	$(document).ready(function(){

		$('body').on('change', '#location', function (e) {
            e.preventDefault();

			$.ajax({
				url: "https://onlinereservation.camella.com.ph/load_project_names_by_location",
				type: 'POST',
				dataType: 'JSON',
				data: { location_id: 'some_location_id' }, // Replace with actual location_id
				success: function (res) {
					$('#collapseProperty').collapse('hide');
					loading_spinner('project_map', 'hide');
					$('#project_map')
						.empty()
						.append('<option value="">Select Project</option>');
					$.each(res.project_map, function (k, v) {
						$('#project_map')
							.append('<option value="'+ v.id +'">'+ v.project_name +'</option>');
						console.log(v);
					});
				},
				error: function (jqXHR, textStatus, errorThrown) {
					console.error('Error: ' + textStatus + ', ' + errorThrown);
				}
			});

		});




		$('#save_csr').submit(function(e){
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
				url:_base_url_+"classes/Master.php?f=save_csr",
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
						window.location.href = "?page=sales/";
						/* location.reload(); */
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

	function getCtype(){
		if(document.getElementById("lotonly").checked==true){
			document.getElementById("type_text").value='1';
		}else if(document.getElementById("houseonly").checked==true){
			document.getElementById("type_text").value='2';
		}else if(document.getElementById("packaged").checked==true){
			document.getElementById("type_text").value='3';
		}else if(document.getElementById("fence").checked==true){
			document.getElementById("type_text").value='4';
		}else{
			document.getElementById("type_text").value='4';
		}
	}
	function getFlrElev(){
		if(document.getElementById("id20").checked==true){
			document.getElementById("flrelev_text").value='0.20';
		}else if(document.getElementById("id40").checked==true){
			document.getElementById("flrelev_text").value='0.40';
		}else if(document.getElementById("id60").checked==true){
			document.getElementById("flrelev_text").value='0.60';
		}else{
			document.getElementById("flrelev_text").value='0';
		}
	}
	function getAcSubtotal(){
		var ac_unit = document.getElementById('aircon_outlets').value;
		var ac_unit_price = document.getElementById('aircon_outlet_price').value;

		var res = ac_unit * ac_unit_price;

		document.getElementById('ac_outlet_subtotal').value = res;
		getAddCost();
	}
	function getAcGrillSubtotal(){
		var ac_grill = document.getElementById('ac_grill').value;
		var ac_grill_price = document.getElementById('ac_grill_price').value;

		var res = ac_grill * ac_grill_price;

		document.getElementById('ac_grill_subtotal').value = res;
		getAddCost();
	}
	function getServiceSubtotal(){
		var service = document.getElementById('service_area').value;
		var service_price = document.getElementById('service_area_price').value;

		var res = service * service_price;

		document.getElementById('service_subtotal').value = res;
		getAddCost();
	}
	function getOthersSubtotal(){
		var others = document.getElementById('others').value;
		var others_price = document.getElementById('others_price').value;

		var res = others * others_price;

		document.getElementById('others_subtotal').value = res;
		getAddCost();
	}
	function getConvSubtotal(){
		var conv = document.getElementById('conv_outlet').value;
		var conv_price = document.getElementById('conv_outlet_price').value;

		var res = conv * conv_price;

		document.getElementById('conv_outlet_subtotal').value = res;
		getAddCost();
	}
	function getAddCost(){
		var others = document.getElementById('others_subtotal').value;
		var service = document.getElementById('service_subtotal').value;
		var ac_grill1 = document.getElementById('ac_grill_subtotal').value;
		var ac_outlet = document.getElementById('ac_outlet_subtotal').value;
		var flr_elev = document.getElementById('flrelev_price').value;
		var conv_outlet = document.getElementById('conv_outlet_subtotal').value;

		var result = parseInt(others) + parseInt(service) + parseInt(ac_outlet) + parseInt(flr_elev)+ parseInt(conv_outlet) + parseInt(ac_grill1);

		document.getElementById('add_cost_total').value = result;
	}
</script>
