<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php 

$username = $_settings->userdata('username'); 

/* $type = isset($_GET['type']) ? $_GET['type'] : 1 ; */
if(isset($_GET['id']) && $_GET['id'] > 0){

	$csr = $conn->query("SELECT * FROM t_csr where md5(c_csr_no) = '{$_GET['id']}' ");

	if($csr->num_rows > 0){
		while($row = $csr->fetch_assoc()):
			$c_csr_no =  $row['c_csr_no'];
			$lot_id = $row['c_lot_lid'];
			$lot_area = $row['c_lot_area'];
			$price_sqm = $row['c_price_sqm'];
			$lot_discount = $row['c_lot_discount'];
			$lot_discount_amt = $row['c_lot_discount_amt'];
			$house_model = $row['c_house_model'];
			$floor_area = $row['c_floor_area'];
			$house_price_sqm = $row['c_house_price_sqm'];
			$house_discount = $row['c_house_discount'];
			$house_discount_amt = $row['c_house_discount_amt'];
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
</style>

<script type="text/javascript">
	function opentab(evt, tabName) {
		// Declare all variables
		var i, tabcontent, tablinks;
		// Get all elements with class="tabcontent" and hide them
		tabcontent = document.getElementsByClassName("tabcontent");
		for (i = 0; i < tabcontent.length; i++) {
		  tabcontent[i].style.display = "none";
		}
		// Get all elements with class="tablinks" and remove the class "active"
		tablinks = document.getElementsByClassName("tablinks");
		for (i = 0; i < tablinks.length; i++) {
		  tablinks[i].className = tablinks[i].className.replace(" active", "");
		}
		// Show the current tab, and add an "active" class to the button that opened the tab
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
				compute_net_dp();
				compute_no_payment();
				compute_rate();
				compute_monthly_payments();
				
				
			} else if(l_payment_type1 == "No DownPayment"){
				$('#down_text').hide();
				l_a = $('.net-tcp').val();
				l_b = $('.reservation-fee').val();
				$('#down_frm').hide();
				/* $('#no_payment').val('1'); */
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
				$("#no_payment").val(0);
				$("#monthly_down").val(0);
				compute_net_dp();
				compute_no_payment();
				compute_rate();
				compute_monthly_payments();
				
			}else{
				$('#p1').show();
				document.getElementById('p2').style.width='49%';
				document.getElementById('p2').style.marginLeft='2%';
				compute_net_dp();
				compute_no_payment();
				compute_rate();
				compute_monthly_payments();
				
			}
	
		
	
		var l_payment_type2 = $('.payment-type2').val();
	
		if (l_payment_type2 == "Deferred Cash Payment"){
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
			$("#fixed_facotr").val(0);
			$('#rate_text').hide()
			$('#factor_text').hide()
			$('#interest_rate').hide();
			$('#fixed_factor').hide();
		
		}
	
	}	  



</script>
<body onload="showTab()">

<div class="card card-outline rounded-0 card-blue">
	<div class="card-header">
			<!-- <h3 class="card-title"><?php echo !isset($_GET['id']) ? "New Invoice" :"Edit Invoice" ?></h3> -->
		<h3 class="card-title">New Reservation Application</h3>
		<div class="card-tools">
				<!-- <a href="./?page=sales/create" class="btn btn-flat btn-default bg-blue"><span class="fas fa-plus"></span>  Select Existing Client</a> -->
		</div>
	</div>
	<div class="card-body">
	<div class="container-fluid">
		<div class="tab">
			<button class="tablinks" onclick="opentab(event, 'Buyer')" id="onlink1" onkeyup="tabclicked1()">Buyer's Profile</button>
			<button class="tablinks" onclick="opentab(event, 'Investment')" id="onlink2" onkeyup="tabclicked2()">Investment Value</button>
			<button class="tablinks" onclick="opentab(event, 'Payment')" id="onlink3" onkeyup="tabclicked3()">Payment Computation</button>
			<button class="tablinks" onclick="opentab(event, 'Agents and Commission')" id="onlink4" onkeyup="tabclicked4()">Agents and Commission</button>
		</div>
		<form method="" id="update_csr">
			<input type="hidden" name="username" value="<?php echo $_settings->userdata('username'); ?>">
			<input type="hidden" name="c_csr_no" value="<?php echo isset($c_csr_no) ? $c_csr_no : '';  ?>">
			<div id="Buyer" class="tabcontent">
				<div class="row">
					<div class="col-md-12">
						<div class="panel panel-default">
								
							<div class="panel-body form-group form-group-sm">
								<table class="table table-bordered table-stripped" id="buyer_table">
									<thead>
										<tr>
											
											<th>
											<div class="panel-heading">
												<a href="#" class="btn btn-primary float-left btn-md add-buyer-row"><span class="fa fa-plus" aria-hidden="true"></span></a>
												<div class="titles"><center> Buyer's Information Details</center></div>
												<div class="clear"></div>
											</div>
											</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										
	
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
													<a href="#" class="btn btn-danger float-right btn-md delete-buyer-row"><span class="fa fa-times" aria-hidden="true"></span></a>
													</div>
													<p class="select-customer"> <a href="#"  class="btn btn-flat btn-md bg-maroon" ><span class="fa fa-plus" aria-hidden="true"></span> Select Existing Client</a></p>
										
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
															<label class="control-label">Suffix Name: </label>
																<input type="text" class="form-control margin-bottom buyer-suffix" name="suffix_name[]" value="<?php echo isset($customer_suffix_name_1) ? $customer_suffix_name_1 : ''; ?>">
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
													</div>

													<div class="row">
														<div class="col-md-3">
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
														
																	<input type="date" class="form-control buyer-bday required" name="birth_day[]" placeholder="YYYY-MM-DD" value="<?php echo isset($birth_date) ? $birth_date : ''; ?>">		
																
															
															</div>
														</div>
														<div class="col-md-1">
															<div class="form-group">
																<label class="control-label">Age: </label>
																<input type="text" class="form-control margin-bottom buyer-age required" name="age[]" value="<?php echo isset($customer_age) ? $customer_age : ''; ?>">
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

													<div class="col-md-2">
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
											
											</td>	
										</tr>
                                          <?php      endwhile;

                                            }	?>
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
									<div class="titles"></a><center><h4>Investment Value<h4></center></div>
									<!-- <a href="#" class="float-right select-customer"><b>OR</b> Select Existing Customer</a>  -->
									<div class="clear"></div>
								</div>
							<div class="panel-body form-group form-group-sm">
								<div class="lot_box">
									<div class="titles">Lot</div>
									<hr>
									<div class="row">
										<div class="col-md-3">
											
											<!-- <div class="form-group" tabindex = "21">	
										
											</div> -->
											<input type="hidden" class="form-control margin-bottom copy-input" name="l_lid" id="l_lid" value="<?php echo isset($lot_id) ? $lot_id : '';  ?>">
											<div class="form-group">
												<label class="control-label">Phase: </label>
												<input type="text" class="form-control margin-bottom copy-input" name="l_site" id="l_site" readonly  value="<?php echo isset($phase) ? $phase : ''; ?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Block: </label>
												<input type="text" class="form-control margin-bottom copy-input" name="l_block" id="l_block" readonly value="<?php echo isset($block) ? $block : ''; ?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">Lot: </label>
												<input type="text" class="form-control margin-bottom copy-input" name="l_lot" id="l_lot" readonly value="<?php echo isset($lot) ? $lot : ''; ?>">
											</div>
										</div>
										<div class="col-md-3">
											<div class="form-group">
												<br>
												<input type="submit" class="btn btn-success float-right select-lot" value="Find Lot" data-loading-text="Finding..." id="btnfind" >
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Lot Area: </label>
												<input type="text" class="form-control margin-bottom lot-area" name="lot_area" id="lot_area" readonly value="<?php echo isset($lot_area) ? $lot_area : ''; ?>">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label class="control-label">Price/SQM: </label>
												<input type="text" class="form-control margin-bottom price-sqm" name="price_per_sqm" id="price_per_sqm" readonly value="<?php echo isset($price_sqm) ? $price_sqm : ''; ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Amount: </label>
												<input type="text" class="form-control margin-bottom l-amount" name="amount" id="amount" readonly value="<?php echo isset($amount) ? $amount : ''; ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">Discount (%): </label>
												<input type="text" class="form-control margin-bottom lot-disc" name="lot_disc" id="lot_disc" value="<?php echo isset($lot_discount) ? $lot_discount : ''; ?>">
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label class="control-label">Discount Amount: </label>
												<input type="text" class="form-control margin-bottom lot-disc-amt" name="lot_disc_amt" id="lot_disc_amt" readonly value="<?php echo isset($lot_discount_amt) ? $lot_discount_amt : ''; ?>">
											</div>
										</div>
									</div>	
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Lot Contract Price: </label>
												<input type="text" class="form-control margin-bottom l-lcp" name="lcp" id="lcp" value="<?php echo isset($lcp) ? $lcp : ''; ?>">
											</div>
										</div>
									</div>
								</div>
								<div class="house_box">
									<div class="titles">House</div>
									<hr>
									<div class="row">
										<input type="hidden" class="form-control margin-bottom copy-input" name="l_house_lid" id="l_house_lid" >
										<div class="col-md-6">		
											<div class="form-group">
												<label class="control-label">House Model: </label>
												<input type="text" class="form-control margin-bottom house-model" name="house_model" id="house_model" value = "" tabindex="31">
												</select>
											</div>
										</div>
										<!-- <div class="col-md-3">
											<div class="form-group">
												<br>
												<input type="submit" class="btn btn-success float-right select-house" value="Find House Model" data-loading-text="Finding..." id="btnfind" tabindex ="37">
											</div>
										</div> -->
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">Floor area: </label>
												<input type="text" class="form-control margin-bottom floor-area" name="floor_area" id="floor_area" value="<?php echo isset($floor_area) ? $floor_area : 0; ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">House Price/SQM: </label>
												<input type="text" class="form-control margin-bottom h-price-sqm"  name="h_price_per_sqm" id="h_price_per_sqm" value="<?php echo isset($house_price_sqm) ? $house_price_sqm : 0; ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-5">
											<div class="form-group">
												<label class="control-label">House Discount(%): </label>
												<input type="text" class="form-control margin-bottom house-disc" name="house_disc" id="house_disc" value="<?php echo isset($house_discount) ? $house_discount : 0; ?>">
											</div>
										</div>
										<div class="col-md-7">
											<div class="form-group">
												<label class="control-label">House Discount Amount: </label>
												<input type="text" class="form-control margin-bottom h-disc-amt" name="house_disc_amt" id="house_disc_amt" value="<?php echo isset($house_discount_amt) ? $house_discount_amt : 0; ?>">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="control-label">House Contract Price: </label>
												<input type="text" class="form-control margin-bottom house-hcp" name="hcp" id="hcp" value="<?php echo isset($hcp) ? $hcp : 0; ?>">
											</div>
										</div>	
									</div>		
								</div>
								<div class="space"></div>
								<div class="main_box">
									<div class="row">
										<div class="col-md-3">
											<div class="form-group">
												<label class="control-label">TCP Discount:</label>
											</div>
										</div>
										<div class="col-md-3" >
											<div class="form-group">
												<input type="text" class="form-control margin-bottom tcp-disc"  name="tcp_disc" id="tcp_disc" value="<?php echo isset($tcp_discount) ? $tcp_discount : 0; ?>">
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label">TCP Disc. Amount:</label>
											</div>
										</div>
										<div class="col-md-4" >
											<div class="form-group">
												<input type="text" class="form-control margin-bottom tcp-disc-amt" name="tcp_disc_amt" id="tcp_disc_amt" value="<?php echo isset($tcp_discount_amt) ? $tcp_discount_amt : 0; ?>">
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
												<input type="text" class="form-control margin-bottom total-tcp" name="total_tcp" id="total_tcp" value="<?php echo isset($tcp) ? $tcp : 0; ?>">
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
											<input type="text" class="form-control margin-bottom vat-percent" value="<?php echo isset($vat_percent) ? $vat_percent : 0; ?>" name="vat_percent" id="vat_percent" tabindex = '39' onkeyup='getVat()'>
											</div> 
										</div> 
										<div class="col-md-2">
											<div class="form-group">
												<label class="control-label">VAT Amount:</label>
											</div>
										</div>
										<div class="col-md-4" >
											<div class="form-group">
											<input type="text" class="form-control margin-bottom vat-amt-computed" value="<?php echo isset($vat_amt_computed) ? $vat_amt_computed : 0; ?>" name="vat_amt_computed" id="vat_amt_computed" tabindex = '39'>
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
										<input type="text" class="form-control margin-bottom net-tcp"  value="<?php echo isset($net_tcp) ? $net_tcp : 0; ?>" name="net_tcp" readonly id="net_tcp" >
											<input type="hidden" name="total_net_tcp" id="total_net_tcp">
										</div>
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
								<div class="titles"><center><h4>Payment Computation<h4></center></div>
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
												<input type="text" class="form-control margin-bottom required reservation-fee" name="reservation" id="reservation" value="<?php echo isset($reservation) ? $reservation : 0; ?>" tabindex ="1" >
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
										<input type="text" class="form-control margin-bottom required amt-to-be-financed" name="amt_to_be_financed" id="amt_to_be_financed" value="<?php echo isset($amt_financed) ? $amt_financed : ''; ?>">
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
								<div class="titles"><center><h4>Agent and Commission<h4></center></div>
									<div class="clear"></div>
								</div>
							<div class="panel-body form-group form-group-sm">
								<table class="table table-bordered table-hover table-striped" id="comm_table">
									<thead>
										<tr>
											<th width="20">
												<a href="#" class="btn btn-success btn-md add-row"><span class="fa fa-plus" aria-hidden="true"></span></a>
											</th>
											<th width="500">
												<h4> Agents</h4>
											</th>
											<th  width="90">
												<h4>Position</h4>
											</th>
											<th width="90">
												<h4>Code</h4>
											</th>
											<th width="150">
												<h4>Rate</h4>
											</th>
											<th width="200">
												<h4>Amount</h4>
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

                                        endwhile;
                                        }
										?>
										<tr><td>
												<a href="#" class="btn btn-danger btn-md delete-row"><span class="fa fa-times" ></span></a>
											</td>
											<td>
												<!-- <a href="#" class="btn btn-danger btn-md delete-row"><span class="fa fa-times" aria-hidden="true"></span></a> -->
												
												<div class="form-group form-group-sm no-margin-bottom">
													<input type="text" style="width:60%" class="form-control form-group-sm item-input agent-name" name="agent_name[]" value="<?php echo isset($agent_name) ? $agent_name : ''; ?>">
													<p class="item-select"> <a href="#"  class="btn btn-flat btn-md bg-maroon" ><span class="fa fa-search" aria-hidden="true"></span> Select Existing Agent</a></p>
									
												</div>
											</td>
											<td class="text-right">
												<div class="form-group form-group-sm no-margin-bottom">
													<input type="text" class="form-control agent-pos" name="agent_position[]" value="<?php echo isset($position) ? $position : ''; ?>" readonly>
												</div>
											</td>
											<td class="text-right">
												<div class="input-group input-group-sm  no-margin-bottom">
													
													<input type="text" class="form-control agent-code" name="agent_code[]" value="<?php echo isset($code) ? $code : ''; ?>" aria-describedby="sizing-addon1" readonly>
												</div>
											</td>
											<td class="text-right">
												<div class="form-group form-group-sm  no-margin-bottom">
													<input type="number" class="form-control calculate agent-rate required" name="agent_rate[]" value="<?php echo isset($rate) ? $rate : 0; ?>">
												</div>
											</td>
											<td class="text-right">
												<div class="input-group input-group-sm">
													<input type="text" class="form-control comm-amt" name="comm_amt[]" value="<?php echo isset($comm_amt) ? $comm_amt : 0; ?>" aria-describedby="sizing-addon1">
												</div>
											</td>
										</tr>
										
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
		</form>
	</div>	<!-- /.card-body -->
	<div class="card-footer">
			<button class="btn btn-flat btn-sm btn-default bg-maroon" form="update_csr">Save</button>
			<a class="btn btn-flat btn-sm btn-default" href="./?page=sales">Cancel</a>
	</div>
</div>	<!-- /.container-fluid -->
</div>	<!-- /.card -->
<div id="insert_customer" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Select An Existing Customer</h4>
			</div>
			<div class="modal-body">
				<table class="table table-bordered table-stripped" id="data-table2">
					<thead>
						<tr>

						<th>Last Name</th>
						<th>First Name</th>
						<th>Middle Name</th>
						<th>Email</th>
						<th>Phone</th>
						<th>Actions</th>

						</tr>
					</thead>
					<tbody>
					<?php
					$query =$conn->query("SELECT * FROM t_client_info ORDER BY last_name ASC");

					while($row = $query->fetch_assoc()): ?>

						<tr>
							<td><?php echo $row["last_name"] ?></td>
							<td><?php echo $row["first_name"] ?></td>
							<td><?php echo $row["middle_name"] ?></td>
							<td><?php echo $row["email"] ?></td>
							<td><?php echo $row["contact_no"] ?></td>
							<td><a href="#" class="btn btn-primary btn-xs customer-select" data-customer-civil="<?php echo $row['civil_status']?>" data-customer-gender="<?php echo $row['gender'] ?>" data-customer-age="<?php echo $row['age'] ?>" data-customer-birthday="<?php echo $row['birthdate'] ?>" data-customer-viber="<?php echo $row['viber'] ?>" data-customer-address-1="<?php echo $row['address'] ?>" data-customer-zip-code="<?php echo $row['zip_code'] ?>"  data-customer-address-abroad="<?php echo $row['address_abroad'] ?>" data-customer-lname="<?php echo $row['last_name'] ?>" data-customer-fname="<?php echo $row['first_name'] ?>" data-customer-mname="<?php echo $row['middle_name'] ?>" data-customer-sname="<?php echo $row['suffix_name'] ?>" data-customer-email="<?php echo $row['email'] ?>" data-customer-phone="<?php echo $row['contact_no'] ?>" data-customer-ctzn="<?php echo $row['citizenship'] ?>">Select</a></td>
						</tr>
					<?php endwhile; ?>
					</tbody>
				</table>

			</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">Cancel</button>
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
			<table class="table table-bordered table-stripped" id="data-table">
				<thead>
					<tr>

						<th>Lot ID</th>
						<th>Project</th>
						<th>Block</th>
						<th>Lot</th>
						<th>Status </th>
						<th>Actions</th>

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
						<td><?php echo $row["c_lid"] ?></td>
						<td><?php echo $row["c_acronym"] ?></td>
						<td><?php echo $row["c_block"] ?></td>
						<td><?php echo $row["c_lot"] ?></td>
						<td><?php echo $row["c_status"] ?></td>
						<td><a href="#" class="btn btn-primary btn-md lot-select" data-lot-lid="<?php echo $row['c_lid'] ?>" data-house-lid="<?php echo $row['c_house_lid'] ?>" data-floor-area="<?php echo $row['c_floor_area'] ?>" data-house-price="<?php echo $row['c_h_price_sqm'] ?>" data-house-model="<?php echo $row['c_house_model'] ?>" data-lot-site="<?php echo $row['c_acronym'] ?>" data-lot-block="<?php echo $row['c_block'] ?>" data-lot-lot="<?php echo $row['c_lot'] ?>" data-lot-lot-area="<?php echo $row['c_lot_area'] ?>" data-lot-per-sqm="<?php echo $row['c_price_sqm'] ?>"><center>Select</center></a></td>
				
					</tr>
				<?php endwhile; ?>
				</tbody>
			</table>
			
		</div>
		<div class="modal-footer">
			<button type="button" data-dismiss="modal" class="btn">Cancel</button>
		</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->	
</div><!-- /.modal -->


<div id="insert" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title">Select Agent</h4>
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
			<button type="button" data-dismiss="modal" class="btn btn-primary" id="selected">Add</button>
			<button type="button" data-dismiss="modal" class="btn">Cancel</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

</body>

<script>
		




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

		$('#update_csr').submit(function(e){
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
				url:_base_url_+"classes/Master.php?f=update_csr",
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




