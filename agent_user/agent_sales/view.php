<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<style>
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
    .dropdown-menu{
        text-align: center;
    }
</style>
<?php 
    $usertype = $_settings->userdata('user_type');
    $type = $_settings->userdata('user_code');
/* $usertype = isset($_settings->userdata('type')== 1) ? "IT Admin" : "" ; */
if(($_GET['id']) && ($_GET['id'] > 0)){
    // $csr = $conn->query("SELECT * FROM t_csr where md5(c_csr_no) = '{$_GET['id']}' ");

    $csr = $conn->query("SELECT x.*, z.*,
    x.c_csr_no as csr_num FROM t_csr x 
    inner join t_additional_cost z on z.c_csr_no = x.c_csr_no where md5(x.c_csr_no) = '{$_GET['id']}'" );

if($csr->num_rows > 0){
    while ($row = mysqli_fetch_assoc($csr)):
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

        $getID = $row['c_csr_no'];
        $csr_no = $row['c_csr_no'];
        $refno = $row['ref_no'];
        $lot_id = $row['c_lot_lid'];   
        $coo_approval = $row['coo_approval'];// status
        $floor_elevation = $row['floor_elevation'];

        ///LOT
        $lot_area = $row['c_lot_area'];
        $price_sqm = $row['c_price_sqm'];
        $lot_disc = $row['c_lot_discount'];
        $lot_disc_amt = $row['c_lot_discount_amt'];
        $lres = $lot_area * $price_sqm;
        $lcp = $lres-($lres*($lot_disc*0.01));

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
        $verify = $row['c_verify'];

        $notes = $row['c_remarks'];
    endwhile;
    }
}

?>
<body onload="loadAll()">
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
	<i><h3 class="card-title"><b>Reference #<?php echo $refno; ?></b></h3></i>
	</div>
	<div class="card-body">
		<div class="container-fluid">
                <input type="hidden" value="<?php echo $p1; ?>" id="p1">
                <input type="hidden" value="<?php echo $p2; ?>" id="p2">
                    <table style="width:100%;">
                        <tr>
                        <div class="row">
                                <?php if($verify == 0){?>
                                <td style="width:50%;">
                                    <a href="?page=agent_sales/create&id=<?php echo md5($getID); ?>" class="btn btn-flat btn-primary" style="font-size:14px;width:100%;margin-top:5px;"><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;Edit</a>
                                </td>
                                <?php } ?>
                                <td>
                                <button type="button" class="btn btn-flat btn-secondary dropdown-toggle dropdown-icon" data-toggle="dropdown" style="margin-top:5px; font-size:14px;width:100%;">
                                    <i class="fa fa-print" aria-hidden="true"></i>&nbsp;&nbsp;Print
                                    <span class="sr-only">Toggle Dropdown</span>
                                </button>
                                <div class="dropdown-menu" role="menu">   
                                    <a class="dropdown-item" style="font-size:14px;" href="/ALSC/report/print_ra.php?id=<?php echo $getID; ?>">Print Front Page</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" style="font-size:14px;" href="/ALSC/report/print_ra_back.php?id=<?php echo $getID; ?>">Print Back Page</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" style="font-size:14px;" href="/ALSC/report/print_agreement.php?id=<?php echo $getID; ?>">Print Agreement Page</a>
                                </div>
                                </td>           
                        </div>
                        </tr>
                    </table>
                    <div class="titles"> Buyer's Profile</div>
                        <br>
                        <?php $query2 = "SELECT * FROM t_csr_buyers WHERE md5(c_csr_no) = '{$_GET['id']}'" ;
                        $result2 = mysqli_query($conn, $query2);
                        if($result2) {
                            while ($row = mysqli_fetch_assoc($result2)) { 
                                $buyer_count = $row['c_buyer_count']; // customer buyers no
                                $customer_last_name_1 = $row['last_name']; // customer last name
                                $customer_suffix_name_1 = $row['suffix_name']; // customer suffix name
                                $customer_first_name_1 = $row['first_name']; // customer first name
                                $customer_middle_name_1 = $row['middle_name']; // customer middle name
                                $cust_fullname1 = sprintf('%s %s, %s %s', $customer_last_name_1, $customer_suffix_name_1, $customer_first_name_1, $customer_middle_name_1); 
                                $customer_address_1 = $row['address']; // customer address
                                $customer_zip_code = $row['zip_code']; // customer zip_code
                                $customer_address_2 = $row['address_abroad']; // customer address abroad
                        
                                $birth_date = $row['birthdate']; // customer birthday
                                $customer_age = $row['age']; // customer age
                        
                                $customer_phone = $row['contact_no']; // customer phone number
                                $customer_email = $row['email']; // customer civil status
                                $customer_viber= $row['viber']; // customer viber
                                $customer_gender = $row['gender']; // customer phone number
                                $civil_status = $row['civil_status']; // customer civil status

                        ?>
                        <div class="view_box">
                            <div class="float-left col-md-12">
                                <table class="table table-striped">
                                    <tr>
                                        <td style="width:40%;"><b>Buyer No: </b></td>
                                        <td><?php echo $buyer_count ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Buyer's Full Name:</b></td>
                                        <td><?php echo $cust_fullname1 ?></td>
                                    </tr>
                                
                                    <tr>
                                        <td><b>Address 1:</b></td>
                                        <td><?php echo $customer_address_1 ?></td>
                                    </tr>
                                
                                    <tr>
                                        <td><b>Zipcode : </b></td>
                                        <td><?php echo $customer_zip_code?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Address 2 (Abroad):</b></td>
                                        <td><?php echo $customer_address_2 ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Birthdate:</b></td>
                                        <td><?php echo $birth_date ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Age:</b></td>
                                        <td><?php echo $customer_age ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Contact Number:</b></td>
                                        <td><?php echo $customer_phone ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Email Address:</b></td>
                                        <td><?php echo $customer_email ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Viber Account:</b></td>
                                        <td><?php echo $customer_viber ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Gender:</b></td>
                                        <td><?php echo $customer_gender ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Civil Status:</b></td>
                                        <td><?php echo $civil_status ?></td>
                                    </tr>
                                </table> 
                            </div>       
                        </div>
                        <br>
                        <div class="space"></div>
                        <?php 
                            }} 
                            ?>
                        <div class="space"></div>
                        <div class="space"></div>
                        <div class="titles">Investment Value</div>
                        <div class="space"></div>
                            <div class="view_lot">
                            <div class="titles">Lot</div>
                                <div class="float-left col-md-12">
                                    <table class="table table-striped">
                                        <tr>
                                            <td style="width:40%;"><b>Lot ID:</b></td>
                                            <td><?php echo $lot_id ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Lot Area:</b></td>
                                            <td><?php echo $lot_area ?> SQM</td>
                                        </tr>
                                        <tr>
                                            <td><b>Price/SQM:</b></td>
                                            <td><?php echo number_format($price_sqm,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Discount (%):</b></td>
                                            <td><?php echo $lot_disc ?> %</td>
                                        </tr>
                                        <tr>
                                            <td><b>Discount Amount:</b></td>
                                            <td><?php echo number_format($lot_disc_amt,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Lot Contract Price:</b></td>
                                            <td><?php echo number_format($lcp,2) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="view_house">
                            <div class="titles">House</div>
                                <div class="float-left col-md-12">
                                    <table class="table table-striped">
                                        <tr>
                                            <td style="width:40%;"><b>House Model:</b></td>
                                            <td><?php echo $house_model ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Floor Area:</b></td>
                                            <td><?php echo $floor_area ?> SQM</td>
                                        </tr>
                                        <tr>
                                            <td><b>House Price/SQM:</b></td>
                                            <td><?php echo number_format($house_price_sqm,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Discount (%):</b></td>
                                            <td><?php echo $house_disc ?>  %</td>
                                        </tr>
                                        <tr>
                                            <td><b>Discount Amount:</b></td>
                                            <td><?php echo number_format($house_disc_amt,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>House Contract Price:</b></td>
                                            <td><?php echo number_format($hcp,2) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="space"></div>
                                    <div class="space"></div>
                                    <div class="titles">Add Cost</div>
                                        <div class="view_box" style="padding:10px;">
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
                                            <?php if($floor_elevation == 1){ ?>
                                                <input id="id20" type="radio" name="chkOption4" checked="checked" disabled/>0.20 meter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input id="id40" type="radio" name="chkOption4" disabled/>0.40 meter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input id="id60" type="radio" name="chkOption4" disabled/>0.60 meter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php }elseif($floor_elevation == 2){ ?>
                                                <input id="id20" type="radio" name="chkOption4" disabled/>0.20 meter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input id="id40" type="radio" name="chkOption4" checked="checked" disabled/>0.40 meter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input id="id60" type="radio" name="chkOption4" disabled>0.60 meter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php }elseif($floor_elevation == 3){ ?>
                                                <input id="id20" type="radio" name="chkOption4" disabled/>0.20 meter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input id="id40" type="radio" name="chkOption4" disabled/>0.40 meter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input id="id60" type="radio" name="chkOption4" checked="checked" disabled/>0.60 meter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php }else{?>
                                                <input id="id20" type="radio" name="chkOption4" disabled/>0.20 meter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input id="id40" type="radio" name="chkOption4" disabled/>0.40 meter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input id="id60" type="radio" name="chkOption4" disabled/>0.60 meter&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <?php }
                                            ?>
                                        </div>
                                            <input type="hidden" name="flrelev_text" id="flrelev_text" onchange="getFlrElev(this);"/>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control margin-bottom" id="flrelev_price" name="flrelev_price" value="<?php echo number_format($floor_elev_price,2) ?>" readonly>
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
                                            <label class="control-label"><input type="text" class="form-control margin-bottom" id="aircon_outlets" name="aircon_outlets" value="<?php echo ($aircon_outlets) ?>" onchange = "getAcSubtotal();" readonly></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label class="control-label">Unit/s</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control margin-bottom" id="aircon_outlet_price" name="aircon_outlet_price" value="<?php echo ($aircon_outlet_price) ?>" onchange = "getAcSubtotal();" readonly>
                                            <input type="text" class="form-control margin-bottom" id="aircon_outlet_price_disp" name="aircon_outlet_price_disp" value="<?php echo number_format($aircon_outlet_price,2) ?>" onchange = "getAcSubtotal();" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group"> 
                                            <input type="hidden" class="form-control margin-bottom" id="ac_outlet_subtotal" name="ac_outlet_subtotal" readonly>
                                            <input type="text" class="form-control margin-bottom" id="ac_outlet_subtotal_disp" name="ac_outlet_subtotal_disp" readonly>
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
                                            <label class="control-label"><input type="text" class="form-control margin-bottom" id="ac_grill" name="ac_grill" value="<?php echo ($aircon_grill) ?>" onchange="getAcGrillSubtotal();" readonly></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label class="control-label">Unit/s</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control margin-bottom" id="ac_grill_price" name="ac_grill_price" value="<?php echo ($aircon_grill_price) ?>" onchange="getAcGrillSubtotal();" readonly>
                                            <input type="text" class="form-control margin-bottom" id="ac_grill_price_disp" name="ac_grill_price_disp" value="<?php echo number_format($aircon_grill_price,2) ?>" onchange="getAcGrillSubtotal();" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control margin-bottom" id="ac_grill_subtotal" name="ac_grill_subtotal" readonly>
                                            <input type="text" class="form-control margin-bottom" id="ac_grill_subtotal_disp" name="ac_grill_subtotal_disp" readonly>
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
                                            <label class="control-label"><input type="text" class="form-control margin-bottom" id="conv_outlet" name="conv_outlet" value="<?php echo ($conv_outlet) ?>" onchange="getConvSubtotal();" readonly></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label class="control-label">Unit/s</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control margin-bottom" id="conv_outlet_price" name="conv_outlet_price" value="<?php echo ($conv_outlet_price) ?>" onchange="getConvSubtotal();" readonly>
                                            <input type="text" class="form-control margin-bottom" id="conv_outlet_price_disp" name="conv_outlet_price_disp" value="<?php echo number_format($conv_outlet_price,2) ?>" onchange="getConvSubtotal();" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control margin-bottom" id="conv_outlet_subtotal" name="conv_outlet_subtotal" readonly>
                                            <input type="text" class="form-control margin-bottom" id="conv_outlet_subtotal_disp" name="conv_outlet_subtotal_disp" readonly>
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
                                            <label class="control-label"><input type="text" class="form-control margin-bottom" id="service_area" name="service_area" value="<?php echo ($service_area) ?>" onchange="getServiceSubtotal();" readonly></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label class="control-label">Unit/s</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control margin-bottom" id="service_area_price" name="service_area_price" value="<?php echo ($service_area_price) ?>" onchange="getServiceSubtotal();" readonly>
                                            <input type="text" class="form-control margin-bottom" id="service_area_price_disp" name="service_area_price_disp" value="<?php echo number_format($service_area_price,2) ?>" onchange="getServiceSubtotal();" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control margin-bottom" id="service_subtotal" name="service_subtotal" readonly>
                                            <input type="text" class="form-control margin-bottom" id="service_subtotal_disp" name="service_subtotal_disp" readonly>
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
                                            <label class="control-label"><input type="text" class="form-control margin-bottom" id="others" name="others" value="<?php echo ($others) ?>" onchange="getOthersSubtotal()" readonly></label>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group" style="margin-top:5px;">
                                            <label class="control-label">Unit/s</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control margin-bottom" id="others_price" name="others_price" value="<?php echo ($others_price) ?>" onchange="getOthersSubtotal()" readonly>
                                            <input type="text" class="form-control margin-bottom" id="others_price_disp" name="others_price_disp" value="<?php echo number_format($others_price,2) ?>" onchange="getOthersSubtotal()" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="hidden" class="form-control margin-bottom" id="others_subtotal" name="others_subtotal" onkeyup="getAddCost()" readonly>
                                            <input type="text" class="form-control margin-bottom" id="others_subtotal_disp" name="others_subtotal_disp" onkeyup="getAddCost()" readonly>
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
                                            <input type="text" class="form-control margin-bottom" id="add_cost_total" name="add_cost_total" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <div class="space"></div>
                            <div class="space"></div>
                            <div class="titles">Payment Computation</div>
                            <div class="view_box">
                                <div class="float-left col-md-12">
                                    <table class="table table-striped">
                                        <tr>
                                            <td style="width:40%;"><b>TCP Discount: </b></td>
                                            <td><?php echo $tcp_discount ?>  %</td>
                                        </tr>
                                        <tr>
                                            <td><b>TCP Discount Amount: </b></td>
                                            <td><?php echo number_format($tcp_discount_amt,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Total Contract Price: </b></td>
                                            <td><?php echo number_format($tcp,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>VAT: </b></td>
                                            <td><?php echo number_format($vat,2) ?></td>
                                        </tr>
                                        <!---<tr>
                                            <td><b>VAT Amount: </b></td>
                                            <td><?php echo number_format($vat_amt,2) ?></td>
                                        </tr>!-->
                                        <tr>
                                            <td><b>Net TCP: </b></td>
                                            <td><?php echo number_format($net_tcp,2) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="space"></div>
                            <div class="space"></div>
                            <div class="view_box">
                                <div class="float-left col-md-12">
                                    <table class="table table-striped">
                                        <tr>
                                            <td style="width:40%;"><b>Reservation: </b></td>
                                            <td><?php echo number_format($reservation,2) ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="space"></div>
                            <div id="space1" class="space"></div>
                            <div id="pd" class="pd">
                                <div class="titles">Partial DownPayment</div>
                                <div class="float-left col-md-12">
                                    <table class="table table-striped">
                                        <tr>
                                            <td style="width:40%;"><b>Down %:</b></td>
                                            <td><?php echo $down_percent ?>  %</td>
                                        </tr>
                                        <tr>
                                            <td><b>Net DP:</b></td>
                                            <td><?php echo number_format($net_dp,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b># of Payments:</b></td>
                                            <td><?php echo $no_payments ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Monthly Down:</b></td>
                                            <td><?php echo number_format($monthly_down,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>First DP:</b></td>
                                            <td><?php echo $first_dp ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Full Down:</b></td>
                                            <td><?php echo $full_down ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div id="fdp" class="fdp" >
                                <div class="titles">Full Down Payment</div>
                                <div class="float-left col-md-12">
                                    <table class="table table-striped">
                                        <tr>
                                            <td style="width:40%;"><b>Down %:</b></td>
                                            <td><?php echo $down_percent ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Net DP:</b></td>
                                            <td><?php echo number_format($net_dp,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Full Down:</b></td>
                                            <td><?php echo $full_down ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div id="space1" class="space"></div>
                            <div id="ma" class="ma">
                                <div class="titles">Monthly Amortization</div>
                                <div class="float-left col-md-12">
                                    <table class="table table-striped">
                                        <tr>
                                            <td style="width:40%;"><b>Amount to be Financed:</b></td>
                                            <td><?php echo number_format($amt_fnanced,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Terms:</b></td>
                                            <td><?php echo $terms ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Interest Rate:</b></td>
                                            <td><?php echo $interest_rate ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Fixed Factor:</b></td>
                                            <td><?php echo $fixed_factor ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Monthly Payment:</b></td>
                                            <td><?php echo number_format($monthly_payment,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Start Date:</b></td>
                                            <td><?php echo $start_date ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div id="space1" class="space"></div>
                            <div id="dfc" class="dfc">
                                <div class="titles">Deferred Cash Payment</div>
                                <div class="float-left col-md-12">
                                    <table class="table table-striped">
                                        <tr>
                                            <td style="width:40%;"><b>Deferred Amount:</b></td>
                                            <td><?php echo number_format($amt_fnanced,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Terms:</b></td>
                                            <td><?php echo $terms ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Monthly Payment:</b></td>
                                            <td><?php echo number_format($monthly_payment,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Start Date:</b></td>
                                            <td><?php echo $start_date ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div id="sc" class="sc">
                                <div class="titles">Spot Cash</div>
                                <div class="float-left col-md-12">
                                    <table class="table table-striped">
                                        <tr>
                                            <td style="width:40%;"><b>Amount:</b></td>
                                            <td><?php echo number_format($amt_fnanced,2) ?></td>
                                        </tr>
                                        <tr>
                                            <td><b>Pay Date:</b></td>
                                            <td><?php echo $start_date ?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="space"></div>
                            <div class="space"></div>
                            <div class="titles">Commission</div>
                           
                            <div class="view_box">
                                <div class="float-left col-md-12">
                                    <table class="table table-striped">
                                        <tr>
                                            <thead>
                                                <th><b>Position</b></th>
                                                <th><b>Code</b></th>
                                                <th><b>Name</b></th>
                                                <!-- <th><b>Rate</b></th> -->
                                            </thead>
                                        </tr>
                                        <tr>
                                        <?php $query3 = "SELECT * FROM t_csr_commission WHERE md5(c_csr_no) = '{$_GET['id']}'" ;
                                        $result3 = mysqli_query($conn, $query3);
                                        if($result3) {
                                            while ($row = mysqli_fetch_assoc($result3)) { 
                                                $code = $row['c_code'];
                                                $position = $row['c_position'];
                                                $agent = $row['c_agent'];
                                                $rate = $row['c_rate'];
                                                $amount = $row['c_amount'];
                                        ?>
                                        <tr>
                                            <td><?php echo $position ?></td>
                                            <td><?php echo $code ?></td>
                                            <td><?php echo $agent ?></td>
                                            <!-- <td><?php echo $rate ?></td> -->
                                            <?php 
                                        }} 
                                        ?>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="space"></div>
                            <div class="space"></div>
                            <div class="titles">Remarks</div>
                            <div class="view_box">
                                <div class="float-left col-md-12">
                                    <div style="padding:5px"><?php echo $notes ?></div>
                                </div>
                            </div>
                            <div class="commentDiv">
                                <form  method="POST" id="add_comment">
                                    <input type="hidden" name="action" value="add_comment">
                                    <input type="hidden" class="form-control required" name="csr_id" value="<?php echo $getID; ?>">
                                    <input type="hidden" class="form-control required" name="name" value= "">
                                    <div class="title_comment">Comment:</div>
                                        <textarea name="comment" id="txtarea_comment" rows="4" cols="50"></textarea>
                                        <button type="submit" id="action_add_comment" class="btn btn-flat btn-success float-right" style="font-size:14px;">
                                        <i class="fa fa-comment" aria-hidden="true"></i>&nbsp;&nbsp;Add Comment
                                        </button>
                                </form>
                            </div>  
                <?php 

                $query = "SELECT * FROM t_csr_comments WHERE md5(c_csr_no) = '{$_GET['id']}'";
                //print $query;
                $result = mysqli_query($conn, $query);
                $comments = array();
                while ($row = mysqli_fetch_object($result))
                {
                    array_push($comments, $row);
                }
                
                // loop through each comment
                foreach ($comments as $comment_key => $comment)
                {
                    // initialize replies array for each comment
                    $replies = array();
                
                    // check if it is a comment to csr, not a reply to comment
                    if ($comment->reply_of == 0)
                    {
                        // loop through all comments again
                        foreach ($comments as $reply_key => $reply)
                        {
                            // check if comment is a reply
                            if ($reply->reply_of == $comment->comment_id)
                            {
                                // add in replies array
                                array_push($replies, $reply);
                
                                // remove from comments array
                                unset($comments[$reply_key]);
                            }
                        }
                    }
                
                    // assign replies to comments object
                    $comment->replies = $replies;
                }
            
                ?>
                <div class="comment_list">
                    <ul class="comments">
                        <?php foreach ($comments as $comment): ?>
                            <li>
                                <p>
                                    <div class="com_name"><?php echo $comment->name; ?></div>
                                </p>
                    
                                <p>
                                    <textarea class="com_comment" rows="3" style='max-width:100%;' readonly><?php echo $comment->comment; ?></textarea>
                                </p>
                    
                                <p>
                                    <div class="com_date"><?php echo date("F d, Y h:i a", strtotime($comment->created_at)); ?></div>
                                </p>
                                <hr>   
                            </li>
                        <?php endforeach; ?>
                    </ul>    
                </div>
                </div>  
            </div> 
        </div>
    </div>
</div>

</body>

<script>

    

    $('.coo-disapproval').click(function(){
		_conf("Are you sure you want to disapproved this CSR?","coo_disapproval",[$(this).attr('csr-id'),$(this).attr('csr-lot-lid'),$(this).attr('value'),$(this).attr('user-type')])
	})

    $('.sm-verification').click(function(){
		_conf("Are you sure you want to verify this CSR?","sm_verification",[$(this).attr('csr-id'),$(this).attr('csr-lot-lid'),$(this).attr('value'),$(this).attr('user-type')])
	})

    $('.sm-verification2').click(function(){
		_conf("Are you sure you want to void this CSR?","sm_verification",[$(this).attr('csr-id'),$(this).attr('csr-lot-lid'),$(this).attr('value'),$(this).attr('user-type')])
	})


    function sm_verification($id,$lid,$value,$type){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=sm_verification",
			method:'POST',
			data:{id:$id,lid:$lid,value:$value,type:$type},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured",'error');
                end_loader();
			},
			success:function(resp){
				if(resp.status == 'success'){
                    $(".modal").removeClass("visible");
					$(".modal").modal('hide');
                    location.reload();
				}else if(resp.status == 'failed' && !!resp.msg){
                        $(".modal").removeClass("visible");
                        $(".modal").modal('hide');
                        alert_toast(resp.msg,'error');
                        end_loader();
                }else{
                    alert_toast("An error occured",'error');
                    end_loader();
                    console.log(resp)
                }
			}
		})
	}

    function coo_disapproval($id,$lid,$value,$type){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=coo_disapproval",
			method:'POST',
			data:{id:$id,lid:$lid,value:$value,type:$type},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured",'error');
                end_loader();
			},
			success:function(resp){
				if(resp.status == 'success'){
                    $(".modal").removeClass("visible");
					$(".modal").modal('hide');
                    location.reload();
				}else if(resp.status == 'failed' && !!resp.msg){
                        $(".modal").removeClass("visible");
                        $(".modal").modal('hide');
                        alert_toast(resp.msg,'error');
                        end_loader();
                }else{
                    alert_toast("An error occured",'error');
                    end_loader();
                    console.log(resp)
                }
			}
		})
	}

    $('.new-coo-approval').click(function(){   
        uni_modal("<i class='fa fa-plus'></i> COO Approval",'sales/approval.php?id='+$(this).attr('data-csr-id'),$(this).attr('user-type'),"mid-small")
    })


    $('.compose-email').click(function(){
           uni_modal('Compose Email','mail.php?id='+$(this).attr('data-csr-id')) 

    })

    function showReplyForm(self) {
        var commentId = self.getAttribute("data-id");
        if (document.getElementById("form-" + commentId).style.display == "") {
            document.getElementById("form-" + commentId).style.display = "none";
        } else {
            document.getElementById("form-" + commentId).style.display = "";
        }
    }

    function showReplyForReplyForm(self) {
    var commentId = self.getAttribute("data-id");
    var name = self.getAttribute("data-name");
 
    if (document.getElementById("form-" + commentId).style.display == "") {
        document.getElementById("form-" + commentId).style.display = "none";
    } else {
        document.getElementById("form-" + commentId).style.display = "";
    }
 
    document.querySelector("#form-" + commentId + " textarea[name=comment]").value = "@" + name;
    document.getElementById("form-" + commentId).scrollIntoView();
    }

   
    function changeSelected(){
        var cstatus_changed=document.getElementById('status_list').value;
    }
    function paymentType(){
        var dp1=document.getElementById('p1').value;
        var dp2=document.getElementById('p2').value;
        if(dp1 == "Full DownPayment" && dp2 == "Monthly Amortization"){
                $('#pd').hide();
                $('#ma').show();
                $('#dfc').hide();
                $('#sc').hide();
                $('#fdp').show();
                return;
        }
        if(dp1 == "Full DownPayment" && dp2 == "Deferred Cash Payment"){
                $('#pd').hide();
                $('#ma').hide();
                $('#dfc').show();
                $('#sc').hide();
                $('#fdp').show();
                return;
        }
        if (dp1 == "Partial DownPayment" && dp2 == "Monthly Amortization"){
                $('#pd').show();
                $('#ma').show();
                $('#dfc').hide();
                $('#sc').hide();
                $('#fdp').hide();
                return;
        }
        if(dp1 == "Partial DownPayment" && dp2 == "Deferred Cash Payment"){
                $('#pd').show();
                $('#ma').hide();
                $('#dfc').show();
                $('#sc').hide();
                $('#fdp').hide();
                return;
        }
        if(dp1 == "No DownPayment" && dp2 == "Monthly Amortization"){
                $('#pd').hide();
                $('#ma').show();
                $('#dfc').hide();
                $('#sc').hide();
                $('#fdp').hide();
                return;
        }
        if(dp1 == "No DownPayment" && dp2 == "Deferred Cash Payment"){
                $('#pd').hide();
                $('#ma').hide();
                $('#dfc').show();
                $('#sc').hide();
                $('#fdp').hide();
                return;
        }
        if(dp1 == "Spot Cash"){
                $('#space1').hide();
                $('#pd').hide();
                $('#ma').hide();
                $('#dfc').hide();
                $('#sc').show();
                $('#fdp').hide();
                return;
        }
    }

    function loadAll(){
        getAcSubtotal();
        getAcGrillSubtotal();
        getConvSubtotal();
        getServiceSubtotal();
        getOthersSubtotal();
        getAddCost();
        paymentType();
        getFlrElev();
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

		let res = ac_unit * ac_unit_price;
        let res_comma = res.toLocaleString();

		document.getElementById('ac_outlet_subtotal').value = res;
        document.getElementById('ac_outlet_subtotal_disp').value = res_comma + '.00';
		// getAddCost();
	}
	function getAcGrillSubtotal(){
		var ac_grill = document.getElementById("ac_grill").value;
		var ac_grill_price = document.getElementById("ac_grill_price").value;

		let res = ac_grill * ac_grill_price;
        let res_comma = res.toLocaleString();

		document.getElementById('ac_grill_subtotal').value = res;
        document.getElementById('ac_grill_subtotal_disp').value = res_comma + '.00';
		// getAddCost();
	}
    function getConvSubtotal(){
		var conv = document.getElementById('conv_outlet').value;
		var conv_price = document.getElementById('conv_outlet_price').value;

		let res = conv * conv_price;
        let res_comma = res.toLocaleString();

		document.getElementById('conv_outlet_subtotal').value = res;
        document.getElementById('conv_outlet_subtotal_disp').value = res_comma + '.00'
		// getAddCost();
	}
	function getServiceSubtotal(){
		var service = document.getElementById('service_area').value;
		var service_price = document.getElementById('service_area_price').value;

		var res = service * service_price;
        var res_comma = res.toLocaleString();

		document.getElementById('service_subtotal').value = res;
        document.getElementById('service_subtotal_disp').value = res_comma + '.00';
		// getAddCost();
	}
	function getOthersSubtotal(){
		var others = document.getElementById('others').value;
		var others_price = document.getElementById('others_price').value;

		var res = others * others_price;
        var res_comma = res.toLocaleString();

		document.getElementById('others_subtotal').value = res;
        document.getElementById('others_subtotal_disp').value = res_comma + '.00';
		// getAddCost();
	}

	function getAddCost(){
		var others = document.getElementById('others_subtotal').value;
		var service = document.getElementById('service_subtotal').value;
		var ac_grill1 = document.getElementById('ac_grill_subtotal').value;
		var ac_outlet = document.getElementById('ac_outlet_subtotal').value;
		// var flr_elev = document.getElementById('flrelev_price').value;
		var conv_outlet = document.getElementById('conv_outlet_subtotal').value;

		let result = parseInt(others) + parseInt(service) + parseInt(ac_outlet) + parseInt(conv_outlet) + parseInt(ac_grill1);
        let res_comma = result.toLocaleString();

		document.getElementById('add_cost_total').value = res_comma + '.00';
	}
    
</script>
<script>
$("#action_add_comment").click(function(e) {
    e.preventDefault();
    console.log("Received");
    actionAddComment();
});
function actionAddComment() {
		
		var errorCounter = validateForm();

		if (errorCounter > 0) {
		    $("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
		    $("#response .message").html("<strong>Error</strong>: It appear's you have forgotten to complete something!");
		    $("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
		} else {

			var $btn = $("#action_add_comment").button("loading");
			
			$(".required").parent().removeClass("has-error");

			$.ajax({

				url: 'response.php',
				type: 'POST',
				data: $("#add_comment").serialize(),
				dataType: 'json',
				success: function(data){
					$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
					$("#response").removeClass("alert-warning").addClass("alert-success").fadeIn();
					$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
					$btn.button("reset");
					setInterval('location.reload()', 2000);
					
				},
				error: function(data){
					$("#response .message").html("<strong>" + data.status + "</strong>: " + data.message);
					$("#response").removeClass("alert-success").addClass("alert-warning").fadeIn();
					$("html, body").animate({ scrollTop: $('#response').offset().top }, 1000);
					$btn.button("reset");
					setInterval('location.reload()', 2000);
				} 
			});
		}
	}

</script>


