<?php
require_once('../config.php');
Class Master extends DBConnection {
	private $settings;
	public function __construct(){
		global $_settings;
		$this->settings = $_settings;
		parent::__construct();
	}
	public function __destruct(){
		parent::__destruct();
	}
	function capture_err(){
		if(!$this->conn->error)
			return false;
		else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
			return json_encode($resp);
			exit;
		}
	}
	function save_lot(){
		extract($_POST);
		$data = " c_site = '$prod_code' ";
		$data .= ", c_block = '$prod_block' ";
		$data .= ", c_lot = '$prod_lot' ";	 
	 	$data .= ", c_lot_area = '$prod_lot_area' ";
		$data .= ", c_price_sqm = '$prod_lot_price' "; 
		$data .= ", c_remarks = '$prod_remarks' ";
		$data .= ", c_status = '$prod_status' ";
	 	if(empty($prod_lid)){ 
			$prod_lid = sprintf('%03d%03d%02d', $prod_code, $prod_block, $prod_lot);
			$data .= ", c_lid = '$prod_lid' "; 
			$save = $this->conn->query("INSERT INTO t_lots set ".$data);
	 	}else{
			$save = $this->conn->query("UPDATE t_lots set ".$data." where c_lid = ".$prod_lid);
		} 
		if($save){
			$resp['status'] = 'success';
			if(empty($prod_lid))
				$this->settings->set_flashdata('success',"New Lot successfully saved.");
			else
				$this->settings->set_flashdata('success',"Lot successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
			
	}

	///////////////////////

	function save_agent(){
		extract($_POST);
		$data = " c_code = '$c_code' ";
		$data .= ", c_nick_name = '$c_nick_name' ";
		$data .= ", c_last_name = '$c_last_name' ";
		$data .= ", c_first_name = '$c_first_name' ";	 
		$data .= ", c_middle_initial = '$c_middle_initial' ";	 
		$data .= ", c_sex = '$c_sex' ";	 
		$data .= ", c_civil_status = '$c_civil_status' ";	 
		$data .= ", c_birthdate = '$c_birthdate' ";	 
		$data .= ", c_tel_no = '$c_tel_no' ";	 
		$data .= ", c_sss_no = '$c_sss_no' ";	
		$data .= ", c_tin = '$c_tin' ";	
		$data .= ", c_birth_place = '$c_birth_place' ";	
		$data .= ", c_address_ln1 = '$c_address_ln1' ";	
		$data .= ", c_address_ln2 = '$c_address_ln2' ";	
		$data .= ", c_hire_date = '$c_hire_date' ";	
		$data .= ", c_status = '$c_status' ";	
		$data .= ", c_recruited_by = '$c_recruited_by' ";	
		$data .= ", c_position = '$c_position' ";	
		$data .= ", c_division = '$category' ";	
		// $data .= ", c_network = '$subcategory' ";	

		if(empty($id)){
			$sql = "INSERT INTO t_agents set ".$data;
			$save = $this->conn->query($sql);
		}else{
			$save = $this->conn->query("UPDATE t_agents set ".$data." where id = ".$id);
		} 
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New agent successfully saved.");
			else
				$this->settings->set_flashdata('success',"Agent successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	
	function delete_agent(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM t_agents where c_code = ".$id);
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Agent successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);	
	}
	//////////////////

	function delete_lot(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM t_lots where c_lid = ".$id);
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Lot successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);	
	}

	function delete_user(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM users where id = ".$id);
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"User successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);	
	}

	function save_house_model(){
		extract($_POST);
		$data = " c_model = '$c_model' ";
		$data .= ", c_acronym = '$c_acronym' ";
		$data .= ", c_code = '$c_code' ";
		if(empty($prod_id)){
			$sql = "INSERT INTO t_model_house set ".$data;
			$save = $this->conn->query($sql);
		}else{
			$sql = "UPDATE t_model_house set ".$data." where c_code = ".$prod_id;
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($prod_id))
				$this->settings->set_flashdata('success',"New House Model successfully saved.");
			else
				$this->settings->set_flashdata('success',"House Model successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}

	function delete_model(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM t_model_house where c_code = ".$id);
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"House Model successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
			
	}

	function save_project(){
		extract($_POST);
		$data = " c_name = '$c_name' ";
		$data .= ", c_acronym = '$c_acronym' ";
		$data .= ", c_address = '$c_address' "; 
	 	$data .= ", c_province = '$c_province' ";
		$data .= ", c_zip = '$c_zip' "; 
		$data .= ", c_rate = '$c_rate' ";
		$data .= ", c_reservation = '$c_reservation' ";
		$data .= ", c_status = '$c_status' ";
		$data .= ", c_code = '$c_code' ";
		if(empty($prod_id)){
			
			$save = $this->conn->query("INSERT INTO t_projects set ".$data);
		}else{
			$save = $this->conn->query("UPDATE t_projects set ".$data." where c_code = ".$prod_id);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($prod_id))
				$this->settings->set_flashdata('success',"New Project Site successfully saved.");
			else
				$this->settings->set_flashdata('success',"Project Site successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}

	function delete_project(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM t_projects where c_code = ".$id);
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Project Site successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	function save_csr(){
		extract($_POST);
			
		if(empty($c_csr_no)){

			//lot computation
			$username =  $_POST['username'];
			$lot_lid = $_POST['l_lid'];
			$lot_area = $_POST['lot_area'];
			$price_sqm = $_POST['price_per_sqm'];
			$lot_disc = $_POST['lot_disc'];
			$lot_disc_amt = $_POST['lot_disc_amt'];
			$house_model = $_POST['house_model'];
			$floor_area = $_POST['floor_area'];
			$h_price_per_sqm = $_POST['h_price_per_sqm'];
			$house_disc = $_POST['house_disc'];
			$house_disc_amt = $_POST['house_disc_amt'];
			$process_fee = $_POST['process_fee'];
			$pf_month = $_POST['pf_month'];
			$total_tcp = $_POST['total_tcp'];
			$tcp_disc = $_POST['tcp_disc'];
			$tcp_disc_amt = $_POST['tcp_disc_amt'];
			$vat_amt = $_POST['vat_amt_computed'];
			$net_tcp = $_POST['net_tcp'];

			// Payment Details
			$reservation = $_POST['reservation'];
			$payment_type1 = $_POST['payment_type1'];
			$payment_type2 = $_POST['payment_type2'];
			$down_percent = $_POST['down_percent'];
			$net_dp = $_POST['net_dp'];
			$no_payment = $_POST['no_payment'];
			$monthly_down = $_POST['monthly_down'];
			$first_dp_date = $_POST['first_dp_date'];
			$full_down_date = $_POST['full_down_date'];
			$amt_to_be_financed = $_POST['amt_to_be_financed'];
			$terms= $_POST['terms'];
			$interest_rate = $_POST['interest_rate'];
			$fixed_factor = $_POST['fixed_factor'];
			$monthly_amortization = $_POST['monthly_amortization'];
			$start_date = $_POST['start_date'];
			$invoice_notes = $_POST['invoice_notes'];
			$type = $_POST['chkOption3'];

			$data = " c_lot_lid = '$lot_lid' ";
			$data .= ", c_type = '$type' ";
			$data .= ", c_lot_area = '$lot_area' ";
			$data .= ", c_price_sqm = '$price_sqm' ";
			$data .= ", c_lot_discount= '$lot_disc' ";
			$data .= ", c_lot_discount_amt = '$lot_disc_amt' ";
			$data .= ", c_house_model = '$house_model' ";
			$data .= ", c_floor_area= '$floor_area' ";
			$data .= ", c_house_price_sqm= '$h_price_per_sqm' ";
			$data .= ", c_house_discount = '$house_disc' ";
			$data .= ", c_house_discount_amt = '$house_disc_amt' ";
			$data .= ", c_processing_fee = '$process_fee' ";
			$data .= ", pf_mo = '$pf_month' ";
			$data .= ", c_tcp_discount = '$tcp_disc' ";
			$data .= ", c_tcp_discount_amt = '$tcp_disc_amt' ";
			$data .= ", c_tcp = '$total_tcp' ";
			$data .= ", c_vat_amount = '$vat_amt' ";
			$data .= ", c_net_tcp = '$net_tcp' ";
			$data .= ", c_reservation = '$reservation' ";
			$data .= ", c_payment_type1 = '$payment_type1' ";
			$data .= ", c_payment_type2 = '$payment_type2' ";
			$data .= ", c_down_percent = '$down_percent' ";
			$data .= ", c_net_dp = '$net_dp' ";
			$data .= ", c_no_payments = '$no_payment' ";
			$data .= ", c_monthly_down = '$monthly_down' ";
			$data .= ", c_first_dp = '$first_dp_date' ";
			$data .= ", c_full_down = '$full_down_date' ";
			$data .= ", c_amt_financed = '$amt_to_be_financed' ";
			$data .= ", c_terms = '$terms' ";
			$data .= ", c_interest_rate = '$interest_rate' ";
			$data .= ", c_fixed_factor = '$fixed_factor' ";
			$data .= ", c_monthly_payment = '$monthly_amortization' ";
			$data .= ", c_start_date = '$start_date' ";
			$data .= ", c_remarks = '$invoice_notes' ";
			$data .= ", c_created_by = '$username' ";
			$data .= ", c_verify = 0 ";
			$data .= ", coo_approval = 0";
			$data .= ", c_revised = 0";


			$i = 1;
			while($i== 1){
				$ref  = sprintf("%'.04d\n",mt_rand(1,9999999999));
				if($this->conn->query("SELECT * FROM t_csr where ref_no ='$ref'")->num_rows <= 0)
					$i=0;
			}
			$data .= ", ref_no = '$ref' ";
			$save = $this->conn->query("INSERT INTO t_csr set ".$data);

			// get last insert id
			$last_id = $this->conn->insert_id;

			$ac_outlets =  $_POST['aircon_outlets'];
			$ac_grill = $_POST['ac_grill'];
			$service_area = $_POST['service_area'];
			$others = $_POST['others'];
			$conv_outlet = $_POST['conv_outlet'];
			// $flr_elev = $_POST['chkOption4'];
			$service_area_price = $_POST['service_area_price'];
			$ac_outlet_price = $_POST['aircon_outlet_price'];
			$ac_grill_price = $_POST['ac_grill_price'];
			$flr_elev_price = $_POST['flrelev_price'];
			$conv_outlet_price = $_POST['conv_outlet_price'];
			$others_price = $_POST['others_price'];

			$data2 = " c_csr_no = '$last_id' ";

			$data2 .= ", aircon_outlets = '$ac_outlets' ";
			$data2 .= ", aircon_grill = '$ac_grill' ";
			$data2 .= ", service_area = '$service_area' ";
			$data2 .= ", others = '$others' ";
			$data2 .= ", conv_outlet = '$conv_outlet' ";
			// $data2 .= ", floor_elevation = '$flr_elev' ";
			$data2 .= ", service_area_price = '$service_area_price' ";
			$data2 .= ", aircon_outlet_price = '$ac_outlet_price' ";
			$data2 .= ", aircon_grill_price = '$ac_grill_price' ";
			$data2 .= ", floor_elev_price = '$flr_elev_price' ";
			$data2 .= ", conv_outlet_price = '$conv_outlet_price' ";
			$data2 .= ", others_price = '$others_price' ";

			$save = $this->conn->query("INSERT INTO t_additional_cost set ".$data2);
			
			

			foreach($_POST['agent_name'] as $key => $value) {


				$agent = $value;
			
				$agent_code = $_POST['agent_code'][$key];
				$agent_pos = $_POST['agent_position'][$key];
				$agent_amount = $_POST['comm_amt'][$key];
				$agent_rate = $_POST['agent_rate'][$key]; 

				$data = " c_csr_no = '$last_id' ";
				$data .= ", c_code = '$agent_code' ";
				$data .= ", c_position = '$agent_pos' ";
				$data .= ", c_agent = '$agent' ";
				$data .= ", c_amount = '$agent_amount' ";
				$data .= ", c_rate = '$agent_rate' ";


				$save = $this->conn->query("INSERT INTO t_csr_commission set ".$data);
				}


			$buyer_count = 1;
			foreach($_POST['last_name'] as $key => $value) {
		
				$lastname = $_POST['last_name'][$key];
				$firstname = $_POST['first_name'][$key];
				$middlename = $_POST['middle_name'][$key];
				$suffixname = $_POST['suffix_name'][$key]; 
				$address = $_POST['address'][$key];
				$zip_code = $_POST['zip_code'][$key];
				$address_abroad = $_POST['address_abroad'][$key];
				$birthdate = $_POST['birth_day'][$key];
				$age = $_POST['age'][$key];
				$viber = $_POST['viber'][$key];
				$gender = $_POST['gender'][$key];
				$civil_status = $_POST['civil_status'][$key];
				$citizenship = $_POST['citizenship'][$key];
				$id_presented = $_POST['id_presented'][$key];
				$tin_no = $_POST['tin_no'][$key];
				$email = $_POST['email'][$key];
				$contact_no = $_POST['contact_no'][$key];
				$contact_abroad = $_POST['contact_abroad'][$key];
				$relationship = $_POST['relationship'][$key];
			

				$data = " c_csr_no = '$last_id' ";
				$data .= ", c_buyer_count = '$buyer_count' ";
				$data .= ", last_name = '$lastname' ";
				$data .= ", first_name = '$firstname' ";
				$data .= ", middle_name = '$middlename' ";
				$data .= ", suffix_name = '$suffixname' ";
				$data .= ", address = '$address' ";
				$data .= ", zip_code = '$zip_code' ";
				$data .= ", address_abroad = '$address_abroad ' ";
				$data .= ", birthdate = '$birthdate ' ";
				$data .= ", age = '$age ' ";
				$data .= ", viber = '$viber ' ";
				$data .= ", gender = '$gender' ";
				$data .= ", civil_status = '$civil_status' "; 
				$data .= ", citizenship = '$citizenship' ";
				$data .= ", id_presented = '$id_presented' "; 
				$data .= ", tin_no = '$tin_no' "; 
				$data .= ", email = '$email' "; 
				$data .= ", contact_no = '$contact_no' "; 
				$data .= ", contact_abroad = '$contact_abroad' "; 
				$data .= ", relationship = '$relationship' ";

				$save = $this->conn->query("INSERT INTO t_csr_buyers set ".$data);
				$buyer_count += 1;
				}
			
		}

		if(!empty($c_csr_no)){
			$c_csr_no =  $_POST['c_csr_no'];
			//lot computation
			$username =  $_POST['username'];
			$lot_lid = $_POST['l_lid'];
			$lot_area = $_POST['lot_area'];
			$price_sqm = $_POST['price_per_sqm'];
			$lot_disc = $_POST['lot_disc'];
			$lot_disc_amt = $_POST['lot_disc_amt'];
			$house_model = $_POST['house_model'];
			$floor_area = $_POST['floor_area'];
			$h_price_per_sqm = $_POST['h_price_per_sqm'];
			$house_disc = $_POST['house_disc'];
			$house_disc_amt = $_POST['house_disc_amt'];
			$process_fee = $_POST['process_fee'];
			$pf_month = $_POST['pf_month'];
			$total_tcp = $_POST['total_tcp'];
			$tcp_disc = $_POST['tcp_disc'];
			$tcp_disc_amt = $_POST['tcp_disc_amt'];
			$vat_amt = $_POST['vat_amt_computed'];
			$net_tcp = $_POST['net_tcp'];

			// Payment Details
			$reservation = $_POST['reservation'];

			$chk_pay = $this->conn->query("SELECT COALESCE(sum(c_amount_paid), 0)  as total_reservation FROM t_reservation where c_csr_no =".$c_csr_no);
			if($chk_pay->num_rows > 0){
			while($row = $chk_pay->fetch_assoc()){
					$total = $row['total_reservation'];
					if($reservation == $total){
						$save = $this->conn->query("UPDATE t_approval_csr SET c_reserve_status = 1 , c_amount_paid = '$total', c_ca_status = 0 where c_csr_no = '$c_csr_no'");
					}else if (($reservation > $total) && ($total != 0)) {
						$save = $this->conn->query("UPDATE t_approval_csr SET c_reserve_status = 2 , c_amount_paid = '$total', c_ca_status = 0 where c_csr_no= '$c_csr_no'");
						
					}else if ($total == 0) {
						$save = $this->conn->query("UPDATE t_approval_csr SET c_reserve_status = 0 , c_amount_paid = '$total', c_ca_status = 0 where c_csr_no= '$c_csr_no'");
						
					}
				}}
			$payment_type1 = $_POST['payment_type1'];
			$payment_type2 = $_POST['payment_type2'];
			$down_percent = $_POST['down_percent'];
			$net_dp = $_POST['net_dp'];
			$no_payment = $_POST['no_payment'];
			$monthly_down = $_POST['monthly_down'];
			$first_dp_date = $_POST['first_dp_date'];
			$full_down_date = $_POST['full_down_date'];
			$amt_to_be_financed = $_POST['amt_to_be_financed'];
			$terms= $_POST['terms'];
			$interest_rate = $_POST['interest_rate'];
			$fixed_factor = $_POST['fixed_factor'];
			$monthly_amortization = $_POST['monthly_amortization'];
			$start_date = $_POST['start_date'];
			$invoice_notes = $_POST['invoice_notes'];
			$type = $_POST['chkOption3'];

			$data = " c_lot_lid = '$lot_lid' ";
			$data .= ", c_type = '$type' ";
			$data .= ", c_lot_area = '$lot_area' ";
			$data .= ", c_price_sqm = '$price_sqm' ";
			$data .= ", c_lot_discount= '$lot_disc' ";
			$data .= ", c_lot_discount_amt = '$lot_disc_amt' ";
			$data .= ", c_house_model = '$house_model' ";
			$data .= ", c_floor_area= '$floor_area' ";
			$data .= ", c_house_price_sqm= '$h_price_per_sqm' ";
			$data .= ", c_house_discount = '$house_disc' ";
			$data .= ", c_house_discount_amt = '$house_disc_amt' ";
			$data .= ", c_processing_fee = '$process_fee' ";
			$data .= ", pf_mo = '$pf_month' ";
			$data .= ", c_tcp_discount = '$tcp_disc' ";
			$data .= ", c_tcp_discount_amt = '$tcp_disc_amt' ";
			$data .= ", c_tcp = '$total_tcp' ";
			$data .= ", c_vat_amount = '$vat_amt' ";
			$data .= ", c_net_tcp = '$net_tcp' ";
			$data .= ", c_reservation = '$reservation' ";
			$data .= ", c_payment_type1 = '$payment_type1' ";
			$data .= ", c_payment_type2 = '$payment_type2' ";
			$data .= ", c_down_percent = '$down_percent' ";
			$data .= ", c_net_dp = '$net_dp' ";
			$data .= ", c_no_payments = '$no_payment' ";
			$data .= ", c_monthly_down = '$monthly_down' ";
			$data .= ", c_first_dp = '$first_dp_date' ";
			$data .= ", c_full_down = '$full_down_date' ";
			$data .= ", c_amt_financed = '$amt_to_be_financed' ";
			$data .= ", c_terms = '$terms' ";
			$data .= ", c_interest_rate = '$interest_rate' ";
			$data .= ", c_fixed_factor = '$fixed_factor' ";
			$data .= ", c_monthly_payment = '$monthly_amortization' ";
			$data .= ", c_start_date = '$start_date' ";
			$data .= ", c_remarks = '$invoice_notes' ";
			$data .= ", c_created_by = '$username' ";
			$data .= ", c_verify = 0 ";
			$data .= ", coo_approval = 0";

			$ac_outlets =  $_POST['aircon_outlets'];
			$ac_grill = $_POST['ac_grill'];
			$service_area = $_POST['service_area'];
			$others = $_POST['others'];
			$conv_outlet = $_POST['conv_outlet'];
			$flr_elev = $_POST['chkOption4'];
			$service_area_price = $_POST['service_area_price'];
			$ac_outlet_price = $_POST['aircon_outlet_price'];
			$ac_grill_price = $_POST['ac_grill_price'];
			$flr_elev_price = $_POST['flrelev_price'];
			$conv_outlet_price = $_POST['conv_outlet_price'];
			$others_price = $_POST['others_price'];

			


			$data2 = " aircon_outlets = '$ac_outlets' ";
			$data2 .= ", aircon_grill = '$ac_grill' ";
			$data2 .= ", service_area = '$service_area' ";
			$data2 .= ", others = '$others' ";
			$data2 .= ", conv_outlet = '$conv_outlet' ";
			$data2 .= ", floor_elevation = '$flr_elev' ";
			$data2 .= ", service_area_price = '$service_area_price' ";
			$data2 .= ", aircon_outlet_price = '$ac_outlet_price' ";
			$data2 .= ", aircon_grill_price = '$ac_grill_price' ";
			$data2 .= ", floor_elev_price = '$flr_elev_price' ";
			$data2 .= ", conv_outlet_price = '$conv_outlet_price' ";
			$data2 .= ", others_price = '$others_price' ";

			$this->conn->query("UPDATE t_additional_cost set ".$data2." where c_csr_no = ".$c_csr_no);
				
			

		
		
			$this->conn->query("UPDATE t_csr set ".$data." where c_csr_no = ".$c_csr_no);
			$this->conn->query("DELETE FROM t_csr_buyers where c_csr_no = ".$c_csr_no);
			$this->conn->query("DELETE FROM t_csr_commission where c_csr_no = ".$c_csr_no);
			// get last insert id
			$last_id = $c_csr_no;


			

			foreach($_POST['agent_name'] as $key => $value) {
				$agent = $value;
				$agent_code = $_POST['agent_code'][$key];
				$agent_pos = $_POST['agent_position'][$key];
				$agent_amount = $_POST['comm_amt'][$key];
				$agent_rate = $_POST['agent_rate'][$key]; 

				$data = " c_csr_no = '$last_id' ";
				$data .= ", c_code = '$agent_code' ";
				$data .= ", c_position = '$agent_pos' ";
				$data .= ", c_agent = '$agent' ";
				$data .= ", c_amount = '$agent_amount' ";
				$data .= ", c_rate = '$agent_rate' ";


				$save = $this->conn->query("INSERT INTO t_csr_commission set ".$data);
				}




			$buyer_count = 1;
			foreach($_POST['last_name'] as $key => $value) {
		
				$lastname = $_POST['last_name'][$key];
				$firstname = $_POST['first_name'][$key];
				$middlename = $_POST['middle_name'][$key];
				$suffixname = $_POST['suffix_name'][$key]; 
				$address = $_POST['address'][$key];
				$zip_code = $_POST['zip_code'][$key];
				$address_abroad = $_POST['address_abroad'][$key];
				$birthdate = $_POST['birth_day'][$key];
				$age = $_POST['age'][$key];
				$viber = $_POST['viber'][$key];
				$gender = $_POST['gender'][$key];
				$civil_status = $_POST['civil_status'][$key];
				$citizenship = $_POST['citizenship'][$key];
				$id_presented = $_POST['id_presented'][$key];
				$tin_no = $_POST['tin_no'][$key];
				$email = $_POST['email'][$key];
				$contact_no = $_POST['contact_no'][$key];
				$contact_abroad = $_POST['contact_abroad'][$key];
				$relationship = $_POST['relationship'][$key];
			

				$data = " c_csr_no = '$last_id' ";
				$data .= ", c_buyer_count = '$buyer_count' ";
				$data .= ", last_name = '$lastname' ";
				$data .= ", first_name = '$firstname' ";
				$data .= ", middle_name = '$middlename' ";
				$data .= ", suffix_name = '$suffixname' ";
				$data .= ", address = '$address' ";
				$data .= ", zip_code = '$zip_code' ";
				$data .= ", address_abroad = '$address_abroad ' ";
				$data .= ", birthdate = '$birthdate ' ";
				$data .= ", age = '$age ' ";
				$data .= ", viber = '$viber ' ";
				$data .= ", gender = '$gender' ";
				$data .= ", civil_status = '$civil_status' "; 
				$data .= ", citizenship = '$citizenship' ";
				$data .= ", id_presented = '$id_presented' "; 
				$data .= ", tin_no = '$tin_no' "; 
				$data .= ", email = '$email' "; 
				$data .= ", contact_no = '$contact_no' "; 
				$data .= ", contact_abroad = '$contact_abroad' "; 
				$data .= ", relationship = '$relationship' ";

				$save = $this->conn->query("INSERT INTO t_csr_buyers set ".$data);
				$buyer_count += 1;
				}
		}
		
		if($save){
			$resp['status'] = 'success';
			if(empty($c_csr_no))
				$this->settings->set_flashdata('success',"New RA successfully saved.");
			else
				$this->settings->set_flashdata('success',"RA successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);

	}

	function delete_csr(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM t_csr where c_csr_no = ".$id);
		$del2 = $this->conn->query("DELETE FROM t_csr_buyers where c_csr_no = ".$id);
		$del3 = $this->conn->query("DELETE FROM t_csr_commission where c_csr_no = ".$id);
		if($del && $del2 && $del3){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"RA successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}

	function save_client(){
		extract($_POST);
		$data = " last_name = '$customer_last_name' ";
		$data .= ", first_name = '$customer_first_name' ";
		$data .= ", middle_name = '$customer_middle_name' ";
		$data .= ", suffix_name = '$customer_suffix_name' ";
		$data .= ", address = '$customer_address' ";
		$data .= ", zip_code = '$customer_zip_code' ";
		$data .= ", address_abroad = '$customer_address_2' ";
		$data .= ", birthdate = '$birth_day' ";
		$data .= ", age = '$customer_age' ";
		$data .= ", gender = '$customer_gender' ";
		$data .= ", viber = '$customer_viber' ";
		$data .= ", civil_status = '$civil_status' ";
		$data .= ", citizenship = '$citizenship' ";
		$data .= ", email = '$customer_email' ";
		$data .= ", contact_no = '$contact_no' ";
		$data .= ", c_created_by = '$username' ";

		
		$check = $this->conn->query("SELECT * FROM `t_buyer_info` where `last_name` = '{$customer_last_name}' and
		 `first_name` = '{$customer_first_name}' and `middle_name` = '{$customer_middle_name}' ".(!empty($id) ? " and id != {$id} " : "")." ")->num_rows;
		if($this->capture_err())
			return $this->capture_err();
		if($check > 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Buyer already exist.";
			return json_encode($resp);
			exit;
		} 
		if(empty($id)){
			/* $sql = "SELECT * FROM t_buyer_info"; */
			$sql = "INSERT INTO t_buyer_info set ".$data;
			$save = $this->conn->query($sql);
		}else{
			/* $sql = "SELECT * FROM t_buyer_info"; */
			$sql = "UPDATE t_buyer_info set ".$data." where id = ".$id;
			$save = $this->conn->query($sql);
		}
		if($save){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New Buyer successfully saved.");
			else
				$this->settings->set_flashdata('success',"Buyer successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}

	function sm_verification(){
		extract($_POST);
	 	$check = $this->conn->query("SELECT * FROM t_csr where c_verify = 1 and c_active = 1 and c_lot_lid ='{$lid}'")->num_rows;
		if($this->capture_err())
		 	return $this->capture_err();
		if($check > 0 && $value == 1){
			$resp['status'] = 'failed';
			$resp['msg'] = "Lot already verified.";
			return json_encode($resp);
			exit;
		} 
		if($check == 0){
			if ($value == 2){
				$save = $this->conn->query("UPDATE t_csr SET c_active = 0 where c_csr_no = ".$id);
			}
			$save = $this->conn->query("UPDATE t_csr SET c_verify = ".$value." where c_csr_no = ".$id);
			}
		else{
			if ($value == 2){
				$save = $this->conn->query("UPDATE t_csr SET c_active = 0 where c_csr_no = ".$id);
			}
			$save = $this->conn->query("UPDATE t_csr SET c_verify = ".$value." where c_csr_no = ".$id);
		}
		if($save){
			if($value == 1){

				$resp['status'] = 'success';
			
				$this->settings->set_flashdata('success',"RA successfully verified.");
			}else{

				
				$resp['status'] = 'success';
			
				$this->settings->set_flashdata('success',"RA successfully void.");
			}
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}



	function coo_approval(){
		extract($_POST);
		

		$data = " c_csr_no = '$id' ";
		$data .= ", c_lot_lid = '$lid' ";
		$data .= ", c_csr_status = '$value' ";
		$data .= ", c_reservation_amt = $reservation_amt "; 
		$data .= ", c_ca_status = '0' ";
		$data .= ", c_date_approved = CURRENT_TIMESTAMP() ";
		$data .= ", c_duration = DATE_ADD(CURRENT_TIMESTAMP(),INTERVAL $duration DAY)";

		$check = $this->conn->query("SELECT * FROM t_approval_csr where c_csr_no =".$id)->num_rows;
		if($check > 0){
		
			$save = $this->conn->query("UPDATE t_approval_csr set ".$data." where c_csr_no =".$id);
			$save2 = $this->conn->query("UPDATE t_csr SET coo_approval = ".$value." where c_csr_no = ".$id);
			
			
			if($save && $save2){
				$resp['status'] = 'success';
			
				$this->settings->set_flashdata('success',"RA successfully approved.");
			}	
			else{
				$resp['status'] = 'failed';
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
			return json_encode($resp);
			exit;



		}else{
			$check2 = $this->conn->query("SELECT * FROM t_lots where c_status = 'Available' and c_lid =".$lid);
			if($check2->num_rows == 0){
				$resp['status'] = 'failed';
				$resp['msg'] = "Lot is not Available.";
				return json_encode($resp);
				exit;
			}else{
				$save = $this->conn->query("UPDATE t_lots set c_status = 'Pre-Reserved' where c_lid =".$check2->fetch_array()['c_lid']);
				$save2 = $this->conn->query("UPDATE t_csr SET coo_approval = ".$value." where c_csr_no = ".$id); 
				$save3 = $this->conn->query("INSERT INTO t_approval_csr set ".$data);
			}
		
			if($save &&  $save2 && $save3){
				$resp['status'] = 'success';
			
				$this->settings->set_flashdata('success',"RA successfully approved.");
			}	
			else{
				$resp['status'] = 'failed';
				$resp['err'] = $this->conn->error."[{$sql}]";
			}
			return json_encode($resp);
			}
	


		}
		
	function extend_coo_approval(){
		extract($_POST);
		$data = "c_duration = DATE_ADD('$ext_duration',INTERVAL $duration DAY)";
		$save = $this->conn->query("UPDATE t_approval_csr set ".$data." where c_csr_no =".$id);
				
		if($save){
			$resp['status'] = 'success';
		
			$this->settings->set_flashdata('success',"RA approval extend successfully.");
		}	
		else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
		exit;

	}	


	
	function coo_disapproval(){
		extract($_POST);
		$data = ", c_lot_lid = '$lid' ";
		$data .= ", c_csr_status = '$value' ";
		$check = $this->conn->query("SELECT * FROM t_approval_csr where c_csr_no =".$id)->num_rows;
		if($check > 0){
			$dis = $this->conn->query("UPDATE t_approval_csr set ".$data." where c_csr_no =".$id);
			$dis = $this->conn->query("UPDATE t_csr SET c_active = 0, coo_approval = ".$value." where c_csr_no = ".$id);
		}else{
			$dis = $this->conn->query("UPDATE t_csr SET c_active = 0, coo_approval = ".$value." where c_csr_no = ".$id);
		}

		if($dis){
			$resp['status'] = 'success';
		
			$this->settings->set_flashdata('success',"RA successfully disapproved.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
		
		
	}

	function cancel_approval(){
		extract($_POST);
		$check = $this->conn->query("SELECT * FROM t_approval_csr where c_csr_no =".$id)->num_rows;
		if($check > 0){
			$dis = $this->conn->query("UPDATE t_approval_csr set c_csr_status = 3, c_duration = CURRENT_TIMESTAMP() where c_csr_no =".$id);
			$dis2 = $this->conn->query("UPDATE t_csr SET c_active = 0, coo_approval = 3 where c_csr_no = ".$id);
			$update = $this->conn->query("UPDATE t_lots SET c_status = 'Available' WHERE c_lid = ".$lid);
		}

		if($dis && $dis2 && $update){
			$resp['status'] = 'success';
		
			$this->settings->set_flashdata('success',"RA successfully cancelled.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
		
		
	}

	function save_reservation(){
		extract($_POST);
		$data = " ra_no = '$ra_no' ";
		$data .= ", c_csr_no = '$csr_no' ";
		$data .= ", c_lot_id = '$lot_lid' ";
		$data .= ", c_or_no = '$or_no' ";
		$data .= ", c_reserve_date = CURRENT_TIMESTAMP() " ;
		$data .= ", c_amount_paid = '$amount_paid' ";

		if(empty($id)){
			$save = $this->conn->query("INSERT INTO t_reservation set ".$data);
			
		}else{
			$save = $this->conn->query("UPDATE t_reservation set ".$data." where id = ".$id);
		}

		$chk_pay = $this->conn->query("SELECT sum(c_amount_paid) as total_reservation FROM t_reservation where c_csr_no =".$csr_no);				
		while($row = $chk_pay->fetch_assoc()):
			$total = $row['total_reservation'];
				
			$data2 = ", c_amount_paid = '$total'";
			$data2 .= ",c_date_reserved = CURRENT_TIMESTAMP()";
			$data2 .= ", c_reserved_duration = DATE_ADD(CURRENT_TIMESTAMP(),INTERVAL 30 DAY)";
			$data2 .= ", c_ca_status = 0";


			if($total_res == $total){
				$check = $this->conn->query("UPDATE t_approval_csr SET c_reserve_status = 1 ".$data2."  where ra_id =".$ra_no);
				$check = $this->conn->query("UPDATE t_lots SET c_status = 'Reserved' where c_lid =".$lot_lid);
				
			}else if($total_res > $total && $total != 0){
				$check = $this->conn->query("UPDATE t_approval_csr SET c_reserve_status = 2 ".$data2." where ra_id =".$ra_no);
				$check = $this->conn->query("UPDATE t_lots SET c_status = 'Pre-Reserved' where c_lid =".$lot_lid);
			}else{
				$check = $this->conn->query("UPDATE t_approval_csr SET c_reserve_status = 0 ".$data2." where ra_id =".$ra_no);
				$check = $this->conn->query("UPDATE t_lots SET c_status = 'Pre-Reserved' where c_lid =".$lot_lid);
			}
			endwhile;
		
		
		if($check){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New Reservation successfully saved.");
			else
				$this->settings->set_flashdata('success',"Reservation successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}

	function delete_reservation(){
		extract($_POST);
		$del = $this->conn->query("DELETE FROM t_reservation where id = ".$id);		
		$chk_pay = $this->conn->query("SELECT sum(c_amount_paid) as total_reservation FROM t_reservation where ra_no =".$ra_no);				
		while($row = $chk_pay->fetch_assoc()):
			$total = $row['total_reservation'];
			$chk_tot = $this->conn->query("SELECT c_reservation_amt FROM t_approval_csr where ra_id =".$ra_no);
			while($row2 = $chk_tot->fetch_assoc()):
				$total_res = $row2['c_reservation_amt'];
				endwhile;
			if($total_res == $total){
				$check = $this->conn->query("UPDATE t_approval_csr SET c_reserve_status = 1 , c_amount_paid = '$total', c_ca_status = 0 where ra_id =".$ra_no);
				$check2 = $this->conn->query("UPDATE t_lots SET c_status = 'Reserved' where c_lid =".$lid);
				
			}else if($total_res > $total && $total != 0){
				$check = $this->conn->query("UPDATE t_approval_csr SET c_reserve_status = 2 , c_amount_paid = '$total', c_ca_status = 0 where ra_id =".$ra_no);
				$check2 = $this->conn->query("UPDATE t_lots SET c_status = 'Pre-Reserved' where c_lid =".$lid);
			}else{
				$check = $this->conn->query("UPDATE t_approval_csr SET c_reserve_status = 0 , c_amount_paid = '$total', c_ca_status = 0 where ra_id =".$ra_no);
				$check2 = $this->conn->query("UPDATE t_lots SET c_status = 'Pre-Reserved' where c_lid =".$lid);
			}
			endwhile;

		if($del && $check && $check2){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Payment successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);

	}

	
	function upload_file(){
		extract($_FILES);
		extract($_POST);
		$getID = $_POST['id'];
		$title = $_POST["title"];
		$pname = $_POST['getFileName'];
		$save = $this->conn->query("INSERT into tbl_attachments(c_csr_no,title,name) VALUES('$getID','$title','".$pname."')");
		
		if($save){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"File successfully uploaded.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);


	}
	function approved_upload(){
		extract($_POST);
		$id =  $_POST['id'];
		$csr_no =  $_POST['csr_no'];
		$ra_id =  $_POST['ra_id'];
	
		$save = $this->conn->query("UPDATE tbl_attachments SET approval_status = '1' where id=".$id);
		$save = $this->conn->query("UPDATE t_csr SET c_verify = 0, coo_approval = 0, c_revised = 1 where c_csr_no = ".$csr_no);  
		$save = $this->conn->query("UPDATE t_approval_csr SET c_csr_status = 0 where ra_id = ".$ra_id);
		if($save){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"File successfully approved.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}


	function delete_upload(){
		extract($_POST);
		$id =  $_POST['id'];
		
		$sql = $this->conn->query("SELECT * FROM tbl_attachments where id=" .$id);
		while($row = $sql->fetch_assoc()){
			$name = $row['name'];
		}
		$save = $this->conn->query("DELETE FROM tbl_attachments where id=" .$id);
		if($save){
			$resp['name'] = $name;
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"File successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}
	
	function ca_approval(){
		extract($_POST);
		$data = " c_ca_status = '$value' ";
		if ($value == 1):
			$save = $this->conn->query("UPDATE t_approval_csr SET ".$data." where ra_id = ".$ra_id);
		elseif ($value == 2):
			$save = $this->conn->query("UPDATE t_csr SET c_active = 0 where c_csr_no = ".$id);
			$save = $this->conn->query("UPDATE t_lots set c_status = 'Available' where c_lid =".$lot_id);
			$save = $this->conn->query("UPDATE t_approval_csr SET c_ca_status = ".$value." where ra_id = ".$ra_id);
		elseif ($value == 3):
			/* $save = $this->conn->query("UPDATE t_csr SET c_verify = 0, coo_approval = 0, c_revised = 1 where c_csr_no = ".$id); */
			$save = $this->conn->query("UPDATE t_approval_csr SET c_ca_status = ".$value." where ra_id = ".$ra_id);
		endif;

		if($save){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"RA successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);
	}

	function save_ca(){
		extract($_POST);
		$data = "";
		$doc_req1=  isset($_POST['doc_req1']) ? $doc_req1 : 0; 
		$doc_req2=  isset($_POST['doc_req2']) ? $doc_req2 : 0; 
		$doc_req3=  isset($_POST['doc_req3']) ? $doc_req3 : 0; 
		$ver_doc1=  isset($_POST['ver_doc1']) ? $ver_doc1 : 0; 
		$ver_doc2=  isset($_POST['ver_doc2']) ? $ver_doc2 : 0; 

		$data .= " c_csr_no = '$csr_no'";
		$data .= ", loan_amt = '$loan_amt'";
		$data .= ", terms = '$max_term'";
		$data .= ", gross_income = '$gross_income'"; 
		$data .= ", co_borrower = '$co_borrower'";
		$data .= ", total = '$total' ";
		$data .= ", income_req = '$income_req'";
		$data .= ", interest = '$int_rate' ";
		$data .= ", terms_month = '$term_rate' ";
		$data .= ", monthly = '$monthly' ";
		$data .= ", doc_req1 = $doc_req1";
		$data .= ", doc_req2 = $doc_req2";
		$data .= ", doc_req3 = $doc_req3";
		$data .= ", ver_doc1 = '$ver_doc1'";
		$data .= ", ver_doc2 = '$ver_doc2'";
		$data .= ", doc_req_remarks = '$remark_doc' ";
		$data .= ", ver_doc_remarks = '$remark_ver' ";

		if(empty($id)){
		
			$save = $this->conn->query("INSERT INTO t_ca_requirement set ".$data);
		}else{
			$save = $this->conn->query("UPDATE t_ca_requirement set ".$data." WHERE id =".$id);
		}
		$id = !empty($id) ? $id : $this->conn->insert_id;
		$resp['status'] = 'success';
		$resp['id'] = $id;
		$resp['id_encrypt'] = md5($csr_no);
		$this->settings->set_flashdata('success',"Evaluation successfully saved.");
	
		return json_encode($resp);
	}

	function print_payment(){
		extract($_POST);
	
		$data = "";

		$data .= " client_id = '$client_id'";
		$data .= ", loan_amt = '$loan_amt'";
		$data .= ", terms = '$max_term'";
		$data .= ", gross_income = '$gross_income'"; 
		$data .= ", co_borrower = '$co_borrower'";
		$data .= ", total = '$total' ";
		$data .= ", income_req = '$income_req'";
		$data .= ", interest = '$int_rate' ";
		$data .= ", terms_month = '$term_rate' ";
		$data .= ", monthly = '$monthly' ";
		$data .= ", doc_req1 = $doc_req1";
		$data .= ", doc_req2 = $doc_req2";
		$data .= ", doc_req3 = $doc_req3";
		$data .= ", ver_doc1 = '$ver_doc1'";
		$data .= ", ver_doc2 = '$ver_doc2'";
		$data .= ", doc_req_remarks = '$remark_doc' ";
		$data .= ", ver_doc_remarks = '$remark_ver' ";

		if(empty($id)){
		
			$save = $this->conn->query("INSERT INTO t_ca_requirement set ".$data);
		}else{
			$save = $this->conn->query("UPDATE t_ca_requirement set ".$data." WHERE id =".$id);
		}
		$id = !empty($id) ? $id : $this->conn->insert_id;
		$resp['status'] = 'success';
		$resp['id'] = $id;
		$resp['id_encrypt'] = md5($csr_no);
		$this->settings->set_flashdata('success',"Evaluation successfully saved.");
	
		return json_encode($resp);
	}

	function cfo_booked(){

		extract($_POST);
		$sql = $this->conn->query("SELECT * FROM t_csr where c_csr_no =".$csr_no);
		while($row = $sql->fetch_array()):
			//lot computation
			$lot_lid = $row['c_lot_lid'];
			$lot_area = $row['c_lot_area'];
			$price_sqm = $row['c_price_sqm'];
			$lot_disc = $row['c_lot_discount'];
			$lot_disc_amt = $row['c_lot_discount_amt'];
			$house_model = $row['c_house_model'];
			$floor_area = $row['c_floor_area'];
			$h_price_per_sqm = $row['c_house_price_sqm'];
			$house_disc = $row['c_house_discount'];
			$house_disc_amt = $row['c_house_discount_amt'];
			$total_tcp = $row['c_tcp'];
			$tcp_disc = $row['c_tcp_discount'];
			$tcp_disc_amt = $row['c_tcp_discount_amt'];
			$vat_amt = $row['c_vat_amount'];
			$net_tcp = $row['c_net_tcp'];
			$type = $row['c_type'];

			// Payment Details
			$reservation = $row['c_reservation'];
			$payment_type1 = $row['c_payment_type1'];
			$payment_type2 = $row['c_payment_type2'];
			$down_percent = $row['c_down_percent'];
			$net_dp = $row['c_net_dp'];
			$no_payment = $row['c_no_payments'];
			$monthly_down = $row['c_monthly_down'];
			$first_dp_date = $row['c_first_dp'];
			$full_down_date = $row['c_full_down'];
			$amt_to_be_financed = $row['c_amt_financed'];
			$terms= $row['c_terms'];
			$interest_rate = $row['c_interest_rate'];
			$fixed_factor = $row['c_fixed_factor'];
			$monthly_amortization = $row['c_monthly_payment'];
			$start_date = $row['c_start_date'];
			$remarks = $row['c_remarks'];
			$active = $row['c_active'];
			$code = substr($lot_lid, 0, 3);

			$qry = $this->conn->query("SELECT c_project_code FROM t_projects where c_code =".$code);
			$proj_code = $qry->fetch_array();

			$proj_id = $proj_code['c_project_code'];
			
			$data = " c_csr_no = '$csr_no' ";
			$data .= ", project_id = '$proj_id' ";
			$data .= ", c_type = '$type' ";
			$data .= ", c_account_status = 'Reservation' ";
			$data .= ", c_account_type = 'LOC' ";
			$data .= ", c_account_type1 = 'REG' ";
			$data .= ", c_lot_lid = '$lot_lid' ";
			$data .= ", c_lot_area = '$lot_area' ";
			$data .= ", c_price_sqm = '$price_sqm' ";
			$data .= ", c_lot_discount= '$lot_disc' ";
			$data .= ", c_lot_discount_amt = '$lot_disc_amt' ";
			$data .= ", c_house_model = '$house_model' ";
			$data .= ", c_floor_area= '$floor_area' ";
			$data .= ", c_house_price_sqm= '$h_price_per_sqm' ";
			$data .= ", c_house_discount = '$house_disc' ";
			$data .= ", c_house_discount_amt = '$house_disc_amt' ";
			$data .= ", c_tcp_discount = '$tcp_disc' ";
			$data .= ", c_tcp_discount_amt = '$tcp_disc_amt' ";
			$data .= ", c_tcp = '$total_tcp' ";
			$data .= ", c_vat_amount = '$vat_amt' ";
			$data .= ", c_net_tcp = '$net_tcp' ";
			$data .= ", c_reservation = '$reservation' ";
			$data .= ", c_payment_type1 = '$payment_type1' ";
			$data .= ", c_payment_type2 = '$payment_type2' ";
			$data .= ", c_down_percent = '$down_percent' ";
			$data .= ", c_net_dp = '$net_dp' ";
			$data .= ", c_no_payments = '$no_payment' ";
			$data .= ", c_monthly_down = '$monthly_down' ";
			$data .= ", c_first_dp = '$first_dp_date' ";
			$data .= ", c_full_down = '$full_down_date' ";
			$data .= ", c_amt_financed = '$amt_to_be_financed' ";
			$data .= ", c_terms = '$terms' ";
			$data .= ", c_interest_rate = '$interest_rate' ";
			$data .= ", c_fixed_factor = '$fixed_factor' ";
			$data .= ", c_monthly_payment = '$monthly_amortization' ";
			$data .= ", c_start_date = '$start_date' ";
			$data .= ", c_remarks = '$remarks' ";
			$data .= ", c_active = '$active' ";
			$balance = ($net_tcp - $reservation);
			$data .= ", c_balance = '$balance' ";


			endwhile;

	/* 	$check2 = $this->conn->query("SELECT * FROM t_lots where c_status = 'Sold' and c_lid =".$lot_lid);
		if($check2->num_rows == 0){
			$resp['status'] = 'failed';
			$resp['msg'] = "Lot is already Sold";
			return json_encode($resp);
			exit;
		}else{
			$update = $this->conn->query("UPDATE t_lots set c_status = 'Sold' where c_lid =".$check2->fetch_array()['c_lid']);
		}
 */
		$update = $this->conn->query("UPDATE t_lots set c_status = 'Sold' where c_lid =".$lot_lid);
		$save = $this->conn->query("INSERT INTO properties set ".$data);

		$find =  $this->conn->query("SELECT property_id FROM properties where c_csr_no =".$csr_no);
		$row3 = $find->fetch_assoc();
		$new_property_id = $row3["property_id"];
	
		$payment_count = 1;
		$new_balance = $net_tcp;
		$qry_pay = $this->conn->query("SELECT * FROM t_reservation where c_csr_no =".$csr_no." order by c_reserve_date");
		while($pay_row = $qry_pay->fetch_array()):
			$pay_date = date("Y-m-d", strtotime($pay_row['c_reserve_date'])); 
			$due_date = date("Y-m-d", strtotime($pay_row['c_reserve_date'])); 
			$or_no = $pay_row['c_or_no'];
			$amount_paid =  $pay_row['c_amount_paid'];

			$new_balance -= $amount_paid;

			$data = " property_id = '$new_property_id' "; 
			$data .= ", pay_date = '$pay_date' "; 
			$data .= ", due_date = '$due_date' ";
			$data .= ", or_no = '$or_no' "; 
			$data .= ", amount_due = 0 "; 
			$data .= ", payment_amount = '$amount_paid' "; 
			$data .= ", rebate = 0 "; 
			$data .= ", surcharge = 0 "; 
			$data .= ", interest = 0 ";
			$data .= ", principal = '$amount_paid' ";
			$data .= ", status = 'RES' ";
			$data .= ", remaining_balance = '$new_balance' ";
			$data .= ", payment_count = '$payment_count' ";

			$save5 = $this->conn->query("INSERT INTO property_payments set ".$data);
			
			$payment_count += 1;
			
		endwhile;

		//echo $new_property_id;
		//save to client
		$sql2 = $this->conn->query("SELECT * FROM t_csr_buyers where c_csr_no =".$csr_no." order by c_buyer_count");
		while($row2 = $sql2->fetch_array()):
			$lastname = $row2['last_name'];
			$firstname = $row2['first_name'];
			$middlename = $row2['middle_name'];
			$suffixname = $row2['suffix_name']; 
			$address = $row2['address'];
			$zip_code = $row2['zip_code'];
			$address_abroad = $row2['address_abroad'];
			$birthdate = $row2['birthdate'];
			$age = $row2['age'];
			$viber = $row2['viber'];
			$gender = $row2['gender'];
			$civil_status = $row2['civil_status'];
			$citizenship = $row2['citizenship'];
			$id_presented = $row2['id_presented'];
			$tin_no = $row2['tin_no'];
			$email = $row2['email'];
			$contact_no = $row2['contact_no'];
			$contact_abroad = $row2['contact_abroad'];
			$relationship = $row2['relationship'];
			$buyer_count = $row2['c_buyer_count'];
		
		
			if ($buyer_count == 1):
				$i = 1;
				while($i== 1){
					$year = date("y");
					$birthdate = date("ymd", strtotime($birthdate));
					$random = sprintf("%05d", mt_rand(0, 99999));
					$client_id = $year . $birthdate . $random;
					if($this->conn->query("SELECT * FROM property_clients where client_id ='$client_id'")->num_rows <= 0)
						$i=0;
				}
				$data = " client_id= '$client_id'";
				$data .= ",property_id = '$new_property_id' ";
				$data .= ",c_buyer_count = '$buyer_count' ";
				$data .= ", last_name = '$lastname' ";
				$data .= ", first_name = '$firstname' ";
				$data .= ", middle_name = '$middlename' ";
				$data .= ", suffix_name = '$suffixname' ";
				$data .= ", address = '$address' ";
				$data .= ", zip_code = '$zip_code' ";
				$data .= ", address_abroad = '$address_abroad ' ";
				$data .= ", birthdate = '$birthdate ' ";
				$data .= ", age = '$age ' ";
				$data .= ", viber = '$viber ' ";
				$data .= ", gender = '$gender' ";
				$data .= ", civil_status = '$civil_status' "; 
				$data .= ", citizenship = '$citizenship' ";
				$data .= ", id_presented = '$id_presented' "; 
				$data .= ", tin_no = '$tin_no' "; 
				$data .= ", email = '$email' "; 
				$data .= ", contact_no = '$contact_no' "; 
				$data .= ", contact_abroad = '$contact_abroad' "; 
				$data .= ", relationship = '$relationship' ";

				$save2 = $this->conn->query("INSERT INTO property_clients set ".$data);

			elseif($buyer_count >= 2):

				$data = "client_id = '$client_id' ";
				$data .= ",c_buyer_count = '$buyer_count' ";
				$data .= ", last_name = '$lastname' ";
				$data .= ", first_name = '$firstname' ";
				$data .= ", middle_name = '$middlename' ";
				$data .= ", suffix_name = '$suffixname' ";
				$data .= ", address = '$address' ";
				$data .= ", zip_code = '$zip_code' ";
				$data .= ", address_abroad = '$address_abroad ' ";
				$data .= ", birthdate = '$birthdate ' ";
				$data .= ", age = '$age ' ";
				$data .= ", viber = '$viber ' ";
				$data .= ", gender = '$gender' ";
				$data .= ", civil_status = '$civil_status' "; 
				$data .= ", citizenship = '$citizenship' ";
				$data .= ", id_presented = '$id_presented' "; 
				$data .= ", tin_no = '$tin_no' "; 
				$data .= ", email = '$email' "; 
				$data .= ", contact_no = '$contact_no' "; 
				$data .= ", contact_abroad = '$contact_abroad' "; 
				$data .= ", relationship = '$relationship' ";

				$save3 = $this->conn->query("INSERT INTO family_members set ".$data);
			endif;

			endwhile;

		
		$save4 = $this->conn->query("UPDATE t_approval_csr set cfo_status = 1 where c_csr_no =".$csr_no);

		if($save && $save2 && $save5 && $save4){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"New Property successfully saved.");

		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		
		return json_encode($resp);


	}

	function save_payment(){
		extract($_POST);

		$payments = $this->conn->query("SELECT due_date,pay_date, payment_amount,amount_due,surcharge,interest,principal,remaining_balance,status,status_count,payment_count FROM property_payments WHERE property_id = ".$prop_id." ORDER by due_date, pay_date, payment_count, remaining_balance DESC");
        $l_last = $payments->num_rows - 1;
        $payments_data = array(); 
        if($payments->num_rows <= 0){
            echo ('No Payment Records for this Account!');
        } 
        while($row = $payments->fetch_assoc()) {
          $payments_data[] = $row; 

        }
		
		$rebate = $rebate_amt;
        $last_cnt = $l_last;
        $payment_rec = $payments_data;
        $last_payment = $payments_data[$l_last];

		$amount_paid = (float) str_replace(",", "", $amount_paid);
		$tot_amount_due = (float) str_replace(",", "", $tot_amount_due);
		$status_count = $status_count ;
		$payment_count = $payment_count + 1;

		
		$to_principal_rbt = 0;
		$l_status = '';
		//rem set to zero for cts
		$rem_prcnt = 0;
		//echo $status;

		if ((($payment_type1 == 'Partial DownPayment') && ($acc_status == 'Reservation') || ($acc_status == 'Partial DownPayment')) || ($payment_type1 == 'Full DownPayment') && ($acc_status == 'Full DownPayment') && ($acc_status == 'Partial DownPayment')){
			$rebate = 0;
			$interest = 0;
			if (($acc_status == 'Reservation') && ($status != 'FD')) {
				$status = 'PD - ' . strval($status_count);
				$l_status = 'Partial DownPayment';
			} elseif ($acc_status == 'Partial DownPayment') {
				if ($status == 'FD' && ($amount_paid >= $tot_amount_due)) {
					$status = 'FD';
					$l_status = 'Full DownPayment';
					$l_for_cts = 1;
				} elseif ($status == 'FD' && ($amount_paid) < $tot_amount_due) {
					$status = 'PD';
					$l_for_cts = 0;
				} else {
					$status = 'PD - ' . strval($status_count);
				}
			}

			if ($under_pay == 0) {
				if ($amount_paid <$tot_amount_due){
					if ($amount_paid <= $surcharge) {
						$principal = 0;
					} else {
						$principal = number_format($amount_paid - $surcharge,2);
					}
					$excess = -1;
				} elseif ($amount_paid > $tot_amount_due) {
					$excess = $amount_paid - $tot_amount_due;
					$amount_paid = $tot_amount_due;
					$or_no_ent = $or_no_ent;
					$principal = number_format($amount_paid - $surcharge,2);
				} else {
					$principal = number_format($amount_paid - $surcharge,2);
					$excess = -1;
				}
			} elseif ($under_pay == 1) {
				if ($amount_paid < $tot_amount_due){
					if ($amount_paid <= $surcharge) {
						$principal = 0;
					} else {
						$principal = number_format($amount_paid - $surcharge, 2);
						$l_surcharge = 0;
						$l_ampd = 0;
						// get last total principal
						//for ($x = 0; $x <= $payment_count; $x++) {
						for ($x = 0; $x < $payment_count - 1; $x++) {
							try {
								if ($due_date == $payment_rec[$x]['due_date']) {
									$l_surcharge += $payment_rec[$x]['surcharge'];
									$l_ampd += $payment_rec[$x]['payment_amount'];
								}
							} catch(Exception $e) {
							// pass
							}
						}
					}
					if ($l_ampd < $l_surcharge):
						$l_sur_credit = $l_surcharge - $l_ampd;
					else:
						$l_sur_credit = 0;
					endif;
						
					if ($last_payment['payment_amount'] < $last_payment['surcharge']):
						$principal = $amount_paid - $surcharge - $l_sur_credit;
						$principal = number_format($principal, 2);
						if ($principal < 0):
							$principal = 0;
						endif;	
					else:
						if ($l_ampd < $l_surcharge):
							$principal = $amount_paid - $surcharge - $l_sur_credit;
							$principal = number_format($principal,2);
						else:
							$principal = $amount_paid - $surcharge;
							$principal = number_format($principal,2);
							
						endif;

					endif;

				}else if($amount_paid > $tot_amount_due){
					$excess = $amount_paid - $tot_amount_due;
					$amount_paid = $tot_amount_due;
					$or_no_ent = $or_no_ent;
					$principal = $monthly_pay;
				}else{
					$principal = $monthly_pay;
				}
			}
		$principal = floatval(str_replace(',', '',$principal));
		$balance = floatval(str_replace(',', '',$balance)) - $principal;
		
			
		}elseif ($payment_type1 == 'Spot Cash'){
			$rebate = 0;
			$surcharge = 0;
			$interest = 0;
			$principal = floatval(str_replace(',', '',$amount_paid));
			$balance = floatval(str_replace(',', '',$balance));
			$balance = $balance - $principal;
			if ($amount_paid == floatval($tot_amount_due)) {
					$status = 'FPD';
					$l_status = 'Fully Paid';
			} else {
					$status = 'SC';
			}
			$excess = -1;
			if (floatval($balance) <= $rem_prcnt) {
				$l_for_cts = 1;
			}
	
		}elseif ($payment_type1 == 'Full DownPayment' && $acc_status == 'Reservation'){
			$rebate = 0;
			$interest = 0;
			$principal = floatval(str_replace(',', '',$amount_paid));
			$balance = floatval(str_replace(',', '',$balance));
			if ($amount_paid == floatval($tot_amount_due)) {
				$principal = $amount_paid - floatval($surcharge);
				$l_status = 'Full DownPayment';
				$status = 'FD';
				$l_for_cts = 1;
				$excess = -1;
			} elseif ($amount_paid > floatval($tot_amount_due)) {
				$excess = $amount_paid - floatval($tot_amount_due);
				$amount_paid = $tot_amount_due;
				$or_no_ent = $or_no_ent;
				$principal =$amount_paid - floatval($surcharge);
				$l_status = 'Full DownPayment';
				$status = 'FD';
				$l_for_cts = 1;
			} elseif ($amount_paid < floatval($tot_amount_due)) {
				$principal = $amount_paid - floatval($surcharge);
				$l_status = 'Partial DownPayment';
				$status = 'PFD';
				$excess = -1;
			}	
			$balance =$balance - $principal;
			

		}elseif (($acc_status == 'Full DownPayment' && $payment_type2 == 'Deferred Cash Payment') || ($payment_type1 == 'No DownPayment' && $payment_type2 == 'Deferred Cash Payment') || $acc_status == 'Deferred Cash Payment') {
			$rebate = 0;
			$interest = 0;
			if ($under_pay == 0) {
				if ($amount_paid < $tot_amount_due) {
					if ($amount_paid <= $surcharge) {
						$principal = 0;
					} else {
						$principal = number_format($amount_paid - $surcharge,2);
					}
					$excess = -1;
				} elseif ($amount_paid > $tot_amount_due) {
					if ($status == 'FPD') {
						$excess = $amount_paid - $tot_amount_due;
						$or_no_ent = $or_no_ent;
						$principal = number_format($amount_paid - $surcharge,2);
					} else {
						$excess = $amount_paid - $tot_amount_due;
						$amount_paid = $tot_amount_due;
						$or_no_ent = $or_no_ent;
						$principal = number_format($amount_paid - $surcharge,2);
					}
				} else {
					$principal = number_format($amount_paid - $surcharge,2);
					$excess = -1;
				}
			}elseif ($under_pay == 1) {
				if ($amount_paid < $tot_amount_due) {
					if ($amount_paid <= $surcharge) {
						$principal = 0;
					} else {
						$l_surcharge = 0;
						$l_ampd = 0;
						//get last total principal
						for ($x = 0; $x < $payment_count - 1; $x++) {
						//for ($x = 0; $x <= $payment_count; $x++) {
							try {
								if ($due_date == $payment_rec[$x]['due_date']) { 
									$l_surcharge += $payment_rec[$x]['surcharge'];
									$l_ampd += $payment_rec[$x]['payment_amount'];
								}
							} catch (Exception $e) {
								//pass
							}
						}
						if ($l_ampd < $l_surcharge) {
							$l_sur_credit = $l_surcharge - $l_ampd;
						} else {
							$l_sur_credit = 0;
						}
						if ($last_payment['payment_amount'] < $last_payment['surcharge']) {
							$principal = number_format($amount_paid - $surcharge - $l_sur_credit, 2);
							if ($principal < 0) {
								$principal = 0;
							}
						} else {
							$principal = number_format($amount_paid - $surcharge, 2);
							if ($l_ampd < $l_surcharge) {
								$principal = number_format($amount_paid - $surcharge - $l_sur_credit, 2);
							} else {
								$principal = number_format($amount_paid - $surcharge, 2);
							}
						}
						$excess = -1;
					}
				}elseif ($amount_paid > $tot_amount_due) {
					if ($status == 'FPD') {
						$excess = $amount_paid - $tot_amount_due;
						$or_no_ent = $or_no_ent;
						$principal = number_format($amount_paid- $surcharge, 2);
					} else {
						$excess = $amount_paid - $tot_amount_due;
						$amount_paid = $tot_amount_due;
						$or_no_ent = $or_no_ent;
						$principal = number_format($monthly_pay, 2);
					}
				} else {
					$principal = number_format($monthly_pay, 2);
					$excess = -1;
				}
			}
			$balance = $balance - $principal;
		
			if ($balance <= $rem_prcnt) {
				if ($old_balance <= $rem_prcnt) {
					$l_for_cts = 0;
				} else {
					$l_for_cts = 1;
				}
			}

			if ($acc_status == 'Reservation' || $acc_status == 'Full DownPayment') {
				if (($status == 'FPD' && ($amount_paid >= $tot_amount_due) || $balance <= 0)) {
					$status = 'FPD';
					$l_status = 'Fully Paid';
				} else {
					$status = 'DFC - ' . strval($status_count);
					$l_status = 'Deferred Cash Payment';
				}
			} elseif ($acc_status == 'Deferred Cash Payment') {
				if (($status == 'FPD' && ($amount_paid >= $tot_amount_due) || $balance <= 0)) {
					$status = 'FPD';
					$l_status = 'Fully Paid';
				} else {
					$status = 'DFC - ' . strval($status_count);
				}
			}
		}elseif (($acc_status == 'Full DownPayment' && $payment_type2 == 'Monthly Amortization') || ($payment_type1 == 'No DownPayment' && $payment_type2 == 'Monthly Amortization') || $acc_status == 'Monthly Amortization'){
			$interest = 0;
			$balance = floatval(str_replace(',', '',$balance));
			if ($under_pay == 0){
				if ($amount_paid < $tot_amount_due) {
					$rebate = 0;
					$l_interest = ($balance * ($interest_rate/1200));
					if ($amount_paid <= $surcharge):
						$interest = 0;
						$principal = 0;
					elseif (($amount_paid - $surcharge) >= $l_interest):
						$interest = $l_interest;
						$principal = $amount_paid - $interest - $surcharge;
					else:
						$interest = ($amount_paid) - ($surcharge);
						$principal = 0;
					endif;
					$excess = -1;
				}elseif (($amount_paid) > ($tot_amount_due)){
					if($over_due_mode == 0 and $to_principal_rbt == 1):
						$excess = -1;
						$interest =  ((($balance) * ($interest_rate/1200)));
						$principal = (($amount_paid) - ($interest) - ($surcharge));
						$principal_new = ($monthly_pay - ($interest) - ($surcharge) - ($rebate));
						$l_excess_amount = ($amount_paid) - ($tot_amount_due);
						if (($principal_new) < 0): 
							$neg_prin = 1; 
							$principal = 0; 
							$amount_paid = $tot_amount_due;
						endif;
					
					else:
						if ($status == 'FPD'):
							$excess = $amount_paid;
							$or_no_ent = $or_no_ent;
							$interest = ($balance * ($interest_rate/1200));
							$principal = ($amount_paid - $interest - $rebate);
						else:
							$excess = ($amount_paid - $tot_amount_due);
							$amount_paid = $tot_amount_due;
							$or_no_ent = $or_no_ent;
							//echo $balance;
							// echo $interest_rate;
							$interest = ($balance * ($interest_rate/1200));
							$principal = ($monthly_pay - $interest - $rebate);
							if (($principal) < 0):
								$neg_prin = 1;
								$principal = 0;
							endif;
						endif;
					endif;
				}else {
						$interest = $balance * ($interest_rate/1200);
						if ($status == 'FPD'):
							$principal = $monthly_pay - $interest - $rebate;
						else:
							$principal = $monthly_pay - $interest - $rebate;
							if ($principal < 0):
								$neg_prin = 1;
								$principal = 0;
							endif;
						endif;
						$excess = 0;
					}
			}elseif ($under_pay == 1){
				if ($amount_paid < $tot_amount_due) {
					$excess = -1;
					$rebate = 0;
					$l_interest = $ma_balance * ($interest_rate/1200);
					$l_surcharge = 0;
					$l_ampd = 0;
					// get last total principal
					for ($x = 0; $x < $payment_count - 1; $x++) {
					//for ($x = 0; $x <= $payment_count; $x++) {
						try {
							if ($due_date == $payment_rec[$x]['due_date']) { 
								$l_surcharge += $payment_rec[$x]['surcharge'];
								$l_ampd += $payment_rec[$x]['payment_amount'];
							}
						} catch (Exception $e) {
							//pass
						}
					}
					if ($l_ampd < $l_surcharge):
						$l_sur_credit = $l_surcharge - $l_ampd;
					else:
						$l_sur_credit = 0;
					endif;
					if ($last_interest < $l_interest):
						if ($amount_paid <= $surcharge):
							$interest = 0;
							$principal = 0;
						else:
							$l_bal_interest = $l_interest - $last_interest;
							if ($last_payment['payment_amount'] < $last_payment['surcharge']):
								if (($tot_amount_due - $surcharge - $l_sur_credit) >= $l_bal_interest):
									$interest = $l_bal_interest;
									$principal = $amount_paid - $interest - $surcharge - $l_sur_credit;
									if ($principal <= 0):
										$principal = 0;
									endif;
								else:
									$interest = ($amount_paid - $surcharge - $l_sur_credit);
									$principal = 0;
									if ($interest < 0) {
										$interest = 0;
									}
								endif;
							else:
								if (($amount_paid - $surcharge) >= $l_bal_interest) {
									$l_rem = $amount_paid - $surcharge - $l_sur_credit;
									$interest = $l_bal_interest;
									if ($l_rem < $interest) {
										$interest = $l_rem;
									}
									$principal = $amount_paid - $interest - $surcharge;
									if ($l_ampd < $l_surcharge) {
										$principal = $amount_paid - $interest - $surcharge - $l_sur_credit;
									} else {
										$principal = $amount_paid - $interest - $surcharge;
									}
									if ($principal <= 0) {
										$principal = 0;
									}
									if ($interest < 0) {
										$interest = 0;
									}
								} else {
									$interest = $amount_paid - $surcharge;
									$principal = 0;
								}
							endif;
						endif;
					
					else:
						$interest = 0;
						if ($amount_paid <= $surcharge):
							$principal = 0;
						else:
							if ($l_ampd < $l_surcharge):
								$principal = $amount_paid - $surcharge - $l_sur_credit;
								if ($principal <= 0):
									$principal = 0;
								else:
									$principal = ($amount_paid - $surcharge);
								endif;
							endif;
						endif;
					endif;

				}elseif ($amount_paid > $tot_amount_due) {
					if (($over_due_mode == 0) && ($to_principal_rbt == 1)):
						$excess = -1;
						$l_interest = ($ma_balance * ($interest_rate/1200));
						if ($last_interest < $l_interest):
							$interest = $l_interest - $last_interest;
						else:
							$interest = 0;
						endif;
						$principal = $amount_paid - $interest - $surcharge;
					else:
						$excess = $amount_paid - $tot_amount_due;
						$amount_paid = $tot_amount_due;
						$or_no_ent = $or_no_ent;
						$l_interest = $ma_balance * ($interest_rate/1200);
						if ($last_interest < $l_interest):
							$interest = $l_interest - $last_interest;
							$principal = $monthly_pay - $interest;
							if ($status == 'FPD'):
								$principal = ($amount_paid - $interest - $rebate);
							endif;

						else:
							$interest = 0;
							$principal = $monthly_pay;
							if ($status == 'FPD'):
								$principal = ($amount_paid - $interest - $rebate);
							endif;
						
						endif;
					endif;
				}else{
					$l_interest = ($ma_balance * ($interest_rate/1200));
					if ($last_interest < $l_interest) {
						$interest = $l_interest - $last_interest;
					if ($rebate != 0) {
						$principal = $monthly_pay - $interest - atof($rebate);
					} else {
						$principal = $monthly_pay - $interest;
					}
					} else {
						$interest = 0;
						$principal = $monthly_pay;
					}
					$excess = 0;
				}
			}
			$balance = $balance - $principal - $rebate;
			if (($acc_status == 'Reservation') || ($acc_status == 'Full DownPayment')):
				if (($status == 'FPD') && ($amount_paid >= $tot_amount_due) || ($balance <= 0)):
					$status = 'FPD';
					$l_status = 'Fully Paid';
				else:
					$status = 'MA - ' .strval($status_count);
					$l_status = 'Monthly Amortization';
				endif;
			elseif($acc_status == 'Monthly Amortization'):
				if (($status == 'FPD') && ($amount_paid >= $tot_amount_due) || ($balance <= 0)):
					$status = 'FPD';
					$l_status = 'Fully Paid';
				else:
					$status = 'MA - ' .strval($status_count);
				endif;
			endif;
		}
		
					
		$data = " property_id = '$prop_id' ";
		$data .= ", payment_amount = '$amount_paid' ";
		$data .= ", pay_date = '$pay_date' ";
		$data .= ", due_date = '$due_date' ";
		$data .= ", or_no = '$or_no_ent' " ;
		$data .= ", amount_due = '$tot_amount_due' ";
		$data .= ", rebate = '$rebate' ";
		$data .= ", surcharge = '$surcharge' ";
		$data .= ", interest = '$interest' ";
		$data .= ", principal = '$principal' ";
		$data .= ", remaining_balance = '$balance' ";
		$data .= ", status = '$status' ";
		$data .= ", status_count = '$status_count' ";
		$data .= ", payment_count = '$payment_count' ";

		/* $resp['data'] = array(
			'property_id' => $prop_id,
			'payment_amount' => $amount_paid,
			'pay_date' => $pay_date,
			'due_date' => $due_date,
			'or_no' => $or_no_ent,
			'amount_due' => $tot_amount_due,
			'rebate' => $rebate,
			'surcharge' => $surcharge,
			'interest' => $interest,
			'principal' => $principal,
			'remaining_balance' => $balance,
			'status' => $status,
			'status_count' => $status_count,
			'payment_count' => $payment_count
		  ); */
		
		$save = $this->conn->query("INSERT INTO property_payments set ".$data);
		//$save = $this->conn->query("INSERT INTO t_invoice set ".$data);
			

		//$l_sql =  "UPDATE properties SET c_account_status = '".$l_status."' WHERE property_id =".$prop_id;

		if ($l_status == ''){
				$l_sql = $this->conn->query("UPDATE properties SET c_balance = ".$balance." WHERE property_id = ".$prop_id);
		}else{
				$l_sql =  $this->conn->query("UPDATE properties SET c_account_status = '".$l_status."' WHERE property_id =".$prop_id);
		}

		
		if($save && $l_sql){
			$resp['status'] = 'success';
			if(empty($id))
				$this->settings->set_flashdata('success',"New payments successfully saved.");
			else
				$this->settings->set_flashdata('success',"Payments successfully updated.");
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}

		return json_encode($resp);
	}
	
	function add_payment(){
		extract($_POST);

		//$payments = $this->conn->query("SELECT due_date,pay_date, payment_amount,amount_due,surcharge,interest,principal,remaining_balance,status,status_count,payment_count FROM property_payments WHERE property_id = ".$prop_id." ORDER by due_date, pay_date, payment_count, remaining_balance DESC");
        $payments = $this->conn->query("SELECT due_date,pay_date, payment_amount,amount_due,surcharge,interest,principal,remaining_balance,status,status_count,payment_count, 0 AS excess, NULL as account_status, or_no FROM property_payments WHERE  property_id = ".$prop_id."  UNION SELECT due_date,pay_date,payment_amount,amount_due,surcharge,interest,principal,remaining_balance,status,status_count,payment_count,excess,account_status,or_no FROM t_invoice WHERE  property_id = ".$prop_id."  ORDER by due_date, pay_date, payment_count, remaining_balance DESC");
		$l_last = $payments->num_rows - 1;
        $payments_data = array(); 
        if($payments->num_rows <= 0){
            echo ('No Payment Records for this Account!');
        } 
        while($row = $payments->fetch_assoc()) {
          $payments_data[] = $row; 

        }
		
		$rebate = $rebate_amt;
        $last_cnt = $l_last;
        $payment_rec = $payments_data;
        $last_payment = $payments_data[$l_last];

		$amount_paid = (float) str_replace(",", "", $amount_paid);
		$tot_amount_due = (float) str_replace(",", "", $tot_amount_due);
		$status_count = $status_count ;
		$payment_count = $payment_count + 1;

		$to_principal_rbt = 0;
		$l_status = '';
		//rem set to zero for cts
		$rem_prcnt = 0;
		//echo $status;

		if ((($payment_type1 == 'Partial DownPayment') && ($acc_status == 'Reservation') || ($acc_status == 'Partial DownPayment')) || ($payment_type1 == 'Full DownPayment') && ($acc_status == 'Full DownPayment') && ($acc_status == 'Partial DownPayment')){
			$rebate = 0;
			$interest = 0;
			if (($acc_status == 'Reservation') && ($status != 'FD')) {
				$status = 'PD - ' . strval($status_count);
				$l_status = 'Partial DownPayment';
			} elseif ($acc_status == 'Partial DownPayment') {
				if ($status == 'FD' && ($amount_paid >= $tot_amount_due)) {
					$status = 'FD';
					$l_status = 'Full DownPayment';
					$l_for_cts = 1;
				} elseif ($status == 'FD' && ($amount_paid) < $tot_amount_due) {
					$status = 'PD';
					$l_for_cts = 0;
				} else {
					$status = 'PD - ' . strval($status_count);
				}
			}

			if ($under_pay == 0) {
				if ($amount_paid <$tot_amount_due){
					if ($amount_paid <= $surcharge) {
						$principal = 0;
					} else {
						$principal = number_format($amount_paid - $surcharge,2);
					}
					$excess = -1;
				} elseif ($amount_paid > $tot_amount_due) {
					$excess = $amount_paid - $tot_amount_due;
					$amount_paid = $tot_amount_due;
					$or_no_ent = $or_no_ent;
					$principal = number_format($amount_paid - $surcharge,2);
				} else {
					$principal = number_format($amount_paid - $surcharge,2);
					$excess = -1;
				}
			} elseif ($under_pay == 1) {
				if ($amount_paid < $tot_amount_due){
					if ($amount_paid <= $surcharge) {
						$principal = 0;
					} else {
						$principal = number_format($amount_paid - $surcharge, 2);
						$l_surcharge = 0;
						$l_ampd = 0;
						// get last total principal
						for ($x = 0; $x < $payment_count - 1; $x++) {
						//for ($x = 0; $x <= $payment_count - 1; $x++) {
							try {
								if ($due_date == $payment_rec[$x]['due_date']) {
									$l_surcharge += $payment_rec[$x]['surcharge'];
									$l_ampd += $payment_rec[$x]['payment_amount'];
								}
							} catch(Exception $e) {
							// pass
							}
						}
					}
					if ($l_ampd < $l_surcharge):
						$l_sur_credit = $l_surcharge - $l_ampd;
					else:
						$l_sur_credit = 0;
					endif;
						
					if ($last_payment['payment_amount'] < $last_payment['surcharge']):
						$principal = $amount_paid - $surcharge - $l_sur_credit;
						$principal = number_format($principal, 2);
						if ($principal < 0):
							$principal = 0;
						endif;	
					else:
						if ($l_ampd < $l_surcharge):
							$principal = $amount_paid - $surcharge - $l_sur_credit;
							$principal = number_format($principal,2);
						else:
							$principal = $amount_paid - $surcharge;
							$principal = number_format($principal,2);
							
						endif;

					endif;

				}else if($amount_paid > $tot_amount_due){
					$excess = $amount_paid - $tot_amount_due;
					$amount_paid = $tot_amount_due;
					$or_no_ent = $or_no_ent;
					$principal = $monthly_pay;
				}else{
					$principal = $monthly_pay;
				}
			}
		$principal = floatval(str_replace(',', '',$principal));
		$balance = floatval(str_replace(',', '',$balance)) - $principal;
		
			
		}elseif ($payment_type1 == 'Spot Cash'){
			$rebate = 0;
			$surcharge = 0;
			$interest = 0;
			$principal = floatval(str_replace(',', '',$amount_paid));
			$balance = floatval(str_replace(',', '',$balance));
			$balance = $balance - $principal;
			if ($amount_paid == floatval($tot_amount_due)) {
					$status = 'FPD';
					$l_status = 'Fully Paid';
			} else {
					$status = 'SC';
			}
			$excess = -1;
			if (floatval($balance) <= $rem_prcnt) {
				$l_for_cts = 1;
			}
	
		}elseif ($payment_type1 == 'Full DownPayment' && $acc_status == 'Reservation'){
			$rebate = 0;
			$interest = 0;
			$principal = floatval(str_replace(',', '',$amount_paid));
			$balance = floatval(str_replace(',', '',$balance));
			if ($amount_paid == floatval($tot_amount_due)) {
				$principal = $amount_paid - floatval($surcharge);
				$l_status = 'Full DownPayment';
				$status = 'FD';
				$l_for_cts = 1;
				$excess = -1;
			} elseif ($amount_paid > floatval($tot_amount_due)) {
				$excess = $amount_paid - floatval($tot_amount_due);
				$amount_paid = $tot_amount_due;
				$or_no_ent = $or_no_ent;
				$principal =$amount_paid - floatval($surcharge);
				$l_status = 'Full DownPayment';
				$status = 'FD';
				$l_for_cts = 1;
			} elseif ($amount_paid < floatval($tot_amount_due)) {
				$principal = $amount_paid - floatval($surcharge);
				$l_status = 'Partial DownPayment';
				$status = 'PFD';
				$excess = -1;
			}	
			$balance =$balance - $principal;
			

		}elseif (($acc_status == 'Full DownPayment' && $payment_type2 == 'Deferred Cash Payment') || ($payment_type1 == 'No DownPayment' && $payment_type2 == 'Deferred Cash Payment') || $acc_status == 'Deferred Cash Payment') {
			$rebate = 0;
			$interest = 0;
			if ($under_pay == 0) {
				if ($amount_paid < $tot_amount_due) {
					if ($amount_paid <= $surcharge) {
						$principal = 0;
					} else {
						$principal = number_format($amount_paid - $surcharge,2);
					}
					$excess = -1;
				} elseif ($amount_paid > $tot_amount_due) {
					if ($status == 'FPD') {
						$excess = $amount_paid - $tot_amount_due;
						$or_no_ent = $or_no_ent;
						$principal = number_format($amount_paid - $surcharge,2);
					} else {
						$excess = $amount_paid - $tot_amount_due;
						$amount_paid = $tot_amount_due;
						$or_no_ent = $or_no_ent;
						$principal = number_format($amount_paid - $surcharge,2);
					}
				} else {
					$principal = number_format($amount_paid - $surcharge,2);
					$excess = -1;
				}
			}elseif ($under_pay == 1) {
				if ($amount_paid < $tot_amount_due) {
					if ($amount_paid <= $surcharge) {
						$principal = 0;
					} else {
						$l_surcharge = 0;
						$l_ampd = 0;
						//get last total principal
						for ($x = 0; $x < $payment_count - 1; $x++) {
						//for ($x = 0; $x <= $payment_count - 1; $x++) {
							try {
								if ($due_date == $payment_rec[$x]['due_date']) { 
									$l_surcharge += $payment_rec[$x]['surcharge'];
									$l_ampd += $payment_rec[$x]['payment_amount'];
								}
							} catch (Exception $e) {
								//pass
							}
						}
						if ($l_ampd < $l_surcharge) {
							$l_sur_credit = $l_surcharge - $l_ampd;
						} else {
							$l_sur_credit = 0;
						}
						if ($last_payment['payment_amount'] < $last_payment['surcharge']) {
							$principal = number_format($amount_paid - $surcharge - $l_sur_credit, 2);
							if ($principal < 0) {
								$principal = 0;
							}
						} else {
							$principal = number_format($amount_paid - $surcharge, 2);
							if ($l_ampd < $l_surcharge) {
								$principal = number_format($amount_paid - $surcharge - $l_sur_credit, 2);
							} else {
								$principal = number_format($amount_paid - $surcharge, 2);
							}
						}
						$excess = -1;
					}
				}elseif ($amount_paid > $tot_amount_due) {
					if ($status == 'FPD') {
						$excess = $amount_paid - $tot_amount_due;
						$or_no_ent = $or_no_ent;
						$principal = number_format($amount_paid- $surcharge, 2);
					} else {
						$excess = $amount_paid - $tot_amount_due;
						$amount_paid = $tot_amount_due;
						$or_no_ent = $or_no_ent;
						$principal = number_format($monthly_pay, 2);
					}
				} else {
					$principal = number_format($monthly_pay, 2);
					$excess = -1;
				}
			}
			$balance = $balance - $principal;
		
			if ($balance <= $rem_prcnt) {
				if ($old_balance <= $rem_prcnt) {
					$l_for_cts = 0;
				} else {
					$l_for_cts = 1;
				}
			}

			if ($acc_status == 'Reservation' || $acc_status == 'Full DownPayment') {
				if (($status == 'FPD' && ($amount_paid >= $tot_amount_due) || $balance <= 0)) {
					$status = 'FPD';
					$l_status = 'Fully Paid';
				} else {
					$status = 'DFC - ' . strval($status_count);
					$l_status = 'Deferred Cash Payment';
				}
			} elseif ($acc_status == 'Deferred Cash Payment') {
				if (($status == 'FPD' && ($amount_paid >= $tot_amount_due) || $balance <= 0)) {
					$status = 'FPD';
					$l_status = 'Fully Paid';
				} else {
					$status = 'DFC - ' . strval($status_count);
				}
			}
		}elseif (($acc_status == 'Full DownPayment' && $payment_type2 == 'Monthly Amortization') || ($payment_type1 == 'No DownPayment' && $payment_type2 == 'Monthly Amortization') || $acc_status == 'Monthly Amortization'){
			$interest = 0;
			$balance = floatval(str_replace(',', '',$balance));
			if ($under_pay == 0){
				if ($amount_paid < $tot_amount_due) {
					$rebate = 0;
					$l_interest = ($balance * ($interest_rate/1200));
					if ($amount_paid <= $surcharge):
						$interest = 0;
						$principal = 0;
					elseif (($amount_paid - $surcharge) >= $l_interest):
						$interest = $l_interest;
						$principal = $amount_paid - $interest - $surcharge;
					else:
						$interest = ($amount_paid) - ($surcharge);
						$principal = 0;
					endif;
					$excess = -1;
				}elseif (($amount_paid) > ($tot_amount_due)){
					if($over_due_mode == 0 and $to_principal_rbt == 1):
					//if($over_due == 0):
						$excess = -1;
						$interest =  ((($balance) * ($interest_rate/1200)));
						$principal = (($amount_paid) - ($interest) - ($surcharge));
						$principal_new = ($monthly_pay - ($interest) - ($surcharge) - ($rebate));
						$l_excess_amount = ($amount_paid) - ($tot_amount_due);
						if (($principal_new) < 0): 
							$neg_prin = 1; 
							$principal = 0; 
							$amount_paid = $tot_amount_due;
						endif;
					
					else:
						if ($status == 'FPD'):
							$excess = $amount_paid;
							$or_no_ent = $or_no_ent;
							$interest = ($balance * ($interest_rate/1200));
							$principal = ($amount_paid - $interest - $rebate);
						else:
							$excess = ($amount_paid - $tot_amount_due);
							$amount_paid = $tot_amount_due;
							$or_no_ent = $or_no_ent;
							//echo $balance;
							// echo $interest_rate;
							$interest = ($balance * ($interest_rate/1200));
							$principal = ($monthly_pay - $interest - $rebate);
							if (($principal) < 0):
								$neg_prin = 1;
								$principal = 0;
							endif;
						endif;
					endif;
				}else {
						$interest = $balance * ($interest_rate/1200);
						if ($status == 'FPD'):
							$principal = $monthly_pay - $interest - $rebate;
						else:
							$principal = $monthly_pay - $interest - $rebate;
							if ($principal < 0):
								$neg_prin = 1;
								$principal = 0;
							endif;
						endif;
						$excess = 0;
					}
			}elseif ($under_pay == 1){
				if ($amount_paid < $tot_amount_due) {
					$excess = -1;
					$rebate = 0;
					$l_interest = $ma_balance * ($interest_rate/1200);
					$l_surcharge = 0;
					$l_ampd = 0;
					// get last total principal
					//echo $payment_count;
					//echo $payment_count;
					for ($x = 0; $x < $payment_count -1; $x++) {
						try {
							//echo $payment_rec[$x]['payment_amount'];
							if ($due_date == $payment_rec[$x]['due_date']) { 
								$l_surcharge += $payment_rec[$x]['surcharge'];
								$l_ampd += $payment_rec[$x]['payment_amount'];
							}
						} catch (Exception $e) {
							//pass
						}
					}

					
					if ($l_ampd < $l_surcharge):
						$l_sur_credit = $l_surcharge - $l_ampd;
					else:
						$l_sur_credit = 0;
					endif;
					if ($last_interest < $l_interest):
						
						if ($amount_paid <= $surcharge):
							$interest = 0;
							$principal = 0;
						else:
							
							$l_bal_interest = $l_interest - $last_interest;
							if ($last_payment['payment_amount'] < $last_payment['surcharge']):
								if (($tot_amount_due - $surcharge - $l_sur_credit) >= $l_bal_interest):
									$interest = $l_bal_interest;
									$principal = $amount_paid - $interest - $surcharge - $l_sur_credit;
									if ($principal <= 0):
										$principal = 0;
									endif;
								else:
									$interest = ($amount_paid - $surcharge - $l_sur_credit);
									$principal = 0;
									if ($interest < 0) {
										$interest = 0;
									}
								endif;
							else:
								if (($amount_paid - $surcharge) >= $l_bal_interest) {
									$l_rem = $amount_paid - $surcharge - $l_sur_credit;
									$interest = $l_bal_interest;
									if ($l_rem < $interest) {
										$interest = $l_rem;
									}
									$principal = $amount_paid - $interest - $surcharge;
									if ($l_ampd < $l_surcharge) {
										$principal = $amount_paid - $interest - $surcharge - $l_sur_credit;
									} else {
										$principal = $amount_paid - $interest - $surcharge;
									}
									if ($principal <= 0) {
										$principal = 0;
									}
									if ($interest < 0) {
										$interest = 0;
									}
								} else {
									$interest = $amount_paid - $surcharge;
									$principal = 0;
								}
							endif;
						endif;
					
					else:
						
						$interest = 0;
						if ($amount_paid <= $surcharge):
							$principal = 0;
						else:
							if ($l_ampd < $l_surcharge):
								$principal = $amount_paid - $surcharge - $l_sur_credit;
								if ($principal <= 0):
									$principal = 0;
								endif;
							else:
								$principal = ($amount_paid - $surcharge);
								
							endif;
						endif;
					endif;

				}elseif ($amount_paid > $tot_amount_due) {
					if (($over_due_mode == 0) && ($to_principal_rbt == 1)):
						$excess = -1;
						$l_interest = ($ma_balance * ($interest_rate/1200));
						if ($last_interest < $l_interest):
							$interest = $l_interest - $last_interest;
						else:
							$interest = 0;
						endif;
						$principal = $amount_paid - $interest - $surcharge;
					else:
						$excess = $amount_paid - $tot_amount_due;
						$amount_paid = $tot_amount_due;
						$or_no_ent = $or_no_ent;
						$l_interest = $ma_balance * ($interest_rate/1200);
						if ($last_interest < $l_interest):
							$interest = $l_interest - $last_interest;
							$principal = $monthly_pay - $interest;
							if ($status == 'FPD'):
								$principal = ($amount_paid - $interest - $rebate);
							endif;

						else:
							$interest = 0;
							$principal = $monthly_pay;
							if ($status == 'FPD'):
								$principal = ($amount_paid - $interest - $rebate);
							endif;
						
						endif;
					endif;
				}else{
					
					$l_interest = ($ma_balance * ($interest_rate/1200));
					if ($last_interest < $l_interest) {
						$interest = $l_interest - $last_interest;
						if ($rebate != 0) {
							$principal = $monthly_pay - $interest - atof($rebate);
						} else {
							$principal = $monthly_pay - $interest;
						}
					} else {
						$interest = 0;
						$principal = $monthly_pay;
					}
					$excess = 0;
				}
			}
			
			$balance = $balance - $principal - $rebate;
			if (($acc_status == 'Reservation') || ($acc_status == 'Full DownPayment')):
				if (($status == 'FPD') && ($amount_paid >= $tot_amount_due) || ($balance <= 0)):
					$status = 'FPD';
					$l_status = 'Fully Paid';
				else:
					$status = 'MA - ' .strval($status_count);
					$l_status = 'Monthly Amortization';
				endif;
			elseif($acc_status == 'Monthly Amortization'):
				if (($status == 'FPD') && ($amount_paid >= $tot_amount_due) || ($balance <= 0)):
					$status = 'FPD';
					$l_status = 'Fully Paid';
				else:
					$status = 'MA - ' .strval($status_count);
					$l_status = 'Monthly Amortization';
				endif;
			endif;
		}
		
	 

		$data = " property_id = '$prop_id' ";
		$data .= ", payment_amount = '$amount_paid' ";
		$data .= ", pay_date = '$pay_date' ";
		$data .= ", due_date = '$due_date' ";
		$data .= ", or_no = '$or_no_ent' " ;
		$data .= ", amount_due = '$tot_amount_due' ";
		$data .= ", rebate = '$rebate' ";
		$data .= ", surcharge = '$surcharge' ";
		$data .= ", interest = '$interest' ";
		$data .= ", principal = '$principal' ";
		$data .= ", remaining_balance = '$balance' ";
		$data .= ", status = '$status' ";
		$data .= ", status_count = '$status_count' ";
		$data .= ", payment_count = '$payment_count' ";
		$data .= ", excess = '$excess' ";
		$data .= ", account_status = '$l_status' ";


		
		$save = $this->conn->query("INSERT INTO t_invoice set ".$data);

		$resp['data'] = array(
			'property_id' => $prop_id,
			'payment_amount' => $amount_paid,
			'pay_date' => $pay_date,
			'due_date' => $due_date,
			'or_no' => $or_no_ent,
			'amount_due' => $tot_amount_due,
			'rebate' => $rebate,
			'surcharge' => $surcharge,
			'interest' => $interest,
			'principal' => $principal,
			'remaining_balance' => $balance,
			'status' => $status,
			'status_count' => $status_count,
			'payment_count' => $payment_count,
			'excess' => $excess
		  );
		



		if($resp['data'] ){
			$resp['status'] = 'success';
		}else{
			$resp['status'] = 'failed';
			$resp['err'] = $this->conn->error."[{$sql}]";
		}
		return json_encode($resp);
	}
	
	function delete_invoice(){
		extract($_POST);

		$rowId = $_POST['rowId'];

		$del = $this->conn->query("DELETE FROM t_invoice where invoice_id = ".$rowId);
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Row successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);	
	}


	function credit_principal(){
		extract($_POST);

		$rowId = $_POST['rowId'];

		$del = $this->conn->query("DELETE FROM t_invoice where invoice_id = ".$rowId);
		if($del){
			$resp['status'] = 'success';
			$this->settings->set_flashdata('success',"Row successfully deleted.");
		}else{
			$resp['status'] = 'failed';
			$resp['error'] = $this->conn->error;
		}
		return json_encode($resp);	
	}


}



$Master = new Master();
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$sysset = new SystemSettings();
switch ($action) {
	case 'save_csr':
		echo $Master->save_csr();
	break;
	case 'delete_csr':
		echo $Master->delete_csr();
	break;
	case 'delete_agent':
		echo $Master->delete_agent();
	break;
	case 'save_client':
		echo $Master->save_client();
	break;
	case 'sm_verification':
		echo $Master->sm_verification();
	break;
	case 'coo_approval':
		echo $Master->coo_approval();
	break;
	case 'extend_coo_approval':
		echo $Master->extend_coo_approval();
	break;
	case 'cancel_approval':
		echo $Master->cancel_approval();
	break;
	case 'coo_disapproval':
		echo $Master->coo_disapproval();
	break;
	case 'save_lot':
		echo $Master->save_lot();
	break;
	case 'delete_lot':
		echo $Master->delete_lot();
	break;
	case 'save_house_model':
		echo $Master->save_house_model();
	break;
	case 'delete_model':
		echo $Master->delete_model();
	break;
	case 'delete_user':
		echo $Master->delete_user();
	break;
	case 'save_project':
		echo $Master->save_project();
	break;
	case 'save_agent':
		echo $Master->save_agent();
	break;
	case 'delete_project':
		echo $Master->delete_project();
	break;
	case 'save_reservation':
		echo $Master->save_reservation();
	break;
	case 'delete_reservation':
		echo $Master->delete_reservation();
	break;
	case 'upload_file':
		echo $Master->upload_file();
	break;
	case 'approved_upload':
		echo $Master->approved_upload();
	break;
	case 'delete_upload':
		echo $Master->delete_upload();
	break;
	case 'ca_approval':
		echo $Master->ca_approval();
	break;
	case 'save_ca':
		echo $Master->save_ca();
	break;
	case 'print_payment':
		echo $Master->print_payment();
	break;
	case 'cfo_booked':
		echo $Master->cfo_booked();
	break;
	case 'save_payment':
		echo $Master->save_payment();
	break;
	case 'add_payment':
		echo $Master->add_payment();
	break;

	case 'delete_invoice':
		echo $Master->delete_invoice();
	break;

	case 'credit_principal':
		echo $Master->credit_principal();
	break;
	
	default:
		break;
}