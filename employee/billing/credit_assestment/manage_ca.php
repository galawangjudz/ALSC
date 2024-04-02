<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php

$type = $_settings->userdata('user_code');
if(isset($_GET['id'])){
    $csr = $conn->query("SELECT c_reserve_date, c_amount_paid FROM t_reservation where md5(c_csr_no) = '{$_GET['id']}' ");    
    while($row=$csr->fetch_assoc()){
        $reservation_date = $row['c_reserve_date'];
        $amount_paid = $row['c_amount_paid'];
    }
    $query = "SELECT x.*, y.ra_id, y.c_csr_status, y.c_reserve_status, y.cfo_status, y.c_ca_status, y.c_duration, y.c_csr_no, z.c_revised, z.c_csr_no AS csr_num
    FROM t_approval_csr y
    INNER JOIN t_csr_view x ON x.c_csr_no = y.c_csr_no
    INNER JOIN t_csr z ON x.c_csr_no = z.c_csr_no
    WHERE MD5(y.c_csr_no) = '{$_GET['id']}';
    ";

    $result = mysqli_query($conn, $query);
    // mysqli select query
    if($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rev_stats = $row['c_revised'];
        $ca_stats = $row['c_ca_status'];
        $ra_id = $row['ra_id'];
        $csr_no = $row['c_csr_no'];
        $lot_id = $row['c_lot_lid'];
        $customer_date_of_sale = $row['c_date_of_sale'];
        // buyer
        $customer_last_name_1 = $row['last_name']; // customer last name
        $customer_first_name_1 = $row['first_name']; // customer first name
        $customer_middle_name_1 = $row['middle_name']; // customer middle name
    
        $cust_fullname1 = sprintf('%s, %s %s', $customer_last_name_1, $customer_first_name_1, $customer_middle_name_1);  
        // more details
      
        $csr_status = $row['c_csr_status'];// status
        if ($csr_status == 1){
            $csr_status = "Approved";
        }else{
            $csr_status = "Disapproved";
        }
        $cfo_stat = $row['cfo_status'];
        $reserv_status = $row['c_reserve_status'];// status
        if($reserv_status == 1){
            $reserv_status = "Paid";
          
        }else{
            $reserv_status = "unpaid";
        }
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
        $duration = $row['c_duration'];
        $acronym = $row['c_acronym'];
        $block = $row['c_block'];
        $lot = $row['c_lot'];
        }

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
#uni_modal .modal-footer{
    display: none;
} 

</style>
<div class="card card-outline rounded-0 card-maroon">
	<div class="card-header">
	<h3 class="card-title">&nbsp;&nbsp;<?php echo !isset($_GET['id']) ? "<b><i>Approval</b></i>" :"<b><i>Approval</b></i>" ?></h3>
	</div>
	<div class="card-body">
    <div class="container-fluid">
    <?php echo $rev_stats ?>
                <?php echo $ca_stats ?>
    <table class="table table-striped table-hover table-bordered" id="data-table">
        <tr>
            <td><b>RA #: </b></td><td><?php echo $ra_id ?></td>
        </tr>
        <tr>
            <td><b>Location: </b></td><td><?php echo $acronym ?> <?php echo $block?> <?php echo $lot ?></td>
        </tr>
        <tr>
            <td><b>Buyer's Name: </b></td><td><?php echo $cust_fullname1 ?></td>
        </tr>
        <tr>
            <td><b>NET TCP: </b></td><td><?php echo 'P'.number_format($net_tcp,2) ?></td>
        </tr>
        <tr>
            <td><b>Coo Approval: </b></td><td><?php echo $csr_status ?></td>
        </tr>
        <tr>
            <td><b>Reservation Status: </b></td><td><?php echo $reserv_status ?></td>
        </tr>
        <tr>
            <td><b>Reservation Date: </b></td><td><?php echo $reservation_date ?></td>
        </tr>
        <tr>
            <td><b>Amount Paid: </b></td><td><?php echo 'P'.number_format($amount_paid,2) ?></td>
        </tr>
        <tr>
            <td><b>Loan Amount: </b></td><td><?php echo 'P'.number_format($amt_fnanced,2) ?></td>
        </tr>
        <tr>
            <td><b>Payment Type 1: </b></td><td><?php echo $p1 ?></td>
        </tr>
        <tr>
            <td><b>Payment Type 2: </b></td><td><?php echo $p2 ?></td>
        </tr>
        <tr>
            <td><b>Interest Rate: </b></td><td><?php echo $interest_rate ?></td>
        </tr>
        <tr>
            <td><b>Terms: </b></td><td><?php echo $terms ?></td>
        </tr>
        <tr>
            <td><b>Monthly Amortization: </b></td><td><?php echo 'P'.number_format($monthly_payment,2) ?></td>
        </tr> 
        <tr>
            <td><b>Monthly Amortization: </b></td><td><?php echo $rev_stats ?></td>
        </tr> 
        <tr>
            <td><b>Monthly Amortization: </b></td><td><?php echo $ca_stats ?></td>
        </tr> 
    </table>
    

    <div class="row-xs-3"> 
        <table style="width:100%">
            <tr>

            <?php if ($rev_stats == 0 && ($ca_stats == 0)):?> 
                <td>
                    <button type="button" style="width:100%;font-size:14px;" class="btn btn-success btn-flat ca_approved" csr-id ="<?php $csr_no ?>"  value= 1><i class="fa fa-thumbs-up" aria-hidden="true"></i>&nbsp;&nbsp;Approved</button>
                </td>
                <td>
                    <button type="button" style="width:100%;font-size:14px;" class="btn btn-danger btn-flat ca_approved" csr-id ="<?php $csr_no ?>"  value= 2><i class="fa fa-thumbs-down" aria-hidden="true"></i>&nbsp;&nbsp;Disapproved</button>
                </td>
                <td>
                    <button type="button" style="width:100%;font-size:14px;" class="btn btn-warning btn-flat ca_approved" csr-id ="<?php $csr_no ?>" value= 3><i class="fa fa-edit" aria-hidden="true"></i>&nbsp;&nbsp;For Revision</button>
                </td>

               
            <?php endif;?>
                <td>
                    <button type="button" style="width:100%;font-size:14px;" class="btn btn-flat btn-secondary" data-dismiss="modal" style="font-size:14px;"><i class="fa fa-times-circle" aria-hidden="true"></i>&nbsp;&nbsp;Close</button>
                </td>
            </tr>
        </table>
    </div>



    </div>
	</div>
</div>
<script>

	$(document).ready(function(){


	$('.ca_approved').click(function(){
		start_loader();
		$.ajax({
            url:_base_url_+'classes/Master.php?f=ca_approval',
			method:'POST',
			data:{ra_id:'<?php echo $ra_id ?>',id:'<?php echo $csr_no ?>',lot_id:'<?php echo $lot_id ?>',value:$(this).attr('value'),type:'<?php echo $type ?>'},
			dataType:"json",
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

    function computeIncomeReq(){
        let int_rate = document.getElementById('int_rate').value;
        let int_terms = document.getElementById('term_rate').value;

        let n = int_terms;

        let i = (int_rate/100)/12;

        
        let fv = 0;
        let pv = document.getElementById('loan_amt').value;
        let type = 0;
        let ans = 0;
        let PMT = 0;
        let income_req = 0;
        if (int_terms != 0 || i != 0){
            ans = ((pv - fv) * i)/(1 - Math.pow((1 + i), (-n)));
            PMT = ans.toFixed(2);
            income_req = ans / 0.4;
            income_req = income_req.toFixed(2);
        }else{ 
            PMT = 0;
            income_req = 0;
        }   
        document.getElementById('income_req').value = income_req;
        document.getElementById('monthly').value = PMT;
    }
</script>