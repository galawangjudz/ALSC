<?php 
include '../../config.php';
if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<?php


if(isset($_GET['id'])){
    $prop = $conn->query("SELECT * FROM properties where md5(property_id) = '{$_GET['id']}' ");    
    while($row=$prop->fetch_assoc()){
    
        ///LOT
        $prop_id = $row['property_id'];
        $type = $row['c_type'];
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
      /*   
        $acronym = $row['c_acronym'];
        $block = $row['c_block'];
        $lot = $row['c_lot']; */
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


</style>

<div class="card card-outline rounded-0 card-maroon">
    
	<div class="card-header">
	<h3 class="card-title"><b>Property ID# <i><?php echo $prop_id ?></i> </b></h3>
	</div>
	<div class="card-body">
    <div class="container-fluid">
    <br>
        <h5 style="text-align:center;">Lot Details</h5>
        <hr>
        <table class="table table-striped table-hover table-bordered" style="width: 100%">
            <tr><th>Property Type</th>
                <?php if($type == 1){ ?>
                    <td><span class="badge badge-primary">Lot Only</span></td>
                <?php }elseif($type == 2){ ?>
                    <td><span class="badge badge-primary">House Only</span></td>
                <?php }elseif($type == 3){ ?>
                    <td><span class="badge badge-primary">Packaged</span></td>         
                <?php }elseif($type == 4){ ?>
                    <td><span class="badge badge-primary">Fence</span></td>
                <?php }elseif($type == 5){ ?>
                    <td><span class="badge badge-primary">Add Cost</span></td>
                <?php } ?>        
            </tr>
            <tr><th>Lot Area: </th><td><?php echo $lot_area;?> SQM</td></tr>
            <tr><th>Price/SQM: </th><td><?php echo number_format($price_sqm,2);?></td></tr>
            <tr><th>Amount: </th><td><?php echo number_format($lres,2)?></td></tr>
            <tr><th>Discount (%): </th><td><?php echo number_format($lot_disc,2);?></td></tr>
            <tr><th>Discount Amount: </th><td><?php echo number_format($lot_disc_amt,2);?></td></tr>
            <tr><th>Lot Contract Price: </th><td><?php echo number_format($lcp,2);?></td></tr>
        </table>
        <br>
        <h5 style="text-align:center;">House Details</h5>
        <hr>
        <table class="table table-striped table-hover table-bordered" style="width: 100%">
            <tr><th>House Model: </th><td><?php echo $house_model;?></td></tr>
            <tr><th>Floor Area: </th><td><?php echo $floor_area;?> SQM</td></tr>
            <tr><th>House Price/SQM: </th><td><?php echo number_format($house_price_sqm,2);?></td></tr>
            <tr><th>Total: </th><td><?php echo number_format($hres,2);?></td></tr>
            <tr><th>House Discount (%): </th><td><?php echo number_format($house_disc,2)?></td></tr>
            <tr><th>House Discount Amount: </th><td><?php echo number_format($house_disc_amt,2);?></td></tr>
            <tr><th>House Contract Price: </th><td><?php echo number_format($hcp,2);?></td></tr>
        </table>
        <br>
        <h5 style="text-align:center;">Payment Details</h5>
        <hr>
        <table class="table table-striped table-hover table-bordered" style="width: 100%">
            <tr><th>Payment Type 1: </th><td><?php echo $p1;?></td></tr>
            <tr><th>Payment Type 2: </th><td><?php echo $p2;?></td></tr>
            <tr><th>Total Contract Price: </th><td><?php echo number_format($tcp,2);?></td></tr>
            <tr><th>TCP Discount (%): </th><td><?php echo number_format($tcp_discount,2);?></td></tr>
            <tr><th>TCP Discount Amount: </th><td><?php echo number_format($tcp_discount_amt,2);?></td></tr>
            <tr><th>VAT (%): </th><td><?php echo number_format($vat,2);?></td></tr>
            <tr><th>Down Payment (%): </th><td><?php echo number_format($down_percent,2);?></td></tr>
            <tr><th>VAT Amount: </th><td><?php echo number_format($vat_amt,2);?></td></tr>
            <tr><th>Reservation Amount: </th><td><?php echo number_format($reservation,2);?></td></tr>
            <tr><th>Monthly Payment: </th><td><?php echo number_format($monthly_payment,2);?></td></tr>
            <tr><th>No. of Payment: </th><td><?php echo number_format($no_payments,2);?></td></tr>
            <tr><th>First Down Payment: </th><td><?php echo $first_dp;?></td></tr>
            <tr><th>Full Down Payment: </th><td><?php echo $full_down;?></td></tr>
            <tr><th>Amount Financed: </th><td><?php echo number_format($amt_fnanced,2);?></td></tr>
            <tr><th>Terms: </th><td><?php echo number_format($terms,2);?></td></tr>
            <tr><th>Interest Rate: </th><td><?php echo number_format($interest_rate,2);?></td></tr>
            <tr><th>Fixed Factor: </th><td><?php echo number_format($fixed_factor,2);?></td></tr>
            <tr><th>Start Date: </th><td><?php echo $start_date;?></td></tr>
        </table>



    </div>
	</div>
</div>
<script>


	
</script>