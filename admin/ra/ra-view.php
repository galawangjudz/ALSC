
<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<?php 

$usertype = $_settings->userdata('user_type');
if(($_GET['id']) && ($_GET['id'] > 0)){
    $csr = $conn->query("SELECT x.*, y.ra_id, y.c_csr_status, y.c_reserve_status, 
                        y.c_ca_status, y.c_duration, y.c_csr_no as csr_num FROM t_approval_csr y 
                        inner join t_csr x on x.c_csr_no = y.c_csr_no where md5(y.c_csr_no) = '{$_GET['id']}'" );
    if($csr->num_rows > 0){
        while ($row = mysqli_fetch_assoc($csr)):
            $ra_id = $row['ra_id'];
            $getID= $row['c_csr_no'];
            $csr_no = $row['c_csr_no'];
            $refno = $row['ref_no'];
            $lot_id = $row['c_lot_lid'];
        
            $csr_status = $row['c_csr_status'];// status
            $reserv_status = $row['c_reserve_status'];// status
            $ca_status = $row['c_ca_status'];// status 
        

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
            $c_ca_status = $row['c_ca_status'];
            $duration = $row['c_duration'];
        
        endwhile;
    }

}else{
 
}

?>

<style>

    .timer_box{
    background-color:#F9F6EE;
    width:100%;
    height:110px;
    padding:10px;
    margin-bottom:10px;
    position:relative;
    border-radius: 10px;
    }
    #CountDown{
    position: absolute;
    height:110px;
    top: 50%;
    left: 50%;
    margin-top: -55px;
    margin-left: -220px;
    margin-bottom:50px;
    }

    h4{
        font-size:12px!important;
        font-weight:bold;
    }
    .modal-content{
    width:1035px;
    height:auto;
    margin-left:-200px;
    max-width:1035px;
        display: block!important; /* remove extra space below image */
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
    .space{
    float:left;
    width:100%;
    height:15px;
    }
    .hr_space{
        margin-top:18px;
        display:block;
    }
    .view_box{
    border: solid black 1px;
    height:auto;
    width:100%;
    background-color:white;
    border-radius:5px;
    /*box-shadow: 5px 5px #E2DFD2; */
    float:left;
    }
    .view_lot{
    border: solid black 1px;
    height:auto;
    width:49%;
    margin-right:1%;
    background-color:white;
    border-radius:5px;
    /*box-shadow: 5px 5px #E2DFD2;*/
    float:left;
    }
    .view_house{
    border: solid black 1px;
    height:auto;
    width:49%;
    margin-left:1%;
    background-color:white;
    border-radius:5px;
    /*box-shadow: 5px 5px #E2DFD2;*/
    float:left;
    }
    .sc{
    border: solid black 1px;
    height:auto;
    width:100%;
    background-color:white;
    border-radius:5px;
    /*box-shadow: 5px 5px #E2DFD2;*/
    float:left;
    }
    .pd{
    border: solid black 1px;
    height:auto;
    width:100%;
    background-color:white;
    border-radius:5px;
    /*box-shadow: 5px 5px #E2DFD2;*/
    float:left;
    }
    .ma{
    border: solid black 1px;
    height:auto;
    width:100%;
    background-color:white;
    border-radius:5px;
    /*box-shadow: 5px 5px #E2DFD2;*/
    float:left;
    }
    .dfc{
    border: solid black 1px;
    height:auto;
    width:100%;
    background-color:white;
    border-radius:5px;
    /*box-shadow: 5px 5px #E2DFD2;*/
    float:left;
    }
    .fdp{
    border: solid black 1px;
    height:auto;
    width:100%;
    background-color:white;
    border-radius:5px;
    /*box-shadow: 5px 5px #E2DFD2;*/
    float:left;
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

    .commentDiv{
    background-color:gainsboro;
    height:auto;
    padding:15px;
    border-radius:5px;
    box-shadow: 5px 5px #E2DFD2;
    border:solid 1px black;
    width:100%;
    float:left;
    margin-top:35px;
    }
    .comment_list{
    margin-top:50px;
    background-color:#FAF9F6;
    padding:10px;
    float:left;
    width:100%;
    border-radius:5px;
    border:1px solid black;
    }
    .com_name{
    background-color:gainsboro;
    width:100%;
    height:auto;
    font-weight: bolder;
    }
    .com_comment{
    border:1px solid black;
    width:100%;
    height:auto;
    padding:5px;
    margin-top:-10px;
    }
    .com_date{
    background-color:gainsboro;
    width:100%;
    height:auto;
    margin-top:-15px;
    font-size:11px;
    font-style: italic;
    font-weight:bold;
    }


</style>
<body onload="loadAll()">

<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
	<h3 class="card-title">Reservation Application #<?php echo $ra_id; ?></h3>
	</div>
	<div class="card-body">
		<div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php if($reserv_status == 0){ ?>
                <div class="timer_box">
                    <div id="CountDown" data-date="<?php echo $duration; ?>"></div>
                    <br>
                </div>
                <?php } ?>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <input type="hidden" value="<?php echo $p1; ?>" id="p1">
                        <input type="hidden" value="<?php echo $p2; ?>" id="p2">
                  
                        <div class="clear"></div>
                    </div>
                </div>
                    <div class="panel-body form-group form-group-sm">
                      
                            <div class="buttons">
                          <!-- hide ko muna   <a href="?page=mail&id=<?php echo $getID; ?>" data-csr-id="'.$row['c_csr_no'].'" data-email="'.$row['c_email'].'" data-invoice-type="'.$row['c_employment_status'].'" data-custom-email="'.$row['c_email'].'" class="btn btn-info"> E-mail&nbsp;&nbsp;<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> </a>
 -->
                                    <!-- Navbar Right Menu -->
                            <button type="button" class="btn btn-flat btn-default btn-sm dropdown-toggle dropdown-icon" data-toggle="dropdown">
                                Print
                            <span class="sr-only">Toggle Dropdown</span>
                            </button>  
                            <div class="dropdown-menu" role="menu">   
                                <a class="dropdown-item" href="/ALSC/report/print_ra.php?id=<?php echo $getID; ?>">Print Front Page</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/ALSC/report/print_ra_back.php?id=<?php echo $getID; ?>">Print Back Page</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/ALSC/report/print_agreement.php?id=<?php echo $getID; ?>">Print Agreement Page</a>
                            </div>
                            
                            <?php if($c_ca_status == 0){?>
                                <a attachment-id="<?php echo $getID; ?>" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal" id="upload_file">For Revision&nbsp;&nbsp;<span class="glyphicon glyphicon-cloud-upload" aria-hidden="true"></a>
                            <?php } ?>
                           
                             </div>
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
                                                <td><b>Buyer No: </b></td>
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
                                                    <td><b>Lot ID:</b></td>
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
                                                    <td><b>House Model:</b></td>
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
                                    <div class="titles">Payment Computation</div>
                                    <div class="view_box">
                                        <div class="float-left col-md-12">
                                            <table class="table table-striped">
                                                <tr>
                                                    <td><b>TCP Discount: </b></td>
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
                                                    <td><b>Reservation: </b></td>
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
                                                    <td><b>Down %:</b></td>
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
                                                    <td><b>Down %:</b></td>
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
                                                    <td><b>Amount to be Financed:</b></td>
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
                                                    <td><b>Deferred Amount:</b></td>
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
                                                    <td><b>Amount:</b></td>
                                                    <td><?php echo number_format($amt_fnanced,2) ?></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Pay Date:</b></td>
                                                    <td><?php echo $start_date ?></td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                    <div id="space1" class="space"></div>
                                    <div id="space1" class="space"></div>
                                    <div class="view_box" style="padding:20px;">
                                    <table style="text-align:center;" class="table table-striped">
                                                        <th style="text-align:center;">ID</th>
                                                        <th style="text-align:center;">File Name</th>
                                                        <th style="text-align:center;">Date Uploaded</th>
                                                        <th style="text-align:center;">Revision Approval</th>
                                                        <?php if ($usertype == 'IT Admin' || $usertype == 'SOS'): ?>
                                                        <th style="text-align:center;">Action</th>
                                                        <?php endif; ?>
                                        <?php
                                           
                                            $query1 = "SELECT * FROM tbl_attachments WHERE c_csr_no = '".$getID."' ORDER BY date_uploaded DESC";

                                            $results1 = $conn->query($query1);

                                            if($results1) {
                                                    
                                                ?>
                                                
                                                        <b>Attachments: </b>
                                                        <?php
                                                        while($row1 = $results1->fetch_assoc()):
                                                            
                                                            ?>
                                                        
                                                    
                                                            <tr>
                                                            <td style="width:10%;">
                                                                <div data-id='<?php echo $row1["id"]; ?>'><?php echo $row1["id"]; ?>
                                                        </td>
                                                        <td style="width:30%;">
                                                                <div data-id='<?php echo $row1["id"]; ?>' class="attachment_name btn-link"><?php echo $row1["title"]; ?>
                                                        </td>
                                                        <td>
                                                                <?php echo $row1["date_uploaded"]; ?></div>
                                                        </td>

                                                        <?php if($row1['approval_status'] == 1): ?>
                                                            <td><span class="badge badge-success">SM Approved</span></td>
                                                            <td class="actions">--- </td>
                                                        <?php else: ?>    
                                                            <td><span class="badge badge-warning"> Pending </span></td>
                                                            <?php if ($usertype == 'IT Admin' || $usertype == 'SOS'): ?>
                                                                <td class="actions">
                                                                <a data-upload-id="<?php echo $row1['id'] ?>" class="btn btn-primary btn-xs approved-upload">Approved<span class="fa fa-check"></a> 
                                                                <a data-upload-id="<?php echo $row1['id'] ?>" class="btn btn-danger btn-xs" id="delete_upload">Delete<span class="fa fa-trash"></a>
                                                                </td>
                                                                <?php endif; ?>
                                                        <?php endif; ?>
                                                       
                                                         
                                                       
                                                    
                                                            </tr>
                                                        

                                                        <?php endwhile; ?>
                                                        </table>
                                                <?php
                                                
                                            }
                                        ?>
                                        
                                    </div>
                                <!--     add comment form here  -->
                                    <div class="commentDiv">
                                        <form  method="POST" id="add_comment">
                                            <input type="hidden" name="action" value="add_comment">
                                            <input type="hidden" class="form-control required" name="csr_id" value="<?php echo $getID; ?>">
                                            <input type="hidden" class="form-control required" name="name" value= "<?php echo $_settings->userdata('username'); ?>">
                                            <div class="title_comment">Comment:</div>
                                                <textarea name="comment" id="txtarea_comment" rows="4" cols="50"></textarea>
                                                <input type="submit" id="action_add_comment" class="btn btn-success float-right" value="Add Comment">
                                        </form>
                                    </div>  

                        <?php
        
                        // Connect to the database
                        // the query
                        $query = "SELECT * FROM t_csr_comments WHERE c_csr_no = '" . $conn->real_escape_string($getID) . "'";
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





        </div>
    </div>
</div>
<div class="modal fade" id="a_modal" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">File Preview</h4>
				<button type="button" class="close" data-dismiss="modal"></button>
			</div>
			<div class="modal-body">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


</body>
<script>                                

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
        paymentType();
    /*     statusColor(); */
    }


    $('#upload_file').click(function(){
        uni_modal("<i class='fa fa-upload'></i> Upload Old RA",'upload_ra/upload_files.php?id='+$(this).attr('attachment-id'))
    })
   /*  $('#upload_file').click(function(){
	uni_modal('Upload File','ra/upload_files.php?id='+$(this).attr('attachment-id'));
    })
 */

    $("#CountDown").TimeCircles();
    $("#CountDown").TimeCircles({count_past_zero: false}).addListener(countdownComplete);
	
    function countdownComplete(unit, value, total){
        if(total<=0){
            //alert('RESERVATION ALREADY EXPIRED');
            //$(this).fadeOut('slow').replaceWith("<h3>RESERVATION ALREADY EXPIRED</h3>");
            document.getElementById("samp_txt").value="EXPIRED";
            updateStat();

        }
    }

    $(document).ready(function(){
		$('.approved-upload').click(function(){
            $.ajax({
                url:_base_url_+"classes/Master.php?f=approved_upload",
                method:'POST',
                data:{id:$(this).attr('data-upload-id'),ra_id:'<?php echo $ra_id ?>',csr_no:'<?php echo $csr_no ?>'},
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
		});
	});
    $('#delete_upload').click(function(){
        _conf("Are you sure to delete this file?","delete_upload",[$(this).attr('data-upload-id')])
    }) 

    function delete_upload($id){
        start_loader();
        $.ajax({
            url:_base_url_+"classes/Master.php?f=delete_upload",
            method:"POST",
            data:{id: $id},
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
                    location.replace('./?page=upload_ra/deletefile&name='+resp.name)
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

   /*  $(document).ready(function(){
		$('.delete-upload').click(function(){
            $.ajax({
                url:_base_url_+"classes/Master.php?f=delete_upload",
                method:'POST',
                data:{id:$(this).attr('data-upload-id')},
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
		});
	}); */
    
	$(document).ready(function(){
		$('.attachment_name').click(function(){
			var csrno=$(this).data('id');
            $.ajax({
                url:'upload_ra/ajax_attachments.php',
				type:'post',
				data:{csrno:csrno},
				success:function(response){
					$('.modal-body').html(response);
					$('#a_modal').modal('show');
				},
                error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				}
                
			})
		});
	});




</script>




<script>

    $('.coo-disapproval').click(function(){
		_conf("Are you sure to disapproved this csr?","coo_disapproval",[$(this).attr('csr-id'),$(this).attr('csr-lot-lid'),$(this).attr('value')])
	})

    $('.sm-verification').click(function(){
		_conf("Are you sure to verified this csr?","sm_verification",[$(this).attr('csr-id'),$(this).attr('csr-lot-lid'),$(this).attr('value')])
	})

    $('.sm-verification2').click(function(){
		_conf("Are you sure to void this csr?","sm_verification",[$(this).attr('csr-id'),$(this).attr('csr-lot-lid'),$(this).attr('value')])
	})


    function sm_verification($id,$lid,$value){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=sm_verification",
			method:'POST',
			data:{id:$id,lid:$lid,value:$value},
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

    function coo_disapproval($id,$lid,$value){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=coo_disapproval",
			method:'POST',
			data:{id:$id,lid:$lid,value:$value},
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
        uni_modal("<i class='fa fa-plus'></i> Coo Approval",'sales/approval.php?id='+$(this).attr('data-csr-id'),"mid-small")
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
        paymentType();
    }
</script>



