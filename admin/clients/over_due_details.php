<?php 
include '../../config.php';
include 'payment_schedule.php';
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
        
        }
    $pay_date = $_GET['paydate'];
    
        
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
	<h3 class="card-title"><b> Due/Overdue Details</b></h3>
	</div>
	<div class="card-body">
    <div class="container-fluid">
    <br>
<!--     <form method="" id="set-paydate">
              <label class="control-label">Pay Date: </label>
              <input type="date" name="pay_date_input" id="pay_date_input" value="<?php echo date('Y-m-d'); ?>">
              <input type="hidden" name="id" id="id" value="<?php $id ?>">
              <button type="button" class="btn btn-primary set_pay_date_button" data-date ="pay_date_input" data-id="<?php echo md5($property_id)  ?>"><span class="fa fa-plus"> Set Paydate </span></button> 
              <a class="btn btn-success btn-s set_pay_date_button">Set</a>
    </form> -->

    
    <?php $all_payments = load_data($prop_id, $pay_date);
           $over_due    = $all_payments[0];
           $total_amt_due = $all_payments[1];
           $total_interest =  $all_payments[2];
           $total_principal = $all_payments[3];
           $total_surcharge = $all_payments[4];  ?>
           <table style="width:60%;float:left;">
                <tr>
                    <td style="width:3%;font-size:14px;"><label class="control-label" style="margin-top:5px;"> Overdue Date: </label></td><td style="width:10%;font-size:14px;"><u><?php echo $pay_date; ?></u></td>
                    <td style="width:3%;font-size:14px;"><label class="control-label" style="margin-top:5px;">Property ID:  </label></td><td style="width:10%;font-size:14px;"><u><?php echo $prop_id; ?></u></td>
                </tr>
            </table>
    &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url ?>/report/print_over_due_details.php?id=<?php echo md5($prop_id); ?>&date=<?php echo $pay_date;?>", target="_blank" class="btn btn-success pull-right"><span class="glyphicon glyphicon-print"></span> Print</a>
    <table class="table2 table-bordered table-stripped">
                  <thead> 
                      <tr>
                          <th class="text-center" style="font-size:13px;">DUE DATE</th>
                          <th class="text-center" style="font-size:13px;">PAY DATE</th>
                          <th class="text-center" style="font-size:13px;">OR NO</th>
                          <th class="text-center" style="font-size:13px;">AMOUNT PAID</th> 
                          <th class="text-center" style="font-size:13px;">AMOUNT DUE</th>
                          <th class="text-center" style="font-size:13px;">INTEREST</th>
                          <th class="text-center" style="font-size:13px;">PRINCIPAL</th>
                          <th class="text-center" style="font-size:13px;">SURCHARGE</th>
                          <th class="text-center" style="font-size:13px;">REBATE</th>
                          <th class="text-center" style="font-size:13px;">PERIOD</th>
                          <th class="text-center" style="font-size:13px;">BALANCE</th>
                      </tr>
                  </thead>
                <tbody>
              
                   <?php 
                    foreach ($over_due as $l_data): ?>
                      <tr>
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[0] ?></td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[1] ?></td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[2] ?> </td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[3] ?> </td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[4] ?> </td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[5] ?> </td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[6] ?> </td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[7] ?> </td> 
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[8] ?> </td>  
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[9] ?> </td>  
                        <td class="text-center" style="font-size:13px;width:15%;"><?php echo $l_data[10] ?> </td>  
                      </tr>
                      <?php endforeach; ?>
                </tbody>
              </table>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">         
        
                         
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <table>
                            <tr>
                                <td style="font-size:14px;"><label class="control-label">Total Principal: </label></td>
                                <td><input type="text" class= "form-control-sm" name="tot_prin" id="tot_prin" value="<?php echo isset($total_principal) ? $total_principal: ''; ?>" disabled></td>
                                <td style="font-size:14px;"><label class="control-label">Total Surcharge: </label></td>
                                <td><input type="text" class= "form-control-sm" name="tot_sur" id="tot_sur" value="<?php echo isset($total_surcharge) ? $total_surcharge : ''; ?>" disabled></td>
                                <td style="font-size:14px;"><label class="control-label">Total Interest: </label></td>
                                <td><input type="text" class= "form-control-sm" name="tot_int" id="tot_int" value="<?php echo isset($total_interest) ? $total_interest : ''; ?>" disabled></td>
                                <td style="font-size:14px;"><label>Total Amount Due: </label></td>
                                <td><input type="text" class= "form-control-sm" name="tot_amt_due" id="tot_amt_due" value="<?php echo isset($total_amt_due) ? $total_amt_due : ''; ?>" disabled></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>     
            
  
    </div>
	</div>
</div>
<script>


	
</script>