
<?php 
// include "../classes/new_functions.php";
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>


<?php endif;?>
<?php 

$username = $_settings->userdata('username'); 

/* $type = isset($_GET['type']) ? $_GET['type'] : 1 ; */
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
.lot_box_res {
  display: flex;
  align-items: center;
  justify-content: center;
  border: solid 1px black;
  width:100%;
  padding-top:10px;
  height:45px;
  border-radius:5px;
  margin-bottom:10px;
}

.radio-container {
  display: flex;
  align-items: center;
  padding: 35px;
}
.radio_add_cost{
    margin-left:40px;
}
#id20{
	margin-left:0px !important;
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


<script type="text/javascript">
	function opentab(evt, tabName) {
		var i, tabcontent, tablinks;
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
		  tabcontent[i].style.display = "none";
		}
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
		  tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		document.getElementById(tabName).style.display = "block";
		evt.currentTarget.className += " active";
	  }
	  function showTab(){
		document.getElementById('Buyer').style.display="block";

	  }  

	  function showTab(){
			document.getElementById('Buyer').style.display="block";
			var l_payment_type1 = $('.payment-type1').val();
		/* 	$('#payment_type2').removeAttr('disabled'); */
			$('#loan_text').text("Amount to be financed :");
			$('#down_frm').show();
			$('#monthly_frm').show();
			$('#no_pay_text').show();
			$('#no_payment').show();
			$('#mo_down_text').show();
			$('#monthly_down').show();
			$('#down_text').show();
			$('#start_text').text("Start Date :");	
			$('#ma_text').text("Monthly Amortization ");
			//alert(l_payment_type1);
			if (l_payment_type1 == "Spot Cash"){
		/* 		$('#payment_type2').attr('disabled','disable'); */
				$('#down_frm').hide();
				$('#monthly_frm').hide();
				$('#down_text').hide();
				$('#p1').hide();
				document.getElementById('p2').style.width='100%';
				document.getElementById('p2').style.marginLeft='0%';
	
				$('#loan_text').text("Amount :");
				$('#start_text').text("Pay Date :");	
				$('#ma_text').text("Spot Cash Payment ");
			} else if(l_payment_type1 == "Full DownPayment"){
				
				$('#no_pay_text').hide();
				$('#no_payment').val(0);
				$('#no_payment').hide();
				$('#mo_down_text').hide();
				$('#monthly_down').val(0);
				$('#monthly_down').hide();
				$('#p1').show();
				document.getElementById('p2').style.width='49%';
				document.getElementById('p2').style.marginLeft='2%';
			/* 	compute_net_dp();
				compute_no_payment();
				compute_rate();
				compute_monthly_payments();
				 */
				
			} else if(l_payment_type1 == "No DownPayment"){
				$('#down_text').hide();
				l_a = $('.net-tcp').val();
				l_b = $('.reservation-fee').val();
				$('#down_frm').hide();
				$('#no_payment').val('1');
				$('#mo_down_text').hide();
				l_sdate = $('.first-dp-date').val();
				$('#p1').hide();
				document.getElementById('p2').style.width='100%';
				document.getElementById('p2').style.marginLeft='0%';
				
				$('#start_date').val(l_sdate);
	
				var l_c = parseFloat(l_a) - parseFloat(l_b);
				$('#amt_to_be_financed').val(l_c.toFixed(2))
				$("#down_percent").val(0);
				$("#net_dp").val(0);
				$("#no_payment").val(1);
				$("#monthly_down").val(0);
				/* compute_net_dp();
				compute_no_payment();
				compute_rate();
				compute_monthly_payments(); */
				
			}else{
				$('#p1').show();
				document.getElementById('p2').style.width='49%';
				document.getElementById('p2').style.marginLeft='2%';
			/* 	compute_net_dp();
				compute_no_payment();
				compute_rate();
				compute_monthly_payments(); */
			}
		var l_payment_type2 = $('.payment-type2').val();
		if (l_payment_type2 == "Monthly Amortization"){
			$('#loan_text').text("Amount to be financed :");
			$('#interest_rate').show();
			$('#fixed_factor').show();
			$('#monthly_frm').show();
			$('#rate_text').show()
			$('#factor_text').show()
			$('#ma_text').text("Monthly Amortization ");
		}else if (l_payment_type2 == "Deferred Cash Payment"){
			$('#ma_text').text("Deferred Cash Payment ");
			$('#loan_text').text("Deferred Amount:");
			$("#interest_rate").val(0);
			$("#fixed_factor").val(0);
			$('#rate_text').hide()
			$('#factor_text').hide()
			$('#interest_rate').hide();
			$('#fixed_factor').hide();
		}

		radioButtonCtrl();

	}	  
</script>
<body onload="showTab()">
<div class="card card-outline rounded-0 card-blue">
	<div class="card-header">

		<h3 class="card-title"><b><i>New Reservation Application</b></i></h3>

	</div>
	<div class="card-body">
	<div class="container-fluid">
		<div class="tab">
			<button class="tablinks" onclick="opentab(event, 'Buyer')" id="onlink1" onkeyup="tabclicked1()"><b><i>Buyer's Profile</b></i></button>
			<button class="tablinks" onclick="opentab(event, 'Investment')" id="onlink2" onkeyup="tabclicked2()"><b><i>Investment Value</b></i></button>
			<button class="tablinks" onclick="opentab(event, 'Payment')" id="onlink3" onkeyup="tabclicked3()"><b><i>Payment Computation</b></i></button>
			<button class="tablinks" onclick="opentab(event, 'Agents and Commission')" id="onlink4" onkeyup="tabclicked4()"><b><i>Agents and Commission</b></i></button>
		</div>
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
													<p class="select-customer"> <a href="#"  class="btn btn-flat bg-maroon" style="font-size:14px;"><span class="fa fa-plus" aria-hidden="true"></span>&nbsp;&nbsp;Client Details</a></p>
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
														<p class="select-customer"> <a href="#"  class="btn btn-flat bg-maroon" style="font-size:14px;"><span class="fa fa-plus" aria-hidden="true"></span>&nbsp;&nbsp;Client Details</a></p>
											
													</div>
													<div class="main_box">
													

													<div class="row">
														<div class="col-md-3">		
															<div class="form-group">
															<label class="control-label">Last Name:<div class="asterisk">*</div></label>
																<input type="text" class="form-control margin-bottom buyer-last required" id="last_name" name="last_name[]" oninput="onlyLettersforRes()" value="<?php echo isset($customer_last_name_1) ? $customer_last_name_1 : ''; ?>" maxlength="50" tabindex="1">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="control-label">First Name:<div class="asterisk">*</div></label>
																<input type="text" class="form-control margin-bottom buyer-first required" id="first_name" name="first_name[]" oninput="onlyLettersforRes()" value="<?php echo isset($customer_first_name_1) ? $customer_first_name_1 : ''; ?>" maxlength="50" tabindex="2">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="control-label">Middle Name: </label>
																<input type="text" class="form-control margin-bottom buyer-middle" id="middle_name" name="middle_name[]" oninput="onlyLettersforRes()" value="<?php echo isset($customer_middle_name_1) ? $customer_middle_name_1 : ''; ?>" maxlength="50" tabindex="3">
															</div>
														</div>
														<div class="col-md-3">		
															<div class="form-group">
															<label class="control-label">Suffix Name: </label>
																<input type="text" class="form-control margin-bottom buyer-suffix" id="suffix_name" name="suffix_name[]" oninput="onlyLettersforRes()" value="<?php echo isset($customer_suffix_name_1) ? $customer_suffix_name_1 : ''; ?>" maxlength="10" tabindex="4">
															</div>
														</div>
													</div>
													<hr>
													<div class="row">
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Citizenship:<div class="asterisk">*</div></label>
																<input type="text" class="form-control margin-bottom buyer-ctzn required" id="citizenship" name="citizenship[]" oninput="onlyLettersforRes()" value="<?php echo isset($citizenship) ? $citizenship : ''; ?>" maxlength="50" tabindex="5">
															</div>
														</div>
														<div class="col-md-2">
															<label class="control-label">Civil Status:<div class="asterisk">*</div></label>
															<style>
																select:invalid { color: gray; }
															</style>
															<select required id="civil_status" name="civil_status[]" class="form-control buyer-civil required">
																<option value="" disabled selected>Select Civil Status</option>
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
																<label class="control-label">Gender:<div class="asterisk">*</div></label>
																<select required id="customer_gender" name="gender[]" class="form-control buyer-gender required" tabindex="7">
																	<option value="" disabled selected>Select Gender</option>
																	<option name="customer_gender" value="M" <?php echo isset($customer_gender) && $customer_gender == "M" ? 'selected' : '' ?>>Male</option>
																	<option name="customer_gender" value="F" <?php echo isset($customer_gender) && $customer_gender == "F" ? 'selected' : '' ?>>Female</option>
																</select>
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Birthdate:<div class="asterisk">*</div></label>
																<input type="text" class="form-control required buyer-bday datepicker" id="birth_day" name="birth_day[]" placeholder="YYYY-MM-DD" value="<?php echo isset($birth_date) ? $birth_date : ''; ?>" oninput="numbersAndHypens()" maxlength="10" tabindex="8">
															</div>
														</div>
														<div class="col-md-1">
															<div class="form-group">
																<label class="control-label">Age: </label>
																<input type="text" class="form-control margin-bottom buyer-age" name="age[]" id="age" value="<?php echo isset($customer_age) ? $customer_age : ''; ?> " tabindex="9" readonly>
															</div>
														</div>	
														<div class="col-md-3">
															<div class="form-group">
																<style>
																	select:invalid { color: gray; }
																</style>
																<label class="control-label">Relationship:<div class="asterisk">*</div></label>
																<select required id="relationship" name="relationship[]" class="form-control required" tabindex="10">
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
																<label class="control-label">Type of Valid ID Presented:<div class="asterisk">*</div></label>
																<input type="text" class="form-control margin-bottom required" name="id_presented[]" value="<?php echo isset($id_presented) ? $id_presented : ''; ?>" maxlength="50" tabindex="11">
															</div>	
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Tin #: </label>
																<input type="text" class="form-control margin-bottom" name="tin_no[]" value="<?php echo isset($tin_no) ? $tin_no : ''; ?>" tabindex="12">
															</div>
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Contact Number:<div class="asterisk">*</div></label>
																<input type="text" class="form-control margin-bottom buyer-contact required" name="contact_no[]" id="contact_no" oninput="limitContactNumberLength()" value="<?php echo isset($contact_no) ? $contact_no: ''; ?>" autocomplete="nope" tabindex="13">
															</div>	
														</div>
														<div class="col-md-2">
															<div class="form-group">
																<label class="control-label">Viber Account: </label>
																<input type="text" class="form-control margin-bottom buyer-viber" name="viber[]" id="viber" oninput="limitContactNumberLengthRes()" value="<?php echo isset($customer_viber) ? $customer_viber : ''; ?>" autocomplete="nope" tabindex="14">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="control-label">Email Address:<div class="asterisk">*</div></label>
																<input type="email" class="form-control margin-bottom buyer-email required" name="email[]" value="<?php echo isset($customer_email) ? $customer_email : ''; ?>" autocomplete="nope" maxlength="100" tabindex="15">
															</div>
														</div>
													</div>
													<div class="row">
														<div class="col-md-9">
															<div class="form-group">
																<label class="control-label">Residential/Billing Address:<div class="asterisk">*</div></label>
																<input type="text" class="form-control margin-bottom buyer-address required" name="address[]" value="<?php echo isset($customer_address_1) ? $customer_address_1 : ''; ?>" tabindex="16">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="control-label">Area Code:<div class="asterisk">*</div></label>
																<input type="number" class="form-control margin-bottom buyer-zipcode required" name="zip_code[]" value="<?php echo isset($customer_zip_code) ? $customer_zip_code : ''; ?>" maxlength="10" tabindex="17">
															</div>
														</div>
														<div class="col-md-9">
															<div class="form-group">
																<label class="control-label">Address Abroad (if any): </label>
																<input type="text" class="form-control margin-bottom buyer-add-abroad" name="address_abroad[]" value="<?php echo isset($customer_address_abroad) ? $customer_address_abroad : ''; ?>" tabindex="18">
															</div>
														</div>
														<div class="col-md-3">
															<div class="form-group">
																<label class="control-label">Contact Number Abroad: </label>
																<input type="text" class="form-control margin-bottom" name="contact_abroad[]" value="<?php echo isset($contact_abroad) ? $contact_abroad : ''; ?>" maxlength="25" tabindex="19">
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
							<div class="panel-heading">
								<div class="titles"></a><center>Investment Value</center></div>
								<div class="lot_box_res">
									<div class="type-title"><b>Type: </b></div>
									<div class="radio-container">
										<label>
											<input type="radio" name="chkOption3" value="1" <?php echo (isset($csr_type) && $csr_type == 1) ? 'checked="checked"' : ''; ?>>
										</label>
										<div>
											<label class="light" style="font-weight:normal;">Lot Only</label>
										</div>
									</div>
									<div class="radio-container">
										<label>
											<input type="radio" name="chkOption3" value="2" <?php echo isset($csr_type)&&$csr_type == 2 ? 'checked' : ''; ?> disabled>
										</label>
										<div>
											<label class="light" style="font-weight:normal;">House Only</label>
										</div>
									</div>
									<div class="radio-container">
										<label>
											<input type="radio" name="chkOption3" value="3" <?php echo isset($csr_type)&&$csr_type == 3 ? 'checked' : ''; ?>>
										</label>
										<div>
											<label class="light" style="font-weight:normal;">Packaged</label>
										</div>
									</div>
									<div class="radio-container">
										<label>
											<input type="radio" name="chkOption3" value="4" <?php echo isset($csr_type)&&$csr_type == 4 ? 'checked' : ''; ?> disabled>
										</label>
										<div>
											<label class="light" style="font-weight:normal;">Fence</label>
										</div>
									</div>
									<div class="radio-container">
										<label>
											<input type="radio" name="chkOption3" value="5" <?php echo isset($csr_type)&&$csr_type == 5 ? 'checked' : ''; ?> disabled>
										</label>
										<div>
											<label class="light" style="font-weight:normal;">Additional Cost</label>
										</div>
									</div>
									<input type="hidden" id="type_text" name="type_text" value="<?php echo isset($csr_type) ? $csr_type : '0'; ?>">
								</div>
							</div>
						<div class="panel-body form-group form-group-sm">
							<div class="lot_box">
								<div class="titles">Lot</div>
								<hr>
								<div class="row">
									<div class="col-md-3">
										<input type="hidden" class="form-control margin-bottom copy-input" name="l_lid" id="l_lid" value="<?php echo isset($lot_id) ? $lot_id : '';  ?>" tabindex="20">
										<div class="form-group">
											<label class="control-label">Phase: </label>
											<input type="text" class="form-control margin-bottom copy-input requiredRes" name="l_site" id="l_site" readonly  value="<?php echo isset($phase) ? $phase : ''; ?>" tabindex="21">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Block: </label>
											<input type="text" class="form-control margin-bottom copy-input requiredRes" name="l_block" id="l_block" readonly value="<?php echo isset($block) ? $block : ''; ?>" tabindex="22">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Lot: </label>
											<input type="text" class="form-control margin-bottom copy-input requiredRes" name="l_lot" id="l_lot" readonly value="<?php echo isset($lot) ? $lot : ''; ?>" tabindex="23">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<button type="submit" class="btn btn-flat btn-success float-right select-lot" data-loading-text="Finding..." id="btnfind" disabled>
												<i class="fa fa-search" aria-hidden="true"></i>&nbsp;&nbsp;Find Lot
											</button>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Lot Area: </label>
											<input type="text" class="form-control margin-bottom lot-area" name="lot_area" id="lot_area" readonly value="<?php echo isset($lot_area) ? $lot_area : ''; ?>" tabindex="24">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Price/SQM: </label>
											<input type="text" class="form-control margin-bottom price-sqm" name="price_per_sqm" id="price_per_sqm" readonly value="<?php echo isset($price_sqm) ? $price_sqm : ''; ?>" tabindex="25">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Amount: </label>
											<input type="text" class="form-control margin-bottom l-amount" name="amount" id="amount" readonly value="<?php echo isset($amount) ? $amount : ''; ?>" tabindex="26">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label">Discount (%): </label>
											<input type="text" class="form-control margin-bottom lot-disc" name="lot_disc" id="lot_disc" value="<?php echo isset($lot_discount) ? $lot_discount : ''; ?>" maxlength="3" oninput="numbersAndDecimal()"  tabindex="27" readOnly>
										</div>
									</div>
									<div class="col-md-8">
										<div class="form-group">
											<label class="control-label">Discount Amount: </label>
											<input type="text" class="form-control margin-bottom lot-disc-amt" name="lot_disc_amt" id="lot_disc_amt" readonly value="<?php echo isset($lot_discount_amt) ? $lot_discount_amt : ''; ?>" tabindex="28">
										</div>
									</div>
								</div>	
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Lot Contract Price: </label>
											<input type="text" class="form-control margin-bottom l-lcp" name="lcp" id="lcp" value="<?php echo isset($lcp) ? $lcp : ''; ?>"  tabindex="29" readOnly>
										</div>
									</div>
								</div>
							</div>
							<div class="house_box">
								<div class="titles">House</div>
								<hr>
								<div class="row">
									<input type="hidden" class="form-control margin-bottom copy-input" name="l_house_lid" id="l_house_lid">
									<div class="col-md-12">		
										<div class="form-group">

											<label class="control-label">House Model:</label>
											<select name="house_model" class="form-control" hidden>
											
											</select>
											<select id="house_model" name="house_model" class="form-control">
											<option value="" disabled <?php echo !isset($house_model) ? "selected" : '' ?>></option>
											<?php 
											$qry = $conn->query("SELECT * FROM t_model_house ORDER BY c_acronym ASC");
											while ($row = $qry->fetch_assoc()):
											?>
											<option 
												value="<?php echo $row['c_model'] ?>" 
												<?php echo isset($house_model) && $house_model == $row['c_model'] ? 'selected' : '' ?> <?php echo $row['c_model'] == 0? 'disabled' : '' ?>
											><?php echo $row['c_model'] ?></option>
											<?php endwhile; ?>
										</select>
										</div>
									</div>
								</div>
										
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">Floor area: </label>
											<input type="text" class="form-control margin-bottom floor-area requiredHouse" name="floor_area" id="floor_area" oninput="numbersAndDecimal()" value="<?php echo isset($floor_area) ? $floor_area : 0; ?>" maxlength="25" tabindex="31" readOnly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">House Price/SQM: </label>
											<input type="text" class="form-control margin-bottom h-price-sqm requiredHouse"  name="h_price_per_sqm" id="h_price_per_sqm" oninput="numbersAndDecimal()" value="<?php echo isset($house_price_sqm) ? $house_price_sqm : 0; ?>" maxlength="25" tabindex="32" readOnly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-5">
										<div class="form-group">
											<label class="control-label">House Discount(%): </label>
											<input type="text" class="form-control margin-bottom house-disc required" name="house_disc" id="house_disc" oninput="numbersAndDecimal()" value="<?php echo isset($house_discount) ? $house_discount : 0; ?>" maxlength="3" tabindex="33" readOnly>
										</div>
									</div>
									<div class="col-md-7">
										<div class="form-group">
											<label class="control-label">House Discount Amount: </label>
											<input type="text" class="form-control margin-bottom h-disc-amt" name="house_disc_amt" id="house_disc_amt" value="<?php echo isset($house_discount_amt) ? $house_discount_amt : 0; ?>" tabindex="34" readOnly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="control-label">House Contract Price: </label>
											<input type="text" class="form-control margin-bottom house-hcp" name="hcp" id="hcp" value="<?php echo isset($hcp) ? $hcp : 0; ?>" tabindex="35" readOnly>
										</div>
									</div>	
								</div>		
							</div>
							<div class="space"></div>
							<div class="main_box">
							<div class="titles">Add Cost</div>
								<hr>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Floor Elevation: </label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label"></label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label"></label>
										</div>
									</div>
									<div class="col-md-4 text-center">
										<div class="form-group">
											<input id="id20" class="radio_add_cost" type="radio" name="chkOption4" value="1" <?php echo (isset($floor_elev)&&$floor_elev == 1) ? 'checked' : ''; ?> disabled/>0.20 meter
											<input id="id40" class="radio_add_cost" type="radio" name="chkOption4" value="2" <?php echo (isset($floor_elev)&&$floor_elev == 2) ? 'checked' : ''; ?> disabled/>0.40 meter
											<input id="id60" class="radio_add_cost" type="radio" name="chkOption4" value="3" <?php echo (isset($floor_elev)&&$floor_elev == 3) ? 'checked' : ''; ?> disabled/>0.60 meter
										</div>
										<input type="hidden" id="floor_elev" name="floor_elev" value="<?php echo isset($floor_elev) ? $floor_elev : '0'; ?>">
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control margin-bottom flrelev-price" id="flrelev_price" name="flrelev_price" oninput="numbersAndDecimal()" value="<?php echo isset($floor_elev_price) ? $floor_elev_price : 0; ?>" tabindex="36" readOnly>
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Aircon Outlets: </label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label"><input type="number" class="form-control margin-bottom aircon-outlets" id="aircon_outlets" name="aircon_outlets" value="<?php echo isset($aircon_outlets) ? $aircon_outlets : 0; ?>" maxlength="2" tabindex="37" readOnly></label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">Unit/s</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control margin-bottom aircon-outlet-price" id="aircon_outlet_price" name="aircon_outlet_price" oninput="numbersAndDecimal()" value="<?php echo isset($aircon_outlet_price) ? $aircon_outlet_price : 0; ?>" tabindex="38" maxlength="25" readOnly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control margin-bottom ac-outlet-subtotal" id="ac_outlet_subtotal" name="ac_outlet_subtotal" value="<?php echo isset($ac_outlet_subtotal) ? $ac_outlet_subtotal : 0; ?>" tabindex="39" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Aircon Grill: </label>
											<label class="control-label"><i>(for window-type):</i></label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label"><input type="number" class="form-control margin-bottom ac-grill" id="ac_grill" name="ac_grill" value="<?php echo isset($aircon_grill) ? $aircon_grill : 0; ?>"  maxlength="2" tabindex="40" readOnly></label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">Unit/s</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control margin-bottom ac-grill-price" id="ac_grill_price" name="ac_grill_price" oninput="numbersAndDecimal()" value="<?php echo isset($aircon_grill_price) ? $aircon_grill_price : 0; ?>" tabindex="41" maxlength="25" readOnly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control margin-bottom ac-grill-subtotal" id="ac_grill_subtotal" name="ac_grill_subtotal"  value="<?php echo isset($ac_grill_subtotal) ? $ac_grill_subtotal : 0; ?>" tabindex="42" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Convenience Outlet: </label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label"><input type="number" class="form-control margin-bottom conv-outlet" id="conv_outlet" name="conv_outlet" value="<?php echo isset($conv_outlet) ? $conv_outlet : 0; ?>"  maxlength="2" tabindex="43" readOnly></label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">Unit/s</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control margin-bottom conv-outlet-price" id="conv_outlet_price" name="conv_outlet_price" oninput="numbersAndDecimal()" value="<?php echo isset($conv_outlet_price) ? $conv_outlet_price : 0; ?>" tabindex="44" maxlength="25" readOnly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control margin-bottom conv-outlet-subtotal" id="conv_outlet_subtotal" name="conv_outlet_subtotal" value="<?php echo isset($conv_outlet_subtotal) ? $conv_outlet_subtotal : 0; ?>" tabindex="45" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Service Area: </label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label"><input type="number" class="form-control margin-bottom service-area" id="service_area" name="service_area" value="<?php echo isset($service_area) ? $service_area : 0; ?>" maxlength="2" tabindex="46" readOnly></label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">Unit/s</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control margin-bottom service-area-price" id="service_area_price" name="service_area_price" oninput="numbersAndDecimal()" value="<?php echo isset($service_area_price) ? $service_area_price : 0; ?>" tabindex="47" maxlength="25" readOnly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control margin-bottom service-subtotal" id="service_subtotal" name="service_subtotal" value="<?php echo isset($service_subtotal) ? $service_subtotal : 0; ?>" tabindex="48" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">Other(specify): </label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label"><input type="number" class="form-control margin-bottom others" id="others" name="others" value="<?php echo isset($others) ? $others : 0; ?>" maxlength="2" tabindex="49" readOnly></label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label">Unit/s</label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control margin-bottom others-price" id="others_price" name="others_price" oninput="numbersAndDecimal()" value="<?php echo isset($others_price) ? $others_price : 0; ?>" tabindex="50" maxlength="25" readOnly>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control margin-bottom others-subtotal" id="others_subtotal" name="others_subtotal"  value="<?php echo isset($others_subtotal) ? $others_subtotal : 0; ?>" tabindex="51" readonly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label"></label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label"></label>
										</div>
									</div>
									<div class="col-md-1">
										<div class="form-group">
											<label class="control-label"></label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label class="control-label" style="align-items:right;">Additional Cost/s: </label>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<input type="text" class="form-control margin-bottom add-cost-total" id="add_cost_total" name="add_cost_total" value="<?php echo isset($add_cost) ? $add_cost : 0; ?>" tabindex="52" readonly>

										</div>
									</div>
								</div>
							</div>

						</div>

						<div class="space"></div>
						<div class="main_box">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Processing Fee:</label>
										</div>
									</div>
									<div class="col-md-3" >
										<div class="form-group">
											<input type="text" class="form-control margin-bottom process-fee" name="process_fee" id="process_fee" oninput="numbersAndDecimal()" value="<?php echo isset($process_fee) ? $process_fee : 0; ?>" maxlength="25" tabindex="53">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">PF/Month:</label>
										</div>
									</div>
									<div class="col-md-3" >
										<div class="form-group">
											<input type="text" class="form-control margin-bottom pf-month"  name="pf_month" id="pf_month" oninput="numbersAndDecimal()" value="<?php echo isset($pf_month) ? $pf_month : 0; ?>" maxlength="25" tabindex="54">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">TCP Discount</label>
										</div>
									</div>
									<div class="col-md-3" >
										<div class="form-group">
											<input type="text" class="form-control margin-bottom tcp-disc" name="tcp_disc" id="tcp_disc" oninput="numbersAndDecimal()" value="<?php echo isset($tcp_discount) ? $tcp_discount : 0; ?>" maxlength="25" tabindex="55">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">TCP Disc. Amount:</label>
										</div>
									</div>
									<div class="col-md-3" >
										<div class="form-group">
											<input type="text" class="form-control margin-bottom tcp-disc-amt" name="tcp_disc_amt" id="tcp_disc_amt" value="<?php echo isset($tcp_discount_amt) ? $tcp_discount_amt : 0; ?>" tabindex="56" readOnly>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">Total Contract Price:</label>
										</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<input type="text" class="form-control margin-bottom total-tcp" name="total_tcp" id="total_tcp" value="<?php echo isset($tcp) ? $tcp : 0; ?>" tabindex="57" readOnly>
											<input type="hidden" name="invoice_discount" id="invoice_discount">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">VAT:</label>
										</div>
									</div>
									<div class="col-md-3" >
										<div class="form-group">
										<input type="text" class="form-control margin-bottom vat-percent" value="<?php echo isset($vat_percent) ? $vat_percent : 0; ?>" name="vat_percent" id="vat_percent" oninput="numbersAndDecimal()" tabindex="58" maxlength="3">
										</div> 
									</div> 
									<div class="col-md-2">
										<div class="form-group">
											<label class="control-label">VAT Amount:</label>
										</div>
									</div>
									<div class="col-md-4" >
										<div class="form-group">
										<input type="text" class="form-control margin-bottom vat-amt-computed" value="<?php echo isset($vat_amt_computed) ? $vat_amt_computed : 0; ?>" name="vat_amt_computed" id="vat_amt_computed"  tabindex="59" readOnly>
										</div> 
									</div> 
								</div>
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label class="control-label">NET Total Contract Price:</label>
										</div>
									</div>
									<div class="col-md-9">
									<input type="text" class="form-control margin-bottom net-tcp"  value="<?php echo isset($net_tcp) ? $net_tcp : 0; ?>" name="net_tcp" readonly id="net_tcp" tabindex="60">
										<input type="hidden" name="total_net_tcp" id="total_net_tcp">
									</div>
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
							<div class="titles"><center>Payment Computation</center></div>
						</div>
						<div class="panel-body form-group form-group-sm">
							<div class="main_box">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label class="control-label">Total Selling Price:</label>
											<input type="text" class="form-control margin-bottom required net-tcp-1" name="net_tcp1" id="net_tcp1" value="<?php echo isset($net_tcp1) ? $net_tcp1 : 0; ?>" tabindex = "61" readOnly>
										</div>
									</div>
									<div class="col-md-6">	
										<div class="form-group">
											<label class="control-label">Reservation:<div class="asterisk">*</div></label>
											<input type="text" class="form-control margin-bottom requiredRes reservation-fee" name="reservation" id="reservation" oninput="numbersAndDecimal()" value="<?php echo isset($reservation) ? $reservation : 0; ?>" tabindex ="62" maxlength="25">
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
									<select name="payment_type1" id="payment_type1" class="form-control required payment-type1" tabindex = "63">
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
										<select name="payment_type2" id="payment_type2" class="form-control required payment-type2" tabindex = "64" disabled>
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
										<input type="text" class="form-control margin-bottom down-percent requiredPayment" name="down_percent" id="down_percent" oninput="numbersAndDecimal()" value="<?php echo isset($down_percent) ? $down_percent : 0; ?>" maxlength="3">
										<label class="control-label">Net DP: </label>
										<input type="text" class="form-control margin-bottom net-dp" name="net_dp" id="net_dp" value="<?php echo isset($net_dp) ? $net_dp : 0; ?>" readonly>
										<label class="control-label" id= "no_pay_text"># Payments : </label>
										<input type="text" class="form-control margin-bottom no-payment requiredPDandDC" name="no_payment" id="no_payment" oninput="numbersAndDecimal()" value="<?php echo isset($no_payments) ? $no_payments : 0; ?>" maxlength= "3">
										<label class="control-label" id = "mo_down_text">Monthly Down: </label>
										<input type="text" class="form-control margin-bottom monthly-down" name="monthly_down" id="monthly_down" value="<?php echo isset($monthly_down) ? $monthly_down : 0; ?>" readonly>
										<label class="control-label" id = "first_dp">First DP: </label>
										<input type="date" class="form-control first-dp-date" name="first_dp_date" id = "first_dp_date" value="<?php echo isset($first_dp) ? $first_dp : ''; ?>">
											
									
										<label class="control-label">Full Down: </label>
										
										<input type="date" class="form-control full-down-date" name="full_down_date" id = "full_down_date" value="<?php echo isset($full_down) ? $full_down : ''; ?>">

											
										
									</div>
								</div>

							</div>		
							<div class="payment_box2" id="p2">	
								<div class="col-md-12">
									<label class="control-label" id='loan_text'>Amount to be Financed:</label>
									<input type="text" class="form-control margin-bottom required amt-to-be-financed" name="amt_to_be_financed" id="amt_to_be_financed" value="<?php echo isset($amt_financed) ? $amt_financed : 0; ?>" readOnly>
									<div class="form-group monthly-frm" id = "monthly_frm">
										<label class="control-label">Terms: </label>
										<input type="text" class="form-control margin-bottom required terms-count requiredPayment" name="terms" id="terms" oninput="numbersAndDecimal()" value="<?php echo isset($terms) ? $terms : 1; ?>" maxlength="3">
										<label class="control-label" id='rate_text'>Interest Rate: </label>
										<input type="text" class="form-control margin-bottom required interest-rate requiredNoDP" name="interest_rate" id="interest_rate" oninput="numbersAndDecimal()" value="<?php echo isset($interest_rate) ? $interest_rate : 0; ?>" maxlength="3">
										<label class="control-label" id='factor_text' >Fixed Factor: </label>
										<input type="text" class="form-control margin-bottom required fixed-factor" name="fixed_factor" id="fixed_factor" value="<?php echo isset($fixed_factor) ? $fixed_factor : 0; ?>" readOnly>
										<label class="control-label">Monthly Payment: </label>
										<input type="text" class="form-control margin-bottom required monthly-amor requiredMonthly" name="monthly_amortization" id="monthly_amortization" value="<?php echo isset($monthly_payment) ? $monthly_payment : 0; ?>" readOnly>	
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
							<table class="table3 table-bordered table-hover table-striped responsive-table" id="comm_table" style="width:100%;">
								<thead>
									<tr>
										<th width="50">
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
											<div class="form-group form-group-sm">
												<input type="text" style="width:60%" class="form-control form-group-sm item-input agent-name" name="agent_name[]" value="<?php echo isset($agent_name) ? $agent_name : ''; ?>">
												<p class="item-select"><a href="#" class="btn btn-flat btn-md bg-maroon" style="font-size:14px;"><span class="fa fa-search" aria-hidden="true"></span>&nbsp;&nbsp;Select Existing Agent</a></p>
											</div>
										</td>
										<td style="padding-top:10px;">
												<input type="text" class="form-control agent-pos" name="agent_position[]" value="<?php echo isset($position) ? $position : ''; ?>" readonly>
										</td>
										<td style="padding-top:10px;">
												<input type="text" class="form-control agent-code" name="agent_code[]" value="<?php echo isset($code) ? $code : ''; ?>" readonly>
										</td>
										<td style="padding-top:10px;">
												<input type="text" class="form-control calculate agent-rate" name="agent_rate[]" value="<?php echo isset($rate) ? $rate : 0; ?>">
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
											<div class="form-group form-group-sm no-margin-bottom">
												<input type="text" style="width:60%" class="form-control form-group-sm item-input requiredRes agent-name" name="agent_name[]" value="<?php echo isset($agent_name) ? $agent_name : ''; ?>">
												<p class="item-select" style="margin-top:5px;"> <a href="#"  class="btn btn-flat btn-md bg-maroon" style="font-size:14px;"><span class="fa fa-search" aria-hidden="true"></span>&nbsp;&nbsp;Select Existing Agent</a></p>
								
											</div>
										</td>
										<td>
											<div class="form-group form-group-sm" style="padding-top:10px;margin-top:-35px;">
												<input type="text" class="form-control agent-pos" name="agent_position[]" value="<?php echo isset($position) ? $position : ''; ?>" required readonly>
											</div>
										</td>
										<td>
											<div class="form-group form-group-sm" style="padding-top:10px;margin-top:-35px;">
												
												<input type="text" class="form-control agent-code" name="agent_code[]" value="<?php echo isset($code) ? $code : ''; ?>" aria-describedby="sizing-addon1" required readonly>
											</div>
										</td>
										<td>
											<div class="form-group form-group-sm" style="padding-top:10px;margin-top:-35px;">
												<input type="text" class="form-control calculate agent-rate requiredRes" name="agent_rate[]" value="<?php echo isset($rate) ? $rate : 0; ?>" required>
											</div>
										</td>
										<td>
											<div class="form-group form-group-sm" style="padding-top:10px;margin-top:-35px;">
												<input type="text" class="form-control comm-amt requiredRes" name="comm_amt[]" value="<?php echo isset($comm_amt) ? $comm_amt : 0; ?>" aria-describedby="sizing-addon1" required>
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
												<textarea class="form-control" name="invoice_notes" id="invoice_notes"></textarea>
											</div>	
										</div>
									</div>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</form>

	</div>	<!-- /.card-body -->
	<div class="card-footer">
		<table style="width:100%;">
			<tr>
				<td>
					<button class="btn btn-flat btn-default bg-maroon" form="save_csr" style="width:100%;margin-right:5px;font-size:14px;"><i class="fas fa-save"></i>&nbsp;&nbsp;Save</button>
				</td>
				<td>
					<a class="btn btn-flat btn-default" href="./?page=sales" style="width:100%;margin-left:5px;font-size:14px;"><i class="fas fa-times-circle"></i>&nbsp;&nbsp;Cancel</a>
				</td>
			</tr>
		</table>
	</div>
</div>	<!-- /.container-fluid -->
</div>	<!-- /.card -->
<div id="insert_customer" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Select Client Details</h5>
			</div>
			<div class="modal-body">
				<table class="table2 table-bordered table-stripped" style="width:100%;font-size:16px;">
					<thead>
						<tr>

						<th style="text-align:center;">Last Name</th>
						<th style="text-align:center;">First Name</th>
						<th style="text-align:center;">Middle Name</th>
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

					while($row = $query->fetch_assoc()): ?>

						<tr>
							<td style="text-align:center;"><?php echo $row["last_name"] ?></td>
							<td style="text-align:center;"><?php echo $row["first_name"] ?></td>
							<td style="text-align:center;"><?php echo $row["middle_name"] ?></td>


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

		</div>
	</div>
</div>

<div id="insert_lot" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		<div class="modal-header">

			<h4 class="modal-title">Select Lot</h4>

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

		</div>
	</div>
</div>

<div id="insert" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>


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
    var radioButtons = document.querySelectorAll('.radio_add_cost');
    var floorElevTextbox = document.getElementById('floor_elev');

    radioButtons.forEach(function(radio) {
        radio.addEventListener('change', function() {
            if (this.checked) {
                floorElevTextbox.value = this.value;
            }
        });
    });
</script>
<script>
	var inputElement = document.getElementById("fixed_factor");

	if (isNaN(inputElement.value)) {
	inputElement.value = 0;
	}
	document.addEventListener('DOMContentLoaded', function () {
	var paymentType1Select = document.getElementById('payment_type1');
	var paymentType2Select = document.getElementById('payment_type2');

	function updatePaymentType2() {
	var selectedPaymentType1 = paymentType1Select.value;
	var selectedPaymentType2 = paymentType2Select.value;
	if (selectedPaymentType1 === 'Partial DownPayment' || selectedPaymentType1 === 'Full DownPayment' || selectedPaymentType1 === 'No DownPayment') {
		paymentType2Select.value = 'Monthly Amortization';
		paymentType2Select.style.backgroundColor = "white";
		paymentType2Select.disabled = false;
	} else {
		paymentType2Select.value = 'None';
		paymentType2Select.style.backgroundColor = "#e9ecef";
		paymentType2Select.disabled = true;
	}
	}

	paymentType1Select.addEventListener('change', updatePaymentType2);
	updatePaymentType2();

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
var cloned = $('#comm_table tr:last').clone();
cloned.find('input').val('');
$('#comm_table').on('click', ".add-row", function(e) {
	e.preventDefault();
	cloned.clone().appendTo('#comm_table'); 
});
$('#comm_table').on('click', ".delete-row", function(e) {
	e.preventDefault();
		$(this).closest('tr').remove();
});
$('#buyer_table').on('click', ".delete-buyer-row", function(e) {
	e.preventDefault();
		$(this).closest('tr').remove();
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
		$(customer).closest('tr').find('.buyer-civil').val(customer_civil);
		$(customer).closest('tr').find('.buyer-ctzn').val(customer_ctzn);
		$('#insert_customer').modal('hide');
	});
	return false;
});
$(document).ready(function(){
	$('#save_csr').submit(function(e){
		e.preventDefault();
		var _this = $(this)
		$('.err-msg').remove();
		
		var errorCounter = validateForm();
		var errorCounter = validateAmount();
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
					window.location.href = "?page=agent_sales";
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
function validateAmount() {
    var errorCounter = 0;
    var typeText = document.getElementById("type_text").value;
	var houseModel = document.getElementById("house_model");
	var selectedPaymentType1 = document.getElementById("payment_type1");
	var selectedPaymentType2 = document.getElementById("payment_type2");

	var selectedModel = houseModel.value;
	var selectedPayment1 = selectedPaymentType1.value;
	var selectedPayment2 = selectedPaymentType2.value;
    $(".requiredRes").each(function(i, obj) {
        if ($(this).val() === '0' || $(this).val() === '') {
            $(this).parent().addClass("has-error");
            errorCounter++;
        } else {
            $(this).parent().removeClass("has-error");
        }
    });

    $(".requiredHouse").each(function(i, obj) {
		if(selectedModel === '' && typeText === '3'){
			$(this).parent().addClass("has-error");
            errorCounter++;
		}
        if (typeText === '3' && ($(this).val() === '0' || $(this).val() === '')) {
            $(this).parent().addClass("has-error");
            errorCounter++;
        } else {
            $(this).parent().removeClass("has-error");
        }
    });

	$(".requiredPayment").each(function(i, obj) {
		if(((selectedPayment1 === 'Partial DownPayment' || selectedPayment1 === 'Full DownPayment') && selectedPayment2 === 'Monthly Amortization') && ($(this).val() === '0' || $(this).val() === '')){
			$(this).parent().addClass("has-error");
            errorCounter++;
		}
		else {
            $(this).parent().removeClass("has-error");
        }
    });

	$(".requiredPDandDC").each(function(i, obj) {
		if((selectedPayment1 === 'Partial DownPayment' && selectedPayment2 === 'Deferred Cash Payment') && ($(this).val() === '0' || $(this).val() === '')){
			$(this).parent().addClass("has-error");
            errorCounter++;
		}
		else {
            $(this).parent().removeClass("has-error");
        }
    });

	$(".requiredNoDP").each(function(i, obj) {
		if((selectedPayment1 === 'No DownPayment' && selectedPayment2 === 'Monthly Amortization') && ($(this).val() === '0' || $(this).val() === '')){
			$(this).parent().addClass("has-error");
            errorCounter++;
		}
		else {
            $(this).parent().removeClass("has-error");
        }
    });

	$(".requiredMonthly").each(function(i, obj) {
		if((selectedPayment2 === 'Deferred Cash Payment' || selectedPayment2 === 'Monthly Amortization') && ($(this).val() === '0' || $(this).val() === '' || $(this).val() === '0.00')){
			$(this).parent().addClass("has-error");
            errorCounter++;
		}
		else {
            $(this).parent().removeClass("has-error");
        }
    });

    return errorCounter;
}
document.addEventListener('DOMContentLoaded', function() {
    var selectElement = document.getElementById('house_model');
    var floorAreaInput = document.getElementById('floor_area');
	var priceInput = document.getElementById('h_price_per_sqm');
	var DiscInput = document.getElementById('house_disc');
	var DiscAmtInput = document.getElementById('house_disc_amt');
	var HCPAmt = document.getElementById('hcp')
    
    selectElement.addEventListener('change', function() {
        if (selectElement.selectedIndex === 0) {
            floorAreaInput.value = '0';
			priceInput.value = '0';
			DiscInput.value='0';
			DiscAmtInput.value='0';
			HCPAmt.value='0';
        }
    });
});

</script>
